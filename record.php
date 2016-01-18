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
		
		//if successful, show success message and update the table excel file
		if ($results)
		{
			$success = true;
			
			//get data rows
			$resultRows = $dataModel->getAllDataRows();
			
			//update table excel file
			
			/** PHPExcel */
			include 'Classes/PHPExcel.php';
			
			/** PHPExcel_Writer_Excel2007 */
			include 'Classes/PHPExcel/Writer/Excel2007.php';
			
			// Create new PHPExcel object
			$objPHPExcel = new PHPExcel();
			
			// add headers to sheet
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hive Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Observation Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Duration');
			$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Mite Count');
			
			// add data to sheet
			$rowNumber = 2;
			foreach($resultRows as $row)
			{
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowNumber, $row['hive_name']);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowNumber, $row['observation_date']);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowNumber, $row['duration']);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowNumber, $row['mite_count']);
				$rowNumber += 1;
			}
			
			// Rename sheet
			$objPHPExcel->getActiveSheet()->setTitle('beeDataExcelSheet');
					
			// Save Excel 2007 file
			$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
			$objWriter->save('beeDataExcelSheet.xlsx');
		}
		//otherwise, it is assumed that something went wrong,
		//so an error message will be displayed.
		
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