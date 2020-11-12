{block name="content"}


    <div class="row">



        <div class="col-md-12">



            <div class="panel panel-default">

                <div class="panel-body">

                    <h3>{$class->name}</h3>

                    <hr>

                    <form method="post" action="{$_url}classes/app/save">

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" name="name" id="name" value="{$class->name}">
                        </div>

                        <div class="form-group">
                            <label for="code">Code</label>
                            <input class="form-control" name="code" id="code" value="{$class->code}">
                        </div>

                        {* Include the id as we are editing the notes *}

                        <input type="hidden" name="id" value="{$class->id}">

                        <button class="btn btn-primary" type="submit">Save</button>

                    </form>


                </div>
            </div>
        </div>



    </div>



{/block}