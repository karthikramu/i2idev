<?php
/**
 * Users Online class
 *
 * Manages active users
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Add-Ons
 * @author		Gaurav Bansal
 */

class MY_online_users{

	var $table_name = "log_users_online";
	var $sessiontime = 3; //minutes
	var $data = array();
	var $ip;

	function OnlineUsers(){

		$CI =& get_instance();
		$this->ip = $_SERVER['REMOTE_ADDR'];

		$this->table_name = $CI->db->dbprefix($this->table_name);

		//------------------------------------------------
		// Delete expired sessions
		$CI->db->query("DELETE FROM $this->table_name WHERE unix_timestamp() - last_visit >=".$this->sessiontime." * 60");
		//------------------------------------------------

		$page_url = $_SERVER['REQUEST_URI'];

		// Find the ip in database
		$CI->db->select('last_visit')->where('user_ip',$this->ip);
		$query = $CI->db->get($this->table_name);
		
		// Update class variable data
		if($query->num_rows()>0){
			$this->data = $query->result_array();
		}
		//If it's the first hit, add the information to database
		if($query->num_rows()==0){
			
			$referral = strip_tags( @$_SERVER['HTTP_REFERER'] );
			$user_agent = $_SERVER['HTTP_USER_AGENT'];
	
			//------------------------------------------------
			//Loads the USER_AGENT class if it's not loaded yet
			if(!isset($CI->agent)) { $CI->load->library('user_agent'); $class_loaded = true; }
			if($CI->agent->is_robot()){
				$user_type = 'bot';
				$user_agent = $CI->agent->robot();
			}
			else{
				$user_type = 'guest';
			}
			
			//Destroys the USER_AGENT class so it can be loaded again on the controller
			if($class_loaded) unset($class_loaded, $CI->agent);
			//------------------------------------------------

			$CI->db->query("INSERT INTO ".$this->table_name." SET site_id=1,user_ip = '$this->ip',user_type = '$user_type',page_url = '$page_url',referral = '$referral',user_agent = '$user_agent', last_visit = unix_timestamp()");
		}
		// If found update the lastvisit and current url
		else{
			$CI->db->query("UPDATE ".$this->table_name." SET page_url = '$page_url', last_visit = unix_timestamp() WHERE user_ip = '$this->ip'");
		}
	}

	//this function return the total number of online users
	function total_users(){
		return count($this->data);
	}
	//this function return the total number of online robots
	function total_robots(){
		$i=0;
		foreach($this->data as $value)
		{
			if($value['user_type']=='bot') $i++;
		}
		return $i;
	}

	//Used to set custom data
	function set_data($data=false, $force_update=false){
		
		// TODO Still to do this function
		
	}
	//
	function get_info(){
		return @$this->data;
	}	
}