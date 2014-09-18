@extends('layout')

@section('content')
    <div class='row'>
        <h1><span class="glyphicon glyphicon-minus-sign"></span> Edit User</h1>
     
        {{ Form::model($user, ['role' => 'form', 'url' => '/user/' . $user->rfid, 'method' => 'PUT']) }}
     
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
            {{ Form::text('rfid', null, ['placeholder' => 'RFID', 'class' => 'form-control']) }}
        </div>
     
        <div class='form-group'>
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        </div>
     
        {{ Form::close() }}
     
    </div>
@stop