<?php //die("here");?> 
 <script  type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.tipsy.js'></script>

<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.validation.js'></script>
<link rel="stylesheet" href="<?php echo return_theme_path(); ?>css/tipsy.css" type="text/css" />


<style>
	.form_items ul li{
		clear: both;
		float: left;
	}
	.form_items ul{
		
		padding-left:110px;
	}
	
	.hasDatepicker, .datepick, .othertext,.companies{
	width: 60px !important; height: 14px;font-size: 10px !important; 
	}
	.doc_class{
	 font-size: 9px !important;
    height: 22px;
    margin-top: 0 !important;
    width: 60px !important;
	}
.prior_inventions_result.customb th{padding:0px !important;}
	.gsc-branding-text{
	display:none;
	}
	.gsc-branding-img-noclear{
	display:none;
	}
	
	
	.result11class {
    margin: 10px 0;
	}
	.result11class p{line-height:normal; margin: 5px 0;}
	
	.result11class a{ color:#0000FF;}
	
	
	.prior_inventions_result  td{ /*padding:10px 5px;*/}

.prior_inventions_result tr{position: relative;}

.prior_inventions_result label.error {
    float: inherit;
    font-size: 12px;
    left: 34px;
    margin-top: 17px;
    position: absolute;
}

.validation {
color: #D63301;
background-color: #FFCCBA;
}
</style>
<script type="text/javascript">


$(function() {

$('#done').live('click',function (evt) {

	var errorcount='';
	$('.parentpluschild').each(function(){
	
		var radio=$(this).find('input[type=radio]:checked').val();
		if(radio=='In-disk' || radio=='Yes'){
			
			var status='';
			$(this).children('.child').find('.funding_source_chk').each(function(){
			
				if($(this).attr('checked')){
					
					status='selected';
				}
				
			}); 
			
			if(status==''){
				errorcount='error';
				$(this).children('.child').find('.lierror').html('<span style="color:red">Please select atleast one.</span>');
				//alert('Please select atleast one.');	
			}else{
					$(this).children('.child').find('.lierror').html('');
			}
		
		}else{
		
			$(this).children('.child').find('.lierror').html('');
		}
		
	});
	if(errorcount!=''){
		return false;
	}

	$("#question_form3").validate({
	
	 rules: {
			products_count: {

			number: true,
			range: [1,5]
			},
			big_company_count: {

			number: true
			},
			small_company_count: {

			number: true
			
			},
			
	},
	});
	 
});

	$("input[name='products_exist']").live('click',function(){ 
		var result=$(this).val();
		if(result=="Yes"){
			
			$( "input[name='products_count']" ).prop( "disabled", false );
			$( "input[name='products_count']" ).addClass('required');
			$('#products_exist_yes').show();
			$( "input[name='product_count']" ).prop( "disabled", false );
			$( "input[name='product_count']" ).addClass('required');
			
			
		}else{
			$( "input[name='products_count']" ).val('');
			$( "input[name='product_count']" ).removeClass('required');
			$( "input[name='products_count']" ).removeClass('required');
			$('#products_exist_yes').hide();
			$("input[name='product_count']").each(function(){
			$(this).checked = false;  
			});
			
			$( "input[name='products_count']" ).prop( "disabled", true );
			$( "input[name='product_count']" ).prop( "disabled", true );
		}
	});
	
	$("input[name='product_count']").live('click',function(){ 
		var result=$(this).val();
		if(result=="Yes"){
			$( "input[name='products_name']" ).prop( "disabled", false );
			$( "input[name='products_name']" ).addClass('required');
			
		}else{
			$( "input[name='products_name']" ).prop( "disabled", true );
			$( "input[name='products_name']" ).val('');
			$( "input[name='products_name']" ).removeClass('required');
		}
	});
 

//add more

		$("#add_more_inventors").click(function(){ 
	
		var sub_count = 0 ;
		$("#parent-filds").children('.parentpluschild').each(function(){
			sub_count++;
		
		});
		
		$("#parent-filds").children('#add_more').before('<div class="parentpluschild subchild"><a href="javascript:void(0)" class="close_child">X</a><div class="parent"><label>13(a)  Are you working/have you worked with any company/ies (including ones you have founded) in projects related to the invention?</label><ul><li><input type="radio" class="autosave required" id="have_worked" name="invention['+sub_count+'][have_worked]" value="Yes" /><span class="yes_no">YES</span></li><li class="no"><input type="radio" class="autosave required" id="have_worked1" name="invention['+sub_count+'][have_worked]" value="In-disk" /><span class="yes_no">IN-DISC </span></li><li class="no"><input type="radio" class="autosave required" id="have_worked2" name="invention['+sub_count+'][have_worked]" value="No" /><span class="yes_no">NO</span></li></ul></div><div class="child" style="display:none;"><label>(b)	Name of Company <input type="text"  id="company_name" class="cmpny_name" name="invention['+sub_count+'][company_name]" /></label><label>(c)	Type of collaboration (check ALL that apply)</label><ul><li><input type="checkbox" class="funding_source_chk" name="invention['+sub_count+'][mta]" value="MTA" /><span class="radio_span">MTA</span></li><li><input type="checkbox" class="funding_source_chk" name="invention['+sub_count+'][sra]" value="SRA" /><span class="radio_span">SRA</span></li><li><input type="checkbox" class="funding_source_chk" name="invention['+sub_count+'][scientific]" value="Scientific" /><span class="radio_span">Scientific Collaboration (no materials or funds transferred)</span></li><li><input type="checkbox" class="funding_source_chk" name="invention['+sub_count+'][clinical_trial]" value="Clinical Trial" /><span class="radio_span">Clinical Trial</span></li><li><input type="checkbox" class="funding_source_chk" name="invention['+sub_count+'][consulting]" value="Consulting" /><span class="radio_span">Consulting</span></li><li><input type="checkbox" class="funding_source_chk" name="invention['+sub_count+'][other]" value="Other" /><span class="radio_span">Other</span><input type="text" name="invention['+sub_count+'][textother]" class="othertext" ></li><li class="lierror"></li></ul><input type="hidden" name="invention['+sub_count+'][project_id]" class="project_id" value="new" /></div></div>');
			
	});
	
	$(".autosave").live('click',function(){ 
		var result=$(this).val();
		
		if(result=="Yes" || result=='In-disk'){
		
			$(this).parent().parent().parent().parent().children('.child').show();
			
		}else{
			
			$(this).parent().parent().parent().parent().children('.child').hide();
		}
	});
	
	$(".close_child").live('click',function(){ 
			/* var project_id = '';
			project_id = 	$(this).parent().find('.project_id').val();
		
			//return false;
			if(project_id!='new'){
				$.ajax({
					url: "<?php echo site_url('user/home/invention_project_delete');?>",
					data: 'project_id='+project_id,
					type: "POST",
					success: function(response) {
						
					}
				}); 
				}
			 */
			$(this).parent().remove();
			autosave();
	});

//add more

	
	});
	
	
$(".autosave").live('click',function(){
 
		autosave();

});
$(".radio_15").live('click',function(){
 
		autosave();
		
});

$(".cmpny_name").live('blur',function(){
 
		autosave();

});

$(".funding_source_chk").live('click',function(){
	//alert($(this).val());
	
	$('.parentpluschild').each(function(){
	
		var radio=$(this).find('input[type=radio]:checked').val();
		
		//alert(radio);
		if(radio=='In-disk' || radio=='Yes'){
			
			var status='';
			$(this).children('.child').find('.funding_source_chk').each(function(){
			
				if($(this).attr('checked')){
					
					status='selected';
				}
				
			}); 
			
			if(status==''){
				$(this).children('.child').find('.lierror').html('<span style="color:red">Please select atleast one.</span>');
				//alert('Please select atleast one.');	
			}else{
					$(this).children('.child').find('.lierror').html('');
			}
		
		}else{
		
			$(this).children('.child').find('.lierror').html('');
		}
		
	});
	
	
		autosave();

});
$(".radio_15b").live('click',function(){
 
		autosave();

});

$("input[name$='products_name']").live('blur',function(){
 
		autosave();

});
$("input[name$='search_15']").live('blur',function(){
 
		autosave();

});
$("input[name$='products_count']").live('blur',function(){
 
		autosave();

});

$("input[name$='big_company_count']").live('blur',function(){
 
		autosave();

});
$("input[name$='small_company_count']").live('blur',function(){
 
		autosave();

});
$("input[name$='text_pdfsearch']").live('blur',function(){
 
		autosave();

});

$("#signature").live('click',function(){

	$('#fileq1').show();	
});
	
function autosave(){
		var form1 = $("#question_form3").serialize();
			$.ajax({
				url: "<?php echo site_url('user/home/form4_save');?>",
				data: form1,
				type: "POST",
				success: function(response) {
					$('.progressspan').html(response);
				}
			}); 
	}
function commercialization(page){
	
	$('#link_redir_page').val(page);
	$('#done').trigger('click');
	//$( "#question_form2" ).submit();
	
}

</script>

<script src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
      
      google.load('search', '1');

      var patentSearch;
	  
	  function searchCompleteMedical() {
		$("#result").html("");
        document.getElementById('content').innerHTML = '';
        if (patentSearch.results && patentSearch.results.length > 0) {
			var return_html='';
			var title_array_15a=new Array();
			for (var i = 0; i < patentSearch.results.length && i<10; i++) {

		    var a = title_array_15a.indexOf(patentSearch.results[i].title);
			if(a == '-1'){ 
		  
			   return_html +='<div class="result11class"><a href="'+ patentSearch.results[i].unescapedUrl+'" target="_blank">'+patentSearch.results[i].title+'</a><p>'+patentSearch.results[i].content+'</p><input type="hidden" name="result_15b['+i+'][title]" value="'+patentSearch.results[i].title+'"/><input type="hidden" name="result_15b['+i+'][link]" value="'+ patentSearch.results[i].unescapedUrl+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div><textarea style="display:none" name="result_15b['+i+'][desc]">'+ patentSearch.results[i].content+'</textarea>';
			   
				title_array_15a[i]=patentSearch.results[i].title;
		    }
          }
		  $("#result").html(return_html);
        }
      }
	  
	  

      function searchComplete() {
		$("#result").html("");
        document.getElementById('content').innerHTML = '';
        if (patentSearch.results && patentSearch.results.length > 0) {
			var return_html='';
			var title_array_15a=new Array();
			for (var i = 0; i < patentSearch.results.length && i<10; i++) {

		    var a = title_array_15a.indexOf(patentSearch.results[i].title);
			if(a == '-1'){ 
		  
			   return_html +='<div class="result11class"><a href="'+ patentSearch.results[i].unescapedUrl+'" target="_blank">'+patentSearch.results[i].title+'</a><p>'+patentSearch.results[i].content+'</p><input type="hidden" name="result_15b['+i+'][title]" value="'+patentSearch.results[i].title+'"/><input type="hidden" name="result_15b['+i+'][link]" value="'+ patentSearch.results[i].unescapedUrl+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b['+i+'][radio_15b]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div><textarea style="display:none" name="result_15b['+i+'][desc]">'+ patentSearch.results[i].content+'</textarea>';
			   
				title_array_15a[i]=patentSearch.results[i].title;
		    }
          }
		  $("#result").html(return_html);
        }
      }
	  
	  
	  var seekingalphasearch;
      function searchComplete3() {
		$("#search_15").html("");
		var title_array_seek = new Array();
        document.getElementById('content3').innerHTML = '';
        if (seekingalphasearch.results && seekingalphasearch.results.length > 0) {
			var return_html3='';
			//alert(seekingalphasearch.results.length);
			//return false;
          for (var l = 0; l < seekingalphasearch.results.length; l++) {
		  
		  var q = title_array_seek.indexOf(seekingalphasearch.results[l].title);
		  if(q == '-1'){ 
//alert(l);
		   return_html3 += '<div class="result11class"><a href="'+seekingalphasearch.results[l].unescapedUrl+'" target="_blank">'+seekingalphasearch.results[l].title+'</a><p>'+seekingalphasearch.results[l].content+'</p><input type="hidden" name="result_15['+l+'][title]" value="'+seekingalphasearch.results[l].title+'"/><input type="hidden" name="result_15['+l+'][link]" value="'+seekingalphasearch.results[l].unescapedUrl+'"/><input type="hidden" name="result_15['+l+'][desc]" value="'+seekingalphasearch.results[l].content+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+l+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+l+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+l+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+l+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+l+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
		   title_array_seek[l]=seekingalphasearch.results[l].title;
			}
          }
		  //alert(return_html3);
		  $("#search_15").html(return_html3);
        }
      }
    <?php   
			$search="";
		    if(isset($page_data['invention_data']) && !empty($page_data['invention_data'])){
				if(!empty($page_data['invention_data']['impect_areas'])){
				
					$search=$page_data['invention_data']['impect_areas'];
					
				}
			}	
    ?>
      function onLoad(search) {
	
        patentSearch = new google.search.WebSearch();
        patentSearch.setSearchCompleteCallback(this, searchComplete, null);
		patentSearch.setResultSetSize(8);
		//patentSearch.setResultOrder(google.search.Search.ORDER_BY_RELEVANCE );
        patentSearch.execute(search+' company site:.com');
        google.search.Search.getBranding('branding');
      }
	  
	  function onLoad3(search) {
		
		/*
		if(search!=''){
		search=$.trim(search);
		var myArr = search.split(" ");
		var index;
		var preposition_array=["for" , "the" , "and" , "to" , "a" , "an" , "of" , "is" , "am" , "are" , "was" , "has" , "have" ,"had" , "been" , "by" ,"on" ,"will","shall","or","in","this","that","these","those","as"];
		var search_array = [];
		for (index = 0; index < myArr.length; ++index) {
			if(jQuery.inArray( myArr[index], preposition_array)>=0){
				//alert(myArr[index]);
			}else{
				//search_array[]=myArr[index];
				search_array.push( myArr[index] );
			}
		}
		var search_string='';
		var indexx;
		if( search_array.length>0 ){
			var length=search_array.length-1;
			
			for (indexx = 0; indexx < search_array.length; ++indexx) {
				if( indexx < length){
				
					search_string = search_string+search_array[indexx]+' OR ';
					
				}else{
				
					search_string = search_string+search_array[indexx];
					
				}
			}
		
		}
		*/
        seekingalphasearch = new google.search.WebSearch();
        seekingalphasearch.setSearchCompleteCallback(this, searchComplete3, null);
		seekingalphasearch.setResultSetSize(8);
		//seekingalphasearch.execute(search_string+' site:http://seekingalpha.com');
		seekingalphasearch.execute(search+' site:http://seekingalpha.com');
        google.search.Search.getBranding('branding3');
		//}
      }
	  
	  
	  
	    function onLoadMedical(search) {
		
		
        patentSearch = new google.search.WebSearch();
        patentSearch.setSearchCompleteCallback(this, searchCompleteMedical, null);
		patentSearch.setResultSetSize(8);
		//seekingalphasearch.execute(search_string+' site:http://seekingalpha.com');
		patentSearch.execute(search+' site:http://seekingalpha.com');
        google.search.Search.getBranding('branding3');
		//}
      }
	  
	  
</script>
<script type="text/javascript">
$(document).ready(function(){
	//var comman_title  = new Array();
	
	
	$("#search_15").html("");
		$("#result").html("");
		$("#search_15_rele").html("");
	
	var ajaxReq = null; 
	var ajaxReq1 = null; 
	var ajaxReq2 = null; 
	$("input[name='search_15']").live('keyup',function(){
	
		var comman_title  = new Array();
		var search='';
		var for_search_part='';
		var site_content1='';
		var site_content2='';
		var site_content3='';
		
		$("#myresult").html("");
		$("#result").html("");
		var id		= $("input[name='invention_id']").val();
		search	= $("input[name='search_15']").val();
	
		if(search!=''){
			
			if (ajaxReq != null){

				ajaxReq.abort();
			}
			ajaxReq = $.ajax({
			url: '<?php echo  site_url('user/home/api_search_15'); ?>',
			data: { id : id , search : search },
			type: "POST",
			dataType: "Json",
			success: function(response){
			
				var result = eval(response);
			
				for_search_part=result.for_search_part;
				
				if(for_search_part=='for_nonmedical'){
					
					google.setOnLoadCallback(onLoad3(search));
					
				}
				
				if(for_search_part=='for_15_1'){
					
					site_content1=result.site_content1;
					site_content2=result.site_content2;
					site_content3=result.site_content3;
					
				
					var i = 1 ; 
					var return_html1="";
					$(site_content1).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=5){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//var link=$(this).find(".search-result-title").children('a').attr("href");
					//alert(i);
					
					var b = comman_title.indexOf( title );
				if(b == '-1'){
					if(i <=4){
					
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title[i]= title;
					comman_title.push( title );
					i++;
					}
					}
					});
					
					$(site_content2).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=10){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//alert(i);
					
					var c = comman_title.indexOf( title );
				if(c == '-1'){
					if(i <=7){
				
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					
					//comman_title[i]= title;
					comman_title.push( title );
					i++;
					}
					}
					}); 
					
					
						$(site_content3).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=10){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//alert(i);
					
					var a = comman_title.indexOf( title );
				if(a == '-1'){
					if(i <=10){
				
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					
					//comman_title[i]= title;
					comman_title.push( title );
					i++;
					}
					}
					}); 
					
					
					
					$("#search_15").html(return_html1);
				}
				
				if(for_search_part=='for_15_2'){
				
					site_content1=result.site_content1;
					site_content2=result.site_content2;
					
					
					var i = 1 ; 
					var return_html1="";
					$(site_content1).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=5){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//alert(i);
					
				var d = comman_title.indexOf( title );
				if(d == '-1'){
					if(i <=5){
					
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title[i]= title;
					comman_title.push( title );
					i++;
					}
					}
					});
					
					$(site_content2).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=10){
					
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					
					var e = comman_title.indexOf( title );
				if(e == '-1'){
					if(i <=10){
					
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title[i]= title;
					comman_title.push( title );
					i++;
					}
					}
					});
					
					$("#search_15").html(return_html1);
					
				}
				
				if(for_search_part=='for_15_3'){
				
					site_content1=result.site_content1;
					
					var i = 1 ; 
					var return_html1="";
					$(site_content1).find('.search-results').find('.search-result').each(function(){
						
					//if(i <=10){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					var f = comman_title.indexOf( title );
				if(f == '-1'){
					if(i <=10){
					
						
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title[i]= title;
					comman_title.push( title );
					i++;
					}
					}
					});
					
					$("#search_15").html(return_html1);
				} 
			} 
			});
			
		//	google.setOnLoadCallback(onLoad(search));
		}
		
		
		<!-----------------------relevance search---------------------------------------------->
		
		
		var comman_title_rele_rele  = new Array();
		var for_search_part='';
		var site_content_rel_1='';
		var site_content_rel_2='';
		var site_content_rel_3='';
		
		if(search!=''){
			
			if (ajaxReq1 != null){

				ajaxReq1.abort();
			}
			ajaxReq1 = $.ajax({
			url: '<?php echo  site_url('user/home/api_search_15_relevance'); ?>',
			data: { id : id , search : search },
			type: "POST",
			dataType: "Json",
			success: function(response){
			
				var result = eval(response);
			
				for_search_part=result.for_search_part;
				
				if(for_search_part=='for_nonmedical'){
					
					google.setOnLoadCallback(onLoad3(search));
					
				}
				
				if(for_search_part=='for_15_1'){
					
					site_content1=result.site_content1;
					site_content2=result.site_content2;
					site_content3=result.site_content3;
					
					
					
				
					var i = 1 ; 
					var return_html_relev="";
					$(site_content1).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=5){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//var link=$(this).find(".search-result-title").children('a').attr("href");
					//alert(i);
					
					var b = comman_title_rele_rele.indexOf( title );
				if(b == '-1'){
					if(i <=4){
					
					return_html_relev += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title_rele[i]= title;
					comman_title_rele_rele.push( title );
					i++;
					}
					}
					});
					
					$(site_content2).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=10){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//alert(i);
					
					var c = comman_title_rele_rele.indexOf( title );
				if(c == '-1'){
					if(i <=7){
				
					return_html_relev += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					
					//comman_title_rele[i]= title;
					comman_title_rele_rele.push( title );
					i++;
					}
					}
					}); 
					
					
						$(site_content3).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=10){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//alert(i);
					
					var a = comman_title_rele_rele.indexOf( title );
				if(a == '-1'){
					if(i <=10){
				
					return_html_relev += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					
					//comman_title_rele[i]= title;
					comman_title_rele_rele.push( title );
					i++;
					}
					}
					}); 
					
					
					
					$("#search_15_rele").html(return_html_relev);
				}
				
				if(for_search_part=='for_15_2'){
				
					site_content1=result.site_content1;
					site_content2=result.site_content2;
					
					
					
					var i = 1 ; 
					var return_html1="";
					$(site_content1).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=5){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//alert(i);
					
				var d = comman_title_rele_rele.indexOf( title );
				if(d == '-1'){
					if(i <=5){
					
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title_rele[i]= title;
					comman_title_rele_rele.push( title );
					i++;
					}
					}
					});
					
					$(site_content2).find('.search-results').find('.search-result').each(function(){	 
					//if(i <=10){
					
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					
					var e = comman_title_rele_rele.indexOf( title );
				if(e == '-1'){
					if(i <=10){
					
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title_rele[i]= title;
					comman_title_rele_rele.push( title );
					i++;
					}
					}
					});
					
					$("#search_15_rele").html(return_html1);
					
				}
				
				if(for_search_part=='for_15_3'){
				
					site_content1=result.site_content1;
					
					var i = 1 ; 
					var return_html1="";
					$(site_content1).find('.search-results').find('.search-result').each(function(){
						
					//if(i <=10){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					var f = comman_title_rele_rele.indexOf( title );
				if(f == '-1'){
					if(i <=10){
					
						
					return_html1 += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title_rele[i]= title;
					comman_title_rele_rele.push( title );
					i++;
					}
					}
					});
					
					$("#search_15_rele").html(return_html1);
				} 
			} 
			});
			//google.setOnLoadCallback(onLoad(search));
		}
		
		
		
	<!--------------	relevance search ends here -------------------------->
		
		
		
		
		
		
		
		<!--	15 a result-->
	
		var comman_title_15a  = new Array();	
		var for_search_part='';
		var site_content1='';
	
	
	if(search!=''){
			
			if (ajaxReq2 != null){

				ajaxReq2.abort();
			}
			ajaxReq2 = $.ajax({
			url: '<?php echo  site_url('user/home/api_search_15_a'); ?>',
			data: { id : id , search : search },
			type: "POST",
			dataType: "Json",
			success: function(response){
			
				var result = eval(response);
			
				for_search_part=result.for_search_part;
				
		
				
				if(for_search_part=='for_15_1'){
					
					
					google.setOnLoadCallback(onLoadMedical(search));
					site_content1=result.site_content1;
				
					
					
					
				
					var i = 1 ; 
					var return_html15a="";
					$(site_content1).find('.search-results').find('.search-result').each(function(){
																													 
					//if(i <=5){
					//alert($(this).find(".title").children('a').html());
					var title=$(this).find(".search-result-title").children('a').html();
					var link=$(this).find(".search-result-title").children('a').attr("href");
					
					
					
					
					var desc=$(this).find(".search-snippet").html();
					//var byline=$(this).find(".byline").html();
					//var link=$(this).find(".search-result-title").children('a').attr("href");
					//alert(i);
					
					var b = comman_title_15a.indexOf( title );
				if(b == '-1'){
					if(i <=4){
					
					return_html15a += '<div class="result11class"><a href="'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><input type="hidden" name="result_15['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_15['+i+'][link]" value="'+link+'"/><input type="hidden" name="result_15['+i+'][desc]" value="'+desc+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15 required" name="result_15['+i+'][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio"  class="radio_15 required" name="result_15['+i+'][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					//comman_title[i]= title;
					comman_title_15a.push( title );
					i++;
					}
					}
					});
				
					$("#result").html(return_html15a);
				}
				
						if(for_search_part=='for_nonmedical'){
					
					google.setOnLoadCallback(onLoad3(search));
					
				}
					
			
			} 
			});
			
			//google.setOnLoadCallback(onLoadMedical(search));
		}
	
	
	<!------15 a result------------->
		
		
	
		
		
		
		
		
	});

	});
	
      var pdfSearch;
      function searchComplete1() {
		$("#pdfresult").html("");
        
        document.getElementById('content1').innerHTML = '';
        if (pdfSearch.results && pdfSearch.results.length > 0) {
			var return_html='';
          for (var i = 0; i < pdfSearch.results.length && i<10; i++) {
		  
		   return_html +='<div class="result11class"><a href="'+ pdfSearch.results[i].unescapedUrl+'" target="_blank">'+pdfSearch.results[i].title+'</a><p></p><input type="hidden" name="result_15c['+i+'][title]" value="'+pdfSearch.results[i].title+'"/><input type="hidden" name="result_15c['+i+'][link]" value="'+ pdfSearch.results[i].unescapedUrl+'"/></div>';
          
		  }
		  $("#pdfresult").html(return_html);
        }
      }
	
	function onLoad1(search){
        pdfSearch = new google.search.WebSearch();
        pdfSearch.setSearchCompleteCallback(this, searchComplete1, null);
		//pdfSearch.setResultSetSize(8);
        pdfSearch.execute(search+' market size filetype:pdf');
        //pdfSearch.execute(search+' site:http://seekingalpha.com');
        google.search.Search.getBranding('branding1');
    }
	  
	$(document).ready(function(){
		$("input[name='text_pdfsearch']").live('keyup',function(){
			var pdfsearch='';
			$("#pdfsearch").html("");
			pdfsearch	= $("input[name='text_pdfsearch']").val();
			if(pdfsearch!=''){
				//alert(pdfsearch);
				google.setOnLoadCallback(onLoad1(pdfsearch));
			}
		});
	});
	
