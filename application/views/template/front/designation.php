
<?php $arr = explode('|',$privileges_settings->designation) ?>

   <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Designations</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Designations</li>
                                </ul>
                            </div>
                            <?php if (in_array('1', $arr,true)) {
                               ?>
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_designation"><i class="fa fa-plus"></i> Add Designation</a>
                                <button class="btn btn-white m-r-5" onclick="exportexel('exeldesignation', 'designation',1)"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button>         
                            </div>
                            <?php
                            } ?>
                        </div>
                    </div>
                     <?php if (in_array('2', $arr,true) || in_array('3', $arr,true) ||  in_array('4', $arr,true)) {
                               ?>
                                
                    <!-- <div class="row filter-row">
                        <div class="col-md-10">
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="form-group form-focus">
                                <input type="text" class="form-control floating" />
                                <label class="focus-label">Search..</label>
                            </div>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0" id="exeldesignation">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th>Designation</th>
                                            <th>Department</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i=1; 
                                        foreach ($data as $key ) {
                                            ?>

                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $key->designation_name ?></td>
                                            <td><?= $key->department_name ?></td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if (in_array('3', $arr,true)) {
                                                            ?>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_designation<?= $key->designation_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                         <?php } ?>
                                                    <?php if (in_array('4', $arr,true)) {
                                                            ?>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->designation_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                         <div id="edit_designation<?= $key->designation_id ?>" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Designation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="editDesignation">
                                     <input type="hidden" name="designation_id" value="<?= $key->designation_id ?>">
                                    <div class="form-group">
                                        <label>Designation Name <span class="text-danger">*</span></label>
                                        <input class="form-control" placeholder="Web Developer" type="text" value="<?= $key->designation_name ?>" name="designation_name"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                         <select class="select" name="department_id" required="true">
                                            <option value="">Select Department</option>
                                            <?php foreach ($this->db->get('tbl_department')->result() as $key1) {
                                                ?>
                                            <option value="<?= $key1->department_id ?>" <?php if($key1->department_id == $key->department_id){echo "selected";}?>><?= $key->department_name ?></option>
                                                <?php
                                            } ?>
                                            
                                        </select>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal custom-modal fade" id="delete_designation<?= $key->designation_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Designation</h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" onclick='deleteCommon("tbl_designation","designation_id",<?= $key->designation_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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
                <div id="add_designation" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Designation</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addDesignation">
                                     <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                        <input type="hidden" name="datetime" value="<?= date('dd-mm-yyyy hh:mm a') ?>">
                                    <div class="form-group">
                                        <label>Designation Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="designation_name" required="true" />
                                    </div>
                                    <div class="form-group">
                                        <label>Department <span class="text-danger">*</span></label>
                                        <select class="select" name="department_id" required="true">
                                            <option value="">Select Department</option>
                                            <?php foreach ($this->db->get('tbl_department')->result() as $key) {
                                                ?>
                                            <option value="<?= $key->department_id ?>"><?= $key->department_name ?></option>
                                                <?php
                                            } ?>
                                            
                                        </select>
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

