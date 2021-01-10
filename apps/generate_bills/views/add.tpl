{extends file="$layouts_admin"}
{block name="head"}

    <style>
        .h2,
        h2 {
            font-size: 1.25rem;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: inherit;
            font-weight: 600;
            line-height: 1.5;
            margin-bottom: .5rem;
            color: #32325d;
        }

        .text-info {
            color: #6772E5 !important;
        }

        .text-success {
            color: #2CCE89 !important;
        }

        .text-danger {
            color: #F6365B !important;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #F7F9FC;

        }

        .h2,
        h2 {
            font-size: 1.25rem;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: inherit;
            font-weight: 600;
            line-height: 1.5;
            margin-bottom: .5rem;
            color: #32325d;
        }


        .text-info {
            color: #6772E5 !important;
        }

        .text-success {
            color: #2CCE89 !important;
        }

        .text-danger {
            color: #F6365B !important;
        }

        .text-warning {
            color: #FB6340 !important;
        }

        .text-primary {
            color: #10CDEF !important;
        }
    </style>


{/block}

{block name="content"}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Billing</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg">
                            <span id="emsgbody"></span>
                        </div>

                        <form id="billing_master_form">

                            <div class="row">
                                <div class="col-md-6 col-sm-6">

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Fiscal Year</span><span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="hidden" id="fiscal_year_id" name="fiscal_year_id"
                                                value="{$fiscal_year->id}" />
                                            <p>{$fiscal_year->name}</p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Class</span><span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="class_id" name="class_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $classes as $class}
                                                    <option value="{$class->id}">{$class->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Section</span></label>
                                        <div class="col-sm-8">
                                            <select id="section_id" name="section_id" class="custom-select">
                                                <option value="0">--</option>
                                                {foreach $sections as $section}
                                                    <option value="{$section->id}">{$section->name}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row" id="faculty_section">
                                        <label for="remarks" class="col-sm-4"><span class="h6">Faculty</span><span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select id="faculty_id" name="faculty_id" class="custom-select">
                                                <option value="0">--</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-6">

                                    <div class="form-group row">
                                        <label for="billing_period" class="col-sm-4"><span class="h6">Billing
                                                Period</span><span class="text-danger">*</span></label>
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
                                        <label for="remarks" class="col-sm-4"><span class="h6">Student Type</span></label>
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
                                        <button class="btn btn-primary mt-3 mr-3 disabled" type="button"
                                            id="btn_generate">Generate Bill</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" id="student_billing_section">
            <div class="panel panel-default">
                <div class="panel-hdr">
                    <h2><span></span>Student Billing</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg_fee_rate_info">
                            <span id="emsgbody_fee_rate_info"></span>
                        </div>

                        <form id="student_billing_form">

                            <div class="row">
                                <div class="col-md-12 col-sm-12">

                                    <div class="panel-content">
                                        <div class="table-responsive" id="ib_data_panel">

                                            <table class="table table-striped w-100" id="clx_datatable">
                                                <thead style="background: #f0f2ff" id="student_billing_table_head">
                                                </thead>
                                                <tbody id="student_billing_table_body">
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn btn-primary mt-3 mr-3" type="button"
                                            id="btn_submit">Save</button>
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
                    <h5 class="modal-title">Update Total Fee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="ibox_form_modal">
                    <div class="alert alert-danger" id="emsgmodal">
                        <span id="emsgbodymodal"></span>
                    </div>
                    <form id="fee_change_form">

                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-5"><span class="h6">Current Fee</span><span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <p id="current_fee_id"></p>
                                        <input type="hidden" id="current_fee_id_input" name="old_fee" />
                                    </div>
                                </div>
                                <input type="hidden" id="student_id" name="student_id" />
                                <div class="form-group row">
                                    <label for="order" class="col-sm-5"><span class="h6">New Fee</span><span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" id="new_fee" name="new_fee" class="form-control">
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

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>


    <script>
        $(function() {

            $('#clx_datatable').dataTable({
                responsive: true,
                lengthChange: false,
                dom:
                    /*	--- Layout Structure
                    --- Options
                    l	-	length changing input control
                    f	-	filtering input
                    t	-	The table!
                    i	-	Table information summary
                    p	-	pagination control
                    r	-	processing display element
                    B	-	buttons
                    R	-	ColReorder
                    S	-	Select

                    --- Markup
                    < and >				- div element
                    <"class" and >		- div with a class
                    <"#id" and >		- div with an ID
                    <"#id.class" and >	- div with an ID and a class

                    --- Further reading
                    https://datatables.net/reference/option/dom
                    --------------------------------------
                 */
                    "<'row mb-3'<'col-sm-12 col-md-6 d-flex align-items-center justify-content-start'f><'col-sm-12 col-md-6 d-flex align-items-center justify-content-end'lB>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                buttons: [
                    /*{
                	extend:    'colvis',
                	text:      'Column Visibility',
                	titleAttr: 'Col visibility',
                	className: 'mr-sm-3'
                },*/
                    {
                        extend: 'pdfHtml5',
                        text: 'PDF',
                        titleAttr: 'Generate PDF',
                        className: 'btn-danger btn-sm mr-1'
                    },
                    {
                        extend: 'excelHtml5',
                        text: 'Excel',
                        titleAttr: 'Generate Excel',
                        className: 'btn-success btn-sm mr-1'
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'CSV',
                        titleAttr: 'Generate CSV',
                        className: 'btn-primary btn-sm mr-1'
                    },
                    {
                        extend: 'copyHtml5',
                        text: 'Copy',
                        titleAttr: 'Copy to clipboard',
                        className: 'btn-dark btn-sm mr-1'
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        titleAttr: 'Print Table',
                        className: 'btn-secondary btn-sm'
                    }
                ]
            });

            $('.has-tooltip').tooltip();
        });

        $(document).ready(function() {

            const fiscal_year_id = $("#fiscal_year_id");
            const class_id = $("#class_id");
            const billing_period_id = $("#billing_period_id");
            const student_type_id = $("#student_type_id");
            const faculty_id = $("#faculty_id");
            const category_id = $("#category_id");
            const sub_category_id = $("#sub_category_id");
            const section_id = $("#section_id");
            let is_class_chosen = false;
            let is_billing_period_chosen = false;
            let is_faculty_populated = false;
            let is_faculty_chosen = false;
            let is_category_chosen = false;
            const btn_generate = $("#btn_generate");
            const student_billing_section = $("#student_billing_section");
            const faculty_section = $("#faculty_section");
            const sub_category_section = $("#sub_category_section");

            student_billing_section.hide();
            faculty_section.hide();
            sub_category_section.hide();
            $(".progress").hide();
            $("#emsg").hide();
            $("#emsgmodal").hide();
            $("#emsg_fee_rate_info").hide();
            btn_generate.prop("disabled", true);
            var _url = '{$_url}';

            class_id.change(function() {
                is_class_chosen = class_id[0].value != 0;
                if (is_class_chosen) {
                    getFacultyForClass(class_id[0].value);
                }
                checkToRemoveDisabled();
            });

            student_type_id.change(function() {
                if (student_type_id[0].value != 0) {
                    enableGenerateButton();
                    checkToRemoveDisabled();
                }
            });

            section_id.change(function() {
                if (section_id[0].value != 0) {
                    enableGenerateButton();
                    checkToRemoveDisabled();
                }
            });

            faculty_id.change(function() {
                is_faculty_chosen = faculty_id[0].value != 0;
                checkToRemoveDisabled();
            });

            billing_period_id.change(function() {
                is_billing_period_chosen = billing_period_id[0].value != 0;
                checkToRemoveDisabled();
            });

            category_id.change(function() {
                is_category_chosen = category_id[0].value != 0;
                if (is_category_chosen) {
                    getSubCategoriesForCategory(category_id[0].value);
                    enableGenerateButton();
                } else {
                    sub_category_id.html('<option value="0">--</option>');
                    sub_category_section.hide();
                }
                checkToRemoveDisabled();
            });

            sub_category_id.change(function() {
                if (sub_category_id[0].value != 0) {
                    enableGenerateButton();
                    checkToRemoveDisabled();
                }
            });

            function checkToRemoveDisabled() {
                student_billing_section.hide();
                $("#fee_rate_info_form").trigger("reset");
                if (is_class_chosen && is_billing_period_chosen) {
                    if (is_faculty_populated) {
                        if (is_faculty_chosen) {
                            enableGenerateButton();
                        } else {
                            disableGenerateButton();
                        }
                    } else {
                        enableGenerateButton();
                    }
                } else {
                    disableGenerateButton();
                }
            }

            function enableGenerateButton() {
                btn_generate.removeClass("disabled");
                btn_generate.prop("disabled", false);
            }

            function disableGenerateButton() {
                btn_generate.addClass("disabled");
                btn_generate.prop("disabled", true);
            }

            function getFacultyForClass(class_id) {
                $.post(base_url + 'generate_bills/app/getFacultyForClass/', { class_id: class_id },
                    function(data, status) {
                        let faculties = JSON.parse(data);
                        if (faculties.length > 0) {
                            populateFacultySelectList(faculties);
                            is_faculty_populated = true;
                            faculty_section.show();
                        } else {
                            faculty_id.html('<option value="0">--</option>');
                            is_faculty_populated = false;
                            faculty_section.hide();
                        }
                        checkToRemoveDisabled();
                    });
            }

            function getSubCategoriesForCategory(category_id) {
                $.post(base_url + 'generate_bills/app/getSubCategoriesForCategory/', { category_id: category_id },
                    function(data, status) {
                        let sub_categories = JSON.parse(data);
                        if (sub_categories.length > 0) {
                            populateSubCategoryList(sub_categories);
                            sub_category_section.show();
                        } else {
                            sub_category_id.html('<option value="0">--</option>');
                            sub_category_section.hide();
                        }
                        checkToRemoveDisabled();
                    });
            }

            function populateFacultySelectList(faculties) {
                faculty_id.html('<option value="0">--</option>');
                faculties.forEach(function(faculty) {
                    faculty_id.append('<option value="' + faculty['id'] + '">' + faculty['name'] +
                        '</option>');
                });
            }

            function populateSubCategoryList(sub_categories) {
                sub_category_id.html('<option value="0">--</option>');
                sub_categories.forEach(function(sub_category) {
                    sub_category_id.append('<option value="' + sub_category['id'] + '">' + sub_category[
                        'name'] + '</option>');
                });
            }

            $('#tags').select2({
                tags: true,
                tokenSeparators: [','],
                theme: "bootstrap"
            });

            var $cid = $('#cid');

            $cid.select2();

            btn_generate.click(function(e) {
                disableGenerateButton();
                e.preventDefault();
                $.post(base_url + 'generate_bills/app/get_students_with_bill_detail/',
                    $("#billing_master_form").serialize(),
                    function(data, status) {
                        if (data) {
                            console.log(data);
                            let jsonData = JSON.parse(data);
                            students = jsonData['students'];
                            students.forEach(function(student) {
                                console.log(student);
                                console.log('Student Name : ' + student['name']);
                            });
                            fines = jsonData['fines'];
                            fines.forEach(function(fine) {
                                console.log(fine);
                            });
                            fees = jsonData['fees'];
                            fees.forEach(function(fee) {
                                console.log(fee);
                            });
                            /*let students = JSON.parse(data);
                        if (students.length > 0) {
                            let tableBody = populateStudents(students);
                            student_billing_section.show();
                            var table = $("#clx_datatable").DataTable();
                            table.rows.add($(tableBody)).draw();
                            $('#ibox_form').unblock();
                            var body = $("html, body");
                            body.animate({ scrollTop: 0 }, '1000', 'swing');
                            $("#emsgbody").html("");
                            $("#emsg").hide("slow");
                        } else {
                            $('#ibox_form').unblock();
                            var body = $("html, body");
                            body.animate({ scrollTop: 0 }, '1000', 'swing');
                            $("#emsgbody").html('No student found!');
                            $("#emsg").show("slow");
                        }*/
                        }
                    });

            });

            /*function populateTableHead(students) {
            let tableHead = '';
            <tr class="heading">
                                                    <th>Student Name</th>
                                                    <th>Fees</th>
                                                    <th>Fines</th>
                                                    <th>Discounts</th>
                                                    <th>Scholarships</th>
                                                    <th>Total Fees</th>
                                                    <th>Action</th>
                                                </tr>
        }*/

            function populateStudents(students) {
                let tableBody = '';
                let count = 0;
                students.forEach(function(student) {
                    let student_fee_ids = student['fee_ids'].length > 0 ? student['fee_ids'] : 0;
                    let student_fine_ids = student['fine_ids'].length > 0 ? student['fine_ids'] : 0;
                    let student_discount_ids = student['discount_ids'].length > 0 ? student[
                        'discount_ids'] : 0;
                    let student_scholarship_ids = student['scholarship_ids'].length > 0 ? student[
                        'scholarship_ids'] : 0;
                    tableBody += '<tr>';
                    tableBody += '<td>' + student['name'] + '</td><input type="hidden" name="student_id[' +
                        count + ']" value="' + student['id'] + '"/>';
                    tableBody += '<td>' + student['fee'] + '</td><input type="hidden" name="student_fee[' +
                        student['id'] + ']" value="' + student['fee'] +
                        '"/><input type="hidden" id="student_fee_id" name="student_fee_id[' + student[
                            'id'] + ']" value="' + student_fee_ids + '"/>';
                    tableBody += '<td>' + student['fine'] +
                        '</td><input type="hidden" name="student_fine[' + student['id'] + ']" value="' +
                        student['fine'] +
                        '"/><input type="hidden" id="student_fine_id" name="student_fine_id[' + student[
                            'id'] + ']" value="' + student_fine_ids + '"/>';
                    tableBody += '<td>' + student['discount'] +
                        '</td><input type="hidden" name="student_discount[' + student['id'] + ']" value="' +
                        student['discount'] +
                        '"/><input type="hidden" id="student_discount_id" name="student_discount_id[' +
                        student['id'] + ']" value="' + student_discount_ids + '"/>';
                    tableBody += '<td>' + student['scholarship'] +
                        '</td><input type="hidden" name="student_scholarship[' + student['id'] +
                        ']" value="' + student['scholarship'] +
                        '"/><input type="hidden" id="student_scholarship_id" name="student_scholarship_id[' +
                        student['id'] + ']" value="' + student_scholarship_ids + '"/>';
                    tableBody += '<td class="item_total_fee">' + student['total_fee'] +
                        '</td><input type="hidden" id="hidden_total_fee" name="student_total_fee[' +
                        student['id'] + ']" value="' + student['total_fee'] + '"/>';
                    tableBody += '<td>' +
                        '<a data-toggle="modal" href="#modal_add_item" class="btn btn-success mb-md" id="edit_button" onclick="fill_modal(' +
                        student["id"] + ');">Edit</a>' + '</td>';
                    tableBody += '</tr>';
                    count++;
                });
                return tableBody;
            }

        });

        let total_fee;
        let total_fee_hidden;

        function fill_modal(student_id) {
            $(document).on('click', '#edit_button', function() {
                total_fee = $(this).closest('tr').find('.item_total_fee');
                total_fee_hidden = $(this).closest('tr').find('#hidden_total_fee');
                let total_fee_text = total_fee.text();
                $("#current_fee_id").html(total_fee_text);
                $("#current_fee_id_input").val(total_fee_text);
                $("#student_id").val(student_id);
                $("#new_fee").val('');
            });
        }

        $("#btn_modal_action").click(function(e) {
            e.preventDefault();
            let new_fee = $("#new_fee")[0].value;
            total_fee.html(new_fee);
            total_fee_hidden.val(new_fee);
            $.post(base_url + 'generate_bills/app/updateTotalFee/', $('#billing_master_form, #fee_change_form')
                    .serialize())
                .done(function(data) {
                    $("#modal_add_item").modal('toggle');
                });
        });

        $("#btn_submit").click(function(e) {
            e.preventDefault();
            $('#ibox_form').block({ message: block_msg });
            $.post(base_url + 'generate_bills/app/save/', $('#billing_master_form, #student_billing_form')
                    .serialize())
                .done(function(data) {
                    if ($.isNumeric(data)) {
                        window.location = base_url + 'generate_bills/app/generate_bills';
                    } else {
                        $('#ibox_form').unblock();
                        var body = $("html, body");
                        body.animate({ scrollTop: 0 }, '1000', 'swing');
                        $("#emsgbody").html(data);
                        $("#emsg").show("slow");
                    }
                });
        });
    </script>
{/block}