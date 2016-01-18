/*
	This file can be used to create the tables for the bee database
	which will contain information about mite counts from hives.
*/

DROP TABLE IF EXISTS observation;

CREATE TABLE observation (
	observation_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	hive_name VARCHAR(30) NOT NULL,
	observation_date DATE NOT NULL,
	duration INT NOT NULL,
	mite_count INT NOT NULL,
	submit_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
