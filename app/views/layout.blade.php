<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RAS</title>

    <!-- Referencing Bootstrap CSS that is hosted locally -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('custom.css') }}
    @if (Auth::admin()->check())

	    @if ($page == 'reports')
	    	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    	<script type="text/javascript">
	    	google.load("visualization", "1", {packages:["corechart"]});
			google.setOnLoadCallback(<?php if ($graph == 'combo') {
				echo "defaultCombo";
			}else{
				echo "defaultPie";
			} ?>);
			var index = 0;
			var limit = 5;
			var currentReport;

			var reports = [<?php		  	
		  	for ($i=0; $i < sizeof($reports); $i++) {
		  		echo $reports[$i];
		  		if ($i < sizeof($reports) - 1) {
		  			echo ',';
		  		}
		  	} echo '];'?>

			function defaultCombo () {
				currentReport = [['Day', 'Door', 'Lights', 'Alarm', 'Generator', 'AC', 'Mains', 'Average']];
				for (var i = 0; i < limit; i++) {
					if (i < reports.length) {
						currentReport[currentReport.length] = reports[i];
						index = i;
					}
				}
				drawComboVisualization();
			}

			function defaultPie () {
				currentReport = [['Switch', 'Hits per Month']];
				for (var i = 0; i < limit; i++) {
					if (i < reports.length) {
						currentReport[currentReport.length] = reports[i];
						index = i;
					}
				}
				drawPieVisualization();
			}


			function prevCombo () {
				currentReport = [['Day', 'Door', 'Lights', 'Alarm', 'Generator', 'AC', 'Mains', 'Average']];
				if (index - limit > 0) {
					index = index-limit;
					for (var i = 0; i < limit; i++) {
						if (index + i < reports.length) {
							currentReport[currentReport.length] = reports[index+1];
							index++;
						}
					}
					drawComboVisualization();
				};
			 }

			function nextCombo () {
				currentReport = [['Day', 'Door', 'Lights', 'Alarm', 'Generator', 'AC', 'Mains', 'Average']];
				if (index + limit < reports.length) {
					for (var i = 0; i < limit; i++) {
						if (index + i < reports.length) {
							currentReport[currentReport.length] = reports[index+1];
							index++;
						}
					}
					drawComboVisualization();
				};
			 }

			function prevPie () {
				currentReport = [['Switch', 'Hits per Month']];
				if (index - limit > 0) {
					index = index - limit;
					for (var i = 0; i < limit; i++) {
						if (index + i < reports.length) {
							currentReport[currentReport.length] = reports[index+1];
							index++;
						}
					}
					drawPieVisualization();
				};
			 }

			function nextPie () {
				currentReport = [['Switch', 'Hits per Month']];
				if (index + limit < reports.length) {
					for (var i = 0; i < limit; i++) {
						if (index + i < reports.length) {
							currentReport[currentReport.length] = reports[index+1];
							index++;
						}
					}
					drawPieVisualization();
				};
			 }

			function drawComboVisualization() {
			  // Some raw data (not necessarily accurate)
			  var graph = google.visualization.arrayToDataTable(currentReport);

			  var options = {
			    title : 'Daily Updates from Central Server',
			    vAxis: {title: "Activity"},
			    hAxis: {title: "Day"},
			    seriesType: "bars",
			    series: {5: {type: "line"}}
			  };

			  var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
			  chart.draw(graph, options);
			}

			function drawPieVisualization() {

	        var data = google.visualization.arrayToDataTable(currentReport);

	        var options = {
	          title: 'Monthly Hits'
	        };

	        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));

	        chart.draw(data, options);
	      }
	    </script>
	    @endif
    @endif
  </head>
    <body>
    	<div class="row-fluid container">
    		
    		@if (Auth::admin()->check())
		        <div class="navbar well">
				  <div class="navbar-inner">
				    <ul class="nav nav-pills">
				    	<li><a href="http://softbotsys.herokuapp.com">SoftBot RAS</a></li>
					  <li <?php if($page == 'home') echo 'class="active"' ?>>
					    <a href="/home"><span class="glyphicon glyphicon-home"></span> Home</a>
					  </li>
					  <li <?php if($page == 'sites') echo 'class="active"' ?>>
					  	<a href="/site"><span class="glyphicon glyphicon-record"></span> Sites</a>
					  </li>
					  <li <?php if($page == 'zones') echo 'class="active"' ?>>
					  	<a href="/zone"><span class="glyphicon glyphicon-th-large"></span> Zones</a>
					  </li>
					  <li <?php if($page == 'log') echo 'class="active"' ?>>
					  	<a href="/records"><span class="glyphicon glyphicon-list-alt"></span> Log</a>
					  </li>
					  <li <?php if($page == 'reports') echo 'class="active"' ?>>
					  	<a href="/combo"><span class="glyphicon glyphicon-stats"></span> Reports</a>
					  </li>
					  <li <?php if($page == 'users') echo 'class="active"' ?>>
					  	<a href="/user"><span class="glyphicon glyphicon-user"></span> Users</a>
					  </li>
					  <li>
					  	<a href="/login/logout" style="margin-left:80%;"><span class="glyphicon glyphicon-off"></span> Logout</a>
					  </li>
					</ul>
				  </div>
				</div>
			@else
				<div class="navbar well">
				  <div class="navbar-inner">
				    <ul class="nav nav-pills">
				    	<li class="active"><a href="#">SoftBot Remote Access System</a></li>
					  <li style="margin-left: 70%;">
			  			<!-- Button trigger modal -->
						<a href="" data-toggle="modal" data-target="#myModal">
							Enter
						</a>
					  </li>
					</ul>
				  </div>
				</div>
			@endif
				@yield('content')
				<div class="span8 offset4 well text-center">&#169; 2014 SoftBot Systems</div>			
		</div>			
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    	<!-- Referencing Bootstrap JS that is hosted locally -->
    	{{ HTML::script('js/bootstrap.min.js') }}
        
    </body>
</html>