@extends('layout')

@section('content')
	<ul class="nav nav-tabs">
	  <li <?php if ($graph == 'combo') {
	  	echo 'class="active"';
	  } ?>>
	    <a href="/combo">Combo Graph</a>
	  </li>
	  <li <?php if ($graph == 'pie') {
	  	echo 'class="active"';
	  } ?>>
	  	<a href="/pie">Pie Chart</a>
	  </li>
	</ul>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
    <div class="span10">
    	<button class="btn btn-info" type="button" onClick="prev<?php if ($graph == 'combo') {
	  	echo 'Combo';
	  }else{
	  	echo 'Pie';
	  } ?>()" style="width: 100px;">Previous</button>
    	<button class="btn btn-info" type="button" onClick="next<?php if ($graph == 'combo') {
	  	echo 'Combo';
	  }else{
	  	echo 'Pie';
	  } ?>()" style="width: 100px;">Next</button>
    </div>
@stop