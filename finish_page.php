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
  
  $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
  $fecth_category_data=  mysql_fetch_array($category_db);
  $fecth_category_num_rows=  mysql_num_rows($category_db);
   if((!empty($fecth_category_data))&&($fecth_category_data!=null)&&($fecth_category_num_rows!=0)) 
    
   {
 if(isset($_POST['finish_page']))
 {
  header("Location:dashboard.php");   
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
     <link rel="stylesheet" href="javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="javascript/calenderapi/ui/jquery.ui.widget.js"></script>

	<script src="javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="javascript/calenderapi/demos.css">
         <script type="text/javascript">
      
$(function() {
$("#from").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"images/calander.png",
      buttonImageOnly: true,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( );
      }
    });
    
    $("#to").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"images/calander.png",
      buttonImageOnly: true,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( );
      }
    });
    
    
</script>
<script type="text/javascript">
 function org_validate()
 {
     var category_name=document.getElementById("finish_check_box").checked;
     
     if(category_name==false)
         {
             alert("Please checked all term and condition");
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
       
         <form action="" method="post" onsubmit="return org_validate();" enctype="multipart/form-data">
       
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
                    <td style=" width:20px; "><div class="circle_div"></div></td>
                    <td><div class="verticle_new_line"></div></td>
                    
                    <td><div class="verticle_new_line"></div></td>
                    <td style=" width:20px; "><div id="circle_color" class="circle_div"></div></td>
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
                    
                    <td colspan="3" class="heading_short_forward">
                   Manage Category 
                    </td>
                    
                      <td colspan="3" id="color_set_page" class="heading_short_forward">
                   Finish Page
                    </td>
                </tr>
                
                
            </table>
        </div>
                 
               <table cellspacing="2" cellpadding="2" id="org_table_style" >
                   <tr>
                       <td>
                           <div id="term_condition_div">
                             
                           </div>
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <input type="checkbox" id="finish_check_box" class="check_box_styling"> <span><b>Accept all term & condition </b></span>  
                       </td>
                   </tr>
                   <tr>
                       <td>
                           <input type="submit" name="finish_page" class="save_button" value="Finish">
                       </td>
                   </tr>
               </table>
                 
           
               
                 
                 
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
 header("Location:add_category.php");   
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