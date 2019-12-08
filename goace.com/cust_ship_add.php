<?php
// connect to the server and select database
//include("dbconnect.php");
session_start();
// get value pass from admin_add.php file;
$cust_id = addslashes($_POST['cust_id']);
$cust_ic = addslashes($_POST['cust_ic']);
$cust_name = addslashes($_POST['cust_name']);
$cust_phone = addslashes($_POST['cust_phone']);
$cust_add = addslashes($_POST['cust_add']);
$ps_id = addslashes($_POST['ps_id']);

include 'connection.php';

$_SESSION['cust_id'] = $cust_id;

$query1 = "INSERT INTO customer (cust_id,cust_ic, cust_name, cust_phone, cust_add, ps_id) VALUES ('$cust_id','$cust_ic', '$cust_name', '$cust_phone', '$cust_add', '$ps_id')"; 

if(mysqli_query($conn,$query1))
{
	  

   echo "<script type='text/javascript'>alert('Successfully added!')</script>";
    	header("refresh:0; url = cust_pickup.php");
		exit;
			
}
else
{
	echo "<script type='text/javascript'>alert('Failed to add!')</script>";

		//header("refresh:2; url = admin_add.php");
			exit;
}	
?>
