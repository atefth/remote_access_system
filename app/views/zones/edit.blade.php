@extends('layout')

@section('content')

	<div class='row'>
        <h1><span class="glyphicon glyphicon-minus-sign"></span> Edit Zone</h1>
     
        {{ Form::model($zone, ['role' => 'form', 'url' => '/zone/' . $zone->rfid, 'method' => 'PUT']) }}
     
        <div class='form-group col-md-5'>
            {{ Form::text('name', null, ['placeholder' => 'Zone Name', 'class' => 'form-control']) }}
        </div>
            
        <div class='form-group'>
            {{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
        </div>
     
        {{ Form::close() }}
     
    </div>

@stop