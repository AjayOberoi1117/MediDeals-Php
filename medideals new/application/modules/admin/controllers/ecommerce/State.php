<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class State extends ADMIN_Controller
{

    public function __construct()
    {
        parent::__construct();
		$this->load->model('Products_model'); 	
       
    }

    public function index()
    {
		
		$data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - State';
        $head['description'] = '!';
        $head['keywords'] = '';
		$data['record']=$this->Products_model->fetchstate();
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/add_state',$data);
        $this->load->view('_parts/footer');
    }
	public function Savestate()
	{
		$statename=$_POST['name'];
		
		$data = array(
				   'state_name' => $statename
				);

		if($this->db->insert('state_master', $data))
		{
		redirect('admin/state');

		}
	}
  public function stateshow($state_id)
    {
		
		$data = array();
        $head = array();
        $head['title'] = 'Administration - State';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['record'] = $this->Products_model->stateshow($state_id);
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/stateshow', $data);
		 $this->load->view('_parts/footer');
    }
	public function update($state_id)
	{
		$statename=$_POST['name'];
		$data=array('state_id'=>$state_id,
					'state_name'=>$statename,
					);
	
		$result= $this->Products_model->update($data);
	if($result==true)
	{
		redirect('admin/state');
	}	
	}
	public function deletestate($state_id)
	{
		$this->load->model('Products_model'); 	
		$response=$this->Products_model->deletestate($state_id);
		 
	if($response==true)
	{
		echo "<script> alert($response)</script>";
		redirect('admin/state');
	}
	else
	{
		echo " Error";
	}				
	}


}
