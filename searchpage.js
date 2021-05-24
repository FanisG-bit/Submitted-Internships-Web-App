document.addEventListener('DOMContentLoaded', function(){
	
	var aTags = document.getElementsByTagName('a');
	for (var i = 0; i < aTags.length; i++) {
		aTags[i].style.cursor = 'pointer';
	}


	var settingsImage = document.getElementById('settingsImage');
	if (settingsImage != null) {
		document.getElementById('settingsImage').addEventListener('mouseover', function(){
			document.getElementById('settingsImage').src = 'images/main/settings (1).png';
		});
		document.getElementById('settingsImage').addEventListener('mouseleave', function(){
			document.getElementById('settingsImage').src = 'images/main/settings.png';
		});
	}
	
	document.getElementById('disciplines_button').addEventListener('click', function(){
		document.getElementById('location_options').style.display = 'none';
		var status = document.getElementById('discipline_options').style.display;
		document.getElementById('discipline_options').style.display = 'block';
		if (status === 'block') {
			document.getElementById('discipline_options').style.display = 'none';	
		}
		// console.log(status);
	});

	document.getElementById('location_button').addEventListener('click', function(){
		document.getElementById('discipline_options').style.display = 'none';
		var status = document.getElementById('location_options').style.display;
		document.getElementById('location_options').style.display = 'block';
		if (status === 'block') {
			document.getElementById('location_options').style.display = 'none';	
		}
		// console.log(status);
	});

	var toggle = document.getElementsByClassName('switch'); 
			
	function closeCheckBoxes(){
		document.getElementById('discipline_options').style.display = 'none';
		document.getElementById('location_options').style.display = 'none';
	}

	for (var i = 0; i < toggle.length; i++) {
		toggle[i].addEventListener('click', closeCheckBoxes);
	}

	document.getElementById('searchField').addEventListener('click', function(){
		document.getElementById('discipline_options').style.display = 'none';
		document.getElementById('location_options').style.display = 'none';	
	});

	document.getElementById('searchButton').addEventListener('click', function(){
		document.getElementById('discipline_options').style.display = 'none';
		document.getElementById('location_options').style.display = 'none';	
	});

	document.getElementById('hamburger_icon').addEventListener('click', function(){
		var status = document.getElementById('hamburger_icon_dropdown_box').style.display;
		document.getElementById('hamburger_icon_dropdown_box').style.display = 'block';
		if (status === 'block') {
			document.getElementById('hamburger_icon_dropdown_box').style.display = 'none';	
		}
	});

	var signinElement = document.getElementById('siggin_button');
	if (signinElement != null) {
		document.getElementById('siggin_button').addEventListener('mouseover', function(){
			document.getElementById('siggin_button').style.backgroundColor = '#909090';
		});

		document.getElementById('siggin_button').addEventListener('mouseleave', function(){
			document.getElementById('siggin_button').style.backgroundColor = 'gray';
		});	
	}

	var signupElement = document.getElementById('signup_button');
	if (signupElement != null) {
		document.getElementById('signup_button').addEventListener('mouseover', function(){
			document.getElementById('signup_button').style.backgroundColor = 'orange';
		});

		document.getElementById('signup_button').addEventListener('mouseleave', function(){
			document.getElementById('signup_button').style.backgroundColor = '#ff0000';
		});	
	}

	var numberOfItems = 10;
	var resultBoxes = document.getElementsByClassName('boxesresults');
	try{
		for (var i = 0; i < numberOfItems; i++) {
			resultBoxes[i].style.display = 'block';
		}
	}catch(Error){

	}

	document.getElementById('loadMoreButton').addEventListener('click', function(){
		numberOfItems += 10;
		var resultBoxes = document.getElementsByClassName('boxesresults');
		try{
			for (var i = 0; i < numberOfItems; i++) {
				resultBoxes[i].style.display = 'block';
			}
		}
		catch(Error){
			// we catch the case were the script is trying to change the style of an element
			// that is non-existing.
		}
	});
});