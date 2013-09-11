<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>  
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" /> 
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta name="author" content="Christos Prassas - ΠΔΕ Θεσσαλίας - 2012"/> 
    <title>Χαρτογραφική Απεικόνιση των σχολείων της Περιφέρειας Θεσσαλίας</title> 
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<style type="text/css">
html, body { height: 100%; } 
</style>
    <script type="text/javascript">
    //<![CDATA[
      // this variable will collect the html which will eventually be placed in the side_bar 
      var side_bar_html = ""; 
      var m_type = "";
      var m_nomos = "";
      var gmarkers = [];
      var gicons = [];
      var map = null;
      var checkNomos = false; //N
      var checkType = false;   //N
	  var checkDimos = false; //N
	  var infowindow = new google.maps.InfoWindow(
 { 
    size: new google.maps.Size(150,50)
  });


gicons["red"] = new google.maps.MarkerImage("mapIcons/marker_red.png",
      // This marker is 20 pixels wide by 34 pixels tall.
      new google.maps.Size(20, 34),
      // The origin for this image is 0,0.
      new google.maps.Point(0,0),
      // The anchor for this image is at 9,34.
      new google.maps.Point(9, 34));
  // Marker sizes are expressed as a Size of X,Y
  // where the origin of the image (0,0) is located
  // in the top left of the image.
 
  // Origins, anchor positions and coordinates of the marker
  // increase in the X direction to the right and in
  // the Y direction down.

  var iconImage = new google.maps.MarkerImage('mapIcons/marker_red.png',
      // This marker is 20 pixels wide by 34 pixels tall.
      new google.maps.Size(20, 34),
      // The origin for this image is 0,0.
      new google.maps.Point(0,0),
      // The anchor for this image is at 9,34.
      new google.maps.Point(9, 34));
  var iconShadow = new google.maps.MarkerImage('http://www.google.com/mapfiles/shadow50.png',
      // The shadow image is larger in the horizontal dimension
      // while the position and offset are the same as for the main image.
      new google.maps.Size(37, 34),
      new google.maps.Point(0,0),
      new google.maps.Point(9, 34));
      // Shapes define the clickable region of the icon.
      // The type defines an HTML &lt;area&gt; element 'poly' which
      // traces out a polygon as a series of X,Y points. The final
      // coordinate closes the poly by connecting to the first
      // coordinate.
  

function getMarkerImage(iconColor) {
   if ((typeof(iconColor)=="undefined") || (iconColor==null)) { 
      iconColor = "red"; 
   }
   if (!gicons[iconColor]) {
      gicons[iconColor] = new google.maps.MarkerImage("mapIcons/marker_"+ iconColor +".png",
      // This marker is 20 pixels wide by 34 pixels tall.
      new google.maps.Size(20, 34),
      // The origin for this image is 0,0.
      new google.maps.Point(0,0),
      // The anchor for this image is at 6,20.
      new google.maps.Point(9, 34));
   } 
   return gicons[iconColor];

}

function type2color(type) {
   var color = "red";
   switch(type) {
     case "ΝΗΠΙΑΓΩΓΕΙΟ": color = "blue";
                break;
     case "ΔΗΜΟΤΙΚΟ":    color = "green";
                break;
     case "ΓΥΜΝΑΣΙΟ":    color = "yellow";
                break;
	 case "ΛΥΚΕΙΟ":    color = "orange";
                break;
	 case "ΕΠΑΛ":    color = "cyan";
                break;
	 case "ΕΠΑΣ":    color = "white";
                break;
	 case "ΕΕΕΕΚ":    color = "black";
                break;
	 case "ΕΙΔ ΤΕΕ":    color = "purple";
                break;
	 case "ΣΕΚ":    color = "tirk";
                break;
     default:   color = "red";
                break;
   }
   return color;
}
//Εδώ εισάγουμε τους τύπους των σχολείων σύμφωνα με τις απαιτήσεις μας
      gicons["ΝΗΠΙΑΓΩΓΕΙΟ"] = getMarkerImage(type2color("ΝΗΠΙΑΓΩΓΕΙΟ"));
      gicons["ΔΗΜΟΤΙΚΟ"] = getMarkerImage(type2color("ΔΗΜΟΤΙΚΟ"));
      gicons["ΓΥΜΝΑΣΙΟ"] = getMarkerImage(type2color("ΓΥΜΝΑΣΙΟ"));
	  gicons["ΛΥΚΕΙΟ"] = getMarkerImage(type2color("ΛΥΚΕΙΟ"));
	  gicons["ΕΠΑΛ"] = getMarkerImage(type2color("ΕΠΑΛ"));
	  gicons["ΕΠΑΣ"] = getMarkerImage(type2color("ΕΠΑΣ"));
	  gicons["ΕΕΕΕΚ"] = getMarkerImage(type2color("ΕΕΕΕΚ"));
	  gicons["ΕΙΔ ΤΕΕ"] = getMarkerImage(type2color("ΕΙΔ ΤΕΕ"));
	  gicons["ΣΕΚ"] = getMarkerImage(type2color("ΣΕΚ"));

      // A function to create the marker and set up the event window
