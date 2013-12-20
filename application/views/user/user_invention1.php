  <script  type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.tipsy.js'></script>

<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.validation.js'></script>
<link rel="stylesheet" href="<?php echo return_theme_path(); ?>css/tipsy.css" type="text/css" />
<script>

$(function() {

	$('#done').live('click',function (evt) {
		
			/* var invention_title = $("input[name='invention_title']").val();
		
		
			var funding_source_government_length = $("input[name='funding_source_government']:checked").length;
			var funding_source_industry_length = $("input[name='funding_source_industry']:checked").length;
			var funding_source_foundation_length = $("input[name='funding_source_foundation']:checked").length;
			var funding_source_other_length = $("input[name='funding_source_other']:checked").length;
			var funding_source_sundry_funds_length = $("input[name='funding_source_sundry_funds']:checked").length;
			
			var sel_chk = parseInt(funding_source_government_length)+parseInt(funding_source_industry_length)+parseInt(funding_source_foundation_length)+parseInt(funding_source_other_length)+parseInt(funding_source_sundry_funds_length);
			
			if(sel_chk > 0)	{
				return true;
			}else{
				//alert('Please complete the required fields');
				$(".funding_source_chk_error").show();
			} */
			jQuery.validator.addMethod("checkboxCheck", function(value, element,params) {
			
					return $(params[0]+':checked').length > 0;
			});
			 
		$("#question_form1").validate({
				rules: {
					funding_source_government:{
						checkboxCheck:['.funding_source_chk'],
					}
				},
				messages: {
					funding_source_government:{
						checkboxCheck: "Please select atleast one.",
					}
				}
			});
		
		
		
	});

	 $("#grant_documents_click").live('click',function(){
				$(".fileq9").show();
	});
	
	
	
	$("input[name='invention_title']").live('blur',function(){ 
		autosave();
	});
	
	$("input[name='invention_type']").live('click',function(){ 
		var cur_val = $(this).val();
		/* 
		if(cur_val=='other'){
			$("input[name='invention_type_other']").addClass('required');
		}else{
			$("input[name='invention_type_other']").removeClass('required');
		}
		 */
		autosave();
	});
	
	
	 $(".funding_source_chk").live('click',function(){
		var cur_check = $(this).attr('name');
		
		if(cur_check=='funding_source_other'){
			$("input[name='funding_source_foundation_other']").addClass('required');
		}else{
			$("input[name='funding_source_foundation_other']").removeClass('required');
		}
		
			var funding_source_government_length = $("input[name='funding_source_government']:checked").length;
			var funding_source_industry_length = $("input[name='funding_source_industry']:checked").length;
			var funding_source_foundation_length = $("input[name='funding_source_foundation']:checked").length;
			var funding_source_other_length = $("input[name='funding_source_other']:checked").length;
			var funding_source_sundry_funds_length = $("input[name='funding_source_sundry_funds']:checked").length;
			
			var sel_chk = parseInt(funding_source_government_length)+parseInt(funding_source_industry_length)+parseInt(funding_source_foundation_length)+parseInt(funding_source_other_length)+parseInt(funding_source_sundry_funds_length);
						
			var i ;
			var inputs = '';
			$(".entitiy_name_q9_p").html('');
			for(i= 1;i <= sel_chk ; i++){
			
				inputs +=  '<input type="text" name="entitiy_name[]" class="entitiy_name_q9"  value="" style="margin-top: 10px;"/><br/>';
			}
			$(".entitiy_name_q9_p").html('<label>9. (c) Entity Name(s) :</label>'+inputs);
			autosave();
	});
	
	
	
	
	$("#invention_attachments_click").live('click',function(){
		$(".fileq8").show();
	});
	$("input[name='category_invention']").live('click',function(){ 
		var cur_sel = $(this).val();
		//alert(cur_sel);
		//if(cur_sel=='gansh1' || cur_sel=='gansh2' || cur_sel=='gansh3' || cur_sel=='gansh4' || cur_sel=='gansh5'){
		if(cur_sel=='gansh1'){
			// category_invention_1	
			$("input[name='category_invention_2']").addClass('required');
			$("input[name='stage_of_devolpment']").addClass('required');
		}else{
			$("input[name='category_invention_2']").removeClass('required');
			$("input[name='stage_of_devolpment']").removeClass('required');
		}

		autosave();
		
	});

	$("input[name='category_invention_1']").live('click',function(){ 
		autosave();
	});

	$("input[name='category_invention_2']").live('click',function(){ 
		autosave();
	});

	$("input[name='category_invention_3']").live('click',function(){ 
		autosave();
	});
	$(".impect_areas").live('blur',function(){ 
		autosave();
	});
	$("input[name='stage_of_devolpment']").live('click',function(){ 
		autosave();
	});
	$("input[name='stage_of_devolpment_1']").live('click',function(){ 
		autosave();
	});

	$('.abstract_invantion').live('blur',function(){ 
		autosave();
	});

	$("input[name='principal_investigator']").live('blur',function(){ 
		autosave();
	});
	$("input[name='entitiy_name[]']").live('blur',function(){ 
		autosave();
	});

	$("input[name='agrement_number']").live('blur',function(){ 
		autosave();
	});
	$("input[name='amount_of_funding']").live('blur',function(){ 
		autosave();
	});		 
			 
	/* 
	$("#question_form1").validate({
		rules:
			{
				invention_title:
				{
					required: true					
				},
				invention_type:
				{
					required: true					
				}
			},
			messages:
			{
				invention_title:
				{
					required: "This is required field"
				},
				invention_type:
				{
					required: "This is required field"
				}
			}
    }); */
	$(".product_cat").click(function() {
		var cur_sel_id = $(this).attr('id') ;
		var cur_sel_val = $(this).val() ;
		
		if(cur_sel_val=='gansh1'){
			$(".help6b").attr("title",'Some examples are: Non-small cell lung cancer, lupus, Chemotherapy related anemia, malaria, Crohn&rsquo;s disease, IBD, cholesterol lowering drug, device for cell counting, antibody for detecting lyme disease, vector for transfection, gram positive bacterial infection detection.');
		} else if(cur_sel_val=='gansh2'){
			$(".help6b").attr("title",'Some examples are - Superior laundry detergent, novel case for cell phone etc.');
		
		} else if(cur_sel_val=='gansh3'){
			$(".help6b").attr("title",'Some examples are - Lorium Ipsum.');
		
		} else if(cur_sel_val=='gansh4'){
			$(".help6b").attr("title",'Some examples are - ultra light material for use in aircraft or automobiles etc.');
		} else if(cur_sel_val=='gansh5'){
		
			$(".help6b").attr("title",'Some examples are - Lorium Ipsum.');
		}
		
		$(".question7 ul").hide();
		$(".question7 "+"."+cur_sel_val).show();
		
		/* if(cur_sel_val=='gansh9'){
			$(".question7 .gansh10").hide();
			$(".question7 .gansh11").hide();
			$(".question7 .gansh9").show();
		}
		
		if(cur_sel_val=='gansh10'){
			$(".question7 .gansh9").hide();
			$(".question7 .gansh11").hide();
			$(".question7 .gansh10").show();
		
		}
		
		if(cur_sel_val=='gansh11'){
			$(".question7 .gansh9").hide();
			$(".question7 .gansh10").hide();
			$(".question7 .gansh11").show();
		
		} */
		
	
	
		
		$(this).parent().children("."+cur_sel_id).hide();
		$(this).parent().children("."+cur_sel_id).children(".second_child").hide();
		$(this).parent().children("."+cur_sel_id).children(".third_child").hide();
		$("."+cur_sel_id+'#'+cur_sel_val).children('input').attr('checked', false) ;
		$(this).parent().children("."+cur_sel_id+'#'+cur_sel_val).show();
		
	});
	
	
	$(".gansh9_7").click(function(){ 
		$(this).parent().parent().children('li').children('ul.sub_ul').children('li').children('input').attr('checked', false).removeClass('required');
		$(this).parent().parent().children('li').children('ul.sub_ul').hide();
		$(this).parent().children('ul.sub_ul').children('li').children('input').addClass('required');
			
		
		$(this).parent().children('ul.sub_ul').show();
	
	});
	
	
	$(".product_grand_cat").click(function(){
		if($(this).hasClass('havechild')){
			$(this).hide();
			$(this).parent().children('span').hide();
			$(this).parent().children('.inner_drug').show();
		
		}else{
			
			$('.inner_drug').parent().children('span').show();
			$('.inner_drug').parent().children('input').show();
			$('.inner_drug').hide();
			
		}
	});
	
	
	
	$(".product_sub_cat").live('click',function(){
		var cur_sel_id = $(this).attr('id') ;
			var cur_sel_val = $(this).val() ;
		//alert(cur_sel_val);
		/* if(cur_sel_val=='c'){
		$('.sub_ul_1').show();
		}else{
			$("input[name='stage_of_devolpment_1']").attr('checked', false) ;
			$('.sub_ul_1').hide();
		}  */
		
		if(cur_sel_val=='gansh11_1' || cur_sel_val=='gansh10_1' || cur_sel_val=='gansh9_1' ){
				

			$(".help6b").attr("title",'Identify specific first applications of this platform technology, some examples include ...');
		}else{
		
			$(".help6b").attr("title",'Some examples are - Lorium Ipsum....');
		
		}
		
		
		
		if($(this).hasClass("havechild")){
		
		
			$(".third_child").hide();
			$("."+cur_sel_id).hide();
			$(".subitems").hide();
			
			$("."+cur_sel_id+'#'+cur_sel_val).children('input').attr('checked', false) ;
			$("."+cur_sel_id+'#'+cur_sel_val).show();
		}else{
			$(".third_child").hide();
		}
	});
	
		var maxWords = 150;
		
		
		$('.impect_areas').keypress(function(e) {
				var tval = $('.impect_areas').val() ; 
					tlength = tval.length ; 
				var  set = 150 ; 
					if(tlength > set ){
						alert("You've reached the maximum allowed character.");
						return false;
					}
					
				/* 	//remain = parseInt(set - tlength);
				$('p').text(remain);
				if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
					$('.impect_areas').val((tval).substring(0, tlength - 1))
				} */
			})
		
		
		
		
		
		var abstract_invantion_maxWords = 100;
		jQuery('.abstract_invantion').keypress(function() {
			var $this, wordcount;
			$this = $(this);
			wordcount = $this.val().split(/\b[\s,\.-:;]*/).length;
			if (wordcount > abstract_invantion_maxWords) {
				jQuery(".word_count span").text("" + abstract_invantion_maxWords);
				alert("You've reached the maximum allowed words.");
				return false;
			} else {
				return jQuery(".word_count span").text(wordcount);
			}
		});
		
			
		
				/* 	$(".help6b").tooltip({
						position: {
						my: "center bottom-20",
						at: "center top",
						html:true,
						using: function( position, feedback ) {
						$( this ).css( position );
						$( "<div>" )
						.addClass( "arrow" )
						.addClass( feedback.vertical )
						.addClass( feedback.horizontal )
						.appendTo( this ).css('width','600px');
						}
						}
					}); */
		
		
			//	$(".help6b").tipsy({html:true}) ; 
				$('.help6b').tipsy({html: true });
				$('.forallhelp').tipsy({html: true });
				$('.help8').tipsy({html: true });

});
 function autosave(){
		var form1 = $("#question_form1").serialize();
			$.ajax({
				url: "<?php echo site_url('user/home/form2_save');?>",
				data: form1,
				type: "POST",
				success: function(response) {
			//	alert(response);
					$('.progressspan').html(response);
				}
			}); 
	 }

