
		 </div>
<div class="left-120"> 
</div>
     <div class="inner-right">
      <?php
		// Left column view
		$this->load->view('templates/layouts/'.$left_column_content);
	  ?>
      <!-- /[END] Left Column -->
      
      <!-- Right Column -->
      <div class="right-column">
   
<div class="left-column-inside-inner">
               <div class="review-detail-content"> 
               
                 <div class="heading">              
                   <h1>Profile - <?php echo $page_data['user_data']['email'] ?></h1>
                   <!--<div class="right-hd-links"><a href="#">Continue browsing &raquo;</a></div>-->
                   <div class="clear-border"></div>
                 </div>
                 
                 <!--<p>Sri_123456: Information on this page is private. | <a href="#"><strong>Not you?</strong></a> </p>-->
                 
                 </div>
            
            <div class="clear-10"></div>   
            
            
            <div class="block5">
               <div class="green-box padding4 clearfix">
                 <span class="size14 textbold left">Change Password</span>                
               </div>
               
              <div id="info1" style="height: 210px;margin-top: 5px;">
			  <?php echo @$page_data['edit_msg']; ?>
				<?php echo form_open('user/changepass', array('id' => 'frmchangepass')); ?>
					
				   
					<div class="row">
                     <div class="col1">Old Password:</div>
                     <div class="col1-align">
					 <input type="password" name="pass" id="pass"/>
					 </div>
                   </div>			  
            
                   <div class="row">
                     <div class="col1">New Password:</div>
                     <div class="col1-align">
					 <input type="password" name="npass" id="npass"/>
					</div>				
                   </div>
				   
				   <div class="row">
                     <div class="col1">Confirm Password:</div>
                     <div class="col1-align">
					  <input type="password" name="cnpass" id="cnpass"/>
					 </div>
                   </div>
				   
				   <div class="row">                     
				   <input type="submit" id= "submit" name="submit" Value="Update" class="submit" style="float:none;margin: 8px 0 0 320px;"/>		
                   </div>
				   <?php echo form_close(); ?>
               </div>
           
            </div><!-- Account Info Section ends -->
            
        </div>        
    
        <div class="clear-10"></div>
        
        <!-- Most Reviewed -->
        
        <!-- // Most Reviewed -->
        
        <!-- bottom block -->
        
        <!-- / bottom block -->
        
            
        
      </div>
	  </div>
	  <div class="clear"></div> 