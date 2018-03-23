<?php

  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class Property_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('property');
    }
    
    function list_items($limit = NULL, $offset = NULL, $col = '', $order = '', $just_count = FALSE)
	{
		// set the filter again here just in case the table names are different
	
			$this->db->select($this->_tables['property'].'.id, '.$this->_tables['property'].'.name', FALSE);
	    	//$data = parent::list_items($limit, $offset, $col, $order, $just_count);
          //  echo "<pre>";
            $data=$this->db->get('fuel_property')->result_array();
           // print_r($data); 
            
           // exit;
		return $data;
	}
    
   function property_list()
   {
    	$this->db->select('id,name,order', FALSE);
	    	//$data = parent::list_items($limit, $offset, $col, $order, $just_count);
          //  echo "<pre>";
            $data=$this->db->get('fuel_property')->result_array();
           // print_r($data); 
            
           // exit;
		return $data;
   } 
}


?>