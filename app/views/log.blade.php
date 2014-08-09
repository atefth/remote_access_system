@extends('layout')

@section('content')
    <div class="row-fluid span10 offset1">
    	<div class="hero-unit col-centered">
    		<h1>Use this menu to view logs generated from the remote site</h1> 
    		<div class="well">
		    	@if ($records->count())
		    		 <table class="table table-striped table-bordered">
				        <thead>
				            <tr>
				                <th>Site ID</th>
						        <th>RFID</th>
						        <th>Switch</th>
						        <th>Status</th>
						        <th>Command</th>
						        <th>Time at Site</th>
						        <th>Time at Server</th>
				            </tr>
				        </thead>

				        <tbody>
				            @foreach ($records as $record)
				                <tr>
				                    <td>{{ $record->site_id }}</td>
							        <td>{{ $record->rfid }}</td>
							        <td>{{ $record->switch }}</td>
							        <td>{{ $record->status }}</td>
							        <td>{{ $record->command }}</td>
							        <td>{{ $record->created_at }}</td>
							        <td>{{ $record->updated_at }}</td>
				                </tr>
				            @endforeach
				              
				        </tbody>
				      
				    </table>
				@else
				    There are no logs
				@endif
	    	</div>
	    </div>
    </div>
@stop