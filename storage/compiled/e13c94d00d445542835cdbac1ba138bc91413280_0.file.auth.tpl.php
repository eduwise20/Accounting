<?php
/* Smarty version 3.1.36, created on 2020-11-07 10:03:17
  from 'C:\xampp\htdocs\accounting\ui\theme\default\auth.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fa6b735d128d2_64650736',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e13c94d00d445542835cdbac1ba138bc91413280' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\ui\\theme\\default\\auth.tpl',
      1 => 1604505114,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fa6b735d128d2_64650736 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1533283235fa6b73585aa81_06563702', "head");
?>



<?php if ($_smarty_tpl->tpl_vars['type']->value == 'admin_auth') {?>
    <?php if ((isset($_smarty_tpl->tpl_vars['config']->value['config_recaptcha_in_admin_login'])) && $_smarty_tpl->tpl_vars['config']->value['config_recaptcha_in_admin_login'] == 1) {?>

        <?php if ($_smarty_tpl->tpl_vars['config']->value['recaptcha'] == '1') {?>
            <?php echo '<script'; ?>
 src='https://www.google.com/recaptcha/api.js'><?php echo '</script'; ?>
>
        <?php }?>

    <?php }
}?>

<?php if ($_smarty_tpl->tpl_vars['type']->value == 'client_auth') {?>
    <?php if ((isset($_smarty_tpl->tpl_vars['config']->value['config_recaptcha_in_client_login'])) && $_smarty_tpl->tpl_vars['config']->value['config_recaptcha_in_client_login'] == 1 && $_smarty_tpl->tpl_vars['type']->value == 'login') {?>

        <?php if ($_smarty_tpl->tpl_vars['config']->value['recaptcha'] == '1') {?>
            <?php echo '<script'; ?>
 src='https://www.google.com/recaptcha/api.js'><?php echo '</script'; ?>
>
        <?php }?>

    <?php }
}?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12216441065fa6b7359b78d1_60591442', "content_body");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1734964725fa6b735d0ebc2_08857746', "script");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/base.tpl");
}
/* {block "head"} */
class Block_1533283235fa6b73585aa81_06563702 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_1533283235fa6b73585aa81_06563702',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <style>
        @media (min-width: 992px){
            .nav-function-fixed:not(.nav-function-top):not(.nav-function-hidden):not(.nav-function-minify) .page-content-wrapper {
                padding-left: 0;
            }
        }
    </style>
<?php
}
}
/* {/block "head"} */
/* {block "content_body"} */
class Block_12216441065fa6b7359b78d1_60591442 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content_body' => 
  array (
    0 => 'Block_12216441065fa6b7359b78d1_60591442',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="page-content-wrapper bg-transparent m-0">
        <div class="height-10 w-100 shadow-sm px-4 bg-brand-gradient">
            <div class="d-flex align-items-center container p-0">
                <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9 border-0">
                    <a href="<?php echo APP_URL;?>
" class="page-logo-link press-scale-down d-flex align-items-center">
                        <?php if ((isset($_smarty_tpl->tpl_vars['config']->value['logo_square']))) {?>
                            <img src="<?php ob_start();
echo APP_URL;
$_prefixVariable1 = ob_get_clean();
echo $_prefixVariable1;?>
/storage/system/<?php ob_start();
echo $_smarty_tpl->tpl_vars['config']->value['logo_square'];
$_prefixVariable2 = ob_get_clean();
echo $_prefixVariable2;?>
" alt="<?php ob_start();
echo $_smarty_tpl->tpl_vars['config']->value['CompanyName'];
$_prefixVariable3 = ob_get_clean();
echo $_prefixVariable3;?>
" aria-roledescription="logo">
                        <?php } else { ?>
                            <img src="<?php ob_start();
echo APP_URL;
$_prefixVariable4 = ob_get_clean();
echo $_prefixVariable4;?>
/storage/system/logo-512x512.png?v=2" alt="<?php ob_start();
echo $_smarty_tpl->tpl_vars['config']->value['CompanyName'];
$_prefixVariable5 = ob_get_clean();
echo $_prefixVariable5;?>
" aria-roledescription="logo">
                        <?php }?>
                        <?php if ((isset($_smarty_tpl->tpl_vars['config']->value['logo_text']))) {?>
                            <span class="page-logo-text mr-1"><?php echo $_smarty_tpl->tpl_vars['config']->value['logo_text'];?>
</span>
                        <?php } else { ?>
                            <span class="page-logo-text mr-1">Eduwise Accounting</span>
                        <?php }?>
                    </a>
                </div>

                <?php if (($_smarty_tpl->tpl_vars['type']->value == 'client_auth' || $_smarty_tpl->tpl_vars['type']->value == 'client_password_reset') && $_smarty_tpl->tpl_vars['config']->value['allow_customer_registration'] == '1') {?>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/register/" class="btn-link text-white ml-auto">
                        <?php echo $_smarty_tpl->tpl_vars['_L']->value['Dont have an account'];?>
 <?php echo $_smarty_tpl->tpl_vars['_L']->value['Register'];?>

                    </a>

                <?php }?>


            </div>
        </div>
        <div class="flex-1">
            <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">

                <?php if ($_smarty_tpl->tpl_vars['type']->value == 'admin_auth') {?>

                    <div class="mx-auto" style="max-width: 440px;">
                        <div class="card p-4">

                            <h1 class="mb-3 text-center">
                                <?php echo $_smarty_tpl->tpl_vars['_L']->value['Login'];?>

                            </h1>

                            <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                                <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

                            <?php }?>

                            <form method="post" class="mt-3" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
login/post/<?php if ((isset($_smarty_tpl->tpl_vars['after']->value))) {
echo $_smarty_tpl->tpl_vars['after']->value;?>
/<?php }?>">
                                <div class="form-group">
                                    <label class="form-label" for="username"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Address'];?>
</label>
                                    <input id="username" name="username" class="form-control form-control-lg" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="password"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Password'];?>
</label>
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                                </div>

                                <?php if ($_smarty_tpl->tpl_vars['config']->value['recaptcha'] == '1') {?>
                                    <div class="form-group mb-3">
                                        <div class="g-recaptcha" data-sitekey="<?php echo $_smarty_tpl->tpl_vars['config']->value['recaptcha_sitekey'];?>
"></div>
                                    </div>
                                <?php }?>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Sign in'];?>
</button>
                                </div>
                            </form>

                            <div class="text-center mt-3">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
admin/forgot-pw/" id="to-recover" class="text-info"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Forgot password'];?>
</a>
                            </div>




                        </div>
                    </div>

                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'admin_password_reset') {?>

                    <div class="mx-auto" style="max-width: 440px;">
                        <div class="card p-4">

                            <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                                <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

                            <?php }?>

                            <form method="post" class="mt-3" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
