@extends('layout')

@section('content')

	<div class='row'>
        <h1><span class="glyphicon glyphicon-minus-sign"></span> Edit Site</h1>
     
        {{ Form::model($site, ['role' => 'form', 'url' => '/site/' . $site->rfid, 'method' => 'PUT']) }}
     
        <div class='form-group col-md-5'>
            {{ Form::text('name', null, ['placeholder' => 'Site Name', 'class' => 'form-control']) }}
        </div>
            
        <div class='form-group'>
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        </div>
     
        {{ Form::close() }}
     
    </div>

@stop