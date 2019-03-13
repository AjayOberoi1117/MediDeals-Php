<?php
    $timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <h3 class="text-center">Show Bank Details </h3>
    <div class="col-md-12">
        <?php
            if ($this->session->flashdata('result_publish')) {
        ?>
        <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
        <?php
            }
        ?>
        <?php
            $timeNow = time();
        ?>
        <script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
        <div class="row">
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
                            <?php foreach($bankdetails as $rowdata){?>
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
    </div>
</div>

<!-- Modal Upload More Images -->
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
