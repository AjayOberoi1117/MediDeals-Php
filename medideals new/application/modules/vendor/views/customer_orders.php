<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="content orders-page">
    <table class="table">
        <thead class="blue-grey lighten-4">
            <tr>
                <th>#</th>
                <th><?php echo "Order Date"; ?></th>
               
                <th><?= lang('phone') ?></th>
				<th><?php echo "Total Amount";?></th>
                
				<th><?php echo "Money Status";?></th>
                
                <th class="text-right"><i class="fa fa-list" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
			
            $i = 0; $at = 0;
            foreach ($orders as $order) {
                ?>
                <tr>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= date('d.m.Y', $order['date']) ?></td>
                   
                    <td><?= $order['phone'] ?></td>
					<td>Rs. <?= $order["final_amount"] ?></td>
					<td><?php 
							  if($order["money_status"] == 0)
						      { echo "<font color='blue'>Pending from Customer Side</font>"; }
							  else if($order["money_status"] == 1)
							  { echo "<font color='orange'>Money Received by Medideals</font>"; }
							  else if($order["money_status"] == 2)
							  { echo "<font color='green'>Money Received by Medideals</font>"; }
						      else if($order["money_status"] == 3)
							  { echo "<font color='green'>Money Refunded from Medideals</font>"; }
					?>
					</td>                          
                    <td class="text-right">
                        <a href="javascript:void(0);" class="btn btn-sm btn-green show-more" data-show-tr="<?= $i ?>">
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            <i class="fa fa-chevron-up" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
                <tr class="tr-more" data-tr="<?= $i ?>" id="invoice">
                    <td colspan="6">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul>
                                  <li>
                                        <b>Invoice #</b> <span><?= $order['order_id'] ?></span>
                                    </li>
                                    <li>
                                        <b>Bill To</b> <span><?= $order['first_name'] ?></span>
                                    </li>
                                    <li>
                                        <b>Address</b> <span><?= str_replace("#@%"," ",$order['address']); ?></span>
                                        <br/>
                                       
                                        <span><?= $order['city'] ?></span>
                                         <br/>
                                        
                                        <span><?= $order['post_code'] ?></span>
                                    </li>
                                    
                                     <li>
                                        <b>Ship To</b> <span><?= $order['first_name'] ?></span>
                                    </li>
                                    <li>
                                        <b>Address</b> <span><?= str_replace("#@%"," ",$order['address']); ?></span>
                                        <br/>
                                       
                                        <span><?= $order['city'] ?></span>
                                         <br/>
                                        
                                        <span><?= $order['post_code'] ?></span>
                                    </li>
                                    <li>
                                        <b><?= lang('email') ?></b> <span><?= $order['email'] ?></span>
                                    </li>
                                    <li>
                                        <b><?= lang('phone') ?></b> <span><?= $order['phone'] ?></span>
                                    </li>
                                  
                                    </li>
                                    <li>
                                        <b><?= lang('notes') ?></b> <span><?= $order['notes'] ?></span>
                                    </li>
									<li>
                                        <b><?php echo "Total Price : Rs. " ?></b> <span><?= $order["final_amount"] ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <?php
								
								// product status
								$orderprocessarray = array();
								$docketnumberarray = array();
								$rt = 0;
								foreach($order_process as $order_proc)
								{
									foreach($order_proc as $order_pro)
									{
										//var_dump($order_proc);die;
										$orderprocessarray[$rt] = $order_pro["orders_status"];
										$docketnumberarray[$rt] = $order_pro["docket_number"];
										$rt++;
									}	
								}
								// product information
								$productinformation = array();
								$productprice = array();
								$productid = array();
								$ft = 0;
								foreach($product_titles as $prod_titles)
								{
									foreach($prod_titles as $prod_title)
									{
										$productinformation[$ft] = $prod_title['title'];
										$productprice[$ft] = $prod_title['price'];
										$productid[$ft] = $prod_title['for_id'];
										$ft++;
									}
								}
								// product details
                                $product = unserialize($order['products']);
								$p = 1; $rt = 0; 
							
                                foreach ($product as $prod_id => $prod_qua) {
									
                                    $productInfo = modules::run('vendor/orders/getcustomerProductInfo', $prod_id);
							        //var_dump($productInfo);die;
									
                                    ?>
									
                                    <div class="product">
                                       <b> Product <?php echo $p; ?> </b> <br>
                                            <!--<img src="<?//= base_url('/attachments/shop_images/' . $productInfo['image']) ?>" alt="">-->
											<span>
											<?php //var_dump($productInfo); die;?>
											<b><a href="<?php echo base_url().$productInfo['url'];?>" target="_blank">Click here for Product Details</a></b>
											</span>
											<div class="info">
												<span class="qiantity">
													<b><?php echo "Product Name"; ?> :</b> 
														<?php echo $productinformation[$rt]; ?>
												</span>
											</div>
											<div class="info">
												<span class="qiantity">
													<b><?php echo "Price per Item"; ?> :</b> 
														Rs. <?php echo $productprice[$rt]; ?>
												</span>
											</div>
                                            <div class="info">
                                                <span class="qiantity">
                                                    <b><?= lang('quantity') ?> :</b> <?= $prod_qua ?>
                                                </span>
                                            </div>
											<div class="info">
                                                <span class="qiantity">
                                                    <b>Company :</b> <?= $productInfo['brand'];?>
                                                </span>
                                            </div>
                                            <div class="info">
                                                <span class="qiantity">
                                                    <b>Order Status :</b> 
													<?php
													if($orderprocessarray[$at] == 0)
												    { echo "Not Confirmed";}
													elseif($orderprocessarray[$at] == 1)
												    { echo "Confirmed";}
													elseif($orderprocessarray[$at] == 2)
												    { echo "Shipped";}
													elseif($orderprocessarray[$at] == 3)
												    { echo "Delivered";}
													elseif($orderprocessarray[$at] == 4)
												    { echo "Returned";}
													elseif($orderprocessarray[$at] == 5)
												    { echo "Cancelled";}
													else
												    { echo "Error";}
												    ?>
						<form action="" method="post">
						<input type="hidden" name="productid" value="<?php echo $prod_id;?>">
						<input type="hidden" name="odrid" value="<?php echo $order['order_id'];?>">
						<input type="hidden" name="wslrid" value="<?php echo $productInfo['vendor_id'];?>">
                        <select class="selectpicker change-ord-status" name="odrstatus"> 
							<option value="">Select</option>
							<option value="3">Goods Received</option>
							<option value="4">Order Returned</option>
                        </select>
						<input type="submit" name="odrsub1" value="Change Order Status">
						</form>
                                                </span>
                                            </div>
                                            <div class="info">
                                                <span class="qiantity">
                                                    <b>Shipment Docket Number:</b> 
													<?php
													
													if($docketnumberarray[$at] == "")
												    { echo "To be Shipped";}
													else
												    { echo $docketnumberarray[$at];
													}
												    ?>
                                                </span>
                                            </div>
                                    </div>
                                    
                                <?php 
								$p++; $rt++; $at++; }  ?>
								<button id="print" onclick="printContent('invoice');" >Print</button> 
									    <div class="clearfix"></div>
                            </div>
                        </div>
                    </td>
                </tr>
				
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
	<?= $links_pagination ?>
</div>
<script>
function printContent(el){
var restorepage = $('body').html();
var printcontent = $('#' + el).clone();
$('body').empty().html(printcontent);
window.print();
$('body').html(restorepage);
}
</script>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>