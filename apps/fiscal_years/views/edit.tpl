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

    <link rel="stylesheet" href="https://unpkg.com/nepali-date-picker@2.0.1/dist/nepaliDatePicker.min.css" crossorigin="anonymous" />
{/block}

{block name="content"}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Edit Fiscal Year</h2>
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
                                            <input type="text" id="name" name="name" class="form-control" autofocus value="{$fiscal_year->name}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="code" class="col-sm-3"><span class="h6">Code</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="code" name="code" class="form-control" value="{$fiscal_year->code}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="order" class="col-sm-3"><span class="h6">Order</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="order" name="order" class="form-control" value="{$fiscal_year->order}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="year" class="col-sm-3"><span class="h6">Year</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="year" name="year" class="form-control" value="{$fiscal_year->year}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="start_date" class="col-sm-3"><span class="h6">Start Date</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="start_date" name="start_date" class="form-control date-picker" value="{$fiscal_year->start_date}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="end_date" class="col-sm-3"><span class="h6">End Date</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="end_date" name="end_date" class="form-control date-picker" value="{$fiscal_year->end_date}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="is_running" class="col-sm-3"><span class="h6">Is running</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="is_running" class="custom-control-input" id="is_running" {if $fiscal_year->is_running eq 1}checked{/if}>
                                                <label class="custom-control-label" for="is_running"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="allow_entry" class="col-sm-3"><span class="h6">Allow Entry</span></label>
                                        <div class="col-sm-9">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="allow_entry" class="custom-control-input" id="allow_entry" {if $fiscal_year->allow_entry eq 1}checked{/if}>
                                                <label class="custom-control-label" for="allow_entry"><span class="h6"></span></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-3"><span class="h6">Remarks</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="remarks" name="remarks" class="form-control" value="{$fiscal_year->remarks}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="{$fiscal_year->id}">

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
    <script src="https://unpkg.com/nepali-date-picker@2.0.1/dist/jquery.nepaliDatePicker.min.js" crossorigin="anonymous"></script>
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
                $.post(base_url + 'fiscal_years/app/save/', $( "#rform" ).serialize())
                    .done(function (data) {
                        console.log(data);
                        var sbutton = $("#submit");
                        if ($.isNumeric(data)) {
                            window.location = base_url + 'fiscal_years/app/list';
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

        $('.date-picker').nepaliDatePicker({
            dateFormat: '%y-%m-%d',
            closeOnDateSelect: true
        });
    </script>
{/block}


