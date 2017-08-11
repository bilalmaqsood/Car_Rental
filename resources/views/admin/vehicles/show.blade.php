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
                                                <div class="col-xs-4">
                                                    <label><b>Registration no:</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->registration_number }}
                                                </div>
                                             </div>
                                             <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Make:</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->make }}
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Model:</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->model }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>variant:</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->variant }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Year:</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->year }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Mileage:</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->mileage }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Fuel:</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->fuel }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>MPG :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->mpg }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>MPG Eco :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->mpg_eco }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Transmission :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->transmission }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Seats :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->seats }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Available from :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->available_from }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Available to :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->available_to }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Pickup location :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->pickup_location }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Return location :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->return_location }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Location :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->location }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Delivery charges :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->delivery_charges }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Rent :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->rent }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Insurance :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->insurance }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Mile cap :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->mile_cap }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>After mile :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->after_mile }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Deposit :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->deposit }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>License years :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->license_years }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>pco years :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->pco_years }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Driver year :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->driver_year }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>License points :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->license_points }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>No fault accident :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->no_fault_accident }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <label><b>Fault accident :</b></label>
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $vehicle->fault_accident }}
                                                </div>
                                            </div>

                                            @if($vehicle->images)
                                            <div class="row">
                                                <h3>Vehicle Images</h3>

                                                
                                                <div class="panel panel-default">
                
                                                   <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#images" aria-expanded="false" aria-controls="collapseThree">
                                                                Vehicle Images
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="images" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                        @foreach($vehicle->images as $image)
                                                            <img src="{{ $image }}" alt="">
                                                            @endforeach
                                                        </div>
                                                    </div>
                                               </div>
                                                
                                            </div>
                                            @endif


                                            @if($vehicle->documents)
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <h3 class="pull-left">Vehicle documents</h3>
                                                    <span class="pull-right"> 
                                                    @if($vehicle->vlc)
                                                    <button class="btn btn-success" id="btn-verified">Verified</button>
                                                    @else
                                                    <button class="btn btn-primary" id="btn-verify">Verify</button>
                                                    <button class="hidden btn btn-success" id="btn-verified">Verified</button>


                                                    @endif
                                                    </span>
                                                </div>
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

@section("page-scripts")
<script>
    $(document).ready(function() {
        $("#btn-verify").on('click', function(event) {
            event.preventDefault();
            var url = '{{  route("vehicles.verify",$vehicle->id) }}';

            axios.post(url,{}).then(function(response){
                new Noty({
                                    type: 'information',
                                    text: response.data.success,
                                }).show();
                $("#btn-verify").hide();
                $("#btn-verified").removeClass("hidden");

            });
             

        });  
    });
</script>
@endsection