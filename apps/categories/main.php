<?php

require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';

$action = route(2,'list');
_auth();
$ui->assign('_application_menu', 'categories');
$ui->assign('_title', 'Category '.'- '. $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action){
    case 'list':
        $categories = Category::orderBy('id','desc')->get();
        view('app_wrapper',[
            '_include' => 'main/list',
            'categories' => $categories
        ]);
        break;

    case 'add':
        view('app_wrapper',[
            '_include' => 'main/add'
        ]);
        break;

    case 'save':
        $validator = new Validator();
        $data = $request->all();

        $validation = $validator->validate($data, [
            'name' => 'required',
            'remarks' => 'required',
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
            if(isset($data['id'])) {
                $category = Category::find($data['id']);
            } else {
                $category = new Category;
            }
            $category->name     = $data['name'];
            $category->remarks  = $data['remarks'];
            $category->save();
            echo $category->id;
        }
        break;

    case 'view':
        $id = route(3);
        $category = Category::find($id);
        view('app_wrapper',[
            '_include' => 'main/view',
            'category' => $category
        ]);
        break;

    case 'edit':
        $id = route(3);
        $category = Category::find($id);
        view('app_wrapper',[
            '_include' => 'main/edit',
            'category' => $category
        ]);
        break;

    case 'delete':
        $id = route(3);
        $category = Category::find($id);
        if($category){
            $category->delete();
            Subcategory::where('category_id', $id)->delete();
            $msg = "Category and it's subcategories successfully deleted.";
        }
        r2(U.'categories/main/list','s',$msg);
        break;
}