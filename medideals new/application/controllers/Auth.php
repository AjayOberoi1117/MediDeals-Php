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
    }

    public function index()
    {
        show_404();
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
			//var_dump($result);
            if ($result == false) {
                $this->session->set_flashdata('login_error', lang('login_vendor_error'));
                redirect(LANG_URL . '/vendor/login');
            } else {
                $remember_me = false;
                if (isset($_POST['remember_me'])) {
                    $remember_me = true;
                }
              $vendor_user=$this->setLoginSession($_POST['u_email'], $remember_me);
			  $_SESSION['vendor_user']=$_POST['u_email'];
			 
			//exit;
                redirect(LANG_URL . '/vendor/me/');
            }
        }
        $this->load->view('_parts/header', $head);
        $this->load->view('login', $data);
        $this->load->view('_parts/footer');
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
		/*if (mb_strlen(trim($_POST['u_name'])) == 0) {
            $errors[] = lang('please_enter_username');
        }*/
		if (mb_strlen(trim($_POST['firm_name'])) == 0) {
            $errors[] = lang('please_enter_firmname');
        }
		if (mb_strlen(trim($_POST['firm_address'])) == 0) {
            $errors[] = lang('please_enter_firm_address');
        }
		if (mb_strlen(trim($_POST['d_number'])) == 0) {
            $errors[] = lang('please_enter_drug_licence_number');
        }
		if (mb_strlen(trim($_POST['f_number'])) == 0) {
            $errors[] = lang('please_enter_fssai_number');
        }
		if (mb_strlen(trim($_POST['con_number'])) == 0) {
            $errors[] = lang('please_enter_contact_number');
        }
		
		if (mb_strlen(trim($_POST['gst_number'])) == 0) {
            $errors[] = lang('please_enter_gstnumber');
        }
		if (mb_strlen(trim($_POST['user_type'])) == 0) {
            $errors[] = lang('please_select_usertype');
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
        if (!empty($errors)) {
            $this->registerErrors = $errors;
            return false;
        }
        $res=$this->Auth_model->registerVendor($_POST);
		//echo $res;die;
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

}