function createMarker(latlng,name,html,type,nomos,dimos) {
    var contentString = html;
    var marker = new google.maps.Marker({
        position: latlng,
        icon: gicons[type],
        shadow: iconShadow,
        map: map,
        title: name,
        zIndex: Math.round(latlng.lat()*-100000)<<5
        });
        // === Store the type and name info as a marker properties ===
        marker.mydimos = dimos;
		marker.mynomos = nomos;                                 
		marker.mytype = type;                                 
        marker.myname = name;
		marker.n = false; //N
		marker.t = false;     //N
		marker.d = false;   //N
		gmarkers.push(marker); // send the marker to gmarkers table
		initGmarkersNT(); //N
		
        
        
			
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent(contentString); 
        infowindow.open(map,marker);
        });
}
            
			//N
		function initGmarkersNT() {
			for (var i=0; i<gmarkers.length; i++) {
				gmarkers[i].n = false;
				gmarkers[i].t = false;
				gmarkers[i].d = false;
			}
		}
		
/////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////

      // == hides all markers of a particular school type, and ensures the checkbox is cleared ==
		function hide() {
			for (var i=0; i<gmarkers.length; i++) {
          		gmarkers[i].setVisible(false);
			}     
					
			// == close the info window, in case its open on a marker that we just hid
			infowindow.close();
		}
	  

