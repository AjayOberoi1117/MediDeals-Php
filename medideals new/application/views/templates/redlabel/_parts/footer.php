<!-- Footer Start -->
<footer class="footer clearfix">
    <div class="container">
        <div class="f-top clearfix">
            <div class="f-widget clearfix">
                <div class="row">
                    <div class="col-sm-12 col-md-4 widget-block" style="text-align:center">
                        <h6 >Overview</h6>
                        <div class="pages-block clearfix">
                            <div class="col-xs-12 col-sm-12 col-md-12 padding">
                                <ul>
                                    <li>
                                        <a href="">Home</a>
                                    </li>
                                    <li>
                                        <a href="http://medideals.co.in/home/aboutus">About us</a>
                                    </li>
									<li>
                                        <a href="">Shop</a>
                                    </li>
                                    <li>
                                        <a href="">Contact us</a>
                                    </li>
                                </ul>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 widget-block" style="text-align:center">
                        <h6 >OUR POLICIES</h6>
                        <div class="pages-block clearfix">
                            <div class="col-xs-12 col-sm-12 col-md-12 padding">
                                <ul>
                                    <li>
                                        <a href="http://medideals.co.in/home/termscondition">Terms And Conditions</a>
                                    </li>
                                    <li>
                                        <a href="">FAQs</a>
                                    </li>
                                    <li>
                                        <a href="">Return Policies</a>
                                    </li>
                                    <li>
                                        <a href="">Privacy Policy</a>
                                    </li>
                                </ul>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 widget-block" style="text-align:center">
                        <h6 >Quick Links</h6>
                        <div class="pages-block clearfix">
                            <div class="col-xs-12 col-sm-12 col-md-12 padding">
                                <ul>
                                   <li>
                                        <a href="<?php echo base_url();?>intellectual-property-rights">Intellectual Property Rights</a>
                                    </li>
                                    <li>
                                        <a href="">FAQs</a>
                                    </li>
                                    <li>
                                        <a href="">Return Policies</a>
                                    </li>
                                    <li>
                                        <a href="">Privacy Policy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <!-- Footer Bottom Start -->
        <div class="f-bottom clearfix">
            <p>Medideals © 2018 All rights reserved.</p>
            <div class="f-social-icons clearfix">
                <ul>
                    <li><a href="#"><i aria-hidden="true" class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i aria-hidden="true" class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i aria-hidden="true" class="fa fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Modal Start -->
<!-- Login Modal Start -->
<div aria-hidden="true" class="modal fade login-modal" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Close Start -->
            <button class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> <!-- Close End -->
            <!-- Login Section Start -->
            <div class="login-block clearfix">
                <h6>SIGN IN YOUR ACCOUNT TO HAVE ACCESS TO DIFFERENT FEATURES</h6>
                <form>
                    <div class="form-group">
                        <label for="exampleInputtext1">Username</label> <input class="form-control" id="exampleInputtext1" placeholder="eg: james_smith" type="text">
                    </div><!--/.form-group-->
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label> <input class="form-control" id="exampleInputPassword1" placeholder="type password" type="password">
                    </div><!--/.form-group-->
                    <div class="checkbox">
                        <label><input type="checkbox"> REMEMBER ME</label>
                    </div><!--/.checkbox-->
                    <button class="btn btn-default" type="submit">Log in</button>
                    <div class="forgot-password">
                        <a href="#">FORGOT YOUR PASSWORD?</a>
                    </div><!--/.forgot-password-->
                </form>
            </div><!-- Login Section End -->
            <!-- Forgot Password Section Start -->
            <div class="forgot-password-block clearfix">
                <h6>FORGOT YOUR DETAILS?</h6>
                <form>
                    <div class="form-group">
                        <label for="exampleInputtext2">Username OR Email</label> <input class="form-control" id="exampleInputtext2" placeholder="eg: james_smith" type="text">
                    </div><button class="btn btn-default" type="submit">SEND MY DETAILS!</button>
                    <div class="forgot-password">
                        <a href="#">AAH, WAIT, I REMEMBER NOW!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal End -->
<!-- Back To Top Start -->
<div class="back-to-top clearfix">
    <a href="#"><span><i aria-hidden="true" class="fa fa-chevron-up"></i> Top</span></a>
</div>
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
<script data-cfasync="false" src="/cdn-cgi/scripts/f2bf09f8/cloudflare-static/email-decode.min.js"></script>
<script src="<?= base_url('assets/')?>js/jquery-3.1.1.min.js"></script>
<script src="<?= base_url('assets/')?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets/')?>js/revslider/jquery.themepunch.tools.min.js"></script>
<script src="<?= base_url('assets/')?>js/revslider/jquery.themepunch.revolution.min.js"></script>
<script src="<?= base_url('assets/')?>js/revslider/revolution.extension.actions.min.js"></script>
<script src="<?= base_url('assets/')?>js/revslider/revolution.extension.layeranimation.min.js"></script>
<script src="<?= base_url('assets/')?>js/revslider/revolution.extension.navigation.min.js"></script>
<script src="<?= base_url('assets/')?>js/revslider/revolution.extension.parallax.min.js"></script>
<script src="<?= base_url('assets/')?>js/revslider/revolution.extension.video.min.js"></script>
<script src="<?= base_url('assets/')?>js/revslider/revolution.extension.slideanims.min.js"></script>
<script src="<?= base_url('assets/')?>js/parallax.js"></script>
<script src="<?= base_url('assets/')?>js/ofi.js"></script>
<script src="<?= base_url('assets/')?>js/jquery.dlmenu.js"></script>
<script src="<?= base_url('assets/')?>js/slick.js"></script>
<script src="<?= base_url('assets/')?>js/jquery.selectric.js"></script>
<script src="<?= base_url('assets/')?>js/jquery-ui.js"></script>
<script src="<?= base_url('assets/')?>js/jquery.timepicker.js"></script>
<script src="<?= base_url('assets/')?>js/jquery.ui.touch-punch.min.js"></script>
<script src="<?= base_url('assets/')?>js/slick.js"></script>

