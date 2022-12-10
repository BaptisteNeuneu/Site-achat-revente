<?php

$hostname = "localhost";
$username = "justiney";
$password = "Jumeaux91";
$database = "justiney";
$db = mysqli_connect($hostname,$username,$password,$database);
if(!$db)
  die("Problème BD");

?>
