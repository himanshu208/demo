<?php
//SESSION CONFIGURATION
require_once 'config/config.php';
if($connection_permission==1)
{
?>
<!DOCTYPE HTML>
<html>
<head>
<title>My Profile</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/lines.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<!-- Graph JavaScript -->
<script src="js/d3.v3.js"></script>
<script src="js/rickshaw.js"></script>
</head>
<body>
<div id="wrapper">
    <?php
    include_once 'header.php';
    include_once 'left_nav.php';
    ?>    
            
            
            <!-- /.navbar-static-side -->
       
        <div id="page-wrapper">
        <div class="graphs">
         
        <div class="title_heading">My Profile</div>
                
            
         <?php
    require_once '../connection.php';
         $student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as encrpt_id,T1.user_name as student_user_name"
                 . ",T1.temp_password as student_password,T6.user_name as parent_user_name"
                 . ",T6.temp_password as parent_password FROM student_db as T1"
                 . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                 . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                 . " LEFT JOIN session_db as T4 ON T1.session_id=T4.session_id "
                 . " LEFT JOIN category_db as T5 ON T1.category_id=T5.category_id "
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id"
                 . " LEFT JOIN student_previous_class_db as T8 ON T1.previous_class_id=T8.previous_class_unique_id"
                 . " LEFT JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id"
                 . " LEFT JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id "
                 . "LEFT JOIN house_db as T11 ON T1.house_id=T11.house_id WHERE "
                 . " T1.student_id='$user_unique_id' and T1.is_delete='none'");
         
         
         $fetch_student_data=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);
         if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
         {
  
         $student_db_id=$fetch_student_data['db_id'];
         $student_encrypt_id=$fetch_student_data['encrpt_id'];       
$db_id=$fetch_student_data['db_id'];    
$student_unqiue_id=$fetch_student_data['student_id'];

$form_sr_no=$fetch_student_data['sr_no'];
$admission_no=$fetch_student_data['admission_no'];
$student_roll_no=$fetch_student_data['roll_no'];       
$student_admission_date=$fetch_student_data['admission_date'];  
$enrollment_no=$fetch_student_data['enrollment_no'];  
$course_name=$fetch_student_data['course_name'];             
$section_name=$fetch_student_data['section_name'];
$session_name=$fetch_student_data['session_name'];
$category_name=$fetch_student_data['category_name'];
$house_name=ucwords($fetch_student_data['house_name']);
 
    $student_full_name=$fetch_student_data['student_full_name'];
    $student_gender=ucfirst($fetch_student_data['student_gender']);
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
    $sub_status=ucwords($fetch_student_data['sub_status']);
    $student_photo=$fetch_student_data['student_photo'];
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
    
    
    $student_hostel_id=$fetch_student_data['hostel'];
    $student_hostel_type_id=$fetch_student_data['hostel'];
    $student_hostel_room_id=$fetch_student_data['room'];
    
    $student_transport_route_id=$fetch_student_data['route'];
    $student_transport_vehicle_type_id=$fetch_student_data['vehicle_type'];
    $student_transport_vehicle_reg_no=$fetch_student_data['vehicle'];
   
    
    $fetch_admission_document=$fetch_student_data['submitted_document'];
    $explode_document_explode=explode("@,@",$fetch_admission_document);
    $implode_document_attechment=implode(",",$explode_document_explode);
    
    
    
    $transport_id=$fetch_student_data['transport_id'];
    $hostel_id=$fetch_student_data['hostel_id'];
    $health_card_id=$fetch_student_data['health_card_id'];
     $account=$fetch_student_data['account_status'];   
    if($account=="inactive")
    {
     $bg_color="yellowgreen";
     $account_value="active";
    }else
    {
      $bg_color="red";
     $account_value="inactive";   
    }
    
    $student_user_name=$fetch_student_data['student_user_name'];   
    $student_password=$fetch_student_data['student_password'];   
      
      echo "  
          
<div class='panel panel-warning' data-widget='{&quot;draggable&quot;: &quot;false&quot;}' data-widget-static=''>
				<div class='panel-body no-padding'>
					<table class='table table-striped'>
                                        <thead>
                                                <tr>
<td colspan='8'><div class='image_div'><img src='../$student_photo' /></div></td>                    
</tr>
</thead>
						<thead>
							<tr class='warning' >
								<th colspan='6'>Admission Details</th>
							</tr>
						</thead>
						<tbody>
                                              
			<tr>
			<td><b>Admission No.</b></td><td><b>:</b></td><td>$admission_no</td>
                        <td><b>Admission Date</b></td><td><b>:</b></td><td>$student_admission_date</td>
                        </tr>
<tr>
<td><b>Enrollment No</b></td><td><b>:</b></td><td>$enrollment_no</td>
<td><b>Roll No.</b></td><td><b>:</b></td><td>$student_roll_no</td>
</tr>                        
</tbody>
                                                       <thead>
							<tr class='warning' >
							<th colspan='6'>Student Personal Details</th>
							</tr>
						</thead>                                                

<tbody>
 <tr>
                    <td><b>Class</b></td><td><b>:</b></td><td>$course_name</td>
                    
                    <td><b>Section</b></td><td><b>:</b></td><td>$section_name</td>
                    
                   
                    </tr>
                    
                    <tr>
                     <td><b>Session</b></td><td><b>:</b></td><td>$session_name</td>
                         
                    <td><b>House</b></td><td><b>:</b></td><td>$house_name</td>
                    
                    </tr>
                   
                    <tr>
                    <td><b>Student Name</b></td><td><b>:</b></td><td>$student_full_name</td>
                    
                    <td><b>Gender</b></td><td><b>:</b></td><td>$student_gender</td>
                    
                    </tr>
                   
                     <tr>
                    <td><b>Date Of Birth</b></td><td><b>:</b></td><td>$student_dob</td>
                    
                    <td><b>Blood Group</b></td><td><b>:</b></td><td> $student_blood_group</td>
                    
                     </tr>
                     
                    
                     <tr>
                    <td><b>Birth Place</b></td><td><b>:</b></td><td> $student_birth_place</td>
                    
                    <td><b>Nationality</b></td><td><b>:</b></td><td> $student_nationality</td>
                   
                     </tr>
                     
                   
                     <tr>
                    <td><b>Religion</b></td><td><b>:</b></td><td> $student_religion</td>
                    
                    <td><b>Mother Tongue</b></td><td><b>:</b></td><td> $student_mother_tongue</td>
                  
                     </tr>
                     
                  
                     <tr>
                    <td><b>Category</b></td><td><b>:</b></td><td> $category_name</td>
                    
                    <td><b>Sub Category</b></td><td><b>:</b></td><td> $student_sub_category</td>
                    
                     </tr>
                     
                    
                    
                     <tr>
                    <td><b>Student Mobile No</b></td><td><b>:</b></td><td> $student_mobile</td>
                    
                    <td><b>Email Id</b></td><td><b>:</b></td><td> $student_email</td>
                    
                  </tr>
                    
<tr>
  <td><b>Handicapped</b></td><td><b>:</b></td><td> $studnet_handicapped</td>
                    <td colspan='3'></td>
</tr>
<tr><td></td></tr>
</tbody>
                 
                                                <thead>
							<tr class='warning' >
							<th colspan='6'>Account Login Details</th>
							</tr>
						</thead> 
                                                <tbody>
                  
                      <tr>
                    <td><b>Username</b></td><td><b>:</b></td><td>$student_user_name</td>
                    
                    <td><b>Password</b></td><td><b>:</b></td><td> $student_password</td>
                    
                     </tr>
                     <tr><td></td></tr>
                   </tbody>
                   
                                                  <thead>
							<tr class='warning' >
							<th colspan='6'>Address Details</th>
							</tr>
						</thead> 

<tbody>
 <tr>
                    <td><b>Address 1</b></td><td><b>:</b></td><td colspan='4'> $student_permanent_address</td>
                   
                   
                    </tr>
 <tr>
 <td><b>Address 2</b></td><td><b>:</b></td><td colspan='4'> $student_current_address</td>                                    
</tr>
                    
                    <tr>
                    
                    <td><b>City</b></td><td><b>:</b></td><td> $student_current_city</td>
                    
                    <td><b>District</b></td><td><b>:</b></td><td> $student_current_desctric</td>
                                           

                    </tr>
                    <tr>
<td><b>Post</b></td><td><b>:</b></td><td> $student_current_post</td>
   <td><b>Pin code</b></td><td><b>:</b></td><td> $student_current_pincode</td>
                                        
</tr>
                    
                    
                    <tr>
                   
                    <td><b>State</b></td><td><b>:</b></td><td> $student_current_state</td>
                    
                    <td><b>Country</b></td><td><b>:</b></td><td> $student_current_country</td>
                    </tr>
                  <tr><td></td></tr>  
</tbody>

 <thead>
							<tr class='warning' >
							<th colspan='6'>Parents Details</th>
							</tr>
						</thead> 
<tbody>
                    <tr>
                    <td><b>Father Name</b></td><td><b>:</b></td><td> $student_father_name</td>
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $student_father_mobile_no</td>
                    </tr>
                    
                    <tr>
                    <td><b>Mother Name</b></td><td><b>:</b></td><td> $student_mother_name</td>
                    <td><b>Mobile No.</b></td><td><b>:</b></td><td> $student_mother_mobile_no</td>
                   </tr>
                    
</tbody>";
       if((!empty($student_previous_class))&&($student_board_university))
                   {
      
                                                  echo"<thead>
							<tr class='warning' >
							<th colspan='6'>Previous Qualification Details</th>
							</tr>
						</thead> 
                                                
<tbody>
<tr>
                    <td><b>Previous Class/Course</b></td><td><b>:</b></td><td> $student_previous_class</td>
                    
                    <td><b>Core Subject</b></td><td><b>:</b></td><td> $student_core_subject</td>
                    
                   </tr>
                   
                     <tr>
                    <td><b>Board/University</b></td><td><b>:</b></td><td> $student_board_university</td>
                    
                    <td><b>Passing Year</b></td><td><b>:</b></td><td>  $student_passing_year</td>
                    
                    </tr>
                    
                     <tr>
                     <td><b>% Of Marks</b></td><td><b>:</b></td><td> $student_per_of_marks %</td>
                    
                    <td><b>Extra Curricular Activities</b></td><td><b>:</b></td><td> $student_extra_activities</td>
                    </tr>
                    <tr>
                    <td><b>School/Collage Name</b></td><td><b>:</b></td><td colspan='6'> $student_school_name</td>
                    
</tr>
                      
                    <tr>
                       <td><b>School/Collage Address</b></td><td><b>:</b></td><td colspan='6'> $student_school_address</td>
                       </tr>   
</tbody>";
                   }


					echo"</table>
				</div>
	</div>
               
                    ";
           
         }
         ?>   
            
            
     	
		<?php
    include_once 'footer.php';
                ?>
		</div>
       </div>
   
   </div>
   
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>