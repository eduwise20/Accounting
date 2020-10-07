{extends file="$layouts_admin"}

{block name="content"}

{*    <div class="row">*}
{*        <div class="col-md-12">*}
{*            <div id="updateProgressbar" class="progress" style="display: none;">*}
{*                <div class="progress progress-striped active">*}
{*                    <div class="progress-bar" id="ib_progressing" role="progressbar" data-transitiongoal="10"></div>*}
{*                </div>*}
{*            </div>*}
{*        </div>*}
{*    </div>*}
    <div class="row">
        <div class="col-md-6">
            <div class="panel" id="ib_box">
                <div class="panel-hdr">
                    <h2>Build - {$config['build']}</h2>
                </div>

                <div class="panel-container">
                    <div class="panel-content" id="ibox_update">


                        <a href="{$_url}updating/" class="cls_update btn btn-danger">{$_L['Update']}</a>


                    </div>
                </div>

            </div>

            {if $app_stage eq 'Demo'}

                <input type="hidden" name="purchase_code" id="purchase_code" value="">

            {else}

                <div class="panel" id="ib_box">

                    <div class="panel-hdr">
                        <h2>License Key</h2>
                    </div>

                    <div class="panel-container">
                        <div class="panel-content">


                            <form role="form" name="accadd" method="post" action="{$_url}settings/activate_license_post/">





                                <div class="form-group">

                                    <input type="text" required class="form-control" id="purchase_key" name="purchase_key" value="{$config['purchase_key']}">

                                    <span class="help-block">You will find your Purchase Key in your <a target="_blank" href="https://www.cloudonex.com/licenses">Profile - Downloads</a> Section
                                <br>
                                    In this format - XXXX-XXXX-XXXX-XXXX
                                </span>

                                </div>

                                <div class="form-group">
                                    <button type="submit" id="btn_save" class="btn btn-primary"><i class="fal fa-check"></i> {$_L['Save']}</button>
                                </div>
                            </form>




                        </div>
                    </div>

                </div>

            {/if}



        </div>





    </div>

{/block}

{block name="script"}
{*    <script>*}

{*        var interval;*}

