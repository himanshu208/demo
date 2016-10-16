
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
        <style>
            #mainfotterdivtag{ width:100%; font-size:12px; font-family:arial;   height:22px;
                               background-color:white;     }
            #middle_fotter_div_tag{ width:1150px; height:auto; border-top:1px solid silver; margin:0 auto; padding-top:1px;   }
        #middle_fotter_div_tag a{ text-decoration:none; color:blue;  }
        </style>
        <script type="text/javascript">     
        function PrintDiv(title_heading) {    
        
           var divToPrint=document.getElementById('table_print_div');
           var popupWin=window.open('', '_blank', 'width=900,height=800');
           popupWin.document.open();
           var style_css="<style> body { font-family:arial; } \n\
   .table_list tr td table tr td,.details_table tr td { border:1px solid black; border-right:0; border-top:0; font-size:8px;}\n\
 .hidden_td,#hidden_td { display:none; } .details_table{ border-top:1px solid black;}   table { width:100%; margin-top:10px; }\n\
 table tr td { padding:2px; padding-top:4px; padding-bottom:4px; }\n\
 #table_th_style td{ border-top:1px solid black;font-weight:bold; background-color:whitesmoke;} \n\
.first_table_button_div table tr td { border:0;  } .first_table_button_div table { border:1px solid black; } \n\
.tr_heading_style table tr td { border:0; } .zero_tr_td td { border:0; border-bottom:1px solid black;} \n\
#td_hidden{ display:none; } #td_border { border-right:1px solid black;}\n\
 .show_student_table tr td{ border:0; } .calander_table { width:28%;} .show_student_table { width:90%;}\n\
.view_delete_buttons{ display:none;}</style> ";
           
           popupWin.document.write('<html> <link href="../stylesheet/print_css.css" rel="stylesheet" type="text/css" media="all"> <link href="../stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all"> '+style_css+' <body onload="window.print()"><div id="print_div_tag"><div><img src="../<?php echo $fetch_branch_report_logo;?>"</div><div class="print_title_heading">'+title_heading+'</div>' + divToPrint.innerHTML + '</div> </body></html>');
            popupWin.document.close();
                }
     </script>
    </head>
    <body style=" margin:0; padding:0;">
        <div id="mainfotterdivtag">
            <div id="middle_fotter_div_tag">
        <table style=" width:100%; ">
            <tr>
                <td>Copyright&COPY;2013 all right reserved</td>
                <td style=" text-align:right; ">Design & develop by - <a target="_blank" href="http://www.pixabye.in"> Pixabyte Technologies Pvt. Ltd.</a></td>
            </tr>    
        </table>
            </div>
        </div>
    </body>
</html>
