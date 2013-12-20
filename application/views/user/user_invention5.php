<script type="text/javascript" src="<?php echo return_theme_path(); ?>js/jquery.js"></script>
<style>
.interpritaion{
 margin-left: 10px;
    margin-top: -5px;
    padding: 5px 10px;

}

.interpritaion.Red{  background-color: #FF0000; color:#fff;}
.interpritaion.Orange{background-color: #FF8040; color:#fff; }
.interpritaion.Yellow{ background-color: #FFFF00; color:#000;}
.interpritaion.Light-green{ background-color: #a0fca7; color:#000;}
.interpritaion.Green{ background-color:	#01FF13; color:#000;}


</style>
<div class="wrapper"> 
	<div class="form_container result">
	<!-- <div class="steps_container">
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
    </div> -->
    
    		 <div class="form_items">
			 
			 <?php 
				$interpretation ='';
				$class ='';
				if($page_data['invention_data']['final_score']>=0 && $page_data['invention_data']['final_score']<=50){
					$interpretation = "Not worth consideration";
					$class = 'Red';
				}
				if($page_data['invention_data']['final_score']>=51 && $page_data['invention_data']['final_score']<=74){
					$interpretation = "Not enough in it to file";
					$class = 'Orange';
				}
				if($page_data['invention_data']['final_score']>=75 && $page_data['invention_data']['final_score']<=84){
					$interpretation = "Get more data from Investigators";
					$class = 'Yellow';
				}
				if($page_data['invention_data']['final_score']>=85 && $page_data['invention_data']['final_score']<=124){
					$interpretation = "Merits IP protection";
					$class = 'Light-green';
				}
				if($page_data['invention_data']['final_score']>=125){
					$interpretation = "Possible Asset Candidate";
					$class = 'Green';
				}

			 ?>
			 
			 <div class="left">
            SCORE I = TECHONOLOGY SCORE (out of 200) = <?php echo $page_data['invention_data']['final_score']; ?></div><div class="<?php echo $class; ?> left interpritaion"> Interpretation: <?php echo $interpretation; ?></div>
					
            </div>
			
			
    </div>
    