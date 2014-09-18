@extends('layout')

@section('content')

<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">All Sites</div>
	<div class="panel-body">
  		<p>Listing All Sites Registered</p>
	</div>

	<!-- Table -->
	@if ($sites->count())
		<table class="table table-striped table-bordered">
			<thead>
			    <tr>
			    	<th>Actions</th>
			        <th>Name</th>
			        <th>Door</th>
			        <th>Light</th>
			        <th>Alarm</th>
			        <th>Generator</th>
			        <th>AC</th>
			        <th>Mains</th>
			    </tr>
			</thead>

			<tbody>
			    @foreach ($sites as $site)
			        <tr>
			        	<td>
			        		<a href="/site/<?= $site->id ?>/edit" class="btn btn-info"><span class="glyphicon glyphicon-minus"></span> Edit</a>
			        		<a href="/site/<?= $site->id ?>" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> Details</a>
			        	</td>							
			            <td>{{ $site->name }}</td>
				        <td>
				        	<a href="/turnOnSwitch/1">
					    		<button class="btn btn-success" type="button">Open</button>
					    	</a>
			    		</td>
				        <td>
				        	<a href="/turnOnSwitch/2">
					    		<button class="btn btn-success" type="button">Turn On</button>
					    	</a>
					    </td>
				        <td>
				        	<a href="/turnOnSwitch/3">
					    		<button class="btn btn-success" type="button">Turn On</button>
					    	</a>
					    </td>
				        <td>
				        	<a href="/turnOnSwitch/4">
					    		<button class="btn btn-success" type="button">Turn On</button>
					    	</a>
				        </td>
				        <td>
				        	<a href="/turnOnSwitch/5">
					    		<button class="btn btn-success" type="button">Turn On</button>
					    	</a>
				        </td>
				        <td>
				        	<a href="/turnOnSwitch/6">
					    		<button class="btn btn-success" type="button">Turn On</button>
					    	</a>
				        </td>
			        </tr>
			    @endforeach
			      
			</tbody>

		</table>
	@else
		<div class="panel-body">
	  		<p>No sites exist.</p>
	  	</div>			
	@endif
	<div class="panel-footer">
		<div class="panel-body">
	  		<a href="/site/create" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus"></span> Add Site</a>
	  	</div>	
	</div>
</div>		

@stop