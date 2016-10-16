<?php
//SESSION CONFIGURATION
$check_array_in="time_table";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

require_once '../connection.php';
if((!empty($_REQUEST['subject_id']))&&(!empty($_REQUEST['xml_class']))
        &&(!empty($_REQUEST['week_id']))&&(!empty($_REQUEST['lecture_id']))&&(!empty($_REQUEST['start_time']))
        &&(!empty($_REQUEST['end_time'])))
{
$subject_id=$_REQUEST['subject_id'];
$class_id=$_REQUEST['xml_class'];
$week_id=$_REQUEST['week_id'];
$lecture_id=$_REQUEST['lecture_id']; 
$start_time=$_REQUEST['start_time']; 
$end_time=$_REQUEST['end_time'];   

$temp_start_time=strtotime($start_time);
$temp_end_time=strtotime($end_time);  

$week_days_db=mysql_query("SELECT * FROM time_table_week_days_db WHERE id='$week_id' and is_delete='none'");
$week_data=mysql_fetch_array($week_days_db);
$week_num_rows=mysql_num_rows($week_days_db);
if((!empty($week_data))&&($week_data!=null)&&($week_num_rows!=0))
{
  $week_name=$week_data['week_day_name'];  
}  else {
   $week_name=0; 
}
echo '<option value="0">---Select---</option>';
$subject_allot=mysql_query("SELECT * FROM subject_allocaton_db WHERE $db_main_details class_id='$class_id'"
        . " and subject_id='$subject_id' and is_delete='none'");
while ($subject_data=mysql_fetch_array($subject_allot))
{
$employee_id=$subject_data['employee_id'];

  $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
          . " WHERE T1.employee_id='$employee_id' and T1.is_delete='none'");
              $empoyee_num_rows=mysql_num_rows($employee_db);
              $employee_data=mysql_fetch_array($employee_db);
              if((!empty($employee_data))&&($employee_data!=null)&&($empoyee_num_rows!=0))
              {
              $employee_unqiue_id=$employee_data['employee_id'];
              $emplyee_name=$employee_data['full_name'];
              $employee_no=$employee_data['employee_no'];
              
              $number_count=0;
              $time_table_subject_allot=mysql_query("SELECT * FROM time_table_assign_subject_db WHERE $db_main_details teacher_id='$employee_unqiue_id' and is_delete='none'");
              while ($teacher_match_data=mysql_fetch_array($time_table_subject_allot))
              {
               $time_table_id=$teacher_match_data['time_table_id'];
               $week_days_id=$teacher_match_data['week_day_id'];
               $lecture_id=$teacher_match_data['lecture_id']; 
             
               $time_table_db=mysql_query("SELECT * FROM time_table_db WHERE $db_main_details time_table_id='$time_table_id'"
                       . " and is_delete='none'");
               $time_table_data=mysql_fetch_array($time_table_db);
               $time_table_num_rows=mysql_num_rows($time_table_db);
               if((!empty($time_table_data))&&($time_table_data!=null)&&($time_table_num_rows!=0))
               {
                   
$time_table_filter_db=mysql_query("SELECT * FROM time_table_set_lecture_db WHERE $db_main_details id='$lecture_id'"
        . " and temp_start_time NOT BETWEEN $temp_start_time+1 AND $temp_end_time-1 and temp_end_time NOT BETWEEN $temp_start_time+1 AND $temp_end_time+1 "
        . " and is_delete='none'");
$filter_data=mysql_fetch_array($time_table_filter_db);
$filter_num_row=mysql_num_rows($time_table_filter_db);
if((empty($filter_data))&&($filter_data==null)&&($filter_num_row==0))
{
    
$week_days_dbs=mysql_query("SELECT * FROM time_table_week_days_db WHERE id='$week_days_id' and is_delete='none'");
$week_datas=mysql_fetch_array($week_days_dbs);
$week_num_rowss=mysql_num_rows($week_days_dbs);
if((!empty($week_datas))&&($week_datas!=null)&&($week_num_rowss!=0))
{
  $week_names=$week_datas['week_day_name'];  
}  else {
   $week_names=0; 
}    
    
  if($week_names==$week_name)
  {
$number_count++; 
  }
}
               }  
              }
            
              
              if(!empty($number_count))
              {
              
               echo "<option id='$employee_unqiue_id' value='$employee_unqiue_id' disabled> $employee_no / $emplyee_name</option>";
       
               }else
              {
                echo "<option id='$employee_unqiue_id' value='$employee_unqiue_id'> $employee_no / $emplyee_name  </option>";
                 
              }
              }else
              {
                 echo "<option value='0'>Record no found !!</option>"; 
              }  
    
}
   
$subject_num_rows=mysql_num_rows($subject_allot);
if(empty($subject_num_rows))
{
    echo "<option value='0'>Record no found !!</option>"; 
}
    
}


//fetch time table name

if((!empty($_REQUEST['xml_class_id']))&&(!empty($_REQUEST['xml_section_id'])))
{
$class_id=$_REQUEST['xml_class_id'];
$section_id=$_REQUEST['xml_section_id'];
echo "<option value='0'>---Select---</option>";
$time_table_db=mysql_query("SELECT * FROM time_table_db WHERE $db_main_details class_id='$class_id' "
        . "and section_id='$section_id' and is_delete='none'");
while ($time_table_data=mysql_fetch_array($time_table_db))
{
 $time_table_id=$time_table_data['time_table_id'];
 $time_table_name=$time_table_data['time_table_name'];     
 
 echo "<option value='$time_table_id'>$time_table_name</option>";
}

    
    
}

if(!empty($_REQUEST['time_table_assign_subject_id']))
{
 $assign_id=$_REQUEST['time_table_assign_subject_id'];
 $delete_db=mysql_query("DELETE FROM time_table_assign_subject_db WHERE time_table_assign_subject_id='$assign_id'");
 if((!empty($delete_db))&&($delete_db))
 {
     echo 1;   
 }  else {
     echo 0;    
 }
}


?>






<?php
}else
{
    echo "0";   
}
?>