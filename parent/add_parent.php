<?php
//SESSION CONFIGURATION
$check_array_in="parent";
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

 //father insert valute
    $session_id=$_POST['use_inset_session_id'];
 
    $student_father_name=$_POST['student_father_name'];
    $student_father_mobile_no=$_POST['student_father_mobile_no'];
    $student_father_email_id=$_POST['student_father_email_id'];
    $student_father_qualification=$_POST['student_father_qualification'];
    $student_father_occupation=$_POST['student_father_occupation'];
    $student_father_annual_income=$_POST['student_father_annual_income'];
    $student_father_photo=$_FILES['student_father_photo'];
    
    
    $student_mother_name=$_POST['student_mother_name'];
    $student_mother_mobile_no=$_POST['student_mother_mobile_no'];
    $student_mother_email_id=$_POST['student_mother_email_id'];
    $student_mother_qualification=$_POST['student_mother_qualification'];
    $student_mother_occupation=$_POST['student_mother_occupation'];
    $student_mother_annual_income=$_POST['student_mother_annual_income'];
    $student_mother_photo=$_FILES['student_mother_photo'];
    
    
    $student_guardian_relation=$_POST['guardian_relation'];
    $student_guardian_name=$_POST['guardian_full_name'];
    $student_guardian_mobile_no=$_POST['guardian_mobile_no'];
    $student_guardian_email=$_POST['guardian_email_id'];
    $student_guardian_qualification=$_POST['guardian_qualification'];
    $student_guardian_occupation=$_POST['guardian_occupation'];
    $student_guardian_annual_income=$_POST['guardian_annual_income'];
    $student_guardian_photo=$_FILES['guardian_photo'];
    
    $parent_username=$_POST['parent_user_name'];
    $parent_password=$_POST['parent_password'];
    $encrypt_password=md5($parent_password);
    
$result=mysql_query("SHOW TABLE STATUS LIKE 'parent_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="PRNTS_$nextId"; 
$encrypt_id=md5(md5($final_db_id));   

if((!empty($student_father_name))&&(!empty($student_father_mobile_no))&&(!empty($student_mother_name))
        &&(!empty($final_db_id)))
{

  $parent_match_db=mysql_query("SELECT * FROM parent_db WHERE $db_main_details_whout_session father_name='$student_father_name' and father_mobile_no='$student_father_mobile_no' and is_delete='none'");  
   $parent_fetch_data=mysql_fetch_array($parent_match_db);
   $parent_num_rows=mysql_num_rows($parent_match_db);
   if((empty($parent_fetch_data))&&($parent_fetch_data==null)&&($parent_num_rows==0))
   {
 //insert parents value
      
        $filename_1= $_FILES['student_father_photo']['name'];
        $tmpfilename_1 = $_FILES['student_father_photo']['tmp_name'];
        $filesize_1= $_FILES['student_father_photo']['size'];
        
        $filename_2= $_FILES['student_mother_photo']['name'];
        $tmpfilename_2 = $_FILES['student_mother_photo']['tmp_name'];
        $filesize_2 = $_FILES['student_mother_photo']['size'];
        
         $filename_3= $_FILES['guardian_photo']['name'];
        $tmpfilename_3 = $_FILES['guardian_photo']['tmp_name'];
        $filesize_3 =$_FILES['guardian_photo']['size'];
        
        if((!empty($filename_1)))
        { 
        if(($filesize_1<102400))
         {
        $imagesize_1=getimagesize($tmpfilename_1);
     
        if ((!empty($imagesize_1))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location_1="crud_images/parents/". $random . $time . $filename_1;
            $templocation_1= "images/parents/". $random . $time;
            $upload_1= move_uploaded_file($tmpfilename_1,"../".$location_1);
            if($upload_1)
            {
             $student_parents_insert_photo_1=$location_1;   
            }
        }else
        {
            $student_parents_insert_photo_1="";   
        }
         }else
         {
             $student_parents_insert_photo_1="";   
         }
        }else
        {
         $student_parents_insert_photo_1="";   
        }
            
          
        
        
         if((!empty($filename_2)))
        { 
        if(($filesize_2<202400))
         {
        $imagesize_2=getimagesize($tmpfilename_2);
     
        if ((!empty($imagesize_2))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(2000, 5000);
            $location_2="crud_images/parents/". $random . $time . $filename_2;
            $templocation_2= "images/parents/". $random . $time;
            $upload_2= move_uploaded_file($tmpfilename_2,"../".$location_2);
            if($upload_2)
            {
             $student_parents_insert_photo_2=$location_2;   
            }
        }else
        {
            $student_parents_insert_photo_2="";   
        }
         }else
         {
             $student_parents_insert_photo_2="";   
         }
        }else
        {
         $student_parents_insert_photo_2="";   
        }
           
        
         if((!empty($filename_3)))
        { 
        if(($filesize_3<302400))
         {
        $imagesize_3=getimagesize($tmpfilename_3);
     
        if ((!empty($imagesize_3))) {
            
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(3000, 5000);
            $location_3="crud_images/parents/". $random . $time . $filename_3;
            $templocation_3= "images/parents/". $random . $time;
            $upload_3= move_uploaded_file($tmpfilename_3,"../".$location_3);
            if($upload_3)
            {
             $student_parents_insert_photo_3=$location_3;   
            }
        }else
        {
            $student_parents_insert_photo_3="";   
        }
         }else
         {
             $student_parents_insert_photo_3="";   
         }
        }else
        {
         $student_parents_insert_photo_3="";   
        }      
    
$parents_db=mysql_query("INSERT into parent_db values('','$fetch_school_id','$fetch_branch_id','$session_id',"
           . "'$final_db_id','$encrypt_id','$date','$student_father_name','$student_father_mobile_no'"
           . ",'$student_father_email_id','$student_father_qualification','$student_father_occupation',"
           . "'$student_father_annual_income','$student_parents_insert_photo_1','$student_mother_name','$student_mother_mobile_no','$student_mother_email_id'"
           . ",'$student_mother_qualification','$student_mother_occupation','$student_mother_annual_income'"
           . ",'$student_parents_insert_photo_2','$student_guardian_relation','$student_guardian_name','$student_guardian_mobile_no'"
           . ",'$student_guardian_email','$student_guardian_qualification','$student_guardian_occupation',"
           . "'$student_guardian_annual_income','$student_parents_insert_photo_3','$parent_username','$encrypt_password','$parent_password','none','$date'"
           . ",'$date_time','$fecth_user_unique')");  
    
    if((!empty($parents_db))&&($parents_db))
    {
     $message_show="<div class='notification_alert_show' style='color:green;'>Record save successfully complete.</div>";   
    }else
    {
   $message_show="<div class='notification_alert_show'>Request failed,Please try again.</div>";        
    }
    
     }else
    {
   $message_show="<div class='notification_alert_show'>Sorry,Record already exist in database.</div>";        
    }
    
    
}else
{
$message_show="<div class='notification_alert_show'>Please fill all fields.</div>";
}

require_once '../pop_up.php';
}

