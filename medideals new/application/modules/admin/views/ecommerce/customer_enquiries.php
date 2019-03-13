<?php
    $timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">

    <h1 class="text-center"> Fetch All Customer Enquiries </h1>

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
                    <th>Enquiry_Id</th>
                    <th>Vendor Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                    </thead>
                <tbody>
                    <?php foreach($customerenquiries as $rowdata){?>
                <tr>
                    <td><?php echo $rowdata['enquiry_id'];?></td>
                    <td><?php echo $rowdata['vendor_email']; ?></td>
                    <td><?php echo $rowdata['message']; ?></td>
                    <td><?php echo $rowdata['date']; ?></td>
                    <td><?php
                        if($rowdata['status']==0){
                        ?>
                        <form action="<?php echo base_url('admin/response_customer');?>" method="post">
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="email" value="<?php echo $rowdata['vendor_email'];?>">
                            <input type="hidden" name="vendor_id" value="<?php echo $rowdata['vendor_id'];?>">
                            <input type="hidden" name="enquiry_id" value="<?php echo $rowdata['enquiry_id'];?>">
                            <input type="submit" name="sub" value="Respond to Enquiry" width="200px">
                            <?php
                                
                                echo "</form>";
                                }else{
                            ?>
										  Responded
                            <?php }?>
                    </td>
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
