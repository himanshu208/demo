 /form no 1/
           function form_no_2(no) 
            {
                  var employee_no=document.getElementById("employee_no").value;
                  var employee_joining_date=document.getElementById("joining_date").value;
                  var department=document.getElementById("department").value;
                  var designation=document.getElementById("designation").value;
           var full_name=document.getElementById("student_full_name").value;
           var gender=document.getElementById("student_gender").value;
           var date_of_birth=document.getElementById("student_date_of_birth").value;
           var nationality=document.getElementById("student_nationality").value;
           var category=document.getElementById("student_category").value;
           var mobile_no=document.getElementById("student_mobile_number").value;
           var student_photo=document.getElementById("student_photo").value;
          var user_name=document.getElementById("employee_username").value;
          var password=document.getElementById("employee_password").value;
           if(employee_no==0)
               {
               alert("Please enter employee number");
               document.getElementById("employee_no").focus();
               return false;
               }else
                  if(employee_joining_date==0)
                      {
               alert("Please enter employee joining date");
               document.getElementById("joining_date").focus();
               return false;   
                      }else
                        if(department==0)
                      {
               alert("Please select department");
               document.getElementById("department").focus();
               return false;   
                      }else
                      if(designation==0)
                      {
               alert("Please select designation");
               document.getElementById("designation").focus();
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
                      } else
                          if(mobile_no==0)
                      {
                        alert("Please enter mobile number");
                        document.getElementById("student_mobile_number").focus();
                        return false;   
                      }else
                           if(isNaN(mobile_no))
                      {
                        alert("Please enter valid mobile number");
                        document.getElementById("student_mobile_number").focus();
                        return false;   
                      }else
                          if(user_name==0)
                      {
                        alert("Please enter username");
                        document.getElementById("employee_username").focus();
                        return false;
                      }else
                          if(password==0)
                      {
                       alert("Please enter password");
                       document.getElementById("employee_password").focus();
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
            
            var emergency_mobile_no=document.getElementById("emergency_mobile_no").value;
          
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
              if(emergency_mobile_no==0)
          {
             alert("Please enter emergency mobile number");
                  document.getElementById("emergency_mobile_no").focus();
                  return false; 
          }else
           if(isNaN(emergency_mobile_no))
          {
             alert("Please enter valid emergency mobile number");
                  document.getElementById("emergency_mobile_no").focus();
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
          var father_name=document.getElementById("father_name").value;
          var mother_name=document.getElementById("mother_name").value;
         
             if(father_name==0)
              {
                alert("Please enter father name");
                document.getElementById("father_name").focus();
                return false;
              }else
                  {
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
             
            var course_name=document.getElementById("course_1").value;
            var exp_year=document.getElementById("exp_year").value;
            var exp_month=document.getElementById("exp_month").value;
            var exp_day=document.getElementById("exp_day").value;
            if(course_name==0)
            {
               alert("Please enter course name");
               document.getElementById("course_1").focus();
               return false;
            }else
                if(exp_year=="zero")
            {
               alert("Please select experience year");
               document.getElementById("exp_year").focus();
               return false;
            }
            if(exp_month=="zero")
            {
               alert("Please select experience month");
               document.getElementById("exp_month").focus();
               return false;
            }else
                if(exp_day=="zero")
            {
               alert("Please select experience day");
               document.getElementById("exp_day").focus();
               return false;
            }
             
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
        var bank_name=document.getElementById("bank_name").value;
                var bank_branch=document.getElementById("bank_branch").value;
                var ifsc_code=document.getElementById("ifsc_code").value;
                var account_no=document.getElementById("account_no").value;
                var confirm_account_no=document.getElementById("confirm_account_no").value;
                
        
           if(bank_name==0)
            {
               alert("Please select bank");
               document.getElementById("bank_name").focus();
               return false;
            }else
             if(bank_branch==0)
            {
               alert("Please enter bank branch");
               document.getElementById("bank_branch").focus();
               return false;
            }else
            if(ifsc_code==0)
            {
               alert("Please enter ifsc code");
               document.getElementById("ifsc_code").focus();
               return false;
            }else
            if(account_no==0)
            {
               alert("Please enter account number");
               document.getElementById("account_no").focus();
               return false;
            }else
            if(confirm_account_no==0)
            {
               alert("Please enter confirm account number");
               document.getElementById("confirm_account_no").focus();
               return false;
            }else
            if(account_no!=confirm_account_no)
            {
               alert("account number & confirm account number did`t match");
               document.getElementById("confirm_account_no").focus();
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
         
         var language=document.getElementById("language_1").value;
         if(language==0)
             {
                alert("Please enter language");
                document.getElementById("language_1").focus();
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
            var vehicle_type=document.getElementById("vehicle_type_id").value;
            var vehicle_reg=document.getElementById("vehicle_reg_no").value;
          if(route_id==0)
              {
                 alert("Please select route");
                 document.getElementById("route_id").focus();
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
      
      function on_show_photo(number)
{
 var input_photo=document.getElementById("input_photo_"+number).value;   
 if(input_photo==0)
     {
     document.getElementById("show_photo_"+number).style.display="block";
     document.getElementById("input_photo_"+number).value=1;    
     }else
         {
         document.getElementById("show_photo_"+number).style.display="none";
         document.getElementById("input_photo_"+number).value=0;    
         }
}