<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Demo Pilot</title>

    <!-- Referencing Bootstrap CSS that is hosted locally -->
    {{ HTML::style('css/bootstrap.min.css') }}
    {{ HTML::style('custom.css') }}
    @if ($page == 'reports')
    	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    	<script type="text/javascript">
    	google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(defaultReport);
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
		// defaultReport();
		
		function defaultReport () {
			currentReport = [['Day', 'Door', 'Lights', 'Alarm', 'Generator', 'AC', 'Mains', 'Average']];
			for (var i = 0; i < limit; i++) {
				if (i < reports.length) {
					currentReport[currentReport.length] = reports[i];
					index = i;
				}
			}
			drawVisualization();
		}


		function prev () {
			currentReport = [['Day', 'Door', 'Lights', 'Alarm', 'Generator', 'AC', 'Mains', 'Average']];
			var pointer = index;
			for (var i = 0; i < limit; i++) {
				pointer = (Math.abs(index-i))%reports.length;
				if (i < reports.length) {
					currentReport[currentReport.length] = reports[pointer];
					index--;
				}
			}
			drawVisualization();
		 }

		function next () {
			currentReport = [['Day', 'Door', 'Lights', 'Alarm', 'Generator', 'AC', 'Mains', 'Average']];
			var pointer = index;
			for (var i = 0; i < limit; i++) {
				pointer = (index+i)%reports.length;
				if (i < reports.length) {
					currentReport[currentReport.length] = reports[pointer];
					index++;
				}
			}
			drawVisualization();
		 }

		function drawVisualization() {
			console.log(currentReport);
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
    </script>
    @endif
  </head>
    <body>
    	<div class="row-fluid container">
	        <div class="navbar well">
			  <div class="navbar-inner">
			    <ul class="nav nav-pills">
			    	<li><a href="#">Demo Pilot Project Robi Remote Access Control</a></li>
				  <li <?php if($page == 'home') echo 'class="active"' ?>>
				    <a href="/">Home</a>
				  </li>
				  <li <?php if($page == 'control') echo 'class="active"' ?>>
				  	<a href="/control">Control</a>
				  </li>
				  <li <?php if($page == 'log') echo 'class="active"' ?>>
				  	<a href="/records">Log</a>
				  </li>
				  <li <?php if($page == 'log') echo 'class="active"' ?>>
				  	<a href="/reports">Log</a>
				  </li>
				</ul>
			  </div>
			</div>
			@yield('content')
			<div class="span8 offset4 well text-center">&#169; 2014 SoftBot Systems</div>
		</div>
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>

    	<!-- Referencing Bootstrap JS that is hosted locally -->
    	{{ HTML::script('js/bootstrap.min.js') }}
        
    </body>
</html>