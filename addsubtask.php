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
	
	$subtaskid = $_POST["subtaskid"];
	$subtasktitle = $_POST["subtasktitle"];
	$subtasksubtitle = $_POST["subtasksubtitle"];
	$subtasklink = $_POST["subtasklink"];
	$subtaskstatus = $_POST["subtaskstatus"];

	$sql = "INSERT INTO subtasks (relation, title, subtitle, link, status, image) values (".$subtaskid.",'".$subtasktitle."','".$subtasksubtitle."','".$subtasklink."',".$subtaskstatus.",'');";
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	header("Location: index.php");

	$conn->close();
	
}

?>