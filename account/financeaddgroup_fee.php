<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php 
                      require_once '../connection.php';
$message_show="";
if(!empty($_POST['addfeegroupdetails']))
{
                        
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
    
$result=mysql_query("SHOW TABLE STATUS LIKE 'financeaddfeegroup'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_fee_group_id="FESGRP_$nextId";                            
$encrypt_id=md5(md5($final_fee_group_id));
                                 

                          
                          
                        $feename=$_POST['addfeename'];
                        $feegroupname=$_POST['feegroupname'];
                        $feegroupalias=$_POST['feegroupalias'];
                        
                        if(!empty($_POST['feegrouptype']))
                        {
                        $feegrouptype=$_POST['feegrouptype'];
                        }else
                         {
                         $feegrouptype=0;
                         }
                        $insert_session_id=$_POST['use_inset_session_id'];
                         if(!empty($feegrouptype))
                        { 
                        
                        if((!empty($feename))&&(!empty($insert_session_id))&&(!empty($feegroupname))&&(!empty($feegrouptype))&&(!empty($final_fee_group_id)))
                        {
                        
                            
                            $selectmatchannualfees=mysql_query("SELECT * FROM financeaddfeegroup WHERE $db_main_details"
                                    . " fee_group_id='$final_fee_group_id' and action='active' 
                                    OR $db_main_details fee_id='$feename' and feegroupname='$feegroupname' and feegrouptype='$feegrouptype' and action='active'");
                        $fetchmatchdata=mysql_fetch_array($selectmatchannualfees);
                        $fetch_fee_group_num_rows=mysql_num_rows($selectmatchannualfees);
                        if((empty($fetchmatchdata))&&($fetchmatchdata==null)&&($fetch_fee_group_num_rows==0))
                        {
                        
                         $insertvalue=mysql_query("INSERT into financeaddfeegroup values('','$fetch_school_id','$fetch_branch_id','$insert_session_id'
                                 ,'$final_fee_group_id','$encrypt_id','$feename','$feegroupname','$feegroupalias','$feegrouptype'
                                 ,'$date','$date_time','$user_unique_id','active')");
                         if(($insertvalue)&&(!empty($insertvalue)))
                         {
                         
                         if($feegrouptype=="annual")
                         {
                       $month=$_POST['yearly_fee'];
                       $start_date=$_POST['annual_start_date'];
                       $due_date=$_POST['annual_due_date'];        
                         
                       if((!empty($month))&&($start_date)&&($due_date))
                       {
                       $insert_db=mysql_query("INSERT into finance_fee_set_date_db values('','$final_fee_group_id',"
                             . "'$month','$start_date','$due_date','none','$date','$date_time')");   
                        if($insert_db)
                        {
                       $request_failed=1;      
                        }else{
                       $request_failed=0;
                        }
                       }else
                       {
                      $request_failed=999;
                       }    
                         }else
                         if($feegrouptype=="monthly")
                         {
                         $request_failed=0;    
                         for($i=1;$i<=12;$i++)
                         {
                             if(!empty($_POST["checkmonth_$i"]))
                             {
                          $month=$_POST["checkmonth_$i"];
                          $start_date=$_POST["month_start_date_$i"];
                          $due_date=$_POST["month_due_date_$i"];   
                          if((!empty($month))&&(!empty($start_date))&&(!empty($due_date)))
                          {
                         $insert_db=mysql_query("INSERT into finance_fee_set_date_db values('','$final_fee_group_id',"
                             . "'$month','$start_date','$due_date','none','$date','$date_time')");   
                        if($insert_db)
                        {
                       $request_failed++;      
                        } 
                          }
                         }
                         }
                           
                         }else
                         if($feegrouptype=="term")
                         {
                         $request_failed=0;    
                         $term_no=$_POST['hiddennumberofterm'];
                         for($i=1;$i<=$term_no;$i++)
                         {
                         if(!empty($_POST["termcheckednumber_$i"]))
                             {
                          $month=$_POST["termcheckednumber_$i"];
                          $start_date=$_POST["term_start_date_$i"];
                          $due_date=$_POST["term_due_date_$i"];   
                          if((!empty($month))&&(!empty($start_date))&&(!empty($due_date)))
                          {
                         $insert_db=mysql_query("INSERT into finance_fee_set_date_db values('','$final_fee_group_id',"
                             . "'$month','$start_date','$due_date','none','$date','$date_time')");   
                        if($insert_db)
                        {
                       $request_failed++;      
                        } 
                          }
                         }
                          
                         }
                         }else
                         {
                           $request_failed=0;   
                         }
                         
                        if($request_failed==999)
                        {
                         $message_show='<div id="error-msg">Please fill all fileds.</div>';    
                        }else
                         if(!empty($request_failed))
                         {
                         $message_show='<div id="error-msg">Record save successfully complete</div>';
                             
                         }else{
                       $delete_db=mysql_query("DELETE FROM financeaddfeegroup WHERE fee_group_id='$final_fee_group_id' and action='active'");      
                       $message_show='<div id="error-msg">Request failed,please try again</div>';   
                         }
                         }else $message_show='<div id="error-msg">Request failed,please try again</div>';
                      
                        }else
                            $message_show='<div id="error-msg">Record already exist in database.</div>';
                       }else
                            $message_show='<div id="error-msg">Please fill all fileds.</div>'; 
                      
                        }else  $message_show='<div id="error-msg">Please check atleast one fee group type</div>';
                        }
                      
                        ?> 


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script type="text/javascript">
    function  validateForm()
    {
      var fee_name=document.getElementById("select_fee_name").value;
       var fee_group_name=document.getElementById("fee_group_name").value;
       var fee_annual_group_type=document.getElementById("feegroupannual").checked;
       var fee_monthly_group_type=document.getElementById("feegroupmonthly").checked;
       var fee_term_group_type=document.getElementById("feegroupterm").checked;
      
       if(fee_name==0)
           {
              alert("Please select fee group");
              document.getElementById("select_fee_name").focus();
              return false;
           }else
              if(fee_group_name==0)
           {
              alert("Please enter fee name");
              document.getElementById("fee_group_name").focus();
              return false;
           }else
             if((fee_annual_group_type==false)&&(fee_monthly_group_type==false)&&(fee_term_group_type==false))
                  {
                      alert("Please check fee group type");
                      return false;
                  }else
                      if(fee_annual_group_type==true)
                          {
                         
                          var start_date=document.getElementById("to").value;
                           var due_date=document.getElementById("from").value;
                           if(start_date==0)
                               {
                               alert("Please fill fee collect start date");
                               document.getElementById("to").focus();
                               return false;
                               }else
                               if(due_date==0)
                               {
                               alert("Please fill fee collect due date");
                               document.getElementById("from").focus();
                               return false;
                               }
                          }else
                          if(fee_monthly_group_type==true)
                          {
                       for(var i=1;i<=12;i++)
                       {
                        if(document.getElementById("check_month_"+i+"")) 
                        {
                       var  check_check_box=document.getElementById("check_month_"+i+"").checked;
                       if(check_check_box==true)
                       {
                       var start_date=document.getElementById("startdatemonth_"+i+"").value;
                       var due_date=document.getElementById("duedatemonth_"+i+"").value;
                        if(start_date==0)
                               {
                               alert("Please fill fee collect start date");
                               document.getElementById("startdatemonth_"+i+"").focus();
                               return false;
                               }else
                               if(due_date==0)
                               {
                               alert("Please fill fee collect due date");
                               document.getElementById("duedatemonth_"+i+"").focus();
                               return false;
                               }
                       }
                       }
                       }
                       }else
                           if(fee_term_group_type==true)
                       {
                      var term_no=document.getElementById("total_term_no").value;
                      for(var i=1;i<=term_no;i++)
                      {
                     if(document.getElementById("term_check_"+i+"")) 
                        {
                       var  check_check_box=document.getElementById("term_check_"+i+"").checked;
                       if(check_check_box==true)
                       {
                       var start_date=document.getElementById("termannualfee"+i+"").value;
                       var due_date=document.getElementById("termduefeedate"+i+"").value;
                        if(start_date==0)
                               {
                               alert("Please fill fee collect start date");
                               document.getElementById("termannualfee"+i+"").focus();
                               return false;
                               }else
                               if(due_date==0)
                               {
                               alert("Please fill fee collect due date");
                               document.getElementById("termduefeedate"+i+"").focus();
                               return false;
                               }
                       }
                       }
                      }
                      }
                      
           
       
    }
    
    function go_to_forward()
    {
      
      var fee_name=document.getElementById("select_fee_name").value;
       var fee_group_name=document.getElementById("fee_group_name").value;
       var no_of_item=document.getElementById("noofterms").value;
       var fee_group_alias=document.getElementById("fee_group_alias").value;
        if(fee_name==0)
           {
              alert("Please select fee");
              document.getElementById("select_fee_name").focus();
              return false;
           }else
              if(fee_group_name==0)
           {
              alert("Please enter fee group name");
              document.getElementById("fee_group_name").focus();
              return false;
           }else
               if(no_of_item==0)
                   {
                    alert("Please enter no of term");
              document.getElementById("noofterms").focus();
              return false;   
                   }else
                       if(isNaN(no_of_item))
                   {
                    alert("Please enter only numeric value");
              document.getElementById("noofterms").focus();
              return false;   
                   }else
                       {
                     window.location.assign("financeaddgroup_fee.php?noofterm="+no_of_item+"&&fee_group_alias="+fee_group_alias+"&&fee_name="+fee_name+"&&fee_group_name="+fee_group_name+"&&term=feegroupterm");     
                                  
                       }
    }
    </script>
    <script type="text/javascript">
  function load_page(){
     if(document.getElementById("<?php  echo $_REQUEST['term'];?>"))
     {
    document.getElementById("<?php  echo $_REQUEST['term'];?>").checked=true;
     }
    }
    </script>
        
       
    </head>
    <style>
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-weight:800;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1150px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:180px; margin:0 auto; margin-top:5px; border:1px solid #555555; float:left;    
    }
    #table_midle_settable{ width:100%; height:60px; margin:0 auto; margin-top:10px; font-size:12px;  float:left;    
    }
    .td_leftpaddingth{ padding-left:10px; padding-top:4px;}
    #top_add_view_div{ width:150px; height:18px; padding-top:6px; padding-left:10px;
                       padding-right:10px; margin-top:-4px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:2px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; height:22px;   margin-left:5px; }
    .textsize_sames{ border:1px solid gray; width:200px; height:21px;   margin-left:5px; }
   .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;   }
    #error-msg{ width:600px; height:22px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px;  color:#380000; text-align: center; margin:0 auto; font-weight:100; padding-top:8px;  
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    .selectsize_same{ width:205px; height:23px; padding: 2px; margin-left:5px;   }
    .samecalenderimageset{ widows:22px; height:25px; background-repeat:no-repeat;  background-image:url('finanacephoto/calender.png'); }
    .samecalenderimageset:hover{ cursor:pointer; }
    input{ padding-left:3px; }
    #termcollectdatehidden{ display:none; }
    #ui-datepicker-div{ font-size:12px; }
    </style>
    <body onload="load_page()" style=" margin: 0;padding: 0;">
         <div id="financefirstdiv">
              <form name="myForm" action="financeaddgroup_fee.php" method="post" enctype="multipart/form-data">
           
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="background-image:url('finanacephoto/bgblack.png');">
                        
                              <?php 
                                include_once 'heademastersetting.php';
                                ?>
                           <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">   
       
                    </td>
                </tr> 
                <tr>
                    <td>
                        <div id="valuediv">
                       
                            
                            
          
        <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js"></script> 
        <link rel="stylesheet" href="../javascript/calenderapi/themes/base/jquery.ui.all.css">
	<script src="../javascript/calenderapi/jquery-1.10.2.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.core.js"></script>
	<script src="../javascript/calenderapi/ui/jquery.ui.widget.js"></script>
        <script src="../javascript/calenderapi/ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../javascript/calenderapi/demos.css">
        <script type="text/javascript">
      
