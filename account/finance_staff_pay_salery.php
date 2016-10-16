<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Finance</title>
         <script type="text/javascript" src="jquery/jquery-1.js">
        </script>
       
        <style>
             #financefirstdiv{ width:100%;height:100%;  margin:0; padding:0;  
                              font-family:arial; font-weight:800;  font-size:12px; float:left;      }
            #fullviewtable{ width:100%; height:100%;  margin:0; padding: 0; float:left; }
            #linkviewdiv{ width:840px; height:200px; background-color:white;   }
            .spacing{ margin: 0;padding:0; border-spacing: 0px }
            .top_button{ width:100%; height:22px; padding-top:8px;  background-color:skyblue; font-size:12px; 
                         color:white; text-align:center; 
                        background-image:url('finanacephoto/bgblack.png');    }
            .td_index{ margin:0; padding:0; border-spacing: 0;  }
            .td_verticleline{   margin:0; padding:0; border-spacing: 0;
                                }
            .vertical_line{ width:auto;height:22px; padding-top:8px;  
             background-image:url('finanacephoto/bgblack.png');  }
            .line{ width:1px;  height:16px; 
             background-image:url('finanacephoto/whiteline.png'); }
            .top_button:hover{ background-image:url('finanacephoto/hoverbg.png'); cursor:pointer; font-weight:bold; color:whitesmoke;    }
            #linkpage{ width:840px; height:400px; background-color:white;  border-top:1px solid whitesmoke;    }
            #mainpagesourse{ width:848px; height:100px; margin:0 auto;    }
            #attechfotter{ width:100%; height:22px; position:fixed; bottom:0px;    }
          #table_midle_set{ width:845px; height:auto; margin:0 auto;  margin-top:10px;border-right:1px solid silver; 
          border-bottom:1px solid silver; }
          #top_add_view_div{ width:auto; float:right;  }
          #find_normal_type{ width:800px; margin:0 auto; margin-bottom:5px; margin-top:2px;font-weight:100; height:55px; 
                             background-color:whitesmoke; opacity:0.9; margin-top:15px;  border:1px solid white;   }
       .emp_class{ width:auto; height:23px; background-color:white; text-align:center; border-top:1px solid silver;   border-left:1px solid silver; 
       border-bottom: 1px solid silver;}
       .same_fetch_style{ width:auto; border-left:1px solid silver; padding-left:3px; font-weight:100;   border-bottom:1px solid silver;    }
        #bottom_td_style{height:23px; background-color:white; border-bottom:1px solid silver;  border-left:1px solid silver;    }
       #td_total{ background-color: white; border-bottom:1px solid silver; padding-left:5px;   }
        .add_button_reset_button{ width:auto; padding-left:10px; padding-right:10px;   height:23px; 
                                  margin-left:12px; font-size:12px; float:right; margin-right:5px;  
                             border:1px solid gray;color:whitesmoke; font-weight:bold;  
                             background-image:url('finanacephoto/bgblack.png');}
        #employee_iframe_this{ width:100%;  height:400px;  }
        </style>
    </head>
    <body style=" margin:0; padding: 0;  ">
        <div id="financefirstdiv">
            <table cellspacing="0" cellpadding="0"  id="fullviewtable">
                <tr>
                    <td style="background-image:url('finanacephoto/bgblack.png'); ">
                    <?php 
                      include_once 'headerfinancepage.php';
                      ?>
                    </td>
                </tr>
                <tr>
                    <td>
                       <table  cellspacing="0" cellpadding="0" id="table_midle_set">
                                
                                <tr>
                                    <td colspan="6" class="td_leftpaddingth" style=" color:white; font-weight:bold;  
                                        height:25px; padding-left:10px;  background-image:url('finanacephoto/bgblack.png'); ">
                                    Employee Salary Payment  
                                    
                                    <a href="financeview_fee.php" border="0" style=" text-decoration:none; ">
                                        <abbr title="View Fee Detail">
                                    <div id="top_add_view_div">
                                        <strong> View Fee Details </strong>
                                    </div>
                                        </abbr>
                                    </a>
                                    </td>
                                </tr>
                               <tr><td  style=" border-left:1px solid silver; width:100px;
                                        padding-left:30px; padding-top:30px;  ">Payment Date</td>
                                                 <td colspan="6" style=" padding-top:30px;">
                                      <?php 
 date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$date1=date("d-M-Y");
{
?>
  
                                     <strong>:</strong>   <input type='text' name='paymentdate' readonly='readonly'
                                               class='text_box_size_same' style="border:1px solid silver; margin-left:5px;  padding-left:5px; " value='<?php  echo $date1;?>'>
<?php 
}
  ?>                                  
                                    </td></tr>
                                <tr>
                                    <td colspan="11" style=" border-left:1px solid silver;padding-bottom:20px;  ">
                                        <div id="find_normal_type">
                                            <table style=" margin-top:5px; ">
                                                
                                                <tr>
                                                    <td colspan=20"><strong style=" font-weight:bold; ">Month</strong></td>
                                                </tr>
                                                <tr>
                                                     <td style='width:20px;'></td>
                                                  <?php 
                                                    $monthNamesshort= Array("","Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec");
                                                    for($month_loop=1;$month_loop<=12;$month_loop++)
                                                    {
date_default_timezone_set('Asia/Calcutta');
$timezone=5.5;
$localtime=$timezone*3600;
$year=date("Y");
                                                    {
                                                        ?>
<script type="text/javascript">
       $(document).ready(function(){
           var number="<?php  echo $month_loop;?>";
           var year="<?php  echo $year;?>"
           var combined=number+"/"+year;
         $("#this_month_value"+number+"").click(function(){
         var this_month_fees=$(this).val();
         if($("#this_month_value"+number+"").attr("checked"))
             {
$("#employee_iframe_this").html('<iframe src="finance_staff_iframe_pay_salary.php?month_year='+combined+'&&particularmonth='+this_month_fees+'" width="100%" frameborder="0" style="margin:0px; padding:0px;" overflow="hidden" height="100%" ></iframe>');
      
             }
         });  
       });
        </script>
                                                   <?php 
                                                    }
                echo "
      <td style='width:20px; float:left;'>
     <input type='checkbox' id='this_month_value$month_loop' style='padding-left:10px;' value='$month_loop'></td>
     <td style='width:32px; padding-left:8px;'>$monthNamesshort[$month_loop]</td>";   
                                                    }
                                                    ?>
                                                </tr>
                                            </table>    
                                        </div>
                                    </td>
                                </tr>
                               
                                <tr>
                                    <td colspan="12" >
                                        <div id="employee_iframe_this">
                                            
                                        </div>
                                        
                                        
                    </td>
                                </tr> 
                            
                            </table>    
                        </div>  
                    </td>
                </tr>
                
               
            </table>  
        </div>
        <div id="attechfotter">
          <?php 
              include 'financefotter.php';
            ?>
        </div>
    </body>
</html>
