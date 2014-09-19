@extends('layout')

@section('content')
<div class="panel">
	<ul class="nav nav-pills">
	  <li <?php if ($tab == 'list') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="/zone">List All</a>
	  </li>
	  <li <?php if ($tab == 'zones') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/zones/'.$zone->id; ?>">Details</a>
	  </li>
	  <li <?php if ($tab == 'access') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/zoneUser/'.$zone->id; ?>">Access Rights</a>
	  </li>
	  <li <?php if ($tab == 'manage') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/zoneSite/'.$zone->id; ?>">Manage Sites</a>
	  </li>
	</ul>
</div>
<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">Current Switch Status</div>
	<div class="panel-body">
		<?php 
		if(!$status[0]) {
	    	echo '<a href="/zone/onCommand/'.$zone->id.'/0">
	    		<button class="btn btn-success" style="margin-left:15%;" type="button">Open Door</button>
	    	</a>';
    	}else{
    		echo '<a href="/zone/offCommand/'.$zone->id.'/0">
	    		<button class="btn btn-danger" style="margin-left:15%;" type="button">Close Door</button>
	    	</a>';
    	}
    	?>
    	<?php 
		if(!$status[1]) {
	    	echo '<a href="/zone/onCommand/'.$zone->id.'/1">
	    		<button class="btn btn-success" type="button">Turn on Lights</button>
	    	</a>';
    	}else{
    		echo '<a href="/zone/offCommand/'.$zone->id.'/1">
	    		<button class="btn btn-danger" type="button">Turn off Lights</button>
	    	</a>';
    	}
    	?><?php 
		if(!$status[2]) {
	    	echo '<a href="/zone/onCommand/'.$zone->id.'/2">
	    		<button class="btn btn-success" type="button">Turn on Alarm</button>
	    	</a>';
    	}else{
    		echo '<a href="/zone/offCommand/'.$zone->id.'/2">
	    		<button class="btn btn-danger" type="button">Turn off Alarm</button>
	    	</a>';
    	}
    	?><?php 
		if(!$status[3]) {
	    	echo '<a href="/zone/onCommand/'.$zone->id.'/3">
	    		<button class="btn btn-success" type="button">Turn on Generator</button>
	    	</a>';
    	}else{
    		echo '<a href="/zone/offCommand/'.$zone->id.'/3">
	    		<button class="btn btn-danger" type="button">Turn off Generator</button>
	    	</a>';
    	}
    	?><?php 
		if(!$status[4]) {
	    	echo '<a href="/zone/onCommand/'.$zone->id.'/4">
	    		<button class="btn btn-success" type="button">Turn on AC</button>
	    	</a>';
    	}else{
    		echo '<a href="/zone/offCommand/'.$zone->id.'/4">
	    		<button class="btn btn-danger" type="button">Turn off AC</button>
	    	</a>';
    	}
    	?><?php 
		if(!$status[5]) {
	    	echo '<a href="/zone/onCommand/'.$zone->id.'/5">
	    		<button class="btn btn-success" type="button">Turn on Mains</button>
	    	</a>';
    	}else{
    		echo '<a href="/zone/offCommand/'.$zone->id.'/5">
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