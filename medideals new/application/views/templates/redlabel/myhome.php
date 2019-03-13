 <!-- start of banner-->
<div class="container-fluid">
<div class="row">

 <div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  	
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?= base_url('assets/')?>img/banner.png" alt="Bags sale">
      <div class="carousel-caption">
        
        <div class="banner-caption text-center">
							<h1>Bags sale</h1>
							<h3 class="white-color font-weak">Up to 50% Discount</h3>
							<button class="primary-btn">Shop Now</button>
						</div>
      </div>
    </div>
    

    <div class="item">
    <img src="<?= base_url('assets/')?>img/banner.png" alt="Bags sale">
      <div class="carousel-caption">
         <div class="banner-caption text-center">
							<h1>Bags sale</h1>
							<h3 class="white-color font-weak">Up to 50% Discount</h3>
							<button class="primary-btn">Shop Now</button>
						</div>
      </div>
    </div>

    <div class="item">
      <img src="<?= base_url('assets/')?>img/banner.png" alt="Bags sale">
      <div class="carousel-caption">
         <div class="banner-caption text-center">
							<h1>Bags sale</h1>
							<h3 class="white-color font-weak">Up to 50% Discount</h3>
							<button class="primary-btn">Shop Now</button>
						</div>
      </div>
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

</div>

</div>

 <!-- end of slider -->
 
 <center><h1 style="color:#00B894;">Hot Deals</h1></center>
 <div id="myCarousel" class="row carousel slide" data-ride="carousel">

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        
        <ul class="thumbnails">
         <?php foreach($products as $product) 
			{
			
			//print_r($product);
			?>
          <li class="col-sm-3">      
            <div class="thumbnail">
           

              <a href="<?php echo base_url()?><?php echo $product['url'] ?>"><img src="<?= base_url('attachments/shop_images/' . $product['image']) ?>" alt=""></a>
            </div>
            <div class="caption-box">
           
            </div>
          </li>
          <?php }?>


        </ul>
      </div><!-- /Slide1 --> 


<!-- /Slide2 --> 
      
      
        <!-- /Slide3 --> 
</div><!-- /Wrapper for slides .carousel-inner -->



    <!-- Control box -->
    <div class="control-box">                            
      <a data-slide="prev" href="#myCarousel" class="carousel-control left"><</a>
      <a data-slide="next" href="#myCarousel" class="carousel-control right">></a>
    </div><!-- /.control-box -->   



  </div><!-- /#myCarousel -->
  </div><!-- /.col-sm-12 -->          
</div><!-- /.row --> 
</div><!-- /.container -->

<!-- Delete This -->                        
<!--<footer class="info">
<a href="http://simonalex.com/">&hearts; Redfrost</a> | <a href="https://twitter.github.com/bootstrap/">Get Bootstrap</a> | <a href="http://placehold.it/">Get Placeholder</a>   
    <p class="right">&lsaquo; Resize Window &rsaquo;</p>
    <p>&nbsp;</p>
</footer>-->

<script type="text/javascript">
// Carousel Auto-Cycle
  $(document).ready(function() {
    $('.carousel').carousel({
      interval: 6000
    })
  });

</script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!--<script src='http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js'></script>-->






	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			
			<!-- /row -->

			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Deals Of The Day</h2>
                        
                        <?php //print_r($bestSellers); ?>
						<div class="pull-right">
							<div class="product-slick-dots-2 custom-dots">
							</div>
						</div>
					</div>
				</div>
				<!-- section title -->

				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single product-hot">
						<div class="product-thumb">
							<div class="product-label">
								<span class="sale">-20%</span>
							</div>
							<ul class="product-countdown">
								<li><span>00 H</span></li>
								<li><span>00 M</span></li>
								<li><span>00 S</span></li>
							</ul>
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
							<img src="<?= base_url('assets/')?>img/syrip.png" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">32.50 <del class="product-old-price">45.00</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a style=" color:#00b894;" href="#">Crocin</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				<!-- /Product Single -->

				<!-- Product Slick -->
				<div class="col-md-9 col-sm-6 col-xs-6">
					<div class="row">
						<div id="product-slick-2" class="product-slick">
							<!-- Product Single -->
							
					<?php foreach($bestSellers as $bestsell){ ?>
							<div class="product product-single">
								<div class="product-thumb">
									<div class="product-label">
										<span>New</span>
										<span class="sale">
                                         <?php
                                if ($bestsell['old_price'] != '' && $bestsell['old_price'] != 0) {
                                    $percent_friendly = number_format((($bestsell['old_price'] - $bestsell['price']) / $bestsell['old_price']) * 100) . '%';
                                    ?>
                                   <?= $percent_friendly ?>
                                <?php } ?>
                                        </span>
									</div>
									<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
									<img src="<?= base_url('/attachments/shop_images/' . $bestsell['image']) ?>" alt="">
								</div>
								<div class="product-body">
									<h3 class="product-price"><?= $bestsell['price'] . CURRENCY ?> <del class="product-old-price"><?= $bestsell['old_price'] . CURRENCY ?></del></h3>
									<div class="product-rating">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o empty"></i>
									</div>
									<h2 class="product-name"><a style="color:#00b894;" href="<?php echo base_url()?><?php echo $bestsell['url'] ?>"><?= $bestsell['title'] ?></a></h2>
									<div class="product-btns">
										<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
										<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
                                        <?php if ($bestsell['quantity'] > 0) { ?>
                                        
                                        <a href="<?= LANG_URL . '/shopping-cart' ?>" data-id="<?= $bestsell['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" class="primary-btn add-to-cart">
                            <span class="text-to-bg"><i class="fa fa-shopping-cart"></i><?= lang('add_to_cart') ?></span>
                        </a>
                                        
										
                                        <?php }  ?>
									</div>
								</div>
							</div>
                            <?php }?>
							<!-- /Product Single -->

						</div>
					</div>
				</div>
				<!-- /Product Slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section section-greywhite">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- banner -->
				<div class="col-md-8">
					<div class="banner banner-1">
						<img src="<?= base_url('assets/')?>img/banner0001.png" alt="">
						<div class="banner-caption text-center">
							<h1 class="primary-color">Medicine<br><span class="white-color font-weak">Up to 20% OFF</span></h1>
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="<?= base_url('assets/')?>img/banner0001.png"alt="">
						<div class="banner-caption text-center">
							<!--<h2 class="white-color">Crocin</h2>-->
                            <h2 style="color:#00b894;">Crocin</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->

				<!-- banner -->
				<div class="col-md-4 col-sm-6">
					<a class="banner banner-1" href="#">
						<img src="<?= base_url('assets/')?>img/banner0001.png" alt="">
						<div class="banner-caption text-center">
							<!--<h2 class="white-color">Crocin</h2>-->
                                   <h2 style="color:#00b894;">Crocin</h2>
						</div>
					</a>
				</div>
				<!-- /banner -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Latest Products</h2>
					</div>
				</div>
				<!-- section title -->
