<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class vendors_product extends ADMIN_Controller
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
        $head['title'] = 'Administration - vendors';
        $head['description'] = '!';
        $head['keywords'] = '';
		$data['record']=$this->Products_model->fetchvendorsproduct();
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/vendors_product',$data);
        $this->load->view('_parts/footer');
    }
	
	/* public function showvendors($id)
    {

		$data = array();
        $head = array();
        $head['title'] = 'Administration - showvendors';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['record'] = $this->Products_model->showvendors($id);
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/showvendors', $data);
		 $this->load->view('_parts/footer');
    }
	 public function updatevendors($id)
	{
		
		$name=$_POST['name'];
		$email=$_POST['email'];
		$firm_name=$_POST['firm_name'];
		$firm_address=$_POST['firm_address'];
		$drug_licence=$_POST['drug_licence'];
		$fssai_no=$_POST['fssai_no'];
		$contact_no=$_POST['contact_no'];
		$password=$_POST['password'];
		$data=array('id'=>$id,
					 'name' => $name,
				   'email'=>$email,
				   'firm_name'=>$firm_name,
				   'firm_address'=>$firm_address,
				   'drug_licence'=>$drug_licence,
				   'fssai_no'=>$fssai_no,
				   'contact_no'=>$contact_no,
				   'password'=>$password
					);
	$result= $this->Products_model->updatevendors($data);
	if($result==true)
	{
		redirect('admin/vendors');
	}	
	}
	public function deletevendors($id)
	{
		$this->load->model('Products_model'); 	
		$response=$this->Products_model->deletevendors($id);
		 
	if($response==true)
	{
		echo "<script> alert($response)</script>";
		redirect('admin/vendors');
	}
	else
	{
		echo " Error";
	}				
	}  
 */


}
