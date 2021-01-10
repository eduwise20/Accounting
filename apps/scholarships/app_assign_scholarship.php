<?php

require 'apps/classes/models/AppClass.php';
require 'apps/students/models/AppStudent.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/sections/models/AppSection.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/scholarships/models/AppScholarshipStudent.php';
require 'apps/fee_names/models/AppFeeName.php';
require 'apps/billing_periods/models/BillingPeriod.php';
require 'apps/scholarships/models/AppScholarship.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'assign_scholarship_to_students');
$ui->assign('_title', 'Assign Scholarship to Students ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'add':
        $classes = AppClass::all();
        $student_types = AppStudentType::all();
        $categories = Category::all();
        $fee_names = AppFeeName::all();
        $billing_periods = BillingPeriod::all();
        view('app_wrapper', [
            '_include' => 'assign_scholarship/add',
            'classes' => $classes,
            'student_types' => $student_types,
            'categories' => $categories,
            'fee_names' => $fee_names,
            'billing_periods' => $billing_periods,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate(
            $data,
            [
                'class_id' => 'required|not_in:0',
                'student_type_id' => 'required|not_in:0',
                'fee_name_id' => 'required|not_in:0'
            ],
            [
                'class_id:not_in' => 'The Class is required',
                'student_type_id:not_in' => 'The Student type is required',
                'fee_name_id:not_in' => 'The Fee name is required',
            ]
        );

        if (!isset($data['yearly_applicable'])) {
            $billing_period_validation = $validator->validate(
                $data,
                [
                    'billing_period_id' => 'required|not_in:0'
                ],
                [
                    'billing_period_id:not_in' => 'The Billing period is required',
                ]
            );
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
            $array_of_scholarship_student = array();
            if ($data['assign_radio_button'] == 'multiple_students') {
                $array_of_scholarship_student = AppScholarshipStudent::where(['scholarship_id' => $data['scholarship_id'], 'fee_name_id' => $data['fee_name_id']])->get();
            } else if ($data['assign_radio_button'] == 'multiple_scholarships') {
                $array_of_scholarship_student = AppScholarshipStudent::where(['student_id' => $data['student_id'], 'fee_name_id' => $data['fee_name_id']])->get();
            }

            if (sizeof($array_of_scholarship_student) > 0) {
                if ($data['assign_radio_button'] == 'multiple_students') {

                    $array_of_student_id = array();
                    $array_of_saved_student = array();
                    foreach ($data['student_ids'] as $student_id => $value) {
                        array_push($array_of_student_id, $student_id);
                    }
                    foreach ($array_of_scholarship_student as $scholarship_student) {
                        $array_of_saved_student[$scholarship_student->student_id] = $scholarship_student;
                    }
                    foreach ($data['student_ids'] as $student_id => $value) {
                        foreach ($array_of_scholarship_student as $scholarship_student) {
                            if ($student_id == $scholarship_student->student_id) {
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
                            $scholarship_student_object = new AppScholarshipStudent;
                            $scholarship_student_object->scholarship_id = $data['scholarship_id'];
                            $scholarship_student_object->student_id = $student_id;
                            $scholarship_student_object->fee_name_id = $data['fee_name_id'];
                            $scholarship_student_object->yearly_applicable = isset($data['yearly_applicable']) ? ($data['yearly_applicable'] == 'on' ? 1 : 0) : 0;
                            $scholarship_student_object->billing_period_id = $data['billing_period_id'];
                            $scholarship_student_object->save();
                        }
                    }
                    if (sizeof($array_of_saved_student) > 0) {
                        foreach ($array_of_saved_student as $key => $value) {
                            $value->delete();
                        }
                    }
                } else if ($data['assign_radio_button'] == 'multiple_scholarships') {

                    $array_of_scholarship_id = array();
                    $array_of_saved_scholarship = array();
                    foreach ($data['scholarship_ids'] as $scholarship_id => $value) {
                        array_push($array_of_scholarship_id, $scholarship_id);
                    }
                    foreach ($array_of_scholarship_student as $scholarship_student) {
                        $array_of_saved_scholarship[$scholarship_student->scholarship_id] = $scholarship_student;
                    }
                    foreach ($data['scholarship_ids'] as $scholarship_id => $value) {

                        foreach ($array_of_scholarship_student as $scholarship_student) {
                            if ($scholarship_id == $scholarship_student->scholarship_id) {
                                if (($k = array_search($scholarship_id, $array_of_scholarship_id)) !== false) {
                                    unset($array_of_scholarship_id[$k]);
                                }
                                if (array_key_exists($scholarship_id, $array_of_saved_scholarship)) {
                                    unset($array_of_saved_scholarship[$scholarship_id]);
                                }
                            }
                        }
                    }
                    if (sizeof($array_of_scholarship_id) > 0) {
                        foreach ($array_of_scholarship_id as $scholarship_id) {
                            $scholarship_student_object = new AppScholarshipStudent;
                            $scholarship_student_object->scholarship_id = $scholarship_id;
                            $scholarship_student_object->student_id = $data['student_id'];
                            $scholarship_student_object->fee_name_id = $data['fee_name_id'];
                            $scholarship_student_object->yearly_applicable = isset($data['yearly_applicable']) ? ($data['yearly_applicable'] == 'on' ? 1 : 0) : 0;
                            $scholarship_student_object->billing_period_id = $data['billing_period_id'];
                            $scholarship_student_object->save();
                        }
                    }
                    if (sizeof($array_of_saved_scholarship) > 0) {
                        foreach ($array_of_saved_scholarship as $key => $value) {
                            $value->delete();
                        }
                    }
                }
            } else {
                if ($data['assign_radio_button'] == 'multiple_students') {
                    foreach ($data['student_ids'] as $student_id => $value) {
                        $scholarship_student = new AppScholarshipStudent;
                        $scholarship_student->scholarship_id = $data['scholarship_id'];
                        $scholarship_student->student_id = $student_id;
                        $scholarship_student->fee_name_id = $data['fee_name_id'];
                        $scholarship_student->yearly_applicable = isset($data['yearly_applicable']) ? ($data['yearly_applicable'] == 'on' ? 1 : 0) : 0;
                        $scholarship_student->billing_period_id = $data['billing_period_id'];
                        $scholarship_student->save();
                    }
                } else if ($data['assign_radio_button'] == 'multiple_scholarships') {
                    foreach ($data['scholarship_ids'] as $scholarship_id => $value) {
                        $scholarship_student = new AppScholarshipStudent;
                        $scholarship_student->scholarship_id = $scholarship_id;
                        $scholarship_student->student_id = $data['student_id'];
                        $scholarship_student->fee_name_id = $data['fee_name_id'];
                        $scholarship_student->yearly_applicable = isset($data['yearly_applicable']) ? ($data['yearly_applicable'] == 'on' ? 1 : 0) : 0;
                        $scholarship_student->billing_period_id = $data['billing_period_id'];
                        $scholarship_student->save();
                    }
                }
            }

            echo $scholarship_student->id;
        }
        break;

    case 'getFacultyForClass':
        $data = $request->all();
        $faculties = AppFaculty::where('class_id', $data['class_id'])->get();
        echo json_encode($faculties);
        break;

    case 'getSectionForClass':
        $data = $request->all();
        $sections = AppSection::where('class_id', $data['class_id'])->get();
        echo json_encode($sections);
        break;

    case 'getSubCategoriesForCategory':
        $data = $request->all();
        $sub_categories = Subcategory::where('category_id', $data['category_id'])->get();
        echo json_encode($sub_categories);
        break;

    case 'getStudentAndScholarship':
        $data = $request->all();
        $scholarships = AppScholarship::all();
        $where = [
            'class_id' => $data['class_id'],
            'student_type_id' => $data['student_type_id'],
        ];
        if ($data['faculty_id'] != 0) {
            $where['faculty_id'] = $data['faculty_id'];
        }
        if ($data['section_id'] != 0) {
            $where['section_id'] = $data['section_id'];
        }
        if ($data['category_id'] != 0) {
            $where['category_id'] = $data['category_id'];
            if ($data['sub_category_id'] != 0) {
                $where['sub_category_id'] = $data['sub_category_id'];
            }
        }
        $students = AppStudent::where($where)->get();
        $r['students'] = $students;
        $r['scholarships'] = $scholarships;
        echo json_encode($r);
        break;

    case 'getScholarshipsForStudent':
        $data = $request->all();
        $array_of_scholarship_student = AppScholarshipStudent::where(['student_id' => $data['student_id'], 'fee_name_id' => $data['fee_name_id']])->get();
        $selected_scholarships = array();
        if (sizeof($array_of_scholarship_student) > 0) {
            foreach ($array_of_scholarship_student as $scholarship_student)
                array_push($selected_scholarships, $scholarship_student->scholarship_id);
        }
        $scholarships = AppScholarship::all();
        $r['student_id'] = $data['student_id'];
        $r['scholarships'] = $scholarships;
        $r['selectedScholarships'] = $selected_scholarships;
        echo json_encode($r);
        break;

    case 'getStudentsForScholarship':
        $data = $request->all();
        $array_of_scholarship_student = AppScholarshipStudent::where(['scholarship_id' => $data['scholarship_id'], 'fee_name_id' => $data['fee_name_id']])->get();
        $scholarship = AppScholarship::find($data['scholarship_id']);
        $selected_students = array();
        if (sizeof($array_of_scholarship_student) > 0) {
            foreach ($array_of_scholarship_student as $scholarship_student)
                array_push($selected_students, $scholarship_student->student_id);
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
        $r['scholarship_id'] = $data['scholarship_id'];
        $r['students'] = $students;
        $r['selectedStudents'] = $selected_students;
        $r['scholarship'] = $scholarship;
        echo json_encode($r);
        break;
}
