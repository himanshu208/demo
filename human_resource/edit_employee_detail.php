<?php
//SESSION CONFIGURATION
$check_array_in="hr";
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
?>

<?php
$message_show="";
if(isset($_POST['save_process_details']))
{
    $update_employee_db_id=$_POST['employee_db_id'];
    $employee_personal_db_id=$_POST['employee_personal_db_id'];     
    $employee_family_id=$_POST['employee_family_id'];
    $employee_bank_id=$_POST['employee_bank_id'];        
    $employee_hostel_transport_id=$_POST['employee_hostel_transport_id'];       
            
             $employee_number=$_POST['employee_no'];
             $employee_joining_date=$_POST['joining_date'];
             $department=$_POST['department'];
             $designation=$_POST['designation'];
             $profession_teaching=$_POST['profession_teaching'];
             $session_id=$_POST['use_inset_session_id'];
  
     //employee persoanl details        
             
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
    $marital_status=$_POST['marital_status'];
    $student_username=$_POST['employee_username'];
    $student_password=$_POST['employee_password'];
    $encrypt_password=md5(md5($student_password));    
    
    //employee address details
    
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
    
            $emergency_mobile_no=$_POST['emergency_mobile_no'];
            $emergency_phone=$_POST['emergency_phone'];
            $emergency_email=$_POST['emergency_email'];
            
            //family details
            
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
   
    
    $student_spouse_name=$_POST['spouse_full_name'];
    $student_spouse_mobile_no=$_POST['spouse_mobile_no'];
    $student_spouse_email=$_POST['spouse_email_id'];
    $student_spouse_qualification=$_POST['spouse_qualification'];
    $student_spouse_occupation=$_POST['spouse_occupation'];
    $student_spouse_annual_income=$_POST['spouse_annual_income'];
    $student_spouse_photo=$_FILES['spouse_photo'];
    $no_of_children=$_POST['no_of_child'];
    
   
    
    //experiense details
           
            $experiense_year=$_POST['exp_year'];
            $experiense_month=$_POST['exp_month'];
            $experiense_day=$_POST['exp_day'];
            
            if(($experiense_year=="zero")||($experiense_month=="zero")||($experiense_day=="zero"))
            {
             $insert_experiense="";  
            }else
            {
              $insert_experiense="$experiense_year Year , $experiense_month Month , $experiense_day Days";  
            }
            
            $experiense_detail=$_POST['exp_details'];
                    
       //bank details
       
                    $bank_name=$_POST['bank_name'];
                    $bank_branch=$_POST['bank_branch'];
                    $phone=$_POST['bank_phone'];
                    $bank_address=$_POST['bank_address'];
                    $ifsc_code=$_POST['ifsc_code'];
                    $account_no=$_POST['account_no'];
                    $confirm_account_no=$_POST['confirm_account_no'];
                    $dd_payable_address=$_POST['dd_payable_address'];
                    
        //other details
                    
        $hobbies=$_POST['hobbies'];
             
         if(!empty($_POST['declaration']))
         {
         $declaration=$_POST['declaration'];
         }else
         {
           $declaration="no";   
         }
       
         
      
         
         
if((!empty($employee_joining_date))&&(!empty($department))&&(!empty($designation))&&(!empty($profession_teaching))
        &&(!empty($student_full_name))&&(!empty($student_gender)))
{   
   
    
    
    
if(!empty($employee_personal_db_id))
{
 $update_employee_personal_db=mysql_query("UPDATE hr_employee_personal_db SET full_name='$student_full_name',gender='$student_gender',"
         . "dob='$student_dob',blood_group='$student_blood_group',birth_palace='$student_birth_place',nationality='$student_nationality',religion='$student_religion',mother_tongue='$student_mother_tongue',"
         . "sub_category='$student_sub_category',mobile='$student_mobile',email='$student_email',handicapped='$studnet_handicapped',marital_status='$marital_status',"
         . "current_address='$student_current_address',current_nearest_area='$student_current_nearest_area',current_city='$student_current_city',current_desctric='$student_current_desctric',"
         . "current_post='$student_current_post',current_pincode='$student_current_pincode',current_state='$student_current_state',current_country='$student_current_country',"
         . "permanent_address='$student_per_address',permanent_nearest_area='$student_per_nearest_area',permanent_city='$student_per_city',permanent_desctric='$student_per_desctric',"
         . "permanent_post='$student_per_post',permanent_pincode='$student_per_pincode',permanent_state='$student_per_state',permanent_country='$student_per_country',"
         . "emergency_mobile_no='$emergency_mobile_no',emergency_phone='$emergency_phone',emergency_email='$emergency_email' WHERE employee_personal_id='$employee_personal_db_id' and is_delete='none'");
 
   if((!empty($update_employee_personal_db))&&($update_employee_personal_db))
   {
    $employee_personal_id=$employee_personal_db_id;  
   }else
   {
      $employee_personal_id=0; 
   }
}else
{
 $employee_personal_id=0;     
}
   
   
//insert family detail   
   if(!empty($employee_family_id))
   {
        $filename_1= $_FILES['student_father_photo']['name'];
        $tmpfilename_1 = $_FILES['student_father_photo']['tmp_name'];
        $filesize_1= $_FILES['student_father_photo']['size'];
        
        $filename_2= $_FILES['student_mother_photo']['name'];
        $tmpfilename_2 = $_FILES['student_mother_photo']['tmp_name'];
        $filesize_2 = $_FILES['student_mother_photo']['size'];
        
        $filename_3= $_FILES['spouse_photo']['name'];
        $tmpfilename_3 = $_FILES['spouse_photo']['tmp_name'];
        $filesize_3 =$_FILES['spouse_photo']['size'];
        
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
            $templocation_1= "crud_images/parents/". $random . $time;
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
         $student_parents_insert_photo_1=$_POST['employee_father_temp_photo'];   
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
            $templocation_2= "crud_images/parents/". $random . $time;
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
         $student_parents_insert_photo_2=$_POST['employee_mother_temp_photo'];   
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
            $location_3="crud_images/parents/". $random . $time . $filename_2;
            $templocation_3= "crud_images/parents/". $random . $time;
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
         $student_parents_insert_photo_3=$_POST['employee_spouse_temp_photo'];   
        }       
 
$update_family_db=mysql_query("UPDATE hr_family_db SET father_name='$student_father_name',father_mobile_no='$student_father_mobile_no',father_email='$student_father_email_id',"
        . "father_qualification='$student_father_qualification',father_occupation='$student_father_occupation',father_annual_income='$student_father_annual_income',father_photo='$student_parents_insert_photo_1',"
        . "mother_name='$student_mother_name',mother_mobile_no='$student_mother_mobile_no',mother_email_id='$student_mother_email_id',mother_qualification='$student_mother_qualification',mother_occupation='$student_mother_occupation',"
        . "mother_annual_income='$student_mother_annual_income',mother_photo='$student_parents_insert_photo_2',spouse_name='$student_spouse_name',spouse_mobile_no='$student_spouse_mobile_no',spouse_email_id='$student_spouse_email',"
        . "spouse_qualification='$student_spouse_qualification',spouse_occupation='$student_spouse_occupation',spouse_annual_income='$student_spouse_annual_income',spouse_photo='$student_parents_insert_photo_3',"
        . "no_of_children='$no_of_children' WHERE family_unique_id='$employee_family_id' and is_delete='none'");

if((!empty($update_family_db))&&($update_family_db))
{
 $family_unqiue_id=$employee_family_id;     
}else
{
 $family_unqiue_id=$employee_family_id;   
}
   }else
   {
   $family_unqiue_id=0;    
   }
   
   
   
   
   
//insert qualification detail
       
    if (count($_POST['course'])>0){
            $course=$_POST['course'];
            $year=$_POST['year'];
            $per_of_mark=$_POST['per_of_mark'];
            $board=$_POST['board_university'];
            $school=$_POST['school_collage'];
            $document_file=$_FILES['qualification_document']['name'];
            $temp_document_file=$_FILES['qualification_document']['tmp_name'];
            $document_size=$_FILES['qualification_document']['size'];
            if(!empty($_POST['temp_qualification_document']))
            {
            $temprory_document_file=$_POST['temp_qualification_document'];
            }else
            {
            $temprory_document_file=array();    
            }
            $course_count=count($_POST['course']);
    }else
    {
       $course_count=0; 
    }
    
    $delete_qualification_db=mysql_query("DELETE FROM hr_qualification_db WHERE employee_id='$update_employee_db_id' and is_delete='none'");
    
if(!empty($course_count))
{
for($ij=0;$ij<$course_count;$ij++)
{  

           $insert_course=$course[$ij];
           $insert_year=$year[$ij];
           $insert_per_of_mark=$per_of_mark[$ij];
           $insert_board=$board[$ij];
           $insert_school=$school[$ij];
           $insert_document_file=$document_file[$ij];
           $insert_temp_doc_file=$temp_document_file[$ij];
           $insert_document_size=$document_size[$ij];
           if(!empty($temprory_document_file[$ij]))
           {
           $insert_temp_document_file=$temprory_document_file[$ij];
           }else
           {
            $insert_temp_document_file="";   
           }
    if(!empty($insert_course))
    {
  
     if((!empty($insert_document_file)))
        { 
        if(($insert_document_size<902400))
         {
       
            date_default_timezone_set('Asia/Calcutta'); 
            $time=mktime();
            $random=rand(3000, 5000);
            $doc_location="crud_images/document/". $random . $time . $insert_document_file;
            $templocation= "crud_images/document/". $random . $time;
            $doc_upload=move_uploaded_file($insert_temp_doc_file,"../".$doc_location);
            if($doc_upload)
            {
             $document=$doc_location;   
            }else
            {
              $document="";       
            }
         }else
         {
             $document="";   
         }
        }else
        {
         $document=$insert_temp_document_file;   
        }       
        
$qualification_result=mysql_query("SHOW TABLE STATUS LIKE 'hr_qualification_db'");
$qualification_row=mysql_fetch_array($qualification_result);
$qualification_nextId=$qualification_row['Auto_increment']; 
$qualification_final_db_id="QLFCTION_ID_$qualification_nextId"; 
$qualification_encrypt_id=md5(md5($qualification_final_db_id));

$qualification_db=mysql_query("INSERT into hr_qualification_db values('','$fetch_school_id','$fetch_branch_id','$session_id'"
        . ",'$qualification_final_db_id','$qualification_encrypt_id','$update_employee_db_id','$insert_course'"
        . ",'$insert_year','$insert_per_of_mark','$insert_board','$insert_school','$document','none','$date'"
           . ",'$date_time','$fecth_user_unique')");
}
}
}



//insert achievement details
            
            if(count($_POST['achivement_title'])>0)
            {
                    $achievement_title=$_POST['achivement_title'];
                    $achievement_description=$_POST['achivement_description'];
                    $achievement_document_name=$_POST['achivement_document_name'];
                    $achievement_document_file=$_FILES['achivement_document_file']['name'];
                    $temp_achievement_document_file=$_FILES['achivement_document_file']['tmp_name'];
                    $achievement_document_size=$_FILES['achivement_document_file']['size'];
                    if(!empty($_POST['temp_achivement_document_file']))
                    {
                    $temprory_achievement_document_file=$_POST['temp_achivement_document_file'];
                    }else
                    {
                     $temprory_achievement_document_file=array();   
                    }
                    $achievement_count=count($_POST['achivement_title']);
                    
            }else
            {
              $achievement_count=0;  
            }

 $delete_achivement_db=mysql_query("DELETE FROM hr_achievement_db WHERE employee_id='$update_employee_db_id' and is_delete='none'");           
            
            
if(!empty($achievement_count))
{
for($ik=0;$ik<$achievement_count;$ik++)
{
          $insert_achivement_title=$achievement_title[$ik];
          $insert_achivement_description=$achievement_description[$ik];
          $insert_achievement_document_name=$achievement_document_name[$ik];
          $insert_achievement_document_file=$achievement_document_file[$ik];
          $insert_temp_achievement_document_file=$temp_achievement_document_file[$ik];
          $insert_document_size=$achievement_document_size[$ik];
          if(!empty($temprory_achievement_document_file[$ik]))
          {
          $insert_temp_achivement_doc_file=$temprory_achievement_document_file[$ik];
          }else
          {
          $insert_temp_achivement_doc_file="";    
          }
          if((!empty($insert_achivement_title)))
          {
              
          if((!empty($insert_achievement_document_file)))
        { 
        if(($insert_document_size<902400))
         {
       
            date_default_timezone_set('Asia/Calcutta'); 
            $time=mktime();
            $random=rand(3000, 5000);
            $doc_locationed="crud_images/document/". $random . $time .$insert_achievement_document_file;
            $templocation= "crud_images/document/". $random . $time;
            $doc_upload=move_uploaded_file($insert_temp_achievement_document_file,"../".$doc_locationed);
            if($doc_upload)
            {
             $documented=$doc_locationed;   
            }else
            {
              $documented="";       
            }
         }else
         {
             $documented="";   
         }
        }else
        {
         $documented=$insert_temp_achivement_doc_file;   
        }      
              
$achivement_result=mysql_query("SHOW TABLE STATUS LIKE 'hr_achievement_db'");
$achivement_row=mysql_fetch_array($achivement_result);
$achivement_nextId=$achivement_row['Auto_increment']; 
$achivement_final_db_id="ACHMNT_ID_$achivement_nextId"; 
$achivement_encrypt_id=md5(md5($achivement_final_db_id)); 
    
$achivemnt_db=mysql_query("INSERT into hr_achievement_db values('','$fetch_school_id','$fetch_branch_id','$session_id'"
        . ",'$achivement_final_db_id','$achivement_encrypt_id','$update_employee_db_id','$insert_achivement_title'"
        . ",'$insert_achivement_description','$insert_achievement_document_name','$documented'"
        . ",'none','$date','$date_time','$fecth_user_unique')");

}         
}   
}


                    $bank_name=$_POST['bank_name'];
                    $bank_branch=$_POST['bank_branch'];
                    $phone=$_POST['bank_phone'];
                    $bank_address=$_POST['bank_address'];
                    $ifsc_code=$_POST['ifsc_code'];
                    $account_no=$_POST['account_no'];
                    $confirm_account_no=$_POST['confirm_account_no'];
                    $dd_payable_address=$_POST['dd_payable_address'];
                    

//insert bank details
if((!empty($bank_name))&&(!empty($ifsc_code))&&(!empty($account_no)))
{
    
 
if(empty($employee_bank_id))
{
$bank_result=mysql_query("SHOW TABLE STATUS LIKE 'hr_bank_db'");
$bank_row=mysql_fetch_array($bank_result);
$bank_nextId=$bank_row['Auto_increment']; 
$bank_final_db_id="BANK_ID_$bank_nextId"; 
$bank_encrypt_id=md5(md5($bank_final_db_id));

$insert_bank_db=mysql_query("INSERT into hr_bank_db values('','$fetch_school_id','$fetch_branch_id','$session_id'"
        . ",'$bank_final_db_id','$bank_encrypt_id','$bank_name','$bank_branch','$phone','$bank_address'"
        . ",'$ifsc_code','$account_no','$dd_payable_address','none','$date','$date_time','$fecth_user_unique')");
if((!empty($insert_bank_db))&&($insert_bank_db))
{
 $insert_bank_unique_id=$bank_final_db_id;  
}else
{
$insert_bank_unique_id=0;    
}
}else
{

 $update_bank_db=mysql_query("UPDATE hr_bank_db SET bank_name='$bank_name',branch='$bank_branch',"
         . "phone='$phone',bank_address='$bank_address',ifsc_code='$ifsc_code',account_no='$account_no',"
         . "dd_payable_address='$dd_payable_address' WHERE bank_unique_id='$employee_bank_id' and is_delete='none'");  
 if((!empty($update_bank_db))&&($update_bank_db))
{
 $insert_bank_unique_id=$employee_bank_id;  
}else
{
$insert_bank_unique_id=0;    
}   
}
}else
{
 $insert_bank_unique_id=0;   
}

//insert document db

 //document details
            
            if(count($_POST['document_name'])>0)
            {
            $document_name=$_POST['document_name'];
            $document_files=$_FILES['document_file']['name'];
            $temp_document_files=$_FILES['document_file']['tmp_name'];
            $document_sizes=$_FILES['document_file']['size']; 
            if(!empty($_POST['temp_document_file']))
            {
            $temprory_document_files=$_POST['temp_document_file'];
            }else
            {
             $temprory_document_files=array();   
            }
            $document_count=count($_POST['document_name']);
            }else
            {
             $document_count=0;   
            }

 $delete_document_db=mysql_query("DELETE FROM hr_document_db WHERE employee_id='$update_employee_db_id' and is_delete='none'");           
            
            
if(!empty($document_count))
{
    
   for($kk=0;$kk<$document_count;$kk++)
   {
    $insert_document_name=$document_name[$kk];
    $insert_document_files=$document_files[$kk];
    $insert_temp_doc_files=$temp_document_files[$kk];
    $insert_document_sizes=$document_sizes[$kk];
    if(!empty($temprory_document_files[$kk]))
    {
    $insert_temprory_document_files=$temprory_document_files[$kk];
    }else
    {
     $insert_temprory_document_files="";   
    }
    
    if((!empty($insert_document_name)))
    {
        
      if((!empty($insert_document_files)))
        { 
        if(($insert_document_sizes<902400))
         {
       
            date_default_timezone_set('Asia/Calcutta'); 
            $time=mktime();
            $random=rand(3000, 5000);
            $doc_locations="crud_images/document/". $random . $time . $insert_document_files;
            $templocation= "images/document/". $random . $time;
            $doc_upload=move_uploaded_file($insert_temp_doc_files,"../".$doc_locations);
            if($doc_upload)
            {
             $documents=$doc_locations;   
            }else
            {
              $documents="";       
            }
         }else
         {
             $documents="";   
         }
        }else
        {
         $documents=$insert_temprory_document_files;   
        }      
        
        
$document_result=mysql_query("SHOW TABLE STATUS LIKE 'hr_document_db'");
$document_row=mysql_fetch_array($document_result);
$document_nextId=$document_row['Auto_increment']; 
$document_final_db_id="DOCMT_ID_$document_nextId"; 
$document_encrypt_id=md5(md5($document_final_db_id));  

    $insert_document_db=mysql_query("INSERT into hr_document_db values('','$document_final_db_id','$document_encrypt_id'"
            . ",'$update_employee_db_id','$insert_document_name','$documents','none','$date','$date_time')");    
    }   
   }   
}
  
//insert language detail
        
        if(count($_POST['language']) > 0)
        {
        $language=$_POST['language'];
        if(!empty($_POST['language_read']))
        {
        $language_read=$_POST['language_read'];
        }
        if(!empty($_POST['language_write']))
        {
         $language_write=$_POST['language_write'];
        }
        if(!empty($_POST['language_spoke']))
        {
         $language_spoke=$_POST['language_spoke'];
        }
        
        $language_count=count($_POST['language']);
        }else
        {
        $language_count=0;  
        }
        
      
  $delete_language_db=mysql_query("DELETE FROM hr_language_db WHERE employee_unique_id='$update_employee_db_id' and is_delete='none'");      
        
if(!empty($language_count))
{
 for($jj=0;$jj<$language_count;$jj++)
 {
        $insert_langauge=$language[$jj];
        if(!empty($language_read[$jj]))
        {
        $insert_language_read=$language_read[$jj];
        }else
        {
         $insert_language_read="No";   
        }
        if(!empty($language_write[$jj]))
        {
        $insert_langage_write=$language_write[$jj];
        }else
        {
         $insert_langage_write="No";   
        }
        if(!empty($language_spoke[$jj]))
        {
        $insert_language_spoke=$language_spoke[$jj];
        }else
        {
         $insert_language_spoke="No";   
        }
        
     if(!empty($insert_langauge))
     {
      $insert_language_db=mysql_query("INSERT into hr_language_db values('','$update_employee_db_id','$insert_langauge','$insert_language_read'"
              . ",'$insert_langage_write','$insert_language_spoke','none')");   
         
     }
     
 }
}

//insert hostel and transport 

//hostel & transport details
         
         if(!empty($_POST['hostel']))
         {
         $hostel=$_POST['hostel'];
         $hostel_joining_date=$_POST['hostel_joining_date'];
         $hostel_description=$_POST['hostel_description'];
         }else
         {
         $hostel="";
         $hostel_joining_date="";
         $hostel_description="";   
         }
         
         if(!empty($_POST['transport']))
         {
         $transport=$_POST['transport'];
         $transport_joining_date=$_POST['transport_joining_date'];
         $transport_description=$_POST['transport_description'];
         }else
         {
         $transport="";
         $transport_joining_date="";
         $transport_description="";
         }

if(!empty($employee_hostel_transport_id))
{
$update_hostel_transport_db=mysql_query("UPDATE hr_hostel_transport_db SET hostel='$hostel',hostel_joining_date='$hostel_joining_date',"
        . "hostel_description='$hostel_description',transport='$transport',transport_joining_date='$transport_joining_date'"
        . ",transport_description='$transport_description' WHERE hostel_transport_unique_id='$employee_hostel_transport_id' and is_delete='none'");

if((!empty($update_hostel_transport_db))&&($update_hostel_transport_db))
{
 $insert_hostel_transport_id=$employee_hostel_transport_id; 
}  else {
  $insert_hostel_transport_id=$employee_hostel_transport_id;  
}
}else
{
 $hostel_transport_result=mysql_query("SHOW TABLE STATUS LIKE 'hr_hostel_transport_db'");
$hostel_transport_row=mysql_fetch_array($hostel_transport_result);
$hostel_transport_nextId=$hostel_transport_row['Auto_increment']; 
$hostel_transport_final_db_id="HSTL_TRNSPRT_ID_$hostel_transport_nextId"; 
$hostel_transport_encrypt_id=md5(md5($hostel_transport_final_db_id));  

if((!empty($hostel))||(!empty($transport)))
{
$insert_hostel_transport_db=mysql_query("INSERT into hr_hostel_transport_db values('','$fetch_school_id','$fetch_branch_id','$session_id'"
        . ",'$hostel_transport_final_db_id','$hostel_transport_encrypt_id','$hostel','$hostel_joining_date'"
        . ",'$hostel_description','$transport','$transport_joining_date','$transport_description','none'"
        . ",'$date','$date_time')"); 

if((!empty($insert_hostel_transport_db))&&($insert_hostel_transport_db))
{
 $insert_hostel_transport_id=$hostel_transport_final_db_id; 
}  else {
  $insert_hostel_transport_id=0;  
}

}else
{
 $insert_hostel_transport_id=0;     
}   
}


//final employee db insert

if((!empty($employee_personal_id))&&(!empty($family_unqiue_id)))
{
    
    
        $filename=$_FILES['student_photo']['name'];
        $tmpfilename=$_FILES['student_photo']['tmp_name'];
        $filesize = $_FILES['student_photo']['size'];
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
            $location="crud_images/employee/". $random . $time . $filename;
            $templocation="crud_images/employee/". $random . $time;
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
        $location=$_POST['employee_temp_photo'];    
        } 
    
    $update_employee_db=mysql_query("UPDATE hr_employee_db SET employee_no='$employee_number',"
        . "joining_date='$employee_joining_date',department_id='$department',designation_id='$designation',profession_teaching='$profession_teaching',"
        . "category_id='$student_category',employee_personal_id='$employee_personal_id',family_id='$family_unqiue_id',bank_id='$insert_bank_unique_id',"
        . "hostel_transport_id='$insert_hostel_transport_id',experience='$insert_experiense',experience_detail='$experiense_detail',hobbies='$hobbies',"
        . "employee_photo='$location',user_name='$student_username',password='$encrypt_password',temp_password='$student_password' WHERE employee_id='$update_employee_db_id' and is_delete='none'");
if($update_employee_db)
{
   $message_show="Record update successfully complete"; 
}else
{
   $message_show="Request failed,Please try again";   
}
}else
{
   $message_show="Sorry technical problem,Please try again";   
}
}else
{
  $message_show="Please fill all fields.";     
}
require_once '../pop_up.php';
}
?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Employee Registration</title>
         <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         <script type="text/javascript" src="javascript/employee_next_javascript.js"></script>
         <script type="text/javascript" src="javascript/employee_registration_javascript.js"></script>
       
     
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
        <div id="fetch_record" style=" display:none; "></div>
        
          <form action="" name="myForm" method="post" enctype="multipart/form-data">
        
       <div id="main_work_div">
           <div id="main_second_work_div">
               <div class="forward_step_style">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="hr_dashboard.php">Human Resource</a></td>
                           <td>/</td>
                           <td><a href="employee_search.php">Employee Search</a></td>
                           <td>/</td>
                           <td>Edit Employee Detail</td>
                       
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
                    
                    
                     
               
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_5"   class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                     
                    
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_6"  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                    
             
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color_7"  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                </tr>
                <tr>
                    <td colspan="3" id="color_set_page_1" class="heading_short_forward">
                   Employee Personal Details
                    </td>
                    <td colspan="3" id="color_set_page_2" class="heading_short_forward">
                   Address Details  
                    </td>
                    <td colspan="3" id="color_set_page_3"  class="heading_short_forward">
                   Family Details
                    </td>
                    
                    <td colspan="3" id="color_set_page_4"  class="heading_short_forward">
                   Qualification Details
                    </td>
                    
                    <td colspan="3" id="color_set_page_5"  class="heading_short_forward">
                   Bank Detail
                    </td>
                    
                    
                    <td colspan="3" id="color_set_page_6"  class="heading_short_forward">
                  Other Details
                    </td>
               
                    
                     <td colspan="3"  id="color_set_page_7" class="heading_short_forward">
                  Declaration & Finish
                    </td>
          
                    
                </tr>
                 </table>
        </div>
        
               
               
            <?php
