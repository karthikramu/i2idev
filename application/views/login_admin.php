<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AAVISHKAR</title>
<link href="<?php echo return_theme_path(); ?>css/style.css" rel="stylesheet" type="text/css" />

 <script type="text/javascript" src="<?php echo return_theme_path(); ?>js/jquery.js"></script> <script type="text/javascript" src="<?php echo return_theme_path(); ?>js/jquery.validation.js"></script>
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


</head>
<body>

	<?php //die("here");?>
    
<div class="login_wrapper"> 
	<div class="login_logo">
    	<a href="#"><img src="<?php echo return_theme_path(); ?>images/logo.png" /></a>
    </div>	
    <div class="login_form_container">
    	<h2>Admin Login</h2>
                   <?php  $message = $this->session->userdata('alertMsg');

if ($message) {
	
  echo $message ;
} ?>
    	<?php echo form_open('admin/adminLogin', array('id' => 'frmLogin')); ?>    
			<span id="message">
			<?php 
				if(isset($page_data['submit_message']) && $page_data['submit_message']!=''){
					echo $page_data['submit_message'];
				}else{
					echo display_flash('submit_message');
				}
			?></span>		
            <div class="form_items">
            	<label>E-mail: </label>
                <input name="email" type="text" id="email" class="textField gray" />
            </div>
            <div class="form_items">
            	<label>Password: </label>
                <input name="password" type="password" id="password" class="textField gray" />
            </div>
            <div class="form_action">
           
            	<input type="submit" value="Submit" />
            </div>
         <?php echo form_close(); ?>
        
        <div class="clear"> </div>   
    </div>
    
	<div class="clear"> </div>   
</div><!-- wrapper End Here -->    


</body>
</html>
