<?php 
require_once '../connection.php';
if((!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['org_id']))
        &&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))&&($_REQUEST['page_no']))
{
   
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];
 $class_id=$_REQUEST['class_id'];
 $page=$_REQUEST['page_no'];  
 
 
  if(!empty($_REQUEST['page_no']))
{
if($_REQUEST['page_no']>1)
{
$number_pages=$_REQUEST['page_no'];
$fixed_number="50";
$multiply=($fixed_number*$number_pages);

$subtract_number=($multiply-$fixed_number);
$limit=$subtract_number.",".$multiply;

    
}else
{
$limit="0,50";       
}
    
    
}else
{
 $limit="0,50";   
}
 
$page_forward_page="class_id=$class_id&&org_id=$organization_id&&branch_id=$branch_id&&session_id=$session_id";
 


 echo "<div id='section_record'>";
 echo "<option id='zero_seztion' value='0'>-- Select Section --</option>";
 
 $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and action='active'");
 while ($fetch_section_record=  mysql_fetch_array($section_db))
 {
   $fetch_section_id=$fetch_section_record['section_id'];
   $fetch_section_name=$fetch_section_record['section_name'];
   
   echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
 }
 if(empty($fetch_section_id))
 {
     echo "<option value='0'>Record no found !!</option>";   
 }
 
 
 echo "</div>";
 
 
 echo "<div id='student_all_details_data'>
<table cellspacing='0'  cellpadding='0' class='student_table_details'>
                       <tr>
                           <td colspan='13'>";
                           {
                           ?>
<a href="#" onclick="window.open('print_pages.php?<?php  echo $page_forward_page;?>&&page_no=<?php  echo $limit;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='print_button_show'>Print (<?php  echo $limit; ?> )</div></a>

<a href="#" onclick="window.open('print_pages.php?<?php  echo $page_forward_page;?>&&page_no=all','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='print_button_show'>Print ( All )</div></a> 
                        <?php 
                           }
                          echo"</td>
                       </tr>
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
                           
                           <td><b>Action</b></td>
                       </tr>      
";
 $row=0;
 $student_db=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and action='active' LIMIT $limit");
 while ($fetch_student_data=mysql_fetch_array($student_db))
 {
 $row++;
   $fetch_student_sr_no=$fetch_student_data['sr_no'];
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
     
      $fetch_account_status=$fetch_student_data['account_status'];
    
    if($fetch_account_status=="active")
    {
    $account_status="inactive";    
    echo "<style>#studnet_$fetch_student_admission_no { background-color:white;}</style>";
         
    }else
        {
         $account_status="active"; 
         
         echo "<style>#studnet_$fetch_student_admission_no { background-color:#FFFFB2;}</style>";
         
        }
     
     
     
 echo "<tr id='studnet_$fetch_student_admission_no'  class='td_heading_style'>
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
                           
                           <td class='first_td_right'>
     
     
     
     ";
     {
 ?>

<div onclick="delete_data('<?php  echo $fetch_student_admission_no;?>')" class='delete_button'></div>

<a href="#" onclick="window.open('../admission/student_edit_profile.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='edit_buttons'></div></a>

<div onclick="full_view_student('<?php  echo $fetch_student_admission_no;?>','<?php  echo $class_id;?>','<?php  echo $session_id;?>')" class='view_buttonsss'></div>



<?php 
     }
 
 echo"
     
     
     
     </td>
                       </tr>
                       
                   ";
 
 }

 if(empty($fetch_student_sr_no))
 {
     echo "<tr  class='td_heading_style'>
<td colspan='15' class='first_td_left' style='color:red; border-right:1px solid silver; text-align:center;'>Record empty</td> 
</tr>";   
 }  
 
 $page_forward_page="class_id=$class_id&&org_id=$organization_id&&branch_id=$branch_id&&session_id=$session_id";

 
 echo "<tr>
<td><input type='hidden' id='page_forward_url' value='$page_forward_page'></td>     
</tr>";
 
 //page forward
 

 
 
 
 echo "<tr>
<td colspan='13'>
<div class='forward_pages'>";
 
 
 
 
 $student_dbS=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and action='active'");

 $total_number_fetch= mysql_num_rows($student_dbS);
 
 
 
  if(empty($_REQUEST['page_no']))
  {
      $_REQUEST['page_no']=1;
  }
  
  if($total_number_fetch!=0)
  {
  
  if($total_number_fetch>2)
  {
    $divided_by_number="50";
    $divided_number_total=($total_number_fetch/$divided_by_number);
     
    $convert_ceil=ceil($divided_number_total);
    if($convert_ceil>1)
    {
    
        
        if(!empty($_REQUEST['page_no']))
      {
          if($_REQUEST['page_no']>1)
          {
      $pages_decrease=$_REQUEST['page_no'];
      $add_one_decrease="1";
      $addition_values_decrease=($pages_decrease-$add_one_decrease);
         {
             ?>
            <div onclick="page_forward('<?php  echo $addition_values_decrease;?>')" class='previous_button_style'>Previous</div> 
        <?php 
         }
            
          }
      }else
      {
          
      }
        
  for($loop_counter=1;$loop_counter<=$convert_ceil;$loop_counter++)    
  {
      
      if($_REQUEST['page_no']!=$loop_counter)
      {
      
      {   
          ?>
<div onclick="page_forward('<?php  echo $loop_counter;?>')" class='small_short_page_no'><?php  echo $loop_counter;?></div>
   <?php  
     }
      
      
      }else
      {
       {   
          ?>
<div onclick="page_forward('<?php  echo $loop_counter;?>')" class='small_short_page_no' style=" color:white; background-color:blue; "><?php  echo $loop_counter;?></div>
   <?php  
     }    
      }
  }
  if($_REQUEST['page_no']<$convert_ceil)
  {
      $pages=$_REQUEST['page_no'];
      $add_one="1";
      $addition_values=($pages+$add_one);
   {
?>   
      <div onclick="page_forward('<?php  echo $addition_values;?>')" class='previous_button_style'>Next</div> 
      
    
<?php   
      }
  }
  
    }
  }
  }
 
 
 
 
 
 
 
 echo "</div>
