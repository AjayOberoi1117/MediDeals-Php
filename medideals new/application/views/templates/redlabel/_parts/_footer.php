	<!-- FOOTER -->
	<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
		            <img src="<?= base_url('assets/')?>img/mead.png" alt="">
		          </a>
						</div>
						<!-- /footer logo -->

						<p style="color:#FFF;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook" style="color:#fff;"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter" style="color:#fff;"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" style="color:#fff;"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus" style="color:#fff;"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest" style="color:#fff;"></i></a></li>
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">My Account</h3>
						<ul class="list-links">
							<li><a href="#">My Account</a></li>
							<li><a href="#">My Wishlist</a></li>
							<li><a href="#">Compare</a></li>
							<li><a href="<?= base_url('checkout');?>">Checkout</a></li>
							<li><a href="#">Login</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Customer Service</h3>
						<ul class="list-links">
							<li><a href="<?= base_url('about');?>">About Us</a></li>
							<li><a href="#">Shipping & Return</a></li>
							<li><a href="#">Shipping Guide</a></li>
							<li><a href="<?= base_url('faq');?>">FAQ</a></li>
						</ul>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Stay Connected</h3>
						<p style="color:#fff;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</p>
						<form>
                        <style>
							::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
							color: #fff;
							opacity: 1; /* Firefox */
							}
							:-ms-input-placeholder { /* Internet Explorer 10-11 */
							color: #fff;
							}
							::-ms-input-placeholder { /* Microsoft Edge */
							color: #fff;
							}	
                        </style>
							<div class="form-group">
								<input class="input"  placeholder="Enter Email Address" style="color:#fff; text-color:#fff;" >
							</div>
							<button class="primary-btn">Join Newsletter</button>
						</form>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This Medideals is made with <i class="fa fa-heart-o" aria-hidden="true"></i>  <a href="#" target="_blank"></a>
						
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="<?= base_url('assets/')?>js/jquery.min.js"></script>
	<script src="<?= base_url('assets/')?>js/bootstrap.min.js"></script>
	<script src="<?= base_url('assets/')?>js/slick.min.js"></script>
	<script src="<?= base_url('assets/')?>js/nouislider.min.js"></script>
	<script src="<?= base_url('assets/')?>js/jquery.zoom.min.js"></script>

	<script src="<?= base_url('assets/')?>js/main.js"></script>

<script src="<?= base_url('assets/js/bootstrap-confirmation.min.js') ?>"></script>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
<script src="<?= base_url('assets/js/placeholders.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap-datepicker.min.js') ?>"></script>
<script>
var variable = {
    clearShoppingCartUrl: "<?= base_url('clearShoppingCart') ?>",
    manageShoppingCartUrl: "<?= base_url('manageShoppingCart') ?>",
    discountCodeChecker: "<?= base_url('discountCodeChecker') ?>"
};
</script>
<script src="<?= base_url('assets/js/system.js') ?>"></script>
<script src="<?= base_url('templatejs/mine.js') ?>"></script>
</body>

</html>
