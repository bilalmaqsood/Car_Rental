<div class="col-md-8">
    <div class="form-group {{ $errors->has('code') ? 'has-error' : ''}}">
        {!! Form::label('code', 'Code', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('code', $promo_code->code, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('code', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('reward') ? 'has-error' : ''}}">
        {!! Form::label('reward', 'Reward', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('reward', $promo_code->reward, ['maxlength' => '255', 'class' => 'form-control required', 'placeholder' => 'Enter reward']) !!}
            {!! $errors->first('reward', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('is_active') ? 'has-error' : ''}}">
        {!! Form::label('is_active', 'Status', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
         {!! Form::select('is_active',[1 => "Active",2 => "In active"], $promo_code->is_active, ['class' => 'form-control', 'placeholder'=>'Select promocode status']) !!}
            {!! $errors->first('is_active', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('expire_at') ? 'has-error' : ''}}">
        {!! Form::label('expire_at', 'Expiry Date', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('expire_at', null, ['maxlength' => '255', 'class' => 'expire_at form-control required']) !!}
            {!! $errors->first('expire_at', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

