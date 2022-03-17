<?php

class Timer {
	
	public PDO $pdo;
	
	public function __construct() {
		
		$this->pdo = new PDO('mysql:server=localhost;dbname=control', 'root', '');
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function getTimer() {

		$statement = "SELECT * FROM timer";
				
		$statement = $this->pdo->prepare($statement);
		$statement->execute();
		
		return $statement->fetchALL(PDO::FETCH_ASSOC);
	}
	
}

function getFrequency($a) {
	if ($a == 0) {
		return "Weekly";
	} else if ($a == 1) {
		return "Every 1 Month";
	} else if ($a == 2) {
		return "Every 2 Months";
	} else if ($a == 3) {
		return "Every 4 Months";
	} else if ($a == 4) {
		return "Every 8 Months";
	} else if ($a == 5) {
		return "Yearly";
	}
}

function renewTimestop($a) {
	
}