
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
         <style>
            .search{
                width:320px; height:28px; border:1px solid silver; padding-left:4px; padding-right:4px; 
            }   
            
        </style>
        
        <script type="text/javascript">
        function search_choose(search_option)
        {
        if(search_option=="library_id")   
        {
        document.getElementById("normal_search_id").style.display="none";
        document.getElementById("advance_div").style.display="none";
        document.getElementById("libray_id_div").style.display="block";
        
        }else  
         if(search_option=="normal")   
        {
        document.getElementById("advance_div").style.display="none";
        document.getElementById("libray_id_div").style.display="none";
         document.getElementById("normal_search_id").style.display="block";
         
        }else 
        if(search_option=="advance")   
        {
         document.getElementById("libray_id_div").style.display="none";
         document.getElementById("normal_search_id").style.display="none";
         document.getElementById("advance_div").style.display="block";
         
        }
        }
        </script>
        <script type="text/javascript" src="../javascript/search_integiration_js.js"></script>
        
        <input type="hidden" value="<?php echo $fetch_school_id;?>" id="organization_id">
        <input type="hidden" id="branch_id" value="<?php echo $fetch_branch_id;?>">
        <input type="hidden" id="insert_session_id" value="<?php echo $fecth_session_id_set;?>">
        
        
         <?php
        if((!empty($_REQUEST['search_type']))&&(!empty($_REQUEST['student_library_id'])))
        {
        $search_type=$_REQUEST['search_type'];
        
         if($search_type=="library_id")
         {
         $library_check="checked"; 
         $normal_search="";
         $library_style="display:block;";
         $normal_style="display:none;";
         $student_libary_id=$_REQUEST['student_library_id'];
         
         $search_result="and sr_no='$student_libary_id'";
         }else
             if($search_type=="normal")
             {
             $normal_search="checked"; 
             $library_check="";
             $library_style="display:none;";
             $normal_style="display:block;";
             $student_libary_id=$_REQUEST['student_library_id'];
             $search_result="";
             }else
             {
         $library_check="checked"; 
         $normal_search="";
         $library_style="display:block;";
         $normal_style="display:none;";
         $student_libary_id="";
         $search_result="";
             }
            
        }  else
            {
          $library_check="checked"; 
         $normal_search="";
         $library_style="display:block;";
         $normal_style="display:none;";
         $student_libary_id="";
         $search_result="";
         }
        ?>
        
        
       <div class="first_search_top_div">
                      <table class="search_option_table" style=" font-size:12px;  margin:0 auto; ">
                           <tr>
                               <td><input type="radio" class="radio_check" id="normal_check" onclick="search_choose('library_id')"
                                          name="search_option" <?php echo $library_check;?>></td><td><b>Library ID</b></td> 
                               <td style="width:4%; "></td>
                               <td><input type="radio" class="radio_check" id="normal_check"
                                          onclick="search_choose('normal')" name="search_option" <?php echo $normal_search;?>></td><td><b>Normal Search</b></td> 
                               <td style="width:4%; "></td>
                                </tr>   
                       </table>
                   </div>    
                
       
        
        
        <div id="libray_id_div" class="search_div_second" style=" <?php echo $library_style;?>">
                       <table style=" width:auto;  margin:0 auto; margin-top:20px;  ">
                           <tr>
                               <td style=" width:70px; "><b>Library ID</b></td><td><b>:</b></td>
                               <td><input autocomplete="off" value="<?php echo $student_libary_id;?>" class="text_box_styles" id="library_ac_id" style=" height:30px; " placeholder="Enter student library id number" type="text"></td>
                               <td><input type="button" class="filter_button" onclick="library_id_search()" style=" margin:0; " value="Search"></td>
                           </tr>
                       </table>    
                   </div>
                  
                   
                   
        <style>
            #student_list_chosen { width:400px; }
            </style>
                   <div id="normal_search_id" style=" <?php echo $normal_style;?> "> 
                   <table class="search_table">
                       <tr>
                           <td><b>Course/Class <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td>
 <select onchange="class_course_ajax_id(this.value)" id="class_name" class="select_search_style">
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
                       
                           <td><b>Student <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td>
                               <select id="student_list" data-placeholder="Select Student" class="chosen-select" 
                                       style=" width:400px;  ">
                                   <option value="0"></option>
                               </select>
                           </td>
                       
                       
                       </tr>
                       <tr>
                           <td colspan="10">
                               <input type="button" onclick="student_normal_search_record()" id="search_button" value="Search">
                           </td>
                       </tr>
                   </table>
                   </div>
                   
                   
                   <br/>
                   <div id="advance_div" style=" display:none; ">
                       <table class="search_table" style=" margin:0 auto; ">
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
                                    placeholder="Search student name or father name" style=" height:29px; ">
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
                   
                   
                   <div class="horizental_line"></div>
                   
    </body>
</html>
