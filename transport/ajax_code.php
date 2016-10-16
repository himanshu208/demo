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


//student list

if((!empty($_REQUEST['get_student_data'])))
{
 
   if((!empty($_REQUEST['student_of_class_id']))&&(!empty($_REQUEST['student_of_section_id'])))
   {
    
   $class_id=$_REQUEST['student_of_class_id'];
   $section_id=$_REQUEST['student_of_section_id'];   
   
   $search_result="T1.course_id='$class_id' and T1.section_id='$section_id' and";    
   }else
   if((!empty($_REQUEST['student_of_class_id'])))
   {
   $class_id=$_REQUEST['student_of_class_id'];
   
   $search_result="T1.course_id='$class_id' and";      
   }else
   {
   $search_result="";    
   }
   
   
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
                 . " $db_t1_main_details $search_result T1.is_delete='none' and T10.is_delete is null"
                           . " OR $db_t1_main_details $search_result T1.is_delete='none' and T10.is_delete='yes'");
         
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
  
      echo "<option value='$student_unqiue_id'>$student_full_name $relation $student_father_name / Mo. $student_father_mobile_no / $course_name - $section_name  </option>";
 
    }
   if(empty($student_unqiue_id))
   {
       echo "<option value='0'>Record no found</option>"; 
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


//transport service re allotment

if((!empty($_REQUEST['transport_id']))&&(!empty($_REQUEST['student_id'])))
{
    $transport_id=$_REQUEST['transport_id'];
    $student_id=$_REQUEST['student_id'];
    
$update_transport_db=mysql_query("UPDATE student_allot_transport SET is_delete='yes' "
        . "WHERE transport_unique_id='$transport_id' and is_delete='none'");
if((!empty($update_transport_db))&&($update_transport_db))
{
$update_student_db=mysql_query("UPDATE student_db SET transport_id='0' WHERE $db_main_details student_id='$student_id' and is_delete='none'"); 
if((!empty($update_student_db))&&($update_student_db))
{
   echo 1;    
}else
{
   echo 0;    
}
}else
{
    echo 0;   
}
}



?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>