</td>
</tr>     
";
 
 
 
 echo "</table></div>";
 
 
 echo "<div id='student_autocomplete_data'>";
 
 $student_db_list=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and action='active'");
 while ($fetch_student_datas=mysql_fetch_array($student_db_list))
 {
  
  $fetch_student_admission_no=$fetch_student_datas['student_id'];
   $fetch_student_name=  ucfirst($fetch_student_datas['student_full_name']);
    $fetch_student_father_name=  ucfirst($fetch_student_datas['father_name']);
   
    {
    ?>
<li onclick="onclik_student_record('<?php  echo $fetch_student_admission_no;?>','<?php  echo $fetch_student_name;?>')">
 <?php 
    }
   echo " <a class='student_name'>$fetch_student_name</a> <input type='hidden' value='$fetch_student_name' id='match_student_name_$fetch_student_admission_no'>
    <a class='admission_id'>$fetch_student_admission_no</a><p class='student_search_p'>$fetch_student_name</p> <p><b>S/o</b></p><span> <p class='student_father_search_p'>$fetch_student_father_name</p></span></li>";     
     
 }
 
 echo "</div>";
}







//fecth section data


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
$fixed_number="50";
$multiply=($fixed_number*$number_pages);

$subtract_number=($multiply-$fixed_number);
$limit=$subtract_number.",".$multiply;

    
}else
{
$limit="0,50";       
}
    
    
}else
{
 $limit="0,50";   
}
 
$page_forward_page="temp_class_id=$class_id&&temp_section_id=$section_id&&org_id=$organization_id&&branch_id=$branch_id&&session_id=$session_id";
 
 echo "<div id='student_all_details_data'>
<table cellspacing='0'  cellpadding='0' class='student_table_details'>
                        <tr>
                           <td colspan='13'>";
                           {
                           ?>
<a href="#" onclick="window.open('print_pages.php?<?php  echo $page_forward_page;?>&&page_no=<?php  echo $limit;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='print_button_show'>Print (<?php  echo $limit; ?> )</div></a>

<a href="#" onclick="window.open('print_pages.php?<?php  echo $page_forward_page;?>&&page_no=all','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='print_button_show'>Print ( All )</div></a> 
                        <?php 
                           }
                          echo"</td>
                       </tr>
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
                           
                           <td><b>Action</b></td>
                       </tr>           
";
 $row=0;
 $student_db=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and section_id='$section_id'
         and action='active' LIMIT $limit");
 while ($fetch_student_data=mysql_fetch_array($student_db))
 {
 $row++;
   $fetch_student_sr_no=$fetch_student_data['sr_no'];
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
   $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$organization_id' and branch_id='$branch_id'
           and category_id='$category_id' and action='active'");
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
    
     $fetch_account_status=$fetch_student_data['account_status'];
    
    if($fetch_account_status=="active")
    {
    $account_status="inactive";    
    echo "<style>#studnet_$fetch_student_admission_no { background-color:white;}</style>";
         
    }else
        {
         $account_status="active"; 
         
         echo "<style>#studnet_$fetch_student_admission_no { background-color:#FFFFB2;}</style>";
         
        }
     
 echo "<tr id='studnet_$fetch_student_admission_no'    class='td_heading_style'>
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
                           
                           <td class='first_td_right'>
     ";
     {
 ?>

<div onclick="delete_data('<?php  echo $fetch_student_admission_no;?>')" class='delete_button'></div>
<a href="#" onclick="window.open('../admission/student_edit_profile.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       
<div class='edit_buttons'></div></a>

<div onclick="full_view_student('<?php  echo $fetch_student_admission_no;?>','<?php  echo $class_id;?>','<?php  echo $session_id;?>')" class='view_buttonsss'></div>



<?php 
     }
 
 echo"
     </td>
                       </tr>
                       
                   ";
 
 }

 if(empty($fetch_student_sr_no))
 {
     echo "<tr  class='td_heading_style'>
<td colspan='15' class='first_td_left' style='color:red; border-right:1px solid silver; text-align:center;'>Record empty</td> 
</tr>";   
 }
 
 
 $page_forward_page="temp_class_id=$class_id&&temp_section_id=$section_id&&org_id=$organization_id&&branch_id=$branch_id&&session_id=$session_id";

 
 echo "<tr>
<td><input type='hidden' id='page_forward_url' value='$page_forward_page'></td>     
</tr>";
 
 //page forward
 

 
 
 
 echo "<tr>
<td colspan='13'>
<div class='forward_pages'>";
 
 
 
 
 $student_dbS=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and section_id='$section_id'
         and action='active'");
 $total_number_fetch= mysql_num_rows($student_dbS);
 
 
 
  if(empty($_REQUEST['page_no']))
  {
      $_REQUEST['page_no']=1;
  }
  
  if($total_number_fetch!=0)
  {
  
  if($total_number_fetch>2)
  {
    $divided_by_number="50";
    $divided_number_total=($total_number_fetch/$divided_by_number);
     
    $convert_ceil=ceil($divided_number_total);
    if($convert_ceil>1)
    {
    
        
        if(!empty($_REQUEST['page_no']))
      {
          if($_REQUEST['page_no']>1)
          {
      $pages_decrease=$_REQUEST['page_no'];
      $add_one_decrease="1";
      $addition_values_decrease=($pages_decrease-$add_one_decrease);
         {
             ?>
            <div onclick="page_forward('<?php  echo $addition_values_decrease;?>')" class='previous_button_style'>Previous</div> 
        <?php 
         }
            
          }
      }else
      {
          
      }
        
  for($loop_counter=1;$loop_counter<=$convert_ceil;$loop_counter++)    
  {
      
      if($_REQUEST['page_no']!=$loop_counter)
      {
      
      {   
          ?>
<div onclick="page_forward('<?php  echo $loop_counter;?>')" class='small_short_page_no'><?php  echo $loop_counter;?></div>
   <?php  
     }
      
      
      }else
      {
       {   
          ?>
<div onclick="page_forward('<?php  echo $loop_counter;?>')" class='small_short_page_no' style=" color:white; background-color:blue; "><?php  echo $loop_counter;?></div>
   <?php  
     }    
      }
  }
  if($_REQUEST['page_no']<$convert_ceil)
  {
      $pages=$_REQUEST['page_no'];
      $add_one="1";
      $addition_values=($pages+$add_one);
   {
?>   
      <div onclick="page_forward('<?php  echo $addition_values;?>')" class='previous_button_style'>Next</div> 
      
    
<?php   
      }
  }
  
    }
  }
  }
 
 echo "</div></td></tr></table></div>";
 
 
 echo "<div id='student_autocomplete_data'>";
 
 $student_db_list=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and section_id='$section_id' and action='active'");
 while ($fetch_student_datas=mysql_fetch_array($student_db_list))
 {
  
  $fetch_student_admission_no=$fetch_student_datas['student_id'];
   $fetch_student_name=  ucfirst($fetch_student_datas['student_full_name']);
    $fetch_student_father_name=  ucfirst($fetch_student_datas['father_name']);
   
    {
    ?>
<li onclick="onclik_student_record('<?php  echo $fetch_student_admission_no;?>','<?php  echo $fetch_student_name;?>')">
 <?php 
    }
   echo " <a class='student_name'>$fetch_student_name</a> <input type='hidden' value='$fetch_student_name' id='match_student_name_$fetch_student_admission_no'>
    <a class='admission_id'>$fetch_student_admission_no</a><p class='student_search_p'>$fetch_student_name</p> <p><b>S/o</b></p><span> <p class='student_father_search_p'>$fetch_student_father_name</p></span></li>";     
     
 }
 
 echo "</div>";
}









