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
            <div class="panel">
                <div class="panel-hdr">
                    <h2><span></span>Add Student</h2>
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
                                        <label for="name" class="col-sm-3"><span class="h6">Full Name</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="name" name="name" class="form-control" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="admission_no" class="col-sm-3"><span class="h6">Admission Number</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="admission_no" name="admission_no" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="roll_no" class="col-sm-3"><span class="h6">Roll Number</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="roll_no" name="roll_no" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="class_id" class="col-sm-3"><span class="h6">Class</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select id="class_id" name="class_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $classes as $class}
                                                    <option value="{$class->id}">{$class->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="section_id" class="col-sm-3"><span class="h6">Section</span></label>
                                        <div class="col-sm-9">
                                            <select id="section_id" name="section_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $sections as $section}
                                                    <option value="{$section->id}">{$section->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="category_id" class="col-sm-3"><span class="h6">Category</span></label>
                                        <div class="col-sm-9">
                                            <select id="category_id" name="category_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $categories as $category}
                                                    <option value="{$category->id}">{$category->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="sub_category_section">
                                        <label for="sub_category_id" class="col-sm-3"><span class="h6">Sub Category</span></label>
                                        <div class="col-sm-9">
                                            <select id="sub_category_id" name="sub_category_id" class="custom-select">
                                                <option value="0">--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="student_type_id" class="col-sm-3"><span class="h6">Student Type</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select id="student_type_id" name="student_type_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $student_types as $student_type}
                                                    <option value="{$student_type->id}">{$student_type->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="faculty_section">
                                        <label for="faculty_id" class="col-sm-3"><span class="h6">Faculty</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select id="faculty_id" name="faculty_id" class="custom-select">
                                                <option value="0">--</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="status" class="col-sm-3"><span class="h6">Status</span><span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select id="status" name="status" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $status as $key => $value}
                                                    <option value="{$key}">{$value}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6 col-sm-12">

                                    <div class="form-group row">
                                        <label for="phone" class="col-sm-3"><span class="h6">Phone</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="phone" name="phone" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="current_address" class="col-sm-3"><span class="h6">Current Address</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="current_address" name="current_address" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="permanent_address" class="col-sm-3"><span class="h6">Permanent Address</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="permanent_address" name="permanent_address" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="parent_name" class="col-sm-3"><span class="h6">Parent Name</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="parent_name" name="parent_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="local_guardian_name" class="col-sm-3"><span class="h6">Local Guardian Name</span> </label>
                                        <div class="col-sm-9">
                                            <input type="text" id="local_guardian_name" name="local_guardian_name" class="form-control">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="col-sm-3"><span class="h6">Gender</span></label>
                                        <div class="col-sm-9">
                                            <div class="radio">
                                                <label><input type="radio" name="gender" value="Male" checked> Male</label>
                                            </div>
                                            <div class="radio">
                                                <label><input type="radio" name="gender" value="Female"> Female</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-3"><span class="h6">Remarks</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" id="remarks" name="remarks" class="form-control" autofocus>
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

            const faculty_section = $("#faculty_section");
            const sub_category_section = $("#sub_category_section");
            const class_id = $("#class_id");
            const category_id = $("#category_id");

            faculty_section.hide();
            sub_category_section.hide();


            $(".progress").hide();
            $("#emsg").hide();
            var _url = '{$_url}';
            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                theme: "bootstrap"
            });

            class_id.change(function(){
                if (class_id[0].value != 0) {
                    getFacultyForClass(class_id[0].value);
                } else {
                    $("#faculty_id").html('<option value="0">--</option>');
                    faculty_section.hide();
                }
            });

            category_id.change(function(){
                if (category_id[0].value != 0) {
                    getSubCategoriesForCategory(category_id[0].value);
                } else {
                    $("#sub_category_id").html('<option value="0">--</option>');
                    sub_category_section.hide();
                }
            });

            function getFacultyForClass(class_id) {
                $.post(base_url + 'students/app/getFacultyForClass/',
                    { class_id : class_id },
                    function (data, status){
                        let faculties = JSON.parse(data);
                        if (faculties.length > 0) {
                            populateFacultySelectList(faculties);
                            faculty_section.show();
                        } else {
                            $("#faculty_id").html('<option value="0">--</option>');
                            faculty_section.hide();
                        }
                    });
            }

            function getSubCategoriesForCategory(category_id) {
                $.post(base_url + 'students/app/getSubCategoriesForCategory/',
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


            $("#submit").click(function (e) {
                e.preventDefault();
                $('#ibox_form').block({ message:block_msg });
                $.post(base_url + 'students/app/save/', $('#rform').serialize())
                    .done(function (data) {
                        if ($.isNumeric(data)) {
                            window.location = base_url + 'students/app/list';
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