//////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////
 

		function nomosClicked(nomos,onOff)	{
	        
		
				if ((document.getElementById("LARISSAbox").checked == true)  || (document.getElementById("MAGNHSIAbox").checked == true) ||
				   (document.getElementById("KARDITSAbox").checked == true)  || (document.getElementById("TRIKALAbox").checked == true)) 
				{
				   checkNomos = true;
				  
				} else {
					checkNomos = false;
				}	
				   	
				if (onOff == true) // Tsekare ola ta sxoleia toy nomos
				{
					for (var i=0; i<gmarkers.length; i++) 
					{
						if (gmarkers[i].mynomos == nomos) {
							gmarkers[i].n = true;
						}
					}
				} else {					//To onOff einai false			- xetsekare TA SXOLEIA TOU NOMOU						
					for (var i=0; i<gmarkers.length; i++) 
					{
						if (gmarkers[i].mynomos == nomos) {
							gmarkers[i].n = false;
						}
					}
				}	
				
				chooseShow();
		}		
		
		
		
		function typosClicked(typos,onOff)	{
			
				if ((document.getElementById("NIPIAbox").checked == true)    || (document.getElementById("DIMOTIKObox").checked == true) ||
				    (document.getElementById("GIMNASIObox").checked == true) || (document.getElementById("LIKIObox").checked == true)	  ||
				    (document.getElementById("EPALbox").checked == true)     || (document.getElementById("EPASbox").checked == true)     ||
				    (document.getElementById("EEEEKbox").checked == true)    || (document.getElementById("EIDTEEbox").checked == true)   ||
				    (document.getElementById("SEKbox").checked == true)) 
				{
				   checkType = true; 
				} else {
					checkType = false;
				}	
				   	
				if (onOff == true) // Tsekare ola ta sxoleia toy typou
				{
					for (var i=0; i<gmarkers.length; i++) 
					{
						if (gmarkers[i].mytype == typos) {
							gmarkers[i].t = true;
						}
					}
				} else {					//To onOff einai false			- xetsekare TA SXOLEIA TOU TYPOU						
					for (var i=0; i<gmarkers.length; i++) 
					{
						if (gmarkers[i].mytype == typos) {
							gmarkers[i].t = false;
						}
					}
				}	
				chooseShow();
		}	
		
		function dimosClicked(dimos,onOff)	{
			
				if ((document.getElementById("AGIAbox").checked == true)    || (document.getElementById("ELASSONAbox").checked == true) ||
				    (document.getElementById("KILELERbox").checked == true) || (document.getElementById("LARISSAIONbox").checked == true)	  ||
				    (document.getElementById("TEMPONbox").checked == true)     || (document.getElementById("TIRNABOYbox").checked == true)     ||
				    (document.getElementById("FARSALONbox").checked == true)    || (document.getElementById("ALMIROSbox").checked == true)   ||
				    (document.getElementById("ALONNISOSbox").checked == true) || (document.getElementById("BOLOSbox").checked == true)   ||
					(document.getElementById("ZAGORASbox").checked == true) || (document.getElementById("NPILIObox").checked == true)   ||
					(document.getElementById("RFERREUbox").checked == true) || (document.getElementById("SKIATHOUbox").checked == true)   ||
					(document.getElementById("SKOPELOSbox").checked == true) || (document.getElementById("ARGITHEASbox").checked == true)   ||
					(document.getElementById("KARDITSASDbox").checked == true) || (document.getElementById("LPLASTIRAbox").checked == true)   ||
					(document.getElementById("MOUZAKIbox").checked == true) || (document.getElementById("PALAMAbox").checked == true)   ||
					(document.getElementById("SOFADONbox").checked == true) || (document.getElementById("KALAMPAKASbox").checked == true)   ||
					(document.getElementById("PILISDbox").checked == true) || (document.getElementById("TRIKKAIONbox").checked == true)   ||
					(document.getElementById("FARKADONASbox").checked == true))
				{
				   checkDimos = true; 
				} else {
					checkDimos = false;
				}	
				   	
				if (onOff == true) // Tsekare ola ta sxoleia toy typou
				{
					for (var i=0; i<gmarkers.length; i++) 
					{
						if (gmarkers[i].mydimos == dimos) {
							gmarkers[i].d = true;
						}
					}
				} else {					//To onOff einai false			- xetsekare TA SXOLEIA TOU TYPOU						
					for (var i=0; i<gmarkers.length; i++) 
					{
						if (gmarkers[i].mydimos == dimos) {
							gmarkers[i].d = false;
						}
					}
				}	
				chooseShow();
		}	
		
		
		
		function showNomos() {
			for (var i=0; i<gmarkers.length; i++) {
                if (gmarkers[i].n == true) {
                         gmarkers[i].setVisible(true);
                } else {
                    gmarkers[i].setVisible(false);
                }
         }
      }
		
		function showTypos() {
					
			for (var i=0; i<gmarkers.length; i++) {
                if (gmarkers[i].t == true) {
                         gmarkers[i].setVisible(true);
                } else {
                    gmarkers[i].setVisible(false);
                }
         }
      } 
		
		function showNomosTypos() {
			
			for (var i=0; i<gmarkers.length; i++) {
                if ((gmarkers[i].n == true) && (gmarkers[i].t == true))  {
                         gmarkers[i].setVisible(true);
                } else {
                    gmarkers[i].setVisible(false);
                }
         }
      } 
      
///////////////////////////////////////////////////////////////////////////////////	  
		function showNomosDimos() {
			for (var i=0; i<gmarkers.length; i++) {
				if ((gmarkers[i].n == true) && (gmarkers[i].d == true)) {
					gmarkers[i].setVisible(true);
				} else {
					gmarkers[i].setVisible(false);
				}
			}		
		}
		
		function showNomosDimosTypos() {
			for (var i=0; i<gmarkers.length; i++) {
				if ((gmarkers[i].n == true) && (gmarkers[i].t == true) && (gmarkers[i].d == true)) {
					gmarkers[i].setVisible(true);
				} else {
					gmarkers[i].setVisible(false);
				}
			}
		}
