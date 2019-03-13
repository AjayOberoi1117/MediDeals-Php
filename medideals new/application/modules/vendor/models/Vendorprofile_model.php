<?php

class Vendorprofile_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getVendorInfoFromEmail($email)
    {
        $this->db->where('email', $email);
        $result = $this->db->get('vendors');
        return $result->row_array();
    }

    public function getVendorByUrlAddress($urlAddr)
    {
        $this->db->where('url', $urlAddr);
        $result = $this->db->get('vendors');
        return $result->row_array();
    }

    public function saveNewVendorDetails($post, $vendor_id)
    {
        if (!$this->db->where('id', $vendor_id)->update('vendors', array(
                    'name' => $post['vendor_name'],
                    'url' => $post['vendor_url']
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function isVendorUrlFree($vendorUrl)
    {
        $this->db->where('url', $vendorUrl);
        $num = $this->db->count_all_results('vendors');
        if ($num > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getOrdersByMonth($vendor_id)
    {
        $result = $this->db->query("SELECT YEAR(FROM_UNIXTIME(date)) as year, MONTH(FROM_UNIXTIME(date)) as month, COUNT(id) as num FROM vendors_orders WHERE vendor_id = $vendor_id GROUP BY YEAR(FROM_UNIXTIME(date)), MONTH(FROM_UNIXTIME(date)) ASC");
        $result = $result->result_array();
        $orders = array();
        $years = array();
        foreach ($result as $res) {
            if (!isset($orders[$res['year']])) {
                for ($i = 1; $i <= 12; $i++) {
                    $orders[$res['year']][$i] = 0;
                }
            }
            $years[] = $res['year'];
            $orders[$res['year']][$res['month']] = $res['num'];
        }
        return array(
            'years' => array_unique($years),
            'orders' => $orders
        );
    }
	public  function subs_status($id)
	{
		$this->db->select('status');
        $this->db->where('vendor_id',$id);
        $query = $this->db->get('vendors_subscribe');
        $row = $query->row_array();
        return $row;
	}
	public function get_affiliate_code($id = null)
	{
		if($id !== null)
		{
			$this->db->select('aff_code');
			$this->db->where('vendor_id',$id);
			$query = $this->db->get('affiliate_code');
			$row = $query->row_array();
			return $row;
		}
	}
	public function findidbyaffcode($aff_code)
	{
		$this->db->select('vendor_id');
        $this->db->where('aff_code',$aff_code);
        $query = $this->db->get('affiliate_code');
        $row = $query->row_array();
        return $row;
	}
	public function addaffiliaterecord($affiliate_id, $affiliated_id)
	{
		$data = array('affiliate_id' => $affiliate_id, 'affiliated_id' => $affiliated_id);
		$this->db->insert('affiliate_code_map', $data);
	}
	public function find_affiliator($id)
	{
		$this->db->select('affiliated_id');
        $this->db->where('affiliated_id',$id);
        $query = $this->db->get('affiliate_code_map');
        $row = $query->row_array();
        return $row;
	}
	public function affiliatecount()
	{
		return $this->db->count_all_results('affiliate_code_map');
	}
	public function my_affiliates($id ,$page,$limit)
	{		
		$this->db->where('affiliate_code_map.affiliate_id',"$id");
		$this->db->join('vendors', 'affiliate_code_map.affiliated_id = vendors.id', 'inner');
		$this->db->select('vendors.firm_name, vendors.email, affiliate_code_map.date');
		$result = $this->db->get('affiliate_code_map',$page,$limit);
        return $result->result_array();
	}
	public function generate_affiliate_code($id = null)
	{
			$this->db->select('aff_code');
			$this->db->where('vendor_id',$id);
			$query = $this->db->get('affiliate_code');
			$row = $query->row_array();
			if($row == NULL)
			{
				// fetch unique name
				$this->db->select('name');
				$this->db->where('id',$id);
				$query = $this->db->get('vendors');
				$row1 = $query->row_array();
				
				// affiliate code
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$charactersLength = strlen($characters);
				$randomString = '';
				for ($j = 0; $j < 10; $j++) {
					$randomString .= $characters[rand(0, $charactersLength - 1)];
				}
				$token = rand(10,99).$randomString.rand(100000,999999);
				
				$aff_code = $row1['name'].$token;
				
				// insert affiliate code
				$data = array('vendor_id'=>$id, 'aff_code'=>$aff_code);
				$this->db->insert('affiliate_code',$data);	
				
			}
	}
	
}
