<!DOCTYPE html>
<?php
session_start();
require('connection.php');


  $query1="SELECT * FROM booking";
  $result1 = mysqli_query($conn,$query1) or die('SQL error');
   while($row2 = mysqli_fetch_array($result1)):
    $book_id=$row2['book_id'];
   endwhile;
  
  
  $book_id++;
?>
<html>
    <head>
        <title>GOACE</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="ellisha.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="custom.css">

<style>


.date{
  padding-top: 0.2em;
}

.form-group {
  width:48%;
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


input[type=date], select {
    width: auto;
    padding: 15px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type=text], select {
    width: auto;
    padding: 15px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

input[type=text] {
    width: auto;
    padding: 15px 20px;
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
              <div class="inactive"><h1>1. BOOK A SLOT</h1></div>
          </div>
          <div class="grid_item">
              <div  class="active"><h1>2. SHIPPING & COST OPTIONS</h1></div>
          </div>
          <div class="grid_item">
              <div class="inactive"><h1>3. PRINT LABELS</h1></div>
          </div>
        </div>
      </div>
    </div>
   

    <div class="container">
      <h1>Enter your Pickup Details</h1>
      <hr>

      <div class="formbg">
        <div class="row">  
          <div class="col-sm-4 form-group">
            <form action="cust_pickup_add.php" method="POST">
            <label for="book_date"><b>PickUp Date </b></label>
            <input type="date" name="book_date">
          </div>
             <input type="hidden" name="book_id" value="<?= $book_id ?>" >
          <div class="col-sm-4 form-group">
            <label for="shift"><b>PickUp Time </b></label>
            <select id="shift_id" name="shift_id">
              <option value="1">8:00am - 10:00am</option>
              <option value="2">10:01am - 12:00pm</option>
              <option value="3">12:01pm - 2:00pm</option>
              <option value="4">2:01pm - 5:00pm</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-4 form-group">
            <label for="courier"><b>Courier </b></label>
            <select id="courier_id" name="courier_id">
              <option value="1">Poslaju</option>
              <option value="2">Fedex</option>
              <option value="3">Skynet</option>
            </select>
          </div>
          <div class="col-sm-4 form-group">
            <label for="category"><b>Parcel Type </b></label>
            <select id="category_id" name="category_id">
              <option value="1">Fragile</option>
              <option value="2">Non-Fragile</option>
            </select>
          </div>
        </div>

      
        <div class="row">
          <div class="col-sm-4 form-group">
            <label for="weight"><b>Parcel Weight (kg) </b></label>
            <select id="weight_id" name="weight_id" onchange="displayCharges()">
              <option value="1">0.0kg - 0.5kg</option>
              <option value="2">0.51kg - 1.0kg</option>
              <option value="3">1.1kg - 2.0kg</option>
              <option value="4">2.1kg - 3.0kg</option>
            </select>
          </div>
        </div>

        <div class="row">
          <br><br><br>
          <div class="col">
            <b>Courier Charges : RM </b><label id="charges">4.00</label>
            <input type="hidden" placeholder="charges" name="charges" required>
          </div>
          <br>
           <div class="col">
            <b>Delivery Charges : RM </b><label>3.00</label>
            <input type="hidden" placeholder="" name="" required>
          </div>
          <br>
          <div class="col">
            <b>Total Payment : RM </b><label id="totalpay">7.00</label>
            <input type="hidden" placeholder="totalpay" name="totalpay" required>
          </div>
        </div>

      <div class="clearfix">
        <button type="reset"  class="cancelbtn">Cancel</button>
        <button type="submit" class="regbtn">NEXT</button>
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
        function displayCharges(){
                var cod= document.getElementById("weight_id").value;
                var charges = document.getElementById("charges");
                var rate = 3.00;
                var totalpay=document.getElementById("totalpay");

             
                if(cod == 1){
                  charges.innerHTML = "4.00";
                }
                else if(cod == 2){
                  charges.innerHTML = "8.00";
                }
                else if(cod == 3){
                  charges.innerHTML = "12.00";
                  
                }
                else if(cod == 4){
                  charges.innerHTML = "20.00";
                  
                }

                if(cod == 1){
                  totalpay.innerHTML = "7.00";
                }
                else if(cod == 2){
                  totalpay.innerHTML = "11.00";
                }
                else if(cod == 3){
                  totalpay.innerHTML = "15.00";
                  
                }
                else if(cod == 4){
                  totalpay.innerHTML = "23.00";
                  
                }
        }

           

    </script>

        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>
  </body>
</html>