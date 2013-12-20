<script type='text/javascript' src="<?php echo return_theme_path(); ?>js/jquery.form.js"></script>
<script type="text/javascript">
//----------------------------------------------
// Customer - Part 3
//----------------------------------------------
$(document).ready(function() {
    var options = { 
        target:        '#l_form_message_hidden',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       login  // post-submit callback 
    };
    $('#frmLogin').ajaxForm(options); 
    var options = { 
        target:        '#l_form_message_hidden',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       forgot  // post-submit callback 
    };
    $('#frm_forgot').ajaxForm(options); 
});
// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    var queryString = $.param(formData); 
    return true; 
}
// post-submit callback
function login(responseText, statusText)  {
	var return_data = eval('['+responseText+']');
	var message = return_data[0]['message'];
	
		if(return_data[0]['type']=='success'){
			var user_type = return_data[0]['user_type'];
				if(user_type=='C'){
					window.location = "<?php echo site_url('customer'); ?>" ;
				}
				else{
					window.location = "<?php echo site_url('worker'); ?>";
				}
				
		}else{
			$('#l_form_message_block').addClass('clean-error')
			$('#l_form_message_block').html(message);
			$('#l_form_message_block').show();
		}
	
}
// post-submit callback
function forgot(responseText, statusText)  {
	var return_data = eval('['+responseText+']');
	var message = return_data[0]['message'];
	
	
		if(return_data[0]['type']=='success'){
			$('#l_form_message_block').addClass('clean-error')
			$('#l_form_message_block').html(message);
			$('#l_form_message_block').show();
		}else{
			
			$('#l_form_message_block').addClass('clean-error')
			$('#l_form_message_block').html(message);
			$('#l_form_message_block').show();
		}
	
}
</script>


 <!-- Catchline -->
   <div class="catchline">
      <h1>Connecting the student who needs the extra cash<br/> <span class="bluetext">with the neighbor who needs the extra hand.</span></h1>
   </div>
   <!-- // Catchline -->
   
   <!-- content -->   
   <!-- Student/Customer - Login/Create Profile Section -->
   <div class="block-20 main-block">
    
      <div>
        <h1 class="heading giant indent overlap">Lo<span class="show">g</span>In</h1>
         <div class="whitebox entrybox">         
            <span class="quotemark-left"> </span>
            
            <div class="form-inner">
             
                    <div class="halfform login only">
                       <?php echo form_open('login/login_process', array('id' => 'frmLogin')); ?>
					   
					   <div class="Field" id="l_form_message_hidden" style="display:none;"></div>
						<div class="Field" id="l_form_message_block"></div>
					   
					   <?php 
							if(isset($page_data['submit_message']) && $page_data['submit_message']!=''){
								echo $page_data['submit_message'];
							}else{
								echo display_flash('submit_message');
							}
						?>
                    <!-- Login Box-->
					<?php
						$style1 = '';

					  if(isset($page_data['page_id'])){ 
						$style1 =  'style="display: none;"';
					 }
					 else{
						$style1 =  '';
					 }
					 
					 
					  ?>
                     <div id="login" <?php echo $style1 ?>>
                       <h1 class="heading border-bottom medium">Lo<span class="show">g</span>in<span class="doubledash"></span></h1>
                       <div class="Field">
                          <label for="email">Email:</label>
                          <input name="email" type="text" id="lemail" class="textField gray" />
                       </div>
                       
                       <div class="Field">
                          <label for="password">Password:</label>
                          <input name="password" type="password" id="password" class="textField gray" />
                       </div>
                       
                       <div class="Field">
                          <input name="" type="checkbox" value="" /> Remember me on this computer  |  <a onclick="$('#login').slideToggle(); $('#forgot-pwd').slideToggle(); $('#l_form_message_block').hide(); " href="javascript:;">Forgot Password?</a>
                       </div>
                       
                       <div class="Field">
                          <input type="submit" name="login_btn" value="Login" class="button" />
                       </div>
					  </div>
					    <?php echo form_close(); ?>
                      <?php echo form_open('login/forgot_process', array('id' => 'frm_forgot')); ?>
					  <?php
						$style = '';

					  if(isset($page_data['page_id'])){ 
						$style =  'style="display: block;"';
					 }
					 else{
						$style =  'style="display: none;"';
					 }
					 
					 
					  ?>
					  
                     <div id="forgot-pwd" <?php echo $style ?>>
						
						
                        <h1 class="heading border-bottom medium">Forgot Password ?<span class="doubledash"></span></h1>                
                        <div class="Field">
                           <label for="l_username">Your Email:</label>
                           <input name="email" type="text" id="femail" class="textField" />
                        </div>
                       
                        <div class="Field">
                          <label>&nbsp;</label>
                          <input type="submit" name="forgot_btn" value="Send" class="button" />
                        </div>
                        
                        <div class="clear-dotted-border"></div>
                        
                        <div class="aligncenter">
                          <a  onclick="$('#forgot-pwd').slideToggle(); $('#login').slideToggle(); $('#l_form_message_block').hide();" href="javascript:;">Back to Login</a>  &nbsp;&nbsp;|&nbsp;&nbsp; <span class="graytext">Back to</span> <a href="<?php echo site_url() ;  ?>">Homepage</a>
                       </div>
                        
                     </div>                       
                       <?php echo form_close(); ?>
                    </div>
					</div>
					</div>
					</div>
					</div>
                    <!-- / Login box -->