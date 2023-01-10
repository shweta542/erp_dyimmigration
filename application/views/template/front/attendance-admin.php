
<?php $arr = explode('|',$privileges_settings->attendence);

if(isset($_GET['month']) && $_GET['month'] !=""){
    $month =$_GET['month'];
}else{
    $month = date('m');
}
if(isset($_GET['year']) && $_GET['year'] !=""){
    $year =$_GET['year'];
}else{
    $year = date('Y');
}

$maxDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
function getDatesFromRange($start, $end, $format = 'Y-m-d') {
 $maxDays=date('t');
      
    // Declare an empty array
    $array = array();
      
    // Variable that store the date interval
    // of period 1 day
    $interval = new DateInterval('P1D');
  
    $realEnd = new DateTime($end);
    $realEnd->add($interval);
  
    $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
  
    // Use loop to store date into array
    foreach($period as $date) {                 
        $array[] = $date->format($format); 
    }
  
    // Return the array elements
    return $array;
}

?>

  <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Attendance</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Attendance</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <ul class="legend-lst">
                    <li><span class="leg-sun"></span> Sunday</li>
                    <li><span class="leg-holi"></span> Holiday</li>
                    <li><span class="leg-leave"></span> On Leave</li>
                </ul>
            </div>
        </div>
    </div>
    
    <form action="attendanceAdmin.html" method="get">
        <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <select class="select" name="name">
                        <option value="">Select Employee</option>
                        <?php foreach ($search as $key) {
                            ?>
                            <option <?php if(isset($_GET['name'])){if($_GET['name'] == $key->USER_ID){echo "selected";}} ?> value="<?= $key->USER_ID ?>"><?= $key->USER_NAME ?></option>
                            <?php
                        } ?>
                    </select>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="month">
                        <option value="">Select Month</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month'] == '01'){echo 'selected';}}else if(date('m')=='01'){echo 'selected';} ?> value="01">Jan</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='02'){echo 'selected';}}else if(date('m')=='02'){echo 'selected';} ?> value="02">Feb</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='03'){echo 'selected';}}else if(date('m')=='03'){echo 'selected';} ?> value="03">Mar</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='04'){echo 'selected';}}else if(date('m')=='04'){echo 'selected';} ?> value="04">Apr</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='05'){echo 'selected';}}else if(date('m')=='05'){echo 'selected';} ?> value="05">May</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='06'){echo 'selected';}}else if(date('m')=='06'){echo 'selected';} ?> value="06">Jun</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='07'){echo 'selected';}}else if(date('m')=='07'){echo 'selected';} ?> value="07">Jul</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='08'){echo 'selected';}}else if(date('m')=='08'){echo 'selected';} ?> value="08">Aug</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='09'){echo 'selected';}}else if(date('m')=='09'){echo 'selected';} ?> value="09">Sep</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='10'){echo 'selected';}}else if(date('m')=='10'){echo 'selected';} ?> value="10">Oct</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='11'){echo 'selected';}}else if(date('m')=='11'){echo 'selected';} ?> value="11">Nov</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='12'){echo 'selected';}}else if(date('m')=='12'){echo 'selected';} ?> value="12">Dec</option>
                    </select>
                    <label class="focus-label">Select Month</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="year">
                        
                        <?php 
   for($i = 2021 ; $i <= date('Y'); $i++){
    ?>
                        <option <?= ($i == date('Y'))?'selected':'' ?> value="<?= $i  ?>"><?= $i; ?></option>
                        
                    <?php } ?>
                    </select>
                    <label class="focus-label">Select Year</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table table-nowrap mb-0">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <?php 

                                for ($i=1; $i <= $maxDays ; $i++) { 
                                    $time=mktime(12, 0, 0, $month, $i, $year);          
                                    if (date('m', $time)==$month)       
        
                                    ?>

                        <th ><?php if(date('l', $time) == "Sunday"){echo '<span class="sunday">'.$i.'</span>'; }else if(in_array(date('d M Y', $time), $holiday,true)){ echo '<span class="holiday">'.$i.'</span>';}else{echo $i;} ?></th>
                                    <?php
                                } ?>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
