
function account_payment_details()
{
  var organization_id=document.getElementById("org_id").value;
  var branch_id=document.getElementById("branch_id").value;
  var session_id=document.getElementById("session_id").value;
  var currency=document.getElementById("currency_id").value;
  var account_from_date=document.getElementById("account_from").value;
  var account_to_date=document.getElementById("account_to").value;
   if((organization_id==0)||(branch_id==0)||(session_id==0)||(currency==0))
   {
      alert("Record missing,Please try again");
      return false;
   }else
       if(account_from_date==0)
   {
    alert("Please fill FROM date");
    document.getElementById("account_from").focus();
    return false;
   }else
       if(account_to_date==0)
   {
    alert("Please fill TO date");
    document.getElementById("account_to").focus();
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
  document.getElementById("account_ledger_show").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         document.getElementById("ajax_loader_show").style.display="none";
         alert("data loss,please try again");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="dashboard_ajax_code.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&currency="+currency+"&&session_id="+session_id+"&&account_from_date="+account_from_date+"&&account_to_date="+account_to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);    
    
   }   
}