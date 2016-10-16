<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
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
 
  
      $update_db_id=$_POST['update_unique_id'];
       $sms_system_group_name=$_POST['sms_group'];
       $use_module=$_POST['use_module'];
       $template_name=$_POST['template_name'];        
       $description=$_POST['template'];
       $insert_session=$_POST['use_inset_session_id'];
      if((!empty($update_db_id))&&(!empty($sms_system_group_name))&&(!empty($use_module))&&(!empty($template_name))&&(!empty($description)))
      {
       $check_sms_system_group_record=mysql_query("SELECT * FROM sms_system_template_db WHERE $db_main_details_whout_session"
               . " id!='$update_db_id' and system_sms_group_id='$sms_system_group_name' and use_module='$use_module' "
               . "and template_name='$template_name' and template='$description' and is_delete='none'");
       $fetch_sms_system_group_data= mysql_fetch_array($check_sms_system_group_record);
       $fetch_sms_system_group_num_rows=  mysql_num_rows($check_sms_system_group_record);
      if((empty($fetch_sms_system_group_data))&&($fetch_sms_system_group_data==null)&&($fetch_sms_system_group_num_rows==0))
      {
       
        $update_db=mysql_query("UPDATE sms_system_template_db SET system_sms_group_id='$sms_system_group_name'"
                . ",use_module='$use_module',template_name='$template_name',template='$description'"
                . ",last_update_date='$date_time' WHERE id='$update_db_id' and is_delete='none'");  
         if($update_db)
         {
          $message_show="<span style='color:green;'>Record update successfully complete</span>";   
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
        <title>Edit System SMS Template</title>
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
 function org_validate()
 {
   var sms_group=document.getElementById("sms_group").value;
   var module=document.getElementById("use_module").value;
   var template_name=document.getElementById("template_name").value;
   var template=document.getElementById("template").value;
   
   if(sms_group==0)
   {
      alert("Please select system SMS group");
      document.getElementById("sms_group").focus();
      return false;
   }else
       if(module==0)
   {
     alert("Please select sms use module");
     document.getElementById("use_module").focus();
     return false;
   }else
       if(template_name==0)
   {
     alert("Please enter template name");
     document.getElementById("template_name").focus();
     return false;
   }else
       if(template==0)
   {
      alert("Please enter template");
      document.getElementById("template").focus();
      return false;
   }else
   {
       document.getElementById("ajax_loader_show").style.display="block";    
              
   }
 }
</script>
   
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return org_validate();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit System SMS Template</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM sms_system_template_db WHERE $db_main_details_whout_session"
                    . " id='$token_id' and is_delete='none'"); 
            $fetch_sms_system_group_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_sms_system_group_data))&&($fetch_sms_system_group_data!=null)&&($fetch_num_data!=0))
            {
                                $fetch_template_id=$fetch_sms_system_group_data['id'];
                                $fetch_sms_system_group_id=$fetch_sms_system_group_data['system_sms_group_id'];
                                $fetch_template=$fetch_sms_system_group_data['template'];
                                $use_module=$fetch_sms_system_group_data['use_module'];
                                $template_name=$fetch_sms_system_group_data['template_name'];
              $session_id=$fetch_sms_system_group_data['session_id'];    
              
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $fetch_template_id;?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
           <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px; width:auto; margin:auto;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr><td><b>System SMS Group</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select id="sms_group" name="sms_group" class="attendance_select">
                                  <option value="0">--- Select ---</option> 
                                  <?php
                                   $sms_system_group_db=mysql_query("SELECT * FROM sms_system_group_db WHERE $db_main_details_whout_session is_delete='none'");   
                     while ($fetch_sms_system_group_data=mysql_fetch_array($sms_system_group_db))
                     {
                        
                                $fetch_sms_system_group_db_id=$fetch_sms_system_group_data['id'];
                                $fetch_sms_system_group_name=ucwords($fetch_sms_system_group_data['sms_category_name']) ;
                                $fetch_sms_system_group_description=$fetch_sms_system_group_data['description'];
                                if($fetch_sms_system_group_id==$fetch_sms_system_group_db_id)
                                {
                                echo "<option value='$fetch_sms_system_group_db_id' selected>$fetch_sms_system_group_name</option>";      
                                }else
                                {
                                   echo "<option value='$fetch_sms_system_group_db_id'>$fetch_sms_system_group_name</option>";      
                                 
                                }
                                }
                                  ?>
                            </select></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr><td><b>Use Module</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><select id="use_module" name="use_module" class="attendance_select">
                                  <option value="0">--- Select ---</option> 
                                  <?php
                                  $module_list=array("admission","employee_registration","transport","hostel","library",
                                      "fees","examination");
                                  foreach ($module_list as $module)
                                  {
                                  
                                   if($use_module==$module)
                                   {
                                    $explode_module=explode("_",$module);    
                                   echo "<option value='$module' selected>";
                                   foreach ($explode_module as $module_name)
                                   {
                                       echo " $module_name ";   
                                   }
                                   echo "</option>";
                                   }else
                                   {
                                     $explode_module=explode("_",$module);   
                                    echo "<option value='$module'>";
                                   foreach ($explode_module as $module_name)
                                   {
                                       echo " $module_name ";   
                                   }
                                   echo "</option>";   
                                   }
                                  }
                                  
                                  
                                  
                                  ?>
                            </select></td>
                    </tr>
                      <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr><td><b>Template Name</b> <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="template_name" 
                                   placeholder="Enter template name" class="text_box_org"
                                   name="template_name" value="<?php echo $template_name;?>"></td>
                    </tr>
                      <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td><b>Template <sup>*</sup></b></td>
                        <td><b>:</b></td>
                        <td>
                            <textarea id="template" autocomplete="off" class="text_area_style" 
                                      placeholder="Enter template" name="template" 
                                      id="address_text_area"><?php echo $fetch_template;?></textarea>
                        </td>
                    </tr>
                    <tr>
                    <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button" onclick="return org_validate();" id="save_button" 
                                   value="Update">   
                        </td>
                    </tr>
               </table>          
                
                
            <?php
             }
            }
             }
            ?>
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By : DIGI SHIKSHA</div>
            
            
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