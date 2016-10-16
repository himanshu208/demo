<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
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
$update_db_unique_id=$_POST['update_unique_id'];
  
 if((!empty($category))&&(!empty($insert_session_id))&&(!empty($insert_session_id)))
 {
  
 $select_match_route_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and lib_category_unique_id!='$update_db_unique_id' and category='$category'"
         . " and is_delete='none'"); 
 $fetch_route_data=mysql_fetch_array($select_match_route_db);
 $fetch_route_num_rows=mysql_num_rows($select_match_route_db);
    if((empty($fetch_route_data))&&($fetch_route_data==null)&&($fetch_route_num_rows==0)) 
    {
    
        $update_db=  mysql_query("UPDATE library_category_db SET category='$category',issue_student='$student_issue'"
                . ",issue_employee='$employee_issue',max_limit='$maximum_issue',return_day='$return_day'"
                . ",fine='$fine',position='$position',description='$description' WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and lib_category_unique_id='$update_db_unique_id' and "
                . "is_delete='none'");
        if((!empty($update_db))&&($update_db)) 
    {
      $message_show="<div class='notification_alert_show' style='color:green;'>Record update successfully complete.</div>";   
    }else
    {
    $message_show="<div class='notification_alert_show'>Request failed,please try again</div>";     
    }
        
        
    }else $message_show="<div class='notification_alert_show'>Record already exist in database.</div>"; 
     
     
 }else $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
  
 
require_once '../pop_up.php';
 
}


?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Category Details</title>
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
        
        <script type="text/javascript">
    window.onload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
   
   function close_pop_up_this()
   {
   window.close();    
   }
   
</script>


        <script type="text/javascript">
            function ok_close()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    }
};
            
            </script>
            
             <script type="text/javascript">
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Category Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                
                <?php
                if(!empty($_REQUEST['token_id']))
                {
                $token_id=$_REQUEST['token_id'];
                
                $select_edit_data_db=mysql_query("SELECT * FROM library_category_db WHERE encrypt_id='$token_id' and is_delete='none'");
                $fetch_data=mysql_fetch_array($select_edit_data_db);
                $fetch_num_data=mysql_num_rows($select_edit_data_db);
                if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_data!=0))
                {
                    
                 $issue_student=$fetch_data['issue_student'];
                 if($issue_student=="yes")
                 {
                   $issue_student="checked";  
                 }else
                 {
                   $issue_student="";  
                 }
                 $issue_employee=$fetch_data['issue_employee'];
                 if($issue_employee=="yes")
                 {
                  $issue_employee="checked";   
                 }else
                 {
                 $issue_employee="";    
                 }
                 
                 
                 //max issue limit
                 $max_limit=$fetch_data['max_limit'];
                 
                 if($max_limit==0)
                 {
                   $no_require="selected"; 
                   $infiniate="";
                 }else
                     if($max_limit=="infinite")
                     {
                     $infiniate="selected";  
                     $no_require="";
                     }else
                     {
                    $infiniate="";  
                     $no_require="";     
                     }
                     
                 //return days
                   
                $return_day=$fetch_data['return_day'];
                 
                 if($return_day==0)
                 {
                   $retu_no_require="selected"; 
                   $retu_infiniate="";
                 }else
                     if($return_day=="infinite")
                     {
                     $retu_infiniate="selected";  
                     $retu_no_require="";
                     }  else {
                        $retu_infiniate="";  
                     $retu_no_require="";  
                     }
                     
                     
                     $fine=$fetch_data['fine'];
                     $position=$fetch_data['position'];
                     $description=$fetch_data['description'];
                    $session_id=$fetch_data['session_id'];
                     
                {
                ?>
                
                <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $fetch_data[4];?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $session_id;?>">   
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
                       <td><input type="text" value="<?php echo $fetch_data[6];?>" id="category" name="category" placeholder="Please enter category"
                                  class="text_box_class"></td>
                       </tr>
                       <tr>
                           <td><b>Issuable</b></td>
                       <td><b>:</b></td>
                       <td>
                           <table style=" float:left; ">
                               <tr>
                                   <td><input type="checkbox" name="student_issue" value="yes" <?php echo $issue_student;?>></td><td>Student</td>
                                   <td><input type="checkbox" name="employee_issue" value="yes" <?php echo $issue_employee;?>></td><td>Employee</td>
                               </tr>   
                           </table>
                       </td>
                       </tr>
                      
                      
                       <tr>
                           <td><b>Maximum Issue Limit</b></td>
                       <td><b>:</b></td>
                       <td>
                           <select id="maximum_issue_limit" name="maximum_issue_limit" class="select_class">
                               <option value="0" <?php echo $no_require;?>>No Require</option>
                               <?php
                               for($i=1;$i<=12;$i++)
                               {
                                 if($max_limit==$i)
                                 {
                               ?>
                               <option value="<?php echo $i;?>" selected><?php echo $i;?></option>
                               <?php
                                 }else
                                 {
                                   ?>
                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                               
                               <?php
                                 }
                               }
                               ?>
                                <option value="infinite" <?php echo $infiniate;?>>Infinite</option>
                           </select>
                       </td>
                       </tr>
                       
                        <tr>
                           <td><b>Return Days</b></td>
                       <td><b>:</b></td>
                       <td><select name="return_day" class="select_class">
                               <option value="0" <?php echo $retu_no_require;?>>No Require</option>
                               <?php
                               for($i=1;$i<=30;$i++)
                               {
                                if($return_day==$i)
                                {
                               ?>
                               <option value="<?php echo $i;?>" selected><?php echo $i;?> day</option>
                               <?php
                                }else
                                {
                                  ?>
                                 <option value="<?php echo $i;?>"><?php echo $i;?> day</option>
                              
                               <?php
                                }
                               }
                               ?>
                               <option value="infinite" <?php echo $retu_infiniate;?>>Infinite</option>
                           </select></td>
                       </tr>
                       
                        <tr>
                           <td><b>Fine per day</b></td>
                       <td><b>:</b></td>
                       <td><b><?php echo $fetch_currency;?></b> <input type="text" id="fine" onkeypress="javascript:return isNumber (event)" autocomplete="off" name="fine"
                                                                       style=" width:30%; text-align:right;  " value="<?php echo $fine;?>" class="text_box_class">/-</td>
                       </tr>
                       
                         <tr>
                       <td><b>Position</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="library_position" name="library_position"
                                     placeholder="Enter position" class="text_area_class"><?php echo $position;?></textarea></td>
                       </tr>
                       
                       <tr>
                       <td><b>Description</b></td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"><?php echo $description;?></textarea></td>
                       </tr>
                       
                       <tr>
                           <td colspan="3">
                               <input type="submit" class="submit_process" style=" margin-right:0px; "
                                      name="submit_process" value="Update"> 
                               
                               <input type="reset" class="reset_process" style=" margin-right:20px; " name="reset_process" value="Reset">
                               
                               
                           </td>
                       </tr>
                   </table>  
            <?php
                }
                }
                }
            ?>
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By : DIGI SHIKSHA</div>
            
            
        </div>
       </form>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>