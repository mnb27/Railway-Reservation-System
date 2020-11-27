<?php  	
session_start();
require('firstimport.php');

mysqli_select_db($conn,"$db_name") or die("cannot select db");

$trainName = $_POST['trainname'];
$trainNum = $_POST['trainno'];
$srcc = $_POST['src'];
$destt = $_POST['dest'];
$arri = $_POST['arr'];
$deptt = $_POST['dept'];
$ac_ch = $_POST['ac'];
$sl_ch = $_POST['sl'];
$dojj = $_POST['doj'];

$routee = $_POST['route'];


if(isset($trainName) && isset($trainNum) && isset($srcc) && isset($destt) && isset($arri) && isset($deptt) && isset($ac_ch) && isset($sl_ch))
{	
	// $quota=$_POST['quota'];
	$trainName=strtoupper($trainName);
	$ac_seats = $ac_ch*18;
	$sl_seats = $sl_ch*24;

	$srcc=strtoupper($srcc);
	$destt=strtoupper($destt);
	$routee=strtoupper($routee);
	
	// $day=date("D",strtotime("".$dojj));

	$tbl_name="seats_availability";
	$sql="INSERT INTO $tbl_name
		VALUES ('$trainNum','$trainName','$dojj','$ac_ch','$sl_ch','$ac_seats','$sl_seats')";
	$result=$conn->query($sql);

	$tbl_name2="train_list";
	$sql2="INSERT INTO $tbl_name2
		VALUES ('$trainNum','$trainName','$srcc','$destt','$arri','$deptt',2500,1000)";
	$result2=$conn->query($sql2);

	$tbl_name3="interlist";
	$sql3="INSERT INTO $tbl_name3
		VALUES ('$trainNum','$trainName','$dojj','$routee')";
	$result3=$conn->query($sql3);
}

    echo '<script type="text/javascript">'; 
	echo 'alert("Train added successfully!!");'; 
	echo 'window.location.href = "addTrain.php";';
	echo '</script>';

?>