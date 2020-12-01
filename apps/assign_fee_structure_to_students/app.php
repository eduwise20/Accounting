<?php

require 'apps/classes/models/AppClass.php';
require 'apps/students/models/AppStudent.php';
require 'apps/student_types/models/AppStudentType.php';
require 'apps/sections/models/AppSection.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/fee_names/models/AppFeeName.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'assign_fee_structure_to_students');
$ui->assign('_title', 'Assign Fee Structure to Students ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'list':
        $billing_periods = BillingPeriod::orderBy('id', 'desc')->get();
        view('app_wrapper', [
            '_include' => 'list',
            'billing_periods' => $billing_periods
        ]);
        break;

    case 'add':
        $classes = AppClass::all();
        $students = AppStudent::all();
        $student_types = AppStudentType::all();
        $sections = AppSection::all();
        $categories = Category::all();
        view('app_wrapper', [
            '_include' => 'add',
            'classes' => $classes,
            'students' => $students,
            'student_types' => $student_types,
            'sections' => $sections,
            'categories' => $categories,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'code' => 'required|numeric',
            'remarks' => '',
            'hierarchy' => 'required|numeric',
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
            $existCode = false;
            $existHierarchy = false;

            if ((isset($data['id']) && BillingPeriod::find($data['id'])->code != $data['code']) || !isset($data['id'])) {
                $existCode = BillingPeriod::where('code', $data['code'])->first();
            }
            if ((isset($data['id']) && BillingPeriod::find($data['id'])->hierarchy != $data['hierarchy']) || !isset($data['id'])) {
                $existHierarchy = BillingPeriod::where('hierarchy', $data['hierarchy'])->first();
            }

            if ($existCode) {
                echo 'Code should be unique. <br>';
            } else if ($existHierarchy) {
                echo 'Hierarchy should be unique. <br>';
            } else {
                if (isset($data['id'])) {
                    $billing_period = BillingPeriod::find($data['id']);
                } else {
                    $billing_period = new BillingPeriod;
                }
                $billing_period->name = $data['name'];
                $billing_period->remarks = $data['remarks'];
                $billing_period->code = $data['code'];
                $billing_period->hierarchy = $data['hierarchy'];
                $billing_period->is_active = isset($data['is_active']) ? ($data['is_active'] == 'on' ? 1 : 0) : 0;
                $billing_period->save();
                echo $billing_period->id;
            }
        }
        break;

    case 'edit':
        $id = route(3);
        $billing_period = BillingPeriod::find($id);

        if (!$billing_period) {
            $msg = "Billing period not found.";
            r2(U . 'billing_periods/app/list', 'e', $msg);
        } else {
            view('app_wrapper', [
                '_include' => 'edit',
                'billing_period' => $billing_period
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $billing_period = BillingPeriod::find($id);
        if ($billing_period) {
            $billing_period->delete();
            $msg = "Billing Period successfully deleted.";
        }
        r2(U . 'billing_periods/app/list', 's', $msg);
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

    case 'getStudentAndFee':
        $data = $request->all();
        $students = AppStudent::all();
        $fee_names = AppFeeName::all();
        $r['students'] = $students;
        $r['fee_names'] = $fee_names;
        echo json_encode($r);
}