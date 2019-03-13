<link href="<?= base_url('assets/css/bootstrap-toggle.min.css') ?>" rel="stylesheet">
<div>
   <!-- <h1><img src="<?//= base_url('assets/imgs/orders.png') ?>" class="header-img" style="margin-top:-2px;"> Orders <?//= isset($_GET['settings']) ? ' / Settings' : '' ?></h1>-->
    <?php /*if (!isset($_GET['settings'])) { ?>
        <a href="?settings" class="pull-right orders-settings"><i class="fa fa-cog" aria-hidden="true"></i> <span>Settings</span></a>
    <?php } else { ?>
        <a href="<?= base_url('admin/orders') ?>" class="pull-right orders-settings"><i class="fa fa-angle-left" aria-hidden="true"></i> <span>Back</span></a>
    <?php } */ ?>
</div>
<h1> Customer Orders</h1>
<hr>

<?php

if (!isset($_GET['settings'])) {
    if (!empty($orders)) {
        ?>
        <!--<div style="margin-bottom:10px;">
            <select class="selectpicker changeOrder">
                <option <?//= isset($_GET['order_by']) && $_GET['order_by'] == 'id' ? 'selected' : '' ?> value="id">Order by new</option>
                <option <?//= (isset($_GET['order_by']) && $_GET['order_by'] == 'processed') || !isset($_GET['order_by']) ? 'selected' : '' ?> value="processed">Order by not processed</option>
            </select>
        </div>-->
        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Order From</th>
                        <th>Customer Phone No.</th>
						<th class="text-center">Total Amount</th>
                        <th class="text-center">Payment Status</th>
                        <th class="text-center">Preview</th>
                    </tr>
                </thead>
                <tbody>
				
                    <?php
					//var_dump($orders); die;
					$i = 0;
                    foreach ($orders as $tr) {
                        if ($tr['processed'] == 0) {
                            $class = 'bg-danger';
                            $type = 'No processed';
                        }
                        if ($tr['processed'] == 1) {
                            $class = 'bg-success';
                            $type = 'Processed';
                        }
                        if ($tr['processed'] == 2) {
                            $class = 'bg-warning';
                            $type = 'Rejected';
                        }
                        ?>
                        <tr>
                            <td class="relative" id="order_id-id-<?= $tr['order_id'] ?>">
                                # <?= $tr['order_id'] ?>
                                <?php /* if (@$tr['viewed'] == 0) { ?>
                                    <div id="new-order-alert-<?= $tr['id'] ?>">
                                        <img src="<?= base_url('assets/imgs/new-blinking.gif') ?>" style="width:100px;" alt="blinking">
                                    </div>
                                <?php } ?>
                                <div class="confirm-result">
                                    <?php if (@$tr['confirmed'] == '1') { ?>
                                        <span class="label label-success">Confirmed by email</span>
                                    <?php } else { ?> 
                                        <span class="label label-danger">Not Confirmed</span> 
                                    <?php } ?>
                                </div>
								<?php */?>
                            </td>
                            <td><?= date('d.M.Y / H:m:s', $tr['date']); ?></td>
                            <td>
                                <i class="fa fa-user" aria-hidden="true"></i> 
                                <?= $tr['first_name'] . '<br> Alias Name : ' . $tr['last_name'] .'<br> Email : '. $tr['email'] .'<br> Address : '.$tr['address']; ?>
                            </td>
                            <td><i class="fa fa-phone" aria-hidden="true"></i> <?= $tr['phone']?></td>       
                            <td>Rs. <?= $tr['final_amount']?></td>       
                            
                           <td class="<?= $class ?> text-center" data-action-id="<?= $tr['id'] ?>">
                                <?php if($tr['money_status'] == 0)
									  echo "<font color='red'>Pending from Customer Side</font><br>";
									  else if($tr['money_status'] == 1)
									  echo "<font color='blue'>Received from Customer Side</font><br>";
									  else if($tr['money_status'] == 2)
									  echo "<font color='green'>Sent to Wholeseller</font><br>";
									  else if($tr['money_status'] == 3)
									  echo "<font color='orange'>Returned back to Customer</font><br>";
									  ?>
									  <br>
								<form action="<?php echo base_url('admin/ecommerce/orders/changeMoneyStatus');?>" method="post">
								<input type="hidden" name="odriid" value="<?= $tr['order_id'] ?>">
								<select name = "moneystat">
								<option value = "0">Select Status</option>
								<option value = "1">Received</option>
								<option value = "2">Sent to Wholeseller</option>
								<option value = "3">Sent back to customer</option>
								</select><br>
								<input type="submit" name="monsub" value="Go">
								</form>
                             <!--
                                <div style="margin-bottom:4px;"><a href="<?php //echo base_url('admin/ecommerce/orders/changeMoneyStatus/'.$tr['id'].'/'.'1'); ?>"  class="btn btn-success btn-xs">Transferred</a></div>
                                <div style="margin-bottom:4px;"><a href="<?php //echo base_url('admin/ecommerce/orders/changeMoneyStatus/'.$tr['id'].'/'.'0'); ?>"  class="btn btn-danger btn-xs">On Hold</a></div>
                               -->
                            </td>
                            
                            
                            
                            
                            <td class="text-center">
                                <a href="javascript:void(0);" class="btn btn-default more-info" data-toggle="modal" data-target="#modalPreviewMoreInfo" style="margin-top:10%;" data-more-info="<?= $tr['order_id'] ?>">
                                    More Info 
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td class="hidden" id="order-id-<?= $tr['order_id'] ?>">
                                <div class="table-responsive">
                                    <table class="table more-info-purchase">
                                        <tbody>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td><?= $tr['email'] ?></a></td>
                                            </tr>
                                           
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td><?= str_replace("#@%"," ",$tr['address']); ?></td>
                                            </tr>
                                        
                                            <tr>
                                                <td><b>Phone Number</b></td>
                                                <td><?= $tr['phone'] ?></td>
                                            </tr>
                                            <?php
											$j = 1;
											foreach($vendor_order[$i] as $ven_order)
											{ 
											
											?>
											<tr>
											<td colspan="2" style="text-align:center"><b> Product <?php echo $j;?></b></td></tr>
                                            <tr>
												<td colspan="2">
												Product Name : <b><?php echo $ven_order["title"];?></b> |
												
												Product URL : <a href="<?php echo base_url().$ven_order["url"];?>" target="_blank"style="color:#000 !important"> Click Here </a> 
												</td>
											</tr>
											<tr>
												<td colspan="2">
												<b>Wholeseller Details </b><br>
												Alias Name : <b><?php echo $ven_order["name"];?> | </b>
												Email : <b><?php echo $ven_order["email"];?> | </b>
												Mobile : <b><?php echo $ven_order["contact_no"];?> | </b>
												Firm Name : <b><?php echo $ven_order["firm_name"];?> | </b> 
												Address : <b><?php echo str_replace('#@%',' ',$ven_order["firm_address"]);?></b>
												</td>
											</tr>
											<tr>
                                                <td colspan="2">
                                                Order Quantity : <?php echo $ven_order["order_quantity"];?> |   

                                                Individual Price : Rs. <?php echo $ven_order["individual_price"];?> | 

                                                Total Price = Rs. <?php $er = floatval($ven_order["order_quantity"]) * floatval($ven_order["individual_price"]);											
                                                echo number_format((float)$er, 2, '.', '');
												?>
												</td>
                                            </tr>
											<tr>
                                                <td colspan="2">
                                                 
												<form action="" method="post">
												Order Status :
											    <?php
												if($ven_order["orders_status"] == 0)
												{ echo "Confirmation Pending";}
												elseif($ven_order["orders_status"] == 1)
												{ echo "Order Confirmed";}
												elseif($ven_order["orders_status"] == 2)
												{ echo "Order Shipped";}
												elseif($ven_order["orders_status"] == 3)
												{ echo "Order Delivered";}
												elseif($ven_order["orders_status"] == 4)
												{ echo "Order Returned";}
												elseif($ven_order["orders_status"] == 5)
												{ echo "Order Cancelled";}
												else
												{ echo "Error";}
												?> | 
												<input type="hidden" name="productid" value="<?php echo $ven_order['products'];?>">
												<input type="hidden" name="odrid" value="<?php echo $ven_order['order_id'];?>">
												<input type="hidden" name="vdrid" value="<?php echo $ven_order['vendor_id'];?>">
												<select name="odrstatus"> 
													<option value="">Select</option>
													<option value="0">Not Confirmed</option>
													<option value="1">Order Confirmed</option>
													<option value="2">Order Shipped</option>
													<option value="3">Order Delivered</option>
													<option value="4">Order Returned</option>
													<option value="5">Order Cancelled</option>
												</select> | 
												<input type="submit" name="odrsub" value="Change Status">
												</form>
                                                </td>
                                            </tr>
											<tr>
                                                <td colspan="2">   
												<form action="" method="post">
												Docket Number : 
												<?php if($ven_order["docket_number"] == "")
													  {echo "To be Shipped";}
													  else
													  {echo $ven_order["docket_number"];}
												?>
												 | 
												<input type="hidden" name="productid" value="<?php echo $ven_order['products'];?>">
												<input type="hidden" name="odrid" value="<?php echo $ven_order['order_id'];?>">
												<input type="hidden" name="vdrid" value="<?php echo $ven_order['vendor_id'];?>">
												<input type="text" name="dktno" placeholder="Insert Docket No."> | 
												<input type="submit" name="dktsub" value="Add/Edit Docket No.">
												</form>
                                                </td>
                                            </tr>
											<tr>
											<td colspan="2">
											<form action="" method="post">
											Wholeseller Payment : 
											<?php 
											if($ven_order['money_status'] == 0)
											echo "<font color='red'>Pending from Customer</font>";
											else if($ven_order['money_status'] == 1)
											echo "<font color='blue'>Received in Escrow </font>";
											else if($ven_order['money_status'] == 2)
											echo "<font color='green'>Sent to Wholeseller</font>";
											else if($ven_order['money_status'] == 3)
											echo "<font color='orange'>Returned to Customer</font>";
											else 
											echo "Error";
											?> | 
											<input type="hidden" name="productid" value="<?php echo $ven_order['products'];?>">
											<input type="hidden" name="odrid" value="<?php echo $ven_order['order_id'];?>">
											<input type="hidden" name="vdrid" value="<?php echo $ven_order['vendor_id'];?>">
											<select name="whmonstatus"> 
													<option value="">Select</option>
													<option value="0">Pending from Customer</option>
													<option value="1">Received in Escrow </option>
													<option value="2">Sent to Wholeseller</option>
													<option value="3">Returned to Customer</option>
													</select> | 
												<input type="submit" name="whmonsub" value="Change">
												</form>
											</td>
											</tr>
											<?php
											$j++;    
											}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
        </div>
        <?= $links_pagination ?>
    <?php } else { ?>
        <div class="alert alert-info">No orders to the moment!</div>
    <?php }
    ?>        
    <hr>
    <?php
}
if (isset($_GET['settings'])) {
    ?>
    <h3>Cash On Delivery</h3>
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">Change visibility of this purchase option</div>
                <div class="panel-body">
                    <?php if ($this->session->flashdata('cashondelivery_visibility')) { ?>
                        <div class="alert alert-info"><?= $this->session->flashdata('cashondelivery_visibility') ?></div>
                    <?php } ?>
                    <form method="POST" action="">
                        <input type="hidden" name="cashondelivery_visibility" value="<?= $cashondelivery_visibility ?>">
                        <input <?= $cashondelivery_visibility == 1 ? 'checked' : '' ?> data-toggle="toggle" data-for-field="cashondelivery_visibility" class="toggle-changer" type="checkbox">
                        <button class="btn btn-default" value="" type="submit">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>Paypal Account Settings</h3>
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Paypal sandbox mode (use for paypal account tests)</div>
                <div class="panel-body">
                    <?php if ($this->session->flashdata('paypal_sandbox')) { ?>
                        <div class="alert alert-info"><?= $this->session->flashdata('paypal_sandbox') ?></div>
                    <?php } ?>
                    <form method="POST" action="">
                        <input type="hidden" name="paypal_sandbox" value="<?= $paypal_sandbox ?>">
                        <input <?= $paypal_sandbox == 1 ? 'checked' : '' ?> data-toggle="toggle" data-for-field="paypal_sandbox" class="toggle-changer" type="checkbox">
                        <button class="btn btn-default" value="" type="submit">
                            Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Paypal business email</div>
                <div class="panel-body">
                    <?php if ($this->session->flashdata('paypal_email')) { ?>
                        <div class="alert alert-info"><?= $this->session->flashdata('paypal_email') ?></div>
                    <?php } ?>
                    <form method="POST" action="">
                        <div class="input-group">
                            <input class="form-control" placeholder="Leave empty for no paypal available method" name="paypal_email" value="<?= $paypal_email ?>" type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-default" value="" type="submit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Paypal currency (make sure is supported from paypal!)</div>
                <div class="panel-body">
                    <?php if ($this->session->flashdata('paypal_currency')) { ?>
                        <div class="alert alert-info"><?= $this->session->flashdata('paypal_currency') ?></div>
                    <?php } ?>
                    <form method="POST" action="">
                        <div class="input-group">
                            <input class="form-control" name="paypal_currency" value="<?= $paypal_currency ?>" type="text">
                            <span class="input-group-btn">
                                <button class="btn btn-default" value="" type="submit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <h3>Bank Account Settings</h3>
    <div class="row">
        <div class="col-sm-6">
            <?php if ($this->session->flashdata('bank_account')) { ?>
                <div class="alert alert-info"><?= $this->session->flashdata('bank_account') ?></div>
            <?php } ?>
            <form method="POST" action="">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td colspan="2"><b>Pay to - Recipient name/ltd</b></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="text" name="name" value="<?= $bank_account != null ? $bank_account['name'] : '' ?>" class="form-control" placeholder="Example: BoxingTeam Ltd."></td>
                            </tr>
                            <tr>
                                <td><b>IBAN</b></td>
                                <td><b>BIC</b></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" value="<?= $bank_account != null ? $bank_account['iban'] : '' ?>" name="iban" placeholder="Example: BG11FIBB329291923912301230"></td>
                                <td><input type="text" class="form-control" value="<?= $bank_account != null ? $bank_account['bic'] : '' ?>" name="bic" placeholder="Example: FIBBGSF"></td>
                            </tr>
                            <tr>
                                <td colspan="2"><b>Bank</b></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="text" value="<?= $bank_account != null ? $bank_account['bank'] : '' ?>" name="bank" class="form-control" placeholder="Example: First Investment Bank"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <input type="submit" class="form-control" value="Save Bank Account Settings">
            </form>
        </div>
    </div>
<?php } ?>
<!-- Modal for more info buttons in orders -->
<div class="modal fade" id="modalPreviewMoreInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Preview <b id="client-name"></b></h4>
            </div>
            <div class="modal-body" id="preview-info-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type='text/javascript'>
  $(document).ready(function(){
 
   $('#sel_user').change(function(){
    var username = $(this).val();
   
 $.ajax({
      url:'<?=base_url()?>admin/ecommerce/Orders/changeMoneyStatus/',
       type: 'POST',
        data: {username: username},
       success: function(){
           //alert(data);
          
       },
       error: function(){
           //alert("Fail")
       }
   });
   e.preventDefault(); // could also use: return false;
 });
});
 </script>
<script src="<?= base_url('assets/js/bootstrap-toggle.min.js') ?>"></script>
