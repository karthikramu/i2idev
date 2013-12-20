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
	
	.hasDatepicker, .datepick{
	width: 60px !important; height: 14px;font-size: 10px !important; 
	}
	.doc_class{
	 font-size: 9px !important;
    height: 22px;
    margin-top: 0 !important;
    width: 60px !important;
	}
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
	
	.prior_inventions_result  td{ padding:6px 5px;}

.prior_inventions_result tr{position: relative;}

.prior_inventions_result label.error {
    float: inherit;
    font-size: 12px;
    left: 34px;
    margin-top: 17px;
    position: absolute;
}
	
</style>
<script type="text/javascript">


$(function() {

$('.help_10a').tipsy({html: true });
$('.help_10b').tipsy({html: true });
$('.help_11').tipsy({html: true });
$('.help12').tipsy({html: true });
$('.help11b1').tipsy({html: true });

$('#done').live('click',function (evt) {

	$("#question_form2").validate({});
	
});
//10a
$( "#already_invention_date" ).datepicker({
		dateFormat: 'yy-mm-dd',
		onSelect: function(date) {
		
			var id=$("input[name$='invention_id']").val();
			$.ajax({
				url: "<?php echo site_url('user/home/date_check');?>",
				data: {date:date,id:id},
				type: "POST",
				success: function(response) {
				
					if(response=='true'){
						//$("input[name$='submitted_invention']").val("");
						$('#10c').find("input:radio:checked").prop('checked',false);
						$("input[name$='submitted_invention_date']").val("");
						$('#10d').find("input:radio:checked").prop('checked',false);
						$("input[name$='plan_invention_date']").val("");
						$( "input[name='submitted_invention']" ).removeClass('required');
						$('#10c').hide();
						$('#10d').hide();
					
					}else{
						$('#10c').show();
						$( "input[name='submitted_invention']" ).addClass('required');
						$('#10d').show();
					}
					autosave();
				}
					
			}); 
		
            
        },
});

$( "#journal_invention_date" ).datepicker({
		dateFormat: 'yy-mm-dd',
		onSelect: function(date) {
		
			/* var id=$("input[name$='invention_id']").val();
			$.ajax({
				url: "<?php echo site_url('user/home/date_check');?>",
				data: {date:date,id:id},
				type: "POST",
				success: function(response) {
				
					if(response=='true'){ */
						//$("input[name$='submitted_invention']").val("");
						$('#10c').find("input:radio:checked").prop('checked',false);
						$("input[name$='submitted_invention_date']").val("");
						$('#10d').find("input:radio:checked").prop('checked',false);
						$("input[name$='plan_invention_date']").val("");
						$( "input[name='submitted_invention']" ).removeClass('required');
						$('#10c').hide();
						$('#10d').hide();
						autosave();
					
					/* }else{
						$('#10c').show();
						$( "input[name='submitted_invention']" ).addClass('required');
						$('#10d').show();
					}
					autosave();
				}
					
			});  */
		
            
        },
});

<?php 
$year = date("Y",strtotime($page_data['invention_data']['submission_date'])) ; 
$date = date("d",strtotime($page_data['invention_data']['submission_date'])) ; 
$month = date("m",strtotime("-1 MONTH ".$page_data['invention_data']['submission_date'])) ; 

?>
$( "#upcoming_invention_date" ).datepicker({
	dateFormat: 'yy-mm-dd',
	minDate: new Date(<?php echo $year ;?>,<?php echo $month ;?>,<?php echo $date ;?>),
	onSelect: function(date) {
            autosave();
        },
});

$( "#submitted_invention_date" ).datepicker({
	dateFormat: 'yy-mm-dd',
	maxDate: new Date(),
	onSelect: function(date) {		  
            autosave();
        },
	});
});

$(document).ready(function(){ 

//10a
    $("input[name$='already_invention']").click(function() {
        var test = $(this).val();
        if(test=="Yes"){
			$("#11a_callender_journal").hide();
			$("input[name='journal_invention_date']").removeClass('required');
			$("input[name='journal_invention_date']").val("");
			$('#journal_invention_doc').val("");
			$("#11a_callender").show();
			$("input[name='already_invention_date']").addClass('required');
		}

		if(test=="Yes1"){
			$("#11a_callender_journal").show();
			$("input[name='journal_invention_date']").addClass('required');
			$("input[name='already_invention_date']").removeClass('required');
			$("input[name$='already_invention_date']").val("");
			$('#already_invention_doc').val("");
			$("#11a_callender").hide();	
			
			$('#10c').find("input:radio:checked").prop('checked',false);
			$("input[name$='submitted_invention_date']").val("");
			$('#10d').find("input:radio:checked").prop('checked',false);
			$("input[name$='plan_invention_date']").val("");
			$( "input[name='submitted_invention']" ).removeClass('required');
			
			$('#10c').hide();
			$('#10d').hide();
		}
			
		if(test=="No"){
			$("input[name='already_invention_date']").removeClass('required');
			$("input[name='submitted_invention']").addClass('required');
			$("input[name$='already_invention_date']").val("");
			$('#already_invention_date').val("");
			$('#already_invention_doc').val("");
			$("input[name='journal_invention_date']").removeClass('required');
			$("input[name='journal_invention_date']").val("");
			$('#journal_invention_doc').val("");
			$("#11a_callender_journal").hide();
			$("#11a_callender").hide();
			$('#10c').show();
			$('#10d').show();
			autosave();
		}
    }); 
	
	$("#11a_documents_click").live('click',function(){
				$("#fileq1").show();
	});
	
	$("#11a_documents_click_journal").live('click',function(){
				$("#fileq1_journal").show();
	});
	
	/* $("input[name='already_invention_date']").live('blur',function(){ 
		alert("requird");
		return false;
	}); */
	
	$("input[name='already_invention_doc']").live('blur',function(){ 
		autosave();
	});
	
	
//10b	
	
	$("input[name$='upcoming_invention']").click(function() {
	
        var test = $(this).val();
		
        if(test=="Yes"){
			$("#11b_callender").show();
			$("input[name='upcoming_invention_date']").addClass('required');
		}else{
			$("input[name='upcoming_invention_date']").removeClass('required');
			$("input[name$='upcoming_invention_date']").val("");
		}
		
		if(test=="No"){
			$('#upcoming_invention_date').val("");
			$('#upcoming_invention_doc').val("");
			$("#11b_callender").hide();
			autosave();
		}
		
    }); 
	
	$("#11b_documents_click").live('click',function(){
				$("#fileq2").show();
	});
	
	$("input[name='upcoming_invention_doc']").live('blur',function(){ 
		autosave();
	});
	
//10c	
	
	$("input[name$='submitted_invention']").click(function() {
        var test = $(this).val();
		
        if(test=="Yes"){
			$("#11c_callender").show();
			$("input[name='submitted_invention_date']").addClass('required');
			$('#10d').find("input:radio:checked").prop('checked',false);
			$("input[name$='plan_invention_date']").val("");
			$("#10d").hide();
		}else{
			$("input[name='submitted_invention_date']").removeClass('required');
			$("#10d").show();
		}
		
		if(test=="No"){
			$('#submitted_invention_date').val("");
			$('#submitted_invention_doc').val("");
			$("#11c_callender").hide();
			$("input[name='submitted_invention_date']").removeClass('required');
			$("#10d").show();
			autosave();
		}
		
    }); 
	
	$("#11c_documents_click").live('click',function(){
				
		$(".fileq3").show();
	});
	
	$("input[name='submitted_invention_doc']").live('blur',function(){ 
		autosave();
	});
});


