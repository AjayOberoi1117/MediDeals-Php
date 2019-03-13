<?php
if ($this->session->flashdata('result_delete')) {
    ?> 
    <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div> 
    <?php
}
?>

<body>
<br/>
<h3>You have free subscribed for the service into three month. Your subscription Starts from  
<?php foreach($subscribe as $subs)
	 { 
		echo $subs->start_date." & End Date is ".$subs->end_date;
	 }	 
?></h3>
<br>
<br/>
<center>
<button type="button" onclick="get_val(500)" id="button1" value="Plan A">Plan 1<br/>
1 Month</button>
<button type="button" onclick="get_val(1200)" id="button2" value="Plan B">Plan 2<br/>
3 Month </button>
<button type="button" onclick="get_val(2000)" id="button3" value="Plan C">Plan 3<br/>
1 Year </button>
</center>


 
<!--<form id="asd" action="<?php //echo base_url('vendor/Products/Savestate')?>" method="POST">
  
 <center><table>
  <h1> Subscription Form</h1>
  
  <tr "rowpadding=10px">
  <td><strong>Mode Of Payment :</strong></td>
  <td><select name="mode_payment"  id="fn"  required>
  <option value="NEFT">NEFT</option>
  <option value="RTGS">RTGS</option>
  <option value="IMPS">IMPS</option>
  <option value="UPI">UPI</option>
  <option value="PAYTM">PAYTM</option>
  <option value="others">OTHERS</option>
  </td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row
    </td>
</tr>
  
  
  
  
  <tr>
  <td><strong>UTR No :</strong></td>
  <td><input type="text" name="utr_no"  id="ln"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row
    </td>
</tr>
  
  
  <!--<tr>
  <td><strong>Amount :</strong></td>
  <td><input type="text" name="amount"  id="ln1"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row
    </td>
</tr>
  <tr>
  <td><strong>Start Date :</strong></td>
  <td><input type="date" name="start_date" id="ln2" placeholder="MM/DD/YYYY" required></td>
  </tr>
   <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row
    </td>
</tr>
<tr>
  <td><strong></strong></td>
  <td><input type="hidden" name="vendor_email" value="<?php //echo $_SESSION['vendor_user']?>" placeholder="<?//= //lang('email') ?>" class="form-control">  </td>
  </tr><br/><tr>
    <td>
        &nbsp;
        <!--you just need a space in a row
    </td>
</tr>
<tr>
  <td><strong></strong></td>
  <td><input type="hidden" name="vendor_id" value="<?php //echo $_SESSION['vendor_id']?>" placeholder="<?//= //lang('id') ?>" class="form-control">  </td>
  </tr><br/><tr>
    <td>
        &nbsp;
        <!--you just need a space in a row
    </td>
</tr>
  
  
  
  <tr>
  </tr>
  
  <tr>
  <td colspan="2"><center><input type="submit" id="submit" value="SUBMIT" width="20px"></center></td>
  </tr>
 
 </table>
 </center>
  
</form>-->
</body>
<br/>
<br/>


</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

  window.onload = function() {

    document.getElementById("asd").style.display = "none";
	document.getElementsByClassName("page-titles").html = "<h2>Subscription</h2>";

  };

 /*  function asd(a) {
  
    if (a == 1) {
      document.getElementById("asd").style.display = "block";
    } else {
      document.getElementById("asd").style.display = "none";
    }
	} */
	
	function get_val(val)
	{
		document.getElementById("asd").style.display = "block";
		document.getElementById("ln1").value = val;
		/*var current_date = new Date();
		document.getElementById("ln2").value = (current_date.getMonth() + 1) + '/' + current_date.getDate() + '/' +  current_date.getFullYear();
		alert(current_date);
		var result = new Date();
		result.setDate(date.getDate() + duration);
		alert(result);*/
		
		//document.getElementById("ln2").value = val;
		//var result = new Date(duration);
	}
</script>
	