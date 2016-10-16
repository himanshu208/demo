<?php
//SESSION CONFIGURATION
$check_array_in="system_setting";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php
   $message_show="";
  if(isset($_POST['submit_data_process']))
  {   
      $house_update_db_id=$_POST['house_unique_id'];
      $house_name=$_POST['house_name'];
      $house_full_name=$_POST['house_full_name'];
      $description=$_POST['description'];
      if((!empty($house_name))&&(!empty($house_update_db_id)))
      {
       $final_house_id=$house_update_db_id;
          
          
       $check_house_record=  mysql_query("SELECT * FROM house_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and house_id!='$final_house_id' and house_name='$house_name' and is_delete='none'");
       $fetch_house_data= mysql_fetch_array($check_house_record);
       $fetch_house_num_rows=  mysql_num_rows($check_house_record);
      if((empty($fetch_house_data))&&($fetch_house_data==null)&&($fetch_house_num_rows==0))
      {
     
         $update_db=  mysql_query("UPDATE house_db SET house_name='$house_name',house_full_name='$house_full_name',"
                 . "description='$description' WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and house_id='$final_house_id' and is_delete='none'");
          
          
         if($update_db)
         {
          $message_show="<span style='color:green;'>Record Update successfully complete</span>";   
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
        <title>Edit House Details</title>
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
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validateForm();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit House Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div> 
          <?php 
            if(!empty($_REQUEST['token_id']))
            {
            $token_id=$_REQUEST['token_id'];
   
$house_db=mysql_query("SELECT * FROM house_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and encrypt_id='$token_id' and is_delete='none'");
$fetch_house_data= mysql_fetch_array($house_db);
$fetch_house_num_rows=mysql_num_rows($house_db);
if((!empty($fetch_house_data))&&($fetch_house_data!=null)&&($fetch_house_num_rows!=0))
{

            $house_db_id=$fetch_house_data['id'];
            $house_unique_id=$fetch_house_data['house_id'];
            $house_name=$fetch_house_data['house_name'];
            $house_full_name=$fetch_house_data['house_full_name'];
            $house_description=$fetch_house_data['description'];
    
?>
            
            <input type="hidden" name="house_unique_id" value="<?php  echo $house_unique_id;?>">
            <div class="edit_main_work_div">
                <div class="edit_center_div_tag">
                    
             <table cellspacing="2" cellpadding="2"  style="margin:0 auto;
                         margin-top:10px;  font-size:12px;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                   <tr><td>House Name <sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="house_name" 
                                   value="<?php  echo $house_name;?>"  placeholder="Enter house name" class="text_box_org"
                                   name="house_name"></td>
                    </tr>
                    <tr>
                        <td style=" height:7px; "></td>
                    </tr>
                    <tr><td>House Full Name</td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="section_name" 
                                   value="<?php  echo $house_full_name;?>"  placeholder="Enter house full name" class="text_box_org"
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
                                     id="address_text_area"><?php  echo $house_description;?></textarea>
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
            
            
            
            </div>
            </div>
          <?php 
            }
            }
            ?>
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