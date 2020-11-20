<?php

require 'apps/scholarships/models/AppScholarship.php';
require 'apps/fiscal_years/models/FiscalYear.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'scholarships');
$ui->assign('_title', 'Scholarships ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'list':
        $scholarships = AppScholarship::all()->map(function($scholarship) {
            $scholarship->fiscal_year = FiscalYear::find($scholarship->fiscal_year_id)->name;
            return $scholarship;
        });
        view('app_wrapper', [
            '_include' => 'list',
            'scholarships' => $scholarships,
        ]);
        break;

    case 'add':
        view('app_wrapper', [
            '_include' => 'add',
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
                'name' => 'required',
                'type' => 'required',
                'amount' => 'required|numeric',
                'remarks' => 'required',
            ]
        );

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessages = $errors->firstOfAll();
            $msg = '';
            foreach ($errorMessages as $message) {
                $msg .= $message . '</br>';
            }
            echo $msg;
        } else {
            $running_fiscal_years = FiscalYear::where('is_running', 1)->get();
            if(sizeof($running_fiscal_years) > 1) {
                echo 'Multiple fiscal year running.';
            } else if (sizeof($running_fiscal_years) < 1) {
                echo 'The fiscal year is not selected.';
            } else {
                if (isset($data['id'])) {
                    $scholarship = AppScholarship::find($data['id']);
                } else {
                    $scholarship = new AppScholarship;
                }
                $scholarship->name = $data['name'];
                $scholarship->type = $data['type'];
                $scholarship->fiscal_year_id = $running_fiscal_years->get(0)->id;
                $scholarship->amount = $data['amount'];
                $scholarship->is_recurring = isset($data['is_recurring']) ? ($data['is_recurring'] == 'on' ? 1 : 0) : 0;
                $scholarship->is_active = isset($data['is_active']) ? ($data['is_active'] == 'on' ? 1 : 0) : 0;
                $scholarship->remarks = $data['remarks'];
                $scholarship->save();
                echo $scholarship->id;
            }
        }

        break;

    case 'edit':
        $id = route(3);
        $scholarship = AppScholarship::find($id);
        if (!$scholarship) {
            $msg = "Scholarship not found.";
            r2(U . 'scholarships/app/list', 'e', $msg);
        } else {
            view('app_wrapper', [
                '_include' => 'edit',
                'scholarship' => $scholarship
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $scholarship = AppScholarship::find($id);
        if ($scholarship) {
            $scholarship->delete();
            $msg = "Scholarship successfully deleted.";
            $alert = 's';
        }
        r2(U . 'scholarships/app/list', $alert, $msg);
        break;
}