<?php

require 'apps/fee_names/models/AppFeeName.php';
require 'apps/fee_groups/models/FeeGroup.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'fee_names');
$ui->assign('_title', 'Fee Names ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'list':
        $fee_names = AppFeeName::all()->map(function ($fee_name) {
            $fee_name->fee_group = FeeGroup::find($fee_name->fee_group_id)->name;
            return $fee_name;
        });
        view('app_wrapper', [
            '_include' => 'list',
            'fee_names' => $fee_names,
        ]);
        break;

    case 'add':
        $fee_groups = FeeGroup::all();
        view('app_wrapper', [
            '_include' => 'add',
            'fee_groups' => $fee_groups,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
                'name' => 'required',
                'code' => 'required',
                'fee_group_id' => 'required',
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
            $exist = false;

            if((isset($data['id']) && AppFeeName::find($data['id'])->code != $data['code']) || !isset($data['id'])) {
                $exist = AppFeeName::where('code', $data['code'])->first();
            }
            if($exist) {
                echo 'Code should be unique. <br>';
            } else {
                if (isset($data['id'])) {
                    $fee_name = AppFeeName::find($data['id']);
                } else {
                    $fee_name = new AppFeeName;
                }
                $fee_name->name = $data['name'];
                $fee_name->code = $data['code'];
                $fee_name->fee_group_id = $data['fee_group_id'];
                $fee_name->is_taxable = isset($data['is_taxable']) ? ($data['is_taxable'] == 'on' ? 1 : 0) : 0;
                $fee_name->is_fine_applicable = isset($data['is_fine_applicable']) ? ($data['is_fine_applicable'] == 'on' ? 1 : 0) : 0;
                $fee_name->is_discount_applicable = isset($data['is_discount_applicable']) ? ($data['is_discount_applicable'] == 'on' ? 1 : 0) : 0;
                $fee_name->is_scholarship_applicable = isset($data['is_scholarship_applicable']) ? ($data['is_scholarship_applicable'] == 'on' ? 1 : 0) : 0;
                $fee_name->is_active = isset($data['is_active']) ? ($data['is_active'] == 'on' ? 1 : 0) : 0;
                $fee_name->save();
                echo $fee_name->id;
            }

        }

        break;

    case 'edit':
        $id = route(3);
        $fee_name = AppFeeName::find($id);
        $fee_groups = FeeGroup::all();
        if (!$fee_name) {
            $msg = "Fee Name not found.";
            r2(U . 'fee_names/app/list', 'e', $msg);
        } else {
            view('app_wrapper', [
                '_include' => 'edit',
                'fee_name' => $fee_name,
                'fee_groups' => $fee_groups,
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $fee_name = AppFeeName::find($id);
        if ($fee_name) {
            $fee_name->delete();
            $msg = "Fee Name successfully deleted.";
            $alert = 's';
        }
        r2(U . 'fee_names/app/list', $alert, $msg);
        break;
}