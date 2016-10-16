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
        <title>View Fee Group Details</title>
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
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&fee_group_tr_name="+delete_tr_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
        </script>
    </head>
    <style>
         #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  padding-bottom:10px; 
                              font-family:arial; font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{width:1150px; height:auto; margin:0 auto;    }
    #table_midle_set{ width:100%; height:auto; margin:0 auto; margin-top:5px;       }
    .td_leftpadding{ padding-left:10px; padding-top:5px;   }
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
    .td_under_line{ width:100%; height:auto; border-bottom:1px solid silver; padding-top:8px; padding-bottom:8px;     }
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
                    <td>
                        
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
                                    <td colspan="11" class="td_leftpadding" 
                                        style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                        <strong>List Of Fee</strong>   
  <a href="financeaddgroup_fee.php" border="0" style=" text-decoration:none; ">
      <abbr title="Add New Fee Group Deatil">
                                    <div id="top_add_view_div">
                                        <strong>Add Fee Group Details </strong>
                                    </div>
  </abbr>
                                    </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class='td_border_color' id="tdleft">
                                    <strong>Sl.No</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Fee Group</strong>
                                    </td>
                                     <td class='td_border_color'>
                                    <strong>Fee Type</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Fee Name</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Fee Alias</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Annual/Month/Term</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Fee Collect Start Date</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Fee Collect Due Date</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>No Of Due Days</strong>
                                    </td>
                                    <td class='td_border_color'>
                                   <strong>Action</strong>
                                    </td>
                                    
                                    
                                </tr>
                             <?php 
                        require_once '../connection.php';
                        $row=0;
date_default_timezone_set('Asia/Calcutta'); 
$timezone=5.5;
$localtime=$timezone*3600;
$today_dates=date("Y-m-d");
$due_amount_pay_month=date("M");

function dmyTime($dt)
{
    list ($d, $m, $y) = explode ('-', $dt);
    return strtotime("$y-$m-$d");
}
                        $feefinancedatabase=mysql_query("SELECT *,T1.encrypt_id as t1_encrypt_id FROM financeaddfeegroup as T1 "
                                . " LEFT JOIN financeaddfee as T2 ON T1.fee_id=T2.fee_id WHERE $db_t1_main_details T1.action='active' ORDER BY T1.id ASC");
                        $feenamematch="0";
                        while ($fetchthisvalue=mysql_fetch_array($feefinancedatabase))
                        {
                            $fetchdataid=$fetchthisvalue['id'];
                            $fee_group_id=$fetchthisvalue['fee_group_id'];
                            $encrypt_id=$fetchthisvalue['t1_encrypt_id'];
                            $fetchfeename=$fetchthisvalue['fee_id'];
                            $fetch_fee_name=$fetchthisvalue['fee_name'];  
                            
                            
                            $feegrouptype=ucfirst($fetchthisvalue['feegrouptype']);
                            $feedesciption=ucfirst($fetchthisvalue['feegroupname']);
                            $feegroupalias=ucfirst($fetchthisvalue['feegroupalias']);
                           
                            $row++;
                        
                        echo "<tr id='delete_row_$fetchdataid'>
                            <td class='td_viewvalue' id='tdleft'>$row</td>
                            <td class='td_viewvalue'>$fetch_fee_name</td>
                            <td class='td_viewvalue'>$feegrouptype</td>
                            <td class='td_viewvalue'>$feedesciption</td>
                            <td class='td_viewvalue'>$feegroupalias</td>
                            <td class='td_viewvalue' style='border-bottom:0px;'>";
                         $month_array=array();
                         $month_start_date=array();
                         $month_due_date=array();
                         $month_date_diff=array();
                        $fee_set_date_db=mysql_query("SELECT * FROM finance_fee_set_date_db WHERE fee_group_id='$fee_group_id'"
                                . " and is_delete='none'");
                        while ($fee_set_data=mysql_fetch_array($fee_set_date_db))
                        {
                        $month=$fee_set_data['monthlyofmonth'];
                        $fee_start_date=$fee_set_data['collectfeestartdate'];
                        $fee_due_date=$fee_set_data['collectfeeduedate']; 
                        $date_diff=$fee_start_date."@@".$fee_due_date;
                        
                        array_push($month_array,$month);
                        array_push($month_start_date,$fee_start_date);
                        array_push($month_due_date,$fee_due_date);
                        array_push($month_date_diff,$date_diff);
                        }
                        
                        foreach ($month_array as $month_name)
                        {
                        if($month_name=="yearly")
                        {
                           $month_name="Annual"; 
                        }
                        
                        
                            
                        echo "<div class='td_under_line'>".ucwords($month_name)."</div>";  
                        }
                          echo"</td>
                            <td class='td_viewvalue' style='border-bottom:0px;'>";
                       foreach ($month_start_date as $month_start_date)
                        {
                         echo "<div class='td_under_line'>$month_start_date</div>";
                        }
                           echo"</td>  
                                <td class='td_viewvalue' style='border-bottom:0px;'>";
                        foreach ($month_due_date as $month_due_date)
                        {
                          echo "<div class='td_under_line'>$month_due_date</div>";
                        }
                        echo"</td>
                            
                              <td class='td_viewvalue' style='border-bottom:0px;'>";
                        foreach ($month_date_diff as $month_diff)
                        {
                         $explode_date_diff=explode("@@",$month_diff);   
                           $start_date=$explode_date_diff[0];
                           $due_date=$explode_date_diff[1];      
                           $days=floor((dmyTime($today_dates)-dmyTime($due_date))/86400); 
                            
                           if($days>0)
                           {
                            $print_days="<b style='color:red;'>$days days</b>";   
                           }else
                           {
                              $print_days="<b style='color:green;'>".abs($days)." days left</b>";  
                           }
                           
                            echo "<div class='td_under_line'>$print_days</div>";
                       
                        }
                        
                        echo"</td>
                            <td class='td_viewvalue' style='width:132px;'>
                            
                             <abbr title='Edit'>";
                        {
                        ?>
                                <a style="color:blue;" href="#" onclick="window.open('edit_fee_group_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=650,width=1020,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        
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
                            
</tr>                            
";
                        
                        }
                        
                        if(empty($fetchfeename))
                        {
                        echo "
<tr>
<td colspan='10' class='td_viewvalue' id='tdleft'>
<strong style='color:red;'>No Available Record</strong>
</td>
</tr>
";
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