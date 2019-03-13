<?php
if ($this->session->flashdata('result_delete')) {
    ?> 
    <div class="alert alert-success"><?= $this->session->flashdata('result_delete') ?></div> 
    <?php
}
?>

<body>



<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.btn {
    background-color: DodgerBlue;
    border: none;
    color: white;
   
    cursor: pointer;
    font-size: 20px;
}

/* Darker background on mouse-over */
.btn:hover {
    background-color: RoyalBlue;
}
</style>
</head>


<h3>Click Here To Download Excel File Format </h3>


<a href="<?php echo base_url();?>assets/medideals.xlsx"><button class="btn"><i class="fa fa-download"></i> Download</button></a>



<div class="container box">
		<h3 align="center">Select Excel File </h3>
		<br />
<center>
		<form method="post" id="import_csv" enctype="multipart/form-data">
			<div class="form-group">
			
				<input type="file" name="csv_file" id="csv_file" />
			</div>
			<div class="form-group">
			
				<input type="hidden" name="vendor_email" value="<?php echo $_SESSION['vendor_user']?>">
			</div>
			<div class="form-group">
			
				<input type="hidden" name="vendor_id" value="<?php echo $_SESSION['vendor_id']?>">
			</div>
			<br />
			<button type="submit" name="import_csv" class="btn btn-info" id="import_csv_btn">Import Excel File</button>
		</form>
		<br />
		<div id="imported_csv_data"></div>
	</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

	//load_data();

	function load_data()
	{
		$.ajax({
			url:"<?php echo base_url(); ?>vendor/Products/load_data",
			method:"POST",
			success:function(data)
			{
				$('#imported_csv_data').html(data);
			},
            error: function(msg){
				alert("Data format Error");
			}
		})
	}

	$('#import_csv').on('submit', function(event){
		alert("received file");
		event.preventDefault();
		$.ajax({
			//url:"<?php echo base_url(); ?>vendor/Products/import",
			url:"<?php echo base_url(); ?>vendor/Products/excel_import",
			method:"POST",
			data:new FormData(this),
			contentType:false,
			cache:false,
			processData:false,
			beforeSend:function(){
				$('#import_csv_btn').html('Importing...');
			},
			success:function(data)
			{
				$('#import_csv')[0].reset();
				$('#import_csv_btn').attr('disabled', false);
				$('#import_csv_btn').html('Import Done');
				alert(data);
			},
            error: function(msg){
                alert("Your Excel file is not properly formatted, contact Administrator to upload the products.");
            }
		})
	});
	
});
</script>