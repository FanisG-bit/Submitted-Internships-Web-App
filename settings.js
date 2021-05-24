document.addEventListener('DOMContentLoaded', function(){
	var aTags = document.getElementsByTagName('a');
		for (var i = 0; i < aTags.length; i++) {
			aTags[i].style.cursor = 'pointer';
	}
	var createPost = document.getElementById('createPost');
	var favourites = document.getElementById('favourites');
	var account = document.getElementById('account');
	var viewUploads = document.getElementById('viewUploads');

	if (viewUploads !=null || createPost != null || (favourites != null && account != null)) {
		
		if (createPost != null) {
				document.getElementById('createPost').addEventListener('click', function(){
				document.getElementById('secondhalfBox').style.height = '900px';
				document.getElementById('choicesBox').style.height = '900px';
				var w = window.innerWidth;
				var h = window.innerHeight;
				if(w <= 650){
					document.getElementById('choicesBox').style.height = '170px';
				}
				document.getElementById('secondhalfFavourites').style.display = 'none';
				document.getElementById('secondhalfInsertInternship').style.display = 'block';
				document.getElementById('secondhalfviewUploadsBox').style.display = 'none';
				document.getElementById('secondhalfContent').style.display = 'none';
				document.getElementById('createPost').style.fontWeight  = 'bold';
				document.getElementById('favourites').style.fontWeight  = 'normal';
				document.getElementById('account').style.fontWeight  = 'normal';
				document.getElementById('viewUploads').style.fontWeight  = 'normal';
			});

			document.getElementById('favourites').addEventListener('click', 
				function(){
					document.getElementById('secondhalfBox').style.height = '450px';
					document.getElementById('choicesBox').style.height = '450px';
					var w = window.innerWidth;
					var h = window.innerHeight;
					if(w <= 650){
						document.getElementById('choicesBox').style.height = '170px';
					}
					document.getElementById('secondhalfFavourites').style.display = 'block';
					document.getElementById('secondhalfInsertInternship').style.display = 'none';
					document.getElementById('secondhalfContent').style.display = 'none';
					document.getElementById('secondhalfviewUploadsBox').style.display = 'none';
					document.getElementById('favourites').style.fontWeight  = 'bold';
					document.getElementById('createPost').style.fontWeight  = 'normal';
					document.getElementById('account').style.fontWeight  = 'normal';
					document.getElementById('viewUploads').style.fontWeight  = 'normal';
			})

			document.getElementById('account').addEventListener('click', 
				function(){
					document.getElementById('secondhalfBox').style.height = '450px';
					document.getElementById('choicesBox').style.height = '450px';
					var w = window.innerWidth;
					var h = window.innerHeight;
					if(w <= 650){
						document.getElementById('choicesBox').style.height = '170px';
					}
					document.getElementById('secondhalfFavourites').style.display = 'none';
					document.getElementById('secondhalfviewUploadsBox').style.display = 'none';
					document.getElementById('secondhalfInsertInternship').style.display = 'none';
					document.getElementById('secondhalfContent').style.display = 'block';
					document.getElementById('account').style.fontWeight  = 'bold';
					document.getElementById('createPost').style.fontWeight  = 'normal';
					document.getElementById('favourites').style.fontWeight  = 'normal';
					document.getElementById('viewUploads').style.fontWeight  = 'normal';
			})

			document.getElementById('viewUploads').addEventListener('click', 
				function(){
					document.getElementById('secondhalfBox').style.height = '450px';
					document.getElementById('choicesBox').style.height = '450px';
					var w = window.innerWidth;
					var h = window.innerHeight;
					if(w <= 650){
						document.getElementById('choicesBox').style.height = '170px';
					}
					document.getElementById('secondhalfviewUploadsBox').style.display = 'block';
					document.getElementById('secondhalfInsertInternship').style.display = 'none';
					document.getElementById('secondhalfContent').style.display = 'none';
					document.getElementById('secondhalfFavourites').style.display = 'none';
					document.getElementById('viewUploads').style.fontWeight  = 'bold';
					document.getElementById('createPost').style.fontWeight  = 'normal';
					document.getElementById('account').style.fontWeight  = 'normal';
					document.getElementById('favourites').style.fontWeight  = 'normal';
			})

			document.getElementById('account').addEventListener('mouseover', function(){
				document.getElementById('account').style.cursor = 'pointer';
			});

			document.getElementById('favourites').addEventListener('mouseover', function(){
				document.getElementById('favourites').style.cursor = 'pointer';
			});

			document.getElementById('createPost').addEventListener('mouseover', function(){
				document.getElementById('createPost').style.cursor = 'pointer';
			});

			document.getElementById('viewUploads').addEventListener('mouseover', function(){
				document.getElementById('viewUploads').style.cursor = 'pointer';
			});
		}

		document.getElementById('favourites').addEventListener('click', 
			function(){
				document.getElementById('secondhalfBox').style.height = '450px';
				document.getElementById('choicesBox').style.height = '450px';
				var w = window.innerWidth;
				var h = window.innerHeight;
				if(w <= 650){
					document.getElementById('choicesBox').style.height = '170px';
				}
				document.getElementById('secondhalfFavourites').style.display = 'block';
				document.getElementById('secondhalfInsertInternship').style.display = 'none';
				document.getElementById('secondhalfContent').style.display = 'none';
				document.getElementById('favourites').style.fontWeight  = 'bold';
				document.getElementById('account').style.fontWeight  = 'normal';
		})

		document.getElementById('account').addEventListener('click', 
			function(){
				document.getElementById('secondhalfBox').style.height = '450px';
				document.getElementById('choicesBox').style.height = '450px';
				var w = window.innerWidth;
				var h = window.innerHeight;
				if(w <= 650){
					document.getElementById('choicesBox').style.height = '170px';
				}
				document.getElementById('secondhalfFavourites').style.display = 'none';
				document.getElementById('secondhalfInsertInternship').style.display = 'none';
				document.getElementById('secondhalfContent').style.display = 'block';
				document.getElementById('account').style.fontWeight  = 'bold';
				document.getElementById('favourites').style.fontWeight  = 'normal';
		})

		document.getElementById('account').addEventListener('mouseover', function(){
			document.getElementById('account').style.cursor = 'pointer';
		});

		document.getElementById('favourites').addEventListener('mouseover', function(){
			document.getElementById('favourites').style.cursor = 'pointer';
		});
	}
});