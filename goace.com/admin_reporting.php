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


<body>
<center>
<h1>CUSTOMER'S FREQUENT DELIVERY HOURS</h1>
<?php 

     require('connection.php');

     $count1=0;
     $count2=0;
     $count3=0;
     $count4=0;

     $sql="select * from booking";
     $result=mysqli_query($conn, $sql);

     

      while ($row=mysqli_fetch_array($result)){

        $shift_id=$row["shift_id"];
  
     /*$sql2="select * from track where track_id='$track_id'";
     $result1=mysqli_query($conn,$sql2);
     $row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
     $track_timein=$row1["track_timein"];
     $track_timeout=$row1["track_timeout"];*/

     if($shift_id==1)
     {
       $count1++;
     }
     else if($shift_id==2)
     {
       $count2++;
     }
     else if($shift_id==3)
     {
       $count3++;
     }
    else if($shift_id==4)
     {
       $count4++;
     }
   }

?>
<div id="piechart"></div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Shift', 'customer'],
  ['8.00-10.00', <?php echo $count1;?>],
  ['10.01-12.00', <?php echo $count2;?>],
  ['12.01-14.00', <?php echo $count3;?>],
  ['14.01-17.00', <?php echo $count3;?>],
  
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'Average customers time choice', 'width':1050, 'height':600};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>
</center>
</body>
</html>


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
