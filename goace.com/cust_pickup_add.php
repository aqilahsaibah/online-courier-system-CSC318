<?php
session_start();
require('connection.php');


  $query9="SELECT * FROM track";
  $result9 = mysqli_query($conn,$query9) or die('SQL error');
   while($row9 = mysqli_fetch_array($result9)):
    $track_id=$row9['track_id'];
   endwhile;

  $track_id++;
?>
<?php
// connect to the server and select database
//include("dbconnect.php");

require('connection.php');

// get value pass from admin_add.php file;
//$cust_ic = addslashes($_POST['cust_ic']);
$book_id = $_POST['book_id'];
$book_date = $_POST['book_date'];
$weight_id =$_POST['weight_id'];
$shift_id =$_POST['shift_id'];
$category_id = $_POST['category_id'];
$courier_id = $_POST['courier_id'];

if (isset($_SESSION['cust_id'])){
	$cust_id = $_SESSION['cust_id'];
}



$query1 = "INSERT INTO booking ( book_id,book_date, weight_id, shift_id, category_id, courier_id) VALUES ( '$book_id','$book_date', '$weight_id', '$shift_id', '$category_id', '$courier_id')"or die("error".mysqli_errno($conn));


if($conn->query($query1)==TRUE)
{      

	 
      $query2="INSERT INTO track (track_id,cust_id,book_id) VALUES ( '$track_id','$cust_id','$book_id')";
     

   if(mysqli_query($conn,$query2))
   {
    echo "<script type='text/javascript'>alert('Successfully added!')</script>";
		header("refresh:0; url = cust_print.php");
			exit;
    }
    else
  {
echo "<script type='text/javascript'>alert('failed to add!')</script>";
		//header("refresh:2; url = admin_add.php");
			exit;
  }	
}
 else
  {
echo "<script type='text/javascript'>alert('failed to add!')</script>";
		//header("refresh:2; url = admin_add.php");
			exit;
  }	
?>
