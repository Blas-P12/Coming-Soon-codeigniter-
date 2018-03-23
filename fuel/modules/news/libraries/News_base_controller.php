<?php
class News_base_controller extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		if (!$this->fuel->auth->accessible_module('news'))
		{
			show_404();
		}
	
	}
	
	function _common_vars()
	{
		$vars['news'] =& $this->fuel->news;
		$vars['is_news'] = TRUE;
		$vars['page_title'] = '';
		$vars['is_home'] = $this->fuel->news->is_home();
		//$this->load->vars($vars);
		return $vars;
	}
	function _render($view, $vars = array(), $return = FALSE, $layout = '')
    {
 
        $vars['body'] = $this->load->module_view(NEWS_FOLDER, $view, $vars, TRUE);
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
		if (empty($layout)) $layout = $this->fuel->news->layout();

		// get any global variables for the headers and footers
		$uri_path = trim($this->fuel->news->config('uri'), '/');
		$_vars = $this->fuel->pagevars->retrieve($uri_path);
		
		if (is_array($_vars))
		{
			$vars = array_merge($_vars, $vars);
		}
		$view_folder = $this->fuel->news->theme_path();
		$vars['CI'] =& get_instance();

		$page = $this->fuel->pages->create();
		
		if (!empty($layout))
		{ 
			$vars['body'] = $this->load->module_view($this->fuel->news->config('theme_module'), $view_folder.$view, $vars, TRUE);
		
        	$view = $this->fuel->news->theme_path().$this->fuel->news->layout();  
		}
		else
		{
		  
			 $view = $view_folder.$view;  
		}
		$vars = array_merge($vars, $this->load->get_vars());
		$output = $this->load->module_view($this->fuel->news->config('theme_module'), $view, $vars, TRUE);
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