<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "mydb";

if(isset($_POST['save'])){
	
	 
	$admin_id = $_POST['id'];
	$admin_publishedyear = $_POST['Publishedyear'];
	$admin_category = $_POST['Category'];
	$admin_authorname = $_POST['Authorname'];
	$admin_booktitle = $_POST['Booktitle'];
	$admin_locationdetails = $_POST['Locationdetails'];
	$admin_numberofcopies = $_POST['Numberofcopies'];
	$admin_borrowerdetails = $_POST['Borrowerdetails'];
	$admin_newcopies = $_POST['Newcopies'];
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
	

	echo "hhghfhghghgg".$_POST['Newcopies']	;
	
	//update values
	$sql = "UPDATE librarydatabases SET  Publishedyear='$admin_publishedyear', Category='$admin_category', Authorname='$admin_authorname',
	Booktitle='$admin_booktitle', Locationdetails='$admin_locationdetails', Numberofcopies='$admin_numberofcopies', Borrowerdetails='$admin_borrowerdetails',
	Newcopies='$admin_newcopies' WHERE id='$admin_id'";

	if (mysqli_query($conn, $sql)) {
		echo "Record updated successfully";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
 }
?>