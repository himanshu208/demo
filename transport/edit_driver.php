<?php
//SESSION CONFIGURATION
$check_array_in="transport";
require_once '../config/edit_page_configuration.php';
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
         $license_no=$_POST['license_no'];
         $lisence_expire_date=$_POST['license_expire_date'];
         $description=$_POST['description'];
         $final_driver_id=$_POST['driver_unique_id'];
         $temp_employee_photo=$_POST['temp_employee_photo'];
         $temp_document_file=$_POST['temp_document_file'];
         $insert_session_id=$_REQUEST['sxml'];
 if((!empty($final_driver_id))&&(!empty($first_name))&&(!empty($gender))
         &&(!empty($dob))&&(!empty($father_name))&&(!empty($married_status))&&(!empty($address))&&(!empty($mobile_no))&&(!empty($license_no))&&(!empty($lisence_expire_date))&&(!empty($insert_session_id)))
 {
  
$select_db=mysql_query("SELECT * FROM transport_driver_db WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and driver_unique_id!='$final_driver_id' and is_employee='no' and employee_unique_id='0' and "
        . "driver_name='$first_name' and father_name='$father_name' and is_delete='none' OR organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and driver_unique_id!='$final_driver_id' and "
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
             if(is_file("../".$temp_employee_photo))
             {
             $delete_file="../".$temp_employee_photo;    
             unset($delete_file); 
             }
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
          $location=$temp_employee_photo;
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
             if(is_file("../".$temp_document_file))
             {
             $delete_file="../".$temp_document_file;    
             unset($delete_file); 
             }   
             $location1=$location1;   
            }else
            {
             $location1="";   
            }
          }else 
          {
          $location1=$temp_document_file;
          }
    
    if(!empty($b))
    {
        if(!empty($c))
        {  
  
      $update_db=mysql_query("UPDATE transport_driver_db SET is_employee='$is_employee',employee_unique_id='$employee_id',"
              . "driver_name='$first_name',gender='$gender',dob='$dob',father_name='$father_name',mobile_no='$mobile_no',email='$email',married_status='$married_status',"
              . "address='$address',license_no='$license_no',license_expire_date='$lisence_expire_date',document='$location1',photo='$location',description='$description' "
              . "WHERE organization_id='$fetch_school_id'
     and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and driver_unique_id='$final_driver_id' and is_delete='none'"); 
        
if((!empty($update_db))&&($update_db))
{
 $message_show="<div class='notification_alert_show' style='color:green;'>Record update successfully complete.</div>";
     
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
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Driver Details</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       
<script type="text/javascript">
    window.onload = refreshParent;
    function refreshParent() {
     window.opener.location.reload();
    }
   
   function close_pop_up_this()
   {
   window.close();    
   }
   
</script>


        <script type="text/javascript">
            function ok_close()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    }
};
            
            </script>
            
             <script type="text/javascript">
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
            </script> 
            
            
           <script type="text/javascript">
        function validate_form() 
        {
        var first_name=document.getElementById("first_name").value;   
        var dob=document.getElementById("dob").value;
        var mobile_no=document.getElementById("mobile_number").value;
        var father_name=document.getElementById("father_name").value;
        var address=document.getElementById("address").value;
        var license_no=document.getElementById("license_no").value;
        var license_expire_date=document.getElementById("license_expire_date").value;
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
           alert("Please enter driver name");
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
        }else
            if(license_no==0)
        {
            alert("Please enter license number");
            document.getElementById("license_no").focus();
            return false;
        }else
            if(license_expire_date==0)
        {
          alert("Please enter license expire date");
          document.getElementById("license_expire_date").focus();
          return false;
        }
        
        }
        </script>
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Driver Details</div>   
                
                 <script type="text/javascript">
               function check_radio(radio_value)
               {
                 if(radio_value=="new_driver")
                 {
                 document.getElementById("employee_search").style.display="none";     
                 }else
                 if(radio_value=="exist_employee")
                 {
                   document.getElementById("employee_search").style.display="block";     
                   
                 }
                 
                 
               }
               </script>
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
              if(!empty($_REQUEST['token_id'])&&($_REQUEST['sxml']))
              {
               
    $token_id=$_REQUEST['token_id'];
    $fecth_session_id_set=$_REQUEST['sxml'];
            
   $database_db=mysql_query("SELECT * FROM transport_driver_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and encrypt_id='$token_id' and is_delete='none'");
  $fetch_data=mysql_fetch_array($database_db);
  $fetch_num_rows=mysql_num_rows($database_db);
  if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_rows!=0))
  {
 
      
  {   
 ?>   
     <input type="hidden" name="driver_unique_id" value="<?php echo $fetch_data[4];?>">              
     <style>
         #employee_search{ display:none; }
     </style>
     <?php
     if($fetch_data[6]=="no")
     {
     $is_employee="checked";    
     }else
     {
      $is_employee="";   
     }
     
     if($fetch_data[6]=="yes")
     {
     $is_employee_yes="checked";    
     {
     ?>
      <style>
         #employee_search{ display:block; }
     </style>
     <?php
     }
     }else
     {
        $is_employee_yes="";  
     }
     
     ?>
     
    <table class="table_middle" style=" ">
                    
                       <tr>
                           <td><br/></td>
                       </tr>
                       <tr>
                           <td colspan="3">
                               <table style="width:270px;   margin: 0 auto; border:1px solid whitesmoke; background-color:whitesmoke;
                                     border:1px solid silver; padding-left:20px;    ">
                                   <tr>
                                       <td><input name="is_employee" value="no" onclick="check_radio('new_driver')" type="radio" <?php echo $is_employee;?>></td><td><b>New Driver</b></td>
                                       <td><input name="is_employee" id="exist_employee" value="yes" onclick="check_radio('exist_employee')" type="radio" <?php echo $is_employee_yes;?>></td><td><b>Exist Employee</b></td>
                                   </tr>
                               </table>   
                           </td>
                       </tr>
                        <tr>
                           <td><br/></td>
                       </tr>
                       <tr>
                           <td colspan="3">
                             
                               <div id="employee_search">
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
                       <td>Driver Name <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input value="<?php echo $fetch_data[8];?>" type="text" id="first_name" name="first_name" placeholder="Please enter first name" class="text_box_class"></td>
                       </tr>
                      <?php
                      if($fetch_data[9]=="male")
                      {
                      $male="checked";    
                      }else
                      {
                      $male="";    
                      }
                      
                      if($fetch_data[9]=="female")
                      {
                       $female="checked";   
                      }else
                      {
                       $female="";   
                      }
                      
                      if($fetch_data[9]=="other")
                      {
                        $other="checked";  
                      }else
                      {
                       $other="";   
                      }
                      ?>
                       <tr>
                       <td>Gender <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <table style=" float:left; ">
                               <tr>
                                   <td><input type="radio" name="gender" value="male" <?php echo $male;?>></td><td>Male</td>
                                   <td><input type="radio" name="gender" value="female" <?php echo $female;?>></td><td>Female</td>
                                   <td><input type="radio" name="gender" value="other" <?php echo $other;?>></td><td>Other</td>
                               </tr>
                           </table>   
                       </td>
                       </tr>
                        <tr>
                       <td>Date of Birth <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[10];?>" id="dob" name="dob" placeholder="Please enter date of birth" class="text_box_class"></td>
                       </tr>
                       <tr>
                       <td>Father Name <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[11];?>" id="father_name" name="father_name" placeholder="Please enter father name" class="text_box_class"></td>
                       </tr> 
                       <tr>
                       <td>Mobile Number <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[12];?>" id="mobile_number" name="mobile_number" placeholder="Please enter mobile number" class="text_box_class"></td>
                       </tr>
                       
                        <tr>
                       <td>Email</td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[13];?>" id="email" name="email" placeholder="Enter email" class="text_box_class"></td>
                       </tr>
                       <?php
                       if($fetch_data[14]=="married")
                       {
                        $married="checked";  
                       }else
                       {
                        $married="";   
                       }
                       
                       if($fetch_data[14]=="unmarried")
                       {
                       $unmarried="checked";    
                       }else
                       {
                        $unmarried="";   
                       }
                           
                       
                       ?>
                       
                       <tr>
                       <td>Married Status <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td>
                           <table style=" float:left; ">
                               <tr>
                                   <td><input type="radio" name="married_status" value="married" <?php echo $married;?>></td><td>Married</td>
                                   <td><input type="radio" name="married_status" value="unmarried" <?php echo $unmarried;?>></td><td>Unmarried</td>
                                 
                               </tr>
                           </table>   
                       </td>
                       </tr>
                       <tr>
                           <td>Address <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><textarea id="address" name="address" placeholder="Please enter address" class="text_area_class"><?php echo $fetch_data[15];?></textarea></td>
                       </tr>
                         <tr>
                             <td>License Number <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[16];?>" id="license_no" name="license_no" placeholder="Please enter license number" class="text_box_class"></td>
                       </tr>
                         <tr>
                             <td>License Expire Date <sup>*</sup></td>
                       <td><b>:</b></td>
                       <td><input type="text" value="<?php echo $fetch_data[17];?>"  id="license_expire_date" name="license_expire_date" placeholder="Please enter license number" class="text_box_class"></td>
                       </tr>
                       <tr>
                             <td>Document</td>
                       <td><b>:</b></td>
                       <td><input type="file" id="document_file" name="document_file">
                           <?php
                           if(!empty($fetch_data[18])&&(is_file("../".$fetch_data[18])))
                           {
                           ?>
                              <a style="color:blue;" href="#" onclick="window.open('../<?php echo $fetch_data[18];?>','size',config='height=500,width=700,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                              <input type="button" class="view_buttoned"  value="View"></a>
                           <?php
                           }
                           ?>
                           
                           <input type="hidden" name="temp_document_file" value="<?php echo $fetch_data[18];?>">
                       </td>
                       </tr>
                        <tr>
                             <td>Profile Photo</td>
                       <td><b>:</b></td>
                       <td><input type="file" id="employee_photo" name="employee_photo">
                            <?php
                           if(!empty($fetch_data[19])&&(is_file("../".$fetch_data[19])))
                           {
                           ?>
                           <a style="color:blue;" href="#" onclick="window.open('../<?php echo $fetch_data[19];?>','size',config='height=450,width=450,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                           <input type="button" class="view_buttoned"  value="View"></a>
                           <?php
                           }
                           ?>
                           <input type="hidden" value="<?php echo $fetch_data[19];?>" name="temp_employee_photo">
                       </td>
                       </tr>
                       <tr>
                       <td>Description </td>
                       <td><b>:</b></td>
                       <td><textarea id="description" name="description" placeholder="Enter description" class="text_area_class"><?php echo $fetch_data[20];?></textarea></td>
                       </tr>
                       
                       
                       <tr>
                           <td colspan="3">
                              <input type="submit" class="submit_process" name="submit_process" value="Save"> 
                               
                               
                               <input type="reset" class="reset_process" name="reset_process" value="Reset">
                               
                           </td>
                       </tr>
                   </table>    
                                    
                
                
  <?php
  }
  }else
  {
      echo "Record no found !"; 
  }
                  
              }
 ?>
                
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By :  Pixabyte Technologies Pvt. Ltd.</div>
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
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
    
    $("#license_expire_date").datepicker({ 
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
            
        </div>
       </form>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>