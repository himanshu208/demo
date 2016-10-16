<?php
//SESSION CONFIGURATION
$check_array_in="account";
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
$message_show="";
                      require_once '../connection.php';
                      if(isset($_POST['addfeedetails']))
                      {
                        $feename=$_POST['addfeename'];
                        $feegrouptype=$_POST['feegrouptype'];
                        $feegroupname=$_POST['feegroupname'];
                        $session_id=$_POST['use_inset_session_id'];
                        $fine_amount=$_POST['fineamount'];
                        $fees_amount=$_POST['feeamount'];
                        $fees_type=$_POST['feegrouptype'];
                        $fine_option=$_POST['fine_option'];
                        if(!empty($_POST['applicable_new_student']))
                        {
                        $applicable_fee=$_POST['applicable_new_student'];
                        }else
                        {
                         $applicable_fee="";   
                        }
                        
                        $insert_transport_hostel_on=$_POST['fee_transport_hostel_active'];
                        $fee_assign=$_POST['class_type'];
                        if(!empty($fee_assign))
                        {   
                        
                       if($fee_assign=="class_wise") 
                       {
                           if(count($_POST['classvalue'])>0)
                           {
                       $class_id=$_POST['classvalue'];
                        $implode_class_id=implode(",",$class_id); 
                           }else
                           {
                           $class_id=0;    
                           }
                       }else
                       {
                       if(count($_POST['insert_student_id'])>0)
                           {
                       $class_id=$_POST['insert_student_id'];
                        $implode_class_id=implode(",",$class_id); 
                           }else
                           {
                           $class_id=0;    
                           }    
                       }
                       
                       
                         if((!empty($fetch_school_id))&&(!empty($fetch_branch_id))&&(!empty($feename))&&(!empty($feegrouptype))&&(!empty($feegroupname))
                                &&(!empty($session_id))&&(!empty($fees_type))&&(!empty($class_id)))
                       {
                        $explode_course_id=explode(",",$implode_class_id);
                        foreach($explode_course_id as $insert_value_id)
                        {
if($fee_assign=="class_wise") 
{
 $insert_option_save="class_fee_group";  
 $insert_course_id=$insert_value_id;
 $insert_student_id="";
}else
{
 $insert_option_save="student_wise";  
 $insert_student_id=$insert_value_id;
 $insert_course_id="";
}
                            
$result=mysql_query("SHOW TABLE STATUS LIKE 'financefeeamount'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_fee_id="FESAMNT_$nextId";                            
$encrypt_id=md5(md5($final_fee_id));     
                            
                         $select_fee_amount=mysql_query("SELECT * FROM financefeeamount WHERE $db_main_details fee_amount_id='$final_fee_id' and action='active'
                          OR $db_main_details fee_id='$feename' and fee_group_id='$feegroupname'
                           and fee_assign_to='class_fee_group' and feegrouptype='$feegrouptype' and course_id='$insert_course_id' and action='active'");  
                      $fetch_fee_amount_data=mysql_fetch_array($select_fee_amount);
                      $fetch_fee_amount_num_rows=mysql_num_rows($select_fee_amount);
                      if((empty($fetch_fee_amount_data))&&($fetch_fee_amount_data==null)&&($fetch_fee_amount_num_rows==0))
                      {
                       
                          
                       $insert_fee_amount=mysql_query("INSERT into financefeeamount values('','$fetch_school_id'
                       ,'$fetch_branch_id','$session_id','$feename','$feegroupname','$final_fee_id','$encrypt_id'
                              ,'$insert_option_save','$insert_student_id','$fees_type','$insert_course_id'"
                               . ",'$insert_transport_hostel_on','$fine_option','$fine_amount','$fees_amount','$applicable_fee','$date','$date_time','$user_unique_id'
                               ,'active')");  
                         
                         if($insert_fee_amount)
                         {
                          $message_show='<div id="error-msg">Record save successfully complete.</div>';
                        
                         }else
                         {
                          $message_show='<div id="error-msg">Request failed,Please try again.</div>';
                        
                         }
                          
                      }  else {
                          $message_show='<div id="error-msg">Record already exist in database.</div>';
                      }
                         
                        } 
                        
                        
                        
                       }else $message_show='<div id="error-msg">Please fill all field.</div>';
                      
                       
                       }
                       
                      }
                      
                        ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
          <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
       
          <script type="text/javascript" src="account_javascript/account_validate.js">
        </script>
       <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js">
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
        <script type="text/javascript" src="account_javascript/attendance_javascript.js"></script>
        <script type="text/javascript" src="account_javascript/fee_amount_javascript.js"></script>
    
    </head>
     <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px; position: relative  }
    #valuediv{ width:100%; height:auto; margin: 0 auto;    }
    #table_midle_set{ width:700px; height:auto; float:left; padding-bottom:10px; 
                      margin-top:10px; border:1px solid silver;     
    }
     #table_midle_setdetail{ width:440px; height:auto;  float:left; margin-left:2px;   margin-top:10px; 
                            
    }
    .td_leftpaddingth{ padding-left:10px;}
    #top_add_view_div{ width:100px; height:18px;
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
    .td_colering{ width:auto;  height:20px; text-align:center; 
                  background-color:whitesmoke; font-weight:bold; z-index:101; 
                  border-bottom:1px solid silver; border-right:1px solid silver;
    }
    #td_colering{ border-left:1px solid silver;   }
    .selectbox{ width:100px; border:1px solid silver;  }
    .selectbox_advance{ width:130px; border:1px solid silver;  }
    .studentselectbox{ width:255px; font-size:12px;  color:black; height:20px;    border:1px solid silver;   }
    #student_search{ width:290px; border:1px solid silver; height:20px; padding-left:3px;   }
    .listbutton{ width:100%; height:100%; text-align:left;background-color:whitesmoke; 
                    border:1px solid whitesmoke;  font-size:12px;  font-weight:400;  }
        .listbutton:hover{ background-color:silver;  border:1px solid silver; font-weight:700;  cursor:pointer;  }

