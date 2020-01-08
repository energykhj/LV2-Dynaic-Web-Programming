<?php

	function ConnectToDatabase()
	{

		#$connectionString = 'odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=C:\\xampp\\htdocs\\Assignment5\\Data\\assignment5.mdb';
		$connectionString = 'odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=D:\\xampp\\htdocs\\Assignments\\assignment5.mdb';

		$connection = new PDO($connectionString);
		$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		return $connection;

	}

?>



