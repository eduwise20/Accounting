{extends file="$layouts_admin"}

{block name="content"}
    <div class="panel">
        <div class="panel-container">

            <div class="panel-content">

                <h3>Edit {$faculty->name}</h3>

                <hr>

                <form id="main_form" method="post" action="{$_url}faculties/app/save">

                    <div class="form-group">
                        <label for="name"><span class="h6">Name</span></label>

                        <input type="text" id="name" name="name" class="form-control" value="{$faculty->name}"/>
                    </div>

                    <div class="form-group">
                        <label for="code"><span class="h6">Code</span></label>

                        <input type="text" id="code" name="code" class="form-control" value="{$faculty->code}"/>
                    </div>

                    <input type="hidden" name="id" value="{$faculty->id}">


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btn_submit">Edit</button>

                    </div>


                </form>


            </div>
        </div>


    </div>
{/block}