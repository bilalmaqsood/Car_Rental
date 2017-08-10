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
                                                    {{ $user->name }}
                                                </div>
                                             </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Email:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Type:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $user_type }}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-3">
                                                    <label><b>Phone:</b></label>
                                                </div>
                                                <div class="col-xs-9">
                                                    {{ $user->phone }}
                                                </div>
                                            </div>
                                            @if($user_type=='client' && $user->client->documents)
                                            <div class="row">
                                                <h3>User documents</h3>

                                                @foreach($user->client->documents as $document)
                                                <div class="panel panel-default">

                                                   <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $document['name'] }}" aria-expanded="false" aria-controls="collapseThree">
                                                                {{ $document['title'] }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="{{ $document['name'] }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                                                        <div class="panel-body">
                                                        <object data="{{$document['path']}}" type="application/pdf" style="height: 110vh;" width="100%"></object>
                                                            
                                                                
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
