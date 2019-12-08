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
      <h1>Registered Delivery Man</h1>
      <hr>
  
      <table>
        <tr>
          <th>NO.</th>
          <th>NAME</th>
          <th>ID</th>
          <th>IC</th>
          <th>CONTACT NO.</th>
          <th>SHIFT IN</th>
          <th>SHIFT OUT</th>
          <th>EDIT</th>
          <th>DELETE</th>
        </tr>
        <tr>
          <?php
          require('connection.php');
          
          $query="SELECT * FROM deliveryman";
          $result=mysqli_query($conn, $query);
          $i=1;
          while ($row=mysqli_fetch_array($result)){
               $shift_id=$row['shift_id'];
               $query1="SELECT shift_in,shift_out FROM shift WHERE shift_id=$shift_id ";
               $result1=mysqli_query($conn, $query1);
               $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);?>

            <td><center><?php echo $i; ?>.</td>
            <td><center><?php echo $row['dm_name'];?></td>
            <td><center><?php echo $row['dm_id'];?></td>
            <td><center><?php echo $row['dm_ic'];?></td>
            <td><center><?php echo $row['dm_phone'];?></td>
            <td><center><?php echo $row1['shift_in'];?></td>
            <td><center><?php echo $row1['shift_out'];?></td> 
            <td><center><a href="admin_editDm.php?dm_id=<?php echo $row['dm_id'];?>">Edit</a></td>
            <td><center><a href="admin_deleteDmProcess.php?dm_id=<?php echo $row['dm_id'];?>"onclick="return confirm('Are you sure you want to Remove?');">Remove</a></td><tr>
          <?php
           $i++; }?>
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

