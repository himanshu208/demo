<?php
//SESSION CONFIGURATION
$check_array_in="transport";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Allotment Student List</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function reallotment_service(transport_id,student_id)
        {
    var r=confirm("Are you sure you want to Reallotment Transport Service");
if (r==true)
  { 
       
var httpxml;   
if((transport_id==0))
    {
   alert("Sorry, Technical problem, Please try again");  
   return false;
    }
    if(student_id==0)
    {
    alert("Sorry, Technical problem, Please try again");  
    return false;     
    }
try
  {
  // Firefox, Opera 8.0+, Safari
  httpxml=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    httpxml=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    try
      {
      httpxml=new ActiveXObject("Microsoft.XMLHTTP");
      }
    catch (e)
      {
      alert("Your browser does not support AJAX!");
      return false;
      }
    }
  }
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
     if(httpxml.responseText!=0)
     {
     
       document.getElementById("ajax_loader_show").style.display="none"; 
       document.getElementById("delete_row_"+transport_id+"").style.display="none"; 
         alert("Transport service Reallotment successfully complete");  
     }else
         {
             document.getElementById("ajax_loader_show").style.display="none";    
          }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?transport_id="+transport_id+"&student_id="+student_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
  }           
        }
        </script>
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
                           <td><a href="transport_dashboard.php">Transport</a></td>
                           <td>/</td>
                           <td>Transport Allotment Student list</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>Transport Allotment Student list</b></div>
                    <a href="student_allocate_transport.php">
                        <div class="view_button">Transport Allotment New Student</div></a>
                </div>
                 
               <style>
                  .th_styling { font-size:11px; } 
                  .td_style{ font-size:11px; }
                   </style>
               <div class="middle_left_div_tag">
                   
                   <div id="filter_div"></div> 
                   
                   
                   
                   <div id="top_buttons_div" style=" border-bottom:1px solid blue; "></div>
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl.No.</td>
                           <td class="th_styling">Adm. No.</td>
                           <td class="th_styling">Student Name</td>
                            <td class="th_styling">Class - Section</td>
                           <td class="th_styling">Father Name</td>
                           <td class="th_styling">Mobile Number</td>
                           <td class="th_styling">Route</td>
                            <td class="th_styling">Sub Route</td>
                           <td class="th_styling">Veh. Reg. No.</td>
                           <td class="th_styling">Rent/Fare</td>
                           <td class="th_styling" style=" display:none;">View</td>
                           <td class="th_styling" style=" border-right:1px solid gray;">Action</td>
                       </tr>
                       
                    <?php 
                    $row=0;
                    
                    $transport_db=mysql_query("SELECT * FROM student_allot_transport as T1 "
                            . "INNER JOIN student_db as T2 ON T1.transport_unique_id=T2.transport_id "
                            . "LEFT JOIN transport_route_db as T3 ON T1.route=T3.route_id "
                            . "LEFT JOIN transport_sub_route_db as T4 ON T1.sub_route=T4.sub_route_unique_id "
                            . "LEFT JOIN transport_vehicle_db as T5 ON T1.vehicle=T5.vehicle_id WHERE $db_t1_main_details T1.is_delete='none'");
                    while ($trans_data=mysql_fetch_array($transport_db))
                    {
                    $transport_uniqe=$trans_data['transport_unique_id'];    
                    $student_unique_id=$trans_data['student_id'];
                    $route_name=$trans_data['route_name'];
                    $rent=$trans_data['rent'];
                    $subroute=$trans_data['sub_route'];
                    $vehicle_no=$trans_data['vehicle_registration_no'];        
                    
                    
                    
                    
                    
                    $student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as encrpt_id,T1.user_name as student_user_name"
                 . ",T1.temp_password as student_password,T6.user_name as parent_user_name"
                 . ",T6.temp_password as parent_password FROM student_db as T1"
                 . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                 . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                 . " LEFT JOIN session_db as T4 ON T1.session_id=T4.session_id "
                 . " LEFT JOIN category_db as T5 ON T1.category_id=T5.category_id "
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id WHERE "
                 . " T1.student_id='$student_unique_id' and T1.is_delete='none'");
         $fetch_student_data=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);
                    if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
                    {
                     $row++;
                      $student_id=$fetch_student_data['student_id']; 
                     $admission_no=$fetch_student_data['admission_no'];
                     $student_name=$fetch_student_data['student_full_name'];
                     $father_name=$fetch_student_data['father_name'];
                     $father_mobile_no=$fetch_student_data['father_mobile_no'];
                     $course_name=$fetch_student_data['course_name'];             
                     $section_name=$fetch_student_data['section_name'];
                     $session_name=$fetch_student_data['session_name'];  
                     
                     
                        echo "<tr id='delete_row_$transport_uniqe'><td class='td_style'><center><b>$row</b></center></td>"
                                . "<td class='td_style'><center>$admission_no</center></td>"
                                . "<td class='td_style'>$student_name</td>"
                                . "<td class='td_style'>$course_name - $section_name</td>"
                                . "<td class='td_style'>$father_name</td>"
                                . "<td class='td_style'>$father_mobile_no</td>"
                                . "<td class='td_style'>$route_name</td>"
                                . "<td class='td_style'>$subroute</td>"
                                . "<td class='td_style'>$vehicle_no</td>"
                                . "<td class='td_style' style='text-align:right;'><span style='color:Red;'><b>$fetch_currency</b></span> $rent /- </td>"
                                . "<td class='td_style' style='padding:2px; display:none;'><center>";
                        {
                         ?>   
                        <div class="view_delete_buttons" onclick="student_full_details()" style="background-color:dodgerblue; width:55px;">View</div>
                        <?php
                        }
                                echo"</center></td>"
                                . "<td class='td_style' style=' padding:0; margin:0; border-right:1px solid black;'><center>";
                        {
                            ?>
                       <a href="edit_allotment_service.php?Xmlhtppclass=0&Xmlhttpsection=0&Xmlhtppstudentid=<?php echo $student_id;?>">  
                           <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>   
                       <input type='button' onclick="reallotment_service('<?php echo $transport_uniqe;?>','<?php echo $student_id;?>')" class='reallot_button' value='Reallotment'> 
                        <?php
                        }
                                echo"</center></td>"
                                . "</tr>";    
                     
                    }
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