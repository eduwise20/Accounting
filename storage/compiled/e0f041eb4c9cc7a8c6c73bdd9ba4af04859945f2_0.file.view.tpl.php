<?php
/* Smarty version 3.1.36, created on 2020-11-11 03:57:01
  from 'C:\xampp\htdocs\accounting\apps\classes\views\view.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5faba75d48a119_32081266',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e0f041eb4c9cc7a8c6c73bdd9ba4af04859945f2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\apps\\classes\\views\\view.tpl',
      1 => 1605084864,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5faba75d48a119_32081266 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_11047772975faba75d485950_98939950', "content");
}
/* {block "content"} */
class Block_11047772975faba75d485950_98939950 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_11047772975faba75d485950_98939950',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">

                    <h3><?php echo $_smarty_tpl->tpl_vars['class']->value->name;?>
</h3>

                    <hr>

                    <?php echo $_smarty_tpl->tpl_vars['class']->value->code;?>


                    <hr>

                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
classes/app/list" class="btn btn-primary">Back to the List</a>


                </div>
            </div>
        </div>



    </div>



<?php
}
}
/* {/block "content"} */
}
