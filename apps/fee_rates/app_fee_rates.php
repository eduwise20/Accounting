<?php

use function Clue\StreamFilter\fun;

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
        $currentFiscalYear = FiscalYear::where('is_running',1)->first();
        $where = [
            'fiscal_year_id' => $currentFiscalYear->id,
        ];
        $fee_rates = AppFeeRate::where($where)->get();
        if(count($fee_rates) > 0) {
            $feeNamesWithRates = getFeeRates($fee_rates);
       }else{
            $feeNamesWithRates = '';
       }


        view('app_wrapper', [
            '_include' => 'list',
            'fee_names' => $fee_names,
            'classes' => $classes,
            'fiscal_year' => count($fiscal_years) > 0 ? $fiscal_years[0] : 0,
            'student_types' => $student_types,
            'categories' => $categories,
            'sub_categories' => $sub_categories,
            'feeNamesWithRates' => $feeNamesWithRates
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
         ];

        if($data['class_id'] != 0){
            $where['class_id'] = $data['class_id'];
        }

        if($data['student_type_id'] != 0){
            $where['student_type_id'] = $data['student_type_id'];
        }
        if($data['faculty_id'] != 0){
            $where['faculty_id'] = $data['faculty_id'];
        }
        if($data['category_id'] != 0){
            $where['category_id'] = $data['category_id'];
        }
        if($data['sub_category_id'] != 0){
            $where['sub_category_id'] = $data['sub_category_id'];
        }
          
        $fee_rates = AppFeeRate::where($where)->get();
        if(count($fee_rates) > 0) {
             $feeNamesWithRate = getFeeRates($fee_rates);
              echo json_encode([
                'status' =>true,'fee_names' => $feeNamesWithRate]);
        }else{
            echo json_encode([
                'status' =>false 
                ]);
        }
        break;

    case 'getSubCategoriesForCategory':
        $data = $request->all();
        $sub_categories = Subcategory::where('category_id', $data['category_id'])->get();
        echo json_encode($sub_categories);
        break;

}

 function getFeeRates($fee_rates){
     $newArray = [];
     foreach($fee_rates as $fee_rate){
      
        $fee_structures = AppFeeStructure::where('fee_rate_id', $fee_rate->id)->get();
        $classObj = AppClass::find($fee_rate->class_id);
        $class = $classObj?$classObj->name:'-';

        if($fee_rate->student_type_id != 0){
            $studentType = AppStudentType::find($fee_rate->student_type_id);
            $student_type = $studentType?$studentType->name:'-';
        }else{
            $student_type = '-';
        }

        if($fee_rate->faculty_id != 0){
             $facultyObj = AppFaculty::find($fee_rate->faculty_id);
             $faculty = $facultyObj?$facultyObj->name:'-';
        }else{
             $faculty = '-';
        }

         if($fee_rate->category_id != 0){
              $categoryObj = Category::find($fee_rate->category_id);
              $category = $categoryObj?$categoryObj->name:'-';
         }else{
             $category = '-';
         }

         if($fee_rate->sub_category_id != 0){
             $subCategory = Subcategory::find($fee_rate->sub_category_id);
             $sub_category = $subCategory?$subCategory->name:'-';
         }else{
            $sub_category = '-';
         }
        foreach($fee_structures as $fee_structure){
            $feeName = AppFeeName::find($fee_structure->fee_names_id);
            $newArray[]=[
                'class' => $class,
                'student_type' => $student_type,
                'faculty' => $faculty,
                'category' => $category,
                'sub_category' => $sub_category,
                'name' =>  $feeName?$feeName->name:'-',
                'amount' => $fee_structure->amount,
                'is_transportation' => $feeName?$feeName->is_transportation:'',
                'from' => $feeName?$feeName->from:'',
                'to' => $feeName?$feeName->to:'',
            ];
        }
     } 

     return $newArray;

 }