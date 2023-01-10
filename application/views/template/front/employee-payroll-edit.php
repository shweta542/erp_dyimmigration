
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

            </div>
        </div>
        
        <form id="payrolledit" >
            <input type="hidden" name="payroll_id" value="<?= $id ?>">
        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Month</label>
                                    <select class="select floating" name="month" id="month" required="" >
                        <option value="">Select Month</option>
                        <option <?= ($data->month=='01')?'selected':'' ?> value="01">Jan</option>
                        <option <?= ($data->month=='02')?'selected':'' ?> value="02">Feb</option>
                        <option <?= ($data->month=='03')?'selected':'' ?> value="03">Mar</option>
                        <option <?= ($data->month=='04')?'selected':'' ?> value="04">Apr</option>
                        <option <?= ($data->month=='05')?'selected':'' ?> value="05">May</option>
                        <option <?= ($data->month=='06')?'selected':'' ?> value="06">Jun</option>
                        <option <?= ($data->month=='07')?'selected':'' ?> value="07">Jul</option>
                        <option <?= ($data->month=='08')?'selected':'' ?> value="08">Aug</option>
                        <option <?= ($data->month=='09')?'selected':'' ?> value="09">Sep</option>
                        <option <?= ($data->month=='10')?'selected':'' ?> value="10">Oct</option>
                        <option <?= ($data->month=='11')?'selected':'' ?> value="11">Nov</option>
                        <option <?= ($data->month=='12')?'selected':'' ?> value="12">Dec</option>
                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Year</label>
                                   <select class="select floating" name="year" id="year" required="" >
                        <option value="">Select Year</option>
                        <option <?= ($data->year=='2021')?'selected':'' ?> value="2021">2021</option>
                        
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
                                           <option <?= ($data->user_id == $key->USER_ID)?'selected':'' ?>  value="<?= $key->USER_ID ?>" data-salary="<?= $key->employee_salary ?>"><?= $key->USER_NAME  ?> <?= $key->user_last_name  ?></option>
                                           <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Basic Salary</label>
                                <input class="form-control" type="text" value="<?= $data->salary ?>" name="salary" id="salary" readonly="" required="" />
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Deduct Salary</label>
                                <input class="form-control" type="text" value="<?= $data->deduct_salary ?>" name="deductsalary" id="deductsalary" readonly="" required="" />
                            </div>
                            <div class="col-sm-6">
                                <label>Net Salary</label>
                                <input class="form-control" type="text" value="<?= $data->net_salary ?>" name="netsalary" id="netsalary" readonly="" required="" />
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
                                
                        <div id="boxes">
                            <?php foreach ($this->db->where('payroll_id',$id)->get('tbl_payroll_meta')->result() as $key1) {
                                ?>
                          <div class="active">
                                    <div class="row">
                                        <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Add Bonus</label>
                                                    <input class="form-control" type="number" name="bonucs[]" value="<?= $key1->bonucs ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Reason</label>
                                                    <input class="form-control" type="text" name="bonucsremark[]" value="<?= $key1->bonucsremark ?>" />
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label> Deduction</label>
                                                    <input class="form-control" type="number" name="deduction[]" value="<?= $key1->deduction ?>" />
                                                </div>
                                                <div class="form-group">
                                                    <label>Reason</label>
                                                    <input class="form-control" type="text" name="deductionremark[]" value="<?= $key1->deductionremark ?>" />
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                <?php
                                 } ?>
                            </div>
                            <div class="add-more">
                                <a id="addbutton" href="javascript:void(0)"><i class="fa fa-plus-circle"></i> Add More</a>
                            </div>
                        
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
        </form>

        
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

