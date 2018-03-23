<style>
div#fuel_main_content{
    top :22px;
}
.errorshow{
    color: red;
    font-size: 10px;
}
</style>
<?php //echo validation_errors(); ?>
<form enctype="multipart/form-data"  method="post" action="<?php echo base_url();?>fuel/property/admin/emediagram_create/<?php echo $edit["id"];?>">
<input type="hidden" name="propertyid" value="<?php echo $edit["id"];?>">	
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
	<td class="value"><input type="text" required="" size="40" maxlength="200" value="" id="name" name="name">
    <?php echo form_error('name', '<div class="errorshow">', '</div>'); ?>
    
    </td>
</tr>

<tr>
	<td class="label"><label id="label_slug" for="slug">Image</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="file" class="span6" value="" multiple="multiple"  name="photos[]" id="photo_1">
</td>
</tr>
<tr>
    <td colspan="2" align="center">
      <div class="errorshow">Upload file size should be less than 1000kb.</div>
    </td>
</tr> 
<tr>
	<td class="label"><label id="label_slug" for="slug">Order</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text"  size="40" maxlength="100" class="linked" value="" id="order" name="order"></td>
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