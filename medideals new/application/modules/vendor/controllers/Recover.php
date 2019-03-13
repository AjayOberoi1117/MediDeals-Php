<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Recover extends VENDOR_Controller
{

    public function __construct()
	
    {
       $this->load->library('form_validation');

    }

    public function index()
    {

        //echo "hahaha exit";
		if(isset($_POST['login']))
		{ 
			$this->form_validation->set_error_delimiters('<div class="form_error">', '</div>');
			$this->form_validation->set_rules('u_email', 'Email Confirmation', 'trim|required');
			if ($this->form_validation->run() == FALSE)
			{
				$this->load->view('Recover/recover_pass');
			}
			else
			{
				$result = $this->forgot_password($_POST['u_email']);
				if($result == true)
				{
					echo "<script type='text/javascript'>alert('We Have Send Email ......');</script>";
				}
				else
				{
					echo "Plese Contect In Administer";
				}
				
			}
		}
	}
	public function forgot_password($email = null)
	{
			$this->load->library('email');

			// generate random password
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($j = 0; $j < 5; $j++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}	
			
			$password  = $randomString.rand(100000,999999);
			//var_dump($password);die;
			// update password in vendor table
			$this->db->set('password',password_hash("$password" ,PASSWORD_DEFAULT));	
			$this->db->where('email',"$email");
			if($this->db->update('vendors'))
			{

				$receiver_email = $email;		
				$message = "Dear Customer, <br>";
				$message .= "Greetings from Medideals Team <br>";
				$message .= "As per your request for Password Reset. ";
				$message .= "Your New password is : $password .";
				$message .= "Kindly use the same for login. <br>";
				$message .= "If you still have problem in login to your account. kindly Email us at : support@medideals.co.in <br>";
				$message .= "Warm Regards <br>";
				$message .= "Medideals Team <br>";
				//$this->email->initialize($config);
				// Sender email address
				$this->email->from('info@medideals.co.in', 'Medideals Team');
				// Receiver email address.for single email
				$this->email->to($receiver_email);
				// Subject of email
				$this->email->subject("Password reset request");
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
			else
			{
				return false;
			}

	}
}

