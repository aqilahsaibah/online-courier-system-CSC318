<?php

	
	include 'connection.php';
	
	if (isset($_GET['dm_id']))
            $dm_id = $_GET['dm_id'];
        else
            $dm_id = 0;
		
		if (isset($_GET['track_id']))
            $track_id = $_GET['track_id'];
        else
            $track_id = 0;
		
$view = "SELECT * from track WHERE track_id = '$track_id'";
$result = $conn->query($view);
$row = $result->fetch_assoc();
$book_id=$row['book_id'];
$cust_id=$row['cust_id'];
$pick_id=$row['pick_id'];
$deliver_id=$row['deliver_id'];
$track_num=$row['track_num'];

echo $book_id;
$view1 = "SELECT * from booking WHERE book_id = '$book_id'";
$result1 = $conn->query($view1);
$row1 = $result1->fetch_assoc();
$book_price=$row1['book_price'];
$book_date=$row1['book_date'];
$courier_id=$row1['courier_id'];
$weight_id=$row1['weight_id'];
$category_id=$row1['category_id'];
$shift_id=$row1['shift_id'];

$view3= "SELECT * from notification WHERE book_id = '$book_id'";
$result3 = $conn->query($view3);
$row3 = $result3->fetch_assoc();
$noti_id=$row3['noti_id'];
$dm_id=$row3['dm_id'];
$admin_id=$row3['admin_id'];
$status_id=$row3['status_id'];
$noti_time=$row3['noti_time'];
$book_id=$row3['book_id'];

$view2= "SELECT * from customer WHERE cust_id = '$cust_id'";
$result2 = $conn->query($view2);
$row2= $result2->fetch_assoc();
$cust_id=$row2['cust_id'];
$cust_ic=$row2['cust_ic'];
$cust_name=$row2['cust_name'];
$cust_phone=$row2['cust_phone'];
$cust_add=$row2['cust_add'];
$ps_id=$row2['ps_id'];


echo $dm_id;
echo $track_num;
    $sql1="INSERT INTO pickup_history (track_id, track_num,dm_id,  pick_id, deliver_id, cust_id, book_id) 
	VALUES('$track_id', '$track_num','$dm_id',  '$pick_id', '$deliver_id', '$cust_id', '$book_id')";
	
	
	if($conn->query($sql1) === true) {
		$sql11 = "DELETE FROM `track` WHERE `track`.`track_id` = $track_id";
		if($conn->query($sql11) === true)
		{
            $sql2="INSERT INTO booking_history (book_id, book_price,  book_date, courier_id, weight_id, category_id,shift_id) 
	               VALUES('$book_id', '$book_price',  '$book_date', '$courier_id', '$weight_id', '$category_id','$shift_id')";
	              
	              if($conn->query($sql2) === true)
		       {
		       	   $sql22 = "DELETE FROM booking WHERE book_id = $book_id";
		       	 
                             if($conn->query($sql22) === true)
		                    {
		                    	$sql4="INSERT INTO notification_history (noti_id, dm_id,  admin_id, status_id, noti_time, book_id) 
	                            VALUES('$noti_id', '$dm_id',  '$admin_id', '$status_id', '$noti_time', '$book_id')";
	                            if($conn->query($sql4) === true)
		                    {
		                    	$sql44 = "DELETE FROM notification WHERE book_id = $book_id";
		                    	if($conn->query($sql44) === true)
		                        {
		                        	$sql5="INSERT INTO customer_history (cust_id, cust_ic,  cust_name, cust_phone, cust_add, ps_id) 
									VALUES('$cust_id', '$cust_ic',  '$cust_name', '$cust_phone', '$cust_add', '$ps_id')";
									if($conn->query($sql5) === true)
		                        {
		                        	 $sql55 = "DELETE FROM customer WHERE cust_id = $cust_id";
		                        	 if($conn->query($sql55) === true)
		                        {
			?>                   
		       	 

			                    <script type="text/javascript">
			                    alert("Succesfully deleted data");
			                    window.location.href = "deliverymanhome.php";
			                    </script>
		                    <?php
		                     }
		                     }     
		                    }
		                 }
		            }
		        }
		    }
		}
		     

		
	else{?>
		<script type="text/javascript">
			alert("Oops something error");
			window.location.href = "deliverymanhome.php";
			</script><?php
	}
	$conn->close();
?>