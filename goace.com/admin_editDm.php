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
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="ellisha.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/custom.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
        <style>

.form-group {
  width:30%;
  display: inline-block;
}
.formbg {
  padding-top: 1em;
  padding-bottom: 1em;
  background-color:  #f0f5f5;
  border:5px solid  #008080;
  padding-right: 1em;
  padding-left: 1em;
}

input[type=text], select {
    padding: 15px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type=text] {
    width: 100%;
    padding: 20px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    background-color: white;
    font-size: 16px;
}
.col-sm-4 form-group{
  display: inline-block;
  padding-right: 20%;
}
</style>
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

if (isset($_GET['dm_id']))
            $dm_id = $_GET['dm_id'];
        else
            $dm_id = 0;

$view = "SELECT * from deliveryman where dm_id = '$dm_id'";

$result = $conn->query($view);
$row = $result->fetch_assoc();

if(isset($_POST['update'])&& isset($_POST['dm_id'])){

    $dm_id = addslashes($_POST['dm_id']);
    $dm_name = addslashes($_POST['dm_name']);
    $dm_ic = addslashes($_POST['dm_ic']);
    $dm_phone = addslashes($_POST['dm_phone']);
    $shift_id = addslashes($_POST['shift_id']);

    $insert = "UPDATE deliveryman set dm_id = '$dm_id', dm_name = '$dm_name', dm_ic = '$dm_ic', dm_phone = '$dm_phone', shift_id = '$shift_id' WHERE dm_id=$dm_id";
    
    if($conn->query($insert)== TRUE){?>

           <script type="text/javascript">
            alert("Succesfully update data");
            window.location.href = "admin_viewDmDetails.php";
            </script>  <?php         
    }else{?>

       <script type="text/javascript">
            alert("Oops cannot add data");
            window.location.href = "admin_viewDmDetails.php";
            </script><?php
    }
    
    $conn->close();
}

?>
   
    <br>
    
    <form action="" method="POST">
        <center>
       <table  border=1 style="width:80%" align="center">
    
    <tr>
    <td align="right">ID:</td>
    <td><input  type="hidden" id="txtbox" name="dm_id" value="<?php echo $_GET['dm_id'];?>" required><?php echo $dm_id;?></td>
    </tr>
    
    <tr>
    <td align="right">Name:</td>
    <td><input type="text" id="txtbox" name="dm_name" placeholder="Contactperson" value="<?php echo $row['dm_name'];?>" style="width:90%; " required><br></td>
    </tr>
    
    <tr>
    <td align="right">Ic:</td>
    <td><input type="text" id="txtbox" name="dm_ic" placeholder="Address" value="<?php echo $row['dm_ic'];?>" required><br></td>
    </tr>
    
    <tr>
    <td align="right">Phone Number:</td>
    <td><input type="text" id="txtbox" name="dm_phone" maxlength="11" placeholder="Phone Number" value="<?php echo $row['dm_phone'];?>" required><br></td>
    </tr>
    
    <tr>
    <td align="right">Shift:</td>
    <td>
        <select class="inputbox" name="shift_id" >
            <option value="1"<?php if($row['shift_id']==1) echo 'selected'?>>08:00:00-10:00:00</option>   
            <option value="2"<?php if($row['shift_id']==2) echo 'selected'?>>10:01:00-12:00:00</option>
            <option value="3"<?php if($row['shift_id']==3) echo 'selected'?>>12:01:00-14:00:00</option>
            <option value="4"<?php if($row['shift_id']==4) echo 'selected'?>>14:01:00-17:00:00</option>
        </select>
    </td>
    </tr>    
    <br>
    <tr align="center">
    <td>&nbsp;  </td>
    <td>
    <br>
    <input type="SUBMIT" name="update" id="btnnav" value="Update"></form>
    <a href="admin_viewDmDetails.php"><input type="button" style="border:1px solid #900; background:#900; height:40px; width:105px; border-radius:3px; color:#FFF;" value="Cancel"></a>
    
    </td>
    </tr>
    
    </table>
</form>
</div>

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
