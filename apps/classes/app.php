<?php

require 'apps/classes/models/AppCLass.php';

$action = route(2,'list');
_auth();
$ui->assign('_application_menu', 'classes');
$ui->assign('_title', 'Classes '.'- '. $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action){


    case 'list':


        $classes = AppCLass::orderBy('id','desc')->get();

        view('app_wrapper',[
            '_include' => 'list', # This is the template file without extension inside views folder
            'classes' => $classes
        ]);

        break;


    case 'add':

        view('app_wrapper',[
            '_include' => 'add' # This is the template file without extension inside views folder
        ]);

        break;


    case 'save':

        // This route will handle form post for adding new notes and editing existing notes

        $name = _post('name');
        $code = _post('code');
        $id = _post('id');

        if($name == '' || $code == ''){
            r2(U.'classes/app/add','e','All fields are required.');
        }


        // Check the id exist, if id not exist we assume we are creating new note
        if($id == '')
        {
            // Create New Note
            $class = new AppClass;
        }
        else{
            // Find the Note by Id
            $class = AppClass::find($id);

            // If note not exist We will redirect the user back to the list

            if(!$class)
            {
                r2(U.'classes/app/list','e','Classes not found.');
            }

        }

        // Now save the note
        $class->name = $name;
        $class->code = $code;
        $class->save();

        r2(U.'classes/app/list','s','Class created successfully.');


        break;


    case 'view':

        $id = route(3);

        $class = AppClass::find($id);

        view('app_wrapper',[
            '_include' => 'view', # This is the template file without extension inside views folder
            'class' => $class
        ]);


        break;


    case 'edit':

        $id = route(3);

        $class = AppClass::find($id);

        view('app_wrapper',[
            '_include' => 'edit', # This is the template file without extension inside views folder
            'class' => $class
        ]);


        break;


    case 'delete':

        $id = route(3);

        // Find the Note
        $class = AppClass::find($id);

        // If found, delete the note
        if($class){
            $class->delete();
        }

        // Redirect to the list with success message
        r2(U.'classes/app/list','s','Deleted successfully');


        break;

}