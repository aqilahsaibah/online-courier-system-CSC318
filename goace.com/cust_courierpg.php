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

     .courier-row{
    float: left;
    width: 33.33%;
    padding: 10px;
    height: 300px;
     }

     .courier-row img{
    width: 100%;
    height: 80%;
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
      <center><h1>GOACE COURIER SERVICE</h1></center>
      <br>
      <center><h2>Choose the courier you chose, to track your tracking number</h2></center>
      <br><br>
      <div class="courier-pg">
        <div class="courier-row">
          <ul><a href="https://www.poslaju.com.my/track-trace-v2/"><img src="img/poslajunew.png"></a></ul></div>
        <div class="courier-row">
          <ul><a href="https://www.fedex.com/en-in/tracking.html"><img src="img/fedexnew.png"></a></ul></div>
        <div class="courier-row">
          <ul><a href="https://www.tracking.my/skynet"><img src="img/skynetnew.png"></a></ul>
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