<?php foreach($newProducts as $newproduct) {?>
				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
						<img src="<?= base_url('/attachments/shop_images/' . $newproduct['image']) ?>" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price"><h3 class="product-price"><?= $newproduct['price'] . CURRENCY ?> <del class="product-old-price"><?= $newproduct['old_price'] . CURRENCY ?></del></h3></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a  href="<?php echo base_url()?><?php echo $newproduct['url'] ?>" style="color:00b894;"><?= $newproduct['title'] ?></a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<?php if ($bestsell['quantity'] > 0) { ?>
                                        
                                        <a href="<?= LANG_URL . '/shopping-cart' ?>" data-id="<?= $newproduct['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" class="primary-btn add-to-cart">
                            <span class="text-to-bg"><i class="fa fa-shopping-cart"></i><?= lang('add_to_cart') ?></span>
                        </a>
                                        
										
                                        <?php }  ?>
							</div>
						</div>
					</div>
				</div>
                <?php }?>
				<!-- /Product Single -->

		
			</div>
			<!-- /row -->

		
			<div class="row">
		
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="banner banner-2">
						<img src="<?= base_url('assets/')?>img/syrip.png" alt="">
						<div class="banner-caption">
							<h2 class="white-color">NEW<br>	Crocin</h2>
                            
							<button class="primary-btn">Shop Now</button>
						</div>
					</div>
				</div>
				

			
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-20%</span>
							</div>
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
							<img src="<?= base_url('assets/')?>img/pilsss.png" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">32.50 <del class="product-old-price">45.00</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a  href="#">Crocin</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
			
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-20%</span>
							</div>
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
						<img src="<?= base_url('assets/')?>img/pilsss.png" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">32.50 <del class="product-old-price">45.00</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a   href="#">Crocin</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale">-20%</span>
							</div>
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
							<img src="<?= base_url('assets/')?>img/pilsss.png" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price">32.50 <del class="product-old-price">45.00</del></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a  href="#">Crocin</a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<!-- /row -->

			<!-- row -->
			<div class="row">
				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h2 class="title">Picked For You</h2>
					</div>
				</div>
		
<?php foreach($randomProducts as $random){ ?>
				<!-- Product Single -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="product product-single">
						<div class="product-thumb">
							<div class="product-label">
								<span>New</span>
								<span class="sale"> <?php
                                if ($random['old_price'] != '' && $random['old_price'] != 0) {
                                    $percent_friendly = number_format((($random['old_price'] - $random['price']) / $random['old_price']) * 100) . '%';
                                    ?>
                                   <?= $percent_friendly ?>
                                <?php } ?></span>
							</div>
							<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
							<img src="<?= base_url('attachments/shop_images/' . $random['image']) ?>" alt="">
						</div>
						<div class="product-body">
							<h3 class="product-price"><h3 class="product-price"><?= $random['price'] . CURRENCY ?> <del class="product-old-price"><?= $random['old_price'] . CURRENCY ?></del></h3></h3>
							<div class="product-rating">
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star-o empty"></i>
							</div>
							<h2 class="product-name"><a href="<?php echo base_url()?><?php echo $random['url'] ?>"><?= $random['title'] ?></a></h2>
							<div class="product-btns">
								<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
								<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
								
                                <?php if ($random['quantity'] > 0) { ?>
                                        
                                        <a href="<?= LANG_URL . '/shopping-cart' ?>" data-id="<?= $random['id'] ?>" data-goto="<?= LANG_URL . '/shopping-cart' ?>" class="primary-btn add-to-cart">
                            <span class="text-to-bg"><i class="fa fa-shopping-cart"></i><?= lang('add_to_cart') ?></span>
                        </a>
                                        
										
                                        <?php }  ?>
							</div>
						</div>
					</div>
				</div>
                
                <?php }?>
				<!-- /Product Single -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->