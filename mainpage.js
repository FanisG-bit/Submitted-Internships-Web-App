window.onbeforeunload = function () {
    window.scrollTo(0, 0);
};

document.addEventListener('DOMContentLoaded', function(){
	
	var aTags = document.getElementsByTagName('a');
	for (var i = 0; i < aTags.length; i++) {
		aTags[i].style.cursor = 'pointer';
	}

	document.getElementById('search_button_content').addEventListener('mouseover',function(){
		document.getElementById('search_button_content').style.cursor = 'pointer';
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

	var settingsImage = document.getElementById('settingsImage');
	if (settingsImage != null) {
		document.getElementById('settingsImage').addEventListener('mouseover', function(){
			document.getElementById('settingsImage').src = 'images/main/settings (1).png';
		});
		document.getElementById('settingsImage').addEventListener('mouseleave', function(){
			document.getElementById('settingsImage').src = 'images/main/settings.png';
		});
	}

	document.getElementById('search_button_box').addEventListener('mouseover', function(){
		document.getElementById('search_button_box').style.borderColor = 'yellow';
		document.getElementById('search_button_content').style.color = 'yellow';
	});	

	document.getElementById('search_button_box').addEventListener('mouseleave', function(){
		document.getElementById('search_button_box').style.borderColor = 'white';
		document.getElementById('search_button_content').style.color = 'white';
	});	

	var socialMediaElements = document.getElementsByClassName('media_title');
	for (var i = 0; i < socialMediaElements.length; i++) {
		socialMediaElements[i].style.cursor = 'pointer';
	}

	var disciplineBoxes = document.getElementsByClassName('discipline_box');
	for (var i = 0; i < disciplineBoxes.length; i++) {
		disciplineBoxes[i].style.cursor = 'pointer';
	}

	document.getElementById('hamburger_icon').addEventListener('click', function(){
		var status = document.getElementById('hamburger_icon_dropdown_box').style.display;
		console.log(status);
		document.getElementById('hamburger_icon_dropdown_box').style.display = 'block';
		if (status === 'block') {
			document.getElementById('hamburger_icon_dropdown_box').style.display = 'none';	
		}
	});

});

function changeHoveredDiscipline(id){
	document.getElementById(id).style.backgroundColor = '#48D1CC';
}

function changeDisciplineToDefault(id){
	document.getElementById(id).style.backgroundColor = '#d3d3d3';
}