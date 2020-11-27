<?php
session_start();
require('firstimport.php');

$tbl_name="train_list";

	$tbl_name="train_list";
	$tbl_name2 = "seats_availability";
	
	// $name1=$_POST['byname'];
	// $name2=$_POST['bynum'];
	// $dojj=$_POST['date'];
	
	// $name1=strtoupper($name1);
	// $name2=strtoupper($name2);

	// $sql="SELECT DISTINCT * FROM $tbl_name,$tbl_name2 WHERE train_no=Number and Origin='$name1'and Destination='$name2' and doj='$dojj'";
	// $result=mysqli_query($conn,$sql);

mysqli_select_db($conn,"$db_name") or die("cannot select db");
$k=0;
if(isset($_POST['byname']) && ($_POST['bynum']==""))
{
	$name1=$_POST['byname'];
	$k=2;
	$name1=strtoupper($name1);
	
	$tbl_name="train_list";
	$sql="SELECT * FROM $tbl_name WHERE Number='$name1' or Name='$name1' ";
	$result=mysqli_query($conn,$sql);
}
else if(isset($_POST['byname']) && isset($_POST['bynum']))
{
	$k=1;
	$from=$_POST['byname'];
	$to=$_POST['bynum'];
	$dojj=$_POST['date'];

	$from=strtoupper($from);
	$to=strtoupper($to);

	$sql="SELECT DISTINCT * FROM $tbl_name,$tbl_name2 WHERE train_no=Number and Origin='$from'and Destination='$to' and doj='$dojj'";
	$result=mysqli_query($conn,$sql);
}
else if((!isset($_POST['byname'])) && (!isset($_POST['bynum'])))
{
	$k=0;
	$from="";
	$to="";
}

?>
<!DOCTYPE html>
<html>
<head>
	<title> Find Train </title>
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
		
		<div class="span12 well" id="boxh">
		
			<form style="margin:0px;" method="post" >
			<table class="table" style="margin-bottom:0px;">
				<tr>
					<th style="border-top:0px;"><label><b>SEARCH TRAIN</label></th>
					<!-- <td style="border-top:0px;">
						<select id="myselect" onchange="clicker()">
						<option value="plf">By Station</option>
						<option value="name" >By Name</option>
						<option value="num" >By Number</option>
						</select>
					</td> -->
					<td id="mbox" style="border-top:0px;"> <label>From </label></td>
					<td style="border-top:0px;"><input  type="text" class="input-block-level" name="byname" id="byn" required></td>
					<td id="xbox" style="border-top:0px;"><label> To </label></td>
					<td style="border-top:0px;"><input id="xbox1" type="text" class="input-block-level" name="bynum" required></td>
					
					<td style="border-top:0px;"><label> Date<label></th>
					<td style="border-top:0px;"><input type="date" class="input-block-level input-medium" name="date" max="<?php echo date('Y-m-d',strtotime("+120 days"))?>" min="<?php echo date('Y-m-d')?>" value="<?php if(isset($_POST['date'])){echo $_POST['date'];}else {echo date('Y-m-d');}?>"> </td>

					<td style="border-top:0px;"><input class="btn btn-info" type="submit" value="Find"> </td>
					<td style="border-top:0px;"><a href="train.php" class="btn btn-info" type="reset" value="Reset">Reset</a></td>
					<td style="border-top:0px;"><a href="alternate.php" class="btn btn-info" value="Alternative">Alternative</a></td>
				</tr>
			</table>
			</form>
		</div>
