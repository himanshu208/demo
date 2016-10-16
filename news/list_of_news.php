<?php
//SESSION CONFIGURATION
$check_array_in="news";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>List Of News</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript" src="../javascript/delete_javascript.js"></script>
        <script type="text/javascript">
       function filter_button()
       {
       var start_date=document.getElementById("start_date").value;
       var end_date=document.getElementById("end_date").value;
       var news_group=document.getElementById("news_group").value;
       var title=document.getElementById("title").value;
       
       if((start_date==0)&&(end_date==0)&&(title==0)&&(news_group==0))
       {
         alert("Please choose atleast one option");
         return false;
       }else
           if((start_date!=0)&&(end_date==0))
       {
           alert("Please enter end date");
           document.getElementById("end_date").focus();
           return false;
       }else
            if((start_date==0)&&(end_date!=0))
        {
          alert("Please enter start date");
           document.getElementById("start_date").focus();
           return false;    
        }else
       {
         document.getElementById("ajax_loader_show").style.display="block";    
         window.location.assign("list_of_news.php?start_date="+start_date+"&end_date="+end_date+"&title="+title+"&news_group="+news_group);   
       
       }
       }
       
       function reset_all()
       {
           var r=confirm("Are you sure you want to reset page");
if (r==true)
  { 
         document.getElementById("ajax_loader_show").style.display="block";    
         window.location.assign("list_of_news.php");   
     }
       }
       
        </script>
        
        <script type="text/javascript" >
        
   function news_publish(delete_tr_name,operation,page_command)
   {

    if(delete_tr_name==0)
   {
      alert("Please fill all fields.")
      return false;
   }else
   {

var r=confirm("Are you sure you want to news");
if (r==true)
  { 
   
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
   
    alert("Record update successfully complete");  
    location.reload();
   }else
   if(httpxml.responseText==0)
   {
     alert("Sorry,Request failed,Please try again later");
    return false;  
   }else
   if(httpxml.responseText==2)
   {
     alert("Please first change working academic session year");
       return false;  
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
  
var url="delete_ajax_code.php";
url=url+"?"+page_command+"="+delete_tr_name+"&operation="+operation+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
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
                           <td>List Of News</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>List Of News</b></div>
              <a href="add_news.php"> <div class="view_button">Add New News</div> </a></div>
                
               <div class="main_work_data" style=" padding-top:20px;">
               <div id="calander_show">
                 
                   <div class="filter_div_tag">
                       <center>
                           <table style=" width:100%;  font-size:12px; margin-top:15px;  ">
                           <tr>
                               <td><b>Start Date</b></td><td><b>:</b></td>
                               <td><input value="<?php if(!empty($_REQUEST['start_date'])) { echo $_REQUEST['start_date'];}else {  }?>" id="start_date" placeholder="Enter start date" class="text_box_org_ing" type="text"></td>
                               <td style=" width:20px; "></td>
                               <td><b>End Date</b></td><td><b>:</b></td>
                               <td><input value="<?php if(!empty($_REQUEST['end_date'])) { echo $_REQUEST['end_date'];}?>" id="end_date" placeholder="Enter end date" class="text_box_org_ing" type="text"></td>
                               <td style=" width:20px; "></td>
                               <td><b>News Group</b></td><td><b>:</b></td>
                              
                               <td>
                                   <select class="event_type_Css" id="news_group">
                                       <option value="0">---Select---</option>
                                          <?php
                                          if(!empty($_REQUEST['news_group']))
                                          {
                                          $get_group_id=$_REQUEST['news_group'];  
                                          }else
                                          {
                                              $get_group_id='';
                                          }
                                          
                    $news_type_db=mysql_query("SELECT * FROM news_group_db WHERE $db_main_details is_delete='none'");   
                     while ($fetch_news_type_data=mysql_fetch_array($news_type_db))
                     {
                
                                 $fetch_news_type_unique_id=$fetch_news_type_data['news_group_id'];
                                 $fetch_news_type_name=  ucwords($fetch_news_type_data['news_group']);
                               
                                if($get_group_id==$fetch_news_type_unique_id)
                                {
                                 
                                echo "<option value='$fetch_news_type_unique_id' selected>$fetch_news_type_name</option>";  
                                }else
                                {
                                    echo "<option value='$fetch_news_type_unique_id'>$fetch_news_type_name</option>";  
                                
                                }
                     }           
                                  ?>
                                   </select>    
                               </td>
                               <td><b>News Title</b></td><td><b>:</b></td>
                               <td><input value="<?php if(!empty($_REQUEST['title'])) { echo $_REQUEST['title'];}?>" id="title" placeholder="Enter news title" class="text_box_org_ing" type="text"></td>
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
                           <td>News Group</td>
                           <td>News Title</td>
                           <td>Date<br/><span style=" font-size:10px; ">(YY-MM-DD)</span></td>
                          <td>News Content</td>
                             <td>News For</td>
                             <td>Publish</td>
                           <td style=" border-right:1px solid black;   ">Action</td>
                       </tr>
                       
                       <?php
                       
                      if((!empty($_REQUEST['start_date']))&&(!empty($_REQUEST['end_date']))&&(!empty($_REQUEST['title']))&&(!empty($_REQUEST['news_group'])))
                      {
                        
                                $start_date=$_REQUEST['start_date'];
                                $end_date=$_REQUEST['end_date'];
                                $title=$_REQUEST['title'];
                                $news_group=$_REQUEST['news_group'];
                                
                     $date_search=" T1.start_date BETWEEN '$start_date' AND '$end_date' "
                                 . " and T1.news_name LIKE '%$title%' and T1.news_group_id='$news_group' and";
                      }else
                          if((!empty($_REQUEST['start_date']))&&(!empty($_REQUEST['end_date']))&&(!empty($_REQUEST['title'])))
                      {
                        
                                $start_date=$_REQUEST['start_date'];
                                $end_date=$_REQUEST['end_date'];
                                $title=$_REQUEST['title'];
                                $news_group=$_REQUEST['news_group'];
                                
                     $date_search=" T1.start_date BETWEEN '$start_date' AND '$end_date' "
                                 . " and T1.news_name LIKE '%$title%' and";
                      }else
                      if((!empty($_REQUEST['start_date']))&&(!empty($_REQUEST['end_date']))&&(!empty($_REQUEST['news_group'])))
                      {
                        
                                $start_date=$_REQUEST['start_date'];
                                $end_date=$_REQUEST['end_date'];
                                $title=$_REQUEST['title'];
                                $news_group=$_REQUEST['news_group'];
                                
                     $date_search=" T1.start_date BETWEEN '$start_date' AND '$end_date' "
                                 . " and T1.news_group_id='$news_group' and";
                      }else
                          if((!empty($_REQUEST['start_date']))&&(!empty($_REQUEST['end_date'])))
                      {
                        
                                $start_date=$_REQUEST['start_date'];
                                $end_date=$_REQUEST['end_date'];
                                $title=$_REQUEST['title'];
                                $news_group=$_REQUEST['news_group'];
                                
                     $date_search=" T1.start_date BETWEEN '$start_date' AND '$end_date' and";
                      }else
                       if((!empty($_REQUEST['title']))&&(!empty($_REQUEST['news_group'])))
                      {
                        
                                $start_date=$_REQUEST['start_date'];
                                $end_date=$_REQUEST['end_date'];
                                $title=$_REQUEST['title'];
                                $news_group=$_REQUEST['news_group'];
                                
                     $date_search=" T1.news_name='$title' and T1.news_group_id='$news_group' and";
                      }else 
                           if((!empty($_REQUEST['title'])))
                      {
                        
                                $start_date=$_REQUEST['start_date'];
                                $end_date=$_REQUEST['end_date'];
                                $title=$_REQUEST['title'];
                                $news_group=$_REQUEST['news_group'];
                                
                     $date_search=" T1.news_name LIKE '%$title%' and";
                      }else 
                        if((!empty($_REQUEST['news_group'])))
                      {
                        
                                $start_date=$_REQUEST['start_date'];
                                $end_date=$_REQUEST['end_date'];
                                $title=$_REQUEST['title'];
                                $news_group=$_REQUEST['news_group'];
                                
                     $date_search=" T1.news_group_id='$news_group' and";
                      }else    
                      {
                          $date_search="";
                      } 
                          
                       
                       $row=0;
                       $calander_db=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id FROM news_db as T1 "
                               . " LEFT JOIN news_group_db as T2 ON T1.news_group_id=T2.news_group_id WHERE $db_t1_main_details $date_search T1.is_delete='none'");
                       while ($fetch_db_data=mysql_fetch_array($calander_db))
                       {
                         $row++;  
                        $fetch_calander_unique_id=$fetch_db_data['news_id'];
                        $fetch_calander_encrypt_id=$fetch_db_data['t1_encrypt_id'];
                        $news_type=ucwords($fetch_db_data['news_group']);
                        $start_date=$fetch_db_data['start_date'];
                        
                                $title=ucwords($fetch_db_data['news_name']);
                                $description=$fetch_db_data['news_description'];
                                $news_for=ucwords($fetch_db_data['news_for']);
                                $publish=strtoupper($fetch_db_data['publish']);
                                echo "<tr id='delete_row_$fetch_calander_unique_id' class='td_styling_data'><td><b>$row</b></td>"
                                        . "<td><b>$news_type</b></td>"
                                        . "<td>$title</td>"
                                        . "<td>$start_date</td>"
                                        . "<td>$description</td>"
                                        . "<td>$news_for</td>"
                                        . "<td>$publish</td>"
                                        . "<td style='width:225px; border-right:1px solid black;'>";
                                       {
                                           if($publish!="YES")
                                           {
                                            $print_publish="Publish";  
                                            $button_color="background-color:blue;";
                                            $operation="yes";
                                           }else
                                           {
                                            $print_publish="Un-Publish";  
                                            $button_color="background-color:orange;";
                                            $operation="";
                                           }
                                           
                                    ?>
                       
                       <div class="view_delete_buttons" onclick="news_publish('<?php  echo $fetch_calander_unique_id;?>','<?php echo $operation;?>','news_publish')" style=" <?php echo $button_color;?> width:auto; padding-left:24px;"><?php echo $print_publish;?></div>
                       
                            <a style="color:blue;" href="#" onclick="window.open('edit_news.php?token_id=<?php  echo $fetch_calander_encrypt_id;?>','size',config='height=600,width=620,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no');  popup.focus();">  
                        <div class="edit_delete_buttons" style="background-color:green; width:45px;">Edit</div></a>
                        
                        
                        
                                           
                            <div onclick="delete_data('<?php  echo $fetch_calander_unique_id;?>','news_delete_command')" class="edit_delete_button">Delete</div>
                       
                        
                      <?php 
                        }     
                                
                                        echo "</td>"
                                        . "</tr>";   
                                
                                
                           
                       }
                       
                       if(empty($fetch_calander_unique_id))
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