admin/forgot-pw-post/">
                                <div class="form-group">
                                    <label class="form-label" for="username"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Address'];?>
</label>
                                    <input id="username" name="username" class="form-control form-control-lg" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Reset Password'];?>
</button>
                                </div>
                            </form>

                            <div class="mt-3 text-center">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
admin/"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Back To Login'];?>
</a>
                            </div>

                        </div>
                    </div>

                    <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'client_auth') {?>

                    <div class="row">
                        <div class="col col-md-6 col-lg-7">

                            <?php if ((isset($_smarty_tpl->tpl_vars['admin']->value)) && $_smarty_tpl->tpl_vars['admin']->value) {?>
                                <div class="my-3">
                                    <a href="javascript:;" id="btn_edit_content" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Edit'];?>
</a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
dashboard" class="btn btn-primary"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Dashboard'];?>
</a>
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
logout" class="btn btn-danger"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Logout'];?>
</a>
                                </div>
                                <div class="hr-line-dashed"></div>
                            <?php }?>

                            <div style="font-size: 18px;" class="fw-300">

                                <?php echo Widget::getWidgetContent('client-auth-page-widget');?>


                            </div>



                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                            <div class="card p-4" style="box-shadow: 1px 0 20px rgba(0, 0, 0, .08);">

                                <h1 class="fw-300 mb-3 text-center">
                                    <?php echo $_smarty_tpl->tpl_vars['_L']->value['Login'];?>

                                </h1>

                                <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                                    <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

                                <?php }?>

                                <form method="post" class="mt-3" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/auth/">
                                    <div class="form-group">
                                        <label class="form-label" for="username"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Address'];?>
</label>
                                        <input id="username" name="username" class="form-control form-control-lg" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="password"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Password'];?>
</label>
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                                    </div>


                                    <?php if ((isset($_smarty_tpl->tpl_vars['config']->value['config_recaptcha_in_client_login'])) && $_smarty_tpl->tpl_vars['config']->value['config_recaptcha_in_client_login'] == 1 && $_smarty_tpl->tpl_vars['type']->value == 'login') {?>

                                        <?php if ($_smarty_tpl->tpl_vars['config']->value['recaptcha'] == '1') {?>
                                            <div class="form-group mb-3">
                                                <div class="g-recaptcha" data-sitekey="<?php echo $_smarty_tpl->tpl_vars['config']->value['recaptcha_sitekey'];?>
"></div>
                                            </div>
                                        <?php }?>

                                    <?php }?>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Login'];?>
