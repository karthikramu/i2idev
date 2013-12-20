<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Questionnaire
 *
 * @package		Questionnaire
 * @author		Gaurav Bansal
 * @copyright	Copyright (c) 2011
 * @link		http://www.Questionnaire.com
 * @since		Version 1.0
 */

// ------------------------------------------------------------------------

class MY_init_class {

	/** 
	* Constructor
	*/ 
	function __construct(){ 
		
		$CI =& get_instance();
		
		// Log user online
		$CI->load->library('my_online_users');
		$CI->my_online_users->OnlineUsers();
	
	}
}

/* End of file MY_layout_class.php */ 
/* Location: ./application/libraries/MY_layout_class.php */ 