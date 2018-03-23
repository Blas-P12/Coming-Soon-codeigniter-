<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 	<title><?php if(!empty($page_title)) {echo $page_title;} ?></title>
	<meta name="keywords" content="<?php echo fuel_var('meta_keywords')?>">
	<meta name="description" content="<?php echo fuel_var('meta_description')?>">


	<?php

		echo css('stylesheet');
        	echo css('table');
        echo css('owl.carousel');
       echo js('jquery-1.10.2.min');  
       echo js('owl.carousel');
       echo js('jquery.fancybox');      
       echo css('jquery.fancybox'); 
	//	if (!empty($is_blog)):
	//		echo $CI->fuel_blog->header();
	//	endif;
    
	?>
	
</head>
<body>
<div class="top-header">
	<div class="container">
		<div class="header-left"><h3>BUILDING EMERGENCIES</h3><h3 class="red_text">RESPONSE PORTAL</h3>  
			<?php
			   if($this->fuel->auth->is_logged_in()==true)
				  {  
					?> 
					<!--<img src="<?php echo img_path("exit.png");?>" height="30" width="30" > -->
					<div class="logout"><a href="<?php echo base_url()?>member/logout" title="Logout" alt="Logout">Logout</a></div>
			<?php } 
			
			if(!isset($use_back_btn)){if($this->uri->rsegment(1)=="page_router"){$use_back_btn=0;}}// home page
			if(isset($use_back_btn))
				{
					if(!($use_back_btn==0)){ ?><div class="backbtn"><a href=javascript:void(0)" onclick="window.history.go(-1);" title="Back" alt="Logout">Back</a></div><?php }
				}
			else
				{ ?><div class="backbtn"><a href=javascript:void(0)" onclick="window.history.go(-1);" title="Back" alt="Logout">Back</a></div><?php } ?>
		</div>

		<div class="header-right">
			<?php
			   if($this->fuel->auth->is_logged_in()==true)
					{?><a href="<?php echo base_url(); ?>member/welcome"><img src="<?php echo img_path("logo.png");?>"></a><?php }
				else
					{ ?><a href="<?php echo base_url()?>"><img src="<?php echo img_path("logo.png");?>"></a> <?php }
			?>
		</div>
	 </div>
</div>
<div class="clear"></div>