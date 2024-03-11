<?php
	// Import the mysqli class

	$con = mysqli_connect("mysql", "root", "rootPASS");
	// Create the database if it does not exist
	$sql = "CREATE DATABASE IF NOT EXISTS ranking";
	$con->query($sql);
	$con = mysqli_connect("mysql", "root", "rootPASS", "ranking");
	// delete the table if it does exist
	$sql = "DROP TABLE IF EXISTS wyniki";
	$con->query($sql);
	$sql = "CREATE TABLE wyniki (
		NazwaUczestnika VARCHAR(30) PRIMARY KEY,
		Wynik1 FLOAT default 0.0,
		Wynik2 FLOAT default 0.0,
		Wynik3 FLOAT default 0.0,
		Wynik4 FLOAT default 0.0,
		Wynik5 FLOAT default 0.0
	)";

	// Execute the query if the table does not exist
	$con->query($sql);
	// Close the database connection
	//add database user
	$sql = "CREATE USER 'wyniki_konkursu'@'%' IDENTIFIED BY 'wyniki_konkursu'";
	$con->query($sql);
	$sql = "CREATE USER 'wyniki'@'%' IDENTIFIED BY 'wyniki'";
	$con->query($sql);
	$sql = "GRANT ALL PRIVILEGES ON ranking.* TO 'wyniki_konkursu'@'%'";
	$con->query($sql);
	$sql = "GRANT SELECT ON ranking.* TO 'wyniki'@'%'";
	$con->query($sql);
	$sql = "FLUSH PRIVILEGES";
	$con->query($sql);
	$con->close();
	// Return the data as HTML
	echo "Database created successfully<br>";
	echo "<a href='index.php'>Go back</a>";
?>
