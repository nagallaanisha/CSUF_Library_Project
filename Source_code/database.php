<?php

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "mydb";

$user_name = $_POST['Username'];
$pass_word = $_POST['Password'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database
/*$sql = "CREATE DATABASE mydb";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully";
} else {
    echo "Error creating database: " . $conn->error;
}*/

// Create Table
$sql = "CREATE TABLE login (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Username VARCHAR(30) NOT NULL,
Password VARCHAR(30) NOT NULL
)";

/*if (mysqli_query($conn, $sql)) {
    echo "Table login created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}*/

//insert values
$sql = "INSERT INTO login (Username,Password)
VALUES ('$user_name', '$pass_word')";

/*if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}*/

// authorize username

$sql = "SELECT * FROM login where username = '$user_name' and password = '$pass_word'";
$result= mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
	 while($row = mysqli_fetch_assoc($result)){
		 
		 header('Location: student.php');
		
	 }
	}else{
		   
		 //echo "you are not authorized user";
		 //header('Location: loginui.php');
		 echo "<script type='text/javascript'>alert('you are not authorized user');</script>";
		 
	 }

mysqli_close($conn);

?> 
