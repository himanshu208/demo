<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php
 if(isset($_POST['submit_module_button']))
      {
    
     $update_db_id=$_POST['update_db_module'];
     if(count($_POST['module_list'])>0)
      {
      $module_list=$_POST['module_list'];
      }else
      {
      $module_list=0; 
      }
     
      if((!empty($update_db_id))&&(!empty($module_list)))
      {
    
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

             
      $implode_module_list=implode(",",$module_list);  
       $update_db=mysql_query("UPDATE module_db SET module='$implode_module_list' WHERE module_id='$update_db_id' and action='active'"); 
        if($update_db)
      {
       
      $message_show="<span style='color:green;'>Record update successfully complete.</span>";  
     
      }else
      {
         $message_show="Request failed,Please try again.";
      } 
      }else
      {
         $message_show="Please fill all fields.";
      }
      
      require_once '../pop_up.php';
      } 
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Module</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script>
function toggle(source) {
  checkboxes = document.getElementsByName('module_list[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<script type="text/javascript">
     function org_validate(frm)
     {
         
var destCount=frm.elements['module_list[]'].length;
var destSel   = false;
for(i = 0; i < destCount; i++){
if(frm.elements['module_list[]'][i].checked){
destSel = true;
break;
}
}   
 if(!destSel){
alert('Please select atleast one module');
return false;
}
             else
                 {
                  document.getElementById("ajax_loader_show").style.display="block";    
                   
                 }
     }
    </script>
    </head>
    <body onload="page_load()">
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" onsubmit="return org_validate(this);" enctype="multipart/form-data">
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="system_dashboard.php">System Setting</a></td>
                           <td>/</td>
                           <td>Manage Module</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
           
              <div id="top_show_button">
                    <div id="transport_function" class="Short_menu_show"><b>Manage Module</b></div>
                     
                </div>
                <div class="main_work_data" style=" padding-top:20px;">
                <div class="middle_left_div_tag">
                  
                    <?php
                    $module_db=mysql_query("SELECT * FROM module_db WHERE $db_main_details_whout_session admin_type='branch_head_admin' and action='active'");
                    $module_data=mysql_fetch_array($module_db);
                    $moudle_num_rows=mysql_num_rows($module_db);
                    if((!empty($module_data))&&($module_data!=null)&&($moudle_num_rows!=0))
                    {
                     $module_unique_id=$module_data['module_id'];
                     $module_list=$module_data['module'];
                     
                     
                     
                    {
                    ?>
                    
                    <input type="hidden" name="update_db_module" value="<?php echo $module_unique_id;?>">
                    <table cellspacing="4" cellpadding="4" class="module_list_table">
                                
                                <tr>
                                    <td colspan="3">
                                      <table cellspacing="0" cellpadding="7" style=" width:100%;  margin-left:20px; ">
                                          <tr  style=" background-color:aliceblue; border-radius:2px;  ">
                              <td><input type="checkbox" onClick="toggle(this)"  class="module_list" id="select_all">
                              </td>
                              <td><b>:</b></td>
                              <td><b>All Select</b></td>
                              
                              
                                </tr>
                                <tr>
                                    <td  colspan="30">
                                        <div class="verticle_lines" style=" background-color:black; margin-left:0; padding-left:0; float:left;    "></div>  
                                    </td>
                                </tr>
                                <tr>
                              <td><input type="checkbox" name="module_list[]" value="admission" class="module_list" id="admission">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Student Admission</b></td>
                              <td><input type="checkbox" name="module_list[]" value="search_student" class="module_list" id="search_student">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Search Student</b></td>
                               <td><input type="checkbox" name="module_list[]" value="parent" class="module_list" id="parent">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Parent</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="transport" class="module_list" id="transport">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Transport</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="hostel" class="module_list" id="hostel">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Hostel</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="library" class="module_list" id="library">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Library</b></td>
                              
                              </tr>
                                
                               <tr>
                               
                              <td><input type="checkbox" name="module_list[]" value="calender" class="module_list" id="calender">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Calender</b></td>
                             
                              <td><input type="checkbox" name="module_list[]" value="account" class="module_list" id="account">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Account/Finance</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="attendance" class="module_list" id="attendance">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Attendance</b></td>
                                
                              <td><input type="checkbox" name="module_list[]" value="time_table" class="module_list" id="time_table">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Time Table</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="examination" class="module_list" id="examination">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Examination</b></td>
                                
                              <td><input type="checkbox" name="module_list[]" value="report" class="module_list" id="report">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Report</b></td>
                              </tr>
                                
                               
                              <tr>
                              <td><input type="checkbox" name="module_list[]" value="manage_admin" class="module_list" id="manage_admin">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Manage Admin</b></td>
                             
                              <td><input type="checkbox" name="module_list[]" value="visitor_management" class="module_list" id="visitor_management">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Visitor Management</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="telephone_diary" class="module_list" id="telephone_diary">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Telephone Diary</b></td>
                                
                              <td><input type="checkbox" name="module_list[]" value="online_support" class="module_list" id="online_support">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Online Support</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="sms_module" class="module_list" id="sms_module">
                              </td>
                              <td><b>:</b></td>
                              <td><b>SMS (Phone/Email)</b></td>
                                
                              <td><input type="checkbox" name="module_list[]" value="hr" class="module_list" id="hr">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Human Resource</b></td>
                              </tr>
                                
                                
                                <tr>
                               <td><input type="checkbox" name="module_list[]" value="assignment" class="module_list" id="assignment">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Assignment</b></td> 
                              
                               <td><input type="checkbox" name="module_list[]" value="notice" class="module_list" id="notice">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Notice</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="health_card" class="module_list" id="health_card">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Health Card</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="event" class="module_list" id="event">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Event</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="inventory" class="module_list" id="inventory">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Inventory</b></td>
                              
                               <td><input type="checkbox" name="module_list[]" value="media" class="module_list" id="media">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Media</b></td>
                              
                               
                                </tr>
                                
                                <tr>
                              <td><input type="checkbox" name="module_list[]" value="data_import_export" class="module_list" id="data_import_export">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Data Import/Export</b></td>
                              
                               <td><input type="checkbox" name="module_list[]" value="academic" class="module_list" id="academic">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Academic</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="alumni" class="module_list" id="alumni">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Alumni</b></td>
                              
                               <td><input type="checkbox" name="module_list[]" value="achievement" class="module_list" id="achievement">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Achievement</b></td>
                              
                               <td><input type="checkbox" name="module_list[]" value="news" class="module_list" id="news">
                              </td>
                              <td><b>:</b></td>
                              <td><b>News</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="study_material" class="module_list" id="study_material">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Study Material</b></td>
                                </tr>
                                <tr>
                              
                                    <td><input type="checkbox" class="module_list" disabled checked>
                                        <input type="text" name="module_list[]" style=" display:none; " value="system_setting" class="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>System Setting</b></td>
                                </tr>
                                
                                </table>  
                                    </td>
                                </tr>
                                <tr>
                                    <td style=" height:5px; "></td>  
                                </tr>
                                <tr>
                                    <td  colspan="30">
                                        <div class="verticle_lines" style=" background-color:black; margin-left:0; padding-left:0; float:left;    "></div>  
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input class="save_button" name="submit_module_button" id="save_button" type="submit" value="Update">
                                    </td>
                                </tr>
                            </table>
                    
                    
                    <script type="text/javascript">
                    function page_load()
                    {
                    var module_list="<?php echo $module_list;?>";
                    var my_arr=module_list.split(",");
                  
                    var array_length=my_arr.length;
                    
                   for(var i=0;i<array_length;i++)
                   {
                   if(document.getElementById(my_arr[i]))
                   {
                   document.getElementById(my_arr[i]).checked=true;    
                   }  
                    }
                    }
                    </script>
                    
                    
                    <?php
                    }    
                    }
                    
                    ?>
                    
               </div>      
              </div> 
        </div>
        </div>
        </form>
        
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