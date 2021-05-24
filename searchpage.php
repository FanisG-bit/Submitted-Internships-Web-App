<?php
	// header('Cache-Control: no cache'); //this and the below fixes the error 'ERR_CACHE_MISS' which required the user to refresh (and repost) in order to load the page (it's caused when we're in the internship description page and we're trying to go back to search page).
	// session_cache_limiter('private_no_expire');
	session_start();
	ob_start(); // fixes the 'cannot modify header information' problem
?>
<!DOCTYPE html>
<html>
<head>
	<title>searchInternships</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="searchpage.css?v=<?php echo time(); ?>"> <!-- <- this fixes the problem with the php stylings not displaying which is a problem related to cache --> 
	<script type="text/javascript" src="searchpage.js?v=<?php echo time(); ?>"></script>
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
	<section id="searching_section">
		<div id="searchsort_box">
			<form method="POST" action="" name="searchForm">
				<div id="searchsort_content" class="row">
					<p id="spacebetweenChoose"><b>Choose By:</b></p>
					<div style="position: relative;"> <!-- we wrap them in order for the absolute element to have an anchor on the button (seemingly) and not elsewhere -->
						<button type="button" class="btn btn-secondary dropdown-toggle" id="disciplines_button">Discipline</button>
						
						<div id="discipline_options">
							<div id="discipline_options_content">
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Journalism"> Journalism<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Natural Sciences"> Natural Sciences<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Tourism"> Tourism<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Law"> Law<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Medicine"> Medicine<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Environmental"> Environmental<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Engineering"> Engineering<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Education"> Education<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Computer Science"> Computer Science<br>
								<input class="disciplines" type="checkbox" name="disciplines[]" value="Business"> Business<br>
							</div>
						</div>
					</div>

					<div style="position: relative;"> 
						<button type="button" class="btn btn-secondary dropdown-toggle" id="location_button">Location</button>
						
						<div id="location_options">
							<div id="location_options_content">
								<input class="locations" type="checkbox" name="locations[]" value="Austria"> Austria<br>
								<input class="locations" type="checkbox" name="locations[]" value="UK"> UK<br>
								<input class="locations" type="checkbox" name="locations[]" value="Belgium"> Belgium<br>
								<input class="locations" type="checkbox" name="locations[]" value="Bulgaria"> Bulgaria<br>
								<input class="locations" type="checkbox" name="locations[]" value="Croatia"> Croatia<br>
								<input class="locations" type="checkbox" name="locations[]" value="Cyprus"> Cyprus<br>
								<input class="locations" type="checkbox" name="locations[]" value="Czechia"> Czechia<br>
								<input class="locations" type="checkbox" name="locations[]" value="Denmark"> Denmark<br>
								<input class="locations" type="checkbox" name="locations[]" value="Finland"> Finland<br>
								<input class="locations" type="checkbox" name="locations[]" value="France"> France<br>
								<input class="locations" type="checkbox" name="locations[]" value="Germany"> Germany<br>
								<input class="locations" type="checkbox" name="locations[]" value="Greece"> Greece<br>
								<input class="locations" type="checkbox" name="locations[]" value="Ireland"> Ireland<br>
								<input class="locations" type="checkbox" name="locations[]" value="Italy"> Italy<br>
								<input class="locations" type="checkbox" name="locations[]" value="Netherlands"> Netherlands<br>
								<input class="locations" type="checkbox" name="locations[]" value="Poland"> Poland<br>
								<input class="locations" type="checkbox" name="locations[]" value="Romania"> Romania<br>
								<input class="locations" type="checkbox" name="locations[]" value="Spain"> Spain<br>
								<input class="locations" type="checkbox" name="locations[]" value="Sweden"> Sweden<br>
							</div>
						</div>
					</div>
					<h5 style="margin-right: 10px;">Sort by date</h5>
					<label class="switch">
					  <input type="checkbox" name="toggle">
					  <span class="slider round"></span>
					</label>
					<div id="seachFieldAndButton">
						<input type="search" name="searchField" id="searchField" placeholder="find intership" autocomplete="off">
						<button type="submit" class="btn btn-outline-primary" id="searchButton" name="Submit">Search</button>
					</div>
				</div>
			</form>	
		</div>	
	</section>
	<section id="results_section" style="overflow: auto; z-index: 1;"> <!-- prevent div overlap -->
		<?php include('processSearchInput.php'); ?>
	</section>
	<section style="text-align: center;">
		<div id="loadMore">
			<!-- <form method="post"> -->
				<!-- <button type="submit" class="btn btn-outline-primary" id="loadMoreButton" name="loadMore"> -->
				<button class="btn btn-outline-primary" id="loadMoreButton">
				Load More Results</button>
			<!-- </form> -->
		</div>
	</section>
	<footer style="margin-top: 50px;">
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