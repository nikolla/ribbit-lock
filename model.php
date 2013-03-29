<?php


class Model {


	private $pdo; // holds the mysqli varible
	
	function _construct() {
	
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';	

	} 
	
	//--- private function for performing standard SELECTs
	private function select($table, $arr) {
	    
	    $sql = "SELECT * FROM " . $table;
	    $pref = " WHERE ";
	    
	    foreach ($arr as $key => $value)
	    {
	    	$sql .= $pref . $key . "='" . $value . "'";
	    	$pref = " AND ";
	    }
	    $sql .= ";";
	    return $this->db->query($sql);
	}

	// -- private function for performing standard INSERTS
	private function insert($table, $arr) 
	{
		$sql = "INSERT INTO " . $table . " (";
		$pref = "";

		foreach ($arr as $key => $value)
		{
			$query .= $pref . $key;
			$pref = ", ";
		}
		$sql .= ") VALUES (";
		$pref = "";
		foreach($arr as $key => $value)
		{
			$sql .= $pref . "'" . $value . "'";
			$pref = ", ";
		}
		$sql .= ");";
		$s = $this->pdo->prepare($sql);
		$s = $this->pdo->execute();
		return $s;
	}


	//--- private function for performing standard DELETEs
	private function delete($table, $arr){
	    $sql = "DELETE FROM " . $table;
	    $pref = " WHERE ";
	    foreach($arr as $key => $value)
	    {
	        $sql .= $pref . $key . "='" . $value . "'";
	        $pref = " AND ";
	    }
	    $sql .= ";";
	    $s = $this->pdo->prepare($sql);
	    $s = $this->pdo->execute();
	    return $s;
	}

	// -- private function for checking if a row exists
	private function exists($table, $arr) {
		$res = $this->select($table, $arr);
		return ($res->num_rows > 0) ? true : false;
	}
	private function magic() {
		include 'magicqoutes.inc.php';
	}
}