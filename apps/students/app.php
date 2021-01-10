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
                $student->sub_category = Subcategory::find($student->sub_category_id)->name;
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
            'gender' => 'required',
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
            $sections = AppSection::where('class_id', $student->class_id)->get();
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

    case 'getSectionForClass':
        $data = $request->all();
        $sections = AppSection::where('class_id', $data['class_id'])->get();
        echo json_encode($sections);
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
            $no_of_rows = $worksheet->getHighestDataRow();
            $highestColumn = $worksheet->getHighestDataColumn();
            $no_of_columns = PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
            $data = [];

            for ($currentRow = 1; $currentRow <= $no_of_rows; $currentRow++){ 
                $rowData = $worksheet->rangeToArray('A' . $currentRow . ':' . $highestColumn . $currentRow, NULL, TRUE, FALSE);
                if(isEmptyRow(reset($rowData))) { continue; }
                for ($currentCol = 1; $currentCol <= $no_of_columns; $currentCol++) {
                    $data[$currentRow - 1][$currentCol - 1] = $worksheet->getCellByColumnAndRow($currentCol, $currentRow)->getCalculatedValue();
                }
            }

            $error = false;

            $students_to_insert = array();
            $student_additional_informations_to_insert = array();

            $success_count = 0;
            $error_count = 0;
            $error_message = "";

            for ($i = 1; $i < sizeof($data); $i++) {

                $student = new AppStudent;
                $student_additional_information = new AppStudentAdditionalInformation;

                $student->name = $data[$i][0];
                $student->admission_no = $data[$i][1];
                $student->roll_no = $data[$i][2];
                $class = AppClass::where('name', $data[$i][3])->get();
                $faculties = [];
                if(sizeof($class) == 1) {
                    $faculties = AppFaculty::where('class_id', $class[0]->id)->get();
                }
                $exploded_section_name = explode(".", $data[$i][4]);
                $section = AppSection::where('name', $exploded_section_name[1])->where('class_id', $class[0]->id)->get();
                $category = Category::where('name', $data[$i][5])->get();
                $exploded_sub_category_name = explode(".", $data[$i][6]);
                $exploded_faculty_name = explode(".", $data[$i][8]);
                $sub_category = [];
                if(sizeof($category) == 1) {
                    $sub_category = Subcategory::where('name', $exploded_sub_category_name[1])->where('category_id', $category[0]->id)->get();
                }
                $student_type = AppStudentType::where('name', $data[$i][7])->get();
                $faculty = AppFaculty::where('name', $exploded_faculty_name)->get();
                if (sizeof($class) == 0) {
                    $error_message .= "You need to have class " . $data[$i][3] . "<br/>";
                    $error = true;
                }
                if (sizeof($class) > 1) {
                    $error_message .= "More than one class " . $data[$i][3] . " found<br/>";
                    $error = true;
                }
                if (sizeof($section) == 0) {
                    $error_message .= "You need to have section " . $data[$i][4] . "<br/>";
                    $error = true;
                }
                if (sizeof($section) > 1) {
                    $error_message .= "More than one section " . $data[$i][4] . " found<br/>";
                    $error = true;
                }
                if ($class[0]->name != $exploded_section_name[0]) {
                    $error_message .= "Section " . $exploded_section_name[1] . " doesn't belong to class " . $exploded_section_name[0] . "<br/>";
                    $error = true;
                }
                if ($data[$i][5] != '' && sizeof($category) == 0) {
                    $error_message .= "You need to have category " . $data[$i][5] . "<br/>";
                    $error = true;
                }
                if ($data[$i][5] != '' && sizeof($category) > 1) {
                    $error_message .= "More than one category " . $data[$i][5] . " found<br/>";
                    $error = true;
                }
                if ($data[$i][6] != '' && sizeof($sub_category) == 0) {
                    $error_message .= "You need to have sub category " . $data[$i][6] . "<br/>";
                    $error = true;
                }
                if ($data[$i][6] != '' && sizeof($sub_category) > 1) {
                    $error_message .= "More than one sub category " . $data[$i][6] . " found<br/>";
                    $error = true;
                }
                if (sizeof($sub_category) > 1 && $category[0]->name != $exploded_sub_category_name[0]) {
                    $error_message .= "Sub category " . $exploded_sub_category_name[1] . " doesn't belong to category " . $exploded_sub_category_name[0] . "<br/>";
                    $error = true;
                }
                if (sizeof($student_type) == 0) {
                    $error_message .= "You need to have student type " . $data[$i][7] . "<br/>";
                    $error = true;
                }
                if (sizeof($student_type) > 1) {
                    $error_message .= "More than one student type " . $data[$i][7] . " found<br/>";
                    $error = true;
                }
                if(AppStudent::where('roll_no', $data[$i][2])->count() > 0) {
                    $error_message .= "Roll no " . $data[$i][2] . " already exists.<br/>";
                    $error = true;
                }
                if(AppStudent::where('admission_no', $data[$i][1])->count() > 0) {
                    $error_message .= "Admission no " . $data[$i][1] . " already exists.<br/>";
                    $error = true;
                }
                if (sizeof($faculties) > 0 && $data[$i][8] != '' && sizeof($faculty) == 0) {
                    $error_message .= "You need to have faculty " . $data[$i][8] . "<br/>";
                    $error = true;
                }
                if (sizeof($faculties) > 0 && $data[$i][8] != '' && sizeof($faculty) > 1) {
                    $error_message .= "More than one faculty " . $data[$i][8] . " found<br/>";
                    $error = true;
                }
                if (!array_search($data[$i][9], $status)) {
                    $error_message .= "You need to have status " . $data[$i][9] . "<br/>";
                    $error = true;
                }
                if (!$error) {
                    $student->class_id = $class[0]->id;
                    $student->section_id = $section[0]->id;

                    if(sizeof($category) != 0) {
                        $student->category_id = $category[0]->id;
                    } else {
                        $student->category_id = 0;
                    }
                    if(sizeof($sub_category) != 0) {
                        $student->sub_category_id = $sub_category[0]->id;
                    } else {
                        $student->sub_category_id = 0;
                    }
                    $student->student_type_id = $student_type[0]->id;
                    if(sizeof($faculty) != 0) {
                        $student->faculty_id = $faculty[0]->id;
                    } else {
                        $student->faculty_id = 0;
                    }
                    $student->status = strtolower($data[$i][9]);
                    $student->remarks = $data[$i][16];
                    array_push($students_to_insert, $student);

                    $student_additional_information->phone = $data[$i][10];
                    $student_additional_information->current_address = $data[$i][11];
                    $student_additional_information->permanent_address = $data[$i][12];
                    $student_additional_information->parent_name = $data[$i][13];
                    $student_additional_information->local_guardian_name = $data[$i][14];
                    $student_additional_information->gender = $data[$i][15];
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
        $sections = AppSection::select('class_id', 'name')->get();
        $categories = Category::select('name')->get();
        $sub_categories = SubCategory::select('category_id', 'name')->get();
        $student_types = AppStudentType::select('name')->get();
        $faculties = AppFaculty::select('class_id', 'name')->get();
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
            $class_name = AppClass::find($section->class_id)->name;
            array_push($section_names, $class_name . "." . $section->name);
        }
        foreach ($categories as $category) {
            array_push($category_names, $category->name);
        }
        foreach ($sub_categories as $sub_category) {
            $category_name = Category::find($sub_category->category_id)->name;
            array_push($sub_category_names, $category_name . "." . $sub_category->name);
        }
        foreach ($student_types as $student_type) {
            array_push($student_type_names, $student_type->name);
        }
        foreach ($faculties as $faculty) {
            $class_name = AppClass::find($section->class_id)->name;
            array_push($faculty_names, $class_name . "." . $faculty->name);
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

function isEmptyRow($row) {
    foreach($row as $cell){
        if (null !== $cell) return false;
    }
    return true;
}