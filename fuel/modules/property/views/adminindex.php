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
</style>

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
				<td><a class="reset" href="<?php echo base_url()?>fuel/property"></a></td>
				<td>
					<div class="search_input">
						<input type="search" placeholder="Search..." value="" id="search_term" name="search_term">
                    </div>
				</td>
				<td class="search"><input type="submit" value="Search" id="search" name="search"></td>
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
	<th width="15%">Name</th>
    <th width="15%">Photo</th>
	<th width="30%">Allot</th>
    <th width="30%">Diagrams Link</th>
    <th width="10%">Actions</th>
</tr>
</thead>
<tbody>


<?php

if(!empty($list)) 
{ 
    foreach($list as $key => $value)
    {
        $id=$value["id"]; 
   
?>
<tr class=" rowaction" id="data_table_row1">
	<td width="15%"><?php echo $value["name"]?></td>
    <td width="15%">
    <?php 
    if(!empty($imageslist[$id]))
    { 
       
        foreach($imageslist[$id] as $key => $imageslistdetail)
        {
         
          ?>  
         <img src="<?php echo base_url()."assets/upload/property/thumbs/".$imageslistdetail["imagename"];?>" style="width:150px;height:auto;">   
          <?php 
            break;
        } 
         
    }
    ?>
    
    </td>
    <td width="30%" style="text-align: left;"><?php 
    foreach($designation as $key => $designationdetail)
    { 
      ?>   
        <!--
        <a class="button grey" href="<?php base_url()?>property/admin/allotmember/<?php echo $designationdetail["id"]?>/<?php echo $value["id"]?>"><?php echo $designationdetail["name"]; ?></a>
        -->
        &nbsp; 
       <?php  echo anchor('fuel/property/admin/allotmember/'.$designationdetail["id"].'/'.$value["id"], $designationdetail["name"], array('class' => "button grey")); ?>
 
           <?php 
      
    }
    ?></td>
    <td width="30%" style="text-align: left;"><?php 
    //foreach($userlink as $key => $userlinkdetail)
    //{ 
      ?>   
       
        &nbsp; 
    <?php  echo anchor('fuel/property/admin/procedureslink/'.$value["id"],"Emergency Procedures Link", array('class' => "button grey")); ?>   
     <?php  echo anchor('fuel/property/admin/emediagram_index/'.$value["id"],"Emergency Diagrams Link", array('class' => "button grey")); ?>
     <?php  echo anchor('fuel/property/admin/warden_index/'.$value["id"],"ECO Wardens Link", array('class' => "button grey")); ?>
     <?php  echo anchor('fuel/property/admin/evacuationrpt_index/'.$value["id"],"Evacuation Reports", array('class' => "button grey")); ?> 
      <?php 
    //}
    ?></td>
    
    <td width="10%">
    
    <?php
     if($this->fuel->auth->has_permission('property/edit',"edit")==true)
         {
            //echo img_path("edit.png");
    echo anchor('fuel/property/admin/edit/'.$value["id"].'', '<img src="'.img_path('edit.png').'" width="17" alt="Edit" />', array('class' => 'action_edit'));
    
    }
    ?>
    
    &nbsp; |  &nbsp;
    <!--<a class="action_delete" href="<?php base_url()?>property/admin/delete/<?php echo $value["id"]?>">DELETE</a> -->
   <?php
     if($this->fuel->auth->has_permission('property/delete',"delete")==true)
         {
            
    echo anchor('fuel/property/admin/delete/'.$value["id"].'', '<img src="'.img_path('delete.png').'" width="17" alt="Delete" />', array('class' => 'action_delete', 'onclick'=>'return check_delete();'));
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

function check_delete()
{
     if (confirm("Are you sure you want to delete this record?") == true) {
         return true;
    } else {
         return false;
    }
}
</script>


<style>

.new{
width:80%;
margin:0 auto;

}

.new input {
  background: #12b3f2 none repeat scroll 0 0;
  color: white;
  font-size: 14px;
  padding: 12px;
  position: absolute;
  right: 28%;
  text-shadow: none;
}
.new textarea {
  font-size: 16px;
  font-weight: 500;
  line-height: 27px;
  text-align: justify;
}
.new  h1 {
  background: #000 none repeat scroll 0 0;
  border: medium solid;
  color: white;
  font-weight: 200;
  margin-left: 20%;
  padding: 12px;
  width: 30%;
}

</style>
 <div class="new">

<h1 style="text-align:center">Change Home Page Content</h1>

<form enctype="multipart/form-data"  method="post"  action="<?php echo base_url();?>save.php" >


<textarea cols="94" rows="5" style="height:200px" name="yourval" class="bi"><?php

//Open a new connection to the MySQL server
$user="act0786";
$host="localhost";
$password="hP+miybi6~Qr";
$database = "act0786";

$cxn = mysqli_connect($host,$user,$password,$database);
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

      
     
 
   $mysql_runa=mysqli_query($cxn, "SELECT `welcome_id`, `pera` FROM `fuel_welcome` WHERE welcome_id=1");
    
    while ($rows=mysqli_fetch_assoc($mysql_runa)) {
     // print_r($rows);



   echo $pera=$rows['pera'];
 
 }
?>
</textarea>

<br>
<br>
<input type="submit" value="Update" name="submitval"> 
</form>










</div>








