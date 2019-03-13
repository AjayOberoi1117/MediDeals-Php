
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
                            <li class="active"></li>
                        </ol><!--/.breadcrumb-->
                    </div><!--/.breadcrumb-left-->
                </div><!--/.col-sm-6 col-md-6-->
                <div class="col-sm-6 col-md-6">
                    <div class="breadcrumb-right">
                        <h5> </h5>
                    </div>
                </div><!--/.col-sm-6 col-md-6-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!-- Breadcrumb End -->
    <div class="container">
        <!-- Inner Pages Start -->
        <div class="inner-content clearfix">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <!-- Sidebar Widget Start -->
                    
                </div>

                <div class="col-sm-12 col-md-8 col-lg-9">
                    <!-- Content Description Start -->
                    <div class="content-desc clearfix">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h1> Search Product</h1>
                        </div>
                        <!-- Result Sorting Start -->
                        

                        <!-- Shop Items List Start -->
                        <div class="shop-products-list clearfix">
                    <div class="row">
                        <?php
                            foreach($search as $category){                            
                                       //print_r($product);
                        ?>
                      <div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
                            <div class="product-block">
                                
                                <a href="<?php echo base_url()?><?php echo $category['url'] ?>">
                                <div class="product-detail">
                                    
                                        <h6><?= $category['title'] ?></h6>

                                            <span class="sale-price">
                                                <span class=" pull-right">
                                                   New <?php echo CURRENCY.' ' ?><?= $category['price'];?>
                                                </span>
                                            <span class="reg-price">
                                               Old <?php echo CURRENCY.' ' ?><?= $category['old_price'];?>
                                            </span> 
										</span>											
                                    </div>
                                 </a>
                                <div class="clearfix"></div>
                                <div class="add-read-more-icons">
                                    <div class="form-group">
                                        <a href="<?php echo base_url('home/vendor/')?><?php echo str_replace(' ','-',$category['vendor_name']); ?>"><span><?= $category['vendor_name'] ?></span></a>
                                    
                                    <span class="pull-right small">Discount! <?php
                                        if ($category['old_price'] != '' && $category['old_price'] != 0) {
                                            $percent_friendly = number_format((($category['old_price'] - $category['price']) / $category['old_price']) * 100) . '%';
                                        ?>
                                        <?= $percent_friendly ?>
                                    <?php } ?>                                    
                                    </span>
                                    </div>

                                    <div class="clearfix"></div>
                                   

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
