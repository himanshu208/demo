<?php 
session_start(); 
ob_start();
?>

<?php 
require_once '../connection.php';
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
  $fetch_accout_type=$fetch_user_data['account_type'];
  $fecth_user_unique=$fetch_user_data['user_admin_id'];
$organisation_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo="../".$fetch_org_data['school_logo'];

$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {
$fetch_branch_unique_db_id=$fetch_branch_data['branch_id'];
$fetch_school_name=$fetch_branch_data['branch_name'];
 $fetch_branch_report_logo=$fetch_branch_data['report_logo'];

if($fetch_accout_type=="branch_head_admin")
{
 $manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_type='branch_head_admin'");   

}else
{
$manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_id='$user_unique_id'");   
}
$fetch_module_data=mysql_fetch_array($manage_module_db);
$fetch_module_num_rows=mysql_num_rows($manage_module_db);
 if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
 {
  $fetch_module_list=$fetch_module_data['module'];
  $explode_module_array=explode(",",$fetch_module_list);
  $check_array_in="search_student";
  $search_match_module= in_array($check_array_in,$explode_module_array);
  if($search_match_module==true)
  {
    
       $session__new_activate_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and by_defult='active'"); 
      $fecth_session_active_data=  mysql_fetch_array($session__new_activate_db);
      $fecth_session_num_rows=  mysql_num_rows($session__new_activate_db);
      if((!empty($fecth_session_active_data))&&($fecth_session_active_data!=null)&&($fecth_session_num_rows!=0))
      {
       $fecth_session_id_set_tmep=$fecth_session_active_data['session_id']; 
       
      }else
      {
       echo "<style>#session_not_active{ display:block; }</style>"; 
      }

if(isset($_SESSION['working_session_year']))
{
 $fecth_session_id_set=$_SESSION['working_session_year'];  
}else
{
  $fecth_session_id_set=$fecth_session_id_set_tmep; 
}
      
 {
  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href='../stylesheet/styleSheet.css'  rel='stylesheet' type='text/css' media='all'>
       
        <title>Student Details Print</title>
    </head>
    <body onload="window_print()">
        <div id="print_page_div">
      <?php 
     echo " 
                <table cellspacing='0' cellpadding='0' class='top_school_report_image'>
                    <tr>
                        <td><img border='0' style='width:100%;'  class='school_admission_image' src='../$fetch_branch_report_logo'></td>
                    </tr>
                </table>  ";
        ?>    
            <table cellspacing='0'  cellpadding='0' class='student_table_details'>
              <tr id='th_tr_style'>
                           <td><b>Sl.No</b></td>
                           <td><b>Admission No.</b></td>
                           <td><b>Sr.No.</b></td>
                           <td><b>Course/Class <B>-</B> Section</b></td>
                           <td><b>Session</b></td>
                           <td><b>Roll No.</b></td>
                           <td style='text-align:left;'><b>Student Name</b></td>
                           <td><b>Gender</b></td>
                           <td><b>Date Of Birth</b></td>
                           <td><b>Category</b></td>
                           <td><b>Father Name</b></td>
                           <td><b>Mobile No.</b></td>
                           <td><b>Status</b></td>
                       </tr>  
                
            <?php 
              if((!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['org_id']))
        &&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&($_REQUEST['page_no']))
{
   
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];
 $class_id=$_REQUEST['class_id'];
 
 
 $limit=$_REQUEST['page_no'];  
 
 if(!empty($limit))
 {
  if($limit=="all")
  {
   $limit_search="";      
  }else
  {
     $limit_search="LIMIT $limit";    
  }
     
 }else
 {
 $limit_search="";    
 }
 
 
 
 $student_db=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and action='active' $limit_search");
 }else
     if((!empty($_REQUEST['temp_class_id']))&&(!empty($_REQUEST['temp_section_id']))&&(!empty($_REQUEST['org_id']))
        &&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&($_REQUEST['page_no']))
{
   
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];
 $class_id=$_REQUEST['temp_class_id'];
 $page=$_REQUEST['page_no'];  
 $section_id=$_REQUEST['temp_section_id'];
 
   if(!empty($_REQUEST['page_no']))
{
if($_REQUEST['page_no']>1)
{
$number_pages=$_REQUEST['page_no'];
$fixed_number="1";
$multiply=($fixed_number*$number_pages);

$subtract_number=($multiply-$fixed_number);
$limit=$subtract_number.",".$multiply;

    
}else
{
$limit="0,1";       
}
    
    
}else
{
 $limit="0,1";   
}
 $student_db=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and section_id='$section_id'
         and action='active' LIMIT $limit");

}else
    if((!empty($_REQUEST['student_class']))&&(!empty($_REQUEST['student_search']))&&(!empty($_REQUEST['org_id']))
        &&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
 
$student_section_id=$_REQUEST['student_section_id'];
$student_admission_no=$_REQUEST['student_admission_no'];
$student_name=$_REQUEST['student_search'];
$student_class=$_REQUEST['student_class'];  
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];

 if(!empty($_REQUEST['page_no']))
{
if($_REQUEST['page_no']>1)
{
$number_pages=$_REQUEST['page_no'];
$fixed_number="1";
$multiply=($fixed_number*$number_pages);

$subtract_number=($multiply-$fixed_number);
$limit=$subtract_number.",".$multiply;

    
}else
{
$limit="0,1";       
}
    
    
}else
{
 $limit="0,1";   
}
 




if(!empty($student_admission_no))
{
 
$student_admission_search="and student_id='$student_admission_no'";   
$student_like_search="";    
}else
{
$student_admission_search="";
$student_like_search="and student_full_name LIKE '%$student_name%'";     
}


if(!empty($student_section_id))
{
 $section_search_code="and section_id='$student_section_id'";  
}else
{
  $section_search_code="";  
}


$student_db=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$student_class' $section_search_code $student_admission_search
         $student_like_search and action='active' LIMIT $limit");

}else
    if((!empty($_REQUEST['dyanamic_student_search']))&&(!empty($_REQUEST['search_by']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
 
$student_admission_no=$_REQUEST['dyanamic_student_admission_no'];
$student_name=$_REQUEST['dyanamic_student_search'];
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];
$student_search_by=$_REQUEST['search_by'];

   if(!empty($_REQUEST['page_no']))
{
if($_REQUEST['page_no']>1)
{
$number_pages=$_REQUEST['page_no'];
$fixed_number="1";
$multiply=($fixed_number*$number_pages);

$subtract_number=($multiply-$fixed_number);
$limit=$subtract_number.",".$multiply;

    
}else
{
$limit="0,1";       
}
    
    
}else
{
 $limit="0,1";   
}
 

if(!empty($student_admission_no))
{
 
$student_admission_search="and student_id='$student_admission_no'";   
$student_like_search="";    
}else
{
$student_admission_search="";
$student_like_search="and $student_search_by LIKE '%$student_name%'";     
}



}






 
$row=0; 
 while ($fetch_student_data=mysql_fetch_array($student_db))
 {
   $row++;
   $fetch_student_sr_no=$fetch_student_data['id'];
    $fetch_student_admission_no=$fetch_student_data['student_id'];
     $fetch_student_roll_no=$fetch_student_data['roll_no'];
    $student_encrypt_id=$fetch_student_data['encrypt_id'];
     
     $class_id=$fetch_student_data['course_id'];
 $class_db=  mysql_query("SELECT * FROM course_db WHERE organization_id='$organization_id' and branch_id='$branch_id' 
         and  session_id='$session_id' and course_id='$class_id'");
   $fetch_course_data=  mysql_fetch_array($class_db);
   $fetch_course_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))
   {
      $course_name=$fetch_course_data['course_name'];
      
   }  else {
        $course_name="";
   }
     
     $section_id=$fetch_student_data['section_id'];
  $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$organization_id' and branch_id='$branch_id' 
         and  session_id='$session_id' and section_id='$section_id'");
   $fetch_section_data=  mysql_fetch_array($section_db);
   $fetch_section_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_section_data))&&($fetch_section_data!=null)&&($fetch_section_num_rows!=0))
   {
      $section_name=$fetch_section_data['section_name'];
      
   }  else {
        $section_name="";
   }
 

 $session_id=$fetch_student_data['session_id'];
  $session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$organization_id' and branch_id='$branch_id' 
        and session_id='$session_id'");
   $fetch_session_data=  mysql_fetch_array($session_db);
   $fetch_session_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_session_data))&&($fetch_session_data!=null)&&($fetch_session_num_rows!=0))
   {
      $session_name=$fetch_session_data['session_name'];
      
   }  else {
        $session_name="";
   }
   
   
   $category_id=$fetch_student_data['category_id'];
   $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$organization_id' and branch_id='$branch_id' and category_id='$category_id'");
   $fetch_category_data=  mysql_fetch_array($category_db);
   $fetch_category_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_category_data))&&($fetch_category_data!=null)&&($fetch_category_num_rows!=0))
   {
      $category_name=$fetch_category_data['category_name'];
      
   }  else {
        $category_name="";
   }
     
     
     $fetch_student_full_name=$fetch_student_data['student_full_name'];
     $fetch_student_gender=  ucfirst($fetch_student_data['student_gender']);
     $fetch_student_dob=$fetch_student_data['student_dob'];
     $fetch_student_father_name=$fetch_student_data['father_name'];
     $fetch_student_father_mobile_no=$fetch_student_data['father_mobile_no'];
     $fetch_student_mother_name=$fetch_student_data['mother_name'];
     
     
 echo "<tr class='td_heading_style'>
                           <td class='first_td_left'>$row</td>
                           <td><b>$fetch_student_admission_no</b></td>
                           <td style='text-align:center;'><b>$fetch_student_sr_no</b></td>
                           <td style='text-align:center;'>$course_name <B>-</B> $section_name</td>
                           <td style='text-align:Center;'>$session_name</td>
                           <td style='text-align:Center;'><b>$fetch_student_roll_no</b></td>
                           <td>$fetch_student_full_name</td>
                           <td>$fetch_student_gender</td>
                           <td style='text-align:Center;'>$fetch_student_dob</td>
                           <td style='text-align:Center;'>$category_name</td>
                           <td>$fetch_student_father_name</td>
                           <td>$fetch_student_father_mobile_no</td>
                           
                           <td class='first_td_right'>$fetch_student_mother_name</td>";
 
 }
 
 if(empty($fetch_student_sr_no))
 {
     echo "<tr class='td_heading_style'>
<td colspan='15' class='first_td_left' style='color:red; border-right:1px solid silver; text-align:center;'>Record empty</td> 
</tr>";   
 }  
 

              ?>  
                
            </table>     
            
            
            
            
        </div> 
        
        
        
        
    </body>
</html>
<?php 
  }
 }else
 {
 header("Location:../loginPage.php");   
 }
  
  
 }else
 {
 header("Location:../loginPage.php");   
 }
 
 
 }else
{
     header("Location:../loginPage.php");
}


}else
{
    header("Location:../loginPage.php");
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