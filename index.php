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

$miteFormHiveID = '';
$miteFormSampleDate = '';
$miteFormSamplePeriod = '';
$miteFormMiteCount = '';

//validate data when the form is submitted.
if (isset($_POST['submit']))
{
	//check for empty fields. add errors for any empty fields.
	if (empty($_POST['miteFormHiveID']))
	{
		$errorArray['miteFormHiveID'] = '<p class="form-error">Hive Name cannot be empty!</p>';
	}
	else
	{
		$miteFormHiveID = $_POST['miteFormHiveID'];
	}
	
	if (empty($_POST['miteFormSampleDate']))
	{
		$errorArray['miteFormSampleDate'] = '<p class="form-error">Sample Date cannot be empty!</p>';
	}
	else
	{
		$miteFormSampleDate = $_POST['miteFormSampleDate'];
	}
	
	if (empty($_POST['miteFormSamplePeriod']))
	{
		$errorArray['miteFormSamplePeriod'] = '<p class="form-error">Sample Period cannot be empty!</p>';
	}
	else
	{
		$miteFormSamplePeriod = $_POST['miteFormSamplePeriod'];
	}
	
	if (empty($_POST['miteFormMiteCount']))
	{
		$errorArray['miteFormMiteCount'] = '<p class="form-error">Mite Count cannot be empty!</p>';
	}
	else
	{
		$miteFormMiteCount = $_POST['miteFormMiteCount'];
	}

	//if data is valid, save it to the database and redirect to successful submission page.
	if (empty($errorArray))
	{
		//get database connection called $beeDBConnection
		require('/home/alexb/secure-includes/bee-db-connection.php');
		
		/*
		//escape data to help prevent sql injection
		$miteFormHiveID = mysqli_real_escape_string($beeDBConnection, $miteFormHiveID);
		$miteFormSampleDate = mysqli_real_escape_string($beeDBConnection, $miteFormSampleDate);
		$miteFormSamplePeriod = mysqli_real_escape_string($beeDBConnection, $miteFormSamplePeriod);
		$miteFormMiteCount = mysqli_real_escape_string($beeDBConnection, $miteFormMiteCount);
		*/
		
		//get access to the data model
		require ('models/bee-data-model.php');
		
		//create instance of data model
		$dataModel = new BeeDataModel($beeDBConnection);
		
		//insert row
		$results = $dataModel->insertOneRow($miteFormHiveID, $miteFormSampleDate, $miteFormSamplePeriod, $miteFormMiteCount);
		
		//$results = mysqli_query($beeDBConnection, $sql);
		
		//if successful, redirect to successful submission page.
		if ($results)
		{
			header('location:successful-submission.php');
		}
		//otherwise, add an error saying something went wrong.
		else
		{
			$errorArray['databaseError'] = '<p class="form-error">Error submitting to database.</p>';
		}
		
		//close connection
		$beeDBConnection = null;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Beehive Prototype Home</title>
		<meta charset="UTF-8">
		<meta name="author" content="Alex Ball">
	</head>
	<body>
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
		print empty($errorArray['miteFormHiveID']) ? '' : $errorArray['miteFormHiveID'];
		print empty($errorArray['miteFormSampleDate']) ? '' : $errorArray['miteFormSampleDate'];
		print empty($errorArray['miteFormSamplePeriod']) ? '' : $errorArray['miteFormSamplePeriod'];
		print empty($errorArray['miteFormMiteCount']) ? '' : $errorArray['miteFormMiteCount'];
		*/
		?>
		<!-- End Heading Area -->
		
		<!-- Form Area -->
		<form method="post">
			<!-- Hive ID -->
			<label for="miteFormHiveID">Hive Name or ID:
				<input type="text" id="miteFormHiveID" name="miteFormHiveID" placeholder="Hive Name or ID">
			</label>
			
			<br />
			<br />
			
			<!-- Sample Date -->
			<label for="miteFormSampleDate">Sample Date:
				<input type="date" id="miteFormSampleDate" name="miteFormSampleDate" placeholder="yyyy-mm-dd">
			</label>
			
			<br />
			<br />
			
			<!-- Sample Period -->
			<label for="miteFormSamplePeriod">Sample Period:
				<input type="number" id="miteFormSamplePeriod" name="miteFormSamplePeriod" placeholder="Sample Period"> Days
			</label>
			
			<br />
			<br />
			
			<!-- Mite Count -->
			<label for="miteFormMiteCount">Mite Count:
				<input type="number" id="miteFormMiteCount" name="miteFormMiteCount" placeholder="Mite Count"> Mites
			</label>
			
			<br />
			<br />
			
			<!-- Submit Button -->
			<button type="submit" id="submit" name="submit" value='submit'>Submit</button>
		</form>
		<!-- End Form Area -->
	</body>
</html>
