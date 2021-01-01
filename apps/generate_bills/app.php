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
        for($i = 0; $i < sizeof($data['student_id']); $i++) {
            $student_id = $data['student_id'][$i];
            $print_no = 1;
            $billing_queried = Billing::where([
                'student_id' => $student_id,
                'billing_period_id' => $data['billing_period_id'],
                'fiscal_year_id' => $data['fiscal_year_id']
            ])->orderBy('created_at', 'desc')->first();
            if($billing_queried != null) {
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
            'section_id' => $data['section_id'],
            'student_type_id' => $data['student_type_id'],
            'faculty_id' => $data['faculty_id'],
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id']
        ];
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

        $fee_names = array();
        $fee_name_ids = array();
        foreach ($data['fee_names'] as $key => $value) {
            $fee_name = AppFeeName::find($key);
            array_push($fee_names, $fee_name);
            array_push($fee_name_ids, $key);
        }

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
                $fee_name_students = AppFeeNameStudent::where('student_id', $student->id)->get();
                foreach ($fee_name_students as $fee_name_student) {
                    $fee_name_for_student = AppFeeName::find($fee_name_student->fee_name_id);
                    array_push($fee_names_for_student, $fee_name_for_student);
                }

                $discount_amount = 0;
                $discount_ids = array();
                if (sizeof($fee_names_for_student) > 0) {
                    foreach ($fee_names_for_student as $fee_name_for_student) {
                        if ($fee_name_for_student->is_compulsory == 1 || in_array($fee_name_for_student->id, $fee_name_ids)) {
                            if ($fee_name_for_student->is_discount_applicable == 1) {
                                $fee_structure_student_discounts = AppDiscountStudent::where(['student_id' => $student->id, 'fee_name_id' => $fee_name_for_student->id])->get();
                                foreach ($fee_structure_student_discounts as $fee_structure_student_discount) {
                                    if ($fee_structure_student_discount->billing_period_id == $data['billing_period_id'] || $fee_structure_student_discount->yearly_applicable == 1) {
                                        array_push($discount_ids, $fee_structure_student_discount->discount_id);
                                    }
                                }
                            }
                        }
                        $fee_structure = AppFeeStructure::where(['fee_names_id' => $fee_name_for_student->id, 'fee_rate_id' => $fee_rates[0]->id])->first();
                        $fee_amount = $fee_structure->amount;
                        $discounts = AppDiscount::whereIn('id', $discount_ids)->get();
                        foreach ($discounts as $discount) {
                            if ($discount->type == "Amount") {
                                $discount_amount += $discount->amount;
                            } else if ($discount->type == "Percentage") {
                                $discount_amount += $discount->amount * $fee_amount / 100;
                            }
                        }

                    }

                }
                $student->discount = $discount_amount;
                $student->discount_ids = $discount_ids;

                $scholarship_amount = 0;
                $scholarship_ids = array();
                if (sizeof($fee_names_for_student) > 0) {
                    foreach ($fee_names_for_student as $fee_name_for_student) {
                        if ($fee_name_for_student->is_compulsory == 1 || in_array($fee_name_for_student->id, $fee_name_ids)) {
                            if ($fee_name_for_student->is_scholarship_applicable == 1) {
                                $fee_structure_student_scholarships = AppScholarshipStudent::where(['student_id' => $student->id, 'fee_name_id' => $fee_name_for_student->id])->get();
                                foreach ($fee_structure_student_scholarships as $fee_structure_student_scholarship) {
                                    if ($fee_structure_student_scholarship->billing_period_id == $data['billing_period_id'] || $fee_structure_student_scholarship->yearly_applicable == 1) {
                                        array_push($scholarship_ids, $fee_structure_student_scholarship->scholarship_id);
                                    }
                                }
                            }
                        }
                        $fee_structure = AppFeeStructure::where(['fee_names_id' => $fee_name_for_student->id, 'fee_rate_id' => $fee_rates[0]->id])->first();
                        $fee_amount = $fee_structure->amount;
                        $scholarships = AppScholarship::whereIn('id', $scholarship_ids)->get();
                        foreach ($scholarships as $scholarship) {
                            if ($scholarship->type == "Amount") {
                                $scholarship_amount += $scholarship->amount;
                            } else if ($scholarship->type == "Percentage") {
                                $scholarship_amount += $scholarship->amount * $fee_amount / 100;
                            }
                        }

                    }

                }
                $student->scholarship = $scholarship_amount;
                $student->scholarship_ids = $scholarship_ids;

                $fee_amount = 0;
                $non_compulsary_fee_structures = array();
                $fee_ids = array();
                if (sizeof($fee_names) > 0) {
                    foreach ($fee_names as $fee_name) {
                        foreach ($fee_rates as $fee_rate) {
                            $non_compulsary_fee_structure_queried = AppFeeStructure::where(['fee_rate_id' => $fee_rate->id, 'fee_names_id' => $fee_name->id])->get();
                            if (sizeof($non_compulsary_fee_structure_queried) > 0) {
                                foreach ($non_compulsary_fee_structure_queried as $fee_structure_query) {
                                    array_push($non_compulsary_fee_structures, $fee_structure_query);
                                }
                            }
                        }
                    }
                    if (sizeof($non_compulsary_fee_structures) > 0) {
                        foreach ($non_compulsary_fee_structures as $non_compulsary_fee_structure) {
                            array_push($fee_ids, $non_compulsary_fee_structure->id);
                            $fee_amount += $non_compulsary_fee_structure->amount;
                        }
                    }
                }
                $student->fee = $fee_amount;
                $student->fee_ids = $fee_ids;

                $fine_students = AppFineStudent::where(['student_id' => $student->id, 'billing_period_id' => $data['billing_period_id']])->get();
                $fine_amount = 0;
                $fine_ids = array();
                if (sizeof($fine_students) > 0) {
                    foreach ($fine_students as $fine_student) {
                        $fine = AppFine::find($fine_student->fine_id);
                        array_push($fine_ids, $fine->id);
                        if ($fine->type == "Amount") {
                            $fine_amount += $fine->amount;
                        } else if ($fine->type == "Percentage") {
                            $fine_amount += ($fee_amount * $fine->amount) / 100;
                        }
                    }
                }
                $student->fine = $fine_amount;
                $student->fine_ids = $fine_ids;
                if (!isset($student->total_fee)){
                    $student->total_fee = $student->fee + $student->fine - $student->discount - $student->scholarship;
                }
            }
        }

        echo json_encode($students);
        break;
}