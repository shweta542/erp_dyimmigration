<?php
$arr5=explode('|',$previllage->organizationSetting);
$arr1=explode('|',$previllage->branch);
$arr2=explode('|',$previllage->department);
$arr3=explode('|',$previllage->designation);
$arr4=explode('|',$previllage->employees);
$arr5=explode('|',$previllage->leaves);
$arr6=explode('|',$previllage->attendence);
$arr7=explode('|',$previllage->salary);
$arr8=explode('|',$previllage->holiday);
$arr9=explode('|',$previllage->banking);
$arr10=explode('|',$previllage->heads);
$arr11=explode('|',$previllage->subHeads);
$arr12=explode('|',$previllage->vendorCustomer);
$arr13=explode('|',$previllage->journal);
$arr14=explode('|',$previllage->ledger);
$arr15=explode('|',$previllage->balanceSheet);
$arr16=explode('|',$previllage->trialBalance);
$arr17=explode('|',$previllage->ProfitLoss);
$arr18=explode('|',$previllage->reception);
$arr19=explode('|',$previllage->telecaller);
$arr20=explode('|',$previllage->counselor);
$arr21=explode('|',$previllage->admission);
$arr22=explode('|',$previllage->coordinator);
//print_r($data);
?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Employee</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Employee</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">

            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <form id="editUser">
                        <input type="hidden" name="USER_ID" value="<?= $data->USER_ID ?>">
                         <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                    <input class="form-control" value="<?= $data->USER_NAME ?>" name="USER_NAME" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Last Name</label>
                                    <input class="form-control" value="<?= $data->user_last_name ?>" name="user_last_name" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                    <input class="form-control" value="<?= $data->username ?>" name="username" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" value="<?= $data->USER_EMAIL ?>" name="USER_EMAIL" type="email" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" name="password" type="password" id="myInput" value="<?= $data->PASSWORD ?>"/>
                                    <input type="checkbox" onclick="showpassword()">Show Password 
                                </div>
                            </div>
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" value="johndoe" type="password" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Confirm Password</label>
                                    <input class="form-control" value="johndoe" type="password" />
                                </div>
                            </div> -->
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" value="<?= $data->employee_id ?>" name="employee_id" readonly class="form-control floating" />
                                </div>
                            </div> -->
                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee Salary <span class="text-danger">*</span></label>
                                    <input type="number" value="<?= $data->employee_salary ?>" class="form-control" name="employee_salary" required="true" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" value="<?= $data->Joining_date ?>" name="Joining_date" type="text" /></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Phone </label>
                                    <input class="form-control" value="<?= $data->USER_PHONE ?>"  maxlength="10"  name="USER_PHONE" type="text" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Branch <span class="text-danger">*</span></label>
                                   <select class="select" name="branch_id[]" required="true" multiple>
                                        <option value="" disabled="">Select Branch</option>
                                        <?php 
                                        $arr=explode('|',$data->branch_id);
                                        foreach ($branch as $key ) {
                                            ?>
                                            <option value="<?= $key->branch_id ?>" <?php if(in_array($key->branch_id, $arr,true)){echo  'selected';} ?> ><?= $key->branch_name ?></option>
                                        <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department <span class="text-danger">*</span></label>
                                   <select class="select" name="department_id" required="true" id="department">
                                        <option value="" disabled="">Select Department</option>
                                        <?php 

                                        foreach ($department as $key ) {
                                            ?>
                                            <option value="<?= $key->department_id ?>" <?php if($key->department_id== $data->department_id){echo 'selected';} ?>><?= $key->department_name ?></option>
                                                <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Designation <span class="text-danger">*</span></label>
                                    <select class="select" name="designation_id" required="true" id="designation">
                                        <option value="" disabled="">Select Designation</option>
                                       <?php if($data->department_id !=""){
                                        foreach ($this->db->where('department_id',$data->department_id)->get('tbl_designation')->result() as $key) {
                                        ?>
                                        <option value="<?= $key->designation_id ?>" <?php if($key->designation_id == $data->designation_id){echo "selected";}?>><?= $key->designation_name ?></option>
                                        <?php
                                    }
                                    } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive m-t-15">
                           <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>Module Permission</th>
                                        <th class="text-center">Create</th>
                                        <th class="text-center">View</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Organization Settings</td>
                                        <td class="text-center">
                                           <input type="checkbox" disabled="disabled"> 
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php if(in_array('3', $arr5,true)){echo 'checked=""';} ?> name="organizationSetting[]" value="3" />
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox" disabled="disabled">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Branches</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="branch[]" <?php  if(in_array('1', $arr1)){echo 'checked=""';} ?> value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="branch[]" <?php  if(in_array('2', $arr1)){echo 'checked=""';} ?> value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="branch[]" <?php  if(in_array('3', $arr1)){echo 'checked=""';} ?> value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="branch[]" <?php  if(in_array('4', $arr1)){echo 'checked=""';} ?> value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Department</td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr2)){echo 'checked=""';} ?> name="department[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr2)){echo 'checked=""';} ?> name="department[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr2)){echo 'checked=""';} ?> name="department[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('4', $arr2)){echo 'checked=""';} ?> name="department[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Designations</td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr3)){echo 'checked=""';} ?> name="designation[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr3)){echo 'checked=""';} ?> name="designation[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr3)){echo 'checked=""';} ?> name="designation[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('4', $arr3)){echo 'checked=""';} ?> name="designation[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Employees</td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr4)){echo 'checked=""';} ?> name="employees[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr4)){echo 'checked=""';} ?> name="employees[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr4)){echo 'checked=""';} ?> name="employees[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('4', $arr4)){echo 'checked=""';} ?> name="employees[]" value="4"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>Leave</td>
                                        <td class="text-center">
                                           <input type="checkbox" disabled="disabled"> 
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr5)){echo 'checked=""';} ?> name="leave[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr5)){echo 'checked=""';} ?> name="leave[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox" disabled="disabled"> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attendence</td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr6)){echo 'checked=""';} ?> name="attendence[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr6)){echo 'checked=""';} ?> name="attendence[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Employee Salary</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr7)){echo 'checked=""';} ?> name="salary[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr7)){echo 'checked=""';} ?> name="salary[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr7)){echo 'checked=""';} ?> name="salary[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('4', $arr7)){echo 'checked=""';} ?> name="salary[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Holiday</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr8)){echo 'checked=""';} ?> name="holiday[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr8)){echo 'checked=""';} ?> name="holiday[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr8)){echo 'checked=""';} ?> name="holiday[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('4', $arr8)){echo 'checked=""';} ?> name="holiday[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Banking</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr9)){echo 'checked=""';} ?> name="banking[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr9)){echo 'checked=""';} ?> name="banking[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr9)){echo 'checked=""';} ?> name="banking[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                            <!-- <input type="checkbox" <?php  if(in_array('4', $arr9)){echo 'checked=""';} ?> name="banking[]" value="4"/> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Heads</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr10)){echo 'checked=""';} ?> name="heads[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr10)){echo 'checked=""';} ?> name="heads[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr10)){echo 'checked=""';} ?> name="heads[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                            <!-- <input type="checkbox" <?php  if(in_array('4', $arr10)){echo 'checked=""';} ?> name="heads[]" value="4"/> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sub-Heads</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr11)){echo 'checked=""';} ?> name="subHeads[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr11)){echo 'checked=""';} ?> name="subHeads[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr11)){echo 'checked=""';} ?> name="subHeads[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                            <!-- <input type="checkbox" <?php  if(in_array('4', $arr11)){echo 'checked=""';} ?> name="subHeads[]" value="4"/> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Buyer and Supplier</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr12)){echo 'checked=""';} ?> name="vendorCustomer[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr12)){echo 'checked=""';} ?> name="vendorCustomer[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr12)){echo 'checked=""';} ?> name="vendorCustomer[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                            <!-- <input type="checkbox" <?php  if(in_array('4', $arr12)){echo 'checked=""';} ?> name="vendorCustomer[]" value="4"/> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vouchar Entries</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr13)){echo 'checked=""';} ?> name="journal[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr13)){echo 'checked=""';} ?> name="journal[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr13)){echo 'checked=""';} ?> name="journal[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                            <!-- <input type="checkbox" <?php  if(in_array('4', $arr13)){echo 'checked=""';} ?> name="journal[]" value="4"/> -->
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daybook</td>
                                       <td class="text-center">
                                            <input type="checkbox" disabled="disabled">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr14)){echo 'checked=""';} ?> name="ledger[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox" disabled="disabled">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled">
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Trial Balance</td>
                                       <td class="text-center">
                                            <input type="checkbox" disabled="disabled">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr16)){echo 'checked=""';} ?> name="trialBalance[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr16)){echo 'checked=""';} ?> name="trialBalance[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('4', $arr16)){echo 'checked=""';} ?> name="trialBalance[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Profit/Loss</td>
                                       <td class="text-center">
                                            <input type="checkbox" disabled="disabled">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr17)){echo 'checked=""';} ?> name="ProfitLoss[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr17)){echo 'checked=""';} ?> name="ProfitLoss[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('4', $arr17)){echo 'checked=""';} ?> name="ProfitLoss[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Balance Sheets</td>
                                       <td class="text-center">
                                            <input type="checkbox" disabled="disabled">
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr15)){echo 'checked=""';} ?> name="balanceSheet[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr15)){echo 'checked=""';} ?> name="balanceSheet[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('4', $arr15)){echo 'checked=""';} ?> name="balanceSheet[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reception</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr18)){echo 'checked=""';} ?> name="reception[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr18)){echo 'checked=""';} ?> name="reception[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr18)){echo 'checked=""';} ?> name="reception[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox" <?php  if(in_array('4', $arr18)){echo 'checked=""';} ?> name="reception[]" value="4"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>TeleCaller</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr19)){echo 'checked=""';} ?> name="telecaller[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr19)){echo 'checked=""';} ?> name="telecaller[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr19)){echo 'checked=""';} ?> name="telecaller[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox" <?php  if(in_array('4', $arr19)){echo 'checked=""';} ?> name="telecaller[]" value="4"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>Counselor</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr20)){echo 'checked=""';} ?> name="counselor[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr20)){echo 'checked=""';} ?> name="counselor[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr20)){echo 'checked=""';} ?> name="counselor[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox" <?php  if(in_array('4', $arr20)){echo 'checked=""';} ?> name="counselor[]" value="4"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>Coordinator</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr22)){echo 'checked=""';} ?> name="coordinator[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr22)){echo 'checked=""';} ?> name="coordinator[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('3', $arr22)){echo 'checked=""';} ?> name="coordinator[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox" <?php  if(in_array('4', $arr22)){echo 'checked=""';} ?> name="coordinator[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Admission</td>
                                       <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('1', $arr21)){echo 'checked=""';} ?> name="admission[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" <?php  if(in_array('2', $arr21)){echo 'checked=""';} ?> name="admission[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox" disabled="disabled"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
    
    
    
    
        </div>
    </div>
    
    
    
</div>




