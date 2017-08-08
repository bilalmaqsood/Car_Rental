@extends('admin.layouts.layout')

@section('page-styles')
<style>
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
                                                    {{ $statusTypes[$booking->status] }}
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="panel panel-default">
                                                @foreach($booking->documents as $document)
                                                @if($document['type']=='pdf')
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
                                                    @endforeach
                                                    
                                                </div>
                                            </div>

                                            <div class="row">
                                                <h3>Vehicle Inspection</h3>

                                                @foreach($booking->inspection as $inspection)
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
                                                            <img src="/images/front.png" alt="" style="margin: 0px;">
                                                            @foreach($inspection['data'] as $image)
                                                               <div  style=" top: {{ $image[2] }}; 
                                                                           left: {{ $image[3] }}; z-index: 9999" class="mydraggable  ">
                                                                <div id="mydragcontrols">
                                                                    <span id="mydeldrag" style="color: red">
                                                                    <i class="fa fa-times" aria-hidden="true"></i>
                                                                    </span>
                                                                    <span id="mydeldrag" style="color: green" onClick="spotAction(inspection)">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>

                                                        </div>
                                                    </div>
                                               </div>
                                                @endforeach
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
