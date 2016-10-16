<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
        <script type="text/javascript" src="account_javascript/fee_payment_mode.js"></script>
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        
        
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
  
    </style>
    
    <body style=" margin: 0;padding: 0;">
   <?php 
      include_once '../ajax_loader_page_second.php';
      ?>  
        
        <div id="temp_data" style=" display:none; "></div>
        
        
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
                         #color_6{ background-color:dodgerblue; color:white; border-top-left-radius:3px;
                         border-top-right-radius:3px; }   
                        </style>
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv"> 
                        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script>   
                       <script src="../javascript/list.js"></script>    
                            <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
        
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
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="4" class="td_leftpadding" 
                                        style=" color:white; text-align:left; padding-top:4px;  padding-left:10px;   
                                        height:25px; background-image:url('finanacephoto/bgblack.png'); ">
                                        <strong>Fee Payment Reconcile</strong>   
  <a href="financepay_studentfee.php" border="0" style=" text-decoration:none; ">
  <abbr title="Fee Payment">
                                    <div id="top_add_view_div">
                                        <strong>Add Fee Payment </strong>
                                    </div>
  </abbr>
                                    </a>
                                    </td>
                                </tr>
                               <tr><td class="td_leftpadding">
                                     <fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                               margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Find Student</span></legend>
                                    <table cellspacing="0" cellpadding="0" style="width:100%; height:auto;  ">
                                    <tr>
                                    <td  class="td_leftpaddingth" style=" height:25px; " colspan="5"> 
                                    <strong style="color:gray;background-color:whitesmoke; padding-left:10px;
                                            padding-right:10px; 
                                            font-size:11px; ">Fields marked with <span><sup style=" color:red; ">*</sup> 
                                            must be filled.</strong> 
                                   </td>
                                </tr>    <tr>
                                              <td colspan="6" style=" width:100%; height:15px; 
                                                 margin-bottom:10px; padding-left:10px; 
                                                 margin-top:10px; color:white;     background-color:gray;">
                                                  
                                                  <table>
                                                      <tr>
                                                          <td>
                                                            <input id="normalsearch" name="normalcheckedradio" onclick="search_type('normal_search')" class="radio_box" value='normal_search' type="radio" checked>  
                                                          </td>
                                                          <td><strong> Normal Search (Student)  </strong></td>
                                                          <td style=" width:20px; "></td>
                                                          <td><input id="advancesearch" name='normalcheckedradio' onclick="search_type('advance_search')" class="radio_box" value="advance_search" type="radio"> </td>
                                                          <td><strong>Advance Search (Student)  </strong></td>
                                                          <td><input id="othersearch" name='normalcheckedradio' onclick="search_type('other_search')" class="radio_box" value="other_search" type="radio"> </td>
                                                          <td><strong>Other Search  </strong></td>
                                                      </tr>
                                                  </table>                                                 
                                              </td>
                                          </tr>
                                           <tr>
                                              <td colspan="3">
                                                  <table cellspacing="0" cellpadding=0 style=" width:550px; 
                                                         height: auto; float:left;  margin-top:4px;  ">
                                                      
                                                      <tr>
                                                          <td style=" background-color:whitesmoke; height:32px;  "><input onclick="by_date()" id="check_by_date" type="checkbox" value="by_date"></td>
                                                          <td style=" background-color:whitesmoke; padding-right:5px; "><b>By Date</b></td>
                                                          <td colspan="2" style=" width:360px; ">
                                                              <table style=" display:none; " id="show_from_to_date_table">
                                                                  <tr>
                                                          <td style=" padding-left:5px; "><b>From</b></td><td><b>:</b></td>
                                                          <td><input type="text" id="date_from" class="text_box_class" placeholder="Enter from" readonly="readonly"></td>
                                                          <td style=" width:30px; "></td>
                                                           <td><b>To</b></td><td><b>:</b></td>
                                                           <td><input type="text" id="date_to" class="text_box_class" placeholder="Enter to"  readonly="readonly"></td>
                                                           
                                                               </tr>
                                                              </table>
                                                          </td>
                                                      </tr>
                                                  </table>   
                                              </td>
                                          </tr>
            <tr>
                <td>
                    <div id="normalsearchtable">
                    <table  cellspacing="0" cellpadding="0" style=" width:100%; height:auto;  ">
                        
             <tr>
                            <td style=" width:50px; height:60px; padding-left:5px; "><b>Class <sup style=" color:red; ">*</sup></b></td> 
            <td>
            <strong>:</strong>
            <select id="class_course_name" onchange="course_id(this.value)" class="selectbox">
                    <option id="class_zero" value="0">--Select--</option>
                    <?php 
              require_once '../connection.php';   
            $course_db=mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none'");
            while ($fetch_course_data=  mysql_fetch_array($course_db))
            {
                $course_id=$fetch_course_data['course_id'];
                $course_name=$fetch_course_data['course_name'];
                echo "<option value='$course_id'>$course_name</option>";  
                
                
            }
             ?>             
                </select>
            </td>
            <td style=" width:55px; height:30px;"><b>Section <sup style=" color:red; ">*</sup></b></td> 
            <td>
                <strong>: </strong>  <select onchange="section_id(this.value)" id="course_section" class="selectbox">
                    <option value="0">--Select--</option>
                                     
                </select>
            </td>
            
            <td style=" width:60px; height:30px;"><b>Student <sup style=" color:red; ">*</sup></b></td> 
            <td><strong>:</strong> </td>
            <td>
                
               <style>
             #student_search_record{ width:400px;border:1px solid silver; height:22px; float:left; cursor:pointer;
             margin-left:2px; }    
             #student_static_search_div{ width:400px; height:auto; position:absolute;
             float:right;  margin-top:23px; background-color: white; border:1px solid silver;
             border-top:0px; display:none; margin-left: 2px; }  
             #search_static_student{ width:390px;  height:18px; border:1px solid red; padding-left:2px;    }
             .list{ width:100%; height:auto; float:left; font-size:11px;   }
             #student_name_tittle{ width:auto; height:auto; float:left; padding-top:4px; padding-left:4px;     }
             #arrow_under_div{ width:10px; height:10px;  float:right; background-repeat:no-repeat; cursor:pointer; 
             margin-top:6px;margin-right:10px; background-image: url('../images/bottom_arrow.jpg'); }
           .redio_button{ width:20px; height:25px; cursor:pointer;   }
           .list li { color: dodgerblue;}
           .list b{ float:left; margin-left:6px;  }
           .list span{ font-size:11px; color:gray;  float:left; margin-left:5px;  }
           
           .add_student_sheet{ width:auto; padding-left:20px; padding-right:20px; background-color:coral;
           border:0px; margin-left:15px; cursor:pointer; padding-top:4px; padding-bottom:4px; color:whitesmoke;     }
           .student_father_name span{ font-size:10px; color:gray;  }
           #student_search_name{ width:447px; height:20px; padding-left:3px;  }
           #other_search_name{  width:447px; height:20px; padding-left:3px; }
           #automcomplete_first_div{ width:450px; height:auto; position:absolute;
 margin-left:0px;border-top:0px;
