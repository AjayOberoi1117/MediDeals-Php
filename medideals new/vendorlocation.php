<?php 
//session_start();
//echo $_GET['vendor_id'];
//echo $_GET['product_id'];
$con = mysqli_connect("localhost","medi","medi@india","medi");
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(isset($_REQUEST))
{
	//var_dump($_REQUEST);
	if($_REQUEST['state_id'] != "" && $_REQUEST['city_id'] != "")
	{
		$query = "delete from vendor_business_location where state_name = '".$_REQUEST['state_id']."' and city_name = '".$_REQUEST['city_id']."' and 
		vendor_id = '".$_REQUEST['vendor_id']."' and product_id = '".$_REQUEST['product_id']."'";
		// vendor id aur product id bhi lagegi
		mysqli_query($con, $query);
	}
	else if($_REQUEST['state_id'] != "" && $_REQUEST['city_id'] == "")
	{
		  $query = "delete from vendor_business_location where state_name = '".$_REQUEST['state_id']."'and 
		vendor_id = '".$_REQUEST['vendor_id']."' and 
		product_id = '".$_REQUEST['product_id']."'";
		// vendor id aur product id bhi lagegi
		mysqli_query($con, $query);
	}
}
 "<br>";
	 $x1="SELECT DISTINCT(vendor_business_location.state_name),states.state as STATE FROM vendor_business_location
	INNER JOIN states ON vendor_business_location.state_name = states.id
	WHERE vendor_id = '".$_REQUEST['vendor_id']."'  and 
		product_id = '".$_REQUEST['product_id']."'";
	$y1=mysqli_query($con, $x1);
	if($y1->num_rows != 0)
	{	
		//var_dump($z1=mysqli_fetch_array($y1));
		while($z1=mysqli_fetch_array($y1))
		{
			?> State - 
			<span class ="btn"><?php echo $z1['STATE'];?></span>
			<button class='btn' onclick ='del("<?php echo $z1['state_name'];?>","")'>
			<i class='fa fa-trash'></i></button>
			<br>
			<br>
			<?php
			$x2="SELECT city_name FROM vendor_business_location WHERE vendor_id = '".$_REQUEST['vendor_id']."' && state_name = '".$z1['state_name']."'
			and product_id = '".$_REQUEST['product_id']."'";
			$y2=mysqli_query($con, $x2);
			//var_dump($z1=mysqli_fetch_array($y1));
			echo "Cities - ";
			while($z2=mysqli_fetch_array($y2))
			{
				?>
				<span class ="btn"><?php echo $z2['city_name'];?></span>
				<button class='btn' onclick ='del("<?php echo $z1['state_name'];?>","<?php echo $z2['city_name'];?>")'>
				<i class='fa fa-trash'></i></button>
				<?php
			}
		echo "<br>";
		echo "<br>";
		}	
	}
	else{
		echo "<p> Please add a location first or if you can ship your product to all over India please left this field blank.</p>";
	}	
?>