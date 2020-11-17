<?php

require 'apps/student_types/models/AppStudentType.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'student_types');
$ui->assign('_title', 'Student type ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {
    case 'list':
        $student_types = AppStudentType::all();
        view('app_wrapper', [
            '_include' => 'list',
            'student_types' => $student_types
        ]);
        break;

    case 'add':
        view('app_wrapper', [
            '_include' => 'add'
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'remarks' => '',
        ]);

        if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessages = $errors->firstOfAll();
            $msg = '';
            foreach ($errorMessages as $message) {
                $msg .= $message . '</br>';
            }
            echo $msg;
        } else {

            if (isset($data['id'])) {
                $student_type = AppStudentType::find($data['id']);
            } else {
                $student_type = new AppStudentType;
            }
            $student_type->name = $data['name'];
            $student_type->remarks = $data['remarks'];
            $student_type->save();
            echo $student_type->id;
        }
        
        break;

    case 'edit':
        $id = route(3);
        $student_type = AppStudentType::find($id);
        if (!$student_type) {
            $msg = "Student type not found.";
            r2(U . 'student_types/app/list', 'e', $msg);
        } else {
            view('app_wrapper', [
                '_include' => 'edit',
                'student_type' => $student_type
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $student_type = AppStudentType::find($id);
        if ($student_type) {
            $student_type->delete();
            $msg = "Student type successfully deleted.";
            $alert = 's';
        }
        r2(U . 'student_types/app/list', $alert, $msg);
        break;
}