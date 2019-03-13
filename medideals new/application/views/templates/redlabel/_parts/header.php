<?php
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="zxx">
    <head>
       <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="<?= $description ?>" />
        <meta name="keywords" content="<?= $keywords ?>" />
        <meta property="og:title" content="<?= $title ?>" />
        <meta property="og:description" content="<?= $description ?>" />
        <meta property="og:url" content="<?= LANG_URL ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="<?= base_url('assets/img/site-overview.png') ?>" />
        <title><?= $title ?></title>
        <link href="images/favicon.ico" rel="icon" type="image/x-icon"><!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"><!-- Bootstrap -->
        <link href="<?= base_url('assets/');?>css/bootstrap.css" rel="stylesheet"><!--=== Add By Designer ===-->
        <link href="<?= base_url('assets/');?>css/style.css" rel="stylesheet">
        <link href="<?= base_url('assets/');?>fonts/fonts.css" rel="stylesheet"><!-- Yamm Megamenu -->
        <link href="<?= base_url('assets/');?>css/yamm.css" rel="stylesheet"><!-- Animation -->
        <link href="<?= base_url('assets/');?>css/animate.css" rel="stylesheet"><!-- Animation -->
        <!-- Flat Icon -->
        <link href="<?= base_url('assets/');?>fonts/flaticon.css" rel="stylesheet"><!-- Flat Icon -->
        <!-- Multi Level Push Menu -->
        <link href="<?= base_url('assets/');?>css/normalize.css" rel="stylesheet">
        <link href="<?= base_url('assets/');?>css/component.css" rel="stylesheet">
        <script src="<?= base_url('assets/');?>js/modernizr.custom.js">
        </script><!-- Multi Level Push Menu -->
        <!-- REVOLUTION STYLE SHEETS -->
        <link href="<?= base_url('assets/');?>js/revslider/settings.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/');?>js/revslider/layers.css" rel="stylesheet" type="text/css">
        <link href="<?= base_url('assets/');?>js/revslider/navigation.css" rel="stylesheet" type="text/css"><!-- REVOLUTION LAYERS STYLES -->

        
	<!-- Range Slider Start -->
	<link href="<?= base_url('assets/');?>css/jquery-ui.css" rel="stylesheet">
	<link href="<?= base_url('assets/');?>css/jquery-ui-slider-pips.css" rel="stylesheet"><!-- Range Slider End -->
	<!-- Jquery Ui Date Picker -->
	<!-- Selectric Start -->
	<link href="<?= base_url('assets/');?>css/selectric.css" rel="stylesheet"><!-- Selectric End -->
