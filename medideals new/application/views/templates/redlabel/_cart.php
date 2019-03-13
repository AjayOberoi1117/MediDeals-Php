<div class="section">
		<!-- container -->
		<div class="container">
        
        <?php
    if ($cartItems['array'] == null) {
        ?>
        <div class="alert alert-info"><?= lang('no_products_in_cart') ?></div>
        <?php
    } else {
        //echo purchase_steps(1);
        ?>
			<!-- row -->
			<div class="row">
					
							<table class="shopping-cart-table table">
								<thead>
									<tr>
										<th>Product</th>
										<th></th>
										<th class="text-center">Price</th>
										<th class="text-center">Quantity</th>
										<th class="text-center">Total</th>
										<th class="text-right"></th>
									</tr>
								</thead>
								<tbody>
									 <?php foreach ($cartItems['array'] as $item) { ?>
									
									<tr>
                                     <input type="hidden" name="id[]" value="<?= $item['id'] ?>">
                                <input type="hidden" name="quantity[]" value="<?= $item['num_added'] ?>">
										<td class="thumb"><img src="<?= base_url('/attachments/shop_images/' . $item['image']) ?>" alt=""></td>
										<td class="details">
											<a href=" <?= LANG_URL . '/' . $item['url'] ?>"><?= $item['title'] ?>
											<!--<ul>
												<li><span>Size: XL</span></li>
												<li><span>Color: Camelot</span></li>
											</ul>-->
										</td>
										<td class="price text-center" ><strong style="color:#000000;"><?= $item['price'] . CURRENCY ?></strong></td>
										<td class="qty text-center">
                                        
                                             <a class="btn btn-xs btn-primary refresh-me add-to-cart <?= $item['quantity'] <= $item['num_added'] ? 'disabled' : '' ?>" data-id="<?= $item['id'] ?>" href="javascript:void(0);">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </a>
                                <span class="quantity-num">
                                    <?= $item['num_added'] ?>
                                </span>
                                <a class="btn  btn-xs btn-danger" onclick="removeProduct(<?= $item['id'] ?>, true)" href="javascript:void(0);">
                                    <span class="glyphicon glyphicon-minus"></span>
                                </a>
                                        
                                        </td>
										<td class="total text-center"><strong class="primary-color"><?= $item['sum_price'] . CURRENCY ?></strong></td>
										<td class="text-right">
                                        
                                        <a href="<?= base_url('home/removeFromCart?delete-product=' . $item['id'] . '&back-to=shopping-cart') ?>" class="btn btn-xs btn-danger remove-product">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                                       </td>
									</tr>
                                    <?php } ?>
								</tbody>
								<tfoot>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SUBTOTAL</th>
										<th colspan="2" class="sub-total"><?= $cartItems['finalSum'] . CURRENCY ?></th>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>SHIPING</th>
										<td colspan="2">Free Shipping</td>
									</tr>
									<tr>
										<th class="empty" colspan="3"></th>
										<th>TOTAL</th>
										<th colspan="2" class="total"><?= $cartItems['finalSum'] . CURRENCY ?></th>
									</tr>
								</tfoot>
							</table>
							<div class="pull-right">
                              <a class="primary-btn go-checkout" href="<?= LANG_URL . '/checkout' ?>">
            <?= lang('checkout') ?> 
            <i class="fa fa-credit-card-alt" aria-hidden="true"></i>
        </a>
							
							</div>
						</div>
 <?php } ?>
					</div>
				
			</div>
            <?php
if ($this->session->flashdata('deleted')) {
    ?>
    <script>
        $(document).ready(function () {
            ShowNotificator('alert-info', '<?= $this->session->flashdata('deleted') ?>');
        });
    </script>
<?php } ?>