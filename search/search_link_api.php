<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <style>
        .select_search_style{ width:140px; }    
          #student_id_chosen{ width: 370px;}  
         .active-result{ font-size:11px; }
         .chosen-single span { font-size:11px; }
        </style>
       <div id="search_first_div">
                   <table class="top_search_type_table">
                       <tr>
                           <td><input type="radio" onclick="normal_search()" name="search_type" class='search_checked_styling' <?php echo $normal_check;?>></td>
                           <td><b>Normal Search</b></td>
                           <td style=" width:20px; "></td>
                           <td><input onclick="advance_search()" class='search_checked_styling' name="search_type" type="radio" <?php echo $advance_check;?>></td>
                           <td><b>Advance Search</b></td>
                           
                           
                       </tr>
                   </table>
                   <input type="hidden" id="admission_no" value="">
                   
                   <div id="normal_search_id" > 
                   <table class="search_table">
                       <tr>
                           <td><b>Course/Class</b></td>
                           <td><b>:</b></td>
                           <td>
<select onchange="class_ajax_id(this.value)" id="class_name" class="select_search_style">
<option id="zero_class" value="0">-- Select --</option>
<?php 

                               $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details_whout_session is_delete='none'");
                               while ($fetch_class_data=mysql_fetch_array($class_db))
                               {
                                 if(!empty($_REQUEST['xml_class_id']))
{
 $get_class_id=$_REQUEST['xml_class_id']; 
}else
{
 $get_class_id="";   
}  
                                   
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                                if($get_class_id==$fetch_class_id)
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
                       
                           <td><b>Section </b></td>
                           <td><b>:</b></td>
                           <td><select onchange="section_ajax_id(this.value)" id="section_name" class="select_search_style">
                                   <option id="zero_seztion" value="0">-- Select --</option>
                       <?php 
                       if(!empty($_REQUEST['xml_class_id']))
                       {
                         $token_class_id=$_REQUEST['xml_class_id'];  
                           
if(!empty($_REQUEST['xml_section_id']))
{
 $get_section_id=$_REQUEST['xml_section_id']; 
}else
{
 $get_section_id="0";   
}
   

$section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details_whout_session course_id='$token_class_id' and is_delete='none'");
                               while ($fetch_section_data=mysql_fetch_array($section_db))
                               {
                                $fetch_section_name=$fetch_section_data['section_name'];
                                $fetch_section_id=$fetch_section_data['section_id'];
                                if($get_section_id==$fetch_section_id)
                                {
                               echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
                                }else
                                {
                                 echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
                                   
                                }
                               }
                       }
                               ?>
                              </select></td>     
                            <td><b>House </b></td>
                           <td><b>:</b></td>
                           <td><select onchange="house(this.value)" id="house_name" class="select_search_style">
                                   <option id="zero_seztion" value="0">-- Select --</option>
                              <?php
                              if(!empty($_REQUEST['xml_house']))
                              {
                              $get_house=$_REQUEST['xml_house'];   
                              }else
                              {
                                $get_house="";    
                              }
                              
                              
                               $house_db=mysql_query("SELECT * FROM house_db WHERE $db_main_details_whout_session is_delete='none'");
                               while ($fetch_house_data=mysql_fetch_array($house_db))
                               {
                                $fetch_house_id=$fetch_house_data['house_id'];
                                $fetch_house_name=$fetch_house_data['house_name'];
                                
                                if($get_house==$fetch_house_id)
                                {
                                echo "<option value='$fetch_house_id' selected>$fetch_house_name</option>";
                                }else
                                {
                                  echo "<option value='$fetch_house_id'>$fetch_house_name</option>";
                                  
                                }
                               }
                               ?>
                               </select></td>
                               
                                   
                           <td><b>Student</b></td>
                           <td><b>:</b></td>
                           <td>
                             <div id="student_select">
                                   <select id="student_id" data-placeholder="---Select---" class="chosen-select" tabindex="-1">
                                   <option></option>
                                   <?php
                                   if((!empty($_REQUEST['xml_student_id'])))
                                   {
                                  $get_student_id=$_REQUEST['xml_student_id'];    
                                   }else
                                   {
                                   $get_student_id="";    
                                   }
                                  
                                   if(empty($result_show))
                                   {
                                    $search_resulted="";   
                                   }else
                                   {
                                    $search_resulted=$search_result;   
                                   }
                                   
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
                 . " $db_t1_main_details $search_resulted T1.is_delete='none'");
         
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
   if($get_student_id==$student_unqiue_id)
   {
    echo "<option value='$student_unqiue_id' selected>  $course_name - $section_name / $student_full_name $relation $student_father_name / Mo. $student_father_mobile_no </option>";
   }  else {
      echo "<option value='$student_unqiue_id'> $course_name - $section_name / $student_full_name $relation $student_father_name / Mo. $student_father_mobile_no  </option>";
     
   }
         }
                                   
                                   ?>
                                   </select>
                             </div>
                           </td>
                       
                       
                       </tr>
                       <tr>
                           <td style=" height:10px; "></td>
                       </tr>
                       <tr>
                           <td colspan="14">
                              <input type="button" onclick="student_normal_search_record()" id="search_button" value="Search">
                           
                               
                               
                           </td>
                       </tr>
                   </table>
                   </div>
                   
                   
                   <div id="advance_div" >
                      <table class="search_table">
                       <tr>
                           <td><b>Search By <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td>
                               <select id="search_by" class="select_search_style" style=" width:240px; ">
     <option id="zero_search_by" value="0">-- Select --</option>
     <option id="T7.student_full_name" value="T7.student_full_name">Student Name</option>
      <option id="T7.student_gender" value="T7.student_gender">Gender</option>
     <option id="T7.student_dob" value="T7.student_dob">Date of Birth</option>
     <option id="T6.father_name" value="T6.father_name">Father Name</option>
     <option id="T6.father_mobile_no" value="T6.father_mobile_no">Father Mobile No.</option>
     <option id="T6.father_email" value="T6.father_email">Father Email id</option>
     <option id="T6.mother_name" value="T6.mother_name">Mother Name</option>
     <option id="T6.mother_mobile_no" value="T6.mother_mobile_no">Mother Mobile Number</option>
      <option id="T6.local_parent_relation" value="T6.local_parent_relation">Local Gurdain Relation</option>
      <option id="T6.local_parent_name" value="T6.local_parent_name">Local Gurdain Name</option>
      <option id="T6.local_parent_mobile_no" value="T6.local_parent_mobile_no">Local Gurdain Mobile Number</option>
      <option id="T2.course_name" value="T2.course_name">Class</option>
      <option id="T3.section_name" value="T3.section_name">Section</option>
      <option id="T5.category_name" value="T5.category_name">Category</option>
      <option id="T11.house_name" value="T11.house_name">House</option>
     <option id="T1.sr_no" value="T1.sr_no">Sr.No</option>
     <option id="T1.admission_no" value="T1.admission_no">Admission No.</option>
     <option id="T1.admission_date" value="T1.admission_date">Admission Date</option>
     <option id="T1.account_status" value="T1.account_status">Account status</option>
     <option id="T7.student_mobile_no" value="T7.student_mobile_no">Student Mobile No.</option>
     <option id="T7.student_email_id" value="T7.student_email_id">Student Email id</option>
     <option id="T7.current_address" value="T7.current_address">Address</option>
     </select>
                           </td>
                           <td>
                               <b>Search<sup>*</sup></b>
                           </td>
                           <td><b>:</b></td>

                           <td><input type="text" id="search_dyanamic" value="<?php if(!empty($_REQUEST['xml_search_qq'])) { echo $_REQUEST['xml_search_qq']; }?>" class='search_advance' placeholder="Enter search keyword here">
                             
                           </td> 
                           <td>
                               <div id="small_ajax_loading">
                                <img height="20px" src="../images/load.gif">   
                               </div>
                           </td>
                           <td>
                               <input type="button" onclick="student_advance_search_record()" id="search_button" value="Search">
                           
                           </td>
                       </tr>
                      </table>
                       
                   </div>
                   </div>
    </body>
</html>
