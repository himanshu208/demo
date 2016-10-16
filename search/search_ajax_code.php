<?php
//SESSION CONFIGURATION
$check_array_in="search_student";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php

require_once '../connection.php';
if((!empty($_REQUEST['student_admission_id']))&&(!empty($_REQUEST['student_db_id'])))
{
 $student_admission_id=$_REQUEST['student_admission_id'];
 $student_db_id=$_REQUEST['student_db_id'];
 
            
         
         $student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as encrpt_id,T1.user_name as student_user_name"
                 . ",T1.temp_password as student_password,T6.user_name as parent_user_name"
                 . ",T6.temp_password as parent_password FROM student_db as T1"
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
                 . " $db_t1_main_details T1.id='$student_db_id' and T1.student_id='$student_admission_id' and T1.is_delete='none'");
         
         
         $fetch_student_data=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);
         if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
         {
  
         $student_db_id=$fetch_student_data['db_id'];
         $student_encrypt_id=$fetch_student_data['encrpt_id'];       
$db_id=$fetch_student_data['db_id'];    
$student_unqiue_id=$fetch_student_data['student_id'];

$form_sr_no=$fetch_student_data['sr_no'];
$admission_no=$fetch_student_data['admission_no'];
$student_roll_no=$fetch_student_data['roll_no'];       
$student_admission_date=$fetch_student_data['admission_date'];  
$enrollment_no=$fetch_student_data['enrollment_no'];  
$course_name=$fetch_student_data['course_name'];             
$section_name=$fetch_student_data['section_name'];
$session_name=$fetch_student_data['session_name'];
$category_name=$fetch_student_data['category_name'];
$house_name=ucwords($fetch_student_data['house_name']);
 
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
    if(empty($student_photo))
    {
    $student_photo="images/no_avilable_image.gif";    
    }  else {
      $student_photo=$student_photo;    
       
    }
    
    
    
    $studnet_handicapped=$fetch_student_data['student_handicapped'];
    
    if(($studnet_handicapped==0))
    {
    $studnet_handicapped="No";    
    }else
    {
      $studnet_handicapped="Yes"; 
    }
    
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
    
    if(empty($student_local_parent_photo))
    {
    $student_local_parent_photo="images/no_avilable_image.gif";    
    }  else {
      $student_local_parent_photo=$student_local_parent_photo;    
       
    }
    
    
    $student_previous_class=$fetch_student_data['previous_class_name'];
    $student_core_subject=$fetch_student_data['previous_class_core_subject'];
    $student_board_university=$fetch_student_data['previous_class_board'];
    $student_passing_year=$fetch_student_data['previous_class_passing_year'];
    $student_per_of_marks=$fetch_student_data['previous_class_per_of_mark'];
    $student_extra_activities=$fetch_student_data['previous_class_extra_activities'];
    $student_school_name=$fetch_student_data['previous_class_school_name'];
    $student_school_address=$fetch_student_data['previous_class_school_address'];
    
    
    $student_hostel_id=$fetch_student_data['hostel'];
    $student_hostel_type_id=$fetch_student_data['hostel'];
    $student_hostel_room_id=$fetch_student_data['room'];
    
    $student_transport_route_id=$fetch_student_data['route'];
    $student_transport_vehicle_type_id=$fetch_student_data['vehicle_type'];
    $student_transport_vehicle_reg_no=$fetch_student_data['vehicle'];
   
    
    $fetch_admission_document=$fetch_student_data['submitted_document'];
    $explode_document_explode=explode("@,@",$fetch_admission_document);
    $implode_document_attechment=implode(",",$explode_document_explode);
    
    
    
    $transport_id=$fetch_student_data['transport_id'];
    $hostel_id=$fetch_student_data['hostel_id'];
    $health_card_id=$fetch_student_data['health_card_id'];
     $account=$fetch_student_data['account_status'];   
    if($account=="inactive")
    {
     $bg_color="yellowgreen";
     $account_value="active";
    }else
    {
      $bg_color="red";
     $account_value="inactive";   
    }
    
    $student_user_name=$fetch_student_data['student_user_name'];   
    $student_password=$fetch_student_data['student_password'];         
        echo "    
       <div id='first_top_div_tags'> </div>         
<br/>   
                <table cellspacing='0' cellpadding='0' class='admission_form_tables'>
                   
                    <tr>
                        <td colspan='9'><div class='heading_title' style=' background-color:whitesmoke; padding-bottom:4px;'>Student Full Details</div></td>
                    </tr>
                     <tr>
<td colspan='10'>";
        
        {
        ?>
<div id="first_top_div_tags">
    
       <div class="button_style" onclick="back_button()" style="background-color:orange;">Back</div>
       <a href="#" onclick="window.open('student_details_print.php?token_id=<?php echo $student_encrypt_id;?>','size',config='height=700,width=1050,position=absolute,left=100,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       <div class="button_style" style=" background-color:#4700B2; ">Print</div></a>
   
       <a href="#" onclick="window.open('../admission/addmision_form_print.php?token_id=<?php echo $student_encrypt_id;?>','size',config='height=700,width=1050,position=absolute,left=100,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       <div class="button_style" style="background-color:#3385FF;">Admission Form Print</div></a>
       
       <div class="button_style" id="student_account_status" onclick="inactive_account('<?php echo $student_unqiue_id;?>','<?php echo $db_id;?>','<?php echo $account_value;?>')"
            style="background-color:<?php echo $bg_color;?>;">Account <?php echo ucwords($account_value);?></div>
       
      
       <div class="button_style" onclick="delete_data('<?php echo $student_unqiue_id;?>','<?php echo $db_id;?>','student_delete_command')" style="background-color:red;">Delete</div>
       
       <a href="../admission/edit_student_detail.php?token_id=<?php echo $student_encrypt_id;?>">
       <div class="button_style" style="background-color:green;">Edit</div></a>
      
    
    
    
    </div>
        <?php
         }
echo"</td>                     
</tr><tr><td style='heigth:40px;'></td></tr>
                   
                    <tr>
                        <td colspan='9'><span><b>Admission Details</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>                    
                    <tr>
                        <td><b>Admission No.</b></td><td><b>:</b></td><td>$admission_no</td>
                        
                        <td><b>Admission Date</b></td><td><b>:</b></td><td>$student_admission_date</td>
                        
                        <td><b>Enrollment No</b></td><td><b>:</b></td><td>$enrollment_no</td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                        <td><b>Form/Sr No.</b></td><td><b>:</b></td><td>$form_sr_no</td>
                        
                        <td><b>Roll No.</b></td><td><b>:</b></td><td>$student_roll_no</td>
                    </tr>
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Student Personal Details</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Class</b></td><td><b>:</b></td><td>$course_name</td>
                    
                    <td><b>Section</b></td><td><b>:</b></td><td>$section_name</td>
                    
                    <td><b>Session</b></td><td><b>:</b></td><td>$session_name</td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>House</b></td><td><b>:</b></td><td>$house_name</td>
                    
                    <td><b>Sub-Status</b></td><td><b>:</b></td><td> $sub_status</td>
                    <td></td><td></td>
                     </tr>
                      <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Student Name</b></td><td><b>:</b></td><td>$student_full_name</td>
                    
                    <td><b>Gender</b></td><td><b>:</b></td><td>$student_gender</td>
                    <td></td><td></td>
                    <td rowspan='9' style=' width:160px; '><img class='student_image' src='../$student_photo'></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Date Of Birth</b></td><td><b>:</b></td><td>$student_dob</td>
                    
                    <td><b>Blood Group</b></td><td><b>:</b></td><td> $student_blood_group</td>
                    <td></td><td></td>
                     </tr>
                     
                      <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Birth Place</b></td><td><b>:</b></td><td> $student_birth_place</td>
                    
                    <td><b>Nationality</b></td><td><b>:</b></td><td> $student_nationality</td>
                    <td></td><td></td>
                     </tr>
                     
                      <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Religion</b></td><td><b>:</b></td><td> $student_religion</td>
                    
                    <td><b>Mother Tongue</b></td><td><b>:</b></td><td> $student_mother_tongue</td>
                    <td></td><td></td>
                     </tr>
                     
                     <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Category</b></td><td><b>:</b></td><td> $category_name</td>
                    
                    <td><b>Sub Category</b></td><td><b>:</b></td><td> $student_sub_category</td>
                    <td></td><td></td>
                     </tr>
                      <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                     <tr>
                    <td><b>Student Mobile No</b></td><td><b>:</b></td><td> $student_mobile</td>
                    
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $student_email</td>
                    
                    <td><b>Handicapped</b></td><td><b>:</b></td><td> $studnet_handicapped</td>
                    </tr>
                    
                    
                    
                     <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Student Login Account Detail</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                      <tr>
                    <td><b>Username</b></td><td><b>:</b></td><td>$student_user_name</td>
                    
                    <td><b>Password</b></td><td><b>:</b></td><td> $student_password</td>
                    <td></td><td></td>
                     </tr>
                    
                    
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Current Address Details</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Current Address</b></td><td><b>:</b></td><td colspan='4'> $student_current_address</td>
                        <td><b>Nearest Area</b></td><td><b>:</b></td><td> $student_current_nearest_area</td>
                    
                    </tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    
                    <td><b>City</b></td><td><b>:</b></td><td> $student_current_city</td>
                    
                    <td><b>District</b></td><td><b>:</b></td><td> $student_current_desctric</td>
 <td><b>Post</b></td><td><b>:</b></td><td> $student_current_post</td>
                                            

                    </tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Pin code</b></td><td><b>:</b></td><td> $student_current_pincode</td>
                    
                    <td><b>State</b></td><td><b>:</b></td><td> $student_current_state</td>
                    
                    <td><b>Country</b></td><td><b>:</b></td><td> $student_current_country</td>
                    </tr>
                    
                    
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Permanent Address Details</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Permanent Address</b></td><td><b>:</b></td><td colspan='4'> $student_permanent_address</td>
<td><b>Nearest Area</b></td><td><b>:</b></td><td> $student_permanent_nearest_area</td>
                                         
</tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    
                    <td><b>City</b></td><td><b>:</b></td><td> $student_permanent_city</td>
                    
                    <td><b>District</b></td><td><b>:</b></td><td> $student_permanent_desctric</td>
                    <td><b>Post</b></td><td><b>:</b></td><td> $student_permanent_post</td>
                    
                    </tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Pin code</b></td><td><b>:</b></td><td> $student_permanent_pincode</td>
                    
                    <td><b>State</b></td><td><b>:</b></td><td> $student_permanent_state</td>
                    
                    <td><b>Country</b></td><td><b>:</b></td><td> $student_permanent_country</td>
                    </tr>
                    
                    
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Parent Details ( Father Details )</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Father Name</b></td><td><b>:</b></td><td> $student_father_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $student_father_mobile_no</td>
                    <td></td><td></td>
                    <td rowspan='8' style=' width:160px; '><img class='student_image' src='../$student_father_photo'></td>
                    </tr>
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td>  $student_father_email_id</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $student_father_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $student_father_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $student_father_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Parent Details ( Mother Details )</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Mother Name</b></td><td><b>:</b></td><td> $student_mother_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $student_mother_mobile_no</td>
                    <td></td><td></td>
                    <td rowspan='8' style=' width:160px; '><img class='student_image' src='../$student_mother_photo'></td>
                    </tr>
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $student_mother_email_id</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $student_mother_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $student_mother_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $student_mother_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>";
                    
                    
                    
                    
                   if((!empty($student_local_parent_relation))&&(!empty($student_local_parent_name))) 
                   {
                    
                   echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Local Guardian Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Guardian Relation</b></td><td><b>:</b></td><td> $student_local_parent_relation</td>
                    
                    <td><b></b></td><td></td><td></td>
                    <td></td><td></td>
                    <td rowspan='10' style=' width:160px; '><img class='student_image' src='../$student_local_parent_photo'></td>
                    </tr>
                    
                     <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Guardian Name</b></td><td><b>:</b></td><td> $student_local_parent_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $student_local_parent_mobile_no</td>
                    <td></td><td></td>
                    
                    
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $student_local_parent_email</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $student_local_parent_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $student_local_parent_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $student_local_parent_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>";
                    
                   }
                
                   $parent_user_name=$fetch_student_data['parent_user_name'];   
                   $parent_password=$fetch_student_data['parent_password'];         
                   
                   echo "<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Parent Login Account Detail</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                      <tr>
                    <td><b>Username</b></td><td><b>:</b></td><td>$parent_user_name</td>
                    
                    <td><b>Password</b></td><td><b>:</b></td><td>$parent_password</td>
                    <td></td><td></td>
                     </tr>
                    ";
                   
                    
                   if((!empty($student_previous_class))&&($student_board_university))
                   {
                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Previous Class Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Previous Class/Course</b></td><td><b>:</b></td><td> $student_previous_class</td>
                    
                    <td><b>Core Subject</b></td><td><b>:</b></td><td colspan='4'> $student_core_subject</td>
                    
                   </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                     <tr>
                    <td><b>Board/University</b></td><td><b>:</b></td><td> $student_board_university</td>
                    
                    <td><b>Passing Year</b></td><td><b>:</b></td><td>  $student_passing_year</td>
                    
                    <td><b>% Of Marks</b></td><td><b>:</b></td><td> $student_per_of_marks %</td>
                    </tr>
                    
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                     <tr>
                    <td><b>Extra Curricular Activities</b></td><td><b>:</b></td><td> $student_extra_activities</td>
                    
                    <td><b>School/Collage Name</b></td><td><b>:</b></td><td colspan='4'> $student_school_name</td>
                    </tr>
                        <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                       <td><b>School/Collage Address</b></td><td><b>:</b></td><td colspan='7'> $student_school_address</td>
                       </tr>   
                       
                       ";
                    
                   }
                   
                   
                   if(!empty($implode_document_attechment))
                   {
                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Document Attachment/Submitted</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'>";
                       
                    $explode_document_attachment=explode(",", $implode_document_attechment);
                    $row_count=0;
                    foreach ($explode_document_attachment as $documnet_file)
                    {
                    $row_count++;
                    
                    
                    echo "<div style=' width:auto; height:auto; padding-right:15px; float:left;'><b>$row_count</b>.$documnet_file</div>";
                        
                    }
                    
                    
                    
                       echo"</td>
                    </tr>";
                   }
                    
              
                     if(!empty($hostel_id))
                    {
                   
         $student_hostel_db=mysql_query("SELECT *,TBL1.description as hostel_description FROM student_allot_hostel as TBL1 "
                 . "LEFT JOIN hostel_db as TBL2 ON TBL1.hostel=TBL2.hostel_unique_id "
                 . "LEFT JOIN hostel_room_db as TBL3 ON TBL1.room=TBL3.room_unique_id "
                 . "WHERE TBL1.hostel_unique_id='$hostel_id'");          
           $student_hostel_data=mysql_fetch_array($student_hostel_db);
           $student_hostel_num_rows=mysql_num_rows($student_hostel_db);
              if((!empty($student_hostel_data))&&($student_hostel_data!=null)&&($student_hostel_num_rows!=0))
              {
                  $hostel_name=$student_hostel_data['hostel_name'];
                  $hostel_type_id=$student_hostel_data['hostel_type_id'];
                  $room_number=$student_hostel_data['room_no'];
                  $joining_date=$student_hostel_data['start_service_date'];
                  $food_prrefred=ucwords($student_hostel_data['food_preference']);
                  $description=$student_hostel_data['hostel_description'];
                   
                  
                  $hostel_type_db=mysql_query("SELECT * FROM hostel_type_db WHERE hostel_type_unique_id='$hostel_type_id' and "
                          . "is_delete='none'");
                  $hostel_type_data=mysql_fetch_array($hostel_type_db);
                  $hostel_type_num_rows=mysql_num_rows($hostel_type_db);
                  if((!empty($hostel_type_data))&&($hostel_type_data!=null)&&($hostel_type_num_rows!=0))
                  {
                   $hostel_type=$hostel_type_data['hostel_type'];  
                  }else
                  {
                  $hostel_type="";    
                  }
                  
                  
                       echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b> Hostel Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    
                    <td><b>Hostel Type</b></td><td><b>:</b></td><td>$hostel_type</td>
                    
                    <td><b>Hostel Name</b></td><td><b>:</b></td><td>$hostel_name</td>
                    
                    <td><b>Room Number</b></td><td><b>:</b></td><td>$room_number</td>
                    </tr>
                    <tr>
                    
                    <td><b>Joining Date</b></td><td><b>:</b></td><td>$joining_date</td>
                    
                    <td><b>Food Preference </b></td><td><b>:</b></td><td>$food_prrefred</td>
                    
                    <td><b>Description</b></td><td><b>:</b></td><td>$description</td>
                    </tr>";
              }
                    }
                   
                   
                   if((!empty($transport_id)))
                   {
                   
                   $student_allot_transport_db=mysql_query("SELECT * FROM student_allot_transport as TB1 "
                           . "LEFT JOIN transport_route_db as TB2 ON TB1.route=TB2.route_id "
                           . "LEFT JOIN transport_sub_route_db as TB3 ON TB1.sub_route=TB3.sub_route_unique_id "
                           . "LEFT JOIN transport_vehicle_type_db as TB4 ON TB1.vehicle_type=TB4.vehicle_type_id "
                           . "LEFT JOIN transport_vehicle_db as TB5 ON TB1.vehicle=TB5.vehicle_id WHERE TB1.transport_unique_id='$transport_id'");    
                       
                    $transport_data=mysql_fetch_array($student_allot_transport_db);
                    $transport_num_rows=mysql_num_rows($student_allot_transport_db);
                    if((!empty($transport_data))&&($transport_data!=null)&&($transport_num_rows!=0))   
                    {
                        
                     $fetch_route_name=$transport_data['route_name'];
                     $fetch_vehicle_type_name=$transport_data['vehicle_type'];  
                     $vehicle_name=$transport_data['vehicle_registration_no'];  
                     $sub_route=$transport_data['sub_route'];
                     $joining_date=$transport_data['start_service_date'];
                     $description=$transport_data['description'];
                        
                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b> Transport Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Route Name</b></td><td><b>:</b></td><td> $fetch_route_name</td>
                    <td><b>Sub Route</b></td><td><b>:</b></td><td> $sub_route</td>
                    <td><b>Joining Date</b></td><td><b>:</b></td><td> $joining_date</td>
                        </tr>
                        <tr>
                    <td><b>Vehicle Type</b></td><td><b>:</b></td><td> $fetch_vehicle_type_name</td>
                    <td><b>Vehicle Registration No.</b></td><td><b>:</b></td><td> $vehicle_name</td>
                    <td><b>Description</b></td><td><b>:</b></td><td> $description</td>
                   
                    </tr>";
                    }
                   }

                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                 
                    
                     
                    
                </table>
                   
                    ";
           
                
                    
                    
        } 
    
    
    
}
?>

<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>