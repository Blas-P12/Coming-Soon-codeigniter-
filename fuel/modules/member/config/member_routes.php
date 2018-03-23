<?php
//$route[FUEL_ROUTE.'member/'] = FUEL_FOLDER.'/module';
    $route[FUEL_ROUTE.'member'] = 'member';
    $route[FUEL_ROUTE.'member/(:any)'] = 'member/$1';
   //  $route[FUEL_ROUTE.'member/admin'] = 'news/admin';
   //   $route[FUEL_ROUTE.'member/admin/(:any)'] = 'news/admin/$1';
    /* $route[FUEL_ROUTE.'tools/news'] = 'news';
    $route[FUEL_ROUTE.'tools/news/(:any)'] = 'news/$1'; 
    $route[FUEL_ROUTE.'my_module'] = FUEL_FOLDER.'/my_module';
$route[FUEL_ROUTE.'my_module/(.*)'] = FUEL_FOLDER.'/my_module/$1';
    */
    
 //$route[FUEL_ROUTE.'news'] = 'news';
      
    // $news_controllers = array('member','admin');
      
     foreach($news_controllers as $c)
     {
      // $route[FUEL_ROUTE.$route[FUEL_ROUTE.'news'].'/'.$c] = FUEL_FOLDER.'/module';
      // $route[FUEL_ROUTE.$route[FUEL_ROUTE.'news'].'/'.$c.'/(.*)'] = FUEL_FOLDER.'/module/$1';
     }
?>