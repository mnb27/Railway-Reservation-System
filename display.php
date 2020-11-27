<?php
	session_start();
	
require('firstimport.php');
if(isset($_SESSION['name'])){}
	else{
		header("location:login1.php");
		
	}
$tbl_name="booking";

mysqli_select_db($conn,"$db_name") or die("cannot select db");
	// $name1=$_SESSION['name'];
	// $sql="SELECT DISTINCT Age,sex,Name,Tnumber,class,doj,DOB,fromstn,tostn,Status,pnr FROM $tbl_name WHERE uname='$name1' ORDER BY doj,pnr ASC";
	// $result=mysqli_query($conn,$sql);
	// $row=mysqli_fetch_array($result);

// $row=mysqli_fetch_array($result);
// $tname=$row['Name'];
// $result=mysqli_query($conn,$sql);

			 if(isset($_SESSION['name']))
			 {
			 // echo "Welcome,".$_SESSION['name']."&nbsp;&nbsp;&nbsp;<a href=\"logout.php\" class=\"btn btn-info\">Logout</a>";
			 }
			 else
			 {
				$_SESSION['error']=15;
				header("location:login1.php");
			 } 
?>
<!DOCTYPE html>
<html>
<head>
	<title> Booking History </title>
	<link rel="shortcut icon" href="images/favicon.png"></link>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	</link>
	<link href="css/Default.css" rel="stylesheet">
	</link>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script>
		$(document).ready(function()
		{
			$('.wrap').css();
		});
	</script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/man.js"></script>
	
