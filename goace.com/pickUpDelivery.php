<!DOCTYPE html>
<?php
	session_start();
if(!isset($_SESSION['dm_id'])){
	header('location:index.php');
	}

	include 'connection.php';
  $dm_id = $_SESSION['dm_id']; //fetch dm id kat page login process pakai session
		

		if (isset($_GET['track_id']))
            $track_id = $_GET['track_id'];
        else
			$track_id = 0;

$view123= "SELECT * from notification WHERE dm_id = '$dm_id'";
$result123 = $conn->query($view123);
$row123 = $result123->fetch_assoc();
$book_id=$row123['book_id'];
$noti_id=$row123['noti_id'];


$view = "SELECT * from track WHERE book_id = '$book_id'";
$result = $conn->query($view);
$row = $result->fetch_assoc();
$book_id=$row['book_id'];
$cust_id=$row['cust_id'];
$track_id=$row['track_id'];
$pick_id=$row['pick_id'];
$deliver_id=$row['deliver_id'];

$view2 = "SELECT * from customer WHERE cust_id = '$cust_id'";
$result2 = $conn->query($view2);
$row2 = $result2->fetch_assoc();
$ps_id=$row2['ps_id'];
	
		
	$dm = "SELECT * from deliveryman WHERE dm_id = '$dm_id'";
	$result = $conn->query($dm);
	$row = $result->fetch_assoc();
	$shift_id=$row['shift_id'];
	
	$shift="SELECT * FROM deliveryman, shift WHERE deliveryman.shift_id=shift.shift_id AND dm_id='$dm_id'";
	$resultS = mysqli_query($conn,$shift) or die('SQL 2 error'); 
	$rowS = mysqli_fetch_array($resultS, MYSQLI_ASSOC);
	
	
?>
<?php
  //notification function
    define('DBINFO', 'mysql:host=localhost;dbname=goace');
    define('DBUSER','root');
    define('DBPASS','');
    
?>
<html>
    <head>
        <title>GOACE</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/custom.css">
		
		
		 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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
                            <a href="pickUpDelivery.php?dm_id=<?php echo $_SESSION['dm_id'];?>">Pick-Up & Delivery Details</a>
                            <a href="pickUpHistory.php?dm_id=<?php echo $_SESSION['dm_id'];?>">Pick-Up History</a>
                            <a href="chart.php?dm_id=<?php echo $_SESSION['dm_id'];?>">Diagnostics</a>
                        </div>

                        <ul>
						<nav class="navbar navbar-expand-md navbar-dark fixed-center">
							<div class="topnav">
                            <li class="sidemenubtn">
                            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
							<div class="collapse navbar-collapse" id="navbarsExampleDefault">
                            <li class="current"><a href = "deliverymanhome.php">HOME</a></li>
							
                            <ul class="navbar-nav mr-auto">
							<li class="nav-item dropdown">
							<a class="nav-link" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notifications
							<?php
							$query = "SELECT * from notification where status_id = '0' AND dm_id=$dm_id order by status_id ASC";
							function fetchAll($query){
      						  $con = new PDO(DBINFO, DBUSER, DBPASS);
       						  $stmt = $con->query($query);
      						  return $stmt->fetchAll();
  							  }
							if(count(fetchAll($query))>0){
							?>
							<span class="badge badge-light"><?php echo count(fetchAll($query)); ?></span>
							<?php
							}
							?>
							</a>
					<div class="dropdown-menu" aria-labelledby="dropdown01">
					<?php
				
					$query = "SELECT * from notification where dm_id=$dm_id order by status_id ASC ";
					if(count(fetchAll($query))>0){
                     foreach(fetchAll($query) as $i){
					?>
					<a style ="
						<?php
                            if($i['status_id']==0){
                                echo "font-weight:bold;";
                            }
                         ?>
                         " class="dropdown-item" href="notification.php?noti_id=<?php echo $i['noti_id'];?>">
					<small><i><?php echo date('F j, Y, g:i a',strtotime($i['noti_time'])) ?></i></small><br/>
						<?php 
                  
					if($i){
						echo "You got an errand !";
					}
               
                  
					?>
					</a>
					<div class="dropdown-divider"></div>
					<?php
						}
					}else{
						echo "No Notification.";
					}
						?>
				</div>
			</li>
			</ul>
							<li class="nav-item dropdown"><?php
							$Today = date('y:m:d',time());
							$new = date('l, F d, Y', strtotime($Today));
							echo $new;
							?></li>
							<td style="font-size:14px;">
         
                            <li class="current"><a href = "logout.php">LOGOUT</a></li></td>
                        </div>
						</nav>
                        </ul>
						
                <h1><span class = "highlight">GO</span><span class = "highlight2">ACE</span></h1>
                    </div>
            </div>
        </div>
		</div>
  <?php

	
	require_once 'connection.php';
     $viewkk= "SELECT * from notification WHERE dm_id = '$dm_id'";
     $resultkk = $conn->query($viewkk);
     $rowkk = $resultkk->fetch_assoc();
     $bookId=$rowkk['book_id'];
	
	 $queryO="SELECT track.pick_id, pick_status.pick_desc, deliver_status.deliver_desc, track.deliver_id, 
	  customer.cust_add, track.track_id, postcode.ps_code, city.city_code, courier.courier_name
