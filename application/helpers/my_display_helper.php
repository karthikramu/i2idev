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
 * Display Helper
 *
 * Provide helper functions for common display operations.
 *
 * @package		Questionnaire
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Gaurav Bansal
 */


/** 
* Display formatted error message.
* 
* @access public 
* @param string
* @param string
* @return string
*/ 
function display_error($error, $type = null)
{
	// Make sure an error message is provided.
	if($error) 
	{
		// Determine what type of error to return.
		switch($type) 
		{
			case 'form':
				return '<div id="alert-red">Please check the following and try again:<ul>' . $error . '</ul></div>';
			break;
		
			default:
				return '<div id="alert-red">' . $error . '</div>';
			break;
		}
	}
}


/** 
* Display formatted system message.
* 
* @access public 
* @param string
* @return string
*/ 
function display_msg($msg)
{
	if($msg) 
	{
		return '<p id="alert-yellow">' . $msg . '</p>';
	}
}


/** 
* Display required field flag.
* 
* @access public 
* @return string
*/ 
function req_field()
{
	return '<em>*</em>';
}


/** 
* Generate HTML code for JS confirmation boxes displaying a provided message.
* 
* @access public 
* @param string
* @return string
*/ 
function js_confirm($msg = NULL) 
{
	if($msg == NULL)
	{
		$message = 'Are you sure?';
	}
	else
	{	
		$message = $msg;
	}
	
	return 'onclick="return confirm(\'' . $message . '\');"';
}

/** 
* Display required field flag.
* 
* @access public 
* @return string
*/ 
function print_pre($array)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

/* End of file display_helper.php */ 
/* Location: ./application/helpers/display_helper.php */ 