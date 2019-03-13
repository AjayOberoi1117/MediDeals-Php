<?php

class Admin_affiliate_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
	public function show_all_affiliated($id)
	{ 
		$this->db->where('affiliate_code_map.affiliate_id', "$id"); 
		$this->db->join('vendors', 'affiliate_code_map.affiliated_id = vendors.id', 'inner');
		$this->db->select('vendors.firm_name, vendors.email, affiliate_code_map.date');
		$result = $this->db->get('affiliate_code_map');
        return $result->result_array();
	}
	public function show_all_affiliates()
	{	
		$this->db->join('affiliate_code', 'affiliate_code on vendors.id = affiliate_code.vendor_id', 'inner');
		$this->db->select('vendors.id, vendors.firm_name, vendors.email, affiliate_code.aff_code');
		$result = $this->db->get('vendors',@$page,@$limit);
        return $result->result_array();
	}
	public function edit_single_affiliate()
	{
		//edit in affiliate code map
	}
	public function delete_single_affiliate()
	{
		// delete from affiliate code
		
		// delete from affiliate code map
	}
}	