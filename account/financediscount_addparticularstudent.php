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
                      if(!empty($_POST['adddiscountparticularstudent']))
                      {
                        
                       $student_unique_id=$_POST['insert_student_unique_id'];
                       $discount_type=$_POST['discount_type'];
                       $discount=$_POST['paricularstudentdiscount'];
                       $discount_description=$_POST['description'];
                       $insert_session_id=$_POST['use_inset_session_id'];  
                       $insert_class_id=$_POST['studnet_insert_post_class'];
                       $insert_fee_group_id=$_POST['all_fee_group_id'];
                       $implode_fee_group_id=implode(",",$insert_fee_group_id);
                      if((!empty($student_unique_id))&&(!empty($insert_class_id))&&(!empty($discount_type))&&(!empty($discount))&&(!empty($discount_description)))    
                      {    
                          
                      $srudent_match=mysql_query("SELECT * FROM  student_db WHERE student_id='$student_unique_id'");
                      $fetch_student_data=  mysql_fetch_array($srudent_match);
                      $fetch_student_num_rows=  mysql_num_rows($srudent_match);
                      if((!empty($fetch_student_data))&&($fetch_student_data!=null)&&($fetch_student_num_rows!=0))
                      {
                       
$static_id="DISCTPARSTUDNT";    
 $add_one_no=1;   
 $discount_cat_org_db=mysql_query("SELECT * FROM  financefeediscountparticularstudent WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' ORDER BY id DESC");
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
            
                          
  
  
  
                          
                       $check_match_part_disc_db=mysql_query("SELECT * FROM financefeediscountparticularstudent WHERE organization_id='$fetch_school_id'
                           and branch_id='$fetch_branch_id' and session_id='$insert_session_id' and discount_par_stu_id='$final_discount_cat_id'
                           OR organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and session_id='$insert_session_id'
                               and student_id='$student_unique_id'");   
                          
                 $fetch_match_par_dis_data=  mysql_fetch_array($check_match_part_disc_db);
                 $fetch_match_par_dis_num_rows=  mysql_num_rows($check_match_part_disc_db);
                 if((empty($fetch_match_par_dis_data))&&($fetch_match_par_dis_data==null)&&($fetch_match_par_dis_num_rows==0))
                 {
                  $explode_fee_id=explode(",",$implode_fee_group_id);  
                     foreach ($explode_fee_id as $insert_fee_id)  
                     {
                 $insert_particular_discount_db=mysql_query("INSERT into financefeediscountparticularstudent values('',
                     '$fetch_school_id','$fetch_branch_id','$insert_session_id','$final_discount_cat_id','$encrypt_id',
                         '$student_unique_id','$insert_class_id','$insert_fee_id','$discount_type','$discount','$discount_description',
                         '$date','$date_time','$user_unique_id','active')");    
                     }
                if($insert_particular_discount_db)
                {
                 $message_show="<div class='error_msg'>Record save successfully complete.</div>";    
                }else
                {
                 $message_show="<div class='error_msg'>Request failed,please try again.</div>";    
                }
                     
                 }else $message_show="<div class='error_msg'>Record already exist in database.</div>";                          
                          
                      }else $message_show="<div class='error_msg'>Please select student</div>";
                      }else $message_show="<div class='error_msg'>Please fill all fields.</div>";
                      }
                      
                        ?>    
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
      <script type="text/javascript" src="../javascript/jquery-1.7.2.min.js">
        </script>   
        <link href="stylesheet/style_css_sheet.css" rel="stylesheet" type="text/css" media="all">
      
         <script src="../javascript/list.js"></script>
    
    <script type="text/javascript">
    
    function class_id(class_id)
    {
   var organization_id="<?php  echo $fetch_school_id;?>";
   var branch_id="<?php  echo $fetch_branch_id;?>";
   var session_id=document.getElementById("insert_session_id").value;
   if(class_id==0)
   {
   document.getElementById("section_id").innerHTML="<option>-- Select Section --</option>"
    }else
     if((class_id==0)&&(session_id==0)&&(organization_id==0)&&(branch_id==0))
         {
             
         }else
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
   document.getElementById("fetch_data").innerHTML=httpxml.responseText;
   var section_record=document.getElementById("section_record").innerHTML;
   document.getElementById("section_id").innerHTML=section_record;
    
    var student_list=document.getElementById("student_search_data").innerHTML;
    document.getElementById("all_student_details").innerHTML=student_list;
    document.getElementById("ajax_loader_show").style.display="none";    
     
$(document).ready(function(){
var options = {
  valueNames: ['student_name_search']
};
var userList =new List('search_student_div', options);
});  
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
url=url+"?class_id="+class_id+"&&org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);      
    }
    }
    </script>   
    
    
    <script type="text/javascript">
