
<?php 
if($usertype == 2){
$arr = explode('|',$privileges_settings->telecaller);
}else{

$arr = explode('|',$privileges_settings->reception);
}

 $firstYear = (int)date('Y') - 50;
$lastYear = $firstYear + 50;

?>

  <div class="page-wrapper">
                <div class="content container-fluid">
                    <div class="page-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="page-title">Followup</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= ($logged_in_user->STATUS == 1)?'dashboardAdmin.html':'dashboardEmployee.html' ?>">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Followup</li>
                                </ul>
                            </div>
                            <div class="col-auto float-right ml-auto">
                                <a href="javascript:void(0)" class="btn add-btn" data-toggle="modal" data-target="#add_head"><i class="fa fa-plus"></i> Add Walkin</a>
                                <a href="<?= base_url() ?>assets/img/Book1.xlsx" download class="btn btn-white" ><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exls Download</a> 
                                <button class="btn btn-white" onclick="exportexel('exeleCall', 'Call',1)"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export</button> 
                                <button class="btn btn-white mr-2" data-toggle="modal" data-target="#importdata"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Import</button> 
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
<form action="<?= ($usertype == 2)?'calldetail1.html':'calldetail.html' ?>" method="GET">
         <div class="row filter-row">
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="country" >
                        <option value="">Select Country</option>
                        <?php foreach ($this->db->get('country')->result() as $key) {
                            ?>
                            <option <?php if(isset($_GET['country'])){if($_GET['country'] == $key->id){echo 'Selected';}} ?> value="<?= $key->id ?>"><?= $key->country_name ?></option>
                            <?php
                        } ?>
                    </select>
                    <label class="focus-label">Country</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                  <select class="select floating" name="class" >
                        <option value="">Select Class</option>
                        <?php foreach ($this->db->get('tbl_class')->result() as $key) {
                            ?>
                            <option <?php if(isset($_GET['class'])){if($_GET['class'] == $key->class_id){echo 'Selected';}} ?> value="<?= $key->class_id  ?>"><?= $key->class_name ?></option>
                            <?php
                        } ?>
                    </select>
                    <label class="focus-label">Class</label>
                </div>
            </div>
            
            
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="year" >
                        <option value="">Select Year</option>
                        <?php 


for($i=$firstYear;$i<=$lastYear;$i++){
                            ?>
                            <option <?php if(isset($_GET['year'])){if($_GET['year'] == $i){echo 'Selected';}} ?> value="<?= $i ?>"><?= $i ?></option>
                            <?php
                        } ?>
                    </select>
                    <label class="focus-label">Year</label>
                </div>
            </div>
         
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                   <select class="select floating" name="boardanduniversity" >
                        <option value="">Select Board/University</option>
                        <?php foreach ($this->db->get('tbl_boardanduniversity')->result() as $key) {
                            ?>
                            <option <?php if(isset($_GET['boardanduniversity'])){if($_GET['boardanduniversity'] == $key->id){echo 'Selected';}} ?> value="<?= $key->id ?>"><?= $key->name ?></option>
                            <?php
                        } ?>
                    </select>
                    <label class="focus-label">Board/University</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                   <select class="select floating" name="stream" >
                        <option value="">Select Stream</option>
                        <?php foreach ($this->db->get('tbl_stream')->result() as $key) {
                            ?>
                            <option <?php if(isset($_GET['stream'])){if($_GET['stream'] == $key->stream_id){echo 'Selected';}} ?> value="<?= $key->stream_id ?>"><?= $key->stream_name ?></option>
                            <?php
                        } ?>
                    </select>
                    <label class="focus-label">Stream</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group form-focus select-focus">
                    <select class="select floating" name="score">
                        <option value="">Select Score</option>
                        <option value="5" >5</option>
                        <option value="5.5" >5.5</option>
                        <option value="6" >6</option>
                        <option value="6.5" >6.5</option>
                        <option value="7" >7</option>
                        <option value="7.5" >7.5</option>
                        <option value="8" >8</option>
                        <option value="8.5" >8.5</option>
                        <option value="9" >9</option>
                        <option value="9.5" >9.5</option>
                        <option value="10" >10</option>
                        <option value="10.5" >10.5</option>
                    </select>
                    <label class="focus-label">Score</label>
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group ">
                    <input type="text" class="form-control" name="percentage" 
                    placeholder="Enter percentage" value="<?php if(isset($_GET['percentage'])){echo $_GET['percentage'];} ?>">
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group ">
                    <input type="text" class="form-control" name="phone" 
                    placeholder="Enter phone" value="<?php if(isset($_GET['phone'])){echo $_GET['phone'];} ?>">
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <div class="form-group ">
                    <input type="text" class="form-control" name="name" 
                    placeholder="Enter name" value="<?php if(isset($_GET['name'])){echo $_GET['name'];} ?>">
                </div>
            </div>
            <div class="col-sm-6 col-md-2">
                <button type="submit" class="btn btn-success btn-block"> Search </button>
            </div>
            <div class="col-md-1"></div>
        </div>
        </form>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table mb-0 " id="exeleCall">
                                    <thead>
                                        <tr>
                                            <th style="width: 30px;">#</th>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Refrence</th>
                                            <th>Gender</th>
                                            <th>Age</th>
                                            <th>File-No</th>
                                            <th>Counselor</th>
                                            <th class="text-right">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