///////////////////////////////////////////////////////////////////////////////////////
	  
		function chooseShow() {
			
			if  ((checkNomos == true) && (checkType == false)) { showNomos();}
			if  ((checkNomos == false) && (checkType == true)) { showTypos();}
			if  ((checkNomos == true) && (checkType == true)) { showNomosTypos();}
			if  ((checkNomos == false) && (checkType == false)) { showNomosTypos();}
			if	((checkNomos == true) && (checkType == false) && (checkDimos == true)) { showNomosDimos();}
			if  ((checkNomos == true) && (checkType == true) && (checkDimos == true)) { showNomosDimosTypos();}
			if  ((checkNomos == false) && (checkType == false) && (checkDimos == false)) { showNomosTypos();}
			infowindow.close();
			makeSidebar();		
		}		
		
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////	  
	  
      function myclick(i) {
        google.maps.event.trigger(gmarkers[i],"click");
      }


      // == rebuilds the sidebar to match the markers currently displayed ==
      function makeSidebar() {
        var html = "";
        for (var i=0; i<gmarkers.length; i++) {
          if (gmarkers[i].getVisible()) {
            html += '<a href="javascript:myclick(' + i + ')">' + gmarkers[i].myname + '<\/a><br>';
          }
        }
        document.getElementById("side_bar").innerHTML = html;
      }
      
      
// initialize the map and the center is the coordinates below, map type is ROADMAP 
  function initialize() {
    var myOptions = {
      zoom: 7,
      center: new google.maps.LatLng(39.623204773140934, 22.36197337768556),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map"), myOptions);
	document.getElementById('dimoiLarissas').style.visibility = 'hidden';
	document.getElementById('dimoiMagnisias').style.visibility = 'hidden';
	document.getElementById('dimoiKarditsas').style.visibility = 'hidden';
	document.getElementById('dimoiTrikalon').style.visibility = 'hidden';
	alert("Επιλέξτε τον/τους νομούς που επιθυμείτε και τους Δήμους και τους τύπους σχολείων");

    google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
		 
    });



      // Read the data from XML
      downloadUrl("phpsqlajax_genxml3.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
		for (var i = 0; i < markers.length; i++) {
          // obtain the attributes of each marker from the XML - create markers table
          var lat = parseFloat(markers[i].getAttribute("lat"));
          var lng = parseFloat(markers[i].getAttribute("lng"));
          var point = new google.maps.LatLng(lat,lng);
          var address = markers[i].getAttribute("address");
		  var tel = markers[i].getAttribute("tel");
          var name = markers[i].getAttribute("name");
          var html = "<b>"+name+"<\/b><p>Διεύθυνση: "+address+"<\/b><p>Τηλέφωνο: "+tel+"<\/b><p>Συντεταγμένες: "+lat+", "+lng;
          var nomos = markers[i].getAttribute("nomos");
		  var dimos = markers[i].getAttribute("dimos");
		  var type = markers[i].getAttribute("type");
		  
          var marker = createMarker(point,name,html,type,nomos,dimos);
		  // create the marker
        }

        // == hide the categories initially - all are hidden ==
        hide();
		
		
        // == create the initial sidebar ==
        makeSidebar();
      });
		
    }
	function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}
	
	function showDivDimoi(divid) {
		document.getElementById(divid).style.visibility = 'visible';
	}
	
	
	
	function hideDivDimoi(divid) {
		document.getElementById(divid).style.visibility = 'hidden';
	}
   
    </script>
	<style type="text/css">

body {
	margin: 0;
	padding: 0;
	text-align: left;
	color: #000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 7pt;
	background-color: #FFF;
}
#nomoi {
	text-align: center;
	margin: 0px 0px 0px 0px;
	width: 495px;
	height: 20px;
	overflow: auto;
}
#typoi {
	text-align: center;
	margin: 0px 0px 0px 0px;
	height: 20px;
}
#dimoiLarissas {
	text-align: center;
	margin: 0px 0px 0px 0px;
	height: auto;
}
#dimoiMagnisias {
	text-align: center;
	margin: 0px 0px 0px 0px;
	height: auto;
}
#dimoiKarditsas {
	text-align: center;
	margin: 0px 0px 0px 0px;
	height: auto;
}
#dimoiTrikalon {
	text-align: center;
	margin: 0px 0px 0px 0px;
	height: auto;
}
</style>

  </head>
