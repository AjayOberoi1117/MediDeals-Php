<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->Model('admin/Brands_model');
		
    }

    public function index($page = 0)
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('home');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $all_categories = $this->Public_model->getShopCategories();
		

        /*
         * Tree Builder for categories menu
         */

        function buildTree(array $elements, $parentId = 0)
        {
            $branch = array();
            foreach ($elements as $element) {
                if ($element['sub_for'] == $parentId) {
                    $children = buildTree($elements, $element['id']);
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
            return $branch;
        }

        $data['home_categories'] = $tree = buildTree($all_categories);
        $data['all_categories'] = $all_categories;
        $data['countQuantities'] = $this->Public_model->getCountQuantities();
        $data['bestSellers'] = $this->Public_model->getbestSellers();
		$data['getMostDiscounted'] = $this->Public_model->getMostDiscounted();
        $data['newProducts'] = $this->Public_model->getNewProducts();
		$data['randomProducts'] = $this->Public_model->getRandomProducts();
        $data['sliderProducts'] = $this->Public_model->getSliderProducts();
        $data['lastBlogs'] = $this->Public_model->getLastBlogs();
        $data['products'] = $this->Public_model->getProducts($this->num_rows, $page, $_GET);
        $rowscount = $this->Public_model->productsCount($_GET);
        $data['shippingOrder'] = $this->Home_admin_model->getValueStore('shippingOrder');
        $data['showOutOfStock'] = $this->Home_admin_model->getValueStore('outOfStock');
        $data['showBrands'] = $this->Home_admin_model->getValueStore('showBrands');
        $data['brands'] = $this->Brands_model->getBrands();
        $data['links_pagination'] = pagination('home', $rowscount, $this->num_rows);
        @$this->render('home', $head, $data);
    }

    /*
     * Called to add/remove quantity from cart
     * If is ajax request send POST'S to class ShoppingCart
     */
	 
	 
	public function vendor($vendor_name)
    {
	$this->load->library("pagination");
	    $config = array();
 
       $config["base_url"] = base_url() . "home/vendor/".$vendor_name.'/'; 
 
       $config["per_page"] = 10;
	   $config["total_rows"] = $this->Public_model->singleVendorProductsnum_rows($vendor_name);
 
       $config["uri_segment"] = 4;
	   
	   $choice = $config['total_rows'] / $config['per_page'];
       $config['num_links'] = round($choice); 
 
       $this->pagination->initialize($config);
        $data = array();
        $head = array();
        //$data['product'] = $this->Public_model->getOneProduct($id);
		//echo $data['count'] = $this->Public_model->singleVendorProductsnum_rows($vendor_name);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data['ListVendorProduct'] = $this->Public_model->singleVendorProducts($config["per_page"],$page,$vendor_name);
		$data['pagination'] = $this->pagination->create_links();
        //print_r($data['ListcategoryProduct']);
        
        $head['title'] = $vendor_name;
        $description = url_title(character_limiter($vendor_name, 130));
        $description = str_replace("-", " ", $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = str_replace(" ", ",", $vendor_name);
        @$this->render('vendor_products', $head, $data);
    }
	 
	 

    public function manageShoppingCart()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $this->shoppingcart->manageShoppingCart();
    }

    /*
     * Called to remove product from cart
     * If is ajax request and send $_GET variable to the class
     */

    public function removeFromCart()
    {
        $backTo = $_GET['back-to'];
        $this->shoppingcart->removeFromCart();
        $this->session->set_flashdata('deleted', lang('deleted_product_from_cart'));
        redirect(LANG_URL . '/' . $backTo);
    }

    public function clearShoppingCart()
    {
        $this->shoppingcart->clearShoppingCart();
    }
	
	
	public function load_city()
	{
		if(@$_POST['id'] != null)
			{
				//var_dump($_POST['id']);die();
				$city = $this->Public_model->city($_POST['id']);
				//print_r($data['city']);die;
				
				?>
				<select name="city" id="city_new" required style="display: block !important">
				<option value="0">Select</option>
				<?php
					foreach($city as $cl){
				?>
					<option value="<?=$cl['name']?>"><?=$cl['name']?></option>
				<?php }
				?>				
				</select>	
				<?php 
			}	
	}
	
	public function category($category = null)
    {		
		
		if($category == 1 || $category == 2 || $category == 3)
		{
			$data = array();
			$head = array();
			
			$data['fetchbrand'] = $this->Public_model->fetchbranddata();
			$data['states'] = $this->Public_model->state();
			$data['category'] = $category;
			$this->load->library('pagination');
			
			$head['title'] = 'category';
			$description = url_title(character_limiter(strip_tags('category'), 130));
			$description = str_replace("-", " ", $description) . '..';
			$head['description'] = $description;
			$head['keywords'] = str_replace(" ", ",", 'category');
			@$this->render('category_products', $head, $data);
		}
		else if ($category == 4 )
		{
			
			//echo $category;
			$data = array();
			$head = array();
			//$data['product'] = $this->Public_model->getOneProduct($id);
			$data['ListcategoryProduct'] = $this->Public_model->pcd_companies_data($category);
			//print_r($data['ListcategoryProduct']);die;
			
			$head['title'] = 'category';
			$description = url_title(character_limiter(strip_tags('category'), 130));
			$description = str_replace("-", " ", $description) . '..';
			$head['description'] = $description;
			$head['keywords'] = str_replace(" ", ",", 'category');
			@$this->render('pcd_companies', $head, $data);
		}	
		else if ($category == 5)
		{
			
			//echo $category;
			$data = array();
			$head = array();
			//$data['product'] = $this->Public_model->getOneProduct($id);
			$data['ListcategoryProduct'] = $this->Public_model->pcd_companies_data($category);
			//print_r($data['ListcategoryProduct']);die;
			
			$head['title'] = 'category';
			$description = url_title(character_limiter(strip_tags('category'), 130));
			$description = str_replace("-", " ", $description) . '..';
			$head['description'] = $description;
			$head['keywords'] = str_replace(" ", ",", 'category');
			@$this->render('thirdparty', $head, $data);
		}	
	}
	// filter
	public function filter()
	{
		if(@$_POST['sel_cat'] !== null)
			$category = $_POST['sel_cat'];
		//}
		//$data['ListcategoryProduct'] = $this->Public_model->singleCagegoryProducts(1);
		
		$result = $this->Public_model->singleCagegoryProducts($category);
		 
		foreach($result as $category){
			?>
			<div class="col-xs-6 col-sm-6 col-md-3 col-lg-4">
				<div class="product-block">
				    <?php if($category['shop_categorie'] == 3)
					{ ?>
					<a href="<?php echo base_url()?><?php echo $category['url'] ?>">
					<img src="<?= base_url('/attachments/shop_images/' . $category['image']) ?>">
					</a>
					<?php } ?>
					<a href="<?php echo base_url()?><?php echo $category['url'] ?>">
						<div class="product-detail">
						   <h6><?= substr($category['title'], 0, 18) ?></h6>                                       
							<span class="sale-price">
							<span class="reg-price pull-right"><?php echo CURRENCY.' ' ?><?= $category['old_price'];?></span>
								<?php echo CURRENCY.' ' ?><?= $category['price'];?></span>
						</div>
					</a>
					<div class="clearfix"></div>
						<div class="form-group">
							<span class="pull-center small">Discount! 
							<?php
								if ($category['old_price'] != '' && $category['old_price'] != 0) {
									$percent_friendly = number_format((($category['old_price'] - $category['price']) / $category['old_price']) * 100) . '%';
									?>
									<span class="blink_me"><?= $percent_friendly ?></span>
									<?php } ?> </span><span class="pull-right"><?=substr ($category['brand'],0,12);?></span>
									
											</div>
											
											<div class="clearfix"></div>
								<a href="<?php echo base_url()?><?php echo $category['url'] ?>"><button class="btn btn-default" name="buy-now" type="submit">Buy Now</button></a>
						</div>
						
					</div>
					
										
					<?php 
					}
				
		 //print_r($data);
	}
	 
	public function search()
	{
	//echo $_POST['search'];

	$data = array();
			$head = array();
			//$data['product'] = $this->Public_model->getOneProduct($id);
			@$data['search'] = $this->Public_model->search_products();
			//print_r($data['search']);
			//exit;
			$head['title'] = 'Search';
			$description = url_title(character_limiter(strip_tags('Search'), 130));
			$description = str_replace("-", " ", $description) . '..';
			$head['description'] = $description;
			$head['keywords'] = str_replace(" ", ",", 'Sear h');
			@$this->render('category_products', $data);
	}
		public function viewpcd_companies($pcd_id)
		{
			
			$data = array();
				$head = array();
				//$data['product'] = $this->Public_model->getOneProduct($id);
				$data['viewpcd_companies'] = $this->Public_model->viewpcd_companies($pcd_id);
				//print_r($data['ListcategoryProduct']);
			    //echo "<pre>";print_r($data['viewpcd_companies'] );die;
				//exit;
				$head['title'] = 'viewpcd companies';
				$description = url_title(character_limiter(strip_tags('Search'), 130));
				$description = str_replace("-", " ", $description) . '..';
				$head['description'] = $description;
				$head['keywords'] = str_replace(" ", ",", 'Sear h');
				@$this->render('viewpcd_companies', $head, $data);
		}
			
	public function viewthirdparty($Thirdparty_id)
		{
			
			$data = array();
				$head = array();
				//$data['product'] = $this->Public_model->getOneProduct($id);
				$data['viewthirdparty'] = $this->Public_model->viewthirdparty($Thirdparty_id);
				
				//print_r($data['ListcategoryProduct']);
			    //echo "<pre>";print_r($data['viewpcd_companies'] );die;
				//exit;
				$head['title'] = 'viewthirdparty';
				$description = url_title(character_limiter(strip_tags('Search'), 130));
				$description = str_replace("-", " ", $description) . '..';
				$head['description'] = $description;
				$head['keywords'] = str_replace(" ", ",", 'Sear h');
				@$this->render('viewthirdparty', $head, $data);
		}
			

    public function viewProduct($id)
    {
        $data = array();
        $head = array();
        $data['product'] = $this->Public_model->getOneProduct($id);
		$data['product_city'] = $this->Public_model->getOneProductcity($id);
		//print_r($data['product_city']);
		//exit;
        $data['sameCagegoryProducts'] = $this->Public_model->sameCagegoryProducts($data['product']['shop_categorie'], $id, $data['product']['vendor_id']);
        if ($data['product'] === null) {
            show_404();
        }
        $vars['publicDateAdded'] = $this->Home_admin_model->getValueStore('publicDateAdded');
        $this->load->vars($vars);
        $head['title'] = $data['product']['title'];
        $description = url_title(character_limiter(strip_tags($data['product']['description']), 130));
        $description = str_replace("-", " ", $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = str_replace(" ", ",", $data['product']['title']);
        @$this->render('view_product', $head, $data);
    }

    public function confirmLink($md5)
    {
        if (preg_match('/^[a-f0-9]{32}$/', $md5)) {
            $result = $this->Public_model->confirmOrder($md5);
            if ($result === true) {
                $data = array();
                $head = array();
                $head['title'] = '';
                $head['description'] = '';
                $head['keywords'] = '';
                $this->render('confirmed', $head, $data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function discountCodeChecker()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        $result = $this->Public_model->getValidDiscountCode($_POST['enteredCode']);
        if ($result == null) {
            echo 0;
        } else {
            echo json_encode($result);
        }
    }

    public function sitemap()
    {
        header("Content-Type:text/xml");
        echo '<?xml version="1.0" encoding="UTF-8"?>
                <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $products = $this->Public_model->sitemap();
        $blogPosts = $this->Public_model->sitemapBlog();

        foreach ($blogPosts->result() as $row1) {
            echo '<url>

      <loc>' . base_url('blog/' . $row1->url) . '</loc>

      <changefreq>monthly</changefreq>

      <priority>0.1</priority>

   </url>';
        }

        foreach ($products->result() as $row) {
            echo '<url>

      <loc>' . base_url($row->url) . '</loc>

      <changefreq>monthly</changefreq>

      <priority>0.1</priority>

   </url>';
        }

        echo '</urlset>';
    }
	
	public function about()
	{
	$head['title'] = 'About Us';
        $description = 'About Us';
        $description = str_replace("-", " ", $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = 'About Us';
        $this->render('about', $head);
		

	
	}
	
	public function faq()
	{
	$head['title'] = 'Faq';
        $description = 'Faq';
        $description = str_replace("-", " ", $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = 'Faq';
        $this->render('faq', $head);
		

	
	}
	public function Savestate()
	{
		$name=$_POST['name'];
		$email=$_POST['email'];
		$contact=$_POST['contact'];
		$message=$_POST['message'];
		
		$data = array(
				   'name' => $name,
				   'email' => $email,
				   'contact' => $contact,
				   'message' => $message
				  
				);
		//var_dump($data);die;
		if($this->db->insert('enquiry_form', $data))
		{
			$this->popup_email($data);	
			redirect('/');

		}
	}
	public function login()
	{
		$data = array();
		$head = array();
        $head['title'] = 'login';
        $description = url_title(character_limiter(strip_tags('login'), 130));
        $description = str_replace("-", " ", $description) . '..';
        $head['description'] = $description;
        $head['keywords'] = str_replace(" ", ",", 'Sear h');
        $this->render('login', $head, $data);
	}
	public function verifyemail($token,$time)
	{		
		// activate login
		$result = $this->Public_model->verifyemail1($token,$time);
		if($result == true){
		echo "<script type='text/javascript'>alert('Your email is verified. We will notify you once we verify all your details. Then you can simply login to the portal to start trading.');
		window.location='".base_url()."vendor/login';</script>";
		}
		else{
		echo "<script type='text/javascript'>alert('Your email verification link is expired contact Administrator.');
		window.location='".base_url()."';</script>";
		}
	}
	public function popup_email($data)
	{
		$this->load->library('email');
	
		$message = "Dear Admin, <br>";
		$message .= "You received a popup inquiry <br>";
		$message .= "Inquiry Details: <br>";
		$message .= "Name : ".$data['name']. " <br>";
		$message .= "Email : ".$data['email']. " <br>";
		$message .= "Contact Number : ".$data['contact']. " <br>";
		$message .= "Message : ".$data['message']. " <br><br>";
		$message .= "Warm Regards <br>";
		$message .= "Medideals Team <br>";
	
		//$this->email->initialize($config);
		// Sender email address
		$this->email->from('info@medideals.co.in', 'Medideals Team');
		// Receiver email address.for single email
		$this->email->to('support@medideals.co.in');
		// Subject of email
		$this->email->subject("Popup inquiry received");
		// Message in email		
		$this->email->message($message);
		//Send mail 
		if($this->email->send()) 
		{
			//return true;
		} 
		else 
		{
			//return false;
		} 
		
	}
	public function aboutus()
		{
			
			$data = array();
				$head = array();
				
				$head['title'] = 'About Us';
				$description = url_title(character_limiter(strip_tags('Search'), 130));
				$description = str_replace("-", " ", $description) . '..';
				$head['description'] = $description;
				$head['keywords'] = str_replace(" ", ",", 'Sear h');
				@$this->render('aboutus', $head, $data);
		}
	public function termscondition()
		{
			
			$data = array();
				$head = array();
				
				$head['title'] = 'Terms condition';
				$description = url_title(character_limiter(strip_tags('Search'), 130));
				$description = str_replace("-", " ", $description) . '..';
				$head['description'] = $description;
				$head['keywords'] = str_replace(" ", ",", 'Sear h');
				@$this->render('termscondition', $head, $data);
		}
	public function intellectual_property()
		{
			
			$data = array();
				$head = array();
				
				$head['title'] = 'Intellectual Property Rights';
				$description = url_title(character_limiter(strip_tags('Search'), 130));
				$description = str_replace("-", " ", $description) . '..';
				$head['description'] = $description;
				$head['keywords'] = str_replace(" ", ",", 'Sear h');
				@$this->render('intellectualpropertyrights', $head, $data);
		}	

}
