<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="<?php echo return_theme_path(); ?>css/style.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

</head>
<body>

	<div class="header">
    	<div class="wrapper">
            <div class="logo left">
                <a href="<?php echo site_url('user/home'); ?>"> <img src="<?php echo return_theme_path(); ?>images/logo.jpg" /></a>
            </div>
            
            <div class="detail right">
               <label>Welcome <a class="user-name" href="<?php echo site_url('user/home'); ?>"><?php echo ucfirst($this->session->userdata('username')); ?></a><a class="logout" href="<?php echo site_url('user/logout'); ?>">Logout</a>
            </div>
            
            <div class="clear"> </div>
        </div>
    </div>
		
			
<div class="wrapper"> 
	
    <div class="form_container">
    <h2>Non Active Customers</h2>
    <?php  $message = $this->session->userdata('activeMsg');

if ($message) {
  echo $message;
  
   $this->session->unset_userdata('activeMsg');
} ?>
    <table>
    	<tr>
					<th>Inventor Name</th>
					<th>Invention Title</th>
					<th>Email</th>
                    <th>Action</th>
				</tr>
    
          <?php
 $query = $this->db->query('SELECT * FROM users where isactive="N"');

foreach ($query->result() as $row)
{
 
?>
  
					<tr>
						
						<td><?php echo $row->investigator_name; ?></td>
						<td><?php echo $row->institutional_title; ?></td>
						<td><?php echo $row->email; ?></td>
                        <td><a href="confirmUser?id=<?php echo $row->id; ?>">Confirm</a></td>
						
					</tr>
					                
                    <?php
				
}

?>
      <?php 
				if(isset($page_data['submit_message']) && $page_data['submit_message']!=''){
					echo $page_data['submit_message'];
				}else{
					echo display_flash('submit_message');
				}
			?>

				
			</table>
           
    		
    </div>
    
    
    
    <div class="form_container">
    <h2>Active Customers</h2>
        <?php  $message = $this->session->userdata('deactiveMsg');

if ($message) {
  echo $message;
 
  $this->session->unset_userdata('deactiveMsg');
} ?>
    <table>
    	<tr>
					<th>Inventor Name</th>
					<th>Invention Title</th>
					<th>Email</th>
                    <th>Action</th>
				</tr>
    
          <?php
 $query = $this->db->query('SELECT * FROM users where isactive="Y"');

foreach ($query->result() as $row)
{
 
?>
  
					<tr>
						
						<td><?php echo $row->investigator_name; ?></td>
						<td><?php echo $row->institutional_title; ?></td>
						<td><?php echo $row->email; ?></td>
                        <td><a href="deActiveUser?id=<?php echo $row->id; ?>">Deactive</a></td>
						
					</tr>
					                
                    <?php
				
}

?>
      

				
			</table>
          
    		
    </div>
    
    
    
    
    
    
        <div class="footer">
    	<div class="logo left">
            <a href="#"> <img src="<?php echo return_theme_path(); ?>images/logo.png" /></a>
        </div>
        <div class="copyright right">
        	Aavishkar Proprietary & Confidential
        </div>
    </div>

	<div class="clear"> </div>   
</div><!-- wrapper End Here -->    


</body>
</html>

    