//10d

	$("input[name='plan_invention']").live('click',function(){ 
		autosave();
	});
	
	$("input[name='plan_invention_date']").live('blur',function(){ 
		autosave();
	});
//11a1

	$(".radio11a1").live('click',function() {
		autosave();
	});
//11a2	
	$(".radio11a2").live('click',function() {
		autosave();
	});
	
//11b
 	$(".radio_11b").live('click',function() {
		autosave();
	});
//11b2
	$(".radio_11b2").live('click',function() {
		autosave();
	});
	
	
//12
	$("input[name='distinct_aspects1']").live('blur',function(){ 
		autosave();
	});
	$("input[name='distinct_aspects2']").live('blur',function(){ 
		autosave();
	});
	$("input[name='distinct_aspects3']").live('blur',function(){ 
		autosave();
	});

	//11a1
//var comman_title  = new Array();
	var ajaxReq = null; 
	$("#input_key_invention").live('keyup',function(){
		//comman_title  = new Array();
			var search=$("input[name='input_key_invention']").val();
		//alert(search);
		//onLoad(search);
		
	
		/* $('#rresult').html("");
		$('#result_11b2').html(""); */
		autosave();
		var title=$("#input_key_invention").val();
		var id=$("input[name='invention_id']").val();
		$.ajax({
		url: '<?php echo  site_url('user/home/ajaxresult_11a1'); ?>',
		data: {title:title,id:id},
		type: "POST",
		success: function(data){
			$('#prior_inventions_result').show();
			$('#prior_inventions_result').html(data);
		} 
	});
//11a2
	$.ajax({
		url: '<?php echo  site_url('user/home/ajaxresult_11a2'); ?>',
		data: {title:title,id:id},
		type: "POST",
		success: function(data){
			$('#other_prior_inventions_result').show();
			$('#other_prior_inventions_result').html(data);
		} 
	});
	
	//11b
	var comman_title  = new Array();
	if(search!=''){
	
	if (ajaxReq != null){

		ajaxReq.abort();
	}
	ajaxReq=$.ajax({
		url: '<?php echo  site_url('user/home/ajaxresult_11b2'); ?>',
		data: { title:title },
		type: "POST",
		success: function(data){
		
			if(data == 'error' ){
				$("#result_11b2").html("");
			}else{
			var i = 1 ; 
			var return_html1="<label>11B2.</label>";
			
			$(data).find('#maincontent').each(function(){
				var p=0;
				$(this).find('.rprt').each(function(){
					
					var title=$(this).find(".title").children('a').html();
					var title=$(this).find(".title").children('a').html();
					var link=$(this).find(".title").children('a').attr("href");
					var desc=$(this).find(".supp").children('.desc').html();
					var details=$(this).find(".supp").children('.details').html();
					var a = comman_title.indexOf(title);
					if(p <4 && i<=10 && (a == '-1')){
				
					return_html1 += '<div class="result11class"><a href="http://www.ncbi.nlm.nih.gov/'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><p>'+details+'</p><input type="hidden" name="result_11b2['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_11b2['+i+'][link]" value="http://www.ncbi.nlm.nih.gov/'+link+'"/><input type="hidden" name="result_11b2['+i+'][desc]" value="'+desc+'"/><textarea name="result_11b2['+i+'][details]" style="display:none">'+details+'</textarea><table><tr><td><span class="span_no"></span><input type="radio" class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="least_relevant" /><span class="radio_span">least impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="somewhat_relevant" /><span class="radio_span">some impact</span></td><td><span class="span_no"></span><input type="radio" class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="relevant" /><span class="radio_span">impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="most_relevant" /><span class="radio_span">most impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
					comman_title[i]= title;
					i++;
					}
					p++;
				});
			});
			if(i<=10){
				$(data).find('#maincontent').each(function(){
				
					$(this).find('.rprt').each(function(){
						
						var title=$(this).find(".title").children('a').html();
						var title=$(this).find(".title").children('a').html();
						var link=$(this).find(".title").children('a').attr("href");
						var desc=$(this).find(".supp").children('.desc').html();
						var details=$(this).find(".supp").children('.details').html();
						var a = comman_title.indexOf(title);
						if(i<=10 && (a == '-1')){
					
						return_html1 += '<div class="result11class"><a href="http://www.ncbi.nlm.nih.gov/'+link+'" target="_blank">'+title+'</a><p>'+desc+'</p><p>'+details+'</p><input type="hidden" name="result_11b2['+i+'][title]" value="'+title+'"/><input type="hidden" name="result_11b2['+i+'][link]" value="http://www.ncbi.nlm.nih.gov/'+link+'"/><input type="hidden" name="result_11b2['+i+'][desc]" value="'+desc+'"/><textarea name="result_11b2['+i+'][details]" style="display:none">'+details+'</textarea><table><tr><td><span class="span_no"></span><input type="radio" class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="least_relevant" /><span class="radio_span">least impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="somewhat_relevant" /><span class="radio_span">some impact</span></td><td><span class="span_no"></span><input type="radio" class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="relevant" /><span class="radio_span">impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="most_relevant" /><span class="radio_span">most impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2['+i+'][radio_11b2]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
						comman_title[i]= title;
						i++;
						}
					});
				});
			}
			
			$("#result_11b2").html(return_html1);
		}
		
		google.setOnLoadCallback(onLoad(search));
		
		} 
		});
		
		}else{
			 
			$("#result_11b2").html("");
		}
		
		
		
		<!--11b1 search results-->
		
		
		//11b
	var comman_title_11b1  = new Array();
	if(search!=''){
	
	if (ajaxReq != null){

		ajaxReq.abort();
	}
	
	
	ajaxReq=$.ajax({
		url: '<?php echo  site_url('user/home/ajaxresult_11b1'); ?>',
		data: { title:title },
		type: "POST",
		success: function(data){
		
			if(data == 'error' ){
				$("#rresult").html("");
			}else{
			var i = 1 ; 
			var return_html="<label>11B1.</label>";
			var tds = "";
			var ForthCellInnerHTML = "";
            //var rows = $(data).filter("table").children("tbody").children("tr");
            $(data).filter("table").children("tbody").children("tr").each(function (a, row) {
   
if(i <=3){
	//Fourth Cell              
                var ForthCell = $(this).find('td').eq(3).text().trim();
                if (ForthCell.length > 0) {
                    ForthCellInnerHTML = $(this).find('td').eq(3)[0].innerHTML.trim();										
					return_html += '<div class="result11class">'+ForthCellInnerHTML.replace('<a href="', '<a target="_blank" href="http://patft.uspto.gov/')+'<table><tr><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="least_relevant" /><span class="radio_span">least impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="somewhat_relevant" /><span class="radio_span">some impact</span></td><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="relevant" /><span class="radio_span">impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="most_relevant" /><span class="radio_span">most impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
								
					i++;
                }
}
                var test = "";
    
            });
			
			<!--result form lens-->
		
		j=1;
			var lensInnerHTML = "";
            $(data).find("#resultsTable").children("tbody").children("tr").each(function (j1, row) { 
if(j <=3){
	//Fourth Cell              
                var lenstitle = $(this).find('td').find('.resultTags').find('.title').text();
				var lensLink =$(this).find('td').eq(2)[0].children[0].attributes.href.textContent;

               // if (ForthCell.length > 0) {
                   // ForthCellInnerHTML = $(this).find('td').eq(3)[0].innerHTML.trim();										
					return_html += '<div class="result11class"><a target="_blank" href="http://www.lens.org'+lensLink+'">'+ lenstitle+'</a><table><tr><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="least_relevant" /><span class="radio_span">least impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="somewhat_relevant" /><span class="radio_span">some impact</span></td><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="relevant" /><span class="radio_span">impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="most_relevant" /><span class="radio_span">most impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
								
					j++;
					i++;
               // }
}
                
    
            });
		
			
			
			
		
			<!--reult from lens-->
			$("#rresult").html(return_html);
		}
		
		
		
		
		
		
		
		//RSS result patentscope starts
		var maxFeedLength=4;
		//getOnlineFeed('http://patentscope.wipo.int/search/rss.jsf?query='+title+'&office=&rss=true&sortOption=Pub+Date+Desc');
		//var s=callRSSReader(title,maxLength);
getFeed(title, maxFeedLength); 
		
		
		//RSS result patentscope starts
		//google.setOnLoadCallback(onLoad(search));
		
		} 
		});
		
		}else{
			 $("#rresult").html("");
			//$("#result_11b2").html("");
		}
		
		
		
		
		
	<!--	11b1 search results-->
		
		
		
	});

	$("#input_key_invention").live('blur',function(){
		autosave();
	});	
