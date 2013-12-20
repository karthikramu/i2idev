<script type="text/javascript" src="<?php echo return_theme_path(); ?>js/jquery.js"></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/thickbox-compressed.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.autocomplete.js'></script>

<link rel="stylesheet" type="text/css" href="<?php echo return_theme_path(); ?>css/jquery.autocomplete.css" />

<link rel="stylesheet" type="text/css" href="<?php echo return_theme_path(); ?>css/thickbox.css" />
<script>
$(function() {
	
	
	$(".product_cat").click(function() { 
		
	
		var cur_sel_id = $(this).attr('id') ;
		var cur_sel_val = $(this).val() ;
		
	
		if(cur_sel_val=='gansh9'){
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
		
		}
		
	
	
		
		$(this).parent().children("."+cur_sel_id).hide();
		$(this).parent().children("."+cur_sel_id).children(".second_child").hide();
		$(this).parent().children("."+cur_sel_id).children(".third_child").hide();
		$("."+cur_sel_id+'#'+cur_sel_val).children('input').attr('checked', false) ;
		$(this).parent().children("."+cur_sel_id+'#'+cur_sel_val).show();
		
	});
	
	
	$(".gansh9_7").click(function(){ 

		$(this).parent().parent().children('li').children('ul.sub_ul').hide();
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
	
	
	
	$(".product_sub_cat.havechild").click(function(){
		var cur_sel_id = $(this).attr('id') ;
		var cur_sel_val = $(this).val() ;

		$("."+cur_sel_id).hide();
		$(".subitems").hide();
		
		$("."+cur_sel_id+'#'+cur_sel_val).children('input').attr('checked', false) ;
		$("."+cur_sel_id+'#'+cur_sel_val).show();
	});
	
		var maxWords = 150;
		jQuery('.impect_areas').keypress(function() {
			var $this, wordcount;
			$this = $(this);
			wordcount = $this.val().split(/\b[\s,\.-:;]*/).length;
			if (wordcount > maxWords) {
				jQuery(".word_count span").text("" + maxWords);
				alert("You've reached the maximum allowed words.");
				return false;
			} else {
				return jQuery(".word_count span").text(wordcount);
			}
		});
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
});
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
			
<div class="wrapper"> 
	<div class="form_container">
	<div class="steps_container">
    	<ul>
        	<li><a href="#" >INFORMATION MODULE I </a></li>
            <li class="strip"> &nbsp;</li>
            <li><a href="#"  class="active">INFORMATION MODULE II</a></li>
            <li class="strip"> &nbsp;</li>
            <li><a href="#">INFORMATION MODULE III</a></li>
            <li class="strip"> &nbsp;</li>
            <li><a href="#">INFORMATION MODULE IV</a></li>
            <li class="strip"> &nbsp;</li>
            <li><a href="#">INFORMATION MODULE V</a></li>
        </ul>
    </div>
    
    		<form action="" name="buy_name" id="question-form" class="question-form" method="post">
				
        	<div class="form_items">
            	<label>4. Invention Title  : </label>
                <input type="text" name="invention_title" />
            </div>
            <div class="form_items">
            	<label>5. Invention Type: </label>
                <input type="radio" id="institutional" name="invention_type" value="patent" /><span class="radio_span">Patent</span>
				<input type="radio" id="institutional" name="invention_type" value="cr_sw" /><span class="radio_span">Copyright or software</span>
				<input type="radio" id="institutional" name="invention_type" value="bio_organism" /><span class="radio_span">Bio-organism</span>
				<input type="radio" id="institutional" name="invention_type" value="know_how" /><span class="radio_span">Know-how</span>
				<input type="radio" id="institutional" name="invention_type" value="other" />
				<input type="text" id="institutional" name="invention_type_other" value="" placeholder="Other" style="width: 100px; font-size: 13px; height: 14px;" /> 
            </div>
			
			
            <div class="form_items">
            	<label>6.(a)Product Category of Invention: </label>
                <input type="radio" id="first_child" name="product_cat" class="product_cat" value="gansh1" /><span class="radio_span">GANSH I</span>
				<input type="radio" id="first_child" name="product_cat" class="product_cat" value="gansh2" /><span class="radio_span">GANSH II</span>
				<input type="radio" id="first_child" name="product_cat" class="product_cat" value="gansh3" /><span class="radio_span">GANSH III</span>
				<input type="radio" id="first_child" name="product_cat" class="product_cat" value="gansh4" /><span class="radio_span">GANSH IV</span>
				<input type="radio" id="first_child" name="product_cat" class="product_cat" value="gansh5" /><span class="radio_span">GANSH V</span>
				
				<!-- first_child -->
				
				<div class="form_items first_child" id="gansh1" style="display:none;">
					<label>6(A).Pick ONLY one : </label>
					<input type="radio" id="gansh6a_1" name="gansh1" class="product_cat" value="gansh9" /><span class="radio_span">Gansh 9</span>
					<input type="radio" id="gansh6a_1" name="gansh1" class="product_cat" value="gansh10" /><span class="radio_span">Gansh 10</span>
					<input type="radio" id="gansh6a_1" name="gansh1" class="product_cat" value="gansh11" /><span class="radio_span">Gansh 11</span>
					
					<!-- Second Child -->
						
						<div class="form_items second_child gansh6a_1" id="gansh9" style="display:none;">
							
							<ul><li>
							<input type="radio" name="gansh9" class="product_sub_cat" value="gansh9_1" /><span class="radio_span">Gansh 9.1(i.e., several applications)</span></li> 
							<li>
							<input type="radio"  name="gansh9" class="product_sub_cat" value="gansh9_2" /><span class="radio_span">Gansh 9.2 </span> </li>
							<li>
							<input type="radio"  name="gansh9" class="product_sub_cat" value="gansh9_3" /><span class="radio_span">Gansh 9.3</span></li>
							<li>
							<input type="radio"  name="gansh9" class="product_sub_cat" value="gansh9_4" /><span class="radio_span">Gansh 9.4 (ab, SiRNA, microRNA, including new age biologicals)</span></li>
							</ul>
						</div>
						
						<div class="form_items second_child gansh6a_1" id="gansh10" style="display:none;">
							<ul><li>
							<input type="radio" name="gansh10" class="product_sub_cat" value="gansh10_1" /><span class="radio_span">Gansh 10.1(i.e., several applications)</span></li><li>
							<input type="radio" name="gansh10" class="product_sub_cat" value="gansh10_2" /><span class="radio_span">Gansh 10.2 </span></li><li>
							<input type="radio" name="gansh10" class="product_sub_cat" value="gansh10_3" /><span class="radio_span">Gansh 10.3</span> </li><li>
							<input type="radio" id="gansh10_4_p" name="gansh10" class="product_sub_cat havechild" value="gansh10_4" /><span class="radio_span">Gansh 10.4</span> </li></ul>
							
							<!-- grand child -->
							 <div class="form_items third_child gansh10_4_p" id="gansh10_4" style="display:none;">
									<label>Drug on Market ? </label>
									<ul><li>
									<input type="radio" id="gansh10_4_1_1" name="gansh10_4_1" class="product_grand_cat havechild" value="yes" /><span class="radio_span">Yes</span>
									<span class="inner_drug" style="display:none"><input type="text" placeholder="Name of Drug" name="name_drug"></span>
									
									</li><li>
									<input type="radio" name="gansh10_4_1" class="product_grand_cat" value="no" /><span class="radio_span">No</span></li><li>
									<input type="radio" name="gansh10_4_1" class="product_grand_cat" value="dont_know" /><span class="radio_span">Don&rsquo;t know</span> </li><li>
									</ul>
							</div>
							
							
						</div>
			
						<div class="form_items second_child gansh6a_1" id="gansh11" style="display:none;">
							<ul><li>
							<input type="radio" name="gansh11" class="product_sub_cat" value="gansh11_1" /><span class="radio_span">Gansh 11.1 (i.e., wide applicability across several research areas)</span></li><li>
							<input type="radio" name="gansh11" class="product_sub_cat" value="gansh11_2"/><span class="radio_span">Gansh 11.2 </span></li><li>
							<input type="radio" name="gansh11" class="product_sub_cat" value="gansh11_3"/><span class="radio_span">Gansh 11.3</span></li><li>
							<input type="radio" name="gansh11" class="product_sub_cat" value="gansh11_4"/><span class="radio_span">Gansh 11.4</span></li><li>
							<input type="radio" name="gansh11" class="product_sub_cat" value="gansh11_4"/><span class="radio_span">Questionnaire/Survey/Assessment Tool</span></li></ul>
						</div>
					
					
					
				</div>
				 <div class="form_items first_child" id="gansh2" style="display:none;">
					<label>6(B)GANSH II - Pick ONLY one </label>
					<input type="radio" id="gansh6a_1" name="gansh2" class="product_cat" value="gansh12" /><span class="radio_span">Gansh 12</span>
					<input type="radio" id="gansh6a_1" name="gansh2" class="product_cat" value="gansh13" /><span class="radio_span">Gansh 13</span>
					<input type="radio" id="gansh6a_1" name="gansh2" class="product_cat" value="gansh14" /><span class="radio_span">Gansh 14</span>
				</div>
				
				 <div class="form_items first_child" id="gansh3" style="display:none;">
					<label>6(C) GANSH III Pick ONLY one </label>
					<input type="radio" id="gansh6a_1" name="gansh3" class="product_cat" value="gansh15" /><span class="radio_span">Gansh 15</span>
					<input type="radio" id="gansh6a_1" name="gansh3" class="product_cat" value="gansh16" /><span class="radio_span">Gansh 16</span>
					<input type="radio" id="gansh6a_1" name="gansh3" class="product_cat" value="gansh17" /><span class="radio_span">Gansh 17</span>
				</div>
				
				 <div class="form_items first_child" id="gansh4" style="display:none;">
					<label>6(D) GANSH IVPick ONLY one </label>
					<input type="radio" id="gansh6a_1" name="gansh4" class="product_cat" value="gansh18" /><span class="radio_span">Gansh 18</span>
					<input type="radio" id="gansh6a_1" name="gansh4" class="product_cat" value="gansh19" /><span class="radio_span">Gansh 19</span>
					<input type="radio" id="gansh6a_1" name="gansh4" class="product_cat" value="gansh20" /><span class="radio_span">Gansh 20</span>
				</div>
				
				 <div class="form_items first_child" id="gansh5" style="display:none;">
					<label>6(E) GANSH V. Pick ONLY one: </label>
					<input type="radio" id="gansh6a_1" name="gansh5" class="product_cat" value="gansh21" /><span class="radio_span">Gansh 21</span>
					<input type="radio" id="gansh6a_1" name="gansh5" class="product_cat" value="gansh22" /><span class="radio_span">Gansh 22</span>
					<input type="radio" id="gansh6a_1" name="gansh5" class="product_cat" value="gansh23" /><span class="radio_span">Gansh 23</span>
				</div>
				
				
				
            </div>
			
			
            <div class="form_items">
            	<label>6.(b) List Specific Impact Areas of Invention : </label>
                <textarea name="impect_areas" class="impect_areas" rows="4" cols="40"/></textarea>
            </div>
			
			

            <div class="form_items question7">
            	<label>7 : Stage of Development of Invention:</label>
                <ul class="gansh9" style="display:none;">
					<li>
					<input type="radio" name="stage_of_devolpment" class="gansh9_7" value="a" /><span class="radio_span">(a) &ldquo;Concept&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="gansh9_7" value="b" /><span class="radio_span">(b) &ldquo;in-silico&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="gansh9_7" value="c" /><span class="radio_span">(c) &ldquo;Knock out or knock down or target data&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="gansh9_7" value="d" /><span class="radio_span">(d) &ldquo;Cell Line&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="gansh9_7 gansh9_7_inner" value="e" /><span class="radio_span">(e) &ldquo;animal data&rdquo;</span>
						
						<ul class="sub_ul" style="display:none;">
						
						
							<li>
							<input type="checkbox" name="stage_of_devolpment_ei" class="product_sub_cat" value="a" /><span class="radio_span">(ei) &ldquo;worm&rdquo;</span></li><li>
							<input type="checkbox" name="stage_of_devolpment_eii" class="product_sub_cat" value="b" /><span class="radio_span">(b) &ldquo;mice or rat&rdquo;</span></li><li>
							<input type="checkbox" name="stage_of_devolpment_eiii" class="product_sub_cat" value="c" /><span class="radio_span">(c) &ldquo;rabbit or dog or monkey&rdquo;</span></li><li>
							<input type="checkbox" name="stage_of_devolpment_eiv" class="product_sub_cat" value="d" /><span class="radio_span">(d) &ldquo;human clinical data&rdquo;</span></li><li>
							<input type="checkbox" name="stage_of_devolpment_ev" class="product_sub_cat" value="d" /><span class="radio_span">(d) &ldquo;prototype&rdquo;</span> </li>					
					</ul>
				</li>
				</ul>

				<ul class="gansh10" style="display:none;">
					<li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="a" /><span class="radio_span">(a) &ldquo;Concept&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="b" /><span class="radio_span">(b) &ldquo;Cell Line&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="c" /><span class="radio_span">(c) &ldquo;Animal data&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="d" /><span class="radio_span">(d) &ldquo;Human clinical&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="e" /><span class="radio_span">(e) &ldquo;Prototype&rdquo;</span></li>
					
				</ul>
				
				<ul class="gansh11" style="display:none;">
					<li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="a" /><span class="radio_span">(a) &ldquo;Concept&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="b" /><span class="radio_span">(b) &ldquo;Internal testing&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="c" /><span class="radio_span">(c) &ldquo;Publication submitted&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="d" /><span class="radio_span">(d) &ldquo;beta-testing of research tool via academic collaboration&rdquo;</span></li><li>
					<input type="radio" name="stage_of_devolpment" class="product_sub_cat" value="e" /><span class="radio_span">(e) &ldquo;beta-testing of research tool via industry collaboration&rdquo;</span></li>
					
				</ul>
				
            </div>
			
			
			
            <div class="form_items">
            	<label>8. Abstract of Invention:   </label>
                <textarea name="abstract_invantion" class="abstract_invantion" rows="4" cols="40"/></textarea>
            </div>
			
			
			
            <div class="form_items">
            	<label>9.	(a) Funding Source for Invention. Pick ALL that apply (A through D) </label>
					<input type="checkbox"  name="funding_source_government" class=""  /><span class="radio_span">(A) Government</span>
					<input type="checkbox"  name="funding_source_industry" class=""  /><span class="radio_span">(B) Industry</span>
					<input type="checkbox"  name="funding_source_foundation" class=""  /><span class="radio_span">(C) Foundation</span>
					<input type="checkbox"  name="funding_source_other" class="" 	 /><span class="radio_span">(D) Other</span>
            </div>
			
			
            <div class="form_items">
            	<label>9. (b) Principal Investigator (PI) on Grant/Agreement: </label>
					<input type="text" name="principal_investigator" />
            </div>
			
			
            <div class="form_items">
            	<label>9. (c) Entity Name :</label>
					<input type="text" name="entitiy_name" />
            </div>
			
			
            <div class="form_items">
            	<label>9. (d) Fund number or Agreement Number: </label>
					<input type="text" name="agrement_number" />
            </div>
			
			
            <div class="form_items">
            	<label>9. (e) Amount of funding & grant period: </label>
					<input type="text" name="amount_of_funding" />
            </div>
			
			
			
			
			
            <div class="form_action" style="width:700px;">
            	<input class="left" type="submit" name="Submit" value="Save & Exit" />
				 <input type="submit" name="next" value="Go to MODULE III" />
            </div>
        </form>
    </div>
    