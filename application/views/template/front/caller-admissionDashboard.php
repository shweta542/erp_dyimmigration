<?php if(isset($_GET['form']) && isset($_GET['to'])){

	 $fdate =date('Y-m-d',strtotime($_GET['form']));
     $tdate =date('Y-m-d',strtotime($_GET['to']));

     $countreception=$this->db->where('del_status',0)->
     where('datetime >= ', $fdate)->
	where('datetime <= ',$tdate)->
     where('usertype',1)->
     from("tbl_call")->count_all_results();

$counttelecaller=$this->db->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
where('del_status',0)->
where('usertype',2)->
from("tbl_call")->count_all_results();

$countCounselor=$this->db->where('del_status',0)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->count_all_results();
$countCounselordisable=$this->db->where('counselor_id =',Null)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
where('del_status',0)->
where('admission_status',0)->
from("tbl_call")->count_all_results();

$countmaincounselor=$this->db->where('counselor_id =',Null)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
where('del_status',0)->
from("tbl_call")->count_all_results();



$countreceptiondisable=$this->db->where('admission_status',0)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
where('del_status',0)->
where('usertype',1)->
from("tbl_call")->count_all_results();

$counttelecallerdisable=$this->db->where('admission_status',0)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
where('del_status',0)->
where('usertype',2)->
from("tbl_call")->count_all_results();
}else{
$countreception=$this->db->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();

$counttelecaller=$this->db->where('del_status',0)->where('usertype',2)->from("tbl_call")->count_all_results();

$countCounselor=$this->db->where('del_status',0)->from("tbl_call")->count_all_results();
$countCounselordisable=$this->db->where('counselor_id =',Null)->where('del_status',0)->where('admission_status',0)->from("tbl_call")->count_all_results();

$countmaincounselor=$this->db->where('counselor_id =',Null)->where('del_status',0)->from("tbl_call")->count_all_results();

$countmainadmission=$this->db->where('del_status',0)->from("tbl_admission_meta")->count_all_results();

$countreceptiondisable=$this->db->where('admission_status',0)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();
$counttelecallerdisable=$this->db->where('admission_status',0)->where('del_status',0)->where('usertype',2)->from("tbl_call")->count_all_results();
} 
$countmainadmission=$this->db->where('del_status',0)->from("tbl_admission_meta")->count_all_results();
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3>Welcome, <?= $logged_in_user->USER_NAME ?> </h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item active">Dashboard</li>
					</ul>
				</div>
			</div>
		</div>
		<form action="admissionDashboard.html" method="get">
        <div class="row filter-row">
            
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" name="form" value="<?= (isset($_GET['form']))?$_GET['form']:'' ?>" required=""/>
                    </div>
                    <label class="focus-label">From</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                        <input class="form-control floating datetimepicker" type="text" name="to" value="<?= (isset($_GET['to']))?$_GET['to']:'' ?>" required=""/>
                    </div>
                    <label class="focus-label">To</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
        </div>
        </form>
		<div class="row">
			<div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
				<div class="card dash-widget">
					<div class="card-body">
						<h4 class="card-title">Reception</h4>
						<span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
						<div class="dash-widget-info">
							<h3><?= $countreception ?></h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 20%;" aria-valuenow="<?= $countreception ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span>Total Reception</span>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-lg-3 col-xl-3">
				<div class="card dash-widget">
					<div class="card-body">
						<h4 class="card-title">Telecaller</h4>
						<span class="dash-widget-icon"><i class="fa fa-user"></i></span>
						<div class="dash-widget-info">
							<h3><?= $counttelecaller ?></h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 80%;" aria-valuenow="<?= $counttelecaller ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span>Total Telecaller</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
				<div class="card dash-widget">
					<div class="card-body">
						<h4 class="card-title">Counselor</h4>
						<span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
						<div class="dash-widget-info">
							<h3><?= $countmaincounselor ?></h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="<?= $countmaincounselor ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span>Total Counselor</span>
						</div>
					</div>
				</div>
			</div>
			
			<div class="col-md-6 col-sm-6 col-lg-3 col-xl-3">
				<div class="card dash-widget">
					<div class="card-body">
						<h4 class="card-title">Admission</h4>
						<span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
						<div class="dash-widget-info">
							<h3><?= $countmainadmission ?></h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 60%;" aria-valuenow="<?= $countmainadmission ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span>Total Admission</span>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-lg-3 col-xl-3 d-flex">
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
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue</p>
										<h3><?= $countreceptiondisable ?></h3>
									</div>
								</div>
							</div>
						</div>
						<div class="progress mb-4">
							<?php 
								$statuscount=count($status);
							foreach ($status as $key) {
								if(isset($_GET['form']) && isset($_GET['to'])){
								$fdate =date('Y-m-d',strtotime($_GET['form']));
            					$tdate =date('Y-m-d',strtotime($_GET['to']));
            					$countstatus=$this->db->where('status',$key->status_id)->
            					where('del_status',0)->
            					where('usertype',1)->
            					where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
            					from("tbl_call")->
            					count_all_results();
            				}else{

								$countstatus=$this->db->where('status',$key->status_id)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();
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
								$countstatus=$this->db->where('status',$key->status_id)->
								where('del_status',0)->
								where('usertype',1)->
								where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
								$countstatus=$this->db->where('status',$key->status_id)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();
							}
								?>
							

							<p><i style="color:<?= $key->color_code ?>" class="fa fa-dot-circle-o  mr-2"></i><?= $key->status_title ?> <span class="float-end"><?= $countstatus ?></span></p>
							<?php
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 col-xl-3 d-flex">
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
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue</p>
										<h3><?= $counttelecallerdisable ?></h3>
									</div>
								</div>
							</div>
						</div>
						<div class="progress mb-4">
							<?php 
								$statuscount=count($status);
							foreach ($status as $key ) {
								if(isset($_GET['form']) && isset($_GET['to'])){
								$fdate =date('Y-m-d',strtotime($_GET['form']));
            					$tdate =date('Y-m-d',strtotime($_GET['to']));
								$countstatus=$this->db->where('status',$key->status_id)->
								where('del_status',0)->
								where('usertype',2)->
								where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
								$countstatus=$this->db->where('status',$key->status_id)->where('del_status',0)->where('usertype',2)->from("tbl_call")->count_all_results();
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
								$countstatus=$this->db->where('status',$key->status_id)->
								where('del_status',0)->
								where('usertype',2)->
								where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
								$countstatus=$this->db->where('status',$key->status_id)->where('del_status',0)->where('usertype',2)->from("tbl_call")->count_all_results();
							}
								?>
							
							<p><i style="color:<?= $key->color_code ?>" class="fa fa-dot-circle-o  mr-2"></i><?= $key->status_title ?> <span class="float-end"><?= $countstatus ?></span></p>
							<?php
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 col-xl-3 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Counselor</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total</p>
										<h3><?= $countmaincounselor ?></h3>
									</div>
								</div>
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue</p>
										<h3><?= $countCounselordisable ?></h3>
									</div>
								</div>
							</div>
						</div>
						<div class="progress mb-4">
							<?php 
								$statuscount=count($status);
							foreach ($status as $key ) {
								if(isset($_GET['form']) && isset($_GET['to'])){
								$fdate =date('Y-m-d',strtotime($_GET['form']));
            					$tdate =date('Y-m-d',strtotime($_GET['to']));
								$countstatus=$this->db->where('status',$key->status_id)->
								where('counselor_id =',Null)->
								where('del_status',0)->
								where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
								$countstatus=$this->db->where('counselor_id =',Null)->where('status',$key->status_id)->where('del_status',0)->from("tbl_call")->count_all_results();
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
								$countstatus=$this->db->where('status',$key->status_id)->
								where('counselor_id =',Null)->
								where('del_status',0)->
								where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
								from("tbl_call")->
								count_all_results();
							}else{
$countstatus=$this->db->
where('counselor_id =',Null)->
where('status',$key->status_id)->
where('del_status',0)->
from("tbl_call")->
count_all_results();
							}
								?>
							
							<p><i style="color:<?= $key->color_code ?>" class="fa fa-dot-circle-o  mr-2"></i><?= $key->status_title ?> <span class="float-end"><?= $countstatus ?></span></p>
							<?php
							} ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-3 col-xl-3 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Admission</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total</p>
										<h3><?= $countmainadmission ?></h3>
									</div>
								</div>
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue</p>
										<h3>0</h3>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="progress mb-4">
							<div class="progress-bar bg-purple" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
							
						</div>
						<div>
							<p><i class="fa fa-dot-circle-o text-purple mr-2"></i>Cold <span class="float-end">166</span></p>
							
						</div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>