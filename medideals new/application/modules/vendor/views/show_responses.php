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
			<center><h3>Vendor Responses to Customer Enquiries </h3></center>
			<br/>
		
        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
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
									<?php foreach($data as $rowdata){?> 
                                        <tr>
											<td><?php echo $rowdata['response_id'];?></td>
                                            <td><?php echo $rowdata['vendor_id']; ?></td>
											<td><?php echo $rowdata['vendor_email']; ?></td>
                                            <td><?php echo $rowdata['message']; ?></td>
                                            <td><?php echo $rowdata['date']; ?></td>
                                      
									 
									  
								
											<!--<a href="<?php //echo base_url().'admin/vendors/deletevendors/'.$rowdata->id?>"  class="btn btn-danger" class="btn btn-info">Delete</a></td>-->

										
										</tr>
									<?php 
									} 
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
    </div>
</div>
			
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
