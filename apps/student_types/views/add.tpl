{extends file="$layouts_admin"}

{block name="content"}
    <div class="panel">
        <div class="panel-container">

            <div class="panel-content">

                <h3>Add Student Type</h3>

                <hr>

                <form id="main_form" method="post" action="{$_url}student_types/app/save">

                    <div class="form-group">
                        <label for="name"><span class="h6">Name</span></label>

                        <input type="text" id="name" name="name" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="code"><span class="h6">Remarks</span></label>

                        <input type="text" id="remarks" name="remarks" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btn_submit">Add</button>

                    </div>


                </form>


            </div>
        </div>


    </div>
{/block}