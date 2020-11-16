{extends file="$layouts_admin"}

{block name="content"}
    <div class="panel">
        <div class="panel-container">

            <div class="panel-content">

                <h3>Edit {$section->name}</h3>

                <hr>

                <form id="main_form" method="post" action="{$_url}sections/app/save">

                    <div class="form-group">
                        <label for="name"><span class="h6">Name</span></label>

                        <input type="text" id="name" name="name" class="form-control" value="{$section->name}"/>
                    </div>

                    <div class="form-group">
                        <label for="code"><span class="h6">Code</span></label>

                        <input type="text" id="code" name="code" class="form-control" value="{$section->code}"/>
                    </div>

                    <div class="form-group">
                        <label for="class_id"><span class="h6">Class</span> </label>
                        <select id="class_id" name="class_id" class="custom-select">
                            <option>--</option>
                            {foreach $classes as $class}
                                <option value="{$class->id}"
                                        {if $section->class_id === $class->id}
                                        selected {/if}>
                                    {$class->name}
                                </option>
                            {/foreach}
                        </select>
                    </div>

                    <input type="hidden" name="id" value="{$section->id}">


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btn_submit">Edit</button>

                    </div>


                </form>


            </div>
        </div>


    </div>
{/block}