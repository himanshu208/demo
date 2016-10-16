<?php
//SESSION CONFIGURATION
$check_array_in="transport";
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
                           <td>Transport</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Transport</b></div>
                    </div>
               
               <a href="student_allocate_transport.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Allotment New Student</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Allotment Transport Service New Student</span></td>
                        </tr>
                    </table>
               </div> </a>
               
               <a href="student_allocate_list.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Allotment Student List</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Transport service allotment student list</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                
               <a href="view_route_in_vehicle_details.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Route Details</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>List of all Route</span></td>
                        </tr>
                 </table>
                </div></a> 
                
                
               <a href="view_vehicle_details.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Vehicle Details</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>List of all vehicle</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                
               <a border="0" href="transport_system_setting.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Transport Setting</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manege Transport Setting</span></td>
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