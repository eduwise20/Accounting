{block name="head"}
    <style>
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #F7F9FC;
        }

        .h2, h2 {
            font-size: 1.25rem;
        }

        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            font-family: inherit;
            font-weight: 600 !important;
            line-height: 1.5;
            margin-bottom: .5rem;
            color: #32325d;
        }

        .text-info {
            color: #6772E5 !important;
        }

        .text-success {
            color: #2CCE89 !important;
        }

        .text-danger {
            color: #F6365B !important;
        }

        .text-warning {
            color: #FB6340 !important;
        }

        .text-primary {
            color: #10CDEF !important;
        }
    </style>
{/block}

{block name="content"}
    <div class="panel">
        <div class="panel-container">

            <div class="panel-content">

                <h3>Edit {$class->name}</h3>

                <hr>

                <form id="main_form" method="post">

                    <div class="form-group">
                        <label for="address"><span class="h6">Name</span></label>

                        <input type="text" id="name" name="name" class="form-control" value="{$class->name}"/>
                    </div>

                    <div class="form-group">
                        <label for="address"><span class="h6">Code</span></label>

                        <input type="text" id="code" name="code" class="form-control" value="{$class->code}"/>
                    </div>

                    <input type="hidden" name="id" value="{$class->id}">


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" id="btn_submit">Edit</button>

                    </div>


                </form>


            </div>
        </div>


    </div>
{/block}

{block name=script}
    <script>

        $(function () {

            $('#success_message').redactor(
                {
                    minHeight: 200 // pixels
                }
            );

            let $main_form = $('#main_form');
            let $btn_submit = $('#btn_submit');

            var form = document.getElementById("main_form");

            $main_form.on('submit', function (e) {
                e.preventDefault();

                $btn_submit.prop('disabled', true);

                $.post(base_url + 'classes/app/save', $main_form.serialize())
                    .done(function (data) {

                        window.location = base_url + 'classes/app/list';

                    }).fail(function (error) {
                    $btn_submit.prop('disabled', false);
                    toastr.error(error.responseText);
                });

            });

        });

    </script>
{/block}