</script>
	
    <?php 
	
	//print_pre($page_data['invention_data']);die;
		$title='';
		$have_worked='';
		$estimated_size='';
		$products_exist='';
		$product_count='';
		$products_count='';
		$products_name='';
		$limitations='';
		$style='style="display:none;"';
		$impect_areas='----';
		$disable='disabled';
		$result_15b = '';
		$result_15 = '';
		$search_15="";
		$progress=0;
		$pdfresult='';
		$text_pdfsearch='';
		$big_company_count='';
		$small_company_count='';
		$category_invention = '';
		$cat_invention_1 	= '';
		$cat_invention_2 ='';
		$impect_areas  ='';
		if(isset($page_data['invention_data'])){
		
		//print_pre($page_data['invention_data']['cat_invention_2']);die;
			
			$title 							= $page_data['invention_data']['title'] ; 
			
			$category_invention = !empty($page_data['invention_data']['category_invention']) ? $page_data['invention_data']['category_invention'] :'' ; 
			$cat_invention_1 	= !empty($page_data['invention_data']['cat_invention_1']) ? $page_data['invention_data']['cat_invention_1'] : '' ; 
			$cat_invention_2 	= !empty($page_data['invention_data']['cat_invention_2']) ? $page_data['invention_data']['cat_invention_2'] : ''; 
			
			$impect_areas  	= !empty($page_data['invention_data']['impect_areas ']) ? $page_data['invention_data']['impect_areas '] : '';  
			
			if($page_data['invention_data']['result_15b']!=''){
			$result_15b 						= json_decode($page_data['invention_data']['result_15b'],true);
		
			}
			
			if($page_data['invention_data']['text_pdfsearch']!=''){
			$text_pdfsearch 						= $page_data['invention_data']['text_pdfsearch'];
		
			}
			if($page_data['invention_data']['big_company_count']!=''){
			$big_company_count 						= $page_data['invention_data']['big_company_count'];
		
			}
			if($page_data['invention_data']['small_company_count']!=''){
			$small_company_count 						= $page_data['invention_data']['small_company_count'];
		
			}
			
			if($page_data['invention_data']['pdfresult']!=''){
			$pdfresult 						= json_decode($page_data['invention_data']['pdfresult'],true);
		//print_r($pdfresult);die;
			}
			
			if($page_data['invention_data']['result_15']!=''){
			$result_15 						= json_decode($page_data['invention_data']['result_15'],true);
		
			}
			
			if($page_data['invention_data']['search_15']!=''){
			$search_15 						= $page_data['invention_data']['search_15'];
		
			}
			
			if(!empty($page_data['invention_data']['have_worked'])){
				$have_worked = $page_data['invention_data']['have_worked'];
				
				if($have_worked=='Yes' || $have_worked=='In-disk'){
					$style='style="display:block;"';
				}
			}	
			
			if(!empty($page_data['invention_data']['estimated_size'])){
				$estimated_size = $page_data['invention_data']['estimated_size'];
			}	
			
			if(!empty($page_data['invention_data']['impect_areas'])){
				$impect_areas = $page_data['invention_data']['impect_areas'];
			}		
			
			if(!empty($page_data['invention_data']['products_exist'])){
			
				$products_exist = $page_data['invention_data']['products_exist'];
				if($products_exist=='Yes'){
					
					$disable='';
					if(!empty($page_data['invention_data']['products_count'])){
						$products_count = $page_data['invention_data']['products_count'];
					}
					
					if(!empty($page_data['invention_data']['product_count'])){
						$product_count = $page_data['invention_data']['product_count'];
						if($product_count=='Yes'){
							if(!empty($page_data['invention_data']['products_name'])){
								$products_name = $page_data['invention_data']['products_name'];
							}
						}
					}
					
				}
			}	
			
			if(!empty($page_data['invention_data']['limitations'])){
				$limitations = $page_data['invention_data']['limitations'];
			}
			
			if(!empty($page_data['invention_data']['progress'])){
				$progress = $page_data['invention_data']['progress'];
			}
			
		}
