{extends file="$layouts_admin"}
{block name="head"}

    <style>

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

    </style>

{/block}

{block name="content"}

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Add Fee Name</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg">
                            <span id="emsgbody"></span>
                        </div>

                        <form id="rform">

                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3"><span class="h6">Name</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="name" name="name" class="form-control" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-3"><span class="h6">Code</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="code" name="code" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-3"><span class="h6">Fee Group</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select id="fee_group_id" name="fee_group_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $fee_groups as $fee_group}
                                                    <option value="{$fee_group->id}">{$fee_group->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is taxable</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_taxable" class="custom-control-input" id="is_taxable">
                                                <label class="custom-control-label" for="is_taxable"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is fine applicable</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_fine_applicable" class="custom-control-input" id="is_fine_applicable">
                                                <label class="custom-control-label" for="is_fine_applicable"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is discount applicable</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_discount_applicable" class="custom-control-input" id="is_discount_applicable">
                                                <label class="custom-control-label" for="is_discount_applicable"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is scholarship applicable</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_scholarship_applicable" class="custom-control-input" id="is_scholarship_applicable">
                                                <label class="custom-control-label" for="is_scholarship_applicable"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is transportation</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_transportation" class="custom-control-input" id="is_transportation">
                                                <label class="custom-control-label" for="is_transportation"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="from_section">
                                        <label for="name" class="col-sm-3"><span class="h6">From</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="from" name="from" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row" id="to_section">
                                        <label for="name" class="col-sm-3"><span class="h6">To</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="to" name="to" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is active</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active">
                                                <label class="custom-control-label" for="is_active"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_compulsary" class="col-sm-3"><span class="h6">Is Compulsary</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_compulsary" class="custom-control-input" id="is_compulsary">
                                                <label class="custom-control-label" for="is_compulsary"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary mt-3 mr-3" type="submit" id="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

{/block}

{block name="script"}
    <script>
        $(document).ready(function () {
            $(".progress").hide();
            $("#emsg").hide();
            $("#from_section").hide();
            $("#to_section").hide();
            var _url = '{$_url}';


            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                theme: "bootstrap"
            });

            var $cid = $('#cid');

            $cid.select2();

            $("#is_transportation").change(function(){
                if($(this).is(':checked')) {
                    $("#from_section").show();
                    $("#to_section").show();
                } else {
                    $("#from_section").hide();
                    $("#to_section").hide();
                }
            });

            $("#submit").click(function (e) {
                e.preventDefault();
                $('#ibox_form').block({ message:block_msg });
                $.post(base_url + 'fee_names/app/save/', $( "#rform" ).serialize())
                    .done(function (data) {
                        console.log(data);
                        var sbutton = $("#submit");
                        if ($.isNumeric(data)) {
                            window.location = base_url + 'fee_names/app/list';
                        }
                        else {
                            $('#ibox_form').unblock();
                            var body = $("html, body");
                            body.animate({ scrollTop:0 }, '1000', 'swing');
                            $("#emsgbody").html(data);
                            $("#emsg").show("slow");
                        }
                    });
            });

        });
    </script>
{/block}


