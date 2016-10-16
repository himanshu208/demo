<?php 
require_once '../connection.php';
if(isset($_POST['change_session_id']))
{
 if(!empty($_POST['change_session_id']))
 {
 $session_current_id=$_POST['change_session_id'];  
 $_SESSION['working_session_year']=$session_current_id;
 }
}

      $session__new_activate_db=mysql_query("SELECT * FROM session_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id' and by_defult='active'"); 
      $fecth_session_active_data=  mysql_fetch_array($session__new_activate_db);
      $fecth_session_num_rows=  mysql_num_rows($session__new_activate_db);
      if((!empty($fecth_session_active_data))&&($fecth_session_active_data!=null)&&($fecth_session_num_rows!=0))
      {
       $fecth_session_id_set_tmep=$fecth_session_active_data['session_id']; 
       $session_name=$fecth_session_active_data['session_name']; 
       
      }else
      {
       echo "<style>#session_not_active{ display:block; }</style>"; 
      }

if(isset($_SESSION['working_session_year']))
{
 $fecth_session_id_set=$_SESSION['working_session_year'];  
}else
{
  $fecth_session_id_set=$fecth_session_id_set_tmep; 
}

$user_account_db=mysql_query("SELECT * FROM login_user_db WHERE organization_id='$fetch_school_id' and branch_id='$fetch_branch_id'
    and user_admin_id='$user_unique_id'");
$fetch_user_account_data=  mysql_fetch_array($user_account_db);
$fetch_use_num_rows=  mysql_num_rows($user_account_db);
if((!empty($fetch_user_account_data))&&($fetch_user_account_data!=null)&&($fetch_use_num_rows!=0))
{
  $fetch_user_name=$fetch_user_account_data['full_name'];
}else
{
   $fetch_user_name=""; 
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Account</title>
        <script type="text/javascript" src="jquery/jquery-1.js">
        </script>
        <script type="text/javascript">
             function isNumber(evt) {
        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }    
    </script>
       <style>
            body{ color:black; }
            #first_top_fin_header_div{ width:100%; height:60px; background-color:white;  }
            #middle_fin_div_tag{ width:1150px; height:59px; margin:0 auto;
                                 border-bottom:1px solid silver;    }
            #financefirstdiv{ width:100%;height:100%;  margin:0; padding: 0;   
                              font-family:arial;  }
            #fullviewtable{ width:100%; height:100%;  margin:0; padding: 0;   }
            #finanacemanutable{ width:auto; margin-left:10px;  z-index:102;float:right; padding-right:10px;       }
            #finanacemanutable td{ padding-left:4px; padding-right:4px;  }
            .top_button{ width:100%; height:19px; padding-top:5px;   font-size:12px;  
                       text-align:center; z-index:103; font-weight:100; cursor:pointer; 
                       padding-left:3px; padding-right: 3px; border:1px solid white; border-bottom:0px;   
                        }
                        .top_buttons{ width:100%; height:19px; padding-top:5px;   font-size:12px;  
                       text-align:center; z-index:103; font-weight:100; 
                       padding-left:3px; padding-right: 3px; border:1px solid white; border-bottom:0px;   
                        cursor:pointer; }
            .top_button:hover{ background-color:white;  box-shadow:0px 0px 5px 0px silver;
            border:1px solid whitesmoke; border-bottom:0px; }
            .td_index{ margin:0; padding:0; border-spacing: 0;  }
            .td_verticleline{   margin:0; padding:0; border-spacing: 0;z-index:100; 
                                }
            .vertical_line{ width:auto;height:22px; padding-top:8px;  
             color:dodgerblue;  }
            .line{ width:1px;  height:11px; 
            background-color: dodgerblue; margin-top:1px;  margin-left:3px;    }
            .top_button:hover{  cursor:pointer;  transition-duration:0.3s;     }
            #linkpage{ width:840px; height:400px; background-color:white;  border-top:1px solid whitesmoke;    }
            #sessionyear{ width:auto; height:auto;   font-weight:700;
                          font-size:11px;  right:3px; top:1px;  z-index:101;  }
            #selectsessionyear{ border:1px solid whitesmoke; font-size:11px;  }
            #showworkingday{ width:auto;  height:20px;  color:white;  left:2px; top:20px; font-weight:700;    }
      .school_logo_insert{ width:auto; height:50px; float:left;   }
      #second_middle_work_div{ width:100%; height:30px; float:left;    }
      #menu_top_list{ width:100%; height:auto; float:left;   }
      #third_middle_work_div{ width:100%; height:auto; float:left;   }
      .log_out_button{ width:70px; height:20px; background-color:deeppink;font-weight:100;
                      padding-top:5px;  color:white; border-radius: 2px; text-align:center;
      }
      #top_logout_tables{ width:auto; height:auto; font-weight:100; color:black;   float:right; padding-top:2px;    }
      #top_logout_tables td{
          padding-left: 4px; padding-right: 4px;
      }
      #session_unique_id{ width:120px; height:25px; margin-top:1px;  }
      .add_view_fee{ position:absolute; font-weight:100; color:black; background-color:white;
                     width:160px;box-shadow:0px 4px 5px 0px silver; border:1px solid whitesmoke; border-top:0px;  
      display:none; }
      .bottom_arrow{ width:9px; height:9px;  float:right; position:relative; top:2px;  background-image:url('../images/bottom_arrow.jpg'); background-repeat:no-repeat;    }
