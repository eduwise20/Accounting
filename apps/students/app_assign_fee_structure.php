<?php

require 'apps/classes/models/AppClass.php';
require 'apps/students/models/AppStudent.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/sections/models/AppSection.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/fee_names/models/AppFeeName.php';
require 'apps/students/models/AppFeeNameStudent.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'assign_fee_structure_to_students');
$ui->assign('_title', 'Assign Fee Structure to Students ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {

    case 'add':
        $classes = AppClass::all();
        $student_types = AppStudentType::all();
        $categories = Category::all();
        view('app_wrapper', [
            '_include' => 'assign_fee/add',
            'classes' => $classes,
            'student_types' => $student_types,
            'categories' => $categories,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate(
            $data,
            [
                'class_id' => 'required|not_in:0',
                'student_type_id' => 'required|not_in:0'
            ],
            [
                'class_id:not_in' => 'The Class is required',
                'student_type_id:not_in' => 'The Student type is required'
            ]
        );

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessages = $errors->firstOfAll();
            $msg = '';
            foreach ($errorMessages as $message) {
                $msg .= $message . '</br>';
            }
            echo $msg;
        } else {
            $array_of_fee_name_student = array();
            if ($data['assign_radio_button'] == 'multiple_students') {
                $array_of_fee_name_student = AppFeeNameStudent::where('fee_name_id', $data['fee_id'])->get();
            } else if ($data['assign_radio_button'] == 'multiple_fees') {
                $array_of_fee_name_student = AppFeeNameStudent::where('student_id', $data['student_id'])->get();
            }

            if (sizeof($array_of_fee_name_student) > 0) {
                if ($data['assign_radio_button'] == 'multiple_students') {

                    $array_of_student_id = array();
                    $array_of_saved_student = array();
                    foreach ($data['student_ids'] as $student_id => $value) {
                        array_push($array_of_student_id, $student_id);
                    }
                    foreach ($array_of_fee_name_student as $fee_name_student) {
                        $array_of_saved_student[$fee_name_student->student_id] = $fee_name_student;
                    }
                    foreach ($data['student_ids'] as $student_id => $value) {
                        foreach ($array_of_fee_name_student as $fee_name_student) {
                            if ($student_id == $fee_name_student->student_id) {
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
                            $fee_name_student_object = new AppFeeNameStudent;
                            $fee_name_student_object->fee_name_id = $data['fee_id'];
                            $fee_name_student_object->student_id = $student_id;
                            $fee_name_student_object->save();
                        }
                    }
                    if (sizeof($array_of_saved_student) > 0) {
                        foreach ($array_of_saved_student as $key => $value) {
                            $value->delete();
                        }
                    }
                } else if ($data['assign_radio_button'] == 'multiple_fees') {

                    $array_of_fee_name_id = array();
                    $array_of_saved_fee_name = array();
                    foreach ($data['fee_ids'] as $fee_id => $value) {
                        array_push($array_of_fee_name_id, $fee_id);
                    }
                    foreach ($array_of_fee_name_student as $fee_name_student) {
                        $array_of_saved_fee_name[$fee_name_student->fee_name_id] = $fee_name_student;
                    }
                    foreach ($data['fee_ids'] as $fee_id => $value) {

                        foreach ($array_of_fee_name_student as $fee_name_student) {
                            if ($fee_id == $fee_name_student->fee_name_id) {
                                if (($k = array_search($fee_id, $array_of_fee_name_id)) !== false) {
                                    unset($array_of_fee_name_id[$k]);
                                }
                                if (array_key_exists($fee_id, $array_of_saved_fee_name)) {
                                    unset($array_of_saved_fee_name[$fee_id]);
                                }
                            }
                        }
                    }
                    if (sizeof($array_of_fee_name_id) > 0) {
                        foreach ($array_of_fee_name_id as $fee_id) {
                            $fee_name_student_object = new AppFeeNameStudent;
                            $fee_name_student_object->fee_name_id = $fee_id;
                            $fee_name_student_object->student_id = $data['student_id'];
                            $fee_name_student_object->save();
                        }
                    }
                    if (sizeof($array_of_saved_fee_name) > 0) {
                        foreach ($array_of_saved_fee_name as $key => $value) {
                            $value->delete();
                        }
                    }
                }
            } else {
                if ($data['assign_radio_button'] == 'multiple_students') {
                    foreach ($data['student_ids'] as $student_id => $value) {
                        $fee_name_student = new AppFeeNameStudent;
                        $fee_name_student->fee_name_id = $data['fee_id'];
                        $fee_name_student->student_id = $student_id;
                        $fee_name_student->save();
                    }
                } else if ($data['assign_radio_button'] == 'multiple_fees') {
                    foreach ($data['fee_ids'] as $fee_id => $value) {
                        $fee_name_student = new AppFeeNameStudent;
                        $fee_name_student->fee_name_id = $fee_id;
                        $fee_name_student->student_id = $data['student_id'];
                        $fee_name_student->save();
                    }
                }
            }

            echo $fee_name_student->id;
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

    case 'getStudentAndFee':
        $data = $request->all();
        $fee_names = AppFeeName::all();
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
        $r['fee_names'] = $fee_names;
        echo json_encode($r);
        break;

    case 'getFeesForStudent':
        $data = $request->all();
        $array_of_fee_name_student = AppFeeNameStudent::where('student_id', $data['student_id'])->get();
        $selected_fees = array();
        if (sizeof($array_of_fee_name_student) > 0) {
            foreach ($array_of_fee_name_student as $fee_name_student)
                array_push($selected_fees, $fee_name_student->fee_name_id);
        }
        $fee_names = AppFeeName::all();
        $r['student_id'] = $data['student_id'];
        $r['fees'] = $fee_names;
        $r['selectedFees'] = $selected_fees;
        echo json_encode($r);
        break;

    case 'getStudentsForFee':
        $data = $request->all();
        $array_of_fee_name_student = AppFeeNameStudent::where('fee_name_id', $data['fee_id'])->get();
        $fee_name = AppFeeName::find($data['fee_id']);
        $selected_students = array();
        if (sizeof($array_of_fee_name_student) > 0) {
            foreach ($array_of_fee_name_student as $fee_name_student)
                array_push($selected_students, $fee_name_student->student_id);
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
        $r['fee_id'] = $data['fee_id'];
        $r['students'] = $students;
        $r['selectedStudents'] = $selected_students;
        $r['fee_name'] = $fee_name;
        echo json_encode($r);
        break;
}
