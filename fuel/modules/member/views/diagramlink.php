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
						    <li><a href="<?php echo base_url()?>member/downloadprolink/<?php echo $getid;?>/pdf-<?php echo $getid;?>-1.pdf">Emergency <br /> Procedures</a></li>
							<li class="active"><a href="<?php echo base_url()?>member/diagram_link/<?php echo $getid;?>">Emergency <br /> Diagrams</a></li>
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

  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/lightbox.css">


<style>
    #sync1 .item{

    background: #C9C9C9;

    color: #FFF;

    -webkit-border-radius: 3px;

    -moz-border-radius: 3px;

    border-radius: 3px;

    text-align: center;

    height: 300px;

    }

    #sync1 .item img{max-width:100%; max-height:100%}

    #sync2 .item{

    background: #C9C9C9;

   

    margin: 27px 26px 5px 5px;

    color: #FFF;

    -webkit-border-radius: 3px;

    -moz-border-radius: 3px;

    border-radius: 3px;

    text-align: center;

    cursor: pointer;

    }

    #sync2 .item h1{

    font-size: 18px;

    }

    #sync2 .synced .item{

    background: #FFF;

    }

     

.owl-buttons{display: none;}

.item > img {

    box-shadow: 0 0 10px 4px #ccc;
    padding: 10px;
   /* width: 100%;*/

}
.main1 {
   /* background: green none repeat scroll 0 0;*/
    float: left;
    height: 158px;
    width: 675px;
}
.second {
    
    
    margin: 30px 0 0;
    padding: 0;
    width: 100%;

}
.second > li {
    background: #f1f1f1 none repeat scroll 0 0;
    border-radius: 50%;
    color: black;
    display: block;
    float: left;
    height: 121px;
    margin-right: 6px;
    padding-top: 38px;
    text-align: center;
    text-decoration: none;
    width: 121px;
}
.second a {
    color: #fff;
    text-decoration: none;
}
.emergency {
    float: left;
    text-align: left;
    width: 322px;
}

.second > li:hover {
    background-color: #ED1C24;
    /*border-radius: 50px 64px 55px 0;*/
    /*transform: rotate(-41deg);*/
	/*background:url('/../assets/images/down-arrow.png') no-repeat scroll 0px 16px !important;*/
	
}
/*.top-header .header-left ul.topnavigation { display: none;}*/

.thumb_ED > div {
  display: none;
}
.example-image {
  height: 100% !important;
  width: 100% !important;
}
.thumb_ED > li {
  margin-bottom: 12px;
}
 </style>



<div class="container">
<!--  <div class="tab-container">
  <ul class="tabs">
                            <li><a href="http://auscompliancewer.com.au/member/welcome"><br />Home</a></li>
							<li><a href="http://auscompliancewer.com.au/member/procedures_link/46">Emergency <br /> Procedures</a></li>
							<li class="active"><a href="http://auscompliancewer.com.au/member/diagram_link/46">Emergency <br /> Diagrams</a></li>
							<li><a href="http://auscompliancewer.com.au/member/wardens_link/46">ECO <br /> Wardens</a></li>
							<li class="last"><a href="http://auscompliancewer.com.au/member/evacuations_report/46">Evacuation <br /> Reports</a></li>
						</ul>
  
