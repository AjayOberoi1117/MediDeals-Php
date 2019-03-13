<?php

class Public_model extends CI_Model
{

    private $showOutOfStock;
    private $showInSliderProducts;
    private $multiVendor;

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Home_admin_model');
        $this->showOutOfStock = $this->Home_admin_model->getValueStore('outOfStock');
        $this->showInSliderProducts = $this->Home_admin_model->getValueStore('showInSlider');
        $this->multiVendor = $this->Home_admin_model->getValueStore('multiVendor');
    }

    public function productsCount($big_get)
    {
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        if (!empty($big_get) && isset($big_get['category'])) {
            $this->getFilter($big_get);
        }
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        if ($this->showInSliderProducts == 0) {
            $this->db->where('in_slider', 0);
        }
        if ($this->multiVendor == 0) {
            $this->db->where('vendor_id', 0);
        }
        return $this->db->count_all_results('products');
    }

    public function getNewProducts()
    {
        $this->db->select('vendors.name as vendor_name, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('products.in_slider', 0);
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.id', 'desc');
        $this->db->limit(8);
        $query = $this->db->get('products');
        return $query->result_array();
    }
	
	public function getMostDiscounted()
    {
        $this->db->select('vendors.name as vendor_name, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('products.in_slider', 0);
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
		//$this->db->group_by('discount');
        $this->db->order_by('discount', 'desc');
        $this->db->limit(8);
        $query = $this->db->get('products');
        return $query->result_array();
    }
	
	
	 public function getRandomProducts()
    {
        $this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('products.in_slider', 0);
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
		$this->db->order_by('products.id', 'RANDOM');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }
	public function getLastBlogs()
    {
        $this->db->limit(5);
        $this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts');
        return $query->result_array();
    }

    public function getPosts($limit, $page, $search = null, $month = null)
    {
        if ($search !== null) {
            $search = $this->db->escape_like_str($search);
            $this->db->where("(blog_translations.title LIKE '%$search%' OR blog_translations.description LIKE '%$search%')");
        }
        if ($month !== null) {
            $from = intval($month['from']);
            $to = intval($month['to']);
            $this->db->where("time BETWEEN $from AND $to");
        }
        $this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->select('blog_posts.id, blog_translations.title, blog_translations.description, blog_posts.url, blog_posts.time, blog_posts.image')->get('blog_posts', $limit, $page);
        return $query->result_array();
    }

    public function getProducts($limit = null, $start = null, $big_get, $vendor_id = false)
    {
        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }
        if (!empty($big_get) && isset($big_get['category'])) {
            $this->getFilter($big_get);
        }
		
	/*	 $this->db->select('vendors.name as vendor_name, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'inner');*/
		
		
        $this->db->select('vendors.name as vendor_name, products.id,products.image, products.quantity, products_translations.title, products_translations.price, products_translations.old_price, products.url');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'inner');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('visibility', 1);
        if ($vendor_id !== false) {
            $this->db->where('vendor_id', $vendor_id);
        }
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        if ($this->showInSliderProducts == 0) {
            $this->db->where('in_slider', 0);
        }
        
        $this->db->order_by('position', 'asc');
		$this->db->limit(8);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getOneLanguage($myLang)
    {
        $this->db->select('*');
        $this->db->where('abbr', $myLang);
        $result = $this->db->get('languages');
        return $result->row_array();
    }

    private function getFilter($big_get)
    {

        if ($big_get['category'] != '') {
            (int) $big_get['category'];
            $findInIds = array();
            $findInIds[] = $big_get['category'];
            $query = $this->db->query('SELECT id FROM shop_categories WHERE sub_for = ' . $this->db->escape($big_get['category']));
            foreach ($query->result() as $row) {
                $findInIds[] = $row->id;
            }
            $this->db->where_in('products.shop_categorie', $findInIds);
        }
        if ($big_get['in_stock'] != '') {
            if ($big_get['in_stock'] == 1)
                $sign = '>';
            else
                $sign = '=';
            $this->db->where('products.quantity ' . $sign, '0');
        }
        if ($big_get['search_in_title'] != '') {
            $this->db->like('products_translations.title', $big_get['search_in_title']);
        }
        if ($big_get['search_in_body'] != '') {
            $this->db->like('products_translations.description', $big_get['search_in_body']);
        }
        if ($big_get['order_price'] != '') {
            $this->db->order_by('products_translations.price', $big_get['order_price']);
        }
        if ($big_get['order_procurement'] != '') {
            $this->db->order_by('products.procurement', $big_get['order_procurement']);
        }
        if ($big_get['order_new'] != '') {
            $this->db->order_by('products.id', $big_get['order_new']);
        } else {
            $this->db->order_by('products.id', 'DESC');
        }
        if ($big_get['quantity_more'] != '') {
            $this->db->where('products.quantity > ', $big_get['quantity_more']);
        }
        if ($big_get['quantity_more'] != '') {
            $this->db->where('products.quantity > ', $big_get['quantity_more']);
        }
        if ($big_get['brand_id'] != '') {
            $this->db->where('products.brand_id = ', $big_get['brand_id']);
        }
        if ($big_get['added_after'] != '') {
            $time = strtotime($big_get['added_after']);
            $this->db->where('products.time > ', $time);
        }
        if ($big_get['added_before'] != '') {
            $time = strtotime($big_get['added_before']);
            $this->db->where('products.time < ', $time);
        }
        if ($big_get['price_from'] != '') {
            $this->db->where('products_translations.price >= ', $big_get['price_from']);
        }
        if ($big_get['price_to'] != '') {
            $this->db->where('products_translations.price <= ', $big_get['price_to']);
        }
    }

	public function search_products()
	{
	//echo $_POST['search'];

			$this->db->distinct();
			$this->db->select('vendors.name as vendor_name, products.id,products.image, products.quantity, products_translations.title, products_translations.price, products_translations.old_price, products.url');
			$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
			$this->db->join('vendors', 'vendors.id = products.vendor_id', 'inner');
			//$this->db->join('brands', 'brands.id = products.brand_id', 'left');
			/*$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);*/
			//$this->db->where('shop_categorie', $_POST['category']);
			
			/*if ($this->showOutOfStock == 0) {
				$this->db->where('quantity >', 0);
			}*/
			$this->db->like('products_translations.title', $_POST['search']);
		    // $this->db->or_like('brands.name', $_POST['search']);
			$this->db->order_by('position', 'asc');
			$query = $this->db->get('products');
			return $query->result_array();
	}
    public function getShopCategories()
    {
        $this->db->select('shop_categories.sub_for, shop_categories.id, shop_categories_translations.name');
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->order_by('position', 'asc');
        $this->db->join('shop_categories', 'shop_categories.id = shop_categories_translations.for_id', 'INNER');
        $query = $this->db->get('shop_categories_translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr[] = $row;
            }
        }
        return $arr;
    }

    public function getSeo($page)
    {
        $this->db->where('page_type', $page);
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->get('seo_pages_translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr['title'] = $row['title'];
                $arr['description'] = $row['description'];
            }
        }
        return $arr;
    }
	public function getOneProductcity($id)
	{

		$this->db->select("*");
		$this->db->from("vendor_business_location");
		$this->db->where('product_id', $id);
		$query = $this->db->get();        
		return $query->result();

	}
    public function getOneProduct($id)
    {
        $this->db->where('products.id', $id);
		$this->db->select('vendors.url as vendor_url, vendors.id as vendor_id, products.*, products_translations.title,products_translations.description, products_translations.price, products_translations.old_price, products.url, shop_categories_translations.name as categorie_name');
		$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
		$this->db->join('shop_categories_translations', 'shop_categories_translations.for_id = products.shop_categorie', 'inner');
        $this->db->where('shop_categories_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
		$this->db->where('visibility', 1);
        $query = $this->db->get('products');
		//var_dump($query->row_array()); die;
        return $query->row_array();
    }

    public function getCountQuantities()
    {
        $query = $this->db->query('SELECT SUM(IF(quantity<=0,1,0)) as out_of_stock, SUM(IF(quantity>0,1,0)) as in_stock FROM products WHERE visibility = 1');
        return $query->row_array();
    }

    public function setToCart($post)
    {
        if (!is_numeric($post['article_id'])) {
            return false;
        }
        $query = $this->db->insert('shopping_cart', array(
            'session_id' => session_id(),
            'article_id' => $post['article_id'],
            'time' => time()
        ));
        return $query;
    }

    public function getShopItems($array_items)
    {
		//var_dump($array_items);die;
        $this->db->select('products.id, products.image, products.url, products.quantity, products.minquantity, products.vendor_id, products_translations.price, products_translations.title');
        $this->db->from('products');
        if (count($array_items) > 1) {
            $i = 1;
            $where = '';
            foreach ($array_items as $id) {
                $i == 1 ? $open = '(' : $open = '';
                $i == count($array_items) ? $or = '' : $or = ' OR ';
                $where .= $open . 'products.id = ' . $id . $or;
                $i++;
            }
            $where .= ')';
            $this->db->where($where);
        } else {
            $this->db->where('products.id =', current($array_items));
        }
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'inner');
      
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->get();
        return $query->result_array();
    }

    /*
     * Users for notification by email
     */

    public function getNotifyUsers()
    {
        $result = $this->db->query('SELECT email FROM users WHERE notify = 1');
        $arr = array();
        foreach ($result->result_array() as $email) {
            $arr[] = $email['email'];
        }
        return $arr;
    }

	public function total_revenue()
	{
		$this->db->select(' SUM(final_amount) AS amount', FALSE);
		$qwer = $this->db->get('orders');
		return $qwer->result_array();
	}
	
	public function viewpcd_companies($pcd_id)
	{
		$this->db->select('*');
		$this->db->from('pcdcompanies_entry');
		$this->db->where('pcd_id',$pcd_id);
		 $this->db->join('states', ' pcdcompanies_entry.pcd_id = states.id', 'left');
		 $this->db->join('cities', ' pcdcompanies_entry.pcd_id = cities.id', 'left');
		return $this->db->get()->row_array();
	}
	public function viewthirdparty($Thirdparty_id)
	{
		$this->db->select('*');
		$this->db->from('thirdparty');
		$this->db->where('Thirdparty_id',$Thirdparty_id);
		 $this->db->join('states', ' thirdparty.Thirdparty_id = states.id', 'left');
		 $this->db->join('cities', ' thirdparty.Thirdparty_id = cities.id', 'left');
		return $this->db->get()->row_array();
	}
    public function setOrder($post)
    {
	//print_r($post);
	//exit; 
        $q = $this->db->query('SELECT MAX(order_id) as order_id FROM orders');
        $rr = $q->row_array();
        if ($rr['order_id'] == 0) {
            $rr['order_id'] = 1000;
        }
        $post['order_id'] = $rr['order_id'] + 1;

        $i = 0;
        $post['products'] = array();
        foreach ($post['id'] as $product) {
            $post['products'][$product] = $post['quantity'][$i];
            $i++;
        }
        unset($post['id'], $post['quantity']);
        $post['date'] = time();
        $products = serialize($post['products']);
		
        $this->db->trans_begin();	
		
		// insert order in order table
		
		$data =  array(
                    'order_id' => $post['order_id'],
					'final_amount' => floatval(str_replace(',','',$post['final_amount'])),
                    'products' => $products,
                    'date' => $post['date'],
                    'referrer' => $post['referrer'],
                    'clean_referrer' => $post['clean_referrer'],
                    'payment_type' => $post['payment_type'],
                    'paypal_status' => @$post['paypal_status'],
                    'discount_code' => @$post['discountCode']
                ); 
					
		if (!$this->db->insert('orders',$data)) {
		    log_message('error', print_r($this->db->error(), true));
		}
		$lastId = $this->db->insert_id();
		
		// order shipping details
		
		$data1 = array(
                    'for_id' => $lastId,
                    'first_name' => $post['first_name'],
                    'last_name' => $post['last_name'],
                    'email' => $post['email'],
                    'phone' => $post['phone'],
                    'address' => $post['address'],
                    'city' => $post['city'],
                    'post_code' => $post['post_code'],
                    'notes' => $post['notes']
                );
		
        if (!$this->db->insert('orders_clients', $data1)) {
            log_message('error', print_r($this->db->error(), true));
        }
		
		// insert order for wholesellers
		
		$i = 0;
		foreach($post['products'] as $key => $value)
		{	
			$data2 = array(
					'order_id' => $post['order_id'],
					'products' => $key ,
					'order_quantity' => $value,
					'individual_price'    => floatval($post['individual_price'][$i]),
					'date' => time(),
					'referrer' => $post['referrer'],
					'clean_referrer' => $post['clean_referrer'],
					'payment_type' => $post['payment_type'],
					'paypal_status' => @$post['paypal_status'],
					'discount_code' => @$post['discountCode'],
					'vendor_id' => $post['vendor_id'][$i]
				    );
			if (!$this->db->insert('vendors_orders', $data2)) {
				log_message('error', print_r($this->db->error(), true));
			}
			
			$lastId = $this->db->insert_id();
			$data3 = array(
					'for_id' => $lastId,
					'first_name' => $post['first_name'],
					//'last_name' => $post['last_name'],
					'email' => $post['email'],
					'phone' => $post['phone'],
					'address' => $post['address'],
					'city' => $post['city'],
					'post_code' => $post['post_code'],
					'notes' => $post['notes']
				    );
			
			if (!$this->db->insert('vendors_orders_clients', $data3)) {
						log_message('error', print_r($this->db->error(), true));
			}
			$i++;
		}
        if ($this->db->trans_status() === FALSE) 
		{
            $this->db->trans_rollback();
            return false;
			
        } 
		else 
		{
            $this->db->trans_commit();
			return $post['order_id'];
        }
		
    }
	
	
 
    public function setVendorOrder($post)
    {
        $i = 0;
        $post['products'] = array();
        foreach ($post['id'] as $product) {
            $post['products'][$product] = $post['quantity'][$i];
            $i++;
        }

        /*
         * Loop products and check if its from vendor - save order for him
         */
        foreach ($post['products'] as $product_id => $product_quantity) {
            $productInfo = $this->getOneProduct($product_id);
            if ($productInfo['vendor_id'] > 0) {

                $q = $this->db->query('SELECT MAX(order_id) as order_id FROM vendors_orders');
                $rr = $q->row_array();
                if ($rr['order_id'] == 0) {
                    $rr['order_id'] = 1000;
                }
                $post['order_id'] = $rr['order_id'] + 1;


                unset($post['id'], $post['quantity']);
                $post['date'] = time();
                $post['products'] = serialize(array($product_id => $product_quantity));
                $this->db->trans_begin();
                if (!$this->db->insert('vendors_orders', array(
                            'order_id' => $post['order_id'],
                            'products' => $post['products'],
                            'date' => date('y-m-d'),
                            'referrer' => $post['referrer'],
                            'clean_referrer' => $post['clean_referrer'],
                            'payment_type' => $post['payment_type'],
                            'paypal_status' => @$post['paypal_status'],
                            'discount_code' => @$post['discountCode'],
                            'vendor_id' => $productInfo['vendor_id']
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
                $lastId = $this->db->insert_id();
                if (!$this->db->insert('vendors_orders_clients', array(
                            'for_id' => $lastId,
                            'first_name' => $post['first_name'],
                            'last_name' => $post['last_name'],
                            'email' => $post['email'],
                            'phone' => $post['phone'],
                            'address' => $post['address'],
                            'city' => $post['city'],
                            'post_code' => $post['post_code'],
                            'notes' => $post['notes']
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
                if ($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                    return false;
                } else {
                    $this->db->trans_commit();
                }
            }
        }
    }

    public function setActivationLink($link, $orderId)
    {
        $result = $this->db->insert('confirm_links', array('link' => $link, 'for_order' => $orderId));
        return $result;
    }

    public function getSliderProducts()
    {
        $this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.basic_description, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('visibility', 1);
        $this->db->where('in_slider', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getbestSellers($categorie = 0, $noId = 0)
    {
        $this->db->select('vendors.name as vendor_name, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'inner');
        if ($noId > 0) {
            $this->db->where('products.id !=', $noId);
        }
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        if ($categorie != 0) {
            $this->db->where('products.shop_categorie !=', $categorie);
        }
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.procurement', 'desc');
        $this->db->limit(5);
        $query = $this->db->get('products');
        return $query->result_array();
    }
	public function pcd_companies_data($categorie)
	{
		if($categorie == 4)
		{
			$this->db->select("*");
			$this->db->order_by('pcd_position', 'ASC');
			$query = $this->db->get('pcdcompanies_entry');
		
		}
		else if($categorie == 5)
		{
			$this->db->select("");
			$this->db->order_by('Thirdparty_position', 'ASC');
			$query = $this->db->get('thirdparty');
		}	
		
		 return $query->result_array();
	}
	
	 public function singleCagegoryProducts($categorie = null, $vendor_id = false)
    {
			$price = "Rs 10 - Rs 50000";
			$discount = 0;
			$brand = "";
			$city = "";
			$search_prod = "";
			
			if($_POST['sel_price'] != null)
			{
				$price = $_POST['sel_price'];
				$price = str_replace('Rs ','',$price);
				$price = explode('-',$price);
				//var_dump($price);
			}
			
			if($_POST['sel_discount'] != null)
				$discount = $_POST['sel_discount'];
			
			if($_POST['sel_brand'] != null){
				$brand = $_POST['sel_brand'];}
			
			if($_POST['sel_city'] != null){
				$city = $_POST['sel_city'];
				//var_dump($city);
			}
			if($_POST['sel_cat'] != null)
				$categorie = $_POST['sel_cat'];
			
			if($_POST['search_prod'] != null)
				$search_prod = $_POST['search_prod'];
			
			//var_dump($search_prod);die;
			//var_dump($_POST['sel_brand']);
			//var_dump($discount);
			//var_dump($brand);
			//var_dump($_POST);
			
			
			// filter cases		
			
			if($price[0] == "10" &&  $price[1] == "500") 
			{
				if($discount == 0)
				{
						if($brand == "")
						{
							if($city == "")
							{
								if($search_prod == "")
								{
									// all
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
												
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									// search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->like('products_translations.title', $search_prod );
									$this->db->or_like('products.brand', $search_prod );
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}	
							}
							else
							{
								if($search_prod == "")
								{
									// city
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
									
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									
									
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									//search,city
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
									
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where('vendor_business_location.city_name',"$city");
									$this->db->like('products_translations.title', $search_prod );
									$this->db->or_like('products.brand', $search_prod );
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}	
							}
						}
						else
						{
							if($search_prod == "")
							{
								// for only brand
								$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
								$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
								$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
								$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
								//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
							
								//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
						   
								if ($vendor_id !== false) {
									$this->db->where('vendor_id', $vendor_id);
								}
								$this->db->where('products.shop_categorie =', $categorie);
								$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
								$this->db->where('visibility', 1);
								$this->db->where('products.brand', "$brand");
								

								
								if ($this->showOutOfStock == 0) {
									$this->db->where('quantity >', 0);
								}
								$this->db->order_by('products.id', 'ASCE');
								$query = $this->db->get('products');
								return $query->result_array();
							}
							else
							{
								// search,brand
								$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
								$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
								$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
								$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
								//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
							
								//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
						   
								if ($vendor_id !== false) {
									$this->db->where('vendor_id', $vendor_id);
								}
								$this->db->where('products.shop_categorie =', $categorie);
								$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
								$this->db->where('visibility', 1);
								$this->db->where('products.brand', "$brand");
								$this->db->like('products_translations.title', $search_prod );
								$this->db->or_like('products.brand', $search_prod );
								if ($this->showOutOfStock == 0) {
									$this->db->where('quantity >', 0);
								}
								$this->db->order_by('products.id', 'ASCE');
								$query = $this->db->get('products');
								return $query->result_array();
							}
						}
				}
				else
				{
						if($brand == "")
						{
							if($city == "")
							{
								if($search_prod == "")
								{
									// only discount
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									// search, discount
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
									$discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
							else
							{
								if($search_prod == "")
								{
									// Discount, City		
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
									$discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									// Discount, City, Search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
									$discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
						}
						else
						{
							if($city == "")
							{
								if($search_prod == "")
								{
									// Brand & Discount
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
									$discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where('products.brand', "$brand");
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									// Brand, Discount, Search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where('products.brand', "$brand");
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
							else
							{
								if($search_prod == "")
								{
									//Discount, Brand, City
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
									$discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where('products.brand', "$brand");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									//Discount, Brand, City, Search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where('products.brand', "$brand");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
						}
				}
			}
			else
			{
				if($discount == 0)
				{
						if($brand == "")
						{
							if($city == "")
							{
								if($search_prod == "")
								{
									// Price
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									
									return $query->result_array();
								}
								else
								{
									// Price, search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
							else
							{
								if($search_prod == "")
								{
									//Price, City
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
										
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									//Price, City, Search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
						}
						else
						{
							if($city == 0)
							{
								if($search_prod == "")
								{
									// price & brand
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where('products.brand', "$brand");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									// price , brand, search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where('products.brand', "$brand");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
							else
							{
								if($search_prod == "")
								{
									//Price, Brand, City 	
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where('products.brand', "$brand");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									//Price, Brand, City, Search	
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							   
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where('products.brand', "$brand");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
						}
				}
				else
				{
						if($brand == "")
						{
							if($city == "")
							{
								if($search_prod == "")
								{
									// Price & Discount
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									// Price & Discount, search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
							else
							{
								if($search_prod == "")
								{
									//Price, Discount, City 
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();	
								}
								else
								{
									//Price, Discount, City, Search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									$this->db->where('vendor_business_location.city_name',"$city");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();	
								}
							}
						}
						else
						{
							if($city == "")
							{
								if($search_prod == "")
								{
									// Price, Discount, Brand
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where('products.brand', "$brand");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									// Price, Discount, Brand, Search
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									//$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where('products.brand', "$brand");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
							else
							{
								if($search_prod == "")
								{
									//Price , Discount , Brand , City 
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where('products.brand', "$brand");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
								else
								{
									//Price , Discount , Brand , City, Search 
									$this->db->select('vendors.name as vendor_name, products.id, products.quantity,products.brand, products.image, products.url, products_translations.price, products_translations.title,products_translations.old_price,shop_categories_translations.name,products.shop_categorie');
									$this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
									$this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
									$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie','left');
									$this->db->join('vendor_business_location', 'vendor_business_location.product_id = products.id','left');
								
									//$this->db->join('pcdcompanies_entry', 'pcdcompanies_entry.pcd_id = products.shop_categorie', 'left');
							        $discount_min = $discount - 9;
									if ($vendor_id !== false) {
										$this->db->where('vendor_id', $vendor_id);
									}
									$this->db->where('products.shop_categorie =', $categorie);
									$this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
									$this->db->where('visibility', 1);
									$this->db->where("products.discount >= $discount_min");
									$this->db->where("products.discount <= $discount");
									$this->db->where('products.brand', "$brand");
									$this->db->where("products_translations.price >= $price[0]");
									$this->db->where("products_translations.price <= $price[1]");
									
									$this->db->where("vendor_business_location.city_name = '".$city."' 
									or products.id not in (select product_id from vendor_business_location) 
									AND products.shop_categorie = '".$categorie."' AND visibility = '1'");
									
									$this->db->like('products_translations.title', $search_prod );
								    $this->db->or_like('products.brand', $search_prod );
									
									if ($this->showOutOfStock == 0) {
										$this->db->where('quantity >', 0);
									}
									$this->db->order_by('products.id', 'ASCE');
									$query = $this->db->get('products');
									return $query->result_array();
								}
							}
						}
				}
			}
		
    } 
	public function fetchbranddata()
    {
		$this->db->select('DISTINCT(brand)');
        $this->db->from('products');  
		$query = $this-> db-> get();
        return($query->result_array());
	}
     
	public function state()
	{
		$this->db->select('*');
        $this->db->from('states');  
      //$this->db->order_by('status', 'ASC');
        $query = $this-> db-> get();
        return($query->result_array());
	}
	public function city($id)
	{
		
		$this->db->select('*');
        $this->db->from('cities');  
		$this->db->where('state_id', $id);
        $query = $this-> db-> get();
        return($query->result_array());
	}
	
	 public function Count_vendor()
    {
	// $vendor_name=str_replace('-',' ',$vendor_name);
       // $this->db->select('select *');
         $query = $this->db->get('vendors');
		
        return $query->num_rows();
    }
	
	public function singleVendorProductsnum_rows($vendor_name)
    {
	 $vendor_name=str_replace('-',' ',$vendor_name);
        $this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price,shop_categories_translations.name ');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'inner');
		$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie', 'left');
       
        if ($vendor_name !== false) {
            $this->db->where('vendors.name', $vendor_name);
        }
   
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.id', 'desc');
        //$this->db->limit(5);
        $query = $this->db->get('products');
		//echo $this->db->last_query();
		//exit;
        return $query->num_rows();
    }
	public function singleVendorProducts($limit, $start,$vendor_name)
    {
		$vendor_name=str_replace('-',' ',$vendor_name);
        $this->db->select('vendors.name as vendor_name, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price,shop_categories_translations.name ');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'inner');
		$this->db->join('shop_categories_translations', 'shop_categories_translations.id = products.shop_categorie', 'left');
        //$this->db->limit($limit, $start);
        if ($vendor_name !== false) {
            $this->db->where('vendors.name', $vendor_name);
        }
   
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        /*$this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }*/
      
       
        $query = $this->db->get('products');
		//echo $this->db->last_query();
		//exit;
        return $query->result_array();
    }
	public function sameCagegoryProducts($categorie, $noId, $vendor_id = false)
    {
        $this->db->select('vendors.url as vendor_url, products.id, products.quantity, products.image, products.url, products_translations.price, products_translations.title, products_translations.old_price,products_translations.description');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->where('products.id !=', $noId);
        if ($vendor_id !== false) {
            $this->db->where('vendor_id', $vendor_id);
        }
        //$this->db->where('products.shop_categorie =', $categorie);
        $this->db->where('products_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('visibility', 1);
        if ($this->showOutOfStock == 0) {
            $this->db->where('quantity >', 0);
        }
        $this->db->order_by('products.id', 'desc');
        //$this->db->limit(4);
        $query = $this->db->get('products');
        return $query->result_array();
    }

    public function getOnePost($id)
    {
        $this->db->select('blog_translations.title, blog_translations.description, blog_posts.image, blog_posts.time');
        $this->db->where('blog_posts.id', $id);
        $this->db->join('blog_translations', 'blog_translations.for_id = blog_posts.id', 'left');
        $this->db->where('blog_translations.abbr', MY_LANGUAGE_ABBR);
        $query = $this->db->get('blog_posts');
        return $query->row_array();
    }

    public function getArchives()
    {
        $result = $this->db->query("SELECT DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y') as month, MAX(time) as maxtime, MIN(time) as mintime FROM blog_posts GROUP BY DATE_FORMAT(FROM_UNIXTIME(time), '%M %Y')");
        if ($result->num_rows() > 0) {
            return $result->result_array();
        }
        return false;
    }

    public function getFooterCategories()
    {
        $this->db->select('shop_categories.id, shop_categories_translations.name');
        $this->db->where('abbr', MY_LANGUAGE_ABBR);
        $this->db->where('shop_categories.sub_for =', 0);
        $this->db->join('shop_categories', 'shop_categories.id = shop_categories_translations.for_id', 'INNER');
        $this->db->limit(10);
        $query = $this->db->get('shop_categories_translations');
        $arr = array();
        if ($query !== false) {
            foreach ($query->result_array() as $row) {
                $arr[$row['id']] = $row['name'];
            }
        }
        return $arr;
    }

    public function setSubscribe($array)
    {
        $num = $this->db->where('email', $arr['email'])->count_all_results('subscribed');
        if ($num == 0) {
            $this->db->insert('subscribed', $array);
        }
    }

    public function getDynPagesLangs($dynPages)
    {
        if (!empty($dynPages)) {
            $this->db->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left');
            $this->db->where_in('active_pages.name', $dynPages);
            $this->db->where('textual_pages_tanslations.abbr', MY_LANGUAGE_ABBR);
            $result = $this->db->select('textual_pages_tanslations.name as lname, active_pages.name as pname')->get('active_pages');
            $ar = array();
            $i = 0;
            foreach ($result->result_array() as $arr) {
                $ar[$i]['lname'] = $arr['lname'];
                $ar[$i]['pname'] = $arr['pname'];
                $i++;
            }
            return $ar;
        } else
            return $dynPages;
    }

    public function getOnePage($page)
    {
        $this->db->join('textual_pages_tanslations', 'textual_pages_tanslations.for_id = active_pages.id', 'left');
        $this->db->where('textual_pages_tanslations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('active_pages.name', $page);
        $result = $this->db->select('textual_pages_tanslations.description as content, textual_pages_tanslations.name')->get('active_pages');
        return $result->row_array();
    }

    public function changePaypalOrderStatus($order_id, $status)
    {
        $processed = 0;
        if ($status == 'canceled') {
            $processed = 2;
        }
        $this->db->where('order_id', $order_id);
        if (!$this->db->update('orders', array(
                    'paypal_status' => $status,
                    'processed' => $processed
                ))) {
            log_message('error', print_r($this->db->error(), true));
        }
    }

    public function getCookieLaw()
    {
        $this->db->join('cookie_law_translations', 'cookie_law_translations.for_id = cookie_law.id', 'inner');
        $this->db->where('cookie_law_translations.abbr', MY_LANGUAGE_ABBR);
        $this->db->where('cookie_law.visibility', '1');
        $query = $this->db->select('link, theme, message, button_text, learn_more')->get('cookie_law');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function confirmOrder($md5)
    {
        $this->db->limit(1);
        $this->db->where('link', $md5);
        $result = $this->db->get('confirm_links');
        $row = $result->row_array();
        if (!empty($row)) {
            $orderId = $row['for_order'];
            $this->db->limit(1);
            $this->db->where('order_id', $orderId);
            $result = $this->db->update('orders', array('confirmed' => '1'));
            return $result;
        }
        return false;
    }

    public function getValidDiscountCode($code)
    {
        $time = time();
        $this->db->select('type, amount');
        $this->db->where('code', $code);
        $this->db->where($time . ' BETWEEN valid_from_date AND valid_to_date');
        $query = $this->db->get('discount_codes');
        return $query->row_array();
    }

    public function countPublicUsersWithEmail($email, $id = 0)
    {
        if ($id > 0) {
            $this->db->where('id !=', $id);
        }
        $this->db->where('email', $email);
        return $this->db->count_all_results('users_public');
    }

    public function registerUser($post)
    {
        $this->db->insert('users_public', array(
            'name' => $post['name'],
            'phone' => $post['phone'],
            'email' => $post['email'],
            'password' => md5($post['pass'])
        ));
        return $this->db->insert_id();
    }

    public function updateProfile($post)
    {
        $array = array(
            'name' => $post['name'],
            'phone' => $post['phone'],
            'email' => $post['email']
        );
        if (trim($post['pass']) != '') {
            $array['password'] = md5($post['pass']);
        }
        $this->db->where('id', $post['id']);
        $this->db->update('users_public', $array);
    }

    public function checkPublicUserIsValid($post)
    {
        $this->db->where('email', $post['email']);
        $this->db->where('password', md5($post['password']));
        $query = $this->db->get('users_public');
        $result = $query->row_array();
        if (empty($result)) {
            return false;
        } else {
            return $result['id'];
        }
    }

    public function getUserProfileInfo($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('users_public');
        return $query->row_array();
    }

    public function sitemap()
    {
        $query = $this->db->select('url')->get('products');
        return $query;
    }

    public function sitemapBlog()
    {
        $query = $this->db->select('url')->get('blog_posts');
        return $query;
    }
	
	public function Update_qty_vendor()
	{
	
		//print_r($_SESSION['cart']);
		//exit;
		foreach($_SESSION['cart'] as $cart)
		{
		//echo "<pre>";
		$cart['id'];
		$cart['num_added'];
		$cart['quantity'];
		$qty=$cart['quantity']-$cart['num_added'];

		$data = array(
					   'quantity' => $qty 
					);
		 
		$this->db->where('id', $cart['id']);
		$this->db->update('products', $data);

		}	
	}
	public function checkoutdata($data)
	{
		$this->db->select('*');
		$this->db->from('vendors');
		$this->db->where('email',$data);
		return $this->db->get()->row_array();
	}
	public function wholesaleremailbyid($oid)
	{
		$this->db->select('email');
		$this->db->from('vendors');
		$this->db->where('id',$oid);
		return $this->db->get()->row_array();
	}
	public function verifyemail1($token,$time)
	{
		// select time
		$this->db->select('id,created_at');
        $this->db->where('token',$token);
        $query = $this->db->get('vendors');
        $row = $query->row_array();
	
		$lasttime = strtotime($row['created_at']);
		if($time - $lasttime < 86400)
		{
			$this->db->where('id', $row['id']);
			if(!$this->db->update('vendors', array('email_verify' => 1)))
			{	return false; }
			else{	return true;}
		}
		else{
			return false;
		}
	}
	public function checkoutlater_insert()
	{
		$er = $this->db->insert('checkoutlater_data', array(
            'vendor_id' => $_SESSION['vendor_id'],
            'cartdata' => serialize($_SESSION['shopping_cart']),
        ));
		if($er)
		return true;
		else
		return false;	
	}
	public function checkoutlater_fetch()
	{
		$this->db->select('cartdata');
		$this->db->from('checkoutlater_data');
		$this->db->where('vendor_id',$_SESSION['vendor_id']);
		return $this->db->get()->row_array();
	}
	public function checkoutlater_delete()
	{
		$this->db->where('vendor_id', $_SESSION['vendor_id']);
		$this->db->delete('checkoutlater_data');
	}
	public function cate_lastele($id)
	{
		$this->db->where('id', "$id");
        $query = $this->db->get('products');
        return $query->result_array();
	}
}
