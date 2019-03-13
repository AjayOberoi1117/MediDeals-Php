<script type =  "text/javascript">
$(document).ready(function() {

    /*alert( "ready!" );
	$.ajax({
	type: "POST",
	url: "<?php echo base_url();?>/shopping-cart/cartajaxresponse",
	data: data,
	success: success,
	dataType: dataType
	});
	alert(data);
	$( "#cartdata" ).html( data );
	
//	$.post( "<?php echo base_url();?>/shopping-cart/cartajaxresponse", function( data ) {
//	$( "#cartdata" ).html( data );
//	});
*/
});
function checkqty(id, val, minval, maxval, pid, in_price)
{
	
	//alert(id+" "+val+" "+minval+" "+maxval+" "+pid+" "+in_price);
	
	if(val == "" || val == null)
	{
		var valu = parseFloat(minval) * parseFloat(in_price);
		alert("Order quantity cannot be zero");
		document.getElementById('qty['+id+']').value = parseInt(minval);
		document.getElementById('sumpr['+id+']').innerHTML = "Rs. "+valu;
		window.location = "http://medideals.co.in/shopping-cart";
	}
	if(parseInt(val) < parseInt(minval))
	{
		var valu = parseFloat(minval) * parseFloat(in_price);
		alert("Order quantity cannot be less then min. shipping quantity");
		document.getElementById('qty['+id+']').value = parseInt(minval);
		document.getElementById('sumpr['+id+']').innerHTML = "Rs. "+valu;
		window.location = "http://medideals.co.in/shopping-cart";
	}
	else
	{
		var valu = parseFloat(val) * parseFloat(in_price);
		valu = valu.toFixed(2);
		$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>shopping-cart/changeqtybyajax",
        dataType: "text",
		data: {product_id : pid, new_quantity : val, action : 'addqty', min_quantity : minval, max_quantity : maxval},
		success: function(result) {
			document.getElementById('sumpr['+id+']').innerHTML = "Rs "+valu;
			document.getElementById('crt').innerHTML = result; 
			document.getElementById('crt1').innerHTML = result; 
		},
		error: function(error) {
			alert(error);
		},
		});	
	}
}
function checkoutlater()
{
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>shopping-cart/checkoutlater",
        dataType: "text",
		data: {product_id : 1},
		success: function(result) {
			alert(result); 
		},
		error: function(error) {
			alert(error);
		},
		});	
}