if((!empty($_REQUEST['search_qq']))&&(!empty($_REQUEST['search_by']))&&(!empty($_REQUEST['org_id']))
        &&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
   
$organization_id=$_REQUEST['org_id'];
$branch_id=$_REQUEST['branch_id'];
$session_id=$_REQUEST['session_id'];
$search_by=$_REQUEST['search_by'];
$search_qq_temp=trim($_REQUEST['search_qq']);
$search_qq=preg_replace('/\s+/', ' ',$search_qq_temp); 


  

 $student_db_list=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and $search_by LIKE '%$search_qq%' and action='active'");
 while ($fetch_student_datas=mysql_fetch_array($student_db_list))
 {
  
  $fetch_student_admission_no=$fetch_student_datas['student_id'];
   $fetch_student_name=ucfirst($fetch_student_datas['student_full_name']);
    $fetch_student_father_name=  ucfirst($fetch_student_datas['father_name']);
   
    {
    ?>
<li onclick="onclik_student_record('<?php  echo $fetch_student_admission_no;?>','<?php  echo $fetch_student_name;?>')">
 <?php 
    }
   echo " <a class='student_name'>$fetch_student_name</a> <input type='hidden' value='$fetch_student_name' id='match_student_name_$fetch_student_admission_no'>
    <a class='admission_id'>$fetch_student_admission_no</a><p class='student_search_p'>$fetch_student_name</p> <p><b>S/o</b></p><span> <p class='student_father_search_p'>$fetch_student_father_name</p></span></li>";     
     
 }
 
 if(empty($fetch_student_admission_no))
 {
     echo "<li style='background-color:white;  color:red;'><span style='color:red;'></span> '<b>$search_qq</b>' Record No Found !!</li>"; 
 }
}





//student search by class section

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
$fixed_number="50";
$multiply=($fixed_number*$number_pages);

$subtract_number=($multiply-$fixed_number);
$limit=$subtract_number.",".$multiply;

    
}else
{
$limit="0,50";       
}
    
    
}else
{
 $limit="0,50";   
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


$page_forward_page="student_class=$student_class&&student_section_id=$student_section_id&&student_admission_no=$student_admission_no&&student_search=$student_name&&org_id=$organization_id&&branch_id=$branch_id&&session_id=$session_id";



 echo "<div id='student_all_details_data'>
<table cellspacing='0'  cellpadding='0' class='student_table_details'>
                       <tr>
                           <td colspan='13'>";
                           {
                           ?>
<a href="#" onclick="window.open('print_pages.php?<?php  echo $page_forward_page;?>&&page_no=<?php  echo $limit;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='print_button_show'>Print (<?php  echo $limit; ?> )</div></a>

<a href="#" onclick="window.open('print_pages.php?<?php  echo $page_forward_page;?>&&page_no=all','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='print_button_show'>Print ( All )</div></a> 
                        <?php 
                           }
                          echo"</td>
                       </tr>
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
                           
                           <td><b>Action</b></td>
                       </tr>            
";
 $row=0;
 $student_db=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$student_class' $section_search_code $student_admission_search
         $student_like_search and action='active' LIMIT $limit");
 while ($fetch_student_data=mysql_fetch_array($student_db))
 {
 $row++;
   $fetch_student_sr_no=$fetch_student_data['sr_no'];
    $fetch_student_admission_no=$fetch_student_data['student_id'];
     $fetch_student_roll_no=$fetch_student_data['roll_no'];
    $student_encrypt_id=$fetch_student_data['encrypt_id'];
    
     
     $class_id=$fetch_student_data['course_id'];
 $class_db=  mysql_query("SELECT * FROM course_db WHERE organization_id='$organization_id' and branch_id='$branch_id' 
         and  session_id='$session_id' and course_id='$class_id' and action='active'");
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
         and  session_id='$session_id' and section_id='$section_id' and action='active'");
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
        and session_id='$session_id' and action='active'");
   $fetch_session_data=  mysql_fetch_array($session_db);
   $fetch_session_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_session_data))&&($fetch_session_data!=null)&&($fetch_session_num_rows!=0))
   {
      $session_name=$fetch_session_data['session_name'];
      
   }  else {
        $session_name="";
   }
   
   
   $category_id=$fetch_student_data['category_id'];
   $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$organization_id'
           and branch_id='$branch_id' and category_id='$category_id' and action='active'");
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
     
      $fetch_account_status=$fetch_student_data['account_status'];
    
    if($fetch_account_status=="active")
    {
    $account_status="inactive";    
    echo "<style>#studnet_$fetch_student_admission_no { background-color:white;}</style>";
         
    }else
        {
         $account_status="active"; 
         
         echo "<style>#studnet_$fetch_student_admission_no { background-color:#FFFFB2;}</style>";
         
        }
     
 echo "<tr id='studnet_$fetch_student_admission_no'    class='td_heading_style'>
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
                           
                           <td class='first_td_right'>
     ";
     {
 ?>

<div onclick="delete_data('<?php  echo $fetch_student_admission_no;?>')" class='delete_button'></div>
<a href="#" onclick="window.open('../admission/student_edit_profile.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       
<div class='edit_buttons'></div></a>

<div onclick="full_view_student('<?php  echo $fetch_student_admission_no;?>','<?php  echo $class_id;?>','<?php  echo $session_id;?>')" class='view_buttonsss'></div>



<?php 
     }
 
 echo"
     
     </td>
                       </tr>
                       
                   ";
 
 }

 if(empty($fetch_student_sr_no))
 {
     echo "<tr   class='td_heading_style'>
<td colspan='15' class='first_td_left' style='color:red; border-right:1px solid silver; text-align:center;'>Record empty</td> 
</tr>";   
 } 
 
 
 $page_forward_page="student_class=$student_class&&student_section_id=$student_section_id&&student_admission_no=$student_admission_no&&student_search=$student_name&&org_id=$organization_id&&branch_id=$branch_id&&session_id=$session_id";

 
 echo "<tr>