<script src="<?= base_url('assets/');?>css/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="<?= base_url('assets/');?>css/bootstrap.js" type="text/javascript"></script>
	<script src="<?= base_url('assets/');?>css/login-register.js" type="text/javascript"></script>
    
       <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
        <script src="<?= base_url('loadlanguage/all.js') ?>"></script>
        <?php if ($cookieLaw != false) { ?>
            <script type="text/javascript">
                window.cookieconsent_options = {"message": "<?= $cookieLaw['message'] ?>", "dismiss": "<?= $cookieLaw['button_text'] ?>", "learnMore": "<?= $cookieLaw['learn_more'] ?>", "link": "<?= $cookieLaw['link'] ?>", "theme": "<?= $cookieLaw['theme'] ?>"};
            </script>
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.10/cookieconsent.min.js"></script>
<?php } ?>
		<style>
		.theme-background-color {
			background-color: #337ab7;
		}
		</style>
    </head>

    <!-- Header Start -->
    <header class="header clearfix">
        <!-- Header Top Start -->
        <!--<div class="h-top clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-4">
                        <div class="h-left">
                            <p><span><i aria-hidden="true" class="fa fa-clock-o"></i> Welcome to Medideals!</span></p>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-8">
                        <div class="h-right">
                            
                            <div class="h-history-policy clearfix">
                                <div class="burger hidden-lg">
                                    <a href="#"><span></span> <span></span> <span></span></a>
                                </div>
                                <ul>
                                    <li> Total Registered Users : <?php //echo $Users; ?> </li>
                                    <li> Total Revenue : Rs <?php //foreach($revenue as $r) { echo number_format($r['amount'],2); } ?>  </li>
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
		-->
        <!-- Header Bottom Start -->
        <div class="h-bottom clearfix">
            <div class="container">
                <div class="navigation-menu">
                    <div class="navbar yamm navbar-default">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="<?php echo base_url(); ?>"><img alt="" class="hidden-xs hidden-sm" src="<?= base_url('assets/');?>images/logo.png"> <img alt="" class="visible-xs visible-sm" src="images/mobile-logo.png"></a>
                        </div>
                        <div class="navbar-collapse collapse hidden-xs" id="navbar-collapse-1">
                            <div class="background"></div>
                            <ul class="nav navbar-nav">
                                <li class="dropdown active">
                                    <a class="dropdown-toggle" href="<?php echo base_url(); ?>">HOME</a>
                                    
                                </li>
								<?php foreach ($footerCategories as $key => $categorie) { ?>
                                <li class="dropdown yamm-fw">
                                    <a class="dropdown-toggle" href="<?php echo base_url('home/category/').$key ; ?>"><?= $categorie ?></a>
                                    
                                </li>
                                <?php } ?>
								<li class="dropdown yamm-fw"><a class="dropdown-toggle" href="<?php echo base_url('');?>">Contact Us</a></li>
				
				<?php				
				if(isset($_SESSION['logged_vendor'])){ ?>
				<li class="dropdown yamm-fw"><a class="dropdown-toggle" href="<?php echo base_url('vendor/login');?>">My Account</a></li>
				<li class="dropdown yamm-fw"><a class="dropdown-toggle" href="<?php echo base_url('vendor/logout');?>">Logout</a></li>
				<?php } else {?>
                <li class="dropdown yamm-fw"><a class="dropdown-toggle" href="<?php echo base_url('vendor/login'); ?>">My Account</a></li>
				<li class="dropdown yamm-fw"><a class="dropdown-toggle" href="<?php echo base_url('vendor/register'); ?>">Register</a></li>
                <?php }?>
                                
                            </ul>
                        </div>
                        <!-- Mobile Navigation List Start -->
                        <div class="dl-menuwrapper visible-xs" id="dl-menu">
                            <button class="dl-trigger">Open Menu</button>
                            <div class="background"></div>
                            <ul class="dl-menu">
                               
                                <li class="active">
                                    <a href="<?php echo base_url(); ?>">Home</a>
                                </li>
                                <?php foreach ($footerCategories as $key => $categorie) { ?>
                                <li class="active">
                                    <a href="<?php echo base_url('home/category/').$key ; ?>"><?= $categorie ?></a>
                                    
                                </li>
                                <?php } ?>
								<li class="active">
                <?php 
				if(isset($_SESSION['logged_vendor'])){ ?>
				<a href="<?php echo base_url('vendor/login');?>">My Account</a>
                <a href="<?php echo base_url('vendor/logout');?>">Logout</a>
				<?php } else {?>
                <a href="<?php echo base_url('vendor/login'); ?>">My Account</a>
                <a href="<?php echo base_url('vendor/register'); ?>">Register</a>
                <?php }?>

								</li>
                            </ul><!--/.dl-menu-->
                        </div><!-- /dl-menuwrapper -->
                        <!-- Mobile Navigation List End -->
                        <!-- Cart Right Start -->
                        <div class="cart-right">
                            
                            <div class="header-cart">
                                <a class="headercartbtn" href="#"><i aria-hidden="true" class="fa fa-shopping-cart"></i> 
								<span id ="cartitemnum">
								<?php
								$er = $_SESSION['shopping_cart'];
								foreach (array_keys($er, 0) as $key) {
								unset($er[$key]);
								}
								if(count(array_count_values($er)) == null || count(array_count_values($er)) == 0)
								echo "Empty";
								else
								echo "Items ".count(array_count_values($er));	
								?></span></a>
                                <div class="cart-down-panel">
                                    <ul class="cart-list">
                                    
                                    <?php
									
									foreach ($cartItems as $cartItem) {
									?>
                                    
                                        <li>
                                          <!--  <button aria-label="Close" class="close" type="button">
                                            <span aria-hidden="true">&times;</span></button>-->
                                            <div class="row">
                                                <div class="col-xs-4 col-sm-4 col-md-4">
                                                    <div class="mini-cart-image"><img alt="" class="img-responsive" src="<?= base_url('/attachments/shop_images/' . $cartItem['image']) ?>"></div>
                                                </div>
                                                <!--<div class="col-xs-8 col-sm-8 col-md-8 pad-left">
                                                    <div class="mini-cart-detail">
                                                        <a href="<?//= LANG_URL . '/' . $cartItem['url'] ?>"><?//= $cartItem['title'] ?></a>
                                                    </div>
                                                </div><!--/.col-xs-8 col-sm-8 col-md-8 pad-left-->
                                            </div><!--/.row-->
                                        </li><!--/.mini-cart-item-->
                                         <?php }?>
                                        
                                    </ul><!--/.cart-list-->
                                    <!--<div class="total">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6">
                                                <div class="total-left">
                                                    <p>subtotal</p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="total-right">
                                                    <p><?//= CURRENCY.' '.$cartItems['finalSum']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>-->
                                    <div class="mini-cart-btn">
                                        <a class="btn btn-default view-cart" href="<?php echo base_url('shopping-cart')?>">View Cart</a> 
									<br><br>
										<a class="btn btn-default view-cart" href="<?php echo base_url('checkout')?>">Checkout</a>
                                    </div><!--/.mini-cart-btn-->
                                </div><!--/.cart-down-panel-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
