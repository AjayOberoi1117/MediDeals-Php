<?php
if ($this->session->flashdata('result_delete')) {
    ?> 
    <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div> 
    <?php
}
?>

<body>
<br/>
<br/>

</center>


 
<form id="asd" action="<?php echo base_url('vendor/Products/Savebankdetails')?>" method="POST">
  
 <center><table>
  <h1> Bank Details Form</h1>
  
  
  
  
  
  
  <tr>
  <td><strong>Bank Name:</strong></td>
  <td><input type="text" name="bank_name"  id="ln"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
  
  
  <tr>
  <td><strong>Bank_Account :</strong></td>
  <td><input type="text" name="bank_account"  id="ln1"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr> 
<tr>
  <td><strong>Ifsc Code :</strong></td>
  <td><input type="text" name="ifsc_code"  id="ln1"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong>Bank Address :</strong></td>
  <td><input type="text" name="bank_address"  id="ln1"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong>Phone Number :</strong></td>
  <td><input type="number" name="phone_number"  id="ln1"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong>UPI Number:</strong></td>
  <td><input type="text" name="upi_number"  id="ln1"  required></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>

  
  
  <tr>
  <td><strong>Date :</strong></td>
  <td><input type="date" name="insert_date"  id="ln2"  required placeholder="MM/DD/YYYY"></td>
  </tr><br/><tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong></strong></td>
  <td><input type="hidden" name="firm_name" value="<?php echo $_SESSION['firm_name']?>" placeholder="<?= lang('email') ?>" class="form-control">  </td>
  </tr><br/><tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong></strong></td>
  <td><input type="hidden" name="vendor_id" value="<?php echo $_SESSION['vendor_id']?>" placeholder="<?= lang('id') ?>" class="form-control">  </td>
  </tr><br/><tr>
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
<br/>
<br/>
<center>
<h3>Show Bank Details </h3>
			<br/>
		
        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th> Id</th>
                                            <th>Bank Name</th>
                                            <th>Bank Account</th>
                                            <th>Ifsc Code</th>
                                            <th>Bank Address</th>
                                            <th>Phone Number</th>
                                            <th>Upi Number</th>
                                            <th>Insert Date</th>
                                            <th>Firm Name</th>
                                            <th>Vendor Id</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($data as $rowdata){?> 
                                        <tr>
											<td><?php echo $rowdata['id'];?></td>
                                            <td><?php echo $rowdata['bank_name']; ?></td>
											<td><?php echo $rowdata['bank_account']; ?></td>
                                            <td><?php echo $rowdata['ifsc_code']; ?></td>
                                            <td><?php echo $rowdata['bank_address']; ?></td>
                                            <td><?php echo $rowdata['phone_number']; ?></td>
                                            <td><?php echo $rowdata['upi_number']; ?></td>
                                            <td><?php echo $rowdata['insert_date']; ?></td>
                                            <td><?php echo $rowdata['firm_name']; ?></td>
                                            <td><?php echo $rowdata['vendor_id']; ?></td>
                                      
									 
									  
								
											<!--<a href="<?php //echo base_url().'admin/vendors/deletevendors/'.$rowdata->id?>"  class="btn btn-danger" class="btn btn-info">Delete</a></td>-->

										
										</tr>
									<?php 
									} 
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
	