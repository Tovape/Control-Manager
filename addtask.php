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
	
	$tasktitle = $_POST["tasktitle"];
	$tasksubtitle = $_POST["tasksubtitle"];
	$taskdesc = $_POST["taskdesc"];
	$taskstatus = $_POST["taskstatus"];

	$sql = "INSERT INTO tasks (title, subtitle, description, status, timestamp) values ('".$tasktitle."','".$tasksubtitle."','".$taskdesc."',".$taskstatus.","."now());";
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	header("Location: index.php");

	$conn->close();
	
}

?>