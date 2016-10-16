
   function delete_data(delete_tr_name,page_command)
   {
       
            var school_id=document.getElementById("school_id").value;
            var branch_id=document.getElementById("branch_id").value;
            var admin_id=document.getElementById("admin_id").value;
            var current_session_id=document.getElementById("session_unique_id").value;
       
    if(school_id==0 || branch_id==0 || admin_id==0 || current_session_id==0)
    {
     alert("Sorry,Technical Problem,Please Contact IT Team");
     return false;
    }else   
    if(delete_tr_name==0)
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
   if(httpxml.responseText==0)
   {
     alert("Sorry,Request failed,Please try again later");
    return false;  
   }else
   if(httpxml.responseText==2)
   {
     alert("Please first change working academic session year");
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
  
var url="delete_ajax_code.php";
url=url+"?"+page_command+"="+delete_tr_name+"&get_school_id="+school_id+"&get_branch_id="+branch_id+"&get_admin_id="+admin_id+"&get_session_id="+current_session_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
   
  } 
  }
  }
 