</div>-->
       <div class="emergency" style="width: 100%;">
            <!--<h3>Emergency Diagrams Links</h3>-->
           <ul class="thumb_ED">
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
		   
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

      
		   
	
	  $mysql_runa=mysqli_query($cxn, "SELECT fuel_eme_diagrams_link_images.imagename, fuel_eme_diagrams_link.name,`order`
FROM `fuel_eme_diagrams_link_images`
JOIN `fuel_eme_diagrams_link` ON fuel_eme_diagrams_link_images.emediagramslinkid= fuel_eme_diagrams_link.id where propertyid='".$getid."' order by `order` ASC ");
    
    while ($rows=mysqli_fetch_assoc($mysql_runa)) {
     // print_r($rows);

 ?>
 

 	  <?php 
	   $value=$rows['imagename'];
	
 $imgsrc = 'http://auscompliancewer.com.au/assets/upload/property/thumbs/'.$value;
 
 ?>
     <li>
<figure class="levelImgContainer">
   <a class="example-image-link" href="<?php  echo $imgsrc; ?>" data-lightbox="example-1">
<img class="example-image" src="<?php  echo $imgsrc ; ?> " alt="" />
<figcaption class="levelCaption"> <?php echo  $value=$rows['name'];?></figcaption>
<p> </p>
</a>
          </figure>  
                	
            
            </li>   
			
	<?Php		
  

	}

 

    
		   ?>

 
		   
           	<!--<li>
<figure class="levelImgContainer">


      <a class="example-image-link" href="<?php //echo base_url(); ?>assets/images/level1.png" data-lightbox="example-1">
<img class="example-image" src="<?php //echo base_url(); ?>assets/images/level1.png" alt="image-1" />
<figcaption class="levelCaption">Level 1</figcaption>
</a>
          </figure>  
                	
                    
            
            </li>
			
		
			
			
            	<li>
<figure class="levelImgContainer">


      <a class="example-image-link" href="<?php //echo base_url(); ?>assets/images/level1.png" data-lightbox="example-1">
<img class="example-image" src="<?php //echo base_url(); ?>assets/images/level1.png" alt="image-1" />
<figcaption class="levelCaption">Level 2</figcaption>
</a>
          </figure>  
                	
                    
            
            </li>
			
			
			
			
			
			
			
			
			
         	<li>
<figure class="levelImgContainer">


      <a class="example-image-link" href="<?php //echo base_url(); ?>assets/images/level1.png" data-lightbox="example-1">
<img class="example-image" src="<?php //echo base_url(); ?>assets/images/level1.png" alt="image-1" />
<figcaption class="levelCaption">Level 3</figcaption>
</a>
          </figure>  
                	
                    
            
            </li>
			
			
			
			
			
          	<li>
<figure class="levelImgContainer">


      <a class="example-image-link" href="<?php //echo base_url(); ?>assets/images/level1.png" data-lightbox="example-1">
<img class="example-image" src="<?php //echo base_url(); ?>assets/images/level1.png" alt="image-1" />
<figcaption class="levelCaption">Level 4</figcaption>
</a>
          </figure>  
                	
                    
            
            </li>
			
			-->
           </ul> 
		   
		 
		   
       </div>
       




     





    <?php
if(!empty($list)) { 

  ?>

   <div id="sync1" class="owl-carousel">

  <?php  

    foreach($list as $key => $value)

    {

       $id=$value["id"]; 

?>

      <?php 

    if(!empty($imageslist[$id]))

    { 

       

        foreach($imageslist[$id] as $key => $imageslistdetail)

        {

          	//$imageslistdetail=$imageslist[$id][0];
			$strPrintedImg=$imageslistdetail["imagename"];
			$ext = explode(".",strtolower($imageslistdetail["imagename"]));
			$ext = end($ext);
			if(($ext=="png") || ($ext=="jpg") || ($ext=="jpeg") || ($ext=="gif") )
				{?> <div class="item"><img src="<?php echo base_url()."assets/upload/property/".$imageslistdetail["imagename"];?>" alt=""> </div> <?php }
			else
				{?> <div class="item"><img src="<?php echo base_url();?>assets/upload/property/pdf_icon.jpg"> </div><?php }

           // break;

        } 

         

    }

    

   }

   ?>

   </div>

   <?php
}          

    ?>   

     

      <?php

if(!empty($list)) 

{ 

   ?> 

    <div id="sync2" class="owl-carousel">

  <?php

    foreach($list as $key => $value)

    {

       $id=$value["id"]; 

?>

      <?php 

    if(!empty($imageslist[$id]))

    { 

       

        foreach($imageslist[$id] as $key => $imageslistdetail)

        {

         // thumbs
			//if(strtolower($strPrintedImg)!=strtolower($imageslistdetail["imagename"]))
			//{
				$ext = explode(".",strtolower($imageslistdetail["imagename"]));
				$ext = end($ext);
				if(($ext=="png") || ($ext=="jpg") || ($ext=="jpeg") || ($ext=="gif") )
				{ ?><div class="item"><img src="<?php echo base_url()."assets/upload/property/thumbs/".$imageslistdetail["imagename"];?>" alt=""> </div><?php }
				else
				{ ?><div class="item"><img src="<?php echo base_url();?>assets/upload/property/pdf_icon.jpg"> </div><?php }
			//}
          

           // break;

        } 

         

    }

    

   }

   ?>

     </div>

   <?php
}      
    ?>  
</div>

<script>

    $(document).ready(function() {
									var sync1 = $("#sync1");
									var sync2 = $("#sync2");
									sync1.owlCarousel({
									singleItem : true,
									slideSpeed : 1000,
									navigation: true,
									pagination:false,
									autoHeight :true,
									autoWidth:true, 
									afterAction : syncPosition,
									responsiveRefreshRate : 120,
    							});

    sync2.owlCarousel({
		items : 4,
		itemsDesktop : [1199,10],
		itemsDesktopSmall : [979,10],
		itemsTablet : [768,8],
		itemsMobile : [479,4],
		pagination:false,
		responsiveRefreshRate : 100,
		afterInit : function(el){el.find(".owl-item").eq(0).addClass("synced");}
    });

    function syncPosition(el){
								var current = this.currentItem;
								$("#sync2")
								.find(".owl-item")
								.removeClass("synced")
								.eq(current)
								.addClass("synced")
								if($("#sync2").data("owlCarousel") !== undefined){ center(current) }
    						}
    
	$("#sync2").on("click", ".owl-item", function(e){
		e.preventDefault();
		var number = $(this).data("owlItem");
		sync1.trigger("owl.goTo",number);
    });

     

    function center(number)	{
		var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
		var num = number;
		var found = false;
		for(var i in sync2visible) { if(num === sync2visible[i]){ var found = true; }}
		
		if(found===false)
			{
				if(num>sync2visible[sync2visible.length-1])
					{sync2.trigger("owl.goTo", num - sync2visible.length+2)}
				else
					{
						if(num - 1 === -1){num = 0;}
						sync2.trigger("owl.goTo", num);
					}
			} 
		else if(num === sync2visible[sync2visible.length-1])
			{sync2.trigger("owl.goTo", sync2visible[1])} 
		else if(num === sync2visible[0])
			{sync2.trigger("owl.goTo", num-1)}
    }
  		$(document).mousedown(function(event) 
			{
			    switch (event.which) 
					{ 
						case 3:
							alert('You have no right download');
							return false;
            				break;
                	}
        	});
    });

</script>

<div class="clear">&nbsp;</div>

<div class="clear">&nbsp;</div>

<div class="clear">&nbsp;</div>

<div class="clear">&nbsp;</div>

<div class="clear">&nbsp;</div>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/lightbox-plus-jquery.min.js"></script>

<?php $this->load->view('_blocks/footer')?>