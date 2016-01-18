<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		<meta name="author" content="Alex Ball">
		
		<title>Beehive Prototype Admin Page</title>
		
		<!-- Bootstrap -->
		<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<!-- Datatable -->
		<link href="http://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet" type="text/css">
		
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<h1>Bee Data Admin Table</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<a href="beeDataExcelSheet.xlsx" class="btn btn-primary">Download Table as an Excel sheet</a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<table class="table table-bordered" id="bee-data-table">
						<thead>
							<tr>
								<th>Hive Name</th>
								<th>Observation Date</th>
								<th>Duration</th>
								<th>Mite Count</th>
							</tr>
						</thead>
						<?php
						foreach ($resultRows as $row) {
							echo '<tr>';
							echo '<td>', $row['hive_name'], '</td>';
							echo '<td>', $row['observation_date'], '</td>';
							echo '<td>', $row['duration'], '</td>';
							echo '<td>', $row['mite_count'], '</td>';
							echo '</tr>';
						}
						?>
						<tfoot>
							<tr>
								<th>Hive Name</th>
								<th>Observation Date</th>
								<th>Duration</th>
								<th>Mite Count</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="https://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../../bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Datatable -->
		<script src="https://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/plug-ins/3cfcc339e89/integration/bootstrap/3/dataTables.bootstrap.js"
					type="text/javascript"></script>
		
		<script>
			$(document).ready(function(){
				$('#bee-data-table').DataTable({
					scrollX: true, //adds horizontal scrollbar
					stateSave: true, //so that table remembers which column was sorted/search terms
					"order": [[ 1, "desc" ]] //default sort; 1, desc is reverse order by observation date
				});
			});
		</script>
	</body>
</html>