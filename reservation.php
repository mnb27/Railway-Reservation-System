<?php  
session_start();
if(isset($_SESSION['name'])){}
	else{
		header("location:login1.php");
		
	}
	
require('firstimport.php');
$tbl_name="train_list";
mysqli_select_db($conn,"$db_name") or die("cannot select db");
$tostn = '';
$fromstn = '';
$doj = '';

$ac_seats = 0;
$sl_seats = 0;

if(isset($_POST['from']) && isset($_POST['to']))
{	$k=1;
	$tostn = $_POST['to'];
	$fromstn = $_POST['from'];
	$doj = $_POST['date'];
	$from=$_POST['from'];
	$to=$_POST['to'];
	// $quota=$_POST['quota'];
	$from=strtoupper($from);
	$tostn=strtoupper($tostn);
	$fromstn=strtoupper($fromstn);
	$to=strtoupper($to);
	$day=date("D",strtotime("".$doj));
	//echo $day."</br>";
	$psg = $_POST['psg'];

	$tbl_name2 = "seats_availability";
	
	$sql="SELECT DISTINCT * FROM $tbl_name,$tbl_name2 WHERE train_no=Number and Origin='$from'and Destination='$to' and doj='$doj'";
	$result=mysqli_query($conn,$sql);
}
else if((!isset($_POST['from'])) && (!isset($_POST['to'])))
{	$k=0;
	$from="";
	$to="";
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
	<link href="css/bootstrap.min.css" rel="stylesheet"></link>
	<link href="css/Default.css" rel="stylesheet"></link>
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
				echo "Welcome, ".$_SESSION['name']."&nbsp;&nbsp;&nbsp;<a href=\"logout.php\" class=\"btn btn-info\">Logout</a>";
			 }
			 else
			 {
				$_SESSION['error']=15;
				header("location:login1.php")
			 ?>  
				<a href="login.html" class="btn btn-info">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="signup.php" class="btn btn-info">Signup</a>
			<?php   } ?>
			
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
		
		<div class="row">
			<!-- find train with qouta-->
			<div class="span4 well">
			<form method="post" action="reservation.php">
			<table class="table">
				<tr>
					<th style="border-top:0px;"><label> From <label></th>
					<td style="border-top:0px;"><input type="text" class="input-block-level" name="from" id="fr" required></td>
				</tr>
				<tr>
					<th style="border-top:0px;"><label> To <label></th>
					<td style="border-top:0px;"><input type="text" class="input-block-level" name="to" id="to1" required></td>
				</tr>
				<tr>
					<th style="border-top:0px;"><label> Date<label></th>
					<td style="border-top:0px;"><input type="date" class="input-block-level input-medium" name="date" max="<?php echo date('Y-m-d',strtotime("+120 days"))?>" min="<?php echo date('Y-m-d')?>" value="<?php if(isset($_POST['date'])){echo $_POST['date'];}else {echo date('Y-m-d');}?>"> </td>
				</tr>
				<tr>
					<th style="border-top:0px;"><label> Passengers <label></th>
					<td style="border-top:0px;"><input type="Number" name="psg" class="input-block-level input-small" min="1" max="6" placeholder="1 to 6" required></td>
				</tr>
				<tr>
					<td style="border-top:0px;"><input class="btn btn-primary" type="submit" value="FIND"></td>
					<td style="border-top:0px;"><a href="reservation.php" class="btn btn-info" type="reset" value="Reset">Reset</a></td>
				</tr>
			</table>
			</form>
			</div>
			
		<!-- display train -->
			<div class="span8 well">
				<div class="display" style="height:30px;">
				<table class="table">
				<tr>
					<th style="width:90px;border-top:0px;"> Train No.</th>
					<th style="width:140px;border-top:0px;"> Train Name </th>
					<th style="width:90px;border-top:0px;"> From </th>
					<th style="width:90px;border-top:0px;"> Arrival </th>
					<th style="width:90px;border-top:0px;"> To </th>
					<th style="width:90px;border-top:0px;"> Arrival </th>
					<th style="width:100px;border-top:0px;">Book Now</th>
				</tr>
				</table>
				</div>
				<div class="display" style="margin-top:0px;overflow:auto;">
				<table class="table">
				
				<?php  
					
					if($k==1)
					{
						
						echo "<script> document.getElementById(\"fr\").value=\"$from\";
									   document.getElementById(\"to1\").value=\"$to\";
									   
							</script>";
						$n=0;
						if(mysqli_num_rows($result) < 1)
					    {
					       echo "<div class=\"alert alert-error\"  style=\"margin:100px 180px;\"> No Trains Found... </div>";
					    }
						while($row=mysqli_fetch_array($result)){
					//$q="from: ".$from;
						if($from==$row['Origin'])
						{	$p1=$row['Arrival']; }
						if($to==$row['Destination'])
						{	$p2=$row['Departure'];}

						$ac_seats = $row['AC_cnt'];
						$sl_seats = $row['SL_cnt'];
						
						// $p1=substr($q,0,2);
						// $p2=substr($q,3,2);
						// $p2=$p2+5;
						// if($p2<10)
						// {$p2="0".$p2;}
						// $d=$p1.":".$p2;
					if($n%2==0)
					{
				
				?>
				<tr class="text-error">
					<td style="width:90px;"> <?php   echo $row['Number']; ?> </td>
					<td style="width:140px;"> <?php echo $row['Name']; ?> </a></td>
					<td style="width:90px;"> <?php echo $row['Origin']; ?> </td>
					<td style="width:90px;"> <?php   echo $p1; ?> </td>
					<td style="width:90px;"> <?php echo $row['Destination']; ?> </td>
					<td style="width:90px;"> <?php   echo $p2; ?> </td>
					<!-- <td style="width:90px;"> <?php   echo $ac_seats; ?> </td> -->
					<td style="width:100px;">  
						<a class="text-primary" href="reser.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn  ?>&psg=<?php echo $psg  ?>& seats=<?php echo $ac_seats ?> & doj=<?php echo $doj ?> &class=<?php echo "AC";?>"><b>AC</b></a> &nbsp; &nbsp;
						<a class="text-primary" href="reser.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn  ?>&psg=<?php echo $psg ?>& seats=<?php echo $sl_seats ?> & doj=<?php echo $doj ?>&class=<?php echo "SL";?>"><b>SL</b></a>
					</td>
					</tr>
				<?php  
					}
					else
					{
				?>
				<tr class="text-info">
					<td style="width:90px;"> <?php   echo $row['Number']; ?> </td>
					<td style="width:140px;"> <?php echo $row['Name']; ?> </a></td>
					<td style="width:90px;"> <?php echo $row['Origin']; ?> </td>
					<td style="width:90px;"> <?php   echo $p1; ?> </td>
					<td style="width:90px;"> <?php echo $row['Destination']; ?> </td>
					<td style="width:90px;"> <?php   echo $p2; ?> </td>
					<!-- <td style="width:65px;"> <?php  echo $d; ?> </td> -->
					<td style="width:200px;">
						<a class="text-primary" href="reser.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn  ?>&psg=<?php echo $psg ?>& seats=<?php echo $ac_seats ?> & doj=<?php echo $doj ?>&class=<?php echo "AC";?>"><b>AC</b> </a> &nbsp; &nbsp;
						<a class="text-primary" href="reser.php?tno=<?php echo$row['Number']?>&fromstn=<?php echo $fromstn ?>&tostn=<?php echo $tostn  ?>&psg=<?php echo $psg ?>& seats=<?php echo $sl_seats ?> & doj=<?php echo $doj ?>&class=<?php echo "SL";?>"><b>SL</b></a>
					</td>
				</tr>
				<?php  
					}
					$n++;
					}
				}
				else
				{
					echo "<div class=\"alert alert-error\"  style=\"margin:100px 180px;\"> Search for the train... </div>";
				}
					
					mysqli_close($conn);
				?> 
				</table>
				</div>
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