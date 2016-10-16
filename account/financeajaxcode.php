<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 
require_once '../connection.php';

if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))
        &&(!empty($_REQUEST['fee_id']))&&(!empty($_REQUEST['fee_type'])))
{
 $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $sesson_id=$_REQUEST['session_id'];
 $fees_id=$_REQUEST['fee_id'];
 $fee_type=$_REQUEST['fee_type'];
 echo "<option value='0'>-- Select fee group --</option>";
 $select_fee_group_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$organization_id'
     and branch_id='$branch_id' and session_id='$sesson_id' and fee_id='$fees_id' and feegrouptype='$fee_type' and action='active'");
 while ($fetch_fee_group_data=mysql_fetch_array($select_fee_group_db))
 {
   $fetch_fee_group_id=$fetch_fee_group_data['fee_group_id'];
   $fetch_fee_group_name=$fetch_fee_group_data['feegroupname'];
   
   echo "<option value='$fetch_fee_group_id'>$fetch_fee_group_name</option>
   <input type='text' value='$fetch_fee_group_name'>
   ";
 }
 if(empty($fetch_fee_group_id))
 {
    echo "<option value='0'>Record No Found !!</option>"; 
 }
 }



 //discount category fee wise
 
 if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))
        &&(!empty($_REQUEST['discount_fee_id'])))
{
 $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $sesson_id=$_REQUEST['session_id'];
 $fees_id=$_REQUEST['discount_fee_id'];
 echo "<option value='0'>-- Select fee group --</option>";
 $select_fee_group_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$organization_id'
     and branch_id='$branch_id' and session_id='$sesson_id' and fee_id='$fees_id' and action='active'");
 while ($fetch_fee_group_data=mysql_fetch_array($select_fee_group_db))
 {
   $fetch_fee_group_id=$fetch_fee_group_data['fee_group_id'];
   $fetch_fee_group_name=$fetch_fee_group_data['feegroupname'];
   
   echo "<option value='$fetch_fee_group_id'>$fetch_fee_group_name</option>
   <input type='text' value='$fetch_fee_group_name'>
   ";
 }
 if(empty($fetch_fee_group_id))
 {
    echo "<option value='0'>Record No Found !!</option>"; 
 }
 }




