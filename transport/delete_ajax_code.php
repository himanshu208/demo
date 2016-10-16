
<?php 
require_once '../connection.php';

date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    

//delete transport

if((!empty($_REQUEST['route_delete_command']))&&(!empty($_REQUEST['get_school_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_admin_id']))&&(!empty($_REQUEST['get_session_id'])))
{
 
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
    
    
$delete_table_tr_id=$_REQUEST['route_delete_command'];

$delete_db=mysql_query("UPDATE transport_route_db SET is_delete='yes' WHERE route_id='$delete_table_tr_id' and is_delete='none'");
if((!empty($delete_db))&&($delete_db))
{
 
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'transport','route','$delete_table_tr_id'"
         . ",'$admin_id','none','','','$date','$date_time')"); 
   if($insert_backup_db)
   {
    echo "1";  
   }else
   {
     echo "0";  
   }   
    
}else
{
    echo '0'; 
}
}


//delete vehicle type

if((!empty($_REQUEST['vehicle_type_delete_command']))&&(!empty($_REQUEST['get_school_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_admin_id']))&&(!empty($_REQUEST['get_session_id'])))
{
 
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
    
    
$delete_table_tr_id=$_REQUEST['vehicle_type_delete_command'];

$delete_db=mysql_query("UPDATE transport_vehicle_type_db SET is_delete='yes' WHERE vehicle_type_id='$delete_table_tr_id' and is_delete='none'");
if((!empty($delete_db))&&($delete_db))
{
 
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'transport','vehicle_type','$delete_table_tr_id'"
         . ",'$admin_id','none','','','$date','$date_time')"); 
   if($insert_backup_db)
   {
    echo "1";  
   }else
   {
     echo "0";  
   }   
    
}else
{
    echo '0'; 
}
}


//delete vehicle 

if((!empty($_REQUEST['vehicle_delete_command']))&&(!empty($_REQUEST['get_school_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_admin_id']))&&(!empty($_REQUEST['get_session_id'])))
{
 
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
    
    
$delete_table_tr_id=$_REQUEST['vehicle_delete_command'];

$delete_db=mysql_query("UPDATE transport_vehicle_db SET is_delete='yes' WHERE vehicle_id='$delete_table_tr_id' and is_delete='none'");
if((!empty($delete_db))&&($delete_db))
{
 
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'transport','vehicle','$delete_table_tr_id'"
         . ",'$admin_id','none','','','$date','$date_time')"); 
   if($insert_backup_db)
   {
    echo "1";  
   }else
   {
     echo "0";  
   }   
    
}else
{
    echo '0'; 
}
}


//delete driver

if((!empty($_REQUEST['driver_delete_command']))&&(!empty($_REQUEST['get_school_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_admin_id']))&&(!empty($_REQUEST['get_session_id'])))
{
 
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
    
    
$delete_table_tr_id=$_REQUEST['driver_delete_command'];

$delete_db=mysql_query("UPDATE transport_driver_db SET is_delete='yes' WHERE driver_unique_id='$delete_table_tr_id' and is_delete='none'");
if((!empty($delete_db))&&($delete_db))
{
 
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'transport','driver','$delete_table_tr_id'"
         . ",'$admin_id','none','','','$date','$date_time')"); 
   if($insert_backup_db)
   {
    echo "1";  
   }else
   {
     echo "0";  
   }   
    
}else
{
    echo '0'; 
}
}


//delete assign route in vehicle

if((!empty($_REQUEST['assign_route_vehicle_delete_command']))&&(!empty($_REQUEST['get_school_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_admin_id']))&&(!empty($_REQUEST['get_session_id'])))
{
 
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
    
    
$delete_table_tr_id=$_REQUEST['assign_route_vehicle_delete_command'];

$delete_db=mysql_query("UPDATE transport_allocate_route_db SET is_delete='yes' WHERE allocate_vehicle_route_id='$delete_table_tr_id' and is_delete='none'");
if((!empty($delete_db))&&($delete_db))
{
 
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'transport','route_assign_vehicle','$delete_table_tr_id'"
         . ",'$admin_id','none','','','$date','$date_time')"); 
   if($insert_backup_db)
   {
    echo "1";  
   }else
   {
     echo "0";  
   }   
    
}else
{
    echo '0'; 
}
}




?>
