<?php
//SESSION CONFIGURATION
$check_array_in="time_table";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Time Table</title>
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
                           <td>Time Table</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Time Table</b></div></div>
                
                    
                <a href="view_time_table.php"><div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>View Time Table</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>View Class & Batch Wise Time Table</span></td>
                        </tr>
                    </table>
                   </div> </a>    
                    
                    
                    
                <a href="view_full_time_table.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>View Full Time Table</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>View Full Time Table</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                
                <a href="view_teacher_time_table.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>View Teachers Time Table</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>View Teachers Wise Time Table</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                <a href="search_proxy.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Search Proxy</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Proxy Teachers Available List</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                
                <a href="teacher_working_hour.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Teacher Working Hours</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>All Teacher Working Hours</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                
                <a href="create_time_table.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Set/Create Time Table</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Time Table For Class & Section</span></td>
                        </tr>
                    </table>
                </div></a> 
                
                
                <a href="active_time_table.php">   
                <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Active Time Table</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Active Time Table For Class & Batch</span></td>
                        </tr>
                    </table>
                </div></a> 
               
                <a href="time_table_setting.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Time Table Setting</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Time Table Setting</span></td>
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