//particular student search class            
    if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))
            &&(!empty($_REQUEST['account_type'])))
    {
    
       $organization_id=$_REQUEST['org_id'];
        $branch_id=$_REQUEST['branch_id'];
        $sesson_id=$_REQUEST['session_id'];
        $account_type=$_REQUEST['account_type'];
        echo "<option value='0'>--Select--</option>";
    $account_head_db=  mysql_query("SELECT * FROM financeaccountheadhdetail WHERE organization_id='$organization_id'
       and branch_id='$branch_id' and session_id='$sesson_id' and accountheadgrouptype='$account_type' and action='active'");
    while ($fetch_account_head=mysql_fetch_array($account_head_db))
    {
       $fetch_account_head_id=$fetch_account_head['account_head_id'];
        $fetch_account_head_name=$fetch_account_head['accountheadgroupname'];
        
        echo "<option value='$fetch_account_head_id'>$fetch_account_head_name</option>";  
        
    }
    if(empty($fetch_account_head_id))
    {
      echo "<option value='0'>Record no found !!</option>";  
    }
    }
                              
         
    
    
    // particular student fetch section details
   if((!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))
           &&(!empty($_REQUEST['session_id'])))
   {
    
       $org_id=$_REQUEST['org_id'];
       $branch_id=$_REQUEST['branch_id'];
       $session_id=$_REQUEST['session_id'];
       
       
       echo "<div id='section_record'><option value='0'>-- Select Section --</option>";   
   $class_id=$_REQUEST['class_id'];   
   $section_db=mysql_query("SELECT * FROM section_db WHERE course_id='$class_id'");
   while ($fetch_section_data=mysql_fetch_array($section_db))
   {
   
       $fetch_section_id=$fetch_section_data['section_id'];
       $fetch_section_name=$fetch_section_data['section_name'];
       
       echo "<option value='$fetch_section_id'>$fetch_section_name</option><div>asfas</div>"; 
       
   }
   
   if(empty($fetch_section_id))
   {
       echo "<option value='0'>Record no found !!</option>"; 
   }
   
   
  echo "</div><div id='student_search_data'>";
    $studnet_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " $db_t1_main_details T1.course_id='$class_id' and T1.is_delete='none' ORDER BY T7.student_full_name ASC ");
   while ($fetch_student_details=mysql_fetch_array($studnet_db))
   {
   $fetch_student_name=$fetch_student_details['student_full_name'];
   $fetch_student_father_name=$fetch_student_details['father_name'];
   $fetch_student_id=$fetch_student_details['student_id'];
   $admission_no=$fetch_student_details['admission_no'];
   $fetch_class_id=$fetch_student_details['course_id'];
   $fetch_section_id=$fetch_student_details['section_id'];
   $fetch_session_id=$fetch_student_details['session_id'];
   $fetch_category_id=$fetch_student_details['category_id'];
   $fetch_roll_no=$fetch_student_details['roll_no'];
   $fetch_student_gender= ucfirst($fetch_student_details['student_gender']);
   $fetch_studnet_dob= $fetch_student_details['student_dob'];
   $fetch_student_mobile_no=$fetch_student_details['student_mobile_no'];
   $fetch_father_mobile_no=$fetch_student_details['father_mobile_no'];
   $fetch_mother_name=$fetch_student_details['mother_name'];
   $fetch_mother_mobile_no=$fetch_student_details['mother_mobile_no'];
   $fetch_parents_name=$fetch_student_details['local_parent_name'];
   $fetch_parents_mobile_no=$fetch_student_details['local_parent_mobile_no'];
   $fetch_student_photo=$fetch_student_details['student_photo'];
   $fetch_id=$fetch_student_details['sr_no'];
   $category_name=$fetch_student_details['category_name'];
   $course_name=$fetch_student_details['course_name'];
   $fetch_class_id=$fetch_class_id;  
   $section_name=$fetch_student_details['section_name'];
   $session_name=$fetch_student_details['session_name'];
   
    if($fetch_student_gender=="Male")
   {
    $relation="S/O";   
   }else
   {
  $relation="D/O";  
   }
    {  
    ?> 
<li onclick="student_record('<?php  echo $fetch_student_id;?>')">
    
 <?php 
   }
    echo "<p class='student_name_search'>$fetch_student_name $relation $fetch_student_father_name</p>
   <div style='display:none;' id='student_name_$fetch_student_id'>
   <input type='hidden' id='student_names_$fetch_student_id' value='$fetch_student_name'>
   <input type='hidden' name='insert_student_id' id='match_student_id_$fetch_student_id' value='$fetch_student_id'>
   <table class='student_table'>
            <tr>
                <td><b>Class</b></td>
                <td><b>:</b></td>
                <td><input type='hidden' id='student_insert_class' name='studnet_insert_post_class' value='$fetch_class_id'>$course_name</td>
                <td><b>Section</b></td>
                <td><b>:</b></td>
                <td>$section_name</td>
                <td><b>Session</b></td>
                <td><b>:</b></td>
                <td>$session_name</td>
                <td rowspan='6'><img class='student_images' src='../$fetch_student_photo'></td>
            </tr>
            <tr>
                <td><b>Addmis. No.</b></td>
                <td><b>:</b></td>
                <td>$admission_no</td>
                <td><b>Form No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_id</td>
                <td><b>Roll No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_roll_no</td>
            </tr>
            <tr>
                <td><b>Student Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_student_name</td>
                <td><b>Gender</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_gender</td>
                
            </tr>
             <tr>
                <td><b>Date Of Birth</b></td>
                <td><b>:</b></td>
                <td>$fetch_studnet_dob</td>
                <td><b>Category</b></td>
                <td><b>:</b></td>
                <td>$category_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_mobile_no</td>
                
            </tr>
             <tr>
                <td><b>Father Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_student_father_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_father_mobile_no</td>
                
            </tr>
             <tr>
                <td><b>Mother Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_mother_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_mother_mobile_no</td>
                
            </tr>
            <tr>
                <td><b>Local Parents</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_parents_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_parents_mobile_no</td>
                
            </tr>
        </table>
   
   </div>
   
<div id='fee_group_data_$fetch_student_id' style='display:none;'>";   
   
    echo '
   <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Fee Group</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" height:20px; ">     
<div style=" width:auto; height:auto; ">
<div class="select_all"><table><tr><td>
                <input id="select_all_fee" onClick="check_all()"  type="checkbox"></td><td>Select All</td></tr>
                    </table></div>';
                                                  
$fee_amount_db=  mysql_query("SELECT * FROM financefeeamount WHERE organization_id='$org_id' and branch_id='$branch_id' and 
session_id='$session_id' and fee_assign_to='class_fee_group' and course_id='$fetch_class_id' and action='active'"); 
while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_db))
{
$fetch_fee_id=$fetch_fee_amount_data['fee_id'];
$fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];

