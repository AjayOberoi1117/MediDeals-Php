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
        <div class="content">
            <form class="form-box" action="<?php echo base_url('admin/state/Savestate'); ?>" method="POST" enctype="multipart/form-data">
         
                    <div class="form-group">
                        
                        <input type="text" name="name" placeholder="State Name" value="" class="form-control">
                    </div>
                 
                
                
                <button type="submit" name="setProduct" class="btn btn-green">Submit</button>
            </form> 
        </div>
    </div>
</div>
<br/><br/>
				<div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>State Name</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($record as $rowdata){ ?>
                                        <tr>
											<td><?php echo $rowdata->state_id;?></td>
                                            <td><?php echo $rowdata->state_name; ?></td>
                                              <td><a href="<?php echo base_url().'admin/state/stateshow/'.$rowdata->state_id?>"class="btn btn-primary">Edit</a></td>
											<td><a href="<?php echo base_url().'admin/state/deletestate/'.$rowdata->state_id?>" class="btn btn-danger" class="btn btn-info">Delete</a></td>

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