function autosave(){
		var form1 = $("#question_form2").serialize();
			$.ajax({
				url: "<?php echo site_url('user/home/form3_save');?>",
				data: form1,
				type: "POST",
				success: function(response) {
					//alert(response);
					$('.progressspan').html(response);
				}
			}); 
	}


function callRSSReader(title,maxFeedLength){
	getOnlineFeed('http://patentscope.wipo.int/search/rss.jsf?query='+title+'&office=&rss=true&sortOption=Pub+Date+Desc',maxFeedLength);
}

function getOnlineFeed (url,maxFeedLength) {
            var script = document.createElement('script');
            script.setAttribute('src', 'http://ajax.googleapis.com/ajax/services/feed/load?callback=getRssData&hl=ja&output=json-in-script&q=' 
                                + encodeURIComponent(url)
                                + '&v=1.0&num=' + maxFeedLength);
            script.setAttribute('type', 'text/javascript');
            document.documentElement.firstChild.appendChild(script);
}

function getRssData(json) {
			var maxFeedLength=4
			var i=7;
			var return_html="";
			var articleLength = json.responseData.feed.entries.length;
			articleLength = (articleLength > maxFeedLength) ? maxFeedLength : articleLength;
			if(articleLength > 0){
				for (var k = 1; k <= articleLength ; k++) {
                var entry = json.responseData.feed.entries[i - 1];
				var title=entry.title;
				var linkRss="<a href='"+entry.link+" target='_blank'>"+title+"</a>";
				var desc=entry.content;
				return_html += '<div class="result11class">'+linkRss+'<p>'+desc+'</p><table><tr><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="least_relevant" /><span class="radio_span">least impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="somewhat_relevant" /><span class="radio_span">some impact</span></td><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="relevant" /><span class="radio_span">impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="most_relevant" /><span class="radio_span">most impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
				
				i++;
               
            }
			}
            return return_html;
}




function getFeed(title, maxFeedLength) {
            url = 'http://ajax.googleapis.com/ajax/services/feed/load?v=1.0&num=10&callback=?&q=' 
                    + encodeURIComponent('http://patentscope.wipo.int/search/rss.jsf?query='+title+'&office=&rss=true&sortOption=Pub+Date+Desc');
			var return_html="";
            $.ajax({
                type: 'GET',
                url: url,
                dataType: 'jsonp',
                cache: false,
                success: function (json) {
                    //alert(JSON.stringify(json));
					var articleLength = json.responseData.feed.entries.length;
					articleLength = (articleLength > maxFeedLength) ? maxFeedLength : articleLength;
					if(articleLength > 0){
						var i=7;
							for (var l = 0; l <= maxFeedLength ;l++) {
								var entry = json.responseData.feed.entries[l];
								var title=entry.title;
								var linkRss="<a href='"+entry.link+"' target='_blank'>"+title+"</a>";
								var desc=entry.content;
								
								return_html += '<div class="result11class">'+linkRss+'<p>'+desc+'</p><table><tr><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="least_relevant" /><span class="radio_span">least impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="somewhat_relevant" /><span class="radio_span">some impact</span></td><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="relevant" /><span class="radio_span">impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="most_relevant" /><span class="radio_span">most impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
								i++;
							}
							var existingdata=$("#rresult")[0].innerHTML+" "+return_html;
							$("#rresult").html(existingdata);
							//alert (return_html);
						}
						

						},
                error: function(s,x) { alert(x); }
            });
			return return_html;
        }

function commercialization(page){
	$('#link_redir_page').val(page);
	$('#done').trigger('click');
}
	
</script>

