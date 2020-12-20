<?php

require 'apps/students/models/AppStudent.php';
require 'apps/students/models/AppStudentAdditionalInformation.php';
require 'apps/classes/models/AppClass.php';
require 'apps/sections/models/AppSection.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/faculties/models/AppFaculty.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
            '_include' => 'student/list',
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
                '_include' => 'student/view',
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
            '_include' => 'student/add',
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
                '_include' => 'student/edit',
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

    case 'import_excel' :
        view('app_wrapper', [
            '_include' => 'student/students_import'
        ]);
        break;

    case 'excel_upload' :
        $uploader = new Uploader();
        $uploader->setDir('storage/temp/');
        $uploader->setExtensions(array('xls', 'xlsx'));
        if ($uploader->uploadFile('file')) {
            $uploaded = $uploader->getUploadName();

            $_SESSION['uploaded'] = $uploaded;

        } else {
            _msglog('e', $uploader->getMessage());
        }
        break;

    case 'excel_uploaded':
        if (isset($_SESSION['uploaded'])) {
            $uploaded = $_SESSION['uploaded'];
            $spreadsheet = PhpOffice\PhpSpreadsheet\IOFactory::load('storage/temp/' . $uploaded);
            $worksheet = $spreadsheet->getActiveSheet();
            $rows = [];
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
                $cells = [];
                foreach ($cellIterator as $cell) {
                    $cells[] = $cell->getValue();
                }
                $rows[] = $cells;
            }

            $error = false;

            $students_to_insert = array();
            $student_additional_informations_to_insert = array();

            $success_count = 0;
            $error_count = 0;
            $error_message = "";

            for ($i = 1; $i < sizeof($rows); $i++) {

                $student = new AppStudent;
                $student_additional_information = new AppStudentAdditionalInformation;

                $student->name = $rows[$i][0];
                $student->admission_no = $rows[$i][1];
                $student->roll_no = $rows[$i][2];
                $class = AppClass::where('name', $rows[$i][3])->get();
                $section = AppSection::where('name', $rows[$i][4])->get();
                $category = Category::where('name', $rows[$i][5])->get();
                $sub_category = Subcategory::where('name', $rows[$i][6])->get();
                $student_type = AppStudentType::where('name', $rows[$i][7])->get();
                $faculty = AppFaculty::where('name', $rows[$i][8])->get();
                if (sizeof($class) == 0) {
                    $error_message .= "You need to have class " . $rows[$i][3] . "<br/>";
                    $error = true;
                }
                if (sizeof($class) > 1) {
                    $error_message .= "More than one class " . $rows[$i][3] . " found<br/>";
                    $error = true;
                }
                if (sizeof($section) == 0) {
                    $error_message .= "You need to have section " . $rows[$i][4] . "<br/>";
                    $error = true;
                }
                if (sizeof($section) > 1) {
                    $error_message .= "More than one section " . $rows[$i][4] . " found<br/>";
                    $error = true;
                }
                if ($rows[$i][5] != '' && sizeof($category) == 0) {
                    $error_message .= "You need to have category " . $rows[$i][5] . "<br/>";
                    $error = true;
                }
                if ($rows[$i][5] != '' && sizeof($category) > 1) {
                    $error_message .= "More than one category " . $rows[$i][5] . " found<br/>";
                    $error = true;
                }
                if ($rows[$i][6] != '' && sizeof($sub_category) == 0) {
                    $error_message .= "You need to have sub category " . $rows[$i][6] . "<br/>";
                    $error = true;
                }
                if ($rows[$i][6] != '' && sizeof($sub_category) > 1) {
                    $error_message .= "More than one sub category " . $rows[$i][6] . " found<br/>";
                    $error = true;
                }
                if (sizeof($student_type) == 0) {
                    $error_message .= "You need to have student type " . $rows[$i][7] . "<br/>";
                    $error = true;
                }
                if (sizeof($student_type) > 1) {
                    $error_message .= "More than one student type " . $rows[$i][7] . " found<br/>";
                    $error = true;
                }
                if ($rows[$i][8] != '' && sizeof($faculty) == 0) {
                    $error_message .= "You need to have faculty " . $rows[$i][8] . "<br/>";
                    $error = true;
                }
                if ($rows[$i][8] != '' && sizeof($faculty) > 1) {
                    $error_message .= "More than one faculty " . $rows[$i][8] . " found<br/>";
                    $error = true;
                }
                if (!array_search($rows[$i][9], $status)) {
                    $error_message .= "You need to have status " . $rows[$i][9] . "<br/>";
                    $error = true;
                }
                if (!$error) {
                    $student->class_id = $class[0]->id;
                    $student->section_id = $section[0]->id;
                    $student->category_id = $category[0]->id;
                    $student->sub_category_id = $sub_category[0]->id;
                    $student->student_type_id = $student_type[0]->id;
                    $student->faculty_id = $faculty[0]->id;
                    $student->status = array_search($rows[$i][9], $status);
                    $student->remarks = $rows[$i][15];
                    array_push($students_to_insert, $student);

                    $student_additional_information->phone = $rows[$i][10];
                    $student_additional_information->current_address = $rows[$i][11];
                    $student_additional_information->permanent_address = $rows[$i][12];
                    $student_additional_information->parent_name = $rows[$i][13];
                    $student_additional_information->local_guardian_name = $rows[$i][14];
                    $student_additional_information->gender = $rows[$i][16];
                    array_push($student_additional_informations_to_insert, $student_additional_information);
                }
            }
            if ($error) {
                _msglog('e', 'Following errors occurred while adding students : <br/> ' . $error_message);
            } else if (sizeof($students_to_insert) > 0) {
                for ($i = 0; $i < sizeof($students_to_insert); $i++) {
                    $student_to_insert = $students_to_insert[$i];
                    $student_to_insert->save();

                    $student_additional_information_to_insert = $student_additional_informations_to_insert[$i];
                    $student_additional_information_to_insert->student_id = $student_to_insert->id;
                    $student_additional_information_to_insert->save();
                }
                _msglog('s', sizeof($students_to_insert) . ' Students Imported');
            } else {
                _msglog('e', 'No students to add');
            }
        } else {
            _msglog('e', 'An Error Occurred while uploading the files');
        }
        break;

    case 'download_excel_file' :
        $spreadsheet = new Spreadsheet();
        $spreadsheet->getProperties()->setCreator('PhpOffice')
            ->setLastModifiedBy('PhpOffice')
            ->setTitle('Excel File')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('PhpOffice')
            ->setKeywords('PhpOffice')
            ->setCategory('PhpOffice');
        $spreadsheet->createSheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Full Name');
        $sheet->setCellValue('B1', 'Admission Number');
        $sheet->setCellValue('C1', 'Roll Number');
        $sheet->setCellValue('D1', 'Class');
        $sheet->setCellValue('E1', 'Section');
        $sheet->setCellValue('F1', 'Category');
        $sheet->setCellValue('G1', 'Sub Category');
        $sheet->setCellValue('H1', 'Student Type');
        $sheet->setCellValue('I1', 'Faculty');
        $sheet->setCellValue('J1', 'Status');
        $sheet->setCellValue('K1', 'Phone');
        $sheet->setCellValue('L1', 'Current Address');
        $sheet->setCellValue('M1', 'Permanent Address');
        $sheet->setCellValue('N1', 'Parent Name');
        $sheet->setCellValue('O1', 'Local Guardian Name');
        $sheet->setCellValue('P1', 'Gender');
        $sheet->setCellValue('Q1', 'Remarks');
        $classes = AppClass::select('name')->get();
        $sections = AppSection::select('name')->get();
        $categories = Category::select('name')->get();
        $sub_categories = SubCategory::select('name')->get();
        $student_types = AppStudentType::select('name')->get();
        $faculties = AppFaculty::select('name')->get();
        $class_names = array();
        $section_names = array();
        $category_names = array();
        $sub_category_names = array();
        $student_type_names = array();
        $faculty_names = array();
        $status_names = array();
        $gender_names = ['Male', 'Female'];
        foreach ($classes as $class) {
            array_push($class_names, $class->name);
        }
        foreach ($sections as $section) {
            array_push($section_names, $section->name);
        }
        foreach ($categories as $category) {
            array_push($category_names, $category->name);
        }
        foreach ($sub_categories as $sub_category) {
            array_push($sub_category_names, $sub_category->name);
        }
        foreach ($student_types as $student_type) {
            array_push($student_type_names, $student_type->name);
        }
        foreach ($faculties as $faculty) {
            array_push($faculty_names, $faculty->name);
        }
        foreach ($status as $key => $value) {
            array_push($status_names, $value);
        }
        set_dropdown('D', $class_names, $sheet);
        set_dropdown('E', $section_names, $sheet);
        set_dropdown('F', $category_names, $sheet);
        set_dropdown('G', $sub_category_names, $sheet);
        set_dropdown('H', $student_type_names, $sheet);
        set_dropdown('I', $faculty_names, $sheet);
        set_dropdown('J', $status_names, $sheet);
        set_dropdown('P', $gender_names, $sheet);


        $spreadsheet->setActiveSheetIndex(0);
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . 'Sample Student File' . '.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
}

function set_dropdown($column_name, $array_to_set, $sheet)
{
    for ($i = 2; $i <= 500; $i++) {
        $objValidation = $sheet->getCell($column_name . $i)->getDataValidation();
        $objValidation->setType(PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST);
        $objValidation->setErrorStyle(PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION);
        $objValidation->setAllowBlank(false);
        $objValidation->setShowInputMessage(true);
        $objValidation->setShowErrorMessage(true);
        $objValidation->setShowDropDown(true);
        $objValidation->setErrorTitle('Input error');
        $objValidation->setError('Value is not in list.');
        $objValidation->setFormula1('"' . implode(',', $array_to_set) . '"');
    }
}