<?php
include("db.php");
session_start();

  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }

   if(isset($_GET['user_query']))
  { $pr=$_GET['user_query'];
header("location:allrecipe.php?user_query=$pr");
  }
?>
<!DOCTYPE HTML>

<HTML>
<head>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>Food Recipe</title>

<!-- new code -->
	 <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
 <meta charset="utf-8">
 <style>
 /* Always set the map height explicitly to define the size of the div
 * element that contains the map. */
 #map {
 height: 100%;
 }
 /* Optional: Makes the sample page fill the window. */
 html, body {
 height: 100%;
 margin: 0;
 padding: 0;
 }
 body {
 padding: 0 !important;
 }
 table {
 font-size: 12px;
 }
 .hotel-search {
 -webkit-box-align: center;
 -ms-flex-align: center;
 align-items: center;
 background: #fff;
 display: -webkit-box;
 display: -ms-flexbox;
 display: flex;
 left: 0;
 position: absolute;
 top: 0;
 width: 440px;
 z-index: 1;
 }
 #map {
 margin-top: 40px;
 width: 75%;
 }
 #listing {
 position: absolute;
 width: 200px;
 height: 470px;
 overflow: auto;
 left: 76%;
 top: 0px;
 cursor: pointer;
 overflow-x: hidden;
 }
 #findhotels {
 font-size: 14px;
 }
 #locationField {
 -webkit-box-flex: 1 1 190px;
 -ms-flex: 1 1 190px;
 flex: 1 1 190px;
 margin: 0 8px;
 }
 #controls {
 -webkit-box-flex: 1 1 140px;
 -ms-flex: 1 1 140px;
 flex: 1 1 140px;
 }
 #autocomplete {
 width: 100%;
 }
 #country {
 width: 100%;
 }
 .placeIcon {
 width: 20px;
 height: 34px;
 margin: 4px;
 }
 .hotelIcon {
 width: 24px;
 height: 24px;
 }
 #resultsTable {
 border-collapse: collapse;
 width: 240px;
 }
 #rating {
 font-size: 13px;
 font-family: Arial Unicode MS;
 }
 .iw_table_row {
 height: 18px;
 }
 .iw_attribute_name {
 font-weight: bold;
 text-align: right;
 }
 .iw_table_icon {
 text-align: right;
 }
 </style>
 <!-- new code -->


    
</head>
<BODY style='background:purple'>

<div id="navbar" class="navbar navbar-default"style='margin-bottom:100px'>
	<div class="container">
		<div class="navbar-collapse collapse" id="navigation">
			<div class="padd-nav">
				<ul class="nav navbar-nav left">
					<li ><a href="index.php" >Home</a></li>
					<li><a href="favourite.php" >Go To Favourites <i class="fa fa-star"></i></a></li>
					<li><a href="allrecipe.php" >All Recipes<i class="fa fa-book"></i></a></li>
          <li><a href="restaurant.php" class="act">Restaurants <i class="fa fa-cutlery"></i></a></li>
					

 	                
			<li> <form method="get" action="#" class="navbar-form">
					<div class="input-group">
						<input type="text" class="form-control" name="user_query" id="user_query" placeholder="search" required=" "/>
						<span class="input-group-btn">
						<button type="submit" name="search" id="search" value="Search" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
                     </form>
					</li>
				
		<?php  
					if (!isset($_SESSION['email'])) 
					{
		echo "<li class='shift' style='margin-left: 100px;margin-right:0px'><a href='sign-up.php'>Register</a></li>
    		     <li><a href='Login.php'>Login</a></li>
    		";
    	}
    	else
    	{
    		$user=$_SESSION['email'];
    		echo "
		<li style='margin-left: 100px;'><a href='profile.php'>Welcome <h4 style='color:yellow; display:inline'>$user</h4></a></li>
    	 <li><a href='index.php?logout=1'>Logout</a></li> ";
    	}
     ?>
					
					</ul>
				
			</div>
			
</div>
</div>
</div>



