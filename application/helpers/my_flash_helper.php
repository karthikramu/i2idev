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
 * Flash Helper
 *
 * Provide helper functions for common flash message operations.
 *
 * @package		Questionnaire
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Gaurav Bansal
 */


/** 
* Display formatted flash message.
* 
* @access public 
* @param string
* @return string
*/ 
function display_flash($name)
{
	$CI =& get_instance();
	
	if($CI->session->flashdata($name)) 
	{
		$flash = $CI->session->flashdata($name);
		return '<div class="' . $flash['type'] . '">' . $flash['msg'] . '</div>';
	}
}

/** 
* Return flash message value.
* 
* @access public 
* @param string
* @return string
*/ 
function get_flash_value($name)
{
	$CI =& get_instance();
	
	if($CI->session->flashdata($name)) 
	{
		$flash = $CI->session->flashdata($name);
		return $flash['msg'];
	}
}

/** 
* Save provided message as a flash variable.
* 
* @access public 
* @param string
* @param string
* @param string
* @return string
*/ 
function set_flash($name, $type, $msg)
{
	$CI =& get_instance();
	$CI->session->set_flashdata($name, array('type' => $type, 'msg' => $msg));
}

/* End of file flash_helper.php */ 
/* Location: ./application/helpers/flash_helper.php */ 