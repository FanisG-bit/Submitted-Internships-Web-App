<?php 
	$con = mysqli_connect('localhost', 'fanis', 'JK3245', 'searchinternships_database');

	if (!$con) {
		echo "Connection error" . "<br>" . mysqli_connect_error();
	}

	$retrieveDefaultResults = true;

	if(isset($_POST['Submit'])){
		$retrieveDefaultResults = false;

		if(isset($_POST['disciplines'])){
			$disciplines = $_POST['disciplines'];
		}
		if(isset($_POST['locations'])){
			$locations = $_POST['locations'];
		}
		if(isset($_POST['toggle'])){
			$sortByDate = $_POST['toggle'];
		}
		// SEARCH INPUT 
		if(isset($_POST['searchField'])){
			$searchWord = $_POST['searchField'];
		}

		// CASE 1: SELECTED DISCIPLINE BUT NOT LOCATION AND SORT BY DATE (TOGGLE)
		// code related to discipline checkboxes
		if(!empty($disciplines) && empty($locations) && empty($sortByDate) && empty($searchWord)){
			$combineSelectedDisc = '';
			for ($i=0; $i < count($disciplines); $i++) { 
				if($i != count($disciplines) - 1){
				   $combineSelectedDisc .= "'" . $disciplines[$i] . "'" . ', ';
				}
				else{
				   $combineSelectedDisc .= "'" . $disciplines[$i] . "'" .'';
				}
			}
			$retrieveResViaDiscipSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE internship_discipline IN(' . $combineSelectedDisc . ')';	
			$DisciplineResults = mysqli_query($con, $retrieveResViaDiscipSQL);

			while($row = mysqli_fetch_array($DisciplineResults)){
				echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
			}
			if (!$DisciplineResults) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

		// CASE 2: SELECTED LOCATION BUT NOT DISCIPLINE AND NOT SORT BY DATE (TOGGLE)
		// code related to location checkboxes
		if(!empty($locations) && empty($disciplines) && empty($sortByDate) && empty($searchWord)){
			$combineSelectedLoc = '';
			for ($i=0; $i < count($locations); $i++) { 
				if($i != count($locations) - 1){
				   $combineSelectedLoc .= "'" . $locations[$i] . "'" . ', ';
				}
				else{
				   $combineSelectedLoc .= "'" . $locations[$i] . "'" .'';
				}
			}
			$retrieveResViaLocSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE company_location IN(' . $combineSelectedLoc . ')';	
			$LocationResults = mysqli_query($con, $retrieveResViaLocSQL);

			while($row = mysqli_fetch_array($LocationResults)){
				echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
			}
			if (!$LocationResults) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

		// CASE 3: SELECTED BOTH LOCATIONS AND DISCIPLINES BUT NOT SORT BY DATE (TOGGLE)
		if(!empty($locations) && !empty($disciplines) && empty($sortByDate) && empty($searchWord)){
			$combineSelectedDisc = '';
			for ($i=0; $i < count($disciplines); $i++) { 
				if($i != count($disciplines) - 1){
				   $combineSelectedDisc .= "'" . $disciplines[$i] . "'" . ', ';
				}
				else{
				   $combineSelectedDisc .= "'" . $disciplines[$i] . "'" .'';
				}
			}
			$retrieveResViaDiscipSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE internship_discipline IN(' . $combineSelectedDisc . ')';	
			$DisciplineResults = mysqli_query($con, $retrieveResViaDiscipSQL);

			$combineSelectedLoc = '';
			for ($i=0; $i < count($locations); $i++) { 
				if($i != count($locations) - 1){
				   $combineSelectedLoc .= "'" . $locations[$i] . "'" . ', ';
				}
				else{
				   $combineSelectedLoc .= "'" . $locations[$i] . "'" .'';
				}
			}
			$retrieveResViaLocSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE company_location IN(' . $combineSelectedLoc . ')';	
			$LocationResults = mysqli_query($con, $retrieveResViaLocSQL);

			$locations1 = [];
			$disciplines1 = [];
			while($result1row = mysqli_fetch_array($DisciplineResults)){
				$locations1[] = $result1row['company_location'];
				$disciplines1[] = $result1row['internship_discipline'];
			}
			// print_r($locations1);
			// print_r($disciplines1);
			while($result2row = mysqli_fetch_array($LocationResults)){
				if (in_array($result2row['company_location'], $locations1) 
					&& in_array($result2row['internship_discipline'], $disciplines1)){

					echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $result2row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $result2row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $result2row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $result2row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $result2row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $result2row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
				}
			}
			if (!$LocationResults || !$DisciplineResults) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

		// CASE 4: SELECTED SORT BY DATE, NOT SELECTED DISCIPLINE, NOT SELECTED LOCATION
		if (!empty($sortByDate) && empty($locations) && empty($disciplines) && empty($searchWord)) {
			$retrieveOnlyRecentSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships ORDER BY date_posted DESC';		
			$sortByDate = mysqli_query($con, $retrieveOnlyRecentSQL);

			while($row = mysqli_fetch_array($sortByDate)){
				
				echo '<form method="post" action="" class="boxesresults" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
			}
			if (!$sortByDate) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

		// CASE 5: SELECTED SORT BY DATE AND DISCIPLINE BUT NOT LOCATION
		if (!empty($sortByDate) && empty($locations) && !empty($disciplines) && empty($searchWord)){
			$combineSelectedDisc = '';
			for ($i=0; $i < count($disciplines); $i++) { 
				if($i != count($disciplines) - 1){
				   $combineSelectedDisc .= "'" . $disciplines[$i] . "'" . ', ';
				}
				else{
				   $combineSelectedDisc .= "'" . $disciplines[$i] . "'" .'';
				}
			}
			$retrieveResViaDiscipSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE internship_discipline IN(' . $combineSelectedDisc . ')';	
			$retrieveResViaDiscipSQL .= 'ORDER BY date_posted DESC';	
			$DisciplineResults = mysqli_query($con, $retrieveResViaDiscipSQL);
			while($row = mysqli_fetch_array($DisciplineResults)){
				
				echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
			}
			if (!$DisciplineResults) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

		// CASE 6: SELECTED SORT BY DATE AND LOCATION BUT NOT DISCIPLINE
		if (!empty($sortByDate) && !empty($locations) && empty($disciplines) && empty($searchWord)){
			$combineSelectedLoc = '';
			for ($i=0; $i < count($locations); $i++) { 
				if($i != count($locations) - 1){
				   $combineSelectedLoc .= "'" . $locations[$i] . "'" . ', ';
				}
				else{
				   $combineSelectedLoc .= "'" . $locations[$i] . "'" .'';
				}
			}
			$retrieveResViaLocSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE company_location IN(' . $combineSelectedLoc . ')';	
			$retrieveResViaLocSQL .= 'ORDER BY date_posted DESC';	
			$LocationResults = mysqli_query($con, $retrieveResViaLocSQL);

			while($row = mysqli_fetch_array($LocationResults)){
				
				echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
			}
			if (!$LocationResults) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

		// CASE 7: SELECTED BOTH LOCATIONS AND DISCIPLINES AND SORT BY DATE (TOGGLE)
		if(!empty($locations) && !empty($disciplines) && !empty($sortByDate) && empty($searchWord)){
			$combineSelectedDisc = '';
			for ($i=0; $i < count($disciplines); $i++) { 
				if($i != count($disciplines) - 1){
				   $combineSelectedDisc .= "'" . $disciplines[$i] . "'" . ', ';
				}
				else{
				   $combineSelectedDisc .= "'" . $disciplines[$i] . "'" .'';
				}
			}
			$retrieveResViaDiscipSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE internship_discipline IN(' . $combineSelectedDisc . ')';	
			$retrieveResViaDiscipSQL .= 'ORDER BY date_posted DESC';
			$DisciplineResults = mysqli_query($con, $retrieveResViaDiscipSQL);

			$combineSelectedLoc = '';
			for ($i=0; $i < count($locations); $i++) { 
				if($i != count($locations) - 1){
				   $combineSelectedLoc .= "'" . $locations[$i] . "'" . ', ';
				}
				else{
				   $combineSelectedLoc .= "'" . $locations[$i] . "'" .'';
				}
			}
			$retrieveResViaLocSQL = 'SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE company_location IN(' . $combineSelectedLoc . ')';
			$retrieveResViaLocSQL .= 'ORDER BY date_posted DESC';	
			$LocationResults = mysqli_query($con, $retrieveResViaLocSQL);

			$locations1 = [];
			$disciplines1 = [];
			while($result1row = mysqli_fetch_array($DisciplineResults)){
				$locations1[] = $result1row['company_location'];
				$disciplines1[] = $result1row['internship_discipline'];
			}
			while($result2row = mysqli_fetch_array($LocationResults)){
				if (in_array($result2row['company_location'], $locations1) 
					&& in_array($result2row['internship_discipline'], $disciplines1)){

					echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $result2row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $result2row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $result2row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $result2row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $result2row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $result2row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
				}
			}
			if (!$LocationResults || !$DisciplineResults) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

		// SEARCH WORD AND IF WORD MATCHES WITH EITHER THE company name, intern. name or discipline, retrive results.
		// every other sorting option should not be chosen
		if(!empty($searchWord) && empty($locations) && empty($disciplines) && empty($sortByDate)){
			$retrieveSearchResSQL = "SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE company_location LIKE '%$searchWord%' OR internship_title LIKE '%$searchWord%' OR company_name LIKE '%$searchWord%' OR internship_discipline LIKE '%$searchWord%'";
			$retrieveSearchRes = mysqli_query($con, $retrieveSearchResSQL);

			while($row = mysqli_fetch_array($retrieveSearchRes)){
				echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
			}
			if (!$retrieveSearchRes) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

		// SAME SEARCH FUNCTIONALITY EXCEPT THAT THE USER CAN ALSO SORT THE RESULTS BY DATE
		if(!empty($searchWord) && empty($locations) && empty($disciplines) && !empty($sortByDate)){
			$retrieveSearchResSQL = "SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships WHERE company_location LIKE '%$searchWord%' OR internship_title LIKE '%$searchWord%' OR company_name LIKE '%$searchWord%' OR internship_discipline LIKE '%$searchWord%' ORDER BY date_posted DESC";
			$retrieveSearchRes = mysqli_query($con, $retrieveSearchResSQL);

			while($row = mysqli_fetch_array($retrieveSearchRes)){
				echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
			}
			if (!$retrieveSearchRes) {
			    printf("Error: %s\n", mysqli_error($con));
			    exit();
			}
		}

	}	
	// retrive data by default
	if ($retrieveDefaultResults) {
		$retrieveRandomResultsSQL = "SELECT internship_id, internship_title, company_name, company_location, date_posted, internship_discipline from internships";	
		// $retrieveResViaLocSQL .= 'ORDER BY date_posted';
		$randomResults = mysqli_query($con, $retrieveRandomResultsSQL);

		while($row = mysqli_fetch_array($randomResults)){
			echo '<form method="post" action="" class="boxesresults"><div id="resultBox"><div id="resultContent">' . 
				 '<div id="resultTitle">' . 

				 $row['internship_title'] . '</div>' .
				 '<div id="resultCompany">' . $row['company_name'] . '</div>' .
				 
				 '<div id="resultLocation">' . 
				 $row['company_location'] . '</div>' .
				 '<div id="seeMoreBox"><div id="seeMoreContent"><input name="moveToDetailsSubmit" type="submit" value="See More"/></div></div>'.
				 '<input type="hidden" name="internshipID" value="' . $row['internship_id'] . '"/><div id="resultDiscipline">' . 'Field: '. $row['internship_discipline'] . '</div>' .
				 '<div id="resultDate">' . 'Date Posted:<br>' . 
				 $row['date_posted'] . '</div>' .
				 '</div></div></div></form>';
		}
		if (!$randomResults) {
			printf("Error: %s\n", mysqli_error($con));
		    exit();
		}
	}

	// We Retrieve THE ID of the selected internship by storing it as a session value
	// we do that because now, we can retrieve the appropriate information for the "details-page"
	if (isset($_POST['moveToDetailsSubmit'])) {
		$_SESSION['selected_internship_id'] = $_POST['internshipID'];
		// echo $_SESSION['selected_internship_id'];
		header("Location: http://localhost/project/detailedInternship.php");
		exit();
	}
?>