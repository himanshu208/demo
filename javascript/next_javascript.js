 /form no 1/
           function form_no_2(no) 
            {
             
           var admission_no=document.getElementById("admission_no").value;
           var admission_date=document.getElementById("admission_date").value;
           var class_name=document.getElementById("class_name").value;
           var section_name=document.getElementById("section_name").value;
           var full_name=document.getElementById("student_full_name").value;
           var gender=document.getElementById("student_gender").value;
           var date_of_birth=document.getElementById("student_date_of_birth").value;
           var nationality=document.getElementById("student_nationality").value;
           var category=document.getElementById("student_category").value;
           var user_name=document.getElementById("student_user_name").value;
           var password=document.getElementById("student_password").value;
           
           if(admission_no==0)
           {
            alert("Please enter admission number");
            document.getElementById("admission_no").focus();
            return false;
           }else
               if(admission_date==0)
           {
            alert("Please enter admission date");
            document.getElementById("admission_date").focus();
            return false;
           }else
           if(class_name==0)
               {
               alert("Please select class");
               document.getElementById("class_name").focus();
               return false;
               }else
                  if(section_name==0)
                      {
                       alert("Please select section");
               document.getElementById("section_name").focus();
               return false;   
                      }else
                       if(full_name==0)
                      {
                       alert("Please enter full name");
               document.getElementById("student_full_name").focus();
               return false;   
                      }else
                       if(gender==0)
                      {
                       alert("Please select gender");
               document.getElementById("student_gender").focus();
               return false;   
                      }else
                       if(date_of_birth==0)
                      {
                       alert("Please enter student date of birth");
               document.getElementById("student_date_of_birth").focus();
               return false;   
                      }else
                       if(nationality==0)
                      {
                       alert("Please enter nationality");
               document.getElementById("student_nationality").focus();
               return false;   
                      }
                      else
                       if(category==0)
                      {
                       alert("Please select category");
               document.getElementById("student_category").focus();
               return false;   
                      }else
                      if(user_name==0)
                  {
                    alert("Please enter username");
                    document.getElementById("student_user_name").focus();
                    return false;
                  }else
                   if(password==0)
                  {
                    alert("Please enter password");
                    document.getElementById("student_password").focus();
                    return false;
                  }else
                       {
             
             
             
            document.getElementById("form_no_1").style.display="none";
            document.getElementById("form_no_2").style.display="block"; 
             for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
               document.getElementById("color_set_page_"+no+"").style.color="yellowgreen";  
               document.getElementById("circle_color_"+no+"").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_"+no+"").style.fontSize="12px";  
                
              
                          }
                          }
            
                
                    
                        
             /previous student personal details/ 
            function per_form_no_1(no) 
            {
            
          
           document.getElementById("form_no_2").style.display="none";    
           document.getElementById("form_no_1").style.display="block";
           
                for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
               document.getElementById("color_set_page_"+no+"").style.color="yellowgreen";  
               document.getElementById("circle_color_"+no+"").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_"+no+"").style.fontSize="12px";  
                    
   }
            
            
            /address details/
            function form_no_3(no)
            {
            var current_address=document.getElementById("curr_address").value;
            var current_city=document.getElementById("curr_city").value;
            var current_desctric=document.getElementById("curr_desctric").value;
            var current_post=document.getElementById("curr_post").value;
            var current_pincode=document.getElementById("curr_pincode").value;
            var current_state=document.getElementById("curr_state").value;
            var current_country=document.getElementById("curr_country").value;
          
                var per_address=document.getElementById("per_address").value;
                var per_city=document.getElementById("per_city").value;
                var per_desctric=document.getElementById("per_desctric").value;
               var per_post=document.getElementById("per_post").value;
                var per_pincode=document.getElementById("per_pincode").value;
                var per_state=document.getElementById("per_state").value;
                var per_country=document.getElementById("per_country").value;
          
         
              if(current_address==0)
              {
                  alert("Please enter current address");
                  document.getElementById("curr_address").focus();
                  return false;
              }else
                if(current_city==0)
              {
                  alert("Please enter city");
                  document.getElementById("curr_city").focus();
                  return false;
              } else
                if(current_desctric==0)
              {
                  alert("Please enter district");
                  document.getElementById("curr_desctric").focus();
                  return false;
              }else
                  if(current_post==0)
              {
                  alert("Please enter post");
                  document.getElementById("curr_post").focus();
                  return false;
              }else
                if(current_pincode==0)
              {
                  alert("Please enter pincode");
                  document.getElementById("curr_pincode").focus();
                  return false;
              }else
                  if(isNaN(current_pincode))
              {
                  alert("Please enter only numeric value");
                  document.getElementById("curr_pincode").focus();
                  return false;
              }else
                if(current_state==0)
              {
                  alert("Please enter state");
                  document.getElementById("curr_state").focus();
                  return false;
              } else
                if(current_country==0)
              {
                  alert("Please enter country");
                  document.getElementById("curr_country").focus();
                  return false;
              }else 
                  
              if(per_address==0)
              {
                  alert("Please enter permanent address");
                  document.getElementById("per_address").focus();
                  return false;
              }else
                if(per_city==0)
              {
                  alert("Please enter city");
                  document.getElementById("per_city").focus();
                  return false;
              } else
                if(per_desctric==0)
              {
                  alert("Please enter district");
                  document.getElementById("per_desctric").focus();
                  return false;
              }else
                   if(per_post==0)
              {
                  alert("Please enter post");
                  document.getElementById("per_post").focus();
                  return false;
              }else
                if(per_pincode==0)
              {
                  alert("Please enter pincode");
                  document.getElementById("per_pincode").focus();
                  return false;
              }else
                   if(isNaN(per_pincode))
              {
                  alert("Please enter only numeric value");
                  document.getElementById("per_pincode").focus();
                  return false;
              }else
                if(per_state==0)
              {
                  alert("Please enter state");
                  document.getElementById("per_state").focus();
                  return false;
              } else
                if(per_country==0)
              {
                  alert("Please enter country");
                  document.getElementById("per_country").focus();
                  return false;
              }else
                  {
          
           document.getElementById("form_no_2").style.display="none";    
           document.getElementById("form_no_1").style.display="none";
           document.getElementById("form_no_3").style.display="block";
               for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
               document.getElementById("color_set_page_"+no+"").style.color="yellowgreen";  
               document.getElementById("circle_color_"+no+"").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_"+no+"").style.fontSize="12px";  
                    
                  }
            }
            
            
            
            
            
            /previous address details/
             function per_form_no_2(no) 
            {
           document.getElementById("form_no_3").style.display="none";
           document.getElementById("form_no_1").style.display="none";
            document.getElementById("form_no_2").style.display="block";
                for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
               document.getElementById("color_set_page_"+no+"").style.color="yellowgreen";  
               document.getElementById("circle_color_"+no+"").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_"+no+"").style.fontSize="12px";  
                        
      }
            
            
            /parents details/
            
            function form_no_4(no)
            {
          if(document.getElementById("exist_parent_check").checked==true)
         {
         var exist_parent=document.getElementById("parent_id").value; 
         if(exist_parent==0)
         {
          alert("Please select existing parent");
          return false;
          
         }          
         }else
         if(document.getElementById("new_parent_check").checked==true)
         {
          var father_name=document.getElementById("father_name").value;
          var mother_name=document.getElementById("mother_name").value;
          var father_mobile_no=document.getElementById("father_mobile_no").value;
          var user_name=document.getElementById("parent_user_name").value;
          var password=document.getElementById("parent_password").value;     
             if(father_name==0)
              {
                alert("Please enter father name");
                document.getElementById("father_name").focus();
                return false;
              }else
               if(mother_name==0)
              {
                 alert("Please enter mother name");
                document.getElementById("mother_name").focus();
                return false;  
              }else
                  if(father_mobile_no==0)
              {
                  alert("Please enter father mobile number");
                document.getElementById("father_mobile_no").focus();
                return false; 
              }else 
              if(user_name==0)
          {
            alert("Please enter parent username");
            document.getElementById("parent_user_name").focus();
            return false;
          }else
          if(password==0)
      {
         alert("Please enter parent password");
         document.getElementById("parent_password").focus();
         return false;
      }
       }
     
          document.getElementById("form_no_3").style.display="none";
           document.getElementById("form_no_1").style.display="none";
            document.getElementById("form_no_2").style.display="none";
            document.getElementById("form_no_4").style.display="block";
            
              for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
               document.getElementById("color_set_page_"+no+"").style.color="yellowgreen";  
               document.getElementById("circle_color_"+no+"").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_"+no+"").style.fontSize="12px";  
               
            }
            
            
            /previous parents details/
            
         function per_form_no_3(no)
        {
           
           document.getElementById("form_no_1").style.display="none";
            document.getElementById("form_no_2").style.display="none";
            document.getElementById("form_no_4").style.display="none";
            document.getElementById("form_no_3").style.display="block";
            
            for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
               document.getElementById("color_set_page_"+no+"").style.color="yellowgreen";  
               document.getElementById("circle_color_"+no+"").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_"+no+"").style.fontSize="12px";  
                    
               
        }
            
            
            /acadmic previous class details/
            function form_no_5(no)
            {
             
            var previous_class=document.getElementById("previous_class").value;
             var board_university=document.getElementById("board_university").value;
             var passing_year=document.getElementById("passing_year").value;
             var per_of_mark=document.getElementById("per_of_mark").value;
             var school_name=document.getElementById("previous_school_name").value;
             var school_address=document.getElementById("previous_school_address").value;
             
             
             
             
                if(previous_class==0)
                  {
                   alert("Please enter previous class/course");
                   document.getElementById("previous_class").focus();
                   return false;
                  }else
                  if(board_university==0)
                  {
                   alert("Please enter board/university");
                   document.getElementById("board_university").focus();
                   return false;
                  }else
                   if( passing_year==0)
                   {
                    alert("Please enter passing year");
                    document.getElementById("passing_year").focus();
                    return false;
                    }else
                   if(isNaN(passing_year))
                   {
                    alert("Please enter only numeric value");
                    document.getElementById("passing_year").focus();
                    return false;
                    }else
                    if(per_of_mark==0)
                    {
                    alert("Please enter % of marks");
                    document.getElementById("per_of_mark").focus();
                    return false;
                    }else
                        if(isNaN(per_of_mark))
                    {
                    alert("Please enter only numeric value");
                    document.getElementById("per_of_mark").focus();
                    return false;
                    }else
                    if(school_name==0)
                    {
                     alert("Please enter previous school name");
                     document.getElementById("previous_school_name").focus();
                     return false;
                    }else
                     if(school_address==0)
                     {
                      alert("Please enter previous school address");
                      document.getElementById("previous_school_address").focus();
                      return false;
                     }else
                     
                         {  
             
                  for(var ij=1;ij<=4;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                  
                  for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
                 
                 
                  
             if(document.getElementById("form_no_5"))
                 {
             document.getElementById("form_no_5").style.display="block";
             document.getElementById("color_set_page_5").style.color="yellowgreen";  
               document.getElementById("circle_color_5").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_5").style.fontSize="12px";  
                
                 }else
                 if(document.getElementById("form_no_6"))
                    {
                    document.getElementById("form_no_6").style.display="block";
                  document.getElementById("color_set_page_6").style.color="yellowgreen";  
               document.getElementById("circle_color_6").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_6").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_7"))
                    {
                     document.getElementById("form_no_7").style.display="block";
                 document.getElementById("color_set_page_7").style.color="yellowgreen";  
               document.getElementById("circle_color_7").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_7").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_8"))
                    {
                     document.getElementById("form_no_8").style.display="block";
                 document.getElementById("color_set_page_8").style.color="yellowgreen";  
               document.getElementById("circle_color_8").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_8").style.fontSize="12px";  
               
                     }
               }
     }
      
      
      //skip previous class to next
      
      function skip_form_no_5(no)
            {
             for(var ij=1;ij<=4;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                  
                  for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
                 
                 
                  
             if(document.getElementById("form_no_5"))
                 {
             document.getElementById("form_no_5").style.display="block";
             document.getElementById("color_set_page_5").style.color="yellowgreen";  
               document.getElementById("circle_color_5").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_5").style.fontSize="12px";  
                
                 }else
                 if(document.getElementById("form_no_6"))
                    {
                    document.getElementById("form_no_6").style.display="block";
                  document.getElementById("color_set_page_6").style.color="yellowgreen";  
               document.getElementById("circle_color_6").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_6").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_7"))
                    {
                     document.getElementById("form_no_7").style.display="block";
                 document.getElementById("color_set_page_7").style.color="yellowgreen";  
               document.getElementById("circle_color_7").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_7").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_8"))
                    {
                     document.getElementById("form_no_8").style.display="block";
                 document.getElementById("color_set_page_8").style.color="yellowgreen";  
               document.getElementById("circle_color_8").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_8").style.fontSize="12px";  
               
                     }    
            }
      
      
      
      /ACADMIC PREVIOUS CLASS DETALS/  
      function per_form_no_4(no)
     {
           
          for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=8;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                 
                    
                         if(document.getElementById("form_no_4"))
                    {
                     document.getElementById("form_no_4").style.display="block";
                 document.getElementById("color_set_page_4").style.color="yellowgreen";  
               document.getElementById("circle_color_4").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_4").style.fontSize="12px";  
                     }              
     }  
      
      
       
      /allocate hostel/ 
     function form_no_6(no)
     {
          var library_ac_status=document.getElementById("library_account_status").value; 
        if(library_ac_status==0)
            {
               alert("Please select library a/c status");
               document.getElementById("library_account_status").focus();
               return false;
            }else
                {
             for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=5;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                
              
                 if(document.getElementById("form_no_6"))
                    {
                    document.getElementById("form_no_6").style.display="block";
                  document.getElementById("color_set_page_6").style.color="yellowgreen";  
               document.getElementById("circle_color_6").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_6").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_7"))
                    {
                     document.getElementById("form_no_7").style.display="block";
                 document.getElementById("color_set_page_7").style.color="yellowgreen";  
               document.getElementById("circle_color_7").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_7").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_8"))
                    {
                     document.getElementById("form_no_8").style.display="block";
                 document.getElementById("color_set_page_8").style.color="yellowgreen";  
               document.getElementById("circle_color_8").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_8").style.fontSize="12px";  
               
                     }
     }
     }
     
     //skip library ac to hostel ac
     function skip_form_no_6(no)
     {
     
             for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=5;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                
              
                 if(document.getElementById("form_no_6"))
                    {
                    document.getElementById("form_no_6").style.display="block";
                  document.getElementById("color_set_page_6").style.color="yellowgreen";  
               document.getElementById("circle_color_6").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_6").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_7"))
                    {
                     document.getElementById("form_no_7").style.display="block";
                 document.getElementById("color_set_page_7").style.color="yellowgreen";  
               document.getElementById("circle_color_7").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_7").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_8"))
                    {
                     document.getElementById("form_no_8").style.display="block";
                 document.getElementById("color_set_page_8").style.color="yellowgreen";  
               document.getElementById("circle_color_8").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_8").style.fontSize="12px";  
               
                     }    
     }
     
     
     
     /PREVIOUS LIBRARY ACCOUNT/  
      function per_form_no_5(no)
     {
           
           for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=8;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                 
                     
                      if(document.getElementById("form_no_5"))
                    {
                     document.getElementById("form_no_5").style.display="block";
                 document.getElementById("color_set_page_5").style.color="yellowgreen";  
               document.getElementById("circle_color_5").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_5").style.fontSize="12px";  
                     }else
                         if(document.getElementById("form_no_4"))
                    {
                     document.getElementById("form_no_4").style.display="block";
                 document.getElementById("color_set_page_4").style.color="yellowgreen";  
               document.getElementById("circle_color_4").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_4").style.fontSize="12px";  
                     }              
     }  
       
       
       
       
       
       /allocate transport/
      function form_no_7(no)
     {
       
         var hostel_id=document.getElementById("hostel_id").value;
         var hostel_room_id=document.getElementById("hostel_room_id").value;
         var hostel_joining_date=document.getElementById("hotel_joining_date").value;
         if(hostel_id==0)
             {
                alert("Please select hostel");
                document.getElementById("hostel_id").focus();
                return false;
             }else
                  if(hostel_room_id==0)
             {
                alert("Please select hostel room");
                document.getElementById("hostel_room_id").focus();
                return false;
             }else
             if(hostel_joining_date==0)
         {
                alert("Please enter hostel joining date");
                document.getElementById("hostel_room_id").focus();
                return false;   
         }else
              {
         
         
               for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=6;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                
              
                
                 if(document.getElementById("form_no_7"))
                    {
                     document.getElementById("form_no_7").style.display="block";
                 document.getElementById("color_set_page_7").style.color="yellowgreen";  
               document.getElementById("circle_color_7").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_7").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_8"))
                    {
                     document.getElementById("form_no_8").style.display="block";
                 document.getElementById("color_set_page_8").style.color="yellowgreen";  
               document.getElementById("circle_color_8").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_8").style.fontSize="12px";  
               
                     }      
     }     
     }     
      
      
      //skip hostel to transport
      
      function skip_form_no_7(no)
      {
           for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=6;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                
              
                
                 if(document.getElementById("form_no_7"))
                    {
                     document.getElementById("form_no_7").style.display="block";
                 document.getElementById("color_set_page_7").style.color="yellowgreen";  
               document.getElementById("circle_color_7").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_7").style.fontSize="12px";  
               
                     }else
                 if(document.getElementById("form_no_8"))
                    {
                     document.getElementById("form_no_8").style.display="block";
                 document.getElementById("color_set_page_8").style.color="yellowgreen";  
               document.getElementById("circle_color_8").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_8").style.fontSize="12px";  
               
                     }
      }
      
      
      
       /previous allocate hostel account/  
       function per_form_no_6(no)
   {
       
        
           for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=8;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                 
                    
                      if(document.getElementById("form_no_6"))
                    {
                     document.getElementById("form_no_6").style.display="block";
                 document.getElementById("color_set_page_6").style.color="yellowgreen";  
               document.getElementById("circle_color_6").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_6").style.fontSize="12px";  
                     } else
                      if(document.getElementById("form_no_5"))
                    {
                     document.getElementById("form_no_5").style.display="block";
                 document.getElementById("color_set_page_5").style.color="yellowgreen";  
               document.getElementById("circle_color_5").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_5").style.fontSize="12px";  
                     }else
                         if(document.getElementById("form_no_4"))
                    {
                     document.getElementById("form_no_4").style.display="block";
                 document.getElementById("color_set_page_4").style.color="yellowgreen";  
               document.getElementById("circle_color_4").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_4").style.fontSize="12px";  
                     }    
                   
   }
       
      /next under taking form/ 
     function form_no_8(no)
     {
          
            var route_id=document.getElementById("route_id").value;
            var sub_route=document.getElementById("sub_route").value;
            var transport_joining_date=document.getElementById("transport_joining_date").value;
            var vehicle_type=document.getElementById("vehicle_type_id").value;
            var vehicle_reg=document.getElementById("vehicle_reg_no").value;
          if(route_id==0)
              {
                 alert("Please select route");
                 document.getElementById("route_id").focus();
                  return false;
              }else
                  if(sub_route==0)
              {
                 alert("Please select sub route");
                 document.getElementById("sub_route").focus();
                  return false;  
              }else
               if(vehicle_type==0)
              {
                 alert("Please select vehicle type");
                 document.getElementById("vehicle_type_id").focus();
                  return false;
              }else   
            if(vehicle_reg==0)
              {
                 alert("Please select vehicle registration number");
                 document.getElementById("vehicle_reg_no").focus();
                  return false;
              }else
               if(transport_joining_date==0)
              {
                 alert("Please enter joining date");
                 document.getElementById("transport_joining_date").focus();
                  return false;
              }else
                  {
             for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=7;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                 if(document.getElementById("form_no_8"))
                    {
                     document.getElementById("form_no_8").style.display="block";
                 document.getElementById("color_set_page_8").style.color="yellowgreen";  
               document.getElementById("circle_color_8").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_8").style.fontSize="12px";  
               
                     } 
                            
     }     
         
     }
     
     //skip transport to undertaking form
     
     function skip_form_no_8(no)
     {
         for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=7;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                 if(document.getElementById("form_no_8"))
                    {
                     document.getElementById("form_no_8").style.display="block";
                 document.getElementById("color_set_page_8").style.color="yellowgreen";  
               document.getElementById("circle_color_8").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_8").style.fontSize="12px";  
               
                     } 
     }
     
     
     
     
       /PREVIOUS TRANSPORT DETIALS/
       
      function  per_form_no_7(no)
      {
            for(var i=1;i<=8;i++)
                {
                
                if(document.getElementById("color_set_page_"+i+""))
                    {
                    document.getElementById("color_set_page_"+i+"").style.color="silver"; 
                    document.getElementById("color_set_page_"+i+"").style.fontSize="11px";  
                    }
                 if(document.getElementById("circle_color_"+i+""))
                     {document.getElementById("circle_color_"+i+"").style.backgroundColor="silver"; 
                    }}
              
              
        for(var ij=1;ij<=8;ij++)
                  {
                   if(document.getElementById("form_no_"+ij+""))
                {
                  document.getElementById("form_no_"+ij+"").style.display="none";  
                }
                  }
                  
                 
                      if(document.getElementById("form_no_7"))
                    {
                     document.getElementById("form_no_7").style.display="block";
                 document.getElementById("color_set_page_7").style.color="yellowgreen";  
               document.getElementById("circle_color_7").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_7").style.fontSize="12px";  
                     }else
                      if(document.getElementById("form_no_6"))
                    {
                     document.getElementById("form_no_6").style.display="block";
                 document.getElementById("color_set_page_6").style.color="yellowgreen";  
               document.getElementById("circle_color_6").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_6").style.fontSize="12px";  
                     } else
                      if(document.getElementById("form_no_5"))
                    {
                     document.getElementById("form_no_5").style.display="block";
                 document.getElementById("color_set_page_5").style.color="yellowgreen";  
               document.getElementById("circle_color_5").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_5").style.fontSize="12px";  
                     }else
                         if(document.getElementById("form_no_4"))
                    {
                     document.getElementById("form_no_4").style.display="block";
                 document.getElementById("color_set_page_4").style.color="yellowgreen";  
               document.getElementById("circle_color_4").style.backgroundColor="yellowgreen";    
               document.getElementById("color_set_page_4").style.fontSize="12px";  
                     }    
      }