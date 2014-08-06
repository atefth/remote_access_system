<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo Pilot</title>

    <!-- Referencing Bootstrap CSS that is hosted locally -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('custom.css') }}
  </head>
    <body>
    	<div class="row-fluid container">
	        <div class="navbar well">
			  <div class="navbar-inner">
			    <ul class="nav nav-pills">
			    	<li><a href="#">Demo Pilot Project Robi Remote Access Control</a></li>
				  <li <?php if($page == 'home') echo 'class="active"' ?>>
				    <a href="/">Home</a>
				  </li>
				  <li <?php if($page == 'control') echo 'class="active"' ?>>
				  	<a href="/control">Control</a>
				  </li>
				  <li <?php if($page == 'log') echo 'class="active"' ?>>
				  	<a href="/records">Log</a>
				  </li>
				</ul>
			  </div>
			</div>
			@yield('content')
			<div class="span8 offset4 well text-center">&#169; 2014 SoftBot Systems</div>
		</div>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    	<!-- Referencing Bootstrap JS that is hosted locally -->
    	{{ HTML::script('js/bootstrap.min.js') }}
        
    </body>
</html>