<script src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
     
	google.load('search', '1');
	var patentSearch;
	function searchComplete() { 
		
        document.getElementById('content').innerHTML = '';
        if (patentSearch.results && patentSearch.results.length > 0) {
			var return_html='<label>11B1.</label>';
			//var title_array=new Array();
			var title_array_11b=new Array();
			var k = 1  ; 
			
			for (var i = 0; i < patentSearch.results.length;  i++) {

			  // title_array[i]=patentSearch.results[i].title;
			  /*   var a = comman_title.indexOf(patentSearch.results[i].title);
			   if(a == '-1'){ */
			   
			   var a = title_array_11b.indexOf(patentSearch.results[i].title);
			   if(a == '-1'){ 
			   
			   if(k <10){
			
			   // if(a!=-1){
			   
			   return_html += '<div class="result11class"><a href="'+ patentSearch.results[i].unescapedUrl+'" target="_blank">'+patentSearch.results[i].title+'</a><p>App.-Filed '+patentSearch.results[i].applicationDate+'</p><p>'+patentSearch.results[i].assignee+'</p><p>'+patentSearch.results[i].content+'</p><input type="hidden" name="result_11b['+i+'][title]" value="'+patentSearch.results[i].title+'"/><input type="hidden" name="result_11b['+i+'][link]" value="'+ patentSearch.results[i].unescapedUrl+';"/><textarea style="display:none" name="result_11b['+i+'][desc]">'+ patentSearch.results[i].content+'</textarea><input type="hidden" name="result_11b['+i+'][filedate]" value="'+patentSearch.results[i].applicationDate+'"/><input type="hidden" name="result_11b['+i+'][applicant]" value="'+patentSearch.results[i].assignee+'"/><table><tr><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="least_relevant" /><span class="radio_span">least impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="somewhat_relevant" /><span class="radio_span">some impact</span></td><td><span class="span_no"></span><input type="radio" class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="relevant" /><span class="radio_span">impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="most_relevant" /><span class="radio_span">most impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b required" name="result_11b['+i+'][radio_11b]" value="duplicate" /><span class="radio_span">duplicate</span></td></tr></table></div>';
			  
				title_array_11b[i]=patentSearch.results[i].title;
				k++;
			  }
			  }
			 //  }
			}
			$("#rresult").html(return_html);
        }
    }
	
		  function on11b1(search) {
		
		
        patentSearch = new google.search.WebSearch();
        patentSearch.setSearchCompleteCallback(this, searchCompleteMedical, null);
		patentSearch.setResultSetSize(8);
		//seekingalphasearch.execute(search_string+' site:http://seekingalpha.com');
		patentSearch.execute(search+' site:http://patentscope.wipo.int/search/en/result.jsf');
        google.search.Search.getBranding('branding3');
		//}
      }

    function onLoad(search) {
	
        patentSearch = new google.search.PatentSearch();
        patentSearch.setSearchCompleteCallback(this, searchComplete, null);
		//search= encodeURIComponent(search);
		patentSearch.setResultOrder(google.search.Search.ORDER_BY_RELEVANCE );
        patentSearch.setResultSetSize(8);
		patentSearch.execute(search);
        google.search.Search.getBranding('branding');
      }
	  
	  
	$(document).ready(function(){
		var search="";
		onLoad(search)
	});
</script>	
<?php	
		$title='';
		$already_invention='';
		$already_invention_date='';
		$already_invention_doc='';
		$upcoming_invention='';
		$upcoming_invention_date='';
		$upcoming_invention_doc='';
		$submitted_invention='';
		$submitted_invention_date='';
		$submitted_invention_doc='';
		$plan_invention='';
		$plan_invention_date='';
		$input_key_invention='';
		$result_11b='';
		$result_11b2='';
		$prior_inventions='';
		$other_inventions='';
		$distinct_aspects1="";
		$distinct_aspects2="";
		$distinct_aspects3="";
		$style="";
		$progress=0;
		$journal_invention_date='';
		

	if(isset($page_data['invention_data'])){
	/* 
		 print_pre($page_data['invention_data']); 
		 die;  */
		
		$title 										= $page_data['invention_data']['title'] ; 
		$already_invention 							= $page_data['invention_data']['already_invention'] ; 
		
		if($page_data['invention_data']['already_invention_date']=='0000-00-00 00:00:00'){
			$already_invention_date 				= '';
		}
		else{
			$already_invention_date 				= date("Y-m-d",strtotime($page_data['invention_data']['already_invention_date']));
		}
		$already_invention_doc 						= $page_data['invention_data']['already_invention_doc'] ; 
		if($page_data['invention_data']['journal_invention_date']=='0000-00-00 00:00:00'){
			$journal_invention_date 				= '';
		}
		else{
			$journal_invention_date 				= date("Y-m-d",strtotime($page_data['invention_data']['journal_invention_date']));
		}
		$journal_invention_doc 						= $page_data['invention_data']['journal_invention_doc'] ; 
		$upcoming_invention 						= $page_data['invention_data']['upcoming_invention'] ; 
		
		if($page_data['invention_data']['upcoming_invention_date']=='0000-00-00 00:00:00'){
			$upcoming_invention_date 				= '';
		}
		else{
			$upcoming_invention_date 				= date("Y-m-d",strtotime($page_data['invention_data']['upcoming_invention_date']));
		}
		
		$upcoming_invention_doc 					= $page_data['invention_data']['upcoming_invention_doc'] ; 
		$submitted_invention 						= $page_data['invention_data']['submitted_invention'] ; 
		
		if($page_data['invention_data']['submitted_invention_date']=='0000-00-00 00:00:00'){
			$submitted_invention_date 				= '';
		}
		else{
			$submitted_invention_date 			= date("Y-m-d",strtotime($page_data['invention_data']['submitted_invention_date']));
		}
		
		$submitted_invention_doc 				= $page_data['invention_data']['submitted_invention_doc'] ; 
		$plan_invention 						= $page_data['invention_data']['plan_invention'] ; 
		
		if($page_data['invention_data']['plan_invention_date']=='0000-00-00 00:00:00'){
			$plan_invention_date 				= '';
		}
		else{
			$plan_invention_date 				= date("Y-m-d",strtotime($page_data['invention_data']['upcoming_invention_date']));
		}
		
		$input_key_invention 					= $page_data['invention_data']['input_key_invention'];
		
		if($page_data['invention_data']['prior_inventions']!=''){
		$prior_inventions 						= json_decode($page_data['invention_data']['prior_inventions'],true);
		}
		
		if($page_data['invention_data']['other_inventions']!=''){
		$other_inventions 						= json_decode($page_data['invention_data']['other_inventions'],true);
		}
		
		if($page_data['invention_data']['result_11b']!=''){
		$result_11b 							= json_decode($page_data['invention_data']['result_11b'],true);
		} 
		
		if($page_data['invention_data']['result_11b2']!=''){
		$result_11b2 							= json_decode($page_data['invention_data']['result_11b2'],true);
		/* print_pre($result_11b2);
		die; */
		} 
		
		if($page_data['invention_data']['distinct_aspects1']!=''){
		$distinct_aspects1 						= $page_data['invention_data']['distinct_aspects1'];
		
		}
		if($page_data['invention_data']['distinct_aspects2']!=''){
		$distinct_aspects2 						= $page_data['invention_data']['distinct_aspects2'];
		
		}
		if($page_data['invention_data']['distinct_aspects3']!=''){
		$distinct_aspects3 						= $page_data['invention_data']['distinct_aspects3'];
		
		}
		
		if($page_data['invention_data']['progress']!=''){
		$progress 						= $page_data['invention_data']['progress'];
		
		}
		
		
		 if(isset($page_data['invention_data']['already_invention_date']) && $page_data['invention_data']['already_invention']=="Yes" && $page_data['invention_data']['already_invention_date']!=''){
		 
			// $submission_date = new DateTime($page_data['invention_data']['submission_date']);
			// $invention_date  = new DateTime($page_data['invention_data']['already_invention_date']);

			$submission_date = strtotime(date("Y-m-d H:i:s",strtotime($page_data['invention_data']['submission_date'])));
			$invention_date  = strtotime(date("Y-m-d H:i:s",strtotime($page_data['invention_data']['already_invention_date'])));

					$todaystart = strtotime(date("Y-m-d 00:00:00"));
					
					
				if($invention_date < $todaystart){
			
			if($invention_date < $submission_date){
			
				 /* $style='style="display:none;"';
				 $style1='style="display:none;"';
				 if($submitted_invention=="Yes"){
					$style1='style="display:none;"';
				 } */
				
				 $style='style="display:block;"';
				 $style1='style="display:block;"';
				 if($submitted_invention=="Yes"){
					$style1='style="display:none;"';
				 }
			
			
			}else{
			
				 /* $style='style="display:block;"';
				 $style1='style="display:block;"';
				 if($submitted_invention=="Yes"){
					$style1='style="display:none;"';
				 } */
				 
				 $style='style="display:none;"';
				 $style1='style="display:none;"';
				 if($submitted_invention=="Yes"){
					$style1='style="display:none;"';
				 }
			}
			
			}else{
			
				 /* $style='style="display:block;"';
				 $style1='style="display:block;"';
				 if($submitted_invention=="Yes"){
					$style1='style="display:none;"';
				 } */
				  $style='style="display:none;"';
				 $style1='style="display:none;"';
				 if($submitted_invention=="Yes"){
					$style1='style="display:none;"';
				 }
				 
				 
			}
			
		 
		 }else{
			//die("here2");
			
			if(isset($page_data['invention_data']['already_invention_date']) && $page_data['invention_data']['already_invention']=="Yes1" && $page_data['invention_data']['journal_invention_date']!=''){
				$style='style="display:none;"';
				$style1='style="display:none;"';
			}else{
				$style='style="display:block;"';
				$style1='style="display:block;"';
				if($submitted_invention=="Yes"){
						$style1='style="display:none;"';
				}
			}
		 }
	}
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
			<a href="javascript:void(0)" onclick="commercialization('ip')" class="active">INTELLECTUAL PROPERTY</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('com')">COMMERCIALIZATION</a>
			</li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('ip_score')">ANALYTICS</a>
			</li>
			<?php } ?>
        </ul>
    </div>
