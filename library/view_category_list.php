<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>



<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>View Category List</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
    </head>
    <body>
        
        
        <div id="include_header_page">
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
                           <td><a href="library.php">Library</a></td>
                           <td>/</td>
                           <td><a href="library_setting.php">Library Setting</a></td>
                           <td>/</td>
                           <td>View Category List</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button" style=" border-bottom:1px solid gray; ">
                    <div id="transport_function" class="Short_menu_show"><b>View Category List</b></div>
                    <a href="manage_library_category.php">
                        <div class="view_button">Add New Category</div></a>
                </div>
                 
                
               <div class="middle_left_div_tag">
                   
                   <div id="top_buttons_div">
                       <div class="button_show_style">Print</div>   
                   </div>
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr>
                           <td class="th_styling">Sl No.</td>
                           <td class="th_styling">Category</td>
                           <td class="th_styling">Issuable</td>
                           <td class="th_styling">Maximum Issue Limit</td>
                           <td class="th_styling">Return Days</td>
                           <td class="th_styling">Fine per day</td>
                           <td class="th_styling">Position</td>
                           <td class="th_styling">Description</td>
                           <td class="th_styling" style=" border-right:1px solid gray;  ">Action</td>
                       </tr>
                       
                     <?php 
                       $row=0;
                       $category_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$fetch_school_id'"
                               . " and branch_id='$fetch_branch_unique_db_id' and session_id='$fecth_session_id_set' and is_delete='none'");
                       while ($fetch_category_data=mysql_fetch_array($category_db))
                       {
                           $row++;
                                $category_db_id=$fetch_category_data['id'];
                                $category_unique_id=$fetch_category_data['lib_category_unique_id'];
                                        $encrypt_id=$fetch_category_data['encrypt_id'];
                                        $category_name=$fetch_category_data['category'];
                                        $issuable_student=  ucwords($fetch_category_data['issue_student']);
                                        $issuable_employee=  ucwords($fetch_category_data['issue_employee']);
                                        $max_issue_limit=$fetch_category_data['max_limit'];
                                        $return_day=$fetch_category_data['return_day'];
                                        $fine_per_day=$fetch_category_data['fine'];
                                        $position=$fetch_category_data['position'];
                                        $description=$fetch_category_data['description'];
                                        
                                        if(empty($max_issue_limit))
                                        {
                                           $max_issue_limit="No Require"; 
                                        }
                                        
                                        if(!empty($return_day))
                                        {
                                           $return_day=$return_day ."days"; 
                                        }  else {
                                            $return_day="No Require";
                                        }
                                        
                                        if(!empty($fine_per_day))
                                        {
                                         $fine_per_day="<b>Rs. </b> ".number_format($fine_per_day,2)."/-";   
                                        }else
                                        {
                                         $fine_per_day="No Require";  
                                        }
                                        
                                        
                                
                                echo "<tr id='delete_row_$category_unique_id'>
                                  <td class='td_style'><center><b>$row</b></center></td> 
                                       <td class='td_style'><center>$category_name</center></td> 
                                   <td class='td_style'>
                                  <b>Student :</b> $issuable_student <Br/>
                                  <b>Employee :</b> $issuable_employee
 </td> 
                                   
                                   <td class='td_style'><center>$max_issue_limit</center> </td> 
                                   <td class='td_style'><center><b>$return_day</b></center></td> 
                                       <td class='td_style' style='text-align:right;'>$fine_per_day</td> 
                                        <td class='td_style'>$position</td> 
                                             <td class='td_style'>$description</td> 
                                   <td class='td_style' style='width:132px; border-right:1px solid gray;'>";
                                    {
                        ?>
                       <a style="color:blue;" href="#" onclick="window.open('edit_category_details.php?token_id=<?php echo $encrypt_id;?>','size',config='height=620,width=580,position=absolute,left=300,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="delete_data('<?php  echo $category_unique_id;?>','lib_category_delete_command')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                                  echo" </td> 
                                      
                                </tr>";
                           
                           
                       }
                       $record_table_check=mysql_num_rows($category_db);
                       
                       if(empty($record_table_check))
                       {
                           echo "<tr>"
                           . "<td colspan='12' style=' height:30px; color:red;"
                                   . " border:1px solid black; border-top:0px;'><center><b>Record No Found !</b></center></td></tr>";    
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