function section_change_id(section_id)
{ 
 var class_id=document.getElementById("class_course_id").value;
  var organization_id="<?php  echo $fetch_school_id;?>";
   var branch_id="<?php  echo $fetch_branch_id;?>";
   var session_id=document.getElementById("insert_session_id").value;
     if((class_id==0)&&(session_id==0)&&(organization_id==0)&&(branch_id==0))
         {
          return false;   
         }else
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
  
   var student_list=document.getElementById("student_search_data").innerHTML;
    document.getElementById("all_student_details").innerHTML=student_list;
    document.getElementById("ajax_loader_show").style.display="none";    
     
$(document).ready(function(){
var options = {
  valueNames: ['student_name_search']
};
var userList =new List('search_student_div', options);
});  

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
url=url+"?class_id="+class_id+"&&section_id="+section_id+"&&org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
                }


}
</script> 


<script type="text/javascript">
function live_autocomplete_search(e,search_qq)
  {

}
</script>






<script type="text/javascript">
function search_student_live(e,search_live)
{
 
 
 document.getElementById("all_student_details").style.display="block";
 var class_id=document.getElementById("class_course_id").value;
   if((class_id==0))
       {
          alert("Please first select class");
          document.getElementById("class_course_id").focus();
          document.getElementById("student_search").value="";
          document.getElementById("insert_student_id_in_db").value="";
          document.getElementById("all_student_details").style.display="none";
          return false;
       }else
         if((search_live.length==0)) 
             {
             document.getElementById("student_search").value="";
          document.getElementById("all_student_details").style.display="none";
          document.getElementById("insert_student_id_in_db").value="";
          document.getElementById("student_data").innerHTML="";
          return false;    
             }else
             {
              
var e=window.event || e
if(class_id==0)
    {
     alert("Please first select class");
     document.getElementById("search_static_student").value="";
     return false;
    }else
if(event.keyCode == 8 || event.keyCode == 32)
    {
      
     $("li[class='selected']").removeClass("selected");  
    }else
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
{

$("li[class='selected']").removeClass("selected");    
}else
    {
                switch (event.keyCode)
				{
				 case 40:
				 {
                                     
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
                                                     
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:first").addClass("selected");
                                            
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:last").addClass("selected");
                                           
				 }
				 break;
				 case 13:
                                     {
					
                                        if($("li[class='selected'] .ancor_student_id").text()!="")
                                            {
                                        $("#student_static_search_div").fadeOut(100);
                                        $("#input_student").val('0');
					$("#student_name_tittle").text($("li[class='selected'] .ancor_student_name").text());
                                        $("#admission_no").val($("li[class='selected'] .ancor_student_id").text());
                                        $("li[class='selected']").removeClass("selected");
                                         
                                        var student_id=$("#admission_no").val();
                                         var student_name=$("#student_name_tittle").text();
                                         
                                         
                                            }
}
break;
}
}
             }
}
</script>  
<script>
function student_record(student_name)
{
 var student_names=document.getElementById("student_name_"+student_name).innerHTML;
 document.getElementById("student_data").innerHTML=student_names;
 var student_advance_search=document.getElementById("search").value;
 var student_admission_id=document.getElementById("match_student_id_"+student_name).value;
 if(student_name==student_admission_id)
     {

var student_name_insert=document.getElementById("student_names_"+student_name).value;
 document.getElementById("student_search").value=student_name_insert;
 document.getElementById("insert_student_id_in_db").value=student_name;
 var fee_group_data=document.getElementById("fee_group_data_"+student_name).innerHTML;
  document.getElementById("fee_group_show").innerHTML=fee_group_data;
 
if(student_advance_search!=0)
    {
    document.getElementById("search").value=student_name_insert;    
    document.getElementById("all_list").innerHTML="";
    var fee_group_data=document.getElementById("fee_group_data_"+student_name).innerHTML;
  document.getElementById("fee_group_show").innerHTML=fee_group_data;
 
    }
 
  
 
     }else
         {
          alert("Sorry,Record missing,Please reload page")   
         }
 
 document.getElementById("all_student_details").style.display="none";
 document.getElementById("all_student_details").style.display="none";
}
</script>
    
   



 <script type="text/javascript">
            
  function live_autocomplete_search(e,live_search_code)
  {
var e=window.event || e
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
{

  var organization_id="<?php  echo $fetch_school_id;?>";
   var branch_id="<?php  echo $fetch_branch_id;?>";
   var session_id=document.getElementById("insert_session_id").value;
   
var httpxml;   
var search_by=document.getElementById("search_by_id").value; 
var regarding_search_by=live_search_code;
if((search_by==0)||(organization_id==0)||(branch_id==0)||(session_id==0)
    ||(regarding_search_by=="")||(regarding_search_by.length<=0))
    {
     document.getElementById("student_data").innerHTML="";
     document.getElementById("all_list").innerHTML="";
     document.getElementById("all_list").style.display="none"; 
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
    document.getElementById("all_list").style.display="block";
    document.getElementById("all_list").innerHTML=httpxml.responseText; 
     }
      }
    } 
  
