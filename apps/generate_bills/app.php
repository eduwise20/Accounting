<?php

use Dompdf\Generate_Pdf;

require 'apps/classes/models/AppClass.php';
require 'apps/billing_periods/models/BillingPeriod.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/sections/models/AppSection.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/fiscal_years/models/FiscalYear.php';
require 'apps/students/models/AppStudent.php';
require 'apps/students/models/AppStudentAdditionalInformation.php';
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
require 'apps/generate_bills/generate_pdf.php';

use Mhtml2pdf as Mhtml;
// use Spipu\Html2Pdf\Html2Pdf;
require 'vendor/mpdf/vendor/autoload.php';

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
        $student_fees = $data['studentFees'];
        $student_fines = $data['studentFines'];
        $student_discounts = $data['studentDiscounts'];
        $student_scholarships = $data['studentScholarships'];
        $total_fees = $data['total_fee'];
        $student_ids = [];

        foreach ($total_fees as $key => $total_fee) {
            array_push($student_ids, $key);
        }

        foreach ($student_ids as $student_id) {
            $student_fees_for_student_id = $student_fees[$student_id];

            $student_total_fee = 0;

            foreach ($student_fees_for_student_id as $fee_id => $fee_value) {
                $student_total_fee += $fee_value;

                $billing_fee = BillingFee::where([
                    'class_id' => $data['class_id'],
                    'section_id' => $data['section_id'],
                    'faculty_id' => $data['faculty_id'],
                    'student_type_id' => $data['student_type_id'],
                    'category_id' => $data['category_id'],
                    'sub_category_id' => $data['sub_category_id'],
                    'billing_period_id' => $data['billing_period_id'],
                    'fee_id' => $fee_id,
                    'student_id' => $student_id,
                ])->orderBy('created_at', 'desc')->first();

                $new_billing_fee = new BillingFee;
                $new_billing_fee->class_id = $data['class_id'];
                $new_billing_fee->section_id = $data['section_id'];
                $new_billing_fee->faculty_id = $data['faculty_id'];
                $new_billing_fee->student_type_id = $data['student_type_id'];
                $new_billing_fee->category_id = $data['category_id'];
                $new_billing_fee->sub_category_id = $data['sub_category_id'];
                $new_billing_fee->billing_period_id = $data['billing_period_id'];
                $new_billing_fee->fee_id = $fee_id;
                $new_billing_fee->student_id = $student_id;
                $new_billing_fee->from_fee = $billing_fee->to_fee;
                $new_billing_fee->to_fee = $fee_value;
                $new_billing_fee->creator_id = $user->id;
                $new_billing_fee->is_saved = 1;
                $new_billing_fee->save();
            }

            $student_fines_for_student_id = $student_fines[$student_id];

            $student_total_fine = 0;

            foreach ($student_fines_for_student_id as $fine_id => $fine_value) {
                $student_total_fine += $fine_value;

                $billing_fine = BillingFine::where([
                    'class_id' => $data['class_id'],
                    'section_id' => $data['section_id'],
                    'faculty_id' => $data['faculty_id'],
                    'student_type_id' => $data['student_type_id'],
                    'category_id' => $data['category_id'],
                    'sub_category_id' => $data['sub_category_id'],
                    'billing_period_id' => $data['billing_period_id'],
                    'fine_id' => $fine_id,
                    'student_id' => $student_id,
                ])->orderBy('created_at', 'desc')->first();

                $new_billing_fine = new BillingFine;
                $new_billing_fine->class_id = $data['class_id'];
                $new_billing_fine->section_id = $data['section_id'];
                $new_billing_fine->faculty_id = $data['faculty_id'];
                $new_billing_fine->student_type_id = $data['student_type_id'];
                $new_billing_fine->category_id = $data['category_id'];
                $new_billing_fine->sub_category_id = $data['sub_category_id'];
                $new_billing_fine->billing_period_id = $data['billing_period_id'];
                $new_billing_fine->fine_id = $fine_id;
                $new_billing_fine->student_id = $student_id;
                $new_billing_fine->from_fine = $billing_fine->to_fine;
                $new_billing_fine->to_fine = $fine_value;
                $new_billing_fine->creator_id = $user->id;
                $new_billing_fine->is_saved = 1;
                $new_billing_fine->save();
            }

            $student_discounts_for_student_id = $student_discounts[$student_id];

            $student_total_discount = 0;

            foreach ($student_discounts_for_student_id as $discount_id => $discount_value) {
                $student_total_discount += $discount_value;

                $billing_discount = BillingDiscount::where([
                    'class_id' => $data['class_id'],
                    'section_id' => $data['section_id'],
                    'faculty_id' => $data['faculty_id'],
                    'student_type_id' => $data['student_type_id'],
                    'category_id' => $data['category_id'],
                    'sub_category_id' => $data['sub_category_id'],
                    'billing_period_id' => $data['billing_period_id'],
                    'discount_id' => $discount_id,
                    'student_id' => $student_id,
                ])->orderBy('created_at', 'desc')->first();

                $new_billing_discount = new BillingDiscount;
                $new_billing_discount->class_id = $data['class_id'];
                $new_billing_discount->section_id = $data['section_id'];
                $new_billing_discount->faculty_id = $data['faculty_id'];
                $new_billing_discount->student_type_id = $data['student_type_id'];
                $new_billing_discount->category_id = $data['category_id'];
                $new_billing_discount->sub_category_id = $data['sub_category_id'];
                $new_billing_discount->billing_period_id = $data['billing_period_id'];
                $new_billing_discount->discount_id = $discount_id;
                $new_billing_discount->student_id = $student_id;
                $new_billing_discount->from_discount = $billing_discount->to_discount;
                $new_billing_discount->to_discount = $discount_value;
                $new_billing_discount->creator_id = $user->id;
                $new_billing_discount->is_saved = 1;
                $new_billing_discount->save();
            }

            $student_scholarships_for_student_id = $student_scholarships[$student_id];

            $student_total_scholarship = 0;

            foreach ($student_scholarships_for_student_id as $scholarship_id => $scholarship_value) {
                $student_total_scholarship += $scholarship_value;

                $billing_scholarship = BillingScholarship::where([
                    'class_id' => $data['class_id'],
                    'section_id' => $data['section_id'],
                    'faculty_id' => $data['faculty_id'],
                    'student_type_id' => $data['student_type_id'],
                    'category_id' => $data['category_id'],
                    'sub_category_id' => $data['sub_category_id'],
                    'billing_period_id' => $data['billing_period_id'],
                    'scholarship_id' => $scholarship_id,
                    'student_id' => $student_id,
                ])->orderBy('created_at', 'desc')->first();

                $new_billing_scholarship = new BillingScholarship;
                $new_billing_scholarship->class_id = $data['class_id'];
                $new_billing_scholarship->section_id = $data['section_id'];
                $new_billing_scholarship->faculty_id = $data['faculty_id'];
                $new_billing_scholarship->student_type_id = $data['student_type_id'];
                $new_billing_scholarship->category_id = $data['category_id'];
                $new_billing_scholarship->sub_category_id = $data['sub_category_id'];
                $new_billing_scholarship->billing_period_id = $data['billing_period_id'];
                $new_billing_scholarship->scholarship_id = $scholarship_id;
                $new_billing_scholarship->student_id = $student_id;
                $new_billing_scholarship->from_scholarship = $billing_scholarship->to_scholarship;
                $new_billing_scholarship->to_scholarship = $scholarship_value;
                $new_billing_scholarship->creator_id = $user->id;
                $new_billing_scholarship->is_saved = 1;
                $new_billing_scholarship->save();
            }

            $total_fee = $total_fees[$student_id];

            $billing_update = BillingUpdate::where([
                'class_id' => $data['class_id'],
                'section_id' => $data['section_id'],
                'faculty_id' => $data['faculty_id'],
                'student_type_id' => $data['student_type_id'],
                'category_id' => $data['category_id'],
                'sub_category_id' => $data['sub_category_id'],
                'billing_period_id' => $data['billing_period_id'],
                'student_id' => $student_id,
            ])->orderBy('created_at', 'desc')->first();

            $new_billing_update = new BillingUpdate;
            $new_billing_update->class_id = $data['class_id'];
            $new_billing_update->section_id = $data['section_id'];
            $new_billing_update->faculty_id = $data['faculty_id'];
            $new_billing_update->student_type_id = $data['student_type_id'];
            $new_billing_update->category_id = $data['category_id'];
            $new_billing_update->sub_category_id = $data['sub_category_id'];
            $new_billing_update->billing_period_id = $data['billing_period_id'];
            $new_billing_update->student_id = $student_id;
            $new_billing_update->from_total_fee = $billing_update->to_total_fee;
            $new_billing_update->to_total_fee = $total_fee;
            $new_billing_update->creator_id = $user->id;
            $new_billing_update->is_saved = 1;
            $new_billing_update->save();

            $print_no = 0;
            $billing_queried = Billing::where([
                'student_id' => $student_id,
                'billing_period_id' => $data['billing_period_id'],
                'fiscal_year_id' => $data['fiscal_year_id']
            ])->orderBy('created_at', 'desc')->first();
            if ($billing_queried != null) {
                $print_no += $billing_queried->print_no;
            }
            $billing = new Billing;
            $billing->fee = $student_total_fee;
            $billing->month = date('m');
            $billing->fine = $student_total_fine;
            $billing->discount = $student_total_discount;
            $billing->scholarship = $student_total_scholarship;
            $billing->total_fee = $total_fee;
            $billing->generated_by_id = $user->id;
            $billing->billing_period_id = $data['billing_period_id'];
            $billing->student_id = $student_id;
            $billing->fiscal_year_id = $data['fiscal_year_id'];
            $billing->print_no = $print_no;
            $billing->save();

            if (is_numeric($billing->id)) {
                $billing_log = new BillingLog;
                $billing_log->billing_period_id = $data['billing_period_id'];
                $billing_log->billing_id = $billing->id;
                $billing_log->student_id = $student_id;
                $billing_log->fiscal_year_id = $data['fiscal_year_id'];
                $billing_log->save();
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

    case 'updateBill':
        $data = $request->all();
        $fee_array = json_decode($data['feeArray']);
        $fine_array = json_decode($data['fineArray']);
        $discount_array = json_decode($data['discountArray']);
        $scholarship_array = json_decode($data['scholarshipArray']);
        $total_array = json_decode($data['totalArray']);
        $master_form = json_decode($data['masterForm']);
        $master_form_array = [];

        foreach ($master_form as $m) {
            $master_form_array[$m->name] = $m->value;
        }

        $reduced_fee_array = [];
        $reduced_fine_array = [];
        $reduced_discount_array = [];
        $reduced_scholarship_array = [];
        $reduced_total_array = [];

        foreach ($fee_array as $fee) {
            $reduced_fee_array[$fee->id] = $fee->value;
        }
        foreach ($fine_array as $fine) {
            $reduced_fine_array[$fine->id] = $fine->value;
        }
        foreach ($discount_array as $discount) {
            $reduced_discount_array[$discount->id] = $discount->value;
        }
        foreach ($scholarship_array as $scholarship) {
            $reduced_scholarship_array[$scholarship->id] = $scholarship->value;
        }
        foreach ($total_array as $total) {
            $reduced_total_array[$total->id] = $total->value;
        }

        foreach ($reduced_fee_array as $key => $fee) {
            $exploded_fees = str_replace("]", "", explode("[", $key));

            $student_id = $exploded_fees[1];
            $fee_id = $exploded_fees[2];

            $billing_fee = BillingFee::where([
                'class_id' => $master_form_array['class_id'],
                'section_id' => $master_form_array['section_id'],
                'faculty_id' => $master_form_array['faculty_id'],
                'student_type_id' => $master_form_array['student_type_id'],
                'category_id' => $master_form_array['category_id'],
                'sub_category_id' => $master_form_array['sub_category_id'],
                'billing_period_id' => $master_form_array['billing_period_id'],
                'fee_id' => $fee_id,
                'student_id' => $student_id,
            ])->orderBy('created_at', 'desc')->first();

            $new_billing_fee = new BillingFee;
            $new_billing_fee->class_id = $master_form_array['class_id'];
            $new_billing_fee->section_id = $master_form_array['section_id'];
            $new_billing_fee->faculty_id = $master_form_array['faculty_id'];
            $new_billing_fee->student_type_id = $master_form_array['student_type_id'];
            $new_billing_fee->category_id = $master_form_array['category_id'];
            $new_billing_fee->sub_category_id = $master_form_array['sub_category_id'];
            $new_billing_fee->billing_period_id = $master_form_array['billing_period_id'];
            $new_billing_fee->fee_id = $fee_id;
            $new_billing_fee->student_id = $student_id;
            $new_billing_fee->from_fee = $billing_fee->to_fee;
            $new_billing_fee->to_fee = $fee;
            $new_billing_fee->creator_id = $user->id;
            $new_billing_fee->is_saved = 1;
            $new_billing_fee->save();
        }

        foreach ($reduced_fine_array as $key => $fine) {
            $exploded_fines = str_replace("]", "", explode("[", $key));

            $student_id = $exploded_fines[1];
            $fine_id = $exploded_fines[2];

            $billing_fine = BillingFine::where([
                'class_id' => $master_form_array['class_id'],
                'section_id' => $master_form_array['section_id'],
                'faculty_id' => $master_form_array['faculty_id'],
                'student_type_id' => $master_form_array['student_type_id'],
                'category_id' => $master_form_array['category_id'],
                'sub_category_id' => $master_form_array['sub_category_id'],
                'billing_period_id' => $master_form_array['billing_period_id'],
                'fine_id' => $fine_id,
                'student_id' => $student_id,
            ])->orderBy('created_at', 'desc')->first();

            $new_billing_fine = new BillingFine;
            $new_billing_fine->class_id = $master_form_array['class_id'];
            $new_billing_fine->section_id = $master_form_array['section_id'];
            $new_billing_fine->faculty_id = $master_form_array['faculty_id'];
            $new_billing_fine->student_type_id = $master_form_array['student_type_id'];
            $new_billing_fine->category_id = $master_form_array['category_id'];
            $new_billing_fine->sub_category_id = $master_form_array['sub_category_id'];
            $new_billing_fine->billing_period_id = $master_form_array['billing_period_id'];
            $new_billing_fine->fine_id = $fine_id;
            $new_billing_fine->student_id = $student_id;
            $new_billing_fine->from_fine = $billing_fine->to_fine;
            $new_billing_fine->to_fine = $fine;
            $new_billing_fine->creator_id = $user->id;
            $new_billing_fine->is_saved = 1;
            $new_billing_fine->save();
        }

        foreach ($reduced_discount_array as $key => $discount) {
            $exploded_discounts = str_replace("]", "", explode("[", $key));

            $student_id = $exploded_discounts[1];
            $discount_id = $exploded_discounts[2];

            $billing_discount = BillingDiscount::where([
                'class_id' => $master_form_array['class_id'],
                'section_id' => $master_form_array['section_id'],
                'faculty_id' => $master_form_array['faculty_id'],
                'student_type_id' => $master_form_array['student_type_id'],
                'category_id' => $master_form_array['category_id'],
                'sub_category_id' => $master_form_array['sub_category_id'],
                'billing_period_id' => $master_form_array['billing_period_id'],
                'discount_id' => $discount_id,
                'student_id' => $student_id,
            ])->orderBy('created_at', 'desc')->first();

            $new_billing_discount = new BillingDiscount;
            $new_billing_discount->class_id = $master_form_array['class_id'];
            $new_billing_discount->section_id = $master_form_array['section_id'];
            $new_billing_discount->faculty_id = $master_form_array['faculty_id'];
            $new_billing_discount->student_type_id = $master_form_array['student_type_id'];
            $new_billing_discount->category_id = $master_form_array['category_id'];
            $new_billing_discount->sub_category_id = $master_form_array['sub_category_id'];
            $new_billing_discount->billing_period_id = $master_form_array['billing_period_id'];
            $new_billing_discount->discount_id = $discount_id;
            $new_billing_discount->student_id = $student_id;
            $new_billing_discount->from_discount = $billing_discount->to_discount;
            $new_billing_discount->to_discount = $discount;
            $new_billing_discount->creator_id = $user->id;
            $new_billing_discount->is_saved = 1;
            $new_billing_discount->save();
        }

        foreach ($reduced_scholarship_array as $key => $scholarship) {
            $exploded_scholarships = str_replace("]", "", explode("[", $key));

            $student_id = $exploded_scholarships[1];
            $scholarship_id = $exploded_scholarships[2];

            $billing_scholarship = BillingScholarship::where([
                'class_id' => $master_form_array['class_id'],
                'section_id' => $master_form_array['section_id'],
                'faculty_id' => $master_form_array['faculty_id'],
                'student_type_id' => $master_form_array['student_type_id'],
                'category_id' => $master_form_array['category_id'],
                'sub_category_id' => $master_form_array['sub_category_id'],
                'billing_period_id' => $master_form_array['billing_period_id'],
                'scholarship_id' => $scholarship_id,
                'student_id' => $student_id,
            ])->orderBy('created_at', 'desc')->first();

            $new_billing_scholarship = new BillingScholarship;
            $new_billing_scholarship->class_id = $master_form_array['class_id'];
            $new_billing_scholarship->section_id = $master_form_array['section_id'];
            $new_billing_scholarship->faculty_id = $master_form_array['faculty_id'];
            $new_billing_scholarship->student_type_id = $master_form_array['student_type_id'];
            $new_billing_scholarship->category_id = $master_form_array['category_id'];
            $new_billing_scholarship->sub_category_id = $master_form_array['sub_category_id'];
            $new_billing_scholarship->billing_period_id = $master_form_array['billing_period_id'];
            $new_billing_scholarship->scholarship_id = $scholarship_id;
            $new_billing_scholarship->student_id = $student_id;
            $new_billing_scholarship->from_scholarship = $billing_scholarship->to_scholarship;
            $new_billing_scholarship->to_scholarship = $scholarship;
            $new_billing_scholarship->creator_id = $user->id;
            $new_billing_scholarship->is_saved = 1;
            $new_billing_scholarship->save();
        }

        foreach ($reduced_total_array as $key => $total) {

            $exploded_total_array = str_replace("]", "", explode("[", $key));

            $student_id = $exploded_total_array[1];

            $billing_update = BillingUpdate::where([
                'class_id' => $master_form_array['class_id'],
                'section_id' => $master_form_array['section_id'],
                'faculty_id' => $master_form_array['faculty_id'],
                'student_type_id' => $master_form_array['student_type_id'],
                'category_id' => $master_form_array['category_id'],
                'sub_category_id' => $master_form_array['sub_category_id'],
                'billing_period_id' => $master_form_array['billing_period_id'],
                'student_id' => $student_id,
            ])->orderBy('created_at', 'desc')->first();

            $new_billing_update = new BillingUpdate;
            $new_billing_update->class_id = $master_form_array['class_id'];
            $new_billing_update->section_id = $master_form_array['section_id'];
            $new_billing_update->faculty_id = $master_form_array['faculty_id'];
            $new_billing_update->student_type_id = $master_form_array['student_type_id'];
            $new_billing_update->category_id = $master_form_array['category_id'];
            $new_billing_update->sub_category_id = $master_form_array['sub_category_id'];
            $new_billing_update->billing_period_id = $master_form_array['billing_period_id'];
            $new_billing_update->student_id = $student_id;
            $new_billing_update->from_total_fee = $billing_update->to_total_fee;
            $new_billing_update->to_total_fee = $total;
            $new_billing_update->creator_id = $user->id;
            $new_billing_update->is_saved = 1;
            $new_billing_update->save();
        }

        break;

    case 'get_students_with_bill_detail':
        $data = $request->all();
        $where = [
            'class_id' => $data['class_id'],
            'student_type_id' => $data['student_type_id'],
            'faculty_id' => $data['faculty_id'],
            'section_id' => $data['section_id'],
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
        ];
        $students = AppStudent::where($where)->get();

        $fee_rate_where = [
            'class_id' => $data['class_id'],
            'student_type_id' => $data['student_type_id'],
            'faculty_id' => $data['faculty_id'],
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
        ];
        $fee_rates = AppFeeRate::where($fee_rate_where)->get();

        $all_fees = AppFeeName::all();
        $all_fines = AppFine::all();
        $all_discounts = AppDiscount::all();
        $all_scholarships = AppScholarship::all();

        if (sizeof($students) > 0) {
            $fee_names_for_student = array();
            foreach ($students as $student) {
                $student->fee_names = array();
                $student_fee_names = $student->fee_names;
                foreach ($all_fees as $all_fee) {
                    foreach ($fee_rates as $fee_rate) {
                        if ($all_fee->is_compulsary != 1) {
                            $fee_name_for_student = AppFeeNameStudent::where(['student_id' => $student->id, 'fee_name_id' => $all_fee->id])->first();
                            if ($fee_name_for_student != null) {
                                $fee_structure_queried = AppFeeStructure::where(['fee_names_id' => $fee_name_for_student->fee_name_id, 'fee_rate_id' => $fee_rate->id])->first();
                                if ($fee_structure_queried) {
                                    $student_fee_names[$all_fee->id] = $fee_structure_queried->amount;
                                } else {
                                    $student_fee_names[$all_fee->id] = 0;
                                }
                            } else {
                                $student_fee_names[$all_fee->id] = 0;
                            }
                        } else {
                            $fee_structure_queried = AppFeeStructure::where(['fee_names_id' => $all_fee->id, 'fee_rate_id' => $fee_rate->id])->first();
                            if ($fee_structure_queried) {
                                $student_fee_names[$all_fee->id] = $fee_structure_queried->amount;
                            } else {
                                $student_fee_names[$all_fee->id] = 0;
                            }
                        }
                    }
                }

                $total_fee_for_student = 0;

                if (sizeof($student_fee_names) > 0) {
                    foreach ($student_fee_names as $fee_id => $student_fee_name) {
                        $billing_fee_saved = BillingFee::where([
                            'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                            'faculty_id' => $data['faculty_id'],
                            'student_type_id' => $data['student_type_id'],
                            'category_id' => $data['category_id'],
                            'sub_category_id' => $data['sub_category_id'],
                            'billing_period_id' => $data['billing_period_id'],
                            'fee_id' => $fee_id,
                            'student_id' => $student->id,
                            'is_saved' => 1,
                        ])->orderBy('created_at', 'desc')->first();

                        if ($billing_fee_saved) {
                            $student_fee_names[$fee_id] = $billing_fee_saved->to_fee;
                            $total_fee_for_student += $billing_fee_saved->to_fee;
                        } else {
                            $total_fee_for_student += $student_fee_name;
                            $billing_fee_not_saved = BillingFee::where([
                                'class_id' => $data['class_id'],
                                'section_id' => $data['section_id'],
                                'faculty_id' => $data['faculty_id'],
                                'student_type_id' => $data['student_type_id'],
                                'category_id' => $data['category_id'],
                                'sub_category_id' => $data['sub_category_id'],
                                'billing_period_id' => $data['billing_period_id'],
                                'fee_id' => $fee_id,
                                'student_id' => $student->id,
                                'is_saved' => 0,
                            ])->orderBy('created_at', 'desc')->first();

                            if ($billing_fee_not_saved) {
                                $billing_fee_not_saved->from_fee = 0;
                                $billing_fee_not_saved->to_fee = $student_fee_name;
                                $billing_fee_not_saved->creator_id = $user->id;
                                $billing_fee_not_saved->save();
                            } else {
                                $billing_fee = new BillingFee;
                                $billing_fee->class_id = $data['class_id'];
                                $billing_fee->section_id = $data['section_id'];
                                $billing_fee->faculty_id = $data['faculty_id'];
                                $billing_fee->student_type_id = $data['student_type_id'];
                                $billing_fee->category_id = $data['category_id'];
                                $billing_fee->sub_category_id = $data['sub_category_id'];
                                $billing_fee->billing_period_id = $data['billing_period_id'];
                                $billing_fee->fee_id = $fee_id;
                                $billing_fee->student_id = $student->id;
                                $billing_fee->from_fee = 0;
                                $billing_fee->to_fee = $student_fee_name;
                                $billing_fee->creator_id = $user->id;
                                $billing_fee->is_saved = 0;
                                $billing_fee->save();
                            }
                        }
                    }
                }
                $student->fee_names = $student_fee_names;

                $student->total_fee_for_student = $total_fee_for_student;
                $student->actual_fee_amount = $total_fee_for_student;

                $student->discounts = array();
                $student_discounts = $student->discounts;
                if (sizeof($student_fee_names) > 0) {
                    foreach ($all_fees as $all_fee) {
                        foreach ($all_discounts as $all_discount) {
                            if (!isset($student_discounts[$all_discount->id])) {
                                $student_discounts[$all_discount->id] = 0;
                            }
                            if ($all_fee->is_discount_applicable == 1) {
                                $fee_structure_student_discounts = AppDiscountStudent::where(['student_id' => $student->id, 'fee_name_id' => $all_fee->id, 'discount_id' => $all_discount->id])->get();
                                if (sizeof($fee_structure_student_discounts) > 0) {
                                    foreach ($fee_structure_student_discounts as $fee_structure_student_discount) {
                                        if ($fee_structure_student_discount->billing_period_id == $data['billing_period_id'] || $fee_structure_student_discount->yearly_applicable == 1) {
                                            $discount = AppDiscount::find($fee_structure_student_discount->discount_id);
                                            foreach ($fee_rates as $fee_rate) {
                                                $fee_structure = AppFeeStructure::where(['fee_names_id' => $all_fee->id, 'fee_rate_id' => $fee_rate->id])->first();
                                                if ($fee_structure) {
                                                    if ($discount->type == "Amount") {
                                                        $student_discounts[$all_discount->id] += $discount->amount;
                                                    } else if ($discount->type == "Percentage") {
                                                        $student_discounts[$all_discount->id] += $fee_structure->amount * $discount->amount / 100;
                                                    } else {
                                                        $student_discounts[$all_discount->id] += 0;
                                                    }
                                                } else {
                                                    $student_discounts[$all_discount->id] += 0;
                                                }
                                            }
                                        } else {
                                            $student_discounts[$all_discount->id] += 0;
                                        }
                                    }
                                } else {
                                    $student_discounts[$all_discount->id] += 0;
                                }
                            } else {
                                $student_discounts[$all_discount->id] += 0;
                            }
                        }
                    }
                }

                if (sizeof($student_discounts)) {
                    foreach ($student_discounts as $discount_id => $student_discount) {
                        $billing_discount_saved = BillingDiscount::where([
                            'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                            'faculty_id' => $data['faculty_id'],
                            'student_type_id' => $data['student_type_id'],
                            'category_id' => $data['category_id'],
                            'sub_category_id' => $data['sub_category_id'],
                            'billing_period_id' => $data['billing_period_id'],
                            'discount_id' => $discount_id,
                            'student_id' => $student->id,
                            'is_saved' => 1,
                        ])->orderBy('created_at', 'desc')->first();

                        if ($billing_discount_saved) {
                            $student_discounts[$discount_id] = $billing_discount_saved->to_discount;
                            $student->actual_fee_amount -= $billing_discount_saved->to_discount;
                        } else {
                            $student->actual_fee_amount -= $student_discount;
                            $billing_discount_not_saved = BillingDiscount::where([
                                'class_id' => $data['class_id'],
                                'section_id' => $data['section_id'],
                                'faculty_id' => $data['faculty_id'],
                                'student_type_id' => $data['student_type_id'],
                                'category_id' => $data['category_id'],
                                'sub_category_id' => $data['sub_category_id'],
                                'billing_period_id' => $data['billing_period_id'],
                                'discount_id' => $discount_id,
                                'student_id' => $student->id,
                                'is_saved' => 0,
                            ])->orderBy('created_at', 'desc')->first();

                            if ($billing_discount_not_saved) {
                                $billing_discount_not_saved->from_discount = 0;
                                $billing_discount_not_saved->to_discount = $student_discount;
                                $billing_discount_not_saved->creator_id = $user->id;
                                $billing_discount_not_saved->save();
                            } else {
                                $billing_discount = new BillingDiscount;
                                $billing_discount->class_id = $data['class_id'];
                                $billing_discount->section_id = $data['section_id'];
                                $billing_discount->faculty_id = $data['faculty_id'];
                                $billing_discount->student_type_id = $data['student_type_id'];
                                $billing_discount->category_id = $data['category_id'];
                                $billing_discount->sub_category_id = $data['sub_category_id'];
                                $billing_discount->billing_period_id = $data['billing_period_id'];
                                $billing_discount->discount_id = $discount_id;
                                $billing_discount->student_id = $student->id;
                                $billing_discount->from_discount = 0;
                                $billing_discount->to_discount = $student_discount;
                                $billing_discount->creator_id = $user->id;
                                $billing_discount->is_saved = 0;
                                $billing_discount->save();
                            }
                        }
                    }
                }
                $student->discounts = $student_discounts;

                $student->scholarships = array();
                $student_scholarships = $student->scholarships;
                if (sizeof($student_fee_names) > 0) {
                    foreach ($all_fees as $all_fee) {
                        foreach ($all_scholarships as $all_scholarship) {
                            if (!isset($student_scholarships[$all_scholarship->id])) {
                                $student_scholarships[$all_scholarship->id] = 0;
                            }
                            if ($all_fee->is_scholarship_applicable == 1) {
                                $fee_structure_student_scholarships = AppScholarshipStudent::where(['student_id' => $student->id, 'fee_name_id' => $all_fee->id, 'scholarship_id' => $all_scholarship->id])->get();
                                if (sizeof($fee_structure_student_scholarships) > 0) {
                                    foreach ($fee_structure_student_scholarships as $fee_structure_student_scholarship) {
                                        if ($fee_structure_student_scholarship->billing_period_id == $data['billing_period_id'] || $fee_structure_student_scholarship->yearly_applicable == 1) {
                                            $scholarship = AppScholarship::find($fee_structure_student_scholarship->scholarship_id);
                                            foreach ($fee_rates as $fee_rate) {
                                                $fee_structure = AppFeeStructure::where(['fee_names_id' => $all_fee->id, 'fee_rate_id' => $fee_rate->id])->first();
                                                if ($fee_structure) {
                                                    if ($scholarship->type == "Amount") {
                                                        $student_scholarships[$all_scholarship->id] += $scholarship->amount;
                                                    } else if ($scholarship->type == "Percentage") {
                                                        $student_scholarships[$all_scholarship->id] += $fee_structure->amount * $scholarship->amount / 100;
                                                    } else {
                                                        $student_scholarships[$all_scholarship->id] += 0;
                                                    }
                                                } else {
                                                    $student_scholarships[$all_scholarship->id] += 0;
                                                }
                                            }
                                        } else {
                                            $student_scholarships[$all_scholarship->id] += 0;
                                        }
                                    }
                                } else {
                                    $student_scholarships[$all_scholarship->id] += 0;
                                }
                            } else {
                                $student_scholarships[$all_scholarship->id] += 0;
                            }
                        }
                    }
                }

                if (sizeof($student_scholarships)) {
                    foreach ($student_scholarships as $scholarship_id => $student_scholarship) {
                        $billing_scholarship_saved = BillingScholarship::where([
                            'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                            'faculty_id' => $data['faculty_id'],
                            'student_type_id' => $data['student_type_id'],
                            'category_id' => $data['category_id'],
                            'sub_category_id' => $data['sub_category_id'],
                            'billing_period_id' => $data['billing_period_id'],
                            'scholarship_id' => $scholarship_id,
                            'student_id' => $student->id,
                            'is_saved' => 1,
                        ])->orderBy('created_at', 'desc')->first();

                        if ($billing_scholarship_saved) {
                            $student_scholarships[$scholarship_id] = $billing_scholarship_saved->to_scholarship;
                            $student->actual_fee_amount -= $billing_scholarship_saved->to_scholarship;
                        } else {
                            $student->actual_fee_amount -= $student_scholarship;
                            $billing_scholarship_not_saved = BillingScholarship::where([
                                'class_id' => $data['class_id'],
                                'section_id' => $data['section_id'],
                                'faculty_id' => $data['faculty_id'],
                                'student_type_id' => $data['student_type_id'],
                                'category_id' => $data['category_id'],
                                'sub_category_id' => $data['sub_category_id'],
                                'billing_period_id' => $data['billing_period_id'],
                                'scholarship_id' => $scholarship_id,
                                'student_id' => $student->id,
                                'is_saved' => 0,
                            ])->orderBy('created_at', 'desc')->first();

                            if ($billing_scholarship_not_saved) {
                                $billing_scholarship_not_saved->from_scholarship = 0;
                                $billing_scholarship_not_saved->to_scholarship = $student_scholarship;
                                $billing_scholarship_not_saved->creator_id = $user->id;
                                $billing_scholarship_not_saved->save();
                            } else {
                                $billing_scholarship = new BillingScholarship;
                                $billing_scholarship->class_id = $data['class_id'];
                                $billing_scholarship->section_id = $data['section_id'];
                                $billing_scholarship->faculty_id = $data['faculty_id'];
                                $billing_scholarship->student_type_id = $data['student_type_id'];
                                $billing_scholarship->category_id = $data['category_id'];
                                $billing_scholarship->sub_category_id = $data['sub_category_id'];
                                $billing_scholarship->billing_period_id = $data['billing_period_id'];
                                $billing_scholarship->scholarship_id = $scholarship_id;
                                $billing_scholarship->student_id = $student->id;
                                $billing_scholarship->from_scholarship = 0;
                                $billing_scholarship->to_scholarship = $student_scholarship;
                                $billing_scholarship->creator_id = $user->id;
                                $billing_scholarship->is_saved = 0;
                                $billing_scholarship->save();
                            }
                        }
                    }
                }
                $student->scholarships = $student_scholarships;

                $student->fines = array();
                $student_fines = $student->fines;
                if (sizeof($student_fee_names) > 0) {
                    foreach ($all_fines as $all_fine) {
                        if (!isset($student_fines[$all_fine->id])) {
                            $student_fines[$all_fine->id] = 0;
                        }
                        $fine_student = AppFineStudent::where(['fine_id' => $all_fine->id, 'student_id' => $student->id, 'billing_period_id' => $data['billing_period_id']])->first();
                        if ($fine_student) {
                            if ($all_fine->type == "Amount") {
                                $student_fines[$all_fine->id] += $all_fine->amount;
                            } else if ($all_fine->type == "Percentage") {
                                $student_fines[$all_fine->id] += ($total_fee_for_student * $all_fine->amount) / 100;
                            }
                        } else {
                            $student_fines[$all_fine->id] += 0;
                        }
                    }
                }

                if (sizeof($student_fines)) {
                    foreach ($student_fines as $fine_id => $student_fine) {
                        $billing_fine_saved = BillingFine::where([
                            'class_id' => $data['class_id'],
                            'section_id' => $data['section_id'],
                            'faculty_id' => $data['faculty_id'],
                            'student_type_id' => $data['student_type_id'],
                            'category_id' => $data['category_id'],
                            'sub_category_id' => $data['sub_category_id'],
                            'billing_period_id' => $data['billing_period_id'],
                            'fine_id' => $fine_id,
                            'student_id' => $student->id,
                            'is_saved' => 1,
                        ])->orderBy('created_at', 'desc')->first();

                        if ($billing_fine_saved) {
                            $student_fines[$fine_id] = $billing_fine_saved->to_fine;
                            $student->actual_fee_amount -= $billing_fine_saved->to_fine;
                        } else {
                            $student->actual_fee_amount += $student_fine;
                            $billing_fine_not_saved = BillingFine::where([
                                'class_id' => $data['class_id'],
                                'section_id' => $data['section_id'],
                                'faculty_id' => $data['faculty_id'],
                                'student_type_id' => $data['student_type_id'],
                                'category_id' => $data['category_id'],
                                'sub_category_id' => $data['sub_category_id'],
                                'billing_period_id' => $data['billing_period_id'],
                                'fine_id' => $fine_id,
                                'student_id' => $student->id,
                                'is_saved' => 0,
                            ])->orderBy('created_at', 'desc')->first();

                            if ($billing_fine_not_saved) {
                                $billing_fine_not_saved->from_fine = 0;
                                $billing_fine_not_saved->to_fine = $student_fine;
                                $billing_fine_not_saved->creator_id = $user->id;
                                $billing_fine_not_saved->save();
                            } else {
                                $billing_fine = new BillingFine;
                                $billing_fine->class_id = $data['class_id'];
                                $billing_fine->section_id = $data['section_id'];
                                $billing_fine->faculty_id = $data['faculty_id'];
                                $billing_fine->student_type_id = $data['student_type_id'];
                                $billing_fine->category_id = $data['category_id'];
                                $billing_fine->sub_category_id = $data['sub_category_id'];
                                $billing_fine->billing_period_id = $data['billing_period_id'];
                                $billing_fine->fine_id = $fine_id;
                                $billing_fine->student_id = $student->id;
                                $billing_fine->from_fine = 0;
                                $billing_fine->to_fine = $student_fine;
                                $billing_fine->creator_id = $user->id;
                                $billing_fine->is_saved = 0;
                                $billing_fine->save();
                            }
                        }
                    }
                }
                $student->fines = $student_fines;

                $billing_update_saved = BillingUpdate::where([
                    'class_id' => $data['class_id'],
                    'section_id' => $data['section_id'],
                    'faculty_id' => $data['faculty_id'],
                    'student_type_id' => $data['student_type_id'],
                    'category_id' => $data['category_id'],
                    'sub_category_id' => $data['sub_category_id'],
                    'billing_period_id' => $data['billing_period_id'],
                    'student_id' => $student->id,
                    'is_saved' => 1,
                ])->orderBy('created_at', 'desc')->first();

                if ($billing_update_saved) {
                    $student->actual_fee_amount = $billing_update_saved->to_total_fee;
                } else {
                    $billing_update_not_saved = BillingUpdate::where([
                        'class_id' => $data['class_id'],
                        'section_id' => $data['section_id'],
                        'faculty_id' => $data['faculty_id'],
                        'student_type_id' => $data['student_type_id'],
                        'category_id' => $data['category_id'],
                        'sub_category_id' => $data['sub_category_id'],
                        'billing_period_id' => $data['billing_period_id'],
                        'student_id' => $student->id,
                        'is_saved' => 0,
                    ])->orderBy('created_at', 'desc')->first();

                    if ($billing_update_not_saved) {
                        $billing_update_not_saved->from_total_fee = 0;
                        $billing_update_not_saved->to_total_fee = $student->actual_fee_amount;
                        $billing_update_not_saved->creator_id = $user->id;
                        $billing_update_not_saved->save();
                    } else {
                        $billing_update = new BillingUpdate;
                        $billing_update->class_id = $data['class_id'];
                        $billing_update->section_id = $data['section_id'];
                        $billing_update->faculty_id = $data['faculty_id'];
                        $billing_update->student_type_id = $data['student_type_id'];
                        $billing_update->category_id = $data['category_id'];
                        $billing_update->sub_category_id = $data['sub_category_id'];
                        $billing_update->billing_period_id = $data['billing_period_id'];
                        $billing_update->student_id = $student->id;
                        $billing_update->from_total_fee = 0;
                        $billing_update->to_total_fee = $student->actual_fee_amount;
                        $billing_update->creator_id = $user->id;
                        $billing_update->is_saved = 0;
                        $billing_update->save();
                    }
                }
            }
        }
        echo json_encode(['students' => $students, 'fines' => $all_fines, 'fees' => $all_fees, 'discounts' => $all_discounts, 'scholarships' => $all_scholarships]);
        break;

    case 'print':
        $data = $request->all();
        $student_fees = $data['studentFees'];
        $student_fines = $data['studentFines'];
        $student_discounts = $data['studentDiscounts'];
        $student_scholarships = $data['studentScholarships'];
        $total_fees = $data['total_fee'];
        $student_ids = [];

        foreach ($total_fees as $key => $total_fee) {
            array_push($student_ids, $key);
        }

        foreach ($student_ids as $student_id) {
            $student_fees_for_student_id = $student_fees[$student_id];
            $student_total_fee = 0;
            $fees = [];

            foreach ($student_fees_for_student_id as $fee_id => $fee_value) {
                $fee = AppFeeName::find($fee_id);
                $fees[$fee->name] = $fee_value;
                $student_total_fee += $fee_value;
            }

            $student_fines_for_student_id = $student_fines[$student_id];
            $student_total_fine = 0;
            $fines = [];

            foreach ($student_fines_for_student_id as $fine_id => $fine_value) {
                $fine = AppFine::find($fine_id);
                $fines[$fine->name] = $fine_value;
                $student_total_fine += $fine_value;
            }

            $student_discounts_for_student_id = $student_discounts[$student_id];
            $student_total_discount = 0;
            $discounts = [];

            foreach ($student_discounts_for_student_id as $discount_id => $discount_value) {
                $discount = AppDiscount::find($discount_id);
                $discounts[$discount->name] = $discount_value;
                $student_total_discount += $discount_value;
            }

            $student_scholarships_for_student_id = $student_scholarships[$student_id];
            $student_total_scholarship = 0;
            $scholarships = [];

            foreach ($student_scholarships_for_student_id as $scholarship_id => $scholarship_value) {
                $scholarship = AppScholarship::find($scholarship_id);
                $scholarships[$scholarship->name] = $scholarship_value;
                $student_total_scholarship += $scholarship_value;
            }

            $total_fee = $total_fees[$student_id];

            $amount_in_words = numberTowords($total_fee);

            $student = AppStudent::find($student_id);
            $class = AppClass::find($data['class_id']);
            $student_additional_info = AppStudentAdditionalInformation::where('student_id', $student->id)->first();

            $html = view_render('app_wrapper_without_theme', [
                '_include' => 'billing',
                'fees' => $fees,
                'fines' => $fines,
                'discounts' => $discounts,
                'scholarships' => $scholarships,
                'total_fee' => $total_fee,
                'student_total_fee' => $student_total_fee,
                'student_total_fine' => $student_total_fine,
                'student_total_scholarship' => $student_total_scholarship,
                'student_total_discount' => $student_total_discount,
                'student' => $student,
                'class' => $class,
                'student_additional_info' => $student_additional_info,
                'date' => date("Y-m-d"),
                'amount_in_words' => $amount_in_words
            ]);

            // print_r($html);

            $mhtml2pdf = new Mhtml();
            $mhtml2pdf->filename($student->name.'_bill');
            $mhtml2pdf->paper('a4', 'portrait');
            $mhtml2pdf->html($html);
            $mhtml2pdf->create('view', 'Bill', null);

            // $html2pdf = new Html2Pdf();
            // $html2pdf->writeHTML($html);
            // $html2pdf->output($student->name.'_bill.pdf');
            // $generate_pdf_obj = new Generate_Pdf(); 
            // $generate_pdf_obj->generate_pdf($html);
            
        }

        break;
}

function numberTowords($num)
{

    $ones = array(
        0 => "Zero",
        1 => "One",
        2 => "Two",
        3 => "Three",
        4 => "Four",
        5 => "Five",
        6 => "Six",
        7 => "Seven",
        8 => "Eight",
        9 => "Nine",
        10 => "Ten",
        11 => "Eleven",
        12 => "Twelve",
        13 => "Thirteen",
        14 => "Fourteen",
        15 => "Fifteen",
        16 => "Sixteen",
        17 => "Seventeen",
        18 => "Eighteen",
        19 => "Ninteen"
    );
    $tens = array(
        0 => "Zero",
        1 => "Ten",
        2 => "Twenty",
        3 => "Thirty",
        4 => "Forty",
        5 => "Fifty",
        6 => "Sixty",
        7 => "Seventy",
        8 => "Eighty",
        9 => "Ninety"
    );
    $hundreds = array(
        "Hundred",
        "Thousand",
        "Million",
        "Billion",
        "Trillion",
        "Quardrillion"
    );
    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";
    foreach ($whole_arr as $key => $i) {

        while (substr($i, 0, 1) == "0")
            $i = substr($i, 1, 5);
        if ($i < 20) {
            $rettxt .= $ones[$i];
        } elseif ($i < 100) {
            if (substr($i, 0, 1) != "0")  $rettxt .= $tens[substr($i, 0, 1)];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $ones[substr($i, 1, 1)];
        } else {
            if (substr($i, 0, 1) != "0") $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            if (substr($i, 1, 1) != "0") $rettxt .= " " . $tens[substr($i, 1, 1)];
            if (substr($i, 2, 1) != "0") $rettxt .= " " . $ones[substr($i, 2, 1)];
        }
        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= $tens[substr($decnum, 0, 1)];
            $rettxt .= " " . $ones[substr($decnum, 1, 1)];
        }
    }
    return $rettxt;
}
