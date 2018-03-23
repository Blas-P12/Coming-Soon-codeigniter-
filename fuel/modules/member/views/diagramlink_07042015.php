<?php $this->load->view('_blocks/header')?>
<?php
  //echo "<pre>";
  //print_r($prolinks);
  
  //print_r($protransids);
  //exit;
?>
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
    #sync1 .item img{width:100%; height:100%}
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
    width: 100%;
}
</style>
<div class="container">
       <div class="emergency">
            <h3>Emergency Diagrams Links</h3>
       </div>
       
    <?php
if(!empty($list)) 
{ 
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
         // thumbs
          ?>  
           
         <div class="item"><img src="<?php echo base_url()."assets/upload/property/".$imageslistdetail["imagename"];?>" alt=""> </div>
          <?php 
            break;
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
          ?>  
           
         <div class="item"><img src="<?php echo base_url()."assets/upload/property/thumbs/".$imageslistdetail["imagename"];?>" alt=""> </div>
          <?php 
            break;
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
    afterInit : function(el){
    el.find(".owl-item").eq(0).addClass("synced");
    }
    });
     
    function syncPosition(el){
    var current = this.currentItem;
    $("#sync2")
    .find(".owl-item")
    .removeClass("synced")
    .eq(current)
    .addClass("synced")
    if($("#sync2").data("owlCarousel") !== undefined){
    center(current)
    }
    }
     
    $("#sync2").on("click", ".owl-item", function(e){
    e.preventDefault();
    var number = $(this).data("owlItem");
    sync1.trigger("owl.goTo",number);
    });
     
    function center(number){
    var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
    var num = number;
    var found = false;
    for(var i in sync2visible){
    if(num === sync2visible[i]){
    var found = true;
    }
    }
     
    if(found===false){
    if(num>sync2visible[sync2visible.length-1]){
    sync2.trigger("owl.goTo", num - sync2visible.length+2)
    }else{
    if(num - 1 === -1){
    num = 0;
    }
    sync2.trigger("owl.goTo", num);
    }
    } else if(num === sync2visible[sync2visible.length-1]){
    sync2.trigger("owl.goTo", sync2visible[1])
    } else if(num === sync2visible[0]){
    sync2.trigger("owl.goTo", num-1)
    }
    }
  
  $(document).mousedown(function(event) {
    switch (event.which) {
       
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
<?php $this->load->view('_blocks/footer')?>