var url="financeajaxcode.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&search_by="+search_by+"&&search_q="+live_search_code;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
}else
    {
    
    }
   }
   
    </script>
    
    
    
    
    
    
    </head>
    <style>
        .feegroup_list{ width:auto; height:auto; padding-top:6px;  float:left; padding-left:10px;    }
    .select_all{ width:100%; height:auto;  padding-left:10px;border-bottom:1px solid skyblue; font-weight:bold;    }
    
   #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-weight:800;  font-size:12px; float:left;      }
    .add_button_reset_button{ width:60px; height:22px;   }
    #valuediv{ width:1150px; height:auto;  margin:0 auto;  }
    #table_midle_set{ width:100%; height:180px; margin:0 auto; margin-top:10px; border:1px solid #555555; float:left;    
    }
    .td_leftpaddingth{ padding-left:10px; padding-top: 4px;}
    #top_add_view_div{ width:190px; height:18px; padding-top:5px; padding-left:10px;
                       padding-right:10px; margin-top:-5px; 
                   background-color: #FFFFCC;
                       float:right; margin-right:3px; color:black; text-align:center;      }
    .td_leftpadding{ padding-right:10px;text-align:right;  }
    .textsize_same{ border:1px solid gray; margin-left:5px; }
     .add_button_reset_button{ width:70px; height:28px; margin-left:12px; font-size:12px; 
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-color:dodgerblue; border:0px;  float:right; cursor:pointer;
    margin-top:10px; margin-bottom:10px;  }
    #error-msg{ width:100%; height:22px;padding-top:3px; background-color:#FFFFCC; 
                margin-top:10px; float:left; color:#380000; text-align: center;
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    #table_midle_settable{ width:650; height:auto;  float:left;  }
    .selectsize_same{ width:165px; }
    .text_sizebox{ width:160px; border:1px solid silver;   }
    #particularstudentname{ width:180px; height:auto; position:absolute;float:left; display:none;  }
    #particularstudentfathername{ width:162px; height:20px; position:absolute;  display:none; }
    #particularstudentdateofbirth{ width:162px; height:20px; position:absolute; margin:0; padding:0; display:none;   }
     .listbutton{ width:100%; height:100%; text-align:left;background-color:whitesmoke; 
                    border:1px solid whitesmoke;     }
        .listbutton:hover{ background-color:silver;  border:1px solid silver; cursor:pointer;  }
 ul{ margin: 0; padding: 0;width:100%; height:auto;list-style:none;color: black; background-color: white;  }
             li{ margin: 0; padding: 0;width:auto; height:20px; padding-top:5px;  font-weight:100;  
                 border-bottom:1px solid silver;
                   color: black; border-left:1px solid silver;border-right:1px solid silver; }
             li:hover{ background-color: whitesmoke; color:blue; }
       .sli{ width:100%; height:auto; font-size:0px;   }
        .hsli{ width:100%; height:auto; height:22px; text-indent:5px;  }
        .radio_button{ width:auto; height:20px; position:relative; top:7px;   }
        #normal_search_div{ width: 350px; height:150px; }
        #student_details_div_tag{ width:600px; height:150px;  float:right;   }
        .select_styling{ width:170px; height:22px;  }
        #student_data_table{ width:500px; height:auto; float:right; font-size:12px;    }
        #ajax_loader_show{ display: none;}
        #all_student_details{ width:415px; display:none;  float:left; max-height:400px; overflow-y:auto;   
                              position:absolute; }
        #all_student_details li{ padding-left:4px; cursor:pointer;  padding-right:4px; padding-top:4px;   }
        .search{ width:437px; height:18px;  }
        p{ margin: 0; padding:0; float:left;  }
        #advance_search{ display:none; }
        .select_box_Styling { width:230px; height: 24px; }
        .search_text_box{ width:415px; height:18px;  }
        sup { color:red; }
        .error_msg{  width:600px; height:20px;padding-top:3px; background-color:#FFFFCC; font-weight:100;  
                margin-top:10px;color:#380000; text-align: center; margin:0 auto; padding-top:8px;  
                background-image:url('finanacephoto/skyblue.pg'); border:1px solid silver;     }
    </style>
     <style>
            .student_images{ width:100px; height:120px;  border:1px solid skyblue;  }
            .student_table{ width:100%; height:auto; font-size:11px; font-family:arial;   }
        </style>
     <style>
