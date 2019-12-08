<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:index.php');
    }
?>
<html>
    <head>
        <title>GOACE</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/custom.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    </head>
        <header>
            <div class="container">
                <div id="main">
                    <div id="brandig">
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <th scope="col">Hello Admin !<p>
                            <?php echo $_SESSION['admin_name'];?></p></th>
                            <a href="admin_viewDmDetails.php">Delivery Man Schedule</a>
                            <a href="admin_insertTracking.php">Customer's Tracking Number</a>
                            <a href="admin_registerdm.php">Register Delivery Man</a>
                            <a href="admin_reporting.php">Reporting</a>
                        </div>
                        <ul>
                        <div class="topnav">
                            <li class="sidemenubtn">
                            <a href="#"><span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></a></li>
                            <li class="current"><a href = "admin_home.php">HOME</a></li>
                            <li class="nav"><a href = "admin_notification.php">NOTIFICATION</a></li>
                            <li class="logbtn"><a href = "logout.php">LOGOUT</a></li>
                        </div>
                        </ul>
                <h1><span class = "highlight">GO</span><span class = "highlight2">ACE</span></h1>
                    </div>
            </div>
        </header>

        <body>
        	<div class="container">
      <h1>CUSTOMER'S TRACKING NUMBER</h1>
      <td width="741" align="right">
        <center>
        <form action="admin_searchTracking.php" method="get" ecntype="multipart/data-form">
        <input type="text" name="query" style="border:1px solid #CCC; color: #333; width:210px; height:30px;" placeholder="Search customer's IC..." /><input type="submit" id="btnsearch" value="Search" name="search" style="width:100px; height:30px; color:#FFF; background:#4B0082; border:1px solid #4B0082; border-radius:3px;">
        </form>
        </center>
        </td>
      <hr>
    
      <table>
        <tr>
          <th>NO.</th>
          <th>NAME</th>
          <th>IC</th>
          <th>CONTACT NO.</th>
          <th>ADDRESS</th>
          <th>TRACKING ID</th>
          <th>TRACKING NUMBER</th>
           <th>EDIT</th>
        </tr>
        <tr>
<?php
	include 'connection.php';
					
	if(isset($_GET['search'])){
         $i=1;
	$query = $_GET['query'];

	$sql = "select * from customer where cust_ic like '%".$query."%' ";
   
	$result = $conn->query($sql);
	
	if($result->num_rows > 0){
	
	while($row1=mysqli_fetch_array($result)){
	$cust_id=$row1['cust_id'];
  
    
    $query1="SELECT * FROM track WHERE cust_id='$cust_id' ";
    $result1=mysqli_query($conn, $query1);
    $row=mysqli_fetch_array($result1,MYSQLI_ASSOC);
    $trackId=$row['track_id'];

    $query2="SELECT * FROM track WHERE track_id=$trackId";
    $result2=mysqli_query($conn, $query2);
    $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);


    ?>

   

    <td><center><?php echo $i;?>.</td>
	<td><center><?php echo $row1['cust_name'];?></td>
    <td><center><?php echo $row1['cust_ic'];?></td>
	<td><center><?php echo $row1['cust_phone'];?></td>
    <td><center><?php echo $row1['cust_add'];?></td>
    <td><center><?php echo $row['track_id'];?></td> 

    <?php if($row2['track_num']==null){?>
    <td><center><a href="admin_insertTrackingProcess.php?track_id=<?php echo $row['track_id'];?>">add</a></td>
        <td> </td>
    <?php }
         else{?>
            <td><center><?php echo $row2['track_num'];?></td> 
            <td><center><a href="admin_editTracking.php?track_id=<?php echo $row['track_id'];?>">Edit</a></td></tr>
      <?php } ?>
<tr>
    
 <?php
					$i++;
							}

						}else{?>
							<td colspan=8><?php echo "<center>No records</center>";?></td>
                            <?php
						}
                        $conn->close();
					}
					
				?>
        
				   </tr>
      </table>
</div>
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
