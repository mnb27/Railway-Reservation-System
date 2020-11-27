<?php

session_start();
require('firstimport.php');
if(isset($_SESSION['name'])){}
	else{
		header("location:login1.php");
		
	}
$tbl_name="booking";

mysqli_select_db($conn,"$db_name") or die("cannot select db");


$uname=$_SESSION['name'];
$num=$_GET['tno'];
$seat= $_GET['selct']; // AC SL
$name=$_GET['name1'];
$age=$_GET['age1'];
$sex=$_GET['sex1'];
$fromstn=$_GET[	'fromstn'];
$tostn=$_GET['tostn'];
$doj=$_GET['doj'];
$dob=$_GET['dob'];
echo "..".$num."..".$name."..".$age."..".$sex."..".$seat."..";

$str = "_cnt";
$class_select = $seat.$str;
// echo $class_select;


// $sql1="SELECT ".$seat." from seats_availability where Train_No='".$num."' and doj='".$doj."'";
$sql1="SELECT ".$class_select." from seats_availability where Train_No='".$num."' and doj='".$doj."'";
$result1=$conn->query($sql1);
while($row1=mysqli_fetch_array($result1)){
		$value=$row1["".$class_select];
}


$sql99="SELECT ".$seat." from seats_availability where Train_No='".$num."' and doj='".$doj."'";
$result99=$conn->query($sql99);
while($row99=mysqli_fetch_array($result99)){
		$coach_cnt=$row99["".$seat];
}

//echo "</br>".$value."</br>".$seat."</br>";

$AC_sitting = array("LB","LB","UB","UB","SL","SU");
$SL_sitting = array("LB","MB","UB","LB","MB","UB","SL","SU");

if($seat=="AC") {

	$seat_no = $coach_cnt*18 - $value + 1;
    $coach_no = ceil($seat_no/18);

    if($seat_no%18==0){
        $seat_no = 18;
    }
    else {
        $seat_no=$seat_no%18;
    }

    $seat_type = $AC_sitting[($seat_no-1)%6];

}

else if($seat=="SL") {

	$seat_no = $coach_cnt*24 - $value + 1;
    $coach_no = ceil($seat_no/24);

    if($seat_no%24==0){
        $seat_no = 24;
    }
    else {
        $seat_no=$seat_no%24;
    }

    $seat_type = $SL_sitting[($seat_no-1)%8];
}

// echo "$value</br>";
// echo "$coach_cnt</br>";
// echo "$coach_no</br>";
// echo "$seat_no</br>";
// echo "$seat_type</br>";

$ticket_status = $coach_no."-".$seat_no." ".$seat_type;
// echo $ticket_status;

$pnr='';

if($value>0){

	$datee = date("Y/m/d");
	$spl = (explode("/",$datee));

	$t=time();

	for($i=0;$i<count($spl);$i++){
	    $pnr .= "$spl[$i]";
	}
	$pnr=$pnr.$t;
	// echo $pnr;
}

echo $pnr;

$passengers = 0;

if(isset($_GET['name1']) && isset($_GET['age1']) && isset($_GET['sex1']) && isset($_GET['aadhar1']) )
{
$name=$_GET['name1'];
$age=$_GET['age1'];
$sex=$_GET['sex1'];
$aadhar=$_GET['aadhar1'];
if(!empty($name) && !empty($age) && !empty($aadhar) ) $passengers++;
}



if(isset($_GET['name2']) && isset($_GET['age2']) && isset($_GET['sex2']) && isset($_GET['aadhar2']) )
{
$name=$_GET['name2'];
$age=$_GET['age2'];
$sex=$_GET['sex2'];
$aadhar=$_GET['aadhar2'];

if(!empty($name) && !empty($age) && !empty($aadhar) ) $passengers++;
}