.main{
	border : 0px solid #8789E7;

	padding: 10px 0px;
	width : 800px;
	height : 40px;
}
#loading{
	visibility:hidden;
	padding-left:5px;
}
#ajax_response{
	border : 1px solid #8789E7;
	background : #FFFFFF;
	position:absolute;
	display:none;
	padding:2px 2px;
	top:auto;
}
#holder{
	width : 350px;
}
.list {
	padding:0px 0px;
	margin:0px;
	list-style : none;
}
.list li a{
	text-align : left;
	padding:2px;
	cursor:pointer;
	display:block;
	text-decoration : none;
	color:#000000;
}
ul{ font-weight:100; }
#all_list{ display: none;}
#all_list li{ padding-top:5px; padding-bottom:5px; font-size:12px;  cursor:pointer;  }
#all_list li a{ font-weight:100; cursor:pointer; }
.selected{
font-weight:100;   
    background : chartreuse;
}
.bold{
	font-weight:bold;
	color: #131E9F;
}
.about{
	text-align:right;
	font-size:10px;
	margin : 10px 4px;
}
.about a{
	color:#BCBCBC;
	text-decoration : none;
}
.about a:hover{
	color:#575757;
	cursor : default;
}
   .select_stylings{ width:165px; height:22px;  }     
   .radio_button{ width:15px; height:15px; position:relative; top:0px; cursor:pointer;  margin-left:10px;  }
   
      </style>
      
      
      <script type="text/javascript">
     function validateForm()
     {
       var student_id=document.getElementById("insert_student_id_in_db").value;
       var discount_type=document.getElementById("discount_type").value;
       var discount=document.getElementById("discount").value;
       
       if(student_id==0)
           {
           alert("Please select student");
           return false;
           }else
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
                           }
       
     }
      </script>
      
      
      
      
    <body style=" margin: 0;padding: 0;">
           <?php 