<body onload="initialize()"> 

    <!-- you can use tables or divs for the overall layout -->
    <table border=1 id="table1">
      <tr>
        <td>
           <div id="map" style="width: 470px; height: 500px"></div>
        </td>
        <td rowspan="2" valign="top" style="width:auto; text-decoration: color: #4444ff;"> 
           <div id="side_bar" style="width: 290px; height:500px; overflow:auto" ></div>
        </td>
      </tr>
	  <tr>
		<td>
		<div id="nomoi">
			<form action="#">
				Νομός Λάρισας:   <input type="checkbox" id="LARISSAbox" onclick="javascript:if (this.checked) {nomosClicked('ΛΑΡΙΣΑΣ',true); showDivDimoi('dimoiLarissas');} else {nomosClicked('ΛΑΡΙΣΑΣ',false); hideDivDimoi('dimoiLarissas');}" /> 
				Νομός Μαγνησίας: <input type="checkbox" id="MAGNHSIAbox" onclick="javascript:if (this.checked) {nomosClicked('ΜΑΓΝΗΣΙΑΣ',true); showDivDimoi('dimoiMagnisias');} else {nomosClicked('ΜΑΓΝΗΣΙΑΣ',false); hideDivDimoi('dimoiMagnisias');}" /> 
				Νομός Καρδίτσας: <input type="checkbox" id="KARDITSAbox" onclick="javascript:if (this.checked) {nomosClicked('ΚΑΡΔΙΤΣΑΣ',true); showDivDimoi('dimoiKarditsas');} else {nomosClicked('ΚΑΡΔΙΤΣΑΣ',false); hideDivDimoi('dimoiKarditsas');}" /> 
				Νομός Τρικάλων:  <input type="checkbox" id="TRIKALAbox" onclick="javascript:if (this.checked) {nomosClicked('ΤΡΙΚΑΛΩΝ',true); showDivDimoi('dimoiTrikalon');} else {nomosClicked('ΤΡΙΚΑΛΩΝ',false); hideDivDimoi('dimoiTrikalon');}" />
			</form> 
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<div id="typoi">
			<form action="#">
				<img src="mapIcons/marker_blue_small.png"/> Νηπιαγ.: <input type="checkbox" id="NIPIAbox" onclick="javascript:if (this.checked) {typosClicked('ΝΗΠΙΑΓΩΓΕΙΟ',true);} else {typosClicked('ΝΗΠΙΑΓΩΓΕΙΟ',false);}" /> &nbsp;
				<img src="mapIcons/marker_green_small.png"/> Δημοτικά: <input type="checkbox" id="DIMOTIKObox" onclick="javascript:if (this.checked) {typosClicked('ΔΗΜΟΤΙΚΟ',true);} else {typosClicked('ΔΗΜΟΤΙΚΟ',false);}" /> &nbsp;
				<img src="mapIcons/marker_yellow_small.png"/> Γυμνάσια: <input type="checkbox" id="GIMNASIObox" onclick="javascript:if (this.checked) {typosClicked('ΓΥΜΝΑΣΙΟ',true);} else {typosClicked('ΓΥΜΝΑΣΙΟ',false);}" /> &nbsp;
				<img src="mapIcons/marker_orange_small.png"/> Λύκεια: <input type="checkbox" id="LIKIObox" onclick="javascript:if (this.checked) {typosClicked('ΛΥΚΕΙΟ',true);} else {typosClicked('ΛΥΚΕΙΟ',false);}" /> &nbsp;
				<img src="mapIcons/marker_cyan_small.png"/> ΕΠΑΛ: <input type="checkbox" id="EPALbox" onclick="javascript:if (this.checked) {typosClicked('ΕΠΑΛ',true);} else {typosClicked('ΕΠΑΛ',false);}" /> &nbsp;
				<img src="mapIcons/marker_white_small.png"/> ΕΠΑΣ: <input type="checkbox" id="EPASbox" onclick="javascript:if (this.checked) {typosClicked('ΕΠΑΣ',true);} else {typosClicked('ΕΠΑΣ',false);}" /> &nbsp;
				<img src="mapIcons/marker_black_small.png"/> ΕΕΕΕΚ: <input type="checkbox" id="EEEEKbox" onclick="javascript:if (this.checked) {typosClicked('ΕΕΕΕΚ',true);} else {typosClicked('ΕΕΕΕΚ',false);}" /> &nbsp;
				<img src="mapIcons/marker_purple_small.png"/> ΤΕΕ Ειδ. Αγωγής: <input type="checkbox" id="EIDTEEbox" onclick="javascript:if (this.checked) {typosClicked('ΕΙΔ ΤΕΕ',true);} else {typosClicked('ΕΙΔ ΤΕΕ',false);}" /> &nbsp;
				<img src="mapIcons/marker_tirk_small.png"/> ΣΕΚ: <input type="checkbox" id="SEKbox" onclick="javascript:if (this.checked) {typosClicked('ΣΕΚ',true);} else {typosClicked('ΣΕΚ',false);}" /><br />
			</form>
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="2">
		<div id="dimoiLarissas">
			<form action="#">
				Αγιάς: <input type="checkbox" id="AGIAbox" onclick="javascript:if (this.checked) {dimosClicked('ΑΓΙΑΣ',true);} else {dimosClicked('ΑΓΙΑΣ',false);}" /> &nbsp;&nbsp;
				Ελασσόνας: <input type="checkbox" id="ELASSONAbox" onclick="javascript:if (this.checked) {dimosClicked('ΕΛΑΣΣΟΝΑΣ',true);} else {dimosClicked('ΕΛΑΣΣΟΝΑΣ',false);}" /> &nbsp;&nbsp;
				Κιλελέρ: <input type="checkbox" id="KILELERbox" onclick="javascript:if (this.checked) {dimosClicked('ΚΙΛΕΛΕΡ',true);} else {dimosClicked('ΚΙΛΕΛΕΡ',false);}" /> &nbsp;&nbsp;
				Λαρισαίων: <input type="checkbox" id="LARISSAIONbox" onclick="javascript:if (this.checked) {dimosClicked('ΛΑΡΙΣΑΙΩΝ',true);} else {dimosClicked('ΛΑΡΙΣΑΙΩΝ',false);}" /> &nbsp;&nbsp;
				Τεμπών: <input type="checkbox" id="TEMPONbox" onclick="javascript:if (this.checked) {dimosClicked('ΤΕΜΠΩΝ',true);} else {dimosClicked('ΤΕΜΠΩΝ',false);}" /> &nbsp;&nbsp;
				Τυρνάβου: <input type="checkbox" id="TIRNABOYbox" onclick="javascript:if (this.checked) {dimosClicked('ΤΥΡΝΑΒΟΥ',true);} else {dimosClicked('ΤΥΡΝΑΒΟΥ',false);}" /> &nbsp;&nbsp;
				Φαρσάλων: <input type="checkbox" id="FARSALONbox" onclick="javascript:if (this.checked) {dimosClicked('ΦΑΡΣΑΛΩΝ',true);} else {dimosClicked('ΦΑΡΣΑΛΩΝ',false);}" /><br />
			</form>
		</div>
		<div id="dimoiMagnisias">
			<form action="#">
				Αλμυρού: <input type="checkbox" id="ALMIROSbox" onclick="javascript:if (this.checked) {dimosClicked('ΑΛΜΥΡΟΥ',true);} else {dimosClicked('ΑΛΜΥΡΟΥ',false);}" /> &nbsp;&nbsp;
				Αλοννήσου: <input type="checkbox" id="ALONNISOSbox" onclick="javascript:if (this.checked) {dimosClicked('ΑΛΟΝΝΗΣΟΥ',true);} else {dimosClicked('ΑΛΟΝΝΗΣΟΥ',false);}" /> &nbsp;&nbsp;
				Βόλου: <input type="checkbox" id="BOLOSbox" onclick="javascript:if (this.checked) {dimosClicked('ΒΟΛΟΥ',true);} else {dimosClicked('ΒΟΛΟΥ',false);}" /> &nbsp;&nbsp;
				Ζαγοράς - Μουρεσίου: <input type="checkbox" id="ZAGORASbox" onclick="javascript:if (this.checked) {dimosClicked('ΖΑΓΟΡΑΣ-ΜΟΥΡΕΣΙΟΥ',true);} else {dimosClicked('ΖΑΓΟΡΑΣ-ΜΟΥΡΕΣΙΟΥ',false);}" /> &nbsp;&nbsp;
				Νοτίου Πηλίου: <input type="checkbox" id="NPILIObox" onclick="javascript:if (this.checked) {dimosClicked('ΝΟΤΙΟΥ ΠΗΛΙΟΥ',true);} else {dimosClicked('ΝΟΤΙΟΥ ΠΗΛΙΟΥ',false);}" /> &nbsp;&nbsp;
				Ρήγα Φερραίου: <input type="checkbox" id="RFERREUbox" onclick="javascript:if (this.checked) {dimosClicked('ΡΗΓΑ ΦΕΡΡΑΙΟΥ',true);} else {dimosClicked('ΡΗΓΑ ΦΕΡΡΑΙΟΥ',false);}" /> &nbsp;&nbsp;
				Σκιάθου: <input type="checkbox" id="SKIATHOUbox" onclick="javascript:if (this.checked) {dimosClicked('ΣΚΙΑΘΟΥ',true);} else {dimosClicked('ΣΚΙΑΘΟΥ',false);}" />
				Σκοπέλου: <input type="checkbox" id="SKOPELOSbox" onclick="javascript:if (this.checked) {dimosClicked('ΣΚΟΠΕΛΟΥ',true);} else {dimosClicked('ΣΚΟΠΕΛΟΥ',false);}" /><br />
			</form>	
		</div>
		<div id="dimoiKarditsas">
			<form action="#">
				Αργιθέας: <input type="checkbox" id="ARGITHEASbox" onclick="javascript:if (this.checked) {dimosClicked('ΑΡΓΙΘΕΑΣ',true);} else {dimosClicked('ΑΡΓΙΘΕΑΣ',false);}" /> &nbsp;&nbsp;
				Καρδίτσας: <input type="checkbox" id="KARDITSASDbox" onclick="javascript:if (this.checked) {dimosClicked('ΚΑΡΔΙΤΣΑΣ',true);} else {dimosClicked('ΚΑΡΔΙΤΣΑΣ',false);}" /> &nbsp;&nbsp;
				Λίμνης Πλαστήρα: <input type="checkbox" id="LPLASTIRAbox" onclick="javascript:if (this.checked) {dimosClicked('ΛΙΜΝΗΣ ΠΛΑΣΤΗΡΑ',true);} else {dimosClicked('ΛΙΜΝΗΣ ΠΛΑΣΤΗΡΑ',false);}" /> &nbsp;&nbsp;
				Μουζακίου: <input type="checkbox" id="MOUZAKIbox" onclick="javascript:if (this.checked) {dimosClicked('ΜΟΥΖΑΚΙΟΥ',true);} else {dimosClicked('ΜΟΥΖΑΚΙΟΥ',false);}" /> &nbsp;&nbsp;
				Παλαμά: <input type="checkbox" id="PALAMAbox" onclick="javascript:if (this.checked) {dimosClicked('ΠΑΛΑΜΑ',true);} else {dimosClicked('ΠΑΛΑΜΑ',false);}" /> &nbsp;&nbsp;
				Σοφάδων: <input type="checkbox" id="SOFADONbox" onclick="javascript:if (this.checked) {dimosClicked('ΣΟΦΑΔΩΝ',true);} else {dimosClicked('ΣΟΦΑΔΩΝ',false);}" /><br />
			</form>	
		</div>
		<div id="dimoiTrikalon">
			<form action="#">
				Καλαμπάκας: <input type="checkbox" id="KALAMPAKASbox" onclick="javascript:if (this.checked) {dimosClicked('ΚΑΛΑΜΠΑΚΑΣ',true);} else {dimosClicked('ΚΑΛΑΜΠΑΚΑΣ',false);}" /> &nbsp;&nbsp;
				Πύλης: <input type="checkbox" id="PILISDbox" onclick="javascript:if (this.checked) {dimosClicked('ΠΥΛΗΣ',true);} else {dimosClicked('ΠΥΛΗΣ',false);}" /> &nbsp;&nbsp;
				Τρικκαίων: <input type="checkbox" id="TRIKKAIONbox" onclick="javascript:if (this.checked) {dimosClicked('ΤΡΙΚΚΑΙΩΝ',true);} else {dimosClicked('ΤΡΙΚΚΑΙΩΝ',false);}" /> &nbsp;&nbsp;
				Φαρκαδόνας: <input type="checkbox" id="FARKADONASbox" onclick="javascript:if (this.checked) {dimosClicked('ΦΑΡΚΑΔΟΝΑΣ',true);} else {dimosClicked('ΦΑΡΚΑΔΟΝΑΣ',false);}" /><br />
			</form>	
		</div>
		</td>
	</tr>
	</table>
    
    <noscript>
		<b>Πρέπει να έχετε ενεργοποιημένη την JavaScript για να χρησιμοποιήσετε το Google Maps.</b> 
    </noscript>

  </body>

</html>