if(isset($_GET['name3']) && isset($_GET['age3']) && isset($_GET['sex3']) && isset($_GET['aadhar3']) )
{
$name=$_GET['name3'];
$age=$_GET['age3'];
$sex=$_GET['sex3'];
$aadhar=$_GET['aadhar3'];

if(!empty($name) && !empty($age) && !empty($aadhar) ) $passengers++;
}

if(isset($_GET['name4']) && isset($_GET['age4']) && isset($_GET['sex4']) && isset($_GET['aadhar4']) )
{
$name=$_GET['name4'];
$age=$_GET['age4'];
$sex=$_GET['sex4'];
$aadhar=$_GET['aadhar4'];

if(!empty($name) && !empty($age) && !empty($aadhar) ) $passengers++;
}

if(isset($_GET['name5']) && isset($_GET['age5']) && isset($_GET['sex5']) && isset($_GET['aadhar5']) )
{
$name=$_GET['name5'];
$age=$_GET['age5'];
$sex=$_GET['sex5'];
$aadhar=$_GET['aadhar5'];

if(!empty($name) && !empty($age) && !empty($aadhar) ) $passengers++;
}

if(isset($_GET['name6']) && isset($_GET['age6']) && isset($_GET['sex6']) && isset($_GET['aadhar6']) )
{
$name=$_GET['name6'];
$age=$_GET['age6'];
$sex=$_GET['sex6'];
$aadhar=$_GET['aadhar6'];

if(!empty($name) && !empty($age) && !empty($aadhar) ) $passengers++;
}



if($value<$passengers){
    echo '<script type="text/javascript">'; 
	echo 'alert("Required seats are not available!!");'; 
	echo 'window.location.href = "reservation.php";';
	echo '</script>';
}


