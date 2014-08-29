@extends('layout')

@section('content')
	<div class="row-fluid span10 offset1">
    	<div class="hero-unit col-centered">
    		<h1>Use this menu to control switches at the remote site</h1> 
    		<div class="well">
    			<?php 
    			if(!$status[0]) {
			    	echo '<a href="/turnOnSwitch/1">
			    		<button class="btn btn-success" style="margin-left:125px;" type="button">Turn on Door</button>
			    	</a>';
		    	}else{
		    		echo '<a href="/turnOffSwitch/1">
			    		<button class="btn btn-danger" style="margin-left:125px;" type="button">Turn off Door</button>
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
	    </div>
    </div>
@stop