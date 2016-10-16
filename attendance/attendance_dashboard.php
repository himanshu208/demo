<?php
//SESSION CONFIGURATION
$check_array_in="attendance";
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
                           <td>Attendance</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Attendance</b></div></div>
                
                    
               <a href="mark_attendance.php"><div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Mark Attendance</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Mark Attendance</span></td>
                        </tr>
                    </table>
                   </div> </a>    
                    
                    
                    
               <a href="attendance_report.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Attendance Report</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>View Attendance Report</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                
                <a href="attendance_register.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Attendance Register</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>View Attendance Register</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                
                <a href="modify_attedance.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Edit/Modify Attendance</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Edit/Modify Attendance</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                
                <a href="send_attendance_sms.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Attendance Send SMS</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Absent/Leave Attendance Send SMS</span></td>
                        </tr>
                    </table>
                </div></a> 
               
               <a href="attendance_setting.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Attendance Setting</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Attendance setting</span></td>
                        </tr>
                    </table>
               </div> </a>
               
               
                
               
               
             
               
              
              
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