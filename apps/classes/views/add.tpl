{extends file="$layouts_admin"}

{block name="content"}
    <div class="panel">
        <div class="panel-container">

            <div class="panel-content">

                <h3>Add Class</h3>

                <hr>

                <form id="main_form" method="post" action="{$_url}classes/app/save">

                    <div class="form-group">
                        <label for="address"><span class="h6">Name</span></label>

                        <input type="text" id="name" name="name" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="address"><span class="h6">Code</span></label>

                        <input type="text" id="code" name="code" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btn_submit">Add</button>

                    </div>


                </form>


            </div>
        </div>


    </div>
{/block}