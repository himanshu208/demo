<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php
$message_template=message_template("due_fee");
?>

<?php
if(isset($_POST['send_sms_button']))
{
 require_once '../sms_email_integration/phone_sms_api.php';
  
 if(count($_POST['post_data'])>0)
 {
  $user_post=$_POST['post_data'];  
}else
{
 $user_post=0;   
}

$send_to="";
$message=$_POST['message']; 

if((!empty($user_post))&&(!empty($message)))
{  

$sms_sent_no=0;   
$log_report=array();    
$implode_post=implode("@##@",$user_post);  
$explode_post=explode("@##@",$implode_post);

if(!empty($_POST['sms_language']))
{
if(!empty($_POST['sms_language']))
{
  $unicode=$_POST['sms_language'];  
}else
{
  $unicode="";  
}
}else
{
$unicode="";    
}


$result=mysql_query("SHOW TABLE STATUS LIKE 'sms_report_db'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$insert_session_id=$_POST['use_inset_session_id'];
$user_mobile_no=implode(",",$user_post);
$sms_use_credit=strlen($message);
$round_credit=ceil($sms_use_credit/160);

$insert_db=mysql_query("INSERT into sms_report_db values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'"
        . ",'$send_to','$user_mobile_no','$message','$round_credit','due_fee_message','','none')");
if($insert_db)
{
foreach ($explode_post as $multi_user)
{
 $explode_final_user=explode("@$$@",$multi_user);
    
 $user_mobile_no=$explode_final_user[0];
 $user_name=$explode_final_user[1];
 $user_id=$explode_final_user[2];
 $due_amount=$explode_final_user[3];
 if((!empty($user_mobile_no))&&(!empty($user_name))&&(!empty($user_id)))
 {
  
  $user_message=str_replace("#name#","$user_name","$message");
  $user_messages=str_replace("#due_amount#","$due_amount","$user_message");
  $sms_report=sms_api($user_mobile_no,$user_messages,$user_id,$unicode); 
   
   array_push($log_report,$sms_report);
 
  if($sms_report=="0")
  {
 $sms_sent_no++;
  }else
      if($sms_report=="2")
      {
       $sms_sent_no++;
      }else
  {
  $sms_sent_no++;
  }
     
 }
}
}

$implode_log_report=implode(",",$log_report);
$update_db=mysql_query("UPDATE sms_report_db SET log_report='$implode_log_report' WHERE id='$nextId' and is_delete='none'");
if($update_db)
{
if($sms_sent_no<0)
{
  $message_show="Less credits to send sms";   
}else
    if($sms_sent_no==0)
    {
      $message_show="Invalid Request";
    }else
        if($sms_sent_no>0)
        {
          $message_show="Message sent successfully complate";   
        }
           $message_show="Message sent successfully complate"; 
}else
{
    $message_show="Message sent successfully complate";    
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
        <title>Due Fee List</title>
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" src="account_javascript/fee_payment_detail_js.js"></script>
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <script type="text/javascript">
        function view_sms_pop_up()
        {
          var checkboxes = document.querySelectorAll('input[name="post_data[]"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
    
     if(values==0)
    {
     alert("Please select receiver"); 
     return false;
    }else
    {
var r=confirm("Are you sure you want to send SMS");
if (r==true)
  { 
      
   var total_user=document.getElementById("total_user_student").value;
  document.getElementById("total_user").innerHTML=total_user;
   document.getElementById("selected_user").innerHTML=values.length;
      
   document.getElementById("win_pop_up_only_1").style.display="block";
        }else
        {
          return false;  
        }
        }
    }
    
    function validate_form()
    {
       var checkboxes = document.querySelectorAll('input[name="post_data[]"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
    
    var selected_reciver=document.getElementById("selected_user").innerHTML;
    var message=document.getElementById("message").value;        
    
     if(values==0)
    {
     alert("Please select receiver"); 
     return false;
    }else
         if(selected_reciver==0)
    {
     alert("Please select receiver"); 
     return false;
    }else
        if(message==0)
    {
       alert("Please enter message");
       return false;
    }
        
    }
    
    
    
     $(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"
                
            });
            var user_length=$('input[name="post_data[]"]:checked').length;
            document.getElementById("total_reciver").innerHTML=user_length;
            
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });  
              var user_length=$('input[name="post_data[]"]:checked').length;
            document.getElementById("total_reciver").innerHTML=user_length;
        }
    });
 
           
}); 
 
    
        </script>
        
        
    </head>
    <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px; position: relative  }
    #valuediv{ width:100%; height:auto; margin: 0 auto;    }
    #table_midle_set{ width:1150px; height:auto; margin:0 auto;
                      margin-top:10px; border:1px solid silver;     
    }
     #table_midle_setdetail{ width:400px; height:auto;  float:left; margin-left:2px;   margin-top:10px; 
                            
    }
    .td_leftpaddingth{ padding-left:10px;}
    #top_add_view_div{ width:130px; height:18px; border-radius:3px; 
                       background-image:url('finanacephoto/skynormal.png');
                       float:right; margin-right:5px; color:black; text-align:center; padding-top:2px        }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; margin-left:5px; }
    .findandresetbutton{ width:60px; height:23px; margin-left:12px; font-size:12px; float: left;
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-image:url('finanacephoto/bgblack.png');  }
    #error-msg{ width:100%; height:22px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; float:left; color:#380000; text-align: center;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    
   
    .selectbox_advance{ width:250px; height:23px;   border:1px solid silver;  }
    .studentselectbox{ width:230px; font-size:12px;  color:black; height:20px;    border:1px solid silver;   }
    #studentsearchname{ width:270px; border:1px solid silver;  }
    
        #showiframepaymentsystem{ width:698px; overflow:hidden; position:relative;
                                    height:650px; display:none;    }
        .selectfeegroup{ width:180px; height:22px; border:1px solid silver;   }
        .td_fetch_previous_details{ border-right:1px solid silver; z-index:100; 
                                   font-size: 12px; border-bottom:1px solid silver; text-align:center;    }
    #studentperiviousdetails{ width:100%; height:284px;   overflow:auto;   }
    .bg_color{ background-color:white; height:22px;border-bottom:1px solid silver;    }
    .feesprintslip{ width:auto; height:auto; color:blue; text-decoration: underline; cursor:pointer;    }
    #refereshbutton{ width:85px; height:27px; float:right; margin-right:15px; font-weight:bold;  
                     text-align:right; cursor:pointer;  
                     background-image:url('finanacephoto/refresh.png');
                     background-color:white;   background-position-y:1px; background-position-x:1px;  
                     background-repeat:no-repeat;   }
    #refereshbuttonadvance{width:85px; height:27px; float:right; margin-right:15px; font-weight:bold;  
                     text-align:right; cursor:pointer;  
                     background-image:url('finanacephoto/refresh.png');
                     background-color:white;   background-position-y:1px; background-position-x:1px;  
                     background-repeat:no-repeat; display: none;}
    #fullviewwindowoutput{width:850px;  height:550px;border:2px solid steelblue;  
               position:fixed;  right:0px; left:0px; top:20px; bottom:0px; display:none;
                              z-index:202; background-color:whitesmoke; margin:0 auto; overflow:  no-display;  }
        #closebutton{ width:100%; height:30px; background-color:steelblue; float:right; border-bottom:1px solid black;   }
        #closebuttonthis{ width:33px; height:25px; margin-top:6px;  
                          float:right;  
                          }
        #viewoutput{width:100%; height:94%;float:left; 
                    background-color:whitesmoke;  overflow:hidden;  }
         #fullviewwindow{ width:28px;  height:28px; margin-top:2px; 
                          float:right;
                         background-image:url('finanacephoto/closewindow/max.png'); background-repeat:no-repeat;     }
       #feespaymentdetailsdata{ width:100%; height:auto; margin-top:0px; float:left;    } 
       .radio_box{ width:18px; height:18px; cursor:pointer;  }
       .details_table{ width:98%; height:auto; float:left; margin-top:10px; margin-bottom:15px;  margin-left:1%; margin-right:1%;   }
  .top_heading_line{ width:auto; background-color: mintcream; border:1px solid black; border-right:0px;
  text-align:center; height:22px;   font-weight:bold;  font-size:11px;  }
  .alert_notification{ border:1px solid black; text-align:center; color: red; border-top:0px; height:30px;    }
  .td_heading_data{ border-left:1px solid black; font-size:11px;  border-bottom:1px solid black;
padding-left:4px; padding-right:4px; height:23px;  text-align:center;    }
  .view_list_button { background:none; border:0; color:blue; text-decoration:underline; font-size:12px; 
                     cursor:pointer;   }
  .send_message{ width:auto; height:auto; padding:0.5em; border-radius:2px;  color:white; border:0; cursor:pointer;
                background-color:orange; float:right;   font-weight:bold; margin-right:20px;  }
    
    
    #first_pop_up_div{ width:100%; height:100%; background-color:black; position:fixed; z-index:999; opacity:0.1;
 filter: alpha(opacity=10); -moz-opacity: 0.1; -khtml-opacity: 0.1;
 
 }
 
 
 
 .second_show_pop_up{ width:100%; height:100%; position:fixed; z-index:1000;  
 }
 #student_list_show{ width:700px; height:auto; padding:2em; background-color:white;
                  border-radius:5px; box-shadow:0px 1px 20px 0px black; 
 position:absolute;
    top:40px;
   
    left: 0;
    right: 0;
    margin: auto;       
 }
  .middle_center_work_dived { width:100%; height:auto; float:left; padding-top:0em; padding-bottom:1em;   }
 .pop_up_title{ width:100%; height:auto; border-bottom:2px solid black; float:left; text-align:left; font-size:14px; padding-bottom:4px;
 font-weight:bold; }
 .pop_table{ width:100%; height:auto; float:left;  border:1px solid silver; margin-top:5px;  }
 .pop_tr_heading td{ background-color:whitesmoke; font-weight:bold; padding:2px; 
                    border-bottom:1px solid silver;  }
 .absent_student{ width:auto; height:auto; background-color:red; padding:3px; margin:3px; 
                 color:white; border-radius:2px;     }
 .sms_div{ width:100%; height:auto; border-bottom:1px solid blue; float:left;    }
 .close_div{ width:35px; height:35px; float:right; cursor:pointer; border:2px solid red; background-position-x:40%;
             background-position-y:40%; border-radius:5px; 
            background-image:url('../images/close_button.png'); background-repeat:no-repeat;  }
 .text_message{ width:400px; height:110px; border:1px solid black;   }
    </style>
    
    
    <script type="text/javascript">
    function close_button_n()
            {
               document.getElementById("win_pop_up_only_1").style.display="none"; 
               
            }
              function ok_close_n()
            {
               document.getElementById("win_pop_up_only_1").style.display="none"; 
               
            }
    </script>
    
    
    <body onload="page_load()" style=" margin: 0;padding: 0;">
        <div id="convert_file"></div>   
        <form name="myForm" onsubmit="return validate_form()" action="" method="post" enctype="multipart/form-data">
            
      
        <div id="win_pop_up_only_1" style=" display:none; ">
            <div id="first_pop_up_div"></div> 
            <div id="second_pop_up" class="second_show_pop_up">
                <div id="student_list_show">
                  <div class="close_div" onclick="close_button_n()"></div>  
                  <div class="middle_center_work_dived" id="win_pop_up_text">
                      <div class="pop_up_title">Preview Send Due Fee SMS</div>
                      <div style=" width:100%; float:left;max-height:400px; overflow-y:auto;    ">
                     
                          <table cellspacing="4" cellpadding="4" style=" margin:auto; margin-top:10px;  ">
                              <tr>
                                  <td><b>Total User</b></td><td><b>:</b></td><td><div id="total_user">0</div></td>
                              </tr>
                               <tr>
                                   <td><b>Selected Receiver</b></td><td><b>:</b></td><td><div style=" width:100px; " id="selected_user">0</div></td>
                              </tr>
                              <tr>
                                  <td colspan="4" style=" color:red; ">
                                      <b> Use codes : </b>for student( #name# ), For Due Amount ( #due_amount# )   
                                      
                                  </td>   
                              </tr>
                               <tr>
                                   <td><b>Message</b></td><td><b>:</b></td><td>
                                       <textarea id='message' name="message" class="text_message"><?php echo $message_template;?></textarea>   
                                   </td>
                              </tr>
                          </table>
                          
                          
                          
                      </div>
                       </div>
                  <div class="last_bottom_close_div">
                      
                      <input type="submit"  name="send_sms_button" class="ok_button_style" style=" border:0; height:40px;   background-color:dodgerblue; " value="Send SMS">
                    <div onclick="ok_close_n()" class="ok_button_style" style=" background-color:red; margin-right:10px;  ">Cancel</div>  
                  </div>
                </div>
                </div>
              </div>
        
        
        
   <?php 
      include_once '../ajax_loader_page_second.php';
      ?>  
        
        <div id="temp_data" style=" display:none; "></div>
        <input id="company_logo_link" type="hidden" value="<?php  echo $fetch_school_logo;?>">
        
         <div id="financefirstdiv">
           
          <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
             <input type="hidden" id="currency" value="<?php  echo $fetch_currency;?>">
             
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td>
                        
                              <?php 
                                include_once 'headerfinancepage.php';
                                ?>
                          <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">  
                        <style>
                         #color_44{ background-color:dodgerblue; color:white; border-top-left-radius:3px;
                         border-top-right-radius:3px; }   
                        </style>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv"> 
                            <script type="text/javascript" src="../javascript/student_search_ajax.js"></script> 
        
        <script type="text/javascript">
      
