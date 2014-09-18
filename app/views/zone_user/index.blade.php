@extends('layout')

@section('content')
<div class="panel">
	<ul class="nav nav-pills">
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
	  	<a href="<?php echo '/zoneSite/'.$zone->id; ?>">Manage Sites</a>
	  </li>
	</ul>
</div>
{{ Form::open(array('url' => 'zoneUser/update', 'method' => 'post')) }}
<div class="panel panel-primary">
	<!-- Default panel contents -->	
	<div class="panel-heading"> {{ $zone->name }} Zone Access Rights</div>
	<div class="panel-body">
		{{ Form::hidden('zone_id', $zone->id) }}
		<table class="table table-striped table-bordered">
			<tr>
				<thead>
					<th>User</th>
					<th>Access</th>
					<th>Actions</th>
				</thead>
				<tbody>					
					@foreach ($users as $user)
						<tr>
							<td>{{ $user->f_name . ' ' . $user->l_name}}</td>
							<td>
								@if($zone->GivesAccessToUser($user->rfid) == 'Granted')
									<span class="glyphicon glyphicon-ok"> Granted</span>
								@else
									<span class="glyphicon glyphicon-remove"> Denied</span>
								@endif
							</td>
							<td>
								@if ($zone->GivesAccessToUser($user->rfid) == 'Denied')
									{{ Form::label('user_access_'.$user->rfid, 'Grant') }}
								@else
									{{ Form::label('user_access_'.$user->rfid, 'Deny') }}
								@endif
								{{ Form::checkbox('user_access_'.$user->rfid, 1) }}</td>
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