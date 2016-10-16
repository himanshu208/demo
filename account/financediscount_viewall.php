<?php 
session_start(); 
ob_start();
?>
<?php 
require_once '../connection.php';
if(isset($_SESSION['finance_module']))
{
$user_unique_id=$_SESSION['finance_module'];
$user_db=mysql_query("SELECT * FROM login_user_db WHERE user_admin_id='$user_unique_id'");
$fetch_user_data=mysql_fetch_array($user_db);
$fetch_user_num_rows=mysql_num_rows($user_db);
if((!empty($fetch_user_data))&&($fetch_user_data!=null)&&($fetch_user_num_rows!=0))
{
  $fetch_school_id=$fetch_user_data['organization_id'];
  $fetch_branch_id=$fetch_user_data['branch_id'];
  $fetch_accout_type=$fetch_user_data['account_type'];
  $fecth_user_unique=$fetch_user_data['user_admin_id'];
$organisation_db=mysql_query("SELECT * FROM organization_db WHERE organization_id='$fetch_school_id'"); 
 $fetch_org_data=mysql_fetch_array($organisation_db);
 $fetch_org_num_rows=mysql_num_rows($organisation_db);
if((!empty($fetch_org_data))&&($fetch_org_data!=null)&&($fetch_org_num_rows!=0))
{
$fetch_school_logo="../".$fetch_org_data['school_logo'];

$branch_db=mysql_query("SELECT * FROM branch_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'");  
$fetch_branch_data=mysql_fetch_array($branch_db);
$fetch_branch_num_rows=mysql_num_rows($branch_db);
 if((!empty($fetch_branch_data))&&($fetch_branch_data!=null)&&($fetch_branch_num_rows!=0))
 {
$fetch_branch_unique_db_id=$fetch_branch_data['branch_id'];
$fetch_school_name=$fetch_branch_data['branch_name'];
 

if($fetch_accout_type=="branch_head_admin")
{
 $manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_type='branch_head_admin'");   

}else
{
$manage_module_db=mysql_query("SELECT * FROM module_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and admin_id='$user_unique_id'");   
}
$fetch_module_data=mysql_fetch_array($manage_module_db);
$fetch_module_num_rows=mysql_num_rows($manage_module_db);
 if((!empty($fetch_module_data))&&($fetch_module_data!=null)&&($fetch_module_num_rows!=0))
 {
  $fetch_module_list=$fetch_module_data['module'];
  $explode_module_array=explode(",",$fetch_module_list);
  $check_array_in="account";
  $search_match_module= in_array($check_array_in,$explode_module_array);
  if($search_match_module==true)
  {
 {
  ?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
      
        <title>Finance</title>
    </head>
    <style>
         #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  padding-bottom:10px; 
                              font-family:arial; font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{width:1150px; height:auto; margin:0 auto;    }
    #table_midle_set{ width:100%; height:auto; margin:0 auto; margin-top:5px;       }
    .td_leftpadding{ padding-left:10px;  padding-top: 6px; }
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
         <input id="organization_id" name='organization_id' value="<?php  echo $fetch_school_id;?>" type="hidden">
             <input id="branch_id" name='branch_id' value="<?php  echo $fetch_branch_id;?>" type="hidden">
            
        
        
         <div id="financefirstdiv">
              <form name="myForm" action="" onsubmit="return validateForm();" method="post" enctype="multipart/form-data">
           
         <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="background-image:url('finanacephoto/bgblack.png');  font-weight:bold; ">
                        
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
                     if(!empty($_REQUEST['seecategorydiscount']))
                     {
                         
                     {
                     ?> 
                            
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
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&category_discount_id="+delete_tr_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
        </script>     
                            
                            
                            
                            
                            
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="7" class="td_leftpadding" 
                                        style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                        <strong style=" font-weight:bold; ">View Category Discount Details</strong>   
  <a href="financediscount_addcategory.php" border="0" style=" text-decoration:none; ">
      <abbr title="Add New Category Discount Deatil">
                                    <div id="top_add_view_div">
                                        <strong>Add Category Discount</strong>
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
                                        <strong>Class/Course</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Fee Name</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Category</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Discount (%/Flat)</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong> Description</strong>
                                    </td>
                                    <td class='td_border_color'>
                                   <strong>  Action</strong>
                                    </td>
                                    
                                    
                                </tr>
                             <?php 
                        require_once '../connection.php';
                        $row=0;
                        $feefinancedatabase=mysql_query("SELECT * FROM financefeediscountcategory WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and action='active'");
                        while ($fetchthisvalue=mysql_fetch_array($feefinancedatabase))
                        {
                            
                            $fetchdataid=$fetchthisvalue['id'];
                            $encrypt_id=$fetchthisvalue['encrypt_id'];
                            $fetch_course_id=$fetchthisvalue['course_id'];
                            $course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and course_id='$fetch_course_id'");
                            $fetch_course_data=  mysql_fetch_array($course_db);
                            $fetch_course_num_rows=  mysql_num_rows($course_db);
                            if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))
                            {
                              $course_name=$fetch_course_data['course_name']; 
                            }else
                            {
                             $course_name="";   
                            }
                            
                            
                            
                            $fetch_fee_group_id=$fetchthisvalue['fee_group_id'];
                            
                            $fee_group_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and fee_group_id='$fetch_fee_group_id'");
                            $fetch_fee_group_data=  mysql_fetch_array($fee_group_db);
                            $fetch_fee_group_num_rows=  mysql_num_rows($fee_group_db);
                            if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fetch_fee_group_num_rows!=0))
                            {
                              $fee_group_name=$fetch_fee_group_data['feegroupname']; 
                            }else
                            {
                             $fee_group_name="";   
                            }
                            
                            
                            $fetch_fee_category_id=$fetchthisvalue['category_id'];
                             $category_db=mysql_query("SELECT * FROM category_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and category_id='$fetch_fee_category_id'");
                            $fetch_category_data=  mysql_fetch_array($category_db);
                            $fetch_category_num_rows=  mysql_num_rows($category_db);
                            if((!empty($fetch_category_data))&&($fetch_category_data!=null)&&($fetch_category_num_rows!=0))
                            {
                              $category_name=$fetch_category_data['category_name']; 
                            }else
                            {
                             $category_name="";   
                            }
                            
                            
                            
                            
                            $fetch_discount_type=$fetchthisvalue['discount_type'];
                            $fetch_discount=$fetchthisvalue['feediscount'];
                            $fetch_description=$fetchthisvalue['feediscountdescription'];
                            
                            if($fetch_discount_type=="percantage")
                            {
                              $print_type="%";  
                            }else
                            {
                             $print_type="Flat";   
                            }
                            
                            
                            
                            $row++;
                        echo "<tr id='delete_row_$fetchdataid'>
                            <td class='td_viewvalue' id='tdleft'>$row</td>
                            <td class='td_viewvalue'>$course_name</td>
                            <td class='td_viewvalue'>$fee_group_name</td>
                            <td class='td_viewvalue'>$category_name</td>
                            <td class='td_viewvalue'> $fetch_discount $print_type</td>
                            <td class='td_viewvalue'>$fetch_description</td>
                            <td class='td_viewvalue' style='width:132px;'>
                            
                             <abbr title='Edit'>";
                        {
                        ?>
                                <a style="color:blue;" href="#" onclick="window.open('edit_category_discount_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=650,width=1020,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        
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
                        
                        if(empty($fetchdataid))
                        {
                        echo "
<tr>
<td colspan='7' class='td_viewvalue' id='tdleft'>
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
                          <?php 
                     }
                     
                     }
                            ?>
                            
                            
                            
                            
                          <?php 
                     if(!empty($_REQUEST['seehandicappeddiscount']))
                     {
                         
                     {
                     ?> 
        
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
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&handicapped_discount_id="+delete_tr_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
        </script>    
        
        
        
        
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="5" class="td_leftpadding" 
                                        style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">View Handicapped Discount Details</strong>   
  <a href="financediscount_addhandicaped.php" border="0" style=" text-decoration:none; ">
      <abbr title="Add New Handicapped Discount Deatil">
                                    <div id="top_add_view_div" style=" width:200px; ">
                                        <strong>Add Handicapped Discount Details </strong>
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
                                        <strong>Fee Group/Fee</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Discount (%/Flat)</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong> Description</strong>
                                    </td>
                                    <td class='td_border_color'>
                                   <strong>Action</strong>
                                    </td>
                                    
                                    
                                </tr>
                             <?php 
                        require_once '../connection.php';
                        $row=0;
                        $feefinancedatabase=  mysql_query("SELECT * FROM financefeediscountstudenthandicapped WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and action='active'");
                        
                        while ($fetchthisvaluehandicapped=mysql_fetch_array($feefinancedatabase))
                        {
                            $fetchdataid=$fetchthisvaluehandicapped['id'];
                            $fetchhandicapped=ucfirst($fetchthisvaluehandicapped['feestudenthandicapped']);
                            $fetchhandicappeddiscount=$fetchthisvaluehandicapped['feediscount'];
                            $fee_discount_type=$fetchthisvaluehandicapped['discount_type'];
                            $feehandicappeddesciption=ucfirst($fetchthisvaluehandicapped['feediscountdescription']);
                            $encrypt_id=$fetchthisvaluehandicapped['encrypt_id'];
                            $fetch_fee_group_id=$fetchthisvaluehandicapped['fee_group_id'];
                            $fee_group_db=mysql_query("SELECT * FROM financeaddfeegroup WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and fee_group_id='$fetch_fee_group_id'");
                            $fetch_fee_group_data=  mysql_fetch_array($fee_group_db);
                            $fetch_fee_group_num_rows=  mysql_num_rows($fee_group_db);
                            if((!empty($fetch_fee_group_data))&&($fetch_fee_group_data!=null)&&($fetch_fee_group_num_rows!=0))
                            {
                              $fee_group_name=$fetch_fee_group_data['feegroupname']; 
                            }else
                            {
                             $fee_group_name="";   
                            }
                            
                            if($fee_discount_type=="flat")
                            {
                               $print_discount_type="Flat";  
                            }else
                            {
                               $print_discount_type="%"; 
                            }
                            
                            
                            
                            $row++;
                        echo "<tr id='delete_row_$fetchdataid'>
                            <td class='td_viewvalue' id='tdleft'>$row</td>
                            <td class='td_viewvalue'>$fee_group_name</td>
                            <td class='td_viewvalue'>$fetchhandicappeddiscount $print_discount_type</td>
                            <td class='td_viewvalue'>$feehandicappeddesciption</td>
                            <td class='td_viewvalue' style='width:132px;'>
                            
                             <abbr title='Edit'>";
                        {
                        ?>
                                <a style="color:blue;" href="#" onclick="window.open('edit_handicapped_discount_details.php?token_id=<?php  echo $encrypt_id;?>','size',config='height=650,width=1020,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        
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
                        
                        if(empty($fetchhandicapped))
                        {
                        echo "
<tr>
<td colspan='5' class='td_viewvalue' id='tdleft'>
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
                          <?php 
                     }
                     
                     }
                            ?>
                            
                            
                            
                            
                           <?php 
                     if(!empty($_REQUEST['seeparticularstudentdiscount']))
                     {
                         
                     {
                     ?> 
        
           
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
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&particular_student_discount_id="+delete_tr_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
        </script> 
        
        
                            <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="10" class="td_leftpadding" 
                                        style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                        <strong style=" font-weight:bold; ">View Student Discount Details</strong>   
  <a href="financediscount_addparticularstudent.php" border="0" style=" text-decoration:none; ">
      <abbr title="Add New Particular Student Discount Deatil">
                                    <div id="top_add_view_div">
                                        <strong>Add Student Discount</strong>
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
                                        <strong>Sr No</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Admission No</strong>
                                    </td>
                                     <td class='td_border_color'>
                                        <strong>Course/Class</strong>
                                    </td>
                                     <td class='td_border_color'>
                                        <strong>Student Name</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Father Name</strong>
                                    </td>
                                    <td class='td_border_color'>
                                        <strong>Parent`s Mobile No</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong>Discount (%)</strong>
                                    </td>
                                    <td class='td_border_color'>
                                    <strong> Description</strong>
                                    </td>
                                    <td class='td_border_color'>
                                   <strong>  Action</strong>
                                    </td>
                                    
                                    
                                </tr>
                             <?php 
                        
                        $row=0;
                        $student_discount_db=  mysql_query("SELECT * FROM financefeediscountparticularstudent WHERE "
                                . "organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and action='active'");
                        while ($fetch_student_discount_data=mysql_fetch_array($student_discount_db))
                        {
                            $fetchdataid=$fetch_student_discount_data['id'];
                            $fetch_encrypt_id=$fetch_student_discount_data['encrypt_id'];
                            $fetch_student_id=$fetch_student_discount_data['student_id'];
                            $fetch_course_id=$fetch_student_discount_data['course_id'];
                            $fetch_fee_group_id=$fetch_student_discount_data['fee_group_id'];
                            
                             
                            $student_db=mysql_query("SELECT * FROM student_db as T1 "
                                    . "LEFT JOIN student_personal_db as T7 ON T1.student_personal_id=T7.student_unqiue_id"
                                    . " LEFT JOIN parent_db as T6 ON T1.parent_id=T6.parent_unique_id"
                                    . " WHERE T1.course_id='$fetch_course_id' and T1.student_id='$fetch_student_id'");
                            $fetch_student_data=  mysql_fetch_array($student_db);
                            $fetch_studnet_num_rows=  mysql_num_rows($student_db);
                            if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_studnet_num_rows!=0))
                            {
                             $studnet_sr_no=$fetch_student_data['id'];
                             $stduent_admission_no=$fetch_student_data['admission_no'];
                             $student_name=$fetch_student_data['student_full_name'];
                             $student_father_name=$fetch_student_data['father_name'];
                             $student_father_mobile_no=$fetch_student_data['father_mobile_no'];
                              
                            }else
                            {
                             $studnet_sr_no="";  
                             $stduent_admission_no="";
                             $student_name="";
                             $student_father_name="";
                             $student_father_mobile_no="";
                            }
                            
                            $fetch_discount_type=$fetch_student_discount_data['discount_type'];
                            if($fetch_discount_type=="percantage")
                            {
                             $print_discount_Type="%";   
                            }else
                            {
                              $print_discount_Type="Flat";    
                            }
                            $fetch_discount=$fetch_student_discount_data['feediscount'];
                            $fetch_description=$fetch_student_discount_data['description'];
                            
                            $course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set' and course_id='$fetch_course_id'");
                            $fetch_course_data=  mysql_fetch_array($course_db);
                            $fetch_course_num_rows=  mysql_num_rows($course_db);
                            if((!empty($fetch_course_data))&&($fetch_course_data!=null)&&($fetch_course_num_rows!=0))
                            {
                              $course_name=$fetch_course_data['course_name']; 
                            }else
                            {
                             $course_name="";   
                            }
                            
                            
                            $row++;
                        echo "<tr id='delete_row_$fetchdataid'>
                            <td class='td_viewvalue' id='tdleft'>$row</td>
                            <td class='td_viewvalue'>$studnet_sr_no</td>
                            <td class='td_viewvalue'>$stduent_admission_no</td>
                            <td class='td_viewvalue'>$course_name</td>
                            <td class='td_viewvalue'>$student_name</td>
                            <td class='td_viewvalue'>$student_father_name</td>
                            <td class='td_viewvalue'>$student_father_mobile_no</td>
                            
                            <td class='td_viewvalue'>$fetch_discount $print_discount_Type</td>
                            <td class='td_viewvalue' style='width:200px; overflow:auto; padding-left:2px;
                            padding-right:3px;'>$fetch_description</td>
                            <td class='td_viewvalue' style='width:132px;'>
                            <abbr title='Edit'>";
                        {
                        ?>
                                <a style="color:blue;" href="#" onclick="window.open('edit_particular_student_details.php?token_id=<?php  echo $fetch_encrypt_id;?>','size',config='height=650,width=1020,position=absolute,left=50,top=0, addressbar=yes, location=no, toolbar=no, menubar=no,copyhistory=no, scrollbars=yes, resizable=yes, directories=no, status=no')">  
                        
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
                          
                      
                        if(empty($fetchdataid))
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
                          <?php 
                     }
                     
                     }
                            ?>
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
  }
  }else
  {
   header("Location:../404_error.php");   
  }
 }else
 {
 header("Location:../loginPage.php");   
 }
  
  
 }else
 {
 header("Location:../loginPage.php");   
 }
 
 
 }else
{
     header("Location:../loginPage.php");
}


}else
{
    header("Location:../loginPage.php");
}

}else
{
     header("Location:../loginPage.php");
}
?>