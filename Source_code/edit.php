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
  white-space: nowrap;
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

$servername = "localhost";
$username = "root";
$password = "admin";
$dbname = "mydb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['save'])){
		 	
	$updateQuery ="UPDATE librarydatabases SET Publishedyear='$_POST[publishedyear]', Category='$_POST[category]', Authorname='$_POST[authorname]',
	Booktitle='$_POST[booktitle]', Locationdetails='$_POST[locationdetails]', Numberofcopies='$_POST[numberofcopies]' WHERE id='$_POST[id]'";
	
	if(mysqli_query($conn,$updateQuery)){
		echo "<h3>Record $_POST[id] updated Successfully</h3>";
	} else{
		echo "Error updating record $_POST[id]: " . mysqli_error($conn);
	}
	
	$sql = "SELECT * FROM librarydatabases WHERE id='$_POST[id]'";
	$sql_borrow = "SELECT * FROM borrowersdatabase WHERE Bookid='$_POST[id]'";
	$result = mysqli_query($conn, $sql);
    $result_borrow = mysqli_query($conn, $sql_borrow);
			
}

elseif(isset($_POST['commit'])){
		 	
	$updateQuery ="UPDATE borrowersdatabase SET Studentname='$_POST[studentname]', Studentid='$_POST[studentid]', Dateborrowed='$_POST[dateborrowed]', Datereturned='$_POST[datereturned]' WHERE id='$_POST[id]'";
	
	
	if(mysqli_query($conn,$updateQuery)){
		echo "<h3>Record $_POST[id] updated Successfully</h3>";
	} else{
		echo "Error updating record $_POST[id]: " . mysqli_error($conn);
	}
	
	if(!empty($_POST['dateborrowed']) and empty($_POST['datereturned']) ) { 
	
		//$_POST['numberofcopies'] = $_POST['numberofcopies'] - 1;
		
	}
	
	/*echo "Record ".$_POST['id'];*/
	$admin_id = $_POST['id'];
	$admin_bookid = $admin_id;
	
	$sql = "SELECT * FROM librarydatabases WHERE id='$_POST[bookid]'";
	$sql_borrow = "SELECT * FROM borrowersdatabase WHERE Bookid='$_POST[bookid]'";
	$result = mysqli_query($conn, $sql);
    $result_borrow = mysqli_query($conn, $sql_borrow);
			
}
elseif(isset($_POST["modify"])) {
	
	$sql = "SELECT * FROM librarydatabases WHERE id='$_POST[bookid]'";
	$sql_borrow = "SELECT * FROM borrowersdatabase WHERE Bookid='$_POST[bookid]'";
	$result = mysqli_query($conn, $sql);
    $result_borrow = mysqli_query($conn, $sql_borrow);
	
}
elseif(isset($_POST["edit"])) {
	
	/*echo "Record ".$_POST['id'];*/
	$admin_id = $_POST['id'];
	$admin_copies = $_POST['numberofcopies'];
	$admin_bookid = $admin_id;
	
	$sql = "SELECT * FROM librarydatabases WHERE id='$_POST[id]'";
	$sql_borrow = "SELECT * FROM borrowersdatabase WHERE Bookid='$_POST[id]'";
	$result = mysqli_query($conn, $sql);
    $result_borrow = mysqli_query($conn, $sql_borrow);
	
	if (mysqli_num_rows($result_borrow) > 0) {
		// output data of each row		
		if(mysqli_num_rows($result_borrow)< $admin_copies) {	
            $z = 0;		
			for ($x = 1; $x <= ($admin_copies-mysqli_num_rows($result_borrow)); $x++) {
				$sql_insert = "INSERT INTO borrowersdatabase (Bookid) VALUES ('$admin_bookid')";				
				if (mysqli_query($conn, $sql_insert)) {
					$z++;
				} else {
					echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
				}
			}				
            if(!empty($z)){
			 echo "<h3>Entries added for new copies:  $z</h3>";		
			}	
         			
		}				
	}
	else {	
	    $y = 0;
		for ($x = 1; $x <= $admin_copies; $x++) {			
			$sql_insert = "INSERT INTO borrowersdatabase (Bookid) VALUES ('$admin_bookid')";			
			if (mysqli_query($conn, $sql_insert)) {
				$y++;				
			} else {
				echo "Error: " . $sql_insert . "<br>" . mysqli_error($conn);
			}			
		}
		 if(!empty($y)){
			 echo "<h3>Entries added for new copies:  $y</h3>";		
		 }			 
	}
}