include_once '../ajax_loader_page_second.php';
      ?>
        
        <div style=" display:none; " id="fetch_data"></div>
        
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
                                    <td colspan="2" class="td_leftpaddingth" style=" color:white;  font-weight:bold;  
                                        height:25px; background-color:#555555; ">
                                    Add/Edit Particular Student Discount Details  
                                    
                                    <a href="financediscount_viewall.php?seeparticularstudentdiscount=2ttr_DDFGGS_SHHGD_33467VS_SDBHSDH" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Particular Student Discount Detail">
                                    <div id="top_add_view_div">
                                        <strong> View Student Discount Details </strong>
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
                                     <script type="text/javascript">
                                     function normal_searchs()
                                     {
                                   document.getElementById("normal_search").style.display="block";     
                                      document.getElementById("advance_search").style.display="none";     
                                    
                                     }
                                     function advance_searchs()
                                     {
                                    document.getElementById("normal_search").style.display="none"; 
                                    document.getElementById("advance_search").style.display="block";     
                                    
                                     }
                                     </script>
                                         
                                         
                                         
                                          <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Select Student</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable">
                                          <tr>
                                              <td style=" background-color:gray; color:white;  height:15px; ">
                                                  <input type="hidden" name="insert_student_unique_id" id="insert_student_id_in_db">
                                                  <table style=" width:auto; float:left; height:30px;  vertical-align:middle;  ">
                                       <tr>
                                              <td><input type="radio" onclick="normal_searchs()" name="normal_search" class="radio_button" checked></td>
                                              <td> <b>Normal Search</b></td>
                                              <td><input type="radio" onclick="advance_searchs()" name="normal_search"  class="radio_button"></td>
                                              <td><b>Advance Search</b></td>
                                          </tr> 
                                                  </table>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style=" height:10px; "></td>
                                          </tr>
                                          <tr>
                                              <td>
                                                  <div id="normal_search">
                                                      <table>
                                                         <tr>
                                              <td><b>Class/Course  <sup>*</sup></b></td>
                                              <td style=" width:20px; "><strong>:</strong></td>
                                              <td>
                                                  <select id="class_course_id" onchange="class_id(this.value)" class="select_styling">
                                                      <option value="0">-- Select Class/Course --</option>
<?php 
  $course_db=mysql_query("SELECT * FROM course_db WHERE organization_id='$fetch_school_id' 
          and branch_id='$fetch_branch_id' and session_id='$fecth_session_id_set'");
  while ($fetch_course_data=mysql_fetch_array($course_db))
  {
  $fetch_course_id=$fetch_course_data['course_id'];
  $fetch_course_name=$fetch_course_data['course_name'];
  
  echo "<option value='$fetch_course_id'>$fetch_course_name</option>";
      
      
  }
  ?>                                                    
                                                  </select>                                     
                                              </td>
                                              <td style=" width:15px; "></td>
                                              <td><b>Section <sup>*</sup></b></td>
                                              <td style=" width:20px; "><strong>:</strong></td>
                                              <td>
                                                  <select id="section_id" onchange="section_change_id(this.value)" 
                                                          class="select_styling">
                                                      <option value="0">-- Select Section --</option>
                                                  </select>                                     
                                              </td>
                                          </tr>
                                          <tr>
                                          
                                                              <td><b>Search  <sup>*</sup></b></td>
                                                              <td><strong>:</strong></td>
                                                              <td colspan="5">
                                                                  <div id="search_student_div">
                                                                  <input class="search" Placeholder="Search student name" id="student_search"
                                                                       autocomplete="off"  onkeyup="search_student_live(event,this.value)"
                                                                         type="text">
                                                                  <ul id="all_student_details" class="list"></ul>
                                                                   </div>
                                                              </td>
                                         
                                         </tr> 
                                                      </table>   
                                                  </div>
                                                  
                                                  
                                                  <div id="advance_search">
                                                      <table>
                                                          <tr>
                                                              <td><b>Search By  <sup>*</sup></b></td>
                                                              <td style=" width: 40px; text-align: center;"><b>:</b></td>
                                                              <td><select id="search_by_id" class="select_box_Styling">
                                                                      <option value="T7.student_full_name">Student Name</option>
                                                                      <option value="father_name">Father Name</option>
                                                                      <option value="mother_name">Mother Name</option>
                                                                      <option value="local_parent_name">Local Parents Name</option>
                                                                  </select>
                                                              </td>
                                                          </tr>
                                                          <tr>
                                                              <td>
                                                                  <style>
                                                                  #automcomplete_first_div{ width:410px; height:auto; position:absolute;
 margin-left:1px;border-top:0px;
z-index:301;}    
                                                                  #ajax_auto_complete_div{ width:100%; height:auto;   }
            #all_list{  max-height:613px; overflow-y:auto; margin-top:0px;
