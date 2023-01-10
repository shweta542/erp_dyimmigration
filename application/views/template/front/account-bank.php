
<?php $arr = explode('|',$privileges_settings->designation) ?>

  <div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title">Banking/Cash</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Banking/Cash</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_bank"><i class="fa fa-plus"></i> Add Banking/Cash</a>
                     <button class="btn btn-white m-r-10" onclick="exportexel(
                        'exelbank', 'bank',1)">
                       <i class="fa fa-file-excel-o" aria-hidden="true"></i>
 Export
                    </button>  
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
                    <table class="table table-striped custom-table mb-0" id="exelbank">
                        <thead>
                            <tr>
                                <th>Bank Name</th>
                                <th>Account Number</th>
                                <th>Bank Location</th>
                                <th>Branch Name</th>
                                <th>IFSC Code</th>
                                <th>Opening Balance</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data as $key) {
                                ?>

                            <tr>
                                <td><?= $key->bank_name ?></td>
                                <td><?= $key->bank_number ?></td>
                                <td><?= $key->bank_location ?></td>
                                <td><?= $key->bank_branch ?></td>
                                <td><?= $key->bank_ifsc_code ?></td>
                                <td><?= $key->opening_balance ?></td>
                                
                                <td class="text-right">
                                    
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_bank<?= $key->bank_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addopeningbalance<?= $key->bank_id ?>"><i class="fa fa-pencil m-r-5"></i> Add-Balance</a>
                                            <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_bank<?= $key->bank_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                        </div>
                                    </div>
                                
                                </td>
                            </tr>
                            <div class="modal custom-modal fade" id="delete_bank<?= $key->bank_id ?>" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-header">
                        <h3>Delete Bank</h3>
                        <p>Are you sure want to delete?</p>
                    </div>
                    <div class="modal-btn delete-action">
                        <div class="row">
                            <div class="col-6">
                                <a href="javascript:void(0);" onclick='deleteCommon("tbl_bank","bank_id",<?= $key->bank_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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
                <div id="edit_bank<?= $key->bank_id ?>" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Edit Bank</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form class="editBank">
            <input type="hidden" name="bank_id" value="<?= $key->bank_id ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Bank Name</label>
                        <input class="form-control" type="text" name="bank_name" required="" value="<?= $key->bank_name ?>" />
                    </div>
                </div>
                <?php if($key->status != 1){
                    ?>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Account Number</label>
                         <input class="form-control" type="text" name="bank_number" required="" value="<?= $key->bank_number ?>" maxlength="16" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                    </div>
                </div>
                    <?php
                } ?>

            </div>
            <?php if($key->status != 1){
                    ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>IFSC Code</label>
                        <input class="form-control" type="text" name="bank_ifsc_code" required="" value="<?= $key->bank_ifsc_code ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Branch Name</label>
                        <input class="form-control" type="text" name="bank_branch" required="" value="<?= $key->bank_branch ?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Bank Location</label>
                        <input class="form-control" type="text" name="bank_location" required="" value="<?= $key->bank_location ?>"/>
                    </div>
                </div>
            </div>
 <?php
                } ?>
            <div class="submit-section">
                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
            </div>
            </form>
            </div>
            </div>
            </div>
            </div>

            <div id="addopeningbalance<?= $key->bank_id ?>" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Opening Balance</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="edit/addopeningBank_request" method="post">
            <input type="hidden" name="bank_id" value="<?= $key->bank_id ?>"/>
            <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Amount</label>
                        <input class="form-control" type="number" name="opening_balance" required="" value="0" />
                    </div>
                </div>
               
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

    <div id="add_bank" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Bank</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addBank">
                         <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                             <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input class="form-control" type="text" name="bank_name" required="" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account Number</label>
                                    <input class="form-control" type="text" name="bank_number" required="" maxlength="16" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>IFSC Code</label>
                                    <input class="form-control" type="text" name="bank_ifsc_code" required=""/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Branch Name</label>
                                    <input class="form-control" type="text" name="bank_branch" required=""/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Bank Location</label>
                                    <input class="form-control" type="text" name="bank_location" required=""/>
                                </div>
                            </div>
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

