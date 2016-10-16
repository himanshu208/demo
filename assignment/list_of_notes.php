<?php
//SESSION CONFIGURATION
$check_array_in="assignment";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>List Of Notes</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        <script type="text/javascript">
       function filter_button()
       {
       var search_by=document.getElementById("news_group").value;
       var search_q=document.getElementById("title").value;
       if((search_by==0)&&(search_q==0))
       {
         alert("Please choose atleast one option");
         return false;
       }else
            if((search_by!=0)&&(search_q==0))
        {
          alert("Please enter search keyword here");
           document.getElementById("title").focus();
           return false;    
        }else
          if((search_by==0)&&(search_q!=0))
        {
          alert("Please select search by");
           document.getElementById("news_group").focus();
           return false;    
        }else
       {
         document.getElementById("ajax_loader_show").style.display="block";    
         window.location.assign("list_of_notes.php?search_by="+search_by+"&search_q="+search_q+"");   
       
       }
       }
       
       function reset_all()
       {
           var r=confirm("Are you sure you want to reset page");
if (r==true)
  { 
         document.getElementById("ajax_loader_show").style.display="block";    
         window.location.assign("list_of_notes.php");   
     }
       }
       
        </script>
        
       
        
    </head>
    <body onload="page_load()">
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
                           <td><a href="assignment.php">Assignment & H.W</a></td>
                           <td>/</td>
                           <td>List Of Notes</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>List Of Notes</b></div>
              <a href="add_notes.php"> <div class="view_button">Add New Notes</div> </a></div>
                
               <div class="main_work_data" style=" padding-top:20px;">
               <div id="calander_show">
                 
                   <div class="filter_div_tag">
                       <center>
                           <table style=" width:auto;  font-size:12px; margin-top:15px;  ">
                           <tr>
                               <td><b>Search By</b></td><td><b>:</b></td>
                               <td>
                                   <select class="event_type_Css" id="news_group">
                                       <option value="0">---Select---</option>
                                       <option id="T1.title" value="T1.title">Notes Title</option>
                                       <option id="T2.course_name" value="T2.course_name">Class</option>
                                       <option id="T4.subject_name" value="T4.subject_name">Subject</option>
                                          
                                   </select>    
                               </td>
                               <td style=" width:10%; "></td>
                               <td><b>Keyword</b></td><td><b>:</b></td>
                               <td><input id="title" value="<?php if(!empty($_REQUEST['search_q'])) { echo $_REQUEST['search_q']; }?>" placeholder="Enter keyword here" class="text_box_org_ing" type="text"></td>
                               </tr>
                           
                          
                           
                           <tr>
                               <td colspan="17">
                                   <input type="button" onclick="filter_button()" class="filter_button" style=" font-weight:bold;" value="Filter">   
                                   <input type="button" onclick="reset_all()" class="reset_button" style=" margin-top:15px; " value="Reset All">
                               </td>
                           </tr>
                       </table>  
                       </center>
                   </div>
                   
                   
                   
                   <table cellspacing="0" cellpadding="0" class="table_details">
                       <tr class="th_heading_style">
                           <td>Sl. No.</td>
                           <td>Notes Title</td>
                           <td>Description</td>
               
                          <td>Class - Section</td>
                             <td>Subject</td>
                             <td>Attach files</td>
                           <td style=" border-right:1px solid black;   ">Action</td>
                       </tr>
                       
                       <?php
                         if((!empty($_REQUEST['search_by']))&&(!empty($_REQUEST['search_q'])))
                        {
                                $search_by=$_REQUEST['search_by'];
                                $search_q=$_REQUEST['search_q'];
                                
                             $search_by=" $search_by LIKE '%$search_q%' and ";   
                        }else
                        
                        {
                         $search_by="";   
                        }
                       
                       $row=0;
                       $calander_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id,T1.description as t1_description FROM notes_db as T1 "
                               . "LEFT JOIN course_db as T2 ON T1.class_id=T2.course_id "
                               . "LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                               . "LEFT JOIN subject_db as T4 ON T1.subject_id=T4.subject_id "
                               . "WHERE $db_t1_main_details $search_by T1.is_delete='none'");
                       while ($fetch_db_data=mysql_fetch_array($calander_db))
                       {
                         $row++;  
                       $notes_id=$fetch_db_data['notes_id'];
                               $encrypt_id=$fetch_db_data['t1_encrypt_id'];
                               $title=ucwords($fetch_db_data['title']);
                               $description=ucwords($fetch_db_data['t1_description']);
                  
                               $class=$fetch_db_data['course_name'];
                               $section=$fetch_db_data['section_name'];
                               $subject=$fetch_db_data['subject_name'];
                               
                 
                 
                 
                                echo "<tr id='delete_row_$notes_id' class='td_styling_data'><td><b>$row</b></td>"
                                        . "<td><b>$title</b></td>"
                                        
                                        . "<td>$description</td>"
                                       
                                        . "<td>$class - $section</td>"
                                        . "<td>$subject</td>"
                                        . "<td>";
                                $number=0;
                $attech_db=mysql_query("SELECT * FROM notes_attech_file_db WHERE notes_id='$notes_id'");        
                 while ($attech_data=mysql_fetch_array($attech_db))
                 {
                 $attech_db_id=$attech_data['id'];
                 $attech_file=$attech_data['document'];
                 $number++;
                 echo "<table cellspacing='0' cellpadding='0' class='attech_file_table'><tr><td> <b>Document $number</b></td><td>|</td><td><a target='_blank' href='../$attech_file'>Download</a></td></tr></table>";
                 
                 
                 }
                 $attech_file_num=mysql_num_rows($attech_db);
                 if($attech_file_num==0)
                 {
                     echo "<span style='color:red;'>No Attach file</span>"; 
                 }
                                 echo"</td>"
                                        . "<td style='width:130px; border-right:1px solid black;'>";
                                       {
                                    ?>
                       
                       <a style="color:blue;" href="#" onclick="window.open('edit_notes.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=600,width=740,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        
                        <div onclick="delete_data('<?php  echo $notes_id;?>','notes_delete_command')" class="edit_delete_button">Delete</div>
                        <?php 
                        }     
                                
                                        echo "</td>"
                                        . "</tr>";   
                                
                                
                           
                       }
                       
                       if(empty($notes_id))
                       {
                           echo "<tr><td colspan='9' style='border:1px solid black; border-top:0px; height:35px; font-weight:bold; color:red; text-align:center;'>Record no found !!</td></tr>";   
                       }
                       
                       
                       
                       ?>
                       
                       
                       
                       
                   </table>
                   
                   
                   
                  </div>
                  </div>      
              
               
               
            </div> 
        </div>
        </form>
        
        <script type="text/javascript" src="../javascript/next_javascript.js"></script>
         <script type="text/javascript" src="../javascript/admission_javascript.js"></script>
         <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
         <script type="text/javascript">
      
$(function() {
$("#start_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      yearRange:'1950:2013',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    $("#end_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      yearRange:'1950:2013',
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
   
});
    </script>
        
    <?php
    if(!empty($_REQUEST['search_by']))
    {
     $search_by=$_REQUEST['search_by'];   
       ?>
    <script type="text/javascript">
    function page_load()
    {
     if(document.getElementById("<?php echo $search_by;?>"))
     {
     document.getElementById("<?php echo $search_by;?>").selected=true;    
     }
     
    }
    </script>
    <?php
    }
    ?>
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div
</body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>