<?php
$timeNow = time();
?>
<a href="<?php echo base_url('/vendor/orders');?>" style="color:#00CC99;">Go Back</a>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">

    <div class="col-md-6 col-md-offset-3">
       
        <?php
		//print_r($data);
        if ($this->session->flashdata('result_publish')) {
            ?> 
            <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div> 
            <?php
        }
        ?>
        
        <div class="content">
     
            <form class="form-box" action="<?php echo base_url('vendor/orders/Save_docket_db'); ?>" method="POST" enctype="multipart/form-data">
         

                 
                    <div class="form-group">
                        <input type="hidden" name="order_id" placeholder="Order Number" value="<?php echo $order_number;?>" class="form-control">
                        <?php foreach($docket_no as $docket)
						{
						
						 ?>
                        <input type="text" name="docket_number" placeholder="Docket Number" value="<?php echo $docket['docket_number']; ?>" class="form-control" required>
                        <?php }?>
                    </div>
                 
                
                
                <button type="submit" name="setDocket" class="btn btn-green">Submit</button>
            </form> 
        </div>
    </div>
</div>
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
