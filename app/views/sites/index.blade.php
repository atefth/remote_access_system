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
			        <th>Site Name</th>
			        <th>Zone Name</th>
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
			            	@if ($site->Zone)
			            		{{ $site->Zone->name }}
			            	@else
			            		Not Zoned Yet
			            	@endif
			            </td>
				        <td>
							@if ($status['site_'.$site->id.'_status_0'] == 'False')
						    	<a href="/site/onCommand/{{ $site->id }}/0">
						    		<button class="btn btn-success" style="margin-left:15%;" type="button">Open</button>
						    	</a>
					    	@else
					    		<a href="/site/offCommand/{{ $site->id }}/0">
						    		<button class="btn btn-danger" style="margin-left:15%;" type="button">Close</button>
						    	</a>
					    	@endif
				    	</td>
				    	<td>
					    	@if ($status['site_'.$site->id.'_status_1'] == 'False')
						    	<a href="/site/onCommand/{{ $site->id }}/1">
						    		<button class="btn btn-success" type="button">On</button>
						    	</a>
					    	@else
					    		<a href="/site/offCommand/{{ $site->id }}/1">
						    		<button class="btn btn-danger" type="button">Off</button>
						    	</a>
					    	@endif
				    	</td>
				    	<td>
							@if ($status['site_'.$site->id.'_status_2'] == 'False')
						    	<a href="/site/onCommand/{{ $site->id }}/2">
						    		<button class="btn btn-success" type="button">On</button>
						    	</a>
					    	@else
					    		<a href="/site/offCommand/{{ $site->id }}/2">
						    		<button class="btn btn-danger" type="button">Off</button>
						    	</a>
					    	@endif
				    	</td>
				    	<td>
							@if ($status['site_'.$site->id.'_status_3'] == 'False')
						    	<a href="/site/onCommand/{{ $site->id }}/3">
						    		<button class="btn btn-success" type="button">On</button>
						    	</a>
					    	@else
					    		<a href="/site/offCommand/{{ $site->id }}/3">
						    		<button class="btn btn-danger" type="button">Off</button>
						    	</a>
					    	@endif
				    	</td>
				    	<td>
							@if ($status['site_'.$site->id.'_status_4'] == 'False')
						    	<a href="/site/onCommand/{{ $site->id }}/4">
						    		<button class="btn btn-success" type="button">On</button>
						    	</a>
					    	@else
					    		<a href="/site/offCommand/{{ $site->id }}/4">
						    		<button class="btn btn-danger" type="button">Off</button>
						    	</a>
					    	@endif
				    	</td>
				    	<td>
							@if ($status['site_'.$site->id.'_status_5'] == 'False')
						    	<a href="/site/onCommand/{{ $site->id }}/5">
						    		<button class="btn btn-success" type="button">On</button>
						    	</a>
					    	@else
					    		<a href="/site/offCommand/{{ $site->id }}/5">
						    		<button class="btn btn-danger" type="button">Off</button>
						    	</a>
					    	@endif
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