<td><input type='hidden' id='page_forward_url' value='$page_forward_page'></td>     
</tr>";
 
 
 echo "<tr>
<td colspan='13'>
<div class='forward_pages'>";
 
 
 
 
$student_dbS=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' and course_id='$student_class' $section_search_code $student_admission_search
         $student_like_search and action='active'");
 $total_number_fetch= mysql_num_rows($student_dbS);
 
 
 
  if(empty($_REQUEST['page_no']))
  {
      $_REQUEST['page_no']=1;
  }
  
  if($total_number_fetch!=0)
  {
  
  if($total_number_fetch>2)
  {
    $divided_by_number="50";
    $divided_number_total=($total_number_fetch/$divided_by_number);
     
    $convert_ceil=ceil($divided_number_total);
    if($convert_ceil>1)
    {
    
        
        if(!empty($_REQUEST['page_no']))
      {
          if($_REQUEST['page_no']>1)
          {
      $pages_decrease=$_REQUEST['page_no'];
      $add_one_decrease="1";
      $addition_values_decrease=($pages_decrease-$add_one_decrease);
         {
             ?>
            <div onclick="page_forward('<?php  echo $addition_values_decrease;?>')" class='previous_button_style'>Previous</div> 
        <?php 
         }
            
          }
      }else
      {
          
      }
        
  for($loop_counter=1;$loop_counter<=$convert_ceil;$loop_counter++)    
  {
      
      if($_REQUEST['page_no']!=$loop_counter)
      {
      
      {   
          ?>
<div onclick="page_forward('<?php  echo $loop_counter;?>')" class='small_short_page_no'><?php  echo $loop_counter;?></div>
   <?php  
     }
      
      
      }else
      {
       {   
          ?>
<div onclick="page_forward('<?php  echo $loop_counter;?>')" class='small_short_page_no' style=" color:white; background-color:blue; "><?php  echo $loop_counter;?></div>
   <?php  
     }    
      }
  }
  if($_REQUEST['page_no']<$convert_ceil)
  {
      $pages=$_REQUEST['page_no'];
      $add_one="1";
      $addition_values=($pages+$add_one);
   {
?>   
      <div onclick="page_forward('<?php  echo $addition_values;?>')" class='previous_button_style'>Next</div> 
      
    
<?php   
      }
  }
  
    }
  }
  }
 
 echo "</div></td></tr></table></div>";



}









//student dyanamic search code

//student search by class section

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
$fixed_number="50";
$multiply=($fixed_number*$number_pages);

$subtract_number=($multiply-$fixed_number);
$limit=$subtract_number.",".$multiply;

    
}else
{
$limit="0,50";       
}
    
    
}else
{
 $limit="0,50";   
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

$page_forward_page="dyanamic_student_admission_no=$student_admission_no&&search_by=$student_search_by&&dyanamic_student_search=$student_name&&org_id=$organization_id&&branch_id=$branch_id&&session_id=$session_id";


 echo "<div id='student_all_details_data'>
<table cellspacing='0'  cellpadding='0' class='student_table_details'>
                       <tr>
                           <td colspan='13'>";
                           {
                           ?>
<a href="#" onclick="window.open('print_pages.php?<?php  echo $page_forward_page;?>&&page_no=<?php  echo $limit;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='print_button_show'>Print (<?php  echo $limit; ?> )</div></a>

<a href="#" onclick="window.open('print_pages.php?<?php  echo $page_forward_page;?>&&page_no=all','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
<div class='print_button_show'>Print ( All )</div></a> 
                        <?php 
                           }
                          echo"</td>
                       </tr>
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
                           
                           <td><b>Action</b></td>
                       </tr>            
";
 $row=0;
 $student_db=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' $student_admission_search
         $student_like_search and action='active' LIMIT $limit");
 while ($fetch_student_data=mysql_fetch_array($student_db))
 {
 $row++;
   $fetch_student_sr_no=$fetch_student_data['sr_no'];
    $fetch_student_admission_no=$fetch_student_data['student_id'];
     $fetch_student_roll_no=$fetch_student_data['roll_no'];
    $student_encrypt_id=$fetch_student_data['encrypt_id'];
    
     
     $class_id=$fetch_student_data['course_id'];
 $class_db=  mysql_query("SELECT * FROM course_db WHERE organization_id='$organization_id' and branch_id='$branch_id' 
         and  session_id='$session_id' and course_id='$class_id' and action='active'");
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
         and  session_id='$session_id' and section_id='$section_id' and action='active'");
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
        and session_id='$session_id' and action='active'");
   $fetch_session_data=  mysql_fetch_array($session_db);
   $fetch_session_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_session_data))&&($fetch_session_data!=null)&&($fetch_session_num_rows!=0))
   {
      $session_name=$fetch_session_data['session_name'];
      
   }  else {
        $session_name="";
   }
   
   
   $category_id=$fetch_student_data['category_id'];
   $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$organization_id'
           and branch_id='$branch_id' and category_id='$category_id' and action='active'");
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
     
      $fetch_account_status=$fetch_student_data['account_status'];
    
    if($fetch_account_status=="active")
    {
    $account_status="inactive";    
    echo "<style>#studnet_$fetch_student_admission_no { background-color:white;}</style>";
         
    }else
        {
         $account_status="active"; 
         
         echo "<style>#studnet_$fetch_student_admission_no { background-color:#FFFFB2;}</style>";
         
        }
     
 echo "<tr id='studnet_$fetch_student_admission_no'    class='td_heading_style'>
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
                           
                           <td class='first_td_right'>
     
    ";
     {
 ?>

<div onclick="delete_data('<?php  echo $fetch_student_admission_no;?>')" class='delete_button'></div>
<a href="#" onclick="window.open('../admission/student_edit_profile.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       
<div class='edit_buttons'></div></a>

<div onclick="full_view_student('<?php  echo $fetch_student_admission_no;?>','<?php  echo $class_id;?>','<?php  echo $session_id;?>')" class='view_buttonsss'></div>



<?php 
     }
 
 echo"
     
     </td>
                       </tr>
                       
                   ";
 
 }

 if(empty($fetch_student_sr_no))
 {
     echo "<tr  class='td_heading_style'>
<td colspan='15' class='first_td_left' style='color:red; border-right:1px solid silver; text-align:center;'>Record empty</td> 
</tr>";   
 } 
 
 
 $page_forward_page="dyanamic_student_admission_no=$student_admission_no&&search_by=$student_search_by&&dyanamic_student_search=$student_name&&org_id=$organization_id&&branch_id=$branch_id&&session_id=$session_id";

 
 echo "<tr>
