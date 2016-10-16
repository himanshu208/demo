<?php
//SESSION CONFIGURATION
$check_array_in="sms_module";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
    </head>
    <body>
        <div id="include_header_page">
          <?php 
include_once '../ajax_loader_page_second.php';
          ?>
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
                           <td><a href="sms_dashboard.php">SMS (Phone/Email)</a></td>
                           <td>/</td>
                           <td><a href="manage_template.php">Manage Template</a></td>
                           <td>/</td>
                           <td>Email Template</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>List Of Email Template</b></div>
                </div>
                 
                
              <div class="middle_left_div_tag">
              <div style=" width:100%; height:10px; "></div>
              <a href="create_email_template.php">
                  <div class="add_button" style=" background-color:darkgreen; height:30px; float:right; 
                       padding-top:12px;   ">Create Email Template</div></a> 
              
              <div style=" width:100%; height:auto; margin-top:20px;float:left; ">
                  <div style=" width:80%; height:auto; margin:auto;   ">
                  
                     <?php
                    $sms_message_type_db=mysql_query("SELECT * FROM sms_message_type_db WHERE $db_main_details_whout_session is_delete='none'");   
                     while ($fetch_sms_message_type_data=mysql_fetch_array($sms_message_type_db))
                     {
                       
                                 $fetch_sms_message_type_db_id=$fetch_sms_message_type_data['id'];
                                 $fetch_sms_message_type_unique_id=$fetch_sms_message_type_data['message_type_id'];
                                 $encrypt_id=$fetch_sms_message_type_data['encrypt_id'];
                                 $fetch_sms_message_type_name=$fetch_sms_message_type_data['message_type'];
                                $fetch_sms_message_type_description=$fetch_sms_message_type_data['description'];
                                
                     $sms_template=mysql_query("SELECT * FROM sms_email_template_db WHERE $db_main_details_whout_session"
                             . " message_type_id='$fetch_sms_message_type_unique_id' and is_delete='none'");           
                     $sms_template_num_rows=mysql_num_rows($sms_template); 
                     
                     if(!empty($sms_template_num_rows))
                     {
                     ?>
                      
                      <div class="title_heading_template"><?php echo $fetch_sms_message_type_name;?></div> 
                      <div style=" border:1px solid black; ">
                  <?php
                     }
                  while ($sms_template_data=mysql_fetch_array($sms_template))
                  {
                  $template_unqiue_id=$sms_template_data['sms_template_id'];
                  $template_encrypt_id=$sms_template_data['encrypt_id'];
                 $template_name=$sms_template_data['template_name'];
                 $template=$sms_template_data['sms_template'];    
                 $subject=$sms_template_data['subject'];  
                  $last_update_at=$sms_template_data['last_update_date'];
                  ?>
                      
                          <div class="sms_template_div" id='delete_row_<?php echo $template_unqiue_id;?>'>
                      <table style=" width:100%; ">
                          <tr>
                              <td valign='top' style=" width:50px; "><center><img style=" margin-left:15px;  " src="../images/msg.png"></center></td>
                              <td style=" border-right:1px solid black; padding-left:10px;  "></div></td>
                              <td valign='top'>
                                  <table style="width:100%;  margin-left:10px; ">
                                      <tr>
                                          <td><b style=" color:darkorange; font-size:19px;  ">
                                              <?php echo $template_name;?></b>
                                          
                                          <span style=" text-align:right;  float:right; font-size:11px;  ">
                                                  <b>Edited At: </b> <?php echo $last_update_at;?>  
                                              </span>
                                          </td>
                                          <td style=" width:170px; ">
                            <a style="color:blue;" href="#" onclick="window.open('edit_email_template.php?token_id=<?php  echo $template_encrypt_id;?>','size',config='height=500,width=670,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                                       <div onclick="delete_data('<?php  echo $template_unqiue_id;?>','sms_email_template_delete_command')" class="edit_delete_button">Delete</div>
                      
                                          </td>
                                      </tr>
                                      <tr>
                                          <td style=" height: 10px;"></td>   
                                      </tr>
                                      <tr>
                                          <td colspan="3">
                                              <div class="subject_heading"><b>Subject :</b> <?php echo $subject;?></div>   
                                          </td>
                                      </tr>
                                      <tr>
                                          <td colspan="2"><?php echo  $template;?></td>
                                      </tr>
                                  </table>
                              </td>
                          </tr>
                      </table>    
                  </div>  
                  
                  
                  <?php
                  }
                  
                  echo "</div>";
                     }
                  ?>
                  
              
           
              
              
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