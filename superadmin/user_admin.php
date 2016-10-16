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
  if((!empty($fetch_module_date))&&($fetch_module_date!=null)&&($fetch_module_num_rows!=0))
  {   
  $user_admin_db=mysql_query("SELECT * FROM login_user_db WHERE organization_id='$fetch_school_id'
          and branch_id='$fetch_branch_id' and account_type='branch_head_admin'");
  $fetch_branch_admin_data=mysql_fetch_array($user_admin_db);
  $fetch_branch_admin_num_rows=mysql_num_rows($user_admin_db);
  if((empty($fetch_branch_admin_data))&&($fetch_branch_admin_data==null)&&($fetch_branch_admin_num_rows==0))
  {
    require_once '../connection.php';
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

$message_show="";
if(isset($_POST['submit_data_process']))
{
    
    
 $static_id="LGINUSER";    
 $add_one_no=1;   
 $school_org_db=mysql_query("SELECT * FROM login_user_db WHERE id ORDER BY id DESC");
 $fetch_school_org_record=mysql_fetch_array($school_org_db);
 $fetch_school_num_rows=mysql_num_rows($school_org_db);
  if((!empty($fetch_school_org_record))&&($fetch_school_org_record!=null)&&($fetch_school_num_rows!=0))
  {
   $fetch_id=$fetch_school_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_school_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_school_id=$static_id."_".$add_one_no;   
  }
    
    $branch_id=$_POST['branch_id'];
    $account_type=$_POST['account_type'];
    $joining_date=$_POST['joining_date'];
    $full_name=$_POST['full_name'];
    $father_name=$_POST['father_name'];
    $gender=$_POST['admin_gender'];
    $date_of_birth=$_POST['date_of_birth'];
    $mobile_number=$_POST['mobile_number'];
    $email_id=$_POST['email_id'];
    $qualification_details=$_POST['qualification_details'];
    $address=$_POST['address'];
    $private_note=$_POST['private_note'];
   
    
    $user_name=$_POST['user_name'];
    $new_password=$_POST['new_password'];
    $retype_password=$_POST['retype_password'];
     $temp_password=$new_password;
    if((!empty($full_name))&&(!empty($father_name))&&(!empty($gender))&&(!empty($mobile_number))
            &&(!empty($email_id))&&(!empty($address))&&(!empty($user_name))&&(!empty($new_password))&&(!empty($retype_password)))
    {
    if($new_password==$retype_password)
    {   
     $match_user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$final_school_id'
             OR user_name='$user_name' OR mobile_number='$mobile_number' OR email_id='$email_id'");
     $fetch_user_data=  mysql_fetch_array($match_user_db);
     $fetch_user_num_rows=  mysql_num_rows($match_user_db);
     if((empty($fetch_user_data))&&($fetch_user_data==null)&&($fetch_user_num_rows==0)) 
     {
      $encrypt_id=md5(md5($final_school_id));
      if((!empty($_FILES['report_logo']))) 
       {                    
        
        $filename= $_FILES['report_logo']['name'];
        $tmpfilename = $_FILES['report_logo']['tmp_name'];
        $filesize = $_FILES['report_logo']['size'];
       
        if((!empty($filename)))
        { 
        if(($filesize<153600))
         {
        $imagesize=getimagesize($tmpfilename);
       
        if ((!empty($imagesize))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location="images/user_image/". $random . $time . $filename;
            $templocation= "images/user_image/". $random . $time;
            $upload= move_uploaded_file($tmpfilename,"../".$location);
             
          
      if(($upload))
      {  
      $insert_image=$location;
      
      }else  $message_show="Request failed,please try again";
      }else  $message_show="Invalid picture format";
      }else  $message_show="Picture size should be below 150kb";
      }else  
      {
          $insert_image="";
      }
      }else {
          $insert_image="";
      }
       $password_static="AMITBHATI_1"; 
       $both_password=$new_password.$password_static;
      $password_encrypt=md5(md5(md5($both_password)));
      
      $insert_user_db=mysql_query("INSERT into login_user_db values('','$fetch_school_id','$branch_id','$final_school_id'
              ,'$encrypt_id','$user_name','$password_encrypt','$temp_password','$account_type','$joining_date','$full_name','$father_name','$gender','$date_of_birth'
              ,'$mobile_number','$email_id','$qualification_details','$address','$private_note','$insert_image','none'
              ,'$date','$date_time','active')");   
         
       if($insert_user_db)
       {
            unset($_SESSION['super_admin_session_on']);
            
           if((!isset($_SESSION['super_admin_session_on'])))
           {
               header("Location:../loginPage.php");   
           }
       {
        $message_show="Request failed,Please try again.";       
       }
           
           
       }else
       {
        $message_show="Request failed,Please try again.";       
       }
         
         
         
     }else
     {
       $message_show="Sorry,Record already exist in database, Please Check Your email, mobile no. and username.";    
     }
        
        
    }else
    {
       $message_show="New password & re-type password did`t match."; 
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
        <title></title>
        <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
          <script>
      function org_validate()
      {
          var full_name=document.getElementById("sap_name").value;
          var father_name=document.getElementById("sap_father_name").value;
          var gender=document.getElementById("admin_gender").value;
          var mobile_no=document.getElementById("sap_mobile_no").value;
          var email_id=document.getElementById("sap_email_id").value;
          var address=document.getElementById("sap_address").value;
          var user_name=document.getElementById("sap_user_name").value;
          var new_password=document.getElementById("sap_new_password").value;
          var retype_password=document.getElementById("sap_retype_password").value;
         var emailfilter=/^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i
          var b=emailfilter.test(email_id);
          
       if(full_name==0)
           {
            alert("Please enter full name");
            document.getElementById("sap_name").focus();
           return false; 
           }else
               if(father_name==0)
           {
            alert("Please enter father name");
            document.getElementById("sap_father_name").focus();
           return false; 
           }else
               if(gender==0)
           {
            alert("Please select gender");
            document.getElementById("admin_gender").focus();
           return false; 
           }else
               if(mobile_no==0)
           {
            alert("Please enter mobile number");
            document.getElementById("sap_mobile_no").focus();
           return false; 
           }else
                if(isNaN(mobile_no))
{
alert("Please enter the valid mobile number (Like : 9899176775)");
document.getElementById("sap_mobile_no").focus();
return false;
}
if((mobile_no.length < 1) || (mobile_no.length > 12) || (mobile_no.length < 10))
{
alert("Please enter mobile number must be 10 integers");
document.getElementById("sap_mobile_no").focus();
return false;
}else
               if(email_id==0)
           {
            alert("Please enter email id");
            document.getElementById("sap_email_id").focus();
           return false; 
           }else
         if(b==false)
{
alert("Please enter valid email id");
document.getElementById("sap_email_id").focus();
return false;
}else
    if(user_name==0)
        {
          alert("Please enter username");
document.getElementById("sap_user_name").focus();
return false;  
        }else
    if(new_password==0)
        {
          alert("Please enter new password");
document.getElementById("sap_new_password").focus();
return false;  
        }else
    if(retype_password==0)
        {
          alert("Please enter re-type password");
document.getElementById("sap_retype_password").focus();
return false;  
        }else
            if(new_password!=retype_password)
                {
                alert("New password and Re-type password did`t match.");  
                document.getElementById("sap_retype_password").focus();
                return false;
                }
       
      }
      </script>
      
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
$("#user_dob").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
       yearRange: '1920:2010',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
    $("#joining_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
   
});
    </script>
    </head>
    <body>
     
        <div id="include_header_page">
       <?php 
            include_once 'header_page.php';
         ?>   
        </div>
        <div id="main_work_div">
         <div id="middle_work_div_org">
                 <form action="" onsubmit="return org_validate();" method="post" enctype="multipart/form-data">
       
                <table cellspacing="2" cellpadding="2" id="org_table_style">
                    <?php
                     echo  $message_show;
                    ?>
					<tr><td colspan="4"> <span style=" color:#01baad; font-size:18px; font-weight:bold;">Add Branch Admin Details <br/>
 <br/></span></td></tr>
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                                    <td><b>School Name</b><sup>*</sup></td>
                                    <td><b>:</b></td>
                                    <td><input type="text" autocomplete="off" id="school_name"
                                   placeholder="Enter school name" class="text_box_org"
                                   name="school_name" readonly="readonly" value="<?php  echo $fetch_school_name;?>"></td>
                              
                                    <td><b>Branch</b> <sup>*</sup></td>
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
                                    <td>
                                        <b>Admin Role</b> <sup>*</sup>  
                                    </td>
                                    <td>
                                        <b>:</b>
                                    </td>
                                    <td>
                                        <select name="account_type" class="select_style">
                                            <option value="branch_head_admin">Branch Head Admin</option>
                                        </select>
                                    </td>
                        <td><b>Joining Date</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="joining_date"
                                   placeholder="Enter joining date" class="text_box_org"
                                   name="joining_date" value="<?php echo $date;?>"></td>
                    
                                </tr>
                                <tr><td><b>Full Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_name"
                                   placeholder="Enter full name" class="text_box_org"
                                   name="full_name" value="<?php  if(isset($_POST['full_name'])){ echo $_POST['full_name'];}?>"></td>
                   <td><b>Father Name</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_father_name"
                                   placeholder="Enter father name" class="text_box_org"
                                   name="father_name" value="<?php  if(isset($_POST['father_name'])){ echo $_POST['father_name'];}?>"></td>
                    </tr>
                    <tr><td><b>Gender</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select class="select_style" id="admin_gender" name="admin_gender">
                                <option>Male</option>   
                                <option>Female</option> 
                                <option>Other</option>   
                            </select></td>
                            <td><b>Date Of Birth</b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off"  id="user_dob"
                                   placeholder="Enter date of birth" class="text_box_org"
                                   name="date_of_birth" value="<?php  if(isset($_POST['date_of_birth'])){ echo $_POST['date_of_birth'];}?>"></td>
                    </tr>
                    <tr><td><b>Mobile Number</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_mobile_no"
                                   placeholder="Enter mobile number" class="text_box_org"
                                   name="mobile_number" value="<?php  if(isset($_POST['mobile_number'])){ echo $_POST['mobile_number'];}?>"></td>
                    <td><b>Email</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_email_id"
                                   placeholder="Enter email address" class="text_box_org"
                                   name="email_id" value="<?php  if(isset($_POST['email_id'])){ echo $_POST['email_id'];}?>"></td>
                    </tr>
                    <tr>
                        <td><b>Qualification</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea 
                               autocomplete="off" class="text_area_style" 
                               placeholder="Enter qualification details" name="qualification_details" id="address_text_area"><?php  if(isset($_POST['qualification_details'])){ echo $_POST['qualification_details'];}?></textarea>
                        </td>
                    
                        <td><b>Address </b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="sap_address" 
                                      autocomplete="off" class="text_area_style" placeholder="Enter address"
                                      name="address" id="address_text_area"><?php  if(isset($_POST['school_address'])){ echo $_POST['school_address'];}?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Private Note</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="school_address" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter private note" name="private_note" id="address_text_area"><?php  if(isset($_POST['school_address'])){ echo $_POST['school_address'];}?></textarea>
                        </td>
                        <td><b>Profile Picture</b></td>
                        <td><b>:</b></td>
                        <td>
                            <input id="report_logo" name="report_logo" type="file">   
                        </td>
                    </tr>
                    <tr>
                        <td style=" height:10px; "></td>
                    </tr>
                    <tr>
                        <td><b>Account Login Details</b></td>
                    </tr>
                    <tr>
                        <td colspan="6"><div class="verticle_line"></div></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table style=" margin-top:10px; margin-bottom:10px;  ">
                               <tr><td><b>Username</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sap_user_name"
                                   placeholder="Enter username" class="text_box_orges"
                                   name="user_name" value="<?php  if(isset($_POST['user_name'])){ echo $_POST['user_name'];}?>"></td>
                    <td><b>New Password</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="password" autocomplete="off" id="sap_new_password"
                                   placeholder="Enter new password" class="text_box_orges"
                                   name="new_password"></td>
                   <td><b>Re-type Password</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="password" autocomplete="off" id="sap_retype_password"
                                   placeholder="Enter re-type password" class="text_box_orges"
                                   name="retype_password"></td>
                    </tr>  
                            </table>
                            
                        </td>
                    </tr>
                    
                   
                    <tr>
                        <td colspan="6">
                            <input type="submit" name="submit_data_process" class="save_button" id="save_button" style=" width:110px; margin-top:10px;  " value="Save">   
                        </td>
                    </tr>
                </table>
                 </form>
            </div>   
        
         </div>
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
 header("Location:manage_module.php");   
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