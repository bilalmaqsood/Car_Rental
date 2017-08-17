@extends('admin.layouts.layout')

@section('page-styles')
<style>
.dummy_car {
    float: left;
    width: 100%;
    text-align: center;
    padding: 70px 0;
}
    .draggable,
.mydraggable {
    width: 60px;
    height: 25px;
    background: rgba(145, 4, 28, 0.6);
    z-index: 1;
    cursor: move;
    overflow: hidden;
    position: absolute;
    padding: 0 5px;
    text-align: center;
    opacity: .9;
    border: 2px dotted #8c001a;
}
.carcondition-img {
    position: relative;
}

#mydragcontrols {
    float: right;
}

#mydragcontrols #myfix {
    cursor: pointer;
    margin: 2px;
}

#mydragcontrols #mydeldrag {
    cursor: pointer;
    margin: 2px;
}

</style>
@endsection
@section('content')
<div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                                <div class="panel panel-white" id="panel1">
                                    <div class="panel-body mainDescription">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>User name:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $booking->user->name }}
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Start date:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ format_date($booking->start_date) }}
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>End date:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ format_date($booking->end_date) }}
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Deposit Amount:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $booking->deposit }}
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Booking Status:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                @if($booking->status==10)
                                                        <a href="" class="btn btn-danger">{{ $statusTypes[$booking->status] }}</a>
                                                @else
                                                    {{ $statusTypes[$booking->status] }}
                                                @endif
                                                </div>
                                             </div>
                                        

                                             <div class="row">
                                             <h1>   Payments </h1>
                                                <div class="panel panel-default">
                                                
                                                
                                                <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#Payments" aria-expanded="false" aria-controls="collapseThree">
                                                                Payments
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="Payments" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">

                                                          <table class="table table-bordered">
                                                        <thead>
                                                                <tr>
                                                                         <th>Title</th>
                                                                         <th>Amount</th>
                                                                         <th>Due Date</th>
                                                                         <th>Status</th>
                                                                </tr>
                                                             </thead>
                                                            <tbody>
                                                        @foreach($booking->payments as $payment)
                                                        <tr>
                                                             <td>{{$payment["title"]}}</td>
                                                                <td>{{$payment["cost"]}}</td>
                                                                <td>{{ format_date($payment["due_date"]) }}</td>
                                                                <td> {{ $payment["paid"]==true?"Paid":"Pending"}} </td>
                                                        </tr>
                                                            @endforeach
                                                            </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    </div>
                                            </div>


                                            <div class="row">
                                                <div class="panel panel-default">
                                                @foreach($booking->documents as $document)
                                                @if($document['type']=='pdf' && $document['path']!==null)
                                                <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#{{preg_replace('/\s+/', '', $document['name'])}}" aria-expanded="false" aria-controls="collapseThree">
                                                                {{$document['name']}}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="{{preg_replace('/\s+/', '', $document['name'])}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                        <object data="{{$document['path']}}" type="application/pdf" style="height: 110vh;" width="100%"></object>

                                                        </div>
                                                    </div>
                                                @endif
                                                @endforeach

                                                @foreach($booking->vehicle->documents as $document)
                                                @if($document['name']!==null)
                                                    <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#{{preg_replace('/\s+/', '', $document['name'])}}" aria-expanded="false" aria-controls="collapseThree">
                                                                {{$document['name']}}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="{{preg_replace('/\s+/', '', $document['name'])}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                            <img src="{{$document['path']}}" alt="">
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                                    
                                                </div>
                                            </div>

                                            <div class="row">
                                                <h3>Vehicle Inspection</h3>
                                                <div class="col-sm-6">  
                                                @foreach($booking->vehicle->inspection as $inspection)
                                                         <div class="panel panel-default">

                                                <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $inspection['id'] }}{{$inspection['type']}}" aria-expanded="false" aria-controls="collapseThree">
                                                                {{$inspection['type']}}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="{{ $inspection['id'] }}{{$inspection['type']}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">

                                                        <div style="position: relative;" class="dummy_car carcondition-img" id="{{$inspection['type']}}">
                                                                
                                                               <div  style=" top: {{ $inspection['x_axis'] }}%; 
                                                                           left: {{ $inspection['y_axis'] }}%; z-index: 9999" class="mydraggable  ">
                                                                <div id="mydragcontrols">
                                                                    <span id="mydeldrag" style="color: red">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </span>
                                                                    <span id="mydeldrag" style="color: green" onClick="spotAction(inspection)">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                           
                                                             <img src="/images/{{$inspection['type']}}.png" alt="" style="margin: 0px;">

                                                        </div>

                                                        </div>
                                                    </div>
                                               </div>
                                                @endforeach
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('users.index') }}" class="btn btn-default btn-wide pull-right">cancel</a>
                                    </div>
                                </div>
                            

                           

                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection


@section('page-scripts')
<script>


</script>
@endsection