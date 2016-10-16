<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>
<?php 
 $message_show="";
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
   
                      require_once '../connection.php';
                      if(isset($_POST['addfeedetails']))
                      {
                      $accountheadgrouptype=$_POST['accountgrouptype'];
                      $accountheadgroupname=$_POST['accountgroupname'];
                      $accountname=$_POST['accountname'];
                      $accountdescription=$_POST['accountdescription'];
                      $session_id=$_POST['use_inset_session_id'];
 
$result=mysql_query("SHOW TABLE STATUS LIKE 'financeaccountdetail'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_fee_group_id="ACCNTID_$nextId";                            
$encrypt_id=md5(md5($final_fee_group_id)); 
     
     
     
                      if((!empty($accountheadgrouptype))&&(!empty($final_fee_group_id))&&(!empty($accountheadgroupname))&&(!empty($accountname)))   
                      {
                     
                          
                          
                          $matchaccountvalue=mysql_query("SELECT * FROM financeaccountdetail WHERE $db_main_details "
                                  . "account_id='$final_fee_group_id' and action='active'
                              OR $db_main_details account_type='$accountheadgrouptype' and"
                                  . " account_group_id='$accountheadgroupname' and accountname='$accountname' and action='active'");
                      $fetchconditionmatch=mysql_fetch_array($matchaccountvalue);
                      $fetch_account_num_rows=mysql_num_rows($matchaccountvalue);
                      if((empty($fetchconditionmatch))&&($fetchconditionmatch==null)&&($fetch_account_num_rows==0))
                      {
                       $insertaccounthead=mysql_query("INSERT into financeaccountdetail values('','$fetch_school_id','$fetch_branch_id'
                               ,'$session_id','$final_fee_group_id','$encrypt_id','$accountheadgrouptype','$accountheadgroupname'
                               ,'$accountname','$accountdescription','$date','$date_time','$user_unique_id','active')");
                       if($insertaccounthead)
                       {
                         $message_show='<div id="error-msg">Record save successfully complete.</div>';  
                       }
                          
                      }else $message_show='<div id="error-msg">Record already exist in database.</div>';
                          
                          
                      }else $message_show='<div id="error-msg">Please fill all fields.</div>';
                      }
                      
                        ?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
        <script type="text/javascript" src="jquery/jquery-1.js">
        </script>
        <script type="text/javascript">
    function validateForm()
{
     var account_grop_type=document.getElementById("accountgrouptype").value;
     var account_group=document.getElementById("accountgroupname").value;
     var account_name=document.getElementById("accountname").value;
     if(account_grop_type==0)
         {
         alert("Please select account type");
         document.getElementById("accountgrouptype").focus();
         return false;
         }else
             if(account_group==0)
                 {
                  alert("Please select account group");
                  document.getElementById("accountgroupname").focus();
                  return false;
                 }else
                     if(account_name==0)
                         {
                          alert("Please enter account name");
                          document.getElementById("accountname").focus();
                          return false;
                         }
     
     
     
}    
    </script>
    <script type="text/javascript">
     function account_head(account_type)
     {
      
   var organization_id="<?php  echo $fetch_school_id;?>";
   var branch_id="<?php  echo $fetch_branch_id;?>";
   var session_id=document.getElementById("insert_session_id").value;
   
   if((organization_id==0)||(branch_id==0)||(session_id==0))
       {
        alert("sorry,technical problem");
        return false;
       }else
           {
var httpxml;   
if((account_type==0))
    {
     document.getElementById("accountgroupname").innerHTML="<option value='0'>-- Select account head--</option>";
     return false;
    }
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

   document.getElementById("accountgroupname").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
         document.getElementById("ajax_loader_show").style.display="none";    
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="financeajaxcode.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&account_type="+account_type;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);  
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
    #table_midle_settable{ width:100%; height:230px; margin:0 auto; margin-top:10px; font-size:12px;  float:left;    
    }
    .td_leftpaddingth{ padding-left:10px; padding-top:4px;  }
      #top_add_view_div{ width:130px; height:18px; padding-top:6px; padding-left:10px;
                       padding-right:10px; margin-top:-4px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:2px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid silver; margin-left:5px; width:245px; height:23px; padding-left:3px;   }
    .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;
    margin-top:10px; margin-bottom:10px;  }
    #error-msg{ width:600px; height:20px;padding-top:8px; background-color:#FFFFCC; 
                margin-top:10px;  color:#380000; text-align: center; margin:0 auto;  font-weight: 100;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    .selectsize_same{ width:250px; margin-left:5px;  height:26px; padding:2px;    }
    </style>
    <body style=" margin: 0;padding: 0;">
         <div id="financefirstdiv">
              <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
           
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
                           
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="2" class="td_leftpaddingth"  style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                    Add New Account
                                    
                                    <a href="financeaccount_viewall.php?viewaccountdetails=32yyt_sajjfhgb_ashhhvvtetefwtFfff_JHJVCfss" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Account Detail">
                                    <div id="top_add_view_div">
                                        <strong> View Account Details </strong>
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
                                    <td colspan="3">
                                      <?php  echo $message_show;?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Add Account Income/Expense Details</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Account Group Type</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                                </td>
                                              <td>
                                               <select name="accountgrouptype" onchange="account_head(this.value)"
                                                       id="accountgrouptype" class="selectsize_same">
                                                   <option value="0">
                                                 --Select--
                                                   </option>
                                                   <option value="expense">
                                                   Expense
                                                   </option>
                                                    <option value="income">
                                                   Income
                                                   </option>
                                               </select>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Account Group</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                                </td>
                                              <td>
                                               <select name="accountgroupname" id="accountgroupname"
                                                       class="selectsize_same">
                                                   <option value="">
                                                       --Select--
                                                   </option>
                                               </select>
                                              </td>
                                          </tr>
                                          
                                           <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Account Name</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                                </td>
                                              <td>
                                                  <input type="text" name="accountname" placeholder="Enter account name" id="accountname" class="textsize_same">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td class="td_leftpadding">
                                                  <strong>Account Description</strong>
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                               <textarea name="accountdescription" style=" width:245px; margin-left:5px;  height:80px;  "></textarea>
                                              </td>
                                          </tr>
                                      </table>
                                    </td>
                                    
                                </tr> 
                                 
                                <tr>
                                    
                                    
                                    <td colspan="2">
                                          <input type="submit" value="Save" name="addfeedetails" 
                                                 id="addbuttonaccounthead" class="add_button_reset_button" style=" margin-right: 12px;">
                                       
                                         <input type="button" value="Reset" class="add_button_reset_button" style=" background-color: deeppink;">
                                      
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
         </div>
       
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