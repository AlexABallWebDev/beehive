<?php

class BeeDataModel {
	
	var $db;
	
	function __construct($db)
	{
		$this->db = $db;
	}
	
	function insertOneRow($miteFormHiveID, $miteFormSampleDate, $miteFormSamplePeriod, $miteFormMiteCount)
	{
		//create mysql statement
		$sql = 'INSERT INTO bee_mite_count_data (hive_id, collection_date, sample_period, num_mites) VALUES';
		$sql .= " (:miteFormHiveID, :miteFormSampleDate, :miteFormSamplePeriod, :miteFormMiteCount)";
		
		//get prepared statement
		$statement = $this->db->prepare($sql);
		
		$statement->bindParam(':miteFormHiveID', $miteFormHiveID, PDO::PARAM_STR);
		$statement->bindParam(':miteFormSampleDate', $miteFormSampleDate, PDO::PARAM_STR);
		$statement->bindParam(':miteFormSamplePeriod', $miteFormSamplePeriod, PDO::PARAM_INT);
		$statement->bindParam(':miteFormMiteCount', $miteFormMiteCount, PDO::PARAM_INT);
		
		//submit statement to the database
		$results = $statement->execute();
		
		return $results;
	}
}



