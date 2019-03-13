<?php
if ($this->session->flashdata('result_delete')) {
    ?> 
    <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div> 
    <?php
}
?>
<script type="text/javascript">
function vali1()
{
	var pna = document.getElementById('pna1').value;
	if(pna == "" || pna == null)
	{
		alert("Please enter a Product Name for Search");
		return false;
	}
	return true;
}
</script>
<div class="content">
    <div class="row"> 
		<div class="col-md-6 col-lg-6">
			<span style="float:left">Search Product : &nbsp;&nbsp;&nbsp;&nbsp;</span>
			<form action="searchproductforvendor" method="post" style="float:left" onSubmit="return vali1()">
			    <input type="text" id ='pna1' name="pname" placeholder ="Enter Product Name" style="float:left; padding-right:100px;"> 
				<input type="submit" name="sub" value="Search" style="float:left; margin-left:10px;">
			</form>
		</div>
	</div>
	<p>&nbsp;&nbsp;</p>
    <div class="row"> 
        <?php
		 $_SESSION['totalproducts']=count($products);
        foreach ($products as $row) {
			
		    $u_path = 'attachments/shop_images/';
            if ($row->image != null && file_exists($u_path . $row->image)) {
                $image = base_url($u_path . $row->image);
            } else {
                $image = base_url('attachments/logobg.jpg');
            }
			
            ?>
            <div class="col-md-4 col-lg-3">
                <div class="product-list"> 
                    <div class="img-container" style ="border-radius:20px;">
					
                        <img src="<?= $image ?>" class="img-fluid" alt="No image" >
                        <a>
                            <div class="mask"></div>
                        </a>
                    </div> 
					
                    <div class="product-body">
                        <h4><strong><a href=""><?= $row->title;  ?> </a></strong></h4> 
                        <p class="product-text">
                            <?= word_limiter(strip_tags($row->description), 80) ?>
                        </p> 
                        <div class="product-footer">
							
                            <div class="text-center price"><b>MRP:</b> Rs <?= $row->old_price ?></div>
							<div class="text-center price"><b>New Price:</b> Rs <?= $row->price ?></div>
                             <div class="text-center price"><b>Qty:</b> <?= $row->quantity ?></div>
                         

                            <div class="buttons">
                                <a href="<?= LANG_URL . '/vendor/edit/product/' . $row->id ?>" class="btn btn-green btn-sm">
                                    <?= lang('edit') ?>
                                </a>
                                <a href="<?= LANG_URL . '/vendor/delete/product/' . $row->id ?>" onclick="return confirm('<?= lang('vendor_sure_to_del_product') ?>')" class="btn btn-green btn-sm ">
                                    <?= lang('delete') ?>
                                </a><br/><br/>
                                <a href="<?= LANG_URL . '/vendor/Addproduct/location/' . $row->id ?>" class="btn btn-green btn-sm">
                                    Add Location
                                </a>
                                <br/>
                                 <br/>
                                <a href="<?= LANG_URL . '/vendor/AddProduct/view_location/' . $row->id ?>" class="btn btn-green btn-sm">
                                   View Location
                                </a>
                                
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        <?php } ?> 
    </div>
    <?= $links_pagination ?>
</div>