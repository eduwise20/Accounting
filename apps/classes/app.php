<?php

require 'apps/classes/models/AppCLass.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'classes');
$ui->assign('_title', 'Classes ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {


    case 'list':


        $classes = AppCLass::orderBy('id', 'desc')->get();

        view('app_wrapper', [
            '_include' => 'list', # This is the template file without extension inside views folder
            'classes' => $classes
        ]);

        break;


    case 'add':

        view('app_wrapper', [
            '_include' => 'add' # This is the template file without extension inside views folder
        ]);

        break;


    case 'save':

        // This route will handle form post for adding new notes and editing existing notes
        $name = _post('name');
        $code = _post('code');
        $id = _post('id');

        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'code' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessage = $errors->firstOfAll()[0];
            responseWithError($errorMessage);
        } else {
            // Check the id exist, if id not exist we assume we are creating new note
            if ($id == '') {
                $class = new AppClass;
            } else {
                $class = AppClass::find($id);

                if (!$class) {
                    responseWithError('Classes not found');
                }

            }
            $class->name = $name;
            $class->code = $code;
            $class->save();

            if ($id == '') {
                $message = 'Class created successfully.';
            } else {
                $message = 'Class edited successfully';
            }
            r2(U . 'classes/app/list', 's', $message);

        }


        break;


    case 'view':

        $id = route(3);

        $class = AppClass::find($id);

        view('app_wrapper', [
            '_include' => 'view', # This is the template file without extension inside views folder
            'class' => $class
        ]);


        break;


    case 'edit':

        $id = route(3);

        $class = AppClass::find($id);

        view('app_wrapper', [
            '_include' => 'edit', # This is the template file without extension inside views folder
            'class' => $class
        ]);


        break;


    case 'delete':

        $id = route(3);

        // Find the Note
        $class = AppClass::find($id);

        // If found, delete the note
        if ($class) {
            $class->delete();
        }

        // Redirect to the list with success message
        r2(U . 'classes/app/list', 's', 'Deleted successfully');


        break;

}