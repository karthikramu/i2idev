<script  type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/thickbox-compressed.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.autocomplete.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.validation.js'></script>
<link rel="stylesheet" type="text/css" href="<?php echo return_theme_path(); ?>css/jquery.autocomplete.css" />

<link rel="stylesheet" type="text/css" href="<?php echo return_theme_path(); ?>css/thickbox.css" />
<script>
$(function() {

	$(".close_child").live('click',function(){ 
		var cur_inventor = 	$(this).parent().children('.id_div').children('.inventor_id').val();
		var cur_invention = 	<?php echo  $page_data['next_invention'];  ?>;
			if(cur_inventor!=''){
				$.ajax({
					url: "<?php echo site_url('user/home/invention_inventor_delete');?>",
					data: 'cur_inventor='+cur_inventor+'&cur_invention='+cur_invention,
					type: "POST",
					success: function(response) {
						
					}
				}); 
			}
			
			$(this).parent().remove();
		
	});

	$("#institutional").live('click',function(){ 
		var cur_sel = $(this);
			autosave(cur_sel);
			check_progress();
	});

	$("#home_address").live('blur',function(){ 
		var cur_sel = $(this);
			autosave(cur_sel);
			check_progress();
	});

	$("#citizenship").live('blur',function(){ 
		var cur_sel = $(this);
			autosave(cur_sel);
			check_progress();
	});
	$("#mobile").live('blur',function(){ 
		var cur_sel = $(this);
			autosave(cur_sel);
			check_progress();
	});
	$("#email").live('blur',function(){ 
		var cur_sel = $(this);
			autosave(cur_sel);
		check_progress();
	});

	
	
	//$("#question_form").validate();
	autofillcode();
	/* 
		$("#institutional").live('click',function(){
			var cur_sel = $(this).val() ; 
		
			if($(this).val()=='other'){
				$(".institutional_other_span").hide();
				$(".institutional_other").show();
				$(".institutional_other").addClass('required');
			}else{
				$(".institutional_other").hide();
				$(".institutional_other_span").show();
				$(".institutional_other").removeClass('required');
			}
		
		}); */
	
	
		
		$("#inventor_name").live('blur',function(){
			var cur_sel = $(this);
			var username = $(this).val();
			$.ajax({
					url: "<?php echo site_url('user/home/get_user_detail');?>",
					data: 'username='+username,
					type: "POST",
					success: function(response) {
						var user_data =  JSON.parse(response);
						if(user_data.new_user==0){
							var home_address = user_data.home_address;
							var citizen_ship = user_data.citizen_ship;
							var phone_number = user_data.phone_number;
							var email = user_data.email;
							var user_invention = user_data.user_invention;
							var id = user_data.id;
							
						
						}else{
							var home_address = '';
							var citizen_ship = '';
							var phone_number = '';
							var email = '';
							var user_invention = '';
							var id = '';
						}
						
						
	//alert(user_invention);				
						cur_sel.parent().parent().children('.home_address_p').children('.home_address').val(home_address);
						cur_sel.parent().parent().children('.citizenship_p').children('.citizenship').val(citizen_ship);
						cur_sel.parent().parent().children('.mobile_p').children('.mobile').val(phone_number);
						cur_sel.parent().parent().children('.email_p').children('.email').val(email);
						cur_sel.parent().parent().children('.number_invention_p').children('.number_invention').val(user_invention);
						cur_sel.parent().children('.inventor_id').val(id);
					}
				}); 
				
				
		//	autosave(cur_sel);
			check_progress();
		
		});
	
		$("#add_more_inventors").click(function(){ 
	
		$("#institutional").live('click',function(){ 
			//check_progress();
		
		});
		
	
		var sub_count = 1 ;
		$("#parent-filds").children('.subchild').each(function(){
			sub_count++;
		
		});
		
		$("#parent-filds").children('#add_more').before('<div class="subchild"><a href="javascript:void(0)" class="close_child">X</a><div class="form_items id_div"><label>3(i)('+sub_count+'). Inventor Name : </label><input type="text" class="inventor_name required" id="inventor_name" name="inventor['+sub_count+'][inventor_name]" /><input type="hidden" class="inventor_id" id="inventor_id" name="inventor['+sub_count+'][inventor_id]" /></div>	<div class="form_items"><label>a. Institutional Title :</label>		<input type="radio" class="required" id="institutional" name="inventor['+sub_count+'][institutional]" value="Gansh1" /><span class="radio_span">Chief or Head of Department </span><input type="radio" class="required" id="institutional" name="inventor['+sub_count+'][institutional]" value="Gansh2" /><span class="radio_span">Professor</span>	<input type="radio" class="required" id="institutional" name="inventor['+sub_count+'][institutional]" value="Gansh3" /><span class="radio_span">Associate Professor</span><input type="radio" class="required" id="institutional" name="inventor['+sub_count+'][institutional]" value="Gansh4" /><span class="radio_span">Assistant Professor</span></div><div class="form_items">	<label>&nbsp;</label>	<input type="radio" class="required" id="institutional" name="inventor['+sub_count+'][institutional]" value="Gansh5" /><span class="radio_span">Post-doc</span>	<input type="radio" class="required" id="institutional" name="inventor['+sub_count+'][institutional]" value="Gansh6" /><span class="radio_span">Graduate student</span>	<input type="radio" class="required" id="institutional" name="inventor['+sub_count+'][institutional]" value="Gansh7" /><span class="radio_span">Under-Graduate</span></div>	<div class="form_items home_address_p"><label>b.	Home Address  :</label><input type="text" id="home_address" class="home_address required" name="inventor['+sub_count+'][home_address]" /></div>	<div class="form_items citizenship_p "><label>c.	Citizenship  :</label><input type="text" id="citizenship" class="citizenship required" name="inventor['+sub_count+'][citizenship]" /></div><div class="form_items mobile_p">	<label>d.	Mobile   :</label><input type="text" id="mobile" class="mobile required" name="inventor['+sub_count+'][mobile]" /></div>	<div class="form_items email_p"><label>e.  E-mail: </label><input type="text" id="email" class="email required"	name="inventor['+sub_count+'][email]" /></div><div class="form_items number_invention_p"><label>3(ii) Number of inventions naming this inventor : </label><input type="text" id="number_invention" class="number_invention" style="background-color:#C9C9C9" name="inventor['+sub_count+'][number_invention]" readonly="readonly" /></div></div>');
		
		autofillcode();
	});
	
	
	
	function autofillcode(){
		var emails = <?php echo $page_data['users_name']; ?>;
	
		$( ".inventor_name" ).autocomplete(emails,{
			minChars: 0,
			width: 310,
			matchContains: "word",
			autoFill: true,
			mustMatch:false,
			formatItem: function(row, i, max) {
			
				return  row.to ;
			},
			formatMatch: function(row, i, max) {
				return  row.to;
			},
			formatResult: function(row) {
			
				return row.to;
			},
			select: function (event, ui) {
				AutoCompleteSelectHandler(event, ui)
			}
		});
		
		
		
		/* 
	
		$('.inventor_name').result(function (event, data, formatted) {
			
			inventor_id
		
		
			$.ajax({
					url: "<?php echo site_url('user/home/get_user_detail');?>",
					data: 'user_id='+data.name,
					type: "POST",
					success: function(response) {
						var user_data =  JSON.parse(response);
						alert($(this).html());
				$(this).parent().parent().children('.home_address_p').children('.home_address').val(user_data.home_address);
				$(this).parent().parent().children('.citizenship_p').children('.citizenship').val(user_data.citizen_ship);
				$(this).parent().parent().children('.mobile_p').children('.mobile').val(user_data.phone_number);
				$(this).parent().parent().children('.email_p').children('.email').val(user_data.email);
						
					}
				}); 
		});  */
		
	
	}
	
	 function autosave(cur_sel){
		var form1 = $("#question_form").serialize();
			$.ajax({
				url: "<?php echo site_url('user/home/form1_save');?>",
				data: form1,
				type: "POST",
				success: function(response) {
					cur_sel.parent().parent().children('.id_div').children('.inventor_id').val(response);
				}
			}); 
	 }
	
	
	
	
	function check_progress(){
	
	
		var total_child = 0 ; 
				var total_fill = 0 ; 
				$("#parent-filds .subchild").each(function(){
						var name_title = $(this).children('.form_items').children("#inventor_name").val();
						var institutional = '';
						
						if($(this).children('.form_items').children("#institutional").is(':checked')){
							var institutional = 1; 
						}	
					
						var home_address = $(this).children('.form_items').children("#home_address").val();
						var citizenship = $(this).children('.form_items').children("#citizenship").val();
						var mobile = $(this).children('.form_items').children("#mobile").val();
						var email = $(this).children('.form_items').children("#email").val();
						
						
						if(name_title!='' && institutional!='' && home_address!='' && citizenship!='' && mobile!='' && email!=''){
							total_fill++;
						
						}
						
						total_child++;
						
				});

				
				if(total_child==total_fill){
					$(".progress").html('16% COMPLETE');
					/* var id=;
					var progress=8;
					$.ajax({
						url: "<?php echo site_url('user/home/save_progress');?>",
						data: {id = id, progress:progress},
						type: "POST",
						success: function(response) {
						//cur_sel.parent().parent().children('.id_div').children('.inventor_id').val(response);
						alert(response);
					}
					});  */
				}
	
	}
	
	
	
/* 	function AutoCompleteSelectHandler(event, ui)
	{               
		var selectedObj = ui.item;              
		alert(selectedObj.value);
	}
	 */
	
});

