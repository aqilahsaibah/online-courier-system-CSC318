<?php
session_start();
require('connection.php');


$username=$_POST['admin_id'];
$password=$_POST['admin_pw'];

$username1=$_POST['dm_id'];
$password2=$_POST['dm_ic'];

$login="SELECT * FROM admin WHERE admin_id='$username' AND admin_pw='$password'";
$result_login=mysqli_query($conn, $login); 

$login2="SELECT * FROM deliveryman WHERE dm_id='$username1' AND dm_ic='$password2'";
$result_login2=mysqli_query($conn, $login2);



	if (@mysqli_num_rows($result_login)==1){
		$row1=mysqli_fetch_array($result_login,MYSQLI_ASSOC);
		$_SESSION['admin_id']=true;                     //fetch admin id kat page lain nanti
		$_SESSION['admin_name']=$row1['admin_name'];
		$_SESSION['admin_id']=$row1['admin_id'];

		header('location:admin_home.php');
	}
	if (@mysqli_num_rows($result_login2)==1){
		$row2=mysqli_fetch_array($result_login2,MYSQLI_ASSOC);
		$_SESSION['dm_id']=true;                       //fetch dm id kat page lain nanti
		$_SESSION['dm_name']=$row2['dm_name'];
		$_SESSION['dm_id']=$row2['dm_id'];
		header('location:deliverymanhome.php');
	}
	else{?>
	<script type="text/javascript">
		alert("USERNAME/ PASSWORD IS INVALID");
		window.location.href = "index.php";
	</script><?php
	}
	mysqli_close($conn);
?>