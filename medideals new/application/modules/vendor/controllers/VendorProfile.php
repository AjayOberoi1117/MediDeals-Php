<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class VendorProfile extends VENDOR_Controller
{
 private $num_rows =2;
    public function __construct()
    {
        parent::__construct();
         $this->load->model('Vendorprofile_model');
		 $this->load->model('Products_model');
		 $this->load->model('Orders_model');
    }

    public function index()
    {
		//SESSION_UNSET(@$key);
		//var_dump($_SESSION); die;
		//echo $this->vendor_id;die;
		//$_SESSION['vendor_user']
        $data = array();
        $head = array();
        $head['title'] = lang('vendor_dashboard');
        $head['description'] = lang('vendor_home_page');
        $head['keywords'] = '';
		$_SESSION['vendor_id']=$this->vendor_id;
			 
		$data['vendor_detail'] = $this->Vendorprofile_model->getVendorInfoFromEmail($_SESSION['vendor_user']);
		
		// for Seller
		
		$_SESSION['status'] = $data['vendor_detail']['status'];
		$_SESSION['firm_name'] = $data['vendor_detail']['firm_name'];
        /*$data['ordersByMonth'] = $this->Vendorprofile_model->getOrdersByMonth($this->vendor_id);
		$data['rowscount'] = $this->Products_model->productsCount($this->vendor_id);
		$data['totalenquiry'] = $this->Products_model->totalenquiry();
		*/
		// for Wholesaler 
		
		$data['rowscount'] =  $this->Products_model->productsCount($this->vendor_id);
		
		$data['activeproduct'] = $this->Products_model->activeproduct($this->vendor_id);
		
		$data['inactiveproduct'] = $this->Products_model->inactiveproduct($this->vendor_id);
		
		$data['productsold'] = $this->Products_model->productsold($this->vendor_id);
		
		$data['productreturn'] = $this->Products_model->productreturn($this->vendor_id);
		
		$data['ordersreceive'] = $this->Products_model->ordersreceived($this->vendor_id);
		
		$data['ordersdelivered'] = $this->Products_model->ordersdelivered($this->vendor_id);
		
		$data['orderdispatched'] = $this->Products_model->orderdispatched($this->vendor_id);
		
		$data['orderreturns'] = $this->Products_model->orderreturns($this->vendor_id);
		
		$data['totalrevenue'] = $this->Products_model->totalrevenue($this->vendor_id);
		
		$data['whsmoneyescrow'] = $this->Products_model->whsmoneyescrow($this->vendor_id);
		
		$data['sub_date'] = $this->Products_model->subs_date($this->vendor_id);
		
		// for buyer
		$data['totalorderplaced'] = $this->Products_model->totalorderplaced($_SESSION['vendor_user']);
		
		$data['totalorderreceived'] = $this->Products_model->totalorderreceived($_SESSION['vendor_user']);
		
		$data['totalorderreturned'] = $this->Products_model->totalorderreturned($_SESSION['vendor_user']);
		
		$data['totalproductreceive'] = $this->Products_model->totalproductreceive($_SESSION['vendor_user']);
		
		$data['totalproductreturn'] = $this->Products_model->totalproductreturn($_SESSION['vendor_user']);
		
		$data['moneyescrow'] = $this->Products_model->moneyescrow($_SESSION['vendor_user']);
		
		$data['sub_date'] = $this->Products_model->subs_date($this->vendor_id);
		
		$data['lastorder'] = $this->Products_model->lastorder($_SESSION['vendor_user']);
		
		
		//$data['subdate'] = $this->Products_model->subdate();
		
		//$data['ordercount'] = $this->Orders_model->ordersCount($this->vendor_id);
		
		//$data['monthorders'] = $this->Orders_model->month_orders($this->vendor_id);
		
		
		// check subscription status
		$subs = $this->Vendorprofile_model->subs_status($this->vendor_id);
		$_SESSION['subs_status'] = $subs['status'];
		$this->load->view('_parts/header', $head);
        $this->load->view('home',$data);
        $this->load->view('_parts/footer');
    }
	
	
	 public function profile()
    {

        $data = array();
        $head = array();
        $head['title'] = 'Profile';
        $head['description'] = 'Profile';
        $head['keywords'] = '';
        $data['profile'] = $this->Vendorprofile_model->getVendorInfoFromEmail($_SESSION['logged_vendor']);
		//print_r($data['profile']);
        $this->load->view('_parts/header', $head);
        $this->load->view('customer_profile', $data);
        $this->load->view('_parts/footer');
    }
	
	public function updateprofile()
	{
	 /*if (isset($_POST['firm_address1'] )) {
	 $username=substr($_POST['firm_address1'],0,2);
	 }
	 else
	 {
	 $username = 'no address';
	 }*/
	
	if (isset($_POST['firm_name'] )) {
	$firm_name = $_POST['firm_name'];
	} else {
	$firm_name = 'no name';  
	}
	if (isset($_POST['firm_address1']) || isset($_POST['firm_address1']) || isset($_POST['firm_address1'])) {
	$firm_address = $_POST['firm_address1']."#@%".$_POST['firm_address2']."#@%".$_POST['firm_address3'];
	} else {
	$firm_address = 'no address';	
	}
	if (isset($_POST['d_number'] )) {
	$d_number = $_POST['d_number']; 
	} else {
	$d_number = 'no d_number';
	}
	if (isset($_POST['f_number'])) {
	$f_number = $_POST['f_number'];
	} else {
	$f_number = 'no f_number';	
	} 
	if (isset($_POST['con_number'] )) {
	$con_number = $_POST['con_number'];
	} else {
	 $con_number = 'no con_number';	
	}
	if (isset($_POST['gst_number'] )) {
	$gst_number = $_POST['gst_number'];
	} else {
	 $gst_number = 'no gst_number';	
	}
	if (isset($_POST['user_type'] )) {
	$user_type = $_POST['user_type'];
	} else {
	$user_type = 'no user_type';	
	}
	if (isset($_POST['u_password'])) {
	  $u_password = $_POST['u_password'];
	} else {
	$u_password = 'no_password';   
	}
	$website_url = $_POST['website_url'];
	//exit;
	//$str1=implode($username);

	//$uname=$username.rand(1000,9999);
	$data = array( 
    //'name'      => $uname , 
    'firm_name'      => $firm_name, 
    'firm_address'   => $firm_address,
	'drug_licence'   => $d_number,
	'fssai_no'       => $f_number,
    'contact_no'     => $con_number,
	'gst_number'     => $gst_number,
	'user_type'      => $user_type,
	'website_url'    => $website_url,
	'password'       => password_hash($u_password, PASSWORD_DEFAULT)
	);


	$this->db->where('email', $_SESSION['logged_vendor']);

	if($this->db->update('vendors', $data))
	 {
		  redirect(LANG_URL . '/vendor/profile');
		  }
		  else
		  {
			 log_message('error', print_r($this->db->error(), true));
				show_error(lang('database_error'));
		  }
	}
		

    public function logout()
    {
        unset($_SESSION['logged_vendor']);
        unset($_SESSION['vendor_user']);
        unset($_SESSION['status']);
		//unset($_SESSION['usertype']);
        delete_cookie('logged_vendor');
        delete_cookie('vendor_user');
		//delete_cookie('usertype');
		unset($_SESSION);
		unset($_COOKIE);
		//$this->session->sess_destroy('usertype');
		//$this->session->sess_destroy('__ci_last_regenerate');
        redirect(LANG_URL . '/vendor/login');
    }
	// affiliate program
	public function affiliate_code($page = 0)
	{
		$data = array();
        $head = array();
        $head['title'] = 'Affiliate Program';
        $head['description'] = 'Affiliate Program';
        $head['keywords'] = '';
        $data['affiliate_code'] = $this->Vendorprofile_model->get_affiliate_code($_SESSION['vendor_id']);
		$data['affiliated_entry'] = $this->Vendorprofile_model->find_affiliator($_SESSION['vendor_id']);
		$rowscount = $this->Vendorprofile_model->affiliatecount();
		$data['affiliate_information'] = $this->Vendorprofile_model->my_affiliates($_SESSION['vendor_id'],$this->num_rows,$page);
		 $data['links_pagination'] = pagination('vendor/affiliate',$rowscount,$this->num_rows,MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		
		//print_r($data['profile']);
        $this->load->view('_parts/header', $head);
        $this->load->view('affiliate_program',$data);
        $this->load->view('_parts/footer');
	}
	public function gen_affiliate_code()
	{
	$this->Vendorprofile_model->generate_affiliate_code($_SESSION['vendor_id']);
		redirect(LANG_URL . '/vendor/affiliate');
	}
	public function add_affiliate_code()
	{
		$affiliate_id = $this->Vendorprofile_model->findidbyaffcode(trim($_POST['aff_code']));
		if($affiliate_id == null)
		{
			?>
			<script type="text/javascript">
			alert("The Affiliate code you have inserted is not found in the record. Please check and try again.");
			window.location = "<?= LANG_URL . '/vendor/affiliate'; ?>";
			</script>
			<?php
		}
		else if($affiliate_id['vendor_id'] == $_SESSION['vendor_id']){
			?>
			<script type="text/javascript">
			alert("The affiliate id & affiliator id cannot be same.");
			window.location = "<?= LANG_URL . '/vendor/affiliate'; ?>";
			</script>
			<?php
		}
		else{
		$this->Vendorprofile_model->addaffiliaterecord($affiliate_id['vendor_id'], $_SESSION['vendor_id']);
		
			?>
			<script type="text/javascript">
			alert("The Affiliation is registered successfully.");
			window.location = "<?= LANG_URL . '/vendor/affiliate'; ?>";
			</script>
			<?php
		}
		
	}
	public function send_affiliate_email($code)
	{
		$this->load->library('email');
	
		if($_POST['message'] == null || $_POST['message'] == "")
		{
			echo "<script type='text/javascript'>alert('Message section cannot be empty');</script>";
		}
		if($_POST['recipient'] == null || $_POST['recipient'] == "")
		{
			echo "<script type='text/javascript'>alert('Recipient section cannot be empty');</script>";
		}
		// recipient
		$recipient = str_replace(" ",'', $_POST['recipient']);
		$recipient_array = explode(",",$recipient);
		$recipient_array[] = 'support@medideals.co.in';
		
		$subject = "Get Registered in Medideals & start Trading";	

		$message = $_POST['message'];
		$message .= "Website link : ".base_url().'vendor/register?affcode='.$code;
		
		//$this->email->initialize($config);
		// Sender email address
		$this->email->from($_SESSION['logged_vendor'], 'Medideals Team');
		// Receiver email address
		$this->email->to($recipient_array);
		// Subject of email
		$this->email->subject($subject);
		// Message in email		
		$this->email->message($message);
		//Send mail 
		if($this->email->send()) 
		{
			echo "<script type='text/javascript'>alert('Mail successfully sent');</script>";
		} 
		else 
		{
			echo "<script type='text/javascript'>alert('Error in Email delivery. Contact Administrator');</script>";
		}
		
		redirect("vendor/affiliate");
	}
	

}