{*        $(function() {*}




{*            var $resp = $("#resp");*}


{*            var before_s_update = 70;*}

{*            var latest_build;*}



{*            function updateSchema() {*}

{*                $.get( base_url + "schema-updates", function( data ) {*}



{*                    if(data.continue === true){*}
{*                        before_s_update = before_s_update+5;*}
{*                        $resp.append("=============================" + "\n");*}
{*                        $resp.append( data.message + "\n");*}
{*                        $resp.append("=============================" + "\n");*}
{*                        autosize.update($resp);*}
{*                        $ib_progressing.attr('data-transitiongoal', before_s_update);*}
{*                        $ib_progressing.progressbar();*}

{*                    }*}
{*                    else{*}

{*                        clearInterval(interval);*}

{*                        $.get( base_url + "settings/set_build/" + latest_build, function( data ) {*}

{*                            $ib_progressing.attr('data-transitiongoal', 100);*}
{*                            $ib_progressing.progressbar();*}

{*                            $resp.append("Update Complete!" + "\n");*}

{*                            autosize.update($resp);*}



{*                            $make_update.html("You are using Latest Version");*}

{*                        });*}



{*                    }*}


{*                });*}

{*            }*}





{*            var _url = $("#_url").val();*}


{*            var $ib_box = $(".ibox");*}




{*            var $make_update = $("#make_update");*}

{*            var $updateProgressbar = $("#updateProgressbar");*}

{*            var $ib_progressing = $("#ib_progressing");*}





{*            $make_update.prop('disabled', true);*}


{*            // var $action_update = $("#action_update");*}



{*            var $btn_save = $("#btn_save");*}

{*            var $input_purchase_key = $("#purchase_key");*}
{*            autosize($resp);*}

{*            function update_check() {*}
{*                $resp.focus();*}

{*                $ib_box.block({ message: block_msg });*}

{*                $resp.append("Checking for Updates... \n");*}

{*                autosize.update($resp);*}

{*                $.post( _url + "settings/check_update_post/", { purchase_key: $input_purchase_key.val()})*}
{*                    .done(function( data ) {*}



{*                        var server_resp = data;*}



{*                        latest_build = server_resp.remote_build;*}

{*                        if(server_resp.update_available === 'Yes'){*}
{*                            $resp.append("An update is available \n");*}
{*                            $resp.append("Latest Build: ");*}
{*                            $resp.append(server_resp.remote_build + "\n \n");*}
{*                            $resp.append("Changelog: \n");*}
{*                            $resp.append("========== \n");*}
{*                            $resp.append(server_resp.changelog + "\n");*}
{*                            $resp.append("=============================" + "\n");*}

{*                            $make_update.prop('disabled', false);*}

{*                        }*}
{*                        else if(server_resp.msg){*}

{*                            $resp.append(server_resp.msg + "\n");*}

{*                        }*}
{*                        else{*}
{*                            $resp.append("You are using latest version. \n");*}
{*                        }*}



{*                        autosize.update($resp);*}

{*                        matForms();*}

{*                        $ib_box.unblock();*}

{*                    });*}




{*            }*}

{*            // $check_update.on('click', function(e) {*}
{*            //     e.preventDefault();*}
{*            //*}
{*            //*}
{*            // });*}

{*            update_check();*}


{*            $make_update.on('click', function(e) {*}
{*                e.preventDefault();*}


{*                var $make_update = $("#make_update");*}

{*                $make_update.prop('disabled', true);*}

{*                $make_update.html("Updating...");*}

{*                $updateProgressbar.show('slow');*}
{*                $ib_progressing.attr('data-transitiongoal', 10);*}
{*                $ib_progressing.progressbar();*}




{*                $resp.append("\n");*}
{*                $resp.append("Preparing.... \n");*}
{*                $resp.append("Please do not close your browser.... \n");*}
{*                $resp.append("Creating backup for current application.... \n");*}

{*                $.get( base_url + "settings/backup_app/", function( data ) {*}

{*                    if(data.continue == 'Yes'){*}

{*                        $resp.append( data.message + "\n");*}
{*                        $resp.append( "Getting Download Link..." + "\n");*}
{*                        autosize.update($resp);*}

{*                        $.get( _url + "settings/get_latest/", function( data ) {*}

{*                            if(data.continue == 'Yes'){*}

{*                                $ib_progressing.attr('data-transitiongoal', 20);*}
{*                                $ib_progressing.progressbar();*}

{*                                var link = data.link;*}

{*                                $resp.append("=============================" + "\n");*}
{*                                $resp.append( data.message + "\n");*}
{*                                $resp.append("=============================" + "\n");*}
{*                                $resp.append( "Downloading..." + "\n");*}
{*                                $resp.append("Please do not close your browser.... \n");*}
{*                                $resp.append("=============================" + "\n");*}
{*                                autosize.update($resp);*}



{*                                $.post( _url + "settings/dl_latest/", { link: link })*}
{*                                    .done(function( data ) {*}

{*                                        if(data.continue == 'Yes'){*}

{*                                            $ib_progressing.attr('data-transitiongoal', 50);*}
{*                                            $ib_progressing.progressbar();*}

{*                                            $resp.append("=============================" + "\n");*}
{*                                            $resp.append( data.message + "\n");*}
{*                                            $resp.append("=============================" + "\n");*}
{*                                            $resp.append( "Unzipping..." + "\n");*}

{*                                            $resp.append("=============================" + "\n");*}
{*                                            autosize.update($resp);*}


{*                                            $.get( _url + "settings/dl_unzip/", function( data ) {*}

{*                                                if(data.continue == 'Yes'){*}

{*                                                    $ib_progressing.attr('data-transitiongoal', 60);*}
{*                                                    $ib_progressing.progressbar();*}

{*                                                    $resp.append("=============================" + "\n");*}
{*                                                    $resp.append( data.message + "\n");*}
{*                                                    $resp.append("=============================" + "\n");*}
{*                                                    $resp.append( "Completing Update...." + "\n");*}

{*                                                    $resp.append("=============================" + "\n");*}
{*                                                    autosize.update($resp);*}


{*                                                    // while (updateSchema()) {*}
{*                                                    //     $resp.append("=============================" + "\n");*}
{*                                                    //     $resp.append( schemaMsg + "\n");*}
{*                                                    //     $resp.append("=============================" + "\n");*}
{*                                                    // }*}

{*                                                    interval = setInterval(updateSchema,5000);*}


{*                                                    // $.get( _url + "settings/update_complete/", function( data ) {*}
{*                                                    //*}
{*                                                    //     $ib_progressing.attr('data-transitiongoal', 100);*}
{*                                                    //     $ib_progressing.progressbar();*}
{*                                                    //*}
{*                                                    //     $resp.append(data + "\n");*}
{*                                                    //*}
{*                                                    //     autosize.update($resp);*}
{*                                                    //*}
{*                                                    //     //  $action_update.html("");*}
{*                                                    //     $make_update.html("You are using Latest Version");*}
{*                                                    //*}
{*                                                    //    // $(document).scrollTop($(document).height());*}
{*                                                    //*}
{*                                                    //*}
{*                                                    //    // $("html, body").animate({ scrollTop: 0 }, "slow");*}
{*                                                    //*}
{*                                                    //*}
{*                                                    //*}
{*                                                    //*}
{*                                                    // });*}



{*                                                }*}
{*                                                else{*}

{*                                                    $resp.append( "Error: " + data.message + "\n");*}
{*                                                    $make_update.html("Update");*}
{*                                                    $make_update.prop('disabled', false);*}
{*                                                    autosize.update($resp);*}
{*                                                }*}



{*                                            });*}



{*                                        }*}
{*                                        else{*}

{*                                            $resp.append( "Error: " + data.message + "\n");*}
{*                                            $make_update.html("Update");*}
{*                                            $make_update.prop('disabled', false);*}
{*                                            autosize.update($resp);*}
{*                                        }*}
{*                                    });*}




{*                            }*}
{*                            else{*}

{*                                $resp.append( "Error: " + data.message + "\n");*}
{*                                $make_update.html("Update");*}
{*                                $make_update.prop('disabled', false);*}
{*                                autosize.update($resp);*}
{*                            }*}


{*                        });*}

{*                    }*}

{*                    else{*}

{*                        $resp.append( "Error: " + data.message + "\n");*}
{*                        $make_update.html("Update");*}
{*                        $make_update.prop('disabled', false);*}
{*                        autosize.update($resp);*}
{*                    }*}


{*                });*}





{*                autosize.update($resp);*}

{*                matForms();*}


{*            });*}




{*            $btn_save.on('click', function(e) {*}
{*                e.preventDefault();*}

{*                $ib_box.block({ message: block_msg });*}

{*                $.post( _url + "settings/add_purchase_key/", { purchase_key: $input_purchase_key.val()})*}
{*                    .done(function( data ) {*}



{*                        $resp.append(data);*}

{*                        autosize.update($resp);*}

{*                        $ib_box.unblock();*}

{*                    });*}

{*            });*}

{*        });*}

{*    </script>*}
{/block}
