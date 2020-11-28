<?php
session_start();
require('firstimport.php');

$tbl_name="booking";

mysqli_select_db($conn,"$db_name") or die("cannot select db");

$k=0;
if(isset($_POST['bypnr'])){
	$k=1;
	$pnr=$_POST['bypnr'];

	$sql="SELECT Tnumber,doj,Name,Age,Sex,Status,DOB,class,pnr FROM $tbl_name WHERE pnr='$pnr'";
	$result=mysqli_query($conn,$sql);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title> Check PNR </title>
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
		<!-- Header -->
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
		
			<form style="margin:0px;" action="check_pnr.php" method="post" >
			<table class="table" style="margin-bottom:0px;">
				<tr>
					<th style="border-top:0px;"><label><b>ENTER PNR TO CHECK</label></th>
					<td style="border-top:0px;"> <label>PNR No. </label></td>
					<td style="border-top:0px;"><input  type="text" class="input-block-level" name="bypnr" required></td>
					<td style="border-top:0px;"><input class="btn btn-info" type="submit" value="Fetch Details"> </td>
					<td style="border-top:0px;"><a href="check_pnr.php" class="btn btn-info" type="reset" value="Reset">Reset</a></td>
				</tr>
			</table>
			</form>
		</div>
<!-- display result -->
		<div class="span12 well">
			<div class="display" style="margin:0px;overflow:auto;height:250px">
				<table class="table" border="2px">
					<col width="90">
					<col width="90">
				<col width="90">
				<col width="110">
				<col width="90">
				<col width="90">
				<col width="90">
				<col width="90">
				<tr>
					<th style="width:100px;border-top:0px;">PNR</th>
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
				<!-- </table> -->
			<!-- </div> -->
			<!-- <div class="display" style="margin-top:0px;overflow:auto;"> -->
				<!-- <table class="table" > -->
				<?php
				if($k==1)
				{	
					$n=0;
					if(mysqli_num_rows($result) < 1)
				    {
				       echo "<div class=\"alert alert-error\"  style=\"margin:50px 300px;\"> PNR Not Found... </div>";
				    }
					while($row=mysqli_fetch_array($result)){
					//$q="from: ".$from;

					if($n%2==0)
					{
				?>
				<tr class="text-error">
					<th style="width:100px;"> <?php echo $row['pnr']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Tnumber']; ?> </th>
					<th style="width:100px;"> <?php echo $row['doj']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Name']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Age']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Sex']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Status']; ?> </th>
					<th style="width:100px;"> <?php echo $row['DOB']; ?> </th>
					<th style="width:100px;"> <?php echo $row['class']; ?> </th>
				</tr>
				<?php
					}
					else
					{
				?>
				<tr class="text-info">
					<th style="width:100px;"> <?php echo $row['pnr']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Tnumber']; ?> </th>
					<th style="width:100px;"> <?php echo $row['doj']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Name']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Age']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Sex']; ?> </th>
					<th style="width:100px;"> <?php echo $row['Status']; ?> </th>
					<th style="width:100px;"> <?php echo $row['DOB']; ?> </th>
					<th style="width:100px;"> <?php echo $row['class']; ?> </th>
				<?php
					}
					$n++;
					}
				}
				else
				{
				    echo "<div class=\"alert alert-error\"  style=\"margin:50px 300px;\"> Enter PNR to check... </div>";
				}
				mysqli_close($conn);
				?>
				</table>
			</div>
		</div>
		
<footer >
		<div style="width:100%;">
			<div style="float:left;">
			<p class="text-right text-info">  &copy; DBMS Project</p>	
			</div>
			<div style="float:right;">
			<p class="text-right text-info"><strong>Developed By:</strong> Akshat, Aman & Prateek</p>
			</div>
		</div>
		</footer>	</div>

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
</body>
</html>
