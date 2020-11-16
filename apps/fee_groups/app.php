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
        $fee_groups = FeeGroup::all();
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
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'code' => 'required|numeric',
            'remarks' => 'required',
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
            $exist = false;

            if((isset($data['id']) && FeeGroup::find($data['id'])->code != $data['code']) || !isset($data['id'])) {
                $exist = FeeGroup::where('code', $data['code'])->first();
            } 
            if($exist) {
                echo 'Code should be unique. <br>';
            } else {
                if(isset($data['id'])) {
                    $fee_group = FeeGroup::find($data['id']);
                } else {
                    $fee_group = new FeeGroup;
                }
                $fee_group->name  = $data['name'];
                $fee_group->remarks  = $data['remarks'];
                $fee_group->code     = $data['code'];
                $fee_group->is_active = isset($data['is_active']) ? ($data['is_active'] == 'on' ? 1 : 0) : 0;
                $fee_group->save();
                echo $fee_group->id;
            }
        }
        break;

    case 'edit':
        $id = route(3);
        $fee_group = FeeGroup::find($id);
        view('app_wrapper',[
            '_include' => 'edit',
            'fee_group' => $fee_group
        ]);
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