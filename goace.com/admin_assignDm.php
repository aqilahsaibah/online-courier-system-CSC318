<?php
session_start();
if(!isset($_SESSION['admin_id'])){
  header('location:index.php');
  }
include 'connection.php';
 $query1="SELECT * FROM notification";
  $result1 = mysqli_query($conn,$query1) or die('SQL error');
   while($row2 = mysqli_fetch_array($result1)):
    $noti_id=$row2['noti_id'];
   endwhile;
  
  $noti_id++;
 
  
	
	if (isset($_GET['dm_id']))
            $dm_id = $_GET['dm_id'];
        else
            $dm_id = 0;

        if (isset($_GET['admin_id']))
            $admin_id = $_GET['admin_id'];
        else
            $admin_id = 0;

    if (isset($_GET['book_id']))
            $book_id = $_GET['book_id'];
        else
            $book_id = 0;

   

     $sql1="INSERT INTO notification (noti_id,dm_id,admin_id,status_id,noti_time,book_id) VALUES('$noti_id','$dm_id','$admin_id',0,CURRENT_TIMESTAMP,'$book_id') ";
     
	if($conn->query($sql1) === true) {
		?>
			<script type="text/javascript">
			alert("Succesfully send notification");
			window.location.href = "admin_notification.php";
			</script>
		<?php
		}
		
	else{?>
		<script type="text/javascript">
			alert("Oops cant send the notification");
			window.location.href = "admin_notification.php";
			</script><?php
	}
	$conn->close();
?>