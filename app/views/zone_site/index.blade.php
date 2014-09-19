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
	  	<a href="<?php echo '/zone/'.$zone->id; ?>">Details</a>
	  </li>
	  <li <?php if ($tab == 'access') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/zoneUser/'.$zone->id; ?>">Access Rights</a>
	  </li>
	  <li <?php if ($tab == 'manage') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/zoneSite/'.$zone->id; ?>">Manage zones</a>
	  </li>
	</ul>
</div>
{{ Form::open(array('url' => 'zoneSite/update', 'method' => 'post')) }}
<div class="panel panel-primary">
	<!-- Default panel contents -->	
	<div class="panel-heading"> {{ $zone->name }} Zone Allocation</div>
	<div class="panel-body">
		{{ Form::hidden('zone_id', $zone->id) }}
		<table class="table table-striped table-bordered">
			<tr>
				<thead>
					<th>Site Name</th>
					<th>Zone Name</th>
					<th>Status</th>
					<th>Actions</th>
				</thead>
				<tbody>					
					@foreach ($sites as $site)
						<tr>
							<td>{{ $site->name }}</td>
							<td>
				            	@if ($site->Zone)
				            		{{ $site->Zone->name }}
				            	@else
				            		Not Zoned Yet
				            	@endif
				            </td>
							<td>
								@if($site->Zone && $site->Zone->name == $zone->name)
									<span class="glyphicon glyphicon-ok"> Assigned</span>
								@else
									<span class="glyphicon glyphicon-remove"> Unassigned</span>
								@endif
							</td>
							<td>
								@if ($site->Zone && $site->Zone->name == $zone->name)
									{{ Form::label('selected_sites_'.$site->id, 'Unassign') }}
								@else
									{{ Form::label('selected_sites_'.$site->id, 'Assign') }}
								@endif
								{{ Form::checkbox('selected_sites_'.$site->id, 1) }}
							</td>
						</tr>
					@endforeach
				</tbody>
			</tr>
		</table>		
	</div>
	<div class="panel-footer">
		<div class="panel-body">
	  		{{ Form::submit('Update Privileges', array('class' => 'btn btn-success')) }}
	  	</div>	
	</div>
</div>
{{ Form::close() }}
@stop