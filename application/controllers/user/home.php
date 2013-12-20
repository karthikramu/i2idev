<?php

class Home extends CI_Controller {

	public $page_id = 'home';

	public $page_data = array();
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		// $this->load->model('common_model');
		$this->page_data['user_data'] = $this->user_model->get_user_login_detail($this->session->userdata('userid'));

		$this->load->library('form_validation');
		
	}

	
	
	function index()
	{
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
		
		$this->page_data['page_title'] = 'User | Home' ;
		
		/* $user_data = array();
		$user_data['user_id'] = $user_id;
		
		
		$this->page_data['next_invention'] = $this->user_model->get_next_invention($user_data); */
		
		$users = $this->user_model->get_inventors_name();
		
		$users_name = array();
		foreach($users as $user_data){
		//	array_push($users_name,$user_data['investigator_name']);
			$users_name[] = array('name'=>$user_data['id'],'to'=>$user_data['investigator_name']) ;
			
		}
		$this->page_data['users_name'] = json_encode($users_name) ; 
		
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_home',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
	}
	
	function get_user_detail(){
		$username = $_POST['username'] ; 
		
		$user_data = $this->user_model->get_user_detail_name($username);
		
		
		if(!empty($user_data)){
			//$user_invention = $this->user_model->get_user_inventions($user_data['id'],false);
			$user_invention = $this->user_model->get_innventor_inventions_forcount($user_data['id'],false);
			
			$user_data['user_invention'] = count($user_invention) ; 
			$user_data['new_user'] = '0' ; 
			echo json_encode($user_data) ; 
			die;
		}else{
			$new_user = array();
			$new_user['new_user'] = '1';
			
			
			
			echo json_encode($new_user) ; 
			die;
		}
			
		
	}
	
	
	function inventionslist(){
		$user_id = $this->session->userdata('userid') ;
		
		//print_pre($this->session->userdata);die;
		
		$this->page_data['page_title'] = 'User | Inventions' ;
		
		//$logindata = $this->user_model->get_user_login_detail($user_id);
		$this->page_data['user_type']=$this->session->userdata('user_type');
		if($this->session->userdata('user_type')==2){
			
			$userid=$this->session->userdata('userid');
			
			/*UmaSK@institution.org(23),Gansh@institution.com(24)*/
			if($userid==23 || $userid==24){
			
				//$id=array(1,2,13,14,15,16,17,18,19,20,21,22,33,35);
				$id=array(1,2,13,14,15,16,17,18,19,20,21,22,33,35);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}
			
			elseif($userid==25 || $userid==26){
				
				$id=array(1,2);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}
			elseif($userid==27){
				
				
				$id=array(1,2,13,22);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}elseif($userid==28){
			
				
				$id=array(1,2,13);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}elseif($userid==29){
			
				
				$id=array(19);
				$user_inventions = $this->user_model->get_all_inventions($id);
				
			}elseif($userid==30){
			
				
				$id=array(18);
				$user_inventions = $this->user_model->get_all_inventions($id);
		
			}
			
			elseif($userid==31){
			
				/* USK2@institution.org */
				$id=array(13);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}
			
			elseif($userid==32){
			
				
				$id=array(21);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}
			
			elseif($userid==34){
			
				/* Rkaushik1@uml.edu */
				//$id=array(33,1);
				$id=array(33);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}elseif($userid==36){
			
				/* Jill1@uml.edu */
				//$id=array(35,2);
				$id=array(35);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}else{
			
				redirect('user/home','refresh');
			}
			
			//$this->page_data['user_inventions'] = $this->create_user2_inventions_block();
			//$user_inventions = $this->user_model->get_all_inventions();
			$this->page_data['user_inventions'] = $this->create_user_inventions_block($user_inventions); 
			
		}else{
		
			$user_inventions = $this->user_model->get_user_inventions($user_id);
			$this->page_data['user_inventions'] = $this->create_user_inventions_block($user_inventions); 
		
		}
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/inventions_list',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
	
	}
	
	
	function download(){
	
		$doc=$this->uri->segment(3);
		if($doc!=""){
		
			$file=$_SERVER['DOCUMENT_ROOT'].'/aaviskar_live/i2i/data/common/common_nones_name/'.$doc;
			if(file_exists($file)){
				
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header("Content-Type: application/force-download");
				header('Content-Disposition: attachment; filename=' . urlencode(basename($file)));
				header('Expires: 0');
				header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
				header('Pragma: public');
				header('Content-Length: ' . filesize($file));
				ob_clean();
				flush();
				readfile($file);
			}
		}
		exit;
		redirect('user/inventionslist');
	}
	
	function create_user_inventions_block($user_inventions){
		$html = '';
		
		 
		if(!empty($user_inventions)){
		
			foreach($user_inventions as $data){
				$invention_id =  $data['id'] ;
				$status = '';
					if($data['status']=='process'){
						$status = 'Disclosure In-Progress';
					}elseif($data['status']=='open'){
						$status = 'Disclosure In-Progress';
					}else{
						$status = 'Disclosure Done & Under Review';
					}
				
				
				$invention_inventor = $this->user_model->get_invention_inventor_by_id_inventor($invention_id);
				$top_rank_id = '';
				$top_rank_score = 0;
				$investigator_name = 0;
				$attached_data= '';
				
				if($data['invention_attachments']!=""){
					
					$attached_data .='<li><a href="'.base_url().'user/download/'.$data['invention_attachments'].'" target="_blank">Invention Attachments</a></li>';
				}
				if($data['grant_documents']!=""){
				
					$attached_data .='<li><a href="'.base_url().'user/download/'.$data['grant_documents'].'" target="_blank">Grant Documents</a></li>';
				}
				if($data['already_invention_doc']!=""){
					
					if($data['already_invention']=="Yes"){
					 
					$attached_data .='<li><a href="'.base_url().'user/download/'.$data['already_invention_doc'].'" target="_blank">Already Invention</a></li>';
					
					}
					
				}
				//print_pre($data);die;
				if($data['journal_invention_doc']!=""){
					
					if($data['already_invention']=="Yes1"){
					 
					$attached_data .='<li><a href="'.base_url().'user/download/'.$data['journal_invention_doc'].'" target="_blank">Already Invention</a></li>';
					
					}
					
				}
				if($data['upcoming_invention_doc']!=""){
					
					$attached_data .='<li><a href="'.base_url().'user/download/'.$data['upcoming_invention_doc'].'" target="_blank">Upcoming Invention</a></li>';
				}
				if($data['submitted_invention_doc']!=""){
					$attached_data .='<li><a href="'.base_url().'user/download/'.$data['submitted_invention_doc'].'" target="_blank">Submitted Invention</a></li>';
				}
				if($data['signature']!=""){
					$attached_data .='<li><a href="'.base_url().'user/download/'.$data['signature'].'" target="_blank">Signature</a></li>';
				}
				if($this->session->userdata('user_type')==2){
					if($data['pdfresult']!=""){
						
						$pdfresult=json_decode($data['pdfresult'],true);
						//print_pre($pdfresult);
						//die;
						foreach($pdfresult as $result){
						$title=substr($result['title'], 0, 10);
						$attached_data .='<li><a href="'.$result['link'].'" target="_blank"><img src="'.return_theme_path().'images/pdf-icon.gif" style="margin-bottom:-9px;" />'.$title.'...</a></li>';
						}
					}
				}
					foreach($invention_inventor as $inventor_data1){
					
						$score_q3_1 = 0;
						if($inventor_data1['institutional']=='Gansh1'){
							$score_q3_1 = 2;
						}
						
						if($inventor_data1['institutional']=='Gansh2'){
							$score_q3_1 = 1.5;
						}
						
						if($inventor_data1['institutional']=='Gansh3'){
							$score_q3_1 = 1.25;
						}
						
						if($inventor_data1['institutional']=='Gansh4'){
							$score_q3_1 = 1;
						}
						
						if($inventor_data1['institutional']=='Gansh5'){
							$score_q3_1 = 0.75;
						}
						
						if($inventor_data1['institutional']=='Gansh6'){
							$score_q3_1 = 0.5;
						}
						
						if($inventor_data1['institutional']=='Gansh7'){
							$score_q3_1 = 0;
						}
						/* 
						if(strtolower($inventor_data1['institutional'])=='Visiting scientist' || strtolower($inventor_data1['institutional'])=='visiting scientist'){
							$score_q3_1 = 1.25;
						}
						 */
						
						if($score_q3_1 >= $top_rank_score){
							$top_rank_id = $inventor_data1['id'];
							$top_rank_score = $score_q3_1;
							$investigator_name = $inventor_data1['investigator_name'];
						}
						
						
					}		
						
			$html .='<tr>
						<td><a href="'.site_url('user/invention').'/'.$data['id'].'">'.$data['id'].'</a></td>
						<td>'. $investigator_name.'</td>
						<td>'. $data['title'].'</td>
						<td>'. $status.'</td>
						<td><ul>'.$attached_data.'</ul></td>
						<td><a href="'. site_url('user/deleteinvention').'/'.$data['id'].'">Delete</a></td>
					</tr>';
				
			}
		}
		
	
		return $html ; 
	}
	
	
	function form2_save(){
	
	/* print_pre($_POST);
			die;
	 */
			$id = $_POST['invention_id'] ; 
			$data = array();
					//$grant_documents = '';
					//$invention_attachments = '';
					
					
					if(isset($_FILES['invention_attachments']) && $_FILES['invention_attachments']['name']!=''){
					
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						/* Load the upload library */
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('invention_attachments'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							
							$invention_attachments = $image_data['file_name'];
							$data['invention_attachments'] = $invention_attachments;
						}
			
					}
					if(isset($_FILES['grant_documents']) && $_FILES['grant_documents']['name']!=''){
					
					
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						/* Load the upload library */
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('grant_documents'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							$grant_documents = $image_data['file_name'];
							$data['grant_documents'] = $grant_documents;
						}
			
					}
			
				//$data['grant_documents'] = $grant_documents;
				//$data['invention_attachments'] = $invention_attachments;
				
				
				if(isset($_POST['invention_title'])){
					$data['title'] = $_POST['invention_title'] ;
				}
				if(isset($_POST['invention_type'])){
					$data['invention_type'] = $_POST['invention_type'] ;
				}
				if(isset($_POST['invention_type_other'])){
					$data['invention_type_other'] = $_POST['invention_type_other'] ;
				}
				if(isset($_POST['category_invention'])){
					$data['category_invention'] = $_POST['category_invention'] ;
				}
				if(isset($_POST['category_invention_1'])){
					$data['cat_invention_1'] = $_POST['category_invention_1'] ;
				}
				if(isset($_POST['category_invention_2'])){
					$data['cat_invention_2'] = $_POST['category_invention_2'] ;
				}
				if(isset($_POST['name_drug'])){
					$data['name_drug'] = $_POST['name_drug'] ;
				}
				
				if(isset($_POST['category_invention_3'])){
					$data['cat_invention_3'] = $_POST['category_invention_3'] ;
				}
				if(isset($_POST['impect_areas'])){
					$data['impect_areas'] = $_POST['impect_areas'] ;
				}
				
				if(isset($_POST['stage_of_devolpment'])){
					$data['stage_of_devolpment'] = $_POST['stage_of_devolpment'] ;
				}
				
				
			
				
				if(isset($_POST['stage_of_devolpment_1'])){
					$data['stage_of_devolpment_1'] = $_POST['stage_of_devolpment_1'];
				}else{
					$data['stage_of_devolpment_1'] ='';
				}
				
				
				$funding_source = '';
				$funding_source_other = '';
				
				
				if(isset($_POST['funding_source_government'])){
					$funding_source .= 'a,' ;
				}
				
				if(isset($_POST['funding_source_industry'])){
					$funding_source .= 'b,' ;
				}
				
				if(isset($_POST['funding_source_foundation'])){
					$funding_source .= 'c,' ;
				}
				
				if(isset($_POST['funding_source_other'])){
					$funding_source .= 'd,' ;
					
						if(isset($_POST['funding_source_foundation_other'])){
							$funding_source_other = $_POST['funding_source_foundation_other'];
						}
					
					
				}
				
				
				if(isset($_POST['funding_source_sundry_funds'])){
					$funding_source .= 'e,' ;
				}
				
				
				$funding_source = substr($funding_source,0,-1);
				
				
				
				
				$data['funding_source'] = $funding_source ;
				$data['funding_source_other'] = $funding_source_other ;
				
				if(isset($_POST['abstract_invantion'])){
						$data['abstract_invantion'] 	= $_POST['abstract_invantion'] ;
				}
				if(isset($_POST['principal_investigator'])){
						$data['principal_investigator'] = $_POST['principal_investigator'] ;
				}
				// print_pre($_POST);
				// die;
				
				if(isset($_POST['entitiy_name']) && !empty($_POST['entitiy_name'])){
					$entity_names = '';
					foreach($_POST['entitiy_name'] as $entity_name_data){
						$entity_names  .=  $entity_name_data.',' ; 
					}
					$entity_names = substr($entity_names,0,-1);
						
				
						$data['entitiy_name'] 			= $entity_names ;
				}
				if(isset($_POST['agrement_number'])){
							$data['agrement_number'] 		= $_POST['agrement_number'] ;
				}
			
				if(isset($_POST['amount_of_funding'])){
						$data['amount_of_funding'] 		= $_POST['amount_of_funding'] ;
				}
			
				$this->user_model->update_invention($data,$id);
				
				$percentage = $this->calculate_percentage($id);	
				
				echo $percentage;
				
				die;
					
	}
	
	
	function form3_save(){
	
		
			/* print_pre($_POST);
			die;   */ 
			$data=array();
			
			//10a
			$data['already_invention'] 			= '' ;
			$data['already_invention_date'] 	= '0000-00-00 00:00:00';
			$data['journal_invention_date'] 	= '0000-00-00 00:00:00';
			if(isset($_POST['already_invention'])){
			
				if($_POST['already_invention']=='Yes' && $_POST['already_invention_date']!=''){
			
				$data['already_invention'] = $_POST['already_invention'] ;
				$data['already_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['already_invention_date']));
				}
				
				if($_POST['already_invention']=='Yes1' && $_POST['journal_invention_date']!=''){
				
				$data['already_invention'] = $_POST['already_invention'] ;
				$data['journal_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['journal_invention_date']));
				
				}
				
				if($_POST['already_invention']=='No'){
				$data['already_invention'] = $_POST['already_invention'] ;
				$data['already_invention_date'] = '0000-00-00 00:00:00';
				}
			
			}
			//10b
			$data['upcoming_invention'] = '';
			$data['upcoming_invention_date'] = '0000-00-00 00:00:00';
			if(isset($_POST['upcoming_invention'])){
			
			
				if($_POST['upcoming_invention']=='Yes' && $_POST['upcoming_invention_date']!=''){
			
				$data['upcoming_invention'] = $_POST['upcoming_invention'] ;
				$data['upcoming_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['upcoming_invention_date']));
				}
				
				if($_POST['upcoming_invention']=='No'){
				$data['upcoming_invention'] = $_POST['upcoming_invention'] ;
				$data['upcoming_invention_date'] = '0000-00-00 00:00:00';
				}
			}
			

			//10c
			$data['submitted_invention'] = '';
			$data['submitted_invention_date'] = '0000-00-00 00:00:00';
			
			if(isset($_POST['submitted_invention'])){
			
				if($_POST['submitted_invention']=='Yes' && $_POST['submitted_invention_date']!=''){
			
					$data['submitted_invention'] = $_POST['submitted_invention'] ;
					$data['submitted_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['submitted_invention_date']));
					
				}
				
				if($_POST['submitted_invention']=='No'){
				$data['submitted_invention'] = $_POST['submitted_invention'] ;
				$data['submitted_invention_date'] = '0000-00-00 00:00:00';
				}
				
			}
			//10d
			$data['plan_invention'] = '';
			$data['plan_invention_date']= '0000-00-00 00:00:00';
			if(isset($_POST['plan_invention'])){
			
				$data['plan_invention'] = $_POST['plan_invention'] ;
						
				if($_POST['plan_invention']=='No' || $_POST['plan_invention']==''){
						
					$data['plan_invention_date']= '0000-00-00 00:00:00';
						
				}
					
				if(isset($_POST['plan_invention_date']) && $_POST['plan_invention']=='Yes'){
				
					$data['plan_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['plan_invention_date']));
					
				} 
			
			}
			
			//11
			$data['input_key_invention']='';
			if(isset($_POST['input_key_invention'])){
			
				$data['input_key_invention'] = $_POST['input_key_invention'];
			}
			
			//11a1
			
			
			$data['prior_inventions']='';
			if(isset($_POST['result_11a1']) && !empty($_POST['result_11a1'])){
			
				$data['prior_inventions']=json_encode($_POST['result_11a1']);
						
			}
			/* print_pre($data);	
			die; */
			//11a2
			$data['other_inventions']='';
			if(isset($_POST['result_11a2']) && !empty($_POST['result_11a2'])){
					
				$data['other_inventions']=json_encode($_POST['result_11a2']);
						
			}
				
			//11b1
			/* $data['radio_11b']='';
			if(isset($_POST['radio_11b']) && !empty($_POST['radio_11b'])){
					
				$data['radio_11b']=json_encode($_POST['radio_11b']);
						
			} */
			
			$data['result_11b']='';
			$score_11b=0;
			if(isset($_POST['result_11b']) && !empty($_POST['result_11b'])){
			
				 // print_pre($_POST['result_11b']);die();
				
				$data['result_11b']=json_encode($_POST['result_11b']);
				
					foreach($_POST['result_11b'] as $rresult){
					
					//print_pre($rresult);
						 if(isset($rresult['radio_11b'])){
							
							$value=$rresult['radio_11b'];
							if($value=='least_relevant'){
								
								$score_11b +=3;
							}
							if($value=='somewhat_relevant'){
								$score_11b +=2;
							}
							if($value=='relevant'){
								$score_11b -=2;
							}
							if($value=='most_relevant'){
								$score_11b -=3;
							}
						} 
					}			
			}
			//11b2
			$data['result_11b2']='';
		
			if(isset($_POST['result_11b2']) && !empty($_POST['result_11b2'])){
			
				
					//print_pre(json_decode($data['result_11b2'],true));die;
					
					$new11b = array();
					$q11b = array();
					$q11b = $_POST['result_11b2'] ; 
					
					foreach($q11b as $key => $rresult){
					
					
						 if(isset($rresult['radio_11b2'])){
							
							$value=$rresult['radio_11b2'];
							if($value=='least_relevant'){
								
								$score_11b +=3;
							}
							if($value=='somewhat_relevant'){
								$score_11b +=2;
							}
							if($value=='relevant'){
								$score_11b -=2;
							}
							if($value=='most_relevant'){
								$score_11b -=3;
							}
						
						} 
						$rresult['desc'] 	=  isset($rresult['desc']) ? htmlentities($rresult['desc']) : ""; 
						$rresult['title'] 	=  isset($rresult['title']) ? htmlentities($rresult['title']) : ""; 
						$rresult['details'] =  isset($rresult['details']) ? htmlentities($rresult['details']) : ""; 
						$new11b[]	 = $rresult ; 
						
						
					}
				//print_pre($new11b);die;
				$data['result_11b2']=json_encode($new11b);
					
			}
			
			
			//12
			$data['distinct_aspects1']='';
			if(isset($_POST['distinct_aspects1']) && !empty($_POST['distinct_aspects1'])){
						
				$data['distinct_aspects1']=trim($_POST['distinct_aspects1']);
					
			}
			
			$data['distinct_aspects2']='';		
			if(isset($_POST['distinct_aspects2']) && !empty($_POST['distinct_aspects2'])){
						
				$data['distinct_aspects2']=trim($_POST['distinct_aspects2']);
						
			}
			
			$data['distinct_aspects3']='';
			if(isset($_POST['distinct_aspects3']) && !empty($_POST['distinct_aspects3'])){
						
				$data['distinct_aspects3']=trim($_POST['distinct_aspects3']);
						
			}
			/* 
			 print_pre($data);
			die; */
			
			$id = $_POST['invention_id'] ; 

			$this->user_model->update_invention($data,$id);
			
			$percentage = $this->calculate_percentage($id);	
				
			echo $percentage;
				
			die;
	}
	
	
	function form1_save(){
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
				
			// print_pre($_POST);
			// die;
			
				if(isset($_POST['inventor']) && (!empty($_POST['inventor']))){
						$this->user_model->delete_invention_inventor($_POST['invention_number']);
					
				
					foreach($_POST['inventor'] as $data){
						$insert_data = array();
						$update_data = array();
						
						$update_data['home_address'] = $data['home_address'];
						$update_data['citizen_ship'] = $data['citizenship'];
						$update_data['phone_number'] = $data['mobile'];
						$update_data['email'] = $data['email'];
						
						
						if($data['inventor_id']==''){
							$user_data_check = $this->user_model->get_user_detail_name($data['inventor_name']);
		
							if(!empty($user_data_check)){
								$inventor_id  = $user_data_check['id']; 
								$this->user_model->update_inventor_data($update_data,$inventor_id);
							}else{
							$update_data['investigator_name'] = $data['inventor_name'];
								$inventor_id = $this->user_model->insert_inventor_data($update_data);
							}
						
						
						}else{
						
							$inventor_detail = $this->user_model->get_user_detail_name($data['inventor_name']);
							
							if($inventor_detail['id']==$data['inventor_id']){
								$inventor_id  	= $data['inventor_id']; 
								$this->user_model->update_inventor_data($update_data,$data['inventor_id']);
							}else{
								$update_data['investigator_name'] = $data['inventor_name'];
								$inventor_id = $this->user_model->insert_inventor_data($update_data);
							}
						}
						
						/* if($data['inventor_id']==''){
							$user_data_check = $this->user_model->get_user_detail_name($data['inventor_name']);
		
							if(!empty($user_data_check)){
								$inventor_id  = $user_data_check['id']; 
								$this->user_model->update_inventor_data($update_data,$inventor_id);
							}else{
								$inventor_id = $this->user_model->insert_inventor_data($update_data);
							}
						
						
							
						}else{	
							$inventor_id  = $data['inventor_id']; 
							$this->user_model->update_inventor_data($update_data,$data['inventor_id']);
						}
						 */
					
						
							$insert_data['invention_id'] = $_POST['invention_number'] ;
							$insert_data['inventor_id'] = $inventor_id ;
							
							if(isset($data['institutional'])){
								/* if($data['institutional']=='other'){
									$insert_data['institutional'] = $data['institutional_other'] ;
								}else{
									$insert_data['institutional'] = $data['institutional'] ;
								} */
								$insert_data['institutional'] = $data['institutional'] ;
							}else{
								$data['institutional'] = '';
							}
							
							if(isset($data['number_invention'])){
								$insert_data['count_inventor'] = $data['number_invention'] ;
							}else{
									$data['institutional'] = 0; 
							}
							
							
							$this->user_model->insert_invention_inventor($insert_data);
						
					
					}
				
				
				}
			
		}

		$percentage = $this->calculate_percentage($_POST['invention_number']);	
		
		echo $inventor_id ; 
		die();
	
	}
	
	function invention(){
		$id =  $this->uri->segment(3) ; 
		
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
		/*
		if($id !='new'){
		
			$access_allowed = $this->check_access_param($id);
			if($access_allowed==false){
				redirect('home','refresh');
			}
			
		}
		*/
		
		
		
		
		
		
		
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
				if(isset($_POST['inventor']) && (!empty($_POST['inventor']))){
					$this->user_model->delete_invention_inventor($_POST['invention_number']);
					
				
					foreach($_POST['inventor'] as $data){
						
						$insert_data = array();
						$update_data = array();
						
						$update_data['home_address'] = $data['home_address'];
						$update_data['citizen_ship'] = $data['citizenship'];
						$update_data['phone_number'] = $data['mobile'];
						$update_data['email'] = $data['email'];
						
						if($data['inventor_id']==''){
							$user_data_check = $this->user_model->get_user_detail_name($data['inventor_name']);
		
							if(!empty($user_data_check)){
								$inventor_id  = $user_data_check['id']; 
								$this->user_model->update_inventor_data($update_data,$inventor_id);
							}else{
							$update_data['investigator_name'] = $data['inventor_name'];
								$inventor_id = $this->user_model->insert_inventor_data($update_data);
							}
						
						
						}else{
						
							$inventor_detail = $this->user_model->get_user_detail_name($data['inventor_name']);
							
							if($inventor_detail['id']==$data['inventor_id']){
								$inventor_id  	= $data['inventor_id']; 
								$this->user_model->update_inventor_data($update_data,$data['inventor_id']);
							}else{
								$update_data['investigator_name'] = $data['inventor_name'];
								$inventor_id = $this->user_model->insert_inventor_data($update_data);
							}
						}
						
						if(isset($data['institutional'])){
							
							$insert_data['invention_id'] = $_POST['invention_number'] ;
							$insert_data['inventor_id'] = $data['inventor_id'] ;
							/* if($data['institutional']=='other'){
								$insert_data['institutional'] = $data['institutional_other'] ;
							}else{
								$insert_data['institutional'] = $data['institutional'] ;
							} */
							$insert_data['institutional'] = $data['institutional'] ;
							$insert_data['count_inventor'] = $data['number_invention'] ;
							$this->user_model->insert_invention_inventor($insert_data);
						}
					}
				
				
				}
			
				$percentage = $this->calculate_percentage($_POST['invention_number']);	
				
				if(isset($_POST['link_redir_page'])){
					
					
					if($_POST['link_redir_page']=="ii"){
					redirect('user/invention/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="tech"){
					redirect('user/invention1/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="ip"){
					redirect('user/invention2/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="com"){
					redirect('user/invention3/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="score"){
					redirect('user/score/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="exit"){
					redirect('user/logout');
					}
				
				}else{
					redirect('user/logout');	
				}		
		}	
				
		$this->page_data['page_title'] = 'User | Home' ;
		
		if($id=='new'){
		
			$this->page_data['new_invention'] = 1; 
			$user_data = array();
			$user_data['user_id'] = $user_id;
			$user_data['submission_date'] = date('Y-m-d H:i:s');
			$id = $this->user_model->get_next_invention($user_data);
			$this->page_data['next_invention'] = $id;
		}else{
			$this->page_data['new_invention'] = 1; 
			$this->page_data['next_invention'] = $id;
		}
		
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		
		//print_pre($this->page_data['invention_data']);die;
		
		$this->page_data['invention_inventor'] = $this->user_model->get_invention_inventor($id);
				
		//$this->page_data['user_detail'] = $this->common_model->get_user_data();
		
		$users = $this->user_model->get_inventors_name();
		
		$users_name = array();
		foreach($users as $user_data){
			//	array_push($users_name,$user_data['investigator_name']);
			$users_name[] = array('name'=>$user_data['id'],'to'=>$user_data['investigator_name']) ;
			
		}
		$this->page_data['users_name'] = json_encode($users_name) ; 
		
		
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_invention',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
	
	}
	
	function invention1(){
	
			$this->page_data['page_title'] = 'User | Invention' ;
			$id =  $this->uri->segment(3) ; 
			$user_id = $this->session->userdata('userid') ;
			if($user_id==''){
				redirect('home','refresh');
			}
			
			$access_allowed = $this->check_access_param($id);
			
			if($access_allowed==false){
				redirect('home','refresh');
			}
	
	
			if ($this->input->server('REQUEST_METHOD') === 'POST'){
					$data = array();
					//$grant_documents = '';
					//$invention_attachments = '';
					
					//$number_invention
					if(isset($_FILES['invention_attachments']) && $_FILES['invention_attachments']['name']!=''){
					
					
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						/* Load the upload library */
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('invention_attachments'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							
							$invention_attachments = $image_data['file_name'];
							$data['invention_attachments'] = $invention_attachments;
						}
			
					}
					if(isset($_FILES['grant_documents']) && $_FILES['grant_documents']['name']!=''){
					
					
					
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						/* Load the upload library */
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('grant_documents'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							$grant_documents = $image_data['file_name'];
							$data['grant_documents'] = $grant_documents;
						}
			
					}
			
				/* $data['grant_documents'] = $grant_documents;
				$data['invention_attachments'] = $invention_attachments; */
				
				
				if(isset($_POST['invention_title'])){
					$data['title'] = $_POST['invention_title'] ;
				}
				if(isset($_POST['invention_type'])){
					$data['invention_type'] = $_POST['invention_type'] ;
				}
				if(isset($_POST['invention_type_other'])){
					$data['invention_type_other'] = $_POST['invention_type_other'] ;
				}
				$data['gansh4_other'] = '';
				if(isset($_POST['category_invention'])){
					$data['category_invention'] = $_POST['category_invention'] ;
					if(isset($_POST['gansh4_other']) && $_POST['category_invention']=='gansh4'){
						$data['gansh4_other'] = $_POST['gansh4_other'] ;
					}
				}
				
				if(isset($_POST['category_invention_1'])){
					$data['cat_invention_1'] = $_POST['category_invention_1'] ;
				}
				if(isset($_POST['category_invention_2'])){
					$data['cat_invention_2'] = $_POST['category_invention_2'] ;
				}
				if(isset($_POST['name_drug'])){
					$data['name_drug'] = $_POST['name_drug'] ;
				}
				
				if(isset($_POST['category_invention_3'])){
					$data['cat_invention_3'] = $_POST['category_invention_3'] ;
				}
				if(isset($_POST['impect_areas'])){
					$data['impect_areas'] = $_POST['impect_areas'] ;
				}
				
				if(isset($_POST['stage_of_devolpment'])){
					$data['stage_of_devolpment'] = $_POST['stage_of_devolpment'] ;
				}
				
				
				if(isset($_POST['stage_of_devolpment_1'])){
					$data['stage_of_devolpment_1'] = $_POST['stage_of_devolpment_1'];
				}else{
					$data['stage_of_devolpment_1'] ='';
				}
				
				
				$funding_source = '';
				$funding_source_other = '';
				
				
				if(isset($_POST['funding_source_government'])){
					$funding_source .= 'a,' ;
				}
				
				if(isset($_POST['funding_source_industry'])){
					$funding_source .= 'b,' ;
				}
				
				if(isset($_POST['funding_source_foundation'])){
					$funding_source .= 'c,' ;
				}
				
				if(isset($_POST['funding_source_other'])){
					$funding_source .= 'd,' ;
					
						if(isset($_POST['funding_source_foundation_other'])){
							$funding_source_other = $_POST['funding_source_foundation_other'];
						}
				}
				
				
				if(isset($_POST['funding_source_sundry_funds'])){
					$funding_source .= 'e,' ;
				}
				
				
				$funding_source = substr($funding_source,0,-1);
				
				
				
				
				$data['funding_source'] = $funding_source ;
				$data['funding_source_other'] = $funding_source_other ;
				
				if(isset($_POST['abstract_invantion'])){
						$data['abstract_invantion'] 	= $_POST['abstract_invantion'] ;
				}
				if(isset($_POST['principal_investigator'])){
						$data['principal_investigator'] = $_POST['principal_investigator'] ;
				}
				// print_pre($_POST);
				// die;
				
				if(isset($_POST['entitiy_name']) && !empty($_POST['entitiy_name'])){
					$entity_names = '';
					foreach($_POST['entitiy_name'] as $entity_name_data){
						$entity_names  .=  $entity_name_data.',' ; 
					}
					$entity_names = substr($entity_names,0,-1);
						
				
						$data['entitiy_name'] 			= $entity_names ;
				}
				if(isset($_POST['agrement_number'])){
							$data['agrement_number'] 		= $_POST['agrement_number'] ;
				}
			
				if(isset($_POST['amount_of_funding'])){
						$data['amount_of_funding'] 		= $_POST['amount_of_funding'] ;
				}
			
				
				/* calculate score */  
				
				if(isset($_POST['link_redir_page'])){
					$parent=0;
					$total_6_7  = 0 ; 
					$score = 0 ;
					$score7 = 0 ;
					$category_invention = '';
					$category_invention_2 = '';
					$category_invention_1 = '';
					$category_invention_3 = '';
					$stage_of_devolpment = '';
					$stage_of_devolpment_1 = '';
					if(isset($_POST['category_invention_1'])){
						$category_invention_1 =  $_POST['category_invention_1'] ; 
					}
					
					if(isset($_POST['category_invention_2'])){
						$category_invention_2 =  $_POST['category_invention_2'] ; 
					}
					if(isset($_POST['category_invention_3'])){
						$category_invention_3 =  $_POST['category_invention_3'] ; 
					}
					if(isset($_POST['stage_of_devolpment'])){
						$stage_of_devolpment =  $_POST['stage_of_devolpment'] ; 
					}
					if(isset($_POST['stage_of_devolpment_1'])){
						$stage_of_devolpment_1 =  $_POST['stage_of_devolpment_1'] ; 
					}
					if(isset($_POST['category_invention'])){
						$category_invention =  $_POST['category_invention'] ; 
					}
				if($category_invention=='gansh1'){	
					
					
					if($category_invention_1=='gansh9'){
						
						$parent = 5 ;
						
						if($category_invention_2=='gansh9_1'){
							$score = 20;
						}
						if($category_invention_2=='gansh9_2'){
							$score = 10;
						}
						if($category_invention_2=='gansh9_3'){
							$score = 7;
						}
						if($category_invention_2=='gansh9_4'){
							$score = 6;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 20;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='e'){
									if($stage_of_devolpment_1=='a'){
										$score7 = 25;
									}
										
									if($stage_of_devolpment_1=='b'){
										$score7 = 30;
									}
										
									if($stage_of_devolpment_1=='c'){
										$score7 = 40;
									}
										
									
									
							}
							
							
							if($stage_of_devolpment=='f'){
										$score7 = 60;
							}
							if($stage_of_devolpment=='g'){
								$score7 = 50;
							}
								
					}
					
					/*************************************/
					if($category_invention_1=='gansh10'){
						$parent = 3 ;
						
						if($category_invention_2=='gansh10_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh10_2'){
							$score = 10;
						}
						if($category_invention_2=='gansh10_3'){
							$score = 5;
						}
						if($category_invention_2=='gansh10_4'){
								
								if($category_invention_3=='yes'){
									$score = 7;
								}							
								if($category_invention_3=='no'){
									$score = 3;
								}							
								if($category_invention_3=='dont_know'){
									$score = 5;
								}
								
								
						}
						
							// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								//$score7 = 20;//Uma24oct
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 30;
								/* $score7 = 0;
								
									if($stage_of_devolpment_1=='a'){
										$score7 = 25;
									}
										
									if($stage_of_devolpment_1=='b'){
										$score7 = 30;
									}
										
									if($stage_of_devolpment_1=='c'){
										$score7 = 40;
									} */
								
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
							if($stage_of_devolpment=='e'){
								$score7 = 60;
							}
						/* echo $score7;
						die;
						 */
						
					}
					/*************************************/
					
					if($category_invention_1=='gansh11'){
						$parent = 2 ;
						
						if($category_invention_2=='gansh11_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh11_2'){
							$score = 10;
						}
						if($category_invention_2=='gansh11_3'){
							$score = 7;
						}
						if($category_invention_2=='gansh11_4'){
							$score = 7;
						}
						if($category_invention_2=='gansh11_5'){
							$score = 12;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 5;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 20;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 30;
							}
							if($stage_of_devolpment=='e'){
								$score7 = 40;
							}
						
					}
					
				}elseif($category_invention=='gansh2'){
				
					
					if($category_invention_1=='gansh12'){
						$parent = 4 ;
						
						if($category_invention_2=='gansh12_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh12_2'){
							$score = 7;
						}
						if($category_invention_2=='gansh12_3'){
							$score = 5;
						}
						if($category_invention_2=='gansh12_4'){
							$score = 4;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
					if($category_invention_1=='gansh13'){
						$parent = 5 ;
						
						if($category_invention_2=='gansh13_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh13_2'){
							$score = 7;
						}
						if($category_invention_2=='gansh13_3'){
							$score = 5;
						}
						if($category_invention_2=='gansh13_4'){
							$score = 4;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
					
					if($category_invention_1=='gansh14'){
						$parent = 3 ;
						
						if($category_invention_2=='gansh14_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh14_2'){
							$score = 8;
						}
						if($category_invention_2=='gansh14_3'){
							$score = 5;
						}
						if($category_invention_2=='gansh14_4'){
							$score = 4;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
				}elseif($category_invention=='gansh3'){
					if($category_invention_1=='gansh15'){
						$parent = 5 ;
						
						if($category_invention_2=='gansh15_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh15_2'){
							$score = 7;
						}
						if($category_invention_2=='gansh15_3'){
							$score = 5;
						}
						if($category_invention_2=='gansh15_4'){
							$score = 4;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
					if($category_invention_1=='gansh16'){
						$parent = 4 ;
						
						if($category_invention_2=='gansh16_1'){
							$score = 20;
						}
						if($category_invention_2=='gansh16_2'){
							$score = 10;
						}
						if($category_invention_2=='gansh16_3'){
							$score = 7;
						}
						if($category_invention_2=='gansh16_4'){
							$score = 5;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
					if($category_invention_1=='gansh17'){
						$parent = 3 ;
						
						if($category_invention_2=='gansh17_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh17_2'){
							$score = 8;
						}
						if($category_invention_2=='gansh17_3'){
							$score = 5;
						}
						if($category_invention_2=='gansh17_4'){
							$score = 4;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
				}elseif($category_invention=='gansh4'){			
					if($category_invention_1=='gansh18'){
						$parent = 5 ;
						
						if($category_invention_2=='gansh18_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh18_2'){
							$score = 7;
						}
						if($category_invention_2=='gansh18_3'){
							$score = 5;
						}
						if($category_invention_2=='gansh18_4'){
							$score = 4;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
					if($category_invention_1=='gansh19'){
						$parent = 4 ;
						
						if($category_invention_2=='gansh19_1'){
							$score = 20;
						}
						if($category_invention_2=='gansh19_2'){
							$score = 10;
						}
						if($category_invention_2=='gansh19_3'){
							$score = 7;
						}
						if($category_invention_2=='gansh19_4'){
							$score = 5;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
					if($category_invention_1=='gansh20'){
						$parent = 3 ;
						
						if($category_invention_2=='gansh20_1'){
							$score = 20;
						}
						if($category_invention_2=='gansh20_2'){
							$score = 10;
						}
						if($category_invention_2=='gansh20_3'){
							$score = 7;
						}
						if($category_invention_2=='gansh20_4'){
							$score = 5;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
				}elseif($category_invention=='gansh5'){			
					if($category_invention_1=='gansh21'){
						$parent = 5 ;
						
						if($category_invention_2=='gansh21_1'){
							$score = 15;
						}
						if($category_invention_2=='gansh21_2'){
							$score = 7;
						}
						if($category_invention_2=='gansh21_3'){
							$score = 5;
						}
						if($category_invention_2=='gansh21_4'){
							$score = 4;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
					if($category_invention_1=='gansh22'){
						$parent = 4 ;
						
						if($category_invention_2=='gansh22_1'){
							$score = 20;
						}
						if($category_invention_2=='gansh22_2'){
							$score = 10;
						}
						if($category_invention_2=='gansh22_3'){
							$score = 7;
						}
						if($category_invention_2=='gansh22_4'){
							$score = 5;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
					if($category_invention_1=='gansh23'){
						$parent = 3;
						
						if($category_invention_2=='gansh23_1'){
							$score = 20;
						}
						if($category_invention_2=='gansh23_2'){
							$score = 10;
						}
						if($category_invention_2=='gansh23_3'){
							$score = 7;
						}
						if($category_invention_2=='gansh23_4'){
							$score = 5;
						}
						
						// for Q7 score calculate
							if($stage_of_devolpment=='a'){
								$score7 = 10;
							}
								
							if($stage_of_devolpment=='b'){
								$score7 = 15;
							}
								
							if($stage_of_devolpment=='c'){
								$score7 = 25;
							}
								
							if($stage_of_devolpment=='d'){
								$score7 = 45;
							}
						
					}
										
				
					
					/* echo $total_6_7;
					die(); */
				}
			 	$total_6_7 = $score*$parent + $score7;
			
				
				
				
				
				$invention_inventor = $this->user_model->get_invention_inventor_by_id($id);
				$top_rank_id = '';
				$top_rank_score = 0;
				
					foreach($invention_inventor as $inventor_data1){
						$score_q3_1 = 0 ;
						if($inventor_data1['institutional']=='Gansh1'){
							$score_q3_1 = 2;
						}
						
						if($inventor_data1['institutional']=='Gansh2'){
							$score_q3_1 = 1.5;
						}
						
						if($inventor_data1['institutional']=='Gansh3'){
							$score_q3_1 = 1.25;
						}
						
						if($inventor_data1['institutional']=='Gansh4'){
							$score_q3_1 = 1;
						}
						
						if($inventor_data1['institutional']=='Gansh5'){
							$score_q3_1 = 0.75;
						}
						
						if($inventor_data1['institutional']=='Gansh6'){
							$score_q3_1 = 0.5;
						}
						
						if($inventor_data1['institutional']=='Gansh7'){
							$score_q3_1 = 0;
						}
						
						/* 					
						if(strtolower($inventor_data1['institutional'])=='Visiting scientist' || strtolower($inventor_data1['institutional'])=='visiting scientist'){
					
							$score_q3_1 = 1.25;
						}
						 */
						
						
						
						
						if($score_q3_1 >= $top_rank_score){
							$top_rank_id = $inventor_data1['id'];
							$top_rank_score = $score_q3_1;
						}
						
					}
					/* echo $top_rank_score;
					die("here"); */
				
				$score_q3_total = 0 ;
				if(!empty($invention_inventor)){
					foreach($invention_inventor as $inventor_data){
					
						if($inventor_data['id']==$top_rank_id){
					

							$score_q3_2 = 0 ;
							
							
							if($inventor_data['count_inventor']>=2 && $inventor_data['count_inventor']<=4){
								$score_q3_2 = 0.1;
							}
							if($inventor_data['count_inventor']>=5 && $inventor_data['count_inventor']<10){
								//$score_q3_2 = 0.2;
								$score_q3_2 = 0.25;
							}
							if($inventor_data['count_inventor']>=10 && $inventor_data['count_inventor']<=15){
								//$score_q3_2 = 0.3;
								$score_q3_2 = 0.6;
							}
							if($inventor_data['count_inventor']>15){
								//$score_q3_2 = 0.3;
								$score_q3_2 = 1.0;
							}
							
							/* echo $score_q3_2;
							die(); */
							$score_q3_total += $top_rank_score + $score_q3_2  ; 
						}
					}	
				
				}
				/* echo $score_q3_total;
				die(); */ 
				
				
				//Calculate score for question no 5.
				$score_q5 = 0;
				
				if(isset($_POST['invention_type'])){
					if($_POST['invention_type']=='patent'){
						$score_q5 = 20;
					}
					if($_POST['invention_type']=='cr_sw'){
						$score_q5 = 10;
					}
					if($_POST['invention_type']=='bio_organism'){
						$score_q5 = 5;
					}
					if($_POST['invention_type']=='know_how'){
						$score_q5 = 3;
					}
				}
				//echo $score_q3_total;
				// echo $score_q5;
				/*  echo $total_6_7;
				die;  */
				
					// Q#6a(A(i) *1\974) or (A(ii)*1-4) or (A(iii) * 1-5)+ Q#7 
					// [((Q#3(i)(a)+3(ii))*Q#5) + (Q#6a(A(i) *1\974) or (A(ii)*1-4) or (A(iii) * 1-5) + Q#7]
				
				
				//$final_score = ($total_6_7*$score_q5) + $total_6_7 ; 
				$final_score = ($score_q3_total*$score_q5) + $total_6_7 ; 
				//echo $final_score;die;
			
				$data['final_score'] = $final_score ; 
				$data['status'] = 'field' ; 
				
				}else{
					
					$data['final_score'] = 0; 
					$data['status'] = 'open' ; 
				}
				// print_pre($data);
				// die;
				$this->user_model->update_invention($data,$id);
				/* if(isset($_POST['next'])){
					redirect('user/invention5/'.$id,'refresh');	
				}else{
					redirect('user/logout');	
				} */
				
				$percentage = $this->calculate_percentage($id);	

			//die("here");
				if(isset($_POST['link_redir_page'])){
					
					
					if($_POST['link_redir_page']=="ii"){
					redirect('user/invention/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="tech"){
					redirect('user/invention1/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="ip"){
					redirect('user/invention2/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="com"){
					redirect('user/invention3/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="score"){
					redirect('user/score/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="tech_score"){
					
						if($this->session->userdata('user_type')==2){
					
							redirect('user/score/'.$id,'refresh');
						}else{
							redirect('user/score/'.$id.'/tech_score','refresh');
						}
					}
					if($_POST['link_redir_page']=="exit"){
					redirect('user/logout');
					}
				
				}else{
					redirect('user/logout');	
				}
			}
	
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		$this->page_data['invention_inventor'] = $this->user_model->get_invention_inventor($id);
		
		
		$this->page_data['invention_id'] = $id;
		
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_invention1',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
	
	}
	
	
	function invention2(){
		$this->page_data['page_title'] = 'User | Invention' ;
		
		$id =  $this->uri->segment(3) ; 
		
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
		$access_allowed = $this->check_access_param($id);
		if($access_allowed==false){
			redirect('home','refresh');
		} 
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
		
					$data = array();
					$grant_documents = '';
					//$already_invention_doc = '';
					
					/* print_pre($_POST);
					die("ethan");  */
					
					if(isset($_FILES['already_invention_doc']) && $_FILES['already_invention_doc']['name']!=''){
					
					
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						// Load the upload library 
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('already_invention_doc'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							
							$already_invention_doc = $image_data['file_name'];
						}
					$data['already_invention_doc'] = $already_invention_doc;
					$this->user_model->update_invention($data,$id);
					}
					
					if(isset($_FILES['journal_invention_doc']) && $_FILES['journal_invention_doc']['name']!=''){
					
					
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						// Load the upload library 
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('journal_invention_doc'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							
							$journal_invention_doc = $image_data['file_name'];
						}
					$data['journal_invention_doc'] = $journal_invention_doc;
					$this->user_model->update_invention($data,$id);
					}
					
					if(isset($_FILES['upcoming_invention_doc']) && $_FILES['upcoming_invention_doc']['name']!=''){
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						// Load the upload library 
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('upcoming_invention_doc'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							$upcoming_invention_doc = $image_data['file_name'];
						}
					$data['upcoming_invention_doc'] = $upcoming_invention_doc;
					$this->user_model->update_invention($data,$id);
					}
					
					if(isset($_FILES['submitted_invention_doc']) && $_FILES['submitted_invention_doc']['name']!=''){
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						// Load the upload library 
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('submitted_invention_doc'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							$submitted_invention_doc = $image_data['file_name'];
						}
					$data['submitted_invention_doc'] = $submitted_invention_doc;
					$this->user_model->update_invention($data,$id);
					}
					
			
				
				
				// calculate score
				
				//Q#11A1+?Q#11A2+?Q#11B)*?Q#12] + 10A + 10B +10C.
				
			if(isset($_POST['link_redir_page'])){
				
					// print_pre($_POST);die;
					
					
				//score 10a
				$score_10A  =0;
				$data['already_invention'] 			= '' ;
				$data['already_invention_date'] 	= '0000-00-00 00:00:00';
				$data['journal_invention_date'] 	= '0000-00-00 00:00:00';
				if(isset($_POST['already_invention'])){
			
					if($_POST['already_invention']=='Yes' && $_POST['already_invention_date']!=''){
				
						$data['already_invention'] = $_POST['already_invention'] ;
						$data['already_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['already_invention_date']));
						$score_10A  -=10;
					
					}
					
					if($_POST['already_invention']=='Yes1' && $_POST['journal_invention_date']!=''){
				
						$data['already_invention'] = $_POST['already_invention'] ;
						$data['journal_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['journal_invention_date']));
						$score_10A  -=20;
					
					}
				
					if($_POST['already_invention']=='No'){
						$data['already_invention'] = $_POST['already_invention'] ;
						$data['already_invention_date'] = '0000-00-00 00:00:00';
					}
			
				}
			
				//score 10b
				$score_10B  =0;
				$data['upcoming_invention'] = '';
				$data['upcoming_invention_date'] = '0000-00-00 00:00:00';
				if(isset($_POST['upcoming_invention'])){
			
					if($_POST['upcoming_invention']=='Yes' && $_POST['upcoming_invention_date']!=''){
				
						$data['upcoming_invention'] = $_POST['upcoming_invention'] ;
						$data['upcoming_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['upcoming_invention_date']));
						$score_10B  +=10;
					}
					
					if($_POST['upcoming_invention']=='No'){
						$data['upcoming_invention'] = $_POST['upcoming_invention'] ;
						$data['upcoming_invention_date'] = '0000-00-00 00:00:00';
					}
				}
				
			
				//score 10c	
				$score_10C  =0;
				$data['submitted_invention'] = '';
				$data['submitted_invention_date'] = '0000-00-00 00:00:00';				
				if(isset($_POST['submitted_invention'])){
				
					if($_POST['submitted_invention']=='Yes' && $_POST['submitted_invention_date']!=''){
				
						$data['submitted_invention'] = $_POST['submitted_invention'] ;
						$data['submitted_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['submitted_invention_date']));
						$score_10C  +=20;
						
					}
					
					if($_POST['submitted_invention']=='No'){
						$data['submitted_invention'] = $_POST['submitted_invention'] ;
						$data['submitted_invention_date'] = '0000-00-00 00:00:00';
					}
					
				}
					
				//10d
				$score_10D=0;
				$data['plan_invention'] = '';
				$data['plan_invention_date']= '0000-00-00 00:00:00';
				if(isset($_POST['plan_invention'])){
				
					$data['plan_invention'] = $_POST['plan_invention'] ;
							
					if($_POST['plan_invention']=='No' || $_POST['plan_invention']==''){
							
						$data['plan_invention_date']= '0000-00-00 00:00:00';
							
					}
						
					if(isset($_POST['plan_invention_date']) && $_POST['plan_invention']=='Yes'){
					
						$data['plan_invention_date'] = date("Y-m-d H:i:s",strtotime($_POST['plan_invention_date']));
						$score_10D  +=5;
					} 
				
				}
			
				//11
				$data['input_key_invention']='';
				if(isset($_POST['input_key_invention'])){
				
					$data['input_key_invention'] = $_POST['input_key_invention'];
				}
				
				//score 11a1
				$score_11A1 =0;				
				$data['prior_inventions']='';
				if(isset($_POST['result_11a1']) && !empty($_POST['result_11a1'])){
				
					$data['prior_inventions']=json_encode($_POST['result_11a1']);
						$prior_inventions=$_POST['result_11a1'];
						// print_pre($prior_inventions);die;
						foreach($prior_inventions as $result){
						//print_pre($result);die;
						
							//$invention_data = $this->user_model->get_invention_by_id($result['id']);
							
							//print_pre($invention_data);
						
							if($result['status']!='closed'){
							
								if($result['radio_11a1']=='Yes'){
							
									$score_11A1 +=10;
									
								}
								if($result['radio_11a1']=='May be'){
								
									$score_11A1 +=5;
									
								}
							}  
						}
				
				
				}
				/* if(isset($_POST['radio_11a1']) && !empty($_POST['radio_11a1'])){
					
						$data['prior_inventions']=json_encode($_POST['radio_11a1']);
						$prior_inventions=$_POST['radio_11a1'];
						// print_pre($prior_inventions);die;
						foreach($prior_inventions as $key=>$value){
						//print_pre($key);
							$invention_data = $this->user_model->get_invention_by_id($key);
							
							//print_pre($invention_data);
						
							if($invention_data['status']!='closed'){
							
								if($value=='Yes'){
							
									$score_11A1 +=10;
									
								}
								if($value=='May be'){
								
									$score_11A1 +=5;
									
								}
							}  
						}
/* echo $score_11A1 ; 
die("here");
 */
				//}
				 

				//score 11a2
				$score_11A2 =0;
				$data['other_inventions']='';
				if(isset($_POST['result_11a2']) && !empty($_POST['result_11a2'])){
					
						$data['other_inventions']=json_encode($_POST['result_11a2']);
						$other_inventions=$_POST['result_11a2'];
						//print_pre($prior_inventions);die;
						foreach($other_inventions as $result){
						//print_pre($key);
							//$other_invention_data = $this->user_model->get_invention_by_id($key);
							
							//print_pre($other_invention_data);
						
							if(isset($result['radio_11a2']) && $result['status']!='closed'){
							
								if($result['radio_11a2']=='Yes'){
							
									$score_11A2 +=10;
									
								}
								if($result['radio_11a2']=='May be'){
							
									$score_11A2 +=5;
									
								}
								
							}  
						
						}
				}
				
				
				/* if(isset($_POST['radio_11a2']) && !empty($_POST['radio_11a2'])){
					
						$data['other_inventions']=json_encode($_POST['radio_11a2']);
						$other_inventions=$_POST['radio_11a2'];
						//print_pre($prior_inventions);die;
						foreach($other_inventions as $key=>$value){
						//print_pre($key);
							$other_invention_data = $this->user_model->get_invention_by_id($key);
							
							//print_pre($other_invention_data);
						
							if($other_invention_data['status']!='closed'){
							
								if($value=='Yes'){
							
									$score_11A2 +=10;
									
								}
								if($value=='May be'){
							
									$score_11A2 +=5;
									
								}
								
							}  
						
						}
				} */
				
				//11b
				
				$data['result_11b']='';
				$score_11b=0;
				if(isset($_POST['result_11b']) && !empty($_POST['result_11b'])){
				
					 // print_pre($_POST['result_11b']);die();
					
					$data['result_11b']=json_encode($_POST['result_11b']);
					
						foreach($_POST['result_11b'] as $rresult){
						
						//print_pre($rresult);
							 if(isset($rresult['radio_11b'])){
								
								$value=$rresult['radio_11b'];
								if($value=='least_relevant'){
									
									$score_11b +=3;
								}
								if($value=='somewhat_relevant'){
									$score_11b +=2;
								}
								if($value=='relevant'){
									$score_11b -=2;
								}
								if($value=='most_relevant'){
									$score_11b -=3;
								}
							} 
						}			
				}
				
				//11b2
				
				/* $data['result_11b2']='';
				if(isset($_POST['result_11b2']) && !empty($_POST['result_11b2'])){
				
					// print_pre($_POST['result_11b2']);
					
					$data['result_11b2']=json_encode($_POST['result_11b2']);
					
						foreach($_POST['result_11b2'] as $rresult){
						
						
							 if(isset($rresult['radio_11b2'])){
								
								$value=$rresult['radio_11b2'];
								if($value=='Yes'){
									
									$score_11b +=-2;
								}
								if($value=='No'){
									$score_11b +=3;
								}
								if($value=='May Be'){
									$score_11b +=1;
								}
								if($value=='Already Assigned'){
									$score_11b +=0;
								}
							} 
						}			
				} */
				
				
			$data['result_11b2']='';
		
			if(isset($_POST['result_11b2']) && !empty($_POST['result_11b2'])){
			
				
				//print_pre($_POST['result_11b2']);die;
					
					$new11b = array();
					$q11b = array();
					$q11b = $_POST['result_11b2'] ; 
					
					foreach($q11b as $key => $rresult){
					
					//print_pre($rresult);die;
						 if(isset($rresult['radio_11b2'])){
							
							$value=$rresult['radio_11b2'];
							if($value=='least_relevant'){
								
								$score_11b +=3;
							}
							if($value=='somewhat_relevant'){
								$score_11b +=2;
							}
							if($value=='relevant'){
								$score_11b -=2;
							}
							if($value=='most_relevant'){
								$score_11b -=3;
							}
						
						} 
						$rresult['desc'] 	=  htmlentities($rresult['desc']) ; 
						$rresult['title'] 	=  htmlentities($rresult['title']) ; 
						$rresult['details'] =  htmlentities($rresult['details']) ; 
						$new11b[]	 = $rresult ; 
						
						
					}
				//print_pre($new11b);die;
				$data['result_11b2']=json_encode($new11b);
					
			}
			
					
				//12
					$score_12_1=0;
					$data['distinct_aspects1']='';
					if(isset($_POST['distinct_aspects1']) && !empty($_POST['distinct_aspects1'])){
						
						$data['distinct_aspects1']=$_POST['distinct_aspects1'];
						$parts=explode(' ',trim($_POST['distinct_aspects1']));
						 $count=count($parts);
						if($count>=5){
							$score_12_1 +=3;
						}
					}
					
					$data['distinct_aspects2']='';
					if(isset($_POST['distinct_aspects2']) && !empty($_POST['distinct_aspects2'])){
						
						$data['distinct_aspects2']=$_POST['distinct_aspects2'];
						 $parts=explode(' ',trim($_POST['distinct_aspects2']));
						 $count=count($parts);
						if($count>=5){
							$score_12_1 +=3;
						}
					}
					
					$data['distinct_aspects3']='';
					if(isset($_POST['distinct_aspects3']) && !empty($_POST['distinct_aspects3'])){
						
						$data['distinct_aspects3']=$_POST['distinct_aspects3'];
						$parts=explode(' ',trim($_POST['distinct_aspects3']));
						 $count=count($parts);
						if($count>=5){
							$score_12_1 +=3;
						}
					}
					
					/* echo $score_12_1;
					die; */
					
					//$final_score = $score_11A1+$score_11A2 +$score_11b $score_10A + $score_10B + $score_10C ; 
					
					$final_score = $score_11A1+$score_11A2;
					//$final_score += $score_11b*$score_12_1;
					$final_score += $score_11b+$score_12_1;
					$final_score += $score_10A;
					$final_score += $score_10B;
					$final_score += $score_10C;
					$final_score += $score_10D;
					$data['module3_score'] = $final_score ;
					// echo $final_score;
					// die(); 
			}else{
					/* echo $final_score;
					die(); */
					$data['module3_score'] = 0; 
			}
			//print_pre($data);die;
				$this->user_model->update_invention($data,$id);
				$percentage = $this->calculate_percentage($id);	
			//die("here");	
				if(isset($_POST['link_redir_page'])){
					
					
					if($_POST['link_redir_page']=="ii"){
					redirect('user/invention/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="tech"){
					redirect('user/invention1/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="ip"){
					redirect('user/invention2/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="com"){
					redirect('user/invention3/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="ip_score"){
						
						if($this->session->userdata('user_type')==2){
					
							redirect('user/score/'.$id,'refresh');
						}else{
					
						redirect('user/score/'.$id.'/ip_score','refresh');
						}
					}
					if($_POST['link_redir_page']=="exit"){
					redirect('user/logout');
					}
				
				}else{
					redirect('user/logout');	
				}
				
			}
	 
		
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		
		//print_pre($this->page_data['invention_data']['input_key_invention']);die();
		
		if($this->page_data['invention_data']['input_key_invention']!=''){
			
			//$search_title=$this->page_data['invention_data']['input_key_invention'];
			//$this->page_data['$result_11a']=$this->user_model->search_result_11a($id,$search_title,$qno='11a1');
			//$this->page_data['$result_11b']=$this->user_model->search_result_11a($id,$search_title,$qno='11b1'); 
		
		
		}
		
		$this->page_data['invention_inventor'] = $this->user_model->get_invention_inventor($id);
		$this->page_data['invention_id'] = $id;
		/* 
		 echo "<pre>";
		print_r($this->page_data);
		die("here"); */ 
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_invention2',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
		
	
	}
	
	
	
	function invention3(){
		$this->page_data['page_title'] = 'User | Invention' ;
		
		$id =  $this->uri->segment(3) ; 
		//die($id);
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
		$access_allowed = $this->check_access_param($id);
		if($access_allowed==false){
			redirect('home','refresh');
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST'){
					$data = array();
				
			/*   print_pre($_FILES);
			die("here");   */
			//[13a * 13c] + 14 (a) + [14(b(i)*2) *14(c)] + ??15(1)-(10).
				
				//$data['signature'] ="";
				if(isset($_FILES['signature']) && $_FILES['signature']['name']!=''){
					
					
						$config['upload_path'] = 'data/common/common_nones_name/'; 
						$config['allowed_types'] = '*';

						$config['max_size']	= '500000';
						// Load the upload library 
						$config['file_name']        = md5(time())."_".$_FILES['signature']['name'];
						$this->load->library('upload', $config);
						
						if ( ! $this->upload->do_upload('signature'))
						{
							echo $this->upload->display_errors();die;
							$error = array('error' => $this->upload->display_errors());
							print_pre($error) ;
							die;
						}else{
							$image_data = $this->upload->data();
							//print_pre($image_data);die;
							$signature = $image_data['file_name'];
						}
						$data['signature'] = $signature;
					$this->user_model->update_invention($data,$id);
					}
				
				
				//13
				$score_13_total=0;
				if(isset($_POST['invention']) && $_POST['invention']!=''){
				
					$this->user_model->delete_invention_project($_POST['invention_id']);
					
					foreach( $_POST['invention'] as $inv_data ){
					 //print_pre($inv_data);die;
					 
						if(isset($inv_data['have_worked']) && $inv_data['have_worked']!=''){
					 
							$score_13a=0;
							$project['have_worked'] = '' ;
							$project['company_name'] = '' ;
							$project['mta'] = '' ;
							$project['sra'] = '' ;
							$project['scientific'] = '' ;
							$project['clinical_trial'] = '' ;
							$project['consulting'] = '' ;
							
							if(isset($inv_data['have_worked'])){
							
								$project['have_worked'] = $inv_data['have_worked'] ;
								
								if($inv_data['have_worked']=='Yes'){
									$score_13a=5;
								}
								if($inv_data['have_worked']=='In-disk'){
									$score_13a=3;
								}
									
							}
							if(isset($inv_data['have_worked']) || isset($inv_data['have_worked'])){	
							
								if($inv_data['have_worked']=='Yes' || $inv_data['have_worked']=='In-disk'){
								
									if(isset($inv_data['company_name'])){
									
											$project['company_name'] = $inv_data['company_name'] ;
											
									}
								
									if(isset($inv_data['mta'])){
											$project['mta'] = $inv_data['mta'] ;
											$score_13_total += $score_13a*2;
									}
								
									if(isset($inv_data['sra'])){
											$project['sra'] = $inv_data['sra'] ;
											$score_13_total += $score_13a*3;
									}
								
									if(isset($inv_data['scientific'])){
											$project['scientific'] = $inv_data['scientific'] ;
											$score_13_total += $score_13a*1;
									}
								
									if(isset($inv_data['clinical_trial'])){
											$project['clinical_trial'] = $inv_data['clinical_trial'] ;
											$score_13_total += $score_13a*2;
									}
								
									if(isset($inv_data['consulting'])){
											$project['consulting'] = $inv_data['consulting'] ;
											$score_13_total += $score_13a*2;
									}
									if(isset($inv_data['other'])){
										$project['other'] = $inv_data['other'] ;
										//$score_13_total += $score_13a*2;
										
										if(isset($inv_data['textother'])){
											
											$project['textother'] = $inv_data['textother'] ;
											
										}
									}
								}
							}	
							/*score*/
							/* if($score_13c>$score_13c_big){
							
								$score_13c_big=$score_13c;
							} */
							/*score*/
							
							$project['invention_id'] =$_POST['invention_id'];
							
							//print_pre($project);die;
							
							if(isset($inv_data['project_id']) && ($inv_data['project_id']=='new')){
							
								$this->user_model->add_invention_project($project);
							}
							else{

								$this->user_model->update_invention_project($project,$inv_data['project_id']);
							}
							//print_pre($project);die;
						
						}
					 
					}
					
				}else{
				
					$this->user_model->delete_invention_project($_POST['invention_id']);
				}	
				
				//echo $score_13_total;
				//14a
				$score_14a=0;
				$data['estimated_size'] = '';
				if(isset($_POST['estimated_size']) && $_POST['estimated_size']!=''){
				
					$data['estimated_size'] = $_POST['estimated_size'] ;
					/*score*/
					if($_POST['estimated_size'] =='<100k'){
						
						$score_14a += 5;
					}
					if($_POST['estimated_size'] =='100k-1m'){
						
						$score_14a += 7;
					}
					if($_POST['estimated_size'] =='>1m'){
						
						$score_14a += 10;
					}
				}
				//14b
				$score_14b1=0;
				if(isset($_POST['products_exist']) && $_POST['products_exist']!=''){
					if($_POST['products_exist']=="Yes"){
						
						if(isset($_POST['products_count']) && $_POST['products_count']!=''){
						
							if(isset($_POST['product_count']) && $_POST['product_count']!=''){

								if($_POST['product_count']=='Yes'){
									
									if(isset($_POST['products_name']) && $_POST['products_name']!=''){ 
									$data['product_count'] = $_POST['product_count'] ;
									$data['products_count'] = $_POST['products_count'] ;
									$data['products_exist'] = $_POST['products_exist'] ;
									$data['products_name'] = $_POST['products_name'] ;
									/*score*/
										$q14b1=!empty($_POST['products_count'])? $_POST['products_count'] : 0;
										//die($_POST['products_count']);
										//$score_14b1=$q14b1*2;
										$score_14b1=$q14b1;
									/*score*/
									}
								}
								if($_POST['product_count']=='No'){
									$data['products_exist'] = $_POST['products_exist'] ;
									$data['product_count'] = $_POST['product_count'] ;
									$data['products_count'] = $_POST['products_count'] ;
									$q14b1=!empty($_POST['products_count'])? $_POST['products_count'] : 0;

										//$score_14b1=$q14b1*2;
										$score_14b1=$q14b1;
								}
							}
						}
						
					}else{
					
						$data['products_exist'] = $_POST['products_exist'] ;
						$data['products_count'] = '';
						$data['product_count'] = '';
						$data['products_name'] = '';

					}
				}else{
					$data['products_exist'] = '' ;
					$data['products_count'] = '';
					$data['products_name'] = '';
					$data['product_count'] = '';
				}
				
				//14c
				$score_14c=0;
				$data['limitations'] = '';
				if(isset($_POST['limitations']) && $_POST['limitations']!=''){
					$data['limitations'] = $_POST['limitations'] ;
					/*score*/
					if($_POST['limitations'] == 'Yes'){
						$score_14c +=2;
					}
					if($_POST['limitations'] == 'No'){
						$score_14c +=0;
					}
					if($_POST['limitations'] == 'Maybe'){
						$score_14c +=1.25;
					}
					if($_POST['limitations'] == 'Not Sure'){
						$score_14c +=1;
					}
					
				}
				
				//15b
				$data['result_15b']='';
				$score_15b=0;
				if(isset($_POST['result_15b']) && !empty($_POST['result_15b'])){
				
				//print_pre($_POST['result_15b']);die;
				
					$data['result_15b']=json_encode($_POST['result_15b']);
					
					foreach($_POST['result_15b'] as $rresult){
					
						if(isset($rresult['radio_15b'])){
						
							$value=$rresult['radio_15b'];
							if($value=='least_likely'){
								
								$score_15b += 0;
							}
							if($value=='somewhat_likely'){
								$score_15b += 0.5;
							}
							if($value=='likely'){
								$score_15b += 1;
							}
							if($value=='very_likely'){
								$score_15b += 2;
							}
							if($value=='duplicate'){
								$score_15b +=0;
							}
						}
					}	
				}
				
				//15
				$data['result_15']='';
				if(isset($_POST['result_15']) && !empty($_POST['result_15'])){
				
					$data['result_15']=json_encode($_POST['result_15']);
					
					foreach($_POST['result_15'] as $rresult){
					
						if(isset($rresult['radio_15'])){
						
							$value=$rresult['radio_15'];
							if($value=='least_likely'){
								
								$score_15b += 0;
							}
							if($value=='somewhat_likely'){
								$score_15b += 0.5;
							}
							if($value=='likely'){
								$score_15b += 1;
							}
							if($value=='very_likely'){
								$score_15b += 2;
							}
							if($value=='duplicate'){
								$score_15b +=0;
							}
						}
					}	
				}
				//15search
				
				$data['search_15']='';
				if(isset($_POST['search_15']) && !empty($_POST['search_15'])){
				
					$data['search_15']=$_POST['search_15'];
				}
				
				if($this->session->userdata('user_type')==2){
					//15c
					$data['pdfresult']='';
					if(isset($_POST['result_15c']) && !empty($_POST['result_15c'])){
					
						$data['pdfresult']=json_encode($_POST['result_15c']);
					
					}
					
					$data['big_company_count']='';
					if(isset($_POST['big_company_count']) && !empty($_POST['big_company_count'])){
						if(is_numeric($_POST['big_company_count'])){
						$data['big_company_count']=$_POST['big_company_count'];
						}
					}
					
					$data['small_company_count']='';
					if(isset($_POST['small_company_count']) && !empty($_POST['small_company_count'])){
						if(is_numeric($_POST['small_company_count'])){
						$data['small_company_count']=$_POST['small_company_count'];
						}
					}
					$data['text_pdfsearch']='';
					if(isset($_POST['text_pdfsearch']) && !empty($_POST['text_pdfsearch'])){
					
						$data['text_pdfsearch']=$_POST['text_pdfsearch'];
					
					}
				}
				
				//print_pre($data);
				/*scoring start*/
				//[13a * 13c] + 14 (a) + [14(b(i)*2) *14(c)] + ??15(1)-(10). 
				
				$total=0;
				$total +=$score_13_total;
				//print_pre($score_14c);die;
				$total += $score_14a;
				$total += $score_14b1 * $score_14c;
				//$total += $score_14c;
				
				$total += $score_15b ;
				
				$data['module4_score'] =$total;
				/*scoring start*/
				//print_pre($total);die;
				$this->user_model->update_invention($data,$id);
				$percentage = $this->calculate_percentage($id);	
				// print_pre($_POST);die;
				
				if(isset($_POST['link_redir_page'])){
					
					
					if($_POST['link_redir_page']=="ii"){
					redirect('user/invention/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="tech"){
						redirect('user/invention1/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="ip"){
						redirect('user/invention2/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="com"){
						redirect('user/invention3/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="com_score"){
					
						if($this->session->userdata('user_type')==2){
					
							redirect('user/score/'.$id,'refresh');
						}else{
					
							redirect('user/score/'.$id.'/com_score','refresh');
						}
					}
					if($_POST['link_redir_page']=="submit"){
					
						$result_msz = $this->check_validation($id);
						
						if(!empty($result_msz)){
							//print_pre($result_msz);
							$this->page_data['not_filled'] = $result_msz;
						}else{
							redirect('user/complete/'.$id,'refresh');
						}
					}
					if($_POST['link_redir_page']=="score"){
						redirect('user/score/'.$id,'refresh');
					}
					if($_POST['link_redir_page']=="exit"){
						redirect('user/logout');
					}
				
				}else{
					redirect('user/logout');	
				}
				
			}
	 
		
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		
		//print_pre($this->page_data['invention_data']['abstract_invantion']);die();
		
		
		$this->page_data['invention_inventor']  = $this->user_model->get_invention_inventor($id);
		$this->page_data['invention_id'] = $id;
		$this->page_data['project'] = $this->user_model->fetch_invention_project($id);
		/* 
		 echo "<pre>";
		print_r($this->page_data);
		die("here"); */ 
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_invention3',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
		
	
	}
	
	function complete(){
		$this->page_data['page_title'] = 'User | Invention' ;
		
		$id =  $this->uri->segment(3) ; 
		
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
	
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		$this->page_data['invention_inventor'] = $this->user_model->get_invention_inventor($id);
		$this->page_data['invention_id'] = $id;
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_complete',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
		
	
	}
	
	function invention6(){
		$this->page_data['page_title'] = 'User | Invention' ;
		
		$id =  $this->uri->segment(3) ; 
		
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
	
	
	
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_invention6',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
		
	
	}
	
	function score(){
		$this->page_data['page_title'] = 'User | Invention' ;
		
		$id =  $this->uri->segment(3) ; 
		
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
	
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		$this->page_data['invention_inventor'] = $this->user_model->get_invention_inventor($id);
		$this->page_data['invention_id'] = $id;
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_score',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
		
	
	}
	
	
	function form4_save(){
		
				$data = array();
				
				//13
				$score_13_total=0;
				if(isset($_POST['invention']) && $_POST['invention']!=''){
				
					$this->user_model->delete_invention_project($_POST['invention_id']);
					
					foreach( $_POST['invention'] as $inv_data ){
					 //print_pre($inv_data);die;
					 
						if(isset($inv_data['have_worked']) && $inv_data['have_worked']!=''){
					 
							$score_13a=0;
							$project['have_worked'] = '' ;
							$project['company_name'] = '' ;
							$project['mta'] = '' ;
							$project['sra'] = '' ;
							$project['scientific'] = '' ;
							$project['clinical_trial'] = '' ;
							$project['consulting'] = '' ;
							$project['other'] = '' ;
							$project['textother'] = '' ;
							
							if(isset($inv_data['have_worked'])){
							
								$project['have_worked'] = $inv_data['have_worked'] ;
								
								if($inv_data['have_worked']=='Yes'){
									$score_13a=5;
								}
								if($inv_data['have_worked']=='In-disk'){
									$score_13a=3;
								}
									
							}
							if(isset($inv_data['have_worked']) || isset($inv_data['have_worked'])){	
							
								if($inv_data['have_worked']=='Yes' || $inv_data['have_worked']=='In-disk'){
								
									if(isset($inv_data['company_name'])){
									
											$project['company_name'] = $inv_data['company_name'] ;
											
									}
								
									if(isset($inv_data['mta'])){
											$project['mta'] = $inv_data['mta'] ;
											$score_13_total += $score_13a*2;
									}
								
									if(isset($inv_data['sra'])){
											$project['sra'] = $inv_data['sra'] ;
											$score_13_total += $score_13a*3;
									}
								
									if(isset($inv_data['scientific'])){
											$project['scientific'] = $inv_data['scientific'] ;
											$score_13_total += $score_13a*1;
									}
								
									if(isset($inv_data['clinical_trial'])){
											$project['clinical_trial'] = $inv_data['clinical_trial'] ;
											$score_13_total += $score_13a*2;
									}
								
									if(isset($inv_data['consulting'])){
											$project['consulting'] = $inv_data['consulting'] ;
											$score_13_total += $score_13a*2;
									}
									if(isset($inv_data['other'])){
										$project['other'] = $inv_data['other'] ;
										//$score_13_total += $score_13a*2;
										
										if(isset($inv_data['textother'])){
											
											$project['textother'] = $inv_data['textother'] ;
											
										}
									}
									
								}
							}	
							
							
							$project['invention_id'] =$_POST['invention_id'];
							
							//print_pre($project);die;
							
							if(isset($inv_data['project_id']) && ($inv_data['project_id']=='new')){
							
								$this->user_model->add_invention_project($project);
							}
							else{

								$this->user_model->update_invention_project($project,$inv_data['project_id']);
							}
							//print_pre($project);die;
						
						}
					 
					}
					
				}else{
				
					$this->user_model->delete_invention_project($_POST['invention_id']);
				}	
				
				//echo $score_13_total;
				//14a
				$score_14a=0;
				$data['estimated_size'] = '';
				if(isset($_POST['estimated_size']) && $_POST['estimated_size']!=''){
				
					$data['estimated_size'] = $_POST['estimated_size'] ;
					/*score*/
					if($_POST['estimated_size'] =='<100k'){
						
						$score_14a += 5;
					}
					if($_POST['estimated_size'] =='100k-1m'){
						
						$score_14a += 7;
					}
					if($_POST['estimated_size'] =='>1m'){
						
						$score_14a += 10;
					}
				}
				//14b
				$score_14b1=0;
				if(isset($_POST['products_exist']) && $_POST['products_exist']!=''){
					if($_POST['products_exist']=="Yes"){
						
						if(isset($_POST['products_count']) && $_POST['products_count']!='' && is_numeric($_POST['products_count'])){
							//echo $_POST['products_count'];
							//die("here");
							if($_POST['products_count']>=1 && $_POST['products_count']<=5){
							if(isset($_POST['product_count']) && $_POST['product_count']!=''){

								if($_POST['product_count']=='Yes'){
									
									if(isset($_POST['products_name']) && $_POST['products_name']!=''){ 
									$data['product_count'] = $_POST['product_count'] ;
									$data['products_count'] = $_POST['products_count'] ;
									$data['products_exist'] = $_POST['products_exist'] ;
									$data['products_name'] = $_POST['products_name'] ;
									/*score*/
										$q14b1=!empty($_POST['products_count'])? $_POST['products_count'] : 0;
										//die($_POST['products_count']);
										//$score_14b1=$q14b1*2;
										$score_14b1=$q14b1;
									/*score*/
									}
								}
								if($_POST['product_count']=='No'){
									$data['products_exist'] = $_POST['products_exist'] ;
									$data['product_count'] = $_POST['product_count'] ;
									$data['products_count'] = $_POST['products_count'] ;
									$q14b1=!empty($_POST['products_count'])? $_POST['products_count'] : 0;

										//$score_14b1=$q14b1*2;
										$score_14b1=$q14b1;
								}
							}
							}
						}
						
					}else{
					
						$data['products_exist'] = $_POST['products_exist'] ;
						$data['products_count'] = '';
						$data['product_count'] = '';
						$data['products_name'] = '';

					}
				}else{
					$data['products_exist'] = '' ;
					$data['products_count'] = '';
					$data['products_name'] = '';
					$data['product_count'] = '';
				}
				
				//14c
				$score_14c=0;
				$data['limitations'] = '';
				if(isset($_POST['limitations']) && $_POST['limitations']!=''){
					$data['limitations'] = $_POST['limitations'] ;
					/*score*/
					if($_POST['limitations'] == 'Yes'){
						$score_14c +=2;
					}
					if($_POST['limitations'] == 'No'){
						$score_14c +=0;
					}
					if($_POST['limitations'] == 'Maybe'){
						$score_14c +=1.25;
					}
					if($_POST['limitations'] == 'Not Sure'){
						$score_14c +=1;
					}
					
				}
				
				//15b
				$data['result_15b']='';
				$score_15b=0;
				//print_pre($_POST['result_15b']);die;
				if(isset($_POST['result_15b']) && !empty($_POST['result_15b'])){
				
					$data['result_15b']=json_encode($_POST['result_15b']);
					
					foreach($_POST['result_15b'] as $rresult){
					
						if(isset($rresult['radio_15b'])){
						
							$value=$rresult['radio_15b'];
							if($value=='least_likely'){
								
								$score_15b += 0;
							}
							if($value=='somewhat_likely'){
								$score_15b += 0.5;
							}
							if($value=='likely'){
								$score_15b += 1;
							}
							if($value=='very_likely'){
								$score_15b += 2;
							}
							if($value=='duplicate'){
								$score_15b +=0;
							}
						}
					}	
				}
				
				//15
				$data['result_15']='';
				if(isset($_POST['result_15']) && !empty($_POST['result_15'])){
				
					$data['result_15']=json_encode($_POST['result_15']);
					
					foreach($_POST['result_15'] as $rresult){
					
						if(isset($rresult['radio_15'])){
						
							$value=$rresult['radio_15'];
							if($value=='least_likely'){
								
								$score_15b += 0;
							}
							if($value=='somewhat_likely'){
								$score_15b += 0.5;
							}
							if($value=='likely'){
								$score_15b += 1;
							}
							if($value=='very_likely'){
								$score_15b += 2;
							}
							if($value=='duplicate'){
								$score_15b +=0;
							}
						}
					}	
				}
				
				//15search
				
				$data['search_15']='';
				if(isset($_POST['search_15']) && !empty($_POST['search_15'])){
				
					$data['search_15']=$_POST['search_15'];
				}	
				
				
				if($this->session->userdata('user_type')==2){
					//15c
					$data['pdfresult']='';
					if(isset($_POST['result_15c']) && !empty($_POST['result_15c'])){
					
						$data['pdfresult']=json_encode($_POST['result_15c']);
					
					}
					
					$data['big_company_count']='';
					if(isset($_POST['big_company_count']) && !empty($_POST['big_company_count'])){
						
						if(is_numeric($_POST['big_company_count'])){
						
						$data['big_company_count']=$_POST['big_company_count'];
						}
					}
					
					$data['small_company_count']='';
					if(isset($_POST['small_company_count']) && !empty($_POST['small_company_count'])){
						if(is_numeric($_POST['small_company_count'])){
						$data['small_company_count']=$_POST['small_company_count'];
						}
					}
					$data['text_pdfsearch']='';
					if(isset($_POST['text_pdfsearch']) && !empty($_POST['text_pdfsearch'])){
					
						$data['text_pdfsearch']=$_POST['text_pdfsearch'];
					
					}
				}
				
				
				//echo $score_14b1;die("here");
				$total=0;
				$total +=$score_13_total;
				//print_pre($score_14c);die;
				$total += $score_14a;
				$total += $score_14b1 * $score_14c;
				//$total += $score_14c;
				
				$total += $score_15b ;
				//echo $total;die("here");
				$data['module4_score'] =$total;
				
				$this->user_model->update_invention($data,$_POST['invention_id']);
				
				$progress=$this->calculate_percentage($_POST['invention_id']);
				
				echo $progress;
				die();
	}
	
	function invention5(){
		$this->page_data['page_title'] = 'User | Invention' ;
		
		$id =  $this->uri->segment(3) ; 
		
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
	
	
	
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_invention5',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
		
	
	}
	
	function invention4(){
		$this->page_data['page_title'] = 'User | Invention' ;
		
		$id =  $this->uri->segment(3) ; 
		
		$user_id = $this->session->userdata('userid') ;
		if($user_id==''){
			redirect('home','refresh');
		}
	
	
	
		$this->page_data['invention_data'] = $this->user_model->get_invention_by_id($id);
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data,
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_invention4',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
		
	
	}
	
	
	
	function changepass()
	{
		if($this->session->userdata('userid')==''){
			redirect('', 'refresh');
		}
				
		$this->form_validation->set_rules('pass', 'Current Password', 'required');
		$this->form_validation->set_rules('npass', 'Confirm Password', 'trim|required|matches[cnpass]|min_length[6]|max_length[12]');
		$this->form_validation->set_rules('cnpass', 'Confirm New Password', 'required');

		if ($this->input->server('REQUEST_METHOD') === 'POST'){
			if ($this->form_validation->run() == FALSE){
				$this->page_data['edit_msg'] = '<div class="errormsg">Check the following errors: '.validation_errors().'</div>';
			}else{	
				$user_data = array();
			
				$user_data['pass'] = passhash($this->input->post('pass'));
				$user_data['npass'] = $this->input->post('npass');
				$user_data['cnpass'] = $this->input->post('cnpass');				
				$password_match=$this->user_model->check_change_password($user_data['pass']);
				if($password_match==true){
					if($user_data['npass']==$user_data['cnpass']){
						$updatepassword['password'] = passhash($user_data['npass']);
						$updated_status=$this->user_model->save_user_data($updatepassword);
						$this->page_data['edit_msg'] = '<div class="successmsg">Profile Updated Sucessfully!!!</div>';
					}else{
						$this->page_data['edit_msg'] = '<div class="errormsg">Check the following errors: '.validation_errors().'</div>';
					}
				}else{
					$this->page_data['edit_msg'] = '<div class="errormsg">Check the following errors: Please enter correct old password.</div>';
				}				
			}
		}
		
		$data['header_content'] = array(
									'load_view' 		 	 => 'header_view',
									'page_data'				 => $this->page_data
									
								);
		$data['main_content']   = array(
									'load_view' 		 	 => 'user/user_password',
									'left_column_content'	 => 'user_left_column_view',
								);
		$data['footer_content'] = array(
									'load_view' 		 	 => 'footer_view',
								);
		$this->load->view('templates/template',$data);
	}

	function deleteinvention(){
		$id =  $this->uri->segment(3) ; 
		
		$user_id = $this->session->userdata('userid') ;
		
		$check_user = $this->user_model->check_user_invention($user_id,$id);
		if($check_user){
			$this->user_model->delete_invention($id);
		}
		
		redirect('user/inventionslist');
		
	}
	
	function invention_inventor_delete(){
	
		$cur_inventor = $_POST['cur_inventor'];
		$cur_invention = $_POST['cur_invention'];
		
		$this->user_model->delete_invention_inventor_by_id($cur_invention,$cur_inventor);
		
		die('done');
	}
	
	
	function logout()
	{
	
		$userlogindata = array(
		'userid' => '',
		'email' => ''		
		);
		$this->session->unset_userdata($userlogindata);
		$this->session->sess_destroy();
		redirect(site_url('login'), 'refresh');
	}
	
	function ajaxresult_11a1(){
		
		/* print_pre($_REQUEST);
		die();  */
		$siteurl=site_url('user/invention').'/';
				
		$data=array();
		$invention_id = $_REQUEST['id'];
		$search_title = $_REQUEST['title'];
		$data['prior_inventions']='';
		$this->user_model->update_invention($data,$invention_id);
		if($search_title==''){
			die('<tr><td>No result found</td></tr>');
		}
		//uma the, and, or, for, of, to, is,on, in this, that, these, those
		$preposition_array=array('for' , 'the' , 'and' , 'to' , 'a' , 'an' , 'of' , 'is' , 'am' , 'are' , 'was' , 'has' , 'have' ,'had' , 'been' , 'by' ,'on' ,'will','shall','or','in','this','that','these','those','as');
		
		$parts=explode(' ',$search_title);
		$formated_search_title="";
		foreach($parts as $part){
			if (in_array($part, $preposition_array)) {
				
			}else{
			
				$formated_search_title .=$part;
				$formated_search_title .=' ';
			}
		}
		
		//echo $formated_search_title;die;
		$search_title=trim($formated_search_title);
		
		if($search_title==''){
			die('<tr><td>No result found</td></tr>');
		}
		//var_dump($search_title);die;
		
		$qno='11a1';
		$result = $this->user_model->search_result_11a($invention_id,$search_title,$qno);
		if($result!=false){
		//print_pre($result);die;
			$i=1;
			foreach($result as $row){
				
						$status = '';
						if($row['status']=='process'){
							$status = 'Disclosure In-Progress';
						}elseif($row['status']=='open'){
							$status = 'Disclosure In-Progress';
						}else{
							$status = 'Disclosure Done & Under Review';
						}
					
			if($i<=10){		
				echo '
				<tr>
					<td>'.$i.'</td>
					<td><a href="'.$siteurl.$row['id'].'" target="_blank">'.$row['title'].'</a></td>
					<td>'.$status.'</td>
					<td><span class="span_no"></span><input type="radio" class="radio11a1 required"
					name="result_11a1['.$i.'][radio_11a1]" value="Yes" /><span class="radio_span">Yes</span></td>
					<td><span class="span_no"></span><input type="radio" class="radio11a1 required" name="result_11a1['.$i.'][radio_11a1]" value="No" /><span class="radio_span">No</span></td>
					<td><span class="span_no"></span><input type="radio" class="radio11a1 required" name="result_11a1['.$i.'][radio_11a1]" value="May be" /><span class="radio_span">May be</span><input type="hidden" name="result_11a1['.$i.'][title]" value="'.$row['title'].'"><input type="hidden" name="result_11a1['.$i.'][id]" value="'.$row['id'].'"><input type="hidden" name="result_11a1['.$i.'][status]" value="'.$row['status'].'">
					</td>
				</tr>
				';
			}
			$i++;
			}
		}else{
			echo '<tr><td>No result found</td></tr>';
		}
	 die;
	}
	
	function ajaxresult_11a2(){
		
		/* print_pre($_REQUEST);
		die();   */
		
		$data=array();
		$siteurl=site_url('user/invention').'/';
		$invention_id = $_REQUEST['id'];
		$search_title = $_REQUEST['title'];
		$data['other_inventions']='';
		$this->user_model->update_invention($data,$invention_id);
		if($search_title==''){
			die('<tr><td>No result found</td></tr>');
		}
		
		$preposition_array=array('for' , 'the' , 'and' , 'to' , 'a' , 'an' , 'of' , 'is' , 'am' , 'are' , 'was' , 'has' , 'have' ,'had' , 'been' , 'by' ,'on' ,'will','shall','or','in','this','that','these','those','as');
		
		$parts=explode(' ',$search_title);
		$formated_search_title="";
		foreach($parts as $part){
			if (in_array($part, $preposition_array)) {
				
			}else{
			
				$formated_search_title .=$part;
				$formated_search_title .=' ';
			}
		}
		
		$search_title=trim($formated_search_title);
		
		if($search_title==''){
			die('<tr><td>No result found</td></tr>');
		}
		
		$qno='11a2';
		$result = $this->user_model->search_result_11a($invention_id,$search_title,$qno);
		if($result!=false){
		//print_pre($result);die;
			$i=1;
			foreach($result as $row){
			//print_r($result);die;
						$status = '';
						if($row['status']=='process'){
							$status = 'Disclosure In-Progress';
						}elseif($row['status']=='open'){
							$status = 'Disclosure In-Progress';
						}else{
							$status = 'Disclosure Done & Under Review';
						}
				if($i<=10){		
				echo '
				<tr>
					<td>'.$i++.'</td>
					<td><a href="'.$siteurl.$row['id'].'" target="_blank">'.$row['title'].'</a></td>
					<td>'.$status.'</td>
					<td><span class="span_no"></span><input type="radio" class="radio11a2" name="result_11a2['.$i.'][radio_11a2]" value="Yes" /><span class="radio_span">Yes</span></td>
					<td><span class="span_no"></span><input type="radio" class="radio11a2" name="result_11a2['.$i.'][radio_11a2]" value="No" /><span class="radio_span">No</span></td>
					<td><span class="span_no"></span><input type="radio" class="radio11a2" name="result_11a2['.$i.'][radio_11a2]" value="May be" /><span class="radio_span">May be</span>
					<input type="hidden" name="result_11a2['.$i.'][title]" value="'.$row['title'].'"><input type="hidden" name="result_11a2['.$i.'][id]" value="'.$row['id'].'"><input type="hidden" name="result_11a2['.$i.'][status]" value="'.$row['status'].'">
					
					</td>
				</tr>';
				
				}
			}
		}else{
			echo '<tr><td>No result found</td></tr>';
		}
	 die;
	}
	
	function date_check(){
	
		
		/* print_pre($_REQUEST);
		die; */
		$invention_data=$this->user_model->get_invention_by_id($_REQUEST['id']);
		
		$submission_date = date("Y-m-d H:i:s",strtotime($invention_data['submission_date']));
		$invention_date  = date("Y-m-d H:i:s",strtotime($_REQUEST['date']));
		$todaystart = date("Y-m-d 00:00:00");
		
		if($invention_date < $todaystart){
			if($invention_date < $submission_date){
			
				//echo 'submission_date is heigher';
				//echo 'true';
				echo 'false';
			
			}else{
				/* if($invention_date==$today){
				
				} */
				//echo 'submission_date is lesser';
				//echo 'false';
				echo 'true';
				
			}
		
	}else{
		//echo 'false';
		echo 'true';
	
	}
		
		//print_pre($invention_data['submission_date']);
		die;
	}
	
	function invention_project_delete(){
	
		$this->user_model->delete_invention_project_byid($_POST['project_id']);
		die;
	}
	
	function save_progress(){
	//function update_invention($update_data,$id){
		$data=array();
		$data['progress']=$_POST['progress1'];
		$this->user_model->update_invention($data,$_POST['id']);
		die;
	}
	
	function ajaxresult_11b2(){
		 if(!empty($_POST['title'])){
			$content='';
			$content1='';
			$content2='';
			$title=trim($_POST['title']);
			$title=str_replace(" ", "+", $title); 
			$content=file_get_contents("http://www.ncbi.nlm.nih.gov/pubmed/?term=".$title);
			$content1=file_get_contents("http://www.ncbi.nlm.nih.gov/pmc/?term=".$title);
			$content2=file_get_contents("http://www.ncbi.nlm.nih.gov/nlmcatalog/?term=".$title);
			echo $content.$content1.$content2; 
			die();
		}else{
			die("error");
		}
	}
	
	//11b1
	
		function ajaxresult_11b1(){
		 if(!empty($_POST['title'])){
			$content='';
			$content1='';
			$content2='';
			$title=trim($_POST['title']);
			$title=str_replace(" ", "+", $title); 
			$content=file_get_contents("http://patft.uspto.gov/netacgi/nph-Parser?Sect1=PTO2&Sect2=HITOFF&p=1&u=%2Fnetahtml%2FPTO%2Fsearch-bool.html&r=0&f=S&l=50&TERM1=".$title."&FIELD1=&co1=AND&TERM2=&FIELD2=&d=PTXT");
			
			//$content1=file_get_contents("http://patentscope.wipo.int/search/en/result.jsf?currentNavigationRow=1&query=".$title."&office=&sortOption=Pub%20Date%20Desc&prevFilter=&maxRec=2624&viewOption=All	");
		
			
			$content1=file_get_contents("http://www.lens.org/lens/search?q=".$title."&sat=N%2CP&so=");
			//$content2=file_get_contents("http://www.ncbi.nlm.nih.gov/nlmcatalog/?term=".$title);
			echo $content.$content1; 
			die();
		}else{
			die("error");
		}
	}
	
	//15a
	function api_search_15_old(){
	
		
		$id  		  			 = $_POST['id'];
		$searchparam  		 	 = $_POST['search'];
		$result_data  = $this->user_model->get_invention_by_id($id);
		$site_content1	=	"";
		$site_content2	=	"";
		$site_content3	=	"";
		$for_search_part=	"";
		
		if(!empty($searchparam)){
		
			if(isset($result_data['category_invention']) && !empty($result_data['category_invention'])){
			
				if($result_data['category_invention']=="gansh1"){
					if(isset($result_data['cat_invention_1']) && !empty($result_data['cat_invention_1'])){
						//6A(1)
						
						/*
						i.	If 6A(i) is chosen, search Fiercebiotech.com, FiercePharma.com. 
						1.	 If one of the words in Q6b is vaccine, then search fiercevaccine.com.
						ii.	If 6(A)(ii) is chosen, search FierceBiomarkers.com, FierceDiagnostics.com.
						iii.	If 6(A) (iii) is chosen, then search Fierceresearch.com. */

						if($result_data['cat_invention_1']=='gansh9'){
							
							
							//die("here1");
						
							$for_search_part='for_15_1';
							
							
							
						
									$searchparam = urlencode($searchparam) ; 
								//die("here3");
								$site_content1=file_get_contents("http://www.fiercebiotech.com/search/site/".$searchparam."?solrsort=ds_created%20desc&include-pr=0&site-filter=1");
								
							
							
								$site_content2=file_get_contents("http://www.fiercepharma.com/search/site/".$searchparam."?solrsort=ds_created%20desc&include-pr=0&site-filter=1");
								
								$site_content3=file_get_contents("http://www.fiercevaccines.com/search/site/".$searchparam."?solrsort=ds_created%20desc&include-pr=0&site-filter=1");
								
							
						}
							
					
						
						//6A(2)
						if($result_data['cat_invention_1']=='gansh10'){
							$searchparam = urlencode($searchparam) ; 
							$site_content1=file_get_contents("http://www.fiercebiomarkers.com/search/site/".$searchparam."?solrsort=ds_created%20desc&include-pr=0&site-filter=1");
							$site_content2=file_get_contents("http://www.fiercediagnostics.com/search/site/".$searchparam."?solrsort=ds_created%20desc&include-pr=0&site-filter=1");
							$for_search_part='for_15_2';
							
						}
						
						//6A(3)
						if($result_data['cat_invention_1']=='gansh11'){
						// die('called');
							$searchparam = urlencode($searchparam) ; 
							$site_content1 = file_get_contents("http://www.fiercebiotechresearch.com/search/site/".$searchparam."?solrsort=ds_created%20desc&include-pr=0&site-filter=1");
							$site_content2=file_get_contents("http://www.fierceresearch.com/search/site/".$searchparam."?solrsort=ds_created%20desc&include-pr=0&site-filter=1");
							$for_search_part='for_15_3';
							 
							
						}
						
						
					}
				}else{
					$for_search_part='for_nonmedical';
				}
			}
		}	
		
		$result=array('for_search_part'=>"$for_search_part",'site_content1'=>"$site_content1",'site_content2'=>"$site_content2",'site_content3'=>"$site_content3");
		
		echo json_encode($result);
		die; 
	}
	
	
	
	/*relevance search*/
	function api_search_15(){
	
		
		$id  		  			 = $_POST['id'];
		$searchparam  		 	 = $_POST['search'];
		$result_data  = $this->user_model->get_invention_by_id($id);
		$site_content1	=	"";
		$site_content2	=	"";
		$site_content3	=	"";
		$for_search_part=	"";
		
		if(!empty($searchparam)){
		
			if(isset($result_data['category_invention']) && !empty($result_data['category_invention'])){
			
				if($result_data['category_invention']=="gansh1"){
					if(isset($result_data['cat_invention_1']) && !empty($result_data['cat_invention_1'])){
						//6A(1)
						
						/*
						i.	If 6A(i) is chosen, search Fiercebiotech.com, FiercePharma.com. 
						1.	 If one of the words in Q6b is vaccine, then search fiercevaccine.com.
						ii.	If 6(A)(ii) is chosen, search FierceBiomarkers.com, FierceDiagnostics.com.
						iii.	If 6(A) (iii) is chosen, then search Fierceresearch.com. */

						if($result_data['cat_invention_1']=='gansh9'){
							
							
							//die("here1");
						
							$for_search_part='for_15_1';
							
							
							
						
									$searchparam = urlencode($searchparam) ; 
								//die("here3");
	$site_content1=file_get_contents("http://www.fiercebiotech.com/search/site/".$searchparam."?solrsort=score%20desc&include-pr=0&site-filter=1");
								
							
	$site_content2=file_get_contents("http://www.fiercepharma.com/search/site/".$searchparam."?solrsort=score%20desc&include-pr=0&site-filter=1");
								
	$site_content3=file_get_contents("http://www.fiercevaccines.com/search/site/".$searchparam."?solrsort=score%20desc&include-pr=0&site-filter=1");
								
							
						}
							
					
						
						//6A(2)
						if($result_data['cat_invention_1']=='gansh10'){
							$searchparam = urlencode($searchparam) ; 
		$site_content1=file_get_contents("http://www.fiercebiomarkers.com/search/site/".$searchparam."?solrsort=score%20desc&include-pr=0&site-filter=1");
	$site_content2=file_get_contents("http://www.fiercediagnostics.com/search/site/".$searchparam."?solrsort=score%20desc&include-pr=0&site-filter=1");
							$for_search_part='for_15_2';
							
						}
						
						//6A(3)
						if($result_data['cat_invention_1']=='gansh11'){
						// die('called');
							$searchparam = urlencode($searchparam) ; 
	$site_content1 = file_get_contents("http://www.fiercebiotechresearch.com/search/site/".$searchparam."?solrsort=score%20desc&include-pr=0&site-filter=1");
		$site_content2=file_get_contents("http://www.fierceresearch.com/search/site/".$searchparam."?solrsort=score%20desc&include-pr=0&site-filter=1");
							$for_search_part='for_15_3';
							 
							
						}
						
						
						
					}
				}else{
					$for_search_part='for_nonmedical';
				}
			}
		}	
		
		$result=array('for_search_part'=>"$for_search_part",'site_content1'=>"$site_content1",'site_content2'=>"$site_content2",'site_content3'=>"$site_content3");
		
		echo json_encode($result);
		die; 
	}
	
	
	/*relevance search*/
	
	
	/*15 a search*/
	
	
		
	function api_search_15_a(){
	
		
		$id  		  			 = $_POST['id'];
		$searchparam  		 	 = $_POST['search'];
		$result_data  = $this->user_model->get_invention_by_id($id);
		$site_content1	=	"";
		$site_content2	=	"";
		$site_content3	=	"";
		$for_search_part=	"";
		
		if(!empty($searchparam)){
		
			if(isset($result_data['category_invention']) && !empty($result_data['category_invention'])){
			
				
				
					
							$for_search_part='for_15_1';
			
									$searchparam = urlencode($searchparam) ; 
								//die("here3");
						//$site_content1=file_get_contents("http://seekingalpha.com/search/articles/?q=".$searchparam."&cx=018269914407235029540%3Acdhc2yeo2ko&cof=FORID%3A11%3BNB%3A1&as_sitesearch=http://seekingalpha.com/article");
	$site_content1=file_get_contents("http://seekingalpha.com/search/?source=search_general&q=".$searchparam."&cx=018269914407235029540%3Acdhc2yeo2ko&cof=FORID%3A11%3BNB%3A1&goto_search_tab=");
	//http://seekingalpha.com/search/?source=search_general&q=nanotech&cx=018269914407235029540%3Acdhc2yeo2ko&cof=FORID%3A11%3BNB%3A1&goto_search_tab=
								
								//$site_content1=file_get_contents("http://www.fiercebiotechresearch.com/search/site/".$searchparam."?solrsort=score%20desc&include-pr=0&site-filter=1");
								
								
							


	
				
			}
		}	
		
		$result=array('for_search_part'=>"$for_search_part",'site_content1'=>"$site_content1");
		
		echo json_encode($result);
		die; 
	}

	
	/*15 a search*/
	
	
	/*
	 calculate percentage
	*/
	
	function calculate_percentage($invention_id){
	
		$invantion_data=$this->user_model->get_invention_by_id($invention_id);
		$invention_inventor = $this->user_model->get_invention_inventor($invention_id);
		$inv_project= $this->user_model->fetch_invention_project($invention_id);
		/* print_pre($inv_project);
		die("here"); 
		 */
		$title 					= !empty($invantion_data['title']) ? $invantion_data['title'] : ''; 
		$invention_type 		= !empty($invantion_data['invention_type']) ? $invantion_data['invention_type']: '' ; 
		$invention_type_other 	= !empty($invantion_data['invention_type_other'])? $invantion_data['invention_type_other'] :''; 
		$category_invention 	= !empty($invantion_data['category_invention']) ? $invantion_data['category_invention'] :'' ; 
		$cat_invention_1 		= !empty($invantion_data['cat_invention_1']) ? $invantion_data['cat_invention_1'] : '' ; 
		$cat_invention_2 		= !empty($invantion_data['cat_invention_2']) ? $invantion_data['cat_invention_2'] : '';  
		$name_drug 				= !empty($invantion_data['name_drug']) ? $invantion_data['name_drug'] : ''; 
		$cat_invention_3 		= !empty($invantion_data['cat_invention_3']) ? $invantion_data['cat_invention_3'] :"" ; 
		$impect_areas 			= !empty($invantion_data['impect_areas']) ? $invantion_data['impect_areas'] : "" ; 
		$stage_of_devolpment 	= !empty($invantion_data['stage_of_devolpment']) ? $invantion_data['stage_of_devolpment'] :"" ; 
		$stage_of_devolpment_1 	= !empty($invantion_data['stage_of_devolpment_1'])? $invantion_data['stage_of_devolpment_1']:"" ; 
		$abstract_invantion 	= !empty($invantion_data['abstract_invantion'])? $invantion_data['abstract_invantion'] :"" ; 
		if(!empty($invantion_data['funding_source'])){
			$funding_source 		= explode(",",$invantion_data['funding_source']) ;
		}		
		$funding_source_other 	= !empty($invantion_data['funding_source_other']) ? $invantion_data['funding_source_other'] : "" ; 
		$principal_investigator = !empty( $invantion_data['principal_investigator']) ?$invantion_data['principal_investigator'] :"" ;
		if(!empty($invantion_data['entitiy_name'])){
			$entitiy_name 		= explode(",",$invantion_data['entitiy_name']) ; 
		}
		$agrement_number 		= !empty($invantion_data['agrement_number']) ? $invantion_data['agrement_number'] :"" ; 
		$amount_of_funding 		= !empty($invantion_data['amount_of_funding']) ? $invantion_data['amount_of_funding'] : ""; 
			
		$institutional_title=!empty($invantion_data['institutional_title']) ? $invantion_data['institutional_title'] : "";
		$type = !empty($invantion_data['type']) ? $invantion_data['type'] : "";
		$abstract_of_invention =!empty($invantion_data['abstract_of_invention']) ? $invantion_data['abstract_of_invention']  : "" ; 
		$grant_documents =!empty($invantion_data['grant_documents']) ? $invantion_data['grant_documents'] : "" ; 
		$invention_attachments =!empty($invantion_data['invention_attachments']) ? $invantion_data['invention_attachments'] : "" ; 
		$status =!empty($invantion_data['status']) ? $invantion_data['status'] : "" ; 
		$already_invention =!empty($invantion_data['already_invention']) ? $invantion_data['already_invention'] : "";
		$already_invention_date =!empty($invantion_data['already_invention_date']) ? $invantion_data['already_invention_date'] : "";
		$upcoming_invention =!empty($invantion_data['upcoming_invention']) ? $invantion_data['upcoming_invention'] : "";
		$upcoming_invention_date =!empty($invantion_data['upcoming_invention_date']) ? $invantion_data['upcoming_invention_date'] : "";
		$submitted_invention =!empty($invantion_data['submitted_invention']) ? $invantion_data['submitted_invention'] : "";
		$submitted_invention_date =!empty($invantion_data['submitted_invention_date']) ? $invantion_data['submitted_invention_date'] : "";
		$plan_invention =!empty($invantion_data['plan_invention']) ? $invantion_data['plan_invention'] : "";
		
		$input_key_invention =!empty($invantion_data['input_key_invention']) ? $invantion_data['input_key_invention'] : "" ; 
		$prior_inventions =!empty($invantion_data['prior_inventions']) ? $invantion_data['prior_inventions'] : "" ; 
		$other_inventions =!empty($invantion_data['other_inventions']) ? $invantion_data['other_inventions'] : "" ; 
		$have_worked =!empty($invantion_data['have_worked']) ? $invantion_data['have_worked']  : "" ; 
		$estimated_size =!empty($invantion_data['estimated_size']) ? $invantion_data['estimated_size'] : "" ; 
		$products_exist =!empty($invantion_data['products_exist']) ? $invantion_data['products_exist'] : "" ; 
		$product_count =!empty($invantion_data['product_count']) ? $invantion_data['product_count'] : "" ; 
		$products_count =!empty($invantion_data['products_count']) ? $invantion_data['products_count'] : "" ; 
		$products_name =!empty($invantion_data['products_name']) ? $invantion_data['products_name'] : "" ; 
		$limitations =!empty($invantion_data['limitations']) ? $invantion_data['limitations'] : "" ; 
		$distinct_aspects1 =!empty($invantion_data['distinct_aspects1']) ? $invantion_data['distinct_aspects1'] : "" ; 
		$distinct_aspects2 =!empty($invantion_data['distinct_aspects2']) ? $invantion_data['distinct_aspects2'] : "" ; 
		$distinct_aspects3 =!empty($invantion_data['distinct_aspects3']) ? $invantion_data['distinct_aspects3'] : "" ; 
		$search_15 =!empty($invantion_data['search_15']) ? $invantion_data['search_15'] : "" ; 
		
		
   
		
		$progressdata=array();	
		$progress=  0 ;
		
		if($title!=''){
			$progress += 7; 
		}
		if($invention_type!=''){
			/* if($invention_type=='other' && $invention_type_other!=''){
				$progress += 7; 
			}else{
				$progress += 7; 
			} */
			
			$progress += 7; 
		}
		
		if($category_invention!='' && $cat_invention_1!='' && $cat_invention_2!='' && $impect_areas!=''){
			
			$progress += 7; 
		} 
		/* if($category_invention!='' && $cat_invention_1!='' && $impect_areas!=''){
			if($category_invention=='gansh1'){
				if($cat_invention_1!='' && $cat_invention_2!='' ){
					if($cat_invention_2=='gansh10_4' && $cat_invention_3!=''){
						$progress += 7; 
					}else{
						$progress += 7; 
					}
				}
			}else{
				if($cat_invention_1!=''){
					$progress += 7; 
				}
			
			}
		} */
			
		/* if($category_invention=='gansh1'){
			if($cat_invention_2=='gansh9'){
				if($stage_of_devolpment!=''){
					if($stage_of_devolpment=='e' && $stage_of_devolpment_1!=''){
						$progress += 7; 
					}else{
						$progress += 7; 
					}
				}
			}else{
				if($stage_of_devolpment!=''){
					$progress += 7; 
				}
				
			}
		} */
		if($stage_of_devolpment!=''){
					$progress += 7; 
		}
		
		if($abstract_invantion!=''){
			$progress += 7; 
		}
		
		if(!empty($funding_source) && $principal_investigator!=''){
			$progress += 7; 
		}
		/* if($principal_investigator!=''){
			$progress += 8; 
		}
		if(!empty($entitiy_name)){
			$progress += 8; 
		}
		if($agrement_number!=''){
			$progress += 8; 
		}
		if($amount_of_funding!=''){
			$progress += 8; 
		} */
			
		
		if($already_invention!='' && $upcoming_invention!=''){
			$progress += 7; 
		}
		
		if($input_key_invention!=''){
			$progress += 7; 
		}
		
		if($distinct_aspects1!='' && $distinct_aspects2!='' && $distinct_aspects3!=''){
			$progress += 7; 
		} 
		
		if($estimated_size!='' && $limitations!="" && $products_exist!=''){
			$progress += 7; 
		} 
		
		if($search_15!=''){
			$progress += 7; 
		} 
		
		if(!empty($inv_project)){
			$progress += 7; 
		} 

		if(!empty($invention_inventor)){ 

			//print_pre($invention_inventor);die;		
			$filed_child = 0; 
			$total_child = 0; 
			foreach($invention_inventor as $inventor_data){
				if($inventor_data['investigator_name']!=='' && $inventor_data['institutional']!=='' && $inventor_data['home_address']!=='' && $inventor_data['citizen_ship']!=='' && $inventor_data['phone_number']!=='' && $inventor_data['email']!==''){
						$filed_child++;
					}
					$total_child++;
				
			}
		
		if($filed_child==$total_child){
			$progress += 16;
		}
		}
			$progressdata['progress']=$progress;
			$this->user_model->update_invention($progressdata,$invention_id);	
			return $progress;
			//die();
	}
	
	/*
	check filled question
	*/
	
	function check_validation($invention_id){
		
		
		//echo $invention_id;
		//die();
		$invantion_data=$this->user_model->get_invention_by_id($invention_id);
		$invention_inventor = $this->user_model->get_invention_inventor($invention_id);
		$inv_project= $this->user_model->fetch_invention_project($invention_id);
		/* print_pre($invantion_data);
		die("here"); */ 
		
		$title 					= !empty($invantion_data['title']) ? $invantion_data['title'] : ''; 
		$invention_type 		= !empty($invantion_data['invention_type']) ? $invantion_data['invention_type']: '' ; 
		$invention_type_other 	= !empty($invantion_data['invention_type_other'])? $invantion_data['invention_type_other'] :''; 
		$category_invention 	= !empty($invantion_data['category_invention']) ? $invantion_data['category_invention'] :'' ; 
		$cat_invention_1 		= !empty($invantion_data['cat_invention_1']) ? $invantion_data['cat_invention_1'] : '' ; 
		$cat_invention_2 		= !empty($invantion_data['cat_invention_2']) ? $invantion_data['cat_invention_2'] : '';  
		$name_drug 				= !empty($invantion_data['name_drug']) ? $invantion_data['name_drug'] : ''; 
		$cat_invention_3 		= !empty($invantion_data['cat_invention_3']) ? $invantion_data['cat_invention_3'] :"" ; 
		$impect_areas 			= !empty($invantion_data['impect_areas']) ? $invantion_data['impect_areas'] : "" ; 
		$stage_of_devolpment 	= !empty($invantion_data['stage_of_devolpment']) ? $invantion_data['stage_of_devolpment'] :"" ; 
		$stage_of_devolpment_1 	= !empty($invantion_data['stage_of_devolpment_1'])? $invantion_data['stage_of_devolpment_1']:"" ; 
		$abstract_invantion 	= !empty($invantion_data['abstract_invantion'])? $invantion_data['abstract_invantion'] :"" ; 
		if(!empty($invantion_data['funding_source'])){
			$funding_source 		= explode(",",$invantion_data['funding_source']) ;
		}		
		$funding_source_other 	= !empty($invantion_data['funding_source_other']) ? $invantion_data['funding_source_other'] : "" ; 
		$principal_investigator = !empty( $invantion_data['principal_investigator']) ?$invantion_data['principal_investigator'] :"" ;
		if(!empty($invantion_data['entitiy_name'])){
			$entitiy_name 		= explode(",",$invantion_data['entitiy_name']) ; 
		}
		$agrement_number 		= !empty($invantion_data['agrement_number']) ? $invantion_data['agrement_number'] :"" ; 
		$amount_of_funding 		= !empty($invantion_data['amount_of_funding']) ? $invantion_data['amount_of_funding'] : ""; 
			
		$institutional_title=!empty($invantion_data['institutional_title']) ? $invantion_data['institutional_title'] : "";
		$type = !empty($invantion_data['type']) ? $invantion_data['type'] : "";
		$abstract_of_invention =!empty($invantion_data['abstract_of_invention']) ? $invantion_data['abstract_of_invention']  : "" ; 
		$grant_documents =!empty($invantion_data['grant_documents']) ? $invantion_data['grant_documents'] : "" ; 
		$invention_attachments =!empty($invantion_data['invention_attachments']) ? $invantion_data['invention_attachments'] : "" ; 
		$status =!empty($invantion_data['status']) ? $invantion_data['status'] : "" ; 
		$already_invention =!empty($invantion_data['already_invention']) ? $invantion_data['already_invention'] : "";
		$already_invention_date =!empty($invantion_data['already_invention_date']) ? $invantion_data['already_invention_date'] : "";
		$upcoming_invention =!empty($invantion_data['upcoming_invention']) ? $invantion_data['upcoming_invention'] : "";
		$upcoming_invention_date =!empty($invantion_data['upcoming_invention_date']) ? $invantion_data['upcoming_invention_date'] : "";
		$submitted_invention =!empty($invantion_data['submitted_invention']) ? $invantion_data['submitted_invention'] : "";
		$submitted_invention_date =!empty($invantion_data['submitted_invention_date']) ? $invantion_data['submitted_invention_date'] : "";
		$plan_invention =!empty($invantion_data['plan_invention']) ? $invantion_data['plan_invention'] : "";
		
		$input_key_invention =!empty($invantion_data['input_key_invention']) ? $invantion_data['input_key_invention'] : "" ; 
		$prior_inventions =!empty($invantion_data['prior_inventions']) ? $invantion_data['prior_inventions'] : "" ; 
		$other_inventions =!empty($invantion_data['other_inventions']) ? $invantion_data['other_inventions'] : "" ; 
		$estimated_size =!empty($invantion_data['estimated_size']) ? $invantion_data['estimated_size'] : "" ; 
		$products_exist =!empty($invantion_data['products_exist']) ? $invantion_data['products_exist'] : "" ; 
		$product_count =!empty($invantion_data['product_count']) ? $invantion_data['product_count'] : "" ; 
		$products_count =!empty($invantion_data['products_count']) ? $invantion_data['products_count'] : "" ; 
		$products_name =!empty($invantion_data['products_name']) ? $invantion_data['products_name'] : "" ; 
		$limitations =!empty($invantion_data['limitations']) ? $invantion_data['limitations'] : "" ; 
		$distinct_aspects1 =!empty($invantion_data['distinct_aspects1']) ? $invantion_data['distinct_aspects1'] : "" ; 
		$distinct_aspects2 =!empty($invantion_data['distinct_aspects2']) ? $invantion_data['distinct_aspects2'] : "" ; 
		$distinct_aspects3 =!empty($invantion_data['distinct_aspects3']) ? $invantion_data['distinct_aspects3'] : "" ; 
		$search_15 =!empty($invantion_data['search_15']) ? $invantion_data['search_15'] : "" ; 
		$result_11b =!empty($invantion_data['result_11b']) ? $invantion_data['result_11b'] : "" ; 
		$result_11b2 =!empty($invantion_data['result_11b2']) ? $invantion_data['result_11b2'] : "" ; 
		$result_15	 =!empty($invantion_data['result_15']) ? $invantion_data['result_15'] : "" ; 
		$result_15b 	=!empty($invantion_data['result_15b']) ? $invantion_data['result_15b'] : "" ; 
		
		
   
		
		$incomplete=array();	
		$progress=  0 ;
			
		if($title==''){
			$incomplete[] = 4 ; 
		}
		
		if($invention_type==''){
			/* if($invention_type=='other' && $invention_type_other==''){
				$incomplete[] = 5 ; 
			}else{
				$incomplete[] = 5 ; 
			} */
			
			$incomplete[] = 5 ; 
		}
		
		
		if($category_invention=='' || $cat_invention_1=='' || $cat_invention_2=='' || $impect_areas==''){
			$incomplete[] = 6 ; 
		}
		
		if($stage_of_devolpment==''){
			$incomplete[] = 7 ; 
		}
		
		if($abstract_invantion==''){
			$incomplete[] = 8 ; 
		}
		
		if(empty($funding_source) && $principal_investigator==''){
			$incomplete[] = 9 ; 
		}
		
		if($already_invention =='' && $upcoming_invention==''){
			$incomplete[] = 10 ; 
		}
		
		if($input_key_invention==''){
			$incomplete[] = 11; 
		}
		

		if($prior_inventions!=''){
		 
			$prior_inventions=json_decode($prior_inventions,true);
			$result='';			
			foreach($prior_inventions as $row){
				$radio_11a1 =(isset($row['radio_11a1']) && !empty($row['radio_11a1'])) ? $row['radio_11a1'] :"";
				if($radio_11a1==''){
					$result='empty';
				}
			}
			if($result=='empty'){
			$incomplete[] = '11A1';
			}
		}
		
		if($this->session->userdata('user_type')==2){
			if($other_inventions!=''){
				$other_inventions=json_decode($other_inventions,true);
				$result_other='';			
				foreach($other_inventions as $other_row){
					
					$radio_11a2 =(isset($other_row['radio_11a2']) && !empty($other_row['radio_11a2'])) ? $other_row['radio_11a2'] :"";
					
					if($radio_11a2==''){
						$result_other='empty';
					}
					
				}
				if($result_other=='empty'){
				$incomplete[] = '11A2';
				}
			}
		}
		//print_pre($incomplete);die("here");
		
	
	if($result_11b!=''){
		$result_11b=json_decode($result_11b,true);
		$radio_result_11b='';
		foreach($result_11b as $result_11b_row){
		
			$radio_11b =(isset($result_11b_row['radio_11b']) && !empty($result_11b_row['radio_11b'])) ? $result_11b_row['radio_11b'] : '';
			
			if($radio_11b==''){
				$radio_result_11b='empty';
			}
					
		}
		if($radio_result_11b=='empty'){
			$incomplete[] = '11B1';
		}	
	} 
	if($result_15b!=''){
		$result_15b=json_decode($result_15b,true);
		
		$radio_result_15b='';
		foreach($result_15b as $result_15b_row){
		
			$radio_15b =(isset($result_15b_row['radio_15b']) && !empty($result_15b_row['radio_15b'])) ? $result_15b_row['radio_15b'] : '';
			
			if($radio_15b==''){
				$radio_result_15b='empty';
			}
					
		}
		if($radio_result_15b=='empty'){
			$incomplete[] = '15a';
		}	
	} 
	
	if($result_15!=''){
		$result_15=json_decode($result_15,true);
		$radio_result_15='';
		foreach($result_15 as $result_15_row){
		
			$radio_15 =(isset($result_15_row['radio_15']) && !empty($result_15_row['radio_15'])) ? $result_15_row['radio_15'] : '';
			
			if($radio_15==''){
				$radio_result_15='empty';
			}
					
		}
		if($radio_result_15=='empty'){
			$incomplete[] = '15b';
		}	
	} 
		
		
		
		if($distinct_aspects1=='' && $distinct_aspects2=='' && $distinct_aspects3==''){
			$incomplete[] = 12; 
		} 
		
		if(empty($inv_project)){
			$incomplete[] = 13; 
		} 
		
		if($estimated_size=='' && $limitations=="" && $products_exist==''){
			$incomplete[] = 14; 
		} 
		
		if($search_15==''){
			$incomplete[] = 15; 
		} 
		
		if($result_11b2!=''){
		$result_11b2=json_decode($result_11b2,true);
		$radio_result_11b2='';
		foreach($result_11b2 as $result_11b2_row){
		
			$radio_11b2 =(isset($result_11b2_row['radio_11b2']) && !empty($result_11b2_row['radio_11b2'])) ? $result_11b2_row['radio_11b2'] : '';
			
			if($radio_11b2==''){
				$radio_result_11b2='empty';
			}
					
		}
		if($radio_result_11b2=='empty'){
			$incomplete[] = '11B2';
		}	
	} 
		
		if(!empty($invention_inventor)){ 

			$notfilled=''; 
			foreach($invention_inventor as $inventor_data){
				if($inventor_data['investigator_name']=='' || $inventor_data['institutional']=='' || $inventor_data['home_address']=='' || $inventor_data['citizen_ship']=='' || $inventor_data['phone_number']=='' || $inventor_data['email']==''){
						$notfilled="true";
					}
			}
		
			if($notfilled=="true"){
				$incomplete[] = 3; 
			}
		}
			
		return $incomplete;
	}

	
	function check_access_param($invention_id){
	
		//die($invention_id);
		
		$userid=$this->session->userdata('userid');
		
		if($this->session->userdata('user_type')==2){
			
		
			if($userid==23 || $userid==24){
			
				//$id=array(1,2,13,14,15,16,17,18,19,20,21,22,33,35);
				//$id=array(1,2,13,17,33,35);
				 $id=array(1,2,13,14,15,16,17,18,19,20,21,22,33,35);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}
			/*
			elseif($userid==25 || $userid==26){
				
				$id=array(1,2);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}elseif($userid==27){
					
				$id=array(1,2,13,22);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}elseif($userid==28){
				
				$id=array(1,2,13);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}elseif($userid==29){
				
				$id=array(19);
				$user_inventions = $this->user_model->get_all_inventions($id);
				
			}elseif($userid==30){
				
				$id=array(18);
				$user_inventions = $this->user_model->get_all_inventions($id);
		
			}
			*/
			elseif($userid==31){
				
				$id=array(13);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}
			/*
			elseif($userid==32){
				
				$id=array(21);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}
			*/
			elseif($userid==34){
			
				$id=array(33);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}elseif($userid==36){
			
				$id=array(35);
				$user_inventions = $this->user_model->get_all_inventions($id);
			
			}else{
			
				redirect('user/home','refresh');
			}
			
			$user_inventions = $this->user_model->get_all_inventions($id);
			
			
		}else{
			$user_inventions = $this->user_model->get_user_inventions($userid);
			
		}
		//print_pre($user_inventions);die;
		$inv_array=array();
		if(!empty($user_inventions)){
			foreach($user_inventions as $user_invention){
				$inv_array[]=$user_invention['id'];
			}
		}
		//print_pre($inv_array);die;
		if(in_array($invention_id,$inv_array)){
			return true;
		}else{
			return false;
		}	
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */
