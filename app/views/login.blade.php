@extends('layout')

@section('content')
	<div id="slider_login" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#slider_login" data-slide-to="0" class="active"></li>
	    <li data-target="#slider_login" data-slide-to="1"></li>
	    <li data-target="#slider_login" data-slide-to="2"></li>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">
	    <div class="item active block_type">
	      {{ HTML::image('image/theater-1.jpg') }}
	      <div class="carousel-caption">

	      </div>
	    </div>
	    <div class="item block_type">
	      {{ HTML::image('image/theater-2.jpg') }}
	      <div class="carousel-caption">

	      </div>
	    </div>
	    <div class="item block_type">
	      {{ HTML::image('image/theater-3.jpg') }}
	      <div class="carousel-caption">

	      </div>
	    </div>    
	  </div>

	  <!-- Controls -->
	  <a class="left carousel-control" href="#slider_login" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#slider_login" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	</div>
	<div class="col-md-3"></div>
	<div class="page-header col-md-6" align="center">
		<h1>RASS 1.1 Central Server</h1>
		<h3>Remote Access Security System</h3>
	</div>
	<div class="col-md-3"></div>
	<div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h1 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-lock"></span> Enter your credentials</h1>
		      </div>
		      {{ Form::open(array('url' => '/')) }}
		      <div class="modal-body col-md-7">		        
			        <div class="">
						<div class="input-group">
						  <span class="input-group-addon">@</span>
						  <input type="text" name="username" class="form-control" placeholder="Username">
						</div>
						<div class="input-group">
						  <span class="input-group-addon">@</span>
						  <input type="password" name="password" class="form-control" placeholder="Password">
						</div>
					</div>				
		      </div>
		      <div class="modal-footer">
		      	<h4>Login to access sites remotely</h4>
		        {{ Form::submit('Go!', array('class' => 'btn btn-primary col-md-6', 'style' => 'margin-left:2.5%;')) }}
		      </div>
		      {{ Form::close() }}
		    </div>
		  </div>
		</div>
	</div>
@stop