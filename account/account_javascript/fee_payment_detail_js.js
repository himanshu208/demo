//by date javascript

function by_date()
         {
           var by_date_check=document.getElementById("check_by_date").checked;
           if(by_date_check==true)
           {
            document.getElementById("show_from_to_date_table").style.display="block";
           }else
           {
            document.getElementById("show_from_to_date_table").style.display="none";
             
           }
         }
         
 //search  method
 function search_type()
 {
   var normal_search=document.getElementById("normalsearch").checked;
   var advance_search=document.getElementById("advancesearch").checked;
   var other_search=document.getElementById("othersearch").checked;
   
   if(normal_search==true)
   {
    
 
    document.getElementById("advancesearchtable").style.display="none"; 
    document.getElementById("othersearchtable").style.display="none";
    document.getElementById("normalsearchtable").style.display="block";
     
   }else
       if(advance_search==true)
   {
          document.getElementById("normalsearchtable").style.display="none";
          document.getElementById("othersearchtable").style.display="none";
         document.getElementById("advancesearchtable").style.display="block";     
   }else
       if(other_search==true)
   {
    document.getElementById("normalsearchtable").style.display="none";
    document.getElementById("advancesearchtable").style.display="none";     
   document.getElementById("othersearchtable").style.display="block";      
   }        
 }
 
         
         
         
         
      //normal search class id   
    function course_id(course_id)
    {
     var organization_id=document.getElementById("organization_id").value;
     var branch_id=document.getElementById("branch_id").value;
     var session_id=document.getElementById("insert_session_id").value;
     var currency=document.getElementById("currency").value;
     if((organization_id==0)&&(branch_id==0)&&(session_id==0)&&(currency==0))
     {
       alert("Please fill all fields");
       return false;
     }else
     if(course_id==0)
 {
    document.getElementById("student_name_tittle").innerHTML="---Select Student---";
    document.getElementById("course_section").innerHTML="<option value='0'>---Select---</option>";
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
   document.getElementById("temp_data").innerHTML=httpxml.responseText;
   var section_record=document.getElementById("section_data").innerHTML;
   document.getElementById("course_section").innerHTML=section_record;
   
   var student_data=document.getElementById("student_record_data").innerHTML;
   document.getElementById("all_student_list").innerHTML=student_data;
   
   
   
   $(document).ready(function(){
var options = {
  valueNames: ['student_search','student_father_name','roll_no','student_id']
};
var userList =new List('student_static_search_div', options);
});  
 document.getElementById("temp_data").innerHTML="";
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="fee_payment_detail_ajax_code.php";
url=url+"?org_id="+organization_id+"&&branch_id="+branch_id+"&&currency="+currency+"&&session_id="+session_id+"&&course_id="+course_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);         
         
            
     }
     }
     
     //normal search section id
      function section_id(section_id)
    {
     var organization_id=document.getElementById("organization_id").value;
     var branch_id=document.getElementById("branch_id").value;
     var session_id=document.getElementById("insert_session_id").value;
     var currency=document.getElementById("currency").value;
     var course_id=document.getElementById("class_course_name").value;
     if((organization_id==0)&&(branch_id==0)&&(session_id==0)&&(currency==0))
     {
       alert("Please fill all fields");
       return false;
     }else
     if(course_id==0)
 {
  alert("Please select class/course");
  return false;
 }else
 if(section_id==0)
 {
  document.getElementById("student_name_tittle").innerHTML="---Select Student---";
  document.getElementById("all_student_list").innerHTML="";
 }else
     {

document.getElementById("student_name_tittle").innerHTML="---Select Student---";
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
   
   document.getElementById("temp_data").innerHTML=httpxml.responseText;
   var student_data=document.getElementById("student_record_data").innerHTML;
   document.getElementById("all_student_list").innerHTML=student_data;
  
   $(document).ready(function(){
var options = {
  valueNames: ['student_search','student_father_name','roll_no','student_id']
};
var userList =new List('student_static_search_div', options);
});  
 document.getElementById("temp_data").innerHTML="";
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="fee_payment_detail_ajax_code.php";
url=url+"?section_org_id="+organization_id+"&&section_branch_id="+branch_id+"&&currency="+currency+"&&section_session_id="+session_id+"&&unique_course_id="+course_id+"&&section_id="+section_id;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);         
         
            
     }
     }
     
     
     
     //student search autocomplete
    
