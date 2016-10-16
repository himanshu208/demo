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


if((!empty($_REQUEST['student_of_class_id']))&&(!empty($_REQUEST['student_of_section_id'])))
{
   $class_id=$_REQUEST['student_of_class_id'];
   $section_id=$_REQUEST['student_of_section_id'];      
   echo "<option value='0'></option>";
    $row=0;
                   $student_dbs=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as t1_encrypt_id FROM student_db as T1"
                 . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                 . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                 . " LEFT JOIN session_db as T4 ON T1.session_id=T4.session_id "
                 . " LEFT JOIN category_db as T5 ON T1.category_id=T5.category_id "
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id"
                 . " LEFT JOIN student_previous_class_db as T8 ON T1.previous_class_id=T8.previous_class_unique_id"
                 . " LEFT JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id"
                 . " LEFT JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id "
                 . "LEFT JOIN house_db as T11 ON T1.house_id=T11.house_id WHERE "
                 . " $db_t1_main_details T1.course_id='$class_id' and T1.section_id='$section_id' and T1.is_delete='none'");
         
         $fetch_student_num_rows=mysql_num_rows($student_dbs);
         while ($fetch_student_datas=mysql_fetch_array($student_dbs))
         {
$row++;  
$db_id=$fetch_student_datas['db_id'];    
$student_unqiue_id=$fetch_student_datas['student_id']; 
    $student_gender=ucfirst($fetch_student_datas['student_gender']);
$course_name=$fetch_student_datas['course_name'];             
$section_name=$fetch_student_datas['section_name'];
$student_full_name=$fetch_student_datas['student_full_name'];
$student_father_name=$fetch_student_datas['father_name'];
$student_father_mobile_no=$fetch_student_datas['father_mobile_no'];
   
    if($student_gender=="Male")
    {
       $relation="S/O";
    }else
    {
   $relation="D/O";     
    }
  
      echo "<option value='$student_unqiue_id'> $course_name - $section_name / $student_full_name $relation $student_father_name / Mo. $student_father_mobile_no  </option>";
 
    }
   if(empty($student_unqiue_id))
   {
       echo "<option value='0'>Record no found</option>"; 
   }
}


?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>