<?php

require 'apps/faculties/models/AppFaculty.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'faculties');
$ui->assign('_title', 'Classes ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {


    case 'list':


        $faculties = AppFaculty::orderBy('id', 'desc')->get();

        view('app_wrapper', [
            '_include' => 'list', # This is the template file without extension inside views folder
            'faculties' => $faculties
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

        $faculty = AppFaculty::where('code', $code)->where('id', '!=', $id)->first();

        if ($id == '') {
            $viewUrl = 'faculties/app/add';
        } else {
            $viewUrl = 'faculties/app/edit/'.$id;
        }

        if ($faculty) {
            r2(U . $viewUrl, 'e', 'Code already exists.');
        } else if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessage = $errors->firstOfAll()[0];
            r2(U . $viewUrl, 'e', $errorMessage);
        } else {
            // Check the id exist, if id not exist we assume we are creating new note
            if ($id == '') {
                $faculty = new AppFaculty;
            } else {
                $faculty = AppFaculty::find($id);

                if (!$faculty) {
                    r2(U . 'faculties/app/edit', 'e', 'Faculty not found.');
                }

            }
            $faculty->name = $name;
            $faculty->code = $code;
            $faculty->save();

            if ($id == '') {
                $message = 'Faculty created successfully.';
            } else {
                $message = 'Faculty edited successfully';
            }
            r2(U . 'faculties/app/list', 's', $message);

        }


        break;

    case 'edit':

        $id = route(3);

        $faculty = AppFaculty::find($id);

        view('app_wrapper', [
            '_include' => 'edit', # This is the template file without extension inside views folder
            'faculty' => $faculty
        ]);


        break;


    case 'delete':

        $id = route(3);

        // Find the Note
        $faculty = AppFaculty::find($id);

        // If found, delete the note
        if ($faculty) {
            $faculty->delete();
        }

        // Redirect to the list with success message
        r2(U . 'faculties/app/list', 's', 'Faculty deleted successfully');


        break;

}