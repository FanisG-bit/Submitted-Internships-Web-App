<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>searchInternships</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="settings.css?v=<?php echo time(); ?>"> <!-- <- this fixes the problem with the php stylings not displaying which is a problem related to cache --> 
	<script type="text/javascript" src="settings.js?v=<?php echo time(); ?>"></script>
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
			ob_start(); // fixes error -> Warning: Cannot modify header information - headers already sent by... Something that occurs because i have that header that transfers us from the favourites to the internshipDetails page. Solution found in: https://stackoverflow.com/questions/1912029/warning-cannot-modify-header-information-headers-already-sent-by-error
			$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');
			if (!$con) {
				echo "Connection error" . "<br>" . mysqli_connect_error();
			}
			if (isset($_SESSION['username'])) {
				$checkPlanSQL = "SELECT plan from users where username = '" . $_SESSION['username'] . "'";
				$checkPlan = mysqli_query($con, $checkPlanSQL);
				$plan = mysqli_fetch_row($checkPlan);
				if ($plan[0] == 'employer') {
						if (isset($_SESSION['username'])) {

							$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');
							$sessionUsername = $_SESSION['username'];
							if (!$con) {
								echo "Connection error" . "<br>" . mysqli_connect_error();
							}
							$retreiveUserInfoSQL = "SELECT * FROM users WHERE username = '$sessionUsername'";
							$userInfoResult = mysqli_query($con, $retreiveUserInfoSQL);

							while ($userInfoRow = mysqli_fetch_array($userInfoResult)) {
									function checkGenderChoiceMale($gend){
										$gender = $gend;
										$connect = '';
										if ($gender == 'Male') {
											$connect .= 'checked="checked"';
											return $connect;
										}
									}
									function checkGenderChoiceFemale($gend){
										$gender = $gend;
										$connect = '';
										if ($gender == 'Female') {
											$connect .= 'checked="checked"';
											return $connect;
										}
									}
									function checkGenderChoiceOther($gend){
										$gender = $gend;
										$connect = '';
										if ($gender == 'Other') {
											$connect .= 'checked="checked"';
											return $connect;
										}
									}
									function checkGenderChoiceNotExpress($gend){
										$gender = $gend;
										$connect = '';
										if ($gender == 'NotExpress') {
											$connect .= 'checked="checked"';
											return $connect;
										}
									}

									echo '<div id="container">
									<div id="purposeOfPage">Profile and Settings</div>
									<div id="details">Make changes to your profile settings and take a look at your stored internships</div>
									<div id="choicesBox">
										<div id="choicesContent">
											<div id="account">Account</div>
											<div id="favourites">Favourites</div>
											<div id="createPost">Create Post</div>
											<div id="viewUploads">View Uploads</div>
										</div>
									</div>
									<div id="secondhalfBox">
										<div id="secondhalfContent">
											<form method="POST" action="" name="updateSettingsForm">
												<div id="accountpartId">
													<label for="firstname" >
												    	First Name:		
												    </label>
												    <input type="text" name="firstname" id="firstnameid" class="input_field" autocomplete="off" value="'. $userInfoRow['first_name'] .'" ><br><br>
												    <label for="lastname">
												    	Last Name:		
												    </label>
												    <input type="text" name="lastname" id="lastnameid" class="input_field" autocomplete="off" value="'. $userInfoRow['last_name'] .'"><br><br>
												    <label for="jobtitle">
												    	Job Title:	
												    </label>
												    <input type="input" name="jobtitle" id="jobtitleid" class="input_field" autocomplete="off" value="'. $userInfoRow['job_title'] .'" ><br><br>
												    <label for="country" style="float: left;">
												    	Country:		
												    </label>
												    
												    <select name="countriesForAccount" id="countriesForAccount">
												     	<option value="'. $userInfoRow['country'] .'">'. $userInfoRow['country'] .'</option>
												     	<option value="Austria">Austria</option>
												     	<option value="UK">UK</option>
												     	<option value="Belgium">Belgium</option>
												     	<option value="Bulgaria">Bulgaria</option>
												     	<option value="Croatia">Croatia</option>
												     	<option value="Cyprus">Cyprus</option>
												     	<option value="Czechia">Czechia</option>
												     	<option value="Denmark">Denmark</option>
												     	<option value="Finland">Finland</option>
												     	<option value="France">France</option>
												     	<option value="Germany">Germany</option>
												     	<option value="Greece">Greece</option>
												     	<option value="Ireland">Ireland</option>
												     	<option value="Italy">Italy</option>
												     	<option value="Netherlands">Netherlands</option>
												     	<option value="Poland">Poland</option>
												     	<option value="Romania">Romania</option>
												     	<option value="Spain">Spain</option>
												     	<option value="Sweden">Sweden</option>
												    </select>
												    <br><br>
												    
												    <!-- related to gender  -->
												    <label for="gender">
												    	Gender:		
												    </label><br>
												    <input class="genderRadios" type="radio" name="genderchoice" value="Male"'. checkGenderChoiceMale($userInfoRow['gender']).'><span>Male</span><br>
													<input class="genderRadios" type="radio" name="genderchoice" value="Female"'. checkGenderChoiceFemale($userInfoRow['gender']).'><span>Female</span><br>
													<input class="genderRadios" type="radio" name="genderchoice" value="Other"'. checkGenderChoiceOther($userInfoRow['gender']).'><span>Other</span><br>
													<input class="genderRadios" type="radio" name="genderchoice" value="NotExpress"'. checkGenderChoiceNotExpress($userInfoRow['gender']).'><span>Prefer to not express</span><br><br>
												    <!-- related to academic level -->
												    <label for="academeci_level" style="float: left;">
												    	Academic Level:	
												    </label>
												    
												    <select name="academicLevel" id="academicLevel">
												     	<option value="'. $userInfoRow['academic_level'] .'">'. $userInfoRow['academic_level'] .'</option>
												     	<option value="Bachelor Degree">Bachelor Degree</option>
												     	<option value="Master Degree">Master Degree</option>
												     	<option value="PhD">PhD</option>
												    </select>
												    <br><br>
											    	<div id="updateSettingsButton"><input type="submit" value="Update Settings" name="UpdateSettings"></div>
											    </div>
											</form>
										</div>
										<!-- favourites option -->
										<div id="secondhalfFavourites">
											' . returnFavouriteResults() . ' 
										</div>
										<!-- category only for employer members: insert internship -->
										<div id="secondhalfInsertInternship">
											<form method="POST" action="" name="insertInternship" enctype="multipart/form-data">
												<label for="internship_title">
												    	Internship Title:		
												</label>
												 <input type="text" name="internship_title" id="internship_title" autocomplete="off" required><br><br>
												 <label for="internship_title">
												    	Company Name:		
												</label>
												 <input type="text" name="companyName" id="companyName" autocomplete="off" required><br><br>
												
												<label for="internship_begin_date">
													From:
												</label>
												<input type="date" name="internship_begin_date" id="internship_begin_date" required><br><br>
												<label for="internship_end_date">
													Until:
												</label>
												<input type="date" name="internship_end_date" id="internship_end_date" required><br><br>
												<label for="company_link"> <!-- the link that the interested people will follow -->
												    	Company URL:
												</label>
												 <input type="url" name="company_link" id="company_link" placeholder="https://example.com" pattern="https://.*" size="20" autocomplete="off" required><br><br>
												    
												    <select name="disciplinesForInternship" id="disciplinesForInternship">
												     	<option value="Journalism">Journalism</option>
												     	<option value="Natural Sciences">Natural Sciences</option>
												     	<option value="Tourism">Tourism</option>
												     	<option value="Law">Law</option>
												     	<option value="Medicine">Medicine</option>
												     	<option value="Environmental">Environmental</option>
												     	<option value="Engineering">Engineering</option>
												     	<option value="Education">Education</option>
												     	<option value="Computer Science">Computer Science</option>
												     	<option value="Business">Business</option>
												    </select>
												    <br><br>
												 <select name="countriesForUploadIntern" id="countriesForUploadIntern" required>
												     	<option value="Austria">Austria</option>
												     	<option value="UK">UK</option>
												     	<option value="Belgium">Belgium</option>
												     	<option value="Bulgaria">Bulgaria</option>
												     	<option value="Croatia">Croatia</option>
												     	<option value="Cyprus">Cyprus</option>
												     	<option value="Czechia">Czechia</option>
												     	<option value="Denmark">Denmark</option>
												     	<option value="Finland">Finland</option>
												     	<option value="France">France</option>
												     	<option value="Germany">Germany</option>
												     	<option value="Greece">Greece</option>
												     	<option value="Ireland">Ireland</option>
												     	<option value="Italy">Italy</option>
												     	<option value="Netherlands">Netherlands</option>
												     	<option value="Poland">Poland</option>
												     	<option value="Romania">Romania</option>
												     	<option value="Spain">Spain</option>
												     	<option value="Sweden">Sweden</option>
												    </select>
												    <br><br>
												    <label for="isPaid">
												    	Is Paid:		
												    </label><br>
												    <input type="radio" name="isPaid" value="Yes" required><span>Yes</span><br>
													<input type="radio" name="isPaid" value="No" required><span>No</span><br>
													
													<label for="internship_description">Description of the internship:</label>
													<textarea id="internship_description" name="internship_description" rows="4" cols="50" required style="text-align: left;"></textarea>
													<br><br>
													<label for="internship_responsibilities">Responsibilities of the trainee:</label>
													<textarea id="internship_responsibilities" name="internship_responsibilities" rows="4" cols="50" required style="text-align: left;"></textarea>
													<br><br>
													<label for="internship_skills">Required Skills:</label><br>
													<textarea id="internship_skills" name="internship_skills" rows="4" cols="50" required style="text-align: left;"></textarea>
													<br><br>
													Select company logo: <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
													<div id="uploadInternship"><input type="submit" value="Upload Internship" name="UploadInternship"></div>
											</form>
										</div>
										<div id="secondhalfviewUploadsBox">
											'. returnUploads() .'
										</div>
									</div>
								</div>';
							}
						}
				}else{
					if (isset($_SESSION['username'])) {

							$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');
							$sessionUsername = $_SESSION['username'];
							if (!$con) {
								echo "Connection error" . "<br>" . mysqli_connect_error();
							}
							$retreiveUserInfoSQL = "SELECT * FROM users WHERE username = '$sessionUsername'";
							$userInfoResult = mysqli_query($con, $retreiveUserInfoSQL);

							while ($userInfoRow = mysqli_fetch_array($userInfoResult)) {
									function checkGenderChoiceMale($gend){
										$gender = $gend;
										$connect = '';
										if ($gender == 'Male') {
											$connect .= 'checked="checked"';
											return $connect;
										}
									}
									function checkGenderChoiceFemale($gend){
										$gender = $gend;
										$connect = '';
										if ($gender == 'Female') {
											$connect .= 'checked="checked"';
											return $connect;
										}
									}
									function checkGenderChoiceOther($gend){
										$gender = $gend;
										$connect = '';
										if ($gender == 'Other') {
											$connect .= 'checked="checked"';
											return $connect;
										}
									}
									function checkGenderChoiceNotExpress($gend){
										$gender = $gend;
										$connect = '';
										if ($gender == 'NotExpress') {
											$connect .= 'checked="checked"';
											return $connect;
										}
									}

									echo '<div id="container">
									<div id="purposeOfPage">Profile and Settings</div>
									<div id="details">Make changes to your profile settings and take a look at your stored internships</div>
									<div id="choicesBox">
										<div id="choicesContent">
											<div id="account">Account</div>
											<div id="favourites">Favourites</div>
										</div>
									</div>
									<div id="secondhalfBox">
										<div id="secondhalfContent">
											<form method="POST" action="" name="updateSettingsForm">
												<div id="accountpartId">
													<label for="firstname" >
												    	First Name:		
												    </label>
												    <input type="text" name="firstname" id="firstnameid" class="input_field" autocomplete="off" value="'. $userInfoRow['first_name'] .'" ><br><br>
												    <label for="lastname">
												    	Last Name:		
												    </label>
												    <input type="text" name="lastname" id="lastnameid" class="input_field" autocomplete="off" value="'. $userInfoRow['last_name'] .'"><br><br>
												    <label for="jobtitle">
												    	Job Title:	
												    </label>
												    <input type="input" name="jobtitle" id="jobtitleid" class="input_field" autocomplete="off" value="'. $userInfoRow['job_title'] .'" ><br><br>
												    <label for="country" style="float: left;">
												    	Country:		
												    </label>
												    
												    <select name="countriesForAccount" id="countriesForAccount">
												     	<option value="'. $userInfoRow['country'] .'">'. $userInfoRow['country'] .'</option>
												     	<option value="Austria">Austria</option>
												     	<option value="UK">UK</option>
												     	<option value="Belgium">Belgium</option>
												     	<option value="Bulgaria">Bulgaria</option>
												     	<option value="Croatia">Croatia</option>
												     	<option value="Cyprus">Cyprus</option>
												     	<option value="Czechia">Czechia</option>
												     	<option value="Denmark">Denmark</option>
												     	<option value="Finland">Finland</option>
												     	<option value="France">France</option>
												     	<option value="Germany">Germany</option>
												     	<option value="Greece">Greece</option>
												     	<option value="Ireland">Ireland</option>
												     	<option value="Italy">Italy</option>
												     	<option value="Netherlands">Netherlands</option>
												     	<option value="Poland">Poland</option>
												     	<option value="Romania">Romania</option>
												     	<option value="Spain">Spain</option>
												     	<option value="Sweden">Sweden</option>
												    </select>
												    <br><br>
												    
												    <!-- related to gender  -->
												    <label for="gender">
												    	Gender:		
												    </label><br>
												    <input class="genderRadios" type="radio" name="genderchoice" value="Male"'. checkGenderChoiceMale($userInfoRow['gender']).'><span>Male</span><br>
													<input class="genderRadios" type="radio" name="genderchoice" value="Female"'. checkGenderChoiceFemale($userInfoRow['gender']).'><span>Female</span><br>
													<input class="genderRadios" type="radio" name="genderchoice" value="Other"'. checkGenderChoiceOther($userInfoRow['gender']).'><span>Other</span><br>
													<input class="genderRadios" type="radio" name="genderchoice" value="NotExpress"'. checkGenderChoiceNotExpress($userInfoRow['gender']).'><span>Prefer to not express</span><br><br>
												    <!-- related to academic level -->
												    <label for="academeci_level" style="float: left;">
												    	Academic Level:	
												    </label>
												    
												    <select name="academicLevel" id="academicLevel">
												     	<option value="'. $userInfoRow['academic_level'] .'">'. $userInfoRow['academic_level'] .'</option>
												     	<option value="Bachelor Degree">Bachelor Degree</option>
												     	<option value="Master Degree">Master Degree</option>
												     	<option value="PhD">PhD</option>
												    </select>
												    <br><br>
											    	<div id="updateSettingsButton"><input type="submit" value="Update Settings" name="UpdateSettings"></div>
											    </div>
											</form>
										</div>
										<!-- favourites option -->
										<div id="secondhalfFavourites">
											' . returnFavouriteResults() . ' 
										</div>
										<!-- category only for employer members: insert internship -->
										<div id="secondhalfInsertInternship">
											<form method="POST" action="" name="insertInternship" enctype="multipart/form-data">
												<label for="internship_title">
												    	Internship Title:		
												</label>
												 <input type="text" name="internship_title" id="internship_title" autocomplete="off" required><br><br>
												 <label for="internship_title">
												    	Company Name:		
												</label>
												 <input type="text" name="companyName" id="companyName" autocomplete="off" required><br><br>
												
												<label for="internship_begin_date">
													From:
												</label>
												<input type="date" name="internship_begin_date" id="internship_begin_date" required><br><br>
												<label for="internship_end_date">
													Until:
												</label>
												<input type="date" name="internship_end_date" id="internship_end_date" required><br><br>
												<label for="company_link"> <!-- the link that the interested people will follow -->
												    	Company URL:
												</label>
												 <input type="url" name="company_link" id="company_link" placeholder="https://example.com" pattern="https://.*" size="20" autocomplete="off" required><br><br>
												    
												    <select name="disciplinesForInternship" id="disciplinesForInternship">
												     	<option value="Journalism">Journalism</option>
												     	<option value="Natural Sciences">Natural Sciences</option>
												     	<option value="Tourism">Tourism</option>
												     	<option value="Law">Law</option>
												     	<option value="Medicine">Medicine</option>
												     	<option value="Environmental">Environmental</option>
												     	<option value="Engineering">Engineering</option>
												     	<option value="Education">Education</option>
												     	<option value="Computer Science">Computer Science</option>
												     	<option value="Business">Business</option>
												    </select>
												    <br><br>
												 <select name="countriesForUploadIntern" id="countriesForUploadIntern" required>
												     	<option value="Austria">Austria</option>
												     	<option value="UK">UK</option>
												     	<option value="Belgium">Belgium</option>
												     	<option value="Bulgaria">Bulgaria</option>
												     	<option value="Croatia">Croatia</option>
												     	<option value="Cyprus">Cyprus</option>
												     	<option value="Czechia">Czechia</option>
												     	<option value="Denmark">Denmark</option>
												     	<option value="Finland">Finland</option>
												     	<option value="France">France</option>
												     	<option value="Germany">Germany</option>
												     	<option value="Greece">Greece</option>
												     	<option value="Ireland">Ireland</option>
												     	<option value="Italy">Italy</option>
												     	<option value="Netherlands">Netherlands</option>
												     	<option value="Poland">Poland</option>
												     	<option value="Romania">Romania</option>
												     	<option value="Spain">Spain</option>
												     	<option value="Sweden">Sweden</option>
												    </select>
												    <br><br>
												    <label for="isPaid">
												    	Is Paid:		
												    </label><br>
												    <input type="radio" name="isPaid" value="Yes" required><span>Yes</span><br>
													<input type="radio" name="isPaid" value="No" required><span>No</span><br>
													
													<label for="internship_description">Description of the internship:</label>
													<textarea id="internship_description" name="internship_description" rows="4" cols="50" required style="text-align: left;"></textarea>
													<br><br>
													<label for="internship_responsibilities">Responsibilities of the trainee:</label>
													<textarea id="internship_responsibilities" name="internship_responsibilities" rows="4" cols="50" required style="text-align: left;"></textarea>
													<br><br>
													<label for="internship_skills">Required Skills:</label><br>
													<textarea id="internship_skills" name="internship_skills" rows="4" cols="50" required style="text-align: left;"></textarea>
													<br><br>
													Select company logo: <input type="file" name="fileToUpload" id="fileToUpload"><br><br>
													<div id="uploadInternship"><input type="submit" value="Upload Internship" name="UploadInternship"></div>
											</form>
										</div>
									</div>
								</div>';
							}
					}
				}
			}
			else{
				echo'
					<h2 style="text-align: center; margin-top: 50px;">
					You need an account to display these settings.
					</h2><br><br><br>
					<img src="images/settings/pixel-cells-3704067.png" style="width: 350; height: 350px; margin-left: auto;
					margin-right: auto; display: block; margin-bottom: 50px;">';
			}
			

			if (isset($_POST['UpdateSettings'])) {
				$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');
				$sessionUsername = $_SESSION['username'];
				if (!$con) {
					echo "Connection error" . "<br>" . mysqli_connect_error();
				}

				if (isset($_POST['firstname']) && $_POST['firstname'] != "") {
					$firstname = mysqli_real_escape_string($con, $_POST['firstname']);
					$changeFirstNameSql = "UPDATE users SET first_name = '$firstname'
					WHERE username = '$sessionUsername'";
					if(!mysqli_query($con, $changeFirstNameSql)){
						echo "Error: " . $changeFirstNameSql . "<br>" . mysqli_error($con);
					}
				}
				if (isset($_POST['lastname']) && $_POST['lastname'] != "") {
					$lastname = mysqli_real_escape_string($con, $_POST['lastname']);
					$changeLastNameSql = "UPDATE users SET last_name = '$lastname'
					WHERE username = '$sessionUsername'";
					if(!mysqli_query($con, $changeLastNameSql)){
						echo "Error: " . $changeLastNameSql . "<br>" . mysqli_error($con);
					}
				}

				if (isset($_POST['jobtitle']) && $_POST['jobtitle'] != "") {
					$jobtitle = mysqli_real_escape_string($con, $_POST['jobtitle']);
					$changeJobTitleSql = "UPDATE users SET job_title = '$jobtitle'
					WHERE username = '$sessionUsername'";
					if(!mysqli_query($con, $changeJobTitleSql)){
						echo "Error: " . $changeJobTitleSql . "<br>" . mysqli_error($con);
					}
				}
				if (isset($_POST['countriesForAccount']) && $_POST['countriesForAccount'] != " ") {
					$country = $_POST['countriesForAccount'];
					$changeCountrySql = "UPDATE users SET country = '$country'
					WHERE username = '$sessionUsername'";
					if(!mysqli_query($con, $changeCountrySql)){
						echo "Error: " . $changeCountrySql . "<br>" . mysqli_error($con);
					}
				}
				if (isset($_POST['genderchoice'])) {
					$genderchoice = $_POST['genderchoice'];
					$changeGenderChoiceSql = "UPDATE users SET gender = '$genderchoice'
					WHERE username = '$sessionUsername'";
					if(!mysqli_query($con, $changeGenderChoiceSql)){
						echo "Error: " . $changeGenderChoiceSql . "<br>" . mysqli_error($con);
					}
				}
				if (isset($_POST['academicLevel']) && $_POST['academicLevel'] != " ") {
					$academicLevel = $_POST['academicLevel'];
					$changeAcademicChoiceSql = "UPDATE users SET academic_level = '$academicLevel'
					WHERE username = '$sessionUsername'";
					if(!mysqli_query($con, $changeAcademicChoiceSql)){
						echo "Error: " . $changeAcademicChoiceSql . "<br>" . mysqli_error($con);
					}
				}
				header("Location: http://localhost/project/settings.php");
				exit();
			}

			if (isset($_POST['UploadInternship'])) {
				$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');

				if (!$con) {
					echo "Connection error" . "<br>" . mysqli_connect_error();
				}

				$internship_title = mysqli_real_escape_string($con, $_POST['internship_title']);
				$companyName = mysqli_real_escape_string($con, $_POST['companyName']);
				$internship_begin_date = $_POST['internship_begin_date'];
				$internship_end_date = $_POST['internship_end_date'];
				$countriesForUploadIntern = $_POST['countriesForUploadIntern'];
				$company_link = $_POST['company_link'];
				$isPaid = $_POST['isPaid'];
				$internship_description = mysqli_real_escape_string($con, $_POST['internship_description']);
				$internship_responsibilities = mysqli_real_escape_string($con, $_POST['internship_responsibilities']);
				$internship_skills = mysqli_real_escape_string($con, $_POST['internship_skills']);
				$disciplinesForInternship = $_POST['disciplinesForInternship'];
				$date_posted = date("Y-m-d");

				// RELATED TO FILE UPLOAD
				if ($_FILES["fileToUpload"]["error"] > 0)
				{
					// echo "Error: " . $_FILES["fileToUpload"]["error"] . "<br />";
				}
				// file restrictions
				$allowed = array('png', 'jpg');
				$filename = $_FILES['fileToUpload']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$uploadFileNameOnDB = false;
				$invalidFile = false;
				// 50kb = 50000bytes
				if (!in_array($ext, $allowed) && ($_FILES["fileToUpload"]["size"] < 50000)) {
				    // echo 'Invalid file.';
				    $invalidFile = true;
				}else{
					if ($_FILES["fileToUpload"]["error"] > 0) {
						// echo "Error: " . $_FILES["fileToUpload"]["error"] . "<br />";
						$invalidFile = true;
					}
					else {
						// saving file
						move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],
							"serverUploadPath/" . $_FILES["fileToUpload"]["name"]);
							// echo "Stored in: " . "upload/" .
							// $_FILES["fileToUpload"]["name"];
						// $file_name = basename($_FILES['fileToUpload']['name']);
						// basename return the name of the file from a specified path
						$uploadFileNameOnDB = true;
					}
				}

				if (!$invalidFile) {
					if ($uploadFileNameOnDB) {	
						$sql = "INSERT INTO internships
								(internship_title, company_name, company_location,
								date_posted, internship_discipline, date_start, date_end, company_url, is_Paid, internship_description, internship_responsibilities, internship_skills, file_name)
								values('$internship_title', '$companyName', '$countriesForUploadIntern', '$date_posted', '$disciplinesForInternship', '$internship_begin_date', '$internship_end_date', '$company_link', '$isPaid', '$internship_description', '$internship_responsibilities', '$internship_skills', '$filename')";
					}
					else{
						$sql = "INSERT INTO internships
								(internship_title, company_name, company_location,
								date_posted, internship_discipline, date_start, date_end, company_url, is_Paid, internship_description, internship_responsibilities, internship_skills)
								values('$internship_title', '$companyName', '$countriesForUploadIntern', '$date_posted', '$disciplinesForInternship', '$internship_begin_date', '$internship_end_date', '$company_link', '$isPaid', '$internship_description', '$internship_responsibilities', '$internship_skills')";
					}
					if(!mysqli_query($con, $sql)){
						echo "Error: " . $sql . "<br>" . mysqli_error($con);
					}
					else{
						echo "A new internship post was uploaded!";
						// WE SHOULD ADD IT TO THE UPLOADS TABLE. Where the employer will see his uploads.
						//retrieve user id
						$retrieveUserIdSQL = "SELECT user_id from users where username = '" . $_SESSION['username'] . "'";
						$result = mysqli_query($con, $retrieveUserIdSQL);
						$rowUserId = mysqli_fetch_row($result);
						//retrieve newly created internship id
						$retrieveInternshipIdSQL = "SELECT internship_id from internships WHERE internship_title = '$internship_title'";
						$retrieveInternshipIdRes = mysqli_query($con, $retrieveInternshipIdSQL);
						$rowInternshipId = mysqli_fetch_row($retrieveInternshipIdRes);


						$uploadSQL = "INSERT INTO uploads
									  (user_id, internship_id)
									  values('$rowUserId[0]', '$rowInternshipId[0]')";
						if(!mysqli_query($con, $uploadSQL)){
							echo "Error: " . $uploadSQL . "<br>" . mysqli_error($con);
						}
						// we need this because else, if the user abbused the refresh button, then the same internship would be uploaded again and again (the same form would essentailly be resubmitted).
						header("Location: http://localhost/project/settings.php");
						exit();
					}	
				}
				else{
					if ($_FILES["fileToUpload"]["size"] == 0) {
						echo '<div style="text-align:center;color:red;font-size:20px;">A company logo should be uploaded. Fail to upload post.</div>';
					}
					else{
						echo '<div style="text-align:center;color:red;font-size:20px;">Error: Invalid file. File should be less than 50kb and of type .png .jpg</div>';
					}
				}
			}

			function returnFavouriteResults(){
				$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');

				if (!$con) {
					echo "Connection error" . "<br>" . mysqli_connect_error();
				}

				$retrieveUserIdSQL = "SELECT user_id from users where username = '" . $_SESSION['username'] . "'";
				$result = mysqli_query($con, $retrieveUserIdSQL);
				$rowUserId = mysqli_fetch_row($result);

				$areFavStored = "SELECT COUNT(*) FROM favourites WHERE user_id = " . $rowUserId[0] . "";

				$retrievedFavNumber = mysqli_query($con, $areFavStored);
				$row = mysqli_fetch_row($retrievedFavNumber);
				if ($row[0] > 0) {

					$retreiveFavSQL = "SELECT internships.internship_id, internships.internship_title, internships.company_name, internships.company_location, internships.internship_discipline, internships.date_posted FROM internships INNER JOIN  favourites ON internships.internship_id = favourites.internship_id WHERE favourites.user_id =" . $rowUserId[0]."";

					$retrievedFav = mysqli_query($con, $retreiveFavSQL);
					$wantedHtmlToReturn = '';
					while($favrow = mysqli_fetch_array($retrievedFav)){
						$wantedHtmlToReturn  .= '
						<div id="resultBox"><div id="resultContent">' . 
						'<div id="resultTitle">' . 

						$favrow['internship_title'] . '</div>' .
						'<div id="resultCompany">' . $favrow['company_name'] . '</div>' .
									 
						'<div id="resultLocation">' . 
						$favrow['company_location'] . '</div>' .
						'<form method="post" action="">
						<div id="seeMoreBox"><div id="seeMoreContent"><input id="moveToDetailsSubmit" name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
						'<input type="hidden" name="internshipID" value="' . $favrow['internship_id'] . '"/></form>
						<form method="post" action="">
							<div id="removeFromFavBox">
								<input type="hidden" name="internshipID" value="' . $favrow['internship_id'] . '"/>
								<input id="removeFromFav" name="removeFromFav" type="submit" value="Remove"/>
							</div>
						</form>
						<div id="resultDiscipline">' . 'Field: '. $favrow['internship_discipline'] . '</div>' .
						'<div id="resultDate">' . 'Date Posted:<br>' . 
						$favrow['date_posted'] . '</div>' .
						'</div></div>';
					}	
					mysqli_free_result($retrievedFav);
					mysqli_free_result($result);
					return $wantedHtmlToReturn;				
				}
				else{
					$wantedHtmlToReturn = 'There are no internships stored in your favourites.';
					return $wantedHtmlToReturn; 
				}
			}

			function returnUploads(){
				$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');

				if (!$con) {
					echo "Connection error" . "<br>" . mysqli_connect_error();
				}

				$retrieveUserIdSQL = "SELECT user_id from users where username = '" . $_SESSION['username'] . "'";
				$result = mysqli_query($con, $retrieveUserIdSQL);
				$rowUserId = mysqli_fetch_row($result);

				$areUploadsStored = "SELECT COUNT(*) FROM uploads WHERE user_id = " . $rowUserId[0] . "";

				$retrievedUplNumber = mysqli_query($con, $areUploadsStored);
				$row = mysqli_fetch_row($retrievedUplNumber);
				if ($row[0] > 0) {

					$retreiveUplSQL = "SELECT internships.internship_id, internships.internship_title, internships.company_name, internships.company_location, internships.internship_discipline, internships.date_posted FROM internships INNER JOIN  uploads ON internships.internship_id = uploads.internship_id WHERE uploads.user_id =" . $rowUserId[0]."";

					$retrievedUpl = mysqli_query($con, $retreiveUplSQL);
					$wantedHtmlToReturn = '';
					while($uplrow = mysqli_fetch_array($retrievedUpl)){
						$wantedHtmlToReturn  .= '
						<div id="resultBox"><div id="resultContent">' . 
						'<div id="resultTitle">' . 

						$uplrow['internship_title'] . '</div>' .
						'<div id="resultCompany">' . $uplrow['company_name'] . '</div>' .
									 
						'<div id="resultLocation">' . 
						$uplrow['company_location'] . '</div>' .
						'<form method="post" action="">
						<div id="seeMoreBox"><div id="seeMoreContent"><input id="moveToDetailsSubmit" name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
						'<input type="hidden" name="internshipID" value="' . $uplrow['internship_id'] . '"/></form>
						<form method="post" action="">
							<div id="removeFromFavBox">
								<input type="hidden" name="internshipID" value="' . $uplrow['internship_id'] . '"/>
								<input id="removeUpload" name="removeUpload" type="submit" value="Delete"/>
							</div>
						</form>
						<div id="resultDiscipline">' . 'Field: '. $uplrow['internship_discipline'] . '</div>' .
						'<div id="resultDate">' . 'Date Posted:<br>' . 
						$uplrow['date_posted'] . '</div>' .
						'</div></div>';
					}	
					mysqli_free_result($retrievedUpl);
					mysqli_free_result($result);
					return $wantedHtmlToReturn;				
				}
				else{
					$wantedHtmlToReturn = 'There are no internships posted.';
					return $wantedHtmlToReturn; 
				}
			}

			if (isset($_POST['moveToDetailsSubmit'])) {
				$_SESSION['selected_internship_id'] = $_POST['internshipID'];
				// echo $_SESSION['selected_internship_id'];
				header("Location: http://localhost/project/detailedInternship.php");
				exit();
			}
			if (isset($_POST['removeFromFav'])) {
				$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');
				if (!$con) {
					echo "Connection error" . "<br>" . mysqli_connect_error();
				}
				$retrieveUserIdSQL = "SELECT user_id from users where username = '" . $_SESSION['username'] . "'";
				$result = mysqli_query($con, $retrieveUserIdSQL);
				$rowUserId = mysqli_fetch_row($result);

				$removeFromFavSQL = "DELETE FROM favourites
									 WHERE user_id = ".$rowUserId[0]." AND internship_id = ". $_POST['internshipID'] ."";
				if(!mysqli_query($con, $removeFromFavSQL)){
					echo "Error: " . $removeFromFavSQL . "<br>" . mysqli_error($con);
				}
				header("Location: http://localhost/project/settings.php");
				exit();
			}
			if(isset($_POST['removeUpload'])){
				$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');
				if (!$con) {
					echo "Connection error" . "<br>" . mysqli_connect_error();
				}

				$removeFromInternSQL = "DELETE FROM internships
										WHERE internship_id = ". $_POST['internshipID'] ."";
				if(!mysqli_query($con, $removeFromInternSQL)){
					echo "Error: " . $removeFromInternSQL . "<br>" . mysqli_error($con);
				}
				$removeFromPostsSQL = "DELETE FROM uploads
										WHERE internship_id = ". $_POST['internshipID'] ."";
				if(!mysqli_query($con, $removeFromPostsSQL)){
					echo "Error: " . $removeFromPostsSQL . "<br>" . mysqli_error($con);
				}
				header("Location: http://localhost/project/settings.php");
				exit();
				// THE RECORD IS REMOVED FROM THE UPLOADS OF THE USER THAT UPLOADED IT AND FROM THE TABLE OF INTERNSHIPS. The instrenship id is not removed from the favourites table, but that doesn't matter, because it doesn't display it either way (becuase when we retrieve the fav. we inner join the fav. table with the intern. table, and since the internship doesn't exist on the intern. table, it cannot retrieve it). 
			}
			ob_end_flush();
		?>
	</section>

	<footer>
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