else {
	$admin_copies = 0;
	$admin_bookid = 0;

	$sql = "SELECT * FROM librarydatabases WHERE id='$_POST[bookid]'";
	
	$result = mysqli_query($conn, $sql);
    $result_borrow = 0;
}

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
	if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
		
		if(!(isset($_POST['save']))){
			echo "<form name= myForm action = edit.php method = post>";
			echo "<tr>";
			echo "<td>" . "<textarea name = id rows = 2 cols = 12 >" .$row['id']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = publishedyear rows = 2 cols = 12 >" .$row['Publishedyear']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = category rows = 2 cols = 12 >" .$row['Category']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = authorname rows = 2 cols = 12 >" .$row['Authorname']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = booktitle rows = 2 cols = 12 >" .$row['Booktitle']."</textarea>". " </td>";
	        echo "<td>" . "<textarea name = locationdetails rows = 2 cols = 12 >" .$row['Locationdetails']."</textarea>". " </td>";
			echo "<td>" . "<textarea name = numberofcopies rows = 2 cols = 12 >" .$row['Numberofcopies']."</textarea>". " </td>";
			echo "<td>" . "<input type = submit name = save value = save>" . "</td>";
			echo "</tr>";
			echo "</form>";
		}
		else{
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
    }
} else {
    echo "0 results";}
?>

</table>

<?php

	
$result_borrow = mysqli_query($conn, $sql_borrow);
if (mysqli_num_rows($result_borrow) > 0) {
		
?>		
	<table>
		<tr>
		<th>Id</th>
		<th>Bookid</th>
		<th>Studentid</th>
		<th>Studentname</th>
		<th>Dateborrowed</th>
		<th>Datereturned</th>
		<th>Edit</th>
		</tr>
   <?php
		while($row = mysqli_fetch_assoc($result_borrow)) {
		
			if(!(isset($_POST['commit'])) and !(isset($_POST['save']))){
				echo "<form name= myForm action = edit.php method = post>";
				echo "<tr>";
				echo "<td>" . "<textarea name = id rows = 2 cols = 12 >" .$row['id']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = bookid rows = 2 cols = 12 >" .$row['Bookid']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = studentid rows = 2 cols = 12 >" .$row['Studentid']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = studentname rows = 2 cols = 12 >" .$row['Studentname']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = dateborrowed rows = 2 cols = 12 >" .$row['Dateborrowed']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = datereturned rows = 2 cols = 12 >" .$row['Datereturned']."</textarea>". " </td>";
				echo "<td>" . "<input type = submit name = commit value = commit>" . "</td>";
				echo "</tr>";
				echo "</form>";
			}
			else{
				echo "<form name= myForm action = edit.php method = post>";
				echo "<tr>";
				echo "<td>" . "<textarea name = id rows = 2 cols = 12 readonly>" .$row['id']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = bookid rows = 2 cols = 12 >" .$row['Bookid']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = studentid rows = 2 cols = 12 readonly>" .$row['Studentid']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = studentname rows = 2 cols = 12 readonly>" .$row['Studentname']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = dateborrowed rows = 2 cols = 12 readonly>" .$row['Dateborrowed']."</textarea>". " </td>";
				echo "<td>" . "<textarea name = datereturned rows = 2 cols = 12 readonly>" .$row['Datereturned']."</textarea>". " </td>";
				echo "<td>" . "<input type = submit name = modify value = modify>" . "</td>";
				echo "</tr>";
				echo "</form>";	
			}
	}
}
else {
	if(!(isset($_POST['update']))){
		echo "<h3>No results found with that search</h3>";
	}
}
?>

</table>
 
</div>
 
<footer>
<img src = "images/csuf-logo-header.png" alt = "CSUF icon" >
</footer>


</html>