<!--	
		<div>
			<span class="prev">
			<a href="javascript:void(0)" onclick="commercialization('tech')">&lt;&lt;</a>
			</span>
			<span class="next">
			<a href="javascript:void(0)" onclick="commercialization('com')">&gt;&gt;</a>
			</span>
		</div>
    -->
    		<form action="" name="buy_name" id="question_form2" class="question-form" enctype="multipart/form-data" method="post">
			
			
        	<div class="form_items">
			<!--
            	<label>10 (a) Have you <b style="text-decoration:underline;">already</b> publicly (i.e., OUTSIDE of your home institution) presented or disclosed any or all aspects of this invention (e.g., journal publication, talk, poster, seminar)? Pick ONLY One:</label>-->
				<label>10 (a) Has there been publication or public disclosure of any or all aspects of the invention?<span>(<a class="help_10a" title='Public disclosure include seminars, talks, posters etc.  "Public" means anybody outside of your own institution.  E.g., if a seminar within your institution is open to attendance from another institution, then such a seminar is considered a public disclosure'>help</a>) </label>
                <ul>
                	<li>
                        <input type="radio" <?php if($already_invention=='Yes'){ echo "checked"; } ?> id="already_invention" class="required" name="already_invention" value="Yes" /><span class="yes_no">Yes, Talk or Seminar or Poster Disclosed on</span>
                            <span id="11a_callender"  <?php if($already_invention=='Yes'){}else{ echo 'style="display:none;"';}?>>
                                <input name="already_invention_date" value="<?php echo $already_invention_date;?>" id="already_invention_date" placeholder="Select Date" />
                                <a href="javascript:void(0)"  style="clear:both; color: #000000;text-decoration:underline;margin-top:10px;"  id="11a_documents_click">CLICK HERE TO UPLOAD PRESENTATION</a>
                                <span id="fileq1" style="display:none;">
                                <input type="file" name="already_invention_doc"  class="doc_class"  id="already_invention_doc">
                                </span>
                            </span>
					</li>
					
					<li>
                        <input type="radio" <?php if($already_invention=='Yes1'){ echo "checked"; } ?> id="already_invention2" class="required" name="already_invention" value="Yes1" /><span class="yes_no">Yes, Journal Publication on</span>
						
						 <span id="11a_callender_journal"  <?php if($already_invention=='Yes1'){}else{ echo 'style="display:none;"';}?>>
							<input name="journal_invention_date" value="<?php echo $journal_invention_date;?>" id="journal_invention_date" placeholder="Select Date" />
							<a href="javascript:void(0)"  style="clear:both; color: #000000;text-decoration:underline;margin-top:10px;"  id="11a_documents_click_journal">CLICK HERE TO UPLOAD PRESENTATION</a>
							<span id="fileq1_journal" style="display:none;">
							<input type="file" name="journal_invention_doc"  class="doc_class"  id="journal_invention_doc">
							</span>
                        </span>
						
					</li>
					
                    <li class="no">
						<input type="radio" <?php if($already_invention=='No'){ echo "checked"; } ?> id="already_invention1" class="required" name="already_invention" value="No" /><span class="yes_no">No</span>
                	</li>
                   </ul> 
            </div>
			
           <div class="form_items">
            	<label>10 (b) Do you have any upcoming public presentations of any or all aspects of your invention (e.g., talk, poster, seminar)? Pick ONLY One:</label>
                <ul>
                	<li>
                    <input type="radio" <?php if($upcoming_invention=='Yes'){ echo "checked"; } ?> id="upcoming_invention" class="required" name="upcoming_invention" value="Yes" /><span class="yes_no">Yes</span>
                        <span id="11b_callender"  <?php if($upcoming_invention=='Yes'){}else{ echo 'style="display:none;"';}?>>
                            <input name="upcoming_invention_date" value="<?php echo $upcoming_invention_date;?>" id="upcoming_invention_date" placeholder="Select Date"/>
                            <a href="javascript:void(0)"  style="clear:both; color: #000000;text-decoration:underline;margin-top:10px;"  id="11b_documents_click">CLICK HERE TO UPLOAD PRESENTATION</a>
                                <span id="fileq2" style="display:none;">
                                    <input type="file" name="upcoming_invention_doc" class="doc_class" id="upcoming_invention_doc">
                                </span>
                        </span>
					</li>
                    <li class="no">
					<input type="radio" <?php if($upcoming_invention=='No'){ echo "checked"; } ?> id="upcoming_invention1" class="required" name="upcoming_invention" value="No" /><span class="yes_no">No</span>
                	</li>
                
                </ul>
            </div>
			
			<div class="form_items" id="10c" <?php echo $style;?>>
				<?php 
					/* $crequired="";
					if($style=='style="display:block;"'){
						$crequired="required";
					} */
				?>
            	<label>10 (c) Have you submitted the invention for publication? Pick ONLY One:</label>
                <ul>
                	<li>
                <input type="radio" <?php if($submitted_invention=='Yes'){ echo "checked"; } ?> id="submitted_invention" name="submitted_invention" class="<?php //echo $crequired;?>" value="Yes" /><span class="yes_no">Yes</span>

					<span id="11c_callender" <?php if($submitted_invention=='Yes'){}else{ echo 'style="display:none;"';}?>>
						<input name="submitted_invention_date" value="<?php echo $submitted_invention_date; ?>" id="submitted_invention_date" placeholder="Select Date"/>
						<a href="javascript:void(0)"  style="clear:both; color: #000000;text-decoration:underline;margin-top:10px;"  id="11c_documents_click">CLICK HERE TO UPLOAD PRESENTATION</a>
						<span class="fileq3" style="display:none;">
							<input type="file" name="submitted_invention_doc" class="doc_class" id="submitted_invention_date">
						</span>
					</span>
					</li>
                    <li class="no">
				<input type="radio" <?php if($submitted_invention=='No'){ echo "checked"; } ?> id="submitted_invention1" name="submitted_invention" class="<?php //echo $crequired;?>" value="No" /><span class="yes_no">No</span>
                	</li>
                
                </ul>
            </div>
			
			<div class="form_items" id='10d' <?php echo $style1;?> <?php //if($submitted_invention=="Yes"){ echo 'style="display:none;"';}?>>
            	<label>10 (d) Do you plan to submit the invention for publication? Pick ONLY One:</label>
                <ul>
                <li>
                <input type="radio" <?php if($plan_invention=='Yes'){ echo "checked"; } ?> id="plan_invention" name="plan_invention" value="Yes" /><span class="yes_no">Yes</span>
				<input name="plan_invention_date" id="plan_invention_date" placeholder="Enter Date" class="datepick"/>
				</li>
                <li class="no">
				<input type="radio" <?php if($plan_invention=='No'){ echo "checked"; } ?> id="plan_invention1" name="plan_invention" value="No" /><span class="yes_no">No</span>
                </li>
                </ul>
            </div>
			
			<div class="form_items">
				<!--
            	<label>11. Please input about 3-5 key words that defines your invention to enable the platform to fetch relevant patent and research articles. Please tweak keywords to improve results (as you would in any search engine) <span>(<a class="help_11" title="Some example keywords are: Keyowrd1, word 2">help</a>)</span></label>
				-->
				<label>11. Input 3-8 words in the format <b style="text-decoration:underline;">inventive technology</b> key words <b style="text-decoration:underline;">impact area</b> key words.<span>(<a class="help_11" title='Eg 1., HDAC inhibitors for pancreatic cancer, Eg 2., nanoclusters for photocatalysis, Eg 3., Olefin catalyst for industrial polymerization, Eg 4., laser excitation methods for semiconductor wafer inspection'>help</a>)</span></label></br></br>
                <input type="text" id="input_key_invention" name="input_key_invention" value="<?php echo $input_key_invention;?>" />
				
				<!--<label>A1: Your Prior Related Inventions:</label>-->
				<label>A1: Indicate against each of your prior inventions listed below, the direct relevance to the current invention:</label>
				<table>
				<tbody id="prior_inventions_result" class="prior_inventions_result" style="margin:0px;">
				<?php
				
				//print_pre($prior_inventions);die;
				
				if($prior_inventions!=''){
					
					$i=1;
					foreach($prior_inventions as $row){
					
						$status = '';
						if($row['status']=='process'){
							$status = 'Disclosure In-Progress';
						}elseif($row['status']=='open'){
							$status = 'Disclosure In-Progress';
						}else{
							$status = 'Disclosure Done & Under Review';
						}
						
						$radio_11a1 =(isset($row['radio_11a1']) && !empty($row['radio_11a1'])) ? $row['radio_11a1'] :"";
						
						if($i<=10){	
					?>
							<tr>
								<td><?php echo $i;?></td>
								<td><a href="<?php echo site_url('user/invention');?>/<?php echo $row['id'];?>" target="_blank"><?php echo $row['title'];?></td>
								<td><?php echo $status;?></td>
								<td><span class="span_no"></span><input type="radio" class="radio11a1 required"
								name="result_11a1[<?php echo $i;?>][radio_11a1]" <?php if($radio_11a1=="Yes"){ echo "checked";}?> value="Yes" /><span class="radio_span">Yes</span></td>
								<td><span class="span_no"></span><input type="radio" class="radio11a1 required" name="result_11a1[<?php echo $i;?>][radio_11a1]" <?php if($radio_11a1=="No"){ echo "checked";}?> value="No" /><span class="radio_span">No</span></td>
								<td><span class="span_no"></span><input type="radio" class="radio11a1 required" name="result_11a1[<?php echo $i;?>][radio_11a1]" <?php if($radio_11a1=="May be"){ echo "checked";}?> value="May be" /><span class="radio_span">May be</span><input type="hidden" name="result_11a1[<?php echo $i;?>][title]" value="<?php echo $row['title'];?>"><input type="hidden" name="result_11a1[<?php echo $i;?>][id]" value="<?php echo $row['id'];?>"><input type="hidden" name="result_11a1[<?php echo $i;?>][status]" value="<?php echo $row['status'];?>">
								</td>	
							</tr>
					<?php
						}
						$i++;
					}
				}else{
				?>
					<tr><td>No record found.</td></tr>
				<?php 
				}
				?>
				
				</tbody>
				</table>
				<?php
				//print_pre($page_data['$result_11a']);die;
				?>
				<?php 	
					if($this->session->userdata('user_type')==2){ 
						$required='required';
					}else{ 
						$required='';
					}
				?>
				<div class="form_items" <?php if($this->session->userdata('user_type')==2){ echo 'style="display:block"';}else{ echo 'style="display:none"';}?>>
					<label>A2: Institutions Other Prior Related Inventions:</label>
					<table>
						<tbody id="other_prior_inventions_result" class="prior_inventions_result" style="margin:0px;">
						<?php
						//print_pre($other_inventions);die;	
						if($other_inventions!=""){
							//$result1=$page_data['$result_11b'];
							$x=1;
							foreach($other_inventions as $other_row){
							//print_pre($other_row['status']);die;

								$status1 = '';
								if(isset($other_row['status'])){
								if($other_row['status']=='process'){
									$status1 = 'Disclosure In-Progress';
								}elseif($other_row['status']=='open'){
									$status1 = 'Disclosure In-Progress';
								}else{
									$status1 = 'Disclosure Done & Under Review';
								}
								}
								
								$radio_11a2 =(isset($other_row['radio_11a2']) && !empty($other_row['radio_11a2'])) ? $other_row['radio_11a2'] :"";
								
								$title2 =(isset($other_row['title']) && !empty($other_row['title'])) ? $other_row['title'] :"";
								$id2 =(isset($other_row['id']) && !empty($other_row['id'])) ? $other_row['id'] :"";
							if($x<=10){	
						?>
								<tr>
									<td><?php echo $x;?></td>
									<td><a href="<?php echo site_url('user/invention');?>/<?php echo $id2;?>" target="_blank"><?php echo $title2;?></a></td>
									<td><?php echo $status1;?></td>
									<td><span class="span_no"></span><input type="radio" class="radio11a2 <?php echo $required;?>"
									name="result_11a2[<?php echo $x;?>][radio_11a2]" <?php if($radio_11a2=="Yes"){ echo "checked";}?> value="Yes" /><span class="radio_span">Yes</span></td>
									<td><span class="span_no"></span><input type="radio" class="radio11a2 <?php echo $required;?>" name="result_11a2[<?php echo $x;?>][radio_11a2]" <?php if($radio_11a2=="No"){ echo "checked";}?> value="No" /><span class="radio_span">No</span></td>
									<td><span class="span_no"></span><input type="radio" class="radio11a2 <?php echo $required;?>" name="result_11a2[<?php echo $x;?>][radio_11a2]" <?php if($radio_11a2=="May be"){ echo "checked";}?> value="May be" /><span class="radio_span">May be</span>
									
									<input type="hidden" name="result_11a2[<?php echo $x;?>][title]" value="<?php echo $title2;?>">
									<input type="hidden" name="result_11a2[<?php echo $x;?>][id]" value="<?php echo $id2; ?>">
									<input type="hidden" name="result_11a2[<?php echo $x;?>][status]" value="<?php echo $status1;?>">
									</td>		
								</tr>
						<?php
							}
								$x++;
							}
						}else{
						?>
						<tr><td>No record found.</td></tr>
						<?php 
						}
						?>
						</tbody>
					</table>
				</div>
            </div>
			
			<div class="form_items">
            	<label>B.Indicate against each search result the impact on patentability of your invention.

				<span><a href="javascript:void(0)" class="help11b1" title='If the reference discloses <b style="text-decoration:underline">any aspect(s)</b> of your invention, you should click "impact", if the reference discloses <b style="text-decoration:underline">all aspects</b> of your invention, click "most impact", if the reference discloses <b style="text-decoration:underline">no aspects</b> of your invention but could have some impact click some impact, etc.' style="font-size:12px;"> Help </a></span>
				</label>
				<?php 
				if(isset($page_data['invention_data']) && !empty($result_11b)){
				//echo "<label>11B1.</label>";
				$k=0; ?>
				<div id="branding"  style="float: left;"></div><br />
				<div id="content">Loading...</div>
				
				<div id="database_result">
				<div class="prior_inventions_result " id="rresult">
				<label>11B1.</label>
				<?php
				foreach($result_11b as $result){
				//print_pre($result);die;
					$link  =(isset($result['link']) && !empty($result['link']))? $result['link'] : '';
					$title =(isset($result['title']) && !empty($result['title'])) ? $result['title'] : '';
					$radio_11b =(isset($result['radio_11b']) && !empty($result['radio_11b'])) ? $result['radio_11b'] : '';
					$desc =(isset($result['desc']) && !empty($result['desc'])) ? $result['desc'] : '';
					$filedate =(isset($result['filedate']) && !empty($result['filedate'])) ? $result['filedate'] : '';
					$applicant =(isset($result['applicant']) && !empty($result['applicant'])) ? $result['applicant'] : '';
					
					
				?>
				<div class="result11class">
				<a href="<?php echo $link;?>" target="_blank"><?php echo $title;?></a><p>App.-Filed <?php echo $filedate;?></p><p><?php echo $applicant;?></p><p><?php echo $desc;?></p>
				
				
				<input type="hidden" name="result_11b[<?php echo $k;?>][title]" value="<?php echo $title;?>"/>
				<input type="hidden" name="result_11b[<?php echo $k;?>][link]" value="<?php echo $link;?>"/>
				<input type="hidden" name="result_11b[<?php echo $k;?>][filedate]" value="<?php echo $filedate;?>"/><input type="hidden" name="result_11b[<?php echo $k;?>][applicant]" value="<?php echo $applicant;?>"/>
				<textarea style="display:none" name="result_11b[<?php echo $k;?>][desc]"><?php echo $desc;?></textarea>
				
				<table>
				<tr>

				
				
				<td><span class="span_no"></span><input type="radio" <?php if($radio_11b=='least_relevant'){ echo "checked";}?> class="radio_11b required" name="result_11b[<?php echo $k;?>][radio_11b]" value="least_relevant" /><span class="radio_span">least impact</span></td>
				<td><span class="span_no"></span><input type="radio" <?php if($radio_11b=='somewhat_relevant'){ echo "checked";}?>  class="radio_11b required" name="result_11b[<?php echo $k;?>][radio_11b]" value="somewhat_relevant" /><span class="radio_span">some impact</span></td>
				<td><span class="span_no"></span><input type="radio" <?php if($radio_11b=='relevant'){ echo "checked";}?> class="radio_11b required" name="result_11b[<?php echo $k;?>][radio_11b]" value="relevant" /><span class="radio_span">impact</span></td>
				<td><span class="span_no"></span><input type="radio" <?php if($radio_11b=='most_relevant'){ echo "checked";}?> class="radio_11b required" name="result_11b[<?php echo $k;?>][radio_11b]" value="most_relevant" /><span class="radio_span">most impact</span></td>
				<td><span class="span_no"></span><input type="radio" <?php if($radio_11b=='duplicate'){ echo "checked";}?> class="radio_11b required" name="result_11b[<?php echo $k;?>][radio_11b]" value="duplicate" /><span class="radio_span">duplicate</span></td>
				</tr>
				</table>
				
				</div>
				<?php
				$k++;
				} ?>
				
				</div></div>
				<?php
				}else{
				?>
				<div id="branding"  style="float: left;"></div><br />
				<div id="content">Loading...</div>
				<div>
					<div class="prior_inventions_result " id="rresult"></div>
				</div>
				<?php } ?>
				<div>
				
				<!--<p> Pubmed : </p>-->
				
				<div>
					<div class="prior_inventions_result " id="result_11b2">
					<?php 
						if(isset($page_data['invention_data']) && !empty($result_11b2)){
						echo "<label>11B2.</label>";
						$l=0; 
						foreach($result_11b2 as $results){
						//print_pre($results);die;
							$link2  =(isset($results['link']) && !empty($results['link']))? $results['link'] : '';
							$title2 =(isset($results['title']) && !empty($results['title'])) ? html_entity_decode($results['title']) : '';
							$radio_11b2 =(isset($results['radio_11b2']) && !empty($results['radio_11b2'])) ? $results['radio_11b2'] : '';
							$desc =(isset($results['desc']) && !empty($results['desc'])) ? html_entity_decode($results['desc']) : '';
							$details =(isset($results['details']) && !empty($results['details'])) ? html_entity_decode($results['details']) : '';
					?>
					
					<div class="result11class"><a href="<?php echo $link2;?>" target="_blank"><?php echo $title2;?></a><p><?php echo $desc;?></p><p><?php echo $details;?></p><input type="hidden" name="result_11b2[<?php echo $l;?>][title]" value="<?php echo $title2;?>"/><input type="hidden" name="result_11b2[<?php echo $l;?>][link]" value="<?php echo $link2;?>"/><input type="hidden" name="result_11b2[<?php echo $l;?>][desc]" value="<?php echo $desc;?>"/>
					<textarea name="result_11b2[<?php echo $l;?>][details]" style="display:none"><?php echo $details;?></textarea>
					<table><tr><td><span class="span_no"></span><input type="radio" class="radio_11b2 required" name="result_11b2[<?php echo $l;?>][radio_11b2]" <?php if(!empty($radio_11b2) && $radio_11b2=="least_relevant"){ echo "checked";}?> value="least_relevant" /><span class="radio_span">least impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2[<?php echo $l;?>][radio_11b2]" <?php if(!empty($radio_11b2) && $radio_11b2=="somewhat_relevant"){ echo "checked";}?> value="somewhat_relevant" /><span class="radio_span">some impact</span></td><td><span class="span_no"></span><input type="radio" class="radio_11b2 required" name="result_11b2[<?php echo $l;?>][radio_11b2]" <?php if(!empty($radio_11b2) && $radio_11b2=="relevant"){ echo "checked";}?> value="relevant" /><span class="radio_span">impact</span></td><td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2[<?php echo $l;?>][radio_11b2]" <?php if(!empty($radio_11b2) && $radio_11b2=="most_relevant"){ echo "checked";}?> value="most_relevant" /><span class="radio_span">most impact</span></td>
					<td><span class="span_no"></span><input type="radio"  class="radio_11b2 required" name="result_11b2[<?php echo $l;?>][radio_11b2]" <?php if(!empty($radio_11b2) && $radio_11b2=="duplicate"){ echo "checked";}?> value="duplicate" /><span class="radio_span">duplicate</span></td>
					
					</tr></table>
					
					</div>
					
					<?php 
						$l++;
						} 
						} 
						?>
					</div>
				</div>
				</div>
            </div>
			
			<div class="form_items">
			<!--
            	<label>12.  Using <i style="text-decoration: underline;">at least 5 words</i> per text box identify three novel aspects of a product of your invention relative to the closest reference in 11B.<span><a href="javascript:void(0)" class="help12" title="List patentably novel aspects relative to reference, even if the cited reference is a prior publication from your lab" style="font-size:12px;"> Help </a></span></label>-->
				<label>12. Provide 3 novel differences between the invention and the closest reference(s) in Q#11.</label>
				<br/></br>
				1. <input type="text" class="q12 required" name="distinct_aspects1" value="<?php echo $distinct_aspects1; ?>" /> [Please provide at least 5 words]</br></br>
				2. <input type="text" class="q12 required" name="distinct_aspects2" value="<?php echo $distinct_aspects2; ?>"/> [Please provide at least 5 words]</br></br>
				3. <input type="text" class="q12 required" name="distinct_aspects3" value="<?php echo $distinct_aspects3; ?>"/> [Please provide at least 5 words]
				
			</div>
			<?php /*
            <div class="form_action" style="width:700px;">
					
					<input  class="left" type="submit" id="save_exit" name="Submit" value="Save & Exit" />
					<input  class="" type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/invention'); ?>/<?php echo  $page_data['invention_id'];  ?>';" name="previous" value="INVENTOR INFORMATION" />
					<input  class="" type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/invention1'); ?>/<?php echo  $page_data['invention_id'];  ?>';" name="previous" value="TECHNOLOGY " />
				   <input type="button" onclick="javascript:window.location.href= '<?php echo site_url('user/invention3'); ?>/<?php echo  $page_data['invention_id'];  ?>';" class="previous"  name="next" value="COMMERCIALIZATION"  />
				   <!-- <input type="button" class="disable"  name="next" value="SCORING" />-->	
            </div> */?>
			
			 <div class="form_action" style="width:700px;">
			 <!--<input type="button" value="SCORING" name="next" class="disable" style="margin-right:3px;">-->
			 <input type="button" style="display:none;" onclick="javascript:window.location.href= '<?php echo site_url('user/score'); ?>/<?php echo  $page_data['invention_id'];  ?>';" class="next" name="next" value="SCORING" />
				<input  class="right" type="submit" name="next" id="done" style="display:none;" value="Done" />
				
				<input  class="right" type="button" onclick="javascript:window.location.href='<?php echo site_url('user/logout'); ?>'" name="exit" value="Save & Exit" />
			
			 </div>
			<p class="progress"><span class="progressspan"><?php echo $progress; ?></span>% COMPLETE.</p>
			<input type="hidden"  name="invention_id" value="<?php echo  $page_data['invention_id'];  ?>" />
			<input type="hidden" id="link_redir_page" name="link_redir_page" value="ip" />
			<?php //print_pre($page_data['invention_data']['submission_date']);die;?>
			<input type="hidden"  name="submission_date" value="<?php echo  date("M d, Y g:i A",strtotime($page_data['invention_data']['submission_date'])); ?>" />
        </form>
		<!--
		<div>
			<span class="prev">
			<a href="javascript:void(0)" onclick="commercialization('tech')">&lt;&lt;</a>
			</span>
			<span class="next">
			<a href="javascript:void(0)" onclick="commercialization('com')">&gt;&gt;</a>
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
			<a href="javascript:void(0)" onclick="commercialization('ip')" class="active">INTELLECTUAL PROPERTY</a>
			</li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('com')">COMMERCIALIZATION</a>
			</li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row">
			<a href="javascript:void(0)" onclick="commercialization('ip_score')">ANALYTICS</a>
			</li>
			<?php } ?>
			</ul>
		</div>
			
    </div>
    