<?php
$timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<div class="row">
    <div class="col-md-8 col-md-offset-3">
        <?php
        if ($this->session->flashdata('result_publish')) {
            ?> 
            <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div> 
            <?php
        }
        ?>
			<center><h3> Total Earnings: Rs. <?php echo $data['total_amount'][0]['amount'];
			//var_dump($data);?> </h3></center>
			<br/>
		
        <div class="body">
		<form action ="<?php echo base_url('admin/calc_earning');?>" method="post">
		From Date : <input type ="date" name="from_date" style="width:150px !important;"> 
		To Date : <input type ="date" name="to_date" style="width:150px !important;"> 
		&nbsp;&nbsp;&nbsp;&nbsp;<input type ="submit" name="sub" value="search" style="width:150px !important;">
		</form>
		<br>
		<?php //var_dump($data['date_wise']);
		if(@$data['date_wise'])
		{?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Vendor Id</th>
                                            <th>Vendor Email</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php 
									foreach($data['date_wise'] as $rowdata){?> 
                                        <tr>
											<td><?php echo $rowdata['vendor_id'];?></td>
                                            <td><?php echo $rowdata['vendor_email']; ?></td>
                                            <td><?php echo $rowdata['amount']; ?></td>
                                            <td><?php echo $rowdata['date']; ?></td>
										
										</tr>
									<?php 
									} 
									?>
									<tr><td></td></tr>
                                    </tbody>
                                </table>
		<?php } ?> 
                            </div>
                        </div>
    </div>
</div>
			
<!-- Modal Upload More Images -->

<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>
