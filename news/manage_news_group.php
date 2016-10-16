<?php
//SESSION CONFIGURATION
$check_array_in="news";
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
  
$result=mysql_query("SHOW TABLE STATUS LIKE 'news_group_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_news_group_id="NEWS_GRUP_$nextId"; 
$encrypt_id=md5(md5($final_news_group_id));
  
  
      
      $news_group_name=$_POST['news_group_name'];
      $description=$_POST['description'];
      $session_id=$_POST['use_inset_session_id'];
      
      if((!empty($news_group_name)))
      {
       $check_news_group_record=mysql_query("SELECT * FROM news_group_db WHERE $db_main_details news_group_id='$final_news_group_id' and is_delete='none'
           OR $db_main_details news_group='$news_group_name' and is_delete='none'");
       $fetch_news_group_data=mysql_fetch_array($check_news_group_record);
       $fetch_news_group_num_rows=mysql_num_rows($check_news_group_record);
      if((empty($fetch_news_group_data))&&($fetch_news_group_data==null)&&($fetch_news_group_num_rows==0))
      {
        
          $insert_news_group_db=mysql_query("INSERT into news_group_db values('','$fetch_school_id','$fetch_branch_id'
                  ,'$session_id','$final_news_group_id','$encrypt_id','$news_group_name','$description'
                  ,'none','$date','$date_time','$user_unique_id','active')"); 
          
         if($insert_news_group_db)
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
        <title>Manage News Group</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        
<script type="text/javascript">
 function org_validate()
 {
     var news_group_name=document.getElementById("news_group_name").value;
     
     if(news_group_name==0)
         {
             alert("Please enter news group");
             document.getElementById("news_group_name").focus();
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
                           <td><a href="news.php">News</a></td>
                           <td>/</td>
                           <td>Manage News Group</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage News Group</b></div></div>
                
               <div class="main_work_data" style="">
                   <div class="left_add_work_div">
                    <div class="heading_title_td">Add New News Group</div>    
                      
                   
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px;  float:left; ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                   <tr><td><b>News Group</b><sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="news_group_name" 
                                   placeholder="Enter news group" class="text_box_org"
                                   name="news_group_name"></td>
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
                   <div class="heading_title_td">List Of News Group</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>News Group</td>
                             <td>Description</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                      <?php 
                     $row=0;
                     $news_group_dbs=mysql_query("SELECT * FROM news_group_db WHERE $db_main_details is_delete='none'");   
                     while ($fetch_news_group_data=mysql_fetch_array($news_group_dbs))
                     {
                         $row++;
                                 $fetch_news_group_db_id=$fetch_news_group_data['id'];
                                 $fetch_news_group_unique_id=$fetch_news_group_data['news_group_id'];
                                 $encrypt_id=$fetch_news_group_data['encrypt_id'];
                                 $fetch_news_group_name=$fetch_news_group_data['news_group'];
                                $fetch_news_group_description=$fetch_news_group_data['description'];
                                 
                     echo "<tr id='delete_row_$fetch_news_group_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                       <td><b>$fetch_news_group_name</b></td>
                                       <td>$fetch_news_group_description</td>
                                <td style='border-right:1px solid gray; width:130px;'>";
                                {
                                    ?>
                       
                            <a style="color:blue;" href="#" onclick="window.open('edit_news_group.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        
                        
                                                   
                        <div onclick="delete_data('<?php  echo $fetch_news_group_unique_id;?>','news_group_delete_command')" class="edit_delete_button">Delete</div>
                      
                        
                      <?php 
                        }       
                                echo"</td>
                                 </tr>";     
                                             
                                 
                                 
                                 
                                 
                     }
                     
                     if(empty($fetch_news_group_db_id))
                     {
                         echo '<tr><td colspan="5" style="text-align:center; color:Red;  border:1px solid black; border-top:0; font-size:15px; height:45px;">Record no found !</td></tr>';   
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