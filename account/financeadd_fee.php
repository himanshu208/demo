<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php 
 $message_show="";
                      require_once '../connection.php';
                      if(!empty($_POST['addfeedetails']))
                      {
                      
                          
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;
   
    
                        $session_id=$_POST['use_inset_session_id'];
                         
                        if(!empty($_POST['add_other_fee']))
                        {
                            $activeHandT=$_POST['add_other_fee'];
                            $feename=$_POST['addfeename'];
                        }else
                            if(!empty($_POST['add_transport_other_fee']))
                            {
                            $activeHandT=$_POST['add_transport_other_fee'];
                            $feename=$_POST['addfeename'];  
                            }
                        else{
                         $activeHandT="deactive";
                         $feename=$_POST['addfeename'];
                            }
                       
                            //insert unique id
$result=mysql_query("SHOW TABLE STATUS LIKE 'financeaddfee'");
$row=mysql_fetch_array($result);
$nextId=$row['Auto_increment']; 
$final_fee_id="FES_$nextId";                            
$encrypt_id=md5(md5($final_fee_id));
                              
                            
                            
                            
                        $feedescription=$_POST['feedescription'];
                        if((!empty($feename))&&(!empty($final_fee_id))&&(!empty($activeHandT))&&(!empty($session_id))&&(!empty($fetch_branch_id))&&(!empty($fetch_school_id)))
                        {
                       $matchsamevalue=mysql_query("SELECT * FROM financeaddfee WHERE $db_main_details fee_id='$final_fee_id' and action='active' "
                               . "OR $db_main_details fee_name='$feename' and action='active'"); 
                        $matchvalue= mysql_fetch_array($matchsamevalue);
                        if(empty($matchvalue))
                        {  
                         $insertvalue=mysql_query("INSERT into financeaddfee values('','$fetch_school_id',
                                 '$fetch_branch_id','$session_id','$final_fee_id','$encrypt_id','$feename','$feedescription'
                                 ,'$activeHandT','$date','$date_time','$user_unique_id','active')");
                         if($insertvalue)
                         {
                           $message_show= '<div id="error-msg">Record save successfully complete.</div>';
                         }else $message_show= '<div id="error-msg">Request failed,please try again</div>';
                        }else  $message_show='<div id="error-msg">Record already exist in database.</div>';
                        }else $message_show='<div id="error-msg">Please fill all fields.</div>';

                      }
                      
                      
                        ?> 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Add New Fee Group</title>
       <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        
          <script type="text/javascript">
              function validateForm()
              {
               var fee_name=document.getElementById("add_feename").value; 
               if(fee_name==0)
               {
                  alert("Please enter fee name");
                  document.getElementById("add_feename").focus();
                  return false;
               }else
               {
                 document.getElementById("ajax_loader_show").style.display="block";   
               }
              }
              
              function hostel_fee_check(other_fee_value)
              {
                 var hostel_check=document.getElementById("hostel_cheked").checked; 
                 var transport_check=document.getElementById("transport_checked").checked;  
                if(transport_check==true)
                {
               document.getElementById("hostel_cheked").checked=false;
                alert("Please first uncheck transport fee");
                return false;
                }else
                if(hostel_check==true)
                {
               document.getElementById("add_feename").value=other_fee_value;
               document.getElementById("add_feename").readOnly=true;
               document.getElementById("add_feename").style.backgroundColor="whitesmoke";
              
                }else
                {
                 document.getElementById("add_feename").value="";
                 document.getElementById("add_feename").readOnly=false;
                  document.getElementById("add_feename").style.backgroundColor="white";
                }
                
              }
              
              function transport_fee_check(other_fee_value)
              {
                 var hostel_check=document.getElementById("hostel_cheked").checked; 
                 var transport_check=document.getElementById("transport_checked").checked;  
                if(hostel_check==true)
                {
               document.getElementById("transport_checked").checked=false;
                alert("Please first uncheck hostel fee");
                return false;
                }else
                if(transport_check==true)
                {
               document.getElementById("add_feename").value=other_fee_value;
               document.getElementById("add_feename").readOnly=true;
               document.getElementById("add_feename").style.backgroundColor="whitesmoke";
              
                }else
                {
                 document.getElementById("add_feename").value="";
                 document.getElementById("add_feename").readOnly=false;
                  document.getElementById("add_feename").style.backgroundColor="white";
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
        body{ font-weight:100; font-size:12px;  }
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial;   font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1150px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:250px; margin:0 auto; margin-top:5px; border:1px solid #555555; 
                     font-weight:100;  float:left;  padding-bottom:30px;   
    }
    .td_leftpaddingth{ padding-left:10px; padding-top:4px; }
    #top_add_view_div{ width:100px; height:18px; padding-top:6px; padding-left:10px;
                       padding-right:10px; margin-top:-4px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:2px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  font-weight:100;  }
    .textsize_same{ border:1px solid gray; padding-left:2px;  width:200px; height:22px;   margin-left:5px; }
    .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;   }
    #error-msg{ width:600px; height:22px;padding-top:8px; background-color: azure; color:red; font-weight:bold;
                border-radius:3px; 
                margin-top:10px; text-align: center; margin:0 auto; 
                border:1px solid silver;     }
    .text_area { width:199px; margin-left:5px; border:1px solid gray;  }
    .check_box_style{ height: 16px; width:16px; cursor:pointer;  }
    </style>
    <body style=" margin: 0;padding: 0;">
         <?php 
      include_once '../ajax_loader_page_second.php';
      ?> 
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
                                    <td colspan="7" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                    Add New Fee Details  
                                    
                                    <a href="financeview_fee.php" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Fee Detail">
                                    <div id="top_add_view_div">
                                        <strong>List Of Fee Group</strong>
                                    </div>
                                        </abbr>
                                    </a>
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
                                    
                                    <td colspan="7">
                                     <?php  echo $message_show;?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="td_leftpadding">
                                        <b>Fee Group <sup style=" color:red; ">*</sup></b> 
                                    </td>
                                    <td><strong>:</strong></td>
                                    <td style=" width:145px; " >
                                        <input type="text" placeholder="Enter fee name" name="addfeename" id="add_feename" class="textsize_same">
                                    </td>
                                    <td style=" width:15px; padding-left:20px;  ">
                                        <input type="checkbox" value="active" onclick="hostel_fee_check('Hostel Fee')"
                                               class="check_box_style" id="hostel_cheked" name="add_other_fee">
                                    </td>
                                    <td style=" width:80px; "><b>Hostel Fee</b></td>
                                    <td style=" width:15px; "><input type="checkbox" class="check_box_style" id="transport_checked"
                                                                     value="active" onclick="transport_fee_check('Transport Fee')" name="add_transport_other_fee">
                                     
                                    </td><td><b>Transport Fee</b></td>
                                </tr> 
                                 <tr>
                                    <td class="td_leftpadding">
                                        <b>Fee Group Description</b>  
                                    </td>
                                    <td><strong>:</strong> </td>
                                    <td>
                                  
                                 <textarea placeholder="Enter description"  name="feedescription" id="add_feedescription" 
                                                            class="text_area"></textarea>
                                 
                                 
                                 
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <input type="submit" value="Save" name="addfeedetails" 
                                           id="addfeesname"    class="add_button_reset_button">
                                        <input type="Reset" onclick="reset_button()" value="Reset" 
                                               class="add_button_reset_button" style="background-color: deeppink;">
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