padding-right:5px; padding-bottom:2px;  }
#all_list li{ padding-left:7px; border-radius:2px;    }                                                          
                                                                  </style>
                                                                  <b>Search  <sup>*</sup></b></td>
                                                              <td style=" width: 40px; text-align: center;" ><b>:</b></td>
<td><input type="text" placeholder="Search" autocomplete="off" 
           onkeyup="live_autocomplete_search(event,this.value)"   class="search_text_box" id="search">
    <div id="automcomplete_first_div">
                               <div id="ajax_auto_complete_div">
                                   <ul id="all_list">
                                       
                                   </ul>   
                               </div>
                           </div>
                                                              </td>
                                                          </tr>
                                                      </table>
                                                  </div>   
                                                  
                                                  
                                                  
                                              </td>
                                          </tr>
                                      </table>
                                          
                                      
                            <table id="student_data_table">
                                <tr>
                                    <td><div style=" width:1px; height:100px; background-color: black; float:left; margin-right:2px;   "></div>
                            </td>
                            <td><div id="student_data" style=" font-size: 11px;"> 
                                            <input type="hidden" id="student_admission_no" value="0">  
                                            <span style=" color:red; font-weight:bold; font-size:13px; text-align:center;
                                               position:relative; left:10%; margin-top:10px; float:left;      width:100%; ">Student Record No Found !!</span>
                                        </div></td>
                                </tr>
                            </table>
                                      
                                      </fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <div id="fee_group_show" style=" width:100%; ">
                                          <input type="hidden" id="temp_fee_group" value="0">  
                                        </div>   
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="td_leftpadding">
                                       <fieldset style=" font-size:12px; font-weight:500;margin-left:10px; margin-top:5px;    text-align:left;">
                                      <legend><span style=" color: maroon;  ">Set Discount (%)</span></legend>
                                      <table  cellspacing="0" cellpadding="0" id="table_midle_settable" style=" 
                                              height:150px;">
                                          <tr>
                                              <td style=" width:60px; "></td>
                                              <td  class="td_leftpadding">
                                                  <strong>Discount Type</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                                  <select name="discount_type" class="select_stylings" id="discount_type">
                                                      <option value="percantage">%</option> 
                                                      <option value="flat">Flat</option>
                                                  </select>
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style=" width:60px; "></td>
                                              <td  class="td_leftpadding">
                                                  <strong>Discount</strong>  <sup style=" color:red; ">*</sup> 
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                               <input type="text" id="discount" 
                                                      name="paricularstudentdiscount" maxlength="3" 
                                                      class="text_sizebox">
                                              </td>
                                          </tr>
                                          <tr>
                                              <td style=" width:60px; "></td>
                                              <td  class="td_leftpadding">
                                                  <strong>Description</strong>  
                                              </td>
                                              <td>
                                               <strong>:</strong>
                                              </td>
                                              <td>
                                               <textarea id="textareasize" name="description" class="text_sizebox" style=" height:60px; ">

                                               </textarea>
                                              </td>
                                              
                                                                   
                                              
                                          </tr>
                                      </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        
                                    </td>
                                    <td>
                                         <input type="submit" value="Save" id="addparticularstudentdiscount"
                                                name="adddiscountparticularstudent" class="add_button_reset_button" style=" margin-right:14px; ">
                                        
                                         <input type="submit" value="Reset" class="add_button_reset_button" style=" background-color: deeppink;"> 
                                       
                                        
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