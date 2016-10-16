<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>
<?php 
                      require_once '../connection.php';
$message_show="";
if(!empty($_POST['addfeedetails']))
{
                        
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;


                        $final_fee_group_id=$_POST['update_db_id'];                            
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
                                    . " fee_group_id!='$final_fee_group_id' and fee_id='$feename' and feegroupname='$feegroupname' and feegrouptype='$feegrouptype' and action='active'");
                        $fetchmatchdata=mysql_fetch_array($selectmatchannualfees);
                        $fetch_fee_group_num_rows=mysql_num_rows($selectmatchannualfees);
                        if((empty($fetchmatchdata))&&($fetchmatchdata==null)&&($fetch_fee_group_num_rows==0))
                        {
                        
  
                         $update_db=mysql_query("UPDATE financeaddfeegroup SET fee_id='$feename',"
                                 . "feegroupname='$feegroupname',feegroupalias='$feegroupalias',feegrouptype='$feegrouptype' WHERE fee_group_id='$final_fee_group_id' and action='active'");
                         if(($update_db)&&(!empty($update_db)))
                         {
                         
                         if($feegrouptype=="annual")
                         {
                       $month=$_POST['yearly_fee'];
                       $start_date=$_POST['annual_start_date'];
                       $due_date=$_POST['annual_due_date'];        
                         
                       if((!empty($month))&&($start_date)&&($due_date))
                       {
                       $delete_db=mysql_query("DELETE FROM finance_fee_set_date_db WHERE fee_group_id='$final_fee_group_id'");    
                       if($delete_db)
                       {
                       $insert_db=mysql_query("INSERT into finance_fee_set_date_db values('','$final_fee_group_id',"
                             . "'$month','$start_date','$due_date','none','$date','$date_time')");   
                        if($insert_db)
                        {
                       $request_failed=1;      
                        }else{
                       $request_failed=0;
                        }
                       }
                        else{
                       $request_failed=0;
                        }
                       }else
                       {
                      $request_failed=999;
                       }    
                         }else
                         if($feegrouptype=="monthly")
                         {
                          $delete_db=mysql_query("DELETE FROM finance_fee_set_date_db WHERE fee_group_id='$final_fee_group_id'");    
                       if($delete_db)
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
                          }
                        else{
                       $request_failed=0;
                        }  
                         }else
                         if($feegrouptype=="term")
                         {
                         $delete_db=mysql_query("DELETE FROM finance_fee_set_date_db WHERE fee_group_id='$final_fee_group_id'");    
                       if($delete_db)
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
                          }
                        else{
                       $request_failed=0;
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
                         $message_show='<div id="error-msg">Record update successfully complete</div>';
                             
                         }else{
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
<html>
    <head>
        <meta charset="UTF-8">
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <title>Edit Fee Group Details</title>
            <script type="text/javascript">
    function validateForm()
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
                     window.location.assign("edit_fee_group_details.php?token_id=<?php  echo $_REQUEST['token_id'];?>&&noofterm="+no_of_item+"&&fee_group_alias="+fee_group_alias+"&&fee_name="+fee_name+"&&fee_group_name="+fee_group_name+"&&term=feegroupterm");     
                                  
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
          <script type="text/javascript">
              function reset_button()
              {
        var r=confirm("Are you sure you want to refresh current page");
if (r==true)
  {       
        location.reload(); 
     
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
    <body onload="load_page()" style="margin: 0; padding:0; ">
         <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
          <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
          
      <?php  include_once 'edit_header_page.php';?>
               
                          <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">  
           
        <div class="first_work_div">
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
            
            <div class="edit_title_heading">Edit Fee Group Details</div>
            
            <table  cellspacing="2" cellpadding="2" id="edit_value_table" style=" width:1000px; float:left;  font-size:11px;  ">
                                
                             <?php 
                              
                               if((!empty($_REQUEST['token_id'])))
                               {
                                 $encrypt_id=$_REQUEST['token_id'];
                                 $fee_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE $db_main_details"
                                         . " encrypt_id='$encrypt_id' and action='active'");
                                 $fetch_fee_data=mysql_fetch_array($fee_db);
                                 $fetch_fee_num_rows=mysql_num_rows($fee_db);
                                 if((!empty($fetch_fee_data))&&($fetch_fee_data!=null)&&($fetch_fee_num_rows!=0))
                                 {
                                 $fetch_fee_id=$fetch_fee_data['fee_id'];
                                 $fetch_fee_group_id=$fetch_fee_data['fee_group_id'];
                                 $fee_group_name=$fetch_fee_data['feegroupname'];
                                 $fee_group_alias=$fetch_fee_data['feegroupalias'];
                                 
                                 {
                               ?>
                <tr>
                                    
                                    <td colspan="7">
                                        <input type="hidden" name="update_db_id" value="<?php echo $fetch_fee_group_id;?>">
                                     <?php  echo $message_show;?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td  class="td_leftpaddingth" style=" height:10px; " colspan="4"> 
                                    <strong style="color:gray;background-color:whitesmoke; padding-left:10px; padding-right:10px;
                                            font-size:11px; ">Fields marked with <span><sup style=" color:red; ">*</sup> 
                                            must be filled.</strong>    
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="td_leftpadding">
                                          <fieldset  style="font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select   Fee</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:218px; ">
                                                 
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Fee</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <select id="select_fee_name" class="selectsize_same" 
                                                       name="addfeename">
                                                
                                                 <?php 
                              require_once '../connection.php';
                              
                            
                             
                              $selectfeedatabse=mysql_query("SELECT * FROM financeaddfee WHERE organization_id='$fetch_school_id' and 
                              branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and fee_id='$fetch_fee_id'");
                              while ($fetchfee=mysql_fetch_array($selectfeedatabse))
                              {
                                  $fecth_fee_id=$fetchfee['fee_id'];
                                  $fetchfeename=$fetchfee['fee_name'];
                                  
                                   echo "<option id='$fecth_fee_id' value='$fecth_fee_id' selected>$fetchfeename</option>";
     
                              }
                                                                           
                                                   ?>
                                               </select>
                                              </td>
                                              
                                              
                                                                   
                                              
                                          </tr>
                                      </table>
                                    </td>
                                         </tr>
                                         
                                         
                                         
                                     <tr>
                                    <td colspan="4" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Fee Group Name</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Fee Group Name</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                             <?php  
                                               if(!empty($_REQUEST['fee_group_name']))
                                                   { 
                                                  $fee_name_print=$_REQUEST['fee_group_name'];
                                                    
                                                    }else
                                                    {
                                                      $fee_name_print=$fee_group_name;
                         
                                                    }
?>
                                               
                                               
                                               
                                               <input type="text"  name="feegroupname"
                                                      value="<?php  echo $fee_name_print;?>" id="fee_group_name" class="textsize_sames">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Alias</strong>  
                                              </td>
                                              <td>
                                               <strong>:</strong>  
                                             <?php 
                                               if(!empty($_REQUEST['fee_group_alias']))
                                                   { 
                                                   $print_fee_group_alise=$_REQUEST['fee_group_alias'];
                                                   
                                                   }else
                                                   {
                                                    $print_fee_group_alise=$fee_group_alias;
                                                       
                                                   }
                                                   ?>
                                               
                                               
                                               <input type="text" name="feegroupalias"
                                                      value="<?php  echo $print_fee_group_alise;?>"
                                                     id="fee_group_alias" class="textsize_sames">
                                              </td>
                                          </tr>
                                      </table>
                                    </td>
                                    
                                </tr> 
                                
                                
                              <?php 
                                $fee_group_type=$fetch_fee_data['feegrouptype'];
                               ?>
                                
                                 <tr>
                                 <td colspan="4" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Fee Group Type</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:25px; ">
                                               <?php 
                                                 if($fee_group_type=="annual")
                                                 {
                                                 ?> 
                                                <input type="radio" id="feegroupannual" name="feegrouptype"
                                                       value="annual" checked>
                                              <?php 
                                                 }else
                                                 {
                                                ?>
                                                <input type="radio" id="feegroupannual" name="feegrouptype"
                                                       value="annual" disabled>
                                              <?php  
                                                 }
                                                ?>
                                              </td>
                                              <td >
                                                  <strong> Annual</strong>
                                              </td>
                                              <td style=" width:25px; ">
                                              <?php 
                                                 if($fee_group_type=="monthly")
                                                 {
                                                 ?>
                                                <input type="radio" id="feegroupmonthly" name="feegrouptype" 
                                                       value="monthly" checked>
                                               <?php 
                                                 }else
                                                 {
                                                ?>
                                                <input type="radio" id="feegroupmonthly" name="feegrouptype" 
                                                       value="monthly" disabled>
                                              <?php  
                                                 }
                                                ?>
                                                
                                              </td>
                                              <td>
                                                 <strong> Monthly</strong>
                                              </td>
                                              
                                               <td style=" width:25px; ">
                                                   
                                               <?php 
                                                 if($fee_group_type=="term")
                                                 {
                                                 ?>   
                                                   
                                                <input type="radio" id="feegroupterm" name="feegrouptype"
                                                       value="term" checked>
                                                
                                              <?php 
                                                 }else
                                                 {
                                                ?>
                                                <input type="radio" id="feegroupterm" name="feegrouptype"
                                                       value="term" disabled>
                                              <?php  
                                                 }
                                                ?>
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
                              
                             $fee_group_set_date_db=mysql_query("SELECT * FROM finance_fee_set_date_db WHERE fee_group_id='$fetch_fee_group_id' and is_delete='none'"); 
                             $fee_group_number=mysql_num_rows($fee_group_set_date_db);
                                                 if($fee_group_type=="annual")
                                                 {
                                               $set_data_date=mysql_fetch_array($fee_group_set_date_db);
                                               $set_data_num_rows=mysql_num_rows($fee_group_set_date_db);
                                                  if((!empty($set_data_date))&&($set_data_date!=null)&&($set_data_num_rows!=0))
                                                  {
                                                  $annual_start_date=$set_data_date['collectfeestartdate'];
                                                  $annual_due_date=$set_data_date['collectfeeduedate'];       
                                                  }else
                                                  {
                                                  $annual_start_date="";
                                                  $annual_due_date="";    
                                                  }
                                                 ?> 
                                               <tr id="collectdatehidden">
                                              <?php 
                                                 }else
                                                 {
                                               $annual_start_date="";
                                                $annual_due_date=""; 
                                                 ?>
                                                <tr id="collectdatehidden" style=" display:none; ">
                                              <?php  
                                                 }
                                                ?>
                          
                                
                                    
                                   <td colspan="4" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                                 margin-top:5px;      text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Fee Collect Date</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                                <td class="td_leftpadding">
                                                    <input type="hidden" name="yearly_fee" value="yearly">
                                                  <strong>Fee Collect Start Date</strong> 
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <input type="text" name="annual_start_date" value="<?php  echo $annual_start_date;?>" id="to" class="textsize_same">
                                              </td> 
                                               
                                              <td style=" width:70px; ">
                                        
                                    </td>
                                         
                                              <td class="td_leftpadding">
                                                  <strong>Fee Collect Due Date</strong> 
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>  
                                               <input type="text" name="annual_due_date" id="from" value="<?php  echo $annual_due_date;?>" class="textsize_same">
                                              </td>
                                          </tr>
                                          
                                      </table>
                                       </fieldset>
                                    </td>
                                </tr>
                                
                                
                                
                                
                               <?php 
                                                 if($fee_group_type=="monthly")
                                                 {
                                                 ?>
                                                <tr id="monthlycollectdatehidden">
                                
                                               <?php 
                                                 }else
                                                 {
                                                ?>
                                                <tr id="monthlycollectdatehidden" style=" display:none; ">
                                
                                              <?php  
                                                 }
                                                ?>
                                
                              
                                   <td colspan="4" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                                 margin-top:5px;      text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Fee Collect Date</span></legend>
                                      <table  cellspacing="2" cellpadding="2" id="table_midle_settable">
                                         <?php 
$monthNamesshort=Array("","jan", "feb", "mar", "apr", "may", "jun", "jul",
"aug", "sep", "oct", "nov", "dec");
?>

                                          
                          <?php 
                            for($idate=1;$idate<=12;$idate++)
                            {
                              $value=$idate; 
                              $monthprint=$monthNamesshort[$idate];
$fee_group_set_date_dbs=mysql_query("SELECT * FROM finance_fee_set_date_db WHERE fee_group_id='$fetch_fee_group_id'"
        . " and monthlyofmonth='$monthprint' and is_delete='none'"); 
 $set_data_date=mysql_fetch_array($fee_group_set_date_dbs);
$set_data_num_rows=mysql_num_rows($fee_group_set_date_dbs);
                                                  if((!empty($set_data_date))&&($set_data_date!=null)&&($set_data_num_rows!=0))
                                                  {
                                                  $annual_start_date=$set_data_date['collectfeestartdate'];
                                                  $annual_due_date=$set_data_date['collectfeeduedate'];    
                                                  $checked="checked";
                                                  }else
                                                  {
                                                  $annual_start_date="";
                                                  $annual_due_date="";   
                                                  $checked="";
                                                  }                                  
                              echo "<tr>";
                              echo "<td>";
           
echo"<input type='checkbox'  name='checkmonth_$idate' id='check_month_$idate'  value='$monthprint' $checked>";
           
echo"</td>
                                              <td style='width:60px; padding-left:10px;'>
                                                 <strong>$monthprint</strong>
                                              </td>
                                                <td class='td_leftpadding'>
                                                  <strong>Fee Collect Start Date</strong> 
                                                  <sup style='color:red;'>*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
<input type='text'   name='month_start_date_$idate' id='startdatemonth_$idate' value='$annual_start_date' class='textsize_same'>

                                              </td> 
                                              
                                              <td style='width:40px;'></td>
                                             
                                         
                                              <td class='td_leftpadding'>
                                                  <strong>Fee Collect Due Date</strong> 
                                                  <sup style='color:red; '>*</sup> 
                                              </td>
                                               <td>
                                               <strong>:</strong>
<input type='text'  name='month_due_date_$idate' id='duedatemonth_$idate' value='$annual_due_date' class='textsize_same'>
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
                                   <td colspan="4" style=" width:100%; " class="td_leftpadding">
                                       
                                      <?php 
                                                 if($fee_group_type=="term")
                                                 {
                                                 ?>   
                                                   
                                               <div id="termcollectdatehidden" style=" display:block; ">
                                              <?php 
                                                 }else
                                                 {
                                                     $array_count=0;
                                                ?>
                                                <div id="termcollectdatehidden">
                                              <?php  
                                                 }
                                                ?>
                                       
                                        <?php 
                                                 if($fee_group_type=="term")
                                                 {
                                                 ?>      
                                           
                                           
                                       <fieldset style="   font-size:12px; font-weight:500;margin-left:10px;
                                                 margin-top:5px;      text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Term</span></legend>
                                      <table  cellspacing="0" cellpadding="0"  id="table_midle_settable">
                                          <tr>
                                              <td style=" width:170px; "> </td>
                                                <td class="td_leftpadding">
                                                  <strong>Create No Of Term</strong> 
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              
                                             <?php  if(!empty($_REQUEST['noofterm']))
                                                   { 
                                                   $array_count_no=$_REQUEST['noofterm'];
                                                   }else{
                                                   $array_count_no=$fee_group_number;  
                                                   }
                                                   ?>
                                               
                                               <input type="text" value="<?php  echo $array_count_no;?>"  id="noofterms" name="noofterm" class="textsize_sames">
                                               
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
                                <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4">
                                  <?php 
                                                 if($fee_group_type=="term")
                                                 {
                                                 ?>   
                                                   
                                              <div id="nooftermprocess" >
                                              <?php 
                                                 }else
                                                 {
                                                ?>
                                               <div id="nooftermprocess" style=" display:none; ">
                                              <?php  
                                                 }
                                                ?>     
                                   
                                                      
                                                 <?php 
                                           
                                     if((!empty($_REQUEST['noofterm']))||($fee_group_type=="term"))
                                     {
                                         if(!empty($_REQUEST['noofterm']))
                                         {
                                         $numberofterm=$_REQUEST['noofterm'];
                                         }else
                                         {
                                         $numberofterm=$fee_group_number;    
                                         }
                                         echo "<style>#termcollectdatehidden{ display:block; }</style>";
                                      
                                         
                                         echo '<fieldset style=" font-size:12px; font-weight:500;margin-left:10px;
                                                 margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  "><b>Set Fee Collect Date</b></span></legend>
                                      <table  cellspacing="2" cellpadding="2" id="table_midle_settable">
                                      ';
                                         echo "<tr> <td><input type='hidden' value='$numberofterm'"
                                                 . " id='total_term_no' name='hiddennumberofterm'></td></tr>";
                                         for($term=1;$term<=$numberofterm;$term++)
                                         {
                                           
                                           $term_value="term_$term";  
$fee_group_set_date_dbss=mysql_query("SELECT * FROM finance_fee_set_date_db WHERE fee_group_id='$fetch_fee_group_id'"
        . " and monthlyofmonth='$term_value' and is_delete='none'"); 
 $set_data_date=mysql_fetch_array($fee_group_set_date_dbss);
$set_data_num_rows=mysql_num_rows($fee_group_set_date_dbss);
                                                  if((!empty($set_data_date))&&($set_data_date!=null)&&($set_data_num_rows!=0))
                                                  {
                                                  $annual_start_date=$set_data_date['collectfeestartdate'];
                                                  $annual_due_date=$set_data_date['collectfeeduedate'];    
                                                  $checked="checked";
                                                  }else
                                                  {
                                                  $annual_start_date="";
                                                  $annual_due_date="";   
                                                  $checked="";
                                                  }            
                                        
                                         echo "
                                             

                                          <tr>
                                          <td>";
       
echo"<input type='checkbox' name='termcheckednumber_$term' id='term_check_$term' value='term_$term' $checked>";
     
echo"</td>
                                             <td style='width:60px;'><strong>Term $term</strong></td>
                                                <td class='td_leftpadding'>
                                                  <strong>Fee Collect Start Date</strong> 
                                                  <sup style=' color:red; '>*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                               <input type='text' id='termannualfee$term' name='term_start_date_$term' value='$annual_start_date' class='textsize_same'>
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
                                               <input type='text' id='termduefeedate$term' name='term_due_date_$term' value='$annual_due_date' class='textsize_same'>
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
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="submit" value="Update" name="addfeedetails" 
                                           id="addfeesname"    class="add_button_reset_button">
                                        <input type="Reset" onclick="reset_button()" value="Reset" 
                                               class="add_button_reset_button" style="background-color: deeppink;">
                                    </td>
                                </tr>
                                
                                
                              <?php 
                                 }
                                 }
                               }
                                ?>
                                
                            </table>
                            
        </div>
        </form>
        
        
        
      <?php  include_once 'edit_fotter_page.php';?>
    </body>
</html>
<?php
}else
{
    echo "Sorry,Technical Problem";   
}
?>