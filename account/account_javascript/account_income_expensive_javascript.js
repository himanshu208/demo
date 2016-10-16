function account_type(account_type_name)
{
if(account_type_name!=0)
    {
     
     var org_id=document.getElementById("organization_id").value;
     var branch_id=document.getElementById("branch_id").value;
     var session_id=document.getElementById("insert_session_id").value;
     if((org_id==0)&&(branch_id==0)&&(session_id==0))
         {
         alert("Sorry,Organization,Branch,Session Data missing");
         return false;
         }else
         {
     
        if(account_type_name=="income")
        {
         document.getElementById("dipositor_details").style.display="block";
         document.getElementById("expanse_more_details").style.display="none";   
        }else
         if(account_type_name=="expense")
         {
         document.getElementById("dipositor_details").style.display="none";
         document.getElementById("expanse_more_details").style.display="block";   
         }
            
            
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
   
   document.getElementById("select_acount_head").innerHTML=httpxml.responseText;
  
     }
     }
    } 
  
var url="pay_ajax_code_one.php";
url=url+"?org_id="+org_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&account_type="+account_type_name;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);  
           
           
         }
     
     
     
    }else
        {
         alert("Sorry request failed,please try again");
         return false;
        }
}




//account group name
function account_group_name(account_group_id)
{
     var org_id=document.getElementById("organization_id").value;
     var branch_id=document.getElementById("branch_id").value;
     var session_id=document.getElementById("insert_session_id").value;
    
    if(account_group_id!=0)
    {
    if((org_id==0)&&(branch_id==0)&&(session_id==0))
         {
         alert("Sorry,Organization,Branch,Session Data missing");
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
   
   document.getElementById("account_name").innerHTML=httpxml.responseText;
  
     }
     }
    } 
  
var url="pay_ajax_code_one.php";
url=url+"?org_id="+org_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&account_group_id="+account_group_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);  
            
            
            
         }
     }else
        {
         alert("Sorry request failed,please try again");
         return false;
        }    
}



//payment mode
function payment_mode(payment_mode)
{
   if(payment_mode=="cash")
   {
    document.getElementById("show_cheque_and_dd_details").style.display="none"; 
    document.getElementById("amount").readOnly=false;
   document.getElementById("amount").style.backgroundColor="white";
   }else
   {
   document.getElementById("show_cheque_and_dd_details").style.display="block";  
   document.getElementById("amount").readOnly=true;
   document.getElementById("amount").style.backgroundColor="whitesmoke";
   }
}


//amount value
function amount_value(amount_value)
{
   if(isNaN(amount_value))
   {
     alert("Enter only numeric value");
     document.getElementById("amount").value="";
     document.getElementById("amount").focus();
     return false;
   }
    
    
}

//cheque dd amount
function cheque_dd_amount(cheque_dd_amount)
{
  if(isNaN(cheque_dd_amount))
  {
   alert("Please enter only numeric value");
   document.getElementById("chequeddamount").value="";
   document.getElementById("amount").value="";
   document.getElementById("chequeddamount").focus();
   return false;
  }else
  {
    document.getElementById("amount").value=cheque_dd_amount; 
  }
}