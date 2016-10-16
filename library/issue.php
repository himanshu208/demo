<?php
//SESSION CONFIGURATION
$check_array_in="library";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
 
<?php 
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
?>
<?php
if(isset($_POST['issue_button_submit']))
{
 $student_id=$_POST['student_id'];
 $insert_session_id=$_POST['use_inset_session_id'];
         
 if(!empty($_POST['issue_book_id']))
 {
 $book_id=$_POST['issue_book_id'];
 }else
 {
   $book_id=0;  
 }
 $issue_date=$_POST['issue_date'];
 $return_date=$_POST['return_date'];
 
 $book_id_length=sizeof($book_id);
 
   if((!empty($student_id))&&(!empty($book_id_length))&&(!empty($book_id)))
   {
     
      $match_query=0; 
      for($i=0;$i<$book_id_length;$i++)
      {
          $result=mysql_query("SHOW TABLE STATUS LIKE 'library_issue_item_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="LIB_ISS_BOK_$nextId"; 
$encrypt_id=md5(md5($final_db_id));

              $insert_book_id=$book_id[$i];
              $insert_issue_date=$issue_date[$i];
              $insert_return_date=$return_date[$i];     
            if((!empty($insert_book_id))&&(!empty($final_db_id)))
            {
    $select_db=mysql_query("SELECT * FROM library_issue_item_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$insert_session_id' and item_uniue_id='$insert_book_id' and is_delete='none'");
    $select_data=mysql_fetch_array($select_db);
    $select_data_num_rows=mysql_num_rows($select_db);
    if((empty($select_data))&&($select_data==null)&&($select_data_num_rows==0))
    {
   
    
    }else
   {
    $match_query++; 
   }
   } 
   }
   if(empty($match_query))
   {
   for($j=0;$j<$book_id_length;$j++)
      {
     $result=mysql_query("SHOW TABLE STATUS LIKE 'library_issue_item_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_db_id="LIB_ISS_BOK_$nextId"; 
$encrypt_id=md5(md5($final_db_id));

              $insert_book_id=$book_id[$j];
              $insert_issue_date=$issue_date[$j];
              $insert_return_date=$return_date[$j];     
            if((!empty($insert_book_id))&&(!empty($final_db_id)))
            {
    $insert_db=mysql_query("INSERT into library_issue_item_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
             . ",'$final_db_id','$encrypt_id','$student_id','$insert_book_id','$insert_issue_date','$insert_return_date'"
             . ",'issue','none','$date','$date_time','$fecth_user_unique')");  
            }
   
      }
     if((!empty($insert_db))&&($insert_db))
   {
     $message_show="<div class='notification_alert_show' style='color:green;'>Book Issue Successfully complete.</div>";      
   }else
   {
    $message_show="<div class='notification_alert_show'>Request failed,Please try again.</div>";     
   }
   
   }else
   {
    $message_show="<div class='notification_alert_show'>Record already exist in database</div>";    
   }
      

   }  else {
    $message_show="<div class='notification_alert_show'>Please fill all fields.</div>";   
   }
   require_once '../pop_up.php'; 
}
?>

<html>
    <head>
        
        <title>Issue Book</title>
        <script type="text/javascript">
 function validateForm()
 {
  var library_author=document.getElementById("student_id").value;
  
  if(library_author==0)
  {
     alert("Please first select student");
     
  }
  var temp_table_no=document.getElementById("temp_table_no").value;
  for(var i=1;i<=temp_table_no;i++)
  {
  if(document.getElementById("issue_book_"+i+""))
  {
   var issue_book=document.getElementById("issue_book_"+i+"").value;
   if(issue_book==0)
   {
    alert("Please select book");
  
    return false;
   }
  }
  }
  
  var temp_table_no=document.getElementById("temp_table_no").value;
  for(var i=1;i<=temp_table_no;i++)
  {
  if(document.getElementById("issue_date_"+i+""))
  {
   var issue_book=document.getElementById("issue_date_"+i+"").value;
   if(issue_book==0)
   {
    alert("Please enter issue date");
    return false;
   }
  }
  }
  
  var temp_table_no=document.getElementById("temp_table_no").value;
  for(var i=1;i<=temp_table_no;i++)
  {
  if(document.getElementById("return_date_"+i+""))
  {
   var issue_book=document.getElementById("return_date_"+i+"").value;
   if(issue_book==0)
   {
    alert("Please enter return date");
    return false;
   }
  }
  }
             
 }
</script>
<script type="text/javascript">
    var add_one=1;
function add_issue_book()
{
    
  var temp_table_no=document.getElementById("temp_table_no").value;
  
  for(var i=1;i<=temp_table_no;i++)
  {
  if(document.getElementById("issue_book_"+i+""))
  {
   var issue_book=document.getElementById("issue_book_"+i+"").value;
   if(issue_book==0)
   {
      alert("Please select book");
      return false;
   }
  }
  }
  add_one++;
  var temp_issue_book=document.getElementById("temp_issue_book").innerHTML;
   var table=document.getElementById("issue_item_table");
    var row=table.insertRow(1);
    var cell1=row.insertCell(0);
    var cell2=row.insertCell(1);
    var cell3=row.insertCell(2);
    var cell4=row.insertCell(3);
    var cell5=row.insertCell(4);
   
   var date="<?php echo $date;?>";
    
    cell1.innerHTML="<select id='issue_book_"+add_one+"' name='issue_book_id[]' onchange='issue_book(this.value,"+add_one+")' data-placeholder='Select book' class='chosen-select' tabindex='5'>"+temp_issue_book+"</select>";
    cell2.innerHTML="<div style='width:108px;' id='author_"+add_one+"'></div>";
    cell3.innerHTML="<input class='calander_date' name='issue_date[]' id='issue_date_"+add_one+"' value='"+date+"' type='text'>";
    cell4.innerHTML="<input class='calander_date' name='return_date[]' id='return_date_"+add_one+"' value='"+date+"' type='text'>";
    cell5.innerHTML="<input type='button' onclick='removeen(this)' class='remmove_button' value='Remove'>";
   
   document.getElementById("temp_table_no").value=add_one;
   
    $(function() {
$(".calander_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });  
   
});

var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"95%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  
}

function removeen(row)
{
    var r=confirm("Are you sure you want to remove");
if (r==true)
  { 
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('issue_item_table').deleteRow(i);
  }
}


function issue_book(issue_unique_id,number)
{
         var org_id="<?php echo $fetch_school_id;?>";
         var brach_id="<?php echo $fetch_branch_id;?>";
         var session_id=document.getElementById("insert_session_id").value;
         var issue_date=document.getElementById("issue_date_"+number+"").value;
         
         if(issue_unique_id==0)
         {
          return false;   
         }else   
         if(org_id==0 || brach_id==0 || session_id==0)
         {
         alert("Sorry,Technical Problem,Please try again"); 
         location.reload();
         return false;
         }else
         {
             
 var temp_table_no=document.getElementById("temp_table_no").value;
  for(var i=1;i<temp_table_no;i++)
  {
  
  if(document.getElementById("issue_book_"+i+""))
  {
  
   var issue_book=document.getElementById("issue_book_"+i+"").value;
   if(issue_book==issue_unique_id)
   {
      alert("Book already selected");
      $("#issue_book_"+number+"").prop("selectedIndex", 0);
      $("#issue_book_"+number+"_chosen a span").text("Select Book");
      $("#issue_book_"+number+"_chosen a span").css("color","gray");
     return false;
   }
  }
  }    
    
    
   
   var httpxml;

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
   
    if(httpxml.responseText==1)
   {
   
    alert("Record delete successfully complete");   
   }else
   if(httpxml.responseText==0)
   {
     alert("Sorry,Request failed,Please b try again later");
    return false;  
   }else
   {
    var response_data=httpxml.responseText;
    var data=response_data.split('@@');
    var author=data[0];
    var return_date=data[2];
    
    document.getElementById("author_"+number+"").innerHTML="<center>"+author+"</center>";
    document.getElementById("return_date_"+number+"").value=return_date;
   }
   
   
     }else
     {
    
         document.getElementById("ajax_loader_show").style.display="none";
         alert("Sorry,Request failed,Please try again later");
         return false;
         
         
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="ajax_code.php";
url=url+"?book_unique_id="+issue_unique_id+"&get_school_id="+org_id+"&get_branch_id="+brach_id+"\
&get_session_id="+session_id+"&issue_date="+issue_date+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);  
    
             
         
}
}

</script>

            <script type="text/javascript">
            function library_id_search()
            {
            var library_ac_id=document.getElementById("library_ac_id").value;   
            if(library_ac_id==0)
            {
               alert("Please enter student library id number"); 
               document.getElementById("library_ac_id").focus();
               return false;
            }else
            {
             document.getElementById("ajax_loader_show").style.display="block";
             window.location.assign("issue.php?search_type=library_id&student_library_id="+library_ac_id+"");
            }
            }
            
            
            
        function student_normal_search_record()
        {
         var class_name=document.getElementById("class_name").value;
         var section=document.getElementById("section_name").value;
         var student_id=document.getElementById("student_list").value;
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
                           <td>Issue Book</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
               <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Issue Book</b></div>
               </div> 
               <div class="main_work_data" style=" padding-top:20px; ">
               <?php
                   require_once '../search_integration/search_link_up.php';
               ?> 
                
               <?php
               if(!empty($search_result))
                {
     $student_db=mysql_query("SELECT * FROM student_db WHERE organization_id='$fetch_school_id' and 
     branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' $search_result and action='active'");
     $fetch_student_data=mysql_fetch_array($student_db);
     $fetch_student_num_row=mysql_num_rows($student_db);
if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_row!=0))
 {

   $fetch_student_sr_no=$fetch_student_data['sr_no'];
    $fetch_student_admission_no=$fetch_student_data['student_id'];
     $fetch_student_roll_no=$fetch_student_data['roll_no'];
    $student_encrypt_id=$fetch_student_data['encrypt_id'];
     
 $class_id=$fetch_student_data['course_id'];
 $class_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and 
     branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and course_id='$class_id'");
   $fetch_course_data=  mysql_fetch_array($class_db);
   $fetch_course_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))
   {
      $course_name=$fetch_course_data['course_name'];
      
   }  else {
        $course_name="";
   }
     
     $section_id=$fetch_student_data['section_id'];
  $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and 
     branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and section_id='$section_id'");
   $fetch_section_data=  mysql_fetch_array($section_db);
   $fetch_section_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_section_data))&&($fetch_section_data!=null)&&($fetch_section_num_rows!=0))
   {
      $section_name=$fetch_section_data['section_name'];
      
   }  else {
        $section_name="";
   }
 

 $session_id=$fetch_student_data['session_id'];
  $session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and 
     branch_id='$fetch_branch_id' and session_id='$session_id'");
   $fetch_session_data=  mysql_fetch_array($session_db);
   $fetch_session_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_session_data))&&($fetch_session_data!=null)&&($fetch_session_num_rows!=0))
   {
      $session_name=$fetch_session_data['session_name'];
      
   }  else {
        $session_name="";
   }
   
   
   $category_id=$fetch_student_data['category_id'];
   $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$fetch_school_id' and 
     branch_id='$fetch_branch_id' and category_id='$category_id'");
   $fetch_category_data=  mysql_fetch_array($category_db);
   $fetch_category_num_rows=  mysql_num_rows($class_db);
   if((!empty($fetch_category_data))&&($fetch_category_data!=null)&&($fetch_category_num_rows!=0))
   {
      $category_name=$fetch_category_data['category_name'];
      
   }  else {
        $category_name="";
   }
     
     
     $fetch_student_full_name=ucwords($fetch_student_data['student_full_name']);
     $fetch_student_gender=ucfirst($fetch_student_data['student_gender']);
     $fetch_student_dob=$fetch_student_data['student_dob'];
     $fetch_student_father_name=$fetch_student_data['father_name'];
     $fetch_student_father_mobile_no=$fetch_student_data['father_mobile_no'];
     $fetch_student_mother_name=$fetch_student_data['mother_name'];
     $fetch_student_mother_no=$fetch_student_data['mother_mobile_no'];
     $student_photo=$fetch_student_data['student_photo'];
     if(!empty($student_photo))
     {
       if(!is_file("../$student_photo"))
       {
        $student_photo="../images/no_avilable_image.gif";   
       }else
       {
        $student_photo="../$student_photo";   
       }
     }else
     {
      $student_photo="../images/no_avilable_image.gif";      
     }
     
     ?>   
                   
                   <input type="hidden" id="student_id" name="student_id" value="<?php echo $fetch_student_admission_no;?>"> 
                   <div class="left_div">
                       <div class="details_title">Student Details</div>
                       <table cellspacing="0" cellpadding="0" class="student_details">
                           <tr>
                               <td><b>Sr. No.</b></td><td><b>:</b></td><td><?php echo $fetch_student_sr_no;?></td>
                               <td><b>Roll No.</b></td><td><b>:</b></td><td><?php echo $fetch_student_roll_no;?></td>
                               <td rowspan="5" colspan="3"><img class="student_image_show" 
                                                                src="<?php echo $student_photo;?>"></td>
                           </tr> 
                           <tr>
                               <td><b>Admission No.</b></td><td><b>:</b></td><td colspan="4"><?php echo $fetch_student_admission_no;?></td>
                               </tr> 
                           <tr>
                               <td><b>Student Name</b></td><td><b>:</b></td>
                               <td colspan="3"><?php echo $fetch_student_full_name;?></td>
                           </tr>
                            <tr>
                               <td><b>Gender</b></td><td><b>:</b></td>
                               <td colspan="4"><?php echo $fetch_student_gender;?></td>
                           </tr>
                            <tr>
                               <td><b>Date Of Birth</b></td><td><b>:</b></td>
                               <td><?php echo $fetch_student_dob;?></td>
                               <td><b>Category</b></td><td><b>:</b></td>
                               <td colspan="4"><?php echo $category_name;?></td>
                           </tr>
                           
                             <tr>
                               <td><b>Father Name</b></td><td><b>:</b></td>
                               <td><?php echo $fetch_student_father_name;?></td>
                               <td><b>Mobile No.</b></td><td><b>:</b></td>
                               <td colspan="3"><?php echo $fetch_student_father_mobile_no;?></td>
                           </tr>
                            <tr>
                               <td><b>Mother Name</b></td><td><b>:</b></td>
                               <td><?php echo $fetch_student_mother_name;?></td>
                               <td><b>Mobile No.</b></td><td><b>:</b></td>
                               <td colspan="4">9899176775</td>
                           </tr>
                       <tr>
                           <td><b>Class/Course</b></td><td><b>:</b></td><td><?php echo $course_name;?></td>
                           <td ><b>Section</b></td><td><b>:</b></td><td colspan="3"><?php echo $section_name;?></td>
                          
                       </tr>
                       <tr>
                           <td><b>Session</b></td><td><b>:</b></td><td><?php echo $session_name;?></td>
                       </tr>
                       <tr>
                           <td style=" background-color: white;" colspan="8">
                               <p style=" font-size:17px; color:red;  "><b>Due Amount : <?php echo $fetch_currency?></b> 0.00/-</p>   
                               <input type="button" class="view_button" style=" border:0; " value="View Full Details">  
                           </td>
                       </tr>
                       </table>  
                   </div>
                   
                   <div class="vertical_line"></div>
                   
                  
                   
                   <div class="right_div">
                   <div class="details_title">Add Issue Book</div>
                   <input type="hidden" value="1" id="temp_table_no">
                   <table id="issue_item_table" class="issue_book_details_table">
                       <tr class="heading">
                           <td>Book</td>
                       <td style=" width:110px; ">Author</td>
                       <td style=" width:120px; ">Issue Date</td>
                       <td style=" width:120px; ">Return Date</td>
                       <td>Action</td>
                       </tr>
                       <tr>
                           <td>
                               <div id="temp_issue_book" style=" display:none; ">
                                 <option id="select_2" value="0"></option>
                                   <?php
                                   $category_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
                               while ($fetch_category_data=mysql_fetch_array($category_db))
                               {
                                 $fetch_unique_id=$fetch_category_data['lib_category_unique_id'];
                                         $fetch_category_name=$fetch_category_data['category'];
                                     
                             $book_db=mysql_query("SELECT * FROM library_book_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and category_id='$fetch_unique_id' and is_delete='none'");     
                             $fetch_book_num_rows=mysql_num_rows($book_db);
                             if($fetch_book_num_rows!=0)
                             {
                                         echo " <optgroup label='$fetch_category_name'>"; 
                                         while ($book_data=  mysql_fetch_array($book_db))
                                         {
                                        $book_unique_id=$book_data['book_unique_id'];
                           $encrypt_id=$book_data['encrypt_id'];
                           $category=$book_data['category_id'];
                           $isbn=$book_data['isbn'];
                               $title=$book_data['title'];
                               $subject=$book_data['subject'];
                               $author_id=$book_data['author_id'];
                               $edition=$book_data['edition'];
                               $publisher=$book_data['publisher'];
                               $tag_id=$book_data['tag'];
                               $copy=$book_data['copy'];
                               $price=$book_data['price'];
                               $issueable=ucwords($book_data['issuable']);
                               $position=$book_data['position'];
                               $description=$book_data['description'];
                               
                               echo "<option id='$book_unique_id' value='$book_unique_id'>$isbn / $title</option>";
                               
                                         }
                                         
                                         echo"</optgroup>";
                             }     
                               }
                                   ?>
                                   
                                     
                               </div>
                               
                               
                               
                               <select id="issue_book_1" name="issue_book_id[]" onchange="issue_book(this.value,'1')" data-placeholder="Select book" class="chosen-select" tabindex="5">
                                   <option value="0"></option>
                                   <?php
                                   $category_db=mysql_query("SELECT * FROM library_category_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and is_delete='none'");
                               while ($fetch_category_data=mysql_fetch_array($category_db))
                               {
                                 $fetch_unique_id=$fetch_category_data['lib_category_unique_id'];
                                         $fetch_category_name=$fetch_category_data['category'];
                                     
                             $book_db=mysql_query("SELECT * FROM library_book_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and session_id='$fecth_session_id_set' and category_id='$fetch_unique_id' and is_delete='none'");     
                             $fetch_book_num_rows=mysql_num_rows($book_db);
                             if($fetch_book_num_rows!=0)
                             {
                                         echo " <optgroup label='$fetch_category_name'>"; 
                                         while ($book_data=  mysql_fetch_array($book_db))
                                         {
                                        $book_unique_id=$book_data['book_unique_id'];
                           $encrypt_id=$book_data['encrypt_id'];
                           $category=$book_data['category_id'];
                           $isbn=$book_data['isbn'];
                               $title=$book_data['title'];
                               $subject=$book_data['subject'];
                               $author_id=$book_data['author_id'];
                               $edition=$book_data['edition'];
                               $publisher=$book_data['publisher'];
                               $tag_id=$book_data['tag'];
                               $copy=$book_data['copy'];
                               $price=$book_data['price'];
                               $issueable=ucwords($book_data['issuable']);
                               $position=$book_data['position'];
                               $description=$book_data['description'];
                               
                               echo "<option id='$book_unique_id' value='$book_unique_id'>$isbn / $title</option>";
                               
                                         }
                                         
                                         echo"</optgroup>";
                             }     
                               }
                                   ?>
                                   
                                  
                               </select>
                           </td>
                           <td><div style=" width:108px; " id="author_1"></div></td>
                           <td><input class="calander_date" name="issue_date[]" readonly="readonly" id="issue_date_1" value="<?php echo $date;?>" type="text"></td>
                           <td><input class="calander_date" name="return_date[]" readonly="readonly" id="return_date_1" value="<?php echo $date;?>" type="text"></td>
                           <td></td>
                       </tr>
                       <tr>
                         <td colspan="6"><input type="button" onclick="add_issue_book()" class="add_button_style" value="Add">
                           
                       </tr>
                       <tr>
                           <td colspan="6"><div class="horizental_line"></div></td>
                       </tr>
                       <tr>
                           <td colspan="6">
                               <input type="submit" name="issue_button_submit" class="issue_button" value="Issue Book">
                           </td>
                       </tr>
                   </table>
                   
                   </div>
                   
                   <?php
 }else
 {
     echo "<div class='show_notification'>Sorry,Record no found..</div>";   
 }
                }
                ?>
               </div>      
              </div> 
        </div>
        </form>
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?> 
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
         
         <script type="text/javascript">
      
$(function() {
$(".calander_date").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });
    
   
});
    </script> 
            
            
  <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
  </style>
            
  <script src="../javascript/combosearch/chosen.jquery.js" type="text/javascript"></script>
  <script src="../javascript/combosearch/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
  <script type="text/javascript">
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
  </script>
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>