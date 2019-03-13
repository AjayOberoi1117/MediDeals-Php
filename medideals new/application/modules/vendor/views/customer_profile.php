 <?php
$timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <div class="col-md-6 col-md-offset-3">
  
        <div class="content">
        <?php //var_dump($profile);die;?>
              <form class="form-box" action="<?php echo base_url('vendor/updateprofile'); ?>" method="POST" enctype="multipart/form-data">
            
                  Business Name <input type="hidden" name="u_name" placeholder="Username" class="form-control" value="<?php echo $profile['name']; ?>">
                   <input type="text" name="firm_name" placeholder="Firm Name" class="form-control" value="<?php echo $profile['firm_name']; ?>">
                  <?php 
					$address = explode("#@%",$profile['firm_address']);
					//var_dump($address);die();
					
					?>
                        <span>Shop No./ Plot No.</span>
                        <input type="text" name="firm_address1" placeholder="Shop No./ Plot No." value="<?php echo $address[0];?>" class="form-control"> 
   
						<span>Street Name</span>
                        <input type="text" name="firm_address2" placeholder="Street Name" value="<?php echo $address[1];?>" class="form-control">

                        <span>City</span>
                        <input type="text" name="firm_address3" placeholder="City" value="<?php echo $address[2];?>" class="form-control">
                    
                   Drug Licence<input type="text" name="d_number" placeholder="Drug Licence Number" class="form-control" value="<?php echo $profile['drug_licence']; ?>">
                   FSSAI Number<input type="text" name="f_number" placeholder="FSSAI Number" class="form-control" value="<?php echo $profile['fssai_no']; ?>">
				   GST Number<input type="text" name="gst_number" placeholder="Contact Number" class="form-control" value="<?php echo $profile['gst_number']; ?>">
				   Contact Number<input type="text" name="con_number" placeholder="Contact Number" class="form-control" value="<?php echo $profile['contact_no']; ?>">
				   Website URL<input type="text" name="website_url" placeholder="Website URL, If any" class="form-control" value="<?php echo $profile['website_url']; ?>">
				   User Type <br><br><input type = "text" name="user_type" value="<?php echo $profile['user_type']; ?>" selected style="width:100%;" disabled="disabled">
                   <br><br>
                    User Email<input type="text" name="u_email" value="<?php echo $_SESSION['logged_vendor']?>" placeholder="<?= lang('email') ?>" class="form-control" disabled="disabled">
                    <input type="password" name="u_password" placeholder=" Click hear to change password " class="form-control">
                   
                    <input type="submit" name="register" class="login submit" value="Update" class="form-control">
                    
                </form>
        </div>
    </div>
</div>
<!-- Modal Upload More Images -->
<div class="modal fade" id="modalMoreImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('vendor_up_more_imgs') ?></h4>
            </div>
            
            
        </div>
    </div>
</div>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>