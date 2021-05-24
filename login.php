<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>searchInternships</title>
	<link rel="stylesheet" type="text/css" href="login.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width", initial-scale=1>

</head>
<body>
	<div id="login_box">
		<div id="login_content">
			<form method="POST" action="" name="logInForm">
				<div style="font-size: 40px; text-align: center;">Log In</div><br><br>
				<label for="username_field">Username
				</label><br><br>
				<input type="text" name="username" id="username_field" autocomplete="off" placeholder="Enter username"><br><br><br>
				<label for="password_field">Password
				</label><br><br>
				<input type="password" name="password" id="password_field" autocomplete="off" placeholder="Enter password">
				<br><br><br><br>
				<div id="signin" onmouseover="changeSignInColor(this.id)" onmouseleave="changeSignDefault()"><input id="submitButton" type="submit" value="Sign in" name="Submit" style="background: none;
				color: inherit;
				border: none;
				padding: 0;
				font: inherit;
				cursor: pointer;
				outline: inherit;"></div><!--  I could force these stylings as an inline. Even though I had them in the css code(?) -->
				<br>
				<div id="cancel" onmouseover="changeCancelColor(this.id)" onmouseleave="changeCancelDefault()"><a href="http://localhost/project/mainpage.php">Cancel</a></div>
			</form>
			<?php include('loginValidate.php'); ?>
		</div>
	</div>
	
</body>
<script type="text/javascript">
	document.getElementById('signin').style.cursor = 'pointer';
	document.getElementById('cancel').style.cursor = 'pointer';

	function changeSignInColor(id){
		document.getElementById(id).style.backgroundColor = 'orange';
	}

	function changeCancelColor(id){
		document.getElementById(id).style.backgroundColor = '#909090';
	}	

	function changeSignDefault(){
		document.getElementById('signin').style.backgroundColor = 'red';	
	}

	function changeCancelDefault(){
		document.getElementById('cancel').style.backgroundColor = 'gray';	
	}

</script>
</html>