<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admincreateroles extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_create_roles_model');
    }

    public function index()
    {
        $this->login_check();
        if (isset($_GET['delete'])) {
            $this->Admin_create_roles_model->deleteAdminUser($_GET['delete']);
            $this->session->set_flashdata('result_delete', 'User is deleted!');
            redirect('admin/createroles');
        }
        if (isset($_GET['edit']) && !isset($_POST['role_name'])) {
            $_POST = $this->Admin_create_roles_model->getAdminUsers($_GET['edit']);
        }
        $data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - Admin Users';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['users'] = $this->Admin_create_roles_model->getAdminUsers();
        $this->form_validation->set_rules('role_name', 'Role name', 'trim|required');
		 $this->form_validation->set_rules('status', 'Status', 'trim|required');
      
        if ($this->form_validation->run($this)) {
            $this->Admin_create_roles_model->setAdminUser($_POST);
            $this->saveHistory('Create admin user - ' . $_POST['role_name']);
            redirect('admin/createroles');
        }
		
        $this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/createroles', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');
    }

}
