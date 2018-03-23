
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

<script language="javascript" type="text/javascript">
   	//this will move selected items from source list to destination list			
	function move_list_items(sourceid, destinationid)
	{
		$("#"+sourceid+"  option:selected").appendTo("#"+destinationid);
	}

	//this will move all selected items from source list to destination list
	function move_list_items_all(sourceid, destinationid)
	{
		$("#"+sourceid+" option").appendTo("#"+destinationid);
	}
    
</script>
<style type="text/css">
select {
	width:200px;
	height:143px !important;
    border:1px solid #ccc !important;  
}
#vTab tr td {
    height :36px !important;
}
#postfile {
  background-color: #fff;
  color: #3185b9;
  font-family: Arial,Helvetica,sans-serif;
  font-weight: normal;
  height: 28px;
  line-height: 24px;
  margin: 0;
  padding: 3px 5px 0 4px;
  width: 43px;
  cursor: pointer;
}
a.btn {
  border: 1px solid #ccc;
  height: 32px;
  line-height: 38px;
  padding: 5px;
  float:none;
  display: inline;
}
</style>
<form enctype="multipart/form-data"  method="post" action="<?php echo base_url();?>fuel/property/admin/evanrptallotmember/<?php echo $evanrptid?>/<?php echo $propertyid?>">
<input type="hidden" name="proid" value="<?php echo $propertyid?>">
<input type="hidden" name="evanrptid" value="<?php echo $evanrptid?>">		
	<div id="fuel_main_content">
    <div id="fuel_main_content_inner">
        <div id="form" class="">
        <table id="vTab" align="center" border="0" width="36%" style="margin: auto;">
                            				<tr>
                            					
                            					<td width="100%" style="font-size: 14px;color:#000;"><b>Allot (<?php echo $evacuationrptdetails["name"];?>) members to :  </b></td>
                                            </tr>    
                                            <tr>
                            					
                            					<td width="100%" >
                                                      <table cellpadding="5" cellspacing="5">
                            
                            <tbody>
                            
                            <tr>
                            
                                <td colspan="2" width="100%" style="padding-right:5px">
                                    <select id="from_select_list" multiple="multiple" name="from_select_list[]"> 
                                      <?php 
                                      foreach($freemember as $getuserid => $userdetail)
                                      {
                                      ?>
                                         <option value="<?php echo $userdetail["id"]?>"><?php echo $userdetail["name"]?></option>
                                         
                                     <?php
                                       }
                                     ?>
                                    </select>
                                </td>
                                <td colspan="2">
                                 <table width="100%">
                                    <tr>
                                        <td><input id="moveright" type="button" value="&nbsp;>&nbsp;" onclick="move_list_items('from_select_list','to_select_list');" /></td>
                                    </tr> 
                                    <tr>
                                        <td><input id="moverightall" type="button" value=">>" onclick="move_list_items_all('from_select_list','to_select_list');" /></td>        
                                    </tr>
                                    <tr>
                                        <td><input id="moveleft" type="button" value="&nbsp;<&nbsp;" onclick="move_list_items('to_select_list','from_select_list');" /></td>    
                                    </tr>
                                    <tr>
                                        <td><input id="moveleftall" type="button" value="<<" onclick="move_list_items_all('to_select_list','from_select_list');" /></td>    
                                    </tr>
                                 </table>
                                </td>
                                <td colspan="2" style="padding-left:5px">
                                    <select id="to_select_list" multiple="multiple" name="to_select_list[]"> 
                                              
                                            <?php
                                            /* 
                                         if(!empty($requestuser_emailarr))
                                         {   
                                              foreach($requestuser_emailarr as $getrequestuserid => $requestuseremail)
                                              { */
                                              ?>
                                                 
                                             <?php
                                            //   }
                                      // }
                                     ?>    
                                    </select>
                                </td>
                            
                            </tr>
                            <tr>

	<td colspan="5" style="text-align:center"><input type="submit" id="Save" class="submit" value="Allot" name="Allot"></td>
</tr>
                            </tbody>
                            
                            </table>
                    </td>
				</tr>
				 <tr><td colspan="2">
                  <table cellspacing="0" cellpadding="0" class="restable"  id="data_table">
                    <thead> 
                    <tr>
                    	<th width="50%">Name</th>
                        <th width="50%">Remove</th>
                    	
                    </tr>
                    </thead>
                    <tbody>
<?php
if(!empty($allotmember)) 
{ 
    foreach($allotmember as $key => $allotmemberdetail)
    {
      // $id=$value["id"]; 
?>
<tr class=" rowaction" id="data_table_row1">
	<td width="50%"><?php echo $allotmemberdetail["name"]?></td>
    	<td width="50%" style="text-align:center;">
        <?php 
        echo anchor('fuel/property/admin/evanrptfreemember/'.$allotmemberdetail["id"].'/'.$evanrptid.'/'.$propertyid.'', 'Remove', 'class="btn" ');
        ?>
         <!--<a class="btn" href="<?php base_url()?>property/admin/freemember/<?php echo $allotmemberdetail["id"]?>/<?php echo $evanrptid?>/<?php echo $propertyid?>">Free</a>&nbsp;-->
        </td>
  </tr>
<?php
  }

}

?>    
 </tbody>                    
                            </table>         </td></tr>
                 
              </table>   
</div>			
				</div>
		</form>