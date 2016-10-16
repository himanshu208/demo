
function validateForm(frm)
   {
    var fee_id=document.getElementById("selectfeename").value;
    var fee_type=document.getElementById("selectfeegrouptype").value;
    var fee_group_id=document.getElementById("feegroupname").value;
    var fine_amount=document.getElementById("fineamount").value;
    var fees_amount=document.getElementById("feeamount").value;
    var transport_hostel_on=document.getElementById("fee_transport_hostel_active").value;
    var class_type=document.getElementById("class_type_radio").checked;
    var student_type=document.getElementById("student_type_radio").checked;
    
  var destCount = frm.elements['classvalue[]'].length;
var destSel   = false;
for(i = 0; i < destCount; i++){
if(frm.elements['classvalue[]'][i].checked){
destSel = true;
break;
}
}
    if(fee_id==0)
        {
           alert("Please select fee");
           document.getElementById("selectfeename").focus();
           return false;
        }else
            if(fee_type==0)
        {
           alert("Please select fee type");
           document.getElementById("selectfeegrouptype").focus();
           return false;
        }else
            if(fee_group_id==0)
        {
           alert("Please select fee group");
           document.getElementById("feegroupname").focus();
           return false;
        }else
            if(class_type==true)
        {
if(!destSel){
alert('Select atleast one class/course');
return false;
}
    
    }else
    if(student_type==true)
     {
     var student_name=document.getElementById("student_id").value;  
     if(student_name==0)
     {
      alert("Please select student");
      return false;
     }
    }else
       if(fine_amount=="")
        {
           alert("Please select fee group");
             document.getElementById("fineamount").focus();
           return false;
        }else
            if(isNaN(fine_amount))
        {
           alert("Please enter only numeric value");
             document.getElementById("fineamount").focus();
           return false;
        }else
            if(fees_amount=="")
        {
           alert("Please select fee group");
             document.getElementById("feeamount").focus();
           return false;
        }else
            if((isNaN(fees_amount))&&(transport_hostel_on==0))
        {
           alert("Please enter only numeric value");
             document.getElementById("feeamount").focus();
           return false;
        }
      }
      
      
      function fee_name_type(fee_type)
{
   
   var fee_id=document.getElementById("selectfeename").value;
   var organization_id=document.getElementById("organization_id").value;
   var branch_id=document.getElementById("branch_id").value;
   var session_id=document.getElementById("insert_session_id").value;
   if((fee_id==0)||(organization_id==0)||(branch_id==0)||(session_id==0))
       {
        alert("Please first select fee");
       document.getElementById("zero").selected=true;
       document.getElementById("selectfeename").focus();
        return false;
       }else
           {
var httpxml;   
if((fee_id==0)||(fee_type==0))
    {
     document.getElementById("fee_zero").selected=true;
     document.getElementById("feegroupname").innerHTML="<option  value='0'>--Select fee group --</option>";
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
   document.getElementById("feegroupname").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
         document.getElementById("ajax_loader_show").style.display="none";    
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
          }} 
var url="financeajaxcode.php";
url=url+"?org_id="+organization_id+"&&fee_type="+fee_type+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&fee_id="+fee_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);  
           }
}
