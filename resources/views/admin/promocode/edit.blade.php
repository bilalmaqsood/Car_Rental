@extends('admin.layouts.layout')

@section('content')
  
    <div class="container-fluid container-fullw bg-white">
        <div class="row">

            <div class="col-md-12 overflow-auto">
             {!! Form::model($user, [ 'method' => 'PATCH','route' => ['users.update', $user->id],'class' => 'form-horizontal', 'id'=>'users-form' ]) !!}
            <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <div class="col-md-3">
                            <h3>Update User</h3>
                        </div>
                        <div class="col-md-3 pull-right">
                            <div class="form-group pull-right">
                                <button class="btn btn-primary full-width" id="brandSubmit">Update User</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include ('admin.users.partials.fields')
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
