@extends('admin.layouts.layout')

@section('content')
  
    <div class="container-fluid container-fullw bg-white">
        <div class="row">

            <div class="col-md-12 overflow-auto">
            <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <div class="col-md-3">
                            <h3>Update Vehicle</h3>
                        </div>
                        <div class="col-md-3 pull-right">
                            <div class="form-group pull-right">
                                <button class="btn btn-primary full-width" id="brandSubmit">Update Vehicle</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <vehicle-form :vehicle="{{$vehicle}}"></vehicle-form>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div>

@endsection