.list li:hover{ background-color: dodgerblue; cursor:pointer; color:white;  }             
             
       .sli{ width:100%;  height:auto; font-size:0px;   }
        .hsli{ width:100%; height:auto; height:22px; text-indent:5px;  }
        #showiframepaymentsystem{ width:698px; overflow:hidden; position:relative;
                                    height:650px; display:none;    }
        .selectfeegroup{ width:180px; height:22px; border:1px solid silver;   }
        .td_fetch_previous_details{ border-right:1px solid silver; z-index:100; 
                                   font-size: 12px; border-bottom:1px solid silver; text-align:center;    }
    #studentperiviousdetails{ width:100%; height:auto;   overflow:auto;   }
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
        #printslip{ color: blue; cursor:pointer; text-decoration:underline;  }
        #ajax_loader_show{ display:none; }
    </style>
    
       <style>
.main{
	border : 0px solid #8789E7;

	padding: 10px 0px;
	width : 800px;
	height : 40px;
}
#loading{
	visibility:hidden;
	padding-left:5px;
}
#ajax_response{
	border : 1px solid #8789E7;
	background : #FFFFFF;
	position:absolute;
	display:none;
	padding:2px 2px;
	top:auto;
}
#holder{
	width : 350px;
}


#all_list{ display: none;}
#all_list li{ padding-top:5px; padding-bottom:5px; font-size:12px;  border-left:1px solid silver;
    border-right:1px solid silver; cursor:pointer;  }
#all_list li a{ font-weight:100; cursor:pointer; }
p{ margin:0; padding:0;  }
.selected{
font-weight:100;   
    background-color:dodgerblue; color:white; 
}
.bold{
	font-weight:bold;
	color: #131E9F;
}
.about{
	text-align:right;
	font-size:10px;
	margin : 10px 4px;
}
.about a{
	color:#BCBCBC;
	text-decoration : none;
}
.about a:hover{
	color:#575757;
	cursor : default;
}
   .select_stylings{ width:165px; height:22px;  }       
      </style>
      <style>
                                                                  #automcomplete_first_div{ width:295px; height:auto; position:absolute;
 margin-left:6px;border-top:0px;
