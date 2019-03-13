<?php

class Orders_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function ordersCount($onlyNew = false)
    {
        if ($onlyNew == true) {
            //$this->db->where('viewed', 0);
        }
        return $this->db->count_all_results('orders');
    }

    public function orders($limit, $page, $order_by)
    {
        if ($order_by != null) {
            $this->db->order_by($order_by, 'DESC');
        } else {
            $this->db->order_by('id', 'DESC');
        }
        $this->db->select('orders.*, orders_clients.first_name,'
                . ' orders_clients.last_name, orders_clients.email, orders_clients.phone, '
                . 'orders_clients.address, orders_clients.city, orders_clients.post_code,'
                . ' orders_clients.notes, discount_codes.type as discount_type, discount_codes.amount as discount_amount');
        $this->db->join('orders_clients', 'orders_clients.for_id = orders.id', 'inner');
        $this->db->join('discount_codes', 'discount_codes.code = orders.discount_code', 'left');
        $result = $this->db->get('orders', $limit, $page);
        return $result->result_array();
    }
	
	public function vendororder($orderid)
	{
		$this->db->where('order_id', $orderid);
        $this->db->select('vendors_orders.*,products_translations.title,products.url,vendors.name,  vendors.email, vendors.contact_no,vendors.firm_name,vendors.firm_address');
		$this->db->join('products_translations', 'vendors_orders.products = products_translations.for_id', 'inner');
		$this->db->join('products', 'products.id = products_translations.for_id',  'inner');
		$this->db->join('vendors', 'vendors_orders.vendor_id = vendors.id',  'inner');
        $result1 = $this->db->get('vendors_orders');
        return $result1->result_array();
		
	}
	
	public function wholesellerdetails($orderid)
	{
		
	}
	
	public function productinfo($productid)
	{
		$this->db->where('for_id', $productid);
        $this->db->select('title,for_id');
        $result1 = $this->db->get('products_translations');
        return $result1->result_array();
	}
	
    public function changeOrderStatus($id, $to_status)
    {
        $this->db->where('id', $id);
        $this->db->select('processed');
        $result1 = $this->db->get('orders');
        $res = $result1->row_array();

        if ($res['processed'] != $to_status) {
            $this->db->where('id', $id);
            $result = $this->db->update('orders', array('processed' => $to_status, 'viewed' => '1'));
            if ($result == true) {
                $this->manageQuantitiesAndProcurement($id, $to_status, $res['processed']);
            }
        } else {
            $result = false;
        }
        return $result;
    }
	
	
	public function changemoneyOrderStatus($id, $to_status)
    {
		
		// for Customer
		$data = array('money_status'=> $to_status);
		$this->db->where('order_id', $id);
		if($this->db->update('orders', $data))
		{
			// for wholeseller
			$data1 = array('money_status'=> $to_status);
			$this->db->where('order_id', $id);
			if($this->db->update('vendors_orders', $data1))
			{
				return true;
			}
			else
			{
				log_message('error', print_r($this->db->error(), true));
				show_error(lang('database_error'));
			}
		}
		else
		{
			log_message('error', print_r($this->db->error(), true));
			show_error(lang('database_error'));
		}
    }
	
	

    private function manageQuantitiesAndProcurement($id, $to_status, $current)
    {
        if (($to_status == 0 || $to_status == 2) && $current == 1) {
            $operator = '+';
            $operator_pro = '-';
        }
        if ($to_status == 1) {
            $operator = '-';
            $operator_pro = '+';
        }
        $this->db->select('products');
        $this->db->where('id', $id);
        $result = $this->db->get('orders');
        $arr = $result->row_array();
        $products = unserialize($arr['products']);
        foreach ($products as $product_id => $quantity) {
            if (isset($operator)) {
                if (!$this->db->query('UPDATE products SET quantity=quantity' . $operator . $quantity . ' WHERE id = ' . $product_id)) {
                    log_message('error', print_r($this->db->error(), true));
                    show_error(lang('database_error'));
                }
            }
            if (isset($operator_pro)) {
                if (!$this->db->query('UPDATE products SET procurement=procurement' . $operator_pro . $quantity . ' WHERE id = ' . $product_id)) {
                    log_message('error', print_r($this->db->error(), true));
                    show_error(lang('database_error'));
                }
            }
        }
    }

    public function setBankAccountSettings($post)
    {
        $query = $this->db->query('SELECT id FROM bank_accounts');
        if ($query->num_rows() == 0) {
            $id = 1;
        } else {
            $result = $query->row_array();
            $id = $result['id'];
        }
        $post['id'] = $id;
        if (!$this->db->replace('bank_accounts', $post)) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getBankAccountSettings()
    {
        $result = $this->db->query("SELECT * FROM bank_accounts LIMIT 1");
        return $result->row_array();
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
	
	public function updatewholesellermoney($vendor_id, $order_id, $product_id, $whmonstatus)
	{
		$this->db->where('vendor_id', $vendor_id);
		$this->db->where('order_id', $order_id);
		$this->db->where('products', $product_id);
        $this->db->update('vendors_orders', array('money_status' => $whmonstatus));
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
	public function wholesaleremailmoney($vid = null, $oid = null, $pid = null) 
	{
		$this->db->where('vendors_orders.order_id', $oid);
		$this->db->where('vendors_orders.products', $pid);
		$this->db->where('vendors_orders.vendor_id', $vid);
        $this->db->select('vendors_orders.order_id, vendors_orders.order_quantity, vendors_orders.individual_price, vendors_orders.money_status, products_translations.title, vendors.email as wholesaler_email');
		$this->db->join('products_translations', 'vendors_orders.products = products_translations.for_id', 'inner');
		$this->db->join('vendors', 'vendors_orders.vendor_id = vendors.id', 'inner');
        $result1 = $this->db->get('vendors_orders');
        $res = $result1->row_array();
		return $res;	
	}
	public function changemoneyOrderStatusemail($odr_id)
	{
		$this->db->where('orders.order_id', $odr_id);
        $this->db->select('orders.order_id, orders.final_amount, ,orders.money_status, orders_clients.email as customer_email');
		$this->db->join('orders_clients', 'orders.id = orders_clients.for_id', 'inner');
        $result1 = $this->db->get('orders');
        $res = $result1->row_array();
		return $res;
	}
}
