<?php

require 'apps/billing_periods/models/BillingPeriod.php';

$action = route(2,'list');
_auth();
$ui->assign('_application_menu', 'billing_periods');
$ui->assign('_title', 'Billing Period '.'- '. $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action){
    case 'list':
        $billing_periods = BillingPeriod::orderBy('id','desc')->get();
        view('app_wrapper',[
            '_include' => 'list',
            'billing_periods' => $billing_periods
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
        $hierarchy = _post('hierarchy');
        $is_active = _post('is_active');

        $msg = '';
        if($name == '') {
            $msg .= 'Name is required. <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required. <br>';
        }
        $existHierarchy = BillingPeriod::where('hierarchy', $hierarchy)->first();
        if($hierarchy == '') {
            $msg .= 'Hierarchy is required. <br>';
        } else if(!is_numeric($hierarchy)) {
            $msg .= 'Hierarchy should be number only. <br>';
        } else if($existHierarchy) {
            $msg .= 'Hierarchy should be unique. <br>';
        }
        
        $existCode = BillingPeriod::where('code', $code)->first();
        if($code == '') {
            $msg .= 'Code is required. <br>';
        } else if(!is_numeric($code)) {
            $msg .= 'Code should be number only. <br>';
        } else if($existCode) {
            $msg .= 'Code should be unique. <br>';
        }

        if($name != '' && $remarks != '' && $code != '' && $hierarchy != '' && is_numeric($code) && !$existHierarchy && !$existHierarchy) {
            $billing_period = new BillingPeriod;
            $billing_period->name     = $name;
            $billing_period->remarks  = $remarks;
            $billing_period->hierarchy  = $hierarchy;
            $billing_period->code     = $code;
            $billing_period->is_active = $is_active == 'on' ? 1 : 0;
            $billing_period->save();
            echo $billing_period->id;
        } else {
            echo $msg;
        }
        break;

    case 'view':
        $id = route(3);
        $billing_period = Category::find($id);
        view('app_wrapper',[
            '_include' => 'view',
            'billing_period' => $billing_period
        ]);
        break;

    case 'edit':
        $id = route(3);
        $billing_period = BillingPeriod::find($id);
        view('app_wrapper',[
            '_include' => 'edit',
            'billing_period' => $billing_period
        ]);
        break;

    case 'update':
        $id = _post('id');
        $name = _post('name');
        $remarks = _post('remarks');
        $code = _post('code');
        $hierarchy = _post('hierarchy');
        $is_active = _post('is_active');

        $msg = '';

        $billing_period = BillingPeriod::find($id);
        if(!$billing_period)
        {
            $msg .= 'Billing Period not found.';
        }

        $existHierarchy = false;
        $existCode = false;
        if($name == '') {
            $msg .= 'Name is required <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required <br>';
        }
        if($hierarchy == '') {
            $msg .= 'Hierarchy is required. <br>';
        }

        if($billing_period->hierarchy != $hierarchy) {
            $existHierarchy = BillingPeriod::where('hierarchy', $hierarchy)->first();
        }
        if($hierarchy == '') {
            $msg .= 'Hierarchy is required. <br>';
        } else if(!is_numeric($hierarchy)) {
            $msg .= 'Hierarchy should be number only. <br>';
        } else if($existHierarchy) {
            $msg .= 'Hierarchy should be unique. <br>';
        }
        
        if($billing_period->code != $code) {
            $existCode = BillingPeriod::where('code', $code)->first();
        }
        if($code == '') {
            $msg .= 'Code is required. <br>';
        } else if(!is_numeric($code)) {
            $msg .= 'Code should be number only. <br>';
        } else if($existCode) {
            $msg .= 'Code should be unique. <br>';
        }

        if($name != '' && $remarks != '' && $code != '' && $hierarchy != '' && $billing_period && is_numeric($hierarchy) && is_numeric($code) && !$existHierarchy && !$existCode) {
            $billing_period->name     = $name;
            $billing_period->remarks  = $remarks;
            $billing_period->hierarchy  = $hierarchy;
            $billing_period->code  = $code;
            $billing_period->is_active = $is_active == 'on' ? 1 : 0;
            $billing_period->save();
            echo $id;
        }
        echo $msg;
        break;

    case 'delete':
        $id = route(3);
        $billing_period = BillingPeriod::find($id);
        if($billing_period){
            $billing_period->delete();
            $msg = "Billing Period successfully deleted.";
            $alert = 's';
        }
        r2(U.'billing_periods/app/list',$alert,$msg);
        break;
}