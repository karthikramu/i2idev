
<script type="text/javascript">
$(document).ready(function() {


$("#frmLogin").validate({
invalidHandler: function(e, validator) {
var errors = validator.numberOfInvalids();
if (errors) {
var message = errors == 1
? 'You missed 1 field. It has been highlighted below'
: 'You missed ' + errors + ' fields. They have been highlighted below';
$("div.error span").html(message);
$("div.error").show();
} else {
$("div.error").hide();
}
},


});
});
</script>  
<script type="text/javascript">
$(document).ready(function() {

$.validator.addMethod("referral_code", function(value, element) {
	  return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
	}, "Username must contain only letters, numbers, or underscore.");

$("#frm_forgot").validate({
invalidHandler: function(e, validator) {
var errors = validator.numberOfInvalids();
if (errors) {
var message = errors == 1
? 'You missed 1 field. It has been highlighted below'
: 'You missed ' + errors + ' fields. They have been highlighted below';
$("div.error span").html(message);
$("div.error").show();
} else {
$("div.error").hide();
}
},
rules: {
femail: {
required: true,
email: true,
remote: {
url: "<?php echo site_url('login/forgot_email_check') ?>",
type: "post",
}
}

},

onkeyup: false,


messages: {

femail: {
required: true,
email: "Enter a valid email address.",
remote: $.validator.format("Sorry! This e-mail is not registered.")
}
}

});
});
</script>
<?php 
$page_id = '';
	if(isset($page_data['page_id']) && $page_data['page_id']=='forgot'){
		
		$page_id = '';
		$page_id = $page_data['page_id'];
	}
	
	?>
	<script>
	var page_id = "<?php echo $page_id; ?>"
	
	if(page_id=='forgot'){
		$('#login').slideToggle(); $('#forgot-pwd').slideToggle();
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
                       <?php echo form_open('login', array('id' => 'frmLogin')); ?>
					   <?php 
							if(isset($page_data['submit_message']) && $page_data['submit_message']!=''){
								echo $page_data['submit_message'];
							}else{
								echo display_flash('submit_message');
							}
						?>
                    <!-- Login Box-->
                     <div id="login">
                       <h1 class="heading border-bottom medium">Login<span class="doubledash"></span></h1>
                       <div class="Field">
                          <label for="email">Email:</label>
                          <input name="email" type="text" id="lemail" class="textField gray" />
                       </div>
                       
                       <div class="Field">
                          <label for="password">Password:</label>
                          <input name="password" type="password" id="password" class="textField gray" />
                       </div>
                       
                       <div class="Field">
                          <input name="" type="checkbox" value="" /> Remember me on this computer  |  <a onclick="$('#login').slideToggle(); $('#forgot-pwd').slideToggle();" href="javascript:;">Forgot Password?</a>
                       </div>
                       
                       <div class="Field">
                          <input type="submit" name="login_btn" value="Login" class="button" />
                       </div>
					  </div>
                     
                     <div id="forgot-pwd" style="display: none;">
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
                          <a  onclick="$('#forgot-pwd').slideToggle(); $('#login').slideToggle();" href="javascript:;">Back to Login</a>  &nbsp;&nbsp;|&nbsp;&nbsp; <span class="graytext">Back to</span> <a href="#">Homepage</a>
                       </div>
                        
                     </div>                       
                       <?php echo form_close(); ?>
                    </div>
                    <!-- / Login box -->