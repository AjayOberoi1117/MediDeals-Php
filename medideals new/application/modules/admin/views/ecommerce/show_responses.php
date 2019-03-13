<?php
    $timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">

    <h1 class="text-center">Customer Enquiries </h1>

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
                    <th>Response Id</th>
                    <th>Vendor Id</th>
                    <th>Vendor Email</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($showresponses as $rowdata){?>
                <tr>
                    <td><?php echo $rowdata['response_id'];?></td>
                    <td><?php echo $rowdata['vendor_id']; ?></td>
                    <td><?php echo $rowdata['vendor_email']; ?></td>
                    <td><?php echo $rowdata['message']; ?></td>
                    <td><?php echo $rowdata['date']; ?></td>
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