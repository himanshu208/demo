<?php
//SESSION CONFIGURATION
$check_array_in="admission";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 
require_once '../connection.php';

//fetch section

if(!empty($_REQUEST['class_id']))
{
   
    echo "<option value='0'>---Select---</option>";
    $class_id=$_REQUEST['class_id'];
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$class_id' and is_delete='none'");
    while ($fetch_class_data=mysql_fetch_array($section_db))
    {
        $fetch_section_id=$fetch_class_data['section_id'];
        $fetch_section_name=$fetch_class_data['section_name'];
        
        echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
    }
    
    if(empty($fetch_section_id))
    {
        echo "<option value='0'>Record no found !!</option>";
    }
    
}



//fetch_route

if((!empty($_REQUEST['route_id'])))
{
 
 $route_id=$_REQUEST['route_id'];
 echo "<div id='vehicle_type_data'>
<option value='0'>-- Select vehicle type --</option>"; 
 
 $old_array=array();
 $route_allot_id=array();
 $allocate_transport_route_db=mysql_query("SELECT * FROM transport_allocate_route_db WHERE $db_main_details"
         . " route_id='$route_id' and is_delete='none'");
 while ($fetch_allocate_transport_route_data=mysql_fetch_array($allocate_transport_route_db))
 {
  $route_allot_unique_id=$fetch_allocate_transport_route_data['allocate_vehicle_route_id'];
  $fetch_vehicle_type_id=$fetch_allocate_transport_route_data['vehicle_type_id'];
   $search_match=in_array($fetch_vehicle_type_id, $old_array);
   if($search_match==false)
   {
       array_push($old_array,$fetch_vehicle_type_id); 
   }
   $search_id_match=in_array($route_allot_unique_id,$route_allot_id);
   if($search_id_match==false)
   {
      array_push($route_allot_id,$route_allot_unique_id);   
   }
   
  }
   
  foreach ($old_array as $vehicle_type_id)
  {
     $vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE $db_main_details"
             . " vehicle_type_id='$vehicle_type_id' and is_delete='none'");
    $fetch_vehicle_type_data=mysql_fetch_array($vehicle_type_db);
    $fetch_vehicle_num_rows=mysql_num_rows($vehicle_type_db);
    if((!empty($fetch_vehicle_type_data))&&($fetch_vehicle_type_data!=null)&&($fetch_vehicle_num_rows!=0))
    {
        $vehicle_type_name=$fetch_vehicle_type_data['vehicle_type'];
       echo "<option value='$vehicle_type_id'>$vehicle_type_name</option>"; 
    }
         
  }
  echo "</div>";
 
  echo "<div id='sub_route_record'>";
  echo "<option value='0'>-- Select Sub Route --</option>";
  foreach ($route_allot_id as $route_allocate_id)
  {
      
  $sub_route_db=mysql_query("SELECT * FROM transport_sub_route_db WHERE $db_main_details "
          . "route_allot_id='$route_allocate_id' and is_delete='none'");
  $fetch_sub_route_num_rows=mysql_num_rows($sub_route_db);
  while ($fetch_sub_route_data=mysql_fetch_array($sub_route_db))
  {
   $sub_route_id=$fetch_sub_route_data['sub_route_unique_id'];  
   $fetch_sub_route_name=$fetch_sub_route_data['sub_route'];  
   echo "<option value='$sub_route_id'>$fetch_sub_route_name</option>";
  
  }
  }
  echo "</div>";
 
 
}



if((!empty($_REQUEST['vehicel_type_route_id']))&&(!empty($_REQUEST['vehicle_type_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
 $organization_id=$_REQUEST['org_id'];
 $route_id=$_REQUEST['vehicel_type_route_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $vehicle_type_id=$_REQUEST['vehicle_type_id'];
 
 echo "<option value='0'>---Select vehicle---</option>";
 $allocate_transport_route_db=mysql_query("SELECT * FROM transport_allocate_route_db WHERE $db_main_details route_id='$route_id'"
         . " and vehicle_type_id='$vehicle_type_id' and is_delete='none'");
 while ($fetch_allocate_transport_route_data=mysql_fetch_array($allocate_transport_route_db))
 {
 
  $fetch_vehicle_id=$fetch_allocate_transport_route_data['vehicle_id'];
  
  $vehicle_db=mysql_query("SELECT * FROM transport_vehicle_db WHERE $db_main_details vehicle_id='$fetch_vehicle_id'"
          . " and vehicle_type_id='$vehicle_type_id' and is_delete='none'");
  $fetch_vehicle_data=mysql_fetch_array($vehicle_db);
  $fetch_vehicle_num_rows=mysql_num_rows($vehicle_db);
  
  if((!empty($fetch_vehicle_data))&&($fetch_vehicle_data!=null)&&($fetch_vehicle_num_rows!=0))
  {
      
    $fetch_vehicle_id=$fetch_vehicle_data['vehicle_id'];
    $fetch_vehicle_name=$fetch_vehicle_data['vehicle_registration_no'];
      
      
      echo "<option value='$fetch_vehicle_id'>$fetch_vehicle_name</option>";   
  }
  
  
  
  
  }   
}


//hostel

if(!empty($_REQUEST['hostel_id']))
{
   
    echo "<option value='0'>---Select Room---</option>";
    $hostel_id=$_REQUEST['hostel_id'];
    $hostel_db=mysql_query("SELECT * FROM hostel_room_db WHERE $db_main_details hostel_id='$hostel_id' and is_delete='none'");
    while ($fetch_class_data=mysql_fetch_array($hostel_db))
    {
        $fetch_hostel_id=$fetch_class_data['room_unique_id'];
        $fetch_hostel_name=$fetch_class_data['room_no'];
        
        echo "<option value='$fetch_hostel_id'>$fetch_hostel_name { Availability : 0 }</option>";
    }
    
    if(empty($fetch_hostel_id))
    {
        echo "<option value='0'>Record no found !!</option>";
    }
    
}
?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>