$fee_group_data=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$org_id' and branch_id='$branch_id' and 
session_id='$session_id' and fee_group_id='$fetch_fee_group_id'");
$fetch_fee_group_data=  mysql_fetch_array($fee_group_data);
$fetch_fee_group_num_rows=  mysql_num_rows($fee_group_data);

if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fetch_fee_group_num_rows!=0))
{
$fetch_fee_group_name=$fetch_fee_group_data['feegroupname']; 
$fetch_fee_group_id=$fetch_fee_group_data['fee_group_id']; 
echo "<div class='feegroup_list'><table><tr><td><input class='checkbox1' name='all_fee_group_id[]' value='$fetch_fee_group_id' type='checkbox'></td><td>$fetch_fee_group_name</td></tr></table></div>";
    
    
}

}
                                                  
                                               
                                                  
    
    
    echo "</div></td></tr></table></fieldset></div></li>";    
   }
   echo "</div>";
   
   }
   
   
                         
    // particular student fetch section details
   if((!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))
           &&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['section_id'])))
   {
    
       $org_id=$_REQUEST['org_id'];
       $branch_id=$_REQUEST['branch_id'];
       $session_id=$_REQUEST['session_id'];
        $class_id=$_REQUEST['class_id']; 
        $section_id=$_REQUEST['section_id']; 
  
    echo "<div id='student_search_data'>";
   
    $studnet_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " $db_t1_main_details T1.course_id='$class_id' and T1.section_id='$section_id' and T1.is_delete='none'");
   while ($fetch_student_details=mysql_fetch_array($student_db))
   {
  $fetch_student_name=$fetch_student_details['student_full_name'];
   $fetch_student_father_name=$fetch_student_details['father_name'];
   $fetch_student_id=$fetch_student_details['student_id'];
   $admission_no=$fetch_student_details['admission_no'];
   $fetch_class_id=$fetch_student_details['course_id'];
   $fetch_section_id=$fetch_student_details['section_id'];
   $fetch_session_id=$fetch_student_details['session_id'];
   $fetch_category_id=$fetch_student_details['category_id'];
   $fetch_roll_no=$fetch_student_details['roll_no'];
   $fetch_student_gender= ucfirst($fetch_student_details['student_gender']);
   $fetch_studnet_dob= $fetch_student_details['student_dob'];
   $fetch_student_mobile_no=$fetch_student_details['student_mobile_no'];
   $fetch_father_mobile_no=$fetch_student_details['father_mobile_no'];
   $fetch_mother_name=$fetch_student_details['mother_name'];
   $fetch_mother_mobile_no=$fetch_student_details['mother_mobile_no'];
   $fetch_parents_name=$fetch_student_details['local_parent_name'];
   $fetch_parents_mobile_no=$fetch_student_details['local_parent_mobile_no'];
   $fetch_student_photo=$fetch_student_details['student_photo'];
   $fetch_id=$fetch_student_details['sr_no'];
   $category_name=$fetch_student_details['category_name'];
   $course_name=$fetch_student_details['course_name'];
   $fetch_class_id=$fetch_class_id;  
   $section_name=$fetch_student_details['section_name'];
   $session_name=$fetch_student_details['session_name'];
   
    if($fetch_student_gender=="Male")
   {
    $relation="S/O";   
   }else
   {
  $relation="D/O";  
   }
    {  
    ?> 
<li onclick="student_record('<?php  echo $fetch_student_id;?>')">
    
 <?php 
   }
    echo "<p class='student_name_search'>$fetch_student_name $relation $fetch_student_father_name</p>
   <div style='display:none;' id='student_name_$fetch_student_id'>
   <input type='hidden' id='student_names_$fetch_student_id' value='$fetch_student_name'>
   <input type='hidden' name='insert_student_id' id='match_student_id_$fetch_student_id' value='$fetch_student_id'>
   <table class='student_table'>
            <tr>
                <td><b>Class</b></td>
                <td><b>:</b></td>
                <td><input type='hidden' id='student_insert_class' name='studnet_insert_post_class' value='$fetch_class_id'>$course_name</td>
                <td><b>Section</b></td>
                <td><b>:</b></td>
                <td>$section_name</td>
                <td><b>Session</b></td>
                <td><b>:</b></td>
                <td>$session_name</td>
                <td rowspan='6'><img class='student_images' src='../$fetch_student_photo'></td>
            </tr>
            <tr>
                <td><b>Addmis. No.</b></td>
                <td><b>:</b></td>
                <td>$admission_no</td>
                <td><b>Form No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_id</td>
                <td><b>Roll No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_roll_no</td>
            </tr>
            <tr>
                <td><b>Student Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_student_name</td>
                <td><b>Gender</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_gender</td>
                
            </tr>
             <tr>
                <td><b>Date Of Birth</b></td>
                <td><b>:</b></td>
                <td>$fetch_studnet_dob</td>
                <td><b>Category</b></td>
                <td><b>:</b></td>
                <td>$category_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_mobile_no</td>
                
            </tr>
             <tr>
                <td><b>Father Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_student_father_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_father_mobile_no</td>
                
            </tr>
             <tr>
                <td><b>Mother Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_mother_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_mother_mobile_no</td>
                
            </tr>
            <tr>
                <td><b>Local Parents</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_parents_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_parents_mobile_no</td>
                
            </tr>
        </table>
  
   
   </div><div id='fee_group_data_$fetch_student_id' style='display:none;'>
   ";   
   
    echo '
   <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Fee Group</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" height:20px; ">     
<div style=" width:auto; height:auto; ">
<div class="select_all"><table><tr><td>
                <input id="select_all_fee" onClick="check_all()"  type="checkbox"></td><td>Select All</td></tr>
                    </table></div>';
                                                  
$fee_amount_db=  mysql_query("SELECT * FROM financefeeamount WHERE organization_id='$org_id' and branch_id='$branch_id' and 
session_id='$session_id' and fee_assign_to='class_fee_group' and course_id='$fetch_class_id' and action='active'"); 
while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_db))
{
$fetch_fee_id=$fetch_fee_amount_data['fee_id'];
$fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];

