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
                    <h2><span></span>Edit Discount</h2>
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
                                            <input type="text" id="name" name="name" class="form-control" autofocus value="{$discount->name}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="code" class="col-sm-3"><span class="h6">Type</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <div class="radio">
                                                <label><input type="radio" name="type" value="Amount" {if $discount->type eq "Amount"}checked{/if}> Amount</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="type" value="Percentage" {if $discount->type eq "Percentage"}checked{/if}> Percentage</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="order" class="col-sm-3"><span class="h6">Amount</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="amount" name="amount" class="form-control" value="{$discount->amount}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is recurring</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_recurring" class="custom-control-input" id="is_recurring" {if $discount->is_recurring eq 1}checked{/if}>
                                                <label class="custom-control-label" for="is_recurring"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is active</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_active" class="custom-control-input" id="is_active" {if $discount->is_active eq 1}checked{/if}>
                                                <label class="custom-control-label" for="is_active"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-3"><span class="h6">Remarks</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="remarks" name="remarks" class="form-control" value="{$discount->remarks}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="{$discount->id}">

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
            var _url = '{$_url}';


            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                theme: "bootstrap"
            });

            var $cid = $('#cid');

            $cid.select2();

            $("#submit").click(function (e) {
                e.preventDefault();
                $('#ibox_form').block({ message:block_msg });
                $.post(base_url + 'discounts/app/save/', $( "#rform" ).serialize())
                    .done(function (data) {
                        console.log(data);
                        var sbutton = $("#submit");
                        if ($.isNumeric(data)) {
                            window.location = base_url + 'discounts/app/list';
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


