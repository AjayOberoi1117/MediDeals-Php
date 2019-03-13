<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class AddProduct extends VENDOR_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array(
            'Products_model',
            'admin/Languages_model',
            'admin/Categories_model'
        ));
    }
	public function location($id)
	{
	//echo $id;
	 $head = array();
			$head['title'] = 'Add Location';
			$head['description'] = 'Add Location';
			$head['keywords'] = '';
			$data['id']=$id;
			$data['vendorid']=$_SESSION['vendor_id'];
			$data['states']=$this->Products_model->showstate();
			$this->load->view('_parts/header', $head);
			$this->load->view('add_location', $data);
			$this->load->view('_parts/footer');
	}


	public function view_location($id)
	{

	$head = array();
			$head['title'] = 'View Location';
			$head['description'] = 'View Location';
			$head['keywords'] = '';
			$data['id']=$id;
			$data['vendorid']=$_SESSION['vendor_id'];
			$data['states']=$this->Products_model->showstate();
			$this->load->view('_parts/header', $head);
			$this->load->view('view_location', $data);
			$this->load->view('_parts/footer');
	}

	public function save_location()
	{
	//print_r($_POST);
	   $result = $this->Products_model->setLocation($_POST);
	   redirect(LANG_URL . '/vendor/AddProduct/view_location/'.$_POST['id']);
	//redirect(LANG_URL . '/vendor/Addproduct');
	}
	public function find_city()
	{
			
		if(isset($_POST['state_id']))
			{
			 $id=$_POST['state_id'];
			
			}
		$data = $this->Products_model->getcity($id);

	}
    public function index($id = 0)
    {
		$_SESSION['vendorid']=$this->vendor_id;
	 
        $trans_load = null;
        if ($id > 0 && $_POST == null) {
            $_POST = $this->Products_model->getOneProduct($id, $this->vendor_id);
            $trans_load = $this->Products_model->getTranslations($id);
        }
        if (isset($_POST['setProduct'])) {
            $_POST['image'] = $this->uploadImage();
            $_POST['vendor_id'] = $this->vendor_id;
	
            $result = $this->Products_model->setProduct($_POST, $id);
            if ($result !== false) {
                $result_msg = lang('vendor_product_published');
            } else {
                $result_msg = lang('vendor_product_publish_err');
            }
            $this->session->set_flashdata('result_publish', $result_msg);
            redirect(LANG_URL . "/vendor/Addproduct/location/$result");
        }
        $data = array();
        $head = array();
        $head['title'] = lang('vendor_add_product');
        $head['description'] = lang('vendor_add_product');
        $head['keywords'] = '';
        $data['languages'] = $this->Languages_model->getLanguages();
        $data['shop_categories'] = $this->Categories_model->getShopCategories();
        $data['otherImgs'] = $this->loadOthersImages();
			
			//print_r($data['cities']);
			
        $data['trans_load'] = $trans_load;
        $this->load->view('_parts/header', $head);
        $this->load->view('add_product', $data);
        $this->load->view('_parts/footer');
    }

    private function uploadImage()
    {
        $config['upload_path'] = './attachments/shop_images/';
        $config['allowed_types'] = $this->allowed_img_types;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('userfile')) {
            log_message('error', 'Image Upload Error: ' . $this->upload->display_errors());
        }
        $img = $this->upload->data();
        return $img['file_name'];
    }

    /*
     * called from ajax
     */

    public function do_upload_others_images()
    {
        if ($this->input->is_ajax_request()) {
            $upath = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
            if (!file_exists($upath)) {
                mkdir($upath, 0777);
            }

            $this->load->library('upload');

            $files = $_FILES;
            $cpt = count($_FILES['others']['name']);
            for ($i = 0; $i < $cpt; $i++) {
                unset($_FILES);
                $_FILES['others']['name'] = $files['others']['name'][$i];
                $_FILES['others']['type'] = $files['others']['type'][$i];
                $_FILES['others']['tmp_name'] = $files['others']['tmp_name'][$i];
                $_FILES['others']['error'] = $files['others']['error'][$i];
                $_FILES['others']['size'] = $files['others']['size'][$i];

                $this->upload->initialize(array(
                    'upload_path' => $upath,
                    'allowed_types' => $this->allowed_img_types
                ));
                $this->upload->do_upload('others');
            }
        }
    }

    public function loadOthersImages()
    {
        $output = '';
        if (isset($_POST['folder']) && $_POST['folder'] != null) {
            $dir = 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . $_POST['folder'] . DIRECTORY_SEPARATOR;
            if (is_dir($dir)) {
                if ($dh = opendir($dir)) {
                    $i = 0;
                    while (($file = readdir($dh)) !== false) {
                        if (is_file($dir . $file)) {
                            $output .= '
                                <div class="other-img" id="image-container-' . $i . '">
                                    <img src="' . base_url('attachments/shop_images/' . $_POST['folder'] . '/' . $file) . '" style="width:100px; height: 100px;">
                                    <a href="javascript:void(0);" onclick="removeSecondaryProductImage(\'' . $file . '\', \'' . $_POST['folder'] . '\', ' . $i . ')">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </div>
                               ';
                        }
                        $i++;
                    }
                    closedir($dh);
                }
            }
        }
        if ($this->input->is_ajax_request()) {
            echo $output;
        } else {
            return $output;
        }
    }

    /*
     * called from ajax
     */

    public function removeSecondaryImage()
    {
        if ($this->input->is_ajax_request()) {
            $img = '.' . DIRECTORY_SEPARATOR . 'attachments' . DIRECTORY_SEPARATOR . 'shop_images' . DIRECTORY_SEPARATOR . '' . $_POST['folder'] . DIRECTORY_SEPARATOR . $_POST['image'];
            unlink($img);
        }
    }
	
	public function Addstate()
	{
			
			$data = array();
			$head = array();
			$head['title'] = 'Add State';
			$head['description'] = 'Add State';
			$head['keywords'] = '';

			$this->load->view('_parts/header', $head);
			$this->load->view('add_state', $data);
			$this->load->view('_parts/footer');

	}
	public function Savestate()
	{
		$statename=$_POST['name'];
		$data = array(
			   'state_name' => $statename
			);

		if($this->db->insert('state_master', $data))
		{
			redirect('vendor/addproduct/Addstate');

		}
	}

	public function Addcity()
	{
		
			$data = array();
			$head = array();
			$head['title'] = 'Add City';
			$head['description'] = 'Add City';
			$head['keywords'] = '';
			$data['states']=$this->Products_model->showstate();
			$this->load->view('_parts/header', $head);
			$this->load->view('add_city', $data);
			$this->load->view('_parts/footer');

	}

	public function Savecity()
	{
		$cityname=$_POST['name'];
		$stateid=$_POST['state'];
		$data = array(
				   'city_name' => $cityname,
				   'state_id'=>$stateid
				);

		if($this->db->insert('city_master', $data))
		{
			redirect('vendor/addproduct/Addcity');

		}

	}




}
