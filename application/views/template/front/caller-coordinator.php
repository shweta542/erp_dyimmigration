
<?php $arr = explode('|',$privileges_settings->coordinator) ?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Coordinator </h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Coordinator </li>
                                </ul>
                            </div>
                            
                    <div class="col-auto float-right ml-auto">
                    
                    <button class="btn btn-white" onclick="exportexel('exelecounsellor', 'Counsellor',2)"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button> 
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
                                            <th>Name</th>
                                             <th>Country</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Refrence</th>
                                            <th>Remark</th>
                                            <th>File-No</th>
                                            <th>User-Type</th>
                                            <th>Status</th>
                                            <th>Mark-Status</th>
                                            <th>Date of inquiry</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$i=1;
                                         foreach ($data as $key ) {
                                              $country=$this->db->where('id',$key->country)->limit(1)->get('country')->row();
                                            ?>

                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $key->name ?></td>
                                            <td><?= $country->country_name ?></td>
                                            <td><?= $key->email ?></td>
                                            <td><?= $key->phone ?></td>
                                            <td><?= $key->reference ?></td>
                                            <td><?= $key->remark ?></td>
                                           <td><?= ($key->status == 9)?$key->fileno:'' ?></td>
                                            <td><?= ($key->usertype == 1)?'Reception':'Telecaller' ?></td>
                                            <td><div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"> 
                                                        <?php $stat=$this->db->where('status_id',$key->status)->limit(1)->get('tbl_status')->row(); 
                                                           
                                                ?>
                                                        <i style="color:<?= (isset($stat))?$stat->color_code:'' ?>" class="fa fa-dot-circle-o"></i> 
                                                        <?= (isset($stat))?$stat->status_title:'' ?></a>
                                                        
                                                    <div class="dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-17px, -55px, 0px);">
                                                         <?php foreach ($this->db->where('del_status',0)->order_by('status_id','DESC')->get('tbl_status')->result() as $key1 => $value) {
                                                ?>
                                               
                                                        <a class="dropdown-item" href="javascript:void(0)" onclick="changecallstatus(<?= $key->call_id ?>,<?= $value->status_id ?>)"><i style="color:<?= $value->color_code ?>" class="fa fa-dot-circle-o"></i> <?= $value->status_title ?></a>
                                                <?php
                                            } ?>

                                                       
                                                    </div>
                                                </div></td>
                                                <td align="center">
                                                    <select class="form-control counselorId select" name="counselor[]" required=""  onchange="changeAdmission(this.value,<?= $key->call_id ?>);">
                                                    <option>Select Admission</option>
                                                    <?php 
                                                    $arr1=explode(',', $key->admission_id);
                                                    foreach ($admission as $key1 => $value1) {
                                                        ?>
                                                        <option <?php if($value1->USER_ID == $key->admission_id){echo 'selected';} ?> value="<?= $value1->USER_ID ?>"><?= $value1->USER_NAME ?></option>
                                                        <?php
                                                    } ?>
                                                </select>
                                                   <!-- <?php if($key->admission_status == 1){
                                                        ?>
                                                        <input type="checkbox" onclick="markAdmission(<?= $key->call_id ?>,'0')"  checked>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <input type="checkbox" onclick="markAdmission(<?= $key->call_id ?>,'1')"  >
                                                        <?php
                                                    } ?>-->
                                                    
                                                </td>
                                                <td>
                                                    <?= $key->datetime ?>
                                                </td>
                                            <td class="text-right action">
                                                 
                                                <div class="dropdown dropdown-action">
                                                    <a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                       
                                                         <a class="dropdown-item" href="fullcalldetail.html?id=<?= $key->call_id ?>" ><i class="fa fa-eye m-r-5"></i> View</a>
                                                         <?php  if(in_array('3', $arr)){
    ?>
                                                        <a class="dropdown-item" href="caller/editcall/<?= $key->call_id ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                            <?php
                                                    } ?>
                                                     <?php  if(in_array('4', $arr)){
    ?>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->call_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                         <?php
                                                    } ?>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        </tr>
                                        <div id="edit_head<?= $key->call_id ?>" class="modal custom-modal fade" role="dialog">
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
                                    <input type="hidden" name="group_id" value="<?= $key->call_id ?>">
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
                                            <option <?= ($key->group_category==1)?'selected':'' ?> value="1">Money In (CR)</option>
                                            <option <?= ($key->group_category==2)?'selected':'' ?> value="2">Money Out (DR)</option>
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

                <div class="modal custom-modal fade" id="delete_designation<?= $key->call_id ?>" role="dialog">
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
                                            <a href="javascript:void(0);" onclick='deleteCommon(" tbl_call","call_id",<?= $key->call_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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
                                <h5 class="modal-title">Add Calldetail</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addcallerdata">
                                    <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                             <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                                    <div class="form-group">
                                        <label>Student Name <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="name" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Email<span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" name="email" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Phone<span class="text-danger">*</span></label>
                                        <input class="form-control" type="number" name="phone" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>DOB<span class="text-danger">*</span></label>
                                        <input class="form-control mydatepickerholi" type="text" name="dob" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Age<span class="text-danger">*</span></label>
                                        <input class="form-control " type="text" name="age" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Gender<span class="text-danger">*</span></label>
                                        <select class="form-control" name="gender" required="">
                                            <option>Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Address<span class="text-danger">*</span></label>
                                        <textarea class="form-control"  name="address" required="" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Country<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="country" id="country">
                                    <option value="">Selete Country</option>
                                    <?php
                                    foreach ($this->db->get('country')->result() as $key) {
                                    
                                    ?>
                                    <option <?php if(isset($editbranch)){if($editbranch->branch_country == $key->id){echo 'selected';}} ?> value="<?= $key->id ?>" ><?= $key->country_name ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    </div>
                                     <div class="form-group">
                                        <label>State<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="state" id="state">

                                    <?php 
                                    if (isset($editbranch)) {
                                    
                                    if($editbranch->branch_state !=""){
                                        foreach ($this->db->where('country_id',$editbranch->branch_country)->get('states')->result() as $key) {
                                            
                                        ?>
                                        <option value="<?= $key->id ?>" <?php if($key->id == $editbranch->branch_state){echo "selected";}?>><?= $key->name ?></option>
                                        <?php
                                    }
                                    }
                                    }
                                     ?>
                                    
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label>City<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="city" id="city">
                                    <?php 
                                    if (isset($editbranch)) {
                                    
                                    if($editbranch->branch_city !=""){
                                        foreach ($this->db->where('state_id',$editbranch->branch_city)->get('cities')->result() as $key) {
                                        ?>
                                        <option value="<?= $key->id ?>" <?php if($key->id == $editbranch->branch_city){echo "selected";}?>><?= $key->name ?></option>
                                        <?php
                                    }
                                    } 
                                    }
                                     ?>
                                    
                                    </select>
                                    </div>
                                   <div class="form-group">
                                        <label>Reference<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="reference" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Score <small>(IELTS, PTE, Duolingo, Toefl, GRE, GMAT)</small><span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="remark" required="" />
                                    </div>
                                    <div class="form-group">
                                        <label>Remark<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="remark" required="" />
                                    </div>
                                     <div class="form-group">
                                        <label>Status<span class="text-danger">*</span></label>
                                        <select class="form-control" name="status" required="">
                                            <option>Select status</option>
                                            <?php foreach ($this->db->where('del_status',0)->order_by('status_id','DESC')->get('tbl_status')->result() as $key => $value) {
                                                ?>
                                                <option value="<?= $value->status_id ?>"><?= $value->status_title ?></option>
                                                <?php
                                            } ?>
                                        </select>
                                    </div>

                                    <div class="form-group appendAcademic">
                                        <label>Academic Details <a class="btn btn-primary addAcademic" ><i class="fa fa fa-plus"></i></a></label>
                                        <!-- <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Course<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="course" required="" />
                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Board/University<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="boardanduniversity" required="" />
                                    </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Percentage<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="percentage" required="" />
                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Passing Year<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="passingyear" required="" />
                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Stream/Other<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="streamandother" required="" />
                                    </div>
                                            </div>

                                        </div> -->
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

<div style="display: none" class="getAcademicDetails">

    <div class="row">
        <a class="btn btn-danger removeAcademic"><i class="fa fa fa-trash"></i></a>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Course<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="course[]" required="" />
                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Board/University<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="boardanduniversity[]" required="" />
                                    </div>
                                            </div>
                                             <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Percentage<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="percentage[]" required="" />
                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Passing Year<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="passingyear[]" required="" />
                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                        <label>Stream/Other<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" name="streamandother[]" required="" />
                                    </div>
                                            </div>
                                        </div>
</div>
