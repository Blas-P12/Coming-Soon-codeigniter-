<?php

  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class Member_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('member');
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
   
  function properties_list($userid)
  {
    /*
    echo " SELECT fuel_property.* FROM fuel_users inner join  fuel_allotuser on fuel_users.id=fuel_allotuser.userid 
                         inner join  fuel_property on fuel_property.id=fuel_allotuser.propertyid
WHERE 
userid=$userid"; exit; */
   return $this->db->query(" SELECT fuel_property.* FROM fuel_users inner join  fuel_allotuser on fuel_users.id=fuel_allotuser.userid 
                         inner join  fuel_property on fuel_property.id=fuel_allotuser.propertyid
WHERE 
userid=$userid")->result_array();
  } 
  
  function properties_detail($propertyid)
  {
    /*
    echo " SELECT fuel_property.* FROM fuel_users inner join  fuel_allotuser on fuel_users.id=fuel_allotuser.userid 
                         inner join  fuel_property on fuel_property.id=fuel_allotuser.propertyid
WHERE 
userid=$userid"; exit; */
   return $this->db->query(" SELECT * FROM fuel_property 
                            WHERE 
                            id=$propertyid")->result_array();
  } 
   function property_imageslist($mainid)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('propertyid', $mainid); 
		$data=$this->db->get('fuel_propertyimages')->result_array();
        //echo $this->db->last_query(); exit;
		return $data; 
    } 
    
   function procedures_link()
    {
         $this->db->select("*");
      return  $arrayVal = $this->db->get('fuel_eme_procedures_link')->result_array();
       // $arrayVal;
       
       
        
    } 
   function procedures_pdflinks($propertyid)
   {
      $this->db->select("*");
        $this->db->where("proppertyid",$propertyid);
     //   $this->db->where("emeprocedureslinkid",$id);
     return   $arrayVal = $this->db->get('fuelemeprocedureslink_trans')->result_array();
   } 
  
   function emediagram_list($mainid)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('propertyid', $mainid); 
		$data=$this->db->get('fuel_eme_diagrams_link')->result_array();
        
		return $data; 
    }
    function emediagram_imageslist($mainid)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('emediagramslinkid', $mainid); 
		$data=$this->db->get('fuel_eme_diagrams_link_images')->result_array();
        
		return $data; 
    }
     function warden_list($mainid)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('propertyid', $mainid); 
		$data=$this->db->get('fuel_wardens')->result_array();
        
		return $data; 
    }
    function evacuationrpt_list($mainid,$userid)
    {
        /*
       	$this->db->select('*', FALSE);
	    $this->db->where('propertyid', $mainid); 
		$data=$this->db->get('fuel_evacuationrpt')->result_array();
        */
        $data=$this->db->query("select fuel_evacuationrpt.* from fuel_evacuationrpt 
                            inner join fuel_evanrptallotuser on fuel_evacuationrpt.id=fuel_evanrptallotuser.evanrptid 
                          where fuel_evanrptallotuser.userid='".$userid."' and fuel_evanrptallotuser.propertyid='".$mainid."'  
                         order by fuel_evacuationrpt.name")->result_array(); 
               
        
        
		return $data; 
    }
    
    function welcomecontent()
    {
       $html=""; 
       $result=$this->db->query("select value from fuel_site_variables where active='yes' order by id desc limit 1")->result_array();  
       
       if(!empty($result))
       {
         $html=$result[0]; 
       }
       
       return $html; 
    }       
}
?>