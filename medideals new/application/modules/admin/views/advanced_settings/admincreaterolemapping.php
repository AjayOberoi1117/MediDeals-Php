<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;">Map Menu with Role</h1> 
    <hr>
    <?php if (validation_errors()) { ?>
        <hr>
        <div class="alert alert-danger"><?= validation_errors() ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_add')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_add') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_delete')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    ?>
	<script type="text/javascript">
	function valid()
	{
		var role = document.getElementById("rolenam").value;
		alert(role);
		if(role == "" || role == null)
		{
			alert("Please select a Role");
			return false;
		}
		return true;
	}
	
	</script>

    <div class="clearfix"></div>
    <div>
                <form action="" method="POST" enctype="multipart/form-data" onsubmit="return valid()">
                        <div class="form-group">
                        <label for="username">Role Name</label>
                        <select name="rolename" class="form-control" id="rolenam">	
						<option value = "">Select</option>
						<?php foreach($rolename as $role)
						{?>	
						  <option value = "<?php echo $role->role_id;?>"><?php echo $role->role_name;?></option>	
						<?php
						} ?> 
						</select>
                        </div>
                        <div class="form-group">
                        <label for="status">Admin Menus</label><br>
						<?php foreach($menu as $menuitems)
						{?>	
						  <input type="checkbox" value = "<?php echo $menuitems->menu_id;?>" name="ch[]"> <b><?php echo $menuitems->menu_name;?> </b><br>
						<?php
						} ?> 	
						
                        </div>
                        <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Save" name="rolemap">
                  
                </form>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
	<p>&nbsp;&nbsp;</p>
    </div>
	
</div>
