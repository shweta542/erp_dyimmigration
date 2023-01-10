<?php $arr = explode('|',$privileges_settings->employees) ?>
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Employees</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employees</li>
                    </ul>
                </div>
                  <?php if (in_array('1', $arr,true)) {
                               ?>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                    <button class="btn btn-white m-r-5" onclick="exportexel(
                        'exelEmployees', 'employees',1)">
                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export
                    </button>  
                </div>
                <?php
                    } 
                ?>
            </div>
        </div>
        <?php if (in_array('2', $arr,true) || in_array('3', $arr,true) ||  in_array('4', $arr,true)) {
                               ?>
                              
    </button>     
        <form action="employeelist.html" method="get">
        <div class="row filter-row">
              
               <div class="col-sm-3 col-md-3">
                <div class="form-group ">
                    <input type="text" class="form-control" name="phone" 
                    placeholder="Enter phone" value="<?php if(isset($_GET['phone'])){echo $_GET['phone'];} ?>">
                </div>
            </div>
            <div class="col-sm-3 col-md-3">
                <div class="form-group ">
                    <input type="text" class="form-control" name="name" 
                    placeholder="Enter name" value="<?php if(isset($_GET['name'])){echo $_GET['name'];} ?>">
                </div>
            </div>
            
           <div class="col-sm-3 col-md-3">
                <div class="form-group ">
                    <input type="text" class="form-control" name="email" 
                    placeholder="Enter email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>">
                </div>
            </div>
            
             <div class="col-sm-3 col-md-3">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
                
               
        </div>
        </form>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table" id="exelEmployees">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Department</th> 
                                <th>Branch</th> 
                                <th class="text-center">Status</th>                                 
                                <th class="text-right no-sort">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key ) {
                                $department1=$this->db->where('department_id',$key->department_id)->get('tbl_department')->row();
                                $designation=$this->db->where('designation_id',$key->designation_id)->get('tbl_designation')->row();
                                $branchcity=$this->db->where('branch_id',$key->branch_id)->get('tbl_branch')->row();
                                $branchcity1=$this->db->where('id',$branchcity->branch_city)->get('cities')->row();
                              ?>

                            <tr>
                                <td><?= $key->USER_ID ?></td>
                                    <td>
                                        <a href="profile.html/<?= $key->USER_ID ?>"><div class="avatar"><img alt="" src="<?= ($key->user_image)?$key->user_image:'assets/img/user.jpg' ?>" /></div>
                                        <h2 class="table-avatar"><?= $key->USER_NAME ?> <?= $key->user_last_name ?> <span><?= $designation->designation_name ?> </span>
                                        </h2>
                                        </a>
                                    </td>
                                <td><a href="mailto:<?= $key->USER_EMAIL ?>"><?= $key->USER_EMAIL ?></a></td>
                                <td><a href="tel:<?= $key->USER_PHONE ?>"><?= $key->USER_PHONE ?></a></td>
                                <td><?= $department1->department_name ?></td>
                                <td><?= ($branchcity)?$branchcity->branch_name:'' ?></td>
                                 <td class="text-center">
                                    <div class="dropdown action-label">
                                        <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"> 
                                            <?php if($key->USER_VERIFY == 1){
                                                ?>
                                                <i class="fa fa-dot-circle-o text-danger"></i> Deactivated
                                                <?php
                                            }else{
                                               ?>
                                               <i class="fa fa-dot-circle-o text-success"></i>Active 
                                                <?php 
                                            } ?>
                                            
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <a onclick="employeestatus(<?= $key->USER_ID ?>,0)" class="dropdown-item" href="javascript:void(0)" ><i class="fa fa-dot-circle-o text-success"></i> Active</a>

                                            <a onclick="employeestatus(<?= $key->USER_ID ?>,1)" class="dropdown-item" href="javascript:void(0)"><i class="fa fa-dot-circle-o text-danger"></i> Deactivated</a>

                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (in_array('3', $arr,true)) {
                                                            ?>
                                            <a class="dropdown-item" href="employee-edit.html/<?= $key->USER_ID ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <?php } ?>
                                                    <?php if (in_array('4', $arr,true)) {
                                                            ?>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_employee<?= $key->USER_ID ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                             <?php } ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal custom-modal fade" id="delete_employee<?= $key->USER_ID ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Employee</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" onclick='deleteCommon("user_tbl","USER_ID",<?= $key->USER_ID ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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
        <div class="ftr-pagination-sec mr-tp20">
                        <div class="row">
                        <div class="col-md-6">
                        
                        </div>
                        <div class="col-md-6">
                            <div class="ftr-pagination">
                                <nav aria-label="Page navigation example">
                                  <ul class="pagination">
                                     <?php foreach ($links as $link) { ?>
                              <?=$link?>
                              <?php } ?>
                                    
                                  </ul>
                                </nav>
                            </div>
                        </div>
                        </div>
                    </div>
    </div>
    <?php } ?>
    <div id="add_employee" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Employee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUser">
                         <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                         <input type="hidden" name="USER_VERIFY" value="1">

                        <input type="hidden" name="DATETIME" value="<?= date('dd-mm-yyyy hh:mm a') ?>">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">First Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="USER_NAME" required="true" />
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Last Name</label>
                                    <input class="form-control" type="text" name="user_last_name"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Username <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="username" required="true"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="USER_EMAIL" required="true"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="PASSWORD" required="true" id="password"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="CONFIRM_PASSWORD" required="true" id="confirmpassword"/>
                                </div>
                            </div>
                             
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee Salary <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" name="employee_salary" required="true"/>
                                </div>
                            </div>
                            <!-- <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="employee_id" required="true"/>
                                </div>
                            </div> -->
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Joining Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon"><input class="form-control datetimepicker" type="text" name="Joining_date" required="true"/></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-form-label">Phone </label>
                                    <input class="form-control" type="text"   maxlength="10"  name="USER_PHONE" required="true"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Branch <span class="text-danger">*</span></label>
                                    <select class="select" name="branch_id[]" required="true" multiple>
                                        <option value="" disabled="">Select Branch</option>
                                        <?php foreach ($branch as $key ) {
                                            ?>
                                            <option value="<?= $key->branch_id ?>"><?= $key->branch_name ?></option>
                                                <?php
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Department <span class="text-danger">*</span></label>
                                    <select class="select" name="department_id" required="true" id="department">
                                        <option value="">Select Department</option>
                                        <?php 

                                        foreach ($department as $key ) {
                                            ?>
                                            <option value="<?= $key->department_id ?>"><?= $key->department_name ?></option>
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
                                            <input type="checkbox" name="organizationSetting[]" value="3" />
                                        </td>
                                        <td class="text-center">
                                          <input type="checkbox" disabled="disabled">  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Branches</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="branch[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="branch[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="branch[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="branch[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Department</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="department[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="department[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="department[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="department[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Designations</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="designation[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="designation[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="designation[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="designation[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Employees</td>
                                        <td class="text-center">
                                            <input type="checkbox" name="employees[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="employees[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="employees[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="employees[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Leave</td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="leave[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="leave[]" value="3"/>
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
                                            <input type="checkbox" name="attendence[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="attendence[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Employee Salary</td>
                                       <td class="text-center">
                                            <input type="checkbox" name="salary[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="salary[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="salary[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="salary[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Holiday</td>
                                       <td class="text-center">
                                            <input type="checkbox"  name="holiday[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="holiday[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="holiday[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="holiday[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Banking</td>
                                       <td class="text-center">
                                            <input type="checkbox" name="banking[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="banking[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="banking[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Heads</td>
                                       <td class="text-center">
                                            <input type="checkbox"  name="heads[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="heads[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="heads[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Sub-Heads</td>
                                       <td class="text-center">
                                            <input type="checkbox" name="subHeads[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="subHeads[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="subHeads[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Buyer and Supplier</td>
                                       <td class="text-center">
                                            <input type="checkbox" name="vendorCustomer[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="vendorCustomer[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" name="vendorCustomer[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Vouchar Entries</td>
                                       <td class="text-center">
                                            <input type="checkbox" name="journal[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="journal[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="journal[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daybook</td>
                                       <td class="text-center">
                                           <input type="checkbox" disabled="disabled">  
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="ledger[]" value="2"/>
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
                                            <input type="checkbox"  name="trialBalance[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="trialBalance[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="trialBalance[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Profit/Loss</td>
                                       <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="ProfitLoss[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="ProfitLoss[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="ProfitLoss[]" value="4"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>Balance Sheets</td>
                                       <td class="text-center">
                                            <input type="checkbox" disabled="disabled"> 
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="balanceSheet[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="balanceSheet[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="balanceSheet[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Reception</td>
                                       <td class="text-center">
                                            <input type="checkbox"  name="reception[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="reception[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="reception[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox"  name="reception[]" value="4"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>TeleCaller</td>
                                       <td class="text-center">
                                            <input type="checkbox"  name="telecaller[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="telecaller[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="telecaller[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox"  name="telecaller[]" value="4"/>
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>Counselor</td>
                                       <td class="text-center">
                                            <input type="checkbox"  name="counselor[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="counselor[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="counselor[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox"  name="counselor[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Coordinator</td>
                                       <td class="text-center">
                                            <input type="checkbox"  name="coordinator[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="coordinator[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="coordinator[]" value="3"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox"  name="coordinator[]" value="4"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Admission</td>
                                       <td class="text-center">
                                            <input type="checkbox"  name="admission[]" value="1"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  name="admission[]" value="2"/>
                                        </td>
                                        <td class="text-center">
                                            <input type="checkbox"  disabled="disabled"/>
                                        </td>
                                        <td class="text-center">
                                           <input type="checkbox"  disabled="disabled"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    

    
</div>
