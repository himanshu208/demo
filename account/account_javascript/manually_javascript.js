function fee_check(fee_amount,fine_amount,discount_amount,final_payable_amount,number_position,specify_month,fee_group_id)
{

 var check_box_month=document.getElementById("check_box_"+number_position+"_"+fee_group_id).checked;
 if(check_box_month==true)
     {
     //fee qty add
     var add_one=1;
     var fee_qty=document.getElementById("fee_qty_"+fee_group_id).value;
     var add_new_fee_qty=new Number(new Number(fee_qty)+new Number(add_one));
     
    
     //fee sub total
     var old_sub_total_amount=new Number(document.getElementById("sub_total_html_"+fee_group_id).innerHTML);
     var new_sub_total_amount=new Number(new Number(old_sub_total_amount)+new Number(fee_amount));
    
    //fee discount
    var old_fee_discount_amount=new Number(document.getElementById("discount_amount_html_"+fee_group_id).innerHTML);
    var new_discount_amount=new Number(new Number(old_fee_discount_amount)+new Number(discount_amount));
    
    //fee fine amount
    var old_fine_amount=new Number(document.getElementById("fine_amount_html_"+fee_group_id).innerHTML);
    var new_fine_amount=new Number(new Number(old_fine_amount)+new Number(fine_amount));
    
    //final fee total amount
    var old_total_fee_amount=new Number(document.getElementById("total_amount_html_"+fee_group_id).innerHTML);
    var new_fee_amount=new Number(new Number(old_total_fee_amount)+new Number(final_payable_amount));
    
    //last final payable amount
    var old_final_payable_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
    var new_final_payable_amount=new Number(new Number(old_final_payable_amount)+new Number(final_payable_amount));
    
    
    
    
    //fee_total_amount_value
    var old_fee_total_amount=new Number(document.getElementById("fee_payable_amount").value);
    var new_fee_total_amount=new Number(new Number(old_fee_total_amount)+new Number(fee_amount));
    
    //temp fee_total_amount_value
    var temp_old_fee_total_amount=new Number(document.getElementById("temp_fee_payable_amount").value);
    var temp_new_fee_total_amount=new Number(new Number(temp_old_fee_total_amount)+new Number(fee_amount));
    
    
    //fine_total_amount_value
    var old_fine_total_amount=new Number(document.getElementById("total_fine_amount").value);
    var new_fine_total_amount=new Number(new Number(old_fine_total_amount)+new Number(fine_amount));
    
    //discount_total_amount_value
    var old_discount_total_amount=new Number(document.getElementById("total_amount_discount").value);
    var new_discount_total_amount=new Number(new Number(old_discount_total_amount)+new Number(discount_amount));
    
    //final_payable_amount_value
    var new_final_payable_amount_value=new Number(new_final_payable_amount);
    
    
    //amount_paid_total
    var old_amount_paid_amount=new Number(document.getElementById("amount_paid_value").value);
    var new_amount_paid_amount=new Number(new Number(old_amount_paid_amount)+new Number(final_payable_amount));
    
    
    
    
     
     //put all values
     document.getElementById("fee_qty_"+fee_group_id).value=add_new_fee_qty;
     document.getElementById("fee_group_qty_"+fee_group_id).value=add_new_fee_qty;
     document.getElementById("sub_total_html_"+fee_group_id).innerHTML=new_sub_total_amount;
     document.getElementById("sub_total_value_"+fee_group_id).value=new_sub_total_amount;
     
     document.getElementById("specify_month_"+fee_group_id).style.textAlign="justify";
     document.getElementById("specify_month_"+fee_group_id).style.fontSize="10px";
     var checkboxes=document.querySelectorAll('input[class="check_box_style_'+fee_group_id+'"]:checked'),values=[];
     Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
    
     document.getElementById("specific_month_"+fee_group_id).value=values;
    document.getElementById("specify_month_"+fee_group_id).innerHTML=values;
     document.getElementById("specify_month_"+fee_group_id).style.textAlign="justify";
     document.getElementById("specify_month_"+fee_group_id).style.fontSize="10px";
     
    
    
    
    
     //fine amount
     document.getElementById("fine_amount_html_"+fee_group_id).innerHTML=new_fine_amount;
     document.getElementById("fine_amount_value_"+fee_group_id).value=new_fine_amount;
     
     //discout amount
     document.getElementById("discount_amount_html_"+fee_group_id).innerHTML=new_discount_amount;
     document.getElementById("discount_amount_value_"+fee_group_id).value=new_discount_amount;
     
     //total fee amount
     document.getElementById("total_amount_html_"+fee_group_id).innerHTML=new_fee_amount;
     document.getElementById("total_amount_value_"+fee_group_id).value=new_fee_amount;
     
     //last total payable amount
     document.getElementById("final_payable_amount").innerHTML=new_final_payable_amount;
     
     //fee_total_amount
     document.getElementById("fee_payable_amount").value=new_fee_total_amount;
     document.getElementById("temp_fee_payable_amount").value=temp_new_fee_total_amount;
    
     
     //fine_total_amount
     document.getElementById("total_fine_amount").value=new_fine_total_amount;
     
     //discount_total_amount
     document.getElementById("total_amount_discount").value=new_discount_total_amount;
     
     //total_payable_amount
     document.getElementById("final_amount_payable_this").value=new_final_payable_amount_value;
     
     var temp_discount_amount=new Number(document.getElementById("total_amount_discount").value);
     var temp_fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
     //discount_total_rate
    if(temp_discount_amount!=0)
        {
     
     var hundred_multiply=100;
     var muliply_discount_rate=new Number((new Number(temp_discount_amount)*new Number(hundred_multiply)));
     var discount_rate=new Number((muliply_discount_rate/temp_fee_group_sub_total_amount).toFixed(2));
        }else
            {
             discount_rate=0;   
            }
     
     //total_discount_rate
     document.getElementById("discount_rate").value=discount_rate;
     
     
     //amount_paid_total_amount
     document.getElementById("amount_paid_value").value=new_final_payable_amount_value;
     document.getElementById("temp_amount_paid_value").value=new_final_payable_amount_value;
     document.getElementById("chequeddamount").value=new_final_payable_amount_value;
     document.getElementById("due_amount").value=0;
     document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value="";
     
     //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
                 document.getElementById("due_amount").value=0;
             }
     
     
     
     
     }else
         {
     
     //fee qty add
     var add_one=1;
     var fee_qty=document.getElementById("fee_qty_"+fee_group_id).value;
     var add_new_fee_qty=new Number(new Number(fee_qty)-new Number(add_one));
     
    
     //fee sub total
     var old_sub_total_amount=new Number(document.getElementById("sub_total_html_"+fee_group_id).innerHTML);
     var new_sub_total_amount=new Number(new Number(old_sub_total_amount)-new Number(fee_amount));
    
    //fee discount
    var old_fee_discount_amount=new Number(document.getElementById("discount_amount_html_"+fee_group_id).innerHTML);
    var new_discount_amount=new Number(new Number(old_fee_discount_amount)-new Number(discount_amount));
    
    //fee fine amount
    var old_fine_amount=new Number(document.getElementById("fine_amount_html_"+fee_group_id).innerHTML);
    var new_fine_amount=new Number(new Number(old_fine_amount)-new Number(fine_amount));
    
    //final fee total amount
    var old_total_fee_amount=new Number(document.getElementById("total_amount_html_"+fee_group_id).innerHTML);
    var new_fee_amount=new Number(new Number(old_total_fee_amount)-new Number(final_payable_amount));
    
    //last final payable amount
    var old_final_payable_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
    var new_final_payable_amount=new Number(new Number(old_final_payable_amount)-new Number(final_payable_amount));
    
    
    
    
    //fee_total_amount_value
    var old_fee_total_amount=new Number(document.getElementById("fee_payable_amount").value);
    var new_fee_total_amount=new Number(new Number(old_fee_total_amount)-new Number(fee_amount));
   
   //temp fee_total_amount_value
    var temp_old_fee_total_amount=new Number(document.getElementById("temp_fee_payable_amount").value);
    var temp_new_fee_total_amount=new Number(new Number(temp_old_fee_total_amount)-new Number(fee_amount));
    
    
    
    //fine_total_amount_value
    var old_fine_total_amount=new Number(document.getElementById("total_fine_amount").value);
    var new_fine_total_amount=new Number(new Number(old_fine_total_amount)-new Number(fine_amount));
    
    //discount_total_amount_value
    var old_discount_total_amount=new Number(document.getElementById("total_amount_discount").value);
    var new_discount_total_amount=new Number(new Number(old_discount_total_amount)-new Number(discount_amount));
    
    //final_payable_amount_value
    var new_final_payable_amount_value=new Number(new_final_payable_amount);
    
    
    //amount_paid_total
    var old_amount_paid_amount=new Number(document.getElementById("amount_paid_value").value);
    var new_amount_paid_amount=new Number(new Number(old_amount_paid_amount)-new Number(final_payable_amount));
    
    
    
    
     
     //put all values
     document.getElementById("fee_qty_"+fee_group_id).value=add_new_fee_qty;
     document.getElementById("fee_group_qty_"+fee_group_id).value=add_new_fee_qty;
     document.getElementById("sub_total_html_"+fee_group_id).innerHTML=new_sub_total_amount;
     document.getElementById("sub_total_value_"+fee_group_id).value=new_sub_total_amount;
    
     //fine amount
     document.getElementById("fine_amount_html_"+fee_group_id).innerHTML=new_fine_amount;
     document.getElementById("fine_amount_value_"+fee_group_id).value=new_fine_amount;
     
     //discout amount
     document.getElementById("discount_amount_html_"+fee_group_id).innerHTML=new_discount_amount;
     document.getElementById("discount_amount_value_"+fee_group_id).value=new_discount_amount;
     
     //total fee amount
     document.getElementById("total_amount_html_"+fee_group_id).innerHTML=new_fee_amount;
     document.getElementById("total_amount_value_"+fee_group_id).value=new_fee_amount;
     
     //last total payable amount
     document.getElementById("final_payable_amount").innerHTML=new_final_payable_amount;
     
     
     
     var checkboxes=document.querySelectorAll('input[class="check_box_style_'+fee_group_id+'"]:checked'),values=[];
     Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
     
     document.getElementById("specific_month_"+fee_group_id).value=values;
     document.getElementById("specify_month_"+fee_group_id).innerHTML=values;
     document.getElementById("specify_month_"+fee_group_id).style.textAlign="justify";
     document.getElementById("specify_month_"+fee_group_id).style.fontSize="10px";
     
     
     
     
     
     //fee_total_amount
     document.getElementById("fee_payable_amount").value=new_fee_total_amount;
      document.getElementById("temp_fee_payable_amount").value=temp_new_fee_total_amount;
    
     //fine_total_amount
     document.getElementById("total_fine_amount").value=new_fine_total_amount;
     
     //discount_total_amount
     document.getElementById("total_amount_discount").value=new_discount_total_amount;
     
     //total_payable_amount
     document.getElementById("final_amount_payable_this").value=new_final_payable_amount_value;
     
     //amount_paid_total_amount
     //amount_paid_total_amount
     document.getElementById("amount_paid_value").value=new_final_payable_amount_value;
     document.getElementById("temp_amount_paid_value").value=new_final_payable_amount_value;
     document.getElementById("chequeddamount").value=new_final_payable_amount_value;
     document.getElementById("due_amount").value=0;
     document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value="";
     
     
     var temp_discount_amount=new Number(document.getElementById("total_amount_discount").value);
     var temp_fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
     //discount_total_rate
    if((temp_discount_amount!=0)||(temp_fee_group_sub_total_amount!=0))
        {
     
     var hundred_multiply=100;
     var muliply_discount_rate=new Number((new Number(temp_discount_amount)*new Number(hundred_multiply)));
     var discount_rate=new Number((muliply_discount_rate/temp_fee_group_sub_total_amount).toFixed(2));
        }else
            {
             discount_rate=0;   
            }
            
            
     //total_discount_rate
     document.getElementById("discount_rate").value=discount_rate;
     
     
   
     //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
                 document.getElementById("due_amount").value=0;
             }
     
     
         }
}





