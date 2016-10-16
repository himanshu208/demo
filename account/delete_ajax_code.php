<?php 
require_once '../connection.php';

date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
   
//fee delete
if((!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_branch_id']))&&(!empty($_REQUEST['get_session_id']))&&(!empty($_REQUEST['fee_tr_name'])))
{
         $school_id=$_REQUEST['get_school_id'];
         $branch_id=$_REQUEST['get_branch_id'];
         $admin_id=$_REQUEST['get_admin_id'];
         $session_id=$_REQUEST['get_session_id'];
         $delete_id=$_REQUEST['fee_tr_name'];
 
 $update_fee_db=mysql_query("UPDATE financeaddfee SET action='inactive' WHERE id='$delete_id' "
         . "and organization_id='$school_id' and branch_id='$branch_id'"
         . " and session_id='$session_id' and action='active'");
 if((!empty($update_fee_db))&&($update_fee_db))
 {
    $insert_backup_db=mysql_query("INSERT into backup_data_db values('','$school_id','$branch_id','$session_id'"
         . ",'account','fee_group','$delete_id'"
         . ",'$admin_id','none','','','$date','$date_time')"); 
   if($insert_backup_db)
   {
    echo "1";  
   }else
   {
     echo "0";  
   }   
 }  else {
  echo "0";   
 }
}



//fee group remove
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['fee_group_tr_name'])))
{
 $organization_id=$_REQUEST['org_id'];  
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $delete_id=$_REQUEST['fee_group_tr_name'];
 
 
 $update_fee_db=mysql_query("UPDATE financeaddfeegroup SET action='inactive' WHERE id='$delete_id' and organization_id='$organization_id' and branch_id='$branch_id'"
         . " and session_id='$session_id'");
 if((!empty($update_fee_db))&&($update_fee_db))
 {
     echo "1";
 }  else {
  echo "0";   
 }
}



//fee amount remove
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['fee_amount_id'])))
{
 $organization_id=$_REQUEST['org_id'];  
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $delete_id=$_REQUEST['fee_amount_id'];
 
 
 $update_fee_db=mysql_query("UPDATE financefeeamount SET action='inactive' WHERE id='$delete_id' and organization_id='$organization_id' and branch_id='$branch_id'"
         . " and session_id='$session_id'");
 if((!empty($update_fee_db))&&($update_fee_db))
 {
     echo "1";
 }  else {
  echo "0";   
 }
}





//category wise discount
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['category_discount_id'])))
{
 $organization_id=$_REQUEST['org_id'];  
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $delete_id=$_REQUEST['category_discount_id'];
 
 $update_fee_db=mysql_query("UPDATE financefeediscountcategory SET action='inactive' WHERE id='$delete_id' and organization_id='$organization_id' and branch_id='$branch_id'"
         . " and session_id='$session_id'");
 if((!empty($update_fee_db))&&($update_fee_db))
 {
     echo "1";
 }  else {
  echo "0";   
 }
}


//student handicapped wise discount
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['handicapped_discount_id'])))
{
 $organization_id=$_REQUEST['org_id'];  
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $delete_id=$_REQUEST['handicapped_discount_id'];
 
 $update_fee_db=mysql_query("UPDATE financefeediscountstudenthandicapped SET action='inactive' WHERE id='$delete_id' and organization_id='$organization_id' and branch_id='$branch_id'"
         . " and session_id='$session_id'");
 if((!empty($update_fee_db))&&($update_fee_db))
 {
     echo "1";
 }  else {
  echo "0";   
 }
}


//particular student discount
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['particular_student_discount_id'])))
{
 $organization_id=$_REQUEST['org_id'];  
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $delete_id=$_REQUEST['particular_student_discount_id'];
 
 $update_fee_db=mysql_query("UPDATE financefeediscountparticularstudent SET action='inactive' WHERE id='$delete_id' and organization_id='$organization_id' and branch_id='$branch_id'"
         . " and session_id='$session_id'");
 if((!empty($update_fee_db))&&($update_fee_db))
 {
     echo "1";
 }  else {
  echo "0";   
 }
}




//account delete
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['account_name_id'])))
{
 $organization_id=$_REQUEST['org_id'];  
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $delete_id=$_REQUEST['account_name_id'];
 
 $update_fee_db=mysql_query("UPDATE financeaccountheadhdetail SET action='inactive' WHERE id='$delete_id' and organization_id='$organization_id' and branch_id='$branch_id'"
         . " and session_id='$session_id'");
 if((!empty($update_fee_db))&&($update_fee_db))
 {
     echo "1";
 }  else {
  echo "0";   
 }
}


//account group delete
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['account_group_name_id'])))
{
 $organization_id=$_REQUEST['org_id'];  
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $delete_id=$_REQUEST['account_group_name_id'];
 
 $update_fee_db=mysql_query("UPDATE financeaccountdetail SET action='inactive' WHERE id='$delete_id' and organization_id='$organization_id' and branch_id='$branch_id'"
         . " and session_id='$session_id'");
 if((!empty($update_fee_db))&&($update_fee_db))
 {
     echo "1";
 }  else {
  echo "0";   
 }
}
?>