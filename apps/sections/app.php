<?php

require 'apps/classes/models/AppClass.php';
require 'apps/sections/models/AppSection.php';

$action = route(2, 'list');
_auth();
$ui->assign('_application_menu', 'sections');
$ui->assign('_title', 'Sections ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {


    case 'list':


        $sections = AppSection::orderBy('id', 'desc')->get();
        $classes = AppClass::orderBy('id', 'desc')->get();
        $classIdNameArray = array();
        foreach ($classes as $class) {
            $classIdNameArray[$class->id] = $class->name;
        }

        view('app_wrapper', [
            '_include' => 'list', # This is the template file without extension inside views folder
            'sections' => $sections,
            'classes' => $classes,
            'classIdNameArray' => $classIdNameArray,
        ]);

        break;


    case 'add':

        $classes = AppClass::orderBy('id', 'desc')->get();

        view('app_wrapper', [
            '_include' => 'add', # This is the template file without extension inside views folder
            'classes' => $classes,
        ]);

        break;


    case 'save':

        // This route will handle form post for adding new notes and editing existing notes
        $name = _post('name');
        $code = _post('code');
        $class_id = _post('class_id');
        $id = _post('id');

        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'code' => 'required|numeric',
            'class_id' => 'required',
        ]);

        $section = AppSection::where('code', $code)->where('id', '!=', $id)->first();

        if ($id == '') {
            $viewUrl = 'sections/app/add';
        } else {
            $viewUrl = 'sections/app/edit/' . $id;
        }

        if ($section) {
            r2(U . $viewUrl, 'e', 'Code already exists.');
        } else if ($validation->fails()) {
            $errors = $validation->errors();
            $errorMessage = $errors->firstOfAll()[0];
            r2(U . $viewUrl, 'e', $errorMessage);
        } else {
            // Check the id exist, if id not exist we assume we are creating new note
            if ($id == '') {
                $section = new AppSection;
            } else {
                $section = AppSection::find($id);

                if (!$section) {
                    r2(U . 'sections/app/edit', 'e', 'Section not found.');
                }

            }
            $section->name = $name;
            $section->code = $code;
            $section->class_id = $class_id;

            $section->save();

            if ($id == '') {
                $message = 'Section created successfully.';
            } else {
                $message = 'Section edited successfully';
            }
            r2(U . 'sections/app/list', 's', $message);

        }


        break;

    case 'edit':

        $id = route(3);

        $section = AppSection::find($id);
        $classes = AppClass::orderBy('id', 'desc')->get();

        view('app_wrapper', [
            '_include' => 'edit', # This is the template file without extension inside views folder
            'section' => $section,
            'classes' => $classes
        ]);


        break;


    case 'delete':

        $id = route(3);

        // Find the Note
        $section = AppSection::find($id);

        // If found, delete the note
        if ($section) {
            $section->delete();
        }

        // Redirect to the list with success message
        r2(U . 'sections/app/list', 's', 'Section deleted successfully');


        break;

}