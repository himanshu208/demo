
   function parent_full_details(parent_id,page_command)
   {
        
    if(parent_id==0)
   {
      alert("sorry technical problem,please try again")
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
   
   document.getElementById("ajax_loader_show").style.display="none";
   if(httpxml.responseText==0)
   {
       
     alert("Sorry,Request failed,Please try again later");
    return false;  
   }else
   if(httpxml.responseText==2)
   {
     alert("Please first change working academic session year");
       return false;  
   }else
   {
     document.getElementById("parent_list").style.display="none"; 
     document.getElementById("parent_full_details").style.display="block"; 
     document.getElementById("parent_full_details").innerHTML=httpxml.responseText;
           
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
  
var url="parent_ajax_code.php";
url=url+"?"+page_command+"="+parent_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  }
  }
 