FROM booking, customer,track, postcode, city, pick_status, deliver_status, courier
WHERE track.book_id=booking.book_id AND track.cust_id=customer.cust_id AND booking.courier_id=courier.courier_id
AND customer.ps_id=postcode.ps_id AND postcode.city_id=city.city_id AND track.pick_id=pick_status.pick_id 
AND track.deliver_id=deliver_status.deliver_id AND track.book_id='$bookId'" ;
			
		$resultO = mysqli_query($conn,$queryO) or die('SQL 3 error'); ?>
         </header>
<body><center>
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
	
          $dm_id = $_SESSION['dm_id']; 
		
		if (isset($_GET['track_id']))
            $track_id = $_GET['track_id'];
        else
			$track_id = 0;

$view12 = "SELECT * from notification WHERE dm_id = '$dm_id'";
$result12 = $conn->query($view12);
//$row12 = $result12->fetch_assoc();
//$bookId=$row12['book_id'];


/*$view = "SELECT * from track WHERE book_id = '$bookId'";
$result = $conn->query($view);
$row = $result->fetch_assoc();
$book_id=$row['book_id'];
$cust_id=$row['cust_id'];
$track_id=$row['track_id'];
$pick_id=$row['pick_id'];
$deliver_id=$row['deliver_id'];

$view2 = "SELECT * from customer WHERE cust_id = '$cust_id'";
$result2 = $conn->query($view2);
$row2 = $result2->fetch_assoc();
$ps_id=$row2['ps_id'];

$view3="Select * from notification WHERE dm_id='$dm_id'";
$result3 = $conn->query($view3);
$row3 = $result3->fetch_assoc();
$noti_id=$row3['noti_id'];
*/

	
	require_once 'connection.php';

	
	 /*$queryO="SELECT track.pick_id, pick_status.pick_desc, deliver_status.deliver_desc, track.deliver_id, 
	  customer.cust_add, track.track_id, postcode.ps_code, city.city_code, courier.courier_name
FROM booking, customer,track, postcode, city, pick_status, deliver_status, courier
WHERE track.book_id=booking.book_id AND track.cust_id=customer.cust_id AND booking.courier_id=courier.courier_id
AND customer.ps_id=postcode.ps_id AND postcode.city_id=city.city_id AND track.pick_id=pick_status.pick_id 
AND track.deliver_id=deliver_status.deliver_id AND track.book_id='$bookId' ORDER BY track_id DESC" ;
			
		$resultO = mysqli_query($conn,$queryO) or die('SQL 2 error'); */
	
		
		//update pick status
		if (isset($_GET['track_id']))
            $track_id = $_GET['track_id'];
        else
            $track_id = 0;

		$pick = "SELECT * from track where track_id = '$track_id'";

		$resultpick = $conn->query($pick);
		$rowpick = $resultpick->fetch_assoc();
		if(isset($_POST['updateP'])&& isset($_POST['track_id'])){

			$track_id=addslashes($_POST['track_id']);
			/*$track_num=addslashes($_POST['track_num']);
			$dm_id=addslashes($_POST['dm_id']);
			$pick_id=addslashes($_POST['pick_id']);
			$deliver_id=addslashes($_POST['deliver_id']);
			$cust_id=addslashes($_POST['cust_id']);
			$book_id=addslashes($_POST['book_id']);*/
			

			$queryP = "UPDATE `track` SET `pick_id`='1' WHERE track_id='$track_id'";
			
			 if($conn->query($queryP)== TRUE){?>

				<script type="text/javascript">
				alert("Good Job! Item Picked.");
				window.location.href = "pickUpDelivery.php?dm_id=<?php echo $_SESSION['dm_id'];?>";
				</script>  <?php         
			}else{?>

				<script type="text/javascript">
				alert("Oops! Something Wrong.");
				window.location.href = "pickUpDelivery.php?dm_id=<?php echo $_SESSION['dm_id'];?>";
				</script><?php
			}
    
			$conn->close();
			}
			
			
			//update deliver status

		//$deliver = "SELECT * from track where track_id = '$track_id'";

		//$resultdeliver = $conn->query($deliver);
		//$rowdeliver = $resultdeliver->fetch_assoc();
		if(isset($_POST['updateD'])&& isset($_POST['track_id'])){

			$track_id=addslashes($_POST['track_id']);
			/*$track_num=addslashes($_POST['track_num']);
			$dm_id=addslashes($_POST['dm_id']);
			$pick_id=addslashes($_POST['pick_id']);
			$deliver_id=addslashes($_POST['deliver_id']);
			$cust_id=addslashes($_POST['cust_id']);
			$book_id=addslashes($_POST['book_id']);*/
			

			$queryD = "UPDATE `track` SET `deliver_id`='1' WHERE track_id='$track_id'";
			
			 if($conn->query($queryD)== TRUE){?>

				<script type="text/javascript">
				alert("Good Job! Item Delivered.");
				window.location.href = "pickUpDelivery.php?dm_id=<?php echo $_SESSION['dm_id'];?>";
				</script>  <?php         
			}else{?>

				<script type="text/javascript">
				alert("Oops! Something Wrong.");
				window.location.href = "pickUpDelivery.php?dm_id=<?php echo $_SESSION['dm_id'];?>";
				</script><?php
			}
    
			$conn->close();
			}
			
			
			//move deleted data to pickUpHistory table
		
			include 'connection.php';
			if(isset($_POST['delete'])&& isset($_POST['track_id'])){

			$trackD="SELECT * FROM track WHERE track_id='$track_id'";
			$resultD=mysqli_query($conn, $trackD);
			$rowD=mysqli_fetch_array($resultD,MYSQLI_ASSOC);

			$track_id=addslashes($_POST['track_id']);
			$track_num=addslashes($_POST['track_num']);
			$dm_id=addslashes($_POST['dm_id']);
			$pick_id=addslashes($_POST['pick_id']);
			$deliver_id=addslashes($_POST['deliver_id']);
			$cust_id=addslashes($_POST['cust_id']);
			$book_id=addslashes($_POST['book_id']);
     

    $history="INSERT INTO pickup_history(track_id,track_num,track_timein,track_timeout,dm_id, pick_id, deliver_id) 
			VALUES('$track_id','$track_num','$track_timein','$track_timeout','$dm_id','$pick_id','$deliver_id')";

	
	if($conn->query($history) === true) {
		$h = "DELETE * FROM track WHERE track_id = '$track_id'";
		if($conn->query($h) === true)
		{?>
			<script type="text/javascript">
			alert("Record Deleted!");
			window.location.href = "pickUpDelivery.php?dm_id=<?php echo $_SESSION['dm_id'];?>";
			</script>
		<?php
		}
		else{?>
		<script type="text/javascript">
			alert("Oops! Something Error.");
			window.location.href = "pickUpDelivery.php?dm_id=<?php echo $_SESSION['dm_id'];?>";
			</script><?php
		}
	}
	$conn->close();
			}
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
		  <th colspan=2 >STATUS</th>
		  <th>DELETE RECORD</th>
        </tr>
