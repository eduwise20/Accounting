<?php

require 'apps/classes/models/AppClass.php';

$action = route(2,'list');
_auth();
$ui->assign('_application_menu', 'classes');
$ui->assign('_title', 'Class '.'- '. $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action){
    case 'list':
        $classes = AppClass::all();
        view('app_wrapper',[
            '_include' => 'list',
            'classes' => $classes
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

            if((isset($data['id']) && AppClass::find($data['id'])->code != $data['code']) || !isset($data['id'])) {
                $exist = AppClass::where('code', $data['code'])->first();
            }
            if($exist) {
                echo 'Code should be unique. <br>';
            } else {
                if(isset($data['id'])) {
                    $class = AppClass::find($data['id']);
                } else {
                    $class = new AppClass;
                }
                $class->name = $data['name'];
                $class->code = $data['code'];
                $class->save();
                echo $class->id;
            }
        }
        break;

    case 'edit':
        $id = route(3);
        $class = AppClass::find($id);
        if(!$class) {
            $msg = "Class not found.";
            r2(U.'classes/app/list','e',$msg);
        } else {
            view('app_wrapper',[
                '_include' => 'edit',
                'class' => $class
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $class = AppClass::find($id);
        if($class){
            $class->delete();
            $msg = "Class successfully deleted.";
            $alert = 's';
        }
        r2(U.'classes/app/list',$alert,$msg);
        break;
}