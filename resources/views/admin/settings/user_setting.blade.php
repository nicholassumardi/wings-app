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
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal_task">Add New task</a>
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
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Due Date</th>
                                                        <th>Status</th>
                                                        <th>Assignee</th>
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
        <h4>Add New Task</h4>
        <div class="col s12 m6 l6">
            <div id="basic-form" class="card card card-default scrollspy">
                <div class="card-content">
                    <form id="form-data">
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" name="title" id="title">
                                <label for="fn">Title</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="description" class="materialize-textarea" name="description"></textarea>
                                <label for="email">Description</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <label for="user_id">Assign To</label>
                                <select class="select2 browser-default" id="user_id" name="user_id">

                                </select>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" class="datepicker">
                                <label for="message">Due Date</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn cyan waves-effect waves-light right" id="save">Add
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
            url: '{{ url("admin/task_management/datatable") }}',
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
            { name: 'title', className: 'text-center align-middle' },
            { name: 'description', className: 'text-center align-middle'},
            { name: 'id', className: 'text-center align-middle' },
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'id', searchable: false, className: 'text-center align-middle' },
            { name: 'id', searchable: false, className: 'text-center align-middle' },
         ]
      }); 
    }

</script>
@endpush