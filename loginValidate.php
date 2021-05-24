<?php

	if(isset($_POST['Submit'])){
		
		$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');

		if (!$con) {
			echo "Connection error" . "<br>" . mysqli_connect_error();
		}
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		// $username = mysqli_real_escape_string($con, $_POST['username']);
		// $password = mysqli_real_escape_string($con, $_POST['password']);

		$validateUsername = "SELECT username from users";
		$validatePassword = "SELECT password from users";

		$result1 = mysqli_query($con, $validateUsername);
		$result2 = mysqli_query($con, $validatePassword);

		$doesUsernameMatch = false;
		$doesPasswordMatch = false;

		while($row = mysqli_fetch_array($result1)){
			if ($row['username'] == $username) {
				$doesUsernameMatch = true;
				break;
			}
		}

		while($row = mysqli_fetch_array($result2)){
			if ($row['password'] == $password) {
				$doesPasswordMatch = true;
				break;
			}
		}

		if ($doesUsernameMatch && $doesPasswordMatch) {
			$_SESSION['username'] = $username;
			// $_SESSION['password'] = $password;
			echo "Succesfully connected.";
			header("Location: http://localhost/project/mainpage.php");
			exit();
		}
		else{
			// echo "Incorrect username or password.";
			echo '<div style="margin-top:20px; color: red; text-align:center;"">Incorrect username or password</div>';
		}
		mysqli_free_result($result1);
		mysqli_free_result($result2);
		mysqli_close($con);
	}
?>