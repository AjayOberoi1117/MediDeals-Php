<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Adminaffiliatemkt extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_affiliate_model');
    }

    public function index()
    {
        $this->login_check();
        if (isset($_GET['delete'])) {
            $this->Admin_affiliate_model->delete_single_affiliate($affiliate_id);
            $this->session->set_flashdata('result_delete', 'User is deleted!');
            redirect('admin/adminusers');
        }
        if (isset($_GET['edit']) && !isset($_POST['username'])) {
            $_POST = $this->Admin_affiliate_model->getAdminUsers($_GET['edit']);
			$_POST['userroles'] = $this->Admin_affiliate_model->getuserroles();
			
        }
        $data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - Admin Users';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['users'] = $this->Admin_affiliate_model->show_all_affiliates();
		for($i = 0; $i < count($data['users']); $i++)
		{
			$data['affiliated'][$i]= $this->Admin_affiliate_model->show_all_affiliated($data['users'][$i]['id']);
		}
        $this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/affiliate_mkt', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');
    }
	
}
