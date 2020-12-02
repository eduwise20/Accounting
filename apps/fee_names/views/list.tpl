{extends file="$layouts_admin"}
{block name="head"}

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" />
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #F7F9FC;

        }
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
        .text-warning{
            color: #FB6340!important;
        }
        .text-primary{
            color: #10CDEF!important;
        }
    </style>
{/block}


{block name="content"}
    <div class="row">

        <div class="col-md-12">
            <div class="panel">

                <div class="panel-hdr">
                    <h2>List Fee Names</h2>
                    <div class="panel-toolbar">
                        <div class="btn-group">
                            <a href="{$_url}fee_names/app/add/" class="btn btn-sm btn-success">Add Fee Name</a>
                        </div>
                    </div>
                </div>

                <div class="panel-container show">

                    <div class="panel-content">
                        <div class="table-responsive" id="ib_data_panel">

                            <table class="table table-striped w-100"  id="clx_datatable">
                                <thead style="background: #f0f2ff">
                                <tr class="heading">
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Fee Group</th>
                                    <th>Fine Applicable</th>
                                    <th>Discount Applicable</th>
                                    <th>Scholarship Applicable</th>
                                    <th>Transportation</th>
                                    <th>Compulsary</th>
                                    <th>Active</th>
                                    <th class="text-right" style="width: 80px;">{$_L['Manage']}</th>
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
                                            {$fee_name->fee_group}
                                        </td>
                                        <td>
                                            {if $fee_name->is_fine_applicable eq 1}True{else}False{/if}
                                        </td>
                                        <td>
                                            {if $fee_name->is_discount_applicable eq 1}True{else}False{/if}
                                        </td>
                                        <td>
                                            {if $fee_name->is_scholarship_applicable eq 1}True{else}False{/if}
                                        </td>
                                        <td>
                                            {if $fee_name->is_transportation eq 1}True{else}False{/if}
                                        </td>
                                        <td>
                                            {if $fee_name->is_compulsary eq 1}True{else}False{/if}
                                        </td>
                                        <td>
                                            {if $fee_name->is_active eq 1}True{else}False{/if}
                                        </td>
                                        <td>
                                            <div class="btn-group float-right">
                                                <a href="{$_url}fee_names/app/edit/{$fee_name->id}" class="btn btn-info btn-icon waves-effect waves-themed has-tooltip" data-title="{$_L['Edit']}" data-placement="top"><i class="fal fa-pencil"></i> </a>
                                                <a href="#" onclick="confirmThenGoToUrl(event,'fee_names/app/delete/{$fee_name->id}')"  class="btn btn-danger btn-icon waves-effect waves-themed has-tooltip" data-title="{$_L['Delete']}" data-placement="top"><i class="fal fa-trash-alt"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                {/foreach}
                                </tbody>


                            </table>
                        </div>
                    </div>


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