<?php $bil=1;
if($result12->num_rows > 0){
	 while ($row12 = mysqli_fetch_array($result12, MYSQLI_ASSOC))
		 {   $bookId=$row12['book_id'];
		 	 $queryO="SELECT track.pick_id, pick_status.pick_desc, deliver_status.deliver_desc, track.deliver_id, 
	            customer.cust_add, track.track_id, postcode.ps_code, city.city_code, courier.courier_name
                FROM booking, customer,track, postcode, city, pick_status, deliver_status, courier
               WHERE track.book_id=booking.book_id AND track.cust_id=customer.cust_id AND booking.courier_id=courier.courier_id
              AND customer.ps_id=postcode.ps_id AND postcode.city_id=city.city_id AND track.pick_id=pick_status.pick_id 
            AND track.deliver_id=deliver_status.deliver_id AND track.book_id='$bookId' ORDER BY track_id DESC" ;
			
		$resultO = mysqli_query($conn,$queryO) or die('SQL 2 error'); 
		$rowO = mysqli_fetch_array($resultO, MYSQLI_ASSOC);
			
			$view = "SELECT * from track WHERE book_id = '$bookId'";
            $result = $conn->query($view);
			$row = $result->fetch_assoc();
			$book_id=$row['book_id'];
			$cust_id=$row['cust_id'];
			$track_id=$row['track_id'];
			$pick_id=$row['pick_id'];
			$deliver_id=$row['deliver_id']; ?>
		<TR>
		<td><div align="center"><?php echo $bil;?></div></td>
		<td><div align="center"><?php echo $rowO['track_id']; ?></TD>
		<td><div align="center"><?php echo $rowO['cust_add']; ?></TD>
		<TD><center><?php echo $rowO['city_code']; ?></TD>
		<TD><center><?php echo $rowO['ps_code']; ?></TD>
		<td><center><?php echo $rowO['courier_name']; ?></td>
		<?php if (($rowO['pick_id'])=='0'){  ?>
		       <form action="pickUpDelivery.php" method="post">
			   <input type="hidden" name="track_id" value="<?php echo $rowO['track_id']; ?>"> 
		       <TD><center><input type="submit" style="border:1px solid #569c29; background:#569c29; height:40px; 
			   width:105px; border-radius:3px; color:#FFF;"
			   name="updateP" value="PICK"></center></TD></form>
			   
		<?php 
				$track_id= $rowO['track_id'];}  else { ?>   
				<td><center><input type="submit" style="border:1px solid #900; background:#900; height:40px;
				opacity:0.7; width:105px; border-radius:3px; color:#FFF;" 
				value="<?php echo $rowO['pick_desc']; ?>" disabled></center></td>
		<?php }  ?>
		<?php if (($rowO['deliver_id'])=='0'){  ?>
		       <form action="pickUpDelivery.php" method="post">
			   <input type="hidden" name="track_id" value="<?php echo $rowO['track_id']; ?>"> 
		       <TD><center><input type="submit" style="border:1px solid #569c29; background:#569c29; height:40px; 
			   width:105px; border-radius:3px; color:#FFF;" 
			   name="updateD" value="DELIVER"></center></TD></form>
			   
		<?php 
				$track_id= $rowO['track_id'];}  else { ?>   
				<td><center><input type="submit" style="border:1px solid #900; background:#900; height:40px; 
				width:105px; opacity:0.7; border-radius:3px; color:#FFF;" 
				value="<?php echo $rowO['deliver_desc']; ?>" disabled></center></td>
		<?php }  ?>

		<td><center><a href="pickupDelete.php?track_id=<?php echo $rowO['track_id'];?>"onclick="return confirm('Are you sure you want to Remove?');">Remove</a></td>
		
		</TR>
	<?php $bil++ ?>
	<?php
		 }
		 }else{?>
							<td colspan=10><?php echo "<center>No records</center>";?></td>
                            <?php
						}
	?>
		<br>
		</td>
        </tr>
	
      </table>
</div>
            
        </section>
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <br><br><br><br><br><br><br><br>
        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>
    </body>
</html>