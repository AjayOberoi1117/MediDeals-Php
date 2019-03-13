<?php
$timeNow = time();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<style>
.suggest_link {
	background-color: #FFFFFF;
	padding: 2px 6px 2px 6px;
}
.suggest_link_over {
	background-color: #f1f1f1;
	padding: 2px 6px 2px 6px;
}
#ajaxresult {
	position: absolute; 
	background-color: #FFFFFF; 
	text-align: left; 
	border: 1px solid #000000;	
	z-index:9999;
}
</style>
<script type ="text/javascript">
    //Mouse over function
	function suggestover(div_value) {
		div_value.className = 'suggest_link_over';
	}
	//Mouse out function
	function suggestout(div_value) {
		div_value.className = 'suggest_link';
	}
	//Click function
	function setsearch(value1,prdid) {
		document.getElementById('ptitle').value = value1;
		document.getElementById('prid2').value = prdid;
		document.getElementById('ajaxresult').innerHTML = '';
		// new
		$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>vendor/products/fetchproductajaxsuggest",
			data:'productid='+$("#prid2").val(),
				success: function(data){
					alert("Data Populated");
					var myarr = data.split("@#$");
					//$("#document").innerHTML(myarr[0]);
					$("#company").val(myarr[1]);
					$("#oldprice").val(myarr[2]);
					},
				error: function(msg){
					alert("Error in data");
					}	
		  });
		
	}
	// Remove data
	function removesearch(){
		document.getElementById('ptitle').value = '';
		document.getElementById('ajaxresult').innerHTML = '';
		document.getElementById('oldprice').value = '';
		document.getElementById('company').value = '';
	}

