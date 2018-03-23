<?php
$permission=array('news','edit','create','delete');
$config['modules']['news'] = array(
	'module_name' => 'News',
	'module_uri' => 'news/admin',
	'model_name' => 'news_model',
	'model_location' => 'news',
	'display_field' => 'name',
	'permission' => $permission,
	'instructions' => lang('module_instructions_default', 'News'),
	'archivable' => TRUE,
	'configuration' => array('news' => 'admin'),
	'nav_selected' => 'news/admin',
//	'language' => array('blog' => 'blog'),
	//'default_col' => 'post_date',
	//'default_order' => 'desc',
	//'sanitize_input' => array('template','php')
);