z-index:301;}    
                                                                  #ajax_auto_complete_div{ width:100%; height:auto;   }
            #all_list{  max-height:613px; overflow-y:auto; margin-top:0px;
padding-right:5px; padding-bottom:2px;  }
#all_list li{ padding-left:7px; border-radius:2px;    }                                                          
                                                                  </style>
    <style>
        #ajax_loader_show{ display:none; }
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-weight:800;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1130px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:180px; margin:0 auto; margin-top:10px; border:1px solid silver; float:left;    
    }
    #table_midle_settable{ width:100%; height:60px; margin:0 auto; margin-top:10px; font-size:12px;  float:left;    
    }
    .td_leftpaddingth{ padding-left:10px;}
    #top_add_view_div{ width:150px; height:18px;
                       background-image:url('finanacephoto/skynormal.png');
                       float:right; margin-right:5px; color:black; text-align:center; padding-top:2px        }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; margin-left:5px; padding-left:3px; padding-right:4px;  height:23px; width:200px;    }
    .add_button_reset_button{ width:60px; height:23px; margin-right:12px; margin-top:5px; margin-bottom:5px;   font-size:12px; float:right;   
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-image:url('finanacephoto/bgblack.png');  }
    #error-msg{ width:600px; height:20px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; font-weight:100; padding-top:7px;   color:#380000; text-align: center; margin: 0 auto;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    .selectsize_same{ width:220px; height:23px;  }
    .radio_check{ width:20px; height:20px;  position:relative; top:6px; padding-right:10px; cursor:pointer;   }
    #class_or_student_selector{ width:20%;  margin:0 auto; height:50px; border:1px solid silver;
                                border-radius: 5px; background-color: dodgerblue; color:white; 
                               padding-top:10px; padding-left:20px;  font-weight:bold;     margin-top:10px;     }
    .selectbox{ width:170px; height:23px;  }
    .attendance_select{ width:170px; height:28px; border:1px solid silver;   }
 
 
    </style>
    <body style=" margin: 0;padding: 0;">
        
           <?php 