</script>
<div class="row">
   <!-- <div class="col-md-6 col-md-offset-3">-->
	<div>
        <?php
        if ($this->session->flashdata('result_publish')) {
            ?> 
            <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div> 
            <?php
        }
        ?>
        <div class="content">
		
            <form class="form-box" id="fr1" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="<?= isset($_POST['folder']) ? $_POST['folder'] : $timeNow ?>" name="folder">
                <?php
                foreach ($languages->result() as $language) {
                    ?>
                    <input type="hidden" name="translations[]" value="<?= $language->abbr ?>">
                    <div class="form-group">
					 
                        <img src="" class="language">
						<div>
						<div id = "prp1" style="width:50% !important;float:right;">
						<span><font color ="#f00">*</font>After selecting Product available data will get populated.</span><u>
						<span id="rev1" style="color:#000 !important;" onclick="removesearch()">Click here to Remove</span></u>
						</div>
						<!-- text box -->
                        <input style="width:50% !important;" type="text" name="title[]" placeholder="Enter Product Name, Please enter min. 3 characters for Suggestive Search" value="<?= $trans_load != null && isset($trans_load[$language->abbr]['title']) ? $trans_load[$language->abbr]['title'] : '' ?>" class="form-control" 
						id ="ptitle">
						</div>
						<input type="hidden" id="prid2"><br>
					  
						<div id ="ajaxresult"></div>
						
                    </div>
					
                    <?php
                }
                $i = 0;
                foreach ($languages->result() as $language) {
                    ?>
                    <label><?= lang('vendor_product_description') ?> <img src=""></label>
                    <div class="form-group">
                        <textarea class="form-control" name="description[]" id="description<?= $i ?>"><?= $trans_load != null && isset($trans_load[$language->abbr]['description']) ? $trans_load[$language->abbr]['description'] : '' ?></textarea>
                    </div>
                    <script>
                        CKEDITOR.replace('description<?= $i ?>');
                        CKEDITOR.config.entities = false;
                    </script>
                    <?php
                    $i++;
                }
                ?>
                
                <div class="form-group">
                    <label><?= lang('vendor_select_category') ?></label>
					
                    <select class="selectpicker form-control show-tick show-menu-arrow" name="shop_categorie">
					<option value="0">Select Product Category:</option>
                        <?php 
						
						foreach ($shop_categories as $key_cat => $shop_categorie) { 
							if($this->vendor_type == "wholeseller" && ($key_cat == 1 || $key_cat == 2 || $key_cat == 3))
							{		
						?>
                            <option <?= isset($_POST['shop_categorie']) && $_POST['shop_categorie'] == $key_cat ? 'selected=""' : '' ?> value="<?= $key_cat ?>">
                                <?php
                                foreach ($shop_categorie['info'] as $nameAbbr) {
                                    if ($nameAbbr['abbr'] == $this->config->item('language_abbr')) {
                                        echo $nameAbbr['name'];
                                    }
                                }
                                ?>
                            </option>
                        <?php 
							}
							else if($this->vendor_type == "3rd Party MFG" &&  $key_cat == 5)
							{		
						?>
                            <option <?= isset($_POST['shop_categorie']) && $_POST['shop_categorie'] == $key_cat ? 'selected=""' : '' ?> value="<?= $key_cat ?>">
                                <?php
                                foreach ($shop_categorie['info'] as $nameAbbr) {
                                    if ($nameAbbr['abbr'] == $this->config->item('language_abbr')) {
                                        echo $nameAbbr['name'];
                                    }
                                }
                                ?>
                            </option>
                        <?php 
							}
							else if($this->vendor_type == "PCD Company" &&  $key_cat == 4)
							{		
						?>
                            <option <?= isset($_POST['shop_categorie']) && $_POST['shop_categorie'] == $key_cat ? 'selected=""' : '' ?> value="<?= $key_cat ?>">
                                <?php
                                foreach ($shop_categorie['info'] as $nameAbbr) {
                                    if ($nameAbbr['abbr'] == $this->config->item('language_abbr')) {
                                        echo $nameAbbr['name'];
                                    }
                                }
                                ?>
                            </option>
                        <?php 
							}
						} ?>
                    </select>
                </div>
				<div class="form-group bordered-group">
                    <?php
                    if (isset($_POST['image']) && $_POST['image'] != null) {
                        $image = 'attachments/shop_images/' . $_POST['image'];
                        if (!file_exists($image)) {
                            $image = 'attachments/logo.png';
                        }
                        ?>
                        <p><?= lang('vendor_current_image') ?></p>
                        <div>
                            <img src="<?= base_url($image) ?>" class="img-responsive img-thumbnail" style="max-width:300px; margin-bottom: 5px;">
                        </div>
                        <input type="hidden" name="old_image" value="<?= $_POST['image'] ?>">
                        <?php if (isset($_GET['to_lang'])) { ?>
                            <input type="hidden" name="image" value="<?= $_POST['image'] ?>">
                            <?php
                        }
                    }
                    ?>
                    <label><?= lang('vendor_cover_image') ?> (Only for FMCG Products)</label>
                    <input type="file" name="userfile">
                </div>
                <!--<div class="form-group bordered-group">
                    <div class="others-images-container">
                        <?//= $otherImgs ?>
                    </div>
                    <a href="javascript:void(0);" data-toggle="modal" data-target="#modalMoreImages" class="btn btn-default"><?//= lang('vendor_up_more_imgs') ?></a>
                </div>-->
                <?php
                foreach ($languages->result() as $language) {
                    ?>
                   <br/>
                    <div class="form-group">
                        <img src="" alt="" class="language">
						
                        <b>Maximum Retail Price : Rs. </b><input style="width:80% !important; float:right"  type="text" name="old_price[]" value="<?= $trans_load != null && isset($trans_load[$language->abbr]['old_price']) ? $trans_load[$language->abbr]['old_price'] : '' ?>" placeholder="Price will be auto populate after selecting the product from the list" class="form-control actual" id="oldprice">
                    </div>
					 <div class="form-group">
                        <img src="" alt="" class="language">
                        <b>Discounted Price : Rs. </b><input style="width:80% !important; float:right"  type="text" name="price[]" value="<?= $trans_load != null && isset($trans_load[$language->abbr]['price']) ? $trans_load[$language->abbr]['price'] : '' ?>" placeholder="Discount Price" class="form-control discount" id="newprice">
                    </div>
                <?php } ?>
                <div class="form-group">
                    <b>Total Discount(%) : </b><input style="width:80% !important; float:right"  type="text" placeholder="Discount Percentage - Enter only Number" name="discount" value="<?= @$_POST['discount'] ?>" class="form-control final" id="discount">
                </div>
                <div class="form-group">
                   <b> Quantity in Inventory : </b><input  style="width:80% !important; float:right"  type="text" placeholder="To hide the product, put zero" name="quantity" value="<?= @$_POST['quantity'] ?>" class="form-control">
                </div>
               
                <div class="form-group">
                    <b>Minimum Order Quantity : </b><input  style="width:80% !important; float:right" type="text" placeholder="Minimum Order Quantity for Shipment" name="minquantity" value="<?= @$_POST['minquantity'] ?>" class="form-control">
                </div> 
				<div class="form-group">
                   <b>Company Name  : </b><input  style="width:80% !important; float:right" type="text" placeholder="Company Name will be auto populate after selecting the product from the list" name="brand" value="<?= @$_POST['brand'] ?>" id="company" class="form-control">
                </div>
                
                <button type="submit" name="setProduct" class="btn btn-green"><?= lang('vendor_submit_product') ?></button>
            </form> 
        </div>
    </div>
