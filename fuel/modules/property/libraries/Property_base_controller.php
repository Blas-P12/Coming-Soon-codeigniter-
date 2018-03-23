<?php
class Property_base_controller extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->fuel->auth->accessible_module('property'))
		{
			show_404();
		}
	
	}
	
	function _common_vars()
	{
		$vars['property'] =& $this->fuel->property;
		$vars['is_property'] = TRUE;
		$vars['page_title'] = '';
		$vars['is_home'] = $this->fuel->property->is_home();
		//$this->load->vars($vars);
		return $vars;
	}
	function _render($view, $vars = array(), $return = FALSE, $layout = '')
    {
 
        $vars['body'] = $this->load->module_view(property_FOLDER, $view, $vars, TRUE);
      echo   $output = $this->load->view('index', $vars, TRUE);
        // $this->output->set_output($output);
 
        $layout = (! empty($layout) ) ? $layout : 'main';
        $output = $this->load->view('_layouts/'.$layout, $vars, TRUE);
 
        $this->load->module_library(FUEL_FOLDER, 'fuel_pages');
       $this->fuel_pages->initialize();
        $output = $page->fuelify($output);
 
        if ($return)
        {
            return $output;
        }
        else
        {
            $this->output->set_output($output);
        }
    }
	function _renderold($view, $vars = array(), $return = FALSE, $layout = '')
	{
		if (empty($layout)) $layout = $this->fuel->property->layout();

		// get any global variables for the headers and footers
		$uri_path = trim($this->fuel->property->config('uri'), '/');
		$_vars = $this->fuel->pagevars->retrieve($uri_path);
		
		if (is_array($_vars))
		{
			$vars = array_merge($_vars, $vars);
		}
		$view_folder = $this->fuel->property->theme_path();
		$vars['CI'] =& get_instance();

		$page = $this->fuel->pages->create();
		
		if (!empty($layout))
		{ 
			$vars['body'] = $this->load->module_view($this->fuel->property->config('theme_module'), $view_folder.$view, $vars, TRUE);
		
        	$view = $this->fuel->property->theme_path().$this->fuel->property->layout();  
		}
		else
		{
		  
			 $view = $view_folder.$view;  
		}
		$vars = array_merge($vars, $this->load->get_vars());
		$output = $this->load->module_view($this->fuel->property->config('theme_module'), $view, $vars, TRUE);
		$output = $page->fuelify($output);

		if ($return)
		{
			return $output;
		}
		else
		{
			$this->output->set_output($output);
		}
	}
}