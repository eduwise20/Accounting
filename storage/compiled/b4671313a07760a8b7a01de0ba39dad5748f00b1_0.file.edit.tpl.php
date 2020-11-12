<?php
/* Smarty version 3.1.36, created on 2020-11-11 03:57:12
  from 'C:\xampp\htdocs\accounting\apps\classes\views\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5faba7687b22f8_33057647',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4671313a07760a8b7a01de0ba39dad5748f00b1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\apps\\classes\\views\\edit.tpl',
      1 => 1605084831,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5faba7687b22f8_33057647 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9159439015faba7687ac979_41790495', "content");
}
/* {block "content"} */
class Block_9159439015faba7687ac979_41790495 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_9159439015faba7687ac979_41790495',
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

                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
classes/app/save">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['class']->value->name;?>
">
                        </div>

                        <div class="form-group">
                            <label for="code">Code</label>
                            <input class="form-control" name="code" id="code" value="<?php echo $_smarty_tpl->tpl_vars['class']->value->code;?>
">
                        </div>

                        
                        <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['class']->value->id;?>
">

                        <button class="btn btn-primary" type="submit">Save</button>

                    </form>


                </div>
            </div>
        </div>



    </div>



<?php
}
}
/* {/block "content"} */
}
