<?php 
/**
 * Questionnaire
 *
 * @package		Questionnaire
 * @author		Gaurav Kumar
 * @copyright	Copyright (c) 2011
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

/**
 * Home Controller
 *
 * Controller for the registration page
 *
 * @package		Questionnaire
 * @subpackage	Controllers
 * @category	Controllers
 * @author		Gaurav Kumar
 */

class Home extends CI_Controller {

	public $page_id = 'home';
	public $page_data = array();

	function __construct(){

		parent::__construct();
		//-----------------------------------------------------------
		// Load additional models
		
		login_redirect();
	}


	public function index(){
	
		
		$user_id  =  $this->session->userdata('userid'); 
		
		if($user_id==''){
			redirect('login','refresh');
		}
		
		
		
		$this->page_data['page_title'] = 'Home' ;
		
		$data['header_content'] = array( 
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									
									'load_view' 		 	 => 'home_view',
									'left_column_content' 	 => '',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);

		$this->load->view('templates/template',$data);

	}
	
	
	
	

	
	
	
	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