if((!empty($_REQUEST['token_id'])))
{
 $employee_encrypt_id=$_REQUEST['token_id'];
 
 
            
         
            $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id "
                      . "LEFT JOIN hr_bank_db as T6 ON T1.bank_id=T6.bank_unique_id "
                      . "LEFT JOIN hr_hostel_transport_db as T7 ON T1.hostel_transport_id=T7.hostel_transport_unique_id "
                      . "LEFT JOIN category_db as T8 ON T1.category_id=T8.category_id WHERE"
                    . " T1.encrypt_id='$employee_encrypt_id' and T1.is_delete='none'");
          
         
         $fetch_employee_data=mysql_fetch_array($employee_db);
         $fetch_employee_num_rows=mysql_num_rows($employee_db);
         if((!empty($fetch_employee_data))&&($fetch_employee_data!=null)&&($fetch_employee_num_rows!=0))
         {
  
$employee_db_id=$fetch_employee_data['db_id'];
$employee_encrypt_id=$fetch_employee_data['encrypt_id'];       
$employee_unique_id=$fetch_employee_data['employee_id'];    
$admission_no=$fetch_employee_data['employee_no'];      
$employee_admission_date=$fetch_employee_data['joining_date'];  
$department=$fetch_employee_data['department_id'];
$designation=$fetch_employee_data['designation_id'];
$teching_prefession=$fetch_employee_data['profession_teaching'];        
$category_name=$fetch_employee_data['category_id'];

 
    $employee_full_name=$fetch_employee_data['full_name'];
    $employee_gender=ucfirst($fetch_employee_data['gender']);
    $employee_dob=$fetch_employee_data['dob'];
    $employee_blood_group=$fetch_employee_data['blood_group'];
    $employee_birth_place=$fetch_employee_data['birth_palace'];
    $employee_nationality=$fetch_employee_data['nationality'];
    $employee_marital_status=$fetch_employee_data['marital_status'];
    $employee_religion=$fetch_employee_data['religion'];
    $employee_mother_tongue=$fetch_employee_data['mother_tongue'];
    $employee_category=$fetch_employee_data['category_id'];
    $employee_sub_category=$fetch_employee_data['sub_category'];
    $employee_mobile=$fetch_employee_data['mobile'];
    $employee_email=$fetch_employee_data['email'];
    $employee_photo=$fetch_employee_data['employee_photo'];
    $temp_employee_photo=$fetch_employee_data['employee_photo'];
    if(empty($employee_photo)||(!is_file("../".$employee_photo)))
    {
    $employee_photo="images/no_avilable_image.gif";    
    }  else {
        
      $employee_photo=$employee_photo;    
       
    }
    
    $user_name=$fetch_employee_data['user_name'];
    $password=$fetch_employee_data['temp_password'];
            
    
    $studnet_handicapped=$fetch_employee_data['handicapped'];
    
    if(($studnet_handicapped=="no"))
    {
    $studnet_handicapped="No";    
    }else
    {
      $studnet_handicapped="Yes"; 
    }
    
    $employee_current_address=$fetch_employee_data['current_address'];
    $employee_current_nearest_area=$fetch_employee_data['current_nearest_area'];
    $employee_current_city=$fetch_employee_data['current_city'];
    $employee_current_desctric=$fetch_employee_data['current_desctric'];
    $employee_current_pincode=$fetch_employee_data['current_pincode'];
    $employee_current_state=$fetch_employee_data['current_state'];
    $employee_current_country=$fetch_employee_data['current_country'];
    $employee_current_post=$fetch_employee_data['current_post'];
    
    $employee_permanent_address=$fetch_employee_data['permanent_address'];
    $employee_permanent_nearest_area=$fetch_employee_data['permanent_nearest_area'];
    $employee_permanent_city=$fetch_employee_data['permanent_city'];
    $employee_permanent_desctric=$fetch_employee_data['permanent_desctric'];
    $employee_permanent_pincode=$fetch_employee_data['permanent_pincode'];
    $employee_permanent_state=$fetch_employee_data['permanent_state'];
    $employee_permanent_country=$fetch_employee_data['permanent_country'];
    $employee_permanent_post=$fetch_employee_data['permanent_post'];
   
      $emergency_mobile_no=$fetch_employee_data['emergency_mobile_no'];
      $emergency_phone=$fetch_employee_data['emergency_phone'];
      $emergency_email=$fetch_employee_data['emergency_email'];
                    
    
    $employee_father_name=$fetch_employee_data['father_name'];
    $employee_father_mobile_no=$fetch_employee_data['father_mobile_no'];
    $employee_father_email_id=$fetch_employee_data['father_email'];
    $employee_father_qualification=$fetch_employee_data['father_qualification'];
    $employee_father_occupation=$fetch_employee_data['father_occupation'];
    $employee_father_annual_income=$fetch_employee_data['father_annual_income'];
    $employee_father_photo=$fetch_employee_data['father_photo'];
    $temp_father_photo=$fetch_employee_data['father_photo'];
    if(empty($employee_father_photo)||(!is_file("../".$employee_father_photo)))
    {
    $employee_father_photo="images/no_avilable_image.gif";    
    }  else {
      $employee_father_photo=$employee_father_photo;    
       
    }
    
    
    $employee_mother_name=$fetch_employee_data['mother_name'];
    $employee_mother_mobile_no=$fetch_employee_data['mother_mobile_no'];
    $employee_mother_email_id=$fetch_employee_data['mother_email_id'];
    $employee_mother_qualification=$fetch_employee_data['mother_qualification'];
    $employee_mother_occupation=$fetch_employee_data['mother_occupation'];
    $employee_mother_annual_income=$fetch_employee_data['mother_annual_income'];
    $employee_mother_photo=$fetch_employee_data['mother_photo'];
    $temp_mother_photo=$fetch_employee_data['mother_photo'];
    
    if(empty($employee_mother_photo)||(!is_file("../".$employee_mother_photo)))
    {
    $employee_mother_photo="images/no_avilable_image.gif";    
    }  else {
      $employee_mother_photo=$employee_mother_photo;    
       
    }
    
    
    $employee_spouse_name=$fetch_employee_data['spouse_name'];
    $employee_spouse_mobile_no=$fetch_employee_data['spouse_mobile_no'];
    $employee_spouse_email=$fetch_employee_data['spouse_email_id'];
    $employee_spouse_qualification=$fetch_employee_data['spouse_qualification'];
    $employee_spouse_occupation=$fetch_employee_data['spouse_occupation'];
    $employee_spouse_annual_income=$fetch_employee_data['spouse_annual_income'];
    $employee_spouse_photo=$fetch_employee_data['spouse_photo'];
    $temp_spouse_photo=$fetch_employee_data['spouse_photo'];
    if(empty($employee_spouse_photo)||(!is_file("../".$employee_spouse_photo)))
    {
    $employee_spouse_photo="images/no_avilable_image.gif";    
    }  else {
      $employee_spouse_photo=$employee_spouse_photo;    
       
    }
   
     $no_of_children=$fetch_employee_data['no_of_children'];   
     
     
     
     $employee_db_id=$fetch_employee_data['employee_id'];  
     $employee_personal_db_id=$fetch_employee_data['employee_personal_id']; 
     $employee_family_id=$fetch_employee_data['family_id']; 
     $employee_bank_id=$fetch_employee_data['bank_id']; 
     $employee_hostel_transport_id=$fetch_employee_data['hostel_transport_id'];      
     
     {
            ?>
               
               <input type="hidden" name="employee_db_id" value="<?php echo $employee_db_id;?>">
               <input type="hidden" name="employee_personal_db_id" value="<?php echo $employee_personal_db_id;?>">
               <input type="hidden" name="employee_family_id" value="<?php echo $employee_family_id;?>">
               <input type="hidden" name="employee_bank_id" value="<?php echo $employee_bank_id;?>">
               <input type="hidden" name="employee_hostel_transport_id" value="<?php echo $employee_hostel_transport_id;?>">
               
               
               <input type="hidden" name="employee_temp_photo" value="<?php echo $temp_employee_photo;?>">
                <input type="hidden" name="employee_father_temp_photo" value="<?php echo $temp_father_photo;?>">
                <input type="hidden" name="employee_mother_temp_photo" value="<?php echo $temp_mother_photo;?>">
                <input type="hidden" name="employee_spouse_temp_photo" value="<?php echo $temp_spouse_photo;?>">
               
               
             <div class="admission_setep"  id="form_no_1" style=" display:block;">
               <table cellspacing="0" cellpadding="0" class="student_details_table">
                   
                   <tr>
                       <td colspan="6">
                       </td>
                   </tr>
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                  
                   <tr>
                       <td colspan="9">
                           <div class="title_heading"><b>Office Information</b></div>   
                       </td>
                   </tr>
                 
                   <tr>
                       <td><b>Employee No.</b> <sup>*</sup></td>
                       <td style=" text-align:center;  "><b>:</b></td>
                       <td><input type="text" id="employee_no"  value="<?php echo $admission_no;?>" name="employee_no" class="text_box_styling"
                                  style=" width:40%;  text-align:center; "></td>
                       
                       <td><b>Joining Date</b><sup>*</sup></td>
                       <td style=" text-align:center;  "><b>:</b></td>
                       <td><input type="text" id="joining_date" name="joining_date" class="text_box_styling"
                                  placeholder="Enter joining date" value="<?php echo $date;?>" style=" width:170px; "></td>
                   </tr>
                   
                   <tr>
                       <td><b>Department <sup>*</sup></b></td>
                       <td style="text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="department" name="department" class="select_box_style">
                               <option value="0">---Select---</option>   
                             <?php
                             $department_db=mysql_query("SELECT * FROM hr_department_db WHERE $db_main_details_whout_session is_delete='none'");
                             while ($department_data=mysql_fetch_array($department_db))
                             {
                                 $department_id=$department_data['department_id'];
                                 $department_name=$department_data['department_name'];
                                 if($department==$department_id)
                                 {
                                 echo "<option value='$department_id' selected>$department_name</option>";
                                 }else
                                 {
                                    echo "<option value='$department_id'>$department_name</option>";
                                   
                                 }
                                 
                             }
                             ?>
                           </select>
                       </td>
                       <td><b>Designation <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="designation" name="designation" class="select_box_style">
                               <option value="0">---Select---</option>   
                                <?php
                             $designation_db=mysql_query("SELECT * FROM hr_designation_db WHERE $db_main_details_whout_session is_delete='none'");
                             while ($designation_data=mysql_fetch_array($designation_db))
                             {
                                 $designation_id=$designation_data['designation_id'];
                                 $designation_name=$designation_data['designation_name'];
                                 if($designation==$designation_id)
                                 {
                                 echo "<option value='$designation_id' selected>$designation_name</option>";
                                 }else
                                 {
                                   echo "<option value='$designation_id'>$designation_name</option>";
                                    
                                 }
                             }
                             ?>
                           </select>
                       </td>
                       <?php
                       if($teching_prefession=="yes")
                       {
                        $teaching_yes="checked";
                        $teaching_no="";
                       }else
                       {
                        $teaching_yes="";   
                        $teaching_no="checked";   
                       }
                       ?>
                      
                        <td><b>Profession Teaching <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                           <table>
                               <tr>
                                   <td><input type="radio" name="profession_teaching" value="no" <?php echo $teaching_no;?>></td><td>No</td>
                                   <td><input type="radio" name="profession_teaching" value="yes" <?php echo $teaching_yes;?>></td><td>Yes</td>
                               </tr>
                           </table>
                       </td>
                   </tr>
                   
                   
                   <tr>
                       <td colspan="9">
                           <div class="title_heading"><b>Employee Personal Information</b></div>   
                       </td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td><b>Full Name </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_full_name;?>" id="student_full_name" name="student_full_name" class="text_box_styling"
                                  placeholder="Enter full name"></td>
                       
                       <td><b>Gender</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="student_gender" name="student_gender_id" class="select_box_style">
                               <?php
                              $gender_array=array("male","female","other");
                             foreach($gender_array as $gender)
                              {
                                 if($employee_gender==ucwords($gender))
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
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $employee_dob;?>" type="text" name="student_dob" id="student_date_of_birth" 
                                  class="text_box_styling"
                                  placeholder="Enter date of birth" style=" width:150px; "></td>
                       </tr>
                   
                   
                   
                   <tr>
                       <td><b>Blood Group</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                           <select id="student_blood_group" name="student_blood_group" class="select_box_style">
                               <option value="0">---Select---</option>   
                                <?php
                               $blood_froup_array=array("A+","A-","B+","B-","O+","O-","AB+","AB-");
                               foreach ($blood_froup_array as $blood_group)
                               {
                                   if($blood_group==$employee_blood_group)
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
                       
                  
                       <td><b>Birth Palace</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $employee_birth_place;?>" id="student_birth_place" name="student_birth_place" type="text"
                                  class="text_box_styling" placeholder="Enter birth place"></td>
                   
                       
                       <td><b>Nationality</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $employee_nationality;?>" type="text" id="student_nationality" name="student_nationality" class="text_box_styling" 
                                  placeholder="Enter nationality"></td>
                   
                   
                   </tr>
                   
                   <tr>
                       <td><b>Religion</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $employee_religion;?>" type="text" name="student_religion" id="religion" class="text_box_styling" 
                                  placeholder="Enter religion"></td>
                   
                       
                       <td><b>Mother Tongue </b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $employee_mother_tongue;?>" type="text" name="student_mother_tongue" id="mother_tongue" class="text_box_styling"
                                  placeholder="Enter mother tongue"></td>
                   
                   
                   
                       
                       <td><b>Category</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
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
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $employee_sub_category;?>" type="text" name="student_sub_category" id="sub_category" class="text_box_styling"
                                  placeholder="Enter sub category"></td>
                       
                 
                       <td><b>Mobile <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $employee_mobile;?>" type="text" name="student_mobile_no" id="student_mobile_number" class="text_box_styling"
                                  placeholder="Enter mobile number"></td>
                   
                       
                       <td><b>Email id</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $employee_email;?>" type="text" name="student_email_id" id="student_email_id" 
                                  class="text_box_styling" placeholder="Enter email id"></td>
                   
                   
                   </tr>
                   <?php
                       
                   if($studnet_handicapped=="Yes")
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
                       <td><b>Handicapped <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                          <table cellspacing="0" cellpadding="0">
                               <tbody><tr>
                                       <td><input type="radio" value="no" name="student_handicapped" <?php echo $no_check;?>></td>
                                   <td>No</td>
                                   <td style=" width:10px; "></td>
                                   <td><input type="radio" accept="yes" name="student_handicapped" <?php echo $yes_check;?>></td>
                                   <td>Yes</td>
                                   <td style=" width:40px; "></td>
                               </tr>
                           </tbody></table>
                       </td>
                       <?php
                       if($employee_marital_status=="married")
                       {
                        $married_check="checked";
                        $un_married_check="";
                        
                        echo "<style> "
                        . "#spouse_table { display:block; }"
                                . " #children_table { display:block; }</style>";
                       }else
                       {
                        $married_check="";
                        $un_married_check="checked";   
                       }
                       ?>
                       <td><b>Marital Status <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                          <table cellspacing="0" cellpadding="0">
                               <tbody><tr>
                                       <td><input type="radio" onclick="check_martial_status('unmarried')" name="marital_status" value="unmarried" <?php echo $un_married_check;?>></td>
                                   <td>Unmarried</td>
                                   <td style=" width:10px; "></td>
                                   <td><input type="radio" onclick="check_martial_status('married')" value="married" name="marital_status" <?php echo $married_check;?>></td>
                                   <td>Married</td>
                                   <td style=" width:40px; "></td>
                               </tr>
                           </tbody></table>
                       </td>
                  
                        <td>
                            <b>Employee photo</b> 
                       </td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="student_photo" name="student_photo" type="file">
                       <br/>
                       <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       </td>
                   </tr>
                   <tr><td style=" height:5px; "></td></tr>
                  <tr>
                       <td colspan="8"></td>
                       <td>
                           <?php
                           if((!empty($temp_employee_photo))&&(is_file("../".$temp_employee_photo)))
                           {
                           ?>
                            <center><input type="button" onclick="on_show_photo('1')" class="view_button_style" 
                                            value="Employee View Photo"></center>
                           
                           <input type="hidden" id="input_photo_1" value="0">
                           <div class="student_photos" id="show_photo_1">
                           <table cellspacing="0" cellpadding="0" class="student_photo_table">
                               <tbody><tr>
                                   <td>Employee Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $employee_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </tbody></table>    
                           </div>
                           <?php
                           }else
                           {
                               echo "<span style='color:red; font-size:14px;'><b>No Employee Photo</b></span>";   
                           }
                           ?>
                       </td>
                   </tr>
                   <tr>
                       <td colspan="9">
                           <div class="title_heading"><b>Account Login Detail </b></div>   
                       </td>
                   </tr>
                    <tr>
                        <td><b>Username</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $user_name;?>" type="text" name="employee_username" id="employee_username" class="text_box_styling" 
                                  placeholder="Please enter username"></td>
                   
                       
                       <td><b>Password</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input value="<?php echo $password;?>" type="text" name="employee_password" id="employee_password" class="text_box_styling"
                                  placeholder="Please enter password"></td>
                   
                   
                   </tr>
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                       <tr>
                       <td colspan="9"><input type="button"  onclick="return form_no_2('2')"
                                              class="continue_button_styling" value="Next"></td>
                   </tr>
                   
                   
                   
               </table>    
               </div>
               
               
               
               
               
               
               
               
               
               
               
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
                       <td><input type="text" value="<?php echo $employee_current_address;?>" name="current_address" id="curr_address" class="text_box_styling" placeholder="Enter current address"></td>
                       
                       <td><b>Nearest Area</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_current_nearest_area;?>" name="current_nearest_address" id="curr_nearest_area" class="text_box_styling" placeholder="Enter nearest area"></td>
                       
                         <td><b>City </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_current_city;?>" name="current_city" id="curr_city" class="text_box_styling" placeholder="Enter city"></td>
                       
                   </tr>
                   
                   
                   <tr>
                     
                       <td><b>District</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_current_desctric;?>" name="current_desctric" id="curr_desctric" class="text_box_styling" placeholder="Enter desctric"></td>
                       
                       <td><b>Post</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_current_post;?>" id="curr_post" name="current_post"
                                  class="text_box_styling" placeholder="Enter post "></td>
                       
                       
                       <td><b>Pin code</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_current_pincode;?>" name="current_pincode" onkeypress="javascript:return isNumber (event)" id="curr_pincode" class="text_box_styling" placeholder="Enter pincode"></td>
                       
                      
                       
                   </tr>
                   
                   
                   <tr>
                       <td><b>State </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_current_state;?>" name="current_state" id="curr_state" class="text_box_styling" placeholder="Enter state"></td>
                       
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
                       <td><input type="text"  value="<?php echo $employee_permanent_address;?>" name="per_address" id="per_address" class="text_box_styling" placeholder="Enter permanent address"></td>
                       
                       <td><b>Nearest Area</b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_permanent_nearest_area;?>" name="per_nearest_area" id="per_nearest_area" class="text_box_styling" placeholder="Enter nearest area"></td>
                       
                        <td><b>City </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_permanent_city;?>" id="per_city" name="per_city" class="text_box_styling" placeholder="Enter city"></td>
                       
                   </tr>
                   
                   
                   <tr>
                      
                       <td><b>District </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_permanent_desctric;?>" id="per_desctric" name="per_desctric" class="text_box_styling" placeholder="Enter desctric"></td>
                  
                       <td><b>Post</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_permanent_post;?>"  id="per_post" name="per_post" class="text_box_styling"
                                  placeholder="Enter post"></td>
                       
                       
                       <td><b>Pin code</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_permanent_pincode;?>" id="per_pincode" onkeypress="javascript:return isNumber (event)" name="per_pincode" class="text_box_styling" placeholder="Enter pincode"></td>
                       
                       
                   </tr>
                   
                   
                   <tr>
                       <td><b>State</b> <sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $employee_permanent_state;?>" id="per_state" name="per_state" class="text_box_styling" placeholder="Enter state"></td>
                       
                       
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
                       <td colspan="9">
                           <div class="title_heading"><b>Emergency Contact Info</b></div>   
                       </td>
                   </tr>    
                   <tr>
                     <td><b>Mobile No. </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $emergency_mobile_no;?>" id="emergency_mobile_no" onkeypress="javascript:return isNumber (event)"
                                  name="emergency_mobile_no" class="text_box_styling" placeholder="Enter mobile number"></td>
                   <td><b>Phone </b><sup>*</sup></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $emergency_phone;?>" id="emergency_phone" onkeypress="javascript:return isNumber (event)"
                                  name="emergency_phone" class="text_box_styling" placeholder="Enter phone number"></td>
                  
                        <td><b>Email </b></td>
                       <td style="width:50px; text-align:center;  "><b>:</b></td>
                       <td><input type="text"  value="<?php echo $emergency_email;?>" id="emergency_email" name="emergency_email" class="text_box_styling"
                                  placeholder="Enter email"></td>
                  
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
               
               
               
               
               
               
               
               
               
               
               
               <div class="admission_setep" id="form_no_3" >
               <div id="new_parent">
                   <table cellspacing="0" cellpadding="0" class="student_details_table" style=" width:65%; float:left;  ">
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Family Detail</b></div>   
                       </td>
                       
                   </tr>
                   
                   
                   <tr>
                       <td colspan="3"><div class="title_heading" style=" width:100%; color:royalblue; font-size:12px;   "><b>Father Info</b></div></td>
                       <td colspan="3"><div class="title_heading" style=" width:100%; font-size:12px; color:royalblue; "><b>Mother Info</b></div></td>
                       <td></td>
                      
                   </tr>
                   
                   <tr>
                       <td style=" width:105px; "><b>Father Name </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_father_name;?>" name="student_father_name" id="father_name" class="text_box_styling" placeholder="Enter father name"></td>
                       
                       <td style=" width:105px; "><b>Mother Name</b> </td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_mother_name;?>" name="student_mother_name" id="mother_name" class="text_box_styling" placeholder="Enter mother name"></td>
                   </tr>
                    
                    
                    
                    <tr>
                       <td><b>Mobile No.</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_father_mobile_no;?>" onkeypress="javascript:return isNumber (event)" name="student_father_mobile_no" id="father_mobile_no" class="text_box_styling"
                                  placeholder="Enter father mobile number"></td>
                       
                       <td><b>Mobile No.</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_mother_mobile_no;?>" onkeypress="javascript:return isNumber (event)" name="student_mother_mobile_no" id="mother_mobile_no" class="text_box_styling"
                                  placeholder="Enter mother mobile number"></td>
                    
                     
                    </tr>
                    
                    
                    <tr>
                        <td><b>Email</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_father_email_id;?>" name="student_father_email_id" id="father_email_od" class="text_box_styling"
                                  placeholder="Enter father email id"></td>
                       
                       <td><b>Email</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_mother_email_id;?>" name="student_mother_email_id" id="mother_email_id" class="text_box_styling"
                                  placeholder="Enter mother email id"></td>
                  
                    </tr>
                    
                    <tr>
                        <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_father_qualification;?>" name="student_father_qualification" id="father_qualification" class="text_box_styling"
                                  placeholder="Enter father qualification"></td>
                       
                       <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_mother_qualification;?>" name="student_mother_qualification" id="mother_qualification" class="text_box_styling"
                                  placeholder="Enter mother qualification"></td>
                   
                     
                    </tr>
                  
                 
                    
                    <tr>
                        <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_father_occupation;?>" name="student_father_occupation" id="father_occupation" class="text_box_styling"
                                  placeholder="Enter father occupation"></td>
                       
                       <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_mother_occupation;?>" name="student_mother_occupation" id="mother_occupation" class="text_box_styling" 
                                  placeholder="Enter mother occupation"></td>
                     
                    </tr>
                    
                    
                    <tr>
                        <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_father_annual_income;?>" onkeypress="javascript:return isNumber (event)" name="student_father_annual_income" id="father_income" class="text_box_styling" 
                                  placeholder="Enter father annual income"></td>
                       
                       <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_mother_annual_income;?>" onkeypress="javascript:return isNumber (event)" name="student_mother_annual_income" id="mother_income" class="text_box_styling" 
                                  placeholder="Enter mother annual income"></td>
                      
                       
                    </tr>
                    
                    
                     <tr>
                         <td><b>Father Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="father_photo" name="student_father_photo" type="file"><br/>
                       <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       </td>
                       
                       <td><b>Mother Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="mother_photo" name="student_mother_photo" type="file"><br/>
                           <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       
                       </td>
                    </tr>
                     <tr><td style=" height:5px; "></td></tr>
                  <tr>
                       <td colspan="2"></td>
                       <td>
                           <?php
                           if((!empty($temp_father_photo))&&(is_file("../".$temp_father_photo)))
                           {
                           ?>
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
                                   <td><img class="student_images_change" src="../<?php echo $employee_father_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </tbody></table>    
                           </div>
                           <?php
                           }else
                           {
                               echo "<span style='color:red; font-size:14px;'><b>No Photo Available</b></span>";   
                           }
                           ?>
                       </td>
                       
                       <td colspan="2"></td>
                       <td>
                           <?php
                           if((!empty($temp_mother_photo))&&(is_file("../".$temp_mother_photo)))
                           {
                           ?>
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
                                   <td><img class="student_images_change" src="../<?php echo $employee_mother_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </tbody></table>    
                           </div>
                           <?php
                           }else
                           {
                               echo "<span style='color:red; font-size:14px;'><b>No Photo Available</b></span>";   
                           }
                           ?>
                       </td>
                       
                   </tr>
                       
                    
                      
                   </table>
                   
                   <table cellspacing="0" cellpadding="0" class="student_details_table"
                        id="spouse_table">
                        <td colspan="3">
                           <div class="title_heading"><b>Spouse Details</b></div>   
                       </td>
                       <tr>
                      <td colspan="3"><div class="title_heading" style=" width:100%; font-size:12px; color:royalblue; "><b>Spouse Detail</b></div></td>
                       </tr>
                       
                       <tr>
                           <td><b>Spouse Name <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_spouse_name;?>" name="spouse_full_name" id="gur_name" class="text_box_styling" 
                                  placeholder="Please enter spouse name"></td>
                    
                       </tr>
                       
                       <tr>
                       
                 <td><b>Mobile No. </b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_spouse_mobile_no;?>" onkeypress="javascript:return isNumber (event)" name="spouse_mobile_no" id="gur_mobile_no" class="text_box_styling"
                                  placeholder="Enter mobile no"></td>
                   
                       </tr> 
                       <tr>
                      <td><b>Email Id</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_spouse_email;?>" name="spouse_email_id" id="gur_email_id" class="text_box_styling"
                                  placeholder="Enter email id"></td>
                          
                       </tr>
                       
                       <tr>
                       <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_spouse_qualification;?>" name="spouse_qualification" id="gur_qualification" class="text_box_styling"
                                  placeholder="Enter qualification"></td>
                         
                       </tr>
                       <tr>
                       <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_spouse_occupation;?>" name="spouse_occupation" id="gur_occupation" class="text_box_styling"
                                  placeholder="Enter occupation"></td>
                       
                       </tr>
                       <tr>
                        <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $employee_spouse_annual_income;?>" onkeypress="javascript:return isNumber (event)" name="spouse_annual_income" id="gur_annual_income" class="text_box_styling"
                                  placeholder="Enter annual income"></td>
                         
                       </tr>
                       <tr>
                        <td><b>Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="gur_photo" name="spouse_photo" type="file">
                       <br/>
                           <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       </td>
                       
                        </tr>
                        <tr>
                            <td style=" height:5px; "></td>
                        </tr>
                        <tr>
                         <td colspan="2"></td>
                       <td>
                           <?php
                           if((!empty($temp_spouse_photo))&&(is_file("../".$temp_spouse_photo)))
                           {
                           ?>
                            <center><input type="button" onclick="on_show_photo('4')" class="view_button_style" 
                                            value="Spouse View Photo"></center>
                           
                           <input type="hidden" id="input_photo_4" value="0">
                           <div class="student_photos" id="show_photo_4">
                           <table cellspacing="0" cellpadding="0" class="student_photo_table">
                               <tbody><tr>
                                   <td>Spouse Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $employee_spouse_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </tbody></table>    
                           </div>
                           <?php
                           }else
                           {
                               echo "<span style='color:red; font-size:14px;'><b>No Photo Available</b></span>";   
                           }
                           ?>
                       </td>   
                        </tr>
                   </table>
                   
                     <table cellspacing="0" cellpadding="0" class="student_details_table"
                        id="children_table">
                        <td colspan="3">
                           <div class="title_heading"><b>Children Details</b></div>   
                       </td>
                       <tr>
                           <td colspan="3">
                               <table>
                                 <tr>
                        <td><b>No. Of Children</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)"
                                  name="no_of_child" id="no_of_child" class="text_box_styling"
                                  value="<?php echo $no_of_children;?>" style=" width: 30%; text-align:center; "></td>
                         
                       </tr>  
                               </table>  
                           </td>
                       </tr>
                   
                     </table>
                   </div>
                    
                    
                   <table  cellspacing="0" cellpadding="0" class="student_details_table" style=" float:left; margin-top:40px;  ">
                   <tr>
                        <td><input type="button" onclick="per_form_no_2('2')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="5"><input type="button" onclick="return form_no_4('4')" class="continue_button_styling" value="Next"></td>
                   </tr>
                    
                   
               </table>    
               </div>
               
               
                <script type="text/javascript">
                       function check_martial_status(material_status)
                       {
                         if(material_status=="unmarried")
                         {
                          document.getElementById("spouse_table").style.display="none";
                          document.getElementById("children_table").style.display="none";
                         }else
                             if(material_status=="married")
                         {
                          document.getElementById("spouse_table").style.display="block";
                          document.getElementById("children_table").style.display="block";   
                         }
                       }
                   </script>
               
               
               
               
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
    
    cell1.innerHTML ="<input type='checkbox' name='document_submitted[]' value='"+other_document+"'>";
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
               
               <script type="text/javascript">
                  function course_new_add()
                  {
var r=confirm("Are you sure you want to add new line");
if (r==true)
  { 

   var table=document.getElementById("qualification_table");
    var row=table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);
     var cell5 = row.insertCell(4);
     var cell6 = row.insertCell(5);
      var cell7 = row.insertCell(6);
   
var tbl=document.getElementById("qualification_table");        
var tds=tbl.getElementsByTagName("td");
for(var i=7;i<15;i++)
{
tds[i].style.borderBottom="1px solid #444";
tds[i].style.borderLeft="1px solid #444";
}
tds[8].style.borderLeft="0px solid #444";
tds[13].style.borderRight="1px solid #444";

  cell1.innerHTML="<input onclick='removeen_buttons(this)' class='remove_button' type='button' value='Remove'>"; 
  cell2.innerHTML='<input class="course_text_box" name="course[]" type="text">'; 
  cell3.innerHTML='<input class="course_text_box" name="year[]" type="text">';
  cell4.innerHTML='<input class="course_text_box" name="per_of_mark[]" type="text">';
  cell5.innerHTML='<input class="course_text_box" name="board_university[]"  type="text">';
  cell6.innerHTML='<input class="course_text_box" name="school_collage[]" type="text">';
   cell7.innerHTML='<input name="qualification_document[]" type="file"><input type="hidden" name="temp_qualification_document[]" >';
   
  }          
        }
        
  function removeen_buttons(row)
  {
   var r=confirm("Are you sure you want to remove");
if (r==true)
  { 
       var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('qualification_table').deleteRow(i);
  }   
  }
                   </script>
               
               
               <div class="admission_setep" id="form_no_4" >
                    
               <table cellspacing="0" cellpadding="0" class="student_details_table" style=" font-size:12px; ">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Qualification Details</b></div>   
                       </td>
                   </tr>
                   
                   <tr>
                       <td colspan="6">
                           <table  cellspacing="0" cellpadding="3" id="qualification_table" class="course_table">
                            <tr class="course_th_style">
                           <td></td>
                           <td><b>Course</b></td>
                           <td><b>Year</b></td>
                           <td><b>%Of Mark</b></td>
                           <td><b>Board/University</b></td>
                           <td><b>School/Collage</b></td>
                           <td><b>Upload Document File</b></td>
                       </tr>
                       
                       <?php 
                    $qualification_db=mysql_query("SELECT * FROM hr_qualification_db WHERE $db_main_details_whout_session employee_id='$employee_unique_id' and is_delete='none'");
                    $qualification_num_rows=mysql_num_rows($qualification_db); 
                   if(!empty($qualification_num_rows))
                   {
                       $row=1;
                     while ($qualification_data=mysql_fetch_array($qualification_db))
                    {
                   $course=$qualification_data['course'];
                   $year=$qualification_data['year'];
                   $per_of_mark=$qualification_data['per_of_mark'];
                   $board=$qualification_data['board'];
                   $school=$qualification_data['school'];
                   $document=$qualification_data['document_file'];
                   $temp_document=$qualification_data['document_file'];
                   if((!empty($document))&&(is_file("../".$document)))
                   {
                    $file=1;   
                   }  else {
                        $file=0;    
                   }   
                       ?>
                       
                       <tr class="course_td_style">
                           <td>
                               <?php
                               if($qualification_num_rows!=$row)
                               {
                               ?>
                               <input onclick="removeen_buttons(this)" class="remove_button" type="button" value="Remove">
                           <?php
                               }
                           ?>
                           </td>
                           <td style=" border-left:0; "><input name="course[]" value="<?php echo $course;?>" id="course_<?php echo $row;?>" class="course_text_box" type="text"></td>
                           <td><input class="course_text_box" value="<?php echo $year;?>" name="year[]" type="text"></td>
                           <td><input class="course_text_box" value="<?php echo  $per_of_mark;?>" name="per_of_mark[]" type="text"></td>
                           <td><input class="course_text_box" value="<?php echo $board;?>" name="board_university[]" type="text"></td>
                           <td><input class="course_text_box" value="<?php echo $school;?>" name="school_collage[]" type="text"></td>
                           <td style=" border-right:1px solid #444; ">
                               <input name="qualification_document[]" style=" width:170px; " type="file">
                               <?php
                               if($file==1)
                               {
                               ?>
                               <a href="#" onclick="window.open('../<?php echo $temp_document;?>','size',config='height=600,width=600,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                        <input type="button" class="view_document_button" value="View Document"></a>
                               <?php
                               }else
                               {
                                   echo "<span style='color:red;'><b>No Document Available</b></span>";   
                               }
                               ?>
                               <input type="hidden" name="temp_qualification_document[]" value="<?php echo $temp_document;?>">
                           </td>
                       </tr>
                       <?php
                       $row++;
                    }
                   }else
                   {
                       ?>
                       <tr class="course_td_style">
                           <td></td>
                           <td style=" border-left:0; "><input name="course[]" id="course_1" class="course_text_box" type="text"></td>
                           <td><input class="course_text_box" name="year[]" type="text"></td>
                           <td><input class="course_text_box" name="per_of_mark[]" type="text"></td>
                           <td><input class="course_text_box" name="board_university[]" type="text"></td>
                           <td><input class="course_text_box" name="school_collage[]" type="text"></td>
                           <td style=" border-right:1px solid #444; ">
                               <input name="qualification_document[]" type="file">
                            <input type="hidden" name="temp_qualification_document[]" >
                          
                           </td>
                       </tr>
                     <?php
                   }
                     ?>  
                       <tr>
                           <td colspan="6">
                               <input type="button" onclick="course_new_add()" class="add_new_line" style=" float:left; margin-bottom:0;  " value="Add New">   
                           </td>
                       </tr>
                       
                   </table>   
                       </td>
                   </tr>
                    
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>    
                  <tr>
                       <td colspan="6">
                       <div class="title_heading"><b>Experience Detail</b></div>   
                       </td>
                   </tr>
                   <?php
                    $experiense=$fetch_employee_data['experience'];
                    if(!empty($experiense))
                    {
                   $result_array=array();
                    $explode_comma=explode(" , ",$experiense);
                    foreach($explode_comma as $new_exp_value)
                    {
                      $explode_space=explode(" ",$new_exp_value);
                      $year=$explode_space[0];
                      array_push($result_array,$year);
                    }
                   $year=$result_array[0];
                   $month=$result_array[1];
                   $days=$result_array[2];
                    }  else {
                    $year="zero";  
                    $month="zero";
                    $days="zero";
                    }
                   $experiense_description=$fetch_employee_data['experience_detail']; 
                   ?>
                   
                   <tr>
                       <td colspan="6">
                           <table id="experiense_table" style=" width:100%; ">
                               <tr>
                                   <td><b> Total Experience <sup>*</sup></b></td><td><b>:</b></td>
                                   <td><select id="exp_year" name="exp_year">
                                           <option value="zero">--Year--</option>
                                           <?php
                                           for($i=0;$i<=70;$i++)
                                           {
                                               
                                               if($year==$i)
                                               {
                                               echo "<option value='$i' selected>$i</option>";
                                               }else
                                               {
                                                echo "<option value='$i'>$i</option>";    
                                               }
                                           }
                                           ?>
                                       </select></td>
                                       <td><select id="exp_month" name="exp_month">
                                           <option value="zero">--Month--</option>
                                            <?php
                                           for($i=0;$i<=11;$i++)
                                           {
                                               if($month==$i)
                                               {
                                               echo "<option value='$i' selected>$i</option>";
                                               }else
                                               {
                                                echo "<option value='$i'>$i</option>";    
                                               }
                                           }
                                           ?>
                                       </select></td>
                                       <td><select id="exp_day" name="exp_day">
                                           <option value="zero">--Day--</option>
                                            <?php
                                           for($i=0;$i<=30;$i++)
                                           {
                                                if($days==$i)
                                               {
                                               echo "<option value='$i' selected>$i</option>";
                                               }else
                                               {
                                                echo "<option value='$i'>$i</option>";    
                                               }
                                           }
                                           ?>
                                       </select></td>
                                   <td>
                                       <b>Experience Details</b>
                                       
                                   </td>
                                   <td><b>:</b></td>
                                   <td><textarea name="exp_details" placeholder="Enter experience details" class="experiense_text_area"><?php echo $experiense_description;?></textarea></td>
                               </tr>  
                               
                           </table>    
                       </td>
                   </tr>
                  
                   
                   
                   
                  <tr>
                       <td colspan="6">
                       <div class="title_heading"><b> Achievement Detail</b></div>   
                       </td>
                   </tr>
                   <tr>
                       <td colspan="6">
                           <script type="text/javascript">
                  function achivement_add()
                  {
var r=confirm("Are you sure you want to add new line");
if (r==true)
  { 

   var table=document.getElementById("achievement_table");
    var row=table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
     var cell4 = row.insertCell(3);
     var cell5 = row.insertCell(4);
   
var tbl=document.getElementById("achievement_table");        
var tds=tbl.getElementsByTagName("td");
for(var i=5;i<10;i++)
{
tds[i].style.borderBottom="1px solid #444";
tds[i].style.borderLeft="1px solid #444";
}
tds[6].style.borderLeft="0px solid #444";
tds[9].style.borderRight="1px solid #444";

  cell1.innerHTML="<input onclick='achivement_removeen_buttons(this)' class='remove_button' type='button' value='Remove'>"; 
  cell2.innerHTML='<input  name="achivement_title[]" class="course_text_box" type="text">'; 
  cell3.innerHTML='<textarea  name="achivement_description[]" class="achievement_text_area"></textarea>';
  cell4.innerHTML='<input name="achivement_document_name[]" class="course_text_box" type="text">';
   cell5.innerHTML='<input name="achivement_document_file[]" type="file"><input type="hidden" name="temp_achivement_document_file[]" value="">';
   
  }          
        }
        
  function achivement_removeen_buttons(row)
  {
   var r=confirm("Are you sure you want to remove");
if (r==true)
  { 
       var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('achievement_table').deleteRow(i);
  }   
  }
                   </script>
                           
                          <table id="achievement_table" cellspacing="0" cellpadding="3" class="course_table">
                            <tr class="course_th_style">
                           <td></td>
                           <td><b>Achievement Title</b></td>
                           <td><b>Description</b></td>
                           <td><b>Document Name</b></td>
                           <td><b>Upload Document File</b></td>
                       </tr>
                       
                       <?php
 $achievemnt_db=mysql_query("SELECT * FROM hr_achievement_db WHERE $db_main_details_whout_session employee_id='$employee_unique_id' and is_delete='none'");
 $achivement_num_rows=mysql_num_rows($achievemnt_db);
  if((!empty($achivement_num_rows))||($achivement_num_rows!=0))
 {
      $row=1;
    while ($achivement_data=mysql_fetch_array($achievemnt_db))
      {
          $achivemnt_title=$achivement_data['achievement_title'];
          $description=$achivement_data['description'];
          $document_name=$achivement_data['document_name'];
          $document_file=$achivement_data['document_file'];
          
          if((!empty($document_file))&&(is_file("../".$document_file)))
                   {
                    $file=1;   
                   }  else {
                        $file=0;    
                   }
             
 ?>
                       <tr class="course_td_style">
                           <td>
                               <?php
                               if($row!=$achivement_num_rows)
                               {
                               ?>
                               <input onclick='achivement_removeen_buttons(this)' class='remove_button' type='button' value='Remove'>
                           <?php
                               }
                           ?>
                           </td>
                           <td style=" border-left:0; "><input name="achivement_title[]" value="<?php echo $achivemnt_title;?>" class="course_text_box" type="text"></td>
                           <td><textarea name="achivement_description[]" class="achievement_text_area"><?php echo $description;?></textarea></td>
                           <td><input name="achivement_document_name[]" value="<?php echo $document_name;?>" class="course_text_box" type="text"></td>
                           <td style=" border-right:1px solid #444; ">
                               <input name="achivement_document_file[]" type="file">
                                 <?php
                               if($file==1)
                               {
                               ?>
                               <a href="#" onclick="window.open('../<?php echo $document_file;?>','size',config='height=600,width=600,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                        <input type="button" class="view_document_button" value="View Document"></a>
                               <?php
                               }else
                               {
                                   echo "<span style='color:red;'><b>No Document Available</b></span>";   
                               }
                               ?>
                               <input type="hidden" name="temp_achivement_document_file[]" value="<?php echo $document_file;?>">
                           </td>
                       </tr>
 <?php
 $row++;
      }
 }else
 {
?>  
                        <tr class="course_td_style">
                           <td ></td>
                           <td style=" border-left:0; "><input name="achivement_title[]" class="course_text_box" type="text"></td>
                           <td><textarea name="achivement_description[]" class="achievement_text_area"></textarea></td>
                           <td><input name="achivement_document_name[]" class="course_text_box" type="text"></td>
                           <td style=" border-right:1px solid #444; ">
                               <input name="achivement_document_file[]" type="file">
                               <input type="hidden" name="temp_achivement_document_file[]" value="">
                          
                           </td>
                       </tr>
                       
<?php
 }
?>
                       
                       <tr>
                           <td colspan="6">
                               <input type="button" onclick="achivement_add()" class="add_new_line" style=" float:left; margin-bottom:0;  " value="Add New">   
                           </td>
                       </tr>
                       
                   </table>    
                       </td>
                   </tr>
                   
                   
                    <tr>
                       <td colspan="6">
                       <div class="title_heading"><b>Document Detail</b></div>   
                       </td>
                   </tr>
                   <tr>
                       <td colspan="6">
                          <script type="text/javascript">
                  function document_add()
                  {
var r=confirm("Are you sure you want to add new line");
if (r==true)
  { 

   var table=document.getElementById("document_table");
    var row=table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
var tbl=document.getElementById("document_table");        
var tds=tbl.getElementsByTagName("td");
for(var i=3;i<7;i++)
{
tds[i].style.borderBottom="1px solid #444";
tds[i].style.borderLeft="1px solid #444";
}
tds[4].style.borderLeft="0px solid #444";
tds[5].style.borderRight="1px solid #444";

  cell1.innerHTML="<input onclick='document_removeen_buttons(this)' class='remove_button' type='button' value='Remove'>"; 
  cell2.innerHTML='<input placeholder="Enter document name" name="document_name[]" class="course_text_box" style=" width:350px; " type="text">';
   cell3.innerHTML='<input name="document_file[]" type="file"><input type="hidden" name="temp_document_file[]" value="">';
   
  }          
        }
        
  function document_removeen_buttons(row)
  {
   var r=confirm("Are you sure you want to remove");
if (r==true)
  { 
       var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('document_table').deleteRow(i);
  }   
  }
                   </script>
                             
                           
                         <table id="document_table"  cellspacing="0" cellpadding="3" class="course_table">
                            <tr class="course_th_style">
                           <td></td>
                           <td><b>Document Name</b></td>
                           <td><b>Upload Document File</b></td>
                       </tr>
                    <?php
                    $document_db=mysql_query("SELECT * FROM hr_document_db WHERE  employee_id='$employee_unique_id' and is_delete='none'");
  $document_num_rows=mysql_num_rows($document_db);
  if((!empty($document_num_rows))||($document_num_rows!=0))
 {      $row=1;
       while ($document_data=mysql_fetch_array($document_db))  
      {  
          $e_document_name=$document_data['document_name'];
          $e_document_file=$document_data['document_file'];
           if((!empty($e_document_file))&&(is_file("../".$e_document_file)))
                   {
                    $file=1;   
                   }  else {
                        $file=0;    
                   }
                    ?>   
                       
                       <tr class="course_td_style">
                           <td>
                           <?php
                           if($document_num_rows!=$row)
                           {
                           ?> 
                       <input onclick='document_removeen_buttons(this)' class='remove_button' type='button' value='Remove'>
                           <?php
                           }
                           ?>    
                           </td>
                           <td style=" border-left:0; ">
                               <input name="document_name[]" value="<?php echo $e_document_name;?>" placeholder="Enter document name" class="course_text_box" style=" width:350px; " type="text"></td>
                           <td style=" border-right:1px solid #444; ">
                               
                            <input name="document_file[]" type="file">
                              <?php
                               if($file==1)
                               {
                               ?>
                               <a href="#" onclick="window.open('../<?php echo $e_document_file;?>','size',config='height=600,width=600,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                        <input type="button" class="view_document_button" value="View Document"></a>
                               <?php
                               }else
                               {
                                   echo "<span style='color:red;'><b>No Document Available</b></span>";   
                               }
                               ?>
                            
                            <input type="hidden" name="temp_document_file[]" value="<?php echo $e_document_file;?>">
                            
                           </td>
                       </tr>
               <?php
               $row++;
      }
 }else
 {
?>  
 <tr class="course_td_style">
                           <td ></td>
                           <td style=" border-left:0; ">
                               <input name="document_name[]" placeholder="Enter document name" class="course_text_box" style=" width:350px; " type="text"></td>
                           <td style=" border-right:1px solid #444; "><input name="document_file[]" type="file">
                           <input type="hidden" name="temp_document_file[]" value="">
                            
                           </td>
                       </tr>                      
<?php
 }
?> 
                       
                       
                       <tr>
                           <td colspan="6">
                               <input type="button" onclick="document_add()" class="add_new_line" style=" float:left; margin-bottom:0;  " value="Add New">   
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
               $bank_name=$fetch_employee_data['bank_name'];
         $branch=$fetch_employee_data['branch'];
         $phone=$fetch_employee_data['phone'];
         $bank_address=$fetch_employee_data['bank_address'];
         $ifsc_code=$fetch_employee_data['ifsc_code'];
         $account_no=$fetch_employee_data['account_no'];
         $dd_payable_address=$fetch_employee_data['dd_payable_address'];
         ?> 
               
           
               
               
              <div class="admission_setep" id="form_no_5" >
              <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td colspan="9">
                           <div class="title_heading"><b>Bank Details</b></div>   
                       </td>
                   </tr>
                   <style>
                      #bank_name_chosen{ width:250px; } 
                       </style>
                   
                   <tr>
                       <td><b>Bank Name </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                              <select id="bank_name" name="bank_name" data-placeholder="---Select Bank---" class="chosen-select"
                                   tabindex="-1" style=" width:330px; ">
         <option value="0"></option>
         <?php
         
        
         $country_array=array("Abhyudaya Co-Op Bank Ltd",
	"Abu Dhabi Commercial Bank",
	"Ahmedabad Mercantile Co-Op Bank Ltd",
	"Allahabad Bank",
	"Almora Urban Co-Operative Bank Ltd",
	"Andhra Bank",
	"Andhra Pragathi Grameena Bank",
	"Apna Sahakari Bank Ltd",
	"Austarlia and New Zealand Banking Gorup Ltd",
	"Axis Bank",
	"Bank Internasional Indonesia",
	"Bank Of America",
	"Bank Of Bahrain And Kuwait",
	"Bank Of Baroda",
	"Bank Of Ceylon",
	"Bank Of India",
	"Bank Of Maharashtra",
	"Bank Of Nova Scotia",
	"Bank Of Tokyo-Mitsubishi Ufj Ltd",
	"Barclays Bank Plc",
	"Bassein Catholic Co-Op Bank Ltd",
	"Bharat Co-Op Bank (Mumbai) Ltd",
	"Bnp Paribas",
	"Canara Bank",
	"Capital Local Area Bank Ltd",
	"Catholic Syrian Bank Ltd",
	"Central Bank Of India",
	"Chinatrust Commercial Bank",
	"Citibank",
	"Citizencredit Co-Op Bank Ltd",
	"City Union Bank Ltd",
	"Commonwealth Bank of Australia",
	"Corporation Bank",
	"Cosmos Co-Op Bank Ltd",
	"Credit Agricole Corp and Investment Bank",
	"Credit Suisse Ag",
	"Dbs Bank Ltd",
	"Dena Bank",
	"Deutsche Bank Ag",
	"Development Credit Bank Ltd",
	"Dhanlaxmi Bank Ltd",
	"Dicgc",
	"Dombivli Nagari Sahakari Bank Ltd",
	"Federal Bank Ltd",
	"Firstrand Bank Ltd",
	"Greater Bombay Co-Op Bank Ltd",
	"Gurgaon Gramin Bank",
	"Hdfc Bank Ltd",
	"Hsbc",
	"Icici Bank Ltd",
	"Idbi Bank Ltd",
	"Indian Bank",
	"Indian Overseas Bank",
	"Indusind Bank Ltd",
	"Ing Vysya Bank Ltd",
	"Jalgaon Janata Sahkari Bank Ltd",
	"Jammu And Kashmir Bank Ltd",
	"Janakalyan Sahakari Bank Ltd",
	"Janaseva Sahakari Bank Ltd Pune",
	"Janata Sahkari Bank Ltd Pune",
	"Jpmorgan Chase Bank",
	"Kallappanna Awade Ich Janata S Bank",
	"Kalupur Commercial Co Op Bank Ltd",
	"Kalyan Janata Sahakari Bank Ltd",
	"Kapole Co-Op Bank",
	"Karnataka Bank Ltd",
	"Karnataka State Co-Op Apex Bank Ltd",
	"Karnataka Vikas Grameena Bank",
	"Karur Vysya Bank",
	"Kotak Mahindra Bank",
	"Kurmanchal Nagar Sahakari Bank Ltd",
	"Lakshmi Vilas Bank Ltd",
	"Mahanagar Co-Op Bank Ltd",
	"Maharashtra State Co-Op Bank",
	"Mashreq Bank Psc",
	"Mehsana Urban Co-Op Bank Ltd",
	"Mizuho Corporate Bank Ltd",
	"Mumbai District Central Co-Op Bank Ltd",
	"Nagpur Nagarik Sahakari Bank Ltd",
	"Nainital Bank Ltd",
	"National Australia Bank",
	"New  India Co-Op  Bank  Ltd",
	"Nkgsb Co-Op Bank Ltd",
	"North Malabar Gramin Bank",
	"Nutan Nagarik Sahakari Bank Ltd",
	"Oman International Bank Saog",
	"Oriental Bank Of Commerce",
	"Parsik Janata Sahakari Bank Ltd",
	"Prathama Bank",
	"Prime Co-Operative Bank Ltd",
	"Punjab And Maharashtra Co-Op Bank Ltd",
	"Punjab And Sind Bank",
	"Punjab National Bank",
	"Rabobank International (CCRB)",
	"Rajkot Nagarik Sahakari Bank Ltd",
	"Ratnakar Bank Ltd",
	"Reserve Bank Of India",
	"Royal Bank Of Scotland",
	"Saraswat Co-Op Bank Ltd",
	"SBER Bank",
	"Shamrao Vithal Co-Op Bank Ltd",
	"Shinhan Bank",
	"Shri Chhatrapati Rajarshi Shahu Urban Co-Op Bank Ltd",
	"Societe Generale",
	"South Indian Bank",
	"Standard Chartered Bank",
	"State Bank Of Bikaner And Jaipur",
	"State Bank Of Hyderabad",
	"State Bank Of India",
	"State Bank Of Mauritius Ltd",
	"State Bank Of Mysore",
	"State Bank Of Patiala",
	"State Bank Of Travancore",
	"Sumitomo Mitsui Banking Corporation",
	"Surat Peoples Co-Op Bank Ltd",
	"Syndicate Bank",
	"Tamilnad Mercantile Bank Ltd",
	"Tamilnadu State Apex Co-Op Bank Ltd",
	"Thane Bharat Sahakari Bank Ltd",
	"Thane District Central Co-operative Bank Ltd",
	"Thane Janata Sahakari Bank Ltd",
	"The A.P. Mahesh Co-Op Urban Bank Ltd",
	"The Akola District Central Co-operative Bank",
	"The Gadchiroli District Central Co-operative Bank Ltd",
	"The Gujarat State Co-Operative Bank Ltd",
	"The Jalgaon Peoples Co-op Bank",
	"The Kangra Co-Operative Bank Ltd.",
	"The Karad Urban Co-Op Bank Ltd",
	"The Municipal Co-Operative Bank Ltd. Mumbai",
	"The Nasik Merchants Co-Op Bank Ltd",
	"The Rajasthan State Co-Operative Bank Ltd",
	"The Sahebrao Deshmukh Co-op Bank Ltd.",
	"The Seva Vikas Co-operative Bank Ltd",
	"The Surat District Co-Operative Bank Ltd",
	"The Sutex Co Op Bank Ltd",
	"The Varachha Co-Op. Bank Ltd",
	"The Vishweshwar Sahakari Bank Ltd Pune",
	"Tumkur Grain Merchants Cooperative Bank Ltd",
	"UBS AG",
	"Uco Bank",
	"Union Bank Of India",
	"United Bank Of India",
	"Vasai Vikas Sahakari Bank Ltd",
	"Vijaya Bank",
	"West Bengal State Co-Op Bank Ltd",
	"Westpac Banking Corporation",
	"<option >Woori Bank",
	"Yes Bank Ltd",
        "Other Bank");
         
    foreach ($country_array as $bank)
    {
        $temp_bank_name="$bank_name";
        if($bank==$temp_bank_name)
        {
            echo "<option selected>$bank</option>";    
        }else
        {
           echo "<option>$bank</option>";  
        }
    }
         
                               ?>
                              </select>
                         </td>
                       
                       <td><b>Branch</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                           <input type="text" value="<?php echo $branch;?>" id="bank_branch" name="bank_branch" class="text_box_styling"
                                  placeholder="Enter branch name">
                       </td>
                       
                   
                       <td><b>Phone</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $phone;?>" name="bank_phone" id="bank_phone"
                                  class="text_box_styling"
                                  placeholder="Enter phone number"></td>
                       </tr>
                       
                       <tr>
                           <td><b>Bank Address</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td colspan="7">
                           <textarea placeholder="Enter bank address" 
                                     id="bank_address" name="bank_address"
                                     style=" width:96.5%; height:45px; border:1px solid silver; "><?php echo $bank_address;?></textarea>   
                       </td>
                       </tr>
                       
                       
                       <tr>
                       <td><b>IFSC Code </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                           <input type="text" value="<?php echo $ifsc_code;?>" id="ifsc_code" name="ifsc_code" class="text_box_styling"
                                  placeholder="Enter IFSC Code">
                           </select>
                         </td>
                       
                       <td><b>Account No. </b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                          <input type="text" value="<?php echo $account_no;?>" onkeypress="javascript:return isNumber (event)" id="account_no" name="account_no" class="text_box_styling"
                                  placeholder="Enter account no.">
                       </td>
                       
                       <td><b>Confirm Account No. </b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td>
                          <input type="text" value="<?php echo $account_no;?>" onkeypress="javascript:return isNumber (event)" id="confirm_account_no" name="confirm_account_no" class="text_box_styling"
                                  placeholder="Enter confirm account no.">
                       </td>
                       </tr>
                       
                        <tr>
                            <td><b>DD Payable Address</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td colspan="7">
                           <textarea placeholder="Enter DD payable address" 
                                     id="dd_payable_address" name="dd_payable_address" 
                                     style=" width:96.5%; height:45px; border:1px solid silver;"><?php echo $dd_payable_address;?></textarea>   
                       </td>
                       </tr>
                       
                   
                   
                      <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   
                   <tr>
                        <td><input type="button" onclick="per_form_no_4('4')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="9">
                          <input type="button" onclick="return form_no_6('6')" class="continue_button_styling" value="Next">
                          <input type="button" onclick="return skip_form_no_6('6')" class="continue_button_styling" style=" margin-right:10px; " value="Skip">
                         
                       
                       </td>
                   </tr>
              </table>
              </div> 
                   
            
               
               
                <script type="text/javascript">
                  function language_add()
                  {
var r=confirm("Are you sure you want to add new line");
if (r==true)
  { 

   var table=document.getElementById("language_table");
    var row=table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
     var cell3 = row.insertCell(2);
      var cell4 = row.insertCell(3);
       var cell5 = row.insertCell(4);
var tbl=document.getElementById("language_table");        
var tds=tbl.getElementsByTagName("td");
for(var i=3;i<10;i++)
{
tds[i].style.borderBottom="1px solid #444";
tds[i].style.borderLeft="1px solid #444";
}
tds[6].style.borderLeft="0px solid #444";
tds[9].style.borderRight="1px solid #444";

  cell1.innerHTML="<input onclick='language_removeen_buttons(this)' class='remove_button' type='button' value='Remove'>"; 
  cell2.innerHTML='<input class="course_text_box" name="language[]" placeholder="Enter language" style=" width:300px; " type="text">';
  cell3.innerHTML='<input name="language_read[]" type="checkbox">';
  cell4.innerHTML='<input name="language_write[]" type="checkbox">';
  cell5.innerHTML='<input name="language_spoke[]" type="checkbox">';          
   
  }          
        }
        
  function language_removeen_buttons(row)
  {
   var r=confirm("Are you sure you want to remove");
if (r==true)
  { 
       var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('language_table').deleteRow(i);
  }   
  }
                   </script>
                             
             <?php
             $hobbies=ucwords($fetch_employee_data['hobbies']);
             ?>  
               
             <div class="admission_setep" id="form_no_6" >
           
               <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="6"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Other Detail</b></div>   
                       </td>
                   </tr>
                   <tr>
                       <td colspan="9">
                           <table>
                        <td><b>Hobbies</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="hobbies" name="hobbies" class="achievement_text_area"><?php echo $hobbies;?></textarea></td>
                     
                         
                           </table>
                       </td>
                   </tr>
                     <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   
                    <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Language Detail</b></div>   
                       </td>
                   </tr>
                   <tr>
                       <td colspan="9">
                        <table id="language_table" cellspacing="0" cellpadding="3" class="course_table">
                            <tr class="course_th_style">
                           <td></td>
                           <td><b>Language</b></td>
                           <td><b>Read</b></td>
                           <td><b>Write</b></td>
                           <td><b>Spoke</b></td>
                       </tr>
                       <?php
                       
   $language_db=mysql_query("SELECT * FROM hr_language_db WHERE employee_unique_id='$employee_unique_id' and is_delete='none'");
  $language_num_rows=mysql_num_rows($language_db);
  if((!empty($language_num_rows))||($language_num_rows!=0))
 {
      $row=1;
      while ($language_data=mysql_fetch_array($language_db))  
      {  
          $language_name=$language_data['language'];
          $read=strtoupper($language_data['read']);
          $write=strtoupper($language_data['write']);
          $spoke=strtoupper($language_data['spoke']);
          
          if($read=="ON")
          {
           $read="checked";   
          }  else {
             $read=""; 
          }
          
           if($write=="ON")
          {
           $write="checked";   
          }  else {
             $write=""; 
          }
          
           if($spoke=="ON")
          {
           $spoke="checked";   
          }  else {
             $spoke=""; 
          }
                       ?>
                       <tr class="course_td_style">
                           <td>
  <?php
  if($language_num_rows!=$row)
  {
  ?>                             
<input onclick='language_removeen_buttons(this)' class='remove_button' type='button' value='Remove'>   
   <?php
  }
   ?>                       
                           </td>
                           <td style=" border-left:0; width: 400px; ">
                               <input class="course_text_box"  value="<?php echo $language_name;?>" name="language[]" id="language_1" placeholder="Enter language" style=" width:300px; " type="text"></td>
                           <td><input name="language_read[]"  type="checkbox" <?php echo $read;?>></td>
                           <td><input name="language_write[]"  type="checkbox" <?php echo $write;?>></td>
                           <td style=" border-right:1px solid #444; "><input name="language_spoke[]" type="checkbox" <?php echo $spoke;?>></td>
                       </tr>
                      <?php
                      $row++;
      }
 }else
 {
                      ?> 
            <tr class="course_td_style">
                           <td></td>
                           <td style=" border-left:0; width: 400px; ">
                               <input class="course_text_box" name="language[]" id="language_1" placeholder="Enter language" style=" width:300px; " type="text"></td>
                           <td><input name="language_read[]" type="checkbox"></td>
                           <td><input name="language_write[]" type="checkbox"></td>
                           <td style=" border-right:1px solid #444; "><input name="language_spoke[]" type="checkbox"></td>
                       </tr>           
                       <?php
 }
                       ?>
                       <tr>
                           <td colspan="6">
                               <input type="button" onclick="language_add()" class="add_new_line" style=" float:left; margin-bottom:0;  " value="Add New">   
                           </td>
                       </tr>
                       
                   </table>       
                       </td>
                   </tr>
                   
                    <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Hostel & Transport Allot</b></div>   
                       </td>
                   </tr>
                  <?php
$hostel=$fetch_employee_data['hostel'];
 $hostel_join_date=$fetch_employee_data['hostel_joining_date'];
 $hostel_description=$fetch_employee_data['hostel_description'];
 $transport=$fetch_employee_data['transport'];
 $trnasport_joing_date=$fetch_employee_data['transport_joining_date'];
 $transport_description=$fetch_employee_data['transport_description'];
           
 if($hostel=="on")
 {
   $hostel="checked";  
 }
 
 if($transport=="on")
 {
 $transport="checked";    
 }
                  ?> 
                   
                   <tr>
                       <td colspan="9">
                            <table id="achievement_table" cellspacing="0" cellpadding="3" class="course_table">
                       <tr>
                       <td><b>Hostel</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td style=" width:10%; "><input name="hostel" id="hostel" type="checkbox" <?php echo $hostel;?>></td>
                      
                       <td><b>Joining Date</b></td>
                       <td><b>:</b></td>
                       <td>
                           <input name="hostel_joining_date" value="<?php echo $hostel_join_date;?>" id="hostel_joining_date" class="text_box_styling" type="text">
                       </td>
                       <td><b>Description</b></td>
                       <td><b>:</b></td>
                       <td><textarea name="hostel_description" id="hostel_description" class="achievement_text_area"><?php echo $hostel_description;?></textarea></td>
                     
                   </tr>
                   
                    <tr>
                       <td><b>Transport</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="transport" name="transport" type="checkbox" <?php echo $transport;?>></td>
                       <td><b>Joining Date</b></td>
                       <td><b>:</b></td>
                       <td>
                           <input id="transport_joining_date" value="<?php echo $trnasport_joing_date;?>" name="transport_joining_date" class="text_box_styling" type="text">
                       </td>
                       <td><b>Description</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="transport_description" name="transport_description" class="achievement_text_area"><?php echo $transport_description;?></textarea></td>
                     
                     
                   </tr>
                            </table>
                       </td>
                   </tr>
                  

                     <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   
                   <tr>
                        <td><input type="button" onclick="per_form_no_5('5')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="5">
                          <input type="button" onclick="form_no_7('7')" class="continue_button_styling" value="Next">
                             <input type="button" onclick="skip_form_no_7('7')" class="continue_button_styling" style=" margin-right:10px; " value="Skip">
                         
                       
                       </td>
                   </tr>
               </table>
              </div>  
               
            
               
              <div class="admission_setep" id="form_no_7">
              <table cellspacing="0" cellpadding="0" class="student_details_table">
                   <tr>
                       <td colspan="9"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                   </tr>
                   
                     <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                       <td  colspan="9">
                           <div class="title_heading"><b>Declaration</b></div>   
                       </td>
                   </tr>
                   <tr>
                       <td><input class="check_box_styling" id="under_taking_check" name="declaration" value="yes" type="checkbox"></td>
                    <td><b> I certify that the information contained in this
                            application is correct to the best of my knowledge and understand that
                            falsification is ground for dismissal in accordance with the policy 
                            of School/College. You are hereby authorized to investigate all the
                            statements made in this application. I further understand that if I
                            am hired I will not have an employment contract and that my employment
                            and compensation can be terminated with or without notice or cause at
                            any time by School/College or me.</b>
                  </td>
                   </tr>
                 
                    <tr>
                       <td style=" height:40px; "></td>
                   </tr>
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   
                   <tr>
                        <td><input type="button" onclick="per_form_no_6('6')"
                                               class="continue_button_styling" style=" float:left; " value="Previous"></td>
                 
                       <td colspan="5">
                          <td colspan="4"><input type="submit" name="save_process_details"
                                              onclick="return next_finish_page_details()" class="continue_button_styling" value="Update"></td>
                   
                       </td>
                   </tr>
               </table>
              </div>
               
           </div>   
            
       </div>
   
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
      yearRange:'1950:2013',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
    $("#joining_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
     $("#hostel_joining_date").datepicker({ 
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
           
         <script type="text/javascript">
  function page_load()
  {
     
   $(document).ready(function(){
    if($('#curr_country option:contains("<?php echo $employee_current_country;?>")'))
    {
   $('#curr_country option:contains("<?php echo $employee_current_country;?>")').prop("selected",true);
    }
   if($('#per_country option:contains("<?php echo $employee_permanent_country;?>")'))
   {
   $('#per_country option:contains("<?php echo $employee_permanent_country;?>")').prop("selected",true);
   }
   
   if($('#bank_name option:contains("<?php echo $bank_name;?>")'))
   {
       
   $('#bank_name option:contains("<?php echo $bank_name;?>")').prop("selected",true);
   }
   });
   
   
  }
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
         
          </form>
        
        <?php
     }
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