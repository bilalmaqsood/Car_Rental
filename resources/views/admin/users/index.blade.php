@extends('admin.layouts.layout')

@section('content')
  
    <div class="container-fluid container-fullw bg-white">
        <div class="row">

            <div class="col-md-12 overflow-auto">
                <div class="col-sm-6">
                   <h1>Users </h1>
                <h4>users listing</h4> 
                </div>
                <div class="col-sm-6">
                  <a href="{{ route('users.create') }}" class="btn btn-primary btn-md pull-right" title="Add New User">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"/>
                    </a>
                </div>
                
            </div>
            <div class="col-md-12 overflow-auto">
                <table class="table table-responsive table-bordered" id="users-table" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection


@section("page-scripts")
    <script>
        var table_selector = '#users-table';
        var table =  $('.table');
        var oTable = $(table_selector).dataTable({
            "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            processing: true,
            serverSide: true,
            "ajax": {
                "url": "{!! route('users.index') !!}",
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "category-selectors": $('#category-selector').val(),
                        "status-selectors": $('#status-selector').val(),
                        "status": $('#status').val()
                    } );
                }
            },
            columns: [
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'phone', name: 'phone' },
                { data: 'user_type', name: 'user_type' },
                { data: 'status', name: 'status' },
                { data: 'action', name: 'action', searchable: "false", orderable: "false" }

                
            ],
            "aoColumnDefs" : [
                {
                    "aTargets" : [0]
                }
            ],
            "oLanguage" : {
            },
            "bStateSave": true,
            "aaSorting" : [[0, 'asc']],
            "aLengthMenu" : [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"] // change per page values here
            ],
            // set the initial value

            "iDisplayLength" : 10
        });


                table.on('click', '.delete-item', function(e){
                    if(confirm("Are you sure to delete this user?")){
                tr = $(this).closest('tr');
                var url = "{{route('users.destroy','---')}}";
                var user_id = $(this).attr('data-id');
                url = url.replace("---",user_id);

                $.ajax({
                    url: url,
                    headers: { 'X-XSRF-TOKEN' : '{{\Illuminate\Support\Facades\Crypt::encrypt(csrf_token())}}' },
                    error: function (response) {
                        swal(response.statusText,(response.status==403 ? '{{trans('error_page.messages')}}' : response.responseText));
                    },
                    success: function(response) {
                      
                            tr.remove();
                    },
                    type: 'DELETE'
                });
           
            }
            e.preventDefault();
        });



        $('#category-selector').change(function () {
            oTable.dataTable().fnDraw();
        });
        $('#status-selector').change(function () {
            oTable.dataTable().fnDraw();
        });
        $('#status').on('change',function (e) {
            oTable.fnDraw();
        });

    </script>
    @endsection