$w=1;
                                         foreach ($data as $key ) {
                                            ?>

                                        <tr>
                                            <td><?= $w++ ?></td>
                                            <td><?= $key->name ?></td>
                                            <td><?= $key->email ?></td>
                                            <td><?= $key->phone ?></td>
                                            <td><?= $key->reference ?></td>
                                            <td><?= $key->gender ?></td>
                                            <td><?= $key->age ?></td>
                                            <td><?= $key->fileno ?></td>
                                           <td><select class="form-control counselorId select" name="counselor[]" required="" multiple onchange="changeCounselor(this.value,<?= $key->call_id ?>);">
                                                    <option>Select Counselor</option>
                                                    <?php 
                                                    $arr1=explode(',', $key->counselor_id);
                                                    foreach ($counselor as $key1 => $value1) {
                                                        ?>
                                                        <option <?php if(in_array($value1->USER_ID, $arr1)){echo 'selected';} ?> value="<?= $value1->USER_ID ?>"><?= $value1->USER_NAME ?></option>
                                                        <?php
                                                    } ?>
                                                </select></td>
                                            <td class="text-right">
                                                 
                                                <div class="dropdown dropdown-action">
                                                    <a href="javascript:void(0)" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                       
                                                         <a class="dropdown-item" href="fullcalldetail.html?id=<?= $key->call_id ?>" ><i class="fa fa-eye m-r-5"></i> View</a>
                                                         <?php  if(in_array('3', $arr)){
    ?>
                                                        <a class="dropdown-item" href="caller/editcall/<?= $key->call_id ?>"  ><i class="fa fa-pencil m-r-5"></i> Edit</a>

                                                         <a class="dropdown-item" href="javascript:void(0)"  data-toggle="modal" data-target="#remark<?= $key->call_id ?>"><i class="fa fa-comment m-r-5"></i> Remark</a>
                                                        <?php } ?>
                                                           <?php  if(in_array('4', $arr)){
    ?>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_designation<?= $key->call_id ?>"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                
                                            </td>
                                        
                                        </tr>
                                       

                <div class="modal custom-modal fade" id="delete_designation<?= $key->call_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Delete Call</h3>
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
                <div class="modal custom-modal fade" id="remark<?= $key->call_id ?>" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Call remark</h3>
                                 </div>
                                                            <div class="modal-btn delete-action">
                                                                <div class="row">
                                                                    <form class="addRemark">
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Remark<span class="text-danger">*</span> </label>
                                                                            <input type="hidden" name="call_id" value="<?= $key->call_id ?>" />  
                                                                            <input class="form-control" value="" type="text" name="remark" required="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Date followup taken<span class="text-danger">*</span> </label>
                                                                           
                                                                            <input class="form-control mydatepickerjournal" value="" type="text" name="followup_taken" required="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <div class="form-group">
                                                                            <label>Next date to take followup<span class="text-danger">*</span> </label>
                                                                           
                                                                            <input class="form-control mydatepickerjournal" value="" type="text" name="followup_nextdate" required="" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="submit-section">
                                                                             <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                    </form>
                                                                    <!---<div class="table-responsive m-t-15">
                                                                        <table class="table table-striped custom-table">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="text-center">S.no</th>
                                                                                    <th class="text-center">Remark</th>
                                                                                    <th class="text-center">Followup Taken</th>
                                                                                    <th class="text-center">Next Date of Followup</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                  <?php 
                                                                                  $i=1;
                                                                                  foreach ($this->db->where('call_id',$key->call_id)->get('tbl_remark')->result() as $keyremark => $valueremark) {
                                                                                  ?>
                                                                                <tr>
                                                                                    <td class="text-center">
                                                                			    	<?= $i++  ?>
                                                                    				</td>
                                                                                    <td class="text-center">
                                                                                       <?= $valueremark->remark ?>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <?= $valueremark->followup_taken ?>
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <?= $valueremark->followup_nextdate ?>
                                                                                    </td>
                                                                                </tr>
                                                                                 <?php
                                                                         } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>-->
                                                                    <div class="col-md-12">
                                                                        <div class="follow-table">
                                                                          <div class="row">
                                                                            <div class="col-md-3"><div class="tab-folow">S.no</div></div>
                                                                            <div class="col-md-3"><div class="tab-folow">Remark</div></div>
                                                                            <div class="col-md-3"><div class="tab-folow">Followup taken</div></div>
                                                                            <div class="col-md-3"><div class="tab-folow">Next date of followup</div></div>
                                                                          </div>
                                                                          <?php 
                                                                          $i=1;
                                                                          foreach ($this->db->where('call_id',$key->call_id)->get('tbl_remark')->result() as $keyremark => $valueremark) {
                                                                          ?>
                                                                          <div class="row">
                                                                            <div class="col-md-3"><div class="tab-folow"><?= $i++  ?></div></div>
                                                                            <div class="col-md-3"><div class="tab-folow"><?= $valueremark->remark ?></div></div>
                                                                           <div class="col-md-3"><div class="tab-folow"><?= $valueremark->followup_taken ?></div></div>
                                                                           <div class="col-md-3"><div class="tab-folow"><?= $valueremark->followup_nextdate ?></div></div>
                                                                          </div>
                                                                          <?php
                                                                             } ?>
                                                                        </div>
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
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Walkin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addcallerdata">
                                    <input type="hidden" name="type" value="<?= $usertype ?>">
                                    <input type="hidden" name="user_id" value="<?= $logged_in_user->USER_ID ?>">
                                    <input type="hidden" name="oraganisation_id" value="<?= $oraganisation_id ?>">
                                    <input type="hidden" name="datetime" value="<?= date('Y-m-d H:i:s') ?>">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Student Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="name" required="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Father Name <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="fathername" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Email<span class="text-danger">*</span></label>
                                                <input class="form-control" type="email" name="email" required="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Phone<span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" name="phone" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>DOB<span class="text-danger">*</span></label>
                                                <input class="form-control mydatepickerholi" type="text" name="dob" required="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Age<span class="text-danger">*</span></label>
                                                <input class="form-control " type="text" name="age" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Gender<span class="text-danger">*</span></label>
                                                <select class="form-control" name="gender" required="">
                                                    <option>Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Address<span class="text-danger">*</span></label>
                                                <input class="form-control"  name="address" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!--  <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Counselor<span class="text-danger">*</span></label>
                                                <select class="form-control" name="counselor" required="">
                                                    <option>Select Counselor</option>
                                                    <?php foreach ($counselor as $key => $value) {
                                                        ?>
                                                        <option value="<?= $value->USER_ID ?>"><?= $value->USER_NAME ?></option>
                                                        <?php
                                                    } ?>
                                                </select>
                                            </div>
                                        </div> -->
                                         <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Marital Status<span class="text-danger">*</span></label>
                                                <select class="form-control" name="marital_status" required="">
                                                    <option>Select Marital Status</option>
                                                        <option value="Single">Single</option>
                                                        <option value="Never married">Never married</option>
                                                        <option value="Married">Married</option>
                                                        <option value="Widowed">Widowed and not remarried </option>
                                                        <option value="Divorced ">Divorced and not remarried </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Country<span class="text-danger">*</span></label>
                                                <select class="form-control select" name="country" id="country">
                                                <option value="">Selete Country</option>
                                                <?php
                                                foreach ($this->db->get('country')->result() as $key) {
                                                
                                                ?>
                                                <option <?php if($key->id == '101'){echo 'selected';} ?> value="<?= $key->id ?>" ><?= $key->country_name ?></option>
                                                <?php
                                                }
                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>State<span class="text-danger">*</span></label>
                                                <select class="form-control select" name="state" id="state">
                                                <?php 
                                                
                                                    foreach ($this->db->where('country_id','101')->get('states')->result() as $key) {
                                                        
                                                    ?>
                                                    <option value="<?= $key->id ?>" <?php if($key->id == '13'){echo 'selected';} ?>><?= $key->name ?></option>
                                                    <?php
                                                }
                                                
                                                 ?>
                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>City<span class="text-danger">*</span></label>
                                                <select class="form-control select" name="city" id="city">
                                                <?php 
                                               
                                                    foreach ($this->db->where('state_id','13')->get('cities')->result() as $key) {
                                                    ?>
                                                    <option value="<?= $key->id ?>" <?php if($key->id == '1097'){echo 'selected';} ?> ><?= $key->name ?></option>
                                                    <?php
                                                }
                                                
                                                 ?>
                                                
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label> English Test<span class="text-danger">*</span></label>
                                                <select class="form-control" name="english_test" onchange="selectenglishtest(this.value)">
                                                    <option value="">Select English Test</option>
                                                    <option value="IELTS">IELTS</option>
                                                    <option value="PTE">PTE</option>
                                                    <option value="Duolingo">Duolingo</option>
                                                    <option value="Toefl">Toefl</option>
                                                    <option value="No">No</option>
                                                    <option value="Pursuing">Pursuing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group hidethis">
                                                <label>Score Overall<span class="text-danger">*</span></label>
                                                <div id="scoreOverall">
                                                    
                                                </div>
                                                
                                                    

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Reference<span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="reference" required="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group hidethis">
                                                <label>Reading</label>
                                                <input class="form-control " type="text" name="reading"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group hidethis">
                                                <label>Listening</label>
                                                <input class="form-control " placeholder="" type="text" name="listening"  />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group hidethis">
                                                <label>Writing</label>
                                                <input class="form-control " placeholder="" type="text" name="writing"  />
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group hidethis">
                                                <label>Speaking</label>
                                                <input class="form-control " placeholder="" type="text" name="speaking"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Remark<span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="remark" required="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
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
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Previous refusal<span class="text-danger">*</span></label>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                Yes<input class="form-control checkreferral" type="radio" name="previous_referral" value="1" required="" /><br>
                                                        
                                                    </div>
                                                    <div class="col-md-6">
                                                         No<input class="form-control checkreferral" type="radio" name="previous_referral" value="2" required="" checked/>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-6 previouscountry" style="display: none">
                                            <div class="form-group" >
                                                <label>Previous country<span class="text-danger">*</span></label>
                                               <input class="form-control" type="text" name="previous_country" value=""  />
                                               
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Percentage in 12th English<span class="text-danger">*</span></label>
                                                <input class="form-control" type="number" name="percentageinenglish" required="" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Previous travel history<span class="text-danger">*</span></label>
                                                <select class="form-control checktravelhistory" name="previoustravelhistory" required="" >
                                                    <option value="">Select option</option>
                                                    <option value="Yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    <div class="col-sm-6 travelhistory" style="display: none">
                                            <div class="form-group">
                                                <label>Previous travel country<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="previoustravelcountryyes" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Prefered Country<span class="text-danger">*</span></label>
                                                <select class="form-control " name="preferedCountry" required="" >
                                                    <option value="">Select Country</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="USA">USA</option> 
                                                    <option value="UK">UK</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="poland">poland</option>
                                                    <option value="Germany">Germany</option> 
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="Russian">Russian</option>
                                                    <option value="New zealand">New zealand</option>
                                                    <option value="Multa">Multa</option> 
                                                    <option value="Sweden">Sweden</option>cyprus
                                                    <option value="Australia">Australia</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 travelhistory" style="display: none">
                                            <div class="form-group">
                                                <label>Prefered City<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="preferedCity" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 " >
                                            <div class="form-group">
                                                <label>Package/Consultancy</label>
                                               <select class="form-control packageConsultancy" name="packageConsultancy"  >
                                                   <option value="">Select</option>
                                                   <option value="Package">Package</option>
                                                   <option value="Consultancy">Consultancy</option>
                                               </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 packagehide" style="display: none">
                                            <div class="form-group">
                                                <label>Total Amount<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="packagetotalamount" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 packagehide" style="display: none">
                                            <div class="form-group">
                                                <label>Before Visa<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="packagebeforevisa" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 packagehide" style="display: none">
                                            <div class="form-group">
                                                <label>Package Include<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="packageinclude" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 packagehide" style="display: none">
                                            <div class="form-group">
                                                <label>After Visa<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="packageaftervisa" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 consultancyhide" style="display: none">
                                            <div class="form-group">
                                                <label>Before Visa<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="consultancybeforevisa" >
                                            </div>
                                        </div>
                                        <div class="col-sm-6 consultancyhide" style="display: none">
                                            <div class="form-group">
                                                <label>After Visa<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" name="consultancyaftervisa" >
                                            </div>
                                        </div>
                                    </div><!-- row -->
                                    <div class="form-group appendAcademic">
                                        <label>Academic Details <a href="javascript:void(0);" class="btn btn-primary addAcademic"><i class="fa fa fa-plus"></i></a></label>
                                    </div>

                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Assign to counselor</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal custom-modal fade" id="importdata" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="form-header">
                                    <h3>Import Calls</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-btn delete-action">
                                    <form action="<?= base_url() ?>caller/importdata" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="type" value="<?= $usertype ?>">
                                        <input type="file" name="exelefile" required="">
                                        <br>
                                        <br>
                                        <button type="submit" name="submit" class="btn btn-primary submit-btn">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

			<div style="display: none" class="getAcademicDetails">
				<div class="addItemDiv">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label>Course<span class="text-danger">*</span></label>
								<select class="form-control" name="course[]" required="">
									<option>Select Course</option>
									<?php foreach ($class as $key ) {
										?>
										<option value="<?= $key->class_id ?>"><?= $key->class_name ?></option>
										<?php
									} ?>
								</select>
								<!-- <input class="form-control" type="text" name="course[]" required="" /> -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Board/University<span class="text-danger">*</span></label>
								<select class="form-control" name="boardanduniversity[]" required="">
									<option>Select Board & university</option>
									<?php foreach ($boardanduniversity as $key ) {
										?>
										<option value="<?= $key->id ?>"><?= $key->name ?></option>
										<?php
									} ?>
								</select>
								<!-- <input class="form-control" type="text" name="boardanduniversity[]" required="" /> -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Percentage<span class="text-danger">*</span></label>
								<input class="form-control" type="number" name="percentage[]" required="" />
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Passing Year<span class="text-danger">*</span></label>
								<select class="form-control" name="passingyear[]" required="">
									<option value="">Select Year</option>
									<?php 
									for($i=$firstYear;$i<=$lastYear;$i++){
										?>
										<option  value="<?= $i ?>"><?= $i ?></option>
										<?php
									} ?>
								</select>
								<!-- <input class="form-control" type="text" name="passingyear[]" required="" /> -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Stream/Other<span class="text-danger">*</span></label>
								 <select class="form-control" name="streamandother[]" required="">
									<option>Select Stream</option>
									<?php foreach ($stream as $key ) {
										?>
										<option value="<?= $key->stream_id ?>"><?= $key->stream_name ?></option>
										<?php
									} ?>
								</select>
								<!-- <input class="form-control" type="text" name="streamandother[]" required="" /> -->
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>&nbsp;</label>
								<div>
									<a href="javascript:void(0);" class="btn btn-danger removeAcademic"><i class="fa fa fa-trash"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
