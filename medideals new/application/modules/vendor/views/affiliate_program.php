
<script src="<?= base_url('assets/ckeditor/ckeditor.js') ?>"></script>
<link rel="stylesheet" href="<?= base_url('assets/bootstrap-select-1.12.1/bootstrap-select.min.css') ?>">
<script type ="text/javascript">
function validated()
{
	message = document.getElementById("message-text").value;
	name = document.getElementById("recipient-name").value;
	if(message == null || message == "")
	{
		alert('Message section cannot be empty');
		return false;
	}
	if(name == null || name == "")
	{
		alert('Recipient section cannot be empty');
		return false;
	}
	return true;
}
function validated1()
{
	message1 = document.getElementById("affiliator-name").value;
	if(message1 == null || message1 == "")
	{
		alert('Affiliator code cannot be empty');
		return false;
	}
	return true;
}
</script>
<div class="row">
    <div class="col-md-12">
	
        <div class="content">
        <?php 
		if($affiliate_code == NULL)
		{
			echo "<a href = '".base_url("vendor/gen-affiliate-code")."'  style='color:#000 !important;'>CLICK HERE</a> to generate your Affiliate code";
		}
		else
		{
			echo "<h4> Your Affiliate Code : ".$affiliate_code['aff_code'] .'</h4>';
		}
		?>
		<div style ="float:right">
		<?php 
		if($affiliated_entry == NULL)
		{ ?>
		<span><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1" data-whatever="@mdo" style="background-color:#37A8EC !important">Add your Affiliator</button></span>
		<?php } ?>
		<span ><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" style="background-color:#37A8EC !important">Invite People</button></span>
		</div>
		<table class="table">
		<tr>
		<th>S No.</th>
		<th>Affiliate Firm Name</th>
		<th>Affiliate Email</th>
		<th>Affiliation Date</th>
		</tr>
		<?php
		$i = 1;
		foreach($affiliate_information as $affinfo)
		{
			echo "<tr><td>".$i."</td>";
			echo "<td>".$affinfo['firm_name']."</td>";
			echo "<td>".$affinfo['email']."</td>";
			echo "<td>".$affinfo['date']."</td></tr>";
			$i++;
		}
		?>
		
        </table> 
   <?= $links_pagination?>		
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">Invite People</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body">
        <form action ="<?php echo base_url("vendor/send-affiliate-email/".$affiliate_code['aff_code']);?>" method="post" onsubmit="return validated()">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name" placeholder="Email addresses use comma(,) for multiple" name="recipient">
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="message">Use my Affiliate code <?php echo $affiliate_code['aff_code'];?> & get yourself registered for exciting offers at Medideals.</textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:#37A8EC !important; color:#fff !important;">Close</button>
        <input type="submit" class="btn btn-primary" style="background-color:#37A8EC !important" value="Send Message">
      </div>
	  </form>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel1">Add Your Affiliator</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	  
      <div class="modal-body">
        <form action ="<?php echo base_url("vendor/add-affiliate-code/");?>" method="post" onsubmit="return validated1()">
          <div class="form-group">
            <label for="affiliator-name" class="col-form-label" style="text-align:justify;font-weight:10 !important;">Add the code of the person who affiliated you to Medideals, This addition is for one time only so we request you to check the code thoroughly before submit. You can ask the code for the person who referred you or you can get it from the email he sent. The code is present after equal to(=) sign in the email copy it and paste it here.</label><br><br>
            <input type="text" class="form-control" id="affiliator-name" placeholder="Put the affiliator code here" name="aff_code">
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color:#37A8EC !important; color:#fff !important;">Close</button>
        <input type="submit" class="btn btn-primary" style="background-color:#37A8EC !important" value="Add">
      </div>
	  </form>
    </div>
  </div>
</div>
<script src="<?= base_url('assets/bootstrap-select-1.12.1/js/bootstrap-select.min.js') ?>"></script>