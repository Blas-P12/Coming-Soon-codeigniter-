<?php

  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class News_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('news');
    }
    
    function list_items($limit = NULL, $offset = NULL, $col = '', $order = '', $just_count = FALSE)
	{
		// set the filter again here just in case the table names are different
	
			$this->db->select($this->_tables['news'].'.id, '.$this->_tables['news'].'.name', FALSE);
	    	//$data = parent::list_items($limit, $offset, $col, $order, $just_count);
          //  echo "<pre>";
            $data=$this->db->get('fuel_news')->result_array();
           // print_r($data); 
            
           // exit;
		return $data;
	}
    
   function news_list()
   {
    	$this->db->select('id,name', FALSE);
	    	//$data = parent::list_items($limit, $offset, $col, $order, $just_count);
          //  echo "<pre>";
            $data=$this->db->get('fuel_news')->result_array();
           // print_r($data); 
            
           // exit;
		return $data;
   } 
}
 
class New_model extends Base_module_record {
 
}


?>