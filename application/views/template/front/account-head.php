
<?php $arr = explode('|',$privileges_settings->designation) ?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Ledger</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Ledger</li>
                                </ul>
                            </div>
                            <div class="col-auto float-right ml-auto">
                                <a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_head"><i class="fa fa-plus"></i> Add Ledger</a>
                            </div>
                        </div>
                    </div>
                   <form id="rrrrr">
         <div class="row filter-row">
            <div class="col-sm-6 col-md-3">
                <div class="form-group form-focus select-focus">
                   
                                    <select class="select" name="ledger" required="" id="getledgerid">
                                         <option value="">Select Ledger</option>
                                        
                                        <?php foreach ($this->db->where('oraganisation_id',$this->maindata->oraganisation_id)->where('del_status',0)->where('heads_fk',0)->order_by('heads_name','ASC')->get('tbl_heads')->result() as $key ) {
                                            ?>
                                <option  value="<?= $key->heads_id ?>"><?= $key->heads_name ?></option>

                                            <?php
                                        } ?>
                                      
                                    </select>
                                   
                    <label class="focus-label">Choose Ledger</label>
                </div>
            </div>
            
            <div class="col-sm-6 col-md-3">
                <button type="button" class="btn btn-success btn-block" id="gotodetailledger"> Search </button>
            </div>
        </div>
        </form>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th>Ledger Name</th>
                                            <th>Category</th>
                                            <th>Group</th>
                                            <th>Address</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Passport</th>
                                            <th>Status</th>
                                            <th>Opening Balance</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$i=1;
                                         foreach ($data as $key ) {
                                            $group=$this->db->where('group_id',$key->group_fk)->limit(1)->get('tbl_group')->row();
                                            ?>

                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><a href="newleadgerdetail.html/<?= $key->heads_id ?>"><?= $key->heads_name ?> </a></td>
                                            <td><?= ($key->heads_category == '1')?'Credit':'Debit' ?></td>
                                            
                                           
                                            <td><?= (isset($group))?$group->group_name:'-' ?></td>
                                            <td><?= $key->address ?></td>
                                            <td><?= $key->phone ?></td>
                                            <td><?= $key->email ?></td>
                                            <td><?= $key->passport ?></td>
                                            <td><?= ($key->status == '1')?'Balance Sheet':'Profit-Loss' ?></td>
                                             <td><?= $key->opening_balance ?></td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#edit_head<?= $key->heads_id ?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addheadopeningbalance<?= $key->heads_id ?>"><i class="fa fa-pencil m-r-5"></i> Add-Balance</a>
                                                        <?php if($key->group_status != 0){
                                                            ?>

                                                        <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" data-target="#viewdata<?= $key->heads_id ?>"><i class="fa fa-eye m-r-5"></i> View</a>
                                                            <?php
                                                        } ?>

                                                        <!-- <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->heads_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a> -->
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div id="edit_head<?= $key->heads_id ?>" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Ledger</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form class="editHead">
                                    <input type="hidden" name="heads_id" value="<?= $key->heads_id ?>">
                                    <div class="form-group">
                                        <label>Ledger Name <span class="text-danger">*</span></label>
                                         <input class="form-control" type="text" name="heads_name" required="" value="<?= $key->heads_name ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Group <span class="text-danger">*</span></label>
                                        <select class="form-control getgroupdataedit" name="group_fk" required="" >
                                        <option>Select Group</option>
                                        <!-- <?php foreach ($this->db->where('del_status',0)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey) {
                                            ?>
                                            <option data-inout="<?= $groupkey->group_category ?>" data-status="<?= $groupkey->status ?>" <?= ($groupkey->group_id == $key->group_fk)?'selected':'' ?> value="<?= $groupkey->group_id ?>"><?= $groupkey->group_name ?></option>
                                            <?php
                                        }  ?> -->
                                        <optgroup label="Credit">
                                            <?php foreach ($this->db->where('del_status',0)->where('status',1)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey) {
                                            ?>
                                            <option data-inout="<?= $groupkey->group_category ?>" data-status="<?= $groupkey->status ?>" value="<?= $groupkey->group_id ?>" <?= ($groupkey->group_id == $key->group_fk)?'selected':'' ?> data-drcr="<?= $groupkey->group_status ?>"><?= $groupkey->group_name ?></option>
                                            <?php
                                        }  ?>
                                        </optgroup>
                                        <optgroup label="Debit">
                                           <?php foreach ($this->db->where('del_status',0)->where('status',2)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey) {
                                            ?>
                                            <option data-inout="<?= $groupkey->group_category ?>" data-status="<?= $groupkey->status ?>" value="<?= $groupkey->group_id ?>" <?= ($groupkey->group_id == $key->group_fk)?'selected':'' ?> data-drcr="<?= $groupkey->group_status ?>"><?= $groupkey->group_name ?></option>
                                            <?php
                                        }  ?>
                                        </optgroup>
                                    </select>
                                         <input type="hidden" class="statusedit" name="status" value="<?= $key->status ?>">
                                        <input type="hidden" class="moneyInOutedit" name="heads_category" value="<?= $key->heads_category ?>" />
                                         <input type="hidden" class="group_statusedit" name="group_status" value="<?= $key->group_status ?>">
                                    </div>
                                   <div >

                                    <div class="form-group">
                                        <label>Address <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="address" value="<?= $key->address ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="phone"  value="<?= $key->phone ?>"/>
                                    </div>
                                      <div class="form-group">
                                        <label>Passport <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="passport"  value="<?= $key->passport ?>"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email"  value="<?= $key->email ?>"/>
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

                <div class="modal custom-modal fade" id="viewdata<?= $key->heads_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>View Detail</h3>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                       <div class="col-md-4">
                                           <span>Address</span><br>
                                           <span><?= $key->address ?></span>
                                       </div>
                                       <div class="col-md-4">
                                           <span>Phone</span>
                                           <br>
                                           <span><?= $key->phone ?></span>
                                       </div>
                                       <div class="col-md-4">
                                          <span>Uploads</span><br> 
                                          <a download href="<?= $key->uploads ?>">Download</a>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div id="addheadopeningbalance<?= $key->heads_id ?>" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title">Opening Balance</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
            <form action="edit/addheadopeningBank_request" method="post">
                <input type="hidden" name="heads_category" value="<?= $key->heads_category ?>" />
            <input type="hidden" name="heads_id" value="<?= $key->heads_id ?>"/>
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
                                <h5 class="modal-title">Add Ledger</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addHead">
                                    <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                             <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                                    <div class="form-group">
                                        <label>Ledger Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="heads_name" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Group <span class="text-danger">*</span></label>
                                        <select class="select getgroupdata" name="group_fk" required="" >
                                        <option>Select Group</option>
                                        <optgroup label="Credit">
                                            <?php foreach ($this->db->where('del_status',0)->where('group_category',1)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey) {
                                            ?>
                                            <option data-inout="<?= $groupkey->group_category ?>" data-status="<?= $groupkey->status ?>" value="<?= $groupkey->group_id ?>" data-drcr="<?= $groupkey->group_status ?>" ><?= $groupkey->group_name ?></option>
                                            <?php
                                        }  ?>
                                        </optgroup>
                                        <optgroup label="Debit">
                                           <?php foreach ($this->db->where('del_status',0)->where('group_category',2)->order_by('group_id','DESC')->get('tbl_group')->result() as $groupkey) {
                                            ?>
                                            <option data-inout="<?= $groupkey->group_category ?>" data-status="<?= $groupkey->status ?>" data-drcr="<?= $groupkey->group_status ?>" value="<?= $groupkey->group_id ?>"><?= $groupkey->group_name ?></option>
                                            <?php
                                        }  ?>
                                        </optgroup>
                                        
                                    </select>
                                    </div>

                                    <div class="">

                                    <div class="form-group">
                                        <label>Address </label>
                                        <input class="form-control" type="text" name="address"  />
                                    </div>
                                    <div class="form-group">
                                        <label>Phone </label>
                                        <input class="form-control" type="number" name="phone"  />
                                    </div>
                                     <div class="form-group">
                                        <label>Passport </label>
                                        <input class="form-control" type="text" name="passport"  />
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" type="email" name="email"  />
                                    </div>
                                    </div>

                                        <input type="hidden" id="status" name="status" value="">
                                        <input type="hidden" id="group_status" name="group_status" value="0">
                                        <input type="hidden" id="moneyInOut" name="heads_category" value="">
                                     


                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

