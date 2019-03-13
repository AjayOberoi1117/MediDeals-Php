
<section class="content inner-pg shop-pg clearfix">
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-title clearfix">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-6">
                    <div class="breadcrumb-left">
                        <ol class="breadcrumb">
                            <li>
                                <a href="<?php echo base_url()?>">HOME</a>
                            </li>
                            <li class="active">Shop</li>
                        </ol><!--/.breadcrumb-->
                    </div><!--/.breadcrumb-left-->
                </div><!--/.col-sm-6 col-md-6-->
                <div class="col-sm-6 col-md-6">
                    <div class="breadcrumb-right">
                        <h5></h5>
                    </div>
                </div><!--/.col-sm-6 col-md-6-->
            </div><!--/.row-->
        </div><!--/.container-->
    </div><!-- Breadcrumb End -->
    <div class="container">
        <!-- Inner Pages Start -->
        <div class="inner-content clearfix">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <!-- Sidebar Widget Start -->
                    <div class="blog-sidebar-widget white-bg clearfix">
                        <!-- Widget Block Start -->
                        <div class="widget-block">
                            <!-- Widget Detail Start -->
                            <div class="widget-detail">
                                <div class="search-box clearfix">
									<form id="searchit" onSubmit="return false">
										<div>
											<span style="float:right;color:red;" onclick='clearsearch()'>  <i class="fa fa-window-close-o" aria-hidden="true" title="Clear Search Filter"></i></span>
											<input class="form-control" placeholder="Search Products…" type="text" id="search" name="search" style="width: 190px;float: left;"> <br>
											
										</div>
										 
									</form>
                                </div>
                            </div><!-- Widget Detail End -->
                        </div><!-- Widget Block End -->
                        <!-- Widget Block Start -->
                        <div class="widget-block">
                            <div class="widget-title">
                                <h6>FILTER BY PRICE <span style="float:right;color:red;" onclick='clearmon()'><i class="fa fa-window-close-o" aria-hidden="true" title="Clear Price Filter"></i></span></h6>
                            </div><!-- Widget Detail Start -->
                            <div class="widget-detail">
							
                                <div class="filter clearfix">
                                    <div class="range-slider" onmouseout="onfilter()" id ="prc"></div>
                                    <div class="filter-price clearfix">
                                   <div class="price-range" style="float:left">
								   Price : <input id="amount" readonly type="text">
                                        </div>
                                    </div><!--/.filter-price clearfix-->
								 </div><!--/.filter clearfix-->
							
                            </div><!-- Widget Detail End -->
                        </div><!-- Widget Block End -->
						
						<div class="widget-block">
                            <div class="widget-title">
                                <h6>FILTER BY DISCOUNT <span style="float:right;color:red;" onclick='cleardiscount()'> <i class="fa fa-window-close-o" aria-hidden="true" title="Clear Price Filter"></i></span></h6>
                            </div><!-- Widget Detail Start -->
                            <form id="idForm">
							<div class="widget-detail">
                                <div class="filter clearfix" >
									<?php 
										for($i = 90; $i >= 10;)
										{	
											echo "<input type ='radio' onclick='onfilter()' name='filter' value ='$i'> ".($i-9) ." to ".$i." % <br>";
											$i = $i - 10;
										}
										?>                     
                                </div>
								
                            </div><!-- Widget Detail End -->
							</form><!--/.filter clearfix-->
                        </div>
						<br><br>
						 
                        <!-- Widget Block Start -->
                        <div class="widget-block">
                            <div class="widget-title">
                                <h6>FILTER BY COMPANY <span style="float:right;color:red;" onclick='clearbrand()'>  <i class="fa fa-window-close-o" aria-hidden="true" title="Clear Price Filter"></i></span></h6>
                            </div><!-- Widget Detail Start -->
                            <div class="widget-detail">
                                <div class="archives clearfix">
								<form id="clbr">
                                   <select class="form-control" onchange='onfilter()' id="brand-name">
								    <option value="">Select Brand</option>
									
								   <?php foreach ($fetchbrand as $brand) {
                            echo "<option value='".$brand['brand']."'>".$brand['brand']."</option>";
                            }
							?>	
								   </select>
								</form>
                                </div>
                            </div>
                        </div>
						
					
					  <form id="clloc">
						<!-- Widget Block Start -->
                       <div class="widget-block">
                            <div class="widget-title">
                                <h6>Shipment State <span style="float:right;color:red;" onclick='clearlocation()'>  <i class="fa fa-window-close-o" aria-hidden="true" title="Clear Price Filter"></i></span></h6>
                            </div><!-- Widget Detail Start -->
                            <div class="widget-detail">
                                <div class="archives clearfix">
                          <select class="form-control" id="state" name="state">
							<option value="0">Select State</option>
                        <?php
                            foreach ($states as $key => $value) {
                            echo "<option value='".$value['id']."'>".$value['state']."</option>";
                            }
                        ?>
								   </select>
                                  </div>
                            </div>
                        </div>
                        
						<div>
						<div class="widget-title">
                                <h6>Shipment City</h6>
                            </div>
                            <div>
                                <div>
                                   <select class="form-control" id="city_new" onchange='onfilter()' name="city">
									<option value="">Select City</option>
								   </select>
                                </div>
                            </div>
                        </div>
					  </form>	
						<br><br>
						
						       
											
                    </div>
                </div>

                <div class="col-sm-12 col-md-8 col-lg-9">
                    <!-- Content Description Start -->
                    <div class="content-desc clearfix">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h1>Hot Deals</h1>
                        </div>
                     
						<input type="hidden" name ="cate" value="<?php echo $category[0] ?>" id ="categ">
                        <!-- Shop Items List Start -->
                        <div class="shop-products-list clearfix">
                            <div class="row" id ="response">
                                                           
							
                                    
                                    
                            </div>
                        </div>

                      

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('change','#state',function()
       {
			var id = $('#state').val();
			
		$.ajax({
                url:'<?php echo base_url();?>Home/load_city',
                method:"POST",
                data:"id="+id,
                success: function(res)
                {
                    $('#city_new').html(res);
                }
            });
        });
		$(document).ready(function(){
			var search_prod = $('#search').val();
			//alert(search_prod);
			var sel_price = $('#amount').val();
			//alert(sel_price);
			var sel_discount = $('input[name=filter]:checked', '#idForm').val();
			//alert(sel_discount);
			var sel_brand = $('#brand-name').val();
			//alert(sel_brand);
			var sel_city = $('#city_new').val();
			//alert(sel_city);
			var sel_cat = $('#categ').val();
			
			if(search_prod == null || search_prod == "")
			{ search_prod = null;}
			if(sel_discount == null || sel_discount == "")
			{ sel_discount = 0;}
			if(sel_brand == null || sel_brand == "")
			{ sel_brand = null;}
			if(sel_city == null || sel_city == "")
			{ sel_city = null;}
			
			$.ajax({
                url:'<?php echo base_url();?>Home/filter',
                method:"POST",
                data:{"search_prod":search_prod,"sel_price":sel_price,"sel_discount":sel_discount,"sel_brand":sel_brand,"sel_city":sel_city,"sel_cat":sel_cat},
                success: function(res)
                {
                    $('#response').html(res);
                }
            });  
		});
		
		// search on enter
		$(document).ready(function(){
			var search = document.getElementById("search");
			search.addEventListener("keydown", function (e) {
				if (e.keyCode === 13) {  //checks whether the pressed key is "Enter"
					onfilter();
				}
				if(search.value == "" || search.value == null){
					onfilter();
				}
			});
		});	
		
		function onfilter()
		{
			var search_prod = $('#search').val();
			//alert(search_prod);
			var sel_price = $('#amount').val();
			//alert(sel_price);
			var sel_discount = $('input[name=filter]:checked', '#idForm').val();
			//alert(sel_discount);
			var sel_brand = $('#brand-name').val();
			//alert(sel_brand);
			var sel_city = $('#city_new').val();
			//alert(sel_city);
			var sel_cat = $('#categ').val();
			
			if(sel_discount == null || sel_discount == "")
			{ sel_discount = 0;}
			if(sel_brand == null || sel_brand == "")
			{ sel_brand = null;}
			if(sel_city == null || sel_city == "")
			{ sel_city = null;}
			if(search_prod == null || search_prod == "")
			{ search_prod = null;}
			
			$.ajax({
                url:'<?php echo base_url();?>Home/filter',
                method:"POST",
                data:{"search_prod":search_prod,"sel_price":sel_price,"sel_discount":sel_discount,"sel_brand":sel_brand,"sel_city":sel_city,"sel_cat":sel_cat},
                success: function(res)
                {
                    $('#response').html(res);
                }
            });
		
		}
		function cleardiscount()
		{
			document.getElementById("idForm").reset();
			document.getElementsByName("filter").value = null;
			//var abc = document.getElementsByName("filter").value;
			//alert(abc);
			onfilter();
		}
		function clearmon()
		{
			$('#amount').val("Rs 10 - Rs 500");
			$('#prc').children().eq(0).css("left","0%");
			$('#prc').children().eq(0).css("width","100%");
			$('#prc').children().eq(1).css("left","0%");
			$('#prc').children().eq(2).css("left","100%");
			//alert($('#amount').val());
			onfilter();
		}
		function clearbrand()
		{
			
			document.getElementById("clbr").reset();
			document.getElementById("brand-name").value = null;
			//var abc = document.getElementsByName("filter").value;
			//alert(abc);
			onfilter();
		}
		function clearlocation()
		{
			document.getElementById("clloc").reset();
			document.getElementById("state").value = null;
			document.getElementById("city_new").value = null;
			//var abc = document.getElementsByName("filter").value;
			//alert(abc);
			onfilter();
		}
		function clearsearch()
		{
			document.getElementById("searchit").reset();
			document.getElementById("search").value = null;
			onfilter();
		}
</script>
<script type="text/javascript">
 function idForm(){
   var selectvalue = $('input[name=filter]:checked', '#idForm').val();
   
window.open('<?= base_url();?>Home/filter');
};


</script>
<script>
/*

$(document).ready(function() {
 
   $("#search").keyup(function() {
	var name = $('#search').val();
		if (name == "") {
			$("#response").html("");
 
       }
		else {
			$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>Home/search",
			data: {
				search: name
 
              },
			success: function(html) {
			$("#response").html(html).show();
 
              }
 
           });
 
       }
 
   });
 
});
*/
</script>

