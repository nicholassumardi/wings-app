<div id="main">
    <div class="row">
        <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s10 m10 l10">
                        <h5 class="breadcrumbs-title mt-0 mb-0"><span>Task Managements</span></h5>
                        <ol class="breadcrumbs mb-0">
                            <li class="breadcrumb-item"><a href="index.html">Task</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">List Task</a>
                            </li>
                        </ol>
                    </div>
                    <div class="col s2 m2 l2">
                        <a class="waves-effect waves-light btn modal-trigger"
                            href="{{url('admin/task_management')}}">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container center-align">
                <div class="col s12 m6 l6">
                    <div id="basic-form" class="card card card-default scrollspy">
                        <div class="card-content">
                            <div class="container" id="validation-alert">
                                <div class="row">
                                    <div class="col s10 offset-s1">
                                        <div class="card-alert card gradient-45deg-green-teal">
                                            <div class="card-content white-text" id="validation-content">

                                            </div>
                                            <button type="button" class="close white-text" data-dismiss="alert"
                                                aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form id="form_data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" name="title" id="title">
                                        <label for="fn">Title</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="description" class="materialize-textarea"
                                            name="description"></textarea>
                                        <label for="email">Description</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="user_id" id="user_id" class="select2 browser-default">
                                        </select>
                                        <label for="user_id">Assign To</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="status" id="status">
                                            <option value="0">Incomplete</option>
                                            <option value="1">Complete</option>
                                        </select>
                                        <label for="status">Status</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" class="datepicker" name="due_date">
                                        <label for="message">Due Date</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light right" type="button"
                                            id="btn-save" onclick="save()">Add
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
@push('js')
<script>
    $(function() {
        select2ServerSide('#user_id', '{{ url("admin/select2/user") }}');
    });

    function save() {
        var formData = new FormData($('#form_data')[0]); // Corrected selector
        $.ajax({
            url: '{{ url("admin/task_management/create") }}',
            type: 'POST',
            dataType: 'JSON',
            data: formData,
            processData: false, // Set processData to false when using FormData
            contentType: false, // Set contentType to false when using FormData
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                // You can add any actions you want to perform before sending the request here
            },
            success: function(response) {
                if (response.status == 200) {
                    // Handle success response
                } else if (response.status == 422) {
                    $.each(response.error, function(i, val) {
                        $.each(val, function(i, val) {
                            $('#validation_content').append(`
                                <li>` + val + `</li>
                            `);
                        });
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle error
                console.error(xhr.responseText); // Log the detailed error message
            }
        });
    }

   
</script>
@endpush