<?php
/* Smarty version 3.1.36, created on 2020-11-14 11:39:23
  from 'C:\xampp\htdocs\accounting\apps\classes\views\edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb0083be514c3_04696988',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b4671313a07760a8b7a01de0ba39dad5748f00b1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\apps\\classes\\views\\edit.tpl',
      1 => 1605371961,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb0083be514c3_04696988 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_3873551035fb0083be4b6d6_54456549', "head");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_15103760175fb0083be4d840_05756861', "content");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10199992035fb0083be50d99_74614899', 'script');
}
/* {block "head"} */
class Block_3873551035fb0083be4b6d6_54456549 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_3873551035fb0083be4b6d6_54456549',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #F7F9FC;
        }

        .h2, h2 {
            font-size: 1.25rem;
        }

        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: inherit;
            font-weight: 600 !important;
            line-height: 1.5;
            margin-bottom: .5rem;
            color: #32325d;
        }

        .text-info {
            color: #6772E5 !important;
        }

        .text-success {
            color: #2CCE89 !important;
        }

        .text-danger {
            color: #F6365B !important;
        }

        .text-warning {
            color: #FB6340 !important;
        }

        .text-primary {
            color: #10CDEF !important;
        }
    </style>
<?php
}
}
/* {/block "head"} */
/* {block "content"} */
class Block_15103760175fb0083be4d840_05756861 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_15103760175fb0083be4d840_05756861',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="panel">
        <div class="panel-container">

            <div class="panel-content">

                <h3>Edit <?php echo $_smarty_tpl->tpl_vars['class']->value->name;?>
</h3>

                <hr>

                <form id="main_form" method="post">

                    <div class="form-group">
                        <label for="address"><span class="h6">Name</span></label>

                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['class']->value->name;?>
"/>
                    </div>

                    <div class="form-group">
                        <label for="address"><span class="h6">Code</span></label>

                        <input type="text" id="code" name="code" class="form-control" value="<?php echo $_smarty_tpl->tpl_vars['class']->value->code;?>
"/>
                    </div>

                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['class']->value->id;?>
">


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btn_submit">Edit</button>

                    </div>


                </form>


            </div>
        </div>


    </div>
<?php
}
}
/* {/block "content"} */
/* {block 'script'} */
class Block_10199992035fb0083be50d99_74614899 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_10199992035fb0083be50d99_74614899',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>

        $(function () {

            $('#success_message').redactor(
                {
                    minHeight: 200 // pixels
                }
            );

            let $main_form = $('#main_form');
            let $btn_submit = $('#btn_submit');

            var form = document.getElementById("main_form");

            $main_form.on('submit', function (e) {
                e.preventDefault();

                $btn_submit.prop('disabled', true);

                $.post(base_url + 'classes/app/save', $main_form.serialize())
                    .done(function (data) {

                        window.location = base_url + 'classes/app/list';

                    }).fail(function (error) {
                    $btn_submit.prop('disabled', false);
                    toastr.error(error.responseText);
                });

            });

        });

    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block 'script'} */
}
