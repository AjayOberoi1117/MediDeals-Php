
<section class="content inner-pg shop-pg clearfix">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-title clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="breadcrumb-left">
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url(); ?>">HOME</a>
                            </li>
                            <li class="active">Vendor</li>
                        </ol><!--/.breadcrumb-->
                    </div><!--/.breadcrumb-left-->
                </div><!--/.col-sm-6 col-md-6-->
                <div class="col-sm-6 col-md-6">
                    <div class="breadcrumb-right">
                     
                    </div>
                </div><!--/.col-sm-6 col-md-6-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!-- Breadcrumb End -->
    <div class="container">
        <!-- Inner Pages Start -->
        <div class="inner-content clearfix">
            <div class="row">
              

                <div class="col-sm-12 col-md-12 col-lg-12">
                    <!-- Content Description Start -->
                    <div class="content-desc clearfix">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h1>Products</h1>
                        </div>
                        <!-- Result Sorting Start -->
                       

                        <!-- Shop Items List Start -->
                        <div class="shop-products-list clearfix">
                            <div class="row">
                                
                                
                      <?php foreach($ListVendorProduct as $category){


 ?>
									<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
										<div class="product-block">
											<a href="<?php echo base_url()?><?php echo $category['url'] ?>">
										
											<div class="product-detail">
												<h6><?= $category['title'] ?></h6>
												<span class="sale-price"><span class="reg-price"><?php echo CURRENCY.' ' ?><?= $category['old_price'];?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CURRENCY.' ' ?><?= $category['price'];?></span>
											</div></a>
											<div class="add-read-more-icons">
                                                <a href="<?php echo base_url('home/vendor/')?><?php echo str_replace(' ','-',$category['vendor_name']); ?>" class=""><span><?= $category['vendor_name'] ?></span></a>
											<span class="pull-right small">Discount! <?php
                                if ($category['old_price'] != '' && $category['old_price'] != 0) {
                                    $percent_friendly = number_format((($category['old_price'] - $category['price']) / $category['old_price']) * 100) . '%';
                                    ?>
                                   <span class="blink_me"> <?= $percent_friendly ?> </span>
                                <?php } ?></span>
											
											</div>
											 <a href="<?php echo base_url()?><?php echo $category['url'] ?>"><button class="btn btn-default" name="buy-now" type="submit">Buy Now</button></a>
										</div>
										
									</div>
                                    
                                    
                                    
                                  <?php }?>  
                                    
                                    
                            </div>
                        </div>

                        <!-- Page List Start -->
                       

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
