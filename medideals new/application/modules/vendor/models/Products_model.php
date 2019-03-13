<?php

class Products_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getOneProduct($id, $vendor_id)
    {
        $this->db->where('id', $id);
        $this->db->where('vendor_id', $vendor_id);
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }
	
	 public function getcustomerProduct($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function setProduct($post, $id = 0)
    {
        $this->db->trans_begin();
			
		//print_r($_POST['title']);
		//echo "<br><br>";
		//var_dump($_POST['title'][0]); die;
		
        $is_update = false;
        if ($id > 0) {
            $is_update = true;
            if (!$this->db->where('id', $id)->where('vendor_id', $post['vendor_id'])->update('products', array(
                        'image' => $post['image'] != null ? $_POST['image'] : $_POST['old_image'],
                        'shop_categorie' => $post['shop_categorie'],
                        'discount' => $post['discount'],
                        'quantity' => $post['quantity'],
                        'minquantity' => $post['minquantity'],
                        'brand' => $post['brand'],
                        'time_update' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
        } else {
            $i = 0;
            foreach ($_POST['translations'] as $translation) {
                if ($translation == MY_DEFAULT_LANGUAGE_ABBR) {
                    $myTranslationNum = $i;
                }
                $i++;
            }
            if (!$this->db->insert('products', array(
                        'image' => $post['image'],
                        'shop_categorie' => $post['shop_categorie'],
                        'discount' => $post['discount'],
                        'quantity' => $post['quantity'],
                        'minquantity' => $post['minquantity'],
                        'brand' => strtoupper($post['brand']),
                        'folder' => $post['folder'],
                        'vendor_id' => $post['vendor_id'],
                        'time' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $id = $this->db->insert_id();

            $this->db->where('id', $id);
			// for dynamic url
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($j = 0; $j < 5; $j++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}	
			
			$prod_url = str_replace(' ','_',$_POST['title'][0]);
			
			$prod_url = preg_replace('/[^A-Za-z0-9\-]/', '', $prod_url);
			
			$url = $prod_url.'_'.$randomString.rand(100000,999999).'_'.$id;
			
			// url
            if (!$this->db->update('products', array(
              //'url' => except_letters($_POST['title'][$myTranslationNum]) . '_' . $id
				  'url' => $url
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
        }
        $this->setProductTranslation($post, $id, $is_update);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
            return false;
        } else {
            $this->db->trans_commit();
            return $id;
        }
    }

    private function setProductTranslation($post, $id, $is_update = false)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id, 'product');
        foreach ($post['translations'] as $abbr) {
            $arr = array();
            $emergency_insert = false;
            if (!isset($current_trans[$abbr])) {
                $emergency_insert = true;
            }
            $post['title'][$i] = str_replace('"', "'", $post['title'][$i]);
            $post['price'][$i] = str_replace(' ', '', $post['price'][$i]);
            $post['price'][$i] = str_replace(',', '', $post['price'][$i]);
            $arr = array(
                'title' => $post['title'][$i],
                'description' => $post['description'][$i],
                'price' => $post['price'][$i],
                'old_price' => $post['old_price'][$i],
                'abbr' => $abbr,
                'for_id' => $id
            );
            if ($is_update === true && $emergency_insert === false) {
                $abbr = $arr['abbr'];
                unset($arr['for_id'], $arr['abbr'], $arr['url']);
                if (!$this->db->where('abbr', $abbr)->where('for_id', $id)->update('products_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            } else {
                if (!$this->db->insert('products_translations', $arr)) {
                    log_message('error', print_r($this->db->error(), true));
                }
            }
            $i++;
        }
    }

    public function getTranslations($id)
    {
        $this->db->where('for_id', $id);
        $query = $this->db->get('products_translations');
        $arr = array();
        foreach ($query->result() as $row) {
            $arr[$row->abbr]['title'] = $row->title;
            $arr[$row->abbr]['description'] = $row->description;
            $arr[$row->abbr]['price'] = $row->price;
            $arr[$row->abbr]['old_price'] = $row->old_price;
        }
        return $arr;
    }

    public function getProducts($limit, $page, $vendor_id)
    {
        $this->db->order_by('products.position', 'asc');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		
		//$this->db->join('vendors_orders', 'vendors_orders.vendor_id = products.vendor_id', 'left');
		
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->where('products.vendor_id', $vendor_id);
		
        $query = $this->db->select('products.*, products_translations.title, products_translations.description,products_translations.old_price,products_translations.price')->get('products', $limit, $page);
        return $query->result();
    }
    public function productsCount($vendor_id)
    {
        $this->db->where('vendor_id', $vendor_id);
        return $this->db->count_all_results('products');
    }
	
	public function moneyescrow($email)
    {
       $this->db->join('orders_clients', 'orders.id = orders_clients.for_id', 'inner');
		$this->db->where('orders_clients.email', $email);
		$query = $this->db->select('sum(orders.final_amount) as amount')->get('orders', $email);
        return $query->result();
    }
	public function lastorder($email)
    {
	
		$this->db->join('orders_clients', 'orders.id = orders_clients.for_id', 'inner');
		$this->db->where('orders_clients.email', $email);
		$this->db->order_by("orders.order_id", "desc");
		$this->db->limit(1,0);
		$query = $this->db->select('DISTINCT(orders.order_id)')->get('orders');
        return $query->result();
		
    }
	public function totalorderplaced($email)
    {

		$this->db->join('orders_clients', 'orders.id = orders_clients.for_id', 'inner');
		$this->db->where('orders_clients.email', $email);
		$query = $this->db->select('count(orders.order_id) as totalorders')->get('orders');
        return $query->result();
		
    }
	public function totalproductreceive($email)
	{
		$this->db->join('vendors_orders_clients', 'vendors_orders.id = vendors_orders_clients.for_id', 'inner');
		$this->db->where('vendors_orders_clients.email', $email);
		$this->db->where('vendors_orders.orders_status',"3");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('count(vendors_orders.order_id) as productsorder')->get('vendors_orders');
        return $query->result();
	}
	public function totalproductreturn($email)
	{
		$this->db->join('vendors_orders_clients', 'vendors_orders.id = vendors_orders_clients.for_id', 'inner');
		$this->db->where('vendors_orders_clients.email', $email);
		$this->db->where('vendors_orders.orders_status',"4");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('count(vendors_orders.order_id) as productsreturn')->get('vendors_orders');
        return $query->result();
	}
	
	public function activeproduct($vendor_id)
    {
        $this->db->where('quantity > ',0);
        $this->db->where('vendor_id', $vendor_id);
        return $this->db->count_all_results('products');
    }
	public function inactiveproduct($vendor_id)
    {
         $this->db->where('quantity = ',0);
         $this->db->where('vendor_id', $vendor_id);
        return $this->db->count_all_results('products');
    }

    public function deleteProduct($id)
    {
        $this->db->trans_begin();

        $this->db->where('id', $id);
        $this->db->where('vendor_id', $vendor_id);
        if (!$this->db->delete('products')) {
            log_message('error', print_r($this->db->error(), true));
        } else {
            $this->db->where('for_id', $id);
            if (!$this->db->delete('products_translations')) {
                log_message('error', print_r($this->db->error(), true));
            }
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }
	public function showstate()
	{
		$query = $this->db->get('states');
        return $query->result();
	}
	public function viewsubscribe($id)
	{
		$this->db->where('vendor_id',$id);
		$query = $this->db->get('vendors_subscribe');
        return $query->result();
	}
	
	
	public function getcity($id)
     {
	 //echo $id;

        $query = $this->db->select('cities.*')
                          ->where('state_id', $id)
         			      ->get('cities');
        $result=$query->result();
		foreach($result as $res)
		{
			echo '<option value="'.$res->name.'">'.$res->name.'</option>';
		}
     }
	 public function setLocation()
	 {
	
		foreach($_POST['state'] as $state)
		{
			
			foreach($_POST['city'] as $city)
			{
			if (!$this->db->insert('vendor_business_location', array(
                        'vendor_id' => $_POST['vendor_id'],
                        'product_id' => $_POST['id'],
                        'state_name' => $state,
                        'city_name' => $city)))
			{
                log_message('error', print_r($this->db->error(), true));
            }
			}
		}
	}
	/* public function select()
	{
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get('products');
		return $query;
	} */
	// insert CSV data
	public function insertcsv($data, $numrows)
	{
		for($i = 0; $i <= $numrows; $i++)
		{	
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($j = 0; $j < 5; $j++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}	
			
			$prod_url = str_replace(' ','_',$data[$i]['title']);
			
			$prod_url = preg_replace('/[^A-Za-z0-9\-]/', '', $prod_url);
			
			$url = $prod_url.$randomString.rand(100000,999999);
			// insert in products table
			$this->db->insert('products', array(
						'image' => 'none.jpg',
                        'shop_categorie' => $data[$i]['shop_categorie'],
                        'discount' => $data[$i]['discount'],
                        'quantity' => $data[$i]['quantity'],
                        'minquantity' => $data[$i]['minquantity'],
                        'brand' => $data[$i]['brand'],
					    'visibility' => 1,						
                        'vendor_id' => $_SESSION['vendor_id'],
						'procurement' => 0,
						'in_slider' => 0,
						'url' => $url,
						'position' => 0,
						'folder'=> '1532673710',
                        'time' => time()
                    ));
						
			// fetch id from products table
			$query = $this->db->select('id')
                          ->where('url', $url)
         			      ->get('products');
			$result=$query->result_array();
			
			// update url adding id 
			$newurl = $url.'_'.$result[0]['id'];
			
			$this->db->where('id', $result[0]['id']);
			$this->db->update('products', array('url' => $newurl));
			
			
			// insert data in products_translations table
			$this->db->insert('products_translations', array(
				'title' => $data[$i]['title'],
                'description' => $data[$i]['description'],
                'basic_description' => "",
				'price' => number_format((float)$data[$i]['discount_price'], 2, '.', ''),
                'old_price' => number_format((float)$data[$i]['mrp'], 2, '.', ''),
                'abbr' =>  'en',
				'for_id' => $result[0]['id']
                ));
			
		}
	}
	// insert excel data
	public function insertexceldata($data, $numrows)
	{
		for($i = 0; $i < $numrows; $i++)
		{	
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($j = 0; $j < 5; $j++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}	
			
			$prod_url = str_replace(' ','_',$data[$i]['title']);
			
			$prod_url = preg_replace('/[^A-Za-z0-9\-]/', '', $prod_url);
			
			$url = $prod_url.$randomString.rand(100000,999999);
			
			//$this->db->trans_begin();
			// insert in products table
			$this->db->insert('products', array(
						'image' => 'none.jpg',
                        'shop_categorie' => $data[$i]['shop_categorie'],
                        'discount' => $data[$i]['discount'],
                        'quantity' => $data[$i]['quantity'],
                        'minquantity' => $data[$i]['minquantity'],
                        'brand' => $data[$i]['brand'],
					    'visibility' => 1,						
                        'vendor_id' => $_SESSION['vendor_id'],
						'procurement' => 0,
						'in_slider' => 0,
						'url' => $url,
						'position' => 0,
						'folder'=> '1532673710',
                        'time' => time()
                    ));
						
			// fetch id from products table
			$query = $this->db->select('id')
                          ->where('url', $url)
         			      ->get('products');
			$result=$query->result_array();
			
			// update url adding id 
			$newurl = $url.'_'.$result[0]['id'];
			
			$this->db->where('id', $result[0]['id']);
			$this->db->update('products', array('url' => $newurl));

			// insert data in products_translations table
			$this->db->insert('products_translations', array(
				'title' => $data[$i]['title'],
                'description' => $data[$i]['description'],
                'basic_description' => "",
				'price' => number_format((float)$data[$i]['discount_price'], 2, '.', ''),
                'old_price' => number_format((float)$data[$i]['mrp'], 2, '.', ''),
                'abbr' =>  'en',
				'for_id' => $result[0]['id']
                ));
				
			// insert location
			$locationarray = str_replace(" ","",$data[$i]['location']); 
			$locationarray = explode(",",$locationarray);
			for($i1 = 0; $i1 < count($locationarray); $i1++)
			{
				$this->db->insert('vendor_business_location', array(
				'vendor_id' => $_SESSION['vendor_id'],
				'product_id' => $result[0]['id'],
				'state_name' => 42,
				'city_name' => $locationarray[$i1]
				));
			}
			/*if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
            return false;
			} else {
            $this->db->trans_commit();
            return true;
			}*/
		}
	}
	
	public function getVendorById()
    {
		//var_dump($_SESSION);
		$this->db->select('*');
        $this->db->where('id',@$_SESSION['vendor_id']);
        $query = $this->db->get('vendors');
        $row = $query->row_array();
        return $row;
    }
	public function getVendorByIds()
    {
		//var_dump($_SESSION);
		$this->db->select('*');
        $this->db->where('id',$_SESSION['vendor_id']);
        $query = $this->db->get('vendors');
        $row = $query->row_array();
        return $row;
    }
	public function show_responses1($id)
	{
	
		$this->db->select('*');
        $this->db->from('vendor_response'); 
        $this->db->where('vendor_id',$id);		
        // $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get();
        return($query->result_array());
	}
	public function showbank_details($id)
	{
		
		$this->db->select('*');
        $this->db->from('bank_details'); 
        $this->db->where('vendor_id',$id);		
        // $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get();
        return($query->result_array());
	}
	public function viewbankdetails()
	{
			
		$this->db->select('*');
        $this->db->from('bank_details'); 
        $this->db->where('vendor_id',$_SESSION['vendor_id']);		
        // $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get();
        return($query->result_array());
	}		
	public function productajaxresult($val)
	{
		$this->db->select('id,name');
        $this->db->from('product_list'); 
        $this->db->like('name',$val,'after');
        $query = $this-> db-> get();
		return $query->result();
	}
	public function fetchproductajaxresult($val)
	{
		$this->db->select('description,company,old_price');
        $this->db->from('product_list'); 
        $this->db->where('id',$val);
        $query = $this-> db-> get();
		return $query->result();
	}
	public function subs_date($id)
	{
		$this->db->where('vendors.id', $id);
        $this->db->select('created_at');
        $result1 = $this->db->get('vendors');
        $res = $result1->row_array();
		return $res;
	}
	public function totalorderreceived($email)
	{	
		$this->db->join('vendors_orders_clients', 'vendors_orders.id = vendors_orders_clients.for_id', 'inner');
		$this->db->where('vendors_orders_clients.email', $email);
		$this->db->where('vendors_orders.orders_status',"3");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('vendors_orders.order_id')->get('vendors_orders');
        return $query->num_rows();
	}
	public function totalorderreturned($email)
	{	
		$this->db->join('vendors_orders_clients', 'vendors_orders.id = vendors_orders_clients.for_id', 'inner');
		$this->db->where('vendors_orders_clients.email', $email);
		$this->db->where('vendors_orders.orders_status',"4");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('vendors_orders.order_id')->get('vendors_orders');
        return $query->num_rows();
	}
	public function productsold($vendor_id)
    {
		$this->db->where('vendors_orders.vendor_id', $vendor_id);
		$this->db->where('vendors_orders.orders_status',"3");
		$this->db->where('vendors_orders.money_status',"2");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('count(vendors_orders.order_id) as productssold')->get('vendors_orders');
        return $query->result();
    }
	public function productreturn($vendor_id)
    {
        $this->db->where('vendors_orders.vendor_id', $vendor_id);
		$this->db->where('vendors_orders.orders_status',"4");
		$this->db->where('vendors_orders.money_status',"3");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('count(vendors_orders.order_id) as productsreturn')->get('vendors_orders');
        return $query->result();
    }
	public function ordersdelivered($vendor_id)
    {
        $this->db->where('vendors_orders.vendor_id', $vendor_id);
		$this->db->where('vendors_orders.orders_status',"3");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('count(vendors_orders.order_id) as orderdeliver')->get('vendors_orders');
        return $query->num_rows();
    }
	public function ordersreceived($vendor_id)
    {
        $this->db->where('vendors_orders.vendor_id', $vendor_id);
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('count(vendors_orders.order_id) as orderreceived')->get('vendors_orders');
        return $query->num_rows();
    }
	public function orderdispatched($vendor_id)
    {
        $this->db->where('vendors_orders.vendor_id', $vendor_id);
		$this->db->where('vendors_orders.orders_status',"2");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('count(vendors_orders.order_id) as orderdispatch')->get('vendors_orders');
        return $query->num_rows();
    }
	public function orderreturns($vendor_id)
    {
        $this->db->where('vendors_orders.vendor_id', $vendor_id);
		$this->db->where('vendors_orders.orders_status',"4");
		$this->db->group_by('vendors_orders.order_id');
		$query = $this->db->select('count(vendors_orders.order_id) as orderdispatch')->get('vendors_orders');
        return $query->num_rows();
    }
	public function totalrevenue($vendor_id)
    {
        $this->db->where('vendors_orders.vendor_id', $vendor_id);
		$this->db->where('vendors_orders.money_status',"2");
		$query = $this->db->select('vendors_orders.order_quantity, vendors_orders.individual_price')->get('vendors_orders');
        return $query->result();
    }
	public function whsmoneyescrow ($vendor_id)
    {
        $this->db->where('vendors_orders.vendor_id', $vendor_id);
		$this->db->where('vendors_orders.money_status',"1");
		$query = $this->db->select('vendors_orders.order_quantity, vendors_orders.individual_price')->get('vendors_orders');
        return $query->result();
    }
	// active products
	public function getactiveproducts($vendor_id)
    {
        $this->db->order_by('products.position', 'asc');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		
		//$this->db->join('vendors_orders', 'vendors_orders.vendor_id = products.vendor_id', 'left');
		
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->where('products.vendor_id', $vendor_id);
		$this->db->where('products.quantity > ',0);
        $query = $this->db->select('products.*, products_translations.title, products_translations.description, products_translations.old_price')->get('products');
        return $query->result();
    }
	// inactive products
	public function getinactiveproducts($vendor_id)
    {
        $this->db->order_by('products.position', 'asc');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		
		//$this->db->join('vendors_orders', 'vendors_orders.vendor_id = products.vendor_id', 'left');
		
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->where('products.vendor_id', $vendor_id);
		$this->db->where('products.quantity',0);
        $query = $this->db->select('products.*, products_translations.title, products_translations.description, products_translations.old_price')->get('products');
        return $query->result();
    }
	// search products
	public function getsearchproductforvendor($vendor_id)
    {
		if(isset($_POST['pname'])){
		  $pname = $_POST['pname']; }
		else{
		  redirect("vendor/products");
		}
        $this->db->order_by('products.position', 'asc');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
		
		//$this->db->join('vendors_orders', 'vendors_orders.vendor_id = products.vendor_id', 'left');
		
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $this->db->where('products.vendor_id', $vendor_id);
		$this->db->like('products_translations.title', $pname,'after');
        $query = $this->db->select('products.*, products_translations.title, products_translations.description, products_translations.old_price')->get('products');
        return $query->result();
    }
}
