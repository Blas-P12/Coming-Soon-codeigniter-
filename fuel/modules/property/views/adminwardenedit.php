<style>
div#fuel_main_content{
    top :22px;
}
</style>
<?php //echo validation_errors();
 //echo "<pre>";
 //print_r($wardensdetails);
 //exit;
 ?>
<form enctype="multipart/form-data"  method="post" action="<?php echo base_url();?>fuel/property/admin/warden_edit/<?php echo $edit["id"]."/".$wardensdetails["id"];?>">
<input type="hidden" name="propertyid" value="<?php echo $edit["id"];?>">	
<input type="hidden" name="id" value="<?php echo $wardensdetails["id"];?>">

		<div id="fuel_main_content">
			
			
			<!-- BODY -->
			<!-- RELATED ITEMS -->

<!-- NOTIFICATION EXTRA -->
<div class="notification" id="notification_extra">
	</div>

<!-- WARNING WINDOW -->


<div id="fuel_main_content_inner">

		<p class="instructions">Here you can manage the Warden list Link for your site.</p>
	
	<div id="form" class="form">
<table>
<tbody>
<tr>
	<td class="label"><label id="label_title" for="title">First Name<span class="required">*</span></label></td>
	<td class="value"><input type="text" required="" size="40" maxlength="200" value="<?php echo $wardensdetails["firstname"];?>" id="name" name="firstname">
    <?php echo form_error('firstname', '<div class="errorshow">', '</div>'); ?>
    
    </td>
</tr>
 
<tr>
	<td class="label"><label id="label_slug" for="slug">Family name</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text" size="40" class="span6" value="<?php echo $wardensdetails["familyname"];?>" name="familyname" id="familyname">
</td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Eco position</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text"  size="40" maxlength="100" class="linked" value="<?php echo $wardensdetails["ecoposition"];?>" id="ecoposition" name="ecoposition"></td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Location</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text"  size="40" maxlength="100" class="linked" value="<?php echo $wardensdetails["location"];?>" id="location" name="location"></td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Contact details</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="text"  size="40" maxlength="100" class="linked" value="<?php echo $wardensdetails["contactdetails"];?>" id="contactdetails" name="contactdetails"></td>
</tr>

<?php
  $firedate_arr=array(1=>"Orange",2=>"Red",3=>"Green");
?>
<tr>
	<td class="label"><label id="label_slug" for="slug">Fire date</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    
    <select name="firedate">
      <?php
        foreach($firedate_arr as $key => $value)
        {
            if($key==$wardensdetails["contactdetails"])
            {
                $fir_sel="selected";
            }else
            {
                $fir_sel="";
            }
      ?>
        <option <?php echo $fir_sel; ?> value="<?php echo $key;?>"><?php echo $value;?></option>
      
      <?php
      }
      ?>
    </select>
     <div class="colorscreate">
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
    </td>
</tr>

<tr>
	<td class="label"><label id="label_slug" for="slug">Evacuation</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <select name="evacuation">
      <?php
        foreach($firedate_arr as $key => $value)
        {
             if($key==$wardensdetails["evacuation"])
            {
                $eva_sel="selected";
            }else
            {
                $eva_sel="";
            }
      ?>
        <option <?php echo $eva_sel;?> value="<?php echo $key;?>"><?php echo $value;?></option>
      
      <?php
      }
      ?>
    </select>
     <div class="colorscreate">
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
    </td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Trial Evacuation</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
     <select name="trialevacuation">
      <?php
        foreach($firedate_arr as $key => $value)
        {
            if($key==$wardensdetails["trialevacuation"])
            {
                $trialeva_sel="selected";
            }else
            {
                $trialeva_sel="";
            }
      ?>
        <option <?php echo $trialeva_sel; ?> value="<?php echo $key;?>"><?php echo $value;?></option>
      
      <?php
      }
      ?>
    </select>
     <div class="colorscreate">
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
    </td>
</tr>
<tr>
	<td class="label"><label id="label_slug" for="slug">Upload Sheets</label></td>
	<td class="value"><div style="display: none;" class="linked_info">"title"</div>
    <input type="file" class="span6" value=""   name="sheets" id="sheets">
    <?php
     if(!empty($error_file))
     {
        echo '<div class="errorshow">'.$error_file.'</div>';
     }
     
     if(!empty($wardensdetails["attendsheet"]))
     {
       // echo "File Uploaded";
      ?>
       <div class="removeimg" >
          <div>
             <img width="100px" src="<?php echo base_url()."assets/upload/property/attend/".$wardensdetails["attendsheet"];?>">
          </div>
          <div>
            <!--<div class="removebtn" onclick="return deletepropertyimage('<?php echo $proimagesdetail["id"];?>');">Remove</div> -->
          </div>
       </div>
      <?php  
     }else
     {
        echo "File not uploaded";
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
<?php
 $color_arr=array(1=>"red",2=>"orange",3=>"green");
?>

<tr>
	<td class="required" colspan="2"><span class="required">*</span> required fields</td>
    
</tr>
</tbody>
</table>
</div>			
				</div>
		</form>