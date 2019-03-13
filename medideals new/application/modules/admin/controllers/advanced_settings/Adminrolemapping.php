<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Adminrolemapping extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Admin_rolemapping_model');
    }

    public function index()
    {
        $this->login_check();
        $data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - Admin Users';
        $head['description'] = '!';
        $head['keywords'] = '';
        $roles = $this->Admin_rolemapping_model->showrolename();
		$data['roles'] = $roles;
		$i = 0;
		foreach($roles as $role)
		{
			$menuinfo[$i] = $this->Admin_rolemapping_model->showmenubyid($role->role_id);
			$i++;
		}
		$data['menuinfo'] = $menuinfo;
        $this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/adminshowroles',$data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');
		
    }
	public function maprole()
	{
		$this->login_check();
		$data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - Admin Users';
        $head['description'] = '!';
        $head['keywords'] = '';
		// show all menus
		$data['menu'] = $this->Admin_rolemapping_model->showmenu();
		// show all roles
		$data['rolename'] = $this->Admin_rolemapping_model->showrolename();
		
		if(isset($_POST['rolemap']))
		{
			$this->Admin_rolemapping_model->insertrole($_POST);
			redirect('admin/rolemapping');
		}
		
		$this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/admincreaterolemapping', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');
	}
	public function showsinglerole($id = null, $name = null)
	{
		$this->login_check();
		$data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - Admin Users';
        $head['description'] = '!';
        $head['keywords'] = '';
		// show all menus
		$data['id'] = $id;
		$data['name'] = $name;
		$data['info'] = $this->Admin_rolemapping_model->showrolemap($id);
		$data['menu'] = $this->Admin_rolemapping_model->showmenu();
		$this->load->view('_parts/header', $head);
        $this->load->view('advanced_settings/admineditrolemapping', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to Admin Users');
	}
	public function editroles()
	{
		$this->login_check();
		if(isset($_POST['submitrole']))
		{	
			$this->Admin_rolemapping_model->editrolemapper($_POST);
			redirect('admin/rolemapping');
		}
	}
}
