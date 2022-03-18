<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "control";

$conn = new mysqli($server, $username, $password, $dbname);

if (isset($_POST["submit"])) {

	if ($conn->connect_error) {
		echo "Connection Failed";
		die("Connection failed: " . $conn->connect_error);
	}
	
	$timertitle = $_POST["timertitle"];
	$timerlink = $_POST["timerlink"];
	$timerdesc = $_POST["timerdesc"];
	$timertype = $_POST["timertype"];
	$timerOcasional = $_POST["timerOcasional"];
	$timerRutinary = $_POST["timerRutinary"];
	
	$timerStop = new DateTime();
	$timerStop = $timerStop->modify('+8 month')->format('Y-m-d');
	
	if ($timertype == 1) {
		$sql = "INSERT INTO timer (title, description, link, status, timestamp, rutine, timestop) values ('".$timertitle."','".$timerlink."','".$timerdesc."',".$timertype.","."now(),".$timerRutinary.",DATE_FORMAT('".$timerStop."', '%Y-%m-%d'));";
	} else if ($timertype == 0) {
		echo $timerOcasional;
		$sql = "INSERT INTO timer (title, description, link, status, timestamp, date) values ('".$timertitle."','".$timerlink."','".$timerdesc."',".$timertype.","."now(),DATE_FORMAT('".$timerOcasional."-01', '%Y-%m-%d'));";
	}

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	header("Location: ../index.php");

	$conn->close();
	
}

?>