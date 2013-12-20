<script type="text/javascript" src="<?php echo return_theme_path(); ?>/js/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function() {

	$("#frmResetPass").validate({
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
			cnpass: {
				required: true,
				equalTo: "#npass"
			}

		},

		onkeyup: false,

		messages: {
			cnpass: {
				required: "Please provide a password",
				equalTo: "Please enter the same password as above"
			}
		}

	});
});
</script>

	
	   <!-- content -->   
   <!-- Student/Customer - Login/Create Profile Section -->
   <div class="block-20 main-block">
    
      <div>
        <h1 class="heading giant indent overlap">Reset Password</h1>
         <div class="whitebox entrybox">         
            <span class="quotemark-left"> </span>
            
            <div class="form-inner">
				<div class="halfform login only">
                    
                        <?php echo form_open('login/resetpassword', array('id' => 'frmResetPass')); ?>
							  <div id="login">
								<span id="message"><?php echo @$page_data['submit_message'] ; ?></span>
								<h1 class="heading border-bottom medium">Reset Password<span></span></h1>
								
								<div class="Field">
									<label for="npass">New Password:</label>
									<input name="npass" type="password" id="npass" class="textField gray" />
								</div>
								<div class="Field">
									<label for="cnpass">Confirm New Password:</label>
									<input name="cnpass" type="password" id="cnpass" class="textField gray" />
								</div>
									<input type="hidden" name="confirm_code" id="confirm_code" value="<?php $prq=@$this->uri->segment(2); if($prq!=''){ echo $this->uri->segment(2); } else{ echo set_value('confirm_code'); } ?>"/>
								<div class="Field">
									<input type="submit" name="reset_btn" value="Submit" class="button" />
								</div>
							  </div>
						 <?php echo form_close(); ?>
            
                  
					</div>
					</div>
				</div>
			</div>
		</div>
                    <!-- / Login box -->
	