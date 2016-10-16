<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td>System Setting</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>System Setting</b></div>
                 </div>
                
                    
               <a href="branch_detail.php">
               <div class="small_dashboard">
               <table class="small_short_table">
                        <tr>
                            <td>Branch Details</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>View And Edit Branch Details</span></td>
                        </tr>
                   </table>
                   </div>
               </a>    
                    
               <a href="backup_list.php">
                <div style="display:none;" class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Backup/Restore</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Complete Database Backup</span></td>
                        </tr>
                 </table>
                </div></a> 
               
               
               <a href="module.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Modules</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Modules</span></td>
                        </tr>
                 </table>
                </div></a> 
               
               
               <a href="../manage_admin/manage_admin.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Manage Admim/User</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage/Create User Roles</span></td>
                        </tr>
                 </table>
                </div></a> 
               
               
               <a href="../calender/calender_report.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Annual Holiday</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Annual Holiday</span></td>
                        </tr>
                 </table>
                </div></a> 
               
             
               
               
               
               <a href="../timetable/default_weekdays.php">
                <div style="display:none;" class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Default Weekdays</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Default School Weekdays</span></td>
                        </tr>
                 </table>
                </div></a> 
               
               
           
               
               <a href="../sms/manage_template.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>SMS/Email Template</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage SMS/Email Template</span></td>
                        </tr>
                 </table>
                </div> 
            </a>
               
               
               <a href="term_and_condition.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>School Term & Condition</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage School Term & Condition</span></td>
                        </tr>
                 </table>
                </div> 
            </a>
               
               <a href="rule.php">
                <div style="display:none;" class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>School Rule</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Mange School Rule</span></td>
                        </tr>
                 </table>
                </div> 
            </a>
               
                  
               <a href="my_profile.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>My Profile</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>View & Edit My Profile</span></td>
                        </tr>
                 </table>
                </div> 
            </a>
               
               <a href="change_password.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Change Password</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Create New Password</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
              
               
                 
                <a href="help.php">
                <div style="display:none;" class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Help</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>User Guide</span></td>
                        </tr>
                 </table>
                </div> 
            </a>
               
               
            </div> 
        </div>
        
        
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