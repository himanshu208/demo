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
  $unicode="&type=3";  
}else
{
  $unicode="&type=3";  
}
}else
{
$unicode="&type=3";    
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
        <script type="text/javascript">
       function small_print_slip()
        {
var r=confirm("Are you sure you want to print due fee slip");
if (r==true)
  {
   
   var all_location_id = document.querySelectorAll('input[name="post_data[]"]:checked');

var aIds = [];

for(var x = 0, l = all_location_id.length; x < l;  x++)
{
    aIds.push(all_location_id[x].value);
}

var str = aIds.join('$,,$');
var as=str.split("$,,$");

var final_stu_id = [];
for (index = 0; index < as.length; ++index) {
    var second_array=as[index];
    var abs=second_array.split("@$$@");
   
     var student_id=abs[2];
     final_stu_id.push(student_id);
}
   
   var final_student_id=final_stu_id.join(',');
  
  
  window.open("due_fee_slip_small.php?token_id="+final_student_id+"&s_id=true", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=0,left=50,width=1100,height=600");
  
  
   
  }    
        }
        
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
           <div class="top_menu_button" onclick="small_print_slip()" id="print_button" 
                style=" display:block;  background-color:darkorchid; ">Due Fee Small Slip</div> 
         
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
    
    
     $now_total_payable_fees=0;
     $now_fee_payable_amount=0;
     $now_fine_payable_amount=0;
     $now_discount_amount_payable=0;
     $now_finaly_amount_payable=0;
     $get_sub_total_amount=0;
     $fee_amount_dbs=mysql_query("SELECT *,T1.id as t1_id FROM financefeeamount as T1"
         . " LEFT JOIN financeaddfee as T2 ON T1.fee_id=T2.fee_id "
         . " LEFT JOIN financeaddfeegroup as T3 ON T1.fee_group_id=T3.fee_group_id"
         . " LEFT JOIN course_db as T4 ON T1.course_id=T4.course_id WHERE "
            . " $db_t1_main_details T1.fee_assign_to='class_fee_group' and T1.course_id='$class_id' and T1.action='active' "
            . " OR $db_t1_main_details T1.fee_assign_to='student_wise' and T1.student_id='$student_id' and T1.action='active'"); 
                           
     $fetch_fee_amount_num_rows=mysql_num_rows($fee_amount_dbs);
     while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_dbs))
         {
       
      
        $fetch_fee_amount_id=$fetch_fee_amount_data['fee_amount_id'];
        $fetch_fee_id=$fetch_fee_amount_data['fee_id'];
        $fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];
        $fee_group_id=$fetch_fee_amount_data['fee_group_id'];
        $fetch_fee_amount=$fetch_fee_amount_data['feesamount'];
        $fine_option=$fetch_fee_amount_data['fine_option'];
        $fetch_fine_amount=$fetch_fee_amount_data['fineamount'];
        $fetch_applicable_status=$fetch_fee_amount_data['applicable_fee'];
        $transport_hostel_check=$fetch_fee_amount_data['hostelandtransportstatus'];
        $fetch_fee_group_name=ucwords($fetch_fee_amount_data['feegroupname']);
        $fetch_fee_group_type=ucfirst($fetch_fee_amount_data['feegrouptype']);
         $fetch_fee_name=$fetch_fee_amount_data['fee_name'];
        
         $tranport_hostel_active_on=1;
        
        
       if(($transport_hostel_check=="active")&&($fetch_fee_name=="Transport Fee"))
       {
            
        //transport fetch fees
   
       $student_dbed=mysql_query("SELECT *,T1.encrypt_id as ad_id,"
                 . "T10.description as transport_description FROM student_db as T1"
                 . " INNER JOIN student_allot_transport as T10 ON T1.transport_id=T10.transport_unique_id WHERE "
                 . " $db_t1_main_details T1.student_id='$student_id' and T1.is_delete='none' "
               . "and T10.is_delete='none'");
         $fetch_student_records=mysql_fetch_array($student_dbed);
         $fetch_student_num_rows=mysql_num_rows($student_dbed);   
         if((!empty($fetch_student_records))&&($fetch_student_records!=null)&&($fetch_student_num_rows!=0))
         {
            
         $transport_unique_id=$fetch_student_records['transport_unique_id']; 
         $transport_allot_db=mysql_query("SELECT * FROM student_allot_transport as T1 "
                 . " INNER JOIN transport_sub_route_db as T2 ON T1.sub_route=T2.sub_route_unique_id "
                 . " WHERE $db_t1_main_details T1.transport_unique_id='$transport_unique_id' and T1.is_delete='none'");
         $transport_allot_data=mysql_fetch_array($transport_allot_db);
         $transport_num_rows=mysql_num_rows($transport_allot_db);
         if((!empty($transport_allot_data))&&($transport_allot_data!=null)&&($transport_num_rows!=0))
         {
         $subroute_amount=$transport_allot_data['rent'];  
         $fetch_fee_amount=$subroute_amount;  
         $tranport_hostel_active=1;
         }else
         {
         $tranport_hostel_active=0;    
         }
         }else
         {
          $tranport_hostel_active=0;   
         }
         }else
         if(($transport_hostel_check=="active")&&($fetch_fee_name=="Hostel Fee"))
         {
                   
       $student_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description"
                 . " FROM student_db as T1 "
                 . " INNER JOIN student_allot_hostel as T9 ON T1.hostel_id=T9.hostel_unique_id WHERE "
                 . " $db_t1_main_details T1.student_id='$student_id' and T1.is_delete='none' and T9.is_delete='none'");
         $fetch_student_record=mysql_fetch_array($student_db);
         $fetch_student_num_rows=mysql_num_rows($student_db);   
         if((!empty($fetch_student_record))&&($fetch_student_record!=null)&&($fetch_student_num_rows!=0))
         {
         $hostel_unique_id=$fetch_student_record['hostel_id']; 
         $hostel_allot_db=mysql_query("SELECT * FROM student_allot_hostel as T1 "
                 . "INNER JOIN hostel_room_db as T2 ON T1.room=T2.room_unique_id "
                 . "WHERE T1.hostel_unique_id='$hostel_unique_id' and T1.is_delete='none'");
         $hostel_allot_data=mysql_fetch_array($hostel_allot_db);
         $hostel_num_rows=mysql_num_rows($hostel_allot_db);
         if((!empty($hostel_allot_data))&&($hostel_allot_data!=null)&&($hostel_num_rows!=0))
         {
         $hostel_amount=$hostel_allot_data['rent']; 
         $fetch_fee_amount=$hostel_amount;   
         $tranport_hostel_active=1;
         }else
         {
         $tranport_hostel_active=0;    
         }
         }else
         {
         $tranport_hostel_active=0;    
         }
         }else
         {
          $tranport_hostel_active=1;   
         }
        
        
        if(!empty($fetch_applicable_status))
        {
           $student_admission=$student_data['admission_status']; 
        }else
        {
         $fetch_applicable_status="1";   
         $student_admission="1";
        }
        //condition check transport fees
        if($tranport_hostel_active_on==$tranport_hostel_active)
        {
        //condition check new fees
        if($fetch_applicable_status==$student_admission)
        {
        
       
            $number_rows=0; 
            $get_fee_qty=0;
            
           $get_sub_total_amount=0;
           $get_fine_amount=0;
           $get_discount_amount=0;
           $get_total_amount=0;
           $get_last_total_amount=0;
           $get_specify_month="";
           $old_month_array=array();
           $old_specific_month_array=array();
            
$print_sub_total_amount=0;
$print_total_discount_amount=0;
$print_total_fine_amount=0;
$print_total_amount=0;
            
        $fee_set_date_db=mysql_query("SELECT * FROM finance_fee_set_date_db WHERE fee_group_id='$fetch_fee_group_id' and is_delete='none'"); 
        while ($fee_set_date=mysql_fetch_array($fee_set_date_db))
        {
           $number_rows++; 
           $month=$fee_set_date['monthlyofmonth'];
         $fetch_specify_month=$month;
         
         $start_date=$fee_set_date['collectfeestartdate'];
         $due_date=$fee_set_date['collectfeeduedate'];   
         
         //calculate fine amount
         
         $days=floor((dmyTime($today_date)-dmyTime($due_date))/86400);
         $collect_fee_start=floor((dmyTime($start_date) - dmyTime($today_date))/86400);       
if($days>0)
{
  $due_days=$days;
  if($fine_option=="per_day")
  {
    $payble_fine_amount=$due_days*$fetch_fine_amount;
   
  }else
  {
 $payble_fine_amount=$fetch_fine_amount;    
  }
   $print_due_days=$due_days." days";
}
else 
{
 $payble_fine_amount=0; 
 $print_due_days="";
} 
$print_fine_amount=$payble_fine_amount;


//discount fee category wise

$fee_category_discount_db=mysql_query("SELECT * FROM financefeediscountcategory WHERE $db_main_details"
        . " course_id='$course_id' and fee_group_id='$fee_group_id' and category_id='$category_id'"
        . " and action='active'");
           $fetch_category_discount_data=mysql_fetch_array($fee_category_discount_db);
           $fetch_category_discount_num_rows=mysql_num_rows($fee_category_discount_db);
          if((!empty($fetch_category_discount_data))&&($fetch_category_discount_data!=null)&&($fetch_category_discount_num_rows!=0)) 
          {
           $fetch_fee_discount_type=$fetch_category_discount_data['discount_type'];
           if($fetch_fee_discount_type=="percantage")
           {
            
           $fetch_discount_rate=$fetch_category_discount_data['feediscount'];   
           $calculation_category_discount=(($fetch_discount_rate*$fetch_fee_amount)/100);
           $category_discount_amount=$calculation_category_discount;   
               
           }else
           {
           $fetch_discount_rate=$fetch_category_discount_data['feediscount'];   
           $category_discount_amount=$fetch_discount_rate;  
           }   
                
          }else
          {
           $category_discount_amount=0;   
          }
         
          //particular student discount
          $particular_student_discount=mysql_query("SELECT * FROM financefeediscountparticularstudent WHERE
             $db_main_details student_id='$student_id' and fee_group_id='$fee_group_id' and action='active'");
          $fetch_student_fee_discount_data=mysql_fetch_array($particular_student_discount);
          $fetch_student_fee_discount_num_rows=mysql_num_rows($particular_student_discount);
          if((!empty($fetch_student_fee_discount_data))&&($fetch_student_fee_discount_data!=null)&&($fetch_student_fee_discount_num_rows!=0))
          {
           $fetch_fee_discount_types=$fetch_student_fee_discount_data['discount_type'];
           if($fetch_fee_discount_types=="percantage")
           {
            
           $fetch_student_discount_rate=$fetch_student_fee_discount_data['feediscount'];   
           $calculation_particular_student_discount=(($fetch_student_discount_rate*$fetch_fee_amount)/100);
           $particluar_student_discount_amount=$calculation_particular_student_discount;   
               
           }else
           {
          $fetch_student_discount_rate=$fetch_student_fee_discount_data['feediscount'];
          $particluar_student_discount_amount=$fetch_student_discount_rate;  
           }   
          }  else {
          $particluar_student_discount_amount=0;    
          }
          
          //student handicapped discount
          $student_handicapped_db=mysql_query("SELECT * FROM financefeediscountstudenthandicapped WHERE $db_main_details"
                  . " feestudenthandicapped='$student_handicapped' and fee_group_id='$fee_group_id' and action='active'");
          $fetch_student_handicapped_data=mysql_fetch_array($student_handicapped_db);
          $fetch_student_handicapped_num_rows=mysql_num_rows($student_handicapped_db);
          if((!empty($fetch_student_handicapped_data))&&($fetch_student_handicapped_data!=null)&&($fetch_student_handicapped_num_rows!=0))
          {
            
           $fetch_fee_discount_typed=$fetch_student_handicapped_data['discount_type'];
           if($fetch_fee_discount_typed=="percantage")
           {
            
           $fetch_student_handicapped_discount_rate=$fetch_student_fee_discount_data['feediscount'];   
           $calculation_handicapped_student_discount=(($fetch_student_handicapped_discount_rate*$fetch_fee_amount)/100);
           $student_handicapped_discount_amount=$calculation_handicapped_student_discount;   
               
           }else
           {
         $fetch_student_handicapped_discount_rate=$fetch_student_fee_discount_data['feediscount']; 
          $student_handicapped_discount_amount=$fetch_student_handicapped_discount_rate;  
           }    
              
          }else
          {
              $student_handicapped_discount_amount=0;
          }
          
        $final_fee_discount_amount=($student_handicapped_discount_amount+$particluar_student_discount_amount+$category_discount_amount);
        $final_payable_fees_student=(($fetch_fee_amount+$payble_fine_amount)-$final_fee_discount_amount);
 
$print_total_discount_amount +=$final_fee_discount_amount;
$print_total_fine_amount +=$print_fine_amount;
$print_total_amount +=$final_payable_fees_student;


         $payment_check_db=mysql_query("SELECT * FROM finance_student_pay_fee as T1 "
                 . " LEFT JOIN finance_pay_fee_integrate_db as T2 ON T1.student_pay_fee_id=T2.pay_fee_id "
                 . " LEFT JOIN finance_pay_fee_month_db as T3 ON T1.student_pay_fee_id=T3.pay_fee_id "
                 . " WHERE $db_t1_main_details T1.student_id='$student_id' and T2.fee_group_id='$fetch_fee_group_id'"
                 . " and T3.fee_group_id='$fetch_fee_group_id' and T3.specify_month_term='$month' and T1.is_delete='none' and T1.status='cleared'");
        
         $payment_num_rows=mysql_num_rows($payment_check_db);
         if(empty($payment_num_rows)&&($payment_num_rows==0))
         {
        
         if($collect_fee_start<=0)
         {
                      $get_sub_total_amount +=$fetch_fee_amount; 
                      $get_fine_amount +=$payble_fine_amount;
                      $get_discount_amount +=$final_fee_discount_amount;
                      $get_last_total_amount +=$final_payable_fees_student;
                     
                      $get_specify_month = "<div class='show_month' id='show_month_$fetch_specify_month'>$fetch_specify_month,</div>";
                      array_push($old_month_array,$get_specify_month);
                      array_push($old_specific_month_array,$fetch_specify_month);
                                        
             
         $start_check="checked";   
         $get_fee_qty++;
         
         }else
         {
          
           $start_check="";     
         }
         }else
         {
             echo "<style>#fee_group_null_$fetch_fee_group_id { background-color:Red;}</style>";
         }
        


      {
                      ?>    
               
                 
               <?php 
           }
          
         
if($days<0)
{
 echo "<style> #color_tr_$number_rows { background-color:wheat; } </style>";  
}else{
    
}
       }
                 ?>
                 
                        
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                                   
                               <?php 
                                  
foreach ($old_month_array as $value_print)
{
  
}

$specific_month_explode=implode(",",$old_specific_month_array);
                                  ?> 
                                  
             <?php
       
                               $now_total_payable_fees +=($get_last_total_amount);
                               $now_fee_payable_amount +=($get_sub_total_amount);
                              
                              
                               $now_fine_payable_amount +=($get_fine_amount);
                               $now_discount_amount_payable +=($get_discount_amount);
                               $now_finaly_amount_payable +=($get_last_total_amount);
                                 
              
                              if($now_discount_amount_payable!=0)
                               {
                               $discount_rate=number_format((($now_discount_amount_payable*100)/$now_fee_payable_amount),2);
                               }  else {
                                  $discount_rate=0; 
                               }
        }
         }
         }
             ?>
                               <?php
                               $total_due_amount=0;
                               $total_both_fine_or_due_amount=0;
                                $total_due_amount_fine=0;
                                
                               $insert_due_amount_id=0;
                               $number_row=0;
                               
                               
                               $due_amount_db=mysql_query("SELECT * FROM finance_student_due_amount_db WHERE student_id='$student_id'
                               and is_delete='none' and status='pending' and action='active'");
                               while ($fetch_due_fee_amount_db=mysql_fetch_array($due_amount_db))
                               {
                               $fetch_due_amount_fee_id=$fetch_due_fee_amount_db['student_due_amount_id']; 
                               $fetch_due_payment_name=$fetch_due_fee_amount_db['payment_name']; 
                               $receipt_id=$fetch_due_fee_amount_db['receipt_id'];
                               $pay_fee_unqie_id=$fetch_due_fee_amount_db['student_pay_fee_id'];
                               $receipt_no=$fetch_due_fee_amount_db['reciept_no'];         
                               $fetch_due_amount=$fetch_due_fee_amount_db['due_amount']; 
                               $fetch_due_amount_payment_date=$fetch_due_fee_amount_db['payment_date']; 
  $number_row++;
                             if($fetch_due_payment_name=="Due Amount")
                             {
$due_amount_fine_rate=0;
$due_days=floor((dmyTime($today_date) - dmyTime($fetch_due_amount_payment_date))/86400);
if($due_days>0)
{
$due_amount_fine_amount=($due_days*$due_amount_fine_rate);
}  else {
  $due_amount_fine_amount=0;  
}

$final_payble_due_amount=($due_amount_fine_amount+$fetch_due_amount);

                             }else
                             {
                               $due_amount_fine_amount=0; 
                               $final_payble_due_amount=($fetch_due_amount);
     
                             }
                             $insert_due_amount_id++;
                             $static_unique_id="fee_due_pay";
                             $final_due_amount_unique_insert_id=$static_unique_id;
                             
                             
                             
                               {
                               ?>
                               
                               
                            
                          
                <?php 
                  if(!empty($fetch_due_payment_name))
                  {
                      
                  {
                  ?>
                        
                <?php 
                  }
                  }else
                  {
                  {
                         ?>
                          

<?php 
                  }
                  }
?>
                   
                          
                          <?php
                          
                          $due_amount_pay_month="Rec. No.: $receipt_id";      
                          $fee_encrypt_id=md5($pay_fee_unqie_id);
                          ?>
                         
                             <?php 
                               $total_due_amount +=$fetch_due_amount;
                               $total_both_fine_or_due_amount +=$final_payble_due_amount;
                               $total_due_amount_fine +=$due_amount_fine_amount;
                               }
                               } 
                              
                            $now_total_payable_fees=($now_total_payable_fees+$total_both_fine_or_due_amount);
                               $now_fee_payable_amount=($now_fee_payable_amount+$total_due_amount);
                              
                              
                               $now_fine_payable_amount=($now_fine_payable_amount+$total_due_amount_fine);
                               $now_discount_amount_payable=($now_discount_amount_payable);
                               $now_finaly_amount_payable=($now_finaly_amount_payable+$total_both_fine_or_due_amount);
                                   
                               
                   if($now_finaly_amount_payable>0)
                   {
                       $row++;
                    
                       
                       
     $user_id=$student_data['t1_db_id']; 
     $student_encrypt_id=$student_data['ad_id'];
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
                              
                               . "<td id='hidden_td' class='td_heading_data'>";
                       {
                       ?>    
                        <a style="color:blue;" href="#" onclick="window.open('due_fee_slip_print.php?token_id=<?php  echo $student_encrypt_id;?>','size',config='height=670,width=900,position=absolute,left=10,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        <input type='button' class='view_list_button' value='View List'></a>
                               
                        <?php
                       }
                               echo"</td>"
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