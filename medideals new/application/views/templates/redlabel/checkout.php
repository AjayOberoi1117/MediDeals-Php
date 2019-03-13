<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type =  "text/javascript">
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
			//alert(result);
			document.getElementById('sumpr['+id+']').innerHTML = "Rs. "+valu;
			document.getElementById('crt').innerHTML = result; 
			document.getElementById('crt1').value = result; 
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
<div class="inner-pg shop-pg shop-cart-pg clearfix" id="checkout-page">
    <div class="breadcrumb-title clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="breadcrumb-left">
                        <ol class="breadcrumb">
                            <li>
                               
                            </li>
                            <li class="active"></li>
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
    </div>
    <div class="container" style="min-height: 500px;">
        <!-- Inner Pages Start -->
        <div class="inner-content clearfix">
            <!-- Content Description Start -->
            <div class="content-desc clearfix">
                <!-- Section Title Start -->
                <div class="section-title">
                    <h1>Checkout</h1>
                </div>

                <!-- Cart Error Message Start -->
                <div class="cart-error-msg clearfix">
                    
                </div><!-- Cart Error Message End -->
                <!-- Return To Shop Button Start -->
                <div class="return-shop-btn clearfix">
                    <!--<a class="btn btn-default" href="#" role="button">Return To Shop</a>-->
                </div>
                <!-- Return To Shop Button End -->
                <?php
				//var_dump($_SESSION);echo "<p>&nbsp;&nbsp;</p>";
                    if ($cartItems['array'] != null) {
                ?>
                <?php //purchase_steps(1, 2) ?>
                <div class="row">
                    <div class="col-sm-12">
                        <form method="POST" id="goOrder">
                  
                            <?php
                                if ($this->session->flashdata('submit_error')) {
                            ?>
                            <hr>
                            <div class="alert alert-danger">
                                <h4><span class="glyphicon glyphicon-alert"></span> <?= lang('finded_errors') ?></h4>
                                <?php
                                    foreach ($this->session->flashdata('submit_error') as $error) {
                                        echo $error . '<br>';
                                    }
                                ?>
                            </div>
                            <hr>
                            <?php
                                }
                            ?>
                            <div class="payment-type-box" style="visibility:hidden;">
                                <select class="payment-type" name="payment_type">
                                    <?php if ($cashondelivery_visibility == 1) { ?>
                                    <option value="cashOnDelivery"><?= lang('cash_on_delivery') ?> </option>
                                    <?php
                                        } 
                                    ?>
                                </select>
                                <span class="top-header text-center"><?= lang('choose_payment') ?></span>
                            </div>
							<?php //var_dump($checkoutdata);?>
                            <div class="row">
                                <div class="form-group col-sm-6">
                                    <label for="firstNameInput"><? echo "Firm Name ";//= lang('first_name') ?> (<sup><?= lang('requires') ?></sup>)</label>
                                    <input id="firstNameInput" class="form-control" name="first_name" value="<?= $checkoutdata['firm_name'] ?>" type="text" readonly placeholder="<?= lang('first_name') ?> ">
                                </div>
								<div class="form-group col-sm-6">
                                    <label for="lastNameInput"><? echo "Alias Name ";//= lang('last_name') ?> (<sup><?= lang('requires') ?></sup>)</label>
                                    <input id="lastNameInput" class="form-control" name="last_name" value="<?= $checkoutdata['name'] ?>" type="text" readonly placeholder="<?= lang('first_name') ?> ">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="emailAddressInput"><?= lang('email_address') ?> (<sup><?= lang('requires') ?></sup>)</label>
                                    <input id="emailAddressInput" class="form-control" name="email" value="<?= $checkoutdata['email'] ?>" type="text" readonly placeholder="<?= lang('email_address') ?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="phoneInput"><?= lang('phone') ?> (<sup><?= lang('requires') ?></sup>)</label>
                                    <input id="phoneInput" class="form-control" name="phone" value="<?= $checkoutdata['contact_no'] ?>" type="text"  readonly placeholder="<?= lang('phone') ?>">
                                </div>
                                <div class="form-group col-sm-12">
                                    <label for="addressInput"><?= lang('address') ?> (<sup><?= lang('requires') ?></sup>)</label>
                                    <textarea id="addressInput" name="address" readonly class="form-control" rows="3"><?= str_replace('#@%',' ',$checkoutdata['firm_address']); ?></textarea>
                                </div>
                                
                            </div>
                            <?php  if ($codeDiscounts == 1) { ?>
                            <div class="discount">
                                <label><?= lang('discount_code') ?></label>
                                <input class="form-control" name="discountCode" value="<?= @$_POST['discountCode'] ?>" placeholder="<?= lang('enter_discount_code') ?>" type="text">
                                <a href="javascript:void(0);" class="btn btn-default" onclick="checkDiscountCode()"><?= lang('check_code') ?></a>
								
								<h5>If you don't see the product in the list <a href="">Reload</a> the page.</h5>
                            </div>
							
                            <?php } ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-products">
                                    <thead>
                                    <tr>
                                        <th><?= lang('product') ?></th>
                                        <th><?= lang('title') ?></th>
                                        <th><?= lang('quantity') ?></th>
                                        <th>Unit <?= lang('price') ?></th>
                                        <th><?= lang('total') ?></th>
                                    </tr>
                            </thead>
                                    <tbody>
                                        <?php
                                            
                                            $_SESSION['cart']=array();
                                            $_SESSION['cart']=$cartItems['array'];
											//var_dump($cartItems['array']);die;
                                            $i = 0;
                                            foreach ($cartItems['array'] as $item) {
                                        ?>
                                    <tr>
                                        <td class="relative">
                                            <input type="hidden" name="id[]" value="<?= $item['id'] ?>">
                                            <input type="hidden" name="quantity[]" value="<?= $item['num_added'] ?>">
											<input type="hidden" name="vendor_id[]" value="<?= $item['vendor_id'] ?>">
											<input type="hidden" name="individual_price[]" value="<?= $item['sum_price'] ?>">
                                            <?php if(@$item['image'] == "none.jpg")
											{}
										    else{?>
											<a href="#"><img alt="" class="img-responsive" src="<?= base_url('/attachments/shop_images/' . $item['image']) ?>" width="100" height="100"></a>
										    <?php } ?>
											
                                            <a href="<?= base_url('home/removeFromCart?delete-product=' . $item['id'] . '&back-to=checkout') ?>" class="btn btn-xs btn-danger remove-product">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </a>
                                        </td>
                                        <td><a href="<?= LANG_URL . '/' . $item['url'] ?>"><?= $item['title'] ?></a></td>
                                        <td>
                                        <span class="quantity-num">
								<input type ="number" name="qty[]" 
								min="<?= $item['minquantity'];?>" 
								value="<?= $item['num_added'] ?>" 
								id ="qty[<?= $i;?>]" 
								style ="width: 50px !important;" 
								onchange="checkqty(<?=$i;?>,this.value,<?= $item['minquantity'];?>,<?=$item['quantity'];?>,<?=$item['id'];?>,<?=$item['price'];?>)">
                                	
                                </span>   
                                        </td>
                                        <td><?= CURRENCY .' '. $item['price']  ?></td>
                                        <td id="sumpr[<?= $i;?>]"><span><?= CURRENCY.' '.$item['sum_price']; ?></span></td>
                                    </tr>
                                    <?php 
									$i++;
									} ?>
                                    <tr>
                                        <td colspan="4" class="text-right"><?= lang('total') ?></td>
                                        <td>
                                            <span class="final-amount" ><?= CURRENCY .' <span id="crt">'.$cartItems['finalSum'] ?></span></span>
                                            <input type="hidden" class="final-amount" name="final_amount" id="crt1" value="<?= $cartItems['finalSum'] ?>">
                                            <input type="hidden" name="amount_currency" value="<?= CURRENCY ?>">
                                            <input type="hidden" name="discountAmount" value="">
                                        </td>
                                    </tr>
                            </tbody>
                                </table>
								
								<div class="form-group col-sm-6" style="visibility:hidden;">
                                    <label for="cityInput"><?= lang('city') ?> <sup><?= lang('requires') ?></sup></label>
                                    <input id="cityInput" class="form-control" name="city" value="<?= @$_POST['city'] ?>" type="hidden" placeholder="<?= lang('city') ?>">
                                </div>
                                <div class="form-group col-sm-6" style="visibility:hidden;">
                                    <label for="postInput"><?= lang('post_code') ?></label>
                                    <input id="postInput" class="form-control" name="post_code" value="<?= @$_POST['post_code'] ?>" type="hidden" placeholder="<?= lang('post_code') ?>">
                                </div>
                                <div class="form-group col-sm-12" style ="visibility:hidden;">
                                    <label for="notesInput"><?= lang('notes') ?></label>
                                    <textarea id="notesInput" class="form-control" name="notes" rows="3"><?= @$_POST['notes'] ?></textarea>
                                </div>
                            </div>
                        </form>
                        <div class="discount">
                            <a href="<?php echo base_url().'home/category/'.$cat_link[0]['shop_categorie']?>" class="btn btn-primary go-shop">
                                <span class="glyphicon glyphicon-circle-arrow-left"></span>
                                <?= lang('back_to_shop') ?>
                            </a>
							<a class="btn btn-primary go-shop" onclick="checkoutlater()">Checkout Later &nbsp;&nbsp;
							<span class="glyphicon glyphicon-circle-arrow-left"></span>
							</a>
                            <a href="javascript:void(0);" class="btn btn-primary go-order" onclick="document.getElementById('goOrder').submit();">
                                <?= lang('custom_order') ?>
                                <span class="glyphicon glyphicon-circle-arrow-right"></span>
                            </a>
							
                            <div class="clearfix"></div>
                        </div>
                    </div>

                </div>
            </div>
            <?php } else { ?>
            <div class="alert alert-info"><?= lang('no_products_in_cart') ?></div>
            <?php
                }
                if ($this->session->flashdata('deleted')) {
            ?>
            <script>
                $(document).ready(function () {
                    ShowNotificator('alert-info', '<?= $this->session->flashdata('deleted') ?>');
                });
            </script>
            <?php } if ($codeDiscounts == 1 && isset($_POST['discountCode'])) { ?>
            <script>
                $(document).ready(function () {
                    checkDiscountCode();
                });
            </script>
            <?php } ?>
        </div>
    </div>
</div>