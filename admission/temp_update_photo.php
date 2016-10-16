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

          
 $update_db=mysql_query("UPDATE student_db as T1 "
         . "LEFT JOIN student_personal_db as T2 ON T1.student_personal_id=T2.student_unqiue_id SET T1.admission_status='old' "
         . "WHERE T1.admission_status='new'"); 
 if($update_db)
 {
     echo "record update sucessfully complete"; 
 }

return;


$table_dbs=mysql_query("SELECT * FROM student_temp_db WHERE id");
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
          
 $update_db=mysql_query("UPDATE student_db as T1 "
         . "LEFT JOIN student_personal_db as T2 ON T1.student_personal_id=T2.student_unqiue_id SET T1.student_photo='$student_photo' "
         . "WHERE T2.student_full_name='$student_name' and T2.student_gender='$gender'"
         . " and T2.student_dob='$dob' and T2.current_address='$current_addrss'"); 
 if($update_db)
 {
     echo "record update sucessfully complete"; 
 }
             
}
?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>