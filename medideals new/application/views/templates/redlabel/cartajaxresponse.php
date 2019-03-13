<!-- Inner Pages Start -->
			<div class="inner-content clearfix">
				<!-- Content Description Start -->
				<div class="content-desc clearfix">
					<!-- Section Title Start -->
					<div class="section-title">
						<h1>Cart</h1>
					</div><!-- Section Title End -->
					<!-- Cart Error Message Start -->
					<div class="cart-error-msg clearfix">
						<p>      <?php
    if ($cartItems['array'] == null) {
        ?>
        <div class="alert alert-info"><?= lang('no_products_in_cart') ?></div>
        <?php
    } else {
        //echo purchase_steps(1);
        ?></p>
					</div><!-- Cart Error Message End -->
					<!-- Return To Shop Button Start -->
					<div class="return-shop-btn clearfix">
						<a class="btn btn-default" href="#" role="button">Return To Shop</a>
					</div><!-- Return To Shop Button End -->
                    
                    
					
					<div class="table-responsive" >
						<table class="table cart-table table-hover">
								<thead>
									<tr>
										<th class="product-remove">&nbsp;</th>
										<th class="product-thumbnail">&nbsp;</th>
										<th class="product-name">Product</th>
										<th class="product-price">Price</th>
										<th class="product-quantity">Quantity</th>
										<th class="product-subtotal">Total</th>
									</tr>
								</thead>
								<tbody>
                               
                                 <?php /* var_dump($cartItems['array']);die; */
								 foreach ($cartItems['array'] as $item) { 
								 
								 //print_r($item);
								 //print_r($_SESSION);
								 ?>
									<!--/.--><!--/.cart-item-->
									<tr class="cart-item">
                                     <input type="hidden" name="id[]" value="<?= $item['id'] ?>">
                                     <input id ="minval" type="hidden" name="quantity[]" value="<?= $item['num_added'] ?>">
										<td class="product-remove">
											<a class="remove" href="<?= base_url('home/removeFromCart?delete-product=' . $item['id'] . '&back-to=shopping-cart') ?>"></a>
										</td>
										<td class="product-thumbnail">
											<a href="#"><img alt="" class="img-responsive" src="<?= base_url('/attachments/shop_images/' . $item['image']) ?>"></a>
										</td>
										<td class="product-name" data-title="Product">
											<a href="<?= LANG_URL . '/' . $item['url'] ?>"><?= $item['title'] ?></a>
										</td>
										<td class="product-price" data-title="Price"><span><?= CURRENCY.$item['price']; ?></span></td>
										<td class="product-quantity" data-title="Quantity">
											<div class="quantity">
												<a class="btn btn-xs btn-primary refresh-me add-to-cart <?= $item['quantity'] <= $item['num_added'] ? 'disabled' : '' ?>" data-id="<?= $item['id'] ?>" href="javascript:void(0);">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                                <span class="quantity-num">
                                    <?= $item['num_added'] ?>
									<?php //echo $item['minquantity'];?>
									
                                </span>
                                <a  class="btn  btn-xs btn-danger <?php echo $item['num_added'] <= $item['minquantity'] ? 'disabled' : '' ?>" onclick="removeProduct(<?= $item['id'] ?>, true)" href="javascript:void(0);">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </a>
											</div>
										</td>
										<td class="product-subtotal" data-title="Total"><span><?= CURRENCY.$item['sum_price']; ?></span></td>
									</tr><!--/.cart-item-->
                                    
                                    
                                       <?php } ?>
                                    
                                    
									<tr>
										<td class="actions" colspan="6">
											<div class="coupon">
												<input class="input-text" id="coupon_code" name="coupon_code" placeholder="Coupon code" type="text" value=""> <input class="button" name="apply_coupon" type="submit" value="Apply coupon">
											</div>
											<!--<div class="update-cart">
												<a class="btn btn-default" href="#">Update Cart</a>
											</div>-->
										</td>
									</tr><!--/.cart-item-->
								</tbody>
							</table>
						
							
						</div><!--/.table-responsive-->
				
					<div class="cart-collaterals">
						<div class="row">
							<div class="col-sm-push-4 col-sm-8 col-md-push-6 col-md-6 col-lg-4 col-lg-push-8">
								<div class="cart-totals calculated-shipping">
									<h2>Cart totals</h2>
									<table class="shop-table shop-table-responsive">
										<tbody>
											<tr class="cart-subtotal">
												<th>Subtotal</th>
												<td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><?= CURRENCY.$cartItems['finalSum']; ?></span></td>
											</tr><!--/.cart-subtotal-->
											<tr class="order-total">
												<th>Total</th>
												<td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?= CURRENCY?></span><?= $cartItems['finalSum']; ?></span></strong></td>
											</tr><!--/.order-total-->
										</tbody>
									</table><!--/.shop-table-->
									<div class="proceed-to-checkout">
										<a class="btn btn-default" href="<?php echo base_url()?>ShoppingCartPage/checkout">Proceed to checkout</a>
									</div>
								</div><!--/.cart-totals-->
							</div><!--/.col-sm-push-4 col-sm-8-->
						</div><!--/.row-->
					</div><!--/.cart-collaterals-->
				</div><!-- Content Description End -->
			</div><!-- Inner Pages End -->