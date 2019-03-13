
<?php
    $timeNow = time();
?>
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
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
    margin-left: 25%;
    background: #fff;
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
<script type="text/javascript">
   function openpopup(pid){
    $('#popup'+pid).show();
   }
   
	function closepopup(pid){
    $('#popup'+pid).hide();
    return false;
    }
    
</script>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php
            if ($this->session->flashdata('result_publish')) {
        ?>
        <div class="alert alert-success"><?= $this->session->flashdata('result_publish') ?></div>
        <?php
            }
        ?>

    </div>
</div>
<h1 class="text-center"> Show All Vendors List </h1>
<div class="row">
<div class="col-xs-12">
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Id</th>
			<th>User Type</th>
            <th>Alias Name</th>
            <th>Email</th>
            <th>Business Name</th>
            <th>Firm Address</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
            <?php
			 if ($actions->result()) {
                foreach ($actions->result() as $rowdata) {
					
                    ?>
        <tr>
            <td><?php echo $rowdata->id;?></td>
			<td><?php echo $rowdata->user_type; ?></td>
            <td><?php echo $rowdata->name; ?></td>
            <td><?php echo $rowdata->email; ?></td>
            <td><?php echo $rowdata->firm_name; ?></td>
            <td><?php echo str_replace("#@%"," ",$rowdata->firm_address); ?></td>
            <td class="text-center">
                <a  onclick ="openpopup(<?php echo $rowdata->id;?>)" class="btn btn-primary" style="margin-bottom: 5px; float:right; font-size:14px !important">More Info.</a>
				<a href="<?php echo base_url().'admin/vendors/showvendors/'.$rowdata->id?>" class="btn btn-primary" style="margin-bottom: 5px; font-size:14px !important">Edit</a> 
				<br/>
                <?php if($rowdata->status==0){?>
                <a href="<?=base_url('admin/vendors/updatevendorsststus/1/'.$rowdata->id)?>" class="btn btn-danger" style="font-size:14px !important">Click to Activate</a>
                <?php }else{?>
                <a href="<?=base_url('admin/vendors/updatevendorsststus/0/'.$rowdata->id)?>" class="btn btn-danger" style="font-size:14px !important">Click to Deactivate</a>
                <?php }?>
            </td>
	<div class="popup text-center" id="popup<?php echo $rowdata->id;?>">
        <div class="cnt223">
		
            <a class="close" onclick ="closepopup(<?php echo $rowdata->id;?>)"><span style="color:#000">×</span></a>
            <h4>Other Details</h4> <hr>   	
                <div class="form-group" style="width: 90%;margin:0 auto; font-size:16px;">
				Contact Number :<?php echo $rowdata->contact_no; ?> <br>
				Drug Licence Number :<?php echo $rowdata->drug_licence; ?> <br>
				GST Number : <?php echo $rowdata->gst_number; ?> <br>
				FSSAI Number : <?php echo $rowdata->fssai_no; ?> <br>
				Website : <?php echo $rowdata->website_url; ?> <br>
				
                </div>
            </form>
        </div>
    </div>
        </tr>
				
          <?php
                }
            } else {
                ?>
                <tr><td colspan="3">No history found!</td></tr>
            <?php } ?>
        </tbody>
    </table>
	<?= $links_pagination ?>
</div>
</div>
</div>
<!-- Modal Upload More Images -->
