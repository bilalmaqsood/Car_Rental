@extends('admin.layouts.layout')

@section('content')
  
    <div class="container-fluid container-fullw bg-white">
        <div class="row">

            <div class="col-md-12 overflow-auto">
                <div class="col-sm-6">
                   <h1>bookings </h1>
                <h4>bookings listing</h4> 
                </div>
                <div class="col-sm-6">
                  <a href="{{ route('bookings.create') }}" class="btn btn-primary btn-md pull-right" title="Add New booking">
                                <span class="glyphicon glyphicon-plus" aria-hidden="true"/>
                    </a>
                </div>
                
            </div>
            <div class="col-md-12 overflow-auto">
                <table class="table table-responsive table-bordered" id="bookings-table" cellspacing="0">
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Vehicle</th>
                        <th>Booking status</th>
                        <th>Deposit</th>
                        <th>Promocode</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        

                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

@endsection


@section("page-scripts")
    <script>
        var table_selector = '#bookings-table';
        var table =  $('.table');
        var oTable = $(table_selector).dataTable({
            "dom": '<"top"f>rt<"bottom"ilp><"clear">',
            processing: true,
            serverSide: true,
            paging: true,
            "ajax": {
                "url": "{!! route('bookings.index') !!}",
                "data": function ( d ) {
                    return $.extend( {}, d, {
                        "category-selectors": $('#category-selector').val(),
                        "status-selectors": $('#status-selector').val(),
                        "status": $('#status').val()
                    } );
                }
            },
            columns: [
                { data: 'user.name', name: 'user.name' },
                { data: 'vehicle' , name: 'vehicle' },
                { data: 'status' , name: 'status' },
                { data: 'deposit' , name: 'deposit' },
                { data: 'promo_code' , name: 'promo_code' },
                { data: 'start_date' , name: 'start_date' },
                { data: 'end_date' , name: 'end_date' },
               

                
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
                    if(confirm("Are you sure to delete this booking?")){
                tr = $(this).closest('tr');
                var url = "{{route('bookings.destroy','---')}}";
                var booking_id = $(this).attr('data-id');
                url = url.replace("---",booking_id);

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