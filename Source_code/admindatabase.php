<?php

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "mydb";

$admin_name = $_POST['Adminname'];
$admin_password = $_POST['Adminpassword'];


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Create Table
/*$sql = "CREATE TABLE adminlogin (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
Adminname VARCHAR(30) NOT NULL,
Adminpassword VARCHAR(30) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Adminlogin created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}*/

//insert values
/*$sql = "INSERT INTO adminlogin (Adminname,Adminpassword)
VALUES ('$admin_name', '$admin_password')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}*/

// authorize username

$sql = "SELECT * FROM adminlogin where Adminname = '$admin_name' and Adminpassword = '$admin_password'";
$result= mysqli_query($conn,$sql);

if(mysqli_num_rows($result)>0){
	 while($row = mysqli_fetch_assoc($result)){
		 
		 header('Location: admin.php');
		
	 }
	}else{
		   
		 echo "you are not authorized user";
	 }

mysqli_close($conn);
?>