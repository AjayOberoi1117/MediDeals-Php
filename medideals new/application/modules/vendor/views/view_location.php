<?php
$timeNow = time();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type ="text/javascript">
function del(state_id, city_id)
{
	var obj = new XMLHttpRequest();
	//var db = document.getElementById("n1").value;
	obj.onreadystatechange = function(){
	// for checking readystate
	//alert(obj.readyState);
	// for checking file status
	//alert(obj.status);
		if(obj.readyState == 4 && obj.status== 200 )
		{
			document.getElementById("sd").innerHTML = obj.responseText;
		}
	
	};
	obj.open("GET", "<?php echo base_url()?>vendorlocation.php?state_id="+state_id+"&city_id="+city_id+"&vendor_id="+<?php echo $_SESSION['vendor_id'];?>+"&product_id="+<?php echo $id;?>, true);

	obj.send();
}
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<style>
.btn {
    background-color: DodgerBlue; /* Blue background */
    border: none; /* Remove borders */
    color: white; /* White text */
    padding: 12px 16px; /* Some padding */
    font-size: 16px; /* Set a font size */
    cursor: pointer; /* Mouse pointer on hover */
}

Darker background on mouse-over 
.btn:hover {
    background-color: RoyalBlue;
}
</style>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php
        if ($this->session->flashdata('result_publish')) {
            ?> 
            <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div> 
            <?php
        }
        ?>
		
           <div class="content">
		   <a style="color:#fff;" class="btn btn-green" href="<?php echo base_url() .'vendor/Addproduct/location/'.$id;?>" >Add More Location</a>
           &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		   <a style="color:#fff;" class="btn btn-green" href="<?php echo base_url();?>vendor/products" >Skip</a>
           <br><br><br>
           <?php //echo $_SESSION['vendorid'];
		   //echo $id;
		    ?>
            <div id = "sd">

			</div> 
        </div>
               
    </div>
</div>
<!-- Modal Upload More Images -->
<script type="text/javascript">
$(document).ready(function(){
  
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'<?php echo site_url('vendor/addproduct/find_city');?>',
                data:'state_id='+stateID,
                success:function(data){
				console.log(data);
                    $('#city').html(data);
                }
            }); 
        }else{
            $('#city').html('<option value="">Select City first</option>'); 
        }
    });
});
</script>

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
