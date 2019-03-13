<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<script type="text/javascript">
function changeodrstatus(val, id)
{
	pid = document.getElementById('productid['+id+']').value;
	orid = document.getElementById('odrid['+id+']').value;
	orval = document.getElementById('ordrinfo['+id+']').innerHTML;
	//alert(pid+' '+orid+' '+orval+' '+val);
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>vendor/orders/changeorderstatus",
        dataType: "text",
		data: {productid : pid, odrid : orid, odrstatus: val, action : 'odrsub'},
		
		success: function(result) {
			//alert('success'+val);
			val = parseInt(val);
			if(val == 0)
			orval = "Confirmation Pending"; 
			else if(val == 1)
			orval ="Order Confirmed";
			else if(val == 2)
			orval ="Order Shipped";
			else if(val == 3)
			orval ="Order Delivered";
			else if(val == 4)
			orval ="Order Returned";
			else if(val == 5)
			orval ="Order Canceled";
			else
			orval ="Error";	
			
			document.getElementById('opval['+id+']').value = val;
			document.getElementById('ordrinfo['+id+']').innerHTML = orval; 
			document.getElementById('opval['+id+']').text = orval; 
		},
		error: function(error) {
			alert(error);
		},
		});	
}
function changedktstatus(id)
{
	pid = document.getElementById('productid['+id+']').value;
	orid = document.getElementById('odrid['+id+']').value;
	dktno = document.getElementById('dktno['+id+']').value;
	alert(dktno);
	$.ajax({
		type: "POST",
		url: "<?php echo base_url();?>vendor/orders/changedktstatus",
        dataType: "text",
		data: {productid : pid, odrid : orid, dktno: dktno,action : 'odrsub'},
		
		success: function(result) {	
			alert(result);
			document.getElementById('dktinfo['+id+']').innerHTML = dktno; 
			document.getElementById('dktno['+id+']').value = dktno; 
		},
		error: function(error) {
			alert(error);
		},
	});	
}
</script>
<div class="content orders-page">

    <table class="table">
        <thead class="blue-grey lighten-4" >
            <tr>
				
                <th>Order Number</th>
                <th><?php echo "Order Date"; ?></th>   
                <th><?php echo "Customer Number"; ?></th>
                <th><?php echo "Order Status";  ?></th>
                <th>Docket Number</th>
                <th>Money Status</th>
                <th class="text-right"><i class="fa fa-list" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <tbody>
            <?php
			//var_dump($productdetails);die;
            $i = 0;
			$_SESSION['totalorder']=count($orders);
		
            foreach ($orders as $order) {
				
                $workid = $productdetails[$i]['id'].$order['order_id'];
                //$product = unserialize($order['products']);
                //foreach ($product as $prod_id => $prod_qua) {
                        // echo $prod_id;
				//		}
                ?>
				
                <tr>
				
                <input type="hidden" value="<?= $order['order_id'] ?>" id="pid"/>
                    <td><?= $order['order_id'] ?></td>
                    <td><?= date('d/m/Y', $order['date']); ?></td>
                 
                    <td><?= $order['phone'] ?></td>
                   
                    <td><span id ="ordrinfo[<?= $workid;?>]">
					    <?php
						$ordersta = null;
						if($order["orders_status"] == 0)
						{ echo "Confirmation Pending"; 
					      $ordersta ="Confirmation Pending";}
						elseif($order["orders_status"] == 1)
						{ echo "Order Confirmed";
						  $ordersta ="Order Confirmed";}
						elseif($order["orders_status"] == 2)
						{ echo "Order Shipped";
						  $ordersta ="Order Shipped";}
						elseif($order["orders_status"] == 3)
						{ echo "Order Delivered";
						  $ordersta ="Order Delivered";}
						elseif($order["orders_status"] == 4)
						{ echo "Order Returned";
						  $ordersta ="Order Returned";}
						elseif($order["orders_status"] == 5)
						{ echo "Order Canceled";
						  $ordersta ="Order Canceled";}
						else
						{ echo "Error";
					      $ordersta ="Error";}
						?></span> <br><br>
						<form action="" method="post">
						<input type="hidden" id="productid[<?= $workid;?>]" name="productid" value="<?php echo $productdetails[$i]['id'];?>">
						<input type="hidden" id="odrid[<?= $workid;?>]" name="odrid" value="<?php echo $order['order_id'];?>">
                        <select class="change-ord-status" name="odrstatus" id ="odrstatus[<?= $workid;?>]" onchange="changeodrstatus(this.value,<?= $workid;?>)"> 
							<option id = "opval[<?= $workid;?>]"                value="<?php echo $order["orders_status"]; ?>"><?php echo $ordersta;?></option>
                            <option value="0">Not Confirmed</option>
							<option value="1">Order Confirmed</option>
							<option value="2">Order Shipped</option>
							<option value="3">Order Delivered</option>
							<option value="4">Order Returned</option>
							<option value="5">Order Cancelled</option>
                        </select><br><br><br><br>
						</form>
                    </td>
                    <td><span id ="dktinfo[<?= $workid;?>]">
						<?php if($order["docket_number"] == "")
							  {echo "Awaited";}
							  else
							  {echo $order["docket_number"];}
						?>
						</span><br><br>
						<form>
						<input type="hidden" name="productid" id="productid[<?= $workid;?>]"value="<?php echo $productdetails[$i]['id'];?>">
						<input type="hidden" name="odrid" id="odrid[<?= $workid;?>]" value="<?php echo $order['order_id'];?>">
                        <textarea name="dktno" id="dktno[<?= $workid;?>]" <?php if($order["docket_number"] == ""){echo "placeholder = 'Insert Shipping Details & Docket No.'";}?>><?php if($order["docket_number"] == "")
							  {echo "";}
							  else
							  {echo $order["docket_number"];}
						?></textarea>
						<br><br>
						<input type="button" name="dktsub" value="Add/Edit Docket No." onclick="changedktstatus(<?= $workid;?>)">
						</form>
						  
                    </td>
                    <td  data-action-id="<?= $order['id'] ?>">
                                <?php 
								if($order['money_status'] == 0)
								echo "<font color='red'>Pending</font><br>";
								else if($order['money_status'] == 1)
								echo "<font color='blue'>Received in Escrow Account</font><br>";
								else if($order['money_status'] == 2)
								echo "<font color='green'>Sent to Account by Medideals</font><br>";
								else if($order['money_status'] == 3)
								echo "<font color='orange'>Returned back to Medideals</font><br>";
								else 
								echo "Error<br>";
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
                                        <b>Order Number #</b> <span><?= $order['order_id'] ?></span>
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
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <?php
									//var_dump($productdetails);
			                        //var_dump($productinfo); die;
                                ?>
                                    <div class="product">
                                        <a href="" target="_blank">
                                            <img src="<?//= base_url('/attachments/shop_images/' . $productInfo['image']) ?>" alt="">
											<span>
											<?php //var_dump($productInfo); die;?>
											<b><a href="<?php echo base_url().$productdetails[$i]['url'];?>" target="_blank">Click here for Product Details</a></b>
											</span>
											<div class="info">
												<span class="qiantity">
													<b><?php echo "Product Name"; ?> :</b> 
													<?php echo $productinfo[$i]['title']; ?>
												</span>
											</div>
											<div class="info">
												<span class="qiantity">
													<b><?php echo "Price per Item"; ?> :</b> 
													Rs. <?php echo $productinfo[$i]['price']; ?>
												</span>
											</div>
                                            <div class="info">
                                                <span class="qiantity">
                                                    <b><?= lang('quantity') ?> :</b> <?echo $order["order_quantity"] ?>
                                                </span>
                                            </div>
											<div class="info">
                                                <span class="qiantity">
                                                    <b>Company :</b> <?php echo $productdetails[$i]['brand'];?>
                                                </span>
                                            </div>
											<div class="info">
                                                <span class="qiantity">
                                                    <b>Total Amount : Rs. </b> <?php echo floatval($order["order_quantity"])*floatval($productinfo[$i]['price']);?>
                                                </span>
                                            </div>
                                            <div class="clearfix"></div>
                                        </a>
                                    </div>
                                     <button id="print" onclick="printContent('invoice');" >Print</button>
                                
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
$('#hey').on('change', function(){    
   $.ajax({
      type : 'POST',
      url : '<?php echo base_url('vendor/orders/Save_docket/');  ?>', // --> server side code to insert data into db
      data : {
        val : $(this).val()
		//var myId = $(this).attr('pid')
      },
      success : function(msg){
        // msg -> return by server side
        // any code in success
        // if success will print out this 'New record created successfully'
        // if error will print out this 'Error occured'
        console.log(msg);
      }
  });
});
</script>
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