
<section class="content inner-pg shop-pg clearfix">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-title clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="breadcrumb-left">
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url()?>">HOME</a>
                            </li>
                            <li class="active">Pcd Companies</li>
                        </ol><!--/.breadcrumb-->
                    </div><!--/.breadcrumb-left-->
                </div><!--/.col-sm-6 col-md-6-->
                <div class="col-sm-6 col-md-6">
                    <div class="breadcrumb-right">
                        <h5>Pcd Companies</h5>
                    </div>
                </div><!--/.col-sm-6 col-md-6-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!-- Breadcrumb End -->
    <div class="container">
        <!-- Inner Pages Start -->
        <div class="inner-content clearfix">
            <div class="row">
                

                <div class="col-sm-12 col-md-12">
                    <!-- Content Description Start -->
                    <div class="content-desc clearfix">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h1>Pcd Companies</h1>
                        </div>
                        <!-- Result Sorting Start -->
                        

                        <!-- Shop Items List Start -->
                        <div class="shop-products-list clearfix">
                            <div class="row">
                                
                                
                      <?php foreach($ListcategoryProduct as $category){
 ?>
							<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
							<div class="product-block">
							<div class="sale">
							
											</div>
											<p>&nbsp;&nbsp;</p>
											<a href="<?php echo base_url('').'Home/viewpcd_companies/'.$category['pcd_id']?>"<?php echo $category['pcd_id'] ?> target="_blank">
											<div class="image"><img alt="IMAGE" class="img-responsive" src="<?= base_url('upload_pic/' . $category['pcd_image']) ?>"></div>
											<div class="product-detail">
												<h6>Name : <?= strtolower($category['pcd_name']) ?></h6>
												<h6>Description : <?= $category['pcd_description'] ?></h6>
											
												<h6>Address :  <?= $category['pcd_address'] ?></h6>
												<h6>Phone :  <?= $category['pcd_phone'] ?></h6>
												
											</div></a>
											
										</div>
									</div>
                                    
                                    
                                    
                                  <?php }?>  
                                    
                                    
                            </div>
							<?= $links_pagination?>
                        </div>

                        <!-- Page List Start -->
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
