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
        $name = _post('name');
        $remarks = _post('remarks');

        $msg = '';
        if($name == '') {
            $msg .= 'Category Name is required. <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required. <br>';
        }
        if($name != '' && $remarks != '') {
            $category = new Category;
            $category->name     = $name;
            $category->remarks  = $remarks;
            $category->save();
            echo $category->id;
        } else {
            echo $msg;
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

    case 'update':
        $id = _post('id');
        $name = _post('name');
        $remarks = _post('remarks');

        $msg = '';
        if($name == '') {
            $msg .= 'Category Name is required. <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required. <br>';
        }
        $category = Category::find($id);
        if(!$category)
        {
            $msg .= 'Category not found.';
        }
        if($name != '' && $remarks != '' && $category) {
            $category->name     = $name;
            $category->remarks  = $remarks;
            $category->save();
            echo $id;
        }
        echo $msg;
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