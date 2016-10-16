//normal search
function normal_search()
{
 document.getElementById("advancesearchtable").style.display="none"; 
 document.getElementById("normalsearchtable").style.display="block";   
 
 document.getElementById("showiframepaymentsystem").innerHTML="";
document.getElementById("student_record_fetch").innerHTML="";
document.getElementById("student_record_fetch").innerHTML='<input type="hidden" id="student_sr_no">  <input type="hidden" id="student_admission_no">\n\
<input type="hidden" id="student_class_id"><div class="no_record">Record No Found !!</div>';

document.getElementById("studentperiviousdetails").innerHTML="";
document.getElementById("studentperiviousdetails").innerHTML='<div class="no_record">Record No Found !!</div>';
document.getElementById("all_student_list").innerHTML="";
document.getElementById("studentsection").innerHTML="<option value='0'>-- Select --</option>"

document.getElementById("manuallycollectfeedetails").style.display="none";
document.getElementById("auotomaticallycollectfeedetails").style.display="none";
document.getElementById("manuallyfeegroup").innerHTML="<option id='manually_select_fee_group' value='0'>-- Select fee group --</option>"; 
document.getElementById("zero_select_automatically").selected=true;
   
document.getElementById("collectfeeautomatic").checked=false;   
document.getElementById("collectfeemanually").checked=false;   
 
document.getElementById("student_name_tittle").innerHTML="-- Select Student --"; 
document.getElementById("admission_no").value=0;
document.getElementById("input_student").value=0;
document.getElementById("student_static_search_div").style.display="none";
document.getElementById("student_search").value="";
document.getElementById("search_static_student").value="";
document.getElementById("student_sr_no").value=0;
document.getElementById("student_admission_no").value=0;
document.getElementById("student_class_id").value=0;
document.getElementById("class_zero_select").selected=true;
document.getElementById("all_list").innerHTML="";


}

//advance search
function advance_search()
{
 document.getElementById("normalsearchtable").style.display="none";
 document.getElementById("advancesearchtable").style.display="block"; 
 
 document.getElementById("showiframepaymentsystem").innerHTML="";
document.getElementById("student_record_fetch").innerHTML="";
document.getElementById("student_record_fetch").innerHTML='<input type="hidden" id="student_sr_no">  <input type="hidden" id="student_admission_no">\n\
<input type="hidden" id="student_class_id"><div class="no_record">Record No Found !!</div>';

document.getElementById("studentperiviousdetails").innerHTML="";
document.getElementById("studentperiviousdetails").innerHTML='<div class="no_record">Record No Found !!</div>';
document.getElementById("all_student_list").innerHTML="";
document.getElementById("studentsection").innerHTML="<option value='0'>-- Select --</option>"

document.getElementById("manuallycollectfeedetails").style.display="none";
document.getElementById("auotomaticallycollectfeedetails").style.display="none";
document.getElementById("manuallyfeegroup").innerHTML="<option id='manually_select_fee_group' value='0'>-- Select fee group --</option>"; 
document.getElementById("zero_select_automatically").selected=true;
   
document.getElementById("collectfeeautomatic").checked=false;   
document.getElementById("collectfeemanually").checked=false;   
 
document.getElementById("student_name_tittle").innerHTML="-- Select Student --"; 
document.getElementById("admission_no").value=0;
document.getElementById("input_student").value=0;
document.getElementById("student_static_search_div").style.display="none";
document.getElementById("student_search").value="";
document.getElementById("search_static_student").value="";
document.getElementById("student_sr_no").value=0;
document.getElementById("student_admission_no").value=0;
document.getElementById("student_class_id").value=0;
document.getElementById("class_zero_select").selected=true;
document.getElementById("all_list").innerHTML=""; 
}




