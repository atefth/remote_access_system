@extends('layout')

@section('content')
	{{ Form::open(array('url' => 'user/updatePermissions', 'method' => 'post')) }}
	<div class="panel panel-primary">
		<!-- Default panel contents -->
		<div class="panel-heading">All Privileges</div>
		<div class="panel-body">
	  		<p>Listing All User Privileges for {{ $user->f_name }} {{ $user->l_name }} </p>
		</div>
		{{ Form::hidden('rfid', $user->rfid) }}
		@if ($sites->count() || $zones->count())
			<div class="panel-body">
				@if ($zones->count())
					<!-- Table -->
					<table class="table table-striped table-bordered">
						<thead>
						    <tr>
						        <th>Zone Name</th>
						        <th>Access</th>
						        <th>Actions</th>
						    </tr>
						</thead>
						<tbody>
						    @foreach ($zones as $zone)
						        <tr>
						            <td>{{ $zone->name }}</td>
						            <td>
						        		@if ($zone->GivesAccessToUser($user->rfid) == 'Granted')
											<span class="glyphicon glyphicon-ok"> Granted
										@else
											<span class="glyphicon glyphicon-remove"> Denied
										@endif
						        	</td>
							        <td>
						        		@if ($zone->GivesAccessToUser($user->rfid) == 'Granted')
											{{ Form::label('selected_zone_'.$zone->id, 'Unassign') }}
										@else
											{{ Form::label('selected_zone_'.$zone->id, 'Assign') }}
										@endif
										{{ Form::checkbox('selected_zone_'.$zone->id, 1) }}
						        	</td>
						        </tr>
						    @endforeach			      
						</tbody>
					</table>
				@endif
			</div>
			<div class="panel-body">
				@if ($sites->count())
					<!-- Table -->
					<table class="table table-striped table-bordered">
						<thead>
						    <tr>
						        <th>Site Name</th>
						        <th>Access</th>
						        <th>Actions</th>
						    </tr>
						</thead>
						<tbody>
						    @foreach ($sites as $site)
						        <tr>
						            <td>{{ $site->name }}</td>
						            <td>
						        		@if ($site->GivesAccessToUser($user->rfid) == 'Granted')
											<span class="glyphicon glyphicon-ok"> Granted
										@else
											<span class="glyphicon glyphicon-remove"> Denied
										@endif
						        	</td>
							        <td>
						        		@if ($site->GivesAccessToUser($user->rfid) == 'Granted')
											{{ Form::label('selected_site_'.$site->id, 'Unassign') }}
										@else
											{{ Form::label('selected_site_'.$site->id, 'Assign') }}
										@endif
										{{ Form::checkbox('selected_site_'.$site->id, 1) }}
						        	</td>
						        </tr>
						    @endforeach			      
						</tbody>
					</table>
				@endif
			</div>
		@else
			<div class="panel-body">
		  		<p>No Sites or Zones exist.</p>
		  	</div>			
		@endif
		<div class="panel-footer">
			<div class="panel-body">
		  		{{ Form::submit('Update Privileges', array('class' => 'btn btn-success')) }}
		  	</div>	
		</div>
	</div>
	{{ Form::close() }}
@stop