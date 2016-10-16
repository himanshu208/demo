
//change class id
function class_change_id(class_id)
{
    
document.getElementById("student_record_fetch").innerHTML="";
document.getElementById("student_record_fetch").innerHTML='<div class="no_record">Record No Found !!</div>';

document.getElementById("studentperiviousdetails").innerHTML="";
document.getElementById("studentperiviousdetails").innerHTML='<div class="no_record">Record No Found !!</div>';  

document.getElementById("studentsection").innerHTML="<option value='0'>--Select--</option>"

document.getElementById("manuallycollectfeedetails").style.display="none";
document.getElementById("auotomaticallycollectfeedetails").style.display="none";
document.getElementById("manuallyfeegroup").innerHTML="<option id='manually_select_fee_group' value='0'>-- Select fee group --</option>"; 
document.getElementById("zero_select_automatically").selected=true;
   
document.getElementById("collectfeeautomatic").checked=false;   
document.getElementById("collectfeemanually").checked=false;   

    
   var organization_id=document.getElementById("organization_id").value;
   var branch_id=document.getElementById("branch_id").value;
   var session_id=document.getElementById("insert_session_id").value;
   if(class_id==0)
     {
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
   
   document.getElementById("fetch_record").innerHTML=httpxml.responseText;
   var section_data=document.getElementById("section_record").innerHTML;
   document.getElementById("studentsection").innerHTML=section_data;
  
  var student_list_data=document.getElementById("student_data").innerHTML;
  
   var student_temp_data="<select id='student_id' onchange='student_chage(this.value)' data-placeholder='---Select---' class='chosen-select' tabindex='-1'><option value='0'></option></select>";
    document.getElementById("temp_student_list").innerHTML=student_temp_data;       
    document.getElementById("student_id").innerHTML=student_list_data;        
          
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
 
document.getElementById("fetch_record").innerHTML=" "; 
     }else
         {
         document.getElementById("ajax_loader_show").style.display="none";    
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="pay_ajax_code.php";
url=url+"?class_id="+class_id+"&&org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);    
         }
}






function section_change_id(section_id)
{
   
document.getElementById("student_record_fetch").innerHTML="";
document.getElementById("student_record_fetch").innerHTML='<div class="no_record">Record No Found !!</div>';

document.getElementById("studentperiviousdetails").innerHTML="";
document.getElementById("studentperiviousdetails").innerHTML='<div class="no_record">Record No Found !!</div>';
document.getElementById("collectfeeautomatic").checked=false;   
document.getElementById("collectfeemanually").checked=false;   
 
    
   var class_id=document.getElementById("studentclass").value;
   var organization_id=document.getElementById("organization_id").value;
   var branch_id=document.getElementById("branch_id").value;
   var session_id=document.getElementById("insert_session_id").value;
   if((class_id==0)&&(organization_id==0)&&(branch_id==0)&&(session_id==0))
     {
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
  
 document.getElementById("fetch_record").innerHTML=httpxml.responseText;
var student_list_data=document.getElementById("student_data").innerHTML;

var student_temp_data="<select id='student_id' onchange='student_chage(this.value)' data-placeholder='---Select---' class='chosen-select' tabindex='-1'><option value='0'></option></select>";
    document.getElementById("temp_student_list").innerHTML=student_temp_data;       
    document.getElementById("student_id").innerHTML=student_list_data;        
          
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
   document.getElementById("fetch_record").innerHTML=""; 
    document.getElementById("ajax_loader_show").style.display="none"; 
     }else
         {
         document.getElementById("ajax_loader_show").style.display="none";    
         }
      }else
          {
               document.getElementById("ajax_loader_show").style.display="block";    
                  
          }
    } 
  
var url="pay_ajax_code.php";
url=url+"?temp_class_id="+class_id+"&&temp_section_id="+section_id+"&&org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);    
         }
}







