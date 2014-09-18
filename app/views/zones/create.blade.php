@extends('layout')

@section('content')

	<div class='row'>
     
        <h1><span class="glyphicon glyphicon-plus-sign"></span> Add Zone</h1>
     
        {{ Form::open(array('url' => 'zone/')) }}
     
        <div class='form-group col-md-5'>
            {{ Form::text('name', null, ['placeholder' => 'Zone Name', 'class' => 'form-control']) }}
        </div>

        <div class='form-group col-md-5'>
            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
        </div>
     
        {{ Form::close() }}
     
    </div>

@stop