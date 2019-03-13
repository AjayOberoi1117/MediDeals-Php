<!DOCTYPE html>
<html lang="en">

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

	<title>Medideals</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  <link rel='stylesheet prefetch' href='http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css'>
  


	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="<?= base_url('assets/');?>css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="<?= base_url('assets/');?>css/slick.css" />
	<link type="text/css" rel="stylesheet" href="<?= base_url('assets/');?>css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="<?= base_url('assets/');?>css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="<?= base_url('assets/');?>css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="<?= base_url('assets/');?>css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
<link href="<?= base_url('assets/');?>css/bootstrap.css" rel="stylesheet" />
 
	<link href="<?= base_url('assets/');?>css/login-register.css" rel="stylesheet" />
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
	
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
</head>

<body>
	<!-- HEADER -->
	<header>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<span>Welcome to Medideals!</span>
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
						<li>Total Registered Users : 1200</li>
						<li>Total Revenue : Rs 2,00,000</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="<?php echo base_url();?>">
							<img src="<?php echo base_url() ?>assets/img/mead.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form>
                        
                        <input type="text" value="<?= isset($_GET['search_in_title']) ? $_GET['search_in_title'] : '' ?>" id="search_in_title" class="input search-input" placeholder="<?= lang('search_by_keyword_title') ?>" />
                        
							<select class="input search-categories">
								<option value="0">All Categories</option>
								<option value="1">Category 01</option>
								<option value="1">Category 02</option>
							</select>
							<button class="search-btn"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<li class="header-account dropdown default-dropdown">
							<div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-user-o"></i>
								</div>
								<strong class="text-uppercase">My Account <i class="fa fa-caret-down"></i></strong>
							</div>
						<!--	<a href="#" class="text-uppercase">Login</a> / <a href="#" class="text-uppercase">Join</a>-->
                        <?php 
						
						//echo $_SESSION['vendor_user'];
						if(isset($_SESSION['logged_vendor'])){ ?>
                        
                        <a data-toggle="modal" href="<?php echo base_url('vendor/logout');?>">Logout</a>
						
                 <?php } else {?>
                 	<a data-toggle="modal" href="<?php echo base_url('vendor/login'); ?>" >Login</a> /
                 <a data-toggle="modal" href="<?php echo base_url('vendor/register'); ?>">Register</a>
                 <?php }?>
                 <div class="modal fade login" id="loginModal">
		      <div class="modal-dialog login animated">
    		      <div class="modal-content">
    		         <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Login with</h4>
                    </div>
                    <div class="modal-body">  
                        <div class="box">
                             <div class="content">
                                <div class="social">
                                    <a class="circle github" href="/auth/github">
                                        <i class="fa fa-github fa-fw"></i>
                                    </a>
                                    <a id="google_login" class="circle google" href="/auth/google_oauth2">
                                        <i class="fa fa-google-plus fa-fw"></i>
                                    </a>
                                    <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                                        <i class="fa fa-facebook fa-fw"></i>
                                    </a>
                                </div>
                                <div class="division">
                                    <div class="line l"></div>
                                      <span>or</span>
                                    <div class="line r"></div>
                                </div>
                                <div class="error"></div>
                                <div class="form loginBox">
                                
                                
                                <form method="POST" action="<?php echo base_url('Users/login');?>">
<input type="text" name="email" placeholder="Email" class="form-control">
<input type="password" name="pass" placeholder="Password" class="form-control">
<input type="submit" name="login" class="login loginmodal-submit btn btn-default btn-login" value="<?= lang('login') ?>">
</form> 

                                </div>
                             </div>
                        </div>
                        <div class="box">
                            <div class="content registerBox" style="display:none;">
                             <div class="form">
                             
                             <form method="POST" action="<?php echo base_url('Users/register');?>">
