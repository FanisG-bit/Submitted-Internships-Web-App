document.addEventListener('DOMContentLoaded', function(){
	var aTags = document.getElementsByTagName('a');
		for (var i = 0; i < aTags.length; i++) {
			aTags[i].style.cursor = 'pointer';
	}
});