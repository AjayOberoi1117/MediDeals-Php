<script type="text/javascript">
function count_cart_items()
{
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>shopping-cart/calccartitems",
        dataType: "text",
		data: {product_id : 0},
		success: function(result) {
			document.getElementById("cartitemnum").innerHTML = "Items "+result;
			//alert(result);
		},
		error: function(error) {
			//alert("Error in adding item to the cart");
		},
		});
}
function add_to_cart(pid)
{
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>shopping-cart/ajaxmanagecart",
        dataType: "text",
		data: {product_id : pid},
		success: function(result) {
			count_cart_items();
			alert(result);  
		},
		error: function(error) {
			count_cart_items();
			alert("Error in adding item to the cart");
		},
		});	
		
	
	/*if(calp == 0)
	document.getElementById("cartitemnum").innerHTML = "Empty";
	else
	document.getElementById("cartitemnum").innerHTML = calp;*/
}
</script>
	<!-- Content Start -->
	<section class="content inner-pg shop-pg shop-product-pg clearfix">
		<!-- Breadcrumb Start -->
		<!--<div class="breadcrumb-title clearfix">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="breadcrumb-left">
							<ol class="breadcrumb">
								<li>
									<a href="index.html">HOME</a>
								</li>
								<li>
									<a href="shop.html">Shop</a>
								</li>
								<li>
									<a href="shop.html">Vitamins & Supplements</a>
								</li>
								<li class="active">DiamondClean Rechargeable Electric Toothbrush</li>
							</ol>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="breadcrumb-right">
							<h5></h5>
						</div>
					</div>
				</div>
			</div>
		</div>-->
		<?php //var_dump($product); ?>
		<!-- Product Items Detail Start -->
		<div class="product-items-detail clearfix">	
			<?php if($product['shop_categorie'] == 3)
			{  ?>
		    <div class="col-sm-2 col-md-2 col-lg-2 padding">
			</div>
		    <div class="col-sm-4 col-md-4 col-lg-4 padding">
			<p>&nbsp; &nbsp; </p>
			<img src="<?= base_url('/attachments/shop_images/' . $product['image']) ?>" width="250" height="200">
			<p>&nbsp;&nbsp;</p>
			
			</div>
		    <div class="col-sm-6 col-md-6 col-lg-6 padding">
				<div class="right-side" style="padding-top:30px !important;">
					<div class="product-categories">
                        <h4 class="text-center"><?= $product['title'] ?></h4>
                        
                        <div class="col-md-12 discount">
                            	<p>Max Retail Price : Rs <?= $product['old_price']?></p>
                                <p>Discounted Price : Rs <?= $product['price']?></p>
                                <!--<p>Stock Available:</p>-->
                                <p>Minimum Order Quantity : <?= $product['minquantity'] ?></p>
                                <p>Discount : <?= number_format($product['discount'],2)  ?> %</p>
                                <p>Categories : <?= $product['categorie_name']  ?></p>    
                           
                    
                        </div>
						
					</div>
				</div><!--/.right-side-->
			</div>
			<div class ="col-sm-12 col-md-12 col-lg-12">
			  <div class="col-sm-6 col-md-6 col-lg-6 padding">
				<div class="quantity clearfix">
					<div class="row text-center">
						<?php if ($product['quantity'] > 0) { ?>
						<a onclick="add_to_cart(<?= $product['id'] ?>)" class="btn btn-default add-to-cart btn-add primary-btn add-to-cart" style="width: 300px !important;">
							<span class="text-to-bg"><i class="fa fa-shopping-cart"></i><?echo " Add to Cart";?></span>
						</a>			
						<?php } else { ?>
						<div class="alert alert-info"><?= lang('out_of_stock_product') ?></div>
						<?php } ?>
					</div>                   
				</div>
			  </div>
              <div class="col-sm-6 col-md-6 col-lg-6 padding">			  
				<div class="quantity clearfix">        
					<div class="row text-center">
						<?php if ($product['quantity'] > 0) { ?>
						<a  href="<?= LANG_URL . '/shopping-cart' ?>" data-id="<?= $product['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" class="btn btn-default add-to-cart btn-add primary-btn add-to-cart" style="width: 300px !important;">
							<span class="text-to-bg" style="color:#fff;"><i class="fa fa-shopping-cart"></i><?echo " Buy It Now";?></span>
						 </a>
						 <?php } else { ?>
						<div class="alert alert-info"><?= lang('out_of_stock_product') ?></div>
						<?php } ?>
					</div> 
				</div>
			  </div>
			</div>
			<div class="col-md-12" style="padding-left:10%">
				<p> Delivery Locations: 
				<?php 
				if(count($product_city)){
					foreach($product_city as $city) 
					{ echo $city->city_name.', '; }
				}
				else {
					echo "All over India";
				}
				?>
				</p>
                            
			</div>
			<?php	
			}
		    else
			{ ?>
		    <div class="col-sm-12 col-md-12 col-lg-12 padding">
			<h4 class="text-center"><?= $product['title'] ?></h4>
			</div>
		    <div class="col-sm-6 col-md-6 col-lg-6 padding">
			    <div class="quantity clearfix">
					<div class="product-categories">
 
                        <div class="col-md-12 discount row text-center">
                           
								<p>Max Retail Price : Rs <?= $product['old_price']?></p>
                                <p>Discounted Price : Rs <?= $product['price']?></p>
                                <!--<p>Stock Available:</p>-->
                                <p>Minimum Order Quantity : <?= $product['minquantity'] ?></p>
                                <p>Discount : <?= number_format($product['discount'],2)  ?> %</p>
                                <p>Categories : <?= $product['categorie_name']  ?></p>    
                           
                        </div>
					</div>    
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-6 padding">
				<div class="right-side" style="padding-top:3px !important;">
                    <div class="row text-center">
                    <?php if ($product['quantity'] > 0) { ?>
                    <a onclick="add_to_cart(<?= $product['id'] ?>)" class="btn btn-default add-to-cart btn-add primary-btn add-to-cart" style="width: 300px !important;">
                            <span class="text-to-bg"><i class="fa fa-shopping-cart"></i><?echo " Add to Cart";?></span>
                    </a>
					<p>&nbsp;&nbsp;</p>
					<a  href="<?= LANG_URL . '/shopping-cart' ?>" data-id="<?= $product['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" class="btn btn-default add-to-cart btn-add primary-btn add-to-cart" style="width: 300px !important;">
                            <span class="text-to-bg"><i class="fa fa-shopping-cart"></i><?echo " Buy It Now";?></span>
                    </a>
                         <?php } else { ?>
                        <div class="alert alert-info"><?= lang('out_of_stock_product') ?></div>
                    <?php } ?>
                    </div>

                    
				</div><!--/.right-side-->
			</div>
			
			<div class="col-md-12" style="padding-left:10%">
				<p> Delivery Locations: <?php 
				if(count($product_city)){
					foreach($product_city as $city) 
					{ echo $city->city_name.', '; }
				}
				else {
					echo "All over India";
				}
				?>
			</div>
			
			<?php } ?>
			<!--/.col-sm-12 col-md-6 col-lg-6 padding-->
		</div><!-- Product Items Detail End -->
		<!-- Content Description Start -->
		<div class="content-desc clearfix">
			<div class="container">
				<!-- Product Related Description Start -->
				<div class="product-related-desc clearfix">
					<!-- Description Start -->
				
					<!-- Related Products Start -->
					<div class="related-products clearfix">
						<!-- Section Title Start -->
						<div class="section-title">
							<h5 style="color:#f00">More Products From Seller</h5>
						</div><!-- Section Title End -->
						<!-- Shop Items List Start -->
						<div class="shop-products-list clearfix">
							<div class="row">
								<?php foreach($sameCagegoryProducts as $releted) {
                                ?>
								<div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                                    <div class="product-block">
                                
                                <a href="<?php echo base_url()?><?php echo $releted['url'] ?>">
                                <div class="product-detail">
                                    
                                          <h6><?= substr($releted['title'], 0, 18) ?></h6>                                       

                                            <span class="sale-price">
                                                <span class="pull-right">
                                               <?php echo CURRENCY.' ' ?><?= $releted['price'];?>
                                                </span>
												<span class="reg-price">
                                                <?php echo CURRENCY.' ' ?><?= $releted['old_price'];?>
											    </span>
                                            </span> 
											
                                    </div>
                                 </a>
								
                                <div class="clearfix"></div>
                                        <div class="add-read-more-icons">
                                    <div class="form-group">
                                        
                                    
                                    <span class="pull-right small">Discount!&nbsp;&nbsp; <?php
                                        if ($releted['old_price'] != '' && $releted['old_price'] != 0) {
                                            $percent_friendly = number_format((($releted['old_price'] - $releted['price']) / $releted['old_price']) * 100) . '%';
                                        ?>
                                       <b class="blink_me"> <?= number_format($percent_friendly,2) ?> %</b>
                                    <?php } ?>                                    
                                    </span>
									<span class="small">
									<?= $product['categorie_name']  ?>
									</span>
                                    </div>

                                    <div class="clearfix"></div>
                                

                                </div>
                                
                                 <a href="<?php echo base_url()?><?php echo $releted['url'] ?>"><button class="btn btn-default" name="buy-now" type="submit">Buy Now</button></a>
                                
                            </div>

								</div>
                                
                                
                                <?php }?>
                                
                                
                                <!--/.col-xs-6 col-sm-6 col-md-3 col-lg-3-->
							</div><!--/.row-->
						</div><!-- Shop Items List End -->
					</div><!-- Related Products End -->
				</div><!-- Product Related Description End -->
			</div><!--/.container-->
		</div><!-- Content Description End -->
	</section><!-- Content End -->
	<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Check Login Or Not</h3>
        </div>
        <div class="modal-body">
    
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-lg" data-dismiss="modal">Continew</button>
          <a href="https://medi.korbose.com/Home/login" target="_blank"> Login<a/>
        </div>
      </div>
      
    </div>
  </div>