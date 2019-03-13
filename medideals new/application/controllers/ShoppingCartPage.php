<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ShoppingCartPage extends MY_Controller
{
	protected $CI;
    public $sumValues;
    /*
     * 1 month expire time
     */
    private $cookieExpTime = 2678400;
	
    public function __construct()
    {
        parent::__construct();
        $this->load->Model('Public_model');
		/*if (!isset($_SESSION['shopping_cart'])) {
                $_SESSION['shopping_cart'] = array();
            }
		if(isset($_COOKIE['shopping_cart'])){
		}
		else{
			if(@$_SESSION['vendor_user'] == NULL)
			{}
			else{
				$er = $this->Public_model->checkoutlater_fetch();
				$er1 = unserialize($er['cartdata']);
				var_dump($er1);
				var_dump($_SESSION['shopping_cart']);
				$_SESSION['shopping_cart'] = array_merge($_SESSION['shopping_cart'],$er1);
				var_dump($_SESSION['shopping_cart']);
			}
		}*/
    }

    public function index()
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('shoppingcart');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
		
		// last element added category
		$en_element = array();
		$en_element = @end($_SESSION['shopping_cart']);
		$data['cat_link'] = $this->Public_model->cate_lastele($en_element);
        @$this->render('cart', $head, $data);
    }
	public function checkout()
	{
		
		//echo $_SESSION['vendor_user']."hello";die;
		if(@$_SESSION['vendor_user']==""){
			
			redirect("vendor/login?key=2");
		}
		else{

			redirect("/checkout");
		}
		
	}
	public function cartlogin()
	{
		
		//echo $_SESSION['vendor_user']."hello";die;
		if(@$_SESSION['vendor_user']==""){
			
			redirect("vendor/login?key=3");
		}
		else{

			redirect("/index");
		}
		
	}
	// manage cart ajax
	public function changeqtybyajax()
    {
		$product_id = $_POST['product_id'];
		$new_quantity = $_POST['new_quantity'];
		$min_quantity = $_POST['min_quantity'];
		$max_quantity = $_POST['max_quantity'];
		
        if ($_POST['action'] == 'addqty') {
            if (!isset($_SESSION['shopping_cart'])) {
                $_SESSION['shopping_cart'] = array();
            }
			// deleting elements
			$tmp = array_count_values($_SESSION['shopping_cart']);
			$cnt = $tmp[$product_id];
			for($i = 0; $i < $cnt; $i++)
			{
				if (($key = array_search($product_id, $_SESSION['shopping_cart'])) !== false) {
					unset($_SESSION['shopping_cart'][$key]);
				}
			}
			// adding the product
			if($new_quantity > $min_quantity)
			{
				for($i = 0; $i < $new_quantity; $i++){
					@$_SESSION['shopping_cart'][] = $product_id;
				}
			}
			else{
				for($i = 0; $i < $min_quantity; $i++){
					@$_SESSION['shopping_cart'][] = $product_id;
				}
			}
        }
        if ($_POST['action'] == 'remove') {
            if (($key = array_search($_POST['article_id'], $_SESSION['shopping_cart'])) !== false) {
                unset($_SESSION['shopping_cart'][$key]);
            }
        }
        @set_cookie('shopping_cart', serialize($_SESSION['shopping_cart']), $this->cookieExpTime);

		$result = 0;
        if (!empty($_SESSION['shopping_cart'])) {
            $result = $this->getCartItems();
        }
		print_r($result['finalSum']);
        // get items from db and add him to cart products list from ajax
        //$loop = $this->CI->loop;
        //$loop::getCartItems($result);
    }
	
	public function getCartItems()
    {
		
        if ((!isset($_SESSION['shopping_cart']) || empty($_SESSION['shopping_cart'])) && get_cookie('shopping_cart') != NULL) {
            $_SESSION['shopping_cart'] = unserialize(get_cookie('shopping_cart'));
        } elseif (!isset($_SESSION['shopping_cart']) || !is_array($_SESSION['shopping_cart'])) {
            return 0;
        }
        $result['array'] = $this->Public_model->getShopItems(array_unique($_SESSION['shopping_cart']));
		
        if (empty($result['array'])) {
            unset($_SESSION['shopping_cart']);
            @delete_cookie('shopping_cart');
            return 0;
        }
        $count_articles = array_count_values($_SESSION['shopping_cart']);
        $this->sumValues = array_sum($count_articles);
        $finalSum = 0;
      

        foreach ($result['array'] as &$article) {
		
            $article['num_added'] = $count_articles[$article['id']];
			$i = $article['num_added'];
			
			for(;$i < $article['minquantity']; $i++)
			{
				@$_SESSION['shopping_cart'][] = (int) $article['id'];
			}
				
			
			if($article['num_added'] <= $article['minquantity'])
			{
				$article['num_added'] = $article['minquantity'];
			}
		
            $article['price'] = $article['price'] == '' ? 0 : str_replace(",","",$article['price']);
		
            $article['sum_price'] = str_replace(",","",$article['price']) * $count_articles[$article['id']];
			
            $finalSum = $finalSum + str_replace(",","",$article['sum_price']);
            $article['sum_price'] = number_format($article['sum_price'], 2,'.','');
		
            $article['price'] = $article['price'] != '' ? number_format($article['price'], 2,'.','') : 0;
		
        }
		
        $result['finalSum'] = round(number_format($finalSum, 2,'.',''));
		
        return $result;
    }
	public function ajaxmanagecart()
	{
		if (!isset($_SESSION['shopping_cart'])) {
                $_SESSION['shopping_cart'] = array();
            }
            @$_SESSION['shopping_cart'][] = (int) $_POST['product_id'];
			echo "Item added to the cart successfully";
	}
	public function checkoutlater()
	{
		$this->Public_model->checkoutlater_delete();
		$er = $this->Public_model->checkoutlater_insert();
		// set cookie for it
		@set_cookie('shopping_cart', serialize($_SESSION['shopping_cart']), $this->cookieExpTime);
		
		if($er){
			echo "Data successfully saved you can checkout later";
		}
		else{
			echo "Please try again";
		}
	}
	public function calccartitems()
	{
		$er = $_SESSION['shopping_cart'];
		foreach (array_keys($er, 0) as $key) {
			unset($er[$key]);
		}
		echo  count(array_count_values($er));
		//echo count($_SESSION['shopping_cart']);
	}
} 		
