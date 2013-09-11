<?php  
require("phpsqlajax_dbinfo.php"); 

// Start XML file, create parent node

$dom = new DOMDocument("1.0" , "UTF-8");
$node = $dom->createElement("markers");
$parnode = $dom->appendChild($node); 

// Opens a connection to a MySQL server

$connection=mysql_connect (userdb, $username, $password);
mysql_query("SET NAMES 'utf8'", $connection);
if (!$connection) {  die('Not connected : ' . mysql_error());} 

// Set the active MySQL database

$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
} 

// Select all the rows in the markers table

$query = "SELECT * FROM `map` WHERE `map`.`enable`='1' ORDER BY `map`.`name`";
$result = mysql_query($query);
if (!$result) {  
  die('Invalid query: ' . mysql_error());
} 

header("Content-type: text/xml"); 

// Iterate through the rows, adding XML nodes for each
while ($row = @mysql_fetch_assoc($result)){  
  // ADD TO XML DOCUMENT NODE  
  $node = $dom->createElement("marker");  
  $newnode = $parnode->appendChild($node);   
  $newnode->setAttribute("name",$row['name']);
  $newnode->setAttribute("address", $row['addr']);  
  $newnode->setAttribute("tel", $row['thl']);  
  $newnode->setAttribute("lat", $row['lat']);  
  $newnode->setAttribute("lng", $row['lng']);
  $newnode->setAttribute("nomos", $row['nomos']);
  $newnode->setAttribute("dimos", $row['dimos']);
  $newnode->setAttribute("type", $row['type']);
 } 
echo $dom->saveXML();
?>