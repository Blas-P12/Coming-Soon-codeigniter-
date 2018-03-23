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
<form enctype="multipart/form-data"  method="post" action="<?php echo base_url();?>fuel/news/admin/create">	
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

		<p class="instructions">Here you can manage the News Records for your site.</p>
	
	<div id="form" class="form">
<table>
<tbody>
<tr>
	<td class="label"><label id="label_title" for="title">Title<span class="required">*</span></label></td>
	<td class="value"><input type="text" required="" size="40" maxlength="200" value="" id="title" name="title">
    <?php echo form_error('serialno', '<div class="errorshow">', '</div>'); ?>
    
    </td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Slug<span class="required">*</span></label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
<input type="text" required="" size="40" maxlength="100" class="linked" value="" id="slug" name="slug"></td>
</tr>
<tr>
	<td class="label">Published</td>
	<td class="value"><span class="multi_field"><input type="radio" value="yes" id="published_yes" name="published"> <label id="label_published_yes" for="published_yes">yes</label>&nbsp;&nbsp;&nbsp;</span><span class="multi_field"><input type="radio" checked="checked" value="no" id="published_no" name="published"> <label id="label_published_no" for="published_no">no</label>&nbsp;&nbsp;&nbsp;</span></td>
</tr>
<tr>
	<td></td>
	<td class="actions"><div class="actions_inner"><input type="button" class="cancel" value="Cancel" id="Cancel" name="Cancel"><input type="submit" id="Save" class="submit" value="Save" name="Save"></div></td>
</tr>
<tr>
	<td class="required" colspan="2"><span class="required">*</span> required fields</td>
</tr>
</tbody>
</table>
</div>			
				</div>
		</form>