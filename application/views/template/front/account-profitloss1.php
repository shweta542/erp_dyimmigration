
<?php $arr = explode('|',$privileges_settings->designation) ;
function CheckNumber($x) {
  if ($x > 0)
    {$message = "profit";}
  if ($x == 0)
    {$message = "Zero";}
  if ($x < 0)
    {$message = "loss";}
  return $message;
}
if(isset($_GET['branch'])){
    $branchData=$this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('branch_id',$_GET['branch'])->get('tbl_branch')->row();
}

$incomeIn1=0;
foreach ($datamoneyin as $key) {
    $incomeIn1+=$key->myamount;
}
?>
<div class="page-wrapper">
	<div class="content container-fluid">
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Profit/Loss Account</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Profit/Loss Account</li>
					</ul>
				</div>
				<div class="col-auto float-right ml-auto">
	 <a class="btn btn-white" href="javascript:void(0)" onclick="CreatePDFfromHTML('card','profitloss')">PDF</a>
                    <!-- <button class="btn btn-white m-r-10" onclick="exportexel('exeljournal', 'journal')"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export </button> -->
				</div>
			</div>
		</div>
		 <form action="profitloss.html" method="get">
         <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                    <?php if($logged_in_user->STATUS == 1){
                                        ?>
                                    <select class="select" name="branch" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {
                                            ?>
                                <option <?php if(isset($_GET['branch'])){if($_GET['branch'] == $key->branch_id){echo 'Selected';}} ?> value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    }else{
                                        $branchArr=explode('|', $logged_in_user->branch_id)
                                        ?>
                                    <select class="select" name="branch" required="">
                                         <option value="">Select Branch</option>
                                        
                                        <?php foreach ($branch as $key ) {

                                            ?>
                                <option <?php if(in_array($key->branch_id, $branchArr,true)){echo 'selected';}else{echo 'disabled';} ?> value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                    <?php
                                    } ?>
                    <label class="focus-label">Choose Branch</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                         <input class="form-control floating datetimepicker" type="text" name="from" required="" value="<?= (isset($_GET['from']))?$_GET['from']:'' ?>" />
                    </div>
                    <label class="focus-label">From</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus">
                    <div class="cal-icon">
                       <input class="form-control floating datetimepicker" type="text" name="to" required="" value="<?= (isset($_GET['to']))?$_GET['to']:'' ?>"/>
                    </div>
                    <label class="focus-label">To</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
        </div>
        </form>
		<div class="card">
			 <div class="review-header balan-hd">
                <div class="row">
                    <div class="col-md-12">
                        <div class="excel-hd-main">
                            <img width="190" src="<?= ($organisation_settings->oraganisation_logo)?$organisation_settings->oraganisation_logo:'assets/img/logo2.png' ?>" >                    
                            <h3 class="review-title"><?= $organisation_settings->oraganisation_name ?></h3>
                            <p><?= $organisation_settings->oraganisation_address ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="excel-header-lft">
                             <?php if(isset($branchData)){
                    ?>
                            <p><b>Branch:</b> <?= $branchData->branch_name ?></p>
                             <?php
                }  ?>
                            <p><b>GSTIN:</b> <?= $organisation_settings->oraganisation_gst ?></p>
                            <p><b>Contact:</b>  <?= $organisation_settings->oraganisation_phone ?></p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="excel-header-lft header-rt">
                            <p><b>Email:</b> <?= $organisation_settings->oraganisation_email ?></p>
                            <p><b>Website:</b> <?= $organisation_settings->oraganisation_url ?></p>
                            <?php  if(isset($_GET['from']) && isset($_GET['to'])){
                    ?>
                            <p><b>Balance Sheet:</b> <span><?= $_GET['from'] ?></span> To <span><?= $_GET['to'] ?></span></p>
                             <?php
                }
                ?>
                        </div>
                    </div>
                </div>
            </div>
			<!-- <div class="review-header balan-hd text-center">
                <h3 class="review-title">Vishvas Groups</h3>
                <?php if(isset($branchData)){
                    ?>
                <p class="text-muted">Branch: <?= $branchData->branch_name ?></p>
                    <?php
                }  
                if(isset($_GET['from']) && isset($_GET['to'])){
                    ?>

                <p class="text-muted">Trial Balance From<span> <?= $_GET['from'] ?></span> To <span><?= $_GET['to'] ?></span></p>
                    <?php
                }
                ?>
            </div> -->
			<div class="card-body prft-table">	
				<div class="row">
					<div class="col-md-6">
						<div class="balnce-dtl">
							<div class="card bdy-pd">
								<div class="card-body">
									<div class="balance-expns">
										<h4 class="bal-hd">Expense</h4>
										<div class="expense-card">
											 <?php 
                                                $expenseOut=0;
                                                
                                                foreach ($datamoneyout as $key) {
                                                    $expenseOut+=$key->myamount;
                                                    if (isset($_GET['from'])) {
                $fdate =date('Y-m-d',strtotime($_GET['from']));
                $tdate =date('Y-m-d',strtotime($_GET['to']));   
            $subheaddata=$this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,SUM(amount) as mysubamount')->
            join('tbl_heads h', 'h.heads_id = j.sub_head_id')
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('h.status',2)
            ->where('j.moneyInOut',2)
            ->where('j.head_id',$key->heads_id)->
            where('j.del_status',0)->
            where('h.del_status',0)
            ->group_by('j.sub_head_id')
            ->get('tbl_journal j')
            ->result();
        }else{
        	 $subheaddata=$this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,SUM(amount) as mysubamount')->
            join('tbl_heads h', 'h.heads_id = j.sub_head_id')
            ->where('h.status',2)
            ->where('j.moneyInOut',2)
            ->where('j.head_id',$key->heads_id)->
             where('j.del_status',0)->
            where('h.del_status',0)
            ->group_by('j.sub_head_id')
            ->get('tbl_journal j')
            ->result();
        }
           ?>
											<h4 class="expense-hd"><?= $key->heads_name ?> <span class="cost"><?= $key->myamount ?></span></h4>
											<ul class="expense-list-charge">
												<?php 
												
												foreach ($subheaddata as $key1) {
													
													?>
													<li>
														<a href="profitlossdetail.html/<?= $key1->heads_id ?>/2"><?= $key1->heads_name ?> <span><?= $key1->mysubamount ?></span></a>
													</li>

													<?php
												} ?>
												
											</ul>		
<?php
                                                } ?>
										</div>
										<!-- <div class="expense-card">
											<h4 class="expense-hd">Electronic Items Purchase <span class="cost">1200</span></h4>
											<ul class="expense-list-charge">
												<li>
													<a href="#">Computer Assessories <span>1200</span></a>
												</li>
											</ul>		
										</div>
										<div class="expense-card-ftr">
											<h4 class="expense-hd">Net Profit <span class="cost">1200</span></h4>
											<h4 class="bal-ttl">Total: 16200</h4>
										</div> -->
										<div class="expense-card-ftr">

												<h4 class="expense-hd">Net Profit 
													<span class="cost">
											<?php if(CheckNumber($incomeIn1-$expenseOut) == 'profit'){
												?>
													<?= $incomeIn1-$expenseOut ?>
												<?php
											}else if(CheckNumber($incomeIn1-$expenseOut) == 'Zero'){
												echo '0';
											} ?>
													</span>
												</h4>
												
											
											<h4 class="bal-ttl">Total: <?= $expenseOut ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="balnce-dtl">
							<div class="card bdy-pd">
								<div class="card-body">
									<div class="balance-expns">
										<h4 class="bal-hd">Income</h4>
                                        <div class="expense-card">
										<?php 
                                            $incomeIn=0;
                                            foreach ($datamoneyin as $key) {
                                                $incomeIn+=$key->myamount;
             if (isset($_GET['from'])) {
                $fdate = date('Y-m-d',strtotime($_GET['from']));
                $tdate = date('Y-m-d',strtotime($_GET['to']));                                 
            	$subheaddata=$this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,SUM(amount) as mysubamount')->
            join('tbl_heads h', 'h.heads_id = j.sub_head_id')
            ->where('j.branch_id',$_GET['branch'])
            ->where('j.date >=',$fdate)
            ->where('j.date <=',$tdate)
            ->where('h.status',2)
            ->where('j.moneyInOut',1)
            ->where('j.head_id',$key->heads_id)->
             where('j.del_status',0)->
            where('h.del_status',0)
            ->group_by('j.sub_head_id')
            ->get('tbl_journal j')
            ->result();
        }else{
        	$subheaddata=$this->db->select('h.heads_id as heads_id,h.status as headstatus,h.heads_name as heads_name,SUM(amount) as mysubamount')->
            join('tbl_heads h', 'h.heads_id = j.sub_head_id')
            ->where('h.status',2)
            ->where('j.moneyInOut',1)
            ->where('j.head_id',$key->heads_id)->
             where('j.del_status',0)->
            where('h.del_status',0)
            ->group_by('j.sub_head_id')
            ->get('tbl_journal j')
            ->result();
        }
                                               ?>
										
											<h4 class="expense-hd"><?= $key->heads_name ?><span class="cost"><?= $key->myamount ?></span></h4>
											<ul class="expense-list-charge">
												<?php 
												
												foreach ($subheaddata as $key1) {
													
													?>
													<li>
														<a href="profitlossdetail.html/<?= $key1->heads_id ?>/1"><?= $key1->heads_name ?> <span><?= $key1->mysubamount ?></span></a>
													</li>

													<?php
												} ?>
											</ul>		
									<?php } ?>
										</div>
										<!-- <div class="expense-card">
											<h4 class="expense-hd">Income<span class="cost">12000</span></h4>
											<ul class="expense-list-charge">
												<li>
													<a href="#">Fees <span>8000</span></a>
												</li>
												<li>
													<a href="#">Fees <span>4000</span></a>
												</li>
											</ul>		
										</div> -->
										<div class="expense-card-ftr">

												<h4 class="expense-hd">Net Loss <span class="cost">
											<?php if(CheckNumber($incomeIn-$expenseOut) == 'loss'){
												?>

                                                    <?= $incomeIn-$expenseOut ?>
                                                        
											<?php
											}elseif(CheckNumber($incomeIn1-$expenseOut) == 'Zero'){
												echo '0';
											}
												?> 
                                                    </span></h4>
												
												
											
											

											
											<h4 class="bal-ttl">Total: <?= $incomeIn ?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>

		
  
	
	
</div>


</div>
