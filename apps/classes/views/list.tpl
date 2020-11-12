{block name="content"}

    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">
                <div class="panel-body">

                    <a href="{$_url}classes/app/add" class="btn btn-primary add_event waves-effect waves-light"><i class="fa fa-plus"></i> Add Class</a>

                </div>

            </div>
        </div>



    </div>

    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">



                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th class="bold">Class Name</th>

                                <th class="text-center bold">{$_L['Manage']}</th>
                            </tr>
                            </thead>
                            <tbody>


                            {foreach $classes as $class}
                                <tr>
                                    <td>

                                        <a href="{$_url}classes/app/view/{$class->id}">{$class->name}</a>

                                    </td>

                                    <td class="text-right">
                                        <a href="{$_url}classes/app/edit/{$class->id}" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> </a>
                                        <a href="{$_url}classes/app/delete/{$class->id}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> </a>
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




{/block}