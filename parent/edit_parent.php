<?php
//SESSION CONFIGURATION
$check_array_in="parent";
require_once '../config/edit_page_configuration.php';
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

require_once '../connection.php';
if(isset($_POST['submit_process']))
{
 
    $update_parent_id=$_POST['update_unique_id'];
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
        
    if((!empty($student_father_name))&&(!empty($student_father_mobile_no))&&(!empty($student_mother_name)))
{

  $parent_match_db=mysql_query("SELECT * FROM parent_db WHERE parent_unique_id!='$update_parent_id' and father_name='$student_father_name' and father_mobile_no='$student_father_mobile_no' and is_delete='none'");  
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
         $student_parents_insert_photo_1=$_POST['temp_father_photo'];   
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
         $student_parents_insert_photo_2=$_POST['temp_mother_photo'];   
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
         $student_parents_insert_photo_3=$_POST['temp_local_parent_photo'];   
        }      

$update_parent_db=mysql_query("UPDATE parent_db SET father_name='$student_father_name',father_mobile_no='$student_father_mobile_no',"
        . "father_email='$student_father_email_id',father_qualification='$student_father_qualification',father_occupation='$student_father_occupation',father_annual_income='$student_father_annual_income',"
        . "father_photo='$student_parents_insert_photo_1',mother_name='$student_mother_name',mother_mobile_no='$student_mother_mobile_no',mother_email_id='$student_mother_email_id',"
        . "mother_qualification='$student_mother_qualification',mother_occupation='$student_mother_occupation',mother_annual_income='$student_mother_annual_income',mother_photo='$student_parents_insert_photo_2'"
        . ",local_parent_relation='$student_guardian_relation',local_parent_name='$student_guardian_name',local_parent_mobile_no='$student_guardian_mobile_no',local_parent_email_id='$student_guardian_email',"
        . "local_parent_qualification='$student_guardian_qualification',local_parent_occupation='$student_guardian_occupation',local_parent_annual_income='$student_guardian_annual_income',"
        . "local_parent_photo='$student_parents_insert_photo_3',user_name='$parent_username'"
        . ",password='$encrypt_password',temp_password='$parent_password' WHERE parent_unique_id='$update_parent_id' and is_delete='none'"); 

    
    if((!empty($update_parent_db))&&($update_parent_db))
    {
     $message_show="<div class='notification_alert_show' style='color:green;'>Record update successfully complete.</div>";   
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

<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Parent Detail</title>
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
   
   function on_show_photo(number)
{
 var input_photo=document.getElementById("input_photo_"+number).value;   
 if(input_photo==0)
     {
     document.getElementById("show_photo_"+number).style.display="block";
     document.getElementById("input_photo_"+number).value=1;    
     }else
         {
         document.getElementById("show_photo_"+number).style.display="none";
         document.getElementById("input_photo_"+number).value=0;    
         }
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
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Parent Detail</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
                <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM parent_db WHERE encrypt_id='$token_id' and is_delete='none'"); 
            $fetch_student_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_num_data!=0))
            {
            
              $update_db_id=$fetch_student_data['parent_unique_id'];
              $session_id=$fetch_student_data['session_id'];  
              
              
               $student_father_name=$fetch_student_data['father_name'];
    $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
    $student_father_email_id=$fetch_student_data['father_email'];
    $student_father_qualification=$fetch_student_data['father_qualification'];
    $student_father_occupation=$fetch_student_data['father_occupation'];
    $student_father_annual_income=$fetch_student_data['father_annual_income'];
    $student_father_photo=$fetch_student_data['father_photo'];
    $temp_father_photo=$fetch_student_data['father_photo'];
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
    $temp_mother_photo=$fetch_student_data['mother_photo'];
    
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
    $temp_local_parent_photo=$fetch_student_data['local_parent_photo'];
    if(empty($student_local_parent_photo))
    {
    $student_local_parent_photo="images/no_avilable_image.gif";    
    }  else {
      $student_local_parent_photo=$student_local_parent_photo;    
       
    }
    
    $user_name=$fetch_student_data['user_name'];
    $password=$fetch_student_data['temp_password'];
              
             {
             ?>  
             <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $update_db_id;?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
             <input type="hidden" name="temp_father_photo" value="<?php echo $temp_father_photo;?>">
             <input type="hidden" name="temp_mother_photo" value="<?php echo $temp_father_photo;?>">
             <input type="hidden" name="temp_local_parent_photo" value="<?php echo $temp_local_parent_photo;?>">
             
             <div id="new_parent" style=" margin:10px; ">
                       <table cellspacing="0" cellpadding="0" class="student_details_table" style=" margin-top:10px; " >
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
                       <td><input type="text" value="<?php echo $student_father_name;?>" name="student_father_name" id="father_name" class="text_box_styling" placeholder="Enter father name"></td>
                       
                       <td style=" width:105px; "><b>Mother Name</b> <sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_name;?>" name="student_mother_name" id="mother_name" class="text_box_styling" placeholder="Enter mother name"></td>
                       <td></td>
                       
                       <td style=" width:122px; "><b>Guardian Relation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="gur_relation" value="<?php echo $student_local_parent_relation;?>" name="guardian_relation" type="text" class="text_box_styling"
                                  placeholder="Enter local guardian relation"></td>
                       
                   </tr>
                    
                    
                    
                    <tr>
                       <td><b>Mobile No. </b><sup>*</sup></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_mobile_no;?>" onkeypress="javascript:return isNumber (event)" name="student_father_mobile_no" id="father_mobile_no" class="text_box_styling"
                                  placeholder="Enter father mobile number"></td>
                       
                       <td><b>Mobile No.</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_mobile_no;?>" onkeypress="javascript:return isNumber (event)" name="student_mother_mobile_no" id="mother_mobile_no" class="text_box_styling"
                                  placeholder="Enter mother mobile number"></td>
                    
                       <td></td>
                       
                         
                       <td><b>Guardian Name</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="guardian_full_name" value="<?php echo $student_local_parent_name;?>" id="gur_name" class="text_box_styling" 
                                  placeholder="Enter local guardian name"></td>
                 
                    </tr>
                    
                    
                    <tr>
                        <td><b>Email</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_email_id;?>" name="student_father_email_id" id="father_email_od" class="text_box_styling"
                                  placeholder="Enter father email id"></td>
                       
                       <td><b>Email</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_email_id;?>" name="student_mother_email_id" id="mother_email_id" class="text_box_styling"
                                  placeholder="Enter mother email id"></td>
                 <td></td>
                 <td><b>Mobile No. </b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_mobile_no;?>" onkeypress="javascript:return isNumber (event)" name="guardian_mobile_no" id="gur_mobile_no" class="text_box_styling"
                                  placeholder="Enter mobile no"></td>
                     
                    </tr>
                    
                    <tr>
                        <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_qualification;?>" name="student_father_qualification" id="father_qualification" class="text_box_styling"
                                  placeholder="Enter father qualification"></td>
                       
                       <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_qualification;?>" name="student_mother_qualification" id="mother_qualification" class="text_box_styling"
                                  placeholder="Enter mother qualification"></td>
                   
                      <td></td>

                      <td><b>Email Id</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_email;?>" name="guardian_email_id" id="gur_email_id" class="text_box_styling"
                                  placeholder="Enter email id"></td>
                       
                    </tr>
                  
                 
                    
                    <tr>
                        <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_occupation;?>" name="student_father_occupation" id="father_occupation" class="text_box_styling"
                                  placeholder="Enter father occupation"></td>
                       
                       <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_occupation;?>" name="student_mother_occupation" id="mother_occupation" class="text_box_styling" 
                                  placeholder="Enter mother occupation"></td>
                       <td></td>

                       <td><b>Qualification</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_qualification;?>" name="guardian_qualification" id="gur_qualification" class="text_box_styling"
                                  placeholder="Enter qualification"></td>
                      
                    </tr>
                    
                    
                    <tr>
                        <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_father_annual_income;?>" onkeypress="javascript:return isNumber (event)" name="student_father_annual_income" id="father_income" class="text_box_styling" 
                                  style="width:50%; text-align:right; ">/-</td>
                       
                       <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_mother_annual_income;?>" onkeypress="javascript:return isNumber (event)" name="student_mother_annual_income" id="mother_income" class="text_box_styling" 
                                  style="width:50%; text-align:right; ">/-</td>
                       <td></td>
                          
                       <td><b>Occupation</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_occupation;?>" name="guardian_occupation" id="gur_occupation" class="text_box_styling"
                                  placeholder="Enter occupation"></td>
                       
                       
                    </tr>
                    
                    
                     <tr>
                         <td><b>Father Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="father_photo" name="student_father_photo" type="file"><br/>
                       <span class="notification_red">( Photo Size Should be less then 100KB )</span><br/>
                       </td>
                     
                       
                       <td><b>Mother Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="mother_photo" name="student_mother_photo" type="file"><br/>
                           <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       
                       </td>
                       <td></td>
                       <td><b>Annual Income</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" value="<?php echo $student_local_parent_annual_income;?>" onkeypress="javascript:return isNumber (event)" name="guardian_annual_income" id="gur_annual_income" class="text_box_styling"
                                 style="width:50%; text-align:right; ">/-</td>
                      
                      
                       
                    </tr>
                    <tr><td colspan="3">
                            <input type="button" onclick="on_show_photo('3')" class="view_button_style" style=" margin-right:50px; " value='View Father Photo'>
                           
                           <input type="hidden" id="input_photo_3" value="0">
                           <div class="student_photos" id="show_photo_3" >
                           <table cellspacing="0" cellpadding="0" class='student_photo_table'>
                               <tr>
                                   <td>Father Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $student_father_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </table>    
                           </div>
                       </td>
                       
                       <td colspan="3">
                           <br/>
                       <input type="button" onclick="on_show_photo('1')" class="view_button_style" value='View Mother Photo'>
                           
                           <input type="hidden" id="input_photo_1" value="0">
                           <div class="student_photos" id="show_photo_1">
                           <table cellspacing="0" cellpadding="0" class='student_photo_table'>
                               <tr>
                                   <td>Mother Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $student_mother_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </table>    
                           </div>
                       </td>
                       <td></td>
                        <td><b>Photo</b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input id="gur_photo" name="guardian_photo" type="file">
                       <br/>
                           <span class="notification_red">( Photo Size Should be less then 100KB )</span>
                       </td>
                       
                        </tr>
                       
                         <tr>
                             <td colspan="9"></td>
                             <td>
                       <input type="button" onclick="on_show_photo('2')" class="view_button_style" value='Local Guardian View Photo'>
                           
                           <input type="hidden" id="input_photo_2" value="0">
                           <div class="student_photos" id="show_photo_2" style=" float:left; ">
                           <table cellspacing="0" cellpadding="0" class='student_photo_table'>
                               <tr>
                                   <td>Local Guardian Photo</td>
                               </tr>
                               <tr>
                                   <td><div class="verticle_lines_table"></div></td>
                               </tr>
                               <tr>
                                   <td><img class="student_images_change" src="../<?php echo $student_local_parent_photo;?>"></td>
                               </tr>
                               <tr>
                                   <td><div class="bottom_white_show" style=" float:left; "></div></td>
                               </tr>
                           </table>    
                           </div>
                       </td>
                        </tr>
                        
                        
                        <tr>
                       <td colspan="12">
                           <div class="title_heading"><b>Parent Account Login Info </b></div>   
                       </td>
                   </tr>
                 
                   
                   
                   
                    <tr>
                        <td><b>Username <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="parent_user_name" id="parent_user_name" class="text_box_styling"
                                  placeholder="Enter username" value="<?php echo $user_name;?>"></td>
                   
                       
                       <td><b>Password <sup>*</sup></b></td>
                       <td style="width:10px; text-align:center;  "><b>:</b></td>
                       <td><input type="text" name="parent_password" id="parent_password" class="text_box_styling"
                                  placeholder="Enter password" value="<?php echo $password;?>"></td>
                   </tr>
                   
                   
                   <tr>
                       <td style=" height:0px; "></td>
                   </tr>
                   <tr>
                           <td colspan="10">
                              <input type="submit" class="submit_process" name="submit_process" value="Update"> 
                               
                               
                               <input type="reset" class="reset_process" name="reset_process" value="Reset">
                               
                           </td>
                       </tr> 
                   </table>
                   </div> 
                
                
            <?php
             }
            }
             }
            ?>
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By : Pixabyte Technologies Pvt. Ltd.</div>
            
            
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