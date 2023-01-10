<?php

$arr = explode('|',$previllage->banking);
 $curentdate=date('Y-m-d');
 $nextdaydate=date('Y-m-d', strtotime(' +1 day'));
 $month=date('m');
$todayLeave=$this->db->
where('maindateto >=', $curentdate)->
where('maindate <=', $curentdate)->
get('tbl_leave')->result();
$nextLeave=$this->db->
where('maindateto >=', $nextdaydate)->
where('maindate <=', $nextdaydate)->
get('tbl_leave')->result();
$getholiday = $this->db->like('holidays_date',$month)->get('tbl_holidays')->result();
$getbirthday = $this->db->like('dob',$month)->get('tbl_user_meta')->result();
$sdate = date('Y-m-d'); 

/*$currentmonth=date('m');  
$currentyear=date('Y');*/
$this->db->from('tbl_call sl');
/*$this->db->where('DATE(sl.datetime) >=',$currentyear.'-'.$currentmonth.'-01');
$this->db->where('DATE(sl.datetime) <=',$currentyear.'-'.$currentmonth.'-31');*/
  $this->db->where('DATE(sl.datetime)',$sdate);
$this->db->where('del_status',0);
$totalwalkin= $this->db->count_all_results(); 


if(isset($_GET['form']) && isset($_GET['to'])){
$fdate =date('Y-m-d',strtotime($_GET['form']));
$tdate =date('Y-m-d',strtotime($_GET['to']));
$countreception=$this->db->where('counselor_id',$logged_in_user->USER_ID)->
where('del_status',0)->
where('usertype',1)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->
count_all_results();

$counttelecaller=$this->db->where('counselor_id',$logged_in_user->USER_ID)->
where('del_status',0)->
where('usertype',2)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->
count_all_results();

$countCounselor=$this->db->where('counselor_id',$logged_in_user->USER_ID)->
where('del_status',0)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->
count_all_results();

$countCounselorenable=$this->db->where('counselor_id',$logged_in_user->USER_ID)->
where('del_status',0)->
where('admission_status',1)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->
count_all_results();

$countmaincounselorreception=$this->db->where('counselor_id',$logged_in_user->USER_ID)->
where('counselor_id =',Null)->
where('del_status',0)->
where('usertype',1)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->
count_all_results();

$countmaincounselortelecaller=$this->db->where('counselor_id',$logged_in_user->USER_ID)->
where('counselor_id =',Null)->
where('del_status',0)->
where('usertype',2)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->
count_all_results();
}else{
$countreception=$this->db->where('user_id',$logged_in_user->USER_ID)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();

$counttelecaller=$this->db->where('user_id',$logged_in_user->USER_ID)->where('del_status',0)->where('usertype',2)->from("tbl_call")->count_all_results();

$countCounselor=$this->db->where('user_id',$logged_in_user->USER_ID)->where('del_status',0)->from("tbl_call")->count_all_results();
$countCounselorenable=$this->db->where('user_id',$logged_in_user->USER_ID)->where('del_status',0)->where('admission_status',1)->from("tbl_call")->count_all_results();

$countmaincounselorreception=$this->db->where('user_id',$logged_in_user->USER_ID)->where('counselor_id =',Null)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();

$countmaincounselortelecaller=$this->db->where('user_id',$logged_in_user->USER_ID)->where('counselor_id =',Null)->where('del_status',0)->where('usertype',2)->from("tbl_call")->count_all_results();
}

    $usertbl=$this->db->where('USER_ID',$logged_in_user->USER_ID)->where('STATUS','0')->get('user_tbl')->row_array();
