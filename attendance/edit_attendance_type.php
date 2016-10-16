<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>

<?php 
$message_show="";
if(isset($_POST['attendance_type_save']))
{
  date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
$update_db_id=$_POST['update_unique_id'];
$class_id=$_POST['class_id']; 
$section_id=$_POST['section_id']; 
$mark_attendance_type=$_POST['mark_attendance_type'];   
$mark_attendance=$_POST['mark_attendance'];
$description=$_POST['description'];
$insert_session_id=$_POST['use_inset_session_id'];

  if((!empty($class_id))&&(!empty($section_id))&&(!empty($mark_attendance_type))&&(!empty($mark_attendance))) 
  {
      
  $match_data_db=mysql_query("SELECT * FROM attendance_type WHERE $db_main_details attendance_type_id!='$update_db_id' and class_id='$class_id' and section_id='$section_id' and is_delete='none'");    
  $match_data=mysql_fetch_array($match_data_db);  
  $match_num_rows=mysql_num_rows($match_data_db);
  if((empty($match_data))&&($match_data==null)&&($match_num_rows==0))
  {


$update_db_id=  mysql_query("UPDATE attendance_type SET class_id='$class_id',section_id='$section_id',mark_attendance='$mark_attendance',"
        . "attendance_type='$mark_attendance_type',description='$description' WHERE attendance_type_id='$update_db_id' and is_delete='none'");
  if($update_db_id)
{
 $message_show="<span style='color:green;'>Record update successfully complete</span>";  
}else
{
 $message_show="Request failed,please try again"; 
} 
}else
{
 $message_show="Record already exist in database"; 
} 
  }else
{
 $message_show="Please fill all fields."; 
} 
require_once '../pop_up.php';

}

?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Mark Attendance Type</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
          <script type="text/javascript">
            function validate_form()
            {
                    var class_id=document.getElementById("class_name").value;
                    var section_id=document.getElementById("section_name").value;
                    var mark_attendance=document.getElementById("mark_attendance").value;
                    var attendance_type=document.getElementById("mark_attendance_type").value;
                    if(class_id==0)
                    {
                       alert("Please select class/course");
                       document.getElementById("class_name").focus();
                       return false;
                    }else
                        if(section_id==0)
                    {
                       alert("Please select section");
                       document.getElementById("section_name").focus();
                       return false;
                    }else
                        if(mark_attendance==0)
                    {
                       alert("Please select mark attendance");
                       document.getElementById("mark_attendance").focus();
                       return false;
                    }else
                        if(attendance_type==0)
                    {
                       alert("Please select attendance type");
                       document.getElementById("mark_attendance_type").focus();
                       return false;
                    }else
                    {
                    document.getElementById("ajax_loader_show").style.display="block";    
                    }
                    
            }
          </script>
        
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
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validate_form();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Mark Attendance Type</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
                    
                <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];
             
            $select_data=mysql_query("SELECT * FROM attendance_type WHERE $db_main_details encrypt_id='$token_id' and is_delete='none'"); 
            $fetch_data=mysql_fetch_array($select_data);
            $fetch_num_data=mysql_num_rows($select_data);
            if((!empty($fetch_data))&&($fetch_data!=null)&&($fetch_num_data!=0))
            {
            
              $session_id=$fetch_data['session_id'];    
              $class=$fetch_data['class_id'];
              $section=$fetch_data['section_id'];
              $description=$fetch_data['description'];     
             {
             ?>  
              <input type="hidden" id="update_unique_id" name="update_unique_id" value="<?php echo $fetch_data[4];?>">
             <input type="hidden" name="use_inset_session_id" id="insert_session_id"  value="<?php  echo $session_id;?>">   
      
               
             
              <table cellspacing="2" cellpadding="2" id="org_table_style" style=" font-size:12px; width:400px;
                     margin:auto;  ">
                    <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                    </tr> 
                       <tr>
                           <td><b>Class <sup style=" color: red;">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select class="select_box_style" id="class_name" name="class_id" onchange="change_class_name(this.value)">
                                   <option value="0">---Select---</option>
                                       <?php 
                               $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                               while ($fetch_class_data=mysql_fetch_array($class_db))
                               {
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                                if($class==$fetch_class_id)
                                {
                               echo "<option value='$fetch_class_id' selected>$fetch_class_name</option>";
                                }else
                                {
                                 echo "<option value='$fetch_class_id'>$fetch_class_name</option>";
                                   
                                }
                               }
                               ?>    
                               </select></td>
                       </tr>
                        <tr>
                           <td><b>Section <sup style=" color: red;">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select class="select_box_style" id="section_name" name="section_id" >
                                   <option value="0">---Select---</option>
                                    
                                    <?php 
                
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$class' and action='active'");
    while ($fetch_class_data=mysql_fetch_array($section_db))
    {
        $fetch_section_id=$fetch_class_data['section_id'];
        $fetch_section_name=$fetch_class_data['section_name'];
        if($section==$fetch_section_id)
        {
        echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
        }else
        {
         echo "<option value='$fetch_section_id'>$fetch_section_name</option>";   
        }
    }                         
                                  ?>
                               </select></td>
                       </tr>
                       <tr>
                           <td><b>Mark Attendance <sup style=" color: red;">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select class="select_box_style" name="mark_attendance" id='mark_attendance'>
                                   <option value="daily">Daily</option>
                                   <option value="weekly" disabled="">Weekly</option>
                                   <option value="monthly" disabled="">Monthly</option>
                                   <option value="yearly" disabled="">Yearly</option>
                               </select></td>
                       </tr>
                        <tr>
                            <td style=" width:300px; "><b>Attendance Type <sup style=" color: red;">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select name='mark_attendance_type' id='mark_attendance_type' class="select_box_style" >
                                           <option value='one_time'>One Time</option>
                                           <option value='two_time' disabled="">Two Time (Morning & Evening)</option>
                                           <option value='lecture' disabled="">Lecture</option>
                               </select></td>
                       </tr>
                       <tr>
                           <td style=" width:300px; "><b>Description</b></td>
                           <td><b>:</b></td>
                           <td>
                               <textarea class="description_text_box" style=" width:205px; " name="description"><?php echo $description;?></textarea>
                           </td>
                       </tr>
                       <tr>
                           <td></td>
                       </tr>
                       <tr>
                           <td colspan='3'>
                           <input type="submit" value="Update" name="attendance_type_save" id="addfeesname" class="add_button_reset_button">    
                           <input type="Reset" onclick="reset_button()" value="Reset" class="add_button_reset_button" style="background-color: deeppink;">
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
            <div class="edit_fotter_div_tag">Design & Develop By :  Pixabyte Technologies Pvt. Ltd.</div>
            
            
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