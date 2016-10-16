<?php 
require_once '../connection.php';
if((!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
 $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $class_id=$_REQUEST['class_id'];
 
 echo "<div id='section_record'>
<option value='0'>-- Select --</option>     
";
 $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$organization_id'
     and branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and action='active'");
 while ($fetch_section_data= mysql_fetch_array($section_db))
 {
   $fetch_section_id=$fetch_section_data['section_id'];
   $fetch_section_name=$fetch_section_data['section_name'];
   echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
 }
 if(empty($fetch_section_id))
 {
   echo "<option value='0'>Record no found $branch_id $organization_id !!</option>";
 }
    
 echo "</div><div id='student_data'>";
$student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' 
    and branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id'");
while ($fetch_student_data=mysql_fetch_array($student_db))
{
    $fetch_student_id=$fetch_student_data['student_id'];
    $fetch_student_name=$fetch_student_data['student_full_name'];
    $fetch_father_name=$fetch_student_data['father_name'];
    $fetch_student_roll_no=$fetch_student_data['roll_no'];
    $fetch_father_mo_no=$fetch_student_data['father_mobile_no'];
    $fetch_student_gender=ucfirst($fetch_student_data['student_gender']);
   {?> 
 <li onclick="student_record('<?php  echo $fetch_student_id;?>','<?php  echo $fetch_student_name;?>')">
  <?php 
   }
     echo "<input style='float:left;' name='studnet_name_id' value='$fetch_student_id' type='checkbox'>
   <a style='font-size:0px;'>$fetch_student_id</a><p class='student_search'>$fetch_student_name So/ $fetch_father_name</p>
   
   <input type='hidden' id='print_student_name_$fetch_student_id' value='$fetch_student_name'>
   <input type='hidden' id='print_father_name_$fetch_student_id' value='$fetch_father_name'>
   <input type='hidden' id='print_father_mobile_no_$fetch_student_id' value='$fetch_father_mo_no'>
   <input type='hidden' id='print_admission_no_$fetch_student_id' value='$fetch_student_id'>
   <input type='hidden' id='print_student_roll_no_$fetch_student_id' value='$fetch_student_roll_no'>
   <input type='hidden' id='print_student_gender_$fetch_student_id' value='$fetch_student_gender'>
   
    </li>"; 
    
    
}
if(empty($fetch_student_id))
{
    echo "<li style='color:red; text-align:center;'><p>Record no found !!</p></li>"; 
}

echo"</div>"; 
    
    
    
}





if((!empty($_REQUEST['class_id']))&&(!empty($_REQUEST['section_id']))&&(!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id'])))
{
 $organization_id=$_REQUEST['org_id'];
 $branch_id=$_REQUEST['branch_id'];
 $session_id=$_REQUEST['session_id'];
 $class_id=$_REQUEST['class_id'];
 $section_id=$_REQUEST['section_id'];
 echo "<div id='student_data'>";
$student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' 
    and branch_id='$branch_id' and session_id='$session_id' and course_id='$class_id' and section_id='$section_id'");
while ($fetch_student_data=mysql_fetch_array($student_db))
{
   $fetch_student_id=$fetch_student_data['student_id'];
    $fetch_student_name=$fetch_student_data['student_full_name'];
    $fetch_father_name=$fetch_student_data['father_name'];
    $fetch_student_roll_no=$fetch_student_data['roll_no'];
    $fetch_father_mo_no=$fetch_student_data['father_mobile_no'];
    $fetch_student_gender=ucfirst($fetch_student_data['student_gender']);
   {?> 
 <li onclick="student_record('<?php  echo $fetch_student_id;?>','<?php  echo $fetch_student_name;?>')">
  <?php 
   }
     echo "<input style='float:left;' name='studnet_name_id' value='$fetch_student_id' type='checkbox'>
   <a style='font-size:0px;'>$fetch_student_id</a><p class='student_search'>$fetch_student_name So/ $fetch_father_name</p>
   
   <input type='hidden' id='print_student_name_$fetch_student_id' value='$fetch_student_name'>
   <input type='hidden' id='print_father_name_$fetch_student_id' value='$fetch_father_name'>
   <input type='hidden' id='print_father_mobile_no_$fetch_student_id' value='$fetch_father_mo_no'>
   <input type='hidden' id='print_admission_no_$fetch_student_id' value='$fetch_student_id'>
   <input type='hidden' id='print_student_roll_no_$fetch_student_id' value='$fetch_student_roll_no'>
   <input type='hidden' id='print_student_gender_$fetch_student_id' value='$fetch_student_gender'>
   
    </li>"; 
    
    
}
if(empty($fetch_student_id))
{
    echo "<li style='color:red; text-align:center;'><p>Record no found !!</p></li>"; 
}

echo"</div>"; 
    
    
    
}







//fee payament advance search  student
if((!empty($_REQUEST['org_id']))&&(!empty($_REQUEST['branch_id']))&&(!empty($_REQUEST['session_id']))
        &&(!empty($_REQUEST['search_by']))&&(!empty($_REQUEST['search_qq'])))

{
    $organization_id=$_REQUEST['org_id'];
    $branch_id=$_REQUEST['branch_id'];
    $session_id=$_REQUEST['session_id'];
    $search_by=$_REQUEST['search_by'];
    $search_qq_temp=trim($_REQUEST['search_qq']);
$search_qq=preg_replace('/\s+/', ' ',$search_qq_temp); 

    
    
    
    $student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$organization_id' 
    and branch_id='$branch_id' and session_id='$session_id' and $search_by LIKE '%$search_qq%' ORDER BY student_full_name ASC");
while ($fetch_student_data=mysql_fetch_array($student_db))
{
    $fetch_student_id=$fetch_student_data['student_id'];
    $fetch_student_name=$fetch_student_data['student_full_name'];
    $fetch_father_name=$fetch_student_data['father_name'];
    $fetch_student_roll_no=$fetch_student_data['roll_no'];
    $fetch_father_mo_no=$fetch_student_data['father_mobile_no'];
    $fetch_student_gender=ucfirst($fetch_student_data['student_gender']);
   {?> 
 <li onclick="student_record('<?php  echo $fetch_student_id;?>','<?php  echo $fetch_student_name;?>')">
  <?php 
   }
     echo "
   <a style='font-size:0px;'>$fetch_student_id</a><p class='student_search'>$fetch_student_name So/ $fetch_father_name</p>
   
   <input type='hidden' id='print_student_name_$fetch_student_id' value='$fetch_student_name'>
   <input type='hidden' id='print_father_name_$fetch_student_id' value='$fetch_father_name'>
   <input type='hidden' id='print_father_mobile_no_$fetch_student_id' value='$fetch_father_mo_no'>
   <input type='hidden' id='print_admission_no_$fetch_student_id' value='$fetch_student_id'>
   <input type='hidden' id='print_student_roll_no_$fetch_student_id' value='$fetch_student_roll_no'>
   <input type='hidden' id='print_student_gender_$fetch_student_id' value='$fetch_student_gender'>
   
    </li>"; 
    
    
}
if(empty($fetch_student_id))
{
    echo "<li style='color:red; text-align:center;'><p>Record no found !!</p></li>"; 
}
    
    
    
}
