


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


            </div>
        </div>
       
        <form action="employeePayrolluser.html" method="get">
         <div class="row filter-row">
            
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
                                <!-- <th class="text-right">Action</th> -->
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
                                <td><?= get_datetime($key->lastmodify_payroll) ?></td>
                                <td>
                                    Ambala
                                </td>
                                <td>
                                    <?= $department->department_name ?>
                                </td>
                                <td><?= $key->salary ?></td>
                                <td><?= $bonus->bonucstotal ?></td>
                                <td><?= $deduction->deductiontotal  ?></td>
                                <td><?= $key->net_salary + $bonus->bonucstotal - $deduction->deductiontotal ?></td>
                                <td><a class="btn btn-sm btn-primary" href="salarySlip.html/<?= $key->payroll_id ?>">View Slip</a></td>
                                
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
      
    </div>

   

  

    
</div>

