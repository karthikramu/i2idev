<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $page_data['page_title']; ?></title>
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