function fee_payment_mode(fee_payament_mode)
{
if(fee_payament_mode=="manually")
    {
document.getElementById("auotomaticallycollectfeedetails").style.display="none";
document.getElementById("zero_select_automatically").selected=true;
document.getElementById("showiframepaymentsystem").innerHTML="";

var student_sr_no=document.getElementById("student_sr_no").value;
var student_admission_no=document.getElementById("student_admission_no").value;
var student_class=document.getElementById("student_class_id").value;
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
if((organization_id==0)&&(branch_id==0)&&(session_id==0))
    {
    alert("Please select organization,branch,session id,Please reload page");
return false;    
    }else
if((student_sr_no==0)&&(student_admission_no==0)&&(student_class==0))
    {
     document.getElementById("collectfeemanually").checked=false;
     document.getElementById("studentclass").focus();
     alert("Please first select student");
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
  
   document.getElementById("ajax_loader_show").style.display="block"; 
    
function stateChanged() 
    {
    if(httpxml.readyState==4)
      {
 if(httpxml.responseText!=0)
     {
   
   document.getElementById("manuallycollectfeedetails").style.display="block";
   document.getElementById("manuallyfeegroup").innerHTML=httpxml.responseText; 
   
    document.getElementById("ajax_loader_show").style.display="none"; 
    
     }
      }
    } 
  
var url="student_fee_pay_ajax.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&student_id="+student_admission_no+"&&class_unique_id="+student_class;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);  
    }  
    }else
      if(fee_payament_mode=="automatic")
          {
              
        document.getElementById("showiframepaymentsystem").innerHTML="";      
        document.getElementById("zero_select_automatically").selected=true;
         document.getElementById("manually_select_fee_group").selected=true;  
var student_sr_no=document.getElementById("student_sr_no").value;
var student_admission_no=document.getElementById("student_admission_no").value;
var student_class=document.getElementById("student_class_id").value;
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
if((organization_id==0)&&(branch_id==0)&&(session_id==0))
    {
    alert("Please select organization,branch,session id,Please reload page");
return false;    
    }else
if((student_sr_no==0)&&(student_admission_no==0)&&(student_class==0))
    {
     document.getElementById("collectfeeautomatic").checked=false;
     document.getElementById("studentclass").focus();
     alert("Please first select student");
     return false;
    }else{
         document.getElementById("manuallycollectfeedetails").style.display="none";
          document.getElementById("manuallyfeegroup").innerHTML="<otpion value='0'>-- Select fee group --</option>"
          document.getElementById("auotomaticallycollectfeedetails").style.display="block";
          }
         
          }
          }


//manually fee collect
function manually_fee_group_id(fee_group_id)
{
 
    var normal_search=document.getElementById("normalsearch").checked;
    if(normal_search==true)
    {
     var student_id=document.getElementById("student_id").value; 
     var class_id=document.getElementById("studentclass").value; 
     var section_id=document.getElementById("studentsection").value; 
     var search_by="";  
     var search_qq="";  
     var search_option="normal";
             
    }else
    {
     var student_id=document.getElementById("advance_student_id").value;  
      var class_id="";
     var section_id="";
     var search_by=document.getElementById("studentsearchby").value;  
     var search_qq=document.getElementById("student_search").value;
     var search_option="advance";
    }
    
    if(student_id==0)
    {
    document.getElementById("collectfeeautomatic").checked=false;
    document.getElementById("studentclass").focus();    
    alert("Please first select student");
    return false;
    }else
    {
  var payment_date=document.getElementById("payment_dates").value;      
        
   document.getElementById("ajax_loader_show").style.display="block";             
 window.location.assign('financepay_studentfee.php?fees_pay_method=manually_fee\n\
&fees_group_id='+fee_group_id+'&student_admission_id='+student_id+'&search_option='+search_option+'&Xmlhtppclass='+class_id+'\
&Xmlhttpsection='+section_id+'&search_by='+search_by+'&&search_qq='+search_qq+'&&xmlpayment_date='+payment_date+'');
}    
}


function full_complete_pay_fee(fee_group_id)
{

    var normal_search=document.getElementById("normalsearch").checked;
    if(normal_search==true)
    {
     var student_id=document.getElementById("student_id").value; 
     var class_id=document.getElementById("studentclass").value; 
     var section_id=document.getElementById("studentsection").value; 
     var search_by="";  
     var search_qq="";  
     var search_option="normal";
             
    }else
    {
     var student_id=document.getElementById("advance_student_id").value;  
      var class_id="";
     var section_id="";
     var search_by=document.getElementById("studentsearchby").value;  
     var search_qq=document.getElementById("student_search").value;
     var search_option="advance";
    }
    
    if(student_id==0)
    {
    document.getElementById("collectfeeautomatic").checked=false;
    document.getElementById("studentclass").focus();    
    alert("Please first select student");
    return false;
    }else
    {
   var payment_date=document.getElementById("payment_dates").value;
   document.getElementById("ajax_loader_show").style.display="block";             
 window.location.assign('financepay_studentfee.php?fees_pay_method=complete_fee_pay\n\
&fees_group_id='+fee_group_id+'&student_admission_id='+student_id+'&search_option='+search_option+'&Xmlhtppclass='+class_id+'\
&Xmlhttpsection='+section_id+'&search_by='+search_by+'&&search_qq='+search_qq+'&&xmlpayment_date='+payment_date+'');
}    
}




//class wise fee amount
function class_wise_fee()
{
 document.getElementById("student_wise_fee_amount").style.display="none";
 document.getElementById("class_wise_fee_amount").style.display="block";
 
}


//student wise fee amount
function student_wise_fee()
{
 document.getElementById("class_wise_fee_amount").style.display="none";
 document.getElementById("student_wise_fee_amount").style.display="block";
    
}


//fee amount transport or hostel