</button>
                                    </div>

                                    <?php if ($_smarty_tpl->tpl_vars['config']->value['allow_customer_registration'] == '1') {?>
                                        <div class="form-group mb-0">
                                            <div class="col-sm-12 text-center">
                                                <?php echo $_smarty_tpl->tpl_vars['_L']->value['Dont have an account'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/register/" class="text-info m-l-5"><b><?php echo $_smarty_tpl->tpl_vars['_L']->value['Register'];?>
</b></a>
                                            </div>
                                        </div>
                                    <?php }?>

                                    <div class="text-center">
                                        <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/forgot_pw/" id="to-recover" class="text-info"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Forgot password'];?>
</a>
                                    </div>



                                </form>




                            </div>
                        </div>
                    </div>


                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'client_password_reset') {?>
                    <div class="mx-auto" style="max-width: 440px;">
                        <div class="card p-4">

                            <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                                <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

                            <?php }?>

                            <form method="post" class="mt-3" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/forgot_pw_post/">
                                <div class="form-group">
                                    <label class="form-label" for="username"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Address'];?>
</label>
                                    <input id="username" name="username" class="form-control form-control-lg" required>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Reset Password'];?>
</button>
                                </div>
                            </form>

                            <?php if ($_smarty_tpl->tpl_vars['config']->value['allow_customer_registration'] == '1') {?>
                                <div class="form-group mt-3">
                                    <div class="col-sm-12 text-center">
                                        <?php echo $_smarty_tpl->tpl_vars['_L']->value['Dont have an account'];?>
 <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/register/" class="text-info m-l-5"><b><?php echo $_smarty_tpl->tpl_vars['_L']->value['Register'];?>
</b></a>
                                    </div>
                                </div>
                            <?php }?>




                        </div>
                    </div>

                <?php } elseif ($_smarty_tpl->tpl_vars['type']->value == 'client_register') {?>

                    <div class="mx-auto" style="max-width: 440px;">
                        <div class="card p-4">

                            <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                                <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

                            <?php }?>

                            <form method="post" class="mt-3" action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/register_post/">

                                <div class="form-group">
                                    <label class="form-label" for="fullname"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Full_Name'];?>
</label>
                                    <input id="fullname" name="fullname" class="form-control form-control-lg" required>
                                </div>


                                <div class="form-group">
                                    <label class="form-label" for="username"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Email Address'];?>
</label>
                                    <input id="username" name="email" class="form-control form-control-lg" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Password'];?>
</label>
                                    <input type="password" id="password" name="password" class="form-control form-control-lg" required>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="password2"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Confirm_Password'];?>
</label>
                                    <input type="password" id="password2" name="password2" class="form-control form-control-lg" required>
                                </div>

                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['extra_fields']->value, 'field');
$_smarty_tpl->tpl_vars['field']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['field']->value) {
$_smarty_tpl->tpl_vars['field']->do_else = false;
?>

                                    <div class="form-group">
                                        <label for="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" class="form-label"><?php echo $_smarty_tpl->tpl_vars['field']->value['label'];?>
</label>
                                        <input type="text" class="form-control form-control-lg" id="field_<?php echo $_smarty_tpl->tpl_vars['field']->value['id'];?>
" name="<?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
">
                                    </div>



                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block btn-lg"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Register'];?>
</button>
                                </div>
                            </form>

                            <div class="form-group mt-3">
                                <div class="col-sm-12 text-center">
                                    <?php echo $_smarty_tpl->tpl_vars['_L']->value['Already registered'];?>
  <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
client/login/" class="text-info m-l-5"><b><?php echo $_smarty_tpl->tpl_vars['_L']->value['Login'];?>
</b></a>
                                </div>
                            </div>




                        </div>
                    </div>

                <?php }?>


                <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center">
                    &copy; <?php echo date('Y');?>
 <?php echo $_smarty_tpl->tpl_vars['config']->value['CompanyName'];?>

                </div>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block "content_body"} */
/* {block "script"} */
class Block_1734964725fa6b735d0ebc2_08857746 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_1734964725fa6b735d0ebc2_08857746',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>
        $(function () {

            var $modal = $('#cloudonex_body');

            <?php if ($_smarty_tpl->tpl_vars['type']->value == 'client_auth') {?>

            <?php if ((isset($_smarty_tpl->tpl_vars['admin']->value)) && $_smarty_tpl->tpl_vars['admin']->value) {?>

            $('#login_as_admin').on('click',function () {
                window.location = base_url + 'login/';
            });

            $('#btn_edit_content').on('click',function (e) {
                e.preventDefault();

                $.fancybox.open({
                    src  : base_url + 'settings/client-auth-page-widget',
                    type : 'ajax',
                    opts : {
                        afterShow : function( instance, current ) {
                            $('#edit_content').redactor();
                        },
                        modal: true,
                    }
                });

            });

            $modal.on('click', '.modal_submit', function(e){

                e.preventDefault();

                $.post( base_url + "settings/client-auth-page-widget-save/", $("#clx_modal_form").serialize())
                    .done(function( data ) {

                        if ($.isNumeric(data)) {

                            location.reload();

                        }

                        else {
                            toastr.error(data);
                        }

                    });

            });

            <?php }?>


            <?php }?>

        });
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block "script"} */
}
