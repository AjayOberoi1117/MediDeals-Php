<?php
    $timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">

    <h1 class="text-center">Admin  Enquiries </h1>

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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Message</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($showenquory as $rowdata){?>
                <tr>
                    <td><?php echo $rowdata['id'];?></td>
                    <td><?php echo $rowdata['name']; ?></td>
                    <td><?php echo $rowdata['email']; ?></td>
                    <td><?php echo $rowdata['contact']; ?></td>
                    <td><?php echo $rowdata['message']; ?></td>

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
