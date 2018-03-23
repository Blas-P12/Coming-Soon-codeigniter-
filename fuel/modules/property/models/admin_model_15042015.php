<?php

  if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class Admin_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('property');
    }
    
    function list_items($limit = NULL, $offset = NULL, $col = '', $order = '', $just_count = FALSE)
	{
		// set the filter again here just in case the table names are different
	
		//	$this->db->select('*', FALSE);
	    	$data = parent::list_items($limit, $offset, $col, $order, $just_count);
            echo "<pre>";
          //  $data=$this->db->get('fuel_property')->result_array();
           print_r($data); 
            
           // exit;
		return $data;
	}
    function property_imageslist($mainid)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('propertyid', $mainid); 
		$data=$this->db->get('fuel_propertyimages')->result_array();
        
		return $data; 
    }
   function property_list($params,$limit,$start)
   {
    //echo $start;
    	$this->db->select('*', FALSE);
	    	//$data = parent::list_items($limit, $offset, $col, $order, $just_count);
          //  echo "<pre>";
          // $this->db->order_by("fuel_property.order", "asc");
          if(!empty($params['name'])) //  this for on process
			   {
				$this->db->like('name', $params['name']); 
			    } 
          
              $this->db->limit($limit,$start);
            $data=$this->db->get('fuel_property')->result_array();
           // print_r($data); 
          // echo $this->db->last_query();
         // exit; 
           // exit;
		return $data;
   } 
   function getCounts()
   {
     return  $this->db->count_all_results('fuel_property');
   }
    function saveallotmember($input)
	{
	   
      if(!empty($input["to_select_list"])) 
       {
                foreach($input["to_select_list"] as $key => $userid)
                {
            		 $to_insert = array(
            			'propertyid' => $input['proid'],
                        'userid' => $userid
            		
            		);
                     $this->db->insert('fuel_allotuser', $to_insert);
                } 
        }
        return true;
    } 
    
     function evanrptsaveallotmember($input)
	{
	        
      if(!empty($input["to_select_list"])) 
       {
                foreach($input["to_select_list"] as $key => $userid)
                {
            		 $to_insert = array(
            			'propertyid' => $input['proid'],
                        'evanrptid' =>  $input['evanrptid'],
                        'userid' => $userid
            		
            		);
                     $this->db->insert('fuel_evanrptallotuser', $to_insert);
                } 
        }
        return true;
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
    function emediagram_imagesdetail($id)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('id', $id); 
		$data=$this->db->get('fuel_eme_diagrams_link_images')->result_array();
        
		return $data; 
    }
    function emediagram_delete($id)
    {
        $this->db->query("delete from fuel_eme_diagrams_link_images where id='".$id."' ");
        return true;
    }
    function emediagramdelete($id)
    {
        $this->db->query("delete from fuel_eme_diagrams_link where id='".$id."' ");
        return true;
    }
    function emediagram_detail($id)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('id', $id); 
		$data=$this->db->get('fuel_eme_diagrams_link')->result_array();
        
		return $data; 
    } 
    function emediagram_create($input)
	{
		$to_insert = array(
			'name' => $input['name'],
            'order' => $input['order'],
            'propertyid' => $input['propertyid']
		);

		 $this->db->insert('fuel_eme_diagrams_link', $to_insert);
        $diagrams_linkid= $this->db->insert_id();
		$propertyid=$diagrams_linkid;
     	/* if(!empty($input["photos"]))
					{ 
					   $this->load->library('upload');
                       $gettmp_tumbs_arr=array();

                        
					   foreach($input["photos"]["name"] as $key => $detail)
                       {
                                                    
                         $data_trans=array("emediagramslinkid" =>$propertyid);
                        
                        $this->db->insert('fuel_eme_diagrams_link_images',$data_trans);
                        $productmaster_transid= $this->db->insert_id();
                        
                    
                        
						$ext = explode(".",$input["photos"]['name'][$key]);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = UPLOAD_ROOT_PATH.'property';
						$uploadConst['allowed_types'] = 'gif|jpg|jpeg|png|bmp|pdf|docx';
                         $uploadConst['overwrite'] = TRUE;
						 $uploadConst['max_size'] = '1000';
						$uploadConst['file_name']     = 'diagram-image-'.$productmaster_transid.".".$ext; 
                        
						$this->upload->initialize($uploadConst);
                        
                         $_FILES['images']['name']= $input["photos"]['name'][$key];
                        $_FILES['images']['type']= $input["photos"]['type'][$key];
                        $_FILES['images']['tmp_name']= $input["photos"]['tmp_name'][$key];
                        $_FILES['images']['error']= $input["photos"]['error'][$key];
                        $_FILES['images']['size']= $input["photos"]['size'][$key];

                        
						if (!$this->upload->do_upload('images'))
							{
							echo  $error = $this->upload->display_errors(); 
                            //exit;
                             
                             }
						 else
							{   
							 unset($_FILES['images']);
                             
							   $config=array();
                               $image_data=array();
                               $image_data = $this->upload->data();
                               
                                $gettmp_tumbs_arr[$productmaster_transid]=$image_data['full_path'];
                              
                            
                            }
                            
                            
                           $values=array("imagename" => 	$uploadConst['file_name'] );
                            
                         	$this->db->where('id', $productmaster_transid);
		                    $this->db->update('fuel_eme_diagrams_link_images', $values);     
                            
                            
                        }    
                        
                         /****************  cretae tuhmbs  *********************
                       //  echo "<pre>";
                         //print_r($gettmp_tumbs_arr);
                      
                         $this->load->library('image_lib'); 
                         foreach($gettmp_tumbs_arr as $key => $imageurl)
                         {
                            unset($config);
                            $config = array( 
                                    'image_library' => 'gd2',
                                    'source_image' => $imageurl,
                                    'new_image' => UPLOAD_ROOT_PATH.'property/thumbs',
                                    'maintain_ratio' => true,
                                    'file_name'     => 'diagram-image-'.$key.".".$ext,
                                    'width' => 98,
                                    'height' => 130
                                    
                                );
                 //   $config['create_thumb'] = FALSE;
//$config['new_image'] = $this->image_thumb_name($img);
                                
                                $this->image_lib->initialize($config);
                               
                               // $this->image_lib->resize();
                                if(!$this->image_lib->resize())
                                {
                                    echo $this->image_lib->display_errors();
                                     //exit;
                                }
                                unset($config);
                                $this->image_lib->clear();
                          
                        /********************************* 
                       }  
					}*/
					
					
      //  echo'/assets/property/thumbs';
      
      //echo ROOT;
     
    
          
        return $diagrams_linkid;
        
	}
    function emediagram_edit($input)
	{
		$to_update = array(
			'name' => $input['name'],
            'order' => $input['order']
		);
     	$this->db->where('id', $input["id"]);
		 $this->db->update('fuel_eme_diagrams_link', $to_update);
         $propertyid=$input["id"]; 
    //  echo UPLOAD_ROOT_PATH.'property'; exit;
        if(!empty($input["photos"]))
				{
				  //*******  we have to unlink default images then  delete  table record ******//
				  //*********************************//
				   $this->load->library('upload');
				   $gettmp_tumbs_arr=array();
				   foreach($input["photos"]["name"] as $key => $detail)
				   {
						$data_trans=array("emediagramslinkid" =>$propertyid);
						$this->db->insert('fuel_eme_diagrams_link_images',$data_trans);
						$productmaster_transid= $this->db->insert_id();
						$ext = explode(".",$input["photos"]['name'][$key]);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = UPLOAD_ROOT_PATH.'property';
						$uploadConst['allowed_types'] = 'gif|jpg|jpeg|png|bmp|pdf|docx';
						$uploadConst['overwrite'] = TRUE;
						$uploadConst['max_size'] = '1000';
						$uploadConst['file_name']     = 'diagram-image-'.$productmaster_transid.".".$ext; 
						
						$this->upload->initialize($uploadConst);
						
						 $_FILES['images']['name']= $input["photos"]['name'][$key];
						$_FILES['images']['type']= $input["photos"]['type'][$key];
						$_FILES['images']['tmp_name']= $input["photos"]['tmp_name'][$key];
						$_FILES['images']['error']= $input["photos"]['error'][$key];
						$_FILES['images']['size']= $input["photos"]['size'][$key];

					
					if (!$this->upload->do_upload('images'))
						{
							echo  $error = $this->upload->display_errors(); 
							//exit;
						 }
					 else
						{   
						 	unset($_FILES['images']);
						   	$config=array();
						   	$image_data=array();
						   	$image_data = $this->upload->data();
							$gettmp_tumbs_arr[$productmaster_transid]=$image_data['full_path'];
						}
					   	$values=array("imagename" => 	$uploadConst['file_name'] );
						$this->db->where('id', $productmaster_transid);
						$this->db->update('fuel_eme_diagrams_link_images', $values);     
					}    
					
					 /****************  cretae tuhmbs  *********************/
				   //  echo "<pre>";
					 //print_r($gettmp_tumbs_arr);
				  
					 $this->load->library('image_lib'); 
					 foreach($gettmp_tumbs_arr as $key => $imageurl)
					 {
						unset($config);
						$config = array( 
								'image_library' => 'gd2',
								'source_image' => $imageurl,
								'new_image' => UPLOAD_ROOT_PATH.'property/thumbs',
								'maintain_ratio' => true,
								'file_name'     => 'diagram-image-'.$key.".".$ext,
								'width' => 98,
								'height' => 130
								
							);
			 //   $config['create_thumb'] = FALSE;
//$config['new_image'] = $this->image_thumb_name($img);
							
							$this->image_lib->initialize($config);
						   
						   // $this->image_lib->resize();
							if(!$this->image_lib->resize())
							{
								echo $this->image_lib->display_errors();
								 //exit;
							}
							unset($config);
							$this->image_lib->clear();
					  
					/*************************************/
				   }  
				}
           
        return  true;
	} 
  	 function create($input)
	{
		$to_insert = array(
			'name' => $input['name'],
            'order' => $input['order'],
		    'country'=> $input['country'],
             'state'=> $input['state'],
             'city'=> $input['city'],
             'address'=> $input['address']
		);

		 $this->db->insert('fuel_property', $to_insert);
        $propertyid= $this->db->insert_id();
     
      //  echo'/assets/property/thumbs';  /home/auscom/public_html/assets/upload/property/
      
      //echo ROOT;
     
     
        return $propertyid;
        
	}

    function getby_id($id)
    {
         $this->db->select("*");
        $this->db->where("id",$id); 
        $arrayVal = $this->db->get('fuel_property')->result_array();
        
       
        
        return $arrayVal; 
    }
     function designation()
    {
         $this->db->select("*");
        $arrayVal = $this->db->get('fuel_designation')->result_array();
       return $arrayVal; 
    }
    function userlink()
    {
         $this->db->select("*");
        $arrayVal = $this->db->get('fuel_userlink')->result_array();
       return $arrayVal; 
    } 
    function procedures_link()
    {
         $this->db->select("*");
        $arrayVal = $this->db->get('fuel_eme_procedures_link')->result_array();
       return $arrayVal; 
    }
    function save_procedureslink($propertyid,$id,$pdfname)
    {
        $this->db->select("*");
        $this->db->where("proppertyid",$propertyid);
        $this->db->where("emeprocedureslinkid",$id);
        $arrayVal = $this->db->get('fuelemeprocedureslink_trans')->result_array();
        
        if(!empty($arrayVal))
        {
            // update
            $values=array("imagename"=>$pdfname);
            $this->db->where("proppertyid",$propertyid);
            $this->db->where("emeprocedureslinkid",$id);
            $this->db->update('fuelemeprocedureslink_trans', $values);  
        }else
        {
            // insert
            	$to_insert = array(
			'proppertyid' => $propertyid,
            'emeprocedureslinkid' => $id,
		    'imagename'=> $pdfname
		);

		 $this->db->insert('fuelemeprocedureslink_trans', $to_insert);
            
        }
        return true;
    }
    function getdesignation($id)
    {
         $this->db->select("*");
         $this->db->where("id",$id); 
         $arrayVal = $this->db->get('fuel_designation')->result_array();
        return $arrayVal; 
    } 
    function getpropertyimages($id)
    {
         $this->db->select("*");
         $this->db->where("propertyid",$id); 
         $arrayVal = $this->db->get('fuel_propertyimages')->result_array();
        return $arrayVal; 
    } 
    function getpropertyimage_detail($id)
    {
         $this->db->select("*");
         $this->db->where("id",$id); 
         $arrayVal = $this->db->get('fuel_propertyimages')->result_array();
        return $arrayVal; 
    } 
    function getpropertyimage_delete($id)
    {
        $this->db->query("delete from fuel_propertyimages where id='".$id."'");
         
        return true; 
    } 
    function freemember($propertyid)
    {
        $allotmember=$this->db->query("select userid from fuel_allotuser where propertyid='".$propertyid."'")->result_array();
        $allotmembides="";
        if(!empty($allotmember))
        {
           foreach($allotmember as $key => $allotmemberdetail)
           {
             $allotmember_arr[]=$allotmemberdetail["userid"];
           } 
          $allotmembides=",".implode(",",$allotmember_arr);  
        }
        
         $arrayVal = $this->db->query("select id,concat_ws(' ',first_name,last_name) as name from fuel_users
          where id not in (1 $allotmembides)")->result_array();
        
        return $arrayVal; 
    } 
   function freeallotmember($id)
   {
    $this->db->query("delete from fuel_allotuser where id='".$id."' ");
    return true;
   } 
   function allotmember($propertyid)
   {
     $arrayVal = $this->db->query("select concat_ws(' ',first_name,last_name) as name,fuel_allotuser.*
     
          from fuel_users inner join fuel_allotuser on fuel_users.id=fuel_allotuser.userid
          where propertyid='".$propertyid."'")->result_array();
        
        return $arrayVal; 
   } 
    
    function evacuation_freemember($evanrptid,$propertyid)
    {
        $allotmember=$this->db->query("select userid from fuel_evanrptallotuser where evanrptid='".$evanrptid."' and  propertyid='".$propertyid."'")->result_array();
        $allotmembides="";
        if(!empty($allotmember))
        {
           foreach($allotmember as $key => $allotmemberdetail)
           {
             $allotmember_arr[]=$allotmemberdetail["userid"];
           } 
           $allotmembides=",".implode(",",$allotmember_arr);  
        }
        
         $arrayVal = $this->db->query("select id,concat_ws(' ',first_name,last_name) as name from fuel_users
          where id not in (1 $allotmembides)")->result_array();
        
        return $arrayVal; 
    } 
   function evacuation_freeallotmember($id)
   {
    $this->db->query("delete from fuel_evanrptallotuser where id='".$id."' ");
    return true;
   } 
   function evacuation_allotmember($evanrptid,$propertyid)
   {
   
    
     $arrayVal = $this->db->query("select concat_ws(' ',first_name,last_name) as name,fuel_evanrptallotuser.*
     
          from fuel_users inner join fuel_evanrptallotuser on fuel_users.id=fuel_evanrptallotuser.userid 
          where evanrptid='".$evanrptid."' and  propertyid='".$propertyid."'")->result_array();
        
        return $arrayVal; 
   }  
    
    
    
    
    function edit($input)
	{
		$to_update = array(
			'name' => $input['name'],
            'order' => $input['order'],
             'country'=> $input['country'],
             'state'=> $input['state'],
             'city'=> $input['city'],
             'address'=> $input['address']
		
		);
     	$this->db->where('id', $input["id"]);
		 $this->db->update('fuel_property', $to_update);
         $propertyid=$input["id"];  
    //  echo UPLOAD_ROOT_PATH.'property'; exit;
       
        return  true;
	} 
    
    function delete($id)
    {
        $this->db->query("delete from fuel_property where id='".$id."' ");
        return true;
    }
    
   //*********************************  Warden Detail *******************************
    function get_maxid($field,$table)
    {
       	 
		$data=$this->db->query('SELECT if( count( '.$field.' ) =0, 1, max( '.$field.' ) +1 ) AS maxid FROM '.$table.'')->result_array();
        
		return $data[0]["maxid"]; 
    }
     function warden_list($mainid)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('propertyid', $mainid); 
		$data=$this->db->get('fuel_wardens')->result_array();
        
		return $data; 
    }
     function warden_create($input)
    {
       		$to_insert = array(
			               'firstname'=> $input['firstname'],
            			  'familyname'=> $input['familyname'],
                           'ecoposition'=> $input['ecoposition'],
                          'location'=> $input['location'],
                          'contactdetails'=> $input['contactdetails'],
                          'firedate'=> $input['firedate'],
                          'attendsheet'=> $input['attendsheet'],
                          'evacuation'=> $input['evacuation'],
                          'trialevacuation'=> $input['trialevacuation'],
                          'propertyid'=>$input['propertyid']
		);

		return $this->db->insert('fuel_wardens', $to_insert);
        
		  
    }
    function warden_edit($input,$id)
    {
       		$to_update = array(
			               'firstname'=> $input['firstname'],
            			  'familyname'=> $input['familyname'],
                           'ecoposition'=> $input['ecoposition'],
                          'location'=> $input['location'],
                          'contactdetails'=> $input['contactdetails'],
                          'firedate'=> $input['firedate'],
                          'evacuation'=> $input['evacuation'],
                          'trialevacuation'=> $input['trialevacuation'],
                          'propertyid'=>$input['propertyid']
		);
         if(!empty($input['attendsheet']))
         {
             $to_update['attendsheet']= $input['attendsheet'];
         }
         
		$this->db->where('id', $id);
		return $this->db->update('fuel_wardens', $to_update);
        
		  
    }
     function wardens_details($id)
    {
         $this->db->select("*");
         $this->db->where("id",$id); 
         $arrayVal = $this->db->get('fuel_wardens')->result_array();
        return $arrayVal; 
    } 
     function warden_delete($id)
    {
        $this->db->query("delete from fuel_wardens where id='".$id."' ");
        return true;
    }
     //*********************************  Evacuation Reports  *******************************
     function evacuationrpt_maxid()
    {
       	 
		$data=$this->db->query('SELECT if( count( id ) =0, 1, max( id ) +1 ) AS maxid FROM fuel_evacuationrpt')->result_array();
        
		return $data[0]["maxid"]; 
    }
     function evacuationrpt_list($mainid)
    {
       	$this->db->select('*', FALSE);
	    $this->db->where('propertyid', $mainid); 
		$data=$this->db->get('fuel_evacuationrpt')->result_array();
        
		return $data; 
    }
     function evacuationrpt_create($input)
    {
       		$to_insert = array(
			               'name'=> $input['name'],
            			   'propertyid'=>$input['propertyid'],
                           'pdfname'=>$input['pdfname']
		);

		return $this->db->insert('fuel_evacuationrpt', $to_insert);
        
		  
    }
    function evacuationrpt_edit($to_update,$id)
    {
        /*
       		$to_update = array(
			               'name'=> $input['name'],
            			   'propertyid'=>$input['propertyid'],
                           'pdfname'=>$input['pdfname']
		);
           */
		$this->db->where('id', $id);
		return $this->db->update('fuel_evacuationrpt', $to_update);
        
		  
    }
     function evacuationrpt_details($id)
    {
         $this->db->select("*");
         $this->db->where("id",$id); 
         $arrayVal = $this->db->get('fuel_evacuationrpt')->result_array();
        return $arrayVal; 
    } 
     function evacuationrpt_delete($id)
    {
        $this->db->query("delete from fuel_evacuationrpt where id='".$id."' ");
        return true;
    }
    //****************************************  Delete Trans ******************************
    function delete_allotusers($id)
    {
        $this->db->query("delete from fuel_allotuser where propertyid='".$id."' ");
        return true;
        
    } 
    
    function delete_emeproceduce_link($id) 
    {
         $this->db->select("*");
         $this->db->where("proppertyid",$id); 
         $arrayVal = $this->db->get('fuelemeprocedureslink_trans')->result_array();
       if(!empty($arrayVal))
       {
                foreach($arrayVal as $key => $detail)
                {
                 $imagename=$detail["imagename"];
                 $trans_id=$detail["id"];
                  $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$imagename;
                 if (file_exists($filename_main)) 
                  {
                     unlink($filename_main);    
                  }
                  $this->db->query("delete from fuelemeprocedureslink_trans where id='".$trans_id."'");
                }
       }  
         
    }
    
    function delete_emediagrams_link($id)
    {
        //  
        
         $this->db->select("*");
         $this->db->where("propertyid",$id); 
         $arrayVal = $this->db->get('fuel_eme_diagrams_link')->result_array();
        
        if(!empty($arrayVal))
       {
          foreach($arrayVal as $key => $detail)
                {
                    $mainid=$detail["id"];
                    
                      //**************** Delete Images Trans ********************
                               $this->db->select("*");
                               $this->db->where("emediagramslinkid",$id); 
                               $arrayVal_trans = $this->db->get('fuel_eme_diagrams_link_images')->result_array();
                              if(!empty($arrayVal_trans)) 
                               {
                                 foreach($arrayVal_trans as $key => $trans_details)
                                     {
                                        $trans_id=$trans_details["id"];
                                        $imagename=$trans_details["imagename"]; 
                                        $filename_main=UPLOAD_ROOT_PATH."property/".$imagename;
                                         if(file_exists($filename_main)) 
                                          {
                                             unlink($filename_main);    
                                          }
                                        $this->db->query("delete from fuel_eme_diagrams_link_images where id='".$trans_id."'");                                               
                                     }
                               }
                                      
                      //**************** Delete Images Trans ********************
                }    
             $this->db->query("delete from fuel_eme_diagrams_link where propertyid='".$id."'");
       } 
    }
    
     function delete_warden_link($id)
     {
       $this->db->query("delete from fuel_wardens where propertyid='".$id."'");
     }
    function delete_evacuation_reports($id) 
    {
         $this->db->select("*");
         $this->db->where("propertyid",$id); 
         $arrayVal = $this->db->get('fuel_evacuationrpt')->result_array();
       if(!empty($arrayVal))
       {
                foreach($arrayVal as $key => $detail)
                {
                 $imagename=$detail["pdfname"];
                 $trans_id=$detail["id"];
                  $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$imagename;
                 if (file_exists($filename_main)) 
                  {
                     unlink($filename_main);    
                  }
                  $this->db->query("delete from fuel_evacuationrpt where id='".$trans_id."'");
                }
       }  
         
    }
    //****************************************  Delete Trans ******************************
}
 



?>