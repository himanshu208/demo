<?php
//SESSION CONFIGURATION
$check_array_in="news";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 

   $message_show="";
   if(isset($_POST['data_submit']))
   {
       
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

$result=mysql_query("SHOW TABLE STATUS LIKE 'news_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_cln_id="NWS_$nextId"; 
$encrypt_id=md5(md5($final_cln_id));
       
    $session_id=$_POST['use_inset_session_id']; 
    $news_name=$_POST['news_name'];
    $news_description=$_POST['news_description'];
    $news_id=$_POST['news'];
    $start_date=$_POST['start_data'];
    $news_for=$_POST['news_for'];   
    if(!empty($_POST['publish_website']))
    {
    $publish=$_POST['publish_website'];
    }else
    {
     $publish=0;   
    }
           
            if((!empty($session_id))&&(!empty($final_cln_id))&&(!empty($start_date))
                   &&(!empty($news_name))&&(!empty($news_id))&&(!empty($news_for)))
            {
            $select_db=mysql_query("SELECT * FROM news_db WHERE $db_main_details  news_name='$news_name' and news_group_id='$news_id' and start_date='$start_date' and is_delete='none'");
            $fecth_db_data=mysql_fetch_array($select_db);
            $fecth_db_num_rows=mysql_num_rows($select_db);
            
            if((empty($fecth_db_data))&&($fecth_db_data==null)&&($fecth_db_num_rows==0))
            {
              
             $insert_db=mysql_query("INSERT into news_db values('','$fetch_school_id','$fetch_branch_id'"
                     . ",'$session_id','$final_cln_id','$encrypt_id','$news_name','$news_id','$news_description'"
                     . ",'$start_date','$news_for','$publish'"
                     . ",'none','$date','$date_time','$fecth_user_unique')");
             if($insert_db)
             {
             $message_show="<span style='color:green;'>Record save successfully complete</span>";   
             
             }  else {
                $message_show="<span style='color:red;'>Sorry,Request failed, Please try again.</span>";   
          
             }
                
                
                
            }  else {
               $message_show="<span style='color:red;'>Record already exist in database.</span>";   
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
        <meta charset="UTF-8">
        <title>Add News</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
         function validateForm()
         {
             
           var title=document.getElementById("news_name").value;  
           var news=document.getElementById("news").value; 
           var news_description=document.getElementById("news_description").value; 
           var start_date=document.getElementById("start_date").value;
            if(news==0)
           {
              alert("Please select news group");
              document.getElementById("news").focus();
              return false;
           }else  
        if(title==0)
           {
              alert("Please enter news title");
              document.getElementById("news_name").focus();
              return false;
           }else
             
                if(news_description==0)
           {
              alert("Please select news description");
              document.getElementById("news_description").focus();
              return false;
           }else
           if(start_date==0)
           {
              alert("Please enter start date");
              document.getElementById("start_date").focus();
              return false;
           }else
               if(end_date==0)
           {
              alert("Please enter end date");
              document.getElementById("end_date").focus();
              return false;
           }
              
         }
        </script>
    </head>
    <body>
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
                           <td><a href="list_of_news.php">List Of News</a></td>
                           <td>/</td>
                           <td>Add News</td>
                         
                       </tr>
                   </table>   
               </div>
              
               <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                <div id="top_show_button">
              <div id="transport_function" class="Short_menu_show"><b>Add News</b></div>
             
              <a href="list_of_news.php"> <div class="view_button"  style=" margin-right:10px; background-color:dodgerblue;  ">List Of News</div> </a> 
                   </div>
                
               <div class="main_work_data" style=" padding-top:20px;">
               <div id="calander_show">
               <?php
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
               ?>
                   <table cellspacing="3" cellpadding="7" class="insert_table">
                       <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                      </tr>
                      
                      <tr>
                          <td><b>News Group<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                              <select class="select_class" name="news" id="news" style=" width:280px; ">
                                  <option value='0'>---Select---</option> 
                                  <?php
                    $news_db=mysql_query("SELECT * FROM news_group_db WHERE $db_main_details is_delete='none'");   
                     while ($fetch_news_data=mysql_fetch_array($news_db))
                     {
                
                                 $fetch_news_unique_id=$fetch_news_data['news_group_id'];
                                 $fetch_news_name=ucwords($fetch_news_data['news_group']);
                               
                                echo "<option value='$fetch_news_unique_id'>$fetch_news_name</option>";   
                     }           
                                  ?>
                              </select>
                          </td>
                      </tr>
                       <tr>
                          <td><b>News Title<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="news_name" placeholder='Please enter news title' id="news_name"  class="text_box_styles"  autocomplete="off"> </td>
                      </tr>
                      
                      
                       <tr>
                           <td><b>News Content<sup>*</sup> </b></td><td><b>:</b></td>
                          <td>
                              <textarea name="news_description" placeholder='Please enter news content' id="news_description" class="text_area_styles"></textarea>   
                          </td>
                      </tr>
                      <tr>
                          <td><b>News For<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> 
                         <select class="select_class" name="news_for" id="news_for" style=" width:280px; ">
                                  <option value='all'>All</option>
                                  <option value='students'>Students</option>
                                  <option value='teachers'>Teachers</option>
                                  <option value='parents'>Parents</option>
                                  <option value='none'>None</option>
                         </select>
                          </td>
                      </tr>
                       <tr>
                          <td><b>Date <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input type="text" name="start_data"  id="start_date" class="text_box_styles" value="<?php echo $date;?>" autocomplete="off"> 
                             </td>
                      </tr>
                       <tr>
                          <td><b>Publish Website </b></td><td><b>:</b></td>
                          <td><input type="checkbox" name="publish_website" value='yes' checked></td>
                      </tr>
                      <tr>
                          <td colspan="4">
                              <div id="class_course_div"></div> 
                              
                              <div id="department_div"></div>
                          </td>
                      </tr>
                      <tr>
                          <td colspan="4">
                              <input type="submit" name="data_submit" class="button_styling" style=" margin-right:0;  " value="Save">   
                          </td> 
                      </tr>
                      
                   </table>
                   
                   
               </div>      
               </div> 
               </div>
               </form>
        
        <div id="include_fotter_page">
       <?php 
         require_once '../fotter/fotter_page.php';
         
         ?>   
        </div>
        
<link type="text/css" rel="stylesheet" href="editor_tool/demo.css">
<link type="text/css" rel="stylesheet" href="editor_tool/jquery-te-1.4.0.css">
<script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="editor_tool/jquery-te-1.4.0.min.js" charset="utf-8"></script>
<script>
	$('#editor_tool').jqte();
	
	
</script>      
     
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
 
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>