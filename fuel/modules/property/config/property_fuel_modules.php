<?php
$permission=array('property','edit','create','delete','evacuation','firesmokeemergencies','emergencies','bombarsonthreat','externalemergencies','medicalemergencies','internalemergencies','personalthreat','emergencyprolink','emergencydiagramlink','ecowardenlink','evacuationrpt');
$config['modules']['property'] = array(
	'module_name' => 'Property',
	'module_uri' => 'property/admin',
	'model_name' => 'property_model',
	'model_location' => 'property',
	'display_field' => 'name',
	'permission' => $permission,
	'instructions' => lang('module_instructions_default', 'Property'),
'archivable' => TRUE,
	'configuration' => array('property' => 'admin'),
'nav_selected' => 'property/admin',
//'table_actions' => array('EDIT','VIEW' => fuel_url(COURSE_FOLDER.'/admin/view/{id}'),'DELETE')
  //  'advanced_search'=>FALSE,
   // 'limit_options'=>array()
//	'language' => array('blog' => 'blog'),
	//'default_col' => 'post_date',
	//'default_order' => 'desc',
	//'sanitize_input' => array('template','php')
);

