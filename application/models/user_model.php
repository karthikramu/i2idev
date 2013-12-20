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
 * Some Model
 *
 * Model for User data
 *
 * @package		Questionnaire
 * @subpackage	Models
 * @category	Models
 * @author		Gaurav Bansal
 */

class User_model extends CI_Model
{
	/** 
	* Constructor
	*/
	var $page_data; 
	
	public function __construct(){
		parent::__construct();
	}
	
	
	// ------------------------------------------------------------------------

	/** 
	* Create New User
	* 
	* @access public 
	* @return void
	*/ 
	function member_signup($user_data){
		
		if($this->db->insert('users', $user_data)){
		
			$id = $this->db->insert_id();
			$this->db->insert('inventors', $user_data);
			
			$query = $this->db->get_where('users', array('id' => $id));
			if ($query->num_rows() > 0){
				$user_data = '';
				$row = $query->row_array();
				$user_data = $row['id'];
			}
			return $user_data;
		}else{
			return false;
		} 
	}
	
	
 function takeUser($username, $password){
	 
	       $query = $this->db->get_where('users', array('email' => $username, 'password' => $password, 'is_admin' => 1));
				return $query->num_rows();
			if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
   function userData($username){

				$this->db->select('username');			
				$this->db->select('name');			
				$this->db->where('username', $username);			
				$query = $this->db->get('user');		
				return $query->row();

		}	
	
	
	
	
	
	function get_next_invention($user_data){
		
		if($this->db->insert('inventions', $user_data)){
		
			$id = $this->db->insert_id();
			
			
			return $id;
		}else{
			return false;
		} 
	}
	
	function get_user_inventions($user_id,$limit = true){
		if($limit){
			$this->db->limit(20);
		}
		
		
		$query = $this->db->get_where('inventions', array('user_id' => $user_id));
		
		$result = array();
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	//added by ethan
	function get_innventor_inventions_forcount($user_id,$limit = true){
		if($limit){
			$this->db->limit(20);
		}
		
		
		//$query = $this->db->get_where('inventions', array('user_id' => $user_id));
		$query = $this->db->get_where('invention_inventor', array('inventor_id' => $user_id));
		$result = array();
		
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	
	
	function delete_invention_inventor($invention_id){
		$str = $this->db->delete('invention_inventor', array('invention_id'=>$invention_id)); 
	}
	function delete_invention_inventor_by_id($invention_id,$inventor_id){
		$str = $this->db->delete('invention_inventor', array('invention_id'=>$invention_id,'inventor_id'=>$inventor_id)); 
	}
	function insert_invention_inventor($insert_data){
		
		if($this->db->insert('invention_inventor', $insert_data)){
		
			$id = $this->db->insert_id();
			
			
			return $id;
		}else{
			return false;
		} 
		
	}
	
	function insert_inventor_data($inventor_data){
		
		if($this->db->insert('inventors', $inventor_data)){
		
			$id = $this->db->insert_id();
			
			
			return $id;
		}else{
			return false;
		} 
		
	}
	
	function update_inventor_data($update_data,$user_id){
		
		$str = $this->db->update('inventors', $update_data, array('id'=>$user_id)); 
		
	}
	
	function update_invention($update_data,$id){
		$str = $this->db->update('inventions', $update_data, array('id'=>$id)); 
		
	}
	
	
	function get_invention_by_id($id){
		$query 	= $this->db->get_where('inventions', array('id' => $id));
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->row_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	
	function get_invention_inventor_by_id($invention_id){
		$query 	= $this->db->get_where('invention_inventor', array('invention_id' => $invention_id));
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	
	function get_invention_inventor_by_id_inventor($invention_id){
		$select_array = array(
			'invention_inventor.*',
			'inventors.investigator_name'
		);
		
		$this->db->select($select_array);
		$this->db->join('inventors','inventors.id =invention_inventor.inventor_id');
	
		$query 	= $this->db->get_where('invention_inventor', array('invention_inventor.invention_id' => $invention_id));
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	
	
	function check_user_invention($user_id,$id){
		$query 	= $this->db->get_where('inventions', array('id' => $id,'user_id'=>$user_id));
		$result = array();
		if ($query->num_rows() > 0) {
			
			return true ; 
		}else{
			return false;
		}
		
	}
	
	function delete_invention($id){
		$query 	= $this->db->delete('inventions', array('id' => $id));
		$query1 	= $this->db->delete('invention_inventor', array('invention_id' => $id));
	}
	
	function get_invention_inventor($invention_id){
		$select_array = array(
			'invention_inventor.*',
			'inventors.*'
		);
		$this->db->select($select_array);
		
		
		$this->db->join('inventors', 'inventors.id = invention_inventor.inventor_id');
	
		$query 	= $this->db->get_where('invention_inventor', array('invention_inventor.invention_id' => $invention_id));
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	
	
	
	
		
	function get_inventors_name(){
		$this->db->select('*') ;
		$result = array(); 
		$query = $this->db->get('inventors');
		if ($query->num_rows() > 0) {
			
				return $query->result_array();
			
		}else{
			return $result ; 
		}
	}	
	
	function check_member($user_data){
		$query = $this->db->get_where('members', array('email' => $user_data['email']));
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			if($user_data['password'] != $row['password']) {
				return "E::WP";
			}else{
				return "E::".$row['id'];
			}
		}else{
			return "E::NOID";
		}
	}	
	
	function get_user_login_detail($uid){
		$query = $this->db->get_where('users', array('id' => $uid));
		if ($query->num_rows() > 0){
			$user_data = array();
			$row = $query->row_array();
			$user_data['userid'] = $uid;
			$user_data['email'] = $row['email'];
			$user_data['username'] = $row['investigator_name'];
			$user_data['home_address'] = $row['home_address'];
			$user_data['phone_number'] = $row['phone_number'];
			$user_data['user_type'] = $row['user_type'];
			$user_data['is_admin'] = $row['is_admin'];
			
			//print_pre($user_data);die;
			return $user_data;
		}
		
	}
	
	function get_user_tmp_detail($uid){
		$query = $this->db->get_where('members', array('user_id' => $uid));
		if ($query->num_rows() > 0){
			$user_data = array();
			$row = $query->row_array();
			$user_data['tmpuserid'] = $row['user_id'];
			$user_data['tmpemail'] = $row['email'];
			$user_data['tmpfirst_name'] = $row['first_name'];
			$user_data['tmplast_name'] = $row['last_name'];
			$user_data['tmpcity'] = $row['city'];
			$user_data['tmpzip'] = $row['zip'];
			$user_data['tmpstate'] = $row['state'];
			$user_data['tmpphone'] = $row['phone'];
			$user_data['tmpdate_added'] = $row['date_added'];
			$user_data['tmpDOB'] = show_date($row['DOB']);
			$user_data['tmpgender'] = $row['gender'];
			$user_data['tmpcountry'] = $row['country'];
			if(($row['user_pic']==NULL ) || $row['user_pic']==''){
				$user_data['tmpuser_pic'] = 'na.jpg';
			}
			
			else{
				$user_data['tmpuser_pic'] = $row['user_pic'];
			}
			
			
			$user_data['tmpbiodata'] = $row['biodata'];
			return $user_data;
		}
	}
	

	
	function get_user_detail_name($username){
		$result = array();
		$query = $this->db->get_where('inventors', array('investigator_name' => $username));
		if ($query->num_rows() > 0){
			$user_data = array();
			$row = $query->row_array();
			
			return $row;
		}else{
			return $result;
		}
		
	}
	
	function get_user_detail($uid){
		$query = $this->db->get_where('users', array('id' => $uid));
		if ($query->num_rows() > 0){
			$user_data = array();
			$row = $query->row_array();
			
			return $row;
		}else{
			return false;
		}
		
	}
	
	
	function create_user_session($user_id,$cur_url=''){
		
		
		$userlogindataold = array(
			'cart_id' => '',
			'userid' => '',
			'email' => '',
			'city' => '',
			'zipcode' 	 => '',
			'state' => '',
			'username' => '',
			'phone' => '',
			'user_new' => '',
			'logged_in' => FALSE
		);
		$this->session->unset_userdata($userlogindataold);
		$userlogindata = $this->get_user_login_detail($user_id);
		$this->session->set_userdata($userlogindata);
		if($cur_url!=''){
			redirect($cur_url, 'refresh');
		}else{
			if($userlogindata['is_admin']==1){
			
				redirect(site_url('admin/home'), 'refresh');
				
			}else{
		
				redirect(site_url('user/home'), 'refresh');
			}
		}
	}	
	
	
	function check_profile($user_id){
	
	$query = $this->db->get_where('user_profile_details', array('id' => $this->session->userdata('userid')));
			
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
		
	}
	function check_email_exist($email){

		$query = $this->db->get_where('users', array('email' => $email));
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	function check_username_exist($username){
		$query = $this->db->get_where('users', array('username' => $username));
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function check_password_match($email,$password){
		$query = $this->db->get_where('users', array('email' => $email, 'password' => $password, 'isactive'=>'y'));
		if ($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function getID_byEmail($email){
		$query = $this->db->get_where('users', array('email' => $email));
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row['id'];
		}
	}
	function get_admin_data(){
		$query = $this->db->get('settings');
		if ($query->num_rows() > 0) {
			
			return $query->row_array();
			
		}
	}
	function getID_byUsername($email){
		$query = $this->db->get_where('users', array('email' => $email));
		if ($query->num_rows() > 0) {
			
			$row = $query->row_array();
			return $row['id'];
		}
	}
	
	function save_user_data($user_data){
		$user_id = $this->session->userdata('userid') ;
		
		$str = $this->db->update('users', $user_data, array('id'=>$user_id)); 
	}
	function save_contact_data($user_data){		$this->db->insert('contactus', $user_data); 	}
	
	function delete_phhoto($photo_id){
		$str = $this->db->delete('user_gallery', array('id'=>$this->session->userdata('userid'),'photo_id'=>$photo_id)); 
	}
	
	function get_user_gallery($user_id){
		$query = $this->db->get_where('user_gallery', array('id' => $this->session->userdata('userid'))); 
		$data = array();
		if ($query->num_rows() > 0){
			
			foreach($query->result() as $urows){
			
				array_push($data,$urows->photo_id);
			}
			
			
			return $data ;
			
		}else{
			return false;
		}
	}
	
	
	
	function save_user_gallery($user_data){
		$str = $this->db->insert('user_gallery', $user_data); 
	}
	function save_interest_user_data($user_data){
		$query = $this->db->get_where('tb_user_profile_details', array('user_id' => $this->session->userdata('userid')));
			if($query->num_rows() > 0){
				
				$str = $this->db->update('tb_user_profile_details', $user_data, array('user_id'=>$this->session->userdata('userid')));
				
			}else{
			
				$this->db->insert('tb_user_profile_details', $user_data);
			}
	
	
		 
	}
	function check_change_password($password){
		$query = $this->db->get_where('members', array('email' => $this->session->userdata('email'), 'password' => $password));
		if($query->num_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
	function reset_password($new_pass,$confirm_code){
		$data = array('password' => $new_pass, 'confirm_code'=>NULL);
		$this->db->where('confirm_code', $confirm_code);
		if($this->db->update('users', $data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	function return_state($state_id){
		$query = $this->db->get_where('tb_states', array('id' => $state_id));
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row['name'];
		}else{
			return FALSE;
		}
	}
	
	function return_country($country_id){
		$query = $this->db->get_where('tb_countries', array('ccode 	' => $country_id));
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row['country'];
		}else{
			return FALSE;
		}
	}
	
	
	function get_interest_group(){
		$return_data = array();
		$query = $this->db->get_where('interest_group', array('is_active' => 'y'));
		if ($query->num_rows() > 0){
			$return_data = $query->result_array();
		}
		$query->free_result();

		return $return_data;
	}
	
	
	function get_group_item($group_id){

		$return_data = array();

		$query = $this->db->get_where('interest_type', array('interest_group_id' => $group_id));
			
		if ($query->num_rows() > 0){
			$return_data = $query->result_array();
		}
		$query->free_result();

		return $return_data;		
	}
	
	function get_user_interest(){
		$return_data = array();
		$id = $this->session->userdata('userid');

		$query = $this->db->query("SELECT interest_item FROM tb_user_profile_details WHERE user_id = '$id'");
		if ($query->num_rows() > 0){
			$return_data = $query->result_array();
			$query->free_result();
			return $return_data;
		}
		else{
		return false;
		}
		
	}	
	
	function save_user_full_deatil($data){
	
		if($this->session->userdata('userid')=='' && $this->session->userdata('tmpuserid')!=''){
			$user_id = $this->session->userdata('tmpuserid') ;
		}
		else{
			$user_id = $this->session->userdata('userid') ;
		}
	
	$this->db->select('user_id ');
		$condition_arr = array(
							'user_id' => $user_id,
							);
		$query = $this->db->get_where('user_profile_details', $condition_arr );
		if ($query->num_rows() > 0) {
			$where = array(
					'user_id =' =>$user_id,
					
				);
			$this->db->update('user_profile_details', $data,$where);
				
		}else{
			$this->db->insert('user_profile_details', $data);
		
		}
	
	
	}	
	
	
	function verificationemail($user_data){
		$code = md5(uniqid(time(), true));
		$user_email = $user_data['email'];
		$username = $user_data['investigator_name'];
		//-----------------------------------------------------------
		// Load email view in a variable
		$email_data = array(
			'username'=>$username,	
			'email'=>$user_email,
			'code'=>$code,
		);
		
		$subject = "[Questionnaire] Verification Email";
	 	//$message = $this->load->view('email/verificationemail',$email_data,true);
		$message ="hello;";
		
		$from = $this->config->item('from_address');
		$from_name = $this->config->item('from_name');
		
		// Set headers
		$headers = "From: $from_name<$from>". "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		if(@mail($user_email,$subject,$message,$headers)){
			$this->page_data['submit_message'] = '<div class="successmsg">You are just one step away from starting to use your ProofHub account.
			Please check your email inbox for the verification email.</div>';
			
			//////online show this////////////////////////////
			$new_user_data = array('confirm_code' => $code);
			$this->db->where('email', $user_email);
			$str = $this->db->update('users', $new_user_data);
			
			return $this->page_data['submit_message'];
		}else{
			$this->page_data['submit_message'] = '<div class="errormsg">We are sorry for the inconvenience. Please try again.</div>';
		}
		///////////////////offline show this ////////////////////////
		
		$new_user_data = array('confirm_code' => $code);
				$this->db->where('email', $user_email);
		$str = $this->db->update('users', $new_user_data);
		
		return $this->page_data['submit_message'];
	}	
	
	function offerverificationemail($deal_data,$deal_id){
		$code = md5(uniqid(time(), true));
		$username = $this->session->userdata('username') ;
		$user_email = $this->session->userdata('email') ;
		$email_data = array(
		'username'=>$username,	
		'email'=>$user_email,	
		'title'=>$deal_data['title'],	
		'category'=>$deal_data['category'],	
		'description'=>$deal_data['description'],	
		'code'=>$code,
		);
		
		
		
		
		
		
		$subject = "[BazaarDeals] Deal Verification Email";
	 	$message = $this->load->view('email/offerverificationemail',$email_data,true);
		
		$from = $this->config->item('from_address');
		$from_name = $this->config->item('from_name');
		
		// Set headers
		$headers = "From: $from_name<$from>". "\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		if(@mail($user_email,$subject,$message,$headers)){
			
			
			//////online show this////////////////////////////
			$new_user_data = array('deal_confirm_code' => $code);
			$this->db->where('offer_id', $deal_id);
			$str = $this->db->update('offers', $new_user_data);
			
			return $this->page_data['submit_message'];
		}else{
			$this->page_data['submit_message'] = '<div class="errormsg">We are sorry for the inconvenience. Please try again.</div>';
		}
		///////////////////offline show this ////////////////////////
		
			$new_user_data = array('deal_confirm_code' => $code);
			$this->db->where('offer_id', $deal_id);
		$str = $this->db->update('offers', $new_user_data);
			
		return $this->page_data['submit_message'];
	}	
	
	
	function get_user_full_deatil(){
		
		$data = array();

		$query = $this->db->get_where('user_profile_details', array('user_id' => $this->session->userdata('userid')));
			
		if ($query->num_rows() > 0){
			foreach($query->result_array() as $rows){
			
			 $data['physical_status'] =  $rows['physical_status'];
			 $data['education_id'] =  $rows['education_id'];
			 $data['occupation_id'] =  $rows['occupation_id'];
			 $data['employed_in'] =  $rows['employed_in'];
			 $data['currency'] =  $rows['currency'];
			 $data['amount'] =  $rows['amount'];
			 $data['food'] =  $rows['food'];
			 $data['smoking'] =  $rows['smoking'];
			 $data['drinking'] =  $rows['drinking'];
			 $data['manglik'] =  $rows['manglik'];
			 $data['star_id'] =  $rows['star_id'];
			 $data['moon_sign_id'] =  $rows['moon_sign_id'];
			 $data['family_status'] =  $rows['family_status'];
			 $data['family_type'] =  $rows['family_type'];
			 $data['family_value'] =  $rows['family_value'];
			 $data['description'] =  $rows['description'];
			 $data['user_id'] =  $rows['user_id'];
			 $data['interest_item'] =  $rows['interest_item'];
			 $data['created_for'] =  $rows['created_for'];
			 $data['maritul_status'] =  $rows['maritul_status'];
			 $data['height'] =  $rows['height'];
			 $data['cms'] =  $rows['cms'];
			 $data['weight'] =  $rows['weight'];
			 $data['body_type'] =  $rows['body_type'];
			 $data['complexion'] =  $rows['complexion'];
				
			$data['check'] = 'true';
			
			}
			return $data;			
			
		}else{
			
			$data['check'] = 'false';
			return $data;
		}
		
		
	}
function match_profile(){ 
	
	$detail = $this->get_partner_prefrence_deatil();
	
	if($this->session->userdata('userid')=='' && $this->session->userdata('tmpuserid')!=''){
			$session_id = $this->session->userdata('tmpuserid') ;
			$session_gender = $this->session->userdata('tmpgender');
		}
		else{
			$session_id = $this->session->userdata('userid') ;
			$session_gender = $this->session->userdata('gender');
		}
	
	
	if($session_gender=='F'){
		$gender_id = 'M' ;
	}else{
		$gender_id = 'F' ;
	}
	$gender  				= $gender_id;
	if($detail['check']!='false'){
	$agefrom 				= $detail['from_age'];
	$ageto	    			= $detail['to_age'];
	$religion 				= $detail['religion'];
	$mothertounge 			= $detail['mother_tongue'];
	$caste 					= $detail['caste'];
	$country 				= $detail['country'];
	//$manglick 				= $detail['manglick'];
	//$education 				= $detail['education'];
	
	}else{
	$agefrom 				= '';
	$ageto	    			= '';
	$religion 				= '';
	$mothertounge 			= '';
	$caste 					= '';
	$country 				= '';
	//$manglick 			= '';
	//$education 			= '';
	}
	
	/*echo  $gender,$agefrom,$ageto,$religion,$mothertounge,$caste,$country $gender."<br/>".$agefrom."<br/>".$ageto."<br/>".$religion."<br/>".$mothertounge."<br/>".$caste."<br/>".$country;
	die();*/
	
	$this->db->select('members.*,states.name as state_name,countries.countryName as country_name,religion.name as religion_name,mother_tongue.name as mother_tongue_name,caste1.name as caste_name');
	

	$this->db->join('religion', 'religion.id = members.religion_id');	
	$this->db->join('mother_tongue', 'mother_tongue.id = members.mothertounge_id ');
	$this->db->join('caste1', 'caste1.id = members.caste_id');	
	$this->db->join('countries', 'countries.id = members.country');
	$this->db->join('states', 'states.id = members.state');
	if($gender!=''){
		
			
		$this->db->where('gender', $gender); 
	}
	if($agefrom!=''&& $agefrom!='0'){
		$this->db->where('age_year >=', $agefrom); 
		$this->db->where('age_year <=', $ageto); 
	}
	
	if($religion!='' && $religion!='0'){
		$this->db->where('religion_id', $religion);
		
	}
	
	if($mothertounge!='' && $mothertounge!='0'){
		$this->db->where('mothertounge_id', $mothertounge); 
		
	}
	
	if($caste!='' && $caste!='0'){
	
		$this->db->where('caste_id', $caste);
		
	
	}
	$this->db->where('user_id !=', $session_id);
	if($country!=''){
		//$this->db->where('country',$country);
		
	}
	
		
	 $query = $this->db->get('members',8,0);
	  //print_pre($this->db->last_query());die();
	
	
	if ($query->num_rows() > 0) {
		$data = array();
		$user_data = array();
		
		foreach($query->result() as $rows){
		$user_more_data = '';
		$user_id ='';
		//print_pre($rows);die();
			 $user_id = $rows->user_id;
   
			
			$this->db->select('user_profile_details.*,education.name as education_name,occupation.name as occupation_name');
			
			$this->db->join('education', 'education.id = user_profile_details.education_id');
			$this->db->join('occupation', 'occupation.id = user_profile_details.occupation_id');
			$this->db->where('user_id', $user_id);
			$query = $this->db->get('user_profile_details');
			
			if ($query->num_rows() > 0 ) {
			
				foreach($query->result() as $urows){
				
					//get height in inches//////
					$heights = $urows->height;
					$arr_height = explode('-',$heights);
					$height = $arr_height[0]."' ".$arr_height[0].'"';
					
					$user_more_data = array("maritul_status" => $urows->maritul_status, "height" => $height,"education_name" => $urows->education_name, "occupation_name" => $urows->occupation_name, "description" => $urows->description);	
				}
				
			}
			if($rows->user_pic != NULL && $rows->user_pic != '' ){
				$img = $rows->user_pic ;
			}
			else{
				$img = 'na.jpg';
			}
			
			
			array_push($user_data,array("first_name"=>$rows->first_name,"user_id" => $rows->user_id, "age" => $rows->age_year, "city" => $rows->city,"state" =>$rows->state_name,"user_pic" => $img, "caste_name" => $rows->caste_name,
			 "mothertounge_name" => $rows->mother_tongue_name ,"more_info"=>$user_more_data));
			//$data['religion_name']	= $rows['religion_name'];
			//$data['country'] 			= $rows->countryName;
		}
		$query->free_result();
		
			return $user_data;
			
		
		
	}
		
	}
	function send_request_count(){
		
		$html='';
		$this->db->select('sender');
		$condition_arr = array(
							'sender' => $this->session->userdata('userid'),
							'status' => '0'
							);
		
		$query = $this->db->get_where('user_request', $condition_arr );
		$total_found = $query->num_rows() ;
	
			return $total_found;
		
		
	}
	
	
	function my_request_count(){
		
		$html='';
		$this->db->select('sender');
		$condition_arr = array(
							'receiver' => $this->session->userdata('userid'),
							'status' => '0'
							);
		
		$query = $this->db->get_where('user_request', $condition_arr );
		$total_found = $query->num_rows() ;
	
			return $total_found;
		
		
	}

	

	function my_request_detail(){
		$user_data = array();
		$html='';
		$this->db->select('sender');
		$condition_arr = array(
							'receiver' => $this->session->userdata('userid'),
							'status' => '0'
							);
	
		
			$query = $this->db->get_where('user_request', $condition_arr );
		
		//print_pre($this->db->last_query());die();
		if($query->num_rows() >0){
			foreach($query->result() as $rows){
						
				$sender_id = $rows->sender;
				
				$this->db->select('members.*,states.name as state_name,countries.countryName as country_name,religion.name as religion_name,mother_tongue.name as mother_tongue_name,caste1.name as caste_name');
		

				$this->db->join('religion', 'religion.id = members.religion_id');	
				$this->db->join('mother_tongue', 'mother_tongue.id = members.mothertounge_id ');
				$this->db->join('caste1', 'caste1.id = members.caste_id');	
				$this->db->join('countries', 'countries.id = members.country');
				$this->db->join('states', 'states.id = members.state');
				$this->db->where('user_id', $sender_id);
				 $query = $this->db->get('members');
				//print_pre($this->db->last_query());die();
				if ($query->num_rows() > 0) {
					$data = array();
					
					
					foreach($query->result() as $rows){
					$user_more_data = '';
					//print_pre($rows);die();
				
	   
				
						$this->db->select('user_profile_details.*,education.name as education_name,occupation.name as occupation_name');
						
						$this->db->join('education', 'education.id = user_profile_details.education_id');
						$this->db->join('occupation', 'occupation.id = user_profile_details.occupation_id');
						$this->db->where('user_id', $sender_id);
						$query = $this->db->get('user_profile_details');
				
				
						if ($query->num_rows() > 0) {
						
							foreach($query->result() as $urows){
							
								//get height in inches//////
								$heights = $urows->height;
								$arr_height = explode('-',$heights);
								$height = $arr_height[0]."' ".$arr_height[0].'"';
								
								$user_more_data = array("maritul_status" => $urows->maritul_status, "height" => $height,"education_name" => $urows->education_name, "occupation_name" => $urows->occupation_name, "description" => $urows->description);	
							}
							
						}
						if($rows->user_pic != NULL && $rows->user_pic != '' ){
							$img = $rows->user_pic ;
						}
						else{
							$img = 'na.jpg';
						}
						
						array_push($user_data,array("user_id" => $rows->user_id,"first_name" => $rows->first_name, "last_name" => $rows->last_name , "age" => $rows->age_year, "city" => $rows->city,
						 "state" =>$rows->state_name,"user_pic" => $img, "caste_name" => $rows->caste_name,
						 "mothertounge_name" => $rows->mother_tongue_name , "religion_name" =>$rows->religion_name, "country" =>$rows->country_name, "more_info"=>$user_more_data));
						 
									
					//$data['religion_name']	= $rows['religion_name'];
					//$data['country'] 			= $rows->countryName;
					}
				
				
					
				}
			}
			
		
			return $user_data;
		
		}
		else{
			return 'false' ;
		}
	
	}
	
	function request_status_div($profile_id){
		$html='';
	
	
		$condition_arr = array(
							'sender' => $this->session->userdata('userid'),
							'receiver' => $profile_id,
							);
		
		$query = $this->db->get_where('user_request', $condition_arr );
		if ($query->num_rows() > 0) {
		
			$rows = $query->row_array();
			
				if($rows['status']==0){
					$html .= '<div  class="action1 writeMsg" id="interest-div"> Waiting for approval. </div>';
				}
				elseif($rows['status']==1){
					$html .= '<div  class="action1 writeMsg" id="interest-div"> </div>';
				}
				elseif($rows['status']==2){
					$html .='<div class="action1 writeMsg" id="interest-div'.$profile_id.'"> <a href="JavaScript:void(0);" name="interest" onclick="javascript:user_interest('."'".$profile_id."'".');" id="interest" >Show Interest</a></div>';
				}
				elseif($rows['status']==3){
					$html .= '<div  class="action1 writeMsg" id="interest-div"></div>';
				}
				else{
					$html .='<div class="action1 writeMsg" id="interest-div'.$profile_id.'"> <a href="JavaScript:void(0);" name="interest" onclick="javascript:user_interest('."'".$profile_id."'".');" id="interest" >Show Interest</a></div>';
				}
			
		
		}
		else{
			$html .='<div class="action1 writeMsg" id="interest-div'.$profile_id.'"> <a href="JavaScript:void(0);" name="interest" onclick="javascript:user_interest('."'".$profile_id."'".');" id="interest" >Show Interest</a></div>';
		}
		
		return $html;
	}
	
	function profile_interest($profile_id){
	$interest_date= date("Y-m-d h:i:s");
		$data = array(
			   'sender' => $this->session->userdata('userid') ,
			   'receiver' => $profile_id ,
			   'status' => '0',
			   'interest_date' => $interest_date,
			   
		);

			if($this->db->insert('user_request', $data)){
			return true;
		}else{
			return false;
		} 
					
	}
	
	
	
	function contect_detail($profile_id){
	$query = $this->db->get_where('members', array('user_id' => $profile_id));
		if ($query->num_rows() > 0){
			$user_data = array();
			$row = $query->row_array();
			
			$user_data['email'] = $row['email'];
			
			$user_data['phone'] = $row['phone'];
		
			return $user_data;
		}else{
		
			return false;
		}
	
	}
	
	function show_contect_detail($profile_id){
	$html='';
	
	
	//$interest_date= date("Y-m-d h:i:s");
	
		$user_id = $this->session->userdata('userid');
		$where = array(
			   'status' => '1',
			     
		);
		$query = $this->db->get_where('user_request', $where );
		if ($query->num_rows() > 0) {
			$tmp = 1;
			foreach($query->result_array() as $rows){
						
				if($rows['receiver']== trim($profile_id) && $rows['sender']==trim($user_id)) {
					
					$tmp++;
				
				}elseif($rows['sender']==$profile_id && $rows['receiver']==$user_id){
				
					$tmp++;
				}
				
				
			}
			if($tmp >1){
				$contect_detail = $this->contect_detail($profile_id);
					$html .= '<div  class="action1 writeMsg" id="contect-div"> E-maill: '.$contect_detail['email'].' <br/> <br/> Phone: '.$contect_detail['phone'].'</div>';
				
				}
				else{
				
				$html .= '<div  class="action1 writeMsg" id="contect-div">Kindly show Interest, if users accepts you will be able to view the Contact Details.</div>';
				}
			return $html;
		
		}
	}

	function update_request($data){
	
	
	$interest_date= date("Y-m-d h:i:s");
		$where = array(
			   'sender =' => $data['id'] ,
			   'receiver =' => $this->session->userdata('userid') ,
			);
			$user_data = array(
			'status' => $data['req_type'],
			'interest_date' => $interest_date
			);
			if($this->db->update('user_request', $user_data,$where)){
			return true;
		}else{
			return false;
		} 
					
	}	
	
	function partner_prefrence($data){
		$user_id = '';
		if($this->session->userdata('userid')=='' && $this->session->userdata('tmpuserid')!=''){
			$user_id = $this->session->userdata('tmpuserid') ;
		}
		else{
			$user_id = $this->session->userdata('userid') ;
		}
		$this->db->select('user_id ');
		$condition_arr = array(
							'user_id' => $user_id,
							);
		$query = $this->db->get_where('partner_prefrence', $condition_arr );
		if ($query->num_rows() > 0) {
			$where = array(
					'user_id =' =>$this->session->userdata('userid'),
					
				);
			$this->db->update('partner_prefrence', $data,$where);
				
		}else{
			$this->db->insert('partner_prefrence', $data);
		
		}			
	}


	function get_partner_prefrence_deatil(){
		
		$user_id = '';
		if($this->session->userdata('userid')=='' && $this->session->userdata('tmpuserid')!=''){
			$user_id = $this->session->userdata('tmpuserid') ;
		}
		else{
			$user_id = $this->session->userdata('userid') ;
		}
		$data = array();

		$query = $this->db->get_where('partner_prefrence', array('user_id' => $user_id));
			
		if ($query->num_rows() > 0){
			foreach($query->result_array() as $rows){
			
			 $data['from_age'] =  $rows['from_age'];
			 $data['to_age'] =  $rows['to_age'];
			 $data['maritul_status'] =  $rows['maritul_status'];
			 $data['from_feet'] =  $rows['from_feet'];
			 $data['to_feet'] =  $rows['to_feet'];
			 $data['physical_status'] =  $rows['physical_status'];
			 $data['religion'] =  $rows['religion'];
			 $data['caste'] =  $rows['caste'];
			 $data['manglick'] =  $rows['manglick'];
			 $data['star'] =  $rows['star'];
			 $data['eating_habits'] =  $rows['eating_habits'];
			 $data['drinking_habits'] =  $rows['drinking_habits'];
			 $data['smoking_habits'] =  $rows['smoking_habits'];
			 $data['gothra'] =  $rows['gothra'];
			 $data['mother_tongue'] =  $rows['mother_tongue'];
			 $data['country'] =  $rows['country'];
			 $data['citizenship'] =  $rows['citizenship'];
			 $data['education'] =  $rows['education'];
			 $data['occupation'] =  $rows['occupation'];
			 $data['annual_income'] =  $rows['annual_income'];
			 $data['description'] =  $rows['description'];
		
			$data['check'] = 'true';
			
			}
			return $data;			
			
		}else{
			
			$data['check'] = 'false';
			return $data;
		}
		
	}
	
	function get_user_id(){
	$data  = array();
		$this->db->select('user_id');
		
		$this->db->order_by("id", "desc"); 
		$this->db->limit(1);
		
		$query = $this->db->get_where('members');
		if ($query->num_rows() > 0) {
						
			foreach($query->result() as $urows){
			
				$data['user_id'] = $urows->user_id;
			}
			
			
			return $data ;
		}
	
	}
	
	function last_login(){
	$user_data = array();
	//$date= date("Y-m-d h:i:s");
	$this->db->set('last_login', 'NOW()', FALSE); 
	$this->db->where('user_id', $this->session->userdata('userid'));
	//$user_data['last_login'] = $date;
	
	 $this->db->update('members'); 
	 
			
	}
	function get_last_login(){
		$query = $this->db->get_where('members', array('user_id' => $this->session->userdata('userid')));
		if ($query->num_rows() > 0) {
			$row = $query->row_array();
			return $row['last_login'];
		}else{
			return FALSE;
		}
	}
	
	function save_album_data($album_data){
		
		$this->db->insert('user_albums', $album_data); 
	
	}
	
	function get_album_data($user_id){
		$checklogin =  $this->session->userdata('userid') ;
		if($checklogin!='' && $checklogin==$user_id){
			$query = $this->db->get_where('user_albums', array('user_id' => $user_id));
		}else{
		$this->db->where('user_id', $user_id);
		$this->db->where('status',1);
			$query = $this->db->get('user_albums');
		}	
		if ($query->num_rows() > 0){
			$user_albums_data = array();
			$user_albums_data = $query->result_array();
			
			
		
			return $user_albums_data;
		}else{
		
			return false;
		}
	
	}
	
	function get_album_data_by_id($user_id,$album_id){
		
		$query = $this->db->get_where('user_albums', array('user_id' => $user_id,'id'=>$album_id));
		if ($query->num_rows() > 0){
			$user_album_data = array();
			$user_album_data = $query->row_array();
			
			return $user_album_data;
		}else{
		
			return false;
		}
	
	}
	
	
	
	
	function get_showalbum_data($user_id,$album_id){
		
		$query = $this->db->get_where('album_spaces', array('user_id' => $user_id,'album_id' =>$album_id));
		if ($query->num_rows() > 0){
			$user_albums_data = array();
			$user_albums_data = $query->result_array();
			return $user_albums_data;
		}else{
			return false;
		}
	
	}
	
	function save_albumspace_data($space_data){
		$this->db->set('created', 'NOW()', FALSE); 
		$this->db->insert('album_spaces', $space_data); 
	
	}
	function update_album($album_data,$album_id){
		$user_id = $this->session->userdata('userid') ;
		$query = $this->db->get_where('user_albums', array('user_id' => $user_id,'id' =>$album_id));
		if ($query->num_rows() > 0){
			$this->db->set('modified', 'NOW()', FALSE); 
			$this->db->update('user_albums', $album_data, array('id'=>$album_id)); 
				return true;
		}
	return false;
	
	}
	
	function search_result_11a($invention_id,$search_title,$Qno){
		
		
		$principal_investigator_like='';
		if($Qno=='11a1'){
				
			$query = $this->db->query("SELECT principal_investigator FROM inventions WHERE id=$invention_id");
			
			if ($query->num_rows() > 0){
			
				$return_data = $query->row_array();
				
			 	$principal_investigator = $return_data['principal_investigator'];
				
				
				$query12 = $this->db->query("SELECT id FROM inventors WHERE investigator_name='$principal_investigator'");
				
				$ids = '';
				if ($query12->num_rows() > 0){
					
					$investigator_data = $query12->result_array();
					$investigator_id_array='';
					foreach($investigator_data as $investigator_datas){
					
						$investigator_id_array .=  $investigator_datas['id'].',';
							
					}	
					$investigator_id_array = substr($investigator_id_array,0,-1);
					
					//print_pre($investigator_id_array);die;
					
					/* $investigator_data = $query12->row_array();
					$investigator_id = $investigator_data['id'] ; */
					
					/* $query34 = $this->db->query("SELECT invention_id FROM invention_inventor WHERE inventor_id=$investigator_id"); */
					
					$query34 = $this->db->query("SELECT invention_id FROM invention_inventor WHERE inventor_id IN($investigator_id_array)");
					
		 	/*  $str = $this->db->last_query();
		 die($str);   */
					if ($query34->num_rows() > 0){
						$investigator_ids = $query34->result_array();
						
						if(!empty($investigator_ids)){
						
							foreach($investigator_ids as $ids_data){
								$ids .=  $ids_data['invention_id'].',';
							
							}	
							$ids = substr($ids,0,-1);
						}
					}
				}
				
				//print_pre($ids);die;
				
				if($ids!=''){
					$principal_investigator_like =" AND id IN($ids)";
				}

			}
		}
		
		$title_or = '';
		$title_or1 = '';
		$search_title_arr = explode(" ",$search_title);
		
		foreach($search_title_arr as $title_data){
			
				$title_or .= " title LIKE '%$title_data%' OR";
				$title_or1 .= " abstract_invantion LIKE '%$title_data%' OR";
			
		}
		
		
		$title_or .= " title LIKE '%$search_title%'";
		
		$title_or1 .= " abstract_invantion LIKE '%$search_title%'";
		
		if($Qno=='11a1'){
		if($principal_investigator_like!=''){
		
			$query1 = $this->db->query("SELECT * FROM inventions WHERE ($title_or OR $title_or1)  $principal_investigator_like and id NOT IN ($invention_id)");
		
		}else{
			return false;
		}
		}else{
		
			$query1 = $this->db->query("SELECT * FROM inventions WHERE ($title_or OR $title_or1 ) and id NOT IN ($invention_id)");
		
		}
		/*  $str = $this->db->last_query();
		 die($str); */  
		if ($query1->num_rows() > 0){
			$return_data1 = $query1->result_array();
			return $return_data1;
		}
		
		return false;
		
	}
	
	
	
	function update_invention_project($update_data,$id){
		$str = $this->db->update('invention_project', $update_data, array('id'=>$id)); 
		
	}
	
	function delete_invention_project($invention_id){
		$str = $this->db->delete('invention_project',array('invention_id'=>$invention_id)); 
		
	}
	
	function delete_invention_project_byid($id){
		$str = $this->db->delete('invention_project',array('id'=>$id)); 
		
	}
	
	
	function fetch_invention_project($invention_id){
		$query 	= $this->db->get_where('invention_project', array('invention_id' => $invention_id));
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	
	function add_invention_project($data){ //print_pre($data);
		
		if($this->db->insert('invention_project', $data)){
		
			$id = $this->db->insert_id();
			
			
			return $id;
		}else{
			return false;
		} 
	}
	
	//update progress
	function get_user_list(){
	
		$query = $this->db->get('users');
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	
	function get_all_inventions($id){
		
		$ids='';
		foreach($id as $key=>$value){
	
			$ids .=	$value.',';
		}
		$ids = substr($ids, 0, -1);
		$query = $this->db->query("SELECT * FROM inventions WHERE user_id IN ($ids)");
		//$query = $this->db->get('inventions', array('user_id' => $id));
		//print_pre($this->db->last_query());die();
		$result = array();
		if ($query->num_rows() > 0) {
			$result = $query->result_array();
			return $result ; 
		}else{
			return $result;
		}
	}
	
	
	
	function load_data($id) {
	
        $query = $this->db->query('SELECT * FROM users');
        return $query;
		
  	
	}
	
		

	
	
	
   
   

   

	
	
	

}


?>