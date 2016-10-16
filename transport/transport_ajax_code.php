<?php 
require_once '../connection.php';
//route to vehicle type

if((!empty($_REQUEST['route_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
  $organization_id=$_REQUEST['org_id'];
  $branch_id=$_REQUEST['branch_id'];
  $session_id=$_REQUEST['session_id'];
  $route_id=$_REQUEST['route_id'];
   echo "<div id='sub_route_record'>";
  $route_db=  mysql_query("SELECT * FROM transport_route_db WHERE organization_id='$organization_id' and branch_id='$branch_id'
      and session_id='$session_id' and route_id='$route_id' and is_delete='none'");
  $fetch_route_data=  mysql_fetch_array($route_db);
  $fetch_route_num_rows=  mysql_num_rows($route_db);
  if((!empty($fetch_route_data))&&($fetch_route_data!=null)&&($fetch_route_num_rows!=0))
  {
   $fetch_sub_route_name=$fetch_route_data['sub_route_name'];  
   echo $fetch_sub_route_name;
  }else
  {
      echo "Record no Found !!";   
  }
  echo "</div>";
}



if((!empty($_REQUEST['vehicle_type_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
   $organization_id=$_REQUEST['org_id'];
  $branch_id=$_REQUEST['branch_id'];
  $session_id=$_REQUEST['session_id'];
  $vehicle_type_id=$_REQUEST['vehicle_type_id']; 
  
  
  echo "<option value='0'>-- Select vehicle registration no. --</option>";
  $vehicle_db=  mysql_query("SELECT * FROM transport_vehicle_db WHERE organization_id='$organization_id' and branch_id='$branch_id' 
      and session_id='$session_id' and vehicle_type_id='$vehicle_type_id' and is_delete='none'");
  while ($fetch_vehicle_data=mysql_fetch_array($vehicle_db))
  {
    $fetch_vehicle_id=$fetch_vehicle_data['vehicle_id'];
    $fetch_vehicle_reg_name=$fetch_vehicle_data['vehicle_registration_no'];
    
    echo "<option value='$fetch_vehicle_id'>$fetch_vehicle_reg_name</option>";
  }
  if(empty($fetch_vehicle_id))
  {
      echo "<option value='0'>Record no found !!</option>";
  }
  
  
  
}




?>