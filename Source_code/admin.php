<!DOCTYPE html>
<html style ="background-color:silver;">

<head>
	   
<link href = "adminstyle.css" rel = "stylesheet" type = "text/css">

</head>



<header>
<!--<img src = "CSUF_Logo.jpg" alt = "CSUF Logo" align = "left" height = "75" width ="120">-->
<h1> SEARCH4BOOKS </h1>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</header>

<body>

<h4>Welcome to the Admin page</b></h4>


<div class="container">
  <div class="right">
    <a><b>Note: </b>To see the availability of the book in the library or to know the location details or the student details who took the book click "Search/Update" book .</a>
  </div>
</div>
<div class = "form">
<form name="myForm" action = "librarydatabase.php" method="post">
<l>Published Year &nbsp;&nbsp; :</l> <select name = "Publishedyear" class= "box">
  <option value=""></option>
  <option value="1990">1990</option>
  <option value="1995">1995</option>
  <option value="2000">2000</option>
  <option value="2005">2005</option>
  <option value="2010">2010</option>
  <option value="2015">2015</option>
  </select>
<br><br>

<l>Category &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</l> <select name = "Category" class= "box">
<option value=""></option>
  <option value="Arts">Arts</option>
  <option value="Computers">Computers</option>
  <option value="Encyclopedia">Encyclopedia</option>
  <option value="History">History</option>
  <option value="Math">Math</option>
  <option value="Science">Science</option>
    </select>
<br><br>

<l>Book Title &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : </l><input type="text" name="Booktitle" class= "box">
<br><br>

<l>Author Name &nbsp;&nbsp;&nbsp; :</l> <input type="text" name="Authorname" class= "box">
<br><br>

<l>Location Details : </l><input type="text" name="Locationdetails" class= "box">
<br><br>

<input type="submit" name= "AddBook" value="Add Book" class ="button">
<br><br>
<input type="submit" name= "Search/UpdateBook" value="Search/Update Book" class ="button">
</form>

</div>
</body>

<footer>
<img src = "images/csuf-logo-header.png" alt = "CSUF icon" >
</footer>



</html>
