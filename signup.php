<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="signup.css?v=<?php echo time(); ?>"> <!-- <- this fixes the problem with the php stylings not displaying which is a problem related to cache --> 
	<script type="text/javascript" src="signup.js?v=<?php echo time(); ?>"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width", initial-scale=1>
</head>
<body>
	<section style="overflow:auto;">
		<div id="leftpart_box">
			<div id="leftpart_content">
				<div id="quote">
					"If you want to change the world ... pick up your pen and write."
				</div>
				<div>
					<img src="images/signup/pixel-cells-3974186.png" alt="internshipImage" id="leftpart_Image">
				</div>
			</div>
		</div>
		<div id="rightpart_box">
			<div id="rightpart_content">
				<div id="signup_title"><u>Sign Up</u></div>
				<div id="signupPlan">
					I'm signing up as:
				</div>
				<form method="POST" action="" name="signupForm" onsubmit="return validateForm()">
					<input type="radio" id="student" name="plan" value="student">
				    <label for="student">Student</label>
				    <input type="radio" id="employer" name="plan" value="employer">
				    <label for="employer">Employer</label>
				    <div id="text_inputsID" style="position: relative;">
				    	<label for="username_field">
				    		Username
				    	</label>
				    	<input type="text" name="username" id="username_field" autocomplete="off" placeholder="e.g. TonyStark18"><br><br>

				    	<label for="password_field">
				    		Password
				    	</label>
				    	<input type="password" name="password" id="password_field" autocomplete="off" placeholder="Enter your password"><br><br>
				    	<img src="images/signup/private.png" id="showPasswordIcon" style="width: 25px; height: 25px;" onclick="showPassword()">

				    	<label for="email_field">
				    		Email
				    	</label>
				    	<input type="email" name="email" id="email_field" autocomplete="off" placeholder="e.g. tonystark@gmail.com"><br><br><br>

				    	<input type="checkbox" id="agreeBox" name="agreeBox" value="Agree">
						<label for="" style="color: white;"> By signing up, you agree to <u id="terms" style="color: #7FFFD4;">our Terms</u></label><br><br>

						<div id="signup" onmouseover="changeSignUpColor(this.id)" onmouseleave="changeSignDefault()"><input id="signup_submit" type="submit" value="Sign up" name="Submit"></div>
						<div id="cancel" onmouseover="changeCancelColor(this.id)" onmouseleave="changeCancelDefault()"><a href="http://localhost/project/mainpage.php">Cancel</a></div>
						<?php include("validate_input.php"); ?>
				    </div>
				</form>
			</div>
		</div>
	</section>
</body>
</html>