<td><input type='hidden' id='page_forward_url' value='$page_forward_page'></td>     
</tr>";
 echo "<tr>
<td colspan='13'>
<div class='forward_pages'>";
 
 
 
 
$student_dbS=  mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' and 
     branch_id='$branch_id' and session_id='$session_id' $student_admission_search
         $student_like_search and action='active'");
 $total_number_fetch= mysql_num_rows($student_dbS);
 
 
 
  if(empty($_REQUEST['page_no']))
  {
      $_REQUEST['page_no']=1;
  }
  
  if($total_number_fetch!=0)
  {
  
  if($total_number_fetch>2)
  {
    $divided_by_number="50";
    $divided_number_total=($total_number_fetch/$divided_by_number);
     
    $convert_ceil=ceil($divided_number_total);
    if($convert_ceil>1)
    {
    
        
        if(!empty($_REQUEST['page_no']))
      {
          if($_REQUEST['page_no']>1)
          {
      $pages_decrease=$_REQUEST['page_no'];
      $add_one_decrease="1";
      $addition_values_decrease=($pages_decrease-$add_one_decrease);
         {
             ?>
            <div onclick="page_forward('<?php  echo $addition_values_decrease;?>')" class='previous_button_style'>Previous</div> 
        <?php 
         }
            
          }
      }else
      {
          
      }
        
  for($loop_counter=1;$loop_counter<=$convert_ceil;$loop_counter++)    
  {
      
      if($_REQUEST['page_no']!=$loop_counter)
      {
      
      {   
          ?>
<div onclick="page_forward('<?php  echo $loop_counter;?>')" class='small_short_page_no'><?php  echo $loop_counter;?></div>
   <?php  
     }
      
      
      }else
      {
       {   
          ?>
<div onclick="page_forward('<?php  echo $loop_counter;?>')" class='small_short_page_no' style=" color:white; background-color:blue; "><?php  echo $loop_counter;?></div>
   <?php  
     }    
      }
  }
  if($_REQUEST['page_no']<$convert_ceil)
  {
      $pages=$_REQUEST['page_no'];
      $add_one="1";
      $addition_values=($pages+$add_one);
   {
?>   
      <div onclick="page_forward('<?php  echo $addition_values;?>')" class='previous_button_style'>Next</div> 
      
    
<?php   
      }
  }
  
    }
  }
  }
 
 echo "</div></td></tr></table></div>";
}








