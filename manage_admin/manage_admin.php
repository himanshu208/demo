<?php
//SESSION CONFIGURATION
$check_array_in="manage_admin";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Manage Admin</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    <body>
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
                           <td>Manage Admin</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
           
              <div id="top_show_button">
                    <div id="transport_function" class="Short_menu_show"><b>Manage Admin</b></div>
                     
                </div>
                <div class="main_work_data" style=" padding-top:20px;">
                <div class="middle_left_div_tag">
                         <a href="add_admin.php">
                        <div class="add_admin_button">Add New Admin</div></a>
                        
                    <table cellspacing="0" cellpadding="0" class="table_details" style=" margin-top:20px; ">
                       <tr class="th_heading_style">
                           <td>Sl. No.</td>
                           <td>Account Type</td>
                           <td>Username</td>
                           <td>Password</td>
                           <td>Admin Name</td>
                           <td>Admin Full Detail</td>
                            <td>Module</td>
                           <td style=" border-right:1px solid black;   ">Action</td>
                       </tr>   
                       
                      <?php
                      $row=0;
                      $login_db=mysql_query("SELECT * FROM login_user_db WHERE $db_main_details_whout_session is_delete='none'");
                      
                      $login_num_rows=mysql_num_rows($login_db);   
                      
                      while ($login_data=mysql_fetch_array($login_db))
                      {
                      $row++;    
                      $admin_type=$login_data['account_type'];
                      $user_name=$login_data['user_name'];
                      $admin_name=ucwords($login_data['full_name']);
                      $admin_id=$login_data['user_admin_id'];     
                      $admin_encrypt_id=$login_data['user_admin_encrypt_id'];
                       
                      if($admin_type=="branch_head_admin")
                      {
                       $print_admin_role="Branch Head Admin";   
                       $module_db=mysql_query("SELECT * FROM module_db WHERE $db_main_details_whout_session admin_type='branch_head_admin'");
                      
                      }else
                      {
                      $print_admin_role="Admin";    
                      $module_db=mysql_query("SELECT * FROM module_db WHERE $db_main_details_whout_session admin_type='admin' and admin_id='$admin_id'");
                         
                      }
                      
                     $fetch_module_data=mysql_fetch_array($module_db);
                     $fetch_module_num_rows=mysql_num_rows($module_db);
                      if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
                      {
                       $module_list=$fetch_module_data['module'];  
                      }else
                      {
                       $module_list="";   
                      }
                      
                       echo "<tr id='delete_row_$admin_id' class='td_styling_data'><td><b>$row</b></td>"
                                        . "<td><b>$print_admin_role</b></td>"
                                        . "<td>$user_name</td>"
                                        . "<td>**********</td>"
                               . "<td>$admin_name</td>"
                               . "<td>"; 
                       {
                       ?>
                         <a style="color:blue;" href="#" onclick="window.open('view_admin_detail.php?token_id=<?php  echo $admin_encrypt_id;?>','size',config='height=640,width=800,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                     
                             <input type="button" class="view_buttoned" value="View"></a>
                       <?php
                       }
                                echo"</td>"
                               . "<td><ul class='module_li'>";
                                
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
                                  
                                   echo "<li>$ab_print $a_print</li>";    
                               }
                                
                                echo"</ul></td>"
                               . "<td style=' width:130px; border-right:1px solid black;'>"; 
                       {
                       ?>
                       
                            <a style="color:blue;" href="#" onclick="window.open('edit_admin.php?token_id=<?php  echo $admin_encrypt_id;?>','size',config='height=600,width=1300,position=absolute,left=0,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        
                        
                        <?php
                         if($admin_type=="branch_head_admin")
                      {
                        ?>
                                           
                       <div class="edit_delete_button" style=" opacity:0.4; cursor:not-allowed;   ">Delete</div>
                       <?php
                      }else
                      {
                       ?>
                      <div onclick="delete_data('<?php  echo $admin_id;?>','admin_delete_command')" class="edit_delete_button">Delete</div>
                    
                        <?php
                      }
                        ?>

 <?php
                       }
                                echo"</td>"
                               
                               . "</tr>";
                      
                      
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