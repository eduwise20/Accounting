<?php

require 'apps/student_types/models/AppStudentType.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'student_types');
$ui->assign('_title', 'Student Types ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {


    case 'list':


        $student_types = AppStudentType::orderBy('id', 'desc')->get();

        view('app_wrapper', [
            '_include' => 'list', # This is the template file without extension inside views folder
            'student_types' => $student_types
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
        $remarks = _post('remarks');
        $id = _post('id');

        $validator = new Validator();

        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'remarks' => 'required',
        ]);

        if ($id == '') {
            $viewUrl = 'student_types/app/add';
        } else {
            $viewUrl = 'student_types/app/edit/' . $id;
        }
        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessage = $errors->firstOfAll()[0];
            r2(U . $viewUrl, 'e', $errorMessage);
        } else {
            // Check the id exist, if id not exist we assume we are creating new note
            if ($id == '') {
                $student_types = new AppStudentType;
            } else {
                $student_types = AppStudentType::find($id);

                if (!$student_types) {
                    r2(U . 'student_types/app/edit', 'e', 'Student type not found.');
                }

            }
            $student_types->name = $name;
            $student_types->remarks = $remarks;
            $student_types->save();

            if ($id == '') {
                $message = 'Student type created successfully.';
            } else {
                $message = 'Student type edited successfully';
            }
            r2(U . 'student_types/app/list', 's', $message);

        }


        break;

    case 'edit':

        $id = route(3);

        $student_types = AppStudentType::find($id);

        view('app_wrapper', [
            '_include' => 'edit', # This is the template file without extension inside views folder
            'class' => $student_types
        ]);


        break;


    case 'delete':

        $id = route(3);

        // Find the Note
        $student_types = AppStudentType::find($id);

        // If found, delete the note
        if ($student_types) {
            $student_types->delete();
        }

        // Redirect to the list with success message
        r2(U . 'student_types/app/list', 's', 'Student type deleted successfully');


        break;

}