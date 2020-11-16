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
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'code' => 'required|numeric',
            'remarks' => 'required',
            'hierarchy' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessages = $errors->firstOfAll();
            $msg = '';
            foreach($errorMessages as $message) {
                $msg .= $message.'</br>';
            }
            echo $msg;
        } else {
            $existCode = false;
            $existHierarchy = false;

            if((isset($data['id']) && BillingPeriod::find($data['id'])->code != $data['code']) || !isset($data['id'])) {
                $existCode = BillingPeriod::where('code', $data['code'])->first();
            } 
            if((isset($data['id']) && BillingPeriod::find($data['id'])->code != $data['hierarchy']) || !isset($data['id'])) {
                $existHierarchy = BillingPeriod::where('hierarchy', $data['hierarchy'])->first();
            } 

            if($existCode) {
                echo 'Code should be unique. <br>';
            } else if ($existHierarchy) {
                echo 'Hierarchy should be unique. <br>';
            } else {
                if(isset($data['id'])) {
                    $billing_period = BillingPeriod::find($data['id']);
                } else {
                    $billing_period = new BillingPeriod;
                }
                $billing_period->name  = $data['name'];
                $billing_period->remarks  = $data['remarks'];
                $billing_period->code     = $data['code'];
                $billing_period->hierarchy  = $data['hierarchy'];
                $billing_period->is_active = isset($data['is_active']) ? ($data['is_active'] == 'on' ? 1 : 0) : 0;
                $billing_period->save();
                echo $billing_period->id;
            }
        }
        break;

    case 'view':
        $id = route(3);
        $billing_period = BillingPeriod::find($id);
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

    case 'delete':
        $id = route(3);
        $billing_period = BillingPeriod::find($id);
        if($billing_period){
            $billing_period->delete();
            $msg = "Billing Period successfully deleted.";
        }
        r2(U.'billing_periods/app/list','s',$msg);
        break;
}