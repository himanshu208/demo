<?php
//SESSION CONFIGURATION
$check_array_in="sms_module";
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
 
  
      
      $sms_system_group_name=$_POST['sms_system_group_name'];
       $description=$_POST['description'];
       $insert_session=$_POST['use_inset_session_id'];
      if((!empty($sms_system_group_name)))
      {
       $check_sms_system_group_record=mysql_query("SELECT * FROM sms_system_group_db WHERE $db_main_details_whout_session"
               . " sms_category_name='$sms_system_group_name' and is_delete='none'");
       $fetch_sms_system_group_data= mysql_fetch_array($check_sms_system_group_record);
       $fetch_sms_system_group_num_rows=  mysql_num_rows($check_sms_system_group_record);
      if((empty($fetch_sms_system_group_data))&&($fetch_sms_system_group_data==null)&&($fetch_sms_system_group_num_rows==0))
      {
        
          $insert_sms_system_group_db=  mysql_query("INSERT into sms_system_group_db values('','$fetch_school_id','$fetch_branch_id','$insert_session'
                  ,'$sms_system_group_name','$description'
                  ,'none','$date','$date_time')"); 
          
         if($insert_sms_system_group_db)
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
        <title>Manage System SMS Group</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
<script type="text/javascript">
 function org_validate()
 {
     var sms_system_group_name=document.getElementById("sms_system_group_name").value;
     
     if(sms_system_group_name==0)
         {
             alert("Please enter system SMS group");
             document.getElementById("sms_system_group_name").focus();
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
                           <td><a href="sms_dashboard.php">SMS (Phone/Email)</a></td>
                           <td>/</td>
                           <td><a href="sms_template.php">SMS Template</a></td>
                           <td>/</td>
                           <td><a href="system_sms_template.php">System Generated SMS Template</a></td>
                           <td>/</td>
                            <td><a href="system_sms.php">Manage System Generated SMS</a></td>
                           <td>/</td>
                           <td>Manage System SMS Group</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage System SMS Group</b></div></div>
                
               <div class="main_work_data" style="">
                   <div class="left_add_work_div">
                    <div class="heading_title_td">Add System SMS Group</div>    
                      
                   
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td><b>System SMS Group</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="sms_system_group_name" 
                                   placeholder="Enter system sms group" class="text_box_org"
                                   name="sms_system_group_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
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
                   <div class="heading_title_td">List Of System SMS Group</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>System SMS Group</td>
                            <td>Description</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                      <?php 
                        $row=0;
                     $sms_system_group_db=mysql_query("SELECT * FROM sms_system_group_db WHERE $db_main_details_whout_session is_delete='none'");   
                     while ($fetch_sms_system_group_data=mysql_fetch_array($sms_system_group_db))
                     {
                         $row++;
                                $fetch_sms_system_group_db_id=$fetch_sms_system_group_data['id'];
                                $fetch_sms_system_group_name=ucwords($fetch_sms_system_group_data['sms_category_name']) ;
                                $fetch_sms_system_group_description=$fetch_sms_system_group_data['description'];
                                 
                     echo "<tr id='delete_row_$fetch_sms_system_group_db_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                       <td><b>$fetch_sms_system_group_name</b></td>
                                       <td>$fetch_sms_system_group_description</td>
                                <td style='border-right:1px solid gray; width:130px;'>";
                                {
                                    ?>
                        <abbr title="Edit system sms group">
                            <a style="color:blue;" href="#" onclick="window.open('edit_sms_group.php?token_id=<?php  echo $fetch_sms_system_group_db_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete system sms group">                            
                            <div onclick="delete_data('<?php  echo $fetch_sms_system_group_db_id;?>','sms_system_group_delete_command')" class="edit_delete_button">Delete</div>
                       </abbr>
                        
                      <?php 
                        }       
                                echo"</td>
                                 </tr>";     
                                             
                                 
                                 
                                 
                                 
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