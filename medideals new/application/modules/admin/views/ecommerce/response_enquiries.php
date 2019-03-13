<?php
$timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <div class="col-md-8 col-md-offset-3">
        <?php
        if ($this->session->flashdata('result_publish')) {
            ?> 
            <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div> 
            <?php
        }
        ?>
			<center><h1>Respond to Customers Enquiry</h1></center>
			<br/>
		
        <div class="body">
		<form id="asd" action="<?php echo base_url('admin/update_cust_enq_status')?>" method="POST">
  
 <center><table>
  
  <tr "rowpadding=10px">
  <?php
  //var_dump($data); die;
  //foreach($data as $er)
  //{
	 // var_dump($er); die;
  ?>
  <td><strong></strong></td>
  <td>
  <input type="hidden" name="vendor_id"  id="fn" value="<?php echo $data['vendor_id'];?>">
  <input type="hidden" name="enquiry_id"  id="fn" value="<?php echo $data['enquiry_id'];?>">
  <input type="hidden" name="status"  id="fn" value="<?php echo $data['status'];?>">
  <input type="hidden" name="vendor_email"  id="fn" value="<?php echo $data['vendor_email'];?>">
  </td>
  </tr>
  <?php //} ?>
  <tr>
    <td>
       Customer Email : <?php echo $data['vendor_email'];?>
    </td>
</tr>
  
  <tr>
  <td><strong>Write Response</strong>
  <textarea name="message"  id="fn"></textarea>
  </td>
  </tr>
  
  <tr>
  <td colspan="2"><center><input type="submit" id="submit" value="SUBMIT" width="20px"></center></td>
  </tr>
 
 </table>
 </center>
  
</form>
		
		</div>
    </div>
</div>
			
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
