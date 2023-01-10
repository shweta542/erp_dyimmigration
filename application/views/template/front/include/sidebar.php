
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">

            <ul>
            	<li class="<?php if(isset($sidepage) && $sidepage == 'dashboard'){ echo 'active';} ?>">
					<a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>" class=""><i class="la la-dashboard"></i> <span> Dashboard </a>
					<!-- <ul style="display: none;">
						<li><a href="index.php"> Employee Dashboard</a></li>
						<li><a href="admin_dashboard.php"> Admin Dasboard</a></li>
					</ul> -->
				</li>
            	<?php if($privileges_settings->organizationSetting != 0){
            	?>
				<li class="<?php if(isset($sidepage) && $sidepage == 'organizationSettings'){ echo 'active';} ?>">
					<a class="" href="organizationSettings.html"><i class="la la-building"></i> <span>Organization Settings</span></a>
				</li>
            	<?php
            } 
if($privileges_settings->branch != 0  || $privileges_settings->department != 0 || $privileges_settings->designation != 0){
            ?>

				<li class="submenu">
					<a href="javascript:void(0)" class=""><i class="la la-cube"></i> <span> Branch Settings </span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<?php if($privileges_settings->branch != 0){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'brancheslist'){ echo 'active';} ?>" href="brancheslist.html"> View Branches</a></li>
							<?php
            } ?>
            <?php if($privileges_settings->department != 0){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'department'){ echo 'active';} ?>" href="department.html"> Department</a></li>
						<?php
            } ?>
             <?php if($privileges_settings->designation != 0){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'designation'){ echo 'active';} ?>" href="designation.html"> Designation</a></li>
						<?php
            } ?>
					</ul>
				</li>
				<?php } ?>
               <li class="submenu">
					<a href="javascript:void(0)" class=""><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
			<?php if($privileges_settings->employees != 0){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'employeelist'){ echo 'active';} ?>" href="employeelist.html"> Employees</a></li>
						<?php
            } ?>
            <?php if($logged_in_user->STATUS == 0){
            	?>

						<li><a class="<?php if(isset($sidepage) && $sidepage == 'addleave'){ echo 'active';} ?>" href="addleave.html">Leaves</a></li>
            	<?php
            } ?>
            <?php if($privileges_settings->leaves != 0){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'adminleave'){ echo 'active';} ?>" href="adminleave.html">Leave Admin</a></li>
						<?php
            } ?>
						 <?php if( $logged_in_user->STATUS == 0 ){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'attendanceEmployee'){ echo 'active';} ?>" href="attendanceEmployee.html">Attendance</a></li>
						<?php
            } ?>
             <?php if($privileges_settings->attendence != 0){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'attendanceAdmin'){ echo 'active';} ?>" href="attendanceAdmin.html">Attendance Admin</a></li>
						<?php
            } ?>
            <?php if($privileges_settings->holiday != 0){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'holidays'){ echo 'active';} ?>" href="holidays.html"> Holidays</a></li>	
						<?php
            } ?>	
					</ul>
				</li>
				<li class="submenu">
					<a href="javascript:void(0)" class=""><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
						<?php if($privileges_settings->salary != 0){
            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'employeePayroll'){ echo 'active';} ?>" href="employeePayroll.html"> Employee Salary </a></li>
						<?php
            } ?>	
						 <?php if($logged_in_user->STATUS == 0){
            	?>
            	<li><a class="<?php if(isset($sidepage) && $sidepage == 'employeePayrolluser'){ echo 'active';} ?>" href="employeePayrolluser.html"> Payslip </a></li>
						<!-- <li><a class="<?php if(isset($sidepage) && $sidepage == 'currentmonthsalarySlip'){ echo 'active';} ?>" href="currentmonthsalarySlip.html/<?= $logged_in_user->USER_ID ?>"> Payslip </a></li> -->
						<?php
            } ?>
					</ul>
				</li>
				<?php
				if($privileges_settings->banking != 0  || $privileges_settings->heads != 0 || $privileges_settings->subHeads != 0 || $privileges_settings->vendorCustomer != 0 || $privileges_settings->journal != 0 || $privileges_settings->ledger != 0 || $privileges_settings->balanceSheet != 0 || $privileges_settings->trialBalance != 0 || $privileges_settings->ProfitLoss != 0){
            ?>
				<li class="submenu">
					<a href="javascript:void(0)" class=""><i class="la la-files-o"></i> <span> Account</span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
					<?php if($privileges_settings->banking != 0){
					            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'accountBank'){ echo 'active';} ?>" href="accountBank.html"> Banking </a></li>
					<?php } ?>
					<?php if($privileges_settings->journal != 0){
            			?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'cash'){ echo 'active';} ?>" href="cash.html"> Cash </a></li>
						<?php } ?>
					<?php if($privileges_settings->heads != 0){
					            	?>
            	<li><a class="<?php if(isset($sidepage) && $sidepage == 'accountGroup'){ echo 'active';} ?>" href="accountGroup.html"> Group</a></li>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'accountHead'){ echo 'active';} ?>" href="accountHead.html"> Ledger</a></li>
				<?php } ?>
				<?php if($privileges_settings->subHeads != 0){
				            	?>
						<li style="display:none"><a class="<?php if(isset($sidepage) && $sidepage == 'accountSubhead'){ echo 'active';} ?>" href="accountSubhead.html"> Sub Heads </a></li>
					<?php } ?>
					<?php if($privileges_settings->vendorCustomer != 0){
					            	?>
						<li style="display:none"><a class="<?php if(isset($sidepage) && $sidepage == 'vendorCustomer'){ echo 'active';} ?>" href="vendorCustomer.html"> Buyers and Suppliers </a></li>
					<?php } ?>
					<?php if($privileges_settings->journal != 0){
					            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'journalEntries'){ echo 'active';} ?>" href="journalEntries.html">  Vouchar Entries</a></li>
					<?php } ?>
					<?php if($privileges_settings->ledger != 0){
					            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'ledger'){ echo 'active';} ?>" href="ledger.html"> Daybook</a></li>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'ledgerdetail'){ echo 'active';} ?>" href="ledgerdetail.html"> Ledger-Detail</a></li>
					<?php } ?>
					<?php if($privileges_settings->trialBalance != 0){
					            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'trialbalance'){ echo 'active';} ?> " href="trialbalance.html"> Trial Balance</a></li>
					<?php } ?>
					<?php if($privileges_settings->ProfitLoss != 0){
					            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'profitloss'){ echo 'active';} ?>" href="profitloss.html"> Profit/Loss</a></li>
						<?php } ?>
					<?php if($privileges_settings->balanceSheet != 0){
					            	?>
						<li><a class="<?php if(isset($sidepage) && $sidepage == 'balancesheet'){ echo 'active';} ?>" href="balancesheet.html"> Balance Sheets</a></li>
					<?php } ?>

						


					</ul>
				</li>
			<?php } ?>
			<?php
				if( $privileges_settings->reception != 0 || $privileges_settings->telecaller != 0 || $privileges_settings->counselor != 0 || $privileges_settings->admission != 0 || $privileges_settings->coordinator != 0){
            ?>
			<li class="submenu">
					<a href="javascript:void(0)" class=""><i class="la la-user-plus"></i> <span>CRM</span> <span class="menu-arrow"></span></a>
					<ul style="display: none;">
					    	<?php if($privileges_settings->organizationSetting != 0){
            	?>
						<li>
							<a href="javascript:void(0)" class=""><span>CRM Setting</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="<?php if(isset($sidepage) && $sidepage == 'tages'){ echo 'active';} ?>" href="tages.html"> Tags</a>
								</li>
								<li><a class="<?php if(isset($sidepage) && $sidepage == 'class'){ echo 'active';} ?>" href="class.html"> Class</a>
								</li>
								<li><a class="<?php if(isset($sidepage) && $sidepage == 'boardanduniversity'){ echo 'active';} ?>" href="boardanduniversity.html"> Board & University</a>
								</li>
								<li><a class="<?php if(isset($sidepage) && $sidepage == 'stream'){ echo 'active';} ?>" href="stream.html"> Stream</a>
								</li>
							</ul>
						</li>
						<?php } ?>
						<?php if($privileges_settings->reception != 0){
            	?>
						<li>
							<a href="javacript:void(0);" class=""><span>Reception</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
							<!--	<li><a class="<?php if(isset($sidepage) && $sidepage == 'receptionDashboard'){ echo 'active';} ?>" href="receptionDashboard.html"> Dashboard</a>
								</li>-->
								<li><a class="<?php if(isset($sidepage) && $sidepage == 'calldetail'){ echo 'active';} ?>" href="calldetail.html"> Reception </a>
								</li>
							</ul>
						</li>
						<?php } ?>

						<?php if($privileges_settings->telecaller != 0){
            	?>
						<li>
							<a href="javacript:void(0);" class=""><span>Telecaller</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
							<!--	<li><a class="<?php if(isset($sidepage) && $sidepage == 'telecallerDashboard'){ echo 'active';} ?>" href="telecallerDashboard.html"> Dashboard</a>
								</li>-->
								<li><a class="<?php if(isset($sidepage) && $sidepage == 'calldetail1'){ echo 'active';} ?>" href="calldetail1.html"> Telecaller </a>
								</li>
							</ul>
						</li>
						<?php } ?>

						<?php if($privileges_settings->counselor != 0){
            	?>
						<li>
							<a href="javacript:void(0);" class=""><span>Counselor</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<!--<li><a class="<?php if(isset($sidepage) && $sidepage == 'counselorDashboard'){ echo 'active';} ?>" href="counselorDashboard.html"> Dashboard</a>
								</li>-->
								<li><a class="<?php if(isset($sidepage) && $sidepage == 'counselor'){ echo 'active';} ?>" href="counselor.html"> Counselor </a>
								</li>
							</ul>
						</li>
						<?php } ?>
						<?php if($privileges_settings->coordinator != 0){
            	?>
						<li>
							<a href="javacript:void(0);" class=""><span>Coordinator</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
							
								<li><a class="" href="coordinator.html"> Coordinator </a>
								</li>
							</ul>
						</li>
							<?php } ?>
						<?php if($privileges_settings->admission != 0){
            	?>
						<li>
							<a href="javacript:void(0);" class=""><span>Admission</span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
							<!--	<li><a class="<?php if(isset($sidepage) && $sidepage == 'admissionDashboard'){ echo 'active';} ?>" href="admissionDashboard.html"> Dashboard</a>
								</li>-->
								<li><a class="<?php if(isset($sidepage) && $sidepage == 'admission'){ echo 'active';} ?>" href="admission.html"> Admission </a>
								</li>
							</ul>
						</li>
						<?php } ?>
						
					</ul>
				</li>
				<?php } ?>
            </ul>
        </div>
    </div>
</div>
