<?php
//SESSION CONFIGURATION
$check_array_in="hr";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Employee Search</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
             
  //normal search
  function normal_search()
  {
 
   document.getElementById("normal_search_id").style.display="block";
   document.getElementById("advance_div").style.display="none";
  
  }
  
  //advance search
  function advance_search()
  {

   document.getElementById("advance_div").style.display="block";
   document.getElementById("normal_search_id").style.display="none";
  
   
  }
  
            </script>
            
            <script type="text/javascript">
              function employee_normal_search_record()
              {
              var department=document.getElementById("department_id").value;
              var designation=document.getElementById("designation_id").value;
              var employee_id=document.getElementById("employee_id").value;
              
              if(department==0 && designation==0 && employee_id==0)
              {
                 alert("Please select atleast one option");
                 return false;
              }else
              {
              window.location.assign("employee_search.php?xml_serch_type=normal&xml_department="+department+"&xml_designation="+designation+"&xml_employee="+employee_id+""); 
              }
               }
               
               function student_advance_search_record()
               {
                   var search_by=document.getElementById("search_by").value;
                   var search_qq=document.getElementById("search_dyanamic").value;
                   
                   if(search_by==0)
                   {
                      alert("Please select search by");
                      document.getElementById("search_by").focus();
                      return false;
                   }else
                       if(search_qq==0)
                   {
                      alert("Please enter search keyword here");
                      document.getElementById("search_dyanamic").focus();
                      return false;
                   }else
                   {
                   window.location.assign("employee_search.php?xml_serch_type=advance&xml_search_by="+search_by+"&xml_search_qq="+search_qq+""); 
                  
                   }
               }
            </script>
            <script type="text/javascript" src="javascript/employee_javascript.js"></script>
            
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
            #advance_div { display:none; }
        </style>
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="hr_dashboard.php">Human Resource</a></td>
                           <td>/</td>
                           <td>Employee Search</td>
                       </tr>
                   </table>   
               </div>
              
                <div class="extra_add_on_div">
                    <a href="add_employee.php"><div class="add_button">Add New Employee</div></a>  
                </div>
                
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
               <input type="hidden" value="<?php  echo $fetch_school_id;?>" id="organization_id">
               <input type="hidden" value="<?php  echo $fetch_branch_id;?>" id="branch_id">
               
               
               <?php 
               if((!empty($_REQUEST['xml_serch_type'])))
               {
                $search_type=$_REQUEST['xml_serch_type'];
                if($search_type=="normal")
                {
                 $normal_check="checked";
                 $advance_check="";
                 
                 echo "<style>
                     #normal_search_id { display:block; }
                     #advance_div {display:none; }
                    </style>"; 
                }else
                 if($search_type=="advance")
                {
                 $normal_check="";
                 $advance_check="checked";    
                    echo "<style>
                     #normal_search_id { display:none; }
                     #advance_div {display:block; }
                    </style>"; 
                }
               }else
               {
                $normal_check="checked";
                $advance_check="";   
               }
               ?>
               
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
                           <td><b>Department </b></td>
                           <td><b>:</b></td>
                           <td>
 <select onchange="department(this.value)" id="department_id" class="select_search_style">
     <option id="zero_class" value="0">-- Select --</option>
                             <?php
                             if(!empty($_REQUEST['xml_department']))
                             {
                             $get_department=$_REQUEST['xml_department'];   
                             }else
                             {
                              $get_department="";   
                             }
                             $department_db=mysql_query("SELECT * FROM hr_department_db WHERE $db_main_details_whout_session is_delete='none'");
                             while ($department_data=mysql_fetch_array($department_db))
                             {
                                 $department_id=$department_data['department_id'];
                                 $department_name=$department_data['department_name'];
                                 
                                 if($get_department==$department_id)
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
                       
                           <td><b>Designation</b></td>
                           <td><b>:</b></td>
                           <td><select onchange="designation(this.value)" id="designation_id" class="select_search_style">
                                   <option id="zero_seztion" value="0">-- Select --</option>
                                <?php
                              if(!empty($_REQUEST['xml_designation']))
                             {
                             $get_designation=$_REQUEST['xml_designation'];   
                             }else
                             {
                              $get_designation="";   
                             }  
                             $designation_db=mysql_query("SELECT * FROM hr_designation_db WHERE $db_main_details_whout_session is_delete='none'");
                             while ($designation_data=mysql_fetch_array($designation_db))
                             {
                                 $designation_id=$designation_data['designation_id'];
                                 $designation_name=$designation_data['designation_name'];
                                 if($get_designation==$designation_id)
                                 {
                                 echo "<option value='$designation_id' selected>$designation_name</option>";
                                 }else
                                 {
                                     echo "<option value='$designation_id'>$designation_name</option>";
                                 
                                 }
                                 
                             }
                             ?>
                               </select></td>
                          
                           <td><b>Employee</b></td>
                           <td><b>:</b></td>
                           <td>
                               <style>
                                #employee_id_chosen { width:320px; }  
                                .active-result{ font-size:12px; }
                               </style>
                               <?php
                                if(!empty($_REQUEST['xml_employee']))
                             {
                             $get_employee=$_REQUEST['xml_employee'];   
                             }else
                             {
                              $get_employee="";   
                             }  
                               ?>
                               <div id="employee_select">
                                   <select id="employee_id" data-placeholder="---Select---" class="chosen-select" tabindex="-1">
                                   <option></option>
                                   <?php 
                                     $employee_db=mysql_query("SELECT *,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id ");
              while ($employee_data=mysql_fetch_array($employee_db))
              {
                
                $employee_unique_id=$employee_data['t1_employee_id'];
                $employee_encrypt_id=$employee_data['t1_encrypt_id'];
                $employee_no=$employee_data['employee_no'];
                $employee_name=$employee_data['full_name'];
                $employee_gender=ucwords($employee_data['gender']);
                $employee_mobile_no=$employee_data['mobile'];
                $employee_father_name=ucwords($employee_data['father_name']);
                
                if($employee_gender=="Male")
                {
                  $gender="S/O";  
                }  else {
                 $gender="D/O";     
                }
                if($get_employee==$employee_unique_id)
                {
                echo "<option value='$employee_unique_id' selected>$employee_no / $employee_name <B>$gender</B> $employee_father_name</option>";  
                }else
                {
                  echo "<option value='$employee_unique_id'>$employee_no / $employee_name <B>$gender</B> $employee_father_name</option>";  
                  
                }
                }
                                   ?>
                                   </select>   
                               </div>
                           </td>
                       
                       
                       </tr>
                       <tr>
                           <td colspan="10">
                               <input type="button" onclick="employee_normal_search_record()" id="search_button" value="Search">
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
     <select id="search_by" class="select_search_style">
     <option id="zero_search_by" value="0">--Select--</option>
     <option id="T2.full_name" value="T2.full_name">Employee Name</option>
     <option id="T1.employee_no" value="T1.employee_no">Employee Number</option>
     <option id="T2.mobile" value="T2.mobile">Employee Mobile Number</option>
     <option id="T2.email" value="T2.email">Employee Email</option>
     <option id="T3.father_name" value="T3.father_name">Father Name</option>
     <option id="T3.mother_name" value="T3.mother_name">Mother Name</option>
     <option id="T3.spouse_name" value="T3.spouse_name">Spouse Name</option>
     <option id="T4.department_name" value="T4.department_name">Department</option>
     <option id="T5.designation_name" value="T5.designation_name">Designation</option>
     <option id="T1.joining_date" value="T1.joining_date">Joining Date</option>
     <option id="T2.gender" value="T2.gender">Gender</option>
     <option id="T2.dob" value="T2.dob">Date Of Birth</option>
     <option id="T2.blood_group" value="T2.blood_group">Blood Group</option>
     <option id="T2.birth_palace" value="T2.birth_palace">Birth Palace</option>
     <option id="T2.nationality" value="T2.nationality">Nationality</option>
     <option id="T2.religion" value="T2.religion">Religion</option>
     <option id="T8.category_name" value="T8.category_name">Category</option>
     <option id="T2.sub_category" value="T2.sub_category">Sub Category</option>
     <option id="T2.marital_status" value="T2.marital_status">Martial Status</option>
     <option id="T2.current_address" value="T2.current_address">Address</option>
     <option id="T2.current_city" value="T2.current_city">City</option>
     <option id="T2.emergency_mobile_no" value="T2.emergency_mobile_no">Emergency Mobile Number </option>
     <option id="T2.emergency_phone" value="T2.emergency_phone">Emergency Phone</option>
     <option id="T6.bank_name" value="T6.bank_name">Bank Name</option>
     <option id="T6.branch" value="T6.branch">Bank Branch Name</option>
     <option id="T6.account_no" value="T6.account_no">Account Number</option>
     <option id="T6.ifsc_code" value="T6.ifsc_code">IFSC Code</option>
    </select>
                           </td>
                           <td>
                               <b>Search<sup>*</sup></b>
                           </td>
                           <td><b>:</b></td>

                           <td><input type="text" id="search_dyanamic" value="<?php if(!empty($_REQUEST['xml_search_qq'])) { echo $_REQUEST['xml_search_qq']; } ?>"  class='search_advance' placeholder="Enter search keyword here">
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
               
               
               
               <div id="student_record_data">
               <div class="top_button_div">
                   <div class="header_top_button" onclick="PrintDiv('List Of Employee')" style=" background-color:green; ">Print</div>
                   <div class="header_top_button" style=" background-color:darkslateblue; ">Send Email</div> 
                   <div class="header_top_button">Send SMS</div> 
                   
               </div>
                    <style>
                   .table_th_style td{ padding-left:0.2%; padding-right:0.2%;  font-size:11px;   }   
                .table_tr_style td{ padding-left:0.2%; padding-right:0.2%; font-size:11px;    }   
               </style> 
                   
                   
               <div id="table_print_div">
               <table cellspacing="0" cellpadding="0" class="table_list">
                   <tr id="table_th_style" class="table_th_style">
                   <td class="hidden_td"><input type="checkbox"></td>
                   <td>Sl.No</td>
                    <td style=" text-align:left; ">Department</td>
                   <td style=" text-align:left; ">Designation</td>
                   <td>Employee No.</td>
                   <td>Joining Date</td>
                   <td style=" text-align:left; ">Employee Name</td>
                   <td>Gender</td>
                   <td style=" text-align:left; ">Mobile No.</td>
                   <td style=" text-align:left; ">Father Name</td>
                   <td class="td_right_border">Profession Teaching</td>
                  <td style=" border-right:1px solid gray; " class="hidden_td">Action</td>
               </tr>
              <?php
              
              if((!empty($_REQUEST['xml_department']))&&(!empty($_REQUEST['xml_designation']))&&(!empty($_REQUEST['xml_employee'])))
              {
               $department=$_REQUEST['xml_department'];
               $designation=$_REQUEST['xml_designation'];
               $employee=$_REQUEST['xml_employee'];     
               $search_result="T1.employee_id='$employee' and T1.department_id='$department' and T1.designation_id='$designation' and";   
              }else
                   if((!empty($_REQUEST['xml_department']))&&(!empty($_REQUEST['xml_designation'])))
              {
               $department=$_REQUEST['xml_department'];
               $designation=$_REQUEST['xml_designation'];
                    
               $search_result=" T1.department_id='$department' and T1.designation_id='$designation' and";   
              }else
               if((!empty($_REQUEST['xml_department']))&&(!empty($_REQUEST['xml_employee'])))
              {
               $department=$_REQUEST['xml_department'];
               $employee=$_REQUEST['xml_employee'];     
               $search_result="T1.employee_id='$employee' and T1.department_id='$department' and";   
              }else
               if((!empty($_REQUEST['xml_designation']))&&(!empty($_REQUEST['xml_employee'])))
              {
               $designation=$_REQUEST['xml_designation'];
               $employee=$_REQUEST['xml_employee'];     
               $search_result="T1.employee_id='$employee' and T1.designation_id='$designation' and";   
              }else
               if((!empty($_REQUEST['xml_employee'])))
              {
               $employee=$_REQUEST['xml_employee'];     
               $search_result="T1.employee_id='$employee' and";   
              }else
               if((!empty($_REQUEST['xml_designation'])))
              {
               $designation=$_REQUEST['xml_designation'];
               $search_result="T1.designation_id='$designation' and";   
              }else
               if((!empty($_REQUEST['xml_department'])))
              {
               $department=$_REQUEST['xml_department'];  
               $search_result="T1.department_id='$department' and";   
              }else
                  if((!empty($_REQUEST['xml_search_by']))&&(!empty($_REQUEST['xml_search_qq'])))
                  {
                 $search_by=$_REQUEST['xml_search_by'];
                 $search_q=$_REQUEST['xml_search_qq'];      
                 $search_result="$search_by LIKE '%$search_q%' and ";      
                  }else
              {
                $search_result="";  
              }
              
              
              $row=0;
              $employee_db=mysql_query("SELECT *,T1.id as db_id,T1.employee_id as t1_employee_id,T1.encrypt_id as t1_encrypt_id FROM hr_employee_db as T1 "
                      . "LEFT JOIN hr_employee_personal_db as T2 ON T1.employee_personal_id=T2.employee_personal_id "
                      . "LEFT JOIN hr_family_db as T3 ON T1.family_id=T3.family_unique_id "
                      . "LEFT JOIN hr_department_db as T4 ON T1.department_id=T4.department_id "
                      . "LEFT JOIN hr_designation_db as T5 ON T1.designation_id=T5.designation_id "
                      . "LEFT JOIN hr_bank_db as T6 ON T1.bank_id=T6.bank_unique_id "
                      . "LEFT JOIN category_db as T8 ON T1.category_id=T8.category_id WHERE $search_result T1.is_delete='none'");
              $empoyee_num_rows=mysql_num_rows($employee_db);
              while ($employee_data=mysql_fetch_array($employee_db))
              {
                $row++;
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
                
                
                  echo "<tr id='delete_row_$employee_unique_id' class='table_tr_style'>"
                  . "<td class='hidden_td'><center><input type='checkbox'></center></td>"
                          . "<td><center><b>$row</b></center></td>"
                           . "<td>$deapartment</td>"
                          . "<td>$designation</td>"
                          . "<td><center><b>$employee_no</b></center></td>"
                          . "<td><center>$employee_joining_date</center></td>"
                          . "<td>$employee_name</td>"
                          . "<td><center>$employee_gender</center></td>"
                          . "<td>$employee_mobile_no</td>"
                          . "<td>$employee_father_name</td>"
                          . "<td class='td_right_border'><center>$employee_teaching_profession</center></td>"
                         . "<td style='border-right:1px solid gray; padding:0; width:200px;' class='hidden_td'>";
                  {
                  ?>
               <div class="view_delete_buttons" onclick="employee_full_details('<?php echo $employee_unique_id;?>','<?php echo $employee_db_id;?>')" style="background-color:dodgerblue; width:55px;">View</div>
               <a href="edit_employee_detail.php?token_id=<?php echo $employee_encrypt_id;?>">
                      <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
           
             <div onclick="delete_data('<?php echo $employee_unique_id;?>','employee_delete_command')" class="edit_delete_button">Delete</div>
                           
               <?php
                  }
                           echo"</td></tr>";   
                  
              }
              if(empty($empoyee_num_rows))
              {
                  echo "<tr><td colspan='12' style='text-align:center; color:Red; "
                  . " border:1px solid black; border-top:0; font-size:15px; height:45px;'>Record no found !</td></tr>";   
              } 
              ?>
               </table>
              </div>
            </div>
               
               <div id="full_student_data" class="parent_list_style"  style=" display:none; "></div></div>
            </div></div>
        
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        <?php
        if((!empty($_REQUEST['xml_search_by'])))
        {
        {
            ?>
        <script type="text/javascript">
         function page_load()
        {
            if(document.getElementById("<?php echo $_REQUEST['xml_search_by'];?>"))
            {
        document.getElementById("<?php echo $_REQUEST['xml_search_by'];?>").selected=true;   
            }
            
            
        }
        </script>
        
        <?php
        }    
        }
        ?>
        
        <div class="use_height_maintain_div"></div>
        
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