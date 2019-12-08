<?php
session_start();
require('connection.php');

$id=$_POST['dm_id'];
$name=$_POST['name'];
$ic=$_POST['ic'];
$contact=$_POST['contact'];
$shift=$_POST['shift'];


	$register="INSERT INTO deliveryman(dm_id,dm_name,dm_ic,dm_phone,shift_id) VALUES('$id','$name','$ic','$contact','$shift')" or die("error".mysqli_errno($conn));

 if($conn->query($register)== TRUE){?>

           <script type="text/javascript">
            alert("Succesfully add data");
            window.location.href = "admin_viewDmDetails.php";
            </script>  <?php         
    }else{?>

       <script type="text/javascript">
            alert("Oops cannot add data");
            window.location.href = "admin_viewDmDetails.php";
            </script><?php
    }
    
    $conn->close();

?>
