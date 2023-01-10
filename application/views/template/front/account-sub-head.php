
<?php $arr = explode('|',$privileges_settings->designation) ?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Sub Heads (Ledger)</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Sub Heads</li>
                                </ul>
                            </div>
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_sub_head"><i class="fa fa-plus"></i> Add Sub Heads (Ledger)</a>
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
                                            <th>Sub Heads</th>
                                            <th>Head Name</th>
                                            <th>Category</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$i=1;
                                         foreach ($data as $key ) {
                                            $head=$this->db->where('heads_id',$key->heads_fk)->get('tbl_heads')->row();
                                            ?>

                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $key->heads_name ?></td>
                                            <td><?= $head->heads_name ?></td>
                                            <td><?= ($key->heads_category == '1')?'Money In':'Money Out' ?></td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit_sub_head<?= $key->heads_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->heads_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div id="edit_sub_head<?= $key->heads_id ?>" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Sub Head (Ledger)</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="editHead">
                                    <input type="hidden" name="heads_id" value="<?= $key->heads_id ?>">
                                    <div class="form-group">
                                        <label>Sub Head Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="heads_name" required="" value="<?= $key->heads_name ?>"/>
                                    </div>
                                     <div class="form-group">
                                        <label>Choose Head Name <span class="text-danger">*</span></label>

                                        <select class="select subheadedit_category" name="heads_fk" required="" >
                                            <option value="">Select Category</option>
                                        <optgroup label="Money In">
                                            <?php foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result() as $key1) {
                                              ?>
                                               <option data-id="1" data-status="<?= $key1->status ?>" <?= ($key->heads_fk==$key1->heads_id)?'selected':'' ?> value="<?= $key1->heads_id ?>"><?= $key1->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Money Out">
                                           <?php foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result() as $key1) {
                                              ?>
                                               <option data-id="2" data-status="<?= $key1->status ?>" <?= ($key->heads_fk==$key1->heads_id)?'selected':'' ?> value="<?= $key1->heads_id ?>"><?= $key1->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        </select>
                                        <input type="hidden" name="heads_category" value="<?= $key->heads_category ?>" class="moneyInOut">
                                        <input type="hidden" name="status" value="<?= $key->status ?>" class="">
                                        <!-- <select class="select" name="heads_fk" required="">
                                            <option value="">Select Head</option>
                                            <?php foreach ($this->db->where('heads_fk','0')->where('del_status',0)->get('tbl_heads')->result() as $key1 ) {
                                               ?>
                                                <option <?= ($key->heads_fk==$key1->heads_id)?'selected':'' ?> value="<?= $key1->heads_id ?>"><?= $key1->heads_name ?></option>
                                               <?php
                                            } ?>
                                        </select> -->
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Choose Category <span class="text-danger">*</span></label>
                                        <select class="select" name="heads_category" required="">
                                            <option <?= ($key->heads_category == 1)?'selected':'' ?> value="1">Money In</option>
                                            <option <?= ($key->heads_category == 2)?'selected':'' ?> value="2">Money Out</option>
                                        </select>
                                    </div> -->
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
                                    <h3>Delete Designation</h3>
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
                </div>

                <div id="add_sub_head" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Sub Head (Ledger)</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addsubHead">
                                    <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                             <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                             <input type="hidden" name="heads_category" value="" id="moneyInOut">
                             <input type="hidden" name="status" value="" id="status">
                                    <div class="form-group">

                                        <label>Sub Head Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sub_head_name" required=""/>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Sub Sub Head Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="sub_sub_head_name" />
                                    </div> -->
                                     <div class="form-group">
                                        <label>Choose Head Name <span class="text-danger">*</span></label>
                                        <select class="select" name="heads_fk" required="" id="subhead_category">
                                            <option value="">Select Category</option>
                                        <optgroup label="Money In">
                                            <?php foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',1)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result() as $key) {
                                              ?>
                                               <option data-id="1" data-status="<?= $key->status ?>" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        <optgroup label="Money Out">
                                           <?php foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->where('heads_category',2)->where('subheads_fk',0)->order_by('heads_id','DESC')->get('tbl_heads')->result() as $key) {
                                              ?>
                                               <option data-id="2" data-status="<?= $key->status ?>" value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>
                                              <?php
                                            } ?>
                                        </optgroup>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Choose Category <span class="text-danger">*</span></label>
                                       <select class="select" name="heads_category" required="">
                                            <option value="1">Money In</option>
                                            <option value="2">Money Out</option>
                                        </select>
                                    </div> -->
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
</div>