function live_autocomplete_search(e,search_qq)
  {

   
var class_id=document.getElementById("class_course_name").value;
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
                                        $("#input_student").val('0');
					$("#student_name_tittle").text($("li[class='selected'] .ancor_student_name").text());
                                        $("#admission_no").val($("li[class='selected'] .ancor_student_id").text());
                                        $("li[class='selected']").removeClass("selected");
                                         
                                        var student_id=$("#admission_no").val();
                                         var student_name=$("#student_name_tittle").text();
                                         
                                         
                                            }
}
break;
}
}
}


//onclick student static search details
function student_record(student_id,student_name)
{
 document.getElementById("admission_no").value=student_id;   
 document.getElementById("student_name_tittle").innerHTML=student_name;
 document.getElementById("input_student").value=0;
 document.getElementById("student_static_search_div").style.display="none";
 
}




//onclick search

function search_button()
{
 var normal_search=document.getElementById("normalsearch").checked;
 var advance_search=document.getElementById("advancesearch").checked;
 var other_search=document.getElementById("othersearch").checked;
 var from_date=document.getElementById("date_from").value;
 var to_date=document.getElementById("date_to").value;
  var number_count=0;
 if(normal_search==true)
 {
  var course_id=document.getElementById("class_course_name").value;
  var section_id=document.getElementById("course_section").value;
  var student_id=document.getElementById("admission_no").value;
  other_search_by="";
  other_search_value="";
  if((from_date==0&&to_date==0)&&(course_id==0)&&(section_id==0)&&(student_id==0))
  {
     
  }else
  {
    number_count++;
  }      
 }else
 if(advance_search==true)
 {
 var search_by=document.getElementById("studentsearchby").value;
 var search_value=document.getElementById("student_search_name").value;
 other_search_by="";
 other_search_value="";
 course_id="";
 section_id="";
 student_id=document.getElementById("advance_admission_no").value;
 if((search_by==0)||(search_value==0)||(student_id==0))
 {
          
 }else
 {
     number_count++; 
 }
       
 }else
 if(other_search==true)
 {
 var other_search_by=document.getElementById("othersearchby").value;
 var other_search_value=document.getElementById("other_search_name").value;
 course_id="";
 section_id="";
 student_id="";    
 if((other_search_by==0)||(other_search_value==0))
 {
     
 }else
 {
     number_count++; 
 }      
 }
 
     var course_class_id=course_id;
     var search_section_id=section_id;
     var search_student_id=student_id;
     var organization_id=document.getElementById("organization_id").value;
     var branch_id=document.getElementById("branch_id").value;
     var session_id=document.getElementById("insert_session_id").value;
     var currency=document.getElementById("currency").value;
    
 
 
 if(number_count==0)
 {
    alert("Please select atleast on option");
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
   
  document.getElementById("feespaymentdetailsdata").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="fee_payment_detail_ajax_code.php";
url=url+"?organization_id="+organization_id+"&&branch_id="+branch_id+"&&currency="+currency+"&&session_id="+session_id+"\
&&search_course_id="+course_class_id+"&&search_section_id="+search_section_id+"\
&&search_student_id="+search_student_id+"&&page_no=1&&other_search_by="+other_search_by+"\
&&other_search_value="+other_search_value+"&&from_date="+from_date+"&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null);
  
  
  
  
  
 }  
}


