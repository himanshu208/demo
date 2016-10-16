 //select class id
 
 
 function class_id(class_id)
 {   
 
var httpxml;   
if((class_id==0))
    {
      return false;
    }
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
 document.getElementById("section_name").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
           document.getElementById("section_name").innerHTML="<option value='0'>Record no found !!</option>";
             document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="../admission/ajax_code.php";
url=url+"?class_id="+class_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
                 
                 
                 
                 //section to fetch student 
                 
function section_change(section_id)
 {   

var httpxml; 
var class_id=document.getElementById("class_course_id").value;
if((class_id==0))
    {
        alert("Please first select class/course");
      return false;
    }else
        if(section_id==0)
    {
       return false; 
    }
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
 var student_temp_data="<select id='student_id' multiple data-placeholder='---Select---' class='chosen-select' tabindex='-1'><option value='0'></option></select>";
    document.getElementById("temp_student_list").innerHTML=student_temp_data;       
    document.getElementById("student_id").innerHTML=httpxml.responseText;        
          
    var config = {
      '.chosen-select'           : {},
      '.chosen-select-deselect'  : {allow_single_deselect:true},
      '.chosen-select-no-single' : {disable_search_threshold:10},
      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
      '.chosen-select-width'     : {width:"100%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }       
    document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
    var student_temp_data="<select id='student_id' multiple data-placeholder='---Select---' class='chosen-select' tabindex='-1'><option value='0'></option><option value='0'>Record no found</option></select>";
    document.getElementById("temp_student_list").innerHTML=student_temp_data;       
     document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?student_of_class_id="+class_id+"&student_of_section_id="+section_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
              