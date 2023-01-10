<?php 



if(isset($_GET['form']) && isset($_GET['to'])){

$fdate =date('Y-m-d',strtotime($_GET['form']));
$tdate =date('Y-m-d',strtotime($_GET['to']));
$countmain=$this->db->where('user_id',$logged_in_user->USER_ID)->
where('del_status',0)->
where('usertype',1)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->count_all_results();

$countmaindisable=$this->db->where('user_id',$logged_in_user->USER_ID)->
where('counselor_id =',Null)->
where('del_status',0)->
where('usertype',1)->
where('datetime >= ', $fdate)->
where('datetime <= ',$tdate)->
from("tbl_call")->count_all_results();
            }else{
            	$countmain=$this->db->where('user_id',$logged_in_user->USER_ID)->
where('del_status',0)->
where('usertype',1)->
from("tbl_call")->count_all_results();

$countmaindisable=$this->db->where('user_id',$logged_in_user->USER_ID)->where('counselor_id =',Null)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();
            }
$sdate = date('Y-m-d'); 
// $currentyear=date('Y');
$this->db->from('tbl_call sl');
//  $this->db->where('DATE(sl.datetime) >=',$currentyear.'-'.$currentmonth.'-01');
// $this->db->where('DATE(sl.datetime) <=',$currentyear.'-'.$currentmonth.'-31');
$this->db->where('DATE(sl.datetime)',$sdate);
$this->db->where('del_status',0);
$totalwalkin= $this->db->count_all_results();
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
		
		     <form action="admission.html" method="GET">       
            <div class="row filter-row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group ">
                    <input type="text" class="form-control" name="search" 
                    placeholder="Enter Fileno,Name,Student id,Email,Phone" value="">
                </div>
            </div>
            
           <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
            </div>
            </form>
		 <div class="row">
	<!--		<div class="col-md-12 col-sm-12 col-lg-12 col-xl-12">
				<div class="card dash-widget">
					<div class="card-body">
						<h4 class="card-title">Reception</h4>
						<span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
						<div class="dash-widget-info">
							<h3><?= $countmain  ?></h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 20%;" aria-valuenow="<?= $countmain ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span>Total Leads</span>
						</div>
					</div>
				</div>
			</div>-->
			
				<div class="col-md-6 col-sm-6 col-lg-4 col-xl-4">
				<div class="card dash-widget">
					<div class="card-body">
						<h4 class="card-title">Total no of follow ups</h4>
						<span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
						<div class="dash-widget-info">
							<h3><?= $nooffollowups ?></h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="<?= $nooffollowups ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span>Total no of follow ups</span>
						</div>
					</div>
				</div>
			</div>
			
            <div class="col-md-6 col-sm-6 col-lg-4 col-xl-4">
				<div class="card dash-widget">
					<div class="card-body">
						<h4 class="card-title">Total no of lead in a day</h4>
						<span class="dash-widget-icon"><i class="fa fa-user"></i></i></span>
						<div class="dash-widget-info">
							<h3><?= $totalwalkin ?></h3>
							<div class="progress mb-2" style="height: 5px;">
								<div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="<?= $totalwalkin ?>" aria-valuemin="0" aria-valuemax="100"></div>
							</div>
							<span>Total no of lead in a day</span>
						</div>
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
		</div>
		<form action="receptionDashboard.html" method="get">
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
			<div class="col-md-12 col-lg-12 col-xl-12 d-flex">
				<div class="card flex-fill">
					<div class="card-body">
						<h4 class="card-title">Reception</h4>
						<div class="statistics">
							<div class="row">
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Total</p>
										<h3><?= $countmain ?></h3>
									</div>
								</div>
								<div class="col-md-6 col-6 text-center">
									<div class="stats-box mb-4">
										<p>Overdue</p>
										<h3><?= $countmaindisable ?></h3>
									</div>
								</div>
							</div>
						</div>
						<div class="progress mb-4">
						<?php 
						 $statuscount=count($data);
						foreach ($data as $key) {
							if(isset($_GET['form']) && isset($_GET['to'])){
								$countstatus=$this->db->where('user_id',$logged_in_user->USER_ID)->
								where('status',$key->status_id)->
								where('del_status',0)->
								where('usertype',1)->
								where('datetime >= ', $fdate)->
								where('datetime <= ',$tdate)->
								from("tbl_call")->count_all_results();
							}else{

							$countstatus=$this->db->where('user_id',$logged_in_user->USER_ID)->where('status',$key->status_id)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();
							}
							$divper = 100 / $statuscount ;
							 $statusper = $countstatus / $statuscount * $divper ;
							 echo ' ';
							?>
							<div style="background-color:<?= $key->color_code ?>;width: <?= $divper ?>%" class="progress-bar" role="progressbar"  aria-valuenow="<?= $divper ?>" aria-valuemin="0" aria-valuemax="100"><?= round($statusper) ?>%</div>
							
							<?php
						}  ?>
						</div>
						<?php foreach ($data as $key) {
							if(isset($_GET['form']) && isset($_GET['to'])){
							$countstatus=$this->db->where('user_id',$logged_in_user->USER_ID)->
							where('status',$key->status_id)->
							where('del_status',0)->
							where('usertype',1)->
							where('datetime >= ', $fdate)->
							where('datetime <= ',$tdate)->
							from("tbl_call")->count_all_results();
						}else{
							$countstatus=$this->db->where('user_id',$logged_in_user->USER_ID)->where('status',$key->status_id)->where('del_status',0)->where('usertype',1)->from("tbl_call")->count_all_results();
						}
							?>
						
						<div>
							<p><i style="color:<?= $key->color_code ?>" class="fa fa-dot-circle-o  mr-2"></i><?= $key->status_title ?> <span class="float-end"><?= $countstatus ?></span></p>
							<!-- <p><i class="fa fa-dot-circle-o text-warning mr-2"></i>Hot <span class="float-end">115</span></p>
							<p><i class="fa fa-dot-circle-o text-info mr-2"></i>Warm <span class="float-end">31</span></p>
							<p><i class="fa fa-dot-circle-o text-danger mr-2"></i>Stop <span class="float-end">47</span></p>
							<p class="mb-0"><i class="fa fa-dot-circle-o text-success mr-2"></i>Ready <span class="float-end">5</span></p> -->
						</div>
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>