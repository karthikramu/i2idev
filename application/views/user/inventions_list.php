<script type="text/javascript" src="<?php echo return_theme_path(); ?>js/jquery.js"></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/thickbox-compressed.js'></script>
<script type='text/javascript' src='<?php echo return_theme_path(); ?>js/jquery.autocomplete.js'></script>

<link rel="stylesheet" type="text/css" href="<?php echo return_theme_path(); ?>css/jquery.autocomplete.css" />

<link rel="stylesheet" type="text/css" href="<?php echo return_theme_path(); ?>css/thickbox.css" />
		
			
<div class="wrapper"> 
	
    <div class="form_container">
	<?php if($page_data['user_type']!=2){?>
		<a href="<?php echo site_url('user/invention').'/new'; ?>" class="green-button">New Invention</a> 
	<?php } ?>
    		<table>
				<tr>
					<th>Invention Number</th>
					<th>Inventor Name</th>
					<th>Invention Title</th>
					<th>Status</th>
					<th>Documents</th>
					<th>Delete</th>
				</tr>
					<tr>
						<td>20001</td>
						<td><?php echo $this->session->userdata('username') ; ?></td>
						<td></td>
						<td>Patent Pending</td>
						<td></td>
						<td>Delete</td>
					</tr>
					<tr>
						<td>20002</td>
						<td><?php echo $this->session->userdata('username') ; ?></td>
						<td></td>
						<td>Patent Issued</td>
						<td></td>
						<td>Delete</td>
					</tr>
					<tr>
						<td>20003</td>
						<td><?php echo $this->session->userdata('username') ; ?></td>
						<td></td>
						<td>Patent Filing In-Progress</td>
						<td></td>
						<td>Delete</td>
					</tr>
					<tr>
						<td>20004</td>
						<td><?php echo $this->session->userdata('username') ; ?></td>
						<td></td>
						<td>Patent Pending</td>
						<td></td>
						<td>Delete</td>
					</tr>
					<tr>
						<td>20005</td>
						<td><?php echo $this->session->userdata('username') ; ?></td>
						<td></td>
						<td>Closed</td>
						<td></td>
						<td>Delete</td>
					</tr>
				
				<?php echo $page_data['user_inventions'];  ?>
			</table>
    </div>
    