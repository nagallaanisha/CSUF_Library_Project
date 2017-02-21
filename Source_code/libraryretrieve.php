<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

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

$query = "SELECT * FROM librarydatabases";
$result = $conn->query($query);
$outp = "";

while($rs = $result -> fetch_array(MYSQLI_ASSOC)){
	if($outp != ""){$outp .= ",";}
	$outp .= '{"id":"'  . $rs["id"] . '",';
	$outp .= '"Publishedyear":"'  . $rs["Publishedyear"] . '",';
    $outp .= '"Category":"'   . $rs["Category"]        . '",';
	$outp .= '"Authorname":"'  . $rs["Authorname"] . '",';
    $outp .= '"Booktitle":"'   . $rs["Booktitle"]        . '",';
	$outp .= '"Locationdetails":"'  . $rs["Locationdetails"] . '",';
    $outp .= '"Numberofcopies":"'   . $rs["Numberofcopies"]        . '",';
	$outp .= '"Borrowerdetails":"'  . $rs["Borrowerdetails"] . '",';
    $outp .= '"Newcopies":"'   . $rs["Newcopies"]        . '",';
    $outp .= '"Edit":"'. $rs["Edit"]     . '"}'; 
	
}

$outp ='{"records":['.$outp.']}';
$conn->close();

echo($outp);

?>