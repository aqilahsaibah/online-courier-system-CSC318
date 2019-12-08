<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['dm_id'])){
	header('location:index.php');
	
	}
	include 'connection.php';
	
	if (isset($_GET['dm_id']))
            $dm_id = $_GET['dm_id'];
        else
            $dm_id = 0;
		
		if (isset($_GET['track_id']))
            $track_id = $_GET['track_id'];
        else
            $track_id = 0;
		
        $view2 = "SELECT * from notification_history WHERE dm_id = '$dm_id'";
        $result2 = $conn->query($view2);
        $row2 = $result2->fetch_assoc();
        $bookId=$row2['book_id'];



		$view1 = "SELECT * from pickup_history WHERE book_id = '$bookId'";
$result1 = $conn->query($view1);
$row1 = $result1->fetch_assoc();
$track_id=$row1['track_id'];
$pick_id=$row1['pick_id'];
$deliver_id=$row1['deliver_id'];

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


$view = "SELECT * from pickup_history WHERE book_id = '$book_id'";
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
     $viewkk= "SELECT * from pickup_history WHERE dm_id = '$dm_id'";
     $resultkk = $conn->query($viewkk);
     $rowkk = $resultkk->fetch_assoc();
     $bookId=$rowkk['book_id'];
    
     $queryO="SELECT pickup_history.pick_id
                FROM pickup_history
                WHERE 
                pickup_history.book_id='$bookId' " ;
            
        $resultO = mysqli_query($conn,$queryO) or die('SQL 3 error'); ?>
         </header>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
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
include 'connection.php';

$sql="Select count(pickup_history.pick_id) from pickup_history where pick_id='1'";
$result=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
 
$count=$row["count(pickup_history.pick_id)"]*10;

$sql2="Select count(pickup_history.pick_id) from pickup_history where pick_id='0'";
$result2=mysqli_query($conn, $sql2);
$row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);
 
$count2=$row2["count(pickup_history.pick_id)"]*10;

$dataPoints = array( 
	array("label"=>"Picked-Up", "symbol" => "picked-up","y"=> $count),
	array("label"=>"Non Picked-Up", "symbol" => "non picked-up","y"=>$count2),

 
)
 
?>

<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: " Delivery-Man Productivity"
	},
	data: [{
		type: "doughnut",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
</html>             