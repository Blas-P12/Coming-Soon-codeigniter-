<?php

   // require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');
   // require_once(MODULES_PATH.'/property/libraries/property_base_controller.php');
//class property extends property_base_controller {
     
    require_once(FUEL_PATH.'controllers/module.php');
class Admin extends  Module {
//class Admin extends Fuel_base_controller {
	 public $view_location = 'property';
	function __construct()
	{  
		parent::__construct('property');
       // 	$this->view_location = 'fuel';
		$this->load->module_model(PROPERTY_FOLDER, 'admin_model');
        $this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('pagination');
 // $test=$this->_validate_user('property/delete',"delete");


    
      //  $this->fuel->auth->has_permission('$permission');
        //echo $this->fuel->auth->is_logged_in(); exit;
        
	}
  
	function _remap()
	{
		
        // $vars=array();
       //  $vars["list"]=$this->property_model->property_list();
       
      //   $vars['body'] = $this->load->module_view(property_FOLDER, "index", $vars, TRUE);
          //echo   $output = $this->load->view('index', $vars, TRUE);
       // echo "testing";
         $args = func_get_args();
        $method = $args[0];   
        $segments = $args[1]; 
    
    
     switch($method)
     {
        case "items":  
        
        if(empty($segments[0]))
        {
           $offset=0; 
        }else
        {
            $offset=$segments[0];
        }
        
         $this->items($offset);
         
        break;
        case "reset_page_state":
        $this->items();
        break;
        case "create":
        $this->create(); 
        break;
        case "edit":
        $this->edit($segments[0]); 
        break;
        case "deletepropertyimage":
        $this->deletepropertyimage();
        break;
        case "allotmember":
         $this->allotmember($segments[0],$segments[1]); 
          
        break;
        case "freemember":
         $this->freemember($segments[0],$segments[1],$segments[2]); 
        break;
        case "saveallotmember":
         $this->saveallotmember();
        break;
        case "delete":
        $this->delete($segments[0]); 
        break;
        case "procedureslink" :
        $this->procedureslink($segments[0]);
        break;
        case "downloadprolink":
        $this->downloadprolink($segments[0]);
        break;
         case "emediagram_index":
        $this->emediagram_index($segments[0]);
        break;
        case "emediagram_create" :
        $this->emediagram_create($segments[0]);
        break;
        break;
        case "emediagram_edit" :
        $this->emediagram_edit($segments[0],$segments[1]);
        break;
        case "emediagram_ajaxdelete" :
        $this->emediagram_ajaxdelete();
        break;
        case "emediagram_delete" :
        $this->emediagram_delete($segments[0],$segments[1]);
        break;
        case "warden_index":
           $this->warden_index($segments[0]);
        break;
        case "warden_create":
           $this->warden_create($segments[0]);
        break;
        case "warden_edit":
           $this->warden_edit($segments[0],$segments[1]);
        break;
        case "warden_delete":
           $this->warden_delete($segments[0],$segments[1]);
        break;
        case "evacuationrpt_index":
           $this->evacuationrpt_index($segments[0]);
        break;
        case "evacuationrpt_create":
           $this->evacuationrpt_create($segments[0]);
        break;
        case "evacuationrpt_edit":
           $this->evacuationrpt_edit($segments[0],$segments[1]);
        break;
        case "evacuationrpt_delete":
           $this->evacuationrpt_delete($segments[0],$segments[1]);
        break;
        
        
        
       default :
          $this->items(0); 
        break;
     }
     
	}
    function allotmember($designationid,$propertyid)
    {
       
        $vars=array();
          $vars = array('page_title' => 'Property');
          $crumbs = array('property' => 'Property', 'Allot member');
		  $this->fuel->admin->set_titlebar($crumbs);
        $vars["propertyid"]=$propertyid;
        $vars["designationid"]=$designationid;
        $vars["designationdetail"]=$this->admin_model->getdesignation($designationid);
      
        $freemember=$this->admin_model->freemember($propertyid);
        $vars["freemember"]=$freemember;
       if(!empty($_POST))
        {
            $this->admin_model->saveallotmember($_POST); 
        }
        $allotmember=$this->admin_model->allotmember($propertyid);
        $vars["allotmember"]=$allotmember;
        $this->fuel->admin->render('property/allotuserlist', $vars, Fuel_admin::DISPLAY_NO_ACTION);
    }
    function freemember($id,$designationid,$propertyid)
    {
       if(!empty($id))
       {
       $this->admin_model->freeallotmember($id);
       } 
     //   echo "fuel/property/admin/allotmember/".$designationid."/".$propertyid; exit;
        redirect("fuel/property/admin/allotmember/".$designationid."/".$propertyid);
    }
    function create()
    {
         if($this->fuel->auth->has_permission('property/create',"create")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	
        //	$this->load->model('property/admin_model');
		$this->item_validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[250]|required|callback__addname_check'
			)
		
			
		);
    
    
    
