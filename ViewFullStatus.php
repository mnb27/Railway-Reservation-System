<?php
session_start();
	
require('firstimport.php');
if(isset($_SESSION['name'])){}
	else{
		header("location:login1.php");
		
	}
$tbl_name="booking";

mysqli_select_db($conn,"$db_name") or die("cannot select db");
	$name1=$_SESSION['name'];
	$tno=$_GET['Tnumber'];
	$doj=$_GET['doj'];
	$fromstn=$_GET['fromstn'];
	$tostn=$_GET['tostn'];
	$DOB=$_GET['DOB'];
	$pnr=$_GET['pnr'];
	// $aadhar=$_GET['Aadhar'];
	$sql="SELECT Tnumber,doj,Name,Age,Sex,Status,DOB,class,pnr FROM $tbl_name WHERE (pnr='$pnr' and uname='$name1' and Tnumber='$tno' and doj='$doj' and DOB='$DOB' and fromstn='$fromstn' and tostn='$tostn')";
	$result=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title> Journey Details </title>
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
				<h2>Ticket Details  </h2>
			
			</div>
			<br>
		
	<div >
				<table  class="table" border="2px">
				<col width="90">
					<col width="90">
				<col width="90">
				<col width="110">
				<col width="90">
				<col width="90">
				<col width="90">
				<col width="90">
				<tr>
					<th style="width:10px;border-top:0px;">PNR</th>
					<!-- <th style="width:100px;border-top:0px;">Aadhar No.</th> -->
					<th style="width:100px;border-top:0px;">Train No.</th>
					<th style="width:150px;border-top:0px;">DOJ</th>
					<th style="width:150px;border-top:0px;">Name</th>
					<th style="width:100px;border-top:0px;">Age</th>
					<th style="width:100px;border-top:0px;">Gender</th>
					<th style="width:150px;border-top:0px;">Coach-Berth</th>
					<th style="width:150px;border-top:0px;">DOB</th>
					<th style="width:100px;border-top:0px;">Class</th>
				</tr>	
				<?php
				
				$n=1;
				while($row=mysqli_fetch_array($result)){
					if($n%2!=0)
					{
						$GLOBALS['class']=$row['class'];
						
				?>
				<tr class="text-error">
					<th style="width:10px;"> <?php echo $row['pnr']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Tnumber']; ?> </th>
					<th style="width:100px;"> <?php echo $row['doj']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Name']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Age']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Sex']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Status']; ?> </th>
					<th style="width:100px;"> <?php echo $row['DOB']; ?> </th>
					<th style="width:100px;"> <?php echo $class; ?> </th>
				</tr>
				<?php 
					}
					else
					{
				?>
				<tr class="text-info">
					<th style="width:10px;"> <?php echo $row['pnr']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Tnumber']; ?> </th>
					<th style="width:100px;"> <?php echo $row['doj']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Name']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Age']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Sex']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Status']; ?> </th>
					<th style="width:100px;"> <?php echo $row['DOB']; ?> </th>
					<th style="width:100px;"> <?php echo $class; ?> </th>
				</tr>
				<?php
					}
					$n++;
				}
				?>
				<?php 
				$sql2="Select ".$class." from train_list WHERE Number=$tno";
				//echo $sql2;
				$result2=mysqli_query($conn,$sql2);
				while($row=mysqli_fetch_array($result2)){
					$GLOBALS['amt']=$row[$class];
				}
				?>
				</table>
				<table class="table">
				<tr class="text-info">
					<td>Total Fare: Rs.<?php $tot=($n-1)*$amt;echo $tot;?></td>
				</tr>
				</table>
				
				<button onClick="window.print()">Print Ticket</button>
				<div style="float:right;">
					<p class="text-right text-info">Booking Agent:<b> <?php echo $_SESSION['name'];?></b> </p>	
				</div>
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