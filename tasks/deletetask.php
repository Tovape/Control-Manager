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
	
	$taskid = $_POST["taskid"];

	$sql = "DELETE FROM tasks where id = ".$taskid;
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	header("Location: ../index.php");

	$conn->close();
	
}

?>