<?php

class Home_admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function loginCheck($values)
    {
        $arr = array(
            'username' => $values['username'],
            'password' => md5($values['password']),
        );
        $this->db->where($arr);
        $result = $this->db->get('users');
        $resultArray = $result->row_array();
        if ($result->num_rows() > 0) {
            $this->db->where('id', $resultArray['id']);
            $this->db->update('users', array('last_login' => time()));
        }
        return $resultArray;
    }
	public function userrolemenus($userid)
	{
		$this->db->select('role_mapping.role_id, role_mapping.menu_id, role_menu.menu_name, role_menu.menu_url');
        $this->db->join('role_menu', 'role_mapping.menu_id = role_menu.menu_id', 'inner');
		$this->db->where('role_mapping.role_id',"$userid");
        $result = $this->db->get('role_mapping');
        return $result->result_array();
	}
    /*
     * Some statistics methods for home page of
     * administration
     * START
     */

    public function countLowQuantityProducts()
    {
        $this->db->where('quantity <=', 5);
        return $this->db->count_all_results('products');
    }
	public function wholeseller()
    {
        $this->db->where('user_type =','wholeseller');
        return $this->db->count_all_results('vendors');
    }
	public function retailer()
    {
        $this->db->where('user_type =','retailer');
        return $this->db->count_all_results('vendors');
    }
	public function listproducts()
    {
   
        return $this->db->count_all_results('products');
    }
	public function customerenquiries()
    {
   
        return $this->db->count_all_results('customer_enquiries');
    }
	
	public function users()
    {
   
        return $this->db->count_all_results('users');
    }
	public function finalamount()
    {
	    
		$this->db->select_sum('final_amount');
		$result = $this->db->get('orders')->row();  
		return $result->final_amount;
		
    }
	public function moneyescrow()
    {
         
        $this->db->select_sum('final_amount');
		$this->db->where('money_status',1);
		$result = $this->db->get('orders')->row();  
		return $result->final_amount;
       
    }
	public function activeproduct()
    {
         $this->db->where('quantity > ',0);
        return $this->db->count_all_results('products');
    }
	public function inactiveproduct()
    {
         $this->db->where('quantity = ',0);
		return $this->db->count_all_results('products');
    }
	public function productsold()
    {
       
        return $this->db->count_all_results('vendors_orders');
    }
	public function productreturn()
    {
         $this->db->where('orders_status',6);
		return $this->db->count_all_results('vendors_orders');
    }
	public function ordersCount()
    {
      
        return $this->db->count_all_results('vendors_orders');
    }
	public function orderdelivered()
    {
         $this->db->where('orders_status',4);
       
        return $this->db->count_all_results('vendors_orders');
    }
	public function vendorresponse()
    {
   
        return $this->db->count_all_results('vendor_response');
    }
	public function pcdcompanies()
    {
   
        return $this->db->count_all_results('pcdcompanies_entry');
    }
	public function thirdparty()
    {
   
        return $this->db->count_all_results('thirdparty');
    }

    public function lastSubscribedEmailsCount()
    {
        $yesterday = strtotime('-1 day', time());
        $this->db->where('time > ', $yesterday);
        return $this->db->count_all_results('subscribed');
    }
	/* public function select()
	{
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get('products');
		return $query;
	} */

    public function getMostSoldProducts($limit = 10)
    {
        $this->db->select('url, procurement');
        $this->db->order_by('procurement', 'desc');
        $this->db->where('procurement >', 0);
        $this->db->limit($limit);
        $queryResult = $this->db->get('products');
        return $queryResult->result_array();
    }

    public function getReferralOrders()
    {

        $this->db->select('count(id) as num, clean_referrer as referrer');
        $this->db->group_by('clean_referrer');
        $queryResult = $this->db->get('orders');
        return $queryResult->result_array();
    }

    public function getOrdersByPaymentType($limit = 10)
    {
        $this->db->select('count(id) as num, payment_type');
        $this->db->group_by('payment_type');
        $this->db->limit($limit);
        $queryResult = $this->db->get('orders');
        return $queryResult->result_array();
    }

    public function getOrdersByMonth()
    {
        $result = $this->db->query("SELECT YEAR(FROM_UNIXTIME(date)) as year, MONTH(FROM_UNIXTIME(date)) as month, COUNT(id) as num FROM orders GROUP BY YEAR(FROM_UNIXTIME(date)), MONTH(FROM_UNIXTIME(date)) ASC");
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

    /*
     * Some statistics methods for home page of
     * administration
     * END
     */

    public function setValueStore($key, $value)
    {
        $this->db->where('thekey', $key);
        $query = $this->db->get('value_store');
        if ($query->num_rows() > 0) {
            $this->db->where('thekey', $key);
            if (!$this->db->update('value_store', array('value' => $value))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            if (!$this->db->insert('value_store', array('value' => $value, 'thekey' => $key))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function changePass($new_pass, $username)
    {
        $this->db->where('username', $username);
        $result = $this->db->update('users', array('password' => md5($new_pass)));
        return $result;
    }

    public function getValueStore($key)
    {
        $query = $this->db->query("SELECT value FROM value_store WHERE thekey = '$key'");
        $img = $query->row_array();
        return $img['value'];
    }

    public function newOrdersCheck()
    {
        $result = $this->db->query("SELECT count(id) as num FROM `orders`");
        $row = $result->row_array();
        return $row['num'];
    }

    public function setCookieLaw($post)
    {
        $query = $this->db->query('SELECT id FROM cookie_law');
        if ($query->num_rows() == 0) {
            $update = false;
        } else {
            $result = $query->row_array();
            $update = $result['id'];
        }

        if ($update === false) {
            $this->db->trans_begin();
            if (!$this->db->insert('cookie_law', array(
                        'link' => $post['link'],
                        'theme' => $post['theme'],
                        'visibility' => $post['visibility']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $for_id = $this->db->insert_id();
            $i = 0;
            foreach ($post['translations'] as $translate) {
                if (!$this->db->insert('cookie_law_translations', array(
                            'message' => htmlspecialchars($post['message'][$i]),
                            'button_text' => htmlspecialchars($post['button_text'][$i]),
                            'learn_more' => htmlspecialchars($post['learn_more'][$i]),
                            'abbr' => $translate,
                            'for_id' => $for_id
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
                $i++;
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                show_error(lang('database_error'));
            } else {
                $this->db->trans_commit();
            }
        } else {
            $this->db->trans_begin();
            $this->db->where('id', $update);
            if (!$this->db->update('cookie_law', array(
                        'link' => $post['link'],
                        'theme' => $post['theme'],
                        'visibility' => $post['visibility']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $i = 0;
            foreach ($post['translations'] as $translate) {
                $this->db->where('for_id', $update);
                $this->db->where('abbr', $translate);
                if (!$this->db->update('cookie_law_translations', array(
                            'message' => htmlspecialchars($post['message'][$i]),
                            'button_text' => htmlspecialchars($post['button_text'][$i]),
                            'learn_more' => htmlspecialchars($post['learn_more'][$i])
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
                $i++;
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                show_error(lang('database_error'));
            } else {
                $this->db->trans_commit();
            }
        }
    }

    public function getCookieLaw()
    {
        $arr = array('cookieInfo' => null, 'cookieTranslate' => null);
        $query = $this->db->query('SELECT * FROM cookie_law');
        if ($query->num_rows() > 0) {
            $arr['cookieInfo'] = $query->row_array();
            $query = $this->db->query('SELECT * FROM cookie_law_translations');
            $arrTrans = $query->result_array();
            foreach ($arrTrans as $trans) {
                $arr['cookieTranslate'][$trans['abbr']] = array(
                    'message' => $trans['message'],
                    'button_text' => $trans['button_text'],
                    'learn_more' => $trans['learn_more']
                );
            }
        }
        return $arr;
    }
	// total customers (total wholesellers, total vendors)
	public function get_user_number()
	{
		$result = $this->db->query("SELECT * FROM `orders` WHERE viewed = 0");
        $row = $result->row_array();
        return $row['num'];
	}
	public function check_position($position)
	{
		$query = $this->db->query("SELECT pcd_position FROM pcdcompanies_entry where pcd_position='".$position."' ");
		return $query->num_rows();;
	}
	public function third_party_check_position($position)
	{
		$query = $this->db->query("SELECT Thirdparty_position FROM thirdparty where Thirdparty_position='".$position."' ");
		return $query->num_rows();;
	}
	// wholeseller subscription messages
	public function subscription_messages()
    {
        return $this->db->count_all_results('vendors_subscribe');
    }
	public function get_wholeseller_subscription_messages($limit, $page)
	{
		$this->db->select('*');
        //$this->db->from('vendors_subscribe');  
        $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get('vendors_subscribe',$limit, $page);
        return($query->result_array());
	}
	public function wholeseller_subscription_status($status,$vendor_id)
	{
		$this->db->where('vendor_id', $vendor_id);
        $this->db->update('vendors_subscribe', array('status'=> "$status"));	
	}
	public function customer_enquiries()
    {
        return $this->db->count_all_results('customer_enquiries');
    }
	public function get_customer_enquiries($limit, $page)
	{
		$this->db->select('*');
        //$this->db->from('customer_enquiries');  
        $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get('customer_enquiries',$limit, $page);
        return($query->result_array());
	}
	public function response_status($data)
	{
		$this->db->insert('vendor_response',$data);
	}
	public function customer_enquiries_status($status,$vendor_id,$enquiry_id)
	{
		$this->db->where('vendor_id', $vendor_id);
		$this->db->where('enquiry_id', $enquiry_id);
        $this->db->update('customer_enquiries', array('status'=> "$status"));	
	}
	public function showresponsesdatacount()
    {
        return $this->db->count_all_results('vendor_response');
    }
	public function show_responses1($limit, $page)
	{
		$this->db->select('*');
        //$this->db->from('vendor_response');  
       // $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get('vendor_response',$limit, $page);
        return($query->result_array());
	}
	public function productlist($limit=100)
	{
		$this->db->select('*');
		
        $this->db->from('product_list');  
		$this->db->limit($limit);
        $query = $this-> db-> get();
        return($query->result_array());
	}
	public function productsCount()
    {
        
        return $this->db->count_all_results('product_list');
    }
	public function showlist($id)
	{
		$this->db->select('*');
		$this->db->from('product_list');
		$this->db->where('id',$id);
		return $this->db->get()->result();
	}
	function updatevendors($data)
	{
		$this->db->set('name',$data['name']);	
		$this->db->set('description',$data['description']);	
		$this->db->set('company',$data['company']);	
		$this->db->set('old_price',$data['old_price']);	
		$this->db->where('id',$data['id']);
        return $this->db->update('product_list');
	}
	function deleteproductlist($id)
	{
		$this->db->where('id',$id);
		$response=$this->db->delete('product_list');
		if($response==true)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function show_enquiry_count()
	{
		return $this->db->count_all_results('enquiry_form');
	}
	public function show_enquiry($page,$limit)
	{
		$this->db->select('*');
        //$this->db->from('enquiry_form');  
		//$this->db->order_by('status', 'ASC');
        $query = $this-> db-> get('enquiry_form',$page,$limit);
        return($query->result_array());
	}
	public function pcdcompanies_show_state()
	{
		$this->db->select('*');
        $this->db->from('states');  
      //$this->db->order_by('status', 'ASC');
        $query = $this-> db-> get();
        return($query->result_array());
	}
	public function thirdparty_show_state()
	{
		$this->db->select('*');
        $this->db->from('states');  
      //$this->db->order_by('status', 'ASC');
        $query = $this-> db-> get();
        return($query->result_array());
	}
	public function pcdcompanies_shows_count()
    {
        return $this->db->count_all_results('thirdparty');
    }
	public function thirdparty_show($page,$limit)
	{
		$this->db->select('*');
		//$this->db->from('thirdparty');  
      //$this->db->order_by('status', 'ASC');
	    $this->db->join('states', ' thirdparty.Thirdparty_state = states.id', 'left');
		$this->db->join('cities', ' thirdparty.Thirdparty_city = cities.id', 'left');
        $query = $this-> db-> get('thirdparty',$page,$limit);
        return($query->result_array());
	}
	public function third_show_city($id)
	{
		
		$this->db->select('*');
        $this->db->from('cities');  
		$this->db->where('state_id', $id);
        $query = $this-> db-> get();
        return($query->result_array());
	}
	public function thirdparty_update($Thirdparty_id)
	{
		$this->db->select('*');
		$this->db->from('thirdparty');
		$this->db->where('thirdparty_id',$Thirdparty_id);
		return $this->db->get()->result();
	}
	public function thirdparty_update_details($data)
	{
		$alldata=$this->thirdparty_update($data['Thirdparty_id']);
		//echo "<pre>";print_r($alldata);die;
		$oldimage=$alldata[0]->Thirdparty_image;
		$this->load->library("image_lib");
		$img_name = $_FILES['Thirdparty_image']['name'];
		$tmpimg_name = $_FILES['Thirdparty_image']['tmp_name'];
		
		if($img_name==""){
			
			$image = $oldimage;
		}else{
			
			$folder_path = "upload_pic/";
		//$path = base_url().$folder_path;
		$path = getcwd()."/".$folder_path;
		$image = time().$img_name;
		unlink("$path/$oldimage");
		move_uploaded_file($tmpimg_name,$path.$image);
		
		}
		$this->db->set('Thirdparty_name',$data['Thirdparty_name']);
        $this->db->set('Thirdparty_description',$data['Thirdparty_description']);	
        $this->db->set('Thirdparty_address',$data['Thirdparty_address']);	
        $this->db->set('Thirdparty_phone',$data['Thirdparty_phone']);	
        $this->db->set('Thirdparty_position',$data['Thirdparty_position']);	
        $this->db->set('Thirdparty_city',$data['Thirdparty_city']);	
        $this->db->set('Thirdparty_state',$data['Thirdparty_state']);	
        $this->db->set('Thirdparty_date',$data['Thirdparty_date']);	
        $this->db->set('Thirdparty_image',$image);	
        $this->db->where('Thirdparty_id',$data['Thirdparty_id']);
        $update = $this->db->update('thirdparty');
		return ($update);
	}
	public function pcdcompanies_show_city($id)
	{
		
		$this->db->select('*');
        $this->db->from('cities');  
		$this->db->where('state_id', $id);
        $query = $this-> db-> get();
        return($query->result_array());
	}
	public function calc_earning_subs($from = null,$to = null)
    {
		if($from != null & $to != null)
		{	
			$this->db->select('vendor_id');
			$this->db->select('vendor_email');
			$this->db->select('amount');
			$this->db->select('date');
			$this->db->from('vendors_subscribe');
			$this->db->where('date >=', $from);
			$this->db->where('date <=', $to);
			$this->db->where('status',1);
			$query1 = $this->db->get();
			$info['date_wise']= $query1->result_array();
			
			$this->db->select_sum('amount');
			$this->db->from('vendors_subscribe');
			$this->db->where('status',1);
			$query = $this->db->get();
			$info['total_amount']= $query->result_array();
			return($info);
		}
		else{
			$this->db->select_sum('amount');
			$this->db->from('vendors_subscribe');
			$this->db->where('status',1);
			$query = $this->db->get();
			$info['total_amount']= $query->result_array();
			return($info);
		}
    }
	public function pcd_companies_entry($data)
	{
		$this->db->insert('pcdcompanies_entry',$data);
	}
	/*public function customer_enquiries_status($status,$vendor_id,$enquiry_id)
	{
		$this->db->where('vendor_id', $vendor_id);
		$this->db->where('enquiry_id', $enquiry_id);
        $this->db->update('customer_enquiries', array('status'=> "$status"));	
	}*/

	public function third_party_count()
    {
        
        return $this->db->count_all_results('pcdcompanies_entry');
    }
	public function pcd_companies_show($page,$limit)
	{
		$this->db->select('*');
		
        //$this->db->from('pcdcompanies_entry'); 
		$this->db->join('states', ' pcdcompanies_entry.pcd_state = states.id', 'left');
		 $this->db->join('cities', ' pcdcompanies_entry.pcd_city = cities.id', 'left');		
       // $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get('pcdcompanies_entry',$page,$limit);
        return($query->result_array());
	}
	
	public function pcd_companies_update($pcd_id)
	{
		$this->db->select('*');
		$this->db->from('pcdcompanies_entry');
		$this->db->where('pcd_id',$pcd_id);
		return $this->db->get()->result();
	}
	public function pcd_companies_update_details($data)
	{
		$alldata=$this->pcd_companies_update($data['pcd_id']);
		//echo "<pre>";print_r($alldata);die;
		$oldimage=$alldata[0]->pcd_image;
		$this->load->library("image_lib");
		
		$img_name = $_FILES['pcd_image']['name'];
		$tmpimg_name = $_FILES['pcd_image']['tmp_name'];
		
		if($img_name==""){
			
			$image = $oldimage;
		}
		else
		{
			
			$folder_path = "upload_pic/";
		//$path = base_url().$folder_path;
		$path = getcwd()."/".$folder_path;
		$image = time().$img_name;
		unlink("$path/$oldimage");
		move_uploaded_file($tmpimg_name,$path.$image);
		}
		$this->db->set('pcd_name',$data['pcd_name']);
        $this->db->set('pcd_description',$data['pcd_description']);	
        $this->db->set('pcd_address',$data['pcd_address']);	
        $this->db->set('pcd_phone',$data['pcd_phone']);	
        $this->db->set('pcd_position',$data['pcd_position']);	
        $this->db->set('pcd_city',$data['pcd_city']);	
        $this->db->set('pcd_state',$data['pcd_state']);	
        $this->db->set('pcd_date',$data['pcd_date']);	
        $this->db->set('pcd_image',$image);	
        $this->db->where('pcd_id',$data['pcd_id']);
        $update = $this->db->update('pcdcompanies_entry');
		return ($update);
	}
	public function show_bank_details_count()
	{
		return $this->db->count_all_results('bank_details');
	}
	public function show_bank_details($page,$limit)
	{
		$this->db->select('*');
		
        //$this->db->from('bank_details');  
       // $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get('bank_details',$page,$limit);
        return($query->result_array());
	}
	// CSV
	public function insertcsv($data, $numrows, $vendor_id = null)
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
                        'vendor_id' => $vendor_id,
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
	// Excel
	public function insertexceldata($data, $numrows, $vendor_id = null)
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
                        'vendor_id' => $vendor_id,
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
				'vendor_id' => $vendor_id,
				'product_id' => $result[0]['id'],
				'state_name' => 42,
				'city_name' => $locationarray[$i1]
				));
			}
			
			
		}
	}
	public function vendors_data()
	{
		$this->db->select('id,email,name');
        $this->db->from('vendors');  
       // $this->db->order_by('status', 'ASC');
        $query = $this-> db-> get();
        return($query->result_array());
	}	
}

