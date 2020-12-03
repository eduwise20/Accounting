<?php

require 'apps/classes/models/AppClass.php';
require 'apps/students/models/AppStudent.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/sections/models/AppSection.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/discounts/models/AppDiscountStudent.php';
require 'apps/fee_names/models/AppFeeName.php';
require 'apps/billing_periods/models/BillingPeriod.php';
require 'apps/discounts/models/AppDiscount.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'assign_discount_to_students');
$ui->assign('_title', 'Assign Discount to Students ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'add':
        $classes = AppClass::all();
        $student_types = AppStudentType::all();
        $sections = AppSection::all();
        $categories = Category::all();
        $fee_names = AppFeeName::all();
        $billing_periods = BillingPeriod::all();
        view('app_wrapper', [
            '_include' => 'assign_discount/add',
            'classes' => $classes,
            'student_types' => $student_types,
            'sections' => $sections,
            'categories' => $categories,
            'fee_names' => $fee_names,
            'billing_periods' => $billing_periods,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'class_id' => 'required|not_in:0',
            'student_type_id' => 'required|not_in:0',
            'fee_name_id' => 'required|not_in:0'
        ],
            [
                'class_id:not_in' => 'The Class is required',
                'student_type_id:not_in' => 'The Student type is required',
                'fee_name_id:not_in' => 'The Fee name is required',
            ]);

        if (!isset($data['yearly_applicable'])) {
            $billing_period_validation = $validator->validate($data, [
                'billing_period_id' => 'required|not_in:0'
            ],
                [
                    'billing_period_id:not_in' => 'The Billing period is required',
                ]);
        }

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessages = $errors->firstOfAll();
            $msg = '';
            foreach ($errorMessages as $message) {
                $msg .= $message . '</br>';
            }
            echo $msg;
        } else if (isset($billing_period_validation) && $billing_period_validation->fails()) {
            $errorMessage = $billing_period_validation->errors()->firstOfAll();
            echo $errorMessage[0];
        } else {
            $array_of_discount_student = array();
            if ($data['assign_radio_button'] == 'multiple_students') {
                $array_of_discount_student = AppDiscountStudent::where('discount_id', $data['discount_id'])->get();
            } else if ($data['assign_radio_button'] == 'multiple_discounts') {
                $array_of_discount_student = AppDiscountStudent::where('student_id', $data['student_id'])->get();
            }

            if (sizeof($array_of_discount_student) > 0) {
                if ($data['assign_radio_button'] == 'multiple_students') {

                    $array_of_student_id = array();
                    $array_of_saved_student = array();
                    foreach ($data['student_ids'] as $student_id => $value) {
                        array_push($array_of_student_id, $student_id);
                    }
                    foreach ($array_of_discount_student as $discount_student) {
                        $array_of_saved_student[$discount_student->student_id] = $discount_student;
                    }
                    foreach ($data['student_ids'] as $student_id => $value) {
                        foreach ($array_of_discount_student as $discount_student) {
                            if ($student_id == $discount_student->student_id) {
                                if (($k = array_search($student_id, $array_of_student_id)) !== false) {
                                    unset($array_of_student_id[$k]);
                                }
                                if (array_key_exists($student_id, $array_of_saved_student)) {
                                    unset($array_of_saved_student[$student_id]);
                                }
                            }
                        }
                    }
                    if (sizeof($array_of_student_id) > 0) {
                        foreach ($array_of_student_id as $student_id) {
                            $discount_student_object = new AppDiscountStudent;
                            $discount_student_object->discount_id = $data['discount_id'];
                            $discount_student_object->student_id = $student_id;
                            $discount_student_object->fee_name_id = $data['fee_name_id'];
                            $discount_student_object->yearly_applicable = isset($data['yearly_applicable']) ? ($data['yearly_applicable'] == 'on' ? 1 : 0) : 0;
                            $discount_student_object->billing_period_id = $data['billing_period_id'];
                            $discount_student_object->save();
                        }
                    }
                    if (sizeof($array_of_saved_student) > 0) {
                        foreach ($array_of_saved_student as $key => $value) {
                            $value->delete();
                        }
                    }

                } else if ($data['assign_radio_button'] == 'multiple_discounts') {

                    $array_of_discount_id = array();
                    $array_of_saved_discount = array();
                    foreach ($data['discount_ids'] as $discount_id => $value) {
                        array_push($array_of_discount_id, $discount_id);
                    }
                    foreach ($array_of_discount_student as $discount_student) {
                        $array_of_saved_discount[$discount_student->discount_id] = $discount_student;
                    }
                    foreach ($data['discount_ids'] as $discount_id => $value) {

                        foreach ($array_of_discount_student as $discount_student) {
                            if ($discount_id == $discount_student->discount_id) {
                                if (($k = array_search($discount_id, $array_of_discount_id)) !== false) {
                                    unset($array_of_discount_id[$k]);
                                }
                                if (array_key_exists($discount_id, $array_of_saved_discount)) {
                                    unset($array_of_saved_discount[$discount_id]);
                                }
                            }
                        }
                    }
                    if (sizeof($array_of_discount_id) > 0) {
                        foreach ($array_of_discount_id as $discount_id) {
                            $discount_student_object = new AppDiscountStudent;
                            $discount_student_object->discount_id = $discount_id;
                            $discount_student_object->student_id = $data['student_id'];
                            $discount_student_object->fee_name_id = $data['fee_name_id'];
                            $discount_student_object->yearly_applicable = isset($data['yearly_applicable']) ? ($data['yearly_applicable'] == 'on' ? 1 : 0) : 0;
                            $discount_student_object->billing_period_id = $data['billing_period_id'];
                            $discount_student_object->save();
                        }
                    }
                    if (sizeof($array_of_saved_discount) > 0) {
                        foreach ($array_of_saved_discount as $key => $value) {
                            $value->delete();
                        }
                    }

                }
            } else {
                if ($data['assign_radio_button'] == 'multiple_students') {
                    foreach ($data['student_ids'] as $student_id => $value) {
                        $discount_student = new AppDiscountStudent;
                        $discount_student->discount_id = $data['discount_id'];
                        $discount_student->student_id = $student_id;
                        $discount_student->fee_name_id = $data['fee_name_id'];
                        $discount_student->yearly_applicable = isset($data['yearly_applicable']) ? ($data['yearly_applicable'] == 'on' ? 1 : 0) : 0;
                        $discount_student->billing_period_id = $data['billing_period_id'];
                        $discount_student->save();
                    }
                } else if ($data['assign_radio_button'] == 'multiple_discounts') {
                    foreach ($data['discount_ids'] as $discount_id => $value) {
                        $discount_student = new AppDiscountStudent;
                        $discount_student->discount_id = $discount_id;
                        $discount_student->student_id = $data['student_id'];
                        $discount_student->fee_name_id = $data['fee_name_id'];
                        $discount_student->yearly_applicable = isset($data['yearly_applicable']) ? ($data['yearly_applicable'] == 'on' ? 1 : 0) : 0;
                        $discount_student->billing_period_id = $data['billing_period_id'];
                        $discount_student->save();
                    }
                }
            }

            echo $discount_student->id;

        }
        break;

    case 'getFacultyForClass':
        $data = $request->all();
        $faculties = AppFaculty::where('class_id', $data['class_id'])->get();
        echo json_encode($faculties);
        break;

    case 'getSubCategoriesForCategory':
        $data = $request->all();
        $sub_categories = Subcategory::where('category_id', $data['category_id'])->get();
        echo json_encode($sub_categories);
        break;

    case 'getStudentAndDiscount':
        $data = $request->all();
        $discounts = AppDiscount::all();
        $where = [
            'class_id' => $data['class_id'],
            'student_type_id' => $data['student_type_id'],
        ];
        if ($data['faculty_id'] != 0) {
            $where['faculty_id'] = $data['faculty_id'];
        }
        if ($data['category_id'] != 0) {
            $where['category_id'] = $data['category_id'];
            if ($data['sub_category_id'] != 0) {
                $where['sub_category_id'] = $data['sub_category_id'];
            }
        }
        $students = AppStudent::where($where)->get();
        $r['students'] = $students;
        $r['discounts'] = $discounts;
        echo json_encode($r);
        break;

    case 'getDiscountsForStudent':
        $data = $request->all();
        $array_of_discount_student = AppDiscountStudent::where(['student_id' => $data['student_id'], 'fee_name_id' => $data['fee_name_id']])->get();
        $selected_discounts = array();
        if (sizeof($array_of_discount_student) > 0) {
            foreach ($array_of_discount_student as $discount_student)
                array_push($selected_discounts, $discount_student->discount_id);
        }
        $discounts = AppDiscount::all();
        $r['discounts'] = $discounts;
        $r['selectedDiscounts'] = $selected_discounts;
        echo json_encode($r);
        break;

    case 'getStudentsForDiscount':
        $data = $request->all();
        $array_of_discount_student = AppDiscountStudent::where(['discount_id' => $data['discount_id'], 'fee_name_id' => $data['fee_name_id']])->get();
        $discount = AppDiscount::find($data['discount_id']);
        $selected_students = array();
        if (sizeof($array_of_discount_student) > 0) {
            foreach ($array_of_discount_student as $discount_student)
                array_push($selected_students, $discount_student->student_id);
        }
        $where = [
            'class_id' => $data['class_id'],
            'student_type_id' => $data['student_type_id'],
        ];
        if ($data['faculty_id'] != 0) {
            $where['faculty_id'] = $data['faculty_id'];
        }
        if ($data['category_id'] != 0) {
            $where['category_id'] = $data['category_id'];
            if ($data['sub_category_id'] != 0) {
                $where['sub_category_id'] = $data['sub_category_id'];
            }
        }
        $students = AppStudent::where($where)->get();
        $r['discount_id'] = $data['discount_id'];
        $r['students'] = $students;
        $r['selectedStudents'] = $selected_students;
        $r['discount'] = $discount;
        echo json_encode($r);
        break;
}