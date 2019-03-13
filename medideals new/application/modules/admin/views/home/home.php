<script src="<?= base_url('assets/highcharts/highcharts.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/data.js') ?>"></script>
<script src="<?= base_url('assets/highcharts/drilldown.js') ?>"></script>
<h1><img src="<?= base_url('assets/imgs/admin-home.png') ?>" class="header-img" style="margin-top:-3px;"> Home</h1>
<hr>
<div class="home-page">
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Dashboard - Statistics Overview
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
                              <center><h3><?php print_r($wholeseller);?></h3></center>
							
                            <h4>Total Wholesaler Registered</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/vendors">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                       
                        <div class="col-xs-12 ">
                              <center><h3><?php print_r($retailer);?></h3></center>
                            <h4>Total Retailer Registered</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/vendors">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
                          <center><h3><?php print_r($pcdcompanies);?></h3></center>
                            <h4>Total PCD Companies Registered</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/pcdcompanies_show">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
                           <center><h3><?php print_r($thirdparty);?></h3></center>
                            <h4>Total 3rd Party MFG. Registered</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/3rd_party">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
						 <center><h3><?php print_r($listproducts);?></h3></center>
                          
                            <h4>Total Listed Products</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/products">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		 <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
                         
						 <center><h3><?php print_r($activeproduct);?></h3></center>
                            <h4>Total Active Products</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/products">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
						
						<center><h3><?php print_r($inactiveproduct);?></h3></center>
                             <h4>Total Inactive Products</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/products">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12">
                            
							<center><h3><?php print_r($productsold);?></h3></center>
                            <h4>Total Products Sold</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/orders">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                       
                        <div class="col-xs-12 ">
                           
						   <center><h3><?php print_r($productreturn);?></h3></center>
                            <h4>Total Products Return</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/orders">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
                            
							<center><h3><?php print_r($ordersCount);?></h3></center>
                            <h4>Total Orders Received</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/orders">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                       
                        <div class="col-xs-12 ">
                         
						 <center><h3><?php print_r($orderdelivered);?></h3></center>
                            <h4>Total Orders Delivered</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/orders">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
                         <center><h3><?php print_r($users);?></h3></center>
                            <h4>Active Sub Admin</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/adminusers">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
                           
						   <center><h3>Rs. <?php print_r (number_format(($finalamount),2));?></h3></center>
                            <h4>Total Revenue</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/orders">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		 <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
						<center><h3>Rs. <?php print_r(number_format(($moneyescrow),2));?></h3></center>
                           
                            <h4>Total Money in Escrow</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/orders">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                        
                        <div class="col-xs-12 ">
                            
							 <center><h3><?php print_r($customerenquiries);?></h3></center>
                            <h4>No. of Enquiries</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/customer_enquiries">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
		<div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading fast-view-panel">
                    <div class="row">
                       
                        <div class="col-xs-12">
						<center><h3><?php print_r($vendorresponse);?></h3></center>
                          
                            <h4>No. of Responses</h4>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url();?>admin/show_responses">
                    <div class="panel-footer">
                        <span class="pull-left">Click Here</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
  </div>

