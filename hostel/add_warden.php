<?php
//SESSION CONFIGURATION
$check_array_in="hostel";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php 
$message_show="";
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
if(isset($_POST['submit_process']))
{
 
if(!empty($_POST['is_employee']))
{
$is_employee=$_POST['is_employee'];
$employee_id=$_POST['employee_id'];

if(($is_employee=="yes")&&(empty($employee_id)))
{
   $a=0; 
}else
{
 $a=1;   
}

}else
{
$is_employee="no";
$employee_id=0;
$a=1;
}

if(!empty($a))
{

    
    


         $first_name=$_POST['first_name'];
         $gender=$_POST['gender'];
         $dob=$_POST['dob'];
         $father_name=$_POST['father_name'];
         $mobile_no=$_POST['mobile_number'];
         $email=$_POST['email'];
         $married_status=$_POST['married_status'];
         $address=$_POST['address'];
         $description=$_POST['description'];
         
$insert_session_id=$_POST['use_inset_session_id'];
$result=mysql_query("SHOW TABLE STATUS LIKE 'hostel_warden_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_warden_id="WARDEN_$nextId"; 
$encrypt_id=md5(md5($final_warden_id));
  
  
 if((!empty($final_warden_id))&&(!empty($first_name))&&(!empty($gender))
         &&(!empty($dob))&&(!empty($father_name))&&(!empty($married_status))&&(!empty($address))&&(!empty($mobile_no))&&(!empty($insert_session_id)))
 {
  
$select_db=mysql_query("SELECT * FROM hostel_warden_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and warden_unique_id='$final_warden_id' and is_delete='none'"
        . " OR organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and is_employee='no' and employee_unique_id='0' and "
        . "warden_name='$first_name' and father_name='$father_name' and is_delete='none' OR organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and "
        . "mobile_no='$mobile_no' and is_delete='none'"); 
$fecth_data=mysql_fetch_array($select_db);
$fecth_num_rows=mysql_num_rows($select_db);
if((empty($fecth_data))&&($fecth_data==null)&&($fecth_num_rows==0))
{
  $b=1;
        $filename=$_FILES['employee_photo']['name'];
        $tmpfilename=$_FILES['employee_photo']['tmp_name'];
          if(!empty($filename))
          {
        $imagesize=getimagesize($tmpfilename);
        if (!empty($imagesize)) {
            date_default_timezone_set('Asia/Calcutta'); 
             $time = mktime();
            $random = rand(1000, 5000);
            $location ="crud_images/employee/". $random . $time . $filename;
            $templocation= "crud_images/employee/". $random . $time;
            $upload=move_uploaded_file($tmpfilename, "../$location");
            if($upload)
            {
             $location=$location;   
            }else
            {
             $location="";   
            }
        }else 
        {
        $b=0;
        }
         }else 
          {
          $location="";
          }
    
          $c=1;
          $filename1=$_FILES['document_file']['name'];
        $tmpfilename1=$_FILES['document_file']['tmp_name'];
          if(!empty($filename1))
          {
        
            date_default_timezone_set('Asia/Calcutta'); 
             $time = mktime();
            $random = rand(1000, 5000);
            $location1 ="crud_images/document/". $random . $time . $filename1;
            $templocation1= "crud_images/document/". $random . $time;
            $upload1=move_uploaded_file($tmpfilename1, "../$location1");
            if($upload1)
            {
             $location1=$location1;   
            }else
            {
             $location1="";   
            }
       
         }else 
          {
          $location1="";
          }
    
    if(!empty($b))
    {
        if(!empty($c))
        {
        $insert_db=mysql_query("INSERT into hostel_warden_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
         . ",'$final_warden_id','$encrypt_id','$is_employee','$employee_id','$first_name','$gender','$dob','$father_name','$mobile_no'"
         . ",'$email','$married_status','$address','$location1','$location','$description','none','$date','$date_time'"
         . ",'$fecth_user_unique','active')");   
    
if((!empty($insert_db))&&($insert_db))
{
 $message_show="<div class='notification_alert_show' style='color:green;'>Record save successfully complete.</div>";
     
}else
{
  $message_show="<div class='notification_alert_show'>Request failed,Please try again.</div>";
    
}
}else
    {
     $message_show="<div class='notification_alert_show'>Invalid document</div>";
       
    }
    }else
    {
     $message_show="<div class='notification_alert_show'>Invalid profile photo</div>";
       
    }

}  else {
   $message_show="<div class='notification_alert_show'>Record already exist in database.</div>";
  
}
     
     
 

 }  else {
    $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
  
 }
}else
{
  $message_show="<div class='notification_alert_show'>Please select employee</div>";
     
}
 require_once '../pop_up.php';
}


?>





<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Warden</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validate_form() 
        {
        var first_name=document.getElementById("first_name").value;   
        var dob=document.getElementById("dob").value;
        var mobile_no=document.getElementById("mobile_number").value;
        var father_name=document.getElementById("father_name").value;
        var address=document.getElementById("address").value;
        var exist_employee=document.getElementById("exist_employee").checked;
        var employee_id=document.getElementById("employee_id").value;
        if(exist_employee==true)
        {
          if(employee_id==0)
          {
             alert("Please select employee");
             document.getElementById("employee_id").focus();
             return false;
          }
        }
        
        if(first_name==0)
        {
           alert("Please enter warden name");
           document.getElementById("first_name").focus();
           return false;
        }else
            if(dob==0)
        {
           alert("Please enter date of birth");
           document.getElementById("dob").focus();
           return false;
        }else
            if(father_name==0)
        {
           alert("Please enter father name");
           document.getElementById("father_name").focus();
           return false;   
        }else
            if(mobile_no==0)
        {
           alert("Please enter mobile number");
           document.getElementById("mobile_number").focus();
           return false;
        }else
            if(isNaN(mobile_no))
        {
          alert("Please enter valid mobile number");
          document.getElementById("mobile_number").focus();
          return false;
        }else
            if(address==0)
        {
           alert("Please enter address");
           document.getElementById("address").focus();
           return false;
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
                           <td><a href="hostel_dashboard.php">Hostel</a></td>
                           <td>/</td>
                           <td><a href="hostel_setting.php">Hostel Setting</a></td>
                           <td>/</td>
                           <td>Add Warden</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Warden</b></div>
                    <a href="view_warden_list.php">
                        <div class="view_button">View Warden Details</div></a>
                </div>
                
               <script type="text/javascript">
               function check_radio(radio_value)
               {
                 if(radio_value=="new_warden")
                 {
                 document.getElementById("employee_search").style.display="none";     
                 }else
                 if(radio_value=="exist_employee")
                 {
                   document.getElementById("employee_search").style.display="block";     
                   
                 }
                 
                 
               }
               </script>
                
               <div class="middle_left_div_tag">
                   <table class="table_middle" style=" margin-top:20px; ">
                    
                       <tr>
                           <td><br/></td>
                       </tr>
                       <tr>
                           <td colspan="3">
                               <table style="width:270px;   margin: 0 auto; border:1px solid whitesmoke; background-color:whitesmoke;
                                     border:1px solid silver; padding-left:20px;    ">
                                   <tr>
                                       <td><input name="is_employee" value="no" onclick="check_radio('new_warden')" type="radio" checked></td><td><b>New Warden</b></td>
                                       <td><input name="is_employee" id="exist_employee" value="yes" onclick="check_radio('exist_employee')" type="radio"></td><td><b>Exist Employee</b></td>
                                   </tr>
                               </table>   
                           </td>
                       </tr>
                        <tr>
                           <td><br/></td>
                       </tr>
                       <tr>
                           <td colspan="3">
                             
                               <div id="employee_search" style="display:none; ">
                                   <table style=" width:100%; ">
                                       <tr>
                                           <td><b>Department</b></td><td><b>:</b></td>
                                           <td><select name="department" id="department" class="select_filter">
                                                   <option value="0">--- Select Department ---</option>
                                               </select></td>
                                               <td style=" width:40px; "></td>
                                               <td>Employee</td><td><b>:</b></td>
                                               <td><select name="employee_id" id="employee_id" class="select_filter">
                                                       <option value="0">--- Select Employee ---</option>
                                                   </select></td>
                                               
                                       </tr>
                                   </table>    
                               </div>     
                           </td>
                       </tr>
                         <tr>
                           <td><br/></td>
                       </tr>
                   </table>
                   
                   
                   <table cellsapcing="4" cellpadding="4" class="table_middle" style=" font-size:12px; ">
                       <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                       <tr>
                       <td>Warden Name <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="first_name" name="first_name" placeholder="Please enter warden name" class="text_box_class"></td>
                       </tr>
                      
                       <tr>
                       <td>Gender <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <table>
                               <tr>
                                   <td><input type="radio" name="gender" value="male" checked></td><td>Male</td>
                                   <td><input type="radio" name="gender" value="female"></td><td>Female</td>
                                   <td><input type="radio" name="gender" value="other"></td><td>Other</td>
                               </tr>
                           </table>   
                       </td>
                       </tr>
                        <tr>
                       <td>Date of Birth <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="dob" name="dob" placeholder="Please enter date of birth" class="text_box_class"></td>
                       </tr>
                       <tr>
                       <td>Father Name <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="father_name" name="father_name" placeholder="Please enter father name" class="text_box_class"></td>
                       </tr> 
                       <tr>
                       <td>Mobile Number <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" id="mobile_number" name="mobile_number" placeholder="Please enter warden mobile number" class="text_box_class"></td>
                       </tr>
                       
                        <tr>
                       <td>Email</td>
                       <td><b>:</b></td>
                       <td><input type="text" id="email" name="email" placeholder="Enter email" class="text_box_class"></td>
                       </tr>
                       
                       <tr>
                       <td>Married Status <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <table>
                               <tr>
                                   <td><input type="radio" name="married_status" value="married" checked></td><td>Married</td>
                                   <td><input type="radio" name="married_status" value="unmarried"></td><td>Unmarried</td>
                                 
                               </tr>
                           </table>   
                       </td>
                       </tr>
                       <tr>
                           <td>Address <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><textarea id="address" name="address" placeholder="Please enter address" class="text_area_class"></textarea></td>
                       </tr>
                       <tr>
                             <td>Document</td>
                       <td><b>:</b></td>
                       <td><input type="file" id="document_file" name="document_file"></td>
                       </tr>
                        <tr>
                             <td>Profile Photo</td>
                       <td><b>:</b></td>
                       <td><input type="file" id="employee_photo" name="employee_photo"></td>
                       </tr>
                       <tr>
                       <td>Description </td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"></textarea></td>
                       </tr>
                       
                       
                       <tr>
                           <td colspan="3">
                              <input type="submit" class="submit_process" name="submit_process" value="Save"> 
                               
                               
                               <input type="reset" class="reset_process" name="reset_process" value="Reset">
                               
                           </td>
                       </tr>
                   </table>    
                   
               </div>
               <div style=" width:20%; height:100px; float:left;  "></div>
             
                
                
               
            </div> 
        </div>
        <script type="text/javascript" src="../javascript/next_javascript.js"></script>
         <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
       
             <script type="text/javascript">
      
$(function() {
$("#dob").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      yearRange:'1920:2016',
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
});
    </script>
        
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