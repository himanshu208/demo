<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Library</title>
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
                           <td>Library</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Library</b></div>
                    <div class="Short_menu_show"><b>Notification</b></div></div>
               
               <a href="student_account.php">
               <div class="small_dashboard">
                    <table class="small_short_table">
                        <tr>
                            <td>Student Account</td>
                        </tr>
                        <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Student account</span></td>
                        </tr>
                    </table>
               </div>
               </a>
               
               <a href="issue.php">
                 <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Issue Book</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Issue New Book</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                
               <a href="renewal_return.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Return & Renewal Book</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Return & Renewal Book</span></td>
                        </tr>
                 </table>
                </div></a> 
                
               <a href="out_date_return.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Out Date Book Return</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Out Date Return Book</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                
               <a href="view_book_list.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Book</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Add New Book OR View Book list</span></td>
                        </tr>
                 </table>
                </div> 
               </a>
                
               <a href="due_fine.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Due Fine</td>
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
               
               <a border="0" href="library_id.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Library ID Card</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Generate Library ID Card</span></td>
                        </tr>
                 </table>
                </div></a> 
               
               <a border="0" href="library_setting.php">
                <div class="small_dashboard">
                 
                 <table class="small_short_table">
                     <tr>
                         <td>Library Setting</td>
                     </tr>
                      <tr>
                            <td><div class="small_verticle_line"></div></td>
                        </tr>
                        <tr>
                            <td><span>Manage Library Setting</span></td>
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