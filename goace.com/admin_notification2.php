<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:index.php');
    }

    function getid()
    {
        echo $_SESSION['admin_id']; //fetch admin id kat login process macam deliverymanhome.php tapi ni guna function
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
<br><br>
<center>
      <h1>LIST OF BOOKING</h1>
         <td width="741" align="right">
        <center>
        <form action="admin_searchTrackingbook.php" method="get" ecntype="multipart/data-form">
        <input type="text" name="query" style="border:1px solid #CCC; color: #333; width:210px; height:30px;" placeholder="Search customer's booking id..." /><input type="submit" id="btnsearch" value="Search" name="search" style="width:80px; height:30px; color:#FFF; background:#4B0082; border:1px solid #4B0082; border-radius:3px;">
        </form>
        </center>
        </td>
      <hr>
<table style="width:90%">
        <tr>
          <th>NO.</th>
          <th>BOOKING ID</th>
          <th>PRICE</th>
          <th>BOOKING DATE/TIME</th>
          <th>COURIER</th>
          <th>MIN WEIGHT</th>
          <th>MAX WEIGHT</th>
          <th>CATEGORY</th>
          <th>DELIVERY MAN</th>
          <th>STATUS</th><!--read/unread-->
          <th>PICK STATUS</th><!--read/unread-->
          <th>DELIVER STATUS</th><!--read/unread-->

        </tr>
        <tr>
          <?php
          require('connection.php');
          
           if (isset($_GET['book_id']))
            $book_id = $_GET['book_id'];
        else
            $book_id = 0;
          
          $query="SELECT * FROM booking where book_id=$book_id;";
          $result=mysqli_query($conn, $query);

          $i=1;
          if($result->num_rows > 0){
          while ($row=mysqli_fetch_array($result)){
               $courier_id=$row['courier_id'];
               $weight_id=$row['weight_id'];
               $category_id=$row['category_id'];
               $shift_id=$row['shift_id'];
               $book_id=$row['book_id'];

               $query1="SELECT c.courier_name,w.min_value,w.max_value,cat.category_name FROM courier c,weight w,category cat WHERE c.courier_id=$courier_id AND w.weight_id=$weight_id AND cat.category_id=$category_id";

               $result1=mysqli_query($conn, $query1);
               $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
               ?>
            <tr>
            <td><center><?php echo $i;?>.</td>
            <td><center><?php echo $row['book_id'];?></td>
            <td><center>RM <?php  $bookPrice = sprintf('%0.2f', $row['book_price']); echo $bookPrice;?></td>
            <td><center><?php echo $row['book_date'];?></td>
            <td><center><?php echo $row1['courier_name'];?></td>
            <td><center><?php $minWeight = sprintf('%0.2f', $row1['min_value']); echo $minWeight;?> kg</td>
            <td><center><?php $maxWeight = sprintf('%0.2f', $row1['max_value']); echo $maxWeight;?> kg</td>
            <td><center><?php echo $row1['category_name'];?></td>
            <td><center>
             <?php  
                  $query3="SELECT * from notification where book_id=$book_id";
                  $result3 = $conn->query($query3);
                 
                  if($result3->num_rows > 0) {
                       $row3=mysqli_fetch_array($result3,MYSQLI_ASSOC);
                       $status_id=$row3['status_id'];
                       
                       $query4="SELECT status_msg from status where status_id=$status_id";
                       $result4=mysqli_query($conn, $query4);
                       $row4=mysqli_fetch_array($result4,MYSQLI_ASSOC);

                       ?>
                          <center><a href="admin_dmdetails2.php?dm_id=<?php echo $row3['dm_id'];?>&book_id=<?php echo $book_id;?>"><?php echo $row3['dm_id'];?></a>
                          <td><center><?php echo $row4['status_msg'];?></td> 
                       <?php
                  }
                  else{
                    
                      $query2="SELECT dm_id FROM deliveryman where shift_id=$shift_id";
                      $result2=mysqli_query($conn, $query2);

                      while ($row2=mysqli_fetch_array($result2)){?>
                      <center><a href="admin_dmdetails.php?admin_id=<?php getid();?>&dm_id=<?php echo $row2['dm_id'];?>&book_id=<?php echo $book_id;?>"><input type="button" value="<?php echo $row2['dm_id'];?>" style="width:60px; height:20px; color:#FFF; background:#696969; border:1px solid #696969; border-radius:3px;"></a><br>

                 <?php }?> <td></td> <?php }?>

                  
            </td> 
              <td><center>
             <?php  
                  $query5="SELECT * from track where book_id=$book_id";
                  $result5 = $conn->query($query5);
                 
                  if($result5->num_rows > 0) {
                       $row5=mysqli_fetch_array($result5,MYSQLI_ASSOC);
                       $pick_id=$row5['pick_id'];
                       $deliver_id=$row5['deliver_id'];

                       if($pick_id==1){?>
                            <center>picked</a>
                      <?php
                        }else {
                         ?>
                          <center>pending</a>
                      <?php
                       }if($deliver_id==1){?>
                           <td><center>delivered</td> 
                      <?php
                        }else if($deliver_id==0) {?>
                          <td><center>pending</td> 
                       
                       
                      
                       <?php }
                  }
                  else{
                    
                      $query2="SELECT dm_id FROM deliveryman where shift_id=$shift_id";
                      $result2=mysqli_query($conn, $query2);

                      while ($row2=mysqli_fetch_array($result2)){?>
                      <center><a href="admin_dmdetails.php?admin_id=<?php getid();?>&dm_id=<?php echo $row2['dm_id'];?>&book_id=<?php echo $book_id;?>"><input type="button" value="<?php echo $row2['dm_id'];?>" style="width:60px; height:20px; color:#FFF; background:#696969; border:1px solid #696969; border-radius:3px;"></a><br>

                 <?php }?> <td></td> <?php }?>

                  
            </td>   
         
             
             <?php
            $i++;
          }
        }
        else{?>

             <td colspan=10><?php echo "<center>No records</center>";?></td>
                            <?php
                        }
          ?>
       </tr>

      </table></center>
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