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
                    <h2>Class List</h2>
                    <div class="panel-toolbar">
                        <div class="btn-group">
                            <a href="{$_url}classes/app/add/" class="btn btn-sm btn-success"> Add Class</a>
                        </div>
                    </div>
                </div>
                <div class="panel-container show">
                    <div class="panel-content">
                        <div class="table-responsive" id="ib_data_panel">
                            <table class="table table-striped w-100"  id="clx_datatable">
                                <thead style="background: #f0f2ff">
                                <tr class="heading">
                                    <th>{$_L['Name']}</th>
                                    <th>{$_L['Code']}</th>
                                    <th class="text-right" style="width: 80px;">{$_L['Manage']}</th>
                                </tr>
                                </thead>
                                <tbody>
                                {foreach $classes as $class}
                                    <tr>
                                        <td class="text-info h6">
                                            {$class->name}
                                        </td>
                                        <td class="h6">
                                            {$class->code}
                                        </td>
                                        <td>
                                            <div class="btn-group float-right">
                                                <a href="{$_url}classes/app/view/{$class->id}" class="btn btn-primary btn-icon waves-effect waves-themed has-tooltip" data-title="{$_L['View']}" data-placement="top"><i class="fal fa-user-alt"></i> </a>
                                                <a href="{$_url}classes/app/edit/{$class->id}" class="btn btn-info btn-icon waves-effect waves-themed has-tooltip" data-title="{$_L['Edit']}" data-placement="top"><i class="fal fa-pencil"></i> </a>
                                                <a href="#" onclick="confirmThenGoToUrl(event,'classes/app/delete/{$class->id}')"  class="btn btn-danger btn-icon waves-effect waves-themed has-tooltip" data-title="{$_L['Delete']}" data-placement="top"><i class="fal fa-trash-alt"></i> </a>
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