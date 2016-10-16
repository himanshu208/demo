<?php 
session_start(); 
ob_start();
?>
<?php 
require_once 'connection.php';
if(isset($_SESSION['admin_session_on']))
{
$user_unique_id=$_SESSION['admin_session_on'];
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
    
$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {

  $fetch_school_name=$fetch_branch_data['branch_name'];
  
 $school_session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
 $fetch_school_session_data=mysql_fetch_array($school_session_db);
 $fetch_school_num_rows=mysql_num_rows($school_session_db);
  if((!empty($fetch_school_session_data))&&($fetch_school_session_data!=null)&&($fetch_school_num_rows!=0))  
  {
 
 $course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'"); 
 $fetch_course_data=  mysql_fetch_array($course_db);
 $fetch_course_num_rows=  mysql_num_rows($course_db);
  if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))   
  {  
 
 $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
$fetch_section_data=mysql_fetch_array($section_db);
$fetch_section_num_rows=mysql_num_rows($section_db);
if((!empty($fetch_section_data))&&($fetch_section_data!=null)&&($fetch_section_num_rows!=0))
{    
  
    
  if(isset($_POST['submit_data_process']))
  {
      
 date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    
     
 $static_id="CATGRY";    
 $add_one_no=1;   
 $category_org_db=mysql_query("SELECT * FROM category_db WHERE id ORDER BY id DESC");
 $fetch_category_org_record=mysql_fetch_array($category_org_db);
 $fetch_category_num_rows=mysql_num_rows($category_org_db);
  if((!empty($fetch_category_org_record))&&($fetch_category_org_record!=null)&&($fetch_category_num_rows!=0))
  {
   $fetch_id=$fetch_category_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_category_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_category_id=$static_id."_".$add_one_no;   
  }
     
  $encrypt_id=md5(md5($final_category_id));  
      
      
      $category_name=$_POST['category_name'];
      $category_full_name=$_POST['category_full_name'];
      $description=$_POST['description'];
      if((!empty($category_name)))
      {
       $check_category_record=  mysql_query("SELECT * FROM category_db WHERE organization_id='$fetch_school_id'
               and branch_id='$fetch_branch_id' and category_id='$final_category_id'
           OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and category_name='$category_name'");
       $fetch_category_data= mysql_fetch_array($check_category_record);
       $fetch_category_num_rows=  mysql_num_rows($check_category_record);
      if((empty($fetch_category_data))&&($fetch_category_data==null)&&($fetch_category_num_rows==0))
      {
        
          $insert_category_db=  mysql_query("INSERT into category_db values('','$fetch_school_id','$fetch_branch_id'
                  ,'$final_category_id','$encrypt_id','$category_name','$category_full_name','$description','none'
                  ,'$date','$date_time','$user_unique_id','active')"); 
          
         if($insert_category_db)
         {
          $message_show="Record save successfully complete";   
         }else
      {
          $message_show="Request failed,please try again";  
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
    
    
    
 if(isset($_POST['next_page']))
 {
  header("Location:finish_page.php");   
 }
 
 
 
{
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Dashboard</title>
        <script type="text/javascript" src="javascript/jquery-1.7.2.min.js"></script>
         <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
   <script type="text/javascript">
 function org_validate()
 {
     var category_name=document.getElementById("category_name").value;
     
     if(category_name==0)
         {
             alert("Please enter category name");
             document.getElementById("category_name").focus();
             return false;
         }
     else
             {
                   document.getElementById("ajax_loader_show").style.display="block";    
                  
             }
             
 }
</script>


    </head>
    <body>
        <?php 
include_once 'ajax_loader_page.php';
      ?>
     <div id="include_header_page">
       <?php 
            include_once 'header_page.php';
         ?>
     </div>
       
         <form action="" method="post" enctype="multipart/form-data">
       
         <div id="main_work_div">
             <div id="main_middle_work_div">
                 <div class="forward_step">
            <table cellspacing="0" cellpadding="0" id="full_width_table">
                <tr>
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                     <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color" class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div  class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                </tr>
                <tr>
                    <td colspan="3" class="heading_short_forward">
                   Manage Session Year 
                    </td>
                    <td colspan="3" class="heading_short_forward">
                   Manage Course/Class  
                    </td>
                    <td colspan="3" class="heading_short_forward">
                   Manage Section 
                    </td>
                    
                    <td colspan="3" id="color_set_page" class="heading_short_forward">
                   Manage Category 
                    </td>
                    
                      <td colspan="3"  class="heading_short_forward">
                   Finish Page
                    </td>
                </tr>
                
                
            </table>
        </div>
               <table cellspacing="2" cellpadding="2" id="org_table_style" style=" width:45%;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
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
                   
                   
                    <tr><td><b>Category Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="category_name" 
                                   placeholder="Enter category name" class="text_box_org"
                                   name="category_name"></td>
                    </tr>
                    
                    <tr><td><b>Category Full Name</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="section_name" 
                                   placeholder="Enter category full name" class="text_box_org"
                                   name="category_full_name"></td>
                    </tr>
                    
                    <tr>
                        <td><b>Description</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
                     
                    
                    
                     <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();" id="save_button"  value="Save">   
                        </td>
                    </tr>
               </table>
                 
                 
               <?php 
                $section_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$fetch_school_id'"
                        . " and branch_id='$fetch_branch_id' and is_delete='none'");
                $fetch_section_num_rows=  mysql_num_rows($section_db); 
                if($fetch_section_num_rows!=0)
                {
                    
                {
                 ?>
                 
                 
                 <div id="horizental_line"></div>
                 <table cellspacing="0" cellpadding="0" id="course_table_list">
                     <tr>
                         <td colspan="6"><b>Category list</b></td>
                     </tr>
                     <tr>
                         <td colspan="6">
                             <div class="verticle_line"></div>
                         </td>
                     </tr>
                     <tr>
                         <td style=" height:3px; "></td>
                     </tr>
                     <tr>
                         <td class="td_heading">Sl.No</td>
                         <td class="td_heading">Category Name</td>
                         <td class="td_heading">Category Full Name</td>
                          <td class="td_heading" style=" border-right:1px solid gray;">Description</td>
                        
                     </tr>
                   <?php 
                    $row=1;
while ($fetch_section_data=mysql_fetch_array($section_db))
{
  $fetch_cat_name=$fetch_section_data['category_name'];
  $fetch_cat_full_name=$fetch_section_data['category_full_name'];
  $fetch_category_description=$fetch_section_data['description'];
 

  
  echo "<tr>
<td class='td_value_heading'><b>$row</b></td>  
<td class='td_value_heading'>$fetch_cat_name</td>
  <td class='td_value_heading'>$fetch_cat_full_name</td>
<td class='td_value_heading' style=' border-right:1px solid gray;'>$fetch_category_description</td>
</tr>";
  $row++;
}
                     ?>
                     
                     
                     
                 </table>
               <?php 
                }
                }
                 ?>
                 
               <?php 
                 if($fetch_section_num_rows!=0)
                {
                    
                {
                 ?>
                 <div class="next_button_show">
                 <input type="submit" class="next_button_styling" name="next_page" value="Next">
                 </div>
               <?php 
}
  }
                 ?>
                 
                 
                 
             </div>
         </div>
         </form>
        <div id="include_fotter_page">
          <?php 
             include_once 'superadmin/fotter_page.php';
            ?>
        </div>
    </body>
</html>
<?php 
}
}else
 {
 header("Location:add_section.php");   
 }


}else
 {
 header("Location:add_course.php");   
 }

}else
 {
 header("Location:add_session.php");   
 }

 }else
 {
 header("Location:loginPage.php");   
 }
 
 
 }else
{
     header("Location:loginPage.php");
}


}else
{
    header("Location:loginPage.php");
}

}else
{
     header("Location:loginPage.php");
}

?>