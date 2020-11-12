<?php
/* Smarty version 3.1.36, created on 2020-11-11 03:56:39
  from 'C:\xampp\htdocs\accounting\apps\classes\views\add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5faba747f3ace4_24585693',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '975d07749b79862eb887184e92f4bcbe0c3a5403' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\apps\\classes\\views\\add.tpl',
      1 => 1605084648,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5faba747f3ace4_24585693 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4115258205faba747f38662_82497542', "content");
}
/* {block "content"} */
class Block_4115258205faba747f38662_82497542 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_4115258205faba747f38662_82497542',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">

                    <h3>Add Class</h3>

                    <hr>

                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
classes/app/save">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" name="name" id="name">
                        </div>

                        <div class="form-group">
                            <label for="code">Code</label>
                            <input class="form-control" name="code" id="code">
                        </div>

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
