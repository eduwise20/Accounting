<?php

require 'apps/classes/models/AppClass.php';
require 'apps/billing_periods/models/BillingPeriod.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/sections/models/AppSection.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/fiscal_years/models/FiscalYear.php';
require 'apps/students/models/AppStudent.php';
require 'apps/fines/models/AppFineStudent.php';
require 'apps/fines/models/AppFine.php';
require 'apps/fee_rates/models/AppFeeStructure.php';
require 'apps/fee_rates/models/AppFeeRate.php';
require 'apps/discounts/models/AppDiscount.php';
require 'apps/discounts/models/AppDiscountStudent.php';
require 'apps/scholarships/models/AppScholarship.php';
require 'apps/scholarships/models/AppScholarshipStudent.php';
require 'apps/fee_names/models/AppFeeName.php';
require 'apps/students/models/AppFeeNameStudent.php';
require 'apps/generate_bills/models/Billing.php';
require 'apps/generate_bills/models/BillingLog.php';
require 'apps/generate_bills/models/BillingUpdate.php';
require 'apps/generate_bills/models/BillingDiscount.php';
require 'apps/generate_bills/models/BillingFee.php';
require 'apps/generate_bills/models/BillingFine.php';
require 'apps/generate_bills/models/BillingScholarship.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'generate_bills');
$ui->assign('_title', 'Bills ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'generate_bills':
        $classes = AppClass::all();
        $billing_periods = BillingPeriod::all();
        $fiscal_years = FiscalYear::where('is_running', 1)->get();
        $faculties = AppFaculty::all();
        $categories = Category::all();
        $student_types = AppStudentType::all();
        $sections = AppSection::all();
        $fee_names = AppFeeName::all();
        view('app_wrapper', [
            '_include' => 'add',
            'classes' => $classes,
            'billing_periods' => $billing_periods,
            'fiscal_year' => $fiscal_years[0],
            'faculties' => $faculties,
            'categories' => $categories,
            'student_types' => $student_types,
            'sections' => $sections,
            'fee_names' => $fee_names
        ]);
        break;

    case 'save':
        $data = $request->all();
        for ($i = 0; $i < sizeof($data['student_id']); $i++) {
            $student_id = $data['student_id'][$i];
            $print_no = 1;
            $billing_queried = Billing::where([
                'student_id' => $student_id,
                'billing_period_id' => $data['billing_period_id'],
                'fiscal_year_id' => $data['fiscal_year_id']
            ])->orderBy('created_at', 'desc')->first();
            if ($billing_queried != null) {
                $print_no += $billing_queried->print_no;
            }
            $billing = new Billing;
            $billing->fee = $data['student_fee'][$student_id];
            $billing->month = date('m');
            $billing->fine = $data['student_fine'][$student_id];
            $billing->discount = $data['student_discount'][$student_id];
            $billing->scholarship = $data['student_scholarship'][$student_id];
            $billing->total_fee = $data['student_total_fee'][$student_id];
            $billing->generated_by_id = $user->id;
            $billing->billing_period_id = $data['billing_period_id'];
            $billing->student_id = $student_id;
            $billing->fiscal_year_id = $data['fiscal_year_id'];
            $billing->print_no = $print_no;
            $billing->save();

            if (is_numeric($billing->id)) {

                $student_fee_ids = $data['student_fee_id'][$student_id];
                $student_fee_id_array = str_getcsv($student_fee_ids);
                if (sizeof($student_fee_id_array) > 0) {
                    foreach ($student_fee_id_array as $student_fee_id) {
                        $billing_fee = new BillingFee;
                        $billing_fee->fee_id = $student_fee_id;
                        $billing_fee->billing_id = $billing->id;
                        $billing_fee->save();
                    }
                }

                $student_discount_ids = $data['student_discount_id'][$student_id];
                $student_discount_id_array = str_getcsv($student_discount_ids);
                if (sizeof($student_discount_id_array) > 0) {
                    foreach ($student_discount_id_array as $student_discount_id) {
                        $billing_discount = new BillingDiscount;
                        $billing_discount->discount_id = $student_discount_id;
                        $billing_discount->billing_id = $billing->id;
                        $billing_discount->save();
                    }
                }

                $student_scholarship_ids = $data['student_scholarship_id'][$student_id];
                $student_scholarship_id_array = str_getcsv($student_scholarship_ids);
                if (sizeof($student_scholarship_id_array) > 0) {
                    foreach ($student_scholarship_id_array as $student_scholarship_id) {
                        $billing_scholarship = new BillingScholarship;
                        $billing_scholarship->scholarship_id = $student_scholarship_id;
                        $billing_scholarship->billing_id = $billing->id;
                        $billing_scholarship->save();
                    }
                }

                $student_fine_ids = $data['student_fine_id'][$student_id];
                $student_fine_id_array = str_getcsv($student_fine_ids);
                if (sizeof($student_fine_id_array) > 0) {
                    foreach ($student_fine_id_array as $student_fine_id) {
                        $billing_fine = new BillingFine;
                        $billing_fine->fine_id = $student_fine_id;
                        $billing_fine->billing_id = $billing->id;
                        $billing_fine->save();
                    }
                }
            }
        }
        echo $billing->id;
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

    case 'getSectionForClass':
        $data = $request->all();
        $sections = AppSection::where('class_id', $data['class_id'])->get();
        echo json_encode($sections);
        break;

    case 'updateTotalFee':
        $data = $request->all();
        $billing_update = new BillingUpdate;
        $billing_update->from_fee = $data['old_fee'];
        $billing_update->to_fee = $data['new_fee'];
        $billing_update->creator_id = $data['student_id'];
        $billing_update->student_id = $data['student_id'];
        $billing_update->billing_period_id = $data['billing_period_id'];
        $billing_update->fiscal_year_id = $data['fiscal_year_id'];
        $billing_update->save();
        echo $billing_update->id;
        break;

    case 'get_students_with_bill_detail':
        $data = $request->all();
        $where = [
            'class_id' => $data['class_id'],
            'student_type_id' => $data['student_type_id']
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

        $fee_rate_where = [
            'fiscal_year_id' => $data['fiscal_year_id'],
            'class_id' => $data['class_id'],
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
            'faculty_id' => $data['faculty_id'],
            'student_type_id' => $data['student_type_id']
        ];
        $fee_rates = AppFeeRate::where($fee_rate_where)->get();

        // $fee_names = array();
        // $fee_name_ids = array();
        // foreach ($data['fee_names'] as $key => $value) {
        //     $fee_name = AppFeeName::find($key);
        //     array_push($fee_names, $fee_name);
        //     array_push($fee_name_ids, $key);
        // }

        $all_fees = AppFeeName::all();
        $all_fines = AppFine::all();
        $all_discounts = AppDiscount::all();
        $all_scholarships = AppScholarship::all();

        if (sizeof($students) > 0) {
            foreach ($students as $student) {
                $billing_update = BillingUpdate::where([
                    'student_id' => $student->id,
                    'billing_period_id' => $data['billing_period_id'],
                    'fiscal_year_id' => $data['fiscal_year_id']
                ])->orderBy('created_at', 'desc')->first();
                if ($billing_update != null) {
                    $student->total_fee = $billing_update->to_fee;
                }
            }
            $fee_names_for_student = array();
            foreach ($students as $student) {
                $student->fee_names = array();
                $student_fee_names = $student->fee_names;
                for ($i = 0; $i < sizeof($all_fees); $i++) {
                    foreach ($fee_rates as $fee_rate) {
                        if ($all_fees[$i]->is_compulsary != 1) {
                            $fee_name_for_student = AppFeeNameStudent::where(['student_id' => $student->id, 'fee_name_id' => $all_fees[$i]->id])->first();
                            if ($fee_name_for_student != null) {
                                $fee_structure_queried = AppFeeStructure::where(['fee_names_id' => $fee_name_for_student->fee_name_id, 'fee_rate_id' => $fee_rate->id])->first();
                                $student_fee_names[$i] = $fee_structure_queried->amount;
                            } else {
                                $student_fee_names[$i] = 0;
                            }
                        } else {
                            $fee_structure_queried = AppFeeStructure::where(['fee_names_id' => $all_fees[$i]->id, 'fee_rate_id' => $fee_rate->id])->first();
                            $student_fee_names[$i] = $fee_structure_queried->amount;
                        }
                    }
                }
                $student->fee_names = $student_fee_names;

                $total_fee_for_student = 0;

                if (sizeof($student_fee_names) > 0) {
                    foreach ($student_fee_names as $student_fee_name) {
                        $total_fee_for_student += $student_fee_name;
                    }
                }
                $student->total_fee_for_student = $total_fee_for_student;

                $student->discounts = array();
                $student_discounts = $student->discounts;
                if (sizeof($student_fee_names) > 0) {
                    foreach ($all_fees as $all_fee) {
                        for ($i = 0; $i < sizeof($all_discounts); $i++) {
                            if (!isset($student_discounts[$i])) {
                                $student_discounts[$i] = 0;
                            }
                            if ($all_fee->is_discount_applicable == 1) {
                                $fee_structure_student_discounts = AppDiscountStudent::where(['student_id' => $student->id, 'fee_name_id' => $all_fee->id, 'discount_id' => $all_discounts[$i]->id])->get();
                                if (sizeof($fee_structure_student_discounts) > 0) {
                                    foreach ($fee_structure_student_discounts as $fee_structure_student_discount) {
                                        if ($fee_structure_student_discount->billing_period_id == $data['billing_period_id'] || $fee_structure_student_discount->yearly_applicable == 1) {
                                            $discount = AppDiscount::find($fee_structure_student_discount->discount_id);
                                            foreach ($fee_rates as $fee_rate) {
                                                $fee_structure = AppFeeStructure::where(['fee_names_id' => $all_fee->id, 'fee_rate_id' => $fee_rate->id])->first();
                                                if ($discount->type == "Amount") {
                                                    $student_discounts[$i] += $discount->amount;
                                                } else if ($discount->type == "Percentage") {
                                                    $student_discounts[$i] += $fee_structure->amount * $discount->amount / 100;
                                                } else {
                                                    $student_discounts[$i] += 0;
                                                }
                                            }
                                        } else {
                                            $student_discounts[$i] += 0;
                                        }
                                    }
                                } else {
                                    $student_discounts[$i] += 0;
                                }
                            } else {
                                $student_discounts[$i] += 0;
                            }
                        }
                    }
                }
                $student->discounts = $student_discounts;

                $student->scholarships = array();
                $student_scholarships = $student->scholarships;
                if (sizeof($student_fee_names) > 0) {
                    foreach ($all_fees as $all_fee) {
                        for ($i = 0; $i < sizeof($all_scholarships); $i++) {
                            if (!isset($student_scholarships[$i])) {
                                $student_scholarships[$i] = 0;
                            }
                            if ($all_fee->is_scholarship_applicable == 1) {
                                $fee_structure_student_scholarships = AppScholarshipStudent::where(['student_id' => $student->id, 'fee_name_id' => $all_fee->id, 'scholarship_id' => $all_scholarships[$i]->id])->get();
                                if (sizeof($fee_structure_student_scholarships) > 0) {
                                    foreach ($fee_structure_student_scholarships as $fee_structure_student_scholarship) {
                                        if ($fee_structure_student_scholarship->billing_period_id == $data['billing_period_id'] || $fee_structure_student_scholarship->yearly_applicable == 1) {
                                            $scholarship = AppScholarship::find($fee_structure_student_scholarship->scholarship_id);
                                            foreach ($fee_rates as $fee_rate) {
                                                $fee_structure = AppFeeStructure::where(['fee_names_id' => $all_fee->id, 'fee_rate_id' => $fee_rate->id])->first();
                                                if ($scholarship->type == "Amount") {
                                                    $student_scholarships[$i] += $scholarship->amount;
                                                } else if ($scholarship->type == "Percentage") {
                                                    $student_scholarships[$i] += $fee_structure->amount * $scholarship->amount / 100;
                                                } else {
                                                    $student_scholarships[$i] += 0;
                                                }
                                            }
                                        } else {
                                            $student_scholarships[$i] += 0;
                                        }
                                    }
                                } else {
                                    $student_scholarships[$i] += 0;
                                }
                            } else {
                                $student_scholarships[$i] += 0;
                            }
                        }
                    }
                }
                $student->scholarships = $student_scholarships;

                $student->fines = array();
                $student_fines = $student->fines;
                if (sizeof($student_fee_names) > 0) {
                    for ($i = 0; $i < sizeof($all_fines); $i++) {
                        if (!isset($student_fines[$i])) {
                            $student_fines[$i] = 0;
                        }
                        $fine_student = AppFineStudent::where(['fine_id' => $all_fines[$i]->id, 'student_id' => $student->id, 'billing_period_id' => $data['billing_period_id']])->first();
                        if ($fine_student) {
                            if ($all_fines[$i]->type == "Amount") {
                                $student_fines[$i] += $all_fines[$i]->amount;
                            } else if ($all_fines[$i]->type == "Percentage") {
                                $student_fines[$i] += ($total_fee_for_student * $all_fines[$i]->amount) / 100;
                            }
                        } else {
                            $student_fines[$i] += 0;
                        }
                    }
                }
                $student->fines = $student_fines;
            }
        }
        echo json_encode(['students' => $students, 'fines' => $all_fines, 'fees' => $all_fees, 'discounts' => $all_discounts, 'scholarships' => $all_scholarships]);
        break;
}
