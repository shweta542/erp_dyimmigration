
<?php $arr = explode('|',$privileges_settings->designation) ?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Group</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Group</li>
                                </ul>
                            </div>
                            <div class="col-auto float-right ml-auto">
                                <a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_head"><i class="fa fa-plus"></i> Add Group</a>
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
                    </div> -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th>Group Name</th>
                                            <th>Category</th>
                                            <th>Status</th>
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
                                            <td><?= $key->group_name ?></td>
                                            <td><?= ($key->group_category == '1')?'Credit':'Debit' ?></td>
                                            <td><?= ($key->status == '1')?'Balance-sheet':'Profit-Loss' ?></td>
                                            <td class="text-right">
                                                 <?php if($key->group_status == 0){
                                                            ?>
                                                <div class="dropdown dropdown-action">
                                                    <a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                       

                                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#edit_head<?= $key->group_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                           
                                                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->heads_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                                    </div>
                                                </div>
                                                 <?php
                                                        } ?>
                                            </td>
                                        </tr>
                                        <div id="edit_head<?= $key->group_id ?>" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Group</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="editGroup">
                                    <input type="hidden" name="group_id" value="<?= $key->group_id ?>">
                                    <div class="form-group">
                                        <label>Group Name <span class="text-danger">*</span></label>
                                         <input class="form-control" type="text" name="group_name" required="" value="<?= $key->group_name ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose status <span class="text-danger">*</span></label>
                                        <select class="select" name="status" required="">
                                            <option <?= ($key->status==1)?'selected':'' ?> value="1">Balance-sheet</option>
                                            <option <?= ($key->status==2)?'selected':'' ?> value="2">Profit-Loss</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose Category <span class="text-danger">*</span></label>
                                        <select class="select" name="group_category" required="">
                                            <option <?= ($key->group_category==1)?'selected':'' ?> value="1">Credit</option>
                                            <option <?= ($key->group_category==2)?'selected':'' ?> value="2">Debit</option>
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

                <div class="modal custom-modal fade" id="delete_designation<?= $key->group_id ?>" role="dialog">
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
                                            <a href="javascript:void(0);" onclick='deleteCommon("tbl_group","group_id",<?= $key->group_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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

                <div id="add_head" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Group</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addGroup">
                                    <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                             <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                                    <div class="form-group">
                                        <label>Group Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="group_name" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Choose status <span class="text-danger">*</span></label>
                                        <select class="select" name="status" required="">
                                            <option value="1">Balance-sheet</option>
                                            <option value="2">Profit-Loss</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose Category <span class="text-danger">*</span></label>
                                        <select class="select" name="group_category" required="">
                                            <option value="1">Credit</option>
                                            <option value="2">Debit</option>
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

