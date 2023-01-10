
<?php $arr = explode('|',$privileges_settings->designation) ?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Add Tags </h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Add Tags </li>
                                </ul>
                            </div>
                            
                    <div class="col-auto float-right ml-auto">
                    <a href="javascript:void(0)" class="btn add-btn " data-toggle="modal" data-target="#addtags"><i class="fa fa-plus"></i>Add Tags</a>
                    <button class="btn btn-white mr-2" onclick="exportexel('exelecounsellor', 'Tages')"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button> 
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
                                <table class="table table-striped custom-table mb-0 " id="exelecounsellor">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th style="width: 50px;">Color</th>
                                            <th>Tags</th>
                                            
    
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
                                            <td><i style="color: <?= $key->color_code ?>;" class="fa fa-dot-circle-o"></i></td>
                                            <td><?= $key->status_title ?></td>
                                           
                                            <td class="text-right">
                                                 
                                                <div class="dropdown dropdown-action">
                                                    <a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                       
                                                        
                                                        <a class="dropdown-item" data-toggle="modal" data-target="#edittag<?= $key->status_id ?>" href="javascript:void(0)" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                           
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->status_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        
                <div class="modal custom-modal fade" id="delete_designation<?= $key->status_id ?>" role="dialog">
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
                                            <a href="javascript:void(0);" onclick='deleteCommon(" tbl_status","status_id",<?= $key->status_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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

                <div id="edittag<?= $key->status_id ?>" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="edittages">
                                   
                                    <input type="hidden" name="status_id" value="<?= $key->status_id ?>">
                                    <div class="form-group">
                                        <label>Tag Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="status_title" required="" value="<?= $key->status_title ?>"/>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Tag Color <span class="text-danger">*</span></label>
                                        <input type="color" name="color_code"  required="" value="#ff0000" />
                                    </div>
                                    

                                    
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
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

                <div id="addtags" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Tag</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addtages">
                                   
                             <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                                    <div class="form-group">
                                        <label>Tag Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="status_title" required="" />
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Tag Color <span class="text-danger">*</span></label>
                                        <input type="color" name="color_code"  required="" value="#ff9b44" />
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