/* 
function check_progress(){
	
	var invention_title   =  $("input[name='invention_title']").val();
	
	if(invention_title!=''){
		
	}
	
	
} */

function commercialization(page){
	
	$('#link_redir_page').val(page);
	$('#done').trigger('click');
	//$( "#question_form2" ).submit();
//alert(page);
}

</script>	
<style>
	.form_items ul li{
		clear: both;
		float: left;
	}
	.form_items ul{
		
		padding-left:110px;
	}
</style>
<?php
	


	$title = '';
	$invention_type = '';
	$invention_type_other = '';
	$category_invention = '';
	$cat_invention_1 = '';
	$cat_invention_2 = '';
	$name_drug = '';
	$cat_invention_3 = '';
	$impect_areas = '';
	$stage_of_devolpment = '';
	$stage_of_devolpment_1 = '';
	$abstract_invantion = '';
	$institutional_title = '';
	$abstract_of_invention = '';
	$funding_source = '';
	$funding_source_other = '';
	$principal_investigator = '';
	$entitiy_name = array();
	$agrement_number = '';
	$amount_of_funding = '';
	$progress=0;
	$gansh4_other='';
	if(isset($page_data['invention_data'])){
	
		$title 							= $page_data['invention_data']['title'] ; 
		$invention_type 				= $page_data['invention_data']['invention_type'] ; 
		$invention_type_other 			= $page_data['invention_data']['invention_type_other'] ; 
		$category_invention 			= $page_data['invention_data']['category_invention'] ; 
		$cat_invention_1 				= $page_data['invention_data']['cat_invention_1'] ; 
		$cat_invention_2 				= $page_data['invention_data']['cat_invention_2'] ; 
		$name_drug 						= $page_data['invention_data']['name_drug'] ; 
		$cat_invention_3 				= $page_data['invention_data']['cat_invention_3'] ; 
		$impect_areas 					= $page_data['invention_data']['impect_areas'] ; 
		$stage_of_devolpment 			= $page_data['invention_data']['stage_of_devolpment'] ; 
		$stage_of_devolpment_1 			= $page_data['invention_data']['stage_of_devolpment_1'] ; 
		$abstract_invantion 			= $page_data['invention_data']['abstract_invantion'] ; 
		
		$funding_source 				= explode(",",$page_data['invention_data']['funding_source']) ; 
		$funding_source_other 			= $page_data['invention_data']['funding_source_other'] ; 
		$principal_investigator 		= $page_data['invention_data']['principal_investigator'] ; 
		
		$entitiy_name 					= explode(",",$page_data['invention_data']['entitiy_name']) ; 
		$gansh4_other 					= $page_data['invention_data']['gansh4_other']; 

		$agrement_number 				= $page_data['invention_data']['agrement_number'] ; 
		$amount_of_funding 				= $page_data['invention_data']['amount_of_funding'] ; 
		$progress						=$page_data['invention_data']['progress'];
		
	}

	
	
	/* $progress=  0 ;
	
	if($title!=''){
		$progress += 8; 
	}
	
	if($invention_type!=''){
		if($invention_type=='other' && $invention_type_other!=''){
			$progress += 8; 
		}else{
			$progress += 8; 
		}
	}
	if($category_invention!='' && $cat_invention_1!=''){
		if($category_invention=='gansh1'){
			if($cat_invention_1!='' && $cat_invention_2!='' ){
				if($cat_invention_2=='gansh10_4' && $cat_invention_3!=''){
					$progress += 8; 
				}else{
					$progress += 8; 
				}
			}
		}else{
			if($cat_invention_1!=''){
				$progress += 8; 
			}
		
		}
	}
		
	if($impect_areas!=''){
		$progress += 8; 
	}
	
	if($category_invention=='gansh1'){
		if($cat_invention_2=='gansh9'){
			if($stage_of_devolpment!=''){
				if($stage_of_devolpment=='e' && $stage_of_devolpment_1!=''){
					$progress += 8; 
				}else{
					$progress += 8; 
				}
			}
		}else{
			if($stage_of_devolpment!=''){
				$progress += 8; 
			}
			
		}
	}
	
	
	if($abstract_invantion!=''){
		$progress += 12; 
	}
	
	if(!empty($funding_source)){
		$progress += 8; 
	}
	if($principal_investigator!=''){
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
	}
 */
	
	
		/* if(!empty($page_data['invention_inventor'])){ 
		
		//print_pre($page_data['invention_inventor']);die;
			$filed_child = 0; 
			$total_child = 0; 
			foreach($page_data['invention_inventor'] as $inventor_data){
				if($inventor_data['investigator_name']!=='' && $inventor_data['institutional']!=='' && $inventor_data['home_address']!=='' && $inventor_data['citizen_ship']!=='' && $inventor_data['phone_number']!=='' && $inventor_data['email']!==''){
						$filed_child++;
					}
					$total_child++;
				
			}
			
			if($filed_child==$total_child){
				$progress += 8 ;
			
			}
			
		} */
	
	$help_text  = '';
	if($category_invention=="gansh1"){
		$help_text = 'Some examples are: Non-small cell lung cancer, lupus, Chemotherapy related anemia, malaria, Crohn&rsquo;s disease, IBD, cholesterol lowering drug, device for cell counting, antibody for detecting lyme disease, vector for transfection, gram positive bacterial infection detection.';
	}elseif($category_invention=="gansh2"){
		$help_text = 'Some examples are - Superior laundry detergent, novel case for cell phone etc.';
	}elseif($category_invention=="gansh3"){
		$help_text = 'Some examples are - Lorium Ipsum.';
	}elseif($category_invention=="gansh4"){
		$help_text = 'Some examples are - ultra light material for use in aircraft or automobiles etc.';
	}elseif($category_invention=="gansh5"){
		$help_text = 'Some examples are - Lorium Ipsum.';
	}
	
		
	
	
