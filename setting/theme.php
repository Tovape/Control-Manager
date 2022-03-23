<?php

$server = "localhost";
$username = "root";
$password = "";
$dbname = "control";

$conn = new mysqli($server, $username, $password, $dbname);

if ($conn->connect_error) {
	echo "Connection Failed";
	die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["themeoption"])){
	$sql = "UPDATE config SET theme = 1";
} else {
	$sql = "UPDATE config SET theme = 0";
}
	
if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: ../index.php");

$conn->close();

?>