$(function() {

$(".textsize_same").datepicker({ 
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
                                    <td colspan="2" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                    Add New Fee
                                    
                                    <a href="financeviewgroup_fee.php" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Fee Detail">
                                    <div id="top_add_view_div">
                                        <strong>List Of Fee</strong>
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
                                    <td colspan="4">
                                   <?php  echo $message_show;?>   
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="td_leftpadding">
                                          <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                              <legend><span style=" color: maroon;  "><b>Select Fee Group</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:218px; ">
                                                 
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Fee Group</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <select id="select_fee_name" class="selectsize_same" name="addfeename">
                                                   <option value="0">--Select--</option>
                                                 <?php 
                              require_once '../connection.php';
                              
                             if(!empty($_REQUEST['fee_name']))
                             {
                               $get_fee_id=$_REQUEST['fee_name'];    
                             }else
                             {
                                $get_fee_id=""; 
                             }
                              $selectfeedatabse=mysql_query("SELECT * FROM financeaddfee WHERE $db_main_details action='active'");
                              while ($fetchfee=mysql_fetch_array($selectfeedatabse))
                              {
                                  $fecth_fee_id=$fetchfee['fee_id'];
                                  $fetchfeename=$fetchfee['fee_name'];
                                  if($get_fee_id==$fecth_fee_id)
                                  {
                                     
                                   echo "<option id='$fecth_fee_id' value='$fecth_fee_id' selected>$fetchfeename</option>";
                                  }else
                                  {
                                  echo "<option id='$fecth_fee_id' value='$fecth_fee_id'>$fetchfeename</option>";
                                      
                                  }
                              }
                                                                           
                                                   ?>
                                               </select>
                                              </td>
                                              
                                              
                                                                   
                                              
                                          </tr>
                                      </table>
                                    </td>
                                         </tr>
                                         
                                         
                                         
                                     <tr>
                                    <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                           <legend><span style=" color: maroon;  "><b>Set Fee</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Fee Name</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <input type="text"  name="feegroupname"
                                                      value="<?php  if(!empty($_REQUEST['fee_group_name'])){ echo $_REQUEST['fee_group_name'];}?>" id="fee_group_name" class="textsize_sames">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Alias</strong>  
                                              </td>
                                              <td>
                                               <strong>:</strong>  
                                               <input type="text" name="feegroupalias"
                                                      value="<?php  if(!empty($_REQUEST['fee_group_alias'])){ echo $_REQUEST['fee_group_alias'];}?>"
                                                     id="fee_group_alias" class="textsize_sames">
                                              </td>
                                          </tr>
                                      </table>
                                    </td>
                                    
                                </tr> 
                                
                                
                                
                                
                                 <tr>
                                 <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                           <legend><span style=" color: maroon;  "><b>Set Fee Type</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:25px; ">
                                                <input type="radio" id="feegroupannual" name="feegrouptype"
                                                       value="annual" checked>
                                              </td>
                                              <td >
                                                  <strong> Annual</strong>
                                              </td>
                                              <td style=" width:25px; ">
                                                <input type="radio" id="feegroupmonthly" name="feegrouptype" 
                                                       value="monthly">
                                              </td>
                                              <td>
                                                 <strong> Monthly</strong>
                                              </td>
                                              
                                               <td style=" width:25px; ">
                                                <input type="radio" id="feegroupterm" name="feegrouptype"
                                                       value="term">
                                              </td>
                                              <td>
                                                 <strong>Term</strong>
                                              </td>
                                             
                                          </tr>
                                          
                                      </table>
                                    </td>
                                </tr>
                                <script type="text/javascript">
         $(document).ready(function(){
         $("#feegroupannual").click(function(){
          $("#customcollectdatehidden,#monthlycollectdatehidden,#nooftermprocess,#termcollectdatehidden,#dailycollectdatehidden").hide();
          $("#collectdatehidden").show();
         });
         
         
          $("#feegroupmonthly").click(function(){
          $("#customcollectdatehidden,#collectdatehidden,#nooftermprocess,#termcollectdatehidden,#dailycollectdatehidden").hide();
          $("#monthlycollectdatehidden").show();
         });
         
         
          $("#feegroupcustom").click(function(){
          $("#collectdatehidden,#monthlycollectdatehidden,#nooftermprocess,#termcollectdatehidden,#dailycollectdatehidden").hide();
          
          $("#customcollectdatehidden").show();  
          });
         
          $("#feegroupterm").click(function(){
          $("#customcollectdatehidden,#monthlycollectdatehidden,#nooftermprocess,#collectdatehidden,#dailycollectdatehidden").hide();
          $("#termcollectdatehidden").css("display","block");   
         });
         
                  
         });
         </script>
                                <title>Finance</title>
        
         <?php
         if(!empty($_REQUEST['noofterm']))
         {
        $display="display:none";  
        $checked_box="checked";
         }else
         {
          $display="";  
          $checked_box="";
         }
         ?>
                             
                          
                                <tr id="collectdatehidden" style=" width:100%; <?php echo $display;?> ">
                                    
                                   <td colspan="3" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                                 margin-top:5px;      text-align:left;">
                                           <legend><span style=" color: maroon;  "><b>Set Fee Collect Date</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                                <td class="td_leftpadding">
                                                    <input type="hidden" name="yearly_fee" value="yearly">
                                                  <strong>Fee Collect Start Date</strong> 
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
<input type="text"  name="annual_start_date" id="to" class="textsize_same">
                                              </td> 
                                               
                                              <td style=" width:70px; ">
                                        
                                    </td>
                                         
                                              <td class="td_leftpadding">
                                                  <strong>Fee Collect Due Date</strong> 
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>  
 <input type="text"  name="annual_due_date" id="from" class="textsize_same">
                                              </td>
                                          </tr>
                                          
                                      </table>
                                       </fieldset>
                                    </td>
                                </tr>
                                
                                
                                
                                
                                
                                
                                
                                <tr id="monthlycollectdatehidden" style=" display:none; ">
                                    
                                   <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                                 margin-top:5px;      text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Fee Collect Date</span></legend>
                                      <table  cellspacing="2" cellpadding="2" id="table_midle_settable">
                                         <?php 


$monthNamesshort = Array("","jan", "feb", "mar", "apr", "may", "jun", "jul",
"aug", "sep", "oct", "nov", "dec");
?>

                                          
                          <?php 
                            for($idate=1;$idate<=12;$idate++)
                            {
                              $value=$idate; 
                              $monthprint=$monthNamesshort[$idate];
                              echo "
<tr>                             
                              ";
                              
                                echo "
                                              
                                              <td><input type='checkbox' name='checkmonth_$idate' id='check_month_$idate' value='$monthprint' checked></td>
                                              <td style='width:60px; padding-left:10px;'>
                                                 <strong>$monthprint</strong>
                                              </td>
                                                <td class='td_leftpadding'>
                                                  <strong>Fee Collect Start Date</strong> 
                                                  <sup style='color:red;'>*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                     <input type='text'  name='month_start_date_$idate' id='startdatemonth_$idate' class='textsize_same'>

                                              </td> 
                                              
                                              <td style='width:40px;'></td>
                                             
                                         
                                              <td class='td_leftpadding'>
                                                  <strong>Fee Collect Due Date</strong> 
                                                  <sup style='color:red; '>*</sup> 
                                              </td>
                                               <td>
                                               <strong>:</strong>
<input type='text'  name='month_due_date_$idate' id='duedatemonth_$idate' class='textsize_same'>
                                              </td> 
                                             
                                          </tr>                                    
";  
                            }
                            ?>             
                                          
                                          
                                          
                                          
                                      </table>
                                       </fieldset>
                                    </td>
                                </tr>
                                
                                
                                
                                
                                
                                
                                
                                
                               
                                
                                 <tr>
                                    
                                   <td colspan="3" style=" width:100%; " class="td_leftpadding">
                                       <div id="termcollectdatehidden">
                                       <fieldset style="   font-size:12px; font-weight:500;margin-left:10px;
                                                 margin-top:5px;      text-align:left;">
                                           <legend><span style=" color: maroon;  "><b>Set Term</b></span></legend>
                                      <table  cellspacing="0" cellpadding="0"  id="table_midle_settable">
                                          <tr>
                                              <td style=" width:170px; "> </td>
                                                <td class="td_leftpadding">
                                                    <strong><b>Create No Of Term</b></strong> 
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <input type="text" value="<?php  if(!empty($_REQUEST['noofterm'])){ echo $_REQUEST['noofterm'];}?>"  id="noofterms" name="noofterm" class="textsize_sames">
                                               
                                              </td> 
                                               
                                         
                                              <td class="td_leftpadding">
                                             <input type="button" style=" float:left; " onclick="return go_to_forward()" id="goandprocess" name="goandprocess" value="Go&Process">
                                              </td>
                                              <td style=" width:170px; ">
                                             
                                              </td>
                                             
                                          </tr>
                                          
                                          
                                          
                                     
                                    
                                      </table>
                                       </fieldset>
                                       </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        
                                                  <div id="nooftermprocess">
                                                      
                                                 <?php 
                                     if(!empty($_REQUEST['noofterm']))
                                     {
                                         
                                         $numberofterm=$_REQUEST['noofterm'];
                                        
                                         echo "<style>#termcollectdatehidden{ display:block; }</style>";
                                      
                                         
                                         echo '<fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                                 margin-top:5px; text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Fee Collect Date</span></legend>
                                      <table  cellspacing="2" cellpadding="2" id="table_midle_settable">
                                      ';
                                         echo "<tr> <td><input type='hidden' id='total_term_no' value='$numberofterm'"
                                                 . " name='hiddennumberofterm'></td></tr>";
                                         for($term=1;$term<=$numberofterm;$term++)
                                         {
                                           
                                         echo "
                                             

                                          <tr>
                                          <td><input type='checkbox' name='termcheckednumber_$term' id='term_check_$term' value='term_$term' checked></td>
                                             <td style='width:60px;'><strong>Term $term</strong></td>
                                                <td class='td_leftpadding'>
                                                  <strong>Fee Collect Start Date</strong> 
                                                  <sup style=' color:red; '>*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <input type='text' id='termannualfee$term' name='term_start_date_$term' class='textsize_same'>
                                               <div id='starttermfee$term' class='alltermsdivhide' style=' display:none; margin-left:-30px; position: absolute; '></div>
                                              </td> 
                                               
                                              <td style=' width:10px; '>
                                        
                                    </td>
                                         
                                              <td class='td_leftpadding'>
                                                  <strong>Fee Collect Due Date</strong> 
                                                  <sup style=' color:red; '>*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>  
                                               <input type='text' id='termduefeedate$term' name='term_due_date_$term' class='textsize_same'>
                                               <div id='duetermfee$term' class='alltermsdivhide' style=' display:none; margin-left:-30px; position:absolute;  '></div>
                                              </td>
                                             
                                             
                                             
                                          </tr>
                                          
                                      
";    
                                         }
                                         echo "</table>
                                       </fieldset>";
                                     }else{}
                                     ?>        
                                                      
                                                  </div>       
                                              </td>
                                          </tr>
                                    
                               
                                
                                
                                <tr>
                                    
                                    
                                    <td colspan="2" style=" height: 45px;"> 
                                        <input type="submit" value="Save" onclick="return validateForm();" name="addfeegroupdetails"
                                               class="add_button_reset_button" style=" margin-right:15px; ">
                                       
                                        <input type="reset" value="Reset" class="add_button_reset_button" style="background-color:deeppink; ">
                                        
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                        </br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div style=" width:300px; height:40px; float:left;   ">
                            
                        </div>
                    </td>
                </tr>
            </table> 
              </form>
         </div>
       
        <tr>
                    <td>
                        <div style=" width:300px; height:100px; float:left;   ">
                            
                        </div>
                    </td>
                </tr>
            </table> 
            
         </div>
       
        
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>