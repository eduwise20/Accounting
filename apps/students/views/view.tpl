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
                    <h1><span></span>{$student->name}</h1>
                </div>

                <div class="panel-container show" id="ibox_form">

                    <div class="panel-content">

                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-3"><span class="h6">Full Name</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->name}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="admission_no" class="col-sm-3"><span class="h6">Admission Number</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->admission_no}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="roll_no" class="col-sm-3"><span class="h6">Roll Number</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->roll_no}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="class_id" class="col-sm-3"><span class="h6">Class</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->class}</span></p>
                                    </div>
                                </div>

                                {if $student->section}
                                <div class="form-group row">
                                    <label for="section_id" class="col-sm-3"><span class="h6">Section</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->section}</span></p>
                                    </div>
                                </div>
                                {/if}

                                {if $student->category}
                                <div class="form-group row">
                                    <label for="category_id" class="col-sm-3"><span class="h6">Category</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->category}</span></p>
                                    </div>
                                </div>
                                {/if}

                                {if $student->sub_category}
                                <div class="form-group row" id="sub_category_section">
                                    <label for="sub_category_id" class="col-sm-3"><span class="h6">Sub Category</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->sub_category}</span></p>
                                    </div>
                                </div>
                                {/if}

                                <div class="form-group row">
                                    <label for="student_type_id" class="col-sm-3"><span class="h6">Student Type</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->student_type}</span></p>
                                    </div>
                                </div>

                                {if $student->faculty}
                                <div class="form-group row" id="faculty_section">
                                    <label for="faculty_id" class="col-sm-3"><span class="h6">Faculty</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->faculty}</span></p>
                                    </div>
                                </div>
                                {/if}

                                <div class="form-group row">
                                    <label for="status" class="col-sm-3"><span class="h6">Status</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$status[$student->status]}</span></p>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6 col-sm-12">

                                <div class="form-group row">
                                    <label for="phone" class="col-sm-3"><span class="h6">Phone</span> </label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student_additional_information->phone}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="current_address" class="col-sm-3"><span class="h6">Current Address</span> </label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student_additional_information->current_address}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="permanent_address" class="col-sm-3"><span class="h6">Permanent Address</span> </label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student_additional_information->permanent_address}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="parent_name" class="col-sm-3"><span class="h6">Parent Name</span> </label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student_additional_information->parent_name}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="local_guardian_name" class="col-sm-3"><span class="h6">Local Guardian Name</span> </label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student_additional_information->local_guardian_name}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="gender" class="col-sm-3"><span class="h6">Gender</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student_additional_information->gender}</span></p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="remarks" class="col-sm-3"><span class="h6">Remarks</span></label>
                                    <div class="col-sm-9">
                                        <p><span class="h5">{$student->remarks}</span></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{/block}
