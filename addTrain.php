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
			 // if(isset($_SESSION['name']) && $_SESSION['name']=="admin")
			 // {
			 echo "Welcome,".'admin'."&nbsp;&nbsp;&nbsp;<a href=\"logout.php\" class=\"btn btn-info\">Logout</a>";
			 // }
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
		
		<!-- <br /><br /> -->
		<div class="display" style="margin-top:0px;height:420px;">
		<h3><font color="light-blue">Schedule Train</font></h3>
			<form method="post" action="insert_train.php">
			<table class="table">
				<col width="200">
				<col width="200">
				<col width="200">
				<col width="200">
				<col width="200">
				<col width="200">
				<tr>
					<th style="width:100px;border-top:0px;">Train Name</th>
					<th style="width:100px;border-top:0px;"> Train Number</th>
					<th style="width:100px;border-top:0px;"> From Station</th>
					<th style="width:100px;border-top:0px;"> To Station</th>
					<th style="width:100px;border-top:0px;"> From Arrival Time</th>
					<th style="width:100px;border-top:0px;"> To Arrival Time</th>
				</tr>
				<tr>
					<td style="border-top:0px;"><input type="text" name="trainname" class="input-small" required></td>
					<td style="border-top:0px;"><input type="number" name="trainno" class="input-small" min="1" required></td>
					<td style="border-top:0px;"><input type="text" name="src" class="input-small" required></td>
					<td style="border-top:0px;"><input type="text" name="dest" class="input-small" required></td>
					<td style="border-top:0px;"><input type="time" name="arr" class="input-small" required></td>
					<td style="border-top:0px;"><input type="time" name="dept" class="input-small" required></td>
				</tr>


				<tr>
					<th style="width:100px;border-top:0px;">AC Coaches</th>
					<th style="width:100px;border-top:0px;"> SL Coaches</th>
					<th style="width:100px;border-top:0px;"> Date Of Journey</th>
					<th style="width:100px;border-top:0px;"> Enter Route</th>
				</tr>
				<tr>
					<td style="border-top:0px;"><input type="number" name="ac" class="input-small" min="0" required></td>
					<td style="border-top:0px;"><input type="number" name="sl" class="input-small" min="0" required></td>
					<td style="border-top:0px;"><input id="myDate" type="date" class="input-block-level input-medium" name="doj" max="<?php echo date('Y-m-d',strtotime("+120 days"));?>" min="<?php echo date('Y-m-d',strtotime("+60 days"))?>" value="<?php if(isset($_POST['doj'])){echo $_POST['doj'];}else {echo date('Y-m-d',strtotime("+60 days"));}?>" required> </td>
					<td style="border-top:0px;"><input type="text" name="route" class="" placeholder="S(00:00#00:00),St1(00:00#00:00),St2(00:00#00:00),D(00:00#00:00)" required></td>
				</tr>

				<!-- days hours mins secs -->
				<!-- echo date('Y-m-d', strtotime("+30 days")); -->

		
<!-- 				<tr>
					<th style="width:100px;border-top:0px;">Schedule Days</th>
				</tr>

				<tr>
					<td>
				    M: <input type="radio" value="value1" name="group1">
			    	T: <input type="radio" value="value2" name="group2">
			    	W: <input type="radio" value="value2" name="group3"> <br/>
			    	TH: <input type="radio" value="value2" name="group4">
			    	F: <input type="radio" value="value2" name="group5">
			    	S: <input type="radio" value="value2" name="group6">
			    	Sun: <input type="radio" value="value2" name="group7">
    				</td>
				</tr>

				<tr>
					<td>
				 <select name="days" id="days" multiple>
			     <option value="Monday">Monday</option>
			     <option value="Tuesday">Tuesday</option>
			     <option value="Wednesday">Wednesday</option>
			     <option value="Thursday">Thursday</option>
			     <option value="Friday">Friday</option>
			     <option value="Saturday">Saturday</option>
			     <option value="Sunday">Sunday</option>
			     </select>
			     </td>
				</tr> -->

				<tr>
					<td style="border-top:0px;"><input class="btn btn-primary"type="submit" value="Schedule" id="subb" ></td>
					<td style="border-top:0px;"><input class="btn btn-info"type="reset" value="Reset"></td>
				</tr>	
				
			</table>
			</form>
		</div>
		
		</div>
		
		
<!-- <footer >
		<div style="width:100%;">
			<div style="float:left;">
			<p class="text-right text-info">  &copy; 2018 Copyright PVT Ltd.</p>	
			</div>
			<div style="float:right;">
			<p class="text-right text-info">	Desinged By : projectworlds</p>
			</div>
		</div>
		</footer>	 -->	
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