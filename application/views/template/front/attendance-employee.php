
<?php 
date_default_timezone_set("Asia/Kolkata");
$arr = explode('|',$privileges_settings->designation) ;
$time = explode('.',$todaySum->time);
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
if(isset($_GET['date']) && $_GET['date'] !=""){
    $year =$_GET['year'];
}else{
    $year = date('Y');
}

$maxDays=cal_days_in_month(CAL_GREGORIAN,$month,$year);
 if(isset($_GET['date'])){
        $tdate= $_GET['date'];
}else{
    $tdate= date('d M Y');
} 
?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Attendance</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Attendance</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card punch-status">
                                <div class="card-body">
                                    <h5 class="card-title">Timesheet <small class="text-muted"><?= date('d M Y') ?></small></h5>
                                    <div class="punch-det">
                                        <h6>Punch In at</h6>
                                        <p><?= (!empty($checkAttIN))?get_datetime($checkAttIN->punchIn):date('D, d M Y');?></p>
                                    </div>
                                    <div class="punch-info">
                                        <div class="punch-hours">
                                            <span><?= ($time[0])?$time[0]:'00:00'?> hrs</span>
                                        </div>
                                    </div>
                                    <div class="punch-btn-section">
                                        <button onclick="markAttendance('<?= date('y-m-d h:i:s') ?>','<?= $logged_in_user->USER_ID ?>')" type="button" class="btn btn-primary punch-btn"><?php if(!empty($checkAttIN) && $checkAttIN->punchIn && $checkAttIN->punchOut == '0000-00-00 00:00:00'){
                                            echo "Punch Out";
                                        }else{
                                            echo "Punch In";
                                        }?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="col-md-6">
                            <div class="card recent-activity">
                                <div class="card-body">
                                    <h5 class="card-title">Today Activity</h5>
                                    <ul class="res-activity-list">
                                        <?php foreach ($todayActivity as $key) {
                                           if($key->punchIn){
                                            ?>
                                                <li>
                                                    <p class="mb-0">Punch In at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        <?= get_time($key->punchIn) ?>
                                                    </p>
                                                </li>
                                            <?php
                                           }
                                           if($key->punchOut != '0000-00-00 00:00:00'){
                                            ?>
                                                <li>
                                                    <p class="mb-0">Punch Out at</p>
                                                    <p class="res-activity-time">
                                                        <i class="fa fa-clock-o"></i>
                                                        <?= get_time($key->punchOut) ?>
                                                       
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
                    <form action="attendanceEmployee.html" method="get">
                    <div class="row filter-row">
                        <div class="col-sm-3">
                            <div class="form-group form-focus">
                                <div class="cal-icon">
                                    <input type="text" class="form-control floating datetimepicker" name="date"  value="<?= $tdate; ?>"/>
                                </div>
                                <label class="focus-label">Date</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-focus select-focus">
                                <select class="select floating" name="month" >
                        <option value="">Select Month</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month'] == '01'){echo 'selected';}} ?> value="01">Jan</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='02'){echo 'selected';}} ?> value="02">Feb</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='03'){echo 'selected';}} ?> value="03">Mar</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='04'){echo 'selected';}} ?> value="04">Apr</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='05'){echo 'selected';}} ?> value="05">May</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='06'){echo 'selected';}} ?> value="06">Jun</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='07'){echo 'selected';}} ?> value="07">Jul</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='08'){echo 'selected';}} ?> value="08">Aug</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='09'){echo 'selected';}} ?> value="09">Sep</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='10'){echo 'selected';}} ?> value="10">Oct</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='11'){echo 'selected';}} ?> value="11">Nov</option>
                        <option <?php if(isset($_GET['month'])){if($_GET['month']=='12'){echo 'selected';}} ?> value="12">Dec</option>
                    </select>
                                <label class="focus-label">Select Month</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-focus select-focus">
                                <select class="select floating" name="year" >
                        
                        <?php 
   for($i = 2021 ; $i <= date('Y'); $i++){
    ?>
                        <option <?= ($i == date('Y'))?'selected':'' ?> value="<?= $i  ?>"><?= $i; ?></option>
                        
                    <?php } ?>
                    </select>
                                <label class="focus-label">Select Year</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success btn-block"> Search </button>
                        </div>
                    </div>
                    </form>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <!-- <th>#</th> -->
                                            <th>Date</th>
                                            <th>Day</th>    
                                            <th>Punch In</th>
                                            <th>Punch Out</th>
                                            <th>Total Hours</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php 

                                for ($i=1; $i <= $maxDays ; $i++) { 
                                    $time=mktime(12, 0, 0, $month, $i, $year);          
                                    if (date('m', $time)==$month)  
                                    $finalTest=$this->db->select("SEC_TO_TIME(SUM(TIME_TO_SEC(timeDiff))) as time")->
        where('user_id',$logged_in_user->USER_ID)->

        where('punchIn >=', date($year.'-'.$month.'-d 00:00:00', $time))->
        where('punchIn <=', date($year.'-'.$month.'-d 23:59:59', $time))->
        get('tbl_attendance')->row();  
           $stime = explode('.',$finalTest->time);
     $attData=$this->db->select('punchIn,punchOut')->where('user_id',$logged_in_user->USER_ID)->
    where('punchIn >=', date($year.'-'.$month.'-d 00:00:00', $time))->
    where('punchIn <=', date($year.'-'.$month.'-d 23:59:59', $time))->
    get('tbl_attendance')->result();
                                $puncharr=[];
                                $punchoutarr=[];
                                foreach ($attData as $key ) {
                                     $times = date("g:i a", strtotime($key->punchIn));
                                   array_push($puncharr,$times);
                                   if($key->punchOut){
                                        if($key->punchOut != '0000-00-00 00:00:00'){

                                         $timesout = date("g:i a", strtotime($key->punchOut));
                                            array_push($punchoutarr,$timesout);
                                        }
                                    }
                                }
                                $mainpunchin=implode('|', $puncharr);
                                
                                
                                $mainpunchout=implode('|', $punchoutarr);
                                if(isset($_GET['date'])){
                                    if($_GET['date'] == date('d M Y', $time)){
                                    ?>
                                        <tr>
                                           <!--  <td><?= $i ?></td> -->
                                            <td><?= date('d M Y', $time) ?></td>
                                            <td><?= date('l', strtotime(date('d M Y', $time))); ?></td>
                                            <td><?= $mainpunchin ?> </td>
                                            <td><?= $mainpunchout ?></td>
                                            <td><?= ($stime[0])?$stime[0]:'00:00'?></td>
                                        </tr>
                                       <?php }else{
                                        ?>
                                        <?php
                                       } }else{
                                        ?>
                                        <tr>
                                            <!-- <td><?= $i ?></td> -->
                                            <td><?= date('d M Y', $time) ?></td>
                                            <td><?= date('l', strtotime(date('d M Y', $time))); ?></td>
                                            <td><?= $mainpunchin ?> </td>
                                            <td><?= $mainpunchout ?></td>
                                            <td><?= ($stime[0])?$stime[0]:'00:00'?></td>
                                        </tr>
                                        <?php
                                       }} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

