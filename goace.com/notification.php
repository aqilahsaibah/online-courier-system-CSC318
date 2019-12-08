<?php
	session_start();
if(!isset($_SESSION['dm_id'])){
	header('location:index.php');
	}

 define('DBINFO', 'mysql:host=localhost;dbname=goace');
    define('DBUSER','root');
    define('DBPASS','');
    function fetchAll($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }
    function performQuery($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }
    
	include 'connection.php';

    if (isset($_GET['noti_id']))
            $noti_id = $_GET['noti_id'];
        else
            $noti_id = 0;

    $query ="UPDATE notification SET status_id = 1 WHERE noti_id = $noti_id;";
    performQuery($query);
    /*$query = "SELECT * from `notifications` where `id` = '$id';";
    if(count(fetchAll($query))>0){
        foreach(fetchAll($query) as $i){
            if($i['type']=='like'){
                echo ucfirst($i['name'])." liked your post. <br/>".$i['date'];
            }else{
                echo "Some commented on your post.<br/>".$i['message'];
            }
        }*/
    //}

?>
  <?php

    
      require_once 'connection.php';

      if (isset($_GET['noti_id']))
            $noti_id = $_GET['noti_id'];
        else
            $noti_id = 0;

     $viewkk= "SELECT * from notification WHERE noti_id = '$noti_id'";
     $resultkk = $conn->query($viewkk);
     $rowkk = $resultkk->fetch_assoc();
     $bookId=$rowkk['book_id'];
    
     $queryO="SELECT track.pick_id, pick_status.pick_desc, deliver_status.deliver_desc, track.deliver_id, 
      customer.cust_add, track.track_id, postcode.ps_code, city.city_code, courier.courier_name
      FROM booking, customer,track, postcode, city, pick_status, deliver_status, courier
      WHERE track.book_id=booking.book_id AND track.cust_id=customer.cust_id AND booking.courier_id=courier.courier_id
      AND customer.ps_id=postcode.ps_id AND postcode.city_id=city.city_id AND track.pick_id=pick_status.pick_id 
      AND track.deliver_id=deliver_status.deliver_id AND track.book_id='$bookId'" ;
            
        $resultO = mysqli_query($conn,$queryO) or die('SQL 3 error'); 
    
        
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
            $track_num=addslashes($_POST['track_num']);
            $dm_id=addslashes($_POST['dm_id']);
            $pick_id=addslashes($_POST['pick_id']);
            $deliver_id=addslashes($_POST['deliver_id']);
            $cust_id=addslashes($_POST['cust_id']);
            $book_id=addslashes($_POST['book_id']);
            

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

        $deliver = "SELECT * from track where track_id = '$track_id'";

        $resultdeliver = $conn->query($deliver);
        $rowdeliver = $resultdeliver->fetch_assoc();
        if(isset($_POST['updateD'])&& isset($_POST['track_id'])){

            $track_id=addslashes($_POST['track_id']);
            $track_num=addslashes($_POST['track_num']);
            $dm_id=addslashes($_POST['dm_id']);
            $pick_id=addslashes($_POST['pick_id']);
            $deliver_id=addslashes($_POST['deliver_id']);
            $cust_id=addslashes($_POST['cust_id']);
            $book_id=addslashes($_POST['book_id']);
            

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
     

    $history="INSERT INTO pickup_history(track_id,track_num,dm_id, pick_id, deliver_id, cust_id, book_id) 
            VALUES('$track_id','$track_num','$dm_id','$pick_id','$deliver_id','$cust_id', '$book_id')";

    
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

<html>

    <head>
	
        <title>GOACE</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/custom.css">
		<link rel="stylesheet" href="ain.css">
    </head>
    <body>
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
		</div>
	</header>
       <section id="boxes">
            <div class="container">
      <h1>Pick-Up Details</h1>
      <hr>
      <a href="adminreg_dm.php"><i class="fas fa-plus-square"></a></i>
	<table>
        <tr>
          <th><center>BIL.</center></td>
          <th><center>TRACK ID.</center></th>
          <th><center>ADDRESS </center></th>
          <th><center>CITY</center></th>
          <th><center>POSTCODE</center></th>
          <th><center>COURIER</center></th>
          <th colspan=2 ><center>STATUS</center></th>
          <th><center>DELETE RECORD</center></th>
        </tr>
       <?php $queryO="SELECT track.pick_id, pick_status.pick_desc, deliver_status.deliver_desc, track.deliver_id, 
                customer.cust_add, track.track_id, postcode.ps_code, city.city_code, courier.courier_name
                FROM booking, customer,track, postcode, city, pick_status, deliver_status, courier
               WHERE track.book_id=booking.book_id AND track.cust_id=customer.cust_id AND booking.courier_id=courier.courier_id
              AND customer.ps_id=postcode.ps_id AND postcode.city_id=city.city_id AND track.pick_id=pick_status.pick_id 
            AND track.deliver_id=deliver_status.deliver_id AND track.book_id='$bookId' ORDER BY track_id DESC" ;
            
        $resultO = mysqli_query($conn,$queryO) or die('SQL 2 error'); 
        $rowO = mysqli_fetch_array($resultO, MYSQLI_ASSOC);
            $bil=1;
            $view = "SELECT * from track WHERE book_id = '$bookId'";
            $result = $conn->query($view);
            $row = $result->fetch_assoc();
            $book_id=$row['book_id'];
            $cust_id=$row['cust_id'];
            $track_id=$row['track_id'];
            $pick_id=$row['pick_id'];
            $deliver_id=$row['deliver_id']; ?>
        <TR>
        <td><div align="center"><?php echo $bil;?>.</div></td>
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
        
        <td><center><a href="pickupDelete.php?track_id=<?php echo $rowO['track_id'];?>">Remove</a></center></td>
        </TR>
       <br>
       
    
      </table>
</div>
            
        </section>
        <br><br><br><br><br><br><br><br>
        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>
    </body>
</html>