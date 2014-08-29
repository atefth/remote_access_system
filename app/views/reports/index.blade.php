@extends('layout')

@section('content')
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    <div class="span10">
    	<button class="btn btn-info" type="button" onClick="prev()">Previous</button>
    	<button class="btn btn-info" type="button" onClick="next()">Next</button>
    </div>
@stop