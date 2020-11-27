<?php
session_start();
require('firstimport.php');
if(isset($_SESSION['name'])){}
	else{
		// header("location:login1.php");
	}
$tbl_name="users"; // Table name

mysqli_select_db($conn,"$db_name")or die("cannot select DB");

$uname=$_POST['uname'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$pass=$_POST['psd'];
$mail=$_POST['eid'];
$gender=$_POST['gnd'];
// $marital=$_POST['mrt'];
$dob=$_POST['dob'];
$mobile=$_POST['mobile'];
$card=$_POST['card'];
$address=$_POST['address'];

$sql2="select * from $tbl_name";
$result2=mysqli_query($conn,$sql2);
$flag=0;
while($row=mysqli_fetch_array($result2)){
	if($row['u_name']==$uname){
		echo ""."matched";
		$flag=1;
		break;
	}
}
if($flag==1 || $uname=="admin"){
	echo '<script>alert("Username already exists !!")</script>'; 

	echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.location.href='signup.php?value=1';
    </SCRIPT>");
	// die("");
	echo "oh yes";
	}

else{
	$sql="INSERT INTO $tbl_name(f_name,l_name,u_name,password,email,gender,dob,mobile,card,address)
	VALUES ('$fname','$lname','$uname','$pass','$mail','$gender','$dob','$mobile','$card','$address')";
	$result=mysqli_query($conn,$sql);

	$_SESSION['name']=$uname;
	header("location:index.php");
	
}
//echo "f_name ".$f_name."... ".$l_name."... ".$email.".... ".$password.",,, ".$gender.",,,,".$marital."..... ".$dob.".... ".$mobile."....".$ques.",,,,".$ans;
?>