else {

	$name=$_GET['name1'];
	$age=$_GET['age1'];
	$aadhar=$_GET['aadhar1'];
	$sex=$_GET['sex1'];

	if($value>0){
		$status=$ticket_status;
		if(!empty($name) || !empty($age) )
		{
		$sql="INSERT INTO $tbl_name(uname,Tnumber,class,doj,DOB,fromstn,tostn,Name,Age,sex,Status,pnr,Aadhar)
		VALUES ('$uname','$num','$seat','$doj','$dob','$fromstn','$tostn','$name','$age','$sex','$status','$pnr','$aadhar')";
		$result=$conn->query($sql);
		// echo "$sql</br>";
		if(!$result) die ($conn->error);
		$value-=1;
	$sql2="UPDATE seats_availability SET ".$class_select."=".$value." WHERE doj='".$doj."' and Train_No=".$num."";
		$result2=$conn->query($sql2);
		// echo "</br>".$sql2."</br>";
		if(!$result) die ($conn->error);
		}
	}


if($seat=="AC") {

	$seat_no = $coach_cnt*18 - $value + 1;
    $coach_no = ceil($seat_no/18);

    if($seat_no%18==0){
        $seat_no = 18;
    }
    else {
        $seat_no=$seat_no%18;
    }

    $seat_type = $AC_sitting[($seat_no-1)%6];

}

else if($seat=="SL") {

	$seat_no = $coach_cnt*24 - $value + 1;
    $coach_no = ceil($seat_no/24);

    if($seat_no%24==0){
        $seat_no = 24;
    }
    else {
        $seat_no=$seat_no%24;
    }

    $seat_type = $SL_sitting[($seat_no-1)%8];
}

	$ticket_status = $coach_no."-".$seat_no." ".$seat_type;

		


		$name=$_GET['name2'];
		$age=$_GET['age2'];
	$aadhar=$_GET['aadhar2'];
		$sex=$_GET['sex2'];

	if($value>0){
		$status=$ticket_status;	

		if(!empty($name) || !empty($age) )
		{
		$sql="INSERT INTO $tbl_name(uname,Tnumber,class,doj,DOB,fromstn,tostn,Name,Age,sex,Status,pnr,Aadhar)
		VALUES ('$uname','$num','$seat','$doj','$dob','$fromstn','$tostn','$name','$age','$sex','$status','$pnr','$aadhar')";
		$result=$conn->query($sql);
		// echo "$sql</br>";
		if(!$result) die ($conn->error);
		$value-=1;
	$sql2="UPDATE seats_availability SET ".$class_select."=".$value." WHERE doj='".$doj."' and Train_No=".$num."";
		$result2=$conn->query($sql2);
		// echo "</br>".$sql2."</br>";
		if(!$result) die ($conn->error);
		}
	}




if($seat=="AC") {

	$seat_no = $coach_cnt*18 - $value + 1;
    $coach_no = ceil($seat_no/18);

    if($seat_no%18==0){
        $seat_no = 18;
    }
    else {
        $seat_no=$seat_no%18;
    }

    $seat_type = $AC_sitting[($seat_no-1)%6];

}

else if($seat=="SL") {

	$seat_no = $coach_cnt*24 - $value + 1;
    $coach_no = ceil($seat_no/24);

    if($seat_no%24==0){
        $seat_no = 24;
    }
    else {
        $seat_no=$seat_no%24;
    }

    $seat_type = $SL_sitting[($seat_no-1)%8];
}

	$ticket_status = $coach_no."-".$seat_no." ".$seat_type;



		$name=$_GET['name3'];
		$age=$_GET['age3'];
	$aadhar=$_GET['aadhar3'];
		$sex=$_GET['sex3'];

	if($value>0){
		$status=$ticket_status;	


		if(!empty($name) || !empty($age) )
		{
		$sql="INSERT INTO $tbl_name(uname,Tnumber,class,doj,DOB,fromstn,tostn,Name,Age,sex,Status,pnr,Aadhar)
		VALUES ('$uname','$num','$seat','$doj','$dob','$fromstn','$tostn','$name','$age','$sex','$status','$pnr','$aadhar')";
		$result=$conn->query($sql);
		// echo "$sql</br>";
		if(!$result) die ($conn->error);
		$value-=1;
	$sql2="UPDATE seats_availability SET ".$class_select."=".$value." WHERE doj='".$doj."' and Train_No=".$num."";
		$result2=$conn->query($sql2);
		// echo "</br>".$sql2."</br>";
		if(!$result) die ($conn->error);
		}
	}




if($seat=="AC") {

	$seat_no = $coach_cnt*18 - $value + 1;
    $coach_no = ceil($seat_no/18);

    if($seat_no%18==0){
        $seat_no = 18;
    }
    else {
        $seat_no=$seat_no%18;
    }

    $seat_type = $AC_sitting[($seat_no-1)%6];

}

else if($seat=="SL") {

	$seat_no = $coach_cnt*24 - $value + 1;
    $coach_no = ceil($seat_no/24);

    if($seat_no%24==0){
        $seat_no = 24;
    }
    else {
        $seat_no=$seat_no%24;
    }

    $seat_type = $SL_sitting[($seat_no-1)%8];
}

	$ticket_status = $coach_no."-".$seat_no." ".$seat_type;



		$name=$_GET['name4'];
		$age=$_GET['age4'];
	$aadhar=$_GET['aadhar4'];
		$sex=$_GET['sex4'];
		
	if($value>0){
		$status=$ticket_status;	

		if(!empty($name) || !empty($age) )
		{
		$sql="INSERT INTO $tbl_name(uname,Tnumber,class,doj,DOB,fromstn,tostn,Name,Age,sex,Status,pnr,Aadhar)
		VALUES ('$uname','$num','$seat','$doj','$dob','$fromstn','$tostn','$name','$age','$sex','$status','$pnr','$aadhar')";
		$result=$conn->query($sql);
		// echo "$sql</br>";
		if(!$result) die ($conn->error);
		$value-=1;
	$sql2="UPDATE seats_availability SET ".$class_select."=".$value." WHERE doj='".$doj."' and Train_No=".$num."";
		$result2=$conn->query($sql2);
		// echo "</br>".$sql2."</br>";
		if(!$result) die ($conn->error);
		}
	}



if($seat=="AC") {

	$seat_no = $coach_cnt*18 - $value + 1;
    $coach_no = ceil($seat_no/18);

    if($seat_no%18==0){
        $seat_no = 18;
    }
    else {
        $seat_no=$seat_no%18;
    }

    $seat_type = $AC_sitting[($seat_no-1)%6];

}

else if($seat=="SL") {

	$seat_no = $coach_cnt*24 - $value + 1;
    $coach_no = ceil($seat_no/24);

    if($seat_no%24==0){
        $seat_no = 24;
    }
    else {
        $seat_no=$seat_no%24;
    }

    $seat_type = $SL_sitting[($seat_no-1)%8];
}

	$ticket_status = $coach_no."-".$seat_no." ".$seat_type;



		$name=$_GET['name5'];
		$age=$_GET['age5'];
	$aadhar=$_GET['aadhar5'];
		$sex=$_GET['sex5'];

	if($value>0){
		$status=$ticket_status;	

		if(!empty($name) || !empty($age) )
		{
		$sql="INSERT INTO $tbl_name(uname,Tnumber,class,doj,DOB,fromstn,tostn,Name,Age,sex,Status,pnr,Aadhar)
		VALUES ('$uname','$num','$seat','$doj','$dob','$fromstn','$tostn','$name','$age','$sex','$status','$pnr','$aadhar')";
		$result=$conn->query($sql);
		// echo "$sql</br>";
		if(!$result) die ($conn->error);
		$value-=1;
	$sql2="UPDATE seats_availability SET ".$class_select."=".$value." WHERE doj='".$doj."' and Train_No=".$num."";
		$result2=$conn->query($sql2);
		// echo "</br>".$sql2."</br>";
		if(!$result) die ($conn->error);
		}
	}

if($seat=="AC") {

	$seat_no = $coach_cnt*18 - $value + 1;
    $coach_no = ceil($seat_no/18);

    if($seat_no%18==0){
        $seat_no = 18;
    }
    else {
        $seat_no=$seat_no%18;
    }

    $seat_type = $AC_sitting[($seat_no-1)%6];

}

else if($seat=="SL") {

	$seat_no = $coach_cnt*24 - $value + 1;
    $coach_no = ceil($seat_no/24);

    if($seat_no%24==0){
        $seat_no = 24;
    }
    else {
        $seat_no=$seat_no%24;
    }

    $seat_type = $SL_sitting[($seat_no-1)%8];
}

	$ticket_status = $coach_no."-".$seat_no." ".$seat_type;



		$name=$_GET['name6'];
		$age=$_GET['age6'];
	$aadhar=$_GET['aadhar6'];
		$sex=$_GET['sex6'];

	if($value>0){
		$status=$ticket_status;	

		if(!empty($name) || !empty($age) )
		{
		$sql="INSERT INTO $tbl_name(uname,Tnumber,class,doj,DOB,fromstn,tostn,Name,Age,sex,Status,pnr,Aadhar)
		VALUES ('$uname','$num','$seat','$doj','$dob','$fromstn','$tostn','$name','$age','$sex','$status','$pnr','$aadhar')";
		$result=$conn->query($sql);
		// echo "$sql</br>";
		if(!$result) die ($conn->error);
		$value-=1;
	$sql2="UPDATE seats_availability SET ".$class_select."=".$value." WHERE doj='".$doj."' and Train_No=".$num."";
		$result2=$conn->query($sql2);
		// echo "</br>".$sql2."</br>";
		if(!$result) die ($conn->error);
		}
	}

		echo("file succesfully inserted");

	header("location:display.php?tno='$num'&& doj='$doj'&& seat='$seat'");
}


?>
