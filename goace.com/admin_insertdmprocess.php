<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header('location:index.php');
    }
?>
<html>
<link rel="stylesheet" type="text/css" href="css/css1.css">
<script>
    function toggle_visibility(id){
        var e = document.getElementById(id);
        if(e.style.display=='block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
        }
</script>
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



<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
      

<?php
    include 'connection.php';
    if (isset($_GET['cust_id']))
            $custId = $_GET['cust_id'];
        else
            $custId = 0;

        $view = "SELECT * from track where cust_id = '$custId'";

        $result = $conn->query($view);
        $row = $result->fetch_assoc();
        $trackId=$row['track_id'];


       $view1 = "SELECT * from customer where cust_id = '$custId'";

       $result1 = $conn->query($view1);
       $row1 = $result1->fetch_assoc();


    if(isset($_POST['Insert']))
    {
            
       $dm_id =addslashes($_POST['dm_id']);

       $sql2="UPDATE track set dm_id=$dm_id WHERE track_id = $trackId";
       
        if($conn->query($sql2)== TRUE){?>

           <script type="text/javascript">
            alert("Succesfully update data");
            window.location.href = "admin_insertTracking.php";
            </script>  <?php         
        }else{?>

       <script type="text/javascript">
            alert("Oops cannot add data");
            window.location.href = "admin_insertTracking.php";
            </script><?php
    }
    
    $conn->close();
}
 ?>
        <body>
            <div class="container">
      <h1>CUSTOMER'S TRACKING NUMBER</h1>
     
      
<br>
    <form action="admin_insertdmprocess.php?cust_id=<?php echo $custId;?>" method="POST">
    <table style="width:80%" align="center">
    
     <tr>
    <td align="right">Name:</td>
    <td><input type="hidden" id="txtbox" name="cust_name" value="<?php echo $row1['cust_name'];?>" required><?php echo $row1['cust_name'];?></td>
    </tr>
    
    <tr>
    <td align="right">Ic:</td>
    <td><input type="hidden" id="txtbox" name="cust_ic" value="<?php echo $row1['cust_ic'];?>" required><?php echo $row1['cust_ic'];?></td>
    </tr>
    
    <tr>
    <td align="right">Contact No:</td>
    <td><input type="hidden" id="txtbox" name="cust_phone" value="<?php echo $row1['cust_phone'];?>" required><?php echo $row1['cust_phone'];?></td>
    </tr>

     <tr>
    <td align="right">Address:</td>
    <td><input type="hidden" id="txtbox" name="cust_add" value="<?php echo $row1['cust_add'];?>" required><?php echo $row1['cust_add'];?></td>
    </tr>

     <tr>
    <td align="right">Tracking Id:</td>
    <td><input type="hidden" id="txtbox" name="track_id" value="<?php echo $row['track_id'];?>" required><?php echo $row['track_id'];?></td>
    </tr>

    <tr>
    <td align="right">Deliveryman Id:</td>
    <td><input type="text" id="txtbox" name="dm_id" value="" required></td>
    </tr>

    <tr>
    <td align="right">Tracking Number:</td>
    <td><input type="hidden" id="txtbox" name="track_no" value="<?php echo $row['track_no'];?>" required><?php echo $row['track_id'];?></td>
    </tr>
    
    
    <br>
    <tr align="center">
    <td>&nbsp;  </td>
    <td>
    <br>
    <input type="SUBMIT" name="Insert" id="btnnav" value="Insert"></form>
    <a href="admin_insertTracking.php"><input type="button" style="border:1px solid #900; background:#900; height:40px; width:105px; border-radius:3px; color:#FFF;" value="Cancel"></a>
    
    </td>
    </tr>
    
    </table>
</form>
 

</div>
</div>
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
