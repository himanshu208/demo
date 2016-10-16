<?php
//SESSION CONFIGURATION
$check_array_in="account";
require_once '../config/edit_page_configuration.php';
if($connection_permission==1)
{
?>

<?php 
$message_show="";
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
                       $final_fee_id=$_POST['fee_id'];
                            
                            
                            
                        $feedescription=$_POST['feedescription'];
                        if((!empty($feename))&&(!empty($final_fee_id))&&(!empty($activeHandT))&&(!empty($session_id))&&(!empty($fetch_branch_id))&&(!empty($fetch_school_id)))
                        {
                       $matchsamevalue=mysql_query("SELECT * FROM financeaddfee WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id' and fee_id!='$final_fee_id' and fee_name='$feename' and action='active'"); 
                        $matchvalue= mysql_fetch_array($matchsamevalue);
                        if(empty($matchvalue))
                        {  
                         $update_fee_db=  mysql_query("UPDATE financeaddfee SET fee_name='$feename',feedescription='$feedescription'  WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$session_id'"
                                 . "and fee_id='$final_fee_id' and action='active'");
                         
                         if($update_fee_db)
                         {
                           $message_show= '<div id="error-msg">Record update successfully complete.</div>';
                         }else $message_show= '<div id="error-msg">Request failed,please try again</div>';
                        }else  $message_show='<div id="error-msg">Record already exist in database.</div>';
                        }else $message_show='<div id="error-msg">Please fill all fields.</div>';
                      }


?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
        <title>Edit Fee Details</title>
      
        <script type="text/javascript">
              function validateForm()
              {
               var fee_name=document.getElementById("add_feename").value; 
               if(fee_name==0)
               {
                  alert("Please enter fee name");
                  document.getElementById("add_feename").focus();
                  return false;
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
    <body style="margin: 0; padding:0; ">
         <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
          <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
          
      <?php  include_once 'edit_header_page.php';?>
               
                          <input type="hidden" name="use_inset_session_id" id="insert_session_id"
               value="<?php  echo $fecth_session_id_set;?>">  
           
        <div class="first_work_div">
            <div class="edit_title_heading">Edit Fee Group Details</div>
            
            <table  cellspacing="2" cellpadding="2" id="edit_value_table" style=" width:570px; ">
                                
                             <?php 
                               
                               if((!empty($_REQUEST['token_id'])))
                               {
                                 $encrypt_id=$_REQUEST['token_id'];
                                 $fee_db=mysql_query("SELECT * FROM financeaddfee WHERE $db_main_details encrypt_id='$encrypt_id' and action='active'");
                                 $fetch_fee_data=  mysql_fetch_array($fee_db);
                                 $fetch_fee_num_rows=  mysql_num_rows($fee_db);
                                 if((!empty($fetch_fee_data))&&($fetch_fee_data!=null)&&($fetch_fee_num_rows!=0))
                                 {
                                 $fetch_fee_name=$fetch_fee_data['fee_name'];
                                 $fetch_fee_description=$fetch_fee_data['feedescription'];
                                 $fetch_fee_id=$fetch_fee_data['fee_id'];
                                 $fetch_fee_type=$fetch_fee_data['hostelandtransportstatus'];
                                 {
                               ?>
                <tr>
                                    
                                    <td colspan="7">
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
                                    <td class="td_leftpadding">
                                        <input type="hidden" name="fee_id" value="<?php  echo $fetch_fee_id;?>">
                                        
                                        <b>Fee Group<sup style=" color:red; ">*</sup></b> 
                                    </td>
                                    <td><strong>:</strong></td>
                                    <td style=" width:145px; " >
                                        
                                      <?php  
                                        if($fetch_fee_type=="active")
                                        {
                                            echo '<input readonly="readonly"  type="text" placeholder="Enter fee name" name="addfeename"
                                               id="add_feename" class="textsize_same" value="'.$fetch_fee_name.'" style="background-color:whitesmoke;">';    
                                        }else
                                        {
                                            echo '<input type="text" placeholder="Enter fee name" value="'.$fetch_fee_name.'" name="addfeename"
                                               id="add_feename" class="textsize_same">';  
                                        }
                                        
                                        ?>
                                        
                                        
                                    </td>
                                    <td style=" width:15px; padding-left:20px;  ">
                                        
                                      <?php 
                                       
                                        if(($fetch_fee_type=="active")&&($fetch_fee_name=="Hostel Fee"))
                                        {
                                        ?>
                                        <input type="checkbox" value="active" onclick="hostel_fee_check('Hostel Fee')"
                                               class="check_box_style" id="hostel_cheked" name="add_other_fee" checked disabled>
                                        
                                      <?php 
                                        }else
                                        {
                                        ?>
                                        
                                         <input type="checkbox" value="active" onclick="hostel_fee_check('Hostel Fee')"
                                                class="check_box_style" id="hostel_cheked" name="add_other_fee" disabled>
                                        
                                      <?php 
                                        }
                                        ?>
                                    </td>
                                    <td style=" width:80px; "><b>Hostel Fee</b></td>
                                    <td style=" width:15px; ">
                                        
                                       <?php 
                                       
                                        if(($fetch_fee_type=="active")&&($fetch_fee_name=="Transport Fee"))
                                        {
                                        ?>
                                        
                                        <input checked type="checkbox" class="check_box_style" id="transport_checked"
                                                                     value="active" onclick="transport_fee_check('Transport Fee')" name="add_transport_other_fee" disabled>
                                     
                                      <?php 
                                        }else
                                        {
                                        ?>
                                        
                                         <input type="checkbox" class="check_box_style" id="transport_checked"
                                                                     value="active" onclick="transport_fee_check('Transport Fee')" name="add_transport_other_fee" disabled>
                                     
                                       
                                       <?php 
                                        }
                                        ?>
                                    </td><td><b>Transport Fee</b></td>
                                </tr> 
                                 <tr>
                                    <td class="td_leftpadding">
                                        <b>Fee Description</b>  
                                    </td>
                                    <td><strong>:</strong> </td>
                                    <td>
                                  
                                 <textarea placeholder="Enter description"  name="feedescription" id="add_feedescription" 
                                           class="text_area"><?php  echo $fetch_fee_description;?></textarea>
                                 
                                 
                                 
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
                                 }else
                                 {
                                     echo "<div class='record_no_found'>Record no found !!</div>";    
                                 }
                               }else
                                 {
                                     echo "<div class='record_no_found'>Record no found !!</div>";    
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