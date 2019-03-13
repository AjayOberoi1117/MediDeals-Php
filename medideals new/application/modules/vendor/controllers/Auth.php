<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth extends VENDOR_Controller
{

    private $registerErrors = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->model('Products_model');
		$this->clear_cache();
		$this->load->library('encrypt'); 
    }

    public function index()
    {
        show_404();
    }
	function clear_cache()
    {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }
    public function login()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('user_login_page');
        $head['description'] = lang('open_your_account');
        $head['keywords'] = '';

        if (isset($_POST['login'])) {
            $result = $this->verifyVendorLogin();
			
			$res=$this->Products_model->getVendorById(@$_SESSION['vendor_id']);
			$_SESSION['vendor_user']=$res['email'];
			$_SESSION['vendor_id']=$res['id'];
			$_SESSION['status']=$res['status'];
			$_SESSION['firm_name']=$res['firm_name'];
			//$_SESSION['usertype']=$res['user_type'];

            if ($result == false) {
                redirect(LANG_URL . '/vendor/login');
            } else {
                $remember_me = false;
                if (isset($_POST['remember_me'])) {
                    $remember_me = true;
                }
              $vendor_user=$this->setLoginSession($_POST['u_email'], $remember_me);
				$_SESSION['vendor_user']=$_POST['u_email'];
			
			 @$key=$_GET['key'];
			if($key == 2)
			{
				 redirect('/checkout');
			} 
			else if($key == 3)
			{
				redirect('/shopping-cart');
			}	
			else
			{
				redirect(LANG_URL . '/vendor/me/');
			}
			
			
            }
        }
        $this->load->view('_parts/header_auth', $head);
        $this->load->view('auth/login', $data);
        $this->load->view('_parts/footer_auth');
    }

    private function verifyVendorLogin()
    {
        return $this->Auth_model->checkVendorExsists($_POST);
    }

    public function register()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('user_register_page');
        $head['description'] = lang('create_account');
        $head['keywords'] = '';
		if(isset($_GET['affcode'])){
		$data['aff_code'] = $_GET['affcode'];}

        if (isset($_POST['register'])) {
					
            $result = $this->registerVendor();
            if ($result == false) {
                $this->session->set_flashdata('error_register', $this->registerErrors);
                $this->session->set_flashdata('email', $_POST['u_email']);
                redirect(LANG_URL . '/vendor/register');
            } else {
                //$this->setLoginSession($_POST['u_email'], false);
                redirect(LANG_URL . '/vendor/login');
            }
        }
        $this->load->view('_parts/header_auth', $head);
        $this->load->view('auth/register', $data);
        $this->load->view('_parts/footer_auth');
    }

    private function registerVendor()
    {
		
        $errors = array();
	
		if (mb_strlen(trim($_POST['firm_name'])) == 0) {
            $errors[] = lang('please_enter_firmname');
        }
		if (mb_strlen(trim($_POST['firm_address1'].$_POST['firm_address2'].$_POST['firm_address3'])) == 0) {
            $errors[] = lang('please_enter_firm_address');
        }
		if (mb_strlen(trim($_POST['user_type'])) == 2) {
            $errors[] = lang('please_select_usertype');
			
			if (mb_strlen(trim($_POST['d_number'])) == 0) {
				$errors[] = lang('please_enter_drug_licence_number');
			}
			if (mb_strlen(trim($_POST['f_number'])) == 0) {
				$errors[] = lang('please_enter_fssai_number');
			}
			if (mb_strlen(trim($_POST['gst_number'])) == 0) {
				$errors[] = lang('please_enter_gstnumber');
			}
        }
		else if($_POST['user_type'] == "Doctor")
		{
			if (mb_strlen(trim($_POST['d_number'])) == 0) {
            $errors[] = lang('please_enter_doctor_registration_number');
			}
		}
		else if($_POST['user_type'] == "Retailer")
		{
			if (mb_strlen(trim($_POST['d_number'])) == 0) {
            $errors[] = lang('please_enter_drug_licence_number');
			}
			if (mb_strlen(trim($_POST['gst_number'])) == 0) {
            $errors[] = lang('please_enter_gstnumber');
			}
		}
		else
		{			
			if (mb_strlen(trim($_POST['d_number'])) == 0) {
				$errors[] = lang('please_enter_drug_licence_number');
			}
			if (mb_strlen(trim($_POST['f_number'])) == 0) {
				$errors[] = lang('please_enter_fssai_number');
			}
			if (mb_strlen(trim($_POST['gst_number'])) == 0) {
				$errors[] = lang('please_enter_gstnumber');
			}
		}	
		
		if (mb_strlen(trim($_POST['con_number'])) == 0) {
            $errors[] = lang('please_enter_contact_number');
        }	
        if (mb_strlen(trim($_POST['u_password'])) == 0) {
            $errors[] = lang('please_enter_password');
        }
        if (mb_strlen(trim($_POST['u_password_repeat'])) == 0) {
            $errors[] = lang('please_repeat_password');
        }
        if ($_POST['u_password'] != $_POST['u_password_repeat']) {
            $errors[] = lang('passwords_dont_match');
        }
        if (!filter_var($_POST['u_email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('vendor_invalid_email');
        }
		
        $count_emails = $this->Auth_model->countVendorsWithEmail($_POST['u_email']);
        if ($count_emails > 0) {
            $errors[] = lang('vendor_email_is_taken');
        }
		//var_dump($_POST);die;
        if (!empty($errors)) {
            $this->registerErrors = $errors;
            return false;
        }
		
        $res = $this->Auth_model->registerVendor($_POST);
		$this->register_email($_POST['u_email'], $res); 
		$this->notify_register_email($_POST);
		return true;
    }

    public function forgotten()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('user_forgotten_page');
        $head['description'] = lang('recover_password');
        $head['keywords'] = '';

        $this->load->view('_parts/header_auth', $head);
        $this->load->view('auth/recover_pass', $data);
        $this->load->view('_parts/footer_auth');
    }
	public function recover()
	{
	echo $_POST['u_email'];
	}
	public function register_email($email,$token)
	{	
			$receiver_email = $email;
		
			$encmessage = $token.'/'.time();		
			$this->load->library('email');		
			$message = "Dear Customer, <br>";
			$message .= "Greeting from Medideals Team <br>";
			$message .= "Thank you for choosing us for your business. <br>";
			$message .= "Kindly, Click on the activation link to verify your email, <br>";
			$message .= base_url().'verifyemail/'.$encmessage;
			$message .= "<br>";
			$message .= "This verification link is valid till 24 Hours. If you have any trouble in verification please contact us at : support@medideals.co.in .";
			$message .= "Warm Regards, <br>";
			$message .= "Medideals Team <br>";
			//$this->email->initialize($config);
			// Sender email address
			$this->email->from('info@medideals.co.in', 'Medideals Team');
			// Receiver email address.for single email
			$this->email->to($receiver_email);
			// Subject of email
			$this->email->subject("Dear Customer from Medideals ID");
			// Message in email		
			$this->email->message($message);
			//Send mail 
			if($this->email->send()) 
			{
				//return true;
			} 
			else 
			{
				//return false;
			} 
	
	}
	// notification to admin
	public function notify_register_email($data)
	{			
			$this->load->library('email');		
			$message = "Dear Admin, <br>";
			$message .= "This is to notify that a new sign up is done on medideals with following details:  <br>";
			$message .= "Firm Name : ".$data['firm_name']. "  <br>";
			$message .= "Firm Address : ".$data['firm_address1']." ".$data['firm_address2']." ".$data['firm_address3']."  <br>";
			$message .= "Email : ".$data['u_email']. "  <br>";
			$message .= "Drug License Number : ".$data['d_number']. "  <br>";
			$message .= "FSSAI Number : ".$data['f_number']. "  <br>";
			$message .= "GST Number : ".$data['gst_number']. "  <br>";
			$message .= "Contact Number : ".$data['con_number']. "  <br>";
			$message .= "User Type : ".$data['user_type']. "  <br>";
			$message .= "Kindly, check & activate the same.  <br>";
			$message .= "Warm Regards <br>";
			$message .= "Medideals Team <br>";
			//$this->email->initialize($config);
			// Sender email address
			$this->email->from('info@medideals.co.in', 'Medideals Team');
			// Receiver email address.for single email
			$this->email->to('admin@medideals.co.in');
			// Subject of email
			$this->email->subject("Notification for New User Signup");
			// Message in email		
			$this->email->message($message);
			//Send mail 
			if($this->email->send()) 
			{
				//return true;
			} 
			else 
			{
				//return false;
			} 
	
	}
}
