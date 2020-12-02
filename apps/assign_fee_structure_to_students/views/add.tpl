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
                    <h2><span></span>Assign Fee to Student</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg">
                            <span id="emsgbody"></span>
                        </div>

                        <form id="assign_fee_to_student_master_form">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <div class="form-group row">
                                        <div class="col-sm-4">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="radio">
                                                <label><input type="radio" name="assign_radio_button" value="multiple_students" checked> Multiple students one fee</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="assign_radio_button" value="multiple_fees"> Multiple fees one student</label>
                                            </div>
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

                                    <div class="form-group row" id="sub_category_section">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Sub Category</span></label>
                                        <div class="col-sm-8">
                                            <select id="sub_category_id" name="sub_category_id" class="custom-select">
                                                <option value="0">--</option>
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
        <div class="col-md-7" id="student_fee_section">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Assign Fee to Student</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg_fee_rate_info">
                            <span id="emsgbody_fee_rate_info"></span>
                        </div>

                        <form id="assign_fee_to_student_form">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <div class="panel-content">
                                        <div id="student_and_fee_dropdown">
                                        </div>
                                        <hr/>
                                        <div class="table-responsive" id="ib_data_panel">

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




{/block}

{block name="script"}
    <script>
        $(document).ready(function () {

            const class_id = $("#class_id");
            const student_type_id = $("#student_type_id");
            const faculty_id = $("#faculty_id");
            const category_id = $("#category_id");
            const sub_category_id = $("#sub_category_id");
            let is_class_chosen = false;
            let is_student_type_chosen = false;
            let is_faculty_populated = false;
            let is_faculty_chosen = false;
            let is_category_chosen = false;
            const btn_assign = $("#btn_assign");
            const student_fee_section = $("#student_fee_section");
            const faculty_section = $("#faculty_section");
            const sub_category_section = $("#sub_category_section");
            const student_and_fee_dropdown = $("#student_and_fee_dropdown");

            student_fee_section.hide();
            faculty_section.hide();
            sub_category_section.hide();
            $(".progress").hide();
            $("#emsg").hide();
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
                student_fee_section.hide();
                $("#fee_rate_info_form").trigger("reset");
                if (is_class_chosen && is_student_type_chosen) {
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
                $.post(base_url + 'assign_fee_structure_to_students/app/getFacultyForClass/',
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
                $.post(base_url + 'assign_fee_structure_to_students/app/getSubCategoriesForCategory/',
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
                student_fee_section.hide();
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
                $.post(base_url + 'assign_fee_structure_to_students/app/getStudentAndFee/',
                    postValue,
                    function (data, status){
                        if(data) {
                            let returnedResult = JSON.parse(data);
                            if (returnedResult['fee_names'] && returnedResult['fee_names'].length > 0 && returnedResult['students'] && returnedResult['students'].length > 0) {
                                if (assign_radio_button_value === 'multiple_students') {
                                    populateMultipleStudentsTable(returnedResult);
                                } else if (assign_radio_button_value === 'multiple_fees') {
                                    populateMultipleFeesTable(returnedResult);
                                }
                                student_fee_section.show();
                            }
                        }
                    });

            });

            function populateMultipleStudentsTable(returnedResult) {
                setFeesDropdown(returnedResult['fee_names']);
            }

            function setFeesDropdown(fees) {
                let opts = '<option value="0">--</option>';
                $.each(fees, function(i) {
                    opts += "<option value='" + fees[i].id + "' >" + fees[i].name + "</option>";
                });
                student_and_fee_dropdown.html('<div class="form-group row"><label for="remarks" class="col-sm-4"><span class="h6">Fee Names</span></label><div class="col-sm-8"><select class="custom-select" name="fee_id" id="fee_dropdown">' + opts + '</select> </div></div>');
            }

            function populateMultipleFeesTable(returnedResult) {
                setStudentsDropdown(returnedResult['students']);
            }

            function setStudentsDropdown(students) {
                let opts = '<option value="0">--</option>';
                $.each(students, function(i) {
                    opts += "<option value='" + students[i].id + "' >" + students[i].name + "</option>";
                });
                student_and_fee_dropdown.html('<div class="form-group row"><label for="remarks" class="col-sm-4"><span class="h6">Students</span></label><div class="col-sm-8"><select class="custom-select" name="student_id" id="student_dropdown">' + opts + '</select> </div></div>');
            }

            $("#btn_submit").click(function (e) {
                e.preventDefault();
                $('#ibox_form').block({ message:block_msg });
                $.post(base_url + 'assign_fee_structure_to_students/app/save/', $('#assign_fee_to_student_master_form, #assign_fee_to_student_form').serialize())
                    .done(function (data) {
                        if ($.isNumeric(data)) {
                            window.location = base_url + 'assign_fee_structure_to_students/app/add';
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

        $(document).on('click', '#selectAllCheckbox', function () {
            $('.selectOne').prop('checked', this.checked);
        });

        $(document).on('change', '#student_dropdown', function () {

            $.post(base_url + 'assign_fee_structure_to_students/app/getFeesForStudent/',
                { student_id : $("#student_dropdown").val()},
                function (data, status){
                    if(data) {
                        let returnedResult = JSON.parse(data);
                        setTableHeadForFeesTable();
                        setFeesTable(returnedResult['fees'], returnedResult['selectedFees']);
                    }
                });
        });

        function setFeesTable(fees, selectedFees) {
            let tableBody = '';
            $.each(fees, function(i) {
                tableBody += '<tr>';
                if (fees[i].is_compulsary) {
                    tableBody += '<td><input type="checkbox" id="selectOne[' + fees[i].id + ']" class="compulsary_fee" name="fee_ids[' + fees[i].id + ']" checked="checked" onclick="return false;"/></td>';
                } else if (selectedFees.includes(fees[i].id)) {
                    tableBody += '<td><input type="checkbox" id="selectOne[' + fees[i].id + ']" class="selectOne" name="fee_ids[' + fees[i].id + ']" checked="checked"/></td>';
                } else {
                    tableBody += '<td><input type="checkbox" id="selectOne[' + fees[i].id + ']" class="selectOne" name="fee_ids[' + fees[i].id + ']" /></td>';
                }
                tableBody += '<td>' + fees[i].name + '</td>';
                tableBody += '<td>' + fees[i].code + '</td>';
                tableBody += '</tr>';
            });
            $("#table_body").html(tableBody);
        }

        $(document).on('change', '#fee_dropdown', function () {
            let assign_fee_to_student_master_form = $('#assign_fee_to_student_master_form').serialize();
            $.post(base_url + 'assign_fee_structure_to_students/app/getStudentsForFee/',
                $('#assign_fee_to_student_master_form, #assign_fee_to_student_form').serialize(),
                function (data, status){
                    if(data) {
                        let returnedResult = JSON.parse(data);
                        console.log(returnedResult);
                        if (returnedResult['fee_id'] != 0) {
                            setTableHeadForStudentsTable();
                            setStudentsTable(returnedResult['students'], returnedResult['selectedStudents']);
                        } else {
                            $("#table_head").html('');
                            $("#table_body").html('');
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

        function setTableHeadForFeesTable() {
            let tableHead = '';
            tableHead += '<tr class="heading" >';
            tableHead += '<th><input type="checkbox" id="selectAllCheckbox"/></th>';
            tableHead += '<th>Fee Name</th>';
            tableHead += '<th>Fee Code</th>';
            tableHead += '</tr>';
            $("#table_head").html(tableHead);
        }

    </script>
{/block}