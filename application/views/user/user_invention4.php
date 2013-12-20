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

.result .form_items {
    display: table;
    float: none;
    margin: 155px auto 0;
    width: auto;
}

.result .left {
    float: left;
    font-size: 19px;
    font-weight: bold;
    margin: 0 20px;
    width: auto;
}


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
				if($page_data['invention_data']['module3_score']<=24){
					$interpretation = "Very weak IP";
					$class = 'Red';
				}
				if($page_data['invention_data']['module3_score']>=25 && $page_data['invention_data']['module3_score']<=34){
					$interpretation = "Poor IP";
					$class = 'Orange';
				}
				if($page_data['invention_data']['module3_score']>=35 && $page_data['invention_data']['module3_score']<=44){
					$interpretation = "Get more data from Investigators";
					$class = 'Yellow';
				}
				if($page_data['invention_data']['module3_score']>=45 && $page_data['invention_data']['module3_score']<=79){
					$interpretation = "Invention worth protecting";
					$class = 'Light-green';
				}
				if($page_data['invention_data']['module3_score']>=80){
					$interpretation = "Possible Asset Candidate";
					$class = 'Green';
				}

			 ?>
			 
			 <div class="left">
            SCORE I = IP SCORE (out of 100) = <?php echo $page_data['invention_data']['module3_score']; ?></div><div class="<?php echo $class; ?> left interpritaion"> Interpretation: <?php echo $interpretation; ?></div>
					
            </div>
			
			
    </div>
    