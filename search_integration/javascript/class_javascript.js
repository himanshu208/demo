   function class_change_id(class_id)
   {
   
   if(class_id==0)
   {
  document.getElementById("section_id").innerHTML="<option value='0'>---Select---</option>";  
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
 document.getElementById("section_id").innerHTML=httpxml.responseText;
 document.getElementById("ajax_loader_show").style.display="none";
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
  
var url="../search_integration/ajax_code.php";
url=url+"?class_unique_id="+class_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   }
  }
 