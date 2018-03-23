	<div id="fuel_left_panel">
		<div id="fuel_left_panel_inner">
<?php 
	// // Get all modules

$user = $this->fuel->auth->user_data();
		$id = $user['id'];
              
               
               
	$modules = $this->fuel->modules->get();
        
     
	$mods = $icons = array();
	      
	foreach($modules as $mod)
	{
		$info = $mod->info();
                
                  
                   
	    if(isset($info['module_uri']))
	    {
	        // Index modules by their uri so we know which module belongs to a specific nav item
	        $mods[$info['module_uri']] = isset($info['permission']) ? $info['permission'] : '';
	        // Use custom icon classes
	        $icons[$info['module_uri']] =isset($info['icon_class']) ?$info['icon_class'] : "ico_".url_title(str_replace('/', '_', $info['module_uri']),'_', TRUE);
	    }
	}
	echo "<div id='cssmenu'><ul>";
    //echo "<pre>";
   // print_r($nav); exit;
        
        
          /* if($user['super_admin']=='no'){
                  
               
               echo '<li class="has-sub"><a href="#"><span>Site</span></a><ul style="display: none;">
         <li><a href="'.fuel_url('dashboard').'"><span>Dashboard</span></a></li></ul></li>';
                   
               }elseif($user['super_admin']='yes')
               {
           }
                  */
              
               
               
	foreach($nav as $section => $nav_items)
	{
		if (is_array($nav_items))
		{
			$header_written = FALSE;
			foreach($nav_items as $key => $val)
			{
				$segments = explode('/', $key);
				$url = $key;
				
				// Check for a specific module's permission                                
				$perm = (isset($mods[$key]) AND !is_array($mods[$key])) ? $mods[$key] : $key;
				
				if (($this->fuel->auth->has_permission($perm)) || $perm == 'dashboard')
				{
					if  (!$header_written)
					{
						$section_hdr = lang('section_'.$section);
						if (empty($section_hdr))
						{
							$section_hdr = ucfirst(str_replace('_', ' ', $section));
						}
					//	echo "<div class=\"left_nav_section\" id=\"leftnav_".str_replace('/', '_', $section)."\">\n";
					//	echo "\t<h3>".$section_hdr."</h3>\n";
					//	echo "\t<ul>\n";
                    echo "<li class='has-sub'><a href='#'><span>".$section_hdr."</span></a><ul>
         ";
                     //  echo "<ul>"; 
					}
					echo "<li";
					if (preg_match('#^'.$nav_selected.'$#', $url))
					{
				//		echo ' class="active"';
					}
					// Use custom icons or default to key as class
					//$icon = isset($icons[$key]) ? $icons[$key] :  "ico_".url_title(str_replace('/', '_', $key),'_', TRUE);
					echo "><a href=\"".fuel_url($url)."\" ><span>".$val."</span></a></li>";
					$header_written = TRUE;
				} 
			}
		}
		else
		{
			$header_written = FALSE;
		}
	//	echo "</div>";
		if  ($header_written)
		{
			echo "</ul></li>";
		//	echo "</div>\n";
		}
		
	}
        
        
      
        
        
        
        
    	
?>
				
			<?php 
				$user_data = $this->fuel->auth->user_data();
				if (!empty($user_data['recent'])) : ?>
			
            <li class='has-sub'><a href='#'><span><?=lang('section_recently_viewed')?></span></a>
				
				<ul>
					<?php foreach($user_data['recent'] as $val) : ?>
					<li><a href="<?=site_url($val['l'])?>" title="<?=$val['n']?>"><?=$val['n']?></a></li>
					<?php endforeach; ?>
				</ul>
			</li>
			<?php endif; 
            
           echo "</ul></div>"; 
            ?>
  <!--<div id='cssmenu'>
<ul>
   <li class='active'><a href='#'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Products</span></a>
      <ul>
         <li><a href='#'><span>Product 1</span></a></li>
         <li><a href='#'><span>Product 2</span></a></li>
         <li class='last'><a href='#'><span>Product 3</span></a></li>
      </ul>
   </li>
   <li class='has-sub'><a href='#'><span>About</span></a>
      <ul>
         <li><a href='#'><span>Company</span></a></li>
         <li class='last'><a href='#'><span>Contact</span></a></li>
      </ul>
   </li>
   <li class='last'><a href='#'><span>Contact</span></a></li>
</ul>
</div>  -->
		</div>
	</div>
   
<script>
( function( $ ) {
$( document ).ready(function() {
$('#cssmenu > ul > li > a').click(function() {
  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active');	
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false;	
  }		
});
});
} )( jQuery );

</script>