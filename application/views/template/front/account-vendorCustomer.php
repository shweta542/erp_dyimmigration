
<?php $arr = explode('|',$privileges_settings->designation) ?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Buyers/Suppliers</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Buyers/Suppliers</li>
                                </ul>
                            </div>
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_vendor"><i class="fa fa-plus"></i> Add Buyers/Suppliers</a>
                                  <button class="btn btn-white m-r-10" onclick="exportexel(
                                    'exelbuyer', 'Buyers',2)">
                                    <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export
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
                                <table class="table table-striped custom-table mb-0" id="exelbuyer">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th>Name</th>
                                            <th>Buyers/Suppliers</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>MoneyIn/Out</th>
                                            <th class="text-center">Document</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i =1;
                                        foreach ($data as $key ){
                                           ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $key->heads_name ?></td>
                                            <td><?= ($key->custom_vender_status ==1)?'Supplier':'Buyer' ?></td>
                                            <td><?= $key->address ?></td>
                                            <td><?= $key->phone ?></td>
                                             <td><?= ($key->heads_category ==1)?'MoneyIn':'MoneyOut' ?></td>
                                            <td align="center">
                                                <?php if($key->uploads){
                                            	?>
                                            	<a download href="<?= base_url() ?><?= $key->uploads ?>" > <i class="fa fa-download" aria-hidden="true"></i></a>
                                            	<?php
                                                }?> 
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_vendor<?= $key->heads_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->vendorcustomer_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                         <div id="edit_vendor<?= $key->heads_id ?>" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Buyers/Suppliers</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="editVendorCustomer">
                                    <input type="hidden" name="heads_id" value="<?= $key->heads_id ?>">
                                    <div class="form-group">
                                        <label>Buyers/Suppliers Name <span class="text-danger">*</span></label>
                                        <input name="vendorcustomer_name" class="form-control" type="text" value="<?= $key->heads_name ?>" required=""/>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose Buyers/Suppliers<span class="text-danger">*</span></label>
                                        <select class="select" name="status">
                                            <option <?= ($key->custom_vender_status==1)?'selected':'' ?> value="1" >Supplier</option>
                                            <option <?= ($key->custom_vender_status==2)?'selected':'' ?> value="2" >Buyer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose MoneyIn/MoneyOut <span class="text-danger">*</span></label>
                                        <select class="select" name="moneyInout" required="">
                                            <option  <?= ($key->heads_category == 1)?'selected':'' ?> value="1">Money In</option>
                                            <option  <?= ($key->heads_category == 2)?'selected':'' ?> value="2">Money Out</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"  name="vendorcustomer_address" required="" value="<?= $key->address ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"  name="vendorcustomer_phone" required="" value="<?= $key->phone ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Document <span class="text-danger">*</span></label>
                                        <input type="file" multiple="true"  name="uploads"  />
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal custom-modal fade" id="delete_designation<?= $key->heads_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Entry</h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" onclick='deleteCommon("tbl_heads","heads_id",<?= $key->heads_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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
                                <li class="page-item paginate_button"><?=$link?></li>
                              <?php } ?>
                                  </ul>
                                </nav>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div id="add_vendor" class="modal custom-modal fade" role="dialog" >
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Buyers/Suppliers</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addVendorCustomer" enctype="multipart/form-data">
                                    <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                         <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                                    <div class="form-group">
                                        <label>Buyers/Suppliers Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"  name="vendorcustomer_name" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Choose Buyers/Suppliers<span class="text-danger">*</span></label>
                                        <select class="select" name="status" required="true">
                                            <option value="1">Supplier</option>
                                            <option value="2">Buyer</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Choose MoneyIn/MoneyOut <span class="text-danger">*</span></label>
                                        <select class="select" name="moneyInout" required="">
                                            <option  value="1">Money In</option>
                                            <option  value="2">Money Out</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"  name="vendorcustomer_address" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text"  name="vendorcustomer_phone" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Document <span class="text-danger">*</span></label>
                                        <input type="file" multiple="true"  name="uploads"  />
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