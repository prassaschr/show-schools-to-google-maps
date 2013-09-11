<?php

$db_server["host"] = ""; //URL of database server
$db_server["username"] = ""; // DB username
$db_server["password"] = ""; // DB password

$con = mysql_connect($db_server["host"], $db_server["username"], $db_server["password"]);
if (!$con)
   die('Not connected : ' . mysql_error());

$db_selected = mysql_select_db("schoolschart");
if (!$db_selected)
   die ('Can\'t use map : ' . mysql_error());

?>
