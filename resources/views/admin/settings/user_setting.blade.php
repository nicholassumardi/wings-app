@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
@endpush
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
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal_task">Add New Role</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <div class="container">
                <div class="section section-data-tables">
                    <div class="row">
                        <div class="col s12">
                            <div class="card">
                                <div class="card-content">
                                    <h4 class="card-title">Tasks</h4>
                                    <div class="row">
                                        <div class="col s12">
                                            <table id="page-length-option" class="display">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>User Type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody></tbody>
                                                <tfoot>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-overlay"></div>
        </div>
    </div>
</div>
<!-- Modal Structure -->
<div id="modal_task" class="modal">
    <div class="modal-content">
        <h4>Add New Role</h4>
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <form id="form_data">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="user_type" id="user_type">
                                <label for="fn">User Type</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer" id="footerModal">
        <button class="btn cyan waves-effect waves-light right" id="save" onclick="save()">Add
            <i class="material-icons right">send</i>
        </button>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
</div>
@push('js')
<script>
    $(function() {
        select2ServerSide('#user_id', '{{ url("admin/select2/user") }}');
        loadDatatble()
    });

    function loadDatatble(){
        return $('#page-length-option').DataTable({
         serverSide: true,
         deferRender: true,
         destroy: true,
         iDisplayInLength: 10,
         order: [[1, 'asc']],
         ajax: {
            url: '{{ url("admin/user_setting/datatable") }}',
            type: 'GET',
            beforeSend: function() {
        
            },
            complete: function() {
            },
            error: function() {
               
            }
         },
         columns: [
            { name: 'id', orderable: false, searchable: false, className: 'text-center align-middle details-control' },
            { name: 'user_type', className: 'text-center align-middle' },
            { name: 'action', orderable: false, searchable: false, className: 'text-center align-middle'},
         ]
      }); 
    }


    function save() {
        var formData = new FormData($('#form_data')[0]); // Corrected selector
        $.ajax({
            url: '{{ url("admin/user_setting/create") }}',
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
                loadDatatble()
                if (response.status == 200) {
                    var elems = document.querySelectorAll('.modal');
                    var instance = M.Modal.getInstance(elems);
                    instance.close();
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

    function show(id) {
        $.ajax({
            url: '{{ url("admin/user_setting/show") }}',
            type: 'GET',
            dataType: 'JSON',
            data: {
                id: id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                // You can add any actions you want to perform before sending the request here
            },
            success: function(response) {
                loadDatatble()
                if (response.status == 200) {
                    $('.modal').modal();
                    $('.modal').modal('open'); 
                    $('#user_type').val(response.data.user_type);
                    $('#footerModal').html('');
                    $('#footerModal').append(`
                     <button class="btn cyan waves-effect waves-light right" id="save" onclick="update(`+response.data.id+`)">Update
                         <i class="material-icons right">send</i>
                        </button>
                     <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>`);
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

    function update(id){
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
                loadDatatble()
                if (response.status == 200) {
                    var elems = document.querySelectorAll('.modal');
                    var instance = M.Modal.getInstance(elems);
                    instance.close();
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

    function destroy(id) {
        $.ajax({
        url: '{{ url("admin/user_setting/delete") }}',
        type: 'delete',
        dataType: 'JSON',
        data: {
            id: id
        },
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
         beforeSend: function() {
            $('#validation_alert').hide();
            $('#validation_content').html('');
         },
         success: function(response) {
            if(response.status == 200) {
               loadDatatble()
               notif('success', 'bg-success', response.message);
            } else if(response.status == 422) {
               notif('warning', 'bg-warning', 'Validation');
               
               $.each(response.error, function(i, val) {
                  $.each(val, function(i, val) {
                     $('#validation_content').append(`
                        <li>` + val + `</li>
                     `);
                  });
               });
            } else {
               notif('error', 'bg-danger', response.message);
            }
         },
         error: function() {
            swalInit.fire({
               title: 'Server Error',
               text: 'Please contact developer',
               type: 'error'
            });
         }
      });
   }




</script>
@endpush