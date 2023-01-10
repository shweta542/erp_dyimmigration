
<?php $arr = explode('|',$privileges_settings->designation) ;

$department=$this->db->where('department_id',$alluserData->department_id)->get('tbl_department')->row();
 $designation=$this->db->where('designation_id',$alluserData->designation_id)->get('tbl_designation')->row();
$bonus=$this->db->select('SUM(bonucs) as bonucstotal')->where('payroll_id',$alluserData->payroll_id)->get('tbl_payroll_meta')->row();
$deduction=$this->db->select('SUM(deduction) as deductiontotal')->where('payroll_id',$alluserData->payroll_id)->get('tbl_payroll_meta')->row();
//echo $md=$alluserData->month;
$leaveData=$this->db->
where('MONTH(maindate)',$alluserData->month)->
where('USER_ID',$alluserData->USER_ID)->
where('del_status',0)->
get('tbl_leave')->result();
 $month = $alluserData->month;
 $year = $alluserData->year;
 $maxDays=cal_days_in_month(CAL_GREGORIAN,$alluserData->month,$alluserData->year);
?>

  <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Payslip</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Payslip</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <div class="btn-group btn-group-sm">

                        <button class="btn btn-white">PDF</button>
                        <button class="btn btn-white"><i class="fa fa-print fa-lg"></i> Print</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="salary-sec">
                            <table width="100%" height="" cellspacing="10" cellpadding="0" border="0">
                                <tbody>
                                    <!--<tr>
                                        <td colspan="2" align="center">
                                            <div style="height: 50px;">&nbsp;</div>
                                        </td>
                                    </tr>-->
                                    <tr>
                                        <td colspan="2" align="center">
                                            <div style="font-size: 22px; color: #000000; line-height: 20px; padding-top: 30px; padding-bottom: 0; text-decoration: underline; text-transform: uppercase; margin: 0;">Payslip for the month of <?= date("M", strtotime($alluserData->month)); ?>, <?= date("Y", strtotime($alluserData->year)); ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <div style="height: 30px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <div style="display: block; padding-bottom: 20px; text-align: left;">
                                                <img style="width: 80px;" src="assets/img/logo2.png" />
                                            </div>
                                            <div style="margin: 0;font-weight: 500; padding: 0; text-align: left; text-transform: uppercase; font-size: 20px;">
                                                <b>Vishvas Group</b><br />
                                                <small style="font-weight: 300; font-size: 12px; text-transform: inherit;">Jagadhari Road, Ambala Cantt, Haryana India</small>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <div style="height: 30px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            
                                            <div style="margin:0; padding: 0; text-align: left;">
                                                <small style="font-size: 15px; text-transform: inherit;">Name: <b><?= $alluserData->USER_NAME ?> <?= $alluserData->user_last_name ?></b></small><br/>
                                                <small style="font-size: 15px; text-transform: inherit;">Employee ID: <b><?= $alluserData->employee_id ?></b></small><br/>
                                                <small style="font-size: 15px; text-transform: inherit;">Designation: <b><?= $designation->designation_name ?></b></small><br/>
                                                <small style="font-size: 15px; text-transform: inherit;">Department: <b><?= $department->department_name ?></b></small><br/>
                                                <small style="font-size: 15px; text-transform: inherit;">Branch: <b>Ambala</b></small><br/>
                                                <small style="font-size: 15px; text-transform: inherit;">Email: <b><?= $alluserData->USER_EMAIL ?></b></small>
                                            </div>
                                        </td>
                                        <td align="right">
                                            <div style="margin: 0; padding: 0; text-align: right; text-transform: uppercase;">
                                               <small style="font-size: 15px; text-transform: inherit;">Payslip: <b><?= $alluserData->payroll_id ?></b></small><br/>
                                               <small style="font-size: 15px; text-transform: inherit;">Salary Month: <b><?= date("M", strtotime($alluserData->month)); ?></b></small><br/>
                                               <small style="font-size: 15px; text-transform: inherit;">Salary Generated: <b><?= get_datetime($alluserData->lastmodify_payroll) ?></b></small>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <div style="height: 30px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table cellpadding="7" cellspacing="0" width="100%" style="border: 1px solid #c4c4c4;" bgcolor="#FFF">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2" align="center" style="word-break: break-word; text-align: center; font-size: 16px;"><b>Earnings</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60%" align="left" style="border-top: 1px solid #c4c4c4; font-size: 16px;">Basic Salary</td>
                                                        <td width="40%" align="right" style="border-top: 1px solid #c4c4c4; border-left: 1px solid #c4c4c4; font-size: 14px;"><b>Rs.<?= $alluserData->salary ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60%" align="left" style="border-top: 1px solid #c4c4c4; font-size: 16px;">Bonus</td>
                                                        <td width="40%" align="right" style="border-top: 1px solid #c4c4c4; border-left: 1px solid #c4c4c4; font-size: 14px;"><b>Rs.<?= $bonus->bonucstotal ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60%" align="left" style="border-top: 1px solid #c4c4c4; font-size: 16px;">Total Earnings</td>
                                                        <td width="40%" align="right" style="border-top: 1px solid #c4c4c4; border-left: 1px solid #c4c4c4; font-size: 14px;"><b>Rs.<?= $alluserData->salary - $bonus->bonucstotal ?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>
                                            <table cellpadding="7" cellspacing="0" width="100%" style="border: 1px solid #c4c4c4;" bgcolor="#FFF">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2" align="center" style="word-break: break-word; text-align: center; font-size: 16px;"><b>Deductions</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60%" align="left" style="border-top: 1px solid #c4c4c4; font-size: 16px;">Salary Deduction</td>
                                                        <td width="40%" align="right" style="border-top: 1px solid #c4c4c4; border-left: 1px solid #c4c4c4; font-size: 14px;"><b>Rs. <?= $deduction->deductiontotal ?></b></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60%" align="left" style="border-top: 1px solid #c4c4c4; font-size: 16px;">&nbsp;</td>
                                                        <td width="40%" align="right" style="border-top: 1px solid #c4c4c4; border-left: 1px solid #c4c4c4; font-size: 14px;"><b>&nbsp;</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td width="60%" align="left" style="border-top: 1px solid #c4c4c4; font-size: 16px;">Total Deductions</td>
                                                        <td width="40%" align="right" style="border-top: 1px solid #c4c4c4; border-left: 1px solid #c4c4c4; font-size: 14px;"><b>Rs. <?= $deduction->deductiontotal ?></b></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <table cellpadding="10" cellspacing="0" width="100%" style="border: 1px solid #c4c4c4;" bgcolor="#FFF">
                                                <tbody>
                                                    <tr>
                                                        <td width="100%" align="left" style="border-top: 0 solid #c4c4c4;">
                                                            <b style="font-size: 15px;">Total Salary:</b>&nbsp;<b style="font-size: 16px;">Rs. <?= $alluserData->salary - $bonus->bonucstotal - $deduction->deductiontotal ?> </b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <div style="height: 20px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <table cellpadding="10" cellspacing="0" width="100%" bgcolor="#FFF">
                                                <tbody>
                                                    <tr>
                                                        <td width="100%" align="left" style="border-top: 0 solid #c4c4c4;">
                                                            <b style="font-size: 18px;"> Employee Leave Info</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <table cellpadding="7" cellspacing="0" width="100%" style="border: 1px solid #c4c4c4;" bgcolor="#FFF">
                                            <tbody>
                                                <tr>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Leave Type</b></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Leave From</b></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Leave to</b></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Reason</b></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Number of days</b></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Status</b></td>
                                                </tr>
                                                <?php 
                                                 $i = 0;
                                                foreach ($leaveData as $key ) {
                                                    $i  = + $key->leave_day;
                                                  ?>

                                                <tr>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 14px;"><?php if($key->leave_type == '1'){echo 'Full Day';}else if($key->leave_type == '2'){
                                                        echo 'Half Day';
                                                    }else{
                                                        echo 'Short Leave';
                                                    } ?></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 14px;"><?= date("d-M-Y", strtotime($key->leave_form)); ?></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 14px;"><?= date("d-M-Y", strtotime($key->leave_to)); ?></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 14px;"><?= $key->leave_reason ?> </td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 14px;"> <?= $key->leave_day ?></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4;text-align: center; font-size: 14px;"> <?php if($key->status == '1'){echo 'Pending';}else if($key->status == '2'){
                                                        echo 'Approve';
                                                    }else if($key->status == '3'){
                                                        echo 'Decline';
                                                    }else{
                                                        echo 'Cancel';
                                                    } ?> </td>
                                                </tr>
                                                  <?php
                                                } ?>
                                                <tr>
                                                    <td  colspan="5" align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: Left; font-size: 16px;"><b>Total Leaves</b></td>
                                        
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4;text-align: center; font-size: 16px;"><b><?= $i ?> </b></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <div style="height: 20px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <table cellpadding="10" cellspacing="0" width="100%" bgcolor="#FFF">
                                                <tbody>
                                                    <tr>
                                                        <td width="100%" align="left" style="border-top: 0 solid #c4c4c4;">
                                                            <b style="font-size: 18px;"> Employee Attendence Info</b>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <table cellpadding="7" cellspacing="0" width="100%" style="border: 1px solid #c4c4c4;" bgcolor="#FFF">
                                            <tbody>
                                                <tr>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Date</b></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Punch Time</b></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 16px;"><b>Total Hours</b></td>
                                                </tr>
                                                <?php
                                                for ($i=1; $i <= $maxDays ; $i++) { 
                                    $time=mktime(12, 0, 0, $month, $i, $year);          
                                    if (date('m', $time)==$month) 
                                    $attData=$this->db->select('punchIn,punchOut')->where('user_id',$logged_in_user->USER_ID)->
                                where('punchIn >=', date('Y-m-d 00:00:00', $time))->
                                where('punchIn <=', date('Y-m-d 12:00:00', $time))->
                                get('tbl_attendance')->result();
                                $puncharr=[];
                                foreach ($attData as $key ) {
                                     $times = date("g:i a", strtotime($key->punchIn));
                                   array_push($puncharr,$times);
                                }
                                $mainpunchin=implode('|', $puncharr);
                                $mtime=$this->db->select("SEC_TO_TIME(SUM(TIME_TO_SEC(timeDiff))) as time")->
        where('user_id',$logged_in_user->USER_ID)->
       where('punchIn >=', date('Y-m-d 00:00:00', $time))->
                                where('punchIn <=', date('Y-m-d 12:00:00', $time))->
        get('tbl_attendance')->row();
        $times = explode('.',$mtime->time);
                                        ?>
                                                <tr bgcolor="#F4F4F4">
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 14px;"><?= date('d M Y', $time) ?></td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 14px;">
                                                        <?php if(date('l', strtotime(date('d M Y', $time))) == 'Sunday'){
                                                            echo 'Sunday';
                                                        }else if(in_array(date('d M Y', $time), $holiday,true)){
                                                             echo 'Holiday';
                                                        }else{
                                                            echo $mainpunchin;
                                                        }  ?>
                                          </td>
                                                    <td  align="center" style="border-top: 1px solid #c4c4c4; border-right: 1px solid #c4c4c4; text-align: center; font-size: 14px;">  <?= ($times[0])?$times[0]:'00:00'?> hrs </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </tr>
                                    
                                </tbody>
                            </table>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        
        
    </div>
</div>