//FULL VIEW DETAILS
if((!empty($_REQUEST['full_student_admission_id']))&&(!empty($_REQUEST['org_id']))
        &&(!empty($_REQUEST['student_class_id'])&&(!empty($_REQUEST['full_student_session_id'])))
        &&(!empty($_REQUEST['branch_id'])))
{
$student_admission_no=$_REQUEST['full_student_admission_id'];
$stduent_class_id=$_REQUEST['student_class_id'];
$fecth_session_id_set=$_REQUEST['full_student_session_id'];
   
    $fetch_school_id=$_REQUEST['org_id'];
    $fetch_branch_id=$_REQUEST['branch_id'];
  
        if((!empty($student_admission_no)))
        {
        
         $student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and 
             session_id='$fecth_session_id_set' and course_id='$stduent_class_id' and student_id='$student_admission_no' and action='active'");
         $fetch_student_data=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);
         if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
         {
$form_sr_no=$fetch_student_data['sr_no'];
$admission_no=$fetch_student_data['student_id'];
$student_roll_no=$fetch_student_data['roll_no'];       
$student_admission_date=$fetch_student_data['admission_date'];               
    
$student_encrypt_id=$fetch_student_data['encrypt_id'];  

 $class_id=$fetch_student_data['course_id'];
 $class_db=  mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' 
         and  session_id='$fecth_session_id_set' and course_id='$class_id' and action='active'");
   $fetch_course_data=  mysql_fetch_array($class_db);
   $fetch_course_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))
   {
      $course_name=$fetch_course_data['course_name'];
      
   }  else {
        $course_name="";
   }
 
 
 
 $section_id=$fetch_student_data['section_id'];
  $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' 
         and  session_id='$fecth_session_id_set' and section_id='$section_id' and action='active'");
   $fetch_section_data=  mysql_fetch_array($section_db);
   $fetch_section_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_section_data))&&($fetch_section_data!=null)&&($fetch_section_num_rows!=0))
   {
      $section_name=$fetch_section_data['section_name'];
      
   }  else {
        $section_name="";
   }
 

 $session_id=$fetch_student_data['session_id'];
  $session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' 
        and session_id='$session_id' and action='active'");
   $fetch_session_data=  mysql_fetch_array($session_db);
   $fetch_session_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_session_data))&&($fetch_session_data!=null)&&($fetch_session_num_rows!=0))
   {
      $session_name=$fetch_session_data['session_name'];
      
   }  else {
        $session_name="";
   }
   
   
   $category_id=$fetch_student_data['category_id'];
   $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$fetch_school_id' 
           and branch_id='$fetch_branch_id' and category_id='$category_id' and action='active'");
   $fetch_category_data=  mysql_fetch_array($category_db);
   $fetch_category_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_category_data))&&($fetch_category_data!=null)&&($fetch_category_num_rows!=0))
   {
      $category_name=$fetch_category_data['category_name'];
      
   }  else {
        $category_name="";
   }
   
   
   
    $student_full_name=$fetch_student_data['student_full_name'];
    $student_gender=  ucfirst($fetch_student_data['student_gender']);
    $student_dob=$fetch_student_data['student_dob'];
    $student_blood_group=$fetch_student_data['student_blood_group'];
    $student_birth_place=$fetch_student_data['student_birth_place'];
    $student_nationality=$fetch_student_data['student_nationality'];
    $student_religion=$fetch_student_data['student_religion'];
    $student_mother_tongue=$fetch_student_data['mother_tongue'];
    $student_category=$fetch_student_data['category_id'];
    $student_sub_category=$fetch_student_data['sub_category'];
    $student_mobile=$fetch_student_data['student_mobile_no'];
    $student_email=$fetch_student_data['student_email_id'];
    $student_photo=$fetch_student_data['student_photo'];
    $student_communicate_mobile_no=$fetch_student_data['parent_communicate_mobile_no'];
    $student_communicate_email_id=$fetch_student_data['parent_communicate_email'];
    $student_sub_status=$fetch_student_data['sub_status'];
    
    
    
    
    
    if(empty($student_photo))
    {
    $student_photo="images/no_avilable_image.gif";    
    }  else {
      $student_photo=$student_photo;    
       
    }
    
    
    
    $studnet_handicapped=$fetch_student_data['student_handicapped'];
    
    if(($studnet_handicapped==0))
    {
    $studnet_handicapped="No";    
    }else
    {
      $studnet_handicapped="Yes"; 
    }
    
    $student_current_address=$fetch_student_data['current_address'];
    $student_current_nearest_area=$fetch_student_data['current_nearest_area'];
    $student_current_city=$fetch_student_data['current_city'];
    $student_current_desctric=$fetch_student_data['current_desctric'];
    $student_current_pincode=$fetch_student_data['current_pincode'];
    $student_current_state=$fetch_student_data['current_state'];
    $student_current_country=$fetch_student_data['current_country'];
    $student_current_post=$fetch_student_data['current_post'];
    
    
    $student_permanent_address=$fetch_student_data['permanent_address'];
    $student_permanent_nearest_area=$fetch_student_data['permanent_nearest_area'];
    $student_permanent_city=$fetch_student_data['permanent_city'];
    $student_permanent_desctric=$fetch_student_data['permanent_desctric'];
    $student_permanent_pincode=$fetch_student_data['permanent_pincode'];
    $student_permanent_state=$fetch_student_data['permanent_state'];
    $student_permanent_country=$fetch_student_data['permanent_country'];
    $student_permanent_post=$fetch_student_data['permanent_post'];
    
    
    $student_father_name=$fetch_student_data['father_name'];
    $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
    $student_father_email_id=$fetch_student_data['father_email'];
    $student_father_qualification=$fetch_student_data['father_qualification'];
    $student_father_occupation=$fetch_student_data['father_occupation'];
    $student_father_annual_income=$fetch_student_data['father_annual_income'];
    $student_father_photo=$fetch_student_data['father_photo'];
    
    if(empty($student_father_photo))
    {
    $student_father_photo="images/no_avilable_image.gif";    
    }  else {
      $student_father_photo=$student_father_photo;    
       
    }
    
    
    $student_mother_name=$fetch_student_data['mother_name'];
    $student_mother_mobile_no=$fetch_student_data['mother_mobile_no'];
    $student_mother_email_id=$fetch_student_data['mother_email_id'];
    $student_mother_qualification=$fetch_student_data['mother_qualification'];
    $student_mother_occupation=$fetch_student_data['mother_occupation'];
    $student_mother_annual_income=$fetch_student_data['mother_annual_income'];
    $student_mother_photo=$fetch_student_data['mother_photo'];
    
    
    if(empty($student_mother_photo))
    {
    $student_mother_photo="images/no_avilable_image.gif";    
    }  else {
      $student_mother_photo=$student_mother_photo;    
       
    }
    
    $student_local_parent_relation=$fetch_student_data['local_parent_relation'];
    $student_local_parent_name=$fetch_student_data['local_parent_name'];
    $student_local_parent_mobile_no=$fetch_student_data['local_parent_mobile_no'];
    $student_local_parent_email=$fetch_student_data['local_parent_email_id'];
    $student_local_parent_qualification=$fetch_student_data['local_parent_qualification'];
    $student_local_parent_occupation=$fetch_student_data['local_parent_occupation'];
    $student_local_parent_annual_income=$fetch_student_data['local_parent_annual_income'];
    $student_local_parent_photo=$fetch_student_data['local_parent_photo'];
    
    if(empty($student_local_parent_photo))
    {
    $student_local_parent_photo="images/no_avilable_image.gif";    
    }  else {
      $student_local_parent_photo=$student_local_parent_photo;    
       
    }
    
    
    $student_previous_class=$fetch_student_data['previous_class_name'];
    $student_core_subject=$fetch_student_data['previous_class_core_subject'];
    $student_board_university=$fetch_student_data['previous_class_board'];
    $student_passing_year=$fetch_student_data['previous_class_passing_year'];
    $student_per_of_marks=$fetch_student_data['previous_class_per_of_mark'];
    $student_extra_activities=$fetch_student_data['previous_class_extra_activities'];
    $student_school_name=$fetch_student_data['previous_class_school_name'];
    $student_school_address=$fetch_student_data['previous_class_school_address'];
    
    
    
    
    $library_account_status=$fetch_student_data['library_account'];
    $library_account_number=$fetch_student_data['library_account_no'];
    
    $student_hostel_id=$fetch_student_data['hostel_id'];
    $student_hostel_type_id=$fetch_student_data['hostel_type_id'];
    $student_hostel_room_id=$fetch_student_data['hostel_room_no'];
    
    $student_transport_route_id=$fetch_student_data['route_id'];
    $student_transport_vehicle_type_id=$fetch_student_data['vehicle_type_id'];
    $student_transport_vehicle_reg_no=$fetch_student_data['vehicle_reg_id'];
   
    
    $fetch_admission_document=$fetch_student_data['submitted_document'];
    $explode_document_explode=explode("@,@",$fetch_admission_document);
    $implode_document_attechment=implode(",",$explode_document_explode);
    
    $fetch_account_status=$fetch_student_data['account_status'];
    
    if($fetch_account_status=="active")
    {
    $account_status="inactive";    
    }else
        {
         $account_status="active";    
        }
            
        echo "    
       <div id='first_top_div_tags'>
    
       <div class='button_style' onclick='back_button()' style='background-color:orange;'>Back</div>";
    {
        ?>
       <a href="#" onclick="window.open('student_details_print.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=700,width=1050,position=absolute,left=100,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
                        
       <div class='button_style' style=" background-color:#4700B2; ">Print</div></a>
   
      <a href="#" onclick="window.open('addmision_form_print.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=700,width=1050,position=absolute,left=100,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       
       <div class='button_style' style='background-color:#3385FF;'>Admission Form Print</div></a>
       
      <?php 
        if($account_status=="active")
        {
            
        {
        ?>
      <div class='button_style' onclick="inactive_account('<?php  echo $admission_no;?>','<?php  echo $account_status;?>')" style='background-color:greenyellow; color:black; '>Account<?php  echo ucfirst($account_status);?></div>
     <?php 
        }
        }else
            if($account_status=="inactive")
        {
        {
?>
     <div class='button_style' id="student_account_status" onclick="inactive_account('<?php  echo $admission_no;?>','<?php  echo $account_status;?>')" style='background-color:#FF5050;'>Account<?php  echo ucfirst($account_status);?></div>
       
    <?php 
        }
        }
      ?>  
       <div class='button_style' onclick="delete_data('<?php  echo $admission_no;?>')" style='background-color:red;'>Delete</div></a>
       
       
       <a href="#" onclick="window.open('../admission/student_edit_profile.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=700,width=1200,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
       <div class='button_style' style='background-color:green;'>Edit</div></a>
      
  <?php 
    }
    echo"  
    
    
    </div>         
