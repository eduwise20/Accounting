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
            $billing = new Billing;
            $billing->fee = $data['student_fee'][$i];
            $billing->fee_id = 1;
            $billing->month = 'Baisakh';
            $billing->fine = $data['student_fine'][$i];
            $billing->discount = $data['student_discount'][$i];
            $billing->scholarship = $data['student_scholarship'][$i];
            $billing->total_fee = $data['student_total_fee'][$i];
            $billing->generated_by_id = 1;
            $billing->fiscal_year_id = $data['fiscal_year_id'];
            $billing->save();
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
            $fee_names_for_student = array();
            foreach ($students as $student) {
                $fee_name_students = AppFeeNameStudent::where('student_id', $student->id)->get();
                foreach ($fee_name_students as $fee_name_student) {
                    $fee_name_for_student = AppFeeName::find($fee_name_student->fee_name_id);
                    array_push($fee_names_for_student, $fee_name_for_student);
                }

                $discount_amount = 0;
                if (sizeof($fee_names_for_student) > 0) {
                    $discount_ids = array();
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

                $scholarship_amount = 0;
                if (sizeof($fee_names_for_student) > 0) {
                    $scholarship_ids = array();
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

                $fee_amount = 0;
                $non_compulsary_fee_structures = array();
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
                            $fee_amount += $non_compulsary_fee_structure->amount;
                        }
                    }
                }
                $student->fee = $fee_amount;

                $fine_students = AppFineStudent::where(['student_id' => $student->id, 'billing_period_id' => $data['billing_period_id']])->get();
                $fine_amount = 0;
                if (sizeof($fine_students) > 0) {
                    foreach ($fine_students as $fine_student) {
                        $fine = AppFine::find($fine_student->fine_id);
                        if ($fine->type == "Amount") {
                            $fine_amount += $fine->amount;
                        } else if ($fine->type == "Percentage") {
                            $fine_amount += ($fee_amount * $fine->amount) / 100;
                        }
                    }
                }
                $student->fine = $fine_amount;
            }
        }

        echo json_encode($students);
        break;
}