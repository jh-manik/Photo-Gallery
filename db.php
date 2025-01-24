<?php

// dbConnection function
function dbConnect()
{
	$config = [
		'host' => 'localhost',
		'dbname' => 'photo_gallery',
		'port' => 3307,
		'charset' => 'utf8mb4',
	];

	$username = 'root';
	$password = 'root';



	try {
		$dsn = "mysql:" . http_build_query($config, '', ';');
		$connection = new PDO($dsn, $username, $password, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);

		return $connection;
	} catch (PDOException $err) {
		print 'Error: ' . $err->getMessage();
	}
}


function query($sqlQuery, array $bindings = [], $dbConnection)
{
	$statement = $dbConnection->prepare($sqlQuery);
	$statement->execute($bindings);

	return $statement;
}