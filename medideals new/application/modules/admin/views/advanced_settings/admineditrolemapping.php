<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Edit User Role : <?php echo $name;?></h1> 
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
    <div class="clearfix"></div>
    <?php
	//var_dump($info);
	//var_dump($menu); die;
	$menuidarray = array();
	$menunamearray = array();
	$selectedmenuidarray = array();
	$seelectedmappingidarray =array();
	
	$j = 0;
	foreach ($info as $info1)
	{
		$selectedmenuidarray[$j] = $info1->menu_id;
		//$selectedmappingidarray[$j] = $info1->mapping_id;
		$j++;
	}
		
	$count = count($menu);	
	$i = 0;
	foreach ($menu as $menu1)
	{
		$menuidarray[$i] = $menu1->menu_id;
		$menunamearray[$i] = $menu1->menu_name;
		$i++;
	}
	
        ?>
        <div class="table-responsive">
		<form action="<?php echo base_url('admin/editroles');?>" method="post">
		<input type ="hidden" value="<?php echo $id;?>" name="roleid">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>Menu Items</th>
                    </tr>
                </thead>
                <?php for ($i = 0; $i < $count; $i++){ ?>
                    <tr>
                        <td>
						<?php if(in_array($menuidarray[$i], $selectedmenuidarray))
						{ ?>	
						<input type="checkbox" name="ch[]" value="<?php echo $menuidarray[$i];?>" checked="checked"> <?php echo $menunamearray[$i];  
						}
						else
						{ ?>
						<input type="checkbox" name="ch[]" value="<?php echo $menuidarray[$i];?>"> <?php echo $menunamearray[$i];	
						}
						?>			
						</td>
                    </tr>
                <?php }  ?>
            </table>
			<input type="submit" value ="Edit" name="submitrole">
		</form>
        </div>
 

    
</div>
