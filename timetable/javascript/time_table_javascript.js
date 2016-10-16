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
                 
                 

function continue_button()
{
    
 var class_course_id=document.getElementById("class_course_id").value;
 var section_id=document.getElementById("section_name").value;
 var time_table_name=document.getElementById("time_table_name").value;
 
    if(class_course_id==0)
    {
      alert("Please select class/course");
      document.getElementById("class_course_id").focus();
      return false;
    }else
        if(section_id==0)
    {
       alert("Please select section");
       document.getElementById("section_name").focus();
       return false;
    }else
    if(time_table_name==0)
{
    alert("Please enter time table name");
    document.getElementById("time_table_name").focus();
    return false;
}else
    {
 document.getElementById("time_table_pop_up_1").style.display="block";           
    } 
}

function close_pop_up()
{
 document.getElementById("time_table_pop_up_1").style.display="none";        
   
}




function next_button()
{
document.getElementById("time_table_pop_up_1").style.display="none";        
document.getElementById("time_table_pop_up_2").style.display="block";        
 
}

function close_pop_up_1()
{
document.getElementById("time_table_pop_up_2").style.display="none";        
document.getElementById("time_table_pop_up_1").style.display="none";   
}



function show_lunch_details()
{
  document.getElementById("lunch_table_id").style.display="block";  
}

function hide_lunch_details()
{
 document.getElementById("lunch_table_id").style.display="none";     
}


function show_time_table()
{
  
 var class_course_id=document.getElementById("class_course_id").value;
 var section_id=document.getElementById("section_name").value;
 var time_table=document.getElementById("time_table").value;
    
 if(class_course_id==0)
 {
  alert("Please select class/course");
  document.getElementById("class_course_id").focus();
  return false;
 }else
   if(section_id==0)
   {
  alert("Please select section");
  document.getElementById("section_name").focus();
  return false;  
   }else
   if(time_table==0)
   {
  alert("Please select time table");
  document.getElementById("time_table").focus();
  return false;  
   }else
   {
 document.getElementById("ajax_loader_show").style.display="block";        
 window.location.assign("view_time_table.php?Xmlhtppclass="+class_course_id+"&Xmlhttpsection="+section_id+"&Xmlhttptimetable="+time_table+"");      
   }
}

//assign subject for lecture

function assign_subject(day,lecture,week_id,lecture_id,start_time,end_time)
{
 document.getElementById("assign_subject_update_id").value="";
 document.getElementById("room_no").value="";
 document.getElementById("note").value="";
 document.getElementById("submit_button_value").value="Save";
 document.getElementById("top_heading_contant").innerHTML="Assign Subject For Lecture/Period";
  document.getElementById("temp_teachers_id").value="";
 document.getElementById("insert_week_id").value=week_id;
 document.getElementById("insert_lecture_id").value=lecture_id;
  document.getElementById("start_time_count").value=start_time;
  document.getElementById("end_time_count").value=end_time;
         
document.getElementById("time_table_pop_up_2").style.display="none";        
document.getElementById("time_table_pop_up_1").style.display="none";     
document.getElementById("time_table_pop_up_3").style.display="block"; 
document.getElementById("day_value").innerHTML=day;
document.getElementById("lecture_value").innerHTML=lecture;
}

function edit_subject(day,lecture,week_id,lecture_id,start_time,end_time,update_db_id,subject_id,teacher_id,room_no,note)
{
 document.getElementById("assign_subject_update_id").value=update_db_id;
 document.getElementById("submit_button_value").value="Update";    
 document.getElementById("top_heading_contant").innerHTML="Edit Assign Subject For Lecture/Period";
 document.getElementById("temp_teachers_id").value=teacher_id;
 document.getElementById("insert_week_id").value=week_id;
 document.getElementById("insert_lecture_id").value=lecture_id;
  document.getElementById("start_time_count").value=start_time;
  document.getElementById("end_time_count").value=end_time;
         
document.getElementById("time_table_pop_up_2").style.display="none";        
document.getElementById("time_table_pop_up_1").style.display="none";     
document.getElementById("time_table_pop_up_3").style.display="block"; 
document.getElementById("day_value").innerHTML=day;
document.getElementById("lecture_value").innerHTML=lecture;

document.getElementById(subject_id).selected=true;
subject_ajax_request(subject_id,teacher_id);
document.getElementById("room_no").value=room_no;
document.getElementById("note").value=note;    
}


function close_pop_up_2()
{
    document.getElementById("insert_week_id").value="";
 document.getElementById("insert_lecture_id").value="";
  
 document.getElementById("time_table_pop_up_2").style.display="none";        
document.getElementById("time_table_pop_up_1").style.display="none";     
document.getElementById("time_table_pop_up_3").style.display="none";

document.getElementById("zero_1").selected=true;
document.getElementById("teacher_id").innerHTML="<option value='0'>---Select---</option>";
          
}


