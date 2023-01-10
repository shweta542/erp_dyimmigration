
<?php $arr = explode('|',$privileges_settings->holiday) ?>

   <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Holidays <?= date('Y') ?></h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Holidays</li>
                    </ul>
                </div>
                <?php  if(in_array('1', $arr)){
    ?>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_holiday"><i class="fa fa-plus"></i> Add Holiday</a>
                </div>
            <?php }
    ?>
            </div>
        </div>
 <?php if (in_array('2', $arr,true) || in_array('3', $arr,true) ||  in_array('4', $arr,true)) {
                               ?>
        <div class="row filter-row">
            <div class="col-md-10">
            
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="year" >
                        
                        <?php 
   for($i = 2021 ; $i <= date('Y'); $i++){
    ?>
                        <option <?= ($i == date('Y'))?'selected':'' ?> value="<?= $i  ?>"><?= $i; ?></option>
                        
                    <?php } ?>
                    </select>
                    <label class="focus-label">Year</label>
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Holiday Date</th>
                                <th>Day</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr class="holiday-completed">
                                <td>1</td>
                                <td>New Year</td>
                                <td>1 Jan 2019</td>
                                <td>Sunday</td>
                                <td></td>
                            </tr>
                            
                            <tr class="holiday-upcoming">
                                <td>6</td>
                                <td>Bakrid</td>
                                <td>2 Sep 2019</td>
                                <td>Saturday</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_holiday"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_holiday"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr> -->
                          <?php
$i = 1;
                           foreach ($data as $key ) {

    ?>
<tr class="<?= (date('Y-m-d',strtotime($key->holidays_date)) < date('Y-m-d'))?'holiday-completed':'holiday-upcoming' ?>">
                                <td><?= $i++ ?></td>
                                <td><?= $key->holidays_name ?></td>
                                <td><?= $key->holidays_date ?></td>
                                <td><?= date('l', strtotime($key->holidays_date)); ?></td>
                                 <?php  if(in_array('3', $arr) ||  in_array('4', $arr)){
    ?>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                             <?php  if(in_array('3', $arr)){
    ?>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_holiday<?= $key->holidays_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
<?php
                            } ?>
                            <?php  if(in_array('4', $arr)){
    ?>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_holiday<?= $key->holidays_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
<?php
                            } ?>
                                        </div>
                                    </div>
                                </td>
                                <div class="modal custom-modal fade" id="edit_holiday<?= $key->holidays_id ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="editHoliday">
                        <input type="hidden" name="holidays_id" value="<?= $key->holidays_id ?>">
                        <div class="form-group">
                            <label>Holiday Name <span class="text-danger">*</span></label>
                            <input class="form-control"  type="text" name="holidays_name" required="" value="<?= $key->holidays_name ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Holiday Date <span class="text-danger">*</span></label>
                            <div class="cal-icon"><input class="form-control datetimepicker" value="<?= $key->holidays_date ?>" type="text" name="holidays_date" required=""/></div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal custom-modal fade" id="delete_holiday<?= $key->holidays_id ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Holiday</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" onclick='deleteCommon("tbl_holidays","holidays_id",<?= $key->holidays_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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
                            </tr>
    
                          <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php }
    ?>
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

    <div class="modal custom-modal fade" id="add_holiday" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addHolidays">
                        <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                         <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                        <div class="form-group">
                            <label>Holiday Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="holidays_name" required="" />
                        </div>
                        <div class="form-group">
                            <label>Holiday Date <span class="text-danger">*</span></label>
                            <div class="cal-icon"><input class="form-control mydatepickerholi" type="text" name="holidays_date" required=""/></div>
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

