<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<html>
    <head>
        
        <title>Student Account</title>
        <script type="text/javascript">
 function validateForm()
 {
  var library_author=document.getElementById("author").value;  
  if(library_author==0)
  {
     alert("Please enter author");
     document.getElementById("author").focus();
     return false;
  }
             
 }
</script>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        
    <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    <body>
      
        <?php  include_once '../ajax_loader_page_second.php';?>
        
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div>
        
        <form action="#" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="library.php">Library</a></td>
                           <td>/</td>
                           <td>Student Account</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
               <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Student Account</b></div>
               </div> 
               <div class="main_work_data" style=" padding-top:20px; ">
               <?php
                   require_once 'search_link_up.php';
               ?> 
                   
                  
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