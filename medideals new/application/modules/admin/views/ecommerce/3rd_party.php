<?php
    $timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <div class="col-md-12">
        <?php
            if ($this->session->flashdata('result_publish')) {
        ?>
        <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
        <?php
            }
        ?>

        <h1 class="text-center">Third Party MFG</h1>

        <form id="asd" action="<?php echo base_url('admin/third_party_register')?>" method="POST" enctype="multipart/form-data">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Name:</label>
                    <input type="text" name="Thirdparty_name" class="form-control" type="text" id="ln">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Address:</label>
                    <input type="text" name="Thirdparty_address" id="ln1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Company State:</label>
                    <select name="Thirdparty_state" id="pcd_state" class="chosen selectpicker form-control" required>
                        <option value="none">Select State</option>
                        <?php
                            foreach ($states as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['state']."</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Company City:</label>
                    <div id="pcd_city_new">
                        <select name="Thirdparty_city" id="pcd_city" class="chosen selectpicker form-control" required>
                            <option value="none">Select city</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Images:</label>
                    <input type="file" name="Thirdparty_image" id="ln2" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Description:</label>
                    <input type="text" name="Thirdparty_description" id="ln1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Phone:</label>
                    <input type="number" name="Thirdparty_phone" id="ln1" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Company Position : ( Please check the position before inserting, if position exists data will not be inserted)</label>
                    <input type="text" name="Thirdparty_position" id="ln1" class="form-control">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Company Date:</label>
                    <input type="date" name="Thirdparty_date" id="ln2" required class="form-control">
                </div>
            </div>

            <div class="col-md-12 text-center">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                </div>
            </div>
        </form>
        </div>
    <div class="col-md-12">
        <h1 class="text-center"> List of all Third Party MFG </h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover dataTable js-exportable body">
                <thead>
                <tr>
                    <th>Image</th>
                    <th> Name</th>
                    <th>Description</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>State</th>
                    <!--<th>Status</th>-->
                    <th>Position</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($thirdparty as $rowdata){?>
                <tr>
                    <td><img src="<?php echo base_url();?>upload_pic/<?php echo $rowdata['Thirdparty_image'];?>" width="80" height="80"></td>
                    <td><?php echo $rowdata['Thirdparty_name'];?></td>
                    <td><?php echo $rowdata['Thirdparty_description'];?></td>
                    <td><?php echo $rowdata['Thirdparty_address'];?></td>
                    <td><?php echo $rowdata['Thirdparty_phone'];?></td>
                    <td><?php echo $rowdata['name'];?></td>
                    <td><?php echo $rowdata['state'];?></td>
                    <!--<td><?php //echo $rowdata['Thirdparty_status'];?></td>-->
                    <td><?php echo $rowdata['Thirdparty_position'];?></td>
                    <td><?php echo $rowdata['Thirdparty_date'];?></td>
                    <td><?php if(@$rowdata['Thirdparty_status']==0){?>
                        <!--<a href="<?//=base_url('admin/update_subs_status/'.$rowdata['Thirdparty_id'])?>" class="btn btn-danger">Activate</a>-->
                        <a href="<?=base_url('admin/thirdparty_update/'.$rowdata['Thirdparty_id'])?>" class="btn btn-danger">Update</a>
                        <?php }else{?>
                        <!--<a href="<?//=base_url('admin/update_subs_status/'.$rowdata['Thirdparty_id'])?>" class="btn btn-danger">Deactivate</a>-->
                        <a href="<?=base_url('admin/thirdparty_update/'.$rowdata['Thirdparty_id'])?>" class="btn btn-danger">Update</a>
                        <?php }?>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
			<?= $links_pagination?>
        </div>
    </div>
</div>

<!-- Modal Upload More Images -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('change','#pcd_state',function()
        {
			
            var id = $('#pcd_state').val();
			
            $.ajax({
                url:'<?php echo base_url();?>admin/third_show_city',
                method:"POST",
                data:"id="+id,
                success: function(res)
                {
                    $('#pcd_city_new').html(res);
                }
            });
        })
</script>
