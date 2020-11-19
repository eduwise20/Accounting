<?php

require 'apps/discounts/models/AppDiscount.php';
require 'apps/fiscal_years/models/FiscalYear.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'discounts');
$ui->assign('_title', 'Discounts ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'list':
        $discounts = AppDiscount::all()->map(function($discount) {
            $discount->fiscal_year = FiscalYear::find($discount->fiscal_year_id)->name;
            return $discount;
        });
        view('app_wrapper', [
            '_include' => 'list',
            'discounts' => $discounts,
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
            }
            if (sizeof($running_fiscal_years) < 1) {
                echo 'The fiscal year is not selected.';
            }
            if (isset($data['id'])) {
                $discount = AppDiscount::find($data['id']);
            } else {
                $discount = new AppDiscount;
            }
            $discount->name = $data['name'];
            $discount->type = $data['type'];
            $discount->fiscal_year_id = $running_fiscal_years->get(0)->id;
            $discount->amount = $data['amount'];
            $discount->is_recurring = isset($data['is_recurring']) ? ($data['is_recurring'] == 'on' ? 1 : 0) : 0;
            $discount->is_active = isset($data['is_active']) ? ($data['is_active'] == 'on' ? 1 : 0) : 0;
            $discount->remarks = $data['remarks'];
            $discount->save();
            echo $discount->id;
        }

        break;

    case 'edit':
        $id = route(3);
        $discount = AppDiscount::find($id);
        if (!$discount) {
            $msg = "Discount not found.";
            r2(U . 'discounts/app/list', 'e', $msg);
        } else {
            view('app_wrapper', [
                '_include' => 'edit',
                'discount' => $discount
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $discount = AppDiscount::find($id);
        if ($discount) {
            $discount->delete();
            $msg = "Discount successfully deleted.";
            $alert = 's';
        }
        r2(U . 'discounts/app/list', $alert, $msg);
        break;
}