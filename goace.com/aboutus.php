<?php 
session_start();
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
     <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
.fa {
  padding: 20px;
  font-size: 30px;
  width: 50px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
}

.fa:hover {
    opacity: 0.7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
      width: 30%;
    height: 80%;
        float: left;

}

.fa-twitter {
  background: #55ACEE;
  color: white;
      width: 30%;
    height: 80%;
        float: left;

}


.fa-instagram {
  background: #6d0730;
  color: white;
      width: 30%;
    height: 80%;
        float: left;

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
      <center><h1>ABOUT GOACE</h1></center>
      <br><br>
        <p><h3>GoAce is a platform where customer can track their parcel or book a courier and let the delivery man do their job. Customer can simply book a slot for the delivery man to pick up their parcel just at their doorstep. By choosing the courier we provide, customer are versatile to choose the courier they are familiar with.</h3></p>
    </div>
    <div class="container">
      <center><h1>CONTACT US</h1></center>
      <br><br>
        <div class="socimed">
        <center><a href="#" class="fa fa-facebook"></a></center>
        </div>
        <div class="socimed">
        <center><a href="#" class="fa fa-twitter"></a></center>
        </div>
        <div class="socimed">
        <center><a href="#" class="fa fa-instagram"></a></center>
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