
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="stylesheet/styleSheet.css" rel="stylesheet" type="text/css" media="all">
         <script type="text/javascript">
            function ok_close()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
             function close_button()
            {
               document.getElementById("win_pop_up").style.display="none"; 
            }
            
   document.onkeydown = function(evt) {
    evt = evt || window.event;
    if (evt.keyCode == 27) 
    {
       document.getElementById("win_pop_up").style.display="none";
    }else
    if (evt.keyCode == 13) 
    {
    document.getElementById("win_pop_up").style.display="none";
    }
};
            
            </script>
    </head>
    
   
    <body>
       <div id="win_pop_up"> 
             <div class="pop_up_div">
             </div>
             <div class="second_pop_up_div">
                 <div class="pop_up_middle_div">
                     <div class="close_div" onclick="close_button()"></div>  
                     
                     <div class="middle_center_work_div" id="win_pop_up_text"><?php  echo $message_show;?></div>
                     
                     
                     
                     <div class="last_bottom_close_div">
                         <div onclick="ok_close()" class="ok_button_style">OK</div>  
                     </div>
                 </div> 
                 
             </div>
             </div>
    </body>
</html>
