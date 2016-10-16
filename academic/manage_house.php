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
  
$result=mysql_query("SHOW TABLE STATUS LIKE 'house_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_house_id="HOUSE_$nextId"; 
$encrypt_id=md5(md5($final_house_id));
  
  
      
      $house_name=$_POST['house_name'];
      $house_full_name=$_POST['house_full_name'];
      $description=$_POST['description'];
      if((!empty($house_name)))
      {
       $check_house_record=  mysql_query("SELECT * FROM house_db WHERE organization_id='$fetch_school_id'
               and branch_id='$fetch_branch_id' and house_id='$final_house_id' and is_delete='none'
           OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and house_name='$house_name' and is_delete='none'");
       $fetch_house_data= mysql_fetch_array($check_house_record);
       $fetch_house_num_rows=  mysql_num_rows($check_house_record);
      if((empty($fetch_house_data))&&($fetch_house_data==null)&&($fetch_house_num_rows==0))
      {
        
          $insert_house_db=  mysql_query("INSERT into house_db values('','$fetch_school_id','$fetch_branch_id'
                  ,'$final_house_id','$encrypt_id','$house_name','$house_full_name','$description'
                  ,'none','$date','$date_time','$user_unique_id','active')"); 
          
         if($insert_house_db)
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
        <title>Manage House</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
<script type="text/javascript">
 function org_validate()
 {
     var house_name=document.getElementById("house_name").value;
     
     if(house_name==0)
         {
             alert("Please enter house name");
             document.getElementById("house_name").focus();
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
                           <td>Manage House</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage House</b></div></div>
                
               <div class="main_work_data" style="">
                   <div class="left_add_work_div">
                    <div class="heading_title_td">Add New House</div>    
                      
                   
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                   <tr><td>House Name <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="house_name" 
                                   placeholder="Enter house name" class="text_box_org"
                                   name="house_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr><td>House Full Name</td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="section_name" 
                                   placeholder="Enter house full name" class="text_box_org"
                                   name="house_full_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr>
                        <td>Description</td>
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
                   <div class="heading_title_td">View House Details</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>House Name</td>
                            <td>House Full Name</td>
                             <td>Description</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                      <?php 
                        $row=0;
                     $house_db=mysql_query("SELECT * FROM house_db WHERE organization_id='$fetch_school_id' and"
                             . " branch_id='$fetch_branch_id' and is_delete='none'");   
                     while ($fetch_house_data=mysql_fetch_array($house_db))
                     {
                         $row++;
                                 $fetch_house_db_id=$fetch_house_data['id'];
                                 $fetch_house_unique_id=$fetch_house_data['house_id'];
                                 $encrypt_id=$fetch_house_data['encrypt_id'];
                                 $fetch_house_name=$fetch_house_data['house_name'];
                                 $fetch_house_full_name=$fetch_house_data['house_full_name'];
                                 $fetch_house_description=$fetch_house_data['description'];
                                 
                     echo "<tr id='delete_row_$fetch_house_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                       <td><b>$fetch_house_name</b></td>
                                       <td style='width:28%;'>$fetch_house_full_name</td>
                                       <td>$fetch_house_description</td>
                                <td style='border-right:1px solid gray; width:130px;'>";
                                {
                                    ?>
                        <abbr title="Edit Session Details">
                            <a style="color:blue;" href="#" onclick="window.open('edit_house_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete Session">                            
                            <div onclick="delete_data('<?php  echo $fetch_house_unique_id;?>','house_delete_command')" class="edit_delete_button">Delete</div>
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