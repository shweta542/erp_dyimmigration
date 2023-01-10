
<?php $arr = explode('|',$privileges_settings->salary) ?>

  <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employee Salary</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Salary</li>
                    </ul>
                </div>
<?php  if(in_array('1', $arr)){
    ?>

                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Salary</a>
                </div>
    <?php
} ?>

            </div>
        </div>
        <?php if (in_array('2', $arr,true) || in_array('3', $arr,true) ||  in_array('4', $arr,true)) {
                               ?>
        <form action="employeePayroll.html" method="get">
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
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Employee</th>
                                <th>Salary Generate Date</th>
                                <th>Branch</th>
                                <th>Department</th>
                                <th>Basic Salary</th>
                                <th>Deduction</th>
                                <th>Bonus</th>
                                <th>Net Salary</th>
                                <th>Payslip</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach ($alluserData as $key) {
                                $department=$this->db->where('department_id',$key->department_id)->get('tbl_department')->row();
                                $designation=$this->db->where('designation_id',$key->designation_id)->get('tbl_designation')->row();
                                $bonus=$this->db->select('SUM(bonucs) as bonucstotal')->where('payroll_id',$key->payroll_id)->get('tbl_payroll_meta')->row();
                                $deduction=$this->db->select('SUM(deduction) as deductiontotal')->where('payroll_id',$key->payroll_id)->get('tbl_payroll_meta')->row();
                                ?>

                            <tr>
                                <td><?= $key->payroll_id ?></td>
                                <td>
                                    <a href="profile.html/<?= $key->USER_ID ?>"><div class="avatar"><img alt="" src="<?= ($key->user_image)?$key->user_image:'assets/img/user.jpg' ?>" /></div>
                                        <h2 class="table-avatar"><?= $key->USER_NAME ?> <?= $key->user_last_name ?> <span><?= $designation->designation_name ?> </span>
                                        </h2>
                                    </a>
                                </td>
                                <td><?= get_datetime1($key->lastmodify_payroll) ?></td>
                                <td>
                                    Ambala
                                </td>
                                <td>
                                    <?= $department->department_name ?>
                                </td>
                                <td><?= $key->salary ?></td>
                                <td><?= $deduction->deductiontotal  ?></td>
                                <td><?= $bonus->bonucstotal ?></td>
                                <td><?= $key->net_salary + $bonus->bonucstotal - $deduction->deductiontotal ?></td>
                                <td><a class="btn btn-sm btn-primary" href="salarySlip.html/<?= $key->payroll_id ?>">View Slip</a></td>
                                <?php  if(in_array('3', $arr) ||  in_array('4', $arr)){
    ?>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                             <?php  if(in_array('3', $arr)){
    ?>
                                            <a class="dropdown-item" href="employeePayrolledit.html/<?= $key->payroll_id ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
<?php
                            } ?>
                             <?php  if(in_array('4', $arr)){
    ?>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_salary<?= $key->payroll_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                             <?php
                            } ?>
                                        </div>
                                    </div>
                                </td>

                                <?php
                            } ?>
                            </tr>
                            <div class="modal custom-modal fade" id="delete_salary<?= $key->payroll_id ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Salary</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" onclick='deleteCommon("tbl_payroll","payroll_id",<?= $key->payroll_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
                            </div>
                            <div class="col-6">
                                <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
       <?php
} ?> 
    </div>

    <div id="add_salary" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Staff Salary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="calSalary">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Month</label>
                                    <select class="select floating" name="month" id="month" required="" >
                        <option value="">Select Month</option>
                        <option value="01">Jan</option>
                        <option value="02">Feb</option>
                        <option value="03">Mar</option>
                        <option value="04">Apr</option>
                        <option value="05">May</option>
                        <option value="06">Jun</option>
                        <option value="07">Jul</option>
                        <option value="08">Aug</option>
                        <option value="09">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>
                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Year</label>
                                   <select class="select floating" name="year" id="year" required="" >
                        <option value="">Select Year</option>
                         <?php 
   for($i = 2021 ; $i <= date('Y'); $i++){
    ?>
                        <option <?= ($i == date('Y'))?'selected':'' ?> value="<?= $i  ?>"><?= $i; ?></option>
                        
                    <?php } ?>
                       <!-- <option value="2021">2021</option>-->
                        
                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee</label>
                                    <select class="select" name="user_id" required="" id="employeesalary" onchange="GetStaffNameValue()">
                                        <option value="">Select Emloyee</option>
                                        <?php foreach ($userData as $key) {
                                           ?>
                                           <option value="<?= $key->USER_ID ?>" data-salary="<?= $key->employee_salary ?>"><?= $key->USER_NAME  ?> <?= $key->user_last_name  ?></option>
                                           <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Basic Salary</label>
                                <input class="form-control" type="text" value="" name="salary" id="salary" readonly="" required="" />
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Deduct Salary</label>
                                <input class="form-control" type="text" value="" name="deductsalary" id="deductsalary" readonly="" required="" />
                            </div>
                            <div class="col-sm-6">
                                <label>Net Salary</label>
                                <input class="form-control" type="text" value="" name="netsalary" id="netsalary" readonly="" required="" />
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="text-primary mt-2">Bonus</h4>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="text-primary mt-2">Deductions</h4>
                            </div>
                        </div>
                                
                        <div id="boxes">
                          <div class="active">
                                <div class="row">
                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Add Bonus</label>
                                                <input class="form-control" type="number" name="bonucs[]" value="" />
                                            </div>
                                            <div class="form-group">
                                                <label>Reason</label>
                                                <input class="form-control" type="text" name="bonucsremark[]" value="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label> Deduction</label>
                                                <input class="form-control" type="number" name="deduction[]" value="" />
                                            </div>
                                            <div class="form-group">
                                                <label>Reason</label>
                                                <input class="form-control" type="text" name="deductionremark[]" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a id="addbutton" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>
                        
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="edit_salary" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Staff Salary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="calSalary">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Branch</label>
                                    <select class="select">
                                        <option>John Doe</option>
                                        <option>Richard Miles</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="select">
                                        <option>John Doe</option>
                                        <option>Richard Miles</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee</label>
                                    <select class="select">
                                        <option>John Doe</option>
                                        <option>Richard Miles</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Net Salary</label>
                                <input class="form-control" type="text" value="" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="text-primary">Bonus</h4>
                            </div>
                            <div class="col-sm-6">
                                <h4 class="text-primary">Deductions</h4>
                            </div>
                        </div>
                        <div id="boxes1">
                          <div class="active">
                                <div class="row">
                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Add Bonus</label>
                                                <input class="form-control" type="text" value="0" />
                                            </div>
                                            <div class="form-group">
                                                <label>Reason</label>
                                                <input class="form-control" type="text" value="abcd" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Add Bonucs</label>
                                                <input class="form-control" type="text" value="0" />
                                            </div>
                                            <div class="form-group">
                                                <label>Reason</label>
                                                <input class="form-control" type="text" value="abcd" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-more">
                                <a id="addbutton1" href="#"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>

                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <div id="myboxes" style="display: none">
                          <div class="active">
                                <div class="row">
                                    <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Add Bonus</label>
                                                <input class="form-control" type="number" name="bonucs[]" value="" />
                                            </div>
                                            <div class="form-group">
                                                <label>Reason</label>
                                                <input class="form-control" type="text" name="bonucsremark[]" value="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label> Deduction</label>
                                            <input class="form-control" type="number" name="deduction[]" value="" />
                                            </div>
                                            <div class="form-group">
                                                <label>Reason</label>
                                                <input class="form-control" type="text" name="deductionremark[]" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
</div>

