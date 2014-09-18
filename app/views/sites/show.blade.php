@extends('layout')

@section('content')
<div class="panel">
	<ul class="nav nav-pills">
	  <li <?php if ($tab == 'sites') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/sites/'.$site->id; ?>">Details</a>
	  </li>
	  <li <?php if ($tab == 'access') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/siteUser/'.$site->id; ?>">Access Rights</a>
	  </li>
	  <li <?php if ($tab == 'manage') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/siteZone/'.$site->id; ?>">Manage Zones</a>
	  </li>
	</ul>
</div>
<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">Current Switch Status</div>
	<div class="panel-body">
		<?php 
		if(!$status[0]) {
	    	echo '<a href="/turnOnSwitch/1">
	    		<button class="btn btn-success" style="margin-left:15%;" type="button">Open Door</button>
	    	</a>';
    	}else{
    		echo '<a href="/turnOffSwitch/1">
	    		<button class="btn btn-danger" style="margin-left:15%;" type="button">Close Door</button>
	    	</a>';
    	}
    	?>
    	<?php 
		if(!$status[1]) {
	    	echo '<a href="/turnOnSwitch/2">
	    		<button class="btn btn-success" type="button">Turn on Lights</button>
	    	</a>';
    	}else{
    		echo '<a href="/turnOffSwitch/2">
	    		<button class="btn btn-danger" type="button">Turn off Lights</button>
	    	</a>';
    	}
    	?><?php 
		if(!$status[2]) {
	    	echo '<a href="/turnOnSwitch/3">
	    		<button class="btn btn-success" type="button">Turn on Alarm</button>
	    	</a>';
    	}else{
    		echo '<a href="/turnOffSwitch/3">
	    		<button class="btn btn-danger" type="button">Turn off Alarm</button>
	    	</a>';
    	}
    	?><?php 
		if(!$status[3]) {
	    	echo '<a href="/turnOnSwitch/4">
	    		<button class="btn btn-success" type="button">Turn on Generator</button>
	    	</a>';
    	}else{
    		echo '<a href="/turnOffSwitch/4">
	    		<button class="btn btn-danger" type="button">Turn off Generator</button>
	    	</a>';
    	}
    	?><?php 
		if(!$status[4]) {
	    	echo '<a href="/turnOnSwitch/5">
	    		<button class="btn btn-success" type="button">Turn on AC</button>
	    	</a>';
    	}else{
    		echo '<a href="/turnOffSwitch/5">
	    		<button class="btn btn-danger" type="button">Turn off AC</button>
	    	</a>';
    	}
    	?><?php 
		if(!$status[5]) {
	    	echo '<a href="/turnOnSwitch/6">
	    		<button class="btn btn-success" type="button">Turn on Mains</button>
	    	</a>';
    	}else{
    		echo '<a href="/turnOffSwitch/6">
	    		<button class="btn btn-danger" type="button">Turn off Mains</button>
	    	</a>';
    	}
    	?>
	</div>
	<div class="panel-footer">
		<div class="panel-body">
	  		
	  	</div>	
	</div>
</div>
@stop