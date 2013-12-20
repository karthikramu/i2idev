<?php
class Login extends CI_Controller {

	public $page_id = 'login';
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

		$this->page_data['page_title'] = 'Login' ;
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
		$this->load->view('login/login_view',$this->page_data);
		
	}

	
	function ForgotPassword()
	{

		$this->form_validation->set_rules('email', 'E-mail address', 'required|valid_email|xss_clean');		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
			if ($this->form_validation->run() == FALSE){

				$this->page_data['submit_message'] = '<div class="errormsg">Check the following errors: '.validation_errors().'</div>';
				
			}else{

				$user_email = $this->input->post('email');

				$email_exists = $this->user_model->check_email_exist($user_email);
				
				if($email_exists==false){

					
					$this->page_data['submit_message'] = '<div class="errormsg">Check the following errors: <p>Email Id : '.$user_email.' not registered.</p></div>';

				}else{

					$code = md5(uniqid(time(), true));

					
					$email_data = array(
						'email'=>$user_email,
						'code'=>$code,
					);

					$subject = "[Questionnaire] Password reset attempt";
					$message = $this->load->view('email/forgot_password_email',$email_data,true);

					$from = $this->config->item('from_address');
					$from_name = $this->config->item('from_name');

					$headers = "From: $from_name<$from>". "\r\n";
					$headers .= "MIME-Version: 1.0\r\n";
					$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

					if(@mail($user_email,$subject,$message,$headers)){
			
						$new_user_data = array('confirm_code' => $code);
						$where = "email = '".$user_email."'";
						$str = $this->db->update('users', $new_user_data, $where);

						$this->page_data['submit_message'] = '<div class="successmsg">Please check your mail to reset your password.</div>';
					}else{				
					$new_user_data = array('confirm_code' => $code);	
					$where = "email = '".$user_email."'";			
					$str = $this->db->update('users', $new_user_data, $where);					
						$this->page_data['submit_message'] = '<div class="errormsg">We are sorry for the inconvenience. Please try again.</div>';
					}
				}
			}
		}

		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
									
		);
		$data['main_content']   = array(
									'load_view' 		 	 => 'login/forgot_password_view',
									'left_column_content'	 => 'blank.html',
		);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
		);

		$this->load->view('templates/template',$data);
		
	}

	
	function ResetPassword(){	
	$manual = FALSE;	
	$this->form_validation->set_rules('npass', 'New Password','trim|required|matches[cnpass]|min_length[6]|max_length[12]|xss_clean');	
	$this->form_validation->set_rules('cnpass', 'Confirm New Password', 'trim|required|matches[npass]|xss_clean');	
	$this->form_validation->set_rules('confirm_code', 'code', 'trim|required|xss_clean');		
		
	if ($this->input->server('REQUEST_METHOD') === 'POST'){	
	if ($this->form_validation->run() == FALSE){	
	set_flash('submit_message','errormsg',validation_errors());		
	redirect(site_url('login/ResetPassword/'.$this->input->post('confirm_code')));	
	}else{		
	$reset=$this->user_model->reset_password(passhash($this->input->post('npass')),$this->input->post('confirm_code'));	
	if($reset){			
	set_flash('submit_message','successmsg','Reset successful. You can login with your new password now.');		
	redirect(site_url('login'));		
	}else{			
	set_flash('submit_message','errormsg','There was a problem resetting your password. Please try again.');					redirect(site_url('login/ResetPassword/'.$this->input->post('confirm_code')));			
	}		
	}	
	}	
	else{
	$confirm_code = $this->uri->segment(3);	
	if ($confirm_code!=''){			
	$query = $this->db->get_where('users', array('confirm_code' => $confirm_code, 'isactive' => 'y'));	
	if ($query->num_rows() > 0) {			
	
	}else{		
	
	show_404('details',TRUE);	
	}			
	}else{	
		
	show_404('details',TRUE);		
	}		
	}	
	/**		 
	* Generate view	
	*/		
	$data['header_content'] = array(	
	'load_view' 		 	 => 'header_view',	
	'page_data'				 => $this->page_data,		
	);		
	$data['main_content']   = array(		
	'load_view' 		 	 => 'login/reset_password_view',	
	'left_column_content'	 => 'blank.html',	
	);		$data['footer_content'] = array(	
	'load_view' 		 	 => 'footer_view',	
	);	
	$this->load->view('templates/template',$data);
	}
	
	function register()
	{

		if($this->uri->segment(2) && trim($this->uri->segment(2))!=''){
			$this->page_data['consumer']	=  $this->uri->segment(2) ;
		}
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('conpassword', 'Confirm Password', 'trim|required|matches[password]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');
	
			
			$user_str = '';
			
			sleep(2); 

			if ($this->form_validation->run() == FALSE){				
				$this->page_data['submit_message'] = '<div class="errormsg">Check the following errors: '.validation_errors().'</div>';
			}else{		


				$user_email = $this->input->post('email');
				
				$email_id=$this->user_model->check_email_exist($user_email);
				if($email_id==true){
					$this->page_data['submit_message'] = '<div class="errormsg">The email address you provided is already in use. Please choose another email.</div>';
				}else{								
					$user_data = array();
					$user_data['email'] = $user_email;
					$user_data['first_name'] = $this->input->post('first_name');
					$user_data['last_name'] =$this->input->post('last_name');
					$user_data['password'] = passhash($this->input->post('password'));
					
					$user_id  = $this->user_model->member_signup($user_data);
				
					$mail_msg = $this->user_model->verificationemail($user_data);
					redirect('register/registersuccess', 'location');
				
				}
			
			}
		}

		

		/**
		 * Generate view
		 */
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
		);
		$data['main_content']   = array(
									'load_view' 		 	 => 'login/login_view',
		);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
		);

		$this->load->view('templates/template',$data);
	}

	
	
	
	
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */