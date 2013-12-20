<?php

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

/**
 * Template Helper
 *
 * Provide helper functions for common program operations
 *
 * @package		Questionnaire
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Gaurav Bansal
 */


/** 
* Checks if user is logged in
* 
* @access public 
* @param key
* @return user id or false
*/
function check_if_logged_in()
{
	$CI =& get_instance();

	$session_id = $CI->session->userdata('userid');
	if($session_id){
		return $session_id;
	}else{
		return FALSE;
	}
}

/** 
* Redirect if logged in
* 
* @access public 
* @param key
* @return user id or false
*/
function login_redirect(){

	$CI =& get_instance();

	$redirect_page = $CI->config->item('login_redirect');
	
	if(check_if_logged_in()){
		redirect($redirect_page);
	}
}

/** 
* Redirect if logged in
* 
* @access public 
* @param key
* @return user id or false
*/
function treat_user(){

	if(!check_if_logged_in()){
		redirect('login');
	}
}

/******************************************************/
/* End of file MY_common_helper.php */
/* Location: ./application/helpers/MY_common_helper.php */