<?php

require 'apps/students/models/AppStudent.php';
require 'apps/students/models/AppStudentAdditionalInformation.php';
require 'apps/classes/models/AppClass.php';
require 'apps/sections/models/AppSection.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/faculties/models/AppFaculty.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'students');
$ui->assign('_title', 'Students ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

$status = [
    'active' => 'Active',
    'passed_out' => 'Passed out',
    'dropped_out' => 'Dropped out',
    'transferred' => 'Transferred',
    'resticate' => 'Resticate',
    'suspend' => 'Suspend',
    'semester_gap' => 'Semester gap',
];

switch ($action) {
    case 'list':
        $students = AppStudent::all()->map(function ($student) {
            $student->class = AppClass::find($student->class_id)->name;
            return $student;
        });
        view('app_wrapper', [
            '_include' => 'list',
            'students' => $students,
            'status' => $status,
        ]);
        break;

    case 'view':
        $id = route(3);
        $student = AppStudent::find($id);
        if (!$student) {
            $msg = "Student not found.";
            r2(U . 'students/app/list', 'e', $msg);
        } else {
            $student->class = AppClass::find($student->class_id)->name;
            if ($student->section_id != 0) {
                $student->section = AppSection::find($student->section_id)->name;
            }
            if ($student->category_id != 0) {
                $student->category = Category::find($student->category_id)->name;
            }
            if ($student->sub_category_id != 0) {
                $student->sub_category_id = Subcategory::find($student->sub_category_id)->name;
            }
            $student->student_type = AppStudentType::find($student->student_type_id)->name;
            if ($student->faculty_id != 0) {
                $student->faculty = AppFaculty::find($student->faculty_id)->name;
            }
            $student_additional_information = AppStudentAdditionalInformation::where('student_id', $student->id)->get();
            view('app_wrapper', [
                '_include' => 'view',
                'student' => $student,
                'student_additional_information' => $student_additional_information[0],
                'status' => $status
            ]);
        }
        break;

    case 'add':
        $classes = AppClass::all();
        $sections = AppSection::all();
        $categories = Category::all();
        $student_types = AppStudentType::all();
        view('app_wrapper', [
            '_include' => 'add',
            'classes' => $classes,
            'sections' => $sections,
            'categories' => $categories,
            'student_types' => $student_types,
            'status' => $status,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'admission_no' => 'required',
            'roll_no' => 'required',
            'class_id' => 'required|not_in:0',
            'student_type_id' => 'required|not_in:0',
            'status' => 'required|not_in:0',
        ],
            [
                'name:required' => 'The Full name is required',
                'admission_no:required' => 'The Admission number is required',
                'roll_no:required' => 'The Roll number is required',
                'class_id:not_in' => 'The Class is required',
                'student_type_id:not_in' => 'The Student type is required',
                'status:not_in' => 'The Status is required',
            ]
        );

        $faculties = AppFaculty::where('class_id', $data['class_id'])->get();
        if (sizeof($faculties) > 0) {
            $faculty_validator = new Validator();
            $faculty_validation = $faculty_validator->validate($data, [
                'faculty_id' => 'required|not_in:0'
            ],
                [
                    'faculty_id:not_in' => 'The faculty is required'
                ]);
        }

        if ($validation->fails() || (isset($faculty_validation) && $faculty_validation->fails())) {
            $errors = $validation->errors();
            $errorMessages = $errors->firstOfAll();
            $msg = '';
            foreach ($errorMessages as $message) {
                $msg .= $message . '</br>';
            }
            if (isset($faculty_validation)) {
                $faculty_errors = $faculty_validation->errors();
                $faculty_error_messages = $faculty_errors->firstOfAll();
                foreach ($faculty_error_messages as $message) {
                    $msg .= $message . '</br>';
                }
            }
            echo $msg;
        } else {
            if (isset($data['id']) && isset($data['student_additional_information_id'])) {
                $student = AppStudent::find($data['id']);
                $student_additional_information = AppStudentAdditionalInformation::find($data['student_additional_information_id']);
            } else {
                $student = new AppStudent;
                $student_additional_information = new AppStudentAdditionalInformation;
            }
            $student->name = $data['name'];
            $student->admission_no = $data['admission_no'];
            $student->roll_no = $data['roll_no'];
            $student->class_id = $data['class_id'];
            $student->section_id = $data['section_id'];
            $student->category_id = $data['category_id'];
            $student->sub_category_id = $data['sub_category_id'];
            $student->student_type_id = $data['student_type_id'];
            $student->faculty_id = $data['faculty_id'];
            $student->status = $data['status'];
            $student->remarks = $data['remarks'];
            $student->save();

            $student_additional_information->student_id = $student->id;
            $student_additional_information->phone = $data['phone'];
            $student_additional_information->current_address = $data['current_address'];
            $student_additional_information->permanent_address = $data['permanent_address'];
            $student_additional_information->parent_name = $data['parent_name'];
            $student_additional_information->local_guardian_name = $data['local_guardian_name'];
            $student_additional_information->gender = $data['gender'];
            $student_additional_information->save();

            echo $student->id;
        }

        break;

    case 'edit':
        $id = route(3);
        $student = AppStudent::find($id);
        if (!$student) {
            $msg = "Student not found.";
            r2(U . 'students/app/list', 'e', $msg);
        } else {
            $student_additional_information = AppStudentAdditionalInformation::where('student_id', $student->id)->get();
            $classes = AppClass::all();
            $sections = AppSection::all();
            $categories = Category::all();
            $sub_categories = Subcategory::all();
            $student_types = AppStudentType::all();
            $faculties = AppFaculty::all();
            view('app_wrapper', [
                '_include' => 'edit',
                'classes' => $classes,
                'sections' => $sections,
                'categories' => $categories,
                'student_types' => $student_types,
                'status' => $status,
                'sub_categories' => $sub_categories,
                'faculties' => $faculties,
                'student' => $student,
                'student_additional_information' => $student_additional_information[0]
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $student = AppStudent::find($id);
        if ($student) {
            $student_additional_information = AppStudentAdditionalInformation::where('student_id', $student->id)->get();
            $student_additional_information[0]->delete();
            $student->delete();
            $msg = "Student successfully deleted.";
            $alert = 's';
        }
        r2(U . 'students/app/list', $alert, $msg);
        break;

    case 'getSubCategoriesForCategory':
        $data = $request->all();
        $sub_categories = Subcategory::where('category_id', $data['category_id'])->get();
        echo json_encode($sub_categories);
        break;

    case 'getFacultyForClass':
        $data = $request->all();
        $faculties = AppFaculty::where('class_id', $data['class_id'])->get();
        echo json_encode($faculties);
        break;
}