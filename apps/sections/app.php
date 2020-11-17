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
        $sections = AppSection::all()->map(function($section) {
            $section->class = AppClass::find($section->class_id)->name;
            return $section;
        });
        view('app_wrapper', [
            '_include' => 'list',
            'sections' => $sections,
        ]);
        break;

    case 'add':
        $classes = AppClass::all();
        view('app_wrapper', [
            '_include' => 'add',
            'classes' => $classes,
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
                'name' => 'required',
                'code' => 'required|numeric',
                'class_id' => 'required|not_in:0',
            ],
            [
                'class_id:not_in' => 'The Class is required',
            ]    
        );

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

            if((isset($data['id']) && AppSection::find($data['id'])->code != $data['code']) || !isset($data['id'])) {
                $exist = AppSection::where('code', $data['code'])->first();
            }
            if($exist) {
                echo 'Code should be unique. <br>';
            } else {
                if(isset($data['id'])) {
                    $section = AppSection::find($data['id']);
                } else {
                    $section = new AppSection;
                }
                $section->name = $data['name'];
                $section->code = $data['code'];
                $section->class_id = $data['class_id'];
                $section->save();
                echo $section->id;
            }
        }
        break;

    case 'edit':
        $id = route(3);
        $section = AppSection::find($id);
        $classes = AppClass::all();
        if(!$section) {
            $msg = "Section not found.";
            r2(U.'sections/app/list','e',$msg);
        } else {
            view('app_wrapper', [
                '_include' => 'edit',
                'section' => $section,
                'classes' => $classes
            ]);
        }
        break;

    case 'delete':
        $id = route(3);
        $section = AppSection::find($id);
        if($section){
            $section->delete();
            $msg = "Section successfully deleted.";
            $alert = 's';
        }
        r2(U.'sections/app/list',$alert,$msg);
        break;
}