
	<!-- Content Start -->
	<section class="content inner-pg shop-pg shop-product-pg clearfix">
		<!-- Breadcrumb Start -->
		<div class="breadcrumb-title clearfix">
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-6">
						<div class="breadcrumb-left">
							<!--<ol class="breadcrumb">
								<li>
									<a href="index.html">HOME</a>
								</li>
								<li>
									<a href="shop.html">Shop</a>
								</li>
								<li>
									<a href="shop.html">Vitamins & Supplements</a>
								</li>
								<li class="active">DiamondClean Rechargeable Electric Toothbrush</li>
							</ol>--><!--/.breadcrumb-->
						</div><!--/.breadcrumb-left-->
					</div><!--/.col-sm-6 col-md-6-->
					<div class="col-sm-6 col-md-6">
						<div class="breadcrumb-right">
							<h5>Third Party MFG</h5>
						</div>
					</div><!--/.col-sm-6 col-md-6"-->
				</div><!--/.row-->
			</div><!--/.container-->
		</div><!-- Breadcrumb End -->
		<!-- Product Items Detail Start -->
		<div class="product-items-detail clearfix">

			<div class="col-sm-12 col-md-6 col-lg-6 padding">
				<div class="left-side">
					<a class="image fancybox" data-fancybox-group="gallery" href="images/shop-product-img.jpg"><img alt="IMAGE" class="img-responsive" src="<?= base_url('upload_pic/' . $viewthirdparty['Thirdparty_image']) ?>"></a>
				</div>
			</div>
			<div class="col-sm-12 col-md-6 col-lg-6 padding">
				<div class="right-side">
					<h4><?= $viewthirdparty['Thirdparty_name'] ?></h4>
					
					<!--<div class="product-use">
						<p>Pellentesque semper odio erat.</p>
					</div>
-->				


 
					<div class="product-categories">
					<span>Company Name:</span> <?= $viewthirdparty['Thirdparty_name']  ?>
					<br/>
					<br/>
					<span>Company Address: </span> <?= $viewthirdparty['Thirdparty_address']  ?>
						<br/>
						<br/>
						<span>Company Phone: </span>  <?= $viewthirdparty['Thirdparty_phone']  ?>
						<br/>
						<br/>
						<span>State: </span>  <?= $viewthirdparty['state']  ?>
						<br/>
						<br/>
						<span> City: </span>  <?= $viewthirdparty['name']  ?>
						<br/>
						<br/>
					
					
					</div>
				</div><!--/.right-side-->
			</div><!--/.col-sm-12 col-md-6 col-lg-6 padding-->
		</div><!-- Product Items Detail End -->
		<!-- Content Description Start -->
		
		<div class="content-desc clearfix">
			<div class="container">
				<!-- Product Related Description Start -->
				<div class="product-related-desc clearfix">
					<!-- Description Start -->
					<div class="description clearfix">
						<div class="bs-example bs-example-tabs" data-example-id="togglable-tabs" role="tabpanel">
							<ul class="nav nav-tabs nav-tabs-responsive" id="myTab" role="tablist">
								<li class="active" role="presentation">
									<a aria-expanded="true" data-toggle="tab" href="#description" id="home-tab" role="tab"><span class="text"></span></a>
								</li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade in active" id="description" role="tabpanel">
									<h6>Company Description</h6>
									<?= $viewthirdparty['Thirdparty_description'] ?>
								</div><!--/.tab-pane-->
							</div><!--/.tab-content-->
						</div><!--/.bs-example-->
					</div><!-- Description End -->
					<!-- Related Products Start -->
					
				</div><!-- Product Related Description End -->
			</div><!--/.container-->
		</div><!-- Content Description End -->
	</section><!-- Content End -->