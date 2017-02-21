<!DOCTYPE html>
<html style ="background-color: silver;">
<head>

	   
<link href = "adminstyle.css" rel = "stylesheet" type = "text/css">

</head>

<header>
<!--<img src = "CSUF_Logo.jpg" alt = "CSUF Logo" align = "left" background : "silver" height = "75" width ="120">-->
<h1> LibraryDatabase </h1>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</header>

<style>
table, th , td  {
  border: 1px solid grey;
  border-collapse: collapse;
  padding: 1px;
  word-wrap: break-word;
}
table tr:nth-child(odd) {
  background-color: #f1f1f1;
}
table tr:nth-child(even) {
  background-color: #ffffff;
}
</style> 
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<div id = "body">
 

<?php

/*header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");*/

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "mydb";

$admin_publishedyear = $_POST['Publishedyear'];
$admin_category = $_POST['Category'];
$admin_authorname = $_POST['Authorname'];
$admin_booktitle = $_POST['Booktitle'];
$admin_locationdetails = $_POST['Locationdetails'];

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//insert values
if(isset($_POST["AddBook"])) {
	$sql = "INSERT INTO librarydatabases (Publishedyear, Category, Authorname,Booktitle,Locationdetails)
	VALUES ('$admin_publishedyear', '$admin_category','$admin_authorname','$admin_booktitle','$admin_locationdetails')";
	if (mysqli_query($conn, $sql)) {
		echo "<h3>New record successfully created</h3>";
	} else {
		echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
elseif (isset($_POST["Search/UpdateBook"])){
	
	/*echo "fbfskdfbskfbskd".$admin_publishedyear;*/
	
	if(empty($admin_publishedyear)) { $admin_publishedyear = "%" ;}
	if(empty($admin_category)) { $admin_category = "%" ;}
	if(empty($admin_authorname)) { $admin_authorname = "%" ;}
	if(empty($admin_booktitle)) { $admin_booktitle = "%" ;}
	if(empty($admin_locationdetails)) { $admin_locationdetails = "%" ;}
	
	/*$SearchQuery = "SELECT * FROM librarydatabases WHERE Publishedyear LIKE '$admin_publishedyear'";*/
	
	if($admin_publishedyear == "%"  and $admin_category == "%" and $admin_authorname == "%" and $admin_booktitle == "%" and $admin_locationdetails == "%") {
		 $SearchQuery = "SELECT * FROM librarydatabases";
	}
	else {
	   $SearchQuery = "SELECT * FROM librarydatabases WHERE Publishedyear LIKE '$admin_publishedyear' AND Category LIKE '$admin_category' AND Authorname LIKE '$admin_authorname'
					   AND Booktitle LIKE '$admin_booktitle' AND Locationdetails LIKE '$admin_locationdetails'";
					   
	   /*echo "SELECT * FROM librarydatabases WHERE Publishedyear LIKE '$admin_publishedyear' AND Category LIKE '$admin_category' AND Authorname LIKE '$admin_authorname'
					   AND Booktitle LIKE '$admin_booktitle' AND Locationdetails LIKE '$admin_locationdetails'"; */    
	}
	
   $result = mysqli_query($conn, $SearchQuery);

	if (mysqli_num_rows($result) > 0) {		
		?>
		<table>
			<tr>
			<th>Id</th>
			<th>PublishedYear</th>
			<th>Category</th>
			<th>Authorname</th>
			<th>Booktitle</th>
			<th>Locationdetails</th>
			<th>Numberofcopies</th>
			<th>Edit</th>
			</tr>
		<?php
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
			echo "<form name= myForm action = edit.php method = post>";
			echo "<tr>";
			echo "<td>" . "<textarea name = id rows = 2 cols = 12 readonly>" .$row['id']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = publishedyear rows = 2 cols = 12 readonly>" .$row['Publishedyear']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = category rows = 2 cols = 12 readonly>" .$row['Category']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = authorname rows = 2 cols = 12 readonly>" .$row['Authorname']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = booktitle rows = 2 cols = 12 readonly>" .$row['Booktitle']."</textarea>". " </td>";
	        echo "<td>" . "<textarea name = locationdetails rows = 2 cols = 12 readonly>" .$row['Locationdetails']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = numberofcopies rows = 2 cols = 12 readonly>" .$row['Numberofcopies']."</textarea>". " </td>";
			echo "<td>" . "<input type = submit name = edit value = edit>" . "</td>";
			echo "</tr>";
			echo "</form>";
    }
} else {
		echo "<h3>No results found with that search</h3>";
	}
		
}

?>
 
</div>

<footer>
<img src = "images/csuf-logo-header.png" alt = "CSUF icon" >
</footer>

</html>