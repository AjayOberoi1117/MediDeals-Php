<div id="users">
    <h1><img src="<?= base_url('assets/imgs/admin-user.png') ?>" class="header-img" style="margin-top:-3px;"> Admin Users</h1> 
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
    <a href="javascript:void(0);" data-toggle="modal" data-target="#add_edit_users" class="btn btn-primary btn-xs pull-right" style="margin-bottom:10px;"><b>+</b> Add new user</a>
    <div class="clearfix"></div>
    <?php
	//var_dump($userroles); die;
    if ($users->result()) {
        ?>
        <div class="table-responsive">
            <table class="table table-striped custab">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Email</th>
                        <th>User Role</th>
						<!--<th>Last login</th>-->
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php foreach ($users->result() as $user) { ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->username ?></td>
                        <td><b>hidden ;)</b></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->role_name ?></td>
                        <!--<td><?//= date('d.m.Y - H:m:s', $user->last_login) ?></td>-->
                        <td class="text-center">
                            <div>
                                <a style ="color:#000 !important" href="?delete=<?= $user->id ?>" class="confirm-delete">Delete</a> | 
                                <a style ="color:#000 !important" href="?edit=<?= $user->id ?>">Edit</a>
                            </div>
                        </td>
                    </tr>
                <?php 
				
				} ?>
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
                        <h4 class="modal-title" id="myModalLabel">Add Users</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="edit" value="<?= isset($_GET['edit']) ? $_GET['edit'] : '0' ?>">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="" id="password">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>" id="email">
                        </div>
						<div class="form-group">
                            <label for="user_role">User Role</label>
							<select name="user_role" class="form-control" id="user_role">
								<option value="<?= isset($_POST['user_role']) ? $_POST['user_role'] : '0' ?>"><?= isset($_POST['role_name']) ? $_POST['role_name'] : 'Select' ?></option>
								<?php 
								if(isset($_POST['userroles']))
								{	
								foreach($_POST['userroles'] as $userrole)
									  {
										echo "<option value ='$userrole->role_id'>$userrole->role_name</option>" ; 
									  }
								}
								else
								{
								foreach($userroles as $userrole)
									  {
										echo "<option value ='$userrole->role_id'>$userrole->role_name</option>" ; 
									  }	
								}
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