$(function() {

$("#date_to").datepicker({ 
  changeMonth:true,changeYear:true,
  showWeek: true,
      firstDay: 1,
      showButtonPanel:true,
      dateFormat:"yy-mm-dd",
      showOn: "button",
      buttonImage:"../images/calander.png",
      buttonImageOnly: true
    });  
    
    $("#date_from").datepicker({ 
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
    <script type="text/javascript">
        function student_normal_search_record()
        {
        var class_id=document.getElementById("class_name").value;
        var section_id=document.getElementById("section_name").value;
        var house_id=document.getElementById("house_name").value;
        
        if(class_id==0 && section_id==0 && house_id==0 )
        {
           alert("Please select atleast one option");
           return false;
        }else
        {
         document.getElementById("ajax_loader_show").style.display="block";       
        window.location.assign("fee_due_list.php?xml_search_type=normal&xml_class_id="+class_id+"&xml_section_id="+section_id+"&xml_house="+house_id+"&xml_student_id=0"); 
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
      window.location.assign("fee_due_list.php?xml_search_type=advance&xml_search_by="+search_by+"&xml_search_qq="+search_qq+""); 
           
      }
          
      }
        
        
        </script>
        
        
        <script type="text/javascript">
        function class_ajax_id(course_id)
        {
          if(course_id==0)
          {
          document.getElementById("ajax_loader_show").style.display="block";           
          window.location.assign("fee_due_list.php");    
          }else
          {
               document.getElementById("ajax_loader_show").style.display="block";             
            window.location.assign("fee_due_list.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id=0&xml_house=0&xml_student_id=0"); 
          
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
       window.location.assign("fee_due_list.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id=0&xml_house="+house_id+"&xml_student_id=0"); 
        }else
        {
          document.getElementById("ajax_loader_show").style.display="block";             
         window.location.assign("fee_due_list.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id="+section_id+"&xml_house=0&xml_student_id=0"); 
              
        }
        }
        
        function house(house_id)
        {
         var course_id=document.getElementById("class_name").value; 
         var section_id=document.getElementById("section_name").value;
          if(house_id==0)
          {
         document.getElementById("ajax_loader_show").style.display="block";             
         window.location.assign("fee_due_list.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id="+section_id+"&xml_house=0&xml_student_id=0"); 
            
          }else
          {
         document.getElementById("ajax_loader_show").style.display="block";             
         window.location.assign("fee_due_list.php?xml_search_type=normal&xml_class_id="+course_id+"&xml_section_id="+section_id+"&xml_house="+house_id+"&xml_student_id=0"); 
             
          }
        }
        
        
        function reset_all()
        {
        document.getElementById("ajax_loader_show").style.display="block";             
         window.location.assign("fee_due_list.php");        
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
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="4" class="td_leftpadding" 
                                        style=" color:white; text-align:left; padding-top:4px;  padding-left:10px;   
                                        height:25px; background-image:url('finanacephoto/bgblack.png'); ">
                                        <strong>Due Fee list</strong>   
                                    </td>
                                </tr>
                               <tr><td class="td_leftpadding">
                             
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
         <style>
        .select_search_style{ width:140px; }    
          #student_id_chosen{ width: 370px;}  
         .active-result{ font-size:11px; }
         .chosen-single span { font-size:11px; }
         .search_checked_styling{ width:16px; height:16px;  }
         .select_search_style{ width:190px; height:27px; padding:2px;  }
         .search_advance{ width:200px; height:19px; padding:2px;    }
         #search_button,.reset_button{ background-color:dodgerblue; border:0; padding:10px; color:white; font-weight:bold;     }
        </style>
        <div id="search_first_div" style=" width:800px; margin:auto; padding-bottom:10px;  border-bottom:1px solid blue;  ">
            <table class="top_search_type_table" style="margin-bottom:1em;   background-color:yellow; padding:2px; border-radius:4px;   "> 
                       <tr>
                           <td><input type="radio" onclick="normal_search()" name="search_type" class='search_checked_styling' <?php echo $normal_check;?>></td>
                           <td><b>Normal Search</b></td>
                           <td style=" width:20px; "></td>
                           <td><input onclick="advance_search()" class='search_checked_styling' name="search_type" type="radio" <?php echo $advance_check;?>></td>
                           <td><b>Advance Search</b></td>
                           
                           
                       </tr>
                   </table>
                   <input type="hidden" id="admission_no" value="">
                   
                   <div id="normal_search_id" > 
                   <table class="search_table">
                       <tr>
                           <td><b>Course/Class</b></td>
                           <td><b>:</b></td>
                           <td>
<select onchange="class_ajax_id(this.value)" id="class_name" class="select_search_style">
<option id="zero_class" value="0">-- Select --</option>
<?php 

                               $class_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details_whout_session is_delete='none'");
                               while ($fetch_class_data=mysql_fetch_array($class_db))
                               {
                                 if(!empty($_REQUEST['xml_class_id']))
{
 $get_class_id=$_REQUEST['xml_class_id']; 
}else
{
 $get_class_id="";   
}  
                                   
                                $fetch_class_name=$fetch_class_data['course_name'];
                                $fetch_class_id=$fetch_class_data['course_id'];
                                if($get_class_id==$fetch_class_id)
                                {
                               echo "<option value='$fetch_class_id' selected>$fetch_class_name</option>";
                                }else
                                {
                                 echo "<option value='$fetch_class_id'>$fetch_class_name</option>";
                                   
                                }
                               }
                               ?>
 </select>
                           
                           </td>
                       
                           <td><b>Section </b></td>
                           <td><b>:</b></td>
                           <td><select onchange="section_ajax_id(this.value)" id="section_name" class="select_search_style">
                                   <option id="zero_seztion" value="0">-- Select --</option>
                       <?php 
                       if(!empty($_REQUEST['xml_class_id']))
                       {
                         $token_class_id=$_REQUEST['xml_class_id'];  
                           
if(!empty($_REQUEST['xml_section_id']))
{
 $get_section_id=$_REQUEST['xml_section_id']; 
}else
{
 $get_section_id="0";   
}
   

$section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details_whout_session course_id='$token_class_id' and is_delete='none'");
                               while ($fetch_section_data=mysql_fetch_array($section_db))
                               {
                                $fetch_section_name=$fetch_section_data['section_name'];
                                $fetch_section_id=$fetch_section_data['section_id'];
                                if($get_section_id==$fetch_section_id)
                                {
                               echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
                                }else
                                {
                                 echo "<option value='$fetch_section_id'>$fetch_section_name</option>";
                                   
                                }
                               }
                       }
                               ?>
                              </select></td>     
                            <td><b>House </b></td>
                           <td><b>:</b></td>
                           <td><select onchange="house(this.value)" id="house_name" class="select_search_style">
                                   <option id="zero_seztion" value="0">-- Select --</option>
                              <?php
                              if(!empty($_REQUEST['xml_house']))
                              {
                              $get_house=$_REQUEST['xml_house'];   
                              }else
                              {
                                $get_house="";    
                              }
                              
                              
                               $house_db=mysql_query("SELECT * FROM house_db WHERE $db_main_details_whout_session is_delete='none'");
                               while ($fetch_house_data=mysql_fetch_array($house_db))
                               {
                                $fetch_house_id=$fetch_house_data['house_id'];
                                $fetch_house_name=$fetch_house_data['house_name'];
                                
                                if($get_house==$fetch_house_id)
                                {
                                echo "<option value='$fetch_house_id' selected>$fetch_house_name</option>";
                                }else
                                {
                                  echo "<option value='$fetch_house_id'>$fetch_house_name</option>";
                                  
                                }
                               }
                               ?>
                               </select></td>
                       </tr>
                       <tr>
                           <td style=" height:10px; "></td>
                       </tr>
                       <tr>
                           <td colspan="14">
                              <input type="button" onclick="student_normal_search_record()" id="search_button" value="Search">
                           
                              <input type="button" onclick="reset_all()" class="reset_button" style=" background-color:deeppink; " value="Reset All">
                               
                               
                           </td>
                       </tr>
                   </table>
                   </div>
                   
                   
                   <div id="advance_div" >
                      <table class="search_table">
                       <tr>
                           <td><b>Search By <sup>*</sup></b></td>
                           <td><b>:</b></td>
                           <td>
                               <select id="search_by" class="select_search_style" style=" width:240px; ">
     <option id="zero_search_by" value="0">-- Select --</option>
     <option id="T7.student_full_name" value="T7.student_full_name">Student Name</option>
      <option id="T7.student_gender" value="T7.student_gender">Gender</option>
     <option id="T7.student_dob" value="T7.student_dob">Date of Birth</option>
     <option id="T6.father_name" value="T6.father_name">Father Name</option>
     <option id="T6.father_mobile_no" value="T6.father_mobile_no">Father Mobile No.</option>
     <option id="T6.father_email" value="T6.father_email">Father Email id</option>
     <option id="T6.mother_name" value="T6.mother_name">Mother Name</option>
     <option id="T6.mother_mobile_no" value="T6.mother_mobile_no">Mother Mobile Number</option>
      <option id="T6.local_parent_relation" value="T6.local_parent_relation">Local Gurdain Relation</option>
      <option id="T6.local_parent_name" value="T6.local_parent_name">Local Gurdain Name</option>
      <option id="T6.local_parent_mobile_no" value="T6.local_parent_mobile_no">Local Gurdain Mobile Number</option>
      <option id="T2.course_name" value="T2.course_name">Class</option>
      <option id="T3.section_name" value="T3.section_name">Section</option>
      <option id="T5.category_name" value="T5.category_name">Category</option>
      <option id="T11.house_name" value="T11.house_name">House</option>
     <option id="T1.sr_no" value="T1.sr_no">Sr.No</option>
     <option id="T1.admission_no" value="T1.admission_no">Admission No.</option>
     <option id="T1.admission_date" value="T1.admission_date">Admission Date</option>
     <option id="T1.account_status" value="T1.account_status">Account status</option>
     <option id="T7.student_mobile_no" value="T7.student_mobile_no">Student Mobile No.</option>
     <option id="T7.student_email_id" value="T7.student_email_id">Student Email id</option>
     <option id="T7.current_address" value="T7.current_address">Address</option>
     </select>
                           </td>
                           <td>
                               <b>Search<sup>*</sup></b>
                           </td>
                           <td><b>:</b></td>

                           <td><input type="text" id="search_dyanamic" value="<?php if(!empty($_REQUEST['xml_search_qq'])) { echo $_REQUEST['xml_search_qq']; }?>" class='search_advance' placeholder="Enter search keyword here">
                             
                           </td> 
                           <td>
                               
                           </td>
                           <td>
                               <input type="button" onclick="student_advance_search_record()" id="search_button" value="Search">
                             <input type="button" onclick="reset_all()" class="reset_button" style=" background-color:deeppink; " value="Reset All">
                              
                           </td>
                       </tr>
                      </table>
                       
                   </div>
                   </div>
                                    </td>
                                    
                                </tr> 
                                <tr>
                                    <td colspan="2">
                                     
                                        <div id="feespaymentdetailsdata" style=" display:block; ">
                                          
                                           
                                            
                                         <div class="all_div_tag" style=" height:auto; padding-bottom:5px;   display:block; ">       
                                           
           <div class="top_menu_button" onclick="PrintDiv('Due Fee Student List')" id="print_button" style=" display:block; ">Print</div> 
         
           <?php
           if(!empty($message_template))
           {
           ?>
           <input type="button" onclick="view_sms_pop_up()" class='send_message' value="Send SMS">        
            <?php
           }
            ?>                            
                                         </div>  
                                            
               <div id="table_print_div">                          
                <table cellspacing="0" cellpadding="0" id="details_table"  class="details_table">
               <tr>
                   <td id="hidden_td" class="top_heading_line"><input id="selecctall" type="checkbox" checked></td>
               <td class="top_heading_line">Sl No.</td>
               <td class="top_heading_line">Admission No.</td>
               <td class="top_heading_line">Class-Section</td>
               <td class="top_heading_line">Student Name</td>
               <td class="top_heading_line">Father Name</td>
               <td class="top_heading_line">Mobile Number</td>
               <td class="top_heading_line">Address</td>
               <td class="top_heading_line" id='td_border'>Due Fee Amount</td>
               <td id="hidden_td" class="top_heading_line" class="hidden_td">View Due Fee List</td>
              <td id='hidden_td' class="top_heading_line" style=" border-right:1px solid black; ">Action</td>
              </tr>
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
                  if($search_by=="T7.current_address")
                  {
                   $search_result=" $search_by LIKE '%$search_qq%' and ";    
                  }else 
                   if($search_by=="T7.student_full_name")
                  {
                   $search_result=" $search_by LIKE '%$search_qq%' and ";    
                  }else 
                   if($search_by=="T6.father_name")
                  {
                   $search_result=" $search_by LIKE '%$search_qq%' and ";    
                  }
                  else{
                     $search_result=" $search_by LIKE '$search_qq%' and ";  
                  }
                          
                }else
                  {
                   $search_result="";
                  }
        ?>
              
               <?php 
     
   $total_outstanding_balance=0;
  $row=0;
function dmyTime($dt)
{
    list ($d, $m, $y) = explode ('-', $dt);
    return strtotime("$y-$m-$d");
}
function dmyTimed($dtd)
{
    list ($d, $m, $y) = explode ('-', $dtd);
    return strtotime("$y-$m-$d");
}
        
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
$today_date=$date;
$row=0;
    $student_dbss=mysql_query("SELECT *,T1.id as t1_db_id,T1.encrypt_id as ad_id,T9.description as hostel_description,"
                 . "T10.description as transport_description FROM student_db as T1"
                 . " LEFT JOIN course_db as T2 ON T1.course_id=T2.course_id"
                 . " LEFT JOIN section_db as T3 ON T1.section_id=T3.section_id "
                 . " LEFT JOIN category_db as T5 ON T1.category_id=T5.category_id "
                 . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                 . " LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id"
                 . " LEFT JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id"
                 . " LEFT JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id "
                 . " WHERE "
                 . " $db_t1_main_details $search_result T1.is_delete='none'");
       $total_student_user=mysql_num_rows($student_dbss);
       
     {
      ?>
              
                 
              <?php
     }
       
    while($student_data=mysql_fetch_array($student_dbss))
    {
       
   
    $student_id=$student_data['student_id'];   
    $class_id=$student_data['course_id'];
    $course_id=$class_id;
    $category_id=$student_data['category_id'];
    $student_admission=$student_data['admission_status'];
    $student_handicapped=$student_data['student_handicapped'];
    if($student_handicapped=="yes")
    {
     $student_handicapped="Handicapped";   
    }
    
    $due_fee_date=strtotime($today_date);
   
    $fee_amount_db=mysql_query("SELECT *,T1.id as t1_id,"
            . "SUM(IF(T5.collectfeestartdate<='$today_date',feesamount,0)) AS tm_amt FROM financefeeamount as T1"
         . " INNER JOIN financeaddfee as T2 ON T1.fee_id=T2.fee_id "
         . " INNER JOIN financeaddfeegroup as T3 ON T1.fee_group_id=T3.fee_group_id"
         . " INNER JOIN course_db as T4 ON T1.course_id=T4.course_id "
         . " INNER JOIN finance_fee_set_date_db as T5 ON T1.fee_group_id=T5.fee_group_id "
         . " WHERE $db_t1_main_details T1.fee_assign_to='class_fee_group' and T1.course_id='$class_id' and T1.action='active' "
            . " OR $db_t1_main_details T1.fee_assign_to='student_wise' and T1.student_id='$student_id' and T1.action='active'"); 
        
    $fee_amt=mysql_fetch_array($fee_amount_db);
    $fee_amt_this=$fee_amt['tm_amt'];
    
    
    
                   $now_finaly_amount_payable=$fee_amt_this;        
                   if($now_finaly_amount_payable>0)
                   {
                       $row++;
                    
                       
                       
     $user_id=$student_data['t1_db_id'];                  
     $student_name=$student_data['student_full_name'];    
     $father_name=$student_data['father_name'];  
     $father_mobile_no=$student_data['father_mobile_no'];  
     $class_name=$student_data['course_name'];
     $section_name=$student_data['section_name'];
     $admission_no=$student_data['admission_no'];
     $address=$student_data['current_address'];
     
     
     
     $total_outstanding_balance +=$now_finaly_amount_payable;
     
     if(!empty($now_finaly_amount_payable))
     {
       $now_finaly_amount_payable=  number_format($now_finaly_amount_payable,2);  
     }
     
     
     $post_data=$father_mobile_no."@$$@".$student_name."@$$@".$user_id."@$$@".$now_finaly_amount_payable;
                 
     
                       echo "<tr>"
                       . "<td id='hidden_td' class='td_heading_data'><center><input class='checkbox1' name='post_data[]' type='checkbox' value='$post_data' checked></center></td>"
                               . "<td class='td_heading_data'>$row</td>"
                               . "<td class='td_heading_data'>$admission_no</td>"
                               . "<td class='td_heading_data'>$class_name-$section_name</td>"
                               . "<td class='td_heading_data'>$student_name</td>"
                               . "<td class='td_heading_data'>$father_name</td>"
                               . "<td class='td_heading_data'>$father_mobile_no</td>"
                                . "<td class='td_heading_data' style='width:200px;'>$address</td>"
                               . "<td class='td_heading_data' style='text-align:right;' id='td_border'><b>$fetch_currency</b> $now_finaly_amount_payable/-</td>"
                              
                               . "<td id='hidden_td' class='td_heading_data'><input type='button' class='view_list_button' value='View List'></td>"
                               . "<td id='hidden_td' class='td_heading_data' style='border-right:1px solid black;'>"
                               . "<a href='financepay_studentfee.php?fees_pay_method=manually_fee&fees_group_id=all_fee_group_pay&student_admission_id=$student_id&search_option=normal&Xmlhtppclass=0&Xmlhttpsection=---%20Select%20---&search_by=&&search_qq=&&xmlpayment_date=$today_date' style='color:blue;'><b>Pay Fee</b></a></td></tr>";    
                       
                       
                       
                       
                   }
                    }
   
                    if(!empty($total_outstanding_balance))
                    {
                     $total_outstanding_balance=  number_format($total_outstanding_balance,2);   
                    }
                    
     ?>
             <input type="hidden" id='total_user_student' value="<?php echo $row;?>">  
              <tr><td id='hidden_td'></td><td colspan="6"></td>
                  <td class='td_heading_data' style=" text-align:right;  background-color: yellow;"><b>Total Amount :</b></td>
                  <td class='td_heading_data' style=" text-align:right; border-right:1px solid black;   background-color: yellow;">
                      <b> <?php echo $fetch_currency;?></b> <?php echo $total_outstanding_balance;?>/-</td>
              </tr>
           
                            </table>
               </div>  
                        </div>
                    </td>
              <tr>
                    <td>
                        <div style=" width:300px; height:40px;  ">
                            
                        </div>
                    </td>
                </tr>
            </table> 
         </div>
                        </form>
                        
                        
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
                        
         <div id="attechfotter" style=" width:100%; height:22px; position:fixed; bottom:0px; ">
          <?php 
              include 'financefotter.php';
            ?>
        </div> 
         </div>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>