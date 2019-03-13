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
			<center><h1> Show All Product List </h1></center>
			<br/>
		<?php foreach($record as $values){?> 
        <div class="content">
            <form class="form-box" action="<?php echo base_url('admin/updateproductlist/'.$values->id); ?>" method="POST" >
         
                 
         
                    <div class="form-group"> 
                        <span>Name</span>
                        <input type="text" name="name" placeholder=" Name" value="<?php echo $values->name;?>" class="form-control">
                    </div> 
					<div class="form-group"> 
                      <span>Description</span> 
                        <input type="text" name="description" placeholder=" description" value="<?php echo $values->description;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>Company</span>
                        <input type="text" name="company" placeholder=" company" value="<?php echo $values->company;?>" class="form-control">
                    </div>
					<div class="form-group"> 
                        <span>Price</span>
                        <input type="text" name="old_price" placeholder=" old_price" value="<?php echo $values->old_price;?>" class="form-control">
                    </div>
				  <button type="submit" name="setProduct" class="btn btn-green">Update</button>
            </form> 
        </div>
    </div>
</div>
				<?php
}
?>
			
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
