<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> User Roles</h1> 
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
    <a href="<?php echo base_url('admin/newrolemapping');?>" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add Role Mapping</a>
    <div class="clearfix"></div>
    <?php
	$rid = array(); $rname = array(); $menuitems = array();
	$i = 0;
	foreach ($roles as $role)
	{
		$rid[$i] = $role->role_id;
		$rname[$i] = $role->role_name;
		$i++; 
	}
	$count = count($rid);

	$k = 0;
	foreach($menuinfo as $menuinf)
	{
		$menuitems[$k] = $menuinf;
		$k++;
	}
	
	
        ?>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Roles</th>
                        <th>Menu Items</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php for ($i = 0; $i < $count; $i++) { ?>
                    <tr>
                        <td><?php echo $rid[$i]; ?></td>
                        <td><?php echo $rname[$i]; ?></td>
                        <td><?php foreach($menuitems[$i] as $menuinf)
						{
							echo $menuinf->menu_name.' , ';
						}	
						?></td>
                        <td class="text-center">
                            <div>
                                <!--<a style ="color:#000 !important" href="?delete=<?php //echo $rid[$i]; ?>" class="confirm-delete">Delete</a> | --> 
                                <a style ="color:#000 !important" href="<?php echo base_url("admin/showsinglerole/$rid[$i]/$rname[$i]");?>">Edit</a>
                            </div>
                        </td>
                    </tr>
                <?php }  ?>
            </table>
        </div>
 

    
</div>
