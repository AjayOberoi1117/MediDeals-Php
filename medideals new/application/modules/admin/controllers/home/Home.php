<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Home extends ADMIN_Controller
{
 private $num_rows =5;
    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('Orders_model', 'History_model'));
		//$this->load->library('csvimport');
		$this->load->library('excel');
		$this->load->library("pagination");
		  $this->load->library('form_validation');

    }

    public function index()
    {
        $this->login_check();
        $data = array();
        $head = array();
		$head['menu'] = $this->userrole1($_SESSION['userrole1']);
        $head['title'] = 'Administration - Home';
        $head['description'] = '';
        $head['keywords'] = '';
        $data['newOrdersCount'] = $this->Orders_model->ordersCount(true);
        $data['lowQuantity'] = $this->Home_admin_model->countLowQuantityProducts();
        $data['lastSubscribed'] = $this->Home_admin_model->lastSubscribedEmailsCount();
        $data['pcdcompanies'] = $this->Home_admin_model->pcdcompanies();
        $data['thirdparty'] = $this->Home_admin_model->thirdparty();
        $data['customerenquiries'] = $this->Home_admin_model->customerenquiries();
        $data['wholeseller'] = $this->Home_admin_model->wholeseller();
        $data['retailer'] = $this->Home_admin_model->retailer();
        $data['listproducts'] = $this->Home_admin_model->listproducts();
        $data['moneyescrow'] = $this->Home_admin_model->moneyescrow();
        $data['ordersCount'] = $this->Home_admin_model->ordersCount();
        $data['productreturn'] = $this->Home_admin_model->productreturn();
        $data['productsold'] = $this->Home_admin_model->productsold();
        $data['activeproduct'] = $this->Home_admin_model->activeproduct();
        $data['inactiveproduct'] = $this->Home_admin_model->inactiveproduct();
        $data['users'] = $this->Home_admin_model->users();
        $data['finalamount'] = $this->Home_admin_model->finalamount();
        $data['orderdelivered'] = $this->Home_admin_model->orderdelivered();
        $data['vendorresponse'] = $this->Home_admin_model->vendorresponse();
        $data['activity'] = $this->History_model->getHistory(10, 0);
        $data['mostSold'] = $this->Home_admin_model->getMostSoldProducts();
        $data['byReferral'] = $this->Home_admin_model->getReferralOrders();
        $data['ordersByPaymentType'] = $this->Home_admin_model->getOrdersByPaymentType();
        $data['ordersByMonth'] = $this->Home_admin_model->getOrdersByMonth();
		//var_dump( $data['finalamount'] );die;
        $this->load->view('_parts/header', $head);
        $this->load->view('home/home', $data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
    }

    /*
     * Called from ajax
     */

    public function changePass()
    {
        $this->login_check();
		$result = $this->Home_admin_model->changePass($_POST['new_pass'],  $this->username);
        if ($result == true) {
			// email alert to admin
			$this->adminpwdchange();
			echo 1;
        } else {
            echo 0;
        }
        $this->saveHistory('Password change for user: ' . $this->username);
    
	}
	public function wholeseller_subs_msg($page = 0)
	{
		$this->login_check();
		$rowscount = $this->Home_admin_model->subscription_messages();
		$data['sub'] = $this->Home_admin_model->get_wholeseller_subscription_messages($this->num_rows, $page);
		 $data['links_pagination'] = pagination('admin/wholeseller_subs_msg', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/wholeseller_subs_list',$data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	public function update_subs_status($status,$vendor_id)
	{
		 $this->login_check();
		// $vendor_id = base64_decode($vendor_id);
		 //var_dump($status);
		 //var_dump($vendor_id); die;
		 $result = $this->Home_admin_model->wholeseller_subscription_status($status,$vendor_id);
		 redirect('admin/wholeseller_subs_msg');
	}
	public function customer_enquiries($page = 0)
	{
		$this->login_check();
		$rowscount = $this->Home_admin_model->customer_enquiries();
		$data['customerenquiries'] = $this->Home_admin_model->get_customer_enquiries($this->num_rows, $page);
		 $data['links_pagination'] = pagination('admin/customer_enquiries', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/customer_enquiries',$data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	public function response_customer($status=null,$vendor_email=null,$vendor_id=null,$enquiry_id=null)
	{
		$this->login_check();
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
		$data2 = array();
		$data2['status'] = $_POST['status'];
		$data2['vendor_email'] = $_POST['email'];
		$data2['vendor_id'] = $_POST['vendor_id'];
		$data2['enquiry_id'] = $_POST['enquiry_id'];
        $this->load->view('ecommerce/response_enquiries',array('data' => $data2));
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	public function update_cust_enq_status()
	{
		 $this->login_check();
		 //$vendor_id = base64_decode($vendor_id);
		 //var_dump($status);
		 //var_dump($vendor_id); die;
		 $data['vendor_id'] = $_POST['vendor_id'];
		 $enquiry_id = $_POST['enquiry_id'];
		 //$status = $_POST['status'];
		 $data['vendor_email'] = $_POST['vendor_email'];
		 $data['message'] = $_POST['message'];
		 $data['date'] = date("Y-m-d H:i:s");
		 //var_dump($_POST);
		 $this->Home_admin_model->response_status($data);
		 $this->Home_admin_model->customer_enquiries_status(1,$data['vendor_id'],$enquiry_id);
		
		redirect('admin/customer_enquiries');
	}
	public function show_responses($page = 0)
	{
		$this->login_check();
		$rowscount = $this->Home_admin_model->showresponsesdatacount();
		$data['showresponses'] = $this->Home_admin_model->show_responses1($this->num_rows, $page);
		 $data['links_pagination'] = pagination('admin/show_responses', $rowscount, $this->num_rows, MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
	
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/show_responses',$data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	public function show_enquiry($page = 0)
	{
		 $this->login_check();
		 $rowscount = $this->Home_admin_model->show_enquiry_count();
		 $data['showenquory'] = $this->Home_admin_model->show_enquiry($this->num_rows,$page);
		 $data['links_pagination'] = pagination('admin/show_enquiry',$rowscount,$this->num_rows,MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		 $head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/show_enquiry',$data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	public function calc_earning()
	{
		$this->login_check();
		if(@$_POST['sub'] == 'search'){
		$from = $_POST['from_date'];
		$to = $_POST['to_date'];
		$result = $this->Home_admin_model->calc_earning_subs($from,$to);}
		else{
		$result = $this->Home_admin_model->calc_earning_subs();}
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/calc_earning',array('data' => $result));
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	public function pcdcompanies_entry()
	{
		$this->login_check();
		$data2 = array();
		if(@$_POST['sub'] == "entry")
		{	
			$data2['status'] = $_POST['status'];
			$data2['vendor_email'] = $_POST['email'];
			$data2['vendor_id'] = $_POST['vendor_id'];
			$data2['enquiry_id'] = $_POST['enquiry_id'];
			$result = $this->Home_admin_model->pcd_companies_entry($data);
			redirect('home/pcdcompanies_show');
		}
		else
		{
			$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
			$this->load->view('ecommerce/pcd_companies_entry');
			$this->load->view('_parts/footer');
			$this->saveHistory('Go to home page');
		}
	}
	public function pcdcompanies_show($page = 0)
	{

		$this->login_check();
		$data['states'] = $this->Home_admin_model->pcdcompanies_show_state();
		  //var_dump ($result['fetch']);
		$rowscount = $this->Home_admin_model->pcdcompanies_shows_count();
		$data['pcdcompanies'] = $this->Home_admin_model->pcd_companies_show($this->num_rows,$page);
		$data['links_pagination'] = pagination('admin/pcdcompanies_show',$rowscount,$this->num_rows,MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/pcd_companies_show',$data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	
	}
	
	public function pcdcompanies_show_city()
	{
		$id = $_POST['id'];
		$city_list = $this->Home_admin_model->pcdcompanies_show_city($id);
		//echo "<pre>";print_r($city_list);die;
		?>
		<select name="pcd_city" id="pcd_city" class="chosen selectpicker form-control" required style="display: block !important">
		<?php
			foreach($city_list as $cl){
		?>
			<option value="<?=$cl['id']?>"><?=$cl['name']?></option>
		<?php }
		?>				
		</select>
		
		<?php 
	}
	public function pcd_companies_update($pcd_id)
	{ 
		
		$this->login_check();
		$states_list = $this->Home_admin_model->pcdcompanies_show_state();
		$result = $this->Home_admin_model->pcd_companies_update($pcd_id);
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/pcd_companies_update',array('data' => $result,'states'=>$states_list));
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
		
	}
	public function pcd_companies_update_details()
	{
		
		$postion=$_POST['pcd_position'];
		$position_old = $_POST['old_pcd_position'];
		
		if($postion == $position_old)
		{ $postionreturn = 0;}
		else{
		$postionreturn=$this->Home_admin_model->check_position($postion);
		}
		
		if($postionreturn==0){
		$data  = array(
				'pcd_id' => $_POST['pcd_id'],
				'pcd_name' => $_POST['pcd_name'],
				'pcd_description' => $_POST['pcd_description'],
				'pcd_address' => $_POST['pcd_address'],
				'pcd_phone' => $_POST['pcd_phone'],
				'pcd_position' => $_POST['pcd_position'],
				'pcd_city' => $_POST['pcd_city'],
				'pcd_state' => $_POST['pcd_state'],
				'pcd_date' => $_POST['pcd_date']
				
			);
		//var_dump($data);die;
		$result = $this->Home_admin_model->pcd_companies_update_details($data);
        redirect('admin/pcdcompanies_show');
		}else{
			echo "<script>alert('Position already exists!');</script>";
			redirect('admin/pcdcompanies_show');
		}
	}
	 public function pcdcompanies_register()
    {
		$postion=$_POST['pcd_position'];
		$postionreturn=$this->Home_admin_model->check_position($postion);
		
		if($postionreturn==0){
		$this->load->library("image_lib");
		$img_name = $_FILES['pcd_image']['name'];
		$tmpimg_name = $_FILES['pcd_image']['tmp_name'];
		
		$folder_path = "upload_pic/";
		//$path = base_url().$folder_path;
		$path = getcwd()."/".$folder_path;
		$image = time().$img_name;
		move_uploaded_file($tmpimg_name,$path.$image);
		
		
		$data  = array(
				'pcd_name' => $_POST['pcd_name'],
				'pcd_description' => $_POST['pcd_description'],
				'pcd_address' => $_POST['pcd_address'],
				'pcd_phone' => $_POST['pcd_phone'],
				'pcd_position' => $_POST['pcd_position'],
				'pcd_city' => $_POST['pcd_city'],
				'pcd_state' => $_POST['pcd_state'],
				'pcd_date' => $_POST['pcd_date'],
				'pcd_image' => $image
			);
			
		//var_dump($data);die;
		if($this->db->insert('pcdcompanies_entry', $data))
		{
		redirect('admin/pcdcompanies_show');

		}
		}else{
			echo "<script>alert('Position already exists!');</script>";
			redirect('admin/pcdcompanies_show');
		}
		
        
        
    }
	public function third_party($page = 0)
	{

		$this->login_check();
		
		 $data['states']= $this->Home_admin_model->thirdparty_show_state();
		 $rowscount = $this->Home_admin_model->third_party_count();
		 $data['thirdparty'] = $this->Home_admin_model->thirdparty_show($this->num_rows,$page);
		 $data['links_pagination'] = pagination('admin/3rd_party',$rowscount,$this->num_rows,MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		 //var_dump ($result['fetch']);
		
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/3rd_party',$data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	
	}
	public function third_party_register()
    {
		$postion=$_POST['Thirdparty_position'];
		$postionreturn=$this->Home_admin_model->third_party_check_position($postion);
		
		if($postionreturn==0){
		$this->load->library("image_lib");
		$img_name = $_FILES['Thirdparty_image']['name'];
		$tmpimg_name = $_FILES['Thirdparty_image']['tmp_name'];
		
		$folder_path = "upload_pic/";
		//$path = base_url().$folder_path;
		$path = getcwd()."/".$folder_path;
		$image = time().$img_name;
		move_uploaded_file($tmpimg_name,$path.$image);
		
		
		$data  = array(
				'Thirdparty_name' => $_POST['Thirdparty_name'],
				'Thirdparty_description' => $_POST['Thirdparty_description'],
				'Thirdparty_address' => $_POST['Thirdparty_address'],
				'Thirdparty_phone' => $_POST['Thirdparty_phone'],
				'Thirdparty_position' => $_POST['Thirdparty_position'],
				'Thirdparty_city' => $_POST['Thirdparty_city'],
				'Thirdparty_state' => $_POST['Thirdparty_state'],
				'Thirdparty_date' => $_POST['Thirdparty_date'],
				'Thirdparty_image' => $image
			);
		//var_dump($data);die;
		if($this->db->insert('thirdparty', $data))
		{
		redirect('admin/3rd_party');

		}
		}else{
			echo "<script>alert('Position already exists!');</script>";
			redirect('admin/3rd_party');
		}
		
	}
	public function third_show_city()
	{
		$id = $_POST['id'];
		$city_list = $this->Home_admin_model->third_show_city($id);
		//echo "<pre>";print_r($city_list);die;
		?>
		<select name="Thirdparty_city" id="pcd_city" class="chosen selectpicker form-control" required style="display: block !important">
		<?php
			foreach($city_list as $cl){
		?>
			<option value="<?=$cl['id']?>"><?=$cl['name']?></option>
		<?php }
		?>				
		</select>
		
		<?php 
	}
	public function thirdparty_update($Thirdparty_id)
	{ 
		
		$this->login_check();
		$states_list = $this->Home_admin_model->thirdparty_show_state();
		$result = $this->Home_admin_model->thirdparty_update($Thirdparty_id);
		$head = array(); 
		$head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/thirdparty_update',array('data' => $result,'states'=>$states_list));
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
		
	}
	public function thirdparty_update_details()
	{
		$postion=$_POST['Thirdparty_position'];
		$position_old = $_POST['old_tp_position'];
		
		if($postion == $position_old)
		{ $postionreturn = 0;}
		else{
		$postionreturn=$this->Home_admin_model->third_party_check_position($postion);
		}
		if($postionreturn==0){
		$data  = array(
				'Thirdparty_id' => $_POST['Thirdparty_id'],
				'Thirdparty_name' => $_POST['Thirdparty_name'],
				'Thirdparty_description' => $_POST['Thirdparty_description'],
				'Thirdparty_address' => $_POST['Thirdparty_address'],
				'Thirdparty_phone' => $_POST['Thirdparty_phone'],
				'Thirdparty_position' => $_POST['Thirdparty_position'],
				'Thirdparty_city' => $_POST['Thirdparty_city'],
				'Thirdparty_state' => $_POST['Thirdparty_state'],
				'Thirdparty_date' => $_POST['Thirdparty_date']
				
			);
		//var_dump($data);die;
		$result = $this->Home_admin_model->thirdparty_update_details($data);
        redirect('admin/3rd_party');
		}else{
			echo "<script>alert('Position already exists!');</script>";
			redirect('admin/3rd_party');
		}
	}
	
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin');
    }
	public function show_bank_details($page = 0)
	{
		$this->login_check();
		 $rowscount = $this->Home_admin_model->show_bank_details_count();
		 $data['bankdetails'] = $this->Home_admin_model->show_bank_details($this->num_rows,$page);
		 $data['links_pagination'] = pagination('admin/show_bank_details',$rowscount,$this->num_rows,MY_LANGUAGE_ABBR == MY_DEFAULT_LANGUAGE_ABBR ? 3 : 4);
		
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/show_bank_details',$data);
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	public function csv_import()
	{
		
		$this->login_check();
		$vendor_data = $this->Home_admin_model->vendors_data();
		$head = array(); 
		$head['menu'] = $this->userrole1($_SESSION['userrole1']); 
		$this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/csv_import',array('v_data'=>$vendor_data));
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	function load_data()
	{
		$result = $this->Home_admin_model->select();
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
	// CSV upload
	public function import()
	{
		 $this->form_validation->set_error_delimiters('<div class="err">', '</div>');
        $this->form_validation->set_rules('vendor_id', 'Vendor Name', 'callback_select_validate');
		$file_data = $this->csvimport->get_array($_FILES["csv_file"]["tmp_name"]);
		$numrows = 0;
		$vendor_id = $_POST['vendor_id'];
		//echo $vendor_id; die;
		foreach($file_data as $row)
		{
		
			 $data[$numrows] = array(
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
		if($this->Home_admin_model->insertcsv($data, $numrows, $vendor_id))
		{
			redirect('admin/csv_import');
		}
	}
	// Excel upload
	public function excel_import()
	{
		$vendor_id = $_POST['vendor_id'];
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
					
				if($shop_categorie == null || $shop_categorie == "" ||
					$product_name == null || $product_name == "" ||
					$quantity == null || $quantity == "" || $quantity == 0 ||
					$minquantity == null || $minquantity == "" || $minquantity == 0 || $mrp == null || $mrp == "" || $mrp == 0 ||
					$discount_price == null || $discount_price == "" || $discount_price == 0)
					{}
				else
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
				}
		}	
		echo"<script type='text/javascript'>alert('count=".$numb."');</script>";
		echo"<script type='text/javascript'>alert('".print_r($data)."');</script>";	
		if($this->Home_admin_model->insertexceldata($data, $numb, $vendor_id))
		{
			redirect('admin/csv_import');
		}
	}
	public function product_list()
	{
		
		$this->login_check();
		$productlist = $this->Home_admin_model->productlist();
		$rowscount = $this->Home_admin_model->productsCount();
		//var_dump( $rowscount);die;
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/product_list',array('data'=>$productlist));
        $this->load->view('_parts/footer');
        $this->saveHistory('Go to home page');
	}
	public function showlist($id)
    {
		
		$data = array();
        $head = array();
        $head['title'] = 'Administration - showlist';
        $head['description'] = '!';
        $head['keywords'] = '';
        $data['record'] = $this->Home_admin_model->showlist($id);
		$head = array(); $head['menu'] = $this->userrole1($_SESSION['userrole1']); $this->load->view('_parts/header', $head);
        $this->load->view('ecommerce/showlist',$data);
		$this->load->view('_parts/footer');
    }
	public function updateproductlist($id)
	{
		//var_dump($id);die;
		$name=$_POST['name'];
		$description=$_POST['description'];
		$company=$_POST['company'];
		$old_price=$_POST['old_price'];
		$data=array('id'=>$id,
				   'name' => $name,
				   'description'=>$description,
				   'company'=>$company,
				   'old_price'=>$old_price
				  );
	$result= $this->Home_admin_model->updatevendors($data);
	if($result==true)
	{
		redirect('admin/product_list');
	}	
	} 
	public function deleteproductlist($id)
	{
		$this->load->model('Home_admin_model'); 	
		$response=$this->Home_admin_model->deleteproductlist($id);
		 
		if($response==true)
		{
			echo "<script> alert($response)</script>";
			redirect('admin/product_list');
		}
		else
		{
			echo " Error";
		}				
	}  
	// admin password change email alert
	public function adminpwdchange()
	{
		$this->load->library('email');
			
		$message = "Dear Admin, <br>";
		$message .= "This is to notify that your password in changed.<br>";
		$message .= "Warm Regards <br>";
		$message .= "Medideals Team <br>";
	
		//$this->email->initialize($config);
		// Sender email address
		$this->email->from('support@medideals.co.in', 'Medideals Team');
		// Receiver email address
		$this->email->to('admin@medideals.co.in');
		// Subject of email
		$this->email->subject("Password change alert");
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
	function select_validate($selectValue)
    {
        // 'none' is the first option and the text says something like "-Choose one-"
        if ($selectValue == 'none') {
            $this->form_validation->set_message('select_validate', 'Please Select One.');
            return false;
        } else // user picked something
            {
            return true;
        }
    }
}