<!-- new code -->
<div class="hotel-search" style='margin-top:60px;margin-left:10px;width:75%;background:purple'>
 <div id="findhotels" style='color:white;margin-left:30px;font-size:30px'>
 <i>Find nearby restaurants:</i>
 </div>

 <div id="locationField" style='margin-top:15px;margin-right:40px'>
 <input id="autocomplete" placeholder="Enter a location" type="text" />
 </div>

 <div id="controls" >
 <select id="country" style='width:40%;background:yellow;border-radius:5px;height:30px' >
 <option value="all" >All</option>
 <option value="au">Australia</option>
 <option value="br">Brazil</option>
 <option value="ca">Canada</option>
 <option value="fr">France</option>
 <option value="de">Germany</option>
 <option value="mx">Mexico</option>
 <option value="nz">New Zealand</option>
 <option value="it">Italy</option>
 <option value="za">South Africa</option>
 <option value="es">Spain</option>
 <option value="pt">Portugal</option>
 <option value="us" selected >U.S.A.</option>
 <option value="uk">United Kingdom</option>
 </select>
 </div>
 </div>

 <div id="map" style='margin-left:20px'></div>

 <div id="listing" style='margin-top:100px;margin-left:20px'>
 <table id="resultsTable">
 <tbody id="results"></tbody>
 </table>
 </div>

 <div style="display: none">
 <div id="info-content">
 <table>
 <tr id="iw-url-row" class="iw_table_row">
 <td id="iw-icon" class="iw_table_icon"></td>
 <td id="iw-url"></td>
 </tr>
 <tr id="iw-address-row" class="iw_table_row">
 <td class="iw_attribute_name">Address:</td>
 <td id="iw-address"></td>
 </tr>
 <tr id="iw-phone-row" class="iw_table_row">
 <td class="iw_attribute_name">Telephone:</td>
 <td id="iw-phone"></td>
 </tr>
 <tr id="iw-rating-row" class="iw_table_row">
 <td class="iw_attribute_name">Rating:</td>
 <td id="iw-rating"></td>
 </tr>
 <tr id="iw-website-row" class="iw_table_row">
 <td class="iw_attribute_name">Website:</td>
 <td id="iw-website"></td>
 </tr>
 </table>
 </div>
 </div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script>
 var map, places, infoWindow;
 var markers = [];
 var autocomplete;
 var countryRestrict = {'country': 'us'};
 var MARKER_PATH = 'https://developers.google.com/maps/documentation/javascript/images/marker_green';
 var hostnameRegexp = new RegExp('^https?://.+?/');
 var countries = {
 'au': {
 center: {lat: -25.3, lng: 133.8},
 zoom: 4
 },
 'br': {
 center: {lat: -14.2, lng: -51.9},
 zoom: 3
 },
 'ca': {
 center: {lat: 62, lng: -110.0},
 zoom: 3
 },
 'fr': {
 center: {lat: 46.2, lng: 2.2},
 zoom: 5
 },
 'de': {
 center: {lat: 51.2, lng: 10.4},
 zoom: 5
 },
 'mx': {
 center: {lat: 23.6, lng: -102.5},
 zoom: 4
 },
 'nz': {
 center: {lat: -40.9, lng: 174.9},
 zoom: 5
 },
 'it': {
 center: {lat: 41.9, lng: 12.6},
 zoom: 5
 },
 'za': {
 center: {lat: -30.6, lng: 22.9},
 zoom: 5
 },
 'es': {
 center: {lat: 40.5, lng: -3.7},
 zoom: 5
 },
 'pt': {
 center: {lat: 39.4, lng: -8.2},
 zoom: 6
 },
 'us': {
 center: {lat: 37.1, lng: -95.7},
 zoom: 3
 },
 'uk': {
 center: {lat: 54.8, lng: -4.6},
 zoom: 5
 }
 };
 var lt,lg,gpos;
 function initMap() {
 map = new google.maps.Map(document.getElementById('map'), {
 zoom: countries['us'].zoom,
 center: countries['us'].center,
 mapTypeControl: false,
 panControl: false,
 zoomControl: false,
 streetViewControl: false
 });
 infoWindow = new google.maps.InfoWindow({
 content: document.getElementById('info-content')
 });
 // Try HTML5 geolocation.
 if (navigator.geolocation) {
 navigator.geolocation.getCurrentPosition(function(position) {
 var pos = {
 lat: position.coords.latitude,
 lng: position.coords.longitude
 };
 console.log(pos);
 lt=pos.lat;
 lg=pos.lng;
 gpos=pos;
 infoWindow.setPosition(pos);
 infoWindow.setContent('I am here.');
 infoWindow.open(map);
 map.setCenter(pos);
 }, function() {
 handleLocationError(true, infoWindow, map.getCenter());
 });
 } 
 else {
 // Browser doesn't support Geolocation
 handleLocationError(false, infoWindow, map.getCenter());
 }
 // Create the autocomplete object and associate it with the UI input control.
 // Restrict the search to the default country, and to place type "cities".
 autocomplete = new google.maps.places.Autocomplete(
 /** @type {!HTMLInputElement} */ (
 document.getElementById('autocomplete')), {
 types: ['(regions)'],
 componentRestrictions: countryRestrict
 });
 places = new google.maps.places.PlacesService(map);
 autocomplete.addListener('place_changed', onPlaceChanged);
 // Add a DOM event listener to react when the user selects a country.
 document.getElementById('country').addEventListener(
 'change', setAutocompleteCountry);
 }
 function handleLocationError(browserHasGeolocation, infoWindow, pos) {
 infoWindow.setPosition(pos);
 infoWindow.setContent(browserHasGeolocation ?
 'Error: The Geolocation service failed.' :
 'Error: Your browser doesn\'t support geolocation.');
 infoWindow.open(map);
 }
 var nearbydata=[];
 // When the user selects a city, get the place details for the city and
 // zoom the map in on the city.
 function onPlaceChanged() {
 var place = autocomplete.getPlace();
 // console.log(place);
 console.log("hi");
 console.log(lt+" "+lg);
 let url = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='+lt+','+lg+'&radius=1500&type=restaurant&key=AIzaSyCBKN2tQUEvEKuiOj_NSwZSHeFgDHHLXxs'
 const proxyurl = "https://cors-anywhere.herokuapp.com/";
 fetch(proxyurl + url)
 .then(res => res.json())
 .then(out => {
 for (var i = 0; i < out.results.length; i++) {
 nearbydata[i] = out.results[i];
 }
 console.log(nearbydata); 
 // console.log('Checkout this JSON! ', out.results[0].name);
 })
 .catch(err => { throw err });
 console.log(nearbydata); // this line will "wait" for the previous to be completed
 // console.log(response.json()); 
 // for (var i = 0; i < out.results.length; i++) {
 // console.log(out.results[i].name); 
 // }
 // data around specific lat and long
 // https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=-33.8670522,151.1957362&radius=1500&type=restaurant&key=AIzaSyCBKN2tQUEvEKuiOj_NSwZSHeFgDHHLXxs
 if (place.geometry) {
 map.panTo(gpos);
 map.setZoom(15);
 search();
 } else {
 document.getElementById('autocomplete').placeholder = 'Enter a city';
 }
 }
 // Search for hotels in the selected city, within the viewport of the map.
 function search() {
 var search = {
 bounds: map.getBounds(),
 types: ['restaurant']
 };
 places.nearbySearch(search, function(results, status) {
 if (status === google.maps.places.PlacesServiceStatus.OK) {
 clearResults();
 clearMarkers();
 // Create a marker for each hotel found, and
 // assign a letter of the alphabetic to each marker icon.
 for (var i = 0; i < results.length; i++) {
 var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
 var markerIcon = MARKER_PATH + markerLetter + '.png';
 // Use marker animation to drop the icons incrementally on the map.
 markers[i] = new google.maps.Marker({
 position: results[i].geometry.location,
 animation: google.maps.Animation.DROP,
 });
 // If the user clicks a hotel marker, show the details of that hotel
 // in an info window.
 markers[i].placeResult = results[i];
 google.maps.event.addListener(markers[i], 'click', showInfoWindow);
 setTimeout(dropMarker(i), i * 100);
 addResult(results[i], i);
 }
 }
 });
 }
 function clearMarkers() {
 for (var i = 0; i < markers.length; i++) {
 if (markers[i]) {
 markers[i].setMap(null);
 }
 }
 markers = [];
 }
 // Set the country restriction based on user input.
 // Also center and zoom the map on the given country.
 function setAutocompleteCountry() {
 var country = document.getElementById('country').value;
 if (country == 'all') {
 autocomplete.setComponentRestrictions({'country': []});
 map.setCenter({lat: 15, lng: 0});
 map.setZoom(2);
 } else {
 autocomplete.setComponentRestrictions({'country': country});
 map.setCenter(countries[country].center);
 map.setZoom(countries[country].zoom);
 }
 clearResults();
 clearMarkers();
 }
 function dropMarker(i) {
 return function() {
 markers[i].setMap(map);
 };
 }
 function addResult(result, i) {
 var results = document.getElementById('results');
 var markerLetter = String.fromCharCode('A'.charCodeAt(0) + (i % 26));
 var markerIcon = MARKER_PATH + markerLetter + '.png';
 var tr = document.createElement('tr');
 tr.style.backgroundColor = (i % 2 === 0 ? '#F0F0F0' : '#FFFFFF');
 tr.onclick = function() {
 google.maps.event.trigger(markers[i], 'click');
 };
 var iconTd = document.createElement('td');
 var nameTd = document.createElement('td');
 var icon = document.createElement('img');
 icon.src = markerIcon;
 icon.setAttribute('class', 'placeIcon');
 icon.setAttribute('className', 'placeIcon');
 var name = document.createTextNode(result.name);
 iconTd.appendChild(icon);
 nameTd.appendChild(name);
 tr.appendChild(iconTd);
 tr.appendChild(nameTd);
 results.appendChild(tr);
 }
 function clearResults() {
 var results = document.getElementById('results');
 while (results.childNodes[0]) {
 results.removeChild(results.childNodes[0]);
 }
 }
 // Get the place details for a hotel. Show the information in an info window,
 // anchored on the marker for the hotel that the user selected.
 function showInfoWindow() {
 var marker = this;
 places.getDetails({placeId: marker.placeResult.place_id},
 function(place, status) {
 if (status !== google.maps.places.PlacesServiceStatus.OK) {
 return;
 }
 infoWindow.open(map, marker);
 buildIWContent(place);
 });
 }
 // Load the place information into the HTML elements used by the info window.
 function buildIWContent(place) {
 document.getElementById('iw-icon').innerHTML = '<img class="hotelIcon" ' +
 'src="' + place.icon + '"/>';
 document.getElementById('iw-url').innerHTML = '<b><a href="' + place.url +
 '">' + place.name + '</a></b>';
 document.getElementById('iw-address').textContent = place.vicinity;
 if (place.formatted_phone_number) {
 document.getElementById('iw-phone-row').style.display = '';
 document.getElementById('iw-phone').textContent =
 place.formatted_phone_number;
 } else {
 document.getElementById('iw-phone-row').style.display = 'none';
 }
 // Assign a five-star rating to the hotel, using a black star ('&#10029;')
 // to indicate the rating the hotel has earned, and a white star ('&#10025;')
 // for the rating points not achieved.
 if (place.rating) {
 var ratingHtml = '';
 for (var i = 0; i < 5; i++) {
 if (place.rating < (i + 0.5)) {
 ratingHtml += '&#10025;';
 } else {
 ratingHtml += '&#10029;';
 }
 document.getElementById('iw-rating-row').style.display = '';
 document.getElementById('iw-rating').innerHTML = ratingHtml;
 }
 } else {
 document.getElementById('iw-rating-row').style.display = 'none';
 }
 // The regexp isolates the first part of the URL (domain plus subdomain)
 // to give a short URL for displaying in the info window.
 if (place.website) {
 var fullUrl = place.website;
 var website = hostnameRegexp.exec(place.website);
 if (website === null) {
 website = 'http://' + place.website + '/';
 fullUrl = website;
 }
 document.getElementById('iw-website-row').style.display = '';
 document.getElementById('iw-website').textContent = website;
 } else {
 document.getElementById('iw-website-row').style.display = 'none';
 }
 }
 </script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBKN2tQUEvEKuiOj_NSwZSHeFgDHHLXxs&libraries=places&callback=initMap"
 async defer></script>
 </body>
</html>