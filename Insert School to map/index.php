<?php
// get the new map center if user requested it.
$latlon="39.623204773140934, 22.36197337768556";
if (isset($_COOKIE['center'])){
$latlon=$_COOKIE['center'];
}
// get the new map zoom if user requested it.
$startzoom=9;
if (isset($_COOKIE['zoom'])){
$startzoom=$_COOKIE['zoom'];
}
?>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta name="author" content="Christos Prassas - ΠΔΕ Θεσσαλίας - 2012"/> 
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
var geocoder = new google.maps.Geocoder();
  
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Δεν μπορεί να βρεθεί διευθυνση σε αυτό το σημείο.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}

function updateMarkerPosition(latLng) {
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');
  
  latDir = "N";
  lngDir = "E";
  if(latLng.lat() < 0){
  latDir = "S";
  }
  if(latLng.lng() < 0){
  lngDir = "W";
  }
  qlat = Math.abs(latLng.lat());
  ilat = Math.floor(qlat);
  xlat = ((qlat - ilat)*60);
  
  qlng = Math.abs(latLng.lng());
  ilng = Math.floor(qlng);
  xlng = ((qlng - ilng)*60);
  
  xlat = Math.round(xlat*1000)/1000;
  xlng = Math.round(xlng*1000)/1000; 

d2 = xlat.toFixed(3);
e2 = xlng.toFixed(3);   
d1 = ilat.toString();
d2 = d2.toString();
e1 = ilng.toString();
e2 = e2.toString();
  
  n = Math.abs(latLng.lat()); // Change to positive var decimal = n - Math.floor(n)
  var decimal = n - Math.floor(n); 
  document.getElementById('geot').innerHTML = [
    latDir + ' ' + d1 + ' ' + d2,
    lngDir + ' ' + e1 + ' ' + e2
  ].join(', ');
  
  document.form1.lat.value = [
    latLng.lat()];
  document.form1.lon.value = [
    latLng.lng()];
  document.form1.wlat.value = [
    latDir + ' ' + d1 + ' ' + d2];
  document.form1.wlon.value = [
    lngDir + ' ' + e1 + ' ' + e2];
}

function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}

function centerPosition(newgeo,newzoom) {
// document.getElementById('mcenter').innerHTML = [newgeo];
// document.getElementById('mzoom').innerHTML = [newzoom];
document.form2.mcenter2.value = [newgeo];
document.form2.mzoom2.value = [newzoom];
document.form1.zm2.value = [newzoom];
}

function initialize() {
  var latLng = new google.maps.LatLng(39.623204773140934, 22.36197337768556);     //(<?$latlon?>); 
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 9, //<?=$startzoom?>,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });
  
  // Update current position info.
  updateMarkerPosition(latLng);
  geocodePosition(latLng);
  
  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Μετακίνηση...');
  });
  
  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Μετακίνηση...');
    updateMarkerPosition(marker.getPosition());
  });
  
  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Τέλος Μετακίνησης');
    geocodePosition(marker.getPosition());
  });
  
  google.maps.event.addListener(map, 'bounds_changed', function(){
    var newgeo = map.get('center');
     var newzoom = map.get('zoom');
    centerPosition(newgeo,newzoom);
  });
       
}

// Onload handler to fire off the app.
google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
  <style>
  body{
  font-family: verdana;
  font-size: 10px;
  width:650px;
  }
  #container{
  width:650px;
  }
  #mapCanvas {
    width: 780px;
    height: 400px;
    float: left;
  }
  #infoPanel {
  width: 750px;
    float: left;
    margin-left: 10px;
  }
  #infoPanel div {
    margin-bottom: 5px;
  }
   </style>
<body>
 <div id="container">
  <div id="mapCanvas"></div>
  <div id="infoPanel">
    <b>Κατάσταση Δείκτη:</b>
    <div id="markerStatus"><i>Κάντε κλικ και σύρτε τον δείκτη.</i></div>
    <b>Τρέχουσα θέση (Μοίρες): </b><div id="info"></div>
    <b>Τρέχουσα θέση κατά WGS-84: </b><div id="geot"></div>
    <b>Διεύθυνση (κατά προσέγγιση): </b><div id="address"></div>
    <form id="form1" name="form1" action="add.php" method="post">
    <input type="hidden" name="zm" id="zm2" value="zm2">
    <b>Γεωγραφικό Πλάτος: </b> <input type="text" id="lat" name="lat" READONLY size="18"> <b>Γεωγραφικό Μήκος:</b> <input type="text" id="lon" name="lon" READONLY size="18"> <br />
	<input type="hidden" id="wlat" name="wlat" size="18">
    <input type="hidden" id="wlon" name="wlon" size="18"><br />
    <b><u><font color="red">*Κωδικός Σχολείου ΥΠΔΜΘ:</font></u></b> <input type="text" id="school_id" name="school_id" size="10" color="#999"> <br /> </br>
	<input type="submit" name="submit" value="Αποστολή Στοιχείων"><br />
    </form>
	<form id="form2" name="form2" method="post" action="center.php">
    <input type="hidden" name="newcenter" id="mcenter2" value="mcenter2">
    <input type="hidden" name="newzoom" id="mzoom2" value="mzoom2">
    <input type="submit" name="submit" value="Θέστε τον δείκτη στο κέντρο του χάρτη">
    </form>
	<div style="width:700px; font-color:#999; text-align:justify;"><u><font color="red">Χρησιμοποιήστε Mozilla Firefox!!!</font></u> Πρέπει να εισάγετε υποχρεωτικά τον 7ψηφιο κωδικό του σχολείου (ΥΠΔΒΜΘ) για να γίνει καταχώριση. Παρακαλούμε χρησιμοποιήστε την μεγαλύτερη δυνατή ανάλυση (ζουμ) στο χάρτη και τοποθετήστε τον κόκκινο δείκτη στο σημείο που βρίσκεται το σχολείο. Για να μετακινήσετε τον δείκτη κάντε αριστερο κλικ πάνω του και τον σέρνετε στο σημείο που θέλετε. Αν κάνετε λάθος κατά την αποστολή των στοιχείων του σχολείου παρακαλούμε επαναλάβετε την διαδικασία. Θα διατηρηθεί η τελευταία εγγραφή.</div>
		<div style="width:700px; font-color:#999; text-align:justify;">Αν κάνοντας ζουμ στον χάρτη χάσατε τον δείκτη μπορείτε να κάνετε κλικ στο κουμπί "Θέστε τον δείκτη στο κέντρο του χάρτη" και θα σας εμφανίσει τον δείκτη στο κέντρο του χάρτη. Σε περίπτωση οποιουδήποτε προβλήματος παρακαλούμε επικοινωνήστε μαζί μας στο webmaster@thess.pde.sch.gr (κ. Χρήστος Πρασσάς)</div>
		<div style="width:700px; font-color:#999; text-align:justify;"><u><font color="red">Για να ελέγξετε το σημείο που περάσατε μεταβείτε <a target="_blank" href=http://thess.pde.sch.gr/jm/index.php/2010-06-24-06-33-47/sxoleia>ΕΔΩ</a></font></u></div>
    </div>
    <br /><br /> </br>
	
</div>
</body>
</html>
