<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Orders extends ADMIN_Controller
{

    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('SendMail');
        $this->load->model(array('Orders_model', 'Home_admin_model'));
    }

    public function index($page = 0)
    {
        $this->login_check();
        $data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - Orders';
        $head['description'] = '!';
        $head['keywords'] = '';

        $order_by = null;
        if (isset($_GET['order_by'])) {
            $order_by = $_GET['order_by'];
        }
        $rowscount = $this->Orders_model->ordersCount();
        $data['orders'] = $this->Orders_model->orders($this->num_rows, $page, $order_by);
		
		// add edit docket number
		if(isset($_POST['dktsub']))
		{
			$this->Orders_model->updatedocketno($_POST['vdrid'],$_POST['odrid'],$_POST['productid'],$_POST['dktno']);
			
			// send email to customer
			
			$docketdetails = $this->Orders_model->customeremaildocket($_POST['vdrid'],$_POST['odrid'],$_POST['productid']);
			
			// shoot email
			$res = $this->customerdocketemail($docketdetails); 
			if($res == true)
				echo "<script type='text/javascript'>alert('We have sent an email');</script>";
			else
				echo "<script type='text/javascript'>alert('We are facing trouble in sending email. Kindly contact Admin.');</script>";
			
		}
		// order status
		if(isset($_POST['odrsub']))
		{
			$this->Orders_model->updateodrstatus($_POST['vdrid'],$_POST['odrid'],$_POST['productid'],$_POST['odrstatus']);
			
			// send email to customer
			
			$orderdetails = $this->Orders_model->customeremailorder($_POST['vdrid'],$_POST['odrid'],$_POST['productid']);
			
			// shoot email
			$res = $this->customerorderemail($orderdetails); 
			if($res == true)
				echo "<script type='text/javascript'>alert('We have sent an email');</script>";
			else
				echo "<script type='text/javascript'>alert('We are facing trouble in sending email. Kindly contact Admin.');</script>";
		}
		
		// wholeseller money status
		if(isset($_POST['whmonsub']))
		{
			$this->Orders_model->updatewholesellermoney($_POST['vdrid'],$_POST['odrid'],$_POST['productid'],$_POST['whmonstatus']);
			
			// send email to customer	
			$whlslrmnydetails = $this->Orders_model->wholesaleremailmoney($_POST['vdrid'],$_POST['odrid'],$_POST['productid']);
			
			// shoot email
			$res = $this->wholesellermoneyemail($whlslrmnydetails); 
			if($res == true)
				echo "<script type='text/javascript'>alert('We have sent an email');</script>";
			else
				echo "<script type='text/javascript'>alert('We are facing trouble in sending email. Kindly contact Admin.');</script>";
		}
		
		$rt = 0;
		foreach($data['orders'] as $orders)
		{
			$data['vendor_order'][$rt] = $this->Orders_model->vendororder($orders["order_id"]);
			$rt++;
		}
		
        $data['links_pagination'] = pagination('admin/orders', $rowscount, $this->num_rows, 3);
        if (isset($_POST['paypal_sandbox'])) {
            $this->Home_admin_model->setValueStore('paypal_sandbox', $_POST['paypal_sandbox']);
            if ($_POST['paypal_sandbox'] == 1) {
                $msg = 'Paypal sandbox mode activated';
            } else {
                $msg = 'Paypal sandbox mode disabled';
            }
            $this->session->set_flashdata('paypal_sandbox', $msg);
            $this->saveHistory($msg);
            redirect('admin/orders?settings');
        }
        if (isset($_POST['paypal_email'])) {
            $this->Home_admin_model->setValueStore('paypal_email', $_POST['paypal_email']);
            $this->session->set_flashdata('paypal_email', 'Public quantity visibility changed');
            $this->saveHistory('Change paypal business email to: ' . $_POST['paypal_email']);
            redirect('admin/orders?settings');
        }
        if (isset($_POST['paypal_currency'])) {
            $this->Home_admin_model->setValueStore('paypal_currency', $_POST['paypal_currency']);
            $this->session->set_flashdata('paypal_currency', 'Public quantity visibility changed');
            $this->saveHistory('Change paypal currency to: ' . $_POST['paypal_currency']);
            redirect('admin/orders?settings');
        }
        if (isset($_POST['cashondelivery_visibility'])) {
            $this->Home_admin_model->setValueStore('cashondelivery_visibility', $_POST['cashondelivery_visibility']);
            $this->session->set_flashdata('cashondelivery_visibility', 'Cash On Delivery Visibility Changed');
            $this->saveHistory('Change Cash On Delivery Visibility - ' . $_POST['cashondelivery_visibility']);
            redirect('admin/orders?settings');
        }
        if (isset($_POST['iban'])) {
            $this->Orders_model->setBankAccountSettings($_POST);
            $this->session->set_flashdata('bank_account', 'Bank account settings saved');
            $this->saveHistory('Bank account settings saved for : ' . $_POST['name']);
            redirect('admin/orders?settings');
        }
        $data['paypal_sandbox'] = $this->Home_admin_model->getValueStore('paypal_sandbox');
        $data['paypal_email'] = $this->Home_admin_model->getValueStore('paypal_email');
        $data['paypal_currency'] = $this->Home_admin_model->getValueStore('paypal_currency');
        $data['cashondelivery_visibility'] = $this->Home_admin_model->getValueStore('cashondelivery_visibility');
        $data['bank_account'] = $this->Orders_model->getBankAccountSettings();
        
		//var_dump($data); die;
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/orders', $data);
        $this->load->view('_parts/footer');
        if ($page == 0) {
            $this->saveHistory('Go to orders page');
        }
    }

    public function changeOrdersOrderStatus()
    {
        $this->login_check();

        $result = false;
        $sendedVirtualProducts = true;
        $virtualProducts = $this->Home_admin_model->getValueStore('virtualProducts');
        /*
         * If we want to use Virtual Products
         * Lets send email with download links to user email
         * In error logs will be saved if cant send email from PhpMailer
         */
        if ($virtualProducts == 1) {
            if ($_POST['to_status'] == 1) {
                $sendedVirtualProducts = $this->sendVirtualProducts();
            }
        }

        if ($sendedVirtualProducts == true) {
            $result = $this->Orders_model->changeOrderStatus($_POST['the_id'], $_POST['to_status']);
        }

        if ($result == true && $sendedVirtualProducts == true) {
            echo 1;
        } else {
            echo 0;
        }
        $this->saveHistory('Change status of Order Id ' . $_POST['the_id'] . ' to status ' . $_POST['to_status']);
    }


    public function changeMoneyStatus()
    {
	
        $this->login_check();

		if($_POST['monsub'] != "")
		{
			$result = $this->Orders_model->changemoneyOrderStatus($_POST['odriid'], $_POST['moneystat']);
			
			// send email to client
			$customerinfo = $this->Orders_model->changemoneyOrderStatusemail($_POST['odriid']);
			
			$this->customer_email($customerinfo);	
			
			//$this->saveHistory('Change status of Order Id ' . $id . ' to status ' . $status);
			
			redirect(LANG_URL . '/admin/orders');
		}
    }




    private function sendVirtualProducts()
    {

        $products = unserialize(html_entity_decode($_POST['products']));
        foreach ($products as $product_id => $product_quantity) {
            $productInfo = modules::run('admin/ecommerce/products/getProductInfo', $product_id);
            /*
             * If is virtual product, lets send email to user
             */
            if ($productInfo['virtual_products'] != null) {
                if (!filter_var($_POST['userEmail'], FILTER_VALIDATE_EMAIL)) {
                    log_message('error', 'Ivalid customer email address! Cant send him virtual products!');
                    return false;
                }
                $result = $this->sendmail->sendTo($_POST['userEmail'], 'Dear Customer', 'Virtual products', $productInfo['virtual_products']);
                return $result;
            }
        }
        return true;
    }
		public function customerdocketemail($data)
	{
		$this->load->library('email');

			$total = floatval($data['order_quantity']) * floatval(str_replace(',','',$data['individual_price']));
			
			$message = "Dear Customer, <br>";
			$message .= "Product Shipping for Order ID : ".$data['order_id']."<br>";
			$message .= "Shipping Details: ".$data['docket_number']. " <br>";
			$message .= "Item Name: ".$data['title']. "<br>";
			$message .= "Ordered Quantity: ".$data['order_quantity']. "<br>";
			$message .= "Individual Item Price: Rs. ".$data['individual_price']. "<br>";
			$message .= "Total Item Price: Rs. ".number_format($total, 2, '.', ''). "<br><br>";
			$message .= "Kindly go to the Order Placed section in your dashboard for more details. <br> If you have any queries with the Order Email us at : support@medideals.co.in <br>";
			$message .= "Warm Regards <br>";
			$message .= "Medideals Team <br>";
	
			//$this->email->initialize($config);
			// Sender email address
			$this->email->from('support@medideals.co.in', 'Medideals Team');
			// Receiver email address
			$this->email->to(array($data["client_email"],$data['wholesaler_email'],'support@medideals.co.in'));
			// Subject of email
			$this->email->subject("Shipping Information from Medideals for Order : " .$data['order_id']);
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
	public function customerorderemail($data)
	{
		$this->load->library('email');

		$total = floatval($data['order_quantity']) * floatval(str_replace(',','',$data['individual_price']));
			
		$message = "Dear Customer, <br>";
		$message .= "Order Status for Order ID : ".$data['order_id']."<br>";
			
		if($data["orders_status"] == 0)
		{ $message .= "Order Status : Confirmation Pending <br>";}
		elseif($data["orders_status"] == 1)
		{ $message .= "Order Status : Order Confirmed  <br>";}
		elseif($data["orders_status"] == 2)
		{ $message .= "Order Status : Order Shipped  <br>";}
		elseif($data["orders_status"] == 3)
		{ $message .= "Order Status : Order Delivered  <br>";}
		elseif($data["orders_status"] == 4)
		{ $message .= "Order Status : Order Returned  <br>";}
		elseif($data["orders_status"] == 5)
		{ $message .= "Order Status : Order Canceled  <br>";}
		else
		{ $message .= "Order Status : Error <br>";}
			
		$message .= "Item Name: ".$data['title']. "<br>";
		$message .= "Ordered Quantity: ".$data['order_quantity']. "<br>";
		$message .= "Individual Item Price: Rs. ".$data['individual_price']. "<br>";
		$message .= "Total Item Price: Rs. ".number_format($total, 2, '.', ''). "<br><br>";
		$message .= "Kindly go to the Orders section in your dashboard for more details. <br> If you have any queries with the Order Email us at : support@medideals.co.in <br>";
		$message .= "Warm Regards <br>";
		$message .= "Medideals Team <br>";
	
		//$this->email->initialize($config);
		// Sender email address
		$this->email->from('support@medideals.co.in', 'Medideals Team');
		// Receiver email address
		$this->email->to(array($data["client_email"],$data['wholesaler_email'],'support@medideals.co.in'));
		// Subject of email
		$this->email->subject("Order Status from Medideals for Order : " .$data['order_id']);
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
	public function wholesellermoneyemail($data)
	{
		$this->load->library('email');

		$total = floatval($data['order_quantity']) * floatval(str_replace(',','',$data['individual_price']));
			
		$message = "Dear Wholesaler, <br>";
		$message .= "Payment Status for Order ID : ".$data['order_id']."<br>";
			
		if($data["money_status"] == 0)
		{ $message .= "Payment Status : Pending from Customer side <br>";}
		elseif($data["money_status"] == 1)
		{ $message .= "Payment Status : Received in Escrow Account <br>";}
		elseif($data["money_status"] == 2)
		{ $message .= "Payment Status : Transferred to Wholesaler  <br>";}
		elseif($data["money_status"] == 3)
		{ $message .= "Payment Status : Returned to Customer  <br>";}
		else
		{ $message .= "Payment Status : Error <br>";}
			
		$message .= "Item Name: ".$data['title']. "<br>";
		$message .= "Ordered Quantity: ".$data['order_quantity']. "<br>";
		$message .= "Individual Item Price: Rs. ".$data['individual_price']. "<br>";
		$message .= "Total Item Price: Rs. ".number_format($total, 2, '.', ''). "<br><br>";
		$message .= "Kindly go to the Orders section in your dashboard for more details. <br> If you have any queries with the Order Email us at : support@medideals.co.in <br>";
		$message .= "Warm Regards <br>";
		$message .= "Medideals Team <br>";
	
		//$this->email->initialize($config);
		// Sender email address
		$this->email->from('support@medideals.co.in', 'Medideals Team');
		// Receiver email address
		$this->email->to(array($data['wholesaler_email'],'support@medideals.co.in'));
		// Subject of email
		$this->email->subject("Money Status from Medideals for Order : " .$data['order_id']);
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
	public function customer_email($data)
	{
		$this->load->library('email');
		if($data['money_status'] == 2)
		{}
		else{	
		$message = "Dear Customer, <br>";
		$message .= "Payment Status for Order ID : ".$data['order_id']."<br>";
			
		if($data["money_status"] == 0)
		{ $message .= "Payment Status : Pending from Customer side <br>";}
		elseif($data["money_status"] == 1)
		{ $message .= "Payment Status : Received in Escrow Account <br>";}
		elseif($data["money_status"] == 2)
		{ $message .= "Payment Status : Transferred to Wholesaler  <br>";}
		elseif($data["money_status"] == 3)
		{ $message .= "Payment Status : Returned to Customer  <br>";}
		else
		{ $message .= "Payment Status : Error <br>";}
			
		$message .= "Total Amount Received : Rs. ".$data['final_amount']. "<br><br>";
		$message .= "Kindly go to the Orders section in your dashboard for more details. <br> If you have any queries with the Order Email us at : support@medideals.co.in <br>";
		$message .= "Warm Regards <br>";
		$message .= "Medideals Team <br>";
	
		//$this->email->initialize($config);
		// Sender email address
		$this->email->from('support@medideals.co.in', 'Medideals Team');
		// Receiver email address
		$this->email->to(array($data['customer_email'],'support@medideals.co.in'));
		// Subject of email
		$this->email->subject("Money Status from Medideals for Order : " .$data['order_id']);
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
	}
}