function validate_form()
{
  var subject_id=document.getElementById("subject_id").value;
  var teacher_id=document.getElementById("teacher_id").value;
  if(subject_id==0)
  {
     alert("Please select subject");
     document.getElementById("subject_id").focus();
     return false;
  }else
      if(teacher_id==0)
  {
  alert("Please select Teacher");
     document.getElementById("teacher_id").focus();
     return false;    
  }
  
}


 //subject ajax
 
 
 function subject_ajax_request(subject_id,edit_employee_id)
 {   

var httpxml;   
 var class_id=document.getElementById("insert_class_id").value;
 var week_id=document.getElementById("insert_week_id").value;
 var lecture_id=document.getElementById("insert_lecture_id").value;  
 var start_time=document.getElementById("start_time_count").value;
 var end_time=document.getElementById("end_time_count").value;
 var temp_teacher_id=document.getElementById("temp_teachers_id").value;
if(class_id==0)
{
alert("Please first select class");
return false;
}else
if((subject_id==0)||(week_id==0)||(lecture_id==0))
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
   
 document.getElementById("teacher_id").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";  
   if(document.getElementById(edit_employee_id))
   {
      document.getElementById(edit_employee_id).disabled=false;   
    document.getElementById(edit_employee_id).selected=true;
   }
    temp_teacher_id   
     if(document.getElementById(temp_teacher_id))
   {
      document.getElementById(temp_teacher_id).disabled=false;  
   }
     }else
         {
             
           document.getElementById("teacher_id").innerHTML="<option value='0'>Record no found !!</option>";
             document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
             
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?subject_id="+subject_id+"&xml_class="+class_id+"&week_id="+week_id+"\
&lecture_id="+lecture_id+"&start_time="+start_time+"&end_time="+end_time+"&edit_employee_id="+edit_employee_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
                 
                 //save continue button
                 
                 function save_continue_button()
                 {
     var class_course_id=document.getElementById("class_course_id").value;
 var section_id=document.getElementById("section_name").value;
 var time_table_name=document.getElementById("time_table_name").value;
 
    if(class_course_id==0)
    {
      alert("Please select class/course");
      document.getElementById("class_course_id").focus();
      return false;
    }else
        if(section_id==0)
    {
       alert("Please select section");
       document.getElementById("section_name").focus();
       return false;
    }else
    if(time_table_name==0)
{
    alert("Please enter time table name");
    document.getElementById("time_table_name").focus();
    return false;
}
                     
    var temp_no=new Number(document.getElementById("temp_number").value);       
    var add_one=new Number('1');
    var both_add=temp_no+add_one;
    for(var i=1;i<=both_add;i++)
    {
     if(document.getElementById("lecture_name_"+i+""))
     {
      var subject_name=document.getElementById("lecture_name_"+i+"").value;
      if(subject_name==0)
      {
         alert("Please enter lecture name");
         document.getElementById("lecture_name_"+i+"").focus();
         return false;
      }
     }
     
     if(document.getElementById("start_time_"+i+""))
     {
      var subject_name=document.getElementById("start_time_"+i+"").value;
      if(subject_name==0)
      {
         alert("Please enter lecture start timing");
         document.getElementById("start_time_"+i+"").focus();
         return false;
      }
     }
     
     if(document.getElementById("end_time_"+i+""))
     {
      var subject_name=document.getElementById("end_time_"+i+"").value;
      if(subject_name==0)
      {
         alert("Please enter lecture end timing");
         document.getElementById("end_time_"+i+"").focus();
         return false;
      }
     }
     
     
      
    }
      document.getElementById("ajax_loader_show").style.display="block";    
               
                 }
                 
                 
                 
                 //fetch time table using ajax
                 
                 
                  //select class id
 
 
 function section_ajax(section_id)
 {   
 
var httpxml; 
class_id=document.getElementById("class_course_id").value;
if((class_id==0)||(section_id==0))
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
        
 document.getElementById("time_table").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";    
              
     }else
         {
           document.getElementById("time_table").innerHTML="<option value='0'>Record no found !!</option>";
             document.getElementById("ajax_loader_show").style.display="none";    
              
   
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?xml_class_id="+class_id+"&xml_section_id="+section_id+"";
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
                 
                 
                 
                 
//Delete assign subject
 
function delete_subject(assign_id)
 {  
     
var httpxml;   
if((assign_id==0))
    {
      return false;
    }
    var r=confirm("Are you sure you want to permanently delete");
if (r==true)
  {
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
 document.getElementById("delete_row_"+assign_id+"").style.display="none";
 document.getElementById("show_assign_"+assign_id+"").style.display="block";
   document.getElementById("ajax_loader_show").style.display="none";
   alert("Assign Subject Delete Successfully Complete");
              
     }else
         {
             document.getElementById("ajax_loader_show").style.display="none";    
           }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="ajax_code.php";
url=url+"?time_table_assign_subject_id="+assign_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
                 }
             }
                 