include_once '../ajax_loader_page_second.php';
      ?>
        
          <div id="fetch_record" style=" display:none; float:left; "></div>
            
         <div id="financefirstdiv">
              <form name="myForm" action="" onsubmit="return validateForm(this);" method="post" enctype="multipart/form-data">
           
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="background-image:url('finanacephoto/bgblack.png');">
                        
                              <?php 
                                include_once 'heademastersetting.php';
                                ?>
                          <input type="hidden" id="organization_id" value="<?php  echo $fetch_school_id;?>">
                          <input type="hidden" id="branch_id" value="<?php  echo $fetch_branch_id;?>">
                          <input type="hidden" name="use_inset_session_id" id="insert_session_id"
                          value="<?php  echo $fecth_session_id_set;?>">   
       
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv">
                           
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="2" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-image:url('finanacephoto/bgblack.png'); ">
                                    Add/Edit Fee Amount Details  
                                    
                                    <a href="financeview_feeamount.php" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Fee Detail">
                                    <div id="top_add_view_div">
                                        <strong> View Fee Amount Details </strong>
                                    </div>
                                        </abbr>
                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="td_leftpaddingth" style=" height:10px; " colspan="2"> 
                                    <strong style="color:gray;background-color:whitesmoke; padding-left:10px; padding-right:10px;
                                            font-size:11px; ">Fields marked with <span><sup style=" color:red; ">*</sup> 
                                            must be filled.</strong>    
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" style=" text-align:center; "><center><?php  echo $message_show;?></center></td>
                                </tr>
                                
                                <tr>
                                    <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                           <legend><span style=" color: maroon;  "><b>Assign Fee</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Fee Group</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <select class="selectsize_same" onchange="fee_name_id(this.value)"
                                                       name="addfeename" id="selectfeename">
                                                   <option  id="fee_zero" value="0">--Select--</option>
                                                 <?php 
                             
                              $selectfeedatabse=mysql_query("SELECT * FROM financeaddfee WHERE $db_main_details action='active'");
                              while ($fetchfee=mysql_fetch_array($selectfeedatabse))
                              {
                                  $fecth_fee_id=$fetchfee['fee_id'];
                                  $fetchfeename=$fetchfee['fee_name'];
                                  echo "<option id='$fecth_fee_id' value='$fecth_fee_id'>$fetchfeename</option>";
                                }
                                                                           
                                                   ?>
                                               </select>
                                               
                                       <?php 
                            $select_fee_databse=mysql_query("SELECT * FROM financeaddfee WHERE $db_main_details action='active'");
                              while ($fetch_fee=mysql_fetch_array($select_fee_databse))
                              {
                               
                                  $fecth_fee_id=$fetch_fee['fee_id'];
                                  $fetchfeename=$fetch_fee['fee_name'];
                                  
                                  if($fetchfeename=="Transport Fee")
                                  {
                                      echo "<input type='hidden' id='check_transport_fee_id' value='$fecth_fee_id'>";   
                                  }
                                  
                                 if($fetchfeename=="Hostel Fee")
                                  {
                                      echo "<input type='hidden' id='check_hostel_fee_id' value='$fecth_fee_id'>";   
                                  }
                              }
                                         
                                         ?>      
                                               
                                               
                                              </td>
                                              
                                              
                                              
                                              <td class="td_leftpadding">
                                                  <strong>Fee Type</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <select class="selectsize_same" onchange="fee_name_type(this.value)"
                                                       name="feegrouptype" id="selectfeegrouptype">
                                                   <option id="zero" value="0">--Select--</option>
                                                   <option value="annual">Annual</option>
                                                   <option value="monthly">Monthly</option>
                                                   <option value="term">Term</option>
                                               </select>
                                              </td>
                                              
                                              
                                              <td class="td_leftpadding">
                                                  <strong>Fee</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <select class="selectsize_same" name="feegroupname" id="feegroupname">
                                                   <option value="0">--Select--</option>
                                                  
                                               </select>
                                              </td>                            
                                              
                                          </tr>
                                      </table>
                                    </td>
                                    
                                </tr> 
                                <tr style=" font-weight:100; ">
                                    <td>
                                        <div id="class_or_student_selector">
                                     <input class="radio_check" onclick="class_wise_fee()" id="class_type_radio" name="class_type" type="radio" value="class_wise" checked>Class/Course  
                                     <input class="radio_check" id="student_type_radio" onclick="student_wise_fee()" name="class_type" value="student_wise" type="radio"> Students  
                                        </div>
                                      
                                    </td>
                                    
                                </tr>
                                
                                
                                 <tr>
                                 <td colspan="2" class="td_leftpadding">
                                    <fieldset id="class_wise_fee_amount" style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                        <legend><span style=" color: maroon;  "><b>Set Class</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:10px; height:20px;
                                                 border-bottom-left-radius:3px;
                                                   border-top-left-radius:3px; background-color:skyblue;  ">
                                                  <input type="checkbox" id="selecctall" name="selectallclass" style=" width:16px; height:16px;  "> 
                                              </td>
                                              <td  style=" width:60px;float:right; height:24px;
                                                   padding-top:12px;padding-right:20px;
                                                   text-align:center;  border-bottom-right-radius:3px;
                                                   border-top-right-radius:3px; background-color:skyblue;  ">
                                                  Select All
                                              </td>
                                              <td style=" width:100%; ">
                                                  <table style=" float:right; color:red;  font-weight:bold;   ">
                                                      <tr>
                                                          <td>
                                                              <input type="checkbox" name="applicable_new_student" value="new">   
                                                          </td>
                                                          <td>Applicable Only New Student</td>
                                                      </tr>
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td colspan="3">
                  <?php 
                   
             $select_class_db= mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
             $fetchnumberofrow=  mysql_num_rows($select_class_db);
             $rowi=0;
             while($fetch= mysql_fetch_array($select_class_db)) {
                 $rowi++;
                 $fetchid=$fetch['id'];
                 $classname=$fetch['course_name'];
                 $fetch_course_id=$fetch['course_id'];
                echo "
                
                
                <div style='width:auto; margin:2px; heigth:20px; padding-right:22px;  float:left;'>
                <input type='checkbox' class='checkbox1' style='width:16px; margin:5px; height:16px;' name='classvalue[]' value='$fetch_course_id'>
                <span style=' margin-top:-14px;'>
                <b>$classname</b>
                <span>
                </div>";
                 }
                 
                
                                   ?>  
                                              </td>
                                             
                                          </tr>
                                          
                                      </table>
                                    </fieldset>
                                    </td>
                                       </tr>
                                       
                                       
                                       
                      <tr>
                                 <td colspan="2" class="td_leftpadding">
                                    <fieldset id="student_wise_fee_amount" style=" font-size:12px; display:none;
                                              font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                        <legend><span style=" color: maroon;  "><b>Select Multiple Student</b></span></legend>
                                       <table class='main_search_table' style=" margin-left:0px; ">
                       
                       <tr>
                           <td><b>Class/Course <sup style=" color:red; ">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select id="class_course_id" onchange="class_id(this.value)" class='attendance_select'>
                                  <option value="0">--- Select ---</option> 
                                   
                                 <?php  
                                    $course_db=  mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
                          while ($fetch_course_data=mysql_fetch_array($course_db))
                          {
                              
                           if(!empty($_REQUEST['Xmlhtppclass']))
                           {
                            $get_course_name=$_REQUEST['Xmlhtppclass'];   
                           }else
                           {
                           $get_course_name="";    
                           }
                              
                           $fetch_course_name=$fetch_course_data['course_name']; 
                           $fetch_course_id=$fetch_course_data['course_id']; 
                           
                           if($get_course_name==$fetch_course_id)
                           {
                             echo "<option value='$fetch_course_id' selected>$fetch_course_name</option>";
                              
                           }else
                           {
                             echo "<option value='$fetch_course_id'>$fetch_course_name</option>";
                              
                           }
                           
                          
                          }
                                   ?>
                                   
                               
                               </select></td>
                           <td style=" width:10px; "></td>
                           <td><b>Section <sup style=" color:red; ">*</sup></b></td>
                           <td><b>:</b></td>
                           <td><select id="section_name"  onchange="section_change(this.value)" class='attendance_select'>
                                   
                                <?php 
                                  if(empty($_REQUEST['Xmlhttpsection']))
                                  {
                                      echo "<option>--- Select ---</option>";   
                                  }else
                                  {
                 $get_course_name=$_REQUEST['Xmlhtppclass']; 
                 $get_section_id=$_REQUEST['Xmlhttpsection'];
    $section_db=mysql_query("SELECT * FROM section_db WHERE $db_main_details course_id='$get_course_name' and is_delete='none' ORDER BY section_name ASC");
    while ($fetch_class_data=mysql_fetch_array($section_db))
    {
        $fetch_section_id=$fetch_class_data['section_id'];
        $fetch_section_name=$fetch_class_data['section_name'];
        if($get_section_id==$fetch_section_id)
        {
        echo "<option value='$fetch_section_id' selected>$fetch_section_name</option>";
        }else
        {
         echo "<option value='$fetch_section_id'>$fetch_section_name</option>";   
        }
    } 
   if(empty($fetch_section_id))
   {
    echo "<option>--- Select ---</option>";      
   }
                                      
                                      
                                      
                                  }
                                  
                                  ?>
                                   
                               </select></td>
                                <td style=" width:10px; "></td>
                                <td><b>Student</b></td>
                                <td><b>:</b></td>
                                <td>
                                    <div id="temp_student_list">
                                        <select id="student_id" name="insert_student_id[]" multiple data-placeholder="---Select---" class="chosen-select" tabindex="-1">
                                     <option value="0"></option>
                                     <?php
                           
                   $student_dbs=mysql_query("SELECT *,T1.id as db_id,T1.encrypt_id as t1_encrypt_id FROM student_db as T1"
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
                 . " $db_t1_main_details T1.is_delete='none'");
         $row=0;
         $fetch_student_num_rows=mysql_num_rows($student_dbs);
         while ($fetch_student_datas=mysql_fetch_array($student_dbs))
         {
$row++;  
$db_id=$fetch_student_datas['db_id'];    
$student_unqiue_id=$fetch_student_datas['student_id']; 
    $student_gender=ucfirst($fetch_student_datas['student_gender']);
$course_name=$fetch_student_datas['course_name'];             
$section_name=$fetch_student_datas['section_name'];
$student_full_name=$fetch_student_datas['student_full_name'];
$student_father_name=$fetch_student_datas['father_name'];
$student_father_mobile_no=$fetch_student_datas['father_mobile_no'];
   
    if($student_gender=="Male")
    {
       $relation="S/O";
    }else
    {
   $relation="D/O";     
    }
  
   
    echo "<option value='$student_unqiue_id'>  $student_full_name $relation $student_father_name / $course_name - $section_name  / Mo. $student_father_mobile_no  </option>";
     
    }
                                
                                     ?>
                                    </select>
                                    </div>
                                </td>
                                  </tr>
                       <tr>
                           <td style=" height:8px; "></td>
                       </tr>
                      
                   </table>    
                                    </fieldset>
                                    </td>
                                       </tr>                 
                                       
                                       <tr>
                                    <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                           <legend><span style=" color: maroon;  "><b>Set/Manage Fine [ per day ]</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:20%; ">
                                                  <table>
                                                      <tr>
                                                          <td><input type="radio" name="fine_option" value="per_day" checked></td><td><b>Per Day</b></td>
                                                          <td><input type="radio" name="fine_option" value="one_time_charge"></td><td><b>One Time Charge</b></td>
                                                      </tr>
                                                  </table>
                                              </td>
                                              <td style=" width: 20%; text-align:right; ">
                                                  <strong>Fine Amount</strong>   <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>   
                                               <input type="text"  name="fineamount" autocomplete="off" id="fineamount"
                                                      class="textsize_same" value="0" style=" width:70px; text-align:right;  "><b> <?php  echo $fetch_currency;?> </b></span>
                                              </td>
                                              <td style=" width:46px; "></td>
                                          </tr>
                                          
                                      </table>
                                       </fieldset>
                                    </td>
                                      
                                </tr>
                                       <tr>
                                    <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                           <legend><span style=" color: maroon;  "><b>Set Fee Amount</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:19px; "></td>
                                              <td class="td_leftpadding">
                                                  <strong>Fee Amount</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong> 
                                               <input type="hidden" id="fee_transport_hostel_active" name="fee_transport_hostel_active">
                                               
                                               <input type="text" autocomplete="off" name="feeamount" id="feeamount"
                                                      value="0" class="textsize_same" style=" text-align:right; width:90px;  "> <b><?php  echo $fetch_currency;?></b>
                                              </td>
                                          </tr>
                                          
                                      </table>
                                       </fieldset>
                                    </td>
                                      
                                </tr>
                                <tr>
                                    
                                    
                                    <td colspan="2">
                                       <input type="submit" value="Save" name="addfeedetails" 
                                              id="addbuttonfeeamount" class="add_button_reset_button">
                                         <input type="Reset" value="Reset" class="add_button_reset_button">
                                        
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                    </td>
                </tr>
           <tr>
                    <td>
                        <div style=" width:300px; height:40px;  ">
                            
                        </div>
                    </td>
                </tr>
            </table> 
              </form>
         </div>
               
                
               
                 <link rel="stylesheet" href="../javascript/combosearch/chosen.css">
  <style type="text/css" media="all">
    /* fix rtl for demo */
    .chosen-rtl .chosen-drop { left: -9000px; }
    #parent_id_chosen{ width:400px; }
    #hostel_id_chosen{ width:330px; }
    #hostel_room_id_chosen{ width:330px; }
    #student_id_chosen { width:430px; }
    .chosen-results{ font-size:11px; }
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
            
         <div id="attechfotter" style=" width:100%; height:22px; position:fixed; bottom:0px; ">
          <?php 
              include 'financefotter.php';
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