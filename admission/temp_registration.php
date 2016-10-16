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

$table_dbs=mysql_query("SELECT * FROM table_104 ");
while ($table_data=mysql_fetch_array($table_dbs))
{
  $fetch_data=$table_data['col_1']; 
  $explode_array=explode(",",$fetch_data);
 
          $student_name=$explode_array[2];
          $admission=$explode_array[1];
          $class=$explode_array[5];
          $father=$explode_array[3];
          $mother_name=$explode_array[4];
          $mobile=$explode_array[7];
          $gender=strtolower($explode_array[8]);
        $date_of_birth=$explode_array[10];
          $address=$explode_array[6];
                  $user_name=user_name();
                  $password=password();
              
       $class_db=mysql_query("SELECT * FROM course_db WHERE course_name='$class'");
       $class_data=mysql_fetch_array($class_db);
       $class_num_rows= mysql_num_rows($class_db);
  if((!empty($class_data))&&($class_data!=null)&&($class_num_rows!=0))
  {
      
  $class_id=$class_data['course_id'];
  
  $section_db=mysql_query("SELECT * FROM section_db WHERE course_id='$class_id'");
  $section_data=mysql_fetch_array($section_db);
  $section_num_rows=mysql_num_rows($section_db);
  if((!empty($section_data))&&($section_data!=null)&&($section_num_rows!=0))
  {
    $section_id=$section_data['section_id'];   
     
 $student_admission_no_result=mysql_query("SHOW TABLE STATUS LIKE 'student_admission_no_db'");
$student_admission_no_row=mysql_fetch_array($student_admission_no_result);
$student_admission_no_nextId=$student_admission_no_row['Auto_increment']; 

$insert_admission_no=$student_admission_prefix_no.$student_admission_no_nextId;

    //student personal details
    
$admission_no=$insert_admission_no;
$admission_date=$date;
$enrollment_no="";
    


 $house_id="";
 $session_id=$fecth_session_id_set;
  
    $student_full_name=$student_name;
    $student_gender=$gender;
    $student_dob=$date_of_birth;
    $student_blood_group="";
    $student_birth_place="";
    $student_nationality="Indian";
    $student_religion="Hinduism";
    $student_mother_tongue="";
    $student_category="CATGRY_2";
    $student_sub_category="";
    $student_mobile="";
    $student_email="";
    $student_photo="";
    $studnet_handicapped="no";
    $student_sub_status="regular";
    $student_username=$user_name;
    $student_password=$password;
    $encrypt_password=md5(md5($student_password));
    
    //student address
    
    $student_current_address=$address;
    $student_current_nearest_area="";
    $student_current_city="Greater Noida";
    $student_current_desctric="G.B Nagar";
    $student_current_post="Bilaspur";
    $student_current_pincode="203202";
    $student_current_state="Uttar Pradesh";
    $student_current_country="India";
    
    $student_per_address=$address;
    $student_per_nearest_area="";
    $student_per_city="Greater Noida";
    $student_per_desctric="G.B Nagar";
    $student_per_post="Bilaspur";
    $student_per_pincode="203202";
    $student_per_state="Uttar Pradesh";
    $student_per_country="India";
    
    
    //father insert valute
    
    $student_father_name=$father;
    $student_father_mobile_no=$mobile;
    $student_father_email_id="";
    $student_father_qualification="";
    $student_father_occupation="";
    $student_father_annual_income="";
    $student_father_photo="";
    
    
    $student_mother_name=$mother_name;
    $student_mother_mobile_no="";
    $student_mother_email_id="";
    $student_mother_qualification="";
    $student_mother_occupation="";
    $student_mother_annual_income="";
    $student_mother_photo="";
    
    
    $student_guardian_relation="";
    $student_guardian_name="";
    $student_guardian_mobile_no="";
    $student_guardian_email="";
    $student_guardian_qualification="";
    $student_guardian_occupation="";
    $student_guardian_annual_income="";
    $student_guardian_photo="";
    
    $parent_username=user_name();
    $parent_password=password();
    
    
    //previous class details
    
    $student_previous_class="";
    $student_core_subject="";
    $student_board_university="";
    $student_passing_year="";
    $student_per_of_marks="";
    $student_extra_activities="";
    $student_school_name="";
    $student_school_address="";
    
    //document details
    if(!empty($_POST['document_submitted']))
    {
    $document_submitted=$_POST['document_submitted'];
    $implode_document_submit=implode("@,@",$document_submitted);
    }else
    {
     $implode_document_submit="";   
    }
   
   
$student_result=mysql_query("SHOW TABLE STATUS LIKE 'student_db'");
$student_row=mysql_fetch_array($student_result);
$student_nextId=$student_row['Auto_increment']; 
$student_final_db_id="STDT_UNQIE_ID_$student_nextId"; 
$student_encrypt_id=md5(md5($student_final_db_id));
$sr_number=$student_nextId;
  

    if((!empty($student_final_db_id)))
    {
     
      
     $check_student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and student_id='$student_final_db_id'");   
     $fetch_student_data=mysql_fetch_array($check_student_db);
     $fetch_student_num_rows=mysql_num_rows($check_student_db);
     if((empty($fetch_student_data))&&($fetch_student_data==null)&&($fetch_student_num_rows==0))
     {
     
      //insert parents value
      
         $student_parents_insert_photo_1="";   
         
         $student_parents_insert_photo_2="";   
         
         $student_parents_insert_photo_3="";   
  $parents_db_data=mysql_query("SELECT * FROM parent_db WHERE father_name='$student_father_name' and "
          . "father_mobile_no='$student_father_mobile_no' and mother_name='$student_mother_name' ");  
  $parents_data=mysql_fetch_array($parents_db_data);
  $parent_num_rows=mysql_num_rows($parents_db_data);        
  
if((empty($parents_data))&&($parents_data==null)&&($parent_num_rows==0))   
{    
$result=mysql_query("SHOW TABLE STATUS LIKE 'parent_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="PRNTS_$nextId"; 
$encrypt_id=md5(md5($final_db_id));    
$parents_db=mysql_query("INSERT into parent_db values('','$fetch_school_id','$fetch_branch_id','$session_id',"
           . "'$final_db_id','$encrypt_id','$date','$student_father_name','$student_father_mobile_no'"
           . ",'$student_father_email_id','$student_father_qualification','$student_father_occupation',"
           . "'$student_father_annual_income','$student_parents_insert_photo_1','$student_mother_name','$student_mother_mobile_no','$student_mother_email_id'"
           . ",'$student_mother_qualification','$student_mother_occupation','$student_mother_annual_income'"
           . ",'$student_parents_insert_photo_2','$student_guardian_relation','$student_guardian_name','$student_guardian_mobile_no'"
           . ",'$student_guardian_email','$student_guardian_qualification','$student_guardian_occupation',"
           . "'$student_guardian_annual_income','$student_parents_insert_photo_3','$parent_username','$parent_password','$parent_password','none','$date'"
           . ",'$date_time','$fecth_user_unique')");     
   
if((!empty($parents_db))&&($parents_db))
{
 $parents_unqiue_id=$final_db_id;     
}else
{
 $parents_unqiue_id=0;   
}
 }else
{
$parents_unqiue_id=$parents_data['parent_unique_id'];
}   
  //student personal details       
         
$st_pr_result=mysql_query("SHOW TABLE STATUS LIKE 'student_personal_db'");
$st_pr_row=mysql_fetch_array($st_pr_result);
$st_pr_nextId=$st_pr_row['Auto_increment']; 
$st_pr_final_db_id="STDNT_ID_$st_pr_nextId"; 
$st_pr_encrypt_id=md5(md5($st_pr_final_db_id)); 

        
        $location="";    
       
      
$student_personal_db=mysql_query("INSERT into student_personal_db values('','$fetch_school_id','$fetch_branch_id','$session_id'"
        . ",'$st_pr_final_db_id','$st_pr_encrypt_id','$student_full_name','$student_gender','$student_dob','$student_blood_group'"
        . ",'$student_birth_place','$student_nationality','$student_religion','$student_mother_tongue','$student_sub_category','$student_mobile'"
        . ",'$student_email','$studnet_handicapped','$student_current_address','$student_current_nearest_area'"
        . ",'$student_current_city','$student_current_desctric','$student_current_post','$student_current_pincode'"
        . ",'$student_current_state','$student_current_country','$student_per_address','$student_per_nearest_area'"
        . ",'$student_per_city','$student_per_desctric','$student_per_post','$student_per_pincode','$student_per_state'"
        . ",'$student_per_country','none','$date','$date_time','$fecth_user_unique')");
if((!empty($student_personal_db))&&($student_personal_db))
{
 $insert_student_persoanl_unqiue_id=$st_pr_final_db_id;   
}else
{
$insert_student_persoanl_unqiue_id=0;    
}

//insert student previous class details
 
$pr_result=mysql_query("SHOW TABLE STATUS LIKE 'student_previous_class_db'");
$pr_row=mysql_fetch_array($pr_result);
$pr_nextId=$pr_row['Auto_increment']; 
$pr_final_db_id="PRVS_CLS_$pr_nextId"; 
$pr_encrypt_id=md5(md5($pr_final_db_id)); 
$previous_class_db=mysql_query("INSERT into student_previous_class_db values('','$fetch_school_id','$fetch_branch_id','$session_id',"
        . "'$pr_final_db_id','$pr_encrypt_id','$student_previous_class','$student_core_subject','$student_board_university'"
        . ",'$student_passing_year','$student_per_of_marks','$student_extra_activities','$student_school_name','$student_school_address'"
        . ",'$implode_document_submit','none','$date','$date_time','$fecth_user_unique')");
if((!empty($previous_class_db))&&($previous_class_db))
{
 $insert_previous_class_id=$pr_final_db_id;  
}else
{
  $insert_previous_class_id=0;   
}

//insert hostel allot values

 if(!empty($_POST['hostel_id'])&&($_POST['hostel_room_id'])&&(!empty($_POST['hostel_joining_date'])))
    {
    $student_hostel_id=$_POST['hostel_id'];
    $student_hostel_room_id=$_POST['hostel_room_id'];
    $hostel_join_date=$_POST['hostel_joining_date'];
    $food_prrefred=$_POST['food_preference'];
    $description=$_POST['hostel_description'];
     
$st_hostel_result=mysql_query("SHOW TABLE STATUS LIKE 'student_allot_hostel'");
$st_hostel_row=mysql_fetch_array($st_hostel_result);
$st_hostel_nextId=$st_hostel_row['Auto_increment']; 
$st_hostel_final_db_id="HSTL_ID_$st_hostel_nextId"; 
$st_hostel_encrypt_id=md5(md5($st_hostel_final_db_id));

$student_allot_hostel_db=mysql_query("INSERT into student_allot_hostel values('','$fetch_school_id','$fetch_branch_id','$session_id'"
        . ",'$st_hostel_final_db_id','$st_hostel_encrypt_id','$hostel_join_date','','$student_hostel_id','$student_hostel_room_id'"
        . ",'$food_prrefred','$description','none','$date','$date_time')");
if(($student_allot_hostel_db)&&(!empty($student_allot_hostel_db)))
{
 $insert_hostel_id=$st_hostel_final_db_id;   
}else
{
 $insert_hostel_id=0;   
}
}else
    {
     $insert_hostel_id=0;   
    }

//insert transport allot values

if((!empty($_POST['transport_route_id']))&&(!empty($_POST['sub_route']))&&(!empty($_POST['transport_vehicle_type_id']))&&(!empty($_POST['transport_joining_date'])))
    {
    $student_transport_route_id=$_POST['transport_route_id'];
    $transport_sub_route=$_POST['sub_route'];
    $student_transport_vehicle_type_id=$_POST['transport_vehicle_type_id'];
    $student_transport_vehicle_reg_no=$_POST['transport_vehicle_reg_no'];
    $transport_join_date=$_POST['transport_joining_date'];
    $transport_description=$_POST['transport_description'];
    
       
$st_transport_result=mysql_query("SHOW TABLE STATUS LIKE 'student_allot_transport'");
$st_transport_row=mysql_fetch_array($st_transport_result);
$st_transport_nextId=$st_transport_row['Auto_increment']; 
$st_transport_final_db_id="TRSPORT_ID_$st_transport_nextId"; 
$st_transport_encrypt_id=md5(md5($st_transport_final_db_id));

$student_allot_transport_db=  mysql_query("INSERT into student_allot_transport values('','$fetch_school_id','$fetch_branch_id','$session_id'"
        . ",'$st_transport_final_db_id','$st_transport_encrypt_id','$transport_join_date','','$student_transport_route_id','$transport_sub_route'"
        . ",'$student_transport_vehicle_type_id','$student_transport_vehicle_reg_no','$transport_description','none','$date','$date_time')");
if(($student_allot_transport_db)&&(!empty($student_allot_transport_db)))
{
 $insert_transport_id=$st_transport_final_db_id;   
}else
{
 $insert_transport_id=0;   
}
}else
    {
     $insert_transport_id=0;   
    }  

//insert health card values

$st_health_result=mysql_query("SHOW TABLE STATUS LIKE 'student_health_card'");
$st_health_row=mysql_fetch_array($st_health_result);
$st_health_nextId=$st_health_row['Auto_increment']; 
$st_health_final_db_id="STD_HLTH_ID_$st_health_nextId"; 
$st_health_encrypt_id=md5(md5($st_health_final_db_id));
$student_health_db=mysql_query("INSERT into student_health_card values('','$fetch_school_id','$fetch_branch_id','$session_id'"
        . ",'$st_health_final_db_id','$st_health_encrypt_id','none','$date','$date_time')");
    
if((!empty($student_health_db))&&($student_health_db))
{
   $insert_health_id=$st_health_final_db_id; 
}else
{
  $insert_health_id=0;  
}


 if((!empty($insert_student_persoanl_unqiue_id)))   
 {
     
     
$student_admission_no_result=mysql_query("SHOW TABLE STATUS LIKE 'student_admission_no_db'");
$student_admission_no_row=mysql_fetch_array($student_admission_no_result);
$student_admission_no_nextId=$student_admission_no_row['Auto_increment']; 

$insert_admission_no=$student_admission_prefix_no.$student_admission_no_nextId;
      
     $insert_student_admission_no_db=mysql_query("INSERT into student_admission_no_db values('','$fetch_school_id','$fetch_branch_id','$session_id'"
             . ",'$student_final_db_id','$insert_admission_no','none','$date'"
           . ",'$date_time','$fecth_user_unique')");
     if((!empty($insert_student_admission_no_db))&&($insert_student_admission_no_db))
     {
    $insert_student_db=mysql_query("INSERT into student_db values('','$fetch_school_id','$fetch_branch_id','$session_id','$class_id'
            ,'$section_id','$house_id','$sr_number','$student_final_db_id','$student_encrypt_id','$insert_admission_no'"
           . ",'$enrollment_no','','$admission_date','active','$student_sub_status','new','$student_category'"
           . ",'$insert_student_persoanl_unqiue_id','$parents_unqiue_id','$insert_previous_class_id','$insert_hostel_id'"
            . ",'$insert_transport_id','$insert_health_id','$student_username','$encrypt_password','$student_password','$location','none','$date'"
           . ",'$date_time','$fecth_user_unique')");     
           
         
         if((!empty($insert_student_db))&&($insert_student_db))
         {
          $message_show="Record save successfully complete"; 
          }else
     {
        $message_show="Request failed please try again."; 
     }      
         }else
     {
        $message_show="Request failed please try again."; 
     }
       }else
     {
        $message_show="Request failed please try again."; 
     }
     
     
     
     }else
     {
        $message_show="Record already exist in database"; 
     }
    }else
     {
        $message_show="Please fill all fields."; 
     }
     
     require_once '../pop_up.php';    
}
  }
}
?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>