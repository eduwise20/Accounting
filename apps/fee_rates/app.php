<?php

require 'apps/fee_rates/models/AppFeeRate.php';
require 'apps/fee_rates/models/AppFeeStructure.php';
require 'apps/fee_names/models/AppFeeName.php';
require 'apps/classes/models/AppClass.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/fiscal_years/models/FiscalYear.php';
require 'apps/student_types/models/AppStudentType.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'fee_rates');
$ui->assign('_title', 'Fee rates ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {

    case 'add':
        $fee_names = AppFeeName::all();
        $classes = AppClass::all();
        $fiscal_years = FiscalYear::all();
        $student_types = AppStudentType::all();
        $categories = Category::all();
        $sub_categories = Subcategory::all();

        view('app_wrapper', [
            '_include' => 'add',
            'fee_names' => $fee_names,
            'classes' => $classes,
            'fiscal_years' => $fiscal_years,
            'student_types' => $student_types,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'fiscal_year_id' => 'required|not_in:0',
            'class_id' => 'required|not_in:0',
            'student_type_id' => 'required|not_in:0'
        ],
            [
                'fiscal_year_id:not_in' => 'The Fiscal year is required',
                'class_id:not_in' => 'The Class is required',
                'student_type_id:not_in' => 'The Student type is required'
            ]);

        $fee_rate_info_validation = $validator->validate($data, [
            'amount' => 'array',
            'amount.*' => 'numeric'
        ],
            [
                'amount.*:numeric' => 'Amount must be numeric'
            ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessages = $errors->firstOfAll();
            $msg = '';
            foreach ($errorMessages as $message) {
                $msg .= $message . '</br>';
            }
            echo $msg;
        } else if ($fee_rate_info_validation->fails()) {
            $errorMessage = $fee_rate_info_validation->errors()->firstOfAll();
            echo $errorMessage[0];
        } else {
            $where = [
                'fiscal_year_id' => $data['fiscal_year_id'],
                'class_id' => $data['class_id'],
                'student_type_id' => $data['student_type_id'],
            ];
            if ($data['faculty_id'] != 0) {
                $where['faculty_id'] = $data['faculty_id'];
            }
            $fee_rate = AppFeeRate::where($where)->get();
            $fee_structures_to_save = array();
            if (sizeof($fee_rate) > 0) {
                $fee_rate = $fee_rate[0];
                $fee_structures = AppFeeStructure::where('fee_rate_id', $fee_rate->id)->get();
                if (sizeof($fee_structures) > 0 && sizeof($data["amount"]) > 0) {
                    $new_fee_structures = $data["amount"];
                    foreach ($fee_structures as $fee_structure) {
                        foreach ($data["amount"] as $key => $value) {
                            if ($fee_structure->fee_names_id == $key) {
                                $fee_structure->amount = $value;
                                unset($new_fee_structures[$key]);
                                $fee_structure->save();
                            }
                        }
                    }
                    if (sizeof($new_fee_structures) > 0) {
                        foreach($new_fee_structures as $key=>$value) {
                            $fee_structure_to_save = new AppFeeStructure;
                            $fee_structure_to_save->fee_rate_id = $fee_rate->id;
                            $fee_structure_to_save->fee_names_id = $key;
                            $fee_structure_to_save->amount = $value;
                            $fee_structure_to_save->save();
                        }
                    }
                } else {
                    foreach ($data["amount"] as $key => $value) {
                        $fee_structure_to_save = new AppFeeStructure;
                        $fee_structure_to_save->fee_rate_id = $fee_rate->id;
                        $fee_structure_to_save->fee_names_id = $key;
                        $fee_structure_to_save->amount = $value;
                        $fee_structure_to_save->save();
                    }
                }
            } else {
                $fee_rate = new AppFeeRate;
                $fee_rate->fiscal_year_id = $data['fiscal_year_id'];
                $fee_rate->class_id = $data['class_id'];
                $fee_rate->category_id = $data['category_id'];
                $fee_rate->sub_category_id = $data['sub_category_id'];
                $fee_rate->faculty_id = $data['faculty_id'];
                $fee_rate->student_type_id = $data['student_type_id'];
                $fee_rate->save();

                if (isset($data["amount"]) && is_array($data["amount"])) {
                    foreach ($data["amount"] as $key => $value) {
                        $fee_structure_to_save = new AppFeeStructure;
                        $fee_structure_to_save->fee_rate_id = $fee_rate->id;
                        $fee_structure_to_save->fee_names_id = $key;
                        $fee_structure_to_save->amount = $value;
                        $fee_structure_to_save->save();
                    }
                }
            }
            echo $fee_rate->id;

        }
        break;

    case 'getFacultyForClass':
        $data = $request->all();
        $faculties = AppFaculty::where('class_id', $data['class_id'])->get();
        echo json_encode($faculties);
        break;

    case 'getFeeStructuresForFeeRate':
        $data = $request->all();
        $where = [
            'fiscal_year_id' => $data['fiscal_year_id'],
            'class_id' => $data['class_id'],
            'student_type_id' => $data['student_type_id'],
        ];
        if ($data['faculty_id'] != 0) {
            $where['faculty_id'] = $data['faculty_id'];
        }
        $fee_rate = AppFeeRate::where($where)->get();
        $fee_structures = AppFeeStructure::where('fee_rate_id', $fee_rate[0]->id)->get();
        echo json_encode($fee_structures);
        break;

}