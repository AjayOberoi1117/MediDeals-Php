<?php
$timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php
        if ($this->session->flashdata('result_publish')) {
            ?> 
            <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div> 
            <?php
        }
        ?>
			<center><h1> Fetch All Vendors List </h1></center>
			<br/>
		<?php foreach($record as $values){?> 
        <div class="content">
            <form class="form-box" action="<?php echo base_url('admin/vendors/updatevendors/'.$values->id); ?>" method="POST" enctype="multipart/form-data">
         
                 
         
                    <div class="form-group"> 
                        <span>Alias Name</span>
                        <input type="text" name="name" placeholder=" Name" value="<?php echo $values->name;?>" class="form-control">
                    </div> 
					<div class="form-group"> 
                      <span>Email</span> 
                        <input type="text" name="email" placeholder=" Email" value="<?php echo $values->email;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>Business Name</span>
                        <input type="text" name="firm_name" placeholder=" firm name" value="<?php echo $values->firm_name;?>" class="form-control">
                    </div>
					<?php 
					$address = explode("#@%",$values->firm_address);
					?>
					<div class="form-group"> 
                        <span>Shop No./ Plot No.</span>
                        <input type="text" name="firm_address1" placeholder="Shop No./ Plot No." value="<?php echo $address[0];?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>Street Name</span>
                        <input type="text" name="firm_address2" placeholder="Street Name" value="<?php echo $address[1];?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>City</span>
                        <input type="text" name="firm_address3" placeholder="City" value="<?php echo $address[2];?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>Drug License</span>
                        <input type="text" name="drug_licence" placeholder="drug license" value="<?php echo $values->drug_licence;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>FSSAI No</span>
                        <input type="text" name="fssai_no" placeholder="fssia no" value="<?php echo $values->fssai_no;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>Contact Number</span>
                        <input type="text" name="contact_no" placeholder="contact no" value="<?php echo $values->contact_no;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>GST Number</span>
                        <input type="text" name="gst_number" placeholder="GST Number" value="<?php echo $values->gst_number;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>User Type</span>
                        <input type="text" name="user_type" placeholder="User Type - Retailer/Wholeseller" value="<?php echo $values->user_type;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>Website URL</span>
                        <input type="text" name="website_url" placeholder="Website URL, If any" value="<?php echo $values->website_url;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span> Change Password</span>
                        <input type="text" name="password" placeholder=" Change password" value="<?php echo $values->password;?>" class="form-control">
                    </div>
                 
                
                
                <button type="submit" name="setProduct" class="btn btn-green">Update</button>
            </form> 
        </div>
    </div>
</div>
				<?php
}
?>
			
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
