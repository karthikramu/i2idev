<?php
class Admin extends CI_Controller {

	public $page_id = 'admin';
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
					

		$this->page_data['page_title'] = 'Admin' ;
		$this->load->view('login/login_admin');
		
	}

	

	function adminLogin()
	{


		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
				
				$user_data = array();
				$user_data['email'] = $this->input->post('email');
				$user_data['password']=passhash($this->input->post('password'));
				$user_id  = $this->user_model->takeUser($user_data['email'], $user_data['password']);
				
				if($user_id==false){
				
					$dataAdminError = '<div class="errormsg">Do not have permission to log in</div>';

		
			
			$this->session->set_userdata('alertMsg',$dataAdminError);
			$this->load->view('login/login_admin' ,'refresh');
				}else{		
				
					//$userList = $this->user_model->load_data();
					$this->load->view('admin_dashboard');
					//$data['query'] = $this->configurations->load_data();
					


				
				}
			
			
		}

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




function confirmUser(){
		
		$id = $_GET['id'];
		
		 //$query 	= $this->db->get_where('users1', array('id' => $id, 'email'));
		 $query = $this->db->query('SELECT email, investigator_name FROM users where id='.$id );
		if ($query->num_rows() > 0) {
			$user_email='';
			$row = $query->row_array();
			 $user_email=$row['email'];
			 $user_name=$row['investigator_name'];
			 

$this->db->where('id', $id);
$this->db->update('users', array('isactive'=>'Y')); 

	
		//-----------------------------------------------------------
	
		$subject = "[Questionnaire] Verification Email";
		$message = 'Hello ' .$user_name ."\r\n";
		$message .="Your Account has been activated. You can login to the account with the credentials from the below mentioned link" . "\r\n";
		$message .= "<a href='http://aavishkarllc.com/llc/login'>Login</a>". "\r\n";
		$message .= "Regards Team Aavishkarllc ";
		$from = "aavishkarllc.com";
		$from_name = "Admin";		
		// Set headers
		$headers = "From: $from_name<$from>". "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		 
		
		if(mail($user_email,$subject,$message,$headers)){
			
			$data = '<div style=" color:000; font-weight:bold;">The account has been activated and an confirmation email has been sent to the customer.</div>';
			
			//////online show this////////////////////////////
			//$new_user_data = array('confirm_code' => $code);
			//$this->db->where('email', $user_email);
			//$str = $this->db->update('users', $new_user_data);
			
			$this->session->set_userdata('activeMsg',$data);
			$this->load->view('admin_dashboard' ,'refresh');
			
			//return $this->page_data['submit_message'];
		}else{
			$this->page_data['submit_message'] = '<div class="errormsg">We are sorry for the inconvenience. Please try again.</div>';
		}
		///////////////////offline show this ////////////////////////
		
		//$new_user_data = array('confirm_code' => $code);
			//	$this->db->where('email', $user_email);
		//$str = $this->db->update('users', $new_user_data);
		
		//return $this->page_data['submit_message'];
		
		
	}	
}





function deActiveUser(){
		
		$id = $_GET['id'];
		
		
			 

$this->db->where('id', $id);
$this->db->update('users', array('isactive'=>'N')); 
	
				
			$data = '<div style=" color:000; font-weight:bold;">The account has been De-activated</div>';
			$this->session->set_userdata('deactiveMsg',$data);
			$this->load->view('admin_dashboard' ,'refresh');

}


function sendMail(){

$this->load->library('email');

$this->email->from('your@example.com', 'Your Name');
$this->email->to('vkerford@gmail.com'); 
$this->email->subject('Email Test');
$this->email->message('Testing the email class.');	

$this->email->send();

echo $this->email->print_debugger();
$this->load->view('welcome_message');

}
	
	
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */