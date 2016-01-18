<?php
/*
 *Author: Alex Ball
 *Date: 01/11/2016
 *
 *This website is a prototype for the beehive project.
 *
 *This page tells the user that the submission was successful.
 *
 */

//errorArray starts empty. errors will be added if something is wrong.
$errorArray = array();

$miteFormHiveName = '';
$miteFormObservationDate = '';
$miteFormDuration = '';
$miteFormMiteCount = '';

//validate data when the form is submitted.
if (isset($_POST['submit']))
{
	//check for empty fields. add errors for any empty fields.
	if (empty($_POST['miteFormHiveName']))
	{
		$errorArray['miteFormHiveName'] = '&emptyHiveName=true';
	}
	else
	{
		$miteFormHiveName = $_POST['miteFormHiveName'];
	}
	
	if (empty($_POST['miteFormObservationDate']))
	{
		$errorArray['miteFormObservationDate'] = '&emptyObsDate=true';
	}
	else
	{
		$miteFormObservationDate = $_POST['miteFormObservationDate'];
	}
	
	if (empty($_POST['miteFormDuration']))
	{
		$errorArray['miteFormDuration'] = '&emptyDuration=true';
	}
	else
	{
		$miteFormDuration = $_POST['miteFormDuration'];
	}
	
	if (empty($_POST['miteFormMiteCount']))
	{
		$errorArray['miteFormMiteCount'] = '&emptyMiteCount=true';
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
		$miteFormHiveName = mysqli_real_escape_string($beeDBConnection, $miteFormHiveName);
		$miteFormObservationDate = mysqli_real_escape_string($beeDBConnection, $miteFormObservationDate);
		$miteFormDuration = mysqli_real_escape_string($beeDBConnection, $miteFormDuration);
		$miteFormMiteCount = mysqli_real_escape_string($beeDBConnection, $miteFormMiteCount);
		*/
		
		//get access to the data model
		require ('models/observationmodel.php');
		
		//create instance of data model
		$dataModel = new ObservationModel($beeDBConnection);
		
		//insert row
		$results = $dataModel->insertOneRow($miteFormHiveName, $miteFormObservationDate, $miteFormDuration, $miteFormMiteCount);
		
		//$results = mysqli_query($beeDBConnection, $sql);
		
		//if successful, show success message
		if ($results)
		{
			$success = true;
		}
		//otherwise, it is assumed that something went wrong
		
		//close connection
		$beeDBConnection = null;
	}
	else
	{
		$getErrors = 'location: index.php?error=true';
		foreach ($errorArray as $error)
		{
			$getErrors .= $error;
		}
		header($getErrors);
	}
}
//if user is trying to access record.php without
//submitting data, redirect to form.
else
{
	header('location: index.php');
}

//if the submission is successful, show success view.
if (isset($success))
{
	//get database rows where the hive name matches this
	//hive name submission.
	
	//get database connection called $beeDBConnection
	require('/home/alexb/secure-includes/bee-db-connection.php');
	
	//we already have access to the bee data model from submitting
	//the form data.
	
	//create data model instance
	$dataModel = new ObservationModel($beeDBConnection);
	
	//get data rows
	$resultRows = $dataModel->getRowsByHiveName($miteFormHiveName);
	
	//show the view
	require ('views/user-beedata-table.php');
	
	//close connection
	$beeDBConnection = null;
}
//otherwise, show an error
else
{
	print '<h3>Error submitting to database.</h3>';
}
?>