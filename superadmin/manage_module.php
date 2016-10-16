<?php 
session_start(); 
ob_start();
?>
<?php 
$message_show="";
require_once '../connection.php';
if(isset($_SESSION['super_admin_session_on']))
{
$user_unique_id=$_SESSION['super_admin_session_on'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  
$organisation_db=mysql_query("SELECT * FROM organization_db  WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo=$fetch_org_data['school_logo'];
$fetch_school_name=$fetch_org_data['school_name'];
    
$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' ORDER BY id DESC");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {
   $fetch_branch_id=$fetch_branch_data['branch_id']; 
 $module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");    
  $fetch_module_date=mysql_fetch_array($module_db);
  $fetch_module_num_rows=mysql_num_rows($module_db);
  if((empty($fetch_module_date))&&($fetch_module_date==null)&&($fetch_module_num_rows==0))
  {
   
      
      if(isset($_POST['submit_module_button']))
      {
      $branch_id_insert=$_POST['branch_id'];
      if(!empty($_POST['module_list']))
      {
      $module_list=$_POST['module_list'];
      }else
      {
        $module_list=""; 
      }
     
      if((!empty($branch_id_insert))&&($module_list!=null))
      {
    
          date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

          
          
          
 $static_id="MODLE";    
 $add_one_no=1;   
 $module_org_db=mysql_query("SELECT * FROM module_db  WHERE id ORDER BY id DESC");
 $fetch_module_org_record=mysql_fetch_array($module_org_db);
 $fetch_module_num_rows=mysql_num_rows($module_org_db);
  if((!empty($fetch_module_org_record))&&($fetch_module_org_record!=null)&&($fetch_module_num_rows!=0))
  {
   $fetch_id=$fetch_module_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_module_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_module_id=$static_id."_".$add_one_no;   
  }
      
   $encrypt_id=md5(md5($final_module_id));       
      $implode_module_list=implode(",",$module_list);  
       
      $select_check_module_db=mysql_query("SELECT * FROM  module_db WHERE organization_id='$fetch_school_id' and branch_id='$branch_id_insert'");   
      $fetch_module_data_check=  mysql_fetch_array($select_check_module_db);   
      $fetch_module_num_rows_check=  mysql_num_rows($select_check_module_db);
      if((empty($fetch_module_data_check))&&($fetch_module_data_check==null)&&($fetch_module_num_rows_check==0))
      {
        $insert_module_data=mysql_query("INSERT into module_db values('','$fetch_school_id','$branch_id_insert'
                ,'$final_module_id','$encrypt_id','branch_head_admin','','$implode_module_list','','$date','$date_time','$user_unique_id','active')");  
      if($insert_module_data)
      {
       
          header("Location:user_admin.php");    
     
      }else
      {
         $message_show="Request failed,Please try again.";
      } 
        
      }else
      {
         $message_show="Record already exist in database.";
      } 
         
         
      }else
      {
         $message_show="Please fill all fields.";
      }
      
      
      
      }
      
      
      
      
      
      
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
         <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
     
        <title>Pixabyte Technologies Pvt. Ltd.</title>
    <script type="text/javascript">
     function org_validate(frm)
     {
         
var destCount=frm.elements['module_list[]'].length;
var destSel   = false;
for(i = 0; i < destCount; i++){
if(frm.elements['module_list[]'][i].checked){
destSel = true;
break;
}
}   
         var branch_id=document.getElementById("branch_name_id").value;
         
         if(branch_id==0)
             {
                alert("Please select branch");
                document.getElementById("branch_name_id").focus();
                return false;
             }else
 if(!destSel){
alert('Please select atleast one module');
return false;
}
             else
                 {
                      document.getElementById("ajax_loader_show").style.display="block";    
                   
                 }
     }
    </script>
    <script>
var checkflag = "false";
function check(field) {
  if (checkflag == "false") {
    for (i = 0; i < field.length; i++) {
      field[i].checked = true;
      
    }
    checkflag = "true";
    return "Uncheck All";
  } else {
    for (i = 0; i < field.length; i++) {
      field[i].checked = false;
    }
    checkflag = "false";
    return "Check All";
  }
}    
</script>
    
    </head>
    <body>
         <?php 
include_once '../ajax_loader_page_second.php';
      ?>
     <div id="include_header_page">
       <?php 
            include_once 'header_page.php';
         ?>   
        </div>
         <form action="" onsubmit="return org_validate(this);" method="post" enctype="multipart/form-data">
       
         <div id="main_work_div">
            <div id="main_middle_work_div">
                <table cellspacing="0" cellpadding="0" class="mange_first_module">
                    <tr>
                        <td> <div class="title_details"><b>Manage Branch Module</b></div></td>
                    </tr>
                    <tr>
                        <td>
                            <table cellspacing="4" cellpadding="4" class="module_list_table">
                                <tr>
                                    <td colspan="3">
                                  <?php 
                                    if(!empty($message_show))
                                    {
                                     echo "<div class='notification_alert'>$message_show</div>";       
                                    }
                                    ?>    
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Branch <sup>*</sup></b></td>
                                    <td><b>:</b></td>
                                    <td><select name="branch_id" id="branch_name_id" class="select_style">
                                           
                                      <?php 
                                        $fetch_branch_db=  mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id'");
                                        while ($fetch_branch_data_fetch=  mysql_fetch_array($fetch_branch_db))
                                        {  $fetch_branch_id_print=$fetch_branch_data_fetch['branch_id'];
                                          $fetch_branch_name=$fetch_branch_data_fetch['branch_name'];
                                          echo "<option value='$fetch_branch_id_print'>$fetch_branch_name</option>";
                                       
                                            
                                        }
                                        if(empty($fetch_branch_id_print))
                                        {
                                            echo "<option value=0''>Record no found !!</option>";  
                                        }
                                        ?>
                                        </select></td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                      <table style=" width:100%;  margin-left:20px; ">
                                          <tr>
                              <td><input type="checkbox" onClick="this.value=check(this.form.module_list)"  class="module_list" id="select_all">
                              </td>
                              <td><b>:</b></td>
                              <td><b>All Select</b></td>
                              
                              
                                </tr>
                                <tr>
                              <td><input type="checkbox" name="module_list[]" value="admission" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Admission</b></td>
                              <td><input type="checkbox" name="module_list[]" value="search_student" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Search Student</b></td>
                              
							  <td><input type="checkbox" name="module_list[]" value="parent" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Parents</b></td>
							  
                                </tr>
                               
                                
                                
                             
                                <tr>
                                   
                                    <td><input type="checkbox" name="module_list[]" value="transport" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Transport</b></td>
                              
							   <td><input type="checkbox" name="module_list[]" value="time_table" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Time Table</b></td>
                              
							   <td><input type="checkbox" name="module_list[]" value="attendance" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Attendance</b></td>
							  
							  
                            
                                </tr>
                                
                                <tr>
                              <td><input type="checkbox" name="module_list[]" value="account" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Account</b></td>
                               
							    <td><input type="checkbox" name="module_list[]" value="examination" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Examination</b></td>
							  
							  <td><input type="checkbox" name="module_list[]" value="hr" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Employee</b></td>
                            

							    </tr>
                                
                                <tr>
								 <td><input type="checkbox" name="module_list[]" value="manage_admin" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>User Management</b></td>
								
								 <td><input type="checkbox" name="module_list[]" value="visitor_management" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Visitor Management</b></td>
                              
								
                                    <td><input type="checkbox" name="module_list[]" value="calender" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>School Calender</b></td>
                             
                              
                             
                                </tr>
                                
                                
                               
                                <tr>
								<td><input type="checkbox" name="module_list[]" value="assignment" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Assignment</b></td> 
                              
                               <td><input type="checkbox" name="module_list[]" value="notice" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Notice</b></td>
                             
                              <td><input type="checkbox" name="module_list[]" value="report" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Report Center</b></td>
                              
                             
                                </tr>
                                
                             
                                
                                 <tr>
								  <td><input type="checkbox" name="module_list[]" value="telephone_diary" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Telephone Diary</b></td>
                            
								 
                              <td><input type="checkbox" name="module_list[]" value="online_support" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Online Support</b></td>
                              
                              <td><input type="checkbox" name="module_list[]" value="sms_module" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>SMS (Phone/Email)</b></td>
                                </tr>
                                
                                
                                <tr>
                                 <td><input type="checkbox" name="module_list[]" value="academic" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Academic</b></td>
                              
                             <td><input type="checkbox" name="module_list[]" value="event" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>Event</b></td>
                              
								
                              <td><input type="checkbox" name="module_list[]" value="system_setting" class="module_list" id="module_list">
                              </td>
                              <td><b>:</b></td>
                              <td><b>System Setting</b></td>
                                </tr>
                                
                                </table>  
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <input class="save_button" name="submit_module_button" id="save_button" type="submit" value="Next">
                                    </td>
                                </tr>
                            </table>   
                        </td>
                    </tr>
                </table>
            </div>
         </div>
         </form>
         <div id="include_fotter_page">
          <?php 
             include_once 'fotter_page.php';
            ?>
        </div>
    </body>
</html>
<?php 
}
}else
 {
 header("Location:branch_details.php");   
 }
 }else
 {
 header("Location:dashboard.php");   
 }
 }else
{
     header("Location:../organisation_details.php");
}
}else
{
    header("Location:../loginPage.php");
}

}else
{
     header("Location:../loginPage.php");
}

?>