<input type="text" name="name" placeholder="Name" class="form-control">
<input type="text" name="phone" placeholder="Phone" class="form-control">
<input type="text" name="email" placeholder="Email" class="form-control">
<input type="password" name="pass" placeholder="Password" class="form-control">
<input type="password" name="pass_repeat" placeholder="Password repeat" class="form-control">
<input type="submit" name="signup" class="login loginmodal-submit" value="<?= lang('register_me') ?>">
</form>
 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="forgot login-footer">
                            <span>Looking to 
                                 <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                        </div>
                        <div class="forgot register-footer" style="display:none">
                             <span>Already have an account?</span>
                             <a href="javascript: showLoginForm();">Login</a>
                        </div>
                    </div>        
    		      </div>
		      </div>

		
                            
                            
                            <ul class="custom-menu">
								<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
								<li><a href="#"><i class="fa fa-heart-o"></i> My Wishlist</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> Compare</a></li>
								<li><a href="#"><i class="fa fa-check"></i> Checkout</a></li>
								<li><a href="#"><i class="fa fa-unlock-alt"></i> Login</a></li>
								<li><a href="#"><i class="fa fa-user-plus"></i> Create An Account</a></li>
							</ul>
						</li>
						<!-- /Account -->

						<!-- Cart -->
						<li class="header-cart dropdown default-dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
								<div class="header-btns-icon">
									<i class="fa fa-shopping-cart"></i>
									<span class="qty"><?= count($cartItems['array']); ?></span>
								</div>
								<strong class="text-uppercase">My Cart:</strong>
								<br>
								
							</a>
							<div class="custom-menu">
								<div id="shopping-cart">
									<div class="shopping-cart-list">
										  <?php
            foreach ($cartItems['array'] as $cartItem) {
                ?>
										<div class="product product-widget">
											<div class="product-thumb">
												<img src="<?= base_url('/attachments/shop_images/' . $cartItem['image']) ?>" alt="">
											</div>
											<div class="product-body">
                                         
												<h3 class="product-price">   <?=
                                        $cartItem['num_added'] == 1 ? $cartItem['price'] : '<span class="num-added-single">'
                                                . $cartItem['num_added'] . '</span> x <span class="price-single">'
                                                . $cartItem['price'] . '</span> - <span class="sum-price-single">'
                                                . $cartItem['sum_price'] . '</span>'
                                        ?> </h3>
												<h2 class="product-name"><a href="<?= LANG_URL . '/' . $cartItem['url'] ?>"><?= $cartItem['title'] ?></a></h2>
											</div>
											<button class="cancel-btn"><i class="fa fa-trash"></i></button>
										</div>
                                        
                                        <?php }?>
									</div>
									<div class="shopping-cart-btns">
										<a href="<?php echo base_url('shopping-cart')?>"><button class="main-btn">View Cart</button></a>
										<a href="<?php echo base_url('checkout')?>"<button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button></a>
									</div>
								</div>
							</div>
						</li>
						<!-- /Cart -->

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
				<!-- category nav -->
				

				<!-- menu nav -->
				<div class="menu-nav">
					<span class="menu-header">Menu <i class="fa fa-bars"></i></span>
					<ul class="menu-list">
                    <li><a href="<?php echo base_url(); ?>">Home</a></li>
                     <?php foreach ($footerCategories as $key => $categorie) { ?>
                                <li><a href="<?php echo base_url('home/category/').$key ; ?>"  class="go-category"><?= $categorie ?></a></li>
                            <?php } ?>
						
						
						
						<li class="dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">MY Account<i class="fa fa-caret-down"></i></a>
							<ul class="custom-menu">
								<li><a href="<?php echo base_url('myaccount'); ?>">My profile</a></li>
	                           <li><a href="#">Orders</a></li>
                                 <li><a href="#">Notification</a></li>
	                                 <li><a href="<?php echo base_url('checkout'); ?>">Checkout</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- menu nav -->
			</div>
		</div>
		<!-- /container -->
	</div>
             
            
             <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script>
	 function popupEnquiry()
		{
            
			// debugger;
			var uname = $("#uname").val();
			var umail = $("#umail").val();
			var umobile = $("#umobile").val();
			var sub_category = $("#sub_category option:selected").text();
			var comment = $("#comment").val();
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            var nameReg = /^[a-zA-Z\s-, ]+$/;
            var numberReg = /^[0-9]+$/;
            var url1 = window.location.href; 
            var url_home = 'home/SendEnquiry';
            if((url1 == "https://korbose.com/home/") || (url1 == "https://www.korbose.com/home/") ||
               (url1 == "www.korbose.com/home/") || (url1 == "korbose.com/home/"))
                {
                   url_home =  '/SendEnquiry';
                }
               
            var url2 = url1 + url_home ;
            
            if(uname == '')
			{
				$("#error").text("Customer Name field is required.");
				$("#uname").focus();
			}
            else if(!nameReg.test(uname)){
                
                $('#error').text("Please enter a valid Name.");
                $("#uname").focus();
            }
            
			else if(umail == '')
			{
				$("#error").text("Customer Email field is required.");
				$("#uemail").focus();
			}
            else if(!emailReg.test(umail)){
                $('#error').text("Please  enter a valid email address.");
                $("#umail").focus();
            }
			else if(umobile == '')
			{
				$("#error").text("Customer Mobile field is required.");
				$("#umobile").focus();
			}
            else if(umobile.length < 10){
                if(!numberReg.test(umobile)){
               
                $("#error").text("Please enter a valid mobile number.");
				$("#umobile").focus();
                    }
           }
			else if(sub_category == 'Select Service') 
			{
                $("#error").text("Select Services from dropdown.");
				$("#sub_category").focus();
			}
			
			else if(comment == '')
			{
				$("#error").text("Please Enter your requirement.");
				$("#comment").focus();
			}
			else
			{
				$.ajax({
					type: 'POST',
					url: url2 ,
					data: "uname=" + uname + "&umail=" + umail + "&umobile=" + umobile + "&sub_category=" + sub_category+"&comment="+comment,
					success: function(data)
					{
							// alert(data);
							if(parseInt(data) == 1)
							{
								 // window.location = 'https://korbose.com/home';
								 $('#memberModal').hide();
                                 $('.modal-backdrop').hide();
								 
							}
							else {
								$("#registered").text("Error");
							}
					}
				});			
			}
		}
	</script>		
