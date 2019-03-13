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
            <form class="form-box" action="<?php echo base_url('admin/city/Savecity'); ?>" method="POST" enctype="multipart/form-data">
         
          <div class="form-group">
                        
                       <select name="state_id"  class="form-control">
                       <?php foreach($states as $state) {?>
                       <option value="<?php echo $state->state_id; ?>"><?php echo $state->state_name; ?> </option>
                       <?php }?>
                       </select>
                    </div>
                 
         
                    <div class="form-group"> 
                        
                        <input type="text" name="city_name" placeholder="City Name" value="" class="form-control">
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
                                            <th>City Name</th>
                                            <th>State Name</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php $i=1;foreach($record as $rowdata){ ?>
                                        <tr>
											<td><?php echo $i;?></td>
                                            <td><?php echo $rowdata->city_name; ?></td>
                                            <td><?php echo $rowdata->state_name; ?></td>
                                      <td><a href="<?php echo base_url().'admin/city/cityshow/'.$rowdata->city_id.'/'.$rowdata->state_id?>"class="btn btn-primary">Edit</a></td>
											<td><a href="<?php echo base_url().'admin/city/deletecity/'.$rowdata->city_id?>" class="btn btn-danger" class="btn btn-info">Delete</a></td>

										</td>
										</tr>
									<?php 
									$i++;} 
									?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
