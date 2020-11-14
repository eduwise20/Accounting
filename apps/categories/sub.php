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
        $subcategories = Subcategory::orderBy('id','desc')->get()
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
        $categories = Category::orderBy('id','desc')->get();
        view('app_wrapper',[
            '_include' => 'sub/add',
            'categories' => $categories
        ]);
        break;

    case 'save':
        $name = _post('name');
        $remarks = _post('remarks');
        $category = _post('category');

        $msg = '';
        if($name == '') {
            $msg .= 'Subcategory Name is required <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required <br>';
        }
        if($category == 0) {
            $msg .= 'Please Select a Category <br>';
        }
        if($name != '' && $remarks != '' && $category != 0) {
            $subcategory = new Subcategory;
            $subcategory->name     = $name;
            $subcategory->remarks  = $remarks;
            $subcategory->category_id  = $category;
            $subcategory->save();
            echo $subcategory->id;
        } else {
            echo $msg;
        }
        break;

    case 'view':
        $id = route(3);
        $subcategory = Subcategory::find($id);
        view('app_wrapper',[
            '_include' => 'sub/view',
            'subcategory' => $subcategory
        ]);
        break;

    case 'edit':
        $id = route(3);
        $categories = Category::orderBy('id','desc')->get();
        $subcategory = Subcategory::find($id);
        $category = Category::find($subcategory->category_id);
        view('app_wrapper',[
            '_include' => 'sub/edit',
            'subcategory' => $subcategory,
            'category' => $category,
            'categories' => $categories,
        ]);
        break;

    case 'update':
        $id = _post('id');
        $name = _post('name');
        $remarks = _post('remarks');
        $category = _post('category');

        $msg = '';
        if($name == '') {
            $msg .= 'Subcategory Name is required <br>';
        }
        if($remarks == '') {
            $msg .= 'Remarks is required <br>';
        }
        if($category == 0) {
            $msg .= 'Please Select a Category <br>';
        }
        $subcategory = Subcategory::find($id);
        if(!$subcategory)
        {
            $msg .= 'Subcategory not found.';
        }
        if($name != '' && $remarks != '' && $category != 0 && $subcategory) {
            $subcategory->name     = $name;
            $subcategory->remarks  = $remarks;
            $subcategory->category_id  = $category;
            $subcategory->save();
            echo $id;
        }
        echo $msg;
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