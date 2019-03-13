<?php

class Products_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function deleteProduct($id)
    {
        $this->db->trans_begin();
        $this->db->where('for_id', $id);
        if (!$this->db->delete('products_translations')) {
            log_message('error', print_r($this->db->error(), true));
        }

        $this->db->where('id', $id);
        if (!$this->db->delete('products')) {
            log_message('error', print_r($this->db->error(), true));
        }
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    public function productsCount($search_title = null, $category = null)
    {
        if ($search_title != null) {
            $search_title = trim($this->db->escape_like_str($search_title));
            $this->db->where("(products_translations.title LIKE '%$search_title%')");
        }
        if ($category != null) {
            $this->db->where('shop_categorie', $category);
        }
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        return $this->db->count_all_results('products');
    }

    public function getProducts($limit, $page, $search_title = null, $orderby = null, $category = null, $vendor = null)
    {
        if ($search_title != null) {
            $search_title = trim($this->db->escape_like_str($search_title));
            $this->db->where("(products_translations.title LIKE '%$search_title%')");
        }
        if ($orderby !== null) {
            $ord = explode('=', $orderby);
            if (isset($ord[0]) && isset($ord[1])) {
                $this->db->order_by('products.' . $ord[0], $ord[1]);
            }
        } else {
            $this->db->order_by('products.position', 'asc');
        }
        if ($category != null) {
            $this->db->where('shop_categorie', $category);
        }
        if ($vendor != null) {
            $this->db->where('vendor_id', $vendor);
        }
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $this->db->join('products_translations', 'products_translations.for_id = products.id', 'left');
        $this->db->where('products_translations.abbr', MY_DEFAULT_LANGUAGE_ABBR);
        $query = $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.*, products_translations.title, products_translations.description, products_translations.price, products_translations.old_price, products_translations.abbr, products.url, products_translations.for_id, products_translations.basic_description')->get('products', $limit, $page);
        return $query->result();
    }

    public function numShopProducts()
    {
        return $this->db->count_all_results('products');
    }

    public function getOneProduct($id)
    {
        $this->db->select('vendors.name as vendor_name, vendors.id as vendor_id, products.*');
        $this->db->where('products.id', $id);
        $this->db->join('vendors', 'vendors.id = products.vendor_id', 'left');
        $query = $this->db->get('products');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    public function productStatusChange($id, $to_status)
    {
        $this->db->where('id', $id);
        $result = $this->db->update('products', array('visibility' => $to_status));
        return $result;
    }

    public function setProduct($post, $id = 0)
    {
        if (!isset($post['brand'])) {
            $post['brand'] = null;
        }
        if (!isset($post['virtual_products'])) {
            $post['virtual_products'] = null;
        }
        $this->db->trans_begin();
        $is_update = false;
        if ($id > 0) {
            $is_update = true;
            if (!$this->db->where('id', $id)->update('products', array(
                        'image' => $post['image'] != null ? $_POST['image'] : $_POST['old_image'],
                        'shop_categorie' => $post['shop_categorie'],
                        'minquantity' => $post['minquantity'],
                        'in_slider' => $post['in_slider'],
						'virtual_products' => $post['virtual_products'],
                        'brand' => $post['brand'],
                        'time_update' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
        } else {
            /*
             * Lets get what is default tranlsation number
             * in titles and convert it to url
             * We want our plaform public ulrs to be in default 
             * language that we use
             */
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
                        'minquantity' => $post['minquantity'],
                        'in_slider' => $post['in_slider'],
						'virtual_products' => $post['virtual_products'],
                        'folder' => $post['folder'],
                        'brand' => $post['brand'],
                        'time' => time()
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $id = $this->db->insert_id();

            $this->db->where('id', $id);
            if (!$this->db->update('products', array(
                        'url' => except_letters($_POST['title'][$myTranslationNum]) . '_' . $id
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
        }
        $this->setProductTranslation($post, $id, $is_update);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            show_error(lang('database_error'));
        } else {
            $this->db->trans_commit();
        }
    }

    private function setProductTranslation($post, $id, $is_update)
    {
        $i = 0;
        $current_trans = $this->getTranslations($id);
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
                'basic_description' => $post['basic_description'][$i],
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
            $arr[$row->abbr]['basic_description'] = $row->basic_description;
            $arr[$row->abbr]['description'] = $row->description;
            $arr[$row->abbr]['price'] = $row->price;
            $arr[$row->abbr]['old_price'] = $row->old_price;
        }
        return $arr;
    }
	public function showstate()
	{
	$query = $this->db->get('state_master');
        return $query->result();
	}
	public function fetchstate()
    {
        $this->db->select('*');
        $this->db->from('state_master');       
        $query = $this->db->get();
		return $query->result();
    }
	public function stateshow($state_id)
	{
		$this->db->select('*');
		$this->db->from('state_master');
		$this->db->where('state_id',$state_id);
		return $this->db->get()->result();
	}
	public function cityshow($city_id)
	{
		$this->db->select('*');
		$this->db->from('city_master');
		$this->db->join('state_master', 'state_master.state_id = city_master.state_id','inner');
		$this->db->where('city_id',$city_id);
		return $this->db->get()->result();
	}
	function update($data)
	{

		$this->db->set('state_name',$data['state_name']);	
        $this->db->where('state_id',$data['state_id']);
        return $this->db->update('state_master');
	}
	function updatecity($data)
	{
	
		$this->db->set('city_name',$data['city_name']);	
		$this->db->set('state_id',$data['state_id']);	
        $this->db->where('city_id',$data['city_id']);
        return $this->db->update('city_master');
	}
	public function fetchcity()
    {
        $this->db->select('*');
        $this->db->from('city_master'); 
		$this->db->join('state_master', 'state_master.state_id = city_master.state_id','inner');		
        $query = $this->db->get();
		return $query->result();
    }
	function deletestate($state_id)
	{
		$this->db->where('state_id',$state_id);
		$response=$this->db->delete('state_master');
	if($response==true)
	{
		return true;
	}
	else
	{
		return false;
}
}
function deletecity($city_id)
	{
		$this->db->where('city_id',$city_id);
		$response=$this->db->delete('city_master');
	if($response==true)
	{
		return true;
	}
	else
	{
		return false;
}
}
	public function fetchvendors($limit, $page)
    {
        $this->db->order_by('id', 'asc');
        $query = $this->db->select('*')->get('vendors', $limit, $page);
        return $query;
    }
	public function vendorcount()
	{
		  return $this->db->count_all_results('vendors');
	}
	public function setvendors($name,$email,$firm_name,$firm_address,$drug_licence,$fssai_no,$contact_no,$gst_number,$user_type)
    {
        if (!$this->db->insert('vendors', array(
                    'name' => $name,
                    'email' => $email,
                    'firm_name' => $firm_name,
                    'firm_address' => $firm_address,
                    'drug_licence' => $drug_licence,
                    'fssai_no' => $fssai_no,
                    'contact_no' => $contact_no,
                    'gst_number' => $gst_number,
                    'user_type' => $user_type)
                )) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }
	public function showvendors($id)
	{
		$this->db->select('*');
		$this->db->from('vendors');
		$this->db->where('id',$id);
		return $this->db->get()->result();
	}
	function deletevendors($id)
	{
		$this->db->where('id',$id);
		$response=$this->db->delete('vendors');
	if($response==true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
	function updatevendors($data)
	{

		$this->db->set('name',$data['name']);	
		$this->db->set('email',$data['email']);	
		$this->db->set('firm_name',$data['firm_name']);	
		$this->db->set('firm_address',$data['firm_address']);	
		$this->db->set('drug_licence',$data['drug_licence']);	
		$this->db->set('fssai_no',$data['fssai_no']);	
		$this->db->set('contact_no',$data['contact_no']);	
		$this->db->set('password',password_hash($data['password'],PASSWORD_DEFAULT));	
		$this->db->set('gst_number',$data['gst_number']);
		$this->db->set('user_type',$data['user_type']);
        $this->db->where('id',$data['id']);
        return $this->db->update('vendors');
	}
	function updatevendorsststus($data)
	{

		$this->db->set('status',$data['status']);	
		$this->db->where('id',$data['id']);
        return $this->db->update('vendors');
	}
	public function fetchvendorsproduct()
    {
        $this->db->select('*');
        $this->db->from('products'); 
        $query = $this->db->get();
		return $query->result();
    }
	public function vendoremailid($id = null)
	{
		$this->db->where('id',"$id");
		$this->db->select('name,email,status');
        $this->db->from('vendors'); 
        $query = $this->db->get();
		return $query->result();
	}

}
