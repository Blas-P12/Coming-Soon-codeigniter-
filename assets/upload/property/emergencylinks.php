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
	
//////////////////////////////////////////


<?php
//Open a new connection to the MySQL server
$user="act0786";
$host="localhost";
$password="hP+miybi6~Qr";
$database = "act0786";

$cxn = mysqli_connect($host,$user,$password,$database);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}


   echo $mysql_run=mysqli_query($cxn, "SELECT * FROM fuel_eme_diagrams_link_images");
    
    while ($row=mysqli_fetch_assoc($mysql_run)) {
        
    
        //header("Content-length: $size");
        //header("Content-type: $type");
        //header("Content-Disposition: attachment; filename=$name");
        echo $image=$row['imagename'];
		echo '<img src="assets/upload/property/'.$image.'" />';
		echo '<img src="'.$image.'" style="width:128px;height:128px">';
       
    }
    
    
    




?>
















/////////////////////////
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
		<div class="header-left"><h3>BUILDING EMERGENCIES</h3><h3 class="red_text">RESPONSE PORTAL</h3>  
			<?php
			   if($this->fuel->auth->is_logged_in()==true)
				  {  
					?> 
					<!--<img src="<?php echo img_path("exit.png");?>" height="30" width="30" > -->
					<div class="logout"><a href="<?php echo base_url()?>member/logout" title="Logout" alt="Logout">Logout</a></div>
			<?php } 
			
			if(!isset($use_back_btn))
				{
					if($this->uri->rsegment(1)=="page_router"){$use_back_btn=0;}
				}// home page
		//	echo $this->uri->rsegment(3); exit;
           $getid=$this->uri->rsegment(3); 
			if(!empty($getid))
				{
				    
				?>
						<div class="tab-container">
                        <ul class="tabs">
                            <li><a href="<?php echo base_url()?>member/welcome">Home</a></li>
							<li class="active"><a href="<?php echo base_url()?>member/procedures_link/<?php echo $getid;?>">Emergency <br /> Procedures</a></li>
							<li ><a href="<?php echo base_url()?>member/diagram_link/<?php echo $getid;?>">Emergency <br /> Diagrams</a></li>
							<li ><a href="<?php echo base_url()?>member/wardens_link/<?php echo $getid;?>">ECO <br /> Wardens</a></li>
							<li class="last" ><a href="<?php echo base_url()?>member/evacuations_report/<?php echo $getid;?>">Evacuation <br /> Reports</a></li>
						</ul>
                        </div>
					<?php 
				}
			else
				{ ?>
					<!--	<ul class="topnavigation">
							<li ><a href="<?php echo base_url()?>member/procedures_link/1">Emergency Procedures</a></li>
							<li ><a href="<?php echo base_url()?>member/diagram_link/1">Emergency Diagrams</a></li>
							<li ><a href="<?php echo base_url()?>member/wardens_link/1">ECO Wardens</a></li>
							<li class="last"><a href="<?php echo base_url()?>member/evacuations_report/1">Evacuation Reports</a></li>
						</ul> -->
			<?php } ?>
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
<?php
  //echo "<pre>";
  //print_r($prolinks);
  
  //print_r($protransids);
  //exit;
?> 
<div class="container">
    <div class="emergency-container">

       <div class="emergency">
            <h3>Emergency Procedure Links</h3>
               <p>Lorem Ipsum passages and more recently with desktop publishing software.
                  Aldus PageMaker including versions of simple dummy versio text Lorem Ipsum.like Aldus PageMaker including versions of simple dummy versio text .</p>

       </div>
       <div class="clear"></div>
       <div class="emergency-content">
        
       <ul class="emergency-link">
	   	<?php
		$strurl="";
		if($this->fuel->auth->has_permission('property/evacuation',"evacuation")==true)
        	{ 
				if(!empty($protransids) && in_array(1,$protransids))
					{
					  	$filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[1];
						if (file_exists($filename_main) && !empty($protrans[1])) 
							{
								$strurl=base_url().'member/downloadprolink/'.$protrans[1];
								$strurl="window.location.href='".$strurl."'";
								//echo anchor('member/downloadprolink/'.$protrans[1],"Evacuation"); 
							}
						else
							{$strurl="alert('No pdf upload'); return false;";}
					}
			   	else
					{$strurl="alert('No pdf upload'); return false;";}
          	}
		  else
          	{$strurl="alert('You have no permission to pdf download'); return false;";}
		?>
       <li class="evacuation" <?php if($strurl!=""){ echo'onclick="'.$strurl.'"';}?> >
          <a href=" javascript:void(0);">Evacuation</a>     
       </li>
	   <?php
	   $strurl="";
	   	if($this->fuel->auth->has_permission('property/firesmokeemergencies',"firesmokeemergencies")==true)
			{ 
				if(!empty($protransids) && in_array(3,$protransids))
					{	// echo $protrans[1];
						$filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[3];
						if (file_exists($filename_main) && !empty($protrans[3])) 
							{
								//echo anchor('member/downloadprolink/'.$protrans[3],"Fire & smoke <br/>Emergency");
								$strurl=base_url().'member/downloadprolink/'.$protrans[3];
								$strurl="window.location.href='".$strurl."'";
							}
						else
							{ $strurl="alert('No pdf upload'); return false;"; }
				   }
			   else
				   { $strurl="alert('No pdf upload'); return false;"; }
			}
		else
			{ $strurl="alert('You have no permission to pdf download'); return false;"; }
	   ?>
       <li class="fire-smoke" <?php if($strurl!=""){ echo'onclick="'.$strurl.'"';}?>>
         <a href=" javascript:void(0);"  >Fire & smoke <br/>Emergency</a> 
       </li>
	   <?php 
	    	$strurl="";
	   	 	if($this->fuel->auth->has_permission('property/emergencies',"emergencies")==true)
				{
					if(!empty($protransids) && in_array(5,$protransids))
						{	// echo $protrans[1];
							 $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[5];
							if (file_exists($filename_main) && !empty($protrans[5])) 
								{
									//echo anchor('member/downloadprolink/'.$protrans[3],"Fire & smoke <br/>Emergency");
									$strurl=base_url().'member/downloadprolink/'.$protrans[5];
									$strurl="window.location.href='".$strurl."'";
								}
							else
								{ $strurl="alert('No pdf upload'); return false;"; }
					   }
				   else
					   { $strurl="alert('No pdf upload'); return false;"; }
				}
			else
				{ $strurl="alert('You have no permission to pdf download'); return false;"; }
	   ?>
       <li class="emergency-main-box" <?php if($strurl!=""){ echo'onclick="'.$strurl.'"';}?>><a href=" javascript:void(0);">Emergency</a></li>
	    <?php 
	    	$strurl="";
	   	 	 if($this->fuel->auth->has_permission('property/bombarsonthreat',"bombarsonthreat")==true)
				{
					 if(!empty($protransids) && in_array(7,$protransids))
						{	// echo $protrans[1];
							 $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[7];
							if (file_exists($filename_main) && !empty($protrans[7])) 
								{
									//echo anchor('member/downloadprolink/'.$protrans[3],"Fire & smoke <br/>Emergency");
									$strurl=base_url().'member/downloadprolink/'.$protrans[7];
									$strurl="window.location.href='".$strurl."'";
								}
							else
								{ $strurl="alert('No pdf upload'); return false;"; }
					   }
				   else
					   { $strurl="alert('No pdf upload'); return false;"; }
				}
			else
				{ $strurl="alert('You have no permission to pdf download'); return false;"; }
	   ?>
       <li class="bomb-threat" <?php if($strurl!=""){ echo'onclick="'.$strurl.'"';}?>><a href=" javascript:void(0);">Bomb/Arson<br/>Threat</a></li>
       </ul>
	   
       <ul class="emergency-link-2">
        <?php 
	    	$strurl="";
	   	 	if($this->fuel->auth->has_permission('property/externalemergencies',"externalemergencies")==true)
				{
					 if(!empty($protransids) && in_array(2,$protransids))
						{
							$filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[2];
							if (file_exists($filename_main) && !empty($protrans[2])) 
								{
									$strurl=base_url().'member/downloadprolink/'.$protrans[2];
									$strurl="window.location.href='".$strurl."'";
								}
							else
								{ $strurl="alert('No pdf upload'); return false;"; }
					   }
				   else
					   { $strurl="alert('No pdf upload'); return false;"; }
				}
			else
				{ $strurl="alert('You have no permission to pdf download'); return false;"; }
	   ?>
	   <li class="external-emergencies" <?php if($strurl!=""){ echo'onclick="'.$strurl.'"';}?>><a href="javascript:void(0);">External <br>Emergency</a></li>
	   
	   <?php 
	    	$strurl="";
	   	 	if($this->fuel->auth->has_permission('property/medicalemergencies',"medicalemergencies")==true)
				{
					 if(!empty($protransids) && in_array(4,$protransids))
						{
							$filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[4];
							if (file_exists($filename_main) && !empty($protrans[4])) 
								{
									$strurl=base_url().'member/downloadprolink/'.$protrans[4];
									$strurl="window.location.href='".$strurl."'";
								}
							else
								{ $strurl="alert('No pdf upload'); return false;"; }
					   }
				   else
					   { $strurl="alert('No pdf upload'); return false;"; }
				}
			else
				{ $strurl="alert('You have no permission to pdf download'); return false;"; }
	   ?>
       <li class="medical-emergencies" <?php if($strurl!=""){ echo'onclick="'.$strurl.'"';}?>><a href=" javascript:void(0);">Medical<br/>Emergency</a></li>
	   <?php 
	    	$strurl="";
	   	 	if($this->fuel->auth->has_permission('property/internalemergencies',"internalemergencies")==true)
				{
					 if(!empty($protransids) && in_array(6,$protransids))
						{
							$filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[6];
							if (file_exists($filename_main) && !empty($protrans[6])) 
								{
									$strurl=base_url().'member/downloadprolink/'.$protrans[6];
									$strurl="window.location.href='".$strurl."'";
								}
							else
								{ $strurl="alert('No pdf upload'); return false;"; }
					   }
				   else
					   { $strurl="alert('No pdf upload'); return false;"; }
				}
			else
				{ $strurl="alert('You have no permission to pdf download'); return false;"; }
	   ?>
       <li class="internal-emergencies" <?php if($strurl!=""){ echo'onclick="'.$strurl.'"';}?>><a href=" javascript:void(0);">Internal <br>Emergency</a></li>
	   <?php 
	    	$strurl="";
	   	 	if($this->fuel->auth->has_permission('property/personalthreat',"personalthreat")==true)
				{
					 if(!empty($protransids) && in_array(8,$protransids))
						{
							$filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[8];
							if (file_exists($filename_main) && !empty($protrans[8])) 
								{
									$strurl=base_url().'member/downloadprolink/'.$protrans[8];
									$strurl="window.location.href='".$strurl."'";
								}
							else
								{ $strurl="alert('No pdf upload'); return false;"; }
					   }
				   else
					   { $strurl="alert('No pdf upload'); return false;"; }
				}
			else
				{ $strurl="alert('You have no permission to pdf download'); return false;"; }
	   ?>
       <li class="personal-threat" <?php if($strurl!=""){ echo'onclick="'.$strurl.'"';}?>>
        <a href=" javascript:void(0);" >Personal<br/>Threat</a>
          
       </li>
       </ul>
       
      
       </div>
    </div>

</div>

<div class="clear"></div>
<?php $this->load->view('_blocks/footer')?>