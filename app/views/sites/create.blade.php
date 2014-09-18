@extends('layout')

@section('content')

	<div class='row'>
     
        <h1><span class="glyphicon glyphicon-plus-sign"></span> Add Site</h1>
     
        {{ Form::open(array('url' => 'site/')) }}
     
        <div class='form-group col-md-5'>
            {{ Form::text('name', null, ['placeholder' => 'Site Name', 'class' => 'form-control']) }}
        </div>

        <div class='form-group col-md-5'>
            {{ Form::submit('Create', ['class' => 'btn btn-primary']) }}
        </div>
     
        {{ Form::close() }}
     
    </div>

@stop