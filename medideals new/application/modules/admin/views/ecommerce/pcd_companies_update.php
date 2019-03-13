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
		 <body>
		 <?php foreach($data as $values){
			
			 ?>
<form id="asd" action="<?php echo base_url('admin/pcd_companies_update_details')?>" method="POST" enctype="multipart/form-data">
  
 <center><table>
  <h1>Update PCD COMPANIES</h1>
  
  
  
  
  
  
  <tr>
  <td><strong>Company Name:</strong></td>
  <td><input type="text" name="pcd_name"  id="ln"  required value="<?php echo $values->pcd_name ;?>" ></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
  <tr>
  <td><strong></strong></td>
  <td><input type="hidden" name="pcd_id"  id="ln"  required value="<?php echo $values->pcd_id ;?>" ></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
  
  
  <tr>
  <td><strong>Company Description :</strong></td>
  <td><input type="text" name="pcd_description"  id="ln1"  required value="<?php echo $values->pcd_description;?>"></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr> 
<tr>
  <td><strong>Company Address :</strong></td>
  <td><input type="text" name="pcd_address"  id="ln1"  required value="<?php echo $values->pcd_address;?>"></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong>Company Phone :</strong></td>
  <td><input type="number" name="pcd_phone"  id="ln1"  required value="<?php echo $values->pcd_phone;?>"></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong>Company Position : (Please check the position before update, if position exists data will not be updated)</strong></td>
  <td><input type="number" name="pcd_position"  id="ln1"  required value="<?php echo $values->pcd_position;?>">
  <input type="hidden" name="old_pcd_position" value="<?php echo $values->pcd_position;?>"></td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong>Company State:</strong></td>
  <td><select name="pcd_state" id="pcd_state"  required>
	<option value="<?= $values->pcd_state; ?>">Select State</option>
	 <?php
		
		foreach ($states as $key => $value) {
      echo "<option value='".$value['id']."'>".$value['state']."</option>";
        }
       ?>
								
	</select></td>
  </tr><tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr> <br/><br/><br/>
<tr>
  <td><strong>Company City:</strong></td>
  <td>
<span id="pcd_city_new">
  <select name="pcd_city" id="pcd_city" required>
	<option value="<?= $values->pcd_city; ?>">Select city</option>
	
								
	</select>
	</span>
	</td>
  </tr>
  <tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<tr>
  <td><strong>Company Date:</strong></td>
  <td><input type="date" name="pcd_date"  id="ln2"  required value="<?php echo $values->pcd_date;?>"></td>
  </tr><br/><tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>
<td><img src="/upload_pic/<?php echo $values->pcd_image;?>" width="80" height="80"></td>
<tr>
  <td><strong>Company Images:</strong></td>
  <td><input type="file" name="pcd_image"  id="ln2" ></td>
  </tr><br/><tr>
    <td>
        &nbsp;
        <!--you just need a space in a row-->
    </td>
</tr>

  
  
  
  <tr>
  </tr>
  
  <tr>
  <td colspan="2"><center><input type="submit" id="submit" value="UPDATE" width="20px"></center></td>
  </tr>
 
 </table>
 </center>
  
</form>
		<?php
}
?>
</body>
<br/>
<br/>
    </div>
</div>
			
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).on('change','#pcd_state',function()
    {
		var id = $('#pcd_state').val();
		
		$.ajax({
			url:'<?php echo base_url();?>admin/pcdcompanies_show_city',
			method:"POST",
			data:"id="+id,
			success: function(res)
			{
				$('#pcd_city_new').html(res);
			}
		});
	})
</script>
