<?php
/* Smarty version 3.1.36, created on 2020-11-11 02:24:51
  from 'C:\xampp\htdocs\accounting\ui\theme\default\pl-list.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fab91c37c0621_26384618',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '950b343bffa7ccb91a49c0ea0feb21822a6b1c27' => 
    array (
      0 => 'C:\\xampp\\htdocs\\accounting\\ui\\theme\\default\\pl-list.tpl',
      1 => 1604505116,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fab91c37c0621_26384618 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9715981285fab91c37ad819_15619199', "head");
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9953215205fab91c37af698_58175644', "content");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4649196445fab91c37bf215_28043452', "script");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, ((string)$_smarty_tpl->tpl_vars['layouts_admin']->value));
}
/* {block "head"} */
class Block_9715981285fab91c37ad819_15619199 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_9715981285fab91c37ad819_15619199',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <style>
        .grid-item {
            width: 250px;
            padding-right: 20px;


        }

        .grid-item--width3 { width: 750px; }

        .product-imitation{
            padding: 25px;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #F7F9FC;

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

    </style>
<?php
}
}
/* {/block "head"} */
/* {block "content"} */
class Block_9953215205fab91c37af698_58175644 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_9953215205fab91c37af698_58175644',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="row">

        <div class="col-md-12">

            <div class="panel" id="uploading_inside">
                <div class="panel-container">
                    <div class="panel-content">
                        <form action="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
settings/plugin_upload/" class="dropzone" id="upload_container">

                            <div class="dz-message">
                                <h3> <i class="fal fa-cloud-upload"></i>  <?php echo $_smarty_tpl->tpl_vars['_L']->value['plugin_drop_help'];?>
</h3>
                                <br />
                                <span class="note"><?php echo $_smarty_tpl->tpl_vars['_L']->value['plugin_upload_help'];?>
</span>
                            </div>

                        </form>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-hdr">
                            <h2><?php echo $_smarty_tpl->tpl_vars['_L']->value['Plugins'];?>
</h2>

                        </div>
                        <div class="panel-container">
                            <div class="panel-content">
                                <div class="project-list mt-md">
                                    <div id="progressbar">
                                    </div>

                                    <div id="application_ajaxrender"><table class="table table-striped">
                                            <tbody>
                                            <?php echo $_smarty_tpl->tpl_vars['pl_html']->value;?>

                                            </tbody>
                                        </table></div>


                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-md-12">

            <div class="grid">


                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['core_plugins']->value, 'core_plugin');
$_smarty_tpl->tpl_vars['core_plugin']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['core_plugin']->value) {
$_smarty_tpl->tpl_vars['core_plugin']->do_else = false;
?>
                    <div class="grid-item">
                        <div class="panel">

                            <div class="panel-container">
                                <div class="panel-content product-box">

                                    <div class="product-imitation">
                                        <a href="javascript:void(0)" class="app_details"><img class="img-fluid" src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
storage/system/plugins/<?php echo $_smarty_tpl->tpl_vars['core_plugin']->value['image'];?>
"></a>
                                    </div>
                                    <div class="product-desc">

                                        <a href="javascript:void(0)" class="app_details" data-id="1"><span class="product-price">
                                    Core
                                </span></a>


                                        <h6><a href="javascript:void(0)" class="app_details" data-id="1"><?php echo $_smarty_tpl->tpl_vars['core_plugin']->value['name'];?>
</a> </h6>




                                        <p class="m-t-xs">

                                            <?php echo $_smarty_tpl->tpl_vars['core_plugin']->value['description'];?>


                                        </p>
                                        <hr>
                                        <div class="text-right">
                                            <div class="btn-group">

                                                <?php if ($_smarty_tpl->tpl_vars['config']->value[$_smarty_tpl->tpl_vars['core_plugin']->value['identity']]) {?>
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
app_store/disable/<?php echo $_smarty_tpl->tpl_vars['core_plugin']->value['identity'];?>
/" class="btn btn-danger btn-sm app_details" data-id="1">Disable</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo $_smarty_tpl->tpl_vars['_url']->value;?>
app_store/enable/<?php echo $_smarty_tpl->tpl_vars['core_plugin']->value['identity'];?>
/" class="btn btn-primary btn-sm app_details" data-id="1">Enable</a>
                                                <?php }?>


                                            </div>





                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>








            </div>

        </div>


    </div>




    <input type="hidden" id="_msg_unzipping" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['Unzipping'];?>
 ...">
    <input type="hidden" id="_msg_are_you_sure" value="<?php echo $_smarty_tpl->tpl_vars['_L']->value['are_you_sure'];?>
">

<?php
}
}
/* {/block "content"} */
/* {block "script"} */
class Block_4649196445fab91c37bf215_28043452 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'script' => 
  array (
    0 => 'Block_4649196445fab91c37bf215_28043452',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['app_url']->value;?>
ui/lib/masonry.pkgd.min.js"><?php echo '</script'; ?>
>

    <?php echo '<script'; ?>
>
        Dropzone.autoDiscover = false;
        $(function() {
            var _url = $("#_url").val();
            var ib_file = new Dropzone("#upload_container",
                {
                    url: _url + "settings/plugin_upload/",
                    maxFiles: 1,
                    acceptedFiles: ".zip"
                }
            );

            //ib_file.on("addedfile", function(file) {
            //
            //});

            ib_file.on("success", function(file) {

                var _msg_unzipping = $('#_msg_unzipping').val();
                $('#uploading_inside').block({
                    message: "<h3>" + _msg_unzipping +"</h3>" ,
                    css: {
                        padding:        0,
                        margin:         0,
                        width:          '30%',
                        top:            '40%',
                        left:           '35%',
                        textAlign:      'center',
                        color:          '#FFFFFF',
                        border:         '0',
                        backgroundColor:'transparent',
                        cursor:         'wait'
                    }
                });
                //   $('#uploading_inside').block({ message: null });

                var _url = $("#_url").val();
                $.post(_url + 'settings/plugin_unzip/', {

                    name: file.name

                })
                    .done(function (data) {

                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    });
            });



            $(".c_uninstall").click(function (e) {
                e.preventDefault();
                var _msg_are_you_sure = $('#_msg_are_you_sure').val();
                var to_url = this.href;
                bootbox.confirm(_msg_are_you_sure, function(result) {
                    if(result == true){
                        window.location = to_url;
                    }
                });



            });


            $('.grid').masonry({
                // options
                itemSelector: '.grid-item',
                columnWidth: 250
            });



        });
    <?php echo '</script'; ?>
>

<?php
}
}
/* {/block "script"} */
}
