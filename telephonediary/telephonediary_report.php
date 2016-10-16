<?php
//SESSION CONFIGURATION
$check_array_in="telephone_diary";
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
                           <td>Telephone Diary</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Telephone Diary</b></div>
                    <a href="list_of_contact.php">
                        <div class="view_button">Manage Contact</div></a>
                </div>
                
                
               <div id="main_work_div">
                   <div id="div_search_top">
                   <table class="table_search_middle">
                       <tr>
                           <td colspan="4">
                            <table class="table_top_telephone_diary">
                                <tr>
                                    <td><input class="radio_check" type="radio" name="all_user" value="all" checked></td>
                                    <td>All</td>
                                    
                                    <td><input class="radio_check" type="radio" name="all_user" value="student"></td>
                                    <td>Student</td>
                                    
                                     <td><input class="radio_check" type="radio" name="all_user" value="parent"></td>
                                    <td>Parent</td>
                                    
                                    <td><input class="radio_check" type="radio" name="all_user" value="employee"></td>
                                    <td>Employee/Teachers</td>
                                    
                                    <td><input class="radio_check" type="radio" name="all_user" value="contact"></td>
                                    <td>Contact</td>
                                </tr>
                            </table>
                         </td>
                       </tr>
                       <tr>
                           <td style=" height:15px; "></td>
                       </tr>
                       <tr>
                                    <td><b>Search</b></td>
                                    <td><b>:</b></td>
                                    <td style=" width:10px; "></td>
                                    <td><input placeholder="Enter Student/Teacher/Person Name OR Mobile No." class="search_text_style_box" type="text"></td>
                                    <td><input type="button" class="button_styling_telephone" value="Search"></td>         
                       </tr>
                   </table> 
                   </div>
                   <div class="border_bottom_line"></div>       
                   
                   <div id="telephone_data">
                       <table cellspacing='0' cellpadding='0' id='time_table_report'>
                           <tr class="tr_style_css">
                               <td>Sl.No.</td>
                               <td>User</td>
                                <td>Name</td>
                                 <td>Class - Section</td>
                                  <td>Department/Organization</td>
                                  <td>Mobile Number</td>
                                  <td>Email Id</td>
                           </tr>
                       </table>
                   </div>   
                   
               </div>
               
               
                
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