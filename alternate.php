<?php
session_start();
require('firstimport.php');

mysqli_select_db($conn,"$db_name") or die("cannot select db");
$k=0;
if(isset($_POST['byname']) && isset($_POST['bynum']))
{
	$k=1;
	$from=$_POST['byname'];
	$to=$_POST['bynum'];
	$dojj=$_POST['date'];

	$from=strtoupper($from);
	$to=strtoupper($to);
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
					<th style="border-top:0px;"><label><b>ALTERNATIVE ROUTE</label></th>
					<td id="mbox" style="border-top:0px;"> <label>From </label></td>
					<td style="border-top:0px;"><input  type="text" class="input-block-level" name="byname" id="byn" required></td>
					<td id="xbox" style="border-top:0px;"><label> To </label></td>
					<td style="border-top:0px;"><input id="xbox1" type="text" class="input-block-level" name="bynum" required></td>
					
					<td style="border-top:0px;"><label> Date<label></th>
					<td style="border-top:0px;"><input type="date" class="input-block-level input-medium" name="date" max="<?php echo date('Y-m-d',time()+60*60*24*90);?>" min="<?php echo date('Y-m-d')?>" value="<?php if(isset($_POST['date'])){echo $_POST['date'];}else {echo date('Y-m-d');}?>"> </td>

					<td style="border-top:0px;"><input class="btn btn-info" type="submit" value="Find Alternative"> </td>
					<!-- <td style="border-top:0px;"><a href="alternate.php" class="btn btn-info" type="reset" value="Reset">Reset</a></td> -->
				</tr>
			</table>
			</form>
		</div>
<!-- display result -->
		<div class="span12 well">
			<div class="display" style="margin-top:0px;overflow:auto;">
				<table class="table" border="2px">
				<tr>
					<th style="width:50px;border-top:0px;"> Train No.</th>
					<th style="width:200px;border-top:0px;"> Possible Alternative and Direct Routes </th>
					<th style="width:50px;border-top:0px;"> Via </th>
				</tr>
				<!-- </table> -->
	

<!-- ///////////////////////////////////////////////////////////////////////////////////////////// -->

<!-- <div class="display" style="margin-top:0px;overflow:auto;"> -->
	<!-- <table class="table" > -->

<?php
if($k==1){
	echo "<script> document.getElementById(\"byn\").value=\"$from\";
									   document.getElementById(\"xbox1\").value=\"$to\";
							</script>";
	$hosts = array();

	mysqli_select_db($conn,"$db_name") or die("cannot select db");
	$tbl_name = "interlist";
	$sql="SELECT * FROM $tbl_name WHERE doj='$dojj'";
	$result=mysqli_query($conn,$sql);
	$src = $from;
	$dest = $to;

	$jagah = array();
	while($row=mysqli_fetch_array($result))
	{
	    $train_number = $row['trainno'];
	    $str = $row['route'];

	    $stations = array();
	    $temp_s = "";
	    $flag=0;
	    $count=0;
	    
	    for($i=0;$i<strlen($str);$i++)
	    {
	        if($flag==1)
	        {
	            if($str[$i]==',')
	            {
	                $flag=0;
	                continue;
	            }
	            else continue;
	        }
	        if($str[$i]=='(')
	        {
	            array_push(
	                $stations,
	                $temp_s
	            );
	            $count++;
	            $temp_s="";
	            $flag=1;
	            continue;
	        }
	        $temp_s.=$str[$i];
	    }
	    foreach($stations as $pp => $kl)
	    {
	        $flagy=0;
	        foreach($jagah as $jksgk => $nkfs)
	        {
	            if($kl==$nkfs)
	            {
	                $flagy=1;
	                break;
	            }
	        }
	        if($flagy==0) array_push($jagah,$kl);
	    }
	    // print_r($stations);
	    // print_r($arr);
	    for($i=0;$i<$count;$i++)
	    {
	        for($j=$i+1;$j<$count;$j++)
	        {
	            $medd = $stations[$i]." ".$stations[$j];
	            if(!isset($hosts[$medd])) $hosts[$medd]=array();
	            $arr = $hosts[$medd];
	            array_push($arr , $train_number);
	            $hosts[$medd] = $arr;
	        }
	    }

	}
	
	$visited =array();

	$adj = $src." ".$dest;
	if(isset($hosts[$adj]))
	{
	    $arr1 = array();
	    foreach($hosts as $key => $val)
	    {
	        if($key==$adj)
	        {
	            foreach($hosts[$key] as $key2 => $value2)
	            {
	                array_push($arr1,$value2);
	                array_push($visited,$value2);
	            }
	        }
	    }

	    // print_r($arr1);
	    foreach ($arr1 as $key => $value) {

	    				$tbl_nameX="interlist";
						$sql1="SELECT DISTINCT * FROM $tbl_nameX WHERE trainno='$value' AND doj='$dojj'";	
						$result1=mysqli_query($conn,$sql1);

						$n=0;
						while($row1=mysqli_fetch_array($result1)){
						
					if($key%2==0)
					{
				?>
				<tr class="text-primary">
					<td style="width:50px;"><?php echo $row1['trainno']; ?> </td>
					<td style="width:200px;"> <?php echo $row1['route']; ?> </td>
					<td style="width:50px;"> <?php echo "Direct"; ?> </td>
				</tr>
				<?php
					}
					else if($key%2!=0)
					{
				?>
				<tr class="text-success">
					<td style="width:50px;"><?php echo $row1['trainno']; ?> </td>
					<td style="width:200px;"> <?php echo $row1['route']; ?> </td>
					<td style="width:50px;"> <?php echo "Direct"; ?> </td>
				</tr>
				<?php
					}
					$n++;
					}
	    }


	}
	// echo "<br>";
	// echo "------------------------";
	// echo "<br>";


	foreach($jagah as $pll=>$kllk)
	{
	    $intermediate = $kllk;

	    $check1 = $src." ".$intermediate;
	    $check2 = $intermediate." ".$dest;

	    $arr1 = array();
	    $arr2 = array();
	    $cc1 = 0;
	    $cc2 = 0;
	    foreach ($hosts as $key => $val) 
	    {
	        if($check1 == $key) 
	        {
	            foreach($hosts[$key] as $key2=>$value2)
	            {
	                array_push($arr1 , $value2);
	            }
	            $cc1++;
	        }
	        if($check2 == $key) 
	        {
	            foreach($hosts[$key] as $key2=>$value2)
	            {
	                array_push($arr2 , $value2);
	            }
	            $cc2++;
	        }
	        
	    }

	    if($cc1!=0&&$cc2!=0)
	    {
	        for($i=0;$i<sizeof($arr1);$i++)
	        {
	            for($j=0;$j<sizeof($arr2);$j++)
	            {
	                
	                if($arr1[$i]==$arr2[$j])
	                {
	                    $fll = 0;
	                    foreach($visited as $kk => $vv )
	                    {
	                        if($arr1[$i]==$vv)
	                        {
	                            $fll=1;
	                            break;
	                        }
	                    }
	                    if($fll==1) continue;
	                    array_push($visited,$arr1[$i]);

	                    // echo $arr1[$i]." ".$arr2[$j];
	                    // echo "<br>";

	                    $tbl_nameX="interlist";
						$sql11="SELECT DISTINCT * FROM $tbl_nameX WHERE trainno='$arr1[$i]' AND doj='$dojj'";	
						$result11=mysqli_query($conn,$sql11);

						$n=0;
						while($row11=mysqli_fetch_array($result11)){
						
					if($n%2==0)
					{
				?>
				<tr class="text-error">
					<td style="width:50px;"><?php echo $row11['trainno']; ?> </td>
					<td style="width:200px;"> <?php echo $row11['route']; ?> </td>
					<td style="width:50px;"> <?php echo "Direct"; ?> </td>
				</tr>
				<?php
					}
					else if($n%2!=0)
					{
				?>
				<tr class="text-info">
					<td style="width:50px;"><?php echo $row11['trainno']; ?> </td>
					<td style="width:200px;"> <?php echo $row11['route']; ?> </td>
					<td style="width:50px;"> <?php echo "Direct"; ?> </td>
				</tr>
				<?php
					}
					$n++;
					}

	                    continue;
	                }
	                // echo $arr1[$i]." ".$arr2[$j];
	                // echo "<br>";
	                $string1 = "";
	                $string2 = "";
	                $tbl_name2 = "interlist";
	                $sql2="SELECT * FROM $tbl_name2 WHERE doj='$dojj'";
	                $result2=mysqli_query($conn,$sql2);

	                while($row2=mysqli_fetch_array($result2))
	                {
	                    if($row2['trainno']==$arr1[$i])
	                    {
	                        $string1 = $row2['route'];
	                    }
	                }

	                $tbl_name3 = "interlist";
	                $sql3="SELECT * FROM $tbl_name3 WHERE doj='$dojj'";
	                $result3=mysqli_query($conn,$sql3);

	                while($row3=mysqli_fetch_array($result3))
	                {
	                    if($row3['trainno']==$arr2[$j])
	                    {
	                        $string2 = $row3['route'];
	                    }
	                }
	                
	                // echo $string1;
	                // echo "<br>";
	                // echo $string2;
	                // echo "<br>";

	                $time_a1 = "";
	                $time_d1 = "";
	                $time_a2 = "";
	                $time_d2 = "";

	                $temp_s1 = "";
	                $flag1=0;
	                $count1=0;
	                
	                for($i1=0;$i1<strlen($string1);$i1++)
	                {
	                    if($flag1==1)
	                    {
	                        if($string1[$i1]==',')
	                        {
	                            $flag1=0;
	                            continue;
	                        }
	                        else continue;
	                    }
	                    if($string1[$i1]=='(')
	                    {
	                        if($temp_s1 == $intermediate) 
	                        {
	                            for($j1=$i1+1;$j1<=$i1+5;$j1++)
	                            {
	                                $time_a1.=$string1[$j1];
	                            }
	                            for($j1=$i1+7;$j1<=$i1+11;$j1++)
	                            {
	                                $time_d1.=$string1[$j1];
	                            }
	                        }
	                        if($temp_s1 == $intermediate) break;
	                        $count1++;
	                        $temp_s1="";
	                        $flag1=1;
	                        continue;
	                    }
	                    $temp_s1.=$string1[$i1];
	                }



	                $temp_s3 = "";
	                $flag3=0;
	                $count3=0;
	                
	                for($i2=0;$i2<strlen($string2);$i2++)
	                {
	                    if($flag3==1)
	                    {
	                        if($string2[$i2]==',')
	                        {
	                            $flag3=0;
	                            continue;
	                        }
	                        else continue;
	                    }
	                    if($string2[$i2]=='(')
	                    {
	                        if($temp_s3 == $intermediate) 
	                        {
	                            for($j2=$i2+1;$j2<=$i2+5;$j2++)
	                            {
	                                $time_a2.=$string2[$j2];
	                            }
	                            for($j2=$i2+7;$j2<=$i2+11;$j2++)
	                            {
	                                $time_d2.=$string2[$j2];
	                            }
	                        }
	                        if($temp_s3 == $intermediate) break;
	                        $count3++;
	                        $temp_s3="";
	                        $flag3=1;
	                        continue;
	                    }
	                    $temp_s3.=$string2[$i2];
	                }
	                

	                if($time_a1<$time_d2)
	                {
	                    // echo $arr1[$i]." ".$arr2[$j];
	                    // echo "<br>";
	                    // echo $time_a1." ".$time_d1." ".$time_a2." ".$time_d2." ".$intermediate;
	                    // echo "<br>";

// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^
						$tbl_nameX="interlist";
						$sql1="SELECT DISTINCT * FROM $tbl_nameX WHERE trainno='$arr1[$i]' AND doj='$dojj'";	
						$result1=mysqli_query($conn,$sql1);

						$n=0;
						while($row1=mysqli_fetch_array($result1)){

				?>
				<tr class="text-warning">
					<td style="width:50px;"><?php echo $row1['trainno']; ?> </td>
					<td style="width:200px;"> <?php echo $row1['route']; ?> </td>
					<td style="width:50px;"> <?php echo $intermediate; ?> </td>
					<!-- <td style="width:50px;"> <?php echo $row1['Origin']; ?> </td>
					<td style="width:50px;"> <?php echo $row1['Destination']; ?> </td>
					<td style="width:50px;"> <?php echo $row1['Arrival']; ?> </td>
					<td style="width:50px;"> <?php echo $row1['Departure']; ?> </td> -->
				</tr>
				<?php

				?>
				<?php

				}
// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^


// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^
						$sql2="SELECT DISTINCT * FROM $tbl_nameX WHERE trainno='$arr2[$j]' AND doj='$dojj'";	
						$result2=mysqli_query($conn,$sql2);

						$n=0;
						while($row2=mysqli_fetch_array($result2)){

				?>
				<tr class="text-warning">
					<td style="width:50px;"><?php echo $row2['trainno']; ?> </td>
					<td style="width:200px;"> <?php echo $row2['route']; ?> </td>
					<td style="width:50px;"> <?php ; ?> </td>
					<!-- <td style="width:50px;"> <?php echo $row1['Origin']; ?> </td>
					<td style="width:50px;"> <?php echo $row1['Destination']; ?> </td>
					<td style="width:50px;"> <?php echo $row1['Arrival']; ?> </td>
					<td style="width:50px;"> <?php echo $row1['Departure']; ?> </td> -->
				</tr>
				<?php
				?>
				<?php

					}
// ^^^^^^^^^^^^^^^^^^^^^^^^^^^^



	                }
	            }
	        }
	    }
	    else continue;
	}
}

else
{
    echo "<div class=\"alert alert-error\"  style=\"margin:100px 350px;\"> Search for the train... </div>";
}
mysqli_close($conn);

?>
<!-- //////////////////////////////////////////////////////////////////////////////////////////////////////  -->

</table>
</div>

			</div>
		<!-- </div> -->
		
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