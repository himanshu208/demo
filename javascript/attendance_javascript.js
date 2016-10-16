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
 var student_temp_data="<select id='student_id' data-placeholder='---Select---' class='chosen-select' tabindex='-1'><option value='0'></option></select>";
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
    var student_temp_data="<select id='student_id' data-placeholder='---Select---' class='chosen-select' tabindex='-1'><option value='0'></option><option value='0'>Record no found</option></select>";
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
                 
                 
                 
                 //select continue
 function continue_button()
 {
   
 var class_id=document.getElementById("class_course_id").value;
 var section_id=document.getElementById("section_name").value;
 var attendance_date=document.getElementById("attendance_date").value;
 if(class_id==0)
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
 {
     document.getElementById("ajax_loader_show").style.display="block";     
   window.location.assign("mark_attendance.php?Xmlhtppclass="+class_id+"&&Xmlhttpsection="+section_id+"&&xmlhttp_dt="+attendance_date+"");   
 }
 }
 
 //attendance send sms 
 
 function send_continue_button()
 {
   
 var class_id=document.getElementById("class_course_id").value;
 var section_id=document.getElementById("section_name").value;
 var attendance_date=document.getElementById("attendance_date").value;
 if(class_id==0)
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
 {
     document.getElementById("ajax_loader_show").style.display="block";     
   window.location.assign("send_attendance_sms.php?Xmlhtppclass="+class_id+"&&Xmlhttpsection="+section_id+"&&xmlhttp_dt="+attendance_date+"");   
 }
 }
 
 
 //edit attendance 
 
 function edit_continue_button()
 {
   
 var class_id=document.getElementById("class_course_id").value;
 var section_id=document.getElementById("section_name").value;
 var attendance_date=document.getElementById("attendance_date").value;
 if(class_id==0)
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
 {
     document.getElementById("ajax_loader_show").style.display="block";     
   window.location.assign("modify_attedance.php?Xmlhtppclass="+class_id+"&&Xmlhttpsection="+section_id+"&&xmlhttp_dt="+attendance_date+"");   
 }
 }
 
 
 
 
 //search button attendance report
 function search_button()
 {
 var class_course_id=document.getElementById("class_course_id").value;
 var section_id=document.getElementById("section_name").value;
 var from_date=document.getElementById("from_date").value;
 var to_date=document.getElementById("to_date").value;     
 var student_id=document.getElementById("student_id").value; 
 var result_option=document.getElementById("result_this_by").value; 
 var result_value=document.getElementById("result_value").value; 
        
if(class_course_id==0)
{
   alert("Please select class");
   document.getElementById("class_course_id").focus();
   return false;
}else
    if(section_id==0)
{
   alert("Please select section");
   document.getElementById("section_name").focus();
   return false;
}else
    if(from_date==0)
{
    alert("Please enter date from");
    document.getElementById("from_date").focus();
    return false;
}else
    if(to_date==0)
{
   alert("Please enter date to");
   document.getElementById("to_date").focus();
   return false;
}else
{
      document.getElementById("ajax_loader_show").style.display="block";    
  window.location.assign("attendance_report.php?Xmlhtppclass="+class_course_id+"&&Xmlhttpsection="+section_id+"&&Xmlfromd="+from_date+"&&Xmltod="+to_date+"&Xmlhtppstudentid="+student_id+"&Xmlhtppresultoption="+result_option+"&Xmlhtppresultvalue="+result_value+"");     
}
 
 
 }
 
 //search button attendance register
 
 function register_search_button()
 {
 var class_course_id=document.getElementById("class_course_id").value;
 var section_id=document.getElementById("section_name").value;
 var from_date=document.getElementById("from_date").value;
 var to_date=document.getElementById("to_date").value;     
 var student_id=document.getElementById("student_id").value; 
 var result_option=document.getElementById("result_this_by").value; 
 var result_value=document.getElementById("result_value").value; 
 var student_id=document.getElementById("student_id").value;      
if(class_course_id==0)
{
   alert("Please select class");
   document.getElementById("class_course_id").focus();
   return false;
}else
    if(section_id==0)
{
   alert("Please select section");
   document.getElementById("section_name").focus();
   return false;
}else
    if(from_date==0)
{
    alert("Please enter date from");
    document.getElementById("from_date").focus();
    return false;
}else
    if(to_date==0)
{
   alert("Please enter date to");
   document.getElementById("to_date").focus();
   return false;
}else
if(student_id==0)
{
 alert("Please select student");
   document.getElementById("student_id").focus();
   return false;   
}else
{
      document.getElementById("ajax_loader_show").style.display="block";    
  window.location.assign("attendance_register.php?Xmlhtppclass="+class_course_id+"&&Xmlhttpsection="+section_id+"&&Xmlfromd="+from_date+"&&Xmltod="+to_date+"&Xmlhtppstudentid="+student_id+"&Xmlhtppresultoption="+result_option+"&Xmlhtppresultvalue="+result_value+"");     
}
 
 
 }
 
 //student prsent
 function prsent_status(student_id)
 {
     
    $('input:radio').change(function(){
        var prsent = $('.td_attendance_check_box_p:checked').length;
        var absent = $('.td_attendance_check_box_a:checked').length;
        var leave=$('.td_attendance_check_box_l:checked').length;
        var late=$('.td_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });   
     
  document.getElementById("attendance_color_"+student_id).style.backgroundColor="#E0FFD1";
  document.getElementById("attendance_color_"+student_id).style.color="black";
  
  var total_working_day=new Number(document.getElementById("total_working_day_"+student_id).value);
  var total_prsent_student=new Number(document.getElementById("prsent_allendance_"+student_id).value);
  var total_leave_student=new Number(document.getElementById("leave_allendance_"+student_id).value);
  var leave_count_attendance=new Number(document.getElementById("leave_count_attendance_"+student_id).value);
  
  var leave_divided=new Number(total_leave_student/leave_count_attendance);
  var add_one_prsent_attendance=new Number(total_prsent_student+1);
  
  var total_attendance_count=new Number(add_one_prsent_attendance+leave_divided);
  
  var aggrigate_attendance=new Number(total_attendance_count*100/total_working_day);
  
  document.getElementById("student_attendance_aggrigate_"+student_id).innerHTML=aggrigate_attendance.toFixed(2)+"%";
 
 }
 
 //student absent
 
  $("input:radio[class=td_attendance_check_box_a]").click(function(){
      var value = $(this).attr("id");
      alert(value);
})
 
 function absent_status(student_id)
 {
 
    $('input:radio').change(function(){
        var prsent = $('.td_attendance_check_box_p:checked').length;
        var absent = $('.td_attendance_check_box_a:checked').length;
        var leave=$('.td_attendance_check_box_l:checked').length;
        var late=$('.td_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    }); 
     
    
     
  document.getElementById("attendance_color_"+student_id).style.backgroundColor="#FFE6E6";
  document.getElementById("attendance_color_"+student_id).style.color="black";
  
  
  var total_working_day=new Number(document.getElementById("total_working_day_"+student_id).value);
  var total_prsent_student=new Number(document.getElementById("prsent_allendance_"+student_id).value);
  var total_leave_student=new Number(document.getElementById("leave_allendance_"+student_id).value);
  var leave_count_attendance=new Number(document.getElementById("leave_count_attendance_"+student_id).value);
  
  var leave_divided=new Number(total_leave_student/leave_count_attendance);
  var add_one_prsent_attendance=new Number(total_prsent_student);
  
  var total_attendance_count=new Number(add_one_prsent_attendance+leave_divided);
  
  var aggrigate_attendance=new Number(total_attendance_count*100/total_working_day);
  
  document.getElementById("student_attendance_aggrigate_"+student_id).innerHTML=aggrigate_attendance.toFixed(2)+"%";
 
  
 }
 
 
 //student leave
 
 function leave_status(student_id)
 {
   
   $('input:radio').change(function(){
        var prsent = $('.td_attendance_check_box_p:checked').length;
        var absent = $('.td_attendance_check_box_a:checked').length;
        var leave=$('.td_attendance_check_box_l:checked').length;
        var late=$('.td_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });    
     
  document.getElementById("attendance_color_"+student_id).style.backgroundColor="#FFFFCC";
  document.getElementById("attendance_color_"+student_id).style.color="black";
  
  var total_working_day=new Number(document.getElementById("total_working_day_"+student_id).value);
  var total_prsent_student=new Number(document.getElementById("prsent_allendance_"+student_id).value);
  var total_leave_student=new Number(document.getElementById("leave_allendance_"+student_id).value);
  var leave_count_attendance=new Number(document.getElementById("leave_count_attendance_"+student_id).value);
  
  var add_one_leave=new Number(total_leave_student+1);
  var leave_divided=new Number(add_one_leave/leave_count_attendance);
  var add_one_prsent_attendance=new Number(total_prsent_student);
  
  var total_attendance_count=new Number(add_one_prsent_attendance+leave_divided);
  
  var aggrigate_attendance=new Number(total_attendance_count*100/total_working_day);
  
  document.getElementById("student_attendance_aggrigate_"+student_id).innerHTML=aggrigate_attendance.toFixed(2)+"%";
 
  
 }
 
 
 //school leave
 
 function school_leave_status(student_id)
 {
    $('input:radio').change(function(){
        var prsent = $('.td_attendance_check_box_p:checked').length;
        var absent = $('.td_attendance_check_box_a:checked').length;
        var leave=$('.td_attendance_check_box_l:checked').length;
        var late=$('.td_attendance_check_box_lt:checked').length;        
        $('#total_present').text(prsent);
        $('#total_absent').text(absent);     
         $('#total_leave').text(leave);     
          $('#total_late').text(late);     
    });   
     
     
  document.getElementById("attendance_color_"+student_id).style.backgroundColor="#CCD6E0";
  document.getElementById("attendance_color_"+student_id).style.color="black";
  
   var total_working_day=new Number(document.getElementById("total_working_day_"+student_id).value);
  var total_prsent_student=new Number(document.getElementById("prsent_allendance_"+student_id).value);
  var total_leave_student=new Number(document.getElementById("leave_allendance_"+student_id).value);
  var leave_count_attendance=new Number(document.getElementById("leave_count_attendance_"+student_id).value);
  
  var leave_divided=new Number(total_leave_student/leave_count_attendance);
  var add_one_prsent_attendance=new Number(total_prsent_student+1);
  
  var total_attendance_count=new Number(add_one_prsent_attendance+leave_divided);
  
  var aggrigate_attendance=new Number(total_attendance_count*100/total_working_day);
  
  document.getElementById("student_attendance_aggrigate_"+student_id).innerHTML=aggrigate_attendance.toFixed(2)+"%";
 
 }
 
 
 
 