<br/>   
                <table cellspacing='0' cellpadding='0' class='admission_form_tables'>
                   
                    <tr>
                        <td colspan='9'><div class='heading_title'>Student Details</div></td>
                    </tr>
                     
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                        <td><b>Admission No.</b></td><td><b>:</b></td><td>$admission_no</td>
                        
                        <td><b>Form/Sr No.</b></td><td><b>:</b></td><td>$form_sr_no</td>
                        
                        <td><b>Roll No.</b></td><td><b>:</b></td><td>$student_roll_no</td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                        <td ><b>Admission Date</b></td><td><b>:</b></td>
                        <td>$student_admission_date</td>
                            
                        <td ><b>Status</b></td><td><b>:</b></td>
                        <td>".strtoupper($fetch_account_status)."</td>

                         <td ><b>Sub-Status</b></td><td><b>:</b></td>
                        <td>".strtoupper($student_sub_status)."</td>
                    </tr>
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Student Personal Details</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Class</b></td><td><b>:</b></td><td>$course_name</td>
                    
                    <td><b>Section</b></td><td><b>:</b></td><td>$section_name</td>
                    
                    <td><b>Session</b></td><td><b>:</b></td><td>$session_name</td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Student Name</b></td><td><b>:</b></td><td>$student_full_name</td>
                    
                    <td><b>Gender</b></td><td><b>:</b></td><td>$student_gender</td>
                    <td></td><td></td>
                    <td rowspan='9' style=' width:160px; '><img class='student_image' src='../$student_photo'></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Date Of Birth</b></td><td><b>:</b></td><td>$student_dob</td>
                    
                    <td><b>Blood Group</b></td><td><b>:</b></td><td> $student_blood_group</td>
                    <td></td><td></td>
                     </tr>
                     
                      <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Birth Place</b></td><td><b>:</b></td><td> $student_birth_place</td>
                    
                    <td><b>Nationality</b></td><td><b>:</b></td><td> $student_nationality</td>
                    <td></td><td></td>
                     </tr>
                     
                      <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Religion</b></td><td><b>:</b></td><td> $student_religion</td>
                    
                    <td><b>Mother Tongue</b></td><td><b>:</b></td><td> $student_mother_tongue</td>
                    <td></td><td></td>
                     </tr>
                     
                     <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                     <tr>
                    <td><b>Category</b></td><td><b>:</b></td><td> $category_name</td>
                    
                    <td><b>Sub Category</b></td><td><b>:</b></td><td> $student_sub_category</td>
                    <td></td><td></td>
                     </tr>
                      <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                     <tr>
                    <td><b>Student Mobile No</b></td><td><b>:</b></td><td> $student_mobile</td>
                    
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $student_email</td>
                    
                    <td><b>Handicapped</b></td><td><b>:</b></td><td> $studnet_handicapped</td>
                    </tr>
                    
                    
                     <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Parents Communicate Mobile No./Email id</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                 
                    <td><b>Communicate Mobile No.</b></td><td><b>:</b></td><td> $student_communicate_mobile_no</td>
                    
                    <td><b>Communicate Email ID</b></td><td><b>:</b></td><td> $student_communicate_email_id</td>
                           
                    </tr>
                    
                    
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Current Address Details</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Current Address</b></td><td><b>:</b></td><td colspan='4'> $student_current_address</td>
<td><b>Nearest Area</b></td><td><b>:</b></td><td> $student_current_nearest_area</td>
                                        
</tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                 
                    <td><b>City</b></td><td><b>:</b></td><td> $student_current_city</td>
                    
                    <td><b>District</b></td><td><b>:</b></td><td> $student_current_desctric</td>
                           <td><b>Post</b></td><td><b>:</b></td><td> $student_current_post</td>
                    
                    </tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Pin code</b></td><td><b>:</b></td><td> $student_current_pincode</td>
                    
                    <td><b>State</b></td><td><b>:</b></td><td> $student_current_state</td>
                    
                    <td><b>Country</b></td><td><b>:</b></td><td> $student_current_country</td>
                    </tr>
                    
                    
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Permanent Address Details</b></span></td>
                    </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Permanent Address</b></td><td><b>:</b></td><td colspan='4'> $student_permanent_address</td>
                    <td><b>Nearest Area</b></td><td><b>:</b></td><td> $student_permanent_post</td>
                                       
</tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    
                    <td><b>City</b></td><td><b>:</b></td><td> $student_permanent_city</td>
                    
                    <td><b>District</b></td><td><b>:</b></td><td> $student_permanent_desctric</td>
                        <td><b>Post</b></td><td><b>:</b></td><td> $student_permanent_nearest_area</td>
                    
                    </tr>
                    
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Pin code</b></td><td><b>:</b></td><td> $student_permanent_pincode</td>
                    
                    <td><b>State</b></td><td><b>:</b></td><td> $student_permanent_state</td>
                    
                    <td><b>Country</b></td><td><b>:</b></td><td> $student_permanent_country</td>
                    </tr>
                    
                    
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Parent Details ( Father Details )</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Father Name</b></td><td><b>:</b></td><td> $student_father_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $student_father_mobile_no</td>
                    <td></td><td></td>
                    <td rowspan='8' style=' width:160px; '><img class='student_image' src='../$student_father_photo'></td>
                    </tr>
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td>  $student_father_email_id</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $student_father_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $student_father_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $student_father_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Parent Details ( Mother Details )</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Mother Name</b></td><td><b>:</b></td><td> $student_mother_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $student_mother_mobile_no</td>
                    <td></td><td></td>
                    <td rowspan='8' style=' width:160px; '><img class='student_image' src='../$student_mother_photo'></td>
                    </tr>
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $student_mother_email_id</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $student_mother_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $student_mother_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $student_mother_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>";
                    
                    
                    
                    
                   if((!empty($student_local_parent_relation))&&(!empty($student_local_parent_name))) 
                   {
                    
                   echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Local Guardian Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Guardian Relation</b></td><td><b>:</b></td><td> $student_local_parent_relation</td>
                    
                    <td><b></b></td><td></td><td></td>
                    <td></td><td></td>
                    <td rowspan='10' style=' width:160px; '><img class='student_image' src='../$student_local_parent_photo'></td>
                    </tr>
                    
                     <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Guardian Name</b></td><td><b>:</b></td><td> $student_local_parent_name</td>
                    
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $student_local_parent_mobile_no</td>
                    <td></td><td></td>
                    
                    
                    
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $student_local_parent_email</td>
                    
                    <td><b>Qualification</b></td><td><b>:</b></td><td> $student_local_parent_qualification</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    
                    <tr>
                    <td><b>Occupation</b></td><td><b>:</b></td><td> $student_local_parent_occupation</td>
                    
                    <td><b>Annual Income</b></td><td><b>:</b></td><td> $student_local_parent_annual_income</td>
                    <td></td><td></td>
                    </tr>
                    <tr>
                        <td colspan='8'><div class='verticle_lines'></div></td>
                    </tr>";
                    
                   }
                    
                    
                   if((!empty($student_previous_class))&&($student_board_university))
                   {
                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Previous Class Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                    <td><b>Previous Class/Course</b></td><td><b>:</b></td><td> $student_previous_class</td>
                    
                    <td><b>Core Subject</b></td><td><b>:</b></td><td colspan='4'> $student_core_subject</td>
                    
                   </tr>
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                     <tr>
                    <td><b>Board/University</b></td><td><b>:</b></td><td> $student_board_university</td>
                    
                    <td><b>Passing Year</b></td><td><b>:</b></td><td>  $student_passing_year</td>
                    
                    <td><b>% Of Marks</b></td><td><b>:</b></td><td> $student_per_of_marks %</td>
                    </tr>
                    
                    <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                     <tr>
                    <td><b>Extra Curricular Activities</b></td><td><b>:</b></td><td> $student_extra_activities</td>
                    
                    <td><b>School/Collage Name</b></td><td><b>:</b></td><td colspan='4'> $student_school_name</td>
                    </tr>
                        <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                       <td><b>School/Collage Address</b></td><td><b>:</b></td><td colspan='7'> $student_school_address</td>
                       </tr>   
                       
                       ";
                    
                   }
                   
                   
                   if(!empty($implode_document_attechment))
                   {
                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b>Document Attachment/Submitted</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'>";
                       
                    $explode_document_attachment=explode(",", $implode_document_attechment);
                    $row_count=0;
                    foreach ($explode_document_attachment as $documnet_file)
                    {
                    $row_count++;
                    
                    
                    echo "<div style=' width:auto; height:auto; padding-right:15px; float:left;'><b>$row_count</b>.$documnet_file</div>";
                        
                    }
                    
                    
                    
                       echo"</td>
                    </tr>";
                   }
                    
                   
                   if((!empty($library_account_status))&&(!empty($library_account_number)))
                   {
                   
                   echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b> Library A/C Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
             
                     <tr>
                    <td><b>Library A/C Status</b></td><td><b>:</b></td><td>$library_account_status</td>
                    
                    <td><b>Library A/C No.</b></td><td><b>:</b></td><td>$library_account_number</td>
                    
                    <td><b></b></td><td></td><td></td>
                    </tr>";
                   }
                    
                   
                   if((!empty($student_hostel_id))&&($student_hostel_type_id))
                   {
                    
                       
                       echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b> Hostel Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Hostel Name</b></td><td><b>:</b></td><td>NUS</td>
                    
                    <td><b>Hostel Type</b></td><td><b>:</b></td><td>A</td>
                    
                    <td><b>Room Number</b></td><td><b>:</b></td><td>2015 - 2016</td>
                    </tr>";
                   }
                   
                   
                   
                    if((!empty($student_transport_route_id))&&(!empty($student_transport_vehicle_type_id)))
                    {
                        
                        
                    $route_db=  mysql_query("SELECT * FROM  transport_route_db WHERE organization_id='$fetch_school_id'
                     and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and route_id='$student_transport_route_id' and action='active'");    
                        
                   $fetch_route_data= mysql_fetch_array($route_db);
                   $fetch_route_num_rows=  mysql_num_rows($route_db);
                   if((!empty($fetch_route_data))&&($fetch_route_data!=null)&&($fetch_route_num_rows!=0))
                   {
                   $fetch_route_name=$fetch_route_data['route_name'];
                   
                   }else
                   {
                     $fetch_route_name="";  
                   }
                     
                   
                   $vehicle_type_db= mysql_query("SELECT * FROM  transport_vehicle_type_db WHERE organization_id='$fetch_school_id'
                     and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and vehicle_type_id='$student_transport_vehicle_type_id' and action='active'");    
                    $fetch_vehicle_data=mysql_fetch_array($vehicle_type_db);
                    $fetch_vehicle_type_num_rows=mysql_num_rows($vehicle_type_db);
                   if((!empty($fetch_vehicle_data))&&($fetch_vehicle_data!=null)&&($fetch_vehicle_type_num_rows!=0))
                   {
                    $fetch_vehicle_type_name=$fetch_vehicle_data['vehicle_type'];  
                   }else
                   {
                     $fetch_vehicle_type_name="";  
                   }
                   
                   
                   $fetch_vehicle_db=mysql_query("SELECT * FROM transport_vehicle_db WHERE organization_id='$fetch_school_id'
                     and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and vehicle_id='$student_transport_vehicle_reg_no' and action='active'");
                   $fetch_vehicle_datas=mysql_fetch_array($fetch_vehicle_db);
                   $fetch_vehicle_num_rows=  mysql_num_rows($fetch_vehicle_db);
                   if((!empty($fetch_vehicle_datas))&&($fetch_vehicle_datas!=null)&&($fetch_vehicle_num_rows!=0))
                   {
                    $vehicle_name= $fetch_vehicle_datas['vehicle_registration_no'];  
                   }else
                   {
                       $vehicle_name="";  
                   }
                        
                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    <tr>
                        <td colspan='9'><span><b> Transport Details</b></span></td>
                    </tr>
                     <tr>
                        <td colspan='9'><div class='verticle_lines'></div></td>
                    </tr>
                    
                    <tr>
                    <td><b>Route Name</b></td><td><b>:</b></td><td> $fetch_route_name</td>
                    
                    <td><b>Vehicle Type</b></td><td><b>:</b></td><td> $fetch_vehicle_type_name</td>
                    
                    <td><b>Vehicle Registration No.</b></td><td><b>:</b></td><td> $vehicle_name</td>
                    </tr>";
                    }
                    

                    echo"<tr>
                        <td><div class='height_maintain'></div></td>
                    </tr>
                    
                    
                   
                     
                    
                </table>
                   
                    ";
                    
        }
        }
         
    
    
    
    
}







?>