</head>
<body>
	<div class="wrap">
		<div class="header">
			<div style="float:left;width:140px;">
				<img src="images/log.png"/>
			</div>		
			<div>
			<div style="float:right; font-size:20px;margin-top:20px;">
			<?php
			 if(isset($_SESSION['name']))
			 {
			 echo "Welcome,".$_SESSION['name']."&nbsp;&nbsp;&nbsp;<a href=\"logout.php\" class=\"btn btn-info\">Logout</a>";
			 }
			 else
			 {
			 ?>
				<a href="login1.php" class="btn btn-info">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="signup.php?value=0" class="btn btn-info">Signup</a>
			<?php }
			 ?>			
			</div>
			<div id="heading">
				<a href="index.php">Railway Reservation</a>
			</div>
			</div>
		</div>
		<!-- Navigation bar -->
		<div class="navbar navbar-inverse" >
			<div class="navbar-inner">
				<div class="container" >
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
				<a class="brand" href="index.php" ><i class="fa fa-home"></i>&nbsp; HOME</a>
				<a class="brand" href="train.php" ><i class="fa fa-search"></i>&nbsp; FIND TRAIN</a>
				<a class="brand" href="reservation.php"><i class="fa fa-train"></i>&nbsp; BOOK</a>
				<a class="brand" href="profile.php"><i class="fa fa-id-card"></i>&nbsp; PROFILE</a>
				<a class="brand" href="display.php"><i class="fa fa-book"></i>&nbsp; BOOKINGS</a>
				<a class="brand" href="admin_login1.php"><i class="fa fa-user"></i>&nbsp; ADMIN</a>
				<div class="container">
				  <label class="switch" for="checkbox">
				    <input type="checkbox" id="checkbox" />
				    <div class="slider round"></div>
				  </label>
				</div>
				</div>
			</div>
		</div>
		
		<div class="span12 well">
			<div align="center" style="border-bottom: 3px solid #ddd;">
				<h2>Booked Ticket History </h2>
			
			</div>
			<br>
			<!--
			<div >
				<table class="table">
				
				<tr>
					<th style="border-top:0px;" > <label>Train No.<label></th>
					<td style="border-top:0px;"><label class="text-error"><?php echo $tnum;?></label></td>
					<th style="border-top:0px;"><label> Train Name<label> </th>
					<td style="border-top:0px;"><label class="text-error"><?php echo $tname;?></label></td>
					<th style="border-top:0px;"> <label>Class <label></th>
					<td style="border-top:0px;"><label class="text-error"><?php echo $cl;?></label></td>	
					
				</tr>
				</table>
			</div>
			-->
			<div>
			
			</div>
			<div >
				<table  class="table">
				<col width="90">
				<col width="90">
				<col width="200">
				<col width="200">
				<col width="90">
				<col width="90">
				<col width="90">
				<col width="90">
				<col width="200">
				<col width="200">
				<col width="90">
				<tr>
					<th style="width:100px;border-top:0px;">PNR</th>
					<th style="width:130px;border-top:0px;">Train Number</th>
					<th style="width:100px;border-top:0px;">Date Of Journey</th>
					<!-- <th style="width:100px;border-top:0px;">Name</th>
					<th style="width:100px;border-top:0px;">Age</th>
					<th style="width:100px;border-top:0px;">Gender</th> -->
					<th style="width:100px;border-top:0px;">From</th>
					<th style="width:100px;border-top:0px;">To</th>
					<th style="width:100px;border-top:0px;">Booked On</th>
					<!-- <th style="width:100px;border-top:0px;">Coach-Seat-Type</th> -->
					<th style="width:100px;border-top:0px;">Class</th>
					<th style="width:180px;border-top:0px;">Details</th>
				</tr>	
				<?php
				
				$tbl_name="booking";
				$name1=$_SESSION['name'];
				$sql="SELECT DISTINCT pnr,Tnumber,class,doj,DOB,fromstn,tostn FROM $tbl_name WHERE uname='$name1'";
				$result=mysqli_query($conn,$sql);

				// $sql="SELECT DISTINCT Age,sex,Name,Tnumber,class,doj,DOB,fromstn,tostn,Status,pnr FROM $tbl_name WHERE uname='$name1' ORDER BY doj,pnr ASC";
				// $result=mysqli_query($conn,$sql);


				$n=1;
				while($row=mysqli_fetch_array($result)){

					// $curr_pnr = $row['pnr'];

					// $tbl_name2="booking";
					// $sql2="SELECT Age,sex,Name,Status FROM $tbl_name WHERE uname='$name1' and pnr='$curr_pnr'";
					// $result2=mysqli_query($conn,$sql);

					if($n%2!=0)
					{
				?>
				<tr class="text-error">
					<th style="width:100px;"> <?php echo $row['pnr']; ?> </th>
					<th style="width:130px;"> <?php echo $row['Tnumber']; ?> </th>
					<th style="width:100px;"> <?php echo $row['doj']; ?> </th>
					<th style="width:100px;"> <?php echo $row['fromstn']; ?> </th>
					<th style="width:100px;"> <?php echo $row['tostn']; ?> </th>
					<th style="width:100px;"> <?php echo $row['DOB']; ?> </th>
					<th style="width:100px;"> <?php echo $row['class']; ?> </th>
					<th style="width:180px;"><a href="ViewFullStatus.php?Tnumber=<?php echo $row['Tnumber']; ?>&pnr=<?php echo $row['pnr']; ?>&doj=<?php echo $row['doj'];?>&fromstn=<?php echo $row['fromstn']; ?>&tostn=<?php echo $row['tostn']; ?>&DOB=<?php echo $row['DOB'];?>">Passenger Details </a> </th>
				</tr>

				<?php 
					}
					else
					{
				?>
				<tr class="text-info">
					<th style="width:100px;"> <?php echo $row['pnr']; ?> </th>
					<th style="width:130px;"> <?php echo $row['Tnumber']; ?> </th>
					<th style="width:100px;"> <?php echo $row['doj']; ?> </th>
					<th style="width:100px;"> <?php echo $row['fromstn']; ?> </th>
					<th style="width:100px;"> <?php echo $row['tostn']; ?> </th>
					<th style="width:100px;"> <?php echo $row['DOB']; ?> </th>
					<th style="width:100px;"> <?php echo $row['class']; ?> </th>
					<th style="width:180px;"><a href="ViewFullStatus.php?Tnumber=<?php echo $row['Tnumber'];?>&pnr=<?php echo $row['pnr']; ?>&doj=<?php echo $row['doj'];?>&fromstn=<?php echo $row['fromstn']; ?>&tostn=<?php echo $row['tostn']; ?>&DOB=<?php echo $row['DOB'];?>">Passenger Details </a> </th>
					
				</tr>
				<?php
					}
					$n++;
	
				}
				?>
				
				
				</table>

			</div>
		</div>
			
		<!-- Copyright -->
		<footer >
		<div style="width:100%;">
			<div style="float:left;">
			<p class="text-right text-info">  &copy; DBMS Project</p>	
			</div>
			<div style="float:right;">
			<p class="text-right text-info"><strong>Developed By:</strong> Akshat, Aman & Prateek</p>
			</div>
		</div>
		</footer>

		<script>

			var el = document.getElementById('checkbox');

			el.addEventListener('click', function() {
			  if(document.getElementById("checkbox").checked === false){
			    document.documentElement.classList.toggle('dark-mode');
			    document.querySelectorAll('.inverted').forEach((result) => {
						result.classList.toggle('invert');
					})
			  } 
			  else {
			    document.documentElement.classList.toggle('dark-mode');
			    document.querySelectorAll('.inverted').forEach((result) => {
						result.classList.toggle('invert');
					})
			  }    
			});

		</script>
		
	</div>
</body>
</html>	












