<style>
div#fuel_main_content{
    top :22px;
}
.errorshow{
    color: red;
    font-size: 10px;
}
</style>
<?php //echo validation_errors(); 


?>
<form enctype="multipart/form-data"  method="post" action="<?php echo base_url();?>fuel/news/admin/edit/<?php echo $edit["id"];?>">	
<input type="hidden" name="id" value="<?php echo $edit["id"];?>">
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
	<td class="value">
    <input type="text" required="" size="40" maxlength="200" value="<?php echo $edit["name"]; ?>" id="title" name="title" >
    <?php echo form_error('title', '<div class="errorshow">', '</div>'); ?>
    
    </td>
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