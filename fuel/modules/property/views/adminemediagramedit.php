<style>
div#fuel_main_content{
    top :22px;
}
.errorshow{
    color: red;
    font-size: 10px;
}
.removeimg {
  float: left;
  margin-left: 5px;
  width: 31% !important;
}
</style>
<?php //echo validation_errors(); ?>
<?php
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
<form enctype="multipart/form-data"  method="post" action="<?php echo base_url();?>fuel/property/admin/emediagram_edit/<?php echo $edit["id"];?>">
<input type="hidden" name="propertyid" value="<?php echo $propertyid;?>">	
<input type="hidden" name="id" value="<?php echo $edit["id"];?>">
		<div id="fuel_main_content">
			
			
			<!-- BODY -->
			<!-- RELATED ITEMS -->

<!-- NOTIFICATION EXTRA -->
<div class="notification" id="notification_extra">
	</div>

<!-- WARNING WINDOW -->


<div id="fuel_main_content_inner">

		<p class="instructions">Here you can manage the Property Emergency Diagrams Link for your site.</p>
	
	<div id="form" class="form">
<table>
<tbody>
<tr>
	<td class="label"><label id="label_title" for="title">Name<span class="required">*</span></label></td>
	<td class="value"><input type="text" required="" size="40" maxlength="200" value="<?php echo $edit["name"];?>" id="name" name="name">
    <?php echo form_error('name', '<div class="errorshow">', '</div>'); ?>
    
    </td>
</tr>
<?php
 if(!empty($proimages))
  {
  /*echo"<pre>";
  print_r($proimages);*/
  ?>
  <tr>
    <td colspan="2">
      <?php
      foreach($proimages as $key => $proimagesdetail)
      {
	  	$ext = explode(".",strtolower($proimagesdetail["imagename"]));
		$ext = end($ext);
      ?>
       <div class="removeimg" id="imageid_<?php echo $proimagesdetail["id"];?>">
          <div>
		  	<?php
			if(($ext=="png") || ($ext=="jpg") || ($ext=="jpeg") || ($ext=="gif") ){ ?>
			<img src="<?php echo base_url()."assets/upload/property/thumbs/".$proimagesdetail["imagename"];?>" width="100px" height="100px">
<?php }
			else
				{ ?><img src="<?php echo base_url();?>assets/upload/property/pdf_icon.jpg"><?php }
			?>
             
          </div>
          <div>
            <div class="removebtn" onclick="return deletepropertyimage('<?php echo $proimagesdetail["id"];?>');">Remove</div>
          </div>
       </div>
     <?php
      }
     ?>  
    </td>
  </tr>
<?php
}
?>
<tr>
	<td class="label"><label id="label_slug" for="slug">Image</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="file" class="span6" value="" multiple="multiple"  name="photos[]" id="photo_1">
</td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Order</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text"  size="40" maxlength="100" class="linked" value="<?php echo $edit["order"];?>" id="order" name="order"></td>
</tr>
<tr>
	<td></td>
	<td class="actions"><div class="actions_inner">
    <input type="button" class="cancel" value="Cancel" id="Cancel" name="Cancel">
    <input type="submit" id="Save" class="submit" value="Save" name="Save"></div></td>
</tr>
<tr>
	<td class="required" colspan="2"><span class="required">*</span> required fields</td>
</tr>
</tbody>
</table>
</div>			
				</div>
		</form>
<script>
  function deletepropertyimage(deleteid)
 {
 var path = jqx.config.fuelPath + '/fuel/property/admin/deletepropertyimage/'
                    $.ajax({
                    
                  //  dataType: 'JSON',
                    type: 'POST',
                    cache: false,
                    url:  '<?php echo base_url();?>fuel/property/admin/emediagram_ajaxdelete',
                    data : {
                    deleteid : deleteid,
                  
                    },
                    success: function(data){
                    //$("#postlist").html(data);		 
                   //alert(data);
                    if(data>0)
                    {
                     
                     $("#imageid_"+data).remove(); 
                       
                    }
                    return false;
                    },error: function(jqXHR, textStatus, errorThrown){
                    alert(textStatus, errorThrown);
                          }
                    });  
                    
                 
                
    return false;
 }
</script>          