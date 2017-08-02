@extends('admin.layouts.layout')

@section('content')
  
    <div class="container-fluid container-fullw bg-white">
        <div class="row">

            <div class="col-md-12 overflow-auto">
                 {!! Form::open(['url' => route('users.store'), 'class' => 'form-horizontal', 'files' => true, 'id'=>'brandForm']) !!}
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <div class="col-md-3">
                            <h3>Create New User</h3>
                        </div>
                        <div class="col-md-3 pull-right">
                            <div class="form-group pull-right">
                                <button class="btn btn-primary full-width" id="brandSubmit">Save User</button>
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
