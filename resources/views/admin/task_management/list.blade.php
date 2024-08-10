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
                            href="{{url('admin/task_management/detail')}}">Add New task</a>
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


    function destroy(id) {
        $.ajax({
        url: '{{ url("admin/task_management/delete") }}',
        type: 'delete',
        dataType: 'JSON',
        data: {
            id: id
        },
         headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
         beforeSend: function() {
        
         },
         success: function(response) {
            if(response.status == 200) {
               loadDatatble()
               M.toast({html:  response.message, classes: 'green'})
            } else {
                M.toast({html:  response.message, classes: 'red'})
            }
         },
         error: function() {
            M.toast({html:  '500 server error', classes: 'red'})
         }
      });
   }

</script>
@endpush