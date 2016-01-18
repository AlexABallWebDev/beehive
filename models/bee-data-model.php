<?php

class BeeDataModel {
	
	var $db;
	
	function __construct($db)
	{
		$this->db = $db;
	}
	
	function insertOneRow($miteFormHiveName, $miteFormObservationDate, $miteFormDuration, $miteFormMiteCount)
	{
		//create mysql statement
		$sql = 'INSERT INTO observation (hive_name, observation_date, duration, mite_count) VALUES';
		$sql .= " (:miteFormHiveName, :miteFormObservationDate, :miteFormDuration, :miteFormMiteCount)";
		
		//get prepared statement
		$statement = $this->db->prepare($sql);
		
		$statement->bindParam(':miteFormHiveName', $miteFormHiveName, PDO::PARAM_STR);
		$statement->bindParam(':miteFormObservationDate', $miteFormObservationDate, PDO::PARAM_STR);
		$statement->bindParam(':miteFormDuration', $miteFormDuration, PDO::PARAM_INT);
		$statement->bindParam(':miteFormMiteCount', $miteFormMiteCount, PDO::PARAM_INT);
		
		//submit statement to the database
		$results = $statement->execute();
		
		return $results;
	}
	
	function getAllDataRows()
	{
		//create mysql statement
		$sql = 'SELECT hive_name, observation_date, duration, mite_count FROM observation';
		
		//query for all rows in the database
		$results = $this->db->query($sql);
		
		return $results;
	}
	
	function getRowsByHiveName($hiveName)
	{
		//create mysql statement
		$sql = 'SELECT hive_name, observation_date, duration, mite_count FROM observation';
		$sql .= " WHERE hive_name = '$hiveName'";
		
		//query for all rows in the database
		$results = $this->db->query($sql);
		
		return $results;
	}
}

?>