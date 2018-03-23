<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 	<title><?php if(!empty($page_title)) {echo $page_title;} ?></title>
	<meta name="keywords" content="<?php echo fuel_var('meta_keywords')?>">
	<meta name="description" content="<?php echo fuel_var('meta_description')?>">


	<?php
	

		echo css('stylesheet');
        	echo css('table');
        echo css('owl.carousel');
       echo js('jquery-1.10.2.min');  
       echo js('owl.carousel');
       echo js('jquery.fancybox');      
       echo css('jquery.fancybox'); 
	//	if (!empty($is_blog)):
	//		echo $CI->fuel_blog->header();
	//	endif;
    
	?>
	
</head>
<body>
<div class="top-header">
	<div class="container">
		<div class="header-left"><h3>BUILDING EMERGENCIES</h3><h3 class="red_text">RESPONSE PORTAL</h3>  
			<?php
			   if($this->fuel->auth->is_logged_in()==true)
				  {  
					?> 
					<!--<img src="<?php echo img_path("exit.png");?>" height="30" width="30" > -->
					<div class="logout"><a href="<?php echo base_url()?>member/logout" title="Logout" alt="Logout">Logout</a></div>
			<?php } 
			
			if(!isset($use_back_btn))
				{
					if($this->uri->rsegment(1)=="page_router"){$use_back_btn=0;}
				}// home page
		//	echo $this->uri->rsegment(3); exit;
           $getid=$this->uri->rsegment(3); 
			if(!empty($getid))
				{
				    
				?>
						<div class="tab-container">
                        <ul class="tabs">
                            <li><a href="<?php echo base_url()?>member/welcome">Home</a></li>
					 <li><a href="<?php echo base_url()?>member/downloadprolink/<?php echo $getid;?>/pdf-1-3.pdf">Emergency <br /> Procedures</a></li>
							<li ><a href="<?php echo base_url()?>member/diagram_link/<?php echo $getid;?>">Emergency <br /> Diagrams</a></li>
							<li class="active" ><a href="<?php echo base_url()?>member/wardens_link/<?php echo $getid;?>">ECO <br /> Wardens</a></li>
							<li class="last" ><a href="<?php echo base_url()?>member/evacuations_report/<?php echo $getid;?>">Evacuation <br /> Reports</a></li>
						</ul>
                        </div>
					<?php 
				}
			else
				{ ?>
					<!--	<ul class="topnavigation">
							<li ><a href="<?php echo base_url()?>member/procedures_link/1">Emergency Procedures</a></li>
							<li ><a href="<?php echo base_url()?>member/diagram_link/1">Emergency Diagrams</a></li>
							<li ><a href="<?php echo base_url()?>member/wardens_link/1">ECO Wardens</a></li>
							<li class="last"><a href="<?php echo base_url()?>member/evacuations_report/1">Evacuation Reports</a></li>
						</ul> -->
			<?php } ?>
		</div>

		<div class="header-right">
			<?php
			   if($this->fuel->auth->is_logged_in()==true)
					{?><a href="<?php echo base_url(); ?>member/welcome"><img src="<?php echo img_path("logo.png");?>"></a><?php }
				else
					{ ?><a href="<?php echo base_url()?>"><img src="<?php echo img_path("logo.png");?>"></a> <?php }
			?>
		</div>
	 </div>
</div>
<div class="clear"></div>
<?php
  //echo "<pre>";
  //print_r($prolinks);
  
  //print_r($protransids);
  //exit;
?>
<style>
.btn{
margin-right: 8px;}
/*.top-header .header-left ul.topnavigation { display: none;}*/

</style>
<?php
  $color_arr=array(1=>"orange",2=>"red",3=>"green");
?>
<div class="container">
    <div class="emergency">
            <h3>Eco Wardens Links</h3>
       </div>
  <div class="colors">
          <div class="colorleft"><div class="circle" ><img src="<?php echo img_path("orange.png");?>" width="17" height="17"></div>
          <div class="colorright"> Default</div></div>
          <div class="colorleft">
          <div class="circle" ><img src="<?php echo img_path("red.png");?>" width="17" height="17"></div>
                    <div class="colorright"> Training not completed </div></div>
          <div class="colorleft">
          <div class="circle" ><img src="<?php echo img_path("green.png");?>" width="17" height="17"></div>
          <div class="colorright">Attended and Completed</div></div>
      </div>
      
<table cellspacing="0" cellpadding="0" class="restable"  id="data_table">
<thead> 
<tr>
<th width="10%">First Name</th>
    <th width="10%">Family Name</th>
	<th width="10%">Eco Position</th>
    <th width="10%">Location</th>
    <th width="10%">Contact Details</th>
    <th width="10%">Evacuation Training</th>
    <th width="10%">Trial Evacuation</th>
    <th width="10%"> Other Training (Fire, Bomb, Spills etc.) </th>
    
</tr>
</thead>
<tbody>    

<?php
   $dbhost = 'localhost';
   $dbuser = 'act0786';
   $dbpass = 'hP+miybi6~Qr';
   
   $conn = mysql_connect($dbhost, $dbuser, $dbpass);
   
   if(! $conn )
   {
      die('Could not connect: ' . mysql_error());
   }
   //echo $getid;
   
//propertyid
   $sql = 'SELECT * FROM fuel_wardens where propertyid="'.$getid.'"';
   mysql_select_db('act0786');
   $retval = mysql_query( $sql, $conn );
   
   if(! $retval )
   {
      die('Could not get data: ' . mysql_error());
   }
   
   while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
   {
	   $check_id=$row['id'];
	   
    /*  echo
 "EMP ID :{$row['id']}  <br> ".
         "EMP NAME : {$row['firstname']} <br> ".
         "EMP SALARY : {$row['propertyid']} <br> ".
         "--------------------------------<br>";
		 
		 */
		 ?>
		 
		 <tr class=" rowaction" id="data_table_row1">
 <td width="10%"><?php echo $row['firstname']; ?></td>
    <td width="10%">&nbsp;<?php echo $row['familyname']; ?></td>
    <td width="10%">&nbsp;<?php echo $row["ecoposition"];?></td>
    <td width="10%">&nbsp;<?php echo $row["location"];?></td>
    <td width="10%">&nbsp;<?php echo $row["contactdetails"];?></td>
    <td width="10%" style="text-align:center">&nbsp;<?php  $firedate=$row["firedate"];?>
   
      <img src="<?php echo img_path("".$color_arr[$firedate].".png");?>" width="17" height="17">
    
    </td>
    <td width="10%" style="text-align:center">&nbsp;<?php $evacuation=$row["evacuation"]?>
    
     <img src="<?php echo img_path("".$color_arr[$evacuation].".png");?>" width="17" height="17">
    </td>
    <td width="10%" style="text-align:center">&nbsp;<?php  $trialevacuation=$row["trialevacuation"];?>
    
    <img src="<?php echo img_path("".$color_arr[$trialevacuation].".png");?>" width="17" height="17">
    </td>
    
</tr>


		 <?php 
		/* echo '<pre>';
		 print_r($row);
  echo '</pre>'; 
   */
   }
  
  

if(empty($check_id)) 
{ 
    //foreach($list as $key => $value)
    //{
    // $id=$value["id"]; 
      ?>
 <tr class=" rowaction" id="data_table_row1">
   <td width="100%" colspan="8" style="text-align:center" class="norecord">No record found</td>
 </tr>    
    <?php   

  }
?>
</tbody>
</table>
<?php 
 mysql_close($conn); 
 ?>
</div>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<?php $this->load->view('_blocks/footer')?>