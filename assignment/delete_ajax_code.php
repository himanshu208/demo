<?php
require_once '../connection.php';

date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;


if((!empty($_REQUEST['assignment_delete_command']))&&(!empty($_REQUEST['get_school_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_admin_id']))&&(!empty($_REQUEST['get_session_id'])))
{
 
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
    
    
$delete_table_tr_id=$_REQUEST['assignment_delete_command'];

$delete_db=mysql_query("UPDATE assignment_db SET is_delete='yes' WHERE assignment_id='$delete_table_tr_id' and is_delete='none'");
if((!empty($delete_db))&&($delete_db))
{
 
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'assignment','assignment','$delete_table_tr_id'"
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





if((!empty($_REQUEST['notes_delete_command']))&&(!empty($_REQUEST['get_school_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_admin_id']))&&(!empty($_REQUEST['get_session_id'])))
{
 
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
    
    
$delete_table_tr_id=$_REQUEST['notes_delete_command'];

$delete_db=mysql_query("UPDATE notes_db SET is_delete='yes' WHERE notes_id='$delete_table_tr_id' and is_delete='none'");
if((!empty($delete_db))&&($delete_db))
{
 
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'assignment','notes','$delete_table_tr_id'"
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