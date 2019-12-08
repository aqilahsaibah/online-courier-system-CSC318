<?php # S 
$dbhost = 'localhost';
$dbuser = 'root'; //never use root user in live system
$dbpass = ''; // never use blank or simple password or password same as user name in live system
$dbname = 'goace';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');


?>