<?php


session_start();
if(isset($_SESSION['name'])){}
	else{
		header("location:login1.php");
		
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Reservation </title>
	<link rel="shortcut icon" href="images/favicon.png"></link>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
	<link href="css/bootstrap.min.css" rel="stylesheet" ></link>
	<link href="css/bootstrap.css" rel="stylesheet" ></link>
	<link href="css/Default.css" rel="stylesheet" >	</link>
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
		
		<!-- Navigation bar -->
		<div class="navbar navbar-inverse">
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
		
		
		<div class="display" style="margin-top:0px;height:30px;">
		
		
		
		
		<form method="get" action="booking.php">
				
				<table class="table" style="border-style:ridge;">
				<col width="50">
				<col width="50">
				<col width="50">
				<col width="80">
				<col width="80">
				<col width="70">
				<col width="70">
				<col width="70">
				<col width="70">
				<col width="50">
				<col width="50">
				<tr>
					<th style="border-top:0px;">Journey date:</th>
					<th style="border-top:0px;"> Train No./Name:</th>
					<th style="border-top:0px;">From Station:</th>
					<th style="border-top:0px;">To Station:</th>
					<th style="border-top:0px;">Seats Available:</th>
					<!-- <th style="border-top:0px;">Quota:</th> -->
					<th style="border-top:0px;"> AC</th>
					<th style="border-top:0px;"> SL </th>
				</tr>
				<tr>
					<td style="border-top:0px;"> <?php echo $_GET['doj'];?> </td>
					<input name="doj" style="display:none;" type="text" value="<?php echo $_GET['doj'];?>">
					<input name="dob" style="display:none;" type="text" value="<?php echo date("Y-m-d");?>">
					<td style="border-top:0px;"> <?php echo $_GET['tno'];?> </td>
					<input name="tno" style="display:none;" type="text" value="<?php echo $_GET['tno'];?>"> </td>
					
					<td style="border-top:0px;"><?php echo $_GET['fromstn'];?></td>
					<input name="fromstn" style="display:none;" type="text" value="<?php echo $_GET['fromstn'];?>"> </td>
					
					<td style="border-top:0px;"><?php echo $_GET['tostn'];?></td>
					<input name="tostn" style="display:none;" type="text" value="<?php echo $_GET['tostn'];?>"> </td>

					<td style="border-top:0px;"><?php echo $_GET['seats'];?></td>
					<input name="seats" style="display:none;" type="text" value="<?php echo $_GET['seats'];?>"> </td>
		
		
					<td style="border-top:0px;"> <input type="radio" name="selct" value="AC" onclick="return false;" <?php if($_GET['class']=='AC') {echo 'checked';}?>> </td>
					
					<td style="border-top:0px;"> <input type="radio" name="selct" value="SL" onclick="return false;" <?php if($_GET['class']=='SL') echo 'checked';?>> </td>

					
				</tr>
				</table>
				
		</div>
		<!-- <div class="display" style="height:50px;">
				
		</div> -->
		<br /><br />
		<!-- <div class="display" style="margin-top:0px;height:450px;"> -->
		<h2><font color="blue">Enter Passenger Details</font></h2>
			
			<table class="table">
				<tr>
					<th style="width:100px;border-top:0px;">SNo.</th>
					<th style="width:200px;border-top:0px;"> NAME</th>
					<th style="width:100px;border-top:0px;"> AGE </th>
					<th style="width:100px;border-top:0px;"> AADHAR No. </th>
					<th style="width:100px;border-top:0px;"> GENDER </th>
				</tr>
				<?php for($i=1;$i<=$_GET['psg'];$i++) {?>
				<tr>
					<td > PASSENGER <?php echo $i ?></td>
					<td ><input type="text" name="name<?php echo $i ?>" pattern="[A-Za-z ]{1,50}" required></td>
					<td ><input type="number" name="age<?php echo $i ?>" class="input-small" min="5" required></td>
					<td ><input type="number" name="aadhar<?php echo $i ?>" class="input-small" min="100" required></td>
					<td ><select name="sex<?php echo $i ?>" class="input-small">
						<option value="male">MALE</option>
						<option value="female">FEMALE</option>
						</select>
					</td>
				</tr>
				<?php } ?>
				<tr>
					<td style="border-top:0px;"><input class="btn btn-primary"type="submit" value="Book" id="subb" ></td>
					<td style="border-top:0px;"><input class="btn btn-info"type="reset" value="Reset"></td>
				</tr>	
			</table>
			</form>
		<!-- </div> -->
		
		<div>
		<br  />
		<p> <font color="red"> NO NEED TO BOOK TICKET FOR CHILDREN BELOW 5 YEARS. </font> </p>
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
		</footer>		
	</div>

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