//check due amount

function check_due_amount(due_amount_id,due_amount,due_amount_fine,total_payable_due_amount,discount_amount)
{
    var due_amount_check=document.getElementById("due_amount_checked_"+due_amount_id).checked;
    if(due_amount_check==true)
     {
     document.getElementById("due_qty_"+due_amount_id+"").value=1;
     //last final payable amount
    var old_final_payable_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
    var new_final_payable_amount=new Number(new Number(old_final_payable_amount)+new Number(total_payable_due_amount));
    
    
    
    
    //fee_total_amount_value
    var old_fee_total_amount=new Number(document.getElementById("fee_payable_amount").value);
    var new_fee_total_amount=new Number(new Number(old_fee_total_amount)+new Number(due_amount));
    
    
    
    //fine_total_amount_value
    var old_fine_total_amount=new Number(document.getElementById("total_fine_amount").value);
    var new_fine_total_amount=new Number(new Number(old_fine_total_amount)+new Number(due_amount_fine));
    
    //discount_total_amount_value
    var old_discount_total_amount=new Number(document.getElementById("total_amount_discount").value);
    var new_discount_total_amount=new Number(new Number(old_discount_total_amount)+new Number(discount_amount));
    
    //final_payable_amount_value
    var new_final_payable_amount_value=new Number(new_final_payable_amount);
    
    
    //amount_paid_total
    var old_amount_paid_amount=new Number(document.getElementById("amount_paid_value").value);
    var new_amount_paid_amount=new Number(new Number(old_amount_paid_amount)+new Number(total_payable_due_amount));
    
    
    
    
    
    //last total payable amount
     document.getElementById("final_payable_amount").innerHTML=new_final_payable_amount;
     
     //fee_total_amount
     document.getElementById("fee_payable_amount").value=new_fee_total_amount;
     
     
     //fine_total_amount
     document.getElementById("total_fine_amount").value=new_fine_total_amount;
     
     //discount_total_amount
     document.getElementById("total_amount_discount").value=new_discount_total_amount;
     
     //total_payable_amount
     document.getElementById("final_amount_payable_this").value=new_final_payable_amount_value;
    
     
     //amount_paid_total_amount
     document.getElementById("amount_paid_value").value=new_final_payable_amount_value;
     document.getElementById("temp_amount_paid_value").value=new_final_payable_amount_value;
     document.getElementById("chequeddamount").value=new_final_payable_amount_value;
     document.getElementById("due_amount").value=0;
     document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value="";
     
     
     //discount rate
        var fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var old_discount_amount=new Number(document.getElementById("total_amount_discount").value);
        if(fee_group_sub_total_amount!=0)
            {
        var find_discount_rate=new Number(((old_discount_amount)*(100)/(fee_group_sub_total_amount)).toFixed(2));
        document.getElementById("discount_rate").value=find_discount_rate;
            }  
    
    
     //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
                 document.getElementById("due_amount").value=0;
             }
    
   
     }else
     {
      
      
        //last final payable amount
    var old_final_payable_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
    var new_final_payable_amount=new Number(new Number(old_final_payable_amount)-new Number(total_payable_due_amount));
    
    
    
    
    //fee_total_amount_value
    var old_fee_total_amount=new Number(document.getElementById("fee_payable_amount").value);
    var new_fee_total_amount=new Number(new Number(old_fee_total_amount)-new Number(due_amount));
  
    
    //fine_total_amount_value
    var old_fine_total_amount=new Number(document.getElementById("total_fine_amount").value);
    var new_fine_total_amount=new Number(new Number(old_fine_total_amount)-new Number(due_amount_fine));
    
    //discount_total_amount_value
    var old_discount_total_amount=new Number(document.getElementById("total_amount_discount").value);
    var new_discount_total_amount=new Number(new Number(old_discount_total_amount)-new Number(discount_amount));
    
    //final_payable_amount_value
    var new_final_payable_amount_value=new Number(new_final_payable_amount);
    
    
    //amount_paid_total
    var old_amount_paid_amount=new Number(document.getElementById("amount_paid_value").value);
    var new_amount_paid_amount=new Number(new Number(old_amount_paid_amount)-new Number(total_payable_due_amount));
    
    
    
    
    
    //last total payable amount
     document.getElementById("final_payable_amount").innerHTML=new_final_payable_amount;
     
     //fee_total_amount
     document.getElementById("fee_payable_amount").value=new_fee_total_amount;
    
     
     //fine_total_amount
     document.getElementById("total_fine_amount").value=new_fine_total_amount;
     
     //discount_total_amount
     document.getElementById("total_amount_discount").value=new_discount_total_amount;
     
     //total_payable_amount
     document.getElementById("final_amount_payable_this").value=new_final_payable_amount_value;
    
     
     //amount_paid_total_amount
     document.getElementById("amount_paid_value").value=new_final_payable_amount_value;
     document.getElementById("temp_amount_paid_value").value=new_final_payable_amount_value;
     document.getElementById("chequeddamount").value=new_final_payable_amount_value;
     document.getElementById("due_amount").value=0;
     document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value="";
     
      //discount rate
        var fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var old_discount_amount=new Number(document.getElementById("total_amount_discount").value);
        if(fee_group_sub_total_amount!=0)
            {
        var find_discount_rate=new Number(((old_discount_amount)*(100)/(fee_group_sub_total_amount)).toFixed(2));
        document.getElementById("discount_rate").value=find_discount_rate;
            }
     
     
      //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
                 document.getElementById("due_amount").value=0;
             }
     
      document.getElementById("due_qty_"+due_amount_id+"").value=0;
     }
    
    
}


























