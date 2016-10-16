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
        <title>Manage System SMS Template</title>
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
                           <td>System Generated SMS Template</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>System Generated SMS Template</b></div>
                </div>
               <script type="text/javascript">
                   function show_option(number)
                   {
                    var temp_number=document.getElementById("temp_number_"+number+"").value;   
                    if(temp_number==0)
                    {
                    document.getElementById("system_sms_show_"+number+"").style.display="block";    
                    document.getElementById("temp_number_"+number+"").value=1;    
                    }else
                    {
                     document.getElementById("system_sms_show_"+number+"").style.display="none";    
                     document.getElementById("temp_number_"+number+"").value=0;    
                    }
                   }
                   </script>
                
              <div class="middle_left_div_tag">
              <div style=" width:100%; height:10px; "></div>
            
              <div style=" width:100%; height:auto; margin-top:20px;float:left; ">
                  <div style=" width:80%; height:auto; margin:auto;   ">
                      <span style=" color:red; font-size:16px; font-weight:bold; float:right;   ">*Please do not remove the content within the # #</span>
                     <br/>
                     <br/>
                    <br/>
                    <br/>
                         
                         <?php
                         $row=0;
                         $system_sms_category_db=mysql_query("SELECT * FROM sms_system_group_db WHERE $db_main_details_whout_session "
                                 . "is_delete='none'");
                         while ($system_data=mysql_fetch_array($system_sms_category_db))
                         {
                         $category_id=$system_data['id'];     
                         $category_name=ucwords($system_data['sms_category_name']);  
                         $description=ucwords($system_data['description']);
                        $row++;
                         ?>
                         <div style=" width:100%; border-radius:4px; margin-top:15px;   border:1px solid; float:left;  ">
                     
                         <div onclick="show_option('<?php echo $row;?>')" class="system_genrated_div">
                         <table >
                             <tr> 
                                 <td style=" width:110px; "><img style=" margin-left:20px; " src="../images/auto_sms.png"></td>
                                 <td><?php echo $category_name;?> <br/> <span style=" font-size:11px; "><?php echo $description;?></span></td>
                                 <td style=" width:100px; "><img src="../images/down_1.png"></td>
                             </tr>
                         </table> 
                     </div>
                     
                         <div id="system_sms_show_<?php echo $row;?>" style=" display:none;  width:100%; height:auto; float:left; margin-bottom:10px;    ">
                             <input type="hidden" id='temp_number_<?php echo $row;?>' value="0">
                            
                         <?php
                         $system_sms_template_db=mysql_query("SELECT * FROM sms_system_template_db WHERE $db_main_details_whout_session "
                                 . " system_sms_group_id='$category_id' and is_delete='none'");
                         $system_sms_num_rows=mysql_num_rows($system_sms_template_db);
                         while ($system_sms_data=mysql_fetch_array($system_sms_template_db))
                         {
                         $template_id=$system_sms_data['id'];    
                         $template_name=$system_sms_data['template_name'];
                         $template=$system_sms_data['template'];       
                        $last_update_at=$system_sms_data['last_update_date'];
                         ?>    
                             
                             
                      <div class="sms_template_div" >
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
                                          
                                          
                                          <td style=" width:80px; ">
                            <a style="color:blue;" href="#" onclick="window.open('edit_system_sms_generated.php?token_id=<?php  echo $template_id;?>','size',config='height=500,width=670,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; float:right;  width:45px;">Edit</div></a>
                                     
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
                         if(empty($system_sms_num_rows))
                         {
                             echo "<center><br/><span style='color:red; font-size:15px; padding-top:30px;'><b>No templates found</b></span></center>";  
                         }
                   ?>          
                             
                             
                     </div>   
                      </div>
                    
                    
                    <?php
                         }
                    ?>
                   
           
                    <br/>
                   
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