?>		
<div class="wrapper"> 

	<div class="form_container">
		<b style="font-size:17px;">Invention No:
		<?php 
			echo $page_data['invention_data']['id'];
			if($title!=""){ echo ' ( '.ucwords($title).' )'; }else{
				echo ' ( N/A )';
			}
		?>
		</b>
	<div class="steps_container">       
    	<ul>
			<li>
			<a href="javascript:void(0)" onclick="commercialization('ii')">INVENTOR INFORMATION</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)"  class="active" onclick="commercialization('tech')">TECHNOLOGY</a>
			</li>
            <li class="strip"> &nbsp;</li>
			<li>
			<a href="javascript:void(0)" onclick="commercialization('ip')">INTELLECTUAL PROPERTY</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('com')">COMMERCIALIZATION</a>
			</li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('tech_score')">ANALYTICS</a>
			</li>
			<?php } ?>
		</ul>	
    </div>
	<!--
	<div>
		<span class="prev">
		<a href="javascript:void(0)" onclick="commercialization('ii')">&lt;&lt;</a>
		</span>
		<span class="next">
		<a href="javascript:void(0)" onclick="commercialization('ip')">&gt;&gt;</a>
		</span>
    </div>
	-->
    		<form action="" name="buy_name" id="question_form1" class="question-form" enctype="multipart/form-data" method="post">
				
        	<div class="form_items">
            	<label>4. Invention Title  : </label>
                <input type="text" name="invention_title" value="<?php echo $title; ?>" class="required"/>
            </div>
            <div class="form_items radiobuttons">
            	<label>5. Invention Type: </label>
                <input type="radio" class="required" id="institutional" <?php if($invention_type=="patent"){echo "checked"; } ?> name="invention_type" value="patent" /><span class="radio_span">Patent</span>
				<input type="radio" class="required" id="institutional" <?php if($invention_type=="cr_sw"){echo "checked"; } ?> name="invention_type" value="cr_sw" /><span class="radio_span">Copyright or software</span>
				<input type="radio" class="required" id="institutional" <?php if($invention_type=="bio_organism"){echo "checked"; } ?> name="invention_type" value="bio_organism" /><span class="radio_span">Bio-organism</span>
				<input type="radio" class="required" id="institutional" <?php if($invention_type=="know_how"){echo "checked"; } ?> name="invention_type" value="know_how" /><span class="radio_span">Know-how</span>
				<?php /*
				<input type="radio" class="required" id="institutional" <?php if($invention_type=="other"){echo "checked"; } ?> name="invention_type" value="other" />
				<input type="text" 	id="institutional" name="invention_type_other" value="<?php if($invention_type=="other"){echo $invention_type_other; } ?>" placeholder="Other" style="width: 100px; font-size: 13px; height: 14px;" />
				*/	?>
            </div>
			
			 
            <div class="form_items radiobuttons">
            	<label>6.(a)Indicate <span style="text-decoration: underline; font-weight: bold;">Product</span> Category of your Invention (<a class="forallhelp" title="If your invention has medical and non-medical applications pick the application that is near-term to commercialization">help</a>): </label>
                <input type="radio" <?php if($category_invention=="gansh1"){echo "checked"; } ?> id="first_child" name="category_invention" class="product_cat required" value="gansh1" /><span class="radio_span">Medical</span>
				<input type="radio" <?php if($category_invention=="gansh2"){echo "checked"; } ?> id="first_child" name="category_invention" class="product_cat required" value="gansh2" /><span class="radio_span">Science (non-medical)</span>
				<input type="radio" <?php if($category_invention=="gansh3"){echo "checked"; } ?> id="first_child" name="category_invention" class="product_cat required" value="gansh3" /><span class="radio_span">Engineering (non-medical)</span>
				<input type="radio" <?php if($category_invention=="gansh4"){echo "checked"; } ?> id="first_child" name="category_invention" class="product_cat required" value="gansh4" /><span class="radio_span"><input type="text" style="width: 100px; font-size: 13px; height: 14px;" placeholder="Other" value="<?php if( $category_invention=="gansh4" && !empty($gansh4_other)){ echo $gansh4_other; }?>" name="gansh4_other"></span><br/>
				<input type="radio" <?php if($category_invention=="gansh5"){echo "checked"; } ?> id="first_child" name="category_invention" class="product_cat required" value="gansh5" /><span class="radio_span">Category TBD</span>
				
				<!-- first_child -->
				
				<div class="form_items first_child" id="gansh1" style="<?php if($category_invention=="gansh1"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<label>Pick ONLY one : </label>
					<input type="radio" <?php if($cat_invention_1=="gansh9"){ echo "checked"; } ?>  id="gansh6a_1" name="category_invention_1" class="product_cat required" value="gansh9" /><span class="radio_span">Therapeutic</span>
					<input type="radio"  <?php if($cat_invention_1=="gansh10"){echo "checked"; } ?> id="gansh6a_1" name="category_invention_1" class="product_cat required" value="gansh10" /><span class="radio_span">Diagnostic</span>
					<input type="radio"  <?php if($cat_invention_1=="gansh11"){echo "checked"; } ?> id="gansh6a_1" name="category_invention_1" class="product_cat required" value="gansh11" /><span class="radio_span">Research Tools</span>
					
					<!-- Second Child -->
						
						<div class="form_items second_child gansh6a_1" id="gansh9" style="<?php if($cat_invention_1=="gansh9"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh9_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="gansh9_1" /><span class="radio_span">Platform</span></li> 
							<li>
							<input type="radio"  <?php if($cat_invention_2=="gansh9_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="gansh9_2" /><span class="radio_span">Device</span> </li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh9_3"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="gansh9_3" /><span class="radio_span">Small Molecule</span></li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh9_4"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="gansh9_4" /><span class="radio_span">Biological</span></li>
							</ul>
						</div>
						
						<div class="form_items second_child gansh6a_1" id="gansh10" style="<?php if($cat_invention_1=="gansh10"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh10_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="gansh10_1" /><span class="radio_span">Platform</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh10_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="gansh10_2" /><span class="radio_span">Device</span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh10_3"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="gansh10_3" /><span class="radio_span">Biomarker</span> </li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh10_4"){echo "checked"; } ?> id="gansh10_4_p" name="category_invention_2" class="product_sub_cat havechild <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="gansh10_4" /><span class="radio_span">CDX</span> </li></ul>
							
							<!-- grand child -->
							 <div class="form_items third_child gansh10_4_p" id="gansh10_4" style="<?php if($cat_invention_2=="gansh10_4"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
									<label>Drug on Market ? </label>
									<ul><li>
									<input type="radio" <?php if($cat_invention_3=="yes"){echo "checked"; } ?>  id="gansh10_4_1_1" name="category_invention_3" class="product_grand_cat havechild <?php if($cat_invention_2=="gansh10_4"){ echo "required"; } ?>" value="yes" /><span class="radio_span">Yes</span>
									<span class="inner_drug" style="<?php if($cat_invention_3=="yes"){ echo "display:block;"; }else{ echo "display:none;"; } ?>"><input type="text" placeholder="Name of Drug" value="<?php if($cat_invention_3=="yes"){ echo $name_drug; } ?>" name="name_drug" class="<?php if($cat_invention_3=="yes"){ echo "required"; } ?>"></span>
									
									</li><li>
									<input type="radio" <?php if($cat_invention_3=="no"){echo "checked"; } ?> name="category_invention_3" class="product_grand_cat <?php if($cat_invention_2=="gansh10_4"){ echo "required"; } ?>" value="no" /><span class="radio_span">No</span></li><li>
									<input type="radio" <?php if($cat_invention_3=="dont_know"){echo "checked"; } ?> name="category_invention_3" class="product_grand_cat <?php if($cat_invention_2=="gansh10_4"){ echo "required"; } ?>" value="dont_know" /><span class="radio_span">Don&rsquo;t know</span> </li><li>
									</ul>
							</div>
							
							
						</div>
			
						<div class="form_items second_child gansh6a_1" id="gansh11" style="<?php if($cat_invention_1=="gansh11"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh11_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="gansh11_1" /><span class="radio_span">Platform</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh11_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="gansh11_2"/><span class="radio_span">Wide applicability in industrial and academic research sector</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh11_3"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="gansh11_3"/><span class="radio_span">Niche Research Applicability</span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh11_4"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="gansh11_4"/><span class="radio_span">Device</span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh11_5"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="gansh11_5"/><span class="radio_span">Questionnaire/Survey/Assessment Tool</span></li></ul>
						</div>
					
					
					
				</div>
				 <div class="form_items first_child" id="gansh2" style="<?php if($category_invention=="gansh2"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<label>Pick ONLY one (<a class="forallhelp" title="Indicate the broad category of your invention and its applications in the real world <br/>
e.g., 1., polymers and catalysts would fall under Chemicals/Reagents-? Industrial applications, 
 <br/>e.g., 2 ., lasers would fall under instruments/devices and  industrial AND Consumer apllications (if better lasers for wafer inspection tools AND could be adapted to make better laser pointers)
 <br/>e.g., 3 Analytical methods and better manufacturing processes will fall under processes & methods">help</a>) </label>
					<input type="radio" id="gansh6a_1" <?php if($cat_invention_1=="gansh12"){echo "checked"; } ?>  name="category_invention_1" class="product_cat required" value="gansh12" /><span class="radio_span">Chemicals/Reagents </span>
					<input type="radio" id="gansh6a_1"  <?php if($cat_invention_1=="gansh13"){echo "checked"; } ?> name="category_invention_1" class="product_cat required" value="gansh13" /><span class="radio_span">Instruments/Devices</span>
					<input type="radio" id="gansh6a_1"  <?php if($cat_invention_1=="gansh14"){echo "checked"; } ?> name="category_invention_1" class="product_cat required" value="gansh14" /><span class="radio_span">Processes & Methods</span>
					
					<!-- Second Child -->
						
						<div class="form_items second_child gansh6a_1" id="gansh12" style="<?php if($cat_invention_1=="gansh12"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh12_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh12"){ echo "required"; } ?>" value="gansh12_1" /><span class="radio_span">Broad applications of inventive technology in several Industrial <span style="text-decoration: underline;">and</span> consumer Markets</span></li> 
							<li>
							<input type="radio"  <?php if($cat_invention_2=="gansh12_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh12"){ echo "required"; } ?>" value="gansh12_2" /><span class="radio_span">Specific applications of inventive technology in certain Industrial <span style="text-decoration: underline;">or</span> consumer Markets </span> </li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh12_3"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh12"){ echo "required"; } ?>" value="gansh12_3" /><span class="radio_span">Niche applications of inventive technology in industrial <span style="text-decoration: underline;">or</span> consumer markets </span></li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh12_4"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh12"){ echo "required"; } ?>" value="gansh12_4" /><span class="radio_span">Other </span></li>
							</ul>
						</div>
						
						<div class="form_items second_child gansh6a_1" id="gansh13" style="<?php if($cat_invention_1=="gansh13"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh13_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh13"){ echo "required"; } ?>" value="gansh13_1" /><span class="radio_span">Broad applications of inventive technology in several Industrial <span style="text-decoration: underline;">and</span> consumer Markets </span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh13_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh13"){ echo "required"; } ?>" value="gansh13_2" /><span class="radio_span">Specific applications of inventive technology in certain Industrial <span style="text-decoration: underline;">or</span> consumer Markets </span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh13_3"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh13"){ echo "required"; } ?>" value="gansh13_3" /><span class="radio_span">Niche applications of inventive technology in industrial <span style="text-decoration: underline;">or</span> consumer markets </span> </li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh13_4"){echo "checked"; } ?> id="gansh10_4_p" name="category_invention_2" class="product_sub_cat havechild <?php if($cat_invention_1=="gansh13"){ echo "required"; } ?>" value="gansh13_4" /><span class="radio_span">Other</span> </li></ul>
							
							
							
							
						</div>
			
						<div class="form_items second_child gansh6a_1" id="gansh14" style="<?php if($cat_invention_1=="gansh14"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh14_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh14"){ echo "required"; } ?>" value="gansh14_1" /><span class="radio_span">Broad applications of inventive technology in several Industrial <span style="text-decoration: underline;">and</span> consumer Markets</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh14_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh14"){ echo "required"; } ?>" value="gansh14_2"/><span class="radio_span">Specific applications of inventive technology in certain Industrial <span style="text-decoration: underline;">or</span> consumer Markets </span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh14_3"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh14"){ echo "required"; } ?>" value="gansh14_3"/><span class="radio_span">Niche applications of inventive technology in industrial <span style="text-decoration: underline;">or</span> consumer markets </span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh14_4"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh14"){ echo "required"; } ?>" value="gansh14_4"/><span class="radio_span">Other</span></li></ul>
						</div>
										
				</div>
				
				 <div class="form_items first_child" id="gansh3" style="<?php if($category_invention=="gansh3"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<label>Pick ONLY one (<a class="forallhelp" title="Indicate the broad category of your invention and its applications in the real world <br/>
