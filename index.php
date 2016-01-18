<?php
/*
 *Author: Alex Ball
 *Date: 01/05/2016
 *
 *This website is a prototype for the beehive project. This project involves
 *a website that allows beekeepers to submit data about the number of mites
 *in their beehives so that Danny Najera can review this data to support the
 *theory that mites are the biggest threat to bees.
 *
 */

//testing github with this comment

//errorArray starts empty. errors will be added if something is wrong.
$errorArray = array();

//check for errors in the GET array.
if (!empty($_GET['emptyHiveName']))
{
	$errorArray['miteFormHiveName'] = '<p class="form-error">Hive Name cannot be empty!</p>';
}

if (!empty($_GET['emptyObsDate']))
{
	$errorArray['miteFormObservationDate'] = '<p class="form-error">Observation Date cannot be empty!</p>';
}

if (!empty($_GET['emptyDuration']))
{
	$errorArray['miteFormDuration'] = '<p class="form-error">Duration of Observation cannot be empty!</p>';
}

if (!empty($_GET['emptyMiteCount']))
{
	$errorArray['miteFormMiteCount'] = '<p class="form-error">Mite Count cannot be empty!</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		
		<meta name="author" content="Alex Ball">
		
		<title>Beehive Prototype Home</title>
		
		<!-- Bootstrap -->
		<link href="../../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<!-- Heading Area -->
					<h1>Beehive Mite Count Form</h1>
					<h3>All fields are required.</h3>
					<?php
					//print errors if any
					foreach($errorArray as $error)
					{
						print $error;
					}
					
					/*
					print empty($errorArray['miteFormHiveName']) ? '' : $errorArray['miteFormHiveName'];
					print empty($errorArray['miteFormObservationDate']) ? '' : $errorArray['miteFormObservationDate'];
					print empty($errorArray['miteFormDuration']) ? '' : $errorArray['miteFormDuration'];
					print empty($errorArray['miteFormMiteCount']) ? '' : $errorArray['miteFormMiteCount'];
					*/
					?>
					<!-- End Heading Area -->
					
					<!-- Form Area -->
					<form method="post" action="record.php">
						<!-- Hive ID -->
						<label for="miteFormHiveName">Hive Name:
							<input type="text" id="miteFormHiveName" name="miteFormHiveName"
										placeholder="Hive Name" >
						</label>
						
						<br />
						<br />
						
						<!-- Sample Date -->
						<label for="miteFormObservationDate">Observation Date:
							<input type="date" id="miteFormObservationDate" name="miteFormObservationDate"
										placeholder="yyyy-mm-dd" >
						</label>
						
						<br />
						<br />
						
						<!-- Sample Period -->
						<label for="miteFormDuration">Duration of Observation:
							<input type="number" min="0" id="miteFormDuration" name="miteFormDuration"
										placeholder="Duration of Observation" > Days
						</label>
						
						<br />
						<br />
						
						<!-- Mite Count -->
						<label for="miteFormMiteCount">Mite Count:
							<input type="number" min="0" id="miteFormMiteCount" name="miteFormMiteCount"
										placeholder="Mite Count" > Mites
						</label>
						
						<br />
						<br />
						
						<!-- Submit Button -->
						<button type="submit" id="submit" name="submit" value='submit'>Submit</button>
					</form>
					<!-- End Form Area -->
				</div>
			</div>
		</div>
	</body>
</html>
