<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/configuration.php';
if($connection_permission==1)
{
?>

<?php
$message_show="";
if(isset($_POST['addfeedetails']))
{
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$time_current=date("h:i:s A");
$date=date("Y-m-d");
$date_time=$date." ".$time_current;

$update_db_id=$_POST['update_db_id'];
 $receipt_prefix=$_POST['receipt_prefix'];
 $pay_slip_prefix=$_POST['pay_slip_prefix'];
         $receipt_format=$_POST['print_format'];
         $payslip_format=$_POST['slip_print_format'];
         $print_copy=$_POST['print_copy'];
         if(!empty($_POST['sms_alert']))
         {
         $sms_alert=$_POST['sms_alert'];
         }else
         {
        $sms_alert="";     
         }
        
         $school_name=  mysql_real_escape_string($_POST['school_name']);
         $school_address=  mysql_real_escape_string($_POST['school_address']);
    
       if((!empty($receipt_format))&&(!empty($payslip_format))&&(!empty($print_copy))&&(!empty($school_name))
               &&(!empty($school_address)))  
       {
        $filename=$_FILES["school_logo"]['name'];
        $tmpfilename=$_FILES["school_logo"]['tmp_name'];
        $filesize=$_FILES["school_logo"]['size'];
        if(!empty($filename))
        {
        if(($filesize<102400))
         {
        $imagesize=getimagesize($tmpfilename);
        if ((!empty($imagesize))) 
            {
        
            date_default_timezone_set('Asia/Calcutta'); 
            $time = mktime();
            $random = rand(1000, 5000);
            $location="images/school_logo/". $random . $time . $filename;
            $templocation="images/school_logo/". $random . $time;
            $upload=move_uploaded_file($tmpfilename,"../".$location);
           if(($upload))
           {   
             $location=$location;   
      }else
      {
      $location=$_POST['temp_school_logo'];
      }
      }else 
      {
        $location=$_POST['temp_school_logo'];  
      }
      }else 
      {
        $location=$_POST['temp_school_logo'];  
      }
        }else
        {
        $location=$_POST['temp_school_logo'];    
        } 
          if(empty($update_db_id))
          {
        
          
              
        $insert_db=mysql_query("INSERT into finance_setting values('','$fetch_school_id',
                                 '$fetch_branch_id','$receipt_prefix','$pay_slip_prefix'"
                . ",'$receipt_format','$payslip_format','$print_copy','$sms_alert'"
                . ",'$location','$school_name','$school_address','none','$date','$date_time','')");   
        
          }else
          {
         $insert_db=mysql_query("UPDATE finance_setting SET receipt_prefix='$receipt_prefix',pay_slip_prefix='$pay_slip_prefix',"
                 . "receipt_format='$receipt_format',pay_slip_format='$payslip_format',no_copy='$print_copy',sms_alert='$sms_alert',school_logo='$location',"
                 . "school_name='$school_name',address_contact_us='$school_address',last_update_date='$date_time' WHERE id='$update_db_id' and is_delete='none'");     
          }
        
         if($insert_db)
         {
          $message_show= '<div id="error-msg">Record save successfully complete.</div>';   
         }else
         {
         $message_show= '<div id="error-msg">Request failed,please try again</div>';    
         }
           
           
       }else
       {
       $message_show='<div id="error-msg" style="width:70%; margin:auto;">Please fill all fields.</div>';   
       }
     
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Account Setting</title>
       <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
       <link href="stylesheet/fee_pay_css.css" rel="stylesheet" type="text/css" media="all">
        
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
    .add_button_reset_button{ width:70px; height:35px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px; text-align:center;  
                             float:right; cursor:pointer;   }
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
                          
                            
                            <?php
                            $account_setting_db=mysql_query("SELECT * FROM finance_setting WHERE "
                                    . "$db_main_details_whout_session is_delete='none'");
                            $account_data=mysql_fetch_array($account_setting_db);
                            $account_num_rows=mysql_num_rows($account_setting_db);
                            if((!empty($account_data))&&($account_data!=null)&&($account_num_rows!=0))
                            {
                             $account_setting_id=$account_data['id'];   
                             $recipt_prefix=$account_data['receipt_prefix'];
                             $pay_slip_prefix=$account_data['pay_slip_prefix'];
                                     $recipt_format=$account_data['receipt_format'];
                                     $pay_slip_format=$account_data['pay_slip_format'];
                                     $print_copy=$account_data['no_copy'];
                                     $sms_alert=$account_data['sms_alert'];
                                     $school_logo=$account_data['school_logo'];
                                     $school_name=$account_data['school_name'];
                                     $school_address=$account_data['address_contact_us'];
                                     if($sms_alert=="yes")
                                     {
                                        $sms_check="checked"; 
                                     }else
                                     {
                                      $sms_check="";   
                                     }
                                     
                                     if($recipt_format=="a4")
                                     {
                                     $a4_c="checked";    
                                     $a5_c="";    
                                     $a6_c="";    
                                     }else
                                         if($recipt_format=="a5")
                                     {
                                     $a4_c="";    
                                     $a5_c="checked";    
                                     $a6_c="";    
                                     }else
                                         if($recipt_format=="a6")
                                     {
                                     $a4_c="";    
                                     $a5_c="";    
                                     $a6_c="checked";    
                                     }else
                                     {
                                     $a4_c="";    
                                     $a5_c="";    
                                     $a6_c="";   
                                     }
                                     
                                     
                                      if($pay_slip_format=="a4")
                                     {
                                     $p_a4_c="checked";    
                                     $p_a5_c="";    
                                     $p_a6_c="";    
                                     }else
                                         if($pay_slip_format=="a5")
                                     {
                                     $p_a4_c="";    
                                     $p_a5_c="checked";    
                                     $p_a6_c="";    
                                     }else
                                         if($pay_slip_format=="a6")
                                     {
                                     $p_a4_c="";    
                                     $p_a5_c="";    
                                     $p_a6_c="checked";    
                                     }else
                                     {
                                     $p_a4_c="";    
                                     $p_a5_c="";    
                                     $p_a6_c="";   
                                     }
                                     
                                     
                                     
                                     
                            }else
                            {
                                $account_setting_id="";
                                     $recipt_prefix="";
                                     $pay_slip_prefix="";
                                     $recipt_format="a4";
                                     $pay_slip_format="a4";
                                     $print_copy="1";
                                     $sms_alert="1";
                                     $school_logo="";
                                     $school_name="";
                                     $school_address=""; 
                                      $sms_check=""; 
                                      
                                       $a4_c="checked";    
                                     $a5_c="";    
                                     $a6_c="";   
                                     
                                      $p_a4_c="checked";    
                                     $p_a5_c="";    
                                     $p_a6_c=""; 
                            }
                            
                            ?>
                            
                            <input type="hidden" name="update_db_id" value="<?php echo $account_setting_id;?>">
                            <input type="hidden" name="temp_school_logo" value="<?php echo $school_logo;?>">
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="7" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                    Account Setting
                                   
                                    </td>
                                </tr>
                                
                                <tr>
                                    
                                    <td colspan="7">
                                     <?php  echo "";?> 
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7">
                                        
                                        
                                    <table cellspacing='0' cellpadding='4' style=" width:auto; margin:auto;  ">
                                        <tr>
                                            <td colspan="4">
                                                <?php
                                echo $message_show;
                                                ?>
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
                                        <td style=" height:20px; "></td>
                                    </tr>
                                    <tr>
                                        <td class="td_leftpadding"><b>Fee Receipt Prefix </b></td>
                                    <td><b>:</b></td>
                                     <td>
                                        <input type="text" placeholder="Enter receipt prefix" name="receipt_prefix"
                                               id="receipt_prefix" value="<?php echo $recipt_prefix;?>" class="textsize_same">
                                    </td> 
                                    </tr>
                                     <tr>
                                         <td class="td_leftpadding"><b>Pay Slip Prefix</b></td>
                                    <td><b>:</b></td>
                                     <td>
                                        <input type="text" placeholder="Enter pay slip prefix" 
                                               name="pay_slip_prefix" value="<?php echo $pay_slip_prefix;?>" id="pay_slip_prefix" class="textsize_same">
                                    </td> 
                                    </tr>
                                    <tr>
                                    
                                     <tr>
                                         <td class="td_leftpadding"><b>Fee Receipt Format <sup>*</sup></b></td>
                                    <td><b>:</b></td>
                                    <td> 
                                        
                                        <table style=" font-weight:bold; ">
                                            <tr>
                                                <td><input type="radio" value="a4"
                                                           class="check_box_style" name="print_format" <?php echo $a4_c;?>></td><td>A4</td>
                                                 <td><input type="radio" value="a5"
                                                           class="check_box_style" name="print_format" <?php echo $a5_c;?>></td><td>A5</td>
                                                  <td><input type="radio" value="a6"
                                                           class="check_box_style" name="print_format" <?php echo $a6_c;?>></td><td>A6</td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                         <td class="td_leftpadding"><b>Pay Slip Format <sup>*</sup></b></td>
                                    <td><b>:</b></td>
                                    <td> 
                                        
                                        <table style=" font-weight:bold; ">
                                            <tr>
                                                <td><input type="radio" value="a4"
                                                           class="check_box_style" name="slip_print_format" <?php echo $p_a4_c;?>></td><td>A4</td>
                                                 <td><input type="radio" value="a5"
                                                           class="check_box_style" name="slip_print_format" <?php echo $p_a5_c;?>></td><td>A5</td>
                                                  <td><input type="radio" value="a6"
                                                           class="check_box_style" name="slip_print_format" <?php echo $p_a6_c?>></td><td>A6</td>
                                            </tr>
                                        </table>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="td_leftpadding"><b>Print no. of Copy <sup>*</sup></b></td>
                                    <td><b>:</b></td>
                                    <td>   <input type="text" onkeypress="javascript:return isNumber (event)" name="print_copy" id="print_copy"
                                                  class="textsize_same" value="<?php echo $print_copy;?>" style=" width:60px; text-align:center;  ">
                              </td>
                                    <style>
                                        .text_area{ width:350px; height:50px;  }
                                        </style>
                                    </tr>
                                     <tr>
                                        <td class="td_leftpadding"><b>SMS Alert</b></td>
                                    <td><b>:</b></td>
                                    <td><input type="checkbox" value="yes"
                                               class="check_box_style" name="sms_alert" <?php echo $sms_check;?>>
                              </td>
                                    </tr>
                                    <tr>
                                        <td style=" height:30px; "></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" style=" background-color:whitesmoke; height:25px; padding-left:5%;font-weight:bold;    ">Receipt Header</td>
                                    </tr>
                                     <tr>
                                         <td class="td_leftpadding"><b>School Logo</b></td>
                                    <td><b>:</b></td>
                                    <td><input type="file" name="school_logo"> 
                                    <?php
                                    if((!empty($school_logo))&&(is_file("../".$school_logo)))
                                    {
                                    {
                                     ?>
                                        <a style="color:blue;" href="#" onclick="window.open('<?php echo "../".$school_logo;?>','size',config='height=400,width=400,position=absolute,left=200,top=200, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                                            <span style=" color:blue; text-decoration:underline;  ">View</span> </a>  
                                        <?php
                                    }      
                                    }
                                    ?>
                                    
                                    </td>
                                    </tr>
                                    <tr>
                                         <td class="td_leftpadding"><b>School <sup>*</sup></b></td>
                                    <td><b>:</b></td>
                                    <td> <textarea placeholder="Enter school name"  name="school_name" id="school_name" 
                                                   class="text_area"  style=" height:35px; "><?php echo $school_name;?></textarea></td>
                                    </tr>
                                    <tr>
                                    <td class="td_leftpadding">
                                        <b>Address & Contact us <sup>*</sup></b>  
                                    </td>
                                    <td><strong>:</strong> </td>
                                    <td>
                                  
                                 <textarea placeholder="Enter address & contact us"  name="school_address" id="school_address" 
                                           class="text_area"><?php echo $school_address;?></textarea>
                                  </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <?php
                                        if(empty($account_setting_id))
                                        {
                                        ?>
                                        <input type="submit" value="Save" name="addfeedetails" 
                                           id="addfeesname"    class="add_button_reset_button">
                                      <?php
                                        }  else {
                                         
                                      ?>
                                        <input type="submit" value="Update" name="addfeedetails" 
                                           id="addfeesname"    class="add_button_reset_button"> 
                                        <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                </table>
                                        
                                        
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