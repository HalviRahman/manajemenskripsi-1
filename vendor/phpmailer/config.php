<?php
$dbhost = 'narayaitsolution.web.id';
$dbuser = 'narayait_pelayananonline';
$dbpass = 'tbfvGBCaPf';
$dbname = 'narayait_pelayananonline';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
mysqli_query($conn, "SET NAMES utf8;");
mysqli_query($conn, "SET CHARACTER_SET utf8;");
/*
if (!$conn) {
	die('Could not connect: ') . mysqli_error($conn);
}
*/
//echo 'Connected successfully' . "<br/>";

/*
$dbsiakad = mysqli_connect('10.10.7.91:3306', 'surat', 'surat2020', 'surat');
if (!$dbsiakad) {
	die('Could not connect: ' . mysqli_error());
}
*/