?>
<div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="welcome-box">
                                <div class="welcome-img">
                                    <img alt="" src="<?= ($logged_in_user->user_image)?$logged_in_user->user_image:'assets/img/user.jpg' ?>" />
                                </div>
                                <div class="welcome-det">
                                    <h3>Welcome, <?= $logged_in_user->USER_NAME ?></h3>
                                    <p><?= date('l, d M Y') ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
         <form action="admission.html" method="GET">       
            <div class="row filter-row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group ">
                    <input type="text" class="form-control" name="search" 
                    placeholder="Enter Fileno, Name, Student id, Email, Phone" value="">
                </div>
            </div>
            
           <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
            </div>
            </form>
                        <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        
                        <?php 
                        //$countreception=$this->db->where('counselor_id',$logged_in_user->USER_ID)->
                    
                    //	$previllage= $this->db->where('USER_ID',$logged_in_user->USER_ID)->get('privileges_tbl')->row();
                     if (in_array('2', $arr,true)) {	
                    //  if($usertbl['USER_ID']=='1' && $usertbl['STATUS']=='1'){
                          
                      // if($usertbl)
                        ?>
                     <div class="col-md-8 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Total Cash Flow</h3>
                                    <div id="bar-charts"></div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                       <?php 
                       
                       $arr = explode('|',$previllage->ProfitLoss);
                        if (in_array('2', $arr,true)) {
                       ?> 
                        
                        <div class="col-md-4 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Expenses </h3>
                                    <div id="chartContainer" style="height: 340px; width: 100%;"></div>  
  
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                    </div>
                </div>
            </div>
            
            
               <div class="row">
              <!--  <div class="col-md-4 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
                            <div class="dash-widget-info">
                                <h3><?= $totalemployee ?></h3>
                                <span>Total Employees</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                            <div class="dash-widget-info">
                                <h3><?= $totalbranch ?></h3>
                                <span>Branches</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
                            <div class="dash-widget-info">
                                <h3><?= $todaypresent ?></h3>
                                <span>Today Present</span>
                            </div>
                        </div>
                    </div>
                </div>-->
            </div>
             <div class="row">
                <div class="col-md-3 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
                            <div class="dash-widget-info">
                                <h3><?= $totalenquiry ?></h3>
                                <span>Total No of Enquiries in a day</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-building"></i></span>
                            <div class="dash-widget-info">
                                <h3><?= $nooffollowups ?></h3>
                                <span>Total No of Follow up in a day</span>
                            </div>
                        </div>
                    </div>
                </div>
                
               <div class="col-md-3 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
                            <div class="dash-widget-info">
                                <h3><?= $totalwalkin ?></h3>
                                <span>Total no of lead in a day</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <div class="col-md-3 col-sm-6 col-lg-6 col-xl-3">
                    <div class="card dash-widget">
                        <div class="card-body">
                            <span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
                            <div class="dash-widget-info">
                                <h3><?php if(isset($totalenrollmnt) && ($totalenrollmnt!="")) {echo $totalenrollmnt; }else{
                                echo "";}?></h3>
                                <span>Total no of Enrollment in a day</span>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
         	<div class="row">
         	   <?php if($privileges_settings->reception != 0){
            	?>
         	    
			<div class="col-md-12 col-lg-12 col-xl-12 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Reception</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total</p>
										<h3><?= $countreception ?></h3>
									</div>
								</div>
								<!--<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue</p>
										<h3><?= $countmaincounselorreception ?></h3>
									</div>
								</div>-->
							</div>
						</div>
						<div class="progress mb-4">
							<?php 
								$statuscount=count($status);
							foreach ($status as $key) {
								if(isset($_GET['form']) && isset($_GET['to'])){
								$fdate =date('Y-m-d',strtotime($_GET['form']));
            					$tdate =date('Y-m-d',strtotime($_GET['to']));
            					$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('status',$key->status_id)->
            					where('del_status',0)->
            					where('usertype',1)->
            					where('6 >= ', $fdate)->
								where('datetime <= ',$tdate)->
            					from("tbl_call")->
            					count_all_results();
            				}else{
	$sdate = date('Y-m-d'); 
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('datetime',$sdate)->where('status',$key->status_id)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();
            				}

								$divper = 100 / $statuscount ;
							 	$statusper = $countstatus / $statuscount * $divper ;
							 	echo ' ';
								?>
							<div style="background-color:<?= $key->color_code ?>;width: <?= $divper ?>%" class="progress-bar " role="progressbar"  aria-valuenow="<?= $divper ?>" aria-valuemin="0" aria-valuemax="100"><?= round($statusper) ?>%</div>
								<?php
							} ?>
							
						</div>
						<div>
							<?php 
								
							foreach ($status as $key ) {
								if(isset($_GET['form']) && isset($_GET['to'])){
								$fdate =date('Y-m-d',strtotime($_GET['form']));
            					$tdate =date('Y-m-d',strtotime($_GET['to']));
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('status',$key->status_id)->
								where('del_status',0)->
								where('usertype',1)->
								where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
							    	$sdate = date('Y-m-d'); 
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('datetime',$sdate)->where('status',$key->status_id)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();
							}
								?>
							

							<p><i style="color:<?= $key->color_code ?>" class="fa fa-dot-circle-o  mr-2"></i><?= $key->status_title ?> <span class="float-end"><?= $countstatus ?></span></p>
							<?php
							} ?>
							
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			  <?php if($privileges_settings->telecaller != 0){
            	?>
			<div class="col-md-6 col-lg-4 col-xl-12 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Telecaller</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total</p>
										<h3><?= $counttelecaller ?></h3>
									</div>
								</div>
							<!--	<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue</p>
										<h3><?= $countmaincounselortelecaller ?></h3>
									</div>
								</div>-->
							</div>
						</div>
						<div class="progress mb-4">
							<?php 
								$statuscount=count($status);
							foreach ($status as $key ) {
								if(isset($_GET['form']) && isset($_GET['to'])){
								$fdate =date('Y-m-d',strtotime($_GET['form']));
            					$tdate =date('Y-m-d',strtotime($_GET['to']));
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('status',$key->status_id)->
								where('del_status',0)->
								where('usertype',2)->
								where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
							    	$sdate = date('Y-m-d'); 
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('datetime',$sdate)->where('status',$key->status_id)->where('del_status',0)->where('usertype',2)->from("tbl_call")->count_all_results();
							}
								$divper = 100 / $statuscount ;
							 	$statusper = $countstatus / $statuscount * $divper ;
							 	echo ' ';
								?>
							<div style="background-color:<?= $key->color_code ?>;width: <?= $divper ?>%" class="progress-bar " role="progressbar"  aria-valuenow="<?= $divper ?>" aria-valuemin="0" aria-valuemax="100"><?= round($statusper) ?>%</div>
							<?php
							} ?>
						</div>
						<div>
							<?php 
								
							foreach ($status as $key ) {
								if(isset($_GET['form']) && isset($_GET['to'])){
							//	$fdate =date('Y-m-d',strtotime($_GET['form']));
            				//	$tdate =date('Y-m-d',strtotime($_GET['to']));
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('status',$key->status_id)->
								where('del_status',0)->
								where('usertype',2)->
							//	where('datetime >= ', $fdate)->
							//	where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
							    $sdate = date('Y-m-d'); 
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('DATE(datetime)',$sdate)->where('status',$key->status_id)->where('del_status',0)->where('usertype',2)->from("tbl_call")->count_all_results();
							}
								?>
							
							<p><i style="color:<?= $key->color_code ?>" class="fa fa-dot-circle-o  mr-2"></i><?= $key->status_title ?> in a day <span class="float-end"><?= $countstatus ?></span></p>
							<?php
							} ?>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			   <?php  //if($usertbl['USER_TYPE']=='3'){  ?>
			   	<?php if($privileges_settings->counselor != 0){
            	?>
			<div class="col-md-6 col-lg-4 col-xl-12 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Counselor</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total</p>
										<h3><?= $countCounselor ?></h3>
									</div>
								</div>
								<!--<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue</p>
										<h3><?= $countCounselorenable ?></h3>
									</div>
								</div>-->
							</div>
						</div>
						<div class="progress mb-4">
							<?php 
								$statuscount=count($status);
							foreach ($status as $key ) {
								if(isset($_GET['form']) && isset($_GET['to'])){
							//	$fdate =date('Y-m-d',strtotime($_GET['form']));
            				//	$tdate =date('Y-m-d',strtotime($_GET['to']));
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('status',$key->status_id)->
								where('del_status',0)->
							//	where('datetime >= ', $fdate)->
							//	where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
							    $sdate = date('Y-m-d'); 
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('DATE(datetime)',$sdate)->where('status',$key->status_id)->where('del_status',0)->from("tbl_call")->count_all_results();
							}
								$divper = 100 / $statuscount ;
							 	$statusper = $countstatus / $statuscount * $divper ;
							 	echo ' ';
								?>
							<div style="background-color:<?= $key->color_code ?>;width: <?= $divper ?>%" class="progress-bar " role="progressbar"  aria-valuenow="<?= $divper ?>" aria-valuemin="0" aria-valuemax="100"><?= round($statusper) ?>%</div>
							<?php
							} ?>
						</div>
						<div>
							<?php 
								
							foreach ($status as $key ) {
								if(isset($_GET['form']) && isset($_GET['to'])){
							//	$fdate =date('Y-m-d',strtotime($_GET['form']));
            				//	$tdate =date('Y-m-d',strtotime($_GET['to']));
								$countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->where('status',$key->status_id)->
								where('del_status',0)->
							//	where('datetime >= ', $fdate)->
							//	where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
                                $sdate = date('Y-m-d'); 
                                $countstatus=$this->db->where('counselor_id',$logged_in_user->USER_ID)->
                                where('status',$key->status_id)->
                                where('del_status',0)->
                                where('DATE(datetime)',$sdate)->
                                from("tbl_call")->
                                count_all_results();
							}
								?>
							
							<p><i style="color:<?= $key->color_code ?>" class="fa fa-dot-circle-o  mr-2"></i><?= $key->status_title ?> in a day <span class="float-end"><?= $countstatus ?></span></p>
							<?php
							} ?>
						</div>
					</div>
				</div>
			</div>
				<?php } ?>
		</div>
                    <div class="row">
                        <div class="col-lg-8 col-md-8">
                            <section class="dash-section">
                                <h1 class="dash-sec-title">Today</h1>
                                <div class="dash-sec-content">
                                    <?php 
                                    if (!empty($todayLeave)) {
                                    foreach ($todayLeave as $key) {
                                $userdata=$this->db->select('USER_NAME')->where('USER_ID',$key->USER_ID)->get('user_tbl')->row();

                                ?>
                                <div class="dash-info-list">
                                    <a href="javascript:void(0);" class="dash-card">
                                        <div class="dash-card-container">
                                            <div class="dash-card-icon">
                                               <i class="fa fa-suitcase"></i>
                                            </div>
                                            <div class="dash-card-content">
                                                <p><?= $userdata->USER_NAME  ?> is on <?php if($key->leave_type == '1'){
                                            echo "Full Day";
                                        }else if($key->leave_type == '2'){
                                            echo "Half Day";
                                        }else{
                                            echo "Short Leave";
                                        } ?> today</p>
                                            </div>
                                            <div class="rt-lve-tag">
                                                  <?php  if($key->status == 1){
                                        echo '<span class="dropdown-item"><i class="fa fa-dot-circle-o text-info"></i>Leave Pending</span>
';
                                    }else if($key->status == 2){
                                        echo '<span class="dropdown-item"><i class="fa fa-dot-circle-o text-success"></i>Leave Approved</span>';
                                    }else if($key->status == 3){
                                        echo '<span class="dropdown-item"><i class="fa fa-dot-circle-o text-danger"></i>Leave Declined</span>';
                                    }else{
                                         echo '<span class="dropdown-item"><i class="fa fa-dot-circle-o text-purple"></i>Leave Cancel</span>';
                                    }?>
                                                
                                            </div>
                                            <!-- <div class="dash-card-avatars">
                                                <div class="e-avatar"><img src="assets/img/profiles/avatar-09.jpg" alt="" /></div>
                                            </div> -->
                                        </div>
                                        <!-- <small><?php  if($key->status == 1){
                                        echo 'Leave status is pennding';
                                    }else if($key->status == 2){
                                        echo 'Leave status is approve';
                                    }else if($key->status == 3){
                                        echo 'Leave status is decline';
                                    }else{
                                         echo 'I cancel my leave';
                                    } ?></small> -->
                                    </a>
                                    
                                </div>

                                <?php
                            }
                            }else{
                            echo 'No data found';
                        } ?>
                                </div>
                            </section>
                            <section class="dash-section">
                                <h1 class="dash-sec-title">Tomorrow</h1>
                                <div class="dash-sec-content">
                                    <?php 
                                    if (!empty($nextLeave)) {
                                    foreach ($nextLeave as $key) {
                                $userdata=$this->db->select('USER_NAME')->where('USER_ID',$key->USER_ID)->get('user_tbl')->row();
                                ?>
                                <div class="dash-info-list">
                                    <a href="profile.php" class="dash-card">
                                        <div class="dash-card-container">
                                            <div class="dash-card-icon">
                                               <i class="fa fa-suitcase"></i>
                                            </div>
                                            <div class="dash-card-content">
                                                <p><?= $userdata->USER_NAME  ?> is on <?php if($key->leave_type == '1'){
                                            echo "Full Day";
                                        }else if($key->leave_type == '2'){
                                            echo "Half Day";
                                        }else{
                                            echo "Short Leave";
                                        } ?> tomorrow</p>
                                            </div>
                                            <!-- <div class="dash-card-avatars">
                                                <div class="e-avatar"><img src="assets/img/profiles/avatar-09.jpg" alt="" /></div>
                                            </div> -->
                                        </div>
                                         <div class="rt-lve-tag">
                                            <?php  if($key->status == 1){
                                        echo '<span class="dropdown-item"><i class="fa fa-dot-circle-o text-info"></i>Leave Pending</span>
';
                                    }else if($key->status == 2){
                                        echo '<span class="dropdown-item"><i class="fa fa-dot-circle-o text-success"></i>Leave Approved</span>';
                                    }else if($key->status == 3){
                                        echo '<span class="dropdown-item"><i class="fa fa-dot-circle-o text-danger"></i>Leave Declined</span>';
                                    }else{
                                         echo '<span class="dropdown-item"><i class="fa fa-dot-circle-o text-purple"></i>Leave Cancel</span>';
                                    }?>
                                                 
                                                 <!-- <span class="dropdown-item"><i class="fa fa-dot-circle-o text-success"></i> Approved</span>

                                                 <span class="dropdown-item"><i class="fa fa-dot-circle-o text-danger"></i> Declined</span>

                                                 <span class="dropdown-item"><i class="fa fa-dot-circle-o text-purple"></i> Cancel</span>-->
                                                
                                            </div>
                                        <!-- <small><?php  if($key->status == 1){
                                        echo 'Leave status is pennding';
                                    }else if($key->status == 2){
                                        echo 'Leave status is approve';
                                    }else if($key->status == 3){
                                        echo 'Leave status is decline';
                                    }else{
                                         echo 'I cancel my leave';
                                    } ?></small> -->
                                    </a>

                                </div>

                                <?php
                            } 
                            }else{
                            echo 'No data found';
                        } 
                            ?>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="dash-sidebar">
                                
                                <section>
                                    <h5 class="dash-title">Your Leave Status</h5>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="time-list">
                                            <h5 class="dash-title">full day </h5>
                                                <div class="dash-stats-list">
                                                    <h4><?= ($fullday->fullcount)?$fullday->fullcount:'0'  ?></h4>
                                                    <p>Leave Taken</p>
                                                </div>
                                                <div class="dash-stats-list">
                                                    <h4><?= $organisationleave->total_fullday-$fullday->fullcount  ?></h4>
                                                    <p>Remaining</p>
                                                </div>
                                            </div>
                                            <div class="time-list">
                                                 <h5 class="dash-title">Half day </h5>
                                                <div class="dash-stats-list">
                                                    <h4><?= ($haflday->halfcount)?$haflday->halfcount:'0' ?></h4>
                                                    <p>Leave Taken</p>
                                                </div>
                                                <div class="dash-stats-list">
                                                    <h4><?= $organisationleave->total_halfday-$haflday->halfcount ?></h4>
                                                    <p>Remaining</p>
                                                </div>
                                            </div>
                                            <div class="time-list">
                                                 <h5 class="dash-title">Short day </h5>
                                                <div class="dash-stats-list">
                                                    <h4><?= ($shortday->shortcount)?$shortday->shortcount:'0' ?></h4>
                                                    <p>Leave Taken</p>
                                                </div>
                                                <div class="dash-stats-list">
                                                    <h4><?= $organisationleave->total_shortleave-$shortday->shortcount ?></h4>
                                                    <p>Remaining</p>
                                                </div>
                                            </div>
                                            <div class="request-btn">
                                                <a class="btn btn-primary" href="addleave.html">Apply Leave</a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                <section style="<?= (empty($getbirthday))?'display:none':'' ?>">
                            <h1 class="dash-sec-title">Upcoming Birtday</h1>
                            <?php foreach ($getbirthday as $key) {
                                $dobdata=$this->db->where('USER_ID',$key->user_id)->get('user_tbl')->row();
                                ?>

                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="dash-card-container m-b-10">
                                            <div class="dash-card-icon text-orange">
                                                <i class="fa fa-birthday-cake"></i>
                                            </div>
                                            <div class="dash-card-content">
                                                <p><?= $dobdata->USER_NAME ?> Birthday is on <?= date('d M',strtotime($key->dob)) ?></p>
                                            </div>
                                            <div class="dash-card-avatars">
                                                <div class="e-avatar"><img src="<?= ($dobdata->user_image)?$dobdata->user_image:'assets/img/profiles/avatar-02.jpg' ?>" alt=""></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            } ?>

                        </section>
                                 <section>
                            <h1 class="dash-sec-title">Upcoming Holidays</h1>
                            <div class="card">
                                <?php 
                                 if(!empty($getholiday)){
                                foreach ($getholiday as $key) {
                                    ?>
                                        <div class="card-body text-center">
                                            <h4 class="holiday-title mb-0"><?= date('l', strtotime($key->holidays_date)) ?> <?= date('d M Y',strtotime($key->holidays_date))  ?> - <?= $key->holidays_name ?></h4>
                                        </div>

                                    <?php
                                } 
                            }else{
                                 echo 'No data found';
                            }?>
                                
                            </div>
                        </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>




