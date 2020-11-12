<?php
/* Smarty version 3.1.36, created on 2020-11-12 01:48:34
  from 'C:\xampp\htdocs\accounting\ui\theme\default\update.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5facdac28253a3_06288572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e1d5b352e609f1bc6b36a7989e479f13894f9cfa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\ui\\theme\\default\\update.tpl',
      1 => 1604505117,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5facdac28253a3_06288572 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1799077275facdac280cf58_39632792', "head");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10849609615facdac280e6b8_41013458', "content_body");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_18814693025facdac2823477_36293969', "script");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "layouts/base.tpl");
}
/* {block "head"} */
class Block_1799077275facdac280cf58_39632792 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_1799077275facdac280cf58_39632792',
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
class Block_10849609615facdac280e6b8_41013458 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content_body' => 
  array (
    0 => 'Block_10849609615facdac280e6b8_41013458',
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



            </div>
        </div>
        <div class="flex-1">
            <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">

                <div class="mx-auto" style="max-width: 600px;">
                    <div class="card p-4">

                        <h1 class="mb-3 text-center">
                            <?php echo $_smarty_tpl->tpl_vars['_L']->value['Update'];?>

                        </h1>

                        <?php if ((isset($_smarty_tpl->tpl_vars['notify']->value))) {?>
                            <?php echo $_smarty_tpl->tpl_vars['notify']->value;?>

                        <?php }?>


                        <?php if (!(isset($_smarty_tpl->tpl_vars['config']->value['purchase_key'])) || $_smarty_tpl->tpl_vars['config']->value['purchase_key'] == '') {?>

                            <form id="form_save_purchase_key">

                                <p style="font-size: 16px;">The update requires your purchase key. You will find your purchase key by visiting the Licenses page in your CloudOnex profile.</p>

                                <div class="form-group">
                                    <label for="purchase_key">Purchase key</label>
                                    <input class="form-control" id="purchase_key" name="purchase_key" value="<?php echo $_smarty_tpl->tpl_vars['config']->value['purchase_key'];?>
">
                                </div>

                                <div class="form-group">
                                    <button class="btn btn-primary" id="btn_save_purchase_key" type="submit"><?php echo $_smarty_tpl->tpl_vars['_L']->value['Save'];?>
</button>
                                </div>

                            </form>

                            <?php } else { ?>

                            <textarea class="form-control" id="result_area">Please wait...</textarea>


                        <?php }?>


                    </div>
                </div>


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
class Block_18814693025facdac2823477_36293969 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_18814693025facdac2823477_36293969',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
>
        $(function () {

            $('#form_save_purchase_key').on('submit',function (e) {
                e.preventDefault();
                let $btn_save_purchase_key = $('#btn_save_purchase_key');

                $btn_save_purchase_key.prop('disabled',true);

                axios.post(base_url+ 'updating/save-purchase-key', $('#form_save_purchase_key').serialize())
                    .then(function (response) {
                        if(response.data.valid)
                        {
                            location.reload();
                        }
                        else{
                            toastr.error(response.data.message);
                        }

                        $btn_save_purchase_key.prop('disabled',false);
                    })
                    .catch(function (error) {
                          console.log(error);
                        $btn_save_purchase_key.prop('disabled',false);
                    });


            });


            let $result_area = $('#result_area');
            let show_progress;

            axios.post(base_url+ 'updating/check-for-update')
                .then(function (response) {

                    $result_area.val($result_area.val() + '\n' + response.data.status);

                    if(response.data.continue)
                        {
                            $result_area.val($result_area.val() + '\n' + 'Confirmation for update...');
                            $result_area.autoHeight();
                            bootbox.confirm({
                                message: response.data.status + " Would you like to update now?",
                                buttons: {
                                    confirm: {
                                        label: 'Yes, Update',
                                        className: 'btn-success'
                                    },
                                    cancel: {
                                        label: 'No',
                                        className: 'btn-danger'
                                    }
                                },
                                callback: function (confirmed) {
                                    if(confirmed)
                                        {
                                            $result_area.val($result_area.val() + '\n' + 'Confirmed!');
                                            $result_area.val($result_area.val() + '\n' + 'Getting download url from the remote server...');

                                            $result_area.autoHeight();

                                            axios.post(base_url+ 'updating/get-download-url')
                                                .then(function (response) {

                                                    if(response.data.continue)
                                                    {
                                                        $result_area.val($result_area.val() + '\n' + 'Received signed download url.');
                                                        $result_area.val($result_area.val() + '\n' + response.data.download_url);
                                                        $result_area.val($result_area.val() + '\n' + 'Downloading the latest version...');
                                                        $result_area.val($result_area.val() + '\n' + 'Please do not close your browser...');
                                                        $result_area.val($result_area.val() + '\n' + '........');
                                                        $result_area.val($result_area.val() + '\n' + '..................');
                                                        $result_area.val($result_area.val() + '\n');

                                                        $result_area.autoHeight();

                                                        show_progress = setInterval(function() {
                                                            $result_area.val($result_area.val() + '.');
                                                            //clearInterval( int ); // at some point, clear the setInterval
                                                        }, 100);

                                                        $result_area.autoHeight();
                                                        axios.post(base_url + 'updating/download-latest-version').then(function (response) {

                                                            clearInterval( show_progress );

                                                            $result_area.val($result_area.val() + '\n' + 'Downloaded!');
                                                            $result_area.val($result_area.val() + '\n' + 'Now unzipping....');



                                                            show_progress = setInterval(function() {
                                                                $result_area.val($result_area.val() + '.');
                                                                //clearInterval( int ); // at some point, clear the setInterval
                                                            }, 100);

                                                            $result_area.autoHeight();

                                                            axios.post(base_url + 'updating/unzip-downloaded-file/').then(function (response) {

                                                                clearInterval( show_progress );


                                                                if(response.data.continue)
                                                                {
                                                                    $result_area.val($result_area.val() + '\n' + 'Unzip completed!');

                                                                    $result_area.val($result_area.val() + '\n' + 'Finalizing update....');
                                                                    $result_area.val($result_area.val() + '\n' + 'Updating build number....');
                                                                    $result_area.val($result_area.val() + '\n' + 'Checking if database schema update is required....');
                                                                    $result_area.val($result_area.val() + '\n' + 'Updating database schema....');

                                                                    $result_area.autoHeight();


                                                                    axios.post(base_url + 'updating/finalize-update/').then(function (response) {



                                                                        $result_area.val($result_area.val() + '\n' + response.data.status);
                                                                        $result_area.val($result_area.val() + '\n' + 'Congratulations, you have now the latest version!');
                                                                        $result_area.autoHeight();


                                                                    }).catch(function (error) {
                                                                        console.log(error);
                                                                        clearInterval( show_progress );
                                                                    });

                                                                }
                                                                else{
                                                                    $result_area.val($result_area.val() + '\n' + response.data.status);
                                                                }



                                                            }).catch(function (error) {
                                                                console.log(error);
                                                                clearInterval( show_progress );
                                                            });

                                                        }).catch(function (error) {
                                                            console.log(error);
                                                            clearInterval( show_progress );
                                                        });
                                                    }
                                                    else{
                                                        $result_area.val($result_area.val() + '\n' + response.data.status);
                                                        $result_area.val($result_area.val() + '\n' + 'Stopped.');
                                                        $result_area.autoHeight();
                                                    }



                                                })
                                                .catch(function (error) {
                                                    console.log(error);

                                                });



                                        }
                                    else{
                                        $result_area.val($result_area.val() + '\n' + 'Update cancelled by the user.');
                                        $result_area.autoHeight();
                                    }
                                }
                            });



                        }


                })
                .catch(function (error) {
                    console.log(error);

                });


        });
    <?php echo '</script'; ?>
>
<?php
}
}
/* {/block "script"} */
}
