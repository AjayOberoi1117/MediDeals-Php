<?php 
if(isset($_COOKIE['popup']))
{
	$val = $_COOKIE['popup'] + 1;
	setcookie('popup', $val, time() + 432000);
}
else {
	setcookie('popup', 1, time() + 432000);
}
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>

<style type="text/css">
    #overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        filter:alpha(opacity=70);
        -moz-opacity:0.7;
        -khtml-opacity: 0.7;
        opacity: 0.7;
        z-index: 100;
        display: none;
    }
    .cnt223 a{
        text-decoration: none;
        }
    .popup{
        width: 100%;
        margin: 150px auto;
        display: none;
        position: fixed;
        z-index: 101;
    }
    .cnt223{
    min-width: 250px;
    width: 350px;
    min-height: 100px;
    margin:  auto;
    background: #37a8ec;
    position: relative;
    z-index: 103;
    padding: 5px;
    border-radius: 5px;
    box-shadow: 0 2px 5px #000;
    }
    .cnt223 p{
    clear: both;
    color: #555555;
    text-align: justify;
    }
    .cnt223 p a{
    color: #d91900;
    font-weight: bold;
    }
    .cnt223 .x{
    float: right;
    height: 35px;
    left: 22px;
    position: relative;
    top: -25px;
    width: 34px;
    }
    .cnt223 .x:hover{
    cursor: pointer;
    }   
     
     h1{
        color: #fff;
        padding-left: 30px;
     }
      #popup1{
          color: #ffffff;
      }
      .popup .close {
        position: absolute;
        top: 10px;
        right: 12px;
        transition: all 200ms;
        font-size: 30px;
        font-weight:bolder;
        text-decoration:none;
        color: #ffffff;
        }
        .popup .content {
        max-height: 30%;
        overflow: auto;
        }
        input{
            width:70px;
            height:20px;
            }
</style>

<script>
    $(document).ready(function(){
    $("#form").on("submit",function(e){
    e.preventDefault();
    var name = $("#name").val();
    var email = $("#email").val();
    var contact = $("#contact").val();
    var message = $("#message").val();
    if(name == '')
     {
        $("#error").text("Customer Name field is required.");
        $("#name").focus();
     }
    else if(email == '')
    {
        $("#error").text("Customer Email field is required.");
        $("#email").focus();
    }
    else if(contact == '')
    {
        $("#error").text("Customer Contact field is required.");
        $("#contact").focus();
    }
    else if(message == '')
    {
        $("#error").text("Customer Message field is required.");
        $("#message").focus();
    }
    else
        {
            $.ajax({
                    type:"POST",
                    url:"<?php echo base_url(); ?>Home/Savestate",
                    data: new FormData(this),
                    //data : $form.serialize()
                    contentType:false,
                    cache: false,
                    processData:false,
                    success:function(strMessage){
                        if(strMessage == 1){							 
                            $('#form')[0].reset();
							$('.popup').hide();
                        }
                        else{
                            $('#form')[0].reset();
							$('.popup').hide();
                        }
                    }
            })
    }
        })
    })	
    
</script>

<style>
    #error{
        color:red;
    }
</style>

<script type="text/javascript">
    $(function(){
    var overlay = $('<div id="overlay"></div>');
    overlay.show();
    overlay.appendTo(document.body);
    $('.popup').show();
    $('.close').click(function(){
    $('.popup').hide();
    overlay.appendTo(document.body).remove();
    return false;
    });
    
    $('.x').click(function(){
    $('.popup').hide();
    overlay.appendTo(document.body).remove();
    return false;
    });
    });