    if(!empty($_POST))
    {
        //echo "<pre>";
       
       	$this->form_validation->set_rules($this->item_validation_rules);
   
    
   
    //print_r($this->form_validation);
  
		if ($this->form_validation->run()==true)
		{
		   $data  = array('name'=> $_POST['name'],
            			 'order'=> $_POST['order'],
                         'country'=> $_POST['country'],
                         'state'=> $_POST['state'],
                         'city'=> $_POST['city'],
                         'address'=> $_POST['address']
                         );
                     if(!empty($_FILES['sitephotos']["name"][0]))
                                      { 
                                             $data=array_merge($data,array('sitephotos'=> $_FILES['sitephotos']));
                                      }        
		  if(!empty($_FILES['photos']["name"][0]))
                                      { 
                                             $data=array_merge($data,array('photos'=> $_FILES['photos']));
                                      }
                                    
			if ($this->admin_model->create($data))
			{
		
				// All good...
				$this->session->set_userdata('msg', "Insert successfully");
				redirect('fuel/property/');
			}
			else
			{
		// echo "test123"; exit;
			//	$this->session->set_flashdata('error', lang('stations.error'));
				redirect('fuel/property/admin/create');
			}  
		}
        //else
       // {
         //   	redirect('fuel/property/admin/create');
            
       // }
	
    }
         
