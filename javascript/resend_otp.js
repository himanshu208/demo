
   function resend_otp_password()
   {
     
    var otp_unqiue_id=document.getElementById("otp_unqiue_id").value;  
    if(otp_unqiue_id==0)
   {
      alert("Please fill all fields.")
      return false;
   }else
   {

var r=confirm("Are you sure you want to resend one time password (OTP)");
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
   
   document.getElementById("resned_notify").innerHTML="resend";
   }else
   if(httpxml.responseText==2)
   {
     alert("Sorry,Request failed,Please try again later");
         return false;  
   }else
   if(httpxml.responseText==3)
   {
     alert("Sorry,technical problem,please try again");
         return false;  
   }
   
     }else
     {
         document.getElementById("ajax_loader_show").style.display="none";
   
         alert("Sorry,Request failed,Please try again later");
         return false;
         
         
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="otp_ajax_code.php";
url=url+"?token_id="+otp_unqiue_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
 