</script>
</head>
<body>
 <?php 
	if($_SESSION['logged_vendor'] != null){
	
       }
	   else if($_COOKIE['popup'] % 5 == 0) { ?>
    <div class="popup text-center">
        <div class="cnt223">
            <form id="form" method="POST" >
                <a class="close" href="#popup1"><span style="color:#fff">×</span></a>
                <h1>Let's get started</h1>
                 <div id="error"></div> 	
                <div class="form-group" style="width: 90%;margin:0 auto">
                    <input type="text" class="form-control" id="name" placeholder="Name..." name="name">
					 
                    <input type="text" class="form-control" id="email" placeholder="Email..." name="email">
                    <input type="text" class="form-control" id="contact" placeholder="Contact..." name="contact">
                    <textarea class="form-control" id="message" placeholder="Enquiry Message" name="message"></textarea>

                    <button class="btn btn-default discount" id="mc-embedded-subscribe2" name="SUBMIT" type="submit">SUBMIT</button>
                    <div id="error"></div>

                </div>
            </form>
        </div>
    </div>
	<?php } 
	
	include 'slider.php'; ?>


    <!-- Products Start -->
    <div class="our-work-profile clearfix">
        <div class="container">
            <div class="related-products clearfix">
                <div class="section-title">
                    <h4>HOT DEALS</h4>
                </div>
                <div class="shop-products-list clearfix">
                    <div class="row">
                        <?php
                            foreach($products as $product){                            
                                       //print_r($product);
                        ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <div class="product-block">
                                
                                <a href="<?php echo base_url()?><?php echo $product['url'] ?>">
                                <div class="product-detail">
                                    
                                        <h6><?= substr($product['title'], 0, 18) ?></h6>

                                            <span class="sale-price">
                                                <span class=" pull-right">
                                                <?php echo CURRENCY.' ' ?><?= $product['price'];?>
                                                </span>
                                            <span class="reg-price">
                                               <?php echo CURRENCY.' ' ?><?= $product['old_price'];?>
                                            </span> 
										</span>											
                                    </div>
                                 </a>
                                <div class="clearfix"></div>
                                <div class="add-read-more-icons">
                                    <div class="form-group">
                                        <a href="<?php echo base_url('home/vendor/')?><?php echo str_replace(' ','-',$product['vendor_name']); ?>"><span><?= $product['vendor_name'] ?></span></a>
                                    
                                    <span class="pull-right small">Discount! <?php
                                        if ($product['old_price'] != '' && $product['old_price'] != 0) {
                                            $percent_friendly = number_format((($product['old_price'] - $product['price']) / $product['old_price']) * 100) . '%';
                                        ?>
                                       <span class="blink_me"> <?= $percent_friendly ?> </span>
                                    <?php } ?>                                    
                                    </span>
                                    </div>

                                    <div class="clearfix"></div>
                                   

                                </div>
                                <a href="<?php echo base_url()?><?php echo $product['url'] ?>"><button class="btn btn-default" name="buy-now" type="submit">Buy Now</button></a>
                                
                            </div>
                        </div>

                        <?php }?>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner Start -->
    <div class="col-md-12 text-center">
        <img alt="IMAGE" src="<?= base_url('assets/')?>images/midnight1.jpg">
        <img alt="IMAGE" src="<?= base_url('assets/')?>images/pilestreat1.jpg">
        <img alt="IMAGE" src="<?= base_url('assets/')?>images/skinclear1.jpg">
    </div>
    <div class="emergency-detail clearfix"></div>

    <!-- Banner Start -->
    <div class="our-work-profile clearfix">
        <div class="container">
            <div class="related-products clearfix">
                <div class="section-title">
                    <h4>Most Discounted</h4>
                </div>
                <div class="shop-products-list clearfix">
                    <div class="row">
                        <?php
                            foreach($getMostDiscounted as $product) {                            
                                       //print_r($product);
                        ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <div class="product-block">
                                
                                <a href="<?php echo base_url()?><?php echo $product['url'] ?>">
                                <div class="product-detail">
                                    
                                        <h6><?= substr($product['title'], 0, 18) ?></h6>                                        

                                            <span class="sale-price">
                                                <span class=" pull-right">
                                                   <?php echo CURRENCY.' ' ?><?= $product['price'];?>
                                                </span>
                                             <span class="reg-price">
                                             <?php echo CURRENCY.' ' ?><?= $product['old_price'];?>
                                            </span>                                       
                                            </span>                                       
                                    </div>
                                 </a>
                                <div class="clearfix"></div>
                                <div class="add-read-more-icons">
                                    <div class="form-group">
                                        <a href="<?php echo base_url('home/vendor/')?><?php echo str_replace(' ','-',$product['vendor_name']); ?>"><span><?= $product['vendor_name'] ?></span></a>
                                    
                                    <span class="pull-right small">Discount! <?php
                                        if ($product['old_price'] != '' && $product['old_price'] != 0) {
                                            $percent_friendly = number_format((($product['old_price'] - $product['price']) / $product['old_price']) * 100) . '%';
                                        ?>
                                        <span class="blink_me"> <?= $percent_friendly ?> </span>
                                    <?php } ?>                                    
                                    </span>
                                    </div>

                                    <div class="clearfix"></div>
                                   

                                </div>
                                <a href="<?php echo base_url()?><?php echo $product['url'] ?>"><button class="btn btn-default" name="buy-now" type="submit">Buy Now</button></a>
                                
                            </div>
                        </div>

                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Banner Start -->
    <div class="col-md-12 text-center">
        <img alt="IMAGE" src="<?= base_url('assets/')?>images/midnight1.jpg">
        <img alt="IMAGE" src="<?= base_url('assets/')?>images/pilestreat1.jpg">
        <img alt="IMAGE" src="<?= base_url('assets/')?>images/skinclear1.jpg">
    </div>
    <div class="emergency-detail clearfix"></div>


    <!-- Medical And Health News Start -->
    <div class="our-work-profile clearfix">
        <div class="container">
            <div class="related-products clearfix">
                <div class="section-title">
                    <h4>LATEST PRODUCTS</h4>
                </div>
                <div class="shop-products-list clearfix">
                    <div class="row">


                        <?php
                            foreach($newProducts as $newproduct){
                                                //print_r($newproduct);
                        ?>
                        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3">
                            <div class="product-block">
                                
                                <a href="<?php echo base_url()?><?php echo $newproduct['url'] ?>">
                                <div class="product-detail">
                                    
                                        <h6><?= substr($newproduct['title'], 0, 18) ?></h6>                                        

                                            <span class="sale-price">
                                                <span class=" pull-right">
                                                    <?php echo CURRENCY.' ' ?><?= $newproduct['price'];?>
                                                </span>
                                             <span class="reg-price">
                                                 <?php echo CURRENCY.' ' ?><?= $newproduct['old_price'];?>
                                            </span>                                       
                                            </span>                                       
                                    </div>
                                 </a>
                                <div class="clearfix"></div>
                                <div class="add-read-more-icons">
                                    <div class="form-group">
                                        <a href="<?php echo base_url('home/vendor/')?><?php echo str_replace(' ','-',$newproduct['vendor_name']); ?>"><span><?= $newproduct['vendor_name'] ?></span></a>
                                    
                                    <span class="pull-right small">Discount! <?php
                                        if ($newproduct['old_price'] != '' && $newproduct['old_price'] != 0) {
                                            $percent_friendly = number_format((($newproduct['old_price'] - $newproduct['price']) / $newproduct['old_price']) * 100) . '%';
                                        ?>
                                        <span class="blink_me"> <?= $percent_friendly ?> </span>
                                    <?php } ?>                                    
                                    </span>
                                    </div>

                                    <div class="clearfix"></div>
                                  

                                </div>
                                  <a href="<?php echo base_url()?><?php echo $newproduct['url'] ?>"><button class="btn btn-default" name="buy-now" type="submit">Buy Now</button></a>
                                
                            </div>
                        </div>


                        <?php
						} 
						?>


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Medical And Health News End -->
    <!-- Map Address Location Start -->
    <div class="map-address-location clearfix">
        <div class="col-sm-6 col-md-6 padding">
           
			<iframe allowfullscreen height="700"  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3430.449244614654!2d76.75610731473667!3d30.705768581646566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fec47dc53811b%3A0x1e7fa5815a80e748!2sKesho+Ram+Complex%2C+Burail%2C+Burail+Village%2C+Sector+45%2C+Chandigarh%2C+160047!5e0!3m2!1sen!2sin!4v1537011519007"  style="border:0" ></iframe>
			
        </div>
        <div class="col-sm-6 col-md-6 padding">
            <div class="right-side clearfix">
                <div class="col-sm-6 col-md-6 padding">
                    <a class="address-block" href="#">
                        <div class="block-detail">
                            <h6>LOCATION</h6>
                            <p>SCO No 636</p>
                            <p>Kesho Ram Complex</p>
                            <p>Burail, Sector 45C</p>
                            <p>Chandigarh - 160047</p>
                        </div><!--/.block-detail-->
                    </a><!--/.address-block-->
                </div><!--/.col-sm-6 col-md-6-->
                <div class="col-sm-6 col-md-6 padding">
                    <a class="address-block" href="#">
                        <div class="block-detail">
                            <h6>COMMUNICATION</h6>
                            <p>MONDAY - SATURDAY <br> 09:00 AM - 06:00 PM</p>
                            <p>SUNDAY: OFF</p>
                        </div><!--/.block-detail-->
                    </a><!--/.address-block-->
                </div><!--/.col-sm-6 col-md-6-->
                <div class="col-sm-6 col-md-6 padding">
                    <a class="address-block" href="#">
                        <div class="block-detail">
                            <h6>CONTACT US</h6>
                            <p>+91-9855221117</p>
                            <p><span class="__cf_email__">support@medideals.co.in</span></p>
                        </div><!--/.block-detail-->
                    </a><!--/.address-block-->
                </div><!--/.col-sm-6 col-md-6-->
                <div class="col-sm-6 col-md-6 padding">
                    <a class="address-block" href="#">
                        <div class="block-detail">
                            <h6>FOLLOW US</h6>
                            <p>FACEBOOK</p>
                            <p>INSTAGRAM</p>
                            <p>TWITTER</p>
                        </div><!--/.block-detail-->
                    </a><!--/.address-block-->
                </div><!--/.col-sm-6 col-md-6-->
            </div><!--/.right-side-->
        </div><!--/.col-sm-6 col-md--->
    </div>
    <!-- Map Address Location End -->
