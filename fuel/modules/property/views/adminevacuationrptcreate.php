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
<form enctype="multipart/form-data"  method="post" action="<?php echo base_url();?>fuel/property/admin/evacuationrpt_create/<?php echo $edit["id"];?>">	
<input type="hidden"  name="propertyid" value="<?php echo $edit["id"];?>">
		<div id="fuel_main_content">
 <div id="fuel_main_content_inner">

		<p class="instructions">Here you can manage the Evacuation Report for your site.</p>
	
	<div id="form" class="form">
<table>
<tbody>
<tr>
	<td class="label"><label id="label_title" for="title">name<span class="required">*</span></label></td>
	<td class="value"><input type="text" required="" size="40" maxlength="200" value="<?php echo $name;?>" id="name" name="name">
    <?php echo form_error('name', '<div class="errorshow">', '</div>'); ?>
    
    </td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Upload Pdf</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="file" class="span6" value=""   name="uppdf" id="uppdf">
    <?php
     if(!empty($error_file))
     {
        echo '<div class="errorshow">'.$error_file.'</div>';
     }
    ?>
</td>
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