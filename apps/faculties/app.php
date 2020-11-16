<?php

require 'apps/faculties/models/AppFaculty.php';

$action = route(2,'list');
_auth();
$ui->assign('_application_menu', 'faculties');
$ui->assign('_title', 'Faculty '.'- '. $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action){
    case 'list':
        $faculties = AppFaculty::all();
        view('app_wrapper',[
            '_include' => 'list',
            'faculties' => $faculties
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

            if((isset($data['id']) && AppFaculty::find($data['id'])->code != $data['code']) || !isset($data['id'])) {
                $exist = AppFaculty::where('code', $data['code'])->first();
            }
            if($exist) {
                echo 'Code should be unique. <br>';
            } else {
                if(isset($data['id'])) {
                    $faculty = AppFaculty::find($data['id']);
                } else {
                    $faculty = new AppFaculty;
                }
                $faculty->name = $data['name'];
                $faculty->code = $data['code'];
                $faculty->save();
                echo $faculty->id;
            }
        }
        break;

    case 'edit':
        $id = route(3);
        $faculty = AppFaculty::find($id);
        if(!$faculty) {
            $msg = "Faculty not found.";
            r2(U.'faculties/app/list','e',$msg);
        } else {
            view('app_wrapper',[
                '_include' => 'edit',
                'faculty' => $faculty
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $faculty = AppFaculty::find($id);
        if($faculty){
            $faculty->delete();
            $msg = "Faculty successfully deleted.";
            $alert = 's';
        }
        r2(U.'faculties/app/list',$alert,$msg);
        break;
}