//show fee details

function show_full_fee(fee_group_id)
{
   
 document.getElementById("fee_full_show_"+fee_group_id).style.display="block";  
}

function hide_full_fee(fee_group_id)
{
  document.getElementById("fee_full_show_"+fee_group_id).style.display="none";    
}



//add other fee
var number_increase=1;
function add_other_fee_group()
{

var r=confirm("Are you sure you want to add other fee");
if (r==true)
  {
 
     number_increase++;
 
     for(var ij=1;ij<number_increase;ij++)
     {
     
     if(document.getElementById("other_fee_group_id_"+ij))
          {
          
         var other_fee_group_id=document.getElementById("other_fee_group_id_"+ij).value;
         var other_fee_group_name=document.getElementById("other_fee_group_name_"+ij).value;
         var other_fee_group_amount=document.getElementById("other_fee_group_amount_"+ij).value;
         var other_fee_group_qty=document.getElementById("other_fee_group_qty_"+ij).value;
         var other_fee_group_specific_month=document.getElementById("other_fee_group_specific_month_"+ij).value;
         var other_fee_group_sub_total=document.getElementById("other_fee_group_sub_total_value_"+ij).value;
         var other_fee_group_total_amount=document.getElementById("other_fee_group_total_amount_value_"+ij).value;
         
         if(other_fee_group_id==0)
             {
                alert("Please enter fee group id");
                return false;
             }else
             if(other_fee_group_name==0)
             {
                alert("Please enter fee group name");
                document.getElementById("other_fee_group_name_"+ij).focus();
                return false;
             }else
                 if(other_fee_group_amount==0)
                     {
                        alert("Please enter fee group amount");
                        document.getElementById("other_fee_group_amount_"+ij).focus();
                        return false;
                     }else
                         if(isNaN(other_fee_group_amount))
                             {
                        alert("Please enter only numeric value");
                        document.getElementById("other_fee_group_amount_"+ij).focus();
                        return false;    
                             }else
                         if(other_fee_group_qty==0)
                             {
                             alert("Please enter fee group qty");
                             document.getElementById("other_fee_group_qty_"+ij).focus();
                             return false;
                             }else
                             if(isNaN(other_fee_group_qty))
                             {
                             alert("Please enter only numeric value");
                             document.getElementById("other_fee_group_qty_"+ij).focus();
                             return false;
                             }else
                                 if(other_fee_group_specific_month==0)
                                     {
                                         alert("Please enter fee group specific month/annual");
                                         document.getElementById("other_fee_group_specific_month_"+ij).focus();
                                         return false;
                                     }else
                                         if(other_fee_group_sub_total==0)
                                             {
                                             alert("Please enter fee group sub total amount");
                                             return false;    
                                             }else
                                                 if(isNaN(other_fee_group_sub_total))
                                             {
                                             alert("Please enter only numeric value");
                                             return false;    
                                             }else
                                         if(other_fee_group_total_amount==0)
                                             {
                                                alert("Please enter fee group total amount");
                                                return false;
                                             }
                                             }
                                             }



    var table=document.getElementById("fee_first_table");
    var row = table.insertRow(1);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    var cell5 = row.insertCell(4);
    var cell6 = row.insertCell(5);
    var cell7 = row.insertCell(6);
    var cell8 = row.insertCell(7);
    var cell9 = row.insertCell(8);
    var cell10 = row.insertCell(9);
    
    
       if(document.getElementById("alert_due_amount_show"))
        {
        document.getElementById("alert_due_amount_show").style.display="none"; 
        document.getElementById("no_due_amount").value=1;
        }
    
   
    cell1.innerHTML ="<input type='hidden' name='fee_group_id[]' id='other_fee_group_id_"+number_increase+"' value='fee_other_pay'><input type='text' id='other_fee_group_name_"+number_increase+"' placeholder='Enter fee name' class='fee_group_text_box' style='width:160px;' name='fee_group_name[]'>";
    cell2.innerHTML="<input type='hidden' id='temp_other_fee_group_amount_"+number_increase+"'><input type='text'  autocomplete='off' placeholder='Amount' onkeypress='javascript:return isNumber (event)' onkeyup='other_fee_group_amount_value(this.value,"+number_increase+")' id='other_fee_group_amount_"+number_increase+"' class='fee_group_text_box' style='width:40px;' name='fee_group_amount[]'>";
    cell3.innerHTML="<input type='hidden' id='temp_other_fee_group_qty_"+number_increase+"'><input type='text' autocomplete='off' placeholder='Qty' onkeypress='javascript:return isNumber (event)' onkeyup='other_fee_group_qty_value(this.value,"+number_increase+")' id='other_fee_group_qty_"+number_increase+"' class='fee_group_text_box' style='width:31px; text-align:center;' value='1' name='fee_group_qty[]'>";
    cell4.innerHTML ="<input type='text' placeholder='Specific Month' id='other_fee_group_specific_month_"+number_increase+"' class='fee_group_text_box' style='width:90px;' name='fee_group_specific_month[]'>";
    cell5.innerHTML ="<input type='hidden' name='sub_total_fee[]' id='other_fee_group_sub_total_value_"+number_increase+"' value='0'><div class='sub_total_style_sheet' id='other_fee_group_sub_total_html_"+number_increase+"'>0</div>";
    cell6.innerHTML="<input type='hidden'  id='temp_other_fee_group_fine_"+number_increase+"'><input type='text' autocomplete='off' placeholder='Fine' onkeypress='javascript:return isNumber (event)' onkeyup='other_fee_group_fine_value(this.value,"+number_increase+")' id='other_fee_group_fine_"+number_increase+"' class='fee_group_text_box' style='width:40px;' name='fine_total_fee[]'>";
    cell7.innerHTML="<input type='hidden' id='temp_other_fee_group_discount_"+number_increase+"'><input type='text' autocomplete='off' placeholder='Discount' onkeypress='javascript:return isNumber (event)' onkeyup='other_fee_group_discount_value(this.value,"+number_increase+")' id='other_fee_group_discount_"+number_increase+"' class='fee_group_text_box' style='width:43px;' name='discount_total_fee[]'>";
    cell8.innerHTML ="<input type='hidden' name='total_amount[]' id='other_fee_group_total_amount_value_"+number_increase+"' value='0'><div class='sub_total_style_sheet' id='other_fee_group_total_amount_html_"+number_increase+"'>0</div>";
    cell9.innerHTML ="<input type='checkbox' checked disabled>";
    cell10.innerHTML='<input type="button" class="remove_button_style" onclick="removeen(this,'+number_increase+')" value="Remove">'

for(var i=1;i<=9;i++)
    {
cell1.style.borderLeft="1px solid silver";
cell1.style.borderBottom="1px solid silver";

cell2.style.borderLeft="1px solid silver";
cell2.style.borderBottom="1px solid silver";

cell3.style.borderLeft="1px solid silver";
cell3.style.borderBottom="1px solid silver";

cell4.style.borderLeft="1px solid silver";
cell4.style.borderBottom="1px solid silver";

cell5.style.borderLeft="1px solid silver";
cell5.style.borderBottom="1px solid silver";
cell5.style.textAlign="center";

cell6.style.borderLeft="1px solid silver";
cell6.style.borderBottom="1px solid silver";

cell7.style.borderLeft="1px solid silver";
cell7.style.borderBottom="1px solid silver";

cell8.style.borderLeft="1px solid silver";
cell8.style.borderBottom="1px solid silver";
cell8.style.textAlign="center";
cell9.style.borderLeft="1px solid silver";
cell9.style.borderBottom="1px solid silver";
cell9.style.textAlign="center";

cell10.style.borderLeft="1px solid silver";
cell10.style.borderBottom="1px solid silver";
cell10.style.borderRight="1px solid silver";


    }

  }
}

