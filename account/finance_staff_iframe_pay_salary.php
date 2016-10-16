
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
        <style>
            #main_table{ font-size:12px; }
             .emp_class{ width:auto; height:23px; background-color:white; text-align:center; border-top:1px solid silver;   border-left:1px solid silver; 
       border-bottom: 1px solid silver; font-weight:700; }
       .same_fetch_style{ width:auto; border-left:1px solid silver; padding-left:3px; font-weight:100;   border-bottom:1px solid silver;    }
        #bottom_td_style{height:23px;   background-color:white; border-bottom:1px solid silver;  border-left:1px solid silver;    }
       #td_total{ background-color: white;font-weight:700; border-bottom:1px solid silver; padding-left:5px;   }
        .add_button_reset_button{ width:auto; padding-left:10px; padding-right:10px;   height:23px; 
                                  margin-left:12px; font-size:12px; float:right; margin-right:5px;  
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-image:url('finanacephoto/bgblack.png');}
        </style>
    </head>
    <body style=" margin: 0; padding: 0;">
   <?php 
     if(!empty($_REQUEST['month_year'])&&(!empty($_REQUEST['particularmonth'])))
     {
      $this_month_attendance=$_REQUEST['month_year'];
      $particular_month=$_REQUEST['particularmonth'];
     {
     ?>
     <table id="main_table" cellspacing="0" cellpadding="0" style=" width:100%;font-family:arial;   ">
                                            <tr>
                                                <td class="emp_class">
                                                  Sl.No.  
                                                </td>
                                                <td class="emp_class">
                                                 Employee ID 
                                                </td>
                                                <td class="emp_class">
                                                 Employee Name  
                                                </td>
                                                <td class="emp_class">
                                                 Father Name  
                                                </td>
                                                <td class="emp_class">
                                                 Mobile No.
                                                </td>
                                                <td class="emp_class" style=" width:113px; ">
                                                 No Of Working Day
                                                </td>
                                                <td class="emp_class">
                                                 Amount
                                                </td>
                                                <td class="emp_class" style=" width:85px; ">
                                                    Select All <input type="checkbox" checked>
                                                </td>
                                            </tr>
     <?php 
       require_once '../connection.php';
       $row=0;
       $final_pad_amount=0;
       $employee_db_details=mysql_query("SELECT * FROM  employeedatabase WHERE id order by employeefirstname ASC");
       while ($employee_fetch_value=  mysql_fetch_array($employee_db_details))
       {
           $row++;
           $fetchstudentid=$employee_fetch_value['employeeid'];
           $fetch_employee_name=$employee_fetch_value['employeetempname'];
           $fetch_employee_father_name=$employee_fetch_value['employeefathername'];
           $fetch_employee_number=$employee_fetch_value['currentofmobileno'];
           
   
    
    $setfetchmonth=$this_month_attendance;
    
    //prsentattendancemorningandevning
    $Mtwotimematchattandancedata=mysql_query("SELECT * FROM attendanceemployeemorningevningdata WHERE  employeeid='$fetchstudentid' and month='$setfetchmonth' and mattandance='P'"); 
    $Mtwotimeconformmatch= mysql_num_rows($Mtwotimematchattandancedata);
    $Etwotimematchattandancedata=mysql_query("SELECT * FROM attendanceemployeemorningevningdata WHERE  employeeid='$fetchstudentid' and month='$setfetchmonth' and eattendance='P'"); 
    $Etwotimeconformmatch=mysql_num_rows($Etwotimematchattandancedata);
    //ENDMORNINGANDEVNINGCODE
   
    //absentattendancemorningandevning
    $Mtwotimematchattandancedataabsent=mysql_query("SELECT * FROM attendanceemployeemorningevningdata  WHERE employeeid='$fetchstudentid' and month='$setfetchmonth' and mattandance='A'"); 
    $Mtwotimeconformmatchabsent=mysql_num_rows($Mtwotimematchattandancedataabsent);
    $Etwotimematchattandancedataabsent=mysql_query("SELECT * FROM attendanceemployeemorningevningdata  WHERE employeeid='$fetchstudentid' and month='$setfetchmonth' and eattendance='A'"); 
    $Etwotimeconformmatchabsent=mysql_num_rows($Etwotimematchattandancedataabsent);
    //ENDabsentMORNINGANDEVNINGCODE
   
   
   //STARTSTUDENTLEAVEATTENDANCE
     $Mtwotimematchattandancedataleave=mysql_query("SELECT * FROM attendanceemployeemorningevningdata  WHERE employeeid='$fetchstudentid' and month='$setfetchmonth' and mattandance='L'"); 
                          $Mtwotimeleaveconformmatch=mysql_num_rows($Mtwotimematchattandancedataleave);
                          
      $Etwotimematchattandancedataleave=mysql_query("SELECT * FROM attendanceemployeemorningevningdata  WHERE employeeid='$fetchstudentid' and month='$setfetchmonth' and eattendance='L'"); 
                          $Etwotimeleaveconformmatch=mysql_num_rows($Etwotimematchattandancedataleave);                     
     
                         
                     
   //ENDATTENDANCESTUDENTLEAVE 
    $morningandevningattendance=($Mtwotimeconformmatch+$Etwotimeconformmatch);
    
    $addbothstudentleaves=($Mtwotimeleaveconformmatch+$Etwotimeleaveconformmatch);
    
     $finaloutputabsent=($Mtwotimeconformmatchabsent+$Etwotimeconformmatchabsent);
 
    
    
    //onlyonetimeattancesolveprocess
    $matchattandancedata=mysql_query("SELECT * FROM attendanceemployeeonetime WHERE employeeid='$fetchstudentid' and month='$setfetchmonth' and attandance='P'"); 
    $conformmatch= mysql_num_rows($matchattandancedata);                 
     $matchattandancedataleave=mysql_query("SELECT * FROM attendanceemployeeonetime  WHERE employeeid='$fetchstudentid' and month='$setfetchmonth' and attandance='L'"); 
                          $leaveconformmatch=mysql_num_rows($matchattandancedataleave);
      $matchattandancedataabsent=mysql_query("SELECT * FROM attendanceemployeeonetime WHERE employeeid='$fetchstudentid' and month='$setfetchmonth' and attandance='A'"); 
                          $leaveconformmatchabsent=mysql_num_rows($matchattandancedataabsent);
                          
                          
                          
   //mathematicssolveattendanceprocess                       
                         
                          
                          
                          
//studenttotalprsentlecture                          
$totallectureofstudent=($conformmatch+$morningandevningattendance);
//end

//startstudenttotalabsent
$totalstudentabsentlecture=($leaveconformmatchabsent+$finaloutputabsent);
//end


//startstudenttotalleaveinmonth
$totalstudentleaveinlecture=($leaveconformmatch+$addbothstudentleaves);
 //end                         
                         


//startstudentsolvepercantage
                       
   $processsolvestudentleave=($totalstudentleaveinlecture)/4; 

  $addprsentandleaveattendance=($totallectureofstudent+$processsolvestudentleave);
$attendancepercantage=  round($addprsentandleaveattendance);
   
   
           
           
           
          echo "<tr>
<td class='same_fetch_style'>$row</td> 
<td class='same_fetch_style'>$fetchstudentid</td> 
<td class='same_fetch_style'>$fetch_employee_name</td> 
<td class='same_fetch_style'>$fetch_employee_father_name</td> 
<td class='same_fetch_style'>$fetch_employee_number</td> 
<td class='same_fetch_style' style='text-align:center;'><input type='text' readonly='readonly' style='width:40px; ' value='$attendancepercantage'></td> 
<td class='same_fetch_style'>12,230.00</td> 
<td class='same_fetch_style'  style='text-align:center;'><input type='checkbox' value='paid' checked></td> 

</tr>";
          $final_pad_amount +=12230;
       }
       $converted_number=  number_format($final_pad_amount,2);
       echo "
           <tr><td colspan='5' id='bottom_td_style'></td>
<td colspan='' id='td_total' style=' text-align:right; '>Total Amount :</td> 
<td colspan=''id='td_total' >$converted_number</td>
<td id='td_total' ></td>
</tr>";
       ?>
                                             <tr>
                                    <td style=" border-left:1px solid silver;height:40px;  "> </td>
                                    <td >
                                         <input type="Reset" value="Reset" class="add_button_reset_button">
                                        <input type="submit" value="Pay Salary" name="addfeedetails" 
                                           id="addfeesname"    class="add_button_reset_button">
                                       
                                    </td>
                                </tr>
                                        </table>
      <?php 
     }
     }
        ?>
                                  
    </body>
</html>