$q=1;
$w=1;
                            foreach ($data as $key ) {
                                
                                $currentMonthleave= $this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('USER_ID',$key->USER_ID)->where('del_status',0)->get('tbl_leave')->result();

            $leave=array();
        foreach ($currentMonthleave as $key1 ) {
        $arrdate=getDatesFromRange($key1->leave_form,$key1->leave_to);
        foreach ($arrdate as $key2 ) {
        array_push($leave,$key2);
                               }
        }
                                ?>
                            <tr>
                                <td>
                                    <h2 class="table-avatar">
                                        <a class="avatar avatar-xs" href="profile.html/<?= $key->USER_ID ?>"><img alt="" src="<?= ($key->user_image)?$key->user_image:'assets/img/user.jpg' ?>" /></a>
                                        <a href="profile.html/<?= $key->USER_ID ?>"><?= $key->USER_NAME ?> <?= $key->user_last_name ?></a>
                                    </h2>
                                </td>
                                <?php 

                                for ($i=1; $i <= $maxDays ; $i++) { 

                                    $time=mktime(12, 0, 0, $month, $i, $year);          
                                    if (date('m', $time)==$month)       
                                       $attData=$this->db->where('user_id',$key->USER_ID)->
                                where('punchIn >=', date($year.'-'.$month.'-d 00:00:00', $time))->
                                where('punchIn <=', date($year.'-'.$month.'-d 23:59:59', $time))->
                                order_by('attendance_id','ASC')->
                                limit(1)->
                                get('tbl_attendance')->row();
        $activedata=$this->db->where('user_id',$key->USER_ID)->
        where('punchIn >=', date($year.'-'.$month.'-d 00:00:00', $time))->
        where('punchIn <=', date($year.'-'.$month.'-d 23:59:59', $time))->
        order_by('attendance_id','ASC')->
        get('tbl_attendance')->result(); 

        $todaySum =$this->db->select("SEC_TO_TIME(SUM(TIME_TO_SEC(timeDiff))) as time")->
        where('user_id',$key->USER_ID)->
        where('punchIn >=', date($year.'-'.$month.'-d 00:00:00', $time))->
        where('punchIn <=', date($year.'-'.$month.'-d 23:59:59', $time))->
        get('tbl_attendance')->row();
        $timesum = explode('.',$todaySum->time);
                                    ?>

                                <td>
                                    <?php if(date('l', $time) == "Sunday"){ ?>
                                    <a href="javascript:void(0);"><i class="fa fa-check text-sunday"></i></a>
                                    <?php
                                    }else if(!empty($attData)){
                                        ?>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info<?= $i ?><?= $key->USER_ID  ?>"><i class="fa fa-check text-success"></i></a>
                                        <?php
                                    }else if(in_array(date('d M Y', $time), $holiday,true)){
                                        ?>
                                        <a href="javascript:void(0);"><i class="fa fa-check text-holiday"></i></a>
                                        <?php
                                    }else if(in_array(date('Y-m-d', $time), $leave,true)){
                                        echo "<i class='fa fa-close text-leave'></i>";
                                    }else if(date('Y-m-d', $time) > date('Y-m-d')){
                                        ?>
                                         <i class="fa fa-close text-danger"></i>
                                        <?php
                                    }else{
                                        ?>
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#attendance_info<?= $i ?><?= $key->USER_ID  ?>"><i class="fa fa-close text-danger"></i></a>
                                         
                                        <?php
                                    }
                                    ?>
                            
                                </td>
                                <?php if (in_array('3', $arr,true)) {
                               ?>
                            <div class="modal custom-modal fade" id="attendance_info<?= $i ?><?= $key->USER_ID  ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Attendance Info <?= $key->USER_NAME ?> <?= $key->user_last_name ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card punch-status">
                                <div class="card-body">
                                    <h5 class="card-title">Timesheet <small class="text-muted"><?= date('d M Y', $time) ?></small></h5>
                                    <div class="punch-det">
                                        <h6>Punch In at</h6>
                                        <p><?= (!empty($attData))?get_datetime($attData->punchIn):date('d M Y', $time);?></p>
                                    </div>
                                    <div class="punch-info">
                                        <div class="punch-hours">
                                            <span><?= ($timesum[0])?$timesum[0]:'00:00'?> hrs</span>
                                        </div>
                                    </div>
                                    <div class="punch-det">
                                        <h6>Punch Out at</h6>
                                        <p><?php if(!empty($activedata)){
                                            if(end($activedata)->punchOut != '0000-00-00 00:00:00'){

                                            echo get_datetime(end($activedata)->punchOut);
                                        }else{ echo 'No punch-out';}
                                    }else{
                                        echo 'No punch-out'; 
                                    } ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card recent-activity">
                                <div class="card-body">
                                    <h5 class="card-title">Activity</h5>
                                    <ul class="res-activity-list">
                                        <?php foreach ($activedata as $keyactive) {
                                           if($keyactive->punchIn){
                                            ?>

                                                <li>
                                                    <p class="mb-0">Punch In at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        <?= get_time($keyactive->punchIn) ?>
                                                    </p>
                                                </li>

                                            <?php
                                           }
                                           if($keyactive->punchOut != '0000-00-00 00:00:00'){
                                            ?>

                                                <li>
                                                    <p class="mb-0">Punch Out at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        <?= get_time($keyactive->punchOut) ?>
                                                       
                                                    </p>
                                                </li>

                                            <?php
                                           }
                                           ?>

                                           <?php
                                        } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form class="updateAtt">
                        <input type="hidden" value="<?= date('Y-m-d', $time) ?>" name="date"/>
                        <input type="hidden" value="<?= $key->USER_ID ?>" name="user_id"/>
                     <div class="row filter-row">
                        <div class="col-sm-4">
                            <div class="form-group time-bar form-focus">
                                <div class="cal-icon">
                                    <input class="form-control floating timepicker datetimepicker" value="" name="punchIn"/>
                                </div>
                                <label class="focus-label">Punch In</label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group time-bar form-focus">
                                <div class="cal-icon">
                                    <input class="form-control floating timepicker datetimepicker" value="" name="punchOut"/>
                                </div>
                                <label class="focus-label">Punch Out</label>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success btn-block"> Add Attendance </button>
                        </div>
                    </div>
                    </form>
               
                </div>
            </div>
        </div>
    </div>
                                    <?php
                                } ?>
                                <?php
                                } ?>
                            </tr>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="ftr-pagination-sec mr-tp20">
                        <div class="row">
                        <div class="col-md-6">
                        
                        </div>
                        <div class="col-md-6">
                            <div class="ftr-pagination">
                                <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                                   <?php foreach ($links as $link) { ?>
                              <?=$link?>
                              <?php } ?>
                                  </ul>
                                </nav>
                            </div>
                        </div>
                        </div>
                    </div>
    </div>

    
</div>

