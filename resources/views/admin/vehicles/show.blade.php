@extends('admin.layouts.layout')

@section('content')
<div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="panel panel-white" id="panel1">
                                    <div class="panel-body mainDescription">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Make:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $vehicle->make }}
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Model:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $vehicle->model }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>variant:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $vehicle->variant }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Year:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $vehicle->year }}
                                                </div>
                                            </div>
                                            @if($vehicle->documents)
                                            <div class="row">
                                                <h3>Vehicle documents</h3>

                                                @foreach($vehicle->documents as $document)
                                                <div class="panel panel-default">
                
                                                   <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ preg_replace('/\s+/', '', $document['name']) }}" aria-expanded="false" aria-controls="collapseThree">
                                                                {{ $document['name'] }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="{{ preg_replace('/\s+/', '', $document['name']) }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                            <img src="{{ $document['path'] }}" alt="">
                                                        </div>
                                                    </div>
                                               </div>
                                                @endforeach
                                            </div>
                                            @endif


                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('vehicles.index') }}" class="btn btn-default btn-wide pull-right">cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection
