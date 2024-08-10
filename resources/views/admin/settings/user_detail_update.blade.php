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
                            href="{{url('admin/user_setting')}}">Back</a>
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

                                    </div>
                                </div>
                            </div>
                            <form id="form_data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="text" name="name" id="name"
                                            value="{{$data_user->first()->user->name}}">
                                        <label for="fn">Name</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="email" name="email" id="email"
                                            value="{{$data_user->first()->user->email}}">
                                        <label for="email">Email</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select name="role_id[]" id="role_id" class="select2 browser-default" multiple>
                                            @foreach ($data_role as $role)
                                            @foreach ($data_user as $du)
                                            <option value="{{$role->id}}" {{$du->role_id == $role->id ?
                                                'selected' : ''}}>{{$role->user_type}}</option>
                                            @endforeach
                                            @endforeach

                                        </select>
                                        <label for="role_id">Roles</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="password" class="password" name="password"
                                            value="{{$data_user->first()->user->password}}">
                                        <label for="message">Password</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn cyan waves-effect waves-light right" type="button"
                                            id="btn-save" onclick="update({{$data_user->first()->user->id}})">Update
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
        select2ServerSide('#role_id', '{{ url("admin/select2/role") }}');
    });

    function update(id) {
        var formData = new FormData($('#form_data')[0]); // Corrected selector
        formData.append("id", id);
        $.ajax({
            url: '{{ url("admin/user_setting/update") }}',
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