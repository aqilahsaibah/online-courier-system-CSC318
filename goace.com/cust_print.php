<?php
session_start();

require('connection.php');

if (isset($_SESSION['cust_id'])){
  $cust_id = $_SESSION['cust_id'];
}

$query="SELECT book_id from track where cust_id='$cust_id'";
$resultQ=mysqli_query($conn, $query);
$rowQ=mysqli_fetch_array($resultQ,MYSQLI_ASSOC);
$book_id=$rowQ['book_id'];


$sql = "SELECT courier_name from courier INNER JOIN booking ON courier.courier_id = booking.courier_id WHERE booking.book_id = $book_id";

$sql2 = "SELECT ps_code FROM postcode INNER JOIN customer ON postcode.ps_id = customer.ps_id WHERE customer.cust_id = $cust_id";

$sql3 = "SELECT cust_add FROM customer WHERE customer.cust_id = $cust_id";

$sql4 = "SELECT book_id FROM track WHERE track.cust_id = $cust_id";

$sql5 = "SELECT cust_name FROM customer WHERE customer.cust_id = $cust_id";

$sql6 = "SELECT weight_price,min_value,max_value from weight INNER JOIN booking ON weight.weight_id = booking.weight_id WHERE booking.book_id = $book_id";
     $result6=mysqli_query($conn, $sql6);
     $row6=mysqli_fetch_array($result6,MYSQLI_ASSOC);
     $min_value=$row6['min_value'];
     $max_value=$row6['max_value'];
     $weight_price=$row6['weight_price'];


$sql7 = "SELECT category_name from category INNER JOIN booking ON category.category_id = booking.category_id WHERE booking.book_id = $book_id";

$sql8 = "SELECT book_date FROM booking WHERE booking.book_id = $book_id";



$courier_name = getCourierName($sql);
$cust_ps = getCustAdd($sql2);
$cust_add = getAdd($sql3);
$book_id = getBook($sql4);
$cust_name = getCustName($sql5);
$category_name = getCategory($sql7);
$book_date = getBookingDate($sql8);


function getCourierName($sql){
  $con = mysqli_connect("localhost", "root", "", "goace");
  if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
      return $obj->courier_name;
    }
  } 
}

function getCustAdd($sql){
  $con = mysqli_connect("localhost", "root", "", "goace");
  if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
      return $obj->ps_code;
    }
  } 
}

function getAdd($sql){
  $con = mysqli_connect("localhost", "root", "", "goace");
  if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
      return $obj->cust_add;
    }
  } 
}
function getBook($sql){
  $con = mysqli_connect("localhost", "root", "", "goace");
  if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
      return $obj->book_id;
    }
  } 
}

function getCustName($sql){
  $con = mysqli_connect("localhost", "root", "", "goace");
  if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
      return $obj->cust_name;
    }
  } 
}



function getCategory($sql){
  $con = mysqli_connect("localhost", "root", "", "goace");
  if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
      return $obj->category_name;
    }
  } 
}

function getBookingDate($sql){
  $con = mysqli_connect("localhost", "root", "", "goace");
  if ($result=mysqli_query($con,$sql))
  {
  while ($obj=mysqli_fetch_object($result))
    {
      return $obj->book_date;
    }
  } 
}






?>

<!DOCTYPE html>
<html>
    <head>
        <title>GOACE</title>
          <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="ellisha.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="custom.css">

<style>

    .bckgd{
      background-color: white;
      margin-left: 25%;
      margin-right: 25%;

    }

       .active {
    border: 5px solid #008800; 
    padding: 10px 10px 10px 10px; 
    background-color: #ffcc00; 
    color: black;
    font-size:10px     }

     .inactive{
      border: 5px solid #94b8b8; 
      padding: 10px 10px 10px 10px; 
      background-color: #008080; 
      color: white; 
      font-size:10px;
      cursor: not-allowed;
     }
     
     .info {
      padding-bottom:0.5em;
     }

     .info a{
      font-size: 13px;
      font-weight: bold;
      padding-left: 2.5em;
     }

      .info2 {
      float: right;
      padding-bottom:0.5em;
     }

     .info2 a{
      font-size: 16px;
      font-weight: bold;
     }

     .row{
          box-sizing: border-box;
     }


