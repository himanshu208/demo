<?php 
session_start(); 
ob_start();
?>
<?php 
require_once '../connection.php';
if(isset($_SESSION['admin_session_on']))
{
$user_unique_id=$_SESSION['admin_session_on'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  
$organisation_db=mysql_query("SELECT * FROM organization_db  WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo=$fetch_org_data['school_logo'];
    
$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {

  $fetch_school_name=$fetch_branch_data['branch_name'];
  
 $school_session_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");
 $fetch_school_session_data=mysql_fetch_array($school_session_db);
 $fetch_school_num_rows=mysql_num_rows($school_session_db);
  if((!empty($fetch_school_session_data))&&($fetch_school_session_data!=null)&&($fetch_school_num_rows!=0))  
  {
   
      
    $message_show="";
   if(isset($_POST['data_submit']))
   {
       
 date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

       
    $calander_unique_id=$_POST['unique_calander_id'];
    $session_id=$_POST['session_id'];
    $start_date=$_POST['start_data'];
    $end_date=$_POST['end_date'];
            $title=$_POST['title'];
            $description=$_POST['description'];
            if(!empty($_POST['is_holiday']))
            {
            $is_holiday=$_POST['is_holiday'];
            }  else {
                $is_holiday="";
            }
            if((!empty($session_id))&&(!empty($calander_unique_id))&&(!empty($start_date))&&(!empty($end_date))&&(!empty($title)))
            {
            $select_db=mysql_query("SELECT * FROM calander_db WHERE organization_id='$fetch_school_id' "
                    . "and branch_id='$fetch_branch_id' and session_id='$session_id' and"
                    . " calander_unique_id!='$calander_unique_id' and start_date='$start_date' and end_date='$end_date' and title='$title' and is_delete='none'");
            $fecth_db_data=  mysql_fetch_array($select_db);
            $fecth_db_num_rows=  mysql_num_rows($select_db);
            
            if((empty($fecth_db_data))&&($fecth_db_data==null)&&($fecth_db_num_rows==0))
            {
               
             $update_db=mysql_query("UPDATE calander_db SET start_date='$start_date',end_date='$end_date',title='$title'"
                     . ",description='$description',is_holiday='$is_holiday' WHERE organization_id='$fetch_school_id' "
                    . "and branch_id='$fetch_branch_id' and session_id='$session_id' and calander_unique_id='$calander_unique_id' and is_delete='none'");
             
             if($update_db)
             {
             $message_show="<span style='color:green;'>Record update successfully complete</span>";   
             
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
         
      
   
  {   
  ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Calendar</title>
        <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
       
        
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
         function validateForm()
         {
           var start_date=document.getElementById("start_date").value;
           var end_date=document.getElementById("end_date").value;
           var title=document.getElementById("title_name").value;
           
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
           }else
               if(title==0)
           {
              alert("Please enter title");
              document.getElementById("title_name").focus();
              return false;
           }
         }
        </script>
            
    </head>
    <body>
      <?php  include_once '../ajax_loader_page_second.php';?>
           
       <form action="" method="post" name="form1" onsubmit="return validateForm();" enctype="multipart/form-data">
           
        <div class="edit_first_div">
            <div class="edit_top_header">
                <div class="title_name">Edit Calendar Details</div>   
                
                <div class="close_window_button" onclick="close_pop_up_this()">Close Window</div>
            </div>  
            <div class="edit_main_work_div">
            <div class="edit_center_div_tag">
             <?php
             if(!empty($_REQUEST['token_id']))
             {
             $token_id=$_REQUEST['token_id'];    
             
          $calander_db=mysql_query("SELECT * FROM calander_db WHERE encrypt_id='$token_id' and is_delete='none'");
          $calander_fetch_data=mysql_fetch_array($calander_db);
          $calander_num_rows=mysql_num_rows($calander_db);
          if((!empty($calander_fetch_data))&&($calander_fetch_data!=null)&&($calander_num_rows!=0))
          {
              $calander_unique_id=$calander_fetch_data['calander_unique_id'];
              $session_id=$calander_fetch_data['session_id'];
              $start_data=$calander_fetch_data['start_date'];
                      $end_date=$calander_fetch_data['end_date'];
                      $title=$calander_fetch_data['title'];
                      $description=$calander_fetch_data['description'];
                      $is_holiday=$calander_fetch_data['is_holiday'];
                      if($is_holiday=="on")
                      {
                         $is_holiday="checked"; 
                      }
                      
                        ?>  
                
                
                <input type="hidden" name="unique_calander_id" value="<?php echo $calander_unique_id;?>">
                <input type="hidden" name="session_id" value="<?php echo $session_id;?>">
             <table cellspacing="3" cellpadding="7" class="insert_table">
                       <tr>
                        <td colspan="3"><b>Fields marked with <sup>*</sup> must be filled.</b></td>
                      </tr>
                      <tr>
                          <td><b>Start Date <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input value="<?php echo $start_data;?>" type="text" name="start_data"  id="start_date" class="text_box_styles" autocomplete="off"> </td>
                      </tr>
                      <tr>
                          <td><b>End Date <sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input value="<?php echo $end_date;?>" type="text" name="end_date" id="end_date"  class="text_box_styles" autocomplete="off"> </td>
                      </tr>
                      <tr>
                          <td><b>Title<sup>*</sup> </b></td><td><b>:</b></td>
                          <td> <input value="<?php echo $title;?>" type="text" name="title" id="title_name"  class="text_box_styles" style=" width:100%; " autocomplete="off"> </td>
                      </tr>
                      <tr>
                          <td><b>Description </b></td><td><b>:</b></td>
                          <td>
                              <textarea name="description" id="editor_tool" class="text_area_styles"><?php echo $description;?></textarea>   
                          </td>
                      </tr>
                      <tr>
                          <td><b>Is Holiday</b></td> <td><b>:</b></td>
                          <td><input name="is_holiday" type="checkbox" <?php echo $is_holiday;?>></td>
                      </tr>
                      <tr>
                          <td colspan="3">
                              <input type="submit" name="data_submit" class="button_styling" 
                                     style=" margin-right:0px; " value="Update">   
                          </td> 
                      </tr>
                      
                   </table>
                    <?php
             }
             }
                    ?> 
            
            
            
            </div>
            </div>
            <div class="edit_fotter_div_tag">Design & Develop By : DIGI SHIKSHA</div>
            
            
        </div>
       </form>
        
        
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
}
}else
 {
 header("Location:../add_session.php");   
 }

 }else
 {
 header("Location:../loginPage.php");   
 }
 
 
 }else
{
     header("Location:../loginPage.php");
}


}else
{
    header("Location:../loginPage.php");
}

}else
{
     header("Location:../loginPage.php");
}

?>