?>



 <?php
function user_name($length=6)
{
   $chars ="abcdefghijklmnopqrstuvwxyz123456789987654321";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
}

 function password($length=8)
{
   $chars ="123456789987654321";//length:36
    $final_rand='';
    for($i=0;$i<$length; $i++)
    {
        $final_rand .= $chars[ rand(0,strlen($chars)-1)];
 
    }
    return $final_rand;
}
        
        ?>
        

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add Parent</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function validate_form() 
        {
            var father_name=document.getElementById("father_name").value;
          var mother_name=document.getElementById("mother_name").value;
          var father_mobile_no=document.getElementById("father_mobile_no").value;
          var user_name=document.getElementById("parent_user_name").value;
          var password=document.getElementById("parent_password").value;     
             if(father_name==0)
              {
                alert("Please enter father name");
                document.getElementById("father_name").focus();
                return false;
              }else
               if(mother_name==0)
              {
                 alert("Please enter mother name");
                document.getElementById("mother_name").focus();
                return false;  
              }else
                  if(father_mobile_no==0)
              {
                  alert("Please enter father mobile number");
                document.getElementById("father_mobile_no").focus();
                return false; 
              }else 
              if(user_name==0)
          {
            alert("Please enter parent username");
            document.getElementById("parent_user_name").focus();
            return false;
          }else
          if(password==0)
      {
         alert("Please enter parent password");
         document.getElementById("parent_password").focus();
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
                           <td><a href="parent_list.php">Parent List</a></td>
                           <td>/</td>
                           <td>Add Parent</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Add Parent</b></div>
                    <a href="parent_list.php">
                        <div class="view_button">View Parent List</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   <div id="new_parent">
                       <table cellspacing="0" cellpadding="0" class="student_details_table" style=" margin-top:10px; font-size:12px;  " >
                        <tr>
                           <td colspan="3"><span><b>Fields marked with <sup>*</sup> must be filled.</b></span></td>
                       </tr>
                     
                   <tr>
                       <td colspan="6">
                           <div class="title_heading"><b>Parents/Guardian Info</b></div>   
                       </td>
                       <td style=" width:20px; "></td>
                        <td colspan="3">
                           <div class="title_heading"><b>Local Guardian Info</b></div>   
                       </td>
                   </tr>
                   
                   
                   <tr>
                       <td colspan="3"><div class="title_heading" style=" width:100%; color:royalblue; font-size:12px;   "><b>Father Info</b></div></td>
                       <td colspan="3"><div class="title_heading" style=" width:100%; font-size:12px; color:royalblue; "><b>Mother Info</b></div></td>
                       <td></td>
                       <td colspan="3"><div class="title_heading" style=" width:100%; font-size:12px; color:royalblue; "><b>Local Guardian Info</b></div></td>
               
                   </tr>
                   
                   <tr>
                       <td style=" width:105px; "><b>Father Name </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_father_name" id="father_name" class="text_box_styling" placeholder="Enter father name"></td>
                       
                       <td style=" width:105px; "><b>Mother Name</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_mother_name" id="mother_name" class="text_box_styling" placeholder="Enter mother name"></td>
                       <td></td>
                       
                       <td style=" width:122px; "><b>Guardian Relation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="gur_relation" name="guardian_relation" type="text" class="text_box_styling"
                                  placeholder="Enter local guardian relation"></td>
                       
                   </tr>
                    
                    
                    
                    <tr>
                       <td><b>Mobile No. </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" name="student_father_mobile_no" id="father_mobile_no" class="text_box_styling"
                                  placeholder="Enter father mobile number"></td>
                       
                       <td><b>Mobile No.</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" name="student_mother_mobile_no" id="mother_mobile_no" class="text_box_styling"
                                  placeholder="Enter mother mobile number"></td>
                    
                       <td></td>
                       
                         
                       <td><b>Guardian Name</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="guardian_full_name" id="gur_name" class="text_box_styling" 
                                  placeholder="Enter local guardian name"></td>
                 
                    </tr>
                    
                    
                    <tr>
                        <td><b>Email</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_father_email_id" id="father_email_od" class="text_box_styling"
                                  placeholder="Enter father email id"></td>
                       
                       <td><b>Email</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_mother_email_id" id="mother_email_id" class="text_box_styling"
                                  placeholder="Enter mother email id"></td>
                 <td></td>
                 <td><b>Mobile No. </b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" onkeypress="javascript:return isNumber (event)" name="guardian_mobile_no" id="gur_mobile_no" class="text_box_styling"
                                  placeholder="Enter mobile no"></td>
                     
                    </tr>
                    
                    <tr>
                        <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_father_qualification" id="father_qualification" class="text_box_styling"
                                  placeholder="Enter father qualification"></td>
                       
                       <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_mother_qualification" id="mother_qualification" class="text_box_styling"
                                  placeholder="Enter mother qualification"></td>
                   
                      <td></td>

                      <td><b>Email Id</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="guardian_email_id" id="gur_email_id" class="text_box_styling"
                                  placeholder="Enter email id"></td>
                       
                    </tr>
                  
                 
                    
                    <tr>
                        <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_father_occupation" id="father_occupation" class="text_box_styling"
                                  placeholder="Enter father occupation"></td>
                       
                       <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="student_mother_occupation" id="mother_occupation" class="text_box_styling" 
                                  placeholder="Enter mother occupation"></td>
                       <td></td>

                       <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="guardian_qualification" id="gur_qualification" class="text_box_styling"
                                  placeholder="Enter qualification"></td>
                      
                    </tr>
                    
                    
                    <tr>
                        <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><b><?php echo $fetch_currency;?></b> <input type="text" onkeypress="javascript:return isNumber (event)" name="student_father_annual_income" id="father_income" class="text_box_styling" 
                                  value="0" style="width:50%; text-align:right; ">/-</td>
                       
                       <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><b><?php echo $fetch_currency;?></b> <input type="text" onkeypress="javascript:return isNumber (event)" name="student_mother_annual_income" id="mother_income" class="text_box_styling" 
                                  value="0" style="width:50%; text-align:right; ">/-</td>
                       <td></td>
                          
                       <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="guardian_occupation" id="gur_occupation" class="text_box_styling"
                                  placeholder="Enter occupation"></td>
                       
                       
                    </tr>
                    
                    
                     <tr>
                         <td><b>Father Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="father_photo" name="student_father_photo" type="file"><br/>
                       <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       </td>
                       
                       <td><b>Mother Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="mother_photo" name="student_mother_photo" type="file"><br/>
                           <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       
                       </td>
                       <td></td>
                       <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><b><?php echo $fetch_currency;?></b> <input type="text" onkeypress="javascript:return isNumber (event)" name="guardian_annual_income" id="gur_annual_income" class="text_box_styling"
                                                                       value="0" style="width:50%; text-align:right; ">/-</td>
                      
                      
                       
                    </tr>
                    
                       
                    <tr>
                        <td colspan="7"></td>
                        <td><b>Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="gur_photo" name="guardian_photo" type="file">
                       <br/>
                           <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       </td>
                       
                        </tr>
                        <tr>
                       <td colspan="12">
                           <div class="title_heading"><b>Parent Account Login Info </b></div>   
                       </td>
                   </tr>
                   
                   <?php
                   $parents_user_name=user_name();
                   $parents_password=password();
                   ?>
                    <tr>
                        <td><b>Username <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="parent_user_name" id="parent_user_name" class="text_box_styling"
                                  placeholder="Enter username" value="<?php echo $parents_user_name;?>"></td>
                   
                       
                       <td><b>Password <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="parent_password" id="parent_password" class="text_box_styling"
                                  placeholder="Enter password" value="<?php echo $parents_password;?>"></td>
                   </tr>
                   
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                           <td colspan="10">
                              <input type="submit" class="submit_process" name="submit_process" value="Save"> 
                               
                               
                               <input type="reset" class="reset_process" name="reset_process" value="Reset">
                               
                           </td>
                       </tr> 
                   </table>
                   </div>
                   
               </div>
                
             
                
                
               
            </div> 
        </div>
        
        
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