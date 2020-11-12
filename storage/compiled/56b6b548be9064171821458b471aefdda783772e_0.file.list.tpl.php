<?php
/* Smarty version 3.1.36, created on 2020-11-11 03:56:45
  from 'C:\xampp\htdocs\accounting\apps\classes\views\list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5faba74d2541a9_06974146',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56b6b548be9064171821458b471aefdda783772e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\apps\\classes\\views\\list.tpl',
      1 => 1605084737,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5faba74d2541a9_06974146 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5965832255faba74d24b213_02366206', "content");
}
/* {block "content"} */
class Block_5965832255faba74d24b213_02366206 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_5965832255faba74d24b213_02366206',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">
                <div class="panel-body">

                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
classes/app/add" class="btn btn-primary add_event waves-effect waves-light"><i class="fa fa-plus"></i> Add Class</a>

                </div>

            </div>
        </div>



    </div>

    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">



                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="bold">Class Name</th>

                                <th class="text-center bold"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Manage'];?>
</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['classes']->value, 'class');
$_smarty_tpl->tpl_vars['class']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['class']->value) {
$_smarty_tpl->tpl_vars['class']->do_else = false;
?>
                                <tr>
                                    <td>

                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
classes/app/view/<?php echo $_smarty_tpl->tpl_vars['class']->value->id;?>
"><?php echo $_smarty_tpl->tpl_vars['class']->value->name;?>
</a>

                                    </td>

                                    <td class="text-right">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
classes/app/edit/<?php echo $_smarty_tpl->tpl_vars['class']->value->id;?>
" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
classes/app/delete/<?php echo $_smarty_tpl->tpl_vars['class']->value->id;?>
" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
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
        </div>



    </div>




<?php
}
}
/* {/block "content"} */
}
