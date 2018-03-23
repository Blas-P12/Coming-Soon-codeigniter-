<?

///echo "<pre>";
//print_r($list);

$msg="";
 $msg=$this->session->userdata('msg'); 
//echo "<pre>";
//print_r($this->session->all_userdata());
if(!empty($msg))
{
    echo $msg;
    $this->session->unset_userdata('msg');
}

?>

<div id="list_container">
<div id="data_table_container">
<table cellspacing="0" cellpadding="0" class="data" id="data_table">
<thead>
<tr>
	<th class="col1 asc on">
Title</th>
	<th class="col5">
<span>&nbsp;</span></th>
</tr>
</thead>
<tbody>
<?php
if(!empty($list))
{
    foreach($list as $key => $value)
    {
?>
<tr class=" rowaction" id="data_table_row1">
	<td class="col1 first"><?php echo $value["name"]?></td>
	<td class="col5 actions">
    <a class="action_edit" href="<?php base_url()?>news/admin/edit/<?php echo $value["id"]?>">EDIT</a>
    &nbsp; |  &nbsp;<a class="action_delete" href="<?php base_url()?>news/admin/delete/<?php echo $value["id"]?>">DELETE</a>
     <input type="checkbox" class="multi_delete" id="delete_<?php echo $value["id"]?>" value="<?php echo $value["id"]?>" name="delete[<?php echo $value["id"]?>]"> 
     </td>
</tr>
<?php
  }
}
?>
</tbody>
</table>

</div>
</div>