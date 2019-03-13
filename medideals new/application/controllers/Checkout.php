<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends MY_Controller
{

    private $orderId;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('currency_convertor'));
        $this->load->model('admin/Orders_model');
		$this->load->library('email');
    }

    public function index()
    {
		//SESSION_UNSET(@$key);
		if(@$_SESSION['vendor_user'] == NULL)
		{
			redirect('vendor/login?key=2');
		}
		else{
			$data = array();
			$head = array();
			$arrSeo = $this->Public_model->getSeo('checkout');
			$head['title'] = @$arrSeo['title'];
			$head['description'] = @$arrSeo['description'];
			$head['keywords'] = str_replace(" ", ",", $head['title']);

			if (isset($_POST['payment_type'])) 
			{
				$errors = $this->userInfoValidate($_POST);
				if (!empty($errors)) {
					$this->session->set_flashdata('submit_error', $errors);
				} else {
					$_POST['referrer'] = $this->session->userdata('referrer');
					$_POST['clean_referrer'] = cleanReferral($_POST['referrer']);
					$orderId = $this->Public_model->setOrder($_POST);
				
					if ($orderId != false) {
						/*
						 * Save product orders in vendors profiles
						$this->setVendorOrders();*/
						
						// send order email to customer
						$email_result = $this->customer_order_email($orderId);
						
						// send order email to whole sellers
						$this->vendor_order_email($orderId);
				
						$this->orderId = $orderId;
						// deleting shopping cart data after insertion
						
						unset($_SESSION['shopping_cart']);
						unset($_SESSION['cart']);
						@set_cookie('shopping_cart', '', time()-1000);
						@set_cookie('cart', '', time()-1000);
						
						?><script type = 'text/javascript'>
				  alert('We have received your order successfully. Your Order No. is   #<?php echo $this->orderId; if($email_result == true){echo "  We have sent you an email. Please check your Inbox or Spam folder. Please read the instructions carefully";}else{echo " Email delivery is failed, kindly check the Dashboard for order details.";}?> We will contact you shortly with confirmation');
				  </script>
				  <?php
						//$this->setActivationLink();
						//$this->goToDestination();
						//$this->Update_quantity();
						?>
				  <script type = 'text/javascript'>
				  window.location.href = "<?php echo base_url() ?>payment-information/";
				  </script>
				  <?php
					}
					else
					{
						
						?>
				  <script type = 'text/javascript'>
				  alert('There is an error in placing Order please contact Adminstrator');
				  </script>
				  <?php
						$this->session->set_flashdata('order_error', true);
						//unset($_SESSION['shopping_cart']);
						//unset($_SESSION['cart']);
						//@set_cookie('cart', '', time()-1000);
						//var_dump($_SESSION); echo "<br><br>";
						//var_dump($_COOKIE); die; exit;
				  ?>
				  <script type = 'text/javascript'>
				  window.location.href = "<?php echo base_url() ?>vendor/me";
				  </script>
				  <?php
					}
				}
				
				//echo $this->email->print_debugger();die;
			}
			$data['bank_account'] = $this->Orders_model->getBankAccountSettings();
			$data['cashondelivery_visibility'] = $this->Home_admin_model->getValueStore('cashondelivery_visibility');
			$data['paypal_email'] = $this->Home_admin_model->getValueStore('paypal_email');
			$data['bestSellers'] = $this->Public_model->getbestSellers();
			$data['checkoutdata'] = $this->Public_model->checkoutdata($_SESSION['vendor_user']);
			// last element added category
			$en_element = array();
			$en_element = end($_SESSION['shopping_cart']);
			$data['cat_link'] = $this->Public_model->cate_lastele($en_element); 
			@$this->render('checkout', $head, $data);
		}
    }

    private function setVendorOrders()
    {
		//var_dump($_POST);die;
        //$this->Public_model->setVendorOrder($_POST);
		//echo $qtyupdate = $this->Public_model->Update_qty_vendor();
    }

    private function setActivationLink()
    {
        if ($this->config->item('send_confirm_link') === true) {
            $link = md5($this->orderId . time());
            $result = $this->Public_model->setActivationLink($link, $this->orderId);
            if ($result == true) {
                $url = parse_url(base_url());
                $msg = lang('please_confirm') . base_url('confirm/' . $link);
                //$this->sendmail->sendTo($_POST['email'], $_POST['first_name'] . ' ' . $_POST['last_name'], lang('confirm_order_subj') . $url['host'], $msg);
            }
        }
    }

    private function goToDestination()
    {
        if ($_POST['payment_type'] == 'cashOnDelivery' || $_POST['payment_type'] == 'Bank') {
            $this->shoppingcart->clearShoppingCart();
            $this->session->set_flashdata('success_order', true);
        }
        if ($_POST['payment_type'] == 'Bank') {
            $_SESSION['order_id'] = $this->orderId;
            $_SESSION['final_amount'] = $_POST['final_amount'] . $_POST['amount_currency'];
            redirect(LANG_URL . '/checkout/successbank');
        }
        if ($_POST['payment_type'] == 'cashOnDelivery') {
			
			  unset($_SESSION['shopping_cart']);
			  unset ($_COOKIE['shopping_cart']);
			  //@delete_cookie('shopping_cart');
			  //var_dump($_SESSION['shopping_cart']); die;
		
			?>
			  <script type = 'text/javascript'>
			  alert('We have received your order successfully. We will contact you soon with confirmation');
			  window.location.href = "<?php echo base_url() ?>vendor/me";
			  </script>
            <?php
			
        }
        if ($_POST['payment_type'] == 'PayPal') {
            @set_cookie('paypal', $this->orderId, 2678400);
            $_SESSION['discountAmount'] = $_POST['discountAmount'];
            redirect(LANG_URL . '/checkout/paypalpayment');
        }
    }

    private function userInfoValidate($post)
    {
        $errors = array();
       
        if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = lang('invalid_email');
        }
        $post['phone'] = preg_replace("/[^0-9]/", '', $post['phone']);
        if (mb_strlen(trim($post['phone'])) == 0) {
            $errors[] = lang('invalid_phone');
        }
        if (mb_strlen(trim($post['address'])) == 0) {
            $errors[] = lang('address_empty');
        }
       
        return $errors;
    }

    public function orderError()
    {
        if ($this->session->flashdata('order_error')) {
            $data = array();
            $head = array();
            $arrSeo = $this->Public_model->getSeo('checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = str_replace(" ", ",", $head['title']);
            @$this->render('checkout_parts/order_error', $head, $data);
        } else {
            redirect(LANG_URL . '/checkout');
        }
    }

    public function paypalPayment()
    {
        $data = array();
        $head = array();
        $arrSeo = $this->Public_model->getSeo('checkout');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
        $data['paypal_sandbox'] = $this->Home_admin_model->getValueStore('paypal_sandbox');
        $data['paypal_email'] = $this->Home_admin_model->getValueStore('paypal_email');
        $data['paypal_currency'] = $this->Home_admin_model->getValueStore('paypal_currency');
        $this->render('checkout_parts/paypal_payment', $head, $data);
    }

    public function successPaymentCashOnD()
    {
        if ($this->session->flashdata('success_order')) {
            $data = array();
            $head = array();
            $arrSeo = $this->Public_model->getSeo('checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = str_replace(" ", ",", $head['title']);
            $this->render('checkout_parts/payment_success_cash', $head, $data);
        } else {
            redirect(LANG_URL . '/checkout');
        }
    }

    public function successPaymentBank()
    {
        if ($this->session->flashdata('success_order')) {
            $data = array();
            $head = array();
            $arrSeo = $this->Public_model->getSeo('checkout');
            $head['title'] = @$arrSeo['title'];
            $head['description'] = @$arrSeo['description'];
            $head['keywords'] = str_replace(" ", ",", $head['title']);
            $data['bank_account'] = $this->Orders_model->getBankAccountSettings();
            $this->render('checkout_parts/payment_success_bank', $head, $data);
        } else {
            redirect(LANG_URL . '/checkout');
        }
    }

    public function paypal_cancel()
    {
        if (get_cookie('paypal') == null) {
            redirect(base_url());
        }
        @delete_cookie('paypal');
        $orderId = get_cookie('paypal');
        $this->Public_model->changePaypalOrderStatus($orderId, 'canceled');
        $data = array();
        $head = array();
        $head['title'] = '';
        $head['description'] = '';
        $head['keywords'] = '';
        $this->render('checkout_parts/paypal_cancel', $head, $data);
    }

    public function paypal_success()
    {
        if (get_cookie('paypal') == null) {
            redirect(base_url());
        }
        @delete_cookie('paypal');
        $this->shoppingcart->clearShoppingCart();
        $orderId = get_cookie('paypal');
        $this->Public_model->changePaypalOrderStatus($orderId, 'payed');
        $data = array();
        $head = array();
        $head['title'] = '';
        $head['description'] = '';
        $head['keywords'] = '';
        $this->render('checkout_parts/paypal_success', $head, $data);
    }
	/*private function Update_quantity()
	{
	
	}*/
	public function customer_order_email($orderId)
	{
		
		$this->load->library('email');
		$totalprice = 0.0;
		$subject = "Order successfully placed <b> $orderId </b>";
		$message = "Dear Customer, <br>";
		$message .= "Thank you for choosing Medideals.";
		$message .= "Your order is placed successfully.<br><br>";
		$message .= "Order Number :<b> $orderId </b><br>";
		$message .= "Order summary :<br>";
		foreach($_SESSION['cart'] as $cart)
		{
			$message .= "Item Name: ".$cart['title']. "<br>";
			$message .= "Ordered Quantity: ".$cart['num_added']. "<br>";
			$message .= "Individual Item Price: Rs. ".$cart['price']. "<br>";
			$message .= "Total Item Price: Rs. ".$cart['sum_price']. "<br><br>";
			$totalprice = $totalprice + floatval(str_replace(",","",$cart['sum_price']));
		}
		$message .= "<br>";
		$message .= "Total Amount: Rs. ".number_format($totalprice, 2, '.', '')." <br>";
		$message .= "<h3>Payment Instructions : </h3><br>
1. After placing your order you have to deposit the total amount to our bank account (details mentioned below) through any digital payment transfer mode(NEFT, IMPS, RTGS, UPI etc).

Bank Name:  XXXXXXXXXX

Account Holder’s Name: XXXXXXXXXX

Account no: XXXXXXXXXX

IFSC : XXXXXXXXXX

Branch Name: XXXXXXXXXX

<br>
2. After depositing the payment you have to acknowledge us about the payment sent along with payment details on our email at support@medideals.co.in.<br>

3. Without acknowledgment we cannot process your order further.<br>

4. After receiving payment from your side. We will send you an email regarding payment received.<br>

5. It will take us maximum 24 hours to acknowledge you about the payments after receiving your email. <br>

6. You can also check the Payment status in the order placed section of your dashboard. <br>

7. If you don't receive any acknowledgement email from our side or face any problem with orders email us your issue along with order status at support@medideals.co.in . <br>


<h3>Order Instructions : </h3><br>
1. The order placed by you will be verified by the seller and an order update email will be sent to you regarding the order status and so on.<br>

2. You can also check the order status in the order placed section of your dashboard. <br>

3. If you face any problem with orders email us your issue along with order status at support@medideals.co.in . <br>


<h3>Order Return & Refund Instructions : </h3><br>
1. If you receive an inappropriate or wrong order or consignment. Kindly send an email to us at support@medideals.co.in describing the same.<br>

2. You have to update order status in the order placed section of your dashboard.<br>

3. Once the order is received back in acceptable conditions. We will send you an acknowledgment email and process your refund.<br>

4. The refund will take 5 to 7 working days to reflected in your bank account.<br>

5. If you face any problem with order refund email us your issue along with order information at support@medideals.co.in .<br>";

		$message .= "We will shortly revert you with the confirmation. <br> If you have any queries with the Order Email us at : support@medideals.co.in <br>";
		$message .= "Warm Regards <br>";
		$message .= "Medideals Team <br>";
		$receiver_email = $_SESSION['logged_vendor'];	
		// Sender email address
		$this->email->from('info@medideals.co.in', 'Medideals Team');
		// Receiver email address.for single email
		$this->email->to($receiver_email);
		// Subject of email
		$this->email->subject($subject);
		// Message in email		
		$this->email->message($message);
		//Send mail 
		if($this->email->send()) 
		{
			return true;
		} 
		else 
		{
			return false;
		} 
	}
	public function vendor_order_email($orderId)
	{
		$this->load->library('email');
		
		foreach($_SESSION['cart'] as $cart)
		{
			$receiver_email = $this->Public_model->wholesaleremailbyid($cart['vendor_id']);		
			$message = "Dear Wholesaler, <br>";
			$message .= "You received an order : Order ID : $orderId <br>";
			$message .= "Order Details: <br>";
			$message .= "Item Name: ".$cart['title']. "<br>";
			$message .= "Ordered Quantity: ".$cart['num_added']. "<br>";
			$message .= "Individual Item Price: Rs. ".$cart['price']. "<br>";
			$message .= "Total Item Price: Rs. ".$cart['sum_price']. "<br><br>";
			$message .= "Kindly go to the Order receive section in your dashboard for more details & reply with confirmation or cancellation of order. <br> If you have any queries with the Order Email us at : support@medideals.co.in <br>";
			$message .= "Warm Regards <br>";
			$message .= "Medideals Team <br>";
	
			//$this->email->initialize($config);
			// Sender email address
			$this->email->from('info@medideals.co.in', 'Medideals Team');
			// Receiver email address.for single email
			$this->email->to($receiver_email["email"]);
			// Subject of email
			$this->email->subject("Order Received from Medideals ID: $orderId");
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
	}
	public function payment_information($refresh = 0)
	{
		$data = array();
        $head = array();
		
		unset($_SESSION['shopping_cart']);
		unset($_SESSION['cart']);
		// checkout later data delete
		$this->Public_model->checkoutlater_delete();
		
		@set_cookie('shopping_cart', '', time()-1000);
		@set_cookie('cart', '', time()-1000);
		if($refresh == 0)
			redirect('/payment-information/1');
		
        $arrSeo = $this->Public_model->getSeo('checkout');
        $head['title'] = @$arrSeo['title'];
        $head['description'] = @$arrSeo['description'];
        $head['keywords'] = str_replace(" ", ",", $head['title']);
		@$this->render('payment_information', $head, $data);
	}
}