e.g., 1 Novel, light materials for aeronautical applications would be Materials ? Industrial applications 
<br/>e.g., 2 ., Robots, temperature sensors devices with applications in industrial and consumer worlds would be Device ? Industrial and Consumer applications. 
<br/>e.g., 3 Methods/Processes and Designs to improve existing techniques would be Processes & methods
">help</a>)</label>
					<input type="radio" id="gansh6a_1"  <?php if($cat_invention_1=="gansh15"){echo "checked"; } ?> name="category_invention_1" class="product_cat required" value="gansh15" /><span class="radio_span">Instruments/Devices</span>
					<input type="radio" id="gansh6a_1" <?php if($cat_invention_1=="gansh16"){echo "checked"; } ?>  name="category_invention_1" class="product_cat required" value="gansh16" /><span class="radio_span">Materials</span>
					<input type="radio" id="gansh6a_1"  <?php if($cat_invention_1=="gansh17"){echo "checked"; } ?> name="category_invention_1" class="product_cat required" value="gansh17" /><span class="radio_span">Processes, Methods & Designs</span>
					
					<!-- Second Child -->
						
						<div class="form_items second_child gansh6a_1" id="gansh15" style="<?php if($cat_invention_1=="gansh15"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh15_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh15"){ echo "required"; } ?>" value="gansh15_1" /><span class="radio_span">Broad applications of inventive technology in several Industrial <span style="text-decoration: underline;">and</span> consumer Markets </span></li> 
							<li>
							<input type="radio"  <?php if($cat_invention_2=="gansh15_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh15"){ echo "required"; } ?>" value="gansh15_2" /><span class="radio_span">Specific applications of inventive technology in certain Industrial <span style="text-decoration: underline;">or</span> consumer Markets </span> </li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh15_3"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh15"){ echo "required"; } ?>" value="gansh15_3" /><span class="radio_span">Niche applications of inventive technology in industrial <span style="text-decoration: underline;">or</span> consumer markets </span></li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh15_4"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh15"){ echo "required"; } ?>" value="gansh15_4" /><span class="radio_span">Other </span></li>
							</ul>
						</div>
						
						<div class="form_items second_child gansh6a_1" id="gansh16" style="<?php if($cat_invention_1=="gansh16"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh16_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh16"){ echo "required"; } ?>" value="gansh16_1" /><span class="radio_span">Broad applications of inventive technology in several industrial <span style="text-decoration: underline;">and</span> consumer markets </span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh16_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh16"){ echo "required"; } ?>" value="gansh16_2" /><span class="radio_span">Specific applications of inventive technology in certain industrial <span style="text-decoration: underline;">or</span> consumer markets </span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh16_3"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh16"){ echo "required"; } ?>" value="gansh16_3" /><span class="radio_span">Niche applications of inventive technology in industrial <span style="text-decoration: underline;">or</span> consumer markets
