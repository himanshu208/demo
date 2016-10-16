<?php
if((!empty($_REQUEST['student_admission_id'])))
{
    
    $student_id=$_REQUEST['student_admission_id'];
$student_data=mysql_query("SELECT *,T1.id as t1_sr_no,T1.encrypt_id as ad_id,T9.description as hostel_description,"
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
                 . " $db_t1_main_details T1.student_id='$student_id' and T1.is_delete='none'");
         

    $fetch_student_data= mysql_fetch_array($student_data);
    $fetch_student_num_rows=  mysql_num_rows($student_data);
    if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
    {
       
        
        $fetch_student_id=$fetch_student_data['student_id'];
        $fetch_student_sr_no=$fetch_student_data['sr_no'];
        $admission_no=$fetch_student_data['admission_no'];
        $fetch_student_name=$fetch_student_data['student_full_name'];
        $fetch_student_mobile_no=$fetch_student_data['student_mobile_no'];
        $fetch_student_father_name=$fetch_student_data['father_name'];
        $fetch_student_father_mob_no=$fetch_student_data['father_mobile_no'];
        $fetch_local_parents_name=$fetch_student_data['local_parent_name'];
        $fetch_local_parents_mob_no=$fetch_student_data['local_parent_mobile_no'];
        $fetch_studnet_dob=$fetch_student_data['student_dob'];
        $student_photo=$fetch_student_data['student_photo'];
        if(empty($student_photo))
        {
         $student_photo="images/no_avilable_image.gif";   
        }else
        {
        $student_photo=$student_photo;    
        }
        
        $fetch_class_id=$fetch_student_data['course_id'];
        $fetch_section_id=$fetch_student_data['section_id'];
        $fetch_category_id=$fetch_student_data['category_id'];
        $fetch_session_id=$fetch_student_data['session_id'];
        $fetch_student_roll_no=$fetch_student_data['roll_no'];
        $student_gender=  ucfirst($fetch_student_data['student_gender']);
        
       $course_name=$fetch_student_data['course_name'];             
$section_name=$fetch_student_data['section_name'];
$session_name=$fetch_student_data['session_name'];
$category_name=$fetch_student_data['category_name'];
$house_name=ucwords($fetch_student_data['house_name']);
        
        echo "<table cellspacing='0' cellpadding='0' style=' width:100%; height:auto;   border:1px solid silver;      '>
                                
                                <tbody>
                                <tr id='studentdetailsrecord'>

    <tr>
                                    <td style='width:90px;   height:20px; padding-left:3px;  '>
                                    <b>Sr/Form No</b>
                                    </td>  
                                    <td style='width:50px;'>
                                        <strong>: $fetch_student_sr_no
                                     <input type='hidden' value='$fetch_student_sr_no' id='student_sr_no'></strong>
                                    </td>
                                    <td style='width:90px;'>
                                   <b> Admission No.</b>
                                    </td>  
                                    <td style='width:80px;'>
                                        <strong>: $admission_no  
   <input type='hidden' value='$fetch_student_id' id='student_admission_no'></strong>
     <input type='hidden' id='student_class_id' value='$fetch_class_id'>                               
     </td>
     
                                    <td rowspan='5' style='width:85px; '>
                                        <div style='width:80px; height:95px; border:1px solid silver; float:right;
                                             margin-right:5px;   margin-top:2px;   '>
                                      <img src='../$student_photo' style='width:80px; height:95px;'>      
                                        </div>
                                    </td>
                                </tr>
     <tr>
     <td style='width:90px;  height:20px; padding-left:3px;  '>
                                    <b>Class</b>
                                    </td>  
                                    <td style='width:100px;'>
                                        <strong>:</strong> $course_name
                                    </td>
                                    <td style='width:90px;'>
                                   <b>Section</b>
                                    </td>  
                                    <td style='width:80px;'>
                                        <strong>:</strong> $section_name
                                  
     </td>
     </tr>
   <tr>
     <td style='width:90px;  height:20px; padding-left:3px;  '>
                                    <b>Roll No.</b>
                                    </td>  
                                    <td style='width:50px;'>
                                        <strong>:</strong> $fetch_student_roll_no
                                    </td>
                                    <td style='width:90px;'>
                                   <b>Session</b>
                                    </td>  
                                    <td style='width:80px;'>
                                        <strong>:</strong> $session_name
                                  
     </td>
     </tr>
     
                                <tr>
                                    <td style='width:90px;height:20px; padding-left:3px; '>
                                        <b>Student Name</b>
                                    </td>  
                                    <td colspan='3'>
                                       <strong>:</strong> $fetch_student_name
                                    </td>
                                    
                                </tr> 
                                  <tr>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                    <b>Mobile No.</b>
                                    </td>  
                                    <td colspan='3' style=' width:auto;'>
                                       <strong>:</strong> $fetch_student_mobile_no
                                    </td>
                                    
                                </tr>
   <tr>
     <td style='width:90px;  height:20px; padding-left:3px;  '>
                                   <b>Gender</b>
                                    </td>  
                                    <td style='width:50px;'>
                                        <strong>:</strong> $student_gender
                                    </td>
                                    <td style='width:90px;'>
                                   <b>Category</b>
                                    </td>  
                                    <td COLSPAN='2'>
                                        <strong>:</strong> $category_name
   <SPAN style='padding-left:25px;'><b>D.O.B</b> <strong>:</strong> $fetch_studnet_dob</SPAN>
                                  
     </td>
    
     </tr>
                              <tr>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                       <b> Father Name</b>
                                    </td>  
                                    <td colspan='2' style=' width:auto;'>
                                       <strong>:</strong> $fetch_student_father_name
                                    </td>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                    <b>Mobile No.</b>
                                    </td>  
                                    <td colspan='2' style=' width:auto;'>
                                       <strong>:</strong> $fetch_student_father_mob_no
                                    </td>
                                </tr>";
                                 if(!empty($fetch_local_parents_name))
                                 {
                                  echo"<tr>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                     <b>Local Guardian</b>
                                    </td>  
                                    <td colspan='2' style=' width:auto;'>
                                       <strong>:</strong> $fetch_local_parents_name
                                    </td>
                                    <td style='width:90px;height:20px; padding-left:3px;   '>
                                   <b> Mobile No.</b>
                                    </td>  
                                    <td colspan='2' style=' width:auto;'>
                                       <strong>:</strong> $fetch_local_parents_mob_no
                                    </td>
                                </tr>";
                                 }
                                 
    echo" <tr><td style='width:100px; height:10px;'></td></tr>

        
   </tr>
                                
                            </tbody></table>";    
        
    }else
    {
        echo "<div class='record_no_found'> Record No Found !!</div>";   
    }
}

    ?>