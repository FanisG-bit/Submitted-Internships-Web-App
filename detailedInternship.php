<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>searchInternships</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="detailedInternship.css?v=<?php echo time(); ?>"> <!-- <- this fixes the problem with the php stylings not displaying which is a problem related to cache --> 
	<script type="text/javascript" src="detailedInternship.js?v=<?php echo time(); ?>"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width", initial-scale=1>
</head>
<body>
	<header>
		<div id="navigation_box"> 
			<div id="navigation_content">
				<a href="http://localhost/project/mainpage.php"><img src="images/main/internship.png" id="title_image"></a>
				<h2 id="title_name"><a href="http://localhost/project/mainpage.php">searchInternships</a></h2>
			</div>
		</div>
	</header>
	<section>
		<?php
			if (isset($_SESSION['selected_internship_id'])) {
				$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');
				if (!$con) {
					echo "Connection error" . "<br>" . mysqli_connect_error();
				}
				$retrieveDataSql = "SELECT * FROM INTERNSHIPS WHERE internship_id = '" . $_SESSION['selected_internship_id'] . "'";
				$retrievedData = mysqli_query($con, $retrieveDataSql);

				//retrieve company logo from server directory, based on the file name that was stored in the database at the creation of the internship
				// was inspired by -> https://www.codexworld.com/upload-store-image-file-in-database-using-php-mysql/
				$query = "SELECT file_name from internships WHERE internship_id = '" . $_SESSION['selected_internship_id'] . "'";
				$queryResult = mysqli_query($con, $query);
				$imageURL;
				while ($imageRow = mysqli_fetch_array($queryResult)) {
					$imageURL = 'serverUploadPath/' . $imageRow['file_name'];
				}

				while($row = mysqli_fetch_array($retrievedData)){
					if ($imageURL != 'serverUploadPath/') {
						echo '<div id="internship_page_box">
							<div id="internship_page_content">
								<h1 style="text-align: left; margin-top: 20px;">' . $row['internship_title'] .'</h1>
								<img src="'. $imageURL .'" alt="company_logo" id="company_logo"/>
								<form method="POST" action="" name="addFavForm"
								style="float: right;">
									<button type="submit" class="btn btn-outline-warning" id="addFavouritesButton" name="AddToFavSubmit">Add to favourites</button>
								</form>
								<div id="company_name_id">Company Name: ' . $row['company_name'] .'</div>
								<div id="company_location_id">Company Location: ' . $row['company_location'] .'</div>
								<div id="date_posted_id">Date Posted: ' . $row['date_posted'] .'</div>
								';

								echo '<div id="duration">From: '. $row['date_start'] .' Until: '. $row['date_end'] .'</div>';

								if ($row['is_Paid'] == 'Yes') { 
									echo '<div id="isPaidId" class="label success">Is Paid</div>';	
								}else{ 
									echo '<div id="isPaidId" class="label success">Not Paid</div>';
								} 
								echo '<span><b>Description:</b></span>
								<div id="internship_desc_box">
									<div id="internship_desc_content">
										' . $row['internship_description'] . '
									</div>
								</div>
								<span><b>Responsibilities:</b></span>
								<div id="internship_responsib_box">
									<div id="internship_responsib_content">
										' . $row['internship_responsibilities'] . '
									</div>
								</div>
								<span><b>Skills Required:</b></span>
								<div id="internship_skills_box">
									<div id="internship_skills_content">
										' . $row['internship_skills'] . '
									</div>
								</div>
								<button class="btn btn-outline-primary" id="apply_button"><a href="'. $row['company_url'] .'" target="_blank">Visit company page</a></button>
								<button class="btn btn-outline-secondary" style="margin-top:10px; margin-left: auto;
									margin-right: auto;
									display: block;
									margin-bottom: 20px;"><a href="http://localhost/project/searchpage.php">Back to Search</a></button>
							</div>
						</div>';
						if (isset($_POST['AddToFavSubmit'])) {
							if (isset($_SESSION['username'])) {
								$retrievedUserId = "SELECT user_id from users where username = '" . $_SESSION['username'] . "'";
								$result = mysqli_query($con, $retrievedUserId);
								while ($row = mysqli_fetch_array($result)) {
									
									$alreadyInFav = false;
									$checkExistance = "SELECT user_id, internship_id FROM favourites";
									$existence = mysqli_query($con, $checkExistance);
									while ($row1 = mysqli_fetch_array($existence)) {
										if ($row1['user_id'] == $row['user_id'] && $row1['internship_id'] == $_SESSION['selected_internship_id']) {
											$alreadyInFav = true;
											break;
										}
									}
									if (!$alreadyInFav) {
										$sql = "INSERT INTO favourites(user_id, internship_id)VALUES('" . $row['user_id'] . "', '" . $_SESSION['selected_internship_id'] . "')";
										if (!mysqli_query($con, $sql)) {
											echo "Error: " . $sql . "<br>" . mysqli_error($con);
										}
										else{
											echo '<div id="message" style="text-align:center;color:#00c784;">*Internship was stored in favourites!*<div>';
										}	
									}
									else{
										echo '<div id="message" style="text-align:center;color:red;">*Internship already stored in favourites*<div>';
									}
								}
							}
							else{
								echo '<div id="message" style="text-align:center;color:red;">*You need an account to store internships in favourites*<div>';
							}
						}
					}
					else{
						echo '<div id="internship_page_box">
							<div id="internship_page_content">
								<h1 style="text-align: left; margin-top: 20px;">' . $row['internship_title'] .'</h1>
								<form method="POST" action="" name="addFavForm"
								style="float: right;">
									<button type="submit" class="btn btn-outline-warning" id="addFavouritesButton" name="AddToFavSubmit">Add to favourites</button>
								</form>
								<div id="company_name_id">Company Name: ' . $row['company_name'] .'</div>
								<div id="company_location_id">Company Location: ' . $row['company_location'] .'</div>
								<div id="date_posted_id">Date Posted: ' . $row['date_posted'] .'</div>
								';

								echo '<div id="duration">From: '. $row['date_start'] .' Until: '. $row['date_end'] .'</div>';

								if ($row['is_Paid'] == 'Yes') { 
									echo '<div id="isPaidId" class="label success">Is Paid</div>';	
								}else{ 
									echo '<div id="isPaidId" class="label success">Not Paid</div>';
								} 
								echo '<span><b>Description:</b></span>
								<div id="internship_desc_box">
									<div id="internship_desc_content">
										' . $row['internship_description'] . '
									</div>
								</div>
								<span><b>Responsibilities:</b></span>
								<div id="internship_responsib_box">
									<div id="internship_responsib_content">
										' . $row['internship_responsibilities'] . '
									</div>
								</div>
								<span><b>Skills Required:</b></span>
								<div id="internship_skills_box">
									<div id="internship_skills_content">
										' . $row['internship_skills'] . '
									</div>
								</div>
								<button class="btn btn-outline-primary" id="apply_button"><a href="'. $row['company_url'] .'" target="_blank">Visit company page</a></button>
								<button class="btn btn-outline-secondary" style="margin-top:10px; margin-left: auto;
									margin-right: auto;
									display: block;
									margin-bottom: 20px;"><a href="http://localhost/project/searchpage.php">Back to Search</a></button>
							</div>
						</div>';
						if (isset($_POST['AddToFavSubmit'])) {
							if (isset($_SESSION['username'])) {
								$retrievedUserId = "SELECT user_id from users where username = '" . $_SESSION['username'] . "'";
								$result = mysqli_query($con, $retrievedUserId);
								while ($row = mysqli_fetch_array($result)) {
									
									$alreadyInFav = false;
									$checkExistance = "SELECT user_id, internship_id FROM favourites";
									$existence = mysqli_query($con, $checkExistance);
									while ($row1 = mysqli_fetch_array($existence)) {
										if ($row1['user_id'] == $row['user_id'] && $row1['internship_id'] == $_SESSION['selected_internship_id']) {
											$alreadyInFav = true;
											break;
										}
									}
									if (!$alreadyInFav) {
										$sql = "INSERT INTO favourites(user_id, internship_id)VALUES('" . $row['user_id'] . "', '" . $_SESSION['selected_internship_id'] . "')";
										if (!mysqli_query($con, $sql)) {
											echo "Error: " . $sql . "<br>" . mysqli_error($con);
										}	
										else{
											echo '<div id="message" style="text-align:center;color:#00c784;">*Internship was stored in favourites!*<div>';
										}
									}
									else{
										echo '<div id="message" style="text-align:center;color:red;">*Internship already stored in favourites*<div>';
									}
								}
							}
							else{
								echo '<div id="message" style="text-align:center;color:red;">*You need an account to store internships in favourites*<div>';
							}
						}
					}		
				}
			}
			else{
				echo "Error: no information displayed for this page";
			}
		?>
	</section>

	<footer style="margin-top: 80px;">
		<div id="footer_box">
			<div id="footer_box_content">
				<div id="follow_box">
					<div id="follow_box_content">
						FOLLOW US:		
					</div>
				</div>
				<div id="social_box">
					<div id="social_box_content" style="overflow: auto;">
						<div class="media">
							<img src="images/main/facebook.png" alt="facebook_icon" class="media_icon">
							<div class="media_title">Facebook</div>
						</div>
						<div class="media">
							<img src="images/main/linkedin.png" alt="linkedin_icon" class="media_icon">
							<div class="media_title">LinkedIn</div>
						</div>
						<div class="media">
							<img src="images/main/instagram.png" alt="instagram_icon" class="media_icon">
							<div class="media_title">Instagram</div>
						</div>
						<div class="media">
							<img src="images/main/twitter.png" alt="twitter_icon" class="media_icon">
							<div class="media_title">Twitter</div>
						</div>
					</div>
				</div>
				<div id="additional_info_box">
					<div id="additional_info_content">
						<a href="">Contact</a>
						<a href="">About Us</a>
						<a href="">References</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>