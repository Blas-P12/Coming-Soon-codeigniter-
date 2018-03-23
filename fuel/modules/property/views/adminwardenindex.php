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
</style>
<?php
  $color_arr=array(1=>"orange",2=>"red",3=>"green");
?>
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
                <?php  echo anchor('fuel/property/admin/warden_create/'.$edit["id"],"Create", array('class' => "button green")); ?>   
                </td>
				<td class="show">&nbsp; 
                </td>
			</tr>
		</tbody>
	</table>
 </form>   
</div>
<div id="data_table_container">
<div class="colors">
          <div class="colorleft"><div class="circle" ><img src="<?php echo img_path("orange.png");?>" width="17" height="17"></div>
          <div class="colorright"> Default</div></div>
          <div class="colorleft">
          <div class="circle" >
          <img src="<?php echo img_path("red.png");?>" width="17" height="17">
          </div>
                    <div class="colorright"> Training not completed </div></div>
          <div class="colorleft">
          <div class="circle" id="green">
          <img src="<?php echo img_path("green.png");?>" width="17" height="17">
          </div>
          <div class="colorright">Attended and Completed</div></div>
      </div>
<table cellspacing="0" cellpadding="0" class="restable"  id="data_table">
<thead> 
<tr>
<th width="10%">First Name</th>
    <th width="10%">Family Name</th>
	<th width="10%">Eco Position</th>
    <th width="10%">Location</th>
    <th width="10%">Contact details</th>
    <th width="10%">Warden Evacuation Training</th>
    <th width="10%">Trial Evacuation</th>
    <th width="10%">Warden Training</th>
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
<tr class=" rowaction" id="data_table_row1">
	<td width="10%"><?php echo $value["firstname"]?></td>
    <td width="10%">&nbsp;<?php echo $value["familyname"]?></td>
    <td width="10%">&nbsp;<?php echo $value["ecoposition"]?></td>
    <td width="10%">&nbsp;<?php echo $value["location"]?></td>
    <td width="10%">&nbsp;<?php echo $value["contactdetails"]?></td>
    <td width="10%" style="text-align:center">&nbsp;<?php  $firedate=$value["firedate"]?>
       
       <img src="<?php echo img_path("".$color_arr[$firedate].".png");?>" width="17" height="17">
       
    </td>
    <td width="10%" style="text-align:center">&nbsp;<?php $evacuation=$value["evacuation"]?>
     <img src="<?php echo img_path("".$color_arr[$evacuation].".png");?>" width="17" height="17">
    </td>
    <td width="10%" style="text-align:center">&nbsp;<?php  $trialevacuation=$value["trialevacuation"]?>
      <img src="<?php echo img_path("".$color_arr[$trialevacuation].".png");?>" width="17" height="17">
    </td>
    <td width="10%">
    <?php
     if($this->fuel->auth->has_permission('property/edit',"edit")==true)
         {
    echo anchor('fuel/property/admin/warden_edit/'.$edit["id"].'/'.$value["id"].'', '<img src="'.img_path('edit.png').'" width="17" alt="Edit" />', array('class' => 'action_edit'));
    }
    ?>
    
    &nbsp; |  &nbsp;
    <!--<a class="action_delete" href="<?php base_url()?>property/admin/delete/<?php echo $value["id"]?>">DELETE</a> -->
   <?php
     if($this->fuel->auth->has_permission('property/delete',"delete")==true)
         {
       echo anchor('fuel/property/admin/warden_delete/'.$edit["id"].'/'.$value["id"].'', '<img src="'.img_path('delete.png').'" width="17" alt="Delete" />', array('class' => 'action_delete'));
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