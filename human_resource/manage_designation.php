<?php
//SESSION CONFIGURATION
$check_array_in="hr";
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
  
$result=mysql_query("SHOW TABLE STATUS LIKE 'hr_designation_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_hr_designation_id="DISGNTON_$nextId"; 
$encrypt_id=md5(md5($final_hr_designation_id));
  
  
      
      $hr_designation_name=$_POST['hr_designation_name'];
       $description=$_POST['description'];
      if((!empty($hr_designation_name)))
      {
       $check_hr_designation_record=mysql_query("SELECT * FROM hr_designation_db WHERE $db_main_details_whout_session designation_id='$final_hr_designation_id' and is_delete='none'
           OR $db_main_details_whout_session designation_name='$hr_designation_name' and is_delete='none'");
       $fetch_hr_designation_data= mysql_fetch_array($check_hr_designation_record);
       $fetch_hr_designation_num_rows=  mysql_num_rows($check_hr_designation_record);
      if((empty($fetch_hr_designation_data))&&($fetch_hr_designation_data==null)&&($fetch_hr_designation_num_rows==0))
      {
        
          $insert_hr_designation_db=  mysql_query("INSERT into hr_designation_db values('','$fetch_school_id','$fetch_branch_id'
                  ,'$final_hr_designation_id','$encrypt_id','$hr_designation_name','$description'
                  ,'none','$date','$date_time','$user_unique_id','active')"); 
          
         if($insert_hr_designation_db)
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
        <title>Manage Designation</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
<script type="text/javascript">
 function org_validate()
 {
     var hr_designation_name=document.getElementById("hr_designation_name").value;
     
     if(hr_designation_name==0)
         {
             alert("Please enter designation name");
             document.getElementById("hr_designation_name").focus();
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
                           <td><a href="hr_dashboard.php">Human Resource</a></td>
                           <td>/</td>
                           <td><a href="hr_setting.php">HR Setting</a></td>
                           <td>/</td>
                           <td>Manage Designation</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage Designation</b></div></div>
                
               <div class="main_work_data" style="">
                   <div class="left_add_work_div">
                    <div class="heading_title_td">Add New Designation</div>    
                      
                   
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td style=" height:20px; "></td>
                    </tr>
                    <tr><td><b>Designation</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="hr_designation_name" 
                                   placeholder="Please enter designation" class="text_box_org"
                                   name="hr_designation_name"></td>
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
                                   class="save_button" onclick="return org_validate();" id="save_button"  value="Save">   
                        </td>
                    </tr>
               </table>  
                   </div>  
                   
                   <div class="verticle_length"></div>
                   
                   
                   
                   <div class="right_fetch_work_div">
                   <div class="heading_title_td">List Of Designation</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>Designation</td>
                             <td>Description</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                      <?php 
                        $row=0;
                     $hr_designation_db=mysql_query("SELECT * FROM hr_designation_db WHERE $db_main_details_whout_session is_delete='none'");   
                     while ($fetch_hr_designation_data=mysql_fetch_array($hr_designation_db))
                     {
                         $row++;
                                 $fetch_hr_designation_db_id=$fetch_hr_designation_data['id'];
                                 $fetch_hr_designation_unique_id=$fetch_hr_designation_data['designation_id'];
                                 $encrypt_id=$fetch_hr_designation_data['encrypt_id'];
                                 $fetch_hr_designation_name=$fetch_hr_designation_data['designation_name'];
                                 $fetch_hr_designation_description=$fetch_hr_designation_data['description'];
                                 
                     echo "<tr id='delete_row_$fetch_hr_designation_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                       <td><b>$fetch_hr_designation_name</b></td>
                                      <td>$fetch_hr_designation_description</td>
                                <td style='border-right:1px solid gray; width:130px;'>";
                                {
                                    ?>
                            <a style="color:blue;" href="#" onclick="window.open('edit_hr_designation_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                   
                        
                                                
                            <div onclick="delete_data('<?php  echo $fetch_hr_designation_unique_id;?>','hr_designation_delete_command')" class="edit_delete_button">Delete</div>
                      
                      <?php 
                        }       
                                echo"</td>
                                 </tr>";     
                                             
                                 
                                 
                                 
                                 
                     }
                     if(empty($fetch_hr_designation_db_id))
                     {
                         echo "<tr><td colspan='4' style='border:1px solid black; text-align:center; color:red; border-top:0; height:35px; '><b>Record no found !</b></td></tr>";    
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