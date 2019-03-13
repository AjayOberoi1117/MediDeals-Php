<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class City extends ADMIN_Controller
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
        $head['title'] = 'Administration - city';
        $head['description'] = '!';
        $head['keywords'] = '';
		$data['states']=$this->Products_model->showstate();
		$data['record']=$this->Products_model->fetchcity();
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/add_city',$data);
        $this->load->view('_parts/footer');
    }
	public function Savecity()
	{
		$cityname=$_POST['city_name'];
		$stateid=$_POST['state_id'];
		$data = array(
				   'city_name' => $cityname,
				   'state_id'=>$stateid
				);
	if($this->db->insert('city_master', $data))
	{
	redirect('admin/city');

	}

}
	public function cityshow($city_id)
    {

		$data = array();
        $head = array();
        $head['title'] = 'Administration - city';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['records'] = $this->Products_model->cityshow($city_id);
		$data['states']=$this->Products_model->showstate();
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/cityshow', $data);
		 $this->load->view('_parts/footer');
    }
	public function updatecity($city_id)
	{
		
		$cityname=$_POST['city_name'];
		$stateid=$_POST['state_id'];
		$data=array('city_id'=>$city_id,
					 'city_name' => $cityname,
				   'state_id'=>$stateid
					);
				  
	$result= $this->Products_model->updatecity($data);
	if($result==true)
	{
		redirect('admin/city');
	}	
	}
	public function deletecity($city_id)
	{
		$this->load->model('Products_model'); 	
		$response=$this->Products_model->deletecity($city_id);
		 
	if($response==true)
	{
		echo "<script> alert($response)</script>";
		redirect('admin/city');
	}
	else
	{
		echo " Error";
	}				
	}

 

}
