<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;">Create Roles</h1> 
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
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add New Role</a>
    <div class="clearfix"></div>
    <?php
    if ($users->result()) {
        ?>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Role Name</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php foreach ($users->result() as $roles) { ?>
                    <tr>
                        <td><?= $roles->role_id ?></td>
                        <td><?= $roles->role_name ?></td>
                        <td><? if($roles->status == 1)
                               echo "Active";
							   else
                               echo "Inactive";?>
						</td>
                        <td class="text-center">
                            <div>
                                <a style ="color:#000 !important" href="?delete=<?= $roles->role_id ?>" class="confirm-delete">Delete</a> | 
                                <a style ="color:#000 !important" href="?edit=<?= $roles->role_id ?>">Edit</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    <?php } else { ?>
        <div class="clearfix"></div><hr>
        <div class="alert alert-info">No users found!</div>
    <?php } ?>

    <!-- add edit users -->
    <div class="modal fade" id="add_edit_users" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add Roles</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">
                        <div class="form-group">
                            <label for="username">Role Name</label>
                            <input type="text" name="role_name" value="<?= isset($_POST['role_name']) ? $_POST['role_name'] : '' ?>" class="form-control" id="role_name">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
							<?php 
							@$status = isset($_POST['status']) ? $_POST['status'] : '';
							if($status == null || $status == ''){
								?>	
							<option value = "" checked="checked">Select</option>	
							<option value = "1">Active</option>	
							<option value = "0">Inactive</option>	
							<?php }
							else if($status == 1){	
							?>	
							<option value = "">Select</option>	
							<option value = "1" selected>Active</option>	
							<option value = "0">Inactive</option>	
							<?php }
							else if($status == 0){	
							?>	
							<option value = "">Select</option>	
							<option value = "1">Active</option>	
							<option value = "0" selected>Inactive</option>
							<?php }
							?>
							</select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <input type="submit" class="btn btn-primary" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
<?php if (isset($_GET['edit'])) { ?>
        $(document).ready(function () {
            $("#add_edit_users").modal('show');
        });
<?php } ?>
</script>