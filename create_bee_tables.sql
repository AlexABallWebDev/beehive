/*
	This file can be used to create the tables for the bee database
	which will contain information about mite counts from hives.
*/

DROP TABLE IF EXISTS bee_mite_count_data;

CREATE TABLE bee_mite_count_data (
	sample_id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	hive_id VARCHAR(30) NOT NULL,
	collection_date DATE NOT NULL,
	sample_period INT NOT NULL,
	num_mites INT NOT NULL,
	submit_timestamp TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
