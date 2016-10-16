<?php
//SESSION CONFIGURATION
$check_array_in="sms_module";
require '../connection.php';
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
       
<?php
 if((!empty($_REQUEST['class']))&&(!empty($_REQUEST['search']))&&($_REQUEST['search']=="student"))
 {
  $class_course_id=$_REQUEST['class'];
  $section_id=$_REQUEST['section'];
  $house_id=$_REQUEST['house'];
   
  
  if((!empty($class_course_id))&&(!empty($section_id))&&(!empty($house_id)))
  {
   $search_query="T1.course_id='$class_course_id' and T1.section_id='$section_id' and T1.house_id='$house_id' and";   
  }else
     if((!empty($class_course_id))&&(!empty($section_id)))
     {
    $search_query="T1.course_id='$class_course_id' and T1.section_id='$section_id' and";    
     }else 
         if((!empty($class_course_id))&&(!empty($house_id)))
         {
     $search_query="T1.course_id='$class_course_id' and T1.house_id='$house_id' and";        
         }else
             if((!empty($class_course_id)))
              {
             $search_query="T1.course_id='$class_course_id' and";     
              }else
              if((!empty($house_id)))
              {
             $search_query="T1.house_id='$house_id' and";     
              }else
              {
               $search_query="T1.course_id='0' and T1.section_id='0' and T1.house_id='0' and";   
              }
             
  
  
  
   
         $student_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id,T1.id as t1_db_id FROM student_db as T1"
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
                 . " $db_t1_main_details $search_query T1.is_delete='none'");
         $row=0;
         $fetch_student_num_rows=mysql_num_rows($student_db);
         
         
         echo " <span style='padding:5px;'><b>Total User : </b> $fetch_student_num_rows <br/> </span><br/><table cellspacing='0' cellpadding='0' style=' width: 100%;'>
                                   <tr class='tr_heading_css'>
                                       <td><input id='selecctall' type='checkbox' checked></td>
                                       <td>Sl.No.</td>
                                        <td>Admission No.</td>
                                        <td>Roll No.</td>
                                       <td>Student</td>
                                       <td>Class-Section</td>
                                       <td>Std. Mobile No.</td>
                                       <td>Father</td>
                                       <td>Mobile No.</td>
                                       <td>Action</td>
                                   </tr>
                                 "; 
         
         
         while ($fetch_student_data=mysql_fetch_array($student_db))
         {
          $row++;
          $user_id=$fetch_student_data['t1_db_id'];
          $admission_no=$fetch_student_data['admission_no'];
          $encrypt_id=$fetch_student_data['t1_encrypt_id'];
          $course_name=$fetch_student_data['course_name']; 
          $section_name=$fetch_student_data['section_name'];
          $student_roll_no=$fetch_student_data['roll_no']; 
          $section_name=$fetch_student_data['section_name'];
           $student_full_name=$fetch_student_data['student_full_name'];
            $student_mobile=$fetch_student_data['student_mobile_no'];
           $student_father_name=$fetch_student_data['father_name'];
    $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
   
    $post_data=$student_father_mobile_no."@$$@".$student_full_name."@$$@".$user_id;
    
             echo "<tr class='td_data_listsed'>"
             . "<td><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></td>"
                     . "<td>$row</td>"
                     . "<td><b>$admission_no</b></td>"
                     . "<td><b>$student_roll_no</b></td>"
                     . "<td>$student_full_name</td>"
                     . "<td>$course_name - $section_name</td>"
                     . "<td>$student_mobile</td>"
                     . "<td>$student_father_name</td>"
                     . "<td>$student_father_mobile_no</td>"
                     . "<td style='width:70px;'>";
             { ?>
<a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>

              <?php 
             }
                     echo"</td></tr>";     
             
             
         }
  if(empty($fetch_student_num_rows))
  {
      echo '  <tr class="record_no_found">
                                       <td colspan="10">Record no found !</td>
                                   </tr>
                                  ';  
  }
  echo "</table>";
 
 }else
     if(!empty ($_REQUEST['all_parent']))
     {
       
      $row=0;
               $parants_match=array();
               $parents_db=mysql_query("SELECT *,T6.encrypt_id as parent_encrypt_id,T1.id as t1_db_id FROM parent_db as T6 "
                       . "LEFT JOIN student_db as T1 ON T6.parent_unique_id=T1.parent_id "
                       . "LEFT JOIN student_personal_db as T7 ON T1.student_id=T7.student_unqiue_id "
                       . "WHERE $db_t1_main_details T1.is_delete='none'");
             $fetch_parent_num_rows=mysql_num_rows($parents_db);
         echo " <span style='padding:5px;'><b>Total User : </b> $fetch_parent_num_rows <br/> </span><br/><table cellspacing='0' cellpadding='0' style=' width: 100%;'>
                                   <tr class='tr_heading_css'>
                                       <td><input id='selecctall' type='checkbox' checked></td>
                                       <td>Sl.No.</td>
                                        <td>Father Name</td>
                                        <td>Mobile No.</td>
                                       <td>Mother Name</td>
                                        <td>Mobile No.</td>
                                       <td>Local Guardian</td>
                                       <td>Mobile No</td>
                                       <td>Action</td>
                                   </tr>
                                 "; 
       while ($parent_data=mysql_fetch_array($parents_db))
               {
               $parent_unique_id=$parent_data['parent_unique_id'];
                     
                if(in_array($parent_unique_id,$parants_match)==false)   
                {  
                 $row++;
                  $user_id=$parent_data['t1_db_id'];
                 $parent_encrypt_id=$parent_data['parent_encrypt_id'];
                 $father_name=$parent_data['father_name'];
                 $father_mobile_no=$parent_data['father_mobile_no'];
                 $mother_name=$parent_data['mother_name'];
                 $mother_mobile_no=$parent_data['mother_mobile_no'];
                 
                 $local_guradain=$parent_data['local_parent_name'];
                         $guradian_mobile_no=$parent_data['local_parent_mobile_no'];
                 array_push($parants_match, $parent_unique_id);
                 
                 
                 $post_data=$father_mobile_no."@$$@".$father_name."@$$@".$user_id;
                 
                  echo "<tr class='td_data_listsed'>"
             . "<td><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></td>"
                     . "<td>$row</td>"
                     . "<td><b>$father_name</b></td>"
                     . "<td><b>$father_mobile_no</b></td>"
                     . "<td>$mother_name</td>"
                     . "<td>$mother_mobile_no</td>"
                     . "<td>$local_guradain</td>"
                     . "<td>$guradian_mobile_no</td>"
                     . "<td style='width:70px;'>";
             { ?>
<a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $parent_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>

              <?php 
             }
                     echo"</td></tr>";     
                 
                 
                }
               }
               
                if(empty($fetch_parent_num_rows))
  {
      echo '  <tr class="record_no_found">
                                       <td colspan="10">Record no found !</td>
                                   </tr>
                                  ';  
  }
         
     }else
         if(!empty($_REQUEST['all_employee_details']))
         {
          
             $department=$_REQUEST['department_id'];
             $designation=$_REQUEST['designation_id'];
             $teaching=$_REQUEST['teching'];   
             $all_employee=$_REQUEST['all_employee'];
             
            if($all_employee=="no")
            {
            if((!empty($department)))
            {
             $search_1="T1.department_id='$department' and";   
            }else
            {
            $search_1="";    
            }
            
            if(!empty($designation))
            {
             $search_2="T1.designation_id='$designation' and";  
            }else
            {
           $search_2="";        
            }
             
            if(!empty($teaching))
            {
             if($teaching=="no_search")
             {
              $search_3="";   
             }else
             {
              $search_3="T1.profession_teaching='$teaching' and";     
             }
            }else
            {
             $search_3="";     
            }
            
            }else{
                
              if(!empty($teaching))
            {
               $search_1="";
               $search_2="";
             if($teaching=="no_search")
             {
              $search_3="";   
             }else
             {
              $search_3="T1.profession_teaching='$teaching' and";     
             }
             
            }else
            {  $search_1="";
               $search_2="";
                
             $search_3="";     
            }   
                
                
            }
            
  
         $row=0;
              $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id,T1.id as t1_db_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id "
                      . "LEFT JOIN hr_bank_db as T6 ON T1.bank_id=T6.bank_unique_id "
                      . "LEFT JOIN category_db as T8 ON T1.category_id=T8.category_id WHERE $search_1 $search_2 $search_3 T1.is_delete='none'");
              $empoyee_num_rows=mysql_num_rows($employee_db);
            
             echo " <span style='padding:5px;'><b>Total User : </b> $empoyee_num_rows <br/> </span><br/><table cellspacing='0' cellpadding='0' style=' width: 100%;'>
                                   <tr class='tr_heading_css'>
                                       <td><input id='selecctall' type='checkbox' checked></td>
                                       <td> Sl.No.</td>
                                       <td>Department</td>
                                       <td>Designation</td>
                                       <td>Employee No.</td>
                                       <td>Employee Name</td>
                                       <td>Gender</td>
                                       <td>Mobile No.</td>
                                       <td>Father Name</td>
                                       <td>Profession Teaching</td>
                                       <td>Action</td>
                                   </tr>
                                 ";     
           while ($employee_data=mysql_fetch_array($employee_db))
              {
                $row++;
                 $user_id=$employee_data['t1_db_id'];
                $employee_unique_id=$employee_data['t1_employee_id'];
                $employee_db_id=$employee_data['db_id'];
                $employee_encrypt_id=$employee_data['t1_encrypt_id'];
                $employee_no=$employee_data['employee_no'];
                $employee_joining_date=$employee_data['joining_date'];
                $employee_name=$employee_data['full_name'];
                $employee_gender=ucwords($employee_data['gender']);
                $employee_mobile_no=$employee_data['mobile'];
                $employee_father_name=ucwords($employee_data['father_name']);
                $employee_teaching_profession=ucfirst($employee_data['profession_teaching']);
                $deapartment=$employee_data['department_name'];
                $designation=$employee_data['designation_name'];
                
                 $post_data=$employee_mobile_no."@$$@".$employee_name."@$$@".$user_id;
                 
                
                   echo "<tr class='td_data_listsed'>"
             . "<td><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></td>"
                     . "<td>$row</td>"
                     . "<td><b>$deapartment</b></td>"
                     . "<td><b>$designation</b></td>"
                     . "<td>$employee_no</td>"
                     . "<td>$employee_name</td>"
                     . "<td>$employee_gender</td>"
                     . "<td>$employee_mobile_no</td>"
                      . "<td>$employee_father_name</td>"
                        . "<td>$employee_teaching_profession</td>"   
                     . "<td style='width:70px;'>";
             { ?>
<a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $employee_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>

              <?php 
             }
                     echo"</td></tr>";     
                     
              }
            if(empty($empoyee_num_rows))
  {
      echo '  <tr class="record_no_found">
                                       <td colspan="11">Record no found !</td>
                                   </tr>
                                  ';  
  }  
         }else
             if(!empty($_REQUEST['all_contact']))
             {
              $group_id=$_REQUEST['group'];   
              
              if(!empty($group_id))
              {
              $search_result="T1.group_id='$group_id' and";    
              }else
              {
               $search_result="";   
              }
             
            $contact_db=mysql_query("SELECT * FROM contact_no_db as T1 "
                            . "LEFT JOIN contact_group_db as T2 ON T1.group_id=T2.id "
                            . "WHERE $db_t1_main_without_session $search_result T1.is_delete='none'");
            $contact_num_rows=mysql_num_rows($contact_db);
               echo " <span style='padding:5px;'><b>Total User : </b> $contact_num_rows <br/> </span><br/><table cellspacing='0' cellpadding='0' style=' width: 100%;'>
                                   <tr class='tr_heading_css'>
                                       <td><input id='selecctall' type='checkbox' checked></td>
                                      
                                       <td>Group</td>
                                       <td>Name</td>
                                       <td>Organization</td>
                                       <td>Phone Number</td>
                                       <td>Mobile No.</td>
                                       <td>Action</td>
                                   </tr>
                                 ";  
                 
                    $row=0;
                    while ($contact_data=mysql_fetch_array($contact_db))
                     {     
                    $row++;    
                    $fetch_contact_id=$contact_data['contact_id'];
                    $encrypt_id=$contact_data['encrypt_id'];
                    $group=$contact_data['group_name'];
                            $name=$contact_data['name'];
                            $organization=$contact_data['organization'];
                            $phone_no=$contact_data['phone_number'];
                            $mobile_no=$contact_data['mobile_number'];
                           
                            $post_data=$mobile_no."@$$@".$name."@$$@".$fetch_contact_id;
                      echo "<tr>"
                              . "<td class='td_style'><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></td>"
                                . "<td class='td_style'><center>$group</center></td>"
                                . "<td class='td_style'>$name</td>"
                                . "<td class='td_style'>$organization</td>"
                                . "<td class='td_style'>$phone_no</td>"
                                . "<td class='td_style'>$mobile_no</td>"
                                . "<td class='td_style' style=' width:130px; border-right:1px solid black;'>"; 
                        {
                            ?>
                       <a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>

                       <?php
                    }
                        echo"</td>";
                            
                        
                     }
             }
    
    
  if((!empty($_REQUEST['message_id'])))
  {
    $message_id=$_REQUEST['message_id'];  
    
                            
                     $sms_template=mysql_query("SELECT * FROM sms_template_db WHERE $db_main_details_whout_session"
                             . " message_type_id='$message_id' and is_delete='none'");           
                  $sms_template_num_rows=mysql_num_rows($sms_template); 
                  while ($sms_template_data=mysql_fetch_array($sms_template))
                  {
                  $template_unqiue_id=$sms_template_data['sms_template_id'];
                  $template_encrypt_id=$sms_template_data['encrypt_id'];
                 $template_name=ucwords($sms_template_data['template_name']);
                 $template=$sms_template_data['sms_template'];       
                 {
                 ?>
                                   <li onclick="template_add('<?php echo $template_unqiue_id;?>')">                  
                 <?php                  
                 }
                 echo "<div style=' font-weight:bold; padding-bottom:3px; width:100%; border-bottom:1px solid black; font-size:14px;'>$template_name </div><br/>"
                         . "<div id='template_value_$template_unqiue_id'>$template</div></li>";
                 
                  }
                  
  }
    
}
?>