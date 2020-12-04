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
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Assign Fine to Student</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg">
                            <span id="emsgbody"></span>
                        </div>

                        <div class="alert alert-info" id="smsg">
                            <span id="smsgbody"></span>
                        </div>

                        <form id="assign_fine_to_student_master_form">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="radio">
                                                <label><input type="radio" name="assign_radio_button" value="multiple_students" checked> Assign a single fine to multiple students</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="assign_radio_button" value="multiple_fines"> Assign multiple fines to a single student</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="class_id" class="col-sm-4"><span class="h6">Class</span><span class="text-danger">*</span></label>
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
                                        <label for="faculty_id" class="col-sm-4"><span class="h6">Faculty</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="faculty_id" name="faculty_id" class="custom-select">
                                                <option value="0">--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="student_type_id" class="col-sm-4"><span class="h6">Student Type</span><span class="text-danger">*</span></label>
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
                                        <label for="category_id" class="col-sm-4"><span class="h6">Category</span></label>
                                        <div class="col-sm-8">
                                            <select id="category_id" name="category_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $categories as $category}
                                                    <option value="{$category->id}">{$category->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="sub_category_section">
                                        <label for="sub_category_id" class="col-sm-4"><span class="h6">Sub Category</span></label>
                                        <div class="col-sm-8">
                                            <select id="sub_category_id" name="sub_category_id" class="custom-select">
                                                <option value="0">--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="billing_period_id" class="col-sm-4"><span class="h6">Billing Period</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="billing_period_id" name="billing_period_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $billing_periods as $billing_period}
                                                    <option value="{$billing_period->id}">{$billing_period->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="billing_date" class="col-sm-4"><span class="h6">Billing Date</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" id="billing_date" name="billing_date" class="form-control date-picker">
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
        <div class="col-md-7" id="student_fine_section">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Assign Fine to Student</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg_fee_rate_info">
                            <span id="emsgbody_fee_rate_info"></span>
                        </div>

                        <form id="assign_fine_to_student_form">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <div class="panel-content">
                                        <div id="student_and_fine_dropdown">
                                        </div>
                                        <hr/>
                                        <div class="table-responsive" id="fine_table">

                                            <table class="table table-striped w-100"  id="clx_datatable">
                                                <thead style="background: #f0f2ff" id="table_head"></thead>
                                                <tbody id="table_body"></tbody>
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


    <div class="modal fade" id="modal_add_item" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Fine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="ibox_form_modal">
                    <div class="alert alert-danger" id="emsgmodal">
                        <span id="emsgbodymodal"></span>
                    </div>
                    <form id="fine_form">

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3"><span class="h6">Name</span><span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="name" name="name" class="form-control" autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="code" class="col-sm-3"><span class="h6">Type</span><span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <div class="radio">
                                            <label><input type="radio" name="type" value="Amount" checked> Amount</label>
                                        </div>
                                        <div class="radio">
                                            <label><input type="radio" name="type" value="Percentage"> Percentage</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="order" class="col-sm-3"><span class="h6">Amount</span><span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="amount" name="amount" class="form-control">
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
                                    <label for="remarks" class="col-sm-3"><span class="h6">Remarks</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" id="remarks" name="remarks" class="form-control">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="btn_modal_action" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>


{/block}

{block name="script"}
    <script src="https://unpkg.com/nepali-date-picker@2.0.1/dist/jquery.nepaliDatePicker.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            const class_id = $("#class_id");
            const student_type_id = $("#student_type_id");
            const faculty_id = $("#faculty_id");
            const category_id = $("#category_id");
            const sub_category_id = $("#sub_category_id");
            const billing_period_id = $("#billing_period_id");
            let is_class_chosen = false;
            let is_student_type_chosen = false;
            let is_faculty_populated = false;
            let is_faculty_chosen = false;
            let is_category_chosen = false;
            let is_billing_period_chosen = false;
            const btn_assign = $("#btn_assign");
            const student_fine_section = $("#student_fine_section");
            const faculty_section = $("#faculty_section");
            const sub_category_section = $("#sub_category_section");
            const student_and_fine_dropdown = $("#student_and_fine_dropdown");
            const submit_button = $("#btn_submit");

            student_fine_section.hide();
            faculty_section.hide();
            sub_category_section.hide();
            submit_button.hide();
            $(".progress").hide();
            $("#emsg").hide();
            $("#smsg").hide();
            $("#emsgmodal").hide();
            $("#emsg_fee_rate_info").hide();
            btn_assign.prop("disabled", true);
            var _url = '{$_url}';

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
                is_faculty_chosen = faculty_id[0].value != 0;
                checkToRemoveDisabled();
            });

            billing_period_id.change(function(){
                is_billing_period_chosen = billing_period_id[0].value != 0;
                checkToRemoveDisabled();
            });

            category_id.change(function(){
                is_category_chosen = category_id[0].value != 0;
                if (is_category_chosen) {
                    getSubCategoriesForCategory(category_id[0].value);
                    enableAssignButton();
                } else {
                    $("#sub_category_id").html('<option value="0">--</option>');
                    sub_category_section.hide();
                }
                checkToRemoveDisabled();
            });

            sub_category_id.change(function(){
                if(sub_category_id[0].value != 0){
                    enableAssignButton();
                    checkToRemoveDisabled();
                }
            });

            function checkToRemoveDisabled() {
                $("#table_head").html('');
                $("#table_body").html('');
                $("#create_btn").remove();
                $("#btn_submit").hide();
                student_fine_section.hide();
                $("#fee_rate_info_form").trigger("reset");
                if (is_class_chosen && is_student_type_chosen && is_billing_period_chosen) {
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
                $.post(base_url + 'fines/app_assign_fine/getFacultyForClass/',
                    { class_id : class_id },
                    function (data, status){
                        let faculties = JSON.parse(data);
                        if (faculties.length > 0) {
                            populateFacultySelectList(faculties);
                            is_faculty_populated = true;
                            faculty_section.show();
                        } else {
                            $("#faculty_id").html('<option value="0">--</option>');
                            is_faculty_populated = false;
                            faculty_section.hide();
                        }
                        checkToRemoveDisabled();
                    });
            }

            function getSubCategoriesForCategory(category_id) {
                $.post(base_url + 'fines/app_assign_fine/getSubCategoriesForCategory/',
                    { category_id : category_id },
                    function (data, status){
                        let sub_categories = JSON.parse(data);
                        if (sub_categories.length > 0) {
                            populateSubCategoryList(sub_categories);
                            sub_category_section.show();
                        } else {
                            $("#sub_category_id").html('<option value="0">--</option>');
                            sub_category_section.hide();
                        }
                        checkToRemoveDisabled();
                    });
            }

            function populateFacultySelectList(faculties) {
                $("#faculty_id").html('<option value="0">--</option>');
                faculties.forEach(function(faculty) {
                    $("#faculty_id").append('<option value="' + faculty['id'] + '">' + faculty['name'] + '</option>');
                });
            }

            function populateSubCategoryList(sub_categories) {
                $("#sub_category_id").html('<option value="0">--</option>');
                sub_categories.forEach(function(sub_category) {
                    $("#sub_category_id").append('<option value="' + sub_category['id'] + '">' + sub_category['name'] + '</option>');
                });
            }

            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                theme: "bootstrap"
            });

            var $cid = $('#cid');

            $cid.select2();

            $('input[type=radio][name=assign_radio_button]').change(function() {
                student_fine_section.hide();
                checkToRemoveDisabled();
            });

            btn_assign.click(function (e) {
                disableAssignButton();
                e.preventDefault();
                let assign_radio_button_value = $('input[name="assign_radio_button"]:checked').val();
                let postValue = {
                    assign_radio_button : assign_radio_button_value,
                    class_id : class_id[0].value,
                    student_type_id : student_type_id[0].value,
                    faculty_id : faculty_id[0].value,
                };
                if (category_id.length > 0) {
                    postValue.category_id = category_id[0].value;
                }
                if (sub_category_id.length > 0) {
                    postValue.sub_category_id = sub_category_id[0].value;
                }
                $.post(base_url + 'fines/app_assign_fine/getStudentAndFine/',
                    postValue,
                    function (data, status){
                        if(data) {
                            let returnedResult = JSON.parse(data);
                            if (returnedResult['students'].length == 0) {
                                $('#ibox_form').unblock();
                                var body = $("html, body");
                                body.animate({ scrollTop:0 }, '1000', 'swing');
                                $("#emsgbody").html('No students found!');
                                $("#emsg").show("slow");
                            } else if (returnedResult['fines'].length == 0) {
                                $('#ibox_form').unblock();
                                var body = $("html, body");
                                body.animate({ scrollTop:0 }, '1000', 'swing');
                                $("#emsgbody").html('No fines found!');
                                $("#emsg").show("slow");
                            } else  {
                                $("#emsg").hide("slow");
                                if (assign_radio_button_value === 'multiple_students') {
                                    populateMultipleStudentsTable(returnedResult);
                                } else if (assign_radio_button_value === 'multiple_fines') {
                                    populateMultipleFinesTable(returnedResult);
                                }
                                student_fine_section.show();
                            }
                        }
                    });

            });

            function populateMultipleStudentsTable(returnedResult) {
                setFinesDropdown(returnedResult['fines']);
            }

            function setFinesDropdown(fines) {
                let opts = '<option value="0">--</option>';
                $.each(fines, function(i) {
                    opts += "<option value='" + fines[i].id + "' >" + fines[i].name + "</option>";
                });
                student_and_fine_dropdown.html('<div class="form-group row"><label for="remarks" class="col-sm-4"><span class="h6">Fines</span></label><div class="col-sm-8"><select class="custom-select" name="fine_id" id="fine_dropdown">' + opts + '</select> </div></div>');
            }

            function populateMultipleFinesTable(returnedResult) {
                setStudentsDropdown(returnedResult['students']);
            }

            function setStudentsDropdown(students) {
                let opts = '<option value="0">--</option>';
                $.each(students, function(i) {
                    opts += "<option value='" + students[i].id + "' >" + students[i].name + "</option>";
                });
                student_and_fine_dropdown.html('<div class="form-group row"><label for="remarks" class="col-sm-4"><span class="h6">Students</span></label><div class="col-sm-8"><select class="custom-select" name="student_id" id="student_dropdown">' + opts + '</select> </div></div>');
            }

            $("#btn_submit").click(function (e) {
                e.preventDefault();
                $('#ibox_form').block({ message:block_msg });
                $.post(base_url + 'fines/app_assign_fine/save/', $('#assign_fine_to_student_master_form, #assign_fine_to_student_form').serialize())
                    .done(function (data) {
                        $('#ibox_form').unblock();
                        var body = $("html, body");
                        body.animate({ scrollTop:0 }, '1000', 'swing');
                        if ($.isNumeric(data)) {
                            $("#emsg").hide("slow");
                            $("#smsgbody").html("Fine assigned successfully");
                            $("#smsg").show("slow");
                        }
                        else {
                            $("#smsg").hide("slow");
                            $("#emsgbody").html(data);
                            $("#emsg").show("slow");
                        }
                    });
            });

        });

        $(document).on('click', '#selectAllCheckbox', function () {
            $('.selectOne').prop('checked', this.checked);
        });

        $(document).on('change', '#student_dropdown', function () {
            changeStudentDropdown();
        });

        function changeStudentDropdown() {
            $.post(base_url + 'fines/app_assign_fine/getFinesForStudent/',
                { student_id : $("#student_dropdown").val()},
                function (data, status){
                    if(data) {
                        let returnedResult = JSON.parse(data);
                        setTableHeadForFinesTable();
                        setFinesTable(returnedResult['fines'], returnedResult['selectedFines']);
                        $("#btn_submit").show();
                    } else {
                        $("#table_head").html('');
                        $("#table_body").html('');
                        $("#btn_submit").hide();
                    }
                });
        }

        function setFinesTable(fines, selectedFines) {
            let tableBody = '';
            $.each(fines, function(i) {
                tableBody += '<tr>';
                if (selectedFines.includes(fines[i].id)) {
                    tableBody += '<td><input type="checkbox" id="selectOne[' + fines[i].id + ']" class="selectOne" name="fine_ids[' + fines[i].id + ']" checked="checked"/></td>';
                } else {
                    tableBody += '<td><input type="checkbox" id="selectOne[' + fines[i].id + ']" class="selectOne" name="fine_ids[' + fines[i].id + ']" /></td>';
                }
                tableBody += '<td>' + fines[i].name + '</td>';
                tableBody += '<td>' + fines[i].type + '</td>';
                tableBody += '<td>' + fines[i].amount + '</td>';
                tableBody += '</tr>';
            });
            $("#table_body").html(tableBody);
            let createButton = '<a data-toggle="modal" href="#modal_add_item" class="btn btn-success mb-md" id="create_btn"><i class="fal fa-plus"></i> I don\'t have a fine</a>';
            if ($("#create_btn").length == 0) {
                $("#fine_table").append(createButton);
            }
        }

        $(document).on('change', '#fine_dropdown', function () {
            $.post(base_url + 'fines/app_assign_fine/getStudentsForFine/',
                $('#assign_fine_to_student_master_form, #assign_fine_to_student_form').serialize(),
                function (data, status){
                    if(data) {
                        let returnedResult = JSON.parse(data);
                        if (returnedResult['fine_id'] != 0) {
                            setTableHeadForStudentsTable();
                            setStudentsTable(returnedResult['students'], returnedResult['selectedStudents']);
                            $("#btn_submit").show();
                        } else {
                            $("#table_head").html('');
                            $("#table_body").html('');
                            $("#btn_submit").hide();
                        }
                    }
                });
        });

        function setStudentsTable(students, selectedStudents) {
            let tableBody = '';
            $.each(students, function(i) {
                tableBody += '<tr>';
                if (selectedStudents.includes(students[i].id)) {
                    tableBody += '<td><input type="checkbox" id="selectOne[' + students[i].id + ']" class="selectOne" name="student_ids[' + students[i].id + ']" checked="checked"/></td>';
                } else {
                    tableBody += '<td><input type="checkbox" id="selectOne[' + students[i].id + ']" class="selectOne" name="student_ids[' + students[i].id + ']"/></td>';
                }
                tableBody += '<td>' + students[i].name + '</td>';
                tableBody += '</tr>';
            });
            $("#table_body").html(tableBody);
        }

        function setTableHeadForStudentsTable() {
            let tableHead = '';
            tableHead += '<tr class="heading" >';
            tableHead += '<th><input type="checkbox" id="selectAllCheckbox"/></th>';
            tableHead += '<th>Student Name</th>';
            tableHead += '</tr>';
            $("#table_head").html(tableHead);
        }

        function setTableHeadForFinesTable() {
            let tableHead = '';
            tableHead += '<tr class="heading" >';
            tableHead += '<th><input type="checkbox" id="selectAllCheckbox"/></th>';
            tableHead += '<th>Fine Name</th>';
            tableHead += '<th>Type</th>';
            tableHead += '<th>Type</th>';
            tableHead += '</tr>';
            $("#table_head").html(tableHead);
        }

        $("#btn_modal_action").click(function (e) {
            e.preventDefault();
            $('#ibox_form_modal').block({ message:block_msg });
            $.post(base_url + 'fines/app/save/', $( "#fine_form" ).serialize())
                .done(function (data) {
                    if ($.isNumeric(data)) {
                        changeStudentDropdown()
                        $("#modal_add_item").modal('toggle');
                    }
                    else {
                        $('#ibox_form_modal').unblock();
                        var body = $("html, body");
                        body.animate({ scrollTop:0 }, '1000', 'swing');
                        $("#emsgbodymodal").html(data);
                        $("#emsgmodal").show("slow");
                    }
                });
        });

        $('.date-picker').nepaliDatePicker({
            dateFormat: '%y-%m-%d',
            closeOnDateSelect: true
        });

    </script>
{/block}