<?php
//SESSION CONFIGURATION
$check_array_in="search_student";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="../javascript/student_search_ajax.js"></script>  
        <script src="../javascript/list.js"></script>
        
        <script type="text/javascript">
        function student_normal_search_record()
        {
        var class_id=document.getElementById("class_name").value;
        var section_id=document.getElementById("section_name").value;
        var house_id=document.getElementById("house_name").value;
        var student_id=document.getElementById("student_id").value;
        
        if(class_id==0 && section_id==0 && house_id==0 && student_id==0)
        {
           alert("Please select atleast one option");
           return false;
        }else
        {
         document.getElementById("ajax_loader_show").style.display="block";       
        window.location.assign("search.php?xml_search_type=normal&xml_class_id="+class_id+"&xml_section_id="+section_id+"&xml_house="+house_id+"&xml_student_id="+student_id+""); 
        }
        }
        
      function student_advance_search_record()
      {
      var search_by=document.getElementById("search_by").value;
      var search_qq=document.getElementById("search_dyanamic").value;
      
      if(search_by==0)
      {
      alert("Please select search by");
      document.getElementById("search_by").focus();
      return false;
      }else
      if(search_qq==0)
      {
         alert("Please enter search keyword here");
         document.getElementById("search_dyanamic").focus();
         return false;
      }else
      {
      document.getElementById("ajax_loader_show").style.display="block";       
      window.location.assign("search.php?xml_search_type=advance&xml_search_by="+search_by+"&xml_search_qq="+search_qq+""); 
           
      }
          
      }
        
        
        </script>
        
        
        <script type="text/javascript">
        function class_ajax_id(course_id)
        {
          if(course_id==0)
          {
          document.getElementById("ajax_loader_show").style.display="block";           
          window.location.assign("search.php");    
          }else
          {
               document.getElementById("ajax_loader_show").style.display="block";             
            window.location.assign("search.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id=0&xml_house=0&xml_student_id=0"); 
          
          }
        }
        
        function section_ajax_id(section_id)
        {
        var course_id=document.getElementById("class_name").value; 
        var house_id=document.getElementById("house_name").value;
        if(course_id==0)
        {
           alert("Please first select class");
           document.getElementById("class_name").focus();
           return false;
        }else
            if(section_id==0)
        {
        document.getElementById("ajax_loader_show").style.display="block";           
       window.location.assign("search.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id=0&xml_house="+house_id+"&xml_student_id=0"); 
        }else
        {
          document.getElementById("ajax_loader_show").style.display="block";             
         window.location.assign("search.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id="+section_id+"&xml_house=0&xml_student_id=0"); 
              
        }
        }
        
        function house(house_id)
        {
         var course_id=document.getElementById("class_name").value; 
         var section_id=document.getElementById("section_name").value;
          if(house_id==0)
          {
         document.getElementById("ajax_loader_show").style.display="block";             
         window.location.assign("search.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id="+section_id+"&xml_house=0&xml_student_id=0"); 
            
          }else
          {
         document.getElementById("ajax_loader_show").style.display="block";             
         window.location.assign("search.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id="+section_id+"&xml_house="+house_id+"&xml_student_id=0"); 
             
          }
        }
        
        
        function reset_all()
        {
        document.getElementById("ajax_loader_show").style.display="block";             
         window.location.assign("search.php");        
        }
        
        </script>
        
        <script type="text/javascript">
        $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
        </script>
        
        
    </head>
    <body onload="page_load()">
        
       <?php 
