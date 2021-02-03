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
                    <h2><span></span>Fee Rate Master</h2>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="alert alert-danger" id="emsg">
                            <span id="emsgbody"></span>
                        </div>

                        <form id="fee_rate_master_form">

                            <div class="row">
                                <div class="col-md-6 col-sm-6">

                                        <div class="form-group row">
                                            <label for="remarks" class="col-sm-4"><span class="h6">Fiscal Year</span><span class="text-danger">*</span></label>
                                            <div class="col-sm-8">
                                                {if !isset($fiscal_year->id)} 
                                                    <p>No Fiscal Year Selected or Active.</p>
                                                {else}
                                                    <input type="hidden" id="fiscal_year_id" name="fiscal_year_id" value="{$fiscal_year->id}"/>
                                                    <p>{$fiscal_year->name}</p> 
                                                {/if}
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
                                    </div>

                                    <div class="col-md-6 col-sm-6">

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
        <div class="col-md-12" id="fee_rate_info_section">
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
                                                    <th>Class</th>
                                                    <th>Faculty</th>
                                                    <th>Student Type</th>
                                                    <th>Category</th>
                                                    <th>Sub Category</th>
                                                    <th>Fee Name</th>
                                                    <th>Amount</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                {foreach $fee_names as $fee_name}
                                                    <tr>
                                                         <td id="class{$fee_name->id}">
                                                           
                                                        </td>
                                                         <td id="faculty{$fee_name->id}">
                                                           
                                                        </td>
                                                         <td id="studenttype{$fee_name->id}">
                                                           
                                                        </td>
                                                         <td id="category{$fee_name->id}">
                                                           
                                                        </td>
                                                        <td id="subcategory{$fee_name->id}">
                                                           
                                                        </td>

                                                        <td>
                                                            {$fee_name->name}
                                                            {if $fee_name->is_transportation eq 1}
                                                                <br/>
                                                                ({$fee_name->from} - {$fee_name->to})
                                                            {/if}
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
            const category_id = $("#category_id");
            const sub_category_id = $("#sub_category_id");
            let is_class_chosen = false;
            let is_student_type_chosen = false;
            let is_faculty_populated = false;
            let is_faculty_chosen = false;
            let is_category_chosen = false;
            const btn_assign = $("#btn_assign");
            const fee_rate_info_section = $("#fee_rate_info_section");
            const faculty_section = $("#faculty_section");
            const sub_category_section = $("#sub_category_section");

            fee_rate_info_section.hide();
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
                }
                checkToRemoveDisabled();
            });

            function checkToRemoveDisabled() {
                fee_rate_info_section.hide();
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
                $.post(base_url + 'fee_rates/app/getFacultyForClass/',
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
                $.post(base_url + 'fee_rates/app/getSubCategoriesForCategory/',
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

            btn_assign.click(function (e) {
                disableAssignButton();
                e.preventDefault();
                let postValue = {
                    fiscal_year_id : fiscal_year_id[0].value,
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
                $.post(base_url + 'fee_rates/app_fee_rates/getFeeStructuresForFeeRate/',
                    postValue,
                    function (data, status){
                        if(data) {
                            let jsonData = JSON.parse(data);
                            let fee_structures = jsonData['fee_structures'];
                            let filters = jsonData['filterData'];
                            if (fee_structures.length > 0) {
                                populateAmount(fee_structures,filters);
                            }
                        }
                        fee_rate_info_section.show();
                    });

            });

            function populateAmount1(fee_structures,filters) {
                fee_structures.forEach(function(fee_structure) {
                    $('#class'+ fee_structure['fee_names_id']).html(filters['class']);
                    $('#faculty'+ fee_structure['fee_names_id']).html(filters['faculty']);
                    $('#studenttype'+ fee_structure['fee_names_id']).html(filters['student_type']);
                    $('#category'+ fee_structure['fee_names_id']).html(filters['category']);
                    $('#subcategory'+ fee_structure['fee_names_id']).html(filters['sub_category']);
                   
                    $('#amount'+ fee_structure['fee_names_id']).html(fee_structure['amount']);
                        
                });
            }

            function populateAmount(fee_structures,filters) {
               
                fee_structures.forEach(function(fee_structure) {

                    $('#class'+ fee_structure['fee_names_id']).html(filters['class']);
                    $('#faculty'+ fee_structure['fee_names_id']).html(filters['faculty']);
                    $('#studenttype'+ fee_structure['fee_names_id']).html(filters['student_type']);
                    $('#category'+ fee_structure['fee_names_id']).html(filters['category']);
                    $('#subcategory'+ fee_structure['fee_names_id']).html(filters['sub_category']);
                   
                    let amount = $('input[id="amount['+ fee_structure['fee_names_id'] +']"]');
                    if (amount.length > 0) {
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

     <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>


    <script>
        $(function() {

            $('#clx_datatable').dataTable(
                {
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
                }
            );

            $('.has-tooltip').tooltip();
        });
    </script>
{/block}