<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
	    // Call the CI_Model constructor
	    parent::__construct();
	    $this->load->model('Urllists');

		$this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
	}


	public function index()
	{
		$info = $this->input->post();
		
		if(count($info) > 0){
			$this->form_validation->set_rules('email','Email','trim|required');
			$this->form_validation->set_rules('password','Password','trim|required');

			if($this->form_validation->run() == false)
			{
				
					$this->load->view('login');
				
				
			}
			else
			{

				$this->db->select('*');
				$this->db->from('user');
				$this->db->where('email',$info['email']);
				$this->db->where('password',SHA1($info['password']));
				$query_result = $this->db->get();
				$result = $query_result->result();

				if(count($result) > 0){
				    $data['admin_id']=$result[0]->id;
					$data['admin_name']=$result[0]->name;
					$data['admin_email']=$result[0]->email;
					$this->session->set_userdata($data);

					$this->session->set_flashdata("success_login", "Logged in Successfully!!");

					redirect(base_url('home'));
             
				}else{
				
					$this->session->set_flashdata("invalid", "Sorry Email or Password didn't match");
					$this->load->view('login');
				}
				
			}
		}else{

			$this->load->view('login');
		}
		
	}
	public function logout()
	{
		// echo $admin_id = $this->session->userdata('admin_id');
		// echo $admin_email = $this->session->userdata('admin_email');
        // die();

		$this->load->library('session');
		$this->session->unset_userdata('admin_id');
		$this->session->unset_userdata('admin_name');
		$this->session->unset_userdata('admin_email');
		$this->session->set_flashdata("logout", "Logout Successfully !!");
		redirect(base_url('home'));
	}
	public function home()
	{
		$admin_id = $this->session->userdata('admin_id');
				if($admin_id !=''){
					$allsettings['settings'] =  $this->Urllists->selectAllData();
		            $this->load->view('allsettings',$allsettings);

				}else{
					$this->load->view('login');
				}
		
	}
	public function addxml()
	{
		$this->load->view('welcome_message');
	}

	public function uploadxmlfile($id){
		$admin_id = $this->session->userdata('admin_id');
		if(isset($admin_id)){

	    if (isset($_FILES['xmlfile']['name'])) {
			$this->load->library('upload');
			$config['upload_path'] = FCPATH . 'uploads/xmlfile/';
			$config['allowed_types'] = 'xml';
			$config['file_name'] = rand(99, 9999) . $_FILES['xmlfile']['name'];
			
			$this->upload->initialize($config);
			if ($this->upload->do_upload('xmlfile')) {
			$uploadData = $this->upload->data();
			
				$fileName = $uploadData['file_name'];
				$handle = FCPATH . 'uploads/xmlfile/'.$fileName;
				//$handle = FCPATH . 'uploads/xmlfile/new.xml';
				$allurl = @simplexml_load_file($handle);
				if(!$allurl){
					$this->session->set_flashdata('xml_faild', 'There is an error in xml file');
				redirect(base_url().'view/'.$id, 'refresh');
				}else{ 
					
					$remove_old_data = $this->Urllists->removeData($id); 
					
				$j = 0;
				$data = [];
				foreach($allurl as $url){
					$urllist = []; 
					$single_url = (array) $url->loc[0];
					$urllist['url'] = $single_url[0];
					$urllist['status'] = 0;
					$urllist['project_id'] = $id;
					$this->Urllists->insertData('urllists',$urllist);
					$j++;
				}
				$data2['xml_file_name']= $fileName;
				$this->db->where('id',$id);
				$result= $this->db->update('settings',$data2);
				//echo $j;die();
				
                $this->session->set_flashdata('success', 'XML uploaded successfully. '.$j.' Urls added.');
                redirect(base_url('home'), 'refresh');
				}
				
			}else{
				$this->session->set_flashdata('faild', 'This is not a Xml file');
				redirect(base_url().'view/'.$id, 'refresh');
			}
			
			}else{
				
				$error = $this->upload->display_errors();
				
				$this->session->set_flashdata('error', $error);
				redirect(base_url().'view/'.$id, 'refresh');
		}

		}else{
			$this->load->view('login');
		}
	}



		public function settings(){
            $admin_id = $this->session->userdata('admin_id');
		    if(isset($admin_id)){
			$info = $this->input->post();
			$data = [];
			// $data['setting'] = $this->Urllists->getSettigns(); 
			//$data['process'] = $this->Urllists->countProcessData(); 
			//$data['alldata'] = $this->Urllists->countAllData(); 
			
			if(count($info) > 0){
			$this->form_validation->set_rules('project_name','Project Name','trim|required');
			$this->form_validation->set_rules('fb_user_access_token','FB user access token','trim|required');
			$this->form_validation->set_rules('app_id','App id','trim|required');
			$this->form_validation->set_rules('app_secret','App secret','trim|required');
			$this->form_validation->set_rules('frequency','Frequency','required');
			$this->form_validation->set_rules('status','Status','required');

			// $this->form_validation->set_error_delimiters('<div class="error">','</div>');
			// $this->form_validation->set_message('required', 'Enter %s');

			if($this->form_validation->run() == false)
			{
				//echo "hello";die();
				//redirect(base_url() . 'settings', 'refresh');	
				//print_r($data['']);die();
				$this->load->view('settings',$data);
			}
			else
			{
				
                $info['renew_time']= time();
			
				

			$id = $this->Urllists->insertData('settings',$info); 
			
			$this->generateLongToken($id);

			//echo $id;die();
			//if($data['setting']->fb_user_access_token != $info['fb_user_access_token'] ){
				
				redirect(base_url() . 'changepage/'.$id, 'refresh');	
			//}else{
			//	redirect(base_url() . 'settings', 'refresh');	
			//}
			}
			}else{	
			
				$this->load->view('settings',$data);

			}
			}else{
				$this->load->view('login');
			}
		}
	
		public function editsettings($id){
			$admin_id = $this->session->userdata('admin_id');
		    if(isset($admin_id)){
			
			$info = $this->input->post();
			$data = [];
			$data['setting'] = $this->Urllists->getSettigns($id); 
			$data['process'] = $this->Urllists->countProcessData($id); 
			$data['alldata'] = $this->Urllists->countAllData($id); 
			if(count($info) > 0){
			$this->form_validation->set_rules('project_name','Project Name','trim|required');
			$this->form_validation->set_rules('fb_user_access_token','FB user access token','trim|required');
			$this->form_validation->set_rules('app_id','App id','trim|required');
			$this->form_validation->set_rules('app_secret','App secret','trim|required');
			if($this->form_validation->run() == false)
			{
			redirect(base_url() . 'edit-settings/'.$id, 'refresh');	
			}
			else
			{
			$siteUrl = $this->Urllists->updateData2('settings',$info,'id',$id); 

			
			if($data['setting']->fb_user_access_token != $info['fb_user_access_token'] ){

				$this->generateLongToken($info);
				redirect(base_url() . 'changepage/'.$id, 'refresh');	
				}else{
				redirect(base_url() . 'edit-settings/'.$id, 'refresh');	
				}
			}
			}else{	
				$this->load->view('editsettings',$data);
			}
		}else{
			$this->load->view('login');
		}
		}

		public function deletesettings($id){
			$this->Urllists->deleteData('settings','id',$id); 
			redirect(base_url('home'), 'refresh');	
		}


		public function getUserID($id){
		
			$settings =  $this->Urllists->getSettigns($id);
			
			//echo "<pre>";print_r($settings);die();
			$ch = curl_init();
			$url = "https://graph.facebook.com/v12.0/me?fields=id,name&access_token=".$settings->fb_user_access_token;
	
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			
			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				echo 'Error:' . curl_error($ch);
			}
			curl_close ($ch);
			$data = json_decode($result, true);
			$userId =  $data['id']; 
			return $userId;  
	}


	public function changepage($id){
		
		


		$settings =  $this->Urllists->getSettigns($id);
		
		$userId = $this->getUserID($id);
        
		$ch = curl_init();

		$url = "https://graph.facebook.com/".$userId."/accounts?fields=name,access_token&access_token=".$settings->long_fb_user_access_token;

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		$pages = json_decode($result, true);
		if(empty($pages['data'])){
			//$pages['no_page']="No page is available.";
			$this->db->where('id',$id);
            $this->db->delete('settings');
			
			$this->session->set_flashdata("no_page", "No page is available !!");
			redirect($_SERVER['HTTP_REFERER']);	
		}
		$pages['id']=$id;
		$info = $this->input->post();
		$pages['project_name']=$settings->project_name;
		//echo "<pre>";print_r($settings);die();
			if(count($info) > 0){
				
				if($info['page'] == 'Select page'){
					redirect(base_url() . 'changepage/'.$id, 'refresh');	
				}else{
					$allpages = $pages['data'];
					foreach($allpages as $page){
						if($page['id'] == $info['page'] ){
					
							$newsetting = [
								'fb_page_access_token'=>$page['access_token'],
								'fb_page_id'=>$page['id'],
							];
							$siteUrl = $this->Urllists->updateData2('settings',$newsetting,'id',$id); 
							redirect(base_url('home'), 'refresh');	
						}
					}
				}
			}
		
			$this->load->view('allpages',$pages);
		

			}


	public function viewSettings($id){

	$admin_id = $this->session->userdata('admin_id');
	if(isset($admin_id)){

	$info = $this->input->post();
	$data = [];
	$data['setting'] = $this->Urllists->getSettigns($id); 
	$data['process'] = $this->Urllists->countProcessData($id); 
	$data['alldata'] = $this->Urllists->countAllData($id);
	$data['id'] = $id; 
	$this->load->view('viewsettings',$data);
		}else{
			$this->load->view('login');
		}
	}

	public function generateLongToken($id){
		
		
		$info = $this->Urllists->getSettigns($id);
        

		$ch = curl_init();
		$url = "https://graph.facebook.com/v12.0/oauth/access_token?grant_type=fb_exchange_token&client_id=".$info->app_id."&client_secret=".$info->app_secret."&fb_exchange_token=".$info->fb_user_access_token;
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
         $result = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		$token = json_decode($result);

		//echo "<pre>";print_r($token);die();
		if($token->access_token){
		$data = ['long_fb_user_access_token'=> $token->access_token];
		$siteUrl = $this->Urllists->updateData2('settings',$data,'id',$info->id); 
		//echo "hello";die();
	    }else{
			$this->db->where('id',$id);
            $this->db->delete('settings');

			$this->session->set_flashdata("no_usertoken", "Your user Token or App id or App secret is not valid!!");
			redirect($_SERVER['HTTP_REFERER']);	
		}
	   
	}
	public function changepassword()
	{ 
		$admin_id = $this->session->userdata('admin_id');
		if(isset($admin_id)){

		$data = $this->input->post();
		
		if(count($data) > 0){

			$this->form_validation->set_rules('old_pass','Old Password','trim|required');
			$this->form_validation->set_rules('new_pass','New Password','trim|required');

			if($this->form_validation->run() == false)
			{
				$this->load->view('changepassword');
			}
			else
			{
			   $admin_id = $this->session->userdata('admin_id');
               $old_pass =$data['old_pass'];

			    $this->db->select('*');
				$this->db->from('user');
				$this->db->where('id',$admin_id);
				$this->db->where('password',SHA1($old_pass));
				$query_result = $this->db->get();
				$result = $query_result->result();

                if(count($result) > 0){
					$data2['password'] =SHA1($data['new_pass']);

					$this->db->where('id',$admin_id);
					$this->db->where('password',SHA1($old_pass));
					$this->db->update('user',$data2);

					$this->session->set_flashdata("change_pass", "Password Changed Successfully!!");

					$allsettings['settings'] =  $this->Urllists->selectAllData();
		            $this->load->view('allsettings',$allsettings);
					
				}else{
					$this->session->set_flashdata("pass_not_match", "Sorry Email or Password didn't match");
					$this->load->view('changepassword');
				}
			   
			}
		}else{
			$this->load->view('changepassword');
		}
	}else{
		$this->load->view('login');
	}
		
	}

}
