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
                                               <div class="col-sm-12">
                                                    <h3 class="pull-left">Driver documents</h3>
                                                    <span class="pull-right"> 
                                                    @if($user->client->dlc)
                                                    <button class="btn btn-success" id="btn-verified">Verified</button>
                                                    @else
                                                    <button class="btn btn-primary" id="btn-verify">Verify</button>
                                                    <button class="hidden btn btn-success" id="btn-verified">Verified</button>


                                                    @endif
                                                    </span>
                                                </div>

                                                @foreach($user->client->documents as $document)
                                                <div class="panel panel-default">

                                                   <div class="panel-heading" role="tab" id="headingThree">
                                                        <h4 class="panel-title">
                                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#{{ $document['doc'] }}" aria-expanded="false" aria-controls="collapseThree">
                                                                {{ $document['title'] }}
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    <div id="{{ $document['doc'] }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
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

@section("page-scripts")

<script>
    $(document).ready(function() {
        $("#btn-verify").on('click', function(event) {
            event.preventDefault();
            var url = '{{  route("users.verify",$user->id) }}';

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