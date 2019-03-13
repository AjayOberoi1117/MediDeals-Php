<?php

class Auth_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function registerVendor($post)
    {
		//var_dump($post); die;
	//$username=array($post['firm_address1']);
	//$str1=implode($username);
	//$uname=$str1[0].$str1[1].rand(10000,99999);
	$uname = $post['firm_address1'][0].$post['firm_address1'][1].$post['firm_address2'][0].$post['firm_address2'][1].rand(100000,9999999);
	
	// address 
	$address = trim($post['firm_address1']).'#@%'.trim($post['firm_address2']).'#@%'.trim($post['firm_address3']);
	// for dynamic url
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($j = 0; $j < 10; $j++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	$token = rand(10,99).$randomString.rand(100000,999999);
	
	//exit;
        $input = array(
            'email' => trim($post['u_email']),		
			'firm_name' => trim($post['firm_name']),
			'name' => trim($uname),
			'firm_address' => $address,
			'drug_licence' => trim($post['d_number']),
			'fssai_no' => trim($post['f_number']),
			'contact_no' => trim($post['con_number']),
			'gst_number' => trim($post['gst_number']),
			'user_type' => trim($post['user_type']),
			'website_url' => trim($post['website_url']),
            'password' => password_hash($post['u_password'], PASSWORD_DEFAULT),
			'token'=> $token
        );
        if (!$this->db->insert('vendors', $input)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
			return $token;
        }
		else
		{
			if(isset($post['affcode']) && $post['affcode'] != "")
			{
				$vaffcodeid = $this->fetchidbyaffcode($post['affcode']);
				$currentvid = $this->fetchcurrentregidbymail($post['u_email']);
				$data = array('affiliate_id' => $vaffcodeid['vendor_id'],
				              'affiliated_id' => $currentvid['id'],
							 );
				$this->db->insert('affiliate_code_map', $data);	
			}
			return $token;
		}
		
    }

    public function countVendorsWithEmail($email)
    {
        $this->db->where('email', $email);
        return $this->db->count_all_results('vendors');
    }

    public function checkVendorExsists($post)
    {
		//var_dump($post);die;
        $this->db->where('email', $post['u_email']);
		//$this->db->where('status', 1);
		//$this->db->where('email_verify', 1);
        $query = $this->db->get('vendors');
		$row = $query->row_array();
		if($row['email_verify'] == 0)
		{
			$this->session->set_flashdata('login_error', "Access Denied : Please verify your email first");
			return false;
		}
		if($row['status'] == 0)
		{
			$this->session->set_flashdata('login_error', "Access Denied : Your account is not activated from Admin, It might take some time in verifying details. You will get an account activation email once details are verified then you can log into your account.");
			return false;
		}	
        if (empty($row) || !password_verify($post['u_password'], $row['password'])) {
			$this->session->set_flashdata('login_error', lang('login_vendor_error'));
            return false;
        }
        return $row['id'];
    }
	public function getVendorByEmail($email)
    {
		$this->db->select('*');
        $this->db->where('email',$email);
        $query = $this->db->get('vendors');
        $row = $query->row_array();
        return $row;
    }
	public function fetchidbyaffcode($aff_code)
	{
		$this->db->select('vendor_id');
        $this->db->where('aff_code',$aff_code);
        $query = $this->db->get('affiliate_code');
        $row = $query->row_array();
        return $row;
	}
	public function fetchcurrentregidbymail($email)
	{
		$this->db->select('id');
        $this->db->where('email',$email);
        $query = $this->db->get('vendors');
        $row = $query->row_array();
        return $row;
	}
}
