<!DOCTYPE html>
<?php
session_start();
require('connection.php');
if(!isset($_SESSION['admin_id'])){
	header('location:index.php');
	}

  $query1="SELECT * FROM deliveryman";
  $result1 = mysqli_query($conn,$query1) or die('SQL error');
   while($row2 = mysqli_fetch_array($result1)):
    $dm_id=$row2['dm_id'];
   endwhile;
  
  $dm_id++;
?>
<html>
    <head>
        <title>GOACE</title>
         <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="ellisha.css">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/custom.css">
 


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
                            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span></li>
                            <li class="current"><a href = "admin_home.php">HOME</a></li>
                            <li class="nav"><a href = "admin_notification.php">NOTIFICATION</a></li>
							<li class="col"><?php
							$Today = date('y:m:d',time());
							$new = date('l, F d, Y', strtotime($Today));
							echo $new;
							?></li>
                            <li class="logbtn"><a href = "logout.php">LOGOUT</a></li>
                        </div>
                        </ul>
                <h1><span class = "highlight">GO</span><span class = "highlight2">ACE</span></h1>
                    </div>
            </div>
        </header>

        <body>

    <div class="container">
      <h1>Register Delivery Man</h1>
      <hr>
      <div class="formbg">
	  <form action="admin_registerDmProcess.php" method="POST">
      <label for="email"><b>Enter Name</b></label>
      <input type="text" placeholder="Name" name="name" required>

      <input type="hidden" name="dm_id" value="<?= $dm_id ?>" >
	  
	  <label for="identityC-repeat"><b>IC</b></label>
      <input type="text" placeholder="ic" name="ic" maxlength="12" required>

      <label for="email"><b>Enter Phone Number</b></label>
      <input type="text" placeholder="Phone Number" name="contact" maxlength="11" required>
	  

    <div class="col-sm-4 form-group">
	  <label for="email"><b>Enter Working Shift</b>	  </label>
	  <br>
	  <select name="shift">
		<option value="1">08:00:00-10:00:00</option>
		<option value="2">10:01:00-12:00:00</option>
		<option value="3">12:01:00-14:00:00</option>
    <option value="4">14:01:00-17:00:00</option>
	</select>
</div>
	

	
     

      <div class="clearfix">
        <a href="admin_home.php" ><button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button></a>
        <button type="submit" class="regbtn">REGISTER</button>

      </div>
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

