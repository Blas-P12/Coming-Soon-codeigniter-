<?php $this->load->view('_blocks/header')?>
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
       <li class="evacuation">
          <?php
         if($this->fuel->auth->has_permission('property/evacuation',"evacuation")==true)
         { 
            if(!empty($protransids) && in_array(1,$protransids))
            {
                 // echo $protrans[1];
              $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[1];
             if (file_exists($filename_main) && !empty($protrans[1])) {
                 echo anchor('member/downloadprolink/'.$protrans[1],"Evacuation");  
              }else
             { ?>
                 <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Evacuation</a>
              <?php  
             }
           }else
           {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Evacuation</a>
          <?php
          }
          }else
          {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('You have no permission to pdf download'); return false;">Evacuation</a>
          <?php
          }
          ?>          
       </li>
       <li class="fire-smoke">
         <?php
          
          if($this->fuel->auth->has_permission('property/firesmokeemergencies',"firesmokeemergencies")==true)
         { 
            if(!empty($protransids) && in_array(3,$protransids))
            {
                 // echo $protrans[1];
              $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[3];
             if (file_exists($filename_main) && !empty($protrans[3])) {
                 echo anchor('member/downloadprolink/'.$protrans[3],"Fire & smoke <br/>Emergency");  
              }else
             { ?>
                 <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Fire & smoke <br/>Emergency</a>
              <?php  
             }
           }else
           {
          ?> 
           <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Fire & smoke <br/>Emergency</a>
          <?php
          }
          }else
          {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('You have no permission to pdf download'); return false;">Fire & smoke <br/>Emergency</a>
          <?php
          }
          ?>  
          
       </li>
       <li class="emergency-main-box">
           <?php
           
          if($this->fuel->auth->has_permission('property/emergencies',"emergencies")==true)
         { 
            if(!empty($protransids) && in_array(5,$protransids))
            {
                 // echo $protrans[1];
              $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[5];
             if (file_exists($filename_main) && !empty($protrans[5])) {
                 echo anchor('member/downloadprolink/'.$protrans[5],"Emergency");  
              }else
             { ?>
                 <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Emergency</a>
              <?php  
             }
           }else
           {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Emergency</a>
          <?php
          }
          }else
          {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('You have no permission to pdf download'); return false;">Emergency</a>
          <?php
          }
          ?> 
       
       </li>
       <li class="bomb-threat">
        <?php
         
          if($this->fuel->auth->has_permission('property/bombarsonthreat',"bombarsonthreat")==true)
         { 
            if(!empty($protransids) && in_array(7,$protransids))
            {
                 // echo $protrans[1];
              $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[7];
             if (file_exists($filename_main) && !empty($protrans[7])) {
                 echo anchor('member/downloadprolink/'.$protrans[7],"Bomb/Arson<br/>Threat");  
              }else
             { ?>
                 <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Bomb/Arson<br/>Threat</a>
              <?php  
             }
           }else
           {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Bomb/Arson<br/>Threat</a>
          <?php
          } 
         }else
          {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('You have no permission to pdf download'); return false;">Bomb/Arson<br/>Threat</a>
          <?php
          }
          ?>  
       </li>
       </ul>
       <ul class="emergency-link-2">
       <li class="external-emergencies">
          <?php
          
         if($this->fuel->auth->has_permission('property/externalemergencies',"externalemergencies")==true)
         {  
            if(!empty($protransids) && in_array(2,$protransids))
            {
                 // echo $protrans[1];
              $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[2];
             if (file_exists($filename_main) && !empty($protrans[2])) {
                 echo anchor('member/downloadprolink/'.$protrans[2],"External <br> Emergency");  
              }else
             { ?>
                 <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">External <br>Emergency</a>
              <?php  
             }
           }else
           {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">External <br>Emergency</a>
          <?php
          }
          }else
          {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('You have no permission to pdf download'); return false;">External <br>Emergency</a>
          <?php
          }
          ?> 
       </li>
       <li class="medical-emergencies">
          
        <?php
         if($this->fuel->auth->has_permission('property/medicalemergencies',"medicalemergencies")==true)
         { 
            if(!empty($protransids) && in_array(4,$protransids))
            {
                 // echo $protrans[1];
              $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[4];
             if (file_exists($filename_main) && !empty($protrans[4])) {
                 echo anchor('member/downloadprolink/'.$protrans[4],"Medical<br/>Emergency");  
              }else
             { ?>
                 <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Medical<br/>Emergency</a>
              <?php  
             }
           }else
           {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Medical<br/>Emergency</a>
          <?php
          }
          }else
          {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('You have no permission to pdf download'); return false;">Medical<br/>Emergency</a>
          <?php
          }
          ?> 
       
       </li>
       <li class="internal-emergencies">
        <?php
        
        
        if($this->fuel->auth->has_permission('property/internalemergencies',"internalemergencies")==true)
         { 
            if(!empty($protransids) && in_array(6,$protransids))
            {
                 // echo $protrans[1];
              $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[6];
             if (file_exists($filename_main) && !empty($protrans[6])) {
                 echo anchor('member/downloadprolink/'.$protrans[6],"Internal <br> Emergency");  
              }else
             { ?>
                 <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Internal <br>Emergency</a>
              <?php  
             }
           }else
           {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Internal <br> Emergency</a>
          <?php
          }
          }else
          {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('You have no permission to pdf download'); return false;">Internal <br> Emergency</a>
          <?php
          }
          ?> 
       
       </li>
       
       
       </li>
       <li class="personal-threat">
         <?php
          if($this->fuel->auth->has_permission('property/personalthreat',"personalthreat")==true)
         {
            if(!empty($protransids) && in_array(8,$protransids))
            {
                 // echo $protrans[1];
              $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$protrans[8];
             if (file_exists($filename_main) && !empty($protrans[8])) {
                 echo anchor('member/downloadprolink/'.$protrans[8],"Personal<br/>Threat");  
              }else
             { ?>
                 <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Personal<br/>Threat</a>
              <?php  
             }
           }else
           {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('No pdf upload'); return false;">Personal<br/>Threat</a>
          <?php
          }
          }else
          {
          ?>
           <a href=" javascript:void(0);" onclick=" alert('You have no permission to pdf download'); return false;">Personal<br/>Threat</a>
          <?php
          }
          ?> 
          
       </li>
       </ul>
       
      
       </div>
    </div>

</div>

<div class="clear"></div>
<?php $this->load->view('_blocks/footer')?>