include_once '../ajax_loader_page_second.php';
          ?>
        <div id="fetch_record" style=" display:none; "></div>
        
        <div id="include_header_page">
       <?php  include_once '../header/header_page.php'; ?>   
        </div>
        
        <style>
            .search{
                width:320px; height:25px; border:1px solid silver; padding-left:4px; padding-right:4px; 
            }   
             #advance_div { display:none; }
        </style>
        
         <?php 
               if((!empty($_REQUEST['xml_search_type'])))
               {
                $search_type=$_REQUEST['xml_search_type'];
                if($search_type=="normal")
                {
                 $normal_check="checked";
                 $advance_check="";
                 
                 echo "<style>
                     #normal_search_id { display:block; }
                     #advance_div {display:none; }
                    </style>"; 
                }else
                 if($search_type=="advance")
                {
                 $normal_check="";
                 $advance_check="checked";    
                    echo "<style>
                     #normal_search_id { display:none; }
                     #advance_div {display:block; }
                    </style>"; 
                }
               }else
               {
                $normal_check="checked";
                $advance_check="";   
               }
               ?>
        
        <?php
        $result_show=1;
          if((!empty($_REQUEST['xml_class_id']))&&(!empty($_REQUEST['xml_section_id']))
                          &&(!empty($_REQUEST['xml_house']))&&(!empty($_REQUEST['xml_student_id'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      $result_show=0;
                    $search_result="T1.course_id='$class_id' and T1.section_id='$section_id' and T1.house_id='$house_id' and T1.student_id='$student_id' and ";  
                  }else
                       if((!empty($_REQUEST['xml_class_id']))&&(!empty($_REQUEST['xml_section_id']))
                         &&(!empty($_REQUEST['xml_student_id'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                     $result_show=0; 
                    $search_result="T1.course_id='$class_id' and T1.section_id='$section_id' and T1.student_id='$student_id' and ";  
                  }else
                      if((!empty($_REQUEST['xml_class_id']))
                          &&(!empty($_REQUEST['xml_house']))&&(!empty($_REQUEST['xml_student_id'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      $result_show=0;
                    $search_result="T1.course_id='$class_id' and T1.house_id='$house_id' and T1.student_id='$student_id' and ";  
                  }else
                       if((!empty($_REQUEST['xml_class_id']))&&(!empty($_REQUEST['xml_section_id']))
                          &&(!empty($_REQUEST['xml_house'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      
                    $search_result="T1.course_id='$class_id' and T1.section_id='$section_id' and T1.house_id='$house_id' and ";  
                  }else
                        if((!empty($_REQUEST['xml_class_id']))&&(!empty($_REQUEST['xml_section_id'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      
                    $search_result="T1.course_id='$class_id' and T1.section_id='$section_id' and ";  
                  }else
                       if((!empty($_REQUEST['xml_class_id']))&&(!empty($_REQUEST['xml_house'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      
                    $search_result="T1.course_id='$class_id' and T1.house_id='$house_id' and ";  
                  }else
                    
                      if((!empty($_REQUEST['xml_class_id']))&&(!empty($_REQUEST['xml_student_id'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      $result_show=0;
                    $search_result="T1.course_id='$class_id' and T1.student_id='$student_id' and ";  
                  }else
                      if((!empty($_REQUEST['xml_house']))&&(!empty($_REQUEST['xml_student_id'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      $result_show=0;
                    $search_result=" T1.house_id='$house_id' and T1.student_id='$student_id' and ";  
                  }else
                       if((!empty($_REQUEST['xml_student_id'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                     $result_show=0; 
                    $search_result=" T1.student_id='$student_id' and ";  
                  }else
                     if((!empty($_REQUEST['xml_class_id'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      
                    $search_result="T1.course_id='$class_id' and ";  
                  }else 
                   if((!empty($_REQUEST['xml_house'])))
                  {
                     $class_id=$_REQUEST['xml_class_id'];
                     $section_id=$_REQUEST['xml_section_id'];
                     $house_id=$_REQUEST['xml_house'];
                     $student_id=$_REQUEST['xml_student_id'];    
                      
                    $search_result="T1.house_id='$house_id' and";  
                  }else   
                      if((!empty ($_REQUEST['xml_search_by']))&&(!empty($_REQUEST['xml_search_qq'])))
                      {
                  $search_by=$_REQUEST['xml_search_by'];
                  $search_qq=$_REQUEST['xml_search_qq'];
                 $search_result=" $search_by LIKE '$search_qq%' and ";          
                }else
                  {
                   $search_result="";
                  }
        ?>
        <div id="main_work_first_div">
            <div id="middel_work_div">
                <div class="forward_step_style" style=" float:left; height:40px;  ">
                   <table cellspacing="0" cellpadding="0" class="forward_page_style">
                       <tr>
                           <td><a href="../dashboard.php">Dashboard</a></td>
                           <td>/</td>
                           <td>Search Student</td>
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
               <input type="hidden" value="<?php  echo $fetch_school_id;?>" id="organization_id">
               <input type="hidden" value="<?php  echo $fetch_branch_id;?>" id="branch_id">
               
               <?php
               include 'search_link_api.php';
               ?>
               
               <style>
                   .table_th_style td{ padding-left:0.3%; padding-right:0.3%;    }   
                .table_tr_style td{ padding-left:0.3%; padding-right:0.3%;    }   
               </style>
               
               <div id="student_record_data">
               <div class="top_button_div">
                   <div class="header_top_button" onclick="PrintDiv('List Of Student')" style=" background-color:#5ea4e5; ">Print</div>
                   <div style="display:none;" class="header_top_button" style=" background-color:darkslateblue; ">Send Email</div> 
                   <div class="header_top_button">Send SMS</div> 
                   
               </div>
               <div id="table_print_div">
               <table cellspacing="0" cellpadding="0" class="table_list">
                   <tr id="table_th_style" class="table_th_style">
                       <td class="hidden_td"><input id="selecctall" type="checkbox"></td>
                   <td>Sl.No</td>
                   <td>Adm.No.</td>
                   <td>Roll No.</td>
                   <td>Class-Section</td>
                   <td>House</td>
                   <td style=" text-align:left; ">Student</td>
                   <td style=" text-align:left; " class="hidden_td">Mobile No.</td>
                   <td style=" text-align:left; ">Gender</td>
                   <td style=" text-align:left; ">Category</td>
                   <td>Date Of Birth</td>
                   <td style=" text-align:left; ">Father Name</td>
                   <td class="td_right_border">Mobile No.</td>
                   
                   <td style=" border-right:1px solid gray; " class="hidden_td">Action</td>
                   </tr>
                   
                  <?php
                
                
                  
                  $row=0;
                   $student_db=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as t1_encrypt_id FROM student_db as T1"
                 . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                 . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                 . " LEFT JOIN session_db as T4 ON T1.session_id=T4.session_id "
                 . " LEFT JOIN category_db as T5 ON T1.category_id=T5.category_id "
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id"
                 . " LEFT JOIN student_previous_class_db as T8 ON T1.previous_class_id=T8.previous_class_unique_id"
                 . " LEFT JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id"
                 . " LEFT JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id "
                 . "LEFT JOIN house_db as T11 ON T1.house_id=T11.house_id WHERE "
                 . " $db_t1_main_details $search_result T1.is_delete='none' ORDER BY T1.sr_no ASC");
         
         $fetch_student_num_rows=mysql_num_rows($student_db);
         while ($fetch_student_data=mysql_fetch_array($student_db))
         {
         $row++;
         
$db_id=$fetch_student_data['db_id'];    
$student_unqiue_id=$fetch_student_data['student_id'];
$student_encrypt_id=$fetch_student_data['t1_encrypt_id'];      
$form_sr_no=$fetch_student_data['sr_no'];
$admission_no=$fetch_student_data['admission_no'];
$student_roll_no=$fetch_student_data['roll_no'];       
$student_admission_date=$fetch_student_data['admission_date'];  
$enrollment_no=$fetch_student_data['enrollment_no'];  
$course_name=$fetch_student_data['course_name'];             
$section_name=$fetch_student_data['section_name'];
$session_name=$fetch_student_data['session_name'];
$category_name=$fetch_student_data['category_name'];
$house_name=ucwords($fetch_student_data['house_name']);   

$student_full_name=$fetch_student_data['student_full_name'];
    $student_gender=ucfirst($fetch_student_data['student_gender']);
    $student_dob=$fetch_student_data['student_dob'];
    $student_blood_group=$fetch_student_data['student_blood_group'];
    $student_birth_place=$fetch_student_data['student_birth_place'];
    $student_nationality=$fetch_student_data['student_nationality'];
    $student_religion=$fetch_student_data['student_religion'];
    $student_mother_tongue=$fetch_student_data['mother_tongue'];
    $student_category=$fetch_student_data['category_id'];
    $student_sub_category=$fetch_student_data['sub_category'];
    $student_mobile=$fetch_student_data['student_mobile_no'];
    $student_email=$fetch_student_data['student_email_id'];
    $sub_status=ucwords($fetch_student_data['sub_status']);
    $student_photo=$fetch_student_data['student_photo'];

     $student_father_name=$fetch_student_data['father_name'];
    $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
   
    $student_unique_delete_id=$student_unqiue_id."_db_".$db_id;

    $account=$fetch_student_data['account_status'];   
    if($account=="inactive")
    {
    
   echo "<tr id='delete_row_$student_unique_delete_id' style='background-color:#FFFFB2;' class='table_tr_style'>";
    }else
    {
    
    echo "<tr id='delete_row_$student_unique_delete_id'  class='table_tr_style'>";  
    }
    
 echo "<td class='hidden_td'><center><input class='checkbox1' type='checkbox'></center></td>"
                          . "<td><center>$row</center></td>"
                          . "<td><center><b>$admission_no</b></center></td>"
                          . "<td><center><b>$student_roll_no</b></center></td>"
                          . "<td><center>$course_name-$section_name</center></td>"
                          . "<td>$house_name</td>"
                          . "<td>$student_full_name</td>"
                          . "<td class='hidden_td'><center>$student_mobile</center></td>"
                          . "<td>$student_gender</td>"
                          . "<td>$category_name</td>"
          . "<td>$student_dob</td>"                 
          . "<td>$student_father_name</td>"
          . "<td class='td_right_border'>$student_father_mobile_no</td>"
         
         . "<td style='border-right:1px solid gray; padding:0; width:197px;' class='hidden_td'>";
                  {
                  ?>
                   <div class="view_delete_buttons" onclick="student_full_details('<?php echo $student_unqiue_id;?>','<?php echo $db_id;?>')" style="background-color:dodgerblue; width:55px;">View</div>
                     
                   <a href="../admission/edit_student_detail.php?token_id=<?php echo $student_encrypt_id;?>"><div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
          
             <div onclick="delete_data('<?php echo $student_unqiue_id;?>','<?php echo $db_id;?>','student_delete_command')" class="edit_delete_button">Delete</div>
                           
               <?php
                  }
                           echo"</td></tr>";   
                  
         }
                  if(empty($student_unqiue_id))
                  {
                      echo "<tr><td colspan='15' style='text-align:center; color:Red; "
                  . " border:1px solid black; border-top:0; font-size:15px; height:45px;'>Record no found !</td></tr>";   
            
                  }
                  ?> 
                   
               </table>
               </div>
               </div>
               
               <div id="full_student_data"></div>   
            
            </div>
        </div>
        
        
        
        <div class="use_height_maintain_div"></div>
        
           
        <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    
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
         
  <?php
  if(!empty($_REQUEST['xml_search_by']))
  {
    $search_by_get=$_REQUEST['xml_search_by'];
  ?>
  <script type="text/javascript">
  function page_load()
  {
   if(document.getElementById("<?php echo $search_by_get;?>"))
   {
   document.getElementById("<?php echo $search_by_get;?>").selected=true;    
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
        </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>