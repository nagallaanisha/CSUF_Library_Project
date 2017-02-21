<!DOCTYPE html>
<html style ="background-color:silver;">
<head>

<link href = "style.css" rel = "stylesheet" type = "text/css">
<script>
function validateForm() {
    var x = document.forms["myForm"]["Username"].value;
	var y = document.forms["myForm"]["Password"].value;

    if (x == null || x == "" || y == null || y == "") {
        alert("Name and Password must be filled out");
        return false;
    } else{
	
		//window.open("sample.html");
	}
}
</script>
</head>

<header>
<!--<img src = "CSUF_Logo.jpg" alt = "CSUF Logo" align = "left" height = "75" width ="120">-->
<h1> SEARCH4BOOKS </h1>
&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</header>

<body>


<div class = "form">


<!--<img src = "image.jpg" alt = "library locator"  height= "500" width = "800">-->

<legend align = "right"></legend>

<h3>LogIn</h3>
<form name="myForm" action = "database.php" onsubmit="return validateForm()" method="post">
<input type="text" required name="Username"  class="login_input" placeholder = "Username">
<br><br>

<input type="password" required name="Password" class="login_input" placeholder = "Password">
<br>

<input type="submit" value="Sign In" class = "button">
<br>

</form>
<p>Admin : &nbsp <a href="adminlogin.php"> Sign in here </a></p>


</div>
</body>

<footer>
<img src = "images/csuf-logo-header.png" alt = "CSUF icon" >
</footer>


</html>
