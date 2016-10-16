<?php
//SESSION CONFIGURATION
$check_array_in="report";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Report</title>
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
                           <td>Report</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Report</b></div>
                    <div class="Short_menu_show"><b>Notification</b></div></div>
               
                     <a href="student_allocate_transport.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Course/Class Report</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>All Student List</span></td>
                        </tr>
                    </table>
               </div> </a>
                    
                <a href="student_allocate_transport.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Section/Batch Report</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>All Student List</span></td>
                        </tr>
                    </table>
               </div> </a>
               
               
               <a href="student_allocate_transport.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Academic Session Report</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>All Student List</span></td>
                        </tr>
                    </table>
               </div> </a>
               
               
               
               <a href="student_allocate_transport.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Student Report</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>All Student List</span></td>
                        </tr>
                    </table>
               </div> </a>
               
               <a href="student_allocate_list.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Employee Report</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>All employee report</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                
               <a href="view_route_in_vehicle_details.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Attendance Report</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>All attendance report</span></td>
                        </tr>
                 </table>
                </div></a> 
                
                
               <a href="view_vehicle_details.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Certificate</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Search student allocate transport</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                
               <a border="0" href="transport_system_setting.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Student Pay Slip</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Search student allocate transport</span></td>
                        </tr>
                 </table>
                </div></a>
               
               <a border="0" href="transport_system_setting.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Student Due Fees</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Search student allocate transport</span></td>
                        </tr>
                 </table>
                </div></a>
               
               
               <a border="0" href="transport_system_setting.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Sms & Email Report</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Search student allocate transport</span></td>
                        </tr>
                 </table>
                </div></a>
               
               
                <a border="0" href="transport_system_setting.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Log Activity Report</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Search student allocate transport</span></td>
                        </tr>
                 </table>
                </div></a>
                
                
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