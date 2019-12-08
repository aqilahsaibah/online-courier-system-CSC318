<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');
	}

    function getid()
    {
        echo $_SESSION['admin_id'];
    }


?>

<html>
    <head>
        <title>GOACE</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/custom.css">
<style>
        .dmmenu{
    float: left;
    width: 33.33%;
    padding: 10px;
    height: 300px;
     }

     .dmmenu img{
    width: 100%;
    height: 80%;
    opacity: 0.8;
     }

     .dmmenu img:hover{
        opacity: 1.0;
     }
 </style>
    </head>
    <body>
        <header>
            <div class="container">
                <div id="main">
                    <div id="brandig">
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
							<th scope="col">Hello Admin !<p>
							<?php echo $_SESSION['admin_name'];?></p></th>
                            <a href="admin_viewDmDetails.php" target="_blank">Delivery Man Schedule</a>
                            <a href="admin_insertTracking.php" target="_blank">Customer's Tracking Number</a>
                            <a href="admin_registerdm.php"target="_blank">Register Delivery Man</a>
                            <a href="admin_reporting.php">Reporting</a>
                        </div>
                        <ul>
                        <div class="topnav">
                            <li class="sidemenubtn">
                            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
                            <li class="current"><a href = "admin_home.php">HOME</a></li>
                            <li class="current"><a href = "admin_notification.php">NOTIFICATION</a></li>
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
        
        
<div class="container">
                <br><br>
                  <div class="courier-pg">
                    <div class="dmmenu">
                      <ul><a href ="admin_viewDmDetails.php"><img src="img/dm.png"></a></ul></div>
                    <div class="dmmenu">
                      <ul><a href ="admin_registerdm.php"><img src="img/tracknew.png"></a></ul></div>
                    <div class="dmmenu">
                      <ul><a href ="admin_insertTracking.php"><img src="img/custtrack.png"></a></ul></div>
                </div>
               </div>
        
        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>
    </body>
</html>