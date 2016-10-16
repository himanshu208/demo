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
         <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
       <script type="text/javascript">
            function remove_record(delete_tr_name)
            {
var organization_id=document.getElementById("organization_id").value;
   var branch_id=document.getElementById("branch_id").value;
   var session_id=document.getElementById("insert_session_id").value;
    if((organization_id==0)||(branch_id==0)||(session_id==0)||delete_tr_name==0)
   {
      alert("Please fill all fields.")
      return false;
   }else
   {

var r=confirm("Are you sure you want to delete a record");
if (r==true)
  { 
   
   var httpxml;

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
   document.getElementById("ajax_loader_show").style.display="none";
   if(httpxml.responseText==1)
   {
   document.getElementById("delete_row_"+delete_tr_name).style.display="none";
   alert("Record delete successfully complete");
   
   }else
   {
     alert("Sorry,Request failed,Please try again later");
         return false;  
   }
   
     }else
     {
         alert("Sorry,Request failed,Please try again later");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="delete_ajax_code.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&fee_amount_id="+delete_tr_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
        </script>
        <title>Fee Amount Details</title>
    </head>
    <style>
         #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  padding-bottom:10px; 
                              font-family:arial; font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{width:1150px; height:auto; margin:0 auto;    }
    #table_midle_set{ width:100%; height:auto; margin:0 auto; margin-top:5px;       }
    .td_leftpadding{ padding-left:10px; padding-top: 6px;  }
    .textsize_same{ border:1px solid gray; margin-left:5px; }
    .add_button_reset_button{ width:60px; height:23px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke;  
                             background-image:url('finanacephoto/bgblack.png');  }
    .td_border_color{ border-bottom:1px solid silver; width:auto;  height:30px; margin:0; padding: 0; 
                     border-right:1px solid silver; background-color:#F8F8F8 ; text-align:center;
                     border-top:1px solid gray;    }
    #tdleft{ border-left:1px solid silver;}
    #top_add_view_div{ width:140px; height:18px; padding-top:6px; padding-left:10px;
                       padding-right:10px; margin-top:-4px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:4px; color:black; text-align:center;      }
    .td_viewvalue{ border-bottom:1px solid silver; width:auto;  height:30px; margin:0; padding: 0; 
                     border-right:1px solid silver; text-align:center;    }
    #both_add_div{ width:45px; height: 22px; margin:0 auto;   }
    .editfee { width:18px; float:left; font-size: 0px;  height:18px; background-image:url('finanacephoto/edit.png');  }
    .deletefee{ width:18px; height:18px; float:right; font-size: 0px;  background-image:url('finanacephoto/delete.png'); }
    .editfee:hover{ cursor:pointer; }
    .deletefee{ cursor:pointer; }
    </style>
    
    <body style=" margin: 0;padding: 0;">
         
      <?php 
      include_once '../ajax_loader_page_second.php';
      ?>  
        
         <div id="financefirstdiv">
              <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
            <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
            
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td >
                        
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
                            <div class="fliter_div_top"></div>
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="9" class="td_leftpadding" 
                                        style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                        <strong>View Fee Amount Details</strong>   
  <a href="financeaddamount_fee.php" border="0" style=" text-decoration:none; ">
      <abbr title="Add New Fee Group Deatil">
                                    <div id="top_add_view_div">
                                        <strong>Add Fee Amount Details </strong>
                                    </div>
  </abbr>
                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='td_border_color' id="tdleft">
                                      <strong>  Sl.No</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Fee Group</strong>
                                    </td>
                                     <td class='td_border_color'>
                                    <strong>Fee Type</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Fee </strong>
                                    </td>
                                     <td class='td_border_color'>
                                    <strong>Student Name</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Course/Class</strong>
                                    </td>
                                     <td class='td_border_color'>
                                    <strong>Fine</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Fee Amount</strong>
                                    </td>
                                    <td class='td_border_color'>
                                   <strong>Action</strong>
                                    </td>
                                    
                                    
                                </tr>
                           <?php 
                             $row=0;
 $fee_amount_db=mysql_query("SELECT *,T1.id as t1_id,T1.encrypt_id as t1_encrypt_id FROM financefeeamount as T1"
         . " LEFT JOIN financeaddfee as T2 ON T1.fee_id=T2.fee_id "
         . " LEFT JOIN financeaddfeegroup as T3 ON T1.fee_group_id=T3.fee_group_id"
         . " LEFT JOIN course_db as T4 ON T1.course_id=T4.course_id WHERE $db_t1_main_details T1.action='active'"); 
 while ($fetch_fee_amount_data=mysql_fetch_array($fee_amount_db))
 {
     $fetchdataid=$fetch_fee_amount_data['t1_id'];
     $fetch_fee_id=$fetch_fee_amount_data['fee_id'];
     $encrypt_id=$fetch_fee_amount_data['t1_encrypt_id'];
     $fetch_fee_group_id=$fetch_fee_amount_data['fee_group_id'];
     $fetch_fee_amount_id=$fetch_fee_amount_data['fee_amount_id'];
     $fetch_course_id=$fetch_fee_amount_data['course_id'];
     $fee_group_type=ucfirst($fetch_fee_amount_data['feegrouptype']);
     $fetch_fine_amount=$fetch_fee_amount_data['fineamount'];
     $fetch_fee_amount=$fetch_fee_amount_data['feesamount'];
     $fetch_fee_assign=$fetch_fee_amount_data['fee_assign_to'];
     $fees_group_name=ucwords($fetch_fee_amount_data['feegroupname']);
     $fetch_fee_name=$fetch_fee_amount_data['fee_name'];
     $student_id=$fetch_fee_amount_data['student_id'];
     $course_name=$fetch_fee_amount_data['course_name'];
     $fine_option=$fetch_fee_amount_data['fine_option'];
     
     
     $student_db=mysql_query("SELECT *,T1.encrypt_id as student_encrypt_id FROM student_db as T1 "
             . " LEFT JOIN student_personal_db as T2 ON T1.student_personal_id=T2.student_unqiue_id WHERE T1.student_id='$student_id'");
     $student_data=mysql_fetch_array($student_db);
     $student_num_rows=mysql_num_rows($student_db);
     if((!empty($student_data))&&($student_data!=null)&&($student_num_rows!=0))
     {
      $student_name=$student_data['student_full_name'];  
      $student_encrypt_id=$student_data['student_encrypt_id'];;
     }else
     {
     $student_name="";  
     $student_encrypt_id="";
     }
     
     
     if($fine_option=="per_day")
     {
        $fine_option="(Per Day)"; 
     }else
     {
     $fine_option="(One Time)";    
     }
     
     
     
     $row++;
    
     echo "<tr id='delete_row_$fetchdataid'>
       <td class='td_viewvalue' id='tdleft'>$row</td> 
       <td class='td_viewvalue'>$fetch_fee_name</td>
        <td class='td_viewvalue'>$fee_group_type</td>
       <td class='td_viewvalue'>$fees_group_name</td>
       <td class='td_viewvalue'>"; 
     {
      ?>
                                <a href="#" onclick="window.open('../search/student_full_details.php?token_id=<?php echo $student_encrypt_id;?>','size',config='height=670,width=1200,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">
        <b style=" color:blue; ">  <?php echo  $student_name ;?>    </b>  </a>                            
    
       <?php
     }
             echo"</td>
     
         <td class='td_viewvalue'>$course_name</td>
         <td class='td_viewvalue'><b style='color:red; font-size:11px;'>$fetch_currency</b> $fetch_fine_amount $fine_option</td>
       <td class='td_viewvalue' ><b style='color:red; font-size:11px;'>$fetch_currency</b> $fetch_fee_amount</td>
        <td class='td_viewvalue' style='width:132px;'>
                            
                             <abbr title='Edit'>";
                        {
                        ?>
                                <a style="color:blue;" href="#" onclick="window.open('edit_fee_amount.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=650,width=1020,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        
                            <div class='edit_delete_buttons' style='background-color:green; width:45px;'>Edit</div></a>
                      <?php 
                        }
                           echo "</abbr>
                            <abbr title='Delete'>";
                        {
                        ?>
                            <div onclick="remove_record('<?php  echo $fetchdataid;?>')" class='edit_delete_button'>Delete</div>
                         <?php 
                        }
                           echo " </abbr>
        
</td>
</tr>";
     
     
 }
                             
                             ?>
                                <tr>
                                    <td>
                                        </br>   
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