</div>
<!-- Modal Upload More Images -->
<div class="modal fade" id="modalMoreImages" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= lang('vendor_up_more_imgs') ?></h4>
            </div>
            <div class="modal-body">
                <form id="uploadImagesForm">
                    <input type="hidden" value="<?= isset($_POST['folder']) ? $_POST['folder'] : $timeNow ?>" name="folder">
                    <label for="others"><?= lang('vendor_select_images') ?></label>
                    <input type="file" name="others[]" id="others" multiple />
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default finish-upload">
                    <span class="finish-text"><?= lang('finish') ?></span>
                    <img src="<?= base_url('assets/imgs/load.gif') ?>" class="loadUploadOthers" alt="">
                </button>
            </div>
        </div>
    </div>
</div>


<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
<script>
$(document).ready(function(){
	
	//Mouse over function
	function suggestover(div_value) {
		div_value.className = 'suggest_link_over';
	}
	//Mouse out function
	function suggestout(div_value) {
		div_value.className = 'suggest_link';
	}
	//Click function
	function setsearch(value1) {
		document.getElementById('ptitle').value = value1;
		document.getElementById('ajaxresult').innerHTML = '';
	}
	// Remove data
	function removesearch(){
		document.getElementById('ptitle').value = '';
		document.getElementById('ajaxresult').innerHTML = '';
		document.getElementById('oldprice').value = '';
		document.getElementById('company').value = '';
	}
	
	// new price
	
	$("#newprice").keyup(function(){	
		var actual_val = $("#oldprice").val();
		var discount_val = $("#newprice").val();
		actual_val = parseFloat(actual_val);
		discount_val = parseFloat(discount_val);
		if(!isNaN(discount_val) && !isNaN(actual_val)){	
			if(discount_val <= actual_val)
			{	
				var price = (actual_val - discount_val)*100;
				price = price/actual_val;
				if(isNaN(discount_val))
					$("#discount").val("0%");	
		    	else
				$("#discount").val(price.toFixed(2)+ "%");	
			}
			else
			{
				alert("Discounted price cannot be greater then MRP");
				$("#newprice").val(actual_val.toFixed(2));
				$("#discount").val("0%");
			}
		}	
		else if(isNaN(discount_val)){
			
			$("#discount").val("%");
		}
	});
	
	// discount %
	/*$("#discount").keyup(function(){	
		var actual_val = $("#oldprice").val();
		var discount_per = $("#discount").val();
		actual_val = parseFloat(actual_val);
		discount_per = parseFloat(discount_per);
		if(actual_val!=null && discount_per!=null){
			if(discount_per <= 99.9)
			{
				var discount_val =  actual_val - (discount_per/100)*actual_val;			 
				if(isNaN(discount_per))
				$("#newprice").val("0");	
				else
				$("#newprice").val(discount_val.toFixed(2));
			}
			else{
				alert("Discount cannot be 100%");
				$("#discount").val("0");
				$("#newprice").val(actual_val.toFixed(2));
			}
		}
		if(actual_val=="" || discount_per==""){
			
			$("#newprice").val("0");
		}
	});*/
	// Ajax Suggest
	$("#ptitle").keyup(function(event){ 
		var keycode = (event.keyCode ? event.keyCode : event.which);
		var value = $("#ptitle").val(); 
		if(value.length >= 3 && keycode != '13')
		{
			//alert(value);
			$.ajax({
			type: "POST",
			url: "<?php echo base_url();?>vendor/products/productajaxsuggest",
			data:'keyword='+$("#ptitle").val(),
			success: function(data){
				$("#ajaxresult").html(data);
				//$("#ptitle").val(data);
			},
			error: function(msg){
				alert("Error in data");
			}
				
		  });
		}
	});
	
	// Filing Details
	/*$('#ptitle').keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			//alert('You pressed a "enter" key in textbox'); 
			//alert(value);
		    $.ajax({
			type: "POST",
			url: "<?php echo base_url();?>vendor/products/fetchproductajaxsuggest",
			data:'productid='+$("#prid2").val(),
				success: function(data){
					//alert(data);
					var myarr = data.split("@#$");
					//$("#document").innerHTML(myarr[0]);
					$("#company").val(myarr[1]);
					$("#oldprice").val(myarr[2]);
					},
				error: function(msg){
					alert("Error in data");
					}	
		  });
		}
	});*/
	// disable enter
	$('#fr1').on('keyup keypress', function(e) {
	  var keyCode = e.keyCode || e.which;
	  if (keyCode === 13) { 
	    //alert("Not allowed outside Product Search box");
		e.preventDefault();
		return false;
	  }
	});
});
</script>