<!-- display result -->
		<div class="span12 well">
			<div class="display" style="height:20px;">
				<table class="table" border="5px">
				<tr>
					<th style="width:70px;border-top:0px;"> Train No.</th>
					<th style="width:130px;border-top:0px;"> Train Name </th>
					<th style="width:70px;border-top:0px;"> Source </th>
					<th style="width:70px;border-top:0px;"> Destination </th>
					<th style="width:70px;border-top:0px;"> Arrival Time </th>
					<th style="width:70px;border-top:0px;"> Departure Time </th>
					<!-- <th style="width:20px;border-top:0px;"> M </th>
					<th style="width:25px;border-top:0px;"> T </th>
					<th style="width:29px;border-top:0px;"> W </th>
					<th style="width:25px;border-top:0px;"> T </th>
					<th style="width:25px;border-top:0px;"> F </th>
					<th style="width:25px;border-top:0px;"> S </th>
					<th style="border-top:0px;"><font color=red> S </font></th> -->
				</tr>
				</table>
			</div>
			<div class="display" style="margin-top:0px;overflow:auto;">
				<table class="table" >
				<?php
				if($k==1)
				{	echo "<script> document.getElementById(\"byn\").value=\"$from\";
									   document.getElementById(\"xbox1\").value=\"$to\";
							</script>";
					$n=0;
					if(mysqli_num_rows($result) < 1)
				    {
				       echo "<div class=\"alert alert-error\"  style=\"margin:100px 350px;\"> No Trains Found... </div>";
				    }
					while($row=mysqli_fetch_array($result)){
					//$q="from: ".$from;
						if($from==$row['Origin'])
						{	$q=$row['Arrival']; }
						else if($from==$row['Destination'])
						{	$q=$row['Departure'];}
						
						$p1=substr($q,0,2);
						$p2=substr($q,3,2);
						$p2=$p2+5;
						if($p2<10)
						{$p2="0".$p2;}
						$d=$p1.":".$p2;
					if($n%2==0)
					{
				?>
				<tr class="text-error">
					<td style="width:70px;"><?php echo $row['Number']; ?> </td>
					<td style="width:130px;"> <?php echo $row['Name']; ?> </td>
					<td style="width:70px;"> <?php echo $row['Origin']; ?> </td>
					<td style="width:70px;"> <?php echo $row['Destination']; ?> </td>
					<td style="width:70px;"> <?php echo $q; ?> </td>
					<td style="width:70px;"> <?php echo $d; ?> </td>
					<!-- <td style="width:20p;"><?php echo $row['Mon']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Tue']; ?> </td>
					<td style="width:29px;"> <?php echo $row['Wed']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Thu']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Fri']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Sat']; ?> </td>
					<td> <?php echo $row['Sun']; ?> </td> -->
				</tr>
				<?php
					}
					else
					{
				?>
				<tr class="text-info">
					<td style="width:70px;"> <?php echo $row['Number']; ?> </td>
					<td style="width:130px;"> <?php echo $row['Name']; ?> </td>
					<td style="width:70px;"> <?php echo $row['Origin']; ?> </td>
					<td style="width:70px;"> <?php echo $row['Destination']; ?> </td>
					<td style="width:70px;"> <?php echo $q; ?> </td>
					<td style="width:70px;"> <?php echo $d; ?> </td>
					<!-- <td style="width:20p;"> <?php echo $row['Mon']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Tue']; ?> </td>
					<td style="width:29px;"> <?php echo $row['Wed']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Thu']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Fri']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Sat']; ?> </td>
					<td> <?php echo $row['Sun']; ?> </td>				</tr> -->
				<?php
					}
					$n++;
					}
				}
				else if($k==2)
				{	$n=0;
					while($row=mysqli_fetch_array($result)){
					if($n%2==0)
					{
				?>
				<tr class="text-error">
					<td style="width:70px;"> <?php echo $row['Number']; ?> </td>
					<td style="width:130px;"> <?php echo $row['Name']; ?> </td>
					<td style="width:70px;"> <?php echo $row['Origin']; ?> </td>
					<td style="width:70px;"> <?php echo $row['Destination']; ?> </td>
					<td style="width:70px;"> <?php echo $q; ?> </td>
					<td style="width:70px;"> <?php echo $d; ?> </td>
					<!-- <td style="width:20p;"> <?php echo $row['Mon']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Tue']; ?> </td>
					<td style="width:29px;"> <?php echo $row['Wed']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Thu']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Fri']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Sat']; ?> </td>
					<td> <?php echo $row['Sun']; ?> </td> -->
				</tr>
				<?php
					}	
					else
					{
				?>
				<tr class="text-info">
					<td style="width:70px;"> <?php echo $row['Number']; ?> </td>
					<td style="width:130px;"> <?php echo $row['Name']; ?> </td>
					<td style="width:70px;"> <?php echo $row['Origin']; ?> </td>
					<td style="width:70px;"> <?php echo $row['Destination']; ?> </td>
					<td style="width:70px;"> <?php echo $q; ?> </td>
					<td style="width:70px;"> <?php echo $d; ?> </td>
					<!-- <td style="width:20p;"> <?php echo $row['Mon']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Tue']; ?> </td>
					<td style="width:29px;"> <?php echo $row['Wed']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Thu']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Fri']; ?> </td>
					<td style="width:25px;"> <?php echo $row['Sat']; ?> </td>
					<td> <?php echo $row['Sun']; ?> </td> -->		
				</tr>
				<?php
					}
					$n++;
					}
				}
				else
				{
				    echo "<div class=\"alert alert-error\"  style=\"margin:100px 350px;\"> Search for the train... </div>";
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