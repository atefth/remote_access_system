@extends('layout')

@section('content')
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
	  <!-- Indicators -->
	  <ol class="carousel-indicators">
	    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	  </ol>

	  <!-- Wrapper for slides -->
	  <div class="carousel-inner">
	    <div class="item active block_type">
	      {{ HTML::image('image/big/theater-1.jpg') }}
	      <div class="carousel-caption">
	        <div class="hero-unit">
	        	SoftBot Systems
	        </div>
	      </div>
	    </div>
	    <div class="item block_type">
	      {{ HTML::image('image/big/theater-2.jpg') }}
	      <div class="carousel-caption">
	        <div class="hero-unit">
	        	Remote Access System Solution
	        </div>
	      </div>
	    </div>
	    <h1 align="center" class="header_type">
	    	RAS Solution Portal
	    </h1>	    
	  </div>

	  <!-- Controls -->
	  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
	  </a>
	  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
	  </a>
	</div>
	<div>

	</div>
	<div>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h1 class="modal-title" id="myModalLabel"><span class="glyphicon glyphicon-lock"></span> Enter your credentials</h1>
		      </div>
		      {{ Form::open(array('url' => 'login/index')) }}
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
	<div>
		<div class="row">
		  <div class="col-sm-6">
		    <div class="thumbnail">
		      <img data-src="holder.js/300x300" alt="Design">
		      <div class="caption">
		        <h3>Design</h3>
		        <p>Read more about SoftBot's Design</p>
		        <p><a href="#" class="btn btn-primary" role="button">Designs</a></p>
		      </div>
		    </div>
		  </div>
		  <div class="col-sm-6">
		    <div class="thumbnail">
		      <img data-src="holder.js/300x300" alt="Innovation">
		      <div class="caption">
		        <h3>Innovation</h3>
		        <p>Read more about SoftBot's Innovation</p>
		        <p><a href="#" class="btn btn-primary" role="button">Inoovations</a></p>
		      </div>
		    </div>
		  </div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="thumbnail">
			      <img data-src="holder.js/300x300" alt="Initiative">
			      <div class="caption">
			        <h3>Initiative</h3>
			        <p>Read more about SoftBot's Initiative</p>
			        <p><a href="#" class="btn btn-primary" role="button">Initiatives</a></p>
			      </div>
			    </div>
		    </div>		  	
		</div>
		<div class="row">
			<div class="col-sm-4">
			    <div class="thumbnail">
				    <img data-src="holder.js/300x300" alt="Interest">
				    <div class="caption">
				        <h3>Interest</h3>
				        <p>Read more about SoftBot's Interest</p>
		        		<p><a href="#" class="btn btn-primary" role="button">Interests</a></p>
		    		</div>
		    	</div>
			</div>
			<div class="col-sm-4">
			    <div class="thumbnail">
				    <img data-src="holder.js/300x300" alt="Development">
				    <div class="caption">
				        <h3>Development</h3>
				        <p>Read more about SoftBot's Development</p>
		        		<p><a href="#" class="btn btn-primary" role="button">Developments</a></p>
		    		</div>
		    	</div>
			</div>
			<div class="col-sm-4">
			    <div class="thumbnail">
				    <img data-src="holder.js/300x300" alt="Contact">
				    <div class="caption">
				        <h3>Contact</h3>
				        <p>Contact us and set up a meeting now!</p>
		        		<p><a href="#" class="btn btn-primary" role="button">Contact</a></p>
		    		</div>
		    	</div>
			</div>
		</div>
	</div>
@stop