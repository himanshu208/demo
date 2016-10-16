<?php
//SESSION CONFIGURATION
$check_array_in="manage_admin";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
$message_show="";
if(isset($_POST['submit_data_process']))
{
    
$result=mysql_query("SHOW TABLE STATUS LIKE 'login_user_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_school_id="LGINUSER_$nextId"; 

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
    
    if(count($_POST['module_list'])>0)
      {
      $module_list=$_POST['module_list'];
      }else
      {
        $module_list=""; 
      }
    
    $user_name=$_POST['user_name'];
    $new_password=$_POST['new_password'];
    $retype_password=$_POST['retype_password'];
    $temp_password=$new_password;
    if((!empty($full_name))&&(!empty($module_list))&&(!empty($father_name))&&(!empty($gender))&&(!empty($mobile_number))
            &&(!empty($email_id))&&(!empty($address))&&(!empty($user_name))&&(!empty($new_password))&&(!empty($retype_password)))
    {
    if($new_password==$retype_password)
    {   
     $match_user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$final_school_id'
             OR user_name='$user_name' OR mobile_number='$mobile_number' OR email_id='$email_id'");
     $fetch_user_data=mysql_fetch_array($match_user_db);
     $fetch_user_num_rows=mysql_num_rows($match_user_db);
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
       
$result=mysql_query("SHOW TABLE STATUS LIKE 'module_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_module_id="MODLE_$nextId";     
$encrypt_id=md5(md5($final_module_id));

       $implode_module_list=implode(",",$module_list);  
       
      $select_check_module_db=mysql_query("SELECT * FROM  module_db WHERE organization_id='$fetch_school_id'"
              . " and branch_id='$branch_id' and admin_id='$final_school_id' and action='active'");   
      $fetch_module_data_check=  mysql_fetch_array($select_check_module_db);   
      $fetch_module_num_rows_check=  mysql_num_rows($select_check_module_db);
      if((empty($fetch_module_data_check))&&($fetch_module_data_check==null)&&($fetch_module_num_rows_check==0))
      {
        $insert_module_data=mysql_query("INSERT into module_db values('','$fetch_school_id','$branch_id'
                ,'$final_module_id','$encrypt_id','$account_type','$final_school_id','$implode_module_list','','$date','$date_time','$user_unique_id','active')");  
        if($insert_module_data)
        {
         $message_show="Account Create Successfully Complete."; 
           
        }else
        {
         $message_show="Request failed,Please try again.";       
      $delete_db=  mysql_query("DELETE FROM login_user_db WHERE user_admin_id='$final_school_id'");   
        }
      }   
        
         
       }else
       {
        $message_show="Request failed,Please try again.";       
       }
         
         
         
     }else
     {
       $message_show="Sorry,Record already exist in database.";    
     }
        
        
    }else
    {
       $message_show="New password & re-type password did`t match."; 
    }   
    }else
    {
       $message_show="Please fill all fields."; 
    }
    require_once '../pop_up.php';  
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <style>
        .text_box_org{ width:180px; font-size:11px;  }  
        .select_style{ width:192px; font-size:11px;  }
        .text_area_style{ width:180px;  font-size:11px; }
        .text_box_orges{ width:180px;  font-size:11px; }
        #report_logo{ width:180px;  font-size:11px; }
        </style>
    </head>
    <body>
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="manage_admin.php">Manage Admin</a></td>
                           <td>/</td>
                           <td>Add New Admin</td>
                       </tr>
                   </table>   
               </div>
             <form action="" onsubmit="return org_validate(this);" method="post" enctype="multipart/form-data">
         
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button"><div id="transport_function" class="Short_menu_show"><b>Add Admin</b></div>
                    <a href="manage_admin.php">
                    <div class="view_button">List Of Admin</div></a>
                </div>
                
                
               <div id="main_work_div">
                   <div id="div_search_top">
                       <div class="left_admin_div">
                           <table cellspacing="2" cellpadding="2" id="org_table_style" style=" margin-top:15px; ">
                    <?php
                    $message_show="";
                     echo  $message_show;
                    ?>
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                                    <td><b>School Name</b><sup>*</sup></td>
                                    <td><b>:</b></td>
                                    <td><input type="text" autocomplete="off" id="school_name"
                                   placeholder="Enter school name" class="text_box_org"
                                   name="school_name" style=" background-color:whitesmoke; " readonly="readonly" value="<?php  echo $fetch_school_name;?>"></td>
                              
                                    <td><b>Branch</b> <sup>*</sup></td>
                                    <td><b>:</b></td>
                                    <td><select name="branch_id" id="branch_name_id" style=" background-color:whitesmoke; " class="select_style">
                                           
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
                                            <option value="0">---Select---</option>
                                            <option value="branch_head_admin">Branch Head Admin</option>
                                            <option value="admin">Admin</option>
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
                        <td colspan="4"><b>Account Login Details</b></td>
                    </tr>
                    <tr>
                        <td colspan="6"><div class="verticle_line"></div></td>
                    </tr>
                    <tr>
                        <td colspan="6">
                            <table cellspacing="5" style=" margin-top:10px; margin-bottom:10px;  ">
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
                               </tr>
                               <tr>
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
                       </div>  
                       <script type="text/javascript">
        $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.module_check_box').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.module_check_box').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
        </script>
                       <div class="right_admin_div">
                           <div class="module_liststed" style=" margin-bottom:10px; ">Module Access</div> 
                       <?php
                       $print_admin_role="Branch Head Admin";   
                       $module_db=mysql_query("SELECT * FROM module_db WHERE $db_main_details_whout_session admin_type='branch_head_admin'");
                      $fetch_module_data=mysql_fetch_array($module_db);
                     $fetch_module_num_rows=mysql_num_rows($module_db);
                     
                     if(!empty($fetch_module_num_rows))
                     {
                     {
                      ?>
                        <div class='module_icon_set'>
                                 <table>
                                           <tr><td><input id="selecctall" class='module_check_box' type='checkbox'></td>
                                               <td><b>Select All</b></td></tr></table></div>
                           <div style=" width:100%; float:left; height:1px;   "></div>
                           <?php
                     }   
                     }
                     
                      if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
                      {
                       $module_list=$fetch_module_data['module'];  
                      }else
                      {
                       $module_list="";   
                      }
                      
                       $explode_module=  explode(",",$module_list);
                               foreach($explode_module as $module_name)
                               {
                                  $explode_module_list=explode("_", $module_name); 
                                   
                                  if(!empty($explode_module_list[1]))
                                  {
                                  $a_print=ucwords($explode_module_list[1]);    
                                  }else
                                  {
                                  $a_print="";    
                                  }
                                  $ab_print=ucwords($explode_module_list[0]);
                                  
                                   echo "<div class='module_icon_set'>"
                                  . "<table>"
                                           . "<tr><td><input class='module_check_box'  name='module_list[]' value='$module_name' type='checkbox'></td>"
                                           . "<td>$ab_print $a_print</td></tr></table></div>";    
                               }
                       ?>    
                           
                           
                       </div>  
                       
                       
                       
                   </div>
                   </div>
                </div> 
        </div>
           <script>
      function org_validate(frm)
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
         
    var checkboxese=document.querySelectorAll('input[name="module_list[]"]'),valuese=[];
     Array.prototype.forEach.call(checkboxese, function(el) {
        valuese.push(el.value);
    });
    var chks = document.getElementsByName('module_list[]');
var hasChecked = false;
for (var i = 0; i < chks.length; i++)
{
if (chks[i].checked)
{
hasChecked = true;
break;
}
}

  
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
                }else
if (hasChecked == false)
{
alert("Please select at least one module");
return false;
}
       
      }
      </script>
      
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
           </form>
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