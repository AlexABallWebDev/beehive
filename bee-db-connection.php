<?php
/*
 *Author: Alex Ball
 *This script creates a connection to the database.
 *
 */

$username = 'alexb_basic';
$password = '+r3Xe!ah3VUTh';
$hostname = 'localhost';
$database = 'alexb_bee_database';

$beeDBConnection = @mysqli_connect($hostname, $username, $password,
												$database)
				or die('<p class="form-error">Error connecting to database</p>');
