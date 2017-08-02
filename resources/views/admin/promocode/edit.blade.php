@extends('admin.layouts.layout')

@section('content')
  
    <div class="container-fluid container-fullw bg-white">
        <div class="row">

            <div class="col-md-12 overflow-auto">
             {!! Form::model($promo_code, [ 'method' => 'PATCH','route' => ['promocodes.update', $promo_code->id],'class' => 'form-horizontal', 'id'=>'promocodes-form' ]) !!}
            <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading" style="height: 50px;">
                        <div class="col-md-3">
                            <h3>Update Promocode</h3>
                        </div>
                        <div class="col-md-3 pull-right">
                            <div class="form-group pull-right">
                                <button class="btn btn-primary full-width" id="brandSubmit">Update Promocode</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @include ('admin.promocode.partials.fields')
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection

@section("page-scripts")
<script type="text/javascript">
    $(".expire_at").datetimepicker({
                    inline: true,
                    sideBySide: false,
                    minDate: moment(new Date())
                });
</script>
    
@endsection
