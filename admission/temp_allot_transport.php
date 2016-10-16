<?php
//SESSION CONFIGURATION
$check_array_in="admission";
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

function user_name($length=6)
{
   $chars ="abcdefghijklmnopqrstuvwxyz123456789987654321";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
}

 function password($length=8)
{
   $chars ="123456789987654321";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
}
        
  
require_once '../connection.php';
$message_show="";

$table_dbs=mysql_query("SELECT * FROM temp_student_db WHERE route_id='RUTE_7'");
while ($explode_array=mysql_fetch_array($table_dbs))
{
  
          $student_name=$explode_array['student_full_name'];
          $gender=$explode_array['student_gender'];
          $birth_place=$explode_array['student_birth_place'];
          $religino=$explode_array['student_religion'];
          $dob=$explode_array['student_dob'];
          $category=$explode_array['category_id'];
          $subcategory=$explode_array['sub_category'];
          $student_mobile=$explode_array['student_mobile_no'];
          $student_photo=$explode_array['student_photo'];
          $current_addrss=$explode_array['current_address'];
          
   $slect_student_db=mysql_query("SELECT * FROM student_db as T1 "
         . "LEFT JOIN student_personal_db as T2 ON T1.student_personal_id=T2.student_unqiue_id WHERE T2.student_full_name='$student_name' and T2.student_gender='$gender'"
         . " and T2.student_dob='$dob' and T2.current_address='$current_addrss'");       
  $select_student_num=mysql_num_rows($slect_student_db);   
$select_student_data=mysql_fetch_array($slect_student_db);     
     if((!empty($select_student_num))&&($select_student_num!=0))
     {
    
$student_id=$select_student_data['student_id'];
    $student_transport_route_id="RUTE_3";
    $transport_sub_route="SUBRUTE_9";
    $student_transport_vehicle_type_id="VEHCLTYP_4";
    $student_transport_vehicle_reg_no="VEHCL_4";
    $transport_join_date=$date;
    $transport_description="";
    
       
$st_transport_result=mysql_query("SHOW TABLE STATUS LIKE 'student_allot_transport'");
$st_transport_row=mysql_fetch_array($st_transport_result);
$st_transport_nextId=$st_transport_row['Auto_increment']; 
$st_transport_final_db_id="TRSPORT_ID_$st_transport_nextId"; 
$st_transport_encrypt_id=md5(md5($st_transport_final_db_id));

$student_allot_transport_db=  mysql_query("INSERT into student_allot_transport values('','$fetch_school_id','$fetch_branch_id','SESSION_1'"
        . ",'$st_transport_final_db_id','$st_transport_encrypt_id','$date','','$student_transport_route_id','$transport_sub_route'"
        . ",'$student_transport_vehicle_type_id','$student_transport_vehicle_reg_no','$transport_description','none','$date','$date_time')");
if(($student_allot_transport_db)&&(!empty($student_allot_transport_db)))
{
 $insert_transport_id=$st_transport_final_db_id;   
}else
{
 $insert_transport_id=0;   
}    
         
         
 $update_db=mysql_query("UPDATE student_db SET transport_id='$st_transport_final_db_id' "
         . "WHERE student_id='$student_id'"); 
 if($update_db)
 {
     echo "record update sucessfully complete"; 
 }
     }else
{
    echo "Sorry,Technical Problem";   
}
 
             
}
?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>