$fee_group_data=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$org_id' and branch_id='$branch_id' and 
session_id='$session_id' and fee_group_id='$fetch_fee_group_id'");
$fetch_fee_group_data=  mysql_fetch_array($fee_group_data);
$fetch_fee_group_num_rows=  mysql_num_rows($fee_group_data);

if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fetch_fee_group_num_rows!=0))
{
$fetch_fee_group_name=$fetch_fee_group_data['feegroupname']; 
$fetch_fee_group_id=$fetch_fee_group_data['fee_group_id']; 
echo "<div class='feegroup_list'><table><tr><td><input name='all_fee_group_id[]' value='$fetch_fee_group_id' type='checkbox'></td><td>$fetch_fee_group_name</td></tr></table></div>";
    
    
}

}
                                                  
                                               
                                                  
    
    
    echo "</div></td></tr></table></fieldset></div>";      
       
   }
   echo "</div>";
   
   }
   
   
   //particular advance search student
   
   if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))
           &&(!empty($_REQUEST['session_id']))&&(!empty($_REQUEST['search_by']))
           &&(!empty($_REQUEST['search_q'])))
   {
      
       
      $organization_id=$_REQUEST['org_id'];
       $branch_id=$_REQUEST['branch_id'];
       $session_id=$_REQUEST['session_id'];
       $search_by=$_REQUEST['search_by'];
       $search_this=$_REQUEST['search_q'];
        
    $studnet_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " $db_t1_main_details $search_by LIKE '%$search_this%' and T1.is_delete='none' ORDER BY T7.student_full_name ASC");
   
   while ($fetch_student_details=mysql_fetch_array($studnet_db))
   {
   $fetch_student_name=$fetch_student_details['student_full_name'];
   $fetch_student_father_name=$fetch_student_details['father_name'];
   $fetch_student_id=$fetch_student_details['student_id'];
   $admission_no=$fetch_student_details['admission_no'];
   $fetch_class_id=$fetch_student_details['course_id'];
   $fetch_section_id=$fetch_student_details['section_id'];
   $fetch_session_id=$fetch_student_details['session_id'];
   $fetch_category_id=$fetch_student_details['category_id'];
   $fetch_roll_no=$fetch_student_details['roll_no'];
   $fetch_student_gender= ucfirst($fetch_student_details['student_gender']);
   $fetch_studnet_dob= $fetch_student_details['student_dob'];
   $fetch_student_mobile_no=$fetch_student_details['student_mobile_no'];
   $fetch_father_mobile_no=$fetch_student_details['father_mobile_no'];
   $fetch_mother_name=$fetch_student_details['mother_name'];
   $fetch_mother_mobile_no=$fetch_student_details['mother_mobile_no'];
   $fetch_parents_name=$fetch_student_details['local_parent_name'];
   $fetch_parents_mobile_no=$fetch_student_details['local_parent_mobile_no'];
   $fetch_student_photo=$fetch_student_details['student_photo'];
   $fetch_id=$fetch_student_details['sr_no'];
   $category_name=$fetch_student_details['category_name'];
   $course_name=$fetch_student_details['course_name'];
   $fetch_class_id=$fetch_class_id;  
   $section_name=$fetch_student_details['section_name'];
   $session_name=$fetch_student_details['session_name'];
   if($fetch_student_gender=="Male")
   {
    $relation="S/O";   
   }else
   {
  $relation="D/O";  
   }
   
    {  
    ?> 
<li onclick="student_record('<?php  echo $fetch_student_id;?>')">
    
 <?php 
   }
    echo "<p class='student_name_search'>$fetch_student_name $relation $fetch_student_father_name</p>
   <div style='display:none;' id='student_name_$fetch_student_id'>
   <input type='hidden' id='student_names_$fetch_student_id' value='$fetch_student_name'>
   <input type='hidden' name='insert_student_id' id='match_student_id_$fetch_student_id' value='$fetch_student_id'>
   <table class='student_table'>
            <tr>
                <td><b>Class</b></td>
                <td><b>:</b></td>
                <td><input type='hidden' id='student_insert_class' name='studnet_insert_post_class' value='$fetch_class_id'>$course_name</td>
                <td><b>Section</b></td>
                <td><b>:</b></td>
                <td>$section_name</td>
                <td><b>Session</b></td>
                <td><b>:</b></td>
                <td>$session_name</td>
                <td rowspan='6'><img class='student_images' src='../$fetch_student_photo'></td>
            </tr>
            <tr>
                <td><b>Addmis. No.</b></td>
                <td><b>:</b></td>
                <td>$admission_no</td>
                <td><b>Form No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_id</td>
                <td><b>Roll No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_roll_no</td>
            </tr>
            <tr>
                <td><b>Student Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_student_name</td>
                <td><b>Gender</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_gender</td>
                
            </tr>
             <tr>
                <td><b>Date Of Birth</b></td>
                <td><b>:</b></td>
                <td>$fetch_studnet_dob</td>
                <td><b>Category</b></td>
                <td><b>:</b></td>
                <td>$category_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_student_mobile_no</td>
                
            </tr>
             <tr>
                <td><b>Father Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_student_father_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_father_mobile_no</td>
                
            </tr>
             <tr>
                <td><b>Mother Name</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_mother_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_mother_mobile_no</td>
                
            </tr>
            <tr>
                <td><b>Local Parents</b></td>
                <td><b>:</b></td>
                <td colspan='4'>$fetch_parents_name</td>
                <td><b>Mobile No.</b></td>
                <td><b>:</b></td>
                <td>$fetch_parents_mobile_no</td>
                
            </tr>
        </table>
  
   
   </div><div id='fee_group_data_$fetch_student_id' style='display:none;'>
   ";   
    
    echo '
   <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Fee Group</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" height:20px; ">     
<div style=" width:auto; height:auto; ">
<div class="select_all"><table><tr><td>
                <input id="select_all_fee" onClick="check_all()"  type="checkbox"></td><td>Select All</td></tr>
                    </table></div>';
                                                  
$fee_amount_db=  mysql_query("SELECT * FROM financefeeamount WHERE organization_id='$organization_id' and branch_id='$branch_id' and 
session_id='$session_id' and fee_assign_to='class_fee_group' and course_id='$fetch_class_id' and action='active'"); 
while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_db))
{
$fetch_fee_id=$fetch_fee_amount_data['fee_id'];
$fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];

$fee_group_data=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$organization_id' and branch_id='$branch_id' and 
session_id='$session_id' and fee_group_id='$fetch_fee_group_id'");
$fetch_fee_group_data=  mysql_fetch_array($fee_group_data);
$fetch_fee_group_num_rows=  mysql_num_rows($fee_group_data);

if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fetch_fee_group_num_rows!=0))
{
$fetch_fee_group_name=$fetch_fee_group_data['feegroupname']; 
$fetch_fee_group_id=$fetch_fee_group_data['fee_group_id']; 
echo "<div class='feegroup_list'><table><tr><td><input name='all_fee_group_id[]' value='$fetch_fee_group_id' type='checkbox'></td><td>$fetch_fee_group_name</td></tr></table></div>";
    
    
}

}
                                                  
                                               
                                                  
    
    
    echo "</div></td></tr></table></fieldset></div>";    
   
   }
      
   }
    ?>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>