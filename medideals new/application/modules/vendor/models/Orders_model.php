<?php

class Orders_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function ordersCount($vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
        return $this->db->count_all_results('vendors_orders');
    }

    public function orders($limit, $page, $vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
        $this->db->order_by('id', 'DESC');
        $this->db->select('vendors_orders.*, vendors_orders_clients.first_name,'
                . ' vendors_orders_clients.last_name, vendors_orders_clients.email, vendors_orders_clients.phone, '
                . 'vendors_orders_clients.address, vendors_orders_clients.city, vendors_orders_clients.post_code,'
                . ' vendors_orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('vendors_orders_clients', 'vendors_orders_clients.for_id = vendors_orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = vendors_orders.discount_code', 'left');
        $result = $this->db->get('vendors_orders', $limit, $page);
        return $result->result_array();
    }
	
	public function ordersdispatched($limit, $page, $vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
		$this->db->where('vendors_orders.orders_status', 2);
        $this->db->order_by('id', 'DESC');
        $this->db->select('vendors_orders.*, vendors_orders_clients.first_name,'
                . ' vendors_orders_clients.last_name, vendors_orders_clients.email, vendors_orders_clients.phone, '
                . 'vendors_orders_clients.address, vendors_orders_clients.city, vendors_orders_clients.post_code,'
                . ' vendors_orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('vendors_orders_clients', 'vendors_orders_clients.for_id = vendors_orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = vendors_orders.discount_code', 'left');
        $result = $this->db->get('vendors_orders', $limit, $page);
        return $result->result_array();
    }
	
	public function ordersdelivered($limit, $page, $vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
		$this->db->where('vendors_orders.orders_status', 3);
        $this->db->order_by('id', 'DESC');
        $this->db->select('vendors_orders.*, vendors_orders_clients.first_name,'
                . ' vendors_orders_clients.last_name, vendors_orders_clients.email, vendors_orders_clients.phone, '
                . 'vendors_orders_clients.address, vendors_orders_clients.city, vendors_orders_clients.post_code,'
                . ' vendors_orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('vendors_orders_clients', 'vendors_orders_clients.for_id = vendors_orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = vendors_orders.discount_code', 'left');
        $result = $this->db->get('vendors_orders', $limit, $page);
        return $result->result_array();
    }
	
	public function ordersreturn($limit, $page, $vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
		$this->db->where('vendors_orders.orders_status', 4);
        $this->db->order_by('id', 'DESC');
        $this->db->select('vendors_orders.*, vendors_orders_clients.first_name,'
                . ' vendors_orders_clients.last_name, vendors_orders_clients.email, vendors_orders_clients.phone, '
                . 'vendors_orders_clients.address, vendors_orders_clients.city, vendors_orders_clients.post_code,'
                . ' vendors_orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('vendors_orders_clients', 'vendors_orders_clients.for_id = vendors_orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = vendors_orders.discount_code', 'left');
        $result = $this->db->get('vendors_orders', $limit, $page);
        return $result->result_array();
    }
	
	public function View_docket($id)
    {
        $this->db->where('order_id', $id);
		 //$this->db->where('month(vendors_orders.date)', date('m'));
        //$this->db->order_by('id', 'DESC');
        $this->db->select('vendors_orders.*, vendors_orders_clients.first_name,'
                . ' vendors_orders_clients.last_name, vendors_orders_clients.email, vendors_orders_clients.phone, '
                . 'vendors_orders_clients.address, vendors_orders_clients.city, vendors_orders_clients.post_code,'
                . ' vendors_orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('vendors_orders_clients', 'vendors_orders_clients.for_id = vendors_orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = vendors_orders.discount_code', 'left');
        $result = $this->db->get('vendors_orders');
        //return $result->num_rows();
		return $result->result_array();
    }
	
	public function get_Vendorid($email)
    {
     $q = $this -> db
       -> select('id')
       -> where('email', $email)
       -> limit(1)
       -> get('vendors');
	     return $q->result_array();
    }
	
	
		
	public function get_Vendor_Product_qty($vendor_id)
    {
      $q = $this -> db
       -> select('*')
       -> where('vendor_id', $vendor_id)
        -> get('products');
	     return $q->result_array();
		 //echo $this->db->last_query();
    }
	
	
	public function month_orders($vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
		$this->db->where('month(vendors_orders.date)', date('m'));
        //$this->db->order_by('id', 'DESC');
        $this->db->select('vendors_orders.*, vendors_orders_clients.first_name,'
                . ' vendors_orders_clients.last_name, vendors_orders_clients.email, vendors_orders_clients.phone, '
                . 'vendors_orders_clients.address, vendors_orders_clients.city, vendors_orders_clients.post_code,'
                . ' vendors_orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('vendors_orders_clients', 'vendors_orders_clients.for_id = vendors_orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = vendors_orders.discount_code', 'left');
        $result = $this->db->get('vendors_orders');
        return $result->num_rows();
		//$query->num_rows();
    }
		
	public function todayorders($vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
		$this->db->where("date >= DATE_SUB(NOW(),INTERVAL 1 DAY)", NULL, FALSE);
        $this->db->order_by('id', 'DESC');
        $this->db->select('vendors_orders.*, vendors_orders_clients.first_name,'
                . ' vendors_orders_clients.last_name, vendors_orders_clients.email, vendors_orders_clients.phone, '
                . 'vendors_orders_clients.address, vendors_orders_clients.city, vendors_orders_clients.post_code,'
                . ' vendors_orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('vendors_orders_clients', 'vendors_orders_clients.for_id = vendors_orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = vendors_orders.discount_code', 'left');
        $result = $this->db->get('vendors_orders');
        return $result->result_array();
    }
	
	public function weekorders($vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
		$this->db->where("date >= DATE_SUB(NOW(),INTERVAL 1 WEEK)", NULL, FALSE);
        $this->db->order_by('id', 'DESC');
		
        $query = $this->db->get('vendors_orders');
        if($query->num_rows())
        {
            return $query->num_rows();
        }else{
            return 0;
        }
        //$result = $this->db->get('vendors_orders');
		
        //return $query->num_rows();
    }
	
	//SELECT * FROM jokes WHERE date > DATE_SUB(NOW(), INTERVAL 1 DAY) ORDER BY score DESC;
	public function custimerordersCount($email)
    {
        $this->db->where('email', $email);
        return $this->db->count_all_results('orders_clients');
    }	 
    public function customerorders($limit, $page)
    {
        $this->db->select('orders.*, orders_clients.first_name,'
                . ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
                . 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
                . ' orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = orders.discount_code', 'left');
		$this->db->where('orders_clients.email', $_SESSION['logged_vendor']);
        $result = $this->db->get('orders', $limit, $page);
		return $result->result_array();
    }
	public function custimerordersreceiveCount($email)
    {
        
		$this->db->join('orders', 'orders_clients.for_id = orders.id', 'inner');
		$this->db->join('vendors_orders', 'vendors_orders.order_id = orders.order_id', 'inner');
		$this->db->where('vendors_orders.orders_status',"3");
		$this->db->where('orders_clients.email', $email);
        return $this->db->count_all_results('orders_clients');
    }	 
    public function customerordersreceive($limit, $page)
    {
        $this->db->select('orders.*, orders_clients.first_name,'
                . ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
                . 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
                . ' orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = orders.discount_code', 'left');
		$this->db->join('vendors_orders', 'vendors_orders.order_id = orders.order_id', 'inner');
		$this->db->where('vendors_orders.orders_status',"3");
		$this->db->where('orders_clients.email', $_SESSION['logged_vendor']);
        $result = $this->db->get('orders', $limit, $page);
		return $result->result_array();
    }
	public function custimerordersreturnCount($email)
    {
        
		$this->db->join('orders', 'orders_clients.for_id = orders.id', 'inner');
		$this->db->join('vendors_orders', 'vendors_orders.order_id = orders.order_id', 'inner');
		$this->db->where('vendors_orders.orders_status',"4");
		$this->db->where('orders_clients.email', $email);
        return $this->db->count_all_results('orders_clients');
    }	 
    public function customerordersreturn($limit, $page)
    {
        $this->db->select('orders.*, orders_clients.first_name,'
                . ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
                . 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
                . ' orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = orders.discount_code', 'left');
		$this->db->join('vendors_orders', 'vendors_orders.order_id = orders.order_id', 'inner');
		$this->db->where('vendors_orders.orders_status',"4");
		$this->db->where('orders_clients.email', $_SESSION['logged_vendor']);
        $result = $this->db->get('orders', $limit, $page);
		return $result->result_array();
    }
    public function changeOrderStatus($id, $to_status)
    {
        $this->db->where('id', $id);
        $this->db->select('processed');
        $result1 = $this->db->get('vendors_orders');
        $res = $result1->row_array();

        if ($res['processed'] != $to_status) {
            $this->db->where('id', $id);
            $result = $this->db->update('vendors_orders', array('processed' => $to_status, 'viewed' => '1'));
            return $result;
        }
    }

    public function changemoneyOrderStatus($id, $to_status)
    {
	
		$data = array( 
			'money_status'=> $to_status 	   
		);

		$this->db->where('id', $id);

		if($this->db->update('vendors_orders', $data))
		{
			redirect(LANG_URL . '/vendor/orders');
		}
		else
		{
			log_message('error', print_r($this->db->error(), true));
			show_error(lang('database_error'));
		}
    }
	
	public function product_info($key = 0)
	{
		$this->db->where('for_id', $key);
        $this->db->select('title,price,for_id');
        $result1 = $this->db->get('products_translations');
        $res = $result1->row_array();
		return $res;
	}
	
	public function fetchvendoridfororders($order_id = null, $product_id = null)
	{
		$this->db->where('order_id', $order_id);
		$this->db->where('products', $product_id);
        $this->db->select('vendor_id');
        $result1 = $this->db->get('vendors_orders');
        $res = $result1->row_array();
		
		$status = $this->orderprocessstatus($order_id, $product_id, $res['vendor_id']);
		//var_dump($status); die;
		return $status;
	}
	
	public function orderprocessstatus($order_id, $product_id, $vendor_id)
	{
		$this->db->where('order_id', $order_id);
		$this->db->where('products', $product_id);
		$this->db->where('vendor_id', $vendor_id);
        $this->db->select('orders_status,docket_number');
		//$this->db->select('*');
        $result1 = $this->db->get('vendors_orders');
        $res = $result1->row_array();
		return $res;
	}
	
	public function updatedocketno($vendor_id, $order_id, $product_id, $dktno)
	{
		$this->db->where('vendor_id', $vendor_id);
		$this->db->where('order_id', $order_id);
		$this->db->where('products', $product_id);
        $this->db->update('vendors_orders', array('docket_number' => $dktno));
	}
	
	public function updateodrstatus($vendor_id, $order_id, $product_id, $odrstatus)
	{
		$this->db->where('vendor_id', $vendor_id);
		$this->db->where('order_id', $order_id);
		$this->db->where('products', $product_id);
        $this->db->update('vendors_orders', array('orders_status' => $odrstatus));
	}
	public function customeremaildocket($vid = null, $oid = null, $pid = null) 
	{
		$this->db->where('vendors_orders.order_id', $oid);
		$this->db->where('vendors_orders.products', $pid);
		$this->db->where('vendors_orders.vendor_id', $vid);
        $this->db->select('vendors_orders.order_id, vendors_orders.order_quantity, vendors_orders.individual_price, vendors_orders.docket_number, vendors_orders_clients.email as client_email, products_translations.title, vendors.email as wholesaler_email');
		$this->db->join('vendors_orders_clients', 'vendors_orders.id = vendors_orders_clients.for_id', 'inner');
		$this->db->join('products_translations', 'vendors_orders.products = products_translations.for_id', 'inner');
		$this->db->join('vendors', 'vendors_orders.vendor_id = vendors.id', 'inner');
        $result1 = $this->db->get('vendors_orders');
        $res = $result1->row_array();
		return $res;
		
	}
	public function customeremailorder($vid = null, $oid = null, $pid = null) 
	{
		$this->db->where('vendors_orders.order_id', $oid);
		$this->db->where('vendors_orders.products', $pid);
		$this->db->where('vendors_orders.vendor_id', $vid);
        $this->db->select('vendors_orders.order_id, vendors_orders.order_quantity, vendors_orders.individual_price, vendors_orders.orders_status, vendors_orders_clients.email as client_email, products_translations.title, vendors.email as wholesaler_email');
		$this->db->join('vendors_orders_clients', 'vendors_orders.id = vendors_orders_clients.for_id', 'inner');
		$this->db->join('products_translations', 'vendors_orders.products = products_translations.for_id', 'inner');
		$this->db->join('vendors', 'vendors_orders.vendor_id = vendors.id', 'inner');
        $result1 = $this->db->get('vendors_orders');
        $res = $result1->row_array();
		return $res;
		
	}
	
}
