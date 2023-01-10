
<?php $arr = explode('|',$privileges_settings->leaves) ?>

 <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Leaves</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Leaves</li>
                                </ul>
                            </div>
                            <div class="col-auto float-right ml-auto">
                              <button class="btn btn-white m-r-5"onclick="exportexel(
        'exelleave', 'leave')"><i class="fa fa-file-excel-o" aria-hidden="true"></i>
    Export </button>
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_leave"><i class="fa fa-plus"></i> Create Leaves</a>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="stats-info">
                                <h6>Total Request</h6>
                                <h4><?= $totalReq ?> </h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-info">
                                <h6>Approved</h6>
                                <h4><?= $totalapprove ?></h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-info">
                                <h6>Not Approved</h6>
                                <h4><?= $totalnotapprove ?></h4>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-info">
                                <h6>Pending</h6>
                                <h4><?= $totalpending ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row filter-row">
                        <div class="col-md-10">
                        
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" />
                                <label class="focus-label">Search..</label>
                            </div>
                        </div>
                    </div>  -->         

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0 datatable" id="exelleave">
                                    <thead>
                                        <tr>
                                            <th>Employee</th>
                                            <th>Leave Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>No of Days</th>
                                            <th>Reason</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data as $key ) {
                                    $userData=$this->db->where('USER_ID',$key->USER_ID)->get('user_tbl')->row();
                                    $userDesignation=$this->db->where('designation_id',$userData->designation_id)->get('tbl_designation')->row();
                                    ?>
                                    <tr>
                                        <td>
                                                <a href="profile.html/<?= $key->USER_ID ?>"><div class="avatar"><img alt="" src="<?= ($userData->user_image)?$userData->user_image:'assets/img/user.jpg' ?>" /></div>
                                                <h2 class="table-avatar"><?= $userData->USER_NAME ?> <?= $userData->user_last_name ?><span><?= $userDesignation->designation_name ?> </span>
                                                </h2>
                                                </a>
                                            </td>
                                        <td><?php if($key->leave_type == '1'){
                                            echo "Full Day";
                                        }else if($key->leave_type == '2'){
                                            echo "Half Day";
                                        }else{
                                            echo "Short Leave";
                                        } ?></td>
                                        <td><?= get_datetime($key->leave_form) ?></td>
                                        <td><?= get_datetime($key->leave_to) ?></td>
                                        <td><?= $key->leave_day ?> day<?= ($key->leave_day==1)?'':'s' ?></td>
                                        <td><?= $key->leave_reason ?></td>
                                         <td class="text-center">
<?php if(in_array('3', $arr)){
    ?>

                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"> 
                                                        <?php if($key->status == 1){
                                                    echo "<i class='fa fa-dot-circle-o text-info'></i> Pending";
                                                }else if($key->status == 2){
                                                    echo "<i class='fa fa-dot-circle-o text-success'></i> Approved";
                                                    
                                                }else if($key->status == 3){
                                                    echo "<i class='fa fa-dot-circle-o text-danger'></i> Declined";
                                                   
                                                }else{ 
                                                  echo "<i class='fa fa-dot-circle-o text-purple'></i> Cancel"; 
                                                } ?></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        
                                                        <a class="dropdown-item" href="javascript:void(0)"><i class="fa fa-dot-circle-o text-info" ></i> Pending</a>

                                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#approved_leave<?= $key->leave_id ?>" ><i class="fa fa-dot-circle-o text-success" ></i> Approved</a>

                                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#declined_leave<?= $key->leave_id ?>"><i class="fa fa-dot-circle-o text-danger"  ></i> Declined</a>

                                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#cancel_leave<?= $key->leave_id ?>" ><i class="fa fa-dot-circle-o text-purple" ></i>Cancel</a>
                                                    </div>
                                                </div>
                                               
    <?php
}else{
    ?>
    <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"> 
                                                        <?php if($key->status == 1){
                                                    echo "<i class='fa fa-dot-circle-o text-info'></i> Pending";
                                                }else if($key->status == 2){
                                                    echo "<i class='fa fa-dot-circle-o text-success'></i> Approved";
                                                    
                                                }else if($key->status == 3){
                                                    echo "<i class='fa fa-dot-circle-o text-danger'></i> Declined";
                                                   
                                                }else{ 
                                                  echo "<i class='fa fa-dot-circle-o text-purple'></i> Cancel"; 
                                                } ?></a>
                                            </div>
                                            
    <?php
} ?>

                                            </td>
                                            <td class="text-center">
                                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->leave_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </td>
                                    </tr>
                                     <div class="modal custom-modal fade" id="delete_designation<?= $key->leave_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Call</h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" onclick='deleteCommon(" tbl_leave","leave_id",<?= $key->leave_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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
                 <div class="modal custom-modal fade" id="approved_leave<?= $key->leave_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Leave Approve</h3>
                                    <p>Are you sure want to approve for this leave?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" onclick="changeleavestatus(<?= $logged_in_user->USER_ID ?>,2,<?= $key->leave_id ?>)">Approve</a>
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
                 <div class="modal custom-modal fade" id="declined_leave<?= $key->leave_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Leave Declined</h3>
                                    <p>Are you sure want to Declined for this leave?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" onclick="changeleavestatus(<?= $logged_in_user->USER_ID ?>,3,<?= $key->leave_id ?>)">Declined</a>
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
                 <div class="modal custom-modal fade" id="cancel_leave<?= $key->leave_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Leave Cancel</h3>
                                    <p>Are you sure want to cancel for this leave?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn" onclick="changeleavestatus(<?= $logged_in_user->USER_ID ?>,4,<?= $key->leave_id ?>)">Cancel Leave</a>
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
                                }  ?>
                                        
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
                
                <div id="create_leave" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Create Leave</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="updateLeavecount">
                                    <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                                    <div class="form-group">
                                        <label class="col-form-label">Full Leaves/Year <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="total_fullday" value="<?= $orgData->total_fullday ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Half Leaves/Year <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="total_halfday" value="<?= $orgData->total_halfday ?>" >
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Short Leaves/Year <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="total_shortleave" value="<?= $orgData->total_shortleave ?>" >
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                

               <!--  <div id="edit_leave" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Leave</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label>Leave Type <span class="text-danger">*</span></label>
                                        <select class="select">
                                            <option>Select Leave Type</option>
                                            <option>Casual Leave 12 Days</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>From <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" value="01-01-2019" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>To <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" value="01-01-2019" type="text" />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Number of days <span class="text-danger">*</span></label>
                                        <input class="form-control" readonly type="text" value="2" />
                                    </div>
                                    <div class="form-group">
                                        <label>Remaining Leaves <span class="text-danger">*</span></label>
                                        <input class="form-control" readonly value="12" type="text" />
                                    </div>
                                    <div class="form-group">
                                        <label>Leave Reason <span class="text-danger">*</span></label>
                                        <textarea rows="4" class="form-control">Going to hospital</textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="modal custom-modal fade" id="approve_leave" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Leave Approve</h3>
                                    <p>Are you sure want to approve for this leave?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn">Approve</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Decline</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="modal custom-modal fade" id="delete_approve" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Leave</h3>
                                    <p>Are you sure want to delete this leave?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>

