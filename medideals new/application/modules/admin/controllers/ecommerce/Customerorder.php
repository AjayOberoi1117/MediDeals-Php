<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Customerorder extends VENDOR_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Orders_model', 'Products_model'));
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
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = lang('vendor_orders');
        $head['description'] = lang('vendor_orders');
        $head['keywords'] = '';
		$_SESSION['vendor_id']=$this->vendor_id;
		// add edit docket number
		if(isset($_POST['dktsub']))
		{
			$this->Orders_model->updatedocketno($this->vendor_id,$_POST['odrid'],$_POST['productid'],$_POST['dktno']);
		}
		// order status
		if(isset($_POST['odrsub']))
		{
			$this->Orders_model->updateodrstatus($this->vendor_id,$_POST['odrid'],$_POST['productid'],$_POST['odrstatus']);
		}
		
        $rowscount = $this->Orders_model->ordersCount($this->vendor_id);
        $data['orders'] = $this->Orders_model->orders($this->num_rows, $page, $this->vendor_id);
		$i = 0;
		foreach($data['orders'] as $order)
		{
			$data['productdetails'][$i] = $this->getProductInfo($order['products'],$this->vendor_id);
			$data['productinfo'][$i] = $this->Orders_model->product_info($order['products']);
			$i++;
		}
		$data['monthorders'] = $this->Orders_model->month_orders($this->vendor_id);
		//$_SESSION['totalmonthorder']=$data['monthorders'];
		$data['today'] = $this->Orders_model->todayorders($this->vendor_id);
		$data['week'] = $this->Orders_model->todayorders($this->vendor_id);
		//echo $data['week'];
        $this->load->view('_parts/header', $head);
        $this->load->view('orders', $data);
        $this->load->view('_parts/footer');
    }
	public function customer_orders()
	{

			$data = array();
			$head = array();
			$head['title'] = 'Customer Order';
			$head['description'] = 'Customer Order';
			$head['keywords'] = '';
			
			$data['orders'] = $this->Orders_model->customerorders($_SESSION['logged_vendor']);
			//var_dump($data['orders'][]); die;
			// fetch product details	
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

}
