<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>


<?php 
//insert library category values

$message_show="";
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
if(isset($_POST['submit_process']))
{
 $category=$_POST['category'];
       if(!empty($_POST['student_issue']))
       {
         $student_issue=$_POST['student_issue'];  
       }  else {
        $student_issue="no";   
       }
       
       if(!empty($_POST['employee_issue']))
       {
         $employee_issue=$_POST['employee_issue'];  
       }  else {
        $employee_issue="no";   
       }
       
               $maximum_issue=$_POST['maximum_issue_limit'];
               $return_day=$_POST['return_day'];
               $fine=$_POST['fine'];
               $position=$_POST['library_position'];
               $description=$_POST['description'];
               $insert_session_id=$_POST['use_inset_session_id'];
  
 
$result=mysql_query("SHOW TABLE STATUS LIKE 'library_category_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="LIB_CATG_$nextId"; 
$encrypt_id=md5(md5($final_db_id));

  
 if((!empty($category))&&(!empty($final_db_id))&&(!empty($insert_session_id)))
 {
  
 $select_match_route_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and category='$category'"
         . " and is_delete='none'"); 
 $fetch_route_data=mysql_fetch_array($select_match_route_db);
 $fetch_route_num_rows=mysql_num_rows($select_match_route_db);
    if((empty($fetch_route_data))&&($fetch_route_data==null)&&($fetch_route_num_rows==0)) 
    {
     
     $insert_db=mysql_query("INSERT into library_category_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'
         ,'$final_db_id','$encrypt_id','$category','$student_issue','$employee_issue','$maximum_issue','$return_day'"
             . ",'$fine','$position','$description','none','$date','$date_time','$user_unique_id')");
    if((!empty($insert_db))&&($insert_db)) 
    {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record save successfully complete.</div>";   
    }else
    {
    $message_show="<div class='notification_alert_show'>Request failed,please try again</div>";     
    }
        
        
    }else $message_show="<div class='notification_alert_show'>Record already exist in database.</div>"; 
     
     
 }else $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
  
 
require_once '../pop_up.php';
 
}


?>





<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Library Category</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validate_form() 
        {
         var category=document.getElementById("category").value;
         if(category==0)
         {
          alert("Please enter category");
          document.getElementById("category").focus();
          return false;
         }else
         {
          document.getElementById("ajax_loader_show").style.display="block";   
         }
        }
        </script>
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" name="myForm" onsubmit="return validate_form()" method="post" enctype="multipart/form-data">
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="library.php">Library</a></td>
                           <td>/</td>
                           <td><a href="library_setting.php">Library Setting</a></td>
                           <td>/</td>
                           <td>Add New Library Category</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Library Category</b></div>
                    <a href="view_category_list.php">
                        <div class="view_button">View Library Category Details</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   <table cellsapcing="4" cellpadding="4" class="table_middle" style=" font-size:12px; ">
                       <tr>
                           <td><span style=" display:none; "><?php echo $message_show;?></span></td>
                       </tr>
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                       
                       <tr>
                           <td><br/></td>
                       </tr>
                      <tr>
                          <td><b>Category <sup>*</sup></b></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="category" name="category" placeholder="Please enter category"
                                  class="text_box_class"></td>
                       </tr>
                       <tr>
                           <td><b>Issuable</b></td>
                       <td><b>:</b></td>
                       <td>
                           <table>
                               <tr>
                                   <td><input type="checkbox" name="student_issue" value="yes" checked></td><td>Student</td>
                                   <td><input type="checkbox" name="employee_issue" value="yes" checked></td><td>Employee</td>
                               </tr>   
                           </table>
                       </td>
                       </tr>
                      
                      
                       <tr>
                           <td><b>Maximum Issue Limit</b></td>
                       <td><b>:</b></td>
                       <td>
                           <select id="maximum_issue_limit" name="maximum_issue_limit" class="select_class">
                               <option value="0">No Require</option>
                               <?php
                               for($i=1;$i<=12;$i++)
                               {
                               ?>
                               <option value="<?php echo $i;?>"><?php echo $i;?></option>
                               <?php
                               }
                               ?>
                               <option value="0">Infinite</option>
                           </select>
                       </td>
                       </tr>
                       
                        <tr>
                           <td><b>Return Days</b></td>
                       <td><b>:</b></td>
                       <td><select name="return_day" class="select_class">
                               <option value="0">No Require</option>
                               <?php
                               for($i=1;$i<=30;$i++)
                               {
                               ?>
                               <option value="<?php echo $i;?>"><?php echo $i;?> day</option>
                               <?php
                               }
                               ?>
                               <option value="0">Infinite</option>
                           </select></td>
                       </tr>
                       
                        <tr>
                           <td><b>Fine per day</b></td>
                       <td><b>:</b></td>
                       <td><b><?php echo $fetch_currency;?></b> <input type="text" id="fine" onkeypress="javascript:return isNumber (event)" autocomplete="off" name="fine"
style=" width:30%; text-align:right;  " value="0" class="text_box_class">/-</td>
                       </tr>
                       
                         <tr>
                       <td><b>Position</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="library_position" name="library_position"
                                     placeholder="Enter position" class="text_area_class"></textarea></td>
                       </tr>
                       
                       <tr>
                       <td><b>Description</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                               <input type="submit" class="submit_process" style=" margin-right:0px; " name="submit_process" value="Save"> 
                               
                               <input type="reset" class="reset_process" style=" margin-right:20px; " name="reset_process" value="Reset">
                               
                               
                           </td>
                       </tr>
                   </table>    
                   
               </div>
                
             
                
                
               
            </div> 
        </div>
        
        
        <div id="include_fotter_page">
       <?php require_once '../fotter/fotter_page.php'; ?>   
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>