z-index:301; border-left:1px solid silver; border-right:1px solid silver;   }
           #ajax_auto_complete_div{ border-right:1px solid silver;   }
             </style> 
              <script type="text/javascript">
                 function show_student_div()
                 {
                  var class_id=document.getElementById("class_course_name").value; 
                  if(class_id==0)
                      {
                         alert("Please first select class"); 
                         document.getElementById("class_course_name").focus();
                         return false;
                       }else
                          {
                  
                  var input_student=document.getElementById("input_student").value;  
                   if(input_student==0)
                       {
                        document.getElementById("student_static_search_div").style.display="block";
                        document.getElementById("input_student").value=1;   
                        document.getElementById("search_static_student").focus();
                  
                       }else
                           {
                          document.getElementById("student_static_search_div").style.display="none";
                          document.getElementById("input_student").value=0;    
                           }
                 }
                 }
                </script>  
                
            
           <div id="fetch_record" style=" display:none; "></div>
               <input type="hidden" id="input_student" value="0"> 
                
            <div onclick="show_student_div()" id="student_search_record">
            <div id="student_name_tittle">-- Select Student --</div>
            <div id="arrow_under_div"></div>
            </div>
            
            <input type="hidden" id="admission_no">
            <div id="student_static_search_div">
                <table style=" width:100%; height:auto; float:left; border-bottom:1px solid skyblue;    ">
                    <tr>
                        <td><input class="search" autocomplete="off" placeholder="Search student name/Roll No./Admission No. OR father name" 
                               onkeydown="live_autocomplete_search(event,this.value)"    id="search_static_student" type="text"></td>
                    </tr>
                </table> 
                <ul id="all_student_list" class="list">
                    
                </ul>
            </div>
            </td>
             </tr></table></div>
                    
                    
                    
                    
            <div id="advancesearchtable" style="display:none;">        
            <table  cellspacing="0" cellpadding="0" style=" width:100%;   height:auto; padding-bottom:15px;  padding-top:15px;">
           <tr>
               <td><b>Search By <sup style=" color:red; ">*</sup></b></td>
               <td style=" width:40px; "> <strong>:</strong> </td>
            <td>
           
                <select id="studentsearchby" class="selectbox_advance" style=" width:300px; ">
                    <option id="advance_search_zero" value="0">---Select---</option>
     <option value="student_full_name">Student Name</option>
     <option value="father_name">Father Name</option>
     <option value="father_mobile_no">Father Mobile No.</option>
     <option value="father_email">Father Email id</option>
     <option value="id">Sr.No</option>
     <option value="student_id">Admission No.</option>
     <option value="student_dob">Student Date of Birth</option>
     <option value="admission_date">Admission Date</option>
     <option value="account_status">Account status</option>
     <option value="student_mobile_no">Student Mobile No.</option>
     <option value="student_email_id">Student Email id</option>
     <option value="mother_name">Mother Name</option>
     <option value="local_parent_name">Local Guardian Name </option>
                </select>
           
            </td>
            <td style=" width:115px; "></td>
            <td><b>Search <sup style=" color:red; ">*</sup></b></td> 
            <td style=" width:40px; "><strong>:</strong></td>
            <td >
                <input type="hidden" id="advance_admission_no">
            <input type="text" placeholder="Search" onkeyup="advance_live_autocomplete_search(event,this.value)" autocomplete="off" name="student_name" id="student_search_name">
            <div id="automcomplete_first_div">
                               <div id="ajax_auto_complete_div">
                                   <ul id="all_list">
                                       
                                   </ul>   
                               </div>
                           </div></td>
            <td>
            </td>
           </tr>
           </table>
                </div>  
                    
                    
                    
                    
               <div id="othersearchtable" style="display:none;">        
            <table  cellspacing="0" cellpadding="0" style=" width:100%;   height:auto; padding-bottom:15px;  padding-top:15px;">
           <tr>
               <td><b>Search By <sup style=" color:red; ">*</sup></b></td>
               <td style=" width:40px; "> <strong>:</strong> </td>
            <td>
           
                <select id="othersearchby" class="selectbox_advance" style=" width:300px; ">
                    <option id="other_search_zero" value="0">---Select---</option>
                    <option value="id">Receipt Number</option>
                    <option value="payment_date">Receipt ID</option>
                    <option value="admissionno">Payment Date (Y-m-d)</option>
                    <option value="fee_group_name">Fee Group Name</option>
                    <option value="specify_month_term">Month/Annual/Term</option>
                    <option value="payment_mode">Payment Mode</option>
                    <option value="bank_name">Bank Name</option>
                    <option value="cheque_dd_no">Cheque/DD Number</option>
                    <option value="cheque_dd_date">Cheque/DD Date (Y-m-d)</option>
                    <option value="status">Status</option>
                </select>
           
            </td>
            <td style=" width:115px; "></td>
            <td><b>Search <sup style=" color:red; ">*</sup></b></td> 
            <td style=" width:40px; "><strong>:</strong></td>
            <td >
            
            <input type="text" placeholder="Search" autocomplete="off" name="student_name" id="other_search_name">
            
            </td>
            <td>
            </td>
           </tr>
           </table>
                </div>      
                    
                    
                </td>
                </tr>
                <tr>
                    <td><input type="button" onclick="search_button()" class="button_styling" value="Search">
                    <input type="submit" class="button_styling" style=" background-color:deeppink;" value="Reset">
                    </td>
                </tr>
                                          
                                          <tr>
                                              <td style=" height:auto; "></td>
                                          </tr>
                                      </table>
                                    </td>
                                    
                                </tr> 
                                <tr>
                                    <td colspan="2">
                                     
                                        <div id="feespaymentdetailsdata">
                                            
                                         <div class="all_div_tag">
                                            <div class="top_menu_button" id="excel_button">Excel</div>  
                                            <div class="top_menu_button" id="pdf_button">Pdf</div>
                                           
  <a style="color:blue;" href="#" onclick="window.open('finance_fee_details_print.php?organization_id=<?php  echo $fetch_school_id;?>&&branch_id=<?php  echo $fetch_branch_unique_db_id;?>&&session_id=<?php  echo $fecth_session_id_set;?>&&currency=<?php  echo $fetch_currency;?>&&search_course_id=&&search_section_id=&&search_student_id=&&other_search_by=&&other_search_value=&&from_date=&&to_date=&&page_no=1&&limit=yes','size',config='height=530,width=1100,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
    <div class="top_menu_button" id="print_button">Print (0,50)</div>
    </a>
                                           
        <a style="color:blue;" href="#" onclick="window.open('finance_fee_details_print.php?organization_id=<?php  echo $fetch_school_id;?>&&branch_id=<?php  echo $fetch_branch_unique_db_id;?>&&session_id=<?php  echo $fecth_session_id_set;?>&&currency=<?php  echo $fetch_currency;?>&&search_course_id=&&search_section_id=&&search_student_id=&&other_search_by=&&other_search_value=&&from_date=&&to_date=&&page_no=1&&limit=no','size',config='height=530,width=1100,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
        <div class="top_menu_button" id="print_button">Print (All)</div> 
        </a> 
                                          
                                            
                                            </div>  
                                            
                                         
                <table cellspacing="0" cellpadding="0" class="details_table">
               <tr>
               <td class="top_heading_line">Sl No.</td>
               <td class="top_heading_line">Receipt No.</td>
               <td class="top_heading_line">Payment Date</td>
               <td class="top_heading_line">Class/Course-S</td>
               <td class="top_heading_line">Student Name</td>
               <td class="top_heading_line">Father Name</td>
               <td class="top_heading_line">Mobile Number</td>
               <td class="top_heading_line">Payment Mode</td>
               <td class="top_heading_line">Amount Payable</td>
               <td class="top_heading_line">Paid Amount</td>
               <td class="top_heading_line">Due Amount</td>
               <td class="top_heading_line">Status</td>
              <td class="top_heading_line" style=" border-right:1px solid black; ">Action</td>
              </tr>
              
              
            <?php 
              $row=0;
              $fee_payment_db= mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set' ORDER BY id DESC LIMIT 0,5");
              while ($fetch_fee_payment_data=  mysql_fetch_array($fee_payment_db))
              {
               $row++;
                  $fee_payment_id=$fetch_fee_payment_data['id'];
                  $recipt_id=$fee_payment_id;
                  $fee_payment_date=$fetch_fee_payment_data['payment_date'];
                  $student_id=$fetch_fee_payment_data['student_id'];
                  $stduent_course_id=$fetch_fee_payment_data['course_id'];
                  $encrypt_id=$fetch_fee_payment_data['encrypt_id'];
                  $payment_mode=strtoupper($fetch_fee_payment_data['payment_mode']);
                  $amount_payable=$fetch_fee_payment_data['student_payable_amount'];
                  $amount_paid=$fetch_fee_payment_data['amount_paid'];
                  $due_amount=$fetch_fee_payment_data['due_amount'];
                  
              
                  
                  $studnet_db=mysql_query("SELECT *,T1.encrypt_id as ad_id,T9.description as hostel_description,"
                 . "T10.description as transport_description FROM student_db as T1"
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
                 . " $db_t1_main_details T1.student_id='$student_id'");
                  $fetch_student_data=mysql_fetch_array($studnet_db);
                  $fetch_student_num_rows=mysql_num_rows($studnet_db);
                  if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
                  {
                    $student_name=$fetch_student_data['student_full_name'];
                    $father_name=$fetch_student_data['father_name'];
                    $father_mobile_no=$fetch_student_data['father_mobile_no'];
                    $section_id=$fetch_student_data['section_id'];
                  }else
                  {
                    $student_name="<b style='color:red;'>Missing</b>";
                    $father_name="<b style='color:red;'>Missing</b>";
                    $father_mobile_no="<b style='color:red;'>Missing</b>";
                    $section_id="";
                    
                  }
                  
                   $course_data_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id' and 
                session_id='$fecth_session_id_set' and course_id='$stduent_course_id'");
            $course_data_record=mysql_fetch_array($course_data_db);
            $course_data_num_rows=mysql_num_rows($course_data_db);
            if((!empty($course_data_record))&&($course_data_record!=null)&&($course_data_num_rows!=0))
            {
               $course_name=$course_data_record['course_name']; 
            }else
            {
              $course_name="";   
            }
                  
             $section_db=mysql_query("SELECT * FROM section_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and 
                session_id='$fecth_session_id_set' and section_id='$section_id'");   
             $section_data=mysql_fetch_array($section_db);
             $section_num_rows=  mysql_num_rows($section_db);
                  if((!empty($section_data))&&($section_data!=null)&&($section_num_rows!=0))
                  {
                  $section_name=$section_data['section_name'];   
                  }else
                  {
                      $section_name="";
                  }
                  
                  
                  
                  
                $payment_ststus=strtoupper($fetch_fee_payment_data['status']);
                if($payment_ststus=="CLEARED")
                {
                $payment_ststuss="";
              echo "<style>#color_select_$recipt_id {background-color:green; color:white; border:1px solid black;}</style>";
                   $payment_ststus=$payment_ststus;   
                }else
                    if($payment_ststus=="PENDING")
                {
                        $payment_ststuss="";
                        echo "<style>#color_select_$recipt_id {background-color:orange; color:white; border:1px solid black;}</style>";
                
                   $payment_ststus=$payment_ststus; 
                }else
                if($payment_ststus=="CANCEL")
                {
                    $payment_ststuss=$payment_ststus;
                   echo "<style>#color_select_$recipt_id { background-color:red; color:white; border:1px solid black;}</style>";
                
                   $payment_ststus=$payment_ststus;       
                   
                   }
                   
                  echo "<tr><td class='td_heading_data'>$row</td>"
                          . "<td class='td_heading_data'>$recipt_id</td>"
                          . "<td class='td_heading_data'>$fee_payment_date</td>"
                          . "<td class='td_heading_data'>$course_name <b>-</b> $section_name</td>"
                          . "<td class='td_heading_data'>$student_name</td>"
                          . "<td class='td_heading_data'>$father_name</td>"
                          . "<td class='td_heading_data'>$father_mobile_no</td>"
                          . "<td class='td_heading_data'>$payment_mode</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $amount_payable</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $amount_paid</td>"
                          . "<td class='td_heading_data' style='text-align:right; padding-right:8px;'><b style='color:red;'>$fetch_currency</b> $due_amount</td>"
                          . "<td class='td_heading_data'>";
                         
                  if($payment_ststus=="CANCEL")
                  {
                   echo "<select readonly='readonly' disabled onchange='status_change(this.value,$recipt_id)' "
                           . "id='color_select_$recipt_id'>";   
                  }  else {
                      echo "<select onchange='status_change(this.value,$recipt_id)' id='color_select_$recipt_id'>";
                  }
                 if($payment_ststus=="CLEARED")
                 {
                 echo "<option style='background-color:green;' value='cleared' selected>CLEARED</option>";  
                 }else {
                 echo "<option style='background-color:green;' value='cleared'>CLEARED</option>";
                 }
                 
                  if($payment_ststus=="PENDING")
                 {
                 echo "<option style='background-color:orange;' value='pending' selected>PENDING</option>";  
                 }else {
                 echo "<option style='background-color:orange;' value='pending'>PENDING</option>";
                 }
              
                   if($payment_ststus=="CANCEL")
                 {
                 echo "<option style='background-color:red;' value='cancel' selected>CANCEL</option>";  
                 }else {
                 echo "<option style='background-color:red;' value='cancel'>CANCEL</option>";
                 }
              
                          echo "</select></td>"
                          . "<td class='td_heading_data' style='border-right:1px solid black;'>";
                       if($payment_ststus!="CANCEL")  
                       {
                  {
                         ?>   
                        
                             <div id="update_button_<?php  echo $recipt_id;?>" onclick="change_fee_status('<?php  echo $recipt_id;?>')" class='update_button'>Update</div>
                   
                   <?php 
                        } 
                       }
                          echo"</td></tr>";   
                       
              }
              
              $check_fee_payment_num_rows=mysql_num_rows($fee_payment_db);
              if((empty($fee_payment_id))&&(empty($check_fee_payment_num_rows)))
              {
                  echo ' <tr>
                   <td style=" border:1px solid black; text-align:center; height:30px;
                      color:red; font-weight:bold;   border-top:0px;" colspan="14">Record no found !!</td>
               </tr>  ';   
              }
              
             $count_total_rows_db=mysql_query("SELECT * FROM finance_student_pay_fee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_unique_db_id'"
                      . " and session_id='$fecth_session_id_set'");
              $count_total_rows=  mysql_num_rows($count_total_rows_db);
              $show_page_number="4";
              $forward_page_devision=($count_total_rows/$show_page_number);
              $forward_page=ceil($forward_page_devision);
              $page=1;
              $first_limit=($show_page_number*$page);
              $limit_search="$first_limit,$show_page_number";
              $previous_page=0;
              $next_page=2;
             
              ?>          
              <tr> <td style=" height:15px; "></td></tr>
              
            <?php 
              if($count_total_rows>$show_page_number)
              {
              {
              ?>
                                <tr>
                                    <td colspan="14">
                                        <div id="forward_position">
                                        <?php 
                                           if($page>1)
                                          {
                                          {
                                          ?>  
                                            
                                        <div onclick="forward_page('<?php  echo $previous_page;?>')" class="next_button">Previous</div>
                                      <?php 
                                          }
                                          }
                                        ?>
                                        
                                        
                                      <?php 
                                        for($i=1;$i<=$forward_page;$i++)
                                        {
                                        {
                                        ?>
                                    <?php 
                                      if($page==$i)
                                        {
                                        ?>
                                        <div id="selected_page" class="number_position"><?php  echo $i;?></div>
                                      <?php 
                                       }else
                                       {
                                       {
                                       ?>
                               <div onclick="forward_page('<?php  echo $i;?>')" class="number_position"><?php  echo $i;?></div>
                                   <?php 
                                      }
                                      }
                                      ?>   
                                        
                                      <?php 
                                        }
                                        }
                                        ?>
                                      <?php 
                                        if($forward_page>$page)
                                        {
                                        {
                                        ?>
                                        <div onclick="forward_page('<?php  echo $next_page;?>')" class="next_button">Next</div>
                                      <?php 
                                        }
                                        }
                                        ?>
                                        
                                        </div>
                                        </td>
                                </tr>
                              <?php 
              }
              }
                                ?>
                            </table>
                            
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