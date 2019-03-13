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
        ?>	<?php  //foreach($record as $values){?>  
			
        <div class="content">
            <form class="form-box" action="<?php echo base_url('admin/city/updatecity/'.$this->uri->segment(4)); ?>" method="POST" enctype="multipart/form-data">
         
          <div class="form-group">
                        
                       <select name="state_id"  class="form-control" >
                       <?php  foreach($states as $state) {?>
                       <option value="<?php echo $state->state_id; ?>" <?php if($state->state_id==$this->uri->segment(5)){echo "selected";}?>><?php echo $state->state_name; ?> </option>
                       <?php }?>
                       </select>
                    </div>
                 
         
                    <div class="form-group"> 
                        
                        <input type="text" name="city_name" placeholder="City Name" value="<?php echo $records[0]->city_name;?>" class="form-control">
                    </div>
                 
                
                
                <button type="submit" name="setProduct" class="btn btn-green">Submit</button>
            </form> 
        </div>
    </div>
</div>
<?php
		//}
		?>


<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