function advance_live_autocomplete_search(e,search_live)
{
   
 var organization_id=document.getElementById("organization_id").value;
   var branch_id=document.getElementById("branch_id").value;
   var session_id=document.getElementById("insert_session_id").value;
var search_by=document.getElementById("studentsearchby").value;
if((search_by==0))
    {
       alert("Please first select search by");
       document.getElementById("studentsearchby").focus();
       return false;
    }else
        if(search_live==0)
            {
            document.getElementById("student_id").value="";
            }else
        if((search_live==0)&&(organization_id==0)&&(branch_id==0)&&(session_id==0))
        {
         
         return false;
        }else
        {
var e=window.event || e
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
{


var httpxml;
if((search_live==0)||(search_live==""))
    {
     document.getElementById("all_list").innerHTML="";
     document.getElementById("all_list").style.display="none"; 
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
    document.getElementById("all_list").style.display="block";
    document.getElementById("all_list").innerHTML=httpxml.responseText; 
     }
      }
    } 
  
var url="pay_ajax_code.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&search_by="+search_by+"&&search_qq="+search_live;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
}else
    {
     switch (event.keyCode)
				{
				 case 40:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
                                                     
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("#all_list li:first").addClass("selected");
                                            
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:last").addClass("selected");
                                           
				 }
				 break;
				 case 13:
                                     {
					
                                        if($("li[class='selected'] .ancor_student_id").text()!="")
                                            {
                                       
                                       $("#all_list").fadeOut(50);
                                       var student_unique_id=$("li[class='selected'] .ancor_student_id").text();
                                       var student_name=$("li[class='selected'] .ancor_student_name").text();
					$("#student_search").val(student_name);
                                        $("#advance_student_id").val(student_unique_id);
                                        $("li[class='selected']").removeClass("selected");
                                    
                                      static_student();
                                    
document.getElementById("showiframepaymentsystem").innerHTML="";
document.getElementById("student_record_fetch").innerHTML="";
document.getElementById("student_record_fetch").innerHTML='<input type="hidden" id="student_sr_no">  <input type="hidden" id="student_admission_no">\n\
<input type="hidden" id="student_class_id"><div class="no_record">Record No Found !!</div>';

document.getElementById("studentperiviousdetails").innerHTML="";
document.getElementById("studentperiviousdetails").innerHTML='<div class="no_record">Record No Found !!</div>';
document.getElementById("all_student_list").innerHTML="";

document.getElementById("manuallycollectfeedetails").style.display="none";
document.getElementById("auotomaticallycollectfeedetails").style.display="none";
document.getElementById("manuallyfeegroup").innerHTML="<option id='manually_select_fee_group' value='0'>-- Select fee group --</option>"; 
document.getElementById("zero_select_automatically").selected=true;
   
document.getElementById("collectfeeautomatic").checked=false;   
document.getElementById("collectfeemanually").checked=false;   
                                      
                                         

                                       
         }
         }
				 break;
     }
    }
   }
}



//student search details & previous payment details
function student_record(student_id,student_name)
{
    
document.getElementById("showiframepaymentsystem").innerHTML="";
document.getElementById("student_record_fetch").innerHTML="";
document.getElementById("student_record_fetch").innerHTML='<div class="no_record">Record No Found !!</div>';

document.getElementById("studentperiviousdetails").innerHTML="";
document.getElementById("studentperiviousdetails").innerHTML='<div class="no_record">Record No Found !!</div>';

document.getElementById("manuallycollectfeedetails").style.display="none";
document.getElementById("auotomaticallycollectfeedetails").style.display="none";
document.getElementById("manuallyfeegroup").innerHTML="<option id='manually_select_fee_group' value='0'>-- Select fee group --</option>"; 
document.getElementById("zero_select_automatically").selected=true;
   
document.getElementById("collectfeeautomatic").checked=false;   
document.getElementById("collectfeemanually").checked=false;   

if(student_id==0 && student_name==0)
{
alert("Please select student");
return false;
}else
{
document.getElementById("advance_student_id").value=student_id;
document.getElementById("student_search").value=student_name;
document.getElementById("all_list").innerHTML="";
 document.getElementById("all_list").style.display="none";
static_student();
}   
}










//static search  ajax code

