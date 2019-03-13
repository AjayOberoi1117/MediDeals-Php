<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Orders extends VENDOR_Controller
{

    private $num_rows = 10;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Orders_model', 'Products_model'));
    }
	public function Save_docket($id)
	{
      $data = array();
        $head = array();
        $head['title'] = lang('vendor_orders');
        $head['description'] = lang('vendor_orders');
        $head['keywords'] = '';
		$data['docket_no'] = $this->Orders_model->View_docket($id);
		//print_r($data['docket_no']);
		$data['order_number'] = $id;
		//echo $data['week'];
        $this->load->view('_parts/header', $head);
        $this->load->view('add_docket',$data);
        $this->load->view('_parts/footer');

	}
	public function Save_docket_db()
	{
		$ordernumber=$this->input->post('order_id');
		$docketnumber=$this->input->post('docket_number');
		$data=array('docket_number'=>$docketnumber);
		$this->db->where('order_id',$ordernumber);
		if ($this->db->update('vendors_orders',$data))
		{
			 redirect('/vendor/orders', 'refresh');
		}

	}

    public function index($page = 0)
    {

        $data = array();
        $head = array();
        $head['title'] = lang('vendor_orders');
        $head['description'] = lang('vendor_orders');
        $head['keywords'] = '';
		$_SESSION['vendor_id']=$this->vendor_id;
		
		// add edit docket number
		// order status
		/*if(isset($_POST['odrsub']))
		{
			$this->Orders_model->updateodrstatus($this->vendor_id,$_POST['odrid'],$_POST['productid'],$_POST['odrstatus']);
			
			// send email to customer
			
			$orderdetails = $this->Orders_model->customeremailorder($this->vendor_id,$_POST['odrid'],$_POST['productid']);
			
			// shoot email
			$res = $this->customerorderemail($orderdetails); 
			if($res == true)
				echo "<script type='text/javascript'>alert('We have sent an email notification.');</script>";
			else
				echo "<script type='text/javascript'>alert('We are facing trouble in sending email notification. Kindly contact Admin.');</script>";
		}
		*/
        $rowscount = $this->Orders_model->ordersCount($this->vendor_id);
        $data['orders'] = $this->Orders_model->orders($this->num_rows, $page, $this->vendor_id);
		 $data['links_pagination'] = pagination('vendor/orders', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		$i = 0;
		foreach($data['orders'] as $order)
		{
			$data['productdetails'][$i] = $this->getProductInfo($order['products'],$this->vendor_id);
			$data['productinfo'][$i] = $this->Orders_model->product_info($order['products']);
			$i++;
		}
		$data['monthorders'] = $this->Orders_model->month_orders($this->vendor_id);
		//$_SESSION['totalmonthorder']=$data['monthorders'];
		//var_dump($data['monthorders']);die;
		$data['today'] = $this->Orders_model->todayorders($this->vendor_id);
		$data['week'] = $this->Orders_model->todayorders($this->vendor_id);
		
        $this->load->view('_parts/header', $head);
        $this->load->view('orders', $data);
        $this->load->view('_parts/footer');
    }
	public function customer_orders($page = 0)
	{

			$data = array();
			$head = array();
			$head['title'] = 'Customer Order';
			$head['description'] = 'Customer Order';
			$head['keywords'] = '';
			 $rowscount = $this->Orders_model->custimerordersCount($_SESSION['logged_vendor']);
			$data['orders'] = $this->Orders_model->customerorders($this->num_rows, $page, $_SESSION['logged_vendor']);
			 $data['links_pagination'] = pagination('customer/order', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
			// fetch product details	
			// order status
			if(isset($_POST['odrsub1']))
			{
				$this->Orders_model->updateodrstatus($_POST['wslrid'],$_POST['odrid'],$_POST['productid'],$_POST['odrstatus']);
				
				// send email to wholesaler & admin
				$orderdetails = $this->Orders_model->customeremailorder($_POST['wslrid'],$_POST['odrid'],$_POST['productid']);
			
				// shoot email
				$res = $this->customerorderemail($orderdetails); 
				if($res == true)
				echo "<script type='text/javascript'>alert('We have sent a notification email');</script>";
				else
				echo "<script type='text/javascript'>alert('We are facing trouble in sending email notification. Kindly contact Admin.');</script>";
				
			}
	
			for($i = 0; $i < count($data['orders']); $i++)
			{
				$arr = unserialize($data['orders'][$i]['products']);
				$j = 0;	 
				foreach($arr as $key => $value)
				{
					$data['product_titles'][$i][$j] = $this->Orders_model->product_info($key);
					$data['order_process'][$i][$j] = $this->Orders_model->fetchvendoridfororders($data['orders'][$i]["order_id"], $key);
					$j++;
				}
			}
			
			/*foreach($data['orders'] as $orders)
			{	
				$arr = unserialize($orders['products']);
				$r = 0;
				foreach($arr as $key => $value)
				{
					
					$r++;
				}
			}*/
			//var_dump($data['product_titles']); echo "<br><br>";
			//var_dump($data['order_process']); die;
			$this->load->view('_parts/header', $head);
			$this->load->view('customer_orders', $data);
			$this->load->view('_parts/footer');

	}
	// customer order receive
	public function customer_orders_receive($page = 0)
	{

			$data = array();
			$head = array();
			$head['title'] = 'Customer Order Receive';
			$head['description'] = 'Customer Order Receive';
			$head['keywords'] = '';
			 $rowscount = $this->Orders_model->custimerordersreceiveCount($_SESSION['logged_vendor']);
			$data['orders'] = $this->Orders_model->customerordersreceive($this->num_rows, $page, $_SESSION['logged_vendor']);
			 $data['links_pagination'] = pagination('customer/orderreceive', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
			// fetch product details	
			// order status
			if(isset($_POST['odrsub1']))
			{
				$this->Orders_model->updateodrstatus($_POST['wslrid'],$_POST['odrid'],$_POST['productid'],$_POST['odrstatus']);
				
				// send email to wholesaler & admin
				$orderdetails = $this->Orders_model->customeremailorder($_POST['wslrid'],$_POST['odrid'],$_POST['productid']);
			
				// shoot email
				$res = $this->customerorderemail($orderdetails); 
				if($res == true)
				echo "<script type='text/javascript'>alert('We have sent a notification email');</script>";
				else
				echo "<script type='text/javascript'>alert('We are facing trouble in sending email notification. Kindly contact Admin.');</script>";
				
			}
	
			for($i = 0; $i < count($data['orders']); $i++)
			{
				$arr = unserialize($data['orders'][$i]['products']);
				$j = 0;	 
				foreach($arr as $key => $value)
				{
					$data['product_titles'][$i][$j] = $this->Orders_model->product_info($key);
					$data['order_process'][$i][$j] = $this->Orders_model->fetchvendoridfororders($data['orders'][$i]["order_id"], $key);
					$j++;
				}
			}
			
			/*foreach($data['orders'] as $orders)
			{	
				$arr = unserialize($orders['products']);
				$r = 0;
				foreach($arr as $key => $value)
				{
					
					$r++;
				}
			}*/
			//var_dump($data['product_titles']); echo "<br><br>";
			//var_dump($data['order_process']); die;
			$this->load->view('_parts/header', $head);
			$this->load->view('customer_orders', $data);
			$this->load->view('_parts/footer');

	}
	
	// customer order return
	public function customer_orders_return($page = 0)
	{

			$data = array();
			$head = array();
			$head['title'] = 'Customer Order Receive';
			$head['description'] = 'Customer Order Receive';
			$head['keywords'] = '';
			 $rowscount = $this->Orders_model->custimerordersreturnCount($_SESSION['logged_vendor']);
			$data['orders'] = $this->Orders_model->customerordersreturn($this->num_rows, $page, $_SESSION['logged_vendor']);
			 $data['links_pagination'] = pagination('customer/orderreturn', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
			// fetch product details	
			// order status
			if(isset($_POST['odrsub1']))
			{
				$this->Orders_model->updateodrstatus($_POST['wslrid'],$_POST['odrid'],$_POST['productid'],$_POST['odrstatus']);
				
				// send email to wholesaler & admin
				$orderdetails = $this->Orders_model->customeremailorder($_POST['wslrid'],$_POST['odrid'],$_POST['productid']);
			
				// shoot email
				$res = $this->customerorderemail($orderdetails); 
				if($res == true)
				echo "<script type='text/javascript'>alert('We have sent a notification email');</script>";
				else
				echo "<script type='text/javascript'>alert('We are facing trouble in sending email notification. Kindly contact Admin.');</script>";
				
			}
	
			for($i = 0; $i < count($data['orders']); $i++)
			{
				$arr = unserialize($data['orders'][$i]['products']);
				$j = 0;	 
				foreach($arr as $key => $value)
				{
					$data['product_titles'][$i][$j] = $this->Orders_model->product_info($key);
					$data['order_process'][$i][$j] = $this->Orders_model->fetchvendoridfororders($data['orders'][$i]["order_id"], $key);
					$j++;
				}
			}
			
			/*foreach($data['orders'] as $orders)
			{	
				$arr = unserialize($orders['products']);
				$r = 0;
				foreach($arr as $key => $value)
				{
					
					$r++;
				}
			}*/
			//var_dump($data['product_titles']); echo "<br><br>";
			//var_dump($data['order_process']); die;
			$this->load->view('_parts/header', $head);
			$this->load->view('customer_orders', $data);
			$this->load->view('_parts/footer');

	}
	
    public function getProductInfo($product_id, $vendor_id)
    {
        return $this->Products_model->getOneProduct($product_id, $vendor_id);
    }
	
	public function getcustomerProductInfo($product_id)
    {
        return $this->Products_model->getcustomerProduct($product_id);
    }
	
	

    public function changeOrdersOrderStatus()
    {
        $result = $this->Orders_model->changeOrderStatus($_POST['the_id'], $_POST['to_status']);
        if ($result == false) {
            echo '0';
        } else {
            echo '1';
        }
    }
	
	public function changeMoneyStatus($id,$status)
    {
        $result = $this->Orders_model->changemoneyOrderStatus($id, $status);
        $this->saveHistory('Change status of Order Id ' . $id . ' to status ' . $status);
    }
	public function update_Quantity()
	{
		 $data['vendor_info'] = $this->Orders_model->get_Vendorid($_SESSION['logged_vendor']);
		//print_r($data['vendor_info']);
		foreach($data['vendor_info'] as $vendorinfor)
		{
			$_SESSION['vendor_id']=$vendorinfor['id'];
		}
		$data['vendor_qty'] = $this->Orders_model->get_Vendor_Product_qty($_SESSION['vendor_id']);
		echo "<pre>";
		print_r($data['vendor_qty']);	
	}
	
	public function changeorderstatus()
	{
		$this->Orders_model->updateodrstatus($this->vendor_id,$_POST['odrid'],$_POST['productid'],$_POST['odrstatus']);
			
		// send email to customer
			
		$orderdetails = $this->Orders_model->customeremailorder($this->vendor_id,$_POST['odrid'],$_POST['productid']);
			
		// shoot email
		$res = $this->customerorderemail($orderdetails); 
		if($res == true)
			echo "<script type='text/javascript'>alert('We have sent an email notification.');</script>";
		else
			echo "<script type='text/javascript'>alert('We are facing trouble in sending email notification. Kindly contact Admin.');</script>";
	}
	public function changedktstatus()
	{
			$odr_id = $_POST['odrid'];
			$this->Orders_model->updatedocketno($this->vendor_id,$_POST['odrid'],$_POST['productid'],$_POST['dktno']);
			
			// send email to customer
			
			$docketdetails = $this->Orders_model->customeremaildocket($this->vendor_id,$_POST['odrid'],$_POST['productid']);
			
			// shoot email
			$res = $this->customerdocketemail($docketdetails ); 
			if($res == true)
				echo "<script type='text/javascript'>alert('We have sent an email notification.');</script>";
			else
				echo "<script type='text/javascript'>alert('We are facing trouble in sending email notification. Kindly contact Admin.');</script>";

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
	// dispatched orders
	public function odispatched($page = 0)
    {

        $data = array();
        $head = array();
        $head['title'] = lang('vendor_orders');
        $head['description'] = lang('vendor_orders');
        $head['keywords'] = '';
		$_SESSION['vendor_id']=$this->vendor_id;
		
        $rowscount = $this->Orders_model->ordersCount($this->vendor_id);
        $data['orders'] = $this->Orders_model->ordersdispatched(0, 0, $this->vendor_id);
		 $data['links_pagination'] = pagination('vendor/orders', 0, 0, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		$i = 0;
		foreach($data['orders'] as $order)
		{
			$data['productdetails'][$i] = $this->getProductInfo($order['products'],$this->vendor_id);
			$data['productinfo'][$i] = $this->Orders_model->product_info($order['products']);
			$i++;
		}
		$data['monthorders'] = $this->Orders_model->month_orders($this->vendor_id);
		//$_SESSION['totalmonthorder']=$data['monthorders'];
		//var_dump($data['monthorders']);die;
		$data['today'] = $this->Orders_model->todayorders($this->vendor_id);
		$data['week'] = $this->Orders_model->todayorders($this->vendor_id);
		
        $this->load->view('_parts/header', $head);
        $this->load->view('orders', $data);
        $this->load->view('_parts/footer');
    }
	
	// delivered
	public function odelivered($page = 0)
    {

        $data = array();
        $head = array();
        $head['title'] = lang('vendor_orders');
        $head['description'] = lang('vendor_orders');
        $head['keywords'] = '';
		$_SESSION['vendor_id']=$this->vendor_id;
		
        $rowscount = $this->Orders_model->ordersCount($this->vendor_id);
        $data['orders'] = $this->Orders_model->ordersdelivered(0, 0, $this->vendor_id);
		 $data['links_pagination'] = pagination('vendor/orders', 0, 0, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		$i = 0;
		foreach($data['orders'] as $order)
		{
			$data['productdetails'][$i] = $this->getProductInfo($order['products'],$this->vendor_id);
			$data['productinfo'][$i] = $this->Orders_model->product_info($order['products']);
			$i++;
		}
		$data['monthorders'] = $this->Orders_model->month_orders($this->vendor_id);
		//$_SESSION['totalmonthorder']=$data['monthorders'];
		//var_dump($data['monthorders']);die;
		$data['today'] = $this->Orders_model->todayorders($this->vendor_id);
		$data['week'] = $this->Orders_model->todayorders($this->vendor_id);
		
        $this->load->view('_parts/header', $head);
        $this->load->view('orders', $data);
        $this->load->view('_parts/footer');
    }
	// return
	public function oreturn($page = 0)
    {

        $data = array();
        $head = array();
        $head['title'] = lang('vendor_orders');
        $head['description'] = lang('vendor_orders');
        $head['keywords'] = '';
		$_SESSION['vendor_id']=$this->vendor_id;
		
        $rowscount = $this->Orders_model->ordersCount($this->vendor_id);
        $data['orders'] = $this->Orders_model->ordersreturn(0, 0, $this->vendor_id);
		 $data['links_pagination'] = pagination('vendor/orders', 0, 0, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		$i = 0;
		foreach($data['orders'] as $order)
		{
			$data['productdetails'][$i] = $this->getProductInfo($order['products'],$this->vendor_id);
			$data['productinfo'][$i] = $this->Orders_model->product_info($order['products']);
			$i++;
		}
		$data['monthorders'] = $this->Orders_model->month_orders($this->vendor_id);
		//$_SESSION['totalmonthorder']=$data['monthorders'];
		//var_dump($data['monthorders']);die;
		$data['today'] = $this->Orders_model->todayorders($this->vendor_id);
		$data['week'] = $this->Orders_model->todayorders($this->vendor_id);
		
        $this->load->view('_parts/header', $head);
        $this->load->view('orders', $data);
        $this->load->view('_parts/footer');
    }
}
