<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Products extends VENDOR_Controller
{

    private $num_rows = 20;

    public function __construct()
    {
        parent::__construct();
		
        $this->load->model('Products_model');
        $this->load->model('Auth_model');
		//$this->load->library('csvimport');
		$this->load->library('excel');
    }

    public function index($page = 0)
    {
        if (isset($_GET['delete'])) {
            $this->Products_model->deleteProduct($_GET['delete']);
            $this->session->set_flashdata('result_delete', 'product is deleted!');
            $this->saveHistory('Delete product id - ' . $_GET['delete']);
            redirect('admin/products');
        }
        $data = array();
        $head = array();
        $head['title'] = lang('vendor_products');
        $head['description'] = lang('vendor_products');
        $head['keywords'] = '';
        $rowscount = $this->Products_model->productsCount($this->vendor_id);
        $data['products'] = $this->Products_model->getproducts($this->num_rows, $page, $this->vendor_id);
        $data['links_pagination'] = pagination('vendor/products', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
        $this->load->view('_parts/header', $head);
        $this->load->view('products', $data);
        $this->load->view('_parts/footer');
    }
	
	public function activeproducts($page = 0)
    {
        if (isset($_GET['delete'])) {
            $this->Products_model->deleteProduct($_GET['delete']);
            $this->session->set_flashdata('result_delete', 'product is deleted!');
            $this->saveHistory('Delete product id - ' . $_GET['delete']);
            redirect('admin/products');
        }
        $data = array();
        $head = array();
        $head['title'] = lang('vendor_products');
        $head['description'] = lang('vendor_products');
        $head['keywords'] = '';
        $rowscount = $this->Products_model->activeproduct($this->vendor_id);
        $data['products'] = $this->Products_model->getactiveproducts($this->vendor_id);
        $data['links_pagination'] = pagination('vendor/products', 0, 0, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
        $this->load->view('_parts/header', $head);
        $this->load->view('products', $data);
        $this->load->view('_parts/footer');
    }
	
	public function inactiveproducts($page = 0)
    {
        if (isset($_GET['delete'])) {
            $this->Products_model->deleteProduct($_GET['delete']);
            $this->session->set_flashdata('result_delete', 'product is deleted!');
            $this->saveHistory('Delete product id - ' . $_GET['delete']);
            redirect('admin/products');
        }
        $data = array();
        $head = array();
        $head['title'] = lang('vendor_products');
        $head['description'] = lang('vendor_products');
        $head['keywords'] = '';
        $rowscount = $this->Products_model->inactiveproduct($this->vendor_id);
        $data['products'] = $this->Products_model->getinactiveproducts($this->vendor_id);
        $data['links_pagination'] = pagination('vendor/products', 0, 0, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
        $this->load->view('_parts/header', $head);
        $this->load->view('products', $data);
        $this->load->view('_parts/footer');
    }
	
    public function deleteProduct($id)
    {
        $this->Products_model->deleteProduct($id, $this->vendor_id);
        $this->session->set_flashdata('result_delete', lang('vendor_product_deleted'));
        redirect(LANG_URL . '/vendor/products');
    }

    public function logout()
    {
        unset($_SESSION['logged_vendor']);
        delete_cookie('logged_vendor');
        redirect(LANG_URL . '/vendor/login');
    }
	public function subscribe()
    {
		
        $data = array();
        $head = array();
        $head['title'] = lang('subscribe');
        $head['description'] = lang('subscribe');
        $head['keywords'] = '';
	    //$vendor_user=$this->setLoginSession($_POST['u_email'], $remember_me);
		$res=$this->Products_model->getVendorById();
		//var_dump($res); die();
		$_SESSION['vendor_user']=$res['email'];
		$_SESSION['vendor_id']=$res['id'];
		$_SESSION['status']=$res['status'];
		$_SESSION['firm_name']=$res['firm_name'];
		$data['subscribe']=$this->Products_model->viewsubscribe($_SESSION['vendor_id']);
		//var_dump($data);
		$this->load->view('_parts/header', $head);
        $this->load->view('subscribe',$data);
        $this->load->view('_parts/footer');
    }
	public function viewsubscribe()
    {
		$data = array();
        $head = array();
        $head['title'] = lang('subscribe');
        $head['description'] = lang('subscribe');
        $head['keywords'] = '';
		
        $this->load->view('_parts/header', $head);
        $this->load->view('viewsubscribe',$data);
        $this->load->view('_parts/footer');
    }
	public function Savestate()
	{
		$mode_payment=$_POST['mode_payment'];
		$utr_no=$_POST['utr_no'];
		//$amount=$_POST['amount'];
		$start_date=$_POST['start_date'];
		//echo $start_date;
		
		/* if($amount == 500)
		{
			$time = strtotime($start_date. ' + 30 days');
			$end_date = date('Y-m-d',$time);
			//var_dump($newformat); die;
		}
	    else if($amount == 1200)
		{
			$time = strtotime($start_date. ' + 90 days');
			$end_date = date('Y-m-d',$time);
			//var_dump($newformat); die;
		}
	    else if($amount == 2000)
		{
			$time = strtotime($start_date. ' + 365 days');
			$end_date = date('Y-m-d',$time);
			//var_dump($newformat); die;
		} */
		
			$time = strtotime($start_date. ' + 90 days');
			$end_date = date('Y-m-d',$time);
		$vendor_id=$_POST['vendor_id'];
		$vendor_email=$_POST['vendor_email'];
		$data = array(
				   'mode_payment' => $mode_payment,
				   'utr_no' => $utr_no,
					'start_date' => $start_date,
				   'end_date' => $end_date,
				   'vendor_id' => $vendor_id,
				   'vendor_email' => $vendor_email
				);
		//var_dump($data);die;
		if($this->db->insert('vendors_subscribe', $data))
		{
		redirect('vendor/products/subscribe');

		}
	}
	public function csv_import()
    {
		$res=$this->Products_model->getVendorByIds();
		//var_dump($res); die();
		$_SESSION['vendor_user']=$res['email'];
		$_SESSION['vendor_id']=$res['id'];
		
		$_SESSION['url']=$res['url'];
		//var_dump($_SESSION['vendor_user']);die;
        $data = array();
        $head = array();
        $head['title'] = lang('subscribe');
        $head['description'] = lang('subscribe');
        $head['keywords'] = '';
		$this->load->view('_parts/header', $head);
        $this->load->view('csv_import');
        $this->load->view('_parts/footer');
    }
	function load_data()
	{
		$result = $this->Products_model->select();
		$output = '
		 <h3 align="center">Imported User Details from CSV File</h3>
        <div class="table-responsive">
        	<table class="table table-bordered table-striped">
        		<tr>
        			<th>Sr. No</th>
        			<th>Title</th>
        			<th>Basic Description</th>
        			<th>Description</th>
        			<th>Price</th>
        			<th>Old Price</th>
        		</tr>
		';
		$count = 0;
		if($result->num_rows() > 0)
		{
			foreach($result->result() as $row)
			{
				$count = $count + 1;
				$output .= '
				<tr>
					<td>'.$count.'</td>
					<td>'.$row->title.'</td>
					<td>'.$row->basic_description.'</td>
					<td>'.$row->description.'</td>
					<td>'.$row->price.'</td>
					<td>'.$row->old_price.'</td>
				</tr>
				';
			}
		}
		else
		{
			$output .= '
			<tr>
	    		<td colspan="5" align="center">Data not Available</td>
	    	</tr>
			';
		}
		$output .= '</table></div>';
		echo $output;
	}
	// csv import
	public function import()
	{
		
		$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
		$numrows = 0;
		foreach($file_data as $row)
		{
			/*if($row["shop_categorie"] == "allopathic"){
				$cat = 1;
			}
			else if($row["shop_categorie"] == "ayurvedic"){
				$cat = 2;
			}
			else if($row["shop_categorie"] == "FMCG"){
				$cat = 3;
			}*/
			 $data[$numrows] = array(
				//'shop_categorie'=>	$cat,
				'shop_categorie'=>	$row["shop_categorie"],
				'title'=>	$row["product_name"],
				'description'=>	$row["description"],
        		'quantity'=>$row["quantity"],
        		'minquantity'=>	$row["minquantity"],
        		'brand'	=>	$row["brand"],
				'mrp' => $row["mrp"],
				'discount_price' => $row['discount_price'],
        		'discount'=>	$row["discount"] 				
			); 
			$numrows++;
		}
		if($this->Products_model->insertcsv($data, $numrows))
		{
			redirect('vendor/products/Csv_import');
		}
	}
	// Excel import
	public function excel_import()
	{   
		$data = array();  
		if($_FILES["csv_file"]["type"] == 'application/vnd.ms-excel' ||
		   $_FILES["csv_file"]["type"] == 'text/xls' ||
		   $_FILES["csv_file"]["type"] == 'text/xlsx' ||
		   $_FILES["csv_file"]["type"] == 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet')
		{
			$path = $_FILES["csv_file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);	
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				$numb = 0;
				for($row=2; $row<=$highestRow; $row++)
				{
					$shop_categorie = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$product_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$description = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$quantity = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$minquantity = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$brand = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$mrp = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$discount_price = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					$discount = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					$location = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					
					if($shop_categorie != null || $shop_categorie != "" ||
					   $product_name != null || $product_name != "" ||
					   $quantity != null || $quantity != "" || $quantity != 0 ||
					   $minquantity != null || $minquantity != "" || $minquantity != 0 || 
					   $mrp != null || $mrp != "" || $mrp != 0 ||
					   $discount_price != null || $discount_price != "" || $discount_price != 0)
					   {
						if($shop_categorie == "allopathic"){ $cat = 1;}
						else if($shop_categorie == "ayurvedic"){ $cat = 2;}
						else if($shop_categorie == "FMCG"){ $cat = 3;}
						else if($shop_categorie == "PCD Company"){ $cat = 4; }
						else if($shop_categorie == "3rd Party"){ $cat = 5; }
						
						$discount1 = (($mrp - $discount_price)/$mrp)*100;
						
						$data[] = array(
						'shop_categorie'	=>	$cat,
						'title'		        =>	$product_name,
						'description'		=>	$description,
						'quantity'			=>	$quantity,
						'minquantity'		=>	$minquantity,
						'brand'				=>	$brand,
						'mrp'				=>	$mrp,
						'discount_price'	=>	$discount_price,
						'discount'			=>	$discount1,
						'location'			=>	$location
						);
						$numb++;
					   }
					   else
					   {
						//   echo 'sh'.$shop_categorie.' pn'.$product_name.' qu'.$quantity;
						//   echo "Error in Data. Please Contact Administrator";
					   }
					   
				}
			}	
			//echo"<script type='text/javascript'>alert('count=".$numb."');</script>";
			//echo"<script type='text/javascript'>alert('".print_r($data)."');</script>";
			if($this->Products_model->insertexceldata($data, $numb))
			{
				redirect('vendor/products/Csv_import');
			}
		}
		else{
			echo "File format is not correct";
		}
			
	}
	
	public function customer_enquiries()
    {
		
        $data = array();
        $head = array();
        $head['title'] = lang('subscribe');
        $head['description'] = lang('subscribe');
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        $this->load->view('customer_enquiries',$data);
        $this->load->view('_parts/footer');
    }
	public function time1()
    {
        $h = "5";// Hour for time zone goes here e.g. +7 or -4, just remove the + or -
        $hm = $h * 60 + 30; 
        $ms = $hm * 60;
        $gmdate = gmdate("d/m/Y g:i:s A", time()+($ms)); // the "-" can be switched to a plus //if that's what your time zone is.
        return $gmdate;
    }
	public function customer_enquiriesinsert()
	{
		
		$vendor_id=$_POST['vendor_id'];
		$vendor_email=$_POST['vendor_email'];
		$message=$_POST['message'];
		//$date=$_POST['time1'];
		$data = array(
				   'vendor_id' => $vendor_id,
				   'vendor_email' => $vendor_email,
				   'message' => $message,
				   'date' => $this->time1()
				   
				);
		//var_dump($data);die;
		if($this->db->insert('customer_enquiries', $data))
		{
		redirect('vendor/products/customer_enquiries');

		}
	}
	public function show_responses()
	{
		$data = array();
        $head = array();
        $head['title'] = ' Home';
        $head['description'] = '';
        $head['keywords'] = '';
		//var_dump($_SESSION);die;
		 $result = $this->Products_model->show_responses1($_SESSION['vendor_id']);
		 $this->load->view('_parts/header',$head);
        $this->load->view('show_responses',array('data' => $result));
        $this->load->view('_parts/footer');
        
	}
	public function bank_details()
    {
        $data = array();
        $head = array();
        $head['title'] = lang('bank_details');
        $head['description'] = lang('bank_details');
        $head['keywords'] = '';
	    //$vendor_user=$this->setLoginSession($_POST['u_email'], $remember_me);
		$res=$this->Products_model->getVendorById();
		//var_dump($res); die();
		//$_SESSION['vendor_user']=$res['email'];
		$_SESSION['vendor_id']=$res['id'];
		$_SESSION['status']=$res['status'];
		$_SESSION['firm_name']=$res['firm_name'];
		$result = $this->Products_model->showbank_details($_SESSION['vendor_id']);
		$data['subscribe']=$this->Products_model->viewsubscribe($_SESSION['vendor_id']);
		$this->load->view('_parts/header', $head);
        $this->load->view('bank_details',array('data' => $result));
        $this->load->view('_parts/footer');
    }
	public function Savebankdetails()
	{
		$bank_name=$_POST['bank_name'];
		$bank_account=$_POST['bank_account'];
		$ifsc_code=$_POST['ifsc_code'];
		$bank_address=$_POST['bank_address'];
		$phone_number=$_POST['phone_number'];
		$upi_number=$_POST['upi_number'];
		$insert_date=$_POST['insert_date'];
		$firm_name=$_POST['firm_name'];
		$vendor_id=$_POST['vendor_id'];
		$data = array(
				   'bank_name' => $bank_name,
				   'bank_account' => $bank_account,
				   'ifsc_code' => $ifsc_code,
				   'bank_address' => $bank_address,
				   'phone_number' => $phone_number,
				   'upi_number' => $upi_number,
				   'insert_date' => $insert_date,
				   'firm_name' => $firm_name,
				   'vendor_id' => $vendor_id
				);
		//var_dump($data);die;
		if($this->db->insert('bank_details', $data))
		{
			// bank details add email	
			$this->bankemail($_SESSION['vendor_user']);
			
			redirect('vendor/bankdetails');
		}
	}

	public function productajaxsuggest()
	{
		if(isset($_POST['keyword']))
		{
			$val = $_POST['keyword'];
			$result = $this->Products_model->productajaxresult($val);
			foreach($result as $res)
			{	
				$suggest = '<div onmouseover="suggestover(this)"';
				$suggest .= ' onmouseout="suggestout(this)"';
				$suggest .= ' onclick="setsearch(this.innerHTML,'.$res->id.')"';
				$suggest .= 'class="suggest_link">' . $res->name.'</div>' ;
				//$suggest .= '<input id="prid1" type = "hidden" value="'.$res->id.'">';
				echo $suggest;
				
			//echo $result;
			}
		}
	}
	public function fetchproductajaxsuggest()
	{
		if(isset($_POST['productid']))
		{
			$val = $_POST['productid'];
			$result = $this->Products_model->fetchproductajaxresult($val);
			foreach($result as $res)
			{
				echo $res->description.'@#$'.$res->company.'@#$'.$res->old_price;
			}
		}
	}
	public function bankemail($vemail)
	{
		$this->load->library('email');
			
		$message = "Dear Customer, <br>";
		$message .= "Your Bank information has been changed. <br>";	
		$message .= "We have send this email on ". $vemail." to notify you. <br>";
		$message .= "Please discard if its done by you. <br>";
		$message .= "If you haven't changed your Bank information. Kindly go to the Bank Details section in your dashboard for more details. <br> If you have any queries Email us at : support@medideals.co.in <br>";
		$message .= "Warm Regards <br>";
		$message .= "Medideals Team <br>";
	
		//$this->email->initialize($config);
		// Sender email address
		$this->email->from('support@medideals.co.in', 'Medideals Team');
		// Receiver email address
		$this->email->to(array($vemail,'support@medideals.co.in'));
		// Subject of email
		$this->email->subject("Bank Details change Notification from Medideals" );
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
	function searchproductforvendor()
	{
		$data = array();
        $head = array();
        $head['title'] = lang('vendor_products');
        $head['description'] = lang('vendor_products');
        $head['keywords'] = '';
        
        $data['products'] = $this->Products_model->getsearchproductforvendor($this->vendor_id);
        $this->load->view('_parts/header', $head);
        $this->load->view('products', $data);
        $this->load->view('_parts/footer');
	}
}
