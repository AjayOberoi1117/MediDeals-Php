<?php 
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="<?= MY_LANGUAGE_ABBR ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?= $description ?>">
        <title><?= $title ?></title>
        <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/materialdesignicons.min.css') ?>">
        <link rel="stylesheet" href="<?= base_url('assets/css/vendors.css') ?>">
        <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body  onLoad="del('','')">
        <div id="wrapper">
            <div id="content">
                <nav class="navbar navbar-blue">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                            <i class="fa fa-lg fa-bars"></i>
                        </button>
                    </div>
					
                    <div id="navbar" class="collapse navbar-collapse">
					
					<ul class="nav navbar-nav navbar-left">
                        <li><a href="<?= base_url('vendor/me') ?>">
                                    <img alt="logo medideals" class="hidden-xs hidden-sm" src="/assets/images/logo-white.png">
                                </a></li>   
                        </ul>
						
						
                        <ul class="nav navbar-nav">
						
                            <li><a href="<?= base_url(); ?>"><i class="fa fa-home"></i> <?= lang('vendor_home') ?></a></li>
                        </ul>
						
						<ul class="nav navbar-nav">
						
                        <form method="POST" action="<?= LANG_URL . '/vendor/me' ?>" class="vendor-update">
						
                            Welcome  <strong><?php echo $_SESSION['firm_name']?></strong> Your Alias Name is : <input type="text" class="form-control" value="<?= $vendor_name ?>" name="vendor_name" placeholder="<?= lang('vendor_name') ?>" disabled>
                           
                        </form>
						</ul>
						
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?= LANG_URL . '/vendor/logout' ?>"><?= lang('vendor_logout') ?></a></li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
               
                    <div class="row">
					
                        <div class="col-sm-3 col-md-3 col-lg-2 left-side">
							<?php 
							//var_dump($this->vendor_type);
							if($this->vendor_type !== "Retailer")
							{	?>
                            <ul>
	
								<li>
                                    <a href="<?= LANG_URL . '/vendor/me' ?>" aria-expanded="false">
                                        <i class="mdi mdi-view-dashboard"></i>
                                        <span class="hide-menu"><?= lang('vendor_dashboard') ?></span>
                                    </a>
                                </li>
								<li style="border: 1px solid white;">
                                    <a href="" aria-expanded="false">
                                        <i class="mdi mdi-account-key"></i>
                                        <span class="hide-menu">Wholeseller Zone </span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="<?= LANG_URL . '/vendor/add/product' ?>" aria-expanded="false">
                                        <i class="mdi mdi-plus"></i>
                                        <span class="hide-menu"><?= lang('vendor_add_product') ?></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= LANG_URL . '/vendor/products' ?>" aria-expanded="false">
                                        <i class="mdi mdi-format-list-bulleted"></i>
                                        <span class="hide-menu">Show All Products</span>
                                    </a>
                                </li> 
								<li>
                                    <a href="<?= LANG_URL . '/vendor/products/subscribe' ?>" aria-expanded="false">
                                        <i class="mdi mdi-package-variant-closed"></i>
                                        <span class="hide-menu">Subscription</span>
                                    </a>
                                </li>
								
                                <li>
                                    <a href="<?= LANG_URL . '/vendor/orders' ?>" aria-expanded="false">
                                        <i class="mdi mdi-briefcase-check"></i>
                                        <span class="hide-menu">Order Received</span>
                                    </a>
                                </li>
								<li>
                                    <a href="<?= LANG_URL . '/vendor/bankdetails' ?>" aria-expanded="false">
                                        <i class="mdi mdi-bank"></i>
                                        <span class="hide-menu">Bank Details</span>
                                    </a>
                                </li>
								<li>
                                    <a href="<?= LANG_URL . '/vendor/products/Csv_import' ?>" aria-expanded="false">
                                        <i class="mdi mdi-file"></i>
                                        <span class="hide-menu">Upload Data</span>
                                    </a>
								</li>
							</ul>	
							<?php 
							} ?>	
                            <ul>
                                <li style="border: 1px solid white;">
                                    <a href="#" aria-expanded="false">
                                        <i class="mdi mdi-account-check"></i>
                                        <span class="hide-menu">Retailer Zone </span>
                                    </a></li>
                                    <li>
                                    <a href="<?= LANG_URL . '/customer/order' ?>" aria-expanded="false">
                                        <i class="mdi mdi-cart-plus"></i>
                                        <span class="hide-menu">Orders Placed</span>
                                    </a></li> 
                                     <li>
                                    <a href="<?= LANG_URL . '/vendor/profile' ?>" aria-expanded="false">
                                        <i class="mdi mdi-border-color"></i>
                                        <span class="hide-menu">Edit Profile</span>
                                    </a></li>
                                    
									
									<li>
                                    <a href="<?= LANG_URL . '/vendor/products/customer_enquiries' ?>" aria-expanded="false">
                                        <i class="mdi mdi-receipt"></i>
                                        <span class="hide-menu">Enquiry Form</span>
                                    </a></li>
									<li>
                                    <a href="<?= LANG_URL . '/vendor/products/show_responses' ?>" aria-expanded="false">
                                        <i class="mdi mdi-tooltip"></i>
                                        <span class="hide-menu">Show Responses</span>
                                    </a>
									</li>
									<li>
                                    <a href="<?= LANG_URL . '/vendor/affiliate' ?>" aria-expanded="false">
                                        <i class="mdi mdi-account-multiple-plus"></i>
                                        <span class="hide-menu">Affiliate Program</span>
                                    </a>
									</li>
							</ul>
					
                               
                                
                                 
                        </div>
					
                        </div>
						
                        <div class="col-sm-9 col-md-9 col-lg-10 col-sm-offset-3 col-md-offset-3 col-lg-offset-2 right-side">
                            <div class="page-titles">
                                <h2><?= $title ?></h2>
                            </div>