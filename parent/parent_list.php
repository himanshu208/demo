<?php
//SESSION CONFIGURATION
$check_array_in="parent";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Parent List</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        
    </head>
    <body onload="page_load()">
        
       <?php 
include_once '../ajax_loader_page_second.php';
          ?>
        <div id="fetch_record" style=" display:none; "></div>
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div>
        
        <style>
            .search{
                width:320px; height:25px; border:1px solid silver; padding-left:4px; padding-right:4px; 
            }   
            
        </style>
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td>Parent List</td>
                       </tr>
                   </table>   
               </div>
              
                <div class="extra_add_on_div">
                    <a href="add_parent.php"><div class="add_button">Add New Parent</div></a>  
                </div>
                
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
               <input type="hidden" value="<?php  echo $fetch_school_id;?>" id="organization_id">
               <input type="hidden" value="<?php  echo $fetch_branch_id;?>" id="branch_id">
               <style>
                   .table_th_style td{ padding-left:0.2%; padding-right:0.2%; font-size:10px;    }   
                .table_tr_style td{ padding-left:0.2%; padding-right:0.2%;   font-size:10px;    }   
               </style>
               
               <div id="search_first_div">
               
                   <div id="advance_div">
                      <table class="search_table">
                       <tr>
                           <td><b>Search By <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td>
     <select id="search_by" class="select_search_style">
     <option id="zero_search_by" value="0">-- Select Search By --</option>
     <option id="T6.father_name" value="T6.father_name">Father Name</option>
     <option id="T6.father_mobile_no" value="T6.father_mobile_no">Father Mobile No.</option>
     <option id="T6.father_email" value="T6.father_email">Father Email id</option>
     <option id="T6.mother_name" value="T6.mother_name">Mother Name</option>
     <option id="T6.mother_mobile_no" value="T6.mother_mobile_no">Mother Mobile No.</option>
     <option id="T6.mother_email_id" value="T6.mother_email_id">Mother Email id</option>
     <option id="T6.local_parent_relation" value="T6.local_parent_relation">Local Guardian Relation </option>
     <option id="T6.local_parent_name" value="T6.local_parent_name">Local Guardian Name </option>
    <option id="T6.local_parent_mobile_no" value="T6.local_parent_mobile_no">Local Guardian Mobile No. </option>
    <option id="T6.local_parent_email_id" value="T6.local_parent_email_id">Local Guardian Email id</option>
     </select>
                           </td>
                           <td>
                               <b>Search<sup>*</sup></b>
                           </td>
                           <td><b>:</b></td>

                           <td><input type="text" value="<?php if(!empty($_REQUEST['search_q'])) { echo $_REQUEST['search_q']; } ?>" id="search_dyanamic"  class='search_advance'  placeholder="Enter keyword here">
                           </td> 
                           <td>
                               <div id="small_ajax_loading">
                                <img height="20px" src="../images/load.gif">   
                               </div>
                           </td>
                           <td>
                               
                               <input type="button" id="search_button" onclick="reset_button()" style=" background:#9e3a3a; color:white; margin-left:20px; box-shadow:none;    " value="Reset All">
                               
                               <input type="button" onclick="parent_search()" id="search_button" value="Search">
                           
                           </td>
                       </tr>
                      </table>
                       
                   </div>
                   
                   
                   
               </div>
               <div id="parent_list">
               <div class="top_button_div">
                   <div class="header_top_button" onclick="PrintDiv('List Of Parents')" style=" background-color:green; ">Print</div>
                   <div class="header_top_button" style=" background-color:darkslateblue; ">Send Email</div> 
                   <div class="header_top_button">Send SMS</div> 
                   
               </div>
                   
               <?php
               if((!empty($_REQUEST['search_by']))&&(!empty($_REQUEST['search_q'])))
               {
               $search_by=$_REQUEST['search_by'];    
                $search_qq=$_REQUEST['search_q'];  
               $search_result="$search_by LIKE '%$search_qq%' and";    
               }else
               {
                  $search_result=""; 
               }
               ?>    
              <div id="table_print_div">
               <table cellspacing="0" cellpadding="0" class="table_list">
                   <tr id="table_th_style" class="table_th_style">
                   <td class="hidden_td"><input id="selecctall" type="checkbox"></td>
                   <td>Sl.No</td>
                   <td>Father Name</td>
                   <td>Mobile No.</td>
                   <td>Mother Name</td>
                   <td>Mobile No.</td>
                   <td>Local Guardian</td>
                    <td>Mobile No.</td>
                   <td class="td_right_border">Children</td>
                   <td style=" border-right:1px solid gray; " class="hidden_td">Action</td>
               </tr>
               <?php
               $row=0;
               $parants_match=array();
               $parents_db=mysql_query("SELECT *,T6.encrypt_id as parent_encrypt_id FROM parent_db as T6 "
                       . "LEFT JOIN student_db as T1 ON T6.parent_unique_id=T1.parent_id "
                       . "LEFT JOIN student_personal_db as T7 ON T1.student_id=T7.student_unqiue_id "
                       . "WHERE $db_t1_main_details $search_result T1.is_delete='none' OR T6.organization_id='$fetch_school_id'"
                       . " and T6.branch_id='$fetch_branch_id' and T6.session_id='$fecth_session_id_set' and $search_result T6.is_delete='none'");
               while ($parent_data=mysql_fetch_array($parents_db))
               {
               $parent_unique_id=$parent_data['parent_unique_id'];
                     
                if(in_array($parent_unique_id,$parants_match)==false)   
                {  
                 $row++;
                 
                 $parent_encrypt_id=$parent_data['parent_encrypt_id'];
                 $father_name=$parent_data['father_name'];
                 $father_mobile_no=$parent_data['father_mobile_no'];
                 $mother_name=$parent_data['mother_name'];
                 $mother_mobile_no=$parent_data['mother_mobile_no'];
                 
                 $local_guradain=$parent_data['local_parent_name'];
                         $guradian_mobile_no=$parent_data['local_parent_mobile_no'];
                 array_push($parants_match, $parent_unique_id);
                 
                 
                 
                 echo "<tr id='delete_row_$parent_unique_id' class='table_tr_style'>"
                 . "<td class='hidden_td'><center><input class='checkbox1' type='checkbox'></center></td>"
                         . "<td><center><b>$row</b></center></td>"
                         . "<td><center>$father_name</center></td>"
                         . "<td><center>$father_mobile_no</center></td>"
                         . "<td><center>$mother_name</center></td>"
                         . "<td><center>$mother_mobile_no</center></td>"
                         . "<td><center>$local_guradain</center></td>"
                         . "<td><center>$guradian_mobile_no</center></td>"
                         . "<td class='td_right_border'>";
                 
                 $student_db=mysql_query("SELECT *,T1.encrypt_id as student_encrypt_id FROM student_db as T1 "
                         . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                         . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                         . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id WHERE T1.parent_id='$parent_unique_id' and T1.is_delete='none'");
                $student_num_rows=mysql_num_rows($student_db);
             
                 if(!empty($student_num_rows))
                 {
                 {
                 ?>
               
               
               <table cellspacing="0" cellpadding="0" class="student_middle_table">
                   <tr id="table_th_style" class="student_table_th">
                       <td>Admission No.</td>
                       <td>Student Name</td>
                       <td>Gender</td>
                       <td class="td_right_border">Class-Section</td>
                       <td style=" border-right:1px solid gray; " class="hidden_td">Action</td>
                   </tr>
                   
                   <?php
                 while ($fetch_student_data=mysql_fetch_array($student_db))
                 {
                     
$student_encrypt_id=$fetch_student_data['student_encrypt_id'];                   
$form_sr_no=$fetch_student_data['sr_no'];
$admission_no=$fetch_student_data['admission_no'];
$student_roll_no=$fetch_student_data['roll_no'];       
$student_admission_date=$fetch_student_data['admission_date'];  
$enrollment_no=$fetch_student_data['enrollment_no'];  
$course_name=$fetch_student_data['course_name'];             
$section_name=$fetch_student_data['section_name'];
 
    $student_full_name=ucwords($fetch_student_data['student_full_name']);
    $student_gender=ucfirst($fetch_student_data['student_gender']);    
                
                   ?>
                   
                     <tr class="student_table_td">
                         <td><center><?php echo $admission_no;?></center></td>
               <td><center><?php echo $student_full_name;?></center></td>
               <td><center><?php echo $student_gender;?></center></td>
               <td class="td_right_border"><center><?php echo $course_name;?>-<?php echo $section_name;?></center></td>
               <td style=" border-right:1px solid gray; width:70px;  " class="hidden_td">
                    <a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                    <div class="view_delete_buttons" style="background-color:dodgerblue; width:55px;">View</div></a>
                       
               </td>
                   </tr>
                   <?php
                 }
                   ?>
               </table>
               
               <?php
                 }
                 }
                         echo"</td>"
                         . "<td style='width:200px; border-right:1px solid gray;' class='hidden_td'>";
                 {
                 ?>
               <div class="view_delete_buttons" onclick="parent_full_details('<?php echo $parent_unique_id;?>','parent_full_detail_id')" style="background-color:dodgerblue; width:55px;">View</div>
                       <a href="#" onclick="window.open('edit_parent.php?token_id=<?php  echo $parent_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                       <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        <?php
                        if(!empty($student_num_rows))
                        {
                        ?>
                        <div style=" cursor: not-allowed; opacity:0.4;  " class="edit_delete_button">Delete</div>
                <?php
                        }else
                        {
                ?>
                      <div onclick="delete_data('<?php echo $parent_unique_id;?>','parent_delete_command')" class="edit_delete_button">Delete</div>
               
                        <?php
                        }
                        ?>
 <?php
                 }
                         echo"</td></tr>";  
                 
               }
               }
               
               if(empty( $father_name))
               {
                      echo "<tr><td colspan='15' style='text-align:center; color:Red; "
                  . " border:1px solid black; border-top:0; font-size:15px; height:45px;'>Record no found !</td></tr>"; 
               }
               ?>
               
               </table>
                 </div>
            </div>
            
               <script type="text/javascript">
               function parent_back()
               {
               document.getElementById("parent_full_details").style.display="none";  
               document.getElementById("parent_list").style.display="block";  
               }
               </script>
               
               <div id="parent_full_details" class="parent_list_style"  style=" display:none; "></div>
                   
                   
               </div>
            
            
            </div>
        </div>
        
        <script type="text/javascript" src="javascript/delete_javascript.js"></script>
        <script type="text/javascript" src="javascript/parent_javascript.js"></script>
        <script type="text/javascript">
        function parent_search()
        {
          var search_by=document.getElementById("search_by").value;
          var search=document.getElementById("search_dyanamic").value;
          if(search_by==0)
          {
             alert("Please select search by");
             document.getElementById("search_by").focus();
             return false;
          }else
              if(search==0)
          {
             alert("Please enter search keyword here");
             document.getElementById("search_dyanamic").focus();
             return false;
          }else
          {
           document.getElementById("ajax_loader_show").style.display="block"; 
         
          window.location.assign("parent_list.php?search_by="+search_by+"&search_q="+search+"");
           }
        }
        
       function reset_button()
       {
          document.getElementById("ajax_loader_show").style.display="block"; 
         
          window.location.assign("parent_list.php");
             
       }
        </script>
        
        <?php
        if((!empty($_REQUEST['search_by'])))
        {
        {
            ?>
        <script type="text/javascript">
         function page_load()
        {
            if(document.getElementById("<?php echo $_REQUEST['search_by'];?>"))
            {
        document.getElementById("<?php echo $_REQUEST['search_by'];?>").selected=true;   
            }
            
            
        }
        </script>
        
        <?php
        }    
        }
        ?>
        <script type="text/javascript">
        $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
        </script>
        <div class="use_height_maintain_div"></div>
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>