<?php

require 'apps/fee_groups/models/FeeGroup.php';

$action = route(2,'list');
_auth();
$ui->assign('_application_menu', 'fee_groups');
$ui->assign('_title', 'Fee Group '.'- '. $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action){
    case 'list':
        $fee_groups = FeeGroup::orderBy('id','desc')->get();
        view('app_wrapper',[
            '_include' => 'list',
            'fee_groups' => $fee_groups
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
        $is_active = _post('is_active');

        $msg = '';
        if($name == '') {
            $msg .= 'Fee Group Name is required. <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required. <br>';
        }
        $exist = FeeGroup::where('code', $code)->first();
        if($code == '') {
            $msg .= 'Code is required. <br>';
        } else if(!is_numeric($code)) {
            $msg .= 'Code should be number only. <br>';
        } else if($exist) {
            $msg .= 'Code should be unique. <br>';
        }

        if($name != '' && $remarks != '' && $code != '' && is_numeric($code) && !$exist) {
            $fee_group = new FeeGroup;
            $fee_group->name     = $name;
            $fee_group->remarks  = $remarks;
            $fee_group->code     = $code;
            $fee_group->is_active = $is_active == 'on' ? 1 : 0;
            $fee_group->save();
            echo $fee_group->id;
        } else {
            echo $msg;
        }
        break;

    case 'view':
        $id = route(3);
        $fee_group = Category::find($id);
        view('app_wrapper',[
            '_include' => 'view',
            'fee_group' => $fee_group
        ]);
        break;

    case 'edit':
        $id = route(3);
        $fee_group = FeeGroup::find($id);
        view('app_wrapper',[
            '_include' => 'edit',
            'fee_group' => $fee_group
        ]);
        break;

    case 'update':
        $id = _post('id');
        $name = _post('name');
        $remarks = _post('remarks');
        $code = _post('code');
        $is_active = _post('is_active');

        $fee_group = FeeGroup::find($id);
        if(!$fee_group)
        {
            $msg .= 'Fee Group not found.';
        }

        $exist = false;
        $msg = '';
        if($name == '') {
            $msg .= 'Fee Group is required <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required <br>';
        }
        if($code == '') {
            $msg .= 'Code is required <br>';
        } else if(!is_numeric($code)) {
            $msg .= 'Code should be number only. <br>';
        }
        if($fee_group->code != $code) {
            $exist = FeeGroup::where('code', $code)->first();
        }
        if($exist) {
            $msg .= 'Code should be unique. <br>';
        } 

        if($name != '' && $remarks != '' && $code != '' && $fee_group && is_numeric($code) && !$exist) {
            $fee_group->name     = $name;
            $fee_group->remarks  = $remarks;
            $fee_group->code  = $code;
            $fee_group->is_active = $is_active == 'on' ? 1 : 0;
            $fee_group->save();
            echo $id;
        }
        echo $msg;
        break;

    case 'delete':
        $id = route(3);
        $fee_group = FeeGroup::find($id);
        if($fee_group){
            $fee_group->delete();
            $msg = "Fee Group successfully deleted.";
            $alert = 's';
        }
        r2(U.'fee_groups/app/list',$alert,$msg);
        break;
}