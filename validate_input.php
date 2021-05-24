<?php
	
	if(isset($_POST['Submit'])){
		
		$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');

		if (!$con) {
			echo "Connection error" . "<br>" . mysqli_connect_error();
		}
		
		$plan = $_POST['plan'];
		$new_username = $_POST['username'];
		$new_password = $_POST['password'];
		$email = $_POST['email'];
		$datecreated = date("Y-m-d");

		$sql = "INSERT INTO users
				(username, password, email, plan, date_joined)
				values ('$new_username', '$new_password', '$email', '$plan', '$datecreated')";

		$isUserUnique = "SELECT username from users";
		$result = mysqli_query($con, $isUserUnique);

		$isUsernameUnique = true;
		while($row = mysqli_fetch_array($result)){
			if ($row['username'] == $new_username) {
				$isUsernameUnique = false;
				break;
			}
		}

		if ($isUsernameUnique) {
			if(!mysqli_query($con, $sql)){
				echo "Error: " . $sql . "<br>" . mysqli_error($con);
			}
			else{
				echo '<div style="margin-top:20px; color: #7FFFD4; text-align:center;"">Account has been created successfully!</div>';
			}
		}
		else{
			echo '<div style="margin-top:20px; color: red; text-align:center;"">Username already exists in database<br>Account could not be created</div>';
		}

		// $newlyCreatedId = mysqli_insert_id($con); //found<-https://www.php.net/manual/en/mysqli.insert-id.php
		// $sql2 = "INSERT INTO favourites
		// 		(user_id)
		// 		values('$newlyCreatedId')";
		// if(!mysqli_query($con, $sql2)){
		// 		echo "Error: " . $sql2 . "<br>" . mysqli_error($con);
		// }

		mysqli_free_result($result);
		mysqli_close($con);
	}
	
?>