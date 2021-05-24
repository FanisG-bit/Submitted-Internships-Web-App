document.addEventListener('DOMContentLoaded', function(){
	var aTags = document.getElementsByTagName('a');
		for (var i = 0; i < aTags.length; i++) {
			aTags[i].style.cursor = 'pointer';
	}
});

function myMap() {
	var countryHTML = document.getElementById('company_location_id').innerHTML;
	var country = countryHTML.substring(countryHTML.indexOf(":"));
	console.log(country); //: UK <-output
	// Latitude and Longitude
	var latitude;
	var longitude;
	switch(country){
		case ": Austria": 
			latitude = 47.63750751404707;
			longitude = 14.266906375523577;
		break;
		case ": UK": 
			latitude = 55.156657354406555;
			longitude = -2.8846313466481357;
		break;
		case ": Belgium": 
			latitude = 50.99964415165053;
			longitude = 4.399757448437163;
		break;
		case ": Bulgaria": 
			latitude = 42.54979326273636;
			longitude = 25.255612324368737;
		break;
		case ": Croatia": 
			latitude = 45.103313828192995;
			longitude = 14.767604097459484;
		break;
		case ": Cyprus": 
			latitude = 35.06475442394295;
			longitude = 33.177395643202075;
		break;
		case ": Czechia": 
			latitude = 49.72522932180427;
			longitude = 15.077838062868535;
		break;
		case ": Denmark": 
			latitude = 55.63723799664567;
			longitude = 10.179055163740491;
		break;
		case ": Finland": 
			latitude = 62.10171554337997;
			longitude = 26.75596347152183;
		break;
		case ": France":  
			latitude = 46.706531826959484;
			longitude = 2.0897386069647554;
		break;
		case ": Germany":  
			latitude = 51.18599372317018;
			longitude = 10.054585938347316;
		break;
		case ": Greece":  
			latitude = 39.58335555411641; 
			longitude = 23.000291805774033;
		break;
		case ": Ireland":  
			latitude = 53.19806295116543; 
			longitude = -7.977381419825066;
		break;
		case ": Italy":  
			latitude = 43.124728372518554;
			longitude = 12.550626173299024;
		break;
		case ": Netherlands":  
			latitude = 52.23202092108147;
			longitude = 5.662483504816084;
		break;
		case ": Poland":  
			latitude = 52.86081173655181;
			longitude = 18.51541594298611;
		break;
		case ": Romania":  
			latitude = 45.792282641860936;
			longitude = 24.882232865821127;
		break;
		case ": Spain":  
			latitude = 39.6212849462599;
			longitude = -3.389598055634167;
		break;
		case ": Sweden":  
			latitude = 63.06353929017582;
			longitude = 16.700157216062987;
		break;
	}
	var mapProp = {
	    center:new google.maps.LatLng(latitude, longitude),
	    zoom:6,
	};
	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}