<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>AAVISHKAR</title>
<link href="<?php echo return_theme_path(); ?>css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo return_theme_path(); ?>css/validationEngine.jquery.css" rel="stylesheet" type="text/css" />


 <script type="text/javascript" src="<?php echo return_theme_path(); ?>js/jquery-1.8.2.js"></script> <script type="text/javascript" src="<?php echo return_theme_path(); ?>js/jquery.validationEngine.js"></script><script type="text/javascript" src="<?php echo return_theme_path(); ?>js/jquery.validationEngine-en.js"></script>
 <script type="text/javascript">

	     jQuery(document).ready(function(){
										 
						 
               
                jQuery("#user").validationEngine();
				
            });
</script>
 </head>
<body>

	<?php //die("here");?>
    
<div class="login_wrapper1"> 
	<div class="login_logo1">
    	<a href="#"><img src="<?php echo return_theme_path(); ?>images/logo.png" /></a>
    </div>	
    <div class="login_form_container1">
    	<h2 >Registration Form</h2>
    	<?php echo form_open('registration/register', array('id' => 'user')); ?>    
        		<span id="message">
			<?php 
				if(isset($page_data['submit1_message']) && $page_data['submit1_message']!=''){
					echo $page_data['submit1_message'];
				}else{
					echo display_flash('submit1_message');
				}
			?></span>	
            <div class="form_items1">
            	<label>First Name: </label>
                <input name="Name" type="text" id="Name" class="textField gray validate[required] " />
               
            </div>
            <div class="form_items1">
            	<label>Last Name: </label>
                <input name="LName" type="text" id="LName" class="textField gray validate[required] " />
               
            </div>
            <div class="form_items1">
            	<label>Institutional Title: </label>
                <input name="institutionalTitle" type="text" id="institutionalTitle" class="textField gray validate[required]" />
            </div>
            <div class="form_items1">
            	<label>E-mail: </label>
                <input name="email" type="text" id="email" class="textField gray validate[required,custom[email]]" />
            </div>	
             <div class="form_items1">
            	<label>Mobile: </label>
                <input name="mobile" type="text" id="mobile" class="textField gray validate[required]" />
            </div>	
            <div class="form_items1">
            	<label>Citizenship: </label>
                <input name="citizenship" type="text" id="citizenship" class="textField gray validate[required]" />
            </div>
            <div class="form_items1">
            	<label>Password: </label>
                <input name="password" type="password" id="password" class="textField gray validate[required]" />
            </div>
             <div class="form_items1">
            	<label>Confirm Password: </label>
                <input name="confirmPassword" type="password" id="confirmPassword" class="textField gray validate[required,equals[password]]" />
            </div>
            
            
              <div class="form_items">
            	<label>Address: </label>
               
            <textarea name="Address"  id="Address" class="textField gray validate[required]" cols="50" rows="8"></textarea></div> 
            <div class="form_action1">
            	<input type="submit" value="Submit" />
            </div>
         <?php echo form_close(); ?>
        
        <div class="clear"> </div>   
    </div>
    
	<div class="clear"> </div>   
</div><!-- wrapper End Here -->    


</body>
</html>