//remove other fees

function removeen(row,number_position)
{   

var r=confirm("Are you sure you want to remove");
if (r==true)
  {
   
   var old_other_sub_total_amount=new Number(document.getElementById("other_fee_group_sub_total_value_"+number_position).value);
   var old_other_fine_amount=new Number(document.getElementById("other_fee_group_fine_"+number_position).value);
   var old_other_discount_amount=new Number(document.getElementById("other_fee_group_discount_"+number_position).value);
   var old_other_total_amount=new Number(document.getElementById("other_fee_group_total_amount_value_"+number_position).value);
   
   
   var sub_total_fee_amount=new Number(document.getElementById("fee_payable_amount").value);
   var total_fine_amount=new Number(document.getElementById("total_fine_amount").value);
   var total_discount_amount=new Number(document.getElementById("total_amount_discount").value);
   var total_amount=new Number(document.getElementById("final_amount_payable_this").value);
   
   
   //new sub total amount
   var new_sub_total_fee_amount=new Number(sub_total_fee_amount-old_other_sub_total_amount);
   
   //new fine amount
   var new_fine_amount=new Number(total_fine_amount-old_other_fine_amount);
       
   //new discount amount
   var new_discount_amount=new Number(total_discount_amount-old_other_discount_amount);
   
//new total amount
var new_total_amount=new Number(total_amount-old_other_total_amount);




//insert values
    document.getElementById("fee_payable_amount").value=new_sub_total_fee_amount;
    document.getElementById("total_fine_amount").value=new_fine_amount;
    document.getElementById("total_amount_discount").value=new_discount_amount;
    document.getElementById("final_amount_payable_this").value=new_total_amount;
    document.getElementById("final_payable_amount").innerHTML=new_total_amount;
    document.getElementById("amount_paid_value").value=new_total_amount;
    document.getElementById("chequeddamount").value=new_total_amount;
    document.getElementById("temp_amount_paid_value").value=new_total_amount;
     document.getElementById("due_amount").value=0;
     document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value="";
     //discount rate
        var fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var old_discount_amount=new Number(document.getElementById("total_amount_discount").value);
        if(fee_group_sub_total_amount!=0)
            {
        var find_discount_rate=new Number(((old_discount_amount)*(100)/(fee_group_sub_total_amount)).toFixed(2));
        document.getElementById("discount_rate").value=find_discount_rate;
            }else
                {
                  document.getElementById("discount_rate").value=0;  
                }
   
   var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('fee_first_table').deleteRow(i);   
    
    
    //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
                 document.getElementById("due_amount").value=0;
             }
    
    if(i==2)
        {
    if(document.getElementById("alert_due_amount_show"))
        {
        $(document).ready(function(){
            $("#alert_due_amount_show").show();
        });
        document.getElementById("no_due_amount").value=0;
        }
        }
    
  }
}


