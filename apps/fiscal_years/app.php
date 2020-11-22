<?php

require 'apps/fiscal_years/models/FiscalYear.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'fiscal_years');
$ui->assign('_title', 'Fiscal Year ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'list':
        $fiscal_years = FiscalYear::orderBy('id', 'desc')->get();
        view('app_wrapper', [
            '_include' => 'list',
            'fiscal_years' => $fiscal_years
        ]);
        break;

    case 'add':
        view('app_wrapper', [
            '_include' => 'add'
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'remarks' => '',
            'code' => 'required',
            'order' => 'required',
            'year' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
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
            $existOrder = false;

            if ((isset($data['id']) && FiscalYear::find($data['id'])->code != $data['code']) || !isset($data['id'])) {
                $existCode = FiscalYear::where('code', $data['code'])->first();
            }
            if ((isset($data['id']) && FiscalYear::find($data['id'])->order != $data['order']) || !isset($data['id'])) {
                $existOrder = FiscalYear::where('order', $data['order'])->first();
            }


            if ($existCode) {
                echo 'Code should be unique. <br>';
            } else if ($existOrder) {
                echo 'Order should be unique. <br>';
            } else if ($data['start_date'] <= $data['end_date']) {
                echo 'End date should be greater than start date. <br>';
            } else {
                if (isset($data['id'])) {
                    $fiscal_year = FiscalYear::find($data['id']);
                } else {
                    $fiscal_year = new FiscalYear;
                }

                $fiscal_year->name = $data['name'];
                $fiscal_year->remarks = $data['remarks'];
                $fiscal_year->code = $data['code'];
                $fiscal_year->order = $data['order'];
                $fiscal_year->year = $data['year'];
                $fiscal_year->start_date = $data['start_date'];
                $fiscal_year->end_date = $data['end_date'];

                if (isset($data['is_running']) && $data['is_running'] == 'on') {
                    $fiscal_year->is_running = 1;
                    // if is_running is true all other is_running will be false
                    $running_fiscal_years = FiscalYear::where('is_running', 1);
                    if (isset($data['id'])) {
                        $running_fiscal_years->where('id', '!=', $data['id']);
                    }
                    $running_fiscal_years->update(['is_running' => 0]);

                } else {
                    $fiscal_year->is_running = 0;
                }

                $fiscal_year->allow_entry = isset($data['allow_entry']) ? ($data['allow_entry'] == 'on' ? 1 : 0) : 0;
                $fiscal_year->save();
                echo $fiscal_year->id;
            }
        }
        break;

    case 'edit':
        $id = route(3);
        $fiscal_year = FiscalYear::find($id);
        view('app_wrapper', [
            '_include' => 'edit',
            'fiscal_year' => $fiscal_year
        ]);
        break;

    case 'delete':
        $id = route(3);
        $fiscal_year = FiscalYear::find($id);
        $msg = "Fiscal Year successfully deleted.";
        if ($fiscal_year) {
            $fiscal_year->delete();
        }
        r2(U . 'fiscal_years/app/list', 's', $msg);
        break;
}