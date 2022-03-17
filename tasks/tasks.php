<?php

class Tasks {
	
	public PDO $pdo;
	
	public function __construct() {
		
		$this->pdo = new PDO('mysql:server=localhost;dbname=control', 'root', '');
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function getTasks($a, $b) {

		$statement = "SELECT * FROM tasks";
		
		if($b === '0') {
			$statement .= " WHERE status = 0";
		} else if ($b === '1') {
			$statement .= " WHERE status = 1";
		} else if ($b === '2') {
			$statement .= " WHERE status = 2";
		} else if ($b === '3') {
			$statement .= " WHERE status = 3";
		} else if ($b === '4') {
			$statement .= " WHERE status = 4";
		} else if ($b === '5') {
			
		} else {
			
		}
		
		if($a === '0') {
			$statement .= " ORDER BY timestamp ASC";
		} else if ($a === '1') {
			$statement .= " ORDER BY timestamp DESC";
		} else {
			
		}
		
		$statement = $this->pdo->prepare($statement);
		$statement->execute();
		
		return $statement->fetchALL(PDO::FETCH_ASSOC);
	}
	
}

class Subtasks {
	
	public PDO $pdo2;
	
	public function __construct() {
		
		$this->pdo = new PDO('mysql:server=localhost;dbname=control', 'root', '');
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function getSubtasks() {
		$statement = $this->pdo->prepare("SELECT * FROM tasks tas JOIN subtasks sub ON (tas.id = sub.relation)");
		$statement->execute();
		
		return $statement->fetchALL(PDO::FETCH_ASSOC);
	}
}