//fee other amount keyup
function other_fee_group_amount_value(fee_group_amount,number_position)
{
  var temp_old_fee_group_amount=document.getElementById("temp_other_fee_group_amount_"+number_position).value;
  if(isNaN(fee_group_amount))
      {
      alert("Please enter only numeric value");
      document.getElementById("other_fee_group_amount_"+number_position).value=temp_old_fee_group_amount;
      document.getElementById("other_fee_group_amount_"+number_position).focus();
      return false;
      }else
          {
        var old_other_sub_total_amount=new Number(document.getElementById("other_fee_group_sub_total_value_"+number_position).value);
        var old_other_total_amount=new Number(document.getElementById("other_fee_group_total_amount_value_"+number_position).value);
        
        //new first total amount
        var new_first_total_amount_value=new Number(old_other_total_amount-old_other_sub_total_amount);
        
        
        var qty_value=new Number(document.getElementById("other_fee_group_qty_"+number_position).value);
         var sub_total_value=new Number(new Number(qty_value)*new Number(fee_group_amount));
      
      
      //new second total amount
      var new_second_total_amount=new Number(new_first_total_amount_value+sub_total_value);
         
        
         
         
         //insert sub total value
         document.getElementById("other_fee_group_sub_total_value_"+number_position).value=sub_total_value;
         document.getElementById("other_fee_group_sub_total_html_"+number_position).innerHTML=sub_total_value;
         
         //insert total amount
         document.getElementById("other_fee_group_total_amount_value_"+number_position).value=new_second_total_amount;
         document.getElementById("other_fee_group_total_amount_html_"+number_position).innerHTML=new_second_total_amount;
         
         
         
         
         //fee total amount
        var fee_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var deduct_old_other_fee_group_amount=new Number(fee_sub_total_amount-old_other_sub_total_amount);
        var new_other_sub_total_fee_group_amount=new Number(deduct_old_other_fee_group_amount+sub_total_value);
        
        document.getElementById("fee_payable_amount").value=new_other_sub_total_fee_group_amount;
        
        //fee total amount payable
        var fee_total_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
        var deduct_old_other_total_fee_amount=new Number(fee_total_amount-old_other_total_amount);
        var add_new_other_total_fee_amount=new Number(deduct_old_other_total_fee_amount+new_second_total_amount);
        document.getElementById("final_amount_payable_this").value=add_new_other_total_fee_amount;
        document.getElementById("final_payable_amount").innerHTML=add_new_other_total_fee_amount;
        document.getElementById("amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("chequeddamount").value=add_new_other_total_fee_amount;
        document.getElementById("temp_amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("due_amount").value=0;
         document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value="";
        //discount rate
        var fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var old_discount_amount=new Number(document.getElementById("total_amount_discount").value);
        
        var find_discount_rate=new Number(((old_discount_amount)*(100)/(fee_group_sub_total_amount)).toFixed(2));
        document.getElementById("discount_rate").value=find_discount_rate;
        
         
         document.getElementById("temp_other_fee_group_amount_"+number_position).value=fee_group_amount;
         
    //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
                 document.getElementById("due_amount").value=0;
             } 
 }
}



//fee group qty key up
function other_fee_group_qty_value(fee_group_qty_value,number_position)
{
 
 
 
  var temp_old_fee_group_amount=document.getElementById("temp_other_fee_group_qty_"+number_position).value;
  if(isNaN(fee_group_qty_value))
      {
      alert("Please enter only numeric value");
      document.getElementById("other_fee_group_qty_"+number_position).value=temp_old_fee_group_amount;
      document.getElementById("other_fee_group_qty_"+number_position).focus();
      return false;
      }else
          {
       var fee_group_amount=new Number(document.getElementById("other_fee_group_amount_"+number_position).value);
        var old_other_sub_total_amount=new Number(document.getElementById("other_fee_group_sub_total_value_"+number_position).value);
        var old_other_total_amount=new Number(document.getElementById("other_fee_group_total_amount_value_"+number_position).value);
        
        //new first total amount
        var new_first_total_amount_value=new Number(old_other_total_amount-old_other_sub_total_amount);
        
        
        var qty_value=new Number(fee_group_qty_value);
         var sub_total_value=new Number(new Number(qty_value)*new Number(fee_group_amount));
      
      
      //new second total amount
      var new_second_total_amount=new Number(new_first_total_amount_value+sub_total_value);
         
        
         
         
         //insert sub total value
         document.getElementById("other_fee_group_sub_total_value_"+number_position).value=sub_total_value;
         document.getElementById("other_fee_group_sub_total_html_"+number_position).innerHTML=sub_total_value;
         
         //insert total amount
         document.getElementById("other_fee_group_total_amount_value_"+number_position).value=new_second_total_amount;
          document.getElementById("other_fee_group_total_amount_html_"+number_position).innerHTML=new_second_total_amount;
         
         //fee total amount
        var fee_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var deduct_old_other_fee_group_amount=new Number(fee_sub_total_amount-old_other_sub_total_amount);
        var new_other_sub_total_fee_group_amount=new Number(deduct_old_other_fee_group_amount+sub_total_value);
        
        document.getElementById("fee_payable_amount").value=new_other_sub_total_fee_group_amount;
        
        //fee total amount payable
        var fee_total_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
        var deduct_old_other_total_fee_amount=new Number(fee_total_amount-old_other_total_amount);
        var add_new_other_total_fee_amount=new Number(deduct_old_other_total_fee_amount+new_second_total_amount);
        document.getElementById("final_amount_payable_this").value=add_new_other_total_fee_amount;
        document.getElementById("final_payable_amount").innerHTML=add_new_other_total_fee_amount;
        document.getElementById("amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("chequeddamount").value=add_new_other_total_fee_amount;
        document.getElementById("temp_amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("due_amount").value=0;
        document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value=""; 
         
          //discount rate
        var fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var old_discount_amount=new Number(document.getElementById("total_amount_discount").value);
        
        var find_discount_rate=new Number(((old_discount_amount)*(100)/(fee_group_sub_total_amount)).toFixed(2));
        document.getElementById("discount_rate").value=find_discount_rate;
        
         
         
         
         document.getElementById("temp_other_fee_group_qty_"+number_position).value=fee_group_qty_value;
         
    //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
              document.getElementById("due_amount").value=0;
             } 
 }
}





//fee group fine key up

function other_fee_group_fine_value(other_fee_group_fine_amount,number_position)
{
  var temp_old_fine_amount=document.getElementById("temp_other_fee_group_fine_"+number_position).value; 
 
  if(isNaN(other_fee_group_fine_amount))
      {
        alert("Please enter only numeric value");
        document.getElementById("other_fee_group_fine_"+number_position).value=temp_old_fine_amount;
            document.getElementById("other_fee_group_fine_"+number_position).focus();
        return false;
      }else
      {
       
       var old_temp_fine_amount=new Number(document.getElementById("temp_other_fee_group_fine_"+number_position).value);
       var old_other_total_amount=new Number(document.getElementById("other_fee_group_total_amount_value_"+number_position).value);
       
       var temp_old_total_amount=new Number(old_other_total_amount-old_temp_fine_amount);
       
       var new_old_total_amount=new Number(new Number(temp_old_total_amount)+new Number(other_fee_group_fine_amount));
       
       
     
       //insert other total amount
       document.getElementById("other_fee_group_total_amount_value_"+number_position).value=new_old_total_amount;
       document.getElementById("other_fee_group_total_amount_html_"+number_position).innerHTML=new_old_total_amount;
       
       //fine total amount
        var fine_total_amount=new Number(document.getElementById("total_fine_amount").value);
        var deduct_old_other_fee_group_fine_amount=new Number(fine_total_amount-old_temp_fine_amount);
        var new_other_fine_total_fee_group_amount=new Number(new Number(deduct_old_other_fee_group_fine_amount)+new Number(other_fee_group_fine_amount));
        
        document.getElementById("total_fine_amount").value=new_other_fine_total_fee_group_amount;
        
       
       
       //fee total amount payable
       var fee_total_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
        var deduct_old_other_total_fee_amount=new Number(fee_total_amount-old_other_total_amount);
        var add_new_other_total_fee_amount=new Number(deduct_old_other_total_fee_amount+new_old_total_amount);
        document.getElementById("final_amount_payable_this").value=add_new_other_total_fee_amount;
        document.getElementById("final_payable_amount").innerHTML=add_new_other_total_fee_amount;
        document.getElementById("amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("chequeddamount").value=add_new_other_total_fee_amount;
        document.getElementById("temp_amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("due_amount").value=0;
         document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value="";
     
        //discount rate
        var fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var old_discount_amount=new Number(document.getElementById("total_amount_discount").value);
        
        var find_discount_rate=new Number(((old_discount_amount)*(100)/(fee_group_sub_total_amount)).toFixed(2));
        document.getElementById("discount_rate").value=find_discount_rate;
        
       
       
       document.getElementById("temp_other_fee_group_fine_"+number_position).value=other_fee_group_fine_amount;
       
       //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
                 document.getElementById("due_amount").value=0;
             }
    }
  
   
}



//fee group discount key up
function other_fee_group_discount_value(other_fee_group_discount_value,number_position)
{
 var temp_old_fine_amount=document.getElementById("temp_other_fee_group_discount_"+number_position).value; 
 var check_condition_old_sub_total_amount=new Number(document.getElementById("other_fee_group_sub_total_value_"+number_position).value);
     
     
  if(isNaN(other_fee_group_discount_value))
      {
        alert("Please enter only numeric value");
        document.getElementById("other_fee_group_discount_"+number_position).value=temp_old_fine_amount;
        document.getElementById("temp_other_fee_group_discount_"+number_position).focus();
        return false;
      }else
      if(check_condition_old_sub_total_amount<other_fee_group_discount_value)
         {
        alert("Please enter mininum value");
        document.getElementById("other_fee_group_discount_"+number_position).value=temp_old_fine_amount;
        document.getElementById("temp_other_fee_group_discount_"+number_position).focus();
        return false;   
         }
      else
      {
       
       var old_temp_discount_amount=new Number(document.getElementById("temp_other_fee_group_discount_"+number_position).value);
       var old_total_amount=new Number(document.getElementById("other_fee_group_total_amount_value_"+number_position).value);
       
       var temp_old_total_amount=new Number(old_total_amount+old_temp_discount_amount);
       
       var new_old_total_amount=new Number(new Number(temp_old_total_amount)-new Number(other_fee_group_discount_value));
       
       
     
       //insert other total amount
       document.getElementById("other_fee_group_total_amount_value_"+number_position).value=new_old_total_amount;
       document.getElementById("other_fee_group_total_amount_html_"+number_position).innerHTML=new_old_total_amount;
       
       
       //discount total amount
        var discount_total_amount=new Number(document.getElementById("total_amount_discount").value);
        var deduct_old_other_fee_group_discount_amount=new Number(discount_total_amount-old_temp_discount_amount);
        var new_other_discount_total_fee_group_amount=new Number(new Number(deduct_old_other_fee_group_discount_amount)+new Number(other_fee_group_discount_value));
        
        document.getElementById("total_amount_discount").value=new_other_discount_total_fee_group_amount;
        
       
       
       //fee total amount payable
        var fee_total_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
        var deduct_old_other_total_fee_amount=new Number(fee_total_amount+old_temp_discount_amount);
        var add_new_other_total_fee_amount=new Number(new Number(deduct_old_other_total_fee_amount)-new Number(other_fee_group_discount_value));
        document.getElementById("final_amount_payable_this").value=add_new_other_total_fee_amount;
        document.getElementById("final_payable_amount").innerHTML=add_new_other_total_fee_amount;
        document.getElementById("amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("chequeddamount").value=add_new_other_total_fee_amount;
        document.getElementById("temp_amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("due_amount").value=0;
        document.getElementById("total_fine_discount").value=0;
     document.getElementById("total_fine_discount_description").value="";
     document.getElementById("total_special_discount_amount").value=0;
     document.getElementById("special_description").value="";
     document.getElementById("get_fine_discount_amount").value="";
     document.getElementById("fine_description").value="";
     document.getElementById("special_discount_amount").value="";
     document.getElementById("discount_description").value="";
     
        //discount rate
        var fee_group_sub_total_amount=new Number(document.getElementById("fee_payable_amount").value);
        var old_discount_amount=new Number(document.getElementById("total_amount_discount").value);
        
        var find_discount_rate=new Number(((old_discount_amount)*(100)/(fee_group_sub_total_amount)).toFixed(2));
        document.getElementById("discount_rate").value=find_discount_rate;
        
       
       document.getElementById("temp_other_fee_group_discount_"+number_position).value=other_fee_group_discount_value;
       
       //last minual amount paid value insert due amount
     var student_final_payable_fee=new Number(document.getElementById("final_amount_payable_this").value);
     if(student_final_payable_fee<0)
         {
          
         document.getElementById("due_amount").value=student_final_payable_fee;
         }else
             {
                 document.getElementById("due_amount").value=0;
             }
    }
  
      
}






//amount paid live key up
function amount_payable(amount_payable_paid)
{
    var amount_paid_value=new Number(document.getElementById("amount_paid_value").value);
    var temp_amount_payable=new Number(document.getElementById("temp_amount_paid_value").value);
    var temp_due_amount_payble=new Number(document.getElementById("due_amount").value);
    var temp_amount_payable_amount=new Number(temp_amount_payable-temp_due_amount_payble);
    if(isNaN(amount_payable_paid))
        {
       alert("Please fill only numeric value");
       document.getElementById("amount_paid_value").value=temp_amount_payable_amount;
       return false;
        }else
            {
           
           var temp_due_amount=new Number(temp_amount_payable-amount_paid_value);  
            document.getElementById("due_amount").value=temp_due_amount; 
               
                
            }
   
}



//cheque_dd_amount key up value

function cheque_amount_payable(amount_payable_paid)
{
    var amount_paid_value=new Number(document.getElementById("chequeddamount").value);
    var temp_amount_payable=new Number(document.getElementById("temp_amount_paid_value").value);
    var temp_due_amount_payble=new Number(document.getElementById("due_amount").value);
    var temp_amount_payable_amount=new Number(temp_amount_payable-temp_due_amount_payble);
    if(isNaN(amount_payable_paid))
        {
       alert("Please fill only numeric value");
       document.getElementById("amount_paid_value").value=temp_amount_payable_amount;
       return false;
        }else
            {
           
           var temp_due_amount=new Number(temp_amount_payable-amount_paid_value);  
            document.getElementById("due_amount").value=temp_due_amount; 
            document.getElementById("amount_paid_value").value=amount_payable_paid;
             
            } 
}



//change payment mode

function change_payment_mode(payment_mode)
{
if(payment_mode=="cash")
    {
       document.getElementById("showchequeanddddetails").style.display="none"; 
       document.getElementById("chequeddamount").value="";
       document.getElementById("amount_paid_value").readOnly = false;
         document.getElementById("amount_paid_value").style.backgroundColor="white";
         
    }else
        {
         document.getElementById("showchequeanddddetails").style.display="block";   
        var amount_paid_value=new Number(document.getElementById("amount_paid_value").value);
         document.getElementById("chequeddamount").value=amount_paid_value;
         document.getElementById("amount_paid_value").readOnly = true;
         document.getElementById("amount_paid_value").style.backgroundColor="aliceblue";
         
        }
}


//show due amount
function show_due_amount(due_amount_id)
{
document.getElementById("due_amount_"+due_amount_id).style.display="block"; 
}


//hide due amount
function hide_due_amount(due_amount_id)
{
  document.getElementById("due_amount_"+due_amount_id).style.display="none";   
}




//pop up close button 
function close_button(close_no)
{
 document.getElementById("full_width_id").style.display="none";
 document.getElementById("notification_alert_id").style.display="none";
}



//modify fee (fee wise)

function add_discount()
{
    
var total_fine_amount=new Number(document.getElementById("total_fine_amount").value);
document.getElementById("fine_amount_discount").value=total_fine_amount;

    
    
 document.getElementById("full_width_show").style.display="block";
 document.getElementById("show_discount_full_width").style.display="block";
    
}

//fine discount type
function fine_discount_type()
{
 document.getElementById("temp_get_fine_discount_amount").value="";   
 document.getElementById("get_fine_discount_amount").value="";   
}
//spacial discount type

function special_discount_type()
{
  document.getElementById("temp_special_discount_amount").value="";   
 document.getElementById("special_discount_amount").value="";     
}


//fine discount amount key up
function fine_discount_key_up(fine_discount_value)
{
    var temp_fine_discount=new Number(document.getElementById("temp_get_fine_discount_amount").value);  
    if(isNaN(fine_discount_value))
        {
          alert("Please enter only numeric value");
          document.getElementById("get_fine_discount_amount").value=temp_fine_discount;
          return false;
        }else
            {
           var fine_amount=new Number(document.getElementById("fine_amount_discount").value);
           var fine_discount_type=document.getElementById("fine_discount_type").value;
           if(fine_discount_type=="percantage")
               {
                var final_fine_amount=new Number((fine_amount*fine_discount_value)/100);
                
               }else
                if(fine_discount_type=="flat")
                    {
                     final_fine_amount=new Number(fine_discount_value);   
                    }
              
           
            if(fine_amount<final_fine_amount)
                {
                   alert("Please enter minimum value");
                   document.getElementById("get_fine_discount_amount").value=temp_fine_discount;
                    document.getElementById("get_fine_discount_amount").focus();
                   return false;
                }else
                    {
            
            document.getElementById("temp_get_fine_discount_amount").value=fine_discount_value;  
            document.getElementById("get_fine_discount_amount").focus();
                    }
            }   
}

//special discount key up
function discount_amount_value(discount_value)
{
 
 var temp_special_discount_amount=document.getElementById("temp_special_discount_amount").value;
 if(isNaN(discount_value))
     {
      alert("Please enter only numeric value");
      document.getElementById("special_discount_amount").value=temp_special_discount_amount;
      document.getElementById("special_discount_amount").focus();
      return false;
     }else
     {
     var final_amount_paid=new Number(document.getElementById("final_payable_amount").innerHTML);
    
    //fine amount
           var fine_amount=new Number(document.getElementById("total_fine_amount").value);
           var fine_discount_type=document.getElementById("fine_discount_type").value;
           var fine_discount_value=new Number(document.getElementById("get_fine_discount_amount").value);
           if(fine_discount_type=="percantage")
               {
                var final_fine_amount=new Number((fine_amount*fine_discount_value)/100);
                
               }else
                if(fine_discount_type=="flat")
                    {
                     final_fine_amount=new Number(fine_discount_value);   
                    }
     
     var old_payable_amount=new Number(final_amount_paid-final_fine_amount);
     
     
     var spacial_discount_type=document.getElementById("special_discount_type").value;
     if(spacial_discount_type=="percantage")
       {
        
       var final_discount_value=new Number((old_payable_amount*discount_value)/100); 
       }else
           if(spacial_discount_type=="flat")
               {
                  final_discount_value=discount_value; 
               }
     
     
     
     if(old_payable_amount<final_discount_value)
         {
          alert("Please enter minimum value");
          document.getElementById("special_discount_amount").value=temp_special_discount_amount;
          document.getElementById("special_discount_amount").focus();
          return false;
         }else
             {
          document.getElementById("temp_special_discount_amount").value=discount_value; 
             }
         
     
           
     }
}

function add_discount_button()
{
    
 
    
    
    
    var discount_fine_amount=new Number(document.getElementById("get_fine_discount_amount").value);
    var special_discount=new Number(document.getElementById("special_discount_amount").value);
    
    var fine_description=document.getElementById("fine_description").value;
    var discount_description=document.getElementById("discount_description").value;
    
    
    if((discount_fine_amount==0)&&(special_discount==0))
        {
        alert("Please enter fine discount/special discount");
        return false;
        }else
       if(isNaN(discount_fine_amount) || isNaN(special_discount))
        {
        alert("Please enter only numeric value");
        return false;
        }else
            if((discount_fine_amount!=0)&&(fine_description==0))
                {
               alert("Please enter description");
               document.getElementById("fine_description").focus();
               return false;
                }else
                    if((special_discount!=0)&&(discount_description==0))
                        {
                      alert("Please enter description");
                      document.getElementById("discount_description").focus();
                      return false;
                        }else
                        {
var r=confirm("Are you sure you want to add discount");
if (r==true)
   {
              
              var student_payable_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
                
                //fine discount
                var fine_amount=new Number(document.getElementById("total_fine_amount").value);
                
                if(discount_fine_amount!=0)
                    {
                var fine_discount_type=document.getElementById("fine_discount_type").value;
                if(fine_discount_type=="percantage")
                    {
                     
                     var fine_amount_discount=new Number((fine_amount*discount_fine_amount)/100);
                     
                       
                    }else
                      if(fine_discount_type=="flat")
                    {
                       var fine_amount_discount=new Number(discount_fine_amount);  
                    } 
                    
                 
                    }else
                        {
                         fine_amount_discount=0;   
                        }
                
                 var get_final_payable_amount=new Number(student_payable_amount-fine_amount_discount);
                  document.getElementById("final_amount_payable_this").value=get_final_payable_amount;
                  document.getElementById("amount_paid_value").value=get_final_payable_amount;
        document.getElementById("chequeddamount").value=get_final_payable_amount;
        document.getElementById("temp_amount_paid_value").value=get_final_payable_amount;
        document.getElementById("due_amount").value=0;
                
                
                
                if(fine_amount_discount!=0)
                    {
                    $(document).ready(function(){
                        $("#fine_discount_tr").show();
                    })
                   document.getElementById("total_fine_discount").value=fine_amount_discount;
                   document.getElementById("total_fine_discount_description").value=fine_description;
                    }else
                        {
                         $(document).ready(function(){
                        $("#fine_discount_tr").hide();
                    });  
                        }
                
                
                
                
                
                
                //spacial discount
                
                   var final_amount_payable=new Number(document.getElementById("final_payable_amount").innerHTML);
                   
                   var spacial_discount_type=document.getElementById("special_discount_type").value; 
                   if(spacial_discount_type=="percantage")
                       {
                        if(final_amount_payable!=0)
                            {
                       var spacial_discount_amount_pay=new Number(((final_amount_payable-fine_amount_discount)*(special_discount))/100);   
                            }else
                                {
                               var spacial_discount_amount_pay=0;     
                                }
                          
                       }else
                         if(spacial_discount_type=="flat")
                       {
                       if(final_amount_payable!=0)
                            {
                        var spacial_discount_amount_pay=new Number(special_discount);    
                            }else
                                {
                               var spacial_discount_amount_pay=0;     
                                }
                        } 
                        
                      
                        
                        
                        
                        
                        if(spacial_discount_amount_pay!=0)
                            {
                        
                         $(document).ready(function(){
                         $("#special_discount_tr").show();
                            }); 
                            }else
                                {
                                 $(document).ready(function(){
                                 $("#special_discount_tr").hide();
                                 });    
                                }
                        
                   //total discount add
                   document.getElementById("total_special_discount_amount").value=spacial_discount_amount_pay;
                   document.getElementById("special_description").value=discount_description;
                        
                  var get_final_payable_amount_discount=new Number((final_amount_payable-fine_amount_discount)-spacial_discount_amount_pay);
                  document.getElementById("final_amount_payable_this").value=get_final_payable_amount_discount;
                  
                  document.getElementById("amount_paid_value").value=get_final_payable_amount_discount;
        document.getElementById("chequeddamount").value=get_final_payable_amount_discount;
        document.getElementById("temp_amount_paid_value").value=get_final_payable_amount_discount;
        document.getElementById("due_amount").value=0;
                  
                  
                  alert("Discount add successfully complete");
                  document.getElementById("full_width_show").style.display="none";
                   document.getElementById("show_discount_full_width").style.display="none";
                    
                    }
                    
                    
                    }
                 
}



//clear amount
function clear_button()
{
 var r=confirm("Are you sure you want to clear fine discount/special discount");
if (r==true)
   {
       
    document.getElementById("total_fine_discount").value="";
    document.getElementById("total_fine_discount_description").value="";
    document.getElementById("total_special_discount_amount").value="";
    document.getElementById("special_description").value="";
    document.getElementById("special_discount_tr").style.display="none";
    document.getElementById("fine_discount_tr").style.display="none";
    
    document.getElementById("get_fine_discount_amount").value="";
    document.getElementById("fine_description").value="";
    document.getElementById("special_discount_amount").value="";
    document.getElementById("discount_description").value="";
    document.getElementById("special_discount_file").value="";
    document.getElementById("fine_discount_file").value="";
   
        var add_new_other_total_fee_amount=new Number(document.getElementById("final_payable_amount").innerHTML);
    
        document.getElementById("final_amount_payable_this").value=add_new_other_total_fee_amount;
        document.getElementById("amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("chequeddamount").value=add_new_other_total_fee_amount;
        document.getElementById("temp_amount_paid_value").value=add_new_other_total_fee_amount;
        document.getElementById("due_amount").value=0;
         
       
       
       
   }   
}


//close modify fee
function close_button_div(fee_group_id)
{
 document.getElementById("full_width_show").style.display="none";
 document.getElementById("show_discount_full_width").style.display="none";
     
}