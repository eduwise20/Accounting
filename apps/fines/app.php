<?php

require 'apps/fines/models/AppFine.php';
require 'apps/fiscal_years/models/FiscalYear.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'fines');
$ui->assign('_title', 'Fines ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'list':
        $fines = AppFine::all()->map(function($fine) {
            $fine->fiscal_year = FiscalYear::find($fine->fiscal_year_id)->name;
            return $fine;
        });
        view('app_wrapper', [
            '_include' => 'list',
            'fines' => $fines,
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
                'remarks' => '',
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
                } else if (($data['type'] == 'Percentage') && ($data['amount'] < 0 || $data['amount'] > 100)) {
                    echo 'Percentage should be between 0 to 100.';
                } else {
                if (isset($data['id'])) {
                    $fine = AppFine::find($data['id']);
                } else {
                    $fine = new AppFine;
                }
                $fine->name = $data['name'];
                $fine->type = $data['type'];
                $fine->fiscal_year_id = $running_fiscal_years->get(0)->id;
                $fine->amount = $data['amount'];
                $fine->is_active = isset($data['is_active']) ? ($data['is_active'] == 'on' ? 1 : 0) : 0;
                $fine->remarks = $data['remarks'];
                $fine->save();
                echo $fine->id;
            }
        }

        break;

    case 'edit':
        $id = route(3);
        $fine = AppFine::find($id);
        if (!$fine) {
            $msg = "Fine not found.";
            r2(U . 'fines/app/list', 'e', $msg);
        } else {
            view('app_wrapper', [
                '_include' => 'edit',
                'fine' => $fine
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $fine = AppFine::find($id);
        if ($fine) {
            $fine->delete();
            $msg = "Fine successfully deleted.";
            $alert = 's';
        }
        r2(U . 'fines/app/list', $alert, $msg);
        break;
}