<?php
	session_start();
if(!isset($_SESSION['dm_id'])){
	header('location:index.php');
	}

	include 'connection.php';

?>
<html>

    <head>
	
        <title>GOACE</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/custom.css">
		<link rel="stylesheet" href="ain.css">
    </head>
    <body>
        <header>
            <div class="container">
                <div id="main">
                    <div id="brandig">
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a><br><br><br><br>
							<th scope="col">WELCOME TO DELIVERY MAN PAGE!
							<p>HELLO
							<?php echo $_SESSION['dm_name'];?> !</p></th>
							<br>
                            <a href="pickUpDelivery.php?dm_id=<?php echo $_SESSION['dm_id'];?>">Pick-up & Delivery Details</a>
                            <a href="pickUpHistory.php?dm_id=<?php echo $_SESSION['dm_id'];?>">Pick-Up History</a>
                            <a href="#">Diagnostics</a>
                        </div>
                        <ul>
                        <div class="topnav">
                            <li class="sidemenubtn">
                            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
                            <li class="current"><a href = "deliverymanhome.php">HOME</a></li>
                            <li class="current"><a href = "#">NOTIFICATION</a></li>
							<li class="col"><?php
							$Today = date('y:m:d',time());
							$new = date('l, F d, Y', strtotime($Today));
							echo $new;
							?></li>
							<td style="font-size:14px;">
         
                            <li class="logbtn"><a href = "logout.php">LOGOUT</a></li>
                        </div>
                        </ul>
                <h1><span class = "highlight">GO</span><span class = "highlight2">ACE</span></h1>
                    </div>
            </div>
        </header>

    <script>
        function openNav() {
                document.getElementById("mySidenav").style.width = "250px";
                document.getElementById("main").style.marginLeft = "250px";
                        }
        function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
            }
    </script>
        
 <?php
	if (isset($_GET['dm_id']))
            $dm_id = $_GET['dm_id'];
        else
            $dm_id = 0;
		
		if (isset($_GET['track_id']))
            $track_id = $_GET['track_id'];
        else
            $track_id = 0;

$view = "SELECT * from booking WHERE dm_id = '$dm_id'";
$result = $conn->query($view);
$row = $result->fetch_assoc();
$book_id=$row['book_id'];
$courier_id=$row['courier_id'];

$view1 = "SELECT * from track WHERE dm_id = '$dm_id'";
$result1 = $conn->query($view1);
$row1 = $result1->fetch_assoc();
$track_id=$row1['track_id'];
$pick_id=$row1['pick_id'];
$deliver_id=$row1['deliver_id'];

$view2 = "SELECT * from customer WHERE track_id = '$track_id'";
$result2 = $conn->query($view2);
$row2 = $result2->fetch_assoc();
$cust_ic=$row2['cust_ic'];
$ps_id=$row2['ps_id'];



	
	require_once 'connection.php';

	
	 $queryO="SELECT customer.cust_add, postcode.ps_code, track.track_id, courier.courier_name, track.track_timein,
						city.city_code, track.pick_id, track.deliver_id, pick_status.pick_desc, deliver_status.deliver_desc
				FROM customer, postcode, track, courier, pick_status, deliver_status,booking, city
				WHERE `customer`.`ps_id`=`postcode`.`ps_id` AND `customer`.`track_id`=`track`.`track_id` AND 
				`booking`.`courier_id`=`courier`.`courier_id` AND `track`.`pick_id`=`pick_status`.`pick_id` AND 
				`track`.`deliver_id`=`deliver_status`.`deliver_id` AND `postcode`.`city_id`=`city`.`city_id` AND 
				`track`.`dm_id`='1'";
			
		$resultO = mysqli_query($conn,$queryO) or die('SQL 2 error'); 
		
				if (isset($_POST['updateP'])) {

			
			//update pick status
			$queryP = "UPDATE `track` SET `pick_id`='1' WHERE track_id='$track_id'";
			$resultP = mysqli_query($conn,$queryP)or die(mysqli_error());
			
			if ($resultP)
			{
			echo "<script>alert('Good Job, You Have Picked The Item!');</script>";
				//echo '<script> window.location="deliverymanhome.php"; <script>';
			}
			else
			
				echo "<script>alert('Item Has Not Been Picked :( ! ');</script>";
				
			}
				if (isset($_POST['updateD'])) {
			//update deliver status
			$queryD = "UPDATE `track` SET `deliver_id`='1' WHERE track_id='$track_id'";

				
			$resultD = mysqli_query($conn,$queryD)or die(mysqli_error());
			if ($resultD)
			{
			echo "<script>alert('Thank You, The Item Has Been Delivered !');</script>";
				//echo '<script> window.location="deliverymanhome.php"; <script>';
			}
			else
			{
				echo "<script>alert('Item Does Not Delivered :( !');</script>";
				}		
			}
			
			//move deleted data to pickUpHistory table
			if (isset($_GET['track_id']))
            $track_id = $_GET['track_id'];
			else
            $track_id = 0;
		
			$d="SELECT track_id, track_num, track_timein, track_timeout, dm_id, pick_id,
			deliver_id FROM track WHERE track_id='$track_id'";
			$resultd=mysqli_query($conn, $d);
			$rowd=mysqli_fetch_array($resultd,MYSQLI_ASSOC);
			
			$track_id=$rowd['track_id'];
			$track_num=$rowd['track_num'];
			$track_timein=$rowd['track_timein'];
			$track_timeout=$rowd['track_timeout'];
			$dm_id=$rowd['dm_id'];
			$pick_id=$rowd['pick_id'];
			$deliver_id=$rowd['deliver_id'];
		
			if (isset($_POST['delete'])) {
			
			$delete = "INSERT INTO `pickup_history`(`track_id`, `track_num`, `track_timein`, `track_timeout`, `dm_id`, `pick_id`,
			`deliver_id`) VALUES ('$track_id','$track_num','$track_timein','$track_timeout','$dm_id','$pick_id','$deliver_id')";
			
			if($conn->query($delete) === true) {
				$sql = "DELETE FROM track WHERE track_id = '$track_id'";
				if($conn->query($d) === true)
				{?>
				<script type="text/javascript">
				alert("Record Deleted!");
				window.location.href = "pickUpDelivery.php";
				</script>
				<?php
				}
			}
			else{?>
				<script type="text/javascript">
				alert("Delete Error!");
				window.location.href = "pickUpDelivery.php";
				</script><?php
			}
			} 
			$conn->close();
			
