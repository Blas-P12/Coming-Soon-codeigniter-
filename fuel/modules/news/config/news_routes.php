<?php
$route[FUEL_ROUTE.'news/'] = FUEL_FOLDER.'/module';
    //[FUEL_ROUTE.'news'] = 'news';
  //  $route[FUEL_ROUTE.'news/(:any)'] = 'news/$1';
     $route[FUEL_ROUTE.'news/admin'] = 'news/admin';
      $route[FUEL_ROUTE.'news/admin/(:any)'] = 'news/admin/$1';
    /* $route[FUEL_ROUTE.'tools/news'] = 'news';
    $route[FUEL_ROUTE.'tools/news/(:any)'] = 'news/$1'; 
    $route[FUEL_ROUTE.'my_module'] = FUEL_FOLDER.'/my_module';
$route[FUEL_ROUTE.'my_module/(.*)'] = FUEL_FOLDER.'/my_module/$1';
    */
    
 //$route[FUEL_ROUTE.'news'] = 'news';
      
     $news_controllers = array('news','admin');
      
     foreach($news_controllers as $c)
     {
      // $route[FUEL_ROUTE.$route[FUEL_ROUTE.'news'].'/'.$c] = FUEL_FOLDER.'/module';
      // $route[FUEL_ROUTE.$route[FUEL_ROUTE.'news'].'/'.$c.'/(.*)'] = FUEL_FOLDER.'/module/$1';
     }
?>