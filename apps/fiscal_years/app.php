<?php

require 'apps/fiscal_years/models/FiscalYear.php';

$action = route(2,'list');
_auth();
$ui->assign('_application_menu', 'fiscal_years');
$ui->assign('_title', 'Fiscal Year '.'- '. $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action){
    case 'list':
        $fiscal_years = FiscalYear::orderBy('id','desc')->get();
        view('app_wrapper',[
            '_include' => 'list',
            'fiscal_years' => $fiscal_years
        ]);
        break;

    case 'add':
        view('app_wrapper',[
            '_include' => 'add'
        ]);
        break;

    case 'save':
        $name = _post('name');
        $remarks = _post('remarks');
        $code = _post('code');
        $order = _post('order');
        $year = _post('year');
        $is_running = _post('is_running');
        $allow_entry = _post('allow_entry');
        $start_date = _post('start_date');
        $end_date = _post('end_date');

        $msg = '';
        if($name == '') {
            $msg .= 'Fiscal Year Name is required. <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required. <br>';
        }
        if($year == '') {
            $msg .= 'Year is required. <br>';
        }
        if($start_date == '') {
            $msg .= 'Start date is required. <br>';
        }
        if($end_date == '') {
            $msg .= 'End date is required. <br>';
        }

        $existCode = FiscalYear::where('code', $code)->first();
        if($code == '') {
            $msg .= 'Code is required. <br>';
        } else if(!is_numeric($code)) {
            $msg .= 'Code should be number only. <br>';
        } else if($existCode) {
            $msg .= 'Code should be unique. <br>';
        }

        $existOrder = FiscalYear::where('order', $order)->first();
        if($order == '') {
            $msg .= 'Order is required. <br>';
        } else if(!is_numeric($code)) {
            $msg .= 'Order should be number only. <br>';
        } else if($existOrder) {
            $msg .= 'Order should be unique. <br>';
        }

        if($name != '' && $remarks != '' && $year && $start_date && $end_date && $code != '' && $order != '' && is_numeric($code) && is_numeric($order) && !$existCode && !$existOrder) {
            $fiscal_year = new FiscalYear;
            $fiscal_year->name     = $name;
            $fiscal_year->remarks  = $remarks;
            $fiscal_year->code     = $code;
            $fiscal_year->order     = $order;
            $fiscal_year->year     = $year;
            $fiscal_year->start_date   = $start_date;
            $fiscal_year->end_date     = $end_date;
            $fiscal_year->is_running = $is_running == 'on' ? 1 : 0;
            $fiscal_year->allow_entry = $allow_entry == 'on' ? 1 : 0;
            $fiscal_year->save();
            echo $fiscal_year->id;
        } else {
            echo $msg;
        }
        break;

    case 'view':
        $id = route(3);
        $fiscal_year = Category::find($id);
        view('app_wrapper',[
            '_include' => 'view',
            'fiscal_year' => $fiscal_year
        ]);
        break;

    case 'edit':
        $id = route(3);
        $fiscal_year = FiscalYear::find($id);
        view('app_wrapper',[
            '_include' => 'edit',
            'fiscal_year' => $fiscal_year
        ]);
        break;

    case 'update':
        $id = _post('id');
        $name = _post('name');
        $remarks = _post('remarks');
        $code = _post('code');
        $order = _post('order');
        $year = _post('year');
        $is_running = _post('is_running');
        $allow_entry = _post('allow_entry');
        $start_date = _post('start_date');
        $end_date = _post('end_date');

        $fiscal_year = FiscalYear::find($id);
        if(!$fiscal_year)
        {
            $msg .= 'Fiscal Year not found.';
        }

        $existCode = false;
        $existOrder = false;
        $msg = '';
        if($name == '') {
            $msg .= 'Fiscal Year is required <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required <br>';
        }
        if($year == '') {
            $msg .= 'Year is required. <br>';
        }
        if($start_date == '') {
            $msg .= 'Start date is required. <br>';
        }
        if($end_date == '') {
            $msg .= 'End date is required. <br>';
        }

        if($fiscal_year->code != $code) {
            $existCode = FiscalYear::where('code', $code)->first();
        }
        if($code == '') {
            $msg .= 'Code is required <br>';
        } else if(!is_numeric($code)) {
            $msg .= 'Code should be number only. <br>';
        } else if($existCode) {
            $msg .= 'Code should be unique. <br>';
        } 

        if($fiscal_year->order != $order) {
            $existOrder = FiscalYear::where('order', $order)->first();
        }
        if($order == '') {
            $msg .= 'Order is required <br>';
        } else if(!is_numeric($order)) {
            $msg .= 'Order should be number only. <br>';
        } else if($existOrder) {
            $msg .= 'Order should be unique. <br>';
        } 

        if($name != '' && $remarks != ''  && $year && $start_date && $end_date && $code != '' && $order != '' && $fiscal_year && is_numeric($code) && !$existOrder && is_numeric($order) && !$existOrder) {
            $fiscal_year->name     = $name;
            $fiscal_year->remarks  = $remarks;
            $fiscal_year->code  = $code;
            $fiscal_year->order  = $order;
            $fiscal_year->year     = $year;
            $fiscal_year->start_date   = $start_date;
            $fiscal_year->end_date     = $end_date;
            $fiscal_year->is_running = $is_running == 'on' ? 1 : 0;
            $fiscal_year->allow_entry = $allow_entry == 'on' ? 1 : 0;
            $fiscal_year->save();
            echo $id;
        }
        echo $msg;
        break;

    case 'delete':
        $id = route(3);
        $fiscal_year = FiscalYear::find($id);
        if($fiscal_year){
            $fiscal_year->delete();
            $msg = "Fiscal Year successfully deleted.";
            $alert = 's';
        }
        r2(U.'fiscal_years/app/list',$alert,$msg);
        break;
}