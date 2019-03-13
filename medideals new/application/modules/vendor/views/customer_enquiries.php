<?php
if ($this->session->flashdata('result_delete')) {
    ?> 
    <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div> 
    <?php
}
?>

<body>




<form id="asd" action="<?php echo base_url('vendor/Products/customer_enquiriesinsert')?>" method="POST">
  
 <center><table>
  <h3> Customer Enquiries Form</h3>
  
  <tr "rowpadding=10px">

  <td><input type="hidden" name="vendor_id" value="<?php echo $_SESSION['vendor_id']?>" placeholder="<?= lang('email') ?>" class="form-control">  </td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
  
  
  
  
  <tr>
  <td><strong>Vendor Email :</strong></td>
  <td><input type="text" name="vendor_email"  id="ln"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
  
  
  <tr>
  <td><strong>Message :</strong></td>
  <td><textarea name="message"  id="ln1"  required style="height:70px;"></textarea></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>

  
  
  


  
  
  <tr>
  </tr>
  
  <tr>
  <td colspan="2"><center><input type="submit" id="submit" value="SUBMIT" width="20px"></center></td>
  </tr>
 
 </table>
 </center>
  
</form>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

  window.onload = function() {

    document.getElementById("asd").style.display = "block";

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
			document.getElementById("ln1").value = val;
		}

	</script>
	