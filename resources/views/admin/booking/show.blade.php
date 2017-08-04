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
                                                    {{ $statusTypes[$booking->deposit] }}
                                                </div>
                                             </div>
                                            <div class="row">
                                                 <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingThree">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                           
                                            Document B
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                    <div class="panel-body">
                                        <p>Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.</p>
                                    </div>
                                </div>
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
</div>

@endsection
