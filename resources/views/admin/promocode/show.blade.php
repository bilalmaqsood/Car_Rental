@extends('admin.layouts.layout')

@section('content')
<div class="container-fluid container-fullw bg-white">
            <div class="row">
                <div class="col-md-12">
                    <h1> Promocode Details</h1>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-2">
                                <div class="panel panel-white" id="panel1">
                                    <div class="panel-body mainDescription">
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Code:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $promo_code->code }}
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Reward:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $promo_code->reward }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Status:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $promo_code->is_active==1?"Active":"In active" }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Expiry:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ format_date($promo_code->expire_at) }}
                                                </div>
                                            </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="{{ route('promocodes.index') }}" class="btn btn-default btn-wide pull-right">cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection
