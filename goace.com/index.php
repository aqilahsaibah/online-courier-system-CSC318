<!DOCTYPE html>
<html>
<?php
include 'connection.php';
session_start();
if(isset($_POST['username'])){
	header('localhost:admin_home.php');
	}
	if(isset($_POST['username1'])){
	header('localhost:deliverymanhome.php');
	}

?>
    <head>
        <title>GOACE</title>
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="css/custom.css">
        <link rel="stylesheet" href="ellisha.css">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="custom.css">
    </head>
    
        <header>
            <div class="container">
                <div id="main">
                    <div id="brandig">
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <a href="aboutus.php">About Us</a>
                            <a href="aboutus.php">Contact Us</a>
                            <a href="cust_trackntrace.php">Courier Track & Trace</a>
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
			</div>
        </header>

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
        
        <section id="boxes">
            <div align="center" class="container" >
			<img src="courier.jpg" width="900" height="600">
              
            </div>
        </section>
        
        <footer>
            <p>GO ACE, Copyright &copy; 2018</p>
        </footer>
    </body>
</html>