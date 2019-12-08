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
                            <a href="chart.php?dm_id=<?php echo $_SESSION['dm_id'];?>">Diagnostics</a>
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


$view = "SELECT * from pickup_history WHERE track_id = '$track_id'";
$result = $conn->query($view)or die('SQL 1 error');
$row = $result->fetch_assoc();
$book_id=$row['book_id'];
$cust_id=$row['cust_id'];
$pick_id=$row['pick_id'];
$deliver_id=$row['deliver_id'];

$view2 = "SELECT * from customer_history WHERE cust_id = '$cust_id'";
$result2 = $conn->query($view2)or die('SQL 2 error');
$row2 = $result2->fetch_assoc();
$ps_id=$row2['ps_id'];
$cust_ic=$row2['cust_ic'];

$view3="Select * from notification_history WHERE dm_id='$dm_id'";
$result3 = $conn->query($view3)or die('SQL 3 error');
$row3 = $result3->fetch_assoc();
$noti_id=$row3['noti_id'];

	



	
	require_once 'connection.php';

	
	$queryO= "SELECT customer_history.cust_ic, customer_history.cust_id, customer_history.cust_add, customer_history.cust_name, postcode.ps_code,
				city.city_code, customer_history.cust_phone, 
				deliver_status.deliver_desc, booking_history.book_id
				FROM  customer_history, pickup_history, postcode, deliver_status, booking_history, city
                
				WHERE  pickup_history.book_id=booking_history.book_id AND pickup_history.cust_id=customer_history.cust_id
			 AND customer_history.ps_id=postcode.ps_id AND  postcode.city_id=city.city_id AND 			
             pickup_history.deliver_id=deliver_status.deliver_id AND pickup_history.track_id='$track_id'";
			
			
			 $resultO = mysqli_query($conn,$queryO) or die('SQL error');
			$rowO = mysqli_fetch_array($resultO, MYSQLI_ASSOC);	
		
?>		  
         <section id="boxes" >
            <div id="content" class="container">
      <h1>Customer Pick-Up History</h1>
      <hr>
      <a href="adminreg_dm.php"><i class="fas fa-plus-square"></a></i>
      <table>
	  <?php $bil=1 ?>
        <tr>
		  <th>BOOKING ID</th>
          <th>NAME</th>
		  <th>IC NO.</th>
          <th >ADDRESS</th>
		  <th>POSTCODE</th>
		  <th>PHONE NO.</th>
		  <th>STATUS</th>
        </tr>

        <tr>
		<td><div align="center"><?php echo $rowO['book_id']; ?></div></td> 
		<td><div align="center"><?php echo $rowO['cust_name']; ?></div></td> 
		<td><div align="center"><?php echo $rowO['cust_ic']; ?></div></td> 
		<TD><center><?php echo $rowO['cust_add']; ?>,  <?php echo $rowO['city_code']; ?></TD>
		<td><center><?php echo $rowO['ps_code']; ?></td>
		<td><center><?php echo $rowO['cust_phone']; ?></td>
		<td><center><?php echo $rowO['deliver_desc']; ?></td>
		
		<br>
		</td>
        </tr>
		
      </table>
    
	  <br>
	  <br><br>
	 <center>
    </div>
        </section>

		
		<br>
		<br>
		<br>
		<br>
		 <br>
		<br>
		<br>
		<br>
		<br>
		<br>
        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>
    </body>
</html>
