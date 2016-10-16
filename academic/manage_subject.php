<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
     
<?php
  $message_show="";
  if(isset($_POST['submit_data_process']))
  {

date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
  
$result=mysql_query("SHOW TABLE STATUS LIKE 'subject_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_subject_id="SBJCT_$nextId"; 
$encrypt_id=md5(md5($final_subject_id));
  
  
      $subject_type=$_POST['subject_type'];
      $subject_name=$_POST['subject_name'];
      $subject_code=$_POST['subject_full_name'];
      $description=$_POST['description'];
      $insert_session=$_POST['use_inset_session_id'];
      if((!empty($subject_name))&&(!empty($subject_type))&&(!empty($subject_code))&&(!empty($final_subject_id)))
      {
       $check_subject_record=  mysql_query("SELECT * FROM subject_db WHERE $db_main_details subject_id='$final_subject_id' and is_delete='none'
           OR $db_main_details subject_type='$subject_type' and subject_name='$subject_name' and subject_code='$subject_code' and is_delete='none'");
       $fetch_subject_data= mysql_fetch_array($check_subject_record);
       $fetch_subject_num_rows=  mysql_num_rows($check_subject_record);
      if((empty($fetch_subject_data))&&($fetch_subject_data==null)&&($fetch_subject_num_rows==0))
      {
        
          $insert_subject_db=  mysql_query("INSERT into subject_db values('','$fetch_school_id','$fetch_branch_id'
                  ,'$insert_session','$final_subject_id','$encrypt_id','$subject_type','$subject_name','$subject_code','$description'
                  ,'none','$date','$date_time')"); 
          
         if($insert_subject_db)
         {
          $message_show="<span style='color:green;'>Record save successfully complete</span>";   
         }else
      {
          $message_show="<span style='color:red;'>Request failed,please try again</span>";  
      }
          
      }else
      {
          $message_show="<span style='color:red;'>Record already exist in database.</span>";  
      }
         
      }else
      {
          $message_show="<span style='color:red;'>Please fill all fields.</span>";  
      }
      
      
      require_once '../pop_up.php';  
      
  }   
   ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Subject</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
<script type="text/javascript">
 function org_validate()
 {
     var subject_name=document.getElementById("subject_name").value;
     var subject_code=document.getElementById("section_code").value;
     if(subject_name==0)
         {
             alert("Please enter subject name");
             document.getElementById("subject_name").focus();
             return false;
         } else
         if(subject_code==0)
         {
             alert("Please enter subject code");
             document.getElementById("section_code").focus();
             return false;
         } else
          {
              document.getElementById("ajax_loader_show").style.display="block";    
                  
             }
             
 }
</script>

    </head>
    <body>
       <?php  include_once '../ajax_loader_page_second.php';?>
        
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        <form action="" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                          <td><a href="academic.php">Academic</a></td>
                           <td>/</td>
                           <td><a href="subject.php">Subject</a></td>
                           <td>/</td>
                           <td>Manage Subject</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage Subject</b></div></div>
                
               <div class="main_work_data" style="">
                   <div class="left_add_work_div">
                    <div class="heading_title_td">Add New Subject</div>    
                      
                   
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td colspan="2"></td>
                        <td>
                            <table>
                                <tr>
                                    <td><input type="radio" name="subject_type" value="theory" checked></td>
                                    <td><b>Theory</b> </td>
                                    <td><input type="radio" name="subject_type" value="practical"></td>
                                    <td><b><b>Practical/Lab</b></b></td>
                                </tr>
                            </table>    
                            
                        </td>
                    </tr>
                    <tr><td><b>Subject Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="subject_name" 
                                   placeholder="Enter subject name" class="text_box_org"
                                   name="subject_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr><td><b>Subject Code <sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="section_code" 
                                   placeholder="Enter subject code" class="text_box_org"
                                   name="subject_full_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td><b>Description</b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="description" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter description" name="description" 
                                      id="address_text_area"></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();"
                                   id="save_button" style=" margin-right:20px; "  value="Save">   
                        </td>
                    </tr>
               </table>  
                   </div>  
                   
                   <div class="verticle_length"></div>
                   
                   
                   
                   <div class="right_fetch_work_div">
                   <div class="heading_title_td">List Of Subject</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>Subject Type</td>
                            <td>Subject Name</td>
                             <td>Subject Code</td>
                              <td>Description</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                      <?php 
                        $row=0;
                     $subject_db=mysql_query("SELECT * FROM subject_db WHERE organization_id='$fetch_school_id' and"
                             . " branch_id='$fetch_branch_id' and is_delete='none'");   
                     while ($fetch_subject_data=mysql_fetch_array($subject_db))
                     {
                         $row++;
                                 $fetch_subject_db_id=$fetch_subject_data['id'];
                                 $fetch_subject_unique_id=$fetch_subject_data['subject_id'];
                                 $encrypt_id=$fetch_subject_data['encrypt_id'];
                                 $subject_type=ucwords($fetch_subject_data['subject_type']);
                                 $fetch_subject_name=$fetch_subject_data['subject_name'];
                                 $fetch_subject_full_name=$fetch_subject_data['subject_code'];
                                 $fetch_subject_description=$fetch_subject_data['description'];
                                 
                     echo "<tr id='delete_row_$fetch_subject_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                        <td><b>$subject_type</b></td>
                                       <td><b>$fetch_subject_name</b></td>
                                       <td style='width:28%;'>$fetch_subject_full_name</td>
                                       <td>$fetch_subject_description</td>
                                <td style='border-right:1px solid gray; width:130px;'>";
                                {
                            ?>
                        
                        <a style="color:blue;" href="#" onclick="window.open('edit_subject_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        
                        <div onclick="delete_data('<?php  echo $fetch_subject_unique_id;?>','subject_delete_command')" class="edit_delete_button">Delete</div>
                     
                       <?php 
                        }       
                                echo"</td>
                                 </tr>";     
                                             
                                 
                                 
                                 
                                 
                     }
                       
                     if(empty($fetch_subject_db_id))
                     {
                         echo "<tr><td colspan='7' style=' border:1px solid black; height:30px; text-align:center;"
                         . "font-weight:bold; color:Red; border-top:0;'>Record no found !!</td></tr>";   
                     }
                        ?>
                        
                        
                        
                        
                   </table>
                   
                       
                   </div>
                   
                   
                   
               </div>      
              
               
               
            </div> 
        </div>
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