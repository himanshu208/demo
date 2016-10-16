<?php
//SESSION CONFIGURATION
$check_array_in="time_table";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>




<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Active Time Table</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       <script src="javascript/time_table_javascript.js"></script>   
         
    </head>
    <body>
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
                           <td><a href="time_table_dashboard.php">Time Table</a></td>
                           <td>/</td>
                           <td>Active Time Table</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Active Time Table</b></div>
                    <a href="create_time_table.php">
                        <div class="view_button">Create/Set Time Table</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   
                   <table style="width:auto; font-size:12px;  margin:0 auto; margin-top:20px;
                         padding-bottom:20px;     ">
                            <tr>
                           <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                       </tr>
                       <tr>
                           <td style=" height:10px; ">
                               <input type="hidden" value="<?php  echo $fetch_school_id;?>" id="organization_id">  
                               <input type="hidden" value="<?php  echo $fetch_branch_unique_db_id;?>" id="branch_id">
                               <input type="hidden" value="<?php  echo $fecth_session_id_set;?>" id="session_id">
                           </td>
                       </tr>
                           <tr>
                               <td><b>Class/Course <sup style=" color:red; ">*</sup></b></td>
                               <td><b>:</b></td>
                               <td>
                                   <select id="class_course_id" onchange="class_id(this.value)" class="select_box_time_table">
                                       <option value="0">---Select---</option>
                                   <?php  
                         $course_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                          while ($fetch_course_data=mysql_fetch_array($course_db))
                          {
                              
                           if(!empty($_REQUEST['Xmlhtppclass']))
                           {
                            $get_course_name=$_REQUEST['Xmlhtppclass'];   
                           }else
                           {
                           $get_course_name="";    
                           }
                              
                           $fetch_course_name=$fetch_course_data['course_name']; 
                           $fetch_course_id=$fetch_course_data['course_id']; 
                           
                           if($get_course_name==$fetch_course_id)
                           {
                             echo "<option value='$fetch_course_id' selected>$fetch_course_name</option>";
                              
                           }else
                           {
                             echo "<option value='$fetch_course_id'>$fetch_course_name</option>";
                              
                           }
                           
                          
                          }
                                   ?>
                                   
                                   </select></td>
                                   <td style=" width:30px; "></td>
                               <td><b>Section <sup style=" color:red; ">*</sup></b></td>
                               <td><b>:</b></td>
                               <td>
                                   <select id="section_name" class="select_box_time_table">
                                      
                                       <?php 
                                  if(empty($_REQUEST['Xmlhttpsection']))
                                  {
                                      echo "<option>---Select---</option>";   
                                  }else
                                  {
                                     
                                echo "<option>---Select---</option>";          
                 $get_course_name=$_REQUEST['Xmlhtppclass']; 
                 $get_section_id=$_REQUEST['Xmlhttpsection'];
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$get_course_name' and is_delete='none'");
    while ($fetch_class_data=mysql_fetch_array($section_db))
    {
        $fetch_section_id=$fetch_class_data['section_id'];
        $fetch_section_name=$fetch_class_data['section_name'];
        if($get_section_id==$fetch_section_id)
        {
        echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
        }else
        {
         echo "<option value='$fetch_section_id'>$fetch_section_name</option>";   
        }
    } 
   if(empty($fetch_section_id))
   {
    echo "<option>--- Select ---</option>";      
   }
                                      
                                      
                                      
                                  }
                                  
                                  ?>
                                   </select></td>
                                   <td style=" width:30px; "></td>
                               <td>
                                   <input class="button_style_ing" style=" background-color: deeppink; margin-left:10px; " type="button" value="Reset">
                                   <input class="button_style_ing" onclick="show_time_table()" type="button" value="Filter">
                                   
                               </td>
                           </tr>
                       </table>     
                   
                   <div class="horizental_lines"></div>
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl.No.</td>
                           <td class="th_styling">Class/Course</td>
                           <td class="th_styling">Section</td>
                           <td class="th_styling">Time Table Name</td>
                           <td class="th_styling">View</td>
                             <td class="th_styling">Operations</td>
                           <td class="th_styling" style=" border-right:1px solid gray;">Action</td>
                       </tr>
                       
                    <?php 
                    $row=0;
                    $time_table_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id FROM time_table_db as T1 "
                            . " LEFT JOIN course_db as T2 ON T1.class_id=T2.course_id "
                            . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id WHERE $db_t1_main_details T1.is_delete='none'"); 
                    while ($time_table_data=mysql_fetch_array($time_table_db))
                    {
                        $row++;
                        
                      $time_table_unique_id=$time_table_data['time_table_id'];
                      $encrypt_id=$time_table_data['t1_encrypt_id'];
                      $time_table_name=ucwords($time_table_data['time_table_name']);  
                      $class_id=$time_table_data['class_id'];
                      $section_id=$time_table_data['section_id'];       
                       $course_name=$time_table_data['course_name'];
                       $section_name=$time_table_data['section_name'];
                        echo "<tr><td class='td_style'><center><b>$row</b></center></td>"
                                . "<td class='td_style'><center>$course_name</center></td>"
                                . "<td class='td_style'><center>$section_name</center></td>"
                                . "<td class='td_style'>$time_table_name</td>"
                                . "<td class='td_style' style='width:100px;'><center>";
                        {
                         ?>
                       <a href="pop_up_time_table.php?token_id=<?php echo $encrypt_id;?>">
                           <input type='button' class='view_time_table' value='View Timetable'></a>
                       <?php
                        } 
                                       echo"</center></td>";
                                echo"<td class='td_style'><div class='active_button'>Active</div></td>"
                                . "<td class='td_style' style='border-right:1px solid black; width:130px;'>";
                        {
                            ?>
                       
                       <a href="edit_time_table.php?token_id=<?php echo $encrypt_id;?>&xmlclass=<?php echo $class_id;?>&xmlsection=<?php echo $section_id;?>&xmltimetable=<?php echo $time_table_name;?>"><div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
          
                   <div onclick="delete_data('<?php echo $time_table_unique_id;?>','time_table_delete_command')" class="edit_delete_button">Delete</div>
                           
                  
                       
                       <?php
                        }
                        echo" </td>"
                                . "</tr>";
                    }
                    ?>
                       
                       
                       
                   </table>       
                   
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