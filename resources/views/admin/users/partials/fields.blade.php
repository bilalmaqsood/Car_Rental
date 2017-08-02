<div class="col-md-8">
    <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::label('name', 'User Name', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('name', $user->name, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::label('email', 'Email', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('email', $user->email, ['maxlength' => '255', 'class' => 'form-control required', 'placeholder' => 'Enter email']) !!}
            {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
        {!! Form::label('password', 'Password', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('new_password', null, ['maxlength' => '255', 'class' => 'form-control required', 'placeholder' => "Enter new password"]) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
        {!! Form::label('phone', 'phone', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('phone', $user->phone, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
      <div class="form-group {{ $errors->has('postcode') ? 'has-error' : ''}}">
        {!! Form::label('postcode', 'postcode', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('postcode', $user->postcode, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('postcode', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
    <div class="form-group {{ $errors->has('user_type') ? 'has-error' : ''}}">
        {!! Form::label('user_type', 'User Type', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
         {!! Form::select('user_type', $user_types, $user_type , ['class' => 'form-control', 'placeholder'=>'Select user type']) !!}
            {!! $errors->first('user_type', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<!-- <div id="owner" class="hidden col-md-8">
    <div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
        {!! Form::label('company', 'User company', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('company', $user->company, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
        {!! Form::label('address', 'address', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('address', $user->address, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('street') ? 'has-error' : ''}}">
        {!! Form::label('street', 'street', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('street', $user->street, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('street', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('town') ? 'has-error' : ''}}">
        {!! Form::label('town', 'town', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('town', $user->town, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('town', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
     <div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
        {!! Form::label('country', 'country', ['class' => 'col-md-4 control-label']) !!}
        <div class="col-md-6">
            {!! Form::text('country', $user->country, ['maxlength' => '255', 'class' => 'form-control required',]) !!}
            {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

</div>
 -->