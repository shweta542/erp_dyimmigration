


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
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_leave"><i class="fa fa-plus"></i> Add Leave</a>
                        <button class="btn btn-white mr-2" onclick="exportexel('exelleave', 'leave')"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button> 
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-1">
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Annual Leave</h6>
                        <h4> <?= ($annualleave->annualcount)?$annualleave->annualcount:'0' ?></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Full Day Leave</h6>
                        <h4><?=  ($fullday->fullcount)?$fullday->fullcount:'0' ?></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Half Day Leave</h6>
                        <h4><?= ($haflday->halfcount)?$haflday->halfcount:'0' ?></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Short Leave</h6>
                        <h4><?= ($shortday->shortcount)?$shortday->shortcount:'0' ?></h4>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="stats-info">
                        <h6>Remaining Leave</h6>
                        <h4><?= $annualgiven - $annualleave->annualcount ?></h4>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
            </div>
            <input type="hidden" id="fullleave" value="<?= $organisationleave->total_fullday-$fullday->fullcount?>">
            <input type="hidden" id="halfleave" value="<?= $organisationleave->total_halfday-$haflday->halfcount ?>">
            <input type="hidden" id="shortleave" value="<?= $organisationleave->total_shortleave-$shortday->shortcount ?>">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table mb-0" id="exelleave">
                            <thead>
                                <tr>
                                    <th>Leave Type</th>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>No of Days</th>
                                    <th>Reason</th>
                                    <th class="text-center">Status</th>
                                    <th>Approved by</th>
                                    <th class="text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $key ) {
                                    $userData=$this->db->where('USER_ID',$key->status_markedby)->get('user_tbl')->row();
                                    ?>

                                    <tr>
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
                                            <div class="action-label">
                                               <?php if($key->status == 1){
                                                    ?>
                                                     <a class="btn btn-sm btn-rounded" href="javascript:void(0);"> <i class="fa fa-dot-circle-o text-info"> </i>Pending</a>
                                                    <?php
                                                }else if($key->status == 2){
                                                    ?>
                                                     <a class="btn btn-sm btn-rounded" href="javascript:void(0);"> <i class="fa fa-dot-circle-o text-success"> </i>Approved</a>
                                                    <?php
                                                    
                                                }else if($key->status == 3){
                                                    ?>
                                                     <a class="btn btn-sm btn-rounded" href="javascript:void(0);"> <i class="fa fa-dot-circle-o text-danger"> </i>Declined</a>
                                                    <?php
                                                   
                                                }else{
                                                    ?>
                                                     <a class="btn btn-sm btn-rounded" href="javascript:void(0);"> <i class="fa fa-dot-circle-o text-purple"> </i>Cancel</a>
                                                    <?php
                                                   
                                                } ?>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($userData){
                                               ?>
                                               <a href="profile.php">
                                            <div class="avatar avatar-xs"><img alt="" src="<?= ($userData->user_image)?$userData->user_image:'assets/img/user.jpg' ?>"></div><h2 class="table-avatar"><?= $userData->USER_NAME ?></h2></a>
                                               <?php 
                                            }else{

                                            }?>
                                            
                                        </td>

                                        <td class="text-right">
                                            <?php if(!$userData){
                                               ?>
                                            <div class="dropdown dropdown-action">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_leave<?= $key->leave_type ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_approve<?= $key->leave_type ?>"><i class="fa fa-ban m-r-5"></i>Cancel</a>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </td>
                                    </tr>
                                    <div id="edit_leave<?= $key->leave_type ?>" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="editLeave">
                            <input type="hidden" name="leave_id" class="leave_id" value="<?= $key->leave_id ?>"/>
                            <input type="hidden" name="maindate" value="" class="maindate<?= $key->leave_id ?>">
                            <input type="hidden" name="maindateto" value="" class="maindateto<?= $key->leave_id ?>">
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <select class="select statusofleave" name="leave_type" required="">
                                    <option value="1" <?= ($key->leave_type=='1')? 'selected':''?> >Full Day</option>
                                    <option value="2" <?= ($key->leave_type=='2')? 'selected':''?> >Half Day</option>
                                    <option value="3" <?= ($key->leave_type=='3')? 'selected':''?> >Short Leave</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>From <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control mydatepicker formDate<?= $key->leave_id ?>" onchange="mydaysdifferenceEdit(<?= $key->leave_id ?>)" id="test1"  type="text" name="leave_form" value="<?= $key->leave_form ?>" required="" readonly="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>To <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control mydatepicker toDate<?= $key->leave_id ?>" onchange="mydaysdifferenceEdit(<?= $key->leave_id ?>)"  id="test2" type="text" name="leave_to" value="<?= $key->leave_to ?>" required="" readonly="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Number of days <span class="text-danger">*</span></label>
                                <input class="form-control numberdays<?= $key->leave_id ?>" readonly type="text" name="leave_day" required="" readonly="" value="<?= $key->leave_day ?>" />
                            </div>
                            <div class="form-group">
                                <label>Remaining Leaves <span class="text-danger">*</span></label>
                                <input class="form-control remaining" readonly value="0"  />
                            </div>
                            <div class="form-group">
                                <label>Leave Reason <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control" name="leave_reason" required=""><?= $key->leave_reason ?></textarea>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal custom-modal fade" id="delete_approve<?= $key->leave_type ?>" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Cancel Leave</h3>
                            <p>Are you sure want to Cancel this leave?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <div class="row">
                                <div class="col-6">
                                    <a href="javascript:void(0);" onclick="changeleavestatus(<?= $logged_in_user->USER_ID ?>,4,<?= $key->leave_id ?>)" class="btn btn-primary continue-btn">Yes</a>
                                </div>
                                <div class="col-6">
                                    <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">No</a>
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

        <div id="add_leave" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Leave</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="addLeave">
                             <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                             <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                             <input type="hidden" name="maindate" value="" id="maindate">
                             <input type="hidden" name="maindateto" value="" id="maindateto">
                             <input type="hidden" name="USER_ID" value="<?= $logged_in_user->USER_ID ?>">
                            <div class="form-group">
                                <label>Leave Type <span class="text-danger">*</span></label>
                                <select class="select statusofleave" name="leave_type" required="">
                                    <option value="">Select Leave Type</option>
                                    <option value="1">Full Day</option>
                                    <option value="2">Half Day</option>
                                    <option value="3">Short Leave</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>From <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control mydatepicker " onchange="mydaysdifference()" id="formDate" type="text" name="leave_form" required="" readonly="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>To <span class="text-danger">*</span></label>
                                <div class="cal-icon">
                                    <input class="form-control mydatepicker" onchange="mydaysdifference()" id="toDate" type="text" name="leave_to" required="" readonly="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Number of days <span class="text-danger">*</span></label>
                                <input class="form-control" readonly id="numberdays" type="text" name="leave_day" required="" readonly="" />
                            </div>
                            <div class="form-group">
                                <label>Remaining Leaves <span class="text-danger">*</span></label>
                                <input class="form-control remaining" readonly value="0"  />
                            </div>
                            <div class="form-group">
                                <label>Leave Reason <span class="text-danger">*</span></label>
                                <textarea rows="4" class="form-control" name="leave_reason" required=""></textarea>
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

