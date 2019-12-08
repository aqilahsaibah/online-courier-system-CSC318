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
        <input type="text" name="query" style="border:1px solid #CCC; color: #333; width:210px; height:30px;" placeholder="Search customer's IC..." /><input type="submit" id="btnsearch" value="Search" name="search" style="width:80px; height:30px; color:#FFF; background:#4B0082; border:1px solid #4B0082; border-radius:3px;">
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
          <th>BOOKING ID</th>
          <th>TRACKING ID</th>
          <th>TRACKING NUMBER</th>
          <th>EDIT</th>
        </tr>
        <tr>
          <?php
          require('connection.php');
          
            /*$query22="SELECT * FROM track WHERE track_id != null";
               $result22=mysqli_query($conn, $query22);
               $row22=mysqli_fetch_array($result22,MYSQLI_ASSOC);
               $cust_id=$row22['cust_id'];*/


          $query="SELECT * FROM customer ";
          $result=mysqli_query($conn, $query);

          $i=1;
          if($result->num_rows > 0){
          while ($row=mysqli_fetch_array($result)){
               $cust_id=$row['cust_id'];
               $query1="SELECT * FROM track WHERE cust_id='$cust_id'";
               $result1=mysqli_query($conn, $query1);
               $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
               $track_id=$row1['track_id'];
               $book_id=$row1['book_id'];
    
               $query2="SELECT track_num FROM track WHERE track_id='$track_id'";
               $result2=mysqli_query($conn, $query2);
               $row2=mysqli_fetch_array($result2,MYSQLI_ASSOC);

               ?>
            <tr>
            <td><center><?php echo $i;?>.</td>
            <td><center><?php echo $row['cust_name'];?></td>
            <td><center><?php echo $row['cust_ic'];?></td>
            <td><center><?php echo $row['cust_phone'];?></td>
            <td><center><?php echo $row['cust_add'];?></td>
            <td><center>
             <?php  
                  $query3="SELECT * from booking where book_id=$book_id";
                  $result3 = $conn->query($query3);
                 
                  if($result3->num_rows > 0) {
                       $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
                     
                       
                       

                       ?>
                          <center><a href="admin_notification2.php?book_id=<?php echo $row3['book_id'];?>&book_id=<?php echo $book_id;?>"><?php echo $row3['book_id'];?></a>
                          
                       <?php
                  }
                  else{
                    
                      $query2="SELECT dm_id FROM deliveryman where shift_id=$shift_id";
                      $result2=mysqli_query($conn, $query2);

                      while ($row2=mysqli_fetch_array($result2)){?>
                      <center><a href="admin_dmdetails.php?admin_id=<?php getid();?>&dm_id=<?php echo $row2['dm_id'];?>&book_id=<?php echo $book_id;?>"><input type="button" value="<?php echo $row2['dm_id'];?>" style="width:60px; height:20px; color:#FFF; background:#696969; border:1px solid #696969; border-radius:3px;"></a><br>

                 <?php }?> <td></td> <?php }?>

                  
            </td> 
            <td><center><?php echo $row1['track_id'];?></td> 
            <?php if(($row2['track_num'])==null) {?> 
            <td><center><a href="admin_insertTrackingProcess.php?cust_id=<?php echo $row['cust_id'];?>">add</a></td>
              <td> </td>
            <?php } else { ?>

            <td><center><?php echo $row2['track_num'];?></td></center>
            <td><center><a href="admin_editTracking.php?cust_id=<?php echo $row['cust_id'];?>">Edit</a></td></tr>

            <?php } ?>  
          <?php
            $i++;}
          }else
          {?>

                            <td colspan=10><?php echo "<center>No records</center>";?></td>
                            <?php
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