function forward_page(forward_page_no)
{

 var normal_search=document.getElementById("normalsearch").checked;
 var advance_search=document.getElementById("advancesearch").checked;
 var other_search=document.getElementById("othersearch").checked;
 var from_date=document.getElementById("date_from").value;
 var to_date=document.getElementById("date_to").value;
  var number_count=0;
 if(normal_search==true)
 {
  
  if((from_date==0&&to_date==0)&&(course_id==0)&&(section_id==0)&&(student_id==0))
  {
   number_count++;    
  }else
  {
    number_count++;
    var course_id=document.getElementById("class_course_name").value;
  var section_id=document.getElementById("course_section").value;
  var student_id=document.getElementById("admission_no").value;
  other_search_by="";
  other_search_value="";
  }      
 }else
 if(advance_search==true)
 {
 
 if((search_by==0)||(search_value==0))
 {
   number_count++;         
 }else
 {
     number_count++; 
     
 var search_by=document.getElementById("studentsearchby").value;
 var search_value=document.getElementById("studentsearchname").value;
 other_search_by="";
 other_search_value="";
 course_id="";
 section_id="";
 student_id=document.getElementById("advance_admission_no").value;
 }
       
 }else
 if(other_search==true)
 {
 if((other_search_by==0)||(other_search_value==0)||(student_id==0))
 {
   number_count++;    
 }else
 {
     number_count++; 
     var other_search_by=document.getElementById("othersearchby").value;
 var other_search_value=document.getElementById("other_search_name").value;
 course_id="";
 section_id="";
 student_id="";
 }      
 }
 
     var course_class_id=course_id;
     var search_section_id=section_id;
     var search_student_id=student_id;
     var organization_id=document.getElementById("organization_id").value;
     var branch_id=document.getElementById("branch_id").value;
     var session_id=document.getElementById("insert_session_id").value;
     var currency=document.getElementById("currency").value;
    
 
 
 if(number_count==0)
 {
    alert("Please select atleast on option");
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
   
  document.getElementById("feespaymentdetailsdata").innerHTML=httpxml.responseText;
   document.getElementById("ajax_loader_show").style.display="none";
     }else
     {
         alert("data loss,please try again");
         return false;
     }
     }else
     {
         document.getElementById("ajax_loader_show").style.display="block"; 
     }
    } 
  
var url="fee_payment_detail_ajax_code.php";
url=url+"?organization_id="+organization_id+"&&branch_id="+branch_id+"&&currency="+currency+"&&session_id="+session_id+"\
&&search_course_id="+course_class_id+"&&search_section_id="+search_section_id+"\
&&search_student_id="+search_student_id+"&&page_no="+forward_page_no+"&&other_search_by="+other_search_by+"\
&&other_search_value="+other_search_value+"&&from_date="+from_date+"&&to_date="+to_date;
httpxml.onreadystatechange=stateChanged;
httpxml.open("GET",url,true);
httpxml.send(null); 
 }  
}




//advance search details

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
            document.getElementById("advance_admission_no").value="";
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
					$("#student_search_name").val(student_name);
                                        $("#advance_admission_no").val(student_unique_id);
                                        $("li[class='selected']").removeClass("selected");
                                                    
                                       }
                                       }
				 break;
     }
    }
   }
}


//html to pdf convert
function converted_pdf()
{
    
    var convert_html_file=document.getElementById("details_table").innerHTML;  
   var shcool_logo=document.getElementById("company_logo_link").innerHTML;  
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
   
      
       document.getElementById("convert_file").innerHTML=httpxml.responseText;
     }else
     {
         document.getElementById("convert_file").innerHTML=httpxml.responseText;
     }
      }
    } 
  
var url="../converter_html/html_to_pdf/actionpdf_1.php";
httpxml.onreadystatechange=stateChanged;
httpxml.open("POST",url,true);
httpxml.setRequestHeader("Content-type","application/x-www-form-urlencoded");
httpxml.send('convert_file='+convert_html_file+'&&school_logo_url='+shcool_logo);
    
}

