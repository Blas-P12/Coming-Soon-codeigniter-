<?php
   // require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');
   // require_once(MODULES_PATH.'/news/libraries/News_base_controller.php');
//class News extends News_base_controller {
     
    require_once(FUEL_PATH.'controllers/module.php');
class Admin extends Module {
//class Admin extends Fuel_base_controller {
	 public $view_location = 'news';
	function __construct()
	{  
		parent::__construct('news');
        	$this->view_location = 'fuel';
		$this->load->module_model(NEWS_FOLDER, 'admin_model');
        $this->load->helper(array('form', 'url'));

		$this->load->library('form_validation');
        $this->load->library('session');
        
 // $test=$this->_validate_user('news/delete',"delete");


    
      //  $this->fuel->auth->has_permission('$permission');
        //echo $this->fuel->auth->is_logged_in(); exit;
        
	}
  
	function _remap()
	{
		
         $vars=array();
         $vars["list"]=$this->news_model->news_list();
       
      //   $vars['body'] = $this->load->module_view(NEWS_FOLDER, "index", $vars, TRUE);
          //echo   $output = $this->load->view('index', $vars, TRUE);
       // echo "testing";
         $args = func_get_args();
        $method = $args[0]; 
        $segments = $args[1]; 
      
   
     switch($method)
     {
        case "items":  
         $this->items(); 
        break;
        case "create":
        $this->create(); 
        break;
        case "edit":
        $this->edit($segments[0]); 
        break;
        case "delete":
        $this->delete($segments[0]); 
        break;
        default :
          $this->items(); 
        break;
     }
     
	}
    
    function create()
    {
         if($this->fuel->auth->has_permission('news/create',"create")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	
        //	$this->load->model('news/admin_model');
		$this->item_validation_rules = array(
			array(
				'field' => 'title',
				'label' => 'Name',
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'slug',
				'label' => 'Slug',
				'rules' => 'trim'
			)
			
		);
    
    
    
    if(!empty($_POST))
    {
        //echo "<pre>";
       
       	$this->form_validation->set_rules($this->item_validation_rules);
   
    
   
    //print_r($this->form_validation);
  
		if ($this->form_validation->run()==true)
		{
		  
			if ($this->admin_model->create($this->input->post()))
			{
		
				// All good...
				$this->session->set_userdata('msg', "Insert successfully");
				redirect('fuel/news/');
			}
			else
			{
		// echo "test123"; exit;
			//	$this->session->set_flashdata('error', lang('stations.error'));
				redirect('fuel/news/admin/create');
			}  
		}else
        {
            	redirect('fuel/news/admin/create');
            
        }
	
    }
         
          $vars = array('page_title' => 'News');
          $crumbs = array('news/admin' => 'News', 'Create');
		  $this->fuel->admin->set_titlebar($crumbs);
           $vars["list"]=$this->news_model->news_list();
           // $vars['courses'] = $this->courses_model->get_courses();
 
          
            $this->fuel->admin->render('news/admincreate', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
        }else
        {
           redirect('fuel/news/'); 
        }
             
    }
		function items()
	{
		
         $vars=array();
         $vars["list"]=$this->news_model->news_list();
       
      //   $vars['body'] = $this->load->module_view(NEWS_FOLDER, "index", $vars, TRUE);
      echo   $output = $this->load->view('adminindex', $vars, TRUE);
        
        
		
	}
	function edit($id)
    {
         if($this->fuel->auth->has_permission('news/edit',"edit")==true)
         {
    //   echo "create sdfgdfgd";
         $this->load->library('form_validation');
	
        
		$this->item_validation_rules = array(
			array(
				'field' => 'title',
				'label' => 'Name',
				'rules' => 'trim|max_length[100]|required'
			),
			array(
				'field' => 'slug',
				'label' => 'Slug',
				'rules' => 'trim'
			)
			
		);
    $getdata=array(); 
    $getdata=$this->admin_model->getby_id($id);
   
    if(!empty($_POST))
    {
        //echo "<pre>";
       
       	$this->form_validation->set_rules($this->item_validation_rules);
   
    
   
    //print_r($this->form_validation);
  
		if ($this->form_validation->run()==true)
		{
		  
			if ($this->admin_model->edit($this->input->post()))
			{
		      
				// All good...
				$this->session->set_userdata('msg', "Update successfully");
               	redirect('fuel/news/');
			}
			else
			{
		// echo "test123"; exit;
			//	$this->session->set_flashdata('error', lang('stations.error'));
				redirect('fuel/news/admin/edit/'.$_POST["id"]);
			}  
		}
	
    }
         
          $vars = array('page_title' => 'News');
          $vars["edit"]=$getdata[0];
          $crumbs = array('news/admin' => 'News', 'Edit');
		  $this->fuel->admin->set_titlebar($crumbs);
           $vars["list"]=$this->news_model->news_list();
           // $vars['courses'] = $this->courses_model->get_courses();
 
          
            $this->fuel->admin->render('news/adminedit', $vars, Fuel_admin::DISPLAY_NO_ACTION);
//      return   $output = $this->load->view('index', $vars, TRUE);
       }else
       {
        
        	redirect('fuel/news/');
       }      
    }
    
    function delete($id)
	{
	      if($this->fuel->auth->has_permission('news/delete',"delete")==true)
         {
	   if(!empty($id))
       {
        	$this->session->set_userdata('msg', "Delete successfully");
        $this->admin_model->delete($id);
       }
       	redirect('fuel/news/');
        }else
        {
            redirect('fuel/news/');
        }
	}
}