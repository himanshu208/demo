 //employee full show record
  
  function employee_full_details(student_admission_id,student_db_id)
  {

   document.getElementById("full_student_data").style.display="none";   
   document.getElementById("student_record_data").style.display="block";
   document.getElementById("full_student_data").innerHTML="";
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
if((organization_id==0)&&(branch_id==0)&&(session_id==0))
    {
     alert("Please enter organization,Branch,Session id,Please reload page"); 
    return false;  
    }else 
     if((student_admission_id==0)) 
      {
       alert("Missing data");
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
   document.getElementById("student_record_data").style.display="none";  
   document.getElementById("full_student_data").style.display="block";
   document.getElementById("full_student_data").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
  
    
      }else
          {
        document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="employee_ajax_code.php";
url=url+"?employee_admission_id="+student_admission_id+"&employee_db_id="+student_db_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
          }
      
      
      
  }
  
  
  
  //back button
  function  back_button()
  {
   document.getElementById("full_student_data").style.display="none";   
   document.getElementById("student_record_data").style.display="block";
   document.getElementById("full_student_data").innerHTML="";
  }