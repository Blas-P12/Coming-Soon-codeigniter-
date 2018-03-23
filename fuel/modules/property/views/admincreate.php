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
<form enctype="multipart/form-data"  method="post" action="<?php echo base_url();?>fuel/property/admin/create">	
<!-- NOTIFICATION PANEL -->
		<div class="notification" id="fuel_notification">
							<script type="text/javascript">
// &lt;![CDATA[
try { $(function(){ $('.error_highlight input:first').focus(); }); } catch(e){};
// ]]&gt;
</script>
</div>
				
		
				
		
		<div id="fuel_main_content">
			
			
			<!-- BODY -->
			<!-- RELATED ITEMS -->

<!-- NOTIFICATION EXTRA -->
<div class="notification" id="notification_extra">
	</div>

<!-- WARNING WINDOW -->


<div id="fuel_main_content_inner">

		<p class="instructions">Here you can manage the Property Records for your site.</p>
	
	<div id="form" class="form">
<table>
<tbody>
<tr>
	<td class="label"><label id="label_title" for="title">Building name<span class="required">*</span></label></td>
	<td class="value"><input type="text" required="" size="40" maxlength="200" value="" id="name" name="name">
    <?php echo form_error('name', '<div class="errorshow">', '</div>'); ?>
    
    </td>
</tr>

<tr>
	<td class="label"><label id="label_slug" for="slug">Building Image</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="file" class="span6" value="" multiple="multiple"  name="photos[]" id="photo_1">
</td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Building Sitemap</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="file" class="span6" value=""   name="sitephotos" id="sitephoto_1">
</td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Country</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text" class="span6" value="" size="40"  name="country" id="country">
</td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">State</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text" class="span6" value="" size="40"  name="state" id="state">
</td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">City</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text" class="span6" value="" size="40"  name="city" id="city">
</td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Address</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <textarea cols="38" rows="3" name="address"></textarea>
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