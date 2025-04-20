<?php 

Trait Database
{

	private function connect()
	{
		$string = "mysql:hostname=".DBHOST.";dbname=".DBNAME;
		$con = new PDO($string,DBUSER,DBPASS);
		return $con;
	}

	public function query($query, $data = [])
	{
		$con = $this->connect();
		$stm = $con->prepare($query);

		// Execute the query
		$check = $stm->execute($data);

		if ($check) {
			// Determine query type (SELECT vs. others)
			if (str_starts_with(strtoupper($query), 'SELECT')) {
				// Fetch results for SELECT queries
				$result = $stm->fetchAll(PDO::FETCH_OBJ);
				return $result ?: false; // Return results or false if empty
			} else {
				// For non-SELECT queries, return the row count
				return $stm->rowCount(); // Number of affected rows
			}
		}

		// Return false if query execution fails
		return false;
	}


	public function get_row($query, $data = [])
	{

		$con = $this->connect();
		$stm = $con->prepare($query);

		$check = $stm->execute($data);
		if($check)
		{
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
			if(is_array($result) && count($result))
			{
				return $result[0];
			}
		}

		return false;
	}
	
}


