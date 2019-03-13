<style type ="text/css">
.mystyle {
 border-color: #f00 !important;
}
.sizer{
	color:#f00;
	
}
.sizer1{ color:#000;
}
.disp
{
	display:none !important;
}

</style>

<script type="text/javascript">
function validstar()
{
	var user_type = document.getElementById("user_type").value;
	//alert(user_type);
	if(user_type == "Wholeseller" || user_type == "PCD Company" || user_type == "Third Party" || user_type == "FMCG" || user_type == "-1"){
		
		document.getElementById("d_number").placeholder = "Drug Licence Number";
		document.getElementById("f_number").placeholder = "FSSAI Number";
		document.getElementById("f_number").classList.remove("disp");
		document.getElementById("gst_number").classList.remove("disp");
		
		document.getElementById("drg").classList.remove("disp");
		document.getElementById("drg").classList.remove("sizer1");
		document.getElementById("drg").classList.add("sizer");
		
		document.getElementById("fsc").classList.remove("sizer1");
		document.getElementById("fsc").classList.remove("disp");
		document.getElementById("fsc").classList.add("sizer");
		
		document.getElementById("gst").classList.remove("sizer1");
		document.getElementById("gst").classList.remove("disp");
		document.getElementById("gst").classList.add("sizer");
	}
	else if(user_type == "Retailer"){
		
		document.getElementById("d_number").placeholder = "Drug Licence Number";
		document.getElementById("f_number").placeholder = "FSSAI Number - Not Mendetory";
		document.getElementById("f_number").classList.remove("disp");
		document.getElementById("gst_number").classList.remove("disp");
		
		document.getElementById("drg").classList.remove("sizer1");
		document.getElementById("drg").classList.remove("disp");
		document.getElementById("drg").classList.add("sizer");
		
		document.getElementById("fsc").classList.remove("sizer");
		document.getElementById("fsc").classList.remove("disp");
		document.getElementById("fsc").classList.add("sizer1");
		
		document.getElementById("gst").classList.remove("sizer1");
		document.getElementById("gst").classList.remove("disp");
		document.getElementById("gst").classList.add("sizer");
	}
	else if(user_type == "Doctor"){
		document.getElementById("d_number").placeholder = "Doctor Registration Number";
		document.getElementById("f_number").classList.remove("mystyle");
		document.getElementById("f_number").classList.add("disp");
		document.getElementById("gst_number").classList.remove("mystyle");
		document.getElementById("gst_number").classList.add("disp");
		document.getElementById("fsc").classList.remove("sizer");
		document.getElementById("fsc").classList.add("disp");
		document.getElementById("gst").classList.remove("sizer");
		document.getElementById("gst").classList.add("disp");
	}
	
}
function valid()
{
	var firm_name = document.getElementById("firm_name").value;
	var user_type = document.getElementById("user_type").value;
	var firm_address1 = document.getElementById("firm_address1").value;
	var firm_address2 = document.getElementById("firm_address2").value;
	var firm_address3 = document.getElementById("firm_address3").value;
	var d_number = document.getElementById("d_number").value;
	var f_number = document.getElementById("f_number").value;
	var gst_number = document.getElementById("gst_number").value;
	var con_number = document.getElementById("con_number").value;
	var u_email = document.getElementById("u_email").value;
	var u_password = document.getElementById("u_password").value;
	var u_password_repeat = document.getElementById("u_password_repeat").value;
	var phvalid = /^\d{10}$/;
	var emvalid = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
	// removing CSS
	document.getElementById("firm_name").classList.remove("mystyle");
	document.getElementById("user_type").classList.remove("mystyle");
	document.getElementById("firm_address1").classList.remove("mystyle");
	document.getElementById("firm_address2").classList.remove("mystyle");
	document.getElementById("firm_address3").classList.remove("mystyle");
	document.getElementById("d_number").classList.remove("mystyle");
	document.getElementById("f_number").classList.remove("mystyle");
	document.getElementById("gst_number").classList.remove("mystyle");
	document.getElementById("con_number").classList.remove("mystyle");
	document.getElementById("u_email").classList.remove("mystyle");
	document.getElementById("u_password").classList.remove("mystyle");
	document.getElementById("u_password_repeat").classList.remove("mystyle");
	
	// validation
	
	if(firm_name == null || firm_name == "")
	{
		document.getElementById("firm_name").classList.add("mystyle");
		alert("Please enter Firm name");
		return false;
	}	
	else if(user_type == -1)
	{
		document.getElementById("user_type").classList.add("mystyle");
		alert("Please select a User Type");
		return false;
	}
	else if(user_type == "Wholeseller" || user_type == "PCD Company" || user_type == "Third Party" || user_type == "FMCG")
	{
		
		if(firm_address1 == null || firm_address1 == "")
		{
			document.getElementById("firm_address1").classList.add("mystyle");
			alert("Please enter Shop No./Plot No.");
			return false;
		}
		else if(firm_address2 == null || firm_address2 == "")
		{
			document.getElementById("firm_address2").classList.add("mystyle");
			alert("Please enter Street Name");
			return false;
		}
		else if(firm_address3 == null || firm_address3 == "")
		{
			document.getElementById("firm_address3").classList.add("mystyle");
			alert("Please enter City");
			return false;
		}
		else if(d_number == null || d_number == "")
		{
			document.getElementById("d_number").classList.add("mystyle");
			alert("Please enter Drug Licence Number");
			return false;
		}
		else if(f_number == null || f_number == "")
		{
			document.getElementById("f_number").classList.add("mystyle");
			alert("Please enter FSSAI Number");
			return false;
		}
		else if(gst_number == null || gst_number == "")
		{
			document.getElementById("gst_number").classList.add("mystyle");
			alert("Please enter GST Number");
			return false;
		}
		else if(con_number.match(phvalid) == null)
		{
			document.getElementById("con_number").classList.add("mystyle");
			alert("Please enter a correct Phone Number");
			return false;
		}
		else if(u_email.match(emvalid) == null)
		{
			document.getElementById("u_email").classList.add("mystyle");
			alert("Please enter correct Email ID");
			return false;
		}
		else if(u_password == null || u_password == "")
		{
			document.getElementById("u_password").classList.add("mystyle");
			alert("Please enter password");
			return false;
		}
		else if(u_password !== u_password_repeat)
		{
			document.getElementById("u_password").classList.add("mystyle");
			document.getElementById("u_password_repeat").classList.add("mystyle");
			alert("Password Confirm password doesn't matched");
			return false;
		}
	}
	else if(user_type == "Retailer")
	{
		
		if(firm_address1 == null || firm_address1 == "")
		{
			document.getElementById("firm_address1").classList.add("mystyle");
			alert("Please enter Shop No./Plot No.");
			return false;
		}
		else if(firm_address2 == null || firm_address2 == "")
		{
			document.getElementById("firm_address2").classList.add("mystyle");
			alert("Please enter Street Name");
			return false;
		}
		else if(firm_address3 == null || firm_address3 == "")
		{
			document.getElementById("firm_address3").classList.add("mystyle");
			alert("Please enter City");
			return false;
		}
		else if(d_number == null || d_number == "")
		{
			document.getElementById("d_number").classList.add("mystyle");
			alert("Please enter Drug Licence Number");
			return false;
		}
		else if(gst_number == null || gst_number == "")
		{
			document.getElementById("gst_number").classList.add("mystyle");
			alert("Please enter GST Number");
			return false;
		}
		else if(con_number.match(phvalid) == null)
		{
			document.getElementById("con_number").classList.add("mystyle");
			alert("Please enter a correct Phone Number");
			return false;
		}
		else if(u_email.match(emvalid) == null)
		{
			document.getElementById("u_email").classList.add("mystyle");
			alert("Please enter correct Email ID");
			return false;
		}
		else if(u_password == null || u_password == "")
		{
			document.getElementById("u_password").classList.add("mystyle");
			alert("Please enter password");
			return false;
		}
		else if(u_password !== u_password_repeat)
		{
			document.getElementById("u_password").classList.add("mystyle");
			document.getElementById("u_password_repeat").classList.add("mystyle");
			alert("Password Confirm password doesn't matched");
			return false;
		}
	}
	else if(user_type == "Doctor")
	{
		
		if(firm_address1 == null || firm_address1 == "")
		{
			document.getElementById("firm_address1").classList.add("mystyle");
			alert("Please enter Shop No./Plot No.");
			return false;
		}
		else if(firm_address2 == null || firm_address2 == "")
		{
			document.getElementById("firm_address2").classList.add("mystyle");
			alert("Please enter Street Name");
			return false;
		}
		else if(firm_address3 == null || firm_address3 == "")
		{
			document.getElementById("firm_address3").classList.add("mystyle");
			alert("Please enter City");
			return false;
		}
		else if(d_number == null || d_number == "")
		{
			document.getElementById("d_number").classList.add("mystyle");
			alert("Please enter Doctor Registration Number");
			return false;
		}
		else if(con_number.match(phvalid) == null)
		{
			document.getElementById("con_number").classList.add("mystyle");
			alert("Please enter a correct Phone Number");
			return false;
		}
		else if(u_email.match(emvalid) == null)
		{
			document.getElementById("u_email").classList.add("mystyle");
			alert("Please enter correct Email ID");
			return false;
		}
		else if(u_password == null || u_password == "")
		{
			document.getElementById("u_password").classList.add("mystyle");
			alert("Please enter password");
			return false;
		}
		else if(u_password !== u_password_repeat)
		{
			document.getElementById("u_password").classList.add("mystyle");
			document.getElementById("u_password_repeat").classList.add("mystyle");
			alert("Password Confirm password doesn't matched");
			return false;
		}
	}
	return true;
}
</script>
<div class="auth-page" style ="background-color: #eef5f9 !important;">
    <div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-5 col-md-5">
		<a href="<?php echo base_url();?>"><img src="http://medideals.co.in/assets/images/logo.png"></a><br><br>
		<h2> Registration Process :</h2>
		<br><br>
		<div style ="text-align:justify; font-size:16px;">
		a. We will send you a verification email to verify your email address after you successfully fill all your details and register. <br><br>
		b. We will verify all the details provided by you, after verification we will send you an account activation email after which you can start business on Medideals. <br><br>
		c. In case of any problem with verification of your details, we will send you an email informing you about the issue.<br><br>
		d. Once appropriate details are provided from your side we will activate your account in 24 hours and you can start business on Medideals.<br><br>
		</div>
		</div>
        <div class="col-sm-5 col-md-5"> 
            <?php
            if ($this->session->flashdata('error_register')) {
                ?>
                <div class="alert alert-danger"><?= implode('<br>', $this->session->flashdata('error_register')) ?></div>
                <?php
            }
            ?>
			
            <div class="vendor-login">
                <h1><?= lang('user_register_page') ?></h1><br>
                <form method="POST" action="<?php echo base_url('vendor/register');?>" onsubmit="return valid()">
                   <span class = "sizer">*</span> <input type="text" name="firm_name" placeholder="Business Name" id="firm_name">
				   <span class = "sizer">*</span> <select name="user_type" style="width: 96%; height:35px;" id="user_type" onchange="validstar()">
                   <option value="-1">Account Type</option>
                   <option value="Wholeseller">Wholeseller</option>
                   <option value="Retailer">Retailer</option>
                   <option value="PCD Company">PCD Company</option>
                   <option value="Third Party">Third Party Manufacturer</option>
                   <option value="FMCG">FMCG</option>
				   <option value="Doctor">Doctor</option>
                   </select>
                   <br/>
				   <br>
                   <span class = "sizer">*</span> <input type="text" name="firm_address1" placeholder="Shop No. / Plot No." id="firm_address1">
                   <span class = "sizer">*</span> <input type="text" name="firm_address2" placeholder="Street Name" id ="firm_address2">
                   <span class = "sizer">*</span> <input type="text" name="firm_address3" placeholder="City" id="firm_address3">
                   <span class = "sizer" id="drg">*</span> <input type="text" name="d_number" placeholder="Drug Licence Number" id="d_number">
                   <input type="hidden" name="f_number" placeholder="FSSAI Number" id="f_number" value="FSSAI Number">
                   <span class = "sizer" id="gst">*</span> <input type="text" name="gst_number" placeholder="GST Number" id="gst_number">    
                   <span class = "sizer">*</span> <input type="text" name="con_number" placeholder="10 Digit Contact Number" id ="con_number">
				   <input type="hidden" name="website_url" placeholder="Website URL, if any" id ="website_url" value="website URL">
				   <input type="hidden" name="affcode" placeholder="Affiliate Code, if any" id ="affcode" value="<?php echo @$aff_code;?>">
                   <span class = "sizer">*</span> <input type="text" name="u_email" value="<?= $this->session->flashdata('email') ? $this->session->flashdata('email') : '' ?>" placeholder="<?= lang('email') ?>" id ="u_email">
                   <span class = "sizer">*</span> <input type="password" name="u_password" placeholder="<?= lang('password') ?>" id ="u_password">
                   <span class = "sizer">*</span> <input type="password" name="u_password_repeat" placeholder="<?= lang('password_repeat') ?>" id="u_password_repeat">
                    <input type="submit" name="register" class="login submit" value="<?= lang('register_me') ?>">
                </form>
            </div>
        </div>
		<div class="col-sm-1">
		</div>
    </div>
</div>