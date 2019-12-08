<?php 
session_start();
require('connection.php');

     $query1="SELECT * FROM customer";
  $result1 = mysqli_query($conn,$query1) or die('SQL error');
   while($row2 = mysqli_fetch_array($result1)):
    $cust_id=$row2['cust_id'];
   endwhile;

  
  $cust_id++;
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

     .cancelbtn{
      width:100%;
     }
     
     .btnsubmitcol{
      width:50%;
      float:left;
      padding:10px;
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
      <center><h1>BOOK A SLOT</h1></center>
   
      <section id ="grid">
        <div class="sectopnav">
          <div class="grid_item">
              <div class="active"><h1>1. BOOK A SLOT</h1></div>
          </div>
          <div class="grid_item">
              <div  class="inactive"><h1>2. SHIPPING & COST OPTIONS</h1></div>
          </div>
          <div class="grid_item">
              <div class="inactive"><h1>3. PRINT LABELS</h1></div>
          </div>
        </div>
   
    </div>
    </div>

    <div class="container">
      <h1>Make Your Reservation</h1>
      <hr>
        <div class="formbg">
          <div class="row">
            <div class="col">
              <form action="cust_ship_add.php" method="POST">
              <label for="cust_name"><b>Enter Name</b></label>
              <input type="text" placeholder="Name" name="cust_name" required>
            </div>
          </div>
          <input type="hidden" name="cust_id" value="<?= $cust_id ?>" >
          <div class="row">
            <div class="col">
              <label for="cust_ic"><b>Enter IC</b></label>
              <input type="text" placeholder="IC" name="cust_ic" maxlength=13 required>
            </div>
            <div class="col">
              <label for="cust_phone"><b>Enter Phone Number</b></label>
              <input type="text" placeholder="Phone Number" name="cust_phone" maxlength=11 required>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-4 form-group">
              <label for="name"><b>Postal Code </b></label>
              <label for="name"><b>FROM </b></label>
              <select id="ps_id" name="ps_id" onchange="displayCity()">
                <option value="1">02600</option>
                <option value="2">01000</option>
                <option value="3">02400</option>
                <option value="4">02200</option>
                <option value="5">02100</option>
                <option value="6">02700</option>
              </select>
            </div>
          <div class="col-sm-4 form-group">
           <b>City : </b><label id="city">Arau</label>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <label for="cust_add"><b>Enter Address</b></label>
            <input type="text" placeholder="Address" name="cust_add" required>
          </div>
        </div>

      <div class="clearfix">
        <div class="btnsubmit">
          <div class="btnsubmitcol">
             <button type="reset"  class="cancelbtn">Cancel</button>
           </div>
           <div class="btnsubmitcol">
             <button type="submit" regbtn">NEXT</button>
           </div>
         </div>
      </div>
    </form>
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
        function displayCity(){
                var code = document.getElementById("ps_id").value;
                var city = document.getElementById("city");
                if(code == 1){
                  city.innerHTML = "Arau";
                }
                else if(code == 2){
                  city.innerHTML = "Kangar";
                }
                else if(code == 3){
                  city.innerHTML = "Kaki Bukit";
                }
                else if(code == 4){
                  city.innerHTML = "Kuala Perlis";
                }
                else if(code == 5){
                  city.innerHTML = "Padang Besar";
                }
                else if(code == 6)
                  city.innerHTML = "Simpang Empat";
        }
    </script>
     
     <div id="id01" class="modal">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="modal-content" action="login_process.php" method="POST">
        <div class="containerB">
        <hr>
      <h1>ADMIN LOG IN</h1>
      <hr>
      <label><b>Admin ID</b></label>
      <td align="center"><input type="text" id="txtbox" name="admin_id" placeholder="Enter Your ID" required><br></td>
      <label><b>Password</b></label>
      <td align="center"><input type="password" id="txtbox" name="admin_pw" placeholder="Enter Your Password" required><br></td>
      <div class="clearfix">
        <button type="submit" class="signupbtn">LOGIN</button>
      </div>
      </div>
      </form>
    </div>
    
     <div id="id02" class="modal"> 
      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
        <form class="modal-content" action="login_process.php" method="POST">
        <div class="container">
        <hr>
        <h1>DELIVERY MAN LOG IN</h1>
        <hr>
        <label><b>Delivery Man ID</b></label>
        <td align="center"><input type="text" id="txtbox" name="dm_id" placeholder="Enter Your ID" required><br></td>
        <label><b>Password</b></label>
        <td align="center"><input type="password" id="txtbox" name="dm_ic" placeholder="Enter Your Password" required><br></td>
        <div class="clearfix">
        <button type="submit" class="signupbtn">LOGIN</button>
        </div>
        </div>
      </form>
    </div> 

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Get the modal
var modal = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

var modal = document.getElementById('id03');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
        
      
            </div>
        </section>
        
        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>
    </body>
</html>