.all_div_same_bgcolor{ margin-top:2px;     padding:5px; }
.all_div_same_bgcolor:hover{ background-color: whitesmoke;}
.add_view_fee a{ color:black; }
#show_div_1:hover #add_view{ background-color:white;  box-shadow:0px 0px 5px 0px silver;
            border:1px solid whitesmoke; border-bottom:0px;} 
.add_view_fee:hover .top_button{ background-color:white;  box-shadow:0px 0px 5px 0px silver;
            border:1px solid whitesmoke; border-bottom:0px; }

        </style>
    </head>
    <body style=" margin:0; padding: 0; ">
        <script type="text/javascript">
    function show_short_div(number)
    {
        document.getElementById("show_div_"+number+"").style.display="block";
        document.getElementById("add_view_"+number+"").style.boxShadow="0px 0px 5px 0px silver";
        document.getElementById("add_view_"+number+"").style.border="1px solid whitesmoke";
        document.getElementById("add_view_"+number+"").style.borderBottom="0px";
        
    }
    function hide_short_div(number)
    {
        document.getElementById("show_div_"+number+"").style.display="none";
          document.getElementById("add_view_"+number+"").style.boxShadow="0px 0px 0px 0px white";
        document.getElementById("add_view_"+number+"").style.border="1px solid white";
        document.getElementById("add_view_"+number+"").style.borderBottom="opx";
        
    }
    </script>
        
         <form name="myForm" action="" method="post" enctype="multipart/form-data">
    
        <div id="first_top_fin_header_div"> 
                           <div id="middle_fin_div_tag">
                               <table cellspacing="0" cellpadding="0" id="menu_top_list">
                                   <tr>
                                       <td>
                                 <div class="school_logo_insert">
                                   <img style=" height:48px; max-width:55px;" src="<?php  echo $fetch_school_logo;?>">   
                               </div>  
                                       </td>
                                       <td>
                                         <div id="second_middle_work_div">
                                            
                                      
              <input type="hidden" id="school_id" value="<?php  echo $fetch_school_id;?>">  
             <input type="hidden" id="branch_id" value="<?php  echo $fetch_branch_id;?>">
             <input type="hidden" id="admin_id" value="<?php  echo $user_unique_id;?>">
                                    
                                        
                                             
                                             
                                             <table cellspacing="0" cellpadding="0" id="top_logout_tables">
                                                 <tr>
                                                     <td style=" font-weight:bold;  color:red; ">Current Academic Session Year :<?php  echo $session_name;?> </td>
                                                     <td></td>
                                                     <td></td>
                                                     
                                                     <td><?php  include_once 'header_live_time.php'; ?></td>
                                                     <td></td>
                                                     <td></td>
                                                     
                                                     <td style=" font-size: 11px; color:red; ">
                                                     <a style=" color: crimson; "><b><?php  echo strtoupper($fetch_user_name);?></b></a>
                                                     </td>
                                                     
                                                     <td></td>
                                                     <td></td>
                                                     <td></td>
                                                     
                                                     <td><span><b>Working Academic Session Year</b></span></td>
                                                     <td><strong>:</strong></td>
                                                     <td>
                                                       
                                       <select onchange="javascript:submit()" id="session_unique_id"
                                                   name="change_session_id" >
                                               
                         <?php 
                           $session_db=  mysql_query("SELECT * FROM  session_db WHERE organization_id='$fetch_school_id'
                                   and branch_id='$fetch_branch_id'");
                           while ($fetch_session_data=mysql_fetch_array($session_db))
                           {
                           $fetch_session_id=$fetch_session_data['session_id'];
                           $fetch_session_name=$fetch_session_data['session_name'];
                           if(!empty($fecth_session_id_set))
                           {
                           if($fetch_session_id==$fecth_session_id_set)
                           {
                            echo "<option value='$fetch_session_id' selected>$fetch_session_name</option>";
                           
                           }else
                           {
                           echo "<option value='$fetch_session_id'>$fetch_session_name</option>";
                             
                           }
                           
                           }else
                           {
                           
                            $fetch_session_defult_set=$fetch_session_data['by_defult'];
                           if($fetch_session_defult_set=="active")
                           {
                                echo "<option value='$fetch_session_id' selected>$fetch_session_name</option>";
                            $fecth_session_id_set=$fetch_session_id;
                           }else
                           {
                               echo "<option value='$fetch_session_id'>$fetch_session_name</option>"; 
                           }
                           }
                           }
                           if(!empty($fetch_session_id))
                           {
                               echo "<style>#session_not_active{ display:block; }</style>"; 
                           }
                           ?>    
                           </select>
                                                      
                                                     </td>
                                                     <td>
                                       <a href="../dashboard.php"  style=" text-decoration:none;  ">
                                        <abbr title="Account Log Out">
                                         <div  class="log_out_button">Log Out</div></abbr>
                                       </a>   
                                                     </td>
                                                 </tr>
                                             </table>  
                                         </div>
                                          <div id="third_middle_work_div">  
                                           
                        <table cellspacing="0" cellpadding="0"  id="finanacemanutable">
                            <tr>
                                <td class="td_index">
                                    <a href="financeindex.php" border="0" style=" text-decoration:none; ">
                                    <div class="top_buttons">Dashboard</div>
                                    </a>
                                </td>
                                <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                 <td>
                                    <div class="top_button" onmouseover="show_short_div('1')" 
                                         onmouseout="hide_short_div('1')" id="add_view_1">  Manage Fee <div class="bottom_arrow"></div></div>
                                    <div class="add_view_fee" onmouseover="show_short_div('1')" 
                                         onmouseout="hide_short_div('1')"  id="show_div_1">
                                        <a href="financeview_fee.php" border="0" style=" text-decoration:none; ">
                                        <div class="all_div_same_bgcolor" >Fee Group</div>  </a>
                                        <a href="financeviewgroup_fee.php" border="0" style=" text-decoration:none; ">
                                        <div class="all_div_same_bgcolor">Fee</div>
                                        </a>
                                        <a href="financeview_feeamount.php" border="0" style=" text-decoration:none; ">
                                         <div class="all_div_same_bgcolor">Assign Fee Amount</div>
                                        </a>
                                       
                                         
                                    </div>
                                </td>
              
                                <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                 <td>
                                    <div class="top_button" onmouseover="show_short_div('2')" 
                                         onmouseout="hide_short_div('2')" id="add_view_2">Manage Account <div class="bottom_arrow"></div></div>
                                    <div class="add_view_fee" onmouseover="show_short_div('2')" 
                                         onmouseout="hide_short_div('2')" id="show_div_2">
                                        <a href="financeaccount_viewall.php?viewaccountheadmaster=12yyt_sajjfhgb_ashhhvvtetefwtFfff_JHJVCfss" border="0" style=" text-decoration:none; ">
                                        <div class="all_div_same_bgcolor">Account Head</div>
                                        </a>
                                        <a href="financeaccount_viewall.php?viewaccountdetails=32yyt_sajjfhgb_ashhhvvtetefwtFfff_JHJVCfss" border="0" style=" text-decoration:none; ">
                                        <div class="all_div_same_bgcolor">Account</div>
                                        </a>
                                    </div>
                                </td>
                                
                                
                               
                                <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                <td>
                                    <div class="top_button" onmouseover="show_short_div('4')" 
                                         onmouseout="hide_short_div('4')" id="add_view_4">Fee Discount (%) <div class="bottom_arrow"></div></div>
                                    <div class="add_view_fee" onmouseover="show_short_div('4')" 
                                         onmouseout="hide_short_div('4')" id="show_div_4">
                                        <a href="financediscount_viewall.php?seecategorydiscount=1qw_RRERR_ORIURYGHHGHG_HO" style=" text-decoration:none;">
                                        <div class="all_div_same_bgcolor">Category</div> 
                                        </a>
                                     <a href="financediscount_viewall.php?seehandicappeddiscount=1hh_qwqwq_ADDSDS663644_SDWHJ" style=" text-decoration:none; ">
                                        <div class="all_div_same_bgcolor">Handicapped</div>
                                     </a>
                                        <a href="financediscount_viewall.php?seeparticularstudentdiscount=2ttr_DDFGGS_SHHGD_33467VS_SDBHSDH" style=" text-decoration:none; ">
                                        <div class="all_div_same_bgcolor">Particular Student</div>
                                        </a>
                                    </div>
                                </td>
                                 <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                               
                               <td class="td_index">
                                   <a href="account_setting.php" border="0" style=" text-decoration:none; ">
                                    <div class="top_buttons">Setting</div>
                                    </a>
                                </td>
                                <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                <td>
                                     <a href="change_password.php" border="0" style=" text-decoration:none; ">
                                     <div class="top_buttons" id="add_view_amounthead">Change Password</div></a>
                                </td>
                                
                                  </tr>
                        </table>
         </div>
                                       </td>
                                   </tr>
                               </table>
                                 
                            
                               
                            
                       </div>
                           
                           
                                    </div></form>

    </body>
</html>
