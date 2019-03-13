<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Adminusers extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_users_model');
    }

    public function index()
    {
        $this->login_check();
        if (isset($_GET['delete'])) {
            $this->Admin_users_model->deleteAdminUser($_GET['delete']);
            $this->session->set_flashdata('result_delete', 'User is deleted!');
            redirect('admin/adminusers');
        }
        if (isset($_GET['edit']) && !isset($_POST['username'])) {
            $_POST = $this->Admin_users_model->getAdminUsers($_GET['edit']);
			$_POST['userroles'] = $this->Admin_users_model->getuserroles();
			
        }
        $data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - Admin Users';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['users'] = $this->Admin_users_model->getAdminUsers();
		$data['userroles'] = $this->Admin_users_model->getuserroles();
        $this->form_validation->set_rules('username', 'User', 'trim|required');
        if (isset($_POST['edit']) && $_POST['edit'] == 0) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
        }
        if ($this->form_validation->run($this)) {
            $this->Admin_users_model->setAdminUser($_POST);
			// send email to user
			$role_name = $this->Admin_users_model->getuserrolename($_POST['user_role']);
			$result = $this->userregemail($_POST, $role_name[0]->role_name);
			
			if($result == true){
				echo "<script type='text/javascript'>Email sent to Customer.</script>";
			}
			else{
				echo "<script type='text/javascript'>Email not sent to Customer.</script>";
			}
			
            $this->saveHistory('Create admin user - ' . $_POST['username']);
            redirect('admin/adminusers');
        }

        $this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/adminUsers', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');
    }
	public function userregemail($data, $role_name)
	{
		$this->load->library('email');
		
			$message = "Dear User, <br>";
			$message .= "Your account is created and activated by Admin. <br>";	
			$message .= "With following details: <br>";	
			$message .= "Username: ".$data['username'] ."<br>";	
			$message .= "Password: ".$data['password'] ."<br>";
			$message .= "Role: ".$role_name ."<br>";
			$message .= "Link: ".base_url()."admin/  <br>";
			$message .= "If you face any problems with the same, Email us at : admin@medideals.co.in <br>";
			$message .= "Warm Regards <br>";
			$message .= "Admin Medideals<br>";
		
			//$this->email->initialize($config);
			// Sender email address
			$this->email->from('admin@medideals.co.in', 'Admin Medideals Team');
			// Receiver email address
			$this->email->to(array($data['email'],'admin@medideals.co.in'));
			// Subject of email
			$this->email->subject("Account activation status from Medideals");
			// Message in email		
			$this->email->message($message);
			//Send mail 
			if($this->email->send()) 
			{
				return true;
			} 
			else 
			{
				return false;
			}
	}
}
