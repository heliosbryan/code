<?php 
	class databaseManager{
		
		var $databaseAddress;
		var $username;
		var $password;
		var $newlink = false; // whether or not to establish a new connection on subseq req
		
		var $connection;
		
		function __construct($databaseAddress, $username, $password, $connect = false, $newlink = false)
		{
			$this->databaseAddress = $databaseAddress;
			$this->username = $username;
			$this->password = $password;
			$this->newlink = $newlink;
			
			if($connect){
				$this->connect();
			}
		}
		
		function setDatabase($databaseName)
		{
			if(!mysqli_select_db($databaseName, $this->connection)) {
				die("Could not set database to $databaseName: " . mysqli_error());
			}
		}
		
		function connect()
		{
			$connection = mysqli_connect( $this->databaseAddress, $this->username, $this->password, $this->newlink);
			
			if (!$connection) {
				die('Could not connect: ' . mysqli_error());
			};
			
			$this->connection = $connection;
		}
		
		function disconnect()
		{
			mysqli_close($connection);
		}
		
		// Execute a query
		function doQuery($sql)
		{
			if(!$result = mysqli_query($sql)) {
				die('Error: ' . mysqli_error());
			};
						
			return($result);
		}
	}
?>