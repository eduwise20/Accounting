<?php
/* Smarty version 3.1.36, created on 2020-11-14 11:32:41
  from 'C:\xampp\htdocs\accounting\apps\classes\views\add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fb006a9c50f43_51548092',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '975d07749b79862eb887184e92f4bcbe0c3a5403' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\apps\\classes\\views\\add.tpl',
      1 => 1605371559,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fb006a9c50f43_51548092 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13168934245fb006a9c4de07_50489861', "head");
?>




<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9030833345fb006a9c50106_01598367', "content");
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7162761125fb006a9c50746_14260480', 'script');
?>





<?php }
/* {block "head"} */
class Block_13168934245fb006a9c4de07_50489861 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_13168934245fb006a9c4de07_50489861',
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
class Block_9030833345fb006a9c50106_01598367 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_9030833345fb006a9c50106_01598367',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="panel">
        <div class="panel-container">

            <div class="panel-content">

                <h3>Add Class</h3>

                <hr>

                <form id="main_form" method="post">

                    <div class="form-group">
                        <label for="address"><span class="h6">Name</span></label>

                        <input type="text" id="name" name="name" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="address"><span class="h6">Code</span></label>

                        <input type="text" id="code" name="code" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btn_submit">Add</button>

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
class Block_7162761125fb006a9c50746_14260480 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_7162761125fb006a9c50746_14260480',
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
