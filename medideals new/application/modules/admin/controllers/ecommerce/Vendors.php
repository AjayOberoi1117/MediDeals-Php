<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Vendors extends ADMIN_Controller
{
 private $num_rows = 10;
    public function __construct()
    {
        parent::__construct();
		$this->load->model('Products_model');
       
    }

    public function index($page = 0)
    {
		
        $data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - vendors';
        $head['description'] = '!';
        $head['keywords'] = '';
		$this->load->library('pagination');
		$rowscount = $this->Products_model->vendorcount();
        $data['actions'] = $this->Products_model->fetchvendors($this->num_rows, $page);
        $data['links_pagination'] = pagination('admin/vendors', $rowscount, $this->num_rows, 3);
        $data['vendors'] = $this->vendors;
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/vendors',$data);
        $this->load->view('_parts/footer');
		if ($page == 0) {
            $this->savevendors('Go to vendors');
        }
    }
	
	public function showvendors($id)
    {

		$data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
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
		$firm_address=$_POST['firm_address1']."#@%".$_POST['firm_address2']."#@%".$_POST['firm_address3'];
		$drug_licence=$_POST['drug_licence'];
		$fssai_no=$_POST['fssai_no'];
		$contact_no=$_POST['contact_no'];
		$password=$_POST['password'];
		$gst_number=$_POST['gst_number'];
		$user_type=$_POST['user_type'];
		$website_url=$_POST['website_url'];
		$data=array('id'=>$id,
				   'name' => $name,
				   'email'=>$email,
				   'firm_name'=>$firm_name,
				   'firm_address'=>$firm_address,
				   'drug_licence'=>$drug_licence,
				   'fssai_no'=>$fssai_no,
				   'contact_no'=>$contact_no,
				   'password'=>$password,
                   'gst_number'=>$gst_number,
				   'user_type'=>$user_type,
				   'website_url'=>$website_url
					);
	$result= $this->Products_model->updatevendors($data);
	if($result==true)
	{
		redirect('admin/vendors');
	}	
	} 
	public function updatevendorsststus()
	{
		$status = $this->uri->segment(4);
		$id = $this->uri->segment(5);
		
		
		$data=array('id'=>$id,
					 'status'=> $status,
				 );

		$result= $this->Products_model->updatevendorsststus($data);
		if($result==true)
		{
			// send email
			$customeremail = $this->Products_model->vendoremailid($id);
			//var_dump($customeremail); die; 
			$result = $this->vendor_acti_deacti_email($customeremail);
			
			if($result == true){
				echo "<script type='text/javascript'>Email sent to Customer.</script>";
			}
			else{
				echo "<script type='text/javascript'>Email not sent to Customer.</script>";
			}
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
	public function vendor_acti_deacti_email($data)
	{
		$this->load->library('email');
		foreach($data as $dat)
		{	
			$message = "Dear Customer, <br>";
			$message .= "This email is regarding your activity on Medideals for ".$dat->name."<br>";
				
			if($dat->status == 0)
			{ $message .= "We have found some malicious activity in your account and hence DEATIVATED your account to stop from further damages.<br>";}
			elseif($dat->status == 1)
			{ $message .= "Your account is successfully verified & activated. You can start using it for Business.<br>";}
			else
			{ $message .= "Error <br>";}
				
			$message .= "If you face any problems Email us at : support@medideals.co.in <br>";
			$message .= "Warm Regards <br>";
			$message .= "Medideals Team <br>";
		
			//$this->email->initialize($config);
			// Sender email address
			$this->email->from('support@medideals.co.in', 'Medideals Team');
			// Receiver email address
			$this->email->to(array($dat->email,'support@medideals.co.in'));
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

}