</span> </li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh16_4"){echo "checked"; } ?> id="gansh10_4_p" name="category_invention_2" class="product_sub_cat havechild <?php if($cat_invention_1=="gansh16"){ echo "required"; } ?>" value="gansh16_4" /><span class="radio_span">Other</span> </li></ul>
							
							
							
							
						</div>
			
						<div class="form_items second_child gansh6a_1" id="gansh17" style="<?php if($cat_invention_1=="gansh17"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh17_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh17"){ echo "required"; } ?>" value="gansh17_1" /><span class="radio_span">Broad applications of inventive technology in several Industrial <span style="text-decoration: underline;">and</span> consumer Markets </span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh17_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh17"){ echo "required"; } ?>" value="gansh17_2"/><span class="radio_span">Specific applications of inventive technology in certain Industrial <span style="text-decoration: underline;">or</span> consumer Markets </span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh17_3"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh17"){ echo "required"; } ?>" value="gansh17_3"/><span class="radio_span">Niche applications of inventive technology in industrial <span style="text-decoration: underline;">or</span> consumer markets </span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh17_4"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh17"){ echo "required"; } ?>" value="gansh17_4"/><span class="radio_span">Other</span></li></ul>
						</div>
								
					
					
				</div>
				
				 <div class="form_items first_child" id="gansh4" style="<?php if($category_invention=="gansh4"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<label>Pick ONLY one </label>
					<input type="radio" id="gansh6a_1" <?php if($cat_invention_1=="gansh18"){echo "checked"; } ?>  name="category_invention_1" class="product_cat required" value="gansh18" /><span class="radio_span">Instruments/Devices</span>
					<input type="radio" id="gansh6a_1" <?php if($cat_invention_1=="gansh19"){echo "checked"; } ?>  name="category_invention_1" class="product_cat required" value="gansh19" /><span class="radio_span">Materials</span>
					<input type="radio" id="gansh6a_1"  <?php if($cat_invention_1=="gansh20"){echo "checked"; } ?> name="category_invention_1" class="product_cat required" value="gansh20" /><span class="radio_span">Processes, Methods & Designs</span>
					
					
					<!-- Second Child -->
						
						<div class="form_items second_child gansh6a_1" id="gansh18" style="<?php if($cat_invention_1=="gansh18"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh18_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh18"){ echo "required"; } ?>" value="gansh18_1" /><span class="radio_span">Broad applications of inventive technology in several Industrial <span style="text-decoration: underline;">and</span> consumer Markets </span></li> 
							<li>
							<input type="radio"  <?php if($cat_invention_2=="gansh18_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh18"){ echo "required"; } ?>" value="gansh18_2" /><span class="radio_span">Specific applications of inventive technology in certain Industrial <span style="text-decoration: underline;">or</span> consumer Markets </span> </li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh18_3"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh18"){ echo "required"; } ?>" value="gansh18_3" /><span class="radio_span">Niche applications of inventive technology in industrial <span style="text-decoration: underline;">or</span> consumer markets </span></li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh18_4"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh18"){ echo "required"; } ?>" value="gansh18_4" /><span class="radio_span">Other </span></li>
							</ul>
						</div>
						
						<div class="form_items second_child gansh6a_1" id="gansh19" style="<?php if($cat_invention_1=="gansh19"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh19_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh19"){ echo "required"; } ?>" value="gansh19_1" /><span class="radio_span">Industrial <span style="text-decoration: underline;">AND</span> Consumer Applications</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh19_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh19"){ echo "required"; } ?>" value="gansh19_2" /><span class="radio_span">Industrial <span style="text-decoration: underline;">OR</span> Consumer Applications </span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh19_3"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh19"){ echo "required"; } ?>" value="gansh19_3" /><span class="radio_span">Environmental impact (industrial or consumer)</span> </li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh19_4"){echo "checked"; } ?> id="gansh10_4_p" name="category_invention_2" class="product_sub_cat havechild <?php if($cat_invention_1=="gansh19"){ echo "required"; } ?>" value="gansh19_4" /><span class="radio_span">Other</span> </li></ul>
							
							
							
							
						</div>
			
						<div class="form_items second_child gansh6a_1" id="gansh20" style="<?php if($cat_invention_1=="gansh20"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh20_1"){ echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh20"){ echo "required"; } ?>" value="gansh20_1" /><span class="radio_span">Industrial <span style="text-decoration: underline;">AND</span> Consumer Applications</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh20_2"){ echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh20"){ echo "required"; } ?>" value="gansh20_2"/><span class="radio_span">Industrial <span style="text-decoration: underline;">OR</span> Consumer Applications</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh20_3"){ echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh20"){ echo "required"; } ?>" value="gansh20_3"/><span class="radio_span">Methods/designs with only niche applications</span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh20_4"){ echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh20"){ echo "required"; } ?>" value="gansh20_4"/><span class="radio_span">Other</span></li></ul>
						</div>
								
					
					
				</div>
				
				 <div class="form_items first_child" id="gansh5" style="<?php if($category_invention=="gansh5"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<label>Pick ONLY one: </label>
					<input type="radio" id="gansh6a_1"  <?php if($cat_invention_1=="gansh21"){echo "checked"; } ?> name="category_invention_1" class="product_cat required" value="gansh21" /><span class="radio_span">Instruments/Devices</span>
					<input type="radio" id="gansh6a_1" <?php if($cat_invention_1=="gansh22"){echo "checked"; } ?>  name="category_invention_1" class="product_cat required" value="gansh22" /><span class="radio_span">Materials</span>
					<input type="radio" id="gansh6a_1" <?php if($cat_invention_1=="gansh23"){echo "checked"; } ?>  name="category_invention_1" class="product_cat required" value="gansh23" /><span class="radio_span">Processes, Methods & Designs</span>
					
					<!-- Second Child -->
						
						<div class="form_items second_child gansh6a_1" id="gansh21" style="<?php if($cat_invention_1=="gansh21"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh21_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh21"){ echo "required"; } ?>" value="gansh21_1" /><span class="radio_span">Broad applications of inventive technology in several Industrial <span style="text-decoration: underline;">and</span> consumer Markets</span></li> 
							<li>
							<input type="radio"  <?php if($cat_invention_2=="gansh21_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh21"){ echo "required"; } ?>" value="gansh21_2" /><span class="radio_span">Specific applications of inventive technology in certain Industrial <span style="text-decoration: underline;">or</span> consumer Markets </span> </li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh21_3"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh21"){ echo "required"; } ?>" value="gansh21_3" /><span class="radio_span">Niche applications of inventive technology in industrial <span style="text-decoration: underline;">or</span> consumer markets </span></li>
							<li>
							<input type="radio" <?php if($cat_invention_2=="gansh21_4"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh21"){ echo "required"; } ?>" value="gansh21_4" /><span class="radio_span">Other </span></li>
							</ul>
						</div>
						
						<div class="form_items second_child gansh6a_1" id="gansh22" style="<?php if($cat_invention_1=="gansh22"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh22_1"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh22"){ echo "required"; } ?>" value="gansh22_1" /><span class="radio_span">Industrial <span style="text-decoration: underline;">AND</span> Consumer Applications</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh22_2"){echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh22"){ echo "required"; } ?>" value="gansh22_2" /><span class="radio_span">Industrial <span style="text-decoration: underline;">OR</span> Consumer Applications </span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh22_3"){echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh22"){ echo "required"; } ?>" value="gansh22_3" /><span class="radio_span">Environmental impact (industrial or consumer)</span> </li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh22_4"){echo "checked"; } ?> id="gansh10_4_p" name="category_invention_2" class="product_sub_cat havechild <?php if($cat_invention_1=="gansh22"){ echo "required"; } ?>" value="gansh22_4" /><span class="radio_span">Other</span> </li></ul>
														
						</div>
			
						<div class="form_items second_child gansh6a_1" id="gansh23" style="<?php if($cat_invention_1=="gansh23"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
							<ul><li>
							<input type="radio" <?php if($cat_invention_2=="gansh23_1"){ echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh23"){ echo "required"; } ?>" value="gansh23_1" /><span class="radio_span">Industrial <span style="text-decoration: underline;">AND</span> Consumer Applications</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh23_2"){ echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh23"){ echo "required"; } ?>" value="gansh23_2"/><span class="radio_span">Industrial <span style="text-decoration: underline;">OR</span> Consumer Applications</span></li><li>
							<input type="radio" <?php if($cat_invention_2=="gansh23_3"){ echo "checked"; } ?>  name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh23"){ echo "required"; } ?>" value="gansh23_3"/><span class="radio_span">Methods/designs with only niche applications</span></li><li>
							<input type="radio"  <?php if($cat_invention_2=="gansh23_4"){ echo "checked"; } ?> name="category_invention_2" class="product_sub_cat <?php if($cat_invention_1=="gansh23"){ echo "required"; } ?>" value="gansh23_4"/><span class="radio_span">Other</span></li></ul>
						</div>
								
					
					
				</div>
				
				
				
            </div>
			
			
            <div class="form_items">
            	<label>6.(b) List Specific Impact Areas of Invention :<span class="info">(max 150 character)<a href="javascript:void(0)" class="help6b" title="<?php echo $help_text; ?>"> Help </a></span> </label>
                <input  type="text" name="impect_areas" class="impect_areas required" value="<?php echo $impect_areas; ?>">
				
				
			
            </div>
			
			

            <div class="form_items question7 radiobuttons">
            	<label>7 : Stage of Development of Invention (<a class="forallhelp" title="Indicate what stage of development this invention currently is /will be in a few months as it is evaluated for IP protection">help</a>):</label>
					<ul class="gansh9" style="<?php if($cat_invention_1=="gansh9"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment=="a"){ echo "checked"; } ?> name="stage_of_devolpment" class="gansh9_7  <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment=="b"){ echo "checked"; } ?> name="stage_of_devolpment" class="gansh9_7 <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="b" /><span class="radio_span"> in-silico</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment=="c"){ echo "checked"; } ?> name="stage_of_devolpment" class="gansh9_7 <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Knock out or knock down or target data</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment=="d"){ echo "checked"; } ?> name="stage_of_devolpment" class="gansh9_7 <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Cell Line</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment=="e"){ echo "checked"; } ?> name="stage_of_devolpment" class="gansh9_7 gansh9_7_inner <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="e" /><span class="radio_span"> animal data</span>
						
						<ul class="sub_ul" style="<?php if($cat_invention_1=="gansh9" &&  $stage_of_devolpment=="e"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
						
						
							<li>
							<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment_1=='a'){ echo "checked"; } ?> name="stage_of_devolpment_1" class="product_sub_cat" value="a" /><span class="radio_span"> worm</span></li><li>
							<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment_1=='b'){ echo "checked"; } ?> name="stage_of_devolpment_1" class="product_sub_cat" value="b" /><span class="radio_span"> mice or rat</span></li><li>
							<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment_1=='c'){ echo "checked"; } ?> name="stage_of_devolpment_1" class="product_sub_cat" value="c" /><span class="radio_span"> rabbit or dog or monkey</span></li>
					</ul>
				</li>
				<li>
					<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment=="f"){echo "checked"; } ?> name="stage_of_devolpment" class="gansh9_7 <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="f" /><span class="radio_span"> Human clinical data</span></li>
				<li>
					<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment=="g"){echo "checked"; } ?> name="stage_of_devolpment" class="gansh9_7 <?php if($cat_invention_1=="gansh9"){ echo "required"; } ?>" value="g" /><span class="radio_span"> Prototype</span></li>
				
				
				</ul>

				<ul class="gansh10" style="<?php if($cat_invention_1=="gansh10"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh10" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh10" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat  <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="b" /><span class="radio_span"> Cell Line</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh10" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat  <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Animal data</span></li>
					<?php /*
					<ul class="sub_ul_1" style="<?php  if($cat_invention_1=="gansh9" &&  $stage_of_devolpment=="c"){ echo "display:block;"; }else{ echo "display:none;"; }   ?>">
							<li>
							<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment_1=='a'){ echo "checked"; } ?> name="stage_of_devolpment_1" class="product_sub_cat_new" value="a" /><span class="radio_span">(ei) worm</span></li><li>
							<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment_1=='b'){ echo "checked"; } ?> name="stage_of_devolpment_1" class="product_sub_cat_new" value="b" /><span class="radio_span">(eii) mice or rat</span></li><li>
							<input type="radio" <?php if($cat_invention_1=="gansh9" && $stage_of_devolpment_1=='c'){ echo "checked"; } ?> name="stage_of_devolpment_1" class="product_sub_cat_new" value="c" /><span class="radio_span">(eiii) rabbit or dog or monkey</span></li>
					</ul>
					*/
					?>
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh10" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat  <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Human clinical</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh10" && $stage_of_devolpment=="e"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat  <?php if($cat_invention_1=="gansh10"){ echo "required"; } ?>" value="e" /><span class="radio_span"> Prototype</span></li>
					
				</ul>
				
				<ul class="gansh11" style="<?php if($cat_invention_1=="gansh11"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh11" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh11" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="b" /><span class="radio_span"> Internal testing</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh11" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Publication submitted</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh11" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="d" /><span class="radio_span"> beta-testing of research tool via academic collaboration</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh11" && $stage_of_devolpment=="e"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh11"){ echo "required"; } ?>" value="e" /><span class="radio_span"> beta-testing of research tool via industry collaboration</span></li>
					
				</ul>
				
				<ul class="gansh12" style="<?php if($cat_invention_1=="gansh12"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh12" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh12"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh12" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh12"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh12" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh12"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh12" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh12"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh13" style="<?php if($cat_invention_1=="gansh13"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh13" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh13"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh13" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh13"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh13" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh13"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh13" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh13"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh14" style="<?php if($cat_invention_1=="gansh14"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh14" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh14"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh14" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh14"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh14" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh14"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh14" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh14"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh15" style="<?php if($cat_invention_1=="gansh15"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh15" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh15"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh15" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh15"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh15" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh15"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh15" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh15"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh16" style="<?php if($cat_invention_1=="gansh16"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh16" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh16"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh16" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh16"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh16" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh16"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh16" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh16"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh17" style="<?php if($cat_invention_1=="gansh17"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh17" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh17"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh17" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh17"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh17" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh17"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh17" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh17"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh18" style="<?php if($cat_invention_1=="gansh18"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh18" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh18"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh18" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh18"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh18" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh18"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh18" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh18"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh19" style="<?php if($cat_invention_1=="gansh19"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh19" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh19"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh19" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh19"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh19" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh19"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh19" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh19"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh20" style="<?php if($cat_invention_1=="gansh20"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh20" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh20"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh20" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh20"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh20" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh20"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh20" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh20"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh21" style="<?php if($cat_invention_1=="gansh21"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh21" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh21"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh21" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh21"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh21" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh21"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh21" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh21"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh22" style="<?php if($cat_invention_1=="gansh22"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh22" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh22"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh22" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh22"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh22" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh22"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh22" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh22"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				<ul class="gansh23" style="<?php if($cat_invention_1=="gansh23"){ echo "display:block;"; }else{ echo "display:none;"; } ?>">
					<li>
					<input type="radio" <?php if($cat_invention_1=="gansh23" && $stage_of_devolpment=="a"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh23"){ echo "required"; } ?>" value="a" /><span class="radio_span"> Concept</span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh23" && $stage_of_devolpment=="b"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh23"){ echo "required"; } ?>" value="b" /><span class="radio_span"> In-silico/design stage </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh23" && $stage_of_devolpment=="c"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh23"){ echo "required"; } ?>" value="c" /><span class="radio_span"> Proof-of-concept testing done in lab setting </span></li><li>
					<input type="radio" <?php if($cat_invention_1=="gansh23" && $stage_of_devolpment=="d"){echo "checked"; } ?> name="stage_of_devolpment" class="product_sub_cat <?php if($cat_invention_1=="gansh23"){ echo "required"; } ?>" value="d" /><span class="radio_span"> Advanced testing done/Prototype build </span></li>
					
				</ul>
				
            </div>
			 
			
			  
			
            <div class="form_items">
            	<label>8. Abstract of Invention:<span class="info">(max 100 words) <a href="javascript:void(0)" class="help8" title="What is pertinent to include? Why is there a word limit?"> Help </a></span></label>
                <textarea name="abstract_invantion" class="abstract_invantion required" rows="4" cols="40"/><?php echo $abstract_invantion; ?></textarea>
				<a href="javascript:void(0)" style="float:left;color: #000000;text-decoration:underline;margin-top:10px;" id="invention_attachments_click">CLICK HERE TO UPLOAD INVENTION ATTACHMENTS</a>
				<span class="fileq8" style="display:none"><input type="file" name="invention_attachments"></span>
            </div>
			
			
            <div class="form_items radiobuttons">
			
            	<label>9.	(a) Funding Source for Invention. Pick ALL that apply (A through D) </label>
					<input type="checkbox" class="funding_source_chk"	<?php if($funding_source!='' && $funding_source!=0 && in_array('a',$funding_source)){ echo "checked"; } ?> name="funding_source_government" /><span class="radio_span">(A) Government</span>
					<input type="checkbox" class="funding_source_chk" <?php if($funding_source!='' && $funding_source!=0 && in_array('b',$funding_source)){ echo "checked"; } ?> name="funding_source_industry"/><span class="radio_span">(B) Industry</span>
					<input type="checkbox" class="funding_source_chk" <?php if($funding_source!='' && $funding_source!=0 && in_array('c',$funding_source)){ echo "checked"; } ?> name="funding_source_foundation" /><span class="radio_span">(C) Foundation</span>
					<input type="checkbox" class="funding_source_chk" <?php if($funding_source!='' && $funding_source!=0 && in_array('d',$funding_source)){ echo "checked"; } ?> name="funding_source_other" /><span class="radio_span">(D) <input type="text" style="width: 100px; font-size: 13px; height: 14px;" placeholder="Other" value="<?php echo $funding_source_other; ?>" name="funding_source_foundation_other" > </span>
					<input type="checkbox" class="funding_source_chk" <?php if($funding_source!='' && $funding_source!=0 && in_array('e',$funding_source)){ echo "checked"; } ?> name="funding_source_sundry_funds"/><span class="radio_span">(E) Sundry Funds </span>
					<a href="javascript:void(0)"  style="float:left;clear:both; color: #000000;text-decoration:underline;margin-top:10px;"  id="grant_documents_click">CLICK HERE TO UPLOAD GRANT DOCUMENTS</a>
					<span class="fileq9"  style="display:none"><input type="file" name="grant_documents"></span>
					
					
            </div>
			
			
            <div class="form_items">
            	<label>9. (b) Principal Investigator (PI) on Grant/Agreement: </label>
					<input type="text" name="principal_investigator" class="required" value="<?php echo $principal_investigator; ?>" />
            </div>
			
			
            <div class="form_items entitiy_name_q9_p">
            	<label>9. (c) Entity Name(s) :</label>
					<?php if(!empty($entitiy_name)){ 
							foreach($entitiy_name as $enitity_name_data){
							?>
								<input type="text" name="entitiy_name[]" class="entitiy_name_q9"  value="<?php echo $enitity_name_data; ?>" style="margin-top:10px;" /><br/>
							
						<?php	}
					
					
					}?>
					
            </div>
			
			
            <div class="form_items">
            	<label>9. (d) Grant No. and/or Agreement No: </label>
					<input type="text" name="agrement_number" class=""  value="<?php echo $agrement_number; ?>" />
            </div>
			
			
            <div class="form_items">
            	<label>9. (e) Amount of funding & grant period: </label>
					<input type="text" name="amount_of_funding" class="" value="<?php echo $amount_of_funding; ?>" />
            </div>
			
			
			
			
			<!--
            <div class="form_action" style="width:700px;">
					
					<input  class="left" type="submit" id="save_exit" name="Submit" value="Save & Exit" />
					<input  class="" type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/invention'); ?>/<?php echo  $page_data['invention_id'];  ?>';" name="previous" value="INVENTOR INFORMATION" />
					
					 <input type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/invention2'); ?>/<?php echo  $page_data['invention_id'];  ?>';" class="previous" name="next" value="IP" />
				   <input type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/invention3'); ?>/<?php echo  $page_data['invention_id'];  ?>';" class="previous"  name="next" value="COMMERCIALIZATION"  />
				    <input type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/score'); ?>/<?php echo  $page_data['invention_id'];  ?>';" class="next" name="next" value="SCORING" />
					
            </div> -->

			 <div class="form_action" style="width:700px;">
			<input  class="right" type="submit" style="display:none;" name="next" id="done" value="Done" />
			<input  class="right" type="button" onclick="javascript:window.location.href='<?php echo site_url('user/logout'); ?>'" name="exit" value="Save & Exit" />
			    </div>
			<p class="progress"><span class="progressspan"><?php echo $progress; ?></span>% COMPLETE.</p>
			<input type="hidden"  name="invention_id" value="<?php echo  $page_data['invention_id'];  ?>" />
				<input type="hidden" id="link_redir_page" name="link_redir_page" value="ip" />
        </form>
	<!--	
	<div>
		<span class="prev">
		<a href="javascript:void(0)" onclick="commercialization('ii')">&lt;&lt;</a>
		</span>
		<span class="next">
		<a href="javascript:void(0)" onclick="commercialization('ip')">&gt;&gt;</a>
		</span>
	</div>
	-->
	
	<div class="steps_container">
    	<ul>
			<li>
			<a href="javascript:void(0)" onclick="commercialization('ii')">INVENTOR INFORMATION</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)"  class="active" onclick="commercialization('tech')">TECHNOLOGY</a>
			</li>
            <li class="strip"> &nbsp;</li>
			<li>
			<a href="javascript:void(0)" onclick="commercialization('ip')">INTELLECTUAL PROPERTY</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('com')">COMMERCIALIZATION</a>
			</li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('tech_score')">ANALYTICS</a>
			</li>
			<?php } ?>
		</ul>
    </div>
    </div>
    
