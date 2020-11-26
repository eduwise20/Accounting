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
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Fee Rate Master</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg">
                            <span id="emsgbody"></span>
                        </div>

                        <form id="fee_rate_master_form">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Fiscal Year</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="fiscal_year_id" name="fiscal_year_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $fiscal_years as $fiscal_year}
                                                    <option value="{$fiscal_year->id}">{$fiscal_year->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Class</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="class_id" name="class_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $classes as $class}
                                                    <option value="{$class->id}">{$class->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="faculty_section">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Faculty</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="faculty_id" name="faculty_id" class="custom-select">
                                                <option value="0">--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Student Type</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="student_type_id" name="student_type_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $student_types as $student_type}
                                                    <option value="{$student_type->id}">{$student_type->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Category</span></label>
                                        <div class="col-sm-8">
                                            <select id="category_id" name="category_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $categories as $category}
                                                    <option value="{$category->id}">{$category->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Sub Category</span></label>
                                        <div class="col-sm-8">
                                            <select id="sub_category_id" name="sub_category_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $sub_categories as $sub_category}
                                                    <option value="{$sub_category->id}">{$sub_category->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary mt-3 mr-3 disabled" type="button" id="btn_assign">Assign</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7" id="fee_rate_info_section">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Fee Rate Info</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg_fee_rate_info">
                            <span id="emsgbody_fee_rate_info"></span>
                        </div>

                        <form id="fee_rate_info_form">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <div class="panel-content">
                                        <div class="table-responsive" id="ib_data_panel">

                                            <table class="table table-striped w-100"  id="clx_datatable">
                                                <thead style="background: #f0f2ff">
                                                <tr class="heading">
                                                    <th>Fee Name</th>
                                                    <th>Fee Code</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                {foreach $fee_names as $fee_name}
                                                    <tr>
                                                        <td>
                                                            {$fee_name->name}
                                                        </td>
                                                        <td>
                                                            {$fee_name->code}
                                                        </td>
                                                        <td>
                                                            <input type="text" id="amount[{$fee_name->id}]" name="amount[{$fee_name->id}]" class="form-control">
                                                            <input type="hidden" id="fee_name_id[{$fee_name->id}]" name="fee_name_id[{$fee_name->id}]" value="{$fee_name->id}" />
                                                        </td>
                                                    </tr>
                                                {/foreach}
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary mt-3 mr-3" type="button" id="btn_submit">Submit</button>
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

            const fiscal_year_id = $("#fiscal_year_id");
            const class_id = $("#class_id");
            const student_type_id = $("#student_type_id");
            const faculty_id = $("#faculty_id");
            let is_fiscal_year_chosen = false;
            let is_class_chosen = false;
            let is_student_type_chosen = false;
            let is_faculty_populated = false;
            let is_faculty_chosen = false;
            const btn_assign = $("#btn_assign");
            const fee_rate_info_section = $("#fee_rate_info_section");
            const faculty_section = $("#faculty_section");

            fee_rate_info_section.hide();
            faculty_section.hide();
            $(".progress").hide();
            $("#emsg").hide();
            $("#emsg_fee_rate_info").hide();
            btn_assign.prop("disabled", true);
            var _url = '{$_url}';

            fiscal_year_id.change(function(){
                is_fiscal_year_chosen = fiscal_year_id[0].value != 0;
                checkToRemoveDisabled();
            });

            class_id.change(function(){
                is_class_chosen = class_id[0].value != 0;
                if (is_class_chosen) {
                    getFacultyForClass(class_id[0].value);
                }
                checkToRemoveDisabled();
            });

            student_type_id.change(function(){
                is_student_type_chosen = student_type_id[0].value != 0;
                checkToRemoveDisabled();
            });

            faculty_id.change(function(){
                is_faculty_chosen = faculty_id[0].value !== 0;
                checkToRemoveDisabled();
            });

            function checkToRemoveDisabled() {
                fee_rate_info_section.hide();
                $("#fee_rate_info_form").trigger("reset");
                if (is_fiscal_year_chosen && is_class_chosen && is_student_type_chosen) {
                    if (is_faculty_populated) {
                        if (is_faculty_chosen) {
                            enableAssignButton();
                        } else {
                            disableAssignButton();
                        }
                    } else {
                        enableAssignButton();
                    }
                } else {
                    disableAssignButton();
                }
            }

            function enableAssignButton() {
                btn_assign.removeClass("disabled");
                btn_assign.prop("disabled", false);
            }

            function disableAssignButton() {
                btn_assign.addClass("disabled");
                btn_assign.prop("disabled", true);
            }

            function getFacultyForClass(class_id) {
                $.post(base_url + 'fee_rates/app/getFacultyForClass/',
                    { class_id : class_id },
                    function (data, status){
                        let faculties = JSON.parse(data);
                        if (faculties.length > 0) {
                            populateFacultySelectList(faculties);
                            is_faculty_populated = true;
                            faculty_section.show();
                        } else {
                            is_faculty_populated = false;
                            faculty_section.hide();
                        }
                        checkToRemoveDisabled();
                    });
            }

            function populateFacultySelectList(faculties) {
                faculties.forEach(function(faculty) {
                    $("#faculty_id").append('<option value="' + faculty['id'] + '">' + faculty['name'] + '</option>');
                });
            }

            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                theme: "bootstrap"
            });

            var $cid = $('#cid');

            $cid.select2();

            btn_assign.click(function (e) {
                disableAssignButton();
                e.preventDefault();
                $.post(base_url + 'fee_rates/app/getFeeStructuresForFeeRate/',
                    {
                        fiscal_year_id : fiscal_year_id[0].value,
                        class_id : class_id[0].value,
                        student_type_id : student_type_id[0].value,
                        faculty_id : faculty_id[0].value,
                    },
                    function (data, status){
                        if(data) {
                            let fee_structures = JSON.parse(data);
                            if (fee_structures.length > 0) {
                                populateAmount(fee_structures);
                            }
                        }
                        fee_rate_info_section.show();
                    });

            });

            function populateAmount(fee_structures) {
                fee_structures.forEach(function(fee_structure) {
                    let amount = $('input[id="amount['+ fee_structure['fee_names_id'] +']"]')
                    if (amount) {
                        amount[0].value = fee_structure['amount'];
                    }
                });
            }

            $("#btn_submit").click(function (e) {
                e.preventDefault();
                $('#ibox_form').block({ message:block_msg });
                $.post(base_url + 'fee_rates/app/save/', $('#fee_rate_master_form, #fee_rate_info_form').serialize())
                    .done(function (data) {
                        if ($.isNumeric(data)) {
                            window.location = base_url + 'fee_rates/app/add';
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