function check_form(){
	 
		var total_fill = 0 ; 
		$("#parent-filds .subchild").each(function(){
				var name_title = $(this).children('.form_items').children("#inventor_name").val();
				var institutional = '';
				
				if($(this).children('.form_items').children("#institutional").is(':checked')){
					var institutional = 1; 
				}	
			
				if(name_title!='' && institutional!=''){
					total_fill++;
				}
			
		});

		if(total_fill > 0){
		
			return true;
		}else{
			
				alert('Please enter atleast one Inventor Name and Institutional Title.');
			return false;
		}

}

function commercialization(page){
	
	$('#link_redir_page').val(page);
	$('#done').trigger('click');
	
}
	

</script>		
<div class="wrapper"> 
	<div class="form_container">
	<!-- <div class="steps_container">
    	<ul>
        	<li><a href="<?php echo site_url('user/invention'); ?>/<?php echo  $page_data['next_invention'];  ?>"  class="active">INVENTOR INFORMATION </a></li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row"><a href="<?php echo site_url('user/invention1'); ?>/<?php echo  $page_data['next_invention'];  ?>">TECHNOLOGY</a></li>
            <li class="strip"> &nbsp;</li>
            <li><a href="<?php echo site_url('user/invention2'); ?>/<?php echo  $page_data['next_invention'];  ?>">INTELLECTUAL PROPERTY</a></li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row"><a href="<?php echo site_url('user/invention3'); ?>/<?php echo  $page_data['next_invention'];  ?>">COMMERCIALIZATION</a></li>
           <li class="strip"> &nbsp;</li>
            <li class="single-row"><a href="<?php echo site_url('user/score'); ?>/<?php echo  $page_data['next_invention'];  ?>">SCORING</a></li>
			
        </ul>
    </div> -->
	
	<div class="steps_container">
		<b style="font-size:17px;">Invention No:
		<?php 
			echo $page_data['invention_data']['id'];
			if($page_data['invention_data']['title']!=""){ echo ' ( '.ucwords($page_data['invention_data']['title']).' )'; }else{
				echo ' ( N/A )';
			}
		?>
		</b>
    	<ul>
			<li>
			<a href="javascript:void(0)" class="active" onclick="commercialization('ii')">INVENTOR INFORMATION</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('tech')">TECHNOLOGY</a>
			</li>
            <li class="strip"> &nbsp;</li>
			<li>
			<a href="javascript:void(0)" onclick="commercialization('ip')">INTELLECTUAL PROPERTY</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)"  onclick="commercialization('com')">COMMERCIALIZATION</a>
			</li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" <?php if($this->session->userdata('user_type')==2){ ?> onclick="commercialization('score')" <?php  } ?> >ANALYTICS</a>
			</li>
			<?php } ?>
		</ul>
    </div>
	<!--
		<div>
			<span class="next">
			<a href="javascript:void(0)" onclick="commercialization('tech')">&gt;&gt;</a>
			</span>
		</div>
	-->
    		<form action="<?php echo site_url('user/invention').'/'.$page_data['next_invention']; ?>" onsubmit="return check_form(); " name="buy_name" id="question_form" class="question-form" method="post">
				
        	<div class="form_items">
            	<label>1. Invention Number : </label>
                <input type="text" name="invention_number" value="<?php echo $page_data['next_invention']; ?>" readonly="readonly"/>
            </div>
			<?php //print_pre($page_data);die;?>
            <div class="form_items">
            	<label>2. Date of Submission: </label>
                <input type="text" name="date_of_submission"  value="<?php echo date("M d, Y g:i A",strtotime($page_data['invention_data']['submission_date'])); ?>" readonly="readonly" />
            </div>
			
			<div id="parent-filds">
			
			
           <?php
			$progress = 0; 
			if($page_data['new_invention']==1 && !empty($page_data['invention_inventor'])){
				
				// print_pre($page_data['invention_inventor']);
				// die;
				
				$filed_child = 0; 
				$total_child = 0; 
				$i = 0 ; 
				
				
				
				foreach($page_data['invention_inventor'] as $inventor_data){
					
					if($inventor_data['investigator_name']!=='' && $inventor_data['institutional']!=='' && $inventor_data['home_address']!=='' && $inventor_data['citizen_ship']!=='' && $inventor_data['phone_number']!=='' && $inventor_data['email']!==''){
						$filed_child++;
					}
					$total_child++;
				
					?>
				<div class="subchild">
				<a href="javascript:void(0)" class="close_child">X</a>
				
				<div class="form_items id_div">
					<label>3(i). Inventor Name : </label>
					<input type="text" class="inventor_name required" id="inventor_name" name="inventor[<?php echo $i; ?>][inventor_name]" value="<?php echo $inventor_data['investigator_name']; ?>" />
					<input type="hidden" class="inventor_id" id="inventor_id" name="inventor[<?php echo $i; ?>][inventor_id]"  value="<?php echo $inventor_data['inventor_id']; ?>" />
				</div>
				<div class="form_items">
					<label>a. Institutional Title :</label>
					<input type="radio" class="required" <?php if($inventor_data['institutional']=='Gansh1'){ echo "checked"; } ?> id="institutional" name="inventor[<?php echo $i; ?>][institutional]" value="Gansh1" /><span class="radio_span">Chief or Head of Department</span>
					<input type="radio" class="required" <?php if($inventor_data['institutional']=='Gansh2'){ echo "checked"; } ?> id="institutional" name="inventor[<?php echo $i; ?>][institutional]" value="Gansh2" /><span class="radio_span">Professor</span>
					<input type="radio" class="required" <?php if($inventor_data['institutional']=='Gansh3'){ echo "checked"; } ?> id="institutional" name="inventor[<?php echo $i; ?>][institutional]" value="Gansh3" /><span class="radio_span">Associate Professor</span>
					<input type="radio" class="required" <?php if($inventor_data['institutional']=='Gansh4'){ echo "checked"; } ?> id="institutional" name="inventor[<?php echo $i; ?>][institutional]" value="Gansh4" /><span class="radio_span">Assistant Professor</span>
				</div>
				
		   
				<div class="form_items">
					<label>&nbsp;</label>
					<input type="radio" class="required" <?php if($inventor_data['institutional']=='Gansh5'){ echo "checked"; } ?> id="institutional" name="inventor[<?php echo $i; ?>][institutional]" value="Gansh5" /><span class="radio_span">Post-doc</span>
					<input type="radio" class="required" <?php if($inventor_data['institutional']=='Gansh6'){ echo "checked"; } ?> id="institutional" name="inventor[<?php echo $i; ?>][institutional]" value="Gansh6" /><span class="radio_span">Graduate Student</span>
					<input type="radio" class="required" <?php if($inventor_data['institutional']=='Gansh7'){ echo "checked"; } ?> id="institutional" name="inventor[<?php echo $i; ?>][institutional]" value="Gansh7" /><span class="radio_span">Under-Graduate</span>
					
					<?php /*
					<input type="radio" class="required" <?php 
					if($inventor_data['institutional']=='Gansh1' || $inventor_data['institutional']=='Gansh2' || $inventor_data['institutional']=='Gansh3' || $inventor_data['institutional']=='Gansh4' || $inventor_data['institutional']=='Gansh5' || $inventor_data['institutional']=='Gansh6' || $inventor_data['institutional']=='Gansh6' ){ echo "";	}else{ echo "checked"; 	} ?> id="institutional" name="inventor[<?php echo $i; ?>][institutional]" value="other" /><span class="radio_span institutional_other_span" style="<?php if($inventor_data['institutional']=='Gansh1' || $inventor_data['institutional']=='Gansh2' || $inventor_data['institutional']=='Gansh3' || $inventor_data['institutional']=='Gansh4' || $inventor_data['institutional']=='Gansh5' || $inventor_data['institutional']=='Gansh6' || $inventor_data['institutional']=='Gansh6' ){ echo "display:block";	} else{ echo "display:none;" ; } ?>">Other</span>
					<input type="text" id="institutional_other" class="institutional_other" name="inventor[<?php echo $i; ?>][institutional_other]" value="<?php if($inventor_data['institutional']=='Gansh1' || $inventor_data['institutional']=='Gansh2' || $inventor_data['institutional']=='Gansh3' || $inventor_data['institutional']=='Gansh4' || $inventor_data['institutional']=='Gansh5' || $inventor_data['institutional']=='Gansh6' || $inventor_data['institutional']=='Gansh6' ){ echo "";	}else{ echo $inventor_data['institutional']; } ?>" placeholder="Other" style="width: 100px; font-size: 13px; height: 14px; <?php if($inventor_data['institutional']=='Gansh1' || $inventor_data['institutional']=='Gansh2' || $inventor_data['institutional']=='Gansh3' || $inventor_data['institutional']=='Gansh4' || $inventor_data['institutional']=='Gansh5' || $inventor_data['institutional']=='Gansh6' || $inventor_data['institutional']=='Gansh6' ){ echo "display:none";	} else{ echo "display:block;" ; } ?>" /> 
					
					*/ ?>
				</div>
				
				<div class="form_items home_address_p">
					<label>b.	Home Address  :</label>
					<input type="text" id="home_address" class="home_address required" name="inventor[<?php echo $i; ?>][home_address]" value="<?php echo $inventor_data['home_address']; ?>" />
				</div>
				<div class="form_items citizenship_p">
					<label>c.	Citizenship  :</label>
					<input type="text" id="citizenship" class="citizenship required" name="inventor[<?php echo $i; ?>][citizenship]" value="<?php echo $inventor_data['citizen_ship']; ?>" />
				</div>
				<div class="form_items mobile_p">
					<label>d.	Mobile   :</label>
					<input type="text" id="mobile" class="mobile required" name="inventor[<?php echo $i; ?>][mobile]" value="<?php echo $inventor_data['phone_number']; ?>" />
				</div>
			
				<div class="form_items email_p">
					<label>e.  E-mail: </label>
					<input type="email" id="email" class="email required" name="inventor[<?php echo $i; ?>][email]" value="<?php echo $inventor_data['email']; ?>" />
				</div>
			
				<div class="form_items number_invention_p">
					<label>3(ii) Number of inventions naming this inventor : </label>
					<input type="text" id="number_invention" class="number_invention" style="background-color:#C9C9C9" name="inventor[<?php echo $i; ?>][number_invention]" readonly="readonly" value="<?php echo $inventor_data['count_inventor']; ?>" />
				</div>
			
			</div>
				
				
			<?php
			$i++;
			}
				if($filed_child==$total_child){
				
					$prog = $page_data['invention_data']['progress'];
					if($prog>0){
					$progress = $prog ;
					}else{
					$progress = 16 ;
					}
				
				}
				
			}else{
			
			
		  ?>
		   <div class="subchild">
		   <a href="javascript:void(0)" class="close_child">X</a>
				<div class="form_items id_div">
					<label>3(i). Inventor Name : </label>
					<input type="text" class="inventor_name required" id="inventor_name" name="inventor[0][inventor_name]" />
					<input type="hidden" class="inventor_id" id="inventor_id" name="inventor[0][inventor_id]"/>
				</div>
				<div class="form_items radiobuttons">
					<label>a. Institutional Title :</label>
					<input type="radio" class="required" id="institutional" name="inventor[0][institutional]" value="Gansh1" /><span class="radio_span">Chief or Head of Department</span>
					<input type="radio" class="required" id="institutional" name="inventor[0][institutional]" value="Gansh2" /><span class="radio_span">Professor</span>
					<input type="radio" class="required" id="institutional" name="inventor[0][institutional]" value="Gansh3" /><span class="radio_span">Associate Professor</span>
					<input type="radio" class="required" id="institutional" name="inventor[0][institutional]" value="Gansh4" /><span class="radio_span">Assistant Professor</span>
				</div>
				
		   
				<div class="form_items">
					<label>&nbsp;</label>
					<input type="radio" class="required" id="institutional" name="inventor[0][institutional]" value="Gansh5" /><span class="radio_span">Post-doc</span>
					<input type="radio" class="required" id="institutional" name="inventor[0][institutional]" value="Gansh6" /><span class="radio_span">Graduate Student</span>
					<input type="radio" class="required" id="institutional" name="inventor[0][institutional]" value="Gansh7" /><span class="radio_span">Under-Graduate</span>
					<!--
					<input type="radio" class="required" id="institutional" name="inventor[0][institutional]" value="other" />
					<span class="radio_span institutional_other_span">Other</span>
					<input type="text" id="institutional_other" class="institutional_other" name="inventor[0][institutional_other]" value="" placeholder="Other" style="width: 100px; font-size: 13px; height: 14px; display:none;" /> 
					-->
				</div>
				
				<div class="form_items home_address_p">
					<label>b.	Home Address  :</label>
					<input type="text" id="home_address" class="home_address required" name="inventor[0][home_address]" />
				</div>
				<div class="form_items citizenship_p">
					<label>c.	Citizenship  :</label>
					<input type="text" id="citizenship" class="citizenship required" name="inventor[0][citizenship]" />
				</div>
				<div class="form_items mobile_p">
					<label>d.	Mobile   :</label>
					<input type="text" id="mobile" class="mobile required" name="inventor[0][mobile]" />
				</div>
			
				<div class="form_items email_p">
					<label>e.  E-mail: </label>
					<input type="text" id="email" class="email required" name="inventor[0][email]" />
				</div>
			
				<div class="form_items number_invention_p">
					<label>3(ii) Number of inventions naming this inventor : </label>
					<input type="text" id="number_invention" class="number_invention" style="background-color:#C9C9C9" name="inventor[0][number_invention]" readonly="readonly" />
				</div>
			
			</div>
			<?php } ?>
			
				<div class="form_items" id="add_more">
				<span class="add-more"><a href="javascript:void(0)" id="add_more_inventors">CLICK HERE TO ADD MORE INVENTORS</a></span>
				</div>
			</div>
           <!--  <div class="form_action" style="width:700px;">
            	<input class="left" type="submit" name="Submit" value="Save & Exit" />
				 <input type="submit" name="next" value="TECHNOLOGY" />
				
				  <input type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/invention2'); ?>/<?php echo  $page_data['next_invention'];  ?>';" class="next" name="next1" value="IP" />
				   <input type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/invention3'); ?>/<?php echo  $page_data['next_invention'];  ?>';" class="next"  name="next" value="COMMERCIALIZATION"  />
				    <input type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/score'); ?>/<?php echo  $page_data['next_invention'];  ?>';" class="next" name="next" value="SCORING" />
            </div> -->
			<div class="form_action" style="width:700px;">
			<input type="submit" style="display:none" id="done" name="next" value="TECHNOLOGY" />
			<input  class="right" type="button" onclick="javascript:window.location.href='<?php echo site_url('user/logout'); ?>'" name="exit" value="Save & Exit" />
			</div>
			<p class="progress"><?php echo $progress; ?>% COMPLETE.</p>
			<input type="hidden" id="link_redir_page" name="link_redir_page" value="com" />
        </form>
		<!--
		<div>
			<span class="next">
			<a href="javascript:void(0)" onclick="commercialization('tech')">&gt;&gt;</a>
			</span>
		</div>
		-->
		<div class="steps_container">
    	<ul>
			<li>
			<a href="javascript:void(0)" class="active" onclick="commercialization('ii')">INVENTOR INFORMATION</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('tech')">TECHNOLOGY</a>
			</li>
            <li class="strip"> &nbsp;</li>
			<li>
			<a href="javascript:void(0)" onclick="commercialization('ip')">INTELLECTUAL PROPERTY</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)"  onclick="commercialization('com')">COMMERCIALIZATION</a>
			</li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)">ANALYTICS</a>
			</li>
			<?php } ?>
		</ul>
		</div>
	
    </div>
    
