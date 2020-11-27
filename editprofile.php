<?php
session_start();


require('firstimport.php');
if(isset($_SESSION['name'])){}
	else{
		header("location:login1.php");
		
	}
$tbl_name="users"; // Table name

mysqli_select_db($conn,"$db_name")or die("cannot select DB");


if(!isset($_SESSION["name"]))
header("location:login1.php");

$name=$_SESSION['name'];
$fname=$_POST['fn'];
$lname=$_POST['ln'];
$gender=$_POST['gnd1'];
$dob=$_POST['dob1'];
$mobile=$_POST['mon1'];



$sql="UPDATE $tbl_name SET f_name='$fname',l_name='$lname',gender='$gender',dob='$dob',mobile='$mobile' WHERE u_name='$name'";
$result=mysqli_query($conn,$sql);


$_SESSION['error']==4;

header('location:profile.php');

?>




