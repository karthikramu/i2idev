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
* Validate itegers
* 
* @access public 
* @param $value - value to be validated
* @param $type - 'int' - all intgers +ve or -ve
* @param $type - 'pve' - all intgers only +ve
* @Escapes special characters in a string for use in a SQL statement
* @return string
*/
function validate_int($value,$type='int'){
	
	$ret_val = FALSE;

	// filter it
	if($type=='int'){
		if( filter_var(trim($value),FILTER_VALIDATE_INT) ){
			$ret_val = TRUE;
		}
	}else if($type=='pve'){
		if( filter_var(trim($value),FILTER_VALIDATE_INT,array('options'=>array('min_range'=>1))) ){
			$ret_val = TRUE;
		}
        }

	return $ret_val;
}

/**
 * Long date helper
 * 
 * @access public 
 * @function lngDate
 * @param $dt - date to convert, optional
 * @returns - date in standard SM long format
 *
*/
function lngDate($dt) {
	global $i18n;

	if (!$dt) {
		$data = date("F jS, Y - g:i A");
	} else {
		$data = date("F jS, Y - g:i A", strtotime($dt));
	}
	return $data;
}

/**
 * Short date helper
 * 
 * @access public 
 * @function shtDate
 * @param $dt - date to convert, optional
 * @returns - date in standard SM short format
 *
*/
function shtDate($dt) {
	global $i18n;
	if (!$dt) {
		$data = date("M j, Y");
	} else {
		$data = date("M j, Y", strtotime($dt));
	}
	return $data;
}

/**
 * @function clean_url
 * @param $text - text you want to turn encode into a URL
 * @returns valid encoded url
 *
*/
function clean_url($text)  {
	if (function_exists('mb_strtolower')) {
		$text = strip_tags(mb_strtolower($text)); 
	} else {
		$text = strip_tags(strtolower($text)); 
	}
	$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','='); 
	$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','',''); 
	$text = str_replace($code_entities_match, $code_entities_replace, $text); 
	$text = urlencode($text);
	return $text; 
} 

/**
 * @function to7bit
 * @param $text - text you want to turn encode from UTF8
 * @returns valid encoded string
 *
*/
function to7bit($text,$from_enc) {
		if (function_exists('mb_convert_encoding')) {
   		$text = mb_convert_encoding($text,'HTML-ENTITIES',$from_enc);
   	}
    $text = preg_replace(
        array('/&szlig;/','/&(..)lig;/',
             '/&([aouAOU])uml;/','/&(.)[^;]*;/'),
        array('ss',"$1","$1".'e',"$1"),
        $text);
    return $text;
}

function combine_url_chunks($p1,$p2='',$binder='_'){

	$url = '';
	if($p1!=''){
		$url .= $p1;
	}
	if($p2!=''){
		$url .= $binder.$p2;
	}
	return $url;
}


function isAjax() {

	return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));

}

/**
* @function passhash
* @returns returns a hashed password
*
*/
function passhash($p) {
	$CI =& get_instance();
	$GSLOGINSALT = $CI->config->item('GSLOGINSALT');
	
	if($GSLOGINSALT && $GSLOGINSALT != '') {
		$logsalt = sha1($GSLOGINSALT);
	} else {
		$logsalt = null;
	}
	
	return sha1($p . $logsalt);
}

/** 
* Calculates average of values of given array
* 
* @access public
* @return string
*/ 
function caluculate_average($terms = array()) {

	return array_sum($terms)/count($terms);

}

/** 
 * @function shtPara
 * @param $paragraph - paragraph to shorten
 * @param $limit - number of characters to show
 * @url $paragraph - url to open when "read more" is clicked
 * @rmtext $paragraph - "read more" link text
 * @returns - initial short text to display with "...Read More"
 *
*/
function shtPara($paragraph, $limit=100, $url='', $rmtext='READ MORE') {
	if(strlen($paragraph)>$limit){
		$rough_short_par = substr($paragraph, 0, $limit);
		$last_space_pos = strrpos($rough_short_par, " ");
		$clean_short_par = substr($rough_short_par, 0, $last_space_pos);

		$clean_sentence = $clean_short_par . " ..."; //could link the read more to full article
	}else{
		$clean_sentence = $paragraph;
	}
	$clean_sentence .= $url!=''?'<a href="'.$url.'"><b>'.$rmtext.'</b></a>':'';
	
	return $clean_sentence;
}

/******************************************************/
/* End of file MY_common_helper.php */
/* Location: ./application/helpers/MY_common_helper.php */