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
.colors{
    float: left;
    width:400px;
    margin-left: 0px;
    padding: 10px;
}
.colorleft{float: left;margin-left:10px;}
.colorright{float: right;margin-left:5px;}
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
                <?php  echo anchor('fuel/property/admin/evacuationrpt_create/'.$edit["id"],"Create", array('class' => "button green")); ?>   
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
      <th width="10%">Name</th>
      <th width="10%">Allocated Report To Member</th>
      <th width="10%">Download</th>
	  <th width="10%">Actions</th>
</tr>
</thead>
<tbody>
<?php
if(!empty($list)) 
{
 //  echo "<pre>";
  // print_r($list); 
  // exit; 
    foreach($list as $key => $value)
    {
       $id=$value["id"]; 
        $propertyid=$value["propertyid"]; 
       
?>
<tr class=" rowaction" id="data_table_row1">
	<td width="10%"><?php echo $value["name"]?></td>
    <td width="10%">
    <?php  echo anchor('fuel/property/admin/evanrptallotmember/'.$id.'/'.$propertyid, "Allot", array('class' => "button grey")); ?>
    </td>
    <td width="10%">&nbsp;
    <?php
    $filename_main=UPLOAD_ROOT_PATH."property/pdf/".$value["pdfname"];
                         if (file_exists($filename_main)) {
                             echo anchor('fuel/property/admin/downloadprolink/evarptpdf-'.$edit["id"]."-".$id.".pdf","Download", array('class' => "button grey"));  
                          }else
                         {
                            echo "--";
                         }
    ?>  
    
    </td>
    <td width="10%">
    <?php
     if($this->fuel->auth->has_permission('property/edit',"edit")==true)
         {
    echo anchor('fuel/property/admin/evacuationrpt_edit/'.$edit["id"].'/'.$value["id"].'', '<img src="'.img_path('edit.png').'" width="17" alt="Edit" />', array('class' => 'action_edit'));
    }
    ?>
    
    &nbsp; |  &nbsp;
    <!--<a class="action_delete" href="<?php base_url()?>property/admin/delete/<?php echo $value["id"]?>">DELETE</a> -->
   <?php
     if($this->fuel->auth->has_permission('property/delete',"delete")==true)
         {
       echo anchor('fuel/property/admin/evacuationrpt_delete/'.$edit["id"].'/'.$value["id"].'', '<img src="'.img_path('delete.png').'" width="17" alt="Delete" />', array('class' => 'action_delete'));
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