          $vars = array('page_title' => 'Property');
          $crumbs = array('property' => 'Property', 'Create');
		  $this->fuel->admin->set_titlebar($crumbs);
           //$vars["list"]=$this->admin_model->property_list();
           // $vars['courses'] = $this->courses_model->get_courses();
 
          
            $this->fuel->admin->render('property/admincreate', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
        }else
        {
           redirect('fuel/property/'); 
        }
             
    }
		function items($offset=0)
	{
	   
    
 // echo $offset;
     // print_r($_REQUEST);
       
        if($offset==0)
     {
       $limit   = 10;    
       $start   = 0;  
     }
      else
     {
       // $limit  = 2*$offset;    
       // $start  = $limit-2;  
       $start=$offset;
     }

     $limit                          =  10; 
     $config                         =  array();
     $config['base_url']             =  base_url().'fuel/property/admin/items/';
     $config['total_rows']           =  $this->admin_model->getCounts();
     $config['per_page']             =  $limit;
     $config['uri_segment']          =  5; 
     $config['cur_page']             =  0; 
     $config['num_links']            =  5;
     $config['page_query_string']    =  FALSE;
     $config['enable_query_strings'] =  FALSE;
	 $this->pagination->initialize($config);
       
	      $base_where = array();
            	// Determine active param
        if(empty($_REQUEST["search_term"]))
        {
            $_REQUEST["search_term"]="";
        }
          $base_where['name'] = $_REQUEST["search_term"]  ? $_REQUEST["search_term"] : "";  
             

            
         $vars=array();
          $vars = array('page_title' => 'Property');
          $crumbs = array('property' => 'Property', 'List');
		  $this->fuel->admin->set_titlebar($crumbs);
         $vars["list"]=$this->admin_model->property_list($base_where,$limit,$start);
     // $vars["list"]=$this->admin_model->property_list($base_where);
       $vars["designation"]=$this->admin_model->designation();
       
      $vars["userlink"]=$this->admin_model->userlink();
      $vars["imageslist"]=array();
    
      
      if(!empty($vars["list"]))
      {
         foreach($vars["list"] as $key => $detail)
         {
            $mainid=$detail["id"];
            
          
            
            $imagesdetail[$mainid]=$this->admin_model->property_imageslist($mainid);
            
                 //   echo "<pre>";
   //print_r($imagesdetail);
   
         }
        $vars["imageslist"]=$imagesdetail;
        
 
   
   
      }
      
    // echo "<pre>";
     //print_r($vars["imageslist"]); 
      
      //   $vars['body'] = $this->load->module_view(property_FOLDER, "index", $vars, TRUE);
      //$this->load->module_view(FUEL_FOLDER, '_blocks/fuel_header'); 
     // $this->load->view('adminindex', $vars, TRUE);
        // $output = $this->load->view('adminindex', $vars, TRUE);//$this->_render('adminindex', $vars, TRUE);
        // 	$this->output->set_output($output);
    //  $this->fuel->admin->no_cache();
     // $this->fuel->admin->render('property/adminindex', $vars, Fuel_admin::DISPLAY_DEFAULT,'property');   
   //    echo $this->load->view('property/adminindex', $vars, TRUE);
      $this->fuel->cache->clear_pages();
         
     if($start==0)
     { 
       echo $this->load->view('adminindex', $vars,true);
   /*      $inline = $this->input->get('inline', TRUE);
$this->fuel->admin->set_inline($inline);
if ($inline === TRUE)
{
$this->fuel->admin->set_display_mode(Fuel_admin::DISPLAY_COMPACT_TITLEBAR);
} */
//$this->fuel->admin->render('property/adminindex', $vars,Fuel_admin::DISPLAY_DEFAULT);
       
        // $this->fuel->admin->render('property/adminindex', $vars,Fuel_admin::DISPLAY_DEFAULT);
        // $this->fuel->admin->render('property/adminindex', $vars, Fuel_admin::DISPLAY_DEFAULT);   
     }else
     {
       //  echo $this->load->view('adminindex', $vars,true);
       // echo $this->load->view('adminindex', $vars);
    /*   $inline = $this->input->get('inline', TRUE);
$this->fuel->admin->set_inline($inline);
if ($inline === TRUE)
{
$this->fuel->admin->set_display_mode(Fuel_admin::DISPLAY_COMPACT_TITLEBAR);
}  */
$this->fuel->admin->render('property/adminindex', $vars, Fuel_admin::DISPLAY_NO_ACTION);
      //  echo $this->load->view('adminindex', $vars,true);
      //$this->fuel->admin->render('property/adminindex', $vars, Fuel_admin::DISPLAY_NO_ACTION);
      //  echo $this->load->view('adminindex', $vars);   
     }
     
     
     
      //
        
		
	}
    function downloadprolink($filename)
    {
        
        $file = UPLOAD_ROOT_PATH."/property/pdf/".$filename;
                
                 if (file_exists($file)) {
                 header('Content-Description: File Transfer');
                 header('Content-Type: application/octet-stream');
                 header("Content-Type: application/force-download");
                 header('Content-Disposition: attachment; filename=' . urlencode(basename($file)));
                // header('Content-Transfer-Encoding: binary');
                 header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                 header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                ob_clean();
                flush();
                 readfile($file);
                 exit;
                   }
    }
   function procedureslink($propertyid)
   {
       $getdata=$this->admin_model->getby_id($propertyid);
       $vars = array('page_title' => 'Property Procedures link');
       $vars["edit"]=$getdata[0];
       $vars["procedureslinks"]=$this->admin_model->procedures_link();
       $vars["errors"]=array();  
       $error_arrs=array();      
       $crumbs = array('property/admin' => 'Property', 'Procedures link');
	   $this->fuel->admin->set_titlebar($crumbs);
       if(!empty($_POST))
       {
          //***********************************************  Buliding Image ************************** 
        $propertyid=$_POST["propertyid"];
        foreach($vars["procedureslinks"] as $key => $value)
       {
       $prolink_id=$value["id"];
       $proname="getpdf_".$prolink_id;  
        if(!empty($_FILES[$proname]['name']))
					{
					   $this->load->library('upload');
                       $gettmp_tumbs_arr=array();

					  
                                                    
                        $data_trans=array("propertyid" =>$propertyid);
                        
						$ext = explode(".",$_FILES[$proname]['name']);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = UPLOAD_ROOT_PATH.'property/pdf';
						$uploadConst['allowed_types'] = 'pdf';
                        $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'pdf-'.$propertyid."-".$prolink_id.".".$ext; 
                        
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload($proname))
							{
							  $error_arrs[$prolink_id] = $this->upload->display_errors(); 
                             
                             }
						 else
							{   
							 $config=array();
                             $pdfname=$uploadConst['file_name'];
                             $this->admin_model->save_procedureslink($propertyid,$prolink_id,$pdfname);
                            }
                        }   
                        
                     }   
                     
                     if(!empty($error_arrs))
                     {
                        $vars["errors"]=$error_arrs;
                     }else
                     {
                        $this->session->set_userdata('msg', "PDF Upload successfully");
                        redirect("fuel/property");
                     }
                      
					}
          //*********************************************** End Buliding Image ************************** 
           
          
           
        
          
          
      $this->fuel->admin->render('property/adminprolink', $vars, Fuel_admin::DISPLAY_NO_ACTION);
   } 
    
	function edit($id)
    {
         if($this->fuel->auth->has_permission('property/edit',"edit")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	
        
		$this->item_validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[100]|required|callback__editname_check'
			)
			
		);
    $getdata=array(); 
    
    $getdata=$this->admin_model->getby_id($id);
    $get_propertyimage=$this->admin_model->getpropertyimages($id);
   
    if(!empty($_POST))
    {
        //echo "<pre>";
       
       	$this->form_validation->set_rules($this->item_validation_rules);
   
    
   
    //print_r($this->form_validation);
  
		if ($this->form_validation->run()==true)
		{
		   $data  = array('name'=> $_POST['name'],
                         'id'=> $_POST['id'],
            			 'order'=> $_POST['order'],
                         'country'=> $_POST['country'],
                         'state'=> $_POST['state'],
                         'city'=> $_POST['city'],
                         'address'=> $_POST['address']
                         );
                     if(!empty($_FILES['sitephotos']["name"][0]))
                                      { 
                                             $data=array_merge($data,array('sitephotos'=> $_FILES['sitephotos']));
                                      }  
		  if(!empty($_FILES['photos']["name"][0]))
                                      { 
                                             $data=array_merge($data,array('photos'=> $_FILES['photos']));
                                      } 
			if ($this->admin_model->edit($data))
			{
		      
				// All good...
				$this->session->set_userdata('msg', "Update successfully");
               	redirect('fuel/property/');
			}
			else
			{
		// echo "test123"; exit;
			//	$this->session->set_flashdata('error', lang('stations.error'));
				redirect('fuel/property/admin/edit/'.$_POST["id"]);
			}  
		}
	
    }
         
          $vars = array('page_title' => 'Property');
          $vars["edit"]=$getdata[0];
          $vars["proimages"]=$get_propertyimage;
          $crumbs = array('property' => 'Property', 'Edit');
		  $this->fuel->admin->set_titlebar($crumbs);
          // $vars["list"]=$this->property_model->property_list();
           // $vars['courses'] = $this->courses_model->get_courses();
                $this->load->library('googlemaps');
                $address="";
                
                $address.= $getdata[0]["address"]? $getdata[0]["address"]."," : "";
                $address.= $getdata[0]["city"]? $getdata[0]["city"]."," : "";
                $address.= $getdata[0]["state"]? $getdata[0]["state"]."," : "";
                $address.= $getdata[0]["country"]? $getdata[0]["country"]."," : "";
                
                $config['center'] = $address;//'Adelaide, Australia';
                $config['zoom'] = '13';
               // $config['drawing'] = true;
               // $config['drawingDefaultMode'] = 'circle';
               // $config['drawingModes'] = array('circle','rectangle','polygon');
               
              // $config['map_type'] = 'STREET';
              // $config['streetViewPovHeading'] = 90;
                $this->googlemaps->initialize($config);
                $marker = array();
				$marker['position'] = $getdata[0]["address"];
			//	$marker['infowindow_content'] = "$html";
				$marker['icon'] = 'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=B|C21214|FFFFFF';
				$this->googlemaps->add_marker($marker);
                $vars['map'] = $this->googlemaps->create_map();

          
            $this->fuel->admin->render('property/adminedit', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
       }else
       {
        
        	redirect('fuel/property/');
       }      
    }
    
    function delete($id)
	{
	      if($this->fuel->auth->has_permission('property/delete',"delete")==true)
         {
             
	   if(!empty($id))
       {
          //*************************** Delete Allot User ****************** 
           $this->admin_model->delete_allotusers($id);
        
          //*************************** Delete Emergency Procedures Link ****************** 
           $this->admin_model->delete_emeproceduce_link($id);
          //*************************** Delete Emergency Diagrams Link ****************** 
           $this->admin_model->delete_emediagrams_link($id); 
         //*************************** Delete Emergency Warden Link ****************** 
           $this->admin_model->delete_warden_link($id);   
          //*************************** Delete Evacution Reports ****************** 
           $this->admin_model->delete_evacuation_reports($id);   
         //**********************  Delete Main Property ********************
        	  $this->session->set_userdata('msg', "Delete successfully");
             
              $get_propertyimage=$this->admin_model->getpropertyimages($id);
            
              if(!empty($get_propertyimage))
              {
               foreach($get_propertyimage as $key => $proimagesdetail)
                  {
                    $deleteid=$proimagesdetail["id"];
                     $filename_main=UPLOAD_ROOT_PATH."property/".$proimagesdetail["imagename"];
                         if (file_exists($filename_main)) {
                            unlink($filename_main);
                        } 
                     $filenamethumbs=UPLOAD_ROOT_PATH."property/thumbs/".$proimagesdetail["imagename"];
                         if (file_exists($filenamethumbs)) {
                            unlink($filenamethumbs);
                        } 
                      $this->admin_model->getpropertyimage_delete($deleteid);    
                  }
               }
                  
              $getdata=$this->admin_model->getby_id($id);
                 
              if(!empty($getdata[0]["sitemapimg"]))
               {
                 $sitemap_filename_main=UPLOAD_ROOT_PATH."property/".$getdata[0]["sitemapimg"];
                         if (file_exists($sitemap_filename_main)) {
                            unlink($sitemap_filename_main);
               } 
                     $sitemap_filenamethumbs=UPLOAD_ROOT_PATH."property/thumbs/".$getdata[0]["sitemapimg"];
                         if (file_exists($sitemap_filenamethumbs)) {
                            unlink($sitemap_filenamethumbs);
                        } 
               }   
                  
                  
              $this->admin_model->delete($id);
              
            //**********************  Delete Main Property ********************  
       }
       	redirect('fuel/property/');
        }else
        {
            redirect('fuel/property/');
        }
	}
    
    function _addname_check($proname)
	{
		if ($this->addcheckname($proname)>0)
		{
			$this->form_validation->set_message('_addname_check', "This Property have already created");
			return false;
		}

		return true;
	}
	
	 function addcheckname($pronames)
	{
	      return $this->db
		  ->where('name',$pronames) 
		 ->count_all_results('fuel_property');
	}
    
      function _editname_check($proname)
	{
		if ($this->editcheckname($proname)>0)
		{
			$this->form_validation->set_message('_editname_check', "This Property have already created");
			return false;
		}

		return true;
	}
	
	 function editcheckname($pronames)
	{
	      return $this->db
		  ->where('name',$pronames) 
		  ->where('id <>',$_POST["id"])  
		  ->count_all_results('fuel_property');
	}
	 
   function deletepropertyimage()
   {
    	//$this->CI->load->helper('ajax');
        $deleteid=$_POST["deleteid"]; 
   
     if($deleteid >0)
     {
        $detail=$this->admin_model->getpropertyimage_detail($deleteid);
        $imagename=$detail[0]["imagename"];
        
        $filename_main=UPLOAD_ROOT_PATH."property/".$imagename;
             if (file_exists($filename_main)) {
                unlink($filename_main);
            } 
         $filenamethumbs=UPLOAD_ROOT_PATH."property/thumbs/".$imagename;
             if (file_exists($filenamethumbs)) {
                unlink($filenamethumbs);
            } 
            
          $this->admin_model->getpropertyimage_delete($deleteid);  
     }else
     {
        $deleteid=0;
     }
     echo $deleteid;
     //print_r($detail);
     //print_r($_POST); exit;
   }  
     //******************************************* Emergency Diagrams Link ****************
     
     
    function emediagram_index($propertyid)
    {
          $vars = array('page_title' => 'Property');
          $getdata=$this->admin_model->getby_id($propertyid);
          $vars["edit"]=$getdata[0]; 
          $vars["list"]=$this->admin_model->emediagram_list($propertyid);  
          $crumbs = array('property' => 'Property', 'property/admin/emediagram_index/'.$propertyid.'' => $getdata[0]["name"],'Emergency Diagrams Link Create');
		  $this->fuel->admin->set_titlebar($crumbs);
           if(!empty($vars["list"]))
          {
             foreach($vars["list"] as $key => $detail)
             {
                $mainid=$detail["id"];
                
                $imagesdetail[$mainid]=$this->admin_model->emediagram_imageslist($mainid);
             }
            $vars["imageslist"]=$imagesdetail;
          }
           
            
      $this->fuel->admin->render('property/adminemediagramindex', $vars, Fuel_admin::DISPLAY_NO_ACTION);
    } 
    function emediagram_create($propertyid)
    {
        if($this->fuel->auth->has_permission('property/create',"create")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	
        //	$this->load->model('property/admin_model');
		$this->item_validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[250]|required'
			)
		
			
		);
    
    
    
    if(!empty($_POST))
    {
        //echo "<pre>";
       
       	$this->form_validation->set_rules($this->item_validation_rules);
        //print_r($this->form_validation);
        if ($this->form_validation->run()==true)
		{
		   $data  = array('name'=> $_POST['name'],
            			  'order'=> $_POST['order'],
                          'propertyid'=>$_POST['propertyid']
                         );
         if(!empty($_FILES['photos']["name"][0]))
                                      { 
                                             $data=array_merge($data,array('photos'=> $_FILES['photos']));
                                      }
                                    
			if ($this->admin_model->emediagram_create($data))
			{
		
				// All good...
				$this->session->set_userdata('msg', "Insert successfully");
				redirect('fuel/property/admin/emediagram_index/'.$propertyid);
			}
			else
			{
		
			//	$this->session->set_flashdata('error', lang('stations.error'));
				redirect('fuel/property');
			}  
		}
        //else
       // {
         //   	redirect('fuel/property/admin/create');
            
       // }
	
    }
         
          $vars = array('page_title' => 'Property');
          $crumbs = array('property/admin' => 'Property', 'Emergency Diagrams Link');
          $getdata=$this->admin_model->getby_id($propertyid);
          $vars["edit"]=$getdata[0]; 
		  $this->fuel->admin->set_titlebar($crumbs);
           //$vars["list"]=$this->admin_model->property_list();
           // $vars['courses'] = $this->courses_model->get_courses();
 
          
            $this->fuel->admin->render('property/adminemediagramcreate', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
        }else
        {
           redirect('fuel/property/'); 
        }
    }
    function emediagram_edit($propertyid,$id)
    {
       if($this->fuel->auth->has_permission('property/edit',"edit")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	
        
		$this->item_validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[100]|required'
			)
			
		);
    $getdata=array(); 
    
    $getdata=$this->admin_model->emediagram_detail($id);
    $get_propertyimage=$this->admin_model->emediagram_imageslist($id);
   
    if(!empty($_POST))
    {
        //echo "<pre>";
       
       	$this->form_validation->set_rules($this->item_validation_rules);
   
    
   
    //print_r($this->form_validation);
  
		if ($this->form_validation->run()==true)
		{
		   $data  = array('name'=> $_POST['name'],
                         'id'=> $_POST['id'],
            			 'order'=> $_POST['order']
                         );
                    
		  if(!empty($_FILES['photos']["name"][0]))
                                      { 
                                             $data=array_merge($data,array('photos'=> $_FILES['photos']));
                                      } 
			if ($this->admin_model->emediagram_edit($data))
			{
		      
				// All good...
				$this->session->set_userdata('msg', "Update successfully");
               	redirect('fuel/property/admin/emediagram_index/'.$_POST['propertyid']);
			}
			else
			{
		// echo "test123"; exit;
			//	$this->session->set_flashdata('error', lang('stations.error'));
				redirect('fuel/property/admin/emediagram_edit/'.$_POST['propertyid'].'/'.$_POST["id"]);
			}  
		}
	
    }
         
          $vars = array('page_title' => 'Property');
          $vars["edit"]=$getdata[0];
          $vars["propertyid"]=$propertyid;
          $vars["proimages"]=$get_propertyimage;
          $crumbs = array('property' => 'Property', 'property/admin/emediagram_index/'.$propertyid.'' => $getdata[0]["name"],'Edit');
		  $this->fuel->admin->set_titlebar($crumbs);
          // $vars["list"]=$this->property_model->property_list();
           // $vars['courses'] = $this->courses_model->get_courses();
 
          
            $this->fuel->admin->render('property/adminemediagramedit', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
       }else
       {
        
        	redirect('fuel/property/');
       }     
    }
    function emediagram_ajaxdelete()
    {
      
      
       $deleteid=$_POST["deleteid"]; 
   
     if($deleteid >0)
     {
        $detail=$this->admin_model->emediagram_imagesdetail($deleteid);
        $imagename=$detail[0]["imagename"];
        
        $filename_main=UPLOAD_ROOT_PATH."property/".$imagename;
             if (file_exists($filename_main)) {
                unlink($filename_main);
            } 
         $filenamethumbs=UPLOAD_ROOT_PATH."property/thumbs/".$imagename;
             if (file_exists($filenamethumbs)) {
                unlink($filenamethumbs);
            } 
            
          $this->admin_model->emediagram_delete($deleteid);  
     }else
     {
        $deleteid=0;
     }
     echo $deleteid;
      
       
    } 
    
    
    function emediagram_delete($propertyid,$id)
	{
	      if($this->fuel->auth->has_permission('property/delete',"delete")==true)
         {
	   if(!empty($id))
       {
        
        
        	  $this->session->set_userdata('msg', "Delete successfully");
             
              $get_propertyimage=$this->admin_model->emediagram_imageslist($id);
            
              if(!empty($get_propertyimage))
              {
               foreach($get_propertyimage as $key => $proimagesdetail)
                  {
                    $deleteid=$proimagesdetail["id"];
                     $filename_main=UPLOAD_ROOT_PATH."property/".$proimagesdetail["imagename"];
                         if (file_exists($filename_main)) {
                            unlink($filename_main);
                        } 
                     $filenamethumbs=UPLOAD_ROOT_PATH."property/thumbs/".$proimagesdetail["imagename"];
                         if (file_exists($filenamethumbs)) {
                            unlink($filenamethumbs);
                        } 
                      $this->admin_model->emediagram_delete($deleteid);    
                  }
               }
                  
              //$getdata=$this->admin_model->emediagram_detail($id);
                  
              $this->admin_model->emediagramdelete($id);
       }
       	redirect('fuel/property/admin/emediagram_index/'.$propertyid);
        }else
        {
            redirect('fuel/property/');
        }
	}
     //**************************************  Warden   *********************************************
    function warden_index($propertyid)
	{
	    $vars = array('page_title' => 'Property');
          $getdata=$this->admin_model->getby_id($propertyid);
          $vars["edit"]=$getdata[0]; 
          $vars["list"]=$this->admin_model->warden_list($propertyid);  
          $crumbs = array('property' => 'Property', 'property/admin/warden_index/'.$propertyid.'' => $getdata[0]["name"],'Warden List');
		  $this->fuel->admin->set_titlebar($crumbs);
           
           
            
      $this->fuel->admin->render('property/adminwardenindex', $vars, Fuel_admin::DISPLAY_NO_ACTION);
    }   
     
     function warden_create($propertyid)
	{
        if($this->fuel->auth->has_permission('property/create',"create")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	
        //	$this->load->model('property/admin_model');
		$this->item_validation_rules = array(
			array(
				'field' => 'firstname',
				'label' => 'First Name',
				'rules' => 'trim|max_length[250]|required'
			)
		
			
		);
    
    
    
    if(!empty($_POST))
    {
        //echo "<pre>";
       
       	$this->form_validation->set_rules($this->item_validation_rules);
        //print_r($this->form_validation);
        if ($this->form_validation->run()==true)
		{          
		   $data  = array('firstname'=> $_POST['firstname'],
            			  'familyname'=> $_POST['familyname'],
                           'ecoposition'=> $_POST['ecoposition'],
                          'location'=> $_POST['location'],
                          'contactdetails'=> $_POST['contactdetails'],
                          'firedate'=> $_POST['firedate'],
                          'evacuation'=> $_POST['evacuation'],
                          'trialevacuation'=> $_POST['trialevacuation'],
                          'propertyid'=>$_POST['propertyid']
                         );
         if ($this->admin_model->warden_create($data))
			{
		
				// All good...
				$this->session->set_userdata('msg', "Insert successfully");
				redirect('fuel/property/admin/warden_index/'.$propertyid);
			}
			else
			{
		
			//	$this->session->set_flashdata('error', lang('stations.error'));
				redirect('fuel/property');
			}  
		}
       
    }
          $vars = array('page_title' => 'Property');
          $crumbs = array('property' => 'Property', 'property/admin/warden_index/'.$propertyid.'' => 'Warden List','Create');
          $getdata=$this->admin_model->getby_id($propertyid);
          $vars["edit"]=$getdata[0]; 
		  $this->fuel->admin->set_titlebar($crumbs);
           
          
            $this->fuel->admin->render('property/adminwardencreate', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
        }else
        {
           redirect('fuel/property/'); 
        }
    }
    function warden_edit($propertyid,$id)
	{
	   if($this->fuel->auth->has_permission('property/edit',"edit")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	
        //	$this->load->model('property/admin_model');
		$this->item_validation_rules = array(
			array(
				'field' => 'firstname',
				'label' => 'First Name',
				'rules' => 'trim|max_length[250]|required'
			)
		
			
		);
    
    
    
    if(!empty($_POST))
    {
        //echo "<pre>";
       
       	$this->form_validation->set_rules($this->item_validation_rules);
        //print_r($this->form_validation);
        if ($this->form_validation->run()==true)
		{          
		   $data  = array('firstname'=> $_POST['firstname'],
            			  'familyname'=> $_POST['familyname'],
                           'ecoposition'=> $_POST['ecoposition'],
                          'location'=> $_POST['location'],
                          'contactdetails'=> $_POST['contactdetails'],
                          'firedate'=> $_POST['firedate'],
                          
                          'evacuation'=> $_POST['evacuation'],
                          'trialevacuation'=> $_POST['trialevacuation'],
                          'propertyid'=>$_POST['propertyid']
                         );
         if ($this->admin_model->warden_edit($data,$_POST['id']))
			{
		
				// All good...
				$this->session->set_userdata('msg', "Update successfully");
				redirect('fuel/property/admin/warden_index/'.$propertyid);
			}
			else
			{
		
			//	$this->session->set_flashdata('error', lang('stations.error'));
				redirect('fuel/property');
			}  
		}
       
    }
          $vars = array('page_title' => 'Property');
          $crumbs = array('property' => 'Property', 'property/admin/warden_index/'.$propertyid.'' => 'Warden List','Edit');
          $getdata=$this->admin_model->getby_id($propertyid);
          $vars["edit"]=$getdata[0];
          $wardensdetails=$this->admin_model->wardens_details($id);
          $vars["wardensdetails"]=$wardensdetails[0];
          
           
		  $this->fuel->admin->set_titlebar($crumbs);
           
          
            $this->fuel->admin->render('property/adminwardenedit', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
        }else
        {
           redirect('fuel/property/'); 
        }
    }
    function warden_delete($propertyid,$id)
	{
	    if($this->fuel->auth->has_permission('property/delete',"delete")==true)
         {
            	   if(!empty($id))
                   {
                    $this->admin_model->warden_delete($id);
                 	redirect('fuel/property/admin/warden_index/'.$propertyid);
                    }
        }else
        {
           redirect('fuel/property/'); 
        }
    }   
     //*************************************************************************************
      //**************************************  Evacuation Reports   *********************************************
    function evacuationrpt_index($propertyid)
	{
	    $vars = array('page_title' => 'Property');
          $getdata=$this->admin_model->getby_id($propertyid);
          $vars["edit"]=$getdata[0]; 
          $vars["list"]=$this->admin_model->evacuationrpt_list($propertyid);  
          $crumbs = array('property' => 'Property', 'property/admin/evacuationrpt_index/'.$propertyid.'' => $getdata[0]["name"],'Evacuation Report List');
		  $this->fuel->admin->set_titlebar($crumbs);
           
           
            
      $this->fuel->admin->render('property/adminevacuationrptindex', $vars, Fuel_admin::DISPLAY_NO_ACTION);
    }   
     
     function evacuationrpt_create($propertyid)
	{
        if($this->fuel->auth->has_permission('property/create',"create")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	     $error_arrs="";
         $name="";
        //	$this->load->model('property/admin_model');
		$this->item_validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[250]|required'
			)
		
			
		);
    
    $max_id=$this->admin_model->evacuationrpt_maxid();
    
    if(!empty($_POST))
    {
        //echo "<pre>";
       $name=$_POST["name"];
       	$this->form_validation->set_rules($this->item_validation_rules);
        //print_r($this->form_validation);
        if ($this->form_validation->run()==true)
		{          
		           $pdfname="";
                    $propertyid=$_POST['propertyid'];     
                          if(!empty($_FILES["uppdf"]['name']))
					{
					   $this->load->library('upload');
                       $gettmp_tumbs_arr=array();

					  
                                                    
                       // $data_trans=array("propertyid" =>$propertyid);
                        
						$ext = explode(".",$_FILES["uppdf"]['name']);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = UPLOAD_ROOT_PATH.'property/pdf';
						$uploadConst['allowed_types'] = 'pdf';
                        $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'evarptpdf-'.$propertyid."-".$max_id.".".$ext; 
                        
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload("uppdf"))
							{
							  $error_arrs = $this->upload->display_errors(); 
                             
                             }
						 else
							{   
							 $config=array();
                             $pdfname=$uploadConst['file_name'];
                            }
                        }   
                   if(empty($error_arrs)) //  check upload file validation
                   {      
                       $data  = array('name'=> $_POST['name'],
            			         'propertyid'=>$_POST['propertyid'],
                                 'pdfname' => $pdfname
                         );   
                         
                     if ($this->admin_model->evacuationrpt_create($data))
            			{
            		
            				// All good...
            				$this->session->set_userdata('msg', "Insert successfully");
            				redirect('fuel/property/admin/evacuationrpt_index/'.$propertyid);
            			}
            			else
            			{
            		
            			//	$this->session->set_flashdata('error', lang('stations.error'));
            				redirect('fuel/property');
            			}
                   }       
		} // end validation
       
    } // end post
          $vars = array('page_title' => 'Property');
          $crumbs = array('property' => 'Property', 'property/admin/evacuationrpt_index/'.$propertyid.'' => 'Evacuation Reports List','Create');
          $getdata=$this->admin_model->getby_id($propertyid);
          $vars["edit"]=$getdata[0]; 
          $vars["error_file"]=$error_arrs;
          $vars["name"]=$name;
		  $this->fuel->admin->set_titlebar($crumbs);
           
          
            $this->fuel->admin->render('property/adminevacuationrptcreate', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
        }else
        {
           redirect('fuel/property/'); 
        }
    }
    function evacuationrpt_edit($propertyid,$id)
	{
	   if($this->fuel->auth->has_permission('property/edit',"edit")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	     $error_arrs="";
         $name="";
        //	$this->load->model('property/admin_model');
		$this->item_validation_rules = array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|max_length[250]|required'
			)
		
			
		);
    
    
    
    if(!empty($_POST))
    {
      $max_id=$_POST["id"];   
        //echo "<pre>";
       $name=$_POST["name"];
       	$this->form_validation->set_rules($this->item_validation_rules);
        //print_r($this->form_validation);
        if ($this->form_validation->run()==true)
		{          
		           $pdfname="";
                    $propertyid=$_POST['propertyid'];     
                          if(!empty($_FILES["uppdf"]['name']))
					{
					   $this->load->library('upload');
                       $gettmp_tumbs_arr=array();

					  
                                                    
                       // $data_trans=array("propertyid" =>$propertyid);
                        
						$ext = explode(".",$_FILES["uppdf"]['name']);
						$ext = strtolower($ext[1]);
						$uploadConst['upload_path']   = UPLOAD_ROOT_PATH.'property/pdf';
						$uploadConst['allowed_types'] = 'pdf';
                        $uploadConst['overwrite'] = TRUE;
						$uploadConst['file_name']     = 'evarptpdf-'.$propertyid."-".$max_id.".".$ext; 
                        
						$this->upload->initialize($uploadConst);
                        if (!$this->upload->do_upload("uppdf"))
							{
							  $error_arrs = $this->upload->display_errors(); 
                             
                             }
						 else
							{   
							 $config=array();
                             $pdfname=$uploadConst['file_name'];
                            }
                        }   
                   if(empty($error_arrs)) //  check upload file validation
                   {      
                       $data  = array('name'=> $_POST['name'],
            			         'propertyid'=>$_POST['propertyid']
                                 
                         );   
                         
                         if(!empty($pdfname))
                         {
                            $data["pdfname"]=$pdfname;
                         }
                     if ($this->admin_model->evacuationrpt_edit($data,$max_id))
            			{
            		
            				// All good...
            				$this->session->set_userdata('msg', "Update successfully");
            				redirect('fuel/property/admin/evacuationrpt_index/'.$propertyid);
            			}
            			else
            			{
            		
            			//	$this->session->set_flashdata('error', lang('stations.error'));
            				redirect('fuel/property');
            			}
                   }       
		} // end validation
       
    } // end post
          $vars = array('page_title' => 'Property');
          $crumbs = array('property' => 'Property', 'property/admin/evacuationrpt_index/'.$propertyid.'' => 'Evacuation Reports','Edit');
          $getdata=$this->admin_model->getby_id($propertyid);
          $vars["edit"]=$getdata[0];
          $vars["error_file"]=$error_arrs;
          $evacuationrptdetails=$this->admin_model->evacuationrpt_details($id);
          $vars["evacuationrptdetails"]=$evacuationrptdetails[0];
         
           
		  $this->fuel->admin->set_titlebar($crumbs);
           
          
            $this->fuel->admin->render('property/adminevacuationrptedit', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
        }else
        {
           redirect('fuel/property/'); 
        }
    }
    function evacuationrpt_delete($propertyid,$id)
	{
	    if($this->fuel->auth->has_permission('property/delete',"delete")==true)
         {
            	   if(!empty($id))
                   {
                      $evacuationrptdetails=$this->admin_model->evacuationrpt_details($id);
                 
                      if(!empty($evacuationrptdetails[0]["pdfname"]))
                       {
                         $pdf_filename_main=UPLOAD_ROOT_PATH."property/pdf/".$evacuationrptdetails[0]["pdfname"];
                                 if (file_exists($pdf_filename_main))
                                      {
                                    unlink($pdf_filename_main);
                                      } 
                            
                       }  
                    
                    
                    
                    $this->admin_model->evacuationrpt_delete($id);
                 	redirect('fuel/property/admin/evacuationrpt_index/'.$propertyid);
                    }else
                    {
                     redirect('fuel/property/admin/evacuationrpt_index/'.$propertyid);    
                    }
        }else
        {
           redirect('fuel/property/'); 
        }
    }   
     //*************************************************************************************
}

