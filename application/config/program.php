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
 * Application Config
 *
 * Provide system with application specific configuration information.
 *
 * @package		Questionnaire
 * @subpackage	Config
 * @category	Config
 * @author		Gaurav Bansal
 */

 
// Version of CodeIgniter running for this application.
$config['ci_version'] 		= '1.7.3';

// Version of application.
$config['program_version'] 	= '1.0';


/**
* Program status - whether the program is currently online or not.
* FALSE = offline
* TRUE = online
*/
$config['status'] = TRUE;


/**
* SSL - whether the program is currently checking for secure connections.
* FALSE = no
* TRUE = yes
*/
$config['ssl'] = FALSE;


/**
* Stats tracking - whether the program is currently outputing Google analytics tracking code or not.
* FALSE = is NOT outputting code
* TRUE = IS ouputting code
*/
$config['tracking'] = FALSE;


/**
* Advertising - whether the program should be displaying advertisements or not.
* FALSE = is NOT outputting code
* TRUE = IS ouputting code
*/
$config['display_adds'] = FALSE;


// ------------------------------------------------------------------------

/**
* File Upload Settings
*/
$config['file_upload_path'] = './files/';
//$config['user_images_path'] = 'D:/wamp/www/meraperfectmatch/data/user/userpics_nonce_name/';
$config['allowed_file_types'] = 'avi|3gp|mp4|gif|jpg|jpeg|png|pdf|bmp|flv|mp3|mov|mp4';


// Data path...
$config['data_path'] = str_replace("https://".$_SERVER['HTTP_HOST'],"",$_SERVER['SCRIPT_NAME']);
$config['data_path'] = str_replace(basename($_SERVER['SCRIPT_NAME']),"",$config['data_path']).'data/';
$config['data_path_user'] = str_replace("https://".$_SERVER['HTTP_HOST'],"",$_SERVER['SCRIPT_NAME']);


// Review images path (Common to bars,restaurants, universities)...
$config['reviews_data_path'] = $config['data_path'].'reviews/';

// User images path
$config['user_data_path'] = $config['data_path_user'];
$config['user_images_folder'] = 'user_nonce_name';

// Images path
$config['image_path'] = $config['data_path'].'common/';
$config['images_folder'] = 'common_nones_name';

// Prodct images path ()...
$config['product_data_path'] = $config['data_path'].'products/';

// space images path ()...
$config['deal_data_path'] = $config['data_path'].'deals/';
$config['deal_images_folder'] = 'images/dealpics_nones_name/';

// space images path ()...
$config['tumbs_data_path'] = $config['data_path'].'thumbs/';

// City map images path ()...
$config['city_map_data_path'] = $config['data_path'].'citymaps/';


// ------------------------------------------------------------------------

$config['default_location_id'] = 'newyork';
$config['location_cookie_abbrev'] = 'sel_loc_abbrev';
$config['location_cookie_text'] = 'sel_loc_text';

// For Local
//$config['google_map_api_key'] = 'ABQIAAAAzr2EBOXUKnm_jVnk0OJI7xSosDVG8KKPE1-m51RBrvYughuyMxQ-i1QfUnH94QxWIa6N4U6MouMmBA';
// For http://hungrycity.sdplabs.com
$config['google_map_api_key'] = 'ABQIAAAA3Ii6TXFu1W74MP8deJriTxRvERpGtLKulUg69WDbDtzz4gI9EhSbYPCU1LjxOc1YOwxmjbdculk7ow';

// ------------------------------------------------------------------------

/**
* Paging settings
*/
$config['paging_settings']['per_page'] = 10;
$config['paging_settings']['num_links'] = 2;
$config['paging_settings']['js_function'] = '_listLoad';

// ------------------------------------------------------------------------
/**
* Password Salt
*/
$config['GSLOGINSALT'] = "ShX-Jdru1=aRvp9hcFQ4iWLvt=LKp|XW-ZsR2fypRc=Ka6tf dZ~n4N";

// ------------------------------------------------------------------------
/**
* Login redirect page
*/
$config['login_redirect'] = 'user/home';
$config['admin_login_redirect'] = 'admin/login';

// ------------------------------------------------------------------------
/**
* E-mail Settings
*/

$config['admin_address'] = 'admin@realfantasywrestling.net';
$config['admin_phone'] = '';
$config['from_address'] = 'info@realfantasywrestling.net';
$config['from_name'] 	= 'Real Fantasy Wrestling';
$config['reply_address'] = '';
$config['reply_name'] = '';

/****
Abuse word array
*/
$config['array_abuse'] = array("Anus", "Apeshit", "Arsehole", "Ass", "Asshole", "Asswipe", "Bastard", "Bitch", "Boob", "Chingate", "Cocksucker", "Codsucker", "Cracker", "Crap", "Cunt", "Damn", "Dick", "Dickwad", "Doosch", "Dummy", "Dyke", "Fag", "Faggot", "Fart", "Fuck", "GodDamn", "Hell", "Holycrap", "Jerk", "Knockers", "Loc", "Motherfucker", "Muthafuka", "Niger", "Nigger", "Piss", "Porn", "Prick", "Pussy", "Queer", "Redneck", "Shag", "Shit", "Shitface", "Shithead", "Sissy", "Slut", "Spic", "Stupid", "Spic", "Sumbitch", "Sumbitches", "Terrorist", "Tit", "Turd", "Twat", "Whore", "Woody" );
/*****************/

/* End of file application.php */ 
/* Location: ./application/config/application.php */ 