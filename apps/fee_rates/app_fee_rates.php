<?php

require 'apps/fee_rates/models/AppFeeRate.php';
require 'apps/fee_rates/models/AppFeeStructure.php';
require 'apps/fee_names/models/AppFeeName.php';
require 'apps/classes/models/AppClass.php';
require 'apps/faculties/models/AppFaculty.php';
require 'apps/categories/models/Category.php';
require 'apps/categories/models/Subcategory.php';
require 'apps/fiscal_years/models/FiscalYear.php';
require 'apps/student_types/models/AppStudentType.php';

$action = route(2, 'list');

_auth();
$ui->assign('_application_menu', 'fee_rates');
$ui->assign('_title', 'Fee rates List ' . '- ' . $config['CompanyName']);
$user = User::_info();
$ui->assign('user', $user);

switch ($action) {

    case 'list':
        $fee_names = AppFeeName::where('is_active', 1)->get();
        $classes = AppClass::all();
        $fiscal_years = FiscalYear::where('is_running', 1)->get();
        $student_types = AppStudentType::all();
        $categories = Category::all();
        $sub_categories = Subcategory::all();

        view('app_wrapper', [
            '_include' => 'list',
            'fee_names' => $fee_names,
            'classes' => $classes,
            'fiscal_year' => count($fiscal_years) > 0 ? $fiscal_years[0] : 0,
            'student_types' => $student_types,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
        ]);
        break;

    case 'getFacultyForClass':
        $data = $request->all();
        $faculties = AppFaculty::where('class_id', $data['class_id'])->get();
        echo json_encode($faculties);
        break;

    case 'getFeeStructuresForFeeRate':
        $data = $request->all();
        $where = [
            'fiscal_year_id' => $data['fiscal_year_id'],
            'class_id' => $data['class_id'],
            'student_type_id' => $data['student_type_id'],
            'faculty_id' => $data['faculty_id'],
            'category_id' => $data['category_id'],
            'sub_category_id' => $data['sub_category_id'],
        ];
       
           $filterArray = [];
           $class = AppClass::find($data['class_id']);
           $filterArray['class'] = $class->name;

           $studentType = AppStudentType::find($data['student_type_id']);
           $filterArray['student_type'] = $studentType->name;

           if($data['faculty_id'] != 0){
                $faculty = AppFaculty::find($data['faculty_id']);
                $filterArray['faculty'] = $faculty->name;
           }else{
                $filterArray['faculty'] = '-';
           }

            if($data['category_id'] != 0){
                 $category = Category::find($data['category_id']);
                 $filterArray['category'] = $category->name;
            }else{
                $filterArray['category'] = '-';
            }

            if($data['sub_category_id'] != 0){
                $subCategory = Subcategory::find($data['sub_category_id']);
                $filterArray['sub_category'] = $subCategory->name;
            }else{
               $filterArray['sub_category'] = '-';
            }
          
        $fee_rate = AppFeeRate::where($where)->get();
        if(count($fee_rate) > 0) {
            $fee_structures = AppFeeStructure::where('fee_rate_id', $fee_rate[0]->id)->get();
            echo json_encode(['fee_structures' => $fee_structures,'filterData' =>$filterArray ]);
        }
        break;

    case 'getSubCategoriesForCategory':
        $data = $request->all();
        $sub_categories = Subcategory::where('category_id', $data['category_id'])->get();
        echo json_encode($sub_categories);
        break;

}