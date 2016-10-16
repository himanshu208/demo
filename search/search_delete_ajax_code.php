<?php 
require_once '../connection.php';
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    

if((!empty($_REQUEST['student_admission_no']))&&(!empty($_REQUEST['account_status']))&&(!empty($_REQUEST['student_db_ids'])))
{
  
  $account_status=$_REQUEST['account_status'];
 $student_admission_no=$_REQUEST['student_admission_no'];
 $student_db_id=$_REQUEST['student_db_ids'];
 $update_student_record=mysql_query("UPDATE student_db SET account_status='$account_status' WHERE"
         . " id='$student_db_id' and student_id='$student_admission_no' and is_delete='none'");
 if((!empty($update_student_record))&&($update_student_record))
 {
     echo 1;
 }else
 {
     echo 0;    
 }
   
}



if((!empty($_REQUEST['delete_student_admission_no']))&&(!empty($_REQUEST['student_db_id']))&&(!empty($_REQUEST['get_school_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_admin_id']))&&(!empty($_REQUEST['get_session_id'])))
{
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
    
 $student_db_id=$_REQUEST['student_db_id'];
 $student_admission_no=$_REQUEST['delete_student_admission_no'];
 $delete_db=mysql_query("UPDATE student_db SET is_delete='yes' WHERE id='$student_db_id' and student_id='$student_admission_no' and is_delete='none'");
if((!empty($delete_db))&&($delete_db))
{
 
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'search_student','student','$student_admission_no'"
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