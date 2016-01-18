<?php
/*
 *Author: Alex Ball
 *Date: 01/15/2016
 *
 *This website is a prototype for the beehive project. This project involves
 *a website that allows beekeepers to submit data about the number of mites
 *in their beehives so that Danny Najera can review this data to support the
 *theory that mites are the biggest threat to bees.
 *
 */

//get database connection called $beeDBConnection
require('/home/alexb/secure-includes/bee-db-connection.php');

//get access to the data model
require ('models/observationmodel.php');

//create data model instance
$dataModel = new ObservationModel($beeDBConnection);

//get data rows
$resultRows = $dataModel->getAllDataRows();

//show the view
require ('views/admin-beedata-table.php');

//close connection
$beeDBConnection = null;

?>