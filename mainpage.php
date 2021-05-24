<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>searchInternships</title>
	<link rel="stylesheet" href="mainpage.css?v=<?php echo time(); ?>">
	<script type="text/javascript" src="mainpage.js?v=<?php echo time(); ?>"></script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width", initial-scale=1>

</head>
<body>
	<header>
		<div id="navigation_box"> 
			<div id="navigation_content">
				<a href="http://localhost/project/mainpage.php"><img src="images/main/internship.png" id="title_image"></a>
				<h2 id="title_name"><a href="http://localhost/project/mainpage.php">searchInternships</a></h2>
				<?php
					if (!isset($_SESSION['username'])) { 
						echo '<div id="siggin_button">
							<div id="siggin_button_content"><a href="http://localhost/project/login.php">sign in</a></div>
						</div>
						<div id="signup_button">
							<div id="signup_button_content"><a href="http://localhost/project/signup.php">sign up</a></div>
						</div>';
					}
					else{
						// same stylings different use (we can use the 'signup_button' id since in 
						// that case it isn't being used by no other tag-element)
						echo '
							<form method="post" action="">
							<div id="signup_button">
								<div id="signup_button_content"><input type="submit" name="logout" value="log out"/></div>
							</div>
							</form>';
							if (isset($_POST['logout'])) {
								unset($_SESSION['username']);
								header("Location: http://localhost/project/mainpage.php");
								exit();
							}
					}
				?>
				<div id="settingsIcon">
					<a href="http://localhost/project/settings.php"><img src="images/main/settings.png" style="width: 40px;" id="settingsImage"></a>
				</div>

				<div id="hamburger_icon">
					<img src="images/main/square.png" style="width: 40px;">
					<?php
						if (!isset($_SESSION['username'])) {
							echo '<div id="hamburger_icon_dropdown_box">';
						}
						else{
							echo '<div id="hamburger_icon_dropdown_box" style="position: absolute;
								right: -4px; 
								height: 60px;
								width: 200px;
								background-color: black;
								top: 40px;
								border-radius: 10px;
								padding: 13px;
								display: none;">';;
						}
					?>
						<div id="hamburger_icon_dropdown_content">
							<?php
								if (!isset($_SESSION['username'])) { 
									echo '<div id="siggin_button_content" class="collapsedButtons"><a href="http://localhost/project/login.php">sign in</a></div>
									<div id="signup_button_content" style="margin-top: 20px;" class="collapsedButtons"><a href="http://localhost/project/signup.php">sign up</a></div>
									<div id="settings" style="margin-top: 20px;" class="collapsedButtons"><a href="http://localhost/project/settings.php">settings</a></div>';
								}else{
									echo '
									<form method="post" action="">
									<div id="siggin_button_content" class="collapsedButtons"><input type="submit" name="logout" value="log out"/></div>
									</form>
									<div id="settings" class="collapsedButtons"><a href="http://localhost/project/settings.php">settings</a></div>';
									
									if (isset($_POST['logout'])) {
										unset($_SESSION['username']);
										header("Location: http://localhost/project/mainpage.php");
										exit();
									}
								}
							?>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</header>
	<section>
		<div id="greeting_part_box">
			<div id="greeting_part_content">
				<p id="greeting_message">
					Start your future here
				</p>
				<p id="greetings_details">
					Make your first career step by finding an internship. On our site you will find opportunities from all around Europe.
				</p>
				<div><img src="images/main/paper-plane.png" alt="paper-plane" id="paper_plane_image"></div>
				<div id="search_button_box">
					<div id="search_button_content">
						<a href="http://localhost/project/searchpage.php">Let's begin!</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section id="boxes">
		<div id="boxes_content">
			<div id="student_box">
				<div id="student_box_content">
					<img src="images/main/student-icon.png" alt="student-icon" id="student-icon">
					<div id="student_box_title">
						Student
					</div>
					<div id="student_box_text">
						<p>
							By creating a &lt;student&gt; account you can store your findings and apply for them! 
						</p>
					</div>
				</div>
			</div>
			<div id="employer_box">
				<div id="employer_box_content">
					<img src="images/main/employer-icon.png" alt="employer-icon" id="employer-icon">
					<div id="employer_box_title">
						Employer
					</div>
					<div id="employer_box_text">
						<p>
							If you are looking to recruit people, be sure to create an &lt;employer&gt; account! 
						</p>
					</div>
				</div>
			</div>
			<div id="upgrade_box">
				<div id="upgrade_box_content">
					<img src="images/main/upgrade.png" alt="upgrade-icon" id="upgrade-icon">
					<div id="upgrade_box_title">
							Upgrade
					</div>
					<div id="upgrade_box_text">
						<p>
							You always have the option to upgrade your student account, later as your career progresses! 
						</p>
					</div>
				</div>
			</div>
		</div>	
	</section>
	<section id="options_section">
		<div id="options_box">
			<div id="options_box_content">
				<div id="options_title">
					Choose based on your interest
				</div>
				<div class="discipline_box" id="Journalism" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/newspaper.png" alt="math_icon" class="discipline_icon">
						<div class="discipline_title">Journalism</div>
					</div>
				</div>
				<div class="discipline_box" id="NaturalSciences" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/calculating.png" alt="math_icon" class="discipline_icon">
						<div class="discipline_title">Natural Sciences</div>
					</div>
				</div>
				<div class="discipline_box" id="Tourism" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/travel.png" alt="tourism_icon" class="discipline_icon">
						<div class="discipline_title">Tourism</div>
					</div>
				</div>
				<div class="discipline_box" id="Law" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/auction.png" alt="law_icon" class="discipline_icon">
						<div class="discipline_title">Law</div>
					</div>
				</div>
				<div class="discipline_box" id="Medicine" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/pharmacy.png" alt="medicine_icon" class="discipline_icon">
						<div class="discipline_title">Medicine</div>
					</div>
				</div>
				<div class="discipline_box" id="Environmental" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/seeding.png" alt="environmental_icon" class="discipline_icon">
						<div class="discipline_title">Environmental</div>
					</div>
				</div>
				<div class="discipline_box" id="Engineering" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/prototype.png" alt="engineering_icon" class="discipline_icon">
						<div class="discipline_title">Engineering</div>
					</div>
				</div>
				<div class="discipline_box" id="Education" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/education.png" alt="education_icon" class="discipline_icon">
						<div class="discipline_title">Education</div>
					</div>
				</div>
				<div class="discipline_box" id="CompScience" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/dna.png" alt="compScience_icon" class="discipline_icon">
						<div class="discipline_title">Computer Science</div>
					</div>
				</div>
				<div class="discipline_box" id="Business" onmousemove="changeHoveredDiscipline(this.id)" onmouseleave="changeDisciplineToDefault(this.id)">
					<div class="discipline_box_content">
						<img src="images/main/team.png" alt="business_icon" class="discipline_icon">
						<div class="discipline_title">Business</div>
					</div>
				</div>
			</div>
		</div>
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