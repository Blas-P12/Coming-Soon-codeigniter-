<?php
$route[FUEL_ROUTE.'property/'] = FUEL_FOLDER.'/module';
    //[FUEL_ROUTE.'property'] = 'property';
  //  $route[FUEL_ROUTE.'property/(:any)'] = 'property/$1';
     $route[FUEL_ROUTE.'property/admin'] = 'property/admin';
      $route[FUEL_ROUTE.'property/admin/(:any)'] = 'property/admin/$1';
       //$route[FUEL_ROUTE.'property/admin/items/(:any)'] = 'property/admin/items/$1'; 
    /* $route[FUEL_ROUTE.'tools/property'] = 'property';
    $route[FUEL_ROUTE.'tools/property/(:any)'] = 'property/$1'; 
    $route[FUEL_ROUTE.'my_module'] = FUEL_FOLDER.'/my_module';
$route[FUEL_ROUTE.'my_module/(.*)'] = FUEL_FOLDER.'/my_module/$1';
    */
    
 //$route[FUEL_ROUTE.'property'] = 'property';
      
     $property_controllers = array('property','admin');
      
     foreach($property_controllers as $c)
     {
      // $route[FUEL_ROUTE.$route[FUEL_ROUTE.'property'].'/'.$c] = FUEL_FOLDER.'/module';
      // $route[FUEL_ROUTE.$route[FUEL_ROUTE.'property'].'/'.$c.'/(.*)'] = FUEL_FOLDER.'/module/$1';
     }
?>