</script>
<section class="content inner-pg shop-pg shop-cart-pg clearfix">
		<!-- Breadcrumb Start -->
		<div class="breadcrumb-title clearfix">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="breadcrumb-left">
							<ol class="breadcrumb">
								<li>
									<a href="index.php">HOME</a>
								</li>
								<li class="active">Cart</li>
							</ol>
						</div>
					</div>
					<div class="col-sm-6 col-md-6">
						<div class="breadcrumb-right">
							<h5></h5>
						</div>
					</div><!--/.col-sm-6 col-md-6-->
				</div><!--/.row-->
			</div><!--/.container-->
		</div><!-- Breadcrumb End -->
		<div class="container" id = "cartdata">
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
						<p>      <?php //var_dump($cartItems); die; 
    if ($cartItems['array'] == null) {
        ?>
        <div class="alert alert-info"><?= lang('no_products_in_cart') ?></div>
        <?php
    } else {
        ?></p>
					</div><!-- Cart Error Message End -->
					<!-- Return To Shop Button Start -->
					<div class="return-shop-btn clearfix">
						<a class="btn btn-default" href="#" role="button">Return To Shop</a>
					</div><!-- Return To Shop Button End -->
                    
                    <h5>If you don't see the product in the list <a href="">Reload</a> the page.</h5>
					
					<div class="table-responsive" id="cartdata" >
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
                               
                                 <?php  //var_dump($cartItems['array']);die; 
								 
								 $i = 0;
								 foreach ($cartItems['array'] as $item) { 
								 
								 
								 ?>
									<!--/.--><!--/.cart-item-->
									<tr class="cart-item">
                                     <input type="hidden" name="id[]" value="<?= $item['id'] ?>">
                                     <input id ="minval" type="hidden" name="quantity[]" value="<?= $item['num_added'] ?>">
										<td class="product-remove">
											<a class="remove" href="<?= base_url('home/removeFromCart?delete-product=' . $item['id'] . '&back-to=shopping-cart') ?>"></a>
										</td>
										<td class="product-thumbnail">
											<?php if(@$item['image'] == "none.jpg")
											{}
										    else{?>
											<a href="#"><img alt="" class="img-responsive" src="<?= base_url('/attachments/shop_images/' . $item['image']) ?>"></a>
										    <?php } ?>
										</td>
										<td class="product-name" data-title="Product">
											<a href="<?= LANG_URL . '/' . $item['url'] ?>"><?= $item['title'] ?></a>
										</td>
										<td class="product-price" data-title="Price"><span><?= CURRENCY.$item['price']; ?></span></td>
										<td class="product-quantity" data-title="Quantity">
											<div class="quantity">
												<!--<a class="btn btn-xs btn-primary refresh-me add-to-cart <?//= $item['quantity'] <= $item['num_added'] ? 'disabled' : '' ?>" data-id="<?//= $item['id'] ?>" href="javascript:void(0);">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>-->
                                <span class="quantity-num">
								<input type ="number" name="qty[]" 
								min="<?= $item['minquantity'];?>" 
								value="<?= $item['num_added'] ?>" 
								id ="qty[<?= $i;?>]" 
								style ="width: 50px !important;" 
								onchange="checkqty(<?=$i;?>,this.value,<?= $item['minquantity'];?>,<?=$item['quantity'];?>,<?=$item['id'];?>,<?=$item['price'];?>)">
                                     
									<?php //echo $item['minquantity'];?>
									
                                </span>
                                <!--<a  class="btn  btn-xs btn-danger <?php //echo $item['num_added'] <= $item['minquantity'] ? 'disabled' : '' ?>" onclick="removeProduct(<?//= $item['id'] ?>, true)" href="javascript:void(0);">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </a>-->
											</div>
										</td>
										<td class="product-subtotal" id="sumpr[<?= $i;?>]" data-title="Total"><span><?= CURRENCY.$item['sum_price']; ?></span></td>
									</tr><!--/.cart-item-->
                                    
                                    
                                       <?php 
									   $i++;
									   } 
								//var_dump($_SESSION);echo "<p>&nbsp;&nbsp;</p>";
									   ?>
                                    
                                    
									<!--<tr>
										<td class="actions" colspan="6">
											<div class="coupon">
												<input class="input-text" id="coupon_code" name="coupon_code" placeholder="Coupon code" type="text" value=""> <input class="button" name="apply_coupon" type="submit" value="Apply coupon">
											</div>
											<!--<div class="update-cart">
												<a class="btn btn-default" href="#">Update Cart</a>
											</div>
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
												<td data-title="Subtotal"><span class="woocommerce-Price-amount amount"><?= CURRENCY ?> <span id='crt'><?=$cartItems['finalSum']; ?></span></span></td>
											</tr><!--/.cart-subtotal-->
											<tr class="order-total">
												<th>Total</th>
												<td data-title="Total"><strong><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"><?= CURRENCY?> </span><span id='crt1'><?=$cartItems['finalSum']; ?></span>
												</span></strong></td>
											</tr><!--/.order-total-->
										</tbody>
									</table><!--/.shop-table-->
									<div class="proceed-to-checkout">
										<a class="btn btn-default" href="<?php echo base_url()?>ShoppingCartPage/checkout">Proceed to checkout &nbsp;&nbsp;</a>
									</div>
									<div class="proceed-to-checkout">
										<a class="btn btn-default" href="<?php echo base_url().'home/category/'.$cat_link[0]['shop_categorie']?>">Continue Shopping &nbsp;&nbsp;</a>
									</div>
									<div class="proceed-to-checkout">
										<?php
										if(@$_SESSION['vendor_user'] == NULL)
										{
											echo "kindly <a href ='".base_url()."ShoppingCartPage/cartlogin'>login</a> to enable <br><b>Check Out Later </b> option";
										}
										else {
										?>
										<a class="btn btn-default" onclick="checkoutlater()">Checkout Later &nbsp;&nbsp;</a>
										<?php
										}
										?>		
									</div>
								</div><!--/.cart-totals-->
							</div><!--/.col-sm-push-4 col-sm-8-->
						</div><!--/.row-->
					</div><!--/.cart-collaterals-->
				</div><!-- Content Description End -->
			</div><!-- Inner Pages End -->
		</div><!--/.container-->
	</section>


<?php } 

?>