//die($have_worked );
	
	?>

<div class="wrapper"> 
	<div class="form_container">
	<div class="steps_container">
		<b style="font-size:17px;">Invention No:
		<?php 
			echo $page_data['invention_data']['id'];
			if($title!=""){ echo ' ( '.ucwords($title).' )'; }else{
				echo ' ( N/A )';
			}
		?>	
		</b>
    	<ul>
        	<li>
			<a href="javascript:void(0)" onclick="commercialization('ii')">INVENTOR INFORMATION</a>
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
			<a href="javascript:void(0)" class="active" onclick="commercialization('com')">COMMERCIALIZATION</a>
			</li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('com_score')">ANALYTICS</a>
			<?php } ?>
			</li>
        </ul>
    </div>
	<!--
	<div>
		<span class="prev">
		<a href="javascript:void(0)" onclick="commercialization('ip')">&lt;&lt;</a>
		</span>
	</div>
	-->
	<div>
	
		<?php 
		
			if(isset($page_data['not_filled']) && !empty($page_data['not_filled'])){
		
			?>
				<div style=" background: none repeat scroll 0 0 #FFCCBA;display: table;margin: 10px auto;padding: 10px;    width: auto;">
				<div style="float:left;" class="validation">
					<img src="<?php echo return_theme_path();?>images/erroricon.png" />
				</div>
				<div style="float:left;" class="validation">
				<p style="text-align: center;">
				<b>Please complete following Questions:</b><br/>
			<?php 
				$count=count($page_data['not_filled']);
				$q=1;
				foreach( $page_data['not_filled'] as $key=>$value ){
					echo $value;
					if($q<$count){
						echo ',';
					}else{
						echo '.';
					}
					$q++;
				}
			?>	
				</p>
				</div>
				</div>
			<?php 
			}
		
		?>
	</div>
    		<form action="" name="buy_name" id="question_form3" class="question-form question-form-3" enctype="multipart/form-data" method="post">
		
        <div class="form_items" id="parent-filds">
		
			<?php 
		//print_pre($page_data['project']);die;
		
		if(isset($page_data['project']) && !empty($page_data['project'])){
			$j=0;
			foreach( $page_data['project'] as $results){
			?>
			
			<div class="parentpluschild subchild">
				<?php if($j!=0){?>
						<a href="javascript:void(0)" class="close_child">X</a>
					<?php } ?>
				<div class="parent">
					<label>13(a)  Are you working/have you worked with any company/ies (including ones you have founded) in projects related to the invention? </label>
					<ul>
						<li>
							<input type="radio" class="autosave required" id="have_worked" name="invention[<?php echo $j;?>][have_worked]" <?php if($results['have_worked']=="Yes"){ echo "checked";}?> value="Yes" /><span class="yes_no">YES</span>
								
						</li>
						<li class="no">
							<input type="radio" class="autosave required" id="have_worked1" name="invention[<?php echo $j;?>][have_worked]" <?php if($results['have_worked']=="In-disk"){ echo "checked";}?> value="In-disk" /><span class="yes_no">IN-DISC </span>
						</li>
						<li class="no">
							<input type="radio" class="autosave required" id="have_worked2" name="invention[<?php echo $j;?>][have_worked]" <?php if($results['have_worked']=="No"){ echo "checked";}?> value="No" /><span class="yes_no">NO</span>
						</li>
					</ul> 
				</div>
			
				<div class="child" <?php if($results['have_worked']=="No"){ echo 'style="display:none;"';}?>>		
						<label>(b)	Name of Company <input type="text"  id="company_name" class="cmpny_name" name="invention[<?php echo $j;?>][company_name]" value="<?php if(!empty($results['company_name'])){ echo $results['company_name'];}?>" /></label>   
						<label>(c)	Type of collaboration (check ALL that apply)</label> 
						<ul>
						<li><input type="checkbox" class="funding_source_chk" name="invention[<?php echo $j;?>][mta]" <?php if($results['mta']=='MTA'){ echo "checked"; }?> value="MTA" /><span class="radio_span">MTA</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[<?php echo $j;?>][sra]" <?php if($results['sra']=='SRA'){ echo "checked"; }?> value="SRA" /><span class="radio_span">SRA</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[<?php echo $j;?>][scientific]" <?php if($results['scientific']=='Scientific'){ echo "checked"; }?> value="Scientific" /><span class="radio_span">Scientific Collaboration (no materials or funds transferred)</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[<?php echo $j;?>][clinical_trial]" <?php if($results['clinical_trial']=='Clinical Trial'){ echo "checked"; }?> value="Clinical Trial" /><span class="radio_span">Clinical Trial</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[<?php echo $j;?>][consulting]" <?php if($results['consulting']=='Consulting'){ echo "checked"; }?> value="Consulting" /><span class="radio_span">Consulting</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[<?php echo $j;?>][other]" <?php if($results['other']=='Other'){ echo "checked"; }?> value="Other" /><span class="radio_span">Other</span><input type="text" name="invention[<?php echo $j;?>][textother]" value="<?php if(!empty($results['textother'])){ echo $results['textother'];}?>" class="othertext"></li>
						<li class="lierror"></li>
						</ul>
						<input type="hidden" name="invention[<?php echo $j;?>][project_id]" class="project_id" value="<?php if(!empty($results['project_id'])){ echo $results['project_id'];}else{ echo "new";}?>" />
				</div>
			
			</div>
			

			
			<?php
			$j++;
			}
			}else{
			?>
			
			<div class="parentpluschild subchild">
				<div class="parent">
					<label>13(a)  Are you working/have you worked with any company/ies (including ones you have founded) in projects related to the invention? </label>
					<ul>
						<li>
							<input type="radio" class="autosave required" id="have_worked" name="invention[0][have_worked]" <?php //if($have_worked=="Yes"){ echo "checked";}?> value="Yes" /><span class="yes_no">YES</span>
								
						</li>
						<li class="no">
							<input type="radio" class="autosave required" id="have_worked1" name="invention[0][have_worked]" <?php //if($have_worked=="In-disk"){ echo "checked";}?> value="In-disk" /><span class="yes_no">IN-DISC </span>
						</li>
						<li class="no">
							<input type="radio" class="autosave required" id="have_worked2" name="invention[0][have_worked]" <?php //if($have_worked=="No"){ echo "checked";}?> value="No" /><span class="yes_no">NO</span>
						</li>
					</ul> 
				</div>
			
				<div class="child" style="display:none;">		
						<label>(b)	Name of Company <input type="text"  id="company_name" class="cmpny_name" name="invention[0][company_name]" value="<?php //if(!empty($results['company_name'])){ echo $results['company_name'];}?>" /></label>   
						<label>(c)	Type of collaboration (check ALL that apply)</label> 
						<ul>
						<li><input type="checkbox" class="funding_source_chk" name="invention[0][mta]" value="MTA" /><span class="radio_span">(i) MTA</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[0][sra]" value="SRA" /><span class="radio_span">(ii) SRA</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[0][scientific]" value="Scientific" /><span class="radio_span">(iii) Scientific Collaboration (no materials or funds transferred)</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[0][clinical_trial]" value="Clinical Trial" /><span class="radio_span">(iv) Clinical Trial</span></li>
						<li><input type="checkbox" class="funding_source_chk" name="invention[0][consulting]" value="Consulting" /><span class="radio_span">(v) Consulting</span></li>
						<li class="lierror"></li>
						</ul>
						<input type="hidden" name="invention[0][project_id]" class="project_id" value="new" />
				</div>
			
			</div>
			
			<?php } ?>
			<div class="form_items" id="add_more">
				<span class="add-more"><a href="javascript:void(0)" id="add_more_inventors">CLICK HERE TO ADD MORE COMPANIES</a></span>
			</div>
		</div>
			
			<div class="form_items">
				<label>14. You indicated <?php echo $impect_areas;?> for Q6b as the specific impact area of your invention.</label>  
				<label>	(a) What is the estimated size of consumers/patients for this market segment? </label>
				<ul>
					<li>
						<input type="radio" id="estimated_size" class="autosave required" name="estimated_size" <?php if($estimated_size=="<100k"){ echo "checked";}?> value="<100k" /><span class="yes_no"> &lt;100k people </span>
                	</li>
					<li class="no">
						<input type="radio" id="estimated_size1" class="autosave required" name="estimated_size" <?php if($estimated_size=="100k-1m"){ echo "checked";}?> value="100k-1m" /><span class="yes_no">100k-1m people</span>
                	</li>
					<li class="no">
						<input type="radio" id="estimated_size2" class="autosave required" name="estimated_size" <?php if($estimated_size==">1m"){ echo "checked";}?> value=">1m" /><span class="yes_no">&gt;1m people </span>
                	</li>
				</ul>
			</div>
			
			<div class="form_items">
			<label>(b) Do products exist in the market or are in development that serve this impact area?</label>
			<ul>
                	<li>
                        <input type="radio"  id="products_exist" class="autosave required" name="products_exist" <?php if($products_exist=="Yes"){ echo "checked";}?>   value="Yes" /><span class="yes_no">Yes, how many (approximately)? <input type="text" name="products_count" value="<?php if($products_count==0){}else { echo $products_count;}?>" class="datepick" <?php echo $disable;?> /></span> 
						<ul id="products_exist_yes" <?php if($products_exist=="Yes"){ echo 'style="display:block"';}else{ echo 'style="display:none"';}?>>
							<li class="no">
							<input type="radio" id="product_count" class="autosave" name="product_count" <?php if($product_count=="Yes"){ echo "checked";}?>  value="Yes"  <?php echo $disable;?> /><span class="yes_no"> 
							
							(a) Please provide the name of product and company? separate by comma <input type="text" class="cmpny_name" name="products_name"  value="<?php echo $products_name;?>" <?php echo $disable;?> /></span>
							</li>
							<li class="no">
							<input type="radio" id="product_count1" class="autosave" name="product_count" <?php if($product_count=="No"){ echo "checked";}?> value="No" <?php echo $disable;?> /><span class="yes_no"> 
							(b) Do not know/Not Sure</span>
							</li>
						
						</ul>
					</li>
                    <li class="no">
						<input type="radio" id="products_exist1" class="autosave required" name="products_exist" <?php if($products_exist=="No"){ echo "checked";}?> value="No" /><span class="yes_no">No </span>
                	</li>
					<li class="no">
						<input type="radio" id="products_exist2" class="autosave required" name="products_exist" <?php if($products_exist=="Dont know"){ echo "checked";}?> value="Dont know" /><span class="yes_no">Don't know</span>
                	</li>
					<li class="no">
						<input type="radio" id="products_exist3" class="autosave required" name="products_exist" <?php if($products_exist=="Not Sure"){ echo "checked";}?> value="Not Sure" /><span class="yes_no">Not Sure</span>
                	</li>
            </ul> 
			</div>
			<div class="form_items">
			<label>(c) Are there limitations to these current products that your invention addresses?</label>
			<ul>
                	<li>
                        <input type="radio"  id="limitations" class="autosave required" name="limitations" <?php if($limitations=="Yes"){ echo "checked";}?>    value="Yes" /><span class="yes_no">YES</span>        
					</li>
                    <li class="no">
						<input type="radio" id="limitations1" class="autosave required" name="limitations" <?php if($limitations=="No"){ echo "checked";}?> value="No" /><span class="yes_no">No </span>
                	</li>
					<li class="no">
						<input type="radio" id="limitations2" class="autosave required" name="limitations" <?php if($limitations=="Maybe"){ echo "checked";}?> value="Maybe" /><span class="yes_no">Maybe</span>
                	</li>
					<li class="no">
						<input type="radio" id="limitations3" class="autosave required" name="limitations" <?php if($limitations=="Not Sure"){ echo "checked";}?> value="Not Sure" /><span class="yes_no">Not Sure</span>
                	</li>
            </ul> 
			</div>
			
			<div class="form_items">
            	<!--<label>15.a Input search terms so that commercial partners for your invention can be identified. 
 Indicate if, in your opinion, the companies identified in the results would be potential collaborators and/or licensees of your invention.