function fee_name_id(fee_name_id)
{
   var transport_id=document.getElementById("check_transport_fee_id").value;
   var hostel_id=document.getElementById("check_hostel_fee_id").value;
   
      if(transport_id==fee_name_id)
       {
       document.getElementById("feeamount").value="Transport D/P Assign Fee Amount";
       document.getElementById("fee_transport_hostel_active").value="transport_amount_on";
       document.getElementById("feeamount").readOnly=true;
       document.getElementById("feeamount").style.backgroundColor="aliceblue";
       document.getElementById("student_type_radio").disabled=true;
       }else
        if(hostel_id==fee_name_id)
       {
       document.getElementById("feeamount").value="Hostel D/P Assign Fee Amount";
       document.getElementById("fee_transport_hostel_active").value="hostel_amount_on";
       document.getElementById("feeamount").readOnly=true;
       document.getElementById("feeamount").style.backgroundColor="aliceblue";
       document.getElementById("student_type_radio").disabled=true;
       }else
           {
            document.getElementById("feeamount").value="0";
            document.getElementById("fee_transport_hostel_active").value="";
       document.getElementById("feeamount").readOnly=false;   
       document.getElementById("feeamount").style.backgroundColor="white";
       document.getElementById("student_type_radio").disabled=false;
           }
   
   
}




function validateForm(frm)
{
 if(frm.elements['fee_group_qty[]'])
 {
var payable_amount=document.getElementById("final_amount_payable_this").value;
var paid_amount=document.getElementById("amount_paid_value").value;
var due_amount=document.getElementById("due_amount").value;

    
    var checkboxese=document.querySelectorAll('input[name="fee_group_qty[]"]'),valuese=[];
     Array.prototype.forEach.call(checkboxese, function(el) {
        valuese.push(el.value);
    });
    
    if(valuese==0)
    {
       alert("Select atleast one month/annual/term fee"); 
       return false;
    }else
    {
      
    for(var ij=1;ij<50;ij++)
     {
     
     if(document.getElementById("other_fee_group_id_"+ij))
          {
          
         var other_fee_group_id=document.getElementById("other_fee_group_id_"+ij).value;
         var other_fee_group_name=document.getElementById("other_fee_group_name_"+ij).value;
         var other_fee_group_amount=document.getElementById("other_fee_group_amount_"+ij).value;
         var other_fee_group_qty=document.getElementById("other_fee_group_qty_"+ij).value;
         var other_fee_group_specific_month=document.getElementById("other_fee_group_specific_month_"+ij).value;
         var other_fee_group_sub_total=document.getElementById("other_fee_group_sub_total_value_"+ij).value;
         var other_fee_group_total_amount=document.getElementById("other_fee_group_total_amount_value_"+ij).value;
         
         if(other_fee_group_id==0)
             {
                alert("Please enter fee group id");
                return false;
             }else
             if(other_fee_group_name==0)
             {
                alert("Please enter fee group name");
                document.getElementById("other_fee_group_name_"+ij).focus();
                return false;
             }else
                 if(other_fee_group_amount==0)
                     {
                        alert("Please enter fee group amount");
                        document.getElementById("other_fee_group_amount_"+ij).focus();
                        return false;
                     }else
                         if(isNaN(other_fee_group_amount))
                             {
                        alert("Please enter only numeric value");
                        document.getElementById("other_fee_group_amount_"+ij).focus();
                        return false;    
                             }else
                         if(other_fee_group_qty==0)
                             {
                             alert("Please enter fee group qty");
                             document.getElementById("other_fee_group_qty_"+ij).focus();
                             return false;
                             }else
                             if(isNaN(other_fee_group_qty))
                             {
                             alert("Please enter only numeric value");
                             document.getElementById("other_fee_group_qty_"+ij).focus();
                             return false;
                             }else
                                 if(other_fee_group_specific_month==0)
                                     {
                                         alert("Please enter fee group specific month/annual");
                                         document.getElementById("other_fee_group_specific_month_"+ij).focus();
                                         return false;
                                     }else
                                         if(other_fee_group_sub_total==0)
                                             {
                                             alert("Please enter fee group sub total amount");
                                             return false;    
                                             }else
                                                 if(isNaN(other_fee_group_sub_total))
                                             {
                                             alert("Please enter only numeric value");
                                             return false;    
                                             }else
                                         if(other_fee_group_total_amount==0)
                                             {
                                                alert("Please enter fee group total amount");
                                                return false;
                                             }
                                             }
                                             }    
        
var r=confirm("Are you sure you want to pay fees");
if (r==true)
  { 
    
var r=confirm("Fee Payment Details :\n\
____________________________________\n\
\n\
     Amount Payable         "+payable_amount+" \n\
     \n\
     Amount Paid             "+paid_amount+"\n\
     Due Amount              "+due_amount+"\n\
\n\
_______________________________________");
if (r==true)
  { 
      
  }else
  {
  return false;
  }
  }else
  {
  return false;
  }
     
  
  }
    
    
    
  
  
    }else
    {
      alert("Select atleast one month/annual/term fee"); 
       return false;
    }
  
  
}