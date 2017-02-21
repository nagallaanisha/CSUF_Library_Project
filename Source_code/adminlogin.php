<!DOCTYPE html>
<html style ="background-color: silver;">
<head>

<link href = "style.css" rel = "stylesheet" type = "text/css">

<script>
function validateForm(){
	var x = document.getElementById("name").value;
	var y = document.getElementById("pwd").value;
	
	if(x == null || x == '' || y == null || y == ''){
		alert("Please enter name and password")
	}else{
		//window.open("admin.php")
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


<!--<img src = "adminimage.gif" alt = "admin login" align = "right" height= "500" width = "800">-->
<!--<img src = "admin_csuflogo.png" alt = "admin login" align = "right" width = "500">-->

<legend align = "right"></legend>

<h3>Admin LogIn</h3>
<form name = "adminLogin" method= "POST" action = "admindatabase.php" onsubmit = "return validateForm()">
<input type = "text" required class="login_input" id= "name" name= "Adminname" placeholder= "Username">
<br><br><br>
<input type="password" required class="login_input" id= "pwd" name= "Adminpassword" placeholder= "Password">
<br>
<input type="submit" class="button" value="Sign In" >

</form>

</div>
</body>

<footer>
<img src = "images/csuf-logo-header.png" alt = "CSUF icon" >
</footer>


</html>
