<script type="text/javascript" src="<?php echo return_theme_path(); ?>/js/jquery.validate.js"></script>
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
email: {
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

email: {
required: true,
email: "Enter a valid email address.",
remote: $.validator.format("Sorry! This e-mail is not registered.")
}
}

});
});
</script>

<!-- Login -->
<?php echo form_open('forgotpassword', array('id' => 'frm_forgot')); ?>
<div class="halfform login left">
	<h1 class="heading border-bottom medium">Forgot Password?<span></span></h1>
	
	<div class="Field" id="l_form_message_hidden" style="display:none;"></div>
	<div class="Field" id="w_l_form_message_block"></div>
	
	<div class="Field">
		<label for="email">E-mail:</label>
		<input name="email" type="text" id="email" class="textField gray" />
	</div>

	<div class="Field">
		<input type="submit" name="login_btn" value="Submit" class="button" />
	</div>
</div>
<?php echo form_close();  ?>
<!-- / Login -->