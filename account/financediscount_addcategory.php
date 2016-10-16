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
                      if(!empty($_POST['addfeedetails']))
                      {
                        $insert_course_id=$_POST['insert_class_id'];
                        $fee_group_id=$_POST['all_fee_group_id'];
                        $implode_fee_group_id=implode(",", $fee_group_id);
                        
                        
                        
                        $feecategoryname=$_POST['nameofcategory'];
                        $discount_type=$_POST['discount_type'];
                        $feediscount=$_POST['nameofdiscount'];
                        $insert_session_id=$_POST['use_inset_session_id'];
                        $feediscountdesciption=ucfirst(nl2br($_POST['description']));
                        if((!empty($insert_course_id))&&(!empty($implode_fee_group_id))
                                &&(!empty($feecategoryname))&&(!empty($discount_type))&&(!empty($feediscount))&&(!empty($insert_session_id)))
                        {
                       
                        $explose_fee_group_id=explode(",",$implode_fee_group_id);    
                        foreach($explose_fee_group_id as $insert_fee_group_id)    
                        {
                      
 $static_id="DISCTCATG";    
 $add_one_no=1;   
 $discount_cat_org_db=mysql_query("SELECT * FROM financefeediscountcategory WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' ORDER BY id DESC");
 $fetch_discount_cat_org_record=mysql_fetch_array($discount_cat_org_db);
 $fetch_discount_cat_num_rows=mysql_num_rows($discount_cat_org_db);
  if((!empty($fetch_discount_cat_org_record))&&($fetch_discount_cat_org_record!=null)&&($fetch_discount_cat_num_rows!=0))
  {
   $fetch_id=$fetch_discount_cat_org_record['id'];
   $add_both_values=$fetch_id+$add_one_no;
   $final_discount_cat_id=$static_id."_".$add_both_values;   
  }else
  {
   $final_discount_cat_id=$static_id."_".$add_one_no;   
  }      
  $encrypt_id=md5(md5($final_discount_cat_id));
                            
                          $select_value_match_category=mysql_query("SELECT * FROM financefeediscountcategory WHERE organization_id='$fetch_school_id'
                          and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and discount_category_id='$final_discount_cat_id'
                              OR organization_id='$fetch_school_id'
                          and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and course_id='$insert_course_id'
                              and fee_group_id='$insert_fee_group_id' and category_id='$feecategoryname'");
                       $checkthisvalue=mysql_fetch_array($select_value_match_category);
                       $check_value_num_rows=mysql_num_rows($select_value_match_category);
                       if((empty($checkthisvalue))&&($checkthisvalue==null)&&($check_value_num_rows==0))
                        {
                     
                        
                         $insertvalue=mysql_query("INSERT into financefeediscountcategory values('','$fetch_school_id'
                                 ,'$fetch_branch_id','$insert_session_id','$final_discount_cat_id','$encrypt_id','$insert_course_id','$insert_fee_group_id'
                                 ,'$feecategoryname','$discount_type','$feediscount','$feediscountdesciption',
                                 '$date','$date_time','$user_unique_id','active')");
                         if($insertvalue)
                         {
                              $message_show='<div id="error-msg">Record save successfully complete.</div>';
                         }else  $message_show='<div id="error-msg">Request failed,please try again.</div>';
                      
                        
                        
                          }else  $message_show='<div id="error-msg">Record already exist in database.</div>';
                        }
                        }else  $message_show='<div id="error-msg">Please fill all fields.</div>';
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
 function validateForm(frm)
{
 
 var class_id=document.getElementById("category_clsss_id").value;
 var category_name=document.getElementById("categoryname").value;
 var discount_type=document.getElementById("discount_type").value;
 var discount=document.getElementById("discount").value;
 
 if(frm.elements['all_fee_group_id[]'])
     {
      var destCount=frm.elements['all_fee_group_id[]'].length;
var destSel   = false;
for(i = 0; i < destCount; i++){
if(frm.elements['all_fee_group_id[]'][i].checked){
destSel = true;
break;
}
}   
     }else
         {
         var destSel   = false;    
         }
if(class_id==0)
    {
     alert("Please select class");
     document.getElementById("category_clsss_id").focus();
     return false;
    }else
 if(!destSel){
alert('Please select atleast one fee group');
return false;
}else
   if(category_name==0)
    {
     alert("Please select category");
     document.getElementById("categoryname").focus();
     return false;
    } else
        if(discount_type==0)
    {
     alert("Please select discount type");
     document.getElementById("discount_type").focus();
     return false;
    }else
        if(discount==0)
    {
     alert("Please enter discount");
     document.getElementById("discount").focus();
     return false;
    }else
        if(isNaN(discount))
    {
     alert("Please enter only numeric value");
     document.getElementById("discount").focus();
     return false;
    }
        
     
}    
    </script>
    
    
    <script type="text/javascript">
    function check_all()
{
    var all_check_id=document.getElementById("select_all_fee").checked;
    if(all_check_id==true)
        {
var destCount = document.myForm.elements['all_fee_group_id[]'].length;
for(i = 0; i < destCount; i++){
document.myForm.elements['all_fee_group_id[]'][i].checked=true;
}
        }else
            {
             var destCount = document.myForm.elements['all_fee_group_id[]'].length;
for(i = 0; i < destCount; i++){
document.myForm.elements['all_fee_group_id[]'][i].checked=false;
}
            }
    
}    
    </script>
    
    
    
    <script type="text/javascript">
    function class_id_change(class_id)
    {
      if(class_id==0)
          {
             
            window.location.assign("financediscount_addcategory.php");     
            return false;    
          }else
              {
              window.location.assign("financediscount_addcategory.php?class_encrypt_id="+class_id);     
                                       
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
    .td_leftpaddingth{ padding-left:10px; padding-top: 5px;}
    #top_add_view_div{ width:190px; height:18px; padding-top:7px; padding-left:10px;
                       padding-right:10px; margin-top:-6px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:3px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; margin-left:5px;  height:25px; }
    .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;
    margin-top:10px; margin-bottom:10px;  }
    #error-msg{ width:600px; height:20px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; margin:0 auto; font-weight:100; padding-top:8px;    color:#380000; text-align: center;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    #table_midle_settable{ width:100%; height:50px;  }
    .selectsize_same{ width:185px; height:23px;  }
    .text_sizebox{ width:215px; border:1px solid silver;  height: 20px; padding-left:3px;  }
    #ajax_loader_show{ display:none; }
    .select_box{ width:220px; height:24px;  }
    .feegroup_list{ width:auto; height:auto; padding-top:6px;  float:left; padding-left:10px;    }
    .select_all{ width:auto; height:auto;  padding-left:10px;border-bottom:1px solid skyblue; font-weight:bold;    }
    .check_box_style{ width:15px; height:15px; cursor:pointer;   }
    </style>

    
    
    <body style=" margin: 0;padding: 0;">
        <?php 
include_once '../ajax_loader_page_second.php';
      ?>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>
         <div id="financefirstdiv">
              <form name="myForm" action="" onsubmit="return validateForm(this);" method="post" enctype="multipart/form-data">
           
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
                                    <td colspan="2" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                    Add/Edit Category Discount Details  
                                    
                                    <a href="financediscount_viewall.php?seecategorydiscount=1utggf_yyRRRty_bshb_qq" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Category Discount Detail">
                                    <div id="top_add_view_div">
                                        <strong> View Category Discount Details </strong>
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
                                      <legend><span style=" color: maroon;  ">Select Class/Course</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:110px; "></td>
                                              <td style=" text-align:right; padding-right:10px;  ">
                                                  <b>Course/Class <sup style=" color:red; ">*</sup></b></td>
                                              <td><strong>:</strong></td>
                                              <td>
                                                  <select name="insert_class_id" onchange="class_id_change(this.value)" id="category_clsss_id" class="select_box">
                                                      <option value="0">-- Select Course/Class --</option>
                                                  
                  <?php 
                   if(!empty($_REQUEST['class_encrypt_id']))
                   {
                    $get_class_id=$_REQUEST['class_encrypt_id'];   
                   }  else {
                      $get_class_id=""; 
                   }
             $select_class_db= mysql_query("SELECT * FROM course_db WHERE $db_main_details is_delete='none' ORDER BY course_position ASC");
             $fetchnumberofrow=  mysql_num_rows($select_class_db);
             $rowi=0;
             while($fetch= mysql_fetch_array($select_class_db)) {
                 $rowi++;
                 $fetchid=$fetch['id'];
                 $classname=$fetch['course_name'];
                 $fetch_course_id=$fetch['course_id'];
                 if($get_class_id==$fetch_course_id)
                 {
                 echo "<option id='$fetch_course_id' value='$fetch_course_id' selected>$classname</option>";
                 }  else {
                    echo "<option id='$fetch_course_id' value='$fetch_course_id' >$classname</option>";
                   
                 }
                 }
                 
                
                                   ?>  
                                                      </select>    
                                                  
                                              </td>
                                             
                                          </tr>
                                          
                                        
                                      </table></fieldset>
                                    </td>
                                </tr>
                                <tr>
                                     <td colspan="2" class="td_leftpadding">
                                         
                                         
                                         
                                     <?php 
                                       if(!empty($_REQUEST['class_encrypt_id']))
                                       {
                                         $class_unique_id=$_REQUEST['class_encrypt_id'];  
                                       {
                                       ?>  
                                         
                                        <input type='hidden' id='select_fee' value='1'> 
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Fee</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" height:20px; ">
                                                  <div style=" width:auto; height:auto; ">
<div class='select_all'><table><tr><td>
                <input id="select_all_fee" class="check_box_style" onClick="check_all()"  type='checkbox'></td><td>Select All</td></tr></table></div>
                                                <?php 
$fee_amount_db=  mysql_query("SELECT * FROM financefeeamount WHERE $db_main_details"
        . " fee_assign_to='class_fee_group' and course_id='$class_unique_id' and action='active'"); 
while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_db))
{
$fetch_fee_id=$fetch_fee_amount_data['fee_id'];
$fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];

$fee_group_data=mysql_query("SELECT * FROM financeaddfeegroup WHERE fee_group_id='$fetch_fee_group_id' and action='active'");
$fetch_fee_group_data=  mysql_fetch_array($fee_group_data);
$fetch_fee_group_num_rows=  mysql_num_rows($fee_group_data);

if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fetch_fee_group_num_rows!=0))
{
$fetch_fee_group_name=ucwords($fetch_fee_group_data['feegroupname']); 
$fetch_fee_group_id=$fetch_fee_group_data['fee_group_id']; 
echo "<div class='feegroup_list'><table><tr><td><input name='all_fee_group_id[]'  class='check_box_style' value='$fetch_fee_group_id' type='checkbox'></td><td>$fetch_fee_group_name</td></tr></table></div>";
    
    
}

}
                                                  
                                                  ?>
                                                  </div>
                                              </td>
                                          </tr>
                                          
                                          
                                         
                                      </table></fieldset>
                                         
                                         
                                       <?php 
                                       }
                                       }else
                                       {
                                           echo "<input type='hidden' id='select_fee' value='0'>";    
                                       }
                                         ?>
                                    </td>
                                </tr>
                                <tr>
                                     <td colspan="2" class="td_leftpadding">
                                          <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Category</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" width:190px; ">
                                                 
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Category</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                               <select id="categoryname" class="select_box" name="nameofcategory">
                                                   <option value="0">-- Select Category --</option>
                                              <?php 
              require_once '../connection.php';   
             $select_category_db=mysql_query("SELECT * FROM category_db WHERE $db_main_details_whout_session is_delete='none'");
             while ($fetch_category_data=  mysql_fetch_array($select_category_db))
             {
               $fetch_category_id=$fetch_category_data['category_id'];
               $fetch_category_name=$fetch_category_data['category_name'];
               echo "<option value='$fetch_category_id'>$fetch_category_name</option>";
             }
             ?> 
                                               </select>
                                              </td>
                                              
                                              
                                                                   
                                              
                                          </tr>
                                      </table></fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="td_leftpadding">
                                          <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Discount (%)</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable"
                                              style=" height:130px; ">
                                          <tr>
                                              <td width="100px;">
                                                  
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Discount Type</strong>
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <select id="discount_type" class="select_box"
                                                          name="discount_type">
                                                      <option value="percantage">%</option>
                                                      <option value="flat">Flat</option>
                                                  </select>
                                               
                                               </td>
                                          </tr>
                                          <tr>
                                              <td width="45px;">
                                                  
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Discount</strong>
                                                  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                               <input type="text" id="discount" maxlength="3"
                                                      class="text_sizebox" name="nameofdiscount" >
                                              </td>
                                          </tr>
                                          <tr>
                                              <td width="45px;">
                                                  
                                              </td>
                                              <td  class="td_leftpadding">
                                                  <strong>Description</strong>  
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                               <textarea id="textareasize" name="description" class="text_sizebox"
                                                         style=" height:60px;"></textarea>
                                              </td>
                                              
                                                                   
                                              
                                          </tr>
                                      </table></fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                         <input type="submit" value="Save" id="categorysavebutton" name="addfeedetails" 
                                                class="add_button_reset_button" style=" margin-right: 13px;">
                                        
                                         <input type="Reset" value="Reset" class="add_button_reset_button" style=" background-color:deeppink; ">
                                       
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