<?php

require 'apps/classes/models/AppClass.php';
require 'apps/students/models/AppStudent.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/sections/models/AppSection.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/fines/models/AppFine.php';
require 'apps/assign_fine_to_students/models/AppFineStudent.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'assign_fine_to_students');
$ui->assign('_title', 'Assign Fine to Students ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'add':
        $classes = AppClass::all();
        $student_types = AppStudentType::all();
        $sections = AppSection::all();
        $categories = Category::all();
        view('app_wrapper', [
            '_include' => 'add',
            'classes' => $classes,
            'student_types' => $student_types,
            'sections' => $sections,
            'categories' => $categories,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'class_id' => 'required|not_in:0',
            'student_type_id' => 'required|not_in:0'
        ],
            [
                'class_id:not_in' => 'The Class is required',
                'student_type_id:not_in' => 'The Student type is required'
            ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessages = $errors->firstOfAll();
            $msg = '';
            foreach ($errorMessages as $message) {
                $msg .= $message . '</br>';
            }
            echo $msg;
        } else {
            $array_of_fine_student = array();
            if ($data['assign_radio_button'] == 'multiple_students') {
                $array_of_fine_student = AppFineStudent::where('fine_id', $data['fine_id'])->get();
            } else if ($data['assign_radio_button'] == 'multiple_fines') {
                $array_of_fine_student = AppFineStudent::where('student_id', $data['student_id'])->get();
            }

            if (sizeof($array_of_fine_student) > 0) {
                if ($data['assign_radio_button'] == 'multiple_students') {

                    $array_of_student_id = array();
                    $array_of_saved_student = array();
                    foreach ($data['student_ids'] as $student_id => $value) {
                        array_push($array_of_student_id, $student_id);
                    }
                    foreach ($array_of_fine_student as $fine_student) {
                        $array_of_saved_student[$fine_student->student_id] = $fine_student;
                    }
                    foreach ($data['student_ids'] as $student_id => $value) {
                        foreach ($array_of_fine_student as $fine_student) {
                            if ($student_id == $fine_student->student_id) {
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
                            $fine_student_object = new AppFineStudent;
                            $fine_student_object->fine_id = $data['fine_id'];
                            $fine_student_object->student_id = $student_id;
                            $fine_student_object->save();
                        }
                    }
                    if (sizeof($array_of_saved_student) > 0) {
                        foreach ($array_of_saved_student as $key => $value) {
                            $value->delete();
                        }
                    }

                } else if ($data['assign_radio_button'] == 'multiple_fines') {

                    $array_of_fine_id = array();
                    $array_of_saved_fine = array();
                    foreach ($data['fine_ids'] as $fine_id => $value) {
                        array_push($array_of_fine_id, $fine_id);
                    }
                    foreach ($array_of_fine_student as $fine_student) {
                        $array_of_saved_fine[$fine_student->fine_id] = $fine_student;
                    }
                    foreach ($data['fine_ids'] as $fine_id => $value) {

                        foreach ($array_of_fine_student as $fine_student) {
                            if ($fine_id == $fine_student->fine_id) {
                                if (($k = array_search($fine_id, $array_of_fine_id)) !== false) {
                                    unset($array_of_fine_id[$k]);
                                }
                                if (array_key_exists($fine_id, $array_of_saved_fine)) {
                                    unset($array_of_saved_fine[$fine_id]);
                                }
                            }
                        }
                    }
                    if (sizeof($array_of_fine_id) > 0) {
                        foreach ($array_of_fine_id as $fine_id) {
                            $fine_student_object = new AppFineStudent;
                            $fine_student_object->fine_id = $fine_id;
                            $fine_student_object->student_id = $data['student_id'];
                            $fine_student_object->save();
                        }
                    }
                    if (sizeof($array_of_saved_fine) > 0) {
                        foreach ($array_of_saved_fine as $key => $value) {
                            $value->delete();
                        }
                    }

                }
            } else {
                if ($data['assign_radio_button'] == 'multiple_students') {
                    foreach ($data['student_ids'] as $student_id => $value) {
                        $fine_student = new AppFineStudent;
                        $fine_student->fine_id = $data['fine_id'];
                        $fine_student->student_id = $student_id;
                        $fine_student->save();
                    }
                } else if ($data['assign_radio_button'] == 'multiple_fines') {
                    foreach ($data['fine_ids'] as $fine_id => $value) {
                        $fine_student = new AppFineStudent;
                        $fine_student->fine_id = $fine_id;
                        $fine_student->student_id = $data['student_id'];
                        $fine_student->save();
                    }
                }
            }

            echo $fine_student->id;

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

    case 'getStudentAndFine':
        $data = $request->all();
        $fines = AppFine::all();
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
        $r['fines'] = $fines;
        echo json_encode($r);
        break;

    case 'getFinesForStudent':
        $data = $request->all();
        $array_of_fine_student = AppFineStudent::where('student_id', $data['student_id'])->get();
        $selected_fines = array();
        if (sizeof($array_of_fine_student) > 0) {
            foreach ($array_of_fine_student as $fine_student)
                array_push($selected_fines, $fine_student->fine_id);
        }
        $fines = AppFine::all();
        $r['fines'] = $fines;
        $r['selectedFines'] = $selected_fines;
        echo json_encode($r);
        break;

    case 'getStudentsForFine':
        $data = $request->all();
        $array_of_fine_student = AppFineStudent::where('fine_id', $data['fine_id'])->get();
        $fine = AppFine::find($data['fine_id']);
        $selected_students = array();
        if (sizeof($array_of_fine_student) > 0) {
            foreach ($array_of_fine_student as $fine_student)
                array_push($selected_students, $fine_student->student_id);
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
        $r['fine_id'] = $data['fine_id'];
        $r['students'] = $students;
        $r['selectedStudents'] = $selected_students;
        $r['fine'] = $fine;
        echo json_encode($r);
        break;
}