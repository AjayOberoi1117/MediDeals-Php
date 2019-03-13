<?php
    $timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <h1 class="text-center">Subscription Requests</h1>
    <div class="col-md-12">
        <?php
            if ($this->session->flashdata('result_publish')) {
        ?>
        <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
        <?php
            }
        ?>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover dataTable js-exportable body">
                <thead>
                <tr>
                    <th>Vendor Email</th>
                    <th>Payment Mode</th>
                    <th>UTR No.</th>
                   
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>

                </tr>
                                </thead>
                <tbody>
                    <?php foreach($sub as $rowdata){?>
                <tr>
                    <td><?php echo $rowdata['vendor_email'];?></td>
                    <td><?php echo $rowdata['mode_payment']; ?></td>
                    <td><?php echo $rowdata['utr_no']; ?></td>
                   
                    <td><?php echo $rowdata['start_date']; ?></td>
                    <td><?php echo $rowdata['end_date']; ?></td>
                    <td><?php if($rowdata['status']==0){?>
                        <a href="<?=base_url('admin/update_subs_status/1/'.$rowdata['vendor_id'])?>" style="color:#000" class="btn btn-danger">Activate</a>
                        <?php }else{?>
                        <a href="<?=base_url('admin/update_subs_status/0/'.$rowdata['vendor_id'])?>" style="color:#000" class="btn btn-danger">Deactivate</a>
                        <?php }?>
                    </td>



                    <!--<a href=" //echo base_url().'admin/vendors/deletevendors/'.$rowdata->id"  class="btn btn-danger" class="btn btn-info">Delete</a></td> //echo base_url().'admin/vendors/deletevendors/'.$rowdata->id"  class="btn btn-danger" class="btn btn-info">Delete</a></td>-->
                    
                </tr>
                <?php
                        
                    } 
                ?>
                                </tbody>
            </table>
			 <?= $links_pagination ?>
        </div>
        
    </div>
	
</div>

<!-- Modal Upload More Images -->
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