function live_autocomplete_search(e,search_qq)
  {

  
var class_id=document.getElementById("studentclass").value;
var e=window.event || e
if(class_id==0)
    {
     alert("Please first select class");
     document.getElementById("search_static_student").value="";
     return false;
    }else
if(event.keyCode == 8 || event.keyCode == 32)
    {
      
     $("li[class='selected']").removeClass("selected");  
    }else
if(event.keyCode != 40 && event.keyCode != 38 && event.keyCode != 13)
{

$("li[class='selected']").removeClass("selected");    
}else
    {
                switch (event.keyCode)
				{
				 case 40:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
                                                     
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.next().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:first").addClass("selected");
                                            
					 }
				 break;
				 case 38:
				 {
					  found = 0;
					  $("li").each(function(){
						 if($(this).attr("class") == "selected")
							found = 1;
					  });
					  if(found == 1)
					  {
						var sel = $("li[class='selected']");
						sel.prev().addClass("selected");
						sel.removeClass("selected");
					  }
					  else
						$("li:last").addClass("selected");
                                           
				 }
				 break;
				 case 13:
                                     {
					
                                        if($("li[class='selected'] .ancor_student_id").text()!="")
                                            {
                                        $("#student_static_search_div").fadeOut(100);
					$("#student_name_tittle").text($("li[class='selected'] .ancor_student_name").text());
                                        $("#advance_student_id").val($("li[class='selected'] .ancor_student_id").text());
                                        $("li[class='selected']").removeClass("selected");
                                         
                                        static_student();
document.getElementById("student_record_fetch").innerHTML="";
document.getElementById("student_record_fetch").innerHTML='<input type="hidden" id="student_sr_no">  <input type="hidden" id="student_admission_no">\n\
<input type="hidden" id="student_class_id"><div class="no_record">Record No Found !!</div>';

document.getElementById("studentperiviousdetails").innerHTML="";
document.getElementById("studentperiviousdetails").innerHTML='<div class="no_record">Record No Found !!</div>';

document.getElementById("manuallycollectfeedetails").style.display="none";
document.getElementById("auotomaticallycollectfeedetails").style.display="none";
document.getElementById("manuallyfeegroup").innerHTML="<option id='manually_select_fee_group' value='0'>-- Select fee group --</option>"; 
document.getElementById("zero_select_automatically").selected=true;
   
document.getElementById("collectfeeautomatic").checked=false;   
document.getElementById("collectfeemanually").checked=false;         
                                         
                                      
                                         
                                            }
                                     }
				 break;
				}
    }
  }






//student change

function student_chage(student_id)
{
    if(student_id!=0)
    {
 static_student();  
    }
}




//add student button through
function  static_student()
{
document.getElementById("showiframepaymentsystem").innerHTML="";
document.getElementById("student_record_fetch").innerHTML="";
document.getElementById("student_record_fetch").innerHTML='<div class="no_record">Record No Found !!</div>';

document.getElementById("studentperiviousdetails").innerHTML="";
document.getElementById("studentperiviousdetails").innerHTML='<div class="no_record">Record No Found !!</div>';

document.getElementById("manuallycollectfeedetails").style.display="none";
document.getElementById("auotomaticallycollectfeedetails").style.display="none";

document.getElementById("manuallyfeegroup").innerHTML="<option id='manually_select_fee_group' value='0'>-- Select fee group --</option>"; 
document.getElementById("zero_select_automatically").selected=true;
   
document.getElementById("collectfeeautomatic").checked=false;   
document.getElementById("collectfeemanually").checked=false;   


     
                                    
   var organization_id=document.getElementById("organization_id").value;
   var branch_id=document.getElementById("branch_id").value;
   var session_id=document.getElementById("insert_session_id").value;
   
   var normalsearch=document.getElementById("normalsearch").checked;
    if(normalsearch==true)
    {
     var student_id=document.getElementById("student_id").value;    
    }else
    {
     var student_id=document.getElementById("advance_student_id").value;    
    }
   
   
if((organization_id==0)||(branch_id==0)||(session_id==0))
    {
      alert("Please fill organization,branch,session id");
      return false;
   
    }else
 if((student_id==0))
     {
        alert("Please Select Student");
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
     
  
   document.getElementById("student_record_data").innerHTML=httpxml.responseText;
         
    var student_record_fetch_by_ajax=document.getElementById("student_profile_data").innerHTML;
    document.getElementById("student_record_fetch").innerHTML=student_record_fetch_by_ajax;
    
    var previous_fee_payment_history=document.getElementById("previous_fee_payment_redord").innerHTML;
    document.getElementById("studentperiviousdetails").innerHTML=previous_fee_payment_history;
   
    
      document.getElementById("student_record_data").innerHTML="";  
      document.getElementById("ajax_loader_show").style.display="none"; 
      
    
    }else
        {
         
        }
      }else
          {
           document.getElementById("ajax_loader_show").style.display="block";    
          }
    } 
  
var url="pay_ajax_code.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&session_id="+session_id+"&&student_id="+student_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null)    
         }  
}
