<?php
$center=$_POST['newcenter'];
$zoom=$_POST['newzoom'];
$center=str_replace("(","",$center);
$center=str_replace(")","",$center);
setcookie("center", $center, time()+604800);
setcookie("zoom", $zoom, time()+604800);
header ("location: index.php");
?> 