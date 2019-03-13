<div id="products">
    <?php
    if ($this->session->flashdata('result_delete')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div>
        <hr>
        <?php
    }
    if ($this->session->flashdata('result_publish')) {
        ?>
        <hr>
        <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
        <hr>
        <?php
    }
   
    ?>
    <h1><img src="<?= base_url('assets/imgs/products-img.png') ?>" class="header-img" alt="product Image" style="margin-top:-2px;"> Admin Product List</h1>
    <hr>
    <div class="row">
        <div class="col-xs-12">
            <div class="well hidden-xs"> 
                <div class="row">
                  
                </div>
            </div>
            <hr>
            
           <a href="javascript:void(0);" data-toggle="modal" data-target="#addPage" class="btn btn-default" style="margin-bottom:10px;">Add Product List</a>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Description</th>
								<th>Company</th>
                                <th>Price</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           <?php
							//var_dump($data); die();
							foreach ($data as $row) {
								?>

                                <tr>
                                   
                                    <td><?= $row['id']; ?></td>
                                    <td><?= $row['name']; ?></td>
									<td><?= $row['description']; ?></td>
									<td><?= $row['company']; ?></td>
									<td><?= $row['old_price']; ?></td>
									<td>
                                        <div class="text-center">
                                            <a href="<?= base_url('admin/showlist/' . $row['id']) ?>" class="btn btn-info" style="margin-bottom: 5px">Edit</a>
                                            <br/>
                                            <a href="<?= base_url('admin/deleteproductlist?delete=' . $row['id']) ?>"  class="btn btn-danger confirm-delete">Delete</a>
                                        </div>
                                    </td>
                                    
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
               
            </div>
		</div>
          
    </div>
	<div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action=""  method="POST">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new company</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name"> Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
					<div class="form-group">
                        <label for="name">Description</label>
                        <input type="text" name="description" class="form-control" id="description">
                    </div>
					<div class="form-group">
                        <label for="name">Company </label>
                        <input type="text" name="company" class="form-control" id="company">
                    </div>
					<div class="form-group">
                        <label for="name">Price </label>
                        <input type="text" name="old_price" class="form-control" id="old_price">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

