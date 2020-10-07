{extends file="project_base.tpl"}

{block name="project_content"}
    <div class="row mb-3">
        <div class="col">
            <h2>{$_L['Invoices']}</h2>
        </div>

        <div class="col text-right">
            <a href="{$_url}invoices/add/1/0/0/{$project->id}" class="btn btn-primary">{$_L['New Invoice']}</a>
        </div>



    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered table-hover" id="clx_datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{$_L['Account']}</th>
                    <th>{$_L['Amount']}</th>
                    <th>{$_L['Invoice Date']}</th>
                    <th>{$_L['Due Date']}</th>
                    <th>
                        {$_L['Status']}
                    </th>
                    <th>{$_L['Type']}</th>
                    <th class="text-right" width="140px;">{$_L['Manage']}</th>
                </tr>
                </thead>
                <tbody>

                {foreach $invoices as $invoice}
                    <tr>
                        <td  data-value="{$ds['id']}"><a href="{$_url}invoices/view/{$ds['id']}/">{$ds['invoicenum']}{if $ds['cn'] neq ''} {$ds['cn']} {else} {$ds['id']} {/if}</a> </td>
                        <td>

                            {if isset($contacts[$ds['userid']])}
                                <a href="{$_url}invoices/view/{$ds['id']}/">
                                    {$ds['account']} <br>
                                    {$contacts[$ds['userid']]->company}
                                </a>
                            {/if}


                        </td>
                        <td>{formatCurrency($ds['total'],$ds['currency_iso_code'])}</td>
                        <td data-value="{strtotime($ds['date'])}">{date( $config['df'], strtotime($ds['date']))}</td>
                        <td data-value="{strtotime($ds['duedate'])}">{date( $config['df'], strtotime($ds['duedate']))}</td>
                        <td>

                            {if $ds['status'] eq 'Unpaid'}
                                <span class="label label-danger">{ib_lan_get_line($ds['status'])}</span>
                            {elseif $ds['status'] eq 'Paid'}
                                <span class="label label-success">{ib_lan_get_line($ds['status'])}</span>
                            {elseif $ds['status'] eq 'Partially Paid'}
                                <span class="label label-info">{ib_lan_get_line($ds['status'])}</span>
                            {elseif $ds['status'] eq 'Cancelled'}
                                <span class="label">{ib_lan_get_line($ds['status'])}</span>
                            {else}
                                {ib_lan_get_line($ds['status'])}
                            {/if}



                        </td>
                        <td>
                            {if $ds['r'] eq '0'}
                                <span class="label label-default"><i class="fal fa-dot-circle-o"></i> {$_L['Onetime']}</span>
                            {else}
                                <span class="label label-default"><i class="fal fa-repeat"></i> {$_L['Recurring']}</span>
                            {/if}
                        </td>
                        <td class="text-right">

                            <a href="{$_url}invoices/view/{$ds['id']}/" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['View']}"><i class="fal fa-file-text-o"></i></a>
                            <a href="{$_url}invoices/clone/{$ds['id']}/" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Clone']}"><i class="fal fa-files-o"></i></a>


                            <a href="{$_url}invoices/edit/{$ds['id']}/" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Edit']}"><i class="fal fa-pencil"></i></a>

                            {if $ds['r'] neq '0'}

                                <a href="{$_url}invoices/stop_recurring/{$ds['id']}/" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="{$_L['Stop Recurring']}"><i class="fal fa-stop-circle-o"></i></a>

                            {/if}

                            <a href="#" class="btn btn-danger btn-xs cdelete" id="iid{$ds['id']}" data-toggle="tooltip" data-placement="top" title="{$_L['Delete']}"><i class="fal fa-trash"></i></a>


                        </td>
                    </tr>
                {/foreach}

                </tbody>



            </table>
        </div>
    </div>



{/block}

{block name="script"}
    <script>
        $(function () {
            $('#clx_datatable').dataTable(
                {
                    responsive: true,
                    "language": {
                        "emptyTable": "{$_L['No Data Available']}",
                    },
                }
            );
        });
    </script>
{/block}
