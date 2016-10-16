
function window_load()
{
 var hashValue = location.hash;  
  button_no = hashValue.replace(/^#/, ''); 
  if(button_no!=0)
  {
      
      
    for(var i=1;i<=10;i++)
 {
   if(document.getElementById("button_active_"+i))
   {
    document.getElementById("button_active_"+i).style.backgroundColor="dodgerblue";
   document.getElementById("button_active_"+i).style.borderBottom="1px solid black";
   document.getElementById("button_active_"+i).style.color="white";
   document.getElementById("button_active_"+i).style.paddingTop="10px";
   document.getElementById("filter_show_div_"+i).style.display="none";
   
   }
 }
 
 document.getElementById("cash_master_data").innerHTML=" ";
 document.getElementById("button_active_"+button_no).style.backgroundColor="white";
   document.getElementById("button_active_"+button_no).style.borderBottom="0px";
   document.getElementById("button_active_"+button_no).style.color="black";
   document.getElementById("button_active_"+button_no).style.paddingTop="11px";
 document.getElementById("filter_show_div_"+button_no).style.display="block";  
  }
  
  
        }
window.onload=window_load;



//button function
function button_function(button_no)
{
 
   
 for(var i=1;i<=10;i++)
 {
   if(document.getElementById("button_active_"+i))
   {
    document.getElementById("button_active_"+i).style.backgroundColor="dodgerblue";
   document.getElementById("button_active_"+i).style.borderBottom="1px solid black";
   document.getElementById("button_active_"+i).style.color="white";
   document.getElementById("button_active_"+i).style.paddingTop="10px";
   document.getElementById("filter_show_div_"+i).style.display="none";
   
   }
 }
 
 document.getElementById("cash_master_data").innerHTML=" ";
 document.getElementById("button_active_"+button_no).style.backgroundColor="white";
   document.getElementById("button_active_"+button_no).style.borderBottom="0px";
   document.getElementById("button_active_"+button_no).style.color="black";
   document.getElementById("button_active_"+button_no).style.paddingTop="11px";
 document.getElementById("filter_show_div_"+button_no).style.display="block";
}



//fee group search
function fee_group_search()
{
    
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
var currency=document.getElementById("currency").value;
var from_date=document.getElementById("from_date_1").value;
var to_date=document.getElementById("to_date_1").value;
var fee_group_id=document.getElementById("fee_group_id").value;

if((organization_id==0)||(branch_id==0)||session_id==0||currency==0)
{
    alert("Please fill all fields");
    return false;
}else
    if((from_date==0||to_date==0)&&(fee_group_id==0))
{
  alert("Please select atleast one option");
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
   document.getElementById("cash_master_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
      document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="finance_cash_master_ajax_code.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&currency="+currency+"&&session_id="+session_id+"&&fee_group_id="+fee_group_id+"&&from_date="+from_date+"&&page_no=1&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
        
        
}   
}

//due balance summary
function due_amount_search()
{
 var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
var currency=document.getElementById("currency").value;
var from_date=document.getElementById("from_date_2").value;
var to_date=document.getElementById("to_date_2").value;
var student_id=document.getElementById("student_id").value;

if((organization_id==0)||(branch_id==0)||session_id==0||currency==0)
{
    alert("Please fill all fields");
    return false;
}else
    if((from_date==0||to_date==0)&&(student_id==0))
{
  alert("Please select atleast one option");
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
   document.getElementById("cash_master_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
      document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="finance_cash_master_ajax_code.php";
url=url+"?due_org_id="+organization_id+"&&due_branch_id="+branch_id+"&&currency="+currency+"&&due_session_id="+session_id+"&&student_id="+student_id+"&&from_date="+from_date+"&&page_no=1&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
        
        
}   
}





//pending balance summary

function pending_balance_search()
{
 
 var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
var currency=document.getElementById("currency").value;
var from_date=document.getElementById("from_date_8").value;
var to_date=document.getElementById("to_date_8").value;

if((organization_id==0)||(branch_id==0)||session_id==0||currency==0)
{
    alert("Please fill all fields");
    return false;
}else
    if((from_date==0||to_date==0))
{
  alert("Please enter from date or to date");
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
   document.getElementById("cash_master_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
      document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="finance_cash_master_ajax_code.php";
url=url+"?pending_bal_org_id="+organization_id+"&&pending_bal_branch_id="+branch_id+"&&currency="+currency+"&&pending_bal_session_id="+session_id+"&&from_date="+from_date+"&&page_no=1&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
        
        
}      
    
}





//account search
function account_search()
{
    
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
var currency=document.getElementById("currency").value;
var from_date=document.getElementById("from_date_5").value;
var to_date=document.getElementById("to_date_5").value;
var account_group_id=document.getElementById("account_group_id").value;

var income_checked=document.getElementById("income_value").checked;
var expense_checked=document.getElementById("expense_value").checked;

if(income_checked==true)
{
 var income_value=document.getElementById("income_value").value;  
}else
 if(expense_checked==true)
{
 var income_value=document.getElementById("expense_value").value;   
}


if((organization_id==0)||(branch_id==0)||session_id==0||currency==0)
{
    alert("Please fill all fields");
    return false;
}else
    if((from_date==0||to_date==0)&&(account_group_id==0))
{
  alert("Please select atleast one option");
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
   document.getElementById("cash_master_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
      document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="finance_cash_master_ajax_code.php";
url=url+"?account_org_id="+organization_id+"&&account_branch_id="+branch_id+"&&currency="+currency+"&&account_session_id="+session_id+"&&account_type="+income_value+"&&account_group_id="+account_group_id+"&&from_date="+from_date+"&&page_no=1&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
        
        
}   
}



//income summary

function income_search()
{
   
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
var currency=document.getElementById("currency").value;
var from_date=document.getElementById("from_date_6").value;
var to_date=document.getElementById("to_date_6").value;

if((organization_id==0)||(branch_id==0)||session_id==0||currency==0)
{
    alert("Please fill all fields");
    return false;
}else
    if((from_date==0||to_date==0))
{
  alert("Please select atleast one option");
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
   document.getElementById("cash_master_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
      document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="finance_cash_master_ajax_code.php";
url=url+"?income_org_id="+organization_id+"&&income_branch_id="+branch_id+"&&currency="+currency+"&&income_session_id="+session_id+"&&from_date="+from_date+"&&page_no=1&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
        
        
}       
}



//expense search
function expense_search()
{
       
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
var currency=document.getElementById("currency").value;
var from_date=document.getElementById("from_date_7").value;
var to_date=document.getElementById("to_date_7").value;

if((organization_id==0)||(branch_id==0)||session_id==0||currency==0)
{
    alert("Please fill all fields");
    return false;
}else
    if((from_date==0||to_date==0))
{
  alert("Please select atleast one option");
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
   document.getElementById("cash_master_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
      document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="finance_cash_master_ajax_code.php";
url=url+"?expense_org_id="+organization_id+"&&expense_branch_id="+branch_id+"&&currency="+currency+"&&expense_session_id="+session_id+"&&from_date="+from_date+"&&page_no=1&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
        
        
}
}

//balance sheet
function balance_sheet_search()
{
        
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
var currency=document.getElementById("currency").value;
var from_date=document.getElementById("from_date_9").value;
var to_date=document.getElementById("to_date_9").value;

if((organization_id==0)||(branch_id==0)||session_id==0||currency==0)
{
    alert("Please fill all fields");
    return false;
}else
    if((from_date==0||to_date==0))
{
  alert("Please select atleast one option");
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
   document.getElementById("cash_master_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
      document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="finance_cash_master_ajax_code.php";
url=url+"?bal_sheet_org_id="+organization_id+"&&bal_sheet_branch_id="+branch_id+"&&currency="+currency+"&&bal_sheet_session_id="+session_id+"&&from_date="+from_date+"&&page_no=1&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
        
        
}   
}



//cash master
function day_book_search()
{
        
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
var currency=document.getElementById("currency").value;
var from_date=document.getElementById("to_date_4").value;
var to_date=document.getElementById("to_date_4").value;

if((organization_id==0)||(branch_id==0)||session_id==0||currency==0)
{
    alert("Please fill all fields");
    return false;
}else
    if((from_date==0||to_date==0))
{
  alert("Please select atleast one option");
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
   document.getElementById("cash_master_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
      document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="finance_cash_master_ajax_code.php";
url=url+"?day_book_org_id="+organization_id+"&&day_book_branch_id="+branch_id+"&&currency="+currency+"&&day_book_session_id="+session_id+"&&from_date="+from_date+"&&page_no=1&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);        
        
        
}   
}