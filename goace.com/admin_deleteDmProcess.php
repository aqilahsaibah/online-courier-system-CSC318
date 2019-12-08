<?php
	include 'connection.php';
	if (isset($_GET['dm_id']))
            $dm_id = $_GET['dm_id'];
        else
            $dm_id = 0;

     $sql1="SELECT dm_id,dm_name,dm_ic,dm_phone,shift_id FROM deliveryman WHERE dm_id='$dm_id'";
     $result1=mysqli_query($conn, $sql1);
     $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);

     $dm_id=$row1['dm_id'];
     $dm_name=$row1['dm_name'];
     $dm_ic=$row1['dm_ic'];
     $dm_phone=$row1['dm_phone'];
     $shift_id=$row1['shift_id'];
     

    $sql2="INSERT INTO dmhistory(dm_id,dm_name,dm_ic,dm_phone,shift_id) VALUES('$dm_id','$dm_name','$dm_ic','$dm_phone','$shift_id')";

	
	if($conn->query($sql2) === true) {
		$sql = "DELETE FROM deliveryman WHERE dm_id = '$dm_id'";
		if($conn->query($sql) === true)
		{?>
			<script type="text/javascript">
			alert("Succesfully deleted data");
			window.location.href = "admin_viewDmDetails.php";
			</script>
		<?php
		}
		
	}else{?>
		<script type="text/javascript">
			alert("Oops something error");
			window.location.href = "admin_viewDmDetails.php";
			</script><?php
	}
	$conn->close();
?>