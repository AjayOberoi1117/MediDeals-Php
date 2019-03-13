<?php 
$con = mysqli_connect("localhost","root","","test");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(isset($_REQUEST))
{
	var_dump($_REQUEST);
	if($_REQUEST['state_id'] != "" && $_REQUEST['city_id'] != "")
	{
		$query = "delete from demo where state_id = '".$_REQUEST['state_id']."' and 
		city_id = '".$_REQUEST['city_id']."'";
		// vendor id aur product id bhi lagegi
		mysqli_query($con, $query);
	}
	else if($_REQUEST['state_id'] != "" && $_REQUEST['city_id'] == "")
	{
		$query = "delete from demo where state_id = '".$_REQUEST['state_id']."'";
		// vendor id aur product id bhi lagegi
		mysqli_query($con, $query);
	}
}
echo "<br>";
	$x1="SELECT DISTINCT(state_id)FROM demo WHERE name = 'anurag'";
	$y1=mysqli_query($con, $x1);
	//var_dump($z1=mysqli_fetch_array($y1));
    while($z1=mysqli_fetch_array($y1))
	{
		?> State - 
		<span class ="btn"><?php echo $z1['state_id'];?></span>
		<button class='btn' onclick ='del("<?php echo $z1['state_id'];?>","")'>
		<i class='fa fa-trash'></i></button>
		<br>
		<br>
		<?php
		$x2="SELECT city_id FROM demo WHERE name = 'anurag' && state_id = '".$z1['state_id']."'";
		$y2=mysqli_query($con, $x2);
		//var_dump($z1=mysqli_fetch_array($y1));
		echo "Cities - ";
		while($z2=mysqli_fetch_array($y2))
		{
			?>
			<span class ="btn"><?php echo $z2['city_id'];?></span>
			<button class='btn' onclick ='del("<?php echo $z1['state_id'];?>","<?php echo $z2['city_id'];?>")'>
			<i class='fa fa-trash'></i></button>
			<?php
		}
	echo "<br>";
	echo "<br>";
	}	
		
?>