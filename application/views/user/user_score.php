<?php //die("here");?> 
 <script  type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.tipsy.js'></script>

<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.validation.js'></script>
<link rel="stylesheet" href="<?php echo return_theme_path(); ?>css/tipsy.css" type="text/css" />


<style>
.total{
	float: left;
    margin: 20px 0;
    width: 100%;

}
.total li {
	display: table-cell;
	border-left: 15px solid #FFFFFF;
    border-right: 15px solid #FFFFFF;
    font-weight: bold;
	 font-size: 16px;
    list-style: none outside none;
    margin: 30px;
    min-height: 42px;
    padding: 10px 30px;
    width: 200px;
	vertical-align: middle;
}

interpritaion{
	margin-left: 10px;
    margin-top: -5px;
    padding: 5px 10px;

}

.Red{  background-color: #FF0000; color:#fff;}
.Red:hover{ color:#000000;}
.Orange{background-color: #FF8040; color:#fff; }
.Orange:hover{ color:#000000;}
.Yellow{ background-color: #FFFF00; color:#000;}
.Yellow:hover{ color:#000000;}
.Light-green{ background-color: #a0fca7; color:#000;}
.Light-green:hover{ color:#000000;}
.Green{ background-color:	#01FF13; color:#000;}
.Green:hover{ color:#000000;}


</style>
<div class="wrapper"> 
	<div class="form_container">
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
        	<li><a href="<?php echo site_url('user/invention'); ?>/<?php echo  $page_data['invention_id'];  ?>">INVENTOR INFORMATION </a></li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row"><a href="<?php echo site_url('user/invention1'); ?>/<?php echo  $page_data['invention_id'];  ?>">TECHNOLOGY </a></li>
            <li class="strip"> &nbsp;</li>
			<li><a href="<?php echo site_url('user/invention2'); ?>/<?php echo  $page_data['invention_id'];  ?>">INTELLECTUAL PROPERTY</a></li>
            <li class="strip"> &nbsp;</li>
            <li class="single-row"><a href="<?php echo site_url('user/invention3'); ?>/<?php echo  $page_data['invention_id'];  ?>" >COMMERCIALIZATION</a></li>
			<?php if($this->session->userdata('user_type')==2){ ?>
			<li class="strip"> &nbsp;</li>
            <li class="single-row"><a href="<?php echo site_url('user/score'); ?>/<?php echo  $page_data['invention_id'];  ?>" class="active">ANALYTICS</a></li>
			<?php } ?>
        </ul>
    </div>
			
			<?php 
			$score_page=""; 
			$score_page = $this->uri->segment(4);
			if($score_page=="ip_score"){ 
			?>
			
			<div class="form_items" style="margin: 171px 16px !important;">
			 
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
			 
				<div class="left" style="float: left;font-size: 19px;font-weight: bold;">
				SCORE I = IP SCORE (out of 100) = <?php echo $page_data['invention_data']['module3_score']; ?></div><div class="<?php echo $class; ?> left interpritaion"> Interpretation: <?php echo $interpretation; ?></div>		
			</div>
			<?php 
			}
			
			if($score_page=="com_score"){
			
			?>
			
			<div class="form_items" style="margin: 171px 16px !important;">
			 
			 <?php 
				$interpretation ='';
				$class ='';
				if($page_data['invention_data']['module4_score']>=0 && $page_data['invention_data']['module4_score']<=14){
					$interpretation = "Very low licensing potential";
					$class = 'Red';
				}
				if($page_data['invention_data']['module4_score']>=15 && $page_data['invention_data']['module4_score']<=24){
					$interpretation = "Licensable with aggressive marketing";
					$class = 'Orange';
				}
				if($page_data['invention_data']['module4_score']>=25 && $page_data['invention_data']['module4_score']<=35){
					$interpretation = "Passing Licensing Potential";
					$class = 'Light-green';
				}
				if($page_data['invention_data']['module4_score']>35){
					$interpretation = "High Licensing Potential";
					$class = 'Green';
				}

			 ?>
			 <?php //print_pre($page_data);die;?>
			 <div class="left" style="float: left;font-size: 19px;font-weight: bold;">
            SCORE I = COMMERCIALIZATION SCORE (out of 50)= <?php echo $page_data['invention_data']['module4_score']; ?></div><div class="<?php echo $class; ?> left interpritaion"> Interpretation: <?php echo $interpretation; ?></div>
					
            </div>
			
			<?php
			}
			
			if($score_page=="tech_score"){
			?>
			
			<div class="form_items" style="margin: 171px 16px !important;">
			 
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
			 
			 <div class="left" style="float: left;font-size: 19px;font-weight: bold;">
            SCORE I = TECHONOLOGY SCORE (out of 200) = <?php echo $page_data['invention_data']['final_score']; ?></div><div class="<?php echo $class; ?> left interpritaion"> Interpretation: <?php echo $interpretation; ?></div>
					
            </div>
			
			
			<?php 
			}
			/* if($score_page=="ii_score"){
			} */
			if($score_page==""){
			
			?>
        	<div class="form_items">
			
            	<h1 style="text-align:center;margin-top:20px;">SCORING, INTERPRETATION AND RECOMMENDATION</h1>
                
            </div>
			<div class="form_items" style="margin: 20px 18px !important";>
			 
			 <?php 
			 
			 /* print_pre($page_data['invention_data']);
			 die; */
			 $total=0;
			 $score1=0;
			 $score2=0;
			 $score3=0;
			 if($page_data['invention_data']['final_score']!=''){
				$total +=$page_data['invention_data']['final_score'];
				$score1=$page_data['invention_data']['final_score'];
			 }
			 if($page_data['invention_data']['module3_score']!=''){
				$total +=$page_data['invention_data']['module3_score'];
				$score2 =$page_data['invention_data']['module3_score'];
			 }
			 if($page_data['invention_data']['module4_score']!=''){
				$total +=$page_data['invention_data']['module4_score'];
				$score3 =$page_data['invention_data']['module4_score'];
			 }
		
				$interpretation ='';
				$class ='Yellow';
				$recommendation='';
				if($total<=80){
					$interpretation = "Do Not File";
					$recommendation="Needs significant improvement in all three sectors and is not worth consideration";
					$class = 'Red';
				}
			//	if($total>=81 && $total<=155){
				
			//		$class = 'Yellow';
			
					if($score1<=50 || $score2<=25 || $score3<=5){
					
						if(( $score1<=50 && $score2<=25 ) || ( $score2<=25 && $score3<=5 ) || ( $score1<=50 && $score3<=5 )){
							
							if( $score1<=50 && $score2<=25 && $score3<=5){
								
								$interpretation ="Do Not File";
								$recommendation = "Needs significant improvement in all three sectors.";
							
							}else{
								
								$interpretation ="Do Not File";
								$recommendation = "Two weak sectors and maybe risky investment.";
							}
							
						}else{
						
							$interpretation ="Borderline";
							$recommendation = "One very weak area, consider strengthening that area before IP filing.";
						}
					}
					
					if(($score1>=51 && $score1<=84) && $score2>=45 && $score3>=25 ){
						$interpretation = " Borderline+";
						$recommendation .=  " Technological deficiencies need to be overcomebefore filing for IP protection";
					}
					
					if($score1>=85 && ($score2>25 && $score2<=44) && $score3>=25 ){
						$interpretation = " Borderline+";
						$recommendation .=  " Define IP better before filing for IP protection";
					}
					
					if($score1>=85 && $score2>=45 && ($score3>=6 && $score3<=24) ){
						$interpretation = " Borderline+";
						$recommendation .=  " Define commercial strategy. better before filing for IP protection";
					}
					
					if(($score1>=51 && $score1<=84) && $score2>=45 && ($score3>=6 && $score3<=24) ){
						$interpretation = " Borderline(-)";
						$recommendation .=  " Technological deficiencies and commercial challenges. Both need to be overcome before filing for IP protection";
					}
					
					if( $score1>=85 && ($score2>25 && $score2<=44) && ($score3>=6 && $score3<=24)){
						$interpretation = " Borderline(-)";
						$recommendation .=  " Define IP and commercial strategy before filing for IP protection";
					}
					
					if( ($score1>=51 && $score1<=84) && ($score2>25 && $score2<=44) && $score3>=35){
						$interpretation = " Borderline(-)";
						$recommendation .=  " Technological deficiencies and IP challenges need to be overcome before filing for IP protection";
					}
			
					
				/* 
					if(( $score1<=50 && $score2<=25 ) || ( $score2<=25 && $score3<=5 ) || ( $score1<=50 && $score3<=5 )){
						$interpretation =" Do Not File";
						$recommendation = " Two weak areas and maybe risky investment";
					
					if($score1>=51 && $score1<=75){
						$interpretation = " Borderline";
						$recommendation .=  " Technology not strong - work with Inventor to increase technology score and Pass for filing IP protection";
					}
					if($score2>=25 && $score2<=35){
						
						$interpretation = " Borderline";
						$recommendation .= " Define IP better and then file for IP protection";
					}
					if($score3>=6 && $score3<=15){
						$interpretation = "Borderline";
						$recommendation .=  " Weak commercial position – would need aggressive marketing. Formulate marketing and business strategy before filing for IP protection";
					}
				*/
				
				//}
				
				/*
				if($total>=80 && $total<=122){
					$interpretation = "Do Not File";
					$recommendation = "Not worth the investment";
					//$class = 'Orange';
					
				}*/
				/*
				if($total>=123 && $total<=155){
					
					$class = 'Yellow';
					if($score1<50){
						$interpretation ="Do Not File";
						$tech_recommendation = "Not worth the investment";
					}
					if($score2<25){
						$interpretation ="Do Not File";
						$ip_recommendation = "Not worth the investment";
					}
					if($score3<5){
						$interpretation ="Do Not File";
						$com_recommendation = "Not worth the investment";
					}
					if($score1>=51 && $score1<=75){
						$interpretation = "Borderline";
						$tech_recommendation =  "Technology not strong - work with Inventor to increase technology score and Pass for filing IP protection";
					}
					if($score2>=25 && $score2<=35){
						$interpretation = "Borderline";
						$ip_recommendation = "Define IP better to increase IP score and Pass for filing IP protection";
					}
					if($score3>=6 && $score3<=15){
						$interpretation = "Borderline";
						$com_recommendation =  "Weak commercial position \96 would need aggressive marketing to increase score and Pass for filing IP protection";
					}
				}
				*/
			/* 	if(($total>=156 && $total<=239) || ($score1 > 85 && $score2 > 45) || ($score2 > 45 && $score3 > 50) || ($score1 >85 && $score3 > 50) ){ */
				
				
				if(($score1 > 85 && $score2 > 45) || ($score2 > 45 && $score3 > 50) || ($score1 >85 && $score3 > 50) ){
					
					$interpretation = "File";
					//print_pre($page_data['invention_data']['cat_invention_1']);die;				
					if(($page_data['invention_data']['category_invention']=="gansh1" && $page_data['invention_data']['cat_invention_1']=="gansh11") || ($page_data['invention_data']['category_invention']=="gansh2" && $page_data['invention_data']['cat_invention_1']=="gansh14") || ($page_data['invention_data']['category_invention']=="gansh3" && $page_data['invention_data']['cat_invention_1']=="gansh17")){
						
					//die("here1");	
						
						 $recommendation ="Non-exclusive licenses";
					}
					/* $big_company_count=0;
					if(!empty($page_data['invention_data']['big_company_count'])){
					$big_company_count=$page_data['invention_data']['big_company_count'];
					}	
					if($big_company_count>3){
					$recommendation .=" Exclusive License to Established Companies."; 
					
					}*/
	//b.	If 17(a) > 3 then Recommendation = \93Exclusive License to Established Companies \93
				
				}	
					

			$count_invention=0;				
			if(!empty($page_data['invention_inventor'])){

				foreach($page_data['invention_inventor'] as $inventor){
				
					$count_invention +=$inventor['count_inventor'];	
				}
			}
			$small_company_count=0;
			if(!empty($page_data['invention_data']['small_company_count'])){
			$small_company_count=$page_data['invention_data']['small_company_count'];
			}

//print_pre($small_company_count);die("here");
//print_pre($page_data);die("here");
			if($total>=240){
					
				$interpretation = 'Possible Asset Candidate';
				$set='false';
				if(!empty($page_data['invention_data']['category_invention']) && !empty($page_data['invention_data']['cat_invention_1']) && !empty($page_data['invention_data']['cat_invention_2'])){
				
						$recommendation ='Consider Field Limited Exclusive Licenses';
						$set='true';						
				}

				if($score1>100 && ($count_invention>=5 || $small_company_count>=2)){
					if($set == 'true'){
						$recommendation .=' <span style="text-decoration: underline;">or</span> Consider a start-up';
					}else{
						$recommendation ='Consider a start-up';
					}
				}
									
/* 				
					
a. If Q6(a) Sub-Sub option is for Medical or Science (non-medical) or Engineering (non-medical) or Other or category (TBD) “Platform” or “Broad applications of inventive technology in several consumer and industrial markets” is true then Recommendation = “Consider Field Limited Exclusive Licenses”.
b. If Technology Score >100 AND  If either 3(ii) > /= 5 OR if 16(b) >/= 2  then Recommendation = “Consider a start-up”
					
 */				
				}
				
				//ip
					$interpretation_ip ='';
					$class_ip ='';
					if($page_data['invention_data']['module3_score']<=24){
						$interpretation_ip = "Very weak IP";
						$class_ip = 'Red';
					}
					if($page_data['invention_data']['module3_score']>=25 && $page_data['invention_data']['module3_score']<=34){
						$interpretation_ip = "Poor IP";
						$class_ip = 'Orange';
					}
					if($page_data['invention_data']['module3_score']>=35 && $page_data['invention_data']['module3_score']<=44){
						$interpretation_ip = "Get more data from Investigators";
						$class_ip = 'Yellow';
					}
					if($page_data['invention_data']['module3_score']>=45 && $page_data['invention_data']['module3_score']<=79){
						//$interpretation_ip = "Invention worth protecting";
						$interpretation_ip = "Good IP";
						$class_ip = 'Light-green';
					}
					if($page_data['invention_data']['module3_score']>=80){
						$interpretation_ip = "Possible Asset Candidate";
						$class_ip = 'Green';
					}
				//tech
					$interpretation_tech ='';
					$class_tech ='';
					//if($page_data['invention_data']['final_score']>=0 && $page_data['invention_data']['final_score']<=50){
					if($page_data['invention_data']['final_score']>=0 && $page_data['invention_data']['final_score']<=49){
						//$interpretation_tech = "Not worth consideration";
						//$interpretation_tech = "Very Early Stage";
						$interpretation_tech = "Very Weak Technology";
						$class_tech = 'Red';
					}
					//if($page_data['invention_data']['final_score']>=51 && $page_data['invention_data']['final_score']<=74){
					if($page_data['invention_data']['final_score']>=50 && $page_data['invention_data']['final_score']<=70){
						//$interpretation_tech = "Not enough in it to file";
						//$interpretation_tech = "Early Stage";
						$interpretation_tech = "Weak Technology";
						$class_tech = 'Orange';
					}
					//if($page_data['invention_data']['final_score']>=75 && $page_data['invention_data']['final_score']<=84){
					if($page_data['invention_data']['final_score']>=71 && $page_data['invention_data']['final_score']<=80){
						$interpretation_tech = "Get more data from Investigators";
						$class_tech = 'Yellow';
					}
					//if($page_data['invention_data']['final_score']>=85 && $page_data['invention_data']['final_score']<=124){
					if($page_data['invention_data']['final_score']>=81 && $page_data['invention_data']['final_score']<=120){
						//$interpretation_tech = "Merits IP protection";
						$interpretation_tech = "Good Technology";
						$class_tech = 'Light-green';
					}
					//if($page_data['invention_data']['final_score']>=125){
					if($page_data['invention_data']['final_score']>120){
						$interpretation_tech = "Possible Asset Candidate";
						$class_tech = 'Green';
					}
				//com
					$interpretation_com ='';
					$class_com ='';
					if($page_data['invention_data']['module4_score']>=0 && $page_data['invention_data']['module4_score']<=14){
						$interpretation_com = "Very low licensing potential";
						$class_com = 'Red';
					}
					if($page_data['invention_data']['module4_score']>=15 && $page_data['invention_data']['module4_score']<=24){
						$interpretation_com = "Licensable with aggressive marketing";
						$class_com = 'Orange';
					}
					if($page_data['invention_data']['module4_score']>=25 && $page_data['invention_data']['module4_score']<=35){
						$interpretation_com = "Passing Licensing Potential";
						$class_com = 'Light-green';
					}
					if($page_data['invention_data']['module4_score']>35){
						$interpretation_com = "High Licensing Potential";
						$class_com = 'Green';
					}

			 ?>
			
			<table style="width:95%; font-size: 20px;">
			<tr>
			<th></th>
			<th>Score</th>
			<th>Interpretation</th>
			</tr>
			<tr>
			<td>Technology (out of 200) </td>
			<td><?php echo $page_data['invention_data']['final_score']; ?></td>
			<td class="<?php echo $class_tech;?>"><?php echo $interpretation_tech; ?></td>
			</tr>
			<tr>
			<td>IP (out of 100-200) </td>
			<td><?php echo $page_data['invention_data']['module3_score']; ?></td>
			<td class="<?php echo $class_ip;?>"><?php echo $interpretation_ip; ?></td>
			</tr>
			<tr>
			<td>Commercial (out of 50) </td>
			<td><?php echo $page_data['invention_data']['module4_score']; ?></td>
			<td class="<?php echo $class_com;?>"><?php echo $interpretation_com; ?></td>
			</tr>
			<!--
			<tr>	
			<td>Total (out of 350) </td>
			<td><?php //echo $total; ?></td>
			<td><?php //echo $interpretation; ?></td>
			<td><?php //echo $recommendation;?></td>
			</tr>
			-->
			</table>
			
			<ul class="total">
				<li class="<?php echo $class; ?>" style="width: 131px; text-align: center;">TOTAL (out of 350): <?php echo $total; ?></li>
				<li class="<?php echo $class; ?>" style="text-align: center;">INTERPRETATION: <?php echo $interpretation; ?></li>
				<li class="<?php echo $class; ?>" style="width: 300px;">RECOMMENDATION: <?php echo $recommendation; ?></li>
			</ul>
			<!--
			<div class="left" style="float: left;font-size: 19px;font-weight: bold;">
				Total (out of 350) <?php echo $total; ?></div>
			<div class="<?php echo $class; ?> left interpritaion"> Interpretation: <?php echo $interpretation; ?></div>	
			<div class="<?php echo $class; ?> left interpritaion"> Recommendation: <?php echo $recommendation; ?></div>	
			<!--
			<div class="left" style="float: left;font-size: 19px;font-weight: bold;">
            SCORE I = TECHONOLOGY SCORE (out of 200) = <?php echo $page_data['invention_data']['final_score']; ?></div><div class="<?php echo $class_tech; ?> left interpritaion"> Interpretation: <?php echo $interpretation_tech; ?></div>
			
			 <div class="left" style="float: left;font-size: 19px;font-weight: bold;">
				SCORE I = IP SCORE (out of 100) = <?php echo $page_data['invention_data']['module3_score']; ?></div><div class="<?php echo $class_ip; ?> left interpritaion"> Interpretation: <?php echo $interpretation_ip; ?></div>		
			</div>
			
			
			<div class="left" style="float: left;font-size: 19px;font-weight: bold;">
            SCORE I = COMMERCIALIZATION SCORE = <?php echo $page_data['invention_data']['module4_score']; ?></div><div class="<?php echo $class_com; ?> left interpritaion"> Interpretation: <?php echo $interpretation_com; ?></div>
					
            </div>
			 
			 <div class="left" style="float: left;font-size: 19px;font-weight: bold;">
            TOTAL SCORE = <?php echo $total; ?></div><div class="<?php echo $class; ?> left interpritaion"> Interpretation: <?php echo $interpretation; ?></div>
            </div>-->
			<?php } ?>
			
	           
            
			<input type="hidden"  name="invention_id" value="<?php echo  $page_data['invention_id'];  ?>" />

        </form>
    </div>
    
