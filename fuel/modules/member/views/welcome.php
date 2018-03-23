
<style>

.welcome {
  margin-bottom: 4%;
float:none !important;
}


</style>
<?php $this->load->view('_blocks/header',$page_title)?>
<?php
//echo "<pre>";
  //      print_r($welcome);
    //   exit;
?>
           

<div class="container">
<div class="welcome" style="width: 1000px;margin: auto ;float:none;">
  <div class="left">
     <div class="welcome-inner">
       <h2>Website Overview</h2>
          <div class="welcome-text">
           <?php
             if(!empty($welcome["value"]))
             {
   		
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

      
		   
	
	  $mysql_runa=mysqli_query($cxn, "SELECT `welcome_id`, `pera` FROM `fuel_welcome` WHERE welcome_id=1");
    
    while ($rows=mysqli_fetch_assoc($mysql_runa)) {
     // print_r($rows);



	  echo $pera=$rows['pera'];
	
	}



             }
             ?>
          </div>
          <div class="clear"></div>
         <?php
             if(!empty($welcome["value"]))
             {
               


               {
                   







//echo '<a class="fancybox" href="#inline1" >Read more</a>';  





          }


             }
             ?>
         
     </div>

 </div>
   	<div id="inline1" style="width:400px;display: none;">
		
<?Php
	 


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

      
		   
	
	  $mysql_runa=mysqli_query($cxn, "SELECT `welcome_id`, `pera` FROM `fuel_welcome` WHERE welcome_id=1");
    
    while ($rows=mysqli_fetch_assoc($mysql_runa)) {
     // print_r($rows);



	  echo $pera=$rows['pera'];
	
	}

	?>
	
 




		
        </div>
	</div>

<div class="right">
  <?php
    $frontmsg="";
    
//print_r( $frontmsg=$this->session->userdata('frontmsg')); 
echo "<pre>";
$abcd=$this->session->all_userdata();
$data=$abcd['fuel_634c0b3bde221cf7e12f24648ed11051']['id'];
echo "</pre>";

if(!empty($data))
{
     '<div class="frontmsg">'.$data.'</div>';
    $this->session->unset_userdata('$data');
//print_r($data);

}
  ?>

  
  <?php
    if(!empty($list))
    {
        
       
   ?>
    
 <div class="carousel">
   <ul id="owl-demo" class="owl-carousel">
   <?php
     foreach($list as $key => $detail)
      {
         $id=$abcd['fuel_634c0b3bde221cf7e12f24648ed11051']['id'];
   //      print_r($id);
   ?>
       <?php //echo // $id;?>
               <!------Start ---->
        <li class="item">
              <div class="property">
              
             <div class="tab-container">
                <ul class="tabs">
				<?php //echo $detail["id"];?>
	            <?php
                 if($this->fuel->auth->has_permission('property/emergencydiagramlink',"emergencydiagramlink")==true)
                 {
                 ?> 
				 <li class="active" ><a href="<?php echo base_url()?>member/welcome/<?php echo $detail["id"];?>">Home</a></li>
                 <?php
                 }
                 ?>
				
                 <?php
                 if($this->fuel->auth->has_permission('property/emergencyprolink',"emergencyprolink")==true)
                 {
			     $did=$abcd['fuel_634c0b3bde221cf7e12f24648ed11051']['id'];
                            // print_r($did);
                 ?>
                 <li><a href="<?php echo base_url()?>member/downloadprolink/<?php echo $detail["id"];?>/pdf-<?php echo $detail["id"];?>-1.pdf">Emergency <br /> Procedures</a></li>
                 <?php
                 }
                 ?>
				 
				 
                 <?php
                 if($this->fuel->auth->has_permission('property/emergencydiagramlink',"emergencydiagramlink")==true)
                 {
                 ?> 
                 <li ><a href="<?php echo base_url()?>member/diagram_link/<?php echo $detail["id"];?>">Emergency <br /> Diagrams</a></li>
                <?php
                }
                ?>
				
				
				
                <?php
                 if($this->fuel->auth->has_permission('property/ecowardenlink',"ecowardenlink")==true)
                 { 
                 ?> 
                 <li><a href="<?php echo base_url()?>member/wardens_link/<?php echo $detail["id"];?>">ECO <br /> Wardens</a></li>
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
                            <img src="<?php echo base_url()."assets/upload/property/".$imageslistdetail["imagename"];?>" >   
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