</label>-->
			<label>15.a Input 3-8 key words for <b style="text-decoration:underline">inventive technology</b> and <b style="text-decoration:underline">impact area</b> (akin to journal key words).. Indicate if the companies (within the search results) would be scientific collaborator(s) or licensee(s) of the invention, if patented.
			</label>
				<input type="text" name="search_15" value="<?php echo $search_15;?>" />
                <div id="branding"  style="float: left;"></div><br />
				<div id="content" style="display: none;">Loading...</div>
					<div>
						<div class="prior_inventions_result customb" id="result">
						<?php
						if(isset($page_data['invention_data']) && !empty($result_15b)){
							$k=0; 
							foreach($result_15b as $results){
							//print_pre($result);die;
								$link  =(isset($results['link']) && !empty($results['link']))? $results['link'] : '';
								$title =(isset($results['title']) && !empty($results['title'])) ? $results['title'] : '';
								$radio_15b =(isset($results['radio_15b']) && !empty($results['radio_15b'])) ? $results['radio_15b'] : '';
								$desc =(isset($results['desc']) && !empty($results['desc'])) ? $results['desc'] : '';
								//$filedate =(isset($results['filedate']) && !empty($results['filedate'])) ? $results['filedate'] : '';
								//$applicant =(isset($results['applicant']) && !empty($results['applicant'])) ? $results['applicant'] : '';
								
						?>
						
						<div class="result11class"><a href="<?php echo $link;?>" target="_blank"><?php echo $title;?></a><p><?php echo $desc;?></p><input type="hidden" name="result_15b[<?php echo $k;?>][title]" value="<?php echo $title;?>"/><input type="hidden" name="result_15b[<?php echo $k;?>][link]" value="<?php echo $link;?>"/>
						
						<textarea style="display:none" name="result_15b[<?php echo $k;?>][desc]"><?php echo $desc;?></textarea>
						
						<table><tr><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b[<?php echo $k;?>][radio_15b]" <?php if($radio_15b=="least_likely"){ echo "checked";}?> value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b[<?php echo $k;?>][radio_15b]" <?php if($radio_15b=="somewhat_likely"){ echo "checked";}?> value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b[<?php echo $k;?>][radio_15b]" <?php if($radio_15b=="likely"){ echo "checked";}?> value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b[<?php echo $k;?>][radio_15b]" <?php if($radio_15b=="very_likely"){ echo "checked";}?> value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio" class="radio_15b required" name="result_15b[<?php echo $k;?>][radio_15b]" <?php if($radio_15b=="duplicate"){ echo "checked";}?> value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>
						
						<?php  $k++; 
						} }
						//else{
						?>
						<script type="text/javascript">			
						/*	$(document).ready(function(){

								$('#result').html("");
								onLoad()
							});*/
							</script>
						<?php
						//}
						?>
						
						</div>
					</div>
            </div>
			
			<div class="form_items">
			<!--
			<input type="hidden"  name="invention_id" value="<?php echo  $page_data['invention_id'];  ?>" />
			-->
            	<label>15.b</label>
				<div id="branding3"  style="float: left;"></div><br />
				<div id="content3" style="display: none;">Loading...</div>
				<div>
					<div class="prior_inventions_result" id="search_15">
					<?php 
						if(isset($page_data['invention_data']) && !empty($result_15)){
						$i=0; 
						foreach($result_15 as $results){
						//print_pre($results);die;
							$link  =(isset($results['link']) && !empty($results['link']))? $results['link'] : '';
							$title =(isset($results['title']) && !empty($results['title'])) ? $results['title'] : '';
							$radio_15 =(isset($results['radio_15']) && !empty($results['radio_15'])) ? $results['radio_15'] : '';
							//$byline =(isset($results['byline']) && !empty($results['byline'])) ? $results['byline'] : '';
							$desc =(isset($results['desc']) && !empty($results['desc'])) ? $results['desc'] : '';
					?>
						
						<div class="result11class"><a href="<?php echo $link;?>" target="_blank"><?php echo $title;?></a><p><?php echo $desc;?></p><input type="hidden" name="result_15[<?php echo $i;?>][title]" value="<?php echo $title;?>"/><input type="hidden" name="result_15[<?php echo $i;?>][link]" value="<?php echo $link;?>"/><input type="hidden" name="result_15[<?php echo $i;?>][desc]" value="<?php echo $desc;?>"/><table><tr><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="least_likely"){ echo "checked";}?> class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="somewhat_likely"){ echo "checked";}?>  class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="likely"){ echo "checked";}?> class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="very_likely"){ echo "checked";}?> class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="duplicate"){ echo "checked";}?> class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>
					
					<?php 
						$i++;
						} } 
						?>
					</div>
				</div>
                
                <!----------relevance search--------------------->
                <div>&nbsp;</div>
                  <div>&nbsp;</div>
                <div>
                 <h1>Based on Relevance</h1>
					<div class="prior_inventions_result" id="search_15_rele">
                   
					<?php 
						if(isset($page_data['invention_data']) && !empty($result_15)){
						$i=0; 
						foreach($result_15 as $results){
						//print_pre($results);die;
							$link  =(isset($results['link']) && !empty($results['link']))? $results['link'] : '';
							$title =(isset($results['title']) && !empty($results['title'])) ? $results['title'] : '';
							$radio_15 =(isset($results['radio_15']) && !empty($results['radio_15'])) ? $results['radio_15'] : '';
							//$byline =(isset($results['byline']) && !empty($results['byline'])) ? $results['byline'] : '';
							$desc =(isset($results['desc']) && !empty($results['desc'])) ? $results['desc'] : '';
					?>
						
						<div class="result11class"><a href="<?php echo $link;?>" target="_blank"><?php echo $title;?></a><p><?php echo $desc;?></p><input type="hidden" name="result_15[<?php echo $i;?>][title]" value="<?php echo $title;?>"/><input type="hidden" name="result_15[<?php echo $i;?>][link]" value="<?php echo $link;?>"/><input type="hidden" name="result_15[<?php echo $i;?>][desc]" value="<?php echo $desc;?>"/><table><tr><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="least_likely"){ echo "checked";}?> class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="least_likely" /><span class="radio_span">least likely</span></td><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="somewhat_likely"){ echo "checked";}?>  class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="somewhat_likely" /><span class="radio_span">somewhat likely</span></td><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="likely"){ echo "checked";}?> class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="likely" /><span class="radio_span">likely</span></td><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="very_likely"){ echo "checked";}?> class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="very_likely" /><span class="radio_span">very likely</span></td><td><span class="span_no"></span><input type="radio" <?php if($radio_15=="duplicate"){ echo "checked";}?> class="radio_15 required" name="result_15[<?php echo $i;?>][radio_15]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>
					
					<?php 
						$i++;
						} } 
						?>
					</div>
				</div>
                
                
                <!--------------------relevance search------------------------>
                
                
            </div>
	<?php 
		$user_type=$this->session->userdata('user_type');
		if($user_type==2){
	?>
			<div class="form_items">
			<label>15.c Please enter specific disease area key words (e.g., Non-Small cell lung cancer, hemophilia, etc) so this platform can pull up relevant market reports.</label>
			<input type="text" value="<?php echo $text_pdfsearch;?>" name="text_pdfsearch">
				<div id="branding1"  style="float: left;"></div><br />
				<div id="content1" style="display: none;">Loading...</div>
				<div class="prior_inventions_result" id="pdfresult">
					<?php 
						if(isset($page_data['invention_data']) && !empty($pdfresult)){
						//print_pre($pdfresult);die;
						$i=0; 
						foreach($pdfresult as $results){
						//print_pre($results);die;
							$link  =(isset($results['link']) && !empty($results['link']))? $results['link'] : '';
							$title =(isset($results['title']) && !empty($results['title'])) ? $results['title'] : '';
							//$desc =(isset($results['desc']) && !empty($results['desc'])) ? $results['desc'] : '';
					?>
					
					<div class="result11class"><a href="<?php echo $link;?>" target="_blank"><?php echo $title;?></a><p><?php //echo $desc;?></p><input type="hidden" name="result_15c[<?php echo $i;?>][title]" value="<?php echo $title;?>"/><input type="hidden" name="result_15c[<?php echo $i;?>][link]" value="<?php echo $link;?>"/></div>
					
					<?php
					$i++;
						}
						}
					?>
				</div>
			</div>
<?php 	
	if($this->session->userdata('user_type')==2){ 
		$requiredcls='required';
	}else{ 
		$requiredcls='';
	}
?>
			<div class="form_items">
			<label>16. Based on search results in Q#15 and the report in Q#16 please answer the following.</label>
			<label>(a)	How many companies are very large companies (>10,000 employees)
				<input class="companies <?php echo $requiredcls;?>" type="text" value="<?php echo $big_company_count;?>" name="big_company_count">
			</label>
			<label style="margin-top: 4px;">(b)	How many companies are small companies (5-500 employees)
				<input class="companies <?php echo $requiredcls;?>" type="text" value="<?php echo $small_company_count;?>" name="small_company_count">
			</label>
			</div>
			
			<?php
			
			$findme="antibiotic";
			$pos = strpos($impect_areas , $findme);
			if ($pos === false) {
			
			}else{
			
			if($category_invention=='gansh1' && $cat_invention_1=='gansh9' && $cat_invention_2=='gansh9_4'){
			
			?>
			<div class="form_items">
			<label>18.a Consider submitting a proposal (for funding) to Newdrugs4badbugs, a Public Private partnership in Europe ( for further details check out <a href="http://www.imi.europe.eu" style="color: #0000FF;" target="_blank">www.imi.europe.eu</a> ).</label>
			</div>
			<div class="form_items">
			<label>b. Further questions maybe added during initial trial period with Aavishkar's client.
			</label>
			</div>
			<?php 
			} 
			}
			?>
			
	<?php			
		}
	?>
			
			<div class="form_items">
				<label>
			I hereby agree to abide by all IP policies of the institution including the assignment of my rights in this invention to the institution: Signature 
				</label><span>
				<a href="javascript:void(0)"  style="clear:both; color: #000000;text-decoration:underline;margin-top:10px;"  id="signature">CLICK HERE TO UPLOAD E-SIGNATURE</a>
                <span id="fileq1" style="display:none;">
					<input type="file" name="signature"  class="doc_class"  id="signature">
				</span>
				</span>
				
			</div>
           
			 <div class="form_action" style="width:96%;">
				<input  class="right" type="submit" name="next" id="done" value="Done" style="display:none;" />
				<input  class="left" type="button" name="res_submit" value="Submit" onclick="commercialization('submit')" />
				<input  class="right" type="button" onclick="javascript:window.location.href='<?php echo site_url('user/logout'); ?>'" name="exit" value="Save & Exit" />
				
			 </div>
			<p class="progress"><span class="progressspan"><?php echo $progress; ?></span>% COMPLETE.</p>
			<input type="hidden"  name="invention_id" value="<?php echo  $page_data['invention_id'];  ?>" />
			<input type="hidden" id="link_redir_page" name="link_redir_page" value="com" />
        </form>
		<!--
    <div>
		<span class="prev">
		<a href="javascript:void(0)" onclick="commercialization('ip')">&lt;&lt;</a>
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
			<a href="javascript:void(0)" onclick="commercialization('tech')">TECHNOLOGY</a>
			</li>
            <li class="strip"> &nbsp;</li>
			<li>
			<a href="javascript:void(0)" onclick="commercialization('ip')">INTELLECTUAL PROPERTY</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" class="active" onclick="commercialization('com')">COMMERCIALIZATION</a>
			</li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('com_score')">ANALYTICS</a>
			</li>
			<?php } ?>
		</ul>
		</div>
		</div>
