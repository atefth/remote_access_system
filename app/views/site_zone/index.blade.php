@extends('layout')

@section('content')
<div class="panel">
	<ul class="nav nav-pills">
	  <li <?php if ($tab == 'sites') {
	   echo 'class="active"';
	   } ?>>
	  	<a href="<?php echo '/site/'.$site->id; ?>">Details</a>
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
{{ Form::open(array('url' => 'siteZone/update', 'method' => 'post')) }}
<div class="panel panel-primary">
	<!-- Default panel contents -->	
	<div class="panel-heading"> {{ $site->name }} Site Allocation</div>
	<div class="panel-body">
		{{ Form::hidden('site_id', $site->id) }}
		<table class="table table-striped table-bordered">
			<tr>
				<thead>
					<th>Zone</th>
					<th>Status</th>
					<th>Actions</th>
				</thead>
				<tbody>					
					@foreach ($zones as $zone)
						<tr>
							<td>{{ $zone->name }}</td>
							<td>
								@if($site->Zone && $site->Zone->name == $zone->name)
									<span class="glyphicon glyphicon-ok"> Assigned</span>
								@else
									<span class="glyphicon glyphicon-remove"> Unassigned</span>
								@endif
							</td>
							<td>
								@if ($site->Zone && $site->Zone->name == $zone->name)
									{{ Form::label('selected_zone', 'Unassign') }}
								@else
									{{ Form::label('selected_zone', 'Assign') }}
								@endif
								{{ Form::radio('selected_zone', $zone->id) }}</td>
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