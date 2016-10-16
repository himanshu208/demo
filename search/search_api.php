
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       <div id="search_first_div">
                   <table class="top_search_type_table" id="top_search_optional">
                       <tr>
                           <td><input type="radio" onclick="normal_search()" name="search_type" class='search_checked_styling' checked></td>
                           <td><b>Normal Search</b></td>
                           <td style=" width:20px; "></td>
                           <td><input onclick="advance_search()" class='search_checked_styling' name="search_type" type="radio"></td>
                           <td><b>Advance Search</b></td>
                           
                           
                       </tr>
                   </table>
                   <input type="hidden" id="admission_no" value="">
                   
                   <div id="normal_search_id" > 
                   <table class="search_table">
                       <tr>
                           <td><b>Course/Class <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td>
 <select onchange="class_ajax_id(this.value)" id="class_name" class="select_search_style">
     <option id="zero_class" value="0">-- Select Course/Class --</option>
<?php 
                               $class_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
                               while ($fetch_class_data=mysql_fetch_array($class_db))
                               {
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                                
                               echo "<option value='$fetch_class_id'>$fetch_class_name</option>";
                               }
                               ?>
 </select>
                           
                           </td>
                       
                           <td><b>Section <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select onchange="section_ajax_id(this.value)" id="section_name" class="select_search_style">
                                   <option id="zero_seztion" value="0">-- Select Section --</option></select></td>
                       
                           <td><b>Search <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td>
                               <div id="static_search">
                               <input type="text" id="search_data"  class='search'
                                    onkeyup="live_autocomplete_search(event,this.value)" 
                                    placeholder="Search student name or father name">
                               <ul id="student_li_record" class="list">
                                   
                               </ul>
                               </div>
                           </td>
                       
                       
                       </tr>
                       <tr>
                           <td colspan="10">
                               <input type="button" onclick="student_normal_search_record()" id="search_button" value="Search">
                           </td>
                       </tr>
                   </table>
                   </div>
                   
                   
                   <div id="advance_div" style=" display:none; ">
                      <table class="search_table">
                       <tr>
                           <td><b>Search By <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td>
     <select id="search_by" class="select_search_style">
     <option id="zero_search_by" value="0">-- Select Search By --</option>
     <option value="student_full_name">Student Name</option>
     <option value="father_name">Father Name</option>
     <option value="father_mobile_no">Father Mobile No.</option>
     <option value="father_email">Father Email id</option>
     <option value="id">Sr.No</option>
     <option value="student_id">Admission No.</option>
     <option value="student_dob">Student Date of Birth</option>
     <option value="admission_date">Admission Date</option>
     <option value="account_status">Account status</option>
     <option value="student_mobile_no">Student Mobile No.</option>
     <option value="student_email_id">Student Email id</option>
     <option value="mother_name">Mother Name</option>
     <option value="local_parent_name">Local Guardian Name </option>
     </select>
                           </td>
                           <td>
                               <b>Search<sup>*</sup></b>
                           </td>
                           <td><b>:</b></td>

                           <td><input type="text" id="search_dyanamic"  class='search_advance'
                                    onkeyup="live_advance_search(event,this.value)" 
                                    placeholder="Search student name or father name">
                               <div id="autocomplete_data">
                                   <ul id="student_data_advance_search">
                                       
                                   </ul>   
                               </div>
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
