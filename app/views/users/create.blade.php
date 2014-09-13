@extends('layout')

@section('content')
    <div class='row'>
     
        <h1><span class="glyphicon glyphicon-plus-sign"></span> Add User</h1>
     
        {{ Form::open(array('url' => 'user/')) }}
     
        <div class='form-group col-md-5'>
            {{ Form::text('f_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) }}
        </div>
     
        <div class='form-group col-md-5'>
            {{ Form::text('l_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) }}
        </div>
     
        <div class='form-group col-md-5'>
            {{ Form::text('phone', null, ['placeholder' => 'Phone', 'class' => 'form-control']) }}
        </div>
     
        <div class='form-group col-md-5'>
            {{ Form::text('address', null, ['placeholder' => 'Address', 'class' => 'form-control']) }}
        </div>

        <div class='form-group col-md-5'>
            {{ Form::text('site_id', null, ['placeholder' => 'Site ID', 'class' => 'form-control']) }}
        </div>
     
        <div class='form-group col-md-5'>
            {{ Form::text('rfid', null, ['placeholder' => 'RFID', 'class' => 'form-control']) }}
        </div>

        <div class='for-group col-md-5'>
            {{ Form::label('has_access', 'Access') }}
            {{ Form::checkbox('has_access', 'value') }}
        </div>

        <div class='form-group col-md-5'>
            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
        </div>
     
        {{ Form::close() }}
     
    </div>
@stop