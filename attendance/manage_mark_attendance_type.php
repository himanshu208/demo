<?php
//SESSION CONFIGURATION
$check_array_in="attendance";
require_once '../config/configuration.php';
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

$class_id=$_POST['class_id']; 
$section_id=$_POST['section_id']; 
$mark_attendance_type=$_POST['mark_attendance_type'];   
$mark_attendance=$_POST['mark_attendance'];
$description=$_POST['description'];
$insert_session_id=$_POST['use_inset_session_id'];

  if((!empty($class_id))&&(!empty($section_id))&&(!empty($mark_attendance_type))&&(!empty($mark_attendance))) 
  {
      
  $match_data_db=mysql_query("SELECT * FROM attendance_type WHERE $db_main_details class_id='$class_id' and section_id='$section_id' and is_delete='none'");    
  $match_data=mysql_fetch_array($match_data_db);  
  $match_num_rows=mysql_num_rows($match_data_db);
  if((empty($match_data))&&($match_data==null)&&($match_num_rows==0))
  {
  
$result=mysql_query("SHOW TABLE STATUS LIKE 'attendance_type'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_fee_id="ATYPE_$nextId";                            
$encrypt_id=md5(md5($final_fee_id));
                                  
$insert_attendance_type=mysql_query("INSERT into attendance_type values('','$fetch_school_id','$fetch_branch_unique_db_id','$insert_session_id'"
        . ",'$final_fee_id','$encrypt_id','$class_id','$section_id','$mark_attendance','$mark_attendance_type','$description'"
        . ",'none','$date','$date_time','$fecth_user_unique','active')");      
  if($insert_attendance_type)
{
 $message_show="<span style='color:green;'>Record save successfully complete</span>";  
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


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
          <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
          <script type="text/javascript">
            function validateForm()
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
          <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    <body>
         <?php 
      include_once '../ajax_loader_page_second.php';
      ?>  
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div> 
        
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td><a href="attendance_dashboard.php">Attendance</a></td>
                           <td>/</td>
                           <td><a href="attendance_setting.php">Attendance Setting</a></td>
                          <td>/</td>
                          <td>Manage Mark Attendance Type</td>
                       </tr>
                   </table>   
               </div>
               <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
           
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
                    <div id="transport_function" class="Short_menu_show"><b>Manage Mark Attendance Type</b></div>
                   
                   </div>
             
               <div class="main_work_data">
                   <div class="left_add_work_div">
                   <div class="heading_title_td">Add New Mark Attendance Type</div>    
                      
                   
                  <table cellspacing="2" cellpadding="2" id="org_table_style" style="  font-size:12px;  float:left; ">
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
                                
                               echo "<option value='$fetch_class_id'>$fetch_class_name</option>";
                               }
                               ?>    
                               </select></td>
                       </tr>
                        <tr>
                           <td><b>Section <sup style=" color: red;">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select class="select_box_style" id="section_name" name="section_id" >
                                   <option value="0">---Select---</option>
                                          
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
                               <textarea class="description_text_box" style=" width:205px; " name="description"></textarea>
                           </td>
                       </tr>
                       <tr>
                           <td></td>
                       </tr>
                       <tr>
                           <td colspan='3'>
                           <input type="submit" value="Save" name="attendance_type_save" id="addfeesname" class="add_button_reset_button">    
                           <input type="Reset" onclick="reset_button()" value="Reset" class="add_button_reset_button" style="background-color: deeppink;">
                           </td>
                       </tr>
               </table>  
                   </div>  
                   
                   <div class="verticle_length"></div>
                   
                   <div class="right_fetch_work_div">
                   <div class="heading_title_td">List Of Mark Attendance Type</div>    
                   <table cellspacing="0" cellpadding="0" class="session_fetch_details">
                        <tr class="table_heading">
                            <td>Sl. No.</td>
                            <td>Class</td>
                            <td>Section</td>
                             <td>Mark Attendance</td>
                              <td>Attendance Type</td>
                               <td>Description</td>
                              <td style="border-right:1px solid gray; ">Action</td>
                        </tr>
                        
                      <?php 
                        $row=0;
                     $attendance_type_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id,T1.description as db_description FROM attendance_type as T1"
                            ." LEFT JOIN course_db as T2 ON T1.class_id=T2.course_id "
                            . "LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                            ." WHERE $db_t1_main_details T1.is_delete='none'");   
                     while ($fetch_attendance_type_data=mysql_fetch_array($attendance_type_db))
                     {
                         $row++;
                             $attendance_type_unique_id=$fetch_attendance_type_data['attendance_type_id'];
                             $encrypt_id=$fetch_attendance_type_data['t1_encrypt_id'];
                             $class=$fetch_attendance_type_data['course_name'];
                             $section=$fetch_attendance_type_data['section_name'];
                             $mark_attendance=ucwords($fetch_attendance_type_data['mark_attendance']); 
                             $description=ucwords($fetch_attendance_type_data['db_description']);
                             $attendance_type=$fetch_attendance_type_data['attendance_type'];  
                             if($attendance_type=="one_time")
                             {
                                $attendance_type="One Time"; 
                             }
                             
                     echo "<tr id='delete_row_$attendance_type_unique_id' class='td_data_style'>
                                   <td><b>$row</b></td> 
                                       <td><b>$class</b></td>
                                       <td>$section</td>
                                       <td>$mark_attendance</td>
                                       <td>$attendance_type</td>
                                       <td>$description</td>
                                <td style='border-right:1px solid gray; width:130px;'>";
                                {
                                    ?>
                       
                            <a style="color:blue;" href="#" onclick="window.open('edit_attendance_type.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=400,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        
                        
                        
                                                 
                            <div onclick="delete_data('<?php  echo $attendance_type_unique_id;?>','attendance_type_delete_command')" class="edit_delete_button">Delete</div>
                      
                        
                      <?php 
                        }       
                                echo"</td>
                                 </tr>";     
                                             
                                 
                                 
                                 
                                 
                     }
                     if(empty($attendance_type_unique_id))
                     {
                         echo "<tr><td colspan='9' style=' border:1px solid black;  height:30px; font-weight:bold; text-align:center; color:red; border-top:0; '>Record no found !!</td></tr>";  
                         
                     }
                        
                        ?>
                        
                        
                        
                        
                   </table>
                   
                       
                   </div> 
               </div>
              </form>
                <div style=" width:1000px; height:30px; float:left;   "></div>
              
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