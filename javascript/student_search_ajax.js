
  //normal search
  function normal_search()
  {
   document.getElementById("normal_search_id").style.display="block";
   document.getElementById("advance_div").style.display="none";
  }
  
  //advance search
  function advance_search()
  {
  
   document.getElementById("advance_div").style.display="block";
   document.getElementById("normal_search_id").style.display="none";
   
  }
  
  
  //student full show record
  
  function student_full_details(student_admission_id,student_db_id)
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
  
var url="search_ajax_code.php";
url=url+"?student_admission_id="+student_admission_id+"&student_db_id="+student_db_id+"";
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
  
  //account inactive
  
 function inactive_account(account_student_admission_id,student_db_id,account_status)
 {
 var r=confirm("Are you sure you want to "+account_status+" account");
if (r==true)
  { 
var organization_id=document.getElementById("organization_id").value;
var branch_id=document.getElementById("branch_id").value;
var session_id=document.getElementById("insert_session_id").value;
if((organization_id==0)&&(branch_id==0)&&(session_id==0))
    {
     alert("Please enter organization,Branch,Session id,Please reload page"); 
    return false;  
    }else
if(account_student_admission_id==0)
    {
    alert("Student record missing");
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
   document.getElementById("full_student_data").style.display="none";   
   document.getElementById("student_record_data").style.display="block";
   document.getElementById("full_student_data").innerHTML="";
  
var delete_student_id=account_student_admission_id+"_db_"+student_db_id;
   if(account_status=="inactive")
       {
         document.getElementById("delete_row_"+delete_student_id).style.backgroundColor="#FFFFB2";
    
       }else
           if(account_status=="active")
               {
                 document.getElementById("delete_row_"+delete_student_id).style.backgroundColor="white";
    
               }
 document.getElementById("ajax_loader_show").style.display="none";              
     }else
         {
          document.getElementById("ajax_loader_show").style.display="none";    
          alert("Sorry request failed,please try again");
          return false;
          }
      }else
          {
        document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="search_delete_ajax_code.php";
url=url+"?student_admission_no="+account_student_admission_id+"&account_status="+account_status+"&student_db_ids="+student_db_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);   
 }
 }
 }
 
 
 
 
 
 function delete_data(student_admission_id,student_db_id,delete_command)
 {
 var r=confirm("Are you sure you want to delete data");
if (r==true)
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
if(student_admission_id==0)
    {
    alert("Student record missing");
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
   
   document.getElementById("full_student_data").style.display="none";   
   document.getElementById("student_record_data").style.display="block";
   document.getElementById("full_student_data").innerHTML="";
   
  var delete_student_id=student_admission_id+"_db_"+student_db_id;
  document.getElementById("ajax_loader_show").style.display="none";        
  document.getElementById("delete_row_"+delete_student_id).style.display="none";
 alert("Reocrd Delete Successfully Complete");
    }else
         {
          document.getElementById("ajax_loader_show").style.display="none";    
          alert("Sorry request failed,please try again");
          return false;
          }
      }else
          {
        document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="search_delete_ajax_code.php";
url=url+"?delete_student_admission_no="+student_admission_id+"&student_db_id="+student_db_id+"&get_school_id="+school_id+"&get_branch_id="+branch_id+"&get_admin_id="+admin_id+"&get_session_id="+current_session_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);   
 }
 }
 }