function changeSignUpColor(id){
	document.getElementById(id).style.backgroundColor = 'orange';
}

function changeCancelColor(id){
	document.getElementById(id).style.backgroundColor = '#909090';
}	

function changeSignDefault(){
	document.getElementById('signup').style.backgroundColor = 'red';	
}

function changeCancelDefault(){
	document.getElementById('cancel').style.backgroundColor = 'gray';	
}

document.addEventListener('DOMContentLoaded', function(){
	document.getElementById('signup').style.cursor = 'pointer';
	document.getElementById('cancel').style.cursor = 'pointer';
	document.getElementById('terms').style.cursor = 'pointer';
	var aTags = document.getElementsByTagName('a');
	for (var i = 0; i < aTags.length; i++) {
		aTags[i].style.cursor = 'pointer';
	}

	var counter = 1;
	document.getElementById('showPasswordIcon').addEventListener('click', function(){
		if (counter % 2 == 0) {
			document.getElementById('showPasswordIcon').src = "images/signup/private.png";
		}
		else{
			document.getElementById('showPasswordIcon').src = "images/signup/view.png";	
		}
		counter++;
	});

});


function planChecked(){
	if (document.getElementById('student').checked || 
		document.getElementById('employer').checked) {
		return true;
	}
	else{
		alert('One of the signing plans should be checked.');
		return false;
	}
}

function validateUsernameLength(){
	var username = document.getElementById('username_field').value;
	if (username.length >= 6 && username.length <= 30) {
		return true;
	}
	else{
		alert('Username should be between 6 to 30 characters.');
		return false;
	}
}
function validatePassword(){
	var password = document.getElementById('password_field').value;
	if (password.length >= 8 && password.length <= 128) {
		return true;
	}
	else {
		alert('Password should be between 8 to 128 characters.');
		return false;
	}
}

function checkedTerms(){
	if(document.getElementById('agreeBox').checked){
		return true;
	}
	else {
		alert('For the creation of an account, you should agree to the terms.');
		return false;
	}
}

function isEmailProvided(){
	var mailformat = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
	if(document.getElementById('email_field').value.match(mailformat)){
		return true;
	}
	else{
		alert('An email account should be provided.');
		return false;
	}
}

function validateForm(){
	if (planChecked() && validateUsernameLength() && validatePassword()
		&& isEmailProvided() && checkedTerms()) {
		alert('all fine!');
		return true;
	}
	else{
		return false;
	}
}

function showPassword() {
  var x = document.getElementById("password_field");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}