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
        <title>Finance</title>
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
                                 border-bottom:1px solid dodgerblue;    }
            #financefirstdiv{ width:100%;height:100%;  margin:0; padding: 0;
                              font-family:arial;  }
            #fullviewtable{ width:100%; height:100%;  margin:0; padding: 0;   }
            #finanacemanutable{ width:auto;   margin-top:3px;
                                z-index:102; float:right; padding-right:0px;       }
            #finanacemanutable td{ padding-left:2px;   }
            .top_button{ width:auto; height:19px; padding-top:5px;   font-size:12px;
                       text-align:center; z-index:103; font-weight:100;
                       padding-left:4px;   padding-right: 3px;  border-radius:1px;
                        }
            .td_index{ margin:0; padding:0; border-spacing: 0;  }
            .td_verticleline{   margin:0; padding:0; border-spacing: 0;z-index:100;
                                }
            .vertical_line{ width:auto;height:22px; padding-top:8px;
             color:dodgerblue;  }
            .line{ width:1px;  height:11px;
            background-color: dodgerblue; margin-top:1px;    }
            .top_button:hover{  cursor:pointer; color:black; transition-duration:0.7s;
                            opacity:0.8;     background-color: deepskyblue;
            }
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
        </style>
    </head>
    <body style=" margin:0; padding: 0; ">
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






                                             <table cellspacing="0" cellpadding="0" id="top_logout_tables">
                                                 <tr>
                                                     <td style=" font-weight:bold;  color:red; ">Current Academic Session Year :<?php  echo $session_name;?> </td>
                                                     <td></td>
                                                     <td></td>

                                                     <td><?php  include_once 'header_live_time.php'; ?></td>
                                                     <td></td>
                                                     <td></td>

                                                     <td style=" color:red; font-size:11px;  ">
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
                                    <div class="top_button" id="color_1">Dashboard</div>
                                    </a>
                                </td>
                                 <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>



                                <td>
                                     <a href="financepay_studentfee.php" border="0" style=" text-decoration:none; ">
                                         <div class="top_button" id="color_4"><b>Fee Pay</b></div>
                                     </a>
                                </td>
                                <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                 <td>
                                     <a href="financepayment_detail.php" border="0" style=" text-decoration:none; ">
                                    <div class="top_button" id="color_5">Fee Payment Details</div></a>
                                </td>
                                <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                 <td>
                                     <a href="financepayment_reconcile.php" border="0" style=" text-decoration:none; ">

                                    <div class="top_button" id="color_6">Fee Payment Reconcile</div>
                                     </a>
                                </td>
                                 <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                 <td>
                                     <a href="fee_due_list.php" border="0" style=" text-decoration:none; ">
                                         <div class="top_button" id="color_44"><b>Fee Due List</b></div>
                                     </a>
                                </td>
                                
                                <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                <td>
                                     <a href="financeaccount_paymentdetails.php" border="0" style=" text-decoration:none; ">

                                    <div class="top_button" id="color_7">Accounts Payment</div>
                                     </a>
                                </td>
                                <td class="td_verticleline" style=" display:none; "><div class="vertical_line"><div class="line"></div></div></td>
                                <td style=" display:none; ">
                                  <a href="financecash_master.php" border="0" style=" text-decoration:none; ">

                                    <div class="top_button" id="color_8">Cash Master</div>
                                  </a>
                                </td>
                                <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                 <td>
                                    <a href="financeview_fee.php" border="0" style=" text-decoration:none; ">
                                    <div class="top_button" id="color_9"> Master Setting</div>
                                     </a>
                                </td>
                                 <td class="td_verticleline"><div class="vertical_line"><div class="line"></div></div></td>
                                 <td>
                                     <a href="change_password.php" border="0" style=" text-decoration:none; ">
                                    <div class="top_button" id="color_10">Change Password</div>
                                     </a>
                                </td>
                                  </tr>
                        </table>
                                           </div>
                                       </td>
                                   </tr>
                               </table>




                       </div>


                                    </div>
        </form>

    </body>
</html>
