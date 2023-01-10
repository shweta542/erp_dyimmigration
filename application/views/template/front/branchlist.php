<?php $arr = explode('|',$privileges_settings->branch) ?>

            <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Branches</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Branches</li>
                                </ul>
                            </div>
                            <?php if (in_array('1', $arr,true)) {
                               ?>
                            <div class="col-auto float-right ml-auto">
                                <a href="addbranch.html" class="btn add-btn"><i class="fa fa-plus"></i> Add Branches</a>
                                <button class="btn btn-white m-r-5" onclick="exportexel('empTable', 'branch',1)"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export </button>   
                            </div>
                               <?php
                            } ?>
                        </div>
                    </div>
                    <?php if (in_array('2', $arr,true) || in_array('3', $arr,true) ||  in_array('4', $arr,true)) {
                               ?>
      
                    <div class="row filter-row">
                        <div class="col-md-10">
                        
                        </div>
                            <!-- <div class="col-sm-6 col-md-2">
                        <form action="brancheslist.html" method="get">
                                <div class="form-group form-focus">
                                    <input type="text" class="form-control floating" name="search" id="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}else{'';} ?>"/>
                                    <label class="focus-label">Search..</label>
                                </div>
                        </form>
                            </div> -->

                    </div>
                     <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table" id="empTable">
                                    <thead>
                                        <tr>
                                            <th>Branch Code/ID</th>
                                            <th>Branch Name</th>
                                            <th>Branch Head</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Website</th>
                                            <th class="text-right no-sort">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i=1;
                                        foreach ($data as $key) {
                                            ?>
                                        <tr>
                                            <td><?=$key->branch_id ?></td>
                                            <td>
                                                <h2 class="table-avatar d-flex">
                                                    <?php if($key->branch_logo){
                                                        ?>
                                                        <a href="addbranch.html?id=<?= $key->branch_id ?>" class="avatar"><img alt="" src="<?= $key->branch_logo ?>" /></a>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        
                                                    <a href="addbranch.html?id=<?= $key->branch_id ?>" class="avatar"><img alt="" src="assets/img/user.jpg" /></a>
                                                        <?php
                                                    } ?>

                                                    <a href="addbranch.html?id=<?= $key->branch_id ?>"><?= $key->branch_name ?> <span><?= $key->branch_city ?></span></a>
                                                </h2>
                                            </td>
                                            <td><?= $key->branch_head ?></td>
                                            <td><?= $key->branch_email ?></td>
                                            <td><?= $key->branch_phone ?></td>
                                            <td><?= $key->branch_url ?></td>
                                            <td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if (in_array('3', $arr,true)) {
                               ?>
                                                        <a class="dropdown-item" href="addbranch.html?id=<?= $key->branch_id ?>" ><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    <?php } ?>
                                                    <?php if (in_array('4', $arr,true)) {
                               ?>
                                                        <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#delete_employee<?= $key->branch_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal custom-modal fade" id="delete_employee<?= $key->branch_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Employee</h3>
                                    <p>Are you sure want to delete?</p>
                                </div>
                                <div class="modal-btn delete-action">
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0);" onclick='deleteCommon("tbl_branch","branch_id",<?= $key->branch_id ?>,"Delete Successfully!")' class="btn btn-primary continue-btn">Delete</a>
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
                    <?php
                            } ?>
                </div>

            </div>