?>		
        <section id="boxes">
            <div class="container">
      <h1>Pick-Up Details</h1>
      <hr>
      <a href="adminreg_dm.php"><i class="fas fa-plus-square"></a></i>
      <table>
        <tr>
		  <th>BIL.</td>
          <th>TRACK ID.</th>
          <th>ADDRESS</th>
		  <th>CITY</th>
		  <th>POSTCODE</th>
          <th>COURIER</th>
          <th>TIME IN</th>
		  <th colspan=2 >STATUS</th>
        </tr>
<?php $bil=1;
	 while ($rowO = mysqli_fetch_array($resultO, MYSQLI_ASSOC))
		 {
			 ?>
		<TR>
		<td><div align="center"><?php echo $bil;?></div></td>
		<td><div align="center"><?php echo $rowO['track_id']; ?></TD>
		<td><div align="center"><?php echo $rowO['cust_add']; ?></TD>
		<TD><center><?php echo $rowO['city_code']; ?></TD>
		<TD><center><?php echo $rowO['ps_code']; ?></TD>
		<td><center><?php echo $rowO['courier_name']; ?></td>
		<td><center><?php echo $rowO['track_timein']; ?></td>
		<?php if (($rowO['pick_id'])=='0'){  ?>
		       <form action="pickUpDelivery.php" method="post">
			   <input type="hidden" name="track_id" value="<?php echo $rowO['track_id']; ?>"> 
		       <TD><center><input type="submit" name="updateP" value="PICK"></TD></form>
			   
		<?php 
				$track_id= $rowO['track_id'];}  else { ?>   
				<td align="center"><?php echo $rowO['pick_desc']; ?></td>
		<?php }  ?>
		<?php if (($rowO['deliver_id'])=='0'){  ?>
		       <form action="pickUpDelivery.php" method="post">
			   <input type="hidden" name="track_id" value="<?php echo $rowO['track_id']; ?>"> 
		       <TD><center><input type="submit" name="updateD" value="DELIVER"></TD></form>
			   
		<?php 
				$track_id= $rowO['track_id'];}  else { ?>   
				<td align="center"><?php echo $rowO['deliver_desc']; ?></td>
		<?php }  ?>
		
		<td>
	<br>
    <a href="pickUpDelivery.php"><input type="submit" style="border:1px solid #60af2e; background:#60af2e; height:40px; width:105px; border-radius:3px; color:#FFF;" name="delete" value="Delete"></a>
    <br><br>
    </td>
		</TR>
	<?php $bil++ ?>
	<?php
		   }
	?>
		<br>
		</td>
        </tr>
	
      </table>
</div>
            
        </section>
        
        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>
    </body>
</html>