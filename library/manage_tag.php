<?php
//SESSION CONFIGURATION
$check_array_in="library";
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
     
$result=mysql_query("SHOW TABLE STATUS LIKE 'library_tag_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_tag_id="LIB_TAG_$nextId"; 
$encrypt_id=md5(md5($final_tag_id));


$insert_session_id=$_POST['use_inset_session_id'];
$library_tag=$_POST['tag'];
$description=$_POST['description'];

if((!empty($insert_session_id))&&(!empty($library_tag)))
{
 
 $select_db=mysql_query("SELECT * FROM library_tag_db WHERE organization_id='$fetch_school_id' and"
         . " branch_id='$fetch_branch_id' and session_id='$insert_session_id' and tag='$library_tag' and is_delete='none'");   
 $select_data=mysql_fetch_array($select_db);
 $select_num_rows=mysql_num_rows($select_db);
 
 if((empty($select_data))&&($select_data==null)&&($select_num_rows==0))
 {
  
 $insert_db=  mysql_query("INSERT into library_tag_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
         . ",'$final_tag_id','$encrypt_id','$library_tag','$description','none','$date','$date_time','$fecth_user_unique')");    
 if($insert_db)
 {
    $message_show="<span style='color:green;'>Record save successfully complete.</span>";   
 }else
 {
 $message_show="<span style='color:red;'>Request failed,Please try again.</span>";      
 }
 
 
 }else
 {
   $message_show="<span style='color:red;'>Record already exist in database</span>";    
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
        
        <title>Manage Tag</title>
        <script type="text/javascript">
 function validateForm()
 {
  var library_tag=document.getElementById("tag").value;  
  if(library_tag==0)
  {
     alert("Please enter tag");
     document.getElementById("tag").focus();
     return false;
  }
             
 }
</script>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        
    <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    <body>
      
        <?php  include_once '../ajax_loader_page_second.php';?>
        
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div>
        
        <form action="#" method="post" onsubmit="return validateForm();" enctype="multipart/form-data">
       
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="library.php">Library</a></td>
                           <td>/</td>
                           <td><a href="library_setting.php">Library Setting</a></td>
                           <td>/</td>
                           <td>Manage Tag</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
               <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Manage Tag</b></div>
               </div> 
               <div class="main_work_data" style=" padding-top:20px;">
                  <div class="left_add_work_div">
                  <div class="heading_title_td" style="width:96%;  margin-left:0px; ">Add New Tag</div>     
                    
                  <table cellspacing="4" cellpadding="6" id="session_table_style" style=" font-size:13px; ">
                    <tr>
                        <td colspan="3" style=" font-size:13px; "><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                    <tr>
                        <td colspan="3">
                        </td>
                    </tr>
                    <tr><td>Tag<sup>*</sup></td>
                        <td><b>:</b></td>
                        <td><input type="text" autocomplete="off" id="tag" 
                                   placeholder="Please enter tag" class="text_box_org"
                                   name="tag" ></td>
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
                        <td colspan="3">
                            <input type="submit" name="submit_data_process"
                                   class="save_button"  id="save_button"  value="Save">   
                        </td>
                    </tr>
               </table>   
                   </div> 
                    <div class="verticle_length"></div>
                   <div class="right_fetch_work_div">
                    <div class="heading_title_td">View Tag List</div>    
                       
                    <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>Tag</td>
                            <td style=" width:45%; ">Description</td>
                            <td style="width:130px;  border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                        <?php
                         $row=0;
                         $library_tag_db=mysql_query("SELECT * FROM library_tag_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'"
                                . "and session_id='$fecth_session_id_set' and is_delete='none'");
                        while ($fetch_library_tag_data=mysql_fetch_array($library_tag_db))
                        {
                           $row++;
                                 $tag_db_id=$fetch_library_tag_data['id'];
                                 $tag_unique_id=$fetch_library_tag_data['tag_unique_id'];
                                 $encrypt_id=$fetch_library_tag_data['encrypt_id'];
                                 $library_tag=ucwords($fetch_library_tag_data['tag']);
                                 $tag_description=$fetch_library_tag_data['description'];
                            
                                 echo "<tr id='delete_row_$tag_unique_id' class='td_data_style'>
                                      <td><b>$row</b></td> 
                                       <td><b>$library_tag</b></td>
                                       <td>$tag_description</td>
                                   <td style='border-right:1px solid gray;'>";
                                {
                                    ?>
                        <abbr title="Edit Author">
                            <a style="color:blue;" href="#" onclick="window.open('edit_tag_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        </abbr>
                        
                        
                        <abbr title="Delete Author">                            
                            <div onclick="delete_data('<?php  echo $tag_unique_id;?>','library_tag_delete_command')" class="edit_delete_button">Delete</div>
                       </abbr>
                        
                      <?php 
                        }       
                                echo"</td>
                                 </tr>";
                            
                        }
                        
      
                        $fetch_record_num_rows=mysql_num_rows($library_tag_db);
                        if(empty($fetch_record_num_rows))
                        {
                        ?>
                        
                        <tr class="empty_db_alert">
                            <td colspan="7">Sorry, Record No Found !!</td>
                        </tr>
                     <?php 
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