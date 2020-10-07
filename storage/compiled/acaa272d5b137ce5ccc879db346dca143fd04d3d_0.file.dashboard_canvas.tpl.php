<?php
/* Smarty version 3.1.36, created on 2020-09-26 04:07:19
  from '/Users/razib/Documents/valet/business-suite/ui/theme/default/dashboard_canvas.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5f6ef6b77adad2_15247792',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'acaa272d5b137ce5ccc879db346dca143fd04d3d' => 
    array (
      0 => '/Users/razib/Documents/valet/business-suite/ui/theme/default/dashboard_canvas.tpl',
      1 => 1601107013,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5f6ef6b77adad2_15247792 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9249849275f6ef6b7740084_30470417', "head");
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4351407685f6ef6b7742cc3_98417490', "content");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15083163985f6ef6b77a0c95_41909806', "script");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['layouts_admin']->value));
}
/* {block "head"} */
class Block_9249849275f6ef6b7740084_30470417 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_9249849275f6ef6b7740084_30470417',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #F7F9FC;
        }

        .svg-icon.svg-icon-white svg g [fill] {
            -webkit-transition: fill .3s ease;
            transition: fill .3s ease;
            fill: #ffffff;
        }
        .symbol.symbol-light-warning .symbol-label {
            background: linear-gradient(87deg,#fb6340 0,#fbb140 100%)!important;
        }


        .symbol.symbol-light-success .symbol-label {
            background: linear-gradient(87deg,#2dce89 0,#2dcecc 100%)!important
        }


        .symbol.symbol-light-danger .symbol-label {
            background: linear-gradient(87deg,#f5365c 0,#f56036 100%)!important;
        }

        .symbol.symbol-light-primary .symbol-label {
            background: linear-gradient(87deg,#5e72e4 0,#825ee4 100%)!important;

        }

        .symbol.symbol-light-info .symbol-label {
            background: linear-gradient(87deg,#11cdef 0,#1171ef 100%)!important;
        }

        .h2, h2 {
            font-size: 1.25rem;
        }
        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: inherit;
            font-weight: 600;
            line-height: 1.5;
            margin-bottom: .5rem;
            color: #32325d;
        }


        .text-info{
            color: #6772E5!important;
        }
        .text-success{
            color: #2CCE89!important;}

        .text-danger{
            color: #F6365B!important;
        }
        .text-warning{
            color: #FB6340!important;
        }
        .text-primary{
            color: #10CDEF!important;
        }
        .col-auto {
            width: auto;
            max-width: 100%;
            flex: 0 0 auto;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            border: 1px solid rgba(0,0,0,.05);
            border-radius: .375rem;
            background-color: #fff;
            background-clip: border-box;
        }

        .card-body {
            min-height: 1px;
            padding: 1.5rem;
            flex: 1 1 auto;
        }
        .justify-content-between {
            justify-content: space-between!important;
        }
        .align-items-center {
            align-items: center!important;
        }
        .row {
            display: flex;
            margin-right: -15px;
            margin-left: -15px;
            flex-wrap: wrap;
        }
        .text-light {
            color: #ced4da!important;
        }

        .col-xl-auto {
            position: relative;
            width: 100%;
            padding-right: .75rem;

        }
        .progress-bar-danger{
            background-color: #F6365B!important;

        }
        .progress-bar-success{
            background-color: #2CCE89!important;

        }
        .progress-bar-info{
            background-color: #6772E5!important;

        }









    </style>
<?php
}
}
/* {/block "head"} */
/* {block "content"} */
class Block_4351407685f6ef6b7742cc3_98417490 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_4351407685f6ef6b7742cc3_98417490',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="row">


        <div class="col-lg-12">
            <div id="panel-1" class="panel" data-panel-lock="false" data-panel-close="false" data-panel-collapsed="false"  data-panel-locked="false" data-panel-refresh="false" data-panel-reset="false">
                <div class="panel-hdr">
                    <h2>
                        <?php echo $_smarty_tpl->tpl_vars['_L']->value['Cash Flow'];?>

                    </h2>

                    <div class="panel-toolbar">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard" data-toggle="tooltip" data-original-title="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Refresh'];?>
">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M8.43296491,7.17429118 L9.40782327,7.85689436 C9.49616631,7.91875282 9.56214077,8.00751728 9.5959027,8.10994332 C9.68235021,8.37220548 9.53982427,8.65489052 9.27756211,8.74133803 L5.89079566,9.85769242 C5.84469033,9.87288977 5.79661753,9.8812917 5.74809064,9.88263369 C5.4720538,9.8902674 5.24209339,9.67268366 5.23445968,9.39664682 L5.13610134,5.83998177 C5.13313425,5.73269078 5.16477113,5.62729274 5.22633424,5.53937151 C5.384723,5.31316892 5.69649589,5.25819495 5.92269848,5.4165837 L6.72910242,5.98123382 C8.16546398,4.72182424 10.0239806,4 12,4 C16.418278,4 20,7.581722 20,12 C20,16.418278 16.418278,20 12,20 C7.581722,20 4,16.418278 4,12 L6,12 C6,15.3137085 8.6862915,18 12,18 C15.3137085,18 18,15.3137085 18,12 C18,8.6862915 15.3137085,6 12,6 C10.6885336,6 9.44767246,6.42282109 8.43296491,7.17429118 Z" fill="#000000" fill-rule="nonzero"/>
    </g>
</svg></span>
                        </a>
                    </div>

                </div>

                <div class="panel-container show">
                    <div class="panel-content border-left-0 border-right-0 border-top-0" style="background: #EEF0F7;">
                        <div class="row no-gutters">

                            <div class="col-lg-4 col-xl-4">

                                <div class="p-8  mb-2 rounded-xl flex-grow-1" style="background-color:#fff; border-radius: 4px; padding: 26px 20px; margin-left:1rem; margin-right:1rem;">
                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="symbol symbol-circle symbol-light-success symbol-40 flex-shrink-0 mr-3">
                                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z" fill="#000000" opacity="0.3" transform="translate(11.500000, 12.000000) rotate(-345.000000) translate(-11.500000, -12.000000) "/>
        <path d="M2,6 L21,6 C21.5522847,6 22,6.44771525 22,7 L22,17 C22,17.5522847 21.5522847,18 21,18 L2,18 C1.44771525,18 1,17.5522847 1,17 L1,7 C1,6.44771525 1.44771525,6 2,6 Z M11.5,16 C13.709139,16 15.5,14.209139 15.5,12 C15.5,9.790861 13.709139,8 11.5,8 C9.290861,8 7.5,9.790861 7.5,12 C7.5,14.209139 9.290861,16 11.5,16 Z M11.5,14 C12.6045695,14 13.5,13.1045695 13.5,12 C13.5,10.8954305 12.6045695,10 11.5,10 C10.3954305,10 9.5,10.8954305 9.5,12 C9.5,13.1045695 10.3954305,14 11.5,14 Z" fill="#000000"/>
    </g>
</svg>
                                </span>                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-dark"><?php echo formatCurrency($_smarty_tpl->tpl_vars['ti']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
</h3>
                                            <div class="font-size-sm text-muted-green"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Income Today'];?>
</div>
                                        </div>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="symbol symbol-circle symbol-light-warning symbol-40 flex-shrink-0 mr-3">
                                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-white"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path d="M4,4 L20,4 C21.1045695,4 22,4.8954305 22,6 L22,18 C22,19.1045695 21.1045695,20 20,20 L4,20 C2.8954305,20 2,19.1045695 2,18 L2,6 C2,4.8954305 2.8954305,4 4,4 Z" fill="#000000" opacity="0.3"/>
        <path d="M18.5,11 L5.5,11 C4.67157288,11 4,11.6715729 4,12.5 L4,13 L8.58578644,13 C8.85100293,13 9.10535684,13.1053568 9.29289322,13.2928932 L10.2928932,14.2928932 C10.7456461,14.7456461 11.3597108,15 12,15 C12.6402892,15 13.2543539,14.7456461 13.7071068,14.2928932 L14.7071068,13.2928932 C14.8946432,13.1053568 15.1489971,13 15.4142136,13 L20,13 L20,12.5 C20,11.6715729 19.3284271,11 18.5,11 Z" fill="#000000"/>
        <path d="M5.5,6 C4.67157288,6 4,6.67157288 4,7.5 L4,8 L20,8 L20,7.5 C20,6.67157288 19.3284271,6 18.5,6 L5.5,6 Z" fill="#000000"/>
    </g>
</svg></span>                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-dark"><?php echo formatCurrency($_smarty_tpl->tpl_vars['te']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
</h3>
                                            <div class="font-size-sm text-muted-green"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Expense Today'];?>
</div>
                                        </div>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="symbol symbol-circle symbol-light-primary symbol-40 flex-shrink-0 mr-3">
                                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-white"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" opacity="0.3" x="2" y="4" width="20" height="5" rx="1"/>
        <path d="M5,7 L8,7 L8,21 L7,21 C5.8954305,21 5,20.1045695 5,19 L5,7 Z M19,7 L19,19 C19,20.1045695 18.1045695,21 17,21 L11,21 L11,7 L19,7 Z" fill="#000000"/>
    </g>
</svg></span>                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-dark"><?php echo formatCurrency($_smarty_tpl->tpl_vars['mi']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
</h3>
                                            <div class="font-size-sm text-muted-green"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Income This Month'];?>
</div>
                                        </div>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="symbol symbol-circle symbol-light-danger symbol-40 flex-shrink-0 mr-3">
                                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-white"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" opacity="0.3" x="2" y="5" width="20" height="14" rx="2"/>
        <rect fill="#000000" x="2" y="8" width="20" height="3"/>
        <rect fill="#000000" opacity="0.3" x="16" y="14" width="4" height="2" rx="1"/>
    </g>
</svg></span>                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-dark"><?php echo formatCurrency($_smarty_tpl->tpl_vars['me']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
</h3>
                                            <div class="font-size-sm text-muted-green"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Expense This Month'];?>
</div>
                                        </div>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="symbol symbol-circle symbol-light-success symbol-40 flex-shrink-0 mr-3">
                                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-white"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"></rect>
        <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>
        <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>
        <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>
        <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>
    </g>
</svg><!--end::Svg Icon--></span>                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-dark"><?php echo formatCurrency($_smarty_tpl->tpl_vars['total_income']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
</h3>
                                            <div class="font-size-sm text-muted-green"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Income'];?>
</div>
                                        </div>
                                    </div>
                                    <!--end::Item-->

                                    <!--begin::Item-->
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-circle symbol-light-danger symbol-40 flex-shrink-0 mr-3">
                                            <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-white"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"/>
        <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"/>
        <path d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z" fill="#000000" fill-rule="nonzero"/>
        <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
    </g>
</svg></span>                            </div>
                                        </div>
                                        <div>
                                            <h3 class="text-dark"><?php echo formatCurrency($_smarty_tpl->tpl_vars['total_expense']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
</h3>
                                            <div class="font-size-sm text-muted-green"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Total Expense'];?>
</div>
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                </div>





                            </div>
                            <div class="col-lg-8 col-xl-8">

                                <div style="padding-left: 1rem; padding-right: 1rem;">

                                    <div class="row">



                                        <div class="<?php if ($_smarty_tpl->tpl_vars['config']->value['leads'] && $_smarty_tpl->tpl_vars['config']->value['companies']) {?>col-md-4 <?php } else { ?> col-md-6<?php }?>">

                                            <div class="card mb-2" style="background: linear-gradient(87deg,#2dce89 0,#2dcecc 100%)!important;height: 120px">


                                                <div class="card-body" >
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="h1 text-white mb-0"><?php echo $_smarty_tpl->tpl_vars['customers_total']->value;?>
</div>


                                                        </div>
                                                        <div class="col" style="padding-left: 60px;">



                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <a href="#" class="text-white text-hover-primary font-weight-bold font-size-lg mt-1"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Customers'];?>
</a>

                                                        </div>



                                                    </div>


                                                                                                    </div>

                                            </div>
                                        </div>

                                        <?php if ((isset($_smarty_tpl->tpl_vars['config']->value['companies'])) && $_smarty_tpl->tpl_vars['config']->value['companies']) {?>

                                            <div class="<?php if ($_smarty_tpl->tpl_vars['config']->value['leads'] && $_smarty_tpl->tpl_vars['config']->value['companies']) {?>col-md-4 <?php } else { ?> col-md-6<?php }?>">

                                                <div class="card mb-2" style="background: linear-gradient(87deg,#5e72e4 0,#825ee4 100%)!important;height: 120px">

                                                    <div class="card-body" >
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="h1 text-white mb-0 "><?php echo $_smarty_tpl->tpl_vars['companies_total']->value;?>
</div>


                                                            </div>
                                                            <div class="row">
                                                                <div class="col" style="padding-left: 60px;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        


                                                                </div>


                                                            </div>

                                                        </div>


                                                        <a href="#" class=" text-white text-hover-primary font-weight-bold font-size-lg  mt-1"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Companies'];?>
</a>

                                                                                                            </div>

                                                </div>
                                            </div>

                                        <?php }?>





                                        <?php if ((isset($_smarty_tpl->tpl_vars['config']->value['leads'])) && $_smarty_tpl->tpl_vars['config']->value['leads']) {?>

                                            <div class="<?php if ($_smarty_tpl->tpl_vars['config']->value['leads'] && $_smarty_tpl->tpl_vars['config']->value['companies']) {?>col-md-4 <?php } else { ?> col-md-6<?php }?>">
                                                <div class="card mb-2" style="background: linear-gradient(to right,#4051f6,#475cf3,#4f65ef,#586eea,#6177e5); height: 120px">
                                                    <div class="card-body">

                                                        <div class="row">
                                                            <div class="col">

                                                                <div class="h1 text-white  mb-0"><?php echo $_smarty_tpl->tpl_vars['leads_total']->value;?>
</div>

                                                            </div>
                                                            <div class="col" style="padding-left: 60px;">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                


                                                            </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="#" class="text-white text-hover-primary font-weight-bold font-size-lg mt-1"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Leads'];?>
</a>

                                                            </div>
                                                            <div class="col">

                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>
                                            </div>
                                        <?php }?>

                                                                                                                                                                
                                                                                                                                                                
                                                                                                                                                                
                                                                                                                                                                                                    </div>
                                </div>


                                <div class="position-relative">



                                        <div class="col-md-12 mt-3">
                                            <div class="card mb-3 shadow-none">
                                                <div class="card-body">
                                                    <div id="cash_flow_chart"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>



            </div>

        <div class="col-lg-6">
            <div id="panel-3" class="panel" data-panel-close="false">
                <div class="panel-hdr">
                    <h2><?php echo $_smarty_tpl->tpl_vars['_L']->value['Recent Invoices'];?>
</h2>

                </div>
                <div class="panel-container">

                    <div class="table-responsive  widget-table">
                        <table class="table table-striped mb-0">
                            <thead>
                            <tr>
                                <th class="h6">#</th>
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account'];?>
</th>
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoice Date'];?>
</th>
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Due Date'];?>
</th>
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Status'];?>
</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['invoices']->value, 'ds');
$_smarty_tpl->tpl_vars['ds']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['ds']->value) {
$_smarty_tpl->tpl_vars['ds']->do_else = false;
?>
                                <tr class="cursor-pointer clickable-row" data-id="<?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
">
                                    <td class="text-info">
                                        <strong>
                                            <?php echo $_smarty_tpl->tpl_vars['ds']->value['invoicenum'];
if ($_smarty_tpl->tpl_vars['ds']->value['cn'] != '') {?> <?php echo $_smarty_tpl->tpl_vars['ds']->value['cn'];?>
 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['ds']->value['id'];?>
 <?php }?>
                                        </strong>
                                    </td>
                                    <td>


                                        <strong><?php echo $_smarty_tpl->tpl_vars['ds']->value['account'];?>
</strong> <br>
                                    </td>
                                    <td class="h6"><?php echo $_smarty_tpl->tpl_vars['ds']->value['total'];?>
</td>
                                    <td><?php echo date($_smarty_tpl->tpl_vars['config']->value['df'],strtotime($_smarty_tpl->tpl_vars['ds']->value['date']));?>
</td>
                                    <td><?php echo date($_smarty_tpl->tpl_vars['config']->value['df'],strtotime($_smarty_tpl->tpl_vars['ds']->value['duedate']));?>
</td>
                                    <td>
                                        <?php if ($_smarty_tpl->tpl_vars['ds']->value['status'] == 'Unpaid') {?>

                                            <span class="badge badge-outline badge-outline-danger"><?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['ds']->value['status']);?>
</span>

                                        <?php } else { ?>

                                            <span class="badge badge-outline  badge-outline-success"><?php echo ib_lan_get_line($_smarty_tpl->tpl_vars['ds']->value['status']);?>
</span>

                                        <?php }?>


                                    </td>

                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                            </tbody>
                        </table>

                    </div>

                    <div class="panel-content">
                        <div id="invoice_stats"></div>
                    </div>

                </div>


            </div>
        </div>
        <div class="col-lg-6">
            <div id="panel-4" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <?php echo $_smarty_tpl->tpl_vars['_L']->value['Calendar'];?>

                    </h2>
                </div>
                <div class="panel-container show p-5">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div id="panel-5" class="panel">
                <div class="panel-hdr">
                    <h2>
                        <?php echo $_smarty_tpl->tpl_vars['_L']->value['Income_Vs_Expense'];?>

                    </h2>
                </div>
                <div class="panel-container show p-5">
                    <div id="chart_income_vs_expense"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="panel" id="panel-6">
                <div class="panel-hdr">

                    <h2><?php echo $_smarty_tpl->tpl_vars['_L']->value['Latest Income'];?>
</h2>
                </div>
                <div class="panel-container">
                    <div class="table-responsive">
                        <table class="table table-striped ">
                            <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</th>
                            <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</th>
                            <th class="text-right h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['inc']->value, 'incs');
$_smarty_tpl->tpl_vars['incs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['incs']->value) {
$_smarty_tpl->tpl_vars['incs']->do_else = false;
?>
                                <tr>
                                    <td class="h6 text-info"><?php echo date($_smarty_tpl->tpl_vars['config']->value['df'],strtotime($_smarty_tpl->tpl_vars['incs']->value['date']));?>
</td>
                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/manage/<?php echo $_smarty_tpl->tpl_vars['incs']->value['id'];?>
/"><strong><?php echo $_smarty_tpl->tpl_vars['incs']->value['description'];?>
</strong></a> </td>
                                    <td class="text-right text-success amount h6"><?php echo $_smarty_tpl->tpl_vars['incs']->value['amount'];?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                        </table>
                    </div>

                </div>

            </div>

        </div>

        <div class="col-lg-6">
            <div class="panel" id="panel-7">
                <div class="panel-hdr">

                    <h2><?php echo $_smarty_tpl->tpl_vars['_L']->value['Latest Expense'];?>
</h2>
                </div>
                <div class="panel-container">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</th>
                            <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</th>
                            <th class="text-right h6 "><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['exp']->value, 'exps');
$_smarty_tpl->tpl_vars['exps']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['exps']->value) {
$_smarty_tpl->tpl_vars['exps']->do_else = false;
?>
                                <tr>
                                    <td class="text-info h6"><?php echo date($_smarty_tpl->tpl_vars['config']->value['df'],strtotime($_smarty_tpl->tpl_vars['exps']->value['date']));?>
</td>
                                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/manage/<?php echo $_smarty_tpl->tpl_vars['exps']->value['id'];?>
/"><strong><?php echo $_smarty_tpl->tpl_vars['exps']->value['description'];?>
</strong></a> </td>
                                    <td class="text-right text-danger amount h6"><?php echo $_smarty_tpl->tpl_vars['exps']->value['amount'];?>
</td>
                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                        </table>
                    </div>

                </div>

            </div>

        </div>
        <div class="col-lg-6">
            <div id="panel-2" class="panel" data-panel-fullscreen="false">
                <div class="panel-hdr">
                    <h2>
                        <?php echo $_smarty_tpl->tpl_vars['_L']->value['Expense by Category'];?>

                    </h2>
                </div>
                <div class="panel-container show">

                    <div class="panel-content p-0">
                        <div id="expense_chart" class=""></div>
                    </div>

                </div>
            </div>

        </div>

        <div class="col-md-6">
            <div class="panel" id="panel-6">
                <div class="panel-hdr">
                    <h2>Net Worth & Account Balances</h2>
                    <div class="panel-toolbar">

                        <a href="#" id="set_goal" class="btn btn-primary btn-xs pull-right"> Set Goal</a>
                    </div>


                </div>
                <div class="panel-container" style="min-height: 365px;">
                    <div class="panel-content">

                        <h1 class="text-center amount text-success"><?php echo formatCurrency($_smarty_tpl->tpl_vars['net_worth']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
</h1>


                        <div>
                            <span class="amount"><?php echo formatCurrency($_smarty_tpl->tpl_vars['net_worth']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
</span> <?php echo $_smarty_tpl->tpl_vars['_L']->value['of'];?>
<span class="amount"><?php echo $_smarty_tpl->tpl_vars['config']->value['networth_goal'];?>
</span>
                            <small class="float-right"><span class="amount_no_currency"><?php echo $_smarty_tpl->tpl_vars['pg']->value;?>
</span>%</small>

                            <div class="progress progress-small">
                                <div style="width: <?php echo $_smarty_tpl->tpl_vars['pgb']->value;?>
%;" class="progress-bar progress-bar-<?php echo $_smarty_tpl->tpl_vars['pgc']->value;?>
  bg-success"></div>
                            </div>







                        </div>


                        <table class="table table-striped" style="margin-top: 26px;">
                            <th class="text-info h6"><strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Account'];?>
</strong></th>

                            <th class="text-right h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Balance'];?>
</th>


                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['balances']->value['banks'], 'bank');
$_smarty_tpl->tpl_vars['bank']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bank']->value) {
$_smarty_tpl->tpl_vars['bank']->do_else = false;
?>

                                <tr>
                                    <td class="text-info h6"><strong><?php echo $_smarty_tpl->tpl_vars['bank']->value->account;?>
</strong></td>

                                    <td class="text-right h6">
                                        <?php if (((isset($_smarty_tpl->tpl_vars['balances']->value['balances'][$_smarty_tpl->tpl_vars['bank']->value->id])))) {?>
                                            <?php echo formatCurrency($_smarty_tpl->tpl_vars['balances']->value['balances'][$_smarty_tpl->tpl_vars['bank']->value->id],$_smarty_tpl->tpl_vars['balances']->value['home_currency']->iso_code);?>

                                        <?php }?>
                                    </td>

                                </tr>

                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                        </table>



                    </div>





                    <div>





                    </div>






                </div>
            </div>
        </div>

        <?php if ($_smarty_tpl->tpl_vars['config']->value['invoicing'] && $_smarty_tpl->tpl_vars['all_data_access']->value) {?>


            <div class="col-md-6">

                <div class="panel" id="panel-7">
                    <div class="panel-hdr">
                        <h2><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sales'];?>
</h2>
                    </div>
                    <div class="panel-container">
                        <div class="panel-content">
                            <div class="ibox-content">

                                <div id="sales_pie_graph"></div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="col-md-6">
                <div class="panel" id="panel-8">
                    <div class="panel-hdr">
                        <h2><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sales'];?>
</h2>
                        <div class="panel-toolbar">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
invoices/list/" class="btn btn-primary btn-xs pull-right"> <?php echo $_smarty_tpl->tpl_vars['_L']->value['Invoices'];?>
</a>
                        </div>



                    </div>
                    <div class="panel-container">
                        <table class="table table-striped " >
                            <thead>
                            <tr>

                                <th class="h6"><strong><?php echo $_smarty_tpl->tpl_vars['_L']->value['Name'];?>
</strong></th>
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sales Count'];?>
</th>
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>


                            </tr>
                            </thead>
                            <tbody>

                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item_sold']->value, 'sold');
$_smarty_tpl->tpl_vars['sold']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sold']->value) {
$_smarty_tpl->tpl_vars['sold']->do_else = false;
?>
                                <tr>

                                    <td class="text-info h6">
                                        <strong>
                                            <?php echo strTrunc($_smarty_tpl->tpl_vars['sold']->value['name'],30);?>

                                        </strong>

                                    </td>
                                    <td class="h6"><?php echo floor($_smarty_tpl->tpl_vars['sold']->value['sold_count']);?>
</td>
                                    <td class="amount h6"><?php echo $_smarty_tpl->tpl_vars['sold']->value['total_amount'];?>
</td>



                                </tr>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                            </tbody>
                        </table>







                    </div>



                </div>

            </div>
            <div class="col-lg-6">
                <div class="panel" id="panel-6">
                    <div class="panel-hdr">

                        <h2><?php echo $_smarty_tpl->tpl_vars['_L']->value['Latest Income'];?>
</h2>
                    </div>
                    <div class="panel-container">
                        <div class="table-responsive">
                            <table class="table table-striped ">
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Date'];?>
</th>
                                <th class="h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Description'];?>
</th>
                                <th class="text-right h6"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
</th>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['inc']->value, 'incs');
$_smarty_tpl->tpl_vars['incs']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['incs']->value) {
$_smarty_tpl->tpl_vars['incs']->do_else = false;
?>
                                    <tr>
                                        <td class="h6 text-info"><?php echo date($_smarty_tpl->tpl_vars['config']->value['df'],strtotime($_smarty_tpl->tpl_vars['incs']->value['date']));?>
</td>
                                        <td><a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
transactions/manage/<?php echo $_smarty_tpl->tpl_vars['incs']->value['id'];?>
/"><strong><?php echo $_smarty_tpl->tpl_vars['incs']->value['description'];?>
</strong></a> </td>
                                        <td class="text-right text-success amount h6"><?php echo $_smarty_tpl->tpl_vars['incs']->value['amount'];?>
</td>
                                    </tr>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>



                            </table>
                        </div>

                    </div>

                </div>

            </div>

        <?php }?>



    </div>













































    </div>
<?php
}
}
/* {/block "content"} */
/* {block "script"} */
class Block_15083163985f6ef6b77a0c95_41909806 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_15083163985f6ef6b77a0c95_41909806',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>

        function displayEvent(event_id=0,date=0)
        {
            $.fancybox.open({
                src  :  base_url + 'calendar/event/'+event_id+'/'+date,
                type : 'ajax',
                opts : {
                    afterShow : function( instance, current ) {
                        // $('[data-toggle="datepicker"]').datepicker();
                        // $start_time.timepicker();
                        // $end_time.timepicker();

                        $('#start').datepicker();
                        $('#start_time').timepicker();
                        $('#end').datepicker();

                        let eventForm = $('#eventForm');
                        eventForm.on('submit',function (e) {
                            e.preventDefault();
                            $.post( base_url + "calendar/save_event/", eventForm.serialize())
                                .done(function( data ) {



                                    if ($.isNumeric(data)) {

                                        location.reload();

                                    }

                                    else {
                                        toastr.error(data);
                                    }

                                });


                            return false;
                        });

                    }
                },
            });
        }

        $(function () {

            $.getJSON( "<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard/json_income_vs_exp/", function( data ) {
                var options1 = {
                    chart: {
                        fontFamily: 'Roboto, sans-serif',
                        height: 340,
                        // zoom: {
                        //     enabled: false
                        // },
                        // dropShadow: {
                        //     enabled: true,
                        //     opacity: 0.3,
                        //     blur: 5,
                        //     left: -7,
                        //     top: 22
                        // },
                        toolbar: {
                            show: false
                        },
                        events: {
                            mounted: function(ctx, config) {
                                const highest1 = ctx.getHighestValueInSeries(0);
                                const highest2 = ctx.getHighestValueInSeries(1);

                                ctx.addPointAnnotation({
                                    x: new Date(ctx.w.globals.seriesX[0][ctx.w.globals.series[0].indexOf(highest1)]).getTime(),
                                    y: highest1,
                                    label: {
                                        style: {
                                            cssClass: 'd-none'
                                        }
                                    },
                                    customSVG: {
                                        SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#1b55e2" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                                        cssClass: undefined,
                                        offsetX: -8,
                                        offsetY: 5
                                    }
                                })

                                ctx.addPointAnnotation({
                                    x: new Date(ctx.w.globals.seriesX[1][ctx.w.globals.series[1].indexOf(highest2)]).getTime(),
                                    y: highest2,
                                    label: {
                                        style: {
                                            cssClass: 'd-none'
                                        }
                                    },
                                    customSVG: {
                                        SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="#e7515a" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                                        cssClass: undefined,
                                        offsetX: -8,
                                        offsetY: 5
                                    }
                                })
                            },
                        }
                    },
                    colors: ["#2CCE89", "#F6375B"],
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: [0, 2, 5],
                        curve: 'smooth'
                    },
                    fill: {
                        opacity: [0.85, 0.25, 1],
                        gradient: {
                            inverseColors: false,
                            shade: 'light',
                            type: "vertical",
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100, 100, 100]
                        }
                    },

                    markers: {
                        discrete: [{
                            seriesIndex: 0,
                            dataPointIndex: 7,
                            fillColor: '#000',
                            strokeColor: '#000',
                            size: 5
                        }, {
                            seriesIndex: 2,
                            dataPointIndex: 11,
                            fillColor: '#000',
                            strokeColor: '#000',
                            size: 4
                        }]
                    },
                    subtitle: {
                        text: '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Net Worth'];?>
',
                        align: 'left',
                        margin: 0,
                        offsetX: -10,
                        offsetY: 35,
                        floating: false,
                        style: {
                            fontSize: '14px',
                            color:  '#888ea8'
                        }
                    },
                    title: {
                        text: '<?php echo formatCurrency($_smarty_tpl->tpl_vars['net_worth']->value,$_smarty_tpl->tpl_vars['config']->value['home_currency']);?>
',
                        align: 'left',
                        margin: 0,
                        offsetX: -10,
                        offsetY: 0,
                        floating: false,
                        style: {
                            fontSize: '25px',
                            color:  '#0e1726'
                        },
                    },

                    series: [{
                        type: 'column',
                        name: 'Income',
                        data: data.Income,

                    }, {
                        type: 'area',
                        name: 'Expenses',
                        data: data.Expense,
                    }],
                    labels: data.Months,
                    xaxis: {


                        crosshairs: {
                            show: true
                        },
                        labels: {
                            offsetX: 0,
                            offsetY: 5,
                            style: {
                                fontSize: '12px',
                                fontFamily: 'Roboto, sans-serif',
                                cssClass: 'apexcharts-xaxis-title',
                            },
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(value, index) {
                                return (value / 1000) + 'K'
                            },
                            offsetX: -22,
                            offsetY: 0,
                            style: {
                                fontSize: '12px',
                                fontFamily: 'Roboto, sans-serif',
                                cssClass: 'apexcharts-yaxis-title',
                            },
                        }
                    },
                    grid: { borderColor: "#f1f1f1" },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        offsetY: -50,
                        fontSize: '16px',
                        fontFamily: 'Roboto, sans-serif',
                        markers: {
                            width: 10,
                            height: 10,
                            strokeWidth: 0,
                            strokeColor: '#fff',
                            fillColors: undefined,
                            radius: 12,
                            onClick: undefined,
                            offsetX: 0,
                            offsetY: 0
                        },
                        itemMargin: {
                            horizontal: 0,
                            vertical: 20
                        }
                    },
                    tooltip: {
                        theme: 'dark',
                        marker: {
                            show: true,
                        },
                        x: {
                            show: false,
                        }
                    },
                    // fill: {
                    //     type:"gradient",
                    //     gradient: {
                    //         type: "vertical",
                    //         shadeIntensity: 1,
                    //         inverseColors: !1,
                    //         opacityFrom: .28,
                    //         opacityTo: .05,
                    //         stops: [45, 100]
                    //     }
                    // },
                    responsive: [{
                        breakpoint: 575,
                        options: {
                            legend: {
                                offsetY: -30,
                            },
                        },
                    }],
                    plotOptions: { bar: { horizontal: !1, columnWidth: "15%", endingShape: "rounded" } },
                };


                var chart1 = new ApexCharts(
                    document.querySelector("#cash_flow_chart"),
                    options1
                );

                chart1.render();
            });





            var expense_chart_options = {
                chart: {
                    height: 403,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                xaxis: {
                    categories: [
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['expense_cats']->value, 'expnese_cat');
$_smarty_tpl->tpl_vars['expnese_cat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['expnese_cat']->value) {
$_smarty_tpl->tpl_vars['expnese_cat']->do_else = false;
?>
                        '<?php echo $_smarty_tpl->tpl_vars['expnese_cat']->value->name;?>
',
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    ],
                },
                series: [{
                    data: [<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['expense_cats']->value, 'expnese_cat');
$_smarty_tpl->tpl_vars['expnese_cat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['expnese_cat']->value) {
$_smarty_tpl->tpl_vars['expnese_cat']->do_else = false;
?>
                        <?php echo $_smarty_tpl->tpl_vars['expnese_cat']->value->total_amount;?>
,
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>]
                }],
                plotOptions: {
                    bar: {
                        horizontal: true,
                        endingShape: 'rounded',

                    }
                },

                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            }

            var expense_chart = new ApexCharts(
                document.querySelector("#expense_chart"),
                expense_chart_options
            );

            expense_chart.render();


            $.getJSON( "<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard/json_d_chart_data/", function( data ) {
                var chart_income_vs_expense_options = {
                    chart: {
                        height: 400,
                        type: 'bar',
                        toolbar: {
                            show: false,
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '55%',
                            endingShape: 'rounded'
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    series: [{
                        name: '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Income'];?>
',
                        data: data.Income
                    }, {
                        name: '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Expense'];?>
',
                        data: data.Expense
                    }],
                    xaxis: {
                        categories: [
                            '01',
                            '02',
                            '03',
                            '04',
                            '05',
                            '06',
                            '07',
                            '08',
                            '09',
                            '10',
                            '11',
                            '12',
                            '13',
                            '14',
                            '15',
                            '16',
                            '17',
                            '18',
                            '19',
                            '20',
                            '21',
                            '22',
                            '23',
                            '24',
                            '25',
                            '26',
                            '27',
                            '28',
                            '29',
                            '30',
                            '31'
                        ],
                    },
                    yaxis: {
                        title: {
                            text: '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Amount'];?>
'
                        }
                    },
                    fill: {
                        opacity: 1

                    },
                    tooltip: {
                        y: {
                            formatter: function (val) {
                                return val
                            }
                        }
                    }
                }

                var chart_income_vs_expense = new ApexCharts(
                    document.querySelector("#chart_income_vs_expense"),
                    chart_income_vs_expense_options
                );

                chart_income_vs_expense.render();
            });

            $('.clickable-row').on('click',function () {
                window.location = base_url + 'invoices/view/' + $(this).data('id');
            });

            var invoice_stats = $("#invoice_stats");

            $.get( base_url + "dashboard/invoice_stats_json/", function( data ) {

                invoice_stats.html(' <span class="font-12 head-font txt-dark"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Unpaid'];?>
<span class="float-right">'+ data.Unpaid.percentage +'%</span></span>\
                        <div class="progress my-2 progress-small mt-10">\
                        <div class="progress-bar progress-bar-danger" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: '+ data.Unpaid.percentage +'%" role="progressbar"> <span class="sr-only">'+ data.Unpaid.percentage +'%</span> </div>\
                        </div>\
                        <span class="font-12 head-font txt-dark"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Partially Paid'];?>
<span class="float-right">'+ data['Partially Paid'].percentage +'%</span></span>\
                        <div class="progress my-2 progress-small mt-10">\
                        <div class="progress-bar progress-bar-info" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: '+ data['Partially Paid'].percentage +'%" role="progressbar"> <span class="sr-only">'+ data['Partially Paid'].percentage +'</span> </div>\
                        </div>\
                        <span class="font-12 head-font txt-dark"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Paid'];?>
<span class="float-right">'+ data.Paid.percentage +'%</span></span>\
                        <div class="progress my-2 progress-small mt-10">\
                        <div class="progress-bar progress-bar-success" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: '+ data.Paid.percentage +'%" role="progressbar"> <span class="sr-only">'+ data.Paid.percentage +'</span> </div>\
                        </div>\
                        ');
                invoice_stats.slideDown( "slow" );

                // Load Account Balances



            });


            $('#clx-page-content').smartPanel({
                localStorage: true,
                onChange: function () {},
                onSave: function () {},
                opacity: 1,
                deleteSettingsKey: '#deletesettingskey-options',
                settingsKeyLabel: 'Reset settings?',
                deletePositionKey: '#deletepositionkey-options',
                positionKeyLabel: 'Reset position?',
                sortable: true,
                buttonOrder: '%collapse% %fullscreen% %close%',
                buttonOrderDropdown: '%refresh% %locked% %color% %custom% %reset%',
                // customButton: true,
                // customButtonLabel: "Custom Button",
                onCustom: function () {},
                closeButton: false,
                onClosepanel: function() {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onClosepanel")
                },
                fullscreenButton: true,
                onFullscreen: function() {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onFullscreen")
                },
                collapseButton: true,
                onCollapse: function() {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onCollapse")
                },
                lockedButton: false,
                lockedButtonLabel: "Lock Position",
                onLocked: function() {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onLocked")
                },
                // refreshButton: true,
                // refreshButtonLabel: "Refresh Content",
                // onRefresh: function() {
                //     if (myapp_config.debugState)
                //         console.log($(this).closest(".panel").attr('id') + " onRefresh")
                // },
                colorButton: true,
                colorButtonLabel: "Panel Style",
                onColor: function() {
                    if (myapp_config.debugState)
                        console.log($(this).closest(".panel").attr('id') + " onColor")
                },
                panelColors: ['bg-primary-700 bg-success-gradient',
                    'bg-primary-500 bg-info-gradient',
                    'bg-primary-600 bg-primary-gradient',
                    'bg-info-600 bg-primray-gradient',
                    'bg-info-600 bg-info-gradient',
                    'bg-info-700 bg-success-gradient',
                    'bg-success-900 bg-info-gradient',
                    'bg-success-700 bg-primary-gradient',
                    'bg-success-600 bg-success-gradient',
                    'bg-danger-900 bg-info-gradient',
                    'bg-fusion-400 bg-fusion-gradient',
                    'bg-faded'],
                resetButton: true,
                resetButtonLabel: "Reset Panel",
                onReset: function() {
                    if (myapp_config.debugState)
                        console.log( $(this).closest(".panel").attr('id') + " onReset callback" )
                }
            });


            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl,
                {
                    plugins: ['dayGrid', 'list', 'timeGrid', 'interaction', 'bootstrap'],
                    themeSystem: 'bootstrap',
                    timeZone: 'UTC',
                    //dateAlignment: "month", //week, month
                    buttonText:
                        {
                            today: 'today',
                            month: 'month',
                            week: 'week',
                            day: 'day',
                            list: 'list'
                        },
                    eventTimeFormat:
                        {
                            hour: 'numeric',
                            minute: '2-digit',
                            meridiem: 'short'
                        },
                    navLinks: true,
                    header:
                        {
                            left: 'title',
                            center: '',
                            right: 'today prev,next'
                        },
                    footer:
                        {
                            left: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                            center: '',
                            right: ''
                        },
                    editable: true,
                    eventLimit: true, // allow "more" link when too many events
                    eventSources: [{
                        url: base_url + 'calendar/data/',
                        type: 'GET',
                        error: function() {
                            bootbox.alert("Unable to load data.");
                        }
                    } ],
                    viewSkeletonRender: function()
                    {
                        $('.fc-toolbar .btn-default').addClass('btn-sm');
                        $('.fc-header-toolbar h2').addClass('fs-md');
                        $('#calendar').addClass('fc-reset-order')
                    },

                    dateClick: function(info) {
                        displayEvent(0,info.dateStr);
                    },
                    eventClick: function(info) {
                        displayEvent(info.event.id);
                    }


                });

            calendar.render();

            $("#set_goal").click(function (e) {
                e.preventDefault();

                bootbox.prompt({
                    title: "Set New Goal for Net Worth",
                    value: "350,000.00",
                    buttons: {
                        'cancel': {
                            label: 'Cancel'
                        },
                        'confirm': {
                            label: 'OK'
                        }
                    },
                    callback: function(result) {
                        if (result === null) {

                        } else {
                            // alert(result);
                            $.post( base_url + "settings/networth_goal/", { goal: result })
                                .done(function( data ) {
                                    location.reload();
                                });
                        }
                    }
                });

            });




            var options = {
                series: [
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item_sold']->value, 'sold');
$_smarty_tpl->tpl_vars['sold']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sold']->value) {
$_smarty_tpl->tpl_vars['sold']->do_else = false;
?>
                    <?php echo $_smarty_tpl->tpl_vars['sold']->value['sold_count'];?>
,
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                ],
                chart: {
                    height: 350,
                    type: 'radialBar',
                },
                plotOptions: {
                    radialBar: {
                        dataLabels: {
                            name: {
                                fontSize: '22px',
                            },
                            value: {
                                fontSize: '16px',
                            },
                            total: {
                                show: true,
                                label: '<?php echo $_smarty_tpl->tpl_vars['_L']->value['Total'];?>
',
                                formatter: function (w) {
                                    // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                                    return <?php echo count($_smarty_tpl->tpl_vars['item_sold']->value);?>

                                }
                            }
                        }
                    }
                },
                labels: [
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['item_sold']->value, 'sold');
$_smarty_tpl->tpl_vars['sold']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['sold']->value) {
$_smarty_tpl->tpl_vars['sold']->do_else = false;
?>
                    '<?php echo strTrunc(addslashes($_smarty_tpl->tpl_vars['sold']->value['name']),30);?>
',
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                ],

            }


            var chart = new ApexCharts(document.querySelector("#sales_pie_graph"), options);
            chart.render();




        });
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block "script"} */
}
