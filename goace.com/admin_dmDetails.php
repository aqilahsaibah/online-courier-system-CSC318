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
      <h1>Delivery Man Details</h1>
      <hr>
  
      <table style="width:100%">
        <tr>
         
          <th>NAME</th>
          <th>ID</th>
          <th>IC</th>
          <th>CONTACT NO.</th>
          <th>SHIFT IN</th>
          <th>SHIFT OUT</th>
          <th>ASSIGN</th>
        </tr>
        <tr>
          <?php
          require('connection.php');
          
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
          
          $query="SELECT * FROM deliveryman where dm_id=$dm_id";
          $result=mysqli_query($conn, $query);
          $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        
          $shift_id=$row['shift_id'];
          $query1="SELECT shift_in,shift_out FROM shift WHERE shift_id=$shift_id ";
          $result1=mysqli_query($conn, $query1);
          $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);?>

            
            <td><center><?php echo $row['dm_name'];?></td>
            <td><center><?php echo $row['dm_id'];?></td>
            <td><center><?php echo $row['dm_ic'];?></td>
            <td><center><?php echo $row['dm_phone'];?></td>
            <td><center><?php echo $row1['shift_in'];?></td>
            <td><center><?php echo $row1['shift_out'];?></td> 
            <td><center><a href="admin_assignDm.php?admin_id=<?php getid();?>&dm_id=<?php echo $row['dm_id'];?>&book_id=<?php echo $book_id;?>"><input type="button" value="ASSIGN" style="width:100px; height:30px; color:#FFF; background:#069; border:1px solid #069; border-radius:3px;"></a></center></td>
         
         
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

