<?php $this->load->view('_blocks/header',$page_title)?>
<?
//echo "<pre>";
  //      print_r($welcome);
    //   exit;
?>
           

<div class="container">
<div class="welcome" style="width: 1000px;margin: auto;">
  <div class="left">
     <div class="welcome-inner">
       <h3>Welcome to our site !</h3>
          <div class="welcome-text">
           <?php
             if(!empty($welcome["value"]))
             {
               echo substr($welcome["value"],0,1000)."..";
             }
             ?>
          </div>
          <div class="clear"></div>
         <?php
             if(!empty($welcome["value"]))
             {
               if(strlen($welcome["value"]) >1000)
               {
                   echo '<a class="fancybox" href="#inline1" >Read more</a>';       
               }
             }
             ?>
         
     </div>

 </div>
   	<div id="inline1" style="width:400px;display: none;">
		<h3>Welcome to our site !</h3>
         <div class="welcome-inner">
		
			<?php  echo $welcome["value"];?>
		
        </div>
	</div>

<div class="right">
  <?
    $frontmsg="";
 $frontmsg=$this->session->userdata('frontmsg'); 
//echo "<pre>";
//print_r($this->session->all_userdata());
if(!empty($frontmsg))
{
    echo '<div class="frontmsg">'.$frontmsg.'</div>';
    $this->session->unset_userdata('frontmsg');
}
  ?>
 
  
  <?php
    if(!empty($list))
    {
        
       
   ?>
 <div class="carousel">
   <ul id="owl-demo" class="owl-carousel">
   <?
     foreach($list as $key => $detail)
      {
         $id=$detail["id"];
   ?>
               <!------Start ---->
        <li class="item">
              <div class="property">
              
             <div class="tab-container">
                <ul class="tabs">
                 <?php
                 if($this->fuel->auth->has_permission('property/emergencyprolink',"emergencyprolink")==true)
                 {
                 ?>
                 <li class="active" ><a href="<?php echo base_url()?>member/procedures_link/<?php echo $detail["id"];?>">Emergency <br /> Procedures Link</a></li>
                 <?
                 }
                 ?>
                 <?php
                 if($this->fuel->auth->has_permission('property/emergencydiagramlink',"emergencydiagramlink")==true)
                 {
                 ?> 
                 <li ><a href="<?php echo base_url()?>member/diagram_link/<?php echo $detail["id"];?>">Emergency <br /> Diagrams Link</a></li>
                <?php
                }
                ?>
                <?php
                 if($this->fuel->auth->has_permission('property/ecowardenlink',"ecowardenlink")==true)
                 { 
                 ?> 
                 <li><a href="<?php echo base_url()?>member/wardens_link/<?php echo $detail["id"];?>">ECO <br /> Wardens Link</a></li>
                <?php
                }
                ?>
                <?php
                 if($this->fuel->auth->has_permission('property/evacuationrpt',"evacuationrpt")==true)
                 { 
                 ?> 
                 <li><a href="<?php echo base_url()?>member/evacuations_report/<?php echo $detail["id"];?>">Evacuation <br /> Reports</a></li>
                 <?php
                 }
                 ?>
                </ul>
              </div> 
             
              <div class="tab-content">
                 <div class="tab-content-inner">
                    <div class="tab-content-inner">
                    <div class="tab-image">
                        <div  class="proimg">
                        <?php 
                            if(!empty($detail["getimages"]))
                            { 
                               
                                foreach($detail["getimages"] as $key => $imageslistdetail)
                                {
                                 
                                  ?>  
                            <img src="<?php echo site_url()."assets/upload/property/".$imageslistdetail["imagename"];?>" >   
                                  <?php 
                                    break;
                                } 
                                 
                            }
                            ?>
                        </div>
                        <!--<img src="<? echo img_path("tab-image-1.jpg");?>"> -->
                        <div>
                        <p><?php echo $detail["name"];?></p> </div>   
                         <div class="tab-shadow" >
                    </div>    
                    </div>
                   
                    
                    <div class="tab-map">
                    <!--<img src="<? echo img_path("tab-image-1.jpg");?>"> -->
                    <?php echo $detail["map"]["js"]; 
                    echo $detail["map"]["html"];?>
                    </div>
                    <div class="clear"></div>
                    
                 </div>
                    
                 </div>
              </div>
                  </div>
          </li>
                  <!------End ---->
                 
         <?php
         }
         ?>          
    </ul>  
    
      
  </div>
  <?php
         }
         ?>  
    <div class="link" >
  <a class="previous" href="javascript:void(0)"></a>
  <a class="next" href="javascript:void(0)"></a>
  </div>
 <!--
 <div class="customNavigation">
                <a class="btn prev">Previous</a>
                <a class="btn next">Next</a>
                <a class="btn play">Autoplay</a>
                <a class="btn stop">Stop</a>
              </div>
  -->
  
</div>


<div class="clear"></div>

</div>
</div>

    <style>
    #owl-demo{
        padding: 0;
    }
    #owl-demo li{ list-style-type: none; } 
    .customNavigation{
      text-align: center;
    }
    .customNavigation a{
      -webkit-user-select: none;
      -khtml-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }
    </style>


    <script>
    $(document).ready(function() {
   
    

			$('.fancybox').fancybox();
   
   
      var owl = $("#owl-demo");

      owl.owlCarousel({

      items : 1, //10 items above 1000px browser width
      itemsDesktop : [1000,5], //5 items between 1000px and 901px
      itemsDesktopSmall : [900,3], // 3 items betweem 900px and 601px
      itemsTablet: [600,2], //2 items between 600 and 0;
      itemsMobile : false // itemsMobile disabled - inherit from itemsTablet option
      
      });

      // Custom Navigation Events
      $(".next").click(function(){
        owl.trigger('owl.next');
      })
      $(".previous").click(function(){
        owl.trigger('owl.prev');
      })
      /*
      $(".play").click(function(){
        owl.trigger('owl.play',1000);
      })
      $(".stop").click(function(){
        owl.trigger('owl.stop');
      }) */


    });
    </script>
<div class="clear"></div>
<?php $this->load->view('_blocks/footer')?>