<link rel='stylesheet' href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type='text/css'/>
<div id="memberModal" class="modal fade enquiry_popup" role="dialog">

    <div class="modal-dialog model-bg modal-content">
   
    <div class="m10 pop-up-img">
    <img src="https://korbose.com/assets/images/popup_images.png" alt="Enquiry Form">
</div>
        <!-- Modal content-->
	<div class="pop-up-content">
     <button type="button" class="close close-button" data-dismiss="modal">&times;</button>
  
        
<div id="register" class="tab-pane fade in m6 register-popup">
    <h2>Let's get started</h2>
	<span id="error" class="col-xs-12 text-center"></span>
<input type="text" name="uname" id="uname" placeholder="Name...." class="pop-name" />
<input type="text" name="umail" id="umail" placeholder="Email...."  class="pop-email"/>
<input type="text" name="umobile" id="umobile" placeholder="Phone Number...." class="pop-number"/>
<select id="sub_category" name="services">
               <option value="0">Select Service</option>
                <optgroup label="Database Suppport">
                <option>Remote DBA Services</option>
                <option>Database Upgrades</option>
                <option>Database Monitoring</option>
                <option>Database Consulting</option>
                <option>Database Assessments</option>
                <option>Database Optimization</option>
                <option>Database Optimization</option>
                <option>High Availability Solution</option>
                <option>Database Support Services</option>
                <option>Database Performance Tuning</option>
                <option>Backup Strategies & Implementations</option>
                <option>24x7 Production Support</option>
                </optgroup>
                
                <optgroup label="Server Support & Services">
                <option>Domain controller</option>
                <option>IIS </option>
                <option>Active Directory</option>
                <optin>DNS</optin>
                <option>Application Support</option>
                <option>System Administration</option>
                <option>Server & Client Administration</option>
                </optgroup>
                
                <optgroup label="Moblie Development">
                <option>Android App Development</option>
                <option>IOS App Development</option>
                </optgroup>
                
                <optgroup label="IOT service">
                <option>Consulting service</option>
                <option>IOT & AI Integration</option>
                <option>IOT Support service</option>
                <option>Multiplatform IOT service</option>
                </optgroup>
                
                
                <optgroup label="Digital Marketing">
                <option>Search Engine Optimization</option>
                <option>Social Media Optimization</option>
                <option>Pay Per Click</option>
                <option>Object Relational Mapping</option>
                </optgroup>
                
               
             <optgroup label="Cloud">
                <option>Consulting & Monitoring</option>
                <option>Development & Deployment</option>
                <option>Migration</option>
                <option>Virtualization service</option>
                <option>Cloud administrator service</option>
                </optgroup>
                
                <optgroup label="Web Solutions">
                <option>Web Designing</option>
                <option>Logo Designing</option>
                <option>Web Development</option>
                <option>Website Revamp</option> 
                </optgroup>   
</select>
<textarea placeholder="Enter Your Enquiry Message...." name="comment" id="comment"></textarea>

<input type="submit" name="popup" value="submit" data-target="#otp_pop" onClick="popupEnquiry()" id="PopupEnquiry" data-toggle="modal" class=""/>

</div>
        <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>