<script>
    $(window).scroll(function() {
    if ($(this).scrollTop()>0){
        $('.h-top').fadeOut();
     }
    else{
      $('.h-top').fadeIn();
     }
 });
</script>

<script>
    "use strict";
        //Rev slider
        var setREVStartSize=function(){
             try{var e=new Object,i=jQuery(window).width(),t=9999,r=0,n=0,l=0,f=0,s=0,h=0;
                e.c = jQuery('#rev_slider_1_1');
                e.responsiveLevels = [1240,1024,778,480];
                e.gridwidth = [1240,992,778,480];
                e.gridheight = [868,768,960,720];
                e.sliderLayout = "fullwidth";
                if(e.responsiveLevels&&(jQuery.each(e.responsiveLevels,function(e,f){f>i&&(t=r=f,l=e),i>f&&f>r&&(r=f,n=e)}),t>r&&(l=n)),f=e.gridheight[l]||e.gridheight[0]||e.gridheight,s=e.gridwidth[l]||e.gridwidth[0]||e.gridwidth,h=i/s,h=h>1?1:h,f=Math.round(h*f),"fullscreen"==e.sliderLayout){var u=(e.c.width(),jQuery(window).height());if(void 0!=e.fullScreenOffsetContainer){var c=e.fullScreenOffsetContainer.split(",");if (c) jQuery.each(c,function(e,i){u=jQuery(i).length>0?u-jQuery(i).outerHeight(!0):u}),e.fullScreenOffset.split("%").length>1&&void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0?u-=jQuery(window).height()*parseInt(e.fullScreenOffset,0)/100:void 0!=e.fullScreenOffset&&e.fullScreenOffset.length>0&&(u-=parseInt(e.fullScreenOffset,0))}f=u}else void 0!=e.minHeight&&f<e.minHeight&&(f=e.minHeight);e.c.closest(".rev_slider_wrapper").css({height:f})
            }catch(d){console.log("Failure at Presize of Slider:"+d)}
        };
        setREVStartSize();
        var tpj=jQuery;
        var revapi1;
        tpj(document).ready(function() {
            if(tpj("#rev_slider_1_1").revolution == undefined){
                revslider_showDoubleJqueryError("#rev_slider_1_1");
            }else{
                revapi1 = tpj("#rev_slider_1_1").show().revolution({
                sliderType:"standard",
                jsFileLocation:"js/",
                sliderLayout:"auto",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                     keyboardNavigation:"off",
                     keyboard_direction: "horizontal",
                     mouseScrollNavigation:"off",
                    mouseScrollReverse:"default",
                     onHoverStop:"off",
                     touch:{
                        touchenabled:"on",
                        swipe_threshold: 75,
                        swipe_min_touches: 1,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                     },
                    arrows: {
                        style:"new-bullet-bar",
                        enable:true,
                        hide_onmobile:true,
                        hide_under:778,
                        hide_onleave:false,
                        left: {
                             h_align:"left",
                            v_align:"center",
                             h_offset:30,
                             v_offset:0
                        },
                        right: {
                             h_align:"right",
                             v_align:"center",
                            h_offset:30,
                             v_offset:0
                        }
                    },
                     bullets: {
                        enable:true,
                        hide_onmobile:true,
                        hide_under:992,
                        style:"uranus",
                        hide_onleave:true,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        direction:"horizontal",
                        h_align:"center",
                        v_align:"bottom",
                        h_offset:0,
                        v_offset:220,
                        space:10,
                        tmp:'<span class="tp-bullet-inner"><\/span>'
                    }
                },
                responsiveLevels:[1240,1024,778,480],
                visibilityLevels:[1240,1024,778,480],
                gridwidth:[1240,1024,778,480],
                gridheight:[900,768,960,720],
                lazyType:"none",
                parallax: {
                     type:"scroll",
                     origo:"slidercenter",
                     speed:1000,
                     speedbg:0,
                     speedls:1000,
                     levels:[5,10,15,20,25,30,35,40,45,46,47,48,49,50,51,30]
                },
                shadow:0,
                spinner:"spinner5",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                shuffle:"off",
                autoHeight:"off",
                disableProgressBar:"on",
                fullScreenAutoWidth:"off",
                fullScreenAlignForce:"off",
                fullScreenOffsetContainer: "",
                fullScreenOffset: "",
                hideThumbsOnMobile:"off",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    nextSlideOnWindowFocus:"off",
                    disableFocusListener:false
                }
            });
            jQuery(document).ready(function() {
                jQuery('.hover1').on('hover', function() {
                    jQuery('.arrow1').stop().animate({
                        'margin-left': '10px'
                    }, 200);
                }, function() {
                    jQuery('.arrow1').stop().animate({
                        'margin-left': '0px'
                    }, 200);
                });
                jQuery('.hover2').on('hover', function() {
                    jQuery('.arrow2').stop().animate({
                        'margin-left': '10px'
                    }, 200);
                }, function() {
                    jQuery('.arrow2').stop().animate({
                        'margin-left': '0px'
                    }, 200);
                });
                jQuery('.hover3').on('hover', function() {
                    jQuery('.arrow3').stop().animate({
                        'margin-left': '10px'
                    }, 200);
                }, function() {
                    jQuery('.arrow3').stop().animate({
                        'margin-left': '0px'
                    }, 200);
                });
            });
             }
        }); /*ready*/
</script>
<script src="<?= base_url('assets/')?>js/script.js"></script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5b9d2046c666d426648acaac/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>
