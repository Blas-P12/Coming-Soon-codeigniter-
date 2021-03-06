<?php
/*
|--------------------------------------------------------------------------
| BLOG HOOKS
|--------------------------------------------------------------------------
|
| The following are hooks used by the FUEL blog specifically. This file is included
| in the fuel/application/config/hooks.php file
|
*/
/* Example of a module hook for a module named projects
$hook['blog_before_posts_by_date'] = array(
								'class'    => 'Blog_hooks',
								'function' => 'before_posts_by_date',
								'filename' => 'Blog_hooks.php',
								'filepath' => 'hooks',
								'params'   => array(),
								'module' => 'app',
*/


$hook['member_before_posts_by_date'][] = array();
$hook['member_before_posts_by_page'][] = array();
$hook['member_before_post'][] = array();
$hook['member_before_posts_by_category'][] = array();
$hook['member_before_posts_by_author'][] = array();


/* End of file fuel_hooks.php */
/* Location: ./modules/fuel/config/fuel_hooks.php */