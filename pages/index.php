<?php
session_start();
if(isset($_POST['submit'])){
	 include('../config/DbFunction.php');
	 $obj=new DbFunction();
	 $_SESSION['login']=$_POST['id'];
	 $obj->login($_POST['id'],$_POST['password']);
}
?>

<!DOCTYPE html>
<html>
<style>
body{
	margin: 0;
	padding: 0;
	font-family: sans-serif;
	background: url(bio.png) no-repeat;
	background-size: cover;

}
.login-box{
	width: 300px;
	float:right;
	background: rgba(0, 0, 0, 0.4);
	padding: 40px;
	text-align: center;
	margin:auto;
	margin-top: 5%;
	margin-right:10%;
	color: white;

}
.login-box h2{
	float: left;
	font-size:20px;
	border-bottom: 6px solid #4caf50;
	margin-bottom: 50px;
	padding: 13px 0
}

.textbox{
	width: 100%;
	overflow:hidden;
	font-size:20px;
	padding: 8px 0;
	margin: 8px 0;
	border-bottom: 1px solid #4caf50;
}
.textbox i{
	width: 26px;
	float: left;
	text-align: center;
}
.textbox input{
	border:none;
	outline: none;
	background: none;
	color: white;
	font-size: 18px;
	width: 80%;
	float:left;
	margin: 0 10px;
}
.btn{
	width: 100%;
	background: none;
	border: 2px solid #4caf50;
	color: white;
	padding: 5px;
	font-size: 18px;
	cursor: pointer;
	margin: 12px 0;
	
}
checkbox{
	position:left;
}

.btn1 {
	color: white;
	padding: 5px;
	font-size: 15px;
	font-weight: bold;
	cursor: pointer;
    float: center;
	background-color: red;
    text-decoration: none;
    display: inline-block;

}

</style>
<head>
	<meta charset = "utf-8">
	<title>Login Form</title>
	</head>
<body>
	<div class= "login-box" >
	<h3>Medical Insurance Biometric Payment System</h3>
		<form method="POST">
			<h2>Login</h2>
			<div class ="textbox">
				<i class="fa fa-user" aria-hidden="true"></i>
				<input type ="text" required="required" placeholder ="Username" name ="id" >
			</div>
	
			<div class ="textbox">
				<i class="fa fa-lock" aria-hidden="true"></i>
				<input type ="password" required="required" placeholder ="Password" name ="password" >
			</div>

			<input class ="btn" type ="submit" name ="submit" value="Login"><br><br>
		</form>
	</div>
</body>
</html>