@extends('layout')

@section('content')
<div class="panel panel-primary">
	<!-- Default panel contents -->
	<div class="panel-heading">All Users</div>
	<div class="panel-body">
  		<p>Listing all users registered</p>
	</div>

	<!-- Table -->
	@if ($users->count())
		<table class="table table-striped table-bordered">
			<thead>
			    <tr>
			    	<th>Actions</th>
			        <th>Name</th>
			        <th>Phone</th>
			        <th>Address</th>
			        <th>Site ID</th>
			        <th>RFID</th>
			        <th>Access</th>
			    </tr>
			</thead>

			<tbody>
			    @foreach ($users as $user)
			        <tr>
			        	<td><a href="/user/<?= $user->rfid ?>/edit" class="btn btn-info"><span class="glyphicon glyphicon-minus"></span> Edit</a></td>							
			            <td>{{ $user->f_name }} {{ $user->l_name }}</td>
				        <td>{{ $user->phone }}</td>
				        <td>{{ $user->address }}</td>
				        <td>{{ $user->site_id }}</td>
				        <td>{{ $user->rfid }}</td>
				        <td>
				        	@if ($user->has_access)
				        		Granted
				        	@else
				        		Denied
				        	@endif
				        </td>
			        </tr>
			    @endforeach
			      
			</tbody>

		</table>
	@else
		<div class="panel-body">
	  		<p>No users exist.</p>
	  	</div>			
	@endif
	<div class="panel-footer">
		<div class="panel-body">
	  		<a href="/user/create" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus"></span> Add User</a>
	  	</div>	
	</div>
</div>				
@stop