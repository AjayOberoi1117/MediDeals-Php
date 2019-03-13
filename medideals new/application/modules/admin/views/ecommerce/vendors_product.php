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
       
    </div>
</div>
			<center><h1> Show All Vendors Product List </h1></center>
			<br/>
			<div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Firm Name</th>
                                            <th>Firm Address</th>
                                            <th>Drug Licence</th>
                                            <th>Fssai No</th>
                                            <th>Contact No</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($record as $rowdata){ ?>
                                        <tr>
											<td><?php echo $rowdata->id;?></td>
                                            <td><?php echo $rowdata->name; ?></td>
                                            <td><?php echo $rowdata->email; ?></td>
                                            <td><?php echo $rowdata->firm_name; ?></td>
                                            <td><?php echo $rowdata->firm_address; ?></td>
                                            <td><?php echo $rowdata->drug_licence; ?></td>
                                            <td><?php echo $rowdata->fssai_no; ?></td>
                                            <td><?php echo $rowdata->contact_no; ?></td>
                                      <td><a href="<?php echo base_url().'admin/vendors/showvendors/'.$rowdata->id?>"class="btn btn-primary">Edit</a>
											<a href="<?php echo base_url().'admin/vendors/deletevendors/'.$rowdata->id?>"  class="btn btn-danger" class="btn btn-info">Delete</a></td>

										</td>
										</tr>
									<?php 
									} 
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
