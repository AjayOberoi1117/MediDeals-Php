<?php if ($this->session->flashdata('update_vend_err')) { ?>
    <div class="alert alert-danger"><?= implode('<br>', $this->session->flashdata('update_vend_err')) ?></div>
<?php } ?>
<?php if ($this->session->flashdata('update_vend_details')) { ?>
    <div class="alert alert-success"><?= $this->session->flashdata('update_vend_details') ?></div>
<?php } ?>

<?php
//var_dump($this->vendor_type);
if($this->vendor_type !== "Retailer")
{	?>
<h2>Selling Details</h2>
<div class="content"><br>
	
<div class="row">

        <div class="col-lg-12">
          <p>
            <a href="<?php echo base_url('vendor/products');?>" class="btn btn-sq-lg btn-primary" style="width:230px; height:200px;"><br>
               <i class="mdi mdi-format-list-bulleted" ></i><br/>
                Total Listed<br> Products<br><b><?php print_r($rowscount); ?></b>
            </a>
			<a href="<?php echo base_url('vendor/products/activeproducts');?>" class="btn btn-sq-lg btn-success" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-border-bottom"></i><br/>
			  Total Active <br>Product<br/><b><?php print_r($activeproduct); ?></b>
            </a>
			 <a href="<?php echo base_url('vendor/products/inactiveproducts');?>" class="btn btn-sq-lg btn-warning" style="width:230px; height:200px;"><br>
             <i class="mdi mdi-account-box-outline"></i><br/>
			 Total Inactive<br> Products<br/><b><?php print_r($inactiveproduct);?></b>
            </a>
            <a href="<?php echo base_url('vendor/products/subscribe');?>" class="btn btn-sq-lg btn-danger" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-apps"></i><br/>
            Subscription <br/>End Date <br>
			<!-- Three Months after Registration Date -->
			<?php echo date('d/m/y',strtotime($sub_date['created_at']) + 7776000); ?>
            </a>
          </p>
        </div>
	</div><br/>
	<div class="row">
        <div class="col-lg-12">
          <p>
		   
           <a href="<?php echo base_url('vendor/orders');?>" class="btn btn-sq-lg btn-danger"style="width:230px; height:200px;"><br>
              <i class="mdi mdi-flip-to-front"></i><br/>
			 Total Orders <br>Received <br/><b><?php echo $ordersreceive; ?></b>
            </a>  
			<a href="<?php echo base_url('vendor/orders/odispatched');?>" class="btn btn-sq-lg btn-success" style="width:230px; height:200px;"><br>
             <i class="mdi mdi-file-image"></i><br/>
            Total Orders <br/>Dispatched  <br/><b><?php echo $orderdispatched;?></b>  

            </a>
            <a href="<?php echo base_url('vendor/orders/odelivered');?>" class="btn btn-sq-lg btn-warning" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-apps"></i><br/>
            Total Orders <br/>Delivered  <br/><b><?php 
			 echo $ordersdelivered ;?></b> 

            </a> 
			<a href="<?php echo base_url('vendor/orders/oreturn');?>" class="btn btn-sq-lg btn-primary" style="width:230px; height:200px;"><br>
               <i class="mdi mdi-arrow-expand"></i><br/>
                Total Orders<br> Return<br/><b><?php  echo $orderreturns;?></b>  
            </a>
			 
          </p>
        </div>
	</div><br/>
	<div class="row">
        <div class="col-lg-12">
          <p>
			<a href="#" class="btn btn-sq-lg btn-primary"style="width:230px; height:200px;"><br>
             <i class="mdi mdi-view-column"></i><br/>
             Total Revenue <br/><b>Rs. <?php 
			 $total = 0;
			 foreach($totalrevenue as $totalrev)
			 {
				$total =  $total + floatval($totalrev->order_quantity) * floatval(str_replace(',','',$totalrev->individual_price));
			 }
			 echo number_format($total,2);?></b>  
            </a>
			<a href="#" class="btn btn-sq-lg btn-warning" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-file-image"></i><br/>
			Total Money in <br/>Escrow <br/><b>Rs. <?php 
			 $total = 0;
			 foreach($whsmoneyescrow as $whsmny)
			 {
				$total =  $total + floatval($totalrev->order_quantity) * floatval(str_replace(',','',$totalrev->individual_price));
			 }
			 echo number_format($total,2);?></b>   

            </a>
			<a href="#" class="btn btn-sq-lg btn-success" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-file-image"></i><br/>
             <!-- Total Product<br> Sold<br><b><?php $prsold = 0;
			 foreach($productsold as $productsell) 
			 {
				$prsold = $prsold + $productsell->productssold;
			 }
			// echo $prsold ;?></b>-->
            </a>
			
			<a href="#" class="btn btn-sq-lg btn-danger" style="width:230px; height:200px;"><br>
             <i class="mdi mdi-file-image"></i><br/>
             <!--   Total Product<br> Return<br><b><?php $prreturn = 0;
			 foreach($productreturn as $productret) 
			 {
				$prreturn = $prreturn + $productret->productsreturn;
			 }
			 //echo $prreturn ;?></b>-->
            </a> 
          </p>
        </div>
	</div>
<!--<div>
<span>Total Listed Products:&nbsp;</span><b><?//php print_r($rowscount); ?></b>
</div><br/>
<div>
<span>Total Orders:&nbsp;</span><b><?//php  print_r($ordercount);?></b>
</div><br/>
<div>
<span>This Month Sale:&nbsp;</span><b><?//php print_r($monthorders); ?></b>
</div>-->


    <!--<script src="<?//= base_url('assets/highcharts/highcharts.js') ?>"></script>
    <div id="container-by-month" style="min-width: 310px; height: 400px; margin: 0 auto;"></div>
    <script>
        /*
         * Chart for orders by mount/year 
         */
        $(function () {
            Highcharts.chart('container-by-month', {
                title: {
                    text: 'Total Monthly Orders',
                    x: -20
                },
                subtitle: {
                    text: 'Source: Orders table',
                    x: -20
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                        'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    title: {
                        text: 'Orders'
                    },
                    plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                },
                tooltip: {
                    valueSuffix: ' Orders'
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                series: [
<?//php foreach ($ordersByMonth['years'] as $year) { ?>
                        {
                            name: '<?//= $year ?>',
                            data: [<?//= implode(',', $ordersByMonth['orders'][$year]) ?>]
                        },
<?php //} ?>
                ]
            });
        });
    </script>-->
    
</div>
	<?php 
} ?>
<h2>Buying Details</h2>
<div class="content"><br>
<div class="row">
        <div class="col-lg-12">
          <p>
            <a href="<?php echo base_url('customer/order');?>" class="btn btn-sq-lg btn-primary" style="width:230px; height:200px;"><br>
               <i class="mdi mdi-format-list-bulleted" ></i><br/>
                Total Orders <br>Placed <br/><b><?php echo $totalorderplaced[0]->totalorders ; ?></b>   

            </a>
            <a href="<?php echo base_url('customer/orderreceive');?>" class="btn btn-sq-lg btn-success" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-border-bottom"></i><br/>
			  Total Orders <br/>Received <br/><b><?php  echo $totalorderreceived;?></b>    
			
            </a>
           
            <a href="<?php echo base_url('customer/orderreturn');?>" class="btn btn-sq-lg btn-warning" style="width:230px; height:200px;"><br>
             <i class="mdi mdi-account-box-outline"></i><br/>
			 Total Order <br>Return  <br/><b><?php  echo $totalorderreturned;?></b>    

              
            </a>
            <a href="<?php echo base_url('customer/orderreceive');?>" class="btn btn-sq-lg btn-info" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-file-image"></i><br/>
             Total Products </br>Received <br/><b>
			 <?php 
			 $productrec = 0;
			 foreach($totalproductreceive as $productreceive) 
			 {
				$productrec = $productrec + $productreceive->productsorder;
			 }
			 echo $productrec ;
			 ?>
			 </b>     

            </a>
          </p>
        </div>
	</div><br/>
	<div class="row">
        <div class="col-lg-12">
          <p>
		  <a href="<?php echo base_url('customer/orderreturn');?>" class="btn btn-sq-lg btn-info" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-file-image"></i><br/>
               Total Products <br/>Returned <br/><b><?php  $productrec = 0;
			 foreach($totalproductreturn as $productreturn) 
			 {
				$productrec = $productrec + $productreturn->productsreturn;
			 }
			 echo $productrec ;?></b>
            </a>
            <a href="#" class="btn btn-sq-lg btn-danger"style="width:230px; height:200px;">
			<br>
              <i class="mdi mdi-flip-to-front"></i><br/>
          
				Total Money<br> Spend <br/><b>Rs <?php
				if($moneyescrow[0]->amount == NULL) {echo 0;} else  {print_r(number_format(($moneyescrow[0]->amount),2));}?></b>
            </a>
		
			 <a href="<?php echo base_url('vendor/products/subscribe');?>" class="btn btn-sq-lg btn-success" style="width:230px; height:200px;"><br>
             <i class="mdi mdi-file-image"></i><br/>
             Subscription <br>End Date <br>
			<!-- Three Months after Registration Date -->
			<?php echo date('d/m/y',strtotime($sub_date['created_at']) + 7776000); ?>
            </a>
				
			 
           
           <a href="<?php echo base_url('customer/order');?>" class="btn btn-sq-lg btn-warning" style="width:230px; height:200px;"><br>
              <i class="mdi mdi-apps"></i><br/>
            Last Order <br/><b><?php  if(@$lastorder[0]->order_id == null || @$lastorder[0]->order_id == "") {echo 0;}
			else{	
			echo $lastorder[0]->order_id;}?></b>


            </a> 
          </p>
        </div>
	</div><br/>
	

    
</div>