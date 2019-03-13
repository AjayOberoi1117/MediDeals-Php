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
	$username=array($post['firm_address1']);
	$str1=implode($username);

	$uname=$str1[0].$str1[1].rand(10000,99999);
	//exit;
        $input = array(
            'email' => trim($post['u_email']),		
			'firm_name' => trim($post['firm_name']),
			'name' => trim($uname),
			'firm_address' => trim($post['firm_address1'].'#@%'.$post['firm_address2'].'#@%'.$post['firm_address3'].'#@%'),
			'drug_licence' => trim($post['d_number']),
			'fssai_no' => trim($post['f_number']),
			'contact_no' => trim($post['con_number']),
			'gst_number' => trim($post['gst_number']),
			'user_type' => trim($post['user_type']),
            'password' => password_hash($post['u_password'], PASSWORD_DEFAULT)
        );
        if (!$this->db->insert('vendors', $input)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function countVendorsWithEmail($email)
    {
        $this->db->where('email', $email);
        return $this->db->count_all_results('vendors');
    }

    public function checkVendorExsists($post)
    {
        $this->db->where('email', $post['u_email']);
		$this->db->where('status', 1);
        $query = $this->db->get('vendors');
        $row = $query->row_array();
        if (empty($row) || !password_verify($post['u_password'], $row['password'])) {
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
	
	
}
