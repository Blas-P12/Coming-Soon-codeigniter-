<?php
//$permission=array('member','edit','create','delete');
$config['modules']['member'] = array(
	'module_name' => 'Member',
	'module_uri' => 'member',
	'model_name' => 'member_model',
	'model_location' => 'member',
	'display_field' => 'name',
//	'permission' => "publish",
	'instructions' => lang('module_instructions_default', 'Member'),
//	'archivable' => TRUE,
	'configuration' => array('member' => 'member'),
	'nav_selected' => 'member',
//	'language' => array('blog' => 'blog'),
	//'default_col' => 'post_date',
	//'default_order' => 'desc',
	//'sanitize_input' => array('template','php')
);

