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
        .searchtf input[type=varchar] {
    float:absolute;
    padding: 6px;
    border: 1px solid #ddd;
    border-radius: 3px;
    margin-top: 8px;
    width: 50%;
    margin-right: 16px;
    font-size: 17px;
}

.tfbutton {
    border: none;
    padding: 6px 20px;
    text-align: center;
    text-decoration: bold;
    font-family: Calibri;
    border-radius: 3px;
    font-size: 17px;
    margin: 4px 2px;
    -webkit-transition:background-color .5s;
}
table {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    border-spacing: 0;
    width: 70%;
    margin: auto;
    border: 1px solid #ddd;
}
th, td {
    text-align: left;
    padding: 6px;
}

tr:nth-child(even){background-color: #f2f2f2}

 .bback {
    text-align: center;
    display: inline-block;
    font-family: Calibri;
    font-size: 14px;
    margin-left: 50%;
    cursor: pointer;
    border-radius: 8px;
    -webkit-transition:background-color .5s

}
    </style>
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
        <BR><BR><BR>
            <div class = "container">
                <div class = "back">
        <div class="table">
            <table class="table table-bordered">
                <div align="center">
                <div style="overflow-x:auto;">
                <h1 align="center">Enter your IC number to get your tracking number</h1>
                    <div class="searchtf">
                        <form action="cust_trackntrace.php" target="_self" method="post"> 
                            <center><input type = "varchar" placeholder="Your IC number" onkeyup="myFunction()" name="cust_ic">
                            <input type="submit" class="tfbutton  w3-hover-red btn-lg" value="Search"></i></center>
                            <div class="search-container" >
                            </div>
                        </form>
                    </div>

<?php
include ('connection.php');
 mysqli_select_db($conn,'goace');

  if(!empty($_POST['cust_ic']))
{
    $s = mysqli_real_escape_string($conn, $_REQUEST['cust_ic']);

    $sql = "SELECT t.track_id, t.track_num, b.book_id, co.courier_name 
            FROM track t, courier co, booking b ,customer
            WHERE t.book_id=b.book_id and b.courier_id=co.courier_id and t.cust_id=customer.cust_id and customer.cust_ic LIKE '%".$s."%'";

    $sql2 = "SELECT cust_name, cust_add, cust_ic, cust_id FROM customer WHERE cust_ic LIKE '%".$s."%'";

    $r_query = mysqli_query($conn, $sql);

    $r_query1 = mysqli_query($conn, $sql2);

    $row1 = mysqli_fetch_array($r_query1); 

    $row = mysqli_fetch_array($r_query, MYSQLI_ASSOC); 


    echo "<br><h1>TRACKING INFORMATION</h1>";?>


            <div>
            <tr bgcolor="#ccc">
                <th width="158" scope="row"><div>CUSTOMER NAME </div></th>
                <td>&nbsp; <?php echo $row1['cust_name']; ?></td>
            </tr>
            <tr bgcolor="#ccc">
                <th scope="row"><div>ADDRESS </div></th>
                <td>&nbsp; <?php echo $row1['cust_add']; ?></td>
            </tr>
            <tr bgcolor="#ccc">
                <th width="158" scope="row"><div>IC </div></th>
                <td>&nbsp; <?php echo $row1['cust_ic']; ?></td>
            </tr>
            <tr bgcolor="#ccc">
                <th width="158" scope="row"><div>CUSTOMER ID </div></th>
                <td>&nbsp; <?php echo $row1['cust_id']; ?></td>
            </tr>
        
                <div class="table">
                <table class="table table-bordered">
                <div align="center">
                <div style="overflow-x:auto;">

        
    <TABLE border="2" cellpadding="2" cellspacing="2" width="50%">
    <tr>
              <TH width="130"><center>Book ID</center></TH>
              <TH><center>Tracking Number</center></TH>
              <TH width="100"><center>Courier Name</center></TH>
        
     </tr>
    <tr><br><br><br>
<h3><center>Thank you for choosing <?php echo $row['courier_name'];?></h3></center>
        <br><br>
        <h1><center>HERE'S YOUR TRACKING NUMBER<br><br><?php echo $row['track_num'];?></center></h1>
        <?php $bil=1;?>
     
                <td><center><?php echo $row['book_id'];?></center></td>
                <td><center><?php if($row['track_num']==null)
                                    {?>
                                        PENDING <?php
                                    }
                                    else
                                        echo $row['track_num'];?></center></td>
                <td><center><?php echo $row['courier_name'];?></center></td>

    </tr>
    <center><h4>Open this <a href="cust_courierpg.php">link</a> to track your tracking number based on the courier you chose</h4></center><br><br><br>
    <tr>
       
      <?php
           
           echo "</table>";?>
           <br><br><center><button class = "w3-large w3-teal w3-hover-gray w3-button" style="border-radius: 5px; -webkit-transition:background-color .5s" value="Print page" onClick="window.print()">Print Page&emsp;<i class="fa fa-print"></i></button><br></center>

<?php        
}
?>

    </tr>
  </table>

</BR></BR></div></div></table></div></BR></div></div></BR></BR></BR>
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
</body></html>



    
            



