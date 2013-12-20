<?php
class Registration extends CI_Controller {

	public $page_id = 'registration';
	private $page_data = array();

	/**
	 * Constructor
	 */
	function __construct()
	{
		parent::__construct();
		
	
		$this->load->library('form_validation');
		$this->load->model('user_model');
		

	}

	
	/**
	 * Controls the login page
	 *
	 * @access public
	 * @return void
	 */
	function index()
	{
		//die("here");			

		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
			$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');		
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
	
			sleep(2); 
			
			if ($this->form_validation->run() == FALSE){
				$this->page_data['submit_message'] = '<div class="errormsg">Check the following errors: '.validation_errors().'</div>';
			}else{			
				$user_data = array();		
				$user_data['email'] = $this->input->post('email');	
				$user_data['password'] = passhash($this->input->post('password'));	
				$email_exists = $this->user_model->check_email_exist($user_data['email']);	
				/* print_pre($user_data['password']);
				die; */
				if($email_exists==true){							
					$password_match=$this->user_model->check_password_match($user_data['email'],$user_data['password']);			
				if($password_match==true){				
						/*if($this->input->post('remember_me')){
								
									$cookie = array(
									'name'   => 'keyMaster',
									'value'  =>  $user_data['username'],
									'expire' => 3600*24*30,
									'domain' => 'bazaar-deals.com',
									'path'   => '/',
									'prefix' => ''
								);
								$this->input->set_cookie($cookie);
					
					
								$cookie1 = array(
									'name'   => 'mjSession',
									'value'  =>  $this->my_encrypt_class->encode($this->input->post('password')),
									'expire' => 3600*24*30,
									'domain' => 'bazaar-deals.com',
									'path'   => '/',
									'prefix' => ''
								);
								$this->input->set_cookie($cookie1);
						
								
								}
								*/
			
			$user_id = $this->user_model->getID_byUsername($user_data['email']) ;
					
				if($this->session->userdata('cart_id')!=''){
					
					
					$date = date("Y-m-d H:i:s") ; 
					$update_data = array('user_id' =>$user_id,'is_save' => 'y','purchase_date' =>"$date");
					$this->db->where('id',$this->session->userdata('cart_id'));
					$str = $this->db->update('cart', $update_data);
					
					
				}
				
			$this->user_model->create_user_session($user_id,$this->input->post('current_url'));			
			}else{				
			$this->page_data['submit_message'] = '<div class="errormsg">Check the following errors: <p>Please enter correct password</p></div>';		
			}			
			}else{		
			$this->page_data['submit_message'] = '<div class="errormsg">Check the following errors: <p>Email not registered.</p></div>';			
			}
			}
		}

		$this->page_data['page_title'] = 'Registration' ;
		/**
		 * Generate view
		 */
		/* $data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
		);
		$data['main_content']   = array(
									'load_view' 		 	 => 'login/login_view',
									'left_column_content'	 => 'blank.html',
		);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
		);
 */
		$this->load->view('login/login_registration',$this->page_data);
		
	}

	

	function register()
	{

		if($this->uri->segment(2) && trim($this->uri->segment(2))!=''){
			$this->page_data['consumer']	=  $this->uri->segment(2) ;
		}
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
		
			$user_str = '';
			
			sleep(2); 

				$user_email = $this->input->post('email');
				
				$email_id=$this->user_model->check_email_exist($user_email);
				if($email_id==true){
					$this->page_data['submit1_message'] = '<div class="errormsg">The email address you provided is already in use. Please choose another email.</div>';
				}else{								
					$user_data = array();
					$user_data['email'] = $user_email;
					//$user_data['invention_number'] = 01;
					//$user_data['confirm_code'] = 123;
					//$user_data['isactive'] = "Y";
					//$user_data['user_type'] = 1;
					$user_data['created'] = date("Y-m-d H:i:s", time());
					//$user_data['modified'] = now();
				
					$user_data['investigator_name'] = $this->input->post('Name');
					$user_data['investigator_lname'] = $this->input->post('LName');
					$user_data['institutional_title'] =$this->input->post('institutionalTitle');
					$user_data['phone_number'] =$this->input->post('mobile');
					$user_data['citizen_ship'] =$this->input->post('citizenship');
					$user_data['home_address'] =$this->input->post('Address');
					$user_data['password'] = passhash($this->input->post('password'));
					$user_data['isactive'] ="N" ;
					$user_data['is_admin'] = "0";
					//$user_data['email']=0;
					
					$user_id  = $this->user_model->member_signup($user_data);
					//$this->load->view('formsuccess');
				
					//$mail_msg = $this->user_model->verificationemail($user_data);
					$dataAdmin= '<div class="successMsg">You have been successfully registered. Admin will get back with the confirmation email.</div>';
					$this->session->set_userdata('confirmMsg',$dataAdmin);
					redirect('home', 'refresh');
					
					
		
		
				//$this->session->set_flashdata('create_profile_successful', $some_data);
				//redirect( 'registration/successful' );
				
				}
			
			
		}

		

		/**
		 * Generate view
		 */
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_registration',
									'page_data'				 => $this->page_data,
		);
		$data['main_content']   = array(
									'load_view' 		 	 => 'login/login_registration',
		);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_registration',
		);

		$this->load->view('templates/template_registration',$data);
	}

	
	
	function successful(){
    if( FALSE == ($data = $this->session->flashdata('create_profile_successful'))){
        redirect('/');  
    }

    $data['h1title'] = 'Successful Registration';
    $data['subtext'] = '<p>Test to go here</p>';

    // Load the message page
    $this->load->view('message',$data);
}
	
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */