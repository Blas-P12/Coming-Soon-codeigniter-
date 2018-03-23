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
							 <li class="active" ><a href="<?php echo base_url()?>member/downloadprolink/<?php echo $getid;?>/pdf-<?php echo $getid;?>-1.pdf">Emergency <br /> Procedures</a></li>
							 <li><a href="<?php echo base_url()?>member/diagram_link/<?php echo $getid;?>">Emergency <br /> Diagrams</a></li>
							 <li><a href="<?php echo base_url()?>member/wardens_link/<?php echo $getid;?>">ECO <br /> Wardens</a></li>
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
<style>
#emergencycontent{width:100%;margin-top: 0%;}
.outerdiv{position: relative;width: 100%; }
.iframeheader1{position: absolute; min-height: 34px;background-color: #383838;width: 100%;}
</style> 
<div class="container">
    <div class="emergency-container" style="width: 100%;">

       <div class="emergency">
            
       </div>
       <!--<div class="clear"></div> -->
       <div class="emergency-content" id="emergencycontent">
	   <?php 
	  $link =  'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	  // $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
     $page = end($link_array);	
	  // echo  $actual_link;
	   
	        $file =BASE_URL.'assets/upload/property/pdf/'.$page.'';
	        $local_file = $_SERVER['DOCUMENT_ROOT'].'/assets/upload/property/pdf/'.$page.'';
			  //   $file = UPLOAD_ROOT_PATH."property/pdf/".$filename;
			 
				  ?>
				 <!-- <a href="<?php //echo $file ;?>">Pdf</a>-->
				  
         <div class="outerdiv">  
           <div class="iframeheader"></div>
           <div width="100%" >
           		<?php
           			if (file_exists($local_file)) {
           				?>
           				<iframe src="<?php echo $file;?>"  width="100%" height="1000" id="my_iframe"></iframe>
           				<?php
           			} else {
           				?>
           				<div   width="100%" id="my_iframe">
       						No emergency procedure uploaded
           				</div>
           				<?php
           			}
           		?>
		   </div>	
          </div>
       </div>
    </div>

</div>

<div class="clear"></div>
<script type="text/javascript">

//$('#my_iframe').bind('click', function(event) { alert('test'); });
//$("#my_iframe").contents().find("#outerContainer")



 /*jQuery('#my_iframe').click(function(){ 
  alert('click inside iframe');
 }); */
 //var iframeDoc = $('#my_iframe #outerContainer').addClass("test");
  // alert(iframeDoc);
 //return false;
 
 
 $('#my_iframe').load(function(){
      $('#outerContainer').addClass("test");
       /* var iframe = $('#my_iframe').contents();

        iframe.find("#outerContainer").click(function(){
               alert("test");
        });
        */
});
 /*
 var iframeDoc = $('#my_iframe').contents().get(0);
$(iframeDoc).bind('click', function( event ) {
    switch (event.which) {
        case 1:
            alert('Left mouse button pressed');
            break;
        case 2:
            alert('Middle mouse button pressed');
            break;
        case 3:
            alert('Right mouse button pressed');
            break;
        default:
            alert('You have a strange mouse');
    }
});
  */ 
 

</script>
<?php $this->load->view('_blocks/footer')?>