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
            <form class="form-box" action="<?php echo site_url('vendor/Addproduct/save_location');?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
             <input type="hidden" name="vendor_id" value="<?php echo $vendorid; ?>"/>
            
			<p><b>Note: </b> Leave this section blank if you can ship your products all over India,
			    If you can ship your products to some particulate cities or states please select them from the list below.
			</p>	
			    <a style="color:#fff;" class="btn btn-green" href="<?php echo base_url();?>vendor/products" >Skip</a>
            <br><br>
                     <div class="form-group">
					
                    <select name="state[]"  id="state">
					 <option value="">Select state first</option>
                    <?php foreach($states as $state) {?>
                       <option value="<?php echo $state->id; ?>"><?php echo $state->state; ?> </option>
                       <?php }?>
                    </select>
                   
                </div>
                <div class="form-group">
			<select id="city" multiple="multiple" name="city[]">
				<option value="">Select state first</option>
			</select>
							</div>
                <button type="submit" name="setProduct" class="btn btn-green">Add</button>
            </form> 
        </div>
               
    </div>
</div>
<!-- Modal Upload More Images -->
<script type="text/javascript">
$(document).ready(function(){
  
    $('#state').on('change',function(){
        var stateID = $(this).val();
		//alert(stateID);
        if(stateID){
            $.ajax({
                type:'POST',
                url:'<?php echo site_url('vendor/Addproduct/find_city');?>',
                data:'state_id='+stateID,
                success:function(data){
				console.log(data);
                    $('#city').html(data);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select city first</option>'); 
        }
    });
});
</script>

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
