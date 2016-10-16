<?php
//SESSION CONFIGURATION
$check_array_in="data_import_export";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Data Import</title>
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
                           <td><a href="import_export_dashboard.php">Data Import/Export</a></td>
                           <td>/</td>
                           <td>Data Import</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Data Import</b></div>
                </div>
               
             
               <div class="main_work_data" style=" padding-top:20px;">
                   <div id="calander_show">
                   
                       <div class="center_div_tag">
                         
                           <h3 style=" color:red; ">Instructions for importing Students and Teachers into your Application:</h3>   
                           <div class="horizental_line" style=" background-color:black; height:2px;   margin-top: 0;"></div>
                          <br/>
                           <p>1. Prepare the CSV file that contains the Student or Teacher information you need to import</p>
                           <p>(Please take care of spelling errors and that the correct information is entered into the correct columns.)</p>
                      <br/>
                      <br/>
                        <br/>
                      <p>
                          a. Download or open the appropriate sample CSV file: <a style=" color:blue; "><b>Student Import</b></a> 
                          and   <a style=" color:blue; "><b>Teacher Import</b></a>  <br/>
b. Now capture the information to be imported as indicated in the CSV file  <br/>
c. Save the file to your computer as a comma delimited CVS file - just follow the prompts as given by Excel.    <br/> 
                      </p>
                      
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                     
                      <p>2. Now click on "Select CSV File". Browse to the just saved document (csv file) and select it. Click on "Open"</p>
                       
                       <br/>
                      <br/>
                      
                       
                      <p>3. Ensure that the first field - "Fields Delimiter" is set as a ";" and that the correct import mode is selected ("Students Details" or "Teacher Details")</p>
                        <br/>
                      <br/>
                      <p>4. Click on "Next"</p>
                      <br/>
                      <br/>
                      <p>5. Now match the fields on the right (from the csv file) with the fields on the left (from the database). Do not rush. Ensure no mismatches are made!</p>
                       <br/>
                      <br/>
                      
                      <p>6. Click on "Import". </p>
                       </div>   
                       
                       
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