</style>

    </head>

        <header>
            <div class="container">
                <div id="main">
                    <div id="brandig">
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <a href="aboutus.php">About Us</a>
                            <a href="aboutus.php">Contact Us</a>
                            <a href="cust_trackntrace.php">TRACK AND TRACE</a>
                        </div>
                        <ul>
                        <div class="topnav">
                            <li class="sidemenubtn">
                            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
                            <li class="current"><a href = "index.php">HOME</a></li>
                            <li class="current"><a href="cust_trackntrace.php">TRACK & TRACE</a></li>
                            <li class="current"><a href="cust_ship.php">BOOK A SLOT</a></li>
                            <li class="topright"><button onclick="document.getElementById('id01').style.display='block'">ADMIN</button></li>
                            <li class="topright"><button onclick="document.getElementById('id02').style.display='block'">DELIVERY MAN</button></li>
                        </div>
                        </ul>
                <h1><span class = "highlight">GO</span><span class = "highlight2">ACE</span></h1>
                    </div>
            </div>
        </header>

  
  <body>
    <div class="container">
   
      <section id ="grid">
        <div class="sectopnav">
          <div class="grid_item">
              <div class="inactive"><h1>1. BOOK A SLOT</h1></div>
          </div>
          <div class="grid_item">
              <div  class="inactive"><h1>2. SHIPPING & COST OPTIONS</h1></div>
          </div>
          <div class="grid_item">
              <div class="active"><h1>3. PRINT LABELS</h1></div>
          </div>
        </div>
      </div>
    </div>
   
    </div>
    </div>

    <h1><center>Thank you for your reservation with GOACE!</center></h1>
<br><br>
        <div class="bckgd">
          <div class="row">
           <div class="col">
                <h2><center>Here is your booking details</center></h2>
              <div class="info2"><a>Booking ID : <?php echo $book_id; ?></a></div>
            </div>
            <br>
            <div class="col">
              <div class= "info"><a>Today's Date : <?php
              $Today = date('y:m:d',time());
              $new = date('l, F d, Y', strtotime($Today));
              echo $new;
              ?> </a></div>
            </div>
            <div class="col">
              <div class="info"><a>Today's Time : <?php  
                  date_default_timezone_set("Asia/Kuala_Lumpur");
                  $timestamp = time(); 
                  echo "\n"; 
                  echo(date("h:i:s A", $timestamp)); 
                    
                  ?> </a></div>
            </div>
            <div class="col">
              <div class="info"><a>Name : <?php echo $cust_name; ?></a></div>
            </div>
          </div>
          <hr>

          <div class="row">
            <div class="col">
              <center><div class= "info"><a>Booking Information</a></div></center>
            </div>
            <div class="col">
              <div class="info"><a>Courier Name : <?php echo $courier_name ?></a></div>
            </div>
            <br>
          <hr>
          <div class="row">
            <div class="col">
              <center><div class= "info"><a>Delivery Information</a></div></center>
            </div>
            <div class="col">
              <div class= "info"><a>PickUp Date : <?php 
             $originalDate = $book_date ;
              $newDate = date("d-m-Y", strtotime($originalDate));

              echo $newDate;?> </a></div>
            </div>
            <div class="col">
              <div class= "info"><a>Address : <?php echo $cust_add ?> </a></div>
            </div>
            <div class="col">
              <div class= "info"><a>Postcode : <?php echo $cust_ps ?></a></div>
            </div>
            <div class="col">
              <div class= "info"><a>Parcel Weight : <?php echo $min_value ?> (kg) - <?php echo $max_value?></a> (kg)</div>
            </div>
            <div class="col">
              <div class= "info"><a>Parcel Category : <?php echo $category_name ?></a></div>
            </div>
            <div class="col">
              <div class= "info2"><a>Courier Charges : RM  <?php $wp=sprintf('%0.2f',$weight_price); echo $wp; ?></a></div>
            </div>
            <br><br>
            <div class="col">
              <div class= "info2"><a>Delivery Charges : RM  3.00</a></div>
            </div>
            <br><br>
            <div class="col">
              <div class= "info2"><a>Total Payment : RM <?php $totalPay=$weight_price+3; $totpay=sprintf('%0.2f',$totalPay);  
              echo $totpay; $TP = "UPDATE `booking` SET `book_price`='$totpay' WHERE book_id='$book_id'"; $conn->query($TP);?></a></div>
            </div>

            <br><br>
            <div class="col">
              <center><a href onclick="myFunction()">Print Booking Information</a></center>
            </div>
            <br>
          </div>
        </div>

</div>
    <?php   ?>
    <script>
    function myFunction() {
        window.print();
        session_unset();
    }
    </script>

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
  
        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>

    </body>
</html>