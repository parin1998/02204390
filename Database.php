
<?php
class database
{
	function connectDB()
	{
		$servername = "192.168.43.162";
		$db_name = "02204392";
		$username = "root";
		$password = "";
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$db_name;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "yes";
			return $conn;
		} catch (PDOException $e) {
			return "Connection failed: " . $e->getMessage();
		}
	}

	function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
	{
		$myConDB = $this->connectDB();
		$sth = $myConDB->prepare($sql);
		foreach ($array as $key => $value) {
			$sth->bindValue("$key", $value);
		}
		$sth->execute();
		return $sth->fetchAll($fetchMode);
	}

	function selectData($str)
	{
		$myConDB = $this->connectDB();
		try {
			$stmt = $myConDB->prepare($str);
			$stmt->execute();
			$num = 0;
			while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$num++;
				foreach ($result as $key => $value) {
					$data[$num][$key] = $value;
				}
			}
			$data[0]['numrow'] = $num;
			$conn = null;
			return $data;
		} catch (PDOException $e) {
			$conn = null;
			return "-1";
		}

		//$conn = null;
	}

	function selectAll($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC)
	{
		$myConDB = $this->connectDB();
		$sth = $myConDB->prepare($sql);
		foreach ($array as $key => $value) {
			$sth->bindValue("$key", $value);
		}
		$sth->execute();
		return $sth->fetchAll($fetchMode);
	}

	function selectDataOne($str)
	{
		$myConDB = $this->connectDB();
		try {
			$stmt = $myConDB->prepare($str);
			$stmt->execute();
			$num = 0;
			if ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
				foreach ($result as $key => $value) {
					$data[$key] = $value;
				}
			}
			$conn = null;
			return $data;
		} catch (PDOException $e) {
			$conn = null;
			return "-1";
		}

		//$conn = null;
	}

	function selectDataArray($str)
	{

		$myConDB = $this->connectDB();

		try {
			$stmt = $myConDB->prepare($str);
			$stmt->execute();

			$bucket = "";

			while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {

				$set = "";
				foreach ($result as $key => $value) {
					$set .= "\"" . $key . "\":\"" . $value . "\",";
				}

				$set = rtrim($set, ',');
				$bucket .= "{" . $set . "},";
			}
			$bucket = rtrim($bucket, ',');

			$resultJson = "[" . $bucket . "]";

			$conn = null;
			return $resultJson;
		} catch (PDOException $e) {
			$conn = null;
			return "Error: " . $e->getMessage();
		}

		//$conn = null;
	}

	function update($str)
	{
		$myConDB = $this->connectDB();
		try {
			$stmt = $myConDB->prepare($str);
			$stmt->execute();
			$conn = null;
			return "OK";
		} catch (PDOException $e) {
			$conn = null;
			return "Error: " . $e->getMessage();
		}
	}

	function insert($str)
	{
		$myConDB = $this->connectDB();

		try {
			$stmt = $myConDB->prepare($str);
			$stmt->execute();
			$conn = null;
			return $myConDB->lastInsertId();
		} catch (PDOException $e) {
			$conn = null;
			return "-1";
		}
	}

	function delete($str)
	{
		$myConDB = $this->connectDB();
		try {
			$stmt = $myConDB->prepare($str);
			$stmt->execute();

			$conn = null;
			return $myConDB->lastInsertId();
		} catch (PDOException $e) {
			$conn = null;
			return "Error: " . $e->getMessage();
		}
	}
}

?>

