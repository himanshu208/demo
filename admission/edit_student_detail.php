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

require_once '../connection.php';
$message_show="";
if(isset($_POST['save_process_details']))
{
    
    $update_student_db_id=$_POST['student_db_id'];
    $update_student_persoanl_db_id=$_POST['student_persoanl_db_id'];
    $update_parent_db_id=$_POST['parent_db_id'];        
    $update_previous_class_db_id=$_POST['previous_class_id'];
    $update_hostel_db_id=$_POST['hostel_db_id'];
    $update_transport_db_id=$_POST['transport_db_id'];        
    $update_health_card_db_id=$_POST['health_card_db_id'];
    
    
    //student personal details
    
    
 $insert_admission_no=$_POST['admission_no'];
 $admission_date=$_POST['admission_date'];
 $enrollment_no=$_POST['enrollment_no'];
    
 $class_id=$_POST['class_id'];
 $section_id=$_POST['section_id'];
 $house_id=$_POST['house_id'];
 $session_id=$_POST['use_inset_session_id'];
  
    $student_full_name=$_POST['student_full_name'];
    $student_gender=$_POST['student_gender_id'];
    $student_dob=$_POST['student_dob'];
    $student_blood_group=$_POST['student_blood_group'];
    $student_birth_place=$_POST['student_birth_place'];
    $student_nationality=$_POST['student_nationality'];
    $student_religion=$_POST['student_religion'];
    $student_mother_tongue=$_POST['student_mother_tongue'];
    $student_category=$_POST['student_category'];
    $student_sub_category=$_POST['student_sub_category'];
    $student_mobile=$_POST['student_mobile_no'];
    $student_email=$_POST['student_email_id'];
    $student_photo=$_FILES['student_photo'];
    $studnet_handicapped=$_POST['student_handicapped'];
    $student_sub_status=$_POST['student_sub_status'];
    $student_username=$_POST['student_user_name'];
    $student_password=$_POST['student_password'];
    $encrypt_password=md5(md5($student_password));
    
    //student address
    
    $student_current_address=$_POST['current_address'];
    $student_current_nearest_area=$_POST['current_nearest_address'];
    $student_current_city=$_POST['current_city'];
    $student_current_desctric=$_POST['current_desctric'];
    $student_current_post=$_POST['current_post'];
    $student_current_pincode=$_POST['current_pincode'];
    $student_current_state=$_POST['current_state'];
    $student_current_country=$_POST['current_country'];
    
    $student_per_address=$_POST['per_address'];
    $student_per_nearest_area=$_POST['per_nearest_area'];
    $student_per_city=$_POST['per_city'];
    $student_per_desctric=$_POST['per_desctric'];
    $student_per_post=$_POST['per_post'];
    $student_per_pincode=$_POST['per_pincode'];
    $student_per_state=$_POST['per_state'];
    $student_per_country=$_POST['per_country'];
    
    
    //father insert valute
    
    $student_father_name=$_POST['student_father_name'];
    $student_father_mobile_no=$_POST['student_father_mobile_no'];
    $student_father_email_id=$_POST['student_father_email_id'];
    $student_father_qualification=$_POST['student_father_qualification'];
    $student_father_occupation=$_POST['student_father_occupation'];
    $student_father_annual_income=$_POST['student_father_annual_income'];
    $student_father_photo=$_FILES['student_father_photo'];
    
    
    $student_mother_name=$_POST['student_mother_name'];
    $student_mother_mobile_no=$_POST['student_mother_mobile_no'];
    $student_mother_email_id=$_POST['student_mother_email_id'];
    $student_mother_qualification=$_POST['student_mother_qualification'];
    $student_mother_occupation=$_POST['student_mother_occupation'];
    $student_mother_annual_income=$_POST['student_mother_annual_income'];
    $student_mother_photo=$_FILES['student_mother_photo'];
    
    
    $student_guardian_relation=$_POST['guardian_relation'];
    $student_guardian_name=$_POST['guardian_full_name'];
    $student_guardian_mobile_no=$_POST['guardian_mobile_no'];
    $student_guardian_email=$_POST['guardian_email_id'];
    $student_guardian_qualification=$_POST['guardian_qualification'];
    $student_guardian_occupation=$_POST['guardian_occupation'];
    $student_guardian_annual_income=$_POST['guardian_annual_income'];
    $student_guardian_photo=$_FILES['guardian_photo'];
    
    $parent_username=$_POST['parent_user_name'];
    $parent_password=$_POST['parent_password'];
    $encrypt_parent_password=md5($parent_password);
    
    //previous class details
    
    $student_previous_class=$_POST['pervious_class'];
    $student_core_subject=$_POST['core_subject'];
    $student_board_university=$_POST['board_university'];
    $student_passing_year=$_POST['passing_year'];
    $student_per_of_marks=$_POST['per_of_marks'];
    $student_extra_activities=$_POST['extra_activities'];
    $student_school_name=$_POST['school_name'];
    $student_school_address=$_POST['school_address'];
    
    //document details
    if(!empty($_POST['document_submitted']))
    {
    $document_submitted=$_POST['document_submitted'];
    $implode_document_submit=implode("@,@",$document_submitted);
    }else
    {
     $implode_document_submit="";   
    }
   
   

$student_final_db_id=$update_student_db_id;

    if((!empty($student_final_db_id))&&(!empty($session_id))&&(!empty($class_id))&&(!empty($section_id))&&($session_id)&&(!empty($student_full_name))&&(!empty($student_dob))
            &&(!empty($student_nationality))&&(!empty($student_category))&&(!empty($student_current_address))
            &&(!empty($student_current_city))&&(!empty($student_current_desctric))&&(!empty($student_current_pincode))&&(!empty($student_current_state))
            &&(!empty($student_current_country))&&(!empty($student_per_address))&&(!empty($student_per_city))
            &&(!empty($student_per_desctric))&&(!empty($student_per_pincode))&&(!empty($student_per_state))
            &&(!empty($student_per_country)))
    {
     
      
     $check_student_db=mysql_query("SELECT * FROM student_db WHERE $db_main_details encrypt_id='$update_student_db_id' ");   
     $fetch_student_data=mysql_fetch_array($check_student_db);
     $fetch_student_num_rows=mysql_num_rows($check_student_db);
     if((empty($fetch_student_data))&&($fetch_student_data==null)&&($fetch_student_num_rows==0))
     {
     
         
  
if($_POST['parent_option']!="exist")   
{ 
 
 //insert parents value
      
        $filename_1= $_FILES['student_father_photo']['name'];
        $tmpfilename_1 = $_FILES['student_father_photo']['tmp_name'];
        $filesize_1= $_FILES['student_father_photo']['size'];
        
        $filename_2= $_FILES['student_mother_photo']['name'];
        $tmpfilename_2 = $_FILES['student_mother_photo']['tmp_name'];
        $filesize_2 = $_FILES['student_mother_photo']['size'];
        
         $filename_3= $_FILES['guardian_photo']['name'];
        $tmpfilename_3 = $_FILES['guardian_photo']['tmp_name'];
        $filesize_3 =$_FILES['guardian_photo']['size'];
        
        if((!empty($filename_1)))
        { 
        if(($filesize_1<102400))
         {
        $imagesize_1=getimagesize($tmpfilename_1);
     
        if ((!empty($imagesize_1))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location_1="crud_images/parents/". $random . $time . $filename_1;
            $templocation_1= "images/parents/". $random . $time;
            $upload_1= move_uploaded_file($tmpfilename_1,"../".$location_1);
            if($upload_1)
            {
             $student_parents_insert_photo_1=$location_1;   
            }
        }else
        {
            $student_parents_insert_photo_1="";   
        }
         }else
         {
             $student_parents_insert_photo_1="";   
         }
        }else
        {
         $student_parents_insert_photo_1=$_POST['temp_father_photo'];   
        }
            
          
        
        
         if((!empty($filename_2)))
        { 
        if(($filesize_2<202400))
         {
        $imagesize_2=getimagesize($tmpfilename_2);
     
        if ((!empty($imagesize_2))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(2000, 5000);
            $location_2="crud_images/parents/". $random . $time . $filename_2;
            $templocation_2= "images/parents/". $random . $time;
            $upload_2= move_uploaded_file($tmpfilename_2,"../".$location_2);
            if($upload_2)
            {
             $student_parents_insert_photo_2=$location_2;   
            }
        }else
        {
            $student_parents_insert_photo_2="";   
        }
         }else
         {
             $student_parents_insert_photo_2="";   
         }
        }else
        {
         $student_parents_insert_photo_2=$_POST['temp_mother_photo'];   
        }
           
        
         if((!empty($filename_3)))
        { 
        if(($filesize_3<302400))
         {
        $imagesize_3=getimagesize($tmpfilename_3);
     
        if ((!empty($imagesize_3))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(3000, 5000);
            $location_3="crud_images/parents/". $random . $time . $filename_3;
            $templocation_3= "images/parents/". $random . $time;
            $upload_3= move_uploaded_file($tmpfilename_3,"../".$location_3);
            if($upload_3)
            {
             $student_parents_insert_photo_3=$location_3;   
            }
        }else
        {
            $student_parents_insert_photo_3="";   
        }
         }else
         {
             $student_parents_insert_photo_3="";   
         }
        }else
        {
         $student_parents_insert_photo_3=$_POST['temp_local_parent_photo'];   
        } 
    
$update_parent_db=mysql_query("UPDATE parent_db SET father_name='$student_father_name',father_mobile_no='$student_father_mobile_no',"
        . "father_email='$student_father_email_id',father_qualification='$student_father_qualification',father_occupation='$student_father_occupation',father_annual_income='$student_father_annual_income',"
        . "father_photo='$student_parents_insert_photo_1',mother_name='$student_mother_name',mother_mobile_no='$student_mother_mobile_no',mother_email_id='$student_mother_email_id',"
        . "mother_qualification='$student_mother_qualification',mother_occupation='$student_mother_occupation',mother_annual_income='$student_mother_annual_income',mother_photo='$student_parents_insert_photo_2'"
        . ",local_parent_relation='$student_guardian_relation',local_parent_name='$student_guardian_name',local_parent_mobile_no='$student_guardian_mobile_no',local_parent_email_id='$student_guardian_email',"
        . "local_parent_qualification='$student_guardian_qualification',local_parent_occupation='$student_guardian_occupation',local_parent_annual_income='$student_guardian_annual_income',"
        . "local_parent_photo='$student_parents_insert_photo_3',user_name='$parent_username'"
        . ",password='$encrypt_parent_password',temp_password='$parent_password' WHERE parent_unique_id='$update_parent_db_id' and is_delete='none'"); 

if((!empty($update_parent_db))&&($update_parent_db))
{
 $parents_unqiue_id=$update_parent_db_id;     
}else
{
 $parents_unqiue_id=0;   
}
 }else
{
$parents_unqiue_id=$_POST['parent_id'];
}   
  




//student personal details       
         


        
      
$update_student_db=mysql_query("UPDATE student_personal_db SET student_full_name='$student_full_name',student_gender='$student_gender',"
        . "student_dob='$student_dob',student_blood_group='$student_blood_group',student_birth_place='$student_birth_place',student_nationality='$student_nationality',"
        . "student_religion='$student_religion',mother_tongue='$student_mother_tongue',sub_category='$student_sub_category',student_mobile_no='$student_mobile',"
        . "student_email_id='$student_email',student_handicapped='$studnet_handicapped',current_address='$student_current_address',current_nearest_area='$student_current_nearest_area'"
        . ",current_city='$student_current_city',current_desctric='$student_current_desctric',current_post='$student_current_post',current_pincode='$student_current_pincode',current_state='$student_current_state',"
        . "current_country='$student_current_country',permanent_address='$student_per_address',permanent_nearest_area='$student_per_nearest_area',permanent_city='$student_per_city',"
        . "permanent_desctric='$student_per_desctric',permanent_post='$student_per_post',permanent_pincode='$student_per_pincode',permanent_state='$student_per_state'"
        . ",permanent_country='$student_per_country' WHERE student_unqiue_id='$update_student_persoanl_db_id' and is_delete='none'");
if((!empty($update_student_db))&&($update_student_db))
{
 $insert_student_persoanl_unqiue_id=$update_student_persoanl_db_id;   
}else
{
$insert_student_persoanl_unqiue_id=0;    
}

//insert student previous class details
 
if(!empty($update_previous_class_db_id))
{
$update_previous_class_db=mysql_query("UPDATE student_previous_class_db SET previous_class_name='$student_previous_class',"
        . "previous_class_core_subject='$student_core_subject',previous_class_board='$student_board_university',previous_class_passing_year='$student_passing_year',"
        . "previous_class_per_of_mark='$student_per_of_marks',previous_class_extra_activities='$student_extra_activities',previous_class_school_name='$student_school_name'"
        . ",previous_class_school_address='$student_school_address',submitted_document='$implode_document_submit'"
        . " WHERE previous_class_unique_id='$update_previous_class_db_id' and is_delete='none'");
if((!empty($update_previous_class_db))&&($update_previous_class_db))
{
 $insert_previous_class_id=$update_previous_class_db_id;  
}else
{
  $insert_previous_class_id=0;   
}
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


if(!empty($update_hostel_db_id))
{
$update_hostel_db=mysql_query("UPDATE student_allot_hostel SET start_service_date='$hostel_join_date',"
        . "hostel='$student_hostel_id',room='$student_hostel_room_id',food_preference='$food_prrefred',description='$description'"
        . " WHERE hostel_unique_id='$update_hostel_db_id' and is_delete='none'");
if(($update_hostel_db)&&(!empty($update_hostel_db)))
{
 $insert_hostel_id=$update_hostel_db_id;   
}else
{
 $insert_hostel_id=0;   
}
}else
{
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
    
       
if(!empty($update_transport_db_id))
{
$update_transport_db=mysql_query("UPDATE student_allot_transport SET  start_service_date='$transport_join_date',"
        . "route='$student_transport_route_id',sub_route='$transport_sub_route'"
        . ",vehicle_type='$student_transport_vehicle_type_id',vehicle='$student_transport_vehicle_reg_no'"
        . ",description='$transport_description' WHERE transport_unique_id='$update_transport_db_id' and is_delete='none'");

if(($update_transport_db)&&(!empty($update_transport_db)))
{
 $insert_transport_id=$update_transport_db_id;   
}else
{
 $insert_transport_id=0;   
}
    }else
    {
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
     $filename=$_FILES['student_photo']['name'];
        $tmpfilename=$_FILES['student_photo']['tmp_name'];
        $filesize=$_FILES['student_photo']['size'];
        if(!empty($filename))
        {
        if(($filesize<102400))
         {
        $imagesize=getimagesize($tmpfilename);
        if ((!empty($imagesize))) 
            {
        
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location="crud_images/student_registration/". $random . $time . $filename;
            $templocation="crud_images/student_registration/". $random . $time;
            $upload=move_uploaded_file($tmpfilename,"../".$location);
           if(($upload))
           {    
         
       $location=$location;        
      }else
      {
      $location="";
      }
      }else 
      {
        $location="";  
      }
      }else 
      {
        $location="";  
      }
        }else
        {
        $location=$_POST['temp_student_photo'];    
        } 
     
     
      $update_student_db=mysql_query("UPDATE student_db SET course_id='$class_id',section_id='$section_id',house_id='$house_id',"
              . "admission_no='$insert_admission_no',enrollment_no='$enrollment_no'"
              . ",admission_date='$admission_date',sub_status='$student_sub_status',category_id='$student_category'"
              . ",student_personal_id='$insert_student_persoanl_unqiue_id',parent_id='$parents_unqiue_id',previous_class_id='$insert_previous_class_id',hostel_id='$insert_hostel_id',"
              . "transport_id='$insert_transport_id',health_card_id='$insert_health_id',user_name='$student_username',password='$encrypt_password',temp_password='$student_password'"
              . ",student_photo='$location' WHERE student_id='$update_student_db_id' and is_delete='none'");   
         if((!empty($update_student_db))&&($update_student_db))
         {
          $message_show="<span style='color:green;'>Record update successfully complete</span>"; 
          }else
     {
        $message_show="Request failed please try again."; 
     }      
        
       }else
     {
        $message_show="Request failed  please try again."; 
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
?>




<?php 
$log_out_page="../account_logout.php";
require '../page_url_link.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Edit Student Detail</title>
         <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         <script type="text/javascript" src="../javascript/next_javascript.js"></script>
           <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
    
       <script type="text/javascript">
        function same_address()
        {
            var current_address=document.getElementById("curr_address").value;
            var nearest_area=document.getElementById("curr_nearest_area").value;
            var current_city=document.getElementById("curr_city").value;
            var current_desctric=document.getElementById("curr_desctric").value;
            var current_post=document.getElementById("curr_post").value;
            var current_pincode=document.getElementById("curr_pincode").value;
            var current_state=document.getElementById("curr_state").value;
            var current_country=document.getElementById("curr_country").value;
          
         var check_addres_input=document.getElementById("check_box_checked").checked;
         if(check_addres_input==true)
             {
             document.getElementById("per_address").value=current_address;
             document.getElementById("per_nearest_area").value=nearest_area;
             document.getElementById("per_city").value=current_city;
             document.getElementById("per_desctric").value=current_desctric;
             document.getElementById("per_post").value=current_post;
              document.getElementById("per_pincode").value=current_pincode;
             document.getElementById("per_state").value=current_state;
             document.getElementById("per_country").value=current_country;
              $(document).ready(function(){
               $("#per_country option[value='"+current_country+"']").attr("selected","selected"); 
            });
             
              document.getElementById("check_addres_input").value=1;
             }else
                 {
             document.getElementById("per_address").value="";
             document.getElementById("per_nearest_area").value="";
             document.getElementById("per_city").value="";
             document.getElementById("per_desctric").value="";
              document.getElementById("per_post").value=="";
             document.getElementById("per_pincode").value="";
             document.getElementById("per_state").value="";
              $(document).ready(function(){
               $("#per_country option[value='0']").attr("selected","selected"); 
            });
                document.getElementById("check_addres_input").value=0;  
                 }
            }
         </script>         
             
         <script type="text/javascript">
         function next_finish_page_details()
         {
             var under_tacking_check=document.getElementById("under_taking_check").checked;
             if(under_tacking_check==false)
                 {
                 alert("Please checked checkbox");
                 return false;
                 }else
                     {
                        document.getElementById("ajax_loader_show").style.display="block";    
                     
                     }
         }
         </script>   
             
             
    </head>
    <body onload="page_load()">
        
    <?php 
include_once '../ajax_loader_page_second.php';
      ?>
        <div id="include_header_page">
         <?php  require_once '../header/header_page.php'; ?>    
        </div>
        
        <?php
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
        
        ?>
        
        
        
        
        <div id="fetch_record" style=" display:none; "></div>
        
          <form action="" name="myForm" method="post" enctype="multipart/form-data">
        
       <div id="main_work_div">
           <div id="main_second_work_div">
               <div class="forward_step_style">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="../search/search.php">Student Search</a></td>
                           <td>/</td>
                           <td>Edit Student Detail</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
               <input type="hidden" id="organization_id" value="<?php  echo $fetch_school_id;?>">
               <input type="hidden" id="brnach_id" value="<?php  echo $fetch_branch_id;?>">              
               <style>
.forward_step{ width:1050px; height:60px; float:left; padding-top:5px;   }
#full_width_table{ width:auto; height:auto;   }
.verticle_new_line{ width:45px; padding-left:10px;  height:1px; background-color: silver;  }
.circle_div{ width:20px; height:20px; background-color:silver; border-radius:100%; margin:0 auto;     }
.heading_short_forward{ width:auto;  text-align:center; font-weight:bold; color:silver; font-size:11px; 
padding-top:
    4px; }
#circle_color{ width:22px; height:22px;   background-color: yellowgreen;}
#color_set_page{ color:yellowgreen; font-size: 15px; }
   
                   
               </style>
               <div class="forward_step" style=" height:auto; ">
            <table cellspacing="0" cellpadding="0" id="full_width_table">
                <tr>
                    <td><div class="verticle_new_line" style=" width:75px; "></div></td>
                    <td style=" width:20px; "><div id="circle_color_1"  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"   style=" width:75px; "></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_2"   class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line" style=" width:65px; "></div></td>
                    <td style=" width:20px; "><div id="circle_color_3"  class="circle_div"></div></td>
                    <td><div class="verticle_new_line" style=" width:65px; "></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_4"   class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
 <?php 
 if(module("health_card",$explode_module_array)==1)
 {
 ?>
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_5"   class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                <?php
 }
                ?>      
 <?php 
 if(module("hostel",$explode_module_array)==1)
 {
 ?>
                     
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_6"  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                    
               <?php 
               }
              ?>
                         <?php 
 if(module("transport",$explode_module_array)==1)
 {
                        ?>
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_7"  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
<?php 
}
?>
                    
                       
                    
                    
                    
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_8"   class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                </tr>
                <tr>
                    <td colspan="3" id="color_set_page_1" class="heading_short_forward">
                   Student Personal Details
                    </td>
                    <td colspan="3" id="color_set_page_2" class="heading_short_forward">
                   Address Details  
                    </td>
                    <td colspan="3" id="color_set_page_3"  class="heading_short_forward">
                   Parents/Local Guardian Details
                    </td>
                    
                    <td colspan="3" id="color_set_page_4"  class="heading_short_forward">
                   Previous Class Details
                    </td>
                    
                    <?php 
 if(module("health_card",$explode_module_array)==1)
 {
 ?>
                       <td colspan="3" id="color_set_page_5"  class="heading_short_forward">
                   Health Card
                    </td>
                 <?php
 }
                 ?>   
                 
                    <?php 
 if(module("hostel",$explode_module_array)==1)
 {
 ?>
                     <td colspan="3" id="color_set_page_6"  class="heading_short_forward">
                   Allocate Hostel A/C
                    </td>
                    <?php
 }
                    ?>
                    
                   <?php 
 if(module("transport",$explode_module_array)==1)
 {
                        ?>
                     <td colspan="3"  id="color_set_page_7" class="heading_short_forward">
                   Allocate Transport A/C
                    </td>
                    
                     
             <?php 
 }
               ?>
                    
                <td colspan="3" id="color_set_page_8"  class="heading_short_forward">
                   Finish
                    </td>
                </tr>
                 </table>
        </div>
               
               
               
             
               
              <?php 
        
        if((!empty($_REQUEST['token_id'])))
        {
            
         $admission_encrypt_id=$_REQUEST['token_id'];
         $student_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
                 . "T10.description as transport_description FROM student_db as T1"
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
                 . " $db_t1_main_details T1.encrypt_id='$admission_encrypt_id' and T1.is_delete='none'");
         
         
         $fetch_student_data=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);
         if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
         {
             
$form_sr_no=$fetch_student_data['sr_no'];
$admission_no=$fetch_student_data['admission_no'];
$student_roll_no=$fetch_student_data['roll_no'];       
$student_admission_date=$fetch_student_data['admission_date'];  
$enrollment_no=$fetch_student_data['enrollment_no'];  
$course_name=$fetch_student_data['course_id'];             
$section_name=$fetch_student_data['section_id'];
$session_name=$fetch_student_data['session_name'];
$category_name=$fetch_student_data['category_id'];
$house_name=$fetch_student_data['house_id'];
 
    $student_full_name=$fetch_student_data['student_full_name'];
    $student_gender=ucfirst($fetch_student_data['student_gender']);
    $student_dob=$fetch_student_data['student_dob'];
    $student_blood_group=$fetch_student_data['student_blood_group'];
    $student_birth_place=$fetch_student_data['student_birth_place'];
    $student_nationality=$fetch_student_data['student_nationality'];
    $student_religion=$fetch_student_data['student_religion'];
    $student_mother_tongue=$fetch_student_data['mother_tongue'];
    $student_category=$fetch_student_data['category_id'];
    $student_sub_category=$fetch_student_data['sub_category'];
    $student_mobile=$fetch_student_data['student_mobile_no'];
    $student_email=$fetch_student_data['student_email_id'];
    $sub_status=ucwords($fetch_student_data['sub_status']);
    $student_photo=$fetch_student_data['student_photo'];
    $temp_student_photo=$student_photo;
    
    if(empty($student_photo))
    {
    $student_photo="images/no_avilable_image.gif";    
    }  else {
      $student_photo=$student_photo;    
    }
   $user_name=$fetch_student_data['user_name'];
    $password=$fetch_student_data['temp_password'];      
     
    
    
    $studnet_handicapped=$fetch_student_data['student_handicapped'];
    
    $student_current_address=$fetch_student_data['current_address'];
    $student_current_nearest_area=$fetch_student_data['current_nearest_area'];
    $student_current_city=$fetch_student_data['current_city'];
    $student_current_desctric=$fetch_student_data['current_desctric'];
    $student_current_pincode=$fetch_student_data['current_pincode'];
    $student_current_state=$fetch_student_data['current_state'];
    $student_current_country=$fetch_student_data['current_country'];
    $student_current_post=$fetch_student_data['current_post'];
    
    $student_permanent_address=$fetch_student_data['permanent_address'];
    $student_permanent_nearest_area=$fetch_student_data['permanent_nearest_area'];
    $student_permanent_city=$fetch_student_data['permanent_city'];
    $student_permanent_desctric=$fetch_student_data['permanent_desctric'];
    $student_permanent_pincode=$fetch_student_data['permanent_pincode'];
    $student_permanent_state=$fetch_student_data['permanent_state'];
    $student_permanent_country=$fetch_student_data['permanent_country'];
    $student_permanent_post=$fetch_student_data['permanent_post'];
    
    $student_father_name=$fetch_student_data['father_name'];
    $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
    $student_father_email_id=$fetch_student_data['father_email'];
    $student_father_qualification=$fetch_student_data['father_qualification'];
    $student_father_occupation=$fetch_student_data['father_occupation'];
    $student_father_annual_income=$fetch_student_data['father_annual_income'];
    $student_father_photo=$fetch_student_data['father_photo'];
    $temp_father_photo=$fetch_student_data['father_photo'];
    if(empty($student_father_photo))
    {
    $student_father_photo="images/no_avilable_image.gif";    
    }  else {
      $student_father_photo=$student_father_photo;    
       
    }
    
    
    $student_mother_name=$fetch_student_data['mother_name'];
    $student_mother_mobile_no=$fetch_student_data['mother_mobile_no'];
    $student_mother_email_id=$fetch_student_data['mother_email_id'];
    $student_mother_qualification=$fetch_student_data['mother_qualification'];
    $student_mother_occupation=$fetch_student_data['mother_occupation'];
    $student_mother_annual_income=$fetch_student_data['mother_annual_income'];
    $student_mother_photo=$fetch_student_data['mother_photo'];
    $temp_mother_photo=$fetch_student_data['mother_photo'];
    
    if(empty($student_mother_photo))
    {
    $student_mother_photo="images/no_avilable_image.gif";    
    }  else {
      $student_mother_photo=$student_mother_photo;    
       
    }
    
    $student_local_parent_relation=$fetch_student_data['local_parent_relation'];
    $student_local_parent_name=$fetch_student_data['local_parent_name'];
    $student_local_parent_mobile_no=$fetch_student_data['local_parent_mobile_no'];
    $student_local_parent_email=$fetch_student_data['local_parent_email_id'];
    $student_local_parent_qualification=$fetch_student_data['local_parent_qualification'];
    $student_local_parent_occupation=$fetch_student_data['local_parent_occupation'];
    $student_local_parent_annual_income=$fetch_student_data['local_parent_annual_income'];
    $student_local_parent_photo=$fetch_student_data['local_parent_photo'];
    $temp_local_parent_photo=$fetch_student_data['local_parent_photo'];
    if(empty($student_local_parent_photo))
    {
    $student_local_parent_photo="images/no_avilable_image.gif";    
    }  else {
      $student_local_parent_photo=$student_local_parent_photo;    
       
    }
    $parent_username=$fetch_student_data['user_name'];
    $parents_pasword=$fetch_student_data['temp_password'];        
    
    
    
    $student_previous_class=$fetch_student_data['previous_class_name'];
    $student_core_subject=$fetch_student_data['previous_class_core_subject'];
    $student_board_university=$fetch_student_data['previous_class_board'];
    $student_passing_year=$fetch_student_data['previous_class_passing_year'];
    $student_per_of_marks=$fetch_student_data['previous_class_per_of_mark'];
    $student_extra_activities=$fetch_student_data['previous_class_extra_activities'];
    $student_school_name=$fetch_student_data['previous_class_school_name'];
    $student_school_address=$fetch_student_data['previous_class_school_address'];
    
    $hostel_status=$fetch_student_data['is_delete'];
    if($hostel_status=="none")
    {
    $student_hostel_id=$fetch_student_data['hostel'];
    $hostel_joining_date=$fetch_student_data['start_service_date'];
    $hostel_description=$fetch_student_data['hostel_description'];  
    $food_prrefred=$fetch_student_data['food_preference'];  
    $student_hostel_room_id=$fetch_student_data['room'];
    }else
    {
    $student_hostel_id="";
    $hostel_joining_date="";
    $hostel_description="";  
    $food_prrefred="";  
    $student_hostel_room_id="";    
    }
    
    $transport_status=$fetch_student_data['is_delete'];
    if($transport_status=="none")
    {
    $student_transport_route_id=$fetch_student_data['route'];
    $student_transport_sub_route=$fetch_student_data['sub_route'];
    $student_transport_joining_date=$fetch_student_data['start_service_date'];
    $student_transport_description=$fetch_student_data['transport_description'];
    $student_transport_vehicle_type_id=$fetch_student_data['vehicle_type'];
    $student_transport_vehicle_reg_no=$fetch_student_data['vehicle'];
    }else
    {
    $student_transport_route_id="";
    $student_transport_sub_route="";
    $student_transport_joining_date="";
    $student_transport_description="";
    $student_transport_vehicle_type_id="";
    $student_transport_vehicle_reg_no="";   
    }
   
    
    $fetch_admission_document=$fetch_student_data['submitted_document'];
    $explode_document_explode=explode("@,@",$fetch_admission_document);
    $implode_document_attechment=implode(",",$explode_document_explode);
    
    
    
    $transport_id=$fetch_student_data['transport_id'];
    $hostel_id=$fetch_student_data['hostel_id'];
    $health_card_id=$fetch_student_data['health_card_id'];
      
    
    $student_db_id=$fetch_student_data['student_id'];
    $student_personal_db_id=$fetch_student_data['student_personal_id'];
    $parent_db_id=$fetch_student_data['parent_id'];
    $previous_class_db_id=$fetch_student_data['previous_class_id'];
     $hostel_db_id=$fetch_student_data['hostel_id'];
     $transport_db_id=$fetch_student_data['transport_id'];
     $health_card_db_id=$fetch_student_data['health_card_id'];     
       ?>        
               
               
               
               <input type="hidden" name="student_db_id" value="<?php echo $student_db_id;?>">
               <input type="hidden" name="student_persoanl_db_id" value="<?php echo $student_personal_db_id;?>">
               <input type="hidden" name="parent_db_id" value="<?php echo $parent_db_id;?>">
               <input type="hidden" name="previous_class_id" value="<?php echo $previous_class_db_id;?>">
               <input type="hidden" name="hostel_db_id" value="<?php echo $hostel_db_id;?>">
               <input type="hidden" name="transport_db_id" value="<?php echo $transport_db_id;?>">
               <input type="hidden" name="health_card_db_id" value="<?php echo $health_card_db_id;?>">
               
               
               
               
               <input type="hidden" name="temp_student_photo" value="<?php echo $temp_student_photo;?>">
               <input type="hidden" name="temp_father_photo" value="<?php echo $temp_father_photo;?>">
               <input type="hidden" name="temp_mother_photo" value="<?php echo $temp_mother_photo;?>">
               <input type="hidden" name="temp_local_parent_photo" value="<?php echo $temp_local_parent_photo;?>">
               
               
            <!--student personal details -->
            
             <div class="admission_setep"  id="form_no_1" style=" display:block; ">
               <table cellspacing="0" cellpadding="0" class="student_details_table">
                   
                  
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   <tr>
                       <td colspan="10">
                           <div class="title_heading"><b>Registration Info</b></div>   
                       </td>
                   </tr>
                   
                 
                   
                   <tr>
                    <td><b>Admission No.</b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" id="admission_no" name="admission_no" class="text_box_styling"
                                  placeholder="Enter admission number" value="<?php echo $admission_no;?>"></td>
                       <td><b>Admission Date</b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" id="admission_date" name="admission_date" class="text_box_styling"
                                  placeholder="Enter admission date" style=" width:165px; " value="<?php echo $student_admission_date;?>"></td>
                       
                       <td><b>Enrollment No.</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" id="enrollment_no" name="enrollment_no" class="text_box_styling"
                                  placeholder="Enter enrollment number" value="<?php echo $enrollment_no;?>"></td>
                       
                   </tr>
                   <tr>
                       <td colspan="10">
                           <div class="title_heading"><b>Class/Section/House Info</b></div>   
                       </td>
                   </tr>
                   
                   <tr>
                       <td><b>Course/Class <sup>*</sup></b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="class_name" name="class_id" onchange="change_class_name(this.value)" class="select_box_style">
                               <option value="0">Select Course/Class</option>   
                             <?php 
                               $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                               while ($fetch_class_data=mysql_fetch_array($class_db))
                               {
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                                if($course_name==$fetch_class_id)
                                {
                               echo "<option value='$fetch_class_id' selected>$fetch_class_name</option>";
                                }else
                                {
                                  echo "<option value='$fetch_class_id'>$fetch_class_name</option>";
                                  
                                }
                               }
                               ?>
                           </select>
                       </td>
                       
                      
                        <td><b>Section <sup>*</sup></b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="section_name" name="section_id" class="select_box_style">
                               <option value="0">--Select--</option>   
                           <?php 
                               $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$course_name' and is_delete='none' ORDER BY section_name ASC");
                               while ($fetch_section_data=mysql_fetch_array($section_db))
                               {
                                $fetch_section_name=$fetch_section_data['section_name'];
                                $fetch_section_id=$fetch_section_data['section_id'];
                                if($section_name==$fetch_section_id)
                                {
                               echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
                                }else
                                {
                                  echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
                                  
                                }
                               }
                               ?>    
                               
                           </select>
                       </td>
                       <td><b>House </b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="house_id" name="house_id" class="select_box_style">
                               <option value="0">Select House</option>  
                               <?php
                               $house_db=mysql_query("SELECT * FROM house_db WHERE $db_main_details_whout_session is_delete='none'");
                               while ($fetch_house_data=mysql_fetch_array($house_db))
                               {
                                $fetch_house_id=$fetch_house_data['house_id'];
                                $fetch_house_name=$fetch_house_data['house_name'];
                                if($house_name==$fetch_house_id)
                                {
                                echo "<option value='$fetch_house_id' selected>$fetch_house_name</option>";
                                }else
                                {
                                 echo "<option value='$fetch_house_id'>$fetch_house_name</option>";
                                   
                                }
                               }
                               ?>
                           </select>
                       </td>

                   </tr>
                   
                   
                   <tr>
                       <td colspan="10">
                           <div class="title_heading"><b>Student Personal Info</b></div>   
                       </td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td><b>Student Name </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" id="student_full_name" name="student_full_name" class="text_box_styling"
                                  placeholder="Enter student name" value="<?php echo $student_full_name;?>"></td>
                       
                       <td><b>Gender </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="student_gender" name="student_gender_id" class="select_box_style">
                              <?php
                              $gender_array=array("male","female","other");
                             foreach($gender_array as $gender)
                              {
                                 if($student_gender==ucwords($gender))
                                 {
                                  echo "<option value='$gender' selected>".ucwords($gender)."</option>"; 
                                 }else
                                 {
                                   echo "<option value='$gender'>".ucwords($gender)."</option>"; 
                                    
                                 }
                              }
                              ?>
                               
                           </select>
                       </td>
                       <td><b>Date Of Birth</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_dob" id="student_date_of_birth" 
                                  class="text_box_styling" style=" width:165px; "
                                  placeholder="Enter date of birth" value="<?php echo $student_dob;?>"></td>
                   </tr>
                   
                   
                   
                   <tr>
                       
                       
                       <td><b>Blood Group</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="student_blood_group" name="student_blood_group" class="select_box_style">
                               <option value="0">Unknow</option>   
                               <?php
                               $blood_froup_array=array("A+","A-","B+","B-","O+","O-","AB+","AB-");
                               foreach ($blood_froup_array as $blood_group)
                               {
                                   if($blood_group==$student_blood_group)
                                   {
                                   echo "<option selected>$blood_group</option>";   
                                   }else
                                   {
                                    echo "<option>$blood_group</option>";     
                                   }  
                                       
                               }
                               ?>  
                              
                           </select>
                       </td>
                       
                       <td><b>Birthplace</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input id="student_birth_place" name="student_birth_place" type="text"
                                  class="text_box_styling" placeholder="Enter Birthplace" value="<?php echo $student_birth_place;?>"></td>
                   
                      
                       <td><b>Nationality</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" id="student_nationality" name="student_nationality" class="text_box_styling" 
                                  placeholder="Enter nationality" value="<?php echo $student_nationality;?>"></td>
                   </tr>
                
                   
                   <tr>
                       <td><b>Religion</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_religion" id="religion" class="text_box_styling" 
                                  placeholder="Enter religion" value="<?php echo $student_religion;?>"></td>
                   
                       
                       <td><b>Mother Tongue</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_mother_tongue" id="mother_tongue" class="text_box_styling"
                                  placeholder="Enter mother tongue" value="<?php echo $student_mother_tongue;?>"></td>
                   
                       <td><b>Category</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="student_category" name="student_category" class="select_box_style">
                               <option value="0">---Select---</option>   
                             <?php
                               $category_db=mysql_query("SELECT * FROM category_db WHERE $db_main_details_whout_session is_delete='none'");
                               while ($fetch_category_data=mysql_fetch_array($category_db))
                               {
                                $fetch_category_id=$fetch_category_data['category_id'];
                                $fetch_category_name=$fetch_category_data['category_name'];
                                if($category_name==$fetch_category_id)
                                {
                                echo "<option value='$fetch_category_id' selected>$fetch_category_name</option>";
                                }else
                                {
                                echo "<option value='$fetch_category_id'>$fetch_category_name</option>";
                                    
                                }
                               }
                               ?>
                               
                           </select>
                       </td>
                       
                       
                   </tr>
                   
                   
                   
                   <tr>
                       <td><b>Sub Category</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_sub_category" id="sub_category" class="text_box_styling"
                                  placeholder="Enter sub category" value="<?php echo $student_sub_category;?>"></td>
             
                       <td><b>Mobile</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_mobile_no" onkeypress="javascript:return isNumber (event)" id="student_mobile_number" class="text_box_styling"
                                  placeholder="Enter mobile number" value="<?php echo $student_mobile;?>"></td>
                   
                       
                       <td><b>Email</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_email_id" id="student_email_id" 
                                  class="text_box_styling" placeholder="Enter email id" value="<?php echo $student_email;?>"></td>
                   
                   
                   </tr>
                   <?php
                       
                   if($studnet_handicapped=="yes")
                   {
                    $yes_check="checked";
                   $no_check="";    
                   }else
                   {
                   $yes_check="";
                   $no_check="checked";        
                   }
                   ?>
                   
                   <tr>
                       <td><b>Handicapped</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <table cellspacing="0" cellpadding="0">
                               <tr>
                                   <td><input type="radio" value="no" name="student_handicapped" <?php echo $no_check;?>></td>
                                   <td>No</td>
                                   <td style=" width:40px; "></td>
                                   <td><input type="radio" value="yes" name="student_handicapped" <?php echo $yes_check;?>></td>
                                   <td>Yes</td>
                                   <td style=" width:40px; "></td>
                               </tr>
                           </table>
                       </td>
                       
                       
                       <td><b>Sub-Status</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="student_handicapped" name="student_sub_status" class="select_box_style">
                               
                               <?php
                               $sub_status_array=array("regular","Private");
                               foreach($sub_status_array as $sub_statuss)
                               {
                                   if(ucwords($sub_statuss)==$sub_status)
                                   {
                                   echo "<option value='$sub_statuss' selected>".ucwords($sub_statuss)."</option>";
                                   }else
                                   {
                                     echo "<option value='$sub_statuss'>".ucwords($sub_statuss)."</option>";
                                     
                                   }
                               }
                               ?>
                             
                           </select>
                       </td>
                        <td>
                            <b>Student photo</b> 
                       </td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input id="student_photo" name="student_photo" type="file">
                       <br/>
                       <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                      
                       
                       </td>
                   </tr>
                   <tr>
                       <td style="height:10px;"></td>
                   </tr>
                   <tr>
                       <td colspan="8"></td>
                       <td>
                            <center><input type="button" onclick="on_show_photo('1')" class="view_button_style" 
                                            value="Student View Photo"></center>
                           
                           <input type="hidden" id="input_photo_1" value="0">
                           <div class="student_photos" id="show_photo_1">
                           <table cellspacing="0" cellpadding="0" class="student_photo_table">
                               <tbody><tr>
                                   <td>Student Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $student_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </tbody></table>    
                           </div>
                       </td>
                   </tr>
                   <tr>
                       <td colspan="9">
                           <div class="title_heading"><b>Student Account Login Info </b></div>   
                       </td>
                   </tr>
                    <tr>
                        <td><b>Username <sup>*</sup></b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_user_name" id="student_user_name" class="text_box_styling"
                                  placeholder="Enter username" value="<?php echo $user_name;?>"></td>
                   
                       
                       <td><b>Password <sup>*</sup></b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_password" id="student_password" class="text_box_styling"
                                  placeholder="Enter password" value="<?php echo $password;?>"></td>
                   
                   
                   </tr>
                   <tr>
                       <td colspan="10"><input type="button"  onclick="return form_no_2('2')"
                                              class="continue_button_styling" value="Next"></td>
                   </tr>
                   
                   
                   
               </table>    
               </div>
               
               
               
               
               
               
               
               
               
               <!--student address details -->
               
               <div class="admission_setep" id="form_no_2">
               <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td colspan="9">
                           <div class="title_heading"><b>Current Address Info</b></div>   
                       </td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td><b>Current Address</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_current_address;?>" name="current_address" id="curr_address" class="text_box_styling" placeholder="Enter current address"></td>
                       
                       <td><b>Nearest Area</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_current_nearest_area;?>" name="current_nearest_address" id="curr_nearest_area" class="text_box_styling" placeholder="Enter nearest area"></td>
                       
                         <td><b>City </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_current_city;?>" name="current_city" id="curr_city" class="text_box_styling" placeholder="Enter city"></td>
                       
                   </tr>
                   
                   
                   <tr>
                     
                       <td><b>District </b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_current_desctric;?>" name="current_desctric" id="curr_desctric" class="text_box_styling" placeholder="Enter district"></td>
                       
                       <td><b>Post</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo  $student_current_post;?>" id="curr_post" name="current_post"
                                  class="text_box_styling" placeholder="Enter post "></td>
                       
                       
                       <td><b>Pin code</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo  $student_current_pincode;?>" name="current_pincode" onkeypress="javascript:return isNumber (event)" id="curr_pincode" class="text_box_styling" placeholder="Enter pincode"></td>
                       
                      
                       
                   </tr>
                   
                   
                   <tr>
                       <td><b>State </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_current_state;?>" name="current_state" id="curr_state" class="text_box_styling" placeholder="Enter state"></td>
                       
                       <td><b>Country</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="curr_country" name="current_country" class="select_box_style">
                               <option value="0">Select Country</option>   
                             <option>Afghanistan</option> <option>Albania</option> <option>Algeria</option> <option>American Samoa</option> <option>Andorra</option> <option>Angola</option> <option>Anguilla</option> <option>Antarctica</option> <option>Antigua and Barbuda</option> <option>Argentina</option> <option>Armenia</option> <option>Aruba</option> <option>Australia</option> <option>Austria</option> <option>Azerbaijan</option> <option>Bahamas</option> <option>Bahrain</option> <option>Bangladesh</option> <option>Barbados</option> <option>Belarus</option> <option>Belgium</option> <option>Belize</option> <option>Benin</option> <option>Bermuda</option> <option>Bhutan</option> <option>Bolivia</option> <option>Bosnia and Herzegovina</option> <option>Botswana</option> <option>Bouvet Island</option> <option>Brazil</option> <option>British Indian Ocean Territory</option> <option>Brunei Darussalam</option> <option>Bulgaria</option> <option>Burkina Faso</option> <option>Burundi</option> <option>Cambodia</option> <option>Cameroon</option> <option>Canada</option> <option>Cape Verde</option> <option>Cayman Islands</option> <option>Central African Republic</option> <option>Chad</option> <option>Chile</option> <option>China</option> <option>Christmas Island</option> <option>Cocos Islands</option> <option>Colombia</option> <option>Comoros</option> <option>Congo</option> <option>Congo, Democratic Republic of the</option> <option>Cook Islands</option> <option>Costa Rica</option> <option>Cote d'Ivoire</option> <option>Croatia</option> <option>Cuba</option> <option>Cyprus</option> <option>Czech Republic</option> <option>Denmark</option> <option>Djibouti</option> <option>Dominica</option> <option>Dominican Republic</option> <option>Ecuador</option> <option>Egypt</option> <option>El Salvador</option> <option>Equatorial Guinea</option> <option>Eritrea</option> <option>Estonia</option> <option>Ethiopia</option> <option>Falkland Islands</option> <option>Faroe Islands</option> <option>Fiji</option> <option>Finland</option> <option>France</option> <option>French Guiana</option> <option>French Polynesia</option> <option>Gabon</option> <option>Gambia</option> <option>Georgia</option> <option>Germany</option> <option>Ghana</option> <option>Gibraltar</option> <option>Greece</option> <option>Greenland</option> <option>Grenada</option> <option>Guadeloupe</option> <option>Guam</option> <option>Guatemala</option> <option>Guinea</option> <option>Guinea-Bissau</option> <option>Guyana</option> <option>Haiti</option> <option>Heard Island and McDonald Islands</option> <option>Honduras</option> <option>Hong Kong</option> <option>Hungary</option> <option>Iceland</option> <option>India</option> <option>Indonesia</option> <option>Iran</option> <option>Iraq</option> <option>Ireland</option> <option>Israel</option> <option>Italy</option> <option>Jamaica</option> <option>Japan</option> <option>Jordan</option> <option>Kazakhstan</option> <option>Kenya</option> <option>Kiribati</option> <option>Kuwait</option> <option>Kyrgyzstan</option> <option>Laos</option> <option>Latvia</option> <option>Lebanon</option> <option>Lesotho</option> <option>Liberia</option> <option>Libya</option> <option>Liechtenstein</option> <option>Lithuania</option> <option>Luxembourg</option> <option>Macao</option> <option>Madagascar</option> <option>Malawi</option> <option>Malaysia</option> <option>Maldives</option> <option>Mali</option> <option>Malta</option> <option>Marshall Islands</option> <option>Martinique</option> <option>Mauritania</option> <option>Mauritius</option> <option>Mayotte</option> <option>Mexico</option> <option>Micronesia</option> <option>Moldova</option> <option>Monaco</option> <option>Mongolia</option> <option>Montenegro</option> <option>Montserrat</option> <option>Morocco</option> <option>Mozambique</option> <option>Myanmar</option> <option>Namibia</option> <option>Nauru</option> <option>Nepal</option> <option>Netherlands</option> <option>Netherlands Antilles</option> <option>New Caledonia</option> <option>New Zealand</option> <option>Nicaragua</option> <option>Niger</option> <option>Nigeria</option> <option>Norfolk Island</option> <option>North Korea</option> <option>Norway</option> <option>Oman</option> <option>Pakistan</option> <option>Palau</option> <option>Palestinian Territory</option> <option>Panama</option> <option>Papua New Guinea</option> <option>Paraguay</option> <option>Peru</option> <option>Philippines</option> <option>Pitcairn</option> <option>Poland</option> <option>Portugal</option> <option>Puerto Rico</option> <option>Qatar</option> <option>Romania</option> <option>Russian Federation</option> <option>Rwanda</option> <option>Saint Helena</option> <option>Saint Kitts and Nevis</option> <option>Saint Lucia</option> <option>Saint Pierre and Miquelon</option> <option>Saint Vincent and the Grenadines</option> <option>Samoa</option> <option>San Marino</option> <option>Sao Tome and Principe</option> <option>Saudi Arabia</option> <option>Senegal</option> <option>Serbia</option> <option>Seychelles</option> <option>Sierra Leone</option> <option>Singapore</option> <option>Slovakia</option> <option>Slovenia</option> <option>Solomon Islands</option> <option>Somalia</option> <option>South Africa</option> <option>South Georgia</option> <option>South Korea</option> <option>Spain</option> <option>Sri Lanka</option> <option>Sudan</option> <option>Suriname</option> <option>Svalbard and Jan Mayen</option> <option>Swaziland</option> <option>Sweden</option> <option>Switzerland</option> <option>Syrian Arab Republic</option> <option>Taiwan</option> <option>Tajikistan</option> <option>Tanzania</option> <option>Thailand</option> <option>The Former Yugoslav Republic of Macedonia</option> <option>Timor-Leste</option> <option>Togo</option> <option>Tokelau</option> <option>Tonga</option> <option>Trinidad and Tobago</option> <option>Tunisia</option> <option>Turkey</option> <option>Turkmenistan</option> <option>Tuvalu</option> <option>Uganda</option> <option>Ukraine</option> <option>United Arab Emirates</option> <option>United Kingdom</option> <option>United States</option> <option>United States Minor Outlying Islands</option> <option>Uruguay</option> <option>Uzbekistan</option> <option>Vanuatu</option> <option>Vatican City</option> <option>Venezuela</option> <option>Vietnam</option> <option>Virgin Islands, British</option> <option>Virgin Islands, U.S.</option> <option>Wallis and Futuna</option> <option>Western Sahara</option> <option>Yemen</option> <option>Zambia</option> <option>Zimbabwe</option> 
                             
                              
                           </select>
                       </td>
                       
                   </tr>
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>    
                       
                 
                 <tr>
                       <td colspan="9">
                           <div class="title_heading"><b>Permanent Address Info</b>
                               <div class="permanent_style">
                                   <input type="hidden" id="check_addres_input" value="0">
                                   <table>
                                       <tr><td><input type="checkbox" id="check_box_checked" class="check_box_styling" 
                                                      onclick="same_address()"></td>
                                           <td>Current address and permanent address will be same</td>
                                       </tr>
                                   </table>
                               </div>
                           </div>   
                       </td>
                   </tr>
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   
                  <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td><b>Permanent Address</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_permanent_address;?>" name="per_address" id="per_address" class="text_box_styling" placeholder="Enter permanent address"></td>
                       
                       <td><b>Nearest Area</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo  $student_permanent_nearest_area;?>" name="per_nearest_area" id="per_nearest_area" class="text_box_styling" placeholder="Enter nearest area"></td>
                       
                        <td><b>City </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_permanent_city;?>" id="per_city" name="per_city" class="text_box_styling" placeholder="Enter city"></td>
                       
                   </tr>
                   
                   
                   <tr>
                      
                       <td><b>District </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_permanent_desctric;?>" id="per_desctric" name="per_desctric" class="text_box_styling" placeholder="Enter district"></td>
                  
                       <td><b>Post</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_permanent_post;?>" id="per_post" name="per_post" class="text_box_styling"
                                  placeholder="Enter post"></td>
                       
                       
                       <td><b>Pin code</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_permanent_pincode;?>" id="per_pincode" onkeypress="javascript:return isNumber (event)" name="per_pincode" class="text_box_styling" placeholder="Enter pincode"></td>
                       
                       
                   </tr>
                   
                   
                   <tr>
                       <td><b>State</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_permanent_state;?>" id="per_state" name="per_state" class="text_box_styling" placeholder="Enter state"></td>
                       
                       
                       <td><b>Country</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="per_country" name="per_country" class="select_box_style">
                               <option value="0">Select Country</option>   
                              <option>Afghanistan</option> <option>Albania</option> <option>Algeria</option> <option>American Samoa</option> <option>Andorra</option> <option>Angola</option> <option>Anguilla</option> <option>Antarctica</option> <option>Antigua and Barbuda</option> <option>Argentina</option> <option>Armenia</option> <option>Aruba</option> <option>Australia</option> <option>Austria</option> <option>Azerbaijan</option> <option>Bahamas</option> <option>Bahrain</option> <option>Bangladesh</option> <option>Barbados</option> <option>Belarus</option> <option>Belgium</option> <option>Belize</option> <option>Benin</option> <option>Bermuda</option> <option>Bhutan</option> <option>Bolivia</option> <option>Bosnia and Herzegovina</option> <option>Botswana</option> <option>Bouvet Island</option> <option>Brazil</option> <option>British Indian Ocean Territory</option> <option>Brunei Darussalam</option> <option>Bulgaria</option> <option>Burkina Faso</option> <option>Burundi</option> <option>Cambodia</option> <option>Cameroon</option> <option>Canada</option> <option>Cape Verde</option> <option>Cayman Islands</option> <option>Central African Republic</option> <option>Chad</option> <option>Chile</option> <option>China</option> <option>Christmas Island</option> <option>Cocos Islands</option> <option>Colombia</option> <option>Comoros</option> <option>Congo</option> <option>Congo, Democratic Republic of the</option> <option>Cook Islands</option> <option>Costa Rica</option> <option>Cote d'Ivoire</option> <option>Croatia</option> <option>Cuba</option> <option>Cyprus</option> <option>Czech Republic</option> <option>Denmark</option> <option>Djibouti</option> <option>Dominica</option> <option>Dominican Republic</option> <option>Ecuador</option> <option>Egypt</option> <option>El Salvador</option> <option>Equatorial Guinea</option> <option>Eritrea</option> <option>Estonia</option> <option>Ethiopia</option> <option>Falkland Islands</option> <option>Faroe Islands</option> <option>Fiji</option> <option>Finland</option> <option>France</option> <option>French Guiana</option> <option>French Polynesia</option> <option>Gabon</option> <option>Gambia</option> <option>Georgia</option> <option>Germany</option> <option>Ghana</option> <option>Gibraltar</option> <option>Greece</option> <option>Greenland</option> <option>Grenada</option> <option>Guadeloupe</option> <option>Guam</option> <option>Guatemala</option> <option>Guinea</option> <option>Guinea-Bissau</option> <option>Guyana</option> <option>Haiti</option> <option>Heard Island and McDonald Islands</option> <option>Honduras</option> <option>Hong Kong</option> <option>Hungary</option> <option>Iceland</option> <option>India</option> <option>Indonesia</option> <option>Iran</option> <option>Iraq</option> <option>Ireland</option> <option>Israel</option> <option>Italy</option> <option>Jamaica</option> <option>Japan</option> <option>Jordan</option> <option>Kazakhstan</option> <option>Kenya</option> <option>Kiribati</option> <option>Kuwait</option> <option>Kyrgyzstan</option> <option>Laos</option> <option>Latvia</option> <option>Lebanon</option> <option>Lesotho</option> <option>Liberia</option> <option>Libya</option> <option>Liechtenstein</option> <option>Lithuania</option> <option>Luxembourg</option> <option>Macao</option> <option>Madagascar</option> <option>Malawi</option> <option>Malaysia</option> <option>Maldives</option> <option>Mali</option> <option>Malta</option> <option>Marshall Islands</option> <option>Martinique</option> <option>Mauritania</option> <option>Mauritius</option> <option>Mayotte</option> <option>Mexico</option> <option>Micronesia</option> <option>Moldova</option> <option>Monaco</option> <option>Mongolia</option> <option>Montenegro</option> <option>Montserrat</option> <option>Morocco</option> <option>Mozambique</option> <option>Myanmar</option> <option>Namibia</option> <option>Nauru</option> <option>Nepal</option> <option>Netherlands</option> <option>Netherlands Antilles</option> <option>New Caledonia</option> <option>New Zealand</option> <option>Nicaragua</option> <option>Niger</option> <option>Nigeria</option> <option>Norfolk Island</option> <option>North Korea</option> <option>Norway</option> <option>Oman</option> <option>Pakistan</option> <option>Palau</option> <option>Palestinian Territory</option> <option>Panama</option> <option>Papua New Guinea</option> <option>Paraguay</option> <option>Peru</option> <option>Philippines</option> <option>Pitcairn</option> <option>Poland</option> <option>Portugal</option> <option>Puerto Rico</option> <option>Qatar</option> <option>Romania</option> <option>Russian Federation</option> <option>Rwanda</option> <option>Saint Helena</option> <option>Saint Kitts and Nevis</option> <option>Saint Lucia</option> <option>Saint Pierre and Miquelon</option> <option>Saint Vincent and the Grenadines</option> <option>Samoa</option> <option>San Marino</option> <option>Sao Tome and Principe</option> <option>Saudi Arabia</option> <option>Senegal</option> <option>Serbia</option> <option>Seychelles</option> <option>Sierra Leone</option> <option>Singapore</option> <option>Slovakia</option> <option>Slovenia</option> <option>Solomon Islands</option> <option>Somalia</option> <option>South Africa</option> <option>South Georgia</option> <option>South Korea</option> <option>Spain</option> <option>Sri Lanka</option> <option>Sudan</option> <option>Suriname</option> <option>Svalbard and Jan Mayen</option> <option>Swaziland</option> <option>Sweden</option> <option>Switzerland</option> <option>Syrian Arab Republic</option> <option>Taiwan</option> <option>Tajikistan</option> <option>Tanzania</option> <option>Thailand</option> <option>The Former Yugoslav Republic of Macedonia</option> <option>Timor-Leste</option> <option>Togo</option> <option>Tokelau</option> <option>Tonga</option> <option>Trinidad and Tobago</option> <option>Tunisia</option> <option>Turkey</option> <option>Turkmenistan</option> <option>Tuvalu</option> <option>Uganda</option> <option>Ukraine</option> <option>United Arab Emirates</option> <option>United Kingdom</option> <option>United States</option> <option>United States Minor Outlying Islands</option> <option>Uruguay</option> <option>Uzbekistan</option> <option>Vanuatu</option> <option>Vatican City</option> <option>Venezuela</option> <option>Vietnam</option> <option>Virgin Islands, British</option> <option>Virgin Islands, U.S.</option> <option>Wallis and Futuna</option> <option>Western Sahara</option> <option>Yemen</option> <option>Zambia</option> <option>Zimbabwe</option> 
                              
                           </select>
                       </td>
                       
                   </tr>
                     
                   <tr>
                       <td style=" height:20px; "></td>
                   </tr>
                   <tr>
                        <td><input type="button" onclick="per_form_no_1('1')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="9"><input type="button" onclick="return form_no_3('3')" class="continue_button_styling" value="Next"></td>
                   </tr>
                   
                   
                   
               </table>    
               </div>
               
               
               
               <script type="text/javascript">
               function parents_check(value_check)
               {
                  if(value_check=="new")
                  {
                    document.getElementById("existing_parent").style.display="none";  
                    document.getElementById("new_parent").style.display="block";  
                  }else
                      if(value_check=="exist")
                  {
                   document.getElementById("new_parent").style.display="none"; 
                   document.getElementById("existing_parent").style.display="block"; 
                  }
               }
               </script>
               
               
               
               
               
                 <!--student father/parents/guardian details -->
               
               <div class="admission_setep" id="form_no_3" style=" display:none; ">
                   <table cellspacing="0" cellpadding="0" class="student_details_table" style=" margin-top:18px; ">
                   <tr>
                       <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                  
                       <td colspan="6">
                           <div class="parents_select_option">
                               <table cellspacing="0" cellpadding="0" style=" margin:0 auto; ">
                                   <tr>
                                       <td><input class="radio_check" id="new_parent_check" onclick="parents_check('new')" value="new" type="radio" name="parent_option" checked></td><td><b>New Parent</b></td>
                                       <td style=" width:40px; "></td>
                                       <td><input class="radio_check" id="exist_parent_check" onclick="parents_check('exist')" value="exist" type="radio" name="parent_option"></td><td><b>Existing Parent</b></td>
                                   </tr>
                               </table>   
                           </div>   
                       </td>
                   </tr>
                   </table>
                   
                   <div id="new_parent">
                   <table cellspacing="0" cellpadding="0" class="student_details_table" >
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Parents/Guardian Info</b></div>   
                       </td>
                       <td style=" width:20px; "></td>
                        <td colspan="3">
                           <div class="title_heading"><b>Local Guardian Info</b></div>   
                       </td>
                   </tr>
                   
                   
                   <tr>
                       <td colspan="3"><div class="title_heading" style=" width:100%; color:royalblue; font-size:12px;   "><b>Father Info</b></div></td>
                       <td colspan="3"><div class="title_heading" style=" width:100%; font-size:12px; color:royalblue; "><b>Mother Info</b></div></td>
                       <td></td>
                       <td colspan="3"><div class="title_heading" style=" width:100%; font-size:12px; color:royalblue; "><b>Local Guardian Info</b></div></td>
               
                   </tr>
                   
                   <tr>
                       <td style=" width:105px; "><b>Father Name </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_name;?>" name="student_father_name" id="father_name" class="text_box_styling" placeholder="Enter father name"></td>
                       
                       <td style=" width:105px; "><b>Mother Name</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_name;?>"  name="student_mother_name" id="mother_name" class="text_box_styling" placeholder="Enter mother name"></td>
                       <td></td>
                       
                       <td style=" width:122px; "><b>Guardian Relation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="gur_relation" value="<?php echo $student_local_parent_relation;?>"  name="guardian_relation" type="text" class="text_box_styling"
                                  placeholder="Enter local guardian relation"></td>
                       
                   </tr>
                    
                    
                    
                    <tr>
                       <td><b>Mobile No. </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_mobile_no;?>"  onkeypress="javascript:return isNumber (event)" name="student_father_mobile_no" id="father_mobile_no" class="text_box_styling"
                                  placeholder="Enter father mobile number"></td>
                       
                       <td><b>Mobile No.</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_mobile_no;?>"  onkeypress="javascript:return isNumber (event)" name="student_mother_mobile_no" id="mother_mobile_no" class="text_box_styling"
                                  placeholder="Enter mother mobile number"></td>
                    
                       <td></td>
                       
                         
                       <td><b>Guardian Name</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_name;?>"  name="guardian_full_name" id="gur_name" class="text_box_styling" 
                                  placeholder="Enter local guardian name"></td>
                 
                    </tr>
                    
                    
                    <tr>
                        <td><b>Email</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_email_id;?>"  name="student_father_email_id" id="father_email_od" class="text_box_styling"
                                  placeholder="Enter father email id"></td>
                       
                       <td><b>Email</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_email_id;?>"  name="student_mother_email_id" id="mother_email_id" class="text_box_styling"
                                  placeholder="Enter mother email id"></td>
                 <td></td>
                 <td><b>Mobile No. </b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_mobile_no;?>"  onkeypress="javascript:return isNumber (event)" name="guardian_mobile_no" id="gur_mobile_no" class="text_box_styling"
                                  placeholder="Enter mobile no"></td>
                     
                    </tr>
                    
                    <tr>
                        <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_qualification;?>"  name="student_father_qualification" id="father_qualification" class="text_box_styling"
                                  placeholder="Enter father qualification"></td>
                       
                       <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_qualification;?>"  name="student_mother_qualification" id="mother_qualification" class="text_box_styling"
                                  placeholder="Enter mother qualification"></td>
                   
                      <td></td>

                      <td><b>Email Id</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_email;?>"  name="guardian_email_id" id="gur_email_id" class="text_box_styling"
                                  placeholder="Enter email id"></td>
                       
                    </tr>
                  
                 
                    
                    <tr>
                        <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_occupation;?>"  name="student_father_occupation" id="father_occupation" class="text_box_styling"
                                  placeholder="Enter father occupation"></td>
                       
                       <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_occupation;?>"  name="student_mother_occupation" id="mother_occupation" class="text_box_styling" 
                                  placeholder="Enter mother occupation"></td>
                       <td></td>

                       <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_qualification;?>"  name="guardian_qualification" id="gur_qualification" class="text_box_styling"
                                  placeholder="Enter qualification"></td>
                      
                    </tr>
                    
                    
                    <tr>
                        <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_annual_income;?>"  onkeypress="javascript:return isNumber (event)" name="student_father_annual_income" id="father_income" class="text_box_styling" 
                                  placeholder="Enter father annual income"></td>
                       
                       <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_annual_income;?>"  onkeypress="javascript:return isNumber (event)" name="student_mother_annual_income" id="mother_income" class="text_box_styling" 
                                  placeholder="Enter mother annual income"></td>
                       <td></td>
                          
                       <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_occupation;?>"  name="guardian_occupation" id="gur_occupation" class="text_box_styling"
                                  placeholder="Enter occupation"></td>
                       
                       
                    </tr>
                    
                    
                     <tr>
                        <td><b>Father Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="father_photo"  name="student_father_photo" type="file"><br/>
                       <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       </td>
                       
                       <td><b>Mother Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="mother_photo" name="student_mother_photo" type="file"><br/>
                           <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       
                       </td>
                       <td></td>
                       <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_annual_income;?>"  onkeypress="javascript:return isNumber (event)" name="guardian_annual_income" id="gur_annual_income" class="text_box_styling"
                                  placeholder="Enter annual income"></td>
                      
                      
                      
                  
                       
                    </tr>
                    
                       
                    <tr>
                        <td colspan="7"></td>
                        <td><b>Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="gur_photo" name="guardian_photo" type="file">
                       <br/>
                           <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       </td>
                       
                        </tr>
                        
                        <tr>
                       <td colspan="2"></td>
                       <td>
                            <center><input type="button" onclick="on_show_photo('2')" class="view_button_style" 
                                            value="Father View Photo"></center>
                           
                           <input type="hidden" id="input_photo_2" value="0">
                           <div class="student_photos" id="show_photo_2">
                           <table cellspacing="0" cellpadding="0" class="student_photo_table">
                               <tbody><tr>
                                   <td>Father Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $student_father_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </tbody></table>    
                           </div>
                       </td> 
                       
                       <td colspan="2"></td>
                       <td>
                            <center><input type="button" onclick="on_show_photo('3')" class="view_button_style" 
                                            value="Mother View Photo"></center>
                           
                           <input type="hidden" id="input_photo_3" value="0">
                           <div class="student_photos" id="show_photo_3">
                           <table cellspacing="0" cellpadding="0" class="student_photo_table">
                               <tbody><tr>
                                   <td>Mother Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $student_mother_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </tbody></table>    
                           </div>
                        </td> 
                        
                        
                        <td colspan="3"></td>
                       <td>
                           <br/>
                            <center><input type="button" onclick="on_show_photo('4')" class="view_button_style" 
                                            value="Local Guardian View Photo"></center>
                           
                           <input type="hidden" id="input_photo_4" value="0">
                           <div class="student_photos" id="show_photo_4">
                           <table cellspacing="0" cellpadding="0" class="student_photo_table">
                               <tbody><tr>
                                   <td>Local Guardian Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $student_local_parent_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </tbody></table>    
                           </div>
                        </td> 
                        </tr>
                        
                        <tr>
                       <td colspan="12">
                           <div class="title_heading"><b>Parent Account Login Info </b></div>   
                       </td>
                   </tr>
                  
                   
                   
                    <tr>
                        <td><b>Username <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="parent_user_name" id="parent_user_name" class="text_box_styling"
                                  placeholder="Enter username" value="<?php echo $parent_username;?>"></td>
                   
                       
                       <td><b>Password <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="parent_password" id="parent_password" class="text_box_styling"
                                  placeholder="Enter password" value="<?php echo $parents_pasword;?>"></td>
                   </tr>
                   </table>
                   </div>
                   
                   
                   
                   <div id="existing_parent" style=" display:none; width:100%; margin-top:30px; margin-bottom:30px;
                        height:auto; float:left;   ">
                       <div style=" width:100%; height:auto; float:left;    ">
                       <table style=" width:auto; height:auto; margin:0 auto;   ">
                           <tr>
                               <td style=" font-size:15px; "><b>Parent</b> <sup>*</sup></td>
                               <td style=" width:70px; text-align:center;  "><b>:</b></td>
                               <td>
                                   <select id="parent_id" name="parent_id" onchange="parents_id(this.value)"
                                           data-placeholder='Select Parent' style=" width:700px; color:black;  " class='chosen-select' tabindex='5'>
                                       <option value="0"></option>
<?php 
 $row=0;
               $parants_match=array();
               $parents_db=mysql_query("SELECT *,T6.encrypt_id as parent_encrypt_id,T6.id as parent_db_id  FROM parent_db as T6 "
                       . "LEFT JOIN student_db as T1 ON T6.parent_unique_id=T1.parent_id "
                       . "WHERE $db_t1_main_details T1.is_delete='none' OR T6.organization_id='$fetch_school_id'"
                       . " and T6.branch_id='$fetch_branch_id' and T6.session_id='$fecth_session_id_set' and T6.is_delete='none'");
               while ($parent_data=mysql_fetch_array($parents_db))
               {
               $parent_unique_id=$parent_data['parent_unique_id'];
                     
                if(in_array($parent_unique_id,$parants_match)==false)   
                {  
                 $row++;
                 $parent_db_id=$parent_data['parent_db_id'];
                 $parent_encrypt_id=$parent_data['parent_encrypt_id'];
                 $father_name=$parent_data['father_name'];
                 $father_mobile_no=$parent_data['father_mobile_no'];
                 $mother_name=$parent_data['mother_name'];
                 $mother_mobile_no=$parent_data['mother_mobile_no'];
                 
                 array_push($parants_match, $parent_unique_id);
$student_array=array();
 $student_db=mysql_query("SELECT *,T1.encrypt_id as student_encrypt_id FROM student_db as T1 "
                         . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                         . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                         . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id WHERE T1.parent_id='$parent_unique_id' and T1.is_delete='none'");
$student_num_rows=mysql_num_rows($student_db);

 while ($fetch_student_data=mysql_fetch_array($student_db))
 {

    $student_full_name=ucwords($fetch_student_data['student_full_name']);
    $student_gender=ucfirst($fetch_student_data['student_gender']); 

array_push($student_array,$student_full_name);
}

$student_name_impode=implode(',',$student_array);
if(!empty($student_name_impode))
{
$student_option="{ Children : $student_name_impode }";
}else
{
$student_option="";
}

echo "<option value='$parent_unique_id'>$father_name { Mob. : $father_mobile_no } { ID : $parent_db_id } $student_option</option>";
                 
}
}
?>

                                    </select>
                               </td>
                           </tr>   
                       </table> 
                       </div>
                       
                       <div class="parent_details"></div>
                       
                   </div>
               
                   
                   
                   <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="2"><input type="button" onclick="per_form_no_2('2')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="9"><input type="button" onclick="return form_no_4('4')" class="continue_button_styling" value="Next"></td>
                   </tr>
                   </table>    
               </div>
               
               
               
               
               
               
               
               <script type="text/javascript">
                 var count_no=0; 
                 function add_document()
                 {
                    
                     var other_document=document.getElementById("other_document").value;
                     if(other_document==0)
                         {
                            alert("Please fill other document");
                            document.getElementById("other_document").focus();
                            return false;
                         }else
                             {
   
    var table=document.getElementById("other_document_table");
    var row = table.insertRow(0);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    
    cell1.innerHTML ="<input type='checkbox' name='document_submitted[]' value='"+other_document+"' checked>";
    cell2.innerHTML=""+other_document+"";
    cell3.innerHTML="<input type='button' class='remove_button_style' onclick='removeen(this)' value='Remove'>"
   document.getElementById("other_document").value="";
    
                        }
                 }
                 
function removeen(row)
{   

var r=confirm("Are you sure you want to remove");
if (r==true)
  {
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('other_document_table').deleteRow(i);   
  }
}
               </script>
               
               
               
               
               <div class="admission_setep" id="form_no_4" style=" display:none; ">
               <table cellspacing="0" cellpadding="0" class="student_details_table" style=" font-size:12px; ">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Previous Class Details</b></div>   
                       </td>
                   </tr>
                   
                   
                 
                   <tr>
                       <td><b>Previous Course/Class </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_previous_class;?>" name="pervious_class" id="previous_class" class="text_box_styling" placeholder="Enter previous course/class"></td>
                       
                       <td><b>Core Subject</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_core_subject;?>" name="core_subject" id="core_subject" class="text_box_styling" placeholder="Enter core subject"></td>
                    </tr>
                    
                    <tr>
                       <td><b>Board/University</b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_board_university;?>" name="board_university" id="board_university" class="text_box_styling" placeholder="Enter board/university"></td>
                       
                       <td><b>Passing Year</b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_passing_year;?>" name="passing_year" id="passing_year" class="text_box_styling" placeholder="Enter year of passing"></td>
                    </tr>
                    
                    <tr>
                        <td><b>%Of Marks </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_per_of_marks;?>" name="per_of_marks" id="per_of_mark" class="text_box_styling" placeholder="Enter %of marks"></td>
                       
                       <td><b>Extra Curricular Activities</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_extra_activities;?>" name="extra_activities" class="text_box_styling" placeholder="Enter extra curricular activities"></td>
                    </tr>
                    
                    <tr>
                       <td><b>School/Collage Name </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_school_name;?>" name="school_name" id="previous_school_name" class="text_box_styling" placeholder="Enter school/collage name "></td>
                       
                       <td><b>School/Collage Address </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_school_address;?>" name="school_address" id="previous_school_address" class="text_box_styling" placeholder="Enter school/collage address"></td>
                    </tr>
                    
                    
                   
                    
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>    
                  <tr>
                       <td colspan="6">
                       <div class="title_heading"><b>Document Submitted</b></div>   
                       </td>
                   </tr>
                   <tr>
                       <td colspan="6">
                        <table cellspacing="0" cellpadding="0" style=" margin:0 auto; ">
                            <tr>
                                <td colspan="2" style=" padding-bottom:0px; "><b>Document Submitted Required <sup>*</sup></b></td>
                            </tr>
                            <tr><td colspan="4"><div class="verticle_line"></div></td></tr>
                            <tr>
                                <td colspan="5" style=" width:700px; ">
                                    <div style=" width:500px; float:left; ">
                                 <?php
                                 
                                 
                                 $document_submit=array("Transfer Certificate (Original)","Caste Certificate","Previous Class Result"
                                     ,"Domicile Certificate","Character Certificate","Father Income Certificate");
                                $temp_document_file=array(); 
                                 foreach($explode_document_explode as $temp_document_name)
                                 {
                                 if(in_array($temp_document_name,$document_submit)==true)
                                 {
                                     
                                 }else
                                 {
                                     array_push($temp_document_file,$temp_document_name);    
                                 }
                                 }
                                
                                 foreach ($document_submit as $document)
                                 {
                                 if(in_array($document,$explode_document_explode)==true)
                                 {
                    echo "<div style='width:45%; float:left;'><input type='checkbox' name='document_submitted[]' value='$document' checked>$document</div>";   
                                 }else
                                 {
                                   echo "<div style='width:45%; float:left;'><input type='checkbox' name='document_submitted[]' value='$document'>$document</div>";   
                       
                                 }
                                }
                                 ?>  
                                  
                                    </div>
                                    <table cellspacing="0" cellpadding="0" id="other_document_table" style="width:150px;  float:left; ">
                                     <?php
                                     foreach($temp_document_file as $temp_document)
                                     {
                                         echo "<tr><td><input type='checkbox' name='document_submitted[]' value='$temp_document' checked></td>"
                                                 . "<td>$temp_document</td>"
                                                 . "<td><input type='button' class='remove_button_style' onclick='removeen(this)' value='Remove'></td></tr>";      
                                     }
                                     ?>   
                                    </table> 
                                </td>    
                                
                            </tr>
                            <tr><td colspan="4"><div class="verticle_line"></div></td></tr>
                            <tr>
                                <td colspan="4">
                                    <table>
                                         <tr>
                                <td colspan="2">Other Document : <input id="other_document" type="text"></td>
                             <td colspan="2"><input type="button" onclick="add_document()" class="add_document" value="Add"></td>
                            </tr>
                                    </table>
                                </td>
                            </tr>
                   </table>   
                       </td>
                   </tr>
                   
                    <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                        <td><input type="button" onclick="per_form_no_3('3')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="5">
                           <input type="button" onclick="return form_no_5('5')"
                                  class="continue_button_styling" value="Next">
              <input type="button" onclick="return skip_form_no_5('5')"
                                  class="continue_button_styling" style=" margin-right:20px; " value="Skip">
              
                  
                   
                       </td>
                   </tr>
                   
                   
                   
               </table>    
               </div>
               
               
  <?php 
 if(module("health_card",$explode_module_array)==1)
 {
 ?>
               
               <div class="admission_setep" id="form_no_5">
              <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Health Card</b></div>   
                       </td>
                   </tr>
                   
                   <tr>
                       <td colspan="10">
                           <table style=" width:100%; ">
                              <tr>
                       <td><b>Allergies?</b></td><td><b>:</b></td>
                       <td><table><tr><td><input type="radio" name="allergy" value="no" checked></td><td>No</td>
                                   <td><input type="radio" name="allergy" value="yes"></td><td>Yes</td></tr></table></td>
                                   <td><b>What is the allergy to ? (foods,drugs,etc.)</b></td>
                                   <td><b>:</b></td>
                                   <td><textarea placeholder="Enter what is the allergies" class="health_text"></textarea></td>
                       <td><b>Reaction:</b></td>
                       <td><b>:</b></td>
                       <td><textarea class="health_text" placeholder="Enter reaction"></textarea></td>
                   </tr> 
                           </table>
                       </td>
                   </tr>
                   
                   
                   <tr>
                       <td colspan="10"><b>Ever had a serious respiratory reaction to a food, bee sting or a drug?</b></td>
                   </tr>
                   
                   
                   
                   
                    <tr>
                       <td colspan="10">
                           <table>
                   
                   <tr>
                       <td><b>Asthma?</b></td><td><b>:</b></td>
                       <td><table><tr><td><input type="radio" checked></td><td>No</td>
                                   <td><input type="radio"></td><td>Yes</td></tr></table></td>
                                   <td style=" width:260px; "><b>Does the student carry an asthma inhaler? </b></td><td><b>:</b></td>
                     <td><table><tr><td><input type="radio" checked></td><td>No</td>
                                   <td><input type="radio"></td><td>Yes</td></tr></table></td>
                    
                   </tr>
                           </table>
                       </td>
                    </tr>
                    
                    
                    
                    
                     <tr>
                       <td colspan="10">
                        <table>
                      <tr>
                       <td><b>Is the student on regular medication:</b></td><td><b>:</b></td>
                       <td><table><tr><td><input type="radio"></td><td>No</td><td><input type="radio"></td><td>Yes</td></tr></table></td>
                     <td><b>Name of the medication/s: </b></td><td><b>:</b></td>
                     <td><textarea style=" width:220px; " placeholder="Enter medication/s"></textarea></td>
                     <td style=" width:220px; "><b>Does the student need to take any medication/s during school hours?  </b></td><td><b>:</b></td>
                     <td><table><tr><td><input type="radio" checked></td><td>No</td><td><input type="radio"></td><td>Yes</td></tr></table></td>
                     
                   </tr>
                    </table>
                           </td>
                           </tr>
                 
                   <tr>
                       <td colspan="10">
                        <b>If so, a letter from the Medical Doctor must be kept on file in the School Health Clinic and the medication/s kept in the Clinic to be dispensed by the School doctor or nurse.)   
                        </b>  </td>
                   </tr>
                   
                   <tr>
                       <td colspan="10">
                        <table>
                   <tr>
                       <td><b>Does the child have any present illness:  </b></td><td><b>:</b></td>
                       <td><table><tr><td><input type="radio" checked></td><td>No</td><td><input type="radio"></td><td>Yes</td></tr></table></td>
                    <td><b>Describe </b></td><td><b>:</b></td>
                    <td><textarea class="health_text" placeholder="Enter describe"></textarea></td>
                   </tr>
                        </table>
                       </td>
                   </tr>
                   
                   
                      <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   
                    <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Health History</b></div>   
                       </td>
                   </tr>
                   
                   <tr>
                       <td colspan="10">
                           <table cellspacing="0" style=" width:100%; ">
                               <tr class="top_health_heading">
                                   <td>Disease</td>
                                   <td>No</td>
                                   <td>Yes</td>
                                   <td>Age</td>
                                   
                                   <td>Disease</td>
                                   <td>No</td>
                                   <td>Yes</td>
                                   <td>Age</td>
                                   
                                   <td>Disease</td>
                                   <td>No</td>
                                   <td>Yes</td>
                                   <td>Age</td>
                                   
                                   <td>Disease</td>
                                   <td>No</td>
                                   <td>Yes</td>
                                   <td>Age</td>
                               </tr>
                               <tr class="td_health_style">
                                   <td><b>Skin Problem</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td><input type="text" class="age_text_box"></td>
                                   
                                   <td><b>Asthma</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td><input type="text" class="age_text_box"></td>
                                   
                                   <td><b>Diabetes</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td ><input type="text" class="age_text_box"></td>
                            
                                   <td><b>Heart Disorder</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td style=" border-right:1px solid black; "><input type="text" class="age_text_box"></td>
                            
                               </tr>
                               
                               <tr class="td_health_style">
                                   <td><b>Meningitis</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td><input type="text" class="age_text_box"></td>
                                   
                                   <td><b>Urinary Disorder</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td><input type="text" class="age_text_box"></td>
                                   
                                   <td><b>Tuberculosis</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td ><input type="text" class="age_text_box"></td>
                            
                                   <td><b>Epilepsy</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td style=" border-right:1px solid black; "><input type="text" class="age_text_box"></td>
                            
                               </tr>
                               
                               <tr class="td_health_style">
                                   <td><b>Fainting Spells</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td><input type="text" class="age_text_box"></td>
                                   
                                   <td><b>Scoliosis</b></td><td><input type="radio" checked=""></td><td><input type="radio"></td>
                                   <td style=" border-right:1px solid black; "><input type="text" class="age_text_box"></td>
                                   
                                   
                               </tr>
                               
                           </table>     
                           
                       </td>
                   </tr>
                   
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   
                   <tr>
                        <td><input type="button" onclick="per_form_no_4('4')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="5">
                          <input type="button" onclick="return form_no_6('6')" class="continue_button_styling" value="Next">
                          <input type="button" onclick="return skip_form_no_6('6')" class="continue_button_styling" style=" margin-right:10px; " value="Skip">
                         
                       
                       </td>
                   </tr>
              </table>
              </div> 
             <?php
 }
             ?>  
               
               
 <?php 
 if(module("hostel",$explode_module_array)==1)
 {
 ?>
               <div class="admission_setep" id="form_no_6"  >
           
               <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Allocate Hostel</b></div>   
                       </td>
                   </tr>
                     <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td><b>Hostel </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="hostel_id" onchange="hostel_unique_name(this.value)" data-placeholder="Select Hostel" name="hostel_id" class="chosen-select"
                                   tabindex="-1" style=" width:330px; ">
                               <option value="0"></option>   
                              <?php
                               $hostel_type_db=  mysql_query("SELECT * FROM hostel_type_db WHERE $db_main_details is_delete='none'");
                               while ($hostel_type_data=mysql_fetch_array($hostel_type_db))
                               {
                                $hostel_type_id=$hostel_type_data['hostel_type_unique_id'];
                                 $hostel_type=$hostel_type_data['hostel_type'];   
                                 $hostel_db=mysql_query("SELECT * FROM hostel_db WHERE $db_main_details hostel_type_id='$hostel_type_id' and is_delete='none'");
                                 $hostel_num_rows=mysql_num_rows($hostel_db);
                                 if(!empty($hostel_num_rows))
                                 {
                                 
                                 echo "<optgroup label='$hostel_type'>";      
                               while ($hostel_data=mysql_fetch_array($hostel_db))
                               {
                                  $hostel_unique_id=$hostel_data['hostel_unique_id'];
                                  $hostel_name=$hostel_data['hostel_name'];
                                  if($student_hostel_id==$hostel_unique_id)
                                  {
                                  echo "<option value='$hostel_unique_id' selected>$hostel_name</option>";
                                  }else
                                  {
                                    echo "<option value='$hostel_unique_id'>$hostel_name</option>";
                                    
                                  }
                                  
                               } 
                               echo "</optgroup>"; 
                               }
                               }
                                
                                     
                               
                               ?>
                                
                           </select>
                       </td>
                  
                       <td><b>Room No.</b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <div id="room_div">
                           <select id="hostel_room_id" tabindex="-1" data-placeholder="Select Room" name="hostel_room_id" class="chosen-select" style=" width:330px; ">
                               <option value="0"></option>
                           <?php
    $hostel_room_db=mysql_query("SELECT * FROM hostel_room_db WHERE $db_main_details hostel_id='$student_hostel_id' and is_delete='none'");
    while ($fetch_class_data=mysql_fetch_array($hostel_room_db))
    {
        $fetch_hostel_id=$fetch_class_data['room_unique_id'];
        $fetch_hostel_name=$fetch_class_data['room_no'];
        if($fetch_hostel_id==$student_hostel_room_id)
        {
        echo "<option value='$fetch_hostel_id' selected>$fetch_hostel_name { Availability : 0 }</option>";
        }else
        {
         echo "<option value='$fetch_hostel_id'>$fetch_hostel_name { Availability : 0 }</option>";
           
        }
    }
                           ?>
                           </select></div>
                       </td>
                   </tr>
                       
                   <tr>
                       <td><b>Joining Date</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" readonly="readonly" name="hostel_joining_date" id="hotel_joining_date"
                                  class="text_box_styling" value="<?php if(!empty($hostel_joining_date)){ echo $hostel_joining_date; }else{ echo $date; }?>" style=" background-color:whitesmoke;  width:290px; " placeholder="Enter Joining date"></td>
                   
                       
                       
                        <td><b>Food Preference </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="food_preference" name="food_preference" class="select_box_style" 
                                   style=" width:330px; ">
                               
                               <?php
                               $food_array=array("veg","non_veg","both");
                               foreach ($food_array as $food)
                               {
                                   if($food==$food_prrefred)
                                   {
                                   echo "<option value='$food' selected>".ucwords($food)."</option>";   
                                   }else
                                   {
                                     echo "<option value='$food'>".ucwords($food)."</option>";   
                                    }
                               }
                               ?>
                               
                           </select>
                       </td>
                       
                   </tr>
                   <tr>

                       <td><b>Description</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <textarea name="hostel_description" id="hostel_description" class="text_area_class"><?php echo $hostel_description;?></textarea>
                       </td>                       
                   </tr>
                     <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td style=" height:50px; "></td>
                   </tr>
                   
                   <tr>
                        <td><input type="button" onclick="per_form_no_5('5')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="9">
                          <input type="button" onclick="form_no_7('7')" class="continue_button_styling" value="Next">
                             <input type="button" onclick="skip_form_no_7('7')" class="continue_button_styling" style=" margin-right:10px; " value="Skip">
                         
                       
                       </td>
                   </tr>
               </table>
              </div>  
               
             <?php 
               }
            ?>
               
             <?php 
 if(module("transport",$explode_module_array)==1)
 {
 ?>  
               <div class="admission_setep" id="form_no_7" >
              <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Allocate Transport</b></div>   
                       </td>
                   </tr>
                     <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td><b>Route </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <style>
                             #route_id_chosen{ width:300px; } 
                             .active-result { font-size:12px; }
                                            </style>
                           <div id="room_div">
                           <select id="route_id" onchange="change_route_id(this.value)" name="transport_route_id"
                                   tabindex="-1" data-placeholder="Select Route" class="chosen-select"  style=" width:300px; ">
                               <option value="0"></option>   
                             <?php 
                               $route_db=mysql_query("SELECT * FROM transport_route_db WHERE $db_main_details is_delete='none'");
                               while ($fetch_route_data=mysql_fetch_array($route_db))
                               {
                                $fetch_route_id=$fetch_route_data['route_id'];
                                $fetch_route_name=$fetch_route_data['route_name'];
                                $fetch_route_code=$fetch_route_data['route_code'];
                                $sub_route=$fetch_route_data['sub_route_name'];
                                if(!empty($fetch_route_code))
                                {
                                $fetch_route_code=" { Route Code : $fetch_route_code }  { Sub Route : $sub_route }";    
                                }
                                
                                if($student_transport_route_id==$fetch_route_id)
                                {
                                echo "<option value='$fetch_route_id' selected>$fetch_route_name $fetch_route_code</option>";
                                }else
                                {
                                echo "<option value='$fetch_route_id'>$fetch_route_name $fetch_route_code</option>";
                                    
                                }
                               }
                               
                               ?>
                               
                           </select>
                           </div>
                       </td>
                       
                       <td><b>Sub Route </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select name="sub_route"
                                   id="sub_route" class="select_box_style"  style=" width:300px; ">
                               <option value="0">-- Select Sub Route --</option>   
                              
                               <?php
                               $old_array=array();
                            $route_allot_id=array();
 $allocate_transport_route_db=mysql_query("SELECT * FROM transport_allocate_route_db WHERE $db_main_details"
         . " route_id='$student_transport_route_id' and is_delete='none'");
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
   foreach ($route_allot_id as $route_allocate_id)
  {                            
   $sub_route_db=mysql_query("SELECT * FROM transport_sub_route_db WHERE $db_main_details "
          . "route_allot_id='$route_allocate_id' and is_delete='none'");
  $fetch_sub_route_num_rows=mysql_num_rows($sub_route_db);
  while ($fetch_sub_route_data=mysql_fetch_array($sub_route_db))
  {
   $sub_route_id=$fetch_sub_route_data['sub_route_unique_id'];  
   $fetch_sub_route_name=$fetch_sub_route_data['sub_route'];  
   if($sub_route_id==$student_transport_sub_route)
   {
   echo "<option value='$sub_route_id' selected>$fetch_sub_route_name</option>";
   }else
   {
    echo "<option value='$sub_route_id'>$fetch_sub_route_name</option>";
      
   }
  }
  }
                               
                               ?>
                           </select>
                       </td>
                       
                   </tr>
   
                    <tr>
                          <td><b>Vehicle Type </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select name="transport_vehicle_type_id" onchange="change_vehicle_type_id(this.value)"
                                   id="vehicle_type_id" class="select_box_style"  style=" width:300px; ">
                               <option value="0">-- Select vehicle type --</option>   
                              <?php
  foreach ($old_array as $vehicle_type_id)
  {
     $vehicle_type_db=mysql_query("SELECT * FROM transport_vehicle_type_db WHERE $db_main_details"
             . " vehicle_type_id='$vehicle_type_id' and is_delete='none'");
    $fetch_vehicle_type_data=mysql_fetch_array($vehicle_type_db);
    $fetch_vehicle_num_rows=mysql_num_rows($vehicle_type_db);
    if((!empty($fetch_vehicle_type_data))&&($fetch_vehicle_type_data!=null)&&($fetch_vehicle_num_rows!=0))
    {
        $vehicle_type_name=$fetch_vehicle_type_data['vehicle_type'];
        if($vehicle_type_id==$student_transport_vehicle_type_id)
        {
       echo "<option value='$vehicle_type_id' selected>$vehicle_type_name</option>"; 
        }else
        {
        echo "<option value='$vehicle_type_id'>$vehicle_type_name</option>"; 
          
        }
    }
         
  }
                              ?>
                               
                           </select>
                       </td>
                        
                       <td><b>Vehicle</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select name="transport_vehicle_reg_no" id="vehicle_reg_no" class="select_box_style"
                                    style=" width:300px; ">
                               <option value="0">---Select vehicle---</option>   
                               <?php
$allocate_transport_route_db=mysql_query("SELECT * FROM transport_allocate_route_db WHERE $db_main_details route_id='$student_transport_route_id'"
         . " and vehicle_type_id='$student_transport_vehicle_type_id' and is_delete='none'");
 while ($fetch_allocate_transport_route_data=mysql_fetch_array($allocate_transport_route_db))
 {
 
  $fetch_vehicle_id=$fetch_allocate_transport_route_data['vehicle_id'];
  
  $vehicle_db=mysql_query("SELECT * FROM transport_vehicle_db WHERE $db_main_details vehicle_id='$fetch_vehicle_id'"
          . " and vehicle_type_id='$student_transport_vehicle_type_id' and is_delete='none'");
  $fetch_vehicle_data=mysql_fetch_array($vehicle_db);
  $fetch_vehicle_num_rows=mysql_num_rows($vehicle_db);
  
  if((!empty($fetch_vehicle_data))&&($fetch_vehicle_data!=null)&&($fetch_vehicle_num_rows!=0))
  {
      
    $fetch_vehicle_id=$fetch_vehicle_data['vehicle_id'];
    $fetch_vehicle_name=$fetch_vehicle_data['vehicle_registration_no'];
      
      if($fetch_vehicle_id==$student_transport_vehicle_reg_no)
      {
      echo "<option value='$fetch_vehicle_id' selected>$fetch_vehicle_name</option>";   
      }  else {
         echo "<option value='$fetch_vehicle_id'>$fetch_vehicle_name</option>";   
       
      }
  }
  
  
  
  
  }  
                               ?>
                           </select>
                       </td>
                   </tr>
                     <tr>
                         <td><b>Joining Date</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" readonly="readonly" name="transport_joining_date" id="transport_joining_date"
                                  class="text_box_styling" value="<?php if(!empty($student_transport_joining_date)){ echo $student_transport_joining_date; }else { echo $date; }?>" style=" background-color:whitesmoke;  width:290px; " placeholder="Enter Joining date"></td>
                    <td><b>Description</b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td>
                           <textarea id="transport_description" name="transport_description" class="text_area_class" style=" width:74%;"><?php echo $student_transport_description;?></textarea>
                       </td>     
                     </tr>
                     <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   
                   <tr>
                        <td><input type="button" onclick="per_form_no_6('6')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="5">
                          <input type="button" onclick="form_no_8('8')" class="continue_button_styling" value="Next">
                             <input type="button" onclick="skip_form_no_8('8')" class="continue_button_styling" style=" margin-right:10px; " value="Skip">
                         
                       
                       </td>
                   </tr>
               </table>
              </div>
               
               
             <?php 
 }
               ?>
               
               
               
               
               
               
               
               
               
               
               
               
               <div class="admission_setep" id="form_no_8">
                <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td  colspan="6">
                           <div class="title_heading"><b>Undertaking</b></div>   
                       </td>
                   </tr>
                    <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                    <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                    <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                    <td><input class="check_box_styling" id="under_taking_check" type="checkbox"></td>
                    <td rowspan="2" rowspan="3">I hereby certify that information provided above is true and to the best to my 
                            knowledge and belief . If any information found to be false/incorrect it 
                            will disqualify my continuation in school/collage</td>
                   </tr>
                    <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                    <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                    <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                        <td colspan="2"><input type="button" onclick="per_form_no_7('7')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="4"><input type="submit" name="save_process_details"
                                              onclick="return next_finish_page_details()" class="continue_button_styling" value="Update"></td>
                   </tr>
                </table>
                   
                       
               </div>
               
          
               
               
           </div>   
            
       </div>
       
          </form>
        
        
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
         <script type="text/javascript">
      
$(function() {
$("#student_date_of_birth").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      yearRange:'1950:2016',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
    $("#admission_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
   
     $("#hotel_joining_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
      $("#transport_joining_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
   
});
    </script>
         
         <script type="text/javascript">
             $(document).ready(function(){
                  $('#student_photo').change(function(){
			var file=this.files[0];
                        var file_size_convetred=file.size/1024;
                        var set_file_limit='100';
                            if(file_size_convetred>set_file_limit)
                            {
			    alert('Photo Size Should be less then 100 Kb');
                            $('#student_photo').val('');
                            $('#student_photo').focus();
                            return false;
                            }
           	}); 
                
                $('#father_photo').change(function(){
			var file=this.files[0];
                        var file_size_convetred=file.size/1024;
                        var set_file_limit='100';
                            if(file_size_convetred>set_file_limit)
                            {
			    alert('Photo Size Should be less then 100 Kb');
                            $('#father_photo').val('');
                            $('#father_photo').focus();
                            return false;
                            }
           	}); 
                
                $('#mother_photo').change(function(){
			var file=this.files[0];
                        var file_size_convetred=file.size/1024;
                        var set_file_limit='100';
                            if(file_size_convetred>set_file_limit)
                            {
			    alert('Photo Size Should be less then 100 Kb');
                            $('#mother_photo').val('');
                            $('#mother_photo').focus();
                            return false;
                            }
           	}); 
                
                $('#gur_photo').change(function(){
			var file=this.files[0];
                        var file_size_convetred=file.size/1024;
                        var set_file_limit='100';
                            if(file_size_convetred>set_file_limit)
                            {
			    alert('Photo Size Should be less then 100 Kb');
                            $('#gur_photo').val('');
                            $('#gur_photo').focus();
                            return false;
                            }
           	}); 
                
                
             });
         </script>  
  <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    
  </style>          
  <script src="../javascript/combosearch/chosen.jquery.js" type="text/javascript"></script>
  <script src="../javascript/combosearch/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
  
        
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }

  </script>
         
  <script type="text/javascript">
  function page_load()
  {
   $(document).ready(function(){
    if($('#curr_country option:contains("<?php echo $student_current_country;?>")'))
    {
   $('#curr_country option:contains("<?php echo $student_current_country;?>")').prop("selected",true);
    }
   if($('#per_country option:contains("<?php echo $student_permanent_country;?>")'))
   {
   $('#per_country option:contains("<?php echo $student_permanent_country;?>")').prop("selected",true);
   }
   });
   
   
  }
  </script>
  
  
      
             <?php
             
         }
        }
             ?>  
  
       <div style=" width:100px; height:25px; float:left;   "></div>
        <div id="include_fotter_page">
       <?php  require_once '../fotter/fotter_page.php'; ?>    
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>