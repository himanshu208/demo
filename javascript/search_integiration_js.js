function class_course_ajax_id(class_id)
 {        
     
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;

if((organization_id==0)&&(branch_id==0)&&(session_id==0))
    {
     alert("Please enter organization,Branch,Session id,Please reload page"); 
    return false;  
    }else
  
if((class_id==0))
    {
    return false;
    }else
        {
var httpxml; 
$("#admission_no").val(''); 
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
     
     var section_data=httpxml.responseText;
     
     
     
     alert(httpxml.responseText);
     }else
         {
         document.getElementById("ajax_loader_show").style.display="none";    
          }
      }else
          {
        document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="../search_integration/lib_search_ajax_code.php";
url=url+"?class_id="+class_id+"&&org_id="+organization_id+"&&page_no=1&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
 }