<?php

require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';


$action = route(2,'list');
_auth();
$ui->assign('_application_menu', 'categories');
$ui->assign('_title', 'Subcategory '.'- '. $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action){
    case 'list':
        $subcategories = Subcategory::all()
            ->map(function($subcategory) {
                $subcategory->category = Category::find($subcategory->category_id)->name;
                return $subcategory;
            });
        view('app_wrapper',[
            '_include' => 'sub/list',
            'subcategories' => $subcategories
        ]);
        break;

    case 'add':
        $categories = Category::orderBy('name','asc')->get();
        view('app_wrapper',[
            '_include' => 'sub/add',
            'categories' => $categories
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
                'name' => 'required',
                'remarks' => 'required',
                'category' => 'not_in:0'
            ],
            [
                'category:not_in' => 'The Category is required',
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
            if(isset($data['id'])) {
                $subcategory = Subcategory::find($data['id']);
            } else {
                $subcategory = new Subcategory;
            }
            $subcategory->name     = $data['name'];
            $subcategory->remarks  = $data['remarks'];
            $subcategory->category_id  = $data['category'];
            $subcategory->save();
            echo $subcategory->id;
        } 
        break;

    case 'edit':
        $id = route(3);
        $categories = Category::orderBy('name','asc')->get();
        $subcategory = Subcategory::find($id);
        $category = Category::find($subcategory->category_id);
        view('app_wrapper',[
            '_include' => 'sub/edit',
            'subcategory' => $subcategory,
            'category' => $category,
            'categories' => $categories,
        ]);
        break;

    case 'delete':
        $id = route(3);
        $subcategory = Subcategory::find($id);
        if($subcategory){
            $subcategory->delete();
        }
        r2(U.'categories/sub/list','s','Subcategory successfully deleted.');
        break;
}