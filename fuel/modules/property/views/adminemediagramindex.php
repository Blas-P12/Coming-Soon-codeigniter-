<?php

///echo "<pre>";
//print_r($list);

$msg="";
 $msg=$this->session->userdata('msg'); 
//echo "<pre>";
//print_r($this->session->all_userdata());
if(!empty($msg))
{
 ?>
 <style>
  #fuel_notification{display: block;}
 </style> 
 <div class="notification" id="fuel_notification">
    <div class="success ico ico_success" style="background-color: rgb(220, 255, 184);"><?php echo $msg;?></div>
  </div>  
   
<?php    $this->session->unset_userdata('msg');
}

?>
<style>
.btn{
margin-right: 8px;}
.imageproperty
{
	width:100px;
	height:100px;
	
}
</style>

<div id="list_container">
<div class="searchcontent">
<form enctype="multipart/form-data"  method="post"  action="<?php echo base_url()?>fuel/property" >
<table cellspacing="0" cellpadding="0" border="0">
		<tbody>
			<tr>
			<td>
			     <div id="form" class="more_filters">
                    <div>
                        <div class="actions"><div class="actions_inner"></div></div>
                        </div>
                        </div>
            </td>
				<td class="search">
                <?php  echo anchor('fuel/property/admin/emediagram_create/'.$edit["id"],"Create", array('class' => "button green")); ?>   
                </td>
				<td class="show">&nbsp; 
                </td>
			</tr>
		</tbody>
	</table>
 </form>   
</div>
<div id="data_table_container">
<table cellspacing="0" cellpadding="0" class="restable"  id="data_table">
<thead> 
<tr>
	<th width="15%">Name</th>
    <th width="15%">Images</th>
	<th width="30%">Order</th>
    <th width="10%">Actions</th>
</tr>
</thead>
<tbody> 
<?php
if(!empty($list)) 
{ 
    foreach($list as $key => $value)
    {
       $id=$value["id"]; 
?>
<tr class=" rowaction" id="data_table_row1" >
	<td width="15%"><?php echo $value["name"]?></td>
    <td width="15%">
    <?php 
    if(!empty($imageslist[$id]))
    { 
       
        foreach($imageslist[$id] as $key => $imageslistdetail)
        {
         
          ?>  
<img src="<?php echo base_url()."assets/upload/property/thumbs/".$imageslistdetail["imagename"];?>" class="imageproperty">   
          <?php 
            break;
        } 
         
    }
    ?>
    
    </td>
    
    <td width="15%"><?php echo $value["order"]?></td>
    
    <td width="10%">
    
    <?php
     if($this->fuel->auth->has_permission('property/edit',"edit")==true)
         {
    echo anchor('fuel/property/admin/emediagram_edit/'.$edit["id"].'/'.$value["id"].'', '<img src="'.img_path('edit.png').'" width="17" alt="Edit" />', array('class' => 'action_edit'));
    }
    ?>
    
    &nbsp; |  &nbsp;
    <!--<a class="action_delete" href="<?php base_url()?>property/admin/delete/<?php echo $value["id"]?>">DELETE</a> -->
   <?php
     if($this->fuel->auth->has_permission('property/delete',"delete")==true)
         {
       echo anchor('fuel/property/admin/emediagram_delete/'.$edit["id"].'/'.$value["id"].'', '<img src="'.img_path('delete.png').'" width="17" alt="Delete" />', array('class' => 'action_delete'));
    }
    ?> 
     <!--<input type="checkbox" class="multi_delete" id="delete_<?php echo $value["id"]?>" value="<?php echo $value["id"]?>" name="delete[<?php echo $value["id"]?>]"> --> 
     </td>
</tr>
<?php
  }
}else
{
    ?>
     
    <?php
}
?>
</tbody>
</table>
 <div class="pagination">
<?php
    echo $this->pagination->create_links();
    ?>
</div> 
</div>
   
</div>
<script>
$( window ).load(function() {
// Run code
$(".pagination a").each(function() {
   
    if($(this).text()==1)
    {
         $(this).attr("href",'<?php echo base_url()?>fuel/property');
    }
   
    if($(this).attr("href")=='<?php echo base_url()?>fuel/property/admin/items/')
    {
      $(this).attr("href",'<?php echo base_url()?>fuel/property');   
    }
});

});
</script>