<?php
//SESSION CONFIGURATION
$check_array_in="hr";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>    
<?php

require_once '../connection.php';
if((!empty($_REQUEST['employee_admission_id'])))
{
 $employee_admission_id=$_REQUEST['employee_admission_id'];
 
 
            
         
            $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id "
                      . "LEFT JOIN hr_bank_db as T6 ON T1.bank_id=T6.bank_unique_id "
                      . "LEFT JOIN hr_hostel_transport_db as T7 ON T1.hostel_transport_id=T7.hostel_transport_unique_id "
                      . "LEFT JOIN category_db as T8 ON T1.category_id=T8.category_id WHERE $db_t1_main_details"
                    . " T1.employee_id='$employee_admission_id' and T1.is_delete='none'");
          
         
         $fetch_employee_data=mysql_fetch_array($employee_db);
         $fetch_employee_num_rows=mysql_num_rows($employee_db);
         if((!empty($fetch_employee_data))&&($fetch_employee_data!=null)&&($fetch_employee_num_rows!=0))
         {
  
         $employee_db_id=$fetch_employee_data['db_id'];
         $employee_encrypt_id=$fetch_employee_data['encrypt_id'];       
         $employee_unique_id=$fetch_employee_data['employee_id'];    
$admission_no=$fetch_employee_data['employee_no'];      
$employee_admission_date=$fetch_employee_data['joining_date'];  
$department=$fetch_employee_data['department_name'];
$designation=$fetch_employee_data['designation_name'];
$teching_prefession=$fetch_employee_data['profession_teaching'];        
$category_name=$fetch_employee_data['category_name'];

 
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
    if(empty($employee_photo))
    {
    $employee_photo="images/no_avilable_image.gif";    
    }  else {
      $employee_photo=$employee_photo;    
       
    }
    
    
    
    $studnet_handicapped=$fetch_employee_data['handicapped'];
    
    if(($studnet_handicapped=="on"))
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
    
    $employee_father_name=$fetch_employee_data['father_name'];
    $employee_father_mobile_no=$fetch_employee_data['father_mobile_no'];
    $employee_father_email_id=$fetch_employee_data['father_email'];
    $employee_father_qualification=$fetch_employee_data['father_qualification'];
    $employee_father_occupation=$fetch_employee_data['father_occupation'];
    $employee_father_annual_income=$fetch_employee_data['father_annual_income'];
    $employee_father_photo=$fetch_employee_data['father_photo'];
    
    if(empty($employee_father_photo))
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
    
    
    if(empty($employee_mother_photo))
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
    
    if(empty($employee_spouse_photo))
    {
    $employee_spouse_photo="images/no_avilable_image.gif";    
    }  else {
      $employee_spouse_photo=$employee_spouse_photo;    
       
    }
   
     $no_of_children=$fetch_employee_data['no_of_children'];   
        echo "    
       <div id='first_top_div_tags'> </div>         
<br/>   
                <table cellspacing='0' cellpadding='0' class='admission_form_tables'>
                   
                    <tr>
                        <td colspan='9'><div class='heading_title' style=' background-color:whitesmoke; padding-bottom:4px;'>Employee Full Detail</div></td>
                    </tr>
                     <tr>
<td colspan='10'>";
        
        {
        ?>
<div id="first_top_div_tags">
    
       <div class="button_style" onclick="back_button()" style="background-color:orange;">Back</div>
       <a href="#" onclick="window.open('employee_details_print.php?token_id=<?php echo $employee_encrypt_id;?>','size',config='height=700,width=1050,position=absolute,left=100,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       <div class="button_style" style=" background-color:#4700B2; ">Print</div></a>
   
       <a href="#" onclick="window.open('addmision_form_print.php?token_id=<?php echo $employee_encrypt_id;?>','size',config='height=700,width=1050,position=absolute,left=100,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       <div class="button_style" style="background-color:#3385FF;">Admission Form Print</div></a>
       
     <div class="button_style" id="employee_account_status" onclick="inactive_account('S15B1AN1','inactive')" style="background-color:#FF5050;">Account Inactive</div>
       
      
       <div class="button_style" onclick="delete_data('S15B1AN1')" style="background-color:red;">Delete</div>
       
       
       <a href="#" onclick="window.open('../admission/employee_edit_profile.php?token_id=<?php echo $employee_encrypt_id;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       <div class="button_style" style="background-color:green;">Edit</div></a>
      
    
    
    
    </div>
        <?php
         }
echo"</td>                     
</tr><tr><td style='heigth:40px;'></td></tr>
                   
                    <tr>
                        <td colspan='9'><span><b>Office Information</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>                    
                    <tr>
                        <td><b>Employee No.</b></td><td><b>:</b></td><td>$admission_no</td>
                        
                        <td><b>Joining Date</b></td><td><b>:</b></td><td>$employee_admission_date</td>
                        
                        <td><b>Enrollment No</b></td><td><b>:</b></td><td></td>
                    </tr>
                    <tr>
                    <td><b>Department</b></td><td><b>:</b></td><td>$department</td>
                    
                    <td><b>Designation</b></td><td><b>:</b></td><td>$designation</td>
                    
                    <td><b>Profession Teaching</b></td><td><b>:</b></td><td>$teching_prefession</td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
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
                    <td><b>Student Name</b></td><td><b>:</b></td><td>$employee_full_name</td>
                    
                    <td><b>Gender</b></td><td><b>:</b></td><td>$employee_gender</td>
                    <td></td><td></td>
                    <td rowspan='9' style=' width:160px; '><img class='student_image' src='../$employee_photo'></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Date Of Birth</b></td><td><b>:</b></td><td>$employee_dob</td>
                    
                    <td><b>Blood Group</b></td><td><b>:</b></td><td> $employee_blood_group</td>
                    <td></td><td></td>
                     </tr>
                     
                      <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Birth Place</b></td><td><b>:</b></td><td> $employee_birth_place</td>
                    
                    <td><b>Nationality</b></td><td><b>:</b></td><td> $employee_nationality</td>
                    <td></td><td></td>
                     </tr>
                     
                      <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Religion</b></td><td><b>:</b></td><td> $employee_religion</td>
                    
                    <td><b>Mother Tongue</b></td><td><b>:</b></td><td> $employee_mother_tongue</td>
                    <td></td><td></td>
                     </tr>
                     
                     <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Category</b></td><td><b>:</b></td><td> $category_name</td>
                    
                    <td><b>Sub Category</b></td><td><b>:</b></td><td> $employee_sub_category</td>
                    <td></td><td></td>
                     </tr>
                      <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                     <tr>
                    <td><b>Employee Mobile No</b></td><td><b>:</b></td><td> $employee_mobile</td>
                    
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $employee_email</td>
                    
                    <td><b>Handicapped</b></td><td><b>:</b></td><td> $studnet_handicapped</td>
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
                    <td><b>Current Address</b></td><td><b>:</b></td><td colspan='4'> $employee_current_address</td>
                        <td><b>Nearest Area</b></td><td><b>:</b></td><td> $employee_current_nearest_area</td>
                    
                    </tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    
                    <td><b>City</b></td><td><b>:</b></td><td> $employee_current_city</td>
                    
                    <td><b>District</b></td><td><b>:</b></td><td> $employee_current_desctric</td>
 <td><b>Post</b></td><td><b>:</b></td><td> $employee_current_post</td>
                                            

                    </tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Pin code</b></td><td><b>:</b></td><td> $employee_current_pincode</td>
                    
                    <td><b>State</b></td><td><b>:</b></td><td> $employee_current_state</td>
                    
                    <td><b>Country</b></td><td><b>:</b></td><td> $employee_current_country</td>
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
                    <td><b>Permanent Address</b></td><td><b>:</b></td><td colspan='4'> $employee_permanent_address</td>
<td><b>Nearest Area</b></td><td><b>:</b></td><td> $employee_permanent_nearest_area</td>
                                         
</tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    
                    <td><b>City</b></td><td><b>:</b></td><td> $employee_permanent_city</td>
                    
                    <td><b>District</b></td><td><b>:</b></td><td> $employee_permanent_desctric</td>
                    <td><b>Post</b></td><td><b>:</b></td><td> $employee_permanent_post</td>
                    
                    </tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Pin code</b></td><td><b>:</b></td><td> $employee_permanent_pincode</td>
                    
                    <td><b>State</b></td><td><b>:</b></td><td> $employee_permanent_state</td>
                    
                    <td><b>Country</b></td><td><b>:</b></td><td> $employee_permanent_country</td>
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
                    <td><b>Father Name</b></td><td><b>:</b></td><td> $employee_father_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $employee_father_mobile_no</td>
                    <td></td><td></td>
                    <td rowspan='8' style=' width:160px; '><img class='student_image' src='../$employee_father_photo'></td>
                    </tr>
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td>  $employee_father_email_id</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $employee_father_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $employee_father_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $employee_father_annual_income</td>
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
                    <td><b>Mother Name</b></td><td><b>:</b></td><td> $employee_mother_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $employee_mother_mobile_no</td>
                    <td></td><td></td>
                    <td rowspan='8' style=' width:160px; '><img class='student_image' src='../$employee_mother_photo'></td>
                    </tr>
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $employee_mother_email_id</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $employee_mother_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $employee_mother_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $employee_mother_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>";
                    
                    
                    
                    
                   if((!empty($employee_spouse_name))&&($employee_marital_status=="married")) 
                   {
                    
                   echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Spouse Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
 
                    <tr>
                    <td><b></b></td><td><b></b></td><td></td>
                    
                    <td><b></b></td><td></td><td></td>
                    <td></td><td></td>
                    <td rowspan='9' style=' width:160px; '><img class='student_image' src='../$employee_spouse_photo'></td>
                    </tr>
                    
                    <tr>
                    <td><b>Spouse Name</b></td><td><b>:</b></td><td> $employee_spouse_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $employee_spouse_mobile_no</td>
                    <td></td><td></td>
                    
                    
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $employee_spouse_email</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $employee_spouse_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $employee_spouse_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $employee_spouse_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>";
                    
                    echo "<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Children Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Number Of Children</b></td><td><b>:</b></td><td>$no_of_children</td>
                    </tr>";
                   
                   }
                    
                   
                  
                   
                   
                   
                   
                   
                   $qualification_db=mysql_query("SELECT * FROM hr_qualification_db WHERE $db_main_details employee_id='$employee_unique_id' and is_delete='none'");
                          
                   $qualification_num_rows=mysql_num_rows($qualification_db); 
                   
                   if(!empty($qualification_num_rows))
                   {
                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Qualification Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
<td colspan='9'>

<table cellspacing='0' class='emp_style_table'>
<tr class='th_style_emp'>
<td>Course</td>
<td>Year</td>
<td>% Of Mark</td>
<td>Board/University</td>
<td>School/College</td>
<td style='border-right:1px solid black;'>Document</td>
</tr>";

                while ($qualification_data=mysql_fetch_array($qualification_db))
                    {
                   $course=$qualification_data['course'];
                   $year=$qualification_data['year'];
                   $per_of_mark=$qualification_data['per_of_mark'];
                   $board=$qualification_data['board'];
                   $school=$qualification_data['school'];
                   $document=$qualification_data['document_file'];        
                if(!empty($course))
                {
              echo "<tr class='emp_style_td'>"
                   . "<td>$course</td>"
                   . "<td>$year</td>"
                   . "<td>$per_of_mark%</td>"
                   . "<td>$board</td>"
                   . "<td>$school</td>"
                   . "<td style='border-right:1px solid black;'><a href='$document'>View Document</a></td>"
                   ."</tr>";
                   
                }    
                    }

echo "</table>


</td>                    
</tr>";
                    
                   }
                   
                 
                   $experiense=$fetch_employee_data['experience'];
                   $experiense_description=$fetch_employee_data['experience_detail'];        
                   if(!empty($experiense))
                   {
                   echo "<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Experience Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                   <tr>
                    <td><b>Total Experience</b></td><td><b>:</b></td><td>$experiense</td>
                    
                    <td><b>Experience Description</b></td><td><b>:</b></td><td colspan='6'>$experiense_description</td>
                    <td></td><td></td>
                    </tr>";
                   
                   }
                   
                   
 $achievemnt_db=mysql_query("SELECT * FROM hr_achievement_db WHERE $db_main_details employee_id='$employee_unique_id' and is_delete='none'");
 $achivement_num_rows=mysql_num_rows($achievemnt_db);
  if((!empty($achivement_num_rows))||($achivement_num_rows!=0))
 {
  
      echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Qualification Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
<td colspan='9'>

<table cellspacing='0' class='emp_style_table'>
<tr class='th_style_emp'>
<td>Achievement Title</td>
<td>Description</td>
<td>Document Name</td>
<td style='border-right:1px solid black;'>View Document</td>
</tr>";

      while ($achivement_data=mysql_fetch_array($achievemnt_db))
      {
          $achivemnt_title=$achivement_data['achievement_title'];
          $description=$achivement_data['description'];
          $document_name=$achivement_data['document_name'];
          $document_file=$achivement_data['document_file'];   
          if(!empty($achivemnt_title))
          {
          echo "<tr class='emp_style_td'>"
          . "<td>$achivemnt_title</td>"
                  . "<td>$description</td>"
                  . "<td>$document_name</td>"
                  . "<td style='border-right:1px solid black;'><a href='$document_file'>View Document</a></td></tr>";  
          
          }  
      }
      
      echo "</table>";    
     
 }
       
 echo "</td>                    
</tr>";
 
 $document_db=mysql_query("SELECT * FROM hr_document_db WHERE employee_id='$employee_unique_id' and is_delete='none'");
  $document_num_rows=mysql_num_rows($document_db);
  if((!empty($document_num_rows))||($document_num_rows!=0))
 {
  
 
      echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Submit Document Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
<td colspan='9'>

<table cellspacing='0' class='emp_style_table'>
<tr class='th_style_emp'>
<td>Document Name</td>
<td style='border-right:1px solid black;'>View Document</td>
</tr>                    
";
      while ($document_data=mysql_fetch_array($document_db))  
      {  
          $e_document_name=$document_data['document_name'];
          $e_document_file=$document_data['document_file'];
        if(!empty($e_document_name))
        {
      echo "<tr class='emp_style_td'>"
      . "<td>$e_document_name</td>"
      . "<td style='border-right:1px solid black;'><a href='$e_document_file'>View Document</a></td></tr>";
      }
      }
      echo "</table>";                  
 }              
 echo "</td>                    
</tr>";        

 
         $bank_name=$fetch_employee_data['bank_name'];
         $branch=$fetch_employee_data['branch'];
         $phone=$fetch_employee_data['phone'];
         $bank_address=$fetch_employee_data['bank_address'];
         $ifsc_code=$fetch_employee_data['ifsc_code'];
         $account_no=$fetch_employee_data['account_no'];
         $dd_payable_address=$fetch_employee_data['dd_payable_address'];
 if((!empty($bank_name))&&(!empty($account_no))&&(!empty($ifsc_code)))
 {
                   echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Bank Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Bank</b></td><td><b>:</b></td><td> $bank_name</td>
                    
                    <td><b>Branch</b></td><td><b>:</b></td><td>$branch</td>
                    
                    <td><b>Phone</b></td><td><b>:</b></td><td> $phone</td>
                    </tr>
                    
                     <tr>
                    <td><b>Bank Address</b></td><td><b>:</b></td><td colspan='6'> $bank_address</td>
                    </tr>
                    
                     <tr>
                    <td><b>IFSC Code</b></td><td><b>:</b></td><td> $ifsc_code</td>
                    <td><b>Account No.</b></td><td><b>:</b></td><td colspan='3'> $account_no</td>
                     </tr>
                     
                     <tr>
                    <td><b>DD Payable Address</b></td><td><b>:</b></td><td colspan='6'>$dd_payable_address</td>
                     </tr>
                       ";
 }
 
 $hobbies=$fetch_employee_data['hobbies'];
 if(!empty($hobbies))
 {
                   echo "<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Other Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                   <tr>
                    <td><b>Hobbies</b></td><td><b>:</b></td><td colspan='6'>$hobbies</td>
                    </tr>";
 }
                   
                   
  $language_db=mysql_query("SELECT * FROM hr_language_db WHERE employee_unique_id='$employee_unique_id' and is_delete='none'");
  $language_num_rows=mysql_num_rows($language_db);
  if((!empty($language_num_rows))||($language_num_rows!=0))
 {
                   
                      echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Language Detail</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
<tr>
<td colspan='9'>

<table cellspacing='0' class='emp_style_table'>
<tr class='th_style_emp'>
<td>Language</td>
<td>Read</td>
<td>Write</td>
<td style='border-right:1px solid black;'>Spoke</td>
</tr>";
 
      while ($language_data=mysql_fetch_array($language_db))  
      {  
          $language_name=$language_data['language'];
          $read=strtoupper($language_data['read']);
          $write=strtoupper($language_data['write']);
          $spoke=strtoupper($language_data['spoke']);
        if(!empty($language_name))
        {
      echo "<tr class='emp_style_td'>"
      . "<td>$language_name</td>"
      . "<td><center>$read</center></td>"
      . "<td><center>$write</center></td>"
      . "<td style='border-right:1px solid black;'><center>$spoke</center></td></tr>";
      }
      }                  
                      echo "</table>";                   
 }           
                  
 
 
 $hostel=$fetch_employee_data['hostel'];
 $hostel_join_date=$fetch_employee_data['hostel_joining_date'];
 $hostel_description=$fetch_employee_data['hostel_description'];
 $transport=$fetch_employee_data['transport'];
 $trnasport_joing_date=$fetch_employee_data['transport_joining_date'];
 $transport_description=$fetch_employee_data['transport_description'];
                   
                  if((!empty($hostel)) || (!empty($transport)))
                  {
                      echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Hostel & Transport Allotment</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>";   
                   
 if(!empty($hostel))
 {
                    echo "<tr>
                    <td><b>Hostel</b></td><td><b>:</b></td><td> $hostel</td>
                    
                    <td><b>Joining Date</b></td><td><b>:</b></td><td> $hostel_join_date</td>
                    
                    <td><b>Description</b></td><td><b>:</b></td><td> $hostel_description</td>
                    </tr>";
 }
                      
                    if(!empty($transport))
                    {
                   echo "<tr>
                    <td><b>Transport</b></td><td><b>:</b></td><td> $transport</td>
                    
                    <td><b>Joining Date</b></td><td><b>:</b></td><td> $trnasport_joing_date</td>
                    
                    <td><b>Description</b></td><td><b>:</b></td><td> $